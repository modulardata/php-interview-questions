<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
    {
      parent::__construct();
	  $this->load->model('Home_Model');
	}
	
	public function index()
	{
		$this->form_validation->set_rules('loginEmailId', 'Email-Id', 'trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('loginPassword', 'Password', 'trim|required|xss_clean');
		
		$data['status']='';
		if($this->form_validation->run() !== FALSE) 
		{		
		    $loginEmailId =  $this->input->post('loginEmailId');
			$loginPassword =  $this->input->post('loginPassword');
			
			$res = $this->Home_Model->validate_credentials($loginEmailId,$loginPassword); 
			//echo '<pre/>';print_r($res);exit;
			if($res !== false) 
			{				
				$sessionAdminInfo = array( 
							'admin_id' 			=> $res->admin_id,
							'admin_email'	 	=> $res->login_email,
							'admin_name'	 	=> $res->first_name,
							'role_id'	 		=> $res->role_id,
							'admin_logged_in' 	=> TRUE
						);
				$this->session->set_userdata($sessionAdminInfo);
				
				$this->Home_Model->insert_login_activity();
					  
				redirect('home/dashboard', 'refresh'); 
				
			}
			else
			{
			    $data['status']= 'Login Failed. Please check Login details';
          	}

		}
				
		$this->load->view('login',$data);
	
	}	
	
	public function admin_login()
	{		
		$this->form_validation->set_rules('loginEmailId', 'Email-Id', 'trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('loginPassword', 'Password', 'trim|required|xss_clean');
		
		$data['status']='';
		if($this->form_validation->run() !== FALSE) 
		{		
		    $loginEmailId =  $this->input->post('loginEmailId');
			$loginPassword =  $this->input->post('loginPassword');
			
			$res = $this->Home_Model->validate_credentials($loginEmailId,$loginPassword); 
			//echo '<pre/>';print_r($res);exit;
			if($res !== false) 
			{				
				$sessionAdminInfo = array( 
							'admin_id' 			=> $res->admin_id,
							'admin_email'	 	=> $res->login_email,
							'admin_name'	 	=> $res->first_name,
							'role_id'	 		=> $res->role_id,
							'admin_logged_in' 	=> TRUE
						);
				$this->session->set_userdata($sessionAdminInfo);
				
				$this->Home_Model->insert_login_activity();
				//echo 'Inside'; exit;	  
				redirect('home/dashboard', 'refresh'); 
				
			}
			else
			{
			    $data['status']= 'Login Failed. Please check Login details';
          	}

		}
                //echo 'Outside'; exit;
				
		$this->load->view('login',$data);
	
	}
	
	public function admin_logout()
    {
        $this->session->unset_userdata('admin_id');
		$this->session->unset_userdata('admin_email');
		$this->session->unset_userdata('admin_name');
		$this->session->unset_userdata('role_id');
		$this->session->unset_userdata('admin_logged_in');
		$this->session->sess_destroy();
        redirect('home/index', 'refresh'); 
    }
	
}

/* End of file login.php */
/* Location: ./admin/controllers/login.php */