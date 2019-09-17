<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Travelguru_Hotel_Model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

//   function insert_flight_temp_results($sess_id, $api_name, $SequenceNumber, $UniqueIdentifier, $OriginDestinationRPH, $FlightID, $SupplierSystem, $originCode, $destinationCode, $adults, $childs, $infants, $Total_Duration, $ArrivalDateTime, $DepartureDateTime, $Duration, $FlightNumber, $SeatToSell, $FareType, $ResBookDesigCode, $Departure_AirPortName, $Departure_CityName, $Departure_LocationCode, $Departure_Terminal, $Arrival_AirPortName, $Arrival_CityName, $Arrival_LocationCode, $Arrival_Terminal, $AirEquipType, $MarketingAirline_Code, $MarketingAirline_Name, $Stops, $BaseFare, $CurrencyCode, $Tax_Amount, $TaxCode, $TaxDescription, $TotalFare, $ServiceTax, $Fee_Amount, $FeeCode, $PassengerType, $PassengerQuantity, $PassengerBaseFare, $PassengerTax_Amount, $PassengerTaxCode, $PassengerTaxDescription, $PassengerTotalFare, $PassengerServiceTax, $Trip_Type, $Service_Type) {
//
//        $data = array('session_id' => $sess_id,
//            'api' => $api_name,
//            'SequenceNumber' => $SequenceNumber,
//            'UniqueIdentifier' => $UniqueIdentifier,
//            'OriginDestinationRPH' => $OriginDestinationRPH,
//            'FlightID' => $FlightID,
//            'SupplierSystem' => $SupplierSystem,
//            'Origin' => $originCode,
//            'Destination' => $destinationCode,
//            'Adults' => $adults,
//            'Childs' => $childs,
//            'Infants' => $infants,
//            'Total_Duration' => $Total_Duration,
//            'ArrivalDateTime' => $ArrivalDateTime,
//            'DepartureDateTime' => $DepartureDateTime,
//            'Duration' => $Duration,
//            'FlightNumber' => $FlightNumber,
//            'SeatToSell' => $SeatToSell,
//            'FareType' => $FareType,
//            'ResBookDesigCode' => $ResBookDesigCode,
//            'Departure_AirPortName' => $Departure_AirPortName,
//            'Departure_CityName' => $Departure_CityName,
//            'Departure_LocationCode' => $Departure_LocationCode,
//            'Departure_Terminal' => $Departure_Terminal,
//            'Arrival_AirPortName' => $Arrival_AirPortName,
//            'Arrival_CityName' => $Arrival_CityName,
//            'Arrival_LocationCode' => $Arrival_LocationCode,
//            'Arrival_Terminal' => $Arrival_Terminal,
//            'AirEquipType' => $AirEquipType,
//            'MarketingAirline_Code' => $MarketingAirline_Code,
//            'MarketingAirline_Name' => $MarketingAirline_Name,
//            'Stops' => $Stops,
//            'BaseFare' => $BaseFare,
//            'CurrencyCode' => $CurrencyCode,
//            'Tax_Amount' => $Tax_Amount,
//            'Tax_Code' => $TaxCode,
//            'Tax_Description' => $TaxDescription,
//            'TotalFare' => $TotalFare,
//            'ServiceTax' => $ServiceTax,
//            'Fee_Amount' => $Fee_Amount,
//            'Fee_Code' => $FeeCode,
//            'PassengerType' => $PassengerType,
//            'PassengerQuantity' => $PassengerQuantity,
//            'PassengerBaseFare' => $PassengerBaseFare,
//            'PassengerTax_Amount' => $PassengerTax_Amount,
//            'PassengerTax_Code' => $PassengerTaxCode,
//            'PassengerTax_Description' => $PassengerTaxDescription,
//            'PassengerTotalFare' => $PassengerTotalFare,
//            'PassengerServiceTax' => $PassengerServiceTax,
//            'Trip_Type' => $Trip_Type,
//            'Service_Type' => $Service_Type
//        );
//
//        $this->db->insert('flight_search_result_info', $data);
//        //echo $this->db->last_query(); exit;
//        return $this->db->insert_id();
//    }
//
//    
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

//   // function getImag($id) {
//        $this->db->select('image_url')
//                ->from('hotel_images_tg')
//                ->where('hotel_code', $id)
//                ->limit(1);
//        $query = $this->db->get();
//        if ($query->num_rows > 0) {
//            $te = $query->row();
//            return $te->image_url;
//        }
//    }

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

//    function get_hotel_details($Booking_reference_ID) {
//        $this->db->select('*');
//        $this->db->from('hotel_booking_reports');
//        $this->db->where('Booking_reference_ID', $Booking_reference_ID);
//        $query = $this->db->get();
//        if ($query->num_rows > 0) {
//            return $query->row();
//        }
//    }
//
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

    function get_hoteldescription($hotel_code) {
        $this->db->select('description,image')
                ->from('api_permanent_info')
                ->where('hotel_code', $hotel_code);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->row();
        }
    }

    function insert_hotel_booking($agent_id, $bookUniqueIDval, $sess_city, $sess_noofadult, $sess_noofchild, $sess_checkin, $sess_checkout, $sess_room_count, $sess_noofnights, $bookRoomTypeCodeval, $RoomTypename, $bookRatePlanCodeval, $bookAmountAfterTaxval, $bookCurrencyCodeval, $bookHotelCodeval, $bookHotelNameval, $hotel_disc, $lead_title, $lead_firstname, $lead_email, $lead_mobile, $lead_country, $lead_city, $lead_postalcode, $bookAreaIDval, $bookaddressval, $bookCityNameval, $bookStateProvval, $bookCountryNameval, $bookcontactnumberval, $NonRefundable, $PenaltyDescriptionval, $total_amount) {

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
            'lead_email' => $lead_email,
            'lead_mobile' => $lead_mobile,
            'lead_country' => $lead_country,
            'lead_city' => $lead_city,
            'lead_postalcode' => $lead_postalcode,
            'area_id' => $bookAreaIDval,
            'hotel_address' => $bookaddressval,
            'hotel_city' => $bookCityNameval,
            'hotel_state' => $bookStateProvval,
            'hotel_country' => $bookCountryNameval,
            'contact_number' => $bookcontactnumberval,
            'cancel_poly_nonrefund' => $NonRefundable,
            'cancellation_disc' => $PenaltyDescriptionval
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

}
