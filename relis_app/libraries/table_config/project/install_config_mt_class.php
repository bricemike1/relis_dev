<?php //mt_class
function get_classification_mt_class(){
$reference_tables=array();//from nowit will worklike this
$config=array();
$result['class_action']='no_overide';
$result['screen_action']='override';
$result['qa_action']='override';
$result['project_title']='Model transformation classification';
$result['project_short_name']='mt_class';
$config['classification']['table_name']='classification';
$config['classification']['config_id']='classification';
$config['classification']['table_id']='class_id';
$config['classification']['table_active_field']='class_active';
$config['classification']['main_field']='class_paper_id';

$config['classification']['entity_label']='Classification';
$config['classification']['entity_label_plural']='Classifications';


$config['classification']['reference_title']='Classifications';
$config['classification']['reference_title_min']='Classification';

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
	   			'default_value'=>'auto_increment',
	   			
	   			'on_add'=>'hidden',
	   			'on_edit'=>'hidden',
	   			'on_list'=>'show',
	   			'on_view'=>'hidden',
	   	);

$config['classification']['fields'][ 'class_paper_id']=array(
	   			'field_title'=>'Paper',
	   			'field_type'=>'int',
	   			'field_size'=>11,
	   			//'field_value'=>'normal',
				'input_type'=>'select',
				'input_select_source'=>'table',
				'input_select_values'=>'papers;CONCAT_WS(" - ",bibtexKey,title)',				
				'mandatory'=>' mandatory ',
				
	   			'on_add'=>'enabled',
	   			'on_edit'=>'enabled',
	   			'on_list'=>'show'
	   	);
//project specific area


$config['classification']['fields'][ 'transformation_name']=array( 		
	'category_type'=>'FreeCategory',		
 	'field_title'=>'Transformation name',
 	'input_type'=>'text',
 	'field_size'=>100,
 	'field_type'=>'text',
 	//'number_of_values'=>'1',//a verifier
 	'number_of_values'=>'1',//tous les Freecategory ont une seule valeur
 	//'field_value'=>'normal',
 	
 	'mandatory'=>' mandatory ',

 	'pattern'=>'',
 	
 	'initial_value'=>'',
 	'field_value'=>'',
 	
 	'on_add'=>'enabled',
 	'on_edit'=>'enabled',
 	'on_list'=>'show'				
 	);   	
$config['classification']['fields'][ 'trans_language']=array( 		
	'category_type'=>'IndependantDynamicCategory',		
 	'field_title'=>'Transformation Language',	
 	'field_type'=>'int',
 	'field_size'=>11,
 	//'field_value'=>'normal',
 	'number_of_values'=>'1',//a verifier
 	
 	'input_type'=>'select',
 	'input_select_source'=>'table',
 	'input_select_values'=>'Transformation Language ',
 	'on_add'=>'enabled',
 	'on_edit'=>'enabled',
 	'on_list'=>'show'				
 				);
 	$reference_tables['Transformation Language ']['ref_name'] ='Transformation Language ';   
 	$initial_values=array();
 	array_push($initial_values, "Motif");
 	array_push($initial_values, "ATL");
 	array_push($initial_values, "HEnshing");
 	array_push($initial_values, "QVT");
 	if(empty($reference_tables['Transformation Language ']['values'])){
 		$reference_tables['Transformation Language ']['values'] =	$initial_values;
 	}else{
 		foreach ($initial_values as $key => $value) {
 			if (!in_array($value, $reference_tables['Transformation Language ']['values'] )){
 				array_push($reference_tables['Transformation Language ']['values'],$value);
 			}
 		}		
 	}
 		
 		
$config['classification']['fields'][ 'scope']=array( 		
	'category_type'=>'IndependantDynamicCategory',		
 	'field_title'=>'Scope',	
 	'field_type'=>'int',
 	'field_size'=>11,
 	//'field_value'=>'normal',
 	'number_of_values'=>'1',//a verifier
 	
 	'input_type'=>'select',
 	'input_select_source'=>'table',
 	'input_select_values'=>'Scope',
 	'on_add'=>'enabled',
 	'on_edit'=>'enabled',
 	'on_list'=>'show'				
 				);
 	$reference_tables['Scope']['ref_name'] ='Scope';   
 	$initial_values=array();
 	array_push($initial_values, "Exogenous");
 	array_push($initial_values, "Inplace");
 	array_push($initial_values, "Outplace");
 	if(empty($reference_tables['Scope']['values'])){
 		$reference_tables['Scope']['values'] =	$initial_values;
 	}else{
 		foreach ($initial_values as $key => $value) {
 			if (!in_array($value, $reference_tables['Scope']['values'] )){
 				array_push($reference_tables['Scope']['values'],$value);
 			}
 		}		
 	}
 		
 		

$config['classification']['fields'][ 'bidirectional']=array( 		
	'category_type'=>'FreeCategory',		
 	'field_title'=>'Bidirectional',
 	'input_type'=>'text',
 	'field_size'=>20,
 	'field_type'=>'bool',
 	'field_value'=>'0_1',
 	'field_size'=>1,
 	'field_type'=>'int',
 	'input_type'=>'select',
 	'input_select_source'=>'yes_no',
 	'input_select_values'=>'1',
 	//'number_of_values'=>'',//a verifier
 	'number_of_values'=>'1',//tous les Freecategory ont une seule valeur
 	//'field_value'=>'normal',
 	

 	'pattern'=>'',
 	
 	'initial_value'=>'',
 	'field_value'=>'',
 	
 	'on_add'=>'enabled',
 	'on_edit'=>'enabled',
 	'on_list'=>'show'				
 	);   	
$config['intent']['table_name']='intent';
$config['intent']['table_id']='intent_id';
$config['intent']['table_active_field']='intent_active';
$config['intent']['main_field']='intent';
$config['intent']['order_by']='intent_id ASC ';


$config['intent']['reference_title']='Intent';
$config['intent']['reference_title_min']='Intent';
		
$config['intent']['entity_label_plural']='Intent';
$config['intent']['entity_label']='Intent';


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
			   	'field_type'=>'int',
			   	'field_size'=>11,
			   	'field_value'=>'auto_increment',					   	
			   	'default_value'=>'auto_increment',
			   	//to clean
			   	'on_add'=>'hidden',
			   	'on_edit'=>'hidden',
			   	'on_list'=>'show',
			   	'on_view'=>'hidden'
			   	);
$config['intent']['fields']['parent_field_id']=array(
					   	'category_type'=>'ParentExternalKey',
					   	'field_title'=>'Parent',
					   	'field_type'=>'int',
					   	//'field_value'=>'normal',
					   	'field_size'=>11,
					   	'mandatory'=>' mandatory ',
					   	'input_type'=>'select',
					   	'input_select_source'=>'table',
					   	'input_select_values'=>'classification',
					   	//to clean
					   	'compute_result'=>'no',							   
					   	'on_add'=>'hidden',
					   	'on_edit'=>'hidden',
					   	'on_list'=>'hidden',
					   	'on_view'=>'hidden'
				);
				
$config['intent']['fields'][ 'intent']=array( 		
	'category_type'=>'IndependantDynamicCategory',		
 	'field_title'=>'Intent',	
 	'field_type'=>'int',
 	'field_size'=>11,
 	//'field_value'=>'normal',
 	'number_of_values'=>'1',//a verifier
 	'mandatory'=>' mandatory ',
 	
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
 	'input_type'=>'text',
 	'field_size'=>100,
 	'field_type'=>'text',
 	//'number_of_values'=>'',//a verifier
 	'number_of_values'=>'1',//tous les Freecategory ont une seule valeur
 	//'field_value'=>'normal',
 	
 	'mandatory'=>' mandatory ',

 	'pattern'=>'',
 	
 	'initial_value'=>'',
 	'field_value'=>'',
 	
 	'on_add'=>'enabled',
 	'on_edit'=>'enabled',
 	'on_list'=>'show'				
 	);   	

$config['intent']['fields'][ 'note']=array( 		
	'category_type'=>'FreeCategory',		
 	'field_title'=>'Note',
 	'input_type'=>'text',
 	'field_size'=>500,
 	'field_type'=>'text',
 	'input_type'=>'textarea',
 	//'number_of_values'=>'',//a verifier
 	'number_of_values'=>'1',//tous les Freecategory ont une seule valeur
 	//'field_value'=>'normal',
 	

 	'pattern'=>'',
 	
 	'initial_value'=>'',
 	'field_value'=>'',
 	
 	'on_add'=>'enabled',
 	'on_edit'=>'enabled',
 	'on_list'=>'show'				
 	);   	
$config['intent']['fields']['intent_active']=array(
					   	'field_title'=>'Active',
					   	'field_type'=>'int',
					   	'field_size'=>'1',
					   	'field_value'=>'1',
					   	//to clean				
					   	'on_add'=>'not_set',
					   	'on_edit'=>'not_set',
					   	'on_list'=>'hidden',
					   	'on_view'=>'hidden'
			);
$config['intent']['operations']=array();
			
$config['classification']['fields'][ 'intent']=array( 		
	'category_type'=>'WithMultiValues',		
 	'field_title'=>'Intent',	
 	'field_type'=>'int',
 	'field_size'=>11,
 	//'field_value'=>'normal',
 	'number_of_values'=>'10',//a verifier
 	
 	'mandatory'=>' mandatory ',
 	
 	'input_type'=>'select',
 	'input_select_source'=>'table',
 	'input_select_values'=>'intent',
 	'input_select_key_field'=>'parent_field_id',
 	'input_select_source_type'=>'drill_down',
 	//'number_of_values'=>'*',//a verifier
 	'on_add'=>'drill_down',
 	'on_edit'=>'drill_down',
 	'compute_result'=>'no',
 	'on_list'=>'show'				
 				);			

$config['intent_relation']['table_name']='intent_relation';
$config['intent_relation']['table_id']='intent_relation_id';
$config['intent_relation']['table_active_field']='intent_relation_active';
$config['intent_relation']['main_field']='intent_relation';
$config['intent_relation']['order_by']='intent_relation_id ASC ';


$config['intent_relation']['reference_title']='Intent relation';
$config['intent_relation']['reference_title_min']='Intent relation';
		
$config['intent_relation']['entity_label_plural']='Intent relation';
$config['intent_relation']['entity_label']='Intent relation';


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
			   	'field_type'=>'int',
			   	'field_size'=>11,
			   	'field_value'=>'auto_increment',					   	
			   	'default_value'=>'auto_increment',
			   	//to clean
			   	'on_add'=>'hidden',
			   	'on_edit'=>'hidden',
			   	'on_list'=>'show',
			   	'on_view'=>'hidden'
			   	);
$config['intent_relation']['fields']['parent_field_id']=array(
					   	'category_type'=>'ParentExternalKey',
					   	'field_title'=>'Parent',
					   	'field_type'=>'int',
					   	//'field_value'=>'normal',
					   	'field_size'=>11,
					   	'mandatory'=>' mandatory ',
					   	'input_type'=>'select',
					   	'input_select_source'=>'table',
					   	'input_select_values'=>'classification',
					   	//to clean
					   	'compute_result'=>'no',							   
					   	'on_add'=>'hidden',
					   	'on_edit'=>'hidden',
					   	'on_list'=>'hidden',
					   	'on_view'=>'hidden'
				);
				
$config['intent_relation']['fields'][ 'intent_relation']=array( 		
	'category_type'=>'IndependantDynamicCategory',		
 	'field_title'=>'Intent relation',	
 	'field_type'=>'int',
 	'field_size'=>11,
 	//'field_value'=>'normal',
 	'number_of_values'=>'1',//a verifier
 	'mandatory'=>' mandatory ',
 	
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
	'category_type'=>'DependentDynamicCategory',		
 	'field_title'=>'Intent 1',	
 	'field_type'=>'int',
 	'field_size'=>11,
 //	'field_value'=>'normal',
 	'number_of_values'=>'1',
 	'mandatory'=>' mandatory ',
 	
 	'input_type'=>'select',
 	'input_select_source'=>'table',
 	'input_select_values'=>'intent',//? corriger seul les category sur le root sont support?s pour le moment
 	'on_add'=>'enabled',
 	'on_edit'=>'enabled',
 	'compute_result'=>'no',
 	'on_list'=>'show'				
 				);
 	
 		
 		
$config['intent_relation']['fields'][ 'intent_2']=array( 		
	'category_type'=>'DependentDynamicCategory',		
 	'field_title'=>'Intent 2',	
 	'field_type'=>'int',
 	'field_size'=>11,
 //	'field_value'=>'normal',
 	'number_of_values'=>'1',
 	'mandatory'=>' mandatory ',
 	
 	'input_type'=>'select',
 	'input_select_source'=>'table',
 	'input_select_values'=>'intent',//? corriger seul les category sur le root sont support?s pour le moment
 	'on_add'=>'enabled',
 	'on_edit'=>'enabled',
 	'compute_result'=>'no',
 	'on_list'=>'show'				
 				);
 	
 		
 		

$config['intent_relation']['fields'][ 'note']=array( 		
	'category_type'=>'FreeCategory',		
 	'field_title'=>'Note',
 	'input_type'=>'text',
 	'field_size'=>500,
 	'field_type'=>'text',
 	'input_type'=>'textarea',
 	//'number_of_values'=>'',//a verifier
 	'number_of_values'=>'1',//tous les Freecategory ont une seule valeur
 	//'field_value'=>'normal',
 	

 	'pattern'=>'',
 	
 	'initial_value'=>'',
 	'field_value'=>'',
 	
 	'on_add'=>'enabled',
 	'on_edit'=>'enabled',
 	'on_list'=>'show'				
 	);   	
$config['intent_relation']['fields']['intent_relation_active']=array(
					   	'field_title'=>'Active',
					   	'field_type'=>'int',
					   	'field_size'=>'1',
					   	'field_value'=>'1',
					   	//to clean				
					   	'on_add'=>'not_set',
					   	'on_edit'=>'not_set',
					   	'on_list'=>'hidden',
					   	'on_view'=>'hidden'
			);
$config['intent_relation']['operations']=array();
			
$config['classification']['fields'][ 'intent_relation']=array( 		
	'category_type'=>'WithMultiValues',		
 	'field_title'=>'Intent relation',	
 	'field_type'=>'int',
 	'field_size'=>11,
 	//'field_value'=>'normal',
 	'number_of_values'=>'10',//a verifier
 	
 	'mandatory'=>' mandatory ',
 	
 	'input_type'=>'select',
 	'input_select_source'=>'table',
 	'input_select_values'=>'intent_relation',
 	'input_select_key_field'=>'parent_field_id',
 	'input_select_source_type'=>'drill_down',
 	//'number_of_values'=>'*',//a verifier
 	'on_add'=>'drill_down',
 	'on_edit'=>'drill_down',
 	'compute_result'=>'no',
 	'on_list'=>'show'				
 				);			


$config['classification']['fields'][ 'note']=array( 		
	'category_type'=>'FreeCategory',		
 	'field_title'=>'Note',
 	'input_type'=>'text',
 	'field_size'=>500,
 	'field_type'=>'text',
 	'input_type'=>'textarea',
 	//'number_of_values'=>'',//a verifier
 	'number_of_values'=>'1',//tous les Freecategory ont une seule valeur
 	//'field_value'=>'normal',
 	

 	'pattern'=>'',
 	
 	'initial_value'=>'',
 	'field_value'=>'',
 	
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
		'on_list'=>'hidden',		
		'on_view'=>'hidden'
);

$config['classification']['fields']['classification_time']=array(
		'field_title'=>'Classification time',
		'field_type'=>'time',
		'default_value'=>'CURRENT_TIMESTAMP',
		'field_value'=>bm_current_time('Y-m-d H:i:s'),		 
		'field_size'=>20,
		'mandatory'=>' mandatory ',
		
		'on_add'=>'not_set',
		'on_edit'=>'not_set',
		'on_list'=>'hidden',
		'on_view'=>'hidden'
);

$config['classification']['fields']['class_active']=array(
	   			'field_title'=>'Active',
	   			'field_type'=>'int',
	   			'field_size'=>'1',
	   			
	   			//'field_value'=>'normal',
	   			'on_add'=>'not_set',
	   			'on_edit'=>'not_set',
	   			'on_list'=>'hidden',
				'on_view'=>'hidden'
	   	);
$config['classification']['operations']=array();
$result[ 'config' ] =$config;

$result[ 'reference_tables' ] =$reference_tables;

//QA area

 		
$qa=array();
$qa['cutt_off_score']='5';
$qa['questions']=array();
  array_push($qa['questions'], array(
  										'title' =>"Does the study has validation?",
  										)
  );
  array_push($qa['questions'], array(
  										'title' =>"Is RQ cleary stated?",
  										)
  );
  array_push($qa['questions'], array(
  										'title' =>"Is the research method adequately detailled?",
  										)
  );
$qa['responses']=array();
   array_push($qa['responses'], array(
   										'title' =>"Yes",
   										'score' =>"3",
   										)
   );
   array_push($qa['responses'], array(
   										'title' =>"Partially",
   										'score' =>"1.5",
   										)
   );
   array_push($qa['responses'], array(
   										'title' =>"No",
   										'score' =>"0",
   										)
   );
$result[ 'qa' ]=$qa; 		

//QA area


//SCREENING area

 		
$screening=array();
$screening['review_per_paper']='2';
$screening['conflict_type']='ExclusionCriteria';
$screening['conflict_resolution']='Unanimity';
$screening['validation_assigment_mode']='Normal';
$screening['validation_percentage']='30';
$screening['exclusion_criteria']=array();
array_push($screening['exclusion_criteria'], "Less than 4 pages");
array_push($screening['exclusion_criteria'], "Not using model transformation");
$screening['source_papers']=array();
array_push($screening['source_papers'], "Scopus");
array_push($screening['source_papers'], "IEEE");
$screening['source_papers']=array();
array_push($screening['source_papers'], "Scopus");
array_push($screening['source_papers'], "IEEE");
$screening['phases']=array();
 array_push($screening['phases'], array(
 										'title' =>"Phase 1",
 										'description' =>"Screen per title",
 										'fields'=>'Title|',
 										)
 );
 array_push($screening['phases'], array(
 										'title' =>"Phase 2",
 										'description' =>"Screen per title and abstract 2",
 										'fields'=>'Title|Abstract|Link|',
 										)
 );

$result[ 'screening' ]=$screening; 		

//SCREENING area

//REPORTING
$report=array();
$result[ 'report' ]=$report; 		
//REPORTING

return $result;
}
