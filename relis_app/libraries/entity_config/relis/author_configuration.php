<?php 
function get_author() {
	$config['config_id']='author';
	$config['table_name']='author';
	$config['table_id']='author_id';
	$config['table_active_field']='author_active';
	$config['main_field']='author_name';
	
	
	$config['entity_label_plural']='Authors';
	$config['entity_label']='Author';
	
	//list view
	$config['order_by']=' author_name ASC '; //mettre la valeur à mettre dans la requette
	
	
	$fields['author_id']=array(
			'field_title'=>'#',
			'field_type'=>'int',
			'field_size'=>11,
	   		'field_value'=>'auto_increment',
			'default_value'=>'auto_increment'
	);
	
	$fields['author_name']=array(
			'field_title'=>'Name',
			'field_type'=>'text',	   						
			'field_size'=>50,	   			
			'input_type'=>'text', 
			'mandatory'=>' mandatory '
	);
	
	$fields['author_desc']=array(
			'field_title'=>'Description',
			'field_type'=>'text',	   						
			'field_size'=>200,	   			
			'input_type'=>'text', 
			'input_type'=>'textarea'
	);
	
	
	$fields['author_picture']=array(
			'field_title'=>'Picture',
			'field_type'=>'image',
			'input_type'=>'image',
	);
	
	$fields['author_active']=array(
			'field_title'=>'Active',
	   		'field_type'=>'int',
	   		'field_size'=>'1',
	   		'field_value'=>'1',
			'default_value'=>'1'
	);
	$config['fields']=$fields;
	
	
	$operations['add_author']=array(
			'operation_type'=>'Add',
			'operation_title'=>'Add a new author',
			'operation_description'=>'Add a new author',
			'page_title'=>'Add a new author',
			'save_function'=>'op/save_element',
			'page_template'=>'general/frm_entity',
			'redirect_after_save'=>'op/entity_list/list_authors',
			'db_save_model'=>'add_author',
	
			'generate_stored_procedure'=>True,
				
			'fields'=>array(
					'author_id'=>array('mandatory'=>'','field_state'=>'hidden'),
					'author_name'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
					'author_desc'=>array('mandatory'=>'','field_state'=>'enabled'),
					'author_picture'=>array('mandatory'=>'','field_state'=>'enabled')					
						
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
	
	
	
	$operations['edit_author']=array(
			'operation_type'=>'Edit',
			'operation_title'=>'Edit author',
			'operation_description'=>'Edit author',
			'page_title'=>'Edit author ',
			'save_function'=>'op/save_element',
			'page_template'=>'general/frm_entity',
	
			'redirect_after_save'=>'op/entity_list/list_authors',
			'data_source'=>'get_detail_author',
			'db_save_model'=>'update_author',
	
			'generate_stored_procedure'=>True,
				
			'fields'=>array(
					'author_id'=>array('mandatory'=>'','field_state'=>'hidden'),
					'author_name'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
					'author_desc'=>array('mandatory'=>'','field_state'=>'enabled'),
					'author_picture'=>array('mandatory'=>'','field_state'=>'enabled')	
						
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
	
	$operations['list_authors']=array(
			'operation_type'=>'List',
			'operation_title'=>'List authors',
			'operation_description'=>'List authors',
			'page_title'=>'List authors',
	
			//'page_template'=>'list',
	
			'data_source'=>'get_list_authors',
			'generate_stored_procedure'=>True,
				
			'fields'=>array(
					'author_id'=>array(),
					'author_name'=>array(),
					'author_desc'=>array()
						
			),
			'order_by'=>'author_name ASC ',
			//'search_by'=>'author_name',
		
			'list_links'=>array(
					'view'=>array(
							'label'=>'View',
							'title'=>'Disaly element',
							'icon'=>'folder',
							'url'=>'op/display_element/detail_author/',
					),
					'edit'=>array(
							'label'=>'Edit',
							'title'=>'Edit',
							'icon'=>'edit',
							'url'=>'op/edit_element/edit_author/',
					),
					'delete'=>array(
							'label'=>'Delete',
							'title'=>'Delete the user',
							'url'=>'op/delete_element/remove_author/'
					)
	
			),
	
			'top_links'=>array(
					'add'=>array(
							'label'=>'',
							'title'=>'Add a new author',
							'icon'=>'add',
							'url'=>'op/add_element/add_author',
					),
					'back'=>array(
							'label'=>'',
							'title'=>'Close',
							'icon'=>'add',
							'url'=>'home',
					)
	
			),
	);
	
	$operations['detail_author']=array(
			'operation_type'=>'Detail',
			'operation_title'=>'Characteristics of an author',
			'operation_description'=>'Characteristics of an author',
			'page_title'=>'Author ',
	
			'data_source'=>'get_detail_author',
			'generate_stored_procedure'=>True,
				
			'fields'=>array(
					'author_name'=>array(),
					'author_desc'=>array(),
					'author_picture'=>array()
											
			),
	
	
			'top_links'=>array(
					'edit'=>array(
							'label'=>'',
							'title'=>'Edit',
							'icon'=>'edit',
							'url'=>'op/edit_element/edit_author/~current_element~',
					),
					'back'=>array(
							'label'=>'',
							'title'=>'Close',
							'icon'=>'add',
							'url'=>'home',
					),
	
	
	
			),
	);
	
	
	$operations['remove_author']=array(
			'operation_type'=>'Remove',
			'operation_title'=>'Remove an author',
			'operation_description'=>'Remove an author from the displayed list',
			'redirect_after_delete'=>'op/entity_list/list_authors',
			'db_delete_model'=>'remove_author',
			'generate_stored_procedure'=>True,
				
	
	);
	
	$config['operations']=$operations;
	
	return $config;
	
}