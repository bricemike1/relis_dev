<?php //mt_test_depend
function get_classification_mt_test_depend(){
$reference_tables=array();//from nowit will worklike this
$config=array();
$result['project_title']='MDE Test';
$result['project_short_name']='mt_test_depend';
$config['classification']['table_name']='classification';
$config['classification']['table_id']='class_id';
$config['classification']['table_active_field']='class_active';
$config['classification']['reference_title']='Classifications';
$config['classification']['reference_title_min']='Classification';
$config['classification']['main_field']='class_paper_id';
$config['classification']['order_by']='class_id ASC ';
$config['classification']['links'][ 'edit']=array(
	   			'label'=>'Edit',
	   			'title'=>'Edit classification',
	   			'on_list'=>False,
	   			'on_view'=>True
	   	);

$config['classification']['links'][ 'view']=array(
	   			'label'=>'View',
	   			'title'=>'View',
	   			'on_list'=>True,
	   			'on_view'=>True
	   	);

$config['classification']['fields'][ 'class_id']=array(
	   			'field_title'=>'#',
	   			'field_type'=>'number',
	   			'field_value'=>'auto_increment',
	   			'on_add'=>'hidden',
	   			'on_edit'=>'hidden',
	   			'on_list'=>'show',
	   			'on_view'=>'hidden',
	   	);

$config['classification']['fields'][ 'class_paper_id']=array(
	   			'field_title'=>'Paper',
	   			'field_type'=>'number',
	   			'field_value'=>'normal',
				'input_type'=>'select',
				'input_select_source'=>'table',
				'input_select_values'=>'papers;CONCAT_WS(" - ",bibtexKey,title)',
				'field_size'=>11,
				'mandatory'=>' mandatory ',
	   			'on_add'=>'enabled',
	   			'on_edit'=>'enabled',
	   			'on_list'=>'show'
	   	);
//project specific area


$config['classification']['fields'][ 'transformation_name']=array( 		
	'category_type'=>'FreeCategory',		
 	'field_title'=>'Transformation name',
 	'field_type'=>'text',
 	'field_value'=>'normal',
 	'number_of_values'=>'1',//a verifier
 	'mandatory'=>' mandatory ',
 	'field_size'=>100,
 	'input_type'=>'text',
 	'pattern'=>'',
 	'initial_value'=>'',
 	'on_add'=>'enabled',
 	'on_edit'=>'enabled',
 	'on_list'=>'show'				
 	);   	
$config['intent']['table_name']='intent';
$config['intent']['table_id']='intent_id';
$config['intent']['table_active_field']='intent_active';
$config['intent']['reference_title']='Intent';
$config['intent']['reference_title_min']='Intent';
$config['intent']['main_field']='intent';
$config['intent']['order_by']='intent_id ASC ';
$config['intent']['links'][ 'edit']=array(
	   			'label'=>'Edit',
	   			'title'=>'Edit ',
	   			'on_list'=>False,
	   			'on_view'=>True
	   	);

$config['intent']['links'][ 'view']=array(
	   			'label'=>'View',
	   			'title'=>'View',
	   			'on_list'=>True,
	   			'on_view'=>True
	   	);
$config['intent']['fields']['intent_id']=array(
			   	'field_title'=>'#',
			   	'field_type'=>'number',
			   	'field_value'=>'auto_increment',
			   	'on_add'=>'hidden',
			   	'on_edit'=>'hidden',
			   	'on_list'=>'show',
			   	'on_view'=>'hidden'
			   	);
$config['intent']['fields']['parent_field_id']=array(
					   	'category_type'=>'ParentExternalKey',
					   	'field_title'=>'Parent',
					   	'field_type'=>'number',
					   	'field_value'=>'normal',
					   	'field_size'=>11,
					   	'mandatory'=>' mandatory ',
					   	'input_type'=>'select',
					   	'input_select_source'=>'table',
					   	'input_select_values'=>'classification',
					   	'compute_result'=>'no',
					   	'on_add'=>'hidden',
					   	'on_edit'=>'hidden',
					   	'on_list'=>'hidden',
					   	'on_view'=>'hidden'
				);
				
$config['intent']['fields'][ 'intent']=array( 		
	'category_type'=>'IndependantDynamicCategory',		
 	'field_title'=>'Intent',	
 	'field_type'=>'number',
 	'field_value'=>'normal',
 	'number_of_values'=>'1',//a verifier
 	'field_size'=>11,
 	'input_type'=>'select',
 	'input_select_source'=>'table',
 	'input_select_values'=>'Intents',
 	'on_add'=>'enabled',
 	'on_edit'=>'enabled',
 	'on_list'=>'show'				
 				);
 	$reference_tables['Intents']['ref_name'] ='Intents';   
 	$initial_values=array();
 	array_push($initial_values, "Translation");
 	array_push($initial_values, "Simulation");
 	array_push($initial_values, "Migration");
 	array_push($initial_values, "Composition");
 	if(empty($reference_tables['Intents']['values'])){
 		$reference_tables['Intents']['values'] =	$initial_values;
 	}else{
 		foreach ($initial_values as $key => $value) {
 			if (!in_array($value, $reference_tables['Intents']['values'] )){
 				array_push($reference_tables['Intents']['values'],$value);
 			}
 		}		
 	}
 		
 		

$config['intent']['fields'][ 'name_used']=array( 		
	'category_type'=>'FreeCategory',		
 	'field_title'=>'Name used by the author',
 	'field_type'=>'text',
 	'field_value'=>'normal',
 	'number_of_values'=>'0',//a verifier
 	'field_size'=>100,
 	'input_type'=>'text',
 	'pattern'=>'',
 	'initial_value'=>'',
 	'on_add'=>'enabled',
 	'on_edit'=>'enabled',
 	'on_list'=>'show'				
 	);   	

$config['intent']['fields'][ 'note']=array( 		
	'category_type'=>'FreeCategory',		
 	'field_title'=>'Note',
 	'field_type'=>'text',
 	'field_value'=>'normal',
 	'number_of_values'=>'0',//a verifier
 	'field_size'=>500,
 	'input_type'=>'textarea',
 	'pattern'=>'',
 	'initial_value'=>'',
 	'on_add'=>'enabled',
 	'on_edit'=>'enabled',
 	'on_list'=>'show'				
 	);   	
$config['intent']['fields']['intent_active']=array(
					   	'field_title'=>'Active',
					   	'field_type'=>'0_1',
					   	'field_value'=>'normal',				
					   	'on_add'=>'not_set',
					   	'on_edit'=>'not_set',
					   	'on_list'=>'hidden',
					   	'on_view'=>'hidden'
			);
			
$config['classification']['fields'][ 'intent']=array( 		
	'category_type'=>'WithSubCategories',		
 	'field_title'=>'Intent',	
 	'field_type'=>'number',
 	'field_value'=>'normal',
'number_of_values'=>'1',//a verifier
 	'field_size'=>11,
 	'input_type'=>'select',
 	'input_select_source'=>'table',
 	'input_select_source_type'=>'drill_down',
 	'input_select_values'=>'intent',
 	'input_select_key_field'=>'parent_field_id',
 	'compute_result'=>'no',
 	'multi-select' => 'no',
 	'on_list'=>'hidden',
 	'on_add'=>'not_set',
 	'on_edit'=>'not_set'			
 				);			

$config['intent_relation']['table_name']='intent_relation';
$config['intent_relation']['table_id']='intent_relation_id';
$config['intent_relation']['table_active_field']='intent_relation_active';
$config['intent_relation']['reference_title']='Intent relation';
$config['intent_relation']['reference_title_min']='Intent relation';
$config['intent_relation']['main_field']='intent_relation';
$config['intent_relation']['order_by']='intent_relation_id ASC ';
$config['intent_relation']['links'][ 'edit']=array(
	   			'label'=>'Edit',
	   			'title'=>'Edit ',
	   			'on_list'=>False,
	   			'on_view'=>True
	   	);

$config['intent_relation']['links'][ 'view']=array(
	   			'label'=>'View',
	   			'title'=>'View',
	   			'on_list'=>True,
	   			'on_view'=>True
	   	);
$config['intent_relation']['fields']['intent_relation_id']=array(
			   	'field_title'=>'#',
			   	'field_type'=>'number',
			   	'field_value'=>'auto_increment',
			   	'on_add'=>'hidden',
			   	'on_edit'=>'hidden',
			   	'on_list'=>'show',
			   	'on_view'=>'hidden'
			   	);
$config['intent_relation']['fields']['parent_field_id']=array(
					   	'category_type'=>'ParentExternalKey',
					   	'field_title'=>'Parent',
					   	'field_type'=>'number',
					   	'field_value'=>'normal',
					   	'field_size'=>11,
					   	'mandatory'=>' mandatory ',
					   	'input_type'=>'select',
					   	'input_select_source'=>'table',
					   	'input_select_values'=>'classification',
					   	'compute_result'=>'no',
					   	'on_add'=>'hidden',
					   	'on_edit'=>'hidden',
					   	'on_list'=>'hidden',
					   	'on_view'=>'hidden'
				);
				
$config['intent_relation']['fields'][ 'intent_relation']=array( 		
	'category_type'=>'IndependantDynamicCategory',		
 	'field_title'=>'Intent relation',	
 	'field_type'=>'number',
 	'field_value'=>'normal',
 	'number_of_values'=>'0',//a verifier
 	'field_size'=>11,
 	'input_type'=>'select',
 	'input_select_source'=>'table',
 	'input_select_values'=>'Relation',
 	'on_add'=>'enabled',
 	'on_edit'=>'enabled',
 	'on_list'=>'show'				
 				);
 	$reference_tables['Relation']['ref_name'] ='Relation';   
 	$initial_values=array();
 	array_push($initial_values, "Relation 1");
 	array_push($initial_values, "Relation2");
 	array_push($initial_values, "Relation 3");
 	if(empty($reference_tables['Relation']['values'])){
 		$reference_tables['Relation']['values'] =	$initial_values;
 	}else{
 		foreach ($initial_values as $key => $value) {
 			if (!in_array($value, $reference_tables['Relation']['values'] )){
 				array_push($reference_tables['Relation']['values'],$value);
 			}
 		}		
 	}
 		
 		
$config['intent_relation']['fields'][ 'intent_1']=array( 		
	'category_type'=>'IndependantDynamicCategory',		
 	'field_title'=>'Intent 1',	
 	'field_type'=>'number',
 	'field_value'=>'normal',
 	'number_of_values'=>'0',//a verifier
 	'field_size'=>11,
 	'input_type'=>'select',
 	'input_select_source'=>'table',
 	'input_select_values'=>'Intents',
 	'on_add'=>'enabled',
 	'on_edit'=>'enabled',
 	'on_list'=>'show'				
 				);
 	$reference_tables['Intents']['ref_name'] ='Intents';   
 	$initial_values=array();
 	if(empty($reference_tables['Intents']['values'])){
 		$reference_tables['Intents']['values'] =	$initial_values;
 	}else{
 		foreach ($initial_values as $key => $value) {
 			if (!in_array($value, $reference_tables['Intents']['values'] )){
 				array_push($reference_tables['Intents']['values'],$value);
 			}
 		}		
 	}
 		
 		
$config['intent_relation']['fields'][ 'intent_2']=array( 		
	'category_type'=>'DependentDynamicCategory',		
 	'field_title'=>'Intent 2',	
 	'field_type'=>'number',
 	'field_value'=>'normal',
 	'number_of_values'=>'0',
 	'field_size'=>11,
 	'input_type'=>'select',
 	'input_select_source'=>'table',
 	'input_select_values'=>'intent',//à corriger seul les category sur le root sont supportés pour le moment
 	'on_add'=>'enabled',
 	'on_edit'=>'enabled',
 	'compute_result'=>'no',
 	'on_list'=>'show'				
 				);
 	
 		
 		
$config['intent_relation']['fields']['intent_relation_active']=array(
					   	'field_title'=>'Active',
					   	'field_type'=>'0_1',
					   	'field_value'=>'normal',				
					   	'on_add'=>'not_set',
					   	'on_edit'=>'not_set',
					   	'on_list'=>'hidden',
					   	'on_view'=>'hidden'
			);
			
$config['classification']['fields'][ 'intent_relation']=array( 		
	'category_type'=>'WithSubCategories',		
 	'field_title'=>'Intent relation',	
 	'field_type'=>'number',
 	'field_value'=>'normal',
'number_of_values'=>'1',//a verifier
 	'field_size'=>11,
 	'input_type'=>'select',
 	'input_select_source'=>'table',
 	'input_select_source_type'=>'drill_down',
 	'input_select_values'=>'intent_relation',
 	'input_select_key_field'=>'parent_field_id',
 	'compute_result'=>'no',
 	'multi-select' => 'no',
 	'on_list'=>'hidden',
 	'on_add'=>'not_set',
 	'on_edit'=>'not_set'			
 				);			


$config['classification']['fields'][ 'industrial']=array( 		
	'category_type'=>'FreeCategory',		
 	'field_title'=>'Industrial',
 	'field_type'=>'text',
 	'field_value'=>'normal',
 	'number_of_values'=>'1',//a verifier
 	'field_size'=>11,
 	'field_value'=>'0_1',
 	'field_size'=>1,
 	'input_type'=>'select',
 	'input_select_source'=>'yes_no',
 	'input_select_values'=>'',
 	'pattern'=>'',
 	'initial_value'=>'',
 	'on_add'=>'enabled',
 	'on_edit'=>'enabled',
 	'on_list'=>'show'				
 	);   	

$config['classification']['fields'][ 'bidirectional']=array( 		
	'category_type'=>'FreeCategory',		
 	'field_title'=>'Bidirectional',
 	'field_type'=>'text',
 	'field_value'=>'normal',
 	'number_of_values'=>'1',//a verifier
 	'field_size'=>11,
 	'field_value'=>'0_1',
 	'field_size'=>1,
 	'input_type'=>'select',
 	'input_select_source'=>'yes_no',
 	'input_select_values'=>'',
 	'pattern'=>'',
 	'initial_value'=>'',
 	'on_add'=>'enabled',
 	'on_edit'=>'enabled',
 	'on_list'=>'show'				
 	);   	

$config['classification']['fields'][ 'note']=array( 		
	'category_type'=>'FreeCategory',		
 	'field_title'=>'Note',
 	'field_type'=>'text',
 	'field_value'=>'normal',
 	'number_of_values'=>'1',//a verifier
 	'field_size'=>500,
 	'input_type'=>'textarea',
 	'pattern'=>'',
 	'initial_value'=>'',
 	'on_add'=>'enabled',
 	'on_edit'=>'enabled',
 	'on_list'=>'show'				
 	);   	

// end project specific area
$config['classification']['fields']['user_id']=array(
		'field_title'=>'Classified by',
		'field_type'=>'int',
		'field_size'=>11,
		'field_value'=>active_user_id(),
		'input_type'=>'select',
		'input_select_source'=>'table',
		'input_select_values'=>'users;user_name',
		'mandatory'=>' mandatory ',
		'on_add'=>'hidden',		
		'on_edit'=>'hidden',		
		'on_list'=>'show',		
		'on_view'=>'show'
);

$config['classification']['fields']['classification_time']=array(
		'field_title'=>'Classification time',
		'field_type'=>'time',
		'default_value'=>'CURRENT_TIMESTAMP',
		'field_value'=>bm_current_time('Y-m-d H:i:s'),
		 
		'field_size'=>20,
		'mandatory'=>' mandatory ',
		'on_add'=>'hidden',
		'on_edit'=>'hidden',
		'on_list'=>'show',
		'on_view'=>'show'
);

$config['classification']['fields']['class_active']=array(
	   			'field_title'=>'Active',
	   			'field_type'=>'0_1',
	   			'field_value'=>'normal',
	   			'on_add'=>'not_set',
	   			'on_edit'=>'not_set',
	   			'on_list'=>'hidden',
				'on_view'=>'hidden'
	   	);

$result[ 'config' ] =$config;

$result[ 'reference_tables' ] =$reference_tables;

//SCREENING area


//SCREENING area

return $result;
}
