<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

error_reporting(0);

class Agent_Hotel extends CI_Controller {

    private $URL;
    private $client, $xml, $MidOfficeAgentID, $soapAction, $URLbooking;
    private $username, $password, $propertyid;
    private $sess_id;

    public function __construct() {
        parent::__construct();
        $this->load->model('Agent_Hotel_Model');
        $this->load->model('Agent_Model');
        $this->load->library('form_validation');
        $this->load->database();
        $this->agent_logged_in();
        $this->load->library('session');
        $this->load->helper('url');
        $this->URL = "http://stage-api.travelguru.com/services-2.0/tg-services/TGServiceEndPoint";
        $this->URLbooking = "http://stage-api.travelguru.com/services-2.0/tg-services/TGBookingServiceEndPoint";
        $this->soapAction = "http://stage-api.travelguru.com/services-2.0/tg-services/TGServiceEndPoint?wsdl";
        //$this->soapActionbooking = "http://stage-api.travelguru.com/services-2.0/tg-services/TGBookingServiceEndPoint";
        $this->username = "testnet";
        $this->password = "test";
        $this->propertyid = "1300000141";

        if ($this->session->userdata('session_id') == '') {
            redirect('hotel/index', 'refresh');
        }

        $this->sess_id = $this->session->userdata('session_id');
    }

    function agent_logged_in() {

        if (!$this->session->userdata('agent_logged_in')) {
            redirect('agent/index', 'refresh');
        }
    }

    public function index() {

        $this->load->view('agent/agent_index');
    }

    // Hotel Search Code
    public function hotel_search() {

        $this->form_validation->set_rules('City', 'Location', 'trim|required|xss_clean');
        $this->form_validation->set_rules('checkin', 'Check in', 'trim|required|callback_date_validation|xss_clean');
        $this->form_validation->set_rules('checkout', 'Check out', 'required|callback_date_validation|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('agent/agent_index');
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

            $noofnights = $this->Agent_Hotel_Model->calculatedateDiff($checkin, $checkout);

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
                        $this->Agent_Hotel_Model->delete_hotel_temp_result($this->sess_id);
                    }
                } else {
                    $this->session->set_userdata('hotel_search_activate', '');
                    $this->Agent_Hotel_Model->delete_hotel_temp_result($this->sess_id);
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
                $this->load->view('agent/hotel/search_progress', $data);
            }
        }
    }

    function search_progress() {
        //echo '<pre>';print_r($_POST);print_r($this->session->userdata);exit;	
        if ($this->session->userdata('hotel_search_activate') != 1) {
            if (isset($_POST) && $_POST['api_name'] != '') {
                $api = $_POST['api_name'];

                switch ($api) {

                    case 'travelguru':
                        $this->travelguru_search_result();
                        break;

                    default:
                        break;
                }
            }
        }

        $hotel_result = $this->Agent_Hotel_Model->fetch_search_result($this->sess_id);
        //echo '<pre/>';print_r($flight_result);exit;
        $data['result'] = $hotel_result;
        $this->load->view('agent/hotel/search_result', $data);
    }

    // travelguru api integration code starts here--------------------------------------
    function travelguru_search_result() {
        $session_data = $this->session->userdata('hotel_search_data');
//echo '<pre>';print_r($session_data);exit;
        $cit = $session_data['city'];
        $city = explode(' ', $cit);
        $count = explode('(', $cit);
        $country = explode(')', $count[1]);
        $in = $session_data['checkin'];
        $check = explode('/', $in);
        $checkin = $check[2] . '-' . $check[1] . '-' . $check[0];
        $out = $session_data['checkout'];
        $check = explode('/', $out);
        $checkout = $check[2] . '-' . $check[1] . '-' . $check[0];
//exit;
        //echo 'sdsdsd';exit;
        $gues = '';
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
        //echo echo $gues;exit;
        $this->xml = '
<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
    <soap:Body> <OTA_HotelAvailRQ xmlns="http://www.opentravel.org/OTA/2003/05" RequestedCurrency="INR" SortOrder="TG_RANKING" Version="0.0" PrimaryLangID="en" SearchCacheLevel="VeryRecent">
            <AvailRequestSegments>
                <AvailRequestSegment> 
                    <HotelSearchCriteria> 
                        <Criterion> 
                            <Address> 
                                <CityName>' . $city[0] . '</CityName> 
                                <CountryName Code="' . $country[0] . '"></CountryName> 
                            </Address> 
                            <HotelRef/> 
                            <StayDateRange End="' . $checkout . '" Start="' . $checkin . '"/>                              
                            <RoomStayCandidates> 
                                ' . $gues . ' 
                            </RoomStayCandidates>                              
                            <TPA_Extensions> 
                                <Pagination enabled="false" hotelsFrom="01" hotelsTo="05"/> 
                                <HotelBasicInformation>
                                    <Reviews/>
                                </HotelBasicInformation> 
                                <UserAuthentication password="' . $this->password . '" propertyId="' . $this->propertyid . '" username="' . $this->username . '"/> 
                                <Promotion Type="HOTEL" Name="StayPeriod" /> 
                            </TPA_Extensions> 
                        </Criterion> 
                    </HotelSearchCriteria> 
                </AvailRequestSegment> 
            </AvailRequestSegments> 
        </OTA_HotelAvailRQ> 
    </soap:Body> 
</soap:Envelope>';
        //echo $this->xml;exit;
        $hotelresp = $this->postRQ($this->xml);
        //echo '<pre>';print_r($hotelresp);//exit;
        //------------search response data extraction start
        $dom2 = new DOMDocument();
        $dom2->loadXML($hotelresp);
        //echo '<pre>';        print_r($dom2); exit;
        //Roomstays indicate the number of hotels

        $roomstay = $dom2->getElementsByTagName("RoomStay");
        //echo '<pre>';        print_r($roomstay); exit;
        foreach ($roomstay as $val) {

            $BasicPropertyInfo = $val->getElementsByTagName("BasicPropertyInfo");
            $HotelCode = $BasicPropertyInfo->item(0)->getAttribute('HotelCode');

            $HotelBasicInformation = $val->getElementsByTagName("HotelBasicInformation");
            $HotelType = $HotelBasicInformation->item(0)->getAttribute('HotelType');

            $DeepLinkInformation = $val->getElementsByTagName("DeepLinkInformation");
            $DeepLinkInformationval = $DeepLinkInformation->item(0)->getAttribute('overviewURL');

            $RoomRate = $val->getElementsByTagName("RoomRate");
            foreach ($RoomRate as $val1) {
                $RoomID = $val1->getAttribute('RoomID');
                $RatePlanCode = $val1->getAttribute('RatePlanCode');

                $Rate = $val1->getElementsByTagName("Rate");
                $Base = $val1->getElementsByTagName("Base");
                $AmountBeforeTax = $Base->item(0)->getAttribute('AmountBeforeTax');

                $addAmountBeforeTax = array();
                if ($val1->getElementsByTagName("AdditionalGuestAmounts")) {
                    $AdditionalGuestAmounts = $val1->getElementsByTagName("AdditionalGuestAmounts");
                    foreach ($AdditionalGuestAmounts as $guesiss) {
                        $AdditionalGuestAmount = $guesiss->getElementsByTagName("AdditionalGuestAmount");
                        foreach ($AdditionalGuestAmount as $add) {
                            $addAmountBeforeTax[] = $add->getElementsByTagName("Amount")->item(0)->getAttribute('AmountBeforeTax');
                            //$addAmountBeforeTax[] = $Amount->item(0)->getAttribute('AmountBeforeTax');
                        }
                        break;
                    }
                }
                //  echo '<pre>';print_r($addAmountBeforeTax);

                $Taxes = $val1->getElementsByTagName('Taxes');
                $Taxesval = $Taxes->item(0)->getAttribute('Amount');
                $Discountval = 0;
                $TPA_Discountval = array();
                if ($val1->getElementsByTagName('Discount')) {
                    $Discounts = $val1->getElementsByTagName('Discount');
                    foreach ($Discounts as $dis) {
                        $AppliesTo = $dis->getAttribute('AppliesTo');
                        if ($AppliesTo == 'Base') {
                            $Discountval = $dis->getAttribute('AmountBeforeTax');
                        } else {
                            if ($dis->getAttribute('ItemRPH')) {
                                $itemRPH = $dis->getAttribute('ItemRPH');
                                if ($itemRPH == '') {
                                    $TPA_Discountval[] = $dis->getAttribute('AmountBeforeTax');
                                }
                            }
                        }
                        //$Discountval = $dis->getAttribute('AmountBeforeTax');
                    }
                }

                $netrate = $this->Agent_Hotel_Model->detail_calculate_rate($AmountBeforeTax, $Discountval, $Taxesval, $addAmountBeforeTax, $TPA_Discountval);

                $RoomType = $val->getElementsByTagName("RoomType");
                foreach ($RoomType as $val2) {
                    $RoomTypeCode = $val2->getAttribute('RoomTypeCode');
                    if ($RoomTypeCode == $RoomID) {
                        $RoomTypename = $val2->getAttribute('RoomType');
                        $NonSmoking = $val2->getAttribute('NonSmoking');
                        $Occupancy = $val2->getElementsByTagName("Occupancy");
                        foreach ($Occupancy as $occ) {
                            $AgeQualifyingCode = $occ->getAttribute('AgeQualifyingCode');

                            if ($AgeQualifyingCode == '10') {
                                $adultMaxOccupancy = $occ->getAttribute('MaxOccupancy');
                            } else {
                                $childMaxOccupancy = $occ->getAttribute('MaxOccupancy');
                            }
                        }
                    }
                }
                $RatePlan = $val->getElementsByTagName("RatePlan");
                foreach ($RatePlan as $ratpln) {
                    $RatePlanCodeval = $ratpln->getAttribute('RatePlanCode');
                    if ($RatePlanCodeval == $RatePlanCode) {
                        $CancelPenalty = $ratpln->getElementsByTagName("CancelPenalty");
                        $NonRefundable = $CancelPenalty->item(0)->getAttribute('NonRefundable');

                        $RatePlanDescription = $ratpln->getElementsByTagName("RatePlanDescription");
                        foreach ($RatePlanDescription->item(0)->getElementsByTagName("Text") as $Text) {
                            $RatePlanDescriptionval = $Text->nodeValue;
                            //break;
                        }
                        $RatePlanInclusionDesciption = $ratpln->getElementsByTagName("RatePlanInclusionDesciption");
                        foreach ($RatePlanInclusionDesciption->item(0)->getElementsByTagName("Text") as $Text) {
                            $RatePlanInclusionDesciptionval = $Text->nodeValue;
                            break;
                        }

                        $DiscountCouponDisplayIndicator = $ratpln->getElementsByTagName("DiscountCouponDisplayIndicator");
                        $DiscountCouponDisplayIndicatorval = $DiscountCouponDisplayIndicator->item(0)->getAttribute('Enabled');
                    }
                }
                $api_name = 'travelguru';









                $this->Agent_Hotel_Model->insert_hotel_temp_results($this->sess_id, $api_name, $RoomID, $RatePlanCode, $AmountBeforeTax, $Taxesval, $Discountval, $netrate, $RoomTypename, $NonSmoking, $adultMaxOccupancy, $childMaxOccupancy, $NonRefundable, $RatePlanDescriptionval, $RatePlanInclusionDesciptionval, $DiscountCouponDisplayIndicatorval, $HotelCode, $HotelType, $DeepLinkInformationval);
            }

            //inserting data to api permanent table start
            $hotel_exist = $this->Agent_Hotel_Model->checkpermanent($HotelCode);

            if ($hotel_exist == '0') {
                $hotel_overview = $this->Agent_Hotel_Model->gethotel_static_tg($HotelCode);
                $this->Agent_Hotel_Model->insertpermanent_tg($hotel_overview);
            }
            //inserting data to api permanent table end
        }
        //-----search response data extraction end
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

    function searchkey($search) {
        $search = str_replace("%20", " ", $search);
        $data['search'] = $search;
        $this->load->view('hotel/search_hotel', $data);
    }

    function hotel_detail($hotel_id) {

        $hotel_detail = $this->Agent_Hotel_Model->get_hotel_detail($hotel_id);
        //   echo '<pre>';        print_r($hotel_detail); exit;
        $hotel_images = $this->Agent_Hotel_Model->get_hotel_images($hotel_detail->hotel_code);
        $hotel_amenities = $this->Agent_Hotel_Model->get_hotel_amenities($hotel_detail->hotel_code);
        $hotel_inandaround = $this->Agent_Hotel_Model->get_hotel_inandaround($hotel_detail->hotel_code);
        $hotel_review = $this->Agent_Hotel_Model->get_hotel_review($hotel_detail->hotel_code);
        $hotel_rooms = $this->Agent_Hotel_Model->get_hotel_rooms($hotel_detail->hotel_code, $hotel_detail->session_id);


        //echo '<pre>';print_r($hotel_detail);exit;
        $data['hotel_detail'] = $hotel_detail;
        $data['hotel_rooms'] = $hotel_rooms;
        $data['hotel_images'] = $hotel_images;
        $data['hotel_amenities'] = $hotel_amenities;
        $data['hotel_inandaround'] = $hotel_inandaround;
        $data['hotel_review'] = $hotel_review;
        $session_data = $this->session->userdata('hotel_search_data');

        $cit = $session_data['city'];
        $city = explode(' ', $cit);
        $count = explode('(', $cit);
        $country = explode(')', $count[1]);
        $in = $session_data['checkin'];
        $check = explode('/', $in);
        $checkin = $check[2] . '-' . $check[1] . '-' . $check[0];
        $out = $session_data['checkout'];
        $check = explode('/', $out);
        $checkout = $check[2] . '-' . $check[1] . '-' . $check[0];
        $this->load->library('googlemaps');
        $config['center'] = $hotel_detail->latitude . ',' . $hotel_detail->longitude;
        $config['zoom'] = 11;
        $this->googlemaps->initialize($config);

        $marker = array();
        $marker['position'] = $hotel_detail->latitude . ',' . $hotel_detail->longitude;
        $this->googlemaps->add_marker($marker);

        $data['map'] = $this->googlemaps->create_map();
//echo '<pre>';print_r($data); exit;
        $this->load->view('agent/hotel/hotel_detail', $data);
    }

    function pre_booking($roomtype, $rateplancode, $hotel_code, $hotel_id, $netrate, $total, $tax) {

        $country = $this->Agent_Hotel_Model->get_country();

        $sel = array(
            'roomtype' => $roomtype,
            'rateplancode' => $rateplancode,
            'hotel_code' => $hotel_code,
            'hotel_id' => $hotel_id,
            'netrate' => $netrate,
            'total_amount' => $total,
            'tax' => $tax
        );
        $this->session->set_userdata('selected_room', $sel);
        $data['country'] = $country;
        $data['agent_id'] = $agent_id = $this->session->userdata('agent_id');
        $data['profile_data'] = $profile_data = $this->Agent_Hotel_Model->booking_details($agent_id);
        $data['hotel_booking_details'] = $this->Agent_Hotel_Model->get_hotel_search_result_info_t($hotel_id);




        //echo '<pre>';        print_r($data); exit;
        $this->load->view('agent/hotel/pre_booking', $data);
    }

    function errorpage($error) {

        $data['error'] = $error;
        $this->load->view('agent/hotel/error_page', $data);
    }

    function provisional_booking() {


        $selected_room = $this->session->userdata('selected_room');
        $total_amount = $selected_room['total_amount'];
        //echo '<pre>'.$total_amount; 

        $withdraw_amount = '0';
        $available_balance = '0';
        $agent_id = $this->session->userdata('agent_id');
        $agent_no = $this->session->userdata('agent_no');
        $agent_available_balance = $this->Agent_Hotel_Model->get_agent_available_balance($agent_no);

        // echo 'Balance<pre>';        print_r($agent_available_balance); exit;

        $available_balance = $agent_available_balance->closing_balance;
        // echo 'Balance<pre>';        print_r($total_amount); exit;
        if ($available_balance < $total_amount) {
            $error = 'Your balance is too low for booking this hotel';
            redirect('agent_hotel/errorpage/' . $error);
        }



        $hotel_search_data = $this->session->userdata('hotel_search_data');
        $roomcount = $hotel_search_data['room_count'];

        $fro = $hotel_search_data['checkin'];
        $frm = explode('/', $fro);
        $checkin = $frm['2'] . '-' . $frm['1'] . '-' . $frm['0'];

        $too = $hotel_search_data['checkout'];
        $to = explode('/', $too);
        $checkout = $to['2'] . '-' . $to['1'] . '-' . $to['0'];


        $selected_room = $this->session->userdata('selected_room');
        //echo '<pre>';        print_r($selected_room); exit;
        $roomtypecode = $selected_room['roomtype'];
        $rateplancode = $selected_room['rateplancode'];
        $hotel_code = $selected_room['hotel_code'];
        $netrate = $selected_room['netrate'];

        $tax = $selected_room['tax'];
        $amtbetax = $netrate - $tax;

        $email = $this->input->post('userEmailId');
        $mobile = $this->input->post('userMobilNo');
        $city = $this->input->post('city');
        $p_code = $this->input->post('p_code');
        $country = $this->input->post('country');

        $atitle = $this->input->post('atitle');
        $afname = $this->input->post('afname');
        $amname = $this->input->post('amname');
        $alname = $this->input->post('alname');

        $ctitle = $this->input->post('ctitle');
        $cfname = $this->input->post('cfname');
        $cmname = $this->input->post('cmname');
        $clname = $this->input->post('clname');

        $noofadult = count($afname);
        $noofchild = count($cfname);
        $pass_info = array(
            'atitle' => $atitle,
            'afname' => $afname,
            'amname' => $amname,
            'alname' => $alname,
            'ctitle' => $ctitle,
            'cfname' => $cfname,
            'cmname' => $cmname,
            'clname' => $clname,
            'pemail' => $email,
            'pmobile' => $mobile,
            'pcity' => $city,
            'pp_code' => $p_code,
            'pcountry' => $country,
            'noofadult' => $noofadult,
            'noofchild' => $noofchild
        );
        $this->session->set_userdata('pass_info', $pass_info);
//        echo '<pre>';
//        print_r($this->session->userdata('pass_info'));
//        exit;
        $pass = ''; //$k=0;
        for ($k = 0; $k < count($afname); $k++) {
            $pass.= '
                    <PersonName> 
                    <NamePrefix>' . $atitle[$k] . '</NamePrefix> 
                    <GivenName>' . $afname[$k] . '</GivenName> 
                    <MiddleName>' . $amname[$k] . '</MiddleName> 
                    <Surname>' . $alname[$k] . '</Surname> 
                    </PersonName>';
        }
        for ($c = 0; $c < count($cfname); $c++) {
            $pass.= '
                    <PersonName> 
                    <NamePrefix>' . $ctitle[$c] . '</NamePrefix> 
                    <GivenName>' . $cfname[$c] . '</GivenName> 
                    <MiddleName>' . $cmname[$c] . '</MiddleName> 
                    <Surname>' . $clname[$c] . '</Surname> 
                    </PersonName>';
        }

        $gues = '';
        for ($l = 0; $l < $roomcount; $l++) {
            $adultval = $hotel_search_data['adultvalue'][$l];
            for ($a = 0; $a < $adultval; $a++) {
                //$afname[$a];
                $gues.='<GuestCount ResGuestRPH="' . $l . '" AgeQualifyingCode="10" Count="1" />';
            }
            $childvalue = $hotel_search_data['childvalue'][$l];
            for ($c = 0; $c < $childvalue; $c++) {
                $gues.='<GuestCount ResGuestRPH="' . $l . '" AgeQualifyingCode="8" Count="1" />';
            }
        }

        // $hotel_resp=$this->session->userdata('hotel_detail_resp');


        $xml_data = '
        <soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/"> 
    <soap:Body> 
        <OTA_HotelResRQ xmlns="http://www.opentravel.org/OTA/2003/05" CorrelationID="1234" TransactionIdentifier="122121" Version="1.003"> 
            <POS> 
                <Source ISOCurrency="INR"> 
                    <RequestorID MessagePassword="' . $this->password . '" ID="' . $this->propertyid . '"> 
                        <CompanyName Code="' . $this->username . '"></CompanyName> 
                    </RequestorID> 
                </Source> 
            </POS> 
            <UniqueID Type="" ID="" /> 
            <HotelReservations> 
                <HotelReservation> 
                    <RoomStays> 
                        <RoomStay> 
                            <RoomTypes> 
                                <RoomType NumberOfUnits="' . $roomcount . '" RoomTypeCode="' . $roomtypecode . '" /> 
                            </RoomTypes> 
                            <RatePlans> 
                                <RatePlan RatePlanCode="' . $rateplancode . '" /> 
                            </RatePlans> 
                            <GuestCounts IsPerRoom="false"> 
                                ' . $gues . '                               
                            </GuestCounts> 
                            <TimeSpan End="' . $checkout . '" Start="' . $checkin . '" /> 
                            <Total AmountBeforeTax="' . $amtbetax . '" CurrencyCode="INR"> 
                                <Taxes Amount="' . $tax . '" /> 
                            </Total> 
                            <BasicPropertyInfo HotelCode="' . $hotel_code . '" /> 
                            <Comments> 
                                <Comment> 
                                    <Text>non-smoking room requested;king bed</Text> 
                                </Comment> 
                            </Comments> 
                        </RoomStay> 
                    </RoomStays> 
                    <ResGuests> 
                        <ResGuest> 
                            <Profiles> 
                                <ProfileInfo> 
                                    <Profile ProfileType="1"> 
                                        <Customer>' .
                $pass
                . '<Telephone AreaCityCode="80" CountryAccessCode="91" Extension="0" PhoneNumber="' . $mobile . '" PhoneTechType="1"/> 
                                            <Email>' . $email . '</Email> 
                                            <Address> 
                                                <AddressLine>some text</AddressLine> 
                                                <AddressLine>some text</AddressLine> 
                                                <CityName>' . $city . '</CityName> 
                                                <PostalCode>' . $p_code . '</PostalCode> 
                                                <StateProv>KA</StateProv> 
                                                <CountryName>' . $country . '</CountryName> 
                                            </Address> 
                                        </Customer> 
                                    </Profile> 
                                </ProfileInfo> 
                            </Profiles> 
                        </ResGuest> 
                    </ResGuests> 
                    <ResGlobalInfo> 
                        <Guarantee GuaranteeType="PrePay" /> 
                    </ResGlobalInfo> 
                </HotelReservation> 
            </HotelReservations> 
        </OTA_HotelResRQ> 
    </soap:Body> 
</soap:Envelope>    

';
        //     echo $xml_data;exit;
        $provisionbooking = $this->postRQ_booking($xml_data);
//        echo '<pre>';
//        print_r($provisionbooking); //exit;
        $dom2 = new DOMDocument();
        $dom2->loadXML($provisionbooking);
        //Roomstays indicate the number of hotels

        if ($dom2->getElementsByTagName("HotelReservation")) {
//            echo '<pre>test Inside'.$UniqueIDval; exit;
            $HotelReservation = $dom2->getElementsByTagName("HotelReservation");
            foreach ($HotelReservation as $val) {
                $UniqueID = $val->getElementsByTagName("UniqueID");
                $UniqueIDval = $UniqueID->item(0)->getAttribute('ID');
            }
        } else {
            echo 'something went wrong please try again';
            sleep(10);
            redirect('hotel/index');
        }
        if (!$UniqueIDval) {
            echo 'something went wrong please try again';
            sleep(10);
            redirect('hotel/index');
        }

        $this->session->set_userdata('uniquproid', $UniqueIDval);
        $this->session->set_userdata('total_amnt', $amtbetax);

        // this is for final booking
        //payment gateway goes here
        // $this->load->view('payment_load');
        //payment gateway goes here
        redirect('agent_hotel/booking_final_tg');
    }

    function booking_final_tg() {
        //$pay_detail_id = $this->Hotel_Model->pay_details($_REQUEST['mihpayid'], $_REQUEST['status'], $_REQUEST['txnid'], $_REQUEST['amount'], $_REQUEST['error_Message']);
//        if ($_REQUEST['status'] != 'success') {
//            $data['status'] = 'Payment failed';
//            $this->oad->view('hotel/error_page', $data);
//            exit();
//        }

        $available_balance = $UniqueIDval = $this->session->userdata('uniquproid');
        $selected_room = $this->session->userdata('selected_room');
        $total_amount = $selected_room['total_amount'];





        $xmlbooking = '
        <soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/"> 
            <soap:Body> 
                <OTA_HotelResRQ xmlns="http://www.opentravel.org/OTA/2003/05" CorrelationID="flynstaytpd" TransactionIdentifier="tpdstay" Version="1.003"> 
                    <POS> 
                        <Source ISOCurrency="INR"> 
                            <RequestorID MessagePassword="' . $this->password . '" ID="' . $this->propertyid . '"> 
                                <CompanyName Code="' . $this->username . '"></CompanyName> 
                            </RequestorID> 
                        </Source> 
                    </POS> 
                    <UniqueID Type="23" ID="' . $UniqueIDval . '" /> 
                    <HotelReservations> 
                        <HotelReservation> 
                            <ResGlobalInfo> 
                                <Guarantee GuaranteeType="PrePay" /> 
                            </ResGlobalInfo> 
                        </HotelReservation> 
                    </HotelReservations> 
                </OTA_HotelResRQ> 
            </soap:Body> 
        </soap:Envelope>
        ';

        $hotel_booking = $this->postRQ_booking($xmlbooking);
//        echo '<pre>';
//        print_r($hotel_booking);
//        exit;



        $this->session->set_userdata('bookingresponse', $hotel_booking);


        // insert the booking into database
//        echo '<pre>';
//        print_r($this->session->all_userdata());
//        exit;
        // extracting the data from the booking response
        $dom2 = new DOMDocument();
        $dom2->loadXML($hotel_booking);
        if ($dom2->getElementsByTagName("HotelReservation")) {
            $HotelReservation = $dom2->getElementsByTagName("HotelReservation");
            foreach ($HotelReservation as $val) {
                $bookUniqueID = $val->getElementsByTagName("UniqueID");
                $bookUniqueIDval = $bookUniqueID->item(0)->getAttribute('ID');

                $RoomStay = $val->getElementsByTagName("RoomStay");
                foreach ($RoomStay as $val1) {
                    $bookRoomTypes = $val1->getElementsByTagName("RoomTypes");
                    foreach ($bookRoomTypes as $roomtypes) {
                        $bookRoomType = $roomtypes->getElementsByTagName("RoomType");
                        $bookRoomTypeCodeval = $bookRoomType->item(0)->getAttribute('RoomTypeCode');
                    }
                    $bookRoomRates = $val1->getElementsByTagName("RoomRates");
                    foreach ($bookRoomRates as $roomrates) {
                        $bookRoomRate = $roomrates->getElementsByTagName("RoomRate");
                        $bookRatePlanCodeval = $bookRoomRate->item(0)->getAttribute('RatePlanCode');
                    }

                    $bookTotal = $val1->getElementsByTagName("Total");
                    $bookAmountAfterTaxval = $bookTotal->item(0)->getAttribute('AmountAfterTax');
                    $bookCurrencyCodeval = $bookTotal->item(0)->getAttribute('CurrencyCode');

                    $bookBasicPropertyInfo = $val1->getElementsByTagName("BasicPropertyInfo");
                    foreach ($bookBasicPropertyInfo as $property) {
                        $bookHotelCodeval = $property->getAttribute('HotelCode');
                        $bookHotelNameval = $property->getAttribute('HotelName');
                        $bookAreaIDval = $property->getAttribute('AreaID');

                        $bookAddress = $property->getElementsByTagName("Address");
                        foreach ($bookAddress as $bookadd) {
                            foreach ($bookadd->getElementsByTagName('AddressLine') as $AddressLine) {
                                $bookaddressval = $AddressLine->nodeValue;
                            }
                            foreach ($bookadd->getElementsByTagName('CityName') as $CityName) {
                                $bookCityNameval = $CityName->nodeValue;
                            }
                            foreach ($bookadd->getElementsByTagName('StateProv') as $StateProv) {
                                $bookStateProvval = $StateProv->nodeValue;
                            }
                            foreach ($bookadd->getElementsByTagName('CountryName') as $CountryName) {
                                $bookCountryNameval = $CountryName->nodeValue;
                            }
                        }

                        $bookContactNumbersInfo = $property->getElementsByTagName("ContactNumbers");
                        foreach ($bookContactNumbersInfo as $number) {
                            $bookContactNumber = $number->getElementsByTagName("ContactNumber");
                            $bookAreaCityCodeval = $bookContactNumber->item(0)->getAttribute('AreaCityCode');
                            $bookCountryAccessCodeval = $bookContactNumber->item(0)->getAttribute('CountryAccessCode');
                            $bookPhoneNumberval = $bookContactNumber->item(0)->getAttribute('PhoneNumber');
                            $bookcontactnumberavl = $bookAreaCityCodeval . '-' . $bookCountryAccessCodeval . '-' . $bookPhoneNumberval;
                        }
                    }
                }
            }
        }
        //extracting the data from booking response end
        // Extracting Cancellation Policy-----------------------------------------------------------------
        $selectdroom = $this->session->userdata('selected_room');

//to get the room details
        $sesshotel_detail_resp = $this->session->userdata('hotel_detail_resp');
        $dom2 = new DOMDocument();
        $dom2->loadXML($sesshotel_detail_resp);
        $roomstay = $dom2->getElementsByTagName("RoomStay");
        foreach ($roomstay as $val) {
// getting the romm type data start using roomid from roomrat above
            $RoomType = $val->getElementsByTagName("RoomType");
            foreach ($RoomType as $val2) {
                $RoomTypeCode = $val2->getAttribute('RoomTypeCode');
                if ($RoomTypeCode == $bookRoomTypeCodeval) {
                    $RoomTypename = $val2->getAttribute('RoomType');
                }
            }
// to get the room details
// to get cancell policy
            $RatePlan = $val->getElementsByTagName("RatePlan");
            foreach ($RatePlan as $ratpln) {
                $RatePlanCodeval = $ratpln->getAttribute('RatePlanCode');
                //  echo '<script>alert("' . $bookRoomTypeCodeval . '");</script>';
                //  echo '<script>alert("' . $bookRatePlanCodeval . '");</script>';
                if ($RatePlanCodeval == $selectdroom['rateplancode']) {
                    //     echo '<script>alert("test");</script>';
                    $CancelPenalty = $ratpln->getElementsByTagName("CancelPenalty");
                    $NonRefundable = $CancelPenalty->item(0)->getAttribute('NonRefundable');

                    $CancelPenalties = $ratpln->getElementsByTagName("CancelPenalties");
                    $PenaltyDescription = $ratpln->getElementsByTagName("PenaltyDescription");

                    foreach ($PenaltyDescription->item(0)->getElementsByTagName("Text") as $Text) {
                        $PenaltyDescriptionval = $Text->nodeValue;
                        //break;
                    }
                    foreach ($PenaltyDescription->item(1)->getElementsByTagName("Text") as $Text) {
                        $PenaltyDescriptionval1 = $Text->nodeValue;
                        //break;
                    }
                }
            }
        }
        //Extracting Cancellation Policy ends-----------------------------------------------------------

        $sesshotel_search_data = $this->session->userdata('hotel_search_data');
        $sessselected_room = $this->session->userdata('selected_room');
        $sesspass_info = $this->session->userdata('pass_info');
        //echo '<pre>'; print_r($sesspass_info); exit;

        $sess_city = $sesshotel_search_data['city'];
        $sess_checkin = $sesshotel_search_data['checkin'];
        $sess_checkout = $sesshotel_search_data['checkout'];
        $sess_room_count = $sesshotel_search_data['room_count'];
        $sess_noofnights = $sesshotel_search_data['noofnights'];
        $sess_noofadult = $sesspass_info['noofadult'];
        $sess_noofchild = $sesspass_info['noofchild'];
        $sess_atitle = $sesspass_info['atitle'];
        $sess_afname = $sesspass_info['afname'];


        $lead_title = $sess_atitle['0'];
        $lead_firstname = $sess_afname['0'];
        $lead_mobile = $sesspass_info['pmobile'];
        $lead_country = $sesspass_info['pcountry'];
        $lead_city = $sesspass_info['pcity'];
        $lead_postalcode = $sesspass_info['pp_code'];
        $lead_email = $sesspass_info['pemail'];

        if ($this->session->userdata('agent_id')) {
            $agent_id = $this->session->userdata('agent_id');
        } else {
            $agent_id = 0;
        }




////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//        $desc = 'Towards Hotel Booking: ' . $result_id . '-' . $parent_transaction_id;
//
//        $this->Hotel_Model->update_transaction_amount($agent_id, $agent_no, $amount, $desc, $parent_transaction_id);
        $agent_no = $this->session->userdata('agent_no');
        $agent_id = $this->session->userdata('agent_id');
        $agent_available_balance = $this->Agent_Hotel_Model->get_agent_available_balance($agent_no);

        $available_balance = $agent_available_balance->closing_balance;

        $withdraw_amount = $total_amount;
        $closing_balance = $available_balance - $withdraw_amount;
///////////////////////////////////////////////////////

        $update = $this->Agent_Hotel_Model->insert_withdraw_status($agent_id, $agent_no, $withdraw_amount, $closing_balance);

        $sum_withdraw = $this->Agent_Hotel_Model->get_sum_of_withdraws($agent_no);


////////////////////////////        

        $this->Agent_Hotel_Model->update_agent_withdraw_amount($agent_no, $withdraw_amount, $closing_balance);


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //echo $user_id; exit;

        $data['hot_det'] = $this->Agent_Hotel_Model->get_hoteldescription($bookHotelCodeval);
        //  echo'<pre>';         print_r($data); exit;
        $hotel_disc = $data['hot_det']->description;
        $booking_id = $this->Agent_Hotel_Model->insert_hotel_booking($agent_id, $bookUniqueIDval, $sess_city, $sess_noofadult, $sess_noofchild, $sess_checkin, $sess_checkout, $sess_room_count, $sess_noofnights, $bookRoomTypeCodeval, $RoomTypename, $bookRatePlanCodeval, $bookAmountAfterTaxval, $bookCurrencyCodeval, $bookHotelCodeval, $bookHotelNameval, $hotel_disc, $lead_title, $lead_firstname, $lead_email, $lead_mobile, $lead_country, $lead_city, $lead_postalcode, $bookAreaIDval, $bookaddressval, $bookCityNameval, $bookStateProvval, $bookCountryNameval, $bookcontactnumberval, $NonRefundable, $PenaltyDescriptionval, $total_amount);
        $sess_amname = $sesspass_info['amname'];
        $sess_alname = $sesspass_info['alname'];
        $sess_pemail = $sesspass_info['pemail'];
        $sess_pmobile = $sesspass_info['pmobile'];
        $sess_pcity = $sesspass_info['pcity'];
        $sess_p_code = $sesspass_info['pp_code'];
        $sess_pcountry = $sesspass_info['pcountry'];


        for ($l = 0; $l < count($sess_atitle); $l++) {
            $this->Agent_Hotel_Model->insert_book_pass($booking_id, $bookUniqueIDval, $sess_atitle[$l], $sess_afname[$l], $sess_amname[$l], $sess_alname[$l], 'ADT', $sess_pcity, $sess_pcountry, $sess_pemail, $sess_pmobile);
        }

        $sess_ctitle = $sesspass_info['ctitle'];
        $sess_cfname = $sesspass_info['cfname'];
        $sess_cmname = $sesspass_info['cmname'];
        $sess_clname = $sesspass_info['clname'];
        for ($c = 0; $c < count($sess_ctitle); $c++) {
            $this->Agent_Hotel_Model->insert_book_pass($booking_id, $bookUniqueIDval, $sess_ctitle[$c], $sess_cfname[$c], $sess_cmname[$c], $sess_clname[$c], 'CHD', $sess_pcity, $sess_pcountry, $sess_pemail, $sess_pmobile);
        }



        $this->Agent_Hotel_Model->transaction_details($booking_id, $bookUniqueIDval, $pay_detail_id, $bookAmountAfterTaxval, $_REQUEST['txnid']);
        //updating transaction details
        // insert the booking into databse ends
//echo'<pre>';print_r($sesspass_info); exit;
        $this->ticket_email($bookUniqueIDval);
        redirect('agent_hotel/hotel_tickeet/' . $bookUniqueIDval, 'refresh');
    }

    function hotel_tickeet($bookUniqueIDval) {
        $data["hotel_details"] = $this->Agent_Hotel_Model->get_hotel_details($bookUniqueIDval);
        $data["passenger_details"] = $this->Agent_Hotel_Model->get_passenger_details($bookUniqueIDval);
        $data['hot_det'] = $this->Agent_Hotel_Model->get_hoteldescription($data["hotel_details"]->hotel_code);
        //echo '<pre>';        print_r($data); exit;
        $this->load->view('agent/hotel/hotel_eticket', $data);
        //Email ticket
    }

    function ticket_email($bookUniqueIDval) {
        ///$data["hotel_details"] = $this->Agent_Hotel_Model->get_hotel_details($bookUniqueIDval);
        $agent_id = $this->session->userdata('agent_id');
        $hotel_details = $this->Agent_Hotel_Model->get_hotel_details($bookUniqueIDval);
        $passenger_details = $this->Agent_Hotel_Model->get_passenger_details($bookUniqueIDval);
        $hot_det = $this->Agent_Hotel_Model->get_hoteldescription($hotel_details->hotel_code);
        //   $agent_info = $this->Agent_Hotel_Model->getAgentInfo($agent_id);
        //$data['tic_details'] = $this->Agent_Hotel_Model->get_ticket_details($bookUniqueIDval);
        //Email Function
        $email_id = $hotel_details->lead_email;
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
                    <img src="http://www.flyandstay.in/public/images/logo.png"></img>
                </div>
                <div class="support" align="right">
                    support@travelpd.com<br/>
                    123456789
                </div>

            </div>
            <div style="border:1px solid #CCC">
                <div class="ticket_details">
                    <p>
                        <strong>Dear ' . $hotel_details->lead_title . '. ' . $hotel_details->lead_firstname . '</strong><br>
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
                            <td>' . $hotel_details->lead_title . '.' . $hotel_details->lead_firstname . '</td>
                            <td><strong>Hotel Booking Number</strong></td>
                            <td>' . $hotel_details->Booking_reference_ID . '</td>
                        </tr>
                        <tr>
                            <td><strong>No. of Adults</strong></td>
                            <td>' . $hotel_details->noofadult . '</td>
                            <td><strong>Check - in</strong></td>
                            <td>' . $hotel_details->checkin . '</td>
                        </tr>
                        <tr>
                            <td><strong>No. of Children</strong></td>
                            <td>' . $hotel_details->noofchild . '</td>
                            <td><strong>Check - out</strong></td>
                            <td>' . $hotel_details->checkout . '</td>
                        </tr>
                        <tr>
                            <td><strong>Voucher Date</strong></td>
                            <td>' . $hotel_details->booking_date . '</td>
                            <td><strong>Rooms</strong></td>
                            <td>' . $hotel_details->noofrooms . '</td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>

                            <td><strong>Nights</strong></td>
                            <td>' . $hotel_details->noofnights . '</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="ticket_header"><strong>Hotel Details</strong></div>
            <div class="hotel_details">
                <div>
                    <table cellpadding="5" cellspacing="5">
                        <tr>
                            <td><img src="' . $hot_det->image . '" width="100px" height="100px"/></td>
                            <td>
                                <table>
                                    <tr><td><strong>Hotel Name</strong></td><td>' . $hotel_details->hotel_name . '</td></tr>
                                    <tr><td><strong>Description</strong></td><td align="justify">' . $hotel_details->hotel_discription . '</td></tr>

                                </table>
                            </td>
                        </tr>
                    </table>

                </div>
                <div>
                    <table width="100%" cellspacing="5" cellpadding="5">
                        <tr>
                            <td><strong>Address :</strong></td>
                            <td>' . $hotel_details->hotel_address . '</td>
                        </tr>
                        <tr>
                            <td><strong>City</strong></td>
                            <td>' . $hotel_details->hotel_city . '</td>
                        </tr>
                        <tr>
                            <td><strong>Phone</strong></td>
                            <td>' . $hotel_details->contact_number . '</td>
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
                        <td>' . $hotel_details->currency . ' ' . $hotel_details->netrate . '</td>
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
                                <td>' . $val5->firstname . '</td>
                                <td>' . $val5->middle_name . '</td>
                                <td>' . $val5->last_name . '</td>
                            </tr>
';
            } else {
                $msgbody.='  <tr>
                                <td>' . $val5->title . '</td>
                                <td>' . $val5->firstname . '</td>
                                <td>' . $val5->middle_name . '</td>
                                <td>' . $val5->last_name . '</td>
                            </tr>';
            }
        }

        $msgbody.='

                </table>
            </div>
            <div class="hotel_details">
                <ul>
                    <li>Guest must be over 18 years of age to check-in to this hotel.</li>
                    <li>As per Government regulations, it is mandatory for all guests above 18 years of age to carry a valid photo identity card & address proof at the time of check-in. Please note that failure to abide by this can result with the hotel denying a check-in. Hotels normally do not provide any refund for such cancellations.</li>
                    <li>The standard check-in and check-out times are 12 noon. Early check-in or late check-out is subject to hotel availability and may also be chargeable by the hotel. Any early check-in or late check-out request must be directed to and reconfirmed with the hotel directly. </li>
                    <li>Failure to check-in to the hotel, will attract the full cost of stay or penalty as per the hotel cancellation policy.</li>
                    <li>Hotels charge a compulsory Gala Dinner Supplement during Christmas, New Year' . 's eve or other special events and festivals like Diwali or Dusshera. These additional  charge are not included in the booking amount and will be collected directly at the hotel. </li>
                    <li>There might be seasonal variation in hotel tariff rates during Peak days, for example URS period in Ajmer or Lord Jagannath Rath Yatra in Puri, the room tariff differences if any will have to be borne and paid by the customer directly at the hotel, if the booking stay period falls during such dates.</li>
                    <li>All additional charges other than the room charges and inclusions as mentioned in the booking voucher are to be borne and paid separately during check-out. Please make sure that you are aware of all such charges that may comes as extras. Some of them can be WiFi costs, Mini Bar, Laundry Expenses, Telephone calls, Room Service, Snacks etc. </li>
                    <li>Some hotels may have policies that do not allow unmarried / unrelated couples or certain foreign nationalities to check-in without the correct documentation. No refund will be applicable in case the hotel denies check-in under such circumstances. If you have any doubts on this, do call us for any assistance</li>
                    <li>Any changes or booking modifications are subject to availability and charges may apply as per the hotel policies.</li>
           
                </ul>
               

                
                
            </div>
        </div>

';

        $curr_date = date("d/m/Y");
        $ci = get_instance();
        $ci->load->library('email');
        $ci->email->from('it@travelpd.com', 'flyandstay');
        $list = $email_id;
        $ci->email->to($list);
        $this->email->reply_to($list);
        $ci->email->subject('E-Ticket');
        $ci->email->message($msgbody);
        $ci->email->send();
        // exit;
        //echo $this->email->print_debugger();
    }

    function hotel_eticket($Booking_reference_ID) {
        //$data['hotel_details'] = $this->B2c_Model->get_hotel_booking_info($Booking_reference_ID);
        $data["hotel_details"] = $this->Agent_Hotel_Model->get_hotel_details($Booking_reference_ID);
        $data["passenger_details"] = $this->Agent_Hotel_Model->get_passenger_details($Booking_reference_ID);
        $data['hot_det'] = $this->Agent_Hotel_Model->get_hoteldescription($data["hotel_details"]->hotel_code);


        //echo '<pre/>';print_r($data);exit;		
        $this->load->view('agent/hotel/hotel_eticket', $data);
    }

    ///////////////////////////////                 Cancellation Policy starts                          /////////////////////////////
    function cancel_eticket() {

        $xml_data = '   
            
<soapenv:Envelope xmlns:soapenv = "http://schemas.xmlsoap.org/soap/envelope/"
                   xmlns:ns = "http://www.opentravel.org/OTA/2003/05">
    <soapenv:Header/>
    <soapenv:Body>
        <ns:OTA_CancelRQ CancelType = "Initiate" Version = "1.0" >
            <ns:POS>
                <ns:Source>
                    <ns:RequestorID ID = "' . $this->propertyid . '" MessagePassword = "' . $this->password . '"/>
                    <CompanyName Code = "' . $this->username . '"></CompanyName>
                </ns:Source>
            </ns:POS>
            <ns:UniqueID ID = "TGU0000945394" />
            <ns:Verification>
                <ns:PersonName>
                    <ns:Surname>Test</ns:Surname>
                </ns:PersonName>
                <ns:Email>techteam@travelguru.com</ns:Email>
            </ns:Verification>
            <ns:TPA_Extensions>
                <ns:CancelDates>
                    <ns:Dates>2013/23/03</ns:Dates>
                </ns:CancelDates>
                4.1.3. Response Parameters – Initiate Mode
                Element Descripton
                OTA_CancelRS Root Element
                OTA_CancelRS\CancelInfoRS\CancelRules
                CancelRule
                Contains all cancellation policy break-up applicable,
                each break-up can be termed as cancellation-window.
                @CancelByDate
                Date within which current booking can be cancelled. If
                empty, it denotes any date from current-day to date
                before 24-hour of check-in-date.
                @Amount
                Amount to be refunded if cancelled on its respective
                CancelByDate.
                @Type
                Type of Cancellation
                -"Nights" will define the number of nights cost that will
                be charged
                OTA_CancelRS\Comment
                Text Plain text blurb for the cancellation policy
                4.1.4. Sample Response XML – Initiate Mode
                <soap:Envelope xmlns:soap = "http://schemas.xmlsoap.org/soap/envelope/">
                    <soap:Body>
                        <OTA_CancelRS xmlns = "http://www.opentravel.org/OTA/2003/05"
                      Status = "PendingCancellation">
                            <Success />
                            <CancelInfoRS>
                                <CancelRules>
                                    <CancelRule CancelByDate = "" Amount = "71767.21" />
                                </CancelRules>
                            </CancelInfoRS>
                            <Comment>
                                <Text>Full refund if you cancel this booking.You might be charged
                                    upto the full cost of stay (including taxes &amp;
                                    service charge) if you do not
                                    check-in to the hotel.
                                </Text>
                            </Comment>
                        </OTA_CancelRS>
                    </soap:Body>
                </soap:Envelope>
            </ns:TPA_Extensions>
        </ns:OTA_CancelRQ>
    </soapenv:Body>
</soapenv:Envelope>
';
    }

    ///////////////////////////////                 Cancellation Policy ends                          /////////////////////////////
    // Codeigniter Validation Rules Ends here
    // Rate Matrix
}

