<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Yiays.com</title>
    <meta name="keywords" content="yiays, web developer, programmer, database, designer, merely, kahootdiscord, pukekohost, project">
    <meta name="description" content="I'm a student experienced with full-stack web development, software development, database design and implementation. Here you can find my work.">

    <link rel="apple-touch-icon" sizes="180x180" href="/icon/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="/icon/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="/icon/favicon-16x16.png">
		<link rel="manifest" href="/site.webmanifest">
		<meta name="theme-color" content="#000000">
		
		<link rel="stylesheet" href="/normalize.css">
		<link rel="stylesheet" href="/style.beta.css?v=0.0.52">

    <style>
      .beta-toggle {
        position: absolute;
        top: 1em;
        right: 1em;
        display: inline-block;
        padding: 0.4em;
        background: #000;
        color: #fff;
        box-shadow: #000 0 0 0.1em;
        border-radius: 1em;
        z-index: 1;
      }
      .beta-toggle > .beta-slider {
        position: relative;
        display: inline-block;
        width: 1.8em;
        height: 1em;
        top: 0.1em;
        margin-right: 0.2em;
        background: rgb(112,146,190);
        border-radius: 1em;
        transition: background 0.25s ease;
      }
      .beta-toggle > .beta-slider::before {
        content: '';
        position: absolute;
        left: 0.9em;
        top: 0.1em;
        display: inline-block;
        width: 0.8em;
        height: 0.8em;
        background: #fff;
        border-radius: 0.8em;
        transition: left 0.25s ease;
      }
      .beta-toggle:focus > .beta-slider {
        background: rgb(163,73,164);
      }
      .beta-toggle:focus > .beta-slider::before {
        left: 0.1em;
      }
    </style>
  </head>
  <body>
    <a class="beta-toggle" href="/?beta=0">
      <span class="beta-slider"></span>
      Beta
    </a>
    <div class="main">
      <nav>
        <a class="nav-item active" href="/">
          About
        </a>
        <a class="nav-item" href="/blog/">
          Blog
        </a>
        <a class="nav-item" href="/projects/">
          Projects
        </a>
      </nav>

      <article class="intro">
        <img class="pfp" src="img/pfp.jpg?v=2" alt="[Yiays] profile picture" width="1024" height="1024">
        <h1>Hello, I'm Yiays.</h1>
        <p>
          I'm a web / software developer with an IT degree and experience with a vast variety of programming languages, web technologies, tooling, and design methodologies.
        </p>
      </article>

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

      <section>
        <h1>Featured articles</h1>
        <p>
          I occasionally write an article here and there about my misadventures programming. I also like to document the history of my work. If any of that sounds interesting to you, here's some of my written work.
        </p>
      </section>
    </div>
    <div class="text-center">
      Design and Code &copy; 2021 Yiays
    </div>
  </body>
</html>