
<style>
.pagination > li > span {
	padding: 6px 15px !important;
	background-color: #52d3aa !important;
}
</style>
	<div class="gtco-section" style="padding: 1em 0;">
		<div class="gtco-container">
			<h3>Jobs</h3>

			<!--New Job listing table-->
			<div class="col-md-12 new-job-post">
				<div class="col-xs-12">
					<div class="box">
						<div class="box-header">
								<div class="box-tools">
										<form action="<?php echo base_url() ?>index.php/jobs" method="POST" id="searchList">
												<div class="input-group">
													<input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
													<div class="input-group-btn">
														<button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
													</div>
												</div>
										</form>
								</div>
						</div><!-- /.box-header -->
						<div class="box-body table-responsive no-padding">
							<table class="table table-hover">
								<tr>
									<th>No.</th>
									<th>Title</th>
									<th>Description</th>
										<th>Location</th>



									<th class="text-center">Actions</th>
								</tr>
								<?php
								if(!empty($jobs))
								{
									//pre($companies);
									$i=1;
										foreach($jobs as $record)
										{
								?>
								<tr>
									<td><?php echo $i ?></td>
									<td><?php echo $record->job_title ?></td>
									<td><?php echo $record->job_short_description ?></td>
									<!--<td><img src="<?php echo base_url();?>uploads/<?php echo $record->company_image; ?>" height="100" width="200" alt="<?php echo $record->company_name ?>"></td>-->
									<td><?php echo $record->location; ?></td>


									<td class="text-center">
											<a class="btn btn-sm btn-info" href="<?php echo base_url().'index.php/backend/jobs/editOld/'.$record->id; ?>"><i class="fa fa-pencil"></i></a>
											<a class="btn btn-sm btn-danger " href="<?php echo base_url().'index.php/backend/jobs/deleteJob/'.$record->id; ?>" onclick="return confirm('Are you sure want to delete job?');"><i class="fa fa-trash"></i></a>
									</td>
								</tr>
								<?php $i++;
										}
								}
								?>
							</table>

						</div><!-- /.box-body -->
						<div class="box-footer clearfix">
								<?php echo $this->pagination->create_links(); ?>
						</div>
					</div><!-- /.box -->
				</div>
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
