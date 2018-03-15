

	<div class="gtco-loader"></div>

	<div id="page">
	<nav class="gtco-nav" role="navigation">
		<div class="gtco-container">
			<div class="row">
				<div class="col-xs-2">
					<div id="gtco-logo"><a href="<?php echo site_url('/');?>">Fit4Site</a></div>
				</div>
				<?php  $pagenameurl = $this->uri->segment(1); ?>
				<div class="col-xs-7 text-center menu-1">
					<ul>
						<li class="<?php echo ($pagenameurl=='')?'active':'';?>"><a href="<?php echo base_url();?>">Home</a></li>
						<li class="<?php echo ($pagenameurl=='about-us')?'active':'';?>"><a href="<?php echo base_url();?>index.php/about-us">About</a></li>
						<li class="<?php echo ($pagenameurl=='portfolio')?'active':'';?>"><a href="<?php echo base_url();?>index.php/portfolio">Portfolio</a></li>
						<?php if($this->session->userdata('isLoggedIn') && $this->session->userdata('role')==ROLE_CLIENT) { ?>
						<li class="<?php echo ($pagenameurl=='shop')?'active':'';?>"><a href="<?php echo base_url();?>index.php/shop">Shop</a></li>
					<?php } ?>
						<li class="<?php echo ($pagenameurl=='featured-job' || ($pagenameurl=='single-job'))?'active':'';?>"><a href="<?php echo base_url();?>index.php/featured-job">Jobs</a></li>
						<li class="<?php echo ($pagenameurl=='our-services')?'active':'';?>">
							<a href="<?php echo base_url();?>index.php/our-services">Services</a>
						</li>

						<li class="<?php echo ($pagenameurl=='contact-us')?'active':'';?>"><a href="<?php echo base_url();?>index.php/contact-us">Contact</a></li>
					</ul>
				</div>
				<div class="col-xs-3 text-right hidden-xs menu-2">
					<ul>

						<?php if(!empty($this->session->userdata('userId'))){ ?>
						<li class="btn-cta"><a href="<?php echo base_url();?>index.php/loginMe"><span>Dashoard</span></a></li>
						<li class="btn-cta"><a href="<?php echo base_url();?>index.php/logout"><span>Logout</span></a></li>
					<?php } else{ ?>
						<li class="btn-cta"><a href="<?php echo base_url();?>index.php/loginMe"><span>Login</span></a></li>
						<li class="btn-cta"><a href="<?php echo base_url();?>index.php/registerMe"><span>Register</span></a></li>
					<?php } ?>
					</ul>
				</div>
			</div>

		</div>
	</nav>

	<?php if($pagenameurl=='featured-job' || $pagenameurl=='search-job') {?>
	<header id="gtco-header" class="gtco-cover gtco-cover-sm joblisting" role="banner" style="background-image:url(<?php echo base_url();?>assets/frontend/images/listing/bg-banner1.jpg);">

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
	</header>
<?php } elseif ($pagenameurl=='shop') {?>
	<header id="gtco-header" class="gtco-cover gtco-cover-sm shoplisting" role="banner" style="background-image:url(http://kute-themes.com/html/xshop/html/assets/images/slide-home3/slide6.jpg);">

		<div class="gtco-container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center">
					<div class="display-t">
						<div class="display-tc animate-box" data-animate-effect="fadeIn">
						<h1><?php echo ucfirst($page_title); ?></h1>
							<h2>Show all Products</h2>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

<?php }else if($pagenameurl=='single-job') { ?>

<?php ?>
		<header id="gtco-header" class="gtco-cover gtco-cover-sm joblisting" role="banner" style="background-image:url(<?php echo base_url();?>assets/frontend/images/listing/single-job.jpg);">

			<div class="gtco-container">
				<div class="row">
					<div class="col-md-12 text-center">
						<div class="display-t">
							<div class="display-tc animate-box" data-animate-effect="fadeIn">
								<h1><?php echo ucfirst($page_title); ?></h1>
								<h2>Apply For a Job</h2>

							</div>
						</div>
					</div>
				</div>
			</div>
		</header>

<?php }else if($pagenameurl=='cart' || $pagenameurl=='checkout') { ?>

<?php ?>
		<header id="gtco-header" class="gtco-cover gtco-cover-sm joblisting" role="banner" style="background-image:url(<?php echo base_url();?>assets/frontend/images/listing/single-job.jpg);">

			<div class="gtco-container">
				<div class="row">
					<div class="col-md-12 text-center">
						<div class="display-t">
							<div class="display-tc animate-box" data-animate-effect="fadeIn">
								<h1><?php echo ucfirst($page_title); ?></h1>
								<h2>Shop Product</h2>

							</div>
						</div>
					</div>
				</div>
			</div>
		</header>
<?php }else{ ?>

	<header id="gtco-header" class="gtco-cover" role="banner" style="background-image:url(<?php echo base_url();?>/assets/frontend/images/img_bg_1.jpg);">
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
	</header>
<?php } ?>
