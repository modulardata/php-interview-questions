<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Messages extends CI_Controller {

	public function __construct()
    {
      	parent::__construct();
	  	$this->load->model('Messages_Model');	   	
	  	
		$this->is_logged_in();
	  	
    }
	
	public function index()
	{
		$this->load->view('dashboard');
		
	}
	
	private function is_logged_in()
	{		  
        if(!$this->session->userdata('admin_logged_in'))
		{
            redirect('login/admin_login');
        }
    }
	
	public function inbox()
	{
		$data['inbox'] = $this->Messages_Model->get_all_messages(); 
		//echo '<pre/>';print_r($data['inbox']);exit;	
		$this->load->view('messages/inbox',$data);
	}
	
	public function view_message($msgId)
	{
		$data['message_info'] = $message_info = $this->Messages_Model->get_email_message($msgId); 
		$data['reply_message_info'] = $this->Messages_Model->get_reply_email_message($msgId); 
		//echo '<pre/>';print_r($data);exit;
		
		if($message_info->message_status == 'UR')
		{
			$this->Messages_Model->update_email_status($msgId,'R');
		}
		
		$this->load->view('messages/view_message',$data);
	}

	public function sent_message()
	{		
		$this->form_validation->set_rules('agent_details', 'To Email-Id', 'trim|required|xss_clean');
		$this->form_validation->set_rules('subject', 'Subject', 'trim|required');
		$this->form_validation->set_rules('message', 'Message', 'trim|required');
						
		$data['agents_info'] = $this->Messages_Model->get_agents_list();
			
		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('messages/sent_message', $data);
		}
		else
		{
			//echo '<pre/>';print_r($_POST);exit;
		   $agent_details = explode('&&',$this->input->post('agent_details'));
		   
		   $agent_id = $agent_details[0];		   
		   $to_email = $agent_details[1];
		   $to_name = $agent_details[2];
		   
		   $admin_id = $this->session->userdata('admin_id');
		   $from_name = 'Admin';
		   $from_email = $this->session->userdata('admin_email');
		   
		   $subject = $this->input->post('subject');
		   $message = $this->input->post('message');
		   
		   $sent_datetime = date('Y-m-d H:i:s');
		   $admin_id = $this->session->userdata('admin_id');
		   $send_data = array(
		   					'sub_id' => 0,
							'admin_id' => $admin_id,
							'agent_id' => $agent_id,
							'from_email' => $from_email,
							'from_name' => $from_name,
							'to_email' => $to_email,
							'to_name' => $to_name,
							'subject' => $subject,
							'message' => $message,
							'message_status' => 'UR',							
							'sent_datetime' => $sent_datetime
		   				);
		   
		   $this->Messages_Model->reply_message($send_data);
		   	
		   redirect('messages/inbox','refresh'); 			  
		   
			
		}		
		
	}
	
	public function reply_message()
	{		
		$this->form_validation->set_rules('message', 'Message', 'required|xss_clean');		
		
		$msg_id = $sub_id = $this->input->post('msg_id');					
		$data['message_info'] = $message_info = $this->Messages_Model->get_email_message($msg_id); 
		$data['reply_message_info'] = $this->Messages_Model->get_reply_email_message($msg_id); 
		
		if($this->form_validation->run() == FALSE)
		{			
			$this->load->view('messages/view_message',$data);
		}
		else
		{
		   //echo '<pre/>';print_r($_POST);exit;
		   $subject = $this->input->post('subject');		  
		   $agent_id = $this->input->post('agent_id');
		   $message = $this->input->post('message');
		   
		   if($message_info->admin_id != 0) 
		   {
			   $from_name = $message_info->from_name;
			   $from_email = $message_info->from_email;
			   $to_name = $message_info->to_name;
			   $to_email = $message_info->to_email;
		   }
		   else
		   {
			   $from_name = $message_info->to_name;
			   $from_email = $message_info->to_email;
			   $to_name = $message_info->from_name;
			   $to_email = $message_info->from_email;
		   }
		   
		   $replyed_datetime = date('Y-m-d H:i:s');
		   $admin_id = $this->session->userdata('admin_id');
		   $reply_data = array(
		   					'sub_id' => $sub_id,
							'admin_id' => $admin_id,
							'agent_id' => $agent_id,
							'from_email' => $from_email,
							'from_name' => $from_name,
							'to_email' => $to_email,
							'to_name' => $to_name,
							'subject' => $subject,
							'message' => $message,
							'message_status' => 'RE',
							'replyed_datetime' => $replyed_datetime,
							'sent_datetime' => $replyed_datetime
		   				);
		   
		   $this->Messages_Model->reply_message($reply_data);
		   	
		   redirect('messages/view_message/'.$msg_id,'refresh'); 
			
		}		
		
	}
	
	public function delete_message($msgId)
	{
		$data['message_info'] = $message_info = $this->Messages_Model->get_email_message($msgId); 
		
		$this->Messages_Model->update_email_status($msgId,'T');
		
		 redirect('messages/inbox','refresh'); 
	}
	
}

/* End of file home.php */
/* Location: ./admin/controllers/home.php */