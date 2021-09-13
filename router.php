<?php
if(isset($_GET['beta'])) {
  setcookie('beta', $_GET['beta'], time()+60*60*24*30, '/', 'yiays.com', true, false);
  http_response_code(401);
  header('location: /');
  die();
}

$url = explode('?', $_SERVER['REQUEST_URI'])[0];

if(version_compare(PHP_VERSION, '8.0.0', '<')) {
  // str_starts_with polyfil
  function str_starts_with(string $haystack, string $needle): bool {
    return strpos($haystack, $needle) === 0;
  }
}

if(key_exists('beta', $_COOKIE) && $_COOKIE['beta']) {
  if($url == '/'){
    require('beta.php');
  }
  elseif(str_starts_with($url, '/projects/')) {
    require('projects.php');
  }
  elseif(str_starts_with($url, '/blog/')) {
    require('blog.php');
  }
  else {
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