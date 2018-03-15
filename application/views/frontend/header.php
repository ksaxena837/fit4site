<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-hover-dropdown/2.2.1/bootstrap-hover-dropdown.min.js"></script>
<!-- jQuery -->
<script src="<?php echo base_url(); ?>assets/frontend/js/jquery.min.js"></script>
<!-- jQuery Easing -->
<script src="<?php echo base_url(); ?>assets/frontend/js/jquery.easing.1.3.js"></script>
<!-- Bootstrap -->
<script src="<?php echo base_url(); ?>assets/frontend/js/bootstrap.min.js"></script>
	<div class="gtco-loader"></div>

	<div id="page">
	<nav class="gtco-nav" role="navigation">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-2">
					<div id="gtco-logo"><a href="<?php echo site_url('/');?>"><img src="<?php echo site_url();?>assets/frontend/images/transparent-logo.png" alt="site-logo" style="width:150px;"></a></div>
				</div>
				<?php  $pagenameurl = $this->uri->segment(1); ?>
				<div class="col-xs-7 text-center menu-1">
					<ul>
						<li class=""><a href="<?php echo base_url();?>backend/profile/activity">Interior Wall</a></li>
						<li class=""><a href="<?php echo base_url();?>backend/profile/getF4SGallery">F4S Docs</a></li>
						<li class=""><a href="<?php echo base_url();?>backend/memberlist">Members</a></li>
						<li class=""><a href="<?php echo base_url();?>backend/sitegroup">Groups</a></li>
						<?php if($this->session->userdata('isLoggedIn') && $this->session->userdata('role')!=ROLE_CLIENT) { ?>

						<li class=""><a href="<?php echo base_url();?>backend/jobs">Job Dashboard</a></li>
						<li class=""><a href="<?php echo base_url();?>backend/company">Company</a></li>
						<li class=""><a href="<?php echo base_url();?>backend/jobs/addNew">Post a Job</a></li>
						<li class=""><a href="<?php echo base_url();?>store">Shop Dashboard</a></li>
						<?php } ?>
						<li class=""><a href="<?php echo base_url();?>featured-job">Jobs</a></li>
						<li class=""><a href="<?php echo base_url();?>shop">Shop home</a></li>


					</ul>




				</div>
				<div class="col-xs-3 text-right hidden-xs menu-2 header-right">
					<ul>
    <?php if(!empty($this->session->userdata('userId'))){ ?>
	  <div class="dropdown dashboard-dropdown">
      <?php if(!empty($userprofile[0]->profile_image)) {?>
	  <li class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"><a href="#"><span class="user-name"><?php echo $userprofile[0]->name; ?></span><span class="user-pic"><img src="<?php echo base_url();?>uploads/profile/profile_thumb/<?php echo $userprofile[0]->profile_image;?>" alt="user-img"></span></a>
		</li>
  <?php }else{ ?>
    <li class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"><a href="#"><span class="user-name"><?php echo $userprofile[0]->name; ?></span><span class="user-pic"><img src="http://cash.infiniteloopcorp.com/construction/assets/frontend/images/dummyuser.png" alt="user-img"></span></a>
    </li>
  <?php } ?>
  <ul class="dropdown-menu" style="top: 50px;background: #000; left: 45%;">
    <li class="dropdown-main-menu"><a href="#">Activity</a>

	</li>

		<li  class="dropdown-main-menu"><a href="#">Profile</a>
		<ul class="dropdown-sub-menu">
        <li><a href="<?php echo base_url();?>backend/profile">View</a></li>
        <li><a href="<?php echo base_url();?>backend/profile/editprofile">Edit</a></li>
          </ul>
		</li>

		<li class="dropdown-main-menu"><a href="<?php echo base_url();?>backend/message">Messages</a>
		<ul class="dropdown-sub-menu">
				<li><a href="<?php echo base_url();?>backend/message">Inbox</a></li>
				<li><a href="<?php echo base_url();?>backend/message">Starred</a></li>
				<li><a href="<?php echo base_url();?>backend/message/sentMessage">Sent</a></li>
				<li><a href="<?php echo base_url();?>backend/message/composeMessage">Compose</a></li>
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
		<li class="dropdown-main-menu"><a href="<?php echo base_url();?>backend/profile/getF4sDocument">F4S Docs</a>
		<ul class="dropdown-sub-menu">
				<li><a href="<?php echo base_url();?>backend/profile/getF4SGallery">My F4S docs</a></li>
				<li><a href="#">Upload</a></li>
				  </ul>
		</li>
		<li class="dropdown-main-menu"><a href="<?php echo base_url();?>backend/profile/editprofile#location">Update Location</a>
		</li>
		<li class="dropdown-main-menu"><a href="<?php echo base_url();?>backend/settings">Settings</a>
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

		</div>
	</nav>

	<?php if($pagenameurl=='featured-job' || $pagenameurl=='search-job') {?>
	<header id="gtco-header" class="gtco-cover gtco-cover-sm joblisting" role="banner" style="background-image:url(<?php echo base_url();?>assets/frontend/images/listing/bg-banner1.jpg);">
    <div class="header-overlay">
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12 text-center">
					<div class="display-t">
						<div class="display-tc animate-box" data-animate-effect="fadeIn">
							<h1>Job Listings</h1>
							<h2>Show all Job Listings</h2>
							<div class="job-search-form">
								<form class="form-inline" action="<?php echo base_url();?>index.php/search-job" method="post">
								  <div class="form-group">
									<div class="input-group">
										<div class="input-group-addon" style="border-radius: 3px 0px 0px 3px;"><i class="icon-search"></i></div>
										<input type="text" class="form-control" value="<?php echo set_value('match1'); ?>" name="match1" placeholder="Job title, skills, or company">
									</div>
								  </div>
								  <div class="form-group" style="border-left: 1px solid #ddd;">
									<div class="input-group">
										<div class="input-group-addon"><i class="icon-location"></i></div>
										<input type="text" class="form-control" value="<?php echo set_value('match2'); ?>" name="match2" placeholder="City, state or zip">
									</div>
								  </div>
								  <button type="submit" class="findjob" style="border-radius: 0px 3px 3px 0px;">Find jobs</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>
	</header>
	<?php } elseif($pagenameurl=='backend') { ?>
          	<header id="gtco-header" class="gtco-cover backend-header" role="banner" style="background-image:url(<?php echo base_url();?>/assets/frontend/images/backend-banner.jpg);">
		<div class="header-overlay">
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center">
					<div class="display-t">
						<div class="display-tc animate-box" data-animate-effect="fadeIn">
							<h2><?php echo ucfirst($page_title); ?></h2>
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>
	</header>

<?php }else{ ?>

	<header id="gtco-header" class="gtco-cover" role="banner" style="background-image:url(<?php echo base_url();?>/assets/frontend/images/home-banner.jpg);">
		<div class="header-overlay">
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center">
					<div class="display-t">
						<div class="display-tc animate-box" data-animate-effect="fadeIn">
							<h1><?php echo ucfirst($page_title); ?></h1>
							<h2>Free html5 templates Made by <a href="<?php echo site_url('/'); ?>" target="_blank">FIT4SITE</a></h2>
							<p><a href="#" class="btn btn-default">Get Started</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>
	</header>
<?php } ?>
