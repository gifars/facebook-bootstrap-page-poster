<?php
session_start();
if (isset($_SESSION['fbuser'])) // karena nama session buat login kita buat namanya adalah 'user' maka  if isset($_SESSION['user']) ===> varibel penentu
{
$fbuser = $_SESSION['fbuser'];
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Post to user Page Wall</title>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Stylish Portfolio Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link rel="stylesheet"  href="css/bootstrap-datetimepicker.css">
    <link href="./css/stylish-portfolio.css" rel="stylesheet">
    <link href="./font-awesome/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
<div  class="services">
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-md-offset-2 text-center">
            <h2>Facebook Page Poster</h2>
            <hr>
          </div>
        </div>
 <div class="row">
  <div class="col-md-8 col-md-offset-2">


<div class="container">
<form name="form" method="post" action="">




<?php
include_once("config.php");
$photo_url = "http://static.adzerk.net/Advertisers/60abb4b317034aa2af0bc697e6f02963.png";

date_default_timezone_set('Asia/Makassar');

// $dt = new DateTime('29-10-2013 09:50:46');

 
if($_POST)
{
  //Post variables we received from user


  $userPageId   = $_POST["userpages"];
  $userMessage  = $_POST["message"];
  $tanggal = $_POST['tanggal'];
  $photo   = $_POST["photos"];
  $dt = new DateTime($tanggal);



  if(strlen($userMessage)<1) 
  {
    //message is empty
    $userMessage = 'No message was entered!';
  }
  
    //HTTP POST request to PAGE_ID/feed with the publish_stream
    $post_url = '/'.$userPageId.'/photos';
    $page_info = $facebook->api("$userPageId?fields=access_token");
    
    // posts message on page feed
    $msg_body = array(
      'access_token'  => $page_info['access_token'],
      'message' => $userMessage,
      'url' => $photo,
      'published' => false,
      'scheduled_publish_time' => $dt->getTimestamp()
      
     
    );
   
    /*
    //posts message on page statues 
    $msg_body = array(
      'message' => $userMessage,
      'name' => 'Message Posted from Saaraan.com!',
      'caption' => "Nice stuff",
      'link' => 'http://www.saaraan.com/assets/ajax-post-on-page-wall',
      'description' => 'Demo php script posting message on this facebook page.',
      'picture' => 'http://www.saaraan.com/templates/saaraan/images/logo.png'
      
      
      );
      */
  
  if ($fbuser) {
    try {
      
      $postResult = $facebook->api($post_url, 'post', $msg_body );
    } catch (FacebookApiException $e) {
    echo $e->getMessage();
    }
  }else{
   $loginUrl = $facebook->getLoginUrl(array('redirect_uri'=>$homeurl,'scope'=>$fbPermissions));
   header('Location: ' . $loginUrl);
  }
  
  //Show sucess message
  if($postResult)
   {
     
   
     
     echo '<div class="alert alert-success">
     Your message is posted on your facebook wall, <a target="_blank" href="http://www.facebook.com/'.$userPageId.'?sk=allactivity">Visit Your Page</a>
     </div>';
   
    
   }
}
 



if ($fbuser) {
  try {
	 	$user_profile = $facebook->api('/me');
		//Get user pages details using Facebook Query Language (FQL)
		$fql_query = 'SELECT page_id, name, page_url FROM page WHERE page_id IN (SELECT page_id FROM page_admin WHERE uid='.$fbuser.')';
		$postResults = $facebook->api(array( 'method' => 'fql.query', 'query' => $fql_query ));
	} catch (FacebookApiException $e) {
		echo $e->getMessage();
		$fbuser = null;
  }
}else{
		//menuju ke halaman FBLogin 
		header('location: login.php');
		$fbuser = null;
}

if($fbuser && empty($postResults))
{
		/*
		if user is logged in but FQL is not returning any pages, we need to make sure user does have a page
		OR "manage_pages" permissions isn't granted yet by the user. 
		Let's give user an option to grant application permission again.
		*/
		$loginUrl = $facebook->getLoginUrl(array('redirect_uri'=>$homeurl,'scope'=>$fbPermissions));
		echo '<br />Could not get your page details!';
		echo '<br /><a href="'.$loginUrl.'">Click here to try again!</a>'; 
		
}elseif($fbuser && !empty($postResults)){

//Everything looks good, show message form.
?>


<?php /*

Get Log out URL
Due to some bug or whatever, SDK still thinks user is logged in even
after user logs out. To deal with it, user is redirected to another page "logged-out.php" after logout
it is working fine for me with this trick. Hope it works for you too.

$logOutUrl = $facebook->getLogoutUrl(array('next'=>$homeurl.'logged-out.php'));
echo '<a href="'.$logOutUrl.'">Log Out</a>';
*/
?>
</p>
<label>Pilih Halaman Fans Page Anda
</label>
<br>
<select class="form-control" style="width: 65%" name="userpages" id="upages">
	<?php
    foreach ($postResults as $postResult) {
            echo '<option value="'.$postResult["page_id"].'">'.$postResult["name"].'</option>';
        }
    ?>
</select>
<br>
<label>Masukkan tanggal. minimal 10 menit dan makasimal 6 bulan setelah waktu sekarang </label>
<div class="input-group date form_datetime"  style="width: 65%" data-date-format="dd-mm-yyyy hh:ii:ss" data-link-field="dtp_input1">
                    <input class="form-control" type="text" required="required" value="">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
          <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                </div>
        <input type="hidden" name="tanggal" id="dtp_input1" value="" /><br/>

<label>Message
<span class="small">Tulis pesan Postingan Anda!</span>

</label>
<br>
<textarea class="form-control" rows="7" name="message" required="required"></textarea>
<br>
<label>Masukkan URL foto Anda. Ex : http://situsanda.com/foto.jpg</label>
<input class="form-control" required="required" name="photos">
 <br>         
<button type="submit" class="btn btn-primary btn-sm" id="submit_button">Send Message</button>
<div class="spacer"></div>
</form>
</div>
</div>
</div>
 <script src="./js/jquery.js"></script>
  <script src="./js/bootstrap.js"></script>
  <script src="./js/bootstrap-datetimepicker.js"></script>
<script src="./js/bootstrap-datetimepicker.id.js"></script>
<script type="text/javascript">
    $('.form_datetime').datetimepicker({
        language:  'id',
        weekStart: 1,
        todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    forceParse: 0,
        showMeridian: 1
    });

</script>
</body>
</html>
<?php
}
}
?>


</body>
</html>
