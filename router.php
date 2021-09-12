<?php
if(isset($_GET['beta'])) {
  setcookie('beta', $_GET['beta'], time()+60*60*24*30, '/', 'yiays.com', true, false);
  http_response_code(401);
  header('location: /');
  die();
}

$url = explode('?', $_SERVER['REQUEST_URI'])[0];

if(key_exists('beta', $_COOKIE) && $_COOKIE['beta']) {
  switch($url) {
    case '/':
      require('beta.php');
      break;
    case '/projects/':
      require('projects.php');
      break;
    case '/blog/':
      require('blog.php');
      break;
    default:
      http_response_code(404);
      die();
  }
}else{
  if(strlen($url) > 1) {
    http_response_code(404);
    die();
  }
  require('old.html');
}
?>