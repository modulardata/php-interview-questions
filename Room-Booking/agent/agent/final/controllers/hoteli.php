<?php

ini_set('max_execution_time', 180000);
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
error_reporting(0);
session_start();

class Hotel extends CI_Controller {

    private $URL;
    private $client, $xml, $MidOfficeAgentID, $soapAction;
    private $airItinerary;
    private $sess_id;
    private $Api_Key;

    public function __construct() {
        parent::__construct();
        $this->load->model('Hotel_Model');
        $this->load->model('Home_Model');
        $this->load->library('form_validation');

        $this->load->helper('url');
        $this->load->library('session');
         $this->URL = "http://api.hotelspro.com/4.1_test/hotel/b2bHotelSOAP.wsdl";
//        $this->Api_Key = "eTluVFEvcWFtU0JVTDhlSGFhMmlxc1p6QW00RnVhSFZFQVFybVVQbEM1ZUVVMTB5SUNReUVOOUlheTAwcmhmRw==";
        // this is LIVE credentials
        $this->Api_Key = "UmkvYnRJNDY1RUoyanZnWldoUjNvTVp6QW00RnVhSFZFQVFybVVQbEM1ZGVqeUJweDlnK1J2Ym13YUFyVXhrMg==";
       // $this->URL = "http://api.hotelspro.com/4.1/hotel/b2bHotelSOAP.wsdl";
        //  this is LIVE credentials
        $this->agent_logged_in();
        $this->sess_id = $this->session->userdata('session_id');
    }

    public function index() {

        redirect('home/index', 'refresh');
    }

    function agent_logged_in() {

        if (!$this->session->userdata('agent_logged_in')) {
            redirect('home/index', 'refresh');
        }
    }

    public function hotel_search() {
        $post_value1 = $this->input->post();
        // echo '<pre>';
        // print_r($post_value1);
        //  exit;
        $this->form_validation->set_rules('City', 'Location', 'trim|required|xss_clean');
        $this->form_validation->set_rules('checkin', 'Check in', 'trim|required|callback_date_validation|xss_clean');
        $this->form_validation->set_rules('checkout', 'Check out', 'required|callback_date_validation|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $data['status'] = '';
            $this->load->view('home/agent_home', $data);
        } else {
            $adultvalue = $this->input->post('adult');
            $childvalue = $this->input->post('child');
            $room_count = $this->input->post('room_count');
            $city = $this->input->post('City');
            $checkin = $this->input->post('checkin');
            $checkout = $this->input->post('checkout');

            $nationallity = $this->input->post('nationality');
            if ($nationallity) {
                $nationallityvalue = $nationallity;
            } else {
                $nationallityvalue = 'US';
            }
            $noofnights = $this->Hotel_Model->calculatedateDiff($checkin, $checkout);

            if (!empty($city)) {
                $session_data = $this->session->userdata('hotel_search_data');
                //echo 'trter<pre>';print_r($session_data);exit;			
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
                    'days' => $noofnights,
                    'nationallityvalue' => $nationallityvalue
                );

                $this->session->set_userdata('hotel_search_data', $sess_array);
                //echo '<pre>' ;                print_r($sess_array); exit;

                $api_name_h = 'hotelspro';
                $data['api_name_h'] = $api_name_h;
                $data['hotel_facility'] = $this->Hotel_Model->get_hotel_facility();
                $data['room_facility'] = $this->Hotel_Model->get_room_facility();
                $this->session->set_userdata('api_name_h', $api_name_h);
                $this->load->view('hotel/search_progress', $data);
            }
        }
    }

    function search_progress() {
        // echo '<pre>';print_r($this->session->userdata);exit;
        $session_data = $this->session->userdata('hotel_search_data');
        $sess_city = $session_data['city'];
        $cityval = explode(",", $sess_city);

        $city = $cityval[0];
        // $postvalues = $this->input->post();
        //echo '<pre>';        print_r($city); exit;

        if ($this->session->userdata('hotel_search_activate') != 1) {
            if (isset($_POST) && $_POST['api_name'] != '') {
                $api = $_POST['api_name'];
                //echo '<pre>';print_r($this->session->userdata);exit;

                switch ($api) {

                    case 'hotelspro':
                        $this->hotelspro_search_availablility();
                        break;

                    default:
                        break;
                }
            }
        }


        $data['city'] = $city;
        $data['result'] = $this->Hotel_Model->fetch_hotel_result($this->sess_id);
//echo '<pre>';print_r($this->sess_id);echo'<br>';print_r($data);exit;
        $this->load->view('hotel/search_result', $data);
    }

    function hotelspro_search_availablility() {
        $hotel_search_datas = $this->session->userdata('hotel_search_data');
        $room_datas = $this->session->userdata('room_data');
        //$room_used_type = $room_datas['room_used_type'];
        $city = $hotel_search_datas['city'];
        $nationallityvalue = $hotel_search_datas['nationallityvalue'];
        $checkin = $hotel_search_datas['checkin'];
        $room_count = $hotel_search_datas['room_count'];
        //   echo '<pre>';          print_r($room_datas);
        $checkout = $hotel_search_datas['checkout'];
        $city_val = $this->Hotel_Model->get_city_code($city);
        $city_code = $city_val->hotelspro; //exit;
        $cinval = explode("/", $checkin);
        //echo '<pre>';        print_r($cinval); exit; 
        $cin = $cinval[2] . '-' . $cinval[1] . '-' . $cinval[0]; // echo $cin; exit;
        $coutval = explode("/", $checkout);
        $cout = $coutval[2] . '-' . $coutval[1] . '-' . $coutval[0];

        //echo '<pre>' ;        print_r($room_count) ;  exit;
        $adultvalue = '';
        $childvalue = '';
        $childvalue2 = '';
        $childvalue3 = '';
        $adult = $hotel_search_datas['adultvalue'];
        $child = $hotel_search_datas['childvalue'];
//        echo $room_count . '<pre>';
//        print_r($adult);
//        print_r($child);
//        exit;
        for ($r = 0; $r < $room_count; $r++) {
            $adultvalue = '';
            $childvalue = '';
            $childvalue2 = '';
            $childvalue3 = '';
            //child
            //child combination
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
//        echo '<br/>';print_r($city_code);
//        echo '<br/>';print_r($cin);
//        echo '<br/>';print_r($cout);
//        echo '<br/>';print_r($cout);
//
//
//        echo $this->Api_Key;
//

        $this->session->set_userdata('pro_search_id', '');
        // $client = new SoapClient("b2bHotelSOAP.wsdl", array('trace' => 1, 'exceptions' => 1, 'connection_timeout' => 12));

        $client = new SoapClient($this->URL, array('trace' => 1, 'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP));


//        echo '<pre>';
//        print_r($client);
//        exit;
        try {
            $checkAvailability = $client->getAvailableHotel($this->Api_Key, $city_code, $cin, $cout, "EUR", $nationallityvalue, "false", $rooms);
        } catch (SoapFault $exception) {
            $exception->getMessage();
        }  //echo '12345678123456789';exit;

        $this->session->set_userdata('pro_search_id', $checkAvailability->searchId);
        if (is_object($checkAvailability->availableHotels)) {
            $hotelResponse[] = $checkAvailability->availableHotels;
        } else {
            $hotelResponse = $checkAvailability->availableHotels;
        }
        $h = 0;
//        echo '<pre>';
//        print_r($hotelResponse);
//        exit;
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
            $api = "hotelspro";
            // $totalcost_m_m = $totalPrice;
            $roomtype = implode("<br>", $roomCategory);
            $totalRoomRate = array_sum($totalcost_m_m_ddn);
            //echo '<pre>';            print_r($totalRoomRate); exit;

            $adult_count = $room_datas['adult_count'];
            $child_count = $room_datas['child_count'];
            $currencyv1 = $currency;
            $c_val = 1;

            $agent_no = $this->session->userdata('agent_no');
            $admin_markup = '0';
            $agent_markup = '0';
            $total_amount = '0';
            //echo '<pre>';            print_r($agent_no); exit;
            $b2b_markup = $this->Hotel_Model->get_b2b_markup($agent_no);
            $admin_markup_val = $b2b_markup->markup;
            $agent_markup_val = $this->Hotel_Model->get_agent_markup($agent_no);
            //echo '<pre>';            print_r($agent_markup_val->markup); exit;

            $admin_markup = round(($totalPrice * ($admin_markup_val / 100)), 2);
            $agent_markup = round((($totalPrice + $admin_markup) * ($agent_markup_val->markup / 100)), 2);
            $total_amount = $totalPrice + $admin_markup + $agent_markup;


            $contry = $this->Hotel_Model->get_country($hotel_search_datas['city']);

            $city_name = $this->Hotel_Model->get_city_code_id($hotel_search_datas['city']);

            // ***************************inserting data into permanent table******************************************************* //
            if ($this->Hotel_Model->check_hotelspro_p_result($hotelCode) == '') {
                $hotellist = $this->Hotel_Model->fetch_hotespro_hotel_list($hotelCode);
                $hoteldesc = $this->Hotel_Model->fetch_hotespro_hotel_desc($hotelCode);
                $hotelamenty = $this->Hotel_Model->fetch_hotespro_hotel_amenty($hotelCode);
                //if($hotellist!='' AND $hoteldesc!='' AND $hotelamenty!=''){
                $hotellist = $this->Hotel_Model->insert_into_p_hotelspro($hotellist, $hoteldesc, $hotelamenty);
                //}
            }
// ***********************************inserting data into permanent table************************************** //


            $insertresult[$h] = array(
                'session_id' => $this->sess_id,
                'api' => $api,
                'hotel_code' => $hotelCode,
                'room_code' => $processId,
                'room_type' => $roomtype,
                'inclusion' => $boardType,
                'city' => $city_name->city_name,
                'status' => $availabilityStatus,
                'adult' => $adult_count,
                'child' => $child_count,
                'currency_val' => $c_val,
                'xml_currency' => $currencyv1,
                'totalPrice' => $totalPrice,
                'admin_markup' => $admin_markup,
                'agent_markup' => $agent_markup,
                'total_amount' => $total_amount,
                'room_count' => $room_count,
                'curr_date' => date("y.m.d")
            );
            $h++;
        }
        if (!empty($insertresult)) {
            // $this->db->set('register_date', 'NOW()', FALSE);
            $this->Hotel_Model->insert_temp_results($insertresult);
        }
    }

    public function PostRQ($post_xml) {
        //headers	
        //ini_set('max_execution_time', 60);
        $header[] = "POST HTTP/1.0";
        $header[] = "Content-type: text/xml";
        $header[] = "Content-length: " . strlen($post_xml);
        $header[] = "SOAPAction: http://tempuri.org/";

        // Create CURL Connection
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_USERAGENT, '');
        curl_setopt($ch, CURLOPT_URL, $this->URL);
        curl_setopt($ch, CURLOPT_TIMEOUT, 180);
        curl_setopt($ch, CURLOPT_CONNECTIONTIMEOUT, 180);
        curl_setopt($ch, CURLOPT_FAILONERROR, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_xml);

        $curlresp = curl_exec($ch);
        $error2 = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return $curlresp;
    }

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

    public function hotel_autolist() {

        if (isset($_GET['term'])) {

            $q = strtolower($_GET["term"]);
            if (!$q)
                return;

            $return_arr = array();
            $search = $_GET["term"];
            $city_list = $this->Hotel_Model->get_hotel_list($search);
//echo '<pre>';print_r($city_list);
            if (!empty($city_list)) {
                for ($i = 0; $i < count($city_list); $i++) {
                    $hotel_city = $city_list[$i]['city'];
//$hotel_country = $city_list[$i]['country_name'];
                    if (strpos(strtolower($hotel_city), $q) !== false) {
                        $return_arr[] = array(
                            'label' => ucfirst($hotel_city),
                            'value' => ucfirst($hotel_city)
                        );
                    }
                }
            } else {
                $return_arr[] = array(
                    'label' => "No Results Found",
                    'value' => ""
                );
            }
        } else {
            $return_arr[] = array(
                'label' => "No Results Found",
                'value' => ""
            );
        }
        /* Toss back results as json encoded array. */
        echo json_encode($return_arr);
    }

    function hotel_detail($id) {
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
        //echo '<pre>';        print_r($hotel_code); exit;
        if ($data['lat'] != '' && $data['long'] != '') {
            $data['nearby_hotel'] = $this->Hotel_Model->get_nearby_hotels($data['lat'], $data['long'], $data['hotel_name'], $data['dest'], $data['session']);
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
        $this->load->library('googlemaps');
        $config['center'] = $service->latitude . ',' . $service->longitude;

        $config['zoom'] = 11;
        $this->googlemaps->initialize($config);

        $marker = array();
        $marker['position'] = $service->latitude . ',' . $service->longitude;
        $this->googlemaps->add_marker($marker);

        $data['map'] = $this->googlemaps->create_map();
//echo '<pre>';        print_r($data); exit;
        //////////////////////////////////////////
//        echo "<pre/>";
//        print_r($data['img_array'] );
//        exit;
        $this->load->view('hotel/hotel_details', $data);
        //}
    }

    function mapping_fun_all() {
        // $data['city']=$this->session->userdata('hotel_search_data'); 

        $data['result'] = $this->Hotel_Model->fetch_search_result_map_new_select_session();

        $this->load->view('hotel/map_all', $data);
    }

    function fetch_search_result_map() {
        $query = $this->Hotel_Model->fetch_search_result_map_new();
        $map_data = array();
        $cnt = 0;
        for ($k = 0; $k < count($query); $k++) {
            $map_data[$cnt]['lat'] = $query[$k]['latitude'];
            $map_data[$cnt]['lng'] = $query[$k]['longitude'];
            $map_data[$cnt]['name'] = $query[$k]['hotel_name'];
            $star = $query[$k]['star'];
            if ($star == 1) {
                $st = "<img src='" . WEB_DIR . "images/1 star.jpg' />";
            } elseif ($star == 2) {
                $st = "<img src='" . WEB_DIR . "images/2 star.jpg' />";
            } elseif ($star == 3) {
                $st = "<img src='" . WEB_DIR . "images/3 star.jpg' />";
            } elseif ($star == 4) {
                $st = "<img src='" . WEB_DIR . "images/4 star.jpg' />";
            } elseif ($star == 5) {
                $st = "<img src='" . WEB_DIR . "images/5 star.jpg' />";
            } else {
                $st = "<img src='" . WEB_DIR . "images/0 star copy.jpg' />";
            }
            $info = "<div id='mapdetailsbox2'><div id='imgbox2'><img src='' width='70px' height='70px' /></div><div id='hotelname2'>" . $query[$k]['hotel_name'] . "</div>";
            $info.="<div id='star2'> " . $st . " </div> <div id='avalabletxt2'> Avalable From</div><div id='doller2'>" . $query[$k]['low_cost'] . "</div><div id='pernight2'> Per Night</div><div style='clear:both'></div></div>";
            $map_data[$cnt]['info'] = $info;

            // echo '<pre>';            print_r($map_data); exit;
            $cnt++;
        }
        echo json_encode($map_data);
    }

    function pro_pre_booking($result_id) {

        $data['search_details'] = $this->session->userdata('hotel_search_data');
        $room = $this->session->userdata('hotel_search_data');

        $room_count = $room['room_count'];
        //echo '<pre>'; print_r($this->session->all_userdata()); exit;
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

        $client = new SoapClient($this->URL, array('trace' => 1));
        try {
            $pid = $this->session->userdata('pro_search_id');
            $hid = $hotel_code;
            $allocateHotelCode = $client->allocateHotelCode($this->Api_Key, $pid, $hid);
        } catch (SoapFault $exception) {
            $data['errordesc'] = $exception->getMessage();
        }
        if ($data['errordesc'] != '') {
            $error = $data['errordesc'];
            redirect('hotel/errorpage/' . $error);
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
                $agent_no = $this->session->userdata('agent_no');
                $b2b_markup = $this->Hotel_Model->get_b2b_markup($agent_no);
                $admin_markup_val = $b2b_markup->markup;
                $agent_markup_val = $this->Hotel_Model->get_agent_markup($agent_no);
                $admin_markup = round(($totalRoomRate * ($admin_markup_val / 100)), 2);
                $agent_markup = round((($totalRoomRate + $admin_markup) * ($agent_markup_val->markup / 100)), 2);

                if ($currencyv1 != 'EUR') {
                    $c_val1 = $this->Hotel_Model->get_currecy_details($currencyv1);

                    if ($c_val1 != '') {
                        $c_val = $c_val1->value;
                    } else {
                        $c_val = '';
                    }
                    //echo '<pre>';            print_r($agent_markup_val->markup); exit;
                } else {
                    $c_val = 1;
                    $total_amount = $totalRoomRate + $admin_markup + $agent_markup;
                }

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
                $roommm[] = array('process_id' => $process_id, 'status' => $status, 'totalRoomRate' => $totalRoomRate, 'admin_markup' => $admin_markup, 'agent_markup' => $agent_markup, 'total_amount' => $total_amount, 'room' => $room, 'boardType' => $boardType, 'currencyv1' => $currencyv1, 'c_val' => $c_val);
            }
            $data['room_cat_details'] = $roommm;
//            echo '<pre/>';
//            print_r($data);
//            exit;

            $this->load->view('hotel/pro_pre_booking', $data);
        }
    }

//    public function backtosearch() {
//
//        $data['$api_name_h'] = 'hotelspro';
//        $this->load->view('hotel/search_progress', $data);
//    }

    public function backtosearch() {

        $data['$api_name_h'] = 'hotelspro';
        $this->load->view('hotel/search_progress', $data);
    }

    function pre_booking($result_id) {

        $sess_hotel_search_data = $this->session->userdata('hotel_search_data');
        $sess_room_data = $this->session->userdata('room_data');
//
//        $this->form_validation->set_rules('address', 'Address', 'required');
//        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|matches[cemail]');
        $this->form_validation->set_rules('cemail', 'Confirm Email', 'required|valid_email');
//        $this->form_validation->set_rules('pin', 'Post/Zip Code', 'required');
//        $this->form_validation->set_rules('country', 'Country', 'required');
//        $this->form_validation->set_rules('state', 'State', 'required');
//        $this->form_validation->set_rules('mobile', 'Mobile', 'required');
        //       $this->form_validation->set_rules('sal', 'Title', 'required');

        if ($this->form_validation->run() == FALSE) {
            //echo 'False'; exit;
            // -------------------------------cancellationa policy is bloced ----------------------//


            $room_count = $sess_hotel_search_data['room_count'];
            $process_id_fin = $this->input->post('process_id_fin');
//
//            echo '<pre>';
//            print_r($process_id_fin);
//            exit;

            if (isset($process_id_fin)) {
                // echo '<pre>';
//                print_r($process_id_fin);

                $pro_idd = explode("|||", $this->input->post('process_id_fin'));
//                print_r($pro_idd);
//               exit;
                $hotel_proid = $pro_idd[0]; //echo '<br>Process Id: '.$hotel_proid;
                $admin_markup = $pro_idd[1]; //echo '<br>Admin Markup: '. $admin_markup; 
                $room = $pro_idd[2];    // echo '<br>Room: '. $room;
                $agent_markup = $pro_idd[3]; //echo '<br>Agent_markup: '. $agent_markup; 
                $boardType = $pro_idd[4]; //echo '<br>Agent_markup: '. $boardType; 
                $total_amount = $pro_idd[5]; //echo '<br>Agent_markup: ' .$total_amount; 
                $currencyv1 = $pro_idd[6]; //echo '<br>Agent_markup: ' .$currencyv1; //exit;
                $c_val = $pro_idd[7]; // echo '<br>$c_val: ' .$c_val; //exit;
                $totalRoomRate = $pro_idd[8]; //echo  '<br>$totalRoomRate: ' .$totalRoomRate; exit;



                $this->Hotel_Model->Update_room_type_in_search_result($result_id, $hotel_proid, $totalRoomRate, $admin_markup, $agent_markup, $total_amount, $room, $boardType, $currencyv1, $c_val);
            } else {
                redirect('hotel/pre_booking/' . $result_id, 'refresh');
            }


            if ($room_count == 1) {
                // echo 'This is '.$room_count;exit;
                $service = $this->Hotel_Model->get_searchresult($result_id);
                //echo '<pre>';              print_r($service); exit;
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
                //echo '<pre>';              print_r($rm_info); exit;
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
            $data['room_type'] = $service->room_type;
            $data['phone'] = $service->phone;
            $data['location'] = $service->location;
            $room = $service->room_code;
            $data['lat'] = $service->latitude;
            $data['long'] = $service->longitude;
            $data['hotel_name'] = $service->hotel_name;
            $data['description'] = $service->description;
            $data['address'] = $service->address;
            $data['dest'] = $service->city;
            $data['totalPrice'] = $service->totalPrice;
            $data['admin_markup'] = $service->admin_markup;
            $data['agent_markup'] = $service->agent_markup;
            $data['total_amount'] = $service->total_amount;
            $data['country_list'] = $this->Hotel_Model->get_country_list();

            set_time_limit(0);
            $time = time();
            $vat_time = date('Y-m-d') . " " . "T" . date('h:i:s');


            $client = new SoapClient($this->URL, array('trace' => 1));
            $processId = $hotel_proid;

            try {
                $data['errordesc'] = '';
                $getHotelCancellationPolicy = $client->getHotelCancellationPolicy($this->Api_Key, $processId, $hotel_code);
                // echo '<pre>';              print_r($getHotelCancellationPolicy); exit;
            } catch (SoapFault $exception) {
                
            }
            if ($data['errordesc'] != '') {
                $error = $data['errordesc'];
                redirect('hotel/errorpage/' . $error);
            } else {
                $val = array();
                $val1 = array();
                $policies = is_array($getHotelCancellationPolicy->cancellationPolicy) ? $getHotelCancellationPolicy->cancellationPolicy : array($getHotelCancellationPolicy->cancellationPolicy);
                //echo "<pre/>";print_r($policies); exit;
                foreach ($policies as $policy) {
                    $val[] = $policy->cancellationDay;
                    if (isset($policy->currency)) {
                        $val1[] = $policy->currency;
                    } else {
                        $val1[] = "EUR";
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
//                    //  $policy->remarks;
                }

                // echo '<pre>';                print_r($total_amount); exit;
                if ($feeType[0] != '') {
                    if ($feeType[0] == 'Night') {
                        $per_ngt = $total_amount / $sess_hotel_search_data['days'];
                        $cancelamount1 = ceil($per_ngt * $feeAmount[0]);
                    } elseif ($feeType[0] == 'Percent') {
                        $cancelamount1 = ($total_amount / 100) * $feeAmount[0];
                    } elseif ($feeType[0] == 'Amount') {
                        $cancelamount1 = $feeAmount[0];
                    }
                }
                if ($feeType[1] != '') {
                    if ($feeType[1] == 'Night') {
                        $per_ngt = $total_amount / $sess_hotel_search_data['days'];
                        $cancelamount2 = ceil($per_ngt * $feeAmount[0]);
                    } elseif ($feeType[1] == 'Percent') {
                        $cancelamount2 = ($total_amount / 100) * $feeAmount[1];
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
//echo '<pre>';print_r($cancellationDay); exit;




                $cancel = 'Cancellation penalty for cancellation made within ' . $cancellationDay[0] . ' days of the ' . $sess_hotel_search_data['checkin'] . '
              ' . $cancelamount1 . ' ' . $val1[0] . ' Charges Will Apply<br>';
                $cancel .='Cancellation penalty for cancellation made within ' . $cancellationDay[1] . ' days of the ' . $sess_hotel_search_data['checkin'] . '
              ' . $cancelamount2 . ' ' . $val1[1] . ' Charges Will Apply';
                $cancel .='<br>' . $remarks[0] . '<br>' . $remarks[1];
                //echo '<pre>'; print_r($sess_hotel_search_data['checkin']);exit;
                $data['cancel_policy'] = $cancel;

                $checkin = $sess_hotel_search_data['checkin'];

                $cinval = explode("/", $checkin);
                $cin = $cinval[2] . '-' . $cinval[1] . '-' . $cinval[0]; // echo $cin; exit;

                $data['new_cancelaion_till_date'] = Date('Y-m-d', strtotime("-$cancellationDay[0] days", strtotime($cin)));
                $data['new_cancelaion_charge'] = $cancelamount1;
                $data['api'] = 'hotelspro';
//                echo '<pre>';
//                print_r($data);
//                exit;
//              

                $this->load->view('hotel/pre_booking', $data);
            }
        } else {
//            echo 'Coming from Pre booking views';
//            exit;

            $result_id1 = explode("-", $result_id);
            $service = $this->Hotel_Model->get_searchresult($result_id1[0]);

            $api = $service->api;

            $post_values = $_POST;
            //echo '<pre>';            print_r($post_values); exit;

            $this->session->set_userdata('book_final_book_val', $post_values);
            $book_final_book_val = $this->session->userdata('book_final_book_val');
//            echo '<pre>';
//            print_r($book_final_book_val);
//            exit;


            $_SESSION['hotel_testing'] = $_POST;
            $data['id'] = $_POST['result_id'];
            $amount = $_POST['total_amount'];
//
//            echo '<pre>';
//            print_r($data);
//            exit;
            redirect("hotel/booking_final", 'refresh');
            //$this->load->view('hotel/payment/payment.php', $data);
            // redirect("hotel/payment_process/$result_id/$amount", 'refresh');
        }
    }

    function booking_final() {
        $transact_response = $this->session->userdata('tran_resp');
        $transact_id = $transact_response['transaction_id'];
        $value = $_SESSION['hotel_testing'];
        $value['provision_id'] = $value['result_id'];
        ;
        $sec_res = $this->sess_id;
        $id = $value['result_id'];
        $id_1 = explode("-", $id);
        $service = array();
        $hotel_id = '';
        $roomcat = '';
        $roomty = '';
        $fname = $value['fname']; //echo'<pre>'; print_r($book_final_book_val); exit;
        //print_r($gender);exit;
        $lname = $value['lname'];
        $title = $value['sal'];
        $ctitle = $value['csal'];
        $gender = $value['gender'];
        $cgender = $value['cgender'];
        if (isset($value['cname'])) {
            $cname = $value['cname'];
            $cname1 = $value['cname1'];
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

        $data5 = array(
            'product_id' => 2,
            'user_id' => '0',
            'user_type' => 4,
            'prn_no' => $value['provision_id'],
            'cancellation_till_date' => $value['t_cancel_till_date'],
            'cancellation_till_charge' => $value['t_cancel_till_amt'],
            'agent_markup' => $value['agent_markup'],
            'session' => $sec_res,
            'admin_markup' => $value['admin_markup'],
            'totalprice' => $value['totalprice'],
            'total_amount' => $value['total_amount'],
            'xml_currency' => $value['xml_currency'],
            'customer_contact_details_id' => $parent_customer_id,
            'payment_details_id' => $transact_id,
            'created_date' => date("Y-m-d")
        );
        $this->db->insert('transaction_details', $data5); //exit;
        $parent_transaction_id = $this->db->insert_id();
        $amount = $value['total_amount'];
        $data_result = array(
            'result_id' => $id,
            'parent_transaction_id' => $parent_transaction_id,
            'amount' => $amount,
            'payment_id' => '',
            'random_id' => ''
        );
        $this->session->set_userdata('booking_trans_details', $data_result);


        redirect('hotel/payment_process', 'refresh');
    }

    function payment_process() {
        $data['booking_trans_details'] = $this->session->userdata('booking_trans_details');
//echo '<pre>';print_r($data); exit;
        $result_id = $data['booking_trans_details']['result_id'];
        $amount = $data['booking_trans_details']['amount'];
        $random_id = $data['booking_trans_details']['random_id'];
        $payment_id = $data['booking_trans_details']['payment_id'];
        $agent_id = $this->session->userdata('agent_id');

        $parent_transaction_id = $data['booking_trans_details']['parent_transaction_id'];
        $data['agent_info'] = $this->Hotel_Model->getAgentInfo($agent_id);
        $agent_type = $data['agent_info']->agent_type;

//        echo '<pre>';
//        print_r($result_id);echo '<br/>';
//        print_r($amount);echo '<br/>';
//        print_r($parent_transaction_id);echo '<br/>';
//        print_r($agent_type);echo '<br/>';
//        
//        echo '<pre>';
//        print_r($agent_type);
//        exit;
//        echo 'Out' . $agent_type;
//        exit;
        if ($agent_type == 1) {
//            echo 'Deposite: ' . $agent_type;
//            exit;


            redirect("hotel/deposit_agent/$result_id/$parent_transaction_id/$amount/$payment_id/$random_id", 'refresh');
        } else if ($agent_type == 2) {
//            echo 'Credit: ' . $agent_type;
//            exit;
            //echo '<pre>';print_r($amouont); exit;
// The POST URL and parameters
            // $request = 'http://demo.vivapayments.com/api/orders'; // demo environment URL
            $request = 'https://www.vivapayments.com/api/orders'; // production environment URL
// Your merchant ID and API Key can be found in the 'Security' settungs on your profile.
//  for Demo:          $MerchantId = '0c432136-8359-4a08-b31c-93098729325b';
//            $APIKey = 'finalbooking';

            $MerchantId = '9c7e84e0-07bf-461c-bfba-8229cecbcd6e';
            $APIKey = 'chris1#2#1#2';

//Set the Payment Amount
            $total_amount = str_replace(".", "", $amount);
            $Amount = $total_amount; // Amount in cents
//Set some optional parameters (Full list available here: https://github.com/VivaPayments/API/wiki/Optional-Parameters)
            $AllowRecurring = 'true'; // This flag will prompt the customer to accept recurring payments in tbe future.
            $RequestLang = 'en-US'; //This will display the payment page in English (default language is Greek)


            $postargs = 'Amount=' . urlencode($Amount) . '&AllowRecurring=' . $AllowRecurring . '&RequestLang=' . $RequestLang;

// Get the curl session object
            $session = curl_init($request);
//echo '<pre>';print_r($postargs); exit;
// Set the POST options.
            curl_setopt($session, CURLOPT_POST, true);
            curl_setopt($session, CURLOPT_POSTFIELDS, $postargs);
            curl_setopt($session, CURLOPT_HEADER, false);
            curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($session, CURLOPT_USERPWD, $MerchantId . ':' . $APIKey);

// Do the POST and then close the session
            $response = curl_exec($session);
            curl_close($session);

// Parse the JSON response
            try {
                if (is_object(json_decode($response))) {
                    $resultObj = json_decode($response);
                } else {
                    throw new Exception("Result is not a json object: ");
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }

            if ($resultObj->ErrorCode == 0) { //success when ErrorCode = 0
                $orderId = $resultObj->OrderCode;
                $data['orderId'] = $orderId;
//    //echo '<pre>';    print_r($orderId); exit;
//    echo 'Your Order Code is: <b>' . $orderId . '</b>';
//    echo '<br/><br/>';         

                $this->load->view('hotel/payment/payment_progress', $data);
            } else {
                echo 'The following error occured: ' . $resultObj->ErrorText;
            }
        } else {
            $this->load->view('hotel/payment/payment_progress', $data);
        }
    }

    function deposit_agent($result_id, $parent_transaction_id, $amount) {
        $withdraw_amount = '0';
        $available_balance = '0';
        $agent_id = $this->session->userdata('agent_id');
        $agent_no = $this->session->userdata('agent_no');
        $agent_available_balance = $this->Hotel_Model->get_agent_available_balance($agent_no);

        $available_balance = $agent_available_balance->closing_balance;



        if ($available_balance < $amount) {
            $error = 'Your balance is too low for booking this hotel';
            redirect('hotel/errorpage/' . $error);
        } else {
            $desc = 'Towards Hotel Booking: ' . $result_id . '-' . $parent_transaction_id;

            $this->Hotel_Model->update_transaction_amount($agent_id, $agent_no, $amount, $desc, $parent_transaction_id);

            $withdraw_amount = $amount;
            $closing_balance = $available_balance - $withdraw_amount;

            $this->Hotel_Model->update_agent_withdraw_amount($agent_no, $withdraw_amount, $closing_balance);

            redirect("hotel/booking_final_pay/$result_id/$parent_transaction_id/null/null", 'refresh');
        }
    }

    function payment_success() {
        //echo 'dfhgdfs'; exit;
        $data['payment_details'] = $this->session->userdata('booking_trans_details');
        $this->session->set_userdata('tran_resp', $_REQUEST);
        $result_id_1 = $data['payment_details']['result_id'];
        $parent_transaction_id_1 = $data['payment_details']['parent_transaction_id'];

//        echo 'result_id<pre>';
//        print_r($result_id_1);echo'<br/>';
//           print_r($parent_transaction_id_1);echo'<br/>';
        //print_r($_REQUEST);

        $data['transact_response'] = $this->session->userdata('tran_resp');
        $payment_id = $data['transact_response']['payment_id'];
        $random_id = $data['transact_response']['random_id'];

//        echo '<pre>';
//        print_r($payment_id);echo '<br/>';
//        print_r($random_id);echo '<br/>';
//         exit;
        redirect("hotel/booking_final_pay/$result_id_1/$parent_transaction_id_1/$payment_id/$random_id", 'refresh');
    }

    function payment_failure() {
        $error = 'Booking Failed';
        redirect('hotel/errorpage/' . $error);
    }

    function errorpage($error) {

        $data['error'] = $error;
        $this->load->view('hotel/error_page', $data);
    }

    function booking_final_pay($result_id, $parent_transaction_id, $payment_id, $random_id) {
        $ses_hotel_search_data = $this->session->userdata('hotel_search_data');
        //   $sess_room_data = $this->session->userdata('room_data');
        $room_count = $ses_hotel_search_data['room_count'];
        $checkin = $ses_hotel_search_data['checkin'];
        $checkout = $ses_hotel_search_data['checkout'];
//        $h_adult = $ses_hotel_search_data['adultvalue'];
//        $h_child = $ses_hotel_search_data['childvalue'];
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
//            $h_lat = $service->latitude;
//            $h_lon = $service->longitude;
            $trans = $this->Hotel_Model->transation_detail($parent_transaction_id);
            //echo '<pre>'; 
            //$amount = $trans->total_amount;
            //print_r($amount);
            //exit;// From Transaction Table
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
//            $guestadult = $ses_hotel_search_data['adultvalue'];
//            $guestchild = $ses_hotel_search_data['childvalue'];
            $date = date('Y-m-d');
            $roomcountss = $ses_hotel_search_data['room_count'];
            $nights = $ses_hotel_search_data['days'];
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
        // echo '<pre>';        print_r($h_room_type); exit;
        $h_cancel_policy = $sess_book_final_book_val['Cancellation_Policy'];
        $api = $service->api;


        $roomcount = $ses_hotel_search_data['room_count'];
        //$child_age = $ses_hotel_search_data['child_age'];
        $roomcount = $ses_hotel_search_data['room_count'];

        // echo '<pre>';    print_r($dbcc_age); exit;
        $search = $this->Hotel_Model->get_cancel_attrib_new($result_id);
        //echo '<pre>';        print_r($search); exit;
        $adults = $search->adult;
        //echo '<pre>';        print_r($adults); exit;
        $child = $search->child;
        //$roomcat = $search->room_code;
        $hotel_id = $search->hotel_code;
        $roomcountss = $ses_hotel_search_data['room_count'];
        //$noofdays = $ses_hotel_search_data['days'];
        $data['guestadult'] = $ses_hotel_search_data['adultvalue'];
        $data['guestchild'] = $ses_hotel_search_data['childvalue'];
        //$address = $contact_info->city;
        $cinval = explode("/", $checkin);
        $coutval = explode("/", $checkout);
        $cin = $cinval[2] . '-' . $cinval[1] . '-' . $cinval[0]; // echo $cin; exit;
        $cout = $coutval[2] . '-' . $coutval[1] . '-' . $coutval[0];  //echo $cout; exit;
        //  $noofroom = $ses_hotel_search_data['room_count'];
        $child = $ses_hotel_search_data['childvalue'];
        $adult = $ses_hotel_search_data['adultvalue'];
        //$api = 'gta';
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
        //echo '<pre>';            print_r($paxInfo); exit;
        $leadTravellerInfo["paxInfo"] = $paxInfo;
        $leadTravellerInfo["nationality"] = "US";
        $otherTravellerInfo = array();
        // echo '<pre/>';print_r($pass_info);
        // echo '<pre>'; print_r($leadTravellerInfo);exit;
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

        $client = new SoapClient($this->URL, array('trace' => 1));
        //echo '<pre>';    print_r($leadTravellerInfo);    print_r($otherTravellerInfo); exit;

        try {
            $data['errordesc'] = '';
            $makeHotelBooking = $client->makeHotelBooking($this->Api_Key, $processId, $agencyReferenceNumber, $leadTravellerInfo, $otherTravellerInfo, $preferences, $note, $hotel_id);

            $hotel = $makeHotelBooking->hotelBookingInfo;

            // exit;
            $rooms = is_array($hotel->rooms) ? $hotel->rooms : array($hotel->rooms);
            $policies = is_array($hotel->cancellationPolicy) ? $hotel->cancellationPolicy : array($hotel->cancellationPolicy);
        } catch (SoapFault $exception) {
            $data['errordesc'] = $exception->getMessage();
        }

        if ($data['errordesc'] != '') {

            $error = $data['errordesc'];
            redirect('hotel/errorpage/' . $error);
        } else {
            $hotel->bookingStatus; //

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
                        $val1[] = "EUR";
                    }
                    $val2 = $policy->feeAmount;
                    $cutype = $policy->feeType;
                    //  $policy->remarks;
                }
                $newdate = strtotime('-' . $val[0] . ' days', strtotime($CheckInvalue));
            }

            $ConfirmationNumbervalue = '';

            $hotelcode = $this->input->post('hotelcode');

            $client = new SoapClient($this->URL, array('trace' => 1));
            $trackingId = $ProcessIdvalue;
            $agent_id = $this->session->userdata('agent_id');
            $data['agent_info'] = $this->Hotel_Model->getAgentInfo($agent_id);
            $agent_no = $data['agent_info']->agent_no;
            $desc = $result_id . '-' . $parent_transaction_id;

            //   echo $trackingId;
            try {
                $data['errordesc'] = '';
                $getHotelBookingStatus = $client->getHotelBookingStatus($this->Api_Key, $trackingId);
            } catch (SoapFault $exception) {
                $data['errordesc'] = $exception->getMessage();
            }
            if ($data['errordesc'] != '') {

                $error = $data['error'] = $data['errordesc'];
                redirect('hotel/errorpage/' . $error);
            } else {
                $ConfirmationNumbervalue = $getHotelBookingStatus->hotelBookingInfo->confirmationNumber;
            }
//  $perday_cancel_amt=$cancelamount;
            $ProcessIdvalue = $ProcessIdvalue;
            $BookingStatusvalue = $BookingStatusvalue;
            $hotelcode = $hotelcode;
            $CheckInvalue = $CheckInvalue;
            $CheckOutvalue = $CheckOutvalue;
            //$cancel_date = $cancel_till_date;
//$amount = $booked_amount_gta1;
            $BoardTypevalue = $BoardTypevalue;
            $ConfirmationNumbervalue = $ConfirmationNumbervalue . '||' . $ProcessIdvalue;
//            $guestadult = $ses_hotel_search_data['adult_count'];
//            $guestchild = $ses_hotel_search_data['child_count'];
//            $cin = date("Y-m-d", strtotime($ses_hotel_search_data['checkin']));
//            $cout = date("Y-m-d", strtotime($ses_hotel_search_data['checkout']));
            $date = date('Y-m-d');
            $roomcountss = $ses_hotel_search_data['room_count'];
            $nights = $ses_hotel_search_data['days'];
            $dateFromValc = Date('Y-m-d', strtotime("-5 days", strtotime($cin)));
            $nights = $ses_hotel_search_data['days'];
            $api = 'hotelspro';
            $agent_id = $this->session->userdata('agent_id');


            if ($agent_id) {
                $data['errordesc'] = 'Please Try again';
                $val_last = $this->Hotel_Model->inser_customer_book_hotelpro($h_hotel_id, $agent_id, $agent_no, $h_hotel_name, $h_star, $h_description, $h_address, $h_phone, $h_fax, $h_room_type, $h_cancel_policy, $cin, $cout, $date, $roomcountss, $user_id, $nights, $trans_id, $adults, $child, $con_id_org, $dateFromValc, $h_city, $api);
                //$this->Hotel_Model->inser_customer_book_hotelpro_trans_hotel($trans_id,$ConfirmationNumbervalue,$user_id,$val_last);
                $this->Hotel_Model->inser_customer_book_hotelpro_trans_hotel($con_id_org, $ConfirmationNumbervalue, $user_id, $val_last, $BookingStatusvalue, $payment_id, $random_id);
                $this->voucher_email($val_last);
//            echo'ticket Generated';
//            exit;
            }
            redirect('hotel/voucher/' . $val_last, 'refresh');
        }
    }

    function voucher_email($id) {
        $result_view = $this->Hotel_Model->book_detail_view_voucher1($id);
        $con_id = $result_view->customer_contact_details_id;
        $trans = $this->Hotel_Model->transation_detail_contact($con_id);
        $contact_info = $this->Hotel_Model->contact_info_detail_update($con_id);
        $pass_info = $this->Hotel_Model->pass_info_detail($con_id);
        $hotel_id = $result_view->hotel_code;

        $hotel_decs = '';
        $first_name = $contact_info->first_name;

        $msg = '';
        $msg .= '<html>
<head>
</head>
<body>
<div >
    <div >
   <div>
    <div class="hotelnames" style="min-height:329px;">
        <table width="100%" border="0" cellspacing="7" cellpadding="3" class="r-hoteldeta">
          <tr>
		  <td  class="right-hotel-name">
            <img src="' . WEB_DIR . 'images/logo.jpg">
			</td>
          	<td  class="right-hotel-name">
           <span  style=" font-weight:bold;font-size:20px;"> <font color="#227fb0"> BOOKING VOUCHER</font></span>
			</td>
          </tr>
		  <tr>
		  <td colspan="2">
 <span style="float:left;">Hotel Name : ' . $result_view->hotel_name . '</span>
            <span style="float:right;"></span>
            <div style="float:left; clear:both">
            	<span class="sum-txt">Booking Number :</span>
                <span>' . $trans->booking_number . '</span>
             </div>
		  </td>
          <tr>
          	<td colspan="2" ><span style="font-size:15px"><strong>Dear Mr ' . $contact_info->first_name . '</strong></span><br />
<span>Thank  you for booking your hotel with streamtravels. We are pleased to confirm your booking details as below:</span></td>
          </tr>';
        $adult_co = explode("-", $result_view->adult);
        $adult_count = array_sum($adult_co);
        $child_co = explode("-", $result_view->child);
        $child_count = array_sum($child_co);
        $msg.=' <tr>
          	<td width="350" align="left" valign="top"><table width="100%" border="0" cellspacing="5" cellpadding="5" class="sum-txt">
                  <tr>
                    <td colspan="2" class="mid-txt" style=" font-size:15px; margin-top:15px;  background-color:#bee7ff; border-radius:10px;  text-align:center"><strong>Traveller Details</strong></td>
                  </tr>
                  <tr>
                    <td width="230"><strong>Guest Name</strong></td>
                    <td width="120"><strong>: Mr ' . $contact_info->first_name . '</strong></td>
                  </tr>
                  <tr>
                    <td><strong>No. of Adults</strong></td>
                    <td><strong>:' . $adult_count . ' Adults</strong></td>
                  </tr>
                  <tr>
                    <td><strong>No. of Childern</strong></td>
                    <td><strong>: ' . $child_count . ' Childern</strong></td>
                  </tr>
                  <tr>
                    <td><strong>Voucher Date</strong></td>
                    <td><strong>: ' . $trans->created_date . '</strong></td>
                  </tr>
                </table>
                </td>
            <td width="350" align="left" valign="top"><table width="100%" border="0" cellspacing="5" cellpadding="5" class="sum-txt">
                  <tr>
                    <td colspan="2" class="mid-txt" style=" font-size:15px; margin-top:15px;  background-color:#bee7ff; border-radius:10px; text-align:center"><strong>Your Reservation</strong>
</td>
                  </tr>
                  <tr>
                    <td width="230"><strong>Hotel Booking Number</strong></td>
                    <td width="120"><strong>: ' . $trans->booking_number . '</strong></td>
                  </tr>
                  <tr>
                    <td><strong>Check - in</strong></td>
                    <td><strong>: ' . $result_view->check_in . '</strong></td>
                  </tr>
                  <tr>
                    <td><strong>Check - out</strong></td>
                    <td><strong>: ' . $result_view->check_out . '</strong></td>
                  </tr>
                  <tr>
                    <td><strong>Rooms</strong></td>
                    <td><strong>: ' . $result_view->no_of_room . ' Room</strong></td>
                  </tr>
                   <tr>
                    <td><strong>Nights</strong></td>
                    <td><strong>: ' . $result_view->nights . ' nights</strong></td>
                  </tr>
                </table>
                </td>
          </tr>
        </table>
      <table><tr><td>PLASE call our EMERGENCY LINE for assistance at check in time: 001-212-401-4540</td></tr></table>
    </div>
    <table align="left" width="100%" border="0" cellspacing="5" cellpadding="5" class="sum-txt" style="margin-top:15px; font-size:15px; font-weight:bold; background-color:#bee7ff; border-radius:10px;">
      <tr>
         <td width="200" align="left">Hotel Details</td>
         <td  align="left">&nbsp;</td>
      </tr>
    </table>
     <table align="left" width="100%" border="0" cellspacing="0" cellpadding="5" class="sum-txt" style="margin-top:2px; font-size:15px; border:1px #bee7ff solid; border-radius:10px;">
      <tr>
         <td align="left">
                	<p class="mid-txt">' . $result_view->hotel_name . ' 
 </p><br />
                    <p>' . $result_view->description . '</p>
            <br /> Address :       ' . $result_view->address . '<br>City : ' . $result_view->city . '	<br>Phone :' . $result_view->phone . '
            	<br>Fax : ' . $result_view->fax . '	
         </td>
      </tr>
    </table>
    <table align="left" width="100%" border="0" cellspacing="5" cellpadding="5" class="sum-txt" style="margin-top:15px; font-size:15px; font-weight:bold; background-color:#bee7ff; border-radius:10px;">
      <tr>
         <td width="200" align="left">Room Details</td>
         <td  align="left">&nbsp;</td>
      </tr>
    </table>
     <table align="left" width="100%" border="0" cellspacing="0" cellpadding="5" class="sum-txt" style="margin-top:2px; font-size:15px; border:1px #bee7ff solid; border-radius:10px;">
      <tr>
         <td align="left">
         	<div style="width:700px; margin:0 auto;">
            	<div class="hotelfa-div" style="border:none">
            	<div style="width:150px; float:left;">Room Type : </div>
                <div style="width:550px; float:left" class="mid-txt">' . $result_view->room_type . '</div>
                </div>
            </div>
         </td>
      </tr>
    </table>
     <table align="left" width="100%" border="0" cellspacing="5" cellpadding="5" class="sum-txt" style="margin-top:15px; font-size:15px; font-weight:bold; background-color:#bee7ff; border-radius:10px;">
      <tr>
         <td width="200" align="left">Fare Summary</td>
         <td  align="left">&nbsp;</td>
      </tr>
    </table>
     <table align="left" width="100%" border="0" cellspacing="0" cellpadding="5" class="sum-txt" style="margin-top:2px; font-size:15px; border:1px #bee7ff solid; border-radius:10px;">
      <tr>
         <td align="left">
         	<div style="width:700px; margin:0 auto;">
            	<div class="hotelfa-div" style="border:none">
            	<div style="width:150px; float:left;">Total Room Price:  </div>
                <div style="width:550px; float:left" class="mid-txt">' . $trans->amount . ' USD</div>
                </div>
            </div>
         </td>
      </tr>
    </table>
    <table align="left" width="100%" border="0" cellspacing="5" cellpadding="5" class="sum-txt" style="margin-top:15px; font-size:15px; font-weight:bold; background-color:#bee7ff; border-radius:10px;">
      <tr>
         <td width="200" align="left">Cancellation Policy</td>
         <td  align="left">&nbsp;</td>
      </tr>
    </table>
     <table align="left" width="100%" border="0" cellspacing="0" cellpadding="5" class="sum-txt" style="margin-top:2px; font-size:15px; border:1px #bee7ff solid; border-radius:10px;">
      <tr>
         <td align="left">
         	<div style="width:700px; margin:0 auto;">
            	<div class="hotelfa-div" style="border:none">
            	<div style="float:left;">' . $result_view->cancel_policy . '</div>
                </div>
            </div>
         </td>
      </tr>
    </table>
     <table align="left" width="100%" border="0" cellspacing="5" cellpadding="5" class="sum-txt" style="margin-top:15px; font-size:15px; font-weight:bold; background-color:#bee7ff; border-radius:10px;">
      <tr>
         <td width="200" align="left">Passenger Details</td>
         <td  align="left">&nbsp;</td>
      </tr>
    </table>
     <table align="left" width="100%" border="0" cellspacing="0" cellpadding="5" class="sum-txt" style="margin-top:2px; font-size:15px; border:1px #bee7ff solid; border-radius:10px;">
      <tr>
         <td align="left">
         	<div style="width:700px; margin:0 auto;">
             ';
        for ($i = 0; $i < count($pass_info); $i++) {
            $msg .='	<div class="hotelfa-div" style="border:none">
            	<div style="width:690px; float:left;">Mr. ' . $pass_info[$i]->first_name . ' ' . $pass_info[$i]->last_name . '</div>
                </div>';
        }
        // '.$contact_info->last_name.'
        $msg .=' </div>
         </td>
      </tr>
    </table>
    <div style="float:left; margin-top:25px;">
    </div>
  </div>
  </div>
</div>
</body>
</html>
';
        $email_id = $contact_info->email;
        //$mail->mailtype = 'html';
        $this->load->library('email');
        $from = 'info@finalbooking.com';
        $sub = 'Hotel Booking Voucher';
        $this->email->from($from, 'FinalBooking');
        $to = strip_tags($email_id);
        $this->email->to($to);
        //$this->email->cc('prasanna@travelpd.com');
        $this->email->subject($sub);
        $this->email->message($msg);
        $this->email->send();
//        if (!$this->email->send()) {
//            show_error($this->email->print_debugger());
//        }
//echo '0123654789';
        //exit;
    }

    function voucher($val_last) {

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
        $this->load->view('hotel/ticket', $data);
//       
    }

    public function conformed_booking() {

        if ($this->session->userdata('agent_logged_in')) {
            //'Agent Id'. $this->session->userdata('agent_logged_in'); //exit;
            $data['agent_id'] = $agent_id = $this->session->userdata('agent_id');
            $data['agent_info'] = $agent_info = $this->Hotel_Model->getAgentInfo($agent_id);
            $agent_no = $agent_info->agent_no;
            $data['agent_available_balance'] = $this->Hotel_Model->get_agent_available_balance($agent_no);


            $data['hotel_booking_summary'] = $this->Hotel_Model->get_hotel_conformed_summary($agent_id);
            $data['Status'] = 'Confirmed History';
            //echo '<pre>';        print_r($data); exit;


            $this->load->view('hotel/booking_history', $data);
        } else {
            redirect('home/index', 'refresh');
        }
    }

    public function cancelled_booking() {

        if ($this->session->userdata('agent_logged_in')) {
            //'Agent Id'. $this->session->userdata('agent_logged_in'); //exit;
            $data['agent_id'] = $agent_id = $this->session->userdata('agent_id');
            $data['agent_info'] = $agent_info = $this->Hotel_Model->getAgentInfo($agent_id);
            $agent_no = $agent_info->agent_no;
            $data['agent_available_balance'] = $this->Hotel_Model->get_agent_available_balance($agent_no);

            $data['hotel_booking_summary'] = $this->Hotel_Model->get_hotel_cancelled_summary($agent_id);
            $data['Status'] = 'Cancelled History';
            //echo '<pre>';        print_r($data); exit;


            $this->load->view('hotel/booking_history_status', $data);
        } else {
            redirect('home/index', 'refresh');
        }
    }

    public function rejected_booking() {

        if ($this->session->userdata('agent_logged_in')) {
            //'Agent Id'. $this->session->userdata('agent_logged_in'); //exit;
            $data['agent_id'] = $agent_id = $this->session->userdata('agent_id');
            $data['agent_info'] = $agent_info = $this->Hotel_Model->getAgentInfo($agent_id);
            $agent_no = $agent_info->agent_no;
            $data['agent_available_balance'] = $this->Hotel_Model->get_agent_available_balance($agent_no);

            $data['hotel_booking_summary'] = $this->Hotel_Model->get_hotel_rejected_summary($agent_id);
            $data['Status'] = 'Failed History';
            //echo '<pre>';        print_r($data); exit;


            $this->load->view('hotel/booking_history_status', $data);
        } else {
            redirect('home/index', 'refresh');
        }
    }

    public function booking() {

        if ($this->session->userdata('agent_logged_in')) {
            //'Agent Id'. $this->session->userdata('agent_logged_in'); //exit;
            $data['agent_id'] = $agent_id = $this->session->userdata('agent_id');
            $data['agent_info'] = $agent_info = $this->Hotel_Model->getAgentInfo($agent_id);
            $agent_no = $agent_info->agent_no;

            $hotel_booking_summary = $this->Hotel_Model->get_hotel_booking_summary($agent_id);
            $data['hotel_booking_summary'] = $hotel_booking_summary;
            $data['Status'] = 'Booking History';
            //$data['agent_acc_summary'] = $this->Hotel_Model->getAgentAccountInfo($agent_id);
            $data['agent_balance_summary'] = $this->Hotel_Model->get_agent_account_balance($agent_id);

            $data['agent_available_balance'] = $this->Hotel_Model->get_agent_available_balance($agent_no);

            //echo '<pre>';        print_r($data); exit;


            $this->load->view('hotel/booking_history', $data);
        } else {
            redirect('home/index', 'refresh');
        }
    }

    public function deposit_history() {
        if (!$this->session->userdata('agent_logged_in'))
            redirect('home/index', 'refresh');
        $data['agent_id'] = $agent_id = $this->session->userdata('agent_id');
        $data['agent_info'] = $agent_info = $this->Hotel_Model->getAgentInfo($agent_id);
        $agent_no = $agent_info->agent_no;
        $data['agent_available_balance'] = $this->Hotel_Model->get_agent_available_balance($agent_no);
        $data['agent_deposit_summary'] = $this->Hotel_Model->get_agent_deposit_summary($agent_id);
//        echo '<pre>';
//        print_r($data);
//        exit;
        $data['agent_balance_summary'] = $this->Hotel_Model->get_agent_account_balance($agent_id);
        $this->load->view('hotel/view_deposit_summary', $data);
    }

    function add_deposit_request() {
        $this->form_validation->set_rules('amount', 'Amount', 'trim|required');
        $this->form_validation->set_rules('value_date', 'Date', 'trim|required');
        $this->form_validation->set_rules('transaction_mode', 'Transaction Mode', 'required');
        $this->form_validation->set_rules('branch', 'Branch', 'trim|required');
        $this->form_validation->set_rules('bank', 'Bank', 'trim|required');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('transaction_id', 'Transaction Id', 'trim|required');
        $this->form_validation->set_rules('remarks', 'Remarks', 'trim|required');

        $data['status'] = '';
        $data['errors'] = '';

        $data['agent_id'] = $agent_id = $this->input->post('agent_id');
        $data['agent_info'] = $this->Hotel_Model->getAgentInfo($agent_id);
        //$data['agent_acc_summary'] = $this->Hotel_Model->getAgentAccountInfo($agent_id);
        $data['agent_deposit_summary'] = $this->Hotel_Model->get_agent_deposit_summary($agent_id);

        if ($this->form_validation->run() == FALSE) {
            $data['amount'] = $this->input->post('amount');
            $data['value_date'] = $this->input->post('value_date');
            $data['bank'] = $this->input->post('bank');
            $data['branch'] = $this->input->post('branch');
            $data['city'] = $this->input->post('city');
            $data['transaction_id'] = $this->input->post('transaction_id');
            $data['remarks'] = $this->input->post('remarks');
            $this->load->view('hotel/view_deposit_summary', $data);
        } else {
            //echo '<pre/>';print_r($_POST);exit;	

            $amount = $this->input->post('amount');
            $value_date = $this->input->post('value_date');
            $transaction_mode = $this->input->post('transaction_mode');
            $bank = $this->input->post('bank');
            $branch = $this->input->post('branch');
            $city = $this->input->post('city');
            $transaction_id = $this->input->post('transaction_id');
            $remarks = $this->input->post('remarks');

            $agent_no = $data['agent_info']->agent_no;
            $available = $this->Hotel_Model->get_agent_available_balance($agent_id);


            $available_balance = $available->closing_balance;
            if ($available->closing_balance > 0) {
                $available_balance = $available->closing_balance;
            } else {
                $available_balance = 0;
            }

//            echo '<pre>';
//            print_r($available_balance);
//            exit;

            if ($this->Hotel_Model->add_deposit_request($agent_id, $agent_no, $amount, $value_date, $transaction_mode, $bank, $branch, $city, $transaction_id, $remarks, $available_balance)) {
                $data['status'] = 1;
            } else {
                $data['errors'] = 'Transaction is not done. Please try after some time...';
            }

            redirect('hotel/deposit_history', 'refresh');
        }
    }

    function add_markup() {
        $this->form_validation->set_rules('service_type', 'Service Type', 'required');
        $this->form_validation->set_rules('markup', 'Markup', 'trim|required|integer');

        $data['status'] = '';
        $data['errors'] = '';

        $data['agent_no'] = $agent_no = $this->input->post('agent_no');

        $data['agent_markup_manager'] = $this->Hotel_Model->get_agent_markup_manager($agent_no);

        if ($this->form_validation->run() == FALSE) {
            $data['markup'] = $this->input->post('markup');

            $this->load->view('hotel/view_deposit_summary', $data);
        } else {
            //echo '<pre/>';print_r($_POST);exit;	

            $service_type = $this->input->post('service_type');
            $markup = $this->input->post('markup');

            if ($this->Hotel_Model->add_markup($agent_no, $service_type, $markup)) {
                $data['status'] = 1;
            } else {
                $data['errors'] = 'Markup is not added. Please try after some time...';
            }

            redirect('hotel/markup_manager', 'refresh');
        }
    }

    public function markup_manager() {
        if (!$this->session->userdata('agent_logged_in'))
            redirect('hotel/index', 'refresh');

        $data['agent_no'] = $agent_no = $this->session->userdata('agent_no');

        $data['agent_markup_manager'] = $this->Hotel_Model->get_agent_markup_manager($agent_no);

        $this->load->view('hotel/view_markup_manager', $data);
    }

    function markup_status($markup_id, $status) {
        $this->Hotel_Model->update_markup_status($markup_id, $status);
        redirect('hotel/markup_manager', 'refresh');
    }

    function cancel_booking($id) {
        $data['agent_id'] = $agent_id = $this->session->userdata('agent_id');
        $data['agent_balance_summary'] = $this->Hotel_Model->get_agent_account_balance($agent_id);
        $data['agent_id'] = $agent_id = $this->session->userdata('agent_id');
        $data['agent_info'] = $agent_info = $this->Hotel_Model->getAgentInfo($agent_id);
        $agent_no = $agent_info->agent_no;
        $data['agent_available_balance'] = $this->Hotel_Model->get_agent_available_balance($agent_no);

        $hotel_booking_summary = $this->Hotel_Model->get_hotel_booking_summary($agent_id);
        $data['hotel_booking_summary'] = $hotel_booking_summary;

        $data['result_view'] = $this->Hotel_Model->view_trans_detail_id($id);
        //echo '<pre>';        print_r($data); exit;

        $this->load->view('hotel/cancel_booking', $data);
    }

    function cancel_booking_final__($id) {
        $result_view = $this->Hotel_model->view_trans_detail_id_new2($id);
        $h_id = $result_view->hotel_booking_id;
        $view = $this->Hotel_model->book_detail_view_voucher1($h_id);

        $api = $view->api;
        $pnr = $result_view->prn_no;
        $booking_number = $result_view->booking_number;
        if ($api == 'hotelspro') {

            $client = new SoapClient($this->URL, array('trace' => 1));

            $trackingId = explode("||", $booking_number);
            try {
                $cancelHotelBooking = $client->cancelHotelBooking($this->Api_Key, $trackingId[1]);
            } catch (SoapFault $exception) {
                echo $exception->getMessage();
              //  exit;
            }

            if ($cancelHotelBooking->bookingStatus != '') {
                $data = array(
                    'status' => $cancelHotelBooking->bookingStatus
                );

                $where = "booking_number = '$booking_number'";

                $this->db->update('transaction_details', $data, $where);
                $data['exits'] = 'Cancellation process successfully completed.';
            } else {
                $data['exits'] = 'Cancellation process not completed.';
            }
            $this->load->view("cancellaion_end", $data);
        }
    }

    function cancel_booking_final($id) {
        $result_view = $this->Hotel_Model->view_trans_detail_id($id);
        $h_id = $result_view->hotel_booking_id;
        $view = $this->Hotel_Model->book_detail_view_voucher1($h_id);

        $api = $view->api;
        //echo $api; exit;
        $pnr = $result_view->prn_no;
        $booking_number = $result_view->booking_number;
        $status_db = $result_view->status;

//	echo '<pre/>';
//	print_r($result_view);exit;

        if ($api == 'hotelspro') {

            $client = new SoapClient($this->URL, array('trace' => 1));
            $trackingId = explode("||", $booking_number);
            try {
                $cancelHotelBooking = $client->cancelHotelBooking($this->Api_Key, $trackingId[1]);
            } catch (SoapFault $exception) {
                echo $exception->getMessage();
                exit;
            }

            if ($cancelHotelBooking->bookingStatus != '') {
                $data = array(
                    'status' => $cancelHotelBooking->bookingStatus
                );

                $where = "booking_number = '$booking_number'";

                $this->db->update('transaction_details', $data, $where);
                $data['exits'] = 'Cancellation process successfully completed.';
            } else {
                $data['exits'] = 'Cancellation process not completed.';
            }
            $this->load->view("hotel/cancellaion_end", $data);
        }
    }

}

