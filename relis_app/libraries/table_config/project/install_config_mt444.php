<?php //mt444
function get_classification_mt444(){
$reference_tables=array();//from nowit will worklike this
$config=array();
$result['class_action']='override';
$result['screen_action']='override';
$result['qa_action']='override';
$result['project_title']='Model transformation444';
$result['project_short_name']='mt444';
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
 	'mandatory'=>' mandatory ',
 	
 	'input_type'=>'select',
 	'input_select_source'=>'table',
 	'input_select_values'=>'trans_language',
 	'on_add'=>'enabled',
 	'on_edit'=>'enabled',
 	'on_list'=>'show'				
 				);
 	$reference_tables['trans_language']['ref_name'] ='trans_language';   
 	$initial_values=array();
 	array_push($initial_values, "Motif");
 	array_push($initial_values, "ATL");
 	array_push($initial_values, "Henshing");
 	array_push($initial_values, "QVT");
 	if(empty($reference_tables['trans_language']['values'])){
 		$reference_tables['trans_language']['values'] =	$initial_values;
 	}else{
 		foreach ($initial_values as $key => $value) {
 			if (!in_array($value, $reference_tables['trans_language']['values'] )){
 				array_push($reference_tables['trans_language']['values'],$value);
 			}
 		}		
 	}
 		
 		
$config['classification']['fields'][ 'scope']=array( 		
	'category_type'=>'StaticCategory',		
 	'field_title'=>'Scope',	
 	'field_type'=>'text',
 	//'field_value'=>'normal',
 	'number_of_values'=>'1',// a  verifier
 	'field_size'=>20,
 	'input_type'=>'select',
 	'input_select_source'=>'array',
 	'input_select_values'=>array(
 	'Exogenous'=>"Exogenous",
 	'Inplace'=>"Inplace",
 	'Outplace'=>"Outplace",
 	),
 	'on_add'=>'enabled',
 	'on_edit'=>'enabled',
 	'on_list'=>'show'				
 	);   
 		
 		

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
 	//'number_of_values'=>'0',//a verifier
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

$config['intent']['entity_label']='Intent';
$config['intent']['entity_label_plural']='Intent';

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
					   	'field_size'=>11,
					   //	'field_value'=>'normal',
					   
					   	'mandatory'=>' mandatory ',
					   	'input_type'=>'select',
					   	'input_select_source'=>'table',
					   	'input_select_values'=>'classification',
					   	'compute_result'=>'no',
					   	//to clean
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
 	'number_of_values'=>'0',//a verifier
 	'mandatory'=>' mandatory ',
 	
 	'input_type'=>'select',
 	'input_select_source'=>'table',
 	'input_select_values'=>'intent',
 	'on_add'=>'enabled',
 	'on_edit'=>'enabled',
 	'on_list'=>'show'				
 				);
 	$reference_tables['intent']['ref_name'] ='intent';   
 	$initial_values=array();
 	array_push($initial_values, "Translation");
 	array_push($initial_values, "Simulation");
 	array_push($initial_values, "Migration");
 	if(empty($reference_tables['intent']['values'])){
 		$reference_tables['intent']['values'] =	$initial_values;
 	}else{
 		foreach ($initial_values as $key => $value) {
 			if (!in_array($value, $reference_tables['intent']['values'] )){
 				array_push($reference_tables['intent']['values'],$value);
 			}
 		}		
 	}
 		
 		

$config['intent']['fields'][ 'name_used']=array( 		
	'category_type'=>'FreeCategory',		
 	'field_title'=>'Name used by the author',
 	'input_type'=>'text',
 	'field_size'=>100,
 	'field_type'=>'text',
 	//'number_of_values'=>'0',//a verifier
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
$config['intent']['fields']['intent_active']=array(
					   	'field_title'=>'Active',
					   	'field_type'=>'int',
					   	'field_size'=>'1',
					   	'field_value'=>'1',
					   	'default_value'=>'1',				
					   	'on_add'=>'not_set',
					   	'on_edit'=>'not_set',
					   	'on_list'=>'hidden',
					   	'on_view'=>'hidden'
			);
$config['intent']['operations']=array();
			
$config['classification']['fields'][ 'intent']=array( 		
	'category_type'=>'WithSubCategories',		
 	'field_title'=>'Intent',	
 	'field_type'=>'int',
 	'field_size'=>11,
 	//'field_value'=>'normal',
'number_of_values'=>'1',//a verifier
 	'mandatory'=>' mandatory ',
 	'filter_field'=>'parent_field_id',
 	'input_type'=>'select',
 	'input_select_source'=>'table',
 	'input_select_source_type'=>'drill_down',
 	'input_select_values'=>'intent',
 	'input_select_key_field'=>'parent_field_id',
 	'compute_result'=>'no',
 	'multi-select' => 'no',
 	'on_list'=>'show',
 	'on_add'=>'drill_down',
 	'on_edit'=>'drill_down'			
 				);			

$config['intent_relation']['table_name']='intent_relation';
$config['intent_relation']['table_id']='intent_relation_id';
$config['intent_relation']['table_active_field']='intent_relation_active';
$config['intent_relation']['main_field']='intent_relation';
$config['intent_relation']['order_by']='intent_relation_id ASC ';


$config['intent_relation']['reference_title']='Intent relation';
$config['intent_relation']['reference_title_min']='Intent relation';

$config['intent_relation']['entity_label']='Intent relation';
$config['intent_relation']['entity_label_plural']='Intent relation';

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
					   	'field_size'=>11,
					   //	'field_value'=>'normal',
					   
					   	'mandatory'=>' mandatory ',
					   	'input_type'=>'select',
					   	'input_select_source'=>'table',
					   	'input_select_values'=>'classification',
					   	'compute_result'=>'no',
					   	//to clean
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
 	'number_of_values'=>'0',//a verifier
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
 	array_push($initial_values, "Sequence");
 	array_push($initial_values, "Inverse");
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
 	'number_of_values'=>'0',
 	'mandatory'=>' mandatory ',
 	
 	'input_type'=>'select',
 	'input_select_source'=>'table',
 	'input_select_values'=>'intent',//à corriger seul les category sur le root sont supportés pour le moment
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
 	'number_of_values'=>'0',
 	'mandatory'=>' mandatory ',
 	
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
					   	'field_type'=>'int',
					   	'field_size'=>'1',
					   	'field_value'=>'1',
					   	'default_value'=>'1',				
					   	'on_add'=>'not_set',
					   	'on_edit'=>'not_set',
					   	'on_list'=>'hidden',
					   	'on_view'=>'hidden'
			);
$config['intent_relation']['operations']=array();
			
$config['classification']['fields'][ 'intent_relation']=array( 		
	'category_type'=>'WithSubCategories',		
 	'field_title'=>'Intent relation',	
 	'field_type'=>'int',
 	'field_size'=>11,
 	//'field_value'=>'normal',
'number_of_values'=>'1',//a verifier
 	'mandatory'=>' mandatory ',
 	'filter_field'=>'parent_field_id',
 	'input_type'=>'select',
 	'input_select_source'=>'table',
 	'input_select_source_type'=>'drill_down',
 	'input_select_values'=>'intent_relation',
 	'input_select_key_field'=>'parent_field_id',
 	'compute_result'=>'no',
 	'multi-select' => 'no',
 	'on_list'=>'show',
 	'on_add'=>'drill_down',
 	'on_edit'=>'drill_down'			
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
  										'title' =>"Does the study have validation?",
  										)
  );
  array_push($qa['questions'], array(
  										'title' =>"Are RQs cleary stated?",
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
$screening['validation_percentage']='20';
$screening['exclusion_criteria']=array();
array_push($screening['exclusion_criteria'], "Less than 4 pages");
array_push($screening['exclusion_criteria'], "Not using model transformation");
$screening['source_papers']=array();
$screening['source_papers']=array();
$screening['phases']=array();
 array_push($screening['phases'], array(
 										'title' =>"Phase 1",
 										'description' =>"Screen per title",
 										'fields'=>'Title|',
 										)
 );
 array_push($screening['phases'], array(
 										'title' =>"Phase 2",
 										'description' =>"Screen per title and abstract ",
 										'fields'=>'Title|Abstract|Paper|',
 										)
 );

$result[ 'screening' ]=$screening; 		

//SCREENING area

//REPORTING
$report=array();
$report['domain']['type']='simple';
$report['domain']['title']='Domain'; 		
$report['domain']['id']='domain';
$report['domain']['link']='false'; 
$report['domain']['values']['field']='scope';
$report['domain']['values']['style']='select';
$report['domain']['values']['title']='Scope';  
$charts=array();
 	array_push($charts, "pie");
 	array_push($charts, "bar");
$report['domain']['chart']=$charts;
$report['year_domain']['type']='compare';
$report['year_domain']['title']='Domain per year'; 		
$report['year_domain']['id']='year_domain';
$report['year_domain']['link']='false'; 
$report['year_domain']['values']['field']='scope';
$report['year_domain']['values']['style']='select';
$report['year_domain']['values']['title']='Scope';  
$report['year_domain']['reference']['field']='intent';
 $report['year_domain']['reference']['style']='select';
 $report['year_domain']['reference']['title']='Intent';  
  $charts=array();
   	array_push($charts, "line");
   	array_push($charts, "bar");
  $report['year_domain']['chart']=$charts;
$report['scope']['type']='simple';
$report['scope']['title']='Scope'; 		
$report['scope']['id']='scope';
$report['scope']['link']='false'; 
$report['scope']['values']['field']='scope';
$report['scope']['values']['style']='select';
$report['scope']['values']['title']='Scope';  
$charts=array();
 	array_push($charts, "pie");
 	array_push($charts, "bar");
$report['scope']['chart']=$charts;
$report['year_scope']['type']='compare';
$report['year_scope']['title']='Scope per year'; 		
$report['year_scope']['id']='year_scope';
$report['year_scope']['link']='false'; 
$report['year_scope']['values']['field']='scope';
$report['year_scope']['values']['style']='select';
$report['year_scope']['values']['title']='Scope';  
$report['year_scope']['reference']['field']='intent';
 $report['year_scope']['reference']['style']='select';
 $report['year_scope']['reference']['title']='Intent';  
  $charts=array();
   	array_push($charts, "line");
  $report['year_scope']['chart']=$charts;
$result[ 'report' ]=$report; 		
//REPORTING

return $result;
}
