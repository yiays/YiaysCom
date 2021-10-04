<?php
require_once('router.php');
require('includes/blogdata.php');
require_once('../passport/api/auth.php');
try {
  $user = passport\autologin();
} catch(Exception $e) {
  trigger_error($e->getMessage(), E_USER_WARNING);
  $user = null;
}
$params = explode('/', $url);
if(strlen($params[2])) {
  $articlematches = array_values(array_filter($articles, function(Article $article){
    global $params;
    return $article->urlid == $params[2];
  }, ARRAY_FILTER_USE_BOTH));

  $edit = false;
  if(count($params) > 3) {
    if($params[3] == 'edit') {
      if(key_exists('passportToken', $_COOKIE)) {
        if(!$user || !$user->admin) {
          http_response_code(403);
          die('Failed to verify you as an administrator.');
        }else{
          $edit = true;
        }
      }else{
        http_response_code(301);
        header('location: https://passport.yiays.com/account/login/?redirect='.urlencode('https://yiays.com'.$_SERVER['REQUEST_URI']));
      }
    }elseif($params[3] != '') {
      http_response_code(404);
      die();
    }
  }

  if(array_key_exists('upload', $_GET)) {
    $file = $_FILES['upload'];
    $dest = '../cdn/blog/src/'.$file['name'];
    handlepostfileupload($file, $dest);
    header('content-type: application/json');
    die(json_encode(['url'=>"https://cdn.yiays.com/blog/".$file['name']]));
  }

  $article = null;
  if(!$articlematches) {
    if(!$edit) {
      http_response_code(404);
      die();
    }else{
      assert($user instanceof passport\User);
      $article = new Article();
      $article->id = -1;
      $article->author = new Author();
      $article->author->id = $user->id;
      $article->author->username = $user->username;
      $article->author->pfp = $user->pfp;
      $article->title = str_replace('-', ' ', ucfirst($params[2]));
      $article->urlid = $params[2];
      $article->tags = '';
      $article->img = 'default.svg';
      $article->col = '004461';
      $article->date = new DateTime();
      $article->editdate = null;
      $article->content = 'Click here to edit the article content.';
      $article->hidden = true;
    }
  }else{
    $article = $articlematches[0];
    if($article->hidden && (!$user || !$user->admin)) {
      http_response_code(404);
      die();
    }
  }

  if($edit && array_key_exists('title', $_POST) && array_key_exists('color', $_POST) && array_key_exists('contenthtml', $_POST)) {
    $article->title = $_POST['title'];
    if(array_key_exists('tags', $_POST)) $article->tags = $_POST['tags'];
    if(array_key_exists('cover', $_FILES) && $_FILES['cover']['size'] > 0) {
      $file = $_FILES['cover'];
      $dest = '../cdn/blog/src/'.$file['name'];
      handlepostfileupload($file, $dest);
      $article->img = $file['name'];
    }
    $article->col = substr($_POST['color'], 1);
    $article->hidden = array_key_exists('hidden', $_POST);
    $article->content = $ParseDown->parse($_POST['contenthtml']);
    $article->save();
    http_response_code(403);
    header("location: /blog/$article->urlid");
    die();
  }
  
  $title = $article->title;
  $desc = strip_tags($ParseDown->text(explode("\n", $article->content)[0]));
  $keywords = $article->tags;
  $image = "https://cdn.yiays.com/blog/$article->img";
  require('includes/header.php');

  if($edit) {
    print("
    <form method=\"POST\" enctype=\"multipart/form-data\">
      <article class=\"post post-editable\" id=\"$article->id\">
        <div class=\"post-header\" id=\"postcolor\" style=\"background:#$article->col;\">
          <div class=\"flex-row\" style=\"flex-wrap:nowrap;\">
            <h2 style=\"max-width:min(30rem,60vw);\">
              <input type=\"text\" name=\"title\" placeholder=\"Title\" required value=\"".htmlspecialchars($article->title)."\">
            </h2>
            ".userpreview($user)."
          </div>
          <span class=\"dim\">By ".$article->author->handle().", written ".$article->date->format('Y-m-d').($article->editdate?', <i>last edited '.$article->editdate->format('Y-m-d').'</i>':'')."</span>
          <br><input type=\"text\" name=\"tags\" placeholder=\"Tags\" value=\"".htmlspecialchars($article->tags)."\">
          <br>Colour:
          <input type=\"color\" id=\"color\" name=\"color\" required value=\"#$article->col\">
          <br>Cover image:
          <input type=\"file\" name=\"cover\" id=\"cover\" accept=\".jpg,.jpeg,.png,.webp,.svg\">
          <br>
          <div class=\"flex-row\">
            <label for=\"hidden\">Hidden:</label>&nbsp;
            <input type=\"checkbox\" id=\"hidden\" name=\"hidden\" ".($article->hidden?'checked':'').">
            <input type=\"submit\" id=\"save\" class=\"btn\" style=\"margin-left:auto;\" value=\"".($article->hidden?'Save':'Publish')."\">
          </div>
          <img alt=\"".htmlspecialchars($article->title)." cover art\" id=\"postcover\" src=\"https://cdn.yiays.com/blog/$article->img\">
        </div>
        <input type=\"hidden\" name=\"contenthtml\" id=\"submitcontent\">
        <div class=\"post-content\" id=\"postcontent\">$article->content</div>
      </article>
    </form>
    <script src=\"https://cdn.yiays.com/ckeditor.js\"></script>
    <script>
      let editor;
      let postcontent = document.querySelector('#postcontent');
      let submitcontent = document.querySelector('#submitcontent');
      let savebtn = document.querySelector('#save');
      let hiddenchk = document.querySelector('#hidden');
      let colorinp = document.querySelector('#color');
      let post = document.querySelector('#postcolor');
      let coverfs = document.querySelector('#cover');
      let postcover = document.querySelector('#postcover');
      BalloonEditor
        .create(postcontent, {
          simpleUpload: {
            uploadUrl: '?upload'
          }
        })
        .then(newEditor => {editor = newEditor;})
        .catch(error => {
          console.error(error);
        });
      savebtn.addEventListener('click', (e)=>{
        submitcontent.value = editor.getData();
      });
      hiddenchk.addEventListener('input', (e)=>{
        savebtn.value = (hiddenchk.checked==true)?'Save':'Publish';
      });
      colorinp.addEventListener('input', (e)=>{
        post.style.background = colorinp.value;
      });
      coverfs.addEventListener('input', (e)=>{
        if(coverfs.files[0]) postcover.src = URL.createObjectURL(coverfs.files[0]);
      });
    </script>
    ");
  }else{
    print("
      <article class=\"post".($article->hidden?' dim':'')."\" id=\"$article->id\">
        <div class=\"post-header\" style=\"background:#$article->col;\">
          <div class=\"flex-row\" style=\"flex-wrap:nowrap;\">
            <h2 style=\"flex-grow:1;\">$article->title</h2>
            ".userpreview($user)."
          </div>
          <span class=\"dim\">By ".$article->author->handle().", written ".$article->date->format('Y-m-d').($article->editdate?', <i>last edited '.$article->editdate->format('Y-m-d').'</i>':'')."</span>
          <br><span>$article->tags</span>
          <img alt=\"".htmlspecialchars($article->title)." cover art\" src=\"https://cdn.yiays.com/blog/$article->img\">
        </div>
        <div class=\"post-content\">
          ".$ParseDown->text($article->content)."
        </div>
      </article>
    ");
  }
  require('includes/footer.php');

}else{
  $title = 'Blog';
  $desc = 'I occasionally write an article here and there about my misadventures programming. I also like to document the history of my ever-evolving projects.';
  $keywords = 'blog, journal, documentation, history';
  require('includes/header.php');?>
  <article style="background:rgb(0, 68, 97);margin-bottom:-0.5em;">
    <div class="flex-row" style="flex-wrap:nowrap;">
      <h1 style="flex-grow:1;">Blog</h1>
      <?php echo userpreview($user); ?>
    </div>
    <p>
    I occasionally write an article here and there about my misadventures programming. I also document the history of my ever-evolving projects.
    </p>
  </article>
  <?php if($user && $user->admin) { ?>
  <hr>
  <section class="flex-row">
    <a class="btn" href="/blog/new-article/edit/">New Article</a>
  </section>
  <?php } ?>
  <hr>
  <?php
  $i = 0;
  foreach($articles as $article) {
    if(!$article->hidden || ($user && $user->admin)) {
      if($i++ != 0) print('<hr>');
      print($article->preview_wide(boolval($user)));
    }
  }

  require('includes/footer.php');
}

function userpreview($user) {
  $result = '<span class="login-status text-center" style="margin-left:auto;">';
  if (!$user) {
    $result .= "Not logged in.
      <br><sub><a href=\"https://passport.yiays.com/account/login/?redirect=".urlencode('https://yiays.com'.$_SERVER['REQUEST_URI'])."\">Login with Passport</a>";
  }else{
    $result .= "Logged in as <b>$user->username</b>
      <br><sub>Not you? <a href=\"https://passport.yiays.com/account/logout/?redirect=".urlencode('https://yiays.com'.$_SERVER['REQUEST_URI'])."\">Logout</a>";
  }
  return $result.'</span>';
}

function handlepostfileupload($file, $dest) {
  if(getimagesize($file['tmp_name']) !== false && !file_exists($dest) && $file['size'] < 500000) {
    move_uploaded_file($file['tmp_name'], $dest);
  } else {
    print_r($_FILES);
    header('content-type: application/json');
    die(json_encode(['error'=>['message'=>"The provided cover image was either too large, already uploaded, or invalid."]]));
  }
}
?>