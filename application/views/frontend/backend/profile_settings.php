
	<div class="gtco-section user-profile-page">


		<div class="gtco-container user-profile-section">
			<!--Profile section-->
			<div class="col-md-8 new-job-post">
				<div class="profile-content">
					<form role="form" action="<?php echo base_url() ?>backend/settings/updateGeneralSettings" method="post" enctype="multipart/form-data">
							<div class="box-body">
								<div class="row">
										<div class="col-md-12">
												<label for="availablestatus">Available Status</label>
												<select class="form-control" id="availablestatus" name="availablestatus">
														<option value="">Select </option>
                            <option value="public" <?php echo ($userprofile[0]->availablity_status=='public')? 'selected': '';?>>Public</option>
                            <option value="adminsonly" <?php echo ($userprofile[0]->availablity_status=='adminsonly')? 'selected': '';?>>Only Me</option>
                            <option value="loggedin" <?php echo ($userprofile[0]->availablity_status=='loggedin')? 'selected': '';?>>All Members</option>

												</select>
										</div>
								</div>
                <div class="row">
										<div class="col-md-12">
												<label for="callstatus">On Call Status</label>
												<select class="form-control" id="callstatus" name="callstatus">
														<option value="">Select </option>
                            <option value="public" <?php echo ($userprofile[0]->on_call_status=='public')? 'selected': '';?>>Public</option>
                            <option value="adminsonly" <?php echo ($userprofile[0]->on_call_status=='adminsonly')? 'selected': '';?>>Only Me</option>
                            <option value="loggedin" <?php echo ($userprofile[0]->on_call_status=='loggedin')? 'selected': '';?>>All Members</option>

												</select>
										</div>
								</div>
                <h3>Profile Details</h3>
                <div class="row">
										<div class="col-md-12">
												<label for="about_status">About</label>
												<select class="form-control" id="about_status" name="about_status">
														<option value="">Select </option>
                            <option value="public" <?php echo ($userprofile[0]->about_status=='public')? 'selected': '';?>>Public</option>
                            <option value="adminsonly" <?php echo ($userprofile[0]->about_status=='adminsonly')? 'selected': '';?>>Only Me</option>
                            <option value="loggedin" <?php echo ($userprofile[0]->about_status=='loggedin')? 'selected': '';?>>All Members</option>

												</select>
										</div>
								</div>
                <div class="row">
										<div class="col-md-12">
												<label for="email_status">Email Address</label>
												<select class="form-control" id="email_status" name="email_status">
														<option value="">Select </option>
                            <option value="public" <?php echo ($userprofile[0]->email_status=='public')? 'selected': '';?>>Public</option>
                            <option value="adminsonly" <?php echo ($userprofile[0]->email_status=='adminsonly')? 'selected': '';?>>Only Me</option>
                            <option value="loggedin" <?php echo ($userprofile[0]->email_status=='loggedin')? 'selected': '';?>>All Members</option>

												</select>
										</div>
								</div>
                <div class="row">
										<div class="col-md-12">
												<label for="website_status">Website</label>
												<select class="form-control" id="website_status" name="website_status">
														<option value="">Select </option>
                            <option value="public" <?php echo ($userprofile[0]->website_status=='public')? 'selected': '';?>>Public</option>
                            <option value="adminsonly" <?php echo ($userprofile[0]->website_status=='adminsonly')? 'selected': '';?>>Only Me</option>
                            <option value="loggedin" <?php echo ($userprofile[0]->website_status=='loggedin')? 'selected': '';?>>All Members</option>

												</select>
										</div>
								</div>
                <br>


							<div class="box-footer">
									<input type="submit" class="btn btn-primary" value="Save Changes" />

							</div>
					</form>
				</div>
			</div>
			<!--end of profile section-->


		</div>
	</div>
