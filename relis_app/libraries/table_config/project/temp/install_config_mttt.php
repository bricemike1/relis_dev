<?php //mttt



function get_classification_mttt(){



$reference_tables=array();



$config=array();



$result['project_title']='Model transformation Test 2';



$result['project_short_name']='mttt';



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



$config['classification']['fields'][ 'domain']=array( 		



	'category_type'=>'IndependantDynamicCategory',		



 	'field_title'=>'Domain',	



 	'field_type'=>'number',



 	'field_value'=>'normal',



 	'number_of_values'=>'1',//a verifier



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



 	array_push($initial_values, "Collaborative system");



 	array_push($initial_values, "Compilation");



 	array_push($initial_values, "E-commerce");



 	array_push($initial_values, "Any");



 	if(empty($reference_tables['Domain']['values'])){



 		$reference_tables['Domain']['values'] =	$initial_values;



 	}else{



 		foreach ($initial_values as $key => $value) {



 			if (!in_array($value, $reference_tables['Domain']['values'] )){



 				array_push($reference_tables['Domain']['values'],$value);



 			}



 		}		



 	}



 		



 		



$config['classification']['fields'][ 'transformation_language']=array( 		



	'category_type'=>'IndependantDynamicCategory',		



 	'field_title'=>'Transformation language',	



 	'field_type'=>'number',



 	'field_value'=>'normal',



 	'number_of_values'=>'1',//a verifier



 	'field_size'=>11,



 	'input_type'=>'select',



 	'input_select_source'=>'table',



 	'input_select_values'=>'Transformation Language',



 	'on_add'=>'enabled',



 	'on_edit'=>'enabled',



 	'on_list'=>'show'				



 				);



 	$reference_tables['Transformation Language']['ref_name'] ='Transformation Language';   



 	$initial_values=array();



 	array_push($initial_values, "MoTif");



 	array_push($initial_values, "ATL");



 	array_push($initial_values, "Henshin");



 	array_push($initial_values, "QVT");



 	if(empty($reference_tables['Transformation Language']['values'])){



 		$reference_tables['Transformation Language']['values'] =	$initial_values;



 	}else{



 		foreach ($initial_values as $key => $value) {



 			if (!in_array($value, $reference_tables['Transformation Language']['values'] )){



 				array_push($reference_tables['Transformation Language']['values'],$value);



 			}



 		}		



 	}



 		



 		



$config['classification']['fields'][ 'source_language']=array( 		



	'category_type'=>'IndependantDynamicCategory',		



 	'field_title'=>'Source language',	



 	'field_type'=>'number',



 	'field_value'=>'normal',



 	'number_of_values'=>'1',//a verifier



 	'field_size'=>11,



 	'input_type'=>'select',



 	'input_select_source'=>'table',



 	'input_select_values'=>'Language',



 	'on_add'=>'enabled',



 	'on_edit'=>'enabled',



 	'on_list'=>'show'				



 				);



 	$reference_tables['Language']['ref_name'] ='Language';   



 	$initial_values=array();



 	array_push($initial_values, "UML");



 	array_push($initial_values, "SySML");



 	array_push($initial_values, "Java");



 	array_push($initial_values, "DSL");



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



 	'field_type'=>'number',



 	'field_value'=>'normal',



 	'number_of_values'=>'1',//a verifier



 	'field_size'=>11,



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



 		



 		



$config['classification']['fields'][ 'Scope']=array( 		



	'category_type'=>'StaticCategory',		



 	'field_title'=>'Scope',	



 	'field_type'=>'text',



 	'field_value'=>'normal',



 	'number_of_values'=>'1',// a  verifier



 	'mandatory'=>' mandatory ',



 	'field_size'=>10,



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



 		



 		







$config['classification']['fields'][ 'Industrial']=array( 		



	'category_type'=>'FreeCategory',		



 	'field_title'=>'Industrial',



 	'field_type'=>'text',



 	'field_value'=>'normal',



 	'number_of_values'=>'0',//a verifier



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







$config['classification']['fields'][ 'hot']=array( 		



	'category_type'=>'FreeCategory',		



 	'field_title'=>'HOT',



 	'field_type'=>'text',



 	'field_value'=>'normal',



 	'number_of_values'=>'0',//a verifier



 	'mandatory'=>' mandatory ',



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



 	'number_of_values'=>'0',//a verifier



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







$config['classification']['fields'][ 'implementation']=array( 		



	'category_type'=>'FreeCategory',		



 	'field_title'=>'Implementation Available',



 	'field_type'=>'text',



 	'field_value'=>'normal',



 	'number_of_values'=>'0',//a verifier



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



return $result;



}



