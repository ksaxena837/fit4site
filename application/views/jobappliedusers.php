<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-portfolio"></i> Applied User List
        <small>Users</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Candidates</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                <table class="table table-bordered table-striped js-dataTable-full" id="producttbl">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Email ID</th>
                          <th>Phone</th>
                        <th>User Job Seeking Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if(!empty($appliedusers))
                      {
                        //pre($jobappliedusers);
                        $i=1;
                          foreach($appliedusers as $record)
                          {
                      ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $record->name; ?></td>
                        <td><?php echo $record->email; ?></td>
                        <td><?php echo $record->mobile; ?></td>
                        <td><?php echo ($record->online_status=='0')?'Not Seeking':'Seeking'; ?></td>

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
