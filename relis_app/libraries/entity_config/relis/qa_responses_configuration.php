<?php 
function get_qa_responses() {
		$config['config_id']='qa_responses';
		$config['table_name']=table_name('qa_responses');
	   	$config['table_id']='response_id';
	   	$config['table_active_field']='response_active';//to detect deleted records
	   	$config['main_field']='response';
	   	
	   	$config['entity_label']='Response';	   
	   	$config['entity_label_plural']='Responses';
	   	
	

	   	//list view
	   	$config['order_by']='score ASC '; //mettre la valeur à mettre dans la requette
	   	
	   
	   	
	   	$fields['response_id']=array(
	   			'field_title'=>'#',
	   			'field_type'=>'int',
				'field_size'=>11,
	   			'field_value'=>'auto_increment',
				'default_value'=>'auto_increment'
				
	   	);
	   	
	   	
	   	$fields['response']=array(
	   			'field_title'=>'Response',
	   			'field_type'=>'text', 			
				'field_size'=>200, 	   			
				'input_type'=>'text', 
				'mandatory'=>' mandatory ' 
						
	   	);
		 	$fields['score']=array(
	   			'field_title'=>'Score',
	   			'field_type'=>'real', 			
				'field_size'=>10, 	   			
				'input_type'=>'text', 
				'mandatory'=>' mandatory ', 
				'display_null'=>True
						
	   	);
	   	$fields['response_category']=array(
	   			'field_title'=>'Response quategory',
	   			'field_type'=>'int', 			
				'field_size'=>2, 	   			
				'input_type'=>'text', 
						
	   	);
	   
		
		
	   	$fields['response_active']=array(
	   			'field_title'=>'Active',
	   			'field_type'=>'int',
	   			'field_size'=>'1',
	   			'field_value'=>'1',
				'default_value'=>'1'
				
				
	   	);
	   	
		$config['fields']=$fields;
	   	
	
		$operations['add_qa_responses']=array(
			'operation_type'=>'Add',
			'operation_title'=>'Add a new response',	
			'operation_description'=>'Add a new response',	
			'page_title'=>'Add a new response for quality assessment',			
			'save_function'=>'op/save_element',
			'page_template'=>'general/frm_entity',
			'redirect_after_save'=>'op/entity_list/list_qa_responses',
			'db_save_model'=>'add_qa_responses',
				
			'generate_stored_procedure'=>True,
					
			'fields'=>array(
					'response_id'=>array('mandatory'=>'','field_state'=>'hidden'),
					'response'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
					'score'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
						),
				
				'top_links'=>array(
							
							'back'=>array(
										'label'=>'',
										'title'=>'Close',
										'icon'=>'close',
										'url'=>'home',
									)
				
				),
			
		);
		
		$operations['edit_qa_responses']=array(
				'operation_type'=>'Edit',
				'operation_title'=>'Edit response',
				'operation_description'=>'Edit response',
				'page_title'=>'Edit response for quality assessment ',
				'save_function'=>'op/save_element',
				'page_template'=>'general/frm_entity',
				
				'redirect_after_save'=>'op/entity_list/list_qa_responses',
				'data_source'=>'get_detail_qa_responses',
				'db_save_model'=>'update_qa_responses',
				
		
				'generate_stored_procedure'=>True,
					
				'fields'=>array(
						'response_id'=>array('mandatory'=>'','field_state'=>'hidden'),
						'response'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
						'score'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
							
				),
		
				'top_links'=>array(
							
							'back'=>array(
										'label'=>'',
										'title'=>'Close',
										'icon'=>'close',
										'url'=>'home',
									)
				
				),
					
		);
		
		$operations['list_qa_responses']=array(
				'operation_type'=>'List',
				'operation_title'=>'List responses',
				'operation_description'=>'List responses',
				'page_title'=>'List of responses for quality assessment',
				
				
				'data_source'=>'get_list_qa_responses',
				'generate_stored_procedure'=>True,
					
				'fields'=>array(
						//'response_id'=>array(),
						'response'=>array(
							'link'=>array(
									'url'=>'op/edit_element/edit_qa_responses/',
									'id_field'=>'response_id',
									'trim'=>''
								)
						),
						'score'=>array(),
							
				),
				'order_by'=>'response ASC ', 
				'search_by'=>'response',
		
				'list_links'=>array(
						
						'delete'=>array(
									'label'=>'Delete',
									'title'=>'Delete ',
									'url'=>'op/delete_element/remove_qa_responses/'
								)
												
				),
				
				'top_links'=>array(
							'add'=>array(
										'label'=>'',
										'title'=>'Add a new response',
										'icon'=>'add',
										'url'=>'op/add_element/add_qa_responses',
									),
							'close'=>array(
										'label'=>'',
										'title'=>'Close',
										'icon'=>'add',
										'url'=>'home',
									)
				
				),
		);
		
		$operations['detail_qa_responses']=array(
				'operation_type'=>'Detail',
				'operation_title'=>'Detail of a response',
				'operation_description'=>'Detail of a response',
				'page_title'=>'Response ',
				
				
				
				'data_source'=>'get_detail_qa_responses',
				'generate_stored_procedure'=>True,
					
				'fields'=>array(
					
						'response'=>array(),
						'score'=>array(),
						
							
				),
				
				
				'top_links'=>array(
						'edit'=>array(
									'label'=>'',
									'title'=>'Edit',
									'icon'=>'edit',
									'url'=>'op/edit_element/edit_qa_responses/~current_element~',
								),	
						'back'=>array(
										'label'=>'',
										'title'=>'Close',
										'icon'=>'add',
										'url'=>'home',
									),
								
						
				
				),
		);
		
	
		$operations['remove_qa_responses']=array(
				'operation_type'=>'Remove',
				'operation_title'=>'Remove a response',
				'operation_description'=>'Delete a response',
				'redirect_after_delete'=>'op/entity_list/list_qa_responses',
				'db_delete_model'=>'remove_qa_responses',
				'generate_stored_procedure'=>True,
					
				
		);
		
		
	 	$config['operations']=$operations;
	return $config;
	
}