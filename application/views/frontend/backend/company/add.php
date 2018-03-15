
<style>
.pagination > li > span {
	padding: 6px 15px !important;
	background-color: #52d3aa !important;
}
</style>
	<div class="gtco-section" style="padding: 1em 0;">
		<div class="gtco-container">
			<h3>Register your company for job posting</h3>

			<!--New Job listing table-->
			<div class="col-md-12 new-job-post">
        <form role="form" id="addCompany" action="<?php echo base_url() ?>backend/company/addNewCompany" method="post" role="form" enctype="multipart/form-data">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="company_name">Company Name</label>
                              <input type="text" class="form-control required" id="company_name"  name="ac" maxlength="500">
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="company_address">Company Address</label>
                            <textarea class="required form-control" name="company_address" id="company_address" ></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="company_website">Company Website</label>
                            <input type="text" class="form-control required" id="company_website"  name="company_website" maxlength="200">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="company_contact">Company Contact</label>
                            <input type="text" class="form-control required " id="company_contact" name="company_contact" maxlength="10">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="twitter_url">Twitter Account</label>
                            <input type="text" class="form-control required" id="twitter_url" name="twitter_url" maxlength="200">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="facebook_url">Facebook Account</label>
                            <input type="text" class="form-control required" id="facebook_url" name="facebook_url" maxlength="200">
                        </div>
                    </div>

                </div>
                <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                          <label for="userfile">Company Image</label>
                          <input type="file" name="userfile" id="userfile" />
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                          <label for="company_description">Company Description</label>
                          <textarea class="required form-control" name="company_description" rows="10" id="editor1" ></textarea>
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
