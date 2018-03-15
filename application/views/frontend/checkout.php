<section id="checkout-page" class="checkout-page clearfix">
<div class="container">

<div class="page-header">
<h3>Checkout Page</h3>
</div>
<!--End of Page Header-->
<div class="checkout-form">
	<form action="<?php echo base_url();?>index.php/checkout/placeOrder" method="post">

	<div class="row">
		<div class="col-sm-6 left-side-checkout">
			<fieldset class="row">
				<div class="form-group col-sm-6">
				<label for="first_name">First Name</label>
				<input type="text" name="first_name" class="first_name form-control" placeholder="First Name" />
				</div>

				<div class="form-group col-sm-6">
				<label for="last_name">Last Name</label>
				<input type="text" name="last_name" class="last_name form-control" placeholder="Last Name" />
				</div>
			</fieldset>

			<fieldset>
			<div class="form-group">
				<label for="email">Email*</label>
				<input type="email" name="email" class="email form-control" placeholder="Email Address" />
			</div>
			</fieldset>

			<fieldset>
			<div class="form-group">
				<label for="address_one">Address 1</label>
				<textarea name="address_one" class="address_one form-control" placeholder="Address 1"></textarea>
			</div>
			</fieldset>

			<fieldset>
			<div class="form-group">
				<label for="address_two">Address 2</label>
				<textarea name="address_two" class="address_two form-control" placeholder="Address 2"></textarea>
			</div>
			</fieldset>

			<fieldset>
			<div class="form-group">
				<label for="phone">Phone</label>
				<input type="number" name="phone" class="phone form-control" placeholder="Phone No." />
			</div>
			</fieldset>

			<fieldset>
			<div class="form-group">
				<label for="country">Country</label>
				<input type="text" name="country" class="country form-control" placeholder="Country" />
			</div>
			</fieldset>

			<fieldset>
			<div class="form-group">
				<label for="city">City</label>
				<input type="text" name="city" class="city form-control" placeholder="City" />
			</div>
			</fieldset>

			<fieldset>
			<div class="form-group">
				<label for="province">Province</label>
				<input type="text" name="province" class="province form-control" placeholder="Province" />
			</div>
			</fieldset>

			<fieldset>
			<div class="form-group">
				<label for="postcode">Postcode</label>
				<input type="text" name="postcode" class="postcode form-control" placeholder="Postcode" />
			</div>
			</fieldset>

		</div>
		<!--End of col-sm-6-->

		<div class="col-sm-6 right-side-checkout">
			<h4 class="alert alert-warning">Order Detail</h4>
			<table class="table">
				<thead>
				<tr>
					<th>Product</th>
					<th>Total</th>
				</tr>
				</thead>
				<tbody>
					<?php
					$grand_total = 0;
					$i = 1;
					foreach($this->cart->contents() as $cart){ ?>
				<tr>
					<td><?php echo $cart['name'];?> <strong>X <?php echo $cart['qty'];?></strong></td>
					<td>$<?php echo $cart['price']*$cart['qty'];?></td>
				</tr>
				<?php $grand_total = $grand_total+$cart['subtotal'];?>
			<?php } ?>
				</tbody>
				<tfoot>
				<tr>
					<th>Sub Total</th>
					<td>$<?php echo number_format($grand_total, 2) ?></td>
				</tr>
				<tr>
					<th>Total(Including Tax)</th>
					<td>$<?php echo $grand_total = $grand_total+5; ?></td>
				</tr>
				</tfoot>
			</table>


			<div class="panel panel-default">
			  <div class="panel-heading">Payment Method</div>
			  <div class="panel-body">
				<div class="form-group">
					<label><input type="radio" value="cod" name="pay_method"/> Cash on Delievery</label>
				</div>
				<div class="form-group">
					<label><input type="radio" value="bank_transfer" name="pay_method"/> Bank Transfer</label>
				</div>
			  </div>
			</div>

			<div class="form-group">
			<label><input type="checkbox" required name="terms_and_conditions"/> I’ve read and accept the terms & conditions</label>
			</div>
			<button type="submit" name="purchased" class="btn btn-primary btn-block" style="border-radius:3px;">PURCHASE NOW</button>
		</div>
		<!--End of right side checkout-->




	</div>
	<!--end of row-->
</form>
</div>
<!--End of Checkout-Form-->


</div>
<!--End of Checkout Page-->
</section>
<!--End of checkout-page-->
