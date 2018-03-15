<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-portfolio"></i> Sales Report
        <small>Report</small>
      </h1>
    </section>
    <section class="content">

        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">  Sales Report </h3>
                    <div class="box-tools">
                      <form method="post">
                          <div class="col-md-12">
                              <div class="col-md-3">
                                   <select class="form-control" name="buyer_name" >
                                      <option value="">Select Buyer</option>
                                      <?php
                                      foreach ($Buyer_Name as $buyer)
                                      {?>
                                      <option value="<?=$buyer->buyer_name?>"<?php if(@$buyer->buyer_name==@$buyername) echo "selected";?>><?=$buyer->buyer_name?></option>
                                     <?php }?>

                                  </select>
                              </div>
                              <div class="col-md-2"><input id="example-datepicker1" class="js-datepicker form-control" name="start_date" data-date-format="yyyy/mm/dd" placeholder="Select Start Date" type="text"></div>
                              <div class="col-md-2"><input id="example-datepicker1" class="js-datepicker form-control" name="end_date" data-date-format="yyyy/mm/dd" placeholder="Select End Date" type="text"></div>
                              <div class="col-md-3">
                                  <select class="form-control" name="created_name" >
                                      <option value="">Select Created By</option>
                                      <option value="0" <?php  if(@$created_names== '0') echo "selected"?>>Website</option>
                                      <option value="1" <?php if(@$created_names== '1') echo "selected"?>>Admin</option>

                                  </select>
                              </div>
                              <div class="col-md-2"><input class="btn btn-success" value="Search" type="submit"></div>
                          </div>
                      </form>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-bordered table-striped js-dataTable-full">
                      <thead>
                          <tr>
                              <th>Order Number</th>
                              <th>Order Date</th>
                              <th>Due Date</th>
                              <th>Created By</th>
                              <th>Buyer Name</th>
                              <th>Cash Discount</th>
                              <th>Grand Amount</th>
                              <th>No of item</th>
                              <th>Net</th>
                              <th>Status</th>
                              <th>Actions</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php
                          foreach ($sale_list as $value)
                          {

                          ?>
                         <tr>
                              <td><?=$value->id?></td>
                              <td><?=$value->issue_date;?></td>
                              <td><?=$value->due_date?></td>
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
                              <td><?=$value->buyer_name?></td>
                              <td><?=$value->cash_discount?></td>
                              <td><?=$value->grand_amount?></td>
                              <td><?=$value->total_quantity?></td>
                              <td><?=$value->grand_amount?></td>
                              <td>
                                  <?php
                                  if($value->shipped_status==0)
                                  {?>
                                      <span class="label label-warning">Order Placed</span>
                                 <?php }
                                 else
                                 {?>
                                     <span class="label label-success">Shipped</span></td>
                                <?php }
                                  ?>


                          <td>
                              <a class="btn-sm editField" href="<?=base_url();?>sale/SaleDetail/<?=$value->id?>" data-toggle="tooltip" data-placement="top" title="" data-product_id="71" data-href="" data-type="sale_detail" data-original-title="View Sale detail">
                              <span class="fa fa-eye"></span>
                              </a>
                          </td>
                      </tr>
                          <?php }?>
                      </tbody>
                  </table>

                </div><!-- /.box-body -->

              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>
