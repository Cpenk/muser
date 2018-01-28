<?php
  $profile = $this->db->get('profile')->row();
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?=$profile->nama_logo?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?=base_url('assets/bootstrap/css/bootstrap.min.css');?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?=base_url('assets/plugins/font-awesome/css/font-awesome.min.css');?>">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> -->
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?=base_url('assets/plugins/ionicons/css/ionicons.min.css')?>">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?=base_url('assets/plugins/select2/select2.min.css');?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=base_url('assets/dist/css/AdminLTE.min.css');?>">
    <!-- Loac Pace -->
    <link rel="stylesheet" href="<?=base_url('assets/plugins/pace/pace.min.css');?>">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link rel="stylesheet" href="<?=base_url('assets/dist/css/skins/skin-blue.min.css');?>">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <![endif]-->
    <link href="<?=base_url('mapsvg/css/mapsvg.css');?>" rel="stylesheet">
    <script src="<?=base_url('mapsvg/js/jquery.js');?>"></script>
    <script src="<?=base_url('mapsvg/js/jquery.mousewheel.min.js');?>"></script>
    <script src="<?=base_url('mapsvg/js/mapsvg.min.js');?>"></script>    
    <!-- Bootstrap 3.3.5 -->
    <script type="text/javascript" src="<?=base_url('assets/js/jquery.js')?>"></script>


  </head>
  <!--
  BODY TAG OPTIONS:
  =================
  Apply one or more of the following classes to get the
  desired effect
  |---------------------------------------------------------|
  | SKINS         | skin-blue                               |
  |               | skin-black                              |
  |               | skin-purple                             |
  |               | skin-yellow                             |
  |               | skin-red                                |
  |               | skin-green                              |
  |---------------------------------------------------------|
  |LAYOUT OPTIONS | fixed                                   |
  |               | layout-boxed                            |
  |               | layout-top-nav                          |
  |               | sidebar-collapse                        |
  |               | sidebar-mini                            |
  |---------------------------------------------------------|
  -->

  <body class="hold-transition skin-blue fixed sidebar-mini pace-done">
    <!-- load -->
    <div class="pace  pace-inactive"><div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
      <div class="pace-progress-inner"></div>
    </div>
    <div class="pace-activity"></div></div>
    <!-- load / -->
      <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <a href="<?=base_url('dashboard')?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>M</b>U</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Man U</b>sers</span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
                  <img src="<?=base_url('assets/dist/img/user2-160x160.jpg')?>" class="user-image" alt="User Image">
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs"><?=$nama_user?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                    <img src="<?=base_url('assets/dist/img/user2-160x160.jpg')?>" class="img-circle" alt="User Image">
                    <p>
                      <?=$nama_user?> 
                      <small>Member since  2017</small>
                    </p>
                  </li>
                  <!-- Menu Body -->
<!--                   <li class="user-body">
                    <div class="col-xs-4 text-center">
                      <a href="#">Followers</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Sales</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Friends</a>
                    </div>
                  </li>
 -->                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" onclick="load_perpage('users/profile/<?=$id_user?>');" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?=base_url('logout');?>" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
<!--               <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>
 -->            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?=base_url('assets/dist/img/user2-160x160.jpg')?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?=$nama_user?></p>
              <!-- Status -->
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>

          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
            <li class="header">MANU</li>
            <!-- Optionally, you can add icons to the links -->
            <li <?php if($this->uri->segment(1, 0)=='dashboard'){?> class="active" <?php }?> >
              <a href="#" onclick="dashboard('dashboard/dashboard');">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
            </li>
            <!-- From database -->
            <!-- TreeView -->
            <?php
              $user_access = "3,4,5";
              $this->db->select("mt.*, sm.*");
              $this->db->select("i.icon as mt_logo, sm.link as sm_link");
              $this->db->from("sub_menu sm");
              $this->db->join("menu_tree mt", "sm.id_menu = mt.id_menu", "left");
              $this->db->join("icon i", "mt.logo = i.id", "left");
              if($level_user=='administrator')
                {}else{ 
                  if(!$access){
                    $this->db->where("sm.id_sub in (1)");}else{
                    $this->db->where("sm.id_sub in (".$access.")");
                    
                  }
                }
              $this->db->where("sm.status", "Y");
              $this->db->where("mt.status", "Y");
              $this->db->group_by("sm.id_menu");
              $this->db->order_by("mt.urut", "ASC"); 
              $menu_tree = $this->db->get();
              foreach ($menu_tree->result() as $tree_menu)
              {
            ?>
            <li class="treeview<?php if(isset($_GET['p'])){ if($_GET['p']==$tree_menu->id_menu){ echo" active"; } }?>">
              <a href="<?=base_url($tree_menu->sm_link)."/?p=".$tree_menu->id_menu;?>"><i class="fa <?=$tree_menu->mt_logo?>"></i> <span><?=$tree_menu->menu?></span> <i class="fa fa-angle-left pull-right"></i></a>

              <ul class="treeview-menu">
              <!-- TreeViewmMenu -->
              <?php
                $this->db->where("id_menu", $tree_menu->id_menu); 
                if($level_user=='administrator')
                {}else{
                  if(!$access){
                    $this->db->where("id_sub in (1)");}else{
                    $this->db->where("id_sub in (".$access.")");                   
                  }
                }
                $this->db->where("status", "Y"); 
                $this->db->order_by("urut", "asc"); 
                $menu_sub = $this->db->get('sub_menu');
                foreach ($menu_sub->result() as $sub_menu)
                {
              ?>
                <li <?php if($this->uri->segment(1, 0)==$sub_menu->link){?> class="active" <?php }?>>
                  <a href="#" onclick="opened('<?=$sub_menu->link;?>', '<?=$sub_menu->id_menu;?>');"><?=$sub_menu->sub_menu?></a>
                </li>
                <!-- <li><a href="#">Link in level_user 2</a></li> -->
              <?php
                }
              ?>
              </ul>
            </li>
            <?php
              }
            ?>
            <!-- /.From datebase -->
          </ul>
          <!-- /.sidebar-menu -->

        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?=$profile->nama_aplikasi?>
            <small>( Menejemen User & Menu )</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> <?=$this->uri->segment(1, 0)?></a></li>
            <?php if(!$this->uri->segment(1, 0)){?>
            <li class="active">Here</li>
            <?php }?>
          </ol>
        </section>

        <script>
              function dashboard(link){
                      var url = "<?=site_url('"+link+"')?>";
                      var menu_ = "<?=site_url('dashboard/menu')?>";
                      $('.content').load(url);
                      $('.sidebar-menu').load(menu_);
                  }
              function opened(link, p){
                      var url = "<?=site_url('"+link+"')?>?p="+p;
                      var menu_ = "<?=site_url('"+link+"/menu')?>?p="+p;
                      $('.content').load(url);
                      $('.sidebar-menu').load(menu_);
                  }
              function opened_2(link, p){
                      var url = "<?=site_url('"+link+"')?>?p="+p;
                      $('.content').load(url);
                  }
              function opened_3(link, co, p){
                      var url = "<?=site_url('"+link+"')?>?co="+co+"&p="+p;
                      $('.content').load(url);
                  }
              function load_perpage(link){
                      var url = "<?=site_url('"+link+"')?>";
                      $('.content').load(url);
                  }
        </script>
        <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->
