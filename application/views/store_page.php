<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-portfolio"></i> Store/Shop Name
        <small>Business</small>
      </h1>
    </section>

    <section class="content">

        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->



                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Business Profile</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->

                    <form role="form"  action="<?php echo base_url(); ?>store/index" method="post" role="form" >
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="fname">Business Title</label>
                                        <input type="text" class="form-control required" id="business_title" name="business_title" value="<?php echo ($businessDetails[0]->business_title)?$businessDetails[0]->business_title:NULL; ?>" maxlength="500">
                                    </div>

                                </div>

                            </div>
                            <div class="row">
                            <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="about_us">About Us</label>
                                    <textarea class="form-control" id="editor1" name="about_us"><?php echo ($businessDetails[0]->about_us)?$businessDetails[0]->about_us:NULL; ?></textarea>
                                  </div>
                              </div>
                            </div>
                            <div class="row">
                            <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="contact_us">Contact Us</label>
                                    <textarea class="form-control" id="editor2" name="contact_us" ><?php echo ($businessDetails[0]->contact_us)?$businessDetails[0]->contact_us:NULL; ?></textarea>
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

                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
<script src="<?php echo base_url(); ?>assets/js/addUser.js" type="text/javascript"></script>
