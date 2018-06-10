<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="description" content="<?php /*print(webDescription());*/?>">
  <meta name="keywords" content="<?php /*print(webTag());*/?>">
  <meta name="author" content="Yunas Pamatda">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php /* (isset($title)) ? print($title).' - ':null; print(webTitle());*/?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?=base_url();?>assets/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url();?>assets/font-awesome/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url();?>assets/css/AdminLTE.css">
  <link rel="stylesheet" href="<?=base_url();?>assets/css/skins/skin-black.min.css">
  <!-- Pace style -->
  <link rel="stylesheet" href="<?=base_url();?>assets/css/pace.css">
  <!-- jQuery 3 -->
  <script src="<?=base_url();?>assets/js/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?=base_url();?>assets/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?=base_url();?>assets/js/adminlte.js"></script>
  <!-- SlimScroll -->
  <script src="<?=base_url();?>assets/js/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="<?=base_url();?>assets/js/fastclick.js"></script>
  <!-- Pace page -->
  <script src="<?=base_url();?>assets/js/pace.js"></script>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- Javascript Load -->
  <?php 
  if(isset($jsFiles)){
    foreach($jsFiles as $js) {
        echo "<script src='".base_url()."assets/js/" . $js.".js' type='text/javascript' /></script>";
    }
  } 
  ?>
  <!-- CSS Load -->
  <?php 
  if(isset($cssFiles)){
    foreach($cssFiles as $css) {
        echo "<link href='".base_url()."assets/css/" . $css.".css' rel='stylesheet' type='text/css' />";
    }
  } 
  ?>

</head>
<body class="hold-transition skin-black layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <img src="<?=base_url('upload/system/apple.png');?>" class="img-thumbnail pull-left" width="40px">
           <a href="<?=base_url();?>" class="navbar-brand text-center"><b>Candra Apple Solution</b></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <?=$topbar;?>
        <!-- /.navbar-collapse --> 
    </nav>
  </header>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
        <?=$content;?>
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="container">
      <!-- To the right -->
    <div class="pull-right hidden-xs">
      Halaman dimuat dalam <strong>{elapsed_time}</strong> detik. | <b>Versi</b> 1.0 Alpha
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2018 <a href="http://candraapplesolutions.com">Candra Apple Solution</a>.</strong> All rights reserved.
    </div>
    <!-- /.container -->
  </footer>
</div>
<!-- ./wrapper -->

<div class="box-chat-popup">
  <a href="#" role="button">
    <h3 class="text-center text-gray"><i class="fa fa-comments"></i></h3>
  </a>
</div>

</body>
</html>
