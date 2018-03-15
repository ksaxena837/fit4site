<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-portfolio"></i>Order
        <small>Status</small>
      </h1>
    </section>
    <section class="content">

        <div class="row">
            <div class="col-xs-12">
              <div class="box">

                <div class="box-body table-responsive no-padding">
                  <table class="table table-bordered table-striped js-dataTable-full">
                      <thead>
                          <tr>
                              <th>S.N. </th>
                              <th>First Name</th>
                              <th>Last Name</th>
                              <th>Phone</th>
                              <th>Email</th>
                              <th>Order Date</th>
                              <th>Shipped Status</th>
                              <th>Actions</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php
                          $i = 1;
                          foreach ($orders as $value)
                          {

                          ?>
                         <tr>
                              <td><?=$i?></td>
                              <td><?=$value->firstname?></td>
                              <td><?=$value->lastname?></td>
                              <td><?=$value->phone?></td>
                              <td><?=$value->email?></td>
                              <td><?=$value->order_date;?></td>
                              <td>
                                  <span class="label label-warning">Order Placed</span>

                          <td>
                              <a class="btn-sm editField" href="<?=base_url();?>sale/SaleDetail/<?=$value->sale_id?>" data-toggle="tooltip" data-placement="top" title="" data-product_id="71" data-href="" data-type="sale_detail" data-original-title="View Sale detail">
                              <span class="fa fa-eye"></span>
                              </a>
                          </td>
                      </tr>
                          <?php $i++; }?>
                      </tbody>
                  </table>

                </div><!-- /.box-body -->

              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>
