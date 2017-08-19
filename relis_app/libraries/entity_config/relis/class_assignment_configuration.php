<?php 
function get_class_assignment() {
		$config['config_id']='assignation';
		$config['table_name']=table_name('assigned');
	   	$config['table_id']='assigned_id';
	   	$config['table_active_field']='assigned_active';
	   	$config['main_field']='assigned_paper_id';
	   	
	   	$config['entity_label']='Paper assignment for classification';	   
	   	$config['entity_label_plural']='Paper assignment for classification';
	   	
	

	   	//list view
	   	$config['order_by']='assigned_id DESC '; 
	   	
	   
	   	
	   	$fields['assigned_id']=array(
	   			'field_title'=>'#',
	   			'field_type'=>'int',
				'field_size'=>11,
	   			'field_value'=>'auto_increment',
				'default_value'=>'auto_increment'
				
	   	);
	   	
	   	$fields['assigned_paper_id']=array(
	   			'field_title'=>'Paper',
	   			'field_type'=>'int',
	   			'field_size'=>11,
	   			'input_type'=>'select',
	   			'input_select_source'=>'table',
	   			'input_select_values'=>'papers;CONCAT_WS(" - ",bibtexKey,title)',
	   	
	   			'mandatory'=>' mandatory ',
	   	
	   			 
	   	);
	  
	   	$fields['assigned_user_id']=array(
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
	   			'field_title'=>'Assignment time',
	   			'field_type'=>'time',
	   			'default_value'=>'CURRENT_TIMESTAMP',
	   			'field_value'=>bm_current_time('Y-m-d H:i:s'),
	   			 
	   			'field_size'=>20,
	   			'mandatory'=>' mandatory ',
	   	);
	   
	   	$fields['assigned_note']=array(
	   			'field_title'=>'Note',
	   			'field_type'=>'text',
	   			'field_size'=>200,
	   			'input_type'=>'textarea',
	   			
	   	);
	   	
	   	$fields['assignment_type']=array(
	   			'field_title'=>'Assignment type',
	   			'field_type'=>'text',
	   			'field_size'=>15,
	   			'input_type'=>'select',
	   			'input_select_source'=>'array',
	   			'input_select_values'=>array('Classification'=>'Classification',
	   					'Validation'=>'Validation'
	   			),
	   			'field_value'=>'Classification',
	   			'default_value'=>'Classification',
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
	   	$fields['operation_code']=array( 
	   			'field_title'=>'Operation code',
	   			'field_type'=>'text',
	   			'field_value'=>'01',
	   			'default_value'=> '01',
	   			'mandatory'=>'mandatory',
	   			'field_size'=>15,
	   	
	   	);
		
		$fields['validation']=array(
	   			'field_title'=>'Validation',
	   			'field_type'=>'text',
	   			'field_size'=>15,
	   			'input_type'=>'select',
	   			'input_select_source'=>'array',
	   			'input_select_values'=>array('Correct'=>'Correct',
	   					'Not Correct'=>'Not Correct'
	   			)
	   	);
	   	$fields['validation_time']=array(
	   			'field_title'=>'Validation time',
	   			'field_type'=>'text',
				'field_size'=>20,
				'input_type'=>'text',
	   			
	   	);
	   	
		$fields['validation_note']=array(
	   			'field_title'=>'Validation note',
	   			'field_type'=>'text',
	   			'field_size'=>1000,
	   			'input_type'=>'textarea',
	   			
	   	);
		
	   	$fields['assigned_active']=array(
	   			'field_title'=>'Active',
	   			'field_type'=>'int',
	   			'field_size'=>'1',
	   			'field_value'=>'1',
				'default_value'=>'1'
				
				
	   	);
	   	
		$config['fields']=$fields;
	   	
		
		
		
		
		$operations['add_class_assignment']=array(
			'operation_type'=>'Add',
			'operation_title'=>'Assign a user to the paper for classification',	
			'operation_description'=>'Assign a user to the paper for classification',	
			'page_title'=>'Assign a user to the paper for classification',			
			'save_function'=>'op/save_element',
			'page_template'=>'general/frm_entity',
			'redirect_after_save'=>'op/entity_list/list_class_assignment',
			'db_save_model'=>'add_class_assignment',
				
			'generate_stored_procedure'=>True,
					
			'fields'=>array(
					'assigned_id'=>array('mandatory'=>'','field_state'=>'hidden'),
					'assignment_mode'=>array('mandatory'=>'','field_state'=>'hidden'),
					'assigned_paper_id'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
					'assigned_user_id'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
					'assigned_note'=>array('mandatory'=>'','field_state'=>'enabled'),
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
		
		$operations['new_assignment_class']=array(
	   			'operation_type'=>'AddChild',
	   			'operation_title'=>'Add a reviewer to a paper',
	   			'operation_description'=>'AddAdd a reviewer to a paper',
	   			'page_title'=>'Add a reviewer to the paper : ~current_parent_name~',
	   			'save_function'=>'op/save_element',
	   			'page_template'=>'general/frm_entity',
	   			'redirect_after_save'=>'relis/manager/display_paper/~current_element~',
	   			'db_save_model'=>'add_class_assignment',
				
				'master_field'=>'assigned_paper_id',
				'parent_config'=>'papers',
				'parent_detail_source'=>'get_detail_papers',//To get the name of the user to be displayed in the title
				'parent_detail_source_field'=>'title',
				
	   			'generate_stored_procedure'=>FALSE,
	   				
	   			'fields'=>array(
	   			
					
					'assigned_id'=>array('mandatory'=>'','field_state'=>'hidden'),
					'assignment_mode'=>array('mandatory'=>'','field_state'=>'hidden'),
					'assigned_paper_id'=>array('mandatory'=>'mandatory','field_state'=>'hidden'),
					'assigned_user_id'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
					'assigned_note'=>array('mandatory'=>'','field_state'=>'enabled'),
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
		
		$operations['class_not_valid']=array(
				'operation_type'=>'Edit',
				'operation_title'=>'Classification not valid',
				'operation_description'=>'Classification not valid',
				'page_title'=>'Classification not valid ',
				'save_function'=>'op/save_element',
				'page_template'=>'general/frm_entity',
				
				'redirect_after_save'=>'op/entity_list/list_class_validation',
				'data_source'=>'get_detail_class_assignment',
				'db_save_model'=>'update_class_validation',
				
		
				'generate_stored_procedure'=>True,
					
				'fields'=>array(
					'assigned_id'=>array('mandatory'=>'','field_state'=>'hidden'),
					'assigned_paper_id'=>array('mandatory'=>'mandatory','field_state'=>'disabled'),
					'validation_note'=>array('mandatory'=>'mandatory','field_state'=>'enabled','field_title'=>'What is not correct with the classification'),
					'validation_time'=>array('mandatory'=>'mandatory','field_state'=>'hidden','field_value'=>bm_current_time()),
					'validation'=>array('mandatory'=>'mandatory','field_state'=>'hidden','field_value'=>'Not Correct'),
							
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
		
		
		$operations['edit_assignment_class']=array(
				'operation_type'=>'Edit',
				'operation_title'=>'Edit assignment for classification',
				'operation_description'=>'Edit assignment for classification',
				'page_title'=>'Edit assignment for classification ',
				'save_function'=>'op/save_element',
				'page_template'=>'general/frm_entity',
				
				'redirect_after_save'=>'op/entity_list/list_class_assignment',
				'data_source'=>'get_detail_class_assignment',
				'db_save_model'=>'update_class_assignment',
				
		
				'generate_stored_procedure'=>True,
					
				'fields'=>array(
					'assigned_id'=>array('mandatory'=>'','field_state'=>'hidden'),
					'assigned_paper_id'=>array('mandatory'=>'mandatory','field_state'=>'disabled'),
					'assigned_user_id'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
					'assigned_note'=>array('mandatory'=>'','field_state'=>'enabled'),
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
		
		$operations['list_class_assignment']=array(
				'operation_type'=>'List',
				'operation_title'=>'Assignments for classification',
				'operation_description'=>'Assignments for classification',
				'page_title'=>'Assignments for classification',
				'table_display_style'=>'dynamic_table',
				
				'data_source'=>'get_list_class_assignment',
				'generate_stored_procedure'=>True,
					
				'fields'=>array(
					'assigned_id'=>array(),
					'assigned_paper_id'=>array(
					'link'=>array(
								'url'=>'op/display_element/detail_class_assignment/',
								'id_field'=>'assigned_id',
								'trim'=>'50'
							)),
					'assigned_user_id'=>array(),
					'assigned_by'=>array(),
					'assignment_time'=>array(),
					'assigned_note'=>array(),
							
				),
				'order_by'=>'assigned_id DESC ', 
				'conditions'=>array(
					'assignment_type'=>array('field'=>'assignment_type',
												'value'=>'Classification',
												'evaluation'=>'equal',
												'add_on_generation'=>FALSE,
												'parameter_type'=>'VARCHAR(20)'
											)
	   			),
				'list_links'=>array(
					
						'edit'=>array(
									'label'=>'Edit',
									'title'=>'Edit',
									'icon'=>'edit',
									'url'=>'op/edit_element/edit_assignment_class/',
								),
						'delete'=>array(
									'label'=>'Delete',
									'title'=>'Delete ',
									'url'=>'op/delete_element/remove_class_assignment/'
								)
												
				),
				
				'top_links'=>array(
							'add'=>array(
										'label'=>'',
										'title'=>'Add new',
										'icon'=>'add',
										'url'=>'op/add_element/add_class_assignment',
									),
							'close'=>array(
										'label'=>'',
										'title'=>'Close',
										'icon'=>'add',
										'url'=>'home',
									)
				
				),
		);
		
		$operations['list_class_assignment_val']=array(
				'operation_type'=>'List',
				'operation_title'=>'Assignments for classification',
				'operation_description'=>'Assignments for classification',
				'page_title'=>'Assignments for classification validation',
				'table_display_style'=>'dynamic_table',
				
				'data_source'=>'get_list_class_assignment',
				'generate_stored_procedure'=>False,
					
				'fields'=>array(
					'assigned_id'=>array(),
					'assigned_paper_id'=>array(
					'link'=>array(
								'url'=>'op/display_element/detail_class_assignment/',
								'id_field'=>'assigned_id',
								'trim'=>'50'
							)),
					'assigned_user_id'=>array(),
					'assigned_by'=>array(),
					'assignment_time'=>array(),
					
					
							
				),
				'order_by'=>'assigned_id DESC ', 
				'conditions'=>array(
					'assignment_type'=>array('field'=>'assignment_type',
												'value'=>'Validation',
												'evaluation'=>'equal',
												'add_on_generation'=>FALSE,
												'parameter_type'=>'VARCHAR(20)'
											)
	   			),
				'list_links'=>array(
					
						'edit'=>array(
									'label'=>'Edit',
									'title'=>'Edit',
									'icon'=>'edit',
									'url'=>'op/edit_element/edit_assignment_class/',
								),
						'delete'=>array(
									'label'=>'Delete',
									'title'=>'Delete ',
									'url'=>'op/delete_element/remove_class_assignment/'
								)
												
				),
				
				'top_links'=>array(
							'add'=>array(
										'label'=>'',
										'title'=>'Add new',
										'icon'=>'add',
										'url'=>'op/add_element/add_class_assignment',
									),
							'close'=>array(
										'label'=>'',
										'title'=>'Close',
										'icon'=>'add',
										'url'=>'home',
									)
				
				),
		);
		
		$operations['list_class_validation']=array(
				'operation_type'=>'List',
				'operation_title'=>'Classification validation',
				'operation_description'=>'Classification validation',
				'page_title'=>'Classification validation',
				'table_display_style'=>'dynamic_table',
				
				'data_source'=>'get_list_class_assignment',
				'generate_stored_procedure'=>False,
					
				'fields'=>array(
					'assigned_id'=>array(),
					'assigned_paper_id'=>array(
					'link'=>array(
								'url'=>'relis/manager/display_paper_validation/',
								'id_field'=>'assigned_paper_id',
								'trim'=>'50'
							)),
					'assigned_user_id'=>array(),
					'validation'=>array(),
					'validation_note'=>array(),
					'validation_time'=>array(),
					
					
							
				),
				'order_by'=>'assigned_id DESC ', 
				'conditions'=>array(
					'assignment_type'=>array('field'=>'assignment_type',
												'value'=>'Validation',
												'evaluation'=>'equal',
												'add_on_generation'=>FALSE,
												'parameter_type'=>'VARCHAR(20)'
											)
	   			),
				'list_links'=>array(
					
						
												
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
		
		$operations['detail_class_assignment']=array(
				'operation_type'=>'Detail',
				'operation_title'=>'Assignment  for classiffication',
				'operation_description'=>'Assignment  for classiffication',
				'page_title'=>'Assignment  for classiffication' ,
				
				
				
				'data_source'=>'get_detail_class_assignment',
				'generate_stored_procedure'=>True,
					
				'fields'=>array(
										
					//'assigned_paper_id'=>array(),
					'assigned_user_id'=>array(),
					'assigned_by'=>array(),
					'assignment_time'=>array(),
					'assigned_note'=>array(),
						
							
				),
				
				
				'top_links'=>array(
						'edit'=>array(
									'label'=>'',
									'title'=>'Edit',
									'icon'=>'edit',
									'url'=>'op/edit_element/edit_assignment_class/~current_element~',
								),	
						'back'=>array(
										'label'=>'',
										'title'=>'Close',
										'icon'=>'add',
										'url'=>'home',
									),
								
						
				
				),
		);
		
	
		$operations['remove_class_assignment']=array(
				'operation_type'=>'Remove',
				'operation_title'=>'Remove  assignement for classification',
				'operation_description'=>'Delete assignement for classification',
				'redirect_after_delete'=>'op/entity_list/list_class_assignment',
				'db_delete_model'=>'remove_class_assignment',
				'generate_stored_procedure'=>True,
					
				
		);
		
		
	 	$config['operations']=$operations;
	return $config;
	
}