<?php //mt_class
function get_classification_mt_class(){
$reference_tables=array();//from nowit will worklike this
$config=array();
$result['class_action']='override';
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
$config['classification']['fields'][ 'domain']=array( 		
	'category_type'=>'IndependantDynamicCategory',		
 	'field_title'=>'Domain',	
 	'field_type'=>'int',
 	'field_size'=>11,
 	//'field_value'=>'normal',
 	'number_of_values'=>'1',//a verifier
 	
 	'input_type'=>'select',
 	'input_select_source'=>'table',
 	'input_select_values'=>'Domain',
 	'on_add'=>'enabled',
 	'on_edit'=>'enabled',
 	'on_list'=>'show'				
 				);
 	$reference_tables['Domain']['ref_name'] ='Domain';   
 	$initial_values=array();
 	array_push($initial_values, "Artificial Intelligence");
 	array_push($initial_values, "Collaborative system");
 	array_push($initial_values, "Compilation");
 	array_push($initial_values, "E-commerce");
 	array_push($initial_values, "HOT");
 	if(empty($reference_tables['Domain']['values'])){
 		$reference_tables['Domain']['values'] =	$initial_values;
 	}else{
 		foreach ($initial_values as $key => $value) {
 			if (!in_array($value, $reference_tables['Domain']['values'] )){
 				array_push($reference_tables['Domain']['values'],$value);
 			}
 		}		
 	}
 		
 		
$config['trans_language']['table_name']='trans_language';
$config['trans_language']['table_id']='trans_language_id';
$config['trans_language']['table_active_field']='trans_language_active';
$config['trans_language']['main_field']='trans_language';
$config['trans_language']['order_by']='trans_language_id ASC ';


$config['trans_language']['reference_title']='Transformation Language';
$config['trans_language']['reference_title_min']='Transformation Language';
		
$config['trans_language']['entity_label_plural']='Transformation Language';
$config['trans_language']['entity_label']='Transformation Language';


$config['trans_language']['links'][ 'edit']=array(
	   			'label'=>'Edit',
	   			'title'=>'Edit ',
	   			'on_list'=>False,
	   			'on_view'=>True
	   	);

$config['trans_language']['links'][ 'view']=array(
	   			'label'=>'View',
	   			'title'=>'View',
	   			'on_list'=>True,
	   			'on_view'=>True
	   	);
	   	
$config['trans_language']['fields']['trans_language_id']=array(
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
$config['trans_language']['fields']['parent_field_id']=array(
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
				
$config['trans_language']['fields'][ 'trans_language']=array( 		
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
 	array_push($initial_values, "ATL");
 	array_push($initial_values, "Henshin");
 	array_push($initial_values, "MoTiF");
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
 		
 		
$config['trans_language']['fields']['trans_language_active']=array(
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
$config['trans_language']['operations']=array();
			
$config['classification']['fields'][ 'trans_language']=array( 		
	'category_type'=>'WithMultiValues',		
 	'field_title'=>'Transformation Language',	
 	'field_type'=>'int',
 	'field_size'=>11,
 	//'field_value'=>'normal',
 	'number_of_values'=>'10',//a verifier
 	
 	
 	'input_type'=>'select',
 	'input_select_source'=>'table',
 	'input_select_values'=>'trans_language',
 	'input_select_key_field'=>'parent_field_id',
 	'input_select_source_type'=>'normal',
 	'multi-select' => 'Yes',
 	'on_add'=>'enabled',
 	'on_edit'=>'enabled',
 	'compute_result'=>'no',
 	'on_list'=>'show'				
 				);			

$config['classification']['fields'][ 'source_language']=array( 		
	'category_type'=>'IndependantDynamicCategory',		
 	'field_title'=>'Source language',	
 	'field_type'=>'int',
 	'field_size'=>11,
 	//'field_value'=>'normal',
 	'number_of_values'=>'1',//a verifier
 	
 	'input_type'=>'select',
 	'input_select_source'=>'table',
 	'input_select_values'=>'Language',
 	'on_add'=>'enabled',
 	'on_edit'=>'enabled',
 	'on_list'=>'show'				
 				);
 	$reference_tables['Language']['ref_name'] ='Language';   
 	$initial_values=array();
 	array_push($initial_values, "DSL");
 	array_push($initial_values, "Java");
 	array_push($initial_values, "SySML");
 	array_push($initial_values, "UML");
 	if(empty($reference_tables['Language']['values'])){
 		$reference_tables['Language']['values'] =	$initial_values;
 	}else{
 		foreach ($initial_values as $key => $value) {
 			if (!in_array($value, $reference_tables['Language']['values'] )){
 				array_push($reference_tables['Language']['values'],$value);
 			}
 		}		
 	}
 		
 		
$config['classification']['fields'][ 'target_language']=array( 		
	'category_type'=>'IndependantDynamicCategory',		
 	'field_title'=>'Target language',	
 	'field_type'=>'int',
 	'field_size'=>11,
 	//'field_value'=>'normal',
 	'number_of_values'=>'1',//a verifier
 	
 	'input_type'=>'select',
 	'input_select_source'=>'table',
 	'input_select_values'=>'Language',
 	'on_add'=>'enabled',
 	'on_edit'=>'enabled',
 	'on_list'=>'show'				
 				);
 	$reference_tables['Language']['ref_name'] ='Language';   
 	$initial_values=array();
 	if(empty($reference_tables['Language']['values'])){
 		$reference_tables['Language']['values'] =	$initial_values;
 	}else{
 		foreach ($initial_values as $key => $value) {
 			if (!in_array($value, $reference_tables['Language']['values'] )){
 				array_push($reference_tables['Language']['values'],$value);
 			}
 		}		
 	}
 		
 		
$config['scope']['table_name']='scope';
$config['scope']['table_id']='scope_id';
$config['scope']['table_active_field']='scope_active';
$config['scope']['main_field']='scope';
$config['scope']['order_by']='scope_id ASC ';


$config['scope']['reference_title']='Scope';
$config['scope']['reference_title_min']='Scope';
		
$config['scope']['entity_label_plural']='Scope';
$config['scope']['entity_label']='Scope';


$config['scope']['links'][ 'edit']=array(
	   			'label'=>'Edit',
	   			'title'=>'Edit ',
	   			'on_list'=>False,
	   			'on_view'=>True
	   	);

$config['scope']['links'][ 'view']=array(
	   			'label'=>'View',
	   			'title'=>'View',
	   			'on_list'=>True,
	   			'on_view'=>True
	   	);
	   	
$config['scope']['fields']['scope_id']=array(
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
$config['scope']['fields']['parent_field_id']=array(
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
				
$config['scope']['fields'][ 'scope']=array( 		
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
 		
 		
$config['scope']['fields']['scope_active']=array(
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
$config['scope']['operations']=array();
			
$config['classification']['fields'][ 'scope']=array( 		
	'category_type'=>'WithMultiValues',		
 	'field_title'=>'Scope',	
 	'field_type'=>'int',
 	'field_size'=>11,
 	//'field_value'=>'normal',
 	'number_of_values'=>'10',//a verifier
 	
 	
 	'input_type'=>'select',
 	'input_select_source'=>'table',
 	'input_select_values'=>'scope',
 	'input_select_key_field'=>'parent_field_id',
 	'input_select_source_type'=>'normal',
 	'multi-select' => 'Yes',
 	'on_add'=>'enabled',
 	'on_edit'=>'enabled',
 	'compute_result'=>'no',
 	'on_list'=>'show'				
 				);			


$config['classification']['fields'][ 'year']=array( 		
	'category_type'=>'FreeCategory',		
 	'field_title'=>'Targeted year',
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

$config['classification']['fields'][ 'moyenne']=array( 		
	'category_type'=>'FreeCategory',		
 	'field_title'=>'Moyenne',
 	'input_type'=>'text',
 	'field_size'=>20,
 	'field_type'=>'real',
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
$result[ 'report' ]=$report; 		
//REPORTING

return $result;
}
