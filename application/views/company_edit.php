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

                    <form role="form" id="addCompany" action="<?php echo base_url() ?>index.php/company/editCompany" method="post" role="form" enctype="multipart/form-data">
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


                                      <label>Upload Image</label>
                                      <div class="input-group">
                                          <span class="input-group-btn">
                                              <span class="btn btn-primary btn-file">
                                                  Browse… <input type="file" id="imgInp" name="userfile">
                                              </span>
                                          </span>
                                          <input type="text" class="form-control" readonly>
                                      </div>
                                      <input type="hidden" name="old" value="<?php echo $company_image; ?>" />
                                      <img id='img-upload' src="<?php echo base_url();?>uploads/company/<?php echo $company_image ?>" name="userfile"/>

                                    </div>
                                </div>

                        </div><!-- /.box-body -->
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
            </div>

        </div>
    </section>

</div>
