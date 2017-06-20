<?php 
function get_str_mng() {
	
		$config['config_id']='str_mng';
		$config['table_name']='str_management';
	   	$config['table_id']='str_id';
	   	$config['table_active_field']='str_active';//to detect deleted records
	   	$config['reference_title']='String management';
	   	$config['reference_title_min']='String management';
	   	
	   	//list view
	   	$config['order_by']='str_text ASC '; //mettre la valeur à mettre dans la requette
	   	$config['search_by']='str_text';// separer les champs par virgule
	   	
	 //  	$config['links']['add_child']="users/user_usergroup;Add user";

	   
	   	/*$config['links']['edit']=array(
	   			'label'=>'Edit',
	   			'title'=>'Edit string',
	   			'on_list'=>True,
	   			'on_view'=>True
	   	);
	   	
	   	$config['links']['view']=array(
	   			'label'=>'View',
	   			'title'=>'View',
	   			'on_list'=>True,
	   			'on_view'=>True
	   	);
	   	
	   	$config['links']['delete']=array(
	   			'label'=>'Delete',
	   			'title'=>'Delete',
	   			'on_list'=>True,
	   			'on_view'=>True
	   	);*/
	   	$fields['str_id']=array(
	   			'field_title'=>'#',
	   			'field_type'=>'int',
				'field_size'=>11,
	   			'field_value'=>'auto_increment',
				'default_value'=>'auto_increment'
	   	);
	   	
	   	
	   	$fields['str_label']=array(
	   			'field_title'=>'Label',
	   			'field_type'=>'text',				
				'field_size'=>400,  	   			
				'input_type'=>'text', 
				'mandatory'=>' mandatory ' 
	   	);
	   	$fields['str_text']=array(
	   			'field_title'=>'Text',
	   			'field_type'=>'text',				
				'field_size'=>800,  	   			
				'input_type'=>'text', 
				'mandatory'=>' mandatory ' 
	   	);
		$fields['str_lang']=array(
	   			'field_title'=>'Language',
				'field_value'=>'en',
				'default_value'=>'en',
	   			'field_type'=>'text',				
				'field_size'=>3,  	   			
				'input_type'=>'text', 
				'mandatory'=>' mandatory ' 
	   	);
		
	   $fields['str_category']=array(
	   			'field_title'=>'Category',
				'field_value'=>'default',
				'default_value'=>'default',
	   			'field_type'=>'text',				
				'field_size'=>18,  	   			
				'input_type'=>'text', 
				'mandatory'=>' mandatory ' 
	   	);
	   
	   	
	   	$fields['str_active']=array(
	   			'field_title'=>'Active',
	   			'field_type'=>'int',
	   			'field_size'=>'1',
	   			'field_value'=>'1',
				'default_value'=>'1'
	   	);
	   	$config['fields']=$fields;
	   	
		$operations['add_str_mng']=array(
			'operation_type'=>'Add',
			'operation_title'=>'Add string',	
			'operation_description'=>'Add string',	
			'page_title'=>'Add string',			
			'save_function'=>'op/save_element',
			'page_template'=>'general/frm_entity',
			'redirect_after_save'=>'home',
			'db_save_model'=>'add_str_mng',
				
			'generate_stored_procedure'=>True,
					
			'fields'=>array(
					'str_id'=>array('mandatory'=>'','field_state'=>'hidden'),
					'str_label'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
					'str_text'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
					'str_lang'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
					'str_category'=>array('mandatory'=>'','field_state'=>'hidden')
									
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
		
		$operations['detail_str_mng']=array(
				'operation_type'=>'Detail',
				'operation_title'=>'Detail of a string',
				'operation_description'=>'Detail of a string',
				'page_title'=>'Log ',
				
				
				'data_source'=>'get_detail_str_mng',
				'generate_stored_procedure'=>True,
					
				'fields'=>array(
						'str_label'=>array(),
						'str_text'=>array(),
						'str_lang'=>array(),
						'str_category'=>array()
							
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
		
		$operations['list_str_mng']=array(
				'operation_type'=>'List',
				'operation_title'=>'List logs',
				'operation_description'=>'List logs',
				'page_title'=>'List of users',
				
				//'page_template'=>'list',
				
				'data_source'=>'get_list_str_mng',
				'generate_stored_procedure'=>True,
					
				'fields'=>array(
						'str_id'=>array(),
						'str_label'=>array(),
						'str_text'=>array(),
						'str_lang'=>array(),
							
				),
				'order_by'=>'str_label DESC ', 
				'search_by'=>'str_label,str_text',
			
				'list_links'=>array(
						'view'=>array(
									'label'=>'View',
									'title'=>'Disaly element',
									'icon'=>'folder',
									'url'=>'op/display_element/detail_str_mng/',
								)
												
				),
				'conditions'=>array('active_lang'=>array(
												'field'=>'str_lang',
												'value'=>active_language(),
												'evaluation'=>'',
												'add_on_generation'=>False,
												'parameter_type'=>'VARCHAR(3)'
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