<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
<section id="group-2-coloum-layout" class="clearfix">
<div class="container">
	<div class="row">
	<div class="col-sm-3">
		<a href="<?php echo base_url(); ?>backend/profile/interiorwall/<?php echo $userprofile[0]->userId; ?>" class="btn btn-primary btn-bg btn-block noround">My Interior Wall</a>
	</div>
	<!--End of My Timeline-->
	
	<div class="col-sm-3 text-center">
		<h2 class="img-thumbnail img-circle">OR</h2>
	</div>
	
	<div class="col-sm-6">
		<form method="GET" id="usersearch" autocomplete="off">
			<div class="input-group">
				<input type="search" class="form-control" placeholder="Search by Name..." id="searchmember" value="" data-userid="" />
				<span class="input-group-btn">
				<button type="submit" class="btn btn-success noround" id="searchwall">Search</button>
				</span>
			</div>
			<div id="userList"></div>
			<!--End of Input groups-->
		</form>
		<!--End of Serach Form-->
	</div>
	<!--End of Search Members Timeline-->
	
	
	<script>
		jQuery(function($){
			$('#searchmember').on('keyup', function(e){
				if($(this).val().length >= 3){
					//Ajax Call
					$('#searchwall').text('Searching...').attr('disabled','disabled');
					$.ajax({
						url: "<?php echo base_url();?>backend/profile/searchwall",
						data: {
							'name': $(this).val(),
						},
						type: "GET",
						dataType: 'json',
						context: this,
						success: function(response){
							$('#searchwall').text('Search').removeAttr('disabled');
						},
						error: function(errorThrow){
							console.log(errorThrow);
						},
						complete : function(response) {
							$('#userList').html(response.responseJSON);
							$('#userList ul li').click(function(){
								var name= $(this).data('name');
								$('#searchmember').val(name);
								$('#searchmember').data('userid', $(this).data('id') );
								$(this).addClass('active').siblings().removeClass('active');
							});
							
						}
					});
					
					
					$('#userList').slideDown();
				}
				else{
					$('#userList').slideUp();
				}
				
				
			});
			$('#usersearch').on('click', function(e){
				e.stopPropagation();
			});
			$("body").on('click', function(e) {
				$('#userList').slideUp();
			});	
			
			
			//submit Form
			$('form#usersearch').submit(function(e){
				var locationURL = "<?php echo base_url() ?>backend/profile/interiorwall/"+$('#searchmember').data('userid');
				window.location.href = locationURL;
				return false;
			});
			
		});		
	</script>
	
	</div>
	<!--End of row-->
</div>
<!--End of Container-->
</section>
<!--end of group page Layout-->
