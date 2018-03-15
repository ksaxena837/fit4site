<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-portfolio"></i>Groups
        <small>Edit Group</small>
      </h1>
    </section>
    <div class="col-md-12">
        <?php
            $this->load->helper('form');
            $error = $this->session->flashdata('error');
            if($error)
            {
        ?>
        <!--<div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php echo $this->session->flashdata('error'); ?>
        </div>-->
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
    </div>
    <section class="content">

        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
                <div class="box box-primary">

                    <!-- form start -->

                    <form role="form" id="addUser" action="<?php echo base_url() ?>index.php/customGroup/updateGroup" method="post" role="form" enctype="multipart/form-data">
                      <input type="hidden" name="groupId" value="<?php echo $groupinfo[0]->id;?>">
                        <div class="box-body">
                          <div class="col-md-12">
                              <div class="form-group">
                                  <label for="product_code">Title</label>
                                    <input class="form-control" type="text" id="title" value="<?php echo $groupinfo[0]->title;?>" name="title" placeholder="Group Title" >
                                    <div style="margin-top: 0px; color: red;"><?= form_error('title'); ?></div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="product_code">About</label>
                                    <textarea class="form-control input-lg" id="description"  name="description" placeholder="Group Description" rows="4" ><?php echo $groupinfo[0]->description;?></textarea>
                                    <div style="margin-top: 0px; color: red;"><?= form_error('description'); ?></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Cover Image<span class="text-danger">*</span></label>
                                <div class="col-md-7">
                                    <img id="previewimage" onclick="$('#uploadFile').click();" src="<?php echo base_url(); ?>uploads/groups/group_resize/<?php echo $groupinfo[0]->cover_image;?>" style="cursor: pointer;height: 210px;width: 210px;position: relative;z-index: 10;"/>
                                    <input type="file" id="uploadFile" name="cover_image" style="position: absolute; margin: 0px auto; visibility: hidden;" accept="image/*" />
                                    <div style="margin-top: 0px; color: red;"><?= form_error('cover_image'); ?></div>
                                </div>
                            </div>
                            <input type="hidden" name="cover_image_old" value="<?php echo $groupinfo[0]->cover_image;?>">

                            <div class="col-md-12">
                              <div class="form-group">
                                <label class="col-md-2 control-label">Group As<span class="text-danger">*</span></label>
                                  <div class="radio">
                                    <label>
                                      <input type="radio" name="group_visibility" id="optionsRadios1" value="public" <?php echo ($groupinfo[0]->group_visibility=='public')?'checked':''; ?>>
                                      Public
                                    </label>
                                    <label>
                                      <input type="radio" name="group_visibility" id="optionsRadios2" value="private" <?php echo ($groupinfo[0]->group_visibility=='private')?'checked':''; ?>>
                                        Private
                                    </label>
                                  </div>

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
