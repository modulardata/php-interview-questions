<?php

ini_set("max_execution_time", 0);
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
error_reporting(0);

//session_start();

class Hotel extends CI_Controller {

    //private $rURL;
            private $client, $xml;
    private $rURL, $ragencyID, $ruserID, $rpassword, $rversion, $rcurrency;
    private $arURL, $aruserID, $arpassword;
    private $jsearchURL, $jkey, $jpriceURL, $jbooking;
    private $sess_id;

    /*     * ***** START SET VARIABLES ********* */
    private $city_name;
    private $city_code;
    private $cin;
    private $cout;
    private $rooms;
    private $nights;
    private $adults;
    private $childs;
    private $adults_count;
    private $childs_count;
    private $childs_ages;

    /*     * ***** END SET VARIABLES ********* */

    public function __construct() {
        parent::__construct();
        $this->load->model('Hotel_Model');
        $this->load->model('Home_Model');
        $this->load->model('Roomsxml_Model');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->database();

        // ROOMSXML API CREDENTIALS
//        $this->rURL = "http://roomsxmldemo.com/RXLStagingServices/ASMX/XmlService.asmx";
//        $this->ragencyID = "uttpl";
//        $this->ruserID = "xmltest";
//        $this->rpassword = "xmltest";
//        $this->rversion = "1.25";
//        $this->rcurrency = "USD";
//      
        $this->rURL = "http://www.roomsxml.com/RXLServices/ASMX/XmlService.asmx. ";
        $this->ragencyID = "SRGROUPS";
        $this->ruserID = "XML";
        $this->rpassword = "srxml123";
        $this->rversion = "1.25";
        $this->rcurrency = "INR";
        // ROOMSXML API CREDENTIALS
        //
        //ACE ROOMS API CREDENTIALS
        $this->arURL = "http://www.acerooms.com/AceHotel/AceHotelService.asmx";
        $this->aruserID = "deb44996";
        $this->arpassword = "31f4ec76fb27";
        //ACE ROOMS API CREDENTIALS
        //
        // JAC CREDENTIALS
        $this->jsearchURL = "http://5.32.152.151/ServiceSearch.asp";
        $this->jpriceURL = "http://5.32.152.151/AvailabilityAndPrices.asp";
        $this->jbooking = "http://5.32.152.150/Booking.asp";
        $this->jkey = "95048392-1314-4435-8404-EC1E3599E792";
        //JAC CREDENTIALS
        //TRAVELGURU CREDENTIALS
        //
        $this->URL = "http://stage-api.travelguru.com/services-2.0/tg-services/TGServiceEndPoint";
        $this->URLbooking = "http://stage-api.travelguru.com/services-2.0/tg-services/TGBookingServiceEndPoint";
        $this->soapAction = "http://stage-api.travelguru.com/services-2.0/tg-services/TGServiceEndPoint?wsdl";
        //$this->soapActionbooking = "http://stage-api.travelguru.com/services-2.0/tg-services/TGBookingServiceEndPoint";
        $this->username = "testnet";
        $this->password = "test";
        $this->propertyid = "1300000141";



        $this->load->library('session');
        if ($this->session->userdata('session_id') == '') {
            redirect('hotel/index', 'refresh');
        }

        $this->sess_id = $this->session->userdata('session_id');
    }

    public function index() {
        $this->load->view('home/index');
    }

    public function backtosearch() {

        $data['$api_name_h'] = $this->session->userdata('api_name_h');
        $this->load->view('b2c/hotel/search_progress', $data);
    }

    function error_page($error) {
        $error = base64_decode($error);
        $data['error'] = $error;
        $this->load->view('home/error_page', $data);
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
            //echo '<pre>';print_r($_POST);exit;

            $adultvalue = $this->input->post('adult');
            $childvalue = $this->input->post('child');
            //$childage = $this->input->post('child_age');
            $room_count = $this->input->post('room_count');

            $city = $this->input->post('City');
            $checkin = $this->input->post('checkin');
            $checkout = $this->input->post('checkout');
            $nationality = $this->input->post('nationality');

            $adultList = array_slice($this->input->post('adult'), 0, $this->input->post('room_count'));
            $childList = array_slice($this->input->post('child'), 0, $this->input->post('room_count'));

            $adults_count = array_sum($adultList);
            $childs_count = array_sum($childList);

            $noofnights = $this->Hotel_Model->calculatedateDiff1($checkin, $checkout);


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
                // creating the single and double depending upon the room counts

                $sess_array = array(
                    'city' => $city,
                    'checkin' => $checkin,
                    'checkout' => $checkout,
                    'adultvalue' => $adultvalue,
                    'childvalue' => $childvalue,
                    'room_count' => $room_count,
                    'noofnights' => $noofnights,
                    'adult_count' => $adults_count,
                    'child_count' => $childs_count,
                    'nationality' => $nationality
                );

                $this->session->set_userdata('hotel_search_data', $sess_array);
                $api_name_h = 'roomsxml';
                //$api_name_h = 'jac';
                // $api_name_h = 'acerooms';
                $data['api_name_h'] = $api_name_h;
                $this->session->set_userdata('api_name_h', $api_name_h);
                $this->load->view('b2c/hotel/search_progress', $data);
            }
        }
    }

    function search_progress() { //echo 'asdsds';exit;
        //echo '<pre>';print_r($_POST);print_r($this->session->userdata);exit;
        if ($this->session->userdata('flight_search_activate') != 1) {
            if (isset($_POST) && $_POST['api_name'] != '') {
                $api = $_POST['api_name'];

                switch ($api) {

                    case 'roomsxml':
                        $this->roomsxml_search_availablility();
                        break;
                    case 'acerooms':
                        $this->ace_rooms_search_availablility();
                        break;
                    case 'jac':
                        $this->jac_hotel_availabilty();
                        break;
                    case 'travelguru':
                        $this->travelguru_hotel_availabilty();
                        break;

                    default:
                        break;
                }
            }
        }
//echo 'success';//exit;

        $r_roomsxml = array();
        $r_acerooms = array();
        if ($_POST['api_name'] == 'roomsxml' || $_POST['api_name'] == 'jac') {


            $r_roomsxml = $this->Hotel_Model->fetch_hotel_result($this->sess_id);
        }
        if ($_POST['api_name'] == 'acerooms') {
            $r_acerooms = $this->Acerooms_Model->fetch_ace_hotel_result($this->sess_id);
        }
        $data['nationality'] = $this->Home_Model->get_nationality();
        $data['result'] = array_merge($r_roomsxml, $r_acerooms);
        //echo '<pre>';            print_r($data); exit;
        $this->load->view('b2c/hotel/search_result', $data);
    }

    //
    function hotel_detail($hotel_id) {
        $data['hotel_detail'] = $hotel_detail = $this->Hotel_Model->hotel_detail($hotel_id);

        $data['session'] = $hotel_detail->session_id;


        $data['hotel_detail_room'] = $this->Hotel_Model->hotel_getrooms($data['hotel_detail']->hotel_code, $data['hotel_detail']->session_id);

        $data['hotel_detail'] = $hotel_detail;

        $data['hotel_name'] = $hotel_detail->hotel_name;
        $data['lat'] = $hotel_detail->latitude;
        $data['long'] = $hotel_detail->longitude;
        $data['dest'] = $hotel_detail->city;



        if ($data['lat'] != '' && $data['long'] != '') {
            $data['nearby_hotel'] = $this->Hotel_Model->get_nearby_hotels($data['lat'], $data['long'], $data['hotel_name'], $data['dest'], $data['session']);
        } else {
            $data['nearby_hotel'] = '';
        }
        $this->load->library('googlemaps');
        $config['center'] = $hotel_detail->latitude . ',' . $hotel_detail->longitude;




        $config['zoom'] = 11;
        $this->googlemaps->initialize($config);

        $marker = array();
        $marker['position'] = $hotel_detail->latitude . ',' . $hotel_detail->longitude;
        $this->googlemaps->add_marker($marker);

        $data['map'] = $this->googlemaps->create_map();
//        echo '<pre>';
//        print_r($data);
//        exit;
        // this is for the specific api to get ther details respectively
        if ($data['hotel_detail']->api == 'acerooms') {
            $data['details'] = $this->get_acerooms_detail($data['hotel_detail']->hotel_code);
            $this->load->view('b2c/hotel/acerooms/hotel_detail', $data);
        } elseif ($data['hotel_detail']->api == 'roomsxml') {
            //echo '<pre>';            print_r($data); exit;
            $this->load->view('b2c/hotel/roomsxml/hotel_detail', $data);
        } elseif ($data['hotel_detail']->api == 'jac') {
            $data['rooms'] = $this->jac_pricing($data['hotel_detail']);
            $data['details'] = $this->get_jac_detail($data['hotel_detail']->hotel_code);
            $this->load->view('b2c/hotel/jac/hotel_detail', $data);
        }
    }

    function payfailed() {

        $error = $data['Payment'] = 'Payment Failed';
        $error = base64_encode($error);
        $data['error'] = $error;
        $this->load->view('home/error_page', $data);
    }

    function itenarary($searchid, $hotelcode, $optionid = '') {
        $data['hotel_detail'] = $this->Hotel_Model->hotel_itenarary($searchid, $hotelcode);
        // echo '<pre>';print_r($data['hotel_detail']);exit;
        //this is for the particular api to perform
        if ($data['hotel_detail']->api == 'acerooms') {
            $bookd = array('tokenid' => $data['hotel_detail']->searchtokenid, 'hotelcode' => $data['hotel_detail']->hotel_code, 'roomno' => $data['hotel_detail']->roomno, 'roomid' => $data['hotel_detail']->room_code, 'contractid' => $data['hotel_detail']->contractID, 'searchid' => $searchid);
            $this->aceroom_selectroom($bookd);
            $data['details'] = $this->get_acerooms_detail($data['hotel_detail']->hotel_code);
            $data['hotel_detail'] = $this->Hotel_Model->hotel_itenarary($searchid, $hotelcode);

            $this->load->view('b2c/hotel/acerooms/hotel_itenarary', $data);
        } elseif ($data['hotel_detail']->api == 'roomsxml') {
            // $this->roomsxmlbookcreate($data['hotel_detail']);
            $data['details'] = $this->Hotel_Model->gethotel_detail($data['hotel_detail']->hotel_code);
            $this->load->view('b2c/hotel/roomsxml/hotel_itenarary', $data);
        } elseif ($data['hotel_detail']->api == 'jac') {
            $data['details'] = $this->get_jac_detail($data['hotel_detail']->hotel_code);
            $this->load->view('b2c/hotel/jac/hotel_itenarary', $data);
        }
    }

    function reservation() {
//echo $this->input->post('booking_id');exit;
        if ($this->input->post('booking_id') == '') {

            $error = 'Some thing went wrong, please try again';
            redirect('hotel/error_page/' . base64_encode($error));
        } else {
            $this->session->set_userdata('passenger_info', $_POST);
            if ($_POST['api'] == 'acerooms') {
                $this->ace_reservation($this->input->post('hotel_code'));
            } elseif ($_POST['api'] == 'roomsxml') {
                $preparebooking = $this->roomsxmlbookcreate('prepare');
//echo '<pre>';print_r($preparebooking);//exit;
                $dom2 = new DOMDocument();
                $dom2->loadXML($preparebooking);
                $HotelBooking = $dom2->getElementsByTagName("HotelBooking");
                $cancelCurrency = $dom2->getElementsByTagName('Currency')->item(0)->nodeValue;
                $tot = 0;
                foreach ($HotelBooking as $val) {
                    $Amount = $val->getElementsByTagName("TotalSellingPrice")->item(0)->getAttribute('amt');
//                    foreach ($TotalSellingPrice as $val3) {
//                        $Amount = $val3->item(0)->getAttribute('amt');
//                        break;
//                    }
                    //  $Amount = $TotalSellingPrice->item(0)->getElementsByTagName('Amount')->item(0)->nodeValue;
                    $tot = $tot + $Amount;
                    $policy = '';
                    $CanxFees = $val->getElementsByTagName("CanxFees");
                    foreach ($CanxFees as $val1) {
                        $Fee = $val1->getElementsByTagName("Fee");
                        foreach ($Fee as $val2) {
                            $cancelStartDate = $val2->getAttribute('from');
                            $cancelAmount = $val2->getElementsByTagName('Amount')->item(0)->getAttribute('amt');

//                            $cancelStartDate = $val2->getElementsByTagName('StartDate')->item(0)->nodeValue;
//                            $amnt = $val2->getElementsByTagName('Amount');
//                            $cancelAmount = $amnt->item(0)->getElementsByTagName('Amount')->item(0)->nodeValue;
//                            $cancelCurrency = $amnt->item(0)->getElementsByTagName('Currency')->item(0)->nodeValue;

                            $policy.= 'The cancellation made after ' . $cancelStartDate . ' the cancellation charge would be ' . $cancelCurrency . ' ' . $cancelAmount . '<br>';
                        }
                    }
                }
//echo $this->input->post('net_amnt').'<br>';
//echo $tot;
                if ($tot == $this->input->post('net_amnt')) {
                    $data['hotel_detail'] = $this->Hotel_Model->hotel_itenarary($this->input->post('search_id'), $this->input->post('hotel_code'));
                    $data['details'] = $this->Hotel_Model->gethotel_detail($this->input->post('hotel_code'));
                    $data['cancelpolicy'] = $policy;
                    //echo '<pre>';                    print_r($data); exit;

                    $this->load->view('b2c/hotel/roomsxml/reservationcheck', $data);
                } else {

                    $error = 'Price as been changed, please search again';
                    redirect('hotel/error_page/' . base64_encode($error));
                }
            } elseif ($_POST['api'] == 'jac') {
                $preparebooking = $this->jac_booking();
                exit;
                if ($tot == $this->input->post('net_amnt')) {
                    $data['hotel_detail'] = $this->Hotel_Model->hotel_itenarary($this->input->post('search_id'), $this->input->post('hotel_code'));
                    $data['details'] = $this->Hotel_Model->gethotel_detail($this->input->post('hotel_code'));
                    $data['cancelpolicy'] = $policy;

                    $this->load->view('b2c/hotel/roomsxml/reservationcheck', $data);
                } else {
                    $error = 'Price as been changed, please search again';
                    redirect('hotel/error_page/' . base64_encode($error));
                }
            }
        }
    }

    public function voucher() {
        if (isset($_GET['voucherId'])) {
            $sysRefNo = $_GET['voucherId'];
            $bookRefNo = $_GET['Booking_RefNo'];
            $data['voucherId'] = $sysRefNo;
            $data['hotel_booking_info'] = $this->Roomsxml_Model->get_hotel_booking_information($sysRefNo, $bookRefNo);
            $data['passenger_info'] = $this->Roomsxml_Model->get_hotel_booking_passenger_info($sysRefNo);
            // echo '<pre/>';print_r($data);exit;
            $this->load->view('b2c/hotel/voucher', $data);
        } else {
            echo 'Permission Denied';
        }
    }

    public function voucher_print($sysRefNo, $bookRefNo) {
        $data['hotel_booking_info'] = $this->Roomsxml_Model->get_hotel_booking_information($sysRefNo, $bookRefNo);
        $data['passenger_info'] = $this->Roomsxml_Model->get_hotel_booking_passenger_info($sysRefNo);
        $this->load->view('b2c/hotel/voucher', $data);
    }

    //************PLEASE DO NOT MODIFY ANY CODE ROOMSXML API INTEGRATION STARTS HERE****************************************************
    function roomsxml_search_availablility() {
        //echo '<pre>';print_r($this->session->all_userdata());//exit;
        $hotel_search_data = $this->session->userdata('hotel_search_data');
        $city = explode(',', $hotel_search_data['city']);
        $city_data = $this->Hotel_Model->get_roomscity_code($city['0']);
        $city_code = $city_data->city_id;

        $checkins = explode('/', $hotel_search_data['checkin']);
        $checkin = $checkins['2'] . '-' . $checkins['1'] . '-' . $checkins['0'];
        $noofnights = $hotel_search_data['noofnights'];
        $room_count = $hotel_search_data['room_count'];
        $adult_value = $hotel_search_data['adultvalue'];
        $child_value = $hotel_search_data['childvalue'];
        $adult_count = $hotel_search_data['adult_count'];
        $child_count = $hotel_search_data['child_count'];

        // calculating rooms
        $rooms_data = '';

        for ($r = 0; $r < $room_count; $r++) {
            $rooms_data.= '<Room>';
            //adult
            $rooms_data.= '<Guests>';
            for ($a = 0; $a < $adult_value[$r]; $a++) {
                $rooms_data.='<Adult/>';
            }
            //child
            for ($c = 0; $c < $child_value[$r]; $c++) {
                $rooms_data.='<Child age="5"/>';
            }
            $rooms_data.='</Guests ></Room> ';
        }


        //calculating rooms
        $xml_data = '           
           <AvailabilitySearch> 
    <Authority xmlns="http://www.reservwire.com/namespace/WebServices/Xml"> 
    <Org>' . $this->ragencyID . '</Org> 
    <User>' . $this->ruserID . '</User> 
    <Password>' . $this->rpassword . '</Password> 
    <Currency>' . $this->rcurrency . '</Currency> 
    <Version>' . $this->rversion . '</Version> 
    </Authority> 
    <RegionId>' . $city_code . '</RegionId> 
    <HotelStayDetails> 
    <ArrivalDate>' . $checkin . '</ArrivalDate> 
    <Nights>' . $noofnights . '</Nights> 
        ' . $rooms_data . '
    
<Nationality>' . $hotel_search_data["nationality"] . '</Nationality>   
    </HotelStayDetails> 
    <DetailLevel>basic</DetailLevel>
    </AvailabilitySearch> 
';
        // echo $xml_data;//exit;
        $availability_resp = $this->PostRQ($xml_data);
//        echo '<pre>';
//        print_r($availability_resp);
//        exit;
        $dom2 = new DOMDocument();
        $dom2->loadXML($availability_resp);
        $HotelAvailability = $dom2->getElementsByTagName("HotelAvailability");
        $price_Currency = $dom2->getElementsByTagName("Currency")->item(0)->nodeValue;
        $ro = 0;
        foreach ($HotelAvailability as $val) {

            //---------------------- THE BELOW CODE API VERSION 1.25----------------------
            $hotel_Id = $val->getElementsByTagName("Hotel")->item(0)->getAttribute('id');
            $hotel_Name = $val->getElementsByTagName("Hotel")->item(0)->getAttribute('name');
            $Result = $val->getElementsByTagName("Result");
            foreach ($Result as $val2) {
                $result_QuoteId = $val2->getAttribute('id');
                $result_Room = $val2->getElementsByTagName("Room");
                foreach ($result_Room as $val3) {
                    $roomtype_Code = $val3->getElementsByTagName("RoomType")->item(0)->getAttribute('code');
                    $roomtype_Text = $val3->getElementsByTagName("RoomType")->item(0)->getAttribute('text');
                    $mealtype_Text = '';
                    if ($val3->getElementsByTagName("MealType")->length != 0) {
                        $mealtype_Code = $val3->getElementsByTagName("MealType")->item(0)->getAttribute('code');
                        $mealtype_Text = $val3->getElementsByTagName("MealType")->item(0)->getAttribute('text');
                    }
                    $room_Confirmation = 'allocation';
                    $price_Amount = $val3->getElementsByTagName("Price")->item(0)->getAttribute('amt');
                }
                //---------------------- THE ABOVE CODE API VERSION 1.25----------------------
                // ------------------THE BELOW CODE IS FOR API VER 1.26------------
                /*          $Hotel = $val->getElementsByTagName("Hotel");
                  foreach ($Hotel as $val1) {
                  $hotel_Id = $val1->getElementsByTagName('Id')->item(0)->nodeValue;
                  $hotel_Name = $val1->getElementsByTagName('Name')->item(0)->nodeValue;
                  $hotel_Type = $val1->getElementsByTagName('Type')->item(0)->nodeValue;
                  $hotel_Stars = $val1->getElementsByTagName('Stars')->item(0)->nodeValue;
                  $hotel_Rank = $val1->getElementsByTagName('Rank')->item(0)->nodeValue;
                  }
                  $Result = $val->getElementsByTagName("Result");
                  foreach ($Result as $val2) {
                  $result_QuoteId = $val2->getElementsByTagName('QuoteId')->item(0)->nodeValue;

                  $result_Room = $val2->getElementsByTagName("Room");
                  foreach ($result_Room as $val3) {
                  $room_RoomType = $val3->getElementsByTagName("RoomType");
                  foreach ($room_RoomType as $val4) {
                  $roomtype_Code = $val4->getElementsByTagName('Code')->item(0)->nodeValue;
                  $roomtype_Text = $val4->getElementsByTagName('Text')->item(0)->nodeValue;
                  }
                  $room_SellingPrice = $val3->getElementsByTagName("SellingPrice");
                  foreach ($room_SellingPrice as $val5) {
                  $price_Currency = $val5->getElementsByTagName('Currency')->item(0)->nodeValue;
                  $price_Amount = $val5->getElementsByTagName('Amount')->item(0)->nodeValue;
                  break;
                  }
                  $mealtype_Text = '';
                  if ($val3->getElementsByTagName("MealType")) {
                  $room_MealType = $val3->getElementsByTagName("MealType");
                  foreach ($room_MealType as $val6) {
                  $mealtype_Code = $val6->getElementsByTagName('Code')->item(0)->nodeValue;
                  $mealtype_Text = $val6->getElementsByTagName('Text')->item(0)->nodeValue;
                  }
                  }
                  $room_Confirmation = $val3->getElementsByTagName('Confirmation')->item(0)->nodeValue;
                  } */
                // ------------------THE ABOVE CODE IS FOR API VER 1.26------------
                //-----extracting data from the xml file and inserting in to api permanent table

                $price_Amount1 = $price_Amount * $room_count;
//exit;
                //-----extracting data from the xml file and inserting in to api permanent table 
                // calculating price
                /////////////////////////////////////////////// A   D   D   I   N   G   M   A   R   K   U   P   P   R   I   C   E   /////////////////////
                $admin_markup = '0';
                $agent_markup = '0';
                //   $total_amount = '0';
                //echo '<pre>';            print_r($agent_no); exit;
                $b2c_markup = $this->Hotel_Model->get_b2c_markup();
                $admin_markup_val = $b2c_markup->markup;
                // $agent_markup_val = $this->Hotel_Model->get_agent_markup($agent_no);
                //echo '<pre>';            print_r($agent_markup_val->markup); exit;


                $payment_charge_val = $this->Hotel_Model->get_b2c_paymentcharge();
                $admin_markup = round(($price_Amount1 * ($admin_markup_val / 100)), 2);
                $payment_charge = round((($price_Amount1 + $admin_markup) * ($payment_charge_val / 100)), 2);
                $total_amount = round(($price_Amount1 + $admin_markup + $payment_charge), 0);

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                $insertrooms[$ro] = array(
                    'session_id' => $this->sess_id,
                    'api' => 'roomsxml',
                    'hotel_code' => $hotel_Id,
                    'room_code' => $roomtype_Code,
                    'room_type' => $roomtype_Text,
                    'quote_id' => $result_QuoteId,
                    'inclusion' => $mealtype_Text,
                    'agent_markup' => $agent_markup,
                    'admin_markup' => $admin_markup,
                    'net_cost' => $price_Amount1,
                    'total_cost' => $total_amount,
                    'status' => $room_Confirmation,
                    'adult' => $adult_count,
                    'child' => $child_count,
                    'room_count' => $room_count,
                    'markup' => '',
                    'org_amt' => $price_Amount,
                    'xml_currency' => $price_Currency,
                    'currency_val' => $price_Amount,
                    'payment_charge' => $payment_charge,
                    'city' => $city['0'],
                    'cancel_policy' => ''
                );
                $ro++;
            }
            $check = $this->Roomsxml_Model->check_permanent($hotel_Id); //exit;
            if ($check != '1') {
                $RoomsStatic_data = '';
                $RoomsStatic_data = file_get_contents("RoomsHotelDetailXml/" . $hotel_Id . ".xml");
                // echo '<pre>';print_r($RoomsStatic_data);
                if ($RoomsStatic_data != '') {
                    $dom3 = new DOMDocument();
                    $dom3->loadXML($RoomsStatic_data);
                    $sHotelElement = $dom3->getElementsByTagName("HotelElement");
                    foreach ($sHotelElement as $val_1) {
                        // echo 'sdfdsfdf';exit;
                        $shotel_Id = $val_1->getElementsByTagName('Id')->item(0)->nodeValue;
                        if ($shotel_Id == $hotel_Id) {
                            $sName = $val_1->getElementsByTagName('Name')->item(0)->nodeValue;
                            $sType = $val_1->getElementsByTagName('Type')->item(0)->nodeValue;

                            $sAddress = $val_1->getElementsByTagName("Address");
                            foreach ($sAddress as $val_2) {
                                $sAddress1 = $val_2->getElementsByTagName('Address1')->item(0)->nodeValue;
                                $sCity = $val_2->getElementsByTagName('City')->item(0)->nodeValue;
                                $sCountry = $val_2->getElementsByTagName('Country')->item(0)->nodeValue;
                                $sTel = $val_2->getElementsByTagName('Tel')->item(0)->nodeValue;
                                $sFax = $val_2->getElementsByTagName('Fax')->item(0)->nodeValue;
                            }

                            $sStars = $val_1->getElementsByTagName('Stars')->item(0)->nodeValue;
                            $sGeneralInfo = $val_1->getElementsByTagName("GeneralInfo");
                            foreach ($sGeneralInfo as $val_3) {
                                $sLatitude = $val_3->getElementsByTagName('Latitude')->item(0)->nodeValue;
                                $sLongitude = $val_3->getElementsByTagName('Longitude')->item(0)->nodeValue;
                            }

                            $sPhoto = $val_1->getElementsByTagName("Photo");
                            foreach ($sPhoto as $val_4) {
                                $sPhotoType = $val_4->getElementsByTagName('PhotoType')->item(0)->nodeValue;
                                if ($sPhotoType == 'ExternalViewOfTheHotel') {
                                    $sThumbnailUrl = $val_4->getElementsByTagName('Url')->item(0)->nodeValue;
                                }
                            }
                            $sDescription = $val_1->getElementsByTagName("Description");
                            foreach ($sDescription as $val_5) {
                                $sdType = $val_5->getElementsByTagName('Type')->item(0)->nodeValue;
                                if ($sdType == 'General') {
                                    $sdText = $val_5->getElementsByTagName('Text')->item(0)->nodeValue;
                                }
                                break;
                            }
                            $this->Roomsxml_Model->insert_permanent($shotel_Id, $sName, $sCity, $sStars, $sThumbnailUrl, $sdText, $sAddress1, $sLatitude, $sLongitude, $sTel, $sFax);
                        }
                    }
                }
            }
        }

        $this->Roomsxml_Model->delete_temp_result($this->sess_id);
        if (!empty($insertrooms)) {
            $this->Roomsxml_Model->insert_roomsxml_data($insertrooms);
        }
    }

    // 	
    public function PostRQ($post_xml) {

//echo $xml_data;exit;
        $ch2 = curl_init();
        curl_setopt($ch2, CURLOPT_URL, $this->rURL);
        curl_setopt($ch2, CURLOPT_TIMEOUT, 0);
        curl_setopt($ch2, CURLOPT_HEADER, 0);
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch2, CURLOPT_POST, 1);
        curl_setopt($ch2, CURLOPT_POSTFIELDS, $post_xml);
        curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch2, CURLOPT_SSLVERSION, 3);
//curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, true);

        $httpHeader2 = array("Content-Type: text/xml; charset=UTF-8", "Content-Encoding: UTF-8");
        curl_setopt($ch2, CURLOPT_HTTPHEADER, $httpHeader2);
        curl_setopt($ch2, CURLOPT_ENCODING, "gzip");

// Execut	e request, store response and HTTP response code
        $curlresp = curl_exec($ch2);
        $error2 = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
        curl_close($ch2);
        return $curlresp;
    }

    function roomsxmlbookcreate($commit) {

        $hotel_search_data = $this->session->userdata('hotel_search_data');
        $pass_info = $this->session->userdata('passenger_info');

        // echo '<pre>';print_r($hotel_search_data);print_r($pass_info);exit;
        $checkins = explode('/', $hotel_search_data['checkin']);
        $checkin = $checkins['2'] . '-' . $checkins['1'] . '-' . $checkins['0'];
        $nights = $hotel_search_data['noofnights'];

        // calculating rooms
        $rooms_data = '';

        for ($r = 0; $r < $hotel_search_data['room_count']; $r++) {
            $rooms_data.= '<Room>';
            //adult
            $rooms_data.= '<Guests>';
            for ($a = 0; $a < $hotel_search_data['adultvalue'][$r]; $a++) {
                $rooms_data.='
  <Adult title="' . $pass_info['adults_title'][$a] . '" first="' . $pass_info['adults_fname'][$a] . '" last="' . $pass_info['adults_lname'][$a] . '" />                    
   ';
            }
            //child
            for ($c = 0; $c < $hotel_search_data['childvalue'][$r]; $c++) {
                $rooms_data.='
                    <Child title="' . $pass_info['childs_title'][$c] . '" first="' . $pass_info['childs_fname'][$c] . '" last="' . $pass_info['childs_lname'][$c] . '" age="5" />                     
      
                    ';
            }
            $rooms_data.='</Guests ></Room> ';
        }



        $book_create = '
<BookingCreate>
<Authority >  
<Org>' . $this->ragencyID . '</Org> 
<User>' . $this->ruserID . '</User> 
<Password>' . $this->rpassword . '</Password> 
<Currency>' . $this->rcurrency . '</Currency>
<TestDebug>false</TestDebug>
<Version>' . $this->rversion . '</Version>
</Authority>
<QuoteId>' . $pass_info["booking_id"] . '</QuoteId>
<HotelStayDetails>
' . $rooms_data . '
</HotelStayDetails>
<CommitLevel>' . $commit . '</CommitLevel>
</BookingCreate>            
';

        //  echo $book_create; //exit;
        $book_resp = $this->PostRQ($book_create);
        //echo '<pre>';print_r($book_resp);exit;
        return $book_resp;
    }

    function load_payment() {
        $this->load->view('payment_load_demo');
    }

    function passenger_details() {
        $hotel_search_data = $this->session->userdata('hotel_search_data');
        $city = $hotel_search_data['city'];
        $checkin = $hotel_search_data['checkin'];
        $checkout = $hotel_search_data['checkout'];
        $room_count = $hotel_search_data['room_count'];
        $noofnights = $hotel_search_data['noofnights'];
        $adult_count = $hotel_search_data['adult_count'];
        $child_count = $hotel_search_data['child_count'];
        $pass = $this->session->userdata('final_book_info');
        $hotel_name = $pass['hotel_name'];
        $address = $pass['address'];
        $email = $pass['userEmailId'];
        $mobile = $pass['userMobilNo'];
        $atitle = $pass['adults_title'][0];
        $afname = $pass['adults_fname'][0];
        $alname = $pass['adults_lname'][0];
        $msgbody.= '
            <div>
    <div>
        <h2>Hotel Search Details</h2>
        <table>
            <tr>
                <td>Hotel Name</td>
                <td>' . $hotel_name . '</td>
            </tr>
            <tr>
                <td>Hotel Address</td>
                <td>' . $address . '</td>
            </tr>
            <tr>
                <td>City</td>
                <td>' . $city . '</td>
            </tr>
            <tr>
                <td>Check in</td>
                <td>' . $checkin . '</td>
            </tr>
            <tr>
                <td>Check Ou</td>
                <td>' . $checkout . '</td>
            </tr>
            <tr>
                <td>Passengers</td>
                <td>Adults: ' . $adult_count . ' Childs: ' . $child_count . '</td>
            </tr>
            <tr>
                <td>No of Rooms</td>
                <td>Roooms: ' . $room_count . ' for ' . $noofnights . ' Nights </td>
            </tr>
        </table>
    </div>
    <div>
        <h2>Passenger Details</h2>
        <table>
            <tr>
                <td>Name</td>
                <td>' . $atitle . ' ' . $afname . '</td>
            </tr>
            <tr>
                <td>Last Name</td>
                <td>' . $alname . '</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>' . $email . '</td>
            </tr>
            
            <tr>
                <td>Mobile</td>
                <td>' . $mobile . '</td>
            </tr>
        </table>
    </div>
</div>
';

        $ci = get_instance();
        $ci->load->library('email');
        $ci->email->from('it@roombooking.in', 'Roombooking');
        $list = $email;
        $ci->email->to($list);
        //$this->email->reply_to($list);
        $ci->email->subject('Passenger Details');
        $ci->email->message($msgbody);
        $ci->email->send();

        $ci = get_instance();
        $ci->load->library('email');
        $ci->email->from($email, 'User');
        $list = 'support@roombooking.in';
        $ci->email->to($list);
        //$this->email->reply_to($list);
        $ci->email->subject('Passenger Details');
        $ci->email->message($msgbody);
        $ci->email->send();

        //echo $this->email->print_debugger();
        //exit;
    }

    function payment_process() {
        $this->session->set_userdata('final_book_info', $_POST);
        $pass = $this->session->userdata('final_book_info');

        $pass_info = $this->session->userdata('passenger_info');
        $this->passenger_details();
//        echo '<pre>';        //print_r($_POST); 
//        
//        print_r($this->session->all_userdata());
//        exit;
        $payment_type = $pass['payment_type'];
        if ($payment_type == 'payu') {
            //$this->load->view('payment_load');
            $this->load->view('b2c/hotel/payment_load_demo');
        } else {
            //HDFC Payment Starts
            $pass_info = $this->session->userdata('final_book_info');
            $total_amount = $pass_info['total_price'];

            $amount = $total_amount;
            $email = $pass_info['user_email'];
            $pmobile = $pass_info['user_mobile'];
            $random = rand(000000, 9999999);
            $TranTrackid = $random;
            $TranAmount = $amount;

            $pay_detail_id = $this->Hotel_Model->hdfc_pay_details($random, $TranAmount);
            if ($pay_detail_id) {

                $ReqTranportalId = "id=9000507";
                $ReqTranportalPassword = "password=password1";
                $ReqAmount = "amt=" . $TranAmount;
                $ReqTrackId = "trackid=" . $TranTrackid;
                $ReqCurrency = "currencycode=356";
                $ReqLangid = "langid=USA";
                $ReqAction = "action=1";
                $ReqResponseUrl = "responseURL=http://www.roombooking.in/hotel/GetHandleRESponse";
                $ReqErrorUrl = "errorURL=http://www.roombooking.in/hotel/hdfc_payment_failure";
                $ReqUdf1 = "udf1=Hotel Room Booking";
                $ReqUdf2 = "udf2=support@roombooking.in";
                $ReqUdf3 = "udf3=9342529900";
                $ReqUdf4 = "udf4= S R GROUPS
@ 1672 K Block Ramakrishna Nagar
2nd Stage Dattagalli Mysore - 570022
Karnataka India";
                /* ============================== HASHING LOGIC CODE START ============================================== */

                $strhashTID = trim("9000507");     //USE Tranportal ID FIELD Value FOR HASHING 
                $strhashtrackid = trim($TranTrackid);  //USE Trackid FIELD Value FOR HASHING 
                $strhashamt = trim($TranAmount);     //USE Amount FIELD Value FOR HASHING 
                $strhashcurrency = trim("356");    //USE Currencycode FIELD Value FOR HASHING 
                $strhashaction = trim("1");     //USE Action code FIELD Value FOR HASHING 
                $str = trim($strhashTID . $strhashtrackid . $strhashamt . $strhashcurrency . $strhashaction);
                $hashstring = hash('sha256', $str);
                $ReqUdf5 = "udf5=" . $hashstring;      // Passed Calculated Hashed Value in UDF5 Field 
                /* ==============================HASHING LOGIC CODE END============================================== */
                $param = $ReqTranportalId . "&" . $ReqTranportalPassword . "&" . $ReqAction . "&" . $ReqLangid . "&" . $ReqCurrency . "&" . $ReqAmount . "&" . $ReqResponseUrl . "&" . $ReqErrorUrl . "&" . $ReqTrackId . "&" . $ReqUdf1 . "&" . $ReqUdf2 . "&" . $ReqUdf3 . "&" . $ReqUdf4 . "&" . $ReqUdf5;
                $url = "https://securepgtest.fssnet.co.in/pgway/servlet/PaymentInitHTTPServlet";

                $ch = curl_init() or die(curl_error());
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
                curl_setopt($ch, CURLOPT_PORT, 443); // port 443
                curl_setopt($ch, CURLOPT_URL, $url); // here the request is sent to payment gateway 
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); //create a SSL connection object server-to-server
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                $data1 = curl_exec($ch) or die(curl_error());

                curl_close($ch);

                $response = $data1;
                // echo '<pre>';        print_r($response); exit;
                try {

                    $index = strpos($response, "!-");
                    $ErrorCheck = substr($response, 1, $index - 1); //This line will find Error Keyword in response
                    if ($ErrorCheck == 'ERROR') {//This block will check for Error in response
                        // here redirecting the error page 
                        $failedurl = 'http://www.roombooking.in/hotel/hdfc_payment_failure?ResTrackId=' . $TranTrackid . '&ResAmount=' . $TranAmount . '&ResError=' . $response;
                        header("location:" . $failedurl);
                    } else {
                        // If Payment Gateway response has Payment ID & Pay page URL		
                        $i = strpos($response, ":");
                        // Merchant MUST map (update) the Payment ID received with the merchant Track Id in his database at this place.
                        $paymentId = substr($response, 0, $i);
                        $paymentPage = substr($response, $i + 1);
                        // here redirecting the customer browser from ME site to Payment Gateway Page with the Payment ID
                        $r = $paymentPage . "?PaymentID=" . $paymentId;
                        header("location:" . $r);
                    }
                } catch (Exception $e) {
                    var_dump($e->getMessage());
                }
            }

            //HDFC Ends
        }
    }

    function GetHandleRESponse() {
        try {
            $strResponseIPAdd = getenv('REMOTE_ADDR');
            if ($strResponseIPAdd != "221.134.101.174" && $strResponseIPAdd != "221.134.101.169" && $strResponseIPAdd != "198.64.129.10" && $strResponseIPAdd != "198.64.133.213") {
//                echo '1';
//                exit;
                $REDIRECT = 'REDIRECT=http://www.roombooking.in/hotel/hdfc_payment_failure?ResError=--IP MISSMATCH-- Response IP Address is: ' . $strResponseIPAdd;
                echo $REDIRECT;
            } else {
                /* Variable Declaration */
                /* ========================================================================================= */
                $ResErrorText = isset($_POST['ErrorText']) ? $_POST['ErrorText'] : '';  //Error Text/message
                $ResPaymentId = isset($_POST['paymentid']) ? $_POST['paymentid'] : ''; //Payment Id
                $ResTrackID = isset($_POST['trackid']) ? $_POST['trackid'] : '';        //Merchant Track ID
                $ResErrorNo = isset($_POST['Error']) ? $_POST['Error'] : '';            //Error Number
                $ResResult = isset($_POST['result']) ? $_POST['result'] : '';           //Transaction Result
                $ResPosdate = isset($_POST['postdate']) ? $_POST['postdate'] : '';      //Postdate
                $ResTranId = isset($_POST['tranid']) ? $_POST['tranid'] : '';           //Transaction ID
                $ResAuth = isset($_POST['auth']) ? $_POST['auth'] : '';                 //Auth Code		
                $ResAVR = isset($_POST['avr']) ? $_POST['avr'] : '';                    //TRANSACTION avr					
                $ResRef = isset($_POST['ref']) ? $_POST['ref'] : '';                    //Reference Number also called Seq Number
                $ResAmount = isset($_POST['amt']) ? $_POST['amt'] : '';                 //Transaction Amount
                $Resudf1 = isset($_POST['udf1']) ? $_POST['udf1'] : '';                  //UDF1
                $Resudf2 = isset($_POST['udf2']) ? $_POST['udf2'] : '';                  //UDF2
                $Resudf3 = isset($_POST['udf3']) ? $_POST['udf3'] : '';                  //UDF3
                $Resudf4 = isset($_POST['udf4']) ? $_POST['udf4'] : '';                  //UDF4
                $Resudf5 = isset($_POST['udf5']) ? $_POST['udf5'] : '';                  //UDF5			
                if ($ResErrorNo == '') {
                    $strHashTraportalID = trim("9000507"); //USE Tranportal ID FIELD FOR HASHING ,Mercahnt need to take this filed value  from his Secure channel such as DATABASE.
                    $strhashstring = "";            //Declaration of Hashing String 
                    $strhashstring = trim($strHashTraportalID);
                    //Below code creates the Hashing String also it will check NULL and Blank parmeters and exclude from the hashing string
                    if ($ResTrackID != '' && $ResTrackID != null)
                        $strhashstring = trim($strhashstring) . trim($ResTrackID);
                    if ($ResAmount != '' && $ResAmount != null)
                        $strhashstring = trim($strhashstring) . trim($ResAmount);
                    if ($ResResult != '' && $ResResult != null)
                        $strhashstring = trim($strhashstring) . trim($ResResult);
                    if ($ResPaymentId != '' && $ResPaymentId != null)
                        $strhashstring = trim($strhashstring) . trim($ResPaymentId);
                    if ($ResRef != '' && $ResRef != null)
                        $strhashstring = trim($strhashstring) . trim($ResRef);
                    if ($ResAuth != '' && $ResAuth != null)
                        $strhashstring = trim($strhashstring) . trim($ResAuth);
                    if ($ResTranId != '' && $ResTranId != null)
                        $strhashstring = trim($strhashstring) . trim($ResTranId);
                    $hashvalue = hash('sha256', $strhashstring);
                    if ($hashvalue == $Resudf5) {
                        $REDIRECT = 'REDIRECT=http://www.roombooking.in/hotel/hdfc_payment_success?ResResult=' . $ResResult . '&ResTrackId=' . $ResTrackID . '&ResAmount=' . $ResAmount . '&ResPaymentId=' . $ResPaymentId . '&ResRef=' . $ResRef . '&ResTranId=' . $ResTranId . '&ResError=' . $ResErrorText . 'Hashing Response Successful';
                        echo $REDIRECT;
                        //echo '2'; exit;
                        //redirect('dhotel/hdfc_payment_failure?ResResult=' . $ResResult . '&ResTrackId=' . $ResTrackID . '&ResAmount=' . $ResAmount . '&ResPaymentId=' . $ResPaymentId . '&ResRef=' . $ResRef . '&ResTranId=' . $ResTranId . '&ResError=' . $ResErrorText . 'Hashing Response Successful');
                    } else {
                        $REDIRECT = 'REDIRECT=http://www.roombooking.in/hotel/hdfc_payment_failure?ResError=Hashing Response Mismatch';
                        echo $REDIRECT;
                        // echo '3'; exit;
                        // redirect('dhotel/hdfc_payment_failure?ResError=Hashing Response Mismatch');
                    }
                } else {
                    $REDIRECT = 'REDIRECT=http://www.roombooking.in/hotel/hdfc_payment_failure?ResResult=' . $ResResult . '&ResTrackId=' . $ResTrackID . '&ResAmount=' . $ResAmount . '&ResPaymentId=' . $ResPaymentId . '&ResRef=' . $ResRef . '&ResTranId=' . $ResTranId . '&ResError=' . $ResErrorText;
                    echo $REDIRECT;
                    // echo '4'; exit;
                    // redirect('dhotel/hdfc_payment_failure?ResResult=' . $ResResult . '&ResTrackId=' . $ResTrackID . '&ResAmount=' . $ResAmount . '&ResPaymentId=' . $ResPaymentId . '&ResRef=' . $ResRef . '&ResTranId=' . $ResTranId . '&ResError=' . $ResErrorText);
                }
            }
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
    }

    function hdfc_payment_failure() {
        $ResResult = $_REQUEST['ResResult'];
        $ResTrackId = $_REQUEST['ResTrackId'];
        $ResAmount = $_REQUEST['ResAmount'];
        $ResPaymentId = $_REQUEST['ResPaymentId'];
        $ResRef = $_REQUEST['ResRef'];
        $ResTranId = $_REQUEST['ResTranId'];
        $ResError = $_REQUEST['ResError'];
        $pay_detail_id = $this->Dhotel_Model->update_hdfc_pay_details($ResResult, $ResTrackId, $ResAmount, $ResPaymentId, $ResRef, $ResTranId, $ResError);
        $error = 'Payment Fauled. Your Track Id: ' . $ResTrackId . 'Error' . $ResError;

        $error = 'Price as been changed, please search again';
        redirect('hotel/error_page/' . base64_encode($error));
    }

    function hdfc_payment_success() {

//        echo '<pre>';
//        print_r($_REQUEST);
//        exit;

        $ResResult = $_REQUEST['ResResult'];
        $ResTrackId = $_REQUEST['ResTrackId'];
        $ResAmount = $_REQUEST['ResAmount'];
        $ResPaymentId = $_REQUEST['ResPaymentId'];
        $ResRef = $_REQUEST['ResRef'];
        $ResTranId = $_REQUEST['ResTranId'];
        $ResError = $_REQUEST['ResError'];

        $pay_detail_id = $this->Hotel_Model->update_hdfc_pay_details($ResResult, $ResTrackId, $ResAmount, $ResPaymentId, $ResRef, $ResTranId, $ResError);

        if ($_REQUEST['ResResult'] != 'CAPTURED') {

            $error = 'Payment Pailed';
            redirect('hotel/error_page/' . base64_encode($error));
            exit();
        } else if ($pay_detail_id) {
            redirect('hotel/rooms_reservation', 'refersh');
        } else {
            $error = 'No response from server';
            redirect('hotel/error_page/' . base64_encode($error));
        }
    }

    function rooms_reservation() {
        $pass = $this->session->userdata('final_book_info');
        $payment_type = $pass['payment_type'];
        if ($payment_type == 'payu') {
            $pay_detail_id = $this->Hotel_Model->pay_details($_REQUEST['mihpayid'], $_REQUEST['status'], $_REQUEST['txnid'], $_REQUEST['amount'], $_REQUEST['discount'], $_REQUEST['net_amount_debit'], $_REQUEST['addedon'], $_REQUEST['productinfo'], $_REQUEST['hash'], $_REQUEST['field1'], $_REQUEST['payment_source'], $_REQUEST['PG_TYPE'], $_REQUEST['bank_ref_num'], $_REQUEST['bankcode'], $_REQUEST['error'], $_REQUEST['error_Message'], $_REQUEST['cardnum']);
            if ($_REQUEST['status'] != 'success') {
                $error = 'Payment failed';
                redirect('hotel/error_page/' . base64_encode($error));
                exit();
            }
        }
        //echo '<pre>'; print_r($pass);
        $admin_markup = $pass['admin_markup'];
        $payment_charge = $pass['payment_charge'];
        $total_price = $pass['total_price'];
        $agent_markup = '0';


        //payment gateway goes here
        $confirmbooking = $this->roomsxmlbookcreate('confirm');
        //   echo '<pre>';print_r($confirmbooking);exit;
        $dom2 = new DOMDocument();
        $dom2->loadXML($confirmbooking);
        $CommitLevel = $dom2->getElementsByTagName('CommitLevel')->item(0)->nodeValue;

        if ($CommitLevel != 'confirm') {
            $data['status'] = 'Booking failed';
        } else {
            $CommitLevel = $dom2->getElementsByTagName('CommitLevel')->item(0)->nodeValue;
            $Book_currency = $dom2->getElementsByTagName('Currency')->item(0)->nodeValue;
            $Book_totamnt = 0;
            $Book_VoucherRef = '';
            $Book_hotelid = '';
            $Booking = $dom2->getElementsByTagName('Booking');
            foreach ($Booking as $val) {
                $Book_reference = $val->getElementsByTagName('Id')->item(0)->nodeValue;
                $Book_CreationDate = $val->getElementsByTagName('CreationDate')->item(0)->nodeValue;
                $HotelBooking = $val->getElementsByTagName('HotelBooking');
                foreach ($HotelBooking as $val1) {
                    $Book_hotelid.= $val1->getElementsByTagName('Id')->item(0)->nodeValue;
                    $Book_Hotelcode = $val1->getElementsByTagName('HotelId')->item(0)->nodeValue;
                    $Book_HotelName = $val1->getElementsByTagName('HotelName')->item(0)->nodeValue;
                    $Book_ArrivalDate = $val1->getElementsByTagName('ArrivalDate')->item(0)->nodeValue;
                    $Book_Nights = $val1->getElementsByTagName('Nights')->item(0)->nodeValue;

                    $Book_Amount = $val1->getElementsByTagName('TotalSellingPrice')->item(0)->getAttribute('amt');
                    //   $Book_currency = $Book_TotalSellingPrice->item(0)->getElementsByTagName('Currency')->item(0)->nodeValue;

                    $Book_Status = $val1->getElementsByTagName('Status')->item(0)->nodeValue;
                    $Book_VoucherInfo = $val1->getElementsByTagName('VoucherInfo');
                    $Book_PayableBy = $Book_VoucherInfo->item(0)->getElementsByTagName('PayableBy')->item(0)->nodeValue;
                    $Book_VoucherRef.= $Book_VoucherInfo->item(0)->getElementsByTagName('VoucherRef')->item(0)->nodeValue;
                    $Book_Room = $val1->getElementsByTagName('Room');

                    $Book_RoomTypeval = $Book_Room->item(0)->getElementsByTagName('RoomType')->item(0)->getAttribute('text');
                    //$Book_RoomTypeval = $Book_RoomType->item(0)->getElementsByTagName('Text')->item(0)->nodeValue;
                    $Book_totamnt = $Book_totamnt + $Book_Amount;
                    $Book_VoucherRef.='||';
                    $Book_hotelid.='||';
                }
            }
        }

//                    if ($CommitLevel != 'confirm') {
//                        $Book_Status = 'Failed';
//                        $Book_reference = 'XXXXXXXXXXX';
//                        $Book_Status = 'Failed';
//                        $book_noval = 'XXXXXXXXXXX';
//                    }

        if ($this->session->userdata('user_logged_in')) {
            $user_id = $this->session->userdata('user_id');
            $Booking_Done_By = 'user';
        } else {
            $user_id = 0;
            $Booking_Done_By = 'guest';
        }
        $Booking_Date = date('Y-m-d');
        $RefNo = $this->generateRandomString(8);
        $api = 'roomsxml';
        // HOTEL BOOKING REPORT DATA
        $this->Roomsxml_Model->insert_booking_report_data($user_id, $CommitLevel, $Book_reference, $RefNo, $Booking_Date, $Book_hotelid, $Book_currency, $admin_markup, $payment_charge, $Book_totamnt, $total_price, $Book_Status, $Book_PayableBy, $Book_VoucherRef, $Booking_Done_By); //////////////////////////

        $hoteldetails = $this->Roomsxml_Model->get_hotel_details($Book_Hotelcode);
        $hotel_search_data = $this->session->userdata('hotel_search_data');
        // Hotel Booking Hotels Information Data
        $checkIn = date('Y-m-d', strtotime(str_replace("/", "-", $hotel_search_data['checkin'])));
        $checkOut = date('Y-m-d', strtotime(str_replace("/", "-", $hotel_search_data['checkout'])));

        $this->Roomsxml_Model->insert_hotel_booking_information_data($RefNo, $Book_Hotelcode, $Book_HotelName, $hotel_search_data['city'], $checkIn, $checkOut, $Booking_Date, $Book_RoomTypeval, $hotel_search_data['room_count'], $Book_Nights, 'roomsxml', $hotel_search_data['adultvalue'], $hotel_search_data['childvalue'], $hoteldetails->star, $hoteldetails->image, $hoteldetails->description, $hoteldetails->address, $hoteldetails->phone, $hoteldetails->fax, $hotel_search_data['adult_count'], $hotel_search_data['child_count'], $user_id);

        $this->ticket_email($RefNo, $Book_reference);
        //$this->voucher_emmail($RefNo, $Book_reference);
        redirect('hotel/voucher?voucherId=' . $RefNo . '&Booking_RefNo=' . $Book_reference, 'refresh');
    }

    function ticket_email($sysRefNo, $bookRefNo) {
        $data['hotel_booking_info'] = $hotel_booking_info = $this->Roomsxml_Model->get_hotel_booking_information($sysRefNo, $bookRefNo);
        $data['passenger_info'] = $passenger_info = $this->Roomsxml_Model->get_hotel_booking_passenger_info($sysRefNo);
        //Email Function
        $email_id = $hotel_booking_info->email;
        $msgbody = '
            <div>
            Dear Customer,
         <br/>   

<p>Thank you for booking with our services, Please <a href="roombooking.in/hotel/generate_eticket/' . $sysRefNo . '/' . $bookRefNo . '" >click here</a> to get your e ticket.</p>


Regards

<div>
                           
                            <h5><strong>S R GROUPS</strong></h5>
                            <p># 1672, K Block, Ramakrishna Nagar,</p>
                            <p>2nd Stage, Dattagalli, Mysore - 570022,</p>
                            <p>Karnataka, India.</strong></p>
                            <p>You can call us on +91 93423 29900 (standard charges apply) between 10 am- 6 pm.</p>
                            <p>You can email us at support@roombooking.in</p>
                            
                            
                        </div>
            </div>
            
';

        $curr_date = date("d/m/Y");
        $ci = get_instance();
        $ci->load->library('email');
        $ci->email->from('it@roombooking.in', 'Roombooking');
        $list = $user_email;
        $ci->email->to($list);
        $this->email->reply_to('it@roombooking.in');
        $ci->email->subject('E Ticket');
        $ci->email->message($msgbody);
        $ci->email->send();


        $ci = get_instance();
        $ci->load->library('email');
        $ci->email->from('it@roombooking.in', 'Roombooking');
        $list = 'support@roombooking.in';
        $ci->email->to($list);
        $this->email->reply_to($list);
        $ci->email->subject('E Ticket');
        $ci->email->message();
        $ci->email->send();
        //exit;
    }

    function generate_eticket($sysRefNo, $bookRefNo) {
        $data['voucherId'] = $sysRefNo;
        $data['hotel_booking_info'] = $this->Roomsxml_Model->get_hotel_booking_information($sysRefNo, $bookRefNo);
        $data['passenger_info'] = $this->Roomsxml_Model->get_hotel_booking_passenger_info($sysRefNo);
        // echo '<pre/>';print_r($data);exit;
        $this->load->view('b2c/hotel/voucher', $data);
    }

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

    function generateRandomString($length = 10) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ9876543210ZYXWVUTSRQPONMLKJIHGFEDCBA';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return 'RB' . $randomString;
    }

    function cancel_voucher($RefNo, $Booking_reference_ID) {
        $cancel_create = '
<BookingCancel>
    <Authority>
        <Org>' . $this->ragencyID . '</Org>
        <User>' . $this->ruserID . '</User> 
        <Password>' . $this->rpassword . '</Password> 
        <Currency>' . $this->rcurrency . '</Currency>
        <Version>' . $this->rversion . '</Version>
    </Authority>
    <BookingId>' . $Booking_reference_ID . '</BookingId>
    <CommitLevel>prepare</CommitLevel>
</BookingCancel>
';

        // echo $cancel_create; //exit;
        $cancel_resp = $this->PostRQ_cancel($cancel_create);
        //echo '';
        //print_r($cancel_resp); exit;
        $dom2 = new DOMDocument();
        $dom2->loadXML($cancel_resp);
        $Currency = $dom2->getElementsByTagName('Currency')->item(0)->nodeValue;
        $CommitLevel = $dom2->getElementsByTagName('CommitLevel')->item(0)->nodeValue;

        $Booking = $dom2->getElementsByTagName('Booking');
        foreach ($Booking as $val) {
            $Book_reference = $val->getElementsByTagName('Id')->item(0)->nodeValue;
            $Book_CreationDate = $val->getElementsByTagName('CreationDate')->item(0)->nodeValue;
            $HotelBooking = $val->getElementsByTagName('HotelBooking');
            foreach ($HotelBooking as $val1) {
                $Id.= $val1->getElementsByTagName('Id')->item(0)->nodeValue;
                $HotelId = $val1->getElementsByTagName('HotelId')->item(0)->nodeValue;
                $HotelName = $val1->getElementsByTagName('HotelName')->item(0)->nodeValue;
                $CreationDate = $val1->getElementsByTagName('CreationDate')->item(0)->nodeValue;
                $ArrivalDate = $val1->getElementsByTagName('ArrivalDate')->item(0)->nodeValue;
                $Nights = $val1->getElementsByTagName('Nights')->item(0)->nodeValue;
                $TotalSellingPrice = $val1->getElementsByTagName('TotalSellingPrice')->item(0)->nodeValue;
                $Status = $val1->getElementsByTagName('Status')->item(0)->nodeValue;

                $Room = $val1->getElementsByTagName('Room');
                foreach ($Room as $val2) {
                    $CanxFees = $val2->getElementsByTagName('CanxFees');
                    foreach ($CanxFees as $val3) {
                        $Fee = $val3->getElementsByTagName('Fee')->item(0)->getAttribute('from');
                        $Fee1 = $val3->getElementsByTagName('CanxFees');
                        //  foreach ($Fee1 as $val4) {
                        $Amount+= $val3->getElementsByTagName('Amount')->item(0)->getAttribute('amt');
                        //  }
                    }
                }
            }
        }
        $cancel_array = array(
            'HotelId' => $HotelId,
            'HotelName' => $HotelName,
            'CreationDate' => $CreationDate,
            'ArrivalDate' => $ArrivalDate,
            'Book_reference' => $Book_reference,
            'Book_CreationDate' => $Book_CreationDate,
            'Currency' => $Currency,
            'Nights' => $Nights,
            'Status' => $Status,
            'l_date' => $Fee,
            'Amount' => $Amount
        );
        $this->session->set_userdata('cancel_data', $cancel_array);

        $this->load->view('b2c/hotel/roomsxml/rooms_cancel_confirm');



//        echo '<pre>';
//        print_r($Amount);
//        exit;
    }

    function rooms_hotel_cancel_confirm() {
        $Book_reference = $_POST['Book_reference'];
        $cancel_create = '
<BookingCancel>
    <Authority>
        <Org>' . $this->ragencyID . '</Org>
        <User>' . $this->ruserID . '</User> 
        <Password>' . $this->rpassword . '</Password> 
        <Currency>' . $this->rcurrency . '</Currency>
        <Version>' . $this->rversion . '</Version>
    </Authority>
    <BookingId>' . $Book_reference . '</BookingId>
    <CommitLevel>confirm</CommitLevel>
</BookingCancel>
';
        // echo $cancel_create; //exit;
        $cancel_resp = $this->PostRQ_cancel($cancel_create);
//        echo '<pre>';
//        print_r($cancel_resp);
//        exit;
        $dom2 = new DOMDocument();
        $dom2->loadXML($cancel_resp);
        $Currency = $dom2->getElementsByTagName('Currency')->item(0)->nodeValue;
        $CommitLevel = $dom2->getElementsByTagName('CommitLevel')->item(0)->nodeValue;

        $Booking = $dom2->getElementsByTagName('Booking');
        foreach ($Booking as $val) {
            $Book_reference = $val->getElementsByTagName('Id')->item(0)->nodeValue;
            $Book_CreationDate = $val->getElementsByTagName('CreationDate')->item(0)->nodeValue;
            $HotelBooking = $val->getElementsByTagName('HotelBooking');
            foreach ($HotelBooking as $val1) {
                $Id.= $val1->getElementsByTagName('Id')->item(0)->nodeValue;
                $HotelId = $val1->getElementsByTagName('HotelId')->item(0)->nodeValue;
                $HotelName = $val1->getElementsByTagName('HotelName')->item(0)->nodeValue;
                $CreationDate = $val1->getElementsByTagName('CreationDate')->item(0)->nodeValue;
                $ArrivalDate = $val1->getElementsByTagName('ArrivalDate')->item(0)->nodeValue;
                $Nights = $val1->getElementsByTagName('Nights')->item(0)->nodeValue;
                $TotalSellingPrice = $val1->getElementsByTagName('TotalSellingPrice')->item(0)->nodeValue;
                $Status = $val1->getElementsByTagName('Status')->item(0)->nodeValue;

                $Room = $val1->getElementsByTagName('Room');
                foreach ($Room as $val2) {
                    $CanxFees = $val2->getElementsByTagName('CanxFees');
                    foreach ($CanxFees as $val3) {
                        $Fee = $val3->getElementsByTagName('Fee')->item(0)->getAttribute('from');
                        $Fee1 = $val3->getElementsByTagName('CanxFees');
                        //  foreach ($Fee1 as $val4) {
                        $Amount+= $val3->getElementsByTagName('Amount')->item(0)->getAttribute('amt');
                        //  }
                    }
                }
            }
        }
        $cancel_confirm_array = array(
            'HotelId' => $HotelId,
            'HotelName' => $HotelName,
            'CreationDate' => $CreationDate,
            'ArrivalDate' => $ArrivalDate,
            'Book_reference' => $Book_reference,
            'Book_CreationDate' => $Book_CreationDate,
            'Currency' => $Currency,
            'Nights' => $Nights,
            'Status' => $Status,
            'l_date' => $Fee,
            'Amount' => $Amount
        );
        $this->session->set_userdata('cancel_confirm_array', $cancel_confirm_array);
        $this->Roomsxml_Model->update_b2c_rooms_hotel_booking_status($Book_reference);
        $this->refund_cancelled_hotel($Book_reference, $Book_CreationDate, $Status);
        $this->load->view('b2c/hotel/roomsxml/rooms_cancel_confirmed');



//        echo '<pre>';
//        print_r($Amount);
//        exit;
    }

    function refund_cancelled_hotel($Book_reference, $Book_CreationDate, $Status) {
        $msgbody.= '
            <div>
    <div>
        <h2>Hotel Cancellation Details :: Roombooking.in </h2>
        <table>
          
            <tr>
                <td>Booking Reference</td>
                <td>' . $Book_reference . '</td>
            </tr>
            <tr>
                <td>Created Date</td>
                <td>' . $Book_CreationDate . '</td>
            </tr>
             <tr>
                <td>Status</td>
                <td>' . $Status . '</td>
            </tr>
        </table>
    </div>
</div>
';

        $ci = get_instance();
        $ci->load->library('email');
        $ci->email->from('it@roombooking.in', 'Roombooking');
        $list = $email;
        $ci->email->to($list);
        //$this->email->reply_to($list);
        $ci->email->subject('Refund of Hotel Cancellation');
        $ci->email->message($msgbody);
        $ci->email->send();
        $ci = get_instance();
        $ci->load->library('email');
        $ci->email->from($email, 'User');
        $list = 'support@roombooking.in';
        $ci->email->to($list);
        //$this->email->reply_to($list);
        $ci->email->subject('Refund of Hotel Cancellation');
        $ci->email->message($msgbody);
        $ci->email->send();

        //echo $this->email->print_debugger();
        //exit;
    }

    public function PostRQ_cancel($cancel_create) {

//echo $xml_data;exit;
        $ch2 = curl_init();
        curl_setopt($ch2, CURLOPT_URL, $this->rURL);
        curl_setopt($ch2, CURLOPT_TIMEOUT, 0);
        curl_setopt($ch2, CURLOPT_HEADER, 0);
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch2, CURLOPT_POST, 1);
        curl_setopt($ch2, CURLOPT_POSTFIELDS, $cancel_create);
        curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch2, CURLOPT_SSLVERSION, 3);
//curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, true);

        $httpHeader2 = array("Content-Type: text/xml; charset=UTF-8", "Content-Encoding: UTF-8");
        curl_setopt($ch2, CURLOPT_HTTPHEADER, $httpHeader2);
        curl_setopt($ch2, CURLOPT_ENCODING, "gzip");

// Execut	e request, store response and HTTP response code
        $curlresp = curl_exec($ch2);
        $error2 = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
        curl_close($ch2);
        return $curlresp;
    }

}

