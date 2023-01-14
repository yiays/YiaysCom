<?php
if(isset($_GET['old'])) {
  setcookie('old', $_GET['old'], time()+60*60*24*30, '/', 'yiays.com', true, false);
  http_response_code(401);
  header('location: /');
  die();
}

$url = explode('?', $_SERVER['REQUEST_URI'])[0];

if(key_exists('old', $_COOKIE) && $_COOKIE['old']) {
  if(strlen($url) > 1) {
    http_response_code(404);
    die();
  }
  require('old.html');
}else{
  if($url == '/'){
    require('index.php');
  }
  elseif(str_starts_with($url, '/projects/')) {
    require('projects.php');
  }
  elseif(str_starts_with($url, '/blog/')) {
    require('blog/index.php');
  }
  elseif(str_starts_with($url, '/services/')) {
    require('services.php');
  }
  /*elseif(str_starts_with($url, '/login/')) {
    require('auth.php');
  }*/
  else {
    http_response_code(404);
    die();
  }
}
?>