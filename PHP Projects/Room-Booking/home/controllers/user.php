<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
error_reporting(0);

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_Model');
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function index() {
        redirect('home/index', 'refresh');
    }

//    public function login() {
//        if ($this->session->userdata('user_logged_in'))
//            redirect('user/index', 'refresh');
//
//        $this->load->view('user/login_view');
//    }

    function user_login() {
        $this->form_validation->set_rules('user_email', 'Email', 'trim|required|valid_email|xss_clean');
        $this->form_validation->set_rules('user_password', 'Password', 'trim|required|xss_clean');

        $data['status'] = '';
        if ($this->form_validation->run() !== FALSE) {
            $loginEmailId = $this->input->post('user_email');
            $loginPassword = md5($this->input->post('user_password'));

            $res = $this->User_Model->validate_credentials($loginEmailId, $loginPassword);
            //echo '<pre/>';print_r($res);exit;
            if ($res !== false) {
                $sessionUserInfo = array(
                    'user_id' => $res->user_id,
                    'user_no' => $res->user_no,
                    'user_email' => $res->user_email,
                    'user_first_name' => $res->first_name,
                    'user_last_name' => $res->last_name,
                    'user_logged_in' => TRUE
                );
                $this->session->set_userdata($sessionUserInfo);

                $this->User_Model->insert_login_activity();

                redirect('home/index', 'refresh');
            } else {
                $data['status'] = 'Invalid Email Id/Password.';
            }
        }

        $this->load->view('home/index', $data);
    }

    function user_register() {
        $this->form_validation->set_rules('user_email', 'Email', 'trim|required|valid_email|is_unique[user_info.user_email]');
        $this->form_validation->set_rules('user_password', 'Password', 'trim|required|matches[passconf]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('mobile_no', 'Mobile No', 'trim|required|integer|min_length[10]');
        $data['status'] = '';
        $data['errors'] = '';
        $data['country_list'] = $this->User_Model->get_country_list();

        if ($this->form_validation->run() == FALSE) {
            // echo '1'; exit;
            $data['user_email'] = $this->input->post('user_email');
            $data['first_name'] = $this->input->post('first_name');
            $data['last_name'] = $this->input->post('last_name');
            $data['mobile_no'] = $this->input->post('mobile_no');
            $this->load->view('home/index', $data);
        } else {
            //echo '<pre/>';print_r($_POST);exit;			
            $user_email = $this->input->post('user_email');
            $user_password = md5($this->input->post('user_password'));
            $title = $this->input->post('title');
            $first_name = $this->input->post('first_name');
            $last_name = $this->input->post('last_name');
            $mobile_no = $this->input->post('mobile_no');
            $travel_offers = $this->input->post('travel_offers');

            $email_check = $this->User_Model->check_email_availability($user_email);

            if ($email_check != '' || !empty($email_check)) {
                //echo '3'; exit;
                $data['errors'] = 'Email Already Exists. Please use different email id to continue registration...';
                $this->load->view('home/index', $data);
            } else {
                //$image_path = '';
                if ($this->User_Model->add_user($user_email, $user_password, $title, $first_name, $last_name, $mobile_no, $travel_offers)) {
                    $data['status'] = '1';
                    //echo '5'; exit;


                    $this->registration_conformation($user_email, $title, $first_name);

                    $this->load->view('home/index', $data);
                } else {
                    // echo '6'; exit;
                    $data['errors'] = 'User Registration Not Done. Please try after some time...';
                    $this->load->view('home/index', $data);
                }
            }
        }
    }

    function registration_conformation($user_email, $title, $first_name) {


        $curr_date = date("d/m/Y");
        $ci = get_instance();
        $ci->load->library('email');
        $ci->email->from('it@roombooking.in', 'Roombooking');
        $list = $user_email;
        $ci->email->to($list);
        $this->email->reply_to('it@roombooking.in');
        $ci->email->subject('Registration');
        $ci->email->message('Dear, ' . $title . ' ' . $first_name . '

<br />
<br />

You have beeen Registered with our services,<br />
<br />

<div align="center" style="color:#F90;">User Registration Request from <a href="http://www.roombooking.in">www.roombooking.in</a></div>
<table width="500" border="1" cellpadding="5" cellspacing="5" align="center">
  <tr>
    <th>Name</th>
    <th>Email</th>
    <th>Date</th>
  </tr>
  <tr>
    <td>' . $first_name . '</td>
    <td>' . $user_email . '</td>
    <td>' . $curr_date . '</td>
  </tr>
</table>');



        $ci->email->send();



        //echo $this->email->print_debugger();
    }

    public function view_profile() {
        $data['country_list'] = $this->User_Model->get_country_list();

        $data['user_id'] = $user_id = $this->session->userdata('user_id');

        $data['status'] = '';
        $data['errors'] = '';
        $data['user_info'] = $this->User_Model->getUserInfo($user_id);
        // echo '<pre/>';print_r($data['user_info']);exit;
        $this->load->view('home/view_profile', $data);
    }

    function update_profile_info() {
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('mobile_no', 'Mobile No', 'trim|required|integer|min_length[10]');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->form_validation->set_rules('pin_code', 'Pincode', 'trim|required|integer|min_length[6]');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('state', 'State', 'trim|required');
        $this->form_validation->set_rules('country', 'Country', 'required');


        $data['status'] = '';
        $data['errors'] = '';
        $data['country_list'] = $this->User_Model->get_country_list();

        $data['user_id'] = $user_id = $this->input->post('user_id');
        $data['user_info'] = $this->User_Model->getUserInfo($user_id);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('home/view_profile', $data);
        } else {
            //echo '<pre/>';print_r($_POST);exit;			
            $user_id = $this->input->post('user_id');
            $title = $this->input->post('title');
            $first_name = $this->input->post('first_name');
            $middle_name = $this->input->post('middle_name');
            $last_name = $this->input->post('last_name');
            $mobile_no = $this->input->post('mobile_no');
            $address = $this->input->post('address');
            $pin_code = $this->input->post('pin_code');
            $city = $this->input->post('city');
            $state = $this->input->post('state');
            $country = $this->input->post('country');

            $user_email = $this->input->post('user_email');
            $user_logo = $this->input->post('user_logo');

            if ($this->User_Model->update_profile($user_id, $title, $first_name, $middle_name, $last_name, $mobile_no, $address, $pin_code, $city, $state, $country, $user_logo)) {
                //redirect('user/view_profile','refresh');
                $data['user_info'] = $this->User_Model->getUserInfo($user_id);
                $data['status'] = '1';
                $this->load->view('home/view_profile', $data);
            } else {
                $data['errors'] = 'User Profile Not Updated. Please try after some time...';
                $this->load->view('home/view_profile', $data);
            }
        }
    }

    function change_password() {
        $this->form_validation->set_rules('password', 'New Password', 'trim|required|matches[passconf]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');

        $data['status'] = '';
        $data['errors'] = '';

        $data['user_id'] = $user_id = $this->session->userdata('user_id');
        $data['user_info'] = $user_info = $this->User_Model->getUserInfo($user_id);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('home/changepassword', $data);
        } else {
            if ($this->input->post('password') == $this->input->post('passconf')) {
                $password = md5($this->input->post('password'));
                if ($this->User_Model->update_password($user_id, $password)) {
                    $data['status'] = 1;
                } else {
                    $data['errors'] = 'Your Password not Updated. Please try after some time...';
                }
            } else {
                $data['errors'] = 'Current Password is wrong. Please enter correct current password...';
            }

            $this->load->view('home/changepassword', $data);
        }
    }

    public function user_booking() {
        if (!$this->session->userdata('user_logged_in'))
            redirect('user/login', 'refresh');

        $data['user_id'] = $user_id = $this->session->userdata('user_id');

        //    $data['flight_booking_summary'] = $this->User_Model->get_user_flight_booking_summary($user_id);
        $data['hotel_booking_summary'] = $this->User_Model->get_user_dom_hotel_booking_summary($user_id);
        $data['hotel_booking_summary_int'] = $this->User_Model->get_user_int_hotel_booking_summary($user_id);
        //$data['bus_booking_summary'] = $this->User_Model->get_user_bus_booking_summary($user_id);
//echo '<pre>';print_r($data); exit;
        $this->load->view('home/view_booking_summary', $data);
    }

    public function logout() {
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('user_logged_in');
        $this->session->sess_destroy();

        redirect('home/index', 'refresh');
    }

    function user_login_validate() {
        if (isset($_POST['userName']) && isset($_POST['password'])) {
            $login_info = $this->User_Model->validate_credentials(trim($_POST['userName']), md5($_POST['password']));

            if (!empty($login_info)) {
                $sessionUserInfo = array(
                    'user_id' => $login_info->user_id,
                    'user_no' => $login_info->user_no,
                    'user_email' => $login_info->user_email,
                    'user_first_name' => $login_info->first_name,
                    'user_last_name' => $login_info->last_name,
                    'user_logged_in' => TRUE
                );
                $this->session->set_userdata($sessionUserInfo);

                $user_email = $login_info->user_email;
                $first_name = $login_info->first_name;
                $middle_name = $login_info->middle_name;
                $last_name = $login_info->last_name;
                $mobile_no = $login_info->mobile_no;


                $this->User_Model->insert_login_activity();

                echo 'success,' . $user_email . ',' . $first_name . ',' . $middle_name . ',' . $last_name . ',' . $mobile_no;
            } else {
                echo 'failure';
            }
        } else {
            echo 'Permission denied';
        }
    }

    public function forgot_password() {
        $this->form_validation->set_rules('email_id', 'Email', 'trim|required|valid_email|xss_clean');
        $loginEmailId = $this->input->post('email_id');
        $data = base64_encode($loginEmailId);
        $getpassword = '';
        $getpassword = $this->User_Model->get_forgot_password($loginEmailId);
        $user_id = $getpassword->user_id;
        if ($getpassword) {
            $ci = get_instance();
            $ci->load->library('email');
            $ci->email->from('it@roombooking.in', 'Roombooking');
            $list = $loginEmailId;
            $ci->email->to($list);
            $this->email->reply_to($list);
            $ci->email->subject('Forgot password');
            $ci->email->message('
                                <div>


<div>
<p>Greetings From Roombooking.in,</p>

</div>
<div>Login Details :
<p>UserName : ' . $loginEmailId . '</p>
</div>
<div>Please Reset you password from here <a href="http://www.roombooking.in/user/load_forgot_password/' . $user_id . '/' . $loginEmailId . '/' . $data . '">click here</a>
<p>Please do not hesitate to contact us on info@travelpd.com for all your Urgent Queries / Reservation or Requirements.</p></div>
<div>
<div>Thanking you,
</div>

<div>Registration & Roombooking.in Team,
</div>

<div>roombooking.in
</div>

</div>
</div>

');
            $ci->email->send();

            redirect('home/index', 'refresh');
        }
    }

    public function load_forgot_password($user_id, $loginEmailId, $decode) {
        $data['user_id'] = $user_id;
        $data['email'] = $loginEmailId;
        $data['decode'] = $decode;
        $data['status'] = '';
        //  echo '<pre>';        print_r($data); exit;
        $this->load->view('home/forgot_password', $data);
    }

    function restore_password() {
        $this->form_validation->set_rules('password', 'New Password', 'trim|required|matches[passconf]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');
        $email_id = $this->input->post('email');
        $data['status'] = '';
        $data['errors'] = '';
        $user_id = $this->input->post('user_id');
        $data['$user_id'] = $user_id;


        $user_info = $this->User_Model->getUserdetail($email_id, $user_id);
        //echo '<pre>';        print_r($agent_info); exit;
        $user_info = $user_info->user_id;

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('User/forgot_password', $data);
        } else {

            $password = md5($this->input->post('password'));
            if ($this->User_Model->update_password($user_id, $password)) {
                $data['status'] = 1;
            } else {
                $data['errors'] = 'Your Password not Updated. Please try after some time...';
            }
            $data['email'] = $user_info->user_email;
            $this->load->view('home/forgot_password', $data);
        }
    }

}

