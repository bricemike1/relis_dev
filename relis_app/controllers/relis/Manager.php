<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This controller contains the definition of function used for systematic mapping
 * @author Brice
 * @since 09/02/2017
 */
class Manager extends CI_Controller {

	function __construct()
	{
		parent::__construct();
					
	}
	

	/*
	 * Fonction  pour afficher la liste des papiers utilisant un Java script datatable
	 *
	 * Input: $paper_cat: indique la categorie à afficher
	 * 			$val : valeur de recherche si une recherche a été faite
	 * 			$page: la page à affiché : ulilisé par les lien de navigation
	 */
	
	public function list_paper($paper_cat='all',$val = "_", $page = 0, $dynamic_table=0){
	
	
	
		$ref_table="papers";
	
		/*
		 * Vérification si il y a une recherche faite
		 */
		$val = urldecode ( urldecode ( $val ) );
		$filter = array ();
		if (isset ( $_POST ['search_all'] )) {
			$filter = $this->input->post ();
				
			unset ( $filter ['search_all'] );
	
			$val = "_";
			if (isset ( $filter ['valeur'] ) and ! empty ( $filter ['valeur'] )) {
				$val = $filter ['valeur'];
				$val = urlencode ( urlencode ( $val ) );
			}
	
			/*
			 * mis à jours de l'url en ajoutant la valeur recherché dans le lien puis rechargement de l'url
			 */
			$url = "relis/manager/list_paper/" . $paper_cat ."/". $val ."/0/";
	
			redirect ( $url );
		}
	
	
		/*
		 * Récupération de la configuration(structure) de la table à afficher
		 */
		$ref_table_config=get_table_config($ref_table);
	
		$table_id=$ref_table_config['table_id'];
	
	
		/*
		 * Appel du model pour récuperer la liste à afficher dans la Base de données
		 */
		
		$rec_per_page=($dynamic_table)?-1:0;
		
		$data=$this->DBConnection_mdl->get_papers($paper_cat,$ref_table_config,$val,$page,$rec_per_page);
	
		//for select dropboxes
	
		/*
		 * récupération des correspondances des clès externes
		 */
		$dropoboxes=array();
		foreach ($ref_table_config['fields'] as $k => $v) {
				
			if(!empty($v['input_type']) AND $v['input_type']=='select' AND $v['on_list']=='show'){
				if($v['input_select_source']=='array'){
					$dropoboxes[$k]=$v['input_select_values'];
				}elseif($v['input_select_source']=='table'){
					$dropoboxes[$k]= $this->manager_lib->get_reference_select_values($v['input_select_values']);
				}elseif($v['input_select_source']=='yes_no'){
					$dropoboxes[$k]=array('0'=>"No",
										'1'=>"Yes"
					);
				}
			}
			
		}
	
		
		/*
		 * Vérification des liens (links) a afficher sur la liste
		 */
		
		
		$list_links=array();
		$add_link = false;
		$add_link_url="";
		$view_link_url="";
		
		foreach ($ref_table_config['links'] as $link_type => $link) {
			if(!empty($link['on_list'])){
				{
					$link['type']=$link_type;
		
		
					if(empty($link['title'])){
						$link['title']=lng_min($link['label']);
					}
		
						
					$push_link=false;
						
					switch ($link_type) {
						case 'add':
								
							$add_link=true; //will appear as a top button
								
							if(empty($link['url']))
								$add_link_url='manager/add_element/' . $ref_table;
								else
									$add_link_url=$link['url'];
										
									break;
		
						case 'view':
							if(!isset($link['icon']))
								$link['icon']='folder';
		
									
									
								if(empty($link['url']))
									$link['url']='manager/display_element/' . $ref_table.'/';
		
									
									
									$push_link=true;
		
									break;
		
						case 'edit':
								
							if(!isset($link['icon']))
								$link['icon']='pencil';
		
									
								if(empty($link['url']))
									$link['url']='manager/edit_element/' . $ref_table.'/';
		
									$push_link=true;
									break;
		
						case 'delete':
								
							if(!isset($link['icon']))
								$link['icon']='trash';
		
									
		
								if(empty($link['url']))
									$link['url']='manager/delete_element/' . $ref_table.'/';
		
									$push_link=true;
									break;
		
						case 'add_child':
								
							if(!isset($link['icon']))
								$link['icon']='plus';
		
								if(!empty($link['url'])){
		
									$link['url']='manager/add_element_child/'.$link['url']."/". $ref_table."/";
		
									$push_link=true;
								}
		
								break;
		
						default:
								
							break;
					}
						
					if($push_link)
						array_push($list_links, $link);
		
		
				}
			}
		
		}
		
		
		
			
			
		/*
		 * Préparation de la liste à afficher sur base du contenu et  stucture de la table
		 */
	
		/**
		 * @var array $field_list va contenir les champs à afficher
		 */
		$field_list=array();
		$field_list_header=array();
		foreach ($ref_table_config['fields'] as $k => $v) {
		
			if( $v['on_list']=='show'){
		
				array_push($field_list, $k);
				array_push($field_list_header, $v['field_title']);
		
			}
		
		}
		
		$i=1;
		$list_to_display=array();
		foreach ($data['list'] as $key => $value) {
			
			$element_array=array();
			foreach ($field_list as $key_field=> $v_field) {
				if(isset($value[$v_field])){
					if(isset($dropoboxes[$v_field][$value[$v_field]]) ){
						$element_array[$v_field]=$dropoboxes[$v_field][$value[$v_field]];
					}else{
						$element_array[$v_field]=$value[$v_field];
					}
						
						
				}else{
						
						
						
					$element_array[$v_field]="";
						
					if(isset($ref_table_config['fields'][$v_field]['number_of_values']) AND $ref_table_config['fields'][$v_field]['number_of_values']!=1){
							
						if(isset($ref_table_config['fields'][$v_field]['input_select_values']) AND isset($ref_table_config['fields'][$v_field]['input_select_key_field']))
						{
							// récuperations des valeurs de cet element
							$M_values=$this->manager_lib->get_element_multi_values($ref_table_config['fields'][$v_field]['input_select_values'],$ref_table_config['fields'][$v_field]['input_select_key_field'],$data ['list'] [$key] [$table_id]);
							$S_values="";
							foreach ($M_values as $k_m => $v_m) {
								if(isset($dropoboxes[$v_field][$v_m]) ){
									$M_values[$k_m]=$dropoboxes[$v_field][$v_m];
								}
			
								$S_values.=empty($S_values)?$M_values[$k_m]:" | ".$M_values[$k_m];
							}
								
							$element_array[$v_field]=$S_values;
						}
			
					}
			
			
			
						
				}
			
					
			
			
			}
			
			
			/*
			 * Ajout des liens(links) sur la liste
			 */
				
			
			$action_button="";
			$arr_buttons=array();
			$view_link_url="";
			foreach ($list_links as $key_l => $value_l) {
			
				if(!empty($value_l['icon']))
					$value_l['label']= icon($value_l['icon']).' '.lng_min($value_l['label']);
			
					array_push($arr_buttons, array(
							'url'=> $value_l['url'].$value [$table_id],
							'label'=>$value_l['label'],
							'title'=>$value_l['title']
								
					)	);
					
					if($value_l['type']=='view')
						$view_link_url=$value_l['url'].$value [$table_id];
			}
				
				
			$action_button=create_button_link_dropdown($arr_buttons,lng_min('Action'));
			$element_array['links']=$action_button;
			
			if(isset($element_array['bibtexKey']) AND !empty($view_link_url)){
				$element_array['bibtexKey']=anchor($view_link_url,"<u><b>".$element_array['bibtexKey']."</b></u>",'title="'.lng_min('Display element').'")');
			}
			if(isset($element_array[$table_id])){
				$element_array[$table_id]=$i + $page;
			}
			
			array_push($list_to_display,$element_array);
			$i++;
			
			
			
		}
	
		$data ['list']=$list_to_display;
	
		/*
		 * Ajout de l'entête de la liste
		 */
		if(!empty($data['list'])){
			$array_header=$field_list_header;;
			if(trim($data['list'][$key]['links']) !=""){
				array_push($array_header,'');
			}
			
			if(!$dynamic_table){
				array_unshift($data['list'],$array_header);
			}else{
				$data['list_header']=$array_header;
			}
				
		}
	
		/*
		 * Création des boutons qui vont s'afficher en haut de la page (top_buttons)
		 */
	
		$data ['top_buttons']="";
		if($data['nombre']==0 AND $paper_cat== 'all'){
			//$data ['top_buttons'] .= get_top_button ( 'all', 'Add test papers', 'install/create_default_papers','test papers');
		}
		
		if($add_link)
		$data ['top_buttons'] .= get_top_button ( 'add', 'Add new', $add_link_url );
		
		
		if(activate_update_stored_procedure())
		$data ['top_buttons'] .= get_top_button ( 'all', 'Update stored procedure', 'home/update_stored_procedure/'.$ref_table,'Update stored procedure','fa-check','',' btn-dark ' );
		
		$data ['top_buttons'] .= get_top_button ( 'close', 'Close', 'home' );
	
	
	
		/*
		 * Titre de la page
		 */
		if($paper_cat== 'pending' OR $paper_cat== 'processed'  ){
				
			$data['page_title']=$ref_table_config['reference_title'].' - '.$paper_cat;
				
		}elseif($paper_cat== "assigned_me" ){
			$data['page_title']=$ref_table_config['reference_title'].' - Assigned to me';
				
		}elseif($paper_cat== "excluded" ){
			$data['page_title']=$ref_table_config['reference_title'].' - Excluded';
				
		}else{
	
			$data['page_title']=$ref_table_config['reference_title'];
		}
	
	
	
		
	
		$data ['valeur']=($val=="_")?"":$val;
	
		if(!$dynamic_table AND  !empty($ref_table_config['search_by'])){
			$data ['search_view'] = 'general/search_view';}
	
	
			/*
			 * La vue qui va s'afficher
			 */
			if(!$dynamic_table){
				$data ['nav_pre_link'] = 'relis/manager/list_paper/' .$paper_cat.'/' . $val . '/';
				$data ['nav_page_position'] = 6;
				$data['page']='general/list';
			}else{
				$data['page']='general/list_dt';
			}
			/*
			 * Chargement de la vue avec les données préparés dans le controleur
			 */
			$this->load->view('body',$data);
	}
	
	
	
	
	/*
	 * Fonction spécialisé  pour l'affichage d'un papier
	 * Input:	$ref_id: id du papier
	 */
	public function display_paper($ref_id) {
	
		
	//	print_test(get_table_config('classification'));
	
		$ref_table="papers";
	
		/*
		 * Récupération de la configuration(structure) de la table des papiers
		 */
		$table_config=get_table_config($ref_table);
	
	print_test(get_table_config('classification'));
		/*
		 * Appel de la fonction  récupérer les informations sur le papier afficher
		 */
		$paper_data=$this->manager_lib->get_element_detail('papers',$ref_id);
		
		
		
	
		/*
		 * Préparations des informations à afficher
		 */
	
		//venue
		$venue="";
		foreach ($paper_data as $key => $value) {
			if($value['title']=='Venue' AND !empty($value['val2'][0])){
				$venue=$value['val2'][0];
			}
		}
	
		//Authors
		$authors="";
		foreach ($paper_data as $key => $value) {
				
			if($value['title']=='Author' AND !empty($value['val2'])){
	
				if(count($value['val2']>1)){
					$authors='<table class="table table-hover" ><tr><td> '.$value['val2'][0].'</td></tr>';
					foreach ($value['val2'] as $k => $v) {
						if($k>0){
							$authors.="<tr><td> ".$v.'</td></tr>';
						}
					}
						
					$authors.="</table>";
				}else{
						
					$authors=" : ".$value['val2'][0];
				}
	
			}
		}
		
		
		
		
		
	
		$content_item = $this->DBConnection_mdl->get_row_details ( $ref_table,$ref_id );
	
		$paper_name=$content_item['bibtexKey']." - ".$content_item['title'];
		$paper_excluded=False;
		if($content_item['paper_excluded']=='1'){
			$paper_excluded=True;
		}
	
		$data['paper_excluded']=$paper_excluded;
		$item_data=array();
	
	
		$array['title']=$content_item['bibtexKey']." - ".$content_item['title'];
	
		if(!empty($content_item['doi'])){
				
			$array['title'].='<ul class="nav navbar-right panel_toolbox">
				<li>
					<a title="Go to the page" href="'.$content_item['doi'].'" target="_blank" >
				 		<img src="'.base_url().'cside/images/pdf.jpg"/>
	
					</a>
				</li>
	
				</ul>';
		}
			
	
		array_push($item_data, $array);
	
		$array['title']="<b>".lng('Abstract')." :</b> <br/><br/>".$content_item['preview'];
		array_push($item_data, $array);
		$array['title']="<b>".lng('Preview')." :</b> <br/><br/>".$content_item['bibtex'];
		array_push($item_data, $array);
	
		$array['title']="<b>".lng('Venue')." </b> ".$venue;
		//array_push($item_data, $array);
	
		$array['title']="<b>".lng('Authors')." </b> ".$authors;
		//array_push($item_data, $array);
	
			
	
		$data['item_data']=$item_data;
	
	
	
	
	
	
	
	
	
	
		/*
		 * Informations sur l'exclusion du papier si le papier est exclu
		 */
	
		$exclusion = $this->DBConnection_mdl->get_exclusion ($ref_id );
	
		$table_config3=get_table_config("exclusion");
		$dropoboxes=array();
		foreach ($table_config3['fields'] as $k => $v) {
	
			if(!empty($v['input_type']) AND $v['input_type']=='select' AND $k!='exclusion_paper_id'){
				if($v['input_select_source']=='array'){
					$dropoboxes[$k]=$v['input_select_values'];
				}elseif($v['input_select_source']=='table'){
					$dropoboxes[$k]= $this->manager_lib->get_reference_select_values($v['input_select_values']);
				}
			}
			
		}
	
	
		$T_item_data_exclusion=array();
		$T_remove_exclusion_button =array();
		$item_data_exclusion=array();
		$delete_exclusion="";
		$edit_exclusion="";
	
		if (!empty($exclusion)) {
	
			//put values from reference tables
			foreach ($dropoboxes as $k => $v) {
				if(($exclusion[$k])){
					if(isset($v[$exclusion[$k]])){
						$exclusion[$k]=$v[$exclusion[$k]];}
				}
				else{
					$exclusion[$k]="";
				}
			}
	
				
			foreach ($table_config3['fields'] as $k_t => $v_t) {
					
				if(!(isset($v_t['on_view']) AND $v_t['on_view']=='hidden' ) AND  $k_t!='exclusion_paper_id'){
	
					$array['title']=$v_t['field_title'];
					$array['val']=isset($exclusion[$k_t])?": ".$exclusion[$k_t]:': ';
	
					array_push($item_data_exclusion, $array);
	
				}
			}
	
			$delete_exclusion= get_top_button ( 'delete', 'Cancel the exclusion', 'relis/manager/remove_exclusion/'.$exclusion['exclusion_id']."/".$ref_id , 'Cancel the exclusion')." ";
	
			$edit_exclusion= get_top_button ( 'edit', 'Edit the exclusion', 'relis/manager/edit_exclusion/'.$exclusion['exclusion_id'], 'Edit the exclusion')." ";
	
	
		}
	
	
		$data['data_exclusion']=$item_data_exclusion;
		$data['remove_exclusion_button']=$edit_exclusion.$delete_exclusion;
	
	
	
	
	
	
		/*
		 * Information sur la classification du papier si le papiers est déjà classé
		 */
	
		$classification = $this->DBConnection_mdl->get_classifications ($ref_id );
	
	
		if(!empty($classification)){
				
			$classification_data=$this->manager_lib->get_element_detail('classification', $classification[0]['class_id'],False,True);
			
		//print_test(get_table_config('classification'));
			
			$data['classification_data']=$classification_data;
	
			$delete_button= get_top_button ( 'delete', 'Remove the classification', 'relis/manager/remove_classification/'.$classification[0]['class_id']."/".$ref_id , 'Remove the classification')." ";
	
			$edit_button= get_top_button ( 'edit', 'Edit the classification', 'relis/manager/edit_classification/'.$classification[0]['class_id'], 'Edit the classification')." ";
				
			$data['classification_button']=$edit_button." ".$delete_button;
		}else{
			if(!empty(	$table_config['links']['add_child']['url']) AND !empty($table_config['links']['add_child']['on_view'])  AND ($table_config['links']['add_child']['on_view']== True) ){
					
				$data ['classification_button'] =get_top_button ( 'add', 'Add classification', 'relis/manager/new_classification/'.$ref_id, 'Add classification')." ";;
					
			}
		}
	
	
	
	
		/*
		 * Informations sur l'assignation du papier si le papier est assigné à un utilisateur
		 */
	
		$assignation = $this->DBConnection_mdl->get_assignations ($ref_id );
	
	
		$table_config3=get_table_config("assignation");
	
		$dropoboxes=array();
		foreach ($table_config3['fields'] as $k => $v) {
	
			if(!empty($v['input_type']) AND $v['input_type']=='select' AND $k!='class_paper_id'){
				if($v['input_select_source']=='array'){
					$dropoboxes[$k]=$v['input_select_values'];
				}elseif($v['input_select_source']=='table'){
					$dropoboxes[$k]= $this->manager_lib->get_reference_select_values($v['input_select_values']);
				}
			}
			;
		}
	
		$T_item_data_assignation=array();
		$T_remove_assignation_button =array();
		foreach ($assignation as $k_class => $v_class) {
	
			//put values from reference tables
			foreach ($dropoboxes as $k => $v) {
				if(($assignation[$k_class][$k])){
	
					$assignation[$k_class][$k]=$v[$assignation[$k_class][$k]];
				}
				else{
					$assignation[$k_class][$k]="";
				}
			}
	
				
			$item_data_assignation=array();
			foreach ($table_config3['fields'] as $k_t => $v_t) {
					
				if(!(isset($v_t['on_view']) AND $v_t['on_view']=='hidden' ) AND  $k_t!='assigned_paper_id'){
	
					$array['title']=$v_t['field_title'];
					$array['val']=isset($v_class[$k_t])?": ".$assignation[$k_class][$k_t]:': ';
	
					array_push($item_data_assignation, $array);
	
				}
			}
	
			$T_item_data_assignation[$k_class]=$item_data_assignation;
	
				
			$delete_button= get_top_button ( 'delete', 'Remove the assignation', 'relis/manager/remove_assignation/'.$v_class['assigned_id']."/".$ref_id , 'Remove the assignation')." ";
	
			$edit_button= get_top_button ( 'edit', 'Edit the assignation', 'relis/manager/edit_assignation/'.$v_class['assigned_id'], 'Edit the assignation')." ";
	
			$T_remove_assignation_button[$k_class]=$edit_button.$delete_button;
	
		}
	
		$data['data_assignations']=$T_item_data_assignation;
		$data['remove_assignation_button']=$T_remove_assignation_button;
	
	
	
	
	
	
	
		/*
		 * Création des boutons qui vont s'afficher en haut de la page (top_buttons)
		 */
		$data ['top_buttons']="";
	
		$data ['add_assignation_buttons']=get_top_button ( 'all', "Assigne to a user", 'relis/manager/new_assignation/'.$ref_id ,' Assigne to someone '," fa-plus ","  ",'btn-success' )." ";
	
	
		if(!$paper_excluded){
	
			$data ['top_buttons'].=get_top_button ( 'all', "Exclude the paper", 'relis/manager/new_exclusion/'.$ref_id ,'Exclude'," fa-minus",'','btn-danger' )." ";
	
	
			if(!empty(	$table_config['links']['edit']) AND !empty($table_config['links']['edit']['on_view'])  AND ($table_config['links']['edit']['on_view']== True) ){
	
				$data ['top_buttons'] .= get_top_button ( 'edit', $table_config['links']['edit']['title'], 'manager/edit_element/' . $ref_table.'/'.$ref_id )." ";
	
			}
	
			if(!empty(	$table_config['links']['delete']) AND !empty($table_config['links']['delete']['on_view'])  AND ($table_config['links']['delete']['on_view']== True) ){
	
				$data ['top_buttons'] .= get_top_button ( 'delete', $table_config['links']['delete']['title'], 'manage/delete_element/' . $ref_table.'/'.$ref_id )." ";
	
			}
	
		}
	
	
		$data ['top_buttons'] .= get_top_button ( 'back', 'Back', 'manage' );
	
	
	
		/*
		 * Titre de la page
		 */
		$data ['page_title'] = lng($table_config['reference_title_min']);
	
		if($paper_excluded){
			$data ['page_title'] = lng("Paper excluded");
		}
	
	
		/*
		 * La vue qui va s'afficher
		 */
		$data ['page'] = 'relis/display_paper';
	
	
		/*
		 * Chargement de la vue avec les données préparés dans le controleur suivant le type d'affichage : (popup modal ou pas)
		 */
		$this->load->view ( 'body', $data );
	}
	
	
	
	/*
	 * Affichage du formulaire pour modifier une exclusion d'un papier
	 * $ref_id: id de l'exclusion
	 */
	public function edit_exclusion($ref_id) {
		
		/*
		 * Appel de la fonction du model pour recupérer la ligne à modifier
		 */
		$data ['content_item'] = $this->DBConnection_mdl->get_row_details('exclusion',$ref_id);
		//print_test($data);
	
		/*
		 * Appel de la fonction d'affichage du formulaire
		 */
		$this->new_exclusion ( $data ['content_item']['exclusion_paper_id'], $data, 'edit' );
	}
	
	
	
	/*
	 * Fonction  pour afficher la page avec un formulaire pour l'exclusion d'un papier
	 *
	 * Input: 	$paper_id: l'id du papier
	 * 			$data : informations sur le papier si la fonction est utilisé pour la mis à jour(modification)
	 * 			$operation: type de l'opération ajout (new) ou modification(edit)
	 *
	 */
	public function new_exclusion($paper_id, $data = "",$operation="new") {
	
		$ref_table_child= 'exclusion';
		$child_field= 'exclusion_paper_id';
		$ref_table_parent= 'papers';
	
		/*
		 * Récupération de la configuration(structure) de la table exclusion
		 */
		$table_config_child=get_table_config($ref_table_child);
		$table_config_child['config_id']=$ref_table_child;
	
	
		/*
		 * Récupération de la configuration(structure) de la table des papiers
		 */
		$table_config_parent=get_table_config($ref_table_parent);
	
		$table_config_child['fields'][$child_field]['on_add']="hidden";
		$table_config_child['fields'][$child_field]['on_edit']="hidden";
		$table_config_child['fields'][$child_field]['input_type']="text";
	
	
	
	
		foreach ($table_config_child['fields'] as $k => $v) {
	
			if(!empty($v['input_type']) AND $v['input_type']=='select'){
				if($v['input_select_source']=='table'){
					$table_config_child['fields'][$k]['input_select_values']= $this->manager_lib->get_reference_select_values($v['input_select_values']);
				}
			}
	
		}
	
	
		/*
		 * Prépartions des valeurs qui vont apparaitres dans le formulaire
		 */
		$data['content_item'][$child_field]=$paper_id;
		$data['table_config']=$table_config_child;
		$data['operation_type']=$operation;
		$data['operation_source']="exclusion";
		$data['child_field']=$child_field;
		$data['table_config_parent']=$ref_table_parent;
		$data['parent_id']=$paper_id;
	
	
	
		/*
		 * Titre de la page
		 */
		$parrent_names=$this->manager_lib->get_reference_select_values($table_config_child['fields'][$child_field]['input_select_values']);
		if($operation=='edit'){
			$data ['page_title'] = 'Edit Exclusion of the '.$table_config_parent['reference_title_min']." : ".$parrent_names[$paper_id];
		}else{
			$data ['page_title'] = 'Exclusion of the '.$table_config_parent['reference_title_min']." : ".$parrent_names[$paper_id];
	
		}
	
	
	
	
		/*
		 * Création des boutons qui vont s'afficher en haut de la page (top_buttons)
		 */
		$data ['top_buttons'] = get_top_button ( 'back', 'Back', 'manage' );
	
	
		/*
		 * La vue qui va s'afficher
		 */
		$data ['page'] = 'general/frm_reference';
	
	
	
		/*
		 * Chargement de la vue avec les données préparés dans le controleur suivant le type d'affichage : (popup modal ou pas)
		 */
		$this->load->view ( 'body', $data );
	}
	
	
	public function remove_exclusion ($id,$paper_id){
		$res=$this->DBConnection_mdl->remove_element($id,'exclusion');
		$res1=$this->DBConnection_mdl->include_paper($paper_id);
		
		set_top_msg(lng_min('Exclusion cancelled'));
	
		redirect ( 'relis/manager/display_paper/' .$paper_id  );
	}
	
	public function remove_assignation ($id,$paper_id){
		$res=$this->DBConnection_mdl->remove_element($id,'assignation');
		set_top_msg(lng_min('Assignation removed'));
		redirect ( 'relis/manager/display_paper/' .$paper_id  );
	}
	
	public function remove_classification ($id,$paper_id){
		$res=$this->DBConnection_mdl->remove_element($id,'classification');
		set_top_msg(lng_min('Classification removed'));
		redirect ( 'relis/manager/display_paper/' .$paper_id  );
	}
	
	/*
	 * Fonction  pour afficher la page avec un formulaire pour assigner un papier à un utilisateur
	 *
	 * Input: 	$paper_id: l'id du papier
	 * 			$data : informations sur le papier si la fonction est utilisé pour la mis à jour(modification)
	 * 			$operation: type de l'opération ajout (new) ou modification(edit)
	 *
	 */
	
	public function new_assignation($paper_id, $data = "",$operation="new") {
	
		$ref_table_child= 'assignation';
		$child_field= 'assigned_paper_id';
		$ref_table_parent= 'papers';
	
	
		/*
		 * Récupération de la configuration(structure) de la table assignation
		 */
		$table_config_child=get_table_config($ref_table_child);
		$table_config_child['config_id']=$ref_table_child;
	
		/*
		 * Récupération de la configuration(structure) de la table des papiers
		 */
		$table_config_parent=get_table_config($ref_table_parent);
	
		$table_config_child['fields'][$child_field]['on_add']="hidden";
		$table_config_child['fields'][$child_field]['on_edit']="hidden";
		$table_config_child['fields'][$child_field]['input_type']="text";
	
	
	
		/*
		 * récupération des valeurs qui vont apparaitre dans les champs select
		 */
		foreach ($table_config_child['fields'] as $k => $v) {
	
			if(!empty($v['input_type']) AND $v['input_type']=='select'){
				if($v['input_select_source']=='table'){
					$table_config_child['fields'][$k]['input_select_values']= $this->manager_lib->get_reference_select_values($v['input_select_values']);
				}
			}
	
		}
	
		/*
		 * Prépartions des valeurs qui vont apparaitres dans le formulaire
		 */
		$data['content_item'][$child_field]=$paper_id;
		$data['table_config']=$table_config_child;
		$data['operation_type']=$operation;
		$data['operation_source']="assignation";
		$data['child_field']=$child_field;
		$data['table_config_parent']=$ref_table_parent;
		$data['parent_id']=$paper_id;
	
	
		$parrent_names=$this->manager_lib->get_reference_select_values($table_config_child['fields'][$child_field]['input_select_values']);
	
		/*
		 * Titre de la page
		 */
		if($operation=='edit'){
			$data ['page_title'] = lng('Edit the assignation to the '.$table_config_parent['reference_title_min']." : ".$parrent_names[$paper_id]);
		}else{
			$data ['page_title'] = 'Assign a user to the '.$table_config_parent['reference_title_min']." : ".$parrent_names[$paper_id];
	
		}
	
	
	
	
	
		/*
		 * Création des boutons qui vont s'afficher en haut de la page (top_buttons)
		 */
		$data ['top_buttons'] = get_top_button ( 'back', 'Back', 'manage' );
	
	
		/*
		 * La vue qui va s'afficher
		 */
		$data ['page'] = 'general/frm_reference';
	
	
		/*
		 * Chargement de la vue avec les données préparés dans le controleur
		 */
		$this->load->view ( 'body', $data );
	}
	
	
	/*
	 * spécialisation de la fonction add_classification lorsque le formulaire s'affiche en pop up
	 */
	public function new_classification_modal($parent_id, $data = "",$operation="new") {
	
		$this->new_classification ( $parent_id, $data, $operation,'modal' );
	
	}
	
	
	/*
	 * Fonction  pour afficher la page avec un formulaire d'ajout d'une classification
	 *
	 * Input: $parent_id: l'id du papier à qui on va ajouter une classification
	 * 			$data : informations sur l'élément si la fonction est utilisé pour la mis à jour(modification)
	 * 			$operation: type de l'opération ajout (new) ou modification(edit)
	 * 			$display_type: indique comment le formulaire va être afficher normal ou modal(pop- up)
	 */
	
	public function new_classification($parent_id, $data = "",$operation="new",$display_type="normal") {
		
		
		$ref_table_child= 'classification';
		$child_field= 'class_paper_id';
		$ref_table_parent= 'papers';
		
		/*
		 * Récupération de la configuration(structure) de la table classification
		 */
		$table_config_child=get_table_config($ref_table_child);
		$table_config_child['config_id']=$ref_table_child;
		
		//print_test($table_config_child);
	
		//si les valeurs provienne d'une redirection apres tenetative d'enregistrement
		 
		if(!empty($data) AND $data=='sess_redirect'){
			$data=$this->session->userdata('redirect_values');
			
			if(isset($data['content_item']['class_id'])){
				
				$classification_id=$data['content_item']['class_id'];
				
				
				$element_detail=$this->manager_lib->get_element_detail($ref_table_child,$classification_id,true,true);
				
				$drill_down_values=array();
				
				foreach ($table_config_child['fields'] as $key => $v) {
					if(!empty($v['input_type']) AND $v['input_type']=='select' AND $v['input_select_source']=='table'){
						if (!empty($v['on_edit']) AND $v['on_edit']=='drill_down'){
							//Recuperation des valeurs pour les drilldown
								
							foreach ($element_detail as $key_el => $value_el) {
								if($value_el['field_id']==$key){
										
									$drill_down_values[$key]=$value_el['val2'];
								}
							}
				
						}
				
				
					}
				
				}
				
				//print_test($drill_down_values);
				$data['drill_down_values']=$drill_down_values;
				
			}
		}
		
		
		/*
		 * chargement de la manière d'affichage du formulaire
		 */
		
		$this->session->set_userdata('submit_mode',$display_type);
	
		
	
		//print_test($table_config_child);
	
	
		/*
		 * Récupération de la configuration(structure) de la table des papiers
		 */
		$table_config_parent=get_table_config($ref_table_parent);
	
		$table_config_child['fields'][$child_field]['on_add']="hidden";
		$table_config_child['fields'][$child_field]['on_edit']="hidden";
		$table_config_child['fields'][$child_field]['input_type']="text";
	
	
	
	
		/*
		 * récupération des valeurs qui vont apparaitre dans les champs select
		 */
		foreach ($table_config_child['fields'] as $k => $v) {
	
			if(!empty($v['input_type']) AND $v['input_type']=='select'){
				if($v['input_select_source']=='table'){
					if(isset($table_config_child['fields'][$k]['multi-select']) AND $table_config_child['fields'][$k]['multi-select']=='Yes' )
					{
						$table_config_child['fields'][$k]['input_select_values']= $this->manager_lib->get_reference_select_values($v['input_select_values'],False,False,True);
	
	
					}else{
						$table_config_child['fields'][$k]['input_select_values']= $this->manager_lib->get_reference_select_values($v['input_select_values']);
	
	
					}
				}
			}
	
		}
		/*
		 * Prépartions des valeurs qui vont apparaitres dans le formulaire
		 */
	
		$data['content_item'][$child_field]=$parent_id;
		$data['table_config']=$table_config_child;
		$data['operation_type']=$operation;
		$data['operation_source']="paper";
		$data['child_field']=$child_field;
		$data['table_config_parent']=$ref_table_parent;
		$data['parent_id']=$parent_id;
	
	
	
		/*
		 * Titre de la page
		 */
	
		$parrent_names=$this->manager_lib->get_reference_select_values($table_config_child['fields'][$child_field]['input_select_values']);
	
		if($operation=='edit'){
			$data ['page_title'] = lng('Edit  '.$table_config_child['reference_title_min']." for the ".$table_config_parent['reference_title_min'])." : ".$parrent_names[$parent_id];
		}else{
			$data ['page_title'] = lng('Add a '.$table_config_child['reference_title_min']." to the ".$table_config_parent['reference_title_min'])." : ".$parrent_names[$parent_id];
				
		}
	
	
	
		/*
		 * Création des boutons qui vont s'afficher en haut de la page (top_buttons)
		 */
		$data ['top_buttons'] = get_top_button ( 'back', 'Back', 'manage' );
	
		/*
		 * La vue qui va s'afficher
		 */
		$data ['page'] = 'general/frm_reference';
	
	
		/*
		 * Chargement de la vue avec les données préparés dans le controleur suivant le type d'affichage : (popup modal ou pas)
		 */
		if($display_type=='modal'){
			$this->load->view ( 'frm_reference_modal', $data );}else{
				$this->load->view ( 'body', $data );
			}
	
	}
	
	
	
	/*
	 * Affichage du formulaire pour modifier une classification
	 * $ref_id: id de la classification
	 * $display_type: indique comment le formulaire va être afficher normal ou modal(pop- up)
	 */
	public function edit_classification($ref_id,$display_type="normal") {
		
		$this->session->set_userdata('submit_mode',$display_type);
	
	
		/*
		 * Récupération de la configuration(structure) de la table classification
		 */
		$ref_table="classification";
		$table_config=get_table_config($ref_table);
	
		
		//print_test($table_config);
		/*
		 * Appel de la fonction du model pour récupérer la ligne à modifier
		 */
		$data ['content_item'] = $this->DBConnection_mdl->get_row_details($ref_table,$ref_id);
		
		$element_detail=$this->manager_lib->get_element_detail($ref_table,$ref_id,true,true);
	//	print_test($element_detail);
		
		
		
		$drill_down_values=array();
		
		foreach ($table_config['fields'] as $key => $v) {
			if(!empty($v['input_type']) AND $v['input_type']=='select' AND $v['input_select_source']=='table'){
			/*
			 * Récuperation des valeurs pour les champs multi-select
			 */
				if(!empty($v['multi-select']) AND $v['multi-select']=='Yes' )
				{
	
					$Tvalues_source=explode(';', $v['input_select_values']);
					$source_table_config=get_table_config($Tvalues_source[0]);
					$input_select_key_field=$v['input_select_key_field'];
					$input_child_field=$Tvalues_source[1];
	
					$extra_condition=" AND $input_select_key_field ='".$ref_id."'";
	
					$res_values=$this->DBConnection_mdl->get_reference_select_values($source_table_config,$input_child_field,$extra_condition);
					$data ['content_item'][$key]=array();
	
					foreach ($res_values as $key_r => $value_r) {
						array_push($data ['content_item'][$key], $value_r['refDesc']);
					}
	
				}elseif (!empty($v['on_edit']) AND $v['on_edit']=='drill_down'){
						//Recuperation des valeurs pour les drilldown
					
					foreach ($element_detail as $key_el => $value_el) {
						if($value_el['field_id']==$key){
							
							$drill_down_values[$key]=$value_el['val2'];
						}
					}
				
				}
				
				
			
				
				
				
				
			}
				
		}
		
		//print_test($drill_down_values);
		$data['drill_down_values']=$drill_down_values;
		
		
		/*
		 * Appel de la fonction d'affichage du formulaire
		 */
		$this->new_classification ( $data ['content_item']['class_paper_id'], $data, 'edit',$display_type );
	}
	
	/*
	 * Fonction utilisé pour faire une recherche dans la liste des classifications
	 *
	 * fields: le champs où on effectue la recherche
	 * $value: la valeur recherché
	 */
	public function search_classification($field,$value){
	
		$condition=array('classification_search_field'=>$field,
				'classification_search_value'=>$value
		);
	
		/*
		 * Chargement des critères de recherche dans une session
		 */
		$this->session->set_userdata($condition);
	
		/*
		 * Appel de la fonction d'affichagage de liste des classification en tenant comptes des critères de recherches mis en session
		 */
		$this->list_classification('search_cat');
	
	}
	
	/*
	 * Fonction  pour afficher la liste des classifications faites
	 *
	 * Input: $list_type: indique si une recherche à été faites ou pas.  si $list_type= 'normal' on affiche toute la liste
	 * 			$val : valeur de recherche si une recherche a été faite
	 * 			$page: la page à affiché : ulilisé par les lien de navigation
	 */
	
	public function list_classification($list_type='normal',$val = "_", $page = 0,$dynamic_table=1){
	
		// nouvelle fonction pour afficher la liste des classification elle utilise les data tables
		////redirect("manage/list_classification_dt/$list_type/$val/$page");
	
	
		$ref_table='classification';
	
		$val = urldecode ( urldecode ( $val ) );
		$filter = array ();
		if (isset ( $_POST ['search_all'] )) {
			$filter = $this->input->post ();
			// print_test($filter);exit;
			unset ( $filter ['search_all'] );
	
			$val = "_";
			if (isset ( $filter ['valeur'] ) and ! empty ( $filter ['valeur'] )) {
				$val = $filter ['valeur'];
				$val = urlencode ( urlencode ( $val ) );
			}
	
	
			$url = "relis/manager/list_classification/" . $ref_table ."/". $val ."/0/";
	
			redirect ( $url );
		}
	
	
		$ref_table_config=get_table_config($ref_table);
	
		
		$table_id=$ref_table_config['table_id'];
	
	
		$condition=array();
		$extra_condition="";
		$sup_title="";
	
		if($list_type=='search_cat')
		{
	
			if( $this->session->userdata('classification_search_field') AND $this->session->userdata('classification_search_value') ){
	
				$field=$this->session->userdata('classification_search_field');
				$value=$this->session->userdata('classification_search_value');
	
				$extra_condition =" AND ( ".$field."='".$value."') ";
	
				$value_desc=$value;
	
				if(!empty($ref_table_config['fields'][$field]['input_type']) AND $ref_table_config['fields'][$field]['input_type']=='select' ){
					$values=  $this->manager_lib->get_reference_select_values($ref_table_config['fields'][$field]['input_select_values']);
	
					
					$value_desc=$values[$value];
	
	
					$sup_title = " for \"". $ref_table_config['fields'][$field]['field_title']."\" :  $value_desc";
				}
	
	
			}
	
				
		}
		
		
		$rec_per_page=($dynamic_table)?-1:0;
					
		if(!empty($extra_condition)){
	
			$data=$this->manage_mdl->get_list($ref_table_config,$val,$page,$rec_per_page,$extra_condition);
		}else{
			$data=$this->DBConnection_mdl->get_list($ref_table_config,$val,$page,$rec_per_page,$extra_condition);
		}
	
	
		
	
		//for  dropboxes
		//print_test($ref_table_config);
		$dropoboxes=array();
		foreach ($ref_table_config['fields'] as $k => $v) {
	
			if(!empty($v['input_type']) AND $v['input_type']=='select' AND $v['on_list']=='show'){
				if($v['input_select_source']=='array'){
					$dropoboxes[$k]=$v['input_select_values'];
				}elseif($v['input_select_source']=='table'){
					$dropoboxes[$k]= $this->manager_lib->get_reference_select_values($v['input_select_values']);
				}elseif($v['input_select_source']=='yes_no'){
					$dropoboxes[$k]=array('0'=>"No",
										'1'=>"Yes"
					);
				}
			}
			
		}
		
		
		/*
		 * Vérification des liens (links) a afficher sur la liste
		 */
		
		
		$list_links=array();
		$add_link = false;
		$add_link_url="";
		$view_link_url="";
		
		foreach ($ref_table_config['links'] as $link_type => $link) {
			if(!empty($link['on_list'])){
				{
					$link['type']=$link_type;
		
		
					if(empty($link['title'])){
						$link['title']=lng_min($link['label']);
					}
		
		
					$push_link=false;
		
					switch ($link_type) {
						case 'add':
		
							$add_link=true; //will appear as a top button
		
							if(empty($link['url']))
								$add_link_url='manager/add_element/' . $ref_table;
								else
									$add_link_url=$link['url'];
		
									break;
		
						case 'view':
							if(!isset($link['icon']))
								$link['icon']='folder';
		
									
									
								if(empty($link['url']))
									$link['url']='manager/display_element/' . $ref_table.'/';
		
										
										
									$push_link=true;
		
									break;
		
						case 'edit':
		
							if(!isset($link['icon']))
								$link['icon']='pencil';
		
									
								if(empty($link['url']))
									$link['url']='manager/edit_element/' . $ref_table.'/';
		
									$push_link=true;
									break;
		
						case 'delete':
		
							if(!isset($link['icon']))
								$link['icon']='trash';
		
									
		
								if(empty($link['url']))
									$link['url']='manager/delete_element/' . $ref_table.'/';
		
									$push_link=true;
									break;
		
						case 'add_child':
		
							if(!isset($link['icon']))
								$link['icon']='plus';
		
								if(!empty($link['url'])){
		
									$link['url']='manager/add_element_child/'.$link['url']."/". $ref_table."/";
		
									$push_link=true;
								}
		
								break;
		
						default:
		
							break;
					}
		
					if($push_link)
						array_push($list_links, $link);
		
		
				}
			}
		
		}
		
	
		
		
		/*
		 * Préparation de la liste à afficher sur base du contenu et  stucture de la table
		 */
		
		/**
		 * @var array $field_list va contenir les champs à afficher
		 */
		$field_list=array();
		$field_list_header=array();
		foreach ($ref_table_config['fields'] as $k => $v) {
		
			if( $v['on_list']=='show'){
		
				array_push($field_list, $k);
				array_push($field_list_header, $v['field_title']);
		
			}
		
		}
		
		$i=1;
		$list_to_display=array();
		
		
		foreach ($data['list'] as $key => $value) {
			$element_array=array();
			
			foreach ($field_list as $key_field=> $v_field) {
				if(isset($value[$v_field])){
					if(isset($dropoboxes[$v_field][$value[$v_field]]) ){
						$element_array[$v_field]=$dropoboxes[$v_field][$value[$v_field]];
					}else{
						$element_array[$v_field]=$value[$v_field];
					}
			
			
				}else{
			
			
			
					$element_array[$v_field]="";
			
					if(isset($ref_table_config['fields'][$v_field]['number_of_values']) AND $ref_table_config['fields'][$v_field]['number_of_values']!=1){
							
						if(isset($ref_table_config['fields'][$v_field]['input_select_values']) AND isset($ref_table_config['fields'][$v_field]['input_select_key_field']))
						{
							// récuperations des valeurs de cet element
							$M_values=$this->manager_lib->get_element_multi_values($ref_table_config['fields'][$v_field]['input_select_values'],$ref_table_config['fields'][$v_field]['input_select_key_field'],$data ['list'] [$key] [$table_id]);
							$S_values="";
							foreach ($M_values as $k_m => $v_m) {
								if(isset($dropoboxes[$v_field][$v_m]) ){
									$M_values[$k_m]=$dropoboxes[$v_field][$v_m];
								}
									
								$S_values.=empty($S_values)?$M_values[$k_m]:" | ".$M_values[$k_m];
							}
			
							$element_array[$v_field]=$S_values;
						}
							
					}
						
						
						
			
				}
					
					
					
					
			}
			
			/*
			 * Ajout des liens(links) sur la liste
			 */
			
			$action_button="";
			$arr_buttons=array();
			$view_link_url="";
			
			foreach ($list_links as $key_l => $value_l) {
					
				if(!empty($value_l['icon']))
					$value_l['label']= icon($value_l['icon']).' '.lng_min($value_l['label']);
						
					array_push($arr_buttons, array(
							'url'=> $value_l['url'].$value [$table_id],
							'label'=>$value_l['label'],
							'title'=>$value_l['title']
			
					)	);
						
					if($value_l['type']=='view')
						$view_link_url=$value_l['url'].$value [$table_id];
			}
			
			$action_button=create_button_link_dropdown($arr_buttons,lng_min('Action'));
			
			$element_array['links']=$action_button;
			if(isset($element_array['class_paper_id']) AND !empty($view_link_url)){
				$element_array['class_paper_id']=anchor($view_link_url,"<u><b>".$element_array['class_paper_id']."</b></u>",'title="'.lng_min('Display element').'")');
			}
			if(isset($element_array[$table_id])){
				$element_array[$table_id]=$i + $page;
			}
			array_push($list_to_display,$element_array);
			$i++;
			
			
		}
	
		
		$data ['list']=$list_to_display;
		//print_test($data); exit;
	
		/*
		 * Ajout de l'entête de la liste
		 */
		if(!empty($data['list'])){
			$array_header=$field_list_header;;
			if(trim($data['list'][$key]['links']) !=""){
				array_push($array_header,'');
			}
			
			if(!$dynamic_table){
				array_unshift($data['list'],$array_header);
			}else{
				$data['list_header']=$array_header;
			}
			
			
			
		}
		
		
		
		/*
		 * Création des boutons qui vont s'afficher en haut de la page (top_buttons)
		 */
		
		$data ['top_buttons']="";
		
		//This feature is not used for classification
		
		//if($add_link)
		//$data ['top_buttons'] .= get_top_button ( 'add', 'Add new', 'manager/add_element/'.$ref_table );
	
		
		$data ['top_buttons'] .= get_top_button ( 'close', 'Close', 'home' );
	
	
	
		/*
		 * Titre de la page
		 */
	
		$data['page_title']=$ref_table_config['reference_title'].$sup_title;
		
		if(activate_update_stored_procedure())
		$data ['top_buttons'] .= get_top_button ( 'all', 'Update stored procedure', 'home/update_stored_procedure/'.$ref_table,'Update stored procedure','fa-check','',' btn-dark ' );
		
		
		$data ['valeur']=($val=="_")?"":$val;
		
		if(!$dynamic_table AND  !empty($ref_table_config['search_by'])){
			$data ['search_view'] = 'general/search_view';}
			
			/*
			 * La vue qui va s'afficher
			 */
			
			if(!$dynamic_table){
				$data ['nav_pre_link'] = 'manage/list_classification/' .$list_type.'/' . $val . '/';
				$data ['nav_page_position'] = 6;
				
				
				$data['page']='general/list';
			}else{
				$data['page']='general/list_dt';
			}
			/*
			 * Chargement de la vue avec les données préparés dans le controleur
			 */
			$this->load->view('body',$data);
	}
	
	
	
	public function import_papers(){
		$headder=array('Row','Field1','Field2','Field3','Field4','Field5','Field6');
			
			
		$data ['page_title'] = lng('Import papers');
		$data ['top_buttons'] = get_top_button ( 'back', 'Back', 'manage' );
		$data ['page'] = 'relis/import_papers_1';
	
	
	
		/*
		 * Chargement de la vue avec les données préparés dans le controleur suivant le type d'affichage : (popup modal ou pas)
		 */
		$this->load->view ( 'body', $data );
	}
	
	private function mres_escape($value)
	{
		$search = array("\\",  "\x00", "\n",  "\r",  "'",  '"', "\x1a");
		$replace = array("\\\\","\\0","\\n", "\\r", "\'", '\"', "\\Z");
	
		return str_replace($search, $replace, $value);
	}
	
	public function import_papers_save_csv(){
		$post_arr = $this->input->post ();
		
		$data_array=json_decode($post_arr['data_array']);
	
		$paper_title=$post_arr['paper_title'];
		$paper_link=$post_arr['paper_link'];
		$paper_abstract=$post_arr['paper_abstract'];
		$paper_key=$post_arr['paper_key'];
		$paper_author=$post_arr['paper_author'];
		$paper_start_from=$post_arr['paper_start_from'];
		$operation_code=active_user_id()."_".time();
		foreach ($data_array as $key => $value) {
			if($key >= ($paper_start_from -1 )) {
				$value['zz']="";
				$sql="INSERT INTO `paper` (`bibtexKey`, `title`, `doi`, `bibtex`, `preview`,`operation_code`) VALUES('paper_$key','".$this->mres_escape($value[$paper_title])."','".$value[$paper_link]."','<b>Authors:</b><br/>".$value[$paper_author]." <br/><b>Key words:</b><br/>".$this->mres_escape($value[$paper_key])."','".$this->mres_escape($value[$paper_abstract])."','$operation_code')";
				
				$res_sql = $this->manage_mdl->run_query($sql,False,project_db());
				
			}
				
		}
		
		// update the operation tab
		$operation_arr=array('operation_code'=>$operation_code,
				'operation_type'=>'import_paper',
				'user_id'=>active_user_id(),
				'operation_desc'=>'Paper import before screening'
				
		);
		$res2 = $this->manage_mdl->add_operation($operation_arr);
		
		
	//	print_test($res2);
		redirect('home/screening');
		
	}
	public function import_papers_load_csv(){
	
		$error_array=array();
		$success_array=array();
		$array_tab_preview=array();
		$array_tab_values=array();
		//print_test($_FILES["paper_file"]);
		if(empty($_FILES["paper_file"]['tmp_name'])){
			echo set_top_msg(lng_min("No file selected") , 'error');
			
			redirect('relis/manager/import_papers');
			
			exit;
		}
		if ($_FILES["paper_file"]["error"] > 0)
		{
			//echo "Error: " . $_FILES["file"]["error"] . "<br />";
	
			array_push($error_array,"Error: " . file_upload_error($_FILES["install_config"]["error"]));
		}
		elseif ($_FILES["paper_file"]["type"] !== "application/vnd.ms-excel")
		{
			//echo "File must be a .php";
			array_push($error_array,"File must be a csv file");
		}
		else
		{
			ini_set('auto_detect_line_endings',TRUE);
			$fp = fopen($_FILES['paper_file']['tmp_name'], 'rb');
			$i=1;
			$last_count=0;
			//	while ( (($line = utf8_encode(fgets($fp))) !== false) AND $i<5) {
			while ( (($Tline = (fgetcsv($fp,0,get_appconfig_element('csv_field_separator'),get_appconfig_element("csv_string_dellimitter")))) !== false) AND $i<11) {
				$Tline = array_map( "utf8_encode", $Tline );
	
	
				
				if($last_count < count($Tline)){
					$last_count=count($Tline);
				}
				$i++;
			}
				
				
			$array_header=array();
			$array_header_opt=array('zz'=>"No field selected");
			for ($j = 1; $j <= $last_count; $j++) {
				array_push($array_header, 'Field '.$j)	;
				array_push($array_header_opt, 'Field '.$j)	;
					
			}
				
			//print_test($array_header);
			array_push($array_tab_preview,$array_header);
			$i=1;
			rewind($fp);
			//while ( (($line = fgets($fp)) !== false)) {
			while ( (($Tline = (fgetcsv($fp,0,get_appconfig_element('csv_field_separator'),get_appconfig_element("csv_string_dellimitter")))) !== false)) {
				$Tline = array_map( "utf8_encode", $Tline );
				
				if($i<11){
					array_push($array_tab_preview,$Tline);
				}
				array_push($array_tab_values,$Tline);
	
				$i++;
			}
				
			
			$data['json_values']=json_encode($array_tab_values);
		}
	
	
	
	
	
	
			
		$csv_papers=array();
			
			
		$data['csv_papers']=$array_tab_preview;
		if(!empty($array_header)){
			$data['csv_fields']=$array_header;
			$data['csv_fields_opt']=$array_header_opt;
			
		}else{
			$data['csv_fields']=array();
			$data['csv_fields_opt']=array();
				
		}
			
	
		$data ['page_title'] = lng('Import papers - match fields');
		$data ['top_buttons'] = get_top_button ( 'back', 'Back', 'manage' );
		$data ['page'] = 'relis/import_papers_2';
	
	
	
		/*
		 * Chargement de la vue avec les données préparés dans le controleur suivant le type d'affichage : (popup modal ou pas)
		 */
		$this->load->view ( 'body', $data );
	}
	
	
	
	/*
	 * Affichage des résultat(statistique)  en cours de réaliation------
	 */
	public function result_graph(){
	
	
		
	
		/*
		 * Recupération du nombre de papiers par catégories
		 */
		$data['all_papers']=$this->DBConnection_mdl->count_papers('all');
		$data['processed_papers']=$this->DBConnection_mdl->count_papers('processed');
		$data['pending_papers']=$this->DBConnection_mdl->count_papers('pending');
		$data['assigned_me_papers']=$this->DBConnection_mdl->count_papers('assigned_me');
		$data['excluded_papers']=$this->DBConnection_mdl->count_papers('excluded');
	
	
		/*
		 * Stucture de la table des classification
		 */
		$table_config = get_table_config('classification');
	
		
	
		$result_fin=array();
	
		foreach ($table_config['fields'] as $key_conf => $value_conf) {
	
				
			if(isset($value_conf['number_of_values']) AND ($value_conf['number_of_values']=='1') AND ($value_conf['input_type'] =='select') AND ($value_conf['input_select_source'] =='table' OR $value_conf['input_select_source'] =='array'  OR $value_conf['input_select_source'] =='yes_no' )  ){
				$ref_field=$key_conf;
				if($value_conf['input_select_source'] =='array'){
					$result= $this->manage_mdl->get_result_classification($key_conf);
					foreach ($result as $key => $value) {
						$result[$key]['field_desc'] =$value['field'] ;
					}
						
				}elseif($value_conf['input_select_source'] =='yes_no'){
	
					$result= $this->manage_mdl->get_result_classification($key_conf);
	
					$yes_no=array("False",'True');
					foreach ($result as $key => $value) {
						$result[$key]['field_desc'] =$yes_no[$value['field'] ];
					}
						
				}else{
						
					$conf=explode(";", $value_conf['input_select_values']);
						
						
					$ref_config=$conf[0];
						
					$ref_table=$this->DBConnection_mdl->get_reference_corresponding_table($ref_config);
						
					$ref_table_name=$ref_table['reftab_table'];
						
					$ref_table_desc=$ref_table['reftab_desc'];
						
	
					$result= $this->manage_mdl->get_result_classification($ref_field);
						
	
					foreach ($result as $key => $value) {
							
						$result[$key]['field_desc'] = $this->manage_mdl->get_reference_value($ref_table_name,$result[$key]['field']) ;
							
							
					}
	
				}
					
				$result_fin[$ref_config.$key_conf]['name']=$value_conf['field_title'];
				$result_fin[$ref_config.$key_conf]['field_name']=$ref_field;
				$result_fin[$ref_config.$key_conf]['rows']=$result;
					
					
				
			}
	
		}
			
		
	
	 	
		/*
		 * La page contient des graphique cette valeur permettra le chargement de la librarie highcharts
		 */
		$data['has_graph']='yes';
			
			
		$data['result_table']=$result_fin;
		$data['page']='relis/result_graph';
		$this->load->view('body',$data);
		
	}
	
	
	public function result_export($type=1){
	
		$data['t_type']=$type;
			
		$data ['page_title'] = lng('Exports');
		$data ['top_buttons'] = get_top_button ( 'back', 'Back', 'home' );
		$data['left_menu_perspective']='z_left_menu_screening';
		$data['project_perspective']='screening';
		$data ['page'] = 'relis/result_export';
	
	
	
		/*
		 * Chargement de la vue avec les données préparés dans le controleur suivant le type d'affichage : (popup modal ou pas)
		 */
		$this->load->view ( 'body', $data );
	}
	
	
	
	public function result_export_papers(){
		//get classification
	
		$table_ref="papers";
		$this->db2 = $this->load->database(project_db(), TRUE);
		$sql="SELECT id,bibtexKey,title,doi,preview,bibtex FROM `paper`WHERE `paper_active` =1";
		$data=$this->db2->query ( $sql );
		//	mysqli_next_result( $this->db2->conn_id );
		$result=$data->result_array();
		//print_test($result);
	
	
		$array_header=array('#',"key",'Title','Link','Abstract','Preview');
		
		array_unshift($result, $array_header);
		
	
	
		// Create a stream opening it with read / write mode
		$stream = fopen('data://text/plain,' . "", 'w+');
	
		// Iterate over the data, writting each line to the text stream
		$f_new = fopen("cside/export_r/export_paper_".project_db().".csv", 'w+');
		foreach ($result as $val) {
			fputcsv($f_new, $val,get_appconfig_element('csv_field_separator_export'));
		}
	
		// Rewind the stream
		//rewind($stream);
	
		// You can now echo it's content
		//echo stream_get_contents($stream);
	
		// Close the stream
		fclose($f_new);
		
		set_top_msg(lng_min('File generated'));
	
		redirect('relis/manager/result_export');
	
	}
	
	
	public function result_export_classification(){
		//get classification
	
		$table_ref="classification";
		$ref_table_config=get_table_config($table_ref);
		$table_id=$ref_table_config['table_id'];
		//$this->db2 = $this->load->database(project_db(), TRUE);
		//$data=$this->db2->query ( "CALL get_list_".$table_ref."(0,0,'') " );
		//mysqli_next_result( $this->db2->conn_id );
		//$result=$data->result_array();
		//print_test($result);
		echo $table_ref;
		$data=$this->DBConnection_mdl->get_list($ref_table_config,'_',0,-1,'');
		
		print_test($data);
		//exit;
		
	
		$dropoboxes=array();
		foreach ($ref_table_config['fields'] as $k => $v) {
	
			if(!empty($v['input_type']) AND $v['input_type']=='select' AND $v['on_list']=='show'){
				if($v['input_select_source']=='array'){
					$dropoboxes[$k]=$v['input_select_values'];
				}elseif($v['input_select_source']=='table'){
					$dropoboxes[$k]= $this->manager_lib->get_reference_select_values($v['input_select_values']);
				}elseif($v['input_select_source']=='yes_no'){
					$dropoboxes[$k]=array('0'=>"No",
							'1'=>"Yes"
					);
				}
			}
			;
		}
	
	
		
		/*
		 * Préparation de la liste à afficher sur base du contenu et  stucture de la table
		 */
		
		/**
		 * @var array $field_list va contenir les champs à afficher
		 */
		$field_list=array();
		$field_list_header=array();
		foreach ($ref_table_config['fields'] as $k => $v) {
		
			if( $v['on_list']=='show'){
		
				array_push($field_list, $k);
				array_push($field_list_header, $v['field_title']);
		
			}
		
		}
		
		
		$i=1;
		$list_to_display=array();
		
		
		foreach ($data['list'] as $key => $value) {
			$element_array=array();
				
			foreach ($field_list as $key_field=> $v_field) {
				if(isset($value[$v_field])){
					if(isset($dropoboxes[$v_field][$value[$v_field]]) ){
						$element_array[$v_field]=$dropoboxes[$v_field][$value[$v_field]];
					}else{
						$element_array[$v_field]=$value[$v_field];
					}
						
						
				}else{
						
						
						
					$element_array[$v_field]="";
						
					if(isset($ref_table_config['fields'][$v_field]['number_of_values']) AND $ref_table_config['fields'][$v_field]['number_of_values']!=1){
							
						if(isset($ref_table_config['fields'][$v_field]['input_select_values']) AND isset($ref_table_config['fields'][$v_field]['input_select_key_field']))
						{
							// récuperations des valeurs de cet element
							$M_values=$this->manager_lib->get_element_multi_values($ref_table_config['fields'][$v_field]['input_select_values'],$ref_table_config['fields'][$v_field]['input_select_key_field'],$data ['list'] [$key] [$table_id]);
							$S_values="";
							foreach ($M_values as $k_m => $v_m) {
								if(isset($dropoboxes[$v_field][$v_m]) ){
									$M_values[$k_m]=$dropoboxes[$v_field][$v_m];
								}
									
								$S_values.=empty($S_values)?$M_values[$k_m]:" | ".$M_values[$k_m];
							}
								
							$element_array[$v_field]=$S_values;
						}
							
					}
		
		
		
						
				}
					
					
					
					
			}
				
				
			
			
			if(isset($element_array[$table_id])){
				$element_array[$table_id]=$i;
			}
			array_push($list_to_display,$element_array);
			$i++;
				
				
		}
		
		
		
	
		
		/*
		 * Ajout de l'entête de la liste
		 */
		if(!empty($data['list'])){
		
				array_unshift($list_to_display,$field_list_header);
					
		}
		
		// Iterate over the data, writting each line to the text stream
		$f_new = fopen("cside/export_r/export_classification_".project_db().".csv", 'w+');
		foreach ($list_to_display as $val) {
			fputcsv($f_new, $val,get_appconfig_element('csv_field_separator_export'));
		}
	
	
		fclose($f_new);
	
		set_top_msg(lng_min('File generated'));
		redirect('relis/manager/result_export');
	
	}
	
	
	
	
	public function assignment_screen($data=""){
			
		
		
		
		$papers=$this->DBConnection_mdl->get_papers('screen','papers','_',0,-1);
	//print_test($papers);
		
		
		
		$user_table_config=get_table_config('users');
		
		$users=$this->DBConnection_mdl->get_list($user_table_config,'_',0,-1);
		$_assign_user=array();
		foreach ($users['list'] as $key => $value) {
			if( (user_project($this->session->userdata('project_id') ,$value['user_id'])) ){
				
				$_assign_user[$value['user_id']]=$value['user_name'];
			}
		}
	//	print_test($users);
		$data['users']=$_assign_user;
		$data['number_papers']=$papers['nombre'];
		$data['reviews_per_paper']=2;
		
		
		
		$data ['page_title'] = lng('Assign papers for screening');
		$data ['top_buttons'] = get_top_button ( 'back', 'Back', 'manage' );
		$data['left_menu_perspective']='z_left_menu_screening';
		$data['project_perspective']='screening';
		$data ['page'] = 'relis/assign_papers_screen_auto';
	
		//print_test($data);
	
		/*
		 * Chargement de la vue avec les données préparés dans le controleur suivant le type d'affichage : (popup modal ou pas)
		 */
		$this->load->view ( 'body', $data );
	}
	
	
	
	
	function save_assignment_screen(){
		
		$post_arr = $this->input->post ();
		
		$users=array();
		$i=1;
		if(empty( $post_arr['reviews_per_paper'] )){
				
			$data['err_msg'] = lng(' Please provide  "Reviews per paper" ');
			$this->assignment_screen($data);
			
		}else{
			
			// Get selected users
			While ($i <= $post_arr['number_of_users']) {
				if(!empty( $post_arr['user_'.$i])){
					array_push($users,$post_arr['user_'.$i]);
				}
				$i++;
			}
		
			//Verify if selected users is > of required reviews per paper
			if(count($users) < $post_arr['reviews_per_paper']){
				
				$data['err_msg'] = lng('The Reviews per paper cannot exceed the number of selected users  ');
				$this->assignment_screen($data);
				
			}else{
				
				$reviews_per_paper=$post_arr['reviews_per_paper'];
				
				//Get all papers
				$papers=$this->DBConnection_mdl->get_papers('screen','papers','_',0,-1);
				
				$assign_papers= array();
				$this->db2 = $this->load->database(project_db(), TRUE);
				foreach ($papers['list'] as $key => $value) {
					
					$assign_papers[$key]['paper']=$value['id'];
					
					$assign_papers[$key]['users']=array();
					$operation_code=active_user_id()."_".time();
					$assignment_save=array(
							'paper_id'=>$value['id'],
							'user_id'=>'',
							'note'=>'',
							'assignment_type'=>'Normal',
							'operation_code'=>$operation_code,
							'assignment_mode'=>'auto',
							'assigned_by'=>$this->session->userdata ( 'user_id' )
					
					);
					$j=1;
					
					
					
					while($j<=$reviews_per_paper){
						
						
					
						$temp_user=($key % count($users)) + $j;
							
						if($temp_user >= count($users) )
							$temp_user = $temp_user - count($users);
					
							array_push($assign_papers[$key]['users'], $users[$temp_user]);
								
							$assignment_save['user_id']=$users[$temp_user];
						//	print_test($assignment_save);
							$this->db2->insert('assignment_screen',$assignment_save);
							
							
							$j++;
					}
					
					
				}
				
				$operation_arr=array('operation_code'=>$operation_code,
						'operation_type'=>'assign_papers',
						'user_id'=>active_user_id(),
						'operation_desc'=>'Assign papers for screening'
			
				);
				$res2 = $this->manage_mdl->add_operation($operation_arr);
				
				
				set_top_msg('Assignement done');
				redirect('home/screening');
			//	print_test($assign_papers);
				//echo count($assign_papers);
		}
	}
	}
	function edit_screen($screen_id,$operation_source='mine_screen'){
		$data ['content_item'] = $this->DBConnection_mdl->get_row_details('screening',$screen_id);
		$data ['operation_source'] =$operation_source;
		
		$this->screen_paper ($data );
		
	}
	function screen_paper_validation(){
		$this->screen_paper(array(),'screen_validation');
		
	}
	
	function screen_paper($data=array(),$screen_type='simple_screen'){
		$data['screen_type']=$screen_type;
		//Get all papers assigned to me;
		$exclusion_crit=$this->manager_lib->get_reference_select_values('ref_exclusioncrieria;ref_value');
		$data['exclusion_criteria']=$exclusion_crit;
		
		if(!empty($data['content_item'])){
			//edit screening: used for conflict resolution
			$data['the_paper']=$data['content_item']['paper_id'] ;
			$data['assignment_id']=$data['content_item']['assignment_id'];
			$page_title="Update screening";
			$paper_detail= $this->DBConnection_mdl->get_row_details ( 'papers',$data['content_item']['paper_id'] );
			$data['paper_title']=$paper_detail['bibtexKey']." - ".$paper_detail['title'];
			
			$data['paper_abstract']=$paper_detail['preview'];
			$data['paper_link']=$paper_detail['doi'];
			$data['operation_type']='edit';
		}else{
		
		
		$my_assignations=$this->Relis_mdl->get_user_assigned_papers(active_user_id(),$screen_type);
	//	print_test($my_assignations);
		$paper_to_screen=0;
		$assignment_id=0;
		$total_papers=count($my_assignations);
		
		
		
		if($total_papers<1){
			$page_title=($screen_type=='screen_validation')?"No papers assigned to you for validation":"No papers assigned to you for screening";
			
		}else{
			$papers_screened=0;
			foreach ($my_assignations as $key => $value) {
					
				if($value['screening_done']==1){
					$papers_screened++;
				}else{
					if(empty($paper_to_screen)){
						$paper_to_screen=$value['paper_id'];
						$assignment_id=$value['assignment_id'];
						$assignment_note=$value['note'];
					}
				}
			}
			
			if(empty($paper_to_screen)){//all papers have been screened
				$page_title=($screen_type=='screen_validation')?"Validation - All papers have been screened":"All papers have been screened";
				
			//	$page_title="All papers have been screened";
				
			}else{
				$page_title=($screen_type=='screen_validation')?"Screening validation":"Screening";
					
				//$page_title="Screening";
				
				$paper_detail= $this->DBConnection_mdl->get_row_details ( 'papers',$paper_to_screen );
				
				$data['the_paper']=$paper_to_screen;
				$data['assignment_id']=$assignment_id;
				$data['assignment_note']=!empty($assignment_note)?$assignment_note:"";
				
				$data['paper_title']=$paper_detail['bibtexKey']." - ".$paper_detail['title'];
				
				$data['paper_abstract']=$paper_detail['preview'];
				$data['paper_link']=$paper_detail['doi'];
				
				$data['operation_type']='new';

				
					
					
		}
			
			$data['screen_completion']=(int)($papers_screened *100 / $total_papers);
			$data['paper_screened']=$papers_screened;
			$data['all_papers']= $total_papers;
			
			
			
			
		}
		
		}

		//print_test($data);
			$this->session->set_userdata('working_perspective','screen');
			$data ['page_title'] = lng($page_title);	
			$data ['top_buttons'] = get_top_button ( 'back', 'Back', 'h_screening' );
			
			$data ['page'] = 'relis/screen_paper';
		
			
			/*
			 * Chargement de la vue avec les données préparés dans le controleur suivant le type d'affichage : (popup modal ou pas)
			 */
			$this->load->view ( 'body', $data );
		
		
	}
	
	public function save_screening(){
		
		$post_arr = $this->input->post ();
		
		//print_test($post_arr);
		
		//exit;
		
		if(empty($post_arr['criteria_ex']) AND $post_arr['decision'] == 'excluded'){
			set_top_msg('Please choose the exclusion criteria',"error");
			if(!empty($post_arr['screening_id'])){
				redirect('relis/manager/edit_screen/'.$post_arr['screening_id'].'/'.$post_arr['operation_source']);
				exit;
			}
			
		}else{ 
			
			if(!empty($post_arr['screen_type']) AND $post_arr['screen_type']=='screen_validation'){
				$screening_table='screening_validate';
				$assignment_table='assignment_screen_validate';
				
			}else{
				$screening_table='screening';
				$assignment_table='assignment_screen';
			}
		
		$this->db2 = $this->load->database(project_db(), TRUE);
		
		$exclusion_criteria=($post_arr['decision'] == 'excluded')?$post_arr['criteria_ex']:NULL;
		$screening_save=array(
				'paper_id'=>$post_arr['paper_id'],
				'user_id'=>active_user_id(),
				'note'=>$post_arr['note'],
				'decision'=>$post_arr['decision'],
				'exclusion_criteria'=>$exclusion_criteria,
				'assignment_id'=>$post_arr['assignment_id']				
		);
		
		//print_test($post_arr);
	//	exit;
		
		if(!empty($post_arr['operation_type']) AND $post_arr['operation_type']=='edit'){
			
			$this->db2->update('screening',$screening_save,array('screening_id'=>$post_arr['screening_id']));
		}else{
			$this->db2->insert($screening_table,$screening_save);
			
			$this->db2->update($assignment_table,array('screening_done'=>'1'),array('	assignment_id'=>$post_arr['assignment_id']));
		}
		//update the paper_status
		update_paper_status_status($post_arr['paper_id']);
		
		/*
		$paper_status=get_paper_screen_status($post_arr['paper_id']);
		
		
			if($paper_status=='Included'){
				$this->db2->update('paper',array('screening_status'=>$paper_status,'classification_status'=>'To classify'),array('id'=>$post_arr['paper_id']));
			}else{
					
				$this->db2->update('paper',array('screening_status'=>$paper_status,'classification_status'=>'Waiting'),array('id'=>$post_arr['paper_id']));
			}*/
		}
		
		//print_test($post_arr);
		//exit;
		if(!(empty($post_arr['operation_type'])) AND $post_arr['operation_type']=='edit'){
			set_top_msg('Element updated');
			if($post_arr['operation_source']=='display_paper_screen'){
				redirect('relis/manager/display_paper_screen/'.$post_arr['paper_id']);
			}else{
			redirect('relis/manager/list_screen/mine_screen');
			}
		}else{
			set_top_msg('Element saved');
			if(!empty($post_arr['screen_type']) AND $post_arr['screen_type']=='screen_validation'){
				redirect('relis/manager/screen_paper_validation');
			}else{	
				redirect('relis/manager/screen_paper');
			}
		}
	}
	
	public function  remove_screening($screen_id){
		
		$this->db2 = $this->load->database(project_db(), TRUE);
		$config="screening";
		
		$screen_detail= $this->DBConnection_mdl->get_row_details ( $config,$screen_id );

		$this->db2->update('screening',array('screening_active'=>0),array('	screening_id'=>$screen_id));

		$this->db2->update('assignment_screen',array('screening_done'=>0),array('assignment_id'=>$screen_detail['assignment_id']));
		
		
		update_paper_status_status($screen_detail['paper_id']);
		
		redirect('relis/manager/list_screen/mine_screen');
	}
	
	
	public function  remove_screening_validation($screen_id){
		
		$this->db2 = $this->load->database(project_db(), TRUE);
		$config="screening_validate";
		
		$screen_detail= $this->DBConnection_mdl->get_row_details ( $config,$screen_id );

		$this->db2->update('screening_validate',array('screening_active'=>0),array('	screening_id'=>$screen_id));

		$this->db2->update('assignment_screen_validate',array('screening_done'=>0),array('assignment_id'=>$screen_detail['assignment_id']));
		
		
		
		
		redirect('relis/manager/list_screen/screen_validation');
	}
	
	/*
	 * Fonction globale pour afficher la liste des élément suivant la structure de la table
	 *
	 * Input: $ref_table: nom de la configuration d'une page (ex papers, author)
	 * 			$val : valeur de recherche si une recherche a été faite sur la table en cours
	 * 			$page: la page affiché : ulilisé dans la navigation
	 */
	public function list_screen($list_cat='mine_screen',$val = "_", $page = 0 ,$dynamic_table=1){
	
	
		
		$ref_table="screening";
		$papers_list=False;
		
		if($list_cat=='assign_validation' ){
			
			$ref_table="assignment_screen_validate";
			
		}elseif($list_cat=='screen_validation' ){
			
			$ref_table="screening_validate";
		}elseif($list_cat=='mine_screen' OR $list_cat=='all_screen' ){
			
			$ref_table="screening";
		}elseif($list_cat=='mine_assign' OR $list_cat=='all_assign' ){
			
			$ref_table="assignment_screen";
		}elseif($list_cat=='screen_paper' OR $list_cat=='screen_paper_pending' OR $list_cat=='screen_paper_review' OR $list_cat=='screen_paper_included' OR $list_cat=='screen_paper_excluded' OR $list_cat=='screen_paper_conflict' ){
			
			$papers_list=True;
			$ref_table="papers";
		}
		/*
		 * Vérification si il y a une condition de recherche
		 */
		$val = urldecode ( urldecode ( $val ) );
		$filter = array ();
		if (isset ( $_POST ['search_all'] )) {
			$filter = $this->input->post ();
	
			unset ( $filter ['search_all'] );
	
			$val = "_";
			if (isset ( $filter ['valeur'] ) and ! empty ( $filter ['valeur'] )) {
				$val = $filter ['valeur'];
				$val = urlencode ( urlencode ( $val ) );
			}
	
			/*
			 * mis à jours de l'url en ajoutant la valeur recherché dans le lien puis rechargement de l'url
			 */
			$url = "relis/manager/list_screen/$list_cat"."/". $val ."/0/". $dynamic_table;
	
			redirect ( $url );
		}
	
		/*
		 * Récupération de la configuration(structure) de la table à afficher
		 */
		$ref_table_config=get_table_config($ref_table);
	
	
		$table_id=$ref_table_config['table_id'];
	
	
	
	
		/*
		 * Appel du model pour récupérer la liste à aficher dans la Base de donnés
		 */
		$rec_per_page=($dynamic_table)?-1:0;
		$extra_condition="";
		
		if($list_cat=='mine_screen' OR $list_cat=='mine_assign' ){
		$extra_condition =" AND ( user_id ='".active_user_id()."') ";
		}
		
		
		if($list_cat=='screen_paper'){
			$data=$this->DBConnection_mdl->get_papers('screen',$ref_table_config,$val,$page,$rec_per_page);
			$page_title="All papers";
		}elseif($list_cat=='screen_paper_pending'){
			//$data=$this->DBConnection_mdl->get_papers('screen',$ref_table_config,$val,$page,$rec_per_page);
			$extra_condition =" AND ( screening_status ='Pending') ";
			$data=$this->manage_mdl->get_list($ref_table_config,$val,$page,$rec_per_page,$extra_condition);
			$page_title="Pending papers";
		}elseif($list_cat=='screen_paper_review'){
			//$data=$this->DBConnection_mdl->get_papers('screen',$ref_table_config,$val,$page,$rec_per_page);
			$extra_condition =" AND ( screening_status ='In review') ";
			$data=$this->manage_mdl->get_list($ref_table_config,$val,$page,$rec_per_page,$extra_condition);
			$page_title="Papers in review";
		}elseif($list_cat=='screen_paper_included'){
			//$data=$this->DBConnection_mdl->get_papers('screen',$ref_table_config,$val,$page,$rec_per_page);
			$extra_condition =" AND ( screening_status ='Included') ";
			$data=$this->manage_mdl->get_list($ref_table_config,$val,$page,$rec_per_page,$extra_condition);
			$page_title="Papers included";
		}elseif($list_cat=='screen_paper_excluded'){
			$extra_condition =" AND ( screening_status ='Excluded') ";
			$data=$this->manage_mdl->get_list($ref_table_config,$val,$page,$rec_per_page,$extra_condition);
			$page_title="Papers excluded";
		}elseif($list_cat=='screen_paper_conflict'){
			$extra_condition =" AND ( screening_status ='In conflict') ";
			$data=$this->manage_mdl->get_list($ref_table_config,$val,$page,$rec_per_page,$extra_condition);
			$page_title="Papers in conflict";
		}elseif(!empty($extra_condition)){ //pour le string_management une fonction spéciale
			//todo verifier comment le spécifier dans config
			$data=$this->manage_mdl->get_list($ref_table_config,$val,$page,$rec_per_page,$extra_condition);
			
		}else{
				
			$data=$this->DBConnection_mdl->get_list($ref_table_config,$val,$page,$rec_per_page);
		}
	
		//print_test($data);
	
		/*
		 * récupération des correspondances des clés externes pour l'affichage  suivant la structure de la table
		 */
	
	
	
		$dropoboxes=array();
		foreach ($ref_table_config['fields'] as $k => $v) {
	
			if(!empty($v['input_type']) AND $v['input_type']=='select' AND $v['on_list']=='show'){
	
	
				if($v['input_select_source']=='array'){
					$dropoboxes[$k]=$v['input_select_values'];
				}elseif($v['input_select_source']=='table'){
					//print_test($v);
					$dropoboxes[$k]= $this->manager_lib->get_reference_select_values($v['input_select_values']);
						
				}elseif($v['input_select_source']=='yes_no'){
					$dropoboxes[$k]=array('0'=>"No",
							'1'=>"Yes"
					);
				}
			}
				
		}
	
	
	
		/*
		 * Vérification des liens (links) a afficher sur la liste
		 */
	
	
		$list_links=array();
		$add_link = false;
		$add_link_url="";
		foreach ($ref_table_config['links'] as $link_type => $link) {
			if(!empty($link['on_list'])){
				{
					$link['type']=$link_type;
	
	
					if(empty($link['title'])){
						$link['title']=lng_min($link['label']);
					}
	
						
					$push_link=false;
						
					switch ($link_type) {
						case 'add':
								
							$add_link=true; //will appear as a top button
								
							if(empty($link['url']))
								$add_link_url='manager/add_element/' . $ref_table;
								else
									$add_link_url=$link['url'];
										
									break;
	
						case 'view':
							if(!isset($link['icon']))
								$link['icon']='folder';
	
									
									
								if(empty($link['url']))
									$link['url']='manager/display_element/' . $ref_table.'/';
									
									$push_link=true;
									if($papers_list){
										$link['url']='relis/manager/display_paper_screen/';
									}
									
	
									break;
	
						case 'edit':
								
							if(!isset($link['icon']))
								$link['icon']='pencil';
	
									
								if(empty($link['url']))
									$link['url']='manager/edit_element/' . $ref_table.'/';
									
								if($list_cat=='mine_assign'){
									$link['url']='relis/manager/edit_assignment_mine/';
								}elseif($list_cat=='all_assign'){
									$link['url']='relis/manager/edit_assignment_all/';
								}	
									$push_link=true;
									
									if($papers_list)//do not put the link on list papers
										$push_link=false;
									break;
	
						case 'delete':
								
							if(!isset($link['icon']))
								$link['icon']='trash';
	
									
	
								if(empty($link['url']))
									$link['url']='manager/delete_element/' . $ref_table.'/';
	
									$push_link=true;
									
									if($papers_list)//do not put the link on list papers
										$push_link=false;
									break;
	
						case 'add_child':
								
							if(!isset($link['icon']))
								$link['icon']='plus';
	
								if(!empty($link['url'])){
	
									$link['url']='manager/add_element_child/'.$link['url']."/". $ref_table."/";
	
									$push_link=true;
								}
	
								break;
	
						default:
								
							break;
					}
						
					if($push_link)
						array_push($list_links, $link);
	
	
				}
			}
	
		}
	
	
	
	
		/*
		 * Préparation de la liste à afficher sur base du contenu et  stucture de la table
		 */
	
		/**
		 * @var array $field_list va contenir les champs à afficher
		 */
		$field_list=array();
		$field_list_header=array();
		foreach ($ref_table_config['fields'] as $k => $v) {
	
			if( $v['on_list']=='show'){
	
				array_push($field_list, $k);
				array_push($field_list_header, $v['field_title']);
	
			}
	
		}
		//print_test($field_list);
		$i=1;
		$list_to_display=array();
		
		foreach ($data['list'] as $key => $value) {
				
			$element_array=array();
			foreach ($field_list as $key_field=> $v_field) {
				if(isset($value[$v_field])){
					if(isset($dropoboxes[$v_field][$value[$v_field]]) ){
						$element_array[$v_field]=$dropoboxes[$v_field][$value[$v_field]];
					}else{
						$element_array[$v_field]=$value[$v_field];
					}
						
						
				}else{
						
						
						
					$element_array[$v_field]="";
						
					if(isset($ref_table_config['fields'][$v_field]['number_of_values']) AND $ref_table_config['fields'][$v_field]['number_of_values']!=1){
							
						if(isset($ref_table_config['fields'][$v_field]['input_select_values']) AND isset($ref_table_config['fields'][$v_field]['input_select_key_field']))
						{
							// récuperations des valeurs de cet element
							$M_values=$this->manager_lib->get_element_multi_values($ref_table_config['fields'][$v_field]['input_select_values'],$ref_table_config['fields'][$v_field]['input_select_key_field'],$data ['list'] [$key] [$table_id]);
							$S_values="";
							foreach ($M_values as $k_m => $v_m) {
								if(isset($dropoboxes[$v_field][$v_m]) ){
									$M_values[$k_m]=$dropoboxes[$v_field][$v_m];
								}
	
								$S_values.=empty($S_values)?$M_values[$k_m]:" | ".$M_values[$k_m];
							}
								
							$element_array[$v_field]=$S_values;
						}
	
					}
	
	
	
						
				}
	
					
	
	
			}
				
			/*
			 * Ajout des liens(links) sur la liste
			 */
				
			$action_button="";
	
			$arr_buttons=array();
			foreach ($list_links as $key_l => $value_l) {
	
				if(!empty($value_l['icon']))
					$value_l['label']= icon($value_l['icon']).' '.lng_min($value_l['label']);
	
					array_push($arr_buttons, array(
							'url'=> $value_l['url'].$value [$table_id],
							'label'=>$value_l['label'],
							'title'=>$value_l['title']
								
					)	);
			}
			
			
			if($list_cat=='screen_paper' OR $list_cat=='screen_paper_pending' OR $list_cat=='screen_paper_review' OR $list_cat=='screen_paper_included' OR $list_cat=='screen_paper_excluded' OR $list_cat=='screen_paper_conflict' ){
				$screening_res=get_paper_screen_result($element_array[$table_id]);
			//	print_test($screening_res);
				$element_array['reviews']=$screening_res['reviewers'];
				$element_array['decision']=$screening_res['screening_result'];
			}
	
				
			$action_button=create_button_link_dropdown($arr_buttons,lng_min('Action'));
	
	
			if(!empty($action_button))
				$element_array['links']=$action_button;
					
				if(isset($element_array[$table_id])){
					$element_array[$table_id]=$i + $page;
				}
					
	
					
				array_push($list_to_display,$element_array);
					
				$i++;
		}
	
	
		$data ['list']=$list_to_display;
	
	
		/*
		 * Ajout de l'entête de la liste
		 */
		if(!empty($data['list'])){
			//$array_header=$ref_table_config['header_list_fields'];
			$array_header=$field_list_header;
			if($list_cat=='screen_paper' OR $list_cat=='screen_paper_pending' OR $list_cat=='screen_paper_review' OR $list_cat=='screen_paper_included' OR $list_cat=='screen_paper_excluded' OR $list_cat=='screen_paper_conflict' ){
				array_push($array_header,'Reviewers');
				array_push($array_header,'Decision');
			}
			if(!empty($data['list'][$key]['links'])) {
				array_push($array_header,'');
			}
				
				
			if(!$dynamic_table){
				array_unshift($data['list'],$array_header);
			}else{
				$data['list_header']=$array_header;
			}
		}
	
	
	
		/*
		 * Création des boutons qui vont s'afficher en haut de la page (top_buttons)
		 */
	
		$data ['top_buttons']="";
		if($ref_table=="str_mng"){  //todo à corriger
			if($this->session->userdata('language_edit_mode')=='yes'){
				$data ['top_buttons'] .= get_top_button ( 'all', 'Close edition mode', 'config/update_edition_mode/no','Close edition mode','fa-ban','',' btn-warning ' );
			}else{
				$data ['top_buttons'] .= get_top_button ( 'all', 'Open edition mode', 'config/update_edition_mode/yes','Open edition mode','fa-check','',' btn-dark ' );
			}
		}else{
			if($add_link)
				$data ['top_buttons'] .= get_top_button ( 'add', 'Add new', $add_link_url);
		}
	
	
		if(activate_update_stored_procedure())
			$data ['top_buttons'] .= get_top_button ( 'all', 'Update stored procedure', 'home/update_stored_procedure/'.$ref_table,'Update stored procedure','fa-check','',' btn-dark ' );
	
			$data ['top_buttons'] .= get_top_button ( 'close', 'Close', 'home' );
	
	
			/*
			 * Titre de la page
			 */
			
			
			if(isset($ref_table_config['entity_title']['list'])){
				$data['page_title']=lng($ref_table_config['entity_title']['list']);
			}else{
				$data ['page_title'] = lng("List of ".$ref_table_config['reference_title']);
			}
	
			if($list_cat=='mine_screen' ){
				
				$data ['page_title']="My screenings";
				
			}elseif( $list_cat=='mine_assign' )
			{
				$data ['page_title']="Papers assigned to me for screening";
				
			}
			
			if(!empty($page_title))
				$data ['page_title']=$page_title;
			
			/*
			 * Configuration pour l'affichage des lien de navigation
			 */
	
			$data ['valeur']=($val=="_")?"":$val;
	
	
			/*
			 * Si on a besoin de faire urecherche sur la liste specifier la vue où se trouve le formulaire de recherche
			 */
			if(!$dynamic_table AND !empty($ref_table_config['search_by'])){
				$data ['search_view'] = 'general/search_view';
			}
	
	
			/*
			 * La vue qui va s'afficher
			 */
	
			if(!$dynamic_table){
				$data ['nav_pre_link'] = 'relis/manager/list_screen/' .$list_cat.'/' . $val . '/';
				$data ['nav_page_position'] = 6;
					
				$data['page']='general/list';
			}else{
				$data['page']='general/list_dt';
			}
	
			if(admin_config($ref_table))
				$data['left_menu_admin']=True;
				/*
				 * Chargement de la vue avec les données préparés dans le controleur
				 */
				$this->load->view('body',$data);
	}
	
	
	public function screen_completion($type='screening'){
	
		if($type=='validate'){
			$assignments=$this->Relis_mdl->get_user_assigned_papers(0,'screen_validation');
		}else{
			$assignments=$this->Relis_mdl->get_user_assigned_papers(0);
		}
		
		
		//print_test($assignments);
		
		$assignment_id=0;
		$total_papers=count($assignments);
		$papers_screened=0;
		
		$assign_per_user=array();
			
		foreach ($assignments as $key => $value) {
			
			if (! isset($assign_per_user[$value['user_id']])){
				$assign_per_user[$value['user_id']]['total_papers'] = 1;
				
				if($value['screening_done']==1){
					$assign_per_user[$value['user_id']]['papers_screened']=1;
					$papers_screened ++;
				}else{
					$assign_per_user[$value['user_id']]['papers_screened']=0;
				}				
				
			}else{
				$assign_per_user[$value['user_id']]['total_papers']++;
				
				if($value['screening_done']==1){
					$assign_per_user[$value['user_id']]['papers_screened']++;
					$papers_screened ++;
				}
				
			}
			
		
			
		}
		
		$users=$this->manager_lib->get_reference_select_values('users;user_name');
			
		//	print_test($users);
		//	print_test($assign_per_user);
		foreach ($assign_per_user as $key_a => $value_a) {
				$assign_per_user[$key_a]['completion']=(int)($value_a['papers_screened'] *100 / $value_a['total_papers'] );
				$assign_per_user[$key_a]['user']=$users[$key_a];
		}
		
		$assign_per_user['total']=array(
				'total_papers'=>$total_papers,
				'papers_screened'=>$papers_screened,
				'completion'=>!empty($total_papers)?(int)($papers_screened *100 / $total_papers ):0,
				'user'=>'<b>Total</b>',
		);
	//	print_test($assign_per_user);
		
		
		$data['completion_screen']=$assign_per_user;
		
		
		
		
		
		
		
		
		
		$data ['page_title']=($type=='validate')?lng('Screening validation progress'):lng('Screening Progress');
	
		$data ['top_buttons'] = get_top_button ( 'back', 'Back', 'manage' );
		$data['left_menu_perspective']='left_menu_screening';
		$data['project_perspective']='screening';
		$data ['page'] = 'relis/screen_completion';
	
	
	
		/*
		 * Chargement de la vue avec les données préparés dans le controleur suivant le type d'affichage : (popup modal ou pas)
		 */
		$this->load->view ( 'body', $data );
	}
	
	
	
	/*
	 * Fonction spécialisé  pour l'affichage d'un papier
	 * Input:	$ref_id: id du papier
	 */
	public function display_paper_screen($ref_id) {
	
	
		//	print_test(get_paper_screen_result($ref_id));
	
		$ref_table="papers";
	
		/*
		 * Récupération de la configuration(structure) de la table des papiers
		 */
		$table_config=get_table_config($ref_table);
	
	
		/*
		 * Appel de la fonction  récupérer les informations sur le papier afficher
		 */
		$paper_data=$this->manager_lib->get_element_detail('papers',$ref_id);
	
	
		
	
		/*
		 * Préparations des informations à afficher
		 */
	
		//venue
		$venue="";
		foreach ($paper_data as $key => $value) {
			if($value['title']=='Venue' AND !empty($value['val2'][0])){
				$venue=$value['val2'][0];
			}
		}
	
		//Authors
		$authors="";
		foreach ($paper_data as $key => $value) {
	
			if($value['title']=='Author' AND !empty($value['val2'])){
	
				if(count($value['val2']>1)){
					$authors='<table class="table table-hover" ><tr><td> '.$value['val2'][0].'</td></tr>';
					foreach ($value['val2'] as $k => $v) {
						if($k>0){
							$authors.="<tr><td> ".$v.'</td></tr>';
						}
					}
	
					$authors.="</table>";
				}else{
	
					$authors=" : ".$value['val2'][0];
				}
	
			}
		}
	
	
	
	
	
	
		$content_item = $this->DBConnection_mdl->get_row_details ( $ref_table,$ref_id );
	
		$paper_name=$content_item['bibtexKey']." - ".$content_item['title'];
		$paper_excluded=False;
		if($content_item['paper_excluded']=='1'){
			$paper_excluded=True;
		}
	
		$data['paper_excluded']=$paper_excluded;
		$item_data=array();
	
	
		$array['title']=$content_item['bibtexKey']." - ".$content_item['title'];
	
		if(!empty($content_item['doi'])){
	
			$array['title'].='<ul class="nav navbar-right panel_toolbox">
				<li>
					<a title="Go to the page" href="'.$content_item['doi'].'" target="_blank" >
				 		<img src="'.base_url().'cside/images/pdf.jpg"/>
	
					</a>
				</li>
	
				</ul>';
		}
			
	
		array_push($item_data, $array);
	
		$array['title']="<b>".lng('Abstract')." :</b> <br/><br/>".$content_item['preview'];
		array_push($item_data, $array);
		$array['title']="<b>".lng('Preview')." :</b> <br/><br/>".$content_item['bibtex'];
		array_push($item_data, $array);
	
		$array['title']="<b>".lng('Venue')." </b> ".$venue;
		//array_push($item_data, $array);
	
		$array['title']="<b>".lng('Authors')." </b> ".$authors;
		//array_push($item_data, $array);
	
			
	
		$data['item_data']=$item_data;
	
	
	
	
		$res_screen=get_paper_screen_result($ref_id);
		//print_test($res_screen);
		
		if(trim($res_screen['screening_result'])=='In conflict'){
			$my_paper=FALSE;
			foreach ($res_screen['screenings'] as $key => $value) {
				if(has_usergroup(1) OR is_project_creator(active_user_id() , project_db()) OR $value['user_id']==active_user_id()){
				
						$res_screen['screenings'][$key]['edit_link']=create_button_link('relis/manager/edit_screen/'.$value['screening_id'].'/display_paper_screen','Edit',"btn-info","Update decision") ;
					}else{
						
						$res_screen['screenings'][$key]['edit_link']="";
					}
			}
			$data['screen_edit_link']=TRUE;
			
			}
			
			if(has_usergroup(1) OR is_project_creator(active_user_id() , project_db()) )
			$data ['assign_new_button'] =get_top_button ( 'add', 'Add a reviewer', 'manager/new_assignment_screen/'.$ref_id, 'Add a reviewer')." ";
	
		$data['screenings']=$res_screen['screenings'];
		$data['screening_result']=$res_screen['screening_result'];
		

		
		
		
//print_test($data);
		/*
		 * Information sur la classification du papier si le papiers est déjà classé
		 */
	
		//$classification = $this->DBConnection_mdl->get_classifications ($ref_id );
	/*
	
		if(!empty($classification)){
	
			$classification_data=$this->manager_lib->get_element_detail('classification', $classification[0]['class_id'],False,True);
				
			//print_test(get_table_config('classification'));
				
			$data['classification_data']=$classification_data;
	
			$delete_button= get_top_button ( 'delete', 'Remove the classification', 'relis/manager/remove_classification/'.$classification[0]['class_id']."/".$ref_id , 'Remove the classification')." ";
	
			$edit_button= get_top_button ( 'edit', 'Edit the classification', 'relis/manager/edit_classification/'.$classification[0]['class_id'], 'Edit the classification')." ";
	
			$data['classification_button']=$edit_button." ".$delete_button;
		}else{
			if(!empty(	$table_config['links']['add_child']['url']) AND !empty($table_config['links']['add_child']['on_view'])  AND ($table_config['links']['add_child']['on_view']== True) ){
					
				$data ['classification_button'] =get_top_button ( 'add', 'Add classification', 'relis/manager/new_classification/'.$ref_id, 'Add classification')." ";;
					
			}
		}
	
	
	
	
	*/
	
	
	
		/*
		 * Création des boutons qui vont s'afficher en haut de la page (top_buttons)
		 */
		$data ['top_buttons']="";
		if(!empty(	$table_config['links']['edit']) AND !empty($table_config['links']['edit']['on_view'])  AND ($table_config['links']['edit']['on_view']== True) ){
	
				$data ['top_buttons'] .= get_top_button ( 'edit', $table_config['links']['edit']['title'], 'manager/edit_element/' . $ref_table.'/'.$ref_id )." ";
	
			}
	
			if(!empty(	$table_config['links']['delete']) AND !empty($table_config['links']['delete']['on_view'])  AND ($table_config['links']['delete']['on_view']== True) ){
	
				$data ['top_buttons'] .= get_top_button ( 'delete', $table_config['links']['delete']['title'], 'manage/delete_element/' . $ref_table.'/'.$ref_id )." ";
	
			}
	
	
	
	
		$data ['top_buttons'] .= get_top_button ( 'back', 'Back', 'home' );
	
	
	
		/*
		 * Titre de la page
		 */
		$data ['page_title'] = lng($table_config['reference_title_min']);
	
	
		/*
		 * La vue qui va s'afficher
		 */
		$data ['page'] = 'relis/display_paper_screen';
	
	
		/*
		 * Chargement de la vue avec les données préparés dans le controleur suivant le type d'affichage : (popup modal ou pas)
		 */
		$this->load->view ( 'body', $data );
	}
	
	
	
	
	public function edit_assignment_mine($assignment_id){
		
		$this->session->set_userdata('after_save_redirect',"relis/manager/list_screen/mine_assign");
		
		redirect("manager/edit_element/assignment_screen/$assignment_id");
	}
	
	public function edit_assignment_all($assignment_id){
	
		$this->session->set_userdata('after_save_redirect',"relis/manager/list_screen/all_assign");
	
		redirect("manager/edit_element/assignment_screen/$assignment_id");
	}
	
	
	public function screen_result($type=1){
		$users=$this->manager_lib->get_reference_select_values('users;user_name');
		$exclusion_crit=$this->manager_lib->get_reference_select_values('ref_exclusioncrieria;ref_value');
		
		$papers=$this->DBConnection_mdl->get_papers('screen',get_table_config('papers'),"_",0,-1);
		
		//print_test($users); exit;
		$result=array();
		$result['total']=0;
		foreach ($papers['list'] as $key => $value) {
			if(!empty($value['screening_status'])){
				if(empty($result[$value['screening_status']])){
					$result[$value['screening_status']]=1;
				}else{
					$result[$value['screening_status']]=$result[$value['screening_status']]+1;
				}
				
				$result['total']++;
		}
		}
		
		//  list to be displayed for global result
		$data['screening_result']=array(
				'0'=>array(
						'title'=>'Decision',
						'nbr'=>'Papers',
						'pourc'=>'%',
				),
				'Included'=>array(
						'title'=>'Included',
						'nbr'=>!empty($result['Included'])?$result['Included']:0,
						'pourc'=>!empty($result['Included'])?round(($result['Included']*100 / $result['total']),2):0,
				),
				'Excluded'=>array(
						'title'=>'Excluded',
						'nbr'=>!empty($result['Excluded'])?$result['Excluded']:0,
						'pourc'=>!empty($result['Excluded'])?round(($result['Excluded']*100 / $result['total']),2):0,
				),
				'conflict'=>array(
						'title'=>'In conflict',
						'nbr'=>!empty($result['In conflict'])?$result['In conflict']:0,
						'pourc'=>!empty($result['In conflict'])?round(($result['In conflict']*100 / $result['total']),2):0,
				),
				'review'=>array(
						'title'=>'In review',
						'nbr'=>!empty($result['In review'])?$result['In review']:0,
						'pourc'=>!empty($result['In review'])?round(($result['In review']*100 / $result['total']),2):0,
				),
				'pending'=>array(
						'title'=>'Pending',
						'nbr'=>!empty($result['Pending'])?$result['Pending']:0,
						'pourc'=>!empty($result['Pending'])?round(($result['Pending']*100 / $result['total']),2):0,
				),
				'total'=>array(
						'title'=>'<b>Total</b>',
						'nbr'=>"<b>".(!empty($result['total'])?$result['total']:0)."</b>",
						'pourc'=>'',
				)
		);
		
		//print_test($data['screening_result']);
		$screenings=$this->DBConnection_mdl->get_list(get_table_config('screening'),'_',0,-1);
		
		$res_screening['total']=0;
		$res_screening['users']=array();
		$res_screening['criteria']=array();
		$res_screening['all_criteria']=0;
		$key=0;
		//	print_test($screenings);
		foreach ($screenings['list'] as $key => $value) {
			
			$res_screening['total']++;
			if(empty($res_screening['users'][$value['user_id']][$value['decision']])){
			//	echo "<p>bbb</p>";
				$res_screening['users'][$value['user_id']][$value['decision']]=1;
			}else{
			//	echo "<p>cccc</p>";
				$res_screening['users'][$value['user_id']][$value['decision']] = $res_screening['users'][$value['user_id']][$value['decision']]+1;
			}
			
			
			// exclusion critéria
			if($value['decision']=='excluded' AND !empty($value['exclusion_criteria'])){
				if(empty($res_screening['criteria'][$value['exclusion_criteria']])){
					//	echo "<p>bbb</p>";
					$res_screening['criteria'][$value['exclusion_criteria']]=1;
				}else{
					//	echo "<p>cccc</p>";
					$res_screening['criteria'][$value['exclusion_criteria']] = $res_screening['criteria'][$value['exclusion_criteria']]+1;
				}
				
				$res_screening['all_criteria']++;
				//critérias per user
				if(empty($res_screening['users'][$value['user_id']]['criteria'][$value['exclusion_criteria']])){
					//	echo "<p>bbb</p>";
					$res_screening['users'][$value['user_id']]['criteria'][$value['exclusion_criteria']]=1;
				}else{
					//	echo "<p>cccc</p>";
					$res_screening['users'][$value['user_id']]['criteria'][$value['exclusion_criteria']] = $res_screening['users'][$value['user_id']]['criteria'][$value['exclusion_criteria']]+1;
				}
				
			}
			
		}
	
		//  list to be displayed for  result per user
 		$result_per_user=array();
 		
 		if(!empty ($res_screening['users'] ));
 		{
 			$result_per_user[0]=array(
 					'user'=>'User ',
 					'accepted'=>'Accepted',
 					'excluded'=>'Excluded'
 			);
 			$i=1;
		foreach ($res_screening['users'] as $key => $value) {
			$result_per_user[$i]=array(
						'user'=>!empty($users[$key])?$users[$key]:'User '.$key,
						'accepted'=>!empty($value['accepted'])?$value['accepted']:0,
						'excluded'=>!empty($value['excluded'])?$value['excluded']:0,
						);
			$i++;
		}
		
 		}
		
		
		$data['result_per_user']=$result_per_user;
		
		$result_per_criteria=array();
		
		if(!empty ($res_screening['criteria'] ));
		{
			$result_per_criteria[0]=array(
					'criteria'=>'Criteria ',
					'Nbr'=>'Nbr',
					'pourc'=>'%'
			);
			$i=1;
			foreach ($res_screening['criteria'] as $key => $value) {
				$result_per_criteria[$i]=array(
						'criteria'=>!empty($exclusion_crit[$key])?$exclusion_crit[$key]:'Criteria '.$key,
						'Nbr'=>$value,
						'pourc'=>!empty($res_screening['all_criteria'])?round(($value*100/$res_screening['all_criteria']),2):0,
				);
				$i++;
			}
		
		}
		
		$data['result_per_criteria']=$result_per_criteria;
	
		
		$data ['page_title'] = lng('Screening Results');
		$data ['top_buttons'] = get_top_button ( 'back', 'Back', 'manage' );
		$data['left_menu_perspective']='left_menu_screening';
		$data['project_perspective']='screening';
	
		$data ['page'] = 'relis/screen_result';
	
	
	
		/*
		 * Chargement de la vue avec les données préparés dans le controleur suivant le type d'affichage : (popup modal ou pas)
		 */
		$this->load->view ( 'body', $data );
	}
	
	public function validate_screen_set($data=""){
			
	
	
	
		$papers=$this->DBConnection_mdl->get_papers('screen','papers','_',0,-1);
		//print_test($papers);
	
	
	
		$user_table_config=get_table_config('users');
	
		$users=$this->DBConnection_mdl->get_list($user_table_config,'_',0,-1);
		$_assign_user=array();
		foreach ($users['list'] as $key => $value) {
			if( (user_project($this->session->userdata('project_id') ,$value['user_id'])) ){
	
				$_assign_user[$value['user_id']]=$value['user_name'];
			}
		}
		//	print_test($users);
		$data['users']=$_assign_user;
		
		$data['percentage_of_papers']=20;
		$data['papers_categories']=array('Excluded'=>'Excluded','Included'=>'Included','all'=>'All');
		
	
	
		$data ['page_title'] = lng('Set screening validation');
		$data ['top_buttons'] = get_top_button ( 'back', 'Back', 'home' );
		$data['left_menu_perspective']='z_left_menu_screening';
		$data['project_perspective']='screening';
		$data ['page'] = 'relis/assign_papers_screen_validation';
	
		//print_test($data);
	
		/*
		 * Chargement de la vue avec les données préparés dans le controleur suivant le type d'affichage : (popup modal ou pas)
		 */
		$this->load->view ( 'body', $data );
	}
	




	function save_assign_screen_validation(){
	
		$post_arr = $this->input->post ();
		//	print_test($post_arr);
		$users=array();
		$i=1;
		$percentage=intval($post_arr['percentage']);
		if(empty( $percentage)){
	
			$data['err_msg'] = lng(' Please provide  "Percentage of papers" ');
			$this->validate_screen_set($data);
				
		}else{
				
			// Get selected users
			While ($i <= $post_arr['number_of_users']) {
				if(!empty( $post_arr['user_'.$i])){
					array_push($users,$post_arr['user_'.$i]);
				}
				$i++;
			}
	
			//Verify if selected users is > of required reviews per paper
			if(count($users) < 1){
	
				$data['err_msg'] = lng('Please select at least one user  ');
				$this->validate_screen_set($data);
	
			}else{
	
				//print_test($users);
				
				//$percentage=$post_arr['percentage'];
	
				//Get all papers
			//	$result_papers=$this->DBConnection_mdl->get_papers('screen','papers','_',0,-1);
				$reviews_per_paper=1;
				if($post_arr['paper_to_validate']=='all'){
					$extra_condition =" ";
						
				}else{
					$extra_condition =" AND ( screening_status ='".$post_arr['paper_to_validate']."') ";
					
				}
				
				$result_papers=$this->manage_mdl->get_list(get_table_config('papers'),'_',0,-1,$extra_condition);
					
				
				$papers=$result_papers['list'];
				
				$papers_to_validate_nbr= round( count($papers) * $percentage/100);
				
				$operation_description="Assign $percentage % ($papers_to_validate_nbr) of ".$post_arr['paper_to_validate']." papers for validation";
			//	print_test($papers);
				shuffle($papers); // randomize the list
			
				$assign_papers= array();
				$this->db2 = $this->load->database(project_db(), TRUE);
				$operation_code=active_user_id()."_".time();
				foreach ($papers as $key => $value) {
					if($key<$papers_to_validate_nbr)	{
					$assign_papers[$key]['paper']=$value['id'];
						
					$assign_papers[$key]['users']=array();
					
					$assignment_save=array(
							'paper_id'=>$value['id'],
							'user_id'=>'',
							'note'=>'',
							'assignment_type'=>'Normal',
							'operation_code'=>$operation_code,
							'assignment_mode'=>'auto',
							'assigned_by'=>$this->session->userdata ( 'user_id' )
								
					);
					$j=1;
						
						
						
					while($j<=$reviews_per_paper){
	
	
							
						$temp_user=($key % count($users)) + $j;
							
						if($temp_user >= count($users) )
							$temp_user = $temp_user - count($users);
								
							array_push($assign_papers[$key]['users'], $users[$temp_user]);
	
							$assignment_save['user_id']=$users[$temp_user];
					
							$this->db2->insert('assignment_screen_validate',$assignment_save);
								
								
							$j++;
					}
						
					}	
				}
				
			//	print_test();
	
				$operation_arr=array('operation_code'=>$operation_code,
						'operation_type'=>'assign_papers_validation',
						'user_id'=>active_user_id(),
						'operation_desc'=>$operation_description
		
				);
				$res2 = $this->manage_mdl->add_operation($operation_arr);
	
	
				set_top_msg('Operation completed');
				redirect('home/screening');
				
			}
		}
	}
	
	
	
	public function screen_validation_result(){
	
		$res_screenings=$this->DBConnection_mdl->get_list(get_table_config('screening_validate'),'_',0,-1);
		
		$res_papers=$this->DBConnection_mdl->get_papers('screen',get_table_config('papers'),"_",0,-1);
		
		$papers=array();
		
		foreach ($res_papers['list'] as $key => $value) {
			$papers[$value['id']]=array(
					'bibtexKey'=>$value['bibtexKey'],
					'title'=>$value['title'],
					'screening_status'=>$value['screening_status'],
					'classification_status'=>$value['classification_status']
			);
		}
		
	
		$decision_map=array(
				'accepted'=>'Included',
				'excluded'=>'Excluded',
				''=>'unknown'
		);
		
		$screenings=array();
		$nbr_all=0;
		$nbr_matched=0;
		$i=1;
		foreach ($res_screenings['list'] as $key => $value) {
			if(!empty($papers[$value['paper_id']])){
				$screenings[$key]=array(
							'num'=>$i,
							'paper'=>$papers[$value['paper_id']]['bibtexKey']." - ".$papers[$value['paper_id']]['title'],
							//'paper_title'=>$papers[$value['paper_id']]['title'],
							'screening_decision'=>$papers[$value['paper_id']]['screening_status'],
							'validation_descision'=>$decision_map[$value['decision']]
							
				);
				if($screenings[$key]['validation_descision']==$screenings[$key]['screening_decision'])	
				{
					$nbr_matched++;
					$screenings[$key]['matched']='Yes';
				}else{
					$screenings[$key]['matched']='No';
				}
				$but[0]=array(
						'url'=> 'relis/manager/display_paper_screen/'.$value ['paper_id'],
						'label'=>icon('folder').' '.'View',
						'title'=>'Display'
							
				);
				//print_test($but);
				$screenings[$key]['butt']=create_button_link_dropdown($but,lng_min('Action'));
				$nbr_all++;
				$i++;
			}
		}
		
		
		$match_percentage=round($nbr_matched * 100 / $nbr_all,2);
		
	
		$data ['list']=$screenings;
		$data ['nombre']=count($screenings);
		$data['list_header']=array('#','Papers','Screening result','Validation','Matched','');
		$data ['top_buttons'] = get_top_button ( 'close', 'Close', 'home' );
		
		$data['page_title']=lng("Validation result")." : $nbr_matched ".lng("matches out of")." $nbr_all ".icon('arrow-right')." $match_percentage  % ";
		
		$data['page']='general/list_dt';
		
		$this->load->view('body',$data);
		
	}
	
}
