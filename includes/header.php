<!DOCTYPE html>
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

    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <link rel="apple-touch-icon" sizes="180x180" href="/icon/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="/icon/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="/icon/favicon-16x16.png">
		<link rel="manifest" href="/site.webmanifest">
		<meta name="theme-color" content="#000000">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,700;1,400;1,700&display=swap" as="style" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,700;1,400;1,700&display=swap" crossorigin="anonymous">

    <link rel="preload" href="https://fonts.gstatic.com/s/roboto/v32/KFOkCnqEu92Fr1Mu51xIIzI.woff2" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="https://fonts.gstatic.com/s/roboto/v32/KFOjCnqEu92Fr1Mu51TzBic6CsQ.woff2" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="https://fonts.gstatic.com/s/roboto/v32/KFOmCnqEu92Fr1Mu4mxK.woff2" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="https://fonts.gstatic.com/s/roboto/v32/KFOlCnqEu92Fr1MmWUlfBBc4.woff2" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="https://fonts.gstatic.com/s/roboto/v32/KFOlCnqEu92Fr1MmSU5fBBc4.woff2" as="font" type="font/woff2" crossorigin="anonymous">

    <?php
      if(isset($stylesheet)) echo $stylesheet;
    ?>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/default.min.css">
		
    <link rel="preconnect" href="https://cdn.yiays.com">
		<link rel="stylesheet" href="https://cdn.yiays.com/normalize.css">
		<link rel="stylesheet" href="/style.css?v=0.6.4">
  </head>
  <body>
    <div class="main">
      <nav>
        <a href="/" class="nav-item show-small text-center text-skinny" style="width:100%;">
          Yiays.com
        </a>
        <a href="/" class="nav-item hide-small text-skinny">
          Yiays.com
        </a>
        <a class="nav-item <?php print(strpos($url,'/blog/')===0?'active':''); ?>" href="/blog/">
          Blog
        </a>
        <a class="nav-item <?php print($url=='/projects/'?'active':''); ?>" href="/projects/">
          Projects
        </a>
        <a class="nav-item <?php print($url=='/services/'?'active':''); ?>" href="/services/">
          Services
        </a>
      </nav>
      <div>