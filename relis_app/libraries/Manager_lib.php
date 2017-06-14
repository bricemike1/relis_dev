<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manager_lib
{
	public function __construct()
	{
		$this->CI =& get_instance();
		
	
	}
	
	
	 function get_reference_select_values($config,$start_with_empty=True,$get_leaf=False,$multiselect=False){
	
		$conf=explode(";", $config);
		//print_test($conf);
		$ref_table=$conf[0];
		$fields=$conf[1];
		$ref_table_config=get_table_configuration($ref_table);
		//for_array
	
		if($get_leaf){
	
			while(!empty($ref_table_config['fields'][$fields]['input_type']) AND $ref_table_config['fields'][$fields]['input_type']=='select' AND $ref_table_config['fields'][$fields]['input_select_source']=='table' ){
	
				$config=$ref_table_config['fields'][$fields]['input_select_values'];
	
				$conf=explode(";", $config);
				//print_test($conf);
				$ref_table=$conf[0];
				$fields=$conf[1];
				$ref_table_config=get_table_configuration($ref_table);
	
	
				//echo "<h1>$fields</h1>";
			}
		}
	
		if($multiselect AND isset($ref_table_config['fields'][$fields]['input_select_source']) AND $ref_table_config['fields'][$fields]['input_select_source']=='array'){
	
			$result=array();
	
	
	
			$result=$ref_table_config['fields'][$fields]['input_select_values'];
	
	
			//print_test($result);
			//exit;
		}
	
		else{
	
			if($multiselect AND isset($ref_table_config['fields'][$fields]['input_select_source']) AND $ref_table_config['fields'][$fields]['input_select_source']=='table'){
					
				$config=$ref_table_config['fields'][$fields]['input_select_values'];
					
				$conf=explode(";", $config);
				//print_test($conf);
				$ref_table=$conf[0];
				$fields=$conf[1];
				$ref_table_config=get_table_configuration($ref_table);
					
					
					
			}
	
			//	$extra_condition="";
	
				
	
			$res=$this->CI->DBConnection_mdl->get_reference_select_values($ref_table_config,$fields);
				
			$result=array();
			if($res AND $start_with_empty)
				$result['']="Select...";
					
				$_stable_config=$ref_table_config;
				$_fields=$fields;
				foreach ($res as $key => $value) {
	
					$ref_table_config = $_stable_config;
					$fields = $_fields;
					//print_test($ref_table_config);
					$result[$value['refId']]=$value['refDesc'];
	
						
	
					while(!empty($ref_table_config['fields'][$fields]['input_type']) AND $ref_table_config['fields'][$fields]['input_type']=='select' AND $ref_table_config['fields'][$fields]['input_select_source']=='table' ){
						//	echo "<h1>bbbb</h1>";
						//print_test($result);
	
						$config=$ref_table_config['fields'][$fields]['input_select_values'];
	
						$conf=explode(";", $config);
	
						$ref_table=$conf[0];
						$fields=$conf[1];
						$ref_table_config=get_table_configuration($ref_table);
	
	
						$res2=$this->CI->manage_mdl->get_reference_value($ref_table_config['table_name'],$value['refDesc'],$fields,$ref_table_config['table_id']);
	
						$result[$value['refId']]= $res2;
	
	
					}
	
	
					if(isset($ref_table_config['fields'][$fields]['input_select_source']) AND $ref_table_config['fields'][$fields]['input_select_source']=='array'){
	
						$select_values=$ref_table_config['fields'][$fields]['input_select_values'];
	
						$result[$value['refId']]= $select_values[$result[$value['refId']]];
	
					}
	
	
	
				}
	
		}
		//print_test($result);
		return $result;
	
	
	}
	
	function get_reference_select_values_old($config,$start_with_empty=True,$get_leaf=False,$multiselect=False){
	
		$conf=explode(";", $config);
		//print_test($conf);
		$ref_table=$conf[0];
		$fields=$conf[1];
		$ref_table_config=get_table_config($ref_table);
		//for_array
	
		if($get_leaf){
	
			while(!empty($ref_table_config['fields'][$fields]['input_type']) AND $ref_table_config['fields'][$fields]['input_type']=='select' AND $ref_table_config['fields'][$fields]['input_select_source']=='table' ){
	
				$config=$ref_table_config['fields'][$fields]['input_select_values'];
	
				$conf=explode(";", $config);
				//print_test($conf);
				$ref_table=$conf[0];
				$fields=$conf[1];
				$ref_table_config=get_table_config($ref_table);
	
	
				//echo "<h1>$fields</h1>";
			}
		}
	
		if($multiselect AND isset($ref_table_config['fields'][$fields]['input_select_source']) AND $ref_table_config['fields'][$fields]['input_select_source']=='array'){
	
			$result=array();
	
	
	
			$result=$ref_table_config['fields'][$fields]['input_select_values'];
	
	
			//print_test($result);
			//exit;
		}
	
		else{
	
			if($multiselect AND isset($ref_table_config['fields'][$fields]['input_select_source']) AND $ref_table_config['fields'][$fields]['input_select_source']=='table'){
					
				$config=$ref_table_config['fields'][$fields]['input_select_values'];
					
				$conf=explode(";", $config);
				//print_test($conf);
				$ref_table=$conf[0];
				$fields=$conf[1];
				$ref_table_config=get_table_config($ref_table);
					
					
					
			}
	
			//	$extra_condition="";
	
	
	
			$res=$this->CI->DBConnection_mdl->get_reference_select_values($ref_table_config,$fields);
	
			$result=array();
			if($res AND $start_with_empty)
				$result['']="Select...";
					
				$_stable_config=$ref_table_config;
				$_fields=$fields;
				foreach ($res as $key => $value) {
	
					$ref_table_config = $_stable_config;
					$fields = $_fields;
					//print_test($ref_table_config);
					$result[$value['refId']]=$value['refDesc'];
	
	
	
					while(!empty($ref_table_config['fields'][$fields]['input_type']) AND $ref_table_config['fields'][$fields]['input_type']=='select' AND $ref_table_config['fields'][$fields]['input_select_source']=='table' ){
						//	echo "<h1>bbbb</h1>";
						//print_test($result);
	
						$config=$ref_table_config['fields'][$fields]['input_select_values'];
	
						$conf=explode(";", $config);
	
						$ref_table=$conf[0];
						$fields=$conf[1];
						$ref_table_config=get_table_config($ref_table);
	
	
						$res2=$this->CI->manage_mdl->get_reference_value($ref_table_config['table_name'],$value['refDesc'],$fields,$ref_table_config['table_id']);
	
						$result[$value['refId']]= $res2;
	
	
					}
	
	
					if(isset($ref_table_config['fields'][$fields]['input_select_source']) AND $ref_table_config['fields'][$fields]['input_select_source']=='array'){
	
						$select_values=$ref_table_config['fields'][$fields]['input_select_values'];
	
						$result[$value['refId']]= $select_values[$result[$value['refId']]];
	
					}
	
	
	
				}
	
		}
		//print_test($result);
		return $result;
	
	
	}
	
	
	
	 function get_element_multi_values($config,$key_field,$element_id){
		 
		 
		$Tvalues_source=explode(';', $config);
		 
		$source_table_config=get_table_configuration($Tvalues_source[0]);
		 
		 
		 
		$extra_condition=" AND $key_field ='".$element_id."'";
		 
		$res_values=$this->CI->DBConnection_mdl->get_reference_select_values($source_table_config,$source_table_config['table_id'],$extra_condition);
		 
		 
		$results=array();
		 
		foreach ($res_values as $value) {
			array_push($results, $value['refDesc']);
		}
		//print_test($results);
		return $results;
	}
	/*
	 * Fonction pour afficher une ligne d'une table avec remplacement des clès externes par leurs correspondances
	 */
	 function get_element_detail($ref_table,$ref_id,$editable=False,$modal_link=False) {
	
		old_version();
		//récuperation de la configuration de l'entité
		$table_config=get_table_config($ref_table);
	
		
	
	
		$dropoboxes=array();
	
		// récupération des valeurs pour les champs avec la clé enregistre dans la table (pour pouvoir afficher le label)
		foreach ($table_config['fields'] as $k => $v) {
			
			//Rechercher pour les champs qu'on afficher seulement
			
			if(!empty($v['input_type']) AND $v['input_type']=='select' AND ! (isset($v['on_view']) AND $v['on_view']=='hidden')){
				if($v['input_select_source']=='array'){
					$dropoboxes[$k]=$v['input_select_values'];
				}elseif($v['input_select_source']=='yes_no' ){
					$dropoboxes[$k]= array(
							0=>'No',
							1=>'Yes'
					);
				}elseif($v['input_select_source']=='table'){
	
						
					// recherches des auteurs par papier
					if( $ref_table=='papers' AND $k=='authors'){
						$this->CI->db3 = $this->CI->load->database(project_db(), TRUE);
	
						//todo generaliser pour tout les multivalues (car les autres prennemt beaucoups de temps)
						
						$sql="select P.paperauthor_id ,A.author_name from paperauthor P,author A where P.paperId=$ref_id AND P.authorId=A.author_id AND A.author_active=1 AND P.paperauthor_active=1 ";
						$res_author=$this->CI->db3->query($sql)->result_array();
						$t_array=array(''=>'Select ...');
						
						foreach ($res_author as $key_a => $value_a) {
							$t_array[$value_a['paperauthor_id']]=$value_a['author_name'];
						}
						//print_test($t_array);
						$dropoboxes[$k]=$t_array;
							
					}else{
						$dropoboxes[$k]= $this->get_reference_select_values($v['input_select_values']);
					}
				}
			}
	
		}
	
	
		// récuperation de la base de donnée la ligne correspondant à l'enregistrement
		$detail_result = $this->CI->DBConnection_mdl->get_row_details ( $ref_table,$ref_id );
	
		$content_item=$detail_result;
	
	
		$item_data=array();
	
	
		foreach ($dropoboxes as $k => $v) {
			$content_item[$k.'_idd']=0;
			if(isset($content_item[$k])){//si l'element est déjà present dans la ligne(Pas un multivalue) on lui donne la correspondance de la clée
	
				if(isset($v[$content_item[$k]])){
	
					$content_item[$k.'_idd']=$content_item[$k];
	
					$content_item[$k]=$v[$content_item[$k]];
	
				}
			}
			else{// element pas present on le creée avec une valeur vide (_idd reste a "0")
	
				$content_item[$k]="";
			}
		}
		
	
		
	
	//	Preparation des valeurs à afficher
	
		foreach ($table_config['fields'] as $key => $value) {
			$array=array();
			
			// Champs qui sont à afficher
			if(!(isset($value['on_view']) AND $value['on_view']=='hidden' )){
					
	
				$array['title']=$value['field_title'];
				$array['field_id']=$key;
				$array['edit']=0;
	
	
				//Pour les  multivalues
				if(isset($value['number_of_values']) AND ($value['number_of_values']=='*' OR $value['number_of_values']!='1') AND !empty($value['input_select_key_field'])){
					if($value['number_of_values']=="0" OR $value['number_of_values']=="-1"  OR $value['number_of_values']=="*")
					{
						$max_number_of_value=0;
					}ELSE{
						$max_number_of_value=(int)$value['number_of_values'];
					}
					$Tvalues_source=explode(';', $value['input_select_values']);
					
					$source_table_config=get_table_config($Tvalues_source[0]);
					$input_select_key_field=$value['input_select_key_field'];
	
					$extra_condition=" AND $input_select_key_field ='".$ref_id."'";
	
					$res_values=$this->CI->DBConnection_mdl->get_reference_select_values($source_table_config,$input_select_key_field,$extra_condition);
						
					// Prepare the button to add new element
					$add_button = create_button_link('manager/add_element_child/'.$Tvalues_source[0].'/'.$value['input_select_key_field'].'/'.$ref_table.'/'.$ref_id,'<i class="fa fa-plus"></i> Add',"btn-success",'Add ');
	
					if($modal_link){//use modal 
						$modal_title="Add : ".$value['field_title'];
						$add_button='<a  class="btn btn-xs btn-info" data-toggle="modal" data-target="#relisformModal" data-operation_type="2"  data-modal_link="manager/add_element_child_modal/'.$Tvalues_source[0].'/'.$value['input_select_key_field'].'/'.$ref_table.'/'.$ref_id.'"  data-modal_title="'.$modal_title.'" ><i class="fa fa-plus"></i>Add</a>';
					}
					
					$k_row=0;
					//For multi select no need to add the add button there is an adapted field - And if the number of values is reached
					if(!(isset($value['multi-select']) AND $value['multi-select']=="Yes") AND $editable AND ($max_number_of_value==0 OR count($res_values) < $max_number_of_value)	){
						$array['val2'][0]="<span> ".$add_button."</span>";
	
						$k_row=1;
						$array['edit']=1;
					}
						
						
						
						
					// Get values if label  are from other tables ()
					foreach ($res_values as $key_v => $value_v) {
	
	
						if(isset($dropoboxes[$key][$value_v['refId']]))
							$array['val2'][$k_row]=$dropoboxes[$key][$value_v['refId']];
	
	
							if(isset($value_v['refId'])  AND $value['input_select_source']=='table' AND isset($value['input_select_source_type']) ){
								
								$Tconfig=explode(';', $value['input_select_values'])   ;
								
								if($value_v['refId']!=0)
								{
									$edit_button = create_button_link('manager/edit_drilldown/'.$Tconfig[0].'/'.$ref_table.'/'.$key.'/'.$ref_id.'/'.$value_v['refId'],'<i class="fa fa-pencil"></i> Edit',"btn-info",'Edit ');
	
									$delete_button = create_button_link('manager/remove_drilldown/'.$value_v['refId'].'/'.$Tconfig[0].'/'.$ref_table.'/'.$ref_id.'/'.$key.'/no','<i class="fa fa-times"></i> Remove',"btn-danger",'Remove ','onlist','alert_ok');
	
									if($modal_link){//use modal for classification
										$modal_title="Edit : ".$value['field_title'];
										$edit_button='<a  class="btn btn-xs btn-info" data-toggle="modal" data-target="#relisformModal" data-operation_type="2"  data-modal_link="manager/edit_drilldown/'.$Tconfig[0].'/'.$ref_table.'/'.$key.'/'.$ref_id.'/'.$value_v['refId'].'/modal"  data-modal_title="'.$modal_title.'" ><i class="fa fa-pencil"></i>Edit</a>';
											
										$delete_button = create_button_link('manager/remove_drilldown/'.$value_v['refId'].'/'.$Tconfig[0].'/'.$ref_table.'/'.$ref_id.'/'.$key.'/no/yes','<i class="fa fa-times"></i> Remove',"btn-danger",'Remove ','onlist','alert_ok');
											
									}
	
	
								
									if((isset($value['multi-select']) AND $value['multi-select']=="Yes") OR !$editable)	{
										$edit_button="";
										$delete_button="";
									}
	
									if(isset($value['input_select_source_type']) AND  $value['input_select_source_type']=='drill_down')
										$array['val2'][$k_row]="<span class='drilldown_link'>".anchor('manager/display_element/'.$Tconfig[0].'/'.$value_v['refId'],$array['val2'][$k_row])."</span> <div class='navbar-right'>$edit_button $delete_button</div>";
										else
										$array['val2'][$k_row].=" <div class='navbar-right'>$edit_button $delete_button</div>";
	
	
								}
							}
	
							
							$k_row++;
	
					}
					
					
				}else{
	
					//for single values
	
					$array['val']=isset($content_item[$key])?" ".$content_item[$key]:' ';
					$array['val2'][0]=isset($content_item[$key])?" ".$content_item[$key]:' ';
	
					// for images
					if(isset($value['input_type']) AND $value['input_type']=='image'){
						if(!empty($content_item[$key])){
							//$img=$this->config->item('image_upload_path').$content_item[$key]."_thumb.jpg";
							//$array['val2'][0]= img($img);
								
								
							$delete_picture_button=get_top_button('all','Remove picture','manager/remove_picture/'.$ref_table.'/'.$table_config['table_name'].'/'.$table_config['table_id'].'/'.$key.'/'.$ref_id,'','fa-close','','btn-danger',FALSE);
								
							
							$array['val2'][0]= '<img src="'.display_picture_from_db($content_item[$key]).'"/> '.$delete_picture_button;
						}
	
					}
	
	
					
					if(isset($content_item[$key.'_idd'])  AND $value['input_select_source']=='table' AND isset($value['input_select_source_type']) AND  $value['input_select_source_type']=='drill_down' ){
						
						$Tconfig=explode(';', $value['input_select_values'])   ;
						// si la valeur est déjà enregistré
						if($content_item[$key.'_idd']!=0)
						{
							if((isset($value['drill_down_type']) AND $value['drill_down_type'] == 'not_linked') OR !$editable)
							{
								$edit_button="";
								$delete_button="";
							}else{
								$edit_button = create_button_link('manager/edit_drilldown/'.$Tconfig[0].'/'.$ref_table.'/'.$key.'/'.$ref_id.'/'.$content_item[$key.'_idd'],'<i class="fa fa-pencil"></i> Edit',"btn-info",'Edit ');
	
								$delete_button = create_button_link('manager/remove_drilldown/'.$content_item[$key.'_idd'].'/'.$Tconfig[0].'/'.$ref_table.'/'.$ref_id.'/'.$key,'<i class="fa fa-times"></i> Remove',"btn-danger",'Remove ','onlist','alert_ok');
							}
							
							$array['val']="<span class='drilldown_link'>".anchor('manager/display_element/'.$Tconfig[0].'/'.$content_item[$key.'_idd'],$array['val'])."</span> <div class='navbar-right'>$edit_button.$delete_button</div>";
							$array['val2'][0]="<span class='drilldown_link'>".anchor('manager/display_element/'.$Tconfig[0].'/'.$content_item[$key.'_idd'],$array['val2'][0])."</span> <div class='navbar-right'>$edit_button.$delete_button</div>";
	
	
	
						}else{// si la valeur n'est pas encore enregistré
							
							
							if((isset($value['drill_down_type']) AND $value['drill_down_type'] == 'not_linked') OR !$editable)
							{
								$add_button = "";
							}else{
								$array['edit']=1;
								$add_button = create_button_link('manager/add_element_drilldown/'.$Tconfig[0].'/'.$ref_table.'/'.$key.'/'.$ref_id,'<i class="fa fa-plus"></i> Add',"btn-success",'Add ');
									
								if($ref_table=='classification'){//use modal for classification
									$modal_title="Add : ".$value['field_title'];
									$add_button='<a  class="btn btn-xs btn-success" data-toggle="modal" data-target="#relisformModal" data-operation_type="2"  data-modal_link="manager/add_element_drilldown_modal/'.$Tconfig[0].'/'.$ref_table.'/'.$key.'/'.$ref_id.'"  data-modal_title="'.$modal_title.'" ><i class="fa fa-plus"></i>Add</a>';
								}
									
									
							}
							$array['val']="<span>: ".$add_button."</span>";
							$array['val2'][0]="<span>: ".$add_button."</span>";
						}
					}
				}
	
				array_push($item_data, $array);
				
	
			}
		}
		
		return $item_data;
	
	}
	
	/*
	 * Fonction pour afficher une ligne d'une table avec remplacement des clès externes par leurs correspondances
	 */
	function get_detail($table_config,$ref_id,$editable=True,$modal_link=False) {
	
	
		//récuperation de la configuration de l'entité
		//$table_config=get_table_config($ref_table);
	
		$ref_table=$table_config['config_id'];
		$current_operation=	$table_config['current_operation'];
	
		$dropoboxes=array();
	
		// récupération des valeurs pour les champs avec la clé enregistre dans la table (pour pouvoir afficher le label)
		foreach ($table_config['operations'][$current_operation]['fields'] as $k_field => $v) {
			
			if(!empty($table_config['fields'][$k_field])){
				
				$field_det=$table_config['fields'][$k_field];
			
			//Rechercher pour les champs qu'on afficher seulement
				
			if(!empty($field_det['input_type']) AND $field_det['input_type']=='select'){
				
				if($field_det['input_select_source']=='array'){
					$dropoboxes[$k_field]=$field_det['input_select_values'];
				}elseif($field_det['input_select_source']=='yes_no' ){
					$dropoboxes[$k_field]= array(
							0=>'No',
							1=>'Yes'
					);
				}elseif($field_det['input_select_source']=='table'){
					//print_test($field_det);
					
					// recherches des auteurs par papier
					if( $ref_table=='papers' AND $k_field=='authors'){
						$this->CI->db3 = $this->CI->load->database(project_db(), TRUE);
	
						//todo generaliser pour tout les multivalues (car les autres prennemt beaucoups de temps)
	
						$sql="select P.paperauthor_id ,A.author_name from paperauthor P,author A where P.paperId=$ref_id AND P.authorId=A.author_id AND A.author_active=1 AND P.paperauthor_active=1 ";
						$res_author=$this->CI->db3->query($sql)->result_array();
						$t_array=array(''=>'Select ...');
	
						foreach ($res_author as $key_a => $value_a) {
							$t_array[$value_a['paperauthor_id']]=$value_a['author_name'];
						}
						//print_test($t_array);
						$dropoboxes[$k_field]=$t_array;
							
					}else{
						$dropoboxes[$k_field]= $this->get_reference_select_values($field_det['input_select_values']);
					}
				}
			}
		}
		}
		
		//exit;
		// récuperation de la base de donnée la ligne correspondant à l'enregistrement
		$detail_result = $this->CI->DBConnection_mdl->get_row_details ( $table_config['operations'][$current_operation]['data_source'],$ref_id ,true);
	
		$content_item=$detail_result;
		
		$item_data=array();
	
	
		foreach ($dropoboxes as $k => $v) {
			$content_item[$k.'_idd']=0;
			if(isset($content_item[$k])){//si l'element est déjà present dans la ligne(Pas un multivalue) on lui donne la correspondance de la clée
	
				if(isset($v[$content_item[$k]])){
	
					$content_item[$k.'_idd']=$content_item[$k];
	
					$content_item[$k]=$v[$content_item[$k]];
					
					
	
				}elseif(empty($content_item[$k])){//avoid displaying zero when the field is empty
					$content_item[$k]="";
				}
			}
			else{// element pas present on le creée avec une valeur vide (_idd reste a "0")
	
				$content_item[$k]="";
			}
		}
	
	
		//print_test($content_item);
		//exit;
	
		//	Preparation des valeurs à afficher
	
		//foreach ($table_config['fields'] as $key => $value) {
		foreach ($table_config['operations'][$current_operation]['fields'] as $key => $value_field) {
			$value=$table_config['fields'][$key];
			$array=array();
				
				
	
				$array['title']=$value['field_title'];
				$array['field_id']=$key;
				$array['edit']=0;
				//print_test($key);
				//print_test($array);
	
				//Pour les  multivalues
				if((isset($value['number_of_values']) AND ($value['number_of_values']=='*' OR $value['number_of_values']!='1') ) AND !empty($value['input_select_key_field'])){
					if($value['number_of_values']=="0" OR $value['number_of_values']=="-1"  OR $value['number_of_values']=="*")
					{
						$max_number_of_value=0;
					}ELSE{
						$max_number_of_value=(int)$value['number_of_values'];
					}
					$Tvalues_source=explode(';', $value['input_select_values']);
						
					$source_table_config=get_table_configuration($Tvalues_source[0]);
					$input_select_key_field=$value['input_select_key_field'];
	
					$extra_condition=" AND $input_select_key_field ='".$ref_id."'";
	
					$res_values=$this->CI->DBConnection_mdl->get_reference_select_values($source_table_config,$input_select_key_field,$extra_condition);
	
					// Prepare the button to add new element
					if(!empty($value_field['drilldown_add_link'])){
						$add_button = create_button_link($value_field['drilldown_add_link'].$ref_id,'<i class="fa fa-plus"></i> Add',"btn-success",'Add ');
						//$add_button = create_button_link('manager/add_element_child/'.$Tvalues_source[0].'/'.$value['input_select_key_field'].'/'.$ref_table.'/'.$ref_id,'<i class="fa fa-plus"></i> Add',"btn-success",'Add ');

						if($modal_link){//use modal
							$modal_title="Add : ".$value['field_title'];
							$add_button='<a  class="btn btn-xs btn-info" data-toggle="modal" data-target="#relisformModal" data-operation_type="2"  data-modal_link="manager/add_element_child_modal/'.$Tvalues_source[0].'/'.$value['input_select_key_field'].'/'.$ref_table.'/'.$ref_id.'"  data-modal_title="'.$modal_title.'" ><i class="fa fa-plus"></i>Add</a>';
						}
					}else{
						$add_button = "";
					}
					
						
					$k_row=0;
					//For multi select no need to add the add button there is an adapted field - And if the number of values is reached
					if( !empty($add_button) AND !(isset($value['multi-select']) AND $value['multi-select']=="Yes") AND $editable AND ($max_number_of_value==0 OR count($res_values) < $max_number_of_value)	){
						$array['val2'][0]="<span> ".$add_button."</span>";
	
						$k_row=1;
						$array['edit']=1;
					}
	
	
	
	
					// Get values if label  are from other tables ()
					
					foreach ($res_values as $key_v => $value_v) {
						$edit_button="";
						$delete_button="";
						
						//print_test($value_v);
						if(isset($dropoboxes[$key][$value_v['refId']]))
							$array['val2'][$k_row]=$dropoboxes[$key][$value_v['refId']];
	
	
							if(isset($value_v['refId'])  AND $value['input_select_source']=='table' AND isset($value['input_select_source_type']) ){
	
								$Tconfig=explode(';', $value['input_select_values'])   ;
	
								if($value_v['refId']!=0)
								{
									if(!empty($value_field['drilldown_edit_link'])){
										$edit_button = create_button_link($value_field['drilldown_edit_link'].$value_v['refId'].'/'.$ref_id,'<i class="fa fa-pencil"></i> Edit',"btn-info",'Edit ');
										if($modal_link){//use modal for classification
											$modal_title="Edit : ".$value['field_title'];
											$edit_button='<a  class="btn btn-xs btn-info" data-toggle="modal" data-target="#relisformModal" data-operation_type="2"  data-modal_link="manager/edit_drilldown/'.$Tconfig[0].'/'.$ref_table.'/'.$key.'/'.$ref_id.'/'.$value_v['refId'].'/modal"  data-modal_title="'.$modal_title.'" ><i class="fa fa-pencil"></i>Edit</a>';
										}
									
									}
									
									if(!empty($value_field['drilldown_remove_link'])){
											//$delete_button = create_button_link('manager/remove_drilldown/'.$value_v['refId'].'/'.$Tconfig[0].'/'.$ref_table.'/'.$ref_id.'/'.$key.'/no','<i class="fa fa-times"></i> Remove',"btn-danger",'Remove ','onlist','alert_ok');
											$delete_button = create_button_link($value_field['drilldown_remove_link'].$value_v['refId'].'/'.$ref_id,'<i class="fa fa-times"></i> Remove',"btn-danger",'Remove ','onlist','alert_ok');
			
											if($modal_link){
												//Todo correct
												//$delete_button = create_button_link('manager/remove_drilldown/'.$value_v['refId'].'/'.$Tconfig[0].'/'.$ref_table.'/'.$ref_id.'/'.$key.'/no/yes','<i class="fa fa-times"></i> Remove',"btn-danger",'Remove ','onlist','alert_ok');
												$delete_button = create_button_link($value_field['drilldown_remove_link'].$value_v['refId'].'/'.$ref_id,'<i class="fa fa-times"></i> Remove',"btn-danger",'Remove ','onlist','alert_ok');
													
											}
									}
	
	
									if((isset($value['multi-select']) AND $value['multi-select']=="Yes") OR !$editable)	{
										$edit_button="";
										$delete_button="";
									}
	
									if(isset($value['input_select_source_type']) AND  $value['input_select_source_type']=='drill_down' AND !empty($value_field['drilldown_display_link']))
										$array['val2'][$k_row]="<span class='drilldown_link'>".anchor($value_field['drilldown_display_link'].$value_v['refId'],$array['val2'][$k_row])."</span> <div class='navbar-right'>$edit_button $delete_button</div>";
										else
											$array['val2'][$k_row].=" <div class='navbar-right'>$edit_button $delete_button</div>";
	
	
								}
							}
	
								
							$k_row++;
	
					}
						
						
				}else{
	
					//for single values
	
					$array['val']=isset($content_item[$key])?" ".$content_item[$key]:' ';
					$array['val2'][0]=isset($content_item[$key])?" ".$content_item[$key]:' ';
	
					// for images
					if(isset($value['input_type']) AND $value['input_type']=='image'){
						if(!empty($content_item[$key])){
							//$img=$this->config->item('image_upload_path').$content_item[$key]."_thumb.jpg";
							//$array['val2'][0]= img($img);
	
	
							$delete_picture_button=get_top_button('all','Remove picture','op/remove_picture/'.$current_operation.'/'.$table_config['table_name'].'/'.$table_config['table_id'].'/'.$key.'/'.$ref_id,'','fa-close','','btn-danger',FALSE);
	
								
							$array['val2'][0]= '<img src="'.display_picture_from_db($content_item[$key]).'"/> '.$delete_picture_button;
						}
	
					}
	
	
						
					if(isset($content_item[$key.'_idd'])  AND $value['input_select_source']=='table' AND isset($value['input_select_source_type']) AND  $value['input_select_source_type']=='drill_down' ){
	
						$Tconfig=explode(';', $value['input_select_values'])   ;
						// si la valeur est déjà enregistré
						if($content_item[$key.'_idd']!=0)
						{
							$edit_button="";
							$delete_button="";
							
							if(!((isset($value['drill_down_type']) AND $value['drill_down_type'] == 'not_linked') OR !$editable))
							{
								
									if(!empty($value_field['drilldown_edit_link'])){
										$edit_button = create_button_link('manager/edit_drilldown/'.$Tconfig[0].'/'.$ref_table.'/'.$key.'/'.$ref_id.'/'.$content_item[$key.'_idd'],'<i class="fa fa-pencil"></i> Edit',"btn-info",'Edit ');
									}
									if(!empty($value_field['drilldown_remove_link'])){
									//	$delete_button = create_button_link('manager/remove_drilldown/'.$content_item[$key.'_idd'].'/'.$Tconfig[0].'/'.$ref_table.'/'.$ref_id.'/'.$key,'<i class="fa fa-times"></i> Remove',"btn-danger",'Remove ','onlist','alert_ok');
										$delete_button = create_button_link($value_field['drilldown_remove_link'].$content_item[$key.'_idd'].'/'.$ref_id,'<i class="fa fa-times"></i> Remove',"btn-danger",'Remove ','onlist','alert_ok');
											
									}
								}
							
							if(!empty($value_field['drilldown_display_link'])){
								$array['val']="<span class='drilldown_link'>".anchor($value_field['drilldown_display_link'].$content_item[$key.'_idd'],$array['val'])."</span> <div class='navbar-right'>$edit_button.$delete_button</div>";
								$array['val2'][0]="<span class='drilldown_link'>".anchor($value_field['drilldown_display_link'].$content_item[$key.'_idd'],$array['val2'][0])."</span> <div class='navbar-right'>$edit_button.$delete_button</div>";
							}
	
	
						}else{// si la valeur n'est pas encore enregistré
								
								
							if((isset($value['drill_down_type']) AND $value['drill_down_type'] == 'not_linked') OR !$editable OR empty($value_field['drilldown_add_link']))
							{
								$add_button = "";
							}else{
								$array['edit']=1;
								$add_button = create_button_link($value_field['drilldown_add_link'].$ref_id,'<i class="fa fa-plus"></i> Add',"btn-success",'Add ');
									
								if($ref_table=='classification'){//use modal for classification
									$modal_title="Add : ".$value['field_title'];
									//TODO correct this line for classification
									$add_button='<a  class="btn btn-xs btn-success" data-toggle="modal" data-target="#relisformModal" data-operation_type="2"  data-modal_link="manager/add_element_drilldown_modal/'.$Tconfig[0].'/'.$ref_table.'/'.$key.'/'.$ref_id.'"  data-modal_title="'.$modal_title.'" ><i class="fa fa-plus"></i>Add</a>';
								}
									
									
							}
							$array['val']="<span>: ".$add_button."</span>";
							$array['val2'][0]="<span>: ".$add_button."</span>";
						}
					}else{
						
					
					//	print_test($array);
						if($array['val']=='0' AND empty($value_field['diplay_null'])){ //Avoid displaying zero in empty number fields
							///print_test($array);
							$array['val']="";
							$array['val2'][0]="";
						}
						
						
					}
					
					
						
					
				}
				
	
				array_push($item_data, $array);
	
	
			
		}
	
		return $item_data;
	
	}
		
	function get_left_menu(){
		
		$menu = array();
		
		$menu['general']=array(
				'label'=>'General'
		);
		
		
		$menu['general']['menu']['home']=array('label'=>'Home','url'=>'home','icon'=>'home');
		
		$menu['general']['menu']['papers']=array('label'=>'Papers','url'=>'','icon'=>'newspaper-o');
		
		$menu['general']['menu']['papers']['sub_menu']['all_papers']=array( 'label'=>'All papers', 'url'=>'relis/manager/list_paper', '');
				
		$menu['general']['menu']['papers']['sub_menu']['processed']=array( 'label'=>'Processed', 'url'=>'relis/manager/list_paper/processed', '');
		
		$menu['general']['menu']['papers']['sub_menu']['pending']=array( 'label'=>'Pending', 'url'=>'relis/manager/list_paper/pending', '');
		
		$menu['general']['menu']['papers']['sub_menu']['assigned_me']=array( 'label'=>'Assigned to me', 'url'=>'relis/manager/list_paper/assigned_me', '');
		
		$menu['general']['menu']['papers']['sub_menu']['assigned_me']=array( 'label'=>'Assigned to me', 'url'=>'relis/manager/list_paper/assigned_me', '');
		
		$menu['general']['menu']['papers']['sub_menu']['excluded']=array( 'label'=>'Excluded', 'url'=>'relis/manager/list_paper/excluded', '');		
		
		//$menu['general']['menu']['papers']['sub_menu']['import_papers']=array( 'label'=>'Import papers', 'url'=>'relis/manager/import_papers', '');
		
		
		
		$menu['general']['menu']['classification']=array('label'=>'Classification','url'=>'relis/manager/list_classification','icon'=>'list');
		
		
		
		$menu['general']['menu']['result']=array('label'=>'Result','url'=>'','icon'=>'pie-chart');
		
		$menu['general']['menu']['result']['sub_menu']['result_graph']=array( 'label'=>'Graphs', 'url'=>'relis/manager/result_graph', '');
		
		$menu['general']['menu']['result']['sub_menu']['result_export']=array( 'label'=>'Export', 'url'=>'relis/manager/list_paper/result_export', '');
		
	
		$menu['general']['menu']['reference']=array('label'=>'Reference Tables','url'=>'','icon'=>'table');
		
		$reftables=$this->CI->manage_mdl->get_reference_tables_list();
		foreach ($reftables as $key => $value) {
			
			$menu['general']['menu']['reference']['sub_menu'][$value['reftab_label']]=array('label'=>$value['reftab_desc'],'url'=>'manager/entity_list/'.$value['reftab_label'],'icon'=>'');
		}
		
		
		
		
		$menu['settings']=array('label'=>'Settings');
		
		$menu['settings']['menu']['admin']=array('label'=>'Admin','url'=>'manager/projects_list','icon'=>'cog');
		$menu['settings']['menu']['sql_query']=array('label'=>'SQL','url'=>'home/sql_query','icon'=>'database');
		$menu['settings']['menu']['str_mng']=array('label'=>'String mangement','url'=>'manager/entity_list/str_mng','icon'=>'text-width');
		
		if (is_project_creator(project_db()) OR has_usergroup(1)){
			$menu['settings']['menu']['configuration']=array('label'=>'Configuration','url'=>'manager/display_element/config/1','icon'=>'gears');
			$menu['settings']['menu']['install_form_editor']=array('label'=>'Update Installation','url'=>'install/install_form_editor','icon'=>'refresh');
		
		}
		
		return $menu;
	}
	
	function get_left_menu_screen(){
		
		$menu = array();
		
		$menu['general']=array(
				'label'=>'General'
		);
		
		
		$menu['general']['menu']['home']=array('label'=>'Home','url'=>'home/screening','icon'=>'home');
		$menu['general']['menu']['home_screen']=array('label'=>'Screening','url'=>'home/screening_select','icon'=>'home');
	
		if(get_appconfig_element('screening_on'))
		$menu['general']['menu']['screen']=array( 'label'=>'Screen', 'url'=>'relis/manager/screen_paper', 'icon'=>'toggle-right');
		
		
		if(is_project_creator(project_db()) OR has_usergroup(1) OR get_appconfig_element('screening_result_on') ){
			$menu['general']['menu']['papers']=array('label'=>'Papers','url'=>'','icon'=>'newspaper-o');				
			//$menu['general']['menu']['papers']['sub_menu']['processed']=array( 'label'=>'Papers in conflict', 'url'=>'relis/manager/list_paper/processed', '');
			if(get_appconfig_element('import_papers_on'))
			$menu['general']['menu']['papers']['sub_menu']['import_papers']=array( 'label'=>'Import papers', 'url'=>'relis/manager/import_papers', '');
			
			$menu['general']['menu']['papers']['sub_menu']['all_papers']=array( 'label'=>'All papers', 'url'=>'op/entity_list/list_papers', '');
		//	$menu['general']['menu']['papers']['sub_menu']['screen_paper_pending']=array( 'label'=>'Papers pending', 'url'=>'relis/manager/list_screen/screen_paper_pending', '');
			//$menu['general']['menu']['papers']['sub_menu']['screen_paper_review']=array( 'label'=>'Papers in review', 'url'=>'relis/manager/list_screen/screen_paper_review', '');
			//$menu['general']['menu']['papers']['sub_menu']['screen_paper_included']=array( 'label'=>'Papers included', 'url'=>'relis/manager/list_screen/screen_paper_included', '');
			//$menu['general']['menu']['papers']['sub_menu']['screen_paper_excluded']=array( 'label'=>'Papers excluded', 'url'=>'relis/manager/list_screen/screen_paper_excluded', '');
			//$menu['general']['menu']['papers']['sub_menu']['screen_paper_conflict']=array( 'label'=>'Papers in conflict', 'url'=>'relis/manager/list_screen/screen_paper_conflict', '');
		}
		
		
		$menu['general']['menu']['papers_screen']=array('label'=>'Screening','url'=>'','icon'=>'newspaper-o');
		$menu['general']['menu']['papers_screen']['sub_menu']['all_assignments']=array( 'label'=>'All assignments', 'url'=>'op/entity_list/list_assignments', '');
		
		if(get_appconfig_element('assign_papers_on'))
		$menu['general']['menu']['papers_screen']['sub_menu']['assignment_screen']=array( 'label'=>'Assign papers for screening', 'url'=>'relis/manager/pre_assignment_screen', '');
		//$menu['general']['menu']['papers_screen']['sub_menu']['assignment_screen']=array( 'label'=>'Assign papers for screening', 'url'=>'relis/manager/assignment_screen', '');
		
		$menu['general']['menu']['papers_screen']['sub_menu']['my_assignment']=array( 'label'=>'--My assignments', 'url'=>'relis/manager/list_screen/mine_assign', '');
		$menu['general']['menu']['papers_screen']['sub_menu']['my_screen']=array( 'label'=>'--My screenings', 'url'=>'relis/manager/list_screen/mine_screen', '');
		
		if(is_project_creator(project_db()) OR has_usergroup(1) OR get_appconfig_element('screening_result_on') ){
			$menu['general']['menu']['papers_screen']['sub_menu']['all_assignment']=array( 'label'=>'--All assignments', 'url'=>'relis/manager/list_screen/all_assign', '');	
			$menu['general']['menu']['papers_screen']['sub_menu']['all_screen']=array( 'label'=>'All screenings', 'url'=>'op/entity_list/list_screenings', '');
			$menu['general']['menu']['papers_screen']['sub_menu']['completion']=array( 'label'=>'--Completion', 'url'=>'relis/manager/screen_completion', '');
	
			$menu['general']['menu']['papers_screen']['sub_menu']['result']=array('label'=>'Result','url'=>'relis/manager/screen_result','icon'=>'');
		}
		
		if(get_appconfig_element('screening_validation_on')){
			
		$menu['general']['menu']['papers_screen_validate']=array('label'=>'--Screening validation','url'=>'','icon'=>'newspaper-o');
		$menu['general']['menu']['papers_screen_validate']['sub_menu']['validate_screen']=array( 'label'=>'Assign papers for validation', 'url'=>'relis/manager/validate_screen_set', '');
		$menu['general']['menu']['papers_screen_validate']['sub_menu']['screen_validate']=array( 'label'=>'Screen', 'url'=>'relis/manager/screen_paper_validation', 'icon'=>'');
		$menu['general']['menu']['papers_screen_validate']['sub_menu']['screen_validate_assignments']=array( 'label'=>'Assignments', 'url'=>'relis/manager/list_screen/assign_validation', 'icon'=>'');
		$menu['general']['menu']['papers_screen_validate']['sub_menu']['screen_validate_screenings']=array( 'label'=>'Screenings', 'url'=>'relis/manager/list_screen/screen_validation', 'icon'=>'');
		$menu['general']['menu']['papers_screen_validate']['sub_menu']['screen_validate_result']=array( 'label'=>'Validation result', 'url'=>'relis/manager/screen_validation_result', 'icon'=>'');
		$menu['general']['menu']['papers_screen_validate']['sub_menu']['screen_validate_completion']=array( 'label'=>'Completion ', 'url'=>'relis/manager/screen_completion/validate', 'icon'=>'');
		}
		//$menu['general']['menu']['result']=array('label'=>'Result','url'=>'relis/manager/screen_result','icon'=>'bar-chart');
		
		
		
	
		
		//*
		
		
			
		
	
		
		//$menu['screen']['menu']['screen_result']=array( 'label'=>'Screening result', 'url'=>'home', '');
		
		//*/
		
		
		$menu['settings']=array('label'=>'Settings');
		
		$menu['settings']['menu']['admin']=array('label'=>'Admin','url'=>'manager/projects_list','icon'=>'cog');
		
		//$menu['settings']['menu']['reference']=array('label'=>'Exclusion criteria','url'=>'manager/entity_list/ref_exclusioncrieria','icon'=>'table');
		$menu['settings']['menu']['reference']=array('label'=>'Reference','url'=>'op/entity_list/list_exclusioncrieria','icon'=>'table');
		$menu['settings']['menu']['reference']['sub_menu']['exclusioncrieria']=array('label'=>'Exclusion criteria','url'=>'op/entity_list/list_exclusioncrieria','icon'=>'');
		$menu['settings']['menu']['reference']['sub_menu']['papers_sources']=array('label'=>'Papers sources','url'=>'op/entity_list/list_papers_sources','icon'=>'');
		$menu['settings']['menu']['reference']['sub_menu']['search_strategy']=array('label'=>'Search strategy','url'=>'op/entity_list/list_search_strategy','icon'=>'');
		//['settings']['menu']['reference_papers_sources']=array('label'=>'Papers sources','url'=>'op/entity_list/list_papers_sources','icon'=>'table');
		//$menu['settings']['menu']['reference_search_strategy']=array('label'=>'Search strategy','url'=>'op/entity_list/list_search_strategy','icon'=>'table');
		
		$menu['settings']['menu']['authors']=array('label'=>'Authors','url'=>'op/entity_list/list_authors','icon'=>'users');
		$menu['settings']['menu']['venues']=array('label'=>'Venues','url'=>'op/entity_list/list_venues','icon'=>'list');
		//$menu['settings']['menu']['papers']=array('label'=>'Papers test','url'=>'op/entity_list/list_papers','icon'=>'list');
		$menu['settings']['menu']['operations']=array('label'=>'Operations','url'=>'manager/entity_list/operations','icon'=>'reorder');
		$menu['settings']['menu']['sql_query']=array('label'=>'SQL','url'=>'home/sql_query','icon'=>'database');
		$menu['settings']['menu']['str_mng']=array('label'=>'String mangement','url'=>'manager/entity_list/str_mng','icon'=>'text-width');
		
		if (is_project_creator(project_db()) OR has_usergroup(1)){
		//$menu['settings']['menu']['configuration_old']=array('label'=>'Configuration','url'=>'manager/display_element/config/1','icon'=>'gears');
		$menu['settings']['menu']['configuration']=array('label'=>'Configuration','url'=>'op/display_element/configurations/1','icon'=>'gears');
		$menu['settings']['menu']['configuration']['sub_menu']['general']=array('label'=>'General configuration','url'=>'op/display_element/configurations/1','icon'=>'');
		$menu['settings']['menu']['configuration']['sub_menu']['users']=array('label'=>'Papers configuration','url'=>'op/display_element/config_papers/1','icon'=>'');
		$menu['settings']['menu']['configuration']['sub_menu']['screen_phases']=array('label'=>'Screening phases','url'=>'op/entity_list/list_screen_phases','icon'=>'');
			
		$menu['settings']['menu']['install_form_editor']=array('label'=>'Update Installation','url'=>'install/install_form_editor','icon'=>'refresh');
		$menu['settings']['menu']['Configuration_managment']=array('label'=>'Configuration_managment','url'=>'admin/list_configurations','icon'=>'cog');
		}
		return $menu;
	}
	
	function get_left_menu_admin(){
	
		$menu = array();
	
		$menu['general']=array(
				'label'=>'General'
		);
	
	
		$menu['general']['menu']['home']=array('label'=>'Home','url'=>'manager/projects_list','icon'=>'home');
		
		if(has_usergroup(1) OR has_usergroup(2))
		$menu['general']['menu']['new_project_editor']=array('label'=>'New project','url'=>'install/new_project_editor','icon'=>'plus');
		
		if(has_usergroup(1)){
		$menu['general']['menu']['usersn']=array('label'=>'Users','url'=>'op/entity_list/list_all_users','icon'=>'user');
		$menu['general']['menu']['usergroup']=array('label'=>'Usergroups','url'=>'op/entity_list/list_usergroups','icon'=>'users');
		//$menu['general']['menu']['projects']=array('label'=>'Projects','url'=>'op/entity_list/list_projects','icon'=>'users');
		//$menu['general']['menu']['list_userprojects']=array('label'=>'Users Projects','url'=>'op/entity_list/list_userprojects','icon'=>'users');
		$menu['general']['menu']['logs']=array('label'=>'Logs','url'=>'manager/entity_list/logs','icon'=>'sliders');
		$menu['general']['menu']['Configuration_managment']=array('label'=>'Configuration_managment','url'=>'admin/list_configurations','icon'=>'cog');
		}
		
		return $menu;
	}

}
	