
	<div class="gtco-section user-profile-page">
		<div class="gtco-container user-profile-section">
			<!--Profile section-->
      <?php if(!empty($memberinfo)) { ?>
			<div class="col-md-8">
			<div class="profile-header-details col-md-12">
			<div class="user-pic col-md-4">
				<?php if(empty($memberinfo[0]->profile_image)){?>
			<img src="<?php echo base_url();?>assets/frontend/images/dummyuser.png" alt="user-pic">
		<?php }else{?>
				<img src="<?php echo base_url();?>uploads/profile/profile_thumb/<?php echo $memberinfo[0]->profile_image;?>" alt="user-pic">
		<?php } ?>
			</div>
			<div class="col-md-8">
			<div class="users-bname">
			 <h2><?php echo $memberinfo[0]->name;?><span>, </span><small class="user-nicename">@<?php echo $memberinfo[0]->role;?></small></h2>
			</div>
			<div class="userlocation">
			<small><?php echo $memberinfo[0]->location;?></small>
			</div>
			<div class="users-follow">
			<ul class="list-unstyled list-inline">
					<li>
						<div class="following-count text-center">	<?php echo $memberinfo[0]->no_of_following;?></div>
						<h5 class="following">Following</h5>
					</li>
					<li>
						<div class="follower-count text-center"><?php echo $memberinfo[0]->followers;?></div>
						<h5 class="followers">Followers</h5>
					</li>
				</ul>
			</div>
			</div>

			<div class="col-md-12">
				<hr/>
				<div class="custom-switcher">
					<label class="switch online-offline">
						<input type="checkbox" disabled id="online-offline" <?php echo ($memberinfo[0]->online_status==1)?'checked':'';?>>
						<span class="slider round"></span>
					</label> <span id="onlinetext" style="position: relative;top: -15px;"><?php echo ($memberinfo[0]->online_status==1)?'Available On Call':'Not Available';?></span>
				</div>
			<?php if(!empty($memberinfo[0]->mobile)){ ?>
				 <a class="btn btn-primary btn-sm" href="tel:<?php echo $memberinfo[0]->mobile;?>"><i class="fa fa-phone"></i>  Call Us    </a>
			<?php } ?>
			</div>

			</div>
			<div class="col-md-12 new-job-post">
				<div class="profile-content">
				<h4>Member Type</h4>
				<table class="table table-bordered">
					<tbody>
					  <tr>
						<th>Full name/Business name</th>
						<td><?php echo ucfirst($memberinfo[0]->name); ?></td>
					  </tr>
					  <tr>
						<th>Type</th>
						<td><?php echo $memberinfo[0]->role;?></td>
					  </tr>
					</tbody>
				  </table>
				</div>
			</div>
			</div>

			<!--end of profile section-->

			<!--sidebar section-->
			<div class="col-md-3 profile-sidebar">
				<div class="sidebar1">
				<a href="#"><i class="fa fa-camera" aria-hidden="true"></i>View Portfolio</a>
				</div>
				<div class="sidebar2">
				<h4>No Location Found</h4>
				</div>
				<div class="sidebar3">
				<h4>Who’s viewed my profile?</h4>
				<div>
				<a href="#"><img src="<?php echo base_url();?>assets/frontend/images/dummyuser.png" alt="user-pic"></a>
				<a href="#"><img src="<?php echo base_url();?>assets/frontend/images/dummyuser.png" alt="user-pic"></a>
				<a href="#"><img src="<?php echo base_url();?>assets/frontend/images/dummyuser.png" alt="user-pic"></a>
				<a href="#"><img src="<?php echo base_url();?>assets/frontend/images/dummyuser.png" alt="user-pic"></a>
				<a href="#"><img src="<?php echo base_url();?>assets/frontend/images/dummyuser.png" alt="user-pic"></a>
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
    <?php }else{echo 'Member Not Found Please Try Again!';} ?>
			<!--end of sidebar-->
		</div>
	</div>
