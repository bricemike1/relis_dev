<?php 
function get_qa_questions() {
		$config['config_id']='qa_questions';
		$config['table_name']=table_name('qa_questions');
	   	$config['table_id']='question_id';
	   	$config['table_active_field']='question_active';//to detect deleted records
	   	$config['main_field']='question';
	   	
	   	$config['entity_label']='Question';	   
	   	$config['entity_label_plural']='Questions';
	   	
	

	   	//list view
	   	$config['order_by']='question ASC '; //mettre la valeur à mettre dans la requette
	   	
	   
	   	
	   	$fields['question_id']=array(
	   			'field_title'=>'#',
	   			'field_type'=>'int',
				'field_size'=>11,
	   			'field_value'=>'auto_increment',
				'default_value'=>'auto_increment'
				
	   	);
	   	
	   	
	   	$fields['question']=array(
	   			'field_title'=>'Question',
	   			'field_type'=>'text', 			
				'field_size'=>200, 	   			
				'input_type'=>'text', 
				'mandatory'=>' mandatory ' 
						
	   	);
	   	$fields['response_category']=array(
	   			'field_title'=>'Response quategory',
	   			'field_type'=>'int', 			
				'field_size'=>2, 	   			
				'input_type'=>'text', 
						
	   	);
	   
		
		
	   	$fields['question_active']=array(
	   			'field_title'=>'Active',
	   			'field_type'=>'int',
	   			'field_size'=>'1',
	   			'field_value'=>'1',
				'default_value'=>'1'
				
				
	   	);
	   	
		$config['fields']=$fields;
	   	
	
		$operations['add_qa_questions']=array(
			'operation_type'=>'Add',
			'operation_title'=>'Add a new question',	
			'operation_description'=>'Add a new question',	
			'page_title'=>'Add a new question for quality assessment',			
			'save_function'=>'op/save_element',
			'page_template'=>'general/frm_entity',
			'redirect_after_save'=>'op/entity_list/list_qa_questions',
			'db_save_model'=>'add_qa_questions',
				
			'generate_stored_procedure'=>True,
					
			'fields'=>array(
					'question_id'=>array('mandatory'=>'','field_state'=>'hidden'),
					'question'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
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
		
		$operations['edit_qa_questions']=array(
				'operation_type'=>'Edit',
				'operation_title'=>'Edit question',
				'operation_description'=>'Edit question',
				'page_title'=>'Edit question for quality assessment ',
				'save_function'=>'op/save_element',
				'page_template'=>'general/frm_entity',
				
				'redirect_after_save'=>'op/entity_list/list_qa_questions',
				'data_source'=>'get_detail_qa_questions',
				'db_save_model'=>'update_qa_questions',
				
				
				'generate_stored_procedure'=>True,
					
				'fields'=>array(
						'question_id'=>array('mandatory'=>'','field_state'=>'hidden'),
						'question'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
							
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
		
		$operations['list_qa_questions']=array(
				'operation_type'=>'List',
				'operation_title'=>'List questions',
				'operation_description'=>'List questions',
				'page_title'=>'List of questions for quality assessment',
				
				
				'data_source'=>'get_list_qa_questions',
				'generate_stored_procedure'=>True,
					
				'fields'=>array(
						
						'question'=>array(
						'link'=>array(
								'url'=>'op/edit_element/edit_qa_questions/',
								'id_field'=>'question_id',
								'trim'=>''
							)
						),
							
				),
				'order_by'=>'question ASC ', 
				'search_by'=>'question',
		
				'list_links'=>array(
						
						'delete'=>array(
									'label'=>'Delete',
									'title'=>'Delete ',
									'url'=>'op/delete_element/remove_qa_questions/'
								)
												
				),
				
				'top_links'=>array(
							'add'=>array(
										'label'=>'',
										'title'=>'Add a new question',
										'icon'=>'add',
										'url'=>'op/add_element/add_qa_questions',
									),
							'close'=>array(
										'label'=>'',
										'title'=>'Close',
										'icon'=>'add',
										'url'=>'home',
									)
				
				),
		);
		
		$operations['detail_qa_questions']=array(
				'operation_type'=>'Detail',
				'operation_title'=>'Detail of a question',
				'operation_description'=>'Detail of a question',
				'page_title'=>'Question ',
				
				
				
				'data_source'=>'get_detail_qa_questions',
				'generate_stored_procedure'=>True,
					
				'fields'=>array(
					
						'question'=>array(),
						
							
				),
				
				
				'top_links'=>array(
						'edit'=>array(
									'label'=>'',
									'title'=>'Edit',
									'icon'=>'edit',
									'url'=>'op/edit_element/edit_qa_questions/~current_element~',
								),	
						'back'=>array(
										'label'=>'',
										'title'=>'Close',
										'icon'=>'add',
										'url'=>'home',
									),
								
						
				
				),
		);
		
	
		$operations['remove_qa_questions']=array(
				'operation_type'=>'Remove',
				'operation_title'=>'Remove a question',
				'operation_description'=>'Delete a question',
				'redirect_after_delete'=>'op/entity_list/list_qa_questions',
				'db_delete_model'=>'remove_qa_questions',
				'generate_stored_procedure'=>True,
					
				
		);
		
		
	 	$config['operations']=$operations;
	return $config;
	
}