<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-portfolio"></i> Product Management
        <small>Edit Product</small>
      </h1>
    </section>
    <div class="col-md-12">
        <?php
            $this->load->helper('form');
            $error = $this->session->flashdata('error');
            if($error)
            {
        ?>
        <!--<div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php echo $this->session->flashdata('error'); ?>
        </div>-->
        <?php } ?>
        <?php
            $success = $this->session->flashdata('success');
            if($success)
            {
        ?>
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php echo $this->session->flashdata('success'); ?>
        </div>
        <?php } ?>

        <!--<div class="row">
            <div class="col-md-12">
                <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
            </div>
        </div>-->
    </div>
    <section class="content">

        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->



                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Store Name : <?php echo ($store[0]->business_title)?$store[0]->business_title:'';?></h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" id="addUser" action="<?php echo base_url() ?>index.php/account/product/editProduct/<?php echo $product->id;?>" method="post" role="form" enctype="multipart/form-data">
                      <input type="hidden" name="store_id" value="<?php echo $store[0]->id;?>" />
                        <div class="box-body">
                          <!--<div class="col-md-12">
                              <div class="form-group">
                                  <label for="product_code">Product Code</label>
                                    <input class="form-control" type="text" readonly="" id="product_code" value="<?php echo $product->product_code; ?>" name="product_code" placeholder="Product Code" >
                                    <div style="margin-top: 0px; color: red;"><?= form_error('product_code'); ?></div>
                                </div>
                            </div>-->

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="product_code">Product Name</label>
                                    <input class="form-control" type="text" id="product_name" value="<?php echo $product->product_name; ?>" name="product_name" placeholder="Product Name" >
                                     <div style="margin-top: 0px; color: red;"><?= form_error('product_name'); ?></div>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="product_code">Product Short Description</label>
                                    <textarea class="form-control input-lg" id="product_description"  name="product_description" placeholder="Product Description" rows="4" ><?php echo $product->product_description; ?></textarea>
                                    <div style="margin-top: 0px; color: red;"><?= form_error('product_description'); ?></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="product_code">Product Long Description</label>
                                    <textarea class="form-control input-lg" id="product_long_description"  name="product_long_description" placeholder="Product Long Description" rows="4" ><?php echo $product->product_long_description; ?></textarea>
                                    <div style="margin-top: 0px; color: red;"><?= form_error('product_long_description'); ?></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="product_code">Product Additional</label>
                                    <textarea class="form-control input-lg" id="additional"  name="additional" placeholder="Additional" rows="4" ><?php echo $product->additional; ?></textarea>
                                    <div style="margin-top: 0px; color: red;"><?= form_error('additional'); ?></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="product_code">Product Category</label>
                                    <select class="form-control" name="product_category" id="subcategoryview" >
                                      <option value="">Select Category </option>
                                        <?php
                                        foreach ($category_list as $post)
                                        {?>
                                        <option <?php echo ($product->category_id==$post->id)?'selected':'';?> value="<?php echo $post->id?>"><?php echo $post->category_name?></option>
                                       <?php }
                                        ?>

                                    </select>
                                     <div style="margin-top: 0px; color: red;"><?= form_error('product_category'); ?></div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">

                                <div id="subcat">
                                    <label class="col-md-2 control-label">Sub Category<span class="text-danger">*</span></label>
                                    <div class="col-md-7">
                                        <select class="form-control" multiple="" name="sub_category_id[]" >
                                        </select>
                                    </div>
                                </div>
                            </div>
                          </div>




                          <div class="col-md-12">
                              <div class="form-group">
                                  <label for="product_code">Related Product</label>
                                        <select  class="form-control" name="relatedproduct[]"  multiple id="relatedproduct">
                                       <?php
                                            foreach ($product_list as $post)
                                            {?>
                                            <option <?php echo ($product->related_product==$post->id)?'selected':'';?> value="<?=$post->id?>"><?=$post->product_name?></option>
                                           <?php }
                                       ?>
                                       </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="product_code">Product Type</label>
                                    <select class="form-control" name="product_type" >

                                        <option <?php echo ($product->product_type==1)?'selected':'';?> value="1">Latest</option>
                                        <option <?php echo ($product->product_type==2)?'selected':'';?> value="2">Popular</option>
                                        <option <?php echo ($product->product_type==3)?'selected':'';?> value="3">Feature</option>

                                    </select>
                                     <div style="margin-top: 0px; color: red;"><?= form_error('product_type'); ?></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Product Image<span class="text-danger">*</span></label>
                                <div class="col-md-7">
                                    <img id="previewimage" onclick="$('#uploadFile').click();" src="<?php echo base_url(); ?>uploads/products/<?php echo $product->product_image;?>" style="cursor: pointer;height: 210px;width: 210px;position: relative;z-index: 10;"/>
                                    <input type="file" id="uploadFile" name="product_image" style="position: absolute; margin: 0px auto; visibility: hidden;" accept="image/*" />
                                    <div style="margin-top: 0px; color: red;"><?= form_error('product_image'); ?></div>
                                </div>
                                <input type="hidden" name="oldproductimg" value="<?php echo $product->product_image; ?>" >
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="product_rate">Product Rate</label>
                                    <input class="form-control" type="text"  name="rate" value="<?php echo $product->product_price; ?>" placeholder="Product Price"  id="rate">
                                       <div style="margin-top: 0px; color: red;"><?= form_error('rate'); ?></div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="product_code">Product Quantity</label>
                                    <input class="form-control quantity" type="text" id="quantity" value="<?php echo $product->quantity;?>" name="quantity" placeholder="Quantity Price"  >
                                     <div style="margin-top: 0px; color: red;"></div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="product_code">Product Gross Amount</label>
                                    <input class="form-control" type="text" readonly=""  id="gross" value="<?php echo $product->gross_amount;?>" name="gross_amount" placeholder="Gross Amount"  >
                                     <div style="margin-top: 0px; color: red;"></div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="product_code">Product Discount</label>
                                    <input class="form-control discount" type="text" value="<?php echo $product->discount;?>" id="discount" name="product_discount" placeholder="Product Discount" >
                                    <div style="margin-top: 0px; color: red;"><?= form_error('product_discount'); ?></div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="product_code">Net Amount</label>
                                    <input class="form-control" type="text" readonly="" id="net" name="net_amount" value="<?php echo $product->net;?>" placeholder="Net Product" >
                                </div>
                            </div>

                          </div>

                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <input type="reset" class="btn btn-default" value="Reset" />
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>

</div>
<script src="<?php echo base_url(); ?>assets/js/addUser.js" type="text/javascript"></script>
<script>

$('#relatedproduct').multiselect({
    columns: 1,
    placeholder: 'None Selectd',
    search: true,
    selectAll: true
});
$('#colorproduct').multiselect({
    columns: 1,
    placeholder: 'None Selectd',
    search: true,
    selectAll: true
});
$('#sizeproduct').multiselect({
    columns: 1,
    placeholder: 'None Selectd',
    search: true,
    selectAll: true
});

</script>
<script>

$('document').ready(function()
{
	function readURL(input) {
		if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $('#previewimage').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
		}
	}
		$("#uploadFile").change(function(){
			readURL(this);
		});

  $('.AutoGenerate').bind("click", function() {
      $.post("<?php echo base_url() . 'index.php/account/product/product_code' ?>", {}, function(data) {
        $('#product_code').val(data);
    });
	});

  $('#subcategoryview').change(function(event)
  {
      var category_id = $(this).val()
      $.ajax({
			url:'<?=site_url('account/subcategory_view')?>',
			data:"category_id="+category_id,
			type:"post",
			dataType: "json",
			success: function(data) {
				$('#subcat').html(data.html);
			}
		});
  });




var quantity_blur=function()
{
    var quantity = $('#quantity').val().trim();
    if(quantity==='' || isNaN(quantity))
    {
        $('#quantity').val('1');
        quantity='1';
    }

    var rate = parseFloat($('#rate').val());
    var gross = parseFloat(rate * quantity);

    $('#gross').val(gross.toFixed(2));
};

var discount_blur=function()
{
    var discount = $('#discount').val().trim();
    if(discount==='' || isNaN(discount))
    {
        $('#discount').val('0');
        discount='0';
    }
    var gross = $('#gross').val();
    var net = gross - (gross*discount/100);

    $('#net').val(net.toFixed(2));
}

 $('.quantity').blur(quantity_blur);
 $('.discount').blur(discount_blur);

});
</script>
