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

  $article = null;
  if(!$articlematches) {
    if(!$edit) {
      http_response_code(404);
      die();
    }else{
      $article = new Article();
      $article->id = -1;
      $article->author = new Author();
      $article->author->id = $user->id;
      $article->author->username = $user->username;
      $article->author->pfp = $user->pfp;
      $article->title = str_replace('-', ' ', ucfirst($params[2]));
      $article->url = $params[2];
      $article->tags = '';
      $article->img = '';
      $article->col = '#000';
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
  
  $title = $article->title;
  $desc = strip_tags($ParseDown->text(explode("\n", $article->content)[0]));
  $keywords = $article->tags;
  $image = $article->img;
  require('includes/header.php');
  print("
    <article class=\"post".($article->hidden?' dim':'')."\" id=\"$article->id\">
      <div class=\"post-header\" style=\"background:$article->col;\">
        <div class=\"flex-row\" style=\"flex-wrap:nowrap;\">
          <h2 style=\"flex-grow:1;\">$article->title</h2>
          ".userpreview($user)."
        </div>
        <span class=\"dim\">By ".$article->author->handle().", written ".$article->date->format('Y-m-d').($article->editdate?', <i>last edited '.$article->editdate->format('Y-m-d').'</i>':'')."</span>
        <br><span>$article->tags</span>
        <img alt=\"$article->title\" src=\"$article->img\">
      </div>
      <div class=\"post-content\">
        ".$ParseDown->text($article->content)."
      </div>
    </article>
  ");
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
  $result = '<span class="login-status text-center">';
  if (!$user) {
    $result .= "Not logged in.
      <br><sub><a href=\"https://passport.yiays.com/account/login/?redirect=".urlencode('https://yiays.com'.$_SERVER['REQUEST_URI'])."\">Login with Passport</a>";
  }else{
    $result .= "Logged in as <b>$user->username</b>
      <br><sub>Not you? <a href=\"https://passport.yiays.com/account/logout/?redirect=".urlencode('https://yiays.com'.$_SERVER['REQUEST_URI'])."\">Logout</a>";
  }
  return $result.'</span>';
}
?>