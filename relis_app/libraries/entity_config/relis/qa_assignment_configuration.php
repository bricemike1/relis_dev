<?php 
function get_qa_assignment() {
		$config['config_id']='qa_assignment';
		$config['table_name']=table_name('qa_assignment');
	   	$config['table_id']='qa_assignment_id';
	   	$config['table_active_field']='qa_assignment_active';//to detect deleted records
	   	$config['main_field']='paper_id';
	   	
	   	$config['entity_label']='Quality assessment assingnment';	   
	   	$config['entity_label_plural']='Quality assessment assingnment';
	   	
	

	   	//list view
	   	$config['order_by']='qa_assignment_id DESC '; 
	   	
	   
	   	
	   	$fields['qa_assignment_id']=array(
	   			'field_title'=>'#',
	   			'field_type'=>'int',
				'field_size'=>11,
	   			'field_value'=>'auto_increment',
				'default_value'=>'auto_increment'
				
	   	);
	   	
	   	$fields['paper_id']=array(
	   			'field_title'=>'Paper',
	   			'field_type'=>'int',
	   			'field_size'=>11,
	   			'input_type'=>'select',
	   			'input_select_source'=>'table',
	   			'input_select_values'=>'papers;CONCAT_WS(" - ",bibtexKey,title)',
	   	
	   			'mandatory'=>' mandatory ',
	   	
	   			 
	   	);
	  
	   	$fields['assigned_to']=array(
	   			'field_title'=>'Assigned to',
	   			'field_type'=>'int',
	   			'field_size'=>11,
	   			'input_type'=>'select',
	   			'input_select_source'=>'table',
	   			'input_select_values'=>'users;user_name',
	   			'mandatory'=>' mandatory ',
	   	);
	   	
	   	$fields['assigned_by']=array(
	   			'field_title'=>'Assigned by',
	   			'field_type'=>'int',
	   			'field_size'=>11,
	   			'input_type'=>'select',
	   			'input_select_source'=>'table',
	   			'input_select_values'=>'users;user_name',
	   			'mandatory'=>' mandatory ',
	   	);
	   	
	   	$fields['assignment_time']=array(
	   			'field_title'=>'Time',
	   			'field_type'=>'time',
	   			'default_value'=>'CURRENT_TIMESTAMP',
	   			'field_value'=>bm_current_time('Y-m-d H:i:s'),
	   			 
	   			'field_size'=>20,
	   			'mandatory'=>' mandatory ',
	   	);
	   
	   	$fields['qa_status']=array(
	   			'field_title'=>'QA Status',
	   			'field_type'=>'text',
	   			'field_size'=>15,
	   			'input_type'=>'select',
	   			'input_select_source'=>'array',
	   			'input_select_values'=>array('Pending'=>'Pending',
	   					'Done'=>'Done'
	   			),
	   			'field_value'=>'Pending',
	   			'default_value'=>'Pending',
	   			'mandatory'=>'mandatory',
	   	);
	   	
	   	$fields['assignment_type']=array(
	   			'field_title'=>'Assignment type',
	   			'field_type'=>'text',
	   			'field_size'=>15,
	   			'input_type'=>'select',
	   			'input_select_source'=>'array',
	   			'input_select_values'=>array('QA'=>'QA',
	   					'Validation'=>'Validation'
	   			),
	   			'field_value'=>'QA',
	   			'default_value'=>'QA',
	   			'mandatory'=>'mandatory',
	   	);
		$fields['assignment_mode']=array(
				'field_title'=>'Assignment mode',
				'field_type'=>'text',
				'field_value'=>'manualy_single',
				'default_value'=>'auto',
				'field_size'=>30,
				'input_type'=>'select',
				'input_select_source'=>'array',
				'input_select_values'=>array('auto'=>'Automatic',
						'manualy_bulk' => 'Manually Bulk',
						'manualy_single' => 'Manually'
				),
				'mandatory'=>' mandatory ',
		);
	   	$fields['operation_code']=array( //used  for bulk assignment  in order to reverse the operation
	   			'field_title'=>'Operation code',
	   			'field_type'=>'text',
	   			'field_value'=>'01',
	   			'default_value'=> '01',
	   			'mandatory'=>'mandatory',
	   			'field_size'=>15,
	   	
	   	);
	   	
	   	$fields['qa_assignment_active']=array(
	   			'field_title'=>'Active',
	   			'field_type'=>'int',
	   			'field_size'=>'1',
	   			'field_value'=>'1',
				'default_value'=>'1'
				
				
	   	);
	   	
		$config['fields']=$fields;
	   	
	
		$operations['add_qa_assignment']=array(
			'operation_type'=>'Add',
			'operation_title'=>'Add quality assessment assignment',	
			'operation_description'=>'Add quality assessment assignment',	
			'page_title'=>'Assign paper for quality assessment',			
			'save_function'=>'op/save_element',
			'page_template'=>'general/frm_entity',
			'redirect_after_save'=>'op/entity_list/list_qa_assignment',
			'db_save_model'=>'add_qa_assignment',
				
			'generate_stored_procedure'=>True,
					
			'fields'=>array(
					'qa_assignment_id'=>array('mandatory'=>'','field_state'=>'hidden'),
					'paper_id'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
					'assigned_to'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
					'assigned_by'=>array('mandatory'=>'mandatory','field_state'=>'hidden','field_value'=>active_user_id()),
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
		
		$operations['edit_qa_assignment']=array(
				'operation_type'=>'Edit',
				'operation_title'=>'Edit quality assessment assignment',
				'operation_description'=>'Edit quality assessment assignment',
				'page_title'=>'Edit assignment paper for quality assessment ',
				'save_function'=>'op/save_element',
				'page_template'=>'general/frm_entity',
				
				'redirect_after_save'=>'op/entity_list/list_qa_assignment',
				'data_source'=>'get_detail_qa_assignment',
				'db_save_model'=>'update_qa_assignment',
				
		
				'generate_stored_procedure'=>True,
					
				'fields'=>array(
					'qa_assignment_id'=>array('mandatory'=>'','field_state'=>'hidden'),
					'paper_id'=>array('mandatory'=>'mandatory','field_state'=>'disabled'),
					'assigned_to'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
							
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
		
		$operations['list_qa_assignment']=array(
				'operation_type'=>'List',
				'operation_title'=>'List assignment for  quality assessment',
				'operation_description'=>'List assignment for quality assessment',
				'page_title'=>'List assignments for quality assessment',
				'table_display_style'=>'dynamic_table',
				
				'data_source'=>'get_list_qa_assignment',
				'generate_stored_procedure'=>True,
					
				'fields'=>array(
					'qa_assignment_id'=>array(),
					'paper_id'=>array(
					'link'=>array(
								'url'=>'op/display_element/detail_qa_assignment/',
								'id_field'=>'qa_assignment_id',
								'trim'=>'50'
							)),
					'assigned_to'=>array(),
					'assigned_by'=>array(),
					'assignment_time'=>array(),
							
				),
				'order_by'=>'qa_assignment_id DESC ', 
		
				'list_links'=>array(
					/*	'view'=>array(
									'label'=>'View',
									'title'=>'Disaly element',
									'icon'=>'folder',
									'url'=>'op/display_element/detail_qa_assignment/',
								),
						'edit'=>array(
									'label'=>'Edit',
									'title'=>'Edit',
									'icon'=>'edit',
									'url'=>'op/edit_element/edit_qa_assignment/',
								),*/
						'delete'=>array(
									'label'=>'Delete',
									'title'=>'Delete ',
									'url'=>'op/delete_element/remove_qa_assignment/'
								)
												
				),
				
				'top_links'=>array(
							'add'=>array(
										'label'=>'',
										'title'=>'Add new',
										'icon'=>'add',
										'url'=>'op/add_element/add_qa_assignment',
									),
							'close'=>array(
										'label'=>'',
										'title'=>'Close',
										'icon'=>'add',
										'url'=>'home',
									)
				
				),
		);
		
		$operations['detail_qa_assignment']=array(
				'operation_type'=>'Detail',
				'operation_title'=>'Detail assignment  for quality assessment',
				'operation_description'=>'Detail assignment  for quality assessment',
				'page_title'=>'Assignment  for quality assessment ',
				
				
				
				'data_source'=>'get_detail_qa_assignment',
				'generate_stored_procedure'=>True,
					
				'fields'=>array(
										
					'paper_id'=>array(),
					'assigned_to'=>array(),
					'assigned_by'=>array(),
					'assignment_time'=>array(),
						
							
				),
				
				
				'top_links'=>array(
						'edit'=>array(
									'label'=>'',
									'title'=>'Edit',
									'icon'=>'edit',
									'url'=>'op/edit_element/edit_qa_assignment/~current_element~',
								),	
						'back'=>array(
										'label'=>'',
										'title'=>'Close',
										'icon'=>'add',
										'url'=>'home',
									),
								
						
				
				),
		);
		
	
		$operations['remove_qa_assignment']=array(
				'operation_type'=>'Remove',
				'operation_title'=>'Remove  assignement for quality assessment',
				'operation_description'=>'Delete assignement for quality assessment',
				'redirect_after_delete'=>'op/entity_list/list_qa_assignment',
				'db_delete_model'=>'remove_qa_assignment',
				'generate_stored_procedure'=>True,
					
				
		);
		
		
	 	$config['operations']=$operations;
	return $config;
	
}