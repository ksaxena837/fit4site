<?php
	session_start(); // This is need.Otherwise not getting your name in the chat box.
	$_SESSION['username'] = $this->session->userdata('name'); // Must be already set
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">

	<title>Chat</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/chat.js"></script>

    <link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url(); ?>assets/chat.css" />
    <link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url(); ?>assets/screen.css" />

    <!--[if lte IE 7]>
    <link type="text/css" rel="stylesheet" media="all" href="http://demo.webexplorar.com/codeigniter/application/css/screen_ie.css" />
    <![endif]-->

</head>
<body>
	<div class="content-wrapper">
	    <!-- Content Header (Page header) -->
	    <section class="content-header">
	      <h1>
	        <i class="fa fa-company"></i> Online
	        <small>Users </small>
	      </h1>
	    </section>

	    <section class="content">

	        <div class="row">
					<div class="col-md-6">

     <table width="45%" cellspacing="1" cellpadding="2" class="tableContent" style="margin-left:0px !important;">
        <tbody>
          <tr style="background-color:#9EB0E9;  font-size:13px; font-weight:bold; color:#fff;">
            <th>Online</th>
            <th>User Id</th>
            <th>User Name</th>
          </tr>

		<?php

		if(isset($listOfUsers))
		{
			foreach($listOfUsers as $res)
			{
		?>

          <tr style="background-color:#efefef;">
            <td><?php if($res->online_status==1) echo 'Active'; else echo 'Inactive'; ?></td>
            <td><?php echo $res->userId; ?></td>
            <td><?php if($_SESSION['username']==$res->name) { ?>
                 		<a href="#" style="text-decoration:none">
										<?php } else { $name = str_replace(' ','_',$res->name); ?>
                        <a href="javascript:void(0)" onClick="javascript:chatWith('<?php echo $name; ?>');">
                <?php } ?>
                <?php echo $res->name;  ?>
                        </a>
                  </td>
            </tr>
			<?php

			} // end foreach loop
		} // end if condition
		?>

		</tbody>
	</table>
<div class="col-md-6"></div>
</div>
 </div>
 </section>
 </div>

</body>
</html>
