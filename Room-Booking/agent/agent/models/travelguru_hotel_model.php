<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Travelguru_hotel_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
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

    public function booking_details($agent_id) {
        //echo $user_id; exit;
        $this->db->select('*')
                ->from('agent_info')
                ->where('agent_id', $agent_id)
                ->limit('1');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->row();
        }

        return '';
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

    public function get_hotel_search_result_info_t($id) {
        $this->db->select('*');
        $this->db->from('hotel_search_result_info_t');
        $this->db->where('hotel_search_result_info_id', $id);
        $this->db->join('api_permanent_info', 'hotel_search_result_info_t.hotel_code = api_permanent_info.hotel_code  and hotel_search_result_info_t.api = api_permanent_info.api ');
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        if ($query->num_rows() == 0) {
            return '';
        } else {
            return $query->row();
        }
    }

    function get_nationality() {
        $query = $this->db->select('*')->from('rooms_nationality')->get();
        if ($query->num_rows > 0) {
            return $query->result();
        }
    }

    function insert_hotel_temp_results($sess_id, $api_name, $RoomID, $RatePlanCode, $AmountBeforeTax, $Taxesval, $Discountval, $netrate, $RoomTypename, $NonSmoking, $adultMaxOccupancy, $childMaxOccupancy, $NonRefundable, $RatePlanDescriptionval, $RatePlanInclusionDesciptionval, $DiscountCouponDisplayIndicatorval, $HotelCode, $HotelType, $DeepLinkInformationval) {


        $agent_no = $this->session->userdata('agent_no');

        $this->db->select('markup');
        $this->db->from('b2b_markup_info');
        $this->db->where('agent_no', $agent_no);
        $this->db->where('markup_type', 'specific');
        $this->db->where('service_type', 1);
        $this->db->where('api_name', 'travelguru');
        $this->db->where('status', 1);
        $this->db->limit('1');
        $query1 = $this->db->get();

        if ($query1->num_rows > 0) {
            $res1 = $query1->row();
            $admin_markup_val = $res1->markup;
        } else {
            $this->db->select('markup');
            $this->db->from('b2b_markup_info');
            $this->db->where('agent_no', $agent_no);
            $this->db->where('markup_type', 'generic');
            $this->db->where('service_type', 1);
            $this->db->where('api_name', 'travelguru');
            $this->db->where('status', 1);
            $this->db->limit('1');
            $query2 = $this->db->get();

            if ($query2->num_rows > 0) {
                $res2 = $query2->row();
                $admin_markup_val = $res2->markup;
            } else {
                $admin_markup_val = 0;
            }
        }

        $this->db->select('markup');
        $this->db->from('agent_markup_manager');
        $this->db->where('agent_no', $agent_no);
        $this->db->where('service_type ', 1);
        $this->db->where('status', 1);
        $this->db->limit('1');
        $query3 = $this->db->get();

        if ($query3->num_rows > 0) {
            $res3 = $query3->row();
            $agent_markup_val = $res3->markup;
        } else {
            $agent_markup_val = 0;
        }

        $admin_markup = round(($netrate * ($admin_markup_val / 100)), 2);
        $agent_markup = round((($netrate + $admin_markup) * ($agent_markup_val / 100)), 2);
        $total_amount = $netrate + $admin_markup + $agent_markup;



        $data = array(
            'session_id' => $sess_id,
            'api' => $api_name,
            'hotel_code' => $HotelCode,
            'room_type_code' => $RoomID,
            'room_type_name' => $RoomTypename,
            'adult_max_occ' => $adultMaxOccupancy,
            'child_max_occ' => $childMaxOccupancy,
            'non_smoking' => $NonSmoking,
            'rate_plan_code' => $RatePlanCode,
            'non_refundable' => $NonRefundable,
            'rate_plan_description' => $RatePlanDescriptionval,
            'rate_plan_inclusion' => $RatePlanInclusionDesciptionval,
            'discount_coupon_indicator' => $DiscountCouponDisplayIndicatorval,
            'amount_before_tax' => $AmountBeforeTax,
            'tax' => $Taxesval,
            'discount' => $Discountval,
            'net_amount' => $netrate,
            'hotel_type' => $HotelType,
            'admin_markup' => $admin_markup,
            'agent_markup' => $agent_markup,
            'total_amount' => $total_amount,
            'deep_link_information' => $DeepLinkInformationval,
        );
        $this->db->insert('hotel_search_result_info_t', $data);
    }

    function get_hotel_rooms($hotel_code, $session_id) {
        $this->db->select('*')
                ->from('hotel_search_result_info_t')
                ->where('hotel_code', $hotel_code)
                ->where('session_id', $session_id)
                ->group_by('room_type_name');
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        }
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
        $this->db->delete('hotel_search_result_info_t');
    }

    function checkpermanent($HotelCode) {
        $this->db->select('*')
                ->from('api_permanent_info')
                ->where('hotel_code', $HotelCode);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    function gethotel_static_tg($HotelCode) {
        $this->db->select('*')
                ->from('hotel_overview_tg')
                ->where('hotel_code', $HotelCode);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    function insertpermanent_tg($hotel_overview) {
        $data = array(
            'api' => 'travelguru',
            'hotel_code' => $hotel_overview->hotel_code,
            'hotel_name' => $hotel_overview->hotel_name,
            'city' => $hotel_overview->city,
            'star' => $hotel_overview->star_rating,
            'image' => $hotel_overview->image_path,
            'description' => $hotel_overview->hotel_overview,
            'location' => $hotel_overview->address1,
            'latitude' => $hotel_overview->latitude,
            'longitude' => $hotel_overview->longitude,
            'address' => $hotel_overview->address,
            'time_checkin' => $hotel_overview->time_checkin,
            'time_checkout' => $hotel_overview->time_checkout,
        );
        $this->db->insert('api_permanent_info', $data);
    }

    function get_hotel_detail($hotel_id) {
        $this->db->select('n.*,m.*')
                ->from('hotel_search_result_info_t as n')
                ->join('api_permanent_info as m', 'n.hotel_code=m.hotel_code')
                ->where('n.hotel_search_result_info_id', $hotel_id);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->row();
        }
    }

    function getImag($id) {
        $this->db->select('image_url')
                ->from('hotel_images_tg')
                ->where('hotel_code', $id)
                ->limit(1);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            $te = $query->row();
            return $te->image_url;
        }
    }

    function get_hotel_images($id) {
        $this->db->select('*')
                ->from('hotel_images_tg')
                ->where('hotel_code', $id);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        }
    }

    function get_hotel_amenities($id) {
        $this->db->select('*');
        $this->db->from('hotel_facilities_tg');
        $this->db->where('hotel_code', $id);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return '';
        }
    }

    function get_country() {
        $this->db->select('*');
        $this->db->from('country');
        $query = $this->db->get();
        if ($query->num_rows > 0) {
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

    function get_passenger_details($Booking_reference_ID) {
        $this->db->select('*');
        $this->db->from('hotel_booking_pass_info');
        $this->db->where('Booking_reference_ID', $Booking_reference_ID);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        }
    }

    function get_hotel_inandaround($id) {
        $this->db->select('*');
        $this->db->from('hotel_inandaround_tg');
        $this->db->where('hotel_code', $id);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        }
    }

    function get_hotel_review($id) {
        $this->db->select('*');
        $this->db->from('hotel_reviews_tg');
        $this->db->where('hotel_code', $id);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        }
    }

    function calculate_rate($amountbeforetax = 0, $discount = 0, $tax = 0, $additionalguest = 0, $addguestdiscout = 0) {

        $netrate = ($amountbeforetax - $discount) + ($additionalguest - $addguestdiscout) + ($tax);
        return $netrate;
    }

    function detail_calculate_rate($amountbeforetax = 0, $discount = 0, $tax = 0, $additionalguest, $addguestdiscout) {

//        echo 'amount'.$amountbeforetax;
//        echo '<br>discount'.$discount;
//        echo '<br>tax'.$tax;
//        echo '<br><pre>';print_r($additionalguest);
//        echo '<pre>';print_r($addguestdiscout);
//   echo '-----------------------------------------------------------------';
        $amnt = 0;
        for ($a = 0; $a < count($additionalguest); $a++) {
            if (isset($additionalguest[$a])) {
                $gues = $additionalguest[$a];
            } else {
                $gues = 0;
            }
            if (isset($addguestdiscout[$a])) {
                $disc = $addguestdiscout[$a];
            } else {
                $disc = 0;
            }

            $amnt = ($gues - $disc) + $amnt;
        }

        $hotelsearch_data = $this->session->userdata('hotel_search_data');
        $netrate = (($amountbeforetax - $discount) + ($amnt) + ($tax)) * ($hotelsearch_data['noofnights']);
//        echo '<br>amount'.$amnt;
//        echo '<br>'.$netrate;
//        echo '<br>noofnights'.$hotelsearch_data['noofnights'].'<br><br><br><br><br><br><br><br><br>';
        // exit;
        return $netrate;
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

    function insert_hotel_booking($agent_id, $bookUniqueIDval, $sess_city, $sess_noofadult, $sess_noofchild, $sess_checkin, $sess_checkout, $sess_room_count, $sess_noofnights, $bookRoomTypeCodeval, $RoomTypename, $bookRatePlanCodeval, $bookAmountAfterTaxval, $bookCurrencyCodeval, $bookHotelCodeval, $bookHotelNameval, $hotel_disc, $lead_title, $lead_firstname, $lead_mname, $lead_lastname, $lead_email, $lead_mobile, $lead_country, $lead_city, $lead_postalcode, $bookAreaIDval, $bookaddressval, $bookCityNameval, $bookStateProvval, $bookCountryNameval, $bookcontactnumberval, $NonRefundable, $PenaltyDescriptionval, $total_amount, $admin_markup, $agent_markup, $payment_charge) {

        //echo $user_id; exit;
        $date = date('Y-m-d');
        $user_id = '0';
        $data = array(
            'user_id' => $user_id,
            'agent_id' => $agent_id,
            'Booking_reference_ID' => $bookUniqueIDval,
            'status' => 'SUCCESS',
            'api' => 'travelguru',
            'city' => $sess_city,
            'noofadult' => $sess_noofadult,
            'noofchild' => $sess_noofchild,
            'booking_date' => $date,
            'checkin' => $sess_checkin,
            'checkout' => $sess_checkout,
            'noofrooms' => $sess_room_count,
            'noofnights' => $sess_noofnights,
            'roomtypecode' => $bookRoomTypeCodeval,
            'roomtypename' => $RoomTypename,
            'rateplancode' => $bookRatePlanCodeval,
            'netrate' => $bookAmountAfterTaxval,
            'total_price' => $total_amount,
            'currency' => $bookCurrencyCodeval,
            'hotel_code' => $bookHotelCodeval,
            'hotel_name' => $bookHotelNameval,
            'hotel_discription' => $hotel_disc,
            'lead_title' => $lead_title,
            'lead_firstname' => $lead_firstname,
            'lead_mname' => $lead_mname,
            'lead_lname' => $lead_lastname,
            'lead_email' => $lead_email,
            'lead_mobile' => $lead_mobile,
            'lead_country' => $lead_country,
            'lead_city' => $lead_city,
            'lead_postalcode' => $lead_postalcode,
            'area_id' => $bookAreaIDval,
            'hotel_address' => $bookaddressval,
            'hotel_city' => $bookCityNameval,
            'admin_markup' => $admin_markup,
            'agent_markup' => $agent_markup,
            'payment_charge' => $payment_charge,
            'hotel_state' => $bookStateProvval,
            'hotel_country' => $bookCountryNameval,
            'contact_number' => $bookcontactnumberval,
            'cancel_poly_nonrefund' => $NonRefundable,
            'cancellation_disc' => $PenaltyDescriptionval,
            'Booking_Done_By' => 'agent'
        );
        $this->db->insert('hotel_booking_reports', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function insert_book_pass($booking_id, $bookUniqueIDval, $sess_atitle, $sess_afname, $sess_amname, $sess_alname, $pass_type, $sess_pcity, $sess_pcountry, $sess_pemail, $sess_pmobile) {

        $data = array(
            'hotel_booking_id' => $booking_id,
            'Booking_reference_ID' => $bookUniqueIDval,
            'title' => $sess_atitle,
            'firstname' => $sess_afname,
            'middle_name' => $sess_amname,
            'last_name' => $sess_alname,
            'pass_type' => $pass_type,
            'gender' => '',
            'pass_address' => '',
            'pass_city' => $sess_pcity,
            'pass_country' => $sess_pcountry,
            'pass_email' => $sess_pemail,
            'pass_mobile' => $sess_pmobile
        );
        $this->db->insert('hotel_booking_pass_info', $data);
    }

    function transaction_details($booking_id, $bookUniqueIDval, $pay_detail_id, $amnt, $trans_id) {
        $data = array(
            'booking_number' => $bookUniqueIDval,
            'prn_no' => $trans_id,
            'amount' => $amnt,
            'status' => 'Booked',
            'hotel_booking_id' => $booking_id,
            'payment_details_id' => $pay_detail_id,
        );
        $this->db->insert('transaction_details', $data);
        return $this->db->insert_id();
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

    function get_ticket_details($bookUniqueIDval) {

        $this->db->select('*')
                ->from('hotel_booking_pass_info')
                ->where('Booking_reference_ID', $bookUniqueIDval);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->row();
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

    function get_nearby_hotels($lat, $long, $hotel_name, $city, $sec_res) {
        // echo $this->session->userdata('sess_id'); exit;
        //echo $sec_res; exit; 
        $query = $this->db->query("SELECT *,(((acos(sin(($lat*pi()/180)) * sin((`latitude`*pi()/180))+cos(($lat*pi()/180)) * cos((`latitude`*pi()/180)) * cos((($long- `longitude`)*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance FROM hotel_search_result_info_t t, api_permanent_info p WHERE t.hotel_code = p.hotel_code AND p.city='$city' AND t.session_id = '$sec_res' GROUP BY p.hotel_name HAVING `distance` < 9 LIMIT 0,5");
        if ($query->num_rows() == '') {
            return '';
        } else {
            $res = $query->result();
            return $res;
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

    public function update_b2c_hotel_booking_status($Booking_reference_ID) {
        $data['status'] = 'Cancelled';
        $where = "Booking_reference_ID = '$Booking_reference_ID'";
        if ($this->db->update('hotel_booking_reports', $data, $where)) {
            return true;
        } else {
            return false;
        }
    }

    /* calculating rate formula for travelguru API */
}
