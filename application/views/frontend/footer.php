

<footer id="gtco-footer" role="contentinfo">
  <div class="gtco-container">
  <div class="row footer-top">
  <div class="col-md-4">
  <h3>Quick Links</h3>
		  <ul>
		  <li><a href="#">Home</a></li>
		   <li><a href="#">About Us</a></li>
		  <li><a href="#">Interior Wall</a></li>
			<li><a href="#">Shop</a></li>
			 <li><a href="#">Contact Us</a></li>
		 </ul>
  </div>
   <div class="col-md-4">
     <h3>Services</h3>
	 <ul>
		  <li><a href="#">Members</a></li>
		   <li><a href="#">Groups</a></li>
		  <li><a href="#">Jobs</a></li>
			<li><a href="#">Post a Job</a></li>
		 </ul>
  </div>
   <div class="col-md-4">
     <h3>Get In Touch</h3>
	 <p>FIT 4 SITE<br/>
	 E-14B, Sector 8, Noida, UP<br/>
	 +91-123456-7890
	 </p>
  </div>
  </div>
  </div>

  <div class="footer-bottom">
 <div class="gtco-container">
    <div class="row copyright">
      <div class="col-md-12">
        <p class="text-center">
          <span class="block">&copy; 2017 Fit4Site. All Rights Reserved.</span>
        </p>
      </div>
    </div>
  </div>
  </div>
</footer>
</div>

<div class="gototop js-top">
  <a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
</div>


<!-- Waypoints -->
<script src="<?php echo base_url(); ?>assets/frontend/js/jquery.waypoints.min.js"></script>
<!-- Carousel -->
<script src="<?php echo base_url(); ?>assets/frontend/js/owl.carousel.min.js"></script>
<!-- countTo -->
<script src="<?php echo base_url(); ?>assets/frontend/js/jquery.countTo.js"></script>
<!-- Magnific Popup -->
<script src="<?php echo base_url(); ?>assets/frontend/js/jquery.magnific-popup.min.js"></script>
<script src="<?php echo base_url(); ?>assets/frontend/js/magnific-popup-options.js"></script>
<!-- Main -->
<script src="<?php echo base_url(); ?>assets/frontend/js/main.js"></script>
<script src="<?php echo base_url(); ?>assets/frontend/js/xzoom.min.js"></script>
<script src="<?php echo base_url(); ?>assets/frontend/js/setup.js"></script>
<script src="<?php echo base_url(); ?>assets/frontend/js/video.js"></script>
<!--<script>
jQuery(function($) {
    var selectedClass = "";
    jQuery(".fil-cat").click(function(){
    selectedClass = $(this).attr("data-rel");
   jQuery("#portfolio").fadeTo(100, 0.1);
    jQuery("#portfolio div").not("."+selectedClass).fadeOut().removeClass('scale-anm');
  setTimeout(function() {
    jQuery("."+selectedClass).fadeIn().addClass('scale-anm');
    jQuery("#portfolio").fadeTo(300, 1);
  }, 300);

  });
/*
  jQuery(window).ready(function(){
      jQuery("#btnInit").click(initiate_geolocation);
  });*/
  initiate_geolocation();

  function initiate_geolocation() {
      navigator.geolocation.getCurrentPosition(handle_geolocation_query,handle_errors);
  }

  function handle_errors(error)
  {
      switch(error.code)
      {


          case error.PERMISSION_DENIED: alert("user did not share geolocation data");
          break;

          case error.POSITION_UNAVAILABLE: alert("could not detect current position");
          break;

          case error.TIMEOUT: alert("retrieving position timed out");
          break;

          default: alert("unknown error");
          break;
      }
  }

  function handle_geolocation_query(position){
      alert('Lat: ' + position.coords.latitude +
            ' Lon: ' + position.coords.longitude);
  }


});
</script>-->
</body>
</html>
