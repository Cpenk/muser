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
    <title><?=$profile->nama_aplikasi?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?=base_url('assets/bootstrap/css/bootstrap.min.css');?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?=base_url('assets/plugins/font-awesome/css/font-awesome.min.css');?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?=base_url('assets/plugins/ionicons/css/ionicons.min.css')?>">
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

  <body class="hold-transition skin-blue sidebar-mini pace-running">
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
          <span class="logo-mini"><b>B</b>IN</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>SMK B</b>IN</span>
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
              <li class="dropdown messages-menu">
                <!-- Menu toggle button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-envelope-o"></i>
                  <span class="label label-success">4</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 4 messages</li>
                  <li>
                    <!-- inner menu: contains the messages -->
                    <ul class="menu">
                      <li><!-- start message -->
                        <a href="#">
                          <div class="pull-left">
                            <!-- User Image -->
                            <img src="<?=base_url('assets/dist/img/user2-160x160.jpg');?>" class="img-circle" alt="User Image">
                          </div>
                          <!-- Message title and timestamp -->
                          <h4>
                            Support Team
                            <small><i class="fa fa-clock-o"></i> 5 mins</small>
                          </h4>
                          <!-- The message -->
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li><!-- end message -->
                    </ul><!-- /.menu -->
                  </li>
                  <li class="footer"><a href="#">See All Messages</a></li>
                </ul>
              </li><!-- /.messages-menu -->

              <!-- Notifications Menu -->
              <li class="dropdown notifications-menu">
                <!-- Menu toggle button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-warning">10</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 10 notifications</li>
                  <li>
                    <!-- Inner Menu: contains the notifications -->
                    <ul class="menu">
                      <li><!-- start notification -->
                        <a href="#">
                          <i class="fa fa-users text-aqua"></i> 5 new members joined today
                        </a>
                      </li><!-- end notification -->
                    </ul>
                  </li>
                  <li class="footer"><a href="#">View all</a></li>
                </ul>
              </li>
              <!-- Tasks Menu -->
              <li class="dropdown tasks-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-flag-o"></i>
                  <span class="label label-danger">9</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 9 tasks</li>
                  <li>
                    <!-- Inner menu: contains the tasks -->
                    <ul class="menu">
                      <li><!-- Task item -->
                        <a href="#">
                          <!-- Task title and progress text -->
                          <h3>
                            Design some buttons
                            <small class="pull-right">20%</small>
                          </h3>
                          <!-- The progress bar -->
                          <div class="progress xs">
                            <!-- Change the css width attribute to simulate progress -->
                            <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">20% Complete</span>
                            </div>
                          </div>
                        </a>
                      </li><!-- end task item -->
                    </ul>
                  </li>
                  <li class="footer">
                    <a href="#">View all tasks</a>
                  </li>
                </ul>
              </li>
              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
                  <img src="<?=base_url('assets/dist/img/user2-160x160.jpg')?>" class="user-image" alt="User Image">
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs">Alexander Pierce</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                    <img src="<?=base_url('assets/dist/img/user2-160x160.jpg')?>" class="img-circle" alt="User Image">
                    <p>
                      Alexander Pierce - Web Developer
                      <small>Member since Nov. 2012</small>
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <li class="user-body">
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
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?=base_url('logout');?>" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>
            </ul>
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
              <p>Alexander Pierce</p>
              <!-- Status -->
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>

          <!-- search form (Optional) -->
<!--           <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
 -->          <!-- /.search form -->

          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
            <li class="header">MANU</li>
            <!-- Optionally, you can add icons to the links -->
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
            <small>Optional description</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> <?=$this->uri->segment(1, 0)?></a></li>
            <li class="active">Here</li>
          </ol>
        </section>

        <script>
              function opened(link, p){
                      var url = "<?=site_url('"+link+"')?>?p="+p;
                      var menu_ = "<?=site_url('"+link+"/menu')?>?p="+p;
                      $('.content').load(url);
                      $('.sidebar-menu').load(menu_);
                  }
        </script>
        <script>
              function opened_2(link, p){
                      var url = "<?=site_url('"+link+"')?>?p="+p;
                      $('.content').load(url);
                  }
        </script>
        <script>
              function load_perpage(link){
                      var url = "<?=site_url('"+link+"')?>";
                      $('.content').load(url);
                  }
        </script>
        <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->
