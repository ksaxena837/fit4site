<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-portfolio"></i> <?php echo $company_name;?>
        <small>Jobs</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Jobs</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                <table class="table table-bordered table-striped js-dataTable-full" id="producttbl">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Title</th>
                        <th>Description</th>
                          <th>Location</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if(!empty($jobsByCompanyId))
                      {
                        //pre($jobsByCompanyId);
                        $i=1;
                          foreach($jobsByCompanyId as $key =>$record)
                          {
                      ?>
                      <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $record->job_title ?></td>
                        <td><?php echo $record->job_short_description ?></td>
                        <!--<td><img src="<?php echo base_url();?>uploads/<?php echo $record->company_image; ?>" height="100" width="200" alt="<?php echo $record->company_name ?>"></td>-->
                        <td><?php echo $record->location; ?></td>
                        <td>
                          <a href="<?php echo base_url();?>company/viewNumberOfUsersAppliedJob/<?php echo $record->company_id; ?>/<?php echo $record->id; ?>" class="btn btn-default" >View Applied  <span class="badge"><?php echo ($readunreadcounter[$key]->count==0)?'':$readunreadcounter[$key]->count;?></span></a>
                        </td>
                      </tr>
                      <?php $i++;
                          }
                      }
                      ?>
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
