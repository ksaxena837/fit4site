
<style>
.pagination > li > span {
	padding: 6px 15px !important;
	background-color: #52d3aa !important;
}
</style>
	<div class="gtco-section">
		<div class="gtco-container">
			<div class="col-md-12 job-banner">
			<img src="http://cash.infiniteloopcorp.com/construction/assets/frontend/images/postjob.png" alt="job-banner">
			</div>
			<h3>Jobs</h3>

			<!--New Job listing table-->
			<div class="col-md-12 new-job-post">
				<form role="form" id="addCompany" action="<?php echo base_url() ?>index.php/backend/jobs/editJob" method="post" role="form" enctype="multipart/form-data">
					<input type="hidden" name="id" value="<?php echo $job[0]->id;?>" />
						<div class="box-body">
							<div class="row">
							<div class="col-md-12">
								<div class="form-group">
										<label for="job_type_id">Company</label>
										<select class="form-control required" name="company_id">
											<option value=''>Select Company</option>
											<?php if(!empty($companylist)){ foreach($companylist as $company){ ?>
											<option <?php echo ($company['id']==$job[0]->company_id)?'selected':''; ?> value="<?php echo $company['id'];?>"><?php echo $company['company_name'];?></option>
										<?php } } ?>
										</select>
								</div>
							</div>
						</div>
								<div class="row">
										<div class="col-md-6">
												<div class="form-group">
														<label for="job_title">Title</label>
															<input type="text" class="form-control required" id="job_title" value="<?php echo $job[0]->job_title;?>" name="job_title" maxlength="500">
												</div>

										</div>
										<div class="col-md-6">
												<div class="form-group">
														<label for="location">Location</label>
														<input type="text" class="form-control required " id="location" name="location" value="<?php echo $job[0]->location;?>" maxlength="300">
												</div>
										</div>

								</div>

								<div class="row">

									<input id="searchInput" class="form-control" type="text" value="<?php echo $job[0]->location;?>" placeholder="Enter a location">
									<div class="map" id="map" style="width: 100%; height: 300px;"></div>

								</div>
								<div class="row">
											<div class="col-md-6">
													<label for="location">Latitude</label>
												<input type="text" class="form-control" name="lat" readonly="" value="<?php echo $job[0]->lat;?>" id="lat">

											</div>
											<div class="col-md-6">
													<label for="location">Longitude</label>
												<input type="text" class="form-control" name="lng" readonly="" value="<?php echo $job[0]->lng;?>" id="lng">
											</div>
								</div>

								<div class="row">

									<div class="col-md-12">
											<div class="form-group">
													<label for="job_short_description">Job Short Description</label>
													<textarea class="required form-control" name="job_short_description" id="job_short_description" ><?php echo $job[0]->job_short_description;?></textarea>
											</div>
									</div>
								</div>

								<div class="row">
										<div class="col-md-3">
												<div class="form-group">
														<label for="job_title">Annual Salary</label>
															<input type="text" class="form-control required" id="annual_salary"  name="annual_salary" maxlength="500" value="<?php echo $job[0]->annual_salary;?>">
												</div>

										</div>
										<div class="col-md-3">
												<div class="form-group">
														<label for="location">Experience</label>
														<input type="text" class="form-control required " id="experience" name="experience" maxlength="300" value="<?php echo $job[0]->experience;?>">
												</div>
										</div>
										<div class="col-md-3">
												<div class="form-group">
														<label for="location">Qulalification</label>
														<input type="text" class="form-control required " id="qualification" name="qualification" maxlength="300" value="<?php echo $job[0]->qualification;?>">
												</div>
										</div>
										<div class="col-md-3">
												<div class="form-group">
														<label for="skills">Skills</label>
														<input type="text" class="form-control required " id="skills" name="skills"  value="<?php echo $job[0]->skills;?>">
												</div>
										</div>

								</div>

								<div class="row">
										<div class="col-md-6">
												<div class="form-group">
														<label for="job_category_id">Job Category</label>

														<select class="form-control required" name="job_category_id">
															<option value=''>Select Job Category</option>
															<?php if(!empty($jobcategories)){ foreach($jobcategories as $j_category){ ?>
															<option <?php echo ($job[0]->job_category_id==$j_category['id'])?'selected':''; ?> value="<?php echo $j_category['id'];?>"><?php echo $j_category['name'];?></option>
														<?php } } ?>
														</select>
												</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
													<label for="job_type_id">Job Type</label>

													<select class="form-control required" name="job_type_id">
														<option value=''>Select Job Category</option>
														<?php if(!empty($jobtypes)){ foreach($jobtypes as $j_type){ ?>
														<option <?php echo ($job[0]->job_type_id==$j_type['id'])?'selected':''; ?> value="<?php echo $j_type['id'];?>"><?php echo $j_type['name'];?></option>
													<?php } } ?>
													</select>
											</div>
										</div>

								</div>
								<div class="row">

									<div class="form-group">
											<label class="col-md-2 control-label">Featured Image<span class="text-danger">*</span></label>
											<div class="col-md-7">
													<img id="previewimage" onclick="$('#uploadFile').click();" src="<?php echo base_url();?>uploads/job/<?php echo $job[0]->featured_image; ?>" style="cursor: pointer;height: 210px;width: 210px;position: relative;z-index: 10;"/>
													<input type="file" id="uploadFile" name="userfile" style="position: absolute; margin: 0px auto; visibility: hidden;" accept="image/*" />
													<div style="margin-top: 0px; color: red;"><?= form_error('userfile'); ?></div>
											</div>
											<input type="hidden" name="old" value="<?php echo $job[0]->featured_image; ?>" />
									</div>
									<!--<div class="col-md-6">
										<div class="form-group">


											<label>Company Logo</label>
											<div class="input-group">
													<span class="input-group-btn">
															<span class="btn btn-primary btn-file">
																	Browse… <input type="file" id="companylogo" name="companylogo">
															</span>
													</span>
													<input type="text" class="form-control" readonly>
											</div>
											<input type="hidden" name="oldlogo" value="<?php echo $job[0]->company_logo; ?>" />
											<img id='companylogo' src="<?php echo base_url();?>uploads/job/<?php echo $job[0]->company_logo; ?>"/>

										</div>
									</div>-->
								</div>
								<div class="row">
									<div class="col-md-12">
											<div class="form-group">
													<label for="job_description">Job Description</label>
													<textarea class="required form-control" name="job_description" id="editor1" ><?php echo $job[0]->job_description;?></textarea>
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
			<!--end of New Job listing table-->




		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyDSrb3rVgMSRK4IVwGcc8gk3oXMxBqozAo"></script>
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
	   var latlng = new google.maps.LatLng(28.5355161,77.39102649999995);
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
	   document.getElementById('location').value = address;
	   document.getElementById('lat').value = lat;
	   document.getElementById('lng').value = lng;
	}
	google.maps.event.addDomListener(window, 'load', initialize);
	</script>
