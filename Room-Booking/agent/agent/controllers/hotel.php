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
        // $this->load->model('Acerooms_Model');
        $this->load->model('Roomsxml_Model');
        //   $this->load->model('Jac_Model');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->database();

        // ROOMSXML API CREDENTIALS
        $this->rURL = "http://roomsxmldemo.com/RXLStagingServices/ASMX/XmlService.asmx";
        $this->ragencyID = "uttpl";
        $this->ruserID = "xmltest";
        $this->rpassword = "xmltest";
        $this->rversion = "1.25";
        $this->rcurrency = "USD";
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
            // this is ramesh code
//            $diff = strtotime($checkout) - strtotime($checkin);
//            $sec = $diff % 60;
//            $diff = intval($diff / 60);
//            $min = $diff % 60;
//            $diff = intval($diff / 60);
//            $hours = $diff % 24;
//            $days = intval($diff / 24);
//            $noofnights = $days;
            // this is ramesh code
            // 
            // calculating date diff
            $noofnights = $this->Hotel_Model->calculatedateDiff1($checkin, $checkout);
            //testing google
            // $noofnights = $this->Hotel_Model->calculatedateDiff($checkin, $checkout);

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
                $this->load->view('b2b/hotel/search_progressi', $data);
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
        $data['result'] = array_merge($r_roomsxml, $r_acerooms);
        $data['agent_no'] = $agent_no = $this->session->userdata('agent_no');
//        echo '<pre>';
//        print_r($data);
//        exit;
        $this->load->view('b2b/hotel/search_result', $data);
    }

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

//echo '<pre>';            print_r($data); exit;
        // this is for the specific api to get ther details respectively
        if ($data['hotel_detail']->api == 'acerooms') {
            $data['details'] = $this->get_acerooms_detail($data['hotel_detail']->hotel_code);
            $this->load->view('b2b/hotel/acerooms/hotel_detail', $data);
        } elseif ($data['hotel_detail']->api == 'roomsxml') {
            $this->load->view('b2b/hotel/roomsxml/hotel_detail', $data);
        } elseif ($data['hotel_detail']->api == 'jac') {
            $data['rooms'] = $this->jac_pricing($data['hotel_detail']);
            $data['details'] = $this->get_jac_detail($data['hotel_detail']->hotel_code);
            $this->load->view('b2b/hotel/jac/hotel_detail', $data);
        }
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

            $this->load->view('b2b/hotel/acerooms/hotel_itenarary', $data);
        } elseif ($data['hotel_detail']->api == 'roomsxml') {
            // $this->roomsxmlbookcreate($data['hotel_detail']);
            //  echo '<pre>';print_r($data);exit;
            $data['details'] = $this->Hotel_Model->gethotel_detail($data['hotel_detail']->hotel_code);

            $this->load->view('b2b/hotel/roomsxml/hotel_itenarary', $data);
        } elseif ($data['hotel_detail']->api == 'jac') {
            $data['details'] = $this->get_jac_detail($data['hotel_detail']->hotel_code);
            $this->load->view('b2b/hotel/jac/hotel_itenarary', $data);
        }
    }

    function error_page($error) {
        $error = base64_decode($error);
        $data['error'] = $error;
        $this->load->view('b2b/hotel/error_page', $data);
    }

    function reservation() {
//echo $this->input->post('booking_id');exit;
        if ($this->input->post('booking_id') == '') {
            $error = 'Some thing went wrong, please try again';

            redirect('hotel/error_page/' . base64_encode($error));
        } else {
            $this->session->set_userdata('passenger_info', $_POST);

            if ($_POST['api'] == 'roomsxml') {
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
//echo '<pre>';print_r($data); exit;
                    $this->load->view('b2b/hotel/roomsxml/reservationcheck', $data);
                } else {
                    $error = 'Price as been changed, please search again';
                    redirect('hotel/error_page/' . base64_encode($error));
                }
            }
        }
    }

    public function voucher() {
        if (isset($_GET['voucherId']) && isset($_GET['Booking_RefNo'])) {
            $sysRefNo = $_GET['voucherId'];
            $bookRefNo = $_GET['Booking_RefNo'];

            $data['hotel_booking_info'] = $this->Roomsxml_Model->get_hotel_booking_information($sysRefNo, $bookRefNo);
            $data['passenger_info'] = $this->Roomsxml_Model->get_hotel_booking_passenger_info($sysRefNo);
            //echo '<pre/>';print_r($data);exit;
            $this->ticket_email($sysRefNo, $bookRefNo);
            $this->load->view('b2b/hotel/voucher', $data);
        } else {
            echo 'Permission Denied';
        }
    }

    public function voucher_print($sysRefNo, $bookRefNo) {
        $data['hotel_booking_info'] = $this->Roomsxml_Model->get_hotel_booking_information($sysRefNo, $bookRefNo);
        $data['passenger_info'] = $this->Roomsxml_Model->get_hotel_booking_passenger_info($sysRefNo);
        $this->load->view('b2b/hotel/voucher', $data);
    }

    function ticket_email($sysRefNo, $bookRefNo) {
        $data['hotel_booking_info'] = $hotel_details = $this->Roomsxml_Model->get_hotel_booking_information($sysRefNo, $bookRefNo);
        $data['passenger_info'] = $passenger_details = $this->Roomsxml_Model->get_hotel_booking_passenger_info($sysRefNo);
        ///$data["hotel_details"] = $this->Travelguru_Hotel_Model->get_hotel_details($bookUniqueIDval);

        $email_id = $hotel_details->email;
        $msgbody = '<style type="text/css">
            body{
                width: 100%;
                font-family: Verdana, Geneva, sans-serif;
                font-size: 12pt;

            }
            .ticket_container
            {
                width: 1000px;
                /*box-shadow: 0 0 10px #9ecaed;*/
                border: 1px solid #CCC;
                margin: auto;
                padding: 10px;
            }
            .ticket_header
            {
                width: 990px;
                height: 25px;
                background-color: deepskyblue;
                padding: 5px;
                border-radius: 5px 5px 0px 0px;
                margin-top: 5px;

            }
            .ticket_details
            {
                width: 990px;
                height: 50px;

                padding: 5px;
            }
            .traveler_details
            {
                width: 990px;
                padding: 5px;
                height: auto;
            }
            .hotel_details
            {
                width: 988px;
                padding: 5px;
                height: auto;
                min-height: 30px;
                border: 1px solid #9ecaed ;
                border-radius: 0px 0px 5px 5px;
            }
            .ticket_title
            {
                width: 988px;
                padding: 5px;
                height: auto;
                min-height: 60px;


            }
            .ticket_logo
            {
                float: left;
                width: 494px;

            }
            .support{
                float: left;
                width: 494px;
            }
        </style>';

        $msgbody.= '
            <div class="ticket_container">
            <div class="ticket_title">
                <div class="ticket_logo" align="left">
                    <img src="http://www.roombooking.in/public/images/logo.png"></img>
                </div>
                <div class="support" align="right">
                    support@travelpd.com<br/>
                    123456789
                </div>

            </div>
            <div style="border:1px solid #CCC">
                <div class="ticket_details">
                    <p>
                        <strong>Dear ' . $hotel_details->title . '. ' . $hotel_details->first_name . '</strong><br>
                        Thank you for booking your hotel with FLYNSTAY. We are pleased to confirm your booking details as below:</p>
                </div>

                <div class="traveler_details">
                    <table width="100%" align="center">
                        <tr>

                            <th colspan="2">Traveler Details</th>
                            <th colspan="2"> Your Reservations</th>

                        </tr>
                        <tr>
                            <td><strong>Guest Name</strong></td>
                            <td>' . $hotel_details->title . '.' . $hotel_details->first_name . '</td>
                            <td><strong>Hotel Booking Number</strong></td>
                            <td>' . $hotel_details->Booking_reference_ID . '</td>
                        </tr>
                        <tr>
                            <td><strong>No. of Adults</strong></td>
                            <td>' . $hotel_details->adult . '</td>
                            <td><strong>Check - in</strong></td>
                            <td>' . $hotel_details->check_in . '</td>
                        </tr>
                        <tr>
                            <td><strong>No. of Children</strong></td>
                            <td>' . $hotel_details->child . '</td>
                            <td><strong>Check - out</strong></td>
                            <td>' . $hotel_details->check_out . '</td>
                        </tr>
                        <tr>
                            <td><strong>Voucher Date</strong></td>
                            <td>' . $hotel_details->booking_date . '</td>
                            <td><strong>Rooms</strong></td>
                            <td>' . $hotel_details->room_count . '</td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>

                            <td><strong>Nights</strong></td>
                            <td>' . $hotel_details->nights . '</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="ticket_header"><strong>Hotel Details</strong></div>
            <div class="hotel_details">
                <div>
                    <table cellpadding="5" cellspacing="5">
                        <tr>
                            <td><img src="' . $hotel_details->image_url . '" width="100px" height="100px"/></td>
                            <td>
                                <table>
                                    <tr><td><strong>Hotel Name</strong></td><td>' . $hotel_details->hotel_name . '</td></tr>
                                    <tr><td><strong>Description</strong></td><td align="justify">' . $hotel_details->discription . '</td></tr>

                                </table>
                            </td>
                        </tr>
                    </table>

                </div>
                <div>
                    <table width="100%" cellspacing="5" cellpadding="5">
                        <tr>
                            <td><strong>Address :</strong></td>
                            <td>' . $hotel_details->address . '</td>
                        </tr>
                        <tr>
                            <td><strong>City</strong></td>
                            <td>' . $hotel_details->city . '</td>
                        </tr>
                        <tr>
                            <td><strong>Phone</strong></td>
                            <td>' . $hotel_details->phoneno . '</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="ticket_header"><strong>Room Details</strong></div>
            <div class="hotel_details">
                Room Type: ' . $hotel_details->roomtypename . '

            </div>
            <div class="ticket_header"><strong>Fare Summary</strong></div>
            <div class="hotel_details">
                <table width="100%" cellspacing="5" cellpadding="5" align="left">
                    <tr>
                        <th>Price</th>
                        <td>' . $hotel_details->currency . ' ' . $hotel_details->total_price . '</td>
                    </tr>
                </table> 

            </div>';
        if ($hotel_details->cancel_poly_nonrefund) {
            $msgbody.='<div class="ticket_header"><strong>Cancellation Policy</strong></div>
                <div class="hotel_details">
                    <table width="100%">
                        <tr><td width="30%"><strong>Non Refundable: </strong></td><td width="70%">' . $hotel_details->cancel_poly_nonrefund . '</td></tr>
                        <tr><td width="30%"><strong>Description: </strong></td><td width="70%">' . $hotel_details->cancellation_disc . '</td></tr>

                    </table>
                </div>';
        }

        $msgbody.='            
<div class="ticket_header"><strong>Passenger Details</strong></div>
            <div class="hotel_details">
                <table width="60%" cellspacing="5" cellpadding="5">';

        foreach ($passenger_details as $val5) {
            $catageory = $val5->pass_type;
            if ($catageory == "ADT") {

                $msgbody.='  <tr>
                                <td>' . $val5->title . '</td>
                                <td>' . $val5->first_name . '</td>
                                <td>' . $val5->middle_name . '</td>
                                <td>' . $val5->last_name . '</td>
                            </tr>
';
            } else {
                $msgbody.='  <tr>
                                <td>' . $val5->title . '</td>
                                <td>' . $val5->first_name . '</td>
                                <td>' . $val5->middle_name . '</td>
                                <td>' . $val5->last_name . '</td>
                            </tr>';
            }
        }

        $msgbody.='

                </table>
            </div>
           
        </div>

';

        $curr_date = date("d/m/Y");
        $ci = get_instance();
        $ci->load->library('email');
        $ci->email->from('it@roombooking.in', 'Roombooking');
        $list = $email_id;
        $ci->email->to($list);
        $this->email->reply_to($list);
        $ci->email->subject('E-Ticket');
        $ci->email->message($msgbody);
        $ci->email->send();
        // exit;
        //echo $this->email->print_debugger();
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
        //echo $xml_data;//exit;
        $availability_resp = $this->PostRQ($xml_data);
        //echo '<pre>';print_r($availability_resp);exit;
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
//exit;
                //-----extracting data from the xml file and inserting in to api permanent table 
                // calculating price
                $price_Amount1 = $price_Amount * $room_count;

                ///////////////////////////////////////////////////////////////////////////// Adding Markup Price Mark Up Price /////////////////////////////////////

                $agent_no = $this->session->userdata('agent_no');
                $admin_markup = '0';
                $agent_markup = '0';
                $total_amount = '0';
                //echo '<pre>';            print_r($agent_no); exit;
                $b2b_markup = $this->Roomsxml_Model->get_b2b_markup($agent_no);
                $admin_markup_val = $b2b_markup->markup;
                $agent_markup_val = $this->Roomsxml_Model->get_agent_markup($agent_no);
                //echo '<pre>';            print_r($agent_markup_val->markup); exit;

                $admin_markup = round(($price_Amount1 * ($admin_markup_val / 100)), 2);
                $agent_markup = round((($price_Amount1 + $admin_markup) * ($agent_markup_val->markup / 100)), 2);
                $total_amount = $price_Amount1 + $admin_markup + $agent_markup;
                ///////////////////////////////////////////////////////////////////////////// Adding Markup Price Mark Up Price /////////////////////////////////////
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
                    'adult' => '',
                    'child' => '',
                    'room_count' => $room_count,
                    'markup' => '',
                    'org_amt' => $price_Amount,
                    'xml_currency' => $price_Currency,
                    'currency_val' => $price_Amount,
                    'payment_charge' => '',
                    'city' => $city['0'],
                    'cancel_policy' => ''
                );
                $ro++;
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

    function rooms_reservation() {
        $pass = $this->session->userdata('final_book_info');
        $payment_type = $pass['payment_type'];
        $total_amount = $pass['total_price'];
        if ($payment_type == 'payu') {
            $mihpayid = trim($_REQUEST['mihpayid']);
            $status = trim($_REQUEST['status']);
            $txnid = trim($_REQUEST['txnid']);
            $amount = trim($_REQUEST['amount']);
            $discount = trim($_REQUEST['discount']);
            $net_amount_debit = trim($_REQUEST['net_amount_debit']);
            $addedon = trim($_REQUEST['addedon']);
            $productinfo = trim($_REQUEST['productinfo']);
            $hash = trim($_REQUEST['hash']);
            $field1 = trim($_REQUEST['field1']);
            $payment_source = trim($_REQUEST['payment_source']);
            $PG_TYPE = trim($_REQUEST['PG_TYPE']);
            $bank_ref_num = trim($_REQUEST['bank_ref_num']);
            $bankcode = trim($_REQUEST['bankcode']);
            $error = trim($_REQUEST['error']);
            $error_Message = trim($_REQUEST['error_Message']);
            $cardnum = trim($_REQUEST['cardnum']);

            $pay_detail_id = $this->Hotel_Model->pay_details($mihpayid, $status, $txnid, $amount, $discount, $net_amount_debit, $addedon, $productinfo, $hash, $field1, $payment_source, $PG_TYPE, $bank_ref_num, $bankcode, $error, $error_Message, $cardnum);
            if ($status != 'success') {
                $error = base64_encode($error);
                redirect('hotel/error_page/' . $error);
            }
        } else if ($payment_type == 'deposit') {
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//        $desc = 'Towards Hotel Booking: ' . $result_id . '-' . $parent_transaction_id;
//
//        $this->Hotel_Model->update_transaction_amount($agent_id, $agent_no, $amount, $desc, $parent_transaction_id);
            $agent_no = $this->session->userdata('agent_no');
            $agent_id = $this->session->userdata('agent_id');
            $agent_available_balance = $this->Hotel_Model->get_agent_available_balance($agent_no);

            $available_balance = $agent_available_balance->closing_balance;

            $withdraw_amount = $total_amount;
            $closing_balance = $available_balance - $withdraw_amount;
///////////////////////////////////////////////////////

            $update = $this->Hotel_Model->insert_withdraw_status($agent_id, $agent_no, $withdraw_amount, $closing_balance);

            $sum_withdraw = $this->Hotel_Model->get_sum_of_withdraws($agent_no);


////////////////////////////        

            $this->Hotel_Model->update_agent_withdraw_amount($agent_no, $sum_withdraw, $closing_balance);


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //echo $user_id; exit;
        }

        $api = $this->input->post('api');
        $admin_markup = $this->input->post('admin_markup');
        $agent_markup = $this->input->post('agent_markup');
        $total_price = $this->input->post('total_price');
        $total_price = $this->input->post('total_price');
        $user_email = $this->input->post('user_email');
        $payment_charge = '0';
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

        if ($this->session->userdata('agent_logged_in')) {
            $agent_id = $this->session->userdata('agent_id');
            $Booking_Done_By = 'agent';
        } else {
            $agent_id = 0;
            $Booking_Done_By = 'guest';
        }
        $Booking_Date = date('Y-m-d');
        $RefNo = $this->generateRandomString(8);
        $api = 'roomsxml';
        // HOTEL BOOKING REPORT DATA
        $this->Roomsxml_Model->insert_booking_report_data($agent_id, $CommitLevel, $Book_reference, $RefNo, $Booking_Date, $Book_hotelid, $Book_currency, $admin_markup, $agent_markup, $Book_totamnt, $total_price, $Book_Status, $Book_PayableBy, $Book_VoucherRef, $Booking_Done_By, $api);
        $hoteldetails = $this->Roomsxml_Model->get_hotel_details($Book_Hotelcode);
        $hotel_search_data = $this->session->userdata('hotel_search_data');
        $checkIn = date('Y-m-d', strtotime(str_replace("/", "-", $hotel_search_data['checkin'])));
        $checkOut = date('Y-m-d', strtotime(str_replace("/", "-", $hotel_search_data['checkout'])));
        $this->Roomsxml_Model->insert_hotel_booking_information_data($RefNo, $Book_Hotelcode, $Book_HotelName, $hotel_search_data['city'], $checkIn, $checkOut, $Booking_Date, $Book_RoomTypeval, $hotel_search_data['room_count'], $Book_Nights, 'roomsxml', $hotel_search_data['adultvalue'], $hotel_search_data['childvalue'], $hoteldetails->star, $hoteldetails->image, $hoteldetails->description, $hoteldetails->address, $hoteldetails->phone, $hoteldetails->fax, $hotel_search_data['adult_count'], $hotel_search_data['child_count'], $agent_id);
        //$this->ticket_email($RefNo, $Book_reference);

        redirect('hotel/voucher?voucherId=' . $RefNo . '&Booking_RefNo=' . $Book_reference, 'refresh');
    }

    //**************PLEASE DO NOT MODIFY ANY CODE ROOMSXML API INTEGRATION CODE ENDS HERE**************************************
    // ----------------------------ACE ROOMS CODE DO NOT MODIFY-------------------------------------------//
    function ace_rooms_search_availablility() {
//echo '123';exit;
        //set ACE ROOMS XML VARIABLE
        $this->ace_set_variables();

        $city_code = $this->Acerooms_Model->aceroom_citycode($this->city_name);
        $pass = '';
        for ($r = 0; $r < $this->rooms; $r++) {
            $pass.='<Roominfo>';
            // ADULT
            if ($this->adults[$r] == '1') {
                $pass.='<adult>Single</adult>';
            } elseif ($this->adults[$r] == '2') {
                $pass.='<adult>Double</adult>';
            } elseif ($this->adults[$r] == '3') {
                $pass.='<adult>Triple</adult>';
            } elseif ($this->adults[$r] == '4') {
                $pass.='<adult>Quad</adult>';
            } elseif ($this->adults[$r] == '5') {
                $pass.='<adult>5Adults</adult>';
            } elseif ($this->adults[$r] == '6') {
                $pass.='<adult>6Adults</adult>';
            }


            //CHILD
            if ($this->childs[$r] == '0') {
                $pass.='<childcount>0</childcount>';
            } elseif ($this->childs[$r] == '1') {
                $pass.='<childcount>1</childcount>
                   <childage>
                   <int>5</int>
                   </childage>';
            } elseif ($this->childs[$r] == '2') {
                $pass.='<childcount>2</childcount>
                   <childage>
                   <int>5</int>
                   <int>5</int>
                   </childage>';
            } elseif ($this->childs[$r] == '3') {
                $pass.='<childcount>3</childcount>
                   <childage>
                   <int>5</int>
                   <int>5</int>
                   <int>5</int>
                   </childage>';
            }
            $pass.='</Roominfo>';
        }

        $xml_data = '
            <soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
    <soap:Body> 
    <SearchHotels xmlns="http://tempuri.org/">
<lg>
<UserName>' . $this->aruserID . '</UserName>
<Password>' . $this->arpassword . '</Password>
</lg>
<cityid>' . $city_code->city_id . '</cityid>
<checkin>' . $this->cin . '</checkin>
<noofnights>' . $this->nights . '</noofnights>
<rooms>
' . $pass . '
</rooms>
</SearchHotels>
    </soap:Body> 
</soap:Envelope>
';
        // echo $xml_data.'<br><br><br><br>';//exit;

        $search_response = $this->ace_postRQ($xml_data);
        //  echo '<pre>';print_r($search_response);exit;
        $dom2 = new DOMDocument();
        $dom2->loadXML($search_response);
        $Hotels = $dom2->getElementsByTagName("Hotels");
        $h = 0;
        $inser_data = array();
        foreach ($Hotels as $val) {

            $SearchTokenID = $val->getElementsByTagName("SearchTokenID")->item(0)->nodeValue;

            //           $HotelInfo = $val->getElementsByTagName("HotelInfo");
            //           foreach ($HotelInfo as $val1) {
//                $HotelID = $val1->getElementsByTagName('HotelID')->item(0)->nodeValue;
//                $HotelName = $val1->getElementsByTagName('HotelName')->item(0)->nodeValue;
//                $HotelStar = $val1->getElementsByTagName('HotelStar')->item(0)->nodeValue;
            //               $CurrencyCode = $val1->getElementsByTagName('CurrencyCode')->item(0)->nodeValue;

            $CurrencyCode = 'GBP';
            $RoomsInfo = $val->getElementsByTagName("RoomsInfo");
            foreach ($RoomsInfo as $val2) {
                $rHotelID = $val2->getElementsByTagName('HotelID')->item(0)->nodeValue;
                //     if ($rHotelID == $HotelID) {
                $ContractID = $val2->getElementsByTagName('ContractID')->item(0)->nodeValue;
                $RoomNo = $val2->getElementsByTagName('RoomNo')->item(0)->nodeValue;
                $RoomID = $val2->getElementsByTagName('RoomID')->item(0)->nodeValue;
                $RoomText = $val2->getElementsByTagName('RoomText')->item(0)->nodeValue;
                $BoardText = $val2->getElementsByTagName('BoardText')->item(0)->nodeValue;
                $RoomDescription = $val2->getElementsByTagName('RoomDescription')->item(0)->nodeValue;
                $AdultCount = $val2->getElementsByTagName('AdultCount')->item(0)->nodeValue;
                $ChildCount = $val2->getElementsByTagName('ChildCount')->item(0)->nodeValue;
                $Price = $val2->getElementsByTagName('Price')->item(0)->nodeValue;

                $inser_data[$h] = array(
                    'session_id' => $this->sess_id,
                    'api' => 'acerooms',
                    'hotel_code' => $rHotelID,
                    'searchtokenid' => $SearchTokenID,
                    'room_code' => $RoomID,
                    'room_type' => $RoomText,
                    'roomno' => $RoomNo,
                    'contractID' => $ContractID,
                    'inclusion' => $BoardText,
                    'cost' => $Price,
                    'net_cost' => $Price,
                    'total_cost' => $Price,
                    'xml_currency' => $CurrencyCode,
                    'room_count' => $this->rooms
                );
                $h++;
                //    }
            }

            // IF REQUIRED HERE WILL BE THE DATA INSERTING TO THE PERMANENET TABLE
            //    }
        }
        $this->Acerooms_Model->delete_acetemp_results($this->sess_id);
        if (!empty($inser_data)) {
            $this->Acerooms_Model->insertacerooms($inser_data);
        }
    }

    function ace_postRQ($xml_data) {
        $ch2 = curl_init();
        curl_setopt($ch2, CURLOPT_URL, $this->arURL);
        curl_setopt($ch2, CURLOPT_TIMEOUT, 0);
        curl_setopt($ch2, CURLOPT_HEADER, 0);
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch2, CURLOPT_POST, 1);
        curl_setopt($ch2, CURLOPT_POSTFIELDS, $xml_data);
        curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch2, CURLOPT_SSLVERSION, 3);
//curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, true);

        $httpHeader2 = array("Content-Type: text/xml; charset=UTF-8", "Content-Encoding: UTF-8");
        curl_setopt($ch2, CURLOPT_HTTPHEADER, $httpHeader2);
        curl_setopt($ch2, CURLOPT_ENCODING, "gzip");

// Execut	e request, store response and HTTP response code
        $data2 = curl_exec($ch2);
        $error2 = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
        curl_close($ch2);
        return $data2;
    }

    public function ace_set_variables() {
        $session_data = $this->session->userdata('hotel_search_data');
        $this->city_name = $session_data['city'];
        $this->cin = $session_data['checkin'];
        $this->cout = $session_data['checkout'];
        $this->rooms = $session_data['room_count'];
        $this->nights = $session_data['noofnights'];
        $this->adults = $session_data['adultvalue'];
        $this->childs = $session_data['childvalue'];
    }

    function get_acerooms_detail($hotel_code) {
        $ace['hotel_full'] = $this->Acerooms_Model->get_ace_detail($hotel_code);
        $ace['hotel_image'] = $this->Acerooms_Model->get_ace_images($hotel_code);
        return $ace;
    }

    function aceroom_selectroom($bookd) {
        //  $bookd=array('tokenid'=>$details->searchtokenid,'hotelcode'=>$details->hotel_code,'roomno'=>$details->roomno,'roomid'=>$details->room_code,);
        $hotel_search_data = $this->session->userdata('hotel_search_data');
        $roo = '';
        for ($r = 0; $r < $hotel_search_data['room_count']; $r++) {
            $roo.='
<ResRooms>
<RoomNo>' . $bookd["roomno"] . '</RoomNo>
<RoomID>' . $bookd["roomid"] . '</RoomID>
<ContractID>' . $bookd["contractid"] . '</ContractID>
</ResRooms>                
';
        }

        $xml_data = '
            <soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
    <soap:Body> 
    <SelectHotel xmlns="http://tempuri.org/">
<lg>
<UserName>' . $this->aruserID . '</UserName>
<Password>' . $this->arpassword . '</Password>
</lg>
<SearchtokenID>' . $bookd["tokenid"] . '</SearchtokenID>
<hotelID>' . $bookd["hotelcode"] . '</hotelID>
<rooms>
' . $roo . '
</rooms>
</SelectHotel>
    </soap:Body> 
</soap:Envelope>
';
        //   echo $xml_data;//exit;
        $detail_response = $this->ace_postRQ($xml_data);
        //echo '<pre>';print_r($detail_response);exit;
        $dom2 = new DOMDocument();
        $dom2->loadXML($detail_response);

        if ($dom2->getElementsByTagName("ErrorMessage")->item(0)->nodeValue) {
            redirect('hotel/error_page/' . base64_encode('Somethisn Went Wrong'));
        }
        $Hotels = $dom2->getElementsByTagName("Hotels");
        $h = 0;
        $inser_data = array();
        foreach ($Hotels as $val) {

            $PurchaseTokenID = $val->getElementsByTagName("PurchaseTokenID")->item(0)->nodeValue;
            $Remarks = $val->getElementsByTagName("Remarks")->item(0)->nodeValue;
        }
        $this->Acerooms_Model->update_ace_cancel_remarks($bookd['searchid'], $bookd["hotelcode"], $bookd["roomno"], $Remarks, $PurchaseTokenID);
    }

    function ace_reservation($hotel_code) {

        $hotel_search_data = $this->session->userdata('hotel_search_data');
        $pass_info = $this->session->userdata('passenger_info');

        //$agen_ref_no_v1 = 'AL'.time('his');	
        $agen_ref_no_v1 = 'IW' . substr(number_format(time() * rand(), 0, '', ''), 0, 10);
        $guest = '';
        for ($r = 0; $r < $hotel_search_data['room_count']; $r++) {

            $roomn = $r + 1;
            // adult loop
            for ($a = 0; $a < $hotel_search_data['adultvalue'][$r]; $a++) {
                $guest.= ' 
               <CustomerInfo>
               <RoomNo>' . $roomn . '</RoomNo>
               <Title>' . $pass_info['adults_title'][$a] . '</Title>
               <FirstName>' . $pass_info['adults_fname'][$a] . '</FirstName>
               <LastName>' . $pass_info['adults_lname'][$a] . '</LastName>
               </CustomerInfo>
               ';
            }


            // child loop
            // if()
            for ($a = 0; $a < $hotel_search_data['childs_fname'][$r]; $a++) {
                $guest.= ' 
<CustomerInfo>
<RoomNo>' . $roomn . '</RoomNo>
<Title>' . $pass_info['childs_title'][$a] . '</Title>
<FirstName>' . $pass_info['childs_fname'][$a] . '</FirstName>
<LastName>' . $pass_info['childs_lname'][$a] . '</LastName>
</CustomerInfo>
               ';
            }
        }

        $xml_data = '
            <soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
    <soap:Body> 
    <BookHotel xmlns="http://tempuri.org/">
<lg>
<UserName>' . $this->aruserID . '</UserName>
<Password>' . $this->arpassword . '</Password>
</lg>
<PurchasetokenID>' . $pass_info['booking_id'] . '</PurchasetokenID>
<EmailID></EmailID> 
<AgentRef></AgentRef> 
<SpecialRequest></SpecialRequest> 
<custinfo>
' . $guest . '
</custinfo>
</BookHotel>
</soap:Body> 
</soap:Envelope>
';

        // echo $xml_data; //exit;
        $booking_response = $this->ace_postRQ($xml_data);

        $dom2 = new DOMDocument();
        $dom2->loadXML($booking_response);
        $Booking = $dom2->getElementsByTagName("Booking");

        foreach ($Booking as $val) {
            $BookingInfo = $val->getElementsByTagName("BookingInfo");
            foreach ($BookingInfo as $val1) {
                $BookingrefID = $val->getElementsByTagName("BookingID")->item(0)->nodeValue;
                $BookingDate = $val->getElementsByTagName("BookingDate")->item(0)->nodeValue;
                $BookingStatus = $val->getElementsByTagName("BookingStatus")->item(0)->nodeValue;
            }
            $HotelInfo = $val->getElementsByTagName("HotelInfo");
            foreach ($HotelInfo as $val2) {
                $HotelName = $val2->getElementsByTagName("HotelName")->item(0)->nodeValue;
                $HotelAddress = $val2->getElementsByTagName("HotelAddress")->item(0)->nodeValue;
                $ArrivalDate = $val2->getElementsByTagName("ArrivalDate")->item(0)->nodeValue;
                $Nights = $val2->getElementsByTagName("Nights")->item(0)->nodeValue;
                $RoomCount = $val2->getElementsByTagName("RoomCount")->item(0)->nodeValue;
                $Currency = $val2->getElementsByTagName("Currency")->item(0)->nodeValue;
                $Book_totamnt = $val2->getElementsByTagName("Price")->item(0)->nodeValue;
            }
            $RoomsInfo = $val->getElementsByTagName("RoomsInfo");
            foreach ($RoomsInfo as $val3) {
                $RoomtypeText = $val3->getElementsByTagName("RoomText")->item(0)->nodeValue;
                $BoardText = $val3->getElementsByTagName("BoardText")->item(0)->nodeValue;
                $HotelRef = $val3->getElementsByTagName("HotelRef")->item(0)->nodeValue;
                break;
            }
            if ($val->getElementsByTagName("HotelRemarks")) {
                $HotelRemarks = $val->getElementsByTagName("HotelRemarks");
                foreach ($HotelRemarks as $val4) {
                    $Remarks = $val4->getElementsByTagName("Remarks")->item(0)->nodeValue;
                    break;
                }
            } else {
                $Remarks = '';
            }
        }


//        if ($BookingStatus != 'Confirmed') {
//            $BookingStatus = 'Failed';
//            $BookingrefID = 'XXXXXXXXXXX';
//            $Book_Status = 'Failed';
//            $book_noval = 'XXXXXXXXXXX';
//        }

        if ($this->session->userdata('user_logged_in')) {
            $user_id = $this->session->userdata('user_id');
            $Booking_Done_By = 'user';
        } else {
            $user_id = 0;
            $Booking_Done_By = 'guest';
        }

        $Booking_Date = date('Y-m-d');
        $RefNo = $this->generateRandomString(8);
        // HOTEL BOOKING REPORT DATA
        $booking_report = array(
            'user_id' => $user_id,
            'Hotel_RefNo' => $BookingrefID,
            'Booking_RefNo' => $BookingrefID,
            '$RefNo' => $RefNo,
            'Booking_Status' => $BookingStatus,
            'Booking_Date' => $Booking_Date,
            'Booking_Amount' => $Book_totamnt,
            'Currecy' => $Currency,
            'Xml_Currency' => $Currency,
            'Booking_Done_By' => $Booking_Done_By,
        );
        $this->Acerooms_Model->insert_booking_report_data($booking_report);

        $hoteldetails = $this->Acerooms_Model->get_acehotel_details($hotel_code);
        $hotel_search_data = $this->session->userdata('hotel_search_data');
        // Hotel Booking Hotels Information Data
        $checkIn = date('Y-m-d', strtotime(str_replace("/", "-", $hotel_search_data['checkin'])));
        $checkOut = date('Y-m-d', strtotime(str_replace("/", "-", $hotel_search_data['checkout'])));

        $this->Acerooms_Model->insert_hotel_booking_information_data($RefNo, $hotel_code, $HotelName, $hotel_search_data['city'], $checkIn, $checkOut, $Booking_Date, $RoomtypeText, $hotel_search_data['room_count'], $Nights, 'acerooms', $hotel_search_data['adultvalue'], $hotel_search_data['childvalue'], $hoteldetails->star, $hoteldetails->description, $hoteldetails->address, $hoteldetails->phone, $hoteldetails->fax, $hotel_search_data['adult_count'], $hotel_search_data['child_count'], $Remarks);

        redirect('hotel/voucher?voucherId=' . $RefNo . '&Booking_RefNo=' . $BookingrefID, 'refresh');

        //   return $booking_response;
    }

    function jac_hotel_availabilty() {

        //echo '<pre>';print_r($this->session->all_userdata());
        //  exit;

        $hotel_search_data = $this->session->userdata('hotel_search_data');
        $city = explode(',', $hotel_search_data['city']);
        $city_code = $city['0'];

        $checkins = explode('/', $hotel_search_data['checkin']);
        $checkin = $checkins['2'] . '-' . $checkins['1'] . '-' . $checkins['0'];
        $checkin = date('d M Y', strtotime($checkin));
        $noofnights = $hotel_search_data['noofnights'];
        $room_count = $hotel_search_data['room_count'];
        $adult_value = $hotel_search_data['adultvalue'];
        $child_value = $hotel_search_data['childvalue'];
        $adultCount = $hotel_search_data['adult_count'];
        $childCount = $hotel_search_data['child_count'];
        $jacnight = $noofnights - 1;

        // calculating rooms
        $rooms_data = '';

        for ($r = 0; $r < $room_count; $r++) {
            $cloop = '';
            //child
            if ($child_value[$r] != 0) {
                $cloop = '
                    <CHILDREN>
                    <CHILD_RATE CHILD_QUANTITY="' . $child_value[$r] . '" CHILD_AGE="11"/>
                    </CHILDREN>
';
            }
            if ($adult_value[$r] == 1) {
                $occ = '1';
            } elseif ($adult_value[$r] == 2 && $child_value[$r] == 0) {
                $occ = '3';
            } elseif ($adult_value[$r] == 3) {
                $occ = '4';
            } elseif ($adult_value[$r] == 4) {
                $occ = '5';
            } elseif ($adult_value[$r] == 2 && $child_value[$r] == 1) {
                $occ = '7';
            } elseif ($adult_value[$r] == 2 && $child_value[$r] == 2) {
                $occ = '8';
            }
            $rooms_data.='<ROOM>
            <OCCUPANCY>' . $occ . '</OCCUPANCY>
            <QUANTITY>1</QUANTITY>
            ' . $cloop . '
            </ROOM>';
        }


        //echo '<pre>';print_r($rooms_data);exit;
        //echo 'Here'; exit;

        $xml_data = '<SERVICE_SEARCH_REQUEST>
				<VERSION_HISTORY APPLICATION_NAME="TSAPI API 1.0" XML_FILE_NAME="SERVICE_SEARCH_REQUEST.xml" LICENCE_KEY="' . $this->jkey . '" TS_API_VERSION="v3.5.5" >
				<XML_VERSION_NO>1.0</XML_VERSION_NO>
				</VERSION_HISTORY>
				<GEO_LOCATION_NAME>' . $city_code . '</GEO_LOCATION_NAME>
				<START_DATE>' . $checkin . '</START_DATE>
				<NUMBER_OF_NIGHTS>' . $jacnight . '</NUMBER_OF_NIGHTS>
				<AVAILABLE_ONLY>true</AVAILABLE_ONLY>
				<GET_START_PRICE>true</GET_START_PRICE>
					<ROOMS_REQUIRED>' . $rooms_data . '</ROOMS_REQUIRED>
				</SERVICE_SEARCH_REQUEST>';

        // echo $xml_data; //exit;

        $response = $this->postjac($xml_data, $this->jsearchURL);
        //  echo '<pre/>';print_r($response);//exit;

        if (!empty($response)) {
            $dom = new DOMDocument();
            $dom->loadXML($response);
            //echo '<pre>ds'; exit;
            $SERVICE = $dom->getElementsByTagName("SERVICE");
            $i = 0;
            $h = 0;
            $inser_jac = array();

            foreach ($SERVICE as $SERVICEval) {
                $SERVICE_ID = $SERVICE->item($i)->getAttribute("SERVICE_ID");
                $SERVICE_NAME = $SERVICE->item($i)->getAttribute("SERVICE_NAME");
                $RATING = $SERVICE->item($i)->getAttribute("RATING");
                $LOCATION = $SERVICE->item($i)->getAttribute("LOCATION");
                $AVAILABLE = $SERVICE->item($i)->getAttribute("AVAILABLE");
                $ISRECOMMENDEDPRODUCT = $SERVICE->item($i)->getAttribute("ISRECOMMENDEDPRODUCT");
                $STARTING_PRICE = $SERVICE->item($i)->getAttribute("STARTING_PRICE");
                $CURRENCY = $SELL_CURRENCY_CODE = $SERVICE->item($i)->getAttribute("CURRENCY");
//echo 'hjdsk'; exit;
                $OPTIONS = $SERVICEval->getElementsByTagName("OPTIONS");
                foreach ($OPTIONS as $OPTIONSval) {
                    $OPTION = $OPTIONSval->getElementsByTagName("OPTION");
                    foreach ($OPTION as $OPTIONval) {
                        $optid = $OPTIONval->getElementsByTagName("OPTIONID");
                        $OPTIONID = $optid->item(0)->nodeValue;

                        $optname = $OPTIONval->getElementsByTagName("OPTION_NAME");
                        $OPTION_NAME = $optname->item(0)->nodeValue;

                        $min_adult = $OPTIONval->getElementsByTagName("MinAdult");
                        $MinAdult = $min_adult->item(0)->nodeValue;

                        $max_adult = $OPTIONval->getElementsByTagName("MaxAdult");
                        $MaxAdult = $max_adult->item(0)->nodeValue;

                        $min_child = $OPTIONval->getElementsByTagName("MinChild");
                        $MinChild = $min_child->item(0)->nodeValue;

                        $max_child = $OPTIONval->getElementsByTagName("MaxChild");
                        $MaxChild = $max_child->item(0)->nodeValue;

                        $child_max_age = $OPTIONval->getElementsByTagName("ChildMaxAge");
                        $ChildMaxAge = $child_max_age->item(0)->nodeValue;

                        $occ = $OPTIONval->getElementsByTagName("OCCUPANCY");
                        $OCCUPANCY = $occ->item(0)->nodeValue;

                        $opt_status = $OPTIONval->getElementsByTagName("OPTION_STATUS");
                        $OPTION_STATUS = $opt_status->item(0)->nodeValue;

                        $prices = $OPTIONval->getElementsByTagName("PRICES");
                        $adult_amt = 0;
                        $adult_amt1 = 0;
                        $TOTADULT = 0;
                        $TOTCHILD = 0;
                        $ROOM_QUANTITY = 0;
                        $tot_amount1 = 0;
                        $SELL_PRICE_ID_SM = '';
                        foreach ($prices as $pricesval) {
                            $price = $pricesval->getElementsByTagName("PRICE");
                            //echo '<pre>'; print_r($price); exit;
                            foreach ($price as $priceval) {
                                $price_date = $priceval->getElementsByTagName("PRICE_DATE");
                                $PRICE_DATE = $price_date->item(0)->nodeValue;

                                $sell_price_id = $priceval->getElementsByTagName("SELL_PRICE_ID");
                                $SELL_PRICE_ID = $sell_price_id->item(0)->nodeValue;
                                if (!strstr($SELL_PRICE_ID_SM, $SELL_PRICE_ID)) {
                                    $SELL_PRICE_ID_SM .= $SELL_PRICE_ID . ',';
                                }

                                $sell_price_amt = $priceval->getElementsByTagName("SELL_PRICE_AMOUNT");
                                $SELL_PRICE_AMOUNT = $sell_price_amt->item(0)->nodeValue;

                                $sell_price_code = $priceval->getElementsByTagName("SELL_CURRENCY_CODE");
                                $SELL_PRICE_CODE = $sell_price_code->item(0)->nodeValue;

                                $meal_plan = $priceval->getElementsByTagName("MEAL_PLAN");
                                foreach ($meal_plan as $meal_planval) {
                                    $meal_plan_text = $meal_planval->getElementsByTagName("MEAL_PLAN_TEXT");
                                    $MEAL_PLAN = $meal_plan_text->item(0)->nodeValue;

                                    $meal_plan_type = $meal_planval->getElementsByTagName("MEAL_PLAN_TYPE");
                                    foreach ($meal_plan_type as $meal_plan_typeval) {
                                        $include_bkfast = $meal_plan_typeval->getElementsByTagName("INCLUDESBREAKFAST");
                                        $MEAL_PLAN_TYPE = $include_bkfast->item(0)->nodeValue;
                                        //echo '<pre>'; print_r($MEAL_PLAN_TYPE); exit;
                                    }
                                }

                                $child_prices = $priceval->getElementsByTagName("CHILD_PRICES");
                                $CHILD_PRICE = 0;
                                foreach ($child_prices as $child_pricesval) {

                                    $child_price = $child_pricesval->getElementsByTagName("CHILD_PRICE");
                                    foreach ($child_price as $child_priceval) {
                                        $cprice = $child_priceval->getElementsByTagName("SELL_PRICE_AMOUNT");
                                        $CHILD_PRICE1 = $cprice->item(0)->nodeValue;
                                        $CHILD_PRICE = $CHILD_PRICE + $CHILD_PRICE1;
                                    }
                                }

                                $ori_sell_price_amt = $priceval->getElementsByTagName("ORIGNAL_SELL_PRICE_AMOUNT");
                                $ORIGNAL_SELL_PRICE_AMOUNT = $ori_sell_price_amt->item(0)->nodeValue;

                                $tot_amount = $SELL_PRICE_AMOUNT + $CHILD_PRICE;
                                $tot_amount1 = $tot_amount1 + $tot_amount;
                            }
                        }

                        /// INSERTING DATA TO PERMANENT TABLE
                        $check = $this->Jac_Model->check_permanent($SERVICE_ID, 'jac'); //exit;
                        if ($check != '1') {
                            $hotdetils = $this->Jac_Model->fetch_jac_static($SERVICE_ID);
                            $this->Jac_Model->insert_permanent($hotdetils);
                        }
                        // INSERTING DATA TO PERMANENT TABLE

                        $inser_jac[$h] = array(
                            'session_id' => $this->sess_id,
                            'api' => 'jac',
                            'searchtokenid' => $PRICE_DATE,
                            'purchasetokenid' => $SELL_PRICE_ID_SM,
                            'hotel_code' => $SERVICE_ID,
                            'room_code' => $OPTIONID,
                            'room_type' => $OPTION_NAME,
                            'inclusion' => $MEAL_PLAN,
                            'cost' => $tot_amount1,
                            'net_cost' => $tot_amount1,
                            'total_cost' => $tot_amount1,
                            'xml_currency' => $SELL_PRICE_CODE,
                            'adult' => $adultCount,
                            'child' => $childCount,
                            'room_count' => $room_count,
                            'city' => $city_code,
                            'status' => $OPTION_STATUS
                        );
                        $h++;

                        //$this->Search_Model->insert_search_result_jac($api,$LOCATION,$SERVICE_ID,$SERVICE_NAME,$star,$pernight,$tot_amt,$CURRENCY,$OPTION_NAME,$MEAL_PLAN,$LOCATION,$common_commission,$OPTION_STATUS,$without_markup,$hoteldesc,$Image,$NumAdults,$Quantity,$roomID,$session,$MEAL_PLAN_TYPE,$tot_room,$cout,$cin,$jac_image,$SERVICELONGITUTE,$SERVICELATITUTE);
                    }
                }

                $i++;
            }
        }
        // DELETE TEMP RESULTS OF JAC        
        $this->Jac_Model->delete_hotel_temp_result($this->sess_id, 'jac');
        if (!empty($inser_jac)) {
            $this->Jac_Model->insert_temp_result($inser_jac);
        }
        return;
    }

    function postjac($xml_data, $url) {
        $ch2 = curl_init();
        curl_setopt($ch2, CURLOPT_URL, $url);
        curl_setopt($ch2, CURLOPT_TIMEOUT, 0);
        curl_setopt($ch2, CURLOPT_HEADER, 0);
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch2, CURLOPT_POST, 1);
        curl_setopt($ch2, CURLOPT_POSTFIELDS, $xml_data);
        curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch2, CURLOPT_SSLVERSION, 3);
        //curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, true);

        $httpHeader2 = array("Content-Type: text/xml; charset=UTF-8", "Content-Encoding: UTF-8");
        curl_setopt($ch2, CURLOPT_HTTPHEADER, $httpHeader2);
        curl_setopt($ch2, CURLOPT_ENCODING, "gzip");

        // Execut	e request, store response and HTTP response code
        $data2 = curl_exec($ch2);
        $error2 = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
        curl_close($ch2);
        $resp = str_replace('UTF-16', 'UTF-8', $data2);
        return $resp;
    }

    function get_jac_detail($hotel_code) {
        $ace['hotel_full'] = $this->Jac_Model->get_jac_detail($hotel_code);
        // $ace['hotel_image'] = $this->Jac_Model->get_ace_images($hotel_code);
        return $ace;
    }

    function jac_pricing($details) {

        //echo '<pre>';print_r($details);print_r($this->session->all_userdata());exit;
        $hotel_search_data = $this->session->userdata('hotel_search_data');

        $checkins = explode('/', $hotel_search_data['checkin']);
        $checkin = $checkins['2'] . '-' . $checkins['1'] . '-' . $checkins['0'];
        $checkin = date('d M Y', strtotime($checkin));

        $checkouts = explode('/', $hotel_search_data['checkout']);
        $checkout = $checkouts['2'] . '-' . $checkouts['1'] . '-' . $checkouts['0'];
        $checkout = date('d M Y', strtotime('-1 day', strtotime($checkout)));
        //   date('Y-m-d', strtotime('-1 day', strtotime($date_raw)))

        $noofnights = $hotel_search_data['noofnights'];
        $room_count = $hotel_search_data['room_count'];
        $adult_value = $hotel_search_data['adultvalue'];
        $child_value = $hotel_search_data['childvalue'];
        $adultCount = $hotel_search_data['adult_count'];
        $childCount = $hotel_search_data['child_count'];

        for ($r = 0; $r < $room_count; $r++) {
            $cloop = '';
            //child
            if ($child_value[$r] == 1) {
                $cloop = '
<NO_OF_CHILDREN>' . $child_value[$r] . '</NO_OF_CHILDREN>
<AGES_OF_CHILDREN>7</AGES_OF_CHILDREN>
';
            } elseif ($child_value[$r] == 2) {
                $cloop = '
<NO_OF_CHILDREN>' . $child_value[$r] . '</NO_OF_CHILDREN>
<AGES_OF_CHILDREN>7,7</AGES_OF_CHILDREN>
';
            }

            if ($adult_value[$r] == 1) {
                $occ = '1';
            } elseif ($adult_value[$r] == 2 && $child_value[$r] == 0) {
                $occ = '3';
            } elseif ($adult_value[$r] == 3) {
                $occ = '4';
            } elseif ($adult_value[$r] == 4) {
                $occ = '5';
            } elseif ($adult_value[$r] == 2 && $child_value[$r] == 1) {
                $occ = '7';
            } elseif ($adult_value[$r] == 2 && $child_value[$r] == 2) {
                $occ = '8';
            }
            $rooms_data.='<ROOM>
            <OCCUPANCY>' . $occ . '</OCCUPANCY>
            <QUANTITY>1</QUANTITY>
            <NO_OF_PASSENGERS>' . $adult_value[$r] . '</NO_OF_PASSENGERS>
            ' . $cloop . '
            </ROOM>';
        }


        $xml_data = '
<HOTEL_AVAILABILITY_AND_PRICE_SEARCH_CRITERIA>
<VERSION_HISTORY APPLICATION_NAME="TSAPI API 1.0" XML_FILE_NAME="SERVICE_SEARCH_REQUEST.xml" LICENCE_KEY="' . $this->jkey . '" TS_API_VERSION="v3.5.5" >
<XML_VERSION_NO>1.0</XML_VERSION_NO>
</VERSION_HISTORY>
<SERVICE_ID>' . $details->hotel_code . '</SERVICE_ID>
<BOOKING_START_DATE>' . $checkin . '</BOOKING_START_DATE>
<BOOKING_END_DATE>' . $checkout . '</BOOKING_END_DATE>
<ROOMS_REQUIRED>
' . $rooms_data . '
</ROOMS_REQUIRED>
</HOTEL_AVAILABILITY_AND_PRICE_SEARCH_CRITERIA>            
';
//echo $xml_data;
        $response = $this->postjac($xml_data, $this->jpriceURL);
//print_r($response);
        if (!empty($response)) {
            $dom = new DOMDocument();
            $dom->loadXML($response);
            //echo '<pre>ds'; exit;

            $i = 0;
            $h = 0;
            $rooms = array();
//echo 'hjdsk'; exit;
            $SERVICE_ID = $dom->getElementsByTagName("SERVICE_ID")->item(0)->nodeValue;
            $OPTIONS = $dom->getElementsByTagName("OPTIONS");
            foreach ($OPTIONS as $OPTIONSval) {
                $OPTION = $OPTIONSval->getElementsByTagName("OPTION");
                foreach ($OPTION as $OPTIONval) {
                    $optid = $OPTIONval->getElementsByTagName("OPTIONID");
                    $OPTIONID = $optid->item(0)->nodeValue;

                    $optname = $OPTIONval->getElementsByTagName("OPTION_NAME");
                    $OPTION_NAME = $optname->item(0)->nodeValue;

                    $prices = $OPTIONval->getElementsByTagName("PRICES");
                    $adult_amt = 0;
                    $adult_amt1 = 0;
                    $TOTADULT = 0;
                    $TOTCHILD = 0;
                    $ROOM_QUANTITY = 0;
                    $tot_amount1 = 0;
                    $SELL_PRICE_ID_SM = '';
                    foreach ($prices as $pricesval) {
                        $price = $pricesval->getElementsByTagName("PRICE");
                        //echo '<pre>'; print_r($price); exit;
                        foreach ($price as $priceval) {
                            $price_date = $priceval->getElementsByTagName("PRICE_DATE");
                            $PRICE_DATE = $price_date->item(0)->nodeValue;

                            $sell_price_id = $priceval->getElementsByTagName("SELL_PRICE_ID");
                            $SELL_PRICE_ID = $sell_price_id->item(0)->nodeValue;
                            if (!strstr($SELL_PRICE_ID_SM, $SELL_PRICE_ID)) {
                                $SELL_PRICE_ID_SM .= $SELL_PRICE_ID . ',';
                            }

                            $sell_price_amt = $priceval->getElementsByTagName("SELL_PRICE_AMOUNT");
                            $SELL_PRICE_AMOUNT = $sell_price_amt->item(0)->nodeValue;

                            $sell_price_code = $priceval->getElementsByTagName("SELL_CURRENCY_CODE");
                            $SELL_PRICE_CODE = $sell_price_code->item(0)->nodeValue;

                            $meal_plan = $priceval->getElementsByTagName("MEAL_PLAN");
                            foreach ($meal_plan as $meal_planval) {
                                $meal_plan_text = $meal_planval->getElementsByTagName("MEAL_PLAN_TEXT");
                                $MEAL_PLAN = $meal_plan_text->item(0)->nodeValue;

                                $meal_plan_type = $meal_planval->getElementsByTagName("MEAL_PLAN_TYPE");
                                foreach ($meal_plan_type as $meal_plan_typeval) {
                                    $include_bkfast = $meal_plan_typeval->getElementsByTagName("INCLUDESBREAKFAST");
                                    $MEAL_PLAN_TYPE = $include_bkfast->item(0)->nodeValue;
                                    //echo '<pre>'; print_r($MEAL_PLAN_TYPE); exit;
                                }
                            }

                            $child_prices = $priceval->getElementsByTagName("CHILD_PRICES");
                            $CHILD_PRICE = 0;
                            foreach ($child_prices as $child_pricesval) {

                                $child_price = $child_pricesval->getElementsByTagName("CHILD_PRICE");
                                foreach ($child_price as $child_priceval) {
                                    $cprice = $child_priceval->getElementsByTagName("SELL_PRICE_AMOUNT");
                                    $CHILD_PRICE1 = $cprice->item(0)->nodeValue;
                                    $CHILD_PRICE = $CHILD_PRICE + $CHILD_PRICE1;
                                }
                            }

                            $ori_sell_price_amt = $priceval->getElementsByTagName("ORIGNAL_SELL_PRICE_AMOUNT");
                            $ORIGNAL_SELL_PRICE_AMOUNT = $ori_sell_price_amt->item(0)->nodeValue;

                            $tot_amount = $SELL_PRICE_AMOUNT + $CHILD_PRICE;
                            $tot_amount1 = $tot_amount1 + $tot_amount;
                        }
                    }

                    $rooms[$h] = array(
                        'hotel_code' => $SERVICE_ID,
                        'optionid' => $OPTIONID,
                        'room_type' => $OPTION_NAME,
                        'inclusion' => $MEAL_PLAN,
                        'total_cost' => $tot_amount1,
                        'currency' => $SELL_PRICE_CODE
                    );
                    $h++;

                    //$this->Search_Model->insert_search_result_jac($api,$LOCATION,$SERVICE_ID,$SERVICE_NAME,$star,$pernight,$tot_amt,$CURRENCY,$OPTION_NAME,$MEAL_PLAN,$LOCATION,$common_commission,$OPTION_STATUS,$without_markup,$hoteldesc,$Image,$NumAdults,$Quantity,$roomID,$session,$MEAL_PLAN_TYPE,$tot_room,$cout,$cin,$jac_image,$SERVICELONGITUTE,$SERVICELATITUTE);
                }
            }
            //   return $rooms;
            $i++;
            $oldrooms = $this->Hotel_Model->hotel_getrooms($details->hotel_code, $details->session_id);
            foreach ($oldrooms as $val) {

                foreach ($rooms as $val1) {
                    if ($val->searchtokenid == $val1['optionid']) {
                        $data = array(
                            'cost' => $val1['total_cost'],
                            'net_cost' => $val1['total_cost'],
                            'total_cost' => $val1['total_cost'],
                        );
                        $this->db->where('hotel_code', $val->hotel_code);
                        $this->db->where('searchtokenid', $val->searchtokenid);
                        $this->db->update('api_hotel_info_t', $data);
                    }
                }
            }
        }
    }

    function jac_booking() {
        echo '<pre>';
        print_r($this->session->all_userdata());

        $hotel_search_data = $this->session->userdata('hotel_search_data');
        $adult_value = $hotel_search_data['adultvalue'];
        $child_value = $hotel_search_data['childvalue'];
        $room_count = $hotel_search_data['room_count'];
        $RefNo = $this->generateRandomString(8);
        $booking_date = date('d M Y');
        $noofnights = $hotel_search_data['noofnights'];
        $checkins = explode('/', $hotel_search_data['checkin']);
        $checkin = $checkins['2'] . '-' . $checkins['1'] . '-' . $checkins['0'];
        $checkin = date('d M Y', strtotime($checkin));

        $checkouts = explode('/', $hotel_search_data['checkout']);
        $checkout = $checkouts['2'] . '-' . $checkouts['1'] . '-' . $checkouts['0'];
        $checkout = date('d M Y', strtotime($checkout));

        $passenger_info = $this->session->userdata('passenger_info');
        $bookingid = $passenger_info['booking_id'];
        $sellpriceid = $passenger_info['sellprice'];

        //    exit;
        // THIS IS FOR SETTING THE ROOMS TYPES
        $pax = '<PAX_OCCUPANCYS>';
        for ($r = 0; $r < $room_count; $r++) {
            $cloop = '';
            //child

            if ($adult_value[$r] == 1) {
                $occ = '1';
            } elseif ($adult_value[$r] == 2 && $child_value[$r] == 0) {
                $occ = '3';
            } elseif ($adult_value[$r] == 3) {
                $occ = '4';
            } elseif ($adult_value[$r] == 4) {
                $occ = '5';
            } elseif ($adult_value[$r] == 2 && $child_value[$r] == 1) {
                $occ = '7';
            } elseif ($adult_value[$r] == 2 && $child_value[$r] == 2) {
                $occ = '8';
            }

            $pax.= '
<PAX_OCCUPANCY TYPE="1">
<OCCUPANCYID>' . $occ . '</OCCUPANCYID>
<NO_OF_PAX>' . $adult_value[$r] . '</NO_OF_PAX>
</PAX_OCCUPANCY>';

            if ($child_value[$r]) {
                $pax.= '
<PAX_OCCUPANCY TYPE="2">
<OCCUPANCYID>' . $occ . '</OCCUPANCYID>
<NO_OF_PAX>' . $child_value[$r] . '</NO_OF_PAX>
</PAX_OCCUPANCY>';
            }
        }
        $pax.= '</PAX_OCCUPANCYS>';

        // THIS IS FOR THE PASSENGER DETAILS INFO
        $pass_details = '<PASSENGERS>';
        for ($r = 0; $r < $hotel_search_data['room_count']; $r++) {

            //adult
            for ($a = 0; $a < $hotel_search_data['adultvalue'][$r]; $a++) {
                $pass_details.= '
<PASSENGER TYPE = "1">
        <FIRST_NAME>' . $passenger_info['adults_fname'][$a] . '</FIRST_NAME>
        <LAST_NAME>' . $passenger_info['adults_lname'][$a] . '</LAST_NAME>   
        <TITLE>' . $passenger_info['adults_title'][$a] . '</TITLE>
        </PASSENGER>                    
';
            }
            //child
            for ($c = 0; $c < $hotel_search_data['childvalue'][$r]; $c++) {
                $pass_details.= '
<PASSENGER TYPE = "2">
        <FIRST_NAME>' . $passenger_info['childs_fname'][$c] . '</FIRST_NAME>
        <LAST_NAME>' . $passenger_info['childs_lname'][$c] . '</LAST_NAME>
        <AGE>7</AGE>
        <TITLE>' . $passenger_info['childs_title'][$c] . '</TITLE>
        </PASSENGER >                    
';
            }
        }
        $pass_details.= '</PASSENGERS>';

        // SELECTED ROOM ID WITH PASSENGER DETAILS
        $option = '<OPTIONS>';
        for ($r = 0; $r < $hotel_search_data['room_count']; $r++) {

            if ($adult_value[$r] == 1) {
                $occ = '1';
            } elseif ($adult_value[$r] == 2 && $child_value[$r] == 0) {
                $occ = '3';
            } elseif ($adult_value[$r] == 3) {
                $occ = '4';
            } elseif ($adult_value[$r] == 4) {
                $occ = '5';
            } elseif ($adult_value[$r] == 2 && $child_value[$r] == 1) {
                $occ = '7';
            } elseif ($adult_value[$r] == 2 && $child_value[$r] == 2) {
                $occ = '8';
            }

            if ($hotel_search_data['childvalue'][$r] != 0) {
                $chi = '
                <CHILDREN>
        <AGES>
        <AGE>7</AGE>
        <COUNT>' . $hotel_search_data['childvalue'][$r] . '</COUNT>
        </AGES>
        </CHILDREN>    
';
            }

            $sell = str_replace(",", "", $passenger_info['sellprice']['0']);
            $option.= '
                   <OPTION>
        <OPTION_DATE>' . $passenger_info['pricedate']['0'] . '</OPTION_DATE>
        <OPTION_ID>' . $bookingid[$r] . '</OPTION_ID>
        <QUANTITY>1</QUANTITY>
        <NO_OF_ADULTS>' . $hotel_search_data['adultvalue'][$r] . '</NO_OF_ADULTS>
        <NO_OF_CHILDREN>' . $hotel_search_data['childvalue'][$r] . '</NO_OF_CHILDREN>
        <SELL_PRICE_ID>' . $sell . '</SELL_PRICE_ID>
        ' . $chi . '
    
        </OPTION>
';
        }
        $option.= '</OPTIONS>';


        // SELECTED ROOM ID WITH PASSENGER DETAILS


        $xml_data = '
        <BOOKING_DETAILS>
<VERSION_HISTORY APPLICATION_NAME="TSAPI API 1.0" XML_FILE_NAME="Booking.xml" LICENCE_KEY="' . $this->jkey . '" TS_API_VERSION="v3.5.5" >
<XML_VERSION_NO>1.0</XML_VERSION_NO>       
        </VERSION_HISTORY>
        <BOOKING>
        <CLIENT_NAME>iwanthotels</CLIENT_NAME>
        <BOOKING_NAME>' . $RefNo . '</BOOKING_NAME>
        <BOOKING_DATE>' . $booking_date . '</BOOKING_DATE>
        <BOOKING_START_DATE>' . $checkin . '</BOOKING_START_DATE>
        <BOOKING_END_DATE>' . $checkout . '</BOOKING_END_DATE>
        <NUMBER_OF_NIGHTS>' . $noofnights . '</NUMBER_OF_NIGHTS>
        <CLIENT_REFERENCE>' . $RefNo . '</CLIENT_REFERENCE>
        <SERVICE_ID>' . $passenger_info['hotel_code'] . '</SERVICE_ID>
        <TOTAL_ADULTS>' . $hotel_search_data["adult_count"] . '</TOTAL_ADULTS>
        <TOTAL_CHILDREN>' . $hotel_search_data["child_count"] . '</TOTAL_CHILDREN>
        <RETURN_BOOKING_DETAILS />
' . $pax . '
    ' . $pass_details . '        

        ' . $option . '
        <NOTES>
        <NOTE>TESTING</NOTE>
        </NOTES>
        </BOOKING>
        </BOOKING_DETAILS>

        ';
        echo $xml_data;
        $response = $this->postjac($xml_data, $this->jbooking);
        echo '<pre>';
        print_r($response);
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

    function generateRandomString($length = 10) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ9876543210ZYXWVUTSRQPONMLKJIHGFEDCBA';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return 'IW' . $randomString;
    }

    function payment_process() {
        $this->session->set_userdata('final_book_info', $_POST);
        $pass = $this->session->userdata('final_book_info');
        $pass_info = $this->session->userdata('passenger_info');
//        echo '<pre>';        //print_r($_POST); 
//        
//        print_r($this->session->all_userdata());
//        exit;
        $payment_type = $pass['payment_type'];
        if ($payment_type == 'payu') {
            //$this->load->view('payment_load');
            $this->load->view('b2b/hotel/payment_load_demo');
        } else if ($payment_type == 'hdfc') {
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
                $ReqResponseUrl = "responseURL=http://www.roombooking.in/agent/hotel/GetHandleRESponse";
                $ReqErrorUrl = "errorURL=http://www.roombooking.in/hotel/agent/hdfc_payment_failure";
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
                        $failedurl = 'http://www.roombooking.in/agent/hotel/hdfc_payment_failure?ResTrackId=' . $TranTrackid . '&ResAmount=' . $TranAmount . '&ResError=' . $response;
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
            } else {
                redirect('hotel/rooms_reservation', refresh);
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
                $REDIRECT = 'REDIRECT=http://www.roombooking.in/agent/hotel/hdfc_payment_failure?ResError=--IP MISSMATCH-- Response IP Address is: ' . $strResponseIPAdd;
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
                        $REDIRECT = 'REDIRECT=http://www.roombooking.in/agent/hotel/hdfc_payment_success?ResResult=' . $ResResult . '&ResTrackId=' . $ResTrackID . '&ResAmount=' . $ResAmount . '&ResPaymentId=' . $ResPaymentId . '&ResRef=' . $ResRef . '&ResTranId=' . $ResTranId . '&ResError=' . $ResErrorText . 'Hashing Response Successful';
                        echo $REDIRECT;
                        //echo '2'; exit;
                        //redirect('dhotel/hdfc_payment_failure?ResResult=' . $ResResult . '&ResTrackId=' . $ResTrackID . '&ResAmount=' . $ResAmount . '&ResPaymentId=' . $ResPaymentId . '&ResRef=' . $ResRef . '&ResTranId=' . $ResTranId . '&ResError=' . $ResErrorText . 'Hashing Response Successful');
                    } else {
                        $REDIRECT = 'REDIRECT=http://www.roombooking.in/agent/hotel/hdfc_payment_failure?ResError=Hashing Response Mismatch';
                        echo $REDIRECT;
                        // echo '3'; exit;
                        // redirect('dhotel/hdfc_payment_failure?ResError=Hashing Response Mismatch');
                    }
                } else {
                    $REDIRECT = 'REDIRECT=http://www.roombooking.in/agent/hotel/hdfc_payment_failure?ResResult=' . $ResResult . '&ResTrackId=' . $ResTrackID . '&ResAmount=' . $ResAmount . '&ResPaymentId=' . $ResPaymentId . '&ResRef=' . $ResRef . '&ResTranId=' . $ResTranId . '&ResError=' . $ResErrorText;
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
        echo '<pre>';
        print_r($_REQUEST);
        //print_r($this->session->all_userdata);
        exit;
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
            $error = 'Payment failed';
            redirect('hotel/error_page/' . base64_encode($error));
            exit();
        } else if ($pay_detail_id) {
            redirect('hotel/rooms_reservation', 'refersh');
        } else {
            $error = 'No Response from Server';
            redirect('hotel/error_page/' . base64_encode($error));
        }
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
        $this->load->view('b2b/hotel/roomsxml/rooms_cancel_confirmed');



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
        $ci->email->from($email, 'Agent');
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

