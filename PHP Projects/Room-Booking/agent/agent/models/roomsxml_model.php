<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Roomsxml_Model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function delete_temp_result($sess_id) {
        $this->db->where('session_id', $sess_id);
        $this->db->delete('api_hotel_info_t');
    }

    function insert_booking_report_data($agent_id, $CommitLevel, $Book_reference, $RefNo, $Booking_Date, $Book_hotelid, $Book_currency, $admin_markup, $agent_markup, $Book_totamnt, $total_price, $Book_Status, $Book_PayableBy, $Book_VoucherRef, $Booking_Done_By, $api) {
        $data = array(
            'agent_id' => $agent_id,
            'user_id' => '0',
            'Hotel_RefNo' => $Book_VoucherRef,
            'Booking_reference_ID' => $Book_reference,
            'RefNo' => $RefNo,
            'status' => $Book_Status,
            'booking_date' => $Booking_Date,
            'api' => $api,
            'netrate' => $Book_totamnt,
            'admin_markup' => $admin_markup,
            'agent_markup' => $agent_markup,
            'total_price' => $total_price,
            'currency' => $Book_currency,
            'Booking_Done_By' => $Booking_Done_By
        );
        $this->db->insert('hotel_booking_reports_rooms', $data);
        return $this->db->insert_id();
    }

    function insert_hotel_booking_information_data($RefNo, $Book_Hotelcode, $Book_HotelName, $city, $checkIn, $checkOut, $Booking_Date, $Book_RoomTypeval, $roomcount, $Book_Nights, $api, $adultvalue, $childvalue, $star, $image, $description, $address, $phone, $fax, $adultcount, $childcount,$agent_id) {
        $data = array(
            'user_id' => '0',
            'agent_id' => $agent_id,
            'RefNo' => $RefNo,
            'hotel_code' => $Book_Hotelcode,
            'hotel_name' => $Book_HotelName,
            'city_code' => $city,
            'check_in' => $checkIn,
            'check_out' => $checkOut,
            'voucher_date' => $Booking_Date,
            'city' => $city,
            'room_type' => $Book_RoomTypeval,
            'room_count' => $roomcount,
            'nights' => $Book_Nights,
            'api' => $api,
            'star' => $star,
            'image' => $image,
            'description' => $description,
            'address' => $address,
            'phone' => $phone,
            'fax' => $fax,
            'adult' => $adultcount,
            'child' => $childcount
        );
        $this->db->insert('hotel_booking_hotels_info', $data);
        //echo $this->db->last_query();exit;	
        $insert_id = $this->db->insert_id();

        if ($insert_id) {
            $adt = 0;
            $chd = 0;
            for ($i = 0; $i < $roomcount; $i++) {
                $passenger_info = $this->session->userdata('passenger_info');

                $adultTitles = $passenger_info['adults_title'];
                $adultFNames = $passenger_info['adults_fname'];
                $adultLNames = $passenger_info['adults_lname'];

                if (isset($passenger_info['childs_title'])) {
                    $childTitles = $passenger_info['childs_title'];
                    $childFNames = $passenger_info['childs_fname'];
                    $childLNames = $passenger_info['childs_lname'];
                }

                $user_email = $passenger_info['user_email'];
                $user_mobile = $passenger_info['user_mobile'];

                //$zip_code 	= $passenger_info['user_zipcode'];
                //$city 		= $passenger_info['user_city'];
                //$state	 	= $passenger_info['user_state'];
                $mobile = $passenger_info['user_mobile'];
                $email = $passenger_info['user_email'];
                //$address	= $passenger_info['user_address'];
                //$country	= $passenger_info['user_country'];


                for ($a = $adt; $a < $adultvalue[$i]; $a++) {
                    $adult_data = array('RefNo' => $RefNo,
                        'passenger_type' => 'adult',
                        'title' => $adultTitles[$a],
                        'first_name' => $adultFNames[$a],
                        'last_name' => $adultLNames[$a],
                        'room_no' => $i + 1,
                        'mobile' => $mobile,
                        'email' => $email
                    );

                    $this->db->insert('hotel_booking_passengers_info', $adult_data);

                    $adt++;
                }

                if (array_key_exists($i, $childvalue) && $childvalue[$i] != '') {
                    for ($c = $chd; $c < $childvalue[$i]; $c++) {

                        $age = 5;

                        $child_data = array('RefNo' => $RefNo,
                            'passenger_type' => 'child',
                            'title' => $childTitles[$c],
                            'first_name' => $childFNames[$c],
                            'last_name' => $childLNames[$c],
                            'room_no' => $i + 1,
                            'child_age' => $age
                        );

                        $this->db->insert('hotel_booking_passengers_info', $child_data);

                        $chd++;
                    }
                }
            }
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

    function get_hotel_details($hotel_code) {
        $query = $this->db->select('*')->from('api_permanent_info')->where('hotel_code', $hotel_code)->get();
        if ($query->num_rows > 0) {
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
        $this->db->select('*')
                ->from('api_hotel_info_t')
                ->where('api_temp_hotel_id', $hotel_id);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->row();
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
        public function update_b2c_rooms_hotel_booking_status($Book_reference) {
        $data['status'] = 'Cancelled';
        $where = "Booking_reference_ID = '$Book_reference'";
        if ($this->db->update('hotel_booking_reports_rooms', $data, $where)) {
            return true;
        } else {
            return false;
        }
    }

}
