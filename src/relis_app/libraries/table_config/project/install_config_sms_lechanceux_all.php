<?php //sms_lechanceux_all
function get_classification_sms_lechanceux_all(){
$reference_tables=array();//from nowit will worklike this
$config=array();
$result['class_action']='no_overide';
$result['screen_action']='override';
$result['qa_action']='override';
$result['project_title']='Template-based Code Generation All';
$result['project_short_name']='sms_lechanceux_all';
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

$config['classification']['fields'][ 'template_style']=array( 		
	'category_type'=>'IndependantDynamicCategory',		
 	'field_title'=>'Template style',	
 	'field_type'=>'int',
 	'field_size'=>11,
 	//'field_value'=>'normal',
 	'number_of_values'=>'1',//a verifier
 	'mandatory'=>' mandatory ',
 	
 	'input_type'=>'select',
 	'input_select_source'=>'table',
 	'input_select_values'=>'Template style',
 	'on_add'=>'enabled',
 	'on_edit'=>'enabled',
 	'on_list'=>'show'				
 				);
 	$reference_tables['Template style']['ref_name'] ='Template style';   
 	$initial_values=array();
 	array_push($initial_values, "Predefined");
 	array_push($initial_values, "Output-based");
 	array_push($initial_values, "Rule-based");
 	if(empty($reference_tables['Template style']['values'])){
 		$reference_tables['Template style']['values'] =	$initial_values;
 	}else{
 		foreach ($initial_values as $key => $value) {
 			if (!in_array($value, $reference_tables['Template style']['values'] )){
 				array_push($reference_tables['Template style']['values'],$value);
 			}
 		}		
 	}
 		
 		

$config['classification']['fields'][ 'comment_template_style']=array( 		
	'category_type'=>'FreeCategory',		
 	'field_title'=>'Comment for Template style',
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
$config['classification']['fields'][ 'design_time']=array( 		
	'category_type'=>'IndependantDynamicCategory',		
 	'field_title'=>'Design-time input type',	
 	'field_type'=>'int',
 	'field_size'=>11,
 	//'field_value'=>'normal',
 	'number_of_values'=>'1',//a verifier
 	'mandatory'=>' mandatory ',
 	
 	'input_type'=>'select',
 	'input_select_source'=>'table',
 	'input_select_values'=>'Design-time input type',
 	'on_add'=>'enabled',
 	'on_edit'=>'enabled',
 	'on_list'=>'show'				
 				);
 	$reference_tables['Design-time input type']['ref_name'] ='Design-time input type';   
 	$initial_values=array();
 	array_push($initial_values, "General purpose");
 	array_push($initial_values, "Domain specific");
 	array_push($initial_values, "Schema");
 	array_push($initial_values, "Programming Language");
 	if(empty($reference_tables['Design-time input type']['values'])){
 		$reference_tables['Design-time input type']['values'] =	$initial_values;
 	}else{
 		foreach ($initial_values as $key => $value) {
 			if (!in_array($value, $reference_tables['Design-time input type']['values'] )){
 				array_push($reference_tables['Design-time input type']['values'],$value);
 			}
 		}		
 	}
 		
 		

$config['classification']['fields'][ 'comment_design_time']=array( 		
	'category_type'=>'FreeCategory',		
 	'field_title'=>'Comment for Design-time input type',
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
$config['classification']['fields'][ 'run_time']=array( 		
	'category_type'=>'IndependantDynamicCategory',		
 	'field_title'=>'Run-time input type',	
 	'field_type'=>'int',
 	'field_size'=>11,
 	//'field_value'=>'normal',
 	'number_of_values'=>'1',//a verifier
 	'mandatory'=>' mandatory ',
 	
 	'input_type'=>'select',
 	'input_select_source'=>'table',
 	'input_select_values'=>'Run-time input type',
 	'on_add'=>'enabled',
 	'on_edit'=>'enabled',
 	'on_list'=>'show'				
 				);
 	$reference_tables['Run-time input type']['ref_name'] ='Run-time input type';   
 	$initial_values=array();
 	array_push($initial_values, "General purpose");
 	array_push($initial_values, "Domain specific");
 	array_push($initial_values, "Structured data");
 	array_push($initial_values, "Source code");
 	if(empty($reference_tables['Run-time input type']['values'])){
 		$reference_tables['Run-time input type']['values'] =	$initial_values;
 	}else{
 		foreach ($initial_values as $key => $value) {
 			if (!in_array($value, $reference_tables['Run-time input type']['values'] )){
 				array_push($reference_tables['Run-time input type']['values'],$value);
 			}
 		}		
 	}
 		
 		

$config['classification']['fields'][ 'comment_run_time']=array( 		
	'category_type'=>'FreeCategory',		
 	'field_title'=>'Comment for Run-time input type',
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
$config['classification']['fields'][ 'output_type']=array( 		
	'category_type'=>'IndependantDynamicCategory',		
 	'field_title'=>'output_type',	
 	'field_type'=>'int',
 	'field_size'=>11,
 	//'field_value'=>'normal',
 	'number_of_values'=>'1',//a verifier
 	'mandatory'=>' mandatory ',
 	
 	'input_type'=>'select',
 	'input_select_source'=>'table',
 	'input_select_values'=>'Output type',
 	'on_add'=>'enabled',
 	'on_edit'=>'enabled',
 	'on_list'=>'show'				
 				);
 	$reference_tables['Output type']['ref_name'] ='Output type';   
 	$initial_values=array();
 	array_push($initial_values, "Source code");
 	array_push($initial_values, "Structured data");
 	array_push($initial_values, "Natural language");
 	if(empty($reference_tables['Output type']['values'])){
 		$reference_tables['Output type']['values'] =	$initial_values;
 	}else{
 		foreach ($initial_values as $key => $value) {
 			if (!in_array($value, $reference_tables['Output type']['values'] )){
 				array_push($reference_tables['Output type']['values'],$value);
 			}
 		}		
 	}
 		
 		

$config['classification']['fields'][ 'comment_output_type']=array( 		
	'category_type'=>'FreeCategory',		
 	'field_title'=>'Comment for output_type',
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
$config['classification']['fields'][ 'tool']=array( 		
	'category_type'=>'IndependantDynamicCategory',		
 	'field_title'=>'Tool',	
 	'field_type'=>'int',
 	'field_size'=>11,
 	//'field_value'=>'normal',
 	'number_of_values'=>'1',//a verifier
 	'mandatory'=>' mandatory ',
 	
 	'input_type'=>'select',
 	'input_select_source'=>'table',
 	'input_select_values'=>'Tool',
 	'on_add'=>'enabled',
 	'on_edit'=>'enabled',
 	'on_list'=>'show'				
 				);
 	$reference_tables['Tool']['ref_name'] ='Tool';   
 	$initial_values=array();
 	array_push($initial_values, "Acceleo");
 	array_push($initial_values, "Xpand");
 	array_push($initial_values, "EGL");
 	array_push($initial_values, "JET");
 	array_push($initial_values, "MOFScript");
 	array_push($initial_values, "Other");
 	array_push($initial_values, "Programmed");
 	array_push($initial_values, "Simulink TLC");
 	array_push($initial_values, "StringTemplate");
 	array_push($initial_values, "T4");
 	array_push($initial_values, "Unspecified");
 	array_push($initial_values, "Velocity");
 	array_push($initial_values, "Rational");
 	array_push($initial_values, "XSLT");
 	array_push($initial_values, "Fujaba");
 	array_push($initial_values, "F   reeMarker");
 	array_push($initial_values, "Rhapsody");
 	array_push($initial_values, "Xtend");
 	if(empty($reference_tables['Tool']['values'])){
 		$reference_tables['Tool']['values'] =	$initial_values;
 	}else{
 		foreach ($initial_values as $key => $value) {
 			if (!in_array($value, $reference_tables['Tool']['values'] )){
 				array_push($reference_tables['Tool']['values'],$value);
 			}
 		}		
 	}
 		
 		

$config['classification']['fields'][ 'comment_tool']=array( 		
	'category_type'=>'FreeCategory',		
 	'field_title'=>'Comment for tool',
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

$config['classification']['fields'][ 'mde']=array( 		
	'category_type'=>'FreeCategory',		
 	'field_title'=>'MDE',
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
$config['classification']['fields'][ 'context']=array( 		
	'category_type'=>'IndependantDynamicCategory',		
 	'field_title'=>'Context',	
 	'field_type'=>'int',
 	'field_size'=>11,
 	//'field_value'=>'normal',
 	'number_of_values'=>'1',//a verifier
 	'mandatory'=>' mandatory ',
 	
 	'input_type'=>'select',
 	'input_select_source'=>'table',
 	'input_select_values'=>'Context',
 	'on_add'=>'enabled',
 	'on_edit'=>'enabled',
 	'on_list'=>'show'				
 				);
 	$reference_tables['Context']['ref_name'] ='Context';   
 	$initial_values=array();
 	array_push($initial_values, "Standalone");
 	array_push($initial_values, "Intermediate");
 	array_push($initial_values, "Last");
 	if(empty($reference_tables['Context']['values'])){
 		$reference_tables['Context']['values'] =	$initial_values;
 	}else{
 		foreach ($initial_values as $key => $value) {
 			if (!in_array($value, $reference_tables['Context']['values'] )){
 				array_push($reference_tables['Context']['values'],$value);
 			}
 		}		
 	}
 		
 		
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
 	array_push($initial_values, "Benchmark");
 	array_push($initial_values, "Case study");
 	array_push($initial_values, "User study");
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
 		
 		
$config['classification']['fields'][ 'scale']=array( 		
	'category_type'=>'IndependantDynamicCategory',		
 	'field_title'=>'Application scale',	
 	'field_type'=>'int',
 	'field_size'=>11,
 	//'field_value'=>'normal',
 	'number_of_values'=>'1',//a verifier
 	'mandatory'=>' mandatory ',
 	
 	'input_type'=>'select',
 	'input_select_source'=>'table',
 	'input_select_values'=>'Application scale',
 	'on_add'=>'enabled',
 	'on_edit'=>'enabled',
 	'on_list'=>'show'				
 				);
 	$reference_tables['Application scale']['ref_name'] ='Application scale';   
 	$initial_values=array();
 	array_push($initial_values, "Small scale");
 	array_push($initial_values, "Large scale");
 	array_push($initial_values, "No application");
 	if(empty($reference_tables['Application scale']['values'])){
 		$reference_tables['Application scale']['values'] =	$initial_values;
 	}else{
 		foreach ($initial_values as $key => $value) {
 			if (!in_array($value, $reference_tables['Application scale']['values'] )){
 				array_push($reference_tables['Application scale']['values'],$value);
 			}
 		}		
 	}
 		
 		
$config['classification']['fields'][ 'domain']=array( 		
	'category_type'=>'IndependantDynamicCategory',		
 	'field_title'=>'Application domain',	
 	'field_type'=>'int',
 	'field_size'=>11,
 	//'field_value'=>'normal',
 	'number_of_values'=>'1',//a verifier
 	'mandatory'=>' mandatory ',
 	
 	'input_type'=>'select',
 	'input_select_source'=>'table',
 	'input_select_values'=>'Application domain',
 	'on_add'=>'enabled',
 	'on_edit'=>'enabled',
 	'on_list'=>'show'				
 				);
 	$reference_tables['Application domain']['ref_name'] ='Application domain';   
 	$initial_values=array();
 	array_push($initial_values, "Software engineering");
 	array_push($initial_values, "Embedded systems");
 	array_push($initial_values, "Web technology");
 	array_push($initial_values, "Networking");
 	array_push($initial_values, "Aspect-oriented");
 	array_push($initial_values, "Mobile systems");
 	array_push($initial_values, "Prog. Lang");
 	array_push($initial_values, "Testing");
 	array_push($initial_values, "Other");
 	array_push($initial_values, "Compiler");
 	array_push($initial_values, "Bio-med");
 	array_push($initial_values, "Dist. Sys");
 	array_push($initial_values, "Simulation ");
 	array_push($initial_values, "DB");
 	array_push($initial_values, "Security");
 	array_push($initial_values, "AI");
 	array_push($initial_values, "Refactoring");
 	array_push($initial_values, "Robotics");
 	array_push($initial_values, "Graphic");
 	if(empty($reference_tables['Application domain']['values'])){
 		$reference_tables['Application domain']['values'] =	$initial_values;
 	}else{
 		foreach ($initial_values as $key => $value) {
 			if (!in_array($value, $reference_tables['Application domain']['values'] )){
 				array_push($reference_tables['Application domain']['values'],$value);
 			}
 		}		
 	}
 		
 		
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
 	array_push($initial_values, "Industry");
 	if(empty($reference_tables['Orientation']['values'])){
 		$reference_tables['Orientation']['values'] =	$initial_values;
 	}else{
 		foreach ($initial_values as $key => $value) {
 			if (!in_array($value, $reference_tables['Orientation']['values'] )){
 				array_push($reference_tables['Orientation']['values'],$value);
 			}
 		}		
 	}
 		
 		
$config['classification']['fields'][ 'publication_type']=array( 		
	'category_type'=>'IndependantDynamicCategory',		
 	'field_title'=>'Publication type',	
 	'field_type'=>'int',
 	'field_size'=>11,
 	//'field_value'=>'normal',
 	'number_of_values'=>'1',//a verifier
 	'mandatory'=>' mandatory ',
 	
 	'input_type'=>'select',
 	'input_select_source'=>'table',
 	'input_select_values'=>'Publication type',
 	'on_add'=>'enabled',
 	'on_edit'=>'enabled',
 	'on_list'=>'show'				
 				);
 	$reference_tables['Publication type']['ref_name'] ='Publication type';   
 	$initial_values=array();
 	array_push($initial_values, "Conference");
 	array_push($initial_values, "Journal");
 	array_push($initial_values, "Other");
 	if(empty($reference_tables['Publication type']['values'])){
 		$reference_tables['Publication type']['values'] =	$initial_values;
 	}else{
 		foreach ($initial_values as $key => $value) {
 			if (!in_array($value, $reference_tables['Publication type']['values'] )){
 				array_push($reference_tables['Publication type']['values'],$value);
 			}
 		}		
 	}
 		
 		
$config['classification']['fields'][ 'venue_type']=array( 		
	'category_type'=>'IndependantDynamicCategory',		
 	'field_title'=>'Venue type',	
 	'field_type'=>'int',
 	'field_size'=>11,
 	//'field_value'=>'normal',
 	'number_of_values'=>'1',//a verifier
 	'mandatory'=>' mandatory ',
 	
 	'input_type'=>'select',
 	'input_select_source'=>'table',
 	'input_select_values'=>'Venue type',
 	'on_add'=>'enabled',
 	'on_edit'=>'enabled',
 	'on_list'=>'show'				
 				);
 	$reference_tables['Venue type']['ref_name'] ='Venue type';   
 	$initial_values=array();
 	array_push($initial_values, "MDE");
 	array_push($initial_values, "Other");
 	array_push($initial_values, "SE");
 	if(empty($reference_tables['Venue type']['values'])){
 		$reference_tables['Venue type']['values'] =	$initial_values;
 	}else{
 		foreach ($initial_values as $key => $value) {
 			if (!in_array($value, $reference_tables['Venue type']['values'] )){
 				array_push($reference_tables['Venue type']['values'],$value);
 			}
 		}		
 	}
 		
 		

$config['classification']['fields'][ 'publication_name']=array( 		
	'category_type'=>'FreeCategory',		
 	'field_title'=>'Publication name',
 	'input_type'=>'text',
 	'field_size'=>100,
 	'field_type'=>'text',
 	'input_type'=>'textarea',
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

 		
$screening=array();
$screening['review_per_paper']='2';
$screening['conflict_type']='IncludeExclude';
$screening['conflict_resolution']='Unanimity';
$screening['validation_assigment_mode']='Normal';
$screening['validation_percentage']='20';
$screening['exclusion_criteria']=array();
array_push($screening['exclusion_criteria'], "No code generation");
array_push($screening['exclusion_criteria'], "Not template-based code generation");
array_push($screening['exclusion_criteria'], "Not a paper");
$screening['source_papers']=array();
$screening['source_papers']=array();
$screening['phases']=array();
 array_push($screening['phases'], array(
 										'title' =>"Phase 1",
 										'description' =>"Screen per title and abstract",
 										'fields'=>'Title|Abstract|',
 										)
 );

$result[ 'screening' ]=$screening; 		

//SCREENING area

//REPORTING
$report=array();
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
$report['template_style']['type']='simple';
$report['template_style']['title']='Template style'; 		
$report['template_style']['id']='template_style';
$report['template_style']['link']='false'; 
$report['template_style']['values']['field']='template_style';
$report['template_style']['values']['style']='select';
$report['template_style']['values']['title']='Template style';  
$charts=array();
 	array_push($charts, "pie");
$report['template_style']['chart']=$charts;
$result[ 'report' ]=$report; 		
//REPORTING

return $result;
}
