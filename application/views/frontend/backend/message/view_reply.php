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
					<li><a href="<?php echo base_url();?>backend/message/starrtedMessage" >Started</a></li>
					<li><a href="<?php echo base_url() ?>backend/message/sentMessage" class="active">Sent</a></li>
				</ul>
			</aside>
			<!--end of list links-->


			<section class="col-sm-9 list-body col">
			<div class="page-header" style="margin-top:0px;">
				<?php if(!empty($messages)):?>
				<h3>Re: <?php echo ($messages[0]->message)?$messages[0]->message:'';?></h3>
			<?php endif;?>
				<?php $usertodetail = getAnyUserRecordById($user_to);?>
				<p><small>Conversation between you and <?php echo $usertodetail->name;?></small> <a href="javascript:void(0);" id="deleteconversation" data-id="<?php echo $msg_id;?>" class="btn btn-danger btn-sm noround pull-right">DELETE</a></p>
			</div>
			<!--End of page header-->


			<ul class="list-unstyled chatMessage">
				<!--<li>
					<div class="media">
						<div class="media-left">
						<img src="https://www.atomix.com.au/media/2015/06/atomix_user31.png" alt="" class="media-object" width="50"/>
						</div>
						<div class="media-body">
							<h5 class="media-heading">User sent 1 month, 3 weeks ago</h5>
							<span>Hi User</span>
						</div>
					</div>
				</li>

				<li>
					<div class="media">
						<div class="media-left">
						<img src="https://png.icons8.com/color/1600/circled-user-female-skin-type-1-2.png" alt="" class="media-object" width="50"/>
						</div>
						<div class="media-body">
							<h5 class="media-heading">Me sent 1 month, 3 weeks ago</h5>
							<span>Hi, How are you?</span>
						</div>
					</div>
				</li>-->
				<?php if(!empty($messages)){ foreach($messages as $msg){
						$userfrm = getAnyUserRecordById($msg->user_from);?>
					<li>
						<div class="media">
							<div class="media-left">
							<img src="<?php echo base_url();?>uploads/profile/<?php echo $userfrm->profile_image;?>" alt="" class="media-object" width="50"/>
							</div>
							<div class="media-body">
								<h5 class="media-heading"><?php	$userfrm = getAnyUserRecordById($msg->user_from);?><?php echo fitForSiteDateSent($msg->sent_date) ;?></h5>
								<span><?php echo $msg->reply_messages;?></span>
							</div>
						</div>
					</li>
				<?php } }?>
				<li>
				<div class="media">
						<?php if(!empty($messages)){?>
						<div class="media-left">
						<img src="<?php echo base_url();?>uploads/profile/<?php echo $userfrm->profile_image;?>" alt="" class="media-object" width="50"/>
						</div>
						<?php } ?>
						<div class="media-body">
							<h5 class="media-heading">Send a Reply</h5>
							<form method="post" action="<?php echo base_url();?>backend/message/viewReply/<?php echo $msg_id.'/'.$user_to;?>">
							<div class="form-group">
								<textarea name="reply_messages" id="reply_messages" cols="30" rows="4" class="form-control"></textarea>
							</div>
							<button type="submit" class="btn btn-primary btn-sm noround">Send </button>
							</form>
						</div>
					</div>
				</li>

			</ul>
			<!--End of List Unstyled-->

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
