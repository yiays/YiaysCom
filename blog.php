<?php
require_once('router.php');
require('includes/blogdata.php');
$params = explode('/', $url);
if(strlen($params[2])) {
  $articlematches = array_values(array_filter($articles, function(Article $article){
    global $params;
    return $article->urlid == $params[2];
  }, ARRAY_FILTER_USE_BOTH));

  if(!$articlematches) {
    http_response_code(404);
    die();
  }
  
  $article = $articlematches[0];
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