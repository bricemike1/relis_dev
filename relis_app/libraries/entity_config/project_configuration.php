<?php 
function get_project() {
		$config['config_id']='project';
		$config['table_name']=table_name('projects');
	   	$config['table_id']='project_id';
	   	$config['table_active_field']='project_active';//to detect deleted records
	   	$config['main_field']='project_title';
	   	
	   	
	   	$config['reference_title']='Projects';
	   	$config['reference_title_min']='Project';
	   	
	   	$config['entity_label']='User';
	   	$config['entity_label_plural']='Users';
	 
	   	//list view
	   	$config['order_by']='project_id ASC '; //mettre la valeur à mettre dans la requette
	   	$config['search_by']='project_title,project_description';// separer les champs par virgule
	  
	  
	   	 
	   	$fields['project_id']=array(
	   			'field_title'=>'#',
	   			'field_type'=>'int',
				'field_size'=>11,
	   			'field_value'=>'auto_increment',
				'default_value'=>'auto_increment',
	   			
	   	);
	   	
	   	
	   	$fields['project_label']=array(
	   			'field_title'=>'Short name',
	   			'field_type'=>'text',
	   			//'field_value'=>'normal',
	   			'field_size'=>100,
	   			'input_type'=>'text',
	   			'mandatory'=>' mandatory ',
	   			
	   			'on_add'=>'enabled',
	   			'on_edit'=>'enabled',
	   			'on_list'=>'show'
	   	);
	   	
	   	$fields['project_title']=array(
	   			'field_title'=>'Title',
	   			'field_type'=>'text',
	   			//'field_value'=>'normal',
	   			
	   			'field_size'=>250,
	   			'mandatory'=>' mandatory ',
	   			'input_type'=>'text',
	   			
	   			'on_add'=>'enabled',
	   			'on_edit'=>'enabled',
	   			'on_list'=>'show',
	   	);
	   	$fields['project_description']=array(
	   			'field_title'=>'Description',
	   			'field_type'=>'text',
	   			'field_value'=>'',
	   			
	   			'field_size'=>1000,
	   			'input_type'=>'textarea',
	   			
	   			'on_add'=>'enabled',
	   			'on_edit'=>'enabled',
	   			'on_list'=>'show',
	   	);
	   		$fields['user_projects']=array(
			'field_title'=>'Users',
			'field_type'=>'int',
			'field_size'=>11,
			'field_value'=>'normal',			
			'input_type'=>'select',
			'input_select_source'=>'table',
			'input_select_values'=>'user_project;user_id',//the reference table and the field to be displayed
			'input_select_key_field'=>'project_id',
			'number_of_values'=>'*',
			'input_select_source_type'=>'drill_down',
			//'input_select_key_field'=>'user_id',
			'not_in_db'=>True,
				
			//'multi-select' => 'Yes'
			
			
			
	);
	   	
	   	$fields['project_creator']=array(
	   			'field_title'=>'Created by',
	   			'field_type'=>'number',
				'field_size'=>11,
				
	   			'field_value'=>active_user_id(),
	   			
	   			'input_type'=>'select',
	   			'input_select_source'=>'table',
	   			'input_select_values'=>'users;user_name',//the reference table and the field to be displayed
				'mandatory'=>' mandatory ',
				
				
				'on_add'=>'hidden',
				'on_edit'=>'not_set',
				'on_list'=>'show'
	   	);
	   	
	   	$fields['project_icon']=array(
	   			'field_title'=>'Icon',
	   			'field_type'=>'image',
				//'field_size'=>200,
				//'field_value'=>'normal',			
				'input_type'=>'image',
				
				
				'on_list'=>'hidden',
				'on_add'=>'enabled',
				'on_edit'=>'enabled',
	   	);
	   	$fields['creation_time']=array(
	   			'field_title'=>'Creation time',
	   			'field_type'=>'time',
	   			'default_value'=>'CURRENT_TIMESTAMP',
	   			'field_value'=>bm_current_time('Y-m-d H:i:s'),
	   			 
	   			'field_size'=>20,
	   			'mandatory'=>' mandatory ',
	   	
	   			'on_add'=>'not_set',
	   			'on_edit'=>'not_set',
	   			'on_add'=>'not_set',
	   			'on_edit'=>'not_set',
	   			'on_list'=>'show',
	   	);
	   	$fields['project_active']=array(
	   			'field_title'=>'Active',
	   			'field_type'=>'int',
	   			'field_size'=>'1',
	   			'field_value'=>'1',
				'default_value'=>'1',
				
				
	   			'on_add'=>'not_set',
	   			'on_edit'=>'not_set',
				'on_view'=>'hidden',
	   			'on_list'=>'hidden'
	   	);
	   	$config['fields']=$fields;
	   	
	   	
	   	$operations['edit_project']=array(
	   			'operation_type'=>'Edit',
	   			'operation_title'=>'Edit project',
	   			'operation_description'=>'Edit project',
	   			'page_title'=>'Edit project ',
	   			'save_function'=>'op/save_element',
	   			'page_template'=>'general/frm_entity',
	   			'redirect_after_save'=>'op/entity_list/list_projects',
	   			'redirect_after_save'=>'manager/projects_list',
	   			'data_source'=>'get_project_detail',
	   			'db_save_model'=>'update_projects',
	   	
	   			'generate_stored_procedure'=>True,
	   				
	   			'fields'=>array(
	   					'project_id'=>array('mandatory'=>'','field_state'=>'hidden'),	   				
	   					'project_label'=>array('mandatory'=>'mandatory','field_state'=>'disabled'),
	   					'project_title'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
	   					'project_description'=>array('mandatory'=>'','field_state'=>'enabled'),
	   					'project_icon'=>array('mandatory'=>'','field_state'=>'enabled'),
	   						
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
		
		
			$operations['add_project']=array(
	   			'operation_type'=>'Add',
	   			'operation_title'=>'Add a project',
	   			'operation_description'=>'Add a project',
	   			'page_title'=>'Add new project ',
	   			'save_function'=>'op/save_element',
	   			'page_template'=>'general/frm_entity',
				'redirect_after_save'=>'op/entity_list/list_projects',
				'db_save_model'=>'add_project',
	   	
	   			'generate_stored_procedure'=>True,
	   				
	   			'fields'=>array(
	   					'project_id'=>array('mandatory'=>'','field_state'=>'hidden'),
						'project_creator'=>array('mandatory'=>'','field_state'=>'hidden'),
	   					'project_label'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
	   					'project_title'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
	   					'project_description'=>array('mandatory'=>'','field_state'=>'enabled'),
						'project_icon'=>array('mandatory'=>'','field_state'=>'enabled'),
	   						
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
	   	
	   	$operations['list_projects']=array(
	   			'operation_type'=>'List',
	   			'operation_title'=>'List of projects',
	   			'operation_description'=>'List projects',
	   			'page_title'=>'List of projects',
	   		  
	   			'page_template'=>'general/list',
	   		  
	   			'data_source'=>'get_list_projects',
	   			'generate_stored_procedure'=>True,
	   	
	   			'fields'=>array(
	   					'project_id'=>array(),
	   					'project_label'=>array(),
	   					'project_title'=>array(),
	   					'project_creator'=>array(),
	   					'user_projects'=>array(),
	   					'creation_time'=>array()
	   		   	
	   	
	   			),
	   			'order_by'=>'project_title ASC ',
	   			'search_by'=>'project_title',
	   			 
	   			 
	   			'list_links'=>array(
	   					'view'=>array(
									'label'=>'View',
									'title'=>'Disaly element',
									'icon'=>'folder',
									'url'=>'op/display_element/detail_project/',
								),
						'edit'=>array(
									'label'=>'Edit',
									'title'=>'Edit',
									'icon'=>'edit',
									'url'=>'op/edit_element/edit_project/',
								),
						'delete'=>array(
									'label'=>'Delete',
									'title'=>'Delete the user',
									'url'=>'op/delete_element/remove_project/'
								)
	   					 
	   			),
	   		  
	   			'top_links'=>array(
							'add'=>array(
										'label'=>'',
										'title'=>'Add a new project',
										'icon'=>'add',
										'url'=>'op/add_element/add_project',
									),
							'close'=>array(
										'label'=>'',
										'title'=>'Close',
										'icon'=>'add',
										'url'=>'home',
									)
				
				),
	   	);
		
		
		$operations['detail_project']=array(
				'operation_type'=>'Detail',
				'operation_title'=>'Characteristics of a project',
				'operation_description'=>'Characteristics of a project',
				'page_title'=>'Project ',
				
				//'page_template'=>'general/display_element',
				
				'data_source'=>'get_project_detail',
				'generate_stored_procedure'=>True,
					
				'fields'=>array(
					//	'project_id'=>array(),
	   					'project_label'=>array(),
	   					'project_title'=>array(),
						'project_description'=>array(),
	   					'project_creator'=>array(),
	   					'creation_time'=>array(),
						
						'project_icon'=>array(),
						'user_projects'=>array(
									//'drilldown_add_link'=>'op/add_element_child/project_to_user/',
									//'drilldown_edit_link'=>'op/display_element/detail_project/',
									//'drilldown_remove_link'=>'op/delete_element/remove_userproject_p/',
									//'drilldown_display_link'=>'op/display_element/detail_userproject/',
									
									),
							
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
		
		$operations['remove_project']=array(
				'operation_type'=>'Remove',
				'operation_title'=>'Remove project',
				'operation_description'=>'Remove a project',
				'redirect_after_delete'=>'op/entity_list/list_projects',
				'db_delete_model'=>'remove_project',
				'generate_stored_procedure'=>True,
					
				
		);
	   	$config['operations']=$operations;
	
	return $config;
	
}