
	<div class="gtco-section user-profile-page" id="editprofile">


		<div class="gtco-container user-profile-section">
			<!--Profile section-->
			<div class="col-md-8 new-job-post">
				<div class="profile-content">
					<form role="form" action="<?php echo base_url() ?>backend/profile/editprofile" method="post" enctype="multipart/form-data">
							<div class="box-body">
								<div class="row">
										<div class="col-md-12">
												<div class="form-group">
														<label for="inputname">Full name/Business name	(required)</label>
														<input type="text" class="form-control" id="inputname" placeholder="Name" name="username" maxlength="50" required value="<?php echo $userprofile[0]->name; ?>">
												</div>
										</div>
								</div>
								<div class="row">
									<div class="col-md-12">
											<label >Profile Image</label>

													<img id="previewimage" onclick="$('#uploadFile').click();" src="<?php echo base_url();?>uploads/profile/profile_thumb/<?php echo ($userprofile[0]->profile_image)?$userprofile[0]->profile_image:'';?>" style="cursor: pointer;height: 150px;width: 150px;position: relative;z-index: 10;"/>
													<input type="file" id="uploadFile" name="userfile" style="position: absolute; margin: 0px auto; visibility: hidden;" accept="image/*" />
													<div style="margin-top: 0px; color: red;"><?= form_error('userfile'); ?></div>
													<input type="hidden" name="old_profile_image" value="<?php echo $userprofile[0]->profile_image;?>" >

									</div>
								</div>
								<div class="row">
										<div class="col-md-12">
												<label for="inputname">Type</label>
												<select class="form-control" id="role" name="role">
														<option value="0">Select Role</option>
														<?php
														if(!empty($roles))
														{
																foreach ($roles as $rl)
																{
																		?>
																		<option value="<?php echo $rl->roleId; ?>" <?php if($rl->roleId == $userprofile[0]->roleId) {echo "selected=selected";} ?>><?php echo $rl->role ?></option>
																		<?php
																}
														}
														?>
												</select>
										</div>
								</div>
								<div class="row">
										<div class="col-md-12">
												<div class="form-group">
														<label for="inputnotes">About</label>
														<textarea rows="4" cols="50" class="form-control" id="inputnotes" name="usernotes" placeholder="Notes" ><?php echo $userprofile[0]->notes; ?></textarea>
												</div>
										</div>
								</div>
									<div class="row">
											<div class="col-md-12">
													<div class="form-group">
															<label for="inputeducation">Education</label>
															<input type="text" class="form-control" id="inputeducation" placeholder="Education" name="usereducation" maxlength="50"  value="<?php echo $userprofile[0]->education; ?>">
													</div>
											</div>
									</div>
									<div class="row" id="location">
											<div class="col-md-12">
													<div class="form-group">
															<label for="inputlocation">Location</label>
															<input type="hidden" class="form-control" placeholder="Location" id="userlocation" name="userlocation" maxlength="50"  value="<?php echo $userprofile[0]->location; ?>">
															<input type="hidden" name="lat" id="lat" value="<?php echo ($userprofile[0]->lat!='')?$userprofile[0]->lat:'';?>">
															<input type="hidden" name="lng" id="lng" value="<?php echo ($userprofile[0]->lng!='')?$userprofile[0]->lng:'';?>" >
															<input id="searchInput" class="form-control" type="text" value="<?php echo ($userprofile[0]->location!='')?$userprofile[0]->location:'';?>" placeholder="Enter a location">
															<div class="map" id="map" style="width: 100%; height: 300px;"></div>
													</div>
											</div>
									</div>

									<div class="row">
											<div class="col-md-12">
													<div class="form-group">
															<label for="inputskills">Skills</label>
															<input type="text" class="form-control" id="inputskills" placeholder="Skills" name="userskills" maxlength="50"  value="<?php echo $userprofile[0]->skills; ?>">
													</div>
											</div>
									</div>

									<div class="row">
											<div class="col-md-12">
													<div class="form-group">
															<label for="inputemail">Email</label>
															<input type="email" class="form-control" id="inputemail" placeholder="Email" name="useremail" maxlength="50"  value="<?php echo $userprofile[0]->email; ?>">
													</div>
											</div>
									</div>

									<div class="row">
											<div class="col-md-12">
													<div class="form-group">
															<label for="inputmobile">Mobile</label>
															<input type="text" class="form-control" id="inputmobile" placeholder="Mobile" name="usermobile" maxlength="50"  value="<?php echo $userprofile[0]->mobile; ?>">
													</div>
											</div>
									</div>
							</div><!-- /.box-body -->

							<div class="box-footer">
									<input type="submit" class="btn btn-primary" value="Submit" />
									<input type="reset" class="btn btn-default" value="Reset" />
							</div>
					</form>
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
