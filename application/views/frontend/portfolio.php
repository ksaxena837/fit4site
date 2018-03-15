
	<div class="gtco-section">
		<div class="gtco-container">

				<div class="toolbar mb2 mt2 col-sm-12">
				  <button class="btn fil-cat" data-rel="all">All</button>
				  <button class="btn fil-cat" data-rel="web">Websites</button>
				  <button class="btn fil-cat" data-rel="flyers">Flyers</button>
				  <button class="btn fil-cat" data-rel="bcards">Business Cards</button>
				</div>

				<div style="clear:both;"></div>
				<div id="portfolio">
					<?php $i=0; foreach($portfolios as $portfolio) { if($i==0){$cls = 'web';}else if($i==2){$cls = 'flyers';}else if($i>2){$cls = 'bcards';}else{$cls = 'all';} ?>
				  <div class="tile scale-anm all <?php echo $cls;?> col-sm-4">
				    <div class="itembox">
					<img src="<?php echo base_url();?>uploads/<?php echo $portfolio->image_url; ?>" alt="" />
					<div class="hover-box">
						<h3><?php echo $portfolio->title; ?></h3>
						<p><?php echo $portfolio->description;?></p>
						<p class="text-center"><a href="javascript:void(0);" class="btn btn-success">READ MORE</a></p>
					</div>
					</div>
				</div>
				<?php $i++; } ?>
				  <!--<div class="tile scale-anm all col-sm-4">
					<div class="itembox">
					<img src="https://jqueryplugins.net/wp-content/uploads/2016/10/Material-Design-Resume-CV-Portfolio-Template-400x250.png" alt="" />
					<div class="hover-box">
						<h3>PORTFOLIO ITEM</h3>
						<p>Lorem ipsum dolor asit amet</p>
						<p class="text-center"><a href="#" class="btn btn-success">READ MORE</a></p>
					</div>
					</div>
				  </div>
				  <div class="tile scale-anm web all col-sm-4">
					<div class="itembox">
					<img src="https://blog.sonicwall.com/wp-content/uploads/2017/09/SNWL-social-images-eagle-FACEBOOK-400x250.jpg" alt="" />
					<div class="hover-box">
						<h3>PORTFOLIO ITEM</h3>
						<p>Lorem ipsum dolor asit amet</p>
						<p class="text-center"><a href="#" class="btn btn-success">READ MORE</a></p>
					</div>
					</div>
				  </div>
				  <div class="tile scale-anm web all col-sm-4">
					<div class="itembox">
					<img src="http://www.lagrail.com/wp-content/uploads/2014/09/portfolio-vetro05-400x250.jpg" alt="" />
					<div class="hover-box">
						<h3>PORTFOLIO ITEM</h3>
						<p>Lorem ipsum dolor asit amet</p>
						<p class="text-center"><a href="#" class="btn btn-success">READ MORE</a></p>
					</div>
					</div>
				  </div>
				  <div class="tile scale-anm flyers bcards all col-sm-4">
					<div class="itembox">
					<img src="https://jqueryplugins.net/wp-content/uploads/2016/06/Freelo-Creative-HTML-Portfolio-Theme-400x250.jpg" alt="" />
					<div class="hover-box">
						<h3>PORTFOLIO ITEM</h3>
						<p>Lorem ipsum dolor asit amet</p>
						<p class="text-center"><a href="#" class="btn btn-success">READ MORE</a></p>
					</div>
					</div>
				  </div>
				  <div class="tile scale-anm flyers  bcards all col-sm-4">
					<div class="itembox">
					<img src="https://www.ocreativedesign.com/wp-content/uploads/2017/07/INPEACE-1280x800-400x250.jpg" alt="" />
					<div class="hover-box">
						<h3>PORTFOLIO ITEM</h3>
						<p>Lorem ipsum dolor asit amet</p>
						<p class="text-center"><a href="#" class="btn btn-success">READ MORE</a></p>
					</div>
				  </div>
				</div>-->

				</div>

				<div style="clear:both;"></div>


			<div class="row">
				<div class="col-md-6 animate-box">

				</div>
				<div class="col-md-5 col-md-push-1 animate-box">

				</div>
			</div>

		</div>
	</div>

	<div class="gtco-cover gtco-cover-sm" style="background-image:url(<?php echo base_url();?>/assets/frontend/images/img_bg_3.jpg);">
		<div class="overlay"></div>
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center">
					<div class="display-t">
						<div class="display-tc animate-box" data-animate-effect="fadeIn">
							<h1>Keep it simple</h1>
							<h2>Free html5 templates Made by <a href="http://gettemplates.co" target="_blank">gettemplates.co</a></h2>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
