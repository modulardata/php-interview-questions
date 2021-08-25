<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
error_reporting(0);
session_start();

class Hotel extends CI_Controller {

    private $URL;
    private $URL_hotelspro, $Api_Key_hotelspro;
    private $client, $xml, $MidOfficeAgentID, $soapAction, $URLbooking;
    private $username, $password, $propertyid;
    private $sess_id;

    public function __construct() {
        parent::__construct();
        $this->load->model('Hotel_Model');
        $this->load->library('googlemaps');

        $this->URL = "http://stage-api.travelguru.com/services-2.0/tg-services/TGServiceEndPoint";
        $this->URLbooking = "http://stage-api.travelguru.com/services-2.0/tg-services/TGBookingServiceEndPoint";
        $this->soapAction = "http://stage-api.travelguru.com/services-2.0/tg-services/TGServiceEndPoint?wsdl";
        //$this->soapActionbooking = "http://stage-api.travelguru.com/services-2.0/tg-services/TGBookingServiceEndPoint";
        $this->username = "testnet";
        $this->password = "test";
        $this->propertyid = "1300000141";
        $this->URL_hotelspro = "http://api.hotelspro.com/4.1_test/hotel/b2bHotelSOAP.wsdl";
        $this->Api_Key_hotelspro = "ZDlldW42bUlza3RSSTkrcW5oanFmYTc5Yi9rL2djVHMyZGFoRDJNSVhEU05WbXQ5WFJIaEU3eEE3aTJQS1NWaQ==";

        if ($this->session->userdata('session_id') == '') {
            redirect('hotel/index', 'refresh');
        }

        $this->sess_id = $this->session->userdata('session_id');
    }

    public function index() {
        $this->load->view('home/index');
    }

    public function backtosearch() {

        $data['$api_name_h'] = 'hotelspro';
        $this->load->view('b2c/hotel/search_progress', $data);
    }

    // Hotel Search Code
    public function hotel_search() {
//echo '<pre>';print_r($_POST);exit;
        $this->form_validation->set_rules('City', 'Location', 'trim|required|xss_clean');
        $this->form_validation->set_rules('checkin', 'Check in', 'trim|required|callback_date_validation|xss_clean');
        $this->form_validation->set_rules('checkout', 'Check out', 'required|callback_date_validation|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('home/index');
        } else {
            $adultvalue = $this->input->post('adult');
            $childvalue = $this->input->post('child');
            $room_count = $this->input->post('room_count');

            $city = $this->input->post('City');
            $checkin = $this->input->post('checkin');
            $checkout = $this->input->post('checkout');
            $noofnights = $this->Hotel_Model->calculatedateDiff($checkin, $checkout);

            if (!empty($city)) {
                $session_data = $this->session->userdata('hotel_search_data');
                //echo '<pre>';print_r($session_data);exit;			
                if (!empty($session_data)) {
                    $sess_city = $session_data['city'];
                    $sess_checkin = $session_data['checkin'];
                    $sess_checkout = $session_data['checkout'];
                    $sess_adultvalue = $session_data['adultvalue'];
                    $sess_childvalue = $session_data['childvalue'];
                    $sess_room_count = $session_data['room_count'];

                    if ($sess_city == $city && $sess_checkin == $checkin && $sess_checkout == $checkout && $sess_adultvalue == $adultvalue && $sess_childvalue == $childvalue && $sess_room_count == $room_count) {
                        $this->session->set_userdata('hotel_search_activate', 1);
                    } else {
                        $this->session->set_userdata('hotel_search_activate', '');
                        $this->Hotel_Model->delete_hotel_temp_result($this->sess_id);
                    }
                } else {
                    $this->session->set_userdata('hotel_search_activate', '');
                    $this->Hotel_Model->delete_hotel_temp_result($this->sess_id);
                }
                //  creating the single and double depending upon the room counts

                $adultList = array_slice($this->input->post('adult'), 0, $this->input->post('room_count'));
                $childList = array_slice($this->input->post('child'), 0, $this->input->post('room_count'));

                $adults_count = array_sum($adultList);
                $childs_count = array_sum($childList);

                $roomsess = array(
                    'adult_count' => $adults_count,
                    'child_count' => $childs_count,
                );
                $this->session->set_userdata('room_data', $roomsess);

                $sess_array = array(
                    'city' => $city,
                    'checkin' => $checkin,
                    'checkout' => $checkout,
                    'adultvalue' => $adultvalue,
                    'childvalue' => $childvalue,
                    'room_count' => $room_count,
                    'noofnights' => $noofnights
                );

                $this->session->set_userdata('hotel_search_data', $sess_array);

//                echo'<pre>';
//                print_r($this->session->userdata('hotel_search_data'));
                // print_r($this->session->userdata('room_data'));



                $api_name_h = 'hotelspro';
                $data['api_name_h'] = $api_name_h;
                $this->session->set_userdata('api_name_h', $api_name_h);
                $this->load->view('b2c/hotel/search_progress', $data);
            }
        }
    }

    function search_progress() {
        // echo '<pre>';print_r($this->session->userdata);exit;
        if ($this->session->userdata('hotel_search_activate') != 1) {
            if (isset($_POST) && $_POST['api_name'] != '') {
                $api = $_POST['api_name'];

                switch ($api) {

                    case 'hotelspro':
                        $this->hotelspro_search_availablility();
                        break;
                    case 'travelguru':
                        $this->travelguru_search_result();
                        break;

                    default:
                        break;
                }
            }
        }

        if ($_POST['api_name'] == 'hotelspro') {
            $data['result'] = $this->Hotel_Model->fetch_hotel_result($this->sess_id);
            //echo '<pre>';print_r($data['result']);exit;
            $data['api'] = 'hotelspro';
        } else {
            $data['result'] = $this->Hotel_Model->fetch_hotel_result_dom($this->sess_id);
            $data['api'] = 'travelguru';
        }
        $this->load->view('b2c/hotel/search_result', $data);
    }

    function hotelspro_search_availablility() {
        $hotel_search_datas = $this->session->userdata('hotel_search_data');

        //$room_used_type = $room_datas['room_used_type'];
        $city = $hotel_search_datas['city'];
        $sd = $hotel_search_datas['checkin'];
        $room_count = $hotel_search_datas['room_count'];
        $ed = $hotel_search_datas['checkout'];
        $city_val = $this->Hotel_Model->get_city_code($city);
        $city_code = $city_val->hotelspro; //exit;
        $cinval = explode("/", $sd);
        $cin = $cinval[2] . '-' . $cinval[1] . '-' . $cinval[0];
        $coutval = explode("/", $ed);
        $cout = $coutval[2] . '-' . $coutval[1] . '-' . $coutval[0];
        $adultvalue = '';
        $childvalue = '';
        $childvalue2 = '';
        $childvalue3 = '';
        $adult = $hotel_search_datas['adultvalue'];
        $child = $hotel_search_datas['childvalue'];

        for ($r = 0; $r < $room_count; $r++) {
//            $childvalue = '';
//            $childvalue2 = '';
//            $childvalue3 = '';

            if ($child[$r] == 1) {
                $childvalue = array("paxType" => "Child", "age" => 8);
            }
            if ($child[$r] == 2) {
                $childvalue = array("paxType" => "Child", "age" => 8);
                $childvalue2 = array("paxType" => "Child", "age" => 8);
            }
            if ($child[$r] == 3) {
                $childvalue = array("paxType" => "Child", "age" => 8);
                $childvalue2 = array("paxType" => "Child", "age" => 8);
                $childvalue3 = array("paxType" => "Child", "age" => 8);
            }


            // adult
            if ($adult[$r] == 1) {
                $rooms[] = array(array("paxType" => "Adult"), $childvalue, $childvalue2, $childvalue3);
            }

            if ($adult[$r] == 2) {
                $rooms[] = array(array("paxType" => "Adult"), array("paxType" => "Adult"), $childvalue, $childvalue2, $childvalue3);
            }
            if ($adult[$r] == 3) {
                $rooms[] = array(array("paxType" => "Adult"), array("paxType" => "Adult"), array("paxType" => "Adult"), $childvalue, $childvalue2, $childvalue3);
            }
            if ($adult[$r] == 4) {
                $rooms[] = array(array("paxType" => "Adult"), array("paxType" => "Adult"), array("paxType" => "Adult"), array("paxType" => "Adult"), $childvalue, $childvalue2, $childvalue3);
            }
        }

//        echo '<pre>';
//        print_r($rooms);
//        exit;
        $_SESSION['pro_search_id'] = '';
        $client = new SoapClient($this->URL_hotelspro, array('trace' => 1, 'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP));
        try {
            $checkAvailability = $client->getAvailableHotel($this->Api_Key_hotelspro, $city_code, $cin, $cout, "USD", "US", "false", $rooms);
        } catch (SoapFault $exception) {
            echo $exception->getMessage();
            exit;
        }
//echo '<pre>';    print_r($checkAvailability); exit;
//
        $this->session->set_userdata('pro_search_id', $checkAvailability->searchId);
        if (is_object($checkAvailability->availableHotels)) {
            $hotelResponse[] = $checkAvailability->availableHotels;
        } else {
            $hotelResponse = $checkAvailability->availableHotels;
        } //echo '<pre>';print_r($hotelResponse);exit;
        foreach ((array) $hotelResponse as $hnum => $hotel) {
            $processId = $hotel->processId;
            $hotelCode = $hotel->hotelCode;
            $availabilityStatus = $hotel->availabilityStatus;
            $totalPrice = $hotel->totalPrice;
            $totalTax = $hotel->totalTax;
            $currency = $hotel->currency;
            $boardType = $hotel->boardType;
            if (is_object($hotel->rooms)) {
                $roomResponse[] = $hotel;
            } else {
                $roomResponse = $hotel->rooms;
            }
            $roomCategory = array();
            //  $totalRoomRate=array();
            $each_ngt_amount = array();
            $totalcost_m_m_ddn = array();
            foreach ((array) $roomResponse as $rnum => $room) {
                $roomCategory[] = $room->roomCategory;
                $totalRoomRate = $room->totalRoomRate;
                if (is_object($room->paxes)) {
                    $roomsInfo[] = $room->paxes;
                } else {
                    $roomsInfo = $room->paxes;
                }
                if (is_object($room->ratesPerNight)) {
                    $ratesPerNight[] = $room->ratesPerNight;
                } else {
                    $ratesPerNight = $room->ratesPerNight;
                }
                foreach ((array) $roomsInfo as $pnum => $pax) {
                    $paxType = $pax->paxType;
                }
                foreach ((array) $ratesPerNight as $rpnum => $price) {
                    $priceeachrate = $price->date;
                    $each_ngt_amount[] = $price->amount;
                }
                $a = count($each_ngt_amount);
                $roomrateavg = $totalRoomRate / $a;
                unset($each_ngt_amount);
                $totalcost_m_m_ddn[] = $roomrateavg;
            }
            $room_datas = $this->session->userdata('room_data');
            //echo '<pre>';     print_r($room_datas); print_r($hotel_search_datas) ; exit;
            $adult_count = $room_datas['adult_count'];
            $child_count = $room_datas['child_count'];
            $api = "hotelspro";
            $totalcost_m_m = $totalPrice;
            $roomtype = implode("<br>", $roomCategory);
            $totalRoomRate = array_sum($totalcost_m_m_ddn);

            $currencyv1 = $currency;
            if ($currencyv1 != 'USD') {
                $c_val1 = $this->Hotel_Model->get_currecy_details($currencyv1);
                $c_val = $c_val1->value;
                $org_amt = $totalRoomRate;
                $amountv = $totalRoomRate / $c_val;
            } else {
                $c_val = 1;
                $org_amt = $totalRoomRate;
                $amountv = $totalRoomRate;
            }
            $amountv1 = $amountv;
            $contry = $this->Hotel_Model->get_country($hotel_search_datas['city']);
            $amountv3pay = $amountv1;
            $amountv4 = $amountv1;
            $amountv3 = $amountv1;
            $city_name = $this->Hotel_Model->get_city_code_id($hotel_search_datas['city']);
// ***************************inserting data into permanent table******************************************************* //
            /*           if ($this->Hotel_Model->check_hotelspro_p_result($hotelCode) == '') {
              $hotellist = $this->Hotel_Model->fetch_hotespro_hotel_list($hotelCode);
              $hoteldesc = $this->Hotel_Model->fetch_hotespro_hotel_desc($hotelCode);
              $hotelamenty = $this->Hotel_Model->fetch_hotespro_hotel_amenty($hotelCode);
              //if($hotellist!='' AND $hoteldesc!='' AND $hotelamenty!=''){
              $hotellist = $this->Hotel_Model->insert_into_p_hotelspro($hotellist, $hoteldesc, $hotelamenty);
              //}
              } */
// ***********************************inserting data into permanent table************************************** //
            $this->Hotel_Model->insert_gta_temp_result($this->sess_id, 'hotelspro', $hotelCode, $processId, $roomtype, $amountv4, $availabilityStatus, $boardType, $adult_count, $child_count, $amountv3, $org_amt, $currencyv1, $c_val, $amountv3pay, $city_name->city_name);
        }
    }

    // hotel search domestic
    public function hotel_search_domestic() {

        $this->form_validation->set_rules('City', 'Location', 'trim|required|xss_clean');
        $this->form_validation->set_rules('checkin', 'Check in', 'trim|required|callback_date_validation|xss_clean');
        $this->form_validation->set_rules('checkout', 'Check out', 'required|callback_date_validation|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('hotel/index');
        } else {
//            echo '<pre>';
//            print_r($_POST);
//            exit;

            $adultvalue = $this->input->post('adult');
            $childvalue = $this->input->post('child');
            $childage = $this->input->post('child_age');
            $room_count = $this->input->post('room_count');

            $city = $this->input->post('City');
            $checkin = $this->input->post('checkin');
            $checkout = $this->input->post('checkout');

            $noofnights = $this->Hotel_Model->calculatedateDiff($checkin, $checkout);

            if (!empty($city)) {
                $session_data = $this->session->userdata('hotel_search_data');
                //echo '<pre>';print_r($session_data);exit;			
                if (!empty($session_data)) {
                    $sess_city = $session_data['city'];
                    $sess_checkin = $session_data['checkin'];
                    $sess_checkout = $session_data['checkout'];
                    $sess_adultvalue = $session_data['adultvalue'];
                    $sess_childvalue = $session_data['childvalue'];
                    $sess_room_count = $session_data['room_count'];

                    if ($sess_city == $city && $sess_checkin == $checkin && $sess_checkout == $checkout && $sess_adultvalue == $adultvalue && $sess_childvalue == $childvalue && $sess_room_count == $room_count) {
                        $this->session->set_userdata('hotel_search_activate', 1);
                    } else {
                        $this->session->set_userdata('hotel_search_activate', '');
                        $this->Hotel_Model->delete_hotel_temp_result($this->sess_id);
                    }
                } else {
                    $this->session->set_userdata('hotel_search_activate', '');
                    $this->Hotel_Model->delete_hotel_temp_result($this->sess_id);
                }
                $sess_array = array(
                    'city' => $city,
                    'checkin' => $checkin,
                    'checkout' => $checkout,
                    'adultvalue' => $adultvalue,
                    'childvalue' => $childvalue,
                    'childage' => $childage,
                    'room_count' => $room_count,
                    'noofnights' => $noofnights
                );

                $this->session->set_userdata('hotel_search_data', $sess_array);
                $api_name_h = 'travelguru';
                $data['api_name_h'] = $api_name_h;
                $this->session->set_userdata('api_name_h', $api_name_h);
                $this->load->view('b2c/hotel/search_progress', $data);
            }
        }
    }

    function postRQ($post_xml) {

        $ch2 = curl_init();
        curl_setopt($ch2, CURLOPT_URL, $this->URL);
        curl_setopt($ch2, CURLOPT_TIMEOUT, 180);
        curl_setopt($ch2, CURLOPT_HEADER, 0);
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch2, CURLOPT_POST, 1);
        curl_setopt($ch2, CURLOPT_POSTFIELDS, $post_xml);
        curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch2, CURLOPT_SSLVERSION, 3);
        curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, FALSE);

        $httpHeader2 = array("SOAPAction: {$this->soapAction}", "Content-Type: text/xml; charset=UTF-8", "Content-Encoding: UTF-8");
        curl_setopt($ch2, CURLOPT_HTTPHEADER, $httpHeader2);
        curl_setopt($ch2, CURLOPT_ENCODING, "gzip");

        // Execute request, store response and HTTP response code
        $data2 = curl_exec($ch2);
        $error2 = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
        curl_close($ch2);
        return $data2;
    }

    function postRQ_booking($post_xml) {

        $ch2 = curl_init();
        curl_setopt($ch2, CURLOPT_URL, $this->URLbooking);
        curl_setopt($ch2, CURLOPT_TIMEOUT, 180);
        curl_setopt($ch2, CURLOPT_HEADER, 0);
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch2, CURLOPT_POST, 1);
        curl_setopt($ch2, CURLOPT_POSTFIELDS, $post_xml);
        curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch2, CURLOPT_SSLVERSION, 3);
        curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, FALSE);

        $httpHeader2 = array("SOAPAction: {$this->soapAction}", "Content-Type: text/xml; charset=UTF-8", "Content-Encoding: UTF-8");
        curl_setopt($ch2, CURLOPT_HTTPHEADER, $httpHeader2);
        curl_setopt($ch2, CURLOPT_ENCODING, "gzip");

        // Execute request, store response and HTTP response code
        $data2 = curl_exec($ch2);
        $error2 = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
        curl_close($ch2);
        return $data2;
    }

    function hotel_detail_int($hotel_id) {
        $hotel_detail = $this->Hotel_Model->get_hotel_detail($hotel_id);

        $hotel_images = $this->Hotel_Model->get_hotel_images($hotel_detail->hotel_code);
        $hotel_amenities = $this->Hotel_Model->get_hotel_amenities($hotel_detail->hotel_code);
        $hotel_inandaround = $this->Hotel_Model->get_hotel_inandaround($hotel_detail->hotel_code);
        $hotel_review = $this->Hotel_Model->get_hotel_review($hotel_detail->hotel_code);
        $data['hotel_detail'] = $hotel_detail;

        //echo '<pre>';        print_r($data); exit;
        $latitude = $hotel_detail->latitude;
        $longitude = $hotel_detail->longitude;
        $destination = $hotel_detail->city;
        $session_id = $hotel_detail->session_id;
        $hotel_name = $hotel_detail->hotel_name;

        $config['center'] = $latitude . ',' . $longitude;

        $config['zoom'] = 'auto';
        $this->googlemaps->initialize($config);

        $marker = array();
        $marker['position'] = $latitude . ',' . $longitude;
        $this->googlemaps->add_marker($marker);

        $data['map'] = $this->googlemaps->create_map();

        $data['hotel_images'] = $hotel_images;
        $data['hotel_amenities'] = $hotel_amenities;
        $data['hotel_inandaround'] = $hotel_inandaround;
        $data['hotel_review'] = $hotel_review;
        $session_data = $this->session->userdata('hotel_search_data');
        $city = $session_data['city'];
        $in = $session_data['checkin'];
        $check = explode('/', $in);
        $checkin = $check[2] . '-' . $check[1] . '-' . $check[0];
        $out = $session_data['checkout'];
        $check = explode('/', $out);
        $checkout = $check[2] . '-' . $check[1] . '-' . $check[0];

        $gues = '';
        if ($hotel_detail->api == 'hotelspro') {
            $id = $hotel_id;


            $sess_hotel_search_data = $this->session->userdata('hotel_search_data');
            $sess_room_data = $this->session->userdata('room_data');
            $idd = $this->Hotel_Model->get_cancel_attrib_new($id);
            if ($idd->hotel_code != '') {
                //echo $idd->api_temp_hotel_id;exit;
                $this->Hotel_Model->get_cancel_attrib_new_nerw($idd->hotel_code, $idd->api_temp_hotel_id);
            }

            $service = $this->Hotel_Model->get_searchresult($id);

            //  echo '<pre>';        print_r($service); exit;
            $phone = $service->phone;
            $api = $service->api;
            $hotel_code = $service->hotel_code;
            $hotel_name = $service->hotel_name;
            $star = $service->star;
            $image = $service->image;
            $tot_amt = $service->total_cost;
            $data['service'] = $service;
            $sec_res = $service->session_id;
            $data['hotel_facility'] = $this->Hotel_Model->get_facility_details_hotel($hotel_code);
            $data['room_facility'] = $this->Hotel_Model->get_facility_details_room($hotel_code);
            $data['hotelCode'] = $hotel_code;
            $data['star'] = $service->star;
            $data['phone'] = $service->phone;
            $data['location'] = $service->location;
            $data['lat'] = $service->latitude;
            $data['long'] = $service->longitude;
            $data['hotel_name'] = $service->hotel_name;
            $data['description'] = $service->description;
            $data['address'] = $service->address;
            $data['dest'] = $service->city;
            $data['session'] = $service->session_id;
            $data['result_id'] = $id;
            $data['cur_id'] = $id;
            $data['api'] = $api;
            $data['search_details'] = $sess_hotel_search_data;
            $data['room_details'] = $sess_room_data;
            // echo '<pre>';        print_r($data); exit;
            if ($data['lat'] != '' && $data['long'] != '') {
                $data['nearby_hotel'] = $this->Hotel_Model->get_nearby_hotels_int($data['lat'], $data['long'], $data['hotel_name'], $data['dest'], $data['session']);
            } else {
                $data['nearby_hotel'] = '';
            }
            if ($api == 'hotelspro') {
                $hotel_image = $this->Hotel_Model->get_hotelbed_hotel_pro_image($hotel_code);
                if ($hotel_image != "") {
                    $img1[] = array($hotel_image->HotelImages1, $hotel_image->HotelImages2, $hotel_image->HotelImages3);
                    $data['img_array'] = $img1;
                } else {
                    $img1 = "";
                    $data['img_array'] = "";
                }
            }

            //echo '<pre>'; print_r($data);exit;
            $this->load->view('b2c/hotel/hotel_detail_int', $data);
            //}
        }
    }

    function pro_pre_booking($result_id) {

        $data['search_details'] = $this->session->userdata('hotel_search_data');
        $room = $this->session->userdata('hotel_search_data');
        //echo '<pre>'; 
        $room_count = $room['room_count'];
        $city = $room['city'];
        // echo '<pre>'; print_r($this->session->all_userdata());
//      print_r($city);


        if ($room_count == 1) {
            $service = $this->Hotel_Model->get_searchresult($result_id);
            $api = $service->api;
            $hotel_code = $service->hotel_code;
            $hotel_name = $service->hotel_name;
            $star = $service->star;
            $image = $service->image;
            $data['service'] = $service;
            $sec_res = $service->session_id;
            $data['result_id'] = $result_id;
            $rm_info = array();
            $rm_info[] = $this->Hotel_Model->fetch_gta_temp_result_room_result_id($sec_res, $result_id);
            $data['room_info'] = $rm_info;
        } else {
            $result_id1 = explode("-", $result_id);
            $service = $this->Hotel_Model->get_searchresult($result_id1[0]);
            $api = $service->api;
            $hotel_code = $service->hotel_code;
            $hotel_name = $service->hotel_name;
            $star = $service->star;
            $image = $service->image;
            $data['service'] = $service;
            $sec_res = $service->session_id;
            $data['result_id'] = $result_id;
            $rm_info = array();
            for ($r = 0; $r < count($result_id1); $r++) {
                $rm_info[] = $this->Hotel_Model->fetch_gta_temp_result_room_result_id($sec_res, $result_id1[$r]);
            }
            $data['room_info'] = $rm_info;
        }
        $data['errordesc'] = '';

        $client = new SoapClient($this->URL_hotelspro, array('trace' => 1));
        try {
            $pid = $this->session->userdata('pro_search_id');
            $hid = $hotel_code;
            $allocateHotelCode = $client->allocateHotelCode($this->Api_Key_hotelspro, $pid, $hid);
        } catch (SoapFault $exception) {
            $data['errordesc'] = $exception->getMessage();
        }
        if ($data['errordesc'] != '') {
            $data['error'] = $data['errordesc'];
            $this->load->view('b2c/hotel/error_page', $data);
        } else {
            if (is_object($allocateHotelCode->availableHotels)) {
                $availableHotels[] = $allocateHotelCode->availableHotels;
            } else {
                $availableHotels = $allocateHotelCode->availableHotels;
                $availableHotels;
            }
            //echo '<pre>';            print_r($allocateHotelCode); exit;
            $roommm = array();
            foreach ($availableHotels as $hnum => $hotel) {
                $process_id = $hotel->processId;
                $status = $hotel->availabilityStatus;
                $totalRoomRate = $hotel->totalPrice;
                $cur = $hotel->currency;
                $boardType = $hotel->boardType;
                $currencyv1 = $cur;
                if ($currencyv1 != 'USD') {
                    $c_val1 = $this->Hotel_Model->get_currecy_details($currencyv1);

                    if ($c_val1 != '') {
                        $c_val = $c_val1->value;
                    } else {
                        $c_val = '';
                    }
                    $org_amt = $totalRoomRate;
                    $amountv = $totalRoomRate / $c_val;
                } else {
                    $c_val = 1;
                    $org_amt = $totalRoomRate;
                    $amountv = $totalRoomRate;
                }
                $amountv1 = $amountv;
                $contry = $this->Hotel_Model->get_country($city);
                $markup = $this->Hotel_Model->get_markup_detail('hotelspro', $contry);
                $pay_charge = $this->Hotel_Model->get_payment_charge();
                $amountv2 = ($markup / 100);
                $amountv3 = $amountv2 * $amountv1;
                $amountv4 = $amountv3 + $amountv1;
                $amountv2pay = ($pay_charge / 100);
                $amountv3pay = $amountv2pay * $amountv4;
                if (is_object($hotel->rooms)) {
                    $roomResponse[] = $hotel->rooms;
                } else {
                    $roomResponse = $hotel->rooms;
                }
                $roomCategory1 = array();
                foreach ((array) $roomResponse as $rnum => $room) {
                    $roomCategory1[] = $room->roomCategory;
                    $room = implode("<br>", $roomCategory1);
                }
                unset($roomResponse);
                $roommm[] = array('process_id' => $process_id, 'status' => $status, 'amountv4' => $amountv4, 'room' => $room, 'boardType' => $boardType, 'amountv3' => $amountv3, 'org_amt' => $org_amt, 'currencyv1' => $currencyv1, 'c_val' => $c_val, 'amountv3pay' => $amountv3pay);
            }
            $data['room_cat_details'] = $roommm;
//            echo '<pre/>';
//            print_r($data);
//            exit;

            $this->load->view('b2c/hotel/pro_pre_booking_int', $data);
        }
    }

    function hotel_detail($hotel_id) {
        $hotel_detail = $this->Hotel_Model->get_hotel_detail($hotel_id);
        $hotel_images = $this->Hotel_Model->get_hotel_images($hotel_detail->hotel_code);
        $hotel_amenities = $this->Hotel_Model->get_hotel_amenities($hotel_detail->hotel_code);
        $hotel_inandaround = $this->Hotel_Model->get_hotel_inandaround($hotel_detail->hotel_code);
        $hotel_review = $this->Hotel_Model->get_hotel_review($hotel_detail->hotel_code);

        //echo '<pre>';print_r($hotel_detail);exit;
        $data['hotel_detail'] = $hotel_detail;
        $data['hotel_images'] = $hotel_images;
        $data['hotel_amenities'] = $hotel_amenities;
        $data['hotel_inandaround'] = $hotel_inandaround;
        $data['hotel_review'] = $hotel_review;
        $session_data = $this->session->userdata('hotel_search_data');

        $cit = $session_data['city'];
//        $city = explode(' ', $cit);
//        $count = explode('(', $cit);
//        $country = explode(')', $count[1]);
        //exit;
//        echo '<pre>';
//        print_r($cit);
//        print_r($country);
//        exit;
        $in = $session_data['checkin'];
        $check = explode('/', $in);
        $checkin = $check[2] . '-' . $check[1] . '-' . $check[0];
        $out = $session_data['checkout'];
        $check = explode('/', $out);
        $checkout = $check[2] . '-' . $check[1] . '-' . $check[0];
//exit;

        $gues = '';
        if ($hotel_detail->api == 'travelguru') {
            for ($j = 0; $j < $session_data['room_count']; $j++) {
                $gues.= '
                                <RoomStayCandidate> 
                                    <GuestCounts> 
                                    ';
                for ($a = 0; $a < $session_data['adultvalue'][$j]; $a++) {
                    $gues.='<GuestCount AgeQualifyingCode="10"/>
                    ';
                }
                for ($a = 0; $a < $session_data['childvalue'][$j]; $a++) {
                    $gues.='<GuestCount Age="10" AgeQualifyingCode="8"/>
                    ';
                }

                $gues.='             </GuestCounts>                                     
                                </RoomStayCandidate>              
';
            }

            $this->xml = '
            <soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/"> 
            <soap:Body> <OTA_HotelAvailRQ xmlns="http://www.opentravel.org/OTA/2003/05" RequestedCurrency="INR" CorrelationID="T199V222931099425307077331050305561683"> 
            <AvailRequestSegments> 
            <AvailRequestSegment> 
            <HotelSearchCriteria> 
            <Criterion> 
            <HotelRef HotelCode="' . $hotel_detail->hotel_code . '"/> 
            <StayDateRange End="' . $checkout . '" Start="' . $checkin . '"/> 
            <RoomStayCandidates>' .
                    $gues
                    . '</RoomStayCandidates> 
            <TPA_Extensions SeoEnabled="false"> 
            <Pagination hotelsFrom="0" hotelsTo="0"/> 
            <UserAuthentication password="' . $this->password . '" propertyId="' . $this->propertyid . '" username="' . $this->username . '"/> 
            </TPA_Extensions> 
            </Criterion> 
            </HotelSearchCriteria> 
            </AvailRequestSegment> 
            </AvailRequestSegments> 
            </OTA_HotelAvailRQ> 
            </soap:Body> </soap:Envelope>
';
            //echo $this->xml;exit;
            $hote_det_resp = $this->postRQ($this->xml);
            //echo '<pre>';print_r($hote_det_resp);exit;
            $this->session->set_userdata('hotel_detail_resp', $hote_det_resp);
            $this->load->view('b2c/hotel/hotel_detail', $data);
        } else if ($hotel_detail->api == 'hotelspro') {
            redirect('hotel/hotel_detail_int/' . $hotel_id, 'refresh');
        }
    }

    function pre_booking() {

        $roomtype = $this->input->type->post('roomid');
        $rateplancode = $this->input->type->post('rateplancode');
        $hotel_code = $this->input->type->post('hotel_code');
        $hotel_id = $this->input->type->post('hotel_search_id');
        $netrate = $this->input->type->post('net_rate');
        $tax = $this->input->type->post('tax');

        $country = $this->Hotel_Model->get_country();

        $sel = array(
            'roomtype' => $roomtype,
            'rateplancode' => $rateplancode,
            'hotel_code' => $hotel_code,
            'hotel_id' => $hotel_id,
            'netrate' => $netrate,
            'tax' => $tax
        );
        $this->session->set_userdata('selected_room', $sel);
        $data['country'] = $country;
//        echo '<pre>';
//        print_r($data);
//        exit;
        $this->load->view('hotel/pre_booking_int', $data);
    }

    function pre_booking_int($result_id) {
        $sess_hotel_search_data = $this->session->userdata('hotel_search_data');
        $sess_room_data = $this->session->userdata('room_data');
        $data['search_details'] = $this->session->userdata('hotel_search_data');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|matches[cemail]');
        $this->form_validation->set_rules('cemail', 'Confirm Email', 'required|valid_email');
        $this->form_validation->set_rules('pin', 'Post/Zip Code', 'required');
        $this->form_validation->set_rules('country', 'Country', 'required');
        $this->form_validation->set_rules('state', 'State', 'required');
        $this->form_validation->set_rules('mobile', 'Mobile', 'required');

        if ($this->form_validation->run() == FALSE) {
            // -------------------------------cancellationa policy is bloced ----------------------//


            $room_count = $sess_hotel_search_data['room_count'];

            if ($room_count == 1) {
                $service = $this->Hotel_Model->get_searchresult($result_id);
                $api = $service->api;
                $hotel_code = $service->hotel_code;
                $hotel_name = $service->hotel_name;
                $star = $service->star;
                $image = $service->image;
                $data['service'] = $service;
                $sec_res = $service->session_id;
                $data['result_id'] = $result_id;
                $rm_info = array();
                $rm_info[] = $this->Hotel_Model->fetch_gta_temp_result_room_result_id($sec_res, $result_id);
                $data['room_info'] = $rm_info;
            } else {
                $result_id1 = explode("-", $result_id);
                $service = $this->Hotel_Model->get_searchresult($result_id1[0]);
                $api = $service->api;
                $hotel_code = $service->hotel_code;
                $hotel_name = $service->hotel_name;
                $star = $service->star;
                $image = $service->image;
                $data['service'] = $service;
                $sec_res = $service->session_id;
                $data['result_id'] = $result_id;
                $rm_info = array();
                for ($r = 0; $r < count($result_id1); $r++) {
                    $rm_info[] = $this->Hotel_Model->fetch_gta_temp_result_room_result_id($sec_res, $result_id1[$r]);
                }
                $data['room_info'] = $rm_info;
            }
            $sec_res = $this->sess_id; //echo $sec_res; exit;
            $data['hotel_facility'] = $this->Hotel_Model->get_facility_details($hotel_code);
            $data['hotelCode'] = $hotel_code;
            $data['star'] = $service->star;
            $data['phone'] = $service->phone;
            $data['location'] = $service->location;
            $room = $service->room_code;
            $data['sess'] = $sec_res;
            $data['lat'] = $service->latitude;
            $data['long'] = $service->longitude;
            $data['hotel_name'] = $service->hotel_name;
            $data['description'] = $service->description;
            $data['address'] = $service->address;
            $data['dest'] = $service->city;
            $process_id_fin = $this->input->post('process_id_fin');

            if (isset($process_id_fin)) {
                $pro_idd = explode("|||", $this->input->post('process_id_fin'));
                $hotel_proid = $pro_idd[0];  //echo 'Process Id: '.$hotel_proid; exit;
                $amountv4 = $pro_idd[1];  //echo $amountv4; exit;
                $room = $pro_idd[2];     // echo $room; exit;
                $amountv3 = $pro_idd[3]; //echo $amountv3; exit;
                $boardType = $pro_idd[4]; //echo $boardType; exit;
                $org_amt = $pro_idd[5]; //echo $org_amt; exit;
                $currencyv1 = $pro_idd[6]; //echo $currencyv1; exit;
                $c_val = $pro_idd[7]; //echo $c_val; exit;
                $amountv3pay = $pro_idd[8]; //echo $amountv3pay; exit;
                $this->Hotel_Model->Update_room_type_in_search_result($result_id, $hotel_proid, $amountv4, $room, $amountv3, $boardType, $org_amt, $currencyv1, $c_val, $amountv3pay);
            }
            set_time_limit(0);
            $time = time();
            $vat_time = date('Y-m-d') . " " . "T" . date('h:i:s');
            // -------------------------------cancellationa policy is bloced ----------------------//

            $client = new SoapClient($this->URL_hotelspro, array('trace' => 1));
            $processId = $hotel_proid;
            try {
                $data['errordesc'] = '';
                $getHotelCancellationPolicy = $client->getHotelCancellationPolicy($this->Api_Key_hotelspro, $processId, $hotel_code);
                // echo '<pre>';              print_r($getHotelCancellationPolicy); exit;
            } catch (SoapFault $exception) {
                // echo 'Error';exit;
//              $data['errordesc'] = $exception->getMessage();
//              echo '<pre>';
//              print_r($data['errordesc']);
//              exit;
            }
            if ($data['errordesc'] != '') {
                $data['error'] = $data['errordesc'];

                $this->load->view('b2c/hotel/error_page', $data);
            } else {
                $val = array();
                $val1 = array();
//              echo '<pre>';
//              print_r($getHotelCancellationPolicy); exit;
                $policies = is_array($getHotelCancellationPolicy->cancellationPolicy) ? $getHotelCancellationPolicy->cancellationPolicy : array($getHotelCancellationPolicy->cancellationPolicy);
                // echo "<pre/>";print_r($policies); exit;
                foreach ($policies as $policy) {
                    $val[] = $policy->cancellationDay;
                    if (isset($policy->currency)) {
                        $val1[] = $policy->currency;
                    } else {
                        $val1[] = "USD";
                    }
                    if (isset($policy->feeAmount)) {
                        $feeAmount[] = $policy->feeAmount;
                    } else {
                        $feeAmount[] = "";
                    }
                    if (isset($policy->feeType)) {
                        $feeType[] = $policy->feeType;
                    } else {
                        $feeType[] = "";
                    }
                    if (isset($policy->cancellationDay)) {
                        $cancellationDay[] = $policy->cancellationDay;
                    } else {
                        $cancellationDay[] = "";
                    }
                    if (isset($policy->remarks)) {
                        $remarks[] = $policy->remarks;
                    } else {
                        $remarks[] = "";
                    }
                    //  $policy->remarks;
                }
                //  echo '<pre>'; print_r($this->session->all_userdata()); exit;
                if ($feeType[0] != '') {
                    if ($feeType[0] == 'Night') {
                        $per_ngt = $amountv4 / $sess_hotel_search_data['noofnights'];
                        $cancelamount1 = ceil($per_ngt * $feeAmount[0]);
                    } elseif ($feeType[0] == 'Percent') {
                        $cancelamount1 = ($amountv4 / 100) * $feeAmount[0];
                    } elseif ($feeType[0] == 'Amount') {
                        $cancelamount1 = $feeAmount[0];
                    }
                }
                if ($feeType[1] != '') {
                    if ($feeType[1] == 'Night') {
                        $per_ngt = $amountv4 / $sess_hotel_search_data['noofnights'];
                        $cancelamount2 = ceil($per_ngt * $feeAmount[0]);
                    } elseif ($feeType[1] == 'Percent') {
                        $cancelamount2 = ($amountv4 / 100) * $feeAmount[1];
                    } elseif ($feeType[1] == 'Amount') {
                        $cancelamount2 = $feeAmount[1];
                    }
                }
                $day_before_check = $val[0];
                $data['charge_ty'] = $val1[0];
                $data['charge_amt'] = $cancelamount1;
                $data['hotel_code'] = $hotel_code;
                $data['hotel_proid'] = $hotel_proid;
                $data['result_id'] = $result_id;
                $data['api'] = 'hotelspro';

                $cancel = 'Cancellation penalty for cancellation made within ' . $cancellationDay[0] . ' days of the ' . $sess_hotel_search_data['checkin'] . '
              ' . $cancelamount1 . ' ' . $val1[0] . ' Charges Will Apply<br>';
                $cancel .='Cancellation penalty for cancellation made within ' . $cancellationDay[1] . ' days of the ' . $sess_hotel_search_data['checkin'] . '
              ' . $cancelamount2 . ' ' . $val1[1] . ' Charges Will Apply';
                $cancel .='<br>' . $remarks[0] . '<br>' . $remarks[1];
                //echo '<pre>'; print_r($cancel);exit;
                $data['cancel_policy'] = $cancel;
                $data['new_cancelaion_till_date'] = Date('Y-m-d', strtotime("-$cancellationDay[0] days", strtotime($sess_hotel_search_data['checkin'])));
                $data['new_cancelaion_charge'] = $cancelamount1;
                $data['api'] = 'hotelspro';
                if ($data['lat'] != '' && $data['long'] != '') {
                    $data['nearby_hotel'] = $this->Hotel_Model->get_nearby_hotels_int($data['lat'], $data['long'], $data['hotel_name'], $data['dest'], $data['sess']);
                } else {
                    $data['nearby_hotel'] = '';
                }
                //echo '<pre>'; print_r($data); exit;


                $this->load->view('b2c/hotel/pre_booking_int', $data);
            }


            // -------------------------------cancellationa policy is bloced due to dono how to do----------------------//
        } else {
            // echo 'Coming from Pre booking views'; exit;

            $result_id1 = explode("-", $result_id);
            //print_r($result_id1[0]);exit;
            $service = $this->Hotel_Model->get_searchresult($result_id1[0]);
            //echo '<pre>'; print_r($service);exit;
            $api = $service->api;
            // echo '<pre>'; print_r($data);exit;
            //   echo '<pre>';print_r($_POST);exit;
            $post_values = $_POST;
            //echo '<pre>';            print_r($post_values); exit;

            $this->session->set_userdata('book_final_book_val', $post_values);
            $book_final_book_val = $this->session->userdata('book_final_book_val');
//            echo '<pre>';
//            print_r($book_final_book_val);
//            exit;


            $_SESSION['hotel_testing'] = $_POST;
            redirect("hotel/booking_final", 'refresh');

            //  redirect("hotel/payment_process/$result_id", 'refresh');
        }
    }

    function booking_final() {

        $value = $_SESSION['hotel_testing'];
//        echo '<pre>';        print_r($value); exit;


        $value['provision_id'] = '';
        $sec_res = $this->sess_id;
        $id = $value['result_id'];
        //echo $id; exit;
        $id_1 = explode("-", $id);
        $service = array();
        $hotel_id = '';
        $roomcat = '';
        $roomty = '';


        $fname = $value['fname']; //echo'<pre>'; print_r($book_final_book_val); exit;
        //print_r($gender);exit;
        $lname = $value['lname'];
        $title = $value['sal'];

        $gender = $value['gender'];

        if (isset($value['cname'])) {
            $ctitle = $value['csal'];
            $cname = $value['cname'];
            $cname1 = $value['cname1'];
            $cgender = $value['cgender'];
        }
        // $guest_name = array('test'); 
        for ($i = 0; $i < count($fname); $i++) {
            if ($i == 0) {
                $parent_id = 0;
            }
            $data1 = array(
                //'flight_booking_id' => $flight_booking_ids,
                'group' => 1,
                'title' => $title[$i],
                'last_name' => $lname[$i],
                'middle_name' => '',
                'first_name' => $fname[$i],
                'nationality' => '',
                'product_id' => 1,
                'pass_type' => 'ADT',
                'gender' => $gender[$i],
                'parent_id' => $parent_id
            );
//            print_r($data1);
            $this->db->insert('customer_info_details', $data1); //adult_booking_details 
            $customer_info_details_id = $this->db->insert_id();
            if ($i == 0) {
                $parent_id = $this->db->insert_id();
            }
        }
        //exit;
        if (isset($cname)) {
            for ($i = 0; $i < count($cname); $i++) {
                $data1 = array(
                    //'flight_booking_id' => $flight_booking_ids,
                    'group' => 1,
                    'title' => $ctitle[$i],
                    'last_name' => $cname1[$i],
                    'middle_name' => '',
                    'first_name' => $cname[$i],
                    'nationality' => '',
                    'product_id' => 1,
                    'pass_type' => 'CHD',
                    'gender' => $cgender[$i],
                    'parent_id' => $parent_id
                );
//                echo'<pre>' . $i . ' ';
//                print_r($data1);
                $this->db->insert('customer_info_details', $data1); //adult_booking_details 
                $this->db->insert_id();
            }
            //exit;
        }

        $data['gender_co'] = $gender[0];
        $data['surname_co'] = $lname[0];
        $data['middle_co'] = '';
        $data['title'] = $title[0];
        $data['name_co'] = $fname[0];
        $data['city_co'] = $value['city'];
        $data['state_co'] = $value['state'];
        $data['mobile_co'] = $value['pin'];
        $data['country_co'] = $value['country'];
        $data['address_co'] = $value['address'];
        $data['phone_co'] = $value['mobile'];
        $data['email_co'] = $value['email'];
        $data4 = array(
            'customer_info_details_id' => $parent_id,
            'title' => $data['title'],
            'gender' => $data['gender_co'],
            'last_name' => $data['surname_co'],
            'middle_name' => $data['middle_co'],
            'first_name' => $data['name_co'],
            'city' => $data['city_co'],
            'state' => $data['state_co'],
            'mobile' => $data['mobile_co'],
            'phone' => $data['phone_co'],
            'email' => $data['email_co'],
            'country' => $data['country_co'],
            'address' => $data['address_co']
        );
//        echo '<pre>';
//        print_r($data4); //exit;
        $this->db->insert('customer_contact_details', $data4);
        $parent_customer_id = $this->db->insert_id();
        //payment gateway inserting id
        if (isset($_SESSION['insertpayid'])) {
            echo 'payment details';
            $paymentgatewayid = $_SESSION['insertpayid'];
        } else {
            $paymentgatewayid = '';
        };
        $ses_id1 = $this->sess_id;
        $data5 = array(
            'product_id' => 2,
            'user_id' => '0',
            'user_type' => 4,
            'prn_no' => $value['provision_id'],
            'amount' => $value['amount'],
            'gateway' => $value['payment_charge'],
            'cancellation_till_date' => $value['t_cancel_till_date'],
            'cancellation_till_charge' => $value['t_cancel_till_amt'],
            'net_amount' => $value['org_amt'],
            'session' => $ses_id1,
            'markup' => $value['markup'],
            'currency_val' => $value['currency_val'],
            'xml_currency' => $value['xml_currency'],
            'customer_contact_details_id' => $parent_customer_id,
            'created_date' => date("Y-m-d"),
            'payment_details_id' => $paymentgatewayid
        );
        $this->db->insert('transaction_details', $data5); //exit;
        $parent_transaction_id = $this->db->insert_id();
        redirect('hotel/booking_final_pay/' . $id . '/' . $parent_transaction_id, 'refresh');
    }

    function booking_final_pay($result_id, $parent_transaction_id) {

//        echo '<pre>';
//        print_r($this->session->all_userdata());
//        exit;
        $ses_hotel_search_data = $this->session->userdata('hotel_search_data');
        $sess_room_data = $this->session->userdata('room_data');
        $room_count = $ses_hotel_search_data['room_count'];
        $checkin = $ses_hotel_search_data['checkin'];
        $checkout = $ses_hotel_search_data['checkout'];
        $h_adult = $ses_hotel_search_data['adultvalue'];
        $h_child = $ses_hotel_search_data['childvalue'];
        if ($room_count == 1) {
            $service = $this->Hotel_Model->get_searchresult($result_id);  //From api_temp and api_parmenent
            $h_hotel_id = $service->hotel_code;
            $h_hotel_name = $service->hotel_name;
            $h_star = $service->star;
            $h_description = $service->description;
            $h_address = $service->address;
            $h_city = $service->city;
            $h_phone = $service->phone;
            $h_fax = $service->fax;
            $h_lat = $service->latitude;
            $h_lon = $service->longitude;
            $trans = $this->Hotel_Model->transation_detail($parent_transaction_id); // From Transaction Table
            $trans_id = $trans->customer_contact_details_id;
            $contact_info = $this->Hotel_Model->contact_info_detail_update($trans_id); //From customer_contact_details table
            $con_id = $contact_info->customer_info_details_id;
            $pass_info = $this->Hotel_Model->pass_info_detail($con_id); //From customer_info_details Table
            $con_id_org = $contact_info->customer_contact_details_id;
        } else {
            //echo 'ekdsfkjsd';
            $result_id1 = explode("-", $result_id);
            $service = $this->Hotel_Model->get_searchresult($result_id1[0]); //From api_temp and api_parmenent
            $h_hotel_id = $service->hotel_code;
            $h_hotel_name = $service->hotel_name;
            $h_star = $service->star;
            $h_description = $service->description;
            $h_address = $service->address;
            $h_city = $service->city;
            $h_phone = $service->phone;
            $h_fax = $service->fax;
            $guestadult = $ses_hotel_search_data['adultvalue'];
            $guestchild = $ses_hotel_search_data['childvalue'];
            $date = date('Y-m-d');
            $roomcountss = $ses_hotel_search_data['room_count'];
            $nights = $ses_hotel_search_data['noofnights'];
            $trans = $this->Hotel_Model->transation_detail($parent_transaction_id); // From Transaction Table
            $trans_id = $trans->customer_contact_details_id;
            $contact_info = $this->Hotel_Model->contact_info_detail_update($trans_id); //From customer_contact_details table
            $con_id = $contact_info->customer_info_details_id;
            $pass_info = $this->Hotel_Model->pass_info_detail($con_id); //From customer_info_details Table
            $con_id_org = $contact_info->customer_contact_details_id;
        }
        $sess_book_final_book_val = $_SESSION['hotel_testing'];
        // echo '<pre>';        print_r($sess_book_final_book_val); exit;
        $h_room_type = $sess_book_final_book_val['room_type'];
        // echo '<pre>';        print_r($pass_info); exit;
        $h_cancel_policy = $sess_book_final_book_val['Cancellation_Policy'];
        $api = $service->api;

        $roomcount = $ses_hotel_search_data['room_count'];

        $search = $this->Hotel_Model->get_cancel_attrib_new($result_id);
        //echo '<pre>';        print_r($search); exit;
        $adults = $search->adult;
        //echo '<pre>';        print_r($this->session->all_userdata()); exit;
        $child = $search->child;
        $roomcat = $search->room_code;
        $hotel_id = $search->hotel_code;
        $roomcountss = $ses_hotel_search_data['room_count'];
        $noofdays = $ses_hotel_search_data['noofnights'];
        $data['guestadult'] = $ses_hotel_search_data['adultvalue'];
        $data['guestchild'] = $ses_hotel_search_data['childvalue'];
        $address = $contact_info->city;
        $cinval = explode("/", $checkin);
        $coutval = explode("/", $checkout);
        $cin = $cinval[2] . '-' . $cinval[1] . '-' . $cinval[0]; // echo $cin; exit;
        $cout = $coutval[2] . '-' . $coutval[1] . '-' . $coutval[0];  //echo $cout; exit;
        $noofroom = $ses_hotel_search_data['room_count'];
        $child = $ses_hotel_search_data['childvalue'];
        $adult = $ses_hotel_search_data['adultvalue'];
        $api = 'gta';
        $fname1 = $pass_info[0]->first_name;
        //echo '<pre>';        print_r($fname1); exit;
        $lname1 = $pass_info[0]->last_name;

        $roomcount = $ses_hotel_search_data['room_count'];
        $result_id = $result_id;
        $email = $contact_info->email;
        $nameval = '';
        $m = 1;
        $j = 0;
        $adult = 0;
        $child = 0;

        $city = $ses_hotel_search_data['city'];
        $checkin = $ses_hotel_search_data['checkin'];
        $room_count = $ses_hotel_search_data['room_count'];
        $checkout = $ses_hotel_search_data['checkout'];
        $city_val = $this->Hotel_Model->get_city_code($city);
        $PFirstNamevalue = 'Mr.' . ' ' . $fname1 . ' ' . $lname1;
        $leadTravellerInfo = array();
        $paxInfo = array("paxType" => "Adult", "title" => 'Mr', "firstName" => $fname1, "lastName" => $lname1);
        // echo '<pre>';            print_r($paxInfo); exit;
        $leadTravellerInfo["paxInfo"] = $paxInfo;
        $leadTravellerInfo["nationality"] = "US";
        $otherTravellerInfo = array();
        //echo '<pre/>';print_r($pass_info);exit;
        // echo '<pre/>';print_r($leadTravellerInfo);exit;
        $processId = $search->room_code;
        //echo $processId; exit;

        if (count($pass_info) > 1) {
            for ($i = 1; $i < count($pass_info); $i++) {
                $otherTravellerInfo[] = array("title" => 'Mr', "firstName" => $pass_info[$i]->first_name, "lastName" => $pass_info[$i]->last_name);
            }
        } else {
            $otherTravellerInfo = '';
        }
        $preferences = "";
        $note = "";
        $agencyReferenceNumber = '';


        $client = new SoapClient($this->URL_hotelspro, array('trace' => 1));
//        echo '<pre/>';
//        print_r($otherTravellerInfo);
//        exit;

        try {
            $data['errordesc'] = '';
            $makeHotelBooking = $client->makeHotelBooking($this->Api_Key_hotelspro, $processId, $agencyReferenceNumber, $leadTravellerInfo, $otherTravellerInfo, $preferences, $note, $hotel_id);

            $hotel = $makeHotelBooking->hotelBookingInfo;
//            echo'<pre>';
//            print_r($hotel);
//            exit;
            $rooms = is_array($hotel->rooms) ? $hotel->rooms : array($hotel->rooms);
            $policies = is_array($hotel->cancellationPolicy) ? $hotel->cancellationPolicy : array($hotel->cancellationPolicy);
        } catch (SoapFault $exception) {
            $data['errordesc'] = $exception->getMessage();
        }
//        echo '<pre/>';
//        print_r($data);
//        exit;
        if ($data['errordesc'] != '') {
            $data['error'] = $data['errordesc'];
            $this->load->view('b2c/hotel/error_page', $data);
        } else {
            //echo $hotel->bookingStatus;exit;
            $ProcessIdvalue = $makeHotelBooking->trackingId;
            if (false == empty($hotel)) {
                $BookingStatusvalue11 = $hotel->bookingStatus;
                if ($BookingStatusvalue11 == 1) {
                    $BookingStatusvalue = 'Confirmed';
                } elseif ($BookingStatusvalue11 == 2) {
                    $BookingStatusvalue = 'On Request';
                } elseif ($BookingStatusvalue11 == 3) {
                    $BookingStatusvalue = 'Rejected';
                } elseif ($BookingStatusvalue11 == 4) {
                    $BookingStatusvalue = 'Cancelled';
                } elseif ($BookingStatusvalue11 == 5) {
                    $BookingStatusvalue = 'Payment Processing';
                }
                $CheckInvalue = $hotel->checkIn;
                $CheckOutvalue = $hotel->checkOut;
                $BoardTypevalue = $hotel->boardType;
                $cancellationPolicy11 = $hotel->cancellationPolicy;
                foreach ($cancellationPolicy11 as $policy) {
                    $val[] = $policy->cancellationDay;
                    if (isset($policy->currency)) {
                        $val1[] = $policy->currency;
                    } else {
                        $val1[] = "USD";
                    }
                    $val2 = $policy->feeAmount;
                    $cutype = $policy->feeType;
                    //  $policy->remarks;
                }
                $newdate = strtotime('-' . $val[0] . ' day', strtotime($CheckInvalue));
                $cancel_till_date = date('Y-m-d', $newdate);
                /* 			
                  if($cutype=='Percent')
                  {
                  $cancelamount=($_REQUEST['amount']/100)*$val2;
                  }
                  else
                  {
                  $cancelamount=$val2;
                  } */
//end
            }
            //$currr = $this->session->userdata('costtype');
            $ConfirmationNumbervalue = '';
//	$a=($booked_amount_gta1/100)*$markup;
            //		$final=$booked_amount_gta1-$a;
            //$TotalPricevalue=number_format($booked_amount_gta1,'2','.','');
            $hotelcode = $this->input->post('hotelcode');

            $client = new SoapClient($this->URL_hotelspro, array('trace' => 1));
            $trackingId = $ProcessIdvalue;
            //   echo $trackingId;
            try {
                $data['errordesc'] = '';
                $getHotelBookingStatus = $client->getHotelBookingStatus($this->Api_Key_hotelspro, $trackingId);
            } catch (SoapFault $exception) {
                $data['errordesc'] = $exception->getMessage();
            }
            if ($data['errordesc'] != '') {
                $data['error'] = $data['errordesc'];
                $this->load->view('b2c/hotel/error_page', $data);
            } else {
                $ConfirmationNumbervalue = $getHotelBookingStatus->hotelBookingInfo->confirmationNumber;
            }
//  $perday_cancel_amt=$cancelamount;
            $ProcessIdvalue = $ProcessIdvalue;
            $BookingStatusvalue = $BookingStatusvalue;
            $hotelcode = $hotelcode;
            $CheckInvalue = $CheckInvalue;
            $CheckOutvalue = $CheckOutvalue;
            $cancel_date = $cancel_till_date;
//$amount = $booked_amount_gta1;
            $BoardTypevalue = $BoardTypevalue;
            $ConfirmationNumbervalue = $ConfirmationNumbervalue . '||' . $ProcessIdvalue;
//            $guestadult = $ses_hotel_search_data['adult_count'];
//            $guestchild = $ses_hotel_search_data['child_count'];
//            $cin = date("Y-m-d", strtotime($ses_hotel_search_data['checkin']));
//            $cout = date("Y-m-d", strtotime($ses_hotel_search_data['checkout']));
            $date = date('Y-m-d');
            $roomcountss = $ses_hotel_search_data['room_count'];
            $nights = $ses_hotel_search_data['noofnights'];
            $dateFromValc = Date('Y-m-d', strtotime("-5 days", strtotime($cin)));
            //$nights = $ses_hotel_search_data['noofdays'];
            $api = 'hotelspro';

            $agent_id = '';
            $user_id = '';

            $val_last = $this->Hotel_Model->inser_customer_book_hotelpro($h_hotel_id, $agent_id, $h_hotel_name, $h_star, $h_description, $h_address, $h_phone, $h_fax, $h_room_type, $h_cancel_policy, $cin, $cout, $date, $roomcountss, $agent_id, $nights, $trans_id, $adults, $child, $con_id_org, $dateFromValc, $h_city, $api);
            //$this->Hotel_Model->inser_customer_book_hotelpro_trans_hotel($trans_id,$ConfirmationNumbervalue,$agent_id,$val_last);
            $this->Hotel_Model->inser_customer_book_hotelpro_trans_hotel($con_id_org, $ConfirmationNumbervalue, $agent_id, $val_last, $BookingStatusvalue);
            //$this->voucher_email($val_last);
//            echo'ticket Generated';
//            echo '<pre>' . $val_last;
//            print_r($val_last);
//            exit;
            redirect('hotel/voucher/' . $val_last, 'refresh');
        }
    }

    function voucher($val_last) {
//        echo 'voiucxher<pre>';
//        print_r($val_last);
//        exit;

        $agent_id = $this->session->userdata('agent_id');
        $data['result_view'] = $this->Hotel_Model->book_detail_view_voucher1($val_last);
        $con_id = $data['result_view']->customer_contact_details_id;
        $data['contact_info'] = $this->Hotel_Model->contact_info_detail_update($con_id);
        $data['trans'] = $this->Hotel_Model->transation_detail_contact($con_id);
        $con_id_pass = $data['contact_info']->customer_info_details_id;
        $data['pass_info'] = $this->Hotel_Model->pass_info_detail($con_id_pass);
        $hotel_id = $data['result_view']->hotel_code;
        $data['hotel_image'] = $this->Hotel_Model->get_hotelimage($hotel_id);
        $data['agent_info'] = $this->Hotel_Model->getAgentInfo($agent_id);
        $data['hotel_decs'] = '';
//        echo "<pre/>";
//        print_r($data);
//        exit;
        $this->load->view('b2c/hotel/ticket', $data);
//       
    }

    // travelguru integration code ends here --------------------
    // Get Airport Code  Ends Here
    // Codeigniter Validation Rules Starts here
    function alpha_city_validation($str) {
        $this->form_validation->set_message('alpha_city_validation', 'Invalid City Code');
        return (!preg_match("/^([-a-z() ,])+$/i", $str)) ? FALSE : TRUE;
    }

    function date_validation($input) {
        $date = date('Y-m-d', strtotime($input));
        $this->form_validation->set_message('date_validation', 'Invalid Date');
        if ($date) {
            return true;
        } else {
            return false;
        }
    }

}

