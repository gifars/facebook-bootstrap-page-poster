<?php
include_once("inc/facebook.php"); //include facebook SDK
 
######### edit details ##########
$appId = '346921398777410'; //Facebook App ID
$appSecret = '9ccc8b93e247f8457739ef85bd9991b9'; // Facebook App Secret
$return_url = 'http://faisal.bl.ee';  //return url (url to script)
$homeurl = 'http://faisal.bl.ee';  //return to home
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