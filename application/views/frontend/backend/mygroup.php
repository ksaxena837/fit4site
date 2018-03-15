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
  <li class=""><a href="<?php echo base_url();?>backend/sitegroup">All Groups <span class="badge"><?php echo ($allgroup)?count($allgroup):0;?></span></a></li>
  <li><a class="active membercount" href="<?php echo base_url();?>backend/sitegroup/mygroup">My Groups <span class="badge"><?php echo ($mygroups)?count($mygroups):0;?></span></a></li>
  <li><a href="<?php echo base_url();?>backend/sitegroup/create">Create Group</span></a></li>
</ul>
 </div>

<div class="tab-content">
  <div id="home" class="tab-pane fade in active">
   <div class="sitegroup-item col-md-12">

 <?php if(!empty($mygroups)){ ?>
<?php foreach($mygroups as $group) { ?>
 <div class="col-md-12 item">
 <div class="user-pic">
 <img src="<?php echo base_url();?>uploads/profile/sitegroup/<?php echo $group->cover_image; ?>" alt="user-pic">
 </div>
 <div class="user-name">
 <h4><a href="<?php echo base_url();?>backend/sitegroup/view/<?php echo $group->slug;?>"><?php echo $group->title; ?></a></h4>
 </div>
  <div class="active">
 <h5>Never Active</h5>
 </div>
 <div class="description">
 <p><?php echo $group->description; ?></p>
 </div>
  <div class="followers">
 <h6><?php echo $group->group_visibility; ?> Group /<span class="badge">5</span>Members</h6>
 </div>
 <?php  if($group->created_by!=$this->session->userdata('userId')) {?>
   <div class="follow-btn">
 <a href="#" id="joinleave<?php echo $group->id;?>" data-groupid="<?php echo $group->id;?>">Join Group</a>
 </div>
 <?php } ?>
 </div>
 <?php } }else{ echo "<span>Group Not Found </span> <a href='".base_url()."backend/sitegroup/create'>Create Group</a>";} ?>

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
          $(".follow-btn a").click(function(){
            groupid = $(this).data('groupid');
            alert(groupid);
            $.ajax({
                  url: "<?php echo base_url();?>backend/sitegroup/joinGroupLeaveGroup",
                  data: {'group_id':groupid},
                  type: "POST",
                  success: function(response){
                    //alert(response);
                    $('.followtxt'+groupid).text(response);
                  }
                });
          });

   });
   </script>
