<?php
$url = explode('?', $_SERVER['REQUEST_URI'])[0];

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
?>