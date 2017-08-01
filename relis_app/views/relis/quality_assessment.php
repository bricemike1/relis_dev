	<!-- Select2 -->
    <script src="<?php echo site_url();?>cside/vendors/select2/dist/js/select2.full.min.js"></script>
	<!-- page content -->
        <div class="right_col" role="main">
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
                if(!empty($qa_list)){
                 $tmpl = array (
                 				'heading_cell_start'    => '<td>',
                 				'heading_cell_end'      => '</td>',
		                		'table_open'  => '<table class="table  table-hover">',
		                		'table_close'  => '</table>'
		                );
           //   print_test($qa_list)  ;
              $i=1;
                foreach ($qa_list as $k_assign => $v_assign) {
                	//echo"<div id='paper_".$v_assign['paper_id']."'>";
                	echo"<a name='paper_".$v_assign['paper_id']."'></a>";
                	echo box_header($i." : ".anchor('relis/manager/display_paper_screen/'.$v_assign['paper_id'],'<u>'.$v_assign['title'].'</u>'."(".$v_assign['q_result_score'].")"),'',12,12,12);
                	$questions=array( );
                	foreach ($v_assign['questions'] as $key_q => $q) {
                		
                		$responses="";
                		foreach ($q['responses'] as $key_response => $response) {
                			$but="";
                			if(!empty($response['link'])){
                				$but=create_button ( $response['response']['response'], $response['link'],$response['response']['response'],' btn-default');
                			}else{
                				$but=create_button ( $response['response']['response'], '',$response['response']['response']);
                				
                			}
                			
                		//	$responses.=$but." | ".$response['response']['response'];
                			$responses.=$but;
                			 
                		}
                		
                		$questions[$key_q]=array($q['question']['question']."<br/><div class='droite'>".$responses."</div>");
                	}
                //	print_test($questions);
                	If(!empty($questions)){
	                	$this->table->set_template($tmpl);
	                	echo $this->table->generate($questions);
	                	
                	}else{
                		echo "No questions created ! ";
                	}
                			echo  box_footer();
                	$i++;
                	//echo"</div>";
                }	
		
		          
                }
                ?>  
            	
                  
                  
                  
                
                  </div>
                 
                  </div>
                  
                 </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->