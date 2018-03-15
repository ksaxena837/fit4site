<?php

/*

CometChat
Copyright (c) 2016 Inscripts
License: https://www.cometchat.com/legal/license

*/

if (!defined('CCADMIN')) { echo "NO DICE"; exit; }

function index() {
	global $body, $currentversion, $client, $ts, $livesoftware, $marketplace, $plan, $planInfo,$planId,$licensekey,$accessKey,$planName, $dbms;
	$blurReport = $blurFooterCode = '';
	$hideGraph = 'style="display:none;"';
	if($dbms == 'mysql'){
		$hideGraph = '';
	}
	$rangelist = array(
		'last24hours' 	=> array(
			'title' 	=> 'Last 24 Hours',
			'selected' 	=> '',
			'fetchtime'	=> time()-60*60*24,
			'range'		=> 'In The Last 24 Hours'
		),
		'last30days' 	=> array(
			'title' 	=> 'Last 30 Days',
			'selected' 	=>'',
			'fetchtime' => time()-60*60*24*30,
			'range'		=> 'In The Last 30 Days'
		),
		'alltime' 		=> array(
			'title' 	=> 'All Time',
			'selected' 	=> '',
			'fetchtime' => '',
			'range'		=> 'Till Now'
		)
	);

	$graphtype = array('messages' => 'Messages','users' => 'Users','groups' => 'Groups');
	$graphinterval = array('daily' => 'Last 24 Hours','weekly' => 'Last 7 Days','monthly' => 'Last 30 Days');

	$firstGraphTypeOption .= '<select onchange="loadFirstGraph();" class="form-control" id="firstGraphType" name="firstGraphType" style=" width:120px;">';
	foreach ($graphtype as $key => $value) {
		if ($key == "groups") {continue;}
		$firstGraphTypeOption .= '<option value="'.$key.'">'.$value.'</option>';
	}
	$firstGraphTypeOption .= '</select>';

	$secondGraphTypeOption .= '<select onchange="loadSecondGraph();" class="form-control" id="secondGraphType" name="secondGraphType" style=" width:120px;">';
	foreach ($graphtype as $key => $value) {
		$secondGraphTypeOption .= '<option value="'.$key.'">'.$value.'</option>';
	}
	$secondGraphTypeOption .= '</select>';

	$graphdropdown .= '<select onchange="loadFirstGraph();" class="form-control" id="graphinterval" name="graphinterval" style=" width:138px;">';
	foreach ($graphinterval as $key => $value) {
		$graphdropdown .= '<option value="'.$key.'">'.$value.'</option>';
	}
	$graphdropdown .= '</select>';


	if (!array_key_exists($_REQUEST['report'], $rangelist)) {
		$_REQUEST['report'] = 'last24hours';
	}

	$rangelist[$_REQUEST['report']]['selected'] = 'selected';
	$range 		= $rangelist[$_REQUEST['report']]['range'];
	$fetchtime  = $rangelist[$_REQUEST['report']]['fetchtime'];

	$dropdown .= '<select onchange="window.location=\'?module=dashboard&ts='.$ts.'&report=\'+this.value+\'\'" class="form-control" id="report" name="report">';
	foreach ($rangelist as $key => $value) {
		$dropdown .= '<option '.$value['selected'].' value="'.$key.'">'.$value['title'].'</option>';
	}
	$dropdown .= '</select>';

	$available_version	= $GLOBALS['settings']['LATEST_VERSION']['value'];
	if(cc_version_compare($available_version , $currentversion) < 1){
		$available_version = '';
	}

	if (in_array($_REQUEST['report'], array('last30days','alltime'))) {
		$blurFooterCode = '<div class="card-footer" style="position: absolute;top: 0px;margin: 0 auto;right: 0;">This stat is still building...</div>';
		$blurReport = 'style="filter: blur(3px);"';
	}

	$showplan = '';
	if (!empty($_GET['d'])) {
		header("Location: ".ADMIN_URL."\r\n");
		exit;
	}

	$query = sql_query('getuserchatings',array('sent'=>$fetchtime));
	$chat = sql_fetch_assoc($query);
	$onlineusers = !empty($chat['users'])?$chat['users']:0;

	$messagequery = sql_query('admin_message_count',array('sent'=>$fetchtime));
	$getMesseageCount = sql_fetch_assoc($messagequery);
	$totalmessagest = !empty($getMesseageCount['totalmessages'])?$getMesseageCount['totalmessages']:0;
	if (empty($_SESSION['cometchat']['MsgCnt'])) {
		 $_SESSION['cometchat']['MsgCnt'] = $totalmessagest;
	}

	$guestquery = sql_query('admin_get_active_guests_count',array('sent'=>$fetchtime, 'firstguestid'=>$GLOBALS['firstguestID']));
	$getActiveGuestsCount = sql_fetch_assoc($guestquery);
	$activeguests = !empty($getActiveGuestsCount['totalactiveguest'])?$getActiveGuestsCount['totalactiveguest']:0;

	$query = sql_query('admin_getActiveUsersCount',array('sent'=>$fetchtime, 'firstguestid'=>$GLOBALS['firstguestID']));
	$getActiveUsersCount = sql_fetch_assoc($query);
	$activeusers = !empty($getActiveUsersCount['activeusers'])?$getActiveUsersCount['activeusers']:0;

	$warningMsg = '';
	if ( ADMIN_USER == 'cometchat' && ADMIN_PASS == 'cometchat' && empty($client)) {
		$warningMsg = <<<EOD
		<div class="col-sm-12 col-lg-12">
			<div class="card card-inverse card-danger">
				<div class="pb-0" style="padding:16px;">
					<p>Warning: Default login detected, this is a security risk. Please update your login information in the Settings  -> General tab.</p>
				</div>
			</div>
		</div>
EOD;
	}else if(!preg_match('/^[0-9a-f]{40}$/i', ADMIN_PASS) && empty($client)){
		$warningMsg = <<<EOD
		<div class="col-sm-12 col-lg-12">
			<div class="card card-inverse card-danger">
				<div class="pb-0" style="padding:16px;">
					<p>Warning: Our login mechanism has been enhanced. To make your Admin Panel safer, please update your login information in the Settings -> General tab</p>
				</div>
			</div>
		</div>
EOD;
	}

	if (empty($totalmessages)) {
		$totalmessages = 0;
	}

	$cc_version_class = 'card-success';
	$acc_version_class = 'card-primary';
	if ($available_version != '') {
		$cc_version_class  = 'card-danger';
		$acc_version_class = 'card-success';
	}

	if(!empty($client)) {
		if(checkLicenseVersion()){
    		$active_plan = $planName;
		}elseif(!empty($plan)){
			$active_plan = $planInfo['mapping'][$plan];
		}
		$cc_version_class = 'card-success';
		$showplan = <<<EOD
		<div class="col-sm-6 col-lg-6">
			<div class="card card-inverse card-primary">
				<div class="card-block pb-0">
					<h1 class="mb-0" style="font-size:37px;">$active_plan</h1>
					<p>CometChat Plan</p>
				</div>
			</div>
		</div>
EOD;
	}

$body = <<<EOD
	<div class="row">
		$warningMsg
		<div class="col-sm-12 col-lg-12">
		<div class="row">
			<div class="col-sm-12 col-lg-12">
			<div class="card">
				<div class="card-header">
					Quick Stats
					<div style="width:200px;float:right;">
						{$dropdown}
					</div>
				</div>
				<div class="col-sm-3 col-lg-3">
					<div class="card card-inverse card-primary">
						<div class="card-block pb-0">
							<h1 class="mb-0">$onlineusers</h1>
							<p>Users Chatting $range</p>
						</div>
					</div>
				</div>
				<!--/col-->
				<div class="col-sm-3 col-lg-3">
					<div class="card card-inverse card-primary">
						<div class="card-block pb-0" $blurReport>
							<h1 class="mb-0">$totalmessagest</h1>
							<p>Messages Sent $range</p>
						</div>
						$blurFooterCode
					</div>
				</div>

				<!--/col-->
				<div class="col-sm-3 col-lg-3">
					<div class="card card-inverse card-primary">
						<div class="card-block pb-0">
							<h1 class="mb-0">$activeusers</h1>
							<p>Active Users $range</p>
						</div>
					</div>
				</div>
				<!--/col-->

				<!--/col-->
				<div class="col-sm-3 col-lg-3">
					<div class="card card-inverse card-primary">
						<div class="card-block pb-0">
							<h1 class="mb-0">$activeguests</h1>
							<p>Active Guest $range</p>
						</div>
					</div>
				</div>
				<!--/col-->
			</div>
			</div>
	</div>

EOD;
if(empty($client)) {
	if ($available_version == '') {
		$button = '<a href="?module=update&action=forceUpdate&ts='.$ts.'" class="btn" style="color: #fff;background-color: #1266f1;border-color: #0e61eb;">Force Update</a>';
		$updateUI = <<<EOD
		<div class="col-sm-6 col-lg-6 update-tab">
			<div class="card card-inverse card-primary">
				<div class="card-block pb-0">
				<h3 class="mb-0" style="font-size:20px;"> CometChat is Up-to-date</h3>
				<p style="margin-top:1rem;float:right;">{$button}</p>
				</div>
			</div>
		</div>
EOD;
	}else {
		$writablepath = dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'writable'.DIRECTORY_SEPARATOR;
		$button = '<a href="?module=update&action=updateNow&ts='.$ts.'" class="btn" style="color: #fff;background-color: #1266f1;border-color: #0e61eb;"> Update Now</a>';
		if(!file_exists($writablepath.'updates'.DIRECTORY_SEPARATOR.$available_version.DIRECTORY_SEPARATOR.'cometchat.zip')){
			$button = '<a href="?module=update&force=1&ts='.$ts.'" class="btn" style="color: #fff;background-color: #1266f1;border-color: #0e61eb;"><i class="fa fa-download"></i> Download</a>';
		}
		$updateUI = <<<EOD
		<div class="col-sm-6 col-lg-6 update-tab">
			<div class="card card-inverse card-primary">
				<div class="card-block pb-0">
					<h1 class="mb-0">v{$available_version} <span style="position:relative;float:right;">{$button}</span></h1>
					<p>Available Version &nbsp;<br></p>
				</div>
			</div>
		</div>
		<!--/col-->
EOD;
	}
}

$body .= <<<EOD
		<div class="row" $hideGraph>
			<div class="col-sm-6 col-lg-6">
				<div class="card">
					<div class="card-header">
						Daily Stats
						<div style="width:260px;float:right;" >
						<div style="float:left;">{$graphdropdown}</div>
						<div style="float:right;">{$firstGraphTypeOption}</div>
						</div>
					</div>
					<div class="card-block" id="first-graph">
					<img width="100" src="images/spinner.gif" style="display: block; margin: 0 auto;" />
					</div>
				</div>
			</div>

			<div class="col-sm-6 col-lg-6">
				<div class="card">
					<div class="card-header">
						Monthly Stats
						<div style="width:230px;float:right;">
						<div style="float:right;">{$secondGraphTypeOption}</div>
						</div>
					</div>
					<div class="card-block" id="second-graph">
					<img width="100" src="images/spinner.gif" style="display: block; margin: 0 auto;" />
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-6 col-lg-6">
				<div class="card">
					<div class="card-header">
						Updates
					</div>
						<div class="col-sm-6 col-lg-6">
							<div class="card card-inverse {$cc_version_class}">
								<div class="card-block pb-0">
									<h1 class="mb-0">v$currentversion</h1>
									<p>Current Version</p>
								</div>
								<div class="card-footer"><a href="https://www.cometchat.com/change-log" target="_blank" style="color: #ffffff;">Change Log</a></div>
							</div>
						</div>
						$updateUI
						<div class="col-sm-6 col-lg-6">
							<div class="card card-inverse card-primary">
								<div class="card-block pb-0">
									<h3 class="mb-0" style="font-size:20px;"> Love CometChat ?</h3>
									<p style="margin-top:1rem;"><span>Take a minute to <a style="color:#ffffff;" href="https://www.cometchat.com/reviews/write/" target="_blank">write us a testimonial</a></span></p><br>
								</div>
							</div>
						</div>
						<!--/col-->
						{$showplan}
				</div>
			</div>
		<div class="col-sm-6 col-lg-6 n  ">
			<div class="card">
				<div class="card-header">
					News
				</div>
				<div class="card-block">
					<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FCometChat%2F&tabs=timeline&width=500&height=300&small_header=true&adapt_container_width=true&hide_cover=true&show_facepile=false&appId=143961562477205" width="100%" height="300" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
				</div>
			</div>
		</div>

		</div>
		</div>
	</div>
 <script>
        window.onload = function() {
        	var dbms = '{$dbms}';
        	if(dbms == 'mysql'){
	        	loadFirstGraph();
	        	loadSecondGraph();
       		}
        };
    </script>
EOD;

	template();
}

function loadexternal() {
	if (file_exists(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.$_GET['type'].'s'.DIRECTORY_SEPARATOR.$_GET['name'].DIRECTORY_SEPARATOR.'settings.php')) {
		include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.$_GET['type'].'s'.DIRECTORY_SEPARATOR.$_GET['name'].DIRECTORY_SEPARATOR.'settings.php');
	} else {
echo <<<EOD
<form>
<div id="content">
		<h2>No configuration required</h2>
		<h3>Sorry there are no settings to modify</h3>
		<input type="button" value="Close Window" class="button" onclick="javascript:window.close();">
</div>
</form>
EOD;
	}
}

function loadthemetype() {
	if (file_exists(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.$_GET['type'].'s'.DIRECTORY_SEPARATOR.$_GET['name'].DIRECTORY_SEPARATOR.'settings.php')) {
		include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.$_GET['type'].'s'.DIRECTORY_SEPARATOR.$_GET['name'].DIRECTORY_SEPARATOR.'settings.php');
	} else {
echo <<<EOD
<form>
<div id="content">
		<h2>No configuration required</h2>
		<h3>Sorry there are no settings to modify</h3>
		<input type="button" value="Close Window" class="button" onclick="javascript:window.close();">
</div>
</form>
EOD;
	}
}

function themeembedcodesettings() {
	if (file_exists(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.$_GET['type'].'s'.DIRECTORY_SEPARATOR.$_GET['name'].DIRECTORY_SEPARATOR.'settings.php')) {
		$generateembedcodesettings = 1;
		include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.$_GET['type'].'s'.DIRECTORY_SEPARATOR.$_GET['name'].DIRECTORY_SEPARATOR.'settings.php');
	} else {
echo <<<EOD
<form>
<div id="content">
		<h2>No configuration required</h2>
		<h3>Sorry there are no settings to modify</h3>
		<input type="button" value="Close Window" class="button" onclick="javascript:window.close();">
</div>
</form>
EOD;
	}
}

function loadfirstgraphdata(){
	$type 		= $_REQUEST['type'];
	$graph 		= $_REQUEST['graph'];
	$interval 	= $_REQUEST['interval'];
	if ($type == 'messages') {
		switch ($interval) {
			case 'daily':
				$query = sql_query('today_messages',array());
				$messages = sql_fetch_assoc($query);
				$groupMessages 	= !empty($messages['groupmessage'])?$messages['groupmessage']:0;
				$privateMessages = !empty($messages['privatemessage'])?$messages['privatemessage']:0;
				$response = array(
					'labels' 		=> array("Last 24 Hours"),
					'datasetlable' 	=> array("One-on-one Chat",'Group Chat'),
					'datasetdata' => array(array($privateMessages),array($groupMessages)),
				);
				break;

			case 'weekly':
				$last7days = $last7daysGroupMessages = array();
				for($i=1;$i<=7;$i++){
				    $date = new DateTime();
				    $date->add(new DateInterval('P'.$i.'D'));
				    $last7days[$date->format('l')]  = 0;
				    $last7daysGroupMessages[$date->format('l')]  = 0;
				}
				$query = sql_query('weekly_privateMessages',array());
				while($messages = sql_fetch_assoc($query)){
					$last7days[$messages['day']] = $messages['message'];
				}
				$privateMessages = array_values($last7days);

				$query = sql_query('weekly_groupMessages',array());
				while($messages = sql_fetch_assoc($query)){
					$last7daysGroupMessages[$messages['day']] = $messages['message'];
				}
				$groupMessages = array_values($last7daysGroupMessages);

				$response = array(
					'labels' 		=> array_keys($last7days),
					'datasetlable' 	=> array("One-on-one Chat",'Group Chat'),
					'datasetdata' => array($privateMessages,$groupMessages),
				);
				break;

			case 'monthly':
				$privateMessages = $groupMessages = array();
				$weeks = array('1st week','2nd week','3rd week','4th week');
				$query = sql_query('monthly_Messages',array());
				$splice_counter = 0;
				while($messages = sql_fetch_assoc($query)){
					$privateMessages[] 	= $messages['privatemessage'];
					$groupMessages[]	= $messages['groupmessage'];
					$splice_counter++;
				}
				array_splice($weeks,$splice_counter);
				$response = array(
					'labels' 		=> $weeks,
					'datasetlable' 	=> array("One-on-one Chat",'Group Chat'),
					'datasetdata' => array($privateMessages,$groupMessages),
				);
				break;

			default:
				break;
		}
	}

	if ($type == 'users') {
		switch ($interval) {
			case 'daily':
				$query = sql_query('today_active_users_count',array('firstguestid'=>$GLOBALS['firstguestID']));
				$messages = sql_fetch_assoc($query);
				$usersCount 	= !empty($messages['totalactiveusers'])?$messages['totalactiveusers']:0;
				$guestCount = !empty($messages['totalactiveguest'])?$messages['totalactiveguest']:0;
				$response = array(
					'labels' 		=> array("Today"),
					'datasetlable' 	=> array("Active Users",'Active Guests'),
					'datasetdata' => array(array($usersCount),array($guestCount)),
				);
				break;

			case 'weekly':
				$last7daysActiveUser = $last7daysActiveGuest = array();
				for($i=1;$i<=7;$i++){
				    $date = new DateTime();
				    $date->add(new DateInterval('P'.$i.'D'));
				    $last7daysActiveUser[$date->format('l')]  = 0;
				    $last7daysActiveGuest[$date->format('l')]  = 0;
				}

				$query = sql_query('weekly_active_users',array('firstguestid'=>$GLOBALS['firstguestID']));
				while($users = sql_fetch_assoc($query)){
					if ($users['usertype'] == 'guest') {
						$last7daysActiveGuest[$users['day']] = $users['usercount'];
					}
					if ($users['usertype'] == 'user') {
						$last7daysActiveUser[$users['day']] = $users['usercount'];
					}
				}
				$response = array(
					'labels' 		=> array_keys($last7daysActiveUser),
					'datasetlable' 	=> array("Active Users",'Active Guests'),
					'datasetdata' => array(array_values($last7daysActiveUser),array_values($last7daysActiveGuest)),
				);
				break;

			case 'monthly':
				$activeusers = $activeguests = array();
				$weeks = array('1st week','2nd week','3rd week','4th week');
				$query = sql_query('monthly_active_users',array('firstguestid'=>$GLOBALS['firstguestID']));
				$splice_counter = 0;
				$uniqueWeek = '';
				while($users = sql_fetch_assoc($query)){
					if ($users['usertype'] == 'guest') {
						$activeguests[] 	= $users['usercount'];
					}
					if ($users['usertype'] == 'user') {
						$activeusers[] 	= $users['usercount'];
					}
					if($uniqueWeek != $users['Week']){
						$splice_counter++;
					}
					$uniqueWeek = $users['Week'];
				}
				array_splice($weeks,$splice_counter);
				$response = array(
					'labels' 		=> $weeks,
					'datasetlable' 	=> array("Active Users",'Active Guests'),
					'datasetdata' => array($activeusers,$activeguests),
				);
				break;

			default:
				break;
		}
	}

	header('Content-Type: application/json');
	if (!empty($_GET['callback'])){
		echo $_GET['callback'].'('.json_encode($response).')';
	} else {
		echo json_encode($response);
	}
	exit();
}

function loadsecondgraphdata(){
	$type = $_REQUEST['type'];
	switch ($type) {
		case 'messages':
			$lables = $privateMessages = $groupMessages = array();
			$query = sql_query('all_Messages',array());
			while($messages = sql_fetch_assoc($query)){
				$lables[] 			= $messages['month'].'-'. $messages['year'];
				$privateMessages[] 	= $messages['privatemessage'];
				$groupMessages[] 	= $messages['groupmessage'];
			}
			$response = array(
				'labels' 		=> $lables,
				'datasetlable' 	=> array("One-on-one",'Group Messages'),
				'datasetdata' => array($privateMessages,$groupMessages),
			);

			break;
		case 'users':
				$lables = $activeusers = $activeguests = array();
				$query = sql_query('all_active_users',array('firstguestid'=>$GLOBALS['firstguestID']));
				$data = array();
				while($users = sql_fetch_assoc($query)){
					$data[] = $users;
					$key = $users['month'].'-'.$users['year'];
					$labels[] = $key;
					if ($users['usertype'] == 'guest') {
						$activeguests[$key] = $users['usercount'];
					}
					if ($users['usertype'] == 'user') {
						$activeusers[$key] = $users['usercount'];
					}
				}
				$labels = array_unique($labels);
				foreach ($labels as $key => $value) {
					if (empty($activeusers[$value])) {
						$activeusers[$value] = '0';
					}
					if (empty($activeguests[$value])) {
						$activeguests[$value] = '0';
					}
				}
				usort($activeusers,"custom_sort");
				usort($activeguests,"custom_sort");
				$response = array(
					'labels' 		=> array_values($labels),
					'datasetlable' 	=> array("Active Users",'Active Guests'),
					'datasetdata' => array(array_values($activeusers),array_values($activeguests)),
				);
				break;
		case 'groups':
			$groupdata =array();
			$query = sql_query('all_groups',array());
			while($row = sql_fetch_assoc($query)){
				$key = $row['month'].'-'. $row['year'];
				$groupdata[$key] = $row['groupcount'];
			}
			$response = array(
				'labels' 		=> array_keys($groupdata),
				'datasetlable' 	=> array("Created Groups"),
				'datasetdata' => array(array_values($groupdata)),
			);
			break;
		default:
			break;
	}
	header('Content-Type: application/json');
	if (!empty($_GET['callback'])){
		echo $_GET['callback'].'('.json_encode($response).')';
	} else {
		echo json_encode($response);
	}
	exit();
}

function custom_sort($a,$b)
{
	list($month,$a) = explode('-', $a);
	list($month,$b) = explode('-', $b);
	if ($a==$b) return 0;
	 return ($a<$b)?-1:1;
}