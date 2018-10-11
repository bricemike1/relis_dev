<?php //tbcg
function get_classification_tbcg(){
$reference_tables=array();//from nowit will worklike this
$config=array();
$result['class_action']='override';
$result['screen_action']='no_override';
$result['qa_action']='no_override';
$result['project_title']='Template-Based Code Generation';
$result['project_short_name']='tbcg';
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

$config['style']['table_name']='style';
$config['style']['table_id']='style_id';
$config['style']['table_active_field']='style_active';
$config['style']['main_field']='style';
$config['style']['order_by']='style_id ASC ';


$config['style']['reference_title']='Template style';
$config['style']['reference_title_min']='Template style';
		
$config['style']['entity_label_plural']='Template style';
$config['style']['entity_label']='Template style';


$config['style']['links'][ 'edit']=array(
	   			'label'=>'Edit',
	   			'title'=>'Edit ',
	   			'on_list'=>False,
	   			'on_view'=>True
	   	);

$config['style']['links'][ 'view']=array(
	   			'label'=>'View',
	   			'title'=>'View',
	   			'on_list'=>True,
	   			'on_view'=>True
	   	);
	   	
$config['style']['fields']['style_id']=array(
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
$config['style']['fields']['parent_field_id']=array(
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
				
$config['style']['fields'][ 'style']=array( 		
	'category_type'=>'StaticCategory',		
 	'field_title'=>'Template style',	
 	'field_type'=>'text',
 	//'field_value'=>'normal',
 	'number_of_values'=>'1',// a  verifier
 	'field_size'=>20,
 	'input_type'=>'select',
 	'input_select_source'=>'array',
 	'input_select_values'=>array(
 	'Predefined'=>"Predefined",
 	'Output-based'=>"Output-based",
 	'Rule-based'=>"Rule-based",
 	),
 	'on_add'=>'enabled',
 	'on_edit'=>'enabled',
 	'on_list'=>'show'				
 	);   
 		
 		

$config['style']['fields'][ 'cg_order']=array( 		
	'category_type'=>'FreeCategory',		
 	'field_title'=>'Code gen order',
 	'input_type'=>'text',
 	'field_size'=>1,
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

$config['style']['fields'][ 'comment']=array( 		
	'category_type'=>'FreeCategory',		
 	'field_title'=>'Comment',
 	'input_type'=>'text',
 	'field_size'=>100,
 	'field_type'=>'text',
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
$config['style']['fields']['style_active']=array(
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
$config['style']['operations']=array();
			
$config['classification']['fields'][ 'style']=array( 		
	'category_type'=>'WithMultiValues',		
 	'field_title'=>'Template style',	
 	'field_type'=>'int',
 	'field_size'=>11,
 	//'field_value'=>'normal',
 	'number_of_values'=>'3',//a verifier
 	
 	
 	'input_type'=>'select',
 	'input_select_source'=>'table',
 	'input_select_values'=>'style',
 	'input_select_key_field'=>'parent_field_id',
 	'input_select_source_type'=>'drill_down',
 	//'number_of_values'=>'*',//a verifier
 	'on_add'=>'drill_down',
 	'on_edit'=>'drill_down',
 	'compute_result'=>'no',
 	'on_list'=>'show'				
 				);			

$config['classification']['fields'][ 'Tool']=array( 		
	'category_type'=>'IndependantDynamicCategory',		
 	'field_title'=>'Tool',	
 	'field_type'=>'int',
 	'field_size'=>11,
 	//'field_value'=>'normal',
 	'number_of_values'=>'1',//a verifier
 	'mandatory'=>' mandatory ',
 	
 	'input_type'=>'select',
 	'input_select_source'=>'table',
 	'input_select_values'=>'Tools',
 	'on_add'=>'enabled',
 	'on_edit'=>'enabled',
 	'on_list'=>'show'				
 				);
 	$reference_tables['Tools']['ref_name'] ='Tools';   
 	$initial_values=array();
 	array_push($initial_values, "Acceleo");
 	array_push($initial_values, "Xpand");
 	array_push($initial_values, "EGL");
 	array_push($initial_values, "JET");
 	array_push($initial_values, "MOFScript");
 	array_push($initial_values, "Xtend");
 	if(empty($reference_tables['Tools']['values'])){
 		$reference_tables['Tools']['values'] =	$initial_values;
 	}else{
 		foreach ($initial_values as $key => $value) {
 			if (!in_array($value, $reference_tables['Tools']['values'] )){
 				array_push($reference_tables['Tools']['values'],$value);
 			}
 		}		
 	}
 		
 		

$config['classification']['fields'][ 'Year']=array( 		
	'category_type'=>'FreeCategory',		
 	'field_title'=>'Year',
 	'input_type'=>'text',
 	'field_size'=>4,
 	'field_type'=>'int',
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

 		
$qa=array();
$qa['cutt_off_score']='1';
$qa['questions']=array();
  array_push($qa['questions'], array(
  										'title' =>"Does the study has validation?",
  										)
  );
  array_push($qa['questions'], array(
  										'title' =>"Are research questions clearly stated?",
  										)
  );
$qa['responses']=array();
   array_push($qa['responses'], array(
   										'title' =>"Yes",
   										'score' =>"1",
   										)
   );
   array_push($qa['responses'], array(
   										'title' =>"Partly",
   										'score' =>"0.5",
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
$screening['conflict_type']='IncludeExclude';
$screening['conflict_resolution']='Unanimity';
$screening['validation_assigment_mode']='Normal';
$screening['validation_percentage']='20';
$screening['exclusion_criteria']=array();
array_push($screening['exclusion_criteria'], "No code generation");
array_push($screening['exclusion_criteria'], "Not template-based code generation");
$screening['source_papers']=array();
$screening['source_papers']=array();
$screening['phases']=array();
 array_push($screening['phases'], array(
 										'title' =>" Screening of abstract and title",
 										'description' =>"Check title and abstract",
 										'fields'=>'Title|Abstract|Link|',
 										)
 );

$result[ 'screening' ]=$screening; 		

//SCREENING area

//REPORTING
$report=array();
$report['Year']['type']='simple';
$report['Year']['title']='Studies per year'; 		
$report['Year']['id']='Year';
$report['Year']['link']='false'; 
$report['Year']['values']['field']='Year';
$report['Year']['values']['style']='select';
$report['Year']['values']['title']='';  
$charts=array();
 	array_push($charts, "line");
$report['Year']['chart']=$charts;
$report['tools']['type']='simple';
$report['tools']['title']='Tools'; 		
$report['tools']['id']='tools';
$report['tools']['link']='false'; 
$report['tools']['values']['field']='Tool';
$report['tools']['values']['style']='select';
$report['tools']['values']['title']='';  
$charts=array();
 	array_push($charts, "pie");
$report['tools']['chart']=$charts;
$report['year_template_style']['type']='compare';
$report['year_template_style']['title']='Evolution of template style'; 		
$report['year_template_style']['id']='year_template_style';
$report['year_template_style']['link']='false'; 
$report['year_template_style']['values']['field']='';
$report['year_template_style']['values']['style']='select';
$report['year_template_style']['values']['title']='';  
$report['year_template_style']['reference']['field']='Year';
 $report['year_template_style']['reference']['style']='select';
 $report['year_template_style']['reference']['title']='';  
  $charts=array();
   	array_push($charts, "bar");
  $report['year_template_style']['chart']=$charts;
$result[ 'report' ]=$report; 		
//REPORTING

return $result;
}
