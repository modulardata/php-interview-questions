<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Flight_Model extends CI_Model {

    function __construct()
    {
		// Call the Model constructor
        parent::__construct();
		
    }
	
	function insert_flight_temp_results($idval,$sess_id,$api_name,$SequenceNumber,$UniqueIdentifier,$OriginDestinationRPH,$FlightID,$SupplierSystem,$originCode,$destinationCode,$adults,$childs,$infants,$Total_Duration,$ArrivalDateTime,$DepartureDateTime,$Duration,$FlightNumber,$SeatToSell,$FareType,$ResBookDesigCode,$Departure_AirPortName,$Departure_CityName,$Departure_LocationCode,$Departure_Terminal,$Arrival_AirPortName,$Arrival_CityName,$Arrival_LocationCode,$Arrival_Terminal,$AirEquipType,$MarketingAirline_Code,$MarketingAirline_Name,$Stops,$BaseFare,$CurrencyCode,$Tax_Amount,$TaxCode,$TaxDescription,$TotalFare,$ServiceTax,$Fee_Amount,$FeeCode,$PassengerType,$PassengerQuantity,$PassengerBaseFare,$PassengerTax_Amount,$PassengerTaxCode,$PassengerTaxDescription,$PassengerTotalFare,$PassengerServiceTax,$Trip_Type,$Service_Type)
	{
		
		$this->db->select('airport_country');
        $this->db->from('airport_list');
        $this->db->where('airport_code', $originCode);
		$this->db->where('airport_type', $Service_Type);
		$this->db->where('status', 1);		
        $this->db->limit('1');
        $query = $this->db->get();
		
		$res = $query->row();
		$origin_country = $res->airport_country;
		
		$this->db->select('markup');
        $this->db->from('b2c_markup_info');     
		$this->db->where('markup_type', 'specific');
		$this->db->where('country', $origin_country);
		$this->db->where('service_type', 2);
		$this->db->where('api_name', 'yatra');
		$this->db->where('status', 1);
        $this->db->limit('1');
        $query1 = $this->db->get();
      
        if($query1->num_rows > 0) 
		{
			$res1 = $query1->row();   
            $admin_markup_val = $res1->markup;            
        }
		else
		{
			$this->db->select('markup');
			$this->db->from('b2c_markup_info');			
			$this->db->where('markup_type', 'generic');	
			$this->db->where('service_type', 2);		
			$this->db->where('api_name', 'yatra');
			$this->db->where('status', 1);
			$this->db->limit('1');
			$query2 = $this->db->get();
			
			if($query2->num_rows > 0) 
			{
				$res2 = $query2->row();   
            	$admin_markup_val = $res2->markup;            
        	}
			else
			{
				$admin_markup_val = 0;
			}
			
		}
		
		$this->db->select('charge');
		$this->db->from('payment_gateway');		
		$this->db->where('service_type', 2);	
		$this->db->where('status', 1);
		$this->db->limit('1');
		$query3 = $this->db->get();
		
		if($query3->num_rows > 0) 
		{
			$res3 = $query3->row();   
			$payment_charge_val = $res3->charge;            
		}
		else
		{
			$payment_charge_val = 0;
		}
		
		$admin_markup = round(($TotalFare * ($admin_markup_val / 100)),2);
		$payment_charge = round((($TotalFare + $admin_markup) * ($payment_charge_val / 100)),2);
		
		$data = array('id_val' => $idval, 
					  'session_id' => $sess_id, 
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
					  'Service_Type' => $Service_Type,
					  'Admin_Markup' => $admin_markup,
					  'Payment_Charge' => $payment_charge
					  );

        $this->db->insert('flight_search_result_info', $data);
        //echo $this->db->last_query(); exit;
        return $this->db->insert_id();
		
	
	}
	
	function fetch_search_result($ses_id) 
	{
        $this->db->select('*');
        $this->db->from('flight_search_result_info');
        $this->db->where('session_id', $ses_id);
		$this->db->where('UniqueIdentifier', 1);
        $this->db->order_by('TotalFare', 'ASC');
        $query = $this->db->get();
      
        if($query->num_rows > 0) 
		{
            return $query->result();            
        }
		else
		{
			return '';
		}
		
    }
	
	function fetch_search_result_oneway($ses_id) 
	{
        $this->db->select('*');
        $this->db->from('flight_search_result_info');
        $this->db->where('session_id', $ses_id);
		$this->db->where('SequenceNumber', 1);
		$this->db->where('UniqueIdentifier', 1);		 	 	
        $this->db->order_by('TotalFare', 'ASC');
        $query = $this->db->get();
      
        if($query->num_rows > 0) 
		{
            return $query->result();            
        }
		else
		{
			return '';
		}
		
    }
	
	function fetch_search_result_round($ses_id) 
	{
        $this->db->select('*');
        $this->db->from('flight_search_result_info');
        $this->db->where('session_id', $ses_id);
		$this->db->where('SequenceNumber', 2);
		$this->db->where('UniqueIdentifier', 2);		 	 	
        $this->db->order_by('TotalFare', 'ASC');
        $query = $this->db->get();
      
        if($query->num_rows > 0) 
		{
            return $query->result();            
        }
		else
		{
			return '';
		}
		
    }
	
	
	function delete_flight_temp_result($sess_id) 
	{
        $this->db->where('session_id', $sess_id);
        $this->db->delete('flight_search_result_info');
    }	
	
	function getDate_TimeFromDateTime($DateTime,$type)
	{		
		$DateTime_string = preg_replace("/[T]/", " ", $DateTime);
		list($Date, $Time) = explode(" ", $DateTime_string);
		
		if($type == 'date')
		{
			return $Date;
		}
		else if($type == 'time')
		{
			return date('h:i A', strtotime($Time));
			
		}
		else if($type == 'mins')
		{
			list($h, $m, $s) = explode(":", $Time);
    		return ($h * 60) + $m;
		}
	
		
	}
	
	function DurationTimeInMin($DurationTime)
	{
    	list($h, $m, $s) = explode(":", $DurationTime);
    	return ($h * 60) + $m;
	}
	
	function GetHoursAndMinutes($DurationTime)
	{
    	list($h, $m, $s) = explode(":", $DurationTime);
    	$mins = ($h * 60) + $m;
		return sprintf("%02dh %02dm", floor($mins/60), $mins%60);	
		
	}
	
	function journeyDuration($datetime1, $datetime2, $format = "regular")
	{
		$datesDiff = $this->datesDiff($datetime1, $datetime2);
	
		if ($format == "regular")
		{
			if ($datesDiff['days'] > 0)
				$res = $datesDiff['days'] . " day " . $datesDiff['hours'] . " hr " . $datesDiff['minuts'] . " min";
			else
				$res = $datesDiff['hours'] . " hr " . $datesDiff['minuts'] . " min";
		}
		else
			$res = ($datesDiff['days'] * 24 * 60) + ($datesDiff['hours'] * 60) + $datesDiff['minuts'];
			
		return $res;
		
	}
	
	function datesDiff($date1, $date2)
	{
    	$diff = abs(strtotime($date2) - strtotime($date1));
    	$years = floor($diff / (365 * 60 * 60 * 24));

    	$months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
    	$days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
    	$hours = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
    	$minuts = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
    	$seconds = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minuts * 60));
    return array("years" => $years, "months" => $months, "days" => $days, "hours" => $hours, "minuts" => $minuts, "seconds" => $seconds);
	
	}
	
	// Rate Matrix 
	
	function getRateMatrixResluts($ses_id,$way)
    {
		$this->db->select('*');
        $this->db->from('flight_search_result_info');
        $this->db->where('session_id', $ses_id);
        $this->db->where('UniqueIdentifier', $way);
        $query = $this->db->get();
      
        if($query->num_rows > 0) 
		{
            return $query->result();            
        }
		else
		{
			return '';
		}
    }
	
	function get_selected_flightdetails($flight_id) 
	{
        $this->db->select('*');
        $this->db->from('flight_search_result_info');
        $this->db->where('flight_t_id', $flight_id);
        $query = $this->db->get();
        if ($query->num_rows() == '') 
		{
            return '';
        } 
		else 
		{
            return $query->row();
        }
		
    }	
	
	function flight_booking_reports($user_id,$flyNStayRefNo,$BookingReferenceId,$Ticket_Number,$api_name,$SequenceNumber,$Origin,$Destination,$Adults,$Childs,$Infants,$ArrivalDateTime,$DepartureDateTime,$FlightNumber,$FareType,$ResBookDesigCode,$Departure_AirPortName,$Departure_CityName,$Departure_LocationCode,$Departure_Terminal,$Arrival_AirPortName,$Arrival_CityName,$Arrival_LocationCode,$Arrival_Terminal,$AirEquipType,$MarketingAirline_Code,$MarketingAirline_Name,$Stops,$BaseFare,$CurrencyCode,$Tax_Amount,$TaxCode,$TotalFare,$ServiceTax,$Fee_Amount,$PassengerType,$PassengerQuantity,$PassengerBaseFare,$PassengerTax_Amount,$PassengerTax_Code,$PassengerTotalFare,$PassengerServiceTax,$Payment_Charge,$Admin_Markup,$Trip_Type,$book_status,$Service_Type)
	{
		if($Trip_Type == 'S')
			$mode = 'Onward';
		else
			$mode = 'Return';
									
		$data = array('user_id' => $user_id,
					  'FlyNStayRefNo' => $flyNStayRefNo,
					  'BookingReferenceId' => $BookingReferenceId, 
					  'Ticket_Number' => $Ticket_Number,
					  'api' => $api_name, 
					  'SequenceNumber' => $SequenceNumber,					
					  'Origin' => $Origin, 
					  'Destination' => $Destination, 
					  'Adults' => $Adults, 
					  'Childs' => $Childs, 
					  'Infants' => $Infants, 
					  'booking_date' => date("Y-m-d"), 					
					  'ArrivalDateTime' => $ArrivalDateTime, 
					  'DepartureDateTime' => $DepartureDateTime,					
					  'FlightNumber' => $FlightNumber,					  
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
					  'TotalFare' => $TotalFare,
					  'ServiceTax' => $ServiceTax, 
					  'Fee_Amount' => $Fee_Amount,					 
					  'PassengerType' => $PassengerType, 
					  'PassengerQuantity' => $PassengerQuantity, 
					  'PassengerBaseFare' => $PassengerBaseFare,
					  'PassengerTax_Amount' => $PassengerTax_Amount,
					  'PassengerTax_Code' => $PassengerTax_Code,					  
					  'PassengerTotalFare' => $PassengerTotalFare,
					  'PassengerServiceTax' => $PassengerServiceTax,
					  'Payment_Charge' => $Payment_Charge,
					  'Admin_Markup' => $Admin_Markup,
					  'Trip_Type' => $Trip_Type,
					  'Service_Type' => $Service_Type,
					  'BookingStatus' => $book_status,
					  'mode' => $mode
					  );

        $this->db->insert('flight_booking_reports', $data);
        //echo $this->db->last_query(); exit;
        $booking_id = $this->db->insert_id();
		
		$user_booking_info = $this->session->userdata('user_booking_info');
		
		$userName = $user_booking_info['userName'];
		if($userName == '')
		{
			$userEmailId = $user_booking_info['userEmailId'];
			$userMobilNo = $user_booking_info['userMobilNo'];
		}
		else
		{
			$userEmailId = $user_booking_info['email_id'];
			$userMobilNo = $user_booking_info['mobile_no'];
		}
		
		$atitle = $user_booking_info['atitle'];
		$afname = $user_booking_info['afname'];
		$amname = $user_booking_info['amname'];
		$alname = $user_booking_info['alname'];
		
		for($i=0;$i< count($afname);$i++)
		{
			$adult_data = array('booking_id' => $booking_id,					  
					  'BookingReferenceId' => $BookingReferenceId,
					  'title' => $atitle[$i],
					  'first_name' => $afname[$i],
					  'middle_name' => $amname[$i], 
					  'last_name' => $alname[$i], 
					  'passenger_type' => 'ADT',
					  'mobile' => $userMobilNo,
					  'email' => $userEmailId					  
					  );
					  
			$this->db->insert('flight_booking_passengers', $adult_data);
			
		}
		
		if(array_key_exists('cfname',$user_booking_info) && !empty($user_booking_info['cfname']))
		{
			$ctitle = $user_booking_info['ctitle'];
			$cfname = $user_booking_info['cfname'];
			$cmname = $user_booking_info['cmname'];
			$clname = $user_booking_info['clname'];
			
			for($i=0;$i< count($cfname);$i++)
			{
				$child_data = array('booking_id' => $booking_id,						 
						  'BookingReferenceId' => $BookingReferenceId,
						  'title' => $ctitle[$i],
						  'first_name' => $cfname[$i],
						  'middle_name' => $cmname[$i], 
						  'last_name' => $clname[$i], 
						  'passenger_type' => 'CHD', 
						  'mobile' => $userMobilNo,
						  'email' => $userEmailId					  
						  );
						  
				$this->db->insert('flight_booking_passengers', $child_data);				
			}
		}
		
		if(array_key_exists('ifname',$user_booking_info) && !empty($user_booking_info['ifname']))
		{
			$ititle = $user_booking_info['ititle'];
			$ifname = $user_booking_info['ifname'];
			$imname = $user_booking_info['imname'];
			$ilname = $user_booking_info['ilname'];
			
			for($i=0;$i< count($cfname);$i++)
			{
				$infant_data = array('booking_id' => $booking_id,						  
						  'BookingReferenceId' => $BookingReferenceId,
						  'title' => $ititle[$i],
						  'first_name' => $ifname[$i],
						  'middle_name' => $imname[$i], 
						  'last_name' => $ilname[$i], 
						  'passenger_type' => 'INF', 
						  'mobile' => $userMobilNo,
						  'email' => $userEmailId					  
						  );
						  
				$this->db->insert('flight_booking_passengers', $infant_data);				
			}
		}
		
		return $booking_id;
		
	
	}
	
	function get_flight_booking_info($booking_ref_id) 
	{
        $this->db->select('*');
        $this->db->from('flight_booking_reports');
        $this->db->where('BookingReferenceId', $booking_ref_id);
        $query = $this->db->get();
        if ($query->num_rows() == '') 
		{
            return '';
        } 
		else 
		{
            return $query->result();
        }
		
    }	
	
	function get_passenger_info($booking_ref_id) 
	{
        $this->db->select('*');
        $this->db->from('flight_booking_passengers');
        $this->db->where('BookingReferenceId', $booking_ref_id);
        $query = $this->db->get();
        if ($query->num_rows() == '') 
		{
            return '';
        } 
		else 
		{
            return $query->result();
        }
		
    }
	
	function get_return_flight_result($OriginDestinationRPH)
	{
        $this->db->select('*');
        $this->db->from('flight_search_result_info');
		$this->db->where('UniqueIdentifier', 2);
        $this->db->where('OriginDestinationRPH', $OriginDestinationRPH);
        $query = $this->db->get();
        if ($query->num_rows() == '') 
		{
            return '';
        } 
		else 
		{
            return $query->row();
        }
		
    }
	

}
