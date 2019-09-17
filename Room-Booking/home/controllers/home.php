<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
error_reporting(0);

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Home_Model');
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function index() {
        $data['nationality'] = $this->Home_Model->get_nationality();
        $data['search_key'] = '0';
        $this->load->view('home/index', $data);
    }

    public function search($search) {
        $data['nationality'] = $this->Home_Model->get_nationality();
        $text = str_replace("%20", " ", $search);
        $data['search'] = $text;
        $data['search_key'] = '1';
        //$search = $this->uri->segment($search);
        $this->load->view('home/index', $data);
    }

    public function int_search($search) {
        $data['nationality'] = $this->Home_Model->get_nationality();
        $text = str_replace("%20", " ", $search);
        $data['search'] = $text;
        $data['search_key'] = '2';
        //$search = $this->uri->segment($search);
        $this->load->view('home/index', $data);
    }

    function user_login_validate() {
        if (isset($_POST['userName']) && isset($_POST['password'])) {
            $login_info = $this->Home_Model->user_login_validate(trim($_POST['userName']), md5($_POST['password']));
            if (!empty($login_info)) {
                $user_email = $login_info->user_email;
                $first_name = $login_info->first_name;
                $middle_name = $login_info->middle_name;
                $last_name = $login_info->last_name;
                $mobile_no = $login_info->mobile_no;

                echo 'success,' . $user_email . ',' . $first_name . ',' . $middle_name . ',' . $last_name . ',' . $mobile_no;
            } else {
                echo 'failure';
            }
        } else {
            echo 'Permission denied';
        }
    }

    function about_us() {
        $this->load->view('home/aboutus');
    }
    
     function disclaimer() {
        $this->load->view('home/disclaimer');
    }

    function contact_us() {
        $this->load->view('home/contactus');
    }

    function faq() {
        $this->load->view('home/faq');
    }

    function privacy() {
        $this->load->view('home/privacy');
    }

    function terms_conditions() {
        $this->load->view('home/terms');
    }

    // Hotel Cities Auto List
    function hotel_autolist() {

        if (isset($_GET['term'])) {
            $return_arr = array();

            $search = $_GET["term"];
            //  $city_list = $this->Home_Model->get_jachotel_list($search);
            $city_list = $this->Home_Model->get_roomshotel_list($search);
            //  $city_list = $this->Home_Model->get_ace_roomshotel_list($search);
            if (!empty($city_list)) {
                for ($i = 0; $i < count($city_list); $i++) {
                    //    $airport_code = $city_list[$i]['airport_code'];
                    $city = $city_list[$i]['city_name'];
                    $country_name = $city_list[$i]['country_name'];

                    $return_arr[] = array(
                        'label' => ucfirst($city) . ', ' . ucfirst($country_name),
                        'value' => ucfirst($city) . ', ' . ucfirst($country_name)
                    );
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

    function dhotel_autolist() {
        //echo $GET['term'];
        if (isset($_GET['term'])) {
            $return_arr = array();

            $search = $_GET["term"];


            $city_list = $this->Home_Model->get_tghotel_list($search);

            if (!empty($city_list)) {
                for ($i = 0; $i < count($city_list); $i++) {
                    $hotel_city = $city_list[$i]['city_name'];
                    $hotel_country = $city_list[$i]['country'];

                    $return_arr[] = array(
                        'label' => ucfirst($hotel_city) . " (" . ucfirst($hotel_country) . ")",
                        'value' => ucfirst($hotel_city) . " (" . ucfirst($hotel_country) . ")"
                    );
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

}

