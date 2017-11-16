<?php

if (!session_id()) {
    session_start();
}

require_once 'src/Facebook/autoload.php';

$fb = new Facebook\Facebook([
  'app_id' => '629340740602324',
  'app_secret' => '2e5d99ecf125672bcd9bba0c206ae1fc',
  'default_graph_version' => 'v2.2',
]);
 
$helper = $fb->getRedirectLoginHelper();
 
try {
  $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}
 
if (! isset($accessToken)) {
  if ($helper->getError()) {
    header('HTTP/1.0 401 Unauthorized');
    echo "Error: " . $helper->getError() . "\n";
    echo "Error Code: " . $helper->getErrorCode() . "\n";
    echo "Error Reason: " . $helper->getErrorReason() . "\n";
    echo "Error Description: " . $helper->getErrorDescription() . "\n";
  } else {
    header('HTTP/1.0 400 Bad Request');
    echo 'Bad request';
  }
  exit;
}
 
// Logged in
// The OAuth 2.0 client handler helps us manage access tokens
$oAuth2Client = $fb->getOAuth2Client();
 
// Get the access token metadata from /debug_token
$tokenMetadata = $oAuth2Client->debugToken($accessToken);
 
// Get user’s Facebook ID
$userId = $tokenMetadata->getField('user_id');

try {
  // Returns a `Facebook\FacebookResponse` object
  $response = $fb->get('/me?fields=id,name,email', $accessToken);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}
 
$user = $response->getGraphUser();

$userName = $user['name']; // Retrieve user name
$userData = explode(" ",$userName);
$firstname = $userData[0];
$lastname = $userData[1];
$userEmail = $user['email'];

require_once "database.php";

$sql = "insert into user (userid, email, password, firstname, lastname, phone) VALUES (NULL, '$userEmail', '', '$firstname', '$lastname', '')";
$query=mysqli_query($con,$sql);

$_SESSION['email']= $userEmail;
$_SESSION['usernm']= $userName;
echo "<script>window.location.href='/market_place/index.php';</script>";

?>
