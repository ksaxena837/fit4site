
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-user"></i> My Profile
        <small>Profile</small>
      </h1>
    </section>

    <section class="content">

        <div class="row">
            <!-- left column -->


<div class="col-md-6">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url();?>assets/dist/img/user2-160x160.jpg" alt="User profile picture">

              <h3 class="profile-username text-center"><?php echo $userprofile[0]->name; ?></h3>

              <p class="text-muted text-center"><?php echo ucfirst($this->session->userdata('roleText')); ?></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Followers</b> <a class="pull-right">1,322</a>
                </li>
                <li class="list-group-item">
                  <b>Following</b> <a class="pull-right">543</a>
                </li>
                <li class="list-group-item">
                  <b>Friends</b> <a class="pull-right">13,287</a>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
</div>
<div class="col-md-6">
          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">About Me</h3>
			  <span style="float: right;"><a href="<?php echo base_url(); ?>index.php/user/editprofile">Edit Profile</a></span>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Education</strong>
           
              <p class="text-muted">
                <?php echo $userprofile[0]->education; ?>
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

              <p class="text-muted"><?php echo $userprofile[0]->location; ?></p>

              <hr>

              <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>

              <p>
                <span class="label label-warning"><?php echo $userprofile[0]->skills; ?></span>
              </p>

              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

              <p><?php echo $userprofile[0]->notes; ?></p>
			  <hr>

              <strong><i class="fa fa-envelope-o"></i> Email</strong>

              <p><?php echo $userprofile[0]->email; ?></p>
			  <hr>

              <strong><i class="fa fa-mobile"></i> Mobile</strong>
              <p><?php echo $userprofile[0]->mobile; ?></p>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
  </div>
