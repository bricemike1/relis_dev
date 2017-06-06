<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bm_lib
{
	public function __construct()
	{
		
		$this->CI =& get_instance();
		
		if(!in_array($this->CI->router->fetch_class(), $this->CI->config->item('free_controllers'))){
			
			$this->checkauthentification();
			
		}
		
		$sections = array(
				'config'  => FALSE,
				'http_headers'  => FALSE,
				'session_data' => FALSE,
				'queries' => FALSE
		);
		
	//	$this->CI->output->set_profiler_sections($sections);
	//$this->CI->output->enable_profiler(true);
	//$time=time();
	//$this->CI->session->set_userdata('request_time',  time());
	
	}
		
	/*
	 * Vérifiaction si l'utilisateur encours est authentifier, si non redirection vers la page d'authentification
	 */
	function checkauthentification()
	{
		if(!($this->CI->session->userdata('user_id'))){
			redirect('auth/');
		}
	}

	
	/*
	 * Géneration de la pagination des pages
	 */
		function get_pagination($url, $total_rows,$uri_segment=3){

		$this->CI->load->library('pagination');
		$config['uri_segment'] = $uri_segment;
		$config['base_url'] = base_url().$url;
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $this->CI->config->item('rec_per_page');
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['full_tag_open'] = '<ul class="pagination pagination_mine">';
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li class="paginate_button">';
		$config['num_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li class="paginate_button">';
		$config['prev_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li class="paginate_button">';
		$config['next_tag_close'] = '</li>';

		$config['first_tag_open'] = '<li class="paginate_button">';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="paginate_button">';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open']="<li class='paginate_button active'><a>";
		$config['cur_tag_close']="</a></li>";
		$config['num_links'] = 3;
		
		$this->CI->pagination->initialize($config);
		echo $this->CI->pagination->create_links();
		
		}
		
		
		/*
		 * Verification si un nom d'utilisateur est déjà utilisé ou pas
		 */
		function login_available($login){
				$result=$this->CI->DBConnection_mdl->login_available($login);
				
				return $result;
				
			}
			
			
			
			

		}
	