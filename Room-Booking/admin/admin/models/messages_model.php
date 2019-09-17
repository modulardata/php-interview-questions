<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Messages_Model extends CI_Model {
	
	public function __construct()
    {	
      parent::__construct();
	  
    }
	
	public function get_all_messages()
   	{   
		$this->db->select('*')
				  ->from('inbox')
				  ->where('sub_id',0);		
		$query = $this->db->get();

      if($query->num_rows > 0 ) 
	  {     
         return $query->result();
      }
	  
      return false;	  
   }	
   
   public function get_email_message($msgId)
   	{   		
		$this->db->select('*')
				->from('inbox')
				->where('id',$msgId)				
				->limit('1');
		$query = $this->db->get();

      	if($query->num_rows > 0) 
		{      
         	return $query->row();
		}
						
      	return '';		
   } 	
   
   public function get_reply_email_message($msgId)
   	{   		
		$this->db->select('*')
				->from('inbox')
				->where('sub_id',$msgId)				
				->order_by('id','ASC');
		$query = $this->db->get();

      	if($query->num_rows > 0) 
		{      
         	return $query->result();
		}
						
      	return '';		
   } 
   
   public function reply_message($reply_data)
   {   		
		$this->db->insert('inbox', $reply_data);
		return true;		
   } 
   
   public function update_email_status($msgId,$status)
   {
		$data['message_status'] = $status;	
		$where = "id = '$msgId'";
		if($this->db->update('inbox', $data, $where)) 
		{
			return true;
		} 
		else 
		{
			return false;
		}		

   }
   
   public function get_agents_list()
   {   		
		$this->db->select('*')
				->from('agent_info')	
				->where('status',1);			
		$this->db->order_by('agent_id', 'DESC');		
		$query = $this->db->get();

      if($query->num_rows > 0) 
	  {	  
         return $query->result();
      }
	  
      return false;
  }	
		
}

