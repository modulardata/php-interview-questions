<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class B2c_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
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

    public function add_user($user_email, $user_password, $title, $first_name, $middle_name, $last_name, $mobile_no, $address, $pin_code, $city, $state, $country, $image_path) {
        $data = array(
            'user_email' => $user_email,
            'user_password' => $user_password,
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
            'user_logo' => $image_path,
            'status' => 1,
        );

        $this->db->set('register_date', 'NOW()', FALSE);

        $this->db->insert('user_info', $data);
        $id = $this->db->insert_id();
        if (!empty($id)) {
            $user_no = 'ALU' . $id . rand(1000, 9999);

            $data1 = array('user_no' => $user_no);
            $this->db->where('user_id', $id);
            $this->db->update('user_info', $data1);

            return true;
        } else {
            return false;
        }
    }

    public function get_user_list() {
        $this->db->select('*')
                ->from('user_info');
        $this->db->order_by('user_id', 'DESC');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
    }

    public function manage_user_status($user_id, $status) {
        $data['status'] = $status;
        $where = "user_id = '$user_id'";
        if ($this->db->update('user_info', $data, $where)) {
            return true;
        } else {
            return false;
        }
    }

    public function update_b2c_hotel_booking_status($Booking_reference_ID) {
        $data['status'] = 'Cancelled';
        $where = "Booking_reference_ID = '$Booking_reference_ID'";
        if ($this->db->update('hotel_booking_reports', $data, $where)) {
            return true;
        } else {
            return false;
        }
    }
    public function update_b2c_rooms_hotel_booking_status($Book_reference) {
        $data['status'] = 'Cancelled';
        $where = "Booking_reference_ID = '$Book_reference'";
        if ($this->db->update('hotel_booking_reports_rooms', $data, $where)) {
            return true;
        } else {
            return false;
        }
    }

    public function get_user_info_by_id($user_id) {
        $this->db->select('*')
                ->from('user_info')
                ->where('user_id', $user_id)
                ->limit('1');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            $res = $query->result();
            return $res[0];
        }

        return false;
    }

    public function update_user($user_id, $title, $first_name, $middle_name, $last_name, $mobile_no, $address, $pin_code, $city, $state, $country, $user_logo) {
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

    public function update_user_password($user_id, $password = '') {
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

    public function get_hotel_markup_list() {
        $this->db->select('*')
                ->from('b2c_markup_info')
                ->where('service_type', 1);
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
    }

    public function get_flight_markup_list() {
        $this->db->select('*')
                ->from('b2c_markup_info')
                ->where('service_type', 2);
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
    }

    public function get_car_markup_list() {
        $this->db->select('*')
                ->from('b2c_markup_info')
                ->where('service_type', 3);
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
    }

    function delete_b2c_markup($markup_type, $service_type) {
        $where = "markup_type = '$markup_type' AND service_type = '$service_type'";
        if ($this->db->delete('b2c_markup_info', $where)) {
            return true;
        } else {
            return false;
        }
    }

    function b2c_markup_checking($country, $api_name, $markup_type, $service_type) {
        $this->db->select('*');
        $this->db->from('b2c_markup_info');
        $this->db->where('country', $country);
        $this->db->where('api_name', $api_name);
        $this->db->where('markup_type', $markup_type);
        $this->db->where('service_type', $service_type);

        $query = $this->db->get();

        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->row();
        }
    }

    function add_b2c_markup($country, $api_name, $markup, $markup_type, $service_type) {
        $data = array(
            'country' => $country,
            'api_name' => $api_name,
            'markup' => $markup,
            'markup_type' => $markup_type,
            'service_type' => $service_type,
            'status' => 1
        );

        //$this->db->set('register_date', 'NOW()', FALSE); 
        $this->db->insert('b2c_markup_info', $data);
        $id = $this->db->insert_id();
        if (!empty($id)) {
            return true;
        } else {
            return false;
        }
    }

    function delete_id_b2c_markup($country, $api_name, $markup_type, $service_type) {
        $where = "country = '$country' AND api_name = '$api_name' AND markup_type = '$markup_type' AND service_type = '$service_type'";
        if ($this->db->delete('b2c_markup_info', $where)) {
            return true;
        } else {
            return false;
        }
    }

    public function manage_b2c_markup_status($markup_id, $status) {
        $data['status'] = $status;
        $where = "markup_id = '$markup_id'";
        if ($this->db->update('b2c_markup_info', $data, $where)) {
            return true;
        } else {
            return false;
        }
    }

    function delete_b2c_markup_status($markup_id) {
        $where = "markup_id = '$markup_id'";
        if ($this->db->delete('b2c_markup_info', $where)) {
            return true;
        } else {
            return false;
        }
    }

    public function get_b2c_flight_booking_summary() {
        $this->db->select('fr.*,fp.*')
                ->from('flight_booking_reports fr')
                ->join('flight_booking_passengers fp', 'fr.AirlinersRefNo = fp.AirlinersRefNo')
                ->where('fr.agent_id', 0)
                ->order_by('fr.report_id', 'DESC')
                ->group_by('fp.AirlinersRefNo');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
    }

    public function get_b2c_hotel_booking_summary() {
        $this->db->select('*')
                ->from('hotel_booking_reports hr')
                ->where('hr.agent_id', 0)
                ->order_by('hr.hotel_booking_id', 'DESC')
                ->group_by('hr.Booking_reference_ID');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
    }

    public function get_b2c_int_hotel_booking_summary() {
        $this->db->select('*')
                ->from('hotel_booking_reports_rooms hr')
                ->join('hotel_booking_hotels_info hh', 'hr.RefNo = hh.RefNo')
                ->join('hotel_booking_passengers_info hp', 'hr.RefNo = hp.RefNo')
                ->where('hr.agent_id', 0)
                ->order_by('hr.hotel_booking_id', 'DESC')
                ->group_by('hp.RefNo');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
    }

    public function get_hotel_booking_information($sysRefNo, $bookRefNo) {
        //  echo '<pre>';        print_r($sysRefNo);  print_r($bookRefNo); exit;
        $this->db->select('r.*,h.*');
        $this->db->from('hotel_booking_reports_rooms r');
        $this->db->join('hotel_booking_hotels_info h', 'r.RefNo = h.RefNo');
        $this->db->where('r.Booking_reference_ID', $bookRefNo);
        $this->db->where('h.RefNo', $sysRefNo);
        $this->db->limit('1');

        $query = $this->db->get();

        if ($query->num_rows() == 0) {
            return '';
        } else {
            return $query->row();
        }
    }
    public function get_hotel_booking_passenger_info($sysRefNo) {
        $this->db->select('*');
        $this->db->from('hotel_booking_passengers_info');
        $this->db->where('RefNo', $sysRefNo);
        $this->db->order_by('pass_id', 'ASC');

        $query = $this->db->get();

        if ($query->num_rows() == 0) {
            return '';
        } else {
            return $query->result();
        }
    }

    function get_hotel_details($Booking_reference_ID) {
        $this->db->select('*');
        $this->db->from('hotel_booking_reports');
        $this->db->where('Booking_reference_ID', $Booking_reference_ID);


        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->row();
        }
    }

    function get_hotel_passenger_details($Booking_reference_ID) {
        $this->db->select('*');
        $this->db->from('hotel_booking_pass_info');
        $this->db->where('Booking_reference_ID', $Booking_reference_ID);


        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        }
    }

    function get_hoteldescription($hotel_code) {
        $this->db->select('description,image')
                ->from('api_permanent_info')
                ->where('hotel_code', $hotel_code);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->row();
        }
    }

}

