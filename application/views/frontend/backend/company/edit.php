
<style>
.pagination > li > span {
	padding: 6px 15px !important;
	background-color: #52d3aa !important;
}
</style>
	<div class="gtco-section">
		<div class="gtco-container">
			<h3>Edit Company</h3>
<?php

  $id = $company[0]->id;
  $company_name = $company[0]->company_name;
  $company_description = $company[0]->company_description;
  $company_address = $company[0]->company_address;
  $company_contact = $company[0]->company_contact;
  $company_website = $company[0]->company_website;
  $twitter_url = $company[0]->twitter_url;
  $facebook_url = $company[0]->facebook_url;
  $company_image = $company[0]->company_image;
?>

			<!--New Job listing table-->
			<div class="col-md-12 new-job-post">
        <form role="form" id="addCompany" action="<?php echo base_url() ?>backend/company/editCompany" method="post" role="form" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?php echo $id;?>" />
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="company_name">Company Name</label>
                              <input type="text" class="form-control required" id="company_name"  name="ac" value="<?php echo $company_name; ?>" maxlength="500">
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="company_address">Company Address</label>
                            <textarea class="required form-control" name="company_address" id="company_address" ><?php echo $company_address;?></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="company_website">Company Website</label>
                            <input type="text" class="form-control required" id="company_website"  name="company_website" value="<?php echo $company_website;?>" maxlength="200">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="company_contact">Company Contact</label>
                            <input type="text" class="form-control required " id="company_contact" name="company_contact" value="<?php echo $company_contact;?>" maxlength="10">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="twitter_url">Twitter Account</label>
                            <input type="text" class="form-control required" id="twitter_url" name="twitter_url" maxlength="200" value="<?php echo $twitter_url;?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="facebook_url">Facebook Account</label>
                            <input type="text" class="form-control required" id="facebook_url" name="facebook_url" maxlength="200" value="<?php echo $facebook_url;?>">
                        </div>
                    </div>

                </div>
      
            <div class="row">
              <div class="col-md-12">
                  <div class="form-group">
                      <label class="col-md-2 control-label">logo<span class="text-danger">*</span></label>
                      <div class="col-md-7">
                          <img id="previewimage" onclick="$('#uploadFile').click();" src="<?php echo base_url();?>uploads/company/<?php echo $company_image ?>" style="cursor: pointer;height: 210px;width: 210px;position: relative;z-index: 10;"/>
                          <input type="file" id="uploadFile" name="userfile" style="position: absolute; margin: 0px auto; visibility: hidden;" accept="image/*" />
                          <div style="margin-top: 0px; color: red;"><?= form_error('userfile'); ?></div>
                      </div>
                        <input type="hidden" name="old" value="<?php echo $company_image; ?>" />
                  </div>
                </div>
              </div>
                <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                          <label for="company_description">Company Description</label>
                          <textarea class="required form-control" name="company_description" rows="10" id="editor1" ><?php echo $company_description;?></textarea>
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
  </script>
