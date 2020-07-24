<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email extends CI_Controller {

	public function __construct()
    {
      parent::__construct();
	  $this->load->database(); 
	  $this->check_isvalidated();
	  $this->load->library('form_validation');
    }
	
	
	  private function check_isvalidated(){
				if(! $this->session->userdata('admin_logged_in') && ! $this->session->userdata('sa_logged_in'))
			   {
					   redirect('login/index');
			   }
   		 }
		  public function get_email_acess()
		{
	   
			$this->db->select('*')
				->from('email_access');
			
			$query = $this->db->get();
	
		  if ( $query->num_rows > 0 ) {
		  
			 return $query->row();
		  }
		  return false;
	   }
	   function update_email()
	   {
		   
	   }
		 function send_email($subject,$to,$message,$attach='')
		 {
			 
			$access = $this->get_email_acess();
			$this->load->library('email');
			$config['protocol'] = 'sendmail';
			$config['mailpath'] = '/usr/sbin/sendmail';
			$config['charset'] = 'iso-8859-1';
			$config['wordwrap'] = TRUE;
			$config['protocol'] = $access->smtp;
			$config['smtp_host'] = $access->host;
			$config['smtp_port'] = $access->port;
			$config['smtp_user'] = $access->username;
			$config['smtp_pass'] = $access->password;
			$config['charset'] = 'utf-8';
			$config['newline'] = "\r\n";
			$this->email->initialize($config);
			$this->email->from('ruby.provab@gmail.com', '1Degree');
			$this->email->to($to); 
			$this->email->subject($subject);
			$this->email->message($message);
			if($attach!='')
			{	
			  $this->email->attach($attach);
			}
			if($this->email->send())
			{
				return true;
			}
			else
			{
			  	return false;
			}
			 
		 }
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */