<!-- START: FOOTER -->
<section id="footer">
	<footer>
		
		<div class="main-footer row">
			<div class="container clear-padding">
				<?php dynamic_sidebar( 'footer-section1' ); ?>							
				<div class="clearfix visible-sm-block"></div>
				<?php dynamic_sidebar( 'footer-section2' ); ?>	
                <?php dynamic_sidebar( 'footer-section3' ); ?>				
				<div class="clearfix"></div>
				<div class="col-md-12 text-center about-footer">
					<p>CheapFlightOFare is an independent travel portal with no third party association. By using CheapFlightOFare, you agree that CheapFlightOFare is not accountable for any loss - direct or indirect, arising of offers, materials or links to other sites found on this website. In case of queries, reach us directly at out Toll Free Number - 1-888-267-4385 or, simply email at support@cheapflightofare.com</p>
				</div>
				
				<div class="client-logos col-md-12">
                	<ul>
                	    <li class="arc"></li>
                		<a title="American Society of Travel Agents">
                        <li class="asta"></li></a>
                        <li class="true"></li>
                		<a title="Trustpilot">
                        <li class="trust"></li></a>
                        <a title="v-secure">
                		<li class="v-secure"></li></a>
                        <li class="pactSafe"></li>
                        		
                	</ul>
                </div>				

			</div>
		</div>
		<div class="main-footer-nav row">
			<div class="container clear-padding">
				<div class="col-md-6 col-sm-6">
					<p>Copyright &copy; 2017 CheapFlightOFare. All Rights Reserved.</p>
				</div>
				<div class="col-md-6 col-sm-6">
				<?php wp_nav_menu( array(
						'menu'           => 'footer-menu', 
						) );?>
				</div>
				<div class="go-up">
					<a href="#"><i class="fa fa-arrow-up"></i></a>
				</div>
			</div>
		</div>
	</footer>
</section>
<!-- END: FOOTER -->

</div>
<!-- END: SITE-WRAPPER -->
<!-- Load Scripts -->

<script>
	jQuery(document).ready(function($){
		
		var array = [];
		var items = [];
		$("input[name=Origin]").bind("keyup", function(){
			var keyToSearch = $("input[name=Origin]").val();
			if(keyToSearch.length >= 1){
				var url = 'https://intellisuggest.fareportal.com/api/IntelliSuggest/2.0/json/AutoSuggest/AIR%2FALL%2F'+keyToSearch+'?callback=?';
				 $.ajax({
					 url: url, 
					 dataType: "json",
					 async: false,
					 success: function(response){
            			var arr = response.Location;
						 for(i=0; i<arr.length; i++){
							//items.push(arr[i].Code);
							items.push(arr[i].Text);	
						}
						$('input[name=Origin').autocomplete({
										source: items,
										minLength: 0,
										scroll: true,
										autoFocus:true
										
						}).focus(function(){
								$(this).autocomplete("search", "");
						});

       				 }
				 });	
			}
			
		});

		var array1 = [];
		var items1 = [];
		$("input[name=Destination]").bind("keyup", function(){
			var keyToSearch = $("input[name=Destination]").val();
			if(keyToSearch.length >= 3){
					
				var url = 'https://intellisuggest.fareportal.com/api/IntelliSuggest/2.0/json/AutoSuggest/AIR%2FALL%2F'+keyToSearch+'?callback=?';
				$.ajax({
					 url: url, 
					 dataType: "json",
					 async: false,
					 success: function(response){
            			var arr1 = response.Location;
						 for(i=0; i<arr1.length; i++){
							//items.push(arr[i].Code);
							items1.push(arr1[i].Text);	
						}
						$('input[name=Destination').autocomplete({
											source: items1,
											minLength: 0,
											scroll: true,
											autoFocus:true
									}).focus(function(){
								$(this).autocomplete("search", "");
						});

       				 }
				 });
					
			}	
		});


		var tripval = $('#TypeOfTrip').val();

		if(tripval==='ROUNDTRIP'){

			$('#NoOfTrips').val(2);
			$('#NoOfTrips').attr('disabled','disabled');
		}
		if(tripval==='ONEWAYTRIP'){

			$('#NoOfTrips').val(1);
			$('#NoOfTrips').attr('disabled','disabled');
		}

		$("#TypeOfTrip").on('change',function(){
				//alert(this.value);
				if(this.value==='ROUNDTRIP'){

					$('#NoOfTrips').val(2);
					$('#NoOfTrips').attr('disabled','disabled');
				}
				if(this.value==='ONEWAYTRIP'){

					$('#NoOfTrips').val(1);
					$('#NoOfTrips').attr('disabled','disabled');
				}

		});
			
	});
</script>
<?php wp_footer(); ?>
</body>
</html>