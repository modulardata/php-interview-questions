
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
error_reporting(1);
session_start();

class Flight extends CI_Controller {

    private $URL;
    private $client, $xml, $MidOfficeAgentID, $soapAction;
    private $airItinerary;
    private $sess_id;

    public function __construct() {
        parent::__construct();
        $this->load->model('Flight_Model');

        $this->URL = "http://203.189.91.127:6060/services/spm/spm";
        $this->MidOfficeAgentID = "1152";
        $this->soapAction = "http://tempuri.org/";

        if ($this->session->userdata('session_id') == '') {
            redirect('hotel/index', 'refresh');
        }

        $this->sess_id = $this->session->userdata('session_id');
    }

    public function index() {
        $this->load->view('home/index');
    }

    // Flight Search Code
    public function flight_search() {  //echo '<pre>';print_r($_POST);exit;	
        $this->form_validation->set_rules('originCity', 'From City', 'trim|required|callback_alpha_city_validation|xss_clean');
        $this->form_validation->set_rules('destinationCity', 'To City', 'trim|required|callback_alpha_city_validation|xss_clean');
        $this->form_validation->set_rules('departDate', 'Departure Date', 'required|callback_date_validation|xss_clean');

        $tripType = $this->input->post('tripType');
        if ($tripType == 'R') {
            $this->form_validation->set_rules('returnDate', 'Return Date', 'required|callback_date_validation|xss_clean');
        }

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('home/index');
        } else {
            //echo '<pre>';print_r($_POST);exit;					

            $tripType = $this->input->post('tripType');
            $originCity = $this->input->post('originCity');
            $destinationCity = $this->input->post('destinationCity');
            $departDate = $this->input->post('departDate');
            $returnDate = $this->input->post('returnDate');

            $adults = $this->input->post('adults');
            $childs = $this->input->post('childs');
            $infants = $this->input->post('infants');
            $cabinClass = $this->input->post('cabinClass');

            if (!empty($originCity)) {
                $session_data = $this->session->userdata('flight_search_data');
                //echo '<pre>';print_r($session_data);exit;			
                if (!empty($session_data)) {
                    $sess_tripType = $session_data['tripType'];
                    $sess_originCity = $session_data['originCity'];
                    $sess_destinationCity = $session_data['destinationCity'];
                    $sess_departDate = $session_data['departDate'];

                    if ($sess_tripType == 'R')
                        $sess_returnDate = $session_data['returnDate'];
                    else
                        $sess_returnDate = '';

                    $sess_adults = $session_data['adults'];
                    $sess_childs = $session_data['childs'];
                    $sess_infants = $session_data['infants'];
                    $sess_cabinClass = $session_data['cabinClass'];

                    if ($sess_tripType == $tripType && $sess_originCity == $originCity && $sess_destinationCity == $destinationCity && $sess_departDate == $sess_departDate && $sess_returnDate == $returnDate && $sess_adults == $adults && $sess_childs == $childs && $sess_infants == $infants && $sess_cabinClass == $cabinClass) {
                        $this->session->set_userdata('flight_search_activate', 1);
                    } else {
                        $this->session->set_userdata('flight_search_activate', '');
                        $this->Flight_Model->delete_flight_temp_result($this->sess_id);
                    }
                } else {
                    $this->session->set_userdata('flight_search_activate', '');
                    $this->Flight_Model->delete_flight_temp_result($this->sess_id);
                }


                $sess_array = array(
                    'tripType' => $tripType,
                    'originCity' => $originCity,
                    'destinationCity' => $destinationCity,
                    'departDate' => $departDate,
                    'returnDate' => $returnDate,
                    'adults' => $adults,
                    'childs' => $childs,
                    'infants' => $infants,
                    'cabinClass' => $cabinClass,
                );

                $this->session->set_userdata('flight_search_data', $sess_array);

                $api_name_f = 'yatra';
                $data['api_name_f'] = $api_name_f;

                $this->session->set_userdata('api_name_f', $api_name_f);

                $this->load->view('b2c/flight/search_progress', $data);
            } else {
                $this->load->view('home/index');
            }
        }
    }

    function search_progress() {
        //echo '<pre>';print_r($this->session->userdata);exit;	
        if ($this->session->userdata('flight_search_activate') != 1) {
            if (isset($_POST) && $_POST['api_name'] != '') {
                $api = $_POST['api_name'];

                switch ($api) {

                    case 'yatra':
                        $this->AirLowFareSearchRQ();
                        break;

                    default:
                        break;
                }
            }
        }


        $sess_search_data = $this->session->userdata('flight_search_data');


        if ($sess_search_data['tripType'] == 'S') {
            $flight_result = $this->Flight_Model->fetch_search_result($this->sess_id);
            //echo '<pre/>';print_r($flight_result);exit;
            $data['result'] = $flight_result;
            $this->load->view('b2c/flight/search_result', $data);
        }

        if ($sess_search_data['tripType'] == 'R') {
            $flight_result_oneway = $this->Flight_Model->fetch_search_result_oneway($this->sess_id);
            //echo '<pre/>';print_r($flight_result_oneway);exit;
            $data['result'] = $flight_result_oneway;

            $flight_result_round = $this->Flight_Model->fetch_search_result_round($this->sess_id);
            //echo '<pre/>';print_r($flight_result_round);exit;
            $data['result1'] = $flight_result_round;
            $this->load->view('b2c/flight/search_result_round', $data);
        }
    }

    // <-- AirLowFareSearchRQ-OneWay Starts Here -->

    public function AirLowFareSearchRQ() {
        $session_data = $this->session->userdata('flight_search_data');

        $tripType = $session_data['tripType'];
        $originCity = $session_data['originCity'];
        $destinationCity = $session_data['destinationCity'];
        $departDate = $session_data['departDate'];
        $returnDate = $session_data['returnDate'];

        $adults = $session_data['adults'];
        $childs = $session_data['childs'];
        $infants = $session_data['infants'];
        $cabinClass = $session_data['cabinClass'];

        $depDate = explode('/', $departDate);
        $departDate = $depDate[2] . '-' . $depDate[1] . '-' . $depDate[0] . 'T00:00:00';

        if ($tripType == 'R') {
            $retDate = explode('/', $returnDate);
            $returnDate = $retDate[2] . '-' . $retDate[1] . '-' . $retDate[0] . 'T00:00:00';
        }

        if (isset($adults) && $adults != 0) {
            $pax['ADT'] = $adults;
        }
        if (isset($childs) && $childs != 0) {
            $pax['CHD'] = $childs;
        }
        if (isset($infants) && $infants != 0) {
            $pax['INF'] = $infants;
        }

        $originCode = $this->get_airport_code($originCity);
        $destinationCode = $this->get_airport_code($destinationCity);


        $OriginDestinationInformation = '<OriginDestinationInformation>
			<DepartureDateTime WindowAfter="P0D" WindowBefore="P0D">' . $departDate . '</DepartureDateTime>
			<OriginLocation CodeContext="IATA" LocationCode="' . $originCode . '">' . $originCode . '</OriginLocation>
			<DestinationLocation CodeContext="IATA" LocationCode="' . $destinationCode . '">' . $destinationCode . '</DestinationLocation>
		</OriginDestinationInformation>';

        if ($tripType == 'R') {
            $OriginDestinationInformation .= '<OriginDestinationInformation>
			<DepartureDateTime WindowAfter="P0D" WindowBefore="P0D">' . $returnDate . '</DepartureDateTime>
			<OriginLocation CodeContext="IATA" LocationCode="' . $destinationCode . '">' . $destinationCode . '</OriginLocation>
			<DestinationLocation CodeContext="IATA" LocationCode="' . $originCode . '">' . $originCode . '</DestinationLocation>
		</OriginDestinationInformation>';
        }

        $TravelerInfo = $this->getTravelerInfo($pax);

        $this->xml = '<?xml version="1.0" encoding="UTF-8"?>
		<soap:Envelope xmlns="http://www.opentravel.org/OTA/2003/05" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:wsse="http://schemas.xmlsoap.org/ws/2002/12/secext">
			<soap:Body>		
			<OTA_AirLowFareSearchRQ EchoToken="0" SequenceNmbr="0" TransactionIdentifier="0" Version="1.001" xmlns="http://www.opentravel.org/OTA/2003/05" DirectFlightsOnly="false">
			<POS xmlns="http://www.opentravel.org/OTA/2003/05">
				<Source AgentSine="" PseudoCityCode="NPCK" TerminalID="1">
					<RequestorID ID="AFFILIATE"></RequestorID>
				</Source>
				<YatraRequests>
					<YatraRequest DoNotHitCache="false" DoNotCache="false" YatraRequestTypeCode="SMPA" Description="" MidOfficeAgentID="' . $this->MidOfficeAgentID . '" AffiliateID="YTFABTRAVEL"/>
				</YatraRequests>
			</POS>
					
					' . $OriginDestinationInformation . '
					
					<SpecificFlightInfo>
						<Airline Code=""/>
					</SpecificFlightInfo>
					<TravelerInfoSummary>
						<AirTravelerAvail>						
							' . $TravelerInfo . '							
						</AirTravelerAvail>
					</TravelerInfoSummary>
					<TravelPreferences>
						<CabinPref Cabin="' . $cabinClass . '"/>
					</TravelPreferences>
				</OTA_AirLowFareSearchRQ>
			</soap:Body>
		</soap:Envelope>';

     //   echo $this->xml;
//exit;
        $AirLowFareSearchRS = $this->postRQ($this->xml);
        $AirLowFareSearchRS = str_replace("ns1:", '', $AirLowFareSearchRS);
//echo '<pre>';print_r($AirLowFareSearchRS);exit;
        //Store Session variables
        $_SESSION['AirLowFareSearchRS_xml'] = $AirLowFareSearchRS;
        //$this->session->set_userdata('AirLowFareSearchRS_xml',$AirLowFareSearchRS);	
        //echo '<pre/>';print_r($AirLowFareSearchRS_xml);exit;

        $this->load->library('xml_to_array');
        $AirLowFareSearchRS_array = $this->xml_to_array->XmlToArray($AirLowFareSearchRS);
        //echo '<pre/>';print_r($AirLowFareSearchRS_array);exit;		

        $PricedItinerary = $AirLowFareSearchRS_array['soapenv:Body']['OTA_AirLowFareSearchRS']['PricedItineraries']['PricedItinerary'];

        for ($i = 0; $i < count($PricedItinerary); $i++) {
            $PricedItinerary_attributes = $PricedItinerary[$i]['@attributes'];
            $FareType = $PricedItinerary_attributes['FareType'];
            $OriginDestinationRPH = $PricedItinerary_attributes['OriginDestinationRPH'];
            $SequenceNumber = $PricedItinerary_attributes['SequenceNumber'];

            $AirItinerary = $PricedItinerary[$i]['AirItinerary'];
            $OriginDestinationOption = $AirItinerary['OriginDestinationOptions']['OriginDestinationOption'];

            $OriginDestinationOption_attributes = $OriginDestinationOption['@attributes'];
            $Total_Duration = $OriginDestinationOption_attributes['Duration'];
            $FlightID = $OriginDestinationOption_attributes['FlightID'];
            $SupplierSystem = $OriginDestinationOption_attributes['SupplierSystem'];
            $UniqueIdentifier = $OriginDestinationOption_attributes['UniqueIdentifier'];

            $Stops = 0;
            $FlightSegment = $OriginDestinationOption['FlightSegment'];
            if (isset($FlightSegment[0])) {
                for ($j = 0; $j < count($FlightSegment); $j++) {
                    $FlightSegment_attributes = $FlightSegment[$j]['@attributes'];
                    $ArrivalDateTime_arr[$j] = $FlightSegment_attributes['ArrivalDateTime'];
                    $DepartureDateTime_arr[$j] = $FlightSegment_attributes['DepartureDateTime'];
                    $Duration_arr[$j] = $FlightSegment_attributes['Duration'];
                    $FlightNumber_arr[$j] = $FlightSegment_attributes['FlightNumber'];

                    if (isset($FlightSegment_attributes['Status']))
                        $SeatToSell_arr[$j] = $FlightSegment_attributes['Status'];

                    //$FareType_arr[$j] = $FlightSegment[$j]['BookingClassAvail']['@attributes']['FareType'];
                    $ResBookDesigCode_arr[$j] = $FlightSegment[$j]['BookingClassAvail']['@attributes']['ResBookDesigCode'];
                    if (isset($FlightSegment[$j]['BookingClassAvail']['@attributes']['Status']))
                        $SeatToSell_arr1[$j] = $FlightSegment[$j]['BookingClassAvail']['@attributes']['Status'];

                    $Departure_AirPortName_arr[$j] = $FlightSegment[$j]['DepartureAirport']['@attributes']['AirPortName'];
                    $Departure_CityName_arr[$j] = $FlightSegment[$j]['DepartureAirport']['@attributes']['CityName'];
                    $Departure_LocationCode_arr[$j] = $FlightSegment[$j]['DepartureAirport']['@attributes']['LocationCode'];

                    if (isset($FlightSegment[$j]['DepartureAirport']['@attributes']['Terminal']))
                        $Departure_Terminal_arr[$j] = $FlightSegment[$j]['DepartureAirport']['@attributes']['Terminal'];

                    $Arrival_AirPortName_arr[$j] = $FlightSegment[$j]['ArrivalAirport']['@attributes']['AirPortName'];
                    $Arrival_CityName_arr[$j] = $FlightSegment[$j]['ArrivalAirport']['@attributes']['CityName'];
                    $Arrival_LocationCode_arr[$j] = $FlightSegment[$j]['ArrivalAirport']['@attributes']['LocationCode'];

                    if (isset($FlightSegment[$j]['ArrivalAirport']['@attributes']['Terminal']))
                        $Arrival_Terminal_arr[$j] = $FlightSegment[$j]['ArrivalAirport']['@attributes']['Terminal'];

                    $AirEquipType_arr[$j] = $FlightSegment[$j]['Equipment']['@attributes']['AirEquipType'];

                    $MarketingAirline_Code_arr[$j] = $FlightSegment[$j]['MarketingAirline']['@attributes']['Code'];
                    $MarketingAirline_Name_arr[$j] = $FlightSegment[$j]['MarketingAirline']['@attributes']['Name'];

                    $Stops++;
                }

                $ArrivalDateTime = implode(',', $ArrivalDateTime_arr);
                $DepartureDateTime = implode(',', $DepartureDateTime_arr);
                $Duration = implode(',', $Duration_arr);
                $FlightNumber = implode(',', $FlightNumber_arr);

                if (!empty($SeatToSell_arr))
                    $SeatToSell = implode(',', $SeatToSell_arr);
                else
                    $SeatToSell = '';

                //$FareType = implode(',',$FareType_arr);
                $ResBookDesigCode = implode(',', $ResBookDesigCode_arr);

                if (empty($SeatToSell_arr))
                    $SeatToSell = implode(',', $SeatToSell_arr1);


                $Departure_AirPortName = implode(',', $Departure_AirPortName_arr);
                $Departure_CityName = implode(',', $Departure_CityName_arr);
                $Departure_LocationCode = implode(',', $Departure_LocationCode_arr);

                if (!empty($Departure_Terminal_arr))
                    $Departure_Terminal = implode(',', $Departure_Terminal_arr);
                else
                    $Departure_Terminal = '';

                $Arrival_AirPortName = implode(',', $Arrival_AirPortName_arr);
                $Arrival_CityName = implode(',', $Arrival_CityName_arr);
                $Arrival_LocationCode = implode(',', $Arrival_LocationCode_arr);

                if (!empty($Arrival_Terminal_arr))
                    $Arrival_Terminal = implode(',', $Arrival_Terminal_arr);
                else
                    $Arrival_Terminal = '';

                $AirEquipType = implode(',', $AirEquipType_arr);
                $MarketingAirline_Code = implode(',', $MarketingAirline_Code_arr);
                $MarketingAirline_Name = implode(',', $MarketingAirline_Name_arr);
            }
            else {
                $FlightSegment_attributes = $FlightSegment['@attributes'];
                $ArrivalDateTime = $FlightSegment_attributes['ArrivalDateTime'];
                $DepartureDateTime = $FlightSegment_attributes['DepartureDateTime'];
                $Duration = $FlightSegment_attributes['Duration'];
                $FlightNumber = $FlightSegment_attributes['FlightNumber'];

                if (isset($FlightSegment_attributes['Status']))
                    $SeatToSell = $FlightSegment_attributes['Status'];

                //$FareType = $FlightSegment['BookingClassAvail']['@attributes']['FareType'];
                $ResBookDesigCode = $FlightSegment['BookingClassAvail']['@attributes']['ResBookDesigCode'];
                if (isset($FlightSegment['BookingClassAvail']['@attributes']['Status']))
                    $SeatToSell = $FlightSegment['BookingClassAvail']['@attributes']['Status'];

                $Departure_AirPortName = $FlightSegment['DepartureAirport']['@attributes']['AirPortName'];
                $Departure_CityName = $FlightSegment['DepartureAirport']['@attributes']['CityName'];
                $Departure_LocationCode = $FlightSegment['DepartureAirport']['@attributes']['LocationCode'];

                if (isset($FlightSegment['DepartureAirport']['@attributes']['Terminal']))
                    $Departure_Terminal = $FlightSegment['DepartureAirport']['@attributes']['Terminal'];
                else
                    $Departure_Terminal = '';

                $Arrival_AirPortName = $FlightSegment['ArrivalAirport']['@attributes']['AirPortName'];
                $Arrival_CityName = $FlightSegment['ArrivalAirport']['@attributes']['CityName'];
                $Arrival_LocationCode = $FlightSegment['ArrivalAirport']['@attributes']['LocationCode'];

                if (isset($FlightSegment['ArrivalAirport']['@attributes']['Terminal']))
                    $Arrival_Terminal = $FlightSegment['ArrivalAirport']['@attributes']['Terminal'];
                else
                    $Arrival_Terminal = '';

                $AirEquipType = $FlightSegment['Equipment']['@attributes']['AirEquipType'];

                $MarketingAirline_Code = $FlightSegment['MarketingAirline']['@attributes']['Code'];
                $MarketingAirline_Name = $FlightSegment['MarketingAirline']['@attributes']['Name'];
            }

            $AirItineraryPricingInfo = $PricedItinerary[$i]['AirItineraryPricingInfo'];
            $BaseFare = $AirItineraryPricingInfo['ItinTotalFare']['BaseFare']['@attributes']['Amount'];
            $CurrencyCode = $AirItineraryPricingInfo['ItinTotalFare']['BaseFare']['@attributes']['CurrencyCode'];

            $Tax = $AirItineraryPricingInfo['ItinTotalFare']['Taxes']['Tax'];
            if (isset($Tax[0])) {
                for ($k = 0; $k < count($Tax); $k++) {
                    $Tax_attributes = $Tax[$k]['@attributes'];
                    $Tax_Amount_arr[$k] = $Tax_attributes['Amount'];
                    $TaxCode_arr[$k] = $Tax_attributes['TaxCode'];

                    if (isset($Tax_attributes['Description']))
                        $TaxDescription_arr[$k] = $Tax_attributes['Description'];
                    else
                        $TaxDescription_arr[$k] = '';
                }

                $Tax_Amount = implode(',', $Tax_Amount_arr);
                $TaxCode = implode(',', $TaxCode_arr);
                $TaxDescription = implode(',', $TaxDescription_arr);
            }
            else {
                $Tax_attributes = $Tax['@attributes'];
                $Tax_Amount = $Tax_attributes['Amount'];
                $TaxCode = $Tax_attributes['TaxCode'];
                if (isset($Tax_attributes['Description']))
                    $TaxDescription = $Tax_attributes['Description'];
                else
                    $TaxDescription = '';
            }

            $TotalFare = $AirItineraryPricingInfo['ItinTotalFare']['TotalFare']['@attributes']['Amount'];

            $ServiceTax = $AirItineraryPricingInfo['ItinTotalFare']['ServiceTax']['@attributes']['Amount'];

            $Fee = $AirItineraryPricingInfo['ItinTotalFare']['Fees']['Fee'];
            if (isset($Fee[0])) {
                for ($k = 0; $k < count($Fee); $k++) {
                    $Fee_attributes = $Fee[$k]['@attributes'];
                    $Fee_Amount_arr[$k] = $Fee_attributes['Amount'];
                    if (isset($Fee_attributes['FeeCode']))
                        $FeeCode_arr[$k] = $Fee_attributes['FeeCode'];
                    else
                        $FeeCode_arr[$k] = '';
                }

                $Fee_Amount = implode(',', $Fee_Amount_arr);
                if (!empty($FeeCode_arr))
                    $FeeCode = implode(',', $FeeCode_arr);
                else
                    $FeeCode = '';
            }
            else {
                $Fee_attributes = $Fee['@attributes'];
                $Fee_Amount = $Fee_attributes['Amount'];
                if (isset($Fee_attributes['FeeCode']))
                    $FeeCode = $Fee_attributes['FeeCode'];
                else
                    $FeeCode = '';
            }

            $PTC_FareBreakdown = $AirItineraryPricingInfo['PTC_FareBreakdowns']['PTC_FareBreakdown'];
            if (isset($PTC_FareBreakdown[0])) {
                for ($l = 0; $l < count($PTC_FareBreakdown); $l++) {
                    $PassengerType_arr[$l] = $PTC_FareBreakdown[$l]['PassengerTypeQuantity']['@attributes']['Code'];
                    $PassengerQuantity_arr[$l] = $PTC_FareBreakdown[$l]['PassengerTypeQuantity']['@attributes']['Quantity'];
                    $PassengerBaseFare_arr[$l] = $PTC_FareBreakdown[$l]['PassengerFare']['BaseFare']['@attributes']['Amount'];

                    $PassengerTax = $PTC_FareBreakdown[$l]['PassengerFare']['Taxes']['Tax'];
                    if (isset($PassengerTax[0])) {
                        for ($m = 0; $m < count($PassengerTax); $m++) {
                            $PassengerTax_attributes = $PassengerTax[$m]['@attributes'];
                            $PassengerTax_Amount_arr[$m] = $PassengerTax_attributes['Amount'];
                            $PassengerTaxCode_arr[$m] = $PassengerTax_attributes['TaxCode'];

                            if (isset($PassengerTax_attributes['Description']))
                                $PassengerTaxDescription_arr[$m] = $PassengerTax_attributes['Description'];
                            else
                                $PassengerTaxDescription_arr[$m] = '';
                        }

                        $PassengerTax_Amount = implode(',', $PassengerTax_Amount_arr);
                        $PassengerTaxCode = implode(',', $PassengerTaxCode_arr);
                        $PassengerTaxDescription = implode(',', $PassengerTaxDescription_arr);
                    }
                    else {
                        $PassengerTax_attributes = $PassengerTax['@attributes'];
                        $PassengerTax_Amount = $PassengerTax_attributes['Amount'];
                        $PassengerTaxCode = $PassengerTax_attributes['TaxCode'];
                        if (isset($PassengerTax_attributes['Description']))
                            $PassengerTaxDescription = $PassengerTax_attributes['Description'];
                        else
                            $PassengerTaxDescription = '';
                    }

                    $PassengerTotalFare_arr[$l] = $PTC_FareBreakdown[$l]['PassengerFare']['TotalFare']['@attributes']['Amount'];
                    $PassengerServiceTax_arr[$l] = $PTC_FareBreakdown[$l]['PassengerFare']['ServiceTax']['@attributes']['Amount'];
                }

                $PassengerType = implode(',', $PassengerType_arr);
                $PassengerQuantity = implode(',', $PassengerQuantity_arr);
                $PassengerBaseFare = implode(',', $PassengerBaseFare_arr);

                $PassengerTotalFare = implode(',', $PassengerTotalFare_arr);
                $PassengerServiceTax = implode(',', $PassengerServiceTax_arr);
            }
            else {
                $PassengerType = $PTC_FareBreakdown['PassengerTypeQuantity']['@attributes']['Code'];
                $PassengerQuantity = $PTC_FareBreakdown['PassengerTypeQuantity']['@attributes']['Quantity'];
                $PassengerBaseFare = $PTC_FareBreakdown['PassengerFare']['BaseFare']['@attributes']['Amount'];

                $PassengerTax = $PTC_FareBreakdown['PassengerFare']['Taxes']['Tax'];
                if (isset($PassengerTax[0])) {
                    for ($n = 0; $n < count($PassengerTax); $n++) {
                        $PassengerTax_attributes = $PassengerTax[$n]['@attributes'];
                        $PassengerTax_Amount_arr[$n] = $PassengerTax_attributes['Amount'];
                        $PassengerTaxCode_arr[$n] = $PassengerTax_attributes['TaxCode'];
                        if (isset($PassengerTax_attributes['Description']))
                            $PassengerTaxDescription_arr[$n] = $PassengerTax_attributes['Description'];
                        else
                            $PassengerTaxDescription_arr[$n] = '';
                    }

                    $PassengerTax_Amount = implode(',', $PassengerTax_Amount_arr);
                    $PassengerTaxCode = implode(',', $PassengerTaxCode_arr);
                    if (!empty($PassengerTaxDescription_arr))
                        $PassengerTaxDescription = implode(',', $PassengerTaxDescription_arr);
                    else
                        $PassengerTaxDescription = '';
                }
                else {
                    $PassengerTax_attributes = $PassengerTax['@attributes'];
                    $PassengerTax_Amount = $PassengerTax_attributes['Amount'];
                    $PassengerTaxCode = $PassengerTax_attributes['TaxCode'];

                    if (isset($PassengerTax_attributes['Description']))
                        $PassengerTaxDescription = $PassengerTax_attributes['Description'];
                    else
                        $PassengerTaxDescription = '';
                }

                $PassengerTotalFare = $PTC_FareBreakdown['PassengerFare']['TotalFare']['@attributes']['Amount'];
                $PassengerServiceTax = $PTC_FareBreakdown['PassengerFare']['ServiceTax']['@attributes']['Amount'];
            }

            $api_name = 'yatra';
            $Service_Type = 1;
            $insert = $this->Flight_Model->insert_flight_temp_results($i, $this->sess_id, $api_name, $SequenceNumber, $UniqueIdentifier, $OriginDestinationRPH, $FlightID, $SupplierSystem, $originCode, $destinationCode, $adults, $childs, $infants, $Total_Duration, $ArrivalDateTime, $DepartureDateTime, $Duration, $FlightNumber, $SeatToSell, $FareType, $ResBookDesigCode, $Departure_AirPortName, $Departure_CityName, $Departure_LocationCode, $Departure_Terminal, $Arrival_AirPortName, $Arrival_CityName, $Arrival_LocationCode, $Arrival_Terminal, $AirEquipType, $MarketingAirline_Code, $MarketingAirline_Name, $Stops, $BaseFare, $CurrencyCode, $Tax_Amount, $TaxCode, $TaxDescription, $TotalFare, $ServiceTax, $Fee_Amount, $FeeCode, $PassengerType, $PassengerQuantity, $PassengerBaseFare, $PassengerTax_Amount, $PassengerTaxCode, $PassengerTaxDescription, $PassengerTotalFare, $PassengerServiceTax, $tripType, $Service_Type);
        }

        return $insert;
    }

    // <-- AirLowFareSearchRQ-OneWay Ends Here -->

    function getTravelerInfo($paxlist) {
        $paxxml = "";
        foreach ($paxlist as $paxcode => $paxcount) {
            $paxxml.='<PassengerTypeQuantity Code="' . $paxcode . '" farebasiscode="T" Quantity="' . $paxcount . '"></PassengerTypeQuantity>';
        }

        $this->session->set_userdata('TravelerInfoXML', $paxxml);
        //$_SESSION['TravelerInfoXML'] = $paxxml;		

        return $paxxml;
    }

    // Flight Details 
    function flight_details() {
        //echo '<pre/>';print_r($_POST);exit;	
        if (isset($_POST['onwardFlightId'])) {
            $onwardFlightId = $_POST['onwardFlightId'];
            $onwardIdVal = $_POST['onwardIdVal'];
            $result = $this->Flight_Model->get_selected_flightdetails($onwardFlightId);
            $data['flight_result'] = $result;

            if (isset($_POST['returnFlightId'])) {
                $returnFlightId = $_POST['returnFlightId'];
                $returnIdVal = $_POST['returnIdVal'];
                $result_return = $this->Flight_Model->get_selected_flightdetails($returnFlightId);
                $data['flight_result_return'] = $result_return;
            }

            $this->load->library('xml_2_array');
            $this->load->library('array_2_xml');

            $AirLowFareSearchRS_xml = $_SESSION['AirLowFareSearchRS_xml'];
            //$AirLowFareSearchRS_xml = $this->session->userdata('AirLowFareSearchRS_xml');	
            $AirLowFareSearchRS_arr = $this->xml_2_array->createArray($AirLowFareSearchRS_xml);
            //echo "<pre/>";print_r($AirLowFareSearchRS_arr);exit;

            $OriginDestinationOption = "";
            if (isset($onwardIdVal) && $onwardIdVal != "") {
                $q = $onwardIdVal;
                $xml = $this->array_2_xml->createXML('ns1:OriginDestinationOption', $AirLowFareSearchRS_arr['soapenv:Envelope']['soapenv:Body']['OTA_AirLowFareSearchRS']['PricedItineraries']['PricedItinerary'][$q]['AirItinerary']['OriginDestinationOptions']);

                $OriginDestinationOption = str_replace('<?xml version="1.0" encoding="UTF-8"?>', '', $xml->saveXML());
                $OriginDestinationOption = str_replace('<ns1:OriginDestinationOption>', '', $OriginDestinationOption);
                $OriginDestinationOption = str_replace('</ns1:OriginDestinationOption>', '', $OriginDestinationOption);

                //echo $OriginDestinationOptions;exit;
            }

            $OriginDestinationOption_r = "";
            if (isset($returnIdVal) && $returnIdVal != "") {
                $r = $returnIdVal;
                $xml = $this->array_2_xml->createXML('ns1:OriginDestinationOption', $AirLowFareSearchRS_arr['soapenv:Envelope']['soapenv:Body']['OTA_AirLowFareSearchRS']['PricedItineraries']['PricedItinerary'][$r]['AirItinerary']['OriginDestinationOptions']);

                $OriginDestinationOption_r = str_replace('<?xml version="1.0" encoding="UTF-8"?>', '', $xml->saveXML());
                $OriginDestinationOption_r = str_replace('<ns1:OriginDestinationOption>', '', $OriginDestinationOption_r);
                $OriginDestinationOption_r = str_replace('</ns1:OriginDestinationOption>', '', $OriginDestinationOption_r);

                //echo $OriginDestinationOption_r;exit;
            }


            $airitinerary = '<AirItinerary><OriginDestinationOptions>' . $OriginDestinationOption . $OriginDestinationOption_r . '</OriginDestinationOptions></AirItinerary>';
            //echo "<pre/>";print_r($airitinerary);exit;

            $AirPriceRS = $this->AirPriceRQ($airitinerary);
            //echo "<pre/>";print_r($AirPriceRS);exit;

            $AirPriceRS_arr = $this->xml_2_array->createArray($AirPriceRS);
            $this->session->set_userdata('AirPriceRS_arr', $AirPriceRS_arr);
            //$_SESSION['AirPriceRS_arr'] = $AirPriceRS_arr;	

            $data['AirPriceRS_arr'] = $AirPriceRS_arr;

            $this->load->view('b2c/flight/booking', $data);
        } else {
            redirect('flight/search_progress', 'refresh');
        }
    }

    // AirPriceRQ Xml starts here	
    public function AirPriceRQ($airitinerary) {
        $this->xml = '<?xml version="1.0" encoding="UTF-8"?>
			<soap:Envelope xmlns="http://www.opentravel.org/OTA/2003/05" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:wsse="http://schemas.xmlsoap.org/ws/2002/12/secext">
			 <soap:Body>			 
			   <OTA_AirPriceRQ xmlns="http://www.opentravel.org/OTA/2003/05">
			<POS xmlns="http://www.opentravel.org/OTA/2003/05">
				<Source AgentSine="" PseudoCityCode="NPCK" TerminalID="1">
					<RequestorID ID="AFFILIATE"></RequestorID>
				</Source>
				<YatraRequests>
					<YatraRequest YatraRequestTypeCode="SMPA" Description="" MidOfficeAgentID="' . $this->MidOfficeAgentID . '" AgentEmailID="" AgentTypeCode="" AffiliateID="YTFABTRAVEL"/>
				</YatraRequests>
			</POS>
			   <SpecificFlightInfo>
					<BookingClassPref ResBookDesigCode=""></BookingClassPref>
			   	</SpecificFlightInfo>
				' . $airitinerary . '
				<TravelerInfoSummary>
					<AirTravelerAvail>' . $this->session->userdata('TravelerInfoXML') . '</AirTravelerAvail>
			   </TravelerInfoSummary>
			  </OTA_AirPriceRQ>
			 </soap:Body>
			</soap:Envelope>';

        //echo $this->xml;

        $AirPriceRS = $this->PostRQ($this->xml);

        return $AirPriceRS;
    }

    // AirPriceRQ Xml Ends here		

    function confirm_booking() {
        //echo '<pre/>';print_r($_POST);exit;
        //$_SESSION['user_booking_info'] = $_POST;
        $this->session->set_userdata('user_booking_info', $_POST);

        if (isset($_POST['onwardFlightId'])) {
            $flight_result = $this->Flight_Model->get_selected_flightdetails($_POST['onwardFlightId']);

            $Origin = $flight_result->Origin;
            $Destination = $flight_result->Destination;
            $Adults = $flight_result->Adults;
            $Childs = $flight_result->Childs;
            $Infants = $flight_result->Infants;

            $ArrivalDateTime = $flight_result->ArrivalDateTime;
            $DepartureDateTime = $flight_result->DepartureDateTime;
            $FlightNumber = $flight_result->FlightNumber;
            $FareType = $flight_result->FareType;

            $Departure_AirPortName = $flight_result->Departure_AirPortName;
            $Departure_CityName = $flight_result->Departure_CityName;
            $Departure_LocationCode = $flight_result->Departure_LocationCode;
            $Departure_Terminal = $flight_result->Departure_Terminal;

            $Arrival_AirPortName = $flight_result->Arrival_AirPortName;
            $Arrival_CityName = $flight_result->Arrival_CityName;
            $Arrival_LocationCode = $flight_result->Arrival_LocationCode;
            $Arrival_Terminal = $flight_result->Arrival_Terminal;

            $AirEquipType = $flight_result->AirEquipType;
            $MarketingAirline_Code = $flight_result->MarketingAirline_Code;
            $MarketingAirline_Name = $flight_result->MarketingAirline_Name;
            $BaseFare = $flight_result->BaseFare;

            $CurrencyCode = $flight_result->CurrencyCode;
            $Tax_Amount = $flight_result->Tax_Amount;
            $Tax_Code = $flight_result->Tax_Code;
            $Tax_Description = $flight_result->Tax_Description;

            $TotalFare = $flight_result->TotalFare;
            $ServiceTax = $flight_result->ServiceTax;
            $Fee_Amount = $flight_result->Fee_Amount;
            $Stops = $flight_result->Stops;

            $PassengerType = $flight_result->PassengerType;
            $PassengerBaseFare = $flight_result->PassengerBaseFare;
            $PassengerTax_Amount = $flight_result->PassengerTax_Amount;
            $PassengerTax_Code = $flight_result->PassengerTax_Code;
            $PassengerTax_Description = $flight_result->PassengerTax_Description;
            $PassengerTotalFare = $flight_result->PassengerTotalFare;

            $PassengerServiceTax = $flight_result->PassengerServiceTax;
            $Payment_Charge = $flight_result->Payment_Charge;
            $Admin_Markup = $flight_result->Admin_Markup;
            $Trip_Type = $flight_result->Trip_Type;
            $Service_Type = $flight_result->Service_Type;
            $SequenceNumber = $flight_result->SequenceNumber;

            $ResBookDesigCode = $flight_result->ResBookDesigCode;

            $TotalFare_r = 0;

            if (isset($_POST['returnFlightId']) && $_POST['returnFlightId'] != '') {
                $flight_result_return = $this->Flight_Model->get_selected_flightdetails($_POST['returnFlightId']);
                $Origin_r = $flight_result_return->Destination;
                $Destination_r = $flight_result_return->Origin;
                $Adults_r = $flight_result_return->Adults;
                $Childs_r = $flight_result_return->Childs;
                $Infants_r = $flight_result_return->Infants;

                $ArrivalDateTime_r = $flight_result_return->ArrivalDateTime;
                $DepartureDateTime_r = $flight_result_return->DepartureDateTime;
                $FlightNumber_r = $flight_result_return->FlightNumber;
                $FareType_r = $flight_result_return->FareType;

                $Departure_AirPortName_r = $flight_result_return->Departure_AirPortName;
                $Departure_CityName_r = $flight_result_return->Departure_CityName;
                $Departure_LocationCode_r = $flight_result_return->Departure_LocationCode;
                $Departure_Terminal_r = $flight_result_return->Departure_Terminal;

                $Arrival_AirPortName_r = $flight_result_return->Arrival_AirPortName;
                $Arrival_CityName_r = $flight_result_return->Arrival_CityName;
                $Arrival_LocationCode_r = $flight_result_return->Arrival_LocationCode;
                $Arrival_Terminal_r = $flight_result_return->Arrival_Terminal;

                $AirEquipType_r = $flight_result_return->AirEquipType;
                $MarketingAirline_Code_r = $flight_result_return->MarketingAirline_Code;
                $MarketingAirline_Name_r = $flight_result_return->MarketingAirline_Name;
                $BaseFare_r = $flight_result_return->BaseFare;

                $CurrencyCode_r = $flight_result_return->CurrencyCode;
                $Tax_Amount_r = $flight_result_return->Tax_Amount;
                $Tax_Code_r = $flight_result_return->Tax_Code;
                $Tax_Description_r = $flight_result_return->Tax_Description;

                $TotalFare_r = $flight_result_return->TotalFare;
                $ServiceTax_r = $flight_result_return->ServiceTax;
                $Fee_Amount_r = $flight_result_return->Fee_Amount;
                $Stops_r = $flight_result_return->Stops;

                $PassengerType_r = $flight_result_return->PassengerType;
                $PassengerBaseFare_r = $flight_result_return->PassengerBaseFare;
                $PassengerTax_Amount_r = $flight_result_return->PassengerTax_Amount;
                $PassengerTax_Code_r = $flight_result_return->PassengerTax_Code;
                $PassengerTax_Description_r = $flight_result_return->PassengerTax_Description;
                $PassengerTotalFare_r = $flight_result_return->PassengerTotalFare;

                $PassengerServiceTax_r = $flight_result_return->PassengerServiceTax;
                $Payment_Charge_r = $flight_result_return->Payment_Charge;
                $Admin_Markup_r = $flight_result_return->Admin_Markup;
                $Trip_Type_r = $flight_result_return->Trip_Type;
                $Service_Type_r = $flight_result_return->Service_Type;
                $SequenceNumber_r = $flight_result_return->SequenceNumber;
                $ResBookDesigCode_r = $flight_result_return->ResBookDesigCode;
            }

            $totalAmount = $TotalFare + $TotalFare_r;

            if ($this->session->userdata('user_logged_in') == 1 && $this->session->userdata('user_id') != '') {
                $user_id = $this->session->userdata('user_id');
            } else {
                $user_id = 0;
            }

            $api_name = 'yatra';

            $this->load->library('array_2_xml');
            $this->load->library('xml_2_array');

            //$AirPriceRS_arr = $_SESSION['AirPriceRS_arr'];
            $AirPriceRS_arr = $this->session->userdata('AirPriceRS_arr');
            //echo "<pre/>";print_r($AirPriceRS_arr);exit;

            $PricedItinerary_arr = $AirPriceRS_arr['soapenv:Envelope']['soapenv:Body']['ns1:OTA_AirPriceRS']['ns1:PricedItineraries']['ns1:PricedItinerary'];

            $AirItinerary_node_r = '';
            $PricingInfo_node_r = '';
            if (isset($PricedItinerary_arr[0])) {
                $AirItinerary_arr = $PricedItinerary_arr[0]['ns1:AirItinerary'];

                $AirItinerary_xml = $this->array_2_xml->createXML('ns1:AirItinerary', $AirItinerary_arr);
                $AirItinerary_node = str_replace('<?xml version="1.0" encoding="UTF-8"?>', '', $AirItinerary_xml->saveXML());
                $AirItinerary_node = str_replace('ns1:', '', $AirItinerary_node);
                //echo "<pre/>";print_r($AirItinerary_node);exit;

                $PricingInfo_arr = $PricedItinerary_arr[0]['ns1:AirItineraryPricingInfo'];
                $PricingInfo_xml = $this->array_2_xml->createXML('ns1:PriceInfo', $PricingInfo_arr);
                $PricingInfo_node = str_replace('<?xml version="1.0" encoding="UTF-8"?>', '', $PricingInfo_xml->saveXML());
                $PricingInfo_node = str_replace('ns1:', '', $PricingInfo_node);
                //echo "<pre/>";print_r($PricingInfo_node);exit;
                // Return flight AirItinerary 
                $AirItinerary_arr_r = $PricedItinerary_arr[1]['ns1:AirItinerary'];

                $AirItinerary_xml_r = $this->array_2_xml->createXML('ns1:AirItinerary', $AirItinerary_arr_r);
                $AirItinerary_node_r = str_replace('<?xml version="1.0" encoding="UTF-8"?>', '', $AirItinerary_xml_r->saveXML());
                $AirItinerary_node_r = str_replace('ns1:', '', $AirItinerary_node_r);
                //echo "<pre/>";print_r($AirItinerary_node);exit;

                $PricingInfo_arr_r = $PricedItinerary_arr[1]['ns1:AirItineraryPricingInfo'];
                $PricingInfo_xml_r = $this->array_2_xml->createXML('ns1:PriceInfo', $PricingInfo_arr_r);
                $PricingInfo_node_r = str_replace('<?xml version="1.0" encoding="UTF-8"?>', '', $PricingInfo_xml_r->saveXML());
                $PricingInfo_node_r = str_replace('ns1:', '', $PricingInfo_node_r);
                //echo "<pre/>";print_r($PricingInfo_node);exit;
            } else {
                $AirItinerary_arr = $PricedItinerary_arr['ns1:AirItinerary'];

                $AirItinerary_xml = $this->array_2_xml->createXML('ns1:AirItinerary', $AirItinerary_arr);
                $AirItinerary_node = str_replace('<?xml version="1.0" encoding="UTF-8"?>', '', $AirItinerary_xml->saveXML());
                $AirItinerary_node = str_replace('ns1:', '', $AirItinerary_node);
                //echo "<pre/>";print_r($AirItinerary_node);exit;

                $PricingInfo_arr = $PricedItinerary_arr['ns1:AirItineraryPricingInfo'];
                $PricingInfo_xml = $this->array_2_xml->createXML('ns1:PriceInfo', $PricingInfo_arr);
                $PricingInfo_node = str_replace('<?xml version="1.0" encoding="UTF-8"?>', '', $PricingInfo_xml->saveXML());
                $PricingInfo_node = str_replace('ns1:', '', $PricingInfo_node);
                //echo "<pre/>";print_r($PricingInfo_node);exit;
            }

            $AirBookRS = $this->AirBookRQ($AirItinerary_node, $PricingInfo_node, $AirItinerary_node_r, $PricingInfo_node_r, $totalAmount);
//            echo "<pre/>";
//            print_r($AirBookRS);
//            exit;
            $AirBookRS_arr = $this->xml_2_array->createArray($AirBookRS);
          //  echo "<pre/>";print_r($AirBookRS_arr);exit;
            //$_SESSION['AirBookRS_arr'] = $AirBookRS_arr;
            $this->session->set_userdata('AirBookRS_arr', $AirBookRS_arr);

            $OTA_AirBookRS_arr = $AirBookRS_arr['soapenv:Envelope']['soapenv:Body']['ns1:OTA_ItineraryBookRS']['ns1:OTA_AirBookRS'];

            $flyNStayRefNo = $this->generateReferenceNo(8);

            if ($OTA_AirBookRS_arr != '') {
                $AirReservation_arr = $OTA_AirBookRS_arr['ns1:AirReservation'];

                if (isset($AirReservation_arr[0])) {
                    if (isset($AirReservation_arr[0]['@attributes']['BookingReferenceID']) && $AirReservation_arr[0]['@attributes']['BookingReferenceID'] != '') {
                        $OnwardBookingRefId = $AirReservation_arr[0]['@attributes']['BookingReferenceID'];
                        $ReturnBookingRefId = $AirReservation_arr[1]['@attributes']['BookingReferenceID'];

                        $OTA_AirBookRS_xml = $this->array_2_xml->createXML('ns1:OTA_AirBookRS', $OTA_AirBookRS_arr);
                        $AirBookRS_node = str_replace('<?xml version="1.0" encoding="UTF-8"?>', '', $OTA_AirBookRS_xml->saveXML());
                        $AirBookRS_node = str_replace('ns1:', '', $AirBookRS_node);
                        //echo "<pre/>";print_r($AirBookRS_node);exit;		
						
						$airCode = explode(',',$MarketingAirline_Code);						
					if($airCode[0] != 'SG' && $airCode[0] != 'I9' && $airCode[0] != 'G8') {
						
                        $AirTicketRS = $this->AirTicketRQ($AirBookRS_node);
                        //echo "<pre/>";print_r($AirTicketRS);exit;	
                        $AirTicketRS_arr = $this->xml_2_array->createArray($AirTicketRS);
                        //echo "<pre/>";print_r($AirTicketRS_arr);exit;	

                        $YT_AirTicketRS = $AirTicketRS_arr['soapenv:Envelope']['soapenv:Body']['YT_AirTicketRS']['OTA_AirBookRS'];
					}
					else
					{
						$YT_AirTicketRS = '';
					}

                        if ($YT_AirTicketRS != '') {
                            $book_status = 'SUCCESSTKD';
                            $Ticketing = $YT_AirTicketRS['AirReservation']['Ticketing'];
                            if (isset($Ticketing[0])) {
                                for ($n = 0; $n < count($Ticketing); $n++) {
                                    $Ticket_Number_arr[$n] = $Ticketing[$n]['@value'];
                                }

                                $Ticket_Number = implode(',', $Ticket_Number_arr);
                            } else {
                                $Ticket_Number = $Ticketing['@value'];
                            }
                        } else {
                            $book_status = 'SUCCESS';
                            $Ticket_Number = 'Nil';
                        }

                        $booking_id = $this->Flight_Model->flight_booking_reports($user_id, $flyNStayRefNo, $OnwardBookingRefId, $Ticket_Number, $api_name, $SequenceNumber, $Origin, $Destination, $Adults, $Childs, $Infants, $ArrivalDateTime, $DepartureDateTime, $FlightNumber, $FareType, $ResBookDesigCode, $Departure_AirPortName, $Departure_CityName, $Departure_LocationCode, $Departure_Terminal, $Arrival_AirPortName, $Arrival_CityName, $Arrival_LocationCode, $Arrival_Terminal, $AirEquipType, $MarketingAirline_Code, $MarketingAirline_Name, $Stops, $BaseFare, $CurrencyCode, $Tax_Amount, $TaxCode, $TotalFare, $ServiceTax, $Fee_Amount, $PassengerType, $PassengerQuantity, $PassengerBaseFare, $PassengerTax_Amount, $PassengerTax_Code, $PassengerTotalFare, $PassengerServiceTax, $Payment_Charge, $Admin_Markup, 'S', $book_status, 1);

                        $booking_id_r = $this->Flight_Model->flight_booking_reports($user_id, $flyNStayRefNo, $ReturnBookingRefId, $Ticket_Number, $api_name, $SequenceNumber_r, $Origin_r, $Destination_r, $Adults_r, $Childs_r, $Infants_r, $ArrivalDateTime_r, $DepartureDateTime_r, $FlightNumber_r, $FareType_r, $ResBookDesigCode_r, $Departure_AirPortName_r, $Departure_CityName_r, $Departure_LocationCode_r, $Departure_Terminal_r, $Arrival_AirPortName_r, $Arrival_CityName_r, $Arrival_LocationCode_r, $Arrival_Terminal_r, $AirEquipType_r, $MarketingAirline_Code_r, $MarketingAirline_Name_r, $Stops_r, $BaseFare_r, $CurrencyCode_r, $Tax_Amount_r, $TaxCode_r, $TotalFare_r, $ServiceTax_r, $Fee_Amount_r, $PassengerType_r, $PassengerQuantity_r, $PassengerBaseFare_r, $PassengerTax_Amount_r, $PassengerTax_Code_r, $PassengerTotalFare_r, $PassengerServiceTax_r, $Payment_Charge_r, $Admin_Markup_r, $Trip_Type_r, $book_status, 1);

                        redirect('flight/flight_eticket/' . $OnwardBookingRefId . '/' . $flyNStayRefNo . '/' . $ReturnBookingRefId, 'refresh');
                    } else {
                        $book_status = 'FAIL';
                        $OnwardBookingRefId = 'Nil';
                        $ReturnBookingRefId = 'Nil';
                        $Ticket_Number = 'Nil';
                        $booking_id = $this->Flight_Model->flight_booking_reports($user_id, $flyNStayRefNo, $OnwardBookingRefId, $Ticket_Number, $api_name, $SequenceNumber, $Origin, $Destination, $Adults, $Childs, $Infants, $ArrivalDateTime, $DepartureDateTime, $FlightNumber, $FareType, $ResBookDesigCode, $Departure_AirPortName, $Departure_CityName, $Departure_LocationCode, $Departure_Terminal, $Arrival_AirPortName, $Arrival_CityName, $Arrival_LocationCode, $Arrival_Terminal, $AirEquipType, $MarketingAirline_Code, $MarketingAirline_Name, $Stops, $BaseFare, $CurrencyCode, $Tax_Amount, $TaxCode, $TotalFare, $ServiceTax, $Fee_Amount, $PassengerType, $PassengerQuantity, $PassengerBaseFare, $PassengerTax_Amount, $PassengerTax_Code, $PassengerTotalFare, $PassengerServiceTax, $Payment_Charge, $Admin_Markup, 'S', $book_status, 1);

                        $booking_id_r = $this->Flight_Model->flight_booking_reports($user_id, $flyNStayRefNo, $ReturnBookingRefId, $Ticket_Number, $api_name, $SequenceNumber_r, $Origin_r, $Destination_r, $Adults_r, $Childs_r, $Infants_r, $ArrivalDateTime_r, $DepartureDateTime_r, $FlightNumber_r, $FareType_r, $ResBookDesigCode_r, $Departure_AirPortName_r, $Departure_CityName_r, $Departure_LocationCode_r, $Departure_Terminal_r, $Arrival_AirPortName_r, $Arrival_CityName_r, $Arrival_LocationCode_r, $Arrival_Terminal_r, $AirEquipType_r, $MarketingAirline_Code_r, $MarketingAirline_Name_r, $Stops_r, $BaseFare_r, $CurrencyCode_r, $Tax_Amount_r, $TaxCode_r, $TotalFare_r, $ServiceTax_r, $Fee_Amount_r, $PassengerType_r, $PassengerQuantity_r, $PassengerBaseFare_r, $PassengerTax_Amount_r, $PassengerTax_Code_r, $PassengerTotalFare_r, $PassengerServiceTax_r, $Payment_Charge_r, $Admin_Markup_r, $Trip_Type_r, $book_status, 1);


                        //redirect('flight/search_progress', 'refresh');
						$this->load->view('b2c/flight/error_page');
                    }
                } else {
                    if (isset($AirReservation_arr['@attributes']['BookingReferenceID']) && $AirReservation_arr['@attributes']['BookingReferenceID'] != '') {
                        $OnwardBookingRefId = $AirReservation_arr['@attributes']['BookingReferenceID'];

                        $OTA_AirBookRS_xml = $this->array_2_xml->createXML('ns1:OTA_AirBookRS', $OTA_AirBookRS_arr);
                        $AirBookRS_node = str_replace('<?xml version="1.0" encoding="UTF-8"?>', '', $OTA_AirBookRS_xml->saveXML());
                        $AirBookRS_node = str_replace('ns1:', '', $AirBookRS_node);
                        //echo "<pre/>";print_r($AirBookRS_node);		
						
						$airCode = explode(',',$MarketingAirline_Code);						
					if($airCode[0] != 'SG' && $airCode[0] != 'I9' && $airCode[0] != 'G8') {
						
                        $AirTicketRS = $this->AirTicketRQ($AirBookRS_node);
                        //echo "<pre/>";print_r($AirTicketRS);exit;	
                        $AirTicketRS_arr = $this->xml_2_array->createArray($AirTicketRS);
                        //echo "<pre/>";print_r($AirTicketRS_arr);exit;	

                        $YT_AirTicketRS = $AirTicketRS_arr['soapenv:Envelope']['soapenv:Body']['YT_AirTicketRS']['OTA_AirBookRS'];
					}
					else
					{
						$YT_AirTicketRS = '';
					}

                        if ($YT_AirTicketRS != '') {
                            $book_status = 'SUCCESSTKD';
                            $Ticketing = $YT_AirTicketRS['AirReservation']['Ticketing'];
                            if (isset($Ticketing[0])) {
                                for ($n = 0; $n < count($Ticketing); $n++) {
                                    $Ticket_Number_arr[$n] = $Ticketing[$n]['@value'];
                                }

                                $Ticket_Number = implode(',', $Ticket_Number_arr);
                            } else {
                                $Ticket_Number = $Ticketing['@value'];
                            }
                        } else {
                            $book_status = 'SUCCESS';
                            $Ticket_Number = 'Nil';
                        }

                        $booking_id = $this->Flight_Model->flight_booking_reports($user_id, $flyNStayRefNo, $OnwardBookingRefId, $Ticket_Number, $api_name, $SequenceNumber, $Origin, $Destination, $Adults, $Childs, $Infants, $ArrivalDateTime, $DepartureDateTime, $FlightNumber, $FareType, $ResBookDesigCode, $Departure_AirPortName, $Departure_CityName, $Departure_LocationCode, $Departure_Terminal, $Arrival_AirPortName, $Arrival_CityName, $Arrival_LocationCode, $Arrival_Terminal, $AirEquipType, $MarketingAirline_Code, $MarketingAirline_Name, $Stops, $BaseFare, $CurrencyCode, $Tax_Amount, $TaxCode, $TotalFare, $ServiceTax, $Fee_Amount, $PassengerType, $PassengerQuantity, $PassengerBaseFare, $PassengerTax_Amount, $PassengerTax_Code, $PassengerTotalFare, $PassengerServiceTax, $Payment_Charge, $Admin_Markup, $Trip_Type, $book_status, 1);

                        redirect('flight/flight_eticket/' . $OnwardBookingRefId . '/' . $flyNStayRefNo, 'refresh');
                    } else {
                        $book_status = 'FAIL';
                        $OnwardBookingRefId = 'Nil';
                        $Ticket_Number = 'Nil';
                        $booking_id = $this->Flight_Model->flight_booking_reports($user_id, $flyNStayRefNo, $OnwardBookingRefId, $Ticket_Number, $api_name, $SequenceNumber, $Origin, $Destination, $Adults, $Childs, $Infants, $ArrivalDateTime, $DepartureDateTime, $FlightNumber, $FareType, $ResBookDesigCode, $Departure_AirPortName, $Departure_CityName, $Departure_LocationCode, $Departure_Terminal, $Arrival_AirPortName, $Arrival_CityName, $Arrival_LocationCode, $Arrival_Terminal, $AirEquipType, $MarketingAirline_Code, $MarketingAirline_Name, $Stops, $BaseFare, $CurrencyCode, $Tax_Amount, $TaxCode, $TotalFare, $ServiceTax, $Fee_Amount, $PassengerType, $PassengerQuantity, $PassengerBaseFare, $PassengerTax_Amount, $PassengerTax_Code, $PassengerTotalFare, $PassengerServiceTax, $Payment_Charge, $Admin_Markup, $Trip_Type, $book_status, 1);


                        //redirect('flight/search_progress', 'refresh');
						$this->load->view('b2c/flight/error_page');
                    }
                }
            } else {
                $book_status = 'FAIL';
                $OnwardBookingRefId = 'Nil';
                $Ticket_Number = 'Nil';
                $booking_id = $this->Flight_Model->flight_booking_reports($user_id, $flyNStayRefNo, $OnwardBookingRefId, $Ticket_Number, $api_name, $SequenceNumber, $Origin, $Destination, $Adults, $Childs, $Infants, $ArrivalDateTime, $DepartureDateTime, $FlightNumber, $FareType, $ResBookDesigCode, $Departure_AirPortName, $Departure_CityName, $Departure_LocationCode, $Departure_Terminal, $Arrival_AirPortName, $Arrival_CityName, $Arrival_LocationCode, $Arrival_Terminal, $AirEquipType, $MarketingAirline_Code, $MarketingAirline_Name, $Stops, $BaseFare, $CurrencyCode, $Tax_Amount, $TaxCode, $TotalFare, $ServiceTax, $Fee_Amount, $PassengerType, $PassengerQuantity, $PassengerBaseFare, $PassengerTax_Amount, $PassengerTax_Code, $PassengerTotalFare, $PassengerServiceTax, $Payment_Charge, $Admin_Markup, $Trip_Type, $book_status, 1);

                //redirect('flight/search_progress', 'refresh');
				$this->load->view('b2c/flight/error_page');
            }
        } else {
           // redirect('flight/search_progress', 'refresh');
			$this->load->view('b2c/flight/error_page');
        }
    }

    //AirBookRQ starts here	
    function AirBookRQ($AirItinerary_node, $PricingInfo_node, $AirItinerary_node_r, $PricingInfo_node_r, $totalAmount) {
        $user_booking_info = $this->session->userdata('user_booking_info');
        //echo "<pre/>";print_r($user_booking_info);exit;
        $atitle = $user_booking_info['atitle'];
        $afname = $user_booking_info['afname'];
        $amname = $user_booking_info['amname'];
        $alname = $user_booking_info['alname'];

        $AccompaniedByInfant = 'AccompaniedByInfant="false"';

        if (isset($user_booking_info['cfname']) && $user_booking_info['cfname'] != '') {
            $ctitle = $user_booking_info['ctitle'];
            $cfname = $user_booking_info['cfname'];
            $cmname = $user_booking_info['cmname'];
            $clname = $user_booking_info['clname'];

            $cdobDate = $user_booking_info['cdobDate'];
            $cdobMonth = $user_booking_info['cdobMonth'];
            $cdobYear = $user_booking_info['cdobYear'];
        }

        if (isset($user_booking_info['ifname']) && $user_booking_info['ifname'] != '') {
            $ititle = $user_booking_info['ititle'];
            $ifname = $user_booking_info['ifname'];
            $imname = $user_booking_info['imname'];
            $ilname = $user_booking_info['ilname'];

            $idobDate = $user_booking_info['idobDate'];
            $idobMonth = $user_booking_info['idobMonth'];
            $idobYear = $user_booking_info['idobYear'];

            $AccompaniedByInfant = 'AccompaniedByInfant="true"';
        }

        $userName = $user_booking_info['userName'];
        if ($userName == '') {
            $userEmailId = $user_booking_info['userEmailId'];
            $userMobilNo = $user_booking_info['userMobilNo'];
        } else {
            $userEmailId = $user_booking_info['email_id'];
            $userMobilNo = $user_booking_info['mobile_no'];
        }

        $adult_info = '';
        for ($i = 0; $i < count($afname); $i++) {
            $adult_info .='<AirTraveler '.$AccompaniedByInfant.' BirthDate="" PassengerTypeCode="ADT">
						<PersonName>
							<NamePrefix>' . $atitle[$i] . '</NamePrefix>
							<GivenName>' . $afname[$i] . '</GivenName>
							<Surname>' . $alname[$i] . '</Surname>
							<NameTitle/>
						</PersonName>
						<Telephone AreaCityCode="" CountryAccessCode="91" DefaultInd="false" FormattedInd="false" MobileNumber="' . $userMobilNo . '"/>
						<Email DefaultInd="false" EmailType="1">' . $userEmailId . '</Email>
						<Address FormattedInd="false">
							<AddressLine>dummy,</AddressLine>
							<AddressLine>DEL</AddressLine>
							<PostalCode>110001</PostalCode>
							<StateProv StateCode="DL"/>
						</Address>
						<ProofRequests>
							<ProofRequest CompanyID="" ProofType="PP" ProofNumber=""></ProofRequest>
						</ProofRequests>
						<TravelerRefNumber RPH="1"/>
					</AirTraveler>';
        }

        $child_info = '';
        if (isset($user_booking_info['cfname']) && $user_booking_info['cfname'] != '') {
            for ($i = 0; $i < count($cfname); $i++) {
                $cdob = $cdobYear[$i] . '-' . $cdobMonth[$i] . '-' . $cdobDate[$i];
                $child_info .='<AirTraveler AccompaniedByInfant="false" BirthDate="' . $cdob . '" PassengerTypeCode="CHD">
							<PersonName>
								<NamePrefix>' . $ctitle[$i] . '</NamePrefix>
								<GivenName>' . $cfname[$i] . '</GivenName>
								<Surname>' . $clname[$i] . '</Surname>
								<NameTitle/>
							</PersonName>
							<Telephone AreaCityCode="" CountryAccessCode="91" DefaultInd="false" FormattedInd="false" MobileNumber="' . $userMobilNo . '"/>
							<Email DefaultInd="false" EmailType="1">' . $userEmailId . '</Email>
							<Address FormattedInd="false">
								<AddressLine>dummy,</AddressLine>
								<AddressLine>DEL</AddressLine>
								<PostalCode>110001</PostalCode>
								<StateProv StateCode="DL"/>
							</Address>
							<ProofRequests>
								<ProofRequest CompanyID="" ProofType="PP" ProofNumber=""></ProofRequest>
							</ProofRequests>
							<TravelerRefNumber RPH="2"/>
						</AirTraveler>';
            }
        }

        $infant_info = '';
        if (isset($user_booking_info['ifname']) && $user_booking_info['ifname'] != '') {
            for ($i = 0; $i < count($cfname); $i++) {
                $idob = $idobYear[$i] . '-' . $idobMonth[$i] . '-' . $idobDate[$i];
                $infant_info .='<AirTraveler AccompaniedByInfant="false" BirthDate="' . $idob . '" PassengerTypeCode="INF">
							<PersonName>
								<NamePrefix>' . $ititle[$i] . '</NamePrefix>
								<GivenName>' . $ifname[$i] . '</GivenName>
								<Surname>' . $ilname[$i] . '</Surname>
								<NameTitle/>
							</PersonName>
							<Telephone AreaCityCode="" CountryAccessCode="91" DefaultInd="false" FormattedInd="false" MobileNumber="' . $userMobilNo . '"/>
							<Email DefaultInd="false" EmailType="1">' . $userEmailId . '</Email>
							<Address FormattedInd="false">
								<AddressLine>dummy,</AddressLine>
								<AddressLine>DEL</AddressLine>
								<PostalCode>110001</PostalCode>
								<StateProv StateCode="DL"/>
							</Address>
							<ProofRequests>
								<ProofRequest CompanyID="" ProofType="PP" ProofNumber=""></ProofRequest>
							</ProofRequests>
							<TravelerRefNumber RPH="3"/>
						</AirTraveler>';
            }
        }

        $tranId = $this->generateReferenceNo(6);

        $this->xml = '<?xml version="1.0" encoding="UTF-8"?>
		<soap:Envelope xmlns="http://www.opentravel.org/OTA/2003/05" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:wsse="http://schemas.xmlsoap.org/ws/2002/12/secext">
			<soap:Body>				
					<OTA_ItineraryBookRQ xmlns="http://www.opentravel.org/OTA/2003/05">
						<POS xmlns="http://www.opentravel.org/OTA/2003/05">
							<Source AgentSine="" PseudoCityCode="NPCK" TerminalID="1">
								<RequestorID ID="AFFILIATE"></RequestorID>
							</Source>
							<YatraRequests>
								<YatraRequest YatraRequestTypeCode="SMPA" Description="" MidOfficeAgentID="' . $this->MidOfficeAgentID . '" AffiliateID="YTFABTRAVEL"/>
							</YatraRequests>
						</POS>
					<OJ_PaymentRQ xmlns="http://www.openjawtech.com/2005" RetransmissionIndicator="false" SequenceNmbr="1" TransactionIdentifier="'.$tranId.'" TransactionStatusCode="A" Version="0.0" productID="QQKXQQS87YQQ" type="payment">
						<PaymentDetails>
							<PaymentDetail GuaranteeIndicator="false">
								<PaymentCard CardCode="NA" CardNumber="NA" CardType="NA" EffectiveDate="NA" ExpireDate="NA" ExtendPaymentIndicator="false" ExtendedPaymentQuantity="0" SeriesCode="NA" SignatureOnFileIndicator="false">
									<CardHolderName FirstName="' . $afname[0] . '" MiddleName="' . $alname[0] . '">' . $afname[0] . ' ' . $alname[0] . '</CardHolderName>
									<CardNumber>NA</CardNumber>
									<CardIssuerName BankID="19389"/>
									<CardHolderTelephone PhoneTechType="1"/>
									<Phone MobileNumber="'.$userMobilNo.'" Number="'.$userMobilNo.'"/>
									 <Email>'.$userEmailId.'</Email>
									 <Location>
										 <IPAddress>'.$this->get_client_ip().'</IPAddress>
									</Location>
								</PaymentCard>
								<PaymentAmount Amount="' . $totalAmount . '" CurrencyCode="INR" DecimalPlaces="0"/>
							</PaymentDetail>
						</PaymentDetails>
						<AuthDetails Cancelled="false" Fulfilled="true" PaymentMedium="CREDITPOOL"/>
					</OJ_PaymentRQ>
					<OTA_AirBookRQ TransactionIdentifier="' . $tranId . '" Version="0.0">
					' . $AirItinerary_node . '
					' . $PricingInfo_node . '
					<Notes>SG</Notes>
					' . $AirItinerary_node_r . '
					' . $PricingInfo_node_r . '
						<TravelerInfo>
							' . $adult_info . '
							' . $child_info . '
							' . $infant_info . '
						</TravelerInfo>
						<Fulfillment/>
						<Ticketing CancelOnExpiryInd="false" ReverseTktgSegmentsInd="false" TicketType="eTicket" TimeLimitMinutes="0"/>
					</OTA_AirBookRQ>
				</OTA_ItineraryBookRQ>
			</soap:Body>
		</soap:Envelope>';

        //echo $this->xml;

        $AirBookRS = $this->PostRQ($this->xml);
		//echo '<pre/>';print_r($AirBookRS);exit;

        return $AirBookRS;
    }

    //AirBookRQ ends here
    //AirTicket Request Starts here
    function AirTicketRQ($AirBookRS_node) {
        $this->xml = '<?xml version="1.0" encoding="UTF-8"?>
		<soap:Envelope xmlns="http://www.opentravel.org/OTA/2003/05" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:wsse="http://schemas.xmlsoap.org/ws/2002/12/secext">
			<soap:Body>
				<YT_AirTicketRQ>
					<POS>
					<Source ISOCurrency="INR" AgentSine="" PseudoCityCode="NPCK" TerminalID="1">
						<RequestorID ID="YATRA"/>
					</Source>
					<YatraRequests>
						<YatraRequest YatraRequestTypeCode="SMPA" MidOfficeAgentID="' . $this->MidOfficeAgentID . '"/>
					</YatraRequests>
					</POS>				
					' . $AirBookRS_node . '
			 </YT_AirTicketRQ>
			</soap:Body>
		</soap:Envelope>';

        //echo $this->xml;

        $AirTicketRS = $this->PostRQ($this->xml);

        return $AirTicketRS;
    }

    //AirTicket Request Ends here

    function flight_eticket($onward_booking_ref_id, $flynstay_ref_id, $return_booking_ref_id = '') {
        $booking_info = $this->Flight_Model->get_flight_booking_info($onward_booking_ref_id);
        $data['booking_info'] = $booking_info[0];
        $passenger_info = $this->Flight_Model->get_passenger_info($onward_booking_ref_id);
        $data['passenger_info'] = $passenger_info;

        if ($return_booking_ref_id != '') {
            $booking_info_return = $this->Flight_Model->get_flight_booking_info($return_booking_ref_id);
            $data['booking_info_return'] = $booking_info_return[0];
            $passenger_info_return = $this->Flight_Model->get_passenger_info($return_booking_ref_id);
            $data['passenger_info_return'] = $passenger_info_return;
        }

        //echo '<pre/>';print_r($data);exit;		
        $this->load->view('b2c/flight/flight_eticket', $data);
    }

    //International Flight Search Starts Here
    public function flight_int_search() {
        $this->form_validation->set_rules('originCityInt', 'From City', 'trim|required|callback_alpha_city_validation|callback_airport_code_validation|xss_clean');
        $this->form_validation->set_rules('destinationCityInt', 'To City', 'trim|required|callback_alpha_city_validation|callback_airport_code_validation|xss_clean');
        $this->form_validation->set_rules('departDateInt', 'Departure Date', 'required|callback_date_validation|xss_clean');

        $tripType = $this->input->post('tripTypeInt');
        if ($tripType == 'R') {
            $this->form_validation->set_rules('returnDateInt', 'Return Date', 'required|callback_date_validation|xss_clean');
        }

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('home/index');
        } else {
            //echo '<pre>';print_r($_POST);exit;					

            $tripType = $this->input->post('tripTypeInt');
            $originCity = $this->input->post('originCityInt');
            $destinationCity = $this->input->post('destinationCityInt');
            $departDate = $this->input->post('departDateInt');
            $returnDate = $this->input->post('returnDateInt');

            $adults = $this->input->post('adultsInt');
            $childs = $this->input->post('childsInt');
            $infants = $this->input->post('infantsInt');
            $cabinClass = $this->input->post('cabinClassInt');

            if (!empty($originCity)) {
                $session_data = $this->session->userdata('flight_search_data');
                //echo '<pre>';print_r($session_data);exit;			
                if (!empty($session_data)) {
                    $sess_tripType = $session_data['tripType'];
                    $sess_originCity = $session_data['originCity'];
                    $sess_destinationCity = $session_data['destinationCity'];
                    $sess_departDate = $session_data['departDate'];

                    if ($sess_tripType == 'R')
                        $sess_returnDate = $session_data['returnDate'];
                    else
                        $sess_returnDate = '';

                    $sess_adults = $session_data['adults'];
                    $sess_childs = $session_data['childs'];
                    $sess_infants = $session_data['infants'];
                    $sess_cabinClass = $session_data['cabinClass'];

                    if ($sess_tripType == $tripType && $sess_originCity == $originCity && $sess_destinationCity == $destinationCity && $sess_departDate == $sess_departDate && $sess_returnDate == $returnDate && $sess_adults == $adults && $sess_childs == $childs && $sess_infants == $infants && $sess_cabinClass == $cabinClass) {
                        $this->session->set_userdata('flight_search_activate', 1);
                    } else {
                        $this->session->set_userdata('flight_search_activate', '');
                        $this->Flight_Model->delete_flight_temp_result($this->sess_id);
                    }
                } else {
                    $this->session->set_userdata('flight_search_activate', '');
                    $this->Flight_Model->delete_flight_temp_result($this->sess_id);
                }


                $sess_array = array(
                    'tripType' => $tripType,
                    'originCity' => $originCity,
                    'destinationCity' => $destinationCity,
                    'departDate' => $departDate,
                    'returnDate' => $returnDate,
                    'adults' => $adults,
                    'childs' => $childs,
                    'infants' => $infants,
                    'cabinClass' => $cabinClass,
                );

                $this->session->set_userdata('flight_search_data', $sess_array);

                $api_name_f = 'yatra';
                $data['api_name_f'] = $api_name_f;

                $this->session->set_userdata('api_name_f', $api_name_f);

                $this->load->view('b2c/flight/int_search_progress', $data);
            } else {
                $this->load->view('home/index');
            }
        }
    }

    //International Flight Search Ends Here

    function int_search_progress() {
        //echo '<pre>';print_r($this->session->userdata);exit;	
        if ($this->session->userdata('flight_search_activate') != 1) {
            if (isset($_POST) && $_POST['api_name'] != '') {
                $api = $_POST['api_name'];

                switch ($api) {

                    case 'yatra':
                        $this->IntAirLowFareSearchRQ();
                        break;

                    default:
                        break;
                }
            }
        }


        $sess_search_data = $this->session->userdata('flight_search_data');

        $flight_result = $this->Flight_Model->fetch_search_result($this->sess_id);
        //echo '<pre/>';print_r($flight_result);exit;
        $data['result'] = $flight_result;
        /*
          if($sess_search_data['tripType'] == 'S')
          {
          $this->load->view('flight/int_search_result', $data);
          }

          if($sess_search_data['tripType'] == 'R')
          {
          $this->load->view('flight/int_search_result_round', $data);
          } */

        $this->load->view('b2c/flight/int_search_result', $data);
    }

    // <-- IntAirLowFareSearchRQ-OneWay Starts Here -->

    public function IntAirLowFareSearchRQ() {
        $session_data = $this->session->userdata('flight_search_data');

        $tripType = $session_data['tripType'];
        $originCity = $session_data['originCity'];
        $destinationCity = $session_data['destinationCity'];
        $departDate = $session_data['departDate'];
        $returnDate = $session_data['returnDate'];

        $adults = $session_data['adults'];
        $childs = $session_data['childs'];
        $infants = $session_data['infants'];
        $cabinClass = $session_data['cabinClass'];

        $depDate = explode('/', $departDate);
        $departDate = $depDate[2] . '-' . $depDate[1] . '-' . $depDate[0] . 'T00:00:00';

        if ($tripType == 'R') {
            $retDate = explode('/', $returnDate);
            $returnDate = $retDate[2] . '-' . $retDate[1] . '-' . $retDate[0] . 'T00:00:00';
        }

        if (isset($adults) && $adults != 0) {
            $pax['ADT'] = $adults;
        }
        if (isset($childs) && $childs != 0) {
            $pax['CHD'] = $childs;
        }
        if (isset($infants) && $infants != 0) {
            $pax['INF'] = $infants;
        }

        $originCode = $this->get_airport_code($originCity);
        $destinationCode = $this->get_airport_code($destinationCity);


        $OriginDestinationInformation = '<OriginDestinationInformation>
			<DepartureDateTime WindowAfter="P0D" WindowBefore="P0D">' . $departDate . '</DepartureDateTime>
			<OriginLocation CodeContext="IATA" LocationCode="' . $originCode . '">' . $originCode . '</OriginLocation>
			<DestinationLocation CodeContext="IATA" LocationCode="' . $destinationCode . '">' . $destinationCode . '</DestinationLocation>
		</OriginDestinationInformation>';

        if ($tripType == 'R') {
            $OriginDestinationInformation .= '<OriginDestinationInformation>
			<DepartureDateTime WindowAfter="P0D" WindowBefore="P0D">' . $returnDate . '</DepartureDateTime>
			<OriginLocation CodeContext="IATA" LocationCode="' . $destinationCode . '">' . $destinationCode . '</OriginLocation>
			<DestinationLocation CodeContext="IATA" LocationCode="' . $originCode . '">' . $originCode . '</DestinationLocation>
		</OriginDestinationInformation>';
        }

        $TravelerInfo = $this->getTravelerInfo($pax);

        $this->xml = '<?xml version="1.0" encoding="UTF-8"?>
		<soap:Envelope xmlns="http://www.opentravel.org/OTA/2003/05" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:wsse="http://schemas.xmlsoap.org/ws/2002/12/secext">
			<soap:Body>
				<OTA_AirLowFareSearchRQ EchoToken="0" SequenceNmbr="0" TransactionIdentifier="0" Version="1.001" xmlns="http://www.opentravel.org/OTA/2003/05" DirectFlightsOnly="false">
				<POS xmlns="http://www.opentravel.org/OTA/2003/05">
					<Source AgentSine="" PseudoCityCode="NPCK" TerminalID="1">
						<RequestorID ID="AFFILIATE"></RequestorID>
					</Source>
					<YatraRequests>
						<YatraRequest DoNotHitCache="false" DoNotCache="false" YatraRequestTypeCode="SMPA" Description="" MidOfficeAgentID="' . $this->MidOfficeAgentID . '" AffiliateID="YTFABTRAVEL" Destination="INT"/>
					</YatraRequests>
				</POS>
					
					' . $OriginDestinationInformation . '
					
					<TravelerInfoSummary>
						<AirTravelerAvail>
						
							' . $TravelerInfo . '
							
						</AirTravelerAvail>
					</TravelerInfoSummary>
					<TravelPreferences>
						<CabinPref Cabin="' . $cabinClass . '"/>
					</TravelPreferences>
				</OTA_AirLowFareSearchRQ>
			</soap:Body>
		</soap:Envelope>';

        //echo $this->xml;

        $IntAirLowFareSearchRS = $this->postRQ($this->xml);
        //echo '<pre/>';print_r($IntAirLowFareSearchRS);exit;
		// Deleting Unwanted unformed XML Tags
		$dom = new DOMDocument();
 		$dom->loadXML($IntAirLowFareSearchRS);
		
 		$inc=0;
		while(is_object($FormData = $dom->getElementsByTagName("FormData")->item($inc)))
		{
			 foreach($FormData->childNodes as $nodename)
			 {
				if($nodename->nodeName=='ns1:JourneySellKey')
				{						
					$mainNode = $FormData->parentNode->parentNode->parentNode->parentNode;							
					$mainNode->parentNode->removeChild($mainNode);
				}						
			 }
			 
			$inc++;
		}		
		$IntAirLowFareSearchRS = $dom->saveXML();
		//echo '<pre/>';print_r($IntAirLowFareSearchRS);exit;
		
        $IntAirLowFareSearchRS = str_replace("ns1:", '', $IntAirLowFareSearchRS);
        $IntAirLowFareSearchRS = str_replace("<FormData>" . $cabinClass, '<FormData>', $IntAirLowFareSearchRS);
        //$IntAirLowFareSearchRS = str_replace(">".$cabinClass,'>',$IntAirLowFareSearchRS);		
        preg_match("/<session>(.*)<\/session>/", $IntAirLowFareSearchRS, $session_tag_matches);
        if (!empty($session_tag_matches)) {
            $IntAirLowFareSearchRS = str_replace('</session>' . $cabinClass, '</session>', $IntAirLowFareSearchRS);
        }

        //Store Session variables
        $_SESSION['IntAirLowFareSearchRS_xml'] = $IntAirLowFareSearchRS;
        //$this->session->set_userdata('AirLowFareSearchRS_xml',$IntAirLowFareSearchRS);	
        //echo '<pre/>';print_r($IntAirLowFareSearchRS);

        $this->load->library('xml_to_array');
        $IntAirLowFareSearchRS_array = $this->xml_to_array->XmlToArray($IntAirLowFareSearchRS);
        //echo '<pre/>';print_r($IntAirLowFareSearchRS_array);exit;		

        $PricedItinerary = $IntAirLowFareSearchRS_array['soapenv:Body']['OTA_AirLowFareSearchRS']['PricedItineraries']['PricedItinerary'];

        for ($i = 0; $i < count($PricedItinerary); $i++) {
            $PricedItinerary_attributes = $PricedItinerary[$i]['@attributes'];
            $FareType = $PricedItinerary_attributes['FareType'];
            $OriginDestinationRPH = $PricedItinerary_attributes['OriginDestinationRPH'];
            $SequenceNumber = $PricedItinerary_attributes['SequenceNumber'];

            $AirItinerary = $PricedItinerary[$i]['AirItinerary'];
            $OriginDestinationOption = $AirItinerary['OriginDestinationOptions']['OriginDestinationOption'];

            if (isset($OriginDestinationOption[0])) {
                for ($n = 0; $n < count($OriginDestinationOption); $n++) {
                    $OriginDestinationOption_attributes = $OriginDestinationOption[$n]['@attributes'];
                    $Total_Duration = $OriginDestinationOption_attributes['Duration'];
                    $FlightID = $OriginDestinationOption_attributes['FlightID'];
                    $SupplierSystem = $OriginDestinationOption_attributes['SupplierSystem'];

                    if ($n == 0)
                        $UniqueIdentifier = $OriginDestinationOption_attributes['UniqueIdentifier'];
                    else
                        $UniqueIdentifier = 2;

                    $Stops = 0;
                    $FlightSegment = $OriginDestinationOption[$n]['FlightSegment'];
                    if (isset($FlightSegment[0])) {
                        for ($j = 0; $j < count($FlightSegment); $j++) {
                            $FlightSegment_attributes = $FlightSegment[$j]['@attributes'];
                            $ArrivalDateTime_arr[$j] = $FlightSegment_attributes['ArrivalDateTime'];
                            $DepartureDateTime_arr[$j] = $FlightSegment_attributes['DepartureDateTime'];
                            $Duration_arr[$j] = $FlightSegment_attributes['Duration'];
                            $FlightNumber_arr[$j] = $FlightSegment_attributes['FlightNumber'];

                            if (isset($FlightSegment_attributes['Status']))
                                $SeatToSell_arr[$j] = $FlightSegment_attributes['Status'];

                            //$FareType_arr[$j] = $FlightSegment[$j]['BookingClassAvail']['@attributes']['FareType'];
                            $ResBookDesigCode_arr[$j] = $FlightSegment[$j]['BookingClassAvail']['@attributes']['ResBookDesigCode'];
                            if (isset($FlightSegment[$j]['BookingClassAvail']['@attributes']['Status']))
                                $SeatToSell_arr1[$j] = $FlightSegment[$j]['BookingClassAvail']['@attributes']['Status'];

                            $Departure_AirPortName_arr[$j] = $FlightSegment[$j]['DepartureAirport']['@attributes']['AirPortName'];
                            $Departure_CityName_arr[$j] = $FlightSegment[$j]['DepartureAirport']['@attributes']['CityName'];
                            $Departure_LocationCode_arr[$j] = $FlightSegment[$j]['DepartureAirport']['@attributes']['LocationCode'];

                            if (isset($FlightSegment[$j]['DepartureAirport']['@attributes']['Terminal']))
                                $Departure_Terminal_arr[$j] = $FlightSegment[$j]['DepartureAirport']['@attributes']['Terminal'];

                            $Arrival_AirPortName_arr[$j] = $FlightSegment[$j]['ArrivalAirport']['@attributes']['AirPortName'];
                            $Arrival_CityName_arr[$j] = $FlightSegment[$j]['ArrivalAirport']['@attributes']['CityName'];
                            $Arrival_LocationCode_arr[$j] = $FlightSegment[$j]['ArrivalAirport']['@attributes']['LocationCode'];

                            if (isset($FlightSegment[$j]['ArrivalAirport']['@attributes']['Terminal']))
                                $Arrival_Terminal_arr[$j] = $FlightSegment[$j]['ArrivalAirport']['@attributes']['Terminal'];

                            $AirEquipType_arr[$j] = $FlightSegment[$j]['Equipment']['@attributes']['AirEquipType'];

                            $MarketingAirline_Code_arr[$j] = $FlightSegment[$j]['MarketingAirline']['@attributes']['Code'];
                            $MarketingAirline_Name_arr[$j] = $FlightSegment[$j]['MarketingAirline']['@attributes']['Name'];

                            $Stops++;
                        }

                        $ArrivalDateTime = implode(',', $ArrivalDateTime_arr);
                        $DepartureDateTime = implode(',', $DepartureDateTime_arr);
                        $Duration = implode(',', $Duration_arr);
                        $FlightNumber = implode(',', $FlightNumber_arr);

                        if (!empty($SeatToSell_arr))
                            $SeatToSell = implode(',', $SeatToSell_arr);
                        else
                            $SeatToSell = '';

                        //$FareType = implode(',',$FareType_arr);
                        $ResBookDesigCode = implode(',', $ResBookDesigCode_arr);

                        if (empty($SeatToSell_arr))
                            $SeatToSell = implode(',', $SeatToSell_arr1);


                        $Departure_AirPortName = implode(',', $Departure_AirPortName_arr);
                        $Departure_CityName = implode(',', $Departure_CityName_arr);
                        $Departure_LocationCode = implode(',', $Departure_LocationCode_arr);

                        if (!empty($Departure_Terminal_arr))
                            $Departure_Terminal = implode(',', $Departure_Terminal_arr);
                        else
                            $Departure_Terminal = '';

                        $Arrival_AirPortName = implode(',', $Arrival_AirPortName_arr);
                        $Arrival_CityName = implode(',', $Arrival_CityName_arr);
                        $Arrival_LocationCode = implode(',', $Arrival_LocationCode_arr);

                        if (!empty($Arrival_Terminal_arr))
                            $Arrival_Terminal = implode(',', $Arrival_Terminal_arr);
                        else
                            $Arrival_Terminal = '';

                        $AirEquipType = implode(',', $AirEquipType_arr);
                        $MarketingAirline_Code = implode(',', $MarketingAirline_Code_arr);
                        $MarketingAirline_Name = implode(',', $MarketingAirline_Name_arr);
                    }
                    else {
                        $FlightSegment_attributes = $FlightSegment['@attributes'];
                        $ArrivalDateTime = $FlightSegment_attributes['ArrivalDateTime'];
                        $DepartureDateTime = $FlightSegment_attributes['DepartureDateTime'];
                        $Duration = $FlightSegment_attributes['Duration'];
                        $FlightNumber = $FlightSegment_attributes['FlightNumber'];

                        if (isset($FlightSegment_attributes['Status']))
                            $SeatToSell = $FlightSegment_attributes['Status'];

                        //$FareType = $FlightSegment['BookingClassAvail']['@attributes']['FareType'];
                        $ResBookDesigCode = $FlightSegment['BookingClassAvail']['@attributes']['ResBookDesigCode'];
                        if (isset($FlightSegment['BookingClassAvail']['@attributes']['Status']))
                            $SeatToSell = $FlightSegment['BookingClassAvail']['@attributes']['Status'];

                        $Departure_AirPortName = $FlightSegment['DepartureAirport']['@attributes']['AirPortName'];
                        $Departure_CityName = $FlightSegment['DepartureAirport']['@attributes']['CityName'];
                        $Departure_LocationCode = $FlightSegment['DepartureAirport']['@attributes']['LocationCode'];

                        if (isset($FlightSegment['DepartureAirport']['@attributes']['Terminal']))
                            $Departure_Terminal = $FlightSegment['DepartureAirport']['@attributes']['Terminal'];
                        else
                            $Departure_Terminal = '';

                        $Arrival_AirPortName = $FlightSegment['ArrivalAirport']['@attributes']['AirPortName'];
                        $Arrival_CityName = $FlightSegment['ArrivalAirport']['@attributes']['CityName'];
                        $Arrival_LocationCode = $FlightSegment['ArrivalAirport']['@attributes']['LocationCode'];

                        if (isset($FlightSegment['ArrivalAirport']['@attributes']['Terminal']))
                            $Arrival_Terminal = $FlightSegment['ArrivalAirport']['@attributes']['Terminal'];
                        else
                            $Arrival_Terminal = '';

                        $AirEquipType = $FlightSegment['Equipment']['@attributes']['AirEquipType'];

                        $MarketingAirline_Code = $FlightSegment['MarketingAirline']['@attributes']['Code'];
                        $MarketingAirline_Name = $FlightSegment['MarketingAirline']['@attributes']['Name'];
                    }

                    $AirItineraryPricingInfo = $PricedItinerary[$i]['AirItineraryPricingInfo'];
                    $BaseFare = $AirItineraryPricingInfo['ItinTotalFare']['BaseFare']['@attributes']['Amount'];
                    $CurrencyCode = $AirItineraryPricingInfo['ItinTotalFare']['BaseFare']['@attributes']['CurrencyCode'];

                    $Tax = $AirItineraryPricingInfo['ItinTotalFare']['Taxes']['Tax'];
                    if (isset($Tax[0])) {
                        for ($k = 0; $k < count($Tax); $k++) {
                            $Tax_attributes = $Tax[$k]['@attributes'];
                            $Tax_Amount_arr[$k] = $Tax_attributes['Amount'];
                            $TaxCode_arr[$k] = $Tax_attributes['TaxCode'];

                            if (isset($Tax_attributes['Description']))
                                $TaxDescription_arr[$k] = $Tax_attributes['Description'];
                            else
                                $TaxDescription_arr[$k] = '';
                        }

                        $Tax_Amount = implode(',', $Tax_Amount_arr);
                        $TaxCode = implode(',', $TaxCode_arr);
                        $TaxDescription = implode(',', $TaxDescription_arr);
                    }
                    else {
                        $Tax_attributes = $Tax['@attributes'];
                        $Tax_Amount = $Tax_attributes['Amount'];
                        $TaxCode = $Tax_attributes['TaxCode'];
                        if (isset($Tax_attributes['Description']))
                            $TaxDescription = $Tax_attributes['Description'];
                        else
                            $TaxDescription = '';
                    }

                    $TotalFare = $AirItineraryPricingInfo['ItinTotalFare']['TotalFare']['@attributes']['Amount'];

                    $ServiceTax = $AirItineraryPricingInfo['ItinTotalFare']['ServiceTax']['@attributes']['Amount'];

                    $Fee = $AirItineraryPricingInfo['ItinTotalFare']['Fees']['Fee'];
                    if (isset($Fee[0])) {
                        for ($k = 0; $k < count($Fee); $k++) {
                            $Fee_attributes = $Fee[$k]['@attributes'];
                            $Fee_Amount_arr[$k] = $Fee_attributes['Amount'];
                            if (isset($Fee_attributes['FeeCode']))
                                $FeeCode_arr[$k] = $Fee_attributes['FeeCode'];
                            else
                                $FeeCode_arr[$k] = '';
                        }

                        $Fee_Amount = implode(',', $Fee_Amount_arr);
                        if (!empty($FeeCode_arr))
                            $FeeCode = implode(',', $FeeCode_arr);
                        else
                            $FeeCode = '';
                    }
                    else {
                        $Fee_attributes = $Fee['@attributes'];
                        $Fee_Amount = $Fee_attributes['Amount'];
                        if (isset($Fee_attributes['FeeCode']))
                            $FeeCode = $Fee_attributes['FeeCode'];
                        else
                            $FeeCode = '';
                    }

                    $PTC_FareBreakdown = $AirItineraryPricingInfo['PTC_FareBreakdowns']['PTC_FareBreakdown'];
                    if (isset($PTC_FareBreakdown[0])) {
                        for ($l = 0; $l < count($PTC_FareBreakdown); $l++) {
                            $PassengerType_arr[$l] = $PTC_FareBreakdown[$l]['PassengerTypeQuantity']['@attributes']['Code'];
                            $PassengerQuantity_arr[$l] = $PTC_FareBreakdown[$l]['PassengerTypeQuantity']['@attributes']['Quantity'];
                            $PassengerBaseFare_arr[$l] = $PTC_FareBreakdown[$l]['PassengerFare']['BaseFare']['@attributes']['Amount'];

                            $PassengerTax = $PTC_FareBreakdown[$l]['PassengerFare']['Taxes']['Tax'];
                            if (isset($PassengerTax[0])) {
                                for ($m = 0; $m < count($PassengerTax); $m++) {
                                    $PassengerTax_attributes = $PassengerTax[$m]['@attributes'];
                                    $PassengerTax_Amount_arr[$m] = $PassengerTax_attributes['Amount'];
                                    $PassengerTaxCode_arr[$m] = $PassengerTax_attributes['TaxCode'];

                                    if (isset($PassengerTax_attributes['Description']))
                                        $PassengerTaxDescription_arr[$m] = $PassengerTax_attributes['Description'];
                                    else
                                        $PassengerTaxDescription_arr[$m] = '';
                                }

                                $PassengerTax_Amount = implode(',', $PassengerTax_Amount_arr);
                                $PassengerTaxCode = implode(',', $PassengerTaxCode_arr);
                                $PassengerTaxDescription = implode(',', $PassengerTaxDescription_arr);
                            }
                            else {
                                $PassengerTax_attributes = $PassengerTax['@attributes'];
                                $PassengerTax_Amount = $PassengerTax_attributes['Amount'];
                                $PassengerTaxCode = $PassengerTax_attributes['TaxCode'];
                                if (isset($PassengerTax_attributes['Description']))
                                    $PassengerTaxDescription = $PassengerTax_attributes['Description'];
                                else
                                    $PassengerTaxDescription = '';
                            }

                            $PassengerTotalFare_arr[$l] = $PTC_FareBreakdown[$l]['PassengerFare']['TotalFare']['@attributes']['Amount'];
                            $PassengerServiceTax_arr[$l] = $PTC_FareBreakdown[$l]['PassengerFare']['ServiceTax']['@attributes']['Amount'];
                        }

                        $PassengerType = implode(',', $PassengerType_arr);
                        $PassengerQuantity = implode(',', $PassengerQuantity_arr);
                        $PassengerBaseFare = implode(',', $PassengerBaseFare_arr);

                        $PassengerTotalFare = implode(',', $PassengerTotalFare_arr);
                        $PassengerServiceTax = implode(',', $PassengerServiceTax_arr);
                    }
                    else {
                        $PassengerType = $PTC_FareBreakdown['PassengerTypeQuantity']['@attributes']['Code'];
                        $PassengerQuantity = $PTC_FareBreakdown['PassengerTypeQuantity']['@attributes']['Quantity'];
                        $PassengerBaseFare = $PTC_FareBreakdown['PassengerFare']['BaseFare']['@attributes']['Amount'];

                        $PassengerTax = $PTC_FareBreakdown['PassengerFare']['Taxes']['Tax'];
                        if (isset($PassengerTax[0])) {
                            for ($n = 0; $n < count($PassengerTax); $n++) {
                                $PassengerTax_attributes = $PassengerTax[$n]['@attributes'];
                                $PassengerTax_Amount_arr[$n] = $PassengerTax_attributes['Amount'];
                                $PassengerTaxCode_arr[$n] = $PassengerTax_attributes['TaxCode'];
                                if (isset($PassengerTax_attributes['Description']))
                                    $PassengerTaxDescription_arr[$n] = $PassengerTax_attributes['Description'];
                                else
                                    $PassengerTaxDescription_arr[$n] = '';
                            }

                            $PassengerTax_Amount = implode(',', $PassengerTax_Amount_arr);
                            $PassengerTaxCode = implode(',', $PassengerTaxCode_arr);
                            if (!empty($PassengerTaxDescription_arr))
                                $PassengerTaxDescription = implode(',', $PassengerTaxDescription_arr);
                            else
                                $PassengerTaxDescription = '';
                        }
                        else {
                            $PassengerTax_attributes = $PassengerTax['@attributes'];
                            $PassengerTax_Amount = $PassengerTax_attributes['Amount'];
                            $PassengerTaxCode = $PassengerTax_attributes['TaxCode'];

                            if (isset($PassengerTax_attributes['Description']))
                                $PassengerTaxDescription = $PassengerTax_attributes['Description'];
                            else
                                $PassengerTaxDescription = '';
                        }

                        $PassengerTotalFare = $PTC_FareBreakdown['PassengerFare']['TotalFare']['@attributes']['Amount'];
                        $PassengerServiceTax = $PTC_FareBreakdown['PassengerFare']['ServiceTax']['@attributes']['Amount'];
                    }

                    $api_name = 'yatra';
                    $Service_Type = 2;
                    $insert = $this->Flight_Model->insert_flight_temp_results($i, $this->sess_id, $api_name, $SequenceNumber, $UniqueIdentifier, $OriginDestinationRPH, $FlightID, $SupplierSystem, $originCode, $destinationCode, $adults, $childs, $infants, $Total_Duration, $ArrivalDateTime, $DepartureDateTime, $Duration, $FlightNumber, $SeatToSell, $FareType, $ResBookDesigCode, $Departure_AirPortName, $Departure_CityName, $Departure_LocationCode, $Departure_Terminal, $Arrival_AirPortName, $Arrival_CityName, $Arrival_LocationCode, $Arrival_Terminal, $AirEquipType, $MarketingAirline_Code, $MarketingAirline_Name, $Stops, $BaseFare, $CurrencyCode, $Tax_Amount, $TaxCode, $TaxDescription, $TotalFare, $ServiceTax, $Fee_Amount, $FeeCode, $PassengerType, $PassengerQuantity, $PassengerBaseFare, $PassengerTax_Amount, $PassengerTaxCode, $PassengerTaxDescription, $PassengerTotalFare, $PassengerServiceTax, $tripType, $Service_Type);
                }
            }
            else {
                $OriginDestinationOption_attributes = $OriginDestinationOption['@attributes'];
                $Total_Duration = $OriginDestinationOption_attributes['Duration'];
                $FlightID = $OriginDestinationOption_attributes['FlightID'];
                $SupplierSystem = $OriginDestinationOption_attributes['SupplierSystem'];
                $UniqueIdentifier = $OriginDestinationOption_attributes['UniqueIdentifier'];

                $Stops = 0;
                $FlightSegment = $OriginDestinationOption['FlightSegment'];
                if (isset($FlightSegment[0])) {
                    for ($j = 0; $j < count($FlightSegment); $j++) {
                        $FlightSegment_attributes = $FlightSegment[$j]['@attributes'];
                        $ArrivalDateTime_arr[$j] = $FlightSegment_attributes['ArrivalDateTime'];
                        $DepartureDateTime_arr[$j] = $FlightSegment_attributes['DepartureDateTime'];
                        $Duration_arr[$j] = $FlightSegment_attributes['Duration'];
                        $FlightNumber_arr[$j] = $FlightSegment_attributes['FlightNumber'];

                        if (isset($FlightSegment_attributes['Status']))
                            $SeatToSell_arr[$j] = $FlightSegment_attributes['Status'];

                        //$FareType_arr[$j] = $FlightSegment[$j]['BookingClassAvail']['@attributes']['FareType'];
                        $ResBookDesigCode_arr[$j] = $FlightSegment[$j]['BookingClassAvail']['@attributes']['ResBookDesigCode'];
                        if (isset($FlightSegment[$j]['BookingClassAvail']['@attributes']['Status']))
                            $SeatToSell_arr1[$j] = $FlightSegment[$j]['BookingClassAvail']['@attributes']['Status'];

                        $Departure_AirPortName_arr[$j] = $FlightSegment[$j]['DepartureAirport']['@attributes']['AirPortName'];
                        $Departure_CityName_arr[$j] = $FlightSegment[$j]['DepartureAirport']['@attributes']['CityName'];
                        $Departure_LocationCode_arr[$j] = $FlightSegment[$j]['DepartureAirport']['@attributes']['LocationCode'];

                        if (isset($FlightSegment[$j]['DepartureAirport']['@attributes']['Terminal']))
                            $Departure_Terminal_arr[$j] = $FlightSegment[$j]['DepartureAirport']['@attributes']['Terminal'];

                        $Arrival_AirPortName_arr[$j] = $FlightSegment[$j]['ArrivalAirport']['@attributes']['AirPortName'];
                        $Arrival_CityName_arr[$j] = $FlightSegment[$j]['ArrivalAirport']['@attributes']['CityName'];
                        $Arrival_LocationCode_arr[$j] = $FlightSegment[$j]['ArrivalAirport']['@attributes']['LocationCode'];

                        if (isset($FlightSegment[$j]['ArrivalAirport']['@attributes']['Terminal']))
                            $Arrival_Terminal_arr[$j] = $FlightSegment[$j]['ArrivalAirport']['@attributes']['Terminal'];

                        $AirEquipType_arr[$j] = $FlightSegment[$j]['Equipment']['@attributes']['AirEquipType'];

                        $MarketingAirline_Code_arr[$j] = $FlightSegment[$j]['MarketingAirline']['@attributes']['Code'];
                        $MarketingAirline_Name_arr[$j] = $FlightSegment[$j]['MarketingAirline']['@attributes']['Name'];

                        $Stops++;
                    }

                    $ArrivalDateTime = implode(',', $ArrivalDateTime_arr);
                    $DepartureDateTime = implode(',', $DepartureDateTime_arr);
                    $Duration = implode(',', $Duration_arr);
                    $FlightNumber = implode(',', $FlightNumber_arr);

                    if (!empty($SeatToSell_arr))
                        $SeatToSell = implode(',', $SeatToSell_arr);
                    else
                        $SeatToSell = '';

                    //$FareType = implode(',',$FareType_arr);
                    $ResBookDesigCode = implode(',', $ResBookDesigCode_arr);

                    if (empty($SeatToSell_arr))
                        $SeatToSell = implode(',', $SeatToSell_arr1);


                    $Departure_AirPortName = implode(',', $Departure_AirPortName_arr);
                    $Departure_CityName = implode(',', $Departure_CityName_arr);
                    $Departure_LocationCode = implode(',', $Departure_LocationCode_arr);

                    if (!empty($Departure_Terminal_arr))
                        $Departure_Terminal = implode(',', $Departure_Terminal_arr);
                    else
                        $Departure_Terminal = '';

                    $Arrival_AirPortName = implode(',', $Arrival_AirPortName_arr);
                    $Arrival_CityName = implode(',', $Arrival_CityName_arr);
                    $Arrival_LocationCode = implode(',', $Arrival_LocationCode_arr);

                    if (!empty($Arrival_Terminal_arr))
                        $Arrival_Terminal = implode(',', $Arrival_Terminal_arr);
                    else
                        $Arrival_Terminal = '';

                    $AirEquipType = implode(',', $AirEquipType_arr);
                    $MarketingAirline_Code = implode(',', $MarketingAirline_Code_arr);
                    $MarketingAirline_Name = implode(',', $MarketingAirline_Name_arr);
                }
                else {
                    $FlightSegment_attributes = $FlightSegment['@attributes'];
                    $ArrivalDateTime = $FlightSegment_attributes['ArrivalDateTime'];
                    $DepartureDateTime = $FlightSegment_attributes['DepartureDateTime'];
                    $Duration = $FlightSegment_attributes['Duration'];
                    $FlightNumber = $FlightSegment_attributes['FlightNumber'];

                    if (isset($FlightSegment_attributes['Status']))
                        $SeatToSell = $FlightSegment_attributes['Status'];

                    //$FareType = $FlightSegment['BookingClassAvail']['@attributes']['FareType'];
                    $ResBookDesigCode = $FlightSegment['BookingClassAvail']['@attributes']['ResBookDesigCode'];
                    if (isset($FlightSegment['BookingClassAvail']['@attributes']['Status']))
                        $SeatToSell = $FlightSegment['BookingClassAvail']['@attributes']['Status'];

                    $Departure_AirPortName = $FlightSegment['DepartureAirport']['@attributes']['AirPortName'];
                    $Departure_CityName = $FlightSegment['DepartureAirport']['@attributes']['CityName'];
                    $Departure_LocationCode = $FlightSegment['DepartureAirport']['@attributes']['LocationCode'];

                    if (isset($FlightSegment['DepartureAirport']['@attributes']['Terminal']))
                        $Departure_Terminal = $FlightSegment['DepartureAirport']['@attributes']['Terminal'];
                    else
                        $Departure_Terminal = '';

                    $Arrival_AirPortName = $FlightSegment['ArrivalAirport']['@attributes']['AirPortName'];
                    $Arrival_CityName = $FlightSegment['ArrivalAirport']['@attributes']['CityName'];
                    $Arrival_LocationCode = $FlightSegment['ArrivalAirport']['@attributes']['LocationCode'];

                    if (isset($FlightSegment['ArrivalAirport']['@attributes']['Terminal']))
                        $Arrival_Terminal = $FlightSegment['ArrivalAirport']['@attributes']['Terminal'];
                    else
                        $Arrival_Terminal = '';

                    $AirEquipType = $FlightSegment['Equipment']['@attributes']['AirEquipType'];

                    $MarketingAirline_Code = $FlightSegment['MarketingAirline']['@attributes']['Code'];
                    $MarketingAirline_Name = $FlightSegment['MarketingAirline']['@attributes']['Name'];
                }

                $AirItineraryPricingInfo = $PricedItinerary[$i]['AirItineraryPricingInfo'];
                $BaseFare = $AirItineraryPricingInfo['ItinTotalFare']['BaseFare']['@attributes']['Amount'];
                $CurrencyCode = $AirItineraryPricingInfo['ItinTotalFare']['BaseFare']['@attributes']['CurrencyCode'];

                $Tax = $AirItineraryPricingInfo['ItinTotalFare']['Taxes']['Tax'];
                if (isset($Tax[0])) {
                    for ($k = 0; $k < count($Tax); $k++) {
                        $Tax_attributes = $Tax[$k]['@attributes'];
                        $Tax_Amount_arr[$k] = $Tax_attributes['Amount'];
                        $TaxCode_arr[$k] = $Tax_attributes['TaxCode'];

                        if (isset($Tax_attributes['Description']))
                            $TaxDescription_arr[$k] = $Tax_attributes['Description'];
                        else
                            $TaxDescription_arr[$k] = '';
                    }

                    $Tax_Amount = implode(',', $Tax_Amount_arr);
                    $TaxCode = implode(',', $TaxCode_arr);
                    $TaxDescription = implode(',', $TaxDescription_arr);
                }
                else {
                    $Tax_attributes = $Tax['@attributes'];
                    $Tax_Amount = $Tax_attributes['Amount'];
                    $TaxCode = $Tax_attributes['TaxCode'];
                    if (isset($Tax_attributes['Description']))
                        $TaxDescription = $Tax_attributes['Description'];
                    else
                        $TaxDescription = '';
                }

                $TotalFare = $AirItineraryPricingInfo['ItinTotalFare']['TotalFare']['@attributes']['Amount'];

                $ServiceTax = $AirItineraryPricingInfo['ItinTotalFare']['ServiceTax']['@attributes']['Amount'];

                $Fee = $AirItineraryPricingInfo['ItinTotalFare']['Fees']['Fee'];
                if (isset($Fee[0])) {
                    for ($k = 0; $k < count($Fee); $k++) {
                        $Fee_attributes = $Fee[$k]['@attributes'];
                        $Fee_Amount_arr[$k] = $Fee_attributes['Amount'];
                        if (isset($Fee_attributes['FeeCode']))
                            $FeeCode_arr[$k] = $Fee_attributes['FeeCode'];
                        else
                            $FeeCode_arr[$k] = '';
                    }

                    $Fee_Amount = implode(',', $Fee_Amount_arr);
                    if (!empty($FeeCode_arr))
                        $FeeCode = implode(',', $FeeCode_arr);
                    else
                        $FeeCode = '';
                }
                else {
                    $Fee_attributes = $Fee['@attributes'];
                    $Fee_Amount = $Fee_attributes['Amount'];
                    if (isset($Fee_attributes['FeeCode']))
                        $FeeCode = $Fee_attributes['FeeCode'];
                    else
                        $FeeCode = '';
                }

                $PTC_FareBreakdown = $AirItineraryPricingInfo['PTC_FareBreakdowns']['PTC_FareBreakdown'];
                if (isset($PTC_FareBreakdown[0])) {
                    for ($l = 0; $l < count($PTC_FareBreakdown); $l++) {
                        $PassengerType_arr[$l] = $PTC_FareBreakdown[$l]['PassengerTypeQuantity']['@attributes']['Code'];
                        $PassengerQuantity_arr[$l] = $PTC_FareBreakdown[$l]['PassengerTypeQuantity']['@attributes']['Quantity'];
                        $PassengerBaseFare_arr[$l] = $PTC_FareBreakdown[$l]['PassengerFare']['BaseFare']['@attributes']['Amount'];

                        $PassengerTax = $PTC_FareBreakdown[$l]['PassengerFare']['Taxes']['Tax'];
                        if (isset($PassengerTax[0])) {
                            for ($m = 0; $m < count($PassengerTax); $m++) {
                                $PassengerTax_attributes = $PassengerTax[$m]['@attributes'];
                                $PassengerTax_Amount_arr[$m] = $PassengerTax_attributes['Amount'];
                                $PassengerTaxCode_arr[$m] = $PassengerTax_attributes['TaxCode'];

                                if (isset($PassengerTax_attributes['Description']))
                                    $PassengerTaxDescription_arr[$m] = $PassengerTax_attributes['Description'];
                                else
                                    $PassengerTaxDescription_arr[$m] = '';
                            }

                            $PassengerTax_Amount = implode(',', $PassengerTax_Amount_arr);
                            $PassengerTaxCode = implode(',', $PassengerTaxCode_arr);
                            $PassengerTaxDescription = implode(',', $PassengerTaxDescription_arr);
                        }
                        else {
                            $PassengerTax_attributes = $PassengerTax['@attributes'];
                            $PassengerTax_Amount = $PassengerTax_attributes['Amount'];
                            $PassengerTaxCode = $PassengerTax_attributes['TaxCode'];
                            if (isset($PassengerTax_attributes['Description']))
                                $PassengerTaxDescription = $PassengerTax_attributes['Description'];
                            else
                                $PassengerTaxDescription = '';
                        }

                        $PassengerTotalFare_arr[$l] = $PTC_FareBreakdown[$l]['PassengerFare']['TotalFare']['@attributes']['Amount'];
                        $PassengerServiceTax_arr[$l] = $PTC_FareBreakdown[$l]['PassengerFare']['ServiceTax']['@attributes']['Amount'];
                    }

                    $PassengerType = implode(',', $PassengerType_arr);
                    $PassengerQuantity = implode(',', $PassengerQuantity_arr);
                    $PassengerBaseFare = implode(',', $PassengerBaseFare_arr);

                    $PassengerTotalFare = implode(',', $PassengerTotalFare_arr);
                    $PassengerServiceTax = implode(',', $PassengerServiceTax_arr);
                }
                else {
                    $PassengerType = $PTC_FareBreakdown['PassengerTypeQuantity']['@attributes']['Code'];
                    $PassengerQuantity = $PTC_FareBreakdown['PassengerTypeQuantity']['@attributes']['Quantity'];
                    $PassengerBaseFare = $PTC_FareBreakdown['PassengerFare']['BaseFare']['@attributes']['Amount'];

                    $PassengerTax = $PTC_FareBreakdown['PassengerFare']['Taxes']['Tax'];
                    if (isset($PassengerTax[0])) {
                        for ($n = 0; $n < count($PassengerTax); $n++) {
                            $PassengerTax_attributes = $PassengerTax[$n]['@attributes'];
                            $PassengerTax_Amount_arr[$n] = $PassengerTax_attributes['Amount'];
                            $PassengerTaxCode_arr[$n] = $PassengerTax_attributes['TaxCode'];
                            if (isset($PassengerTax_attributes['Description']))
                                $PassengerTaxDescription_arr[$n] = $PassengerTax_attributes['Description'];
                            else
                                $PassengerTaxDescription_arr[$n] = '';
                        }

                        $PassengerTax_Amount = implode(',', $PassengerTax_Amount_arr);
                        $PassengerTaxCode = implode(',', $PassengerTaxCode_arr);
                        if (!empty($PassengerTaxDescription_arr))
                            $PassengerTaxDescription = implode(',', $PassengerTaxDescription_arr);
                        else
                            $PassengerTaxDescription = '';
                    }
                    else {
                        $PassengerTax_attributes = $PassengerTax['@attributes'];
                        $PassengerTax_Amount = $PassengerTax_attributes['Amount'];
                        $PassengerTaxCode = $PassengerTax_attributes['TaxCode'];

                        if (isset($PassengerTax_attributes['Description']))
                            $PassengerTaxDescription = $PassengerTax_attributes['Description'];
                        else
                            $PassengerTaxDescription = '';
                    }

                    $PassengerTotalFare = $PTC_FareBreakdown['PassengerFare']['TotalFare']['@attributes']['Amount'];
                    $PassengerServiceTax = $PTC_FareBreakdown['PassengerFare']['ServiceTax']['@attributes']['Amount'];
                }

                $api_name = 'yatra';
                $Service_Type = 2;
                $insert = $this->Flight_Model->insert_flight_temp_results($i, $this->sess_id, $api_name, $SequenceNumber, $UniqueIdentifier, $OriginDestinationRPH, $FlightID, $SupplierSystem, $originCode, $destinationCode, $adults, $childs, $infants, $Total_Duration, $ArrivalDateTime, $DepartureDateTime, $Duration, $FlightNumber, $SeatToSell, $FareType, $ResBookDesigCode, $Departure_AirPortName, $Departure_CityName, $Departure_LocationCode, $Departure_Terminal, $Arrival_AirPortName, $Arrival_CityName, $Arrival_LocationCode, $Arrival_Terminal, $AirEquipType, $MarketingAirline_Code, $MarketingAirline_Name, $Stops, $BaseFare, $CurrencyCode, $Tax_Amount, $TaxCode, $TaxDescription, $TotalFare, $ServiceTax, $Fee_Amount, $FeeCode, $PassengerType, $PassengerQuantity, $PassengerBaseFare, $PassengerTax_Amount, $PassengerTaxCode, $PassengerTaxDescription, $PassengerTotalFare, $PassengerServiceTax, $tripType, $Service_Type);
            }
        }

        return $insert;
    }

    // <-- IntAirLowFareSearchRQ-OneWay Ends Here -->
    // Flight Details 
    function flight_int_details() {
        //echo '<pre/>';print_r($_POST);	
        if (isset($_POST['onwardFlightId'])) {
            $onwardFlightId = $_POST['onwardFlightId'];
            $onwardIdVal = $_POST['onwardIdVal'];
            $result = $this->Flight_Model->get_selected_flightdetails($onwardFlightId);
            $data['flight_result'] = $result;
            //echo '<pre/>';print_r($result);exit;

            $this->load->library('xml_2_array');
            $this->load->library('array_2_xml');

            $IntAirLowFareSearchRS_xml = $_SESSION['IntAirLowFareSearchRS_xml'];
            //echo "<pre/>";print_r($IntAirLowFareSearchRS_xml);exit;
            //$IntAirLowFareSearchRS_xml = $this->session->userdata('IntAirLowFareSearchRS_xml');	
            $IntAirLowFareSearchRS_arr = $this->xml_2_array->createArray($IntAirLowFareSearchRS_xml);
            //echo "<pre/>";print_r($IntAirLowFareSearchRS_arr);exit;

            $session_data = $this->session->userdata('flight_search_data');
            $cabinClass = $session_data['cabinClass'];

            $OriginDestinationOption = "";
            if (isset($onwardIdVal) && $onwardIdVal != "") {
                $q = $onwardIdVal;
                $xml = $this->array_2_xml->createXML('ns1:OriginDestinationOption', $IntAirLowFareSearchRS_arr['soapenv:Envelope']['soapenv:Body']['OTA_AirLowFareSearchRS']['PricedItineraries']['PricedItinerary'][$q]['AirItinerary']['OriginDestinationOptions']);

                $OriginDestinationOption = str_replace('<?xml version="1.0" encoding="UTF-8"?>', '', $xml->saveXML());
                $OriginDestinationOption = str_replace('<ns1:OriginDestinationOption>', '', $OriginDestinationOption);
                $OriginDestinationOption = str_replace('</ns1:OriginDestinationOption>', '', $OriginDestinationOption);

                $OriginDestinationOption = str_replace('<FormData></FormData>', '<FormData/>', $OriginDestinationOption);
                $OriginDestinationOption = str_replace('<FormData>', '<FormData>' . $cabinClass, $OriginDestinationOption);

                //echo $OriginDestinationOption;exit;
            }

            $airitinerary = '<AirItinerary><OriginDestinationOptions>' . $OriginDestinationOption . '</OriginDestinationOptions></AirItinerary>';

            preg_match("/<session>(.*)<\/session>/", $airitinerary, $session_tag_matches);
            if (!empty($session_tag_matches)) {
                $airitinerary = str_replace('<FormData>' . $cabinClass, '<FormData>', $airitinerary);
                $airitinerary = str_replace('</session>', '</session>' . $cabinClass, $airitinerary);
            }

            //echo "<pre/>";print_r($airitinerary);exit;

            $IntAirPriceRS = $this->IntAirPriceRQ($airitinerary);
            $IntAirPriceRS = str_replace("ns1:", '', $IntAirPriceRS);
            $IntAirPriceRS = str_replace("<FormData>" . $cabinClass, '<FormData>', $IntAirPriceRS);

            preg_match("/<session>(.*)<\/session>/", $IntAirPriceRS, $session_tag_matches);
            if (!empty($session_tag_matches)) {
                $IntAirPriceRS = str_replace('</session>' . $cabinClass, '</session>', $IntAirPriceRS);
            }
            //echo "<pre/>";print_r($IntAirPriceRS);exit;
            $IntAirPriceRS_arr = $this->xml_2_array->createArray($IntAirPriceRS);
            $this->session->set_userdata('IntAirPriceRS_arr',$IntAirPriceRS_arr);			
            //echo "<pre/>";print_r($IntAirPriceRS_arr);exit;			
            $data['IntAirPriceRS_arr']  = $IntAirPriceRS_arr;

            $this->load->view('b2c/flight/int_booking', $data);
        } else {
            redirect('flight/int_search_progress', 'refresh');
        }
    }

    // IntAirPriceRQ Xml starts here	
    public function IntAirPriceRQ($airitinerary) {
		
        $this->xml = '<?xml version="1.0" encoding="UTF-8"?>
			<soap:Envelope xmlns="http://www.opentravel.org/OTA/2003/05" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:wsse="http://schemas.xmlsoap.org/ws/2002/12/secext">
			 <soap:Body>			 
			   <OTA_AirPriceRQ xmlns="http://www.opentravel.org/OTA/2003/05">
			<POS xmlns="http://www.opentravel.org/OTA/2003/05">
				<Source AgentSine="" PseudoCityCode="NPCK" TerminalID="1">
					<RequestorID ID="AFFILIATE"></RequestorID>
				</Source>
				<YatraRequests>
					<YatraRequest YatraRequestTypeCode="SMPA" Description="" MidOfficeAgentID="' . $this->MidOfficeAgentID . '" AgentEmailID="" AgentTypeCode="" AffiliateID="YTFABTRAVEL" Destination="INT"/>
				</YatraRequests>
			</POS>
			   <SpecificFlightInfo>
					<BookingClassPref ResBookDesigCode=""></BookingClassPref>
			   	</SpecificFlightInfo>
				' . $airitinerary . '
				<TravelerInfoSummary>
					<AirTravelerAvail>' . $this->session->userdata('TravelerInfoXML') . '</AirTravelerAvail>
			   </TravelerInfoSummary>
			  </OTA_AirPriceRQ>
			 </soap:Body>
			</soap:Envelope>';

        //echo $this->xml;

        $IntAirPriceRS = $this->PostRQ($this->xml);

        return $IntAirPriceRS;
    }

    // IntAirPriceRQ Xml Ends here	


    function confirm_int_booking() {
        //echo '<pre/>';print_r($_POST);exit;
        //$_SESSION['user_booking_info'] = $_POST;
        $this->session->set_userdata('user_booking_info', $_POST);

        if (isset($_POST['onwardFlightId'])) {
            $flight_result = $this->Flight_Model->get_selected_flightdetails($_POST['onwardFlightId']);

            $Origin = $flight_result->Origin;
            $Destination = $flight_result->Destination;
            $Adults = $flight_result->Adults;
            $Childs = $flight_result->Childs;
            $Infants = $flight_result->Infants;

            $ArrivalDateTime = $flight_result->ArrivalDateTime;
            $DepartureDateTime = $flight_result->DepartureDateTime;
            $FlightNumber = $flight_result->FlightNumber;
            $FareType = $flight_result->FareType;

            $Departure_AirPortName = $flight_result->Departure_AirPortName;
            $Departure_CityName = $flight_result->Departure_CityName;
            $Departure_LocationCode = $flight_result->Departure_LocationCode;
            $Departure_Terminal = $flight_result->Departure_Terminal;

            $Arrival_AirPortName = $flight_result->Arrival_AirPortName;
            $Arrival_CityName = $flight_result->Arrival_CityName;
            $Arrival_LocationCode = $flight_result->Arrival_LocationCode;
            $Arrival_Terminal = $flight_result->Arrival_Terminal;

            $AirEquipType = $flight_result->AirEquipType;
            $MarketingAirline_Code = $flight_result->MarketingAirline_Code;
            $MarketingAirline_Name = $flight_result->MarketingAirline_Name;
            $BaseFare = $flight_result->BaseFare;

            $CurrencyCode = $flight_result->CurrencyCode;
            $Tax_Amount = $flight_result->Tax_Amount;
            $Tax_Code = $flight_result->Tax_Code;
            $Tax_Description = $flight_result->Tax_Description;

            $TotalFare = $flight_result->TotalFare;
            $ServiceTax = $flight_result->ServiceTax;
            $Fee_Amount = $flight_result->Fee_Amount;
            $Stops = $flight_result->Stops;

            $PassengerType = $flight_result->PassengerType;
            $PassengerBaseFare = $flight_result->PassengerBaseFare;
            $PassengerTax_Amount = $flight_result->PassengerTax_Amount;
            $PassengerTax_Code = $flight_result->PassengerTax_Code;
            $PassengerTax_Description = $flight_result->PassengerTax_Description;
            $PassengerTotalFare = $flight_result->PassengerTotalFare;

            $PassengerServiceTax = $flight_result->PassengerServiceTax;
            $Payment_Charge = $flight_result->Payment_Charge;
            $Admin_Markup = $flight_result->Admin_Markup;
            $Trip_Type = $flight_result->Trip_Type;
            $Service_Type = $flight_result->Service_Type;
            $SequenceNumber = $flight_result->SequenceNumber;

            $ResBookDesigCode = $flight_result->ResBookDesigCode;

            $session_data = $this->session->userdata('flight_search_data');
            $sess_tripType = $session_data['tripType'];

            $TotalFare_r = 0;

            if (isset($sess_tripType) && $sess_tripType == 'R') {
                $OriginDestinationRPH = $flight_result->OriginDestinationRPH;
                $flight_result_return = $this->Flight_Model->get_return_flight_result($OriginDestinationRPH);

                $Origin_r = $flight_result_return->Destination;
                $Destination_r = $flight_result_return->Origin;
                $Adults_r = $flight_result_return->Adults;
                $Childs_r = $flight_result_return->Childs;
                $Infants_r = $flight_result_return->Infants;

                $ArrivalDateTime_r = $flight_result_return->ArrivalDateTime;
                $DepartureDateTime_r = $flight_result_return->DepartureDateTime;
                $FlightNumber_r = $flight_result_return->FlightNumber;
                $FareType_r = $flight_result_return->FareType;

                $Departure_AirPortName_r = $flight_result_return->Departure_AirPortName;
                $Departure_CityName_r = $flight_result_return->Departure_CityName;
                $Departure_LocationCode_r = $flight_result_return->Departure_LocationCode;
                $Departure_Terminal_r = $flight_result_return->Departure_Terminal;

                $Arrival_AirPortName_r = $flight_result_return->Arrival_AirPortName;
                $Arrival_CityName_r = $flight_result_return->Arrival_CityName;
                $Arrival_LocationCode_r = $flight_result_return->Arrival_LocationCode;
                $Arrival_Terminal_r = $flight_result_return->Arrival_Terminal;

                $AirEquipType_r = $flight_result_return->AirEquipType;
                $MarketingAirline_Code_r = $flight_result_return->MarketingAirline_Code;
                $MarketingAirline_Name_r = $flight_result_return->MarketingAirline_Name;
                $BaseFare_r = $flight_result_return->BaseFare;

                $CurrencyCode_r = $flight_result_return->CurrencyCode;
                $Tax_Amount_r = $flight_result_return->Tax_Amount;
                $Tax_Code_r = $flight_result_return->Tax_Code;
                $Tax_Description_r = $flight_result_return->Tax_Description;

                $TotalFare_r = $flight_result_return->TotalFare;
                $ServiceTax_r = $flight_result_return->ServiceTax;
                $Fee_Amount_r = $flight_result_return->Fee_Amount;
                $Stops_r = $flight_result_return->Stops;

                $PassengerType_r = $flight_result_return->PassengerType;
                $PassengerBaseFare_r = $flight_result_return->PassengerBaseFare;
                $PassengerTax_Amount_r = $flight_result_return->PassengerTax_Amount;
                $PassengerTax_Code_r = $flight_result_return->PassengerTax_Code;
                $PassengerTax_Description_r = $flight_result_return->PassengerTax_Description;
                $PassengerTotalFare_r = $flight_result_return->PassengerTotalFare;

                $PassengerServiceTax_r = $flight_result_return->PassengerServiceTax;
                $Payment_Charge_r = $flight_result_return->Payment_Charge;
                $Admin_Markup_r = $flight_result_return->Admin_Markup;
                $Trip_Type_r = $flight_result_return->Trip_Type;
                $Service_Type_r = $flight_result_return->Service_Type;
                $SequenceNumber_r = $flight_result_return->SequenceNumber;
                $ResBookDesigCode_r = $flight_result_return->ResBookDesigCode;
            }

            $totalAmount = $TotalFare + $TotalFare_r;

            if ($this->session->userdata('user_logged_in') == 1 && $this->session->userdata('user_id') != '') {
                $user_id = $this->session->userdata('user_id');
            } else {
                $user_id = 0;
            }

            $api_name = 'yatra';

            $this->load->library('array_2_xml');
            $this->load->library('xml_2_array');

            $session_data = $this->session->userdata('flight_search_data');
            $cabinClass = $session_data['cabinClass'];

            $IntAirPriceRS_arr = $this->session->userdata('IntAirPriceRS_arr');
            //echo "<pre/>ss";print_r($IntAirPriceRS_arr);exit;

            $PricedItinerary_arr = $IntAirPriceRS_arr['soapenv:Envelope']['soapenv:Body']['OTA_AirPriceRS']['PricedItineraries']['PricedItinerary'];

            $AirItinerary_node_r = '';
            $PricingInfo_node_r = '';
            if (isset($PricedItinerary_arr[0])) {
                $AirItinerary_arr = $PricedItinerary_arr[0]['AirItinerary'];

                $AirItinerary_xml = $this->array_2_xml->createXML('ns1:AirItinerary', $AirItinerary_arr);
                $AirItinerary_node = str_replace('<?xml version="1.0" encoding="UTF-8"?>', '', $AirItinerary_xml->saveXML());
                $AirItinerary_node = str_replace('ns1:', '', $AirItinerary_node);
                $AirItinerary_node = str_replace('<FormData></FormData>', '<FormData/>', $AirItinerary_node);
                $AirItinerary_node = str_replace('<FormData>', '<FormData>' . $cabinClass, $AirItinerary_node);

                preg_match("/<session>(.*)<\/session>/", $AirItinerary_node, $session_tag_matches);
                if (!empty($session_tag_matches)) {
                    $AirItinerary_node = str_replace('<FormData>' . $cabinClass, '<FormData>', $AirItinerary_node);
                    $AirItinerary_node = str_replace('</session>', '</session>' . $cabinClass, $AirItinerary_node);
                }
                //echo "<pre/>";print_r($AirItinerary_node);exit;

                $PricingInfo_arr = $PricedItinerary_arr[0]['AirItineraryPricingInfo'];
                $PricingInfo_xml = $this->array_2_xml->createXML('ns1:PriceInfo', $PricingInfo_arr);
                $PricingInfo_node = str_replace('<?xml version="1.0" encoding="UTF-8"?>', '', $PricingInfo_xml->saveXML());
                $PricingInfo_node = str_replace('ns1:', '', $PricingInfo_node);
                //echo "<pre/>";print_r($PricingInfo_node);exit;
                // Return flight AirItinerary 
                $AirItinerary_arr_r = $PricedItinerary_arr[1]['AirItinerary'];

                $AirItinerary_xml_r = $this->array_2_xml->createXML('ns1:AirItinerary', $AirItinerary_arr_r);
                $AirItinerary_node_r = str_replace('<?xml version="1.0" encoding="UTF-8"?>', '', $AirItinerary_xml_r->saveXML());
                $AirItinerary_node_r = str_replace('ns1:', '', $AirItinerary_node_r);
                $AirItinerary_node_r = str_replace('<FormData></FormData>', '<FormData/>', $AirItinerary_node_r);
                $AirItinerary_node_r = str_replace('<FormData>', '<FormData>' . $cabinClass, $AirItinerary_node_r);

                preg_match("/<session>(.*)<\/session>/", $AirItinerary_node_r, $session_tag_matches);
                if (!empty($session_tag_matches)) {
                    $AirItinerary_node_r = str_replace('<FormData>' . $cabinClass, '<FormData>', $AirItinerary_node_r);
                    $AirItinerary_node_r = str_replace('</session>', '</session>' . $cabinClass, $AirItinerary_node_r);
                }
                //echo "<pre/>";print_r($AirItinerary_node_r);exit;

                $PricingInfo_arr_r = $PricedItinerary_arr[1]['AirItineraryPricingInfo'];
                $PricingInfo_xml_r = $this->array_2_xml->createXML('ns1:PriceInfo', $PricingInfo_arr_r);
                $PricingInfo_node_r = str_replace('<?xml version="1.0" encoding="UTF-8"?>', '', $PricingInfo_xml_r->saveXML());
                $PricingInfo_node_r = str_replace('ns1:', '', $PricingInfo_node_r);
                //echo "<pre/>";print_r($PricingInfo_node);exit;
            } else {
                $AirItinerary_arr = $PricedItinerary_arr['AirItinerary'];

                $AirItinerary_xml = $this->array_2_xml->createXML('ns1:AirItinerary', $AirItinerary_arr);
                $AirItinerary_node = str_replace('<?xml version="1.0" encoding="UTF-8"?>', '', $AirItinerary_xml->saveXML());
                $AirItinerary_node = str_replace('ns1:', '', $AirItinerary_node);
                $AirItinerary_node = str_replace('<FormData></FormData>', '<FormData/>', $AirItinerary_node);
                $AirItinerary_node = str_replace('<FormData>', '<FormData>' . $cabinClass, $AirItinerary_node);

                preg_match("/<session>(.*)<\/session>/", $AirItinerary_node, $session_tag_matches);
                if (!empty($session_tag_matches)) {
                    $AirItinerary_node = str_replace('<FormData>' . $cabinClass, '<FormData>', $AirItinerary_node);
                    $AirItinerary_node = str_replace('</session>', '</session>' . $cabinClass, $AirItinerary_node);
                }
                //echo "<pre/>";print_r($AirItinerary_node);exit;

                $PricingInfo_arr = $PricedItinerary_arr['AirItineraryPricingInfo'];
                $PricingInfo_xml = $this->array_2_xml->createXML('ns1:PriceInfo', $PricingInfo_arr);
                $PricingInfo_node = str_replace('<?xml version="1.0" encoding="UTF-8"?>', '', $PricingInfo_xml->saveXML());
                $PricingInfo_node = str_replace('ns1:', '', $PricingInfo_node);
                //echo "<pre/>";print_r($PricingInfo_node);exit;
            }

            $IntAirBookRS = $this->IntAirBookRQ($AirItinerary_node, $PricingInfo_node, $totalAmount);

            $IntAirBookRS = str_replace("<ns1:FormData>" . $cabinClass, '<ns1:FormData>', $IntAirBookRS);

            preg_match("/<session>(.*)<\/session>/", $IntAirBookRS, $session_tag_matches);
            if (!empty($session_tag_matches)) {
                $IntAirBookRS = str_replace('</session>' . $cabinClass, '</session>', $IntAirBookRS);
            }
           // echo "<pre/>";print_r($IntAirBookRS);exit;

            $IntAirBookRS_arr = $this->xml_2_array->createArray($IntAirBookRS);
            //echo "<pre/>";print_r($IntAirBookRS_arr);exit;
            //$_SESSION['AirBookRS_arr'] = $AirBookRS_arr;
            $this->session->set_userdata('IntAirBookRS_arr', $IntAirBookRS_arr);

            $OTA_AirBookRS_arr = $IntAirBookRS_arr['soapenv:Envelope']['soapenv:Body']['ns1:OTA_ItineraryBookRS']['oj:OTA_AirBookRS'];

            $flyNStayRefNo = $this->generateReferenceNo(8);

            if ($OTA_AirBookRS_arr != '') {
                $AirReservation_arr = $OTA_AirBookRS_arr['ns1:AirReservation'];

                if (isset($AirReservation_arr[0])) {
                    if (isset($AirReservation_arr[0]['@attributes']['BookingReferenceID']) && $AirReservation_arr[0]['@attributes']['BookingReferenceID'] != '') {
                        $OnwardBookingRefId = $AirReservation_arr[0]['@attributes']['BookingReferenceID'];
                        $ReturnBookingRefId = $AirReservation_arr[1]['@attributes']['BookingReferenceID'];

                        $OTA_AirBookRS_xml = $this->array_2_xml->createXML('ns1:OTA_AirBookRS', $OTA_AirBookRS_arr);
                        $IntAirBookRS_node = str_replace('<?xml version="1.0" encoding="UTF-8"?>', '', $OTA_AirBookRS_xml->saveXML());
                        $IntAirBookRS_node = str_replace('ns1:', '', $IntAirBookRS_node);
                        $IntAirBookRS_node = str_replace('<FormData></FormData>', '<FormData/>', $IntAirBookRS_node);
                        $IntAirBookRS_node = str_replace('<FormData>', '<FormData>' . $cabinClass, $IntAirBookRS_node);

                        preg_match("/<session>(.*)<\/session>/", $IntAirBookRS_node, $session_tag_matches);
                        if (!empty($session_tag_matches)) {
                            $IntAirBookRS_node = str_replace('<FormData>' . $cabinClass, '<FormData>', $IntAirBookRS_node);
                            $IntAirBookRS_node = str_replace('</session>', '</session>' . $cabinClass, $IntAirBookRS_node);
                        }
                        //echo "<pre/>";print_r($IntAirBookRS_node);exit;		
						$airCode = explode(',',$MarketingAirline_Code);						
					if($airCode[0] != 'SG' && $airCode[0] != 'I9' && $airCode[0] != 'G8') {
						
                        $IntAirTicketRS = $this->IntAirTicketRQ($IntAirBookRS_node);
                        $IntAirTicketRS = str_replace('ns1:', '', $IntAirTicketRS);
                        $IntAirTicketRS = str_replace("<FormData>" . $cabinClass, '<FormData>', $IntAirTicketRS);

                        preg_match("/<session>(.*)<\/session>/", $IntAirTicketRS, $session_tag_matches);
                        if (!empty($session_tag_matches)) {
                            $IntAirTicketRS = str_replace('</session>' . $cabinClass, '</session>', $IntAirTicketRS);
                        }
                        //echo "<pre/>";print_r($IntAirTicketRS);exit;	
                        $IntAirTicketRS_arr = $this->xml_2_array->createArray($IntAirTicketRS);
                        //echo "<pre/>";print_r($IntAirTicketRS_arr);exit;	
						
						$YT_AirTicketRS = $IntAirTicketRS_arr['soapenv:Envelope']['soapenv:Body']['YT_AirTicketRS']['OTA_AirBookRS'];
						
					}
					else
					{
						$YT_AirTicketRS = '';
					}

                        if ($YT_AirTicketRS != '') {
                            $book_status = 'SUCCESSTKD';
                            $Ticketing = $YT_AirTicketRS['AirReservation']['Ticketing'];
                            if (isset($Ticketing[0])) {
                                for ($n = 0; $n < count($Ticketing); $n++) {
                                    $Ticket_Number_arr[$n] = $Ticketing[$n]['@value'];
                                }

                                $Ticket_Number = implode(',', $Ticket_Number_arr);
                            } else {
                                $Ticket_Number = $Ticketing['@value'];
                            }
                        } else {
                            $book_status = 'SUCCESS';
                            $Ticket_Number = 'Nil';
                        }

                        $booking_id = $this->Flight_Model->flight_booking_reports($user_id, $flyNStayRefNo, $OnwardBookingRefId, $Ticket_Number, $api_name, $SequenceNumber, $Origin, $Destination, $Adults, $Childs, $Infants, $ArrivalDateTime, $DepartureDateTime, $FlightNumber, $FareType, $ResBookDesigCode, $Departure_AirPortName, $Departure_CityName, $Departure_LocationCode, $Departure_Terminal, $Arrival_AirPortName, $Arrival_CityName, $Arrival_LocationCode, $Arrival_Terminal, $AirEquipType, $MarketingAirline_Code, $MarketingAirline_Name, $Stops, $BaseFare, $CurrencyCode, $Tax_Amount, $TaxCode, $TotalFare, $ServiceTax, $Fee_Amount, $PassengerType, $PassengerQuantity, $PassengerBaseFare, $PassengerTax_Amount, $PassengerTax_Code, $PassengerTotalFare, $PassengerServiceTax, $Payment_Charge, $Admin_Markup, 'S', $book_status, 2);

                        $booking_id_r = $this->Flight_Model->flight_booking_reports($user_id, $flyNStayRefNo, $ReturnBookingRefId, $Ticket_Number, $api_name, $SequenceNumber_r, $Origin_r, $Destination_r, $Adults_r, $Childs_r, $Infants_r, $ArrivalDateTime_r, $DepartureDateTime_r, $FlightNumber_r, $FareType_r, $ResBookDesigCode_r, $Departure_AirPortName_r, $Departure_CityName_r, $Departure_LocationCode_r, $Departure_Terminal_r, $Arrival_AirPortName_r, $Arrival_CityName_r, $Arrival_LocationCode_r, $Arrival_Terminal_r, $AirEquipType_r, $MarketingAirline_Code_r, $MarketingAirline_Name_r, $Stops_r, $BaseFare_r, $CurrencyCode_r, $Tax_Amount_r, $TaxCode_r, $TotalFare_r, $ServiceTax_r, $Fee_Amount_r, $PassengerType_r, $PassengerQuantity_r, $PassengerBaseFare_r, $PassengerTax_Amount_r, $PassengerTax_Code_r, $PassengerTotalFare_r, $PassengerServiceTax_r, $Payment_Charge_r, $Admin_Markup_r, $Trip_Type_r, $book_status, 2);

                        redirect('flight/flight_int_eticket/' . $OnwardBookingRefId . '/' . $flyNStayRefNo . '/' . $ReturnBookingRefId, 'refresh');
                    } else {
                        $book_status = 'FAIL';
                        $OnwardBookingRefId = 'Nil';
                        $ReturnBookingRefId = 'Nil';
                        $Ticket_Number = 'Nil';
                        $booking_id = $this->Flight_Model->flight_booking_reports($user_id, $flyNStayRefNo, $OnwardBookingRefId, $Ticket_Number, $api_name, $SequenceNumber, $Origin, $Destination, $Adults, $Childs, $Infants, $ArrivalDateTime, $DepartureDateTime, $FlightNumber, $FareType, $ResBookDesigCode, $Departure_AirPortName, $Departure_CityName, $Departure_LocationCode, $Departure_Terminal, $Arrival_AirPortName, $Arrival_CityName, $Arrival_LocationCode, $Arrival_Terminal, $AirEquipType, $MarketingAirline_Code, $MarketingAirline_Name, $Stops, $BaseFare, $CurrencyCode, $Tax_Amount, $TaxCode, $TotalFare, $ServiceTax, $Fee_Amount, $PassengerType, $PassengerQuantity, $PassengerBaseFare, $PassengerTax_Amount, $PassengerTax_Code, $PassengerTotalFare, $PassengerServiceTax, $Payment_Charge, $Admin_Markup, 'S', $book_status, 2);

                        $booking_id_r = $this->Flight_Model->flight_booking_reports($user_id, $flyNStayRefNo, $ReturnBookingRefId, $Ticket_Number, $api_name, $SequenceNumber_r, $Origin_r, $Destination_r, $Adults_r, $Childs_r, $Infants_r, $ArrivalDateTime_r, $DepartureDateTime_r, $FlightNumber_r, $FareType_r, $ResBookDesigCode_r, $Departure_AirPortName_r, $Departure_CityName_r, $Departure_LocationCode_r, $Departure_Terminal_r, $Arrival_AirPortName_r, $Arrival_CityName_r, $Arrival_LocationCode_r, $Arrival_Terminal_r, $AirEquipType_r, $MarketingAirline_Code_r, $MarketingAirline_Name_r, $Stops_r, $BaseFare_r, $CurrencyCode_r, $Tax_Amount_r, $TaxCode_r, $TotalFare_r, $ServiceTax_r, $Fee_Amount_r, $PassengerType_r, $PassengerQuantity_r, $PassengerBaseFare_r, $PassengerTax_Amount_r, $PassengerTax_Code_r, $PassengerTotalFare_r, $PassengerServiceTax_r, $Payment_Charge_r, $Admin_Markup_r, $Trip_Type_r, $book_status, 2);


                        //redirect('flight/int_search_progress', 'refresh');
						$this->load->view('b2c/flight/error_page');
						
                    }
                } else {
                    if (isset($AirReservation_arr['@attributes']['BookingReferenceID']) && $AirReservation_arr['@attributes']['BookingReferenceID'] != '') {
                        $OnwardBookingRefId = $AirReservation_arr['@attributes']['BookingReferenceID'];

                        $OTA_AirBookRS_xml = $this->array_2_xml->createXML('ns1:OTA_AirBookRS', $OTA_AirBookRS_arr);
                        $IntAirBookRS_node = str_replace('<?xml version="1.0" encoding="UTF-8"?>', '', $OTA_AirBookRS_xml->saveXML());
                        $IntAirBookRS_node = str_replace('ns1:', '', $IntAirBookRS_node);
                        $IntAirBookRS_node = str_replace('<FormData></FormData>', '<FormData/>', $IntAirBookRS_node);
                        $IntAirBookRS_node = str_replace('<FormData>', '<FormData>' . $cabinClass, $IntAirBookRS_node);

                        preg_match("/<session>(.*)<\/session>/", $IntAirBookRS_node, $session_tag_matches);
                        if (!empty($session_tag_matches)) {
                            $IntAirBookRS_node = str_replace('<FormData>' . $cabinClass, '<FormData>', $IntAirBookRS_node);
                            $IntAirBookRS_node = str_replace('</session>', '</session>' . $cabinClass, $IntAirBookRS_node);
                        }

                        //echo "<pre/>";print_r($IntAirBookRS_node);exit;	
						
						$airCode = explode(',',$MarketingAirline_Code);						
					if($airCode[0] != 'SG' && $airCode[0] != 'I9' && $airCode[0] != 'G8') {

                        $IntAirTicketRS = $this->IntAirTicketRQ($IntAirBookRS_node);
                        $IntAirTicketRS = str_replace('ns1:', '', $IntAirTicketRS);
                        $IntAirTicketRS = str_replace("<FormData>" . $cabinClass, '<FormData>', $IntAirTicketRS);

                        preg_match("/<session>(.*)<\/session>/", $IntAirTicketRS, $session_tag_matches);
                        if (!empty($session_tag_matches)) {
                            $IntAirTicketRS = str_replace('</session>' . $cabinClass, '</session>', $IntAirTicketRS);
                        }
                        //echo "<pre/>";print_r($IntAirTicketRS);exit;	
                        $IntAirTicketRS_arr = $this->xml_2_array->createArray($IntAirTicketRS);
                        //echo "<pre/>";print_r($IntAirTicketRS_arr);exit;	

                        $YT_AirTicketRS = $IntAirTicketRS_arr['soapenv:Envelope']['soapenv:Body']['YT_AirTicketRS']['OTA_AirBookRS'];
					}
					else
					{
						$YT_AirTicketRS = '';
					}

                        if ($YT_AirTicketRS != '') {
                            $book_status = 'SUCCESSTKD';
                            $Ticketing = $YT_AirTicketRS['AirReservation']['Ticketing'];
                            if (isset($Ticketing[0])) {
                                for ($n = 0; $n < count($Ticketing); $n++) {
                                    $Ticket_Number_arr[$n] = $Ticketing[$n]['@value'];
                                }

                                $Ticket_Number = implode(',', $Ticket_Number_arr);
                            } else {
                                $Ticket_Number = $Ticketing['@value'];
                            }
                        } else {
                            $book_status = 'SUCCESS';
                            $Ticket_Number = 'Nil';
                        }

                        $booking_id = $this->Flight_Model->flight_booking_reports($user_id, $flyNStayRefNo, $OnwardBookingRefId, $Ticket_Number, $api_name, $SequenceNumber, $Origin, $Destination, $Adults, $Childs, $Infants, $ArrivalDateTime, $DepartureDateTime, $FlightNumber, $FareType, $ResBookDesigCode, $Departure_AirPortName, $Departure_CityName, $Departure_LocationCode, $Departure_Terminal, $Arrival_AirPortName, $Arrival_CityName, $Arrival_LocationCode, $Arrival_Terminal, $AirEquipType, $MarketingAirline_Code, $MarketingAirline_Name, $Stops, $BaseFare, $CurrencyCode, $Tax_Amount, $TaxCode, $TotalFare, $ServiceTax, $Fee_Amount, $PassengerType, $PassengerQuantity, $PassengerBaseFare, $PassengerTax_Amount, $PassengerTax_Code, $PassengerTotalFare, $PassengerServiceTax, $Payment_Charge, $Admin_Markup, $Trip_Type, $book_status, 2);

                        redirect('flight/flight_int_eticket/' . $OnwardBookingRefId . '/' . $flyNStayRefNo, 'refresh');
						
                    } else {
                        $book_status = 'FAIL';
                        $OnwardBookingRefId = 'Nil';
                        $Ticket_Number = 'Nil';
                        $booking_id = $this->Flight_Model->flight_booking_reports($user_id, $flyNStayRefNo, $OnwardBookingRefId, $Ticket_Number, $api_name, $SequenceNumber, $Origin, $Destination, $Adults, $Childs, $Infants, $ArrivalDateTime, $DepartureDateTime, $FlightNumber, $FareType, $ResBookDesigCode, $Departure_AirPortName, $Departure_CityName, $Departure_LocationCode, $Departure_Terminal, $Arrival_AirPortName, $Arrival_CityName, $Arrival_LocationCode, $Arrival_Terminal, $AirEquipType, $MarketingAirline_Code, $MarketingAirline_Name, $Stops, $BaseFare, $CurrencyCode, $Tax_Amount, $TaxCode, $TotalFare, $ServiceTax, $Fee_Amount, $PassengerType, $PassengerQuantity, $PassengerBaseFare, $PassengerTax_Amount, $PassengerTax_Code, $PassengerTotalFare, $PassengerServiceTax, $Payment_Charge, $Admin_Markup, $Trip_Type, $book_status, 2);

						//redirect('flight/int_search_progress', 'refresh');
                        $this->load->view('b2c/flight/error_page');
                    }
                }
            } else {
                $book_status = 'FAIL';
                $OnwardBookingRefId = 'Nil';
                $Ticket_Number = 'Nil';
                $booking_id = $this->Flight_Model->flight_booking_reports($user_id, $flyNStayRefNo, $OnwardBookingRefId, $Ticket_Number, $api_name, $SequenceNumber, $Origin, $Destination, $Adults, $Childs, $Infants, $ArrivalDateTime, $DepartureDateTime, $FlightNumber, $FareType, $ResBookDesigCode, $Departure_AirPortName, $Departure_CityName, $Departure_LocationCode, $Departure_Terminal, $Arrival_AirPortName, $Arrival_CityName, $Arrival_LocationCode, $Arrival_Terminal, $AirEquipType, $MarketingAirline_Code, $MarketingAirline_Name, $Stops, $BaseFare, $CurrencyCode, $Tax_Amount, $TaxCode, $TotalFare, $ServiceTax, $Fee_Amount, $PassengerType, $PassengerQuantity, $PassengerBaseFare, $PassengerTax_Amount, $PassengerTax_Code, $PassengerTotalFare, $PassengerServiceTax, $Payment_Charge, $Admin_Markup, $Trip_Type, $book_status, 2);

                //redirect('flight/int_search_progress', 'refresh');
				$this->load->view('b2c/flight/error_page');
            }
        } else {
            //redirect('flight/int_search_progress', 'refresh');
			$this->load->view('b2c/flight/error_page');
        }
    }

    //AirBookRQ starts here	
    function IntAirBookRQ($AirItinerary_node, $PricingInfo_node, $totalAmount) {
        //echo "<pre/>";print_r($_SESSION);exit;
        $user_booking_info = $this->session->userdata('user_booking_info');
        $atitle = $user_booking_info['atitle'];
        $afname = $user_booking_info['afname'];
        $amname = $user_booking_info['amname'];
        $alname = $user_booking_info['alname'];

        $AccompaniedByInfant = 'AccompaniedByInfant="false"';
        if (isset($user_booking_info['cfname']) && $user_booking_info['cfname'] != '') {
            $ctitle = $user_booking_info['ctitle'];
            $cfname = $user_booking_info['cfname'];
            $cmname = $user_booking_info['cmname'];
            $clname = $user_booking_info['clname'];

            $cdobDate = $user_booking_info['cdobDate'];
            $cdobMonth = $user_booking_info['cdobMonth'];
            $cdobYear = $user_booking_info['cdobYear'];
        }

        if (isset($user_booking_info['ifname']) && $user_booking_info['ifname'] != '') {
            $ititle = $user_booking_info['ititle'];
            $ifname = $user_booking_info['ifname'];
            $imname = $user_booking_info['imname'];
            $ilname = $user_booking_info['ilname'];

            $idobDate = $user_booking_info['idobDate'];
            $idobMonth = $user_booking_info['idobMonth'];
            $idobYear = $user_booking_info['idobYear'];

            $AccompaniedByInfant = 'AccompaniedByInfant="true"';
        }

        $userName = $user_booking_info['userName'];
        if ($userName == '') {
            $userEmailId = $user_booking_info['userEmailId'];
            $userMobilNo = $user_booking_info['userMobilNo'];
        } else {
            $userEmailId = $user_booking_info['email_id'];
            $userMobilNo = $user_booking_info['mobile_no'];
        }

        $adult_info = '';
        for ($i = 0; $i < count($afname); $i++) {
            $adult_info .='<AirTraveler '.$AccompaniedByInfant.' BirthDate="" PassengerTypeCode="ADT">
						<PersonName>
							<NamePrefix>' . $atitle[$i] . '</NamePrefix>
							<GivenName>' . $afname[$i] . '</GivenName>
							<Surname>' . $alname[$i] . '</Surname>
							<NameTitle/>
						</PersonName>
						<Telephone AreaCityCode="" CountryAccessCode="91" DefaultInd="false" FormattedInd="false" MobileNumber="' . $userMobilNo . '"/>
						<Email DefaultInd="false" EmailType="1">' . $userEmailId . '</Email>
						<Address FormattedInd="false">
							<AddressLine>dummy,</AddressLine>
							<AddressLine>DEL</AddressLine>
							<PostalCode>110001</PostalCode>
							<StateProv StateCode="DL"/>
						</Address>
						<ProofRequests>
							<ProofRequest CompanyID="" ProofType="PP" ProofNumber=""></ProofRequest>
						</ProofRequests>
						<TravelerRefNumber RPH="1"/>
					</AirTraveler>';
        }

        $child_info = '';
        if (isset($user_booking_info['cfname']) && $user_booking_info['cfname'] != '') {
            for ($i = 0; $i < count($cfname); $i++) {
                $cdob = $cdobYear[$i] . '-' . $cdobMonth[$i] . '-' . $cdobDate[$i];
                $child_info .='<AirTraveler AccompaniedByInfant="false" BirthDate="' . $cdob . '" PassengerTypeCode="CHD">
							<PersonName>
								<NamePrefix>' . $ctitle[$i] . '</NamePrefix>
								<GivenName>' . $cfname[$i] . '</GivenName>
								<Surname>' . $clname[$i] . '</Surname>
								<NameTitle/>
							</PersonName>
							<Telephone AreaCityCode="" CountryAccessCode="91" DefaultInd="false" FormattedInd="false" MobileNumber="' . $userMobilNo . '"/>
							<Email DefaultInd="false" EmailType="1">' . $userEmailId . '</Email>
							<Address FormattedInd="false">
								<AddressLine>dummy,</AddressLine>
								<AddressLine>DEL</AddressLine>
								<PostalCode>110001</PostalCode>
								<StateProv StateCode="DL"/>
							</Address>
							<ProofRequests>
								<ProofRequest CompanyID="" ProofType="PP" ProofNumber=""></ProofRequest>
							</ProofRequests>
							<TravelerRefNumber RPH="2"/>
						</AirTraveler>';
            }
        }

        $infant_info = '';
        if (isset($user_booking_info['ifname']) && $user_booking_info['ifname'] != '') {
            for ($i = 0; $i < count($cfname); $i++) {
                $idob = $idobYear[$i] . '-' . $idobMonth[$i] . '-' . $idobDate[$i];
                $infant_info .='<AirTraveler AccompaniedByInfant="false" BirthDate="' . $idob . '" PassengerTypeCode="INF">
							<PersonName>
								<NamePrefix>' . $ititle[$i] . '</NamePrefix>
								<GivenName>' . $ifname[$i] . '</GivenName>
								<Surname>' . $ilname[$i] . '</Surname>
								<NameTitle/>
							</PersonName>
							<Telephone AreaCityCode="" CountryAccessCode="91" DefaultInd="false" FormattedInd="false" MobileNumber="' . $userMobilNo . '"/>
							<Email DefaultInd="false" EmailType="1">' . $userEmailId . '</Email>
							<Address FormattedInd="false">
								<AddressLine>dummy,</AddressLine>
								<AddressLine>DEL</AddressLine>
								<PostalCode>110001</PostalCode>
								<StateProv StateCode="DL"/>
							</Address>
							<ProofRequests>
								<ProofRequest CompanyID="" ProofType="PP" ProofNumber=""></ProofRequest>
							</ProofRequests>
							<TravelerRefNumber RPH="3"/>
						</AirTraveler>';
            }
        }

        $tranId = $this->generateReferenceNo(6);

        $this->xml = '<?xml version="1.0" encoding="UTF-8"?>
		<soap:Envelope xmlns="http://www.opentravel.org/OTA/2003/05" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:wsse="http://schemas.xmlsoap.org/ws/2002/12/secext">
			<soap:Body>				
					<OTA_ItineraryBookRQ xmlns="http://www.opentravel.org/OTA/2003/05">
						<POS xmlns="http://www.opentravel.org/OTA/2003/05">
							<Source AgentSine="" PseudoCityCode="NPCK" TerminalID="1">
								<RequestorID ID="AFFILIATE"></RequestorID>
							</Source>
							<YatraRequests>
								<YatraRequest YatraRequestTypeCode="SMPA" Description="" MidOfficeAgentID="' . $this->MidOfficeAgentID . '" AffiliateID="YTFABTRAVEL" Destination="INT"/>
							</YatraRequests>
						</POS>
					<OJ_PaymentRQ xmlns="http://www.openjawtech.com/2005" RetransmissionIndicator="false" SequenceNmbr="1" TransactionIdentifier="' . $tranId . '" TransactionStatusCode="A" Version="0.0" productID="QQKXQQS87YQQ" type="payment">
						<PaymentDetails>
							<PaymentDetail GuaranteeIndicator="false">
								<PaymentCard CardCode="NA" CardNumber="NA" CardType="NA" EffectiveDate="NA" ExpireDate="NA" ExtendPaymentIndicator="false" ExtendedPaymentQuantity="0" SeriesCode="NA" SignatureOnFileIndicator="false">
									<CardHolderName FirstName="' . $afname[0] . '" MiddleName="' . $alname[0] . '">' . $afname[0] . ' ' . $alname[0] . '</CardHolderName>
									<CardNumber>NA</CardNumber>
									<CardIssuerName BankID="19389"/>
									<CardHolderTelephone PhoneTechType="1"/>
									<Phone MobileNumber="'.$userMobilNo.'" Number="'.$userMobilNo.'"/>
									 <Email>'.$userEmailId.'</Email>
									 <Location>
										 <IPAddress>'.$this->get_client_ip().'</IPAddress>
									</Location>
								</PaymentCard>
								<PaymentAmount Amount="' . $totalAmount . '" CurrencyCode="INR" DecimalPlaces="0"/>
							</PaymentDetail>
						</PaymentDetails>
						<AuthDetails Cancelled="false" Fulfilled="true" PaymentMedium="CREDITPOOL"/>
					</OJ_PaymentRQ>
					<OTA_AirBookRQ TransactionIdentifier="' . $tranId . '" Version="0.0">
					' . $AirItinerary_node . '
					' . $PricingInfo_node . '					
						<TravelerInfo>
							' . $adult_info . '
							' . $child_info . '
							' . $infant_info . '
						</TravelerInfo>
						<Fulfillment/>
						<Ticketing CancelOnExpiryInd="false" ReverseTktgSegmentsInd="false" TicketType="eTicket" TimeLimitMinutes="0"/>
					</OTA_AirBookRQ>
				</OTA_ItineraryBookRQ>
			</soap:Body>
		</soap:Envelope>';

        //echo $this->xml;

        $IntAirBookRS = $this->PostRQ($this->xml);
		//echo '<pre/>';print_r($IntAirBookRS);exit;
        return $IntAirBookRS;
    }

    //IntAirBookRQ ends here
    //IntAirTicket Request Starts here
    function IntAirTicketRQ($IntAirBookRS_node) {
        $this->xml = '<?xml version="1.0" encoding="UTF-8"?>
		<soap:Envelope xmlns="http://www.opentravel.org/OTA/2003/05" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:wsse="http://schemas.xmlsoap.org/ws/2002/12/secext">
			<soap:Body>
				<YT_AirTicketRQ>
					<POS>
					<Source ISOCurrency="INR" AgentSine="" PseudoCityCode="NPCK" TerminalID="1">
						<RequestorID ID="YATRA"/>
					</Source>
					<YatraRequests>
						<YatraRequest YatraRequestTypeCode="SMPA" MidOfficeAgentID="' . $this->MidOfficeAgentID . '" Destination="Int"/>
					</YatraRequests>
					</POS>				
					' . $IntAirBookRS_node . '
			 </YT_AirTicketRQ>
			</soap:Body>
		</soap:Envelope>';

        //echo $this->xml;

        $IntAirTicketRS = $this->PostRQ($this->xml);

        return $IntAirTicketRS;
    }

    //IntAirTicket Request Ends here

    function flight_int_eticket($onward_booking_ref_id, $flynstay_ref_id, $return_booking_ref_id = '') {
        $booking_info = $this->Flight_Model->get_flight_booking_info($onward_booking_ref_id);
        $data['booking_info'] = $booking_info[0];
        $passenger_info = $this->Flight_Model->get_passenger_info($onward_booking_ref_id);
        $data['passenger_info'] = $passenger_info;

        if ($return_booking_ref_id != '') {
            $booking_info_return = $this->Flight_Model->get_flight_booking_info($return_booking_ref_id);
            $data['booking_info_return'] = $booking_info_return[0];
            $passenger_info_return = $this->Flight_Model->get_passenger_info($return_booking_ref_id);
            $data['passenger_info_return'] = $passenger_info_return;
        }

        //echo '<pre/>';print_r($data);exit;		
        $this->load->view('b2c/flight/flight_int_eticket', $data);
    }

    // Post XML Request to Yatra server Starts Here 	
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


        /* $curlresp = '';

          if($curlresp == '')
          {
          $curlresp = file_get_contents(WEB_DIR."public/API_SampleXML_INT/IntAirLowFareSearchRS-OneWay.xml");

          } */
        return $curlresp;
    }

    // Post XML Request to Yatra server Ends Here 
    // Get Airport Code  Starts Here
    function get_airport_code($city) {
        preg_match_all('/\(([A-Za-z ]+?)\)/', $city, $out);
        $airportCode = $out[1];

        return $airportCode[0];
    }

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

    function airport_code_validation($city) {
        $this->form_validation->set_message('airport_code_validation', 'Invalid Airport Code');

        preg_match_all('/\(([A-Za-z ]+?)\)/', $city, $out);
        $airportCode = $out[1];

        if (!empty($airportCode))
            return TRUE;
        else
            return FALSE;
    }

    // Codeigniter Validation Rules Ends here
    // Rate Matrix

    function rateMatrix($way) {
        $flight_details = $this->Flight_Model->getRateMatrixResluts($this->sess_id, $way);
        //echo '<pre/>';print_r($flight_details);exit;
        for ($i = 0; $i < count($flight_details); $i++) {
            $price[] = $flight_details[$i]->TotalFare + $flight_details[$i]->Admin_Markup + $flight_details[$i]->Payment_Charge;
            $DepDateTime = explode(',', $flight_details[$i]->DepartureDateTime);
            list($DepartureDate, $DepartureTime) = explode("T", $DepDateTime[0]);
            list($h, $m, $s) = explode(":", $DepartureTime);
            $time[] = ($h * 60) + $m;
            $Airline_Code = explode(',', $flight_details[$i]->MarketingAirline_Code);
            $Airline_Name = explode(',', $flight_details[$i]->MarketingAirline_Name);
            $flights[] = $Airline_Code[0];
            $totalFlights[$Airline_Code[0]] = $Airline_Name[0];
        }

        $return['price'] = $price;
        $return['time'] = $time;
        $return['flights'] = $flights;
        $return['fnames'] = $totalFlights;

        //echo '<pre/>';print_r($flights);exit;

        $matrix = $this->load->view('b2c/flight/rateMatrix', $return, true);
        echo json_encode(array(
            'matrix' => $matrix
        ));
    }

    function generateReferenceNo($len, $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789') {
        $string = '';
        for ($i = 0; $i < $len; $i++) {
            $pos = rand(0, strlen($chars) - 1);
            $string .= $chars{$pos};
        }
        return $string;
    }
	
	function get_client_ip() 
	{
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {   //check ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {   //to check ip is pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    } 

}

