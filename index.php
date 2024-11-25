<?php
$title = false;
$desc = false;
$keywords = 'homepage';
require('includes/header.php');
?><article class="hero">
  <img class="pfp" src="img/pfp.jpg?v=2" alt="[Yiays] profile picture" width="1024" height="1024">
  <div>
    <h1>Hello, I'm Yiays.</h1>
    <p>
    I'm a web / software developer with an IT degree and experience with a vast variety of programming languages, web technologies, tooling, and design methodologies.
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
          break;
        }
      }
      print("
        <a href=\"/projects/\">
          <img src=\"/img/genericpurple.svg\" alt=\"See all projects\">
          <div class=\"info\">
            <b>All projects</b><br>
            See the expanded list
          </div>
        </a>
      ");
      ?>
    </div>
  </div>
</section>
<hr>
<section>
  <h2>Featured articles</h2>
  <p>
    I occasionally write an article here and there about my misadventures programming. I also document the history of my ever-evolving projects.
  </p>
  <div class="x-scroller">
    <div class="carousel carousel-end-promo">
      <?php
      require_once('includes/blogdata.php');
      shuffle($articles);
      $i = 0;
      foreach($articles as $article) {
        if(!$article->hidden) {
          print($article->preview());
          if($i++ == 1) {
            break;
          }
        }
      }
      print("
        <a href=\"/blog/\">
          <img src=\"/img/blog.svg\" alt=\"See all posts\">
          <div class=\"info\">
            <b>All posts</b><br>
            See the blog
          </div>
        </a>
      ");
      ?>
    </div>
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