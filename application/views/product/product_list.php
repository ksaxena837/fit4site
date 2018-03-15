<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-portfolio"></i> Product Management
        <small>Product List</small>
      </h1>
    </section>
    <section class="content">
      <div class="row">
          <div class="col-xs-12 text-right">
              <div class="form-group">
                  <a class="btn btn-primary" href="<?php echo base_url(); ?>index.php/account/add-product"><i class="fa fa-plus"></i> Add New</a>
              </div>
          </div>
      </div>
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Products</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                <table class="table table-bordered table-striped js-dataTable-full" id="producttbl">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Product Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Created</th>
                            <th>Modified</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  foreach ($product_list as $post)
                        { ?>
                        <tr>
                            <td><?= $post->product_code?></td>
                            <td><img src="<?=base_url();?>/uploads/products/<?= $post->product_image?>" width="100" height="100"></td>
                            <td><?= $post->product_name?>&nbsp;&nbsp;<a href="javascript:" class="btn-sm editField" data-toggle="tooltip"  data-placement="top" title="Edit Name" data-product_id="<?= $post->id?>" data-href="<?=site_url('account/signle-product-edit')?>" data-type="product_name"></a></td>
                            <td style="text-transform: capitalize;"><?php
                                foreach ($category_list as $value) {
                                    if($value->id  == $post->category_id)
                                    {
                                       echo $value->category_name;
                                    }
                                }
                            ?>
                            &nbsp;&nbsp;<a href="javascript:" class="btn-sm editField" data-toggle="tooltip"  data-placement="top" title="Edit Categort" data-product_id="<?= $post->id?>" data-href="<?=site_url('account/signle-product-edit')?>" data-type="product_category"></a></td>
                            <td><?= $post->product_description?>&nbsp;&nbsp;<a href="javascript:" class="btn-sm editField" data-toggle="tooltip"  data-placement="top" title="Edit Description" data-product_id="<?= $post->id?>" data-href="<?=site_url('account/signle-product-edit')?>" data-type="product_description"></a></td>
                            <!--<td><?= $post->product_price?>&nbsp;&nbsp;<a href="javascript:" class="btn-sm editField" data-toggle="tooltip"  data-placement="top" title="Edit Price" data-product_id="<?= $post->id?>" data-href="<?=site_url('account/signle-product-edit')?>" data-type="product_price"><span class="fa fa-pencil"></span></a></td>-->
                            <td><?= $post->product_price?></td>
                            <td><?= $post->created_date?></td>
                            <td><?= $post->modified_date?></td>
                            <td><?php if($post->status == "0")
                                    {
                                        echo "Active";
                                    }
                                    else
                                    {
                                        echo "Inactive";
                                    }
                                ?>
                            </td>
                             <td>
                                 <button class="btn btn-default btn-rounded btn-condensed btn-sm product_detail" id="<?=$post->id?>"  data-toggle="tooltip" title="View Product" ><span title="View Sub Category"class="fa fa-eye"></span></button>
                                <a class="btn btn-default btn-rounded btn-condensed btn-sm" type="button" data-toggle="tooltip"  title="Edit" href="<?=base_url();?>account/product-edit/<?= $post->id?>"><i class="fa fa-pencil"></i></a>
                                <?php if ($post->status == '1') { ?>
                                <a href="<?= base_url() . 'index.php/account/product-status/'.$post->id.'/0'?>" data-toggle="tooltip" title="Inactive" class="btn btn-default btn-rounded btn-condensed btn-sm changestatus"><span  class="fa fa-ban" title="Inactive"></span></a>
                                <?php } else { ?>
                                <a href="<?= base_url() . 'index.php/account/product-status/'.$post->id.'/1'?>" data-toggle="tooltip" title="Active" class="btn btn-default btn-rounded btn-condensed btn-sm changestatus"><span class="fa fa-check-circle-o" title="Active"></span></a>
                            <?php } ?>
                                <a href="<?= base_url() . 'account/product-delete/' . $post->id ?>" data-href="" class="btn btn-danger btn-rounded btn-condensed btn-sm delete"  data-toggle="tooltip" title="Delete" ><span class="fa fa-times" title="delete"></span></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>

</div>
</div>
</div>
</section>
</div>
<script>
$(document).ready(function(){
                   $('#producttbl').DataTable();
});
</script>
