<?php //mt_edouard
function get_classification_mt_edouard(){
$reference_tables=array();//from nowit will worklike this
$config=array();
$result['class_action']='no_overide';
$result['screen_action']='override';
$result['qa_action']='override';
$result['project_title']='Model Transformations for Concrete Problems';
$result['project_short_name']='mt_edouard';
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

$config['classification']['fields'][ 'transfo_kind']=array( 		
	'category_type'=>'IndependantDynamicCategory',		
 	'field_title'=>'Transformation kind',	
 	'field_type'=>'int',
 	'field_size'=>11,
 	//'field_value'=>'normal',
 	'number_of_values'=>'1',//a verifier
 	'mandatory'=>' mandatory ',
 	
 	'input_type'=>'select',
 	'input_select_source'=>'table',
 	'input_select_values'=>'Transformation kind',
 	'on_add'=>'enabled',
 	'on_edit'=>'enabled',
 	'on_list'=>'show'				
 				);
 	$reference_tables['Transformation kind']['ref_name'] ='Transformation kind';   
 	$initial_values=array();
 	array_push($initial_values, "Structural");
 	array_push($initial_values, "Behavioral");
 	array_push($initial_values, "Mixte");
 	if(empty($reference_tables['Transformation kind']['values'])){
 		$reference_tables['Transformation kind']['values'] =	$initial_values;
 	}else{
 		foreach ($initial_values as $key => $value) {
 			if (!in_array($value, $reference_tables['Transformation kind']['values'] )){
 				array_push($reference_tables['Transformation kind']['values'],$value);
 			}
 		}		
 	}
 		
 		

$config['classification']['fields'][ 'comment_transfo_kind']=array( 		
	'category_type'=>'FreeCategory',		
 	'field_title'=>'Transformation kind comment',
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
$config['classification']['fields'][ 'mm_kind']=array( 		
	'category_type'=>'IndependantDynamicCategory',		
 	'field_title'=>'Metamodel kind',	
 	'field_type'=>'int',
 	'field_size'=>11,
 	//'field_value'=>'normal',
 	'number_of_values'=>'1',//a verifier
 	'mandatory'=>' mandatory ',
 	
 	'input_type'=>'select',
 	'input_select_source'=>'table',
 	'input_select_values'=>'Metamodel kind',
 	'on_add'=>'enabled',
 	'on_edit'=>'enabled',
 	'on_list'=>'show'				
 				);
 	$reference_tables['Metamodel kind']['ref_name'] ='Metamodel kind';   
 	$initial_values=array();
 	array_push($initial_values, "input specific / output specific");
 	array_push($initial_values, "input specific / output general");
 	array_push($initial_values, "input general / output general");
 	array_push($initial_values, "input general / output specific");
 	if(empty($reference_tables['Metamodel kind']['values'])){
 		$reference_tables['Metamodel kind']['values'] =	$initial_values;
 	}else{
 		foreach ($initial_values as $key => $value) {
 			if (!in_array($value, $reference_tables['Metamodel kind']['values'] )){
 				array_push($reference_tables['Metamodel kind']['values'],$value);
 			}
 		}		
 	}
 		
 		

$config['classification']['fields'][ 'comment_mm_kind']=array( 		
	'category_type'=>'FreeCategory',		
 	'field_title'=>'Metamodel kind comment ',
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
$config['classification']['fields'][ 'model_kind']=array( 		
	'category_type'=>'IndependantDynamicCategory',		
 	'field_title'=>'Model kind',	
 	'field_type'=>'int',
 	'field_size'=>11,
 	//'field_value'=>'normal',
 	'number_of_values'=>'1',//a verifier
 	'mandatory'=>' mandatory ',
 	
 	'input_type'=>'select',
 	'input_select_source'=>'table',
 	'input_select_values'=>'Model kind',
 	'on_add'=>'enabled',
 	'on_edit'=>'enabled',
 	'on_list'=>'show'				
 				);
 	$reference_tables['Model kind']['ref_name'] ='Model kind';   
 	$initial_values=array();
 	array_push($initial_values, "Toy");
 	array_push($initial_values, "Industrial");
 	array_push($initial_values, "Public");
 	if(empty($reference_tables['Model kind']['values'])){
 		$reference_tables['Model kind']['values'] =	$initial_values;
 	}else{
 		foreach ($initial_values as $key => $value) {
 			if (!in_array($value, $reference_tables['Model kind']['values'] )){
 				array_push($reference_tables['Model kind']['values'],$value);
 			}
 		}		
 	}
 		
 		

$config['classification']['fields'][ 'comment_model_kind']=array( 		
	'category_type'=>'FreeCategory',		
 	'field_title'=>'Model kind comment ',
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
$config['classification']['fields'][ 'intent']=array( 		
	'category_type'=>'IndependantDynamicCategory',		
 	'field_title'=>'Intent',	
 	'field_type'=>'int',
 	'field_size'=>11,
 	//'field_value'=>'normal',
 	'number_of_values'=>'1',//a verifier
 	'mandatory'=>' mandatory ',
 	
 	'input_type'=>'select',
 	'input_select_source'=>'table',
 	'input_select_values'=>'Intent',
 	'on_add'=>'enabled',
 	'on_edit'=>'enabled',
 	'on_list'=>'show'				
 				);
 	$reference_tables['Intent']['ref_name'] ='Intent';   
 	$initial_values=array();
 	array_push($initial_values, "Refinement");
 	array_push($initial_values, "Abstraction");
 	array_push($initial_values, "Semantic Definition");
 	array_push($initial_values, "Language Translation");
 	array_push($initial_values, "Constraint Satisfaction");
 	array_push($initial_values, "Analysis");
 	array_push($initial_values, "Editing");
 	array_push($initial_values, "Model Visualization");
 	array_push($initial_values, "Model Composition");
 	if(empty($reference_tables['Intent']['values'])){
 		$reference_tables['Intent']['values'] =	$initial_values;
 	}else{
 		foreach ($initial_values as $key => $value) {
 			if (!in_array($value, $reference_tables['Intent']['values'] )){
 				array_push($reference_tables['Intent']['values'],$value);
 			}
 		}		
 	}
 		
 		

$config['classification']['fields'][ 'comment_intent']=array( 		
	'category_type'=>'FreeCategory',		
 	'field_title'=>'Intent comment ',
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
$config['classification']['fields'][ 'transfo_langauge']=array( 		
	'category_type'=>'IndependantDynamicCategory',		
 	'field_title'=>'Transformation language',	
 	'field_type'=>'int',
 	'field_size'=>11,
 	//'field_value'=>'normal',
 	'number_of_values'=>'1',//a verifier
 	'mandatory'=>' mandatory ',
 	
 	'input_type'=>'select',
 	'input_select_source'=>'table',
 	'input_select_values'=>'Transformation language',
 	'on_add'=>'enabled',
 	'on_edit'=>'enabled',
 	'on_list'=>'show'				
 				);
 	$reference_tables['Transformation language']['ref_name'] ='Transformation language';   
 	$initial_values=array();
 	array_push($initial_values, "Dedicated");
 	array_push($initial_values, "Programming");
 	array_push($initial_values, "Others");
 	if(empty($reference_tables['Transformation language']['values'])){
 		$reference_tables['Transformation language']['values'] =	$initial_values;
 	}else{
 		foreach ($initial_values as $key => $value) {
 			if (!in_array($value, $reference_tables['Transformation language']['values'] )){
 				array_push($reference_tables['Transformation language']['values'],$value);
 			}
 		}		
 	}
 		
 		

$config['classification']['fields'][ 'comment_transfo_langauge']=array( 		
	'category_type'=>'FreeCategory',		
 	'field_title'=>'Transformation language comment ',
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
$config['classification']['fields'][ 'validation']=array( 		
	'category_type'=>'IndependantDynamicCategory',		
 	'field_title'=>'Validation',	
 	'field_type'=>'int',
 	'field_size'=>11,
 	//'field_value'=>'normal',
 	'number_of_values'=>'1',//a verifier
 	'mandatory'=>' mandatory ',
 	
 	'input_type'=>'select',
 	'input_select_source'=>'table',
 	'input_select_values'=>'Validation',
 	'on_add'=>'enabled',
 	'on_edit'=>'enabled',
 	'on_list'=>'show'				
 				);
 	$reference_tables['Validation']['ref_name'] ='Validation';   
 	$initial_values=array();
 	array_push($initial_values, "Empirical");
 	array_push($initial_values, "No validation");
 	array_push($initial_values, "Formal");
 	if(empty($reference_tables['Validation']['values'])){
 		$reference_tables['Validation']['values'] =	$initial_values;
 	}else{
 		foreach ($initial_values as $key => $value) {
 			if (!in_array($value, $reference_tables['Validation']['values'] )){
 				array_push($reference_tables['Validation']['values'],$value);
 			}
 		}		
 	}
 		
 		

$config['classification']['fields'][ 'comment_validation']=array( 		
	'category_type'=>'FreeCategory',		
 	'field_title'=>'Validation comment ',
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
$config['classification']['fields'][ 'scope']=array( 		
	'category_type'=>'IndependantDynamicCategory',		
 	'field_title'=>'Scope',	
 	'field_type'=>'int',
 	'field_size'=>11,
 	//'field_value'=>'normal',
 	'number_of_values'=>'1',//a verifier
 	'mandatory'=>' mandatory ',
 	
 	'input_type'=>'select',
 	'input_select_source'=>'table',
 	'input_select_values'=>'Scope',
 	'on_add'=>'enabled',
 	'on_edit'=>'enabled',
 	'on_list'=>'show'				
 				);
 	$reference_tables['Scope']['ref_name'] ='Scope';   
 	$initial_values=array();
 	array_push($initial_values, "In-place");
 	array_push($initial_values, "Out-place");
 	array_push($initial_values, "Exogenous");
 	if(empty($reference_tables['Scope']['values'])){
 		$reference_tables['Scope']['values'] =	$initial_values;
 	}else{
 		foreach ($initial_values as $key => $value) {
 			if (!in_array($value, $reference_tables['Scope']['values'] )){
 				array_push($reference_tables['Scope']['values'],$value);
 			}
 		}		
 	}
 		
 		

$config['classification']['fields'][ 'comment_scope']=array( 		
	'category_type'=>'FreeCategory',		
 	'field_title'=>'Scope comment',
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
$config['classification']['fields'][ 'orientation']=array( 		
	'category_type'=>'IndependantDynamicCategory',		
 	'field_title'=>'Orientation',	
 	'field_type'=>'int',
 	'field_size'=>11,
 	//'field_value'=>'normal',
 	'number_of_values'=>'1',//a verifier
 	'mandatory'=>' mandatory ',
 	
 	'input_type'=>'select',
 	'input_select_source'=>'table',
 	'input_select_values'=>'Orientation',
 	'on_add'=>'enabled',
 	'on_edit'=>'enabled',
 	'on_list'=>'show'				
 				);
 	$reference_tables['Orientation']['ref_name'] ='Orientation';   
 	$initial_values=array();
 	array_push($initial_values, "Academic");
 	array_push($initial_values, "Industrial");
 	if(empty($reference_tables['Orientation']['values'])){
 		$reference_tables['Orientation']['values'] =	$initial_values;
 	}else{
 		foreach ($initial_values as $key => $value) {
 			if (!in_array($value, $reference_tables['Orientation']['values'] )){
 				array_push($reference_tables['Orientation']['values'],$value);
 			}
 		}		
 	}
 		
 		

$config['classification']['fields'][ 'comment_orientation']=array( 		
	'category_type'=>'FreeCategory',		
 	'field_title'=>'Orientation Comment',
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

$config['classification']['fields'][ 'year']=array( 		
	'category_type'=>'FreeCategory',		
 	'field_title'=>'Year',
 	'input_type'=>'text',
 	'field_size'=>4,
 	'field_type'=>'int',
 	//'number_of_values'=>'1',//a verifier
 	'number_of_values'=>'1',//tous les Freecategory ont une seule valeur
 	//'field_value'=>'normal',
 	

 	'pattern'=>'',
 	
 	'initial_value'=>'',
 	'field_value'=>'',
 	
 	'on_add'=>'enabled',
 	'on_edit'=>'enabled',
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


//QA area


//SCREENING area


//SCREENING area

//REPORTING
$report=array();
$report['mm_kind']['type']='simple';
$report['mm_kind']['title']='Metamodel kind'; 		
$report['mm_kind']['id']='mm_kind';
$report['mm_kind']['link']='false'; 
$report['mm_kind']['values']['field']='mm_kind';
$report['mm_kind']['values']['style']='select';
$report['mm_kind']['values']['title']='Metamodel kind';  
$charts=array();
 	array_push($charts, "pie");
$report['mm_kind']['chart']=$charts;
$report['model_kind']['type']='simple';
$report['model_kind']['title']='Model Kind'; 		
$report['model_kind']['id']='model_kind';
$report['model_kind']['link']='false'; 
$report['model_kind']['values']['field']='model_kind';
$report['model_kind']['values']['style']='select';
$report['model_kind']['values']['title']='Model kind';  
$charts=array();
 	array_push($charts, "pie");
$report['model_kind']['chart']=$charts;
$report['transfo_kind']['type']='simple';
$report['transfo_kind']['title']='Transformation kind'; 		
$report['transfo_kind']['id']='transfo_kind';
$report['transfo_kind']['link']='false'; 
$report['transfo_kind']['values']['field']='transfo_kind';
$report['transfo_kind']['values']['style']='select';
$report['transfo_kind']['values']['title']='Transformation kind';  
$charts=array();
 	array_push($charts, "pie");
$report['transfo_kind']['chart']=$charts;
$report['intent']['type']='simple';
$report['intent']['title']='Intent'; 		
$report['intent']['id']='intent';
$report['intent']['link']='false'; 
$report['intent']['values']['field']='intent';
$report['intent']['values']['style']='select';
$report['intent']['values']['title']='Intent';  
$charts=array();
 	array_push($charts, "pie");
 	array_push($charts, "bar");
$report['intent']['chart']=$charts;
$report['transfo_langauge']['type']='simple';
$report['transfo_langauge']['title']='Transformation langage'; 		
$report['transfo_langauge']['id']='transfo_langauge';
$report['transfo_langauge']['link']='false'; 
$report['transfo_langauge']['values']['field']='transfo_langauge';
$report['transfo_langauge']['values']['style']='select';
$report['transfo_langauge']['values']['title']='Transformation language';  
$charts=array();
 	array_push($charts, "pie");
$report['transfo_langauge']['chart']=$charts;
$report['validation']['type']='simple';
$report['validation']['title']='Validation'; 		
$report['validation']['id']='validation';
$report['validation']['link']='false'; 
$report['validation']['values']['field']='validation';
$report['validation']['values']['style']='select';
$report['validation']['values']['title']='Validation';  
$charts=array();
 	array_push($charts, "pie");
$report['validation']['chart']=$charts;
$report['scope']['type']='simple';
$report['scope']['title']='Scope'; 		
$report['scope']['id']='scope';
$report['scope']['link']='false'; 
$report['scope']['values']['field']='scope';
$report['scope']['values']['style']='select';
$report['scope']['values']['title']='Scope';  
$charts=array();
 	array_push($charts, "pie");
$report['scope']['chart']=$charts;
$report['orientation']['type']='simple';
$report['orientation']['title']='Orientation'; 		
$report['orientation']['id']='orientation';
$report['orientation']['link']='false'; 
$report['orientation']['values']['field']='orientation';
$report['orientation']['values']['style']='select';
$report['orientation']['values']['title']='Orientation';  
$charts=array();
 	array_push($charts, "pie");
$report['orientation']['chart']=$charts;
$report['year']['type']='simple';
$report['year']['title']='Papers per year'; 		
$report['year']['id']='year';
$report['year']['link']='false'; 
$report['year']['values']['field']='year';
$report['year']['values']['style']='select';
$report['year']['values']['title']='Year';  
$charts=array();
 	array_push($charts, "line");
$report['year']['chart']=$charts;
$report['year_mm_kind']['type']='compare';
$report['year_mm_kind']['title']='Metamodel kind'; 		
$report['year_mm_kind']['id']='year_mm_kind';
$report['year_mm_kind']['link']='false'; 
$report['year_mm_kind']['values']['field']='mm_kind';
$report['year_mm_kind']['values']['style']='select';
$report['year_mm_kind']['values']['title']='Metamodel kind';  
$report['year_mm_kind']['reference']['field']='year';
 $report['year_mm_kind']['reference']['style']='select';
 $report['year_mm_kind']['reference']['title']='Year';  
  $charts=array();
   	array_push($charts, "line");
  $report['year_mm_kind']['chart']=$charts;
$report['year_model_kind']['type']='compare';
$report['year_model_kind']['title']='Model Kind'; 		
$report['year_model_kind']['id']='year_model_kind';
$report['year_model_kind']['link']='false'; 
$report['year_model_kind']['values']['field']='model_kind';
$report['year_model_kind']['values']['style']='select';
$report['year_model_kind']['values']['title']='Model kind';  
$report['year_model_kind']['reference']['field']='year';
 $report['year_model_kind']['reference']['style']='select';
 $report['year_model_kind']['reference']['title']='Year';  
  $charts=array();
   	array_push($charts, "line");
  $report['year_model_kind']['chart']=$charts;
$report['year_transfo_kind']['type']='compare';
$report['year_transfo_kind']['title']='Transformation kind'; 		
$report['year_transfo_kind']['id']='year_transfo_kind';
$report['year_transfo_kind']['link']='false'; 
$report['year_transfo_kind']['values']['field']='transfo_kind';
$report['year_transfo_kind']['values']['style']='select';
$report['year_transfo_kind']['values']['title']='Transformation kind';  
$report['year_transfo_kind']['reference']['field']='year';
 $report['year_transfo_kind']['reference']['style']='select';
 $report['year_transfo_kind']['reference']['title']='Year';  
  $charts=array();
   	array_push($charts, "line");
  $report['year_transfo_kind']['chart']=$charts;
$report['year_intent']['type']='compare';
$report['year_intent']['title']='Intent'; 		
$report['year_intent']['id']='year_intent';
$report['year_intent']['link']='false'; 
$report['year_intent']['values']['field']='intent';
$report['year_intent']['values']['style']='select';
$report['year_intent']['values']['title']='Intent';  
$report['year_intent']['reference']['field']='year';
 $report['year_intent']['reference']['style']='select';
 $report['year_intent']['reference']['title']='Year';  
  $charts=array();
   	array_push($charts, "line");
   	array_push($charts, "bar");
   	array_push($charts, "pie");
  $report['year_intent']['chart']=$charts;
$report['year_transfo_langauge']['type']='compare';
$report['year_transfo_langauge']['title']='Transformation langage'; 		
$report['year_transfo_langauge']['id']='year_transfo_langauge';
$report['year_transfo_langauge']['link']='false'; 
$report['year_transfo_langauge']['values']['field']='transfo_langauge';
$report['year_transfo_langauge']['values']['style']='select';
$report['year_transfo_langauge']['values']['title']='Transformation language';  
$report['year_transfo_langauge']['reference']['field']='year';
 $report['year_transfo_langauge']['reference']['style']='select';
 $report['year_transfo_langauge']['reference']['title']='Year';  
  $charts=array();
   	array_push($charts, "line");
  $report['year_transfo_langauge']['chart']=$charts;
$report['year_validation']['type']='compare';
$report['year_validation']['title']='Validation'; 		
$report['year_validation']['id']='year_validation';
$report['year_validation']['link']='false'; 
$report['year_validation']['values']['field']='validation';
$report['year_validation']['values']['style']='select';
$report['year_validation']['values']['title']='Validation';  
$report['year_validation']['reference']['field']='year';
 $report['year_validation']['reference']['style']='select';
 $report['year_validation']['reference']['title']='Year';  
  $charts=array();
   	array_push($charts, "line");
  $report['year_validation']['chart']=$charts;
$report['year_scope']['type']='compare';
$report['year_scope']['title']='Scope'; 		
$report['year_scope']['id']='year_scope';
$report['year_scope']['link']='false'; 
$report['year_scope']['values']['field']='scope';
$report['year_scope']['values']['style']='select';
$report['year_scope']['values']['title']='Scope';  
$report['year_scope']['reference']['field']='year';
 $report['year_scope']['reference']['style']='select';
 $report['year_scope']['reference']['title']='Year';  
  $charts=array();
   	array_push($charts, "line");
  $report['year_scope']['chart']=$charts;
$report['year_orientation']['type']='compare';
$report['year_orientation']['title']='Orientation'; 		
$report['year_orientation']['id']='year_orientation';
$report['year_orientation']['link']='false'; 
$report['year_orientation']['values']['field']='orientation';
$report['year_orientation']['values']['style']='select';
$report['year_orientation']['values']['title']='Orientation';  
$report['year_orientation']['reference']['field']='year';
 $report['year_orientation']['reference']['style']='select';
 $report['year_orientation']['reference']['title']='Year';  
  $charts=array();
   	array_push($charts, "line");
   	array_push($charts, "bar");
   	array_push($charts, "pie");
  $report['year_orientation']['chart']=$charts;
$result[ 'report' ]=$report; 		
//REPORTING

return $result;
}
