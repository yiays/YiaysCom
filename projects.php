<?php
$title = 'Projects';
$desc = 'Here, you\'ll find projects created as part of my studies or in my free time, a handful of them have become somewhat popular with some communities.';
$keywords = 'portfolio, work, examples, source code, github';
require('includes/header.php');?>
<article style="background:rgb(88, 38, 88);margin-bottom:-0.5em;">
  <h1>My projects</h1>
  <p>
    Here, you'll find projects created as part of my studies or in my free time, a handful of them have become somewhat popular with some communities.
  </p>
</article>
<hr>
<?php
require('includes/projectdata.php');
$i = 0;
foreach($projects as $project) {
  print($project->print());
  if($i++ != count($projects) - 1) print('<hr>');
}

require('includes/footer.php');
?>