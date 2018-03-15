<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-portfolio"></i> Sub Management
        <small>Sub Category List</small>
      </h1>
    </section>
    <section class="content">
      <div class="row">
          <div class="col-xs-12 text-right">

          </div>
      </div>
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Sub Category</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                <table class="table table-bordered table-striped js-dataTable-full" id="producttbl">

                    <thead>
                        <tr>
                            <th>Sub Category Name</th>
                            <th>Created</th>
                            <th>Created By</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        foreach ($subCategoryList as $post){
                        ?>
                       <tr>
                        <td style="text-transform: capitalize;"><?= $post->subcategory_name?></td>
                        <td style="text-transform: capitalize;"><?= $post->created_date?></td>
                        <td style="text-transform: capitalize;">
                            <?php if($post->created_by == 1)
                            {
                                echo "Admin";
                            }
                            else
                            {
                                echo "Website";
                            }
                                ?></td>
                        <td style="text-transform: capitalize;">
                            <?php if($post->status == 0)
                            {
                                echo "Active";
                            }
                            else
                            {
                                echo "Inactive";
                            }
                            ?></td>
                        <td>
                           <a class="btn btn-default btn-rounded btn-condensed btn-sm" type="button" data-toggle="tooltip"  title="Edit Sub Category" href="<?=site_url('account/edit-subcategory/'.$post->subcat_id)?>"><i class="fa fa-pencil"></i></a>
                           <a href="<?= base_url() . 'index.php/account/sub-category-delete/' . $post->subcat_id ?>" data-href="" class="btn btn-danger btn-rounded btn-condensed btn-sm delete"  data-toggle="tooltip" title="Delete Sub Category" ><span class="fa fa-times" title="delete"></span></a>
                        </td>
                       </tr>
                        <?php }?>
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
