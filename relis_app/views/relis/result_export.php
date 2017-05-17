	<!-- Select2 -->
    <script src="<?php echo site_url();?>cside/vendors/select2/dist/js/select2.full.min.js"></script>
	<!-- page content -->
        <div class="right_col" role="main">
           <?php top_msg();    ?> 
          <div class="">
          
          <div class="page-title">
              
             
            </div>
            
            <div class="clearfix"></div>

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" >
                  <div class="x_title">
                     <?php  //header_perspective('screen');?>
                    <h2><?php echo isset($page_title) ? $page_title :"" ; ?></h2>
                    <?php 
                    if(isset($top_buttons)){
                    	echo "<ul class='nav navbar-right panel_toolbox'>$top_buttons</ul>";
                    
                    }                    
                    ?>
                    
                    
                    
                    <div class="clearfix"></div>
                  </div>
                  
                  
                  
                  <div class="x_content" style="min-height:400px ">
                  
                  
                  
                  <div class="row">
                  
                  
             
            
           <?php 
           $paper_filename=FCPATH."cside/export_r/export_paper_".project_db().".csv";
           $class_filename=FCPATH."cside/export_r/export_classification_".project_db().".csv";
           if(file_exists($paper_filename)){
           	$paper_size = (filesize($paper_filename)> 1000 ? round(filesize($paper_filename)/1000): round(filesize($paper_filename)/1000,1)).' Kb  Last update:';
           	 $paper_date = date("Y-m-d h:i:s", filemtime($paper_filename));
           
           $paper_dsc="<i class='fa fa-download'></i> Download csv (".$paper_size.$paper_date.")";
           
           }else{
           	
           	$paper_dsc="";
           } 
           
           if(file_exists($class_filename)){
           	$paper_size = (filesize($class_filename)>1000 ? round(filesize($class_filename)/1000): round(filesize($class_filename)/1000,1)).' Kb  Last update:';
           	$paper_date = date("Y-m-d h:i:s", filemtime($class_filename));
           	 
           	$class_dsc="<i class='fa fa-download'></i> Download csv (".$paper_size.$paper_date.")";
           	 
           }else{
           
           	$class_dsc="";
           }
			
           
           
           
           
           echo box_header("Result","",12,12,12);
           ?>
             <table class="table table-striped table-hover list_export_x" >
           
          
           <tr >
           <td>Classification</td><td><a href="<?php echo base_url();?>cside/export_r/export_classification_<?php echo project_db();?>.csv"><?php echo $class_dsc?></a></td><td><a href="<?php echo base_url();?>relis/manager/result_export_classification"><i class="fa fa-refresh"></i><?php echo lng('Update file')?></a></td><td></td>
           </tr>
           <tr >
           <td>Papers</td><td><a href="<?php echo base_url();?>cside/export_r/export_paper_<?php echo project_db();?>.csv"><?php echo  $paper_dsc?></a></td><td><a href="<?php echo base_url();?>relis/manager/result_export_papers"><i class="fa fa-refresh"></i><?php echo lng('Update file')?></a></td>
           </tr>
           
          
           </table>
            <?php 
           echo  box_footer();
            
           
           
           
           
           ?>
                  
                  
                  
                  </div>
                
                   </div>
                  
                  
                  
                  
                  
                  
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->