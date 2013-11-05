<?php
include_once("config.php");
?>
<html>
<head>

<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="facebook page poster">
    <meta name="author" content="">
    <link rel="shortcut icon" href="img/favicon.gif">

    <title>Masuk dengan Facebook</title>
 <link href="css/stylish-portfolio.css" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
   
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">

   

</head>
<body>
   <div id="top" class="header">
      <div class="vert-text">
        <h2>Selamat datang </h2>
        <h3>Silahkan login ke akun facebook Anda untuk menggunakan tools ini !</h3>
        <?php

$loginUrl = $facebook->getLoginUrl(array('redirect_uri'=>$homeurl,'scope'=>$fbPermissions));
    echo '<a href='.$loginUrl.' class="btn btn-primary">Masuk dengan Facebook</a>'; ?> 
      </div>
    </div>



 <!-- Bootstrap core JavaScript -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>
  