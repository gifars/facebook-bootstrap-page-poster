<?php
include_once("inc/facebook.php"); //include facebook SDK
date_default_timezone_set('Asia/Makassar'); // change to your current Timezone
######### edit details ##########
$appId = '717073518321845'; //Facebook App ID
$appSecret = '585b19da76f454ac6448dadad3359a52'; // Facebook App Secret
$return_url = 'http://localhost/facebook/';  //return url (url to script)
$homeurl = 'http://localhost/facebook/';  //return to home
$fbPermissions = 'publish_stream,manage_pages';  //Required facebook permissions
##################################

//Call Facebook API
$facebook = new Facebook(array(
  'appId'  => $appId,
  'secret' => $appSecret,
  'fileUpload' => true
));

$fbuser = $facebook->getUser();

?>