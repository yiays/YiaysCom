<?php
require_once('router.php');
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php print($title?$title.' - Yiays.com':'Yiays.com'); ?></title>
    <meta name="og:title" content="<?php print(htmlspecialchars($title?$title.' - Yiays.com':'Yiays.com')); ?>">
    <meta name="keywords" content="yiays, web developer, programmer, database, designer, merely, kahootdiscord, pukekohost, project, <?php echo $keywords; ?>">
    <meta name="description" content="<?php print(htmlspecialchars($desc?$desc:"I'm a student experienced with full-stack web development, software development, database design and implementation. Here you can find my work.")); ?>">
    <meta name="og:description" content="<?php print(htmlspecialchars($desc?$desc:"I'm a student experienced with full-stack web development, software development, database design and implementation. Here you can find my work.")); ?>">
    <?php
      if(isset($image)) print("<meta name=\"og:image\" content\"".$image."\">");
    ?>
    <meta name="og:url" content="<?php echo "https://yiays.com".$url; ?>">
    <meta name="twitter:card" content="summary_large_image">

    <link rel="apple-touch-icon" sizes="180x180" href="/icon/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="/icon/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="/icon/favicon-16x16.png">
		<link rel="manifest" href="/site.webmanifest">
		<meta name="theme-color" content="#000000">
		
		<link rel="stylesheet" href="/normalize.css">
		<link rel="stylesheet" href="/style.beta.css?v=0.1.29">

    <style>
      .beta-toggle {
        position: absolute;
        top: 1.5em;
        right: 1.5em;
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
				background: rgb(163,73,164);
        border-radius: 1em;
        transition: background 0.25s ease;
      }
      .beta-toggle > .beta-slider::before {
        content: '';
        position: absolute;
        left: 0.1em;
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
    <a class="beta-toggle" href="/?old=1">
      <span class="beta-slider"></span>
      Legacy
    </a>
    <div class="main">
      <nav>
        <p class="nav-item show-small text-center text-skinny" style="width:100%;">
          Yiays.com
        </p>
        <span class="nav-item hide-small text-skinny">
          Yiays.com
        </span>
        <a class="nav-item <?php print($url=='/'?'active':''); ?>" href="/">
          About
        </a>
        <a class="nav-item <?php print(strpos($url,'/blog/')===0?'active':''); ?>" href="/blog/">
          Blog
        </a>
        <a class="nav-item <?php print($url=='/projects/'?'active':''); ?>" href="/projects/">
          Projects
        </a>
      </nav>
      <div class="y-scroller">