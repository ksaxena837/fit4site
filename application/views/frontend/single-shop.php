	<div class="single-job-listing animate-box">
		<div class="gtco-container">
		<div class="product-container">


			 <!-- lens options start -->
			<section id="lens" class="single-product">
			<div class="row">

			  <div class="col-sm-5">
				<div class="xzoom-container">
				  				  <img class="xzoom3" src="<?php echo base_url();?>uploads/products/product_thumb/<?php echo $product_detail[0]->product_image;?>" xoriginal="<?php echo base_url();?>uploads/products/<?php echo $product_detail[0]->product_image;?>" />

				</div>
			  </div>
			  <div class="col-sm-7">
				<h3 class="page-header" style="margin-top:0px;"><?php echo $product_detail[0]->product_name;?></h3>
				<div class="rating">
					<ul class="list-unstyled list-inline">
						<li><i class="fa fa-star rate-yes"></i></li>
						<li><i class="fa fa-star rate-yes"></i></li>
						<li><i class="fa fa-star rate-yes"></i></li>
						<li><i class="fa fa-star"></i></li>
						<li><i class="fa fa-star"></i></li>
					</ul>
				</div>
				<div class="price">$<?php echo $product_detail[0]->product_price;?></div>
				<ul class="list-unstyled product-info-box">
					<li><strong>Availability:</strong> <?php echo ($product_detail[0]->quantity!=0)?'In Stock' :'Out of Stock';?> </li>
					<li><strong>Product Code:</strong> # <?php echo $product_detail[0]->product_code;?> </li>
					<li><strong>Category:</strong> <a href=""><?php echo $product_detail[0]->category_name; ?></a></li>

				</ul>

				<hr/>
				<p class="short-desc"><?php echo $product_detail[0]->product_description;?></p>

				<div class="single-add-to-cart">
					<form action="<?php echo base_url();?>cart/add" method="post" name="productform" >
									<?php echo form_hidden('id', $product_detail[0]->id);
									echo form_hidden('name', $product_detail[0]->product_name);
									echo form_hidden('image', $product_detail[0]->product_image);
									echo form_hidden('price', $product_detail[0]->product_price);
									echo form_hidden('created_by', $product_detail[0]->created_by);
									echo form_hidden('qty', 1);
					?>

					<button type="submit" id="product-id#123" class="btn btn-primary">ADD TO CART</button>
					</form>

				</div>

			  </div>
			</div>

			<div class="addintional-info">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#description" aria-controls="description" role="tab" data-toggle="tab">Description</a></li>
					<li role="presentation"><a href="#additional" aria-controls="additional" role="tab" data-toggle="tab">Additional</a></li>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="description">
						<p><?php echo $product_detail[0]->product_long_description;?> </p>
					</div>
					<div role="tabpanel" class="tab-pane" id="additional">
						<p><?php echo $product_detail[0]->additional;?> </p>
					</div>
				</div>


			</div>


			</section>
			<!-- lens options end -->





		</div>

		</div>
		<!--end of container-->


		<section id="related-products" class="related related-pruducts">
		<div class="gtco-container">
				<div class="col-sm-12 page-header title-related">Related products</div>
				<ul class="products list-unstyled row">
					<li class="col-sm-3">
						<div class="thumbnail">
							<a href=""><img src="images/shop/gamer_chick_800x600.jpg" alt="" class="img-responsive"/></a>
							<div class="product-name">Product Name</div>
						</div>
					</li>

					<li class="col-sm-3">
						<div class="thumbnail">
							<a href=""><img src="images/shop/our_coffee_miss_u_800x600.jpg" alt="" class="img-responsive"/></a>
							<div class="product-name">Product Name</div>
						</div>
					</li>

					<li class="col-sm-3">
						<div class="thumbnail">
							<a href=""><img src="images/shop/the_violin_800x600.jpg" alt="" class="img-responsive"/></a>
							<div class="product-name">Product Name</div>
						</div>
					</li>

					<li class="col-sm-3">
						<div class="thumbnail">
							<a href=""><img src="images/shop/green_furniture_800x600.jpg" alt="" class="img-responsive"/></a>
							<div class="product-name">Product Name</div>
						</div>
					</li>

				</ul>
			</div>
			</section>
			<!--end of related product section-->

	</div>
	<!--end of single-job-listing-page-->


	<style>
	.joblisting:before{
		position:absolute;
		content:"";
		width:100%;
		height:100%;
		top:0px;
		left:0px;
		background-color:rgba(0, 0, 0, 0.6);
	}
	#lens {
		padding: 35px 0px;
		clear: both;
	}
	.single-product .rating ul li {
		margin-right: -10px;
		color: #c5c4c4;

	}
	.single-product .price{
		font-size: 26px;
		font-weight: 700;
	}
	.single-product .rating ul li i {
		color: #fff;
		background: #a4a1a1;
		padding: 3px;
	}
	.single-product .rating ul li i.rate-yes {
		color: #fff;
		background: #5f6060;
		padding: 3px;
	}
	.product-info-box{
		margin-top:10px;
		font-size:14px;
	}
	.single-add-to-cart button{
		border-radius: 3px;
	}
	#related-products {
		background: #eee;
		padding-bottom: 40px;
	}
	#related-products ul li .product-name{
		text-align:center;
		margin:10px 0px;
	}
	#related-products .title-related {
		font-size: 22px;
		padding-left: 0px;
		color: #333;
	}
	</style>
