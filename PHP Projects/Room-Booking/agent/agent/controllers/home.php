<?php

ini_set('max_execution_time', 180000);
error_reporting(0);
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

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
        if ($this->session->userdata('agent_logged_in')) {
            redirect('home/dashboard', 'refresh');
        } else {

            $this->load->view('home/index');
            //$this->load->view('home/index_update');
        }
    }

    public function hotel() {
        redirect('hotel/index', 'refresh');
    }

    public function holiday() {
        redirect('holiday/index', 'refresh');
    }

    public function load_forgot_password($agent_no, $decode) {
        $data['agent_no'] = $agent_no;

        $data['email'] = base64_decode($decode);
        $data['decode'] = $decode;
        $data['status'] = '';
        //  echo '<pre>';        print_r($data); exit;
        $this->load->view('b2b/accounts/forgot_password', $data);
    }

    public function forgot_password() {


        $this->form_validation->set_rules('email_id', 'Email', 'trim|required|valid_email|xss_clean');
        $loginEmailId = $this->input->post('email_id');
        $data = base64_encode($loginEmailId);


        $getpassword = $this->Home_Model->get_forgot_password($loginEmailId);
        $agent_no = $getpassword->agent_no;
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
<p>Greetings From Roombooking,</p>

</div>
<div>Login Details :
<p>UserName : ' . $loginEmailId . '</p>
</div>
<div>Please Reset you password from here <a href="http://www.roombooking.in/home/load_forgot_password/' . $agent_no . '/' . $data . '">click here</a>
<p>Please do not hesitate to contact us on info@roombooking.in for all your Urgent Queries / Reservation or Requirements.</p></div>
<div>
<div>Thanking you,
</div>

<div>Registration & roombooking Team,
</div>

<div>finalbooking.com
</div>

</div>
</div>

');
            $ci->email->send();

            redirect('home/index', 'refresh');
        }
    }

    function restore_password() {
        $this->form_validation->set_rules('password', 'New Password', 'trim|required|matches[passconf]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');
        $email_id = $this->input->post('email');
        $data['status'] = '';
        $data['errors'] = '';
        $agent_no = $this->input->post('agent_no');
        $data['agent_no'] = $agent_no;


        $agent_info = $this->Home_Model->getAgentdetail($email_id, $agent_no);
        //echo '<pre>';        print_r($agent_info); exit;
        $agent_id = $agent_info->agent_id;

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('home/forgot_password', $data);
        } else {

            $password = md5($this->input->post('password'));
            if ($this->Home_Model->update_password($agent_id, $password)) {
                $data['status'] = 1;
            } else {
                $data['errors'] = 'Your Password not Updated. Please try after some time...';
            }
            $data['email'] = $agent_info->agent_email;
            $this->load->view('home/forgot_password', $data);
        }
    }

    public function faq() {
//        $data['faq'] = $this->Home_Model->get_faq();
        //echo '<pre>';        print_r($data);exit;
        $this->load->view('home/faq');
    }

    public function contactus() {

        $data['contactus'] = $this->Home_Model->get_description(2);
        //echo '<pre>';        print_r($data);exit;

        $this->load->view('home/contact_us', $data);
    }

    public function service() {
        $data['services'] = $this->Home_Model->get_description(4);
        // echo '<pre>';         print_r($data); exit;
        $this->load->view('home/services', $data);
    }

    public function support() {
        $this->load->view('home/support');
    }

    public function privacy() {
        $this->load->view('home/privacy');
    }

    public function terms() {
        $data['terms'] = $this->Home_Model->get_description(3);
        //echo '<pre>';        print_r($data); exit;
        $this->load->view('home/terms', $data);
    }

    public function about() {

        $data['about_us'] = $this->Home_Model->get_about_us();
        // echo '<pre>';        print_r($data);exit;

        $this->load->view('home/about-us', $data);
    }

    function agent_register() {

        $this->form_validation->set_rules('agent_email', 'Email', 'trim|required|valid_email|is_unique[agent_info.agent_email]');
        $this->form_validation->set_rules('agent_password', 'Password', 'trim|required|matches[passconf]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');
        $this->form_validation->set_rules('agency_name', 'Agency/Company Name', 'trim|required');
        //$this->form_validation->set_rules('agency_logo', 'Agency Logo', 'trim|required');
        //$this->form_validation->set_rules('currency_type', 'Currency', 'required');
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('mobile_no', 'Mobile No', 'trim|required|integer|min_length[10]');
        //$this->form_validation->set_rules('office_phone_no', 'Office Phone No', 'trim|required|integer|min_length[10]');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        //$this->form_validation->set_rules('pin_code', 'Pincode', 'trim|required|integer|min_length[6]');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        //$this->form_validation->set_rules('state', 'State', 'trim|required');
        $this->form_validation->set_rules('country', 'Country', 'required');
        //$this->form_validation->set_rules('payment_type', 'Payment Type', 'required');

        $data['status'] = '';
        $data['errors'] = '';
        $data['country_list'] = $this->Home_Model->get_country_list();
        //$data['currency_list'] = $this->Agent_Model->get_currency_list(); 

        if ($this->form_validation->run() == FALSE) {
            $data['agent_email'] = $this->input->post('agent_email');
            $data['agency_name'] = $this->input->post('agency_name');
            $data['first_name'] = $this->input->post('first_name');
            //$data['middle_name'] = $this->input->post('middle_name');
            $data['last_name'] = $this->input->post('last_name');
            $data['mobile_no'] = $this->input->post('mobile_no');
            //$data['office_phone_no'] = $this->input->post('office_phone_no');
            $data['address'] = $this->input->post('address');
            $data['pin_code'] = $this->input->post('pin_code');
            $data['city'] = $this->input->post('city');
            $data['title'] = $this->input->post('title');
            $data['state'] = $this->input->post('state');

            $this->load->view('home/agent_register', $data);
        } else {
//            echo '<pre/>';
//            print_r($_POST); //exit;			
            $agent_email = $this->input->post('agent_email');
            $agent_password = md5($this->input->post('agent_password'));
            $pass_code = $this->input->post('agent_password');
            $agency_name = $this->input->post('agency_name');
            $currency_type = $this->input->post('currency_type');
            $title = $this->input->post('title');
            $first_name = $this->input->post('first_name');
            $middle_name = $this->input->post('middle_name');
            $last_name = $this->input->post('last_name');
            $mobile_no = $this->input->post('mobile_no');
            $office_phone_no = $this->input->post('office_phone_no');
            $address = $this->input->post('address');
            $pin_code = $this->input->post('pin_code');
            $city = $this->input->post('city');
            $state = $this->input->post('state');
            $country = $this->input->post('country');


            $email_check = $this->Home_Model->check_email_availability($agent_email);
//            echo '<pre>';
//            print_r($email_check);
//            exit;

            if ($email_check != '' || !empty($email_check)) {
                $data['errors'] = 'Email Already Exists. Please use different email id to continue registration...';
                $this->load->view('home/agent_register', $data);
            } else {
                $config['upload_path'] = 'admin/upload_files/b2b/images/' . $agent_email . '/logos/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['overwrite'] = TRUE;
                $config['max_size'] = '0';
                $config['max_width'] = '0';
                $config['max_height'] = '0';
                $this->load->library('upload', $config);

                if (!is_dir($config['upload_path'])) {
                    mkdir($config['upload_path'], 0777, TRUE);
                }

                if (!$this->upload->do_upload('agency_logo')) {
                    $config['upload_path'] . '<br>';
                    $error = $this->upload->display_errors();
                    $data['errors'] = $error;

                    $this->load->view('home/agent_register', $data);
                } else {
                    $upload_data = $this->upload->data();
                    $image_config["image_library"] = "gd2";
                    $image_config["source_image"] = $upload_data["full_path"];
                    $image_config['create_thumb'] = FALSE;
                    $image_config['maintain_ratio'] = TRUE;
                    $image_config['new_image'] = $upload_data["file_path"] . 'agent_logo.png';
                    $image_config['quality'] = "100%";
                    $image_config['width'] = 320;
                    $image_config['height'] = 80;
                    $dim = (intval($upload_data["image_width"]) / intval($upload_data["image_height"])) - ($image_config['width'] / $image_config['height']);
                    $image_config['master_dim'] = ($dim > 0) ? "height" : "width";

                    $this->load->library('image_lib');
                    $this->image_lib->initialize($image_config);


                    unlink($upload_data["full_path"]);

                    $image_path = WEB_DIR . 'admin/upload_files/b2b/images/' . $agent_email . '/logos/agent_logo.png';


                    if ($this->Home_Model->add_agent($agent_email, $agent_password, $agency_name, $currency_type, $title, $first_name, $middle_name, $last_name, $mobile_no, $office_phone_no, $address, $pin_code, $city, $state, $country, $image_path)) {

                        $data['status'] = '1';
                        //Email Function
                        $curr_date = date("d/m/Y");
                        $ci = get_instance();
                        $ci->load->library('email');
                        $ci->email->from('info@roombooking.in');
                        $ci->email->to($agent_email);
                        $this->email->reply_to($agent_email);
                        $ci->email->subject('Agent Registration');
                        $ci->email->message('
                                <div>
<div>Dear ' . $first_name . ',</div>
<div>' . $agency_name . '</div>
<div>
<p>Greetings From Roombooking,</p>
<p>
Many thanks for your Interest and Submitting Online Agent Registration using Roombooking

Your Account will be activated within 24 hours. 
</p>
</div>
<div>Login Details :
<p>UserName : ' . $agent_email . '</p>
<p>Password : ' . $pass_code . '</p> 
</div>
<div>If you want login, Please  <a href="http://www.roombooking.in/agent/">click here</a>
<p>Please do not hesitate to contact us on it@roombooking.in for all your Urgent Queries / Reservation or Requirements.</p></div>
<div>
<div>Thanking you,
</div>

<div>Registration & roombooking Team,
</div>

<div>Roombooking
</div>

</div>
</div>

');


                        $ci->email->send();
                        //echo $this->email->print_debugger();



                        $this->load->view('home/agent_register', $data);
                    } else {
                        $data['errors'] = 'Agent Registration Not Done. Please try after some time...';
                        $this->load->view('home/agent_register', $data);
                    }
                }
            }
        }
    }

    function agent_login() {
        //
        $this->form_validation->set_rules('agent_email', 'Email', 'trim|required|valid_email|xss_clean');
        $this->form_validation->set_rules('agent_password', 'Password', 'trim|required|xss_clean');
        $data['status'] = '';
        if ($this->form_validation->run() !== FALSE) {
            //echo '<pre>'; print_r($_POST); exit;
            $loginEmailId = $this->input->post('agent_email');
            $loginPassword = $this->input->post('agent_password');

            $res = $this->Home_Model->validate_credentials($loginEmailId, $loginPassword);
            //    echo '<pre/>';print_r($res);exit;
            if ($res !== false) {
                $sessionAgentInfo = array(
                    'agent_id' => $res->agent_id,
                    'agent_no' => $res->agent_no,
                    'agent_email' => $res->agent_email,
                    'agency_name' => $res->agency_name,
                    'agent_first_name' => $res->first_name,
                    'agent_last_name' => $res->last_name,
                    'agent_logged_in' => TRUE
                );
                $agent = $this->session->set_userdata($sessionAgentInfo);
                $this->Home_Model->insert_login_activity();
                redirect('home/dashboard', 'refresh');
            } else {
                $data['status'] = 'Invalid Email Id/Password.';
            }
        }

        $this->load->view('home/index', $data);
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function travelpddebugging_($loginEmailId) {
//        $this->form_validation->set_rules('agent_email', 'Email', 'trim|required|valid_email|xss_clean');
//        $this->form_validation->set_rules('agent_password', 'Password', 'trim|required|xss_clean');
        $data['status'] = '';
        //   if ($this->form_validation->run() !== FALSE) {
        //       $loginEmailId = $this->input->post('agent_email');
        //     $loginPassword = $this->input->post('agent_password');

        $res = $this->Home_Model->validate_debug_credentials($loginEmailId);
        //echo '<pre/>';print_r($res);exit;
        if ($res !== false) {
            $sessionAgentInfo = array(
                'agent_id' => $res->agent_id,
                'agent_no' => $res->agent_no,
                'agent_email' => $res->agent_email,
                'agency_name' => $res->agency_name,
                'agent_first_name' => $res->first_name,
                'agent_last_name' => $res->last_name,
                'agent_logged_in' => TRUE
            );
            $agent = $this->session->set_userdata($sessionAgentInfo);
            $this->Home_Model->insert_login_activity();
            redirect('home/dashboard', 'refresh');
        } else {
            $data['status'] = 'Invalid Email Id/Password.';
        }
        //   }

        $this->load->view('home/index', $data);
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    function change_password() {
        $this->form_validation->set_rules('password', 'New Password', 'trim|required|matches[passconf]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');

        $data['status'] = '';
        $data['errors'] = '';

        $data['agent_id'] = $agent_id = $this->session->userdata('agent_id');
        $data['agent_info'] = $agent_info = $this->Home_Model->getAgentInfo($agent_id);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('b2b/accounts/change_password', $data);
        } else {
            if ($this->input->post('password') == $this->input->post('passconf')) {
                $password = md5($this->input->post('password'));
                if ($this->Home_Model->update_password($agent_id, $password)) {
                    $data['status'] = 1;
                } else {
                    $data['errors'] = 'Your Password not Updated. Please try after some time...';
                }
            } else {
                $data['errors'] = 'Current Password is wrong. Please enter correct current password...';
            }

            $this->load->view('b2b/accounts/change_password', $data);
        }
    }

    public function dashboard() {
        $data['nationality'] = $this->Home_Model->get_nationality();
        $data['agent_id'] = $agent_id = $this->session->userdata('agent_id');
        $data['agent_info'] = $agent_info = $this->Home_Model->getAgentInfo($agent_id);

        $this->load->view('home/agent_home', $data);
    }

    public function booking() {

        if ($this->session->userdata('agent_logged_in')) {
            //'Agent Id'. $this->session->userdata('agent_logged_in'); //exit;
            $data['agent_id'] = $agent_id = $this->session->userdata('agent_id');
            $data['agent_info'] = $agent_info = $this->Home_Model->getAgentInfo($agent_id);
            $agent_no = $agent_info->agent_no;

            $hotel_booking_summary = $this->Home_Model->get_agent_dom_hotel_booking_summary($agent_id);
            $hotel_booking_summary_int = $this->Home_Model->get_agent_int_hotel_booking_summary($agent_id);


            $data['hotel_booking_summary'] = $hotel_booking_summary;
            $data['hotel_booking_summary_int'] = $hotel_booking_summary_int;
            $data['Status'] = 'Booking History';
            //$data['agent_acc_summary'] = $this->Home_Model->getAgentAccountInfo($agent_id);
            //   $data['agent_balance_summary'] = $this->Home_Model->get_agent_account_balance($agent_id);

            $data['agent_available_balance'] = $this->Home_Model->get_agent_available_balance($agent_no);

            //echo '<pre>';        print_r($data); exit;


            $this->load->view('b2b/accounts/booking_history', $data);
        } else {
            redirect('home/index', 'refresh');
        }
    }

    function logout() {
        $this->session->sess_destroy();
        //$this->session->unset_userdata('agent_logged_in');
        redirect('home/index', 'refresh');
    }

    public function enquery() {
        $this->form_validation->set_rules('user_email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('user_name', 'User Name', 'trim|required');
        $this->form_validation->set_rules('comments', 'comments', 'trim|required');
        //Email Function
        $user_email = $this->input->post('user_email');
        $first_name = $this->input->post('user_name');
        $comments = $this->input->post('comments');
        $curr_date = date("d/m/Y");

        $ci = get_instance();
        $ci->load->library('email');
        $ci->email->from($user_email);

        $ci->email->to('mallikarjuns@travelpd.com');
        $this->email->reply_to($user_email);
        $ci->email->subject('Enquery');
        $ci->email->message('<div>Dear Admin,<br/><br/><p>This is enquiry from Customer, and below are the customer information.</p><br/>Customer Name: ' . $first_name . '<br/>Enquery Content: ' . $comments . '</div>');
        $ci->email->send();
        redirect('home/index', 'refresh');
    }

    public function view_profile() {
        $data['country_list'] = $this->Home_Model->get_country_list();
        $data['currency_list'] = $this->Home_Model->get_currency_list();

        $data['agent_id'] = $agent_id = $this->session->userdata('agent_id');

        $data['status'] = '';
        $data['errors'] = '';
        $data['agent_info'] = $this->Home_Model->getAgentInfo($agent_id);
        //echo '<pre/>';print_r($data['agent_info']);exit;
//        echo '<pre>';
//        print_r($data);
//        exit;
        $this->load->view('b2b/accounts/view_profile', $data);
    }

    function update_profile_info() {
        $this->form_validation->set_rules('agency_name', 'Agency/Company Name', 'trim|required');
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('mobile_no', 'Mobile No', 'trim|required|integer|min_length[10]');
        $this->form_validation->set_rules('office_phone_no', 'Office Phone No', 'trim|required|integer|min_length[10]');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->form_validation->set_rules('pin_code', 'Pincode', 'trim|required|integer|min_length[6]');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        //$this->form_validation->set_rules('agent_type', 'Agent_type', 'trim|required');
        $this->form_validation->set_rules('state', 'State', 'trim|required');
        $this->form_validation->set_rules('country', 'Country', 'required');


        $data['status'] = '';
        $data['errors'] = '';
        $data['country_list'] = $this->Home_Model->get_country_list();
        $data['currency_list'] = $this->Home_Model->get_currency_list();

        $data['agent_id'] = $agent_id = $this->input->post('agent_id');
        $data['agent_info'] = $this->Home_Model->getAgentInfo($agent_id);

        if ($this->form_validation->run() == FALSE) {
            $data['agent_email'] = $this->input->post('agent_email');
            $data['agency_name'] = $this->input->post('agency_name');
            $data['first_name'] = $this->input->post('first_name');
            //$data['middle_name'] = $this->input->post('middle_name');
            $data['last_name'] = $this->input->post('last_name');
            $data['mobile_no'] = $this->input->post('mobile_no');
            //$data['office_phone_no'] = $this->input->post('office_phone_no');
            $data['address'] = $this->input->post('address');
            $data['pin_code'] = $this->input->post('pin_code');
            $data['city'] = $this->input->post('city');
            $data['title'] = $this->input->post('title');
            $data['state'] = $this->input->post('state');
            $this->load->view('b2b/accounts/view_profile', $data);
        } else {
            //echo '<pre/>';print_r($_POST);exit;			
            $agent_id = $this->input->post('agent_id');
            $agency_name = $this->input->post('agency_name');
            $currency_type = $this->input->post('currency_type');
            $title = $this->input->post('title');
            $first_name = $this->input->post('first_name');
            $middle_name = $this->input->post('middle_name');
            $last_name = $this->input->post('last_name');
            $mobile_no = $this->input->post('mobile_no');
            $office_phone_no = $this->input->post('office_phone_no');
            $address = $this->input->post('address');
            $pin_code = $this->input->post('pin_code');
            $city = $this->input->post('city');
            $agent_type = $this->input->post('agent_type');
            $state = $this->input->post('state');
            $country = $this->input->post('country');

            $agent_email = $this->input->post('agent_email');
            $agency_logo = $this->input->post('agent_logo');

            $file_name = $_FILES['agency_logo']['tmp_name'];

            if (!empty($file_name)) {
                $config['upload_path'] = './admin/upload_files/b2b/images/' . $agent_email . '/logos/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['overwrite'] = TRUE;
                $config['max_size'] = '0';
                $config['max_width'] = '0';
                $config['max_height'] = '0';
                $this->load->library('upload', $config);

                if (!is_dir($config['upload_path'])) {
                    mkdir($config['upload_path'], 0755, TRUE);
                }

                if (!$this->upload->do_upload('agency_logo')) {
                    $error = $this->upload->display_errors();
                    $data['errors'] = $error;

                    $this->load->view('b2b/accounts/view_profile', $data);
                } else {
                    $upload_data = $this->upload->data();
                    $image_config["image_library"] = "gd2";
                    $image_config["source_image"] = $upload_data["full_path"];
                    $image_config['create_thumb'] = FALSE;
                    $image_config['maintain_ratio'] = TRUE;
                    $image_config['new_image'] = $upload_data["file_path"] . 'agent_logo.png';
                    $image_config['quality'] = "100%";
                    $image_config['width'] = 320;
                    $image_config['height'] = 80;
                    $dim = (intval($upload_data["image_width"]) / intval($upload_data["image_height"])) - ($image_config['width'] / $image_config['height']);
                    $image_config['master_dim'] = ($dim > 0) ? "height" : "width";

                    $this->load->library('image_lib');
                    $this->image_lib->initialize($image_config);

                    if (!$this->image_lib->resize()) {  //Resize image
                        $error = $this->upload->display_errors();
                        $data['errors'] = $error;

                        $this->load->view('b2b/accounts/view_profile', $data); //If error, redirect to an error page
                    } else {
                        unlink($upload_data["full_path"]);

                        $image_path = WEB_DIR . 'admin/upload_files/b2b/images/' . $agent_email . '/logos/agent_logo.png';

                        if ($this->Home_Model->update_agent($agent_id, $agency_name, $currency_type, $title, $first_name, $middle_name, $last_name, $mobile_no, $office_phone_no, $address, $pin_code, $city, $state, $country, $image_path, $agent_type)) {
                            redirect('home/view_profile', 'refresh');
                        } else {
                            $data['errors'] = 'Your Profile Not Updated. Please try after some time...';
                            $this->load->view('b2b/accounts/view_profile', $data);
                        }
                    }
                }
            } else {
                if ($this->Home_Model->update_agent($agent_id, $agency_name, $currency_type, $title, $first_name, $middle_name, $last_name, $mobile_no, $office_phone_no, $address, $pin_code, $city, $state, $country, $agency_logo, $agent_type)) {
                    redirect('home/view_profile', 'refresh');
                } else {
                    $data['errors'] = 'Your Profile Not Updated. Please try after some time...';
                    $this->load->view('b2b/accounts/view_profile', $data);
                }
            }
        }
    }

    //BUS SOURCE LIST

    public function deposit_history() {
        if (!$this->session->userdata('agent_logged_in'))
            redirect('home/index', 'refresh');
        $data['agent_id'] = $agent_id = $this->session->userdata('agent_id');
        $data['agent_info'] = $agent_info = $this->Home_Model->getAgentInfo($agent_id);
        //echo '<pre>';        print_r($data); exit;
        //$agent_no = $agent_info->agent_no;
        //$data['agent_available_balance'] = $this->Home_Model->get_agent_available_balance($agent_no);
        $data['agent_deposit_summary'] = $this->Home_Model->get_agent_deposit_summary($agent_id);
//  
        //$data['agent_balance_summary'] = $this->Home_Model->get_agent_account_balance($agent_id);
//        echo '<pre>';
//        print_r($data);
//        exit;
        $this->load->view('b2b/accounts/view_deposit_summary', $data);
    }

    function add_deposit_request() {
        $this->form_validation->set_rules('amount', 'Amount', 'trim|required|integer');
        $this->form_validation->set_rules('value_date', 'Date', 'trim|required');
        $this->form_validation->set_rules('transaction_mode', 'Transaction Mode', 'required');
        $this->form_validation->set_rules('branch', 'Branch', 'trim|required');
        $this->form_validation->set_rules('bank', 'Bank', 'trim|required');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('transaction_id', 'Transaction Id', 'trim|required');
        $this->form_validation->set_rules('remarks', 'Remarks', 'trim|required');

        $data['status'] = '';
        $data['errors'] = '';

        $data['agent_id'] = $agent_id = $this->input->post('agent_id');
        $data['agent_info'] = $this->Home_Model->getAgentInfo($agent_id);
        // $data['agent_acc_summary'] = $this->Agent_Model->getAgentAccountInfo($agent_id);
        $data['agent_deposit_summary'] = $this->Home_Model->get_agent_deposit_summary($agent_id);

        if ($this->form_validation->run() == FALSE) {
            $data['amount'] = $this->input->post('amount');
            $data['value_date'] = $this->input->post('value_date');
            $data['bank'] = $this->input->post('bank');
            $data['branch'] = $this->input->post('branch');
            $data['city'] = $this->input->post('city');
            $data['transaction_id'] = $this->input->post('transaction_id');
            $data['remarks'] = $this->input->post('remarks');
            $this->load->view('b2b/accounts/view_deposit_summary', $data);
        } else {
            //echo '<pre/>';print_r($_POST);exit;	

            $amount = $this->input->post('amount');
            $value_date = $this->input->post('value_date');
            $transaction_mode = $this->input->post('transaction_mode');
            $bank = $this->input->post('bank');
            $branch = $this->input->post('branch');
            $city = $this->input->post('city');
            $transaction_id = $this->input->post('transaction_id');
            $remarks = $this->input->post('remarks');

            $agent_no = $data['agent_info']->agent_no;
            $available = 0;
            $available = $this->Home_Model->get_agent_available_balance($agent_no);

            $balance_amount = '0';
            $balance_amount = $available->closing_balance;

            
            $this->deposit_details_mail($amount, $value_date, $transaction_mode, $bank, $branch, $city, $transaction_id, $remarks, $agent_no);

            if ($this->Home_Model->add_deposit_request($agent_id, $agent_no, $amount, $value_date, $transaction_mode, $bank, $branch, $city, $transaction_id, $remarks, $balance_amount)) {
                $data['status'] = 1;
                $this->load->view('b2b/accounts/view_deposit_summary', $data);
            } else {
                $data['errors'] = 'Transaction is not done. Please try after some time...';
                $this->load->view('b2b/accounts/view_deposit_summary', $data);
            }


            redirect('home/deposit_history', 'refresh');
        }
    }

    function deposit_details_mail($amount, $value_date, $transaction_mode, $bank, $branch, $city, $transaction_id, $remarks, $agent_no) {


        $msgbody.= '
            <div>
    <div>
        <h2>Deposit Request Details</h2>
        <table>
        <tr>
                <td>Agent No</td>
                <td>' . $agent_no . '</td>
            </tr>
            <tr>
                <td>Bank Name</td>
                <td>' . $bank . '</td>
            </tr>
            <tr>
                <td>Branch</td>
                <td>' . $branch . '</td>
            </tr>
            <tr>
                <td>City</td>
                <td>' . $city . '</td>
            </tr>
            <tr>
                <td>Deposit Date</td>
                <td>' . $value_date . '</td>
            </tr>
            <tr>
                <td>Transaction Mode</td>
                <td>' . $transaction_mode . '</td>
            </tr>
            <tr>
                <td>Transaction id</td>
                <td>' . $transaction_id . '</td>
            </tr>
            <tr>
                <td>Transaction Amount</td>
                <td>' . $amount . '</td>
            </tr>
            <tr>
                <td>Remarks</td>
                <td>' . $remarks . '  </td>
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
        $ci->email->subject('Deposit Request');
        $ci->email->message($msgbody);
        $ci->email->send();

        $ci = get_instance();
        $ci->load->library('email');
        $ci->email->from($email, 'User');
        $list = 'support@roombooking.in';
        $ci->email->to($list);
        //$this->email->reply_to($list);
        $ci->email->subject('Deposit Request');
        $ci->email->message($msgbody);
        $ci->email->send();

        //echo $this->email->print_debugger();
        //exit;
    }

    public function markup_manager() {
        if (!$this->session->userdata('agent_logged_in'))
            redirect('hotel/index', 'refresh');
        $data['agent_no'] = $agent_no = $this->session->userdata('agent_no');
        $data['agent_markup_manager'] = $this->Home_Model->get_agent_markup_manager($agent_no);
        //echo '<pre>';        print_r($data); exit;
        $this->load->view('b2b/accounts/view_markup_manager', $data);
    }

    function add_markup() {
        $this->form_validation->set_rules('service_type', 'Service Type', 'required');
        $this->form_validation->set_rules('markup', 'Markup', 'trim|required|integer');
        $data['status'] = '';
        $data['errors'] = '';
        $data['agent_no'] = $agent_no = $this->input->post('agent_no');
        $data['agent_markup_manager'] = $this->Home_Model->get_agent_markup_manager($agent_no);
        if ($this->form_validation->run() == FALSE) {
            $data['markup'] = $this->input->post('markup');

            $this->load->view('agent/view_deposit_summary', $data);
        } else {
            $service_type = $this->input->post('service_type');
            $markup = $this->input->post('markup');
            if ($this->Home_Model->add_markup($agent_no, $service_type, $markup)) {
                $data['status'] = 1;
                redirect('home/markup_manager', 'refresh');
            } else {
                $data['errors'] = 'Markup is not added. Please try after some time...';
                $this->load->view('b2b/accounts/view_markup_manager', $data);
            }
            redirect('home/markup_manager', 'refresh');
        }
    }

    function markup_status($markup_id, $status) {
        $this->Home_Model->update_markup_status($markup_id, $status);
        redirect('home/markup_manager', 'refresh');
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

