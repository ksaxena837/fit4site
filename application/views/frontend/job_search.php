
<style>
.pagination > li > span {
	padding: 6px 15px !important;
	background-color: #52d3aa !important;
}
</style>
	<div class="gtco-section">
		<div class="gtco-container">

			<h3>Jobs</h3>

			<!--New Job listing table-->
			<div class="col-md-12">
			<div class="col-md-3">
			<div class="job-sidebar">
			<h4>Find Jobs For</h4>
			<div><strong>Designation</strong></div>
			<div>PHP Web Developer</div>
			<div>PHP Programmer</div>
			<div>Software Developer</div>
			<div>Software Engineer</div>
			<div>Team Leader</div>
			</div>
			</div>
      <?php if(!empty($jobs)){ ?>
						<?php foreach($jobs as $job){ if($job['job_type']=='Freelance'){ $class="Free";}else if($job['job_type']=='Part Time'){ $class="part";}else{ $class="";}?>
			<div class="col-md-9 featured-job">
			<div>
			<div class="row">
			<div class="job-main-title"><img src="<?php echo base_url();?>uploads/company/<?php echo $job['company_image'];?>" alt="company logo" class="job-logo">
			<span class="job-title"><a href="<?php echo base_url().'index.php/single-job/'. $job['id'];?>"><?php echo $job['job_title'];?></a></span>
			</div>
			</div>
			<div class="row location-row">
			<div><span class="job-type"><i class="fa fa-suitcase" aria-hidden="true"></i><?php echo $job['job_type'];?></span><span class="job-location"><i class="fa fa-map-marker" aria-hidden="true"></i><?php echo $job['location']; ?></span></div>
			</div>
			<div class="job-details">
			<div class="job-keyskills col-md-3"><p>Keyskills : </p></div>
			<div class="col-md-9"><p><?php echo $job['skills'];?></p></div>
			<div class="job-desc col-md-3"><p>Job Description : </p></div>
			<div class="col-md-9"><p><?php echo $job['job_short_description'];?></p></div>
			</div>
			</div>
			<div class="job-details-footer col-md-12">
			<div class="col-md-6">
			<div class="job-salery">Rs. <?php echo number_format($job['annual_salary'],1); ?></div>
			</div>
			<div class="col-md-6">
			<div class="job-post-author">Posted By :<span class="pic"><img src="<?php echo base_url();?>uploads/company/<?php echo $job['company_image'];?>"></span> Ritu Aggrawal<span> , Few hours ago</span></div>
			</div>
			</div>
			</div>
				<?php } ?>
				<?php } ?>
