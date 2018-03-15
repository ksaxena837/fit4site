<?php
$title = '';
$description = '';
$image_url = '';


if(!empty($portfolio))
{
    foreach ($portfolio as $pf)
    {
        $id = $pf->id;
         $title = $pf->title;
        $description = $pf->description;
        $image_url = $pf->image_url;

    }
}
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-portfolio"></i> Portfolio Management
        <small>Add / Edit Portfolio</small>
      </h1>
    </section>

    <section class="content">

        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->



                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Portfolio Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->

                    <form role="form" id="addUser" action="<?php echo base_url() ?>index.php/portfolio/editPortfolio" method="post" role="form" enctype="multipart/form-data">
                      <input type="hidden" name="id" value="<?php echo $id; ?>" />
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="fname">Title</label>
                                        <input type="text" class="form-control required" id="title" name="title" maxlength="500" value="<?php echo $title;?>">
                                    </div>

                                </div>

                            </div>
                            <div class="row">
                            <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="email">Description</label>
                                    <textarea class="form-control" name="description" id="editor1"><?php echo $description ;?></textarea>
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
                                      <input type="hidden" name="old" value="<?php echo $image_url; ?>" />
                                      <img id='img-upload' src="<?php echo base_url();?>uploads/<?php echo $image_url ?>" name="userfile"/>

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
