<style>
#searchInput {
  background-color: #fff;
  font-family: Roboto;
  font-size: 15px;
  font-weight: 300;
  margin-left: 12px;
  padding: 0 11px 0 13px;
  text-overflow: ellipsis;
  width: 50%;
  top:7px !important;
}
#searchInput:focus {
  border-color: #4d90fe;
}
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-company"></i> Job
        <small>Add / Edit Job</small>
      </h1>
    </section>

    <section class="content">

        <div class="row">
          <div class="col-md-12">
              <?php
                  $this->load->helper('form');
                  $error = $this->session->flashdata('error');
                  if($error)
                  {
              ?>
              <div class="alert alert-danger alert-dismissable">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <?php echo $this->session->flashdata('error'); ?>
              </div>
              <?php } ?>
              <?php
                  $success = $this->session->flashdata('success');
                  if($success)
                  {
              ?>
              <div class="alert alert-success alert-dismissable">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <?php echo $this->session->flashdata('success'); ?>
              </div>
              <?php } ?>

              <div class="row">
                  <div class="col-md-12">
                      <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                  </div>
              </div>
          </div>
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->



                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Job Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->

                    <form role="form" id="addCompany" action="<?php echo base_url() ?>index.php/jobs/addNewJob" method="post" role="form" enctype="multipart/form-data">
                        <div class="box-body">
                          <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                                <label for="job_type_id">Company</label>
                                <select class="form-control required" name="company_id">
                                  <option value=''>Select Company</option>
                                  <?php if(!empty($companylist)){ foreach($companylist as $company){ ?>
                                  <option value="<?php echo $company['id'];?>"><?php echo $company['company_name'];?></option>
                                <?php } } ?>
                                </select>
                            </div>
                          </div>
                        </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="job_title">Title</label>
                                          <input type="text" class="form-control required" id="job_title"  name="job_title" maxlength="500">
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="location">Location</label>
                                        <input type="text" class="form-control required " id="location" name="location" maxlength="300">
                                    </div>
                                </div>

                            </div>
                            <div class="row">

                              <input id="searchInput" class="form-control" type="text" placeholder="Enter a location">
                              <div class="map" id="map" style="width: 100%; height: 300px;"></div>

                            </div>
                            <div class="row">
                                  <div class="col-md-6">
                                      <label for="location">Latitude</label>
                                    <input type="text" class="form-control" readonly="" name="lat" id="lat">

                                  </div>
                                  <div class="col-md-6">
                                      <label for="location">Longitude</label>
                                    <input type="text" class="form-control" readonly="" name="lng" id="lng">
                                  </div>
                            </div>

                            <div class="row">
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="job_short_description">Job Short Description</label>
                                      <textarea class="required form-control" name="job_short_description" id="job_short_description" ></textarea>
                                  </div>
                              </div>

                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="job_title">Annual Salary</label>
                                          <input type="text" class="form-control required" id="annual_salary"  name="annual_salary" maxlength="500">
                                    </div>

                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="location">Experience</label>
                                        <input type="text" class="form-control required " id="experience" name="experience" maxlength="300">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="location">Qulalification</label>
                                        <input type="text" class="form-control required " id="qualification" name="qualification" maxlength="300">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="skills">Skills</label>
                                        <input type="text" class="form-control required " id="skills" name="skills" >
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
                                          <option value="<?php echo $j_category['id'];?>"><?php echo $j_category['name'];?></option>
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
                                        <option value="<?php echo $j_type['id'];?>"><?php echo $j_type['name'];?></option>
                                      <?php } } ?>
                                      </select>
                                  </div>
                                </div>

                            </div>
                            <div class="row">

                              <div class="form-group">
                                  <label class="col-md-2 control-label">Featured Image<span class="text-danger">*</span></label>
                                  <div class="col-md-7">
                                      <img id="previewimage" onclick="$('#uploadFile').click();" src="<?php echo base_url(); ?>assets/images/product_image.gif" style="cursor: pointer;height: 210px;width: 210px;position: relative;z-index: 10;"/>
                                      <input type="file" id="uploadFile" name="userfile" style="position: absolute; margin: 0px auto; visibility: hidden;" accept="image/*" />
                                      <div style="margin-top: 0px; color: red;"><?= form_error('userfile'); ?></div>
                                  </div>
                              </div>
                            </div>

                            <!--<div class="row">
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="companylogo">Company Logo</label>
                                      <input type="file" name="companylogo" id="companylogo" />
                                  </div>
                              </div>
                            </div>-->
                            <div class="row">
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="job_description">Job Description</label>
                                      <textarea class="required form-control" name="job_description" id="editor1" ></textarea>
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

        </div>
    </section>

</div>
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
