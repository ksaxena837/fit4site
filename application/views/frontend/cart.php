<section id="cartshop">
<div class="container">
	<div class="shop-cart">
		<h3>My Shopping Bag(<?php echo ($this->cart->contents())?$this->cart->total_items():'0'; ?>)</h3>
		<?php if(!empty($this->cart->contents())) { ?>
		<table class="table table-striped table-bordered" >
			<thead>
				<tr>
					<th></th>
					<th>Thumb</th>
					<th>Product Name</th>
					<th>Price</th>
					<th>Quanity</th>
					<th>Total</th>
				</tr>
			</thead>
			<tbody>
				<?php

				 echo form_open('cart/update_cart');
				 $grand_total = 0;
				 $i = 1;
				foreach($this->cart->contents() as $cart){ ?>
				<tr>
					<td class="text-center"><a href="<?php echo base_url();?>index.php/cart/remove/<?php echo $cart['rowid'];?>" class="remove" id="removep12"><i class="fa fa-times-circle-o" aria-hidden="true"></i></a></td>
					<td><img src="<?php echo base_url();?>uploads/products/product_thumb/<?php echo $cart['image'];?>" alt="product-thumb" class="product-thumb"/></td>
					<td><?php echo $cart['name'];?></td>
					<td>$<?php echo $cart['price'];?></td>
					<td><input type="number" name="cart[<?php echo $cart['id'].']' . '[qty]';?>" value="<?php echo $cart['qty'];?>" min="1" class="form-control quantity"></td>
					<td>$<?php echo $cart['qty']*$cart['price'];?></td>
				</tr>
				<?php
				echo form_hidden('cart[' . $cart['id'] . '][id]', $cart['id']);
				echo form_hidden('cart[' . $cart['id'] . '][rowid]', $cart['rowid']);
				echo form_hidden('cart[' . $cart['id'] . '][name]', $cart['name']);
				echo form_hidden('cart[' . $cart['id'] . '][price]', $cart['price']);
				echo form_hidden('cart[' . $cart['created_by'] . '][created_by]', $cart['created_by']);
				 $grand_total = $grand_total + $cart['subtotal'];
				?>
			<?php } ?>
			</tbody>
			<tfoot>
				<tr>

					<td colspan="6"><a href="<?php echo base_url();?>index.php/cart/remove/all" class="btn btn-primary pull-right" style="border-radius:3px;">Clear Cart</a><button type="submit" name="update" class="btn btn-primary pull-right" style="border-radius:3px;">Update</button></td>
				</tr>
			</tfoot>
			  <?php echo form_close(); ?>
		</table>
	<?php }else{ ?>
			<h3><span style="font-size: 18px;"> Your Cart has been empty add item!! </span><a href="<?php echo base_url();?>index.php/shop"  class="btn btn-primary btn-block" style="border-radius:3px;">Shop Now</a></h3>
	<?php } ?>
		<!--End of table-->
	</div>
	<!--End of Shop Cart-->
<?php if(!empty($this->cart->contents())) { ?>
	<div class="row">
		<div class="col-sm-6 col-sm-offset-6">
			<h3>Cart totals</h3>
			<table class="table" style="border:1px solid #eee">
				<tr>
					<th>Subtotal</th>
					<td><span class="subtotal">$<?php echo $grand_total; ?></span></td>
				</tr>
				<tr>
					<th>Tax</th>
					<td><span class="tax">$5</span></td>
				</tr>
				<tr>
					<th>Total</th>
					<td><span class="total">$<?php echo $grand_total = $grand_total+5; ?></span></td>
				</tr>
			</table>
			<a href="<?php echo base_url();?>index.php/checkout" class="btn btn-primary btn-block" style="border-radius:3px;">Proceed to checkout</a>
		</div>
	</div>
<?php } ?>
	<!--end of total-cart-->


</div>
<!--End of Container-->
</section>
<!--End of cart Section-->
