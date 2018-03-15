<?php if($userprofile[0]->cover_image){ ?>
<div class="profile-banner" style="background-image:url(<?php echo base_url();?>uploads/profile/profile_cover/<?php echo $userprofile[0]->cover_image;?>);">
  <?php } else { ?>
  <div class="profile-banner">
  <?php } ?>
  <div class="edit-banner">
  <form method="POST" enctype="multipart/form-data" id="update-banner">
  <p id="msg"></p>
  <label>
  <i class="fa fa-camera" aria-hidden="true"></i><input type="file" name="profile_banner" id="profile-banner" style="display: none;" >
  </label>
  </form>
  </div>
<div class="uploadloader">
  <img id="loading-image" src="<?php echo base_url();?>assets/frontend/images/ajax_loader.gif" style="display:none;width: 150px; margin-left: -10%;"/>
  </div>
  <div class="user-pic">
  <img src="<?php echo base_url();?>assets/frontend/images/dummyuser.png" alt="user-pic">
  </div>
<div class="basic-details">
       <h2><?php echo $userprofile[0]->name;?><span>, </span><small class="user-nicename">@<?php echo $userprofile[0]->roletxt;?></small>
  <small class="location"><?php echo $userprofile[0]->location;?></small></h2></div>
<div class="user-follow">
<ul class="list-unstyled list-inline">
  <li>
    <div class="following-count text-center">	0</div>
    <h5 class="following">Following</h5>
  </li>
  <li>
    <div class="follower-count text-center">3</div>
    <h5 class="followers">Followers</h5>
  </li>
</ul>
</div>
</div>
