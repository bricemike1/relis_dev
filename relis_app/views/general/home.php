	<!-- page content -->
        <div class="right_col" role="main">
        
        <?php top_msg();  ?> 
        
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">

                <div class="row x_title">
                 <?php  header_perspective();?>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12 bg-white">
                  <div class="x_title">
                    <h3> <?php echo lng('Project').' : '.$configuration['project_title'] ?></h3>
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
	                              
	                              <a href="../manager/display_element/users/<?php echo $creator['user_id']?>"><button type="button" class="btn btn-primary btn-xs">
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
         
         
         	<div class="col-md-6 col-sm-6 col-xs-12">
              <div class="x_panel tile  overflow_hidden">
                <div class="x_title">
                  <h2><?php echo lng('Classification completion')?></h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                
                
                
                <!-- top tiles -->
          <div class="row tile_count centre">
            <div class="col-md-4 col-sm-4 col-xs-12 tile_stats_count">
              <span class="count_top"><i class="fa fa-list"></i> <?php echo lng('All papers')?></span>
            
               <?php echo anchor('relis/manager/list_paper',' <div class="count ">'.nombre($all_papers).'</div>')?>
             
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12 tile_stats_count green">
              <span class="count_top"><i class="fa fa-check-circle-o"></i> <?php echo lng('Processed papers')?></span>
              
              <?php echo anchor('relis/manager/list_paper/processed',' <div class="count green">'.nombre($processed_papers).'</div>')?>
             
             
              
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12 tile_stats_count">
              <span class="count_top"><i class="fa fa-clock-o"></i> <?php echo lng('Pending papers')?></span>
              <?php echo anchor('relis/manager/list_paper/pending',' <div class="count ">'.nombre($pending_papers).'</div>')?>
             
              
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
           
			<div class="sidebar-widget">
                       <?php
			            if($processed_papers > 0){
			            ?>
                      <canvas  id="foo" class="" ></canvas>
                      <div class="goal-wrapper">
                        <span class="gauge-value pull-left"></span>
                        <span id="gauge-text" class="gauge-value pull-left"><?php echo $processed_papers?></span>
                        <span id="goal-text" class="goal-value pull-right"><?php echo nombre($processed_papers + $pending_papers)?></span>
                      </div>
                      <?php }?>
             </div>
             </div>
           
          </div>
        
          <!-- /top tiles -->
                
                
                
                
                 
                </div>
              </div>
            </div>
            
            
            
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="x_panel tile  overflow_hidden">
                <div class="x_title">
                  <h2><?php echo lng('Participants')?></h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                
                
                	<?php 
                  foreach ($users as $key => $value) {
                  	
                  	$images=site_url()."cside/images/img.jpg";
                  	
                  	if(!empty($value['user_picture'])){
                  		$user_picture=$value['user_picture'];
                  		
                  		//$images=site_url().$this->config->item('image_upload_path').$user_picture."_thumb.jpg";
                  		
                  		$images=display_picture_from_db($user_picture);
                  	}
                  ?>
                  
                  
                  
                   <div class="col-md-12 col-sm-12 col-xs-12 profile_details">
                        <div class=" col-sm-12 well profile_view">
                          <div class="col-sm-12">
                            <h4 class="briefs"><i><?php echo $value['usergroup_name']." ".lng('user')?></i></h4>
                            <div class="left col-xs-7">
                              <h2><?php echo $value['user_name']?></h2>
                              
                              <ul class="list-unstyled">
                                <li><i class="fa fa-comments-o"></i> Email: <?php echo $value['user_mail']?></li>
                               
                              </ul>
                            </div> 
                            <div class="right col-xs-5 text-center">
                              <img  src="<?php echo $images?>" alt="" class="img-circle img-responsive" width="100" height="100" >
                            </div>
                          </div>
                          <div class="col-xs-12 bottom text-center">
                            <div class="col-xs-12 col-sm-6 emphasis">
                              
                            </div>
                            <?php if (has_usergroup(1)){?>
                            <div class="col-xs-12 col-sm-6 emphasis">
                              
                              <a href="../manager/display_element/users/<?php echo $value['user_id']?>"><button type="button" class="btn btn-primary btn-xs">
                                <i class="fa fa-user"> </i> View Profile
                              </button></a>
                            </div>
                            <?php }?>
                          </div>
                        </div>
                      </div>
                  
                 <?php 
					}
					?> 
                
                </div>
              </div>
            </div>
         
         
         
         </div>
        
        </div>
        </script>
       <!-- gauge.js -->
    <script src="<?php echo site_url();?>cside/vendors/bernii/gauge.js/dist/gauge.min.js"></script>
    
    <!-- gauge.js -->
    <script>
      var opts = {
          lines: 12,
          angle: 0,
          lineWidth: 0.4,
          pointer: {
              length: 0.75,
              strokeWidth: 0.042,
              color: '#1D212A'
          },
          limitMax: 'false',
          colorStart: '#1ABC9C',
          colorStop: '#1ABC9C',
          strokeColor: '#F0F3F3',
          generateGradient: true
      };
      var target = document.getElementById('foo'),
          gauge = new Gauge(target).setOptions(opts);

      gauge.maxValue = <?php echo $processed_papers + $pending_papers?>;
      gauge.animationSpeed = 32;
      gauge.set(<?php echo $processed_papers?>);
      gauge.setTextField(document.getElementById("gauge-text"));
    </script>
    <!-- /gauge.js -->
        <!-- /page content -->