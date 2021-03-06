<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-job"></i> Job Management
        <small>Add, Edit, Delete</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>index.php/jobs/addNewJob"><i class="fa fa-plus"></i> Add New</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Job List</h3>
                    <div class="box-tools">
                        <form action="<?php echo base_url() ?>index.php/jobs" method="POST" id="searchList">
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
                        <th>Location</th>



                      <th class="text-center">Actions</th>
                    </tr>
                    <?php
                    if(!empty($jobs))
                    {
                      //pre($companies);
                      $i=1;
                        foreach($jobs as $record)
                        {
                    ?>
                    <tr>
                      <td><?php echo $i ?></td>
                      <td><?php echo $record->job_title ?></td>
                      <td><?php echo $record->job_short_description ?></td>
                      <!--<td><img src="<?php echo base_url();?>uploads/<?php echo $record->company_image; ?>" height="100" width="200" alt="<?php echo $record->company_name ?>"></td>-->
                      <td><?php echo $record->location; ?></td>


                      <td class="text-center">
                          <a class="btn btn-sm btn-info" href="<?php echo base_url().'index.php/jobs/editOld/'.$record->id; ?>"><i class="fa fa-pencil"></i></a>
                          <a class="btn btn-sm btn-danger " href="<?php echo base_url().'index.php/jobs/deleteJob/'.$record->id; ?>" onclick="return confirm('Are you sure want to delete job?');"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
                    <?php $i++;
                        }
                    }
                    ?>
                  </table>

                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?php echo $this->pagination->create_links(); ?>
                </div>
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('ul.pagination li a').click(function (e) {
            e.preventDefault();
            var link = jQuery(this).get(0).href;
            var value = link.substring(link.lastIndexOf('/') + 1);
            jQuery("#searchList").attr("action", baseURL + "portfolioListing/" + value);
            jQuery("#searchList").submit();
        });
    });
</script>
