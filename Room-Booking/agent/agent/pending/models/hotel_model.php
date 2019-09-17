<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Hotel_Model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
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
            'agent_logo' => $image_path
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
        if ($this->db->update('agent_info', $data)) {
            return true;
        } else {
            return false;
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

    function pass_info_detail($tran_id) {
        $que = "select * from  customer_info_details WHERE customer_info_details_id = " . $tran_id . " or parent_id = " . $tran_id . "";
        $query = $this->db->query($que);
        /* echo $this->db->last_query();
          print_r($query->result()); exit; */
        if ($query->num_rows() < 0) {
            return '';
        } else {
            return $query->result();
        }
    }

    function inser_customer_book_hotelpro($h_hotel_id, $agent_id, $h_hotel_name, $h_star, $h_description, $h_address, $h_phone, $h_fax, $h_room_type, $h_cancel_policy, $cin, $cout, $date, $roomcountss, $agent_id, $nights, $trans_id, $h_adult, $h_child, $con_id, $dateFromValc, $h_city, $api) {
        $data = array(
            'customer_contact_details_id' => $con_id,
            'agent_id' => $agent_id,
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

    function inser_customer_book_hotelpro_trans_hotel($trans_id, $ConfirmationNumbervalue, $agent_id, $val_last, $status = '') {
        $ss = $this->session->userdata('session_id');
        $m = 'BI' . date('d') . date('m') . ($trans_id + 10000);
        $this->db->query("UPDATE transaction_details SET prn_no='$m', 	booking_number='$ConfirmationNumbervalue',  agent_id='$agent_id' , hotel_booking_id='$val_last',  agent_id='$agent_id',  status='$status' , session='$ss'  WHERE customer_contact_details_id ='$trans_id'");
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

    function get_nearby_hotels_int($lat, $long, $hotel_name, $city, $sec_res) {
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

    function Update_room_type_in_search_result($result_id, $hotel_proid, $amountv4, $room, $amountv3, $boardType, $org_amt, $currencyv1, $c_val, $amountv3pay) {
        $this->db->query("UPDATE api_hotel_detail_t SET room_code='$hotel_proid',
	 total_cost	='$amountv4',
	 room_type='$room',
	 markup='$amountv3',
	 inclusion='$boardType',
	 org_amt='$org_amt',
	 xml_currency='$currencyv1',
	 currency_val='$c_val',
	 payment_charge='$amountv3pay'
	  WHERE api_temp_hotel_id	='$result_id'");
    }

    function insert_flight_temp_results($sess_id, $api_name, $SequenceNumber, $UniqueIdentifier, $OriginDestinationRPH, $FlightID, $SupplierSystem, $originCode, $destinationCode, $adults, $childs, $infants, $Total_Duration, $ArrivalDateTime, $DepartureDateTime, $Duration, $FlightNumber, $SeatToSell, $FareType, $ResBookDesigCode, $Departure_AirPortName, $Departure_CityName, $Departure_LocationCode, $Departure_Terminal, $Arrival_AirPortName, $Arrival_CityName, $Arrival_LocationCode, $Arrival_Terminal, $AirEquipType, $MarketingAirline_Code, $MarketingAirline_Name, $Stops, $BaseFare, $CurrencyCode, $Tax_Amount, $TaxCode, $TaxDescription, $TotalFare, $ServiceTax, $Fee_Amount, $FeeCode, $PassengerType, $PassengerQuantity, $PassengerBaseFare, $PassengerTax_Amount, $PassengerTaxCode, $PassengerTaxDescription, $PassengerTotalFare, $PassengerServiceTax, $Trip_Type, $Service_Type) {

        $data = array('session_id' => $sess_id,
            'api' => $api_name,
            'SequenceNumber' => $SequenceNumber,
            'UniqueIdentifier' => $UniqueIdentifier,
            'OriginDestinationRPH' => $OriginDestinationRPH,
            'FlightID' => $FlightID,
            'SupplierSystem' => $SupplierSystem,
            'Origin' => $originCode,
            'Destination' => $destinationCode,
            'Adults' => $adults,
            'Childs' => $childs,
            'Infants' => $infants,
            'Total_Duration' => $Total_Duration,
            'ArrivalDateTime' => $ArrivalDateTime,
            'DepartureDateTime' => $DepartureDateTime,
            'Duration' => $Duration,
            'FlightNumber' => $FlightNumber,
            'SeatToSell' => $SeatToSell,
            'FareType' => $FareType,
            'ResBookDesigCode' => $ResBookDesigCode,
            'Departure_AirPortName' => $Departure_AirPortName,
            'Departure_CityName' => $Departure_CityName,
            'Departure_LocationCode' => $Departure_LocationCode,
            'Departure_Terminal' => $Departure_Terminal,
            'Arrival_AirPortName' => $Arrival_AirPortName,
            'Arrival_CityName' => $Arrival_CityName,
            'Arrival_LocationCode' => $Arrival_LocationCode,
            'Arrival_Terminal' => $Arrival_Terminal,
            'AirEquipType' => $AirEquipType,
            'MarketingAirline_Code' => $MarketingAirline_Code,
            'MarketingAirline_Name' => $MarketingAirline_Name,
            'Stops' => $Stops,
            'BaseFare' => $BaseFare,
            'CurrencyCode' => $CurrencyCode,
            'Tax_Amount' => $Tax_Amount,
            'Tax_Code' => $TaxCode,
            'Tax_Description' => $TaxDescription,
            'TotalFare' => $TotalFare,
            'ServiceTax' => $ServiceTax,
            'Fee_Amount' => $Fee_Amount,
            'Fee_Code' => $FeeCode,
            'PassengerType' => $PassengerType,
            'PassengerQuantity' => $PassengerQuantity,
            'PassengerBaseFare' => $PassengerBaseFare,
            'PassengerTax_Amount' => $PassengerTax_Amount,
            'PassengerTax_Code' => $PassengerTaxCode,
            'PassengerTax_Description' => $PassengerTaxDescription,
            'PassengerTotalFare' => $PassengerTotalFare,
            'PassengerServiceTax' => $PassengerServiceTax,
            'Trip_Type' => $Trip_Type,
            'Service_Type' => $Service_Type
        );

        $this->db->insert('flight_search_result_info', $data);
        //echo $this->db->last_query(); exit;
        return $this->db->insert_id();
    }

    function get_hotel_detail($hotel_id) {
        //echo $hotel_id; exit;
        $this->db->select('n.*,m.*')
                ->from('api_hotel_detail_t as n')
                ->join('api_permanent_info as m', 'n.hotel_code=m.hotel_code')
                ->where('n.api_temp_hotel_id', $hotel_id);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->row();
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
        $data = array(
            'session_id' => $sec_res,
            'api' => $api,
            'hotel_code' => $itemCode,
            'room_code' => $room_code,
            'room_type' => $room_type,
            'inclusion' => $meals_val,
            'total_cost' => $cost_val,
            'city' => $city,
            'status' => $status_val,
            'adult' => $adult,
            'child' => $child,
            'currency_val' => $c_val,
            'xml_currency' => $currencyv1,
            'org_amt' => $org_amt,
            'markup' => $amountv3,
            'payment_charge' => $amountv3pay
        );
        $this->db->insert('api_hotel_detail_t', $data);
        //echo $this->db->last_query();exit;
        return $this->db->insert_id();
    }

    function insert_hotel_tg_results($sec_res, $api, $itemCode, $room_code, $room_type, $cost_val, $status_val, $meals_val, $adult, $child, $amountv3, $org_amt, $currencyv1, $c_val, $amountv3pay, $city = '') {
        $data = array(
            'session_id' => $sec_res,
            'api' => $api,
            'hotel_code' => $itemCode,
            'room_code' => $room_code,
            'room_type' => $room_type,
            'inclusion' => $meals_val,
            'total_cost' => $cost_val,
            'city' => $city,
            'status' => $status_val,
            'adult' => $adult,
            'child' => $child,
            'currency_val' => $c_val,
            'xml_currency' => $currencyv1,
            'org_amt' => $org_amt,
            'markup' => $amountv3,
            'payment_charge' => $amountv3pay
        );
        $this->db->insert('api_hotel_detail_t', $data);
        //echo $this->db->last_query();exit;
        return $this->db->insert_id();
    }

//    function insert_hotel_tg_results_dom($sess_id, $api_name, $RoomID, $RatePlanCode, $AmountBeforeTax, $Taxesval, $Discountval, $netrate, $RoomTypename, $NonSmoking, $adultMaxOccupancy, $childMaxOccupancy, $NonRefundable, $RatePlanDescriptionval, $RatePlanInclusionDesciptionval, $DiscountCouponDisplayIndicatorval, $HotelCode, $HotelType, $DeepLinkInformationval) {
//        
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
//            'total_cost' => $total_amount,
//            'hotel_type' => $HotelType,
//            'deep_link_information' => $DeepLinkInformationval,
//        );
//        $this->db->insert('hotel_search_result_info_t', $data);
//    }

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

    function fetch_hotel_result($sess_id) {
        $this->db->select('m.*,n.*');
        $this->db->from('api_hotel_detail_t as n');
        $this->db->join('api_permanent_info as m', 'm.hotel_code=n.hotel_code');
        $this->db->where('n.session_id', $sess_id);
        $this->db->group_by('n.hotel_code');
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return '';
        }
    }

    function fetch_hotel_result_dom($ses_id) {
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

    function get_currecy_value() {
        $this->db->select('*')
                ->from('currency_converter');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        }

        return false;
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

    public function get_country_list() {
        $this->db->select('*')
                ->from('country');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
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

}
