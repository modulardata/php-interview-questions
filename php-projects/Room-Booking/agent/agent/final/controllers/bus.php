<?php

error_reporting(0);
ini_set('mysql.connect_timeout', 3000);
ini_set('default_socket_timeout', 3000);
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//session_start();

include_once "redbus/library/OAuthStore.php";
include_once "redbus/library/OAuthRequester.php";
include_once "redbus/SSAPICaller.php";

//$key = "4RbQm9Q5kVM7zmrfWRnZBL50vUo6IE";
//$secret = "l4KrcI4CQxQueSCTiEp1Yt1TEJebI8";
//$base_url = "http://api.seatseller.travel/";

class Bus extends CI_Controller {

    private $URL;
    private $client, $xml, $MidOfficeAgentID, $soapAction;
    private $airItinerary;
    private $sess_id;
    private $key;
    private $secretkey;

    public function __construct() {
        parent::__construct();
        $this->load->model('Bus_Model');

        $this->key = "4RbQm9Q5kVM7zmrfWRnZBL50vUo6IE";
        $this->secretkey = "l4KrcI4CQxQueSCTiEp1Yt1TEJebI8";
        $this->URL = "http://api.seatseller.travel/";


        if ($this->session->userdata('session_id') == '') {
            redirect('hotel/index', 'refresh');
        }

        $this->sess_id = $this->session->userdata('session_id');
    }

    // Bus Search Code
    public function bus_search() {
        //echo '<pre>';print_r($_POST);exit;
        $this->form_validation->set_rules('from_date', 'Departure Date', 'required|callback_date_validation|xss_clean');
        if ($this->input->post('bustrip') == 'roundtrip') {
            $this->form_validation->set_rules('to_date', 'Return Date', 'required|callback_date_validation|xss_clean');
        }

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('home/index');
        } else {
            //echo '<pre>';print_r($_POST);exit;					


            $bustrip = $this->input->post('bustrip');
            $bus_source = $this->Bus_Model->getsource_id($this->input->post('bus_source'));
            $bus_desti = $this->Bus_Model->getdesti_id($this->input->post('bus_destination'), $bus_source);
            $from_date = $this->input->post('from_date');
            if ($bustrip == 'oneway') {
                $to_date = '';
            } elseif ($bustrip == 'roundtrip') {
                $to_date = $this->input->post('to_date');
            }


            if (!empty($from_date)) {
                $session_data = $this->session->userdata('bus_search_data');

                if (!empty($session_data)) {
                    $sess_bus_source = $session_data['bus_source'];
                    $sess_bus_desti = $session_data['bus_desti'];
                    $sess_from_date = $session_data['from_date'];
                    $sess_bustrip = $session_data['bustrip'];


                    if ($sess_bus_source == $bus_source && $sess_bus_desti == $bus_desti && $sess_from_date == $from_date && $sess_bustrip == $bustrip) {
                        $this->session->set_userdata('bus_search_activate', 1);
                    } else {
                        $this->session->set_userdata('bus_search_activate', '');
                        $this->Bus_Model->delete_bus_temp_result($this->sess_id);
                    }
                } else {
                    $this->session->set_userdata('flight_search_activate', '');
                    $this->Bus_Model->delete_bus_temp_result($this->sess_id);
                }

                $sourcname = $this->Bus_Model->getsourname($bus_source);
                $destiname = $this->Bus_Model->getdestiname($bus_desti); //echo '<pre>';print_r($sourcname);exit;
                $sess_array = array(
                    'bustrip' => $bustrip,
                    'bus_source' => $bus_source,
                    'bus_desti' => $bus_desti,
                    'from_date' => $from_date,
                    'to_date' => $to_date,
                    'sourcename' => $sourcname->city_name,
                    'destiname' => $destiname->city_name
                );

                $this->session->set_userdata('bus_search_data', $sess_array);

                $api_name_b = 'redbus';
                $data['api_name_b'] = $api_name_b;

                $this->session->set_userdata('api_name_b', $api_name_b);

                $this->load->view('b2b/bus/search', $data);
            } else {
                $this->load->view('home/index');
            }
        }
    }

    function search_progress() {
         // echo '<pre>';print_r($this->session->userdata);exit;	
        if ($this->session->userdata('bus_search_activate') != 1) {
            if (isset($_POST) && $_POST['api_name'] != '') {
                $api = $_POST['api_name'];

                switch ($api) {

                    case 'redbus':
                        $this->redbus_availablity();
                        break;

                    default:
                        break;
                }
            }
        }
        //   exit;
        $sess_search_data = $this->session->userdata('bus_search_data');
        if ($sess_search_data['bustrip'] == 'oneway') {
            $bus_result = $this->Bus_Model->fetch_search_result($this->sess_id, '1');
            //echo '<pre/>';print_r($bus_result);exit;
            $data['result'] = $bus_result;
            $this->load->view('b2b/bus/search_result', $data);
        } elseif ($sess_search_data['bustrip'] == 'roundtrip') {
            $bus_result = $this->Bus_Model->fetch_search_result($this->sess_id, '1');
            //echo '<pre/>';print_r($bus_result);exit;
            $data['result'] = $bus_result;
            $this->load->view('b2b/bus/search_result_oneway', $data);
        }
    }

    function bus_roundtrip() {
        $boardingpoint = $this->input->post('boardingpointsList');
        $seatname = $this->input->post('seatname');
        $tripID = $this->input->post('tripID');
        $busID = $this->input->post('bus_id');
        $price = $this->input->post('sprice');
        $data['bus_details'] = $this->Bus_Model->get_bus_detail($busID, $tripID);
        $data['boarding'] = $this->Bus_Model->get_boarding_one($busID, $boardingpoint);
        $sel = array(
            'boardingpoint' => $boardingpoint,
            'seatname' => $seatname,
            'tripID' => $tripID,
            'travels' => $data['bus_details']->travels,
            'bus_type' => $data['bus_details']->bus_type,
            'location' => $data['boarding']->location,
            'time' => $data['boarding']->time,
            'sprice' => $price
        );
        $this->session->set_userdata('selectbus1', $sel);

        $bus_result = $this->Bus_Model->fetch_search_result($this->sess_id, '2');
        //echo '<pre/>';print_r($bus_result);exit;
        $data['result'] = $bus_result;
        $this->load->view('b2b/bus/search_result_twoway', $data);
    }

    function bus_details() {
        //echo '<pre>';print_r($_POST);exit;
        $boardingpoint = $this->input->post('boardingpointsList');
        $seatname = $this->input->post('seatname');
        $tripID = $this->input->post('tripID');
        $busID = $this->input->post('bus_id');
        $price = $this->input->post('sprice');
        $data['bus_details'] = $this->Bus_Model->get_bus_detail($busID, $tripID);
        $data['boarding'] = $this->Bus_Model->get_boarding_one($busID, $boardingpoint);
        $sel = array(
            'boardingpoint' => $boardingpoint,
            'seatname' => $seatname,
            'tripID' => $tripID,
            'travels' => $data['bus_details']->travels,
            'bus_type' => $data['bus_details']->bus_type,
            'location' => $data['boarding']->location,
            'time' => $data['boarding']->time,
            'sprice' => $price
        );
        $bus_search_data = $this->session->userdata('bus_search_data');
        if ($bus_search_data['bustrip'] == 'oneway') {
            $this->session->set_userdata('selectbus1', $sel);
        } else {
            $this->session->set_userdata('selectbus2', $sel);
        }


        //echo 'ddsfdf<pre>';print_r($data['bus_details']);exit;
        $this->load->view('b2b/bus/bus_details', $data);
    }

    function iternary() {
        //echo '<pre>';print_r($_POST);print_r($this->session->all_userdata());
        $this->session->set_userdata('pass_info', $_POST); //SETTING THE PASSENGER INFO IN THE SESSION
        $selectedbus1 = $this->session->userdata('selectbus1');
        $selectedbus2 = $this->session->userdata('selectbus2');
        $bus_search_data = $this->session->userdata('bus_search_data');
        $triptype = $bus_search_data['bustrip'];

        $json = array();
        $user_name = array();
        $user_gender = array();
        $user_age = array();
        $user_primary = array();
        $user_title = array();
        $inventoryItems = array(array());
        $passenger = array(array());

        $user_name = $this->input->post('fname');
        $user_gender = $this->input->post('sex');
        $user_age = $this->input->post('age');
        $user_title = $this->input->post('Title');

        $user_mobile = $this->input->post('mobile');
        $user_email = $this->input->post('email_id');
        $user_address = $this->input->post('address');

        $chosenbusid = $selectedbus1['tripID'];
        $sourceid = $bus_search_data['bus_source'];
        $destinationid = $bus_search_data['bus_desti'];
        $boardingpointid = $selectedbus1['boardingpoint'];
        $checkbox_no = count($user_name);
        //   $user_id_no = $_GET['id_no'];
        //   $user_idproof_type = $_GET['id_proof'];
        for ($i = 0; $i < $checkbox_no; $i++) {
            if ($i == 0) {
                $user_primary[$i] = 'true';
            } else {
                $user_primary[$i] = 'false';
            }
        }

        $tripdetails = getTripDetails($chosenbusid);
        $tripdetails2 = json_decode($tripdetails);
//echo '<pre>';print_r($chosenbusid);print_r($tripdetails);exit;
        $seatschosen = $selectedbus1['seatname'];
        $seats = explode(",", $seatschosen);
        for ($i = 0; $i < $checkbox_no; $i++) {

            foreach ($tripdetails2 as $key => $value) {
                if (is_array($value)) {
                    foreach ($value as $k => $v) {

                        foreach ($v as $k1 => $v1) {
                            if (isset($v->name)) {

                                if (!strcmp($v->name, $seats[$i])) {
                                    $passenger[$i]['age'] = $user_age[$i];
                                    $passenger[$i]['gender'] = $user_gender[$i];
                                    $passenger[$i]['name'] = $user_name[$i];
                                    $passenger[$i]['primary'] = $user_primary[$i];
                                    $passenger[$i]['title'] = $user_title[$i];

                                    if ($i == 0) {
                                        $passenger[$i]['address'] = $user_address;
                                        $passenger[$i]['email'] = $user_email;
                                        //  $passenger[$i]['idNumber'] = $user_id_no;
                                        //  $passenger[$i]['idType'] = $user_idproof_type;
                                        $passenger[$i]['mobile'] = $user_mobile;
                                    }
                                    $inventoryItems[$i]['fare'] = $v->fare;
                                    $inventoryItems[$i]['ladiesSeat'] = $v->ladiesSeat;
                                    $inventoryItems[$i]['passenger'] = $passenger[$i];
                                    $inventoryItems[$i]['seatName'] = $v->name;
                                }
                            }
                        }
                    }
                }
            }
        }
        $json['availableTripId'] = $chosenbusid;
        $json['boardingPointId'] = $boardingpointid;
        $json['destination'] = $destinationid;
        $json['inventoryItems'] = $inventoryItems;
        $json['source'] = $sourceid;

        // echo "This is the json output".json_encode($json); 
        $this->session->set_userdata('jsonobject1', $json);

        if ($triptype == 'roundtrip') {

            $json = array();
            $user_name = array();
            $user_gender = array();
            $user_age = array();
            $user_primary = array();
            $user_title = array();
            $inventoryItems = array(array());
            $passenger = array(array());

            $user_name = $this->input->post('fname');
            $user_gender = $this->input->post('sex');
            $user_age = $this->input->post('age');
            $user_title = $this->input->post('Title');

            $user_mobile = $this->input->post('mobile');
            $user_email = $this->input->post('email_id');
            $user_address = $this->input->post('address');

            $chosenbusid = $selectedbus2['tripID'];
            $sourceid = $bus_search_data['bus_desti'];
            $destinationid = $bus_search_data['bus_source'];
            $boardingpointid = $selectedbus2['boardingpoint'];
            $checkbox_no = count($user_name);
            //   $user_id_no = $_GET['id_no'];
            //   $user_idproof_type = $_GET['id_proof'];
            for ($i = 0; $i < $checkbox_no; $i++) {
                if ($i == 0) {
                    $user_primary[$i] = 'true';
                } else {
                    $user_primary[$i] = 'false';
                }
            }

            $tripdetails = getTripDetails($chosenbusid);
            $tripdetails2 = json_decode($tripdetails);
//echo '<pre>';print_r($chosenbusid);print_r($tripdetails);exit;
            $seatschosen = $selectedbus2['seatname'];
            $seats = explode(",", $seatschosen);
            for ($i = 0; $i < $checkbox_no; $i++) {

                foreach ($tripdetails2 as $key => $value) {
                    if (is_array($value)) {
                        foreach ($value as $k => $v) {

                            foreach ($v as $k1 => $v1) {
                                if (isset($v->name)) {

                                    if (!strcmp($v->name, $seats[$i])) {
                                        $passenger[$i]['age'] = $user_age[$i];
                                        $passenger[$i]['gender'] = $user_gender[$i];
                                        $passenger[$i]['name'] = $user_name[$i];
                                        $passenger[$i]['primary'] = $user_primary[$i];
                                        $passenger[$i]['title'] = $user_title[$i];

                                        if ($i == 0) {
                                            $passenger[$i]['address'] = $user_address;
                                            $passenger[$i]['email'] = $user_email;
                                            //  $passenger[$i]['idNumber'] = $user_id_no;
                                            //  $passenger[$i]['idType'] = $user_idproof_type;
                                            $passenger[$i]['mobile'] = $user_mobile;
                                        }
                                        $inventoryItems[$i]['fare'] = $v->fare;
                                        $inventoryItems[$i]['ladiesSeat'] = $v->ladiesSeat;
                                        $inventoryItems[$i]['passenger'] = $passenger[$i];
                                        $inventoryItems[$i]['seatName'] = $v->name;
                                    }
                                }
                            }
                        }
                    }
                }
            }
            $json['availableTripId'] = $chosenbusid;
            $json['boardingPointId'] = $boardingpointid;
            $json['destination'] = $destinationid;
            $json['inventoryItems'] = $inventoryItems;
            $json['source'] = $sourceid;

            // echo "This is the json output".json_encode($json); 
            $this->session->set_userdata('jsonobject2', $json);
        }
      //  echo '<pre>';print_r($this->session->userdata('jsonobject1'));print_r($this->session->userdata('jsonobject2'));exit;
        $this->load->view('b2b/bus/confirm', $data);
    }

    function iternary_confirm() {
        $bus_search_data = $this->session->userdata('bus_search_data');
        $triptype = $bus_search_data['bustrip'];

        $json = $this->session->userdata('jsonobject1'); //echo '<pre>';print_r($json);//exit;
        $json_2 = json_encode($json);
// echo "This is the json output".json_encode($json); 
        $key1 = blockTicket($json_2);
        $this->session->set_userdata('tentative1', $key1);
        if ($triptype == 'roundtrip') {
            $jsonround = $this->session->userdata('jsonobject2'); //echo '<pre>';print_r($json);//exit;
            $jsonround_2 = json_encode($json);
// echo "This is the json output".json_encode($json); 
            $key2 = blockTicket($jsonround_2);
            $this->session->set_userdata('tentative2', $key2);
        }



        // THIS IS PLACE TO LOAD THE PAYMENT GATEWAY
        // THIS IS PLACE TO LOAD THE PAYMENT GATEWAY

        redirect('bus/bus_booking', 'refresh');
    }

    function bus_booking() {
        $bus_search_data = $this->session->userdata('bus_search_data');
        $triptype = $bus_search_data['bustrip'];
        $tentative1 = $this->session->userdata('tentative1');
        $out = json_encode($tentative);

        if ($triptype == 'roundtrip') {
            $tentative2 = $this->session->userdata('tentative2');
            $out = json_encode($tentative);
        }
        //  echo '<pre>';
        // print_r($out);
        //     echo '<pre>';
        //    print_r($this->session->all_userdata());
        // exit;
//        $booking_response = confirmTicket(OidOlbjWpO);
        //       echo '<br><br><br><br><br><pre>';print_r($booking_response);
        // $booking_reference_no = blockTicket($json_2);
        // BUS SEARCH DATA
        $booking_reference_no1 = 'testing'; // THIS IS FOR TESTING WITHOUT THE ACTUAL BOOKING
        $booking_reference_no2 = 'testing'; // THIS IS FOR TESTING WITHOUT THE ACTUAL BOOKING
      
        // $bus_trip = $bus_search_data['bustrip'];
        if ($bus_search_data['bustrip'] == 'oneway')
            $bus_trip = '1';
        else
            $bus_trip = '2';

        $bus_source = $bus_search_data['bus_source'];
        $bus_desti = $bus_search_data['bus_desti'];
        $from_date = $bus_search_data['from_date'];
        $to_date = $bus_search_data['to_date'];
        $sourcename = $bus_search_data['sourcename'];
        $destiname = $bus_search_data['destiname'];

        $selectbus1 = $this->session->userdata('selectbus1'); //ONEWAY SELECTED BUS DATA
        $boardingpoint1 = $selectbus1['boardingpoint'];
        $seatname1 = $selectbus1['seatname'];
        $tripID1 = $selectbus1['tripID'];
        $travels1 = $selectbus1['travels'];
        $bus_type1 = $selectbus1['bus_type'];
        $location1 = $selectbus1['location'];
        $time1 = $selectbus1['time'];
        $sprice1 = $selectbus1['sprice'];

        if ($bus_search_data['bustrip'] == 'roundtrip') {
            $selectbus2 = $this->session->userdata('selectbus2'); //TWOWAY SELECTED BUS DATA
            $boardingpoint2 = $selectbus2['boardingpoint'];
            $seatname2 = $selectbus2['seatname'];
            $tripID2 = $selectbus2['tripID'];
            $travels2 = $selectbus2['travels'];
            $bus_type2 = $selectbus2['bus_type'];
            $location2 = $selectbus2['location'];
            $time2 = $selectbus2['time'];
            $sprice2 = $selectbus2['sprice'];
        }

        $pass_info = $this->session->userdata('pass_info');  //PASS BUS DATA
        $pass_title = $pass_info['Title'];
        $pass_fname = $pass_info['fname'];
        $pass_sex = $pass_info['sex'];
        $pass_age = $pass_info['age'];
        $lead_mobile = $pass_info['mobile'];
        $lead_email_id = $pass_info['email_id'];

        $tfvRefNo = $this->generateReferenceNo(8);

        // B2C USER ID
        $b2cuserid = 0;
        $booked_by = 'guest';
        $agent_id = 0;

        //INSERTING BOOKING DETAILS
        if ($bus_search_data['bustrip'] == 'oneway') {
            $insbook = array(
                'b2cuser_id' => $b2cuserid,
                'agent_id' => $agent_id,
                'trip_type' => $bus_trip,
                'source_id' => $bus_source,
                'desti_id' => $bus_desti,
                'departure_date1' => $from_date,
                'sourcename' => $sourcename,
                'destiname' => $destiname,
                'api' => 'redbus',
                'boarding_pointid1' => $boardingpoint1,
                'seat_name1' => $seatname1,
                'travels1' => $travels1,
                'bus_type1' => $bus_type1,
                'boardingpoint1' => $location1,
                'boardingtime1' => $time1,
                'net_fare1' => $sprice1,
                'total_fare' => $sprice1,
                'avialabletripid1' => $tripID1,
                'booking_reference_no1' => $booking_reference_no1,
                'tfv_reference_no' => $tfvRefNo,
                'booked_by' => $booked_by,
                'mobile' => $lead_mobile,
                'emailid' => $lead_email_id,
            );
        } else {
            $tot = $sprice1 + $sprice2;
            $insbook = array(
                'b2cuser_id' => $b2cuserid,
                'agent_id' => $agent_id,
                'trip_type' => $bus_trip,
                'source_id' => $bus_source,
                'desti_id' => $bus_desti,
                'departure_date1' => $from_date,
                'departure_date2' => $to_date,
                'sourcename' => $sourcename,
                'destiname' => $destiname,
                'api' => 'redbus',
                'boarding_pointid1' => $boardingpoint1,
                'seat_name1' => $seatname1,
                'travels1' => $travels1,
                'bus_type1' => $bus_type1,
                'boardingpoint1' => $location1,
                'boardingtime1' => $time1,
                'net_fare1' => $sprice1,
                'boarding_pointid2' => $boardingpoint2,
                'seat_name2' => $seatname2,
                'travels2' => $travels2,
                'bus_type2' => $bus_type2,
                'boardingpoint2' => $location2,
                'boardingtime2' => $time2,
                'net_fare2' => $sprice2,
                'total_fare' => $tot,
                'avialabletripid1' => $tripID1,
                'booking_reference_no1' => $booking_reference_no1,
                'booking_reference_no2' => $booking_reference_no2,
                'tfv_reference_no' => $tfvRefNo,
                'booked_by' => $booked_by,
                'mobile' => $lead_mobile,
                'emailid' => $lead_email_id,
            );
        }
        $insertid = $this->Bus_Model->insert_booking_report($insbook);

        for ($p = 0; $p < count($pass_fname); $p++) {
            $title = $pass_title[$p];
            $fname = $pass_fname[$p];
            $gender = $pass_sex[$p];
            $age = $pass_age[$p];
            $passdata = array(
                'bus_booking_id' => $insertid,
                'tfv_reference_no' => $tfvRefNo,
                'booking_reference_no' => $booking_reference_no1,
                'pass_title' => $title,
                'pass_name' => $fname,
                'pass_gender' => $gender,
                'pass_age' => $age,
            );
            $this->Bus_Model->insert_passinfo($passdata);
        }

        redirect('bus/bus_eticket/' . $booking_reference_no1 . '/' . $tfvRefNo, 'refresh');
    }

    function bus_eticket($booking_reference_no, $tfvRefNo) {
        $data['booking_details'] = $this->Bus_Model->get_booking_details($booking_reference_no, $tfvRefNo);
        $data['pass_details'] = $this->Bus_Model->get_booking_pass_details($booking_reference_no, $tfvRefNo);
        $this->load->view('b2b/bus/voucher', $data);
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

    function airport_code_validation($city) {
        $this->form_validation->set_message('airport_code_validation', 'Invalid Airport Code');

        preg_match_all('/\(([A-Za-z ]+?)\)/', $city, $out);
        $airportCode = $out[1];

        if (!empty($airportCode))
            return TRUE;
        else
            return FALSE;
    }

    //---------------redbus api integration code start------------DON NOT MODIFY--------------------

    function redbus_availablity() {
        $sess_data = $this->session->userdata('bus_search_data');
//        echo '<pre>';
//        print_r($sess_data);
//      //  exit;
        $bustrip = $sess_data['bustrip'];
        $sourceId = $sess_data['bus_source'];
        $destinationId = $sess_data['bus_desti'];
        $from_date = $sess_data['from_date'];
        $dat = explode('/', $from_date);
        $date = $dat['2'] . '-' . $dat['1'] . '-' . $dat['0'];
//exit;
        // $availablebus = $this->invokeGetRequest("availabletrips?source=" . $sourceId . "&destination=" . $destinationId . "&doj=" . $date);
        global $result;
        if ($bustrip == 'oneway') {
            $result = getAvailableTrips($sourceId, $destinationId, $date);
            $triptype = '1';
            $this->redbus_searchextract($result, $triptype, $sourceId, $destinationId);
        } elseif ($bustrip == 'roundtrip') {
            $to_date = $sess_data['to_date'];
            $dat1 = explode('/', $to_date);
            $date1 = $dat1['2'] . '-' . $dat1['1'] . '-' . $dat1['0'];
            $result = getAvailableTrips($sourceId, $destinationId, $date);
            $triptype = '1';
            $this->redbus_searchextract($result, $triptype, $sourceId, $destinationId);

            $result1 = getAvailableTrips($destinationId, $sourceId, $date1);
            $triptype = '2';
            $this->redbus_searchextract($result1, $triptype, $destinationId, $sourceId);
        }


        //$resp->availableTrips;
    }

    function redbus_searchextract($result, $triptype, $sourceId, $destinationId) {
        // $result2 = json_decode($result); 
        // echo '<pre>';print_r($sourceId, $destinationId, $date);
        $resp = json_decode($result);
        //   echo '<pre>';print_r($sourceId, $destinationId, $date);exit;
        foreach ($resp->availableTrips as $val) {
            $arrivalTime = $val->arrivalTime;
            $availableSeats = $val->availableSeats;
            $busType = $val->busType;
            $busTypeId = $val->busTypeId;
            $cancellationPolicy = $val->cancellationPolicy;
            $departureTime = $val->departureTime;
            $doj = $val->doj;
            if (is_array($val->fares)) {
                $fares = $val->fares['0'];
            } else {
                $fares = $val->fares;
            }

            $id = $val->id;
            $idProofRequired = $val->idProofRequired;
            $nonAC = $val->nonAC;
            $operator = $val->operator;
            $partialCancellationAllowed = $val->partialCancellationAllowed;
            $routeId = $val->routeId;
            $seater = $val->seater;
            $sleeper = $val->sleeper;
            $travels = $val->travels;
            $mTicketEnabled = $val->mTicketEnabled;

            $insert_id = $this->Bus_Model->bus_search_result($this->sess_id, $triptype, $sourceId, $destinationId, $arrivalTime, $availableSeats, $busType, $busTypeId, $cancellationPolicy, $departureTime, $doj, $fares, $id, $idProofRequired, $nonAC, $operator, $partialCancellationAllowed, $routeId, $seater, $sleeper, $travels, $mTicketEnabled);
            //Boarding Points
            if (is_array($val->boardingTimes)) {
                foreach ($val->boardingTimes as $bord) {
                    $bpId = $bord->bpId;
                    $location = $bord->location;
                    $prime = $bord->prime;
                    $time = $bord->time;
                    $this->Bus_Model->bus_boarding_point($this->sess_id, $insert_id, $bpId, $location, $prime, $time);
                }
            }

            //Droppping points Points
            if (is_array($val->droppingTimes)) {
                foreach ($val->droppingTimes as $dro) {
                    $dbpId = $dro->bpId;
                    $dlocation = $dro->location;
                    $dprime = $dro->prime;
                    $dtime = $dro->time;
                    $this->Bus_Model->bus_dropping_point($this->sess_id, $insert_id, $dbpId, $dlocation, $dprime, $dtime);
                }
            }
        }
        return;
    }

    function get_layout($tripId, $bus_id, $triptype) {

        $boarding = $this->Bus_Model->get_boarding($bus_id);
        //echo $tripdetails;exit;
        $data['triptype'] = $triptype;
        $data['tripID'] = $tripId;
        $data['bus_id'] = $bus_id;
        $data['boarding'] = $boarding;
        $bus_seat_layout = $this->load->view('b2b/bus/SeatLayout_raw', $data);
        echo $bus_seat_layout;
    }

    ////-------------redbus api integration code start------------DON NOT MODIFY-------------------- 


    function generateReferenceNo($len, $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789') {
        $string = '';
        for ($i = 0; $i < $len; $i++) {
            $pos = rand(0, strlen($chars) - 1);
            $string .= $chars{$pos};
        }
        return $string;
    }

}

