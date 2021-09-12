<?php
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
require('includes/blogdata.php');
$i = 0;
foreach($articles as $article) {
  print($article->preview_wide());
  if($i++ != count($articles) - 1) print('<hr>');
}

require('includes/footer.php');
?>