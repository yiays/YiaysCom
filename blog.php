<?php
require_once('router.php');
require('includes/blogdata.php');
$params = explode('/', $url);
if(strlen($params[2])) {
  $articlematches = array_values(array_filter($articles, function(Article $article){
    global $params;
    return $article->urlid == $params[2];
  }, ARRAY_FILTER_USE_BOTH));

  require_once('../passport/api/auth.php');
  $edit = false;
  $user = passport\autologin();
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
        header('location: https://passport.yiays.com/login/?redirect='.urlencode($_SERVER['REQUEST_URI']));
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
  print($article->print());
  require('includes/footer.php');

}else{
  $title = 'Blog';
  $desc = 'I occasionally write an article here and there about my misadventures programming. I also like to document the history of my ever-evolving projects.';
  $keywords = 'blog, journal, documentation, history';
  require('includes/header.php');?>
  <article style="background:rgb(0, 68, 97);margin-bottom:-0.5em;">
    <h1>Blog</h1>
    <p>
    I occasionally write an article here and there about my misadventures programming. I also document the history of my ever-evolving projects.
    </p>
  </article>
  <hr>
  <?php
  $i = 0;
  foreach($articles as $article) {
    print($article->preview_wide());
    if($i++ != count($articles) - 1) print('<hr>');
  }

  require('includes/footer.php');
}
?>