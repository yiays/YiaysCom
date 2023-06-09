<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/router.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/blogdata.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../passport/api/auth.php');
try {
  $user = passport\autologin();
} catch(Exception $e) {
  trigger_error($e->getMessage(), E_USER_WARNING);
  $user = null;
}
$params = explode('/', $url);
if(strlen($params[2])) {
  require('article.php');
}else{
  $title = 'Blog';
  $desc = 'I occasionally write an article here and there about my misadventures programming. I also like to document the history of my ever-evolving projects.';
  $keywords = 'blog, journal, documentation, history';
  require($_SERVER['DOCUMENT_ROOT'].'/includes/header.php');?>
  <article class="hero" style="background:rgb(0, 68, 97);">
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
  $articles = fetch_articles();
  $i = 0;
  foreach($articles as $article) {
    if(!$article->hidden || ($user && $user->admin)) {
      if($i++ != 0) print('<hr>');
      print($article->preview_wide(boolval($user)));
    }
  }

  require($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php');
}

function userpreview($user, $edit=null) {
  $result = '<span class="login-status text-center" style="margin-left:auto;">';
  if (!$user) {
    $result .= "Not logged in.
      <br><sub><a href=\"https://passport.yiays.com/account/login/?redirect=".urlencode('https://yiays.com'.$_SERVER['REQUEST_URI'])."\">Login with Passport</a>";
  }else{
    $result .= "Logged in as <b>$user->username</b>
      <br><sub>Not you? <a href=\"https://passport.yiays.com/account/logout/?redirect=".urlencode('https://yiays.com'.$_SERVER['REQUEST_URI'])."\">Logout</a>";
  }
  if(!is_null($edit)) {
    $result .= "<br><a class=\"btn\" href=\"edit/\">Edit</a>";
  }
  return $result.'</span>';
}
?>