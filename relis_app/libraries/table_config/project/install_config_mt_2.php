<?php //mt_2
function get_classification_mt_2(){
$reference_tables=array();//from nowit will worklike this
$config=array();
$result['class_action']='no_overide';
$result['screen_action']='override';
$result['qa_action']='override';
$result['project_title']='Model transformation 2 test';
$result['project_short_name']='mt_2';
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

$config['classification']['fields'][ 'industrial']=array( 		
	'category_type'=>'FreeCategory',		
 	'field_title'=>'Industrial',
 	'input_type'=>'text',
 	'field_size'=>20,
 	'field_type'=>'bool',
 	'field_value'=>'0_1',
 	'field_size'=>1,
 	'field_type'=>'int',
 	'input_type'=>'select',
 	'input_select_source'=>'yes_no',
 	'input_select_values'=>'1',
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

$config['classification']['fields'][ 'number_citation']=array( 		
	'category_type'=>'FreeCategory',		
 	'field_title'=>'Number of citations',
 	'input_type'=>'text',
 	'field_size'=>20,
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
$result[ 'report' ]=$report; 		
//REPORTING

return $result;
}
