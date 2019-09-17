<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bus_Model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function bus_search_result($sess_id, $triptype, $sourceId, $destinationId, $arrivalTime, $availableSeats, $busType, $busTypeId, $cancellationPolicy, $departureTime, $doj, $fares, $id, $idProofRequired, $nonAC, $operator, $partialCancellationAllowed, $routeId, $seater, $sleeper, $travels, $mTicketEnabled) {

        $data = array(
            'session_id' => $sess_id,
            'api' => 'redbus',
            'triptype' => $triptype,
            'from_city' => $sourceId,
            'to_city' => $destinationId,
            'arrival_time' => $arrivalTime,
            'available_seats' => $availableSeats,
            'bus_type' => $busType,
            'bus_type_id' => $busTypeId,
            'cancellation_policy' => $cancellationPolicy,
            'depart_time' => $departureTime,
            'doj' => $doj,
            'price' => $fares,
            'id' => $id,
            'idproofrequired' => $idProofRequired,
            'nonac' => $nonAC,
            'operator' => $operator,
            'partial_cacellation_allowed' => $partialCancellationAllowed,
            'route_id' => $routeId,
            'seeter' => $seater,
            'sleeper' => $sleeper,
            'travels' => $travels,
            'mticket_enabeld' => $mTicketEnabled,
        );


        $this->db->insert('bus_search_result_info', $data);
        //echo $this->db->last_query(); exit;
        return $this->db->insert_id();
    }

    function bus_boarding_point($sess_id, $insert_id, $bpId, $location, $prime, $time) {
        $data = array(
            'bus_search_result_info_id' => $insert_id,
            'session_id' => $sess_id,
            'boarding_point_id' => $bpId,
            'location' => $location,
            'prime' => $prime,
            'time' => $time,
        );
        $this->db->insert('bus_search_boarding_point', $data);
    }

    function bus_dropping_point($sess_id, $insert_id, $bpId, $location, $prime, $time) {
        $data = array(
            'bus_search_result_info_id' => $insert_id,
            'session_id' => $sess_id,
            'boarding_point_id' => $bpId,
            'location' => $location,
            'prime' => $prime,
            'time' => $time,
        );
        $this->db->insert('bus_search_drop_point', $data);
    }

    function fetch_search_result($ses_id, $triptype) {
        $this->db->select('*');
        $this->db->from('bus_search_result_info');
        $this->db->where('session_id', $ses_id);
        $this->db->where('triptype', $triptype);
        $this->db->order_by('price', 'ASC');
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return '';
        }
    }

    function delete_bus_temp_result($sess_id) {
        $this->db->where('session_id', $sess_id);
        $this->db->delete('bus_search_boarding_point');

        $this->db->where('session_id', $sess_id);
        $this->db->delete('bus_search_drop_point');

        $this->db->where('session_id', $sess_id);
        $this->db->delete('bus_search_result_info');
    }

    function getDate_TimeFromDateTime($DateTime, $type) {
        $DateTime_string = preg_replace("/[T]/", " ", $DateTime);
        list($Date, $Time) = explode(" ", $DateTime_string);

        if ($type == 'date') {
            return $Date;
        } else if ($type == 'time') {
            return date('h:i A', strtotime($Time));
        } else if ($type == 'mins') {
            list($h, $m, $s) = explode(":", $Time);
            return ($h * 60) + $m;
        }
    }

    function DurationTimeInMin($DurationTime) {
        list($h, $m, $s) = explode(":", $DurationTime);
        return ($h * 60) + $m;
    }

    function GetHoursAndMinutes($DurationTime) {
        list($h, $m, $s) = explode(":", $DurationTime);
        $mins = ($h * 60) + $m;
        return sprintf("%02dh %02dm", floor($mins / 60), $mins % 60);
    }

    function journeyDuration($datetime1, $datetime2, $format = "regular") {
        $datesDiff = $this->datesDiff($datetime1, $datetime2);

        if ($format == "regular") {
            if ($datesDiff['days'] > 0)
                $res = $datesDiff['days'] . " day " . $datesDiff['hours'] . " hr " . $datesDiff['minuts'] . " min";
            else
                $res = $datesDiff['hours'] . " hr " . $datesDiff['minuts'] . " min";
        }
        else
            $res = ($datesDiff['days'] * 24 * 60) + ($datesDiff['hours'] * 60) + $datesDiff['minuts'];

        return $res;
    }

    function datesDiff($date1, $date2) {
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


    function get_flight_booking_info($booking_ref_id) {
        $this->db->select('*');
        $this->db->from('flight_booking_reports');
        $this->db->where('BookingReferenceId', $booking_ref_id);
        $query = $this->db->get();
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->result();
        }
    }

    function getboarding($id) {
        $this->db->select('*')
                ->from('bus_search_boarding_point');
        $this->db->where('bus_search_result_info_id', $id);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            
        }
    }

    function getdropping($id) {
        $this->db->select('*')
                ->from('bus_search_drop_point');
        $this->db->where('bus_search_result_info_id', $id);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            
        }
    }

    function getsourname($id) {
        $this->db->select('*')
                ->from('bus_source_list');
        $this->db->where('source_id', $id);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->row();
        } else {
            return '';
        }
    }

    function getdestiname($id) {
        $this->db->select('*')
                ->from('bus_destination_list');
        $this->db->where('bus_destination_id', $id);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->row();
        } else {
            return '';
        }
    }

    function get_boarding($busid) {
        $this->db->select()
                ->from('bus_search_boarding_point')
                ->where('bus_search_result_info_id', $busid);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->result();
        }
    }

    function get_boarding_one($busID, $boardingpoint) {
        $this->db->select()
                ->from('bus_search_boarding_point')
                ->where('bus_search_result_info_id', $busID)
                ->where('boarding_point_id', $boardingpoint);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            return $query->row();
        }
    }

    function getTime($totMin) {

        $timestring = "";

        $oneDay = 24 * 60;
        $noOfDays = floor($totMin / $oneDay);
        $time = $totMin % $oneDay;

        $hours = floor($time / 60);
        $minutes = floor($time % 60);


        if ($minutes < 10) {
            $minutes = '0' . $minutes;
        }

        if ($hours % 12 == 0) {
            $timestring.="00";
        } else {
            $timestring.=$hours % 12;
        }
        $timestring.=":";
        $timestring.=$minutes;

        if ($hours < 12) {
            $timestring.=" am";
        } else {
            $timestring.=" pm";
        }

        return $timestring;
    }

    function getsource_id($city) {
        $query = $this->db->select('source_id')->from('bus_source_list')->where('city_name', $city)->get();
        if ($query->num_rows > 0) {
            $ci = $query->row();
            return $ci->source_id;
        }
    }

    function getdesti_id($city, $sour) {
        $query = $this->db->select('bus_destination_id')->from('bus_destination_list')->where('city_name', $city)->where('bus_source_id', $sour)->limit(1)->get();
        if ($query->num_rows > 0) {
            $ci = $query->row();
            return $ci->bus_destination_id;
        }
    }

    function get_bus_detail($busID, $tripID) {
        $query = $this->db->select('*')->from('bus_search_result_info')->where('id', $tripID)->where('bus_search_result_info_id', $busID)->get();
        //   echo $this->db->last_query();
        if ($query->num_rows > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    function insert_booking_report($insbook) {
        $this->db->insert('bus_booking_reports', $insbook);
        $ins = $this->db->insert_id();
        return $ins;
    }

    function insert_passinfo($passdata) {
        $this->db->insert('bus_booking_pass_info', $passdata);
    }

    function get_booking_details($booking_reference_no, $tfvRefNo) {
        $query = $this->db->select('*')->from('bus_booking_reports')->where('booking_reference_no1', $booking_reference_no)->where('tfv_reference_no', $tfvRefNo)->get();
        if ($query->num_rows > 0) {
            return $query->result();
        }
    }

    function get_booking_pass_details($booking_reference_no, $tfvRefNo) {
        $query = $this->db->select('*')->from('bus_booking_pass_info')->where('booking_reference_no', $booking_reference_no)->where('tfv_reference_no', $tfvRefNo)->get();
        if ($query->num_rows > 0) {
            return $query->result();
        }
    }

}
