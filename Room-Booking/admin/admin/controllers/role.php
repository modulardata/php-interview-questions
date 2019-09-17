<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Role extends CI_Controller {

	public function __construct()
    {
      parent::__construct();
	  $this->load->database(); 
	  $this->load->model('Role_Model');
	  $this->load->model('Home_Model');
	  
	  $this->is_admin_logged_in();   	
	  
    }
	
	private function is_admin_logged_in()
	{		
		if(!$this->session->userdata('admin_logged_in'))
	   	{
		   redirect('login/index');
       	}		
		
    }
		
	public function index()
	{
		redirect('home/dashboard');
			
	}
	
	// Add New Admin User	
	function add_admin_user()
	{		
		$this->form_validation->set_rules('admin_email', 'Email', 'trim|required|valid_email|is_unique[admin_info.login_email]|xss_clean');
		$this->form_validation->set_rules('admin_password', 'Password', 'trim|required|matches[passconf]');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');
		$this->form_validation->set_rules('role_id', 'Admin User Level', 'required');
		
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('mobile_no', 'Mobile No', 'trim|required|integer|min_length[10]');
	
		$this->form_validation->set_rules('address', 'Address', 'trim|required');
		$this->form_validation->set_rules('pin_code', 'Pincode', 'trim|required|integer|min_length[6]');
		$this->form_validation->set_rules('city', 'City', 'trim|required');
		$this->form_validation->set_rules('state', 'State', 'trim|required');
		$this->form_validation->set_rules('country', 'Country', 'required');
		
		$data['status']='';
		$data['errors']='';
		$data['country_list'] = $this->Home_Model->get_country_list(); 		
		
		if($this->form_validation->run()==FALSE)
		{			
			$data['admin_email'] = $this->input->post('admin_email');		   
		   	$data['first_name'] = $this->input->post('first_name');
			$data['middle_name'] = $this->input->post('middle_name');
		   	$data['last_name'] = $this->input->post('last_name');
		   	$data['mobile_no'] = $this->input->post('mobile_no');		
		   	$data['address'] = $this->input->post('address');
		   	$data['pin_code'] = $this->input->post('pin_code');		   
		   	$data['city'] = $this->input->post('city');
		   	$data['state'] = $this->input->post('state');
			
			$this->load->view('role/add_admin_user',$data);
		}
		else
		{
			//echo '<pre/>';print_r($_POST);exit;			
			$admin_email = $this->input->post('admin_email');
			$admin_password = md5($this->input->post('admin_password'));
		   	$role_id = $this->input->post('role_id');
			
			$title = $this->input->post('title');
		   	$first_name = $this->input->post('first_name');
			$middle_name = $this->input->post('middle_name');
		   	$last_name = $this->input->post('last_name');
		   	$mobile_no = $this->input->post('mobile_no');		  
		   	$address = $this->input->post('address');
		   	$pin_code = $this->input->post('pin_code');		   
		   	$city = $this->input->post('city');
		   	$state = $this->input->post('state');
			$country = $this->input->post('country');
						
			$email_check = $this->Role_Model->check_email_availability($admin_email);
				
			if($email_check != '' || !empty($email_check))
			{				
				$data['errors'] = 'Email Already Exists. Please use different email id to continue ...';
				$this->load->view('role/add_admin_user',$data);
			}
			else
			{
				if($this->Role_Model->add_admin_user($admin_email,$admin_password,$title,$first_name,$middle_name,$last_name,$mobile_no,$address,$pin_code,$city,$state,$country,$role_id))
				{
					redirect('role/admin_user_manager','refresh');
				}
				else
				{
					$data['errors'] = 'Admin User Registration Not Done. Please try after some time...';
					$this->load->view('role/add_admin_user',$data);
				
				}
			}
		}
	}
	
	public function admin_user_manager()
	{
		$data['admin_user_info'] = $this->Role_Model->get_admin_user_info(); 
		//echo '<pre/>';print_r($data['admin_user_info']);exit;	
		$this->load->view('role/admin_user_manager',$data);
	}
	
	public function view_admin_info($admin_id='',$status='',$errors='')
	{
		$data['status']= $status;
		$data['errors']= $errors;
		$data['country_list'] = $this->Home_Model->get_country_list(); 
		
		$data['admin_id']= $admin_id;
		$data['admin_info'] = $this->Role_Model->get_admin_info_by_id($admin_id); 
		//echo '<pre/>';print_r($data['admin_info']);exit;	
		$this->load->view('role/view_admin_info',$data);
	}
	
	public function update_admin_info()
	{		
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('mobile_no', 'Mobile No', 'trim|required|integer|min_length[10]');	
		$this->form_validation->set_rules('address', 'Address', 'trim|required');
		$this->form_validation->set_rules('pin_code', 'Pincode', 'trim|required|integer|min_length[6]');
		$this->form_validation->set_rules('city', 'City', 'trim|required');
		$this->form_validation->set_rules('state', 'State', 'trim|required');
		$this->form_validation->set_rules('country', 'Country', 'required');
		
		
		$data['status']='';
		$data['errors']='';
		$data['country_list'] = $this->Home_Model->get_country_list(); 
			
		$data['admin_id'] = $admin_id = $this->input->post('admin_id');
		$data['admin_info'] = $this->Role_Model->get_admin_info_by_id($admin_id); 
		
		if($this->form_validation->run()==FALSE)
		{			
			$this->load->view('role/view_admin_info',$data);
		}
		else
		{
			//echo '<pre/>';print_r($_POST);exit;			
			$admin_id = $this->input->post('admin_id');			
			$title = $this->input->post('title');
		   	$first_name = $this->input->post('first_name');
			$middle_name = $this->input->post('middle_name');
		   	$last_name = $this->input->post('last_name');
		   	$mobile_no = $this->input->post('mobile_no');		  
		   	$address = $this->input->post('address');
		   	$pin_code = $this->input->post('pin_code');		   
		   	$city = $this->input->post('city');
		   	$state = $this->input->post('state');
			$country = $this->input->post('country');
			
			$admin_email = $this->input->post('admin_email');
						
			if($this->Role_Model->update_sub_admin($admin_id,$title,$first_name,$middle_name,$last_name,$mobile_no,$address,$pin_code,$city,$state,$country))
			{
				redirect('role/view_admin_info/'.$admin_id.'/1','refresh');
			}
			else
			{
				$data['errors'] = 'Sub Admin Profile Not Updated. Please try after some time...';
				$this->load->view('role/view_admin_info',$data);
			
			}
			
		}
	}
	
	function change_admin_password($admin_id='')
	{
		$this->form_validation->set_rules('password', 'New Password', 'trim|required|matches[passconf]');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');
		
		$data['status']='';
		$data['errors']='';
		
		$data['admin_id']=$admin_id;
		$data['admin_info'] = $admin_info = $this->Role_Model->get_admin_info_by_id($admin_id); 
		
		if($this->form_validation->run() == FALSE)
		{			
			$this->load->view('role/change_admin_password', $data);
		}
		else
		{			
			if($this->input->post('password') == $this->input->post('passconf'))
			{			
			   $password = md5($this->input->post('password'));			   
			   if($this->Role_Model->update_admin_password($admin_id,$password)) 
			   {				   
				   $data['status']=1;
			   }
			   else
			   {				 
				   $data['errors']='Sub Admin Password not Updated. Please try after some time...';
			   }
			}
			else
			{
			   $data['errors']='Current Password is wrong. Please enter correct current password...';				
			}
			
			$this->load->view('role/change_admin_password', $data);
		}		
				
	}
   
	
	function manage_admin_user_status()
	{
		if(isset($_POST['admin_id']) && isset($_POST['status']))
		{
			$admin_id = $_POST['admin_id'];
			$status = $_POST['status'];		
			$update = $this->Role_Model->manage_admin_user_status($admin_id,$status);
			echo $update;
		}
		else
		{
			return false;
		}		
					
	}
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */