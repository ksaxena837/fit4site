<section id="single-post" style="clear:both">
<div class="container">
	<div class="row">
		
		<br/></br/>
	
		<article class="col-sm-8">
		<div class="thumbnail">
			<?php 
				//Type checking Image
				$val = $post[0];
				
				if (strpos($val->post_type, 'image') !== false) {
				   echo '<article class="image">
							<img src="'.base_url().'uploads/groups/'.$val->group_id.'/'.$val->attachment.'" alt="image" class="img-responsive" />
						 </article>';
					if(!empty($val->post_desc)){
						echo  '<div class="caption"><article class="desc"><p>'.$val->post_desc.'</p></article></div>';
					}	 
				}
				else if (strpos($val->post_type, 'video') !== false) {
					echo '<article class="video">
							<video>
								<source src="'.base_url().'uploads/groups/'.$val->group_id.'/'.$val->attachment.'" type="video/webm">
								<source src="'.base_url().'uploads/groups/'.$val->group_id.'/'.$val->attachment.'" type="video/ogg">
								<source src="'.base_url().'uploads/groups/'.$val->group_id.'/'.$val->attachment.'" type="video/mp4">
									<div class="loading">
									  I have a bad feeling about this... <br> ... your browser does not support the video format!
									</div>
							 </video>
							</article>';
					if(!empty($val->post_desc)){
						echo  '<div class="caption"><article class="desc"><p>'.$val->post_desc.'</p></article></div>';
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
						   <div class="downloadFile"><a href="'.base_url().'uploads/groups/'.$val->group_id.'/'.$val->attachment.'" download>Download File</a></div>
						 </article>';
					if(!empty($val->post_desc)){
						echo  '<div class="caption"><article class="desc"><p>'.$val->post_desc.'</p></article></div>';
					}
				}
			?>
			<div class="caption">
			<ul class="list-unstyled list-inline">
				<li><i class="fa fa-user"></i> <?php echo $val->username; ?> </li>
				<li><i class="fa fa-calendar"></i> 
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
				</li>
			</ul>
			</div>
			
			
		</div>	
		</article>
		<!--End of article-->
		
		<aside class="col-sm-3">
		
		</aside>
		<!--End of aside-->
		
	</div>
	<!--End of Row-->
</div>
</section>