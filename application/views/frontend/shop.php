

	<div class="gtco-section" style="background:#f2f2f2">
		<div class="gtco-container">



			<div class="row">
				<div class="col-md-3 animate-box">
					<aside class="sidebar-left">
                        <ul class="nav nav-tabs nav-stacked nav-coupon-category">
													<?php foreach($category_list as $list) { ?>
														<li><a href="<?php echo base_url();?>index.php/shop/product-by-category/<?php echo $list->id;?>"><i class="fa fa-cutlery"></i><?php echo $list->category_name; ?></a>
														</li>
													<?php } ?>
                            <!--<li class="active"><a href="#"><i class="fa fa-ticket"></i>All</a>
                            </li>
                            <li><a href="#"><i class="fa fa-cutlery"></i>Food &amp; Drink</a>
                            </li>
                            <li><a href="#"><i class="fa fa-calendar"></i>Events</a>
                            </li>
                            <li><a href="#"><i class="fa fa-female"></i>Beauty</a>
                            </li>
                            <li><a href="#"><i class="fa fa-bolt"></i>Fitness</a>
                            </li>
                            <li><a href="#"><i class="fa fa-headphones"></i>Electronics</a>
                            </li>
                            <li><a href="#"><i class="fa fa-image"></i>Furniture</a>
                            </li>
                            <li><a href="#"><i class="fa fa-umbrella"></i>Fashion</a>
                            </li>
                            <li><a href="#"><i class="fa fa-shopping-cart"></i>Shopping</a>
                            </li>
                            <li><a href="#"><i class="fa fa-home"></i>Home &amp; Garden</a>
                            </li>
                            <li><a href="#"><i class="fa fa-plane"></i>Travel</a>
                            </li>-->
                        </ul>


                    </aside>
				</div>
				<div class="col-md-9 animate-box">
					<div class="row">
                        <div class="col-md-3">
                            <div class="product-sort">
                                <span class="product-sort-selected">sort by <b>Price</b></span>
                                <a href="#" class="product-sort-order fa fa-angle-down"></a>
                                <ul>
                                    <li><a href="#">sort by Name</a>
                                    </li>
                                    <li><a href="#">sort by Date</a>
                                    </li>
                                    <li><a href="#">sort by Popularity</a>
                                    </li>
                                    <li><a href="#">sort by Rating</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-2 col-md-offset-7">
                            <div class="product-view pull-right">
                                <a class="fa fa-th-large active" href="#"></a>
                                <a class="fa fa-list" href="category-page-thumbnails-shop-horizontal.html"></a>
                            </div>
                        </div>
                    </div>



					<!--Products Section Start From Here-->
					<?php if(!empty($latest_product)) { ?>
						<h3>Latest Products</h3>
					<div class="row row-wrap">
							<?php foreach($latest_product as $latest) { ?>
                        <div class="col-md-4">
                            <div class="product-thumb">
                                <header class="product-header">
                                    <img src="<?php echo base_url(); ?>uploads/products/product_thumb/<?php echo $latest->product_image; ?>" alt="<?php echo $latest->product_name; ?>" title="<?php echo $latest->product_name; ?>" class="img-responsive">
                                </header>
                                <div class="product-inner">
                                    <ul class="icon-group icon-list-rating icon-list-non-rated" title="not rated yet">
                                        <li><i class="fa fa-star"></i>
                                        </li>
                                        <li><i class="fa fa-star"></i>
                                        </li>
                                        <li><i class="fa fa-star"></i>
                                        </li>
                                        <li><i class="fa fa-star"></i>
                                        </li>
                                        <li><i class="fa fa-star"></i>
                                        </li>
                                    </ul>
                                    <h5 class="product-title"><?php echo $latest->product_name; ?></h5>
                                    <p class="product-desciption"><?php echo $latest->product_description; ?></p>
                                    <div class="product-meta">
                                        <ul class="product-price-list">
                                            <li><span class="product-price">$ <?php echo $latest->product_price; ?></span>
                                            </li>
                                        </ul>
                                        <ul class="product-actions-list">
                                            <li>
																							<form action="<?php echo base_url();?>cart/add" method="post" name="productform" >
																											<?php echo form_hidden('id', $latest->id);
																											echo form_hidden('name', $latest->product_name);
																											echo form_hidden('image', $latest->product_image);
																											echo form_hidden('price', $latest->product_price);
																											echo form_hidden('qty', 1);
																											echo form_hidden('created_by', $latest->created_by);


																							?>
																							<li><button type="submit" class="btn btn-default btn-sm" >To Cart <i class="fa fa-shopping-cart"></i></button>
	                                            </li>
																							</form>
                                            </li>
                                            <li><a href="<?php echo base_url();?>index.php/shop/shopProduct/<?php echo $latest->id;?>" class="btn btn-sm"><i class="fa fa-bars"></i> Details</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
											<?php } ?>
											</div>
										<?php } ?>

										<?php if(!empty($popular_product)) { ?>
											<h3>Popular Products</h3>
										<div class="row row-wrap">
												<?php foreach($popular_product as $popular) { ?>
																	<div class="col-md-4">
																			<div class="product-thumb">
																					<header class="product-header">
																							<img src="<?php echo base_url(); ?>uploads/products/product_thumb/<?php echo $popular->product_image; ?>" alt="<?php echo $popular->product_name; ?>" title="<?php echo $popular->product_name; ?>" class="img-responsive">
																					</header>
																					<div class="product-inner">
																							<ul class="icon-group icon-list-rating icon-list-non-rated" title="not rated yet">
																									<li><i class="fa fa-star"></i>
																									</li>
																									<li><i class="fa fa-star"></i>
																									</li>
																									<li><i class="fa fa-star"></i>
																									</li>
																									<li><i class="fa fa-star"></i>
																									</li>
																									<li><i class="fa fa-star"></i>
																									</li>
																							</ul>
																							<h5 class="product-title"><?php echo $popular->product_name; ?></h5>
																							<p class="product-desciption"><?php echo $popular->product_description; ?></p>
																							<div class="product-meta">
																									<ul class="product-price-list">
																											<li><span class="product-price">$ <?php echo $popular->product_price; ?></span>
																											</li>
																									</ul>
																									<ul class="product-actions-list">
																										<li>
																											<form action="<?php echo base_url();?>cart/add" method="post" name="productform" >



																															<?php echo form_hidden('id', $popular->id);
																															echo form_hidden('name', $popular->product_name);
																															echo form_hidden('image', $popular->product_image);
																															echo form_hidden('price', $popular->product_price);
																															echo form_hidden('qty', 1);
																															echo form_hidden('created_by', $popular->created_by);

																											?>
																											<li><button type="submit" class="btn btn-default btn-sm" >To Cart <i class="fa fa-shopping-cart"></i></button>
																											</li>
																											</form>
																										</li>
																											<li><a href="<?php echo base_url();?>index.php/shop/shopProduct/<?php echo $popular->id;?>" class="btn btn-sm"><i class="fa fa-bars"></i> Details</a>
																											</li>
																									</ul>
																							</div>
																					</div>
																			</div>
																	</div>
																<?php } ?>
																</div>
															<?php } ?>
															<?php if(!empty($feature_product)) { ?>
																<h3>Feature Products</h3>
															<div class="row row-wrap">
																	<?php foreach($feature_product as $feature) { ?>
																						<div class="col-md-4">
																								<div class="product-thumb">
																										<header class="product-header">
																												<img src="<?php echo base_url(); ?>uploads/products/product_thumb/<?php echo $feature->product_image; ?>" alt="<?php echo $feature->product_name; ?>" title="<?php echo $feature->product_name; ?>" class="img-responsive">
																										</header>
																										<div class="product-inner">
																												<ul class="icon-group icon-list-rating icon-list-non-rated" title="not rated yet">
																														<li><i class="fa fa-star"></i>
																														</li>
																														<li><i class="fa fa-star"></i>
																														</li>
																														<li><i class="fa fa-star"></i>
																														</li>
																														<li><i class="fa fa-star"></i>
																														</li>
																														<li><i class="fa fa-star"></i>
																														</li>
																												</ul>
																												<h5 class="product-title"><?php echo $feature->product_name; ?></h5>
																												<p class="product-desciption"><?php echo $feature->product_description; ?></p>
																												<div class="product-meta">
																														<ul class="product-price-list">
																																<li><span class="product-price">$ <?php echo $feature->product_price; ?></span>
																																</li>
																														</ul>
																														<ul class="product-actions-list">
																															<li>
																																<form action="<?php echo base_url();?>cart/add" method="post" name="productform" >



																																				<?php echo form_hidden('id', $feature->id);
																																				echo form_hidden('name', $feature->product_name);
																																				echo form_hidden('image', $feature->product_image);
																																				echo form_hidden('price', $feature->product_price);
																																				echo form_hidden('created_by', $feature->created_by);
																																				echo form_hidden('qty', 1);

																																?>
																																<li><button type="submit" class="btn btn-default btn-sm" >To Cart <i class="fa fa-shopping-cart"></i></button>
																																</li>
																																</form>
																															</li>
																																<li><a href="<?php echo base_url();?>index.php/shop/shopProduct/<?php echo $feature->id;?>" class="btn btn-sm"><i class="fa fa-bars"></i> Details</a>
																																</li>
																														</ul>
																												</div>
																										</div>
																								</div>
																						</div>
																					<?php } ?>
																					</div>
																				<?php } ?>


					<!--end Of products Section-->

					<ul class="pagination">
                        <li class="prev disabled">
                            <a href="#"></a>
                        </li>
                        <li class="active"><a href="#">1</a>
                        </li>
                        <li><a href="#">2</a>
                        </li>
                        <li><a href="#">3</a>
                        </li>
                        <li><a href="#">4</a>
                        </li>
                        <li><a href="#">5</a>
                        </li>
                        <li class="next">
                            <a href="#"></a>
                        </li>
                    </ul>

				</div>
			</div>

		</div>
	</div>



<style>
.shoplisting:before{
		position:absolute;
		content:"";
		width:100%;
		height:100%;
		top:0px;
		left:0px;
		background-color:rgba(0, 0, 0, 0.6);
}
.sidebar-left {
    margin-right: 30px;
}
.nav-tabs.nav-stacked.nav-coupon-category {
    margin-bottom: 30px;
    -webkit-box-shadow: 0 3px 1px rgba(0,0,0,0.15);
    box-shadow: 0 3px 1px rgba(0,0,0,0.15);
}
.nav-tabs.nav-stacked.nav-coupon-category > li:first-child a {
    border-top: none;
}
.nav-tabs.nav-stacked.nav-coupon-category > .active > a {
    z-index: 2;
    background: #2a8fbd;
    color: #fff;
}
.nav-tabs.nav-stacked.nav-coupon-category > .active > a:before {
    content: '';
    position: absolute;
    height: 28px;
    width: 28px;
    top: 6px;
    right: -15px;
    background: #2a8fbd;
    -webkit-transform: rotate(45deg);
    -moz-transform: rotate(45deg);
    -o-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
    display: block;
}
.nav-tabs.nav-stacked.nav-coupon-category > .active > a .fa {
    background: #298dba;
    color: #fff;
    border-right: 1px solid #2681aa;
}
.nav-tabs.nav-stacked.nav-coupon-category > li > a {
    text-transform: uppercase;
    font-size: 13px;
    z-index: 1;
    -webkit-border-radius: 0;
    border-radius: 0;
    background: #fff;
    border-left: none;
    border-right: none;
    border: none;
    -webkit-transition: 0.2s;
    -moz-transition: 0.2s;
    -o-transition: 0.2s;
    -ms-transition: 0.2s;
    transition: 0.2s;
    height: 40px;
    line-height: 40px;
    padding: 0px 0px 0px 55px;
    position: relative;
    margin: 0;
    color: #666;
}
.nav-tabs.nav-stacked.nav-coupon-category > li > a .fa {
    -webkit-transform: translate3d(0, 0, 0);
    -moz-transform: translate3d(0, 0, 0);
    -o-transform: translate3d(0, 0, 0);
    -ms-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
    font-size: 18px;
    position: absolute;
    display: block;
    width: 40px;
    height: 40px;
    background: #fbfbfb;
    top: 0;
    left: 0;
    text-align: center;
    line-height: 40px;
    border-right: 1px solid #ededed;
}
.nav-tabs.nav-stacked.nav-coupon-category > li > a:hover {
    background: #fbfbfb;
    padding-left: 65px;
    color: #2a8fbd;
}
.nav-tabs.nav-stacked.nav-coupon-category > li > a:hover .fa {
    background: #2a8fbd;
    color: #fff;
}


.product-sort {
    position: relative;
    margin-bottom: 15px;
    font-size: 13px;
    display: table;
}
.product-sort .product-sort-selected {
    display: inline-block;
    padding: 5px 12px;
    -webkit-border-radius: 3px;
    border-radius: 3px;
    background: #fff;
    border: 1px solid #e6e6e6;
}
.product-sort b {
    font-weight: 600;
}
.product-sort .product-sort-order {
    margin-left: 4px;
    font-size: 15px;
    display: inline-block;
    width: 30px;
    height: 30px;
    line-height: 28px;
    text-align: center;
    color: #757575;
    background: #fff;
    border: 1px solid #e6e6e6;
    -webkit-border-radius: 3px;
    border-radius: 3px;
}
.product-sort > ul {
    list-style: none;
    margin: 0;
    padding: 5px 0 0 0;
    position: absolute;
    z-index: 5;
    display: none;
}
.product-sort > ul > li:first-child > a {
    -webkit-border-radius: 3px 3px 0 0;
    border-radius: 3px 3px 0 0;
}
.product-sort > ul > li > a {
    padding: 5px 12px;
    display: block;
    color: #666;
    background: #fff;
    border: 1px solid #e6e6e6;
    border-bottom: none;
    font-size: 12px;
}
.product-sort:hover > ul {
    display: block;
}
.product-view > .fa.active {
    background: #666;
    border-color: #4d4d4d;
    color: #fff;
    cursor: default;
}
.product-view > .fa:first-child {
    margin-right: 5px;
}
.product-view > .fa {
    display: inline-block;
    width: 30px;
    height: 30px;
    background: #fff;
    line-height: 28px;
    border: 1px solid #e6e6e6;
    text-align: center;
    color: #666;
    -webkit-border-radius: 3px;
    border-radius: 3px;
}
.product-thumb {
    z-index: 1;
    position: relative;
    text-decoration: none !important;
    display: block;
    -webkit-transition: 0.3s;
    -moz-transition: 0.3s;
    -o-transition: 0.3s;
    -ms-transition: 0.3s;
    transition: 0.3s;
    -webkit-transform: translate3d(0, 0, 0);
    -moz-transform: translate3d(0, 0, 0);
    -o-transform: translate3d(0, 0, 0);
    -ms-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
    text-align: center;
    -webkit-box-shadow: 0 1px 1px rgba(0,0,0,0.2);
    box-shadow: 0 1px 1px rgba(0,0,0,0.2);
    -webkit-border-radius: 5px;
    border-radius: 5px;
margin-bottom: 35px;
}
.product-header {
    position: relative;
    -webkit-border-radius: 5px 5px 0 0;
    border-radius: 5px 5px 0 0;
}
.product-thumb .product-header >img {
    display: block;
    -webkit-border-radius: 5px 5px 0 0;
    border-radius: 5px 5px 0 0;
}
img {
    width: 100%;
    max-width: none;
}
.product-thumb .product-inner {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    background: #fff;
    padding: 20px 22px;
    border-top: none;
    position: relative;
    -webkit-border-radius: 0 0 5px 5px;
    border-radius: 0 0 5px 5px;
}
.product-thumb .icon-list-non-rated {
    color: #949494 !important;
}
.product-thumb .icon-list-rating {
    font-size: 11px;
    color: #48aad6;
    margin-bottom: 4px;
}
.icon-list-rating.icon-list-non-rated {
    opacity: 0.5;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
    filter: alpha(opacity=50);
}
.icon-group {
    list-style: none;
    margin: 0;
    padding: 0;
}
.icon-group > li {
    line-height: 1em;
    display: inline-block;
    margin-right: 3px;
}
.product-thumb .product-title {
    -webkit-transform: translate3d(0, 0, 0);
    -moz-transform: translate3d(0, 0, 0);
    -o-transform: translate3d(0, 0, 0);
    -ms-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
    z-index: 2;
    margin-bottom: 5px;
    font-size: 16px;
}
.product-desciption {
    color: #858585;
    font-size: 12px;
    margin-bottom: 0;
    line-height: 1.4em;
}
.product-thumb .product-meta {
    margin-top: 15px;
}
.product-thumb .product-price-list {
    font-size: 15px;
    margin-bottom: 0;
}
.product-thumb .product-price-list, .product-thumb .product-actions-list {
    list-style: none;
    margin: 0;
    padding: 0;
}
.product-thumb .product-price-list > li:last-child, .product-thumb .product-actions-list > li:last-child {
    margin-right: 0;
}
.product-thumb .product-price-list > li, .product-thumb .product-actions-list > li {
    margin-right: 15px;
    display: inline-block;
}
.product-thumb .product-price-list > li > span {
    display: block;
    line-height: 30px;
    text-align: center;
    height: 30px;
}
.product-thumb .product-price {
    font-weight: 600;
    color: #fff;
    padding: 0 7px;
    background: #1f93c8;
    -webkit-border-radius: 3px;
    border-radius: 3px;
}
.product-thumb .product-actions-list {
    padding-top: 15px;
    margin-top: 15px;
    border-top: 1px dashed #e6e6e6;
}
.product-thumb .product-price-list, .product-thumb .product-actions-list {
    list-style: none;
    margin: 0;
    padding: 0;
}
.product-thumb .product-price-list > li, .product-thumb .product-actions-list > li {
    margin-right: 15px;
    display: inline-block;
}
.btn {
    border: none;
    -webkit-border-radius: 3px;
    border-radius: 3px;
    text-shadow: none;
    -webkit-transition: all 0.3s;
    -moz-transition: all 0.3s;
    -o-transition: all 0.3s;
    -ms-transition: all 0.3s;
    transition: all 0.3s;
    -webkit-box-shadow: none;
    box-shadow: none;
    color: #666;
    border: 1px solid #e6e6e6;
}
.btn-sm, .btn-group-sm > .btn {
    padding: 5px 10px;
    font-size: 12px;
    line-height: 1.5;
    border-radius: 3px;
}
.product-thumb .product-actions-list {
    padding-top: 15px;
    margin-top: 15px;
    border-top: 1px dashed #e6e6e6;
}
ul.pagination li.next a:before {
    content: '\f054';
}
ul.pagination li.prev a:before, ul.pagination li.next a:before {
    font-size: 12px;
    font-family: 'FontAwesome';
    line-height: 1em;
}
ul.pagination li a {
    -webkit-border-radius: 3px;
    border-radius: 3px;
    margin-right: 5px;
    border: 1px solid #e6e6e6;
    color: #2a8fbd;
}
ul.pagination li.prev a:before {
    content: '\f053';
}
ul.pagination li.active a {
    background: #2a8fbd;
    border-color: #2681aa;
    color: #fff;
}
</style>



	</body>
</html>
