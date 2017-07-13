<?php 
function get_configuration() {
	
		$config['config_id']='config';
		$config['table_name']=table_name('config');
	   	$config['table_id']='config_id';
	   	$config['table_active_field']='config_active';//to detect deleted records
	   	$config['main_field']='config_type';
	   	
	  	$config['entity_label']='Configuration';
	   	$config['entity_label_plural']='Configurations';
	   	
	   	//list view
	   	$config['order_by']='config_id ASC '; //mettre la valeur à mettre dans la requette
	   

	   
	   	
	   	$fields['config_id']=array(
	   			'field_title'=>'#',
	   			'field_type'=>'int',
				'field_size'=>11,
	   			'field_value'=>'auto_increment',
				'default_value'=>'auto_increment'
	   	);
	   	

	   	$fields['config_type']=array(
	   			'field_title'=>'Configuration type',
	   			'field_type'=>'text',	   			
	   			'field_value'=>'default',
	   			'field_size'=>100,
	   			'input_type'=>'text',
	   			'mandatory'=>' mandatory '
	   	);
	   	
	   	$fields['editor_url']=array(
	   			'field_title'=>'Editor location(url)',
	   			'field_type'=>'text',	   			
	   			'field_value'=>'default',
	   			'field_size'=>100,
	   			'input_type'=>'text',
	   			'mandatory'=>' mandatory '
	   	);
	   	$fields['editor_generated_path']=array(
	   			'field_title'=>'Editor workspace',
	   			'field_type'=>'text',	   			
	   			'field_value'=>'default',
	   			'field_size'=>100,
	   			'input_type'=>'text',
	   			'mandatory'=>' mandatory '
	   	);
	   	
		$fields['csv_field_separator']=array(
	   			'field_title'=>'CSV  separator for import',
	   			'field_type'=>'text',
	   			'field_value'=>';',
				'default_value'=>';',
	   			'field_size'=>2,
	   			'mandatory'=>' mandatory ',
	   			'input_type'=>'select',
	   			'input_select_source'=>'array',
				'input_select_values'=>array(';'=>';',','=>',')
	   	);
		$fields['csv_field_separator_export']=array(
				'field_title'=>'CSV separator for export',
				'field_type'=>'text',
	   			'field_value'=>',',
				'default_value'=>',',
	   			'field_size'=>2,
	   			'mandatory'=>' mandatory ',
	   			'input_type'=>'select',
	   			'input_select_source'=>'array',
				'input_select_values'=>array(';'=>';',','=>',')
		);
		
		$fields['screening_screening_conflict_resolution']=array(
				'field_title'=>'Screening conflict resolution mode',
				'field_type'=>'text',
				'field_value'=>'Unanimity',
				'default_value'=>'Unanimity',
				'field_size'=>50,
				'mandatory'=>' mandatory ',
				'input_type'=>'select',
				'input_select_source'=>'array',
				'input_select_values'=>array('Unanimity'=>'Unanimity','Majority'=>'Majority'),
				
		);
		
		$fields['screening_conflict_type']=array(
				'field_title'=>'Screening conflict type',
				'field_type'=>'text',
				'field_value'=>'IncludeExclude',
				'field_value'=>'IncludeExclude',
				'field_size'=>50,
				'mandatory'=>' mandatory ',
				'input_type'=>'select',
				'input_select_source'=>'array',
				'input_select_values'=>array('IncludeExclude'=>'Inclusion - exclusion','ExclusionCriteria'=>'Exclusion criteria'),
				'initial_value'=>'IncludeExclude',
				
		);
		
		$fields['import_papers_on']=array(
				'field_title'=>'import papers activated',
				'field_type'=>'int',
	   			'field_size'=>'1',
	   			'field_value'=>'1',
				'default_value'=>'0',
				'input_type'=>'select',
				'input_select_source'=>'yes_no',
				'input_select_values'=>'1',
		);
		
		$fields['assign_papers_on']=array(
				'field_title'=>'assign papers activated',
				'field_type'=>'int',
	   			'field_size'=>'1',
	   			'field_value'=>'1',
				'default_value'=>'0',
				'input_type'=>'select',
				'input_select_source'=>'yes_no',
				'input_select_values'=>'',
		);
		
		$fields['screening_on']=array(
				'field_title'=>'Screening enabled',
				'field_type'=>'int',
	   			'field_size'=>'1',
	   			'field_value'=>'1',
				'default_value'=>'0',
				'input_type'=>'select',
				'input_select_source'=>'yes_no',
				'input_select_values'=>'',
		);
		
		$fields['screening_result_on']=array(
				'field_title'=>'Screening result activated',
				'field_type'=>'int',
	   			'field_size'=>'1',
	   			'field_value'=>'1',
				'default_value'=>'0',
				'input_type'=>'select',
				'input_select_source'=>'yes_no',
				'input_select_values'=>'',
		);
		$fields['screening_validation_on']=array(
				'field_title'=>'Screening validation activated',
				'field_type'=>'int',
	   			'field_size'=>'1',
	   			'field_value'=>'1',
				'default_value'=>'0',
				'input_type'=>'select',
				'input_select_source'=>'yes_no',
				'input_select_values'=>'',
		);
		
		
		
		$fields['classification_on']=array(
				'field_title'=>'Classification activated',
				'field_type'=>'int',
	   			'field_size'=>'1',
	   			'field_value'=>'0',
				'default_value'=>'0',
				'input_type'=>'select',
				'input_select_source'=>'yes_no',
				'input_select_values'=>'',
		);
		
		$fields['source_papers_on']=array(
				'field_title'=>'Add papers source',
				'field_type'=>'int',
	   			'field_size'=>'1',
	   			'field_value'=>'1',
				'default_value'=>'0',
				'input_type'=>'select',
				'input_select_source'=>'yes_no',
				'input_select_values'=>'',
		);
		
		
		
		$fields['search_strategy_on']=array(
				'field_title'=>'Add search strategy',
				'field_type'=>'int',
	   			'field_size'=>'1',
	   			'field_value'=>'1',
				'default_value'=>'0',
				'input_type'=>'select',
				'input_select_source'=>'yes_no',
				'input_select_values'=>'',
		);
		
		$fields['key_paper_prefix']=array(
	   			'field_title'=>'Prefix of the paper key',
	   			'field_type'=>'text',	   			
	   			'field_value'=>'Paper_',
	   			'default_value'=>'Paper_',
	   			'field_size'=>20,
	   			'input_type'=>'text',
	   			'mandatory'=>' mandatory '
	   	);
		
		$fields['key_paper_serial']=array(
	   			'field_title'=>'Key paper serial',
	   			'field_type'=>'int',	   			
	   			'field_value'=>'1',
	   			'default_value'=>'1',
	   			'field_size'=>10,
	   			'input_type'=>'text',
	   			'mandatory'=>' mandatory '
	   	);
		
		$fields['validation_default_percentage']=array(
	   			'field_title'=>'Validation default percentage',
	   			'field_type'=>'int',	   			
	   			'field_value'=>'20',
	   			'default_value'=>'20',
	   			'field_size'=>3,
	   			'input_type'=>'text',
	   			'mandatory'=>' mandatory '
	   	);
		$fields['screening_reviewer_number']=array(
	   			'field_title'=>'Reviews per paper',
	   			'field_type'=>'int',	   			
	   			'field_value'=>'2',
	   			'default_value'=>'2',
	   			'field_size'=>3,
	   			'input_type'=>'text',
	   			'mandatory'=>' mandatory '
	   	);
		
		
		$fields['screening_status_to_validate']=array(
				'field_title'=>'Screening status to validate',
				'field_type'=>'text',
				'field_value'=>'Excluded',
				'field_value'=>'Excluded',
				'field_size'=>50,
				'mandatory'=>' mandatory ',
				'input_type'=>'select',
				'input_select_source'=>'array',
				'input_select_values'=>array('Excluded'=>'Excluded','Included'=>'Included'),
				'initial_value'=>'Excluded',
				
		);
	   	$fields['screening_validator_assignment_type']=array(
				'field_title'=>'Validator assingment mode',
				'field_type'=>'text',
				'field_value'=>'Normal',
				'field_value'=>'Normal',
				'field_size'=>50,
				'mandatory'=>' mandatory ',
				'input_type'=>'select',
				'input_select_source'=>'array',
				'input_select_values'=>array('Normal'=>'Normal','Veto'=>'Veto','Info'=>'Info'),
				'initial_value'=>'Excluded',
				
		);
	   	$fields['config_active']=array(
	   			'field_title'=>'Active',
	   			'field_type'=>'int',
	   			'field_size'=>'1',
	   			'field_value'=>'1',
				'default_value'=>'1'
	   	);
	   	$config['fields']=$fields;
	   	
	   	$operations['configurations']=array(
	   			'operation_type'=>'Detail',
	   			'operation_title'=>'Configurations values',
	   			'operation_description'=>'Configurations values',
	   			'page_title'=>'All configurations',
	   	
	   			//'page_template'=>'general/display_element',
	   	
	   			'data_source'=>'get_detail_config',
	   			'generate_stored_procedure'=>True,
	   				
	   			'fields'=>array(
	   					
	   					//'config_type'=>array(),
	   					'editor_url'=>array(),
	   					'editor_generated_path'=>array(),
	   					'csv_field_separator'=>array(),
	   					'csv_field_separator_export'=>array(),
	   					'screening_screening_conflict_resolution'=>array(),
	   					'screening_conflict_type'=>array(),
	   					'import_papers_on'=>array(),
	   					'screening_on'=>array(),
	   					'assign_papers_on'=>array(),
	   					'screening_result_on'=>array(),
	   					'screening_validation_on'=>array(),
	   					'classification_on'=>array(),
	   					'source_papers_on'=>array(),
	   					'search_strategy_on'=>array(),
	   					'key_paper_prefix'=>array(),
	   					'key_paper_serial'=>array(),
	   					
	   						
	   			),
	   	
	   	
	   			'top_links'=>array(
	   					'edit'=>array(
	   							'label'=>'',
	   							'title'=>'Edit',
	   							'icon'=>'edit',
	   							'url'=>'op/edit_element/edit_configuration/~current_element~',
	   					),
	   					'back'=>array(
	   							'label'=>'',
	   							'title'=>'Close',
	   							'icon'=>'',
	   							'url'=>'home',
	   					),
	   	
	   	
	   	
	   			),
	   	);
	   	
		$operations['config_papers']=array(
	   			'operation_type'=>'Detail',
	   			'operation_title'=>'Information for  papers',
	   			'operation_description'=>'Configurations  for  papers',
	   			'page_title'=>'Papers configurations',
	   			'data_source'=>'get_detail_config',
	   			'generate_stored_procedure'=>False,
	   				
	   			'fields'=>array(
	   					
	   					
	   					'import_papers_on'=>array(),
	   					'csv_field_separator'=>array(),
	   					'csv_field_separator_export'=>array(),	   					
						'key_paper_prefix'=>array(),
	   					'key_paper_serial'=>array(),
						'source_papers_on'=>array(),
	   					'search_strategy_on'=>array(),
	   					
	   						
	   			),
	   	
	   	
	   			'top_links'=>array(
	   					'edit'=>array(
	   							'label'=>'',
	   							'title'=>'Edit',
	   							'icon'=>'edit',
	   							'url'=>'op/edit_element/edit_conf_papers/~current_element~',
	   					),
	   					'back'=>array(
	   							'label'=>'',
	   							'title'=>'Close',
	   							'icon'=>'',
	   							'url'=>'home',
	   					),
	   	
	   	
	   	
	   			),
	   	);
		
		
		
		$operations['config_dsl']=array(
	   			'operation_type'=>'Detail',
	   			'operation_title'=>'Information for  DSL',
	   			'operation_description'=>'DSL configuration',
	   			'page_title'=>'DSL configuration',
	   			'data_source'=>'get_detail_config',
	   			'generate_stored_procedure'=>False,
	   				
	   			'fields'=>array(
	   					
	   					
	   					'editor_url'=>array(),
	   					'editor_generated_path'=>array(),
	   					
	   						
	   			),
	   	
	   	
	   			'top_links'=>array(
	   					'edit'=>array(
	   							'label'=>'',
	   							'title'=>'Edit',
	   							'icon'=>'edit',
	   							'url'=>'op/edit_element/edit_config_dsl/~current_element~',
	   					),
	   					'back'=>array(
	   							'label'=>'',
	   							'title'=>'Close',
	   							'icon'=>'',
	   							'url'=>'home',
	   					),
	   	
	   	
	   	
	   			),
	   	);
		
		
		$operations['config_screening']=array(
	   			'operation_type'=>'Detail',
	   			'operation_title'=>'Screening configuration',
	   			'operation_description'=>'Screening configuration',
	   			'page_title'=>'Screening configuration',
	   			'data_source'=>'get_detail_config',
	   			'generate_stored_procedure'=>False,
	   				
	   			'fields'=>array(
	   					
	   					
	   					'screening_on'=>array(),
	   					'screening_validation_on'=>array(),
	   					'screening_result_on'=>array(),
						'screening_reviewer_number'=>array(),
	   					'screening_conflict_type'=>array(),	   					
						'screening_screening_conflict_resolution'=>array(),
	   					'validation_default_percentage'=>array(),						
	   					'screening_validator_assignment_type'=>array(),
	   					
	   						
	   			),
	   	
	   	
	   			'top_links'=>array(
	   					'edit'=>array(
	   							'label'=>'',
	   							'title'=>'Edit',
	   							'icon'=>'edit',
	   							'url'=>'op/edit_element/edit_config_screening/~current_element~',
	   					),
	   					'back'=>array(
	   							'label'=>'',
	   							'title'=>'Close',
	   							'icon'=>'',
	   							'url'=>'home',
	   					),
	   	
	   	
	   	
	   			),
	   	);
	   	
	   	$operations['edit_configuration']=array(
	   			'operation_type'=>'Edit',
	   			'operation_title'=>'Edit configuration',
	   			'operation_description'=>'Edit configuration',
	   			'page_title'=>'Edit configuration ',
	   			'save_function'=>'op/save_element',
	   			'page_template'=>'general/frm_entity',
	   	
	   			'redirect_after_save'=>'op/display_element/configurations/1',
	   			'data_source'=>'get_detail_config',
	   			'db_save_model'=>'update_config',
	   	
	   			'generate_stored_procedure'=>True,
	   				
	   			'fields'=>array(
	   					'config_id'=>array('mandatory'=>'','field_state'=>'hidden'),
	   					'config_type'=>array('mandatory'=>'mandatory','field_state'=>'hidden'),
	   					'editor_url'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
	   					'editor_generated_path'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
	   					'csv_field_separator'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
	   					'csv_field_separator_export'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
	   					'screening_screening_conflict_resolution'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
	   					'screening_conflict_type'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
	   					'import_papers_on'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
	   					'screening_on'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
	   					'assign_papers_on'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
	   					'screening_result_on'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
	   					'screening_validation_on'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
	   					'classification_on'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
	   					'source_papers_on'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
	   					'search_strategy_on'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
	   					'key_paper_prefix'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
	   					'key_paper_serial'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
	   					'validation_default_percentage'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
	   					'screening_status_to_validate'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
	   					'screening_validator_assignment_type'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
	   						
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
		
			$operations['edit_conf_papers']=array(
	   			'operation_type'=>'Edit',
	   			'operation_title'=>'Edit configuration for papers',
	   			'operation_description'=>'Edit configuration for papers',
	   			'page_title'=>'Edit papers configurations ',
	   			'save_function'=>'op/save_element',
	   			'page_template'=>'general/frm_entity',
	   	
	   			'redirect_after_save'=>'op/display_element/config_papers/1',
	   			'data_source'=>'get_detail_config',
	   			'db_save_model'=>'update_config_paper',
	   	
	   			'generate_stored_procedure'=>True,
	   				
	   			'fields'=>array(
	   					'config_id'=>array('mandatory'=>'','field_state'=>'hidden'),
	   					'import_papers_on'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
	   					'csv_field_separator'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
	   					'csv_field_separator_export'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),	   					
	   					'key_paper_prefix'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
	   					'key_paper_serial'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
						'source_papers_on'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
	   					'search_strategy_on'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
	   				
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
		
		$operations['edit_config_screening']=array(
	   			'operation_type'=>'Edit',
	   			'operation_title'=>'Edit screening configurations',
	   			'operation_description'=>'Edit screening configurations',
	   			'page_title'=>'Edit screening configurations ',
	   			'save_function'=>'op/save_element',
	   			'page_template'=>'general/frm_entity',
	   	
	   			'redirect_after_save'=>'op/display_element/config_screening/1',
	   			'data_source'=>'get_detail_config',
	   			'db_save_model'=>'update_config_screening',
	   	
	   			'generate_stored_procedure'=>True,
	   				
	   			'fields'=>array(
	   					'config_id'=>array('mandatory'=>'','field_state'=>'hidden'),
	   					'screening_on'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
	   					'screening_validation_on'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
	   					'screening_result_on'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
						'screening_reviewer_number'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
	   					'screening_conflict_type'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
	   					'screening_screening_conflict_resolution'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
	   					'validation_default_percentage'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),	   					
	   					'screening_validator_assignment_type'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
	   					  				
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
		
		$operations['edit_config_dsl']=array(
	   			'operation_type'=>'Edit',
	   			'operation_title'=>'Edit DSL configurations',
	   			'operation_description'=>'Edit DSL configurations',
	   			'page_title'=>'Edit DSL configurations ',
	   			'save_function'=>'op/save_element',
	   			'page_template'=>'general/frm_entity',
	   	
	   			'redirect_after_save'=>'op/display_element/config_dsl/1',
	   			'data_source'=>'get_detail_config',
	   			'db_save_model'=>'update_config_dsl',
	   	
	   			'generate_stored_procedure'=>True,
	   				
	   			'fields'=>array(
	   					'config_id'=>array('mandatory'=>'','field_state'=>'hidden'),
	   					'editor_url'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
	   					'editor_generated_path'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
	   					  				
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
	   	
	   	
	   	$config['operations']=$operations;
	return $config;
	
}