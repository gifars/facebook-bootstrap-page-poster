<?php
include_once("inc/facebook.php"); //include facebook SDK
 
######### edit details ##########
$appId = 'your_appID'; //Facebook App ID
$appSecret = 'yoursecretkey'; // Facebook App Secret
$return_url = 'your return url';  //return url (url to script)
$homeurl = 'yout return url again';  //return to home
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
