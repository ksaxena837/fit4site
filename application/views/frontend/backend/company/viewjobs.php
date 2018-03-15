
<style>
.pagination > li > span {
	padding: 6px 15px !important;
	background-color: #52d3aa !important;
}
</style>
	<div class="gtco-section" style="padding: 1em 0;">
		<div class="gtco-container">
			<h3><?php echo $company_name;?></h3>

			<!--New Job listing table-->
			<div class="col-md-12 new-job-post">
				<div class="col-xs-12">
					<div class="box">

						<div class="box-body table-responsive no-padding">
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

						</div><!-- /.box-body -->

					</div><!-- /.box -->
				</div>
			</div>
			<!--end of New Job listing table-->




		</div>
	</div>
  <script>
  $(document).ready(function(){
    $('#producttbl').DataTable();
  });
  </script>
