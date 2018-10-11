<?php 
function get_paper_author() {
	$config['config_id']='paper_author';
		$config['table_name']='paperauthor';
	   	$config['table_id']='paperauthor_id';
	   	$config['table_active_field']='paperauthor_active';//to detect deleted records
	   
	   	
	   	$config['entity_label']='Paper author';
	   	$config['entity_label_plural']='Paper authors';
	   	
	   	
	   	//Concerne l'affichage
	   		  
	   	$config['order_by']='paperauthor_id ASC '; //mettre la valeur à mettre dans la requette
	   
	   	
	   	
	   	$fields['paperauthor_id']=array(
	   			'field_title'=>'#',
	   			'field_type'=>'int',
				'field_size'=>11,
	   			'field_value'=>'auto_increment',
				'default_value'=>'auto_increment',
	   			'on_add'=>'hidden'
	   	);
	   
	   	$fields['paperId']=array(
	   			'field_title'=>'Paper',
	   			'field_type'=>'int',	   			
	   			'field_size'=>11,
	   			'mandatory'=>' mandatory ',
	   			'input_type'=>'select',
	   			'input_select_source'=>'table',
				'input_select_source_type'=>'drill_down',
				'drill_down_type'=>'not_linked',
	   			'input_select_values'=>'papers;title',
	   			'on_add'=>'hidden'
	   			
	   	);
	   	
		$fields['authorId']=array(
	   			'field_title'=>'Author',
	   			'field_type'=>'int',	   			
	   			'field_size'=>11,
	   			'mandatory'=>' mandatory ',
	   			'input_type'=>'select',
	   			'input_select_source'=>'table',
				'input_select_source_type'=>'drill_down',
				'drill_down_type'=>'not_linked',
	   			'input_select_values'=>'author;author_name',
				'on_add'=>'hidden'
				
		);
	
		
		$fields['author_rank']=array(
	   			'field_title'=>'Rank',
	   			'field_type'=>'number', 				
				'field_size'=>2,  	   			
				'input_type'=>'text',
				'field_value'=>'1',
				'default_value'=>'1',
				'mandatory'=>' mandatory ' ,
				'on_add'=>'hidden'
						
	   	);
	   	
		$fields['paperauthor_active']=array(
	   			'field_title'=>'Active',
	   			'field_type'=>'int',
	   			'field_size'=>'1',
	   			'field_value'=>'1',
				'default_value'=>'1',
				'on_add'=>'hidden'
	   	);
		
		$operations=array();
		
			$operations['add_paper_author']=array(
	   			'operation_type'=>'Add',
	   			'operation_title'=>'New paper author',
	   			'operation_description'=>'New paper author',
	   			'page_title'=>'New paper author',
	   			'save_function'=>'op/save_element',
	   			'page_template'=>'general/frm_entity',
	   			'redirect_after_save'=>'op/entity_list/list_papers',
	   			'db_save_model'=>'add_paper_author',
	   		  
	   			'generate_stored_procedure'=>True,
	   	
	   			'fields'=>array(
	   					'paperauthor_id'=>array('mandatory'=>'','field_state'=>'hidden'),
	   					'paperId'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
	   					'authorId'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
	   					'author_rank'=>array('mandatory'=>'mandatory','field_state'=>'enabled'),
	   					'paperauthor_active'=>array('mandatory'=>'mandatory','field_state'=>'enabled')
	   	
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
		$config['operations']=$operations;
	   	$config['fields']=$fields;
	   	
	
	return $config;
	
}