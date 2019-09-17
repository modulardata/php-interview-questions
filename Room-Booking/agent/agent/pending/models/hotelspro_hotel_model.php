<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Hotelspro_Hotel_Model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        $this->load->library('session');
        $this->load->database();
        parent::__construct();
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
        $this->db->select('agent_id,agent_email')
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

    public function update_deposit_request($agent_id, $available_balance) {
        if (!empty($agent_id)) {
            $data['closing_balance'] = $available_balance;
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

    function fetch_search_result_map_new() {
        $city = $this->session->userdata('hotel_search_data');
        $sec_res = $_SESSION['ses_id'];
        $this->db->select('city_name');
        $this->db->from('api_hotels_city');
        $this->db->where('city', $city['city']);
        $query = $this->db->get();
        $query->num_rows() == '';
        $ss = $query->row();
        $ciyy = $ss->city_name;
        $query = $this->db->query("SELECT SQL_CALC_FOUND_ROWS *, MIN(t.total_amount) AS low_cost FROM api_hotel_detail_t t, api_permanent_info p 
WHERE t.hotel_code = p.hotel_code  AND session_id = '" . $sec_res . "' GROUP BY t.hotel_code");
//            $query = $this->db->get();
//            echo $this->db->last_query(); exit;
        //echo $this
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->result_array();
        }
    }

    function fetch_search_result_map_new_select_session() {
        $city = $this->session->userdata('hotel_search_data');
        //echo $city['city']; exit;
        $this->db->select('city_name');
        $this->db->from('api_hotels_city');
        $this->db->where('city', $city['city']);
        $query = $this->db->get();
        $query->num_rows() == '';
        $ss = $query->row();
        $ciyy = $ss->city_name;
        //echo $ciyy; exit;
        $query = $this->db->query("SELECT  *, MIN(t.total_amount) AS low_cost FROM api_hotel_detail_t t, api_permanent_info p 
WHERE t.hotel_code = p.hotel_code AND t.api = 'hotelspro'  and p.city = '$ciyy'");
        //$query = $this->db->get();
        // echo $this->db->last_query(); exit;
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->result_array();
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

    function check_hotelspro_p_result($hotel_id) {
        $query = $this->db->query("SELECT * FROM api_permanent_info WHERE hotel_code='$hotel_id' ");
        //echo $this->db->last_query();exit;
        if ($query->num_rows == '') {
            return '';
        } else {
            return 'yes';
        }
    }

    function fetch_hotespro_hotel_list($id) {
        $que = "select * from hotel_list WHERE  HotelCode = '$id' ";
        $query = $this->db->query($que);
        //print_r("Transaction : ".$query->row()."<br>");
        //print_r("Session : ".$_SESSION."<br>");exit;
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->row();
        }
    }

    function fetch_hotespro_hotel_desc($id) {
        $que = "select * from  hotel_desc WHERE HotelCode = '$id'";
        $query = $this->db->query($que);
        //print_r("Transaction : ".$query->row()."<br>");
        //print_r("Session : ".$_SESSION."<br>");exit;
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->row();
        }
    }

    function fetch_hotespro_hotel_amenty($id) {
        $que = "select * from  hotel_amenties WHERE HotelCode = '$id'";
        $query = $this->db->query($que);
        //print_r("Transaction : ".$query->row()."<br>");
        //print_r("Session : ".$_SESSION."<br>");exit;
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->row();
        }
    }

    function insert_into_p_hotelspro($hotellist, $hoteldesc, $hotelamenty) {
        // echo 'hotellist';print_r($hotellist);
        //echo 'hoteldesc';print_r($hoteldesc);
        //echo 'hotelamenty';print_r($hotelamenty);
        //exit;
        $hotelcode = '';
        $HotelName = '';
        $Destination = '';
        $StarRating = '';
        $Latitude = '';
        $Longitude = '';
        $HotelAddress = '';
        $HotelPhoneNumber = '';
        $Chain = '';
        $HotelPostalCode = '';
        $HotelImages1 = '';
        $HotelInfo = '';
        $HotelLocation = '';
        $RAmenities = '';
        $PAmenities = '';
        if (isset($hotellist->HotelCode)) {
            $hotelcode = mysql_escape_string($hotellist->HotelCode);
        }
        if (isset($hotellist->HotelName)) {
            $HotelName = mysql_escape_string($hotellist->HotelName);
        }
        if (isset($hotellist->Destination)) {
            $Destination = mysql_escape_string($hotellist->Destination);
        }
        if (isset($hotellist->StarRating)) {
            $StarRating = mysql_escape_string($hotellist->StarRating);
        }
        if (isset($hotellist->Latitude)) {
            $Latitude = mysql_escape_string($hotellist->Latitude);
        }
        if (isset($hotellist->Longitude)) {
            $Longitude = mysql_escape_string($hotellist->Longitude);
        }
        if (isset($hotellist->HotelAddress)) {
            $HotelAddress = mysql_escape_string($hotellist->HotelAddress);
        }
        if (isset($hotellist->HotelPhoneNumber)) {
            $HotelPhoneNumber = mysql_escape_string($hotellist->HotelPhoneNumber);
        }
        if (isset($hotellist->Chain)) {
            $Chain = mysql_escape_string($hotellist->Chain);
        }
        if (isset($hotellist->HotelPostalCode)) {
            $HotelPostalCode = mysql_escape_string($hotellist->HotelPostalCode);
        }
        if (isset($hotellist->HotelImages1)) {
            $HotelImages1 = mysql_escape_string($hotellist->HotelImages1);
        }

        if (isset($hoteldesc->HotelInfo)) {
            $HotelInfo = mysql_escape_string($hoteldesc->HotelInfo);
        }
        if (isset($hoteldesc->HotelLocation)) {
            $HotelLocation = mysql_escape_string($hoteldesc->HotelLocation);
        }

        if (isset($hotelamenty->RAmenities)) {
            $RAmenities = mysql_escape_string($hotelamenty->RAmenities);
        }
        if (isset($hotelamenty->PAmenities)) {
            $PAmenities = mysql_escape_string($hotelamenty->PAmenities);
        }


        $que = "insert into api_permanent_info(id,api,hotel_code,hotel_name,city,star,image,description,location,latitude,longitude,address,phone,fax,chain,postal,email,web,coun,room_facilities,hotel_facilities)
            values ('','hotelspro','$hotelcode','$HotelName','$Destination','$StarRating','$HotelImages1','$HotelInfo','$HotelLocation','$Latitude','$Longitude','$HotelAddress','$HotelPhoneNumber','','$Chain','$HotelPostalCode','','','','$RAmenities','$PAmenities')";
        //echo $que;exit;
        $query = $this->db->query($que);
        //print_r("Transaction : ".$query->row()."<br>");
        //print_r("Session : ".$_SESSION."<br>");exit;
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

    public function get_agent_account_balance($agent_id) {
        $this->db->select('*')
                ->from('agent_deposit_summary')
                ->where('agent_id', $agent_id)
                ->order_by('available_balance', 'DESC')
                ->order_by('deposit_id', 'DESC')
                ->limit(1);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->row();
//            echo $this->db->last_query();
//            exit;
        }

        return false;
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

    public function add_agent($agent_email, $agent_password, $agency_name, $currency_type, $title, $first_name, $middle_name, $last_name, $mobile_no, $office_phone_no, $address, $pin_code, $city, $state, $country, $image_path, $payment_type) {
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
            'agent_type' => $payment_type,
            'payment_type' => $payment_type
        );

        $this->db->set('register_date', 'NOW()', FALSE);

        $this->db->insert('agent_info', $data);
        $id = $this->db->insert_id();
        if (!empty($id)) {
            $agent_no = 'FB' . $id . rand(1000, 9999);

            $data1 = array('agent_no' => $agent_no);
            $this->db->where('agent_id', $id);
            $this->db->update('agent_info', $data1);

            return true;
        } else {
            return false;
        }
    }

//    function insert_hotel_temp_results($sess_id, $api_name, $RoomID, $RatePlanCode, $AmountBeforeTax, $Taxesval, $Discountval, $netrate, $RoomTypename, $NonSmoking, $adultMaxOccupancy, $childMaxOccupancy, $NonRefundable, $RatePlanDescriptionval, $RatePlanInclusionDesciptionval, $DiscountCouponDisplayIndicatorval, $HotelCode, $HotelType, $DeepLinkInformationval) {
//
//        $data = array(
//            'session_id' => $sess_id,
//            'api' => $api_name,
//            'hotel_code' => $HotelCode,
//            'room_type_code' => $RoomID,
//            'room_type_name' => $RoomTypename,
//            'adult_max_occ' => $adultMaxOccupancy,
//            'child_max_occ' => $childMaxOccupancy,
//            'non_smoking' => $NonSmoking,
//            'rate_plan_code' => $RatePlanCode,
//            'non_refundable' => $NonRefundable,
//            'rate_plan_description' => $RatePlanDescriptionval,
//            'rate_plan_inclusion' => $RatePlanInclusionDesciptionval,
//            'discount_coupon_indicator' => $DiscountCouponDisplayIndicatorval,
//            'amount_before_tax' => $AmountBeforeTax,
//            'tax' => $Taxesval,
//            'discount' => $Discountval,
//            'net_amount' => $netrate,
//            'hotel_type' => $HotelType,
//            'deep_link_information' => $DeepLinkInformationval,
//            'curr_date' => $now,
//        );
//        $this->db->insert('hotel_search_result_info_t', $data);
//    }

    function delete_hotel_temp_result($sess_id) {
        $this->db->where('session_id', $sess_id);
        $this->db->delete('api_hotel_detail_t');
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

    function fetch_board_type($city) {
        $this->db->select('inclusion,api_temp_hotel_id');
        $this->db->from('api_hotel_detail_t');
        $this->db->where('city', $city);
        $this->db->group_by('inclusion');

        $query = $this->db->get();
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->result();
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

    function insert_gta_temp_result($sec_res, $api, $itemCode, $room_code, $room_type, $cost_val, $status_val, $meals_val, $adult, $child, $amountv3, $org_amt, $currencyv1, $c_val, $amountv3pay, $city = '', $room_count) {
        $data = array(
            'session_id' => $sec_res,
            'api' => $api,
            'hotel_code' => $itemCode,
            'room_code' => $room_code,
            'room_type' => $room_type,
            'inclusion' => $meals_val,
            'total_amount' => $cost_val,
            'city' => $city,
            'status' => $status_val,
            'adult' => $adult,
            'child' => $child,
            'currency_val' => $c_val,
            'xml_currency' => $currencyv1,
            'org_amt' => $org_amt,
            'markup' => $amountv3,
            'payment_charge' => $amountv3pay,
            'room_count' => $room_count
        );
        $this->db->insert('api_hotel_detail_t', $data);
        //echo $this->db->last_query();exit;
        return $this->db->insert_id();
    }

    function get_b2b_markup($agent_no) {
        $this->db->select('markup');
        $this->db->from('b2b_markup_info');
        $this->db->where('markup_type', 'specific');
        $this->db->where('agent_no', $agent_no);
        $this->db->where('service_type', 1);
        $this->db->where('status', 1);
        $this->db->where('api_name', 'hotelspro');
        $this->db->limit('1');

        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->row();
        } else {
            $this->db->select('markup');
            $this->db->from('b2b_markup_info');
            $this->db->where('markup_type', 'generic');
            $this->db->where('service_type', 1);
            $this->db->where('agent_no', $agent_no);
            $this->db->where('api_name', 'hotelspro');
            $this->db->where('status', 1);
            $this->db->limit('1');
            $query = $this->db->get();
            if ($query->num_rows > 0) {
                return $query->row();
            } else {
                return 0;
            }
        }
    }

    function get_agent_markup($agent_no) {

        $this->db->select('markup');
        $this->db->from('agent_markup_manager');
        $this->db->where('service_type', 1);
        $this->db->where('status', 1);
        $this->db->where('agent_no', $agent_no);
        $this->db->limit('1');
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->row();
        } else {
            return 0;
        }
    }

    function test($agent_id, $year, $month) {

        $this->db->select('*');
        $this->db->from('report_table');
        $this->db->where('agent_id', $agent_id);
        $this->db->where('year', $year);
        $this->db->where('month', $month);

        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return 0;
        }
    }

    function insert_temp_results($temp_result) {
        $this->db->insert_batch('api_hotel_detail_t', $temp_result);
    }

    function fetch_hotel_result($sess_id) {
        $this->db->select('m.*,n.*');
        $this->db->from('api_hotel_detail_t as n');
        $this->db->join('api_permanent_info as m', 'm.hotel_code=n.hotel_code');
        $this->db->where('n.session_id', $sess_id);
        $this->db->group_by('n.hotel_code');
        $this->db->order_by('n.total_amount', 'ASC');
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return '';
        }
    }

    function fetch_hotel_result_details($session_id, $hotel_code) {
        $this->db->select('*');
        $this->db->from('api_hotel_detail_t');
        $this->db->where('session_id', $session_id);
        $this->db->where('hotel_code', $hotel_code);
        $this->db->order_by('total_amount', 'ASC');
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return '';
        }
    }

    public function getAgentAccountInfo($agent_id) {
        $this->db->select('*')
                ->from('agent_deposit_summary')
                ->where('agent_id', $agent_id)
                ->order_by('acc_id', 'DESC')
                ->limit(1);
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        if ($query->num_rows > 0) {
            return $query->row();
        }

        return false;
    }

    function get_cancel_attrib_new($result_id) {
        //echo $result_id;exit;
        $this->db->select('*');
        $this->db->from('api_hotel_detail_t');
        $this->db->where('api_temp_hotel_id', $result_id);
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->row();
        }
    }

    function api_status_id() {
        $que = "select api_name from api where active='1'";
        $query = $this->db->query($que);
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->result();
        }
    }

    function api_status($api) {
        $que = "select * from  api where api_name='$api'";
        $query = $this->db->query($que);
        if ($query->num_rows() == '') {
            return '';
        } else {
            $a = $query->row();
            return $a->active;
        }
    }

    function get_cancel_attrib_new_nerw($result_id, $idddss) {
        //echo $result_id;exit;
        $this->db->select('*');
        $this->db->from('api_permanent_info');
        $this->db->where('hotel_code', $result_id);
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        if ($query->num_rows() == '') {
            return '';
        } else {
            $a = $query->row();
            $coun_val = $a->coun;
            if ($coun_val == 0) {
                $coun_valaa = $coun_val + substr($idddss, -2);
            } else {
                $coun_valaa = $coun_val + 1;
            }
            $this->db->query("UPDATE api_permanent_info SET coun='$coun_valaa' WHERE hotel_code='$result_id'");
        }
    }

    function get_searchresult($id) {
        $this->db->select('*');
        $this->db->from('api_hotel_detail_t');
        $this->db->where('api_temp_hotel_id', $id);
        $this->db->join('api_permanent_info', 'api_hotel_detail_t.hotel_code = api_permanent_info.hotel_code  and api_hotel_detail_t.api = api_permanent_info.api ');
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        if ($query->num_rows() == 0) {
            return '';
        } else {
            return $query->row();
        }
    }

    function get_facility_details($id) {
        $this->db->select('*');
        $this->db->from('api_permanent_facility');
        $this->db->where('hotel_code', $id);
        $query = $this->db->get();
//		echo $this->db->last_query();exit;
        if ($query->num_rows() == 0) {
            return '';
        } else {
            return $query->result();
        }
    }

    function get_hotel_facility() {
        $this->db->select('*');
        $this->db->from('api_permanent_facility_hotel');
        $this->db->where('hotel_code', $id);
        $this->db->where('fac_type', 'hotel');
        $this->db->group_by("fac");
        $query = $this->db->get();
//		echo $this->db->last_query();exit;
        if ($query->num_rows() == 0) {
            return '';
        } else {
            return $query->result();
        }
    }

    function get_room_facility() {
        $this->db->select('*');
        $this->db->from('api_permanent_facility_room');
        $this->db->where('fac_type', 'room');
        $this->db->group_by("fac");
        $query = $this->db->get();
//		echo $this->db->last_query();exit;
        if ($query->num_rows() == 0) {
            return '';
        } else {
            return $query->result();
        }
    }

    function get_facility_details_hotel($id) {
        $this->db->select('*');
        $this->db->from('api_permanent_facility_hotel');
        $this->db->where('hotel_code', $id);
        $this->db->where('fac_type', 'hotel');
        $this->db->group_by("fac");
        $query = $this->db->get();
//		echo $this->db->last_query();exit;
        if ($query->num_rows() == 0) {
            return '';
        } else {
            return $query->result();
        }
    }

    function get_facility_details_room($id) {
        $this->db->select('*');
        $this->db->from('api_permanent_facility_room');
        $this->db->where('hotel_code', $id);
        $this->db->where('fac_type', 'room');
        $this->db->group_by("fac");
        $query = $this->db->get();
//		echo $this->db->last_query();exit;
        if ($query->num_rows() == 0) {
            return '';
        } else {
            return $query->result();
        }
    }

    function get_nearby_hotels($lat, $long, $hotel_name, $city, $sec_res) {
        // echo $this->session->userdata('sess_id'); exit;
        //echo $sec_res; exit; 
        $query = $this->db->query("SELECT *,(((acos(sin(($lat*pi()/180)) * sin((`latitude`*pi()/180))+cos(($lat*pi()/180)) * cos((`latitude`*pi()/180)) * cos((($long- `longitude`)*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance FROM api_hotel_detail_t t, api_permanent_info p WHERE t.hotel_code = p.hotel_code AND p.city='$city' AND t.session_id = '$sec_res' GROUP BY p.hotel_name HAVING `distance` < 9 LIMIT 0,5");
        if ($query->num_rows() == '') {
            return '';
        } else {
            $res = $query->result();
            return $res;
        }
    }

    function get_hotelbed_hotel_pro_image($HotelCode) {
        $query = $this->db->query("SELECT * FROM hotel_list  where HotelCode='$HotelCode'");
        if ($query->num_rows == '') {
            return '';
        } else {
            return $query->row();
        }
    }

    function fetch_gta_temp_result_room_result_id($ses_id, $hotel_code) {
        $this->db->select('*');
        $this->db->from('api_hotel_detail_t');
        $this->db->where('session_id', $ses_id);
        $this->db->where('api_temp_hotel_id', $hotel_code);
        $query = $this->db->get();
        //echo $this->db->last_query();	exit;
        return $query->row();
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

    function get_currecy_value() {
        $this->db->select('*')
                ->from('currency_converter');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
    }

    function get_currecy_details($val) {
        $que = "select * from  currency_converter where country='$val' ";
        $query = $this->db->query($que);
        //echo $this->db->last_query(); exit;
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->row();
        }
    }

    function get_markup_detail($val, $country) {
        $que = "select * from  b2c_markup where api='$val' and country='$country' and status='1' ";
        $query = $this->db->query($que);
        //echo $this->db->last_query();exit;
        if ($query->num_rows() == '') {
            $que = "select * from  b2c_markup where api='$val' and type='generic' and status='1'	 ";
            $query = $this->db->query($que);
            if ($query->num_rows() == '') {
                return 0;
            } else {
                $sd = $query->row();
                return $sd->markup;
            }
        } else {
            $sd = $query->row();
            return $sd->markup;
        }
    }

    function get_payment_charge() {
        $select = "SELECT charge FROM payment_gateway where id = 1";
        $query = $this->db->query($select);
        if ($query->num_rows() > 0) {
            $a = $query->row();
            return $a->charge;
        } else {
            return 0;
        }
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

    public function update_agent($agent_id, $agency_name, $currency_type, $title, $first_name, $middle_name, $last_name, $mobile_no, $office_phone_no, $address, $pin_code, $city, $state, $country, $image_path, $agent_type) {
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
            'agent_type' => $agent_type,
            'payment_type' => $agent_type
        );

        $this->db->where('agent_id', $agent_id);
        if ($this->db->update('agent_info', $data)) {
            return true;
        } else {
            return false;
        }
    }

    function Update_room_type_in_search_result($result_id, $hotel_proid, $totalRoomRate, $admin_markup, $agent_markup, $total_amount, $room, $boardType, $currencyv1, $c_val) {
        $this->db->query("UPDATE api_hotel_detail_t SET room_code='$hotel_proid',
	 room_type='$room',
	 agent_markup='$agent_markup',
         admin_markup='$admin_markup',
	 inclusion='$boardType',
	 totalPrice='$totalRoomRate',
         total_amount='$total_amount',
	 xml_currency='$currencyv1',
	 currency_val='$c_val'
	  WHERE api_temp_hotel_id	='$result_id'");
    }

    function transation_detail($tran_id) {
        $this->db->select('*');
        $this->db->from('transaction_details');
        $this->db->where('transaction_details_id', $tran_id);
        $query = $this->db->get();
        return $query->row();
    }

    function contact_info_detail_update($tran_id) {
        $this->db->select('*');
        $this->db->from('customer_contact_details');
        $this->db->where('customer_contact_details_id', $tran_id);
        $query = $this->db->get();
        return $query->row();
    }

    function pass_info_detail($con_id) {
        $que = "select * from  customer_info_details WHERE customer_info_details_id = " . $con_id . " or parent_id = " . $con_id . "";
        $query = $this->db->query($que);
        /* echo $this->db->last_query();
          print_r($query->result()); exit; */
        if ($query->num_rows() < 0) {
            return '';
        } else {
            return $query->result();
        }
    }

    function inser_customer_book_hotelpro($h_hotel_id, $agent_id, $agent_no, $h_hotel_name, $h_star, $h_description, $h_address, $h_phone, $h_fax, $h_room_type, $h_cancel_policy, $cin, $cout, $date, $roomcountss, $user_id, $nights, $trans_id, $h_adult, $h_child, $con_id, $dateFromValc, $h_city, $api) {
        $data = array(
            'customer_contact_details_id' => $con_id,
            'agent_id' => $agent_id,
            'agent_no' => $agent_no,
            'hotel_code' => $h_hotel_id,
            'hotel_name' => $h_hotel_name,
            'star' => $h_star,
            'description' => $h_description,
            'address' => $h_address,
            'api' => $api,
            'phone' => $h_phone,
            'fax' => $h_fax,
            'room_type' => $h_room_type,
            'cancel_policy' => $h_cancel_policy,
            'check_in' => $cin,
            'check_out' => $cout,
            'voucher_date' => $date,
            'no_of_room' => $roomcountss,
            'provider_id' => '1',
            'nights' => $nights,
            'adult' => $h_adult,
            'child' => $h_child,
            'cancel_tilldate' => $dateFromValc,
            'city' => $h_city
        );

        $this->db->insert('hotel_booking_info', $data);
        //echo $this->db->last_query();exit;
        return $this->db->insert_id();
    }

    function inser_customer_book_hotelpro_trans_hotel($trans_id, $ConfirmationNumbervalue, $userid, $val_last, $status = '', $payment_id, $random_id) {
        $ss = $this->session->userdata('session_id');
        $m = 'BI' . date('d') . date('m') . ($trans_id + 10000);
        $this->db->query("UPDATE transaction_details SET prn_no='$m', 	booking_number='$ConfirmationNumbervalue',  user_id='$userid' , hotel_booking_id='$val_last',  user_id='$userid',  status='$status' , session='$ss', payment_details_id='$payment_id',random_payment_id='$random_id'  WHERE customer_contact_details_id ='$trans_id'");
        //echo $this->db->last_query();exit;
        //return $this->db->update_id();
    }

    function book_detail_view_voucher1($book_id) {
        $this->db->select('*');
        $this->db->from('hotel_booking_info');
        $this->db->where('hotel_booking_info_id', $book_id);
        //$this->db->where('agent_id', $this->session->userdata('agentid'));
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->row();
        }
    }

    function transation_detail_contact($id) {
        $que = "select * from  transaction_details WHERE customer_contact_details_id = " . $id . " ";
        $query = $this->db->query($que);
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->row();
        }
    }

    function gethb_hoteldetails($id) {
        $this->db->select('*');
        $this->db->from('hb_contact');
        $this->db->where('HOTELCODE', $id);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return '';
        } else {
            return $query->row();
        }
    }

    function gethb_hotelimage_new($hotelCode) {
        //$val="GEN";
        $query = $this->db->query("SELECT * FROM  hotel_list WHERE HotelCode='$hotelCode'");
        if ($query->num_rows == '') {
            return '';
        } else {
            return $query->result();
        }
    }

    function get_hotelimage($hotelCode) {
        $query = $this->db->query("SELECT * FROM  api_permanent_info WHERE hotel_code='$hotelCode'");
        if ($query->num_rows == '') {
            return '';
        } else {
            return $query->row();
        }
    }

    public function get_hotel_booking_summary($agent_id) {
        $this->db->select('hotel_booking_info.*,transaction_details.*,customer_contact_details.*')
                ->from('hotel_booking_info')
                ->join('transaction_details', 'hotel_booking_info.customer_contact_details_id = transaction_details.customer_contact_details_id')
                ->join('customer_contact_details', 'hotel_booking_info.customer_contact_details_id = customer_contact_details.customer_contact_details_id')
                ->where('hotel_booking_info.agent_id', $agent_id)
                ->order_by('hotel_booking_info.hotel_booking_info_id', 'DESC');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
    }

    public function get_hotel_conformed_summary($agent_id) {
        $this->db->select('hotel_booking_info.*,transaction_details.*')
                ->from('hotel_booking_info')
                ->join('transaction_details', 'hotel_booking_info.customer_contact_details_id = transaction_details.customer_contact_details_id')
                ->where('hotel_booking_info.agent_id', $agent_id)
                ->where('status', 'Confirmed')
                ->order_by('hotel_booking_info.hotel_booking_info_id', 'DESC');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
    }

    public function get_hotel_cancelled_summary($agent_id) {
        $this->db->select('hotel_booking_info.*,transaction_details.*')
                ->from('hotel_booking_info')
                ->join('transaction_details', 'hotel_booking_info.customer_contact_details_id = transaction_details.customer_contact_details_id')
                ->where('hotel_booking_info.agent_id', $agent_id)
                ->where('status', 'Cancelled')
                ->order_by('hotel_booking_info.hotel_booking_info_id', 'DESC');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
    }

    public function get_hotel_rejected_summary($agent_id) {
        $this->db->select('hotel_booking_info.*,transaction_details.*')
                ->from('hotel_booking_info')
                ->join('transaction_details', 'hotel_booking_info.customer_contact_details_id = transaction_details.customer_contact_details_id')
                ->where('hotel_booking_info.agent_id', $agent_id)
                ->where('status', 'Rejected')
                ->where('status', '')
                ->order_by('hotel_booking_info.hotel_booking_info_id', 'DESC');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
    }

    public function get_available_balance($agent_id) {
        $this->db->select('*')
                ->from('agent_deposit_summary')
                ->where('agent_id', $agent_id)
                ->where('status', 'Pending')
                ->limit('1');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
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

    public function update_transaction_amount($agent_id, $agent_no, $amount, $desc, $transaction_id) {
        $data = array(
            'agent_id' => $agent_id,
            'agent_no' => $agent_no,
            'transaction_summary' => $desc,
            'withdraw_amount' => $amount,
            'transaction_id' => $transaction_id,
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

    public function update_agent_withdraw_amount($agent_no, $withdraw_amount, $available_balance ) {

        $data['credited_balance'] = $withdraw_amount;
        $where = "agent_no = '$agent_no'";
        $data['closing_balance'] = $available_balance;
        
     
        if ($this->db->update('agent_info', $data, $where)) {
         
            return true;
        } else {
           
            return false;
        }
    }

    function view_trans_detail_id($id) {
        $this->db->select('*');
        $this->db->from('transaction_details');
        $this->db->where('transaction_details_id', $id);
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->row();
        }
    }

}
