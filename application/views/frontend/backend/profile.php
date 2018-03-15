
	<div class="gtco-section user-profile-page">
			<div class="gtco-container user-profile-section">
			<!--Profile section-->
			<div class="col-md-8">
			<!--<div class="profile-header-details col-md-12"  style="background-image: url(http://www.fit4site.co.uk/fit4site/uploads/docs/restaurant.jpg);">-->
			<?php if($userprofile[0]->cover_image){ ?>
			<div class="profile-header-details profile-banner col-md-12" style="background-image:url(<?php echo base_url();?>uploads/profile/profile_cover/<?php echo $userprofile[0]->cover_image;?>);">
			  <?php } else { ?>
			  <div class="profile-banner">
				  <?php } ?>
				  <div class="edit-banner">
				  <form method="POST" enctype="multipart/form-data" id="update-banner">
				  <label>
				  <i class="fa fa-camera" aria-hidden="true"></i><input type="file" name="profile_banner" id="profile-banner" style="display: none;" >
				  </label>
				  </form>
				  </div>


				<section class="cover-content">
						<div class="user-pic col-sm-4">
							<?php if(empty($userprofile[0]->profile_image)){?>
									<img src="<?php echo base_url();?>assets/frontend/images/dummyuser.png" alt="user-pic">
							<?php }else{?>
									<img src="<?php echo base_url();?>uploads/profile/profile_thumb/<?php echo $userprofile[0]->profile_image;?>" alt="user-pic">
							<?php } ?>
						</div>
						<!--End of Profile Image-->

						<div class="col-md-8">

							<div class="users-bname">
						 			<h2><?php echo $name;?><span>, </span><small class="user-nicename">@<?php echo $role_text;?></small></h2>
						  </div>
							<div class="userlocation">
								<small><?php echo $userprofile[0]->location;?></small>
							</div>
							<div class="users-follow">
								<ul class="list-unstyled list-inline">
									<li>
										<div class="following-count text-center">	0</div>
										<h5 class="following">Following</h5>
									</li>
									<li>
										<div class="follower-count text-center">3</div>
										<h5 class="followers">Followers</h5>
									</li>
								</ul>
							</div>

							<div class="custom-switcher pull-right">
								<label class="switch online-offline">
									<input type="checkbox" id="online-offline" <?php echo ($userprofile[0]->online_status==1)?'checked':'';?>>
									<span class="slider round"></span>
								</label> <span id="onlinetext" style="position: relative;top: -15px;"><?php echo ($userprofile[0]->online_status==1)?'Available On Call':'Not Available';?></span>
							</div>


						</div>
						<!--End of Content-->
				</section>



			</div>
			<!--End of Profile Banner-->



			<div class="col-md-12 new-job-post">
				<div class="profile-content">
				<h4>Member Type</h4>
				<table class="table table-bordered">
					<tbody>
					  <tr>
						<th>Full name/Business name</th>
						<td><?php echo ucfirst($name); ?></td>
					  </tr>
					  <tr>
						<th>Type</th>
						<td><?php echo $role_text;?></td>
					  </tr>
					</tbody>
				  </table>
				</div>
			</div>
			</div>
			<!--end of profile section-->

			<!--sidebar section-->
			<div class="col-md-3 profile-sidebar">
				<div class="sidebar1">
				<a href="#"><i class="fa fa-camera" aria-hidden="true"></i>View Portfolio</a>
				</div>
				<div class="sidebar2">
				<h4><div data-address="<?php echo $userprofile[0]->location;?> " class="google-maps"></div></h4>
				</div>


			</div>
			<!--end of sidebar-->
		</div>
	</div>
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyDSrb3rVgMSRK4IVwGcc8gk3oXMxBqozAo"></script>
	<script>
	$(".google-maps").each(function () {
			var embed = "<iframe width='250' height='200' frameborder='0' scrolling='no'  marginheight='0' marginwidth='0'   src='https://maps.google.com/maps?&amp;q=" + encodeURIComponent($(this).data('address')) + "&amp;z=10&amp;output=embed&iwloc'></iframe>";
			$(this).html(embed);
	});
	</script>
	<script>
	$('document').ready(function()
	{
		function readURL(input) {
			if (input.files && input.files[0]) {
	      var reader = new FileReader();
	      reader.onload = function (e) {
	        $('#previewimage').attr('src', e.target.result);
	      }
	      reader.readAsDataURL(input.files[0]);
			}
		}
			$("#uploadFile").change(function(){
				readURL(this);
			});


			$('#online-offline').change(function(){
				if($(this).is(':checked')){
					available_status = 1;
				}
				else{
					available_status = 0;
				}

				$.ajax({
				  type: "POST",
				  data:{available_status:available_status},
				  url: "http://www.fit4site.co.uk/fit4site/index.php/user/profileStatus/"
				}).done(function( resp ) {
					if(resp!=0){ statusString = "Available On Call";}else{ statusString = "Not Available";}
					$("#onlinetext").text(statusString);
						console.log(resp);
				});
			});

	  });


	/* script */
	function initialize() {

	   var latlng = new google.maps.LatLng(<?php echo ($userprofile[0]->lat!='')?$userprofile[0]->lat:'28.535517';?>,<?php echo ($userprofile[0]->lng!='')?$userprofile[0]->lng:'77.391029';?>);
	    var map = new google.maps.Map(document.getElementById('map'), {
	      center: latlng,
	      zoom: 13
	    });
	    var marker = new google.maps.Marker({
	      map: map,
	      position: latlng,
	      draggable: true,
	      anchorPoint: new google.maps.Point(0, -29)
	   });

	    var input = document.getElementById('searchInput');
	    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
	    var geocoder = new google.maps.Geocoder();
	    var autocomplete = new google.maps.places.Autocomplete(input);
	    autocomplete.bindTo('bounds', map);
	    var infowindow = new google.maps.InfoWindow();
	    autocomplete.addListener('place_changed', function() {
	        infowindow.close();
	        marker.setVisible(false);
	        var place = autocomplete.getPlace();
	        if (!place.geometry) {
	            window.alert("Autocomplete's returned place contains no geometry");
	            return;
	        }

	        // If the place has a geometry, then present it on a map.
	        if (place.geometry.viewport) {
	            map.fitBounds(place.geometry.viewport);
	        } else {
	            map.setCenter(place.geometry.location);
	            map.setZoom(17);
	        }

	        marker.setPosition(place.geometry.location);
	        marker.setVisible(true);

	        bindDataToForm(place.formatted_address,place.geometry.location.lat(),place.geometry.location.lng());
	        infowindow.setContent(place.formatted_address);
	        infowindow.open(map, marker);

	    });
	    // this function will work on marker move event into map
	    google.maps.event.addListener(marker, 'dragend', function() {
	        geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
	        if (status == google.maps.GeocoderStatus.OK) {
	          if (results[0]) {
	              bindDataToForm(results[0].formatted_address,marker.getPosition().lat(),marker.getPosition().lng());
	              infowindow.setContent(results[0].formatted_address);
	              infowindow.open(map, marker);
	          }
	        }
	        });
	    });
	}
	function bindDataToForm(address,lat,lng){
	   document.getElementById('userlocation').value = address;
	   document.getElementById('lat').value = lat;
	   document.getElementById('lng').value = lng;
	}
	google.maps.event.addDomListener(window, 'load', initialize);
	</script>
