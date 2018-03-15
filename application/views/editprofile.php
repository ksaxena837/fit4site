<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Profile
        <small>Update your profile details</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-8">
              <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="<?php echo base_url() ?>index.php/user/editprofile" method="post">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputeducation">Education</label>
                                        <input type="text" class="form-control" id="inputeducation" placeholder="Education" name="usereducation" maxlength="50" required value="<?php echo $userprofile[0]->education; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputlocation">Location</label>
                                        <input type="text" class="form-control" id="inputlocation" placeholder="Location" name="userlocation" maxlength="50" required value="<?php echo $userprofile[0]->location; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputskills">Skills</label>
                                        <input type="text" class="form-control" id="inputskills" placeholder="Skills" name="userskills" maxlength="50" required value="<?php echo $userprofile[0]->skills; ?>">
                                    </div>
                                </div>
                            </div>
							<div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputnotes">Notes</label>
										<textarea rows="4" cols="50" class="form-control" id="inputnotes" name="usernotes" placeholder="Notes" required><?php echo $userprofile[0]->notes; ?></textarea>
                                    </div>
                                </div>
                            </div>
							<div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputemail">Email</label>
										<input type="email" class="form-control" id="inputemail" placeholder="Email" name="useremail" maxlength="50" required value="<?php echo $userprofile[0]->email; ?>">
                                    </div>
                                </div>
                            </div>
							<div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputname">Name</label>
										<input type="text" class="form-control" id="inputname" placeholder="Name" name="username" maxlength="50" required value="<?php echo $userprofile[0]->name; ?>">
                                    </div>
                                </div>
                            </div>
							<div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputmobile">Mobile</label>
										<input type="text" class="form-control" id="inputmobile" placeholder="Mobile" name="usermobile" maxlength="50" required value="<?php echo $userprofile[0]->mobile; ?>">
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
            <div class="col-md-4">
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

                <?php
                    $noMatch = $this->session->flashdata('nomatch');
                    if($noMatch)
                    {
                ?>
                <div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('nomatch'); ?>
                </div>
                <?php } ?>

                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
