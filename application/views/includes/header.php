<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title><?php echo $pageTitle; ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- FontAwesome 4.3.0 -->
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/jquery-te-1.4.0.css" rel="stylesheet" type="text/css" />

    <link href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />


    <style>
    	.error{
    		color:red;
    		font-weight: normal;
    	}



      .btn-file {
    position: relative;
    overflow: hidden;
}
.btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    background: white;
    cursor: inherit;
    display: block;
}

#img-upload{
    width: 200px;
    height:100px;
}

    </style>
    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url(); ?>assets/js/jQuery-2.1.4.min.js"></script>
    <script type="text/javascript">
        var baseURL = "<?php echo base_url(); ?>";
    </script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo base_url(); ?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>Fit4Site</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg">Fit4Site</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo base_url();?>assets/dist/img/user2-160x160.jpg" class="user-image" alt="User Image"/>
                  <span class="hidden-xs"><?php echo $name; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?php echo base_url();?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
                    <p>
                      <?php echo $name; ?>
                      <small><?php echo $role_text;?></small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="<?php echo base_url(); ?>index.php/loadChangePass" class="btn btn-default btn-flat"><i class="fa fa-key"></i> Change Password</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo base_url(); ?>index.php/logout" class="btn btn-default btn-flat"><i class="fa fa-sign-out"></i> Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
          <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url();?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $name; ?></p>

          <a href="<?php echo base_url();?>/index.php/user/profileStatus/<?php echo (get_phrase()); ?>"><i class="fa fa-circle text-<?php echo (get_phrase()=='0')?'success' :'warning'; ?>"></i> <?php echo (get_phrase()=='0')?'Online' :'Offline'; ?></a>
        </div>
      </div>
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
              <a href="<?php echo base_url(); ?>index.php/dashboard">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span></i>
              </a>
            </li>
            <!--<li class="treeview">
              <a href="#" >
                <i class="fa fa-plane"></i>
                <span>New Task</span>
              </a>
            </li>
            <li class="treeview">
              <a href="#" >
                <i class="fa fa-ticket"></i>
                <span>My Tasks</span>
              </a>
            </li>-->
            <?php
            if($role == ROLE_ADMIN)
            {
            ?>
            <li class="treeview">
              <a href="<?php echo base_url();?>index.php/portfolio/portfolioListing" >
                <i class="fa fa-thumb-tack"></i>
                <span>Portfolios</span>
              </a>
            </li>
            <li class="treeview">
              <a href="<?php echo base_url();?>index.php/profile" >
                <i class="fa fa-upload"></i>
                <span>Profile</span>
              </a>
            </li>
            <li class="treeview">
              <a href="<?php echo base_url();?>index.php/company" >
                <i class="fa fa-upload"></i>
                <span>Companies</span>
              </a>
            </li>
            <li class="treeview">
              <a href="<?php echo base_url();?>index.php/jobs" >
                <i class="fa fa-upload"></i>
                <span>Jobs</span>
              </a>
            </li>
            <li class="treeview">
              <a href="#">  <i class="fa fa-thumb-tack"></i> Shops</a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url();?>index.php/account/product-list"> Products</a></li>
                <li><a href="<?php echo base_url();?>index.php/account/add-category"> Category</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="<?php echo base_url(); ?>index.php/userListing">
                <i class="fa fa-users"></i>
                <span>Users</span>
              </a>
            </li>
            <?php
            }
            if($role == ROLE_INDIVIDUAL)
            {
            ?>
            <li class="treeview">
              <a href="<?php echo base_url();?>index.php/portfolio/portfolioListing" >
                <i class="fa fa-thumb-tack"></i>
                <span>Portfolios</span>
              </a>
            </li>
            <li class="treeview">
              <a href="<?php echo base_url();?>index.php/profile" >
                <i class="fa fa-upload"></i>
                <span>Profile</span>
              </a>
            </li>
            <li class="treeview">
              <a href="<?php echo base_url();?>index.php/company" >
                <i class="fa fa-upload"></i>
                <span>Companies</span>
              </a>
            </li>
            <li class="treeview">
              <a href="<?php echo base_url();?>index.php/jobs" >
                <i class="fa fa-upload"></i>
                <span>Jobs</span>
              </a>
            </li>
            <li class="treeview">
              <a href="<?php echo base_url();?>index.php/customGroup" >
                <i class="fa fa-upload"></i>
                <span>Groups</span>
              </a>
            </li>


        <?php  }
            if($role == ROLE_SUPLIER)
            {
            ?>

            <li class="treeview">
              <a href="<?php echo base_url();?>backend/profile/editprofile" >
                <i class="fa fa-upload"></i>
                <span>Profile</span>
              </a>
            </li>
            <li class="treeview">
              <a href="#">  <i class="fa fa-thumb-tack"></i> Shops</a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url();?>account/product-list"> Products</a></li>
                <li><a href="<?php echo base_url();?>account/add-category"> Category</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">  <i class="fa fa-thumb-tack"></i> Store</a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url();?>store">Add Store</a></li>
                <li><a href="<?php echo base_url();?>sale">Sales Report</a></li>
                <li><a href="<?php echo base_url();?>sale/shipped">Shipped Status</a></li>
              </ul>
            </li>

        <?php   }?>
      <?php  if($role == ROLE_CLIENT)
        {
        ?>

        <li class="treeview">
          <a href="<?php echo base_url();?>index.php/profile" >
            <i class="fa fa-upload"></i>
            <span>Profile</span>
          </a>
        </li>
        <li><a href="<?php echo base_url();?>index.php/user/order"><i class="fa fa-upload"></i><span>Orders</span></a></li>

    <?php   }?>

    <?php  if($role == ROLE_COMPANY)
      {
      ?>

      <li class="treeview">
        <a href="<?php echo base_url();?>index.php/portfolio/portfolioListing" >
          <i class="fa fa-thumb-tack"></i>
          <span>Portfolios</span>
        </a>
      </li>
      <li class="treeview">
        <a href="<?php echo base_url();?>index.php/profile" >
          <i class="fa fa-upload"></i>
          <span>Profile</span>
        </a>
      </li>
      <li class="treeview">
        <a href="<?php echo base_url();?>index.php/company" >
          <i class="fa fa-upload"></i>
          <span>Companies</span>
        </a>
      </li>
      <li class="treeview">
        <a href="<?php echo base_url();?>index.php/jobs" >
          <i class="fa fa-upload"></i>
          <span>Jobs</span>
        </a>
      </li>
      <li class="treeview">
        <a href="#" >
          <i class="fa fa-upload"></i>
          <span>About Us</span>
        </a>
      </li>
      <li class="treeview">
        <a href="<?php echo base_url();?>index.php/customGroup" >
          <i class="fa fa-upload"></i>
          <span>Groups</span>
        </a>
      </li>


  <?php   }?>

          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
