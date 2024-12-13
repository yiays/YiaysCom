<?php
$title = false;
$desc = "I'm a freelance developer, creating software and services I want to see in the world and making it open source.\nTake a look at what I'm building.";
$keywords = 'yiays,developer,web developer,business,freelance,software,portfolio,demo,blog';
require('includes/header.php');
?><article class="hero">
  <img class="pfp" src="/img/pfp.jpg?v=2" alt="[Yiays] profile picture" width="1024" height="1024">
  <div>
    <h1>Hello, I'm Yiays.</h1>
    <p>
      I'm a freelance developer, creating software and services I want to see in the world
      and making it open source.
    </p>
    <p>
      Take a look at what I'm building.
    </p>
</div>
  <div class="flex-row">
    <a class="btn" href="/blog/who-is-yiays/">Read More</a>
    <span class="spacer"></span>
    <a class="btn" href="https://github.com/yiays/" target="_blank">GitHub</a>
    <a class="btn" href="https://linkedin.com/in/yiays/" target="_blank">LinkedIn</a>
    <a class="btn" href="mailto:yiays@yiays.com">Email</a>
  </div>
  <a href="#skip" class="btn text-center" style="width:0.9em;align-self:center;margin:0;margin-top:auto;padding-top:0.3em;border:none;">&darr;</a>
</article>
<hr>
<section class="featured-projects" id="skip">
  <h2>Featured projects</h2>
  <p>
    These projects are both a showcase of my skills and a culmination of years of work put
    towards making free and open source software and services I want to see in the world.
  </p>
  <div class="carousel carousel-grid">
    <?php require_once('includes/projectdata.php');
    $i = 0;
    foreach($projects as $project) {
      print($project->preview());
      if(++$i == 6) {
        break;
      }
    }
    ?>
  </div>
  <div class="flex-row">
    <a href="/projects/" class="btn">See all projects</a>
  </div>
</section>
<hr>
<section>
  <h2>Recent articles</h2>
  <p>
    I write about my successes and failures as a form of self reflection. Hopefully, these
    chronicals will help myself and others.
  </p>
  <div class="carousel carousel-grid">
    <?php
    require_once('includes/blogdata.php');
    $i = 0;
    foreach($articles as $article) {
      if(!$article->hidden) {
        print($article->preview());
        if(++$i == 3) {
          break;
        }
      }
    }
    ?>
  </div>
  <div class="flex-row">
    <a href="/blog/" class="btn">See all posts</a>
  </div>
</section>
<hr>
<section>
  <h2>Work with me</h2>
  <p>
    I'm available for work - freelance or otherwise - right now. I also offer benefits to Patreon subscribers in some of my projects. Find out more on the services page!
  </p>
  <div class="flex-row">
    <a class="btn" href="/services/">Services</a>
  </div>
</section>
<?php
require('includes/footer.php');
?>