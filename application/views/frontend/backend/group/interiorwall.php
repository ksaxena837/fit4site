<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
<section id="group-2-coloum-layout" class="clearfix">
<div class="container">
	<div class="row eqqualheight">
		<aside class="col-sm-2 sidebar">
			<div class="thumbnail">
				<img src="<?php echo (!empty($wallInfo[0]->profile_image)) ? base_url().'uploads/profile/'.$wallInfo[0]->profile_image : 'https://www.nriva2017.org/wp-content/themes/Nriva2017/images/user-dummy.png' ?>" alt="user-name" class="img-responsive" />
				<h3 class="username"><?php echo $wallInfo[0]->name; ?></h3>
			</div>
			<!--end of Thumbnail-->
			<ul class="group-list list-unstyled">
				<li class="active"><a href="">View Profile</a></li>
				<li><a href="">Photos</a></li>
			</ul>
			<!--end of group list-->
		</aside>
		<!--end of sidebar-->
		
		<div class="col-sm-8">
			<div class="post-write-section">
			<div class="page-header" style="margin-top:20px;">
				<h3 class="">INTERIOR WALL</h3>
			</div>
			<!--end of page header-->

			<?php if(count($followed) > 0  OR $wall_id == $userprofile[0]->userId ){  ?>
			<!--Write a Post Section-->
			<div class="post-write">
				<div id="write-post-form">
					<form method="post" action="" id="addpostform">
						<input type="hidden" id="posttype" name="posttype" value="" data-type="" />
						<input type="hidden" name="wall_id" value="<?php echo $wall_id; ?>"/> 
						<div class="form-group">
							<textarea class="form-control" id="write-post-textarea" name="write-post-textarea" height="120" placeholder="Write a post"></textarea>
						</div>
						<div class="form-group">
							<ul class="list-unstyled list-inline">
							<li class="attachment">
								<label for="image">
								<input type="radio" name="attachment" value="image" id="image" class="hidden"/>
								<i class="fas fa-image btn btn-default noround iconbutton"></i>
								</label>
							</li>
							<li class="attachment">
								<label for="video">
								<input type="radio" name="attachment" value="video" id="video" class="hidden"/>
								<i class="fas fa-video btn btn-default noround iconbutton"></i>
								</label>
							</li>
							<li class="attachment">
								<label for="file">
								<input type="radio" name="attachment" value="file" id="file" class="hidden"/>
								<i class="fas fa-paperclip btn btn-default noround iconbutton"></i>
								</label>
							</li>
							<li><div id="selectedType"></div></li>
							</ul>
						</div>
						<button type="submit" name="submit-post" class="btn btn-primary noround btn-sm" id="addPost">Add Post</button>
				</form>
				</div>

				<!--Upload Video-->
				<div class="modal fade" id="uploadModel" tabindex="-1" role="dialog" aria-labelledby="uploadvideo" data-keyboard="false" data-backdrop="static">
				<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="uploadModelTitle">Upload</h4>
					</div>
					<div class="modal-body">
						<form class="form-inline" id="fileUploadForm" enctype= "multipart/form-data">
							 <div class="form-group">
								<input type="file" id="uploadfile" required>
							 </div>
							 <button type="submit" class="btn btn-primary btn-sm noround uploadfilebutton">Upload</button>
						</form>
					</div>
					<!--End of Modal Body-->
				</div>
				</div>
				</div>
				<!--End OF VIDEO UPLOAD MODEL-->

				<script>
				jQuery(function($){
						$('#addpostform input[name="attachment"]').on('change', function(){
							var type= $(this).val();
							if(type == 'image'){
								$('#uploadfile').attr('accept','image/*');
							}
							else if(type == 'video'){
								$('#uploadfile').attr('accept','video/*');
							}
							else{
								$('#uploadfile').attr('accept','application/*');
							}

							$('#uploadModel').modal('show');
							$('#uploadModel #uploadModelTitle').text('Upload '+type);

							//Upload File with Ajax
							$("#fileUploadForm").on('submit', function(e) {
									e.preventDefault();
									var wall_id = $('input[name=wall_id]').val();
									var file_data = $('#uploadfile').prop('files')[0];
									var form_data = new FormData();
									form_data.append('file', file_data);
									form_data.append('wall_id', wall_id);

									$.ajax({
										type:'POST',
										url: "<?php echo base_url(); ?>"+"backend/profile/ajaxSubmitPost",
										cache: false,
										contentType: false,
										processData: false,
										data: form_data,
										type: 'POST',
										beforeSend: function() {
								      $('.uploadfilebutton').text('uploading...').attr('disabled','disabled');
								    },
										success: function (response) {
											var obj = JSON.parse(response);
											$('#posttype').attr('data-type', obj.filetype);
											$('#posttype').val(obj.filename);
											$('#uploadModel').modal('hide');
											$('.uploadfilebutton').removeAttr('disabled').text('Upload');
											$('#selectedType').fadeIn().text(obj.message);
										},
										error: function(response){
											console.log("error");

										}
									});
							});
						});

						//add Post to database
						$('#addPost').click(function(){
							 var postDesc = $('#write-post-textarea').val();
							 var postVal  = $('#posttype').val();
							 if((postDesc.length === 0) && (postVal.length === 0)){
								 alert('Please add Something about you.');
							 }
							 else{

								 $.ajax({
									 type:'POST',
									 url: "<?php echo base_url(); ?>"+"backend/profile/ajaxAddPost",
									 dataType: 'json',
									 data: {
										 'postDesc' : postDesc,
										 'postType' : $('#posttype').attr("data-type"),
										 'postVal'	 : postVal,
										 'wallId'	 : $('input[name=wall_id]').val(),
										 'userId'   : '<?php echo $userprofile[0]->userId; ?>'
									 },
									 beforeSend: function() {
										 $('#addPost').text('adding...').attr('disabled','disabled');
									 },
									 success: function (response) {
										 location.reload();
										
									 },
									 error: function(response){
										 console.log("error");

									 }
								 });
							 }

						});
						

				});
				</script>


			</div>
			<!--end of Write a Post Section-->
			<?php } ?>
			
			</div>
			<!--End of Post Write Section-->

			<hr/ class="clearfix">
			
			<section id="postview">
				
				<?php foreach ($wallPosts as $key => $val){ ?>
				<article class="post-article">
					<div class="article-header">
					<div class="media">
						<div class="media-left"><div class="userimage"><img src="<?php echo base_url(); ?>uploads/profile/<?php echo $val->profile_image; ?>" alt="<?php echo $val->username; ?>" class="media-object img-circle"/></div></div>
						<div class="media-body">
							<h4 class="username"><?php echo $val->username; ?></h4>
							<p class="time">
								<?php 
									$currentyear = date('Y');
									$postyear = date('Y', $val->time);
									$postdate = date('d', $val->time).' '.date('F', $val->time);
									if($currentyear == $postyear){
										echo $postdate.' at '. date('H:i', $val->time);
									}
									else{
										echo $postdate.' '.date('Y', $val->time).' at '.date('H:i', $val->time);
									}
								?>
								</p>
						</div>
					</div>
					</div>
					<!--End of article header-->
					
					<div class="article-body">
						<div class="video-section">
						
						<?php 
							//Type checking Image
							if (strpos($val->post_type, 'image') !== false) {
							   echo '<article class="image">
										<img src="'.base_url().'uploads/wall/'.$val->wall_id.'/'.$val->attachment.'" alt="image" class="img-responsive" />
									 </article>';
								if(!empty($val->post_desc)){
									echo  '<article class="desc"><p>'.$val->post_desc.'</p></article>';
								}	 
							}
							else if (strpos($val->post_type, 'video') !== false) {
								echo '<article class="video">
										<video>
											<source src="'.base_url().'uploads/wall/'.$val->wall_id.'/'.$val->attachment.'" type="video/webm">
											<source src="'.base_url().'uploads/wall/'.$val->wall_id.'/'.$val->attachment.'" type="video/ogg">
											<source src="'.base_url().'uploads/wall/'.$val->wall_id.'/'.$val->attachment.'" type="video/mp4">
												<div class="loading">
												  I have a bad feeling about this... <br> ... your browser does not support the video format!
												</div>
										 </video>
										</article>';
								if(!empty($val->post_desc)){
									echo  '<br/><article class="desc"><p>'.$val->post_desc.'</p></article>';
								}		
							}
							else if(empty($val->post_type)){
								echo  '<article class="status">
										   <p>'.$val->post_desc.'</p>
									   </article>';
							}
							else{
								echo '<article class="file">
									   <img src="https://blog.twitter.com/content/dam/blog-twitter/official/en_us/products/2017/rethinking-our-default-profile-photo/Avatar-Blog1-Years.png.img.fullhd.medium.png" alt="image" class="img-responsive" />
									   <div class="downloadFile"><a href="'.base_url().'uploads/wall/'.$val->wall_id.'/'.$val->attachment.'" download>Download File</a></div>
									 </article>';
								if(!empty($val->post_desc)){
									echo  '<br/><article class="desc"><p>'.$val->post_desc.'</p></article>';
								}
							}
						?>
						
						</div>
					</div>
					<!--end of Article Body-->
					
					<div class="article-footer">
						<ul class="list-unstyled list-inline article-info">
							<li>
								<a href="javascript:void(0)" class="likes">
									<?php 
										foreach($likes as $postlike){
											if($val->id == $postlike->post_id){
												echo '<span class="count-likes">'.$postlike->likes.'</span>';
												echo ' Likes';
											}
										}
									?>
								</a>
							</li>
							<li>
								<a href="javascript:void(0)" class="comments">
								<?php 
									foreach($comments as $postcomment){
										if($val->id == $postcomment->post_id){
											echo '<span class="count-likes">'.$postcomment->comments.'</span>';
											echo ' Comments';
										}
									}
								?>
								</a>
							</li>
						</ul>

						<ul class="lickCommentShare list-unstyled list-inline">
							<li class="like">
								<?php 
									if(in_array($val->id, $liked)){ ?>
									<a href="javascript:void(0)" class="like-post active" data-postid="<?php echo $val->id; ?>" >
										<i class="far fa-thumbs-up"></i> 
										<span class="like-unlike">Liked</span>
									</a>
									<?php 
									} else{ ?>
									<a href="javascript:void(0)" class="like-post" data-postid="<?php echo $val->id; ?>" >
										<i class="far fa-thumbs-up"></i> 
										<span class="like-unlike">Like</span>
									</a>	
								<?php }	?>
								
							</li>
							<li class="comment">
								<a href="javascript:void(0)" data-postid="<?php echo $val->id; ?>"><i class="fas fa-comment-alt"></i> Comment</a>
							</li>
							<li class="share"><a href="javascript:void(0)" data-postid="<?php echo $val->id; ?>"><i class="fas fa-share-alt"></i> Share</a></li>
						</ul>

						<!--Comment System Start From here-->
						<div class="comment-system">
							<div class="commentMe">
								<div class="media">
									<div class="media-left"><img src="<?php echo base_url().'uploads/profile/'.$userprofile[0]->profile_image; ?>" alt="" class="img-circle" style="max-width:40px;"></div>
									<div class="media-body">
									<form method="post" class="comment-form" autocomplete="off">
										 <div class="input-group add-comment-form">
										  <input type="hidden" name="postid" value="<?php echo $val->id; ?>"/>
										  <input type="text" class="form-control" name="comment" placeholder="Add a comment" required>
										  <span class="input-group-btn">
											<button class="btn btn-primary" type="submit">Add Comment</button>
										  </span>
										</div><!-- /input-group -->
										
									</form>	
									</div>
								</div>
								
								
								<div class="loading-comments hidden">Loading...</div> 
								<ul class="comments list-unstyled"></ul>
								<!--End of Comments-->

							</div>
							<!--End of CommentMe-->

						</div>
						<!--End of Comment System-->

					</div>
					<!--End of article Footer-->
				
				</article>
				<?php }	?>
			
				<!--pagination-->
				<nav aria-label="...">
				  <ul class="pager">
					<?php if($page_num != 1){ ?>
					<li class="previous"><a href="<?php echo base_url(); ?>backend/profile/interiorwall/<?php echo $wall_id.'/'.($page_num-1); ?>"><span aria-hidden="true">&larr;</span> Newer </a></li>
					<?php } ?> 
					<li class="next"><a href="<?php echo base_url(); ?>backend/profile/interiorwall/<?php echo $wall_id.'/'.($page_num+1); ?>">Older  <span aria-hidden="true">&rarr;</span></a></li>
				  </ul>
				</nav>
				<!--End of pagination-->
			
			</section>
			<!--End of Postview-->

			<script>
				jQuery(function($){
					$('.lickCommentShare>li.comment>a').click(function(){
						$('.loading-comments').removeClass('hidden');
						var postid = $(this).data('postid');
						$.ajax({
							url: "<?php echo base_url();?>backend/profile/vieaAllComments",
							data: {'postid':postid},
							type: "POST",
							dataType: 'json',
							context: this,
							success: function(response){
								
							},
							error: function(errorThrow){
								console.log(errorThrow);
							},
							complete : function(response) {
								$('.loading-comments').addClass('hidden');
								
								$(this).parents('.article-footer').find('ul.comments').html('');
								$(this).parents('.article-footer').find('ul.comments').html(response.responseJSON);
								$(this).parents('.article-footer').find('.comment-system').stop().slideDown();
							}
						});
						
						
						
					});
				});
			</script>
			

		
		</div>
		<!--End of Main content section-->
		
		<!-- RIGHT SIDEBAR -->
		<div class="col-sm-2">
		<?php if($wall_id != $userprofile[0]->userId){ ?>
			<?php if(count($followed) > 0): ?> 
			<a href="javascript:void(0)" class="followWall btn btn-primary btn-block noround follow_wall">Unfollow</a>
			<?php else: ?>
			<a href="javascript:void(0)" class="followWall btn btn-primary btn-block noround follow_wall">Follow</a>
			<?php endif; ?>
		<?php } ?>	
		</div>
		<!--END OF SIDEBAR-->
		
		
		<script>
		$(document).ready(function(){
			
			//Like Post of wall
			$('.like-post').click(function(){
				var postid = $(this).data('postid');
				$.ajax({
				  url: "<?php echo base_url();?>backend/profile/postlike",
					data: {
						'postid':postid,
						'wallid': $('input[name=wall_id]').val(),
					},
					type: "POST",
					dataType: 'json',
					context: this,
					success: function(response){
						if(response == 1){
							$(this).addClass('active').find('.like-unlike').text('Liked');
						}
						else{
							$(this).removeClass('active').find('.like-unlike').text('Like');
						}
					},
					error: function(errorThrow){
						console.log(errorThrow);
					}
				});
				
				//count total likes
				
			});
			
			
			//Add Comment For Post
			$('form.comment-form').submit(function(e){
				e.preventDefault();
				var comment = $(this).find('input[name="comment"]').val();
				var postid  = $(this).find('input[name="postid"]').val();
				$.ajax({
				  url: "<?php echo base_url();?>backend/profile/addComment",
					data: {
						'postid':postid,
						'wall_id': '<?php echo $wall_id ?>',
						'comment': comment,
					},
					type: "POST",
					dataType: 'json',
					context: this,
					success: function(response){
					
					},
					error: function(errorThrow){
						console.log(errorThrow);
					},
					complete : function(response) {
						$(this).parents('.comment-system').find('ul.comments').append(response.responseJSON);
					}	
				});	
				
			});
			
			//Share Posts
			$('.lickCommentShare .share>a').click(function(){
				
				var postid = $(this).data('postid');
				var facebookUrl = 'https://www.facebook.com/sharer.php?u=www.fit4site.co.uk/fit4site/backend/sitegroup/view_post/'+postid;
				$('#share-on-facebook #facebookUrl').attr('href',facebookUrl);
				
				
				var twitterUrl = 'http://twitter.com/share?url=www.fit4site.co.uk/fit4site/backend/sitegroup/view_post/'+postid;
				$('#share-on-facebook #twitterUrl').attr('href',twitterUrl);
				
				var linkedinUrl = 'https://www.linkedin.com/shareArticle?mini=true&url=www.fit4site.co.uk/fit4site/backend/sitegroup/view_post/'+postid;
				$('#share-on-facebook #linkedinUrl').attr('href',linkedinUrl);
				
				$('#share-on-facebook').modal('show')
			});
			
			
			//Follow and Unfollow Users
			$(".follow_wall").click(function(){
				followerid = '<?php echo $wall_id ?>';
				if(followerid!='' && followerid!='undefined'){
				$.ajax({
				  url: "http://www.fit4site.co.uk/fit4site/backend/memberlist/followUnfollow",
					data: {'followerid':followerid},
					type: "POST",
					context: this,
					success: function(response){
					},
					complete : function(response) {
						$(this).text('Unfollow');
						location.reload();
					}
				});
					}
			});
			
		});
		</script>
		
		
		
		
		
	</div>
</div>
</section>	
		
<!-- Modal -->
<div class="modal fade" id="share-on-facebook" tabindex="-1" role="dialog" aria-labelledby="share-on-facebook">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Share Post On</h4>
      </div>
      <div class="modal-body">
		<a href="" class="btn btn-primary noround btn-sm" target="_blank" id="facebookUrl"><i class="fab fa-facebook-f"></i> &nbsp; | &nbsp; Share on Facebook</a> 
		<a href="" class="btn btn-info noround btn-sm" target="_blank" id="twitterUrl"><i class="fab fa-twitter"></i> &nbsp; | &nbsp; Share on Twitter</a> 
		<a href="" class="btn btn-success noround btn-sm" target="_blank" id="linkedinUrl"><i class="fab fa-linkedin-in"></i> &nbsp; | &nbsp; Share on Linkedin</a> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->		
		