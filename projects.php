<?php
$title = 'Projects';
$desc = "These projects are both a showcase of my skills and a culmination of years of work put towards making free and open source software and services I want to see in the world.";
$keywords = 'portfolio, work, examples, source code, github';
require('includes/header.php');?>
<article class="hero" style="background:rgb(88, 38, 88);">
  <h1>My projects</h1>
  <p>
    These projects are both a showcase of my skills and a culmination of years of work put
    towards making free and open source software and services I want to see in the world.
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