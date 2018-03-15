

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Fit4Site</b><?php echo $this->uri->segment (2);?>
        </div>
        <strong>Copyright &copy; 2017-2018 <a href="<?php echo base_url(); ?>">Fit4Site</a>.</strong> All rights reserved.
    </footer>

    <!-- jQuery UI 1.11.2 -->
    <!-- <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script> -->
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/dist/js/app.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.validate.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/validation.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery-te-1.4.0.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
        <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" type="text/javascript"></script>

    <script type="text/javascript">
        var windowURL = window.location.href;
        pageURL = windowURL.substring(0, windowURL.lastIndexOf('/'));
        var x= $('a[href="'+pageURL+'"]');
            x.addClass('active');
            x.parent().addClass('active');
        var y= $('a[href="'+windowURL+'"]');
            y.addClass('active');
            y.parent().addClass('active');







            jQuery(document).on('change', '.btn-file :file', function() {
          		var input = $(this),
          			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
          		input.trigger('fileselect', [label]);
          		});

          		jQuery('.btn-file :file').on('fileselect', function(event, label) {

          		    var input = $(this).parents('.input-group').find(':text'),
          		        log = label;

          		    if( input.length ) {
          		        input.val(log);
          		    } else {
          		        if( log ) alert(log);
          		    }

          		});
          		function readURL(input) {
          		    if (input.files && input.files[0]) {
          		        var reader = new FileReader();

          		        reader.onload = function (e) {
          		            jQuery('#img-upload').attr('src', e.target.result);
          		        }

          		        reader.readAsDataURL(input.files[0]);
          		    }
          		}

          		jQuery("#imgInp").change(function(){
          		    readURL(this);
          		});

              jQuery('#onlineoffline').on("click",function(e){
            				e.preventDefault();

                jQuery("#frmstatus").submit(function(){
                     alert("Submitted");
                 });
            	});
    </script>
    <script type="text/javascript">
           $(function() {
               // Replace the <textarea id="editor1"> with a CKEditor
               // instance, using default configuration.
               CKEDITOR.replace('editor1');
               //bootstrap WYSIHTML5 - text editor
               $(".textarea").wysihtml5();

           });
       </script>
  </body>
</html>
