<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home_Model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    public function get_airport_list($search, $type) {
        $where = "(airport_code LIKE '%" . $search . "%' OR airport_city  LIKE '%" . $search . "%')";
        $this->db->select('*');
        $this->db->from('airport_list');
        $this->db->where('airport_type', $type);
        $this->db->where($where);
        $this->db->order_by('airport_city');
        $query = $this->db->get();

        if ($query->num_rows == '') {
            return '';
        } else {
            return $query->result_array();
        }
    }

    function user_login_validate($user_email, $user_password) {
        $this->db->select('*');
        $this->db->from('user_info');
        $this->db->where('user_email', $user_email);
        $this->db->where('user_password', $user_password);
        $query = $this->db->get();

        if ($query->num_rows == '') {
            return '';
        } else {
            return $query->row();
        }
    }

    public function getAgentInfo($agent_id) {
        $this->db->select('*')
                ->from('agent_info')
                ->where('agent_id', $agent_id)
                ->limit(1);
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->row();
        }

        return false;
    }
    
    public function get_currency_list() {
        $this->db->select('*')
                ->from('currency');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
    }

    public function get_agent_deposit_summary($agent_id) {
        $this->db->select('*')
                ->from('agent_deposit_summary')
                ->where('agent_id', $agent_id)
                ->order_by('deposit_id', 'DESC');
        $query = $this->db->get();


        if ($query->num_rows > 0) {
            return $query->result();
//            echo $this->db->last_query();
//            exit;
        }

        return false;
    }

    function get_hotel_list($type) {
        $this->db->select('city');
        $this->db->from('api_hotels_city');
        //$this->db->where('city', $type);
        $query = $this->db->get();

        if ($query->num_rows == '') {
            return '';
        } else {
            return $query->result_array();
        }
    }

    function get_hotel_list_dom($type) {
        $this->db->select('*');
        $this->db->from('hotel_city_tg');
        //$this->db->where('city', $type);
        $query = $this->db->get();

        if ($query->num_rows == '') {
            return '';
        } else {
            return $query->result_array();
        }
    }

    function getbus_source() {
        $this->db->select('*')
                ->from('bus_source_list');
        $this->db->order_by('city_name', 'ASC');
        $query = $this->db->get();
        if ($query->num_rows == '') {
            return '';
        } else {
            return $query->result();
        }
    }

    public function get_agent_markup_manager($agent_no) {
        $this->db->select('*')
                ->from('agent_markup_manager')
                ->where('agent_no', $agent_no)
                ->order_by('markup_id', 'DESC');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
    }

     public function update_password($agent_id, $password = '') {
        if (!empty($password)) {
            $data['agent_password'] = $password;
            $where = "agent_id = '$agent_id'";
            if ($this->db->update('agent_info', $data, $where)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
    public function add_markup($agent_no, $service_type, $markup) {
        $this->db->where('agent_no', $agent_no)
                ->where('service_type', $service_type)
                ->delete('agent_markup_manager');


        $data = array(
            'agent_no' => $agent_no,
            'service_type' => $service_type,
            'markup' => $markup,
            'status' => 1,
        );

        $this->db->insert('agent_markup_manager', $data);
        //echo $this->db->last_query();exit;
        $id = $this->db->insert_id();
        if (!empty($id)) {
            return true;
        } else {
            return false;
        }
    }

    public function update_markup_status($markup_id, $status) {
        $data['status'] = $status;
        $where = "markup_id = '$markup_id'";
        $this->db->update('agent_markup_manager', $data, $where);

        return true;
    }

    function fetchbussource($search) {
        $where = "(city_name LIKE '%" . $search . "%')";
        $this->db->select('*');
        $this->db->from('bus_source_list');
        $this->db->where($where);
        $this->db->order_by('city_name');
        $query = $this->db->get();

        if ($query->num_rows == '') {
            return '';
        } else {
            return $query->result_array();
        }
    }

    function fetchbusdesti($search) {
        $where = "(city_name LIKE '%" . $search . "%')";
        $this->db->select('*');
        $this->db->from('bus_destination_list');
        $this->db->where($where);
        $this->db->group_by('bus_destination_id');
        $this->db->order_by('city_name');
        $query = $this->db->get();

        if ($query->num_rows == '') {
            return '';
        } else {
            return $query->result_array();
        }
    }

    function getbusdest($id) {
        $this->db->select('*')
                ->from('bus_destination_list');
        $this->db->where('bus_source_id', $id);
        $query = $this->db->get();
        if ($query->num_rows == '') {
            return '';
        } else {
            return $query->result();
        }
    }
    

    function getbus_dest_all() {
        $this->db->select('*')
                ->from('bus_destination_list');
        $query = $this->db->get();
        if ($query->num_rows == '') {
            return '';
        } else {
            return $query->result();
        }
    }

    // BELOW REQUIRED FOR AGENT
    public function get_country_list() {
        $this->db->select('*')
                ->from('country');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
    }

    public function validate_credentials($loginEmailId, $loginPassword) {
        $this->db->select('*')
                ->from('agent_info')
                ->where('agent_email', $loginEmailId)
                ->where('agent_password', md5($loginPassword))
                ->where('status', 1)
                ->limit(1);
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->row();
        }

        return false;
    }

    public function insert_login_activity() {
        $agent_id = $this->session->userdata('agent_id');
        $session_id = $this->session->userdata('session_id');
        $ip_address = $this->session->userdata('ip_address');
        $user_agent = $this->session->userdata('user_agent');
        $remote_ip = $_SERVER['REMOTE_ADDR'];

        $data = array('session_id' => $session_id,
            'agent_id' => $agent_id,
            'ip_address' => $ip_address,
            'remote_ip' => $remote_ip,
            'user_agent' => $user_agent
        );

        if ($this->db->insert('agent_login_history', $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function add_deposit_request($agent_id, $agent_no, $amount, $value_date, $transaction_mode, $bank, $branch, $city, $transaction_id, $remarks, $available_balance) {


        $desc = $transaction_mode . '-' . $transaction_id . ', ' . $bank;
//echo $value_date; exit;
        $data = array(
            'agent_id' => $agent_id,
            'agent_no' => $agent_no,
            'transaction_summary' => $desc,
            'deposit_amount' => $amount,
            'transaction_id' => $transaction_id,
            'bank' => $bank,
            'branch' => $branch,
            'city' => $city,
            'value_date' => $value_date,
            'remarks' => $remarks,
            'available_balance' => $available_balance,
            'status' => 'Pending',
        );

        $this->db->set('transaction_datetime', 'NOW()', FALSE);

        $this->db->insert('agent_deposit_summary', $data);
        //echo $this->db->last_query();exit;
        $id = $this->db->insert_id();
        if (!empty($id)) {
            return true;
        } else {
            return false;
        }
    }

    public function get_agent_available_balance($agent_no) {
        $this->db->select('*')
                ->from('agent_info')
                ->where('agent_no', $agent_no);
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->row();
        }

        return false;
    }

}
