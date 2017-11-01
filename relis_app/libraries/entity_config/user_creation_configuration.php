<?php 
function get_user_creation() {
		$config['config_id']='user_creation';
		$config['table_name']='user_creation';
	   	$config['table_id']='user_creation_id';
	   	$config['table_active_field']='user_creation_active';
	   	$config['reference_title']='Creation';
	   	$config['reference_title_min']='Creation';
	   	
	   	//list view
	   	$config['order_by']='user_creation_id ASC '; 
	   	
	 
	   	
	   	$fields['user_creation_id']=array(
				'field_title'=>'#',
	   			'field_type'=>'int',
				'field_size'=>11,
	   			'field_value'=>'auto_increment',
				'default_value'=>'auto_increment'
				
	   	);
	   	
	   	$fields['creation_user_id']=array(
	   			'field_title'=>'User',
	   			'field_type'=>'number',
				'field_size'=>11,
				'default_value'=>1,
				
	   			//'field_value'=>active_user_id(),
	   			
	   			'input_type'=>'select',
	   			'input_select_source'=>'table',
	   			'input_select_values'=>'users;user_name',
				'mandatory'=>' mandatory ',
	   	);
	   	$fields['confirmation_code']=array(
	   			'field_title'=>'Confirmationcode',
	   			'field_type'=>'text',				
				'field_size'=>50,  	   			
				'input_type'=>'text', 
				'mandatory'=>' mandatory ' 
	   	);
		
		$fields['confirmation_expiration']=array(
	   			'field_title'=>'Confirmation code',
	   			'field_type'=>'int',				
				'field_size'=>10,  	   			
				'input_type'=>'text', 
				'mandatory'=>' mandatory ' 
	   	);
		$fields['confirmation_try']=array(
	   			'field_title'=>'Number of validation attempt',
	   			'field_type'=>'int',				
				'field_size'=>10,  	   			
				'input_type'=>'text', 
				'mandatory'=>' mandatory ' 
	   	);
		
	   	$fields['user_creation_active']=array(
	   			'field_title'=>'Active',
	   			'field_type'=>'int',
	   			'field_size'=>'1',
	   			'field_value'=>'1',
				'default_value'=>'1'
	   	);
	   	$config['fields']=$fields;
	   	
		$operations['add_user_creation']=array(
			'operation_type'=>'Add',
			'page_title'=>'Add log',			
			'save_function'=>'op/save_element',
			'page_template'=>'general/frm_entity',
			'redirect_after_save'=>'home',
			'db_save_model'=>'add_user_creation',
				
			'generate_stored_procedure'=>True,
					
			'fields'=>array(
					'user_creation_id'=>array('mandatory'=>'','field_state'=>'hidden'),
					'creation_user_id'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
					'confirmation_code'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
					'confirmation_try'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
					'confirmation_expiration'=>array('mandatory'=>'mandatory','field_state'=>'enabled')
									
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
		
		$operations['detail_creation']=array(
				'operation_type'=>'Detail',
				'page_title'=>'User creation ',
				
				
				'data_source'=>'get_detail_user_creation',
				'generate_stored_procedure'=>True,
					
				'fields'=>array(
						'creation_user_id'=>array(),
						'confirmation_code'=>array(),
						'confirmation_expiration'=>array(),
						'confirmation_try'=>array()
							
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
		
		$config['operations']=$operations;
	
	return $config;
	
}