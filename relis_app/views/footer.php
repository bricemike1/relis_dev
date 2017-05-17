<!-- footer content -->

 <!-- Large modal -->
               
                  <div class="modal fade bs-example-modal-lg" id="relisformModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Edition</h4>
                        </div>
                        <div class="modal-body">
                          <h4>Loading  ...</h4>
                         	
                        </div>
                        <!-- 
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary">Save changes</button>
                        </div
                         -->
                      </div>
                    </div>
                  </div>
                  
                  
                   <!-- info  : http://v4-alpha.getbootstrap.com/components/modal/ -->
                  
                  <script>


                  $('#relisformModal').on('show.bs.modal', function (event) {
                	   var modal = $(this);
                	//  modal.find('.modal-title').html('New message to ' + paper_id)
					var button = $(event.relatedTarget)
					var modal_link = button.data('modal_link')
					var modal_title = button.data('modal_title')
					var operation_type = button.data('operation_type')
					var form_link="";
					
					 form_link="<?php echo base_url()?>" + modal_link
					 modal.find('.modal-title').html(modal_title)
					
              		$.ajax({
              			  url: form_link ,
              			  beforeSend: function( xhr ) {
              			    xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
              			  }
              			})
              			  .done(function( data ) {
              				modal.find('.modal-body').html(data);
              				  
                   			  //alert(data);
              			    
              			  });


                  	
                	 
                	})
                	
                	
                	$('#relisformModal').on('hidden.bs.modal', function () {
                		location.reload(); 
					})
                  
                  </script>


        <footer>
          <div class="pull-right">
          <?php echo lng('ReLiS - Revue Littéraire Systématique');?>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
	 <link href="<?php echo site_url();?>cside/vendors/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" media="screen">
	 <link href="<?php echo site_url();?>cside/vendors/bootstrap-colorpicker/css/bootstrap-colorpicker.css" rel="stylesheet" media="screen">
    
    <!-- FastClick -->
    <script src="<?php echo site_url();?>cside/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo site_url();?>cside/vendors/nprogress/nprogress.js"></script>
    <!-- Switchery -->
  	<script src="<?php echo site_url();?>cside/vendors/switchery/dist/switchery.min.js"></script>
  	<!-- iCheck -->
    <script src="<?php echo site_url();?>cside/vendors/iCheck/icheck.min.js"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="<?php echo site_url();?>cside/js/custom.js"></script>
    
    <?php if (isset($has_graph))
			{
			
			?>
	
	<script src="<?php echo site_url(); ?>cside/js/highcharts.js"></script>
	<script src="<?php echo site_url(); ?>cside/js/exporting.js"></script>
	
	<?php }?>
	<!-- bootstrap-datepicker -->
     <script src="<?php echo site_url();?>cside/vendors/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
     <!-- bootstrap-datepicker -->
     
     
	<!-- bootstrap-colorpicker -->
     <script src="<?php echo site_url();?>cside/vendors/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
     <!-- bootstrap-colorpicker -->
     
     <!-- PNotify -->
    <script src="<?php echo site_url();?>cside/vendors/pnotify/dist/pnotify.js"></script>
    <script src="<?php echo site_url();?>cside/vendors/pnotify/dist/pnotify.buttons.js"></script>
    <script src="<?php echo site_url();?>cside/vendors/pnotify/dist/pnotify.nonblock.js"></script>
     
      <!-- Datatables -->
    <script src="<?php echo site_url();?>cside/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo site_url();?>cside/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo site_url();?>cside/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    
    <script src="<?php echo site_url();?>cside/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    
    <script src="<?php echo site_url();?>cside/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?php echo site_url();?>cside/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo site_url();?>cside/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="<?php echo site_url();?>cside/vendors/datatables.net-buttons/js/buttons.colVis"></script>
    <!-- /PNotify -->
    <script>
function get_screen_info(){
		
		var w = window,
	    d = document,
	    e = d.documentElement,
	    g = d.getElementsByTagName('body')[0],
	    x = w.innerWidth || e.clientWidth || g.clientWidth,
	    y = w.innerHeight|| e.clientHeight|| g.clientHeight;
		var loadTime = 0;   
	//alert(x + '  ' + y);
	var z_url= "<?php echo base_url();?>auth/add_screen_size/" + x + "/" + y + "/" + loadTime;
	$.get( z_url );

		}

      $(document).ready(function() {
    	  get_screen_info();
    	  $('.datepicker').datepicker({
			  format: 'yyyy-mm-dd',
			  clearBtn: true,
			  autoclose: true,
			  orientation: "auto right",
				todayBtn: true,
				todayHighlight: true
	});

    	 
        	   $('#color_p').colorpicker();

        	   $('#datatable-responsive').DataTable( {
        		   fixedHeader: true,
        		   "pageLength": <?php echo $this->config->item('rec_per_page') ?>,
        		   "scrollX": true,
        		   fixedColumns: true,
        		 
        		   
        	   } );

        	   $("#datatable-responsive").addClass("table-hover");

        	  
    	  
      });
    </script>
    
    
     <!-- Select2 -->
    <script>
      $(document).ready(function() {
        $(".select2_single").select2({
          placeholder: "<?php echo lng_min('Select')?> ...",
          allowClear: true
        });
        $(".select2_group").select2({});
        $(".select2_multiple").select2({
          
          placeholder: "<?php echo lng_min('Select multi')?> ...",
          
          allowClear: true
        });
      });
  
    <!-- /Select2 -->
    
    
    <!-- /bootstrap-daterangepicker -->
   

    function clear_function( parametter ){
		var obj = document.getElementById(parametter);
			obj.value=""
			//alert('maintenant il contient : "'+obj.value+'"')
		//alert(parametter);
	}
	
	function confirm_delete(msg='Remove record'){
		
		return result=confirm(msg);
	
		
	}

	  </script>
	

  </body>
</html>