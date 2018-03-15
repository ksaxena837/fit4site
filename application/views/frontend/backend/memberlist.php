
	<div class="gtco-section memberlist-page">
     <div class="gtco-container">
	  <div class="memberfilter col-md-12">
	 <div class="col-md-6 filter">
			<select id="member-order-by" class="form-control">
			  <option value="active">Last Active</option>
			  <option value="newest">Newest Registered</option>
			  <option value="alphabetical">Alphabetical</option>
			</select>
	 </div>
	 	 <div class="col-md-6 search">
			<input type="text" placeholder="Search Members" class="form-control">
	 </div>
	 </div>
	 <div class="membercount col-md-12">
	 <ul class="nav nav-tabs">
		 <?php if(!empty($memberlist)){ ?>
    <li class="active"><a data-toggle="tab" href="#home">All Members <span class="badge"><?php echo ($no_of_all_members);?></span></a></li>
	<?php } ?>

	<?php if(!empty($followermembers)){ ?>
    <li><a data-toggle="tab" href="#follower">Follower <span class="badge"><?php echo count($followermembers);?></span></a></li>
	<?php } ?>
		<?php if(!empty($followingmembers)){ ?>
		<li><a data-toggle="tab" href="#following">Following <span class="badge"><?php echo count($followingmembers);?></span></a></li>
	<?php } ?>
  </ul>
	 </div>
	 <div class="tab-content">
		 	<?php if(!empty($memberlist)){ ?>
	    <div id="home" class="tab-pane fade in active">
	 	 <div class="memberlist-item col-md-12">

	<?php $count = 1; foreach($memberlist as $k=>$member) { ?>
		<?php if($count %6==1){ ?>
	 <?php echo "<div class='row'>"; ?>
	 <?php } ?>
	 <div class="col-md-6 item">
			 <div class="user-pic">
			 			<img src="<?php echo base_url();?>assets/frontend/images/dummyuser.png" alt="user-pic">
			 </div>
			 <div class="user-name">
			 			<h4><a href="<?php echo base_url();?>backend/memberlist/viewMemberDetail/<?php echo $member->userId*224;?>"><?php echo $member->name; ?></a></h4>
			 </div>
			 <?php

$str = fitForSiteDateSent($member->last_login_date);

			 ?>
			 <div class="active">
			 				<h5><?php echo ($str!='')?$str:'Never Login';?></h5>
			 </div>
			  <div class="followers">
					 <h6><span class="badge"><?php echo $member->no_of_follower;?></span>Followers</h6>
			 	</div>
			   <div class="reference">
			 	 			<strong>No reference</strong>
			 		</div>

					<div class="follow-btn">
					<?php
					if(!empty($followinglist)){
					if(in_array($member->userId,$followinglist)){?>
						<a href="javascript:void(0)" class="followtxt<?php echo $member->userId;?>" data-followerid = "<?php echo $member->userId;?>">Unfollow</a>
					<?php }else{ ?>
						<a href="javascript:void(0)" class="followtxt<?php echo $member->userId;?>" data-followerid = "<?php echo $member->userId;?>">Follow</a>
					<?php }
					}else{?>
						<a href="javascript:void(0)" class="followtxt<?php echo $member->userId;?>" data-followerid = "<?php echo $member->userId;?>">Follow</a>
					<?php } ?>
				</div>

	 </div>
	 <?php if($count%6==0){ ?>
		 <?php echo "</div>"; ?>
	 <?php } ?>


 <?php $count++; }  ?>
 <?php if($count%6!=1){ ?>
	 <?php echo "</div>"; ?>
 <?php } ?>
 <div class="pagination-div col-md-12">
			<?php echo $links;?>
 </div>
	 </div>


	  </div>

 <?php } ?>


	<?php if(!empty($followingmembers)){ ?>
	 <div id="following" class="tab-pane fade">
		 <div class="memberlist-item col-md-12">

				<?php $count1 = 1; foreach($followingmembers as $member1) { ?>
					<?php if($count1 %6==1){ ?>
				 <?php echo "<div class='row'>"; ?>
				 <?php } ?>
	 <div class="col-md-6 item">
			 <div class="user-pic">
			 			<img src="<?php echo base_url();?>assets/frontend/images/dummyuser.png" alt="user-pic">
			 </div>
			 <div class="user-name">
			 			<h4><a href="<?php echo base_url();?>backend/memberlist/viewMemberDetail/<?php echo $member1->userId*224;?>"><?php echo $member1->name; ?></a></h4>
			 </div>
			 <?php

			 $str1 = fitForSiteDateSent($member1->last_login_date);

			 ?>
			 <div class="active">
			 				<h5><?php echo ($str1!='')?$str1:'Never Login';?></h5>
			 </div>
			  <div class="followers">
					 <h6><span class="badge"><?php echo $member1->no_of_follower;?></span>Followers</h6>
			 	</div>
			   <div class="reference">
			 	 			<strong>No reference</strong>
			 		</div>
					<div class="follow-btn">
	 			 <?php
	 			 if(!empty($followingmembers)){
	 			 if(in_array($member1->userId,$followinglist)){?>
	 				 <a href="javascript:void(0)" class="followtxt<?php echo $member1->userId;?>" data-followerid = "<?php echo $member1->userId;?>">Unfollow</a>
	 			 <?php }else{ ?>
	 				 <a href="javascript:void(0)" class="followtxt<?php echo $member1->userId;?>" data-followerid = "<?php echo $member1->userId;?>">Follow</a>
	 			 <?php }
	 			 }else{?>
	 				 <a href="javascript:void(0)" class="followtxt<?php echo $member1->userId;?>" data-followerid = "<?php echo $member1->userId;?>">Follow</a>
	 			 <?php } ?>
	 		 </div>
	 </div>
	 <?php if($count1%6==0){ ?>
		 <?php echo "</div>"; ?>
	 <?php } ?>


		 <?php $count1++; } ?>
		 <?php if($count1%6!=1){ ?>
			 <?php echo "</div>"; ?>
		 <?php } ?>
			 </div>
			  </div>
		 <?php } ?>


<?php if(!empty($followermembers)){ ?>
	 <div id="follower" class="tab-pane fade">
		 <div class="memberlist-item col-md-12">

				<?php $count1 = 1; foreach($followermembers as $member2) { ?>
					<?php if($count1 %6==1){ ?>
				 <?php echo "<div class='row'>"; ?>
				 <?php } ?>
	 <div class="col-md-6 item">
			 <div class="user-pic">
						<img src="<?php echo base_url();?>assets/frontend/images/dummyuser.png" alt="user-pic">
			 </div>
			 <div class="user-name">
						<h4><a href="<?php echo base_url();?>backend/memberlist/viewMemberDetail/<?php echo $member->userId*224;?>"><?php echo $member2->name; ?></a></h4>
			 </div>
			 <?php

 		 		$str1 = fitForSiteDateSent($member2->last_login_date);

			 ?>
			 <div class="active">
							<h5><?php echo ($str1!='')?$str1:'Never Login';?></h5>
			 </div>
				<div class="followers">
					 <h6><span class="badge"><?php echo $member2->no_of_follower;?></span>Followers</h6>
				</div>
				 <div class="reference">
							<strong>No reference</strong>
					</div>
				 <div class="follow-btn">
					 <?php if(!empty($followermembers)){
					 if(in_array($member2->userId,$followerids)){?>
						 <a href="javascript:void(0)" class="followtxt<?php echo $member2->userId;?>" data-followerid = "<?php echo $member2->userId;?>">Unfollow</a>
					 <?php }else{ ?>
						 <a href="javascript:void(0)" class="followtxt<?php echo $member2->userId;?>" data-followerid = "<?php echo $member2->userId;?>">Follow</a>
					 <?php }
				 }else{ echo 'asdlkfjlaksjdflkasj';?>
						 <a href="javascript:void(0)" class="followtxt<?php echo $member2->userId;?>" data-followerid = "<?php echo $member2->userId;?>">Follow</a>
					 <?php } ?>
			 </div>
	 </div>
	 <?php if($count1%6==0){ ?>
		 <?php echo "</div>"; ?>
	 <?php } ?>


	<?php $count1++; }  ?>
	<?php if($count1%6!=1){ ?>
	 <?php echo "</div>"; ?>
	<?php } ?>
	 </div>
	  </div>
 <?php } ?>
 </div>


 </div>




		</div>
</div>

		 <script>
		 $(document).ready(function(){
						$(".follow-btn a").click(function(){
							followerid = $(this).data('followerid');
							if(followerid!='' && followerid!='undefined'){
							$.ajax({
			 						  url: "<?php echo base_url();?>backend/memberlist/followUnfollow",
			 						 	data: {'followerid':followerid},
			 							type: "POST",
										success: function(response){
											//alert(response);
											$('.followtxt'+followerid).text(response);
										}
			 						});
								}
						});

		 });
		 var no=1;
$(window).scroll(function () {
    if(no==1)
    {
        if ($(window).height() + $(window).scrollTop() == $(document).height()) {
            no=2;
            /*$.ajax({
                type: "POST",
                url: "request.php",
                data: datas,
                cache: false,
                success: function(html){

                }
            });*/

        }
    }
});
		 </script>
