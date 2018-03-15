<section id="group-2-coloum-layout" class="clearfix">
<div class="container">
	<div class="row">
		<aside class="col-sm-2 sidebar">
			
			<div class="thumbnail">
				<img src="<?php echo base_url();?>uploads/profile/sitegroup/<?php echo $group[0]->cover_image; ?>" alt="group-name" class="img-responsive" />
			</div>
			<!--end of Thumbnail-->
			<ul class="group-list list-unstyled">
				<li><a href="<?php echo base_url();?>backend/sitegroup/view/<?php echo $group[0]->slug; ?>">View group</a></li>
				<li class="active"><a href="javascript:void(0)">Profile / About</a></li>
				<li><a href="<?php echo base_url();?>backend/sitegroup/joinGroupMembers/<?php echo $group[0]->slug; ?>">Members</a></li>
				<li><a href="<?php echo base_url();?>backend/sitegroup/groupGallery/<?php echo $group[0]->slug; ?>">Photos</a></li>
			</ul>
			<!--end of group list-->
		</aside>
		<!--end of sidebar-->
		
		<div class="col-sm-10">
		<?php echo $group[0]->description; ?>
		</div>
		<!--end of content-->
	
	</div>
	<!--end of row-->
</div>
</section>
<!--end of group page Layout-->