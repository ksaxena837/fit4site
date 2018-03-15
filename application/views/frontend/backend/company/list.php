
<style>
.pagination > li > span {
	padding: 6px 15px !important;
	background-color: #52d3aa !important;
}
</style>
	<div class="gtco-section" style="padding: 1em 0;">
		<div class="gtco-container">
			<h3>Company</h3>

			<!--New Job listing table-->
			<div class="col-md-12 new-job-post">
				<div class="col-xs-12">
					<div class="box">
						<div class="box-header">
              <a href="<?php echo base_url();?>backend/company/addNew" class="btn btn-primary">Add new company</a>
								<div class="box-tools">
										<form action="<?php echo base_url() ?>index.php/backend/company" method="POST" id="searchList">
												<div class="input-group">
													<input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
													<div class="input-group-btn">
														<button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
													</div>
												</div>
										</form>
								</div>
						</div><!-- /.box-header -->
						<div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>No.</th>
                  <th>Title</th>
                  <th>Description</th>
                    <th>Company Contact</th>
                  <th>Company Website</th>


                  <th class="text-center">Actions</th>
                </tr>
                <?php
                if(!empty($companies))
                {
                  //pre($companies);
                  $i=1;
                    foreach($companies as $record)
                    {
                ?>
                <tr>
                  <td><?php echo $i ?></td>
                  <td><?php echo $record->company_name ?></td>
                  <td><?php echo $record->company_description ?></td>
                  <!--<td><img src="<?php echo base_url();?>uploads/<?php echo $record->company_image; ?>" height="100" width="200" alt="<?php echo $record->company_name ?>"></td>-->
                  <td><?php echo $record->company_contact; ?></td>
                  <td><?php echo $record->company_website; ?></td>

                  <td class="text-center">
                      <a class="btn btn-sm btn-info" href="<?php echo base_url().'backend/company/editOld/'.$record->id; ?>"><i class="fa fa-pencil"></i></a>
                      <a class="btn btn-sm btn-danger " href="<?php echo base_url().'backend/company/deleteCompany/'.$record->id; ?>" onclick="return confirm('Are you sure want to delete company?');"><i class="fa fa-trash"></i></a>
                      <a class="btn btn-success" href="<?php echo base_url().'backend/company/viewpostedjobs/'.$record->id;?>" >View Jobs</a>
                  </td>
                </tr>
                <?php $i++;
                    }
                }
                ?>
              </table>

						</div><!-- /.box-body -->
            <?php echo $this->pagination->create_links(); ?>
					</div><!-- /.box -->
				</div>
			</div>
			<!--end of New Job listing table-->




		</div>
	</div>
