<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-company"></i> Company
        <small>Add / Edit Company</small>
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
                        <h3 class="box-title">Enter Company Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->

                    <form role="form" id="addCompany" action="<?php echo base_url() ?>index.php/company/addNewCompany" method="post" role="form" enctype="multipart/form-data">
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
            </div>

        </div>
    </section>

</div>
