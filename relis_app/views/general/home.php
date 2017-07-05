	<!-- page content -->
        <div class="right_col" role="main">
        <!-- gauge.js -->
    <script src="<?php echo site_url();?>cside/vendors/bernii/gauge.js/dist/gauge.min.js"></script>
     
        <?php top_msg();  ?> 
        
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">

                <div class="row x_title">
                 <?php  header_perspective();?>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12 bg-white">
                  <div class="x_title">
                    <h3> <?php echo lng('Project').' : '.$configuration['project_title'] ?> - Classification</h3>
                    <div class="clearfix"></div>
                  </div>

                  <div class="col-md-8 col-sm-8 col-xs-6">
                    
                      <p style="text-align: justify"><b><?php echo lng('Description')?>:</b><br/>
                      <?php echo $configuration['project_description'] ?>
                      </p>
                      
                   
                  </div>
                   <?php 
                            $creator=array();
                            foreach ($users as $k => $v) {
                            	if($v['user_id']==$configuration['project_creator']){
                            	$creator=$v;
                            	}
                            }
                  if(!empty($creator)) {
                            $images_creator=site_url()."cside/images/img.jpg";
                             
                            if(!empty($creator['user_picture'])){
                            	$user_picture=$creator['user_picture'];
                            
                            	//$images_creator=site_url().$this->config->item('image_upload_path').$user_picture."_thumb.jpg";
                            	$images_creator=display_picture_from_db($creator['user_picture']);
                            }
                            
                            ?>
                
                <div class="col-md-4 col-sm-4 col-xs-12">
	                <div class="col-md-12 col-sm-12 col-xs-12 profile_details">
	                        <div class=" col-sm-12 well profile_view">
	                          <div class="col-sm-12">
	                            <h4 class="brief"><i><?php echo lng('Designer')?></i></h4>
	                           
	                            <div class="left col-xs-7">
	                              <h2><?php echo $creator['user_name']?></h2>
	                              
	                              <ul class="list-unstyled">
	                                <li><i class="fa fa-comments-o"></i> Email: <?php echo $creator['user_mail']?></li>
	                               
	                              </ul>
	                            </div> 
	                            <div class="right col-xs-5 text-center">
	                              <img  src="<?php echo $images_creator?>" alt="" class="img-circle img-responsive" width="100" height="100" >
	                            </div>
	                          </div>
	                          <div class="col-xs-12 bottom text-center">
	                            <div class="col-xs-12 col-sm-6 emphasis">
	                              
	                            </div>
	                            <div class="col-xs-12 col-sm-6 emphasis">
	                              
	                              <a href="op/display_element/detail_user_min/<?php echo $creator['user_id']?>"><button type="button" class="btn btn-primary btn-xs">
	                                <i class="fa fa-user"> </i> View Profile
	                              </button></a>
	                            </div>
	                          </div>
	                       </div>
	               </div>
               </div>
          <?php }?>
                  
                </div>
                

                <div class="clearfix"></div>
              </div>
            </div>

          </div>
          
          
          <br />
         
        
            
           <div class="row">
            
            <?php 
            if(!empty($classification_completion))
            add_completion_gauge($classification_completion,'id_completion');
            
            
            ?>
           
         </div>
        
        </div>
        