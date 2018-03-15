<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-portfolio"></i>Order
        <small>Status</small>
      </h1>
    </section>
<section class="content">
<div class="box box-header">
    <div class="col-sm-6 col-md-3">
        <a class="block block-link-hover3 text-center" href="javascript:void(0)">
            <div class="block-content block-content-full">
                <span class="item item-circle bg-success-light"><i class="fa fa-check text-success"></i></span>
            </div>
            <div class="block-content block-content-full block-content-mini bg-gray-lighter text-success font-w600">Order</div>
        </a>
    </div>
    <div class="col-sm-6 col-md-3">
        <a class="block block-link-hover3 text-center" href="javascript:void(0)">
            <div class="block-content block-content-full">
                <span class="item item-circle bg-success-light"><i class="fa fa-check text-success"></i></span>
            </div>
            <div class="block-content block-content-full block-content-mini bg-gray-lighter text-success font-w600">Cash Payment</div>
        </a>
    </div>
    <?php
    foreach ($deliver_sale as $deliver)
    {
        if($deliver->shipped_status == 0)
        {
        ?>
    <div class="col-sm-6 col-md-3">
        <a class="block block-link-hover3 text-center" href="javascript:void(0)">
            <div class="block-content block-content-full">
                <span class="item item-circle bg-warning-light"><i class="fa fa-times text-muted"></i></span>
            </div>
            <div class="block-content block-content-full block-content-mini bg-gray-lighter text-warning font-w600">Processing</div>
        </a>
    </div>
    <?php
        }
        else
        {?>
            <div class="col-sm-6 col-md-3">
                <a class="block block-link-hover3 text-center" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <span class="item item-circle bg-success-light"><i class="fa fa-times text-success"></i></span>
                    </div>
                    <div class="block-content block-content-full block-content-mini bg-gray-lighter text-success font-w600">Processing</div>
                </a>
            </div>
    <?php    }
    }
    foreach ($deliver_sale as $deliver)
    {
        if($deliver->shipped_status == 0)
        {
        ?>
    <div class="col-sm-6 col-md-3">
        <a class="block block-link-hover3 text-center" href="javascript:void(0)">
            <div class="block-content block-content-full">
                <span class="item item-circle bg-gray-lighter"><i class="fa fa-times text-muted"></i></span>
            </div>
            <div class="block-content block-content-full block-content-mini bg-gray-lighter text-muted font-w600">Delivery</div>
        </a>
    </div>
        <?php }
        else
        {?>
            <div class="col-sm-6 col-md-3">
                <a class="block block-link-hover3 text-center" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <span class="item item-circle bg-success-light">
                            <i class="fa fa-check text-success"></i>
                        </span>
                    </div>
                    <div class="block-content block-content-full block-content-mini bg-gray-lighter text-success font-w600">Delivery</div>
                </a>
            </div>

       <?php }
    }
        ?>
</div>
<!-- END Header Tiles -->

<!-- Products -->
<div class="box box-header">

    <div class="block-content">
        <div class="table-responsive">
            <table class="table table-borderless table-striped table-vcenter">
                <thead>
                    <tr>
                        <th>Sale No</th>
                        <th>Product Code</th>
                        <th>Product Image</th>
                        <th>Product Name</th>
                        <th>Product Description</th>
                        <th>Quantity </th>
                        <th>Product Price</th>
                        <th>Total Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $totalamount = 0;
                    $totalprice = 0;
                    foreach ($sale_detail as $post)
                    {

                    ?>
                    <tr>
                        <td><?=$post->sale_id?></td>
                        <td><?=$post->product_code?></td>

                        <td><img height="100px" width="100px" src="<?=base_url();?>/uploads/products/product_thumb/<?=$post->product_image?>"></td>

                        <td><?=$post->product_name?></td>
                        <td><?=$post->product_description?></td>
                        <td><?=$post->quantity?></td>
                        <td><?=$post->product_price?></td>
                        <td><?php
                            $totalamount =  $post->quantity * $post->product_price;
                            echo $totalamount;
                            $totalprice = $totalprice+$totalamount;
                        ?></td>

                    </tr>
                    <?php
                    }?>
                    <tr>
                        <td colspan="9" class="text-right"><strong>Total Price:</strong></td>
                        <td>Rs. <?=$totalprice?></td>
                    </tr>
                    <tr>
                        <td colspan="9" class="text-right text-uppercase"><strong>Total Paid(including tax):</strong></td>
                        <td><strong>Rs. <?=$totalprice+5?></strong></td>
                    </tr>
<!--                                        <tr class="success">
                        <td colspan="6" class="text-right text-uppercase"><strong>Total Due:</strong></td>
                        <td ><strong>Rs. 0,00</strong></td>
                    </tr>-->
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- END Products -->
<!-- Customer -->
<div class="box box-header">
    <?php
     foreach ($sale_address_detail as $address)
       {?>
    <div class="col-lg-6">
        <!-- Billing Address -->
        <div class="block box box-primary container">
            <div class="block-header bg-gray-lighter">
                <h3 class="block-title">Billing Address</h3>
            </div>
            <div class="block-content block-content-full">
                <div class="h4 push-5" style="text-transform: uppercase;"><?= $address->firstname?>&nbsp;<?= $address->lastname?></div>
                <address>
                   <?=$address->address1?><br>
                    <?=$address->city?><br>
                   <?=$address->country?>, <?=$address->postcode?><br>
                   <?=$address->order_date?><br><br>
                    <i class="fa fa-phone"></i> <?=$address->phone?><br>
                    <i class="fa fa-envelope-o"></i> <a href="javascript:void(0)"><?=$address->email?></a>
                </address>
            </div>
        </div>
        <!-- END Billing Address -->
    </div>
    <div class="col-lg-6">
        <!-- Shipping Address -->
        <div class="block box box-primary container">
            <div class="block-header bg-gray-lighter">
                <h3 class="block-title">Shipping Address</h3>
            </div>
            <div class="block-content block-content-full">
                <div class="h4 push-5" style="text-transform: uppercase;"><?= $address->firstname?>&nbsp;<?= $address->lastname?></div>
                 <address>
                   <?=$address->address1?><br>
                    <?=$address->city?><br>
                   <?=$address->country?>, <?=$address->postcode?><br>
                   <?=$address->order_date?><br><br>
                    <i class="fa fa-phone"></i> <?=$address->phone?><br>
                    <i class="fa fa-envelope-o"></i> <a href="javascript:void(0)"><?=$address->email?></a><br>

                </address>
            </div>
        </div>
        <!-- END Shipping Address -->
    </div>
       <?php }?>
</div>
<!-- END Customer -->
<?php
 if($role == 4)
{?>
<div class="row">
    <?php
foreach ($deliver_sale as $deliver)
{
    if($deliver->shipped_status == 0)
    {
    ?>
        <div class="col-lg-12" style="text-align: right;">
             <button class="btn btn-minw btn-rounded btn print" type="button"><i class="fa fa-check"></i> Print</button>
            <a href="<?=base_url();?>index.php/sale/SaleStatus/<?=$deliver->id?>" class="btn btn-minw btn-rounded btn-success" type="button"><i class="fa fa-check"></i> Deliver</a>

        </div>
    <?php }
    else
    {?>
    <div class="col-lg-12" style="text-align: right;">
        <button class="btn btn-minw btn-rounded btn print" type="button"><i class="fa fa-check"></i> Print</button>
    </div>
  <?php }
}?>
</div>
<?php } ?>

<!-- Log Messages -->

<!-- END Log Messages -->

<!-- END Page Content -->
</section>
</div>
<script>
    $(document).ready(function() {
        $('.print').click(function() {
         var prtContent = document.getElementById("pint_specific_data");
 		var WinPrint = window.open('', '', 'left=0,top=0,width=1000,height=900,toolbar=0,scrollbars=0,status=0');
            WinPrint.document.write('<html><body><br>'+
			<?php
					foreach ($sale_address_detail as $c)
					{
				?>
			'<table width="80%" border="0" cellpadding="0" cellspacing="0" >'+
				'<tr>'+
					'<td valign="top" style="text-transform: capitalize;"><b><?php echo $c->firstname." ".$c->lastname?></b><br><?php echo $c->address1?>,&nbsp;<?php echo $c->city?></td>'+
					'<td><b>Mobile:</b>&nbsp;<?php echo $c->phone ?><br><b>Email:</b>&nbsp;<?php echo $c->email ?><br><b>Date:</b>&nbsp;<?php echo $c->order_date ?></td>'+
				'</tr>'+

			'</table><br>'+
			<?php }?>
			'<table width="100%" border="1" cellpadding="10" cellspacing="0" >'+
			'<thead>'+
					'<tr>'+
						'<th>Sale No</th>'+
						'<th>Product Code</th>'+
						'<th>Product Name</th>'+
            '<th>Quantity </th>'+
            '<th>Product Price </th>'+
            '<th>Total Amount </th>'+
					'</tr>'+
				'</thead>'+
				'<tbody>'+
					<?php
					$grand_amount = 0;
					foreach ($sale_detail as $value) {?>
						'<tr>'+
							'<td><?php echo $value->id ?></td>'+
							'<td><?php echo $value->product_code ?></td>'+
							'<td><?php echo $value->product_name ?></td>'+
                                                        '<td><?php echo $value->quantity?></td>'+
                                                        '<td><?php echo $value->product_price?></td>'+
							'<td><?php $net =  $value->quantity * $value->product_price;
                                                        echo $net;
                                                        $grand_amount = $grand_amount+ $net;
                                                        ?></td>'+
						'</tr>'+
					<?php
					}
					?>
					'<tr>'+
                    	'<td colspan="4"></td>'+
                        '<td><b>Total (including tax)</b></td>'+
						'<td ><b><?php echo $grand_amount+5;?></b></td>'+
					'</tr>'+
				'</tbody>'+
			'</table></body></html>');
            WinPrint.document.close();
            WinPrint.focus();
            WinPrint.print();

//            WinPrint.document.close();
//            WinPrint.focus();
//            WinPrint.print();
//            WinPrint.close();

        });
    });
    </script>
