<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>PayTren</title>

    <!-- Bootstrap core CSS -->
    <link href="<?=base_url('assets/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="<?=base_url('assets/bootstrap/assets/css/ie10-viewport-bug-workaround.css')?>" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?=base_url('assets/bootstrap/offcanvas.css')?>" rel="stylesheet">

    <!-- Select2 -->
    <link rel="stylesheet" href="<?=base_url('assets/plugins/select2/select2.min.css');?>">
    <!-- daterange picker -->
    <link rel="stylesheet" href="<?=base_url('assets/plugins/daterangepicker/daterangepicker-bs3.css');?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=base_url('assets/dist/css/AdminLTE.min.css');?>">
    <!-- Loac Pace -->
    <link rel="stylesheet" href="<?=base_url('assets/plugins/pace/pace.min.css');?>">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link rel="stylesheet" href="<?=base_url('assets/dist/css/skins/skin-blue.min.css');?>">

    <!-- Custom styles Select2 -->
<!--     <link rel="stylesheet" href="<?=base_url('assets/plugins/select2/select2.min.css');?>">
 -->
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="<?=base_url('assets/bootstrap/assets/js/ie-emulation-modes-warning.js')?>"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <nav class="navbar navbar-fixed-top navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">PayTran Millionaire</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
          <div class="navbar-brand pull-right" href="#"><?php if(!empty($email)){echo $email;}else{echo "0896 7888 8341";}?></div>
          <div class="navbar-brand pull-right" href="#"><?php if(!empty($nama)){echo $nama;}else{echo "Ferdiansyah";}?></div>
        </div><!-- /.nav-collapse -->
      </div><!-- /.container -->
    </nav><!-- /.navbar -->

