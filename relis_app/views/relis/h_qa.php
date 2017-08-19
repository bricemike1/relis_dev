	<!-- page content -->
        <div class="right_col" role="main" >
         <!-- gauge.js -->
    <script src="<?php echo site_url();?>cside/vendors/bernii/gauge.js/dist/gauge.min.js"></script>
    
        <?php top_msg();  ?> 
        
        <div class="row" >
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">

                <div class="row x_title">
                 <?php  //header_perspective('screen');?>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12 bg-white">
                  <div class="x_title">
                    <h3> <?php echo lng('Project').' : '.$configuration['project_title'] ." - Quality assessment  "?> </h3>
                    <div class="clearfix"></div>
                  </div>

                  <div class="col-md-6 col-sm-6 col-xs-12">
                    
                      <p style="text-align: justify"><b><?php echo lng('Description')?>:</b><br/>
                      <?php echo $configuration['project_description'] ?>
                      </p>
                      
                   
                  </div>
                  
                
                </div>
                

                <div class="clearfix"></div>
              </div>
            </div>

          </div>
          
          
          <br />
          <div class="row">
            
            <?php 
            if(!empty($qa_completion))
            add_completion_gauge($qa_completion,'id_qa_completion');
            
             if(!empty($qa_completion_val))
            add_completion_gauge($qa_completion_val,'id_validation_completion');
           
            
            ?>
                 
       <!--  </div>
         <div class="row">
         -->     
            <?php 
            if(!empty($gen_qa_completion))
            add_completion_gauge($gen_qa_completion,'id_gen_screen_completion');
            
             if(!empty($gen_qa_completion_val))
            add_completion_gauge($gen_qa_completion_val,'id_gen_validation_completion');
           
            
            ?>
                 
         </div>
        </div>
        
        <!-- /page content -->