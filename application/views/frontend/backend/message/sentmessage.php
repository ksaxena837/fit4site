<div class="gtco-section user-profile-page user-profile-message">
<div class="gtco-container user-profile-section">
	<!--Profile section-->
	<div class="col-md-9">
		<div class="row email-list">
			<aside class="col-sm-3 list col">
				<div class="compose">
					<a href="<?php echo base_url() ?>backend/message/composeMessage" class="btn btn-primary btn-block" style="border-radius:2px;">Compose</a>
				</div>

				<ul class="list-unstyled tab-list">
					<li><a href="<?php echo base_url() ?>backend/message/message">Inbox</a></li>
					<li><a href="<?php echo base_url();?>backend/message/starrtedMessage" >Starred</a></li>
					<li><a href="<?php echo base_url() ?>backend/message/sentMessage" class="active">Sent</a></li>
				</ul>
			</aside>
			<!--end of list links-->


			<section class="col-sm-9 list-body col">

			<!--Top nav section start From here-->
			<div class="top-nav-sec">
			<div class="btn-group">
			  <button type="button" style="border-radius:0px;height: 30px;padding: 3px 20px;" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Action <span class="caret"></span>
			  </button>
			  <ul class="dropdown-menu">
				<li><a href="javascript:void(0);"><input type="radio" name="actionval" class="selectcheckbox" value="selectall" id="all-select">Delete All</a></li>
				<!--<li role="separator" class="divider"></li>-->
				<li><a href="javascript:void(0);"><input type="radio" name="actionval" class="selectcheckbox" value="readall" id="readall">Read All</a></li>

			  </ul>
			</div>

			<button type="button" id="actnbtn" style="border-radius:0px;height: 30px;padding: 3px 20px;" class="btn btn-primary">Submit </button>
			<button type="button" id="deletemsg"  style="border-radius:0px;height: 30px;padding: 3px 20px;" class="btn btn-danger">Delete</button>
			</div>
			<!--End of Top nav section-->

			<hr/>

		<script type='text/javascript'>
		 $(document).ready(function(){
		   // Check or Uncheck All checkboxes
		   $("#all-select").click(function(){
		     var checked = $(this).is(':checked');
		     if(checked){
		       $(".msgcheck").each(function(){
		         $(this).prop("checked",true);
		       });
		     }else{
		       $(".msgcheck").each(function(){
		         $(this).prop("checked",false);
		       });
		     }
		   });
			 $("#readall").click(function(){
		     var checked = $(this).is(':checked');
		     if(checked){
		       $(".msgcheck").each(function(){
		         $(this).prop("checked",true);
		       });
		     }else{
		       $(".msgcheck").each(function(){
		         $(this).prop("checked",false);
		       });
		     }
		   });
		  // Changing state of CheckAll checkbox
		  $(".msgcheck").click(function(){

		    if($(".msgcheck").length == $(".msgcheck:checked").length) {
		      $("#all-select").prop("checked", true);
		    } else {
		      $("#all-select").removeAttr("checked");
					$("#readall").removeAttr("checked");
		    }

		  });

				$('#deletemsg').click(function(){
					var msgid = [];
					$('input[name="messageIds"]:checked').each(function() {
						 msgid.push(this.value);
						 $.ajax({
		 					type: "POST",
		 			    url: "<?php echo base_url();?>backend/message/deleteMessages",
		 			    //dataType: "json",
		 			    data: { messageIds: msgid},
		 			    success: function(response){
								$.each(msgid, function(key, value){
								 $("#row"+value).remove();
							 });
		 			    }
		 				});
					});
				});
			$('#actnbtn').click(function(){
				var msgid = [];
				$('input[name="messageIds"]:checked').each(function() {
					 msgid.push(this.value);

				});
				var fireaction = $(".selectcheckbox:checked").val();
				if(fireaction!=undefined){
				$.ajax({
					type: "POST",
			    url: "<?php echo base_url();?>backend/message/deleteMessages",
			    //dataType: "json",
			    data: { messageIds: msgid,fireaction:fireaction },
			    success: function(response){
			        console.log(response);
			    }
				});
			}
		if(fireaction!=undefined && fireaction=='selectall'){
				$.each(msgid, function(key, value){
				 $("#row"+value).remove();
			 });
		 }

			});
			$('.star').click(function(){
				var starValue = $(this).val();
				if($(this).is(':checked')){
					starStatus = 'true';
				}else{
					starStatus = 'false';
				}
				$.ajax({
					type: "POST",
					url: "<?php echo base_url();?>backend/message/updatestarstatus",
					//dataType: "json",
					data: { starStatus: starStatus,starValue:starValue},
					success: function(response){
							console.log(response);
					}
				});

			});
		});
</script>



			<table class="table inbox">
				<thead>
				<tr>
					<th></th>
					<th></th>
					<th>Sent To</th>
					<th>Message</th>
					<th></th>
				</tr>
				<?php  if(!empty($messages)){ foreach($messages as $msg){
					$userfrm = getAnyUserRecordById($msg->user_from);
					?>
						<tr id="row<?php echo $msg->msg_id;?>">
							<td class="selectcheckbox">
								<label class="checkbox-container">
									<input class="msgcheck" type="checkbox" name="messageIds" value="<?php echo $msg->msg_id;?>">
									<span class="checkmark"></span>
								</label>
							</td>
							<td><input class="star" type="checkbox" <?php echo ($msg->star_status=='starred')?'checked' :'' ?> value="<?php echo $msg->msg_id;?>"></td>
							<td><?php	$rs = getAnyUserRecordById($msg->user_from);
								echo $rs->name;
							?></td>
							<td><a href="<?php echo base_url();?>backend/message/viewReply/<?php echo $msg->msg_id.'/'.$msg->user_from;?>"><?php echo $msg->message;?></a></td>
							<td><span class="datetime"><?php echo fitForSiteDateSent($msg->date_received) ;?></span></td>
						</tr>
						<?php } } ?>

				</thead>

			</table>
			<!--end of Table -->
			</section>
			<!--end of list body-->

		</div>
		<!--end of row of email List-->

	</div>
	<!--end of profile section-->

	<!--sidebar section-->
	<div class="col-md-3 profile-sidebar" style="margin-left:0px;">
		<div class="sidebar1">
		<a href="#"><i class="fa fa-camera" aria-hidden="true"></i>View Portfolio</a>
		</div>
		<div class="sidebar2">
		<h4><div data-address="<?php echo $userprofile[0]->location;?> " class="google-maps"></div></h4>
		</div>


	</div>
	<!--end of sidebar-->
</div>


</div>
<!--end of user message page-->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyDSrb3rVgMSRK4IVwGcc8gk3oXMxBqozAo"></script>
<script>
$(".google-maps").each(function () {
		var embed = "<iframe width='250' height='200' frameborder='0' scrolling='no'  marginheight='0' marginwidth='0'   src='https://maps.google.com/maps?&amp;q=" + encodeURIComponent($(this).data('address')) + "&amp;z=10&amp;output=embed&iwloc'></iframe>";
		$(this).html(embed);
});
</script>
<script>
$('document').ready(function()
{
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#previewimage').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
		$("#uploadFile").change(function(){
			readURL(this);
		});
	});


/* script */
function initialize() {

	 var latlng = new google.maps.LatLng(<?php echo ($userprofile[0]->lat!='')?$userprofile[0]->lat:'28.535517';?>,<?php echo ($userprofile[0]->lng!='')?$userprofile[0]->lng:'77.391029';?>);
		var map = new google.maps.Map(document.getElementById('map'), {
			center: latlng,
			zoom: 13
		});
		var marker = new google.maps.Marker({
			map: map,
			position: latlng,
			draggable: true,
			anchorPoint: new google.maps.Point(0, -29)
	 });

		var input = document.getElementById('searchInput');
		map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
		var geocoder = new google.maps.Geocoder();
		var autocomplete = new google.maps.places.Autocomplete(input);
		autocomplete.bindTo('bounds', map);
		var infowindow = new google.maps.InfoWindow();
		autocomplete.addListener('place_changed', function() {
				infowindow.close();
				marker.setVisible(false);
				var place = autocomplete.getPlace();
				if (!place.geometry) {
						window.alert("Autocomplete's returned place contains no geometry");
						return;
				}

				// If the place has a geometry, then present it on a map.
				if (place.geometry.viewport) {
						map.fitBounds(place.geometry.viewport);
				} else {
						map.setCenter(place.geometry.location);
						map.setZoom(17);
				}

				marker.setPosition(place.geometry.location);
				marker.setVisible(true);

				bindDataToForm(place.formatted_address,place.geometry.location.lat(),place.geometry.location.lng());
				infowindow.setContent(place.formatted_address);
				infowindow.open(map, marker);

		});
		// this function will work on marker move event into map
		google.maps.event.addListener(marker, 'dragend', function() {
				geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					if (results[0]) {
							bindDataToForm(results[0].formatted_address,marker.getPosition().lat(),marker.getPosition().lng());
							infowindow.setContent(results[0].formatted_address);
							infowindow.open(map, marker);
					}
				}
				});
		});
}
function bindDataToForm(address,lat,lng){
	 document.getElementById('userlocation').value = address;
	 document.getElementById('lat').value = lat;
	 document.getElementById('lng').value = lng;
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>
