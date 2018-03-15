
    <link href="http://kybarg.github.io/bootstrap-dropdown-hover/assets/bootstrap-dropdownhover/css/bootstrap-dropdownhover.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-hover-dropdown/2.2.1/bootstrap-hover-dropdown.min.js"></script>
	<div class="gtco-loader"></div>

	<div id="postjob_header">
	<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
	  <a class="navbar-brand logo" href="#"><img src="http://cash.infiniteloopcorp.com/construction/assets/frontend/images/logofit4site.png" alt="site-logo"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav main-menu">
        <li class="active"><a href="#">Interior Wall</a></li>
		<li><a href="<?php echo base_url();?>backend/memberlist">Members</a></li>
    <?php if($this->session->userdata('isLoggedIn') && $this->session->userdata('role')!=ROLE_CLIENT) { ?>
        <li><a href="<?php echo base_url();?>backend/sitegroup">Groups</a></li>
        <li><a href="<?php echo base_url();?>backend/jobs">Job Dashboard</a></li>
        <li><a href="<?php echo base_url();?>backend/jobs/addNew">Post a Job</a></li>
        <ul class="hidden-main-menu">
            <li><a href="#">Create a shop</a></li>
    		    <li><a href="#">Search products</a></li>
            <li><a href="#">Video background test</a></li>
        </ul>
      <?php } ?>
		<li><a href="<?php echo base_url();?>featured-job">Jobs</a></li>

		<li><a href="<?php echo base_url();?>shop">Shop home</a></li>
		<li><a href="#" class="more-menu">...</a></li>
      </ul>

      <ul class="nav navbar-nav navbar-right">

     <?php if(!empty($this->session->userdata('userId'))){ ?>
	  <div class="dropdown dashboard-dropdown">
      <?php if(!empty($userprofile[0]->profile_image)) {?>
	  <li class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"><a href="#"><span class="user-name"><?php echo $userprofile[0]->name; ?></span><span class="user-pic"><img src="<?php echo base_url();?>uploads/profile/profile_thumb/<?php echo $userprofile[0]->profile_image;?>" alt="user-img"></span></a>
		</li>
  <?php }else{ ?>
    <li class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"><a href="#"><span class="user-name"><?php echo $userprofile[0]->name; ?></span><span class="user-pic"><img src="http://cash.infiniteloopcorp.com/construction/assets/frontend/images/dummyuser.png" alt="user-img"></span></a>
    </li>
  <?php } ?>
  <ul class="dropdown-menu" style="top: 69px; margin-right: -25%;">
    <li class="dropdown-main-menu"><a href="#">Activity</a>
		<ul class="dropdown-sub-menu">
        <li><a href="#">Personal</a></li>
        <li><a href="#">Mentions</a></li>
		<li><a href="#">Favourites</a></li>
		<li><a href="#">Groups</a></li>
		<li><a href="#">Following</a></li>
          </ul>
	</li>

		<li  class="dropdown-main-menu"><a href="#">Profile</a>
		<ul class="dropdown-sub-menu">
        <li><a href="<?php echo base_url();?>backend/profile">View</a></li>
        <li><a href="<?php echo base_url();?>backend/profile/editprofile">Edit</a></li>
          </ul>
		</li>
        <li class="dropdown-main-menu"><a href="#">Sites</a>
				<ul class="dropdown-sub-menu">
				<li><a href="#">My Sites</a></li>
				  </ul>
		</li>
		<li class="dropdown-main-menu"><a href="#">Notifications</a>
		<ul class="dropdown-sub-menu">
				<li><a href="#">Unread</a></li>
				<li><a href="#">Read</a></li>
				  </ul>
		</li>
		<li class="dropdown-main-menu"><a href="#">Messages</a>
		<ul class="dropdown-sub-menu">
				<li><a href="#">Inbox</a></li>
				<li><a href="#">Starred</a></li>
				<li><a href="#">Sent</a></li>
				<li><a href="#">Compose</a></li>
				  </ul>
		</li>
		<li class="dropdown-main-menu"><a href="#">Follow</a>
		<ul class="dropdown-sub-menu">
				<li><a href="#">Following</a></li>
				<li><a href="#">Followers</a></li>
				  </ul>
		</li>
		<li class="dropdown-main-menu"><a href="#">Groups</a>
		<ul class="dropdown-sub-menu">
				<li><a href="#">Membership</a></li>
				<li><a href="#">No pending Invite</a></li>
				<li><a href="#">Create a Group</a></li>
				  </ul>
		</li>
		<li class="dropdown-main-menu"><a href="#">F4S Docs</a>
		<ul class="dropdown-sub-menu">
				<li><a href="#">My F4S docs</a></li>
				<li><a href="#">Upload</a></li>
				  </ul>
		</li>
		<li class="dropdown-main-menu"><a href="#">Location</a>
			<ul class="dropdown-sub-menu">
				<li><a href="#">Update Location</a></li>
				  </ul>
		</li>
		<li class="dropdown-main-menu"><a href="#">Settings</a>
		<ul class="dropdown-sub-menu">
				<li><a href="#">General</a></li>
				<li><a href="#">Email</a></li>
				<li><a href="#">Delete Account</a></li>
				<li><a href="#">Profile</a></li>
				<li><a href="#">Privacy</a></li>
				  </ul>
		</li>
		<li class="dropdown-main-menu"><a href="#">Media</a>
		<ul class="dropdown-sub-menu">
				<li><a href="#">Albums</a></li>
				<li><a href="#">Photos</a></li>
				<li><a href="#">Videos</a></li>
				<li><a href="#">Documents</a></li>
				  </ul>
		</li>
		<li class="dashboard-logout"><a href="<?php echo base_url();?>logout">Log Out</a></li>
  </ul>
</div>
<?php }else{ ?>
  <li><a href="<?php echo base_url();?>index.php/loginMe"><span>Login</span></a></li>
  <li><a href="<?php echo base_url();?>index.php/registerMe"><span>Register</span></a></li>
<?php } ?>

      </ul>


    </div>
  </div>
</nav>
	</div>
