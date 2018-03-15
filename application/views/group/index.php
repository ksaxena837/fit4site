<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-portfolio"></i> Group Management
        <small>Group List</small>
      </h1>
    </section>
    <section class="content">
      <div class="row">
          <div class="col-xs-12 text-right">
              <div class="form-group">
                  <a class="btn btn-primary" href="<?php echo base_url(); ?>index.php/customGroup/addGroup"><i class="fa fa-plus"></i> Add New</a>
              </div>
          </div>
      </div>
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Groups</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                <table class="table table-bordered table-striped js-dataTable-full" id="producttbl">
                    <thead>
                        <tr>
                            <th>SN.</th>
                            <th>Group Name</th>
                            <th>Cover Image</th>
                            <th>Description</th>
                            <th>Created</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php
                      if(!empty($groups)){
                       $i=1;
                      foreach($groups as $group){ ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $group->title; ?></td>
                            <td><img src="<?php echo base_url(); ?>uploads/groups/group_thumb/<?php echo $group->cover_image; ?>" alt="<?php echo $group->title;?>"></td>
                            <td><?php echo $group->description; ?></td>
                            <td><?php echo $group->created_at; ?></td>
                            <td><?php echo ($group->status!=0)? "<span class='label label-danger'>Deleted</span>" : "<span class='label label-success'>Active</span>";?></td>
                            <td width="20%"><a href="<?php echo base_url();?>customGroup/editGroup/<?php echo $group->id;?>" class="btn btn-primary">Edit</a>|<a href="<?php echo base_url();?>customGroup/editGroup/<?php echo $group->id;?>" class="btn btn-warning">View</a>|<a href="<?php echo base_url();?>customGroup/deleteGroupInfo/<?php echo $group->id;?>" class="btn btn-danger">Delete</a></td>
                       </tr>
                      <?php $i++;
                    }}?>
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
