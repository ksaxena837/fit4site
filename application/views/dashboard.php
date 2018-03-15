<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard
        <small>Control panel</small>
      </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3>150</h3>
                  <p>New Tasks</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3>53<sup style="font-size: 20px">%</sup></h3>
                  <p>Completed Tasks</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>44</h3>
                  <p>New User</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="<?php echo base_url(); ?>index.php/userListing" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3>65</h3>
                  <p>Reopened Issue</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
          </div>
          <?php if(ROLE_ADMIN==$role){ ?>
          <div class="box">

            <div class="box-header">
                <h3 class="box-title">Today New Users</h3>
              </div>
          <div class="col-md-12" style="padding-top: 20px;"></div>
          <div class="block-content">
                  <table class="table table-bordered table-striped js-dataTable-full">
                      <thead>
                          <tr>
                              <th>User ID</th>
                              <th>Full Name</th>
                              <th>Email</th>
                              <th>Phone</th>
                              <th>Created By</th>
                              <th>Created Date</th>
                          </tr>
                      </thead>
                      <tbody>
                        <?php
                        if(!empty($customer_list))
                        {
                        foreach ($customer_list as $value)
                        {

                        ?>
                       <tr>
                            <td><?=$value->userId?></td>
                            <td style="text-transform: capitalize;"><?=$value->name?></td>

                            <td><?=$value->email?></td>
                            <td><?=$value->phone?></td>
                            <td><?php
                                if(($value->created_by) == 0)
                                {
                                    echo 'Website';
                                }
                                else
                                {
                                    echo  "Admin";
                                }?>
                            </td>
                            <td><?=$value->createdDtm?></td>
                    </tr>
                        <?php }
                        }?>
                      </tbody>
                  </table>
              </div>
          </div>
        <?php } ?>
    </section>


</div>
