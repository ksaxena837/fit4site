
<style>
.pagination > li > span {
	padding: 6px 15px !important;
	background-color: #0a73b1 !important;
}
</style>
	<div class="gtco-section" style="padding: 1em 0;">
		<div class="gtco-container">

			<h3>Jobs</h3>

			<!--New Job listing table-->
			<div class="col-md-12 nopadding">
			<div class="col-md-3 nopadding">
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
			<?php if(!empty($jobs)){?>
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
			<?php $created_date = $job['created_at']; 
			      $currentdate = date('Y-m-d H:i:s');
				  $dteStart = new DateTime($created_date);
				  $dteEnd = new DateTime($currentdate);
				  $dteDiff  = $dteStart->diff($dteEnd); 
				  $yeardiff = $dteDiff->format("%Y");
				  $monthdiff = $dteDiff->format("%M");
				  $datediff = $dteDiff->format("%D");
				  $hourdiff = $dteDiff->format("%H");
				  $mindiff = $dteDiff->format("%I");
				  $secdiff = $dteDiff->format("%S");

			?>
			<div class="col-md-6">
			<div class="job-post-author">Posted By :<span class="pic"><img src="<?php echo base_url();?>uploads/company/<?php echo $job['company_image'];?>"></span> Ritu Aggrawal
			<span> , <?php 
			if ($yeardiff > 0) {
				echo $yeardiff.'&nbsp;years ago';
			} elseif ($monthdiff > 0){
				echo $monthdiff.'&nbsp;months ago';
			} elseif ($datediff > 0){
				echo $datediff.'&nbsp;days ago';
			} elseif ($hourdiff > 0) {
			echo $hourdiff.'&nbsp;hours ago';
			} elseif ($mindiff > 0) {
			echo $mindiff.'&nbsp;mins ago';
			} elseif ($secdiff > 0) {
			echo $secdiff.'&nbsp;sec ago';
			}
			?></span></div>
			</div>
			
			</div>
			</div>
				<?php } ?>
				<?php } ?>
			</div>
			<!--end of New Job listing table-->

<?php echo $links; ?>


		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script async defer
	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDSrb3rVgMSRK4IVwGcc8gk3oXMxBqozAo">
	</script>
	<script type="text/javascript">

	function init() {
	    navigator.geolocation.getCurrentPosition(doStuff, error, setOptions);

	}

  function setOptions(geoLoc) {
      geoLoc.enableHighAccuracy = true;
      geoLoc.timeout = 30;
      geoLoc.maximumAge = 0;
  }

	function doStuff(geoLoc) {
  		var url = window.location.href;
			if (url.indexOf('?') > -1){
			   url += '&param='+geoLoc.coords.latitude;
			}else{
			   url += '?param='+ geoLoc.coords.longitude;
			}
			window.location.href = url;
	 }

function error(geoLoc) {
  document.getElementById("error").innerHTML = "ERROR! Code: " + geoLoc.code + "; Message: " + geoLoc.message;
}

//$(document).ready(function(){
window.onload = function() {
	init();
}
//});

	</script>
