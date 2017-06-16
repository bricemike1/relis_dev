<?php 
function get_screening() {
		$config['config_id']='screening';
		$config['table_name']='screening_paper';
	   	$config['table_id']='screening_id';
	   	$config['table_active_field']='screening_active';//to detect deleted records
	   	$config['main_field']='paper_id';
	   	
	   	$config['entity_label']='Screening';
	   	$config['entity_label_plural']='Screening';
	   	
	  
	  
	   	$fields['screening_id']=array(
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
				'input_select_values'=>'papers;CONCAT_WS(" - ",bibtexKey,title)',//the reference table and the field to be displayed
				
				'mandatory'=>' mandatory ',
				
	   			
	   	);

		$fields['screening_phase']=array(// assigned to
				'field_title'=>'Screening phase',
				'field_type'=>'int',
				'field_size'=>11,
				'input_type'=>'select',
				'input_select_source'=>'table',
				'input_select_values'=>'screen_phase;phase_title',
				'mandatory'=>' mandatory ',
		);
	   	
		$fields['user_id']=array(// assigned to
	   			'field_title'=>'Assigned to',
	   			'field_type'=>'int',
	   			'field_size'=>11,
	   			'input_type'=>'select',
	   			'input_select_source'=>'table',
	   			'input_select_values'=>'users;user_name',
				'mandatory'=>' mandatory ',
	   	);
		
		
		$fields['assignment_note']=array(
				'field_title'=>'Note',
				'field_type'=>'text',
				'field_size'=>200,
				'input_type'=>'textarea',
		
		);
		
		$fields['assignment_type']=array(
				'field_title'=>'Assignment type',
				'field_type'=>'text',
				'field_value'=>'Normal',
				'default_value'=>'Normal',
				'field_size'=>20,
				'input_type'=>'select',
				'input_select_source'=>'array',
				'input_select_values'=>array('Normal'=>'Normal',
						'Veto' => 'Veto',
						'Info' => 'Info'
				),
				'mandatory'=>' mandatory ',
				
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
		
		
		$fields['assigned_by']=array(
				'field_title'=>'Assigned by',
				'field_type'=>'number',
				'field_size'=>11,				
	   			'field_value'=>active_user_id(),	   			
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
		
		$fields['operation_code']=array( //used  for bulk assignment  in order to reverse the operation
				'field_title'=>'Operation code',
				'field_type'=>'text',
				'field_value'=>'01',
				'default_value'=> '01',
				'mandatory'=>'mandatory',
				'field_size'=>15,
				
		);
		
		$fields['screening_decision']=array(
	   			'field_title'=>'Decision',
	   			'field_type'=>'text',
	   			'field_size'=>15,
	   			'input_type'=>'select',
	   			'input_select_source'=>'array',
	   			'input_select_values'=>array('Included'=>'Included',
											'Excluded'=>'Excluded',												
				),
	   	);
		
		$fields['exclusion_criteria']=array(
	   			'field_title'=>'Exclusion criteria',
	   			'field_type'=>'int',
	   			'field_size'=>11,
	   			'input_type'=>'select',
	   			'input_select_source'=>'table',
	   			'input_select_values'=>'exclusioncrieria;ref_value',//the reference table and the field to be displayed

		);
		
		
		$fields['screening_note']=array(
				'field_title'=>'Screening note',
				'field_type'=>'text',
				'field_size'=>200,
				'input_type'=>'textarea',
		
		);
		
		
		
		$fields['screening_time']=array(
	   			'field_title'=>'Screening time',
	   			'field_type'=>'time',
				'field_size'=>20,
	   			
	   	);
		
		$fields['screening_status']=array(
				'field_title'=>'Screening status',
				'field_type'=>'text',
				'field_size'=>15,
				'input_type'=>'select',
				'input_select_source'=>'array',
				'input_select_values'=>array('Pending'=>'Pending',
						'Done'=>'Done',
						'Reseted'=>'Reseted',
				),
				'field_value'=>'Pending',
				'default_value'=>'Pending',
				'mandatory'=>'mandatory',
		);
		
		$fields['assignment_role']=array(
				'field_title'=>'Assignment role',
				'field_type'=>'text',
				'field_size'=>15,
				'input_type'=>'select',
				'input_select_source'=>'array',
				'input_select_values'=>array('Screening'=>'Screening',
												'Validation'=>'Validation',
											),
				'field_value'=>'Screening',
				'default_value'=>'Screening',
				'mandatory'=>'mandatory',
		);
		 
		$fields['screening_active']=array(
	   			'field_title'=>'Active',
	   			'field_type'=>'int',
	   			'field_size'=>'1',
	   			'field_value'=>'1',
				'default_value'=>'1'
	   	);
		
	   

	   
	   	$config['fields']=$fields;
	   	
	   	$operations['list_assignments']=array(
	   			'operation_type'=>'List',
	   			'operation_title'=>'List of assignments',
	   			'operation_description'=>'List assignments',
	   			'page_title'=>'List of assignments',
				
	   			'page_template'=>'general/list',
				'table_display_style'=>'dynamic_table',
	   			'data_source'=>'get_list_assignments',
	   			'generate_stored_procedure'=>True,
	   		  
	   			'fields'=>array(
	   					'screening_id'=>array(),
	   					'paper_id'=>array(),
	   					'user_id'=>array(),
	   					//'assignment_note'=>array(),
	   					//'assignment_type'=>array(),
	   					//'assignment_role'=>array(),	   	
	   					//'screening_phase'=>array(),
	   					'assigned_by'=>array(),
	   					'assignment_time'=>array(),
	   					'assignment_mode'=>array(),
	   	
	   					 
	   			),
	   			
	   			'order_by'=>'screening_id ASC ',
	   			//'search_by'=>'project_title',
				'conditions'=>array(
					'screening_phase'=>array('field'=>'screening_phase',
												'value'=>active_screening_phase(),
												'evaluation'=>'equal',
												'add_on_generation'=>FALSE,
												'parameter_type'=>'VARCHAR(20)'
											)
	   			),
	   	
	   			'list_links'=>array(
	   					'view'=>array(
	   							'label'=>'View',
	   							'title'=>'Disaly element',
	   							'icon'=>'folder',
	   							'url'=>'op/display_element/display_assignment/',
	   					),
	   					'edit'=>array(
	   							'label'=>'Edit',
	   							'title'=>'Edit',
	   							'icon'=>'edit',
	   							'url'=>'op/edit_element/edit_assignment/',
	   					),
	   					'delete'=>array(
	   							'label'=>'Delete',
	   							'title'=>'Delete assignment',
	   							'url'=>'op/delete_element/remove_assignment/'
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
		$operations['list_my_assignments']=array(
	   			'operation_type'=>'List',
	   			'operation_title'=>'List of assignments',
	   			'operation_description'=>'List assignments',
	   			'page_title'=>'List of my assignments',
				
	   			'page_template'=>'general/list',
				'table_display_style'=>'dynamic_table',
	   			'data_source'=>'get_list_my_assignments',
	   			'generate_stored_procedure'=>True,
	   		  
	   			'fields'=>array(
	   					'screening_id'=>array(),
	   					'paper_id'=>array(),
	   					'user_id'=>array(),
	   					//'assignment_note'=>array(),
	   					//'assignment_type'=>array(),
	   					//'assignment_role'=>array(),	   	
	   					//'screening_phase'=>array(),
	   					'assigned_by'=>array(),
	   					'assignment_time'=>array(),
	   					'assignment_mode'=>array(),
	   	
	   					 
	   			),
	   			
	   			'order_by'=>'screening_id ASC ',
	   			//'search_by'=>'project_title',
				'conditions'=>array(
					'screening_phase'=>array('field'=>'screening_phase',
												'value'=>active_screening_phase(),
												'evaluation'=>'equal',
												'add_on_generation'=>FALSE,
												'parameter_type'=>'VARCHAR(20)'
											),
					'user'=>array('field'=>'user_id',
												'value'=>active_user_id(),
												'evaluation'=>'equal',
												'add_on_generation'=>FALSE,
												'parameter_type'=>'VARCHAR(20)'
											)
	   			),
	   	
	   			'list_links'=>array(
	   					'view'=>array(
	   							'label'=>'View',
	   							'title'=>'Disaly element',
	   							'icon'=>'folder',
	   							'url'=>'op/display_element/display_assignment/',
	   					),
	   					'edit'=>array(
	   							'label'=>'Edit',
	   							'title'=>'Edit',
	   							'icon'=>'edit',
	   							'url'=>'op/edit_element/edit_assignment/',
	   					),
	   					'delete'=>array(
	   							'label'=>'Delete',
	   							'title'=>'Delete assignment',
	   							'url'=>'op/delete_element/remove_assignment/'
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
		
	   	$operations['list_screenings']=array(
	   			'operation_type'=>'List',
	   			'operation_title'=>'List of screenings',
	   			'operation_description'=>'List screenings',
	   			'page_title'=>'List of screenings',
	   	
	   			'page_template'=>'general/list',
	   			'table_display_style'=>'dynamic_table',
	   			'data_source'=>'get_list_screenings',
	   			'generate_stored_procedure'=>True,
	   	
	   			'fields'=>array(
	   					'screening_id'=>array(),
	   					'paper_id'=>array(),
	   					'user_id'=>array(),
	   					'screening_decision'=>array(),
	   					'exclusion_criteria'=>array(),
	   					'screening_time'=>array(),
	   					 
	   	
	   			),
	   			 
	   			'order_by'=>'screening_id ASC ',
	   			'order_by'=>'screening_time DESC ',
	   			//'search_by'=>'project_title',
		   			'conditions'=>array('screening_status'=>array(
		   					'field'=>'screening_status',
		   					'value'=>'Done',
		   					'evaluation'=>'',
		   					'add_on_generation'=>True
		   			),
					'screening_phase'=>array('field'=>'screening_phase',
												'value'=>active_screening_phase(),
												'evaluation'=>'equal',
												'add_on_generation'=>FALSE,
												'parameter_type'=>'VARCHAR(20)'
											)
	   			),
	   		  
	   			'list_links'=>array(
	   					'view'=>array(
	   							'label'=>'View',
	   							'title'=>'Disaly element',
	   							'icon'=>'folder',
	   							'url'=>'op/display_element/display_screening/',
	   					),
	   					'edit'=>array(
	   							'label'=>'Edit',
	   							'title'=>'Edit',
	   							'icon'=>'edit',
	   							'url'=>'relis/manager/edit_screen/',
	   					)
	   					 
	   			),
	   		  
	   			'top_links'=>array(
	   					'close'=>array(
	   							'label'=>'',
	   							'title'=>'Close',
	   							'icon'=>'add',
	   							'url'=>'home/screening',
	   					)
	   					 
	   			),
	   	);
		
			$operations['list_my_screenings']=array(
	   			'operation_type'=>'List',
	   			'operation_title'=>'List of screenings',
	   			'operation_description'=>'List screenings',
	   			'page_title'=>'List of my screenings',
	   	
	   			'page_template'=>'general/list',
	   			'table_display_style'=>'dynamic_table',
	   			'data_source'=>'get_list_my_screenings',
	   			'generate_stored_procedure'=>True,
	   	
	   			'fields'=>array(
	   					'screening_id'=>array(),
	   					'paper_id'=>array(),
	   					'user_id'=>array(),
	   					'screening_decision'=>array(),
	   					'exclusion_criteria'=>array(),
	   					'screening_time'=>array(),
	   					 
	   	
	   			),
	   			 
	   			'order_by'=>'screening_id ASC ',
	   			'order_by'=>'screening_time DESC ',
	   			//'search_by'=>'project_title',
		   			'conditions'=>array('screening_status'=>array(
		   					'field'=>'screening_status',
		   					'value'=>'Done',
		   					'evaluation'=>'',
		   					'add_on_generation'=>True
		   			),
					'screening_phase'=>array('field'=>'screening_phase',
												'value'=>active_screening_phase(),
												'evaluation'=>'equal',
												'add_on_generation'=>FALSE,
												'parameter_type'=>'VARCHAR(20)'
											),
					'user'=>array('field'=>'user_id',
												'value'=>active_user_id(),
												'evaluation'=>'equal',
												'add_on_generation'=>FALSE,
												'parameter_type'=>'VARCHAR(20)'
											)
	   			),
	   		  
	   			'list_links'=>array(
	   					'view'=>array(
	   							'label'=>'View',
	   							'title'=>'Disaly element',
	   							'icon'=>'folder',
	   							'url'=>'op/display_element/display_screening/',
	   					),
	   					'edit'=>array(
	   							'label'=>'Edit',
	   							'title'=>'Edit',
	   							'icon'=>'edit',
	   							'url'=>'relis/manager/edit_screen/',
	   					)
	   					 
	   			),
	   		  
	   			'top_links'=>array(
	   					'close'=>array(
	   							'label'=>'',
	   							'title'=>'Close',
	   							'icon'=>'add',
	   							'url'=>'home/screening',
	   					)
	   					 
	   			),
	   	);
	   	$operations['new_assignment']=array(
	   			'operation_type'=>'Add',
	   			'operation_title'=>'New assignment',
	   			'operation_description'=>'New assignment',
	   			'page_title'=>'Assign a paper',
	   			'save_function'=>'op/save_element',
	   			'page_template'=>'general/frm_entity',
	   			'redirect_after_save'=>'op/entity_list/list_assignments',
	   			'db_save_model'=>'new_assignment',
	   		  
	   			'generate_stored_procedure'=>True,
	   	
	   			'fields'=>array(
	   					'screening_id'=>array('mandatory'=>'','field_state'=>'hidden'),
	   					'assigned_by'=>array('mandatory'=>'','field_state'=>'hidden'),
	   					'assignment_mode'=>array('mandatory'=>'','field_state'=>'hidden'),
	   					'paper_id'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
	   					'user_id'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
	   					
	   					'assignment_type'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
	   					'assignment_role'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
	   					'screening_phase'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
						'assignment_note'=>array('mandatory'=>'','field_state'=>'enabled'),
	   			),
	   		  
	   			'top_links'=>array(
	   						
	   					'back'=>array(
	   							'label'=>'',
	   							'title'=>'Close',
	   							'icon'=>'close',
	   							'url'=>'home',
	   					)
	   	
	   			)
	   	
	   	);
		
		
		
			$operations['add_reviewer']=array(
	   			'operation_type'=>'AddChild',
	   			'operation_title'=>'Add a reviewer to a paper',
	   			'operation_description'=>'AddAdd a reviewer to a paper',
	   			'page_title'=>'Add a reviewer to the paper : ~current_parent_name~',
	   			'save_function'=>'op/save_element',
	   			'page_template'=>'general/frm_entity',
	   			'redirect_after_save'=>'relis/manager/display_paper_screen/~current_element~',
	   			'db_save_model'=>'new_assignment',
				
				'master_field'=>'paper_id',
				'parent_config'=>'papers',
				'parent_detail_source'=>'get_detail_paper',//To get the name of the user to be displayed in the title
				'parent_detail_source_field'=>'title',
				
	   			'generate_stored_procedure'=>False,
	   				
	   			'fields'=>array(
	   					'screening_id'=>array('mandatory'=>'','field_state'=>'hidden'),
	   					'assigned_by'=>array('mandatory'=>'','field_state'=>'hidden'),
	   					'assignment_mode'=>array('mandatory'=>'','field_state'=>'hidden'),
	   					'paper_id'=>array('mandatory'=>'mandatory','field_state'=>'hidden'),
	   					'user_id'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
	   					
	   					'assignment_type'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
	   					'assignment_role'=>array('mandatory'=>'mandatory','field_state'=>'hidden','field_value'=>'Screening'),
	   					'screening_phase'=>array('mandatory'=>'mandatory','field_state'=>'hidden','field_value'=>active_screening_phase()),
						'assignment_note'=>array('mandatory'=>'','field_state'=>'enabled'),
	   	
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
		
	   	
	   	$operations['edit_assignment']=array(
	   			'operation_type'=>'Edit',
	   			'operation_title'=>'Edit assignement',
	   			'operation_description'=>'Edit assignement',
	   			'page_title'=>'Edit assignement ',
	   			'save_function'=>'op/save_element',
	   			'page_template'=>'general/frm_entity',
	   			'redirect_after_save'=>'op/entity_list/list_assigments',	   			
	   			'data_source'=>'get_detail_screen',
	   			'db_save_model'=>'update_assignment',
	   		  
	   			'generate_stored_procedure'=>True,
	   	
	   			'fields'=>array(
	   					'screening_id'=>array('mandatory'=>'','field_state'=>'hidden'),	   					
	   					'paper_id'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
	   					'user_id'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
	   					'assignment_note'=>array('mandatory'=>'','field_state'=>'enabled'),
	   					'assignment_type'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
	   					'assignment_role'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
	   					'screening_phase'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
	   	
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
	   	
		$operations['screen_paper']=array(
	   			'operation_type'=>'Edit',
	   			'operation_title'=>'Screen paper',
	   			'operation_description'=>'Screen paper',
	   			'page_title'=>'Screen  ',
	   			'save_function'=>'relis/manager/save_screening',
	   			'page_template'=>'relis/screen_paper',
	   			'redirect_after_save'=>'relis/manager/screen_paper',	   			
	   			'data_source'=>'get_detail_screen',
	   			'db_save_model'=>'save_screening',//to prepare
	   		  
	   			'generate_stored_procedure'=>False,
	   	
	   			'fields'=>array(
	   					'screening_id'=>array('mandatory'=>'','field_state'=>'hidden'),	   					
	   					'paper_id'=>array('mandatory'=>'','field_state'=>'hidden'),
	   					'screening_phase'=>array('mandatory'=>'mandatory','field_state'=>'hidden'),
						'screening_decision'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
	   					'exclusion_criteria'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
	   					'screening_time'=>array('mandatory'=>'mandatory','field_state'=>'hidden'),
	   					'screening_status'=>array('mandatory'=>'mandatory','field_state'=>'hidden','field_value'=>'Done'),
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
		$operations['edit_screen']=$operations['screen_paper'];
		$operations['edit_screen']['redirect_after_save']='op/entity_list/list_screenings';
		$operations['edit_screen']['page_title']='Edit screening';
		
		$operations['resolve_conflict']=$operations['screen_paper'];
		$operations['resolve_conflict']['redirect_after_save']='relis/manager/display_paper_screen/~current_paper~';
		$operations['resolve_conflict']['page_title']='Resolve screening conflict';
		
	   	$operations['display_assignment']=array(
	   			'operation_type'=>'Detail',
	   			'operation_title'=>'Info of an assignment',
	   			'operation_description'=>'Info of an assignment',
	   			'page_title'=>'Assignment ',
	   	
	   	
	   			'data_source'=>'get_detail_screen',
	   			'generate_stored_procedure'=>True,
	   				
	   			'fields'=>array(
	   					//	'screening_id'=>array(),
	   					'paper_id'=>array(),
	   					'user_id'=>array(),
	   					'assignment_note'=>array(),
	   					'assignment_type'=>array(),
	   					'assignment_role'=>array(),	   	
	   					'screening_phase'=>array(),
	   					'assigned_by'=>array(),
	   					'assignment_time'=>array(),
	   					'assignment_mode'=>array(),
	   					
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
	   	
	   		
	   	$operations['display_screening']=array(
	   			'operation_type'=>'Detail',
	   			'operation_title'=>'Info of an assignment',
	   			'operation_description'=>'Info of an assignment',
	   			'page_title'=>'Screening ',
	   	
	   	
	   			'data_source'=>'get_detail_screen',
	   			'generate_stored_procedure'=>False,
	   				
	   			'fields'=>array(
	   					//	'screening_id'=>array(),
	   					'paper_id'=>array(),
	   					'user_id'=>array(),
	   					'screening_decision'=>array(),
	   					'exclusion_criteria'=>array(),
	   					'screening_note'=>array(),
	   					'screening_time'=>array(),
	   					
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
	   	$operations['remove_assignment']=array(
	   			'operation_type'=>'Remove',
	   			'operation_title'=>'Remove assignment',
	   			'operation_description'=>'Remove a project',
	   			'redirect_after_delete'=>'op/entity_list/list_assignments',
	   			'db_delete_model'=>'remove_screen',
	   			'generate_stored_procedure'=>True,
	   				
	   	
	   	);
	   	$config['operations']=$operations;
	
	return $config;
	//SELECT  id,`bibtexKey`, `title`,IFNULL(D.screening_decision,'Pending') as decision FROM `paper` P LEFT JOIN screen_decison D ON (P.id=D.paper_id AND D.screening_phase=1 AND D.decision_active =1)  WHERE `paper_active`=1 
}