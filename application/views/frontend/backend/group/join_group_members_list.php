<section id="group-2-coloum-layout" class="clearfix">
<div class="container">
	<div class="row eqqualheight">
		<aside class="col-sm-2 sidebar">
			<div class="thumbnail">
				<img src="<?php echo base_url();?>uploads/profile/sitegroup/<?php echo $group[0]->cover_image; ?>" alt="group-name" class="img-responsive" />
			</div>
			<!--end of Thumbnail-->
			<ul class="group-list list-unstyled">
				<li><a href="<?php echo base_url();?>backend/sitegroup/view/<?php echo $group[0]->slug; ?>">View group</a></li>
				<li><a href="<?php echo base_url();?>backend/sitegroup/aboutGroup/<?php echo $group[0]->slug; ?>">Profile / About</a></li> 
				<li class="active"><a href="javascript:void(0)">Members</a></li>
				<li><a href="<?php echo base_url();?>backend/sitegroup/groupGallery/<?php echo $group[0]->slug; ?>">Photos</a></li>
			</ul>
			<!--end of group list-->
		</aside>
		<!--end of sidebar-->
		
		<div class="col-sm-10">
			<div class="page-header">
				<h3>Members List</h3>
			</div>
			
			<ul class="members-list list-unstyled">
			<?php foreach($members as $member){ ?>
				<li class="member"> 
					<div class="media">
						<div class="media-left" style="width:75px;float: left;">
							<a href=""><img src="<?php echo (!empty($member->profile_image)) ? base_url().'uploads/profile/'.$member->profile_image : 'https://www.nriva2017.org/wp-content/themes/Nriva2017/images/user-dummy.png' ?>" alt="username" class="media-object img-responsive img-circle" ></a>
						</div>
						<div class="media-body">
							 <h4 class="media-heading"><?php echo $member->name; ?></h4>
							 <p><small><?php echo $member->location; ?></small></p>
						</div>
					</div>
					<!--End of Media-->
				</li>		
			<?php }	?>
				
			</ul>
			
			
		</div>
		<!--end of content-->
	
	</div>
	<!--end of row-->
</div>
</section>
<!--end of group page Layout-->