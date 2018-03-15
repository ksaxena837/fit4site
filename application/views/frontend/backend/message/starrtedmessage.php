<div class="gtco-section user-profile-page user-profile-message">
<div class="gtco-container user-profile-section">
	<!--Profile section-->
	<div class="col-md-9">
		<div class="row email-list">
			<aside class="col-sm-3 list col">
				<div class="compose">
					<a href="<?php echo base_url() ?>backend/message/composeMessage" class="btn btn-primary btn-block" style="border-radius:2px;">Compose</a>
				</div>
				<ul class="list-unstyled tab-list">
					<li><a href="<?php echo base_url() ?>backend/message/message">Inbox</a></li>
					<li><a href="" class="active">Starred</a></li>
					<li><a href="<?php echo base_url() ?>backend/message/sentMessage" >Sent</a></li>
				</ul>
			</aside>
			<!--end of list links-->


			<section class="col-sm-9 list-body col">

			<!--Top nav section start From here-->
			<div class="top-nav-sec">
			<div class="btn-group">
			  <button type="button" style="border-radius:0px;height: 30px;padding: 3px 20px;" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Action <span class="caret"></span>
			  </button>
			  <ul class="dropdown-menu">
				<li><a href="javascript:void(0)" id="all-select" onclick="return false;">All</a></li>
				<li><a href="javascript:void(0)" id="all-de-select">None</a></li>
				<li role="separator" class="divider"></li>
				<li><a href="#">Read</a></li>
			  </ul>
			</div>

			<button type="button" style="border-radius:0px;height: 30px;padding: 3px 20px;" class="btn btn-danger">Delete </button>

			</div>
			<!--End of Top nav section-->

			<hr/>
			<script>
				jQuery(function($){
					$('#all-de-select').on('click',function(){
						$('input[type=checkbox]').click();

					});
					$('#all-select').on('click',function(){
						$('input[type=checkbox]').click();
					});

				});
			</script>



			<table class="table inbox">
				<thead>
				<tr>
					<th></th>
					<th></th>
					<th>Sent To</th>
					<th>Message</th>
					<th></th>
				</tr>
				</thead>
				<tbody>
				<tr>
					<td class="selectcheckbox">
						<label class="checkbox-container">
						  <input type="checkbox">
						  <span class="checkmark"></span>
						</label>
					</td>
					<td><input class="star" type="checkbox" checked></td>
					<td>info@appsense.com</td>
					<td>We want a website with PHP technology...</td>
					<td><span class="datetime">12:05PM</span></td>
				</tr>
				</tbody>




			</table>
			<!--end of Table -->
			</section>
			<!--end of list body-->

		</div>
		<!--end of row of email List-->

	</div>
	<!--end of profile section-->

	<!--sidebar section-->
	<div class="col-md-3 profile-sidebar" style="margin-left:0px;">
		<div class="sidebar1">
		<a href="#"><i class="fa fa-camera" aria-hidden="true"></i>View Portfolio</a>
		</div>
		<div class="sidebar2">
		<h4>No Location Found</h4>
		</div>
		<div class="sidebar3">
		<h4>Who’s viewed my profile?</h4>
		<div>
		<a href="#"><img src="http://cash.infiniteloopcorp.com/construction/assets/frontend/images/dummyuser.png" alt="user-pic"></a>
		<a href="#"><img src="http://cash.infiniteloopcorp.com/construction/assets/frontend/images/dummyuser.png" alt="user-pic"></a>
		<a href="#"><img src="http://cash.infiniteloopcorp.com/construction/assets/frontend/images/dummyuser.png" alt="user-pic"></a>
		<a href="#"><img src="http://cash.infiniteloopcorp.com/construction/assets/frontend/images/dummyuser.png" alt="user-pic"></a>
		<a href="#"><img src="http://cash.infiniteloopcorp.com/construction/assets/frontend/images/dummyuser.png" alt="user-pic"></a>
		</div>
		</div>
		<div class="sidebar4">
		<h4>Recent Jobs</h4>
		<div class="list-recent-jobs">
		 <ul class="list-group">
			<li class="list-group-item">
			<div class="title"><strong><a href="#">Test 1</a></strong></div>
			<div class="desc">Lorem Ipsum is simply dummy text</div>
			</li>
			<li class="list-group-item">
			<div class="title"><strong><a href="#">Test 2</a></strong></div>
			<div class="desc">Lorem Ipsum is simply dummy text</div>
			</li>
		  </ul>
		</div>
		</div>
	</div>
	<!--end of sidebar-->
</div>


</div>
<!--end of user message page-->
