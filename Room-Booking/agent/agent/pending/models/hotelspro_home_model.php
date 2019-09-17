<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Hotelspro_Home_Model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
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
       public function validate_debug_credentials($loginEmailId) {
        $this->db->select('*')
                ->from('agent_info')
                ->where('agent_email', $loginEmailId)
            
                ->where('status', 1)
                ->limit(1);
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->row();
        }

        return false;
    }

    public function get_description($id) {
        $this->db->select('*')
                ->from('discription_table')
                ->where('id', $id)
                ->limit(1);
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->row();
        }

        return false;
    }

    public function get_top_hotels() {
        $this->db->select('*')
                ->from('hotel_list_for_home_page')
                ->limit(5)
                ->order_by('id', 'DESC');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
    }

    public function get_banner_view() {
        $this->db->select('image,name,id,add_url')
                ->from('save_banner')
                ->where('status',1)
                ->limit(5);
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
    }

    public function get_terms() {
        $this->db->select('*')
                ->from('terms_conditions');

        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }
        return false;
    }

    public function get_faq() {
        $this->db->select('*')
                ->from('faq');

        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }
        return false;
    }

    public function get_about_us() {
        $this->db->select('*')
                ->from('about_us')
                ->where('id', 1);
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->row();
        }

        return false;
    }

    function getAgentbooking_report($agent_id) {
        $this->db->select('m.*,n.*');
        $this->db->from('hotel_booking_info as n');
        $this->db->join('transaction_details as m', 'm.customer_contact_details_id=n.customer_contact_details_id');
        $this->db->where('n.agent_id', $agent_id);
        $this->db->group_by('n.voucher_date');
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return '';
        }
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

    public function get_last_booked_hotels($agent_id) {

        $this->db->select('m.*,n.*');
        $this->db->from('hotel_booking_info as n');
        $this->db->join('transaction_details as m', 'm.customer_contact_details_id=n.customer_contact_details_id');
        $this->db->where('n.agent_id', $agent_id);
        $this->db->limit(10);
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return '';
        }
    }

}
