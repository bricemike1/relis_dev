<?php //mt_bms

function get_classification_mt_bms(){

$reference_tables=array();//from nowit will worklike this

$config=array();

$result['project_title']='Model transformation BM Depends Xtextv';

$result['project_short_name']='mt_bms';

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

 	'field_title'=>'Transformation namesszzss',

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

$config['text_multi']['table_name']='text_multi';

$config['text_multi']['table_id']='text_multi_id';

$config['text_multi']['table_active_field']='text_multi_active';

$config['text_multi']['reference_title']='text_multi name5';

$config['text_multi']['reference_title_min']='text_multi name5';

$config['text_multi']['main_field']='text_multi';

$config['text_multi']['order_by']='text_multi_id ASC ';

$config['text_multi']['links'][ 'edit']=array(

	   			'label'=>'Edit',

	   			'title'=>'Edit ',

	   			'on_list'=>False,

	   			'on_view'=>True

	   	);



$config['text_multi']['links'][ 'view']=array(

	   			'label'=>'View',

	   			'title'=>'View',

	   			'on_list'=>True,

	   			'on_view'=>True

	   	);

$config['text_multi']['fields']['text_multi_id']=array(

			   	'field_title'=>'#',

			   	'field_type'=>'number',

			   	'field_value'=>'auto_increment',

			   	'on_add'=>'hidden',

			   	'on_edit'=>'hidden',

			   	'on_list'=>'show',

			   	'on_view'=>'hidden'

			   	);

$config['text_multi']['fields']['parent_field_id']=array(

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

				



$config['text_multi']['fields'][ 'text_multi']=array( 		

	'category_type'=>'FreeCategory',		

 	'field_title'=>'text_multi name5',

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

$config['text_multi']['fields']['text_multi_active']=array(

					   	'field_title'=>'Active',

					   	'field_type'=>'0_1',

					   	'field_value'=>'normal',				

					   	'on_add'=>'not_set',

					   	'on_edit'=>'not_set',

					   	'on_list'=>'hidden',

					   	'on_view'=>'hidden'

			);

			

$config['classification']['fields'][ 'text_multi']=array( 		

	'category_type'=>'WithMultiValues',		

 	'field_title'=>'text_multi name5',	

 	'field_type'=>'number',

 	'field_value'=>'normal',

 	'number_of_values'=>'5',//a verifier

 	

 	'mandatory'=>' mandatory ',

 	'field_size'=>11,

 	'input_type'=>'select',

 	'input_select_source'=>'table',

 	'input_select_values'=>'text_multi',

 	'input_select_key_field'=>'parent_field_id',

 	'input_select_source_type'=>'normal',

 	'multi-select' => 'Yes',

 	'on_add'=>'enabled',

 	'on_edit'=>'enabled',

 	'compute_result'=>'no',

 	'on_list'=>'hidden'				

 				);			



$config['domain']['table_name']='domain';

$config['domain']['table_id']='domain_id';

$config['domain']['table_active_field']='domain_active';

$config['domain']['reference_title']='Domain';

$config['domain']['reference_title_min']='Domain';

$config['domain']['main_field']='domain';

$config['domain']['order_by']='domain_id ASC ';

$config['domain']['links'][ 'edit']=array(

	   			'label'=>'Edit',

	   			'title'=>'Edit ',

	   			'on_list'=>False,

	   			'on_view'=>True

	   	);



$config['domain']['links'][ 'view']=array(

	   			'label'=>'View',

	   			'title'=>'View',

	   			'on_list'=>True,

	   			'on_view'=>True

	   	);

$config['domain']['fields']['domain_id']=array(

			   	'field_title'=>'#',

			   	'field_type'=>'number',

			   	'field_value'=>'auto_increment',

			   	'on_add'=>'hidden',

			   	'on_edit'=>'hidden',

			   	'on_list'=>'show',

			   	'on_view'=>'hidden'

			   	);

$config['domain']['fields']['parent_field_id']=array(

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

				

$config['domain']['fields'][ 'domain']=array( 		

	'category_type'=>'IndependantDynamicCategory',		

 	'field_title'=>'Domain',	

 	'field_type'=>'number',

 	'field_value'=>'normal',

 	'number_of_values'=>'1',//a verifier

 	'mandatory'=>' mandatory ',

 	'field_size'=>11,

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

 	array_push($initial_values, "Collaborative systeme");

 	array_push($initial_values, "Compilation");

 	array_push($initial_values, "E-commerce");

 	array_push($initial_values, "Anny");

 	if(empty($reference_tables['Domain']['values'])){

 		$reference_tables['Domain']['values'] =	$initial_values;

 	}else{

 		foreach ($initial_values as $key => $value) {

 			if (!in_array($value, $reference_tables['Domain']['values'] )){

 				array_push($reference_tables['Domain']['values'],$value);

 			}

 		}		

 	}

 		

 		

$config['domain']['fields']['domain_active']=array(

					   	'field_title'=>'Active',

					   	'field_type'=>'0_1',

					   	'field_value'=>'normal',				

					   	'on_add'=>'not_set',

					   	'on_edit'=>'not_set',

					   	'on_list'=>'hidden',

					   	'on_view'=>'hidden'

			);

			

$config['classification']['fields'][ 'domain']=array( 		

	'category_type'=>'WithMultiValues',		

 	'field_title'=>'Domain',	

 	'field_type'=>'number',

 	'field_value'=>'normal',

 	'number_of_values'=>'8',//a verifier

 	

 	'mandatory'=>' mandatory ',

 	'field_size'=>11,

 	'input_type'=>'select',

 	'input_select_source'=>'table',

 	'input_select_values'=>'domain',

 	'input_select_key_field'=>'parent_field_id',

 	'input_select_source_type'=>'normal',

 	'multi-select' => 'Yes',

 	'on_add'=>'enabled',

 	'on_edit'=>'enabled',

 	'compute_result'=>'no',

 	'on_list'=>'hidden'				

 				);			



$config['classification']['fields'][ 'intent_1']=array( 		

	'category_type'=>'IndependantDynamicCategory',		

 	'field_title'=>'Intent 1',	

 	'field_type'=>'number',

 	'field_value'=>'normal',

 	'number_of_values'=>'1',//a verifier

 	'field_size'=>11,

 	'input_type'=>'select',

 	'input_select_source'=>'table',

 	'input_select_values'=>'intent_1',

 	'on_add'=>'enabled',

 	'on_edit'=>'enabled',

 	'on_list'=>'show'				

 				);

 	$reference_tables['intent_1']['ref_name'] ='intent_1';   

 	$initial_values=array();

 	if(empty($reference_tables['intent_1']['values'])){

 		$reference_tables['intent_1']['values'] =	$initial_values;

 	}else{

 		foreach ($initial_values as $key => $value) {

 			if (!in_array($value, $reference_tables['intent_1']['values'] )){

 				array_push($reference_tables['intent_1']['values'],$value);

 			}

 		}		

 	}

 		

 		

$config['classification']['fields'][ 'intent']=array( 		

	'category_type'=>'IndependantDynamicCategory',		

 	'field_title'=>'Intent',	

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

 		

 		



$config['classification']['fields'][ 'transformation_name2']=array( 		

	'category_type'=>'FreeCategory',		

 	'field_title'=>'Transformation namesszzss',

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



// end project specific area

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



 		

$screening=array();

$screening['review_per_paper']='2';

$screening['conflict_type']='IncludeExclude';

$screening['conflict_resolution']='Majority';

$screening['validation_assigment_mode']='Normal';

$screening['validation_percentage']='30';

$screening['exclusion_criteria']=array();

array_push($screening['exclusion_criteria'], "Criteria 1");

array_push($screening['exclusion_criteria'], "Criteria 2");

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

 										'fields'=>'Title|Abstract|',

 										)

 );



$result[ 'screening' ]=$screening; 		



//SCREENING area



return $result;

}

