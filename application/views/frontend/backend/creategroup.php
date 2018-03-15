
	<div class="gtco-section creategroup-page">
     <div class="gtco-container">

	 <div class="row">
			 <div class="col-md-12">
					 <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
			 </div>
	 </div>
	 <div class="creategroup-form col-md-12 nopadding">
				<form method="POST" action="<?php echo base_url();?>backend/sitegroup/postGroup" enctype="multipart/form-data">
					<div class="form-group">
			 				 <label for="invite_emails">Invite Members</label>
			 				 <input type="text" class="form-control" name="invite_emails" id ="invite_emails" placeholder="Invitation email ids">
 			   </div>
				<div class="firstpart">
				  <div class="form-group">
					<label for="name">Group Name</label>
					<input type="text" class="form-control" name="title" id="title">
					<?php echo form_error('title', '<div class="error">', '</div>'); ?>
				  </div>
				  <div class="form-group">
				  <label for="desc">Group Description</label>
				  <textarea class="form-control" rows="5" id="description" name="description"></textarea>
				</div>
				<div class="checkbox">
				<label><input type="checkbox" name="enable_review" value="1"> Enable group reviews</label>
			  </div>
			  <div class="checkbox">
				<label><input type="checkbox" name="enable_gallery" value="1"> Enable Gallery</label>
			  </div>
			  </div>
			  <div class="secpart">
			  <h4>Privacy Options</h4>
			  <div class="radio">
				  <label><input type="radio" name="grouptype" value="public">This is a public group</label>
				  <ul>
						<li>Any site member can join this group.</li>
						<li>This group will be listed in the groups directory and in search results.</li>
						<li>Group content and activity will be visible to any site member.</li>
					</ul>
				</div>
				<div class="radio">
				  <label><input type="radio" name="grouptype" value="private">This is a private group</label>
				  <ul>
						<li>Only users who request membership and are accepted can join the group.</li>
						<li>This group will be listed in the groups directory and in search results.</li>
						<li>Group content and activity will only be visible to members of the group.</li>
					</ul>
				</div>
				<div class="radio">
				  <label><input type="radio" name="grouptype" value="hidden">This is a hidden group</label>
				  <ul>
						<li>Only users who are invited can join the group.</li>
						<li>This group will not be listed in the groups directory or search results.</li>
						<li>Group content and activity will only be visible to members of the group.</li>
					</ul>
				</div>
				</div>
				<div class="thirdpart">
				 <h4>Group Invitations</h4>
				 <h5>Which members of this group are allowed to invite others?</h5>
				  <div class="radio">
				  <label><input type="radio" name="allow" value="1">All group members</label>
				</div>
				<div class="radio">
				  <label><input type="radio" name="allow" value="2">Group admins and mods only</label>
				</div>
				<div class="radio">
				  <label><input type="radio" name="allow" value="3">Group admins only</label>
				</div>
				</div>
				<div class="form-group">
					<label for="gimage"><strong>Upload Group image</strong></label>
					<input type="file" class="form-control" id="gimage" name="cover_image">
				  </div>
					 <input type="hidden" name="created_by" value="<?php echo $userprofile[0]->userId ;?>">
				  <button type="submit" class="create-btn">Create Group</button>
				</form>

	 </div>
     </div>

     </div>
