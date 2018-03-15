<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-portfolio"></i> Product Category Management
        <small>Add / Edit Category</small>
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

                    <form role="form" id="addUser" action="<?php echo base_url() ?>index.php/account/edit-category/<?php echo $category[0]->id; ?>" method="post" role="form" enctype="multipart/form-data">
                        <div class="box-body">
                          <div class="col-md-12">
                              <div class="form-group">
                                  <label for="product_category">Product Category</label>
                                    <input class="form-control" type="text" id="product_category" value="<?php echo $category[0]->category_name; ?>" name="product_category" placeholder="Product Category" >
                                    <div style="margin-top: 0px; color: red;"><?= form_error('product_category'); ?></div>
                                </div>
                            </div>
<input type="hidden" name="catid" value="<?php echo $category[0]->id;?>" />
                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <input type="reset" class="btn btn-default" value="Reset" />
                        </div>
                    </form>

                    <hr><h2>Category List </h2>
                    <table class="table table-bordered table-striped " id="producttbl">
                        <thead>
                            <tr>
                                <th>Category Name</th>
                                <th>Created Date</th>
                                <th>Modified Date</th>
                                <th>Created By</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($category_list as $post)
                            { ?>
                            <tr>
                                <td style="text-transform: capitalize;"><?= $post->category_name?></td>
                                <td><?= $post->created_date?></td>
                                <td><?= $post->modified_date?></td>
                                <td><?php if($post->created_by == "1")
                                        {
                                            echo "Admin";
                                        }
                                        else
                                        {
                                            echo "Website";
                                        }
                                    ?>
                                </td>
                                <td><?php if($post->status == "0")
                                        {
                                            echo "Active";
                                        }
                                        else
                                        {
                                            echo "Inactive";
                                        }
                                    ?></td>
                                 <td>
                                    <a class="btn btn-default btn-rounded btn-condensed btn-sm" type="button" data-toggle="tooltip"  title="Edit" href="<?=site_url('account/edit-category/'.$post->id)?>"><i class="fa fa-pencil"></i></a>
                                    <a class="btn btn-default btn-rounded btn-condensed btn-sm" data-toggle="tooltip" title="Add Sub Category" href="<?=site_url('account/add-subcategory/'.$post->id)?>"><span title="Add Sub Category"class="fa fa-plus"></span></a>
                                    <a class="btn btn-default btn-rounded btn-condensed btn-sm"  data-toggle="tooltip" title="View Sub Category" href="<?=site_url('account/view-subcategory/'.$post->id)?>"><span title="View Sub Category"class="fa fa-eye"></span></a>
                                    <?php if ($post->status == '1') { ?>
                                    <a href="<?= base_url() . 'index.php/account/category-status/'.$post->id.'/0'?>" data-toggle="tooltip" title="Inactive" class="btn btn-default btn-rounded btn-condensed btn-sm changestatus"><span  class="fa fa-ban" title="Inactive"></span></a>
                                    <?php } else { ?>
                                    <a href="<?= base_url() . 'index.php/account/category-status/'.$post->id.'/1'?>" data-toggle="tooltip" title="Active" class="btn btn-default btn-rounded btn-condensed btn-sm changestatus"><span class="fa fa-check-circle-o" title="Active"></span></a>
                                <?php } ?>
                                    <a href="<?= base_url() . 'index.php/account/category-delete/' . $post->id ?>" data-href="" class="btn btn-danger btn-rounded btn-condensed btn-sm delete"  data-toggle="tooltip" title="Delete" ><span class="fa fa-times" title="delete"></span></a>
                            </td>

                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </section>
    <script>
    $(document).ready(function(){
                       $('#producttbl').DataTable();
    });
    </script>
</div>
