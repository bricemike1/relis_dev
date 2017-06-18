<?php //sms

function get_classification_sms(){

$reference_tables=array();

$config=array();

$result['project_title']='Systematic mappings in SE2';

$result['project_short_name']='sms';

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



$config['classification']['fields'][ 'domain']=array( 		

	'category_type'=>'IndependantDynamicCategory',		

 	'field_title'=>'Domaine',	

 	'field_type'=>'number',

 	'field_value'=>'normal',

 	'number_of_values'=>'1',//a verifier

 	'mandatory'=>' mandatory ',

 	'field_size'=>11,

 	'input_type'=>'select',

 	'input_select_source'=>'table',

 	'input_select_values'=>'Domaine',

 	'on_add'=>'enabled',

 	'on_edit'=>'enabled',

 	'on_list'=>'show'				

 				);

 	$reference_tables['Domaine']['ref_name'] ='Domaine';   

 	$initial_values=array();

 	array_push($initial_values, "Software Testing");

 	array_push($initial_values, "Software quality");

 	array_push($initial_values, "Software maintenance");

 	array_push($initial_values, "Software Validation");

 	array_push($initial_values, "Other");

 	if(empty($reference_tables['Domaine']['values'])){

 		$reference_tables['Domaine']['values'] =	$initial_values;

 	}else{

 		foreach ($initial_values as $key => $value) {

 			if (!in_array($value, $reference_tables['Domaine']['values'] )){

 				array_push($reference_tables['Domaine']['values'],$value);

 			}

 		}		

 	}

 		

 		

$config['classification']['fields'][ 'document_type']=array( 		

	'category_type'=>'IndependantDynamicCategory',		

 	'field_title'=>'Type de document',	

 	'field_type'=>'number',

 	'field_value'=>'normal',

 	'number_of_values'=>'1',//a verifier

 	'mandatory'=>' mandatory ',

 	'field_size'=>11,

 	'input_type'=>'select',

 	'input_select_source'=>'table',

 	'input_select_values'=>'Type de document',

 	'on_add'=>'enabled',

 	'on_edit'=>'enabled',

 	'on_list'=>'show'				

 				);

 	$reference_tables['Type de document']['ref_name'] ='Type de document';   

 	$initial_values=array();

 	array_push($initial_values, "Conference paper");

 	array_push($initial_values, "Journal article");

 	array_push($initial_values, "Autre");

 	if(empty($reference_tables['Type de document']['values'])){

 		$reference_tables['Type de document']['values'] =	$initial_values;

 	}else{

 		foreach ($initial_values as $key => $value) {

 			if (!in_array($value, $reference_tables['Type de document']['values'] )){

 				array_push($reference_tables['Type de document']['values'],$value);

 			}

 		}		

 	}

 		

 		



$config['classification']['fields'][ 'year']=array( 		

	'category_type'=>'FreeCategory',		

 	'field_title'=>'Année',

 	'field_type'=>'number',

 	'field_value'=>'normal',

 	'number_of_values'=>'0',//a verifier

 	'mandatory'=>' mandatory ',

 	'field_size'=>4,

 	'input_type'=>'int',

 	'pattern'=>'',

 	'initial_value'=>'',

 	'on_add'=>'enabled',

 	'on_edit'=>'enabled',

 	'on_list'=>'show'				

 	);   	



$config['classification']['fields'][ 'nbr_author']=array( 		

	'category_type'=>'FreeCategory',		

 	'field_title'=>'Nombre de participants',

 	'field_type'=>'number',

 	'field_value'=>'normal',

 	'number_of_values'=>'0',//a verifier

 	'mandatory'=>' mandatory ',

 	'field_size'=>4,

 	'input_type'=>'int',

 	'pattern'=>'',

 	'initial_value'=>'',

 	'on_add'=>'enabled',

 	'on_edit'=>'enabled',

 	'on_list'=>'show'				

 	);   	



$config['classification']['fields'][ 'nbr_papers']=array( 		

	'category_type'=>'FreeCategory',		

 	'field_title'=>'Nombre de papiers étudiés',

 	'field_type'=>'number',

 	'field_value'=>'normal',

 	'number_of_values'=>'0',//a verifier

 	'mandatory'=>' mandatory ',

 	'field_size'=>4,

 	'input_type'=>'int',

 	'pattern'=>'',

 	'initial_value'=>'',

 	'on_add'=>'enabled',

 	'on_edit'=>'enabled',

 	'on_list'=>'show'				

 	);   	

$config['papers_source']['table_name']='papers_source';

$config['papers_source']['table_id']='papers_source_id';

$config['papers_source']['table_active_field']='papers_source_active';

$config['papers_source']['reference_title']='Source de papiers';

$config['papers_source']['reference_title_min']='Source de papiers';

$config['papers_source']['main_field']='papers_source';

$config['papers_source']['order_by']='papers_source_id ASC ';

$config['papers_source']['links'][ 'edit']=array(

	   			'label'=>'Edit',

	   			'title'=>'Edit ',

	   			'on_list'=>False,

	   			'on_view'=>True

	   	);



$config['papers_source']['links'][ 'view']=array(

	   			'label'=>'View',

	   			'title'=>'View',

	   			'on_list'=>True,

	   			'on_view'=>True

	   	);

$config['papers_source']['fields']['papers_source_id']=array(

			   	'field_title'=>'#',

			   	'field_type'=>'number',

			   	'field_value'=>'auto_increment',

			   	'on_add'=>'hidden',

			   	'on_edit'=>'hidden',

			   	'on_list'=>'show',

			   	'on_view'=>'hidden'

			   	);

$config['papers_source']['fields']['parent_field_id']=array(

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

				

$config['papers_source']['fields'][ 'papers_source']=array( 		

	'category_type'=>'IndependantDynamicCategory',		

 	'field_title'=>'Source de papiers',	

 	'field_type'=>'number',

 	'field_value'=>'normal',

 	'number_of_values'=>'1',//a verifier

 	'mandatory'=>' mandatory ',

 	'field_size'=>11,

 	'input_type'=>'select',

 	'input_select_source'=>'table',

 	'input_select_values'=>'Source de papiers',

 	'on_add'=>'enabled',

 	'on_edit'=>'enabled',

 	'on_list'=>'show'				

 				);

 	$reference_tables['Source de papiers']['ref_name'] ='Source de papiers';   

 	$initial_values=array();

 	array_push($initial_values, "IEEE xplore");

 	array_push($initial_values, "Google scholar");

 	array_push($initial_values, "Microsoft Academique Search");

 	array_push($initial_values, "CiteSeerX");

 	array_push($initial_values, "Science Direct");

 	array_push($initial_values, "ACM digital library");

 	array_push($initial_values, "SpringerLink");

 	array_push($initial_values, "Scopus");

 	array_push($initial_values, "Compendex");

 	array_push($initial_values, "ISI web of Knowledge");

 	array_push($initial_values, "Inspec");

 	array_push($initial_values, "Elsevier");

 	array_push($initial_values, "Engineering Village");

 	array_push($initial_values, "Autre");

 	if(empty($reference_tables['Source de papiers']['values'])){

 		$reference_tables['Source de papiers']['values'] =	$initial_values;

 	}else{

 		foreach ($initial_values as $key => $value) {

 			if (!in_array($value, $reference_tables['Source de papiers']['values'] )){

 				array_push($reference_tables['Source de papiers']['values'],$value);

 			}

 		}		

 	}

 		

 		

$config['papers_source']['fields']['papers_source_active']=array(

					   	'field_title'=>'Active',

					   	'field_type'=>'0_1',

					   	'field_value'=>'normal',				

					   	'on_add'=>'not_set',

					   	'on_edit'=>'not_set',

					   	'on_list'=>'hidden',

					   	'on_view'=>'hidden'

			);

			

$config['classification']['fields'][ 'papers_source']=array( 		

	'category_type'=>'WithMultiValues',		

 	'field_title'=>'Source de papiers',	

 	'field_type'=>'number',

 	'field_value'=>'normal',

 	'number_of_values'=>'10',//a verifier

 	

 	'mandatory'=>' mandatory ',

 	'field_size'=>11,

 	'input_type'=>'select',

 	'input_select_source'=>'table',

 	'input_select_values'=>'papers_source',

 	'input_select_key_field'=>'parent_field_id',

 	'input_select_source_type'=>'normal',

 	'multi-select' => 'Yes',

 	'on_add'=>'enabled',

 	'on_edit'=>'enabled',

 	'compute_result'=>'no',

 	'on_list'=>'hidden'				

 				);			



$config['classification']['fields'][ 'process']=array( 		

	'category_type'=>'IndependantDynamicCategory',		

 	'field_title'=>'Processuss suivie',	

 	'field_type'=>'number',

 	'field_value'=>'normal',

 	'number_of_values'=>'1',//a verifier

 	'mandatory'=>' mandatory ',

 	'field_size'=>11,

 	'input_type'=>'select',

 	'input_select_source'=>'table',

 	'input_select_values'=>'Processuss suivie',

 	'on_add'=>'enabled',

 	'on_edit'=>'enabled',

 	'on_list'=>'show'				

 				);

 	$reference_tables['Processuss suivie']['ref_name'] ='Processuss suivie';   

 	$initial_values=array();

 	array_push($initial_values, "Petersen et Al.");

 	array_push($initial_values, "Kitchenham et al");

 	array_push($initial_values, "Les deux");

 	array_push($initial_values, "Non mentionné");

 	if(empty($reference_tables['Processuss suivie']['values'])){

 		$reference_tables['Processuss suivie']['values'] =	$initial_values;

 	}else{

 		foreach ($initial_values as $key => $value) {

 			if (!in_array($value, $reference_tables['Processuss suivie']['values'] )){

 				array_push($reference_tables['Processuss suivie']['values'],$value);

 			}

 		}		

 	}

 		

 		



$config['classification']['fields'][ 'screening_tool']=array( 		

	'category_type'=>'FreeCategory',		

 	'field_title'=>'Outil pour le screening',

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



$config['classification']['fields'][ 'classification_tool']=array( 		

	'category_type'=>'FreeCategory',		

 	'field_title'=>' pour la classsification',

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



$config['classification']['fields'][ 'note']=array( 		

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

