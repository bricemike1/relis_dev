<?php //apiu



function get_classification_apiu(){



$reference_tables=array();



$config=array();



$result['project_title']='API Usability';



$result['project_short_name']='apiu';



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







$config['classification']['fields'][ 'study']=array( 		



	'category_type'=>'IndependantDynamicCategory',		



 	'field_title'=>'Study',	



 	'field_type'=>'number',



 	'field_value'=>'normal',



 	'number_of_values'=>'1',//a verifier



 	'mandatory'=>' mandatory ',



 	'field_size'=>11,



 	'input_type'=>'select',



 	'input_select_source'=>'table',



 	'input_select_values'=>'Study',



 	'on_add'=>'enabled',



 	'on_edit'=>'enabled',



 	'on_list'=>'show'				



 				);



 	$reference_tables['Study']['ref_name'] ='Study';   



 	$initial_values=array();



 	array_push($initial_values, "Cas");



 	array_push($initial_values, "Empirique");



 	array_push($initial_values, "Exploratoire");



 	array_push($initial_values, "Observatoire");



 	array_push($initial_values, "Qualitative");



 	array_push($initial_values, "Quantitative");



 	array_push($initial_values, "Revue de littérature");



 	array_push($initial_values, "Utilisateur");



 	array_push($initial_values, "Aucune");



 	array_push($initial_values, "Autre");



 	if(empty($reference_tables['Study']['values'])){



 		$reference_tables['Study']['values'] =	$initial_values;



 	}else{



 		foreach ($initial_values as $key => $value) {



 			if (!in_array($value, $reference_tables['Study']['values'] )){



 				array_push($reference_tables['Study']['values'],$value);



 			}



 		}		



 	}



 		



 		







$config['classification']['fields'][ 'validation']=array( 		



	'category_type'=>'FreeCategory',		



 	'field_title'=>'Validation',



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



$config['classification']['fields'][ 'contribution']=array( 		



	'category_type'=>'IndependantDynamicCategory',		



 	'field_title'=>'Contribution',	



 	'field_type'=>'number',



 	'field_value'=>'normal',



 	'number_of_values'=>'1',//a verifier



 	'mandatory'=>' mandatory ',



 	'field_size'=>11,



 	'input_type'=>'select',



 	'input_select_source'=>'table',



 	'input_select_values'=>'Contribution',



 	'on_add'=>'enabled',



 	'on_edit'=>'enabled',



 	'on_list'=>'show'				



 				);



 	$reference_tables['Contribution']['ref_name'] ='Contribution';   



 	$initial_values=array();



 	array_push($initial_values, "Détection d artéfact");



 	array_push($initial_values, "Mesure");



 	array_push($initial_values, "Etude empirique");



 	if(empty($reference_tables['Contribution']['values'])){



 		$reference_tables['Contribution']['values'] =	$initial_values;



 	}else{



 		foreach ($initial_values as $key => $value) {



 			if (!in_array($value, $reference_tables['Contribution']['values'] )){



 				array_push($reference_tables['Contribution']['values'],$value);



 			}



 		}		



 	}



 		



 		







$config['classification']['fields'][ 'artefact']=array( 		



	'category_type'=>'FreeCategory',		



 	'field_title'=>'Détection d artéfact',



 	'field_type'=>'text',



 	'field_value'=>'normal',



 	'number_of_values'=>'1',//a verifier



 	'field_size'=>100,



 	'input_type'=>'text',



 	'pattern'=>'',



 	'initial_value'=>'',



 	'on_add'=>'enabled',



 	'on_edit'=>'enabled',



 	'on_list'=>'show'				



 	);   	



$config['stade']['table_name']='stade';



$config['stade']['table_id']='stade_id';



$config['stade']['table_active_field']='stade_active';



$config['stade']['reference_title']='Stade de contribution';



$config['stade']['reference_title_min']='Stade de contribution';



$config['stade']['main_field']='stade';



$config['stade']['order_by']='stade_id ASC ';



$config['stade']['links'][ 'edit']=array(



	   			'label'=>'Edit',



	   			'title'=>'Edit ',



	   			'on_list'=>False,



	   			'on_view'=>True



	   	);







$config['stade']['links'][ 'view']=array(



	   			'label'=>'View',



	   			'title'=>'View',



	   			'on_list'=>True,



	   			'on_view'=>True



	   	);



$config['stade']['fields']['stade_id']=array(



			   	'field_title'=>'#',



			   	'field_type'=>'number',



			   	'field_value'=>'auto_increment',



			   	'on_add'=>'hidden',



			   	'on_edit'=>'hidden',



			   	'on_list'=>'show',



			   	'on_view'=>'hidden'



			   	);



$config['stade']['fields']['parent_field_id']=array(



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



				



$config['stade']['fields'][ 'stade']=array( 		



	'category_type'=>'IndependantDynamicCategory',		



 	'field_title'=>'Stade de contribution',	



 	'field_type'=>'number',



 	'field_value'=>'normal',



 	'number_of_values'=>'1',//a verifier



 	'mandatory'=>' mandatory ',



 	'field_size'=>11,



 	'input_type'=>'select',



 	'input_select_source'=>'table',



 	'input_select_values'=>'Stade de contribution',



 	'on_add'=>'enabled',



 	'on_edit'=>'enabled',



 	'on_list'=>'show'				



 				);



 	$reference_tables['Stade de contribution']['ref_name'] ='Stade de contribution';   



 	$initial_values=array();



 	array_push($initial_values, "Avant développement");



 	array_push($initial_values, "Pendant développement");



 	array_push($initial_values, "Post développement");



 	if(empty($reference_tables['Stade de contribution']['values'])){



 		$reference_tables['Stade de contribution']['values'] =	$initial_values;



 	}else{



 		foreach ($initial_values as $key => $value) {



 			if (!in_array($value, $reference_tables['Stade de contribution']['values'] )){



 				array_push($reference_tables['Stade de contribution']['values'],$value);



 			}



 		}		



 	}



 		



 		



$config['stade']['fields']['stade_active']=array(



					   	'field_title'=>'Active',



					   	'field_type'=>'0_1',



					   	'field_value'=>'normal',				



					   	'on_add'=>'not_set',



					   	'on_edit'=>'not_set',



					   	'on_list'=>'hidden',



					   	'on_view'=>'hidden'



			);



			



$config['classification']['fields'][ 'stade']=array( 		



	'category_type'=>'WithMultiValues',		



 	'field_title'=>'Stade de contribution',	



 	'field_type'=>'number',



 	'field_value'=>'normal',



 	'number_of_values'=>'3',//a verifier



 	



 	'mandatory'=>' mandatory ',



 	'field_size'=>11,



 	'input_type'=>'select',



 	'input_select_source'=>'table',



 	'input_select_values'=>'stade',



 	'input_select_key_field'=>'parent_field_id',



 	'input_select_source_type'=>'normal',



 	'multi-select' => 'Yes',



 	'on_add'=>'enabled',



 	'on_edit'=>'enabled',



 	'compute_result'=>'no',



 	'on_list'=>'hidden'				



 				);			







$config['classification']['fields'][ 'data']=array( 		



	'category_type'=>'IndependantDynamicCategory',		



 	'field_title'=>'Sources de données',	



 	'field_type'=>'number',



 	'field_value'=>'normal',



 	'number_of_values'=>'1',//a verifier



 	'mandatory'=>' mandatory ',



 	'field_size'=>11,



 	'input_type'=>'select',



 	'input_select_source'=>'table',



 	'input_select_values'=>'Sources de données',



 	'on_add'=>'enabled',



 	'on_edit'=>'enabled',



 	'on_list'=>'show'				



 				);



 	$reference_tables['Sources de données']['ref_name'] ='Sources de données';   



 	$initial_values=array();



 	array_push($initial_values, "Données industrielles");



 	array_push($initial_values, "Données Open Source");



 	array_push($initial_values, "Données d enquête");



 	array_push($initial_values, "Données hybrides");



 	if(empty($reference_tables['Sources de données']['values'])){



 		$reference_tables['Sources de données']['values'] =	$initial_values;



 	}else{



 		foreach ($initial_values as $key => $value) {



 			if (!in_array($value, $reference_tables['Sources de données']['values'] )){



 				array_push($reference_tables['Sources de données']['values'],$value);



 			}



 		}		



 	}



 		



 		







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



