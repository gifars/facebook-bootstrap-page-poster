<?php
include_once("config.php");
?>
<html>
<head>

  



<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="img/favicon.gif">

    <title>Signin Template for Bootstrap</title>
 <link href="asset/css/stylish-portfolio.css" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="asset/css/bootstrap.css" rel="stylesheet">
   
    <link href="asset/font-awesome/css/font-awesome.min.css" rel="stylesheet">

   
    

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->


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



 <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="asset/js/jquery.js"></script>
    <script src="asset/js/bootstrap.js"></script>
</body>
</html>
  