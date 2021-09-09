<?php
$title = false;
$desc = false;
$keywords = 'homepage';
require('includes/header.php');
?><article class="intro">
  <img class="pfp" src="img/pfp.jpg?v=2" alt="[Yiays] profile picture" width="1024" height="1024">
  <h1>Hello, I'm Yiays.</h1>
  <p>
    I'm a web / software developer with an IT degree and experience with a vast variety of programming languages, web technologies, tooling, and design methodologies.
  </p>
  <div class="flex-row">
    <a class="btn c-octocat-bg" href="https://github.com/yiays/">GitHub</a>
    <a class="btn c-blue-bg" href="https://linkedin.com/in/yiays/">LinkedIn</a>
    <a class="btn c-gmail-bg" href="mailto:yesiateyoursheep@gmail.com">Email</a>
  </div>
</article>
<hr>
<section class="featured-projects">
  <h1>Featured projects</h1>
  <p>
    Here, you'll find projects created as part of my studies or in my free time, a handful of them have become somewhat popular with some communities.
  </p>
  <div class="carousel">
    <?php require_once('includes/projectdata.php');
    shuffle($projects);
    $i = 0;
    foreach($projects as $project) {
      print($project->preview());
      if($i++ == 2) {
        print("
          <a class=\"project-mini\" href=\"/projects/\" style=\"background-image: url('/img/genericpurple.svg');\">
            <div class=\"info\">
              <b>All projects</b><br>
              See the expanded list
            </div>
          </a>
        ");
        break;
      }
    } ?>
  </div>
</section>
<hr>
<section>
  <h1>Featured articles</h1>
  <p>
    I occasionally write an article here and there about my misadventures programming. I also like to document the history of my ever-evolving projects.
  </p>
</section>
<?php
require('includes/footer.php');
?>