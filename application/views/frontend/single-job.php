

	<div class="single-job-listing">
		<div class="gtco-container">
			<div class="single-page-content-box">
				<div class="page-header company-header-box">
					<div class="media">
						<div class="media-left">
							<img src="<?php echo base_url();?>uploads/company/<?php echo $job->company_image;?>" alt="<?php echo $job->company_name;?>">

						</div>
						<div class="media-body">
							<h3><?php echo $job->job_title;?></h3>
						</div>
					</div>

				</div>
				<!--end of page-header-->

				<div class="company-content-box">
					<p class="desc"><?php echo $job->job_short_description; ?></p>

					<br/>
					<div class="row company-info">
						<div class="col-sm-4">
							<div class="media">
								<div class="media-left"><i class="icon-location"></i></div>
								<div class="media-body"><?php echo $job->location;?></div>
							</div>

							<div class="media">
								<div class="media-left"><i class="icon-clock"></i></div>
								<div class="media-body"> 40h / week</div>
							</div>

						</div>
						<!--end of left side section-->

						<div class="col-sm-4">
							<div class="media">
								<div class="media-left"><i class="icon-shopping-bag"></i></div>
								<div class="media-body"><?php echo $job->job_type;?></div>
							</div>

							<div class="media">
								<div class="media-left"><i class="icon-tag"></i></div>
								<div class="media-body"> <?php echo $job->experience;?></div>
							</div>

						</div>
						<!--end of middle side section-->

						<div class="col-sm-4">
							<div class="media">
								<div class="media-left"><i class="icon-print"></i></div>
								<div class="media-body">$ <?php echo $job->annual_salary;?></div>
							</div>

							<div class="media">
								<div class="media-left"><i class="icon-briefcase"></i></div>
								<div class="media-body"> <?php echo $job->qualification;?></div>
							</div>

						</div>
						<!--end of Right side section-->

					</div>


					<div class="content-box-footer">
						<div class="row">
							<div class="col-sm-6">
								<ul class="socialicons list-unstyled list-inline">
								<li><a href="#"><i class="icon-facebook"></i></a></li>
								<li><a href="#"><i class="icon-twitter"></i></a></li>
								<li><a href="#"><i class="icon-linkedin"></i></a></li>
								<li><a href="#"><i class="icon-mail"></i></a></li>
								</ul>
							</div>

							<div class="col-sm-6">
								<?php
								 	if($appliedstatus==='APPLIED'){?>
										<a href="javascript:void(0)" class="btn btn-success pull-right" style="border-radius:3px;" disabled="disabled"><?php echo $appliedstatus;?></a>

									<?php } else{ ?>
											<a href="<?php echo base_url().'index.php/appliedjob/?jid='.$job->id.'&c_id='.$job->company_id.'&u_id=12';?>" class="btn btn-success pull-right" style="border-radius:3px;" >APPLY NOW</a>
									<?php } ?>

								<!--<button type="button" class="btn btn-success pull-right" style="border-radius:3px;"> APPLY NOW</button>
								<button type="button" class="btn btn-warning pull-right" style="border-radius:3px;"> APPLY WITH LINKEDIN</button>-->
							</div>
							<!--end of right-section-->

						</div>
					</div>
					<!--end of content-box-footer-->

				</div>
				<!--end of comany content box-->



			</div>
			<!--end of single-page-content-box-->
		</div>
		<!--end of container-->
	</div>
	<!--end of single-job-listing-page-->



	<section class="about-company">
	<div class="container">
		<div class="col-sm-12">
		<?php echo $job->job_description;?>
	</div>
	<!--end of container-->
	</section>
	<!--end of about company section-->

	<style>
	.joblisting:before{
		position:absolute;
		content:"";
		width:100%;
		height:100%;
		top:0px;
		left:0px;
		background-color:rgba(0, 0, 0, 0.6);
	}
	.single-job-listing{
		position:Relative;
		clear:both;
	}
	.single-page-content-box {
		background: #ffffff;
		padding: 25px;
		clear: both;
		position: relative;
		z-index: 10000;
		top: -150px;
		border-radius: 3px;
		padding-bottom: 0px;
		border-left: 1px solid #f4f4f4;
		border-right: 1px solid #f4f4f4;
	}
	.company-header-box{
		margin-top:0px;
	}
	.company-header-box .media .media-body{
		vertical-align:middle;
	}
	.company-header-box .media .media-body h3 {
		margin-bottom: 0px;
		color: #555;
		font-size: 22px;
	}
	.socialicons{

	}
	.socialicons a {
		border: 1px solid #52d3aa;
		width: 35px;
		height: 35px;
		float: left;
		line-height: 35px;
		text-align: center;
		border-radius: 1px;
		margin-right: -5px;
	}
	.socialicons a:hover,
	.socialicons a:focus{
		background-color:#52d3aa;
		color:#fff;
	}
	.content-box-footer{
	    background: #eee;
		margin-left: -25px;
		margin-right: -25px;
		padding: 25px;
		margin-top: 35px;
		border-radius: 0px 0px 3px 3px;
	}
	.about-company{
		margin-top:-100px
	}
	.about-company h2 {
		color: #444;
		font-size: 30px;
		border-bottom: 1px solid #eee;
		padding-bottom: 10px;
		letter-spacing: 2px;
	}

	</style>


	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Carousel -->
	<script src="js/owl.carousel.min.js"></script>
	<!-- countTo -->
	<script src="js/jquery.countTo.js"></script>
	<!-- Magnific Popup -->
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/magnific-popup-options.js"></script>
	<!-- Main -->
	<script src="js/main.js"></script>


	</body>
</html>
