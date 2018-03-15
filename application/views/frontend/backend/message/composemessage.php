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
					<li><a href="<?php echo base_url() ?>backend/message/starrtedMessage" >Starred</a></li>
					<li><a href="<?php echo base_url() ?>backend/message/sentMessage">Sent</a></li>
				</ul>
			</aside>
			<!--end of list links-->

			<section class="col-sm-9 list-body col">

				<form method="post" action="<?php echo base_url();?>backend/message/postComposeMessage" enctype="multipart/form-data">
				<fieldset class="form-group">
					<label for="compose_sendto">Send To* ( Email address )</label>
					<input type="email" name="compose_sendto" class="form-control" required="required" <?php echo set_value('compose_sendto');?> />
					<?php echo form_error('compose_sendto','<div class="error">', '</div>'); ?>
				</fieldset>

				<fieldset class="form-group">
					<label for="compose_subject">Subject</label>
					<input type="text" name="compose_subject" class="form-control" <?php echo set_value('compose_subject');?>/>
					<?php echo form_error('compose_subject','<div class="error">', '</div>'); ?>
				</fieldset>

				<fieldset class="form-group">
					<label for="compose_message">Message</label>
					<textarea name="compose_message" class="form-control" style="min-height:120px;"><?php echo set_value('compose_message');?></textarea>
					<?php echo form_error('compose_message','<div class="error">', '</div>'); ?>
				</fieldset>

				<fieldset class="form-group">
					<label for="compose_attachment">Add an attachment</label><br/>
					<div class="fileUpload btn btn-warning">
						<span>Upload</span>
						<input id="attachment_file" type="file" name="attachment_file" class="upload"  />
					</div>
				</fieldset>

				<hr/>

				<button type="submit" name="sendMessage" class="btn btn-primary" style="border-radius:2px"> Send Message</button>

				</form>
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
