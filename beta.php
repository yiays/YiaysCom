<?php
$title = false;
$desc = false;
$keywords = 'homepage';
require('includes/header.php');
?><article class="hero">
  <div class="hero-bg">
    <video autoplay muted loop>
      <source type="video/webm" src="/img/hero.webm">
    </video>
  </div>
  <img class="pfp" src="img/pfp.jpg?v=2" alt="[Yiays] profile picture" width="1024" height="1024">
  <div>
    <h1>Hello, I'm Yiays.</h1>
    <p>
    I'm a web / software developer with an IT degree and experience with a vast variety of programming languages, web technologies, tooling, and design methodologies.
    </p>
</div>
  <div class="flex-row">
    <a class="btn c-octocat-bg" href="https://github.com/yiays/" target="_blank">GitHub</a>
    <a class="btn c-blue-bg" href="https://linkedin.com/in/yiays/" target="_blank">LinkedIn</a>
    <a class="btn c-gmail-bg" href="mailto:yesiateyoursheep@gmail.com">Email</a>
  </div>
  <a href="#skip" class="btn text-center" style="width:1em;align-self:center;margin:0;margin-top:auto;">&darr;</a>
</article>
<hr>
<section class="featured-projects" id="skip">
  <h1>Featured projects</h1>
  <p>
    Here, you'll find projects created as part of my studies or in my free time, a handful of them have become somewhat popular with some communities.
  </p>
  <div class="x-scroller">
    <div class="carousel carousel-end-promo">
      <?php require_once('includes/projectdata.php');
      shuffle($projects);
      $i = 0;
      foreach($projects as $project) {
        print($project->preview());
        if($i++ == 2) {
          print("
            <a href=\"/projects/\" style=\"background-image: url('/img/genericpurple.svg');\">
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