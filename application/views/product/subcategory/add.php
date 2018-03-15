<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-portfolio"></i> Product Category Management
        <small>Add / Edit Sub Category</small>
      </h1>
    </section>

    <section class="content">
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
        <div class="row">
            <!-- left column -->

            <div class="col-md-12">
              <!-- general form elements -->



                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Product Category Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->

                    <form class="form-horizontal"  method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="col-md-2 control-label">Sub-Category Name<span class="text-danger">*</span></label>
                            <div class="col-md-7">
                                <input class="form-control" type="text" id="sub_category_name" value="<?php echo set_value('sub_category_name'); ?>" name="sub_category_name" placeholder="Category Name" >
                                    <div style="margin-top: 0px; color: red;"><?= form_error('sub_category_name'); ?></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Product Image<span class="text-danger">*</span></label>
                            <div class="col-md-7">
                                <img id="previewimage" onclick="$('#uploadFile').click();" src="<?php echo base_url(); ?>assets/images/product_image.gif" style="cursor: pointer;height: 210px;width: 210px;position: relative;z-index: 10;"/>
                                <input type="file" id="uploadFile" name="subimage" style="position: absolute; margin: 0px auto; visibility: hidden;" accept="image/*"  />
                                 <div style="margin-top: 0px; color: red;"><?= form_error('subimage'); ?></div>
<!--                                                <input  type="file" id="uploadFile" name="product_image" required >-->
                            </div>
                        </div>

                       <div class="form-group">
                            <div class="col-md-8 col-md-offset-2">
                                <button class="btn btn-sm btn-primary" name="submit" type="submit"><i class="fa fa-check"></i> Add Sub-Category</button>
                            </div>
                        </div>
                    </form>

                </div>

            </div>

        </div>
    </section>

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
