<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	
		
	}
	
	/*
	 * Liste des projets installés	 * 
	 */
	
	
	public function projects_list(){
		old_version();
		$config="project";
		$this->session->set_userdata('project_db',FALSE);
		$ref_table_config=$this->table_ref_lib->ref_table_config($config);
		
	
		
		$data['projects']=$this->DBConnection_mdl->get_list($ref_table_config);
		
		//print_test($data);
		foreach ($data['projects']['list'] as $key => $value) {
			
			
			$detail_project=$this->DBConnection_mdl->get_row_details ( $config,$value['project_id'] );
			if(!empty($detail_project['project_icon']))
			{$data['projects']['list'][$key]['icon']=$this->config->item('image_upload_path').$detail_project['project_icon']."_med.jpg";}
			else 
			{$data['projects']['list'][$key]['icon']=$this->config->item('image_upload_path')."init/model_project1.png";}
			
			if(! (user_project($value['project_id']))){
				unset($data['projects']['list'][$key]);
			}
		}
			//print_test($data);
		$data ['add_project_button'] = get_top_button ( 'all', 'Add new project', 'install/new_project','Add new project','fa-plus','',' btn-success ',false );
			
		$data['page']='projects_list';
		$data['page_title']=lng('Installed projects');
		$data['left_menu_admin']=True;
		
		$this->load->view('body',$data);
		
		
	}
	
	public function set_project($projet_label,$project_id=0,$project_title=""){
		old_version();
		if(!empty($projet_label)){
			$this->session->set_userdata('project_db',$projet_label);
			$this->session->set_userdata('project_id',$project_id);
			$this->session->set_userdata('project_title',urldecode ( urldecode ($project_title)));
			
		}
		
		//redirect('home');
	}
	 
	
	
}
