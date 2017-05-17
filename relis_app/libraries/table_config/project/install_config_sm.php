<?php //sm

function get_classification_sm(){

$reference_tables=array();

$config=array();

$result['project_title']='Systematic mappings in SE';

$result['project_short_name']='sm';

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

	'category_type'=>'FreeCategory',		

 	'field_title'=>'Domaine cible',

 	'field_type'=>'text',

 	'field_value'=>'normal',

 	'number_of_values'=>'0',//a verifier

 	'mandatory'=>' mandatory ',

 	'field_size'=>500,

 	'input_type'=>'text',

 	'pattern'=>'',

 	'initial_value'=>'',

 	'on_add'=>'enabled',

 	'on_edit'=>'enabled',

 	'on_list'=>'show'				

 	);   	



$config['classification']['fields'][ 'conference']=array( 		

	'category_type'=>'FreeCategory',		

 	'field_title'=>'Conference',

 	'field_type'=>'text',

 	'field_value'=>'normal',

 	'number_of_values'=>'0',//a verifier

 	'mandatory'=>' mandatory ',

 	'field_size'=>500,

 	'input_type'=>'text',

 	'pattern'=>'',

 	'initial_value'=>'',

 	'on_add'=>'enabled',

 	'on_edit'=>'enabled',

 	'on_list'=>'show'				

 	);   	



$config['classification']['fields'][ 'year']=array( 		

	'category_type'=>'FreeCategory',		

 	'field_title'=>'Année',

 	'field_type'=>'text',

 	'field_value'=>'normal',

 	'number_of_values'=>'0',//a verifier

 	'mandatory'=>' mandatory ',

 	'field_size'=>500,

 	'input_type'=>'text',

 	'pattern'=>'',

 	'initial_value'=>'',

 	'on_add'=>'enabled',

 	'on_edit'=>'enabled',

 	'on_list'=>'show'				

 	);   	



$config['classification']['fields'][ 'participants']=array( 		

	'category_type'=>'FreeCategory',		

 	'field_title'=>'Nombre de participants(auteurs)',

 	'field_type'=>'text',

 	'field_value'=>'normal',

 	'number_of_values'=>'0',//a verifier

 	'mandatory'=>' mandatory ',

 	'field_size'=>500,

 	'input_type'=>'text',

 	'pattern'=>'',

 	'initial_value'=>'',

 	'on_add'=>'enabled',

 	'on_edit'=>'enabled',

 	'on_list'=>'show'				

 	);   	



$config['classification']['fields'][ 'papers']=array( 		

	'category_type'=>'FreeCategory',		

 	'field_title'=>'Nombre de papiers dans l étude',

 	'field_type'=>'text',

 	'field_value'=>'normal',

 	'number_of_values'=>'0',//a verifier

 	'mandatory'=>' mandatory ',

 	'field_size'=>500,

 	'input_type'=>'text',

 	'pattern'=>'',

 	'initial_value'=>'',

 	'on_add'=>'enabled',

 	'on_edit'=>'enabled',

 	'on_list'=>'show'				

 	);   	



$config['classification']['fields'][ 'source']=array( 		

	'category_type'=>'FreeCategory',		

 	'field_title'=>'Source de papiers',

 	'field_type'=>'text',

 	'field_value'=>'normal',

 	'number_of_values'=>'0',//a verifier

 	'mandatory'=>' mandatory ',

 	'field_size'=>500,

 	'input_type'=>'text',

 	'pattern'=>'',

 	'initial_value'=>'',

 	'on_add'=>'enabled',

 	'on_edit'=>'enabled',

 	'on_list'=>'show'				

 	);   	



$config['classification']['fields'][ 'screening_tool']=array( 		

	'category_type'=>'FreeCategory',		

 	'field_title'=>'Outil pour le screening',

 	'field_type'=>'text',

 	'field_value'=>'normal',

 	'number_of_values'=>'0',//a verifier

 	'mandatory'=>' mandatory ',

 	'field_size'=>500,

 	'input_type'=>'text',

 	'pattern'=>'',

 	'initial_value'=>'',

 	'on_add'=>'enabled',

 	'on_edit'=>'enabled',

 	'on_list'=>'show'				

 	);   	



$config['classification']['fields'][ 'classification_tool']=array( 		

	'category_type'=>'FreeCategory',		

 	'field_title'=>'Outil pour la classsification',

 	'field_type'=>'text',

 	'field_value'=>'normal',

 	'number_of_values'=>'0',//a verifier

 	'mandatory'=>' mandatory ',

 	'field_size'=>500,

 	'input_type'=>'text',

 	'pattern'=>'',

 	'initial_value'=>'',

 	'on_add'=>'enabled',

 	'on_edit'=>'enabled',

 	'on_list'=>'show'				

 	);   	



$config['classification']['fields'][ 'process']=array( 		

	'category_type'=>'FreeCategory',		

 	'field_title'=>'Processus suivie',

 	'field_type'=>'text',

 	'field_value'=>'normal',

 	'number_of_values'=>'0',//a verifier

 	'mandatory'=>' mandatory ',

 	'field_size'=>500,

 	'input_type'=>'text',

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

