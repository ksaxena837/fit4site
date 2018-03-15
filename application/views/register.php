<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Fit4Site | Admin System Log in</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

    <style>
      .login-box{ width:520px !important;}
      .error{
        color:red;
        font-weight: normal;
      }


      html, body{
        width:100%;
      
        float:left;
      }
      .login-page{
        background-size:cover;
         background-attachment:fixed;
         position: relative;
      }
      .login-page:before{
        content: "";
        position: absolute;
        top: 0px;
        left: 0px;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
      }
      .login-box{
        position: relative;
      }
    </style>
  </head>
  <body class="login-page" style="background-image:url(<?php echo base_url();?>assets/background.jpg);">
    <div class="login-box">
      <div class="login-logo">
        <a href="<?php echo base_url();?>"><b>Fit4Site</b><br></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Sign Up</p>
        <?php $this->load->helper('form'); ?>
        <div class="row">
            <div class="col-md-12">
                <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
            </div>
        </div>
        <?php
        $this->load->helper('form');
        $error = $this->session->flashdata('error');
        if($error)
        {
            ?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $error; ?>
            </div>
        <?php }
        $success = $this->session->flashdata('success');
        if($success)
        {
            ?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $success; ?>
            </div>
        <?php } ?>

        <form role="form" id="addUser" action="<?php echo base_url() ?>index.php/login/registerMe" method="post" role="form">
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="role">TYPE</label>
                        <select class="form-control required" id="role" name="role">
                            <option value="0">Select Role</option>
                            <?php
                            if(!empty($roles))
                            {
                                foreach ($roles as $rl)
                                {
                                    ?>
                                    <option value="<?php echo $rl->roleId ?>"><?php echo $rl->role ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="fname">Full Name</label>
                            <input type="text" class="form-control required" id="fname" name="fname" maxlength="128">
                        </div>

                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="text" class="form-control required email" id="email"  name="email" maxlength="128">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control required" id="password"  name="password" maxlength="10">
                        </div>
                    </div>
                  </div>
                    <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="cpassword">Confirm Password</label>
                            <input type="password" class="form-control required equalTo" id="cpassword" name="cpassword" maxlength="10">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="mobile">Mobile Number</label>
                            <input type="text" class="form-control required digits" id="mobile" name="mobile" maxlength="10">
                        </div>
                    </div>
                    </div>

            </div><!-- /.box-body -->

            <div class="box-footer">
                <input type="submit" class="btn btn-primary" value="Submit" />
                <input type="reset" class="btn btn-default" value="Reset" />
            </div>

        </form>

          <a href="<?php echo base_url();?>index.php/loginMe">I have an account </a>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <script src="<?php echo base_url(); ?>assets/js/jQuery-2.1.4.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/dist/js/app.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.validate.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/validation.js" type="text/javascript"></script>
    <script type="text/javascript">
        var baseURL = "<?php echo base_url(); ?>";

        $(document).ready(function(){

        	var addUserForm = $("#addUser");

        	var validator = addUserForm.validate({

        		rules:{
        			fname :{ required : true },
        			email : { required : true, email : true, remote : { url : baseURL + "index.php/login/checkEmailExists", type :"post"} },
        			password : { required : true },
        			cpassword : {required : true, equalTo: "#password"},
        			mobile : { required : true, digits : true },
        			role : { required : true, selected : true}
        		},
        		messages:{
        			fname :{ required : "This field is required" },
        			email : { required : "This field is required", email : "Please enter valid email address", remote : "Email already taken" },
        			password : { required : "This field is required" },
        			cpassword : {required : "This field is required", equalTo: "Please enter same password" },
        			mobile : { required : "This field is required", digits : "Please enter numbers only" },
        			role : { required : "This field is required", selected : "Please select atleast one option" }
        		}
        	});
        });


    </script>

  </body>
</html>
