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
                  
                  
                  
                  <div class="x_content" style="min-height:1000px ">
                  <p class="lead"><?php echo lng('Match csv fields')?> </p>
                           <form class="form-horizontal" method="post" action="../../relis/manager/import_papers_save_csv" enctype="multipart/form-data">
                        <?php 
                         
                       
                        echo dropdown_form_bm('Paper title *','paper_title','paper_title',$csv_fields);
                        echo dropdown_form_bm('Link','paper_link','paper_link',$csv_fields_opt,'zz');
                        echo dropdown_form_bm('Abstract','paper_abstract','paper_abstract',$csv_fields_opt,'zz');
                        echo dropdown_form_bm('Key words','paper_key','paper_key',$csv_fields_opt,'zz');
                        echo dropdown_form_bm('Authors','paper_author','paper_author',$csv_fields_opt,'zz');
                        echo input_form_bm('Start import from row ','paper_start_from','paper_start_from','2');
                        echo form_hidden(array( 'data_array' => isset($json_values)?$json_values:''));
                     
                     ?>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                          
                          <button class="btn btn-success">Save</button>
                        </div>
                      </div>
                    
                    
                    </form>
                    
                  <p class="lead">Preview of the uploaded csv file</p>
                         
                          
                          <?php  
                           
		                    $tmpl = array (
		                    		'table_open'  => '<table class="table table-striped table-hover">',
		                    		'table_close'  => '</table>'
		                    );
		                  
		                    $this->table->set_template($tmpl);
		                   echo $this->table->generate($csv_papers);       
                          // print_test($csv_papers)?>
                 
                   
                   
                  </div>
                  
                  
                  
                  
                  
                  
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->