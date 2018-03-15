

	<div class="gtco-section sitegroup-page">
     <div class="gtco-container">

	  <div class="memberfilter col-md-12">
	 <div class="col-md-6 filter">
			<select id="member-order-by" class="form-control">
			  <option value="active">Last Active</option>
			  <option value="popular">Most Members</option>
			  <option value="newest">Newly Created</option>
			  <option value="alphabetical">Alphabetical</option>
			</select>
	 </div>
	 	 <div class="col-md-6 search">
			<input type="text" placeholder="Search Groups" class="form-control">
	 </div>
	 </div>
	 <div class="membercount col-md-12">
	   <ul class="nav nav-tabs">
    <li class="active"><a href="<?php echo base_url();?>backend/sitegroup">All Groups <span class="badge"><?php echo ($no_of_all_group)?($no_of_all_group):0;?></span></a></li>
    <li><a href="<?php echo base_url();?>backend/sitegroup/mygroup">My Groups <span class="badge"><?php echo ($mygroups)?count($mygroups):0;?></span></a></li>
		<li><a href="<?php echo base_url();?>backend/sitegroup/create">Create Group</span></a></li>
  </ul>
	 </div>

  <div class="tab-content row">
    <div id="home" class="tab-pane fade in active">
     <div class="sitegroup-item col-md-12">

	 <?php if(!empty($allgroup)){ ?>
	<?php foreach($allgroup as $group) { ?>
	 <div class="col-md-12 item">
	 
		<div class="row box-coloum text-left" >
			<div class="col-sm-2">
			 <div class="user-pic text-center">
				<img src="<?php echo base_url();?>uploads/profile/sitegroup/<?php echo $group->cover_image; ?>" alt="user-pic">
			 </div>
			</div>
			
			<div class="col-sm-5">
			<div class="user-name">
				<h4><a href="<?php echo base_url();?>backend/sitegroup/view/<?php echo $group->slug;?>"><?php echo $group->title; ?></a></h4>
				 <div class="description">
					<p><?php echo $group->description; ?></p>
				 </div>
			</div>
			</div>
			
			<div class="col-sm-2">
				<div class="active">
					<span class="btn btn-danger btn-sm disabled">Never Active</span>
				 </div>
			</div>
			
			<div class="col-sm-3">
				<div class="followers">
					<h6><?php echo $group->group_visibility; ?> Group /
						<?php 
							foreach($members as $groupMembers){
								if($groupMembers->group_id == $group->id){
									echo '<span class="badge">'.$groupMembers->members.'</span>';
								
								}
							}
						?>
						Members
					</h6>
				</div>
				<?php  if($group->created_by!=$this->session->userdata('userId')) {?>
				<div class="follow-btn">
					<?php 
						if (in_array($group->id, $joinedGroup)){
						?>
						<a href="javascript:void(0)" class="joingroup hidden" data-groupid="<?php echo $group->id;?>">Join Group</a>
						<a href="javascript:void(0)" class="leavegroup" data-groupid="<?php echo $group->id;?>">Leaved Group</a>
						<?php
						}
						else{
						?>
						<a href="javascript:void(0)" class="joingroup" data-groupid="<?php echo $group->id;?>">Join Group</a>
						<a href="javascript:void(0)" class="leavegroup hidden" data-groupid="<?php echo $group->id;?>" >Leaved Group</a>
						<?php 
						}
					?>
					
				</div>
				<?php } ?>
			</div>
			
		</div>
		<!--end of box coloum-->
	 
	 </div>
	 <?php } } ?>

	</div>
    </div>


  </div>



	<div class="pagination-div col-md-12">

			<div class="pagination-links">
			 <?php if(!empty($links)){
 			 			echo $links;
			 } ?>
			</div>
	</div>



     </div>
		 <script>
		 $(document).ready(function(){
			$(".joingroup").click(function(){
				groupid = $(this).data('groupid');
				$.ajax({
				  url: "<?php echo base_url();?>backend/sitegroup/joinGroupLeaveGroup",
					data: {'group_id':groupid},
					type: "POST",
					dataType: 'json',
					context: this,
					success: function(response){
						$(this).addClass('hidden');
						$(this).next().removeClass('hidden');
					}
				});
			});
			
			$(".leavegroup").click(function(){
				groupid = $(this).data('groupid');
				$.ajax({
				  url: "<?php echo base_url();?>backend/sitegroup/unjoinedGroup",
					data: {'group_id':groupid},
					type: "POST",
					dataType: 'json',
					context: this,
					success: function(response){
						$(this).addClass('hidden');
						$(this).prev().removeClass('hidden');
					}
				});
			});

		 });
		 </script>
