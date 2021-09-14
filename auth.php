<?php
/* Reference implementation for proper login with Passport, I'll be taking some shortcuts for now.

require_once('router.php');
$params = explode('/', $url);

switch($params[2]){
  case '':
    http_response_code(301);
    header('location: https://passport.yiays.com/api/oauth2/authorize?id=1&redirect='.urlencode('https://yiays.com/login/callback/'));
    break;
  case 'logout':
    session_reset();
    http_response_code(301);
    header('location: /');
    break;
  case 'callback':
    require_once('../html.secret.php'); // $secret : string
    if(!isset($_GET['code'])) {
      http_response_code(403);
      die("Authorization failed: no auth code provided.");
    }
    $result = apiRequest('https://passport.yiays.com/api/oauth2/token', [
      'client_id' => 1,
      'client_secret' => $secret,
      'code' => $_GET['code']
    ]);
    break;
  default:
    http_response_code(404);
    die();
}

function apiRequest($url, $post=[], $headers=array()) {
  $ch = curl_init($url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  if($post){
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
	}
  $headers[] = 'Accept: application/json';
  if(session('access_token'))
    $headers[] = 'Authorization: Bearer ' . session('access_token');
	array_push($headers,"Content-Type: application/x-www-form-urlencoded");
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  $response = curl_exec($ch);
  return json_decode($response);
}*/
?>