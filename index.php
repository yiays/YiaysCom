<?php
if(isset($_GET['beta'])) {
  setcookie('beta', $_GET['beta'], time()+60*60*24*30, '/', 'yiays.com', true, false);
  http_response_code(401);
  header('location: /');
  die();
}

if(key_exists('beta', $_COOKIE) & $_COOKIE['beta']) {
  require('beta.php');
}else{
  require('old.html');
}
?>