<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Hotel_Model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function insert_roomsxml_data($insertrooms) {
        $this->db->insert_batch('api_hotel_info_t', $insertrooms);
    }

    function fetch_search_result($ses_id) {
        $this->db->select('m.*,n.*');
        $this->db->from('hotel_search_result_info_t as n');
        $this->db->join('api_permanent_info as m', 'm.hotel_code=n.hotel_code');
        $this->db->where('n.session_id', $ses_id);
        $this->db->group_by('n.hotel_code');
        $this->db->order_by('n.net_amount', 'ASC');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return '';
        }
    }

    function delete_hotel_temp_result($sess_id) {
        $this->db->where('session_id', $sess_id);
        $this->db->delete('api_hotel_info_t');
    }

    function hotel_itenarary($searchid, $hotelcode) {
        $this->db->select('*')->from('api_hotel_info_t')->where('api_temp_hotel_id', $searchid)->where('hotel_code', $hotelcode);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->row();
        }
    }

    function gethotel_detail($hotel_code) {
        $query = $this->db->select('*')->from('api_permanent_info')->where('hotel_code', $hotel_code)->get();
        if ($query->num_rows > 0) {
            return $query->row();
        }
    }

    function get_city_code($city) {
        $this->db->select('*');
        $this->db->from('api_hotels_city');
        $this->db->where('city', $city);
        $query = $this->db->get();
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->row();
        }
    }

    function get_roomscity_code($city) {
        $this->db->select('*');
        $this->db->from('rooms_city_list');
        $this->db->where('city_name', $city);
        $query = $this->db->get();
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->row();
        }
    }

    function get_country($city) {
        $que = "SELECT country_name  FROM `api_hotels_city` WHERE `city` = '$city'";
        $query = $this->db->query($que);
        //echo $this->db->last_query();exit;
        if ($query->num_rows() == 0) {
            return '';
        } else {
            $dd = $query->row();
            return $dd->country_name;
        }
    }

    function get_city_code_id($city) {
        $this->db->select('city_name');
        $this->db->from('api_hotels_city');
        $this->db->where('city', $city);
        $query = $this->db->get();
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->row();
        }
    }

    function insert_gta_temp_result($sec_res, $api, $itemCode, $room_code, $room_type, $cost_val, $status_val, $meals_val, $adult, $child, $amountv3, $org_amt, $currencyv1, $c_val, $amountv3pay, $city = '') {
        $data = array('session_id' => $sec_res, 'api' => $api, 'hotel_code' => $itemCode, 'room_code' => $room_code, 'room_type' => $room_type, 'inclusion' => $meals_val, 'total_cost' => $cost_val, 'city' => $city, 'status' => $status_val, 'adult' => $adult, 'child' => $child, 'currency_val' => $c_val, 'xml_currency' => $currencyv1, 'org_amt' => $org_amt, 'markup' => $amountv3, 'payment_charge' => $amountv3pay);
        $this->db->insert('api_hotel_detail_t', $data);
        //echo $this->db->last_query();exit;
        return $this->db->insert_id();
    }

    function fetch_hotel_result($sess_id) {
        $this->db->select('m.*,n.*');
        $this->db->from('api_hotel_info_t as n');
        $this->db->join('api_permanent_info as m', 'm.hotel_code=n.hotel_code');
        $this->db->where('n.session_id', $sess_id);
        $this->db->group_by('n.hotel_code');
        $this->db->order_by('n.total_cost', 'ASC');
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return '';
        }
    }

    function check_permanent($hotel_code) {
        $this->db->select('*')
                ->from('api_permanent_info')
                ->where('hotel_code', $hotel_code);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    function insert_permanent($shotel_Id, $sName, $sCity, $sStars, $sThumbnailUrl, $sdText, $sAddress1, $sLatitude, $sLongitude, $sTel, $sFax) {
        $data = array(
            'api' => 'roomsxml',
            'hotel_code' => $shotel_Id,
            'hotel_name' => $sName,
            'city' => $sCity,
            'star' => $sStars,
            'image' => $sThumbnailUrl,
            'description' => $sdText,
            'location' => $sAddress1,
            'latitude' => $sLatitude,
            'longitude' => $sLongitude,
            'address' => $sAddress1,
            'phone' => $sTel,
            'fax' => $sFax
        );
        $this->db->insert('api_permanent_info', $data);
    }

    function calculatedateDiff($checkin, $checkout) {
        $in = $checkin;
        $check = explode('/', $in);
        $checkin1 = $check[2] . '-' . $check[1] . '-' . $check[0] . ' 00:00:00';
        $out = $checkout;
        $check = explode('/', $out);
        $checkout1 = $check[2] . '-' . $check[1] . '-' . $check[0] . ' 00:00:00';

        $datetime1 = new DateTime($checkin1);
        $datetime2 = new DateTime($checkout1);

        $interval = $datetime1->diff($datetime2);
        $days = $interval->format('%R%a days');
        $res = explode(' ', $days);
        $res1 = substr($res['0'], 1);
        return $res1;
    }

    function calculatedateDiff1($checkin, $checkout) {
        $in1 = explode('/', $checkin);
        $check1format = $in1['2'] . '-' . $in1['1'] . '-' . $in1['0'];
        $out1 = explode('/', $checkout);
        $check2format = $out1['2'] . '-' . $out1['1'] . '-' . $out1['0'];
        $diff = abs(strtotime($check2format) - strtotime($check1format));
        $years = floor($diff / (365 * 60 * 60 * 24));
        $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
        $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
        // printf("%d years, %d months, %d days\n", $years, $months, $days);
        return $days;
    }

    function hotel_detail($hotel_id) {
        $this->db->select('n.*,m.*')
                ->from('api_hotel_info_t as n')
                ->join('api_permanent_info as m', 'n.hotel_code=m.hotel_code')
                ->where('n.api_temp_hotel_id', $hotel_id);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->row();
        }
    }

    function get_nearby_hotels($lat, $long, $hotel_name, $city, $sec_res) {
        // echo $this->session->userdata('sess_id'); exit;
        //echo $sec_res; exit; 
        $query = $this->db->query("SELECT *,(((acos(sin(($lat*pi()/180)) * sin((`latitude`*pi()/180))+cos(($lat*pi()/180)) * cos((`latitude`*pi()/180)) * cos((($long- `longitude`)*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance FROM api_hotel_info_t t, api_permanent_info p WHERE t.hotel_code = p.hotel_code AND p.city='$city' AND t.session_id = '$sec_res' GROUP BY p.hotel_name HAVING `distance` < 9 LIMIT 0,5");
        if ($query->num_rows() == '') {
            return '';
        } else {
            $res = $query->result();
            return $res;
        }
    }

    function hotel_getrooms($hotel_code, $sess_id) {
        $this->db->select('*')
                ->from('api_hotel_info_t')
                ->where('hotel_code', $hotel_code)
                ->where('session_id', $sess_id);
        $query = $this->db->get(); //echo $this->db->last_query();
        if ($query->num_rows > 0) {
            return $query->result();
        }
    }

    public function get_forgot_password($loginEmailId) {
        $this->db->select('*')
                ->from('agent_info')
                ->where('agent_email', $loginEmailId)
                ->limit(1);
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->row();
        }

        return false;
    }

    public function getAgentdetail($email_id, $agent_no) {
        $this->db->select('agent_no,agent_email')
                ->from('agent_info')
                ->where('agent_email', $email_id)
                ->where('agent_no', $agent_no)
                ->limit(1);
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->row();
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

    function hdfc_pay_details($random, $TranAmount) {
        $data = array(
            'ResTrackId' => $random,
            'ResAmount' => $TranAmount
        );
        $this->db->insert('hdfc_paydetails', $data);
        return true;
    }

    function update_hdfc_pay_details($ResResult, $ResTrackId, $ResAmount, $ResPaymentId, $ResRef, $ResTranId, $ResError) {
        //echo $ResTrackId; EXIT;
        $data = array(
            'ResResult' => $ResResult,
            'ResAmount' => $ResAmount,
            'ResPaymentId' => $ResPaymentId,
            'ResRef' => $ResRef,
            'ResTranId' => $ResTranId,
            'ResError' => $ResError
        );
        //echo '<pre>';        print_r($data); exit;

        if (!empty($data)) {
            $this->db->where('ResTrackId', $ResTrackId);
            $update = $this->db->update('hdfc_paydetails', $data);
            //echo '<pre>';            print_r($this->db->last_query());
            if ($update) {
                return true;
            } else {
                return FALSE;
            }
        }
    }

    function pay_details($mihpayid, $status, $txnid, $amount, $discount, $net_amount_debit, $addedon, $productinfo, $hash, $field1, $payment_source, $PG_TYPE, $bank_ref_num, $bankcode, $error, $error_Message, $cardnum) {
        $data = array(
            'mihpayid' => $mihpayid,
            'status' => $status,
            'txnid' => $txnid,
            'amount' => $amount,
            'discount' => $discount,
            'net_amount_debit' => $net_amount_debit,
            'addedon' => $addedon,
            'productinfo' => $productinfo,
            'hash' => $hash,
            'transac_no' => $field1,
            'payment_source' => $payment_source,
            'PG_TYPE' => $PG_TYPE,
            'bank_ref_num' => $bank_ref_num,
            'bankcode' => $bankcode,
            'error' => $error,
            'error_Message' => $error_Message,
            'cardnum' => $cardnum
        );
        $this->db->insert('pay_details', $data);
        return $this->db->insert_id();
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

    public function update_agent_withdraw_amount($agent_no, $withdraw_amount, $available_balance) {

        $data['credited_balance'] = $withdraw_amount;
        $where = "agent_no = '$agent_no'";
        $data['closing_balance'] = $available_balance;


        if ($this->db->update('agent_info', $data, $where)) {

            return true;
        } else {

            return false;
        }
    }

    public function insert_withdraw_status($agent_id, $agent_no, $withdraw_amount, $total) {

        $data['status'] = 'Accepted';
        $data['available_balance'] = $total;
        $data['agent_no'] = $agent_no;
        $data['agent_id'] = $agent_id;
        $data['withdraw_amount'] = $withdraw_amount;
        $this->db->set('transaction_datetime', 'NOW()', FALSE);
        if ($this->db->insert('agent_deposit_summary', $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function get_sum_of_withdraws($agent_no) {

        $this->db->select('withdraw_amount')->from('agent_deposit_summary')->where('status', 'Accepted')->where('agent_no', $agent_no);
        $query = $this->db->get();
        $period_array = array();
        foreach ($query->result_array() as $row) {
            $period_array[] = ($row['withdraw_amount']);
        }
        $total = array_sum($period_array);



        if ($query->num_rows > 0) {
            return $total;
        }

        return false;
    }

}
