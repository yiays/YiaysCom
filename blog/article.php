<?php
$article = fetch_article($params[2]);

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

if($edit) {
  require('edit.php');
} else {
  if(is_null($article)) {
    http_response_code(404);
    die();
  }else{
    if($article->hidden && (!$user || !$user->admin)) {
      http_response_code(404);
      die();
    }
  }

  $title = $article->title;
  $desc = strip_tags($ParseDown->text(explode("\n", $article->content)[0]));
  $keywords = implode(', ', $article->tags);
  $image = "https://cdn.yiays.com/blog/$article->img";
  require($_SERVER['DOCUMENT_ROOT'].'/includes/header.php');
  
  $article->view($user?$user->id:'NULL');
  print("
    <article class=\"post".($article->hidden?' dim':'')."\" id=\"$article->id\">
      <div class=\"post-header hero\" style=\"background:#$article->col;\">
        <div class=\"flex-row\" style=\"flex-wrap:nowrap;\">
          <h2 style=\"flex-grow:1;\">$article->title</h2>
          ".userpreview($user, true)."
        </div>
        <span class=\"dim\">By ".$article->author->handle().", written ".$article->date->format('Y-m-d').($article->editdate?', <i>last edited '.$article->editdate->format('Y-m-d').'</i>':'')."</span>
        <br><span>".implode(', ', $article->tags)."</span> | $article->views Views
        <img alt=\"".htmlspecialchars($article->title)." cover art\" src=\"https://cdn.yiays.com/blog/$article->img\">
      </div>
      <div class=\"post-content\">
        ".$ParseDown->text($article->content)."
      </div>
    </article>
  ");
  ?>
  <aside>
    <h2>Related articles</h2>
    <div class="x-scroller">
      <div class="carousel">
        <?php
        $articles = fetch_articles(1);
        usort($articles, function($a, $b) {
          global $article;
          return count(array_intersect($article->tags, $b->tags)) - count(array_intersect($article->tags, $a->tags));
        });
        $i = 0;
        foreach($articles as $relatedarticle) {
          if(!$relatedarticle->hidden && $relatedarticle->id!=$article->id) {
            print($relatedarticle->preview());
            if($i++ == 3) {
              break;
            }
          }
        }?>
      </div>
    </div>
  </aside>
<?php
}

require($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php');

function handlepostfileupload($file, $dest) {
  if(getimagesize($file['tmp_name']) !== false && !file_exists($dest) && $file['size'] < 2000000) {
    move_uploaded_file($file['tmp_name'], $dest);
  } else {
    print_r($_FILES);
    header('content-type: application/json');
    die(json_encode(['error'=>['message'=>"The provided image was either too large, already uploaded, or invalid."]]));
  }
}

function converttowebp($dest, &$filename) {
  if(!str_ends_with($filename, '.gif') && !str_ends_with($filename, '.svg')) {
    $im = imagecreatefromstring(file_get_contents($dest.$filename));
    $ofilename = $filename;
    $filename = explode('.', $ofilename);
    array_pop($filename);
    $filename = implode('.', $filename).'.webp';
    imagewebp($im, $dest.$filename);
    unlink($dest.$ofilename);
  }
}
?>