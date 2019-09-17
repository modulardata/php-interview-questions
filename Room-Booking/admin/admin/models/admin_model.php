<?php

class Admin_Model extends CI_Model {
	
	public function __construct()
    {
	
      parent::__construct();
    }
	public function get_domain_list()
   	{
   
		$this->db->select('*')
		->from('domain')
		->join('admin', 'domain.domain_id  = admin.domain')
		->group_by('domain_name');
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         return $query->result();
      }
      return false;
   }
   public function get_admin_list()
   	{
   
		$this->db->select('*')
		->from('admin')
		->where('usertype', 1)
		->join('domain', 'domain.domain_id  = admin.domain', 'left');
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         return $query->result();
      }
      return false;
   }
    public function get_currency_list()
   	{
   
		$this->db->select('*')
		->from('currency_converter');
		
		
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         return $query->result();
      }
      return false;
   }
   
     function update_admin_password(  $password='',$id)
	{
	
	
		if (!empty($password)) {
			
			$data['password'] = $password;	
			$where = "user_id = '".$id."'";
		if ($this->db->update('admin', $data, $where)) {
		//	echo $this->db->last_query();exit;
			return true;
		} else {
			return false;
		}		
		}
			
		else {
			return false;
		}

	}
     public function get_admin_list_id($id)
   	{
   
		$this->db->select('*')
		->from('admin')
		->where('usertype', 1)
		->where('user_id', $id)
		->join('domain', 'domain.domain_id  = admin.domain', 'left');
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         return $query->row();
      }
      return false;
   }
   function update_admin_profile( $firstname,  $email, $contact_no, $address, $id)
	{
	
		$data = array(
			'firstname' => $firstname,
		
			'email' => $email,
			'contact_no' => $contact_no,
			'address' => $address
			);
		
		
			
			$where = "user_id = ".$id;
		if ($this->db->update('admin', $data, $where)) {
			return true;
		} else {
			return false;
		}

	}
     public function check_admin_login($id)
   	{
   
		$this->db->select('*')
			->from('admin')
            ->where('domain', $id)
			->where('usertype', 1)
			->where('status', 1)
			->join('domain', 'domain.domain_id  = admin.domain', 'left')
			->limit(1);
		$query = $this->db->get();

      if ( $query->num_rows > 0 ) {
      
         return $query->row();
      }
      return false;
   }
   function add_new_admin($name,$pw3,$email3,$address,$phone,$domain)
   {
	   	$data = array(
		'firstname' => $name,
		'password' => $pw3,
		'email' => $email3,
		'address' => $address,
		'contact_no' => $phone,
		'domain' => $domain,
		'usertype' => '1',
		'status' => '1',
		'last_visit_date' => ''
		);
			
		$this->db->set('register_date', 'NOW()', FALSE); 
		
		$this->db->insert('admin', $data);
		$id = $this->db->insert_id();
		if (!empty($id)) {				
			return true;
		} else {
			return false;
		}
   }
	
		
}

