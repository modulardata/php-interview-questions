<?php

class User_Model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function validate_credentials($loginEmailId, $loginPassword) {
        $this->db->select('*')
                ->from('user_info')
                ->where('user_email', $loginEmailId)
                ->where('user_password', $loginPassword)
                ->where('status', 1)
                ->limit(1);
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        if ($query->num_rows > 0) {
            return $query->row();
        }
        return false;
    }

    public function insert_login_activity() {
        $user_id = $this->session->userdata('user_id');
        $session_id = $this->session->userdata('session_id');
        $ip_address = $this->session->userdata('ip_address');
        $user_agent = $this->session->userdata('user_agent');
        $remote_ip = $_SERVER['REMOTE_ADDR'];

        $data = array('session_id' => $session_id,
            'user_id' => $user_id,
            'ip_address' => $ip_address,
            'remote_ip' => $remote_ip,
            'user_agent' => $user_agent
        );

        if ($this->db->insert('user_login_history', $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function get_country_list() {
        $this->db->select('*')
                ->from('country');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
    }

    public function check_email_availability($email) {
        $this->db->select('*')
                ->from('user_info')
                ->where('user_email', $email)
                ->limit('1');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return '';
    }

    public function add_user($user_email, $user_password, $title, $first_name, $last_name, $mobile_no, $travel_offers) {
       
        $data = array(
            'user_email' => $user_email,
            'user_password' => $user_password,
            'title' => $title,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'mobile_no' => $mobile_no,
            'travel_offers' => $travel_offers,
            'status' => 1,
        );

        $this->db->set('register_date', 'NOW()', FALSE);
       // echo '<pre>';        print_r($data); exit;

        $this->db->insert('user_info', $data);
        $id = $this->db->insert_id();
        if (!empty($id)) {
            $user_no = 'RB' . $id . rand(1000, 9999);

            $data1 = array('user_no' => $user_no);
            $this->db->where('user_id', $id);
            $this->db->update('user_info', $data1);

            return true;
        } else {
            return false;
        }
    }

    public function getUserInfo($user_id) {
        $this->db->select('*')
                ->from('user_info')
                ->where('user_id', $user_id)
                ->limit(1);
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->row();
        }

        return false;
    }

    public function update_profile($user_id, $title, $first_name, $middle_name, $last_name, $mobile_no, $address, $pin_code, $city, $state, $country, $user_logo) {
        $data = array(
            'title' => $title,
            'first_name' => $first_name,
            'middle_name' => $middle_name,
            'last_name' => $last_name,
            'mobile_no' => $mobile_no,
            'address' => $address,
            'pin_code' => $pin_code,
            'city' => $city,
            'state' => $state,
            'country' => $country,
            'user_logo' => $user_logo,
        );

        $this->db->where('user_id', $user_id);

        if ($this->db->update('user_info', $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function update_password($user_id, $password = '') {
        if (!empty($password)) {
            $data['user_password'] = $password;
            $where = "user_id = '$user_id'";
            if ($this->db->update('user_info', $data, $where)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function get_user_flight_booking_summary($user_id) {
        $this->db->select('flight_booking_reports.*,flight_booking_passengers.*')
                ->from('flight_booking_reports')
                ->join('flight_booking_passengers', 'flight_booking_reports.report_id = flight_booking_passengers.booking_id')
                ->where('flight_booking_reports.user_id', $user_id)
                ->order_by('flight_booking_reports.report_id', 'DESC');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
    }

    public function get_user_dom_hotel_booking_summary($user_id) {
        $this->db->select('hotel_booking_reports.*')
                ->from('hotel_booking_reports')
                 ->where('hotel_booking_reports.user_id', $user_id)
                ->group_by('hotel_booking_reports.Booking_reference_ID')
                ->order_by('hotel_booking_reports.hotel_booking_id', 'DESC');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
    }

    public function get_user_int_hotel_booking_summary($user_id) {

        $this->db->select('hotel_booking_hotels_info.*,hotel_booking_passengers_info.*,hotel_booking_reports_rooms.*')
                ->from('hotel_booking_hotels_info')
                ->join('hotel_booking_passengers_info', 'hotel_booking_hotels_info.RefNo = hotel_booking_passengers_info.RefNo')
                ->join('hotel_booking_reports_rooms', 'hotel_booking_hotels_info.RefNo = hotel_booking_reports_rooms.RefNo')
                ->where('hotel_booking_hotels_info.user_id', $user_id)
                ->group_by('hotel_booking_hotels_info.RefNo')
                ->order_by('hotel_booking_hotels_info.hotel_booking_id', 'DESC');
        $query = $this->db->get();
        //echo '<pre>'; print_r($this->db->last_query()); exit;

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
    }
      public function get_forgot_password($loginEmailId) {
        $this->db->select('*')
                ->from('user_info')
                ->where('user_email', $loginEmailId)
                ->limit(1);
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->row();
        }

        return false;
    }
      public function getUserdetail($email_id, $user_id) {
        $this->db->select('user_id,user_email')
                ->from('user_info')
                ->where('user_email', $email_id)
                ->where('user_id', $user_id)
                ->limit(1);
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->row();
        }

        return false;
    }
//      public function update_password($user_id, $password = '') {
//        if (!empty($password)) {
//            $data['user_password'] = $password;
//            $where = "user_id = '$user_id'";
//            if ($this->db->update('user_info', $data, $where)) {
//                return true;
//            } else {
//                return false;
//            }
//        } else {
//            return false;
//        }
//    }

//      public function get_user_int_hotel_booking_summary($user_id) {
//        $this->db->select('hotel_booking_reports.*,hotel_booking_passengers_info.*')
//                ->from('hotel_booking_reports')
//                ->join('hotel_booking_passengers_info', 'hotel_booking_reports.RefNo = hotel_booking_passengers_info.RefNo')
//                ->where('hotel_booking_reports.user_id', $user_id)
//                ->group_by('hotel_booking_reports.Booking_reference_ID')
//                ->order_by('hotel_booking_reports.hotel_booking_id', 'DESC');
//        $query = $this->db->get();
//        //echo '<pre>'; print_r($this->db->last_query()); exit;
//
//        if ($query->num_rows > 0) {
//            return $query->result();
//        }
//
//        return false;
//    }
}
