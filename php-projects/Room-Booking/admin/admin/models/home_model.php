<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_Model extends CI_Model {
	
	public function __construct()
    {	
      parent::__construct();
	  
    }
	
	public function validate_credentials($loginEmailId,$loginPassword)
    {   
		$this->db->select('*')
				->from('admin_info')
				->where('login_email', $loginEmailId)
            	->where('login_password', md5($loginPassword))
				->where('status', 1)
				->limit(1);
		$query = $this->db->get();

      	if($query->num_rows > 0)
		{      
         	return $query->row();
      	}
		
      	return false;
		
   } 
   
   public function insert_login_activity()
   {
	   $admin_id = $this->session->userdata('admin_id');
	   $session_id = $this->session->userdata('session_id');
	   $ip_address = $this->session->userdata('ip_address');
	   $user_agent = $this->session->userdata('user_agent');
	   $remote_ip = $_SERVER['REMOTE_ADDR'];
	   
	   $data = array('session_id' => $session_id,
	   				 'admin_id' => $admin_id,	   				 
					 'ip_address' => $ip_address,
					 'remote_ip' => $remote_ip,
					 'user_agent' => $user_agent
					 );
					 
	   if($this->db->insert('admin_login_history', $data)) 
	   {
		  return true;
	   } 
	   else 
	   {
		  return false;
	   }

	}
	
	public function get_admin_info($admin_id)
    {   
		$this->db->select('*')
				 ->from('admin_info')
				 ->where('admin_id', $admin_id)
				 ->where('status', 1)
				 ->limit(1);
		$query = $this->db->get();

	  if ($query->num_rows > 0) 
	  {      
		 return $query->row();
	  }
	  return false;
	  
    }
	
	public function update_admin_profile($login_email, $title, $first_name, $middle_name, $last_name, $mobile_no, $address, $pin_code, $city, $state)
	{
	
		$data = array(
			'login_email' => $login_email,		
			'title' => $title,
			'first_name' => $first_name,
			'middle_name' => $middle_name,
			'last_name' => $last_name,
			'mobile_no' => $mobile_no,
			'address' => $address,
			'pin_code' => $pin_code,
			'city' => $city,
			'state' => $state
			);
				
		$admin_id = $this->session->userdata('admin_id');
		$where = "admin_id = '$admin_id'";
		
		if($this->db->update('admin_info', $data, $where)){
			return true;
		}else{
			return false;
		}

	}
	
	public function update_admin_password($admin_id,$password='')
	{
		if(!empty($password)) 
		{
			$data['login_password'] = $password;	
			$where = "admin_id = '$admin_id'";
			if($this->db->update('admin_info', $data, $where)) 
			{
				return true;
			} 
			else 
			{
				return false;
			}		
		}			
		else 
		{
			return false;
		}

	}
	
	public function get_country_list()
   	{   
		$this->db->select('*')
				->from('country');
		$query = $this->db->get();

      	if($query->num_rows > 0 ) 
		{      
         	return $query->result();
      	}
		
      	return false;
   }
   
   public function get_currency_list()
   	{   
		$this->db->select('*')
				->from('currency');
		$query = $this->db->get();

      	if($query->num_rows > 0 ) 
		{      
         	return $query->result();
      	}
		
      	return false;
   }
   
   public function manage_currency_status($currency_id,$status)
   {
		$data['status'] = $status;	
		$where = "currency_id = '$currency_id'";
		if($this->db->update('currency', $data, $where)) 
		{
			return true;
		} 
		else 
		{
			return false;
		}		

   }
   
   public function update_currency_values($currency_id,$currency_val)
   {
		$data['value'] = $currency_val;	
		$where = "currency_id = '$currency_id'";
		$this->db->set('updated_datetime', 'Now()', FALSE);
		if($this->db->update('currency', $data, $where)) 
		{
			return true;
		} 
		else 
		{
			return false;
		}		

   }
   
   public function get_hotel_apis()
   {   
		$this->db->select('*')
				->from('api_info')
				->where('service_type',1);
		$query = $this->db->get();

      	if($query->num_rows > 0 ) 
		{      
         	return $query->result();

      	}
		
      	return false;
   }
   
   public function get_flight_apis()
   {   
		$this->db->select('*')
				->from('api_info')
				->where('service_type',2);
		$query = $this->db->get();

      	if($query->num_rows > 0 ) 
		{      
         	return $query->result();
      	}
		
      	return false;
   }
   
   public function get_car_apis()
   {   
		$this->db->select('*')
				->from('api_info')
				->where('service_type',3);
		$query = $this->db->get();

      	if($query->num_rows > 0 ) 
		{      
         	return $query->result();
      	}
		
      	return false;
   }
   
   public function manage_api_status($api_id,$status)
   {
		$data['status'] = $status;	
		$where = "api_id = '$api_id'";
		if($this->db->update('api_info', $data, $where)) 
		{
			return true;
		} 
		else 
		{
			return false;
		}		

   }
   
   public function get_payment_gateway_charges()
   {   
		$this->db->select('*')
				->from('payment_gateway');				
		$query = $this->db->get();

      	if($query->num_rows > 0 ) 
		{      
         	return $query->result();
      	}
		
      	return false;
   }
   
   public function manage_payment_charge_status($id,$status)
   {
		$data['status'] = $status;	
		$where = "id = '$id'";
		if($this->db->update('payment_gateway', $data, $where)) 
		{
			return true;
		} 
		else 
		{
			return false;
		}		

   }
   
   public function get_payment_charge($id)
   {   
		$this->db->select('*')
				 ->from('payment_gateway')
				 ->where('id', $id);				 
		$query = $this->db->get();

	  if ($query->num_rows > 0) 
	  {      
		 return $query->row();
		 
	  }
	  return false;
	  
   }
   
   public function update_payment_charge($id,$charge)
   {
		$data['charge'] = $charge;	
		$where = "id = '$id'";
		if($this->db->update('payment_gateway', $data, $where)) 
		{
			return true;
		} 
		else 
		{
			return false;
		}		

   }
   
   public function get_api_list()
   {   
		$this->db->select('*')
				->from('api_info')	
				->where('status',1);				
		$query = $this->db->get();

      	if($query->num_rows > 0 ) 
		{      
         	return $query->result();
      	}
		
      	return false;
   } 
   
   public function get_api_list_by_service($service_type)
   {   
		$this->db->select('*')
				->from('api_info')	
				->where('service_type',$service_type)
				->where('status',1);				
		$query = $this->db->get();

      	if($query->num_rows > 0 ) 
		{      
         	return $query->result();
      	}
		
      	return false;
   }  
   
   public function get_promotion_list()
   {   
		$this->db->select('*')
				->from('promotion_manager')
				->order_by('promo_id','DESC');
		$query = $this->db->get();

      	if($query->num_rows > 0 ) 
		{      
         	return $query->result();
      	}
		
      	return false;
   }
   
   public function add_promotion($service_type,$promo_name,$promo_code,$discount,$promo_expire)
   {
	    $valid_upto = date('Y-m-d',strtotime($promo_expire));
		
	   	$data = array(
		'service_type' => $service_type,
		'promo_name' => $promo_name,
		'promo_code' => $promo_code,
		'discount' => $discount,
		'promo_expire' => $valid_upto,
		'status' => 1,
		);
			
		$this->db->set('created_datetime', 'NOW()', FALSE); 
		
		$this->db->insert('promotion_manager', $data);
		$id = $this->db->insert_id();
		if(!empty($id))
		{
			return true;
		} 
		else 
		{
			return false;
		}

   }
   
   public function manage_promotion_status($promo_id,$status)
   {
		$data['status'] = $status;	
		$where = "promo_id = '$promo_id'";
		if($this->db->update('promotion_manager', $data, $where)) 
		{
			return true;
		} 
		else 
		{
			return false;
		}		

   }
   
   public function get_promotion_by_promo_id($promo_id)
   {   
		$this->db->select('*')
				->from('promotion_manager')
				->where('promo_id',$promo_id)
				->limit('1');
		$query = $this->db->get();

      	if($query->num_rows > 0 ) 
		{      
         	$res = $query->result();
			return $res[0];
      	}
		
      	return false;
   }
   
   public function update_promotion($promo_id,$service_type,$promo_name,$promo_code,$discount,$promo_expire)
   {
	   $valid_upto = date('Y-m-d',strtotime($promo_expire));
	   
		$data = array(
		'service_type' => $service_type,
		'promo_name' => $promo_name,
		'promo_code' => $promo_code,
		'discount' => $discount,
		'promo_expire' => $valid_upto,		
		);
		
		$where = "promo_id = '$promo_id'";
		$this->db->set('created_datetime', 'NOW()', FALSE); 
		if($this->db->update('promotion_manager', $data, $where)) 
		{
			return true;
		} 
		else 
		{
			return false;
		}		

   }
       public function get_all_agent_acc_summary() {
        $this->db->select('*')
                ->from('agent_acc_summary')
                ->order_by('agent_no', 'DESC')
                ->order_by('deposit_id', 'DESC');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
    }
    public function get_all_approved__agent_acc_summary() {
        $this->db->select('*')
                ->from('agent_acc_summary')
                ->where('status', 'Accepted')
                ->where('withdraw_amount')
                ->order_by('agent_no', 'DESC')
                ->order_by('deposit_id', 'DESC');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
    }

    public function get_all_pending_agent_acc_summary() {
        $this->db->select('*')
                ->from('agent_acc_summary')
                ->where('status', 'Pending')
                ->order_by('agent_no', 'DESC')
                ->order_by('deposit_id', 'DESC');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
    }
        public function get_approved_amount($id) {
        $this->db->select('*')
                ->from('agent_acc_summary')
                ->where('deposit_id', $id)
               // ->order_by('available_balance', 'DESC')
                ->where('status', 'Pending');
        $query = $this->db->get();
        // echo $this-db->last_query();

        if ($query->num_rows > 0) {
            return $query->row();
        }
        return false;
    }
   
		
		
}

