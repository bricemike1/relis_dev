<?php 
function get_papers() {
	$config['config_id']='papers';
	$config['table_name']='paper';
	$config['table_id']='id';
	$config['table_active_field']='paper_active';
	
	$config['entity_label_plural']='Papers';
	$config['entity_label']='Paper';
	
	
	
	
	//list view
	$config['order_by']=' id ASC '; //mettre la valeur à mettre dans la requette
	$config['search_by']='bibtexKey,title,preview,abstract';// separer les champs par virgule
	

	$fields['id']=array(
			'field_title'=>'#',
			'field_type'=>'int',
			'field_size'=>11,
	   		'field_value'=>'auto_increment',
			'default_value'=>'auto_increment'
	);
	
	$fields['bibtexKey']=array(
			'field_title'=>'Key',
			'field_type'=>'text',	   						
			'field_size'=>30,	   			
			'input_type'=>'text', 
			'mandatory'=>' mandatory '
	);
	
	$fields['title']=array(
			'field_title'=>'Title',
			'field_type'=>'text',	   						
			'field_size'=>200,	   			
			'input_type'=>'text', 
			'mandatory'=>' mandatory '
	);
	
	
	$fields['preview']=array(
			'field_title'=>'Preview',
			'field_type'=>'longtext',	   						
			'field_size'=>2000,	   			
			'input_type'=>'textarea'
	);
	$fields['bibtex']=array(
			'field_title'=>'Bibtex',
			'field_type'=>'longtext',	   						
			'field_size'=>2000,	   			
			'input_type'=>'textarea'
	);
	$fields['abstract']=array(
			'field_title'=>'Abstract',
			'field_type'=>'longtext',	   						
			'field_size'=>2000,	   			
			'input_type'=>'textarea'
	);
	
	$fields['doi']=array(
			'field_title'=>'Link',
			'field_type'=>'text',	   						
			'field_size'=>200,	   			
			'input_type'=>'text', 
	);
	$fields['year']=array(
			'field_title'=>'Year',
			'field_type'=>'int',
			'field_size'=>4,
			'input_type'=>'text'
	);
	$fields['venueId']=array(
			'field_title'=>'Venue',
			'field_type'=>'int',
			'field_size'=>11,
			'input_type'=>'select',
			'input_select_source'=>'table',
			'input_select_values'=>'venue;venue_fullName',//the reference table and the field to be displayed
			'input_select_source_type'=>'drill_down',
			'drill_down_type'=>'not_linked',
				
	);
	$fields['papers_sources']=array(
			'field_title'=>'Source',
			'field_type'=>'int',
			'field_size'=>11,
			'input_type'=>'select',
			'input_select_source'=>'table',
			'input_select_values'=>'papers_sources;ref_value',//the reference table and the field to be displayed
			//'input_select_source_type'=>'drill_down',
			//'drill_down_type'=>'not_linked',
			
	);
	
	$fields['search_strategy']=array(
			'field_title'=>'Search strategy used ',
			'field_type'=>'int',
			'field_size'=>11,
			'input_type'=>'select',
			'input_select_source'=>'table',
			'input_select_values'=>'search_strategy;ref_value',//the reference table and the field to be displayed
			//'input_select_source_type'=>'drill_down',
			//'drill_down_type'=>'not_linked',
				
	);
	
	 $fields['authors']=array(
	 'field_title'=>'Authors',
	 'field_type'=>'int',
	 'field_size'=>11,
	 //'field_value'=>'normal',
	 'input_type'=>'select',
	 'input_select_source'=>'table',
	 'input_select_source_type'=>'drill_down',//drill_down
	 'input_select_values'=>'paper_author;authorId',//the reference table and the field to be displayed
	 'input_select_key_field'=>'paperId',
	 'number_of_values'=>'*',
	 'category_type'=>'WithMultiValues',
	 'multi-select' => 'Yes',
	 'not_in_db'=>True,	
	 );
	 
	
	
	$fields['added_by']=array(
			'field_title'=>'Added by',
			'field_type'=>'number',
			'field_size'=>11,
	
			'field_value'=>active_user_id(),// the default values (may be put it in operation)
			 
			'input_type'=>'select',
			'input_select_source'=>'table',
			'input_select_values'=>'users;user_name',//the reference table and the field to be displayed
			
	);
	
	$fields['add_time']=array(
			'field_title'=>'Add time',
			'field_type'=>'time',
			'default_value'=>'CURRENT_TIMESTAMP',
			'field_value'=>bm_current_time('Y-m-d H:i:s'),
			 
			'field_size'=>20,
			'mandatory'=>' mandatory ',
	
	);
	
	$fields['addition_mode']=array(
			'field_title'=>'Add mode',
			'field_type'=>'text',
				
			'field_size'=>20,
			'input_type'=>'select',
			'input_select_source'=>'array',
			'input_select_values'=>array('Automatic'=>'Automatic',
					'Manually' => 'Manually'
			),
			'mandatory'=>' mandatory ',
			'field_value'=>'Manually',
			'default_value'=>'Manually'
		
	);

	$fields['added_active_phase']=array(
			'field_title'=>'Screening status',
			'field_type'=>'text',
	
			'field_size'=>20,
			'input_type'=>'text',
			'mandatory'=>' mandatory ',
			'field_value'=>'Init',
			'default_value'=>'Init'
	);
	$fields['screening_status']=array(
			'field_title'=>'Screening status',
			'field_type'=>'text',
			
			'field_size'=>20,
			'input_type'=>'select',
			'input_select_source'=>'array',
			'input_select_values'=>array('Pending'=>'Pending',
					'In review' => 'In review',
					'Included' => 'Included',
					'Excluded' => 'Excluded',
					'In conflict' => 'In conflict',
					'Resolved included' => 'Resolved included',
					'Resolved excluded' => 'Resolved excluded'				
			),
			'mandatory'=>' mandatory ',
			'field_value'=>'Pending',
			'default_value'=>'Pending'
			
	);
	
	$fields['classification_status']=array(
			'field_title'=>'Screening status',
			'field_type'=>'text',
			
			'field_size'=>20,
			'input_type'=>'select',
			'input_select_source'=>'array',
			'input_select_values'=>array('Waiting'=>'Waiting',
					'To classify' => 'To classify',
					'Classified' => 'Classified'
			),
			'mandatory'=>' mandatory ',
			'field_value'=>'Waiting',
			'default_value'=>'Waiting'
	);
	
	
	$fields['paper_excluded']=array(
			'field_title'=>'Paper excluded',
			'field_type'=>'int',
	   		'field_size'=>'1',
	   		'field_value'=>'0',
			'default_value'=>'0',
			'input_type'=>'select',
			'input_select_source'=>'yes_no',
	);
	
	$fields['operation_code']=array( //used  papers are imported in bulk in order to reverse the operation 
			'field_title'=>'Operation code',
			'field_type'=>'text',
			'field_size'=>20,
			'field_value'=>'01',
			'default_value'=> '01',
			'input_type'=>'text',
	);
	
	$fields['classification_status']=array(
			'field_title'=>'Screening status',
			'field_type'=>'text',
				
			'field_size'=>20,
			'input_type'=>'select',
			'input_select_source'=>'array',
			'input_select_values'=>array('Waiting'=>'Waiting',
					'To classify' => 'To classify',
					'Classified' => 'Classified'
			),
			'mandatory'=>' mandatory ',
			'field_value'=>'Waiting',
			'default_value'=>'Waiting'
	);
	$fields['paper_active']=array(
			'field_title'=>'Active',
	   		'field_type'=>'int',
	   		'field_size'=>'1',
	   		'field_value'=>'1',
			'default_value'=>'1'
	);
	$config['fields']=$fields;
	
	


	$operations['add_paper']=array(
			'operation_type'=>'Add',
			'operation_title'=>'Add a new paper',
			'operation_description'=>'Add a new paper',
			'page_title'=>'Add a new paper',
			'save_function'=>'op/save_element',
			'page_template'=>'general/frm_entity',
			'redirect_after_save'=>'op/entity_list/list_papers',
			'db_save_model'=>'add_paper',
		  
			'generate_stored_procedure'=>True,
		  
			'fields'=>array(
					'id'=>array('mandatory'=>'','field_state'=>'hidden'),
					'added_by'=>array('mandatory'=>'','field_state'=>'hidden'),
					'bibtexKey'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
					'title'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
					'doi'=>array('mandatory'=>'','field_state'=>'enabled'),
					'year'=>array('mandatory'=>'','field_state'=>'enabled'),
					'venueId'=>array('mandatory'=>'','field_state'=>'enabled'),
					'authors'=>array('mandatory'=>'','field_state'=>'enabled'),
					'preview'=>array('mandatory'=>'','field_state'=>'enabled'),
					'bibtex'=>array('mandatory'=>'','field_state'=>'enabled'),
					'abstract'=>array('mandatory'=>'','field_state'=>'enabled'),
					'papers_sources'=>array('mandatory'=>'','field_state'=>'enabled'),
					'search_strategy'=>array('mandatory'=>'','field_state'=>'enabled'),
					 
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
	 if(!(get_appconfig_element('source_papers_on'))){
		 $operations['add_paper']['fields']['papers_sources']['field_state']='hidden';
	 }
	  if(!(get_appconfig_element('search_strategy_on'))){
		 $operations['add_paper']['fields']['search_strategy']['field_state']='hidden';
	 }
	 
	$operations['edit_paper']=array(
			'operation_type'=>'Edit',
			'operation_title'=>'Edit paper',
			'operation_description'=>'Edit paper',
			'page_title'=>'Edit paper ',
			'save_function'=>'op/save_element',
			'page_template'=>'general/frm_entity',
		  
			'redirect_after_save'=>'op/entity_list/list_papers',
			'data_source'=>'get_detail_paper',
			'db_save_model'=>'update_paper',
		  
			'generate_stored_procedure'=>True,
		  
			'fields'=>array(
					'id'=>array('mandatory'=>'','field_state'=>'hidden'),
					'bibtexKey'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
					'title'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
					'doi'=>array('mandatory'=>'','field_state'=>'enabled'),
					'year'=>array('mandatory'=>'','field_state'=>'enabled'),
					'venueId'=>array('mandatory'=>'','field_state'=>'enabled'),
					'authors'=>array('mandatory'=>'','field_state'=>'enabled'),
					'preview'=>array('mandatory'=>'','field_state'=>'enabled'),
					'bibtex'=>array('mandatory'=>'','field_state'=>'enabled'),
					'abstract'=>array('mandatory'=>'','field_state'=>'enabled'),
					'papers_sources'=>array('mandatory'=>'','field_state'=>'enabled'),
					'search_strategy'=>array('mandatory'=>'','field_state'=>'enabled'),
					 
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
	  if(!(get_appconfig_element('source_papers_on'))){
		 $operations['edit_paper']['fields']['papers_sources']['field_state']='hidden';
	 }
	  if(!(get_appconfig_element('search_strategy_on'))){
		 $operations['edit_paper']['fields']['search_strategy']['field_state']='hidden';
	 }
	$operations['list_papers']=array(
			'operation_type'=>'List',
			'operation_title'=>'List papers',
			'operation_description'=>'List papers',
			'page_title'=>'List papers',
		  
			//'page_template'=>'list',
		  
			'data_source'=>'get_list_papers',
			'generate_stored_procedure'=>True,
		  
			'fields'=>array(
					'id'=>array(),
					'bibtexKey'=>array(),
					'title'=>array(),
					'authors'=>array(),
					'year'=>array(),
					'papers_sources'=>array(),
					'search_strategy'=>array(),
					 
			),
			'order_by'=>'id ASC ',
			'search_by'=>'bibtexKey,title,preview,abstract',
			'conditions'=>array(
					'excluded '=>array(
							'field'=>'paper_excluded',
							'value'=>'0',
							'evaluation'=>'equal',
							'add_on_generation'=>False,
							'parameter_type'=>'VARCHAR(2)'
					)
			
			),
			'list_links'=>array(
					'view'=>array(
							'label'=>'View',
							'title'=>'Disaly element',
							'icon'=>'folder',
							'url'=>'op/display_element/detail_paper/',
					),
					'edit'=>array(
							'label'=>'Edit',
							'title'=>'Edit',
							'icon'=>'edit',
							'url'=>'op/edit_element/edit_paper/',
					),
					'delete'=>array(
							'label'=>'Delete',
							'title'=>'Delete the user',
							'url'=>'op/delete_element/remove_paper/'
					)
					 
			),
		  
			'top_links'=>array(
					'add'=>array(
							'label'=>'',
							'title'=>'Add a new paper',
							'icon'=>'add',
							'url'=>'op/add_element/add_paper',
					),
					'back'=>array(
							'label'=>'',
							'title'=>'Close',
							'icon'=>'add',
							'url'=>'home',
					)
					 
			),
	);
	 
	$operations['detail_paper']=array(
			'operation_type'=>'Detail',
			'operation_title'=>'Characteristics of a paper',
			'operation_description'=>'Characteristics of a paper',
			'page_title'=>'Paper ',
		  
			'data_source'=>'get_detail_paper',
			'generate_stored_procedure'=>True,
		  
			'fields'=>array(
					'bibtexKey'=>array(),
					'title'=>array(),
					'doi'=>array(),
					'year'=>array('diplay_null'=>FALSE),
					'authors'=>array(),
					'venueId'=>array(),
					'preview'=>array(),
					'bibtex'=>array(),
					'abstract'=>array(),
					'papers_sources'=>array(),
					'search_strategy'=>array(),
					'added_by'=>array(),
					'add_time'=>array(),
					'addition_mode'=>array(),
	
			),
		  
		  
			'top_links'=>array(
					'edit'=>array(
							'label'=>'',
							'title'=>'Edit',
							'icon'=>'edit',
							'url'=>'op/edit_element/edit_paper/~current_element~',
					),
					'back'=>array(
							'label'=>'',
							'title'=>'Close',
							'icon'=>'add',
							'url'=>'home',
					),
					 
					 
					 
			),
	);
	 if((get_appconfig_element('detail_paper'))){
		 $operations['detail_paper']['fields']['papers_sources']=array();
	 }
	  if(!(get_appconfig_element('search_strategy_on'))){
		 $operations['detail_paper']['fields']['search_strategy']=array();
	 }
	 
	$operations['remove_paper']=array(
			'operation_type'=>'Remove',
			'operation_title'=>'Remove a paper',
			'operation_description'=>'Remove an paper from the displayed list',
			'redirect_after_delete'=>'op/entity_list/list_papers',
			'db_delete_model'=>'remove_paper',
			'generate_stored_procedure'=>True,
		  
		  
	);
	 
	 
	$config['operations']=$operations;
	
	return $config;
	
}