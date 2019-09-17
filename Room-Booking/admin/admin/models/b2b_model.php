<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class B2B_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function check_email_availability($email) {
        $this->db->select('*')
                ->from('agent_info')
                ->where('agent_email', $email)
                ->limit('1');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return '';
    }

    public function add_agent($agent_email, $agent_password, $agency_name, $currency_type, $title, $first_name, $middle_name, $last_name, $mobile_no, $office_phone_no, $address, $pin_code, $city, $state, $country, $image_path) {
        $data = array(
            'agent_email' => $agent_email,
            'agent_password' => $agent_password,
            'agency_name' => $agency_name,
            'currency_type' => $currency_type,
            'title' => $title,
            'first_name' => $first_name,
            'middle_name' => $middle_name,
            'last_name' => $last_name,
            'mobile_no' => $mobile_no,
            'office_phone_no' => $office_phone_no,
            'address' => $address,
            'pin_code' => $pin_code,
            'city' => $city,
            'state' => $state,
            'country' => $country,
            'agent_logo' => $image_path,
            'status' => 1,
            'agent_type' => 1,
        );

        $this->db->set('register_date', 'NOW()', FALSE);

        $this->db->insert('agent_info', $data);
        $id = $this->db->insert_id();
        if (!empty($id)) {
            $agent_no = 'ALA' . $id . rand(1000, 9999);

            $data1 = array('agent_no' => $agent_no);
            $this->db->where('agent_id', $id);
            $this->db->update('agent_info', $data1);

            return true;
        } else {
            return false;
        }
    }

    public function get_agent_list() {
        $this->db->select('*')
                ->from('agent_info');
        $this->db->order_by('agent_id', 'DESC');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
    }

    public function get_agent_info_by_id($agent_id) {
        $this->db->select('*')
                ->from('agent_info')
                ->where('agent_id', $agent_id)
                ->limit('1');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            $res = $query->result();
            return $res[0];
        }

        return false;
    }

    public function get_available_balance($agent_id) {
        $this->db->select('available_balance')
                ->from('agent_acc_summary')
                ->where('agent_id', $agent_id)
                ->order_by('acc_id', 'DESC')
                ->limit('1');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            $res = $query->result();
            return $res[0]->available_balance;
        }

        return false;
    }

    public function update_agent($agent_id, $agency_name, $currency_type, $title, $first_name, $middle_name, $last_name, $mobile_no, $office_phone_no, $address, $pin_code, $city, $state, $country, $image_path) {
        $data = array(
            'agency_name' => $agency_name,
            'currency_type' => $currency_type,
            'title' => $title,
            'first_name' => $first_name,
            'middle_name' => $middle_name,
            'last_name' => $last_name,
            'mobile_no' => $mobile_no,
            'office_phone_no' => $office_phone_no,
            'address' => $address,
            'pin_code' => $pin_code,
            'city' => $city,
            'state' => $state,
            'country' => $country,
            'agent_logo' => $image_path,
        );

        $this->db->where('agent_id', $agent_id);
        //$this->db->update('agent_info', $data);		
        if ($this->db->update('agent_info', $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function update_agent_password($agent_id, $password = '') {
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

    public function manage_agent_status($agent_id, $status) {
        $data['status'] = $status;
        $where = "agent_id = '$agent_id'";
        if ($this->db->update('agent_info', $data, $where)) {
            return true;
        } else {
            return false;
        }
    }

    public function get_agent_acc_summary($agent_id) {
        $this->db->select('*')
                ->from('agent_acc_summary')
                ->where('agent_id', $agent_id)
                ->order_by('acc_id', 'DESC');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
    }

    public function add_transaction($agent_id, $agent_no, $transaction_type, $amount, $value_date, $transaction_mode, $bank, $branch, $city, $transaction_id, $remarks) {
        $dep_amount = '';
        if ($transaction_type == 'deposit') {
            $dep_amount = $amount;
        }

        $with_amount = '';
        if ($transaction_type == 'withdraw') {
            $with_amount = $amount;
        }

        $desc = $transaction_mode . '-' . $transaction_id . ', ' . $bank;

        $value_date = date('Y-m-d', strtotime($value_date));

        $this->db->select('available_balance')
                ->from('agent_acc_summary')
                ->where('agent_id', $agent_id)
                ->order_by('acc_id', 'DESC')
                ->limit('1');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            $res = $query->result();
            $balance = $res[0]->available_balance;
        } else {
            $balance = 0;
        }

        $data = array(
            'agent_id' => $agent_id,
            'agent_no' => $agent_no,
            'transaction_summary' => $desc,
            'deposit_amount' => $dep_amount,
            'withdraw_amount' => $with_amount,
            'transaction_id' => $transaction_id,
            'bank' => $bank,
            'branch' => $branch,
            'city' => $city,
            'value_date' => $value_date,
            'remarks' => $remarks,
        );

        $this->db->set('transaction_datetime', 'NOW()', FALSE);
        if ($transaction_type == 'deposit')
            $this->db->set('available_balance', $balance + $amount, FALSE);
        else
            $this->db->set('available_balance', $balance - $amount, FALSE);

        $this->db->insert('agent_acc_summary', $data);
        //echo $this->db->last_query();exit;
        $id = $this->db->insert_id();
        if (!empty($id)) {
            return true;
        } else {
            return false;
        }
    }

    public function get_active_agent_list() {
        $this->db->select('*')
                ->from('agent_info')
                ->where('status', 1);
        $this->db->order_by('agent_id', 'DESC');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
    }

    public function get_hotel_markup_list() {
        $this->db->select('*')
                ->from('b2b_markup_info')
                ->where('service_type', 1);
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
    }

    public function get_flight_markup_list() {
        $this->db->select('*')
                ->from('b2b_markup_info')
                ->where('service_type', 2);
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
    }

    public function get_car_markup_list() {
        $this->db->select('*')
                ->from('b2b_markup_info')
                ->where('service_type', 3);
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
    }

    function delete_b2b_markup($markup_type, $service_type) {
        $where = "markup_type = '$markup_type' AND service_type = '$service_type'";
        if ($this->db->delete('b2b_markup_info', $where)) {
            return true;
        } else {
            return false;
        }
    }

    function add_b2b_markup($country, $agent_no, $api_name, $markup, $markup_type, $service_type) {
        $data = array(
            'country' => $country,
            'agent_no' => $agent_no,
            'api_name' => $api_name,
            'markup' => $markup,
            'markup_type' => $markup_type,
            'service_type' => $service_type,
            'status' => 1
        );

        $this->db->insert('b2b_markup_info', $data);
        $id = $this->db->insert_id();
        if (!empty($id)) {
            return true;
        } else {
            return false;
        }
    }

    function delete_b2b_markup_new($markup_type, $service_type, $agent, $api_name, $country) {
        $where = "markup_type = '$markup_type'";
        if ($service_type != '') {
            $where .= "AND service_type = '$service_type'";
        }
        if ($country != '') {
            $where .= "AND country = '$country'";
        }
        if ($api_name != '') {
            $where .= "AND api_name = '$api_name'";
        }
        if ($agent != '') {
            $where .= "AND agent_no = '$agent'";
        }

        if ($this->db->delete('b2b_markup_info', $where)) {
            return true;
        } else {
            return false;
        }
    }

    public function manage_b2b_markup_status($markup_id, $status) {
        $data['status'] = $status;
        $where = "markup_id = '$markup_id'";
        if ($this->db->update('b2b_markup_info', $data, $where)) {
            return true;
        } else {
            return false;
        }
    }

    function delete_b2b_markup_status($markup_id) {
        $where = "markup_id = '$markup_id'";
        if ($this->db->delete('b2b_markup_info', $where)) {
            return true;
        } else {
            return false;
        }
    }

    public function get_b2b_hotel_booking_summary() {
        $this->db->select('*')
                ->from('hotel_booking_reports hr')
                ->where('hr.Booking_Done_By', 'agent')
                ->order_by('hr.hotel_booking_id', 'DESC')
                ->group_by('hr.Booking_reference_ID');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
    }

    public function get_b2b_int_hotel_booking_summary() {
        $this->db->select('*')
                ->from('hotel_booking_reports_rooms hr')
                ->join('hotel_booking_hotels_info hh', 'hr.RefNo = hh.RefNo')
                ->join('hotel_booking_passengers_info hp', 'hr.RefNo = hp.RefNo')
                ->where('hr.Booking_Done_By', 'agent')
                ->order_by('hr.hotel_booking_id', 'DESC')
                ->group_by('hp.RefNo');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
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

    public function update_deposit_status($dep_amt, $depositno, $total) {
        $timestamp = date("Y-d-m h:m:s", strtotime("now"));
        $data['status'] = 'Accepted';
        $data['approved_date'] = $timestamp;
        $data['available_balance'] = $total;
        $where = "deposit_id = '$depositno'";

        if ($this->db->update('agent_acc_summary', $data, $where)) {
            return true;
        } else {
            return false;
        }
    }

    public function get_sum_of_deposits($agent_no) {

        $this->db->select('deposit_amount')->from('agent_deposit_summary')->where('status', 'Accepted')->where('agent_no', $agent_no);
        $query = $this->db->get();
        $period_array = array();
        foreach ($query->result_array() as $row) {
            $period_array[] = ($row['deposit_amount']);
        }
        $total = array_sum($period_array);



        if ($query->num_rows > 0) {
            return $total;
        }

        return false;
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

    public function update_deposit_request($agent_no, $available_balance, $deposite) {
        //$deposit_amount=$available_balance+$deposite;

        if (!empty($agent_no)) {
            $data['closing_balance'] = $available_balance;
            $data['debited_balance'] = $deposite;
            $where = "agent_no = '$agent_no'";
            if ($this->db->update('agent_info', $data, $where)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}

