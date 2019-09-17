<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
error_reporting(0);

class B2b extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('B2b_Model');
        $this->load->model('Home_Model');

        $this->is_admin_logged_in();
    }

    private function is_admin_logged_in() {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('login/index');
        }
    }

    function create_agent() {
        $this->form_validation->set_rules('agent_email', 'Email', 'trim|required|valid_email|is_unique[agent_info.agent_email]');
        $this->form_validation->set_rules('agent_password', 'Password', 'trim|required|matches[passconf]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');
        $this->form_validation->set_rules('agency_name', 'Agency/Company Name', 'trim|required');
        //$this->form_validation->set_rules('agency_logo', 'Agency Logo', 'trim|required');
        $this->form_validation->set_rules('currency_type', 'Currency', 'required');
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('mobile_no', 'Mobile No', 'trim|required|integer|min_length[10]');
        $this->form_validation->set_rules('office_phone_no', 'Office Phone No', 'trim|required|integer|min_length[10]');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->form_validation->set_rules('pin_code', 'Pincode', 'trim|required|integer|min_length[6]');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('state', 'State', 'trim|required');
        $this->form_validation->set_rules('country', 'Country', 'required');

        $data['status'] = '';
        $data['errors'] = '';
        $data['country_list'] = $this->Home_Model->get_country_list();
        $data['currency_list'] = $this->Home_Model->get_currency_list();

        if ($this->form_validation->run() == FALSE) {
            $data['agent_email'] = $this->input->post('agent_email');
            $data['agency_name'] = $this->input->post('agency_name');
            $data['first_name'] = $this->input->post('first_name');
            $data['middle_name'] = $this->input->post('middle_name');
            $data['last_name'] = $this->input->post('last_name');
            $data['mobile_no'] = $this->input->post('mobile_no');
            $data['office_phone_no'] = $this->input->post('office_phone_no');
            $data['address'] = $this->input->post('address');
            $data['pin_code'] = $this->input->post('pin_code');
            $data['city'] = $this->input->post('city');
            $data['state'] = $this->input->post('state');

            $this->load->view('b2b/create_agent', $data);
        } else {
            //echo '<pre/>';print_r($_POST);exit;			
            $agent_email = $this->input->post('agent_email');
            $agent_password = md5($this->input->post('agent_password'));
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

            $email_check = $this->B2b_Model->check_email_availability($agent_email);

            if ($email_check != '' || !empty($email_check)) {
                $data['errors'] = 'Email Already Exists. Please use different email id to continue registration...';
                $this->load->view('b2b/create_agent', $data);
            } else {
                $config['upload_path'] = './public/upload_files/b2b/images/' . $agent_email . '/logos/';
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

                    $this->load->view('b2b/create_agent', $data);
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

                    $image_path = base_url() . 'public/upload_files/b2b/images/' . $agent_email . '/logos/agent_logo.png';

                    if ($this->B2b_Model->add_agent($agent_email, $agent_password, $agency_name, $currency_type, $title, $first_name, $middle_name, $last_name, $mobile_no, $office_phone_no, $address, $pin_code, $city, $state, $country, $image_path)) {
                        redirect('b2b/agent_manager', 'refresh');
                    } else {
                        $data['errors'] = 'Agent Registration Not Done. Please try after some time...';
                        $this->load->view('b2b/create_agent', $data);
                    }
                }
            }
        }
    }

    // Call Back validation 
    public function emailid_check($str) {
        if ($str == 'test') {
            $this->form_validation->set_message('emailid_check', 'The %s field can not be the word "test"');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function agent_manager() {
        $data['agent_info'] = $this->B2b_Model->get_agent_list();
        //echo '<pre/>';print_r($data['agent_info']);exit;	
        $this->load->view('b2b/agent_manager', $data);
    }

    public function view_agent_info($agent_id = '', $status = '', $errors = '') {
        $data['status'] = $status;
        $data['errors'] = $errors;
        $data['country_list'] = $this->Home_Model->get_country_list();
        $data['currency_list'] = $this->Home_Model->get_currency_list();

        $data['agent_id'] = $agent_id;
        $data['agent_info'] = $this->B2b_Model->get_agent_info_by_id($agent_id);
        //echo '<pre/>';print_r($data['agent_info']);exit;	
        $this->load->view('b2b/view_agent_info', $data);
    }

    function update_agent_info() {
        $this->form_validation->set_rules('agency_name', 'Agency/Company Name', 'trim|required');
        $this->form_validation->set_rules('currency_type', 'Currency', 'required');
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('mobile_no', 'Mobile No', 'trim|required|integer|min_length[10]');
        $this->form_validation->set_rules('office_phone_no', 'Office Phone No', 'trim|required|integer|min_length[10]');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->form_validation->set_rules('pin_code', 'Pincode', 'trim|required|integer|min_length[6]');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('state', 'State', 'trim|required');
        $this->form_validation->set_rules('country', 'Country', 'required');


        $data['status'] = '';
        $data['errors'] = '';
        $data['country_list'] = $this->Home_Model->get_country_list();
        $data['currency_list'] = $this->Home_Model->get_currency_list();

        $data['agent_id'] = $agent_id = $this->input->post('agent_id');
        $data['agent_info'] = $this->B2b_Model->get_agent_info_by_id($agent_id);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('b2b/view_agent_info', $data);
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
            $state = $this->input->post('state');
            $country = $this->input->post('country');

            $agent_email = $this->input->post('agent_email');
            $agency_logo = $this->input->post('agent_logo');

            $file_name = $_FILES['agency_logo']['tmp_name'];

            if (!empty($file_name)) {
                $config['upload_path'] = './public/upload_files/b2b/images/' . $agent_email . '/logos/';
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

                    $this->load->view('b2b/view_agent_info', $data);
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

                        $this->load->view('b2b/view_agent_info', $data); //If error, redirect to an error page
                    } else {
                        unlink($upload_data["full_path"]);

                        $image_path = base_url() . 'public/upload_files/b2b/images/' . $agent_email . '/logos/agent_logo.png';

                        if ($this->B2b_Model->update_agent($agent_id, $agency_name, $currency_type, $title, $first_name, $middle_name, $last_name, $mobile_no, $office_phone_no, $address, $pin_code, $city, $state, $country, $image_path)) {
                            redirect('b2b/view_agent_info/' . $agent_id . '/1', 'refresh');
                        } else {
                            $data['errors'] = 'Agent Profile Not Updated. Please try after some time...';
                            $this->load->view('b2b/view_agent_info', $data);
                        }
                    }
                }
            } else {
                if ($this->B2b_Model->update_agent($agent_id, $agency_name, $currency_type, $title, $first_name, $middle_name, $last_name, $mobile_no, $office_phone_no, $address, $pin_code, $city, $state, $country, $agency_logo)) {
                    redirect('b2b/view_agent_info/' . $agent_id . '/1', 'refresh');
                } else {
                    $data['errors'] = 'Agent Profile Not Updated. Please try after some time...';
                    $this->load->view('b2b/view_agent_info', $data);
                }
            }
        }
    }

    function change_agent_password($agent_id = '') {
        $this->form_validation->set_rules('password', 'New Password', 'trim|required|matches[passconf]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');

        $data['status'] = '';
        $data['errors'] = '';

        $data['agent_id'] = $agent_id;
        $data['agent_info'] = $agent_info = $this->B2b_Model->get_agent_info_by_id($agent_id);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('b2b/change_agent_password', $data);
        } else {
            if ($this->input->post('password') == $this->input->post('passconf')) {
                $password = md5($this->input->post('password'));
                if ($this->B2b_Model->update_agent_password($agent_id, $password)) {
                    $data['status'] = 1;
                } else {
                    $data['errors'] = 'Agent Password not Updated. Please try after some time...';
                }
            } else {
                $data['errors'] = 'Current Password is wrong. Please enter correct current password...';
            }

            $this->load->view('b2b/change_agent_password', $data);
        }
    }

    function manage_agent_status() {
        if (isset($_POST['agent_id']) && isset($_POST['status'])) {
            $agent_id = $_POST['agent_id'];
            $status = $_POST['status'];
            $update = $this->B2b_Model->manage_agent_status($agent_id, $status);
            echo $update;
        } else {
            return false;
        }
    }

    public function view_account_stmt($agent_id = '') {
        $data['agent_id'] = $agent_id;
        $data['agent_info'] = $this->B2b_Model->get_agent_info_by_id($agent_id);
        $data['agent_acc_summary'] = $this->B2b_Model->get_agent_acc_summary($agent_id);

        $this->load->view('b2b/view_account_stmt', $data);
    }

    function add_transaction_info() {
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
        $data['agent_info'] = $this->B2b_Model->get_agent_info_by_id($agent_id);
        $data['agent_acc_summary'] = $this->B2b_Model->get_agent_acc_summary($agent_id);

        if ($this->form_validation->run() == FALSE) {
            $data['amount'] = $this->input->post('amount');
            $data['value_date'] = $this->input->post('value_date');
            $data['bank'] = $this->input->post('bank');
            $data['branch'] = $this->input->post('branch');
            $data['city'] = $this->input->post('city');
            $data['transaction_id'] = $this->input->post('transaction_id');
            $data['remarks'] = $this->input->post('remarks');
            $this->load->view('b2b/view_account_stmt', $data);
        } else {
            //echo '<pre/>';print_r($_POST);exit;	
            $transaction_type = $this->input->post('transaction_type');
            $amount = $this->input->post('amount');
            $value_date = $this->input->post('value_date');
            $transaction_mode = $this->input->post('transaction_mode');
            $bank = $this->input->post('bank');
            $branch = $this->input->post('branch');
            $city = $this->input->post('city');
            $transaction_id = $this->input->post('transaction_id');
            $remarks = $this->input->post('remarks');

            $agent_no = $data['agent_info']->agent_no;

            if ($this->B2b_Model->add_transaction($agent_id, $agent_no, $transaction_type, $amount, $value_date, $transaction_mode, $bank, $branch, $city, $transaction_id, $remarks)) {
                $data['status'] = 1;
            } else {
                $data['errors'] = 'Transaction is not done. Please try after some time...';
            }

            redirect('b2b/view_account_stmt/' . $agent_id, 'refresh');
        }
    }

    // B2B Hotel Markup Manager	
    public function hotel_markup_manager() {
        $data['agent_list'] = $this->B2b_Model->get_active_agent_list();
        $data['api_list'] = $this->Home_Model->get_api_list();
        $data['country_list'] = $this->Home_Model->get_country_list();
        $data['b2b_markup_list'] = $this->B2b_Model->get_hotel_markup_list();
        //echo '<pre/>';print_r($data);exit;
        $this->load->view('b2b/hotel_markup_manager', $data);
    }

    // B2B Flight Markup Manager	
    public function flight_markup_manager() {
        $data['agent_list'] = $this->B2b_Model->get_active_agent_list();
        $data['api_list'] = $this->Home_Model->get_api_list();
        $data['country_list'] = $this->Home_Model->get_country_list();
        $data['b2b_markup_list'] = $this->B2b_Model->get_flight_markup_list();
        //echo '<pre/>';print_r($data);exit;
        $this->load->view('b2b/flight_markup_manager', $data);
    }

    // B2B Car Markup Manager	
    public function car_markup_manager() {
        $data['agent_list'] = $this->B2b_Model->get_active_agent_list();
        $data['api_list'] = $this->Home_Model->get_api_list();
        $data['country_list'] = $this->Home_Model->get_country_list();
        $data['b2b_markup_list'] = $this->B2b_Model->get_car_markup_list();
        //echo '<pre/>';print_r($data);exit;
        $this->load->view('b2b/car_markup_manager', $data);
    }

    public function update_b2b_markups() {
        //echo '<pre/>';print_r($_POST);exit;
        if (isset($_POST) && isset($_POST['service_type'])) {
            $agent = $_POST['agent_no'];
            $service_type = $_POST['service_type'];
            $markup_type = $_POST['markup_type'];
            $api_name = $_POST['api_name'];
            $markup = $_POST['markup'];
            $country = $_POST['country'];

            $agent_list = $this->B2b_Model->get_active_agent_list();
            $api_list = $this->Home_Model->get_api_list_by_service($service_type);

            if ($markup_type == 'generic') {
                if ($api_name == 'all' && $agent == 'all') {
                    $this->B2b_Model->delete_b2b_markup($markup_type, $service_type);

                    for ($i = 0; $i < count($agent_list); $i++) {
                        for ($j = 0; $j < count($api_list); $j++) {
                            $this->B2b_Model->add_b2b_markup($country, $agent_list[$i]->agent_no, $api_list[$j]->api_name, $markup, $markup_type, $service_type);
                        }
                    }
                } else if ($api_name != 'all' && $agent == 'all') {
                    $this->B2b_Model->delete_b2b_markup_new($markup_type, $service_type, $agent, $api_name, $country);
                    for ($i = 0; $i < count($agent_list); $i++) {
                        $this->B2b_Model->add_b2b_markup($country, $agent_list[$i]->agent_no, $api_name, $markup, $markup_type, $service_type);
                    }
                } else if ($api_name == 'all' && $agent != 'all') {
                    $this->B2b_Model->delete_b2b_markup_new($markup_type, $service_type, $agent, $api_name, $country);
                    for ($i = 0; $i < count($api_list); $i++) {
                        $this->B2b_Model->add_b2b_markup($country, $agent, $api_list[$i]->api_name, $markup, $markup_type, $service_type);
                    }
                } else if ($api_name != 'all' && $agent != 'all') {
                    $this->B2b_Model->delete_b2b_markup_new($markup_type, $service_type, $agent, $api_name, $country);
                    $this->B2b_Model->add_b2b_markup($country, $agent, $api_name, $markup, $markup_type, $service_type);
                }
            } else if ($markup_type == 'specific') {
                if ($api_name == 'all' && $agent == 'all' && $country == 'all') {
                    $this->B2b_Model->delete_b2b_markup($markup_type, $service_type, $agent, $api_name, $country);
                    for ($i = 0; $i < count($agent_list); $i++) {
                        for ($j = 0; $j < count($api_list); $j++) {
                            $this->B2b_Model->add_b2b_markup($country, $agent_list[$i]->agent_no, $api_list[$j]->api_name, $markup, $markup_type, $service_type);
                        }
                    }
                } else if ($api_name != 'all' && $agent == 'all' && $country == 'all') {
                    $this->B2b_Model->delete_b2b_markup_new($markup_type, $service_type, $agent, $api_name, $country);
                    for ($i = 0; $i < count($agent_list); $i++) {
                        $this->B2b_Model->add_b2b_markup($country, $agent_list[$i]->agent_no, $api_name, $markup, $markup_type, $service_type);
                    }
                } else if ($api_name == 'all' && $agent != 'all' && $country == 'all') {
                    $this->B2b_Model->delete_b2b_markup_new($markup_type, $service_type, $agent, $api_name, $country);
                    for ($i = 0; $i < count($api_list); $i++) {
                        $this->B2b_Model->add_b2b_markup($country, $agent, $api_list[$i]->api_name, $markup, $markup_type, $service_type);
                    }
                } else if ($api_name != 'all' && $agent != 'all' && $country == 'all') {
                    $this->B2b_Model->delete_b2b_markup_new($markup_type, $service_type, $agent, $api_name, $country);
                    $this->B2b_Model->add_b2b_markup($country, $agent, $api_name, $markup, $markup_type, $service_type);
                }


                if ($api_name == 'all' && $agent == 'all' && $country != 'all') {
                    $this->B2b_Model->delete_b2b_markup_new($markup_type, $service_type, $agent, $api_name, $country);
                    for ($i = 0; $i < count($agent_list); $i++) {
                        for ($j = 0; $j < count($api_list); $j++) {
                            $this->B2b_Model->add_b2b_markup($country, $agent_list[$i]->agent_no, $api_list[$j]->api_name, $markup, $markup_type, $service_type);
                        }
                    }
                } else if ($api_name != 'all' && $agent == 'all' && $country != 'all') {
                    $this->B2b_Model->delete_b2b_markup_new($markup_type, $service_type, $agent, $api_name, $country);
                    for ($i = 0; $i < count($agent_list); $i++) {
                        $this->B2b_Model->add_b2b_markup($country, $agent_list[$i]->agent_no, $api_name, $markup, $markup_type, $service_type);
                    }
                } else if ($api_name == 'all' && $agent != 'all' && $country != 'all') {
                    $this->B2b_Model->delete_b2b_markup_new($markup_type, $service_type, $agent, $api_name, $country);
                    for ($i = 0; $i < count($api_list); $i++) {
                        $this->B2b_Model->add_b2b_markup($country, $agent, $api_list[$i]->api_name, $markup, $markup_type, $service_type);
                    }
                } else if ($api_name != 'all' && $agent != 'all' && $country != 'all') {
                    $this->B2b_Model->delete_b2b_markup_new($markup_type, $service_type, $agent, $api_name, $country);
                    $this->B2b_Model->add_b2b_markup($country, $agent, $api_name, $markup, $markup_type, $service_type);
                }
            }

            echo '1';
        } else {
            echo '1';
        }
    }

    public function manage_b2b_markup_status() {
        if (isset($_POST['markup_id']) && isset($_POST['status'])) {
            $markup_id = $_POST['markup_id'];
            $status = $_POST['status'];
            if ($status != '2') {
                $update = $this->B2b_Model->manage_b2b_markup_status($markup_id, $status);
            } else {
                $update = $this->B2b_Model->delete_b2b_markup_status($markup_id);
            }
            echo $update;
        } else {
            return false;
        }
    }

    public function b2b_reports_manager() {

        $data['hotel_booking_summary'] = $this->B2b_Model->get_b2b_hotel_booking_summary();
        $data['int_hotel_booking_summary'] = $this->B2b_Model->get_b2b_int_hotel_booking_summary();
        //echo '<pre>';        print_r($data);exit;
        $this->load->view('b2b/b2b_reports_manager', $data);
    }

    function approve_amount() {

        //echo '<pre>'; print(; exit;
        $agent_no = $_POST['agent_no'];
        $available_balance = $_POST['available_balance'];
        $dep_amt = $_POST['dep_amt'];
        $depositno = $_POST['depositno'];
        $total = $available_balance + $dep_amt;

        //$get_sum_of_credits = $this->B2b_Model->get_sum_of_credits($agent_no); 

        $update = $this->B2b_Model->update_deposit_status($dep_amt, $depositno, $total);

        $get_sum_of_deposits = $this->B2b_Model->get_sum_of_deposits($agent_no);
        $deposit_amount = $get_sum_of_deposits;

        $update1 = $this->B2b_Model->update_deposit_request($agent_no, $total, $deposit_amount);

        redirect('home/view_deposit', 'refresh');
    }
    function hotel_voucher($Booking_reference_ID) {
        //$data['hotel_details'] = $this->B2c_Model->get_hotel_booking_info($Booking_reference_ID);
        $data["hotel_details"] = $this->B2b_Model->get_hotel_details($Booking_reference_ID);
        $data["passenger_details"] = $this->B2b_Model->get_hotel_passenger_details($Booking_reference_ID);
        $data['hot_det'] = $this->B2b_Model->get_hoteldescription($data["hotel_details"]->hotel_code);
        //echo '<pre/>';print_r($data);exit;		
        $this->load->view('b2b/ticketd', $data);
    }
     public function voucher_print($sysRefNo, $bookRefNo) {
        $data['hotel_booking_info'] = $this->B2b_Model->get_hotel_booking_information($sysRefNo, $bookRefNo);
        $data['passenger_info'] = $this->B2b_Model->get_hotel_booking_passenger_info($sysRefNo);
       // echo '<pre>';        print_r($data); exit;
        $this->load->view('b2b/voucher', $data);
    }

}

/* End of file b2b.php */
/* Location: ./admin/controllers/b2b.php */