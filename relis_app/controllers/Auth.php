<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct()
		{
		parent::__construct();
		
		$this->load->library('form_validation');
		}
		
	/*
	 * Page d'authentification
	 * 
	 * */
	public function index()
	{
	
		
		if(($this->session->userdata('user_id')))
		
		{
			//Si l'utilisateur a déjà une session ouverte il est redirigé vers la page d'acceuil
			redirect('home');
		}else
		{
			/*
			 * For first connection create stored procedure for admin database
			 * 
			 */
			
			/* Affichage du formulaire de connexion 
			 * 
			 * */
		
		$data['page']='login';
		
		/*
		 * Chargement de la vue d'authentification
		 */
		$this->load->view('login',$data);
		}	
	}
	
	
	/*
	 * Fonction de verification du mot de passe et nomt d'utilisateur entrée pour la connexion
	 */
	public function check_form(){
		/*
		 * Récupération des valeurs saisie per l'utilisateur
		 */
		$content=$this->input->post();
		
		
		
		/*
		 * Verification si toutes les valeurs ont été saisie avec "form validator" de codeIgniter
		 */
		$this->form_validation->set_rules('user_username', 'Username', 'trim|required');
		$this->form_validation->set_rules('user_password', 'Password', 'trim|required');
	
		if ($this->form_validation->run() == FALSE)
		{
			/*
			 * Si toutes les valeurs ne sont pas saisies  retour vers le formulaire de connexion
			 */
			$this->load->view('login');
		}
		else
		{
			
			/*
			 * Vérification si login et password sont correct
			 */
			
			$user = $this->DBConnection_mdl->check_user_credentials($this->input->post());
				
			//print_test($user);
			if(empty($user)){
					
					
				$data['err_msg'] = 'Username or Password not correct !';
				$this->load->view('login',$data);
					
			}
			else{
					
				if(empty($user['user_state']))	{
					$this->validate_user($user);
					
				}else{
					$this->session->set_userdata($user);
					$this->session->set_userdata('page_msg_err','');
					$this->session->set_userdata('last_url',"");
					$this->session->set_userdata('msg'," Logged in successfully");
					$this->session->set_userdata('submit_mode','normal');
					$this->session->set_userdata('language_edit_mode','no');
					$this->session->set_userdata('language_edit_mode','class');
					//used for redirection after saving data
					$this->session->set_userdata('after_save_redirect','');
					$this->session->set_userdata('current_screen_phase','');
					$this->session->set_userdata('debug_paper_code','init');
					$this->session->set_userdata('debug_paper_url','init');
					//$this->session->set_userdata('project_db','mt');
					//$this->session->set_userdata('project_db','stm');
					
					//	$configuration = get_appconfig();
					if(!empty($user['user_default_lang']))
						$default_lang=$user['user_default_lang'];
						else
							$default_lang='en';
					
								
							if(get_adminconfig_element('first_connect')){
								admin_initial_db_setup();
							}
					
							$this->session->set_userdata('active_language',$default_lang);
							set_log('Connection','User connected');
							redirect('home');
					
				}
				
				
				
					
			}
	
				
		}
	}
	
	
	
	/*
	 * Fonction de verification de connection pour un utilisateur de demonstration
	 */
	public function demo_user(){
		
			
			/*
			 * Vérification si login et password sont correct
			 */
			$user_id=6;	
			$user = $this->DBConnection_mdl->get_row_details( 'get_user_detail'
					,$user_id ,true,'users');
	
			
			if(empty($user)){
					
					
				$data['err_msg'] = 'Username or Password not correct !';
				$this->load->view('login',$data);
					
			}
			else{
					
				if(empty($user['user_state']))	{
					$this->validate_user($user);
						
				}else{
					$this->session->set_userdata($user);
					$this->session->set_userdata('page_msg_err','');
					$this->session->set_userdata('last_url',"");
					$this->session->set_userdata('msg'," Logged in successfully");
					$this->session->set_userdata('submit_mode','normal');
					$this->session->set_userdata('language_edit_mode','no');
					$this->session->set_userdata('language_edit_mode','class');
					//used for redirection after saving data
					$this->session->set_userdata('after_save_redirect','');
					$this->session->set_userdata('current_screen_phase','');
					$this->session->set_userdata('debug_paper_code','init');
					$this->session->set_userdata('debug_paper_url','init');
					//$this->session->set_userdata('project_db','mt');
					//$this->session->set_userdata('project_db','stm');
						
					//	$configuration = get_appconfig();
					if(!empty($user['user_default_lang']))
						$default_lang=$user['user_default_lang'];
						else
							$default_lang='en';
								
	
							if(get_adminconfig_element('first_connect')){
								admin_initial_db_setup();
							}
								
							$this->session->set_userdata('active_language',$default_lang);
							set_log('Connection','User connected');
							redirect('home');
								
				}
	
	
	
					
			}
	
	
		
	}
	
	/*
	 * 
	 * Déconnexion : réinitialisation de la session de l'utilisateur
	 * 
	 */
	public function discon()
	{	
		
		
		set_log('Disconnection','User disconnected');
		
		$this->session->sess_destroy();
		
		$this->session->set_userdata('user_id',0);
		
		redirect('auth');
		
	}
	
	//To delete
	public function add_screen_size($height=0,$width=0,$loadTime=0)
	{
	
	
		
	
		$this->session->set_userdata('screen_height',$height);
		$this->session->set_userdata('screen_width',$width);
		$this->session->set_userdata('server_request_time',$_SERVER['REQUEST_TIME']);
		$this->session->set_userdata('server_request_time_ready',time());
		echo "done";
	
	}
	
	//To delete
	public function add_screen_size_load()
	{
	
	
		

		$this->session->set_userdata('server_request_time',$_SERVER['REQUEST_TIME']);
		$this->session->set_userdata('server_request_time_load',time());
		echo "done";
	
	}
	
	
	/*
	 * Formulaire pour ajouter un nouvel utilisateur
	 *
	 * */
	public function new_user($data=array())
	{
	
	
		if(($this->session->userdata('user_id')))
	
		{
			//Si l'utilisateur a déjà une session ouverte il est redirigé vers la page d'acceuil
			redirect('home');
		}else
		{
			$data['page']='login';
	
			$this->load->view('create_user',$data);
		}
	}
		
	/*
	 * Ajout d'un nouvel utilisateur
	 */
	public function check_create_user(){
		/*
		 * Récupération des valeurs saisie per l'utilisateur
		 */
		$post_arr=$this->input->post();
		//print_test($post_arr);// exit;
		$this->load->library ( 'form_validation' );

		$data ['err_msg'] = '';//for users
		
		
		$this->form_validation->set_rules ( 'user_name','Name', 'trim|required' );
		$this->form_validation->set_rules ( 'user_mail','Email', 'trim|valid_email' );
		$this->form_validation->set_rules ( 'user_username','Username', 'trim|required' );
		$this->form_validation->set_rules ( 'user_password','Password', 'trim|required|matches[user_password_validate]' );
		$this->form_validation->set_rules ( 'user_password_validate','Validate password', 'trim|required' );
		
		
		///vérify if the username is unique
		if ($this->form_validation->run () == FALSE ) {
			$data ['content_item'] = $post_arr;
			$this->new_user($data);
		}else{
			if ( !empty( $post_arr ['user_username']) AND !$this->bm_lib->login_available($post_arr ['user_username'])) {
				$data ['content_item'] = $post_arr;
				$data ['err_msg'] .= 'Username already used <br/>';
				$this->new_user($data);
				
			}else{
				
				
				
				$user_array=array(
						'user_name'=>$post_arr['user_name'],
						'user_mail'=>$post_arr['user_mail'],
						'user_username'=>$post_arr['user_username'],
						'user_usergroup'=>2,
						'user_state'=>0,
						'user_password'=>md5($post_arr['user_password'])
						
				);
				//add user in the db
				$this->db->insert('users', $user_array);
				$user_id=$this->db->insert_id();
				
				$confimation_code=$res=$this->bm_lib->random_str(12);;
		
				$this->db->insert('user_creation', array(
						'creation_user_id'=>$user_id,
						'confirmation_code'=>$confimation_code,
						'confirmation_expiration'=>time() + 86400,
						'confirmation_try'=>0,
				));
				
				
				
				//send message for confirmationm
				
				$message="
					<h2>Relis Validation message</h2>
					<p>
					Wecome to ReLiS:<br/>
					Your validation code is : <b>$confimation_code</b>
					</p>";
				$subject="Validation code";
				
				$destination=array($user_array['user_mail']);
				$res=$this->bm_lib->send_mail($subject,$message,$destination);
				$data ['user_id']=$user_id;
				$data ['success_msg']='A validation code has ben sent to your email:<br/>Please type the validation code';
				$this->validate_user($data);
				
				echo "Correct ready to save and validate";
			}
			
		}
		
		
		
		
		
		
	
	}
	
	
	/*
	 * Formulaire pour valider un compte qui vient d'être créer
	 *
	 * */
	public function validate_user($data=array())
	{
		//print_test($data);
		$user_id=$data['user_id'];
		
		$data['page']='validate_user';
		
		$this->load->view('validate_user',$data);
	}
	
	
	/*
	 * Ajout d'un nouvel utilisateur
	 */
	public function check_validation(){
		/*
		 * Récupération des valeurs saisie per l'utilisateur
		 */
		
		$post_arr=$this->input->post();
//	print_test($post_arr);
		$data=$post_arr;
		$data ['err_msg'] = '';//for users
		if(!empty($post_arr['user_id']) AND !empty($post_arr['validation_code']) ){
			
			$res = $this->db->get_where('user_creation',
					array('creation_user_id' => $post_arr['user_id'],'user_creation_active'=>1))
					->row_array();
			if(!empty($res)){
				if($res['confirmation_code']==$post_arr['validation_code']){
					//Validation success
					
					//activate user
					$this->db->update('users',
							array('user_state'=>1),
							array('user_id' => $post_arr['user_id']));
					
					//remove activation user informations
					$this->db->update('user_creation',
							array('user_creation_active'=> 0),
									array('user_creation_id' => $res['user_creation_id']));
							
					$data['success_msg']="Accound validated you can now user ReLiS";
					//print_test($data);
					$this->load->view('login',$data);
				}else{
					$data ['err_msg'].='Wrong validation code';
					//increment confirmation attempts
					$this->db->update('user_creation', 
							array('confirmation_try'=> $res['confirmation_try']+1),
							array('user_creation_id' => $res['user_creation_id']));
					$this->validate_user($data);
				}
				
			}else{
				
				$data ['err_msg'].='Validation Error please provide validation code';
				$this->validate_user($data);
			}
		}else{
			
			$data ['err_msg'].='Validation Error please provide validation code';
			$this->validate_user($data);
		}
		
	
	}
	
}
