<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home_Model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function get_airport_list($type) {
        $this->db->select('*');
        $this->db->from('airport_list');
        $this->db->where('airport_type', $type);
        $query = $this->db->get();

        if ($query->num_rows == '') {
            return '';
        } else {
            return $query->result_array();
        }
    }

    function user_login_validate($user_email, $user_password) {
        $this->db->select('*');
        $this->db->from('user_info');
        $this->db->where('user_email', $user_email);
        $this->db->where('user_password', $user_password);
        $query = $this->db->get();

        if ($query->num_rows == '') {
            return '';
        } else {
            return $query->row();
        }
    }

    function get_hotel_list($type) {
        $this->db->select('city');
        $this->db->from('api_hotels_city');
        //$this->db->where('city', $type);
        $query = $this->db->get();

        if ($query->num_rows == '') {
            return '';
        } else {
            return $query->result_array();
        }
    }

    function get_roomshotel_list($search) {

        $where = "(city_name LIKE '%" . $search . "%')";
        $this->db->select('city_name,country_name');
        $this->db->from('rooms_city_list');
        $this->db->where($where);
        //$this->db->where('city', $type);
        $query = $this->db->get();

        if ($query->num_rows == '') {
            return '';
        } else {
            return $query->result_array();
        }
    }

    function get_tghotel_list($search) {

        $this->db->select('*');
        $this->db->from('tg_rooms_cities');
        $this->db->like('city_name', $search);
        $this->db->order_by('city_name');
        $query = $this->db->get();

        if ($query->num_rows == '') {
            return '';
        } else {
            return $query->result_array();
        }
    }

    function get_jachotel_list($search) {

        $where = "(city_name LIKE '%" . $search . "%')";
        $this->db->select('city_name,country_name');
        $this->db->from('jac_city_list');
        $this->db->where($where);
        //$this->db->where('city', $type);
        $query = $this->db->get();

        if ($query->num_rows == '') {
            return '';
        } else {
            return $query->result_array();
        }
    }

    function get_ace_roomshotel_list($search) {
        $where = "(city_name LIKE '%" . $search . "%')";
        $this->db->select('*');
        $this->db->from('ace_rooms_cities');
        $this->db->where($where);
        $this->db->group_by('city_id');
        //$this->db->where('city', $type);
        $query = $this->db->get();

        if ($query->num_rows == '') {
            return '';
        } else {
            return $query->result_array();
        }
    }

    function get_travelguru_roomshotel_list($search) {
        $where = "(city_name LIKE '%" . $search . "%')";
        $this->db->select('*');
        $this->db->from('tg_rooms_cities');
        $this->db->where($where);
        $this->db->group_by('city_id');
        //$this->db->where('city', $type);
        $query = $this->db->get();

        if ($query->num_rows == '') {
            return '';
        } else {
            return $query->result_array();
        }
    }

    function getbus_source() {
        $this->db->select('*')
                ->from('bus_source_list');
        $this->db->order_by('city_name', 'ASC');
        $query = $this->db->get();
        if ($query->num_rows == '') {
            return '';
        } else {
            return $query->result();
        }
    }

    function getbusdest($id) {
        $this->db->select('*')
                ->from('bus_destination_list');
        $this->db->where('bus_source_id', $id);
        $query = $this->db->get();
        if ($query->num_rows == '') {
            return '';
        } else {
            return $query->result();
        }
    }

    function getbus_dest_all() {
        $this->db->select('*')
                ->from('bus_destination_list');
        $query = $this->db->get();
        if ($query->num_rows == '') {
            return '';
        } else {
            return $query->result();
        }
    }

    function get_nationality() {
        $query = $this->db->select('*')->from('rooms_nationality')->get();
        if ($query->num_rows > 0) {
            return $query->result();
        }
    }

}
