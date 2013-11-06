<?php
include_once("config.php");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Post to user Page Wall</title>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Post to user Page Wall Using facebook php sdk">
    <meta name="author" content="faisal">

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link rel="stylesheet"  href="css/bootstrap-datetimepicker.css">
    <link rel="stylesheet"  href="css/bootstrap-select.css">

  
  
</head>
<body>
<div  class="container">
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
     
   
     
     echo '<div class="alert alert-success">';
     echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
     Your message is posted on your facebook wall, <a target="_blank" href="http://www.facebook.com/'.$userPageId.'?sk=allactivity">Visit Your Page</a>
     </div>';
     //hapus baris 95 hingga 99 untuk menghilangkan notifikasi donasi
     echo '<br>';
     echo '<div class="alert alert-success">
     Mohon Donasinya! Agar saya bisa terus Mengembangkan Tools ini, berupa pulsa seiklasnya saja, kirim ke no 085256599855
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
	
		$loginUrl = $facebook->getLoginUrl(array('redirect_uri'=>$homeurl,'scope'=>$fbPermissions));
		echo '<br />Could not get your page details!';
		echo '<br /><a href="'.$loginUrl.'">Click here to try again!</a>'; 
		
}elseif($fbuser && !empty($postResults)){

//Everything looks good, show message form.
?>


<?php 
?>
</p>
<label>Pilih Halaman Fans Page Anda
</label>
<br>
<select class="selectpicker" style="width: 65%" name="userpages" id="upages">
	<?php
    foreach ($postResults as $postResult) {
            echo '<option value="'.$postResult["page_id"].'">'.$postResult["name"].'</option>';
        }
    ?>
</select>
<br>
<label>Masukkan tanggal. minimal 10 menit dan maksimal 6 bulan setelah waktu sekarang </label>
<div class="input-group date form_datetime"  style="width: 65%" data-date-format="dd-mm-yyyy hh:ii:ss" data-link-field="dtp_input1">
<input class="form-control" type="text" required="required" value="">
<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
<span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
</div>
<input type="hidden" name="tanggal" id="dtp_input1" value="" /><br/>

<label>Tulis pesan Postingan Anda!

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

<!-- call all javascript file here -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/bootstrap-datetimepicker.js"></script>
<script src="js/bootstrap-datetimepicker.id.js"></script>
<script src="js/bootstrap-select.js"></script>
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
<script type="text/javascript">
        $(window).on('load', function () {

            $('.selectpicker').selectpicker({
                'selectedText': 'cat'
            });

            // $('.selectpicker').selectpicker('hide');
        });
    </script>
</body>
</html>
<?php
}
?>
</body>
</html>
