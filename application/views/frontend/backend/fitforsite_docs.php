<div class="container" style="clear:both;">
      <h1 class="my-4 text-center text-lg-left"></h1>
  <div class="row text-center text-lg-left">
<?php

if(!empty($galleries)){

foreach($galleries as $key => $gallery){?>
  <div class="row" id="profile-gallery">
	<div class="page-header">
		<h1 contenteditable="true" onkeyup="updateInformation('title','<?php echo $gallery->id;?>',this);"><?php echo $gallery->title;?></h1>
	</div>
	<!--End of Page Header-->
	<p contenteditable="true" onkeyup="updateInformation('description','<?php echo $gallery->id;?>',this);"><?php echo $gallery->description;?></p>

	<?php foreach($gallery->gallery_files as $gfiles){ ?>
		<?php if($gfiles->image_type=='image/jpeg' || $gfiles->image_type=='image/gif' || $gfiles->image_type=='image/jpg' || $gfiles->image_type=='image/png'){?>
		  <div class="col-lg-4 col-md-4 col-xs-6">
			<div class="item-box" id="box<?php echo $gfiles->id;?>">
			<a href="<?php echo base_url();?>uploads/docs/<?php echo $gfiles->filename;?>" target="_blank" >
			<div class="image" style="background-image:url(<?php echo base_url();?>uploads/docs/<?php echo $gfiles->filename;?>)">
			</div>
			</a>
			<span class="d-block mb-4 h-100 delete" data-file_id="<?php echo $gfiles->id;?>" onclick="remove(this.getAttribute('data-file_id'));">&times;</span>
			</div>


			<!--End of Item Box-->
		  </div>
		<?php } ?>

      <?php if($gfiles->image_type=='application/pdf'){?>
		 <div class="col-lg-4 col-md-4 col-xs-6">
			<div class="item-box" id="box<?php echo $gfiles->id;?>">
				<a href="<?php echo base_url();?>uploads/docs/<?php echo $gfiles->filename;?>" target="_blank" >
				<div class="image" style="background-image:url(<?php echo base_url();?>assets/filetypimages/pdf.png)"></div>
				</a>
				<span class="d-block mb-4 h-100 delete"  data-file_id="<?php echo $gfiles->id;?>" onclick="remove(this.getAttribute('data-file_id'));">&times;</span>
			</div>
			<!--End of Item Box-->
		 </div>
    <?php } ?>


    <?php if($gfiles->image_type=='application/msword'){?>

		<div class="col-lg-4 col-md-4 col-xs-6">
			<div class="item-box" id="box<?php echo $gfiles->id;?>">
				<a href="<?php echo base_url();?>uploads/docs/<?php echo $gfiles->filename;?>" target="_blank">
				<div class="image" style="background-image:url(<?php echo base_url();?>assets/filetypimages/doc.png)"></div>
				</a>
				<span class="d-block mb-4 h-100 delete"  data-file_id="<?php echo $gfiles->id;?>" onclick="remove(this.getAttribute('data-file_id'));">&times;</span>
			</div>
			<!--End of Item Box-->
		 </div>

  <?php } ?>


	<?php } //End of Foreach Loop ?>

</div> <!--End of row-->

<br/>

<div class="row" style="background: #81cbf6;padding: 15px;border-radius: 3px;">
	<div class="col-md-12"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal<?php echo $gallery->id;?>" >Add New File <i class="fa fa-plus-square"></i></button></div>
</div>

<br/>
<br/>


<!-- Modal Start -->
  <!-- Modal -->
  <div class="modal fade" id="myModal<?php echo $gallery->id;?>" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Upload File</h4>
        </div>
        <div class="modal-body">
          <form action="<?php echo base_url();?>backend/profile/uploadMultiFile" method="POST" enctype="multipart/form-data">
          <div class="form-group"><input type="file" name="mediafile[]" multiple ></div>
          <input type="hidden" name="doc_id" value="<?php echo $gallery->id;?>" />
          <button type="submit" class="btn btn-primary" >Upload</button>
        </form>
        </div>
        <div class="modal-footer">

        </div>
      </div>

    </div>
  </div>
  <!-- End of the modal-->

<?php
}
//pre($galleries);
}else{
  echo "<h3>Gallery not found </h3>";
}
?>
  </div>

</div>
<!-- Button to trigger modal -->

<!-- Modal -->

<script type="text/javascript">
    function updateInformation(contenttype,gid,e){
    var http = new XMLHttpRequest();
    var params = '';
    if(contenttype=='title'){
      var TextInsideLi = e.textContent;
      var params = "title="+TextInsideLi+"&gallery_id="+gid;
    }
    if(contenttype=='description'){
        var TextInsideLi = e.textContent;
        var params = "content="+TextInsideLi+"&gallery_id="+gid;
    }
    var url = "<?php echo base_url();?>backend/profile/updateF4SGalleryInformation";
    http.open("POST", url, true);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.onreadystatechange = function() {//Call a function when the state changes.
        if(http.readyState == 4 && http.status == 200) {
            //console.log(http.responseText);
        }
    }
    http.send(params);
    }

    function remove(ele)
    {
      var http = new XMLHttpRequest();
      var params = 'file_id='+ele;
          if(ele!='' && ele!='undefined'){
            var url = "<?php echo base_url();?>backend/profile/removeGalleryFiles";
            http.open("POST", url, true);
            http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            http.onreadystatechange = function() {
                if(http.readyState == 4 && http.status == 200) {
                    var elem = document.getElementById("box"+ele);
                        elem.parentElement.removeChild(elem);
                    //document.getElementById("box"+http.responseText).remove();
                }
            }
            http.send(params);
          }
    }
</script>
