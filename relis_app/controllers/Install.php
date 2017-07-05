<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Install extends CI_Controller {

	/*
	 * 
	 * En cours de réalisation utilisé pour l'installation
	 */
	function __construct()
	{
		parent::__construct();
	
		
	}
	
	public function index()
	{
		redirect('home');
	}
	
	public function relis_editor($type="client"){
	
		$data ['page_title'] = lng('ReLiS editor');
		$data ['top_buttons'] = get_top_button ( 'back', 'Back', 'manage' );
	
		$data ['page'] = 'install/relis_editor';
		$data['editor_url']=$this->config->item('editor_url');
	
		if($type == 'admin'){
			$data['left_menu_admin']=True;
		}
		/*
		 * Chargement de la vue avec les données préparés dans le controleur suivant le type d'affichage : (popup modal ou pas)
		 */
		$this->load->view ( 'body', $data );
	
	}
	
	public function install_form(){
		$data ['page_title'] = lng('Update project');
		$data ['top_buttons'] = get_top_button ( 'all', lng_min('Load from editor'), 'install/install_form_editor',lng_min('Load from editor'),' fa-exchange','',' btn-info ' );
		$data ['top_buttons'] .= get_top_button ( 'back', 'Back', 'home' );
		$data ['page'] = 'install/frm_install';
		
		
		
		/*
		 * Chargement de la vue avec les données préparés dans le controleur suivant le type d'affichage : (popup modal ou pas)
		 */
		$this->load->view ( 'body', $data );
	}
	
	public function install_form_editor(){
		
		
		
		
		$dir=$this->config->item('editor_generated_path');
		$editor_url=$this->config->item('editor_url');
		
		
		$Tprojects=array();
		if(is_dir($dir)){
			$files = array_diff(scandir($dir), array('.', '..',".metadata"));
			foreach ($files as $key => $file) {
				if(is_dir($dir.'\\'.$file)){
					$project_dir=$dir.'\\'.$file;
					$Tprojects[$file]=array();
					$Tprojects[$file]['dir']=$project_dir;
					$Tprojects[$file]['syntax']=array();
					$Tprojects[$file]['generated']=array();
					//syntax
					$project_content = array_diff(scandir($project_dir), array('.', '..',".metadata"));
					foreach ($project_content as $key => $value_c) {
							
						if(!is_dir($project_dir.'\\'.$value_c)){
							array_push($Tprojects[$file]['syntax'], $value_c);
		
						}elseif($value_c=='src-gen'){
		
							$project_content_gen = array_diff(scandir($project_dir.'\\src-gen'), array('.', '..',".metadata"));
							foreach ($project_content_gen as $key_g => $value_g) {
								if(!is_dir($project_dir.'\\src-gen\\'.$value_g)){
									array_push($Tprojects[$file]['generated'], $value_g);
		
								}
							}
						}
					}
		
		
				}
			}
		
		
		}
		$data['project_result']=$Tprojects;
		
		
		
		
		
		
		
		$data ['page_title'] = lng('Update project');
		$editor_url=$this->config->item('editor_url');
		
		
		$data ['top_buttons'] = get_top_button ( 'all', 'Upload configuration file', 'install/install_form','Upload configuration file',' fa-upload','',' btn-info ' );
		$data ['top_buttons'] .= "<li>".anchor('install/relis_editor','<button class="btn btn-primary">  Open editor </button></li>','title="Open editor"')."</li>" ;
		$data ['top_buttons'] .= get_top_button ( 'back', 'Back', 'manage' );
		$data ['page'] = 'install/frm_install_editor';
	
	
	
		/*
		 * Chargement de la vue avec les données préparés dans le controleur suivant le type d'affichage : (popup modal ou pas)
		 */
		$this->load->view ( 'body', $data );
	}
	
	public function new_project(){
		
		
		$data ['page_title'] = lng('Add new project');
		$data ['top_buttons'] = get_top_button ( 'all', 'Load from editor', 'install/new_project_editor','Load from editor',' fa-exchange','',' btn-info ' );
		$data ['top_buttons'] .= get_top_button ( 'back', 'Back', 'home/choose_project/' );
		$data ['page'] = 'install/frm_new_project';
		$data['left_menu_admin']=True;
	
	
		/*
		 * Chargement de la vue avec les données préparés dans le controleur suivant le type d'affichage : (popup modal ou pas)
		 */
		$this->load->view ( 'body', $data );
	}
	public function new_project_editor(){
		
		// Create new project from ReLiS Editor
		
		/**
		 * @var string $dir : the location of the folder where the installation files are located
		 */
		$dir=get_ci_config('editor_generated_path');

		/**
		 * @var string  $editor_url  the url adress of ReLiS Editor: 
		 */
		$editor_url=$this->config->item('editor_url');
		
		
		$Tprojects=array();
		if(is_dir($dir)){
			$files = array_diff(scandir($dir), array('.', '..',".metadata"));
			
			foreach ($files as $key => $file) {
				if(is_dir($dir.'\\'.$file)){
					
					$project_dir=$dir.'\\'.$file;
					$Tprojects[$file]=array();
					$Tprojects[$file]['dir']=$project_dir;
					$Tprojects[$file]['syntax']=array();
					$Tprojects[$file]['generated']=array();
					
					//syntax
					$project_content = array_diff(scandir($project_dir), array('.', '..',".metadata"));
					foreach ($project_content as $key => $value_c) {
							
						if(!is_dir($project_dir.'\\'.$value_c)){
							array_push($Tprojects[$file]['syntax'], $value_c);
		
						}elseif($value_c=='src-gen'){
		
							$project_content_gen = array_diff(scandir($project_dir.'\\src-gen'), array('.', '..',".metadata"));
							foreach ($project_content_gen as $key_g => $value_g) {
								if(!is_dir($project_dir.'\\src-gen\\'.$value_g)){
									array_push($Tprojects[$file]['generated'], $value_g);
		
								}
							}
						}
					}
		
						
				}
			}
		
		
		}
		$data['project_result']=$Tprojects;
	
		$data ['page_title'] = lng('Add new project');
		$data ['top_buttons'] = get_top_button ( 'all', lng_min('Upload configuration file'), 'install/new_project',lng_min('Upload configuration file'),' fa-upload','',' btn-info ' );
		$data ['top_buttons'] .= "<li>".anchor('install/relis_editor/admin','<button class="btn btn-primary">  '.lng_min('Open editor').' </button></li>','title="'.lng_min('Open editor').'" ')."</li>" ;
		
		
		$data ['top_buttons'] .= get_top_button ( 'back', 'Back', 'home/choose_project/' );
		$data ['page'] = 'install/frm_new_project_editor';
		$data['left_menu_admin']=True;
	
	
		/*
		 * Chargement de la vue avec les données préparés dans le controleur suivant le type d'affichage : (popup modal ou pas)
		 */
		$this->load->view ( 'body', $data );
	}
	
	public function save_new_project(){
		$error_array=array();
		$success_array=array();
		if ($_FILES["install_config"]["error"] > 0)
		{
			array_push($error_array,"Error: " . file_upload_error($_FILES["install_config"]["error"]));
		}
		elseif ($_FILES["install_config"]["type"] !== "application/octet-stream" OR $_FILES["install_config"]["type"] !== "application/octet-stream"  )
		{
			//echo "File must be a .php";
			array_push($error_array,"File must be a .php");
		}
		else
		{
			
			$fp = fopen($_FILES['install_config']['tmp_name'], 'rb');
			
			
			$line = fgets($fp);
			$Tline=explode("//", $line);
			
			if(empty($Tline[1])){
				//echo "Check the file used";
				array_push($error_array,"Check the file used");
			}else{
				$project_short_name=trim($Tline[1]);
				$sql="SELECT project_id from projects where project_label LIKE '".$project_short_name."' AND project_active=1 ";
				$resul= $this->db->query($sql)->result_array();
				//print_test($resul);
				
				if(!empty($resul)){
					//echo "<h2>Project already installed</h2>";
					//echo "<h2>".anchor('home',lng('Back'))."</h2>";
					
					array_push($error_array,"Project already installed");
					
				}else{
					
					
					//Save the file in a temporal location
					$project_specific_config_folder=get_ci_config('project_specific_config_folder');
					$f_new_temp = fopen($project_specific_config_folder."temp/install_config_".$project_short_name.".php", 'w+');
						
					
					rewind($fp);
					while ( ($line = fgets($fp)) !== false) {
					
						fputs($f_new_temp, $line. "\n");
						//echo "$line<br>";
					}
				
					fclose($f_new_temp);
					
					
					//Retrieve the content to verify the validity of the file
					
					
					$temp_table_config= $this->entity_configuration_lib->get_new_install_config($project_short_name);
					
					if(! valid_install_configuration_file($temp_table_config))
					{
						array_push($error_array,"Not a valid configuration file");
					}else{
						copy( $project_specific_config_folder."temp/install_config_".$project_short_name.".php", $project_specific_config_folder."install_config_".$project_short_name.".php" );
							
						redirect('install/save_new_project_part2/'.$project_short_name);
					}
					
					
				}
			
			}
			
		}
		
		if(!empty($error_array)){
			//print_r($error_array);
			$this->project_install_result($error_array);
		}
		
	}
	
	
	public function save_new_project_editor(){
		
		$post_arr = $this->input->post ();
		//print_test($post_arr); exit;
		$error_array=array();
		$success_array=array();
		if (empty($post_arr['selected_config']))
		{
							
			array_push($error_array,lng("Error: Choose a file "));
		}
		elseif (!is_file($post_arr['selected_config']))
		{
			//echo "File must be a .php";
			array_push($error_array,lng("File must be a .php"));
		}
		else
		{
				
			$fp = fopen($post_arr['selected_config'], 'rb');
				
				
			$line = fgets($fp);
			$Tline=explode("//", $line);
				
			if(empty($Tline[1])){
				//echo "Check the file used";
				array_push($error_array,lng("Check the file used"));
			}else{
				$project_short_name=trim($Tline[1]);
				
				//Verifie if the project is already installed
				$sql="SELECT project_id from projects where project_label LIKE '".$project_short_name."' AND project_active=1 ";
				$resul= $this->db->query($sql)->result_array();
				//print_test($resul);
	
				if(!empty($resul)){
					//echo "<h2>Project already installed</h2>";
					//echo "<h2>".anchor('home',lng('Back'))."</h2>";
						
					array_push($error_array,lng("Project already installed"));
						
				}else{
					
					
					//Save the file in a temporal location
					$project_specific_config_folder=get_ci_config('project_specific_config_folder');
					
					$f_new_temp = fopen($project_specific_config_folder."temp/install_config_".$project_short_name.".php", 'w+');
					
					rewind($fp);
					while ( ($line = fgets($fp)) !== false) {
						
						fputs($f_new_temp, $line. "\n");
						//echo "$line<br>";
					}
					
					fclose($f_new_temp);
						
					//Retrieve the content to verify the validity of the file
						
						
					$temp_table_config= $this->entity_configuration_lib->get_new_install_config($project_short_name);
						
					if(! valid_install_configuration_file($temp_table_config))
					{
						array_push($error_array,"Not a valid configuration file");
					}else{
						copy( $project_specific_config_folder."temp/install_config_".$project_short_name.".php", $project_specific_config_folder."install_config_".$project_short_name.".php" );
						
					
						redirect('install/save_new_project_part2/'.$project_short_name);
					}
						
				}
					
	
					
			}
				
	
		
				
		}
	
		if(!empty($error_array)){
			//print_r($error_array);
			$this->project_install_result($error_array,array(),'new_project_editor');
		}
	
	}
	
	public function save_install_form_part2($verbose=FALSE)
	{
		$error_array=array();
		$success_array=array();
			
		if($verbose)
			echo "<h2>Import done</h2>";
		array_push($success_array, 'Setup file imported');
		
		
		
		
		
		//Read installation configuration
		$res_install_config= $this->entity_configuration_lib->get_install_config();
		//print_test($res_install_config);
	
		//cleaning old installation
		$this->clean_previous_installation();
	
	
		if($verbose)
			echo "<h2>Previous installation cleaned</h2>";
		array_push($success_array, 'Previous installation cleaned');
		
	
		//create database sql script
	
		$ref_tables=array();
		$generated_tables=array();
		$foreign_key_constraints=array();
	
		//echo "<h3>creating project spécific tables</h3>";
	
		//reference tables
		$sql_ref="";
		if(!empty($res_install_config['reference_tables'])){
			foreach ($res_install_config['reference_tables'] as $key => $value) {
				array_push($ref_tables, $key);
				$sql_ref.=$this->create_reference_table($key, $value);
				$sql_ref.="<br/><br/>";
			}
		}
		//echo $sql_ref."<br/>";

		//tables
		$sql_table="";
		if(!empty($res_install_config['config'])){
			foreach ($res_install_config['config'] as $key_config => $config_values) {
				array_push($generated_tables, $key_config);
				$sql_table.=$this->create_table_config($config_values);
				//$sql_table.="<br/><br/>";
				
				$foreign_key=$this->get_froreign_keys_constraint($key_config,$config_values);
				if(!empty($foreign_key)){
					array_push($foreign_key_constraints, $foreign_key);
				}
			}
		}
		//echo $sql_table."<br/>";
		if($verbose)
			echo "<h2>New project specific tables created</h2>";
		array_push($success_array, 'New project specific tables created');
	
	
		$sql_install_info="UPDATE installation_info SET  install_active=0 where install_active = 1 ; ";
	
		$res_sql = $this->manage_mdl->run_query($sql_install_info);
	
		$sql_install_info="INSERT INTO installation_info (reference_tables,generated_tables,foreign_key_constraint) VALUES ('".json_encode($ref_tables)."','".json_encode($generated_tables)."','".json_encode($foreign_key_constraints)."')   ; ";
	
		//echo $sql_install_info;
		$res_sql = $this->manage_mdl->run_query($sql_install_info);
	
	
		//echo "<h3>creating project stored procedures</h3>";
	
		// stored procedures
		if(!empty($res_install_config['config'])){
			foreach ($res_install_config['config'] as $key_config => $config_values) {
				//$this->update_stored_procedure($key_config);
				$this->update_stored_procedure($key_config,FALSE,'current',TRUE);
			}
		}
	
	
		if(!empty($res_install_config['reference_tables'])){
			foreach ($res_install_config['reference_tables'] as $key => $value) {
				$this->update_stored_procedure($key);
			}
		}
		
		if($verbose)
			echo "<h2>New project specific stored procedures created</h2>";
		array_push($success_array, 'New project specific stored procedures created');
		
		$project_title="Review";
		if(!empty($res_install_config['project_title'])){
			$project_title=$res_install_config['project_title'];
		}
		
		$project_short_name=$res_install_config['project_short_name'];
		
		$sql_update_config="UPDATE config SET project_title ='".$project_title."',project_description='".$project_title."',run_setup=0 WHERE config_id =1 ";
	
		//$this->db2->query("UPDATE config SET project_title ='".$project_title."',project_description='Project description goes here',run_setup=0 WHERE config_id =1 ");
	
		//$res_sql = $this->manage_mdl->run_query($sql_update_config);
		
		$sql_update_project="UPDATE  projects  SET project_title='".$project_title."',project_description='".$project_title."' WHERE project_label LIKE '".$project_short_name."'";
			
		
		$res_sql = $this->manage_mdl->run_query($sql_update_project,false,'default');
		//echo $sql_update_project;
		if($verbose)
			echo "<h2>Project updated</h2>";
		array_push($success_array, 'Project updated');
		
		$this->project_install_result($error_array,$success_array,'update_project');
		
		//echo "<h2>Installation done</h3>";
		//echo anchor('home','<h2> Start the Application </h3>');
	
	
	
	
	}
	
	private function project_install_result($array_error=array(),$array_success=array(),$type="new_project"){
		
		//$data ['top_buttons'] = get_top_button ( 'back', 'Back', 'home/choose_project/' );
		$data ['page'] = 'install/frm_install_result';
		$data['left_menu_admin']=True;
		$data['array_error']=$array_error;
		$data['array_success']=$array_success;
		$data ['next_operation_button']="";
		if($type=="update_project"){
			$back_link="install/install_form";
			$success_link="home";
			$success_title="Go back to the project";
			$page_title="Update project";
			
		}elseif($type=="new_project_editor"){
			$back_link="install/new_project_editor";
			$success_link="manager/projects_list";
			$success_title="Go back to project list";
			$page_title="New project";
		}elseif($type=="update_project_editor"){
			$back_link="install/install_form_editor";
			$success_link="manager/projects_lis";
			$success_title="Go back to project list";
			$page_title="New project";
		}else{
			$back_link="install/new_project";
			$success_link="manager/projects_list";
			$success_title="Go back to the project";
			$page_title="Update project";
		}
		
		$data ['page_title'] = lng($page_title);
		
		if(!empty($array_error)){
			$data ['next_operation_button'] = get_top_button ( 'all', 'Back', $back_link,'Back','','',' btn-danger ',FALSE );
		}else{
			
			$data ['next_operation_button'] = get_top_button ( 'all', $success_title, $success_link,$success_title,'','',' btn-success ',FALSE );
			
		}
	
		/*
		 * Chargement de la vue avec les données préparés dans le controleur suivant le type d'affichage : (popup modal ou pas)
		 */
		$this->load->view ( 'body', $data );
		
	}
	
	public function save_new_project_part2($project_short_name ,$verbose=false){
		
			$error_array=array();
			$success_array=array();
			
			if($verbose)
			echo "<h2>Import done</h2>";
			
			array_push($success_array, lng('Setup file imported'));
			
			
			
			$database_name=get_ci_config('project_db_prefix').$project_short_name;
			$sql = "CREATE DATABASE $database_name";
			$res_sql=$this->manage_mdl->run_query($sql);
			
			if($verbose)
				echo "<h2>New database created</h2>";
			
			array_push($success_array, lng('New database created'));
				
			//setting CI database configuration
			$this->add_database_config($project_short_name);
			
			
			
			//echo "<h2>initialise database</h2>";
		
			// Populate created database
			
			$this->populate_created_database($project_short_name);
			
			
			//create initial tables
			$this->populate_common_tables($project_short_name);
			
			//echo "<h2>initialise stored procedures</h2>";
			$this->update_stored_procedure('init',FALSE,$project_short_name,TRUE);
			$this->populate_common_tables_views($project_short_name);
			if($verbose)
				echo "Database initialised";
			
			array_push($success_array, 'Database initialised');
				
			
			$res_install_config= $this->entity_configuration_lib->get_install_config($project_short_name);
			
			//print_test($res_install_config);
			
			$project_title="Project default name";
			
			if(!empty($res_install_config['project_title']))
				$project_title=$res_install_config['project_title'];
			
			/////$this->session->set_userdata('project_db',$project_short_name);
			
			
			$ref_tables=array();
			$generated_tables=array();
			$foreign_key_constraints=array();
			
			//echo "<h3>creating project spécific tables</h3>";
			
			//reference tables
			$sql_ref="";
			
			////print_test($res_install_config['reference_tables']);
			if(!empty($res_install_config['reference_tables'])){
				foreach ($res_install_config['reference_tables'] as $key => $value) {
					array_push($ref_tables, $key);
					$sql_ref.=$this->create_reference_table($key, $value,$project_short_name);
					$sql_ref.="<br/><br/>";
				}
			}
			//ecaho $sql_ref."<br/>";
	
			//tablesaa
			//print_test($res_install_config['config']);
			$sql_table="";
			if(!empty($res_install_config['config'])){
				foreach ($res_install_config['config'] as $key_config => $config_values) {
					array_push($generated_tables, $key_config);
					//$sql_table.=$this->create_table_config($config_values,$project_short_name);
					$sql_table.=$this->manage_stored_procedure_lib->create_table_config($config_values,$project_short_name);
					//$sql_table.="<br/><br/>";
					
					$foreign_key=$this->get_froreign_keys_constraint($key_config,$config_values);
					if(!empty($foreign_key)){
						array_push($foreign_key_constraints, $foreign_key);
					}
				}
				
				/// ADD CONTRAINTS
				
				
			}
	//		echo $sql_table."<br/>";
			
			if($verbose)
				echo "<h3>Project specific tables created</h3>";
				
			array_push($success_array, 'Project specific tables created');
			
			
			
			
			$sql_install_info="UPDATE installation_info SET  install_active=0 where install_active = 1 ; ";
			
			$res_sql = $this->manage_mdl->run_query($sql_install_info,false,$project_short_name);
			
			$sql_install_info="INSERT INTO installation_info (reference_tables,generated_tables,foreign_key_constraint) VALUES ('".json_encode($ref_tables)."','".json_encode($generated_tables)."','".json_encode($foreign_key_constraints)."')   ; ";
			
			//echo $sql_install_info;
			$res_sql = $this->manage_mdl->run_query($sql_install_info,false,$project_short_name);
			
			
		
			if($verbose)
				echo "<h3>Project specific stored procedure created</h3>";
				
			array_push($success_array, 'Project specific stored procedure created');
			// stored procedures
			if(!empty($res_install_config['config'])){
			foreach ($res_install_config['config'] as $key_config => $config_values) {
				$this->update_stored_procedure($key_config,FALSE,$project_short_name,TRUE);
			}
			}
			
			if(!empty($res_install_config['reference_tables'])){
				foreach ($res_install_config['reference_tables'] as $key => $value) {
					$this->update_stored_procedure($key,FALSE,$project_short_name);
				}
			}
			
			
			
			//$sql_update_config="UPDATE config SET project_title ='".$project_title."',project_description='Project description goes here',run_setup=0 WHERE config_id =1 ";
			$creator=1;
			$creator=$this->session->userdata('user_id');
			
		//	$sql_add_config="INSERT INTO config  (project_title,project_description,creator ) VALUES ('".$project_title."','Project description goes here',".$creator.")";
			//echo $sql_add_config;
			
		///	$res_sql = $this->manage_mdl->run_query($sql_add_config,false,$project_short_name);
			//print_test($res_sql);
			
			$sql_add_project="INSERT INTO projects  (project_label,project_title,project_description,project_creator) VALUES ('".$project_short_name."','".$project_title."','".$project_title."',".$creator.")";
			
				
			$res_sql = $this->manage_mdl->run_query($sql_add_project,false,'default');
			
			if($verbose)
				echo "<h3>New project added</h3>";
			
			array_push($success_array, 'New project added');
			
			//echo "<h2>Installation done</h3>";
			
			
			//echo anchor('home','<h2> Start the Application </h3>');
			 
			$this->project_install_result($error_array,$success_array);
		
	}
	
	
	
	private function populate_created_database ($project_short_name){
		
		$this->db2 = $this->load->database($project_short_name, TRUE);
		$db_sql=file_get_contents("relis_app/libraries/table_config/project/init_sql/project_initial_query.sql");
		
		
		$T_db_sql=explode ( ';;;;' , $db_sql);
	
		
	
		foreach ($T_db_sql as $key => $v_sql) {
			$sql=trim($v_sql);
			//print_test($sql);
			if( !empty($sql ) ){
	
				$res=$this->db2->query( $sql );
				//print_test($res);
			}
		}
	
	
		
	}
	
	
	
	
	private function add_database_config($project_short_name){
			
		$database_config = '$db'."['".$project_short_name."'] = array(
		'dsn'	=> '',
		'hostname' => '".$this->config->item('project_db_host')."',
		'username' => '".$this->config->item('project_db_user')."',
		'password' => '".$this->config->item('project_db_pass')."',
		'database' => '".$this->config->item('project_db_prefix').$project_short_name."',
		'dbdriver' => 'mysqli',
		'dbprefix' => '',
		'pconnect' => FALSE,
		'db_debug' => (ENVIRONMENT !== 'production'),
		'cache_on' => FALSE,
		'cachedir' => '',
		'char_set' => 'utf8',
		'dbcollat' => 'utf8_general_ci',
		'swap_pre' => '',
		'encrypt' => FALSE,
		'compress' => FALSE,
		'stricton' => FALSE,
		'failover' => array(),
		'save_queries' => TRUE
);";
		
		$f_config = fopen("relis_app/config/database.php", 'a+');
		
		
		fputs($f_config, "\n".$database_config. "\n");
		
		fclose($f_config);
		
		
	}
	
	public function save_install_form(){
		$error_array=array();
		$success_array=array();
		
	if ($_FILES["install_config"]["error"] > 0)
		{
			//echo "Error: " . $_FILES["file"]["error"] . "<br />";
			
			array_push($error_array,"Error: " . file_upload_error($_FILES["install_config"]["error"]));
		}
		elseif ($_FILES["install_config"]["type"] !== "application/octet-stream")
		{
			//echo "File must be a .php";
			array_push($error_array,"File must be a .php");
		}
		else
		{
			
			//$monfichier="";
			
			//exit;
		$fp = fopen($_FILES['install_config']['tmp_name'], 'rb');
		
		$line = fgets($fp);
		$Tline=explode("//", $line);
		
		if(!empty($Tline[1]) AND trim($Tline[1])==project_db() ){
			
		$project_specific_config_folder=get_ci_config('project_specific_config_folder');
		$f_new = fopen($project_specific_config_folder."temp/install_config_".project_db().".php", 'w+');
			
		rewind($fp);
			    while ( ($line = fgets($fp)) !== false) {
			    	 fputs($f_new, $line. "\n"); 
			      //echo "$line<br>";
		    }
		fclose($f_new);
		
		    
		    $temp_table_config= $this->entity_config_lib->get_new_install_config(project_db());
		    	
		    if(! valid_install_configuration_file($temp_table_config))
		    {
		    	array_push($error_array,"Not a valid configuration file");
		    }else{
		    	copy( $project_specific_config_folder."temp/install_config_".project_db().".php", $project_specific_config_folder."install_config_".project_db().".php" );
		    		
		    	redirect('install/save_install_form_part2');
		    }
		  // redirect('install');
		  // $this->save_install_form_part2();
		  }else{
		  	array_push($error_array,'The file you are trying to upload does not contain a correct updated version of this project');
		  	//echo "<h2>The file you are trying to upload does not contain an correct updated version of this project</h2>";
		  	//echo "<h2>".anchor('home',lng('Back'))."</h2>";
		  } 
		   
		}
		
		if(!empty($error_array)){
			//print_r($error_array);
			$this->project_install_result($error_array,$success_array,'update_project');
		}
	}
	
	
	public function save_install_form_editor(){
		$post_arr = $this->input->post ();
		$error_array=array();
		$success_array=array();
		
	if (empty($post_arr['selected_config']))
		{
			//echo "Error: " . $_FILES["file"]["error"] . "<br />";
			
			array_push($error_array,"Error: Choose a file ");
		}
		elseif (!is_file($post_arr['selected_config']))
		{
			//echo "File must be a .php";
			array_push($error_array,"File must be a .php");
		}
		else
		{
			
			//$monfichier="";
			
			//exit;
		$fp = fopen($post_arr['selected_config'], 'rb');
		
		$line = fgets($fp);
		$Tline=explode("//", $line);
		
		if(!empty($Tline[1]) AND trim($Tline[1])==project_db() ){
			
		
			$project_specific_config_folder=get_ci_config('project_specific_config_folder');
			$f_new = fopen($project_specific_config_folder."temp/install_config_".project_db().".php", 'w+');
			
			rewind($fp);
			    while ( ($line = fgets($fp)) !== false) {
			    	 fputs($f_new, $line. "\n"); 
			      //echo "$line<br>";
		    }
		    fclose($f_new);
		    $temp_table_config= $this->entity_config_lib->get_new_install_config(project_db());
		     
		    if(! valid_install_configuration_file($temp_table_config))
		    {
		    	array_push($error_array,"Not a valid configuration file");
		    }else{
		    	copy( $project_specific_config_folder."temp/install_config_".project_db().".php", $project_specific_config_folder."install_config_".project_db().".php" );
		    
		    	redirect('install/save_install_form_part2');
		    }
		   
		  // redirect('install');
		   //$this->save_install_form_part2();
		  }else{
		  	array_push($error_array,'The file you are trying to upload does not contain a correct updated version of this project');
		  	//echo "<h2>The file you are trying to upload does not contain an correct updated version of this project</h2>";
		  	//echo "<h2>".anchor('home',lng('Back'))."</h2>";
		  } 
		   
		}
		
		if(!empty($error_array)){
			//print_r($error_array);
			$this->project_install_result($error_array,$success_array,'update_project_editor');
		}
	}
	
	private function clean_previous_installation(){
		
	
		//echo "<h3>Cleaning old installation</h3>";
		$sql="select * from installation_info where install_active=1 ";
		$this->db2 = $this->load->database(project_db(), TRUE);
		$res=$this->db2->query($sql)->row_array();
		if(!empty($res)){
		
		$reference_tables=json_decode($res['reference_tables']);
		$generated_tables=json_decode($res['generated_tables']);
		$foreign_key_constraint=json_decode($res['foreign_key_constraint']);
	//print_test($res);
		//print_test($generated_tables);
		//EXIT;
		if(!empty($foreign_key_constraint)){
			foreach ($foreign_key_constraint as $k => $v_constraint) {
				
				$v_constraint=trim($v_constraint);
				
				if(!empty($v_constraint))
					$res_sql = $this->manage_mdl->run_query($v_constraint);
				
			}
		}
		$i=1;
		if(!empty($reference_tables)){
			foreach ($reference_tables as $key => $value) {
				if($i==1)
					$sql="DROP TABLE  IF EXISTS `".$value."` ";
				else
					$sql.=" , `".$value."` ";
				
				$i++;
			}
		}
		
		if(!empty($reference_tables)){
			foreach ($generated_tables as $key => $value) {
				if($i==1)
					$sql="DROP TABLE IF EXISTS `".$value."` ";
				else
					$sql.=" , `".$value."` ";
				$i++;
			}
		}
		
		$sql.=" ; ";
		
		
		$res_sql = $this->manage_mdl->run_query($sql);
		
		//print_test($res_sql);
		//echo $sql;
		
		$sql="DELETE from ref_tables where reftab_id !=1";
		
		$res_sql = $this->manage_mdl->run_query($sql);
		
		//print_test($res_sql);
		//echo $sql;
		}
	}
	 
	
	private function create_reference_table($ref_conf,$ref_value,$target_db='current'){
	
		$target_db=($target_db=='current')?project_db():$target_db;
		
		
		$table_name=$ref_conf;
		$desc=$ref_value['ref_name'];
		//
		$del_line="DROP TABLE IF EXISTS ".$table_name.";";
		$res_sql = $this->manage_mdl->run_query($del_line,False,$target_db);
		
		//print_test($res_sql);
		
	
		$sql="CREATE TABLE IF NOT EXISTS ".$table_name." (
		`ref_id` int(11) NOT NULL AUTO_INCREMENT,
		  `ref_value` varchar(50) NOT NULL,
		  `ref_desc` varchar(250) DEFAULT NULL,
		  `ref_active` int(1) NOT NULL DEFAULT '1',
		  PRIMARY KEY (`ref_id`)
		) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
	
		$res_sql = $this->manage_mdl->run_query($sql,False,$target_db);
		
		//print_test($res_sql);
		//Add initial values
		$sql1="";
		if(!empty($ref_value['values'])){
		$sql1="INSERT INTO ".$table_name." ( ref_value, ref_desc) VALUES ";
		$ri=1;
		foreach ($ref_value['values'] as $r_key => $r_value) {
			if($ri==1){
				$sql1.="('".$r_value."','".$r_value."')";
			}else{
				$sql1.=",('".$r_value."','".$r_value."')";
			}
			$ri++;
		}
		$sql1.=";";
		$res_sql = $this->manage_mdl->run_query($sql1,False,$target_db);
		}
		
		
			//Add in the list of reference tables
	
		//print_test($res_sql);
				$sql2=" INSERT INTO ref_tables (reftab_label, reftab_table, reftab_desc, reftab_active) VALUES
('".$ref_conf."', '".$ref_conf."', '".$desc."', 1);";
	
				$res_sql = $this->manage_mdl->run_query($sql2,False,$target_db);
				
				//print_test($res_sql);
			return "$del_line $sql $sql1 $sql2";
	}
	
	private function create_table_config($config,$target_db='current'){
	
		$target_db=($target_db=='current')?project_db():$target_db;
		//	print_test($config);
		$table_id=$config['table_id'];
		$del_line="DROP TABLE IF EXISTS ".$config['table_name'].";";
		$res_sql = $this->manage_mdl->run_query($del_line,False,$target_db);
		
		$sql="CREATE TABLE IF NOT EXISTS ".$config['table_name']." (
		$table_id int(11) NOT NULL AUTO_INCREMENT,";
		$field_default="   ";
		$field_type="  ";
		foreach ($config['fields'] as $key => $value) {
				
			if($key!=$table_id AND $key != $config['table_active_field'] ){
				//start with select
				if($value['input_type']=='select'){
					if($value['input_select_source']=='array'){//static
						$i=1;
						$field_type=" enum(";
						foreach ($value['input_select_values'] as $k => $v) {
							if($i==1)
								$field_type.="'".$k."'";
							else
								$field_type.=",'".$k."'";
								
							$i++;
						}
	
						$field_type.=") ";
						$field_default="   DEFAULT NULL ";
						if(!empty($value['initial_value'])){
							
							$field_default="   NOT NULL DEFAULT '".$value['initial_value']."' ";
						}
					}elseif($value['input_select_source']=='yes_no'){
						$field_type=" int(2) ";
						$field_default="  DEFAULT NULL ";
						if(!empty($value['initial_value'])){
						
							$field_default="   NOT NULL DEFAULT '".$value['initial_value']."' ";
						}
						
						
						
					}else{//dynamic
						$field_type=" int(11) ";
						//$field_default="  DEFAULT '0' ";
						$field_default="  DEFAULT NULL ";
	
					}
						
				}elseif($value['input_type']=='date'){
					$field_type=" timestamp ";
					$field_default="  NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ";
					$field_default="  NOT NULL DEFAULT CURRENT_TIMESTAMP  ";
					
				}else{//Free category
					if(!empty($value['field_value'] ) AND $value['field_value'] == '0_1'){//Yes_no
	
					}elseif($value['field_type']=='number'){
						$field_type=" int(".$value['field_size'].") ";
						$field_default="   DEFAULT '0' ";
						if(!empty($value['initial_value'])){
						
							$field_default="   NOT NULL DEFAULT '".$value['initial_value']."' ";
						}
	
					}else{
						$field_type=" varchar(".$value['field_size'].") ";
						$field_default="   DEFAULT NULL ";
						if(!empty($value['initial_value'])){
						
							$field_default="   NOT NULL DEFAULT '".$value['initial_value']."' ";
						}
					}
						
						
				}
	
				if(!(isset($value['category_type']) AND  ($value['category_type']=='WithSubCategories' OR $value['category_type']=='WithMultiValues'))){
					$sql.=" ".$key." $field_type $field_default,";
				}
			}
				
				
				
		}
	
	
	
	
	
	
	
		$sql.=" ".$config['table_active_field']." int(1) NOT NULL DEFAULT '1',";
		$sql.=" PRIMARY KEY ($table_id)";
	
		$sql.=") ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
	
		$res_sql = $this->manage_mdl->run_query($sql,False,$target_db);
		
	
		return "$del_line $sql";
	}
	
	private function update_stored_procedure($config,$verbose=FALSE,$target_db='current',$add_constraint=False){
	
		$target_db=($target_db=='current')?project_db():$target_db;
	
		$old_configs=array();
		$new_configs=array();
		
	
		if($config=='init'){
			$old_configs=array('assignation','exclusion','papers');
			$new_configs=array('exclusioncrieria','papers_sources','search_strategy','papers','author','paper_author','venue','screen_phase','screening','screen_decison','str_mng','config','operations');
			
			//$configs=array('assignation','author','class_scheme','config','exclusion','papers','paper_author','ref_exclusioncrieria','str_mng','venue');
			//$configs=get_relis_common_configs();
		}else{
			$old_configs=array($config);
				
		}
		
		
		
		foreach ($old_configs as $k => $config) {
		
			/*
			 * Stored procedure to get list of element
			 */
			
			
			$this->manage_stored_procedure_lib->create_stored_procedure_get($config,TRUE,$verbose,$target_db);
	
			/*
			 * Stored procedure to count number of elements (used for navigation link)
			*/
			if($config=='papers')
				$this->manage_stored_procedure_lib->create_stored_procedure_count($config,TRUE,$verbose,$target_db);
	
			/*
			 * Stored procedure to remove element
			*/
				if($config!='papers')
			$this->manage_stored_procedure_lib->create_stored_procedure_remove($config,TRUE,$verbose,$target_db);
				
			/*
			 * Stored procedure to add element
			*/
			if($config!='papers')
			$this->manage_stored_procedure_lib->create_stored_procedure_add($config,TRUE,$verbose,$target_db);
				
	
			/*
			 * Stored procedure to update element
			*/
			if($config!='papers')
			$this->manage_stored_procedure_lib->create_stored_procedure_update($config,TRUE,$verbose,$target_db);
	
			/*
			 * Stored procedure to get detail element (select row)
			*/
			if($config!='papers')
			$this->manage_stored_procedure_lib->create_stored_procedure_detail($config,TRUE,$verbose,$target_db);
			
			
			if($add_constraint){
				//$this->manage_stored_procedure_lib->add_froreign_keys_constraint($config,TRUE,$verbose,$target_db);
			}
				
		}
		
		foreach ($new_configs as $k => $config) {
			if($config=='papers')
				$this->manage_stored_procedure_lib->create_stored_procedure_count($config,TRUE,$verbose,$target_db);
					
				create_stored_procedures($config,$target_db ,False);
					
					
		}
	
	}
	
	
	function remove_project($project_id){
		
		$data ['page'] = 'install/frm_install_result';
		$data['left_menu_admin']=True;
		$data['array_success']=array();

		//$detail_project=$this->DBConnection_mdl->get_row_details ( 'project',$project_id);
		$detail_project=$this->DBConnection_mdl->get_row_details ( 'get_detail_project',$project_id,true );
			
		//print_test($detail_project); exit;
		//$res=$this->DBConnection_mdl->remove_element($project_id,'project');
		$res=$this->DBConnection_mdl->remove_element($project_id,'remove_project',True);
		
		/*
		 * Message de confirmation ou erreur
		 */
		if($res){
			set_top_msg("Project ".$detail_project['project_title']." uninstalled !");
		}
		else{
			set_top_msg(" Operation failed ",'error');
		}
		
		
		array_push($data['array_success'], 'Project removed');
		$database_name=$this->config->item('project_db_prefix').$detail_project['project_label'];
		
		$sql = "DROP DATABASE $database_name";
		
		$res_sql=$this->manage_mdl->run_query($sql);
		
		array_push($data['array_success'], 'Database dropped');
		
		array_push($data['array_success'], 'Uninstall done');
		
		
		
		$data ['next_operation_button']="";
		
		
		
		$data ['page_title'] = lng('Uninstall the project : ').$detail_project['project_title'];
		
		
		
		$data ['next_operation_button'] = get_top_button ( 'all', 'Back to the list of projects ', 'manager/projects_list','Back to the list of projects','','',' btn-success ',FALSE );
		
		
		$this->load->view ( 'body', $data );
		
		
	}
	
	function remove_project_validation($project_id){
	
		$data ['page'] = 'install/frm_install_result';
		$data['left_menu_admin']=True;
		$detail_project=$this->DBConnection_mdl->get_row_details ( 'project',$project_id);
		
		$data['array_warning']=array('You want to unistall the project : '.$detail_project['project_title'].'  .The opération cannot be undone !');
		$data['array_success']=array();
		$data ['next_operation_button']="";
		
		
		
		$data ['page_title'] = lng('Uninstall the project : ').$detail_project['project_title'];
		
		
		$data ['next_operation_button'] = get_top_button ( 'all', 'Cancel', 'admin/projects_list','Cancel','','',' btn-danger ',FALSE );
		$data ['next_operation_button'] .=" &nbsp &nbsp &nbsp". get_top_button ( 'all', 'Continue uninstall', 'install/remove_project/'.$project_id,'Continue to uninstall','','',' btn-success ',FALSE );
		
		
		$this->load->view ( 'body', $data );
	
	
	}
	
	private function get_froreign_keys_constraint($config,$table_config){
	
	
	
		$sql_constraint_header = "ALTER TABLE ".$table_config['table_name'];
	
		$sql_constraint_drop="";
		$i=1;
		foreach ($table_config['fields'] as $key => $value) {
			if(!empty($value['input_type']) AND !empty($value['input_select_source'])AND !empty($value['input_select_values']) AND ($value['input_type'] == 'select') AND ($value['input_select_source'] =='table')){
				if(!(isset($value['category_type']) AND  ($value['category_type']=='WithSubCategories' OR $value['category_type']=='WithMultiValues'))){ //Le schamps qui sonts dans les tables association
		
					$conf=explode(";", $value['input_select_values']);
	
					$ref_table=$conf[0];
						
					if($ref_table!="users"){
						$constraint=$key;
	
						if($i!=1){
								
							$sql_constraint_drop.=',';
						}
	
						$sql_constraint_drop.=" DROP FOREIGN KEY  ".$config."_".$constraint."   ";
						$i++;
					}
				}
			}
				
		}
		$sql_query="";
		if(!empty($sql_constraint_drop)){
			$sql_query=$sql_constraint_header.$sql_constraint_drop.";";
		}
		
		return $sql_query;
	
	}
	
	
	private function populate_common_tables($target_db='current'){
		$target_db=($target_db=='current')?project_db():$target_db;
	//	$configs=array('assignment_screen','screening','assignment_screen_validate','screening_validate','operations');
		$configs=array('exclusioncrieria','papers_sources','search_strategy','papers','author','paper_author','venue','screen_phase','screening','screen_decison','operations');
		foreach ($configs as $key => $value) {
			//$tab_config=get_table_config($value);
			//$res=$this->create_table_config($tab_config,$target_db);
			//$res=$this->manage_stored_procedure_lib->create_table_config($tab_config,$target_db);
			
			//create tables
			
			
			$table_configuration=get_table_configuration($value);
			$res=create_table_configuration($table_configuration,$target_db);
			
		}
		
	}
	
	private function populate_common_tables_views($target_db='current'){
		$target_db=($target_db=='current')?project_db():$target_db;
		$configs=array('papers');
		foreach ($configs as $key => $value) {
			$table_configuration=get_table_configuration($value);
			if(!empty($table_configuration['table_views'])){
				foreach ($table_configuration['table_views'] as $key=> $view_value) {
						
					create_view($view_value,$target_db);
				}
			}
		}
		
	}
	
}
