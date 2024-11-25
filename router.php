<?php
$url = explode('?', $_SERVER['REQUEST_URI'])[0];

if($url == '/'){
  require('index.php');
}
elseif(str_starts_with($url, '/projects/')) {
  require('projects.php');
}
elseif(str_starts_with($url, '/blog/')) {
  // Get the logged in status
  $user = null;
  if(isset($_COOKIE['_passportToken'])) {
    $token = $_COOKIE['_passportToken'];
    $rawresponse = file_get_contents("https://passport.yiays.com/api/account?token=$token");
    if($rawresponse)
      $user = json_decode($rawresponse);
  }
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