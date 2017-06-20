<?php 
//Some informations fave been hard codded for form validation
function get_logs() {
		$config['config_id']='logs';
		$config['table_name']='log';
	   	$config['table_id']='log_id';
	   	$config['table_active_field']='log_active';//to detect deleted records
	   	$config['reference_title']='Logs';
	   	$config['reference_title_min']='Log';
	   	
	   	//list view
	   	$config['order_by']='log_id DESC '; //mettre la valeur à mettre dans la requette
	   //	$config['search_by']='log_user_id';// separer les champs par virgule
	   	
	 
	   	
	   	$fields['log_id']=array(
				'field_title'=>'#',
	   			'field_type'=>'int',
				'field_size'=>11,
	   			'field_value'=>'auto_increment',
				'default_value'=>'auto_increment'
				
	   	);
	   	
	   	
	   	$fields['log_type']=array(
	   			'field_title'=>'Name',
	   			'field_type'=>'text',				
				'field_size'=>50,  	   			
				'input_type'=>'text', 
				'mandatory'=>' mandatory ' 
	   	);
	   	$fields['log_user_id']=array(
	   			'field_title'=>'Utilisateur',
	   			'field_type'=>'number',
				'field_size'=>11,
				'default_value'=>1,
				
	   			'field_value'=>active_user_id(),
	   			
	   			'input_type'=>'select',
	   			'input_select_source'=>'table',
	   			'input_select_values'=>'users;user_name',
				'mandatory'=>' mandatory ',
	   	);
		
	   	$fields['log_event']=array(
	   			'field_title'=>'Evenement',
	   			'field_type'=>'text',				
				'field_size'=>200,  	   			
				'input_type'=>'text', 
				'mandatory'=>' mandatory '
	   	);	
		$fields['log_time']=array(
	   			'field_title'=>'Time',
	   			'field_title'=>'Creation time',
	   			'field_type'=>'time',
	   			//'input_type'=>'text',
				'default_value'=>'CURRENT_TIMESTAMP',
	   			'field_value'=>bm_current_time('Y-m-d H:i:s'),	   			
	   			'field_size'=>20,
	   			'mandatory'=>' mandatory ',
	   	);	
		$fields['log_publish']=array(
	   			'field_title'=>'Publish',
	   			'field_type'=>'int',
	   			'field_size'=>'1',
	   			'field_value'=>'1',
				'default_value'=>'1',
				'input_type'=>'select',
				'input_select_source'=>'yes_no',
				'input_select_values'=>'1',
				
	   	);
		$fields['log_ip_address']=array(
	   			'field_title'=>'IP',
	   			'field_type'=>'text',				
				'field_size'=>200,  	   			
				'input_type'=>'text', 
	   	);	
		
	   
		
	   	$fields['log_active']=array(
	   			'field_title'=>'Active',
	   			'field_type'=>'int',
	   			'field_size'=>'1',
	   			'field_value'=>'1',
				'default_value'=>'1'
	   	);
	   	$config['fields']=$fields;
	   	
		$operations['add_logs']=array(
			'operation_type'=>'Add',
			'operation_title'=>'Add log',	
			'operation_description'=>'Add log',	
			'page_title'=>'Add log',			
			'save_function'=>'op/save_element',
			'page_template'=>'general/frm_entity',
			'redirect_after_save'=>'home',
			'db_save_model'=>'add_logs',
				
			'generate_stored_procedure'=>True,
					
			'fields'=>array(
					'log_id'=>array('mandatory'=>'','field_state'=>'hidden'),
					'log_type'=>array('mandatory'=>'','field_state'=>'hidden'),
					'log_user_id'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
					'log_event'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
					'log_ip_address'=>array('mandatory'=>'','field_state'=>'enabled')
									
					),
				
				'top_links'=>array(
							
							'close'=>array(
										'label'=>'',
										'title'=>'Close',
										'icon'=>'close',
										'url'=>'home',
									)
				
				),
			
		);
		
		$operations['detail_logs']=array(
				'operation_type'=>'Detail',
				'operation_title'=>'Detail of a log',
				'operation_description'=>'Detail of a log',
				'page_title'=>'Log ',
				
				
				'data_source'=>'get_detail_logs',
				'generate_stored_procedure'=>True,
					
				'fields'=>array(
						'log_type'=>array(),
						'log_user_id'=>array(),
						'log_event'=>array(),
						'log_time'=>array(),
						'log_ip_address'=>array()
							
				),
				
				
				'top_links'=>array(
							
						'back'=>array(
										'label'=>'',
										'title'=>'Close',
										'icon'=>'add',
										'url'=>'home',
									),
								
						
				
				),
		);
		
		$operations['list_logs']=array(
				'operation_type'=>'List',
				'operation_title'=>'List logs',
				'operation_description'=>'List logs',
				'page_title'=>'List of users',
				
				//'page_template'=>'list',
				
				'data_source'=>'get_list_logs',
				'generate_stored_procedure'=>True,
					
				'fields'=>array(
						'log_id'=>array(),
						'log_user_id'=>array(),
						'log_type'=>array(),
						'log_event'=>array(),
						'log_time'=>array(),
							
				),
				'order_by'=>'log_id DESC ', 
				'search_by'=>'log_type,log_event',
			
				'list_links'=>array(
						'view'=>array(
									'label'=>'View',
									'title'=>'Disaly element',
									'icon'=>'folder',
									'url'=>'op/display_element/detail_logs/',
								)
												
				),
				
				'top_links'=>array(
							
							'close'=>array(
										'label'=>'',
										'title'=>'Close',
										'icon'=>'add',
										'url'=>'home',
									)
				
				),
		);
		
		$config['operations']=$operations;
	
	return $config;
	
}