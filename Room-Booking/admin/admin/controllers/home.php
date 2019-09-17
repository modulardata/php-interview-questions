<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
error_reporting(0);


class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Home_Model');
        $this->load->model('B2b_Model');

        $this->is_logged_in();
    }

    public function index() {
        $this->load->view('dashboard');
    }

    private function is_logged_in() {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('login/admin_login');
        }
    }

    function dashboard() {
        $this->load->view('dashboard');
    }

    function my_profile($status = '') {
        $data['status'] = $status;
        $admin_id = $this->session->userdata('admin_id');
        $data['admin_info'] = $this->Home_Model->get_admin_info($admin_id);
        $this->load->view('account/my_profile', $data);
    }

    function view_deposit() {
        $data['agent_acc_summary'] = $this->Home_Model->get_all_agent_acc_summary();
        $data['agent_acc_summary_approved'] = $this->Home_Model->get_all_approved__agent_acc_summary();
        $data['agent_acc_summary_pending'] = $this->Home_Model->get_all_pending_agent_acc_summary();
//echo '<pre>';print_r(  $data['agent_acc_summary']); exit;

        $this->load->view('b2b/view_deposit', $data);
    }

    function update_profile() {
        $this->form_validation->set_rules('login_email', 'Email-Id', 'trim|required|valid_email');
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('mobile_no', 'Mobile No', 'trim|required|integer|min_length[10]');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('pin_code', 'Pin Code', 'trim|required|integer|min_length[6]');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('state', 'State', 'trim|required');

        $errors = 1;
        if ($this->form_validation->run() == FALSE) {
            redirect('home/my_profile/' . $errors, 'refresh');
        } else {
            //echo '<pre/>';print_r($_POST);exit;
            $login_email = $this->input->post('login_email');
            $title = $this->input->post('title');
            $first_name = $this->input->post('first_name');
            $middle_name = $this->input->post('middle_name');
            $last_name = $this->input->post('last_name');
            $mobile_no = $this->input->post('mobile_no');
            $address = $this->input->post('address');
            $pin_code = $this->input->post('pin_code');
            $city = $this->input->post('city');
            $state = $this->input->post('state');

            if ($this->Home_Model->update_admin_profile($login_email, $title, $first_name, $middle_name, $last_name, $mobile_no, $address, $pin_code, $city, $state))
                $errors = 0;
        }

        redirect('home/my_profile/' . $errors, 'refresh');
    }

    function change_password() {
        $this->form_validation->set_rules('cpassword', 'Current Password', 'trim|required');
        $this->form_validation->set_rules('password', 'New Password', 'trim|required|matches[passconf]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');

        $data['status'] = '';
        $data['errors'] = '';

        $admin_id = $this->session->userdata('admin_id');
        $data['admin_info'] = $admin_info = $this->Home_Model->get_admin_info($admin_id);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('account/change_password', $data);
        } else {
            if ($admin_info->login_password == md5($this->input->post('cpassword')) && $this->input->post('password') == $this->input->post('passconf')) {
                $password = md5($this->input->post('password'));
                if ($this->Home_Model->update_admin_password($admin_id, $password)) {
                    $data['status'] = 1;
                } else {
                    $data['errors'] = 1;
                }
            } else {
                $data['errors'] = 2;
            }

            $this->load->view('account/change_password', $data);
        }
    }

    public function currency_manager() {
        $data['currency_list'] = $this->Home_Model->get_currency_list();
        //echo '<pre/>';print_r($data['currency_list']);exit;	
        $this->load->view('home/currency_manager', $data);
    }

    public function manage_currency_status() {
        if (isset($_POST['currency_id']) && isset($_POST['status'])) {
            $currency_id = $_POST['currency_id'];
            $status = $_POST['status'];
            $update = $this->Home_Model->manage_currency_status($currency_id, $status);
            echo $update;
        } else {
            return false;
        }
    }

    public function get_currency_value($from_Currency, $to_Currency, $amount) {
        $amount = urlencode($amount);
        $from_Currency = urlencode($from_Currency);
        $to_Currency = urlencode($to_Currency);
        $url = "http://www.google.com/ig/calculator?hl=en&q=$amount$from_Currency=?$to_Currency";
        $ch = curl_init();
        $timeout = 0;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $rawdata = curl_exec($ch);
        curl_close($ch);
        //print '<pre/>';print_r($rawdata);exit;	
        $data = explode('"', $rawdata);
        $data = explode(' ', $data['3']);
        $var = $data['0'];
        return round($var, 3);
    }

    function currencyImport($from_Currency, $to_Currency) {
        $url = 'http://finance.yahoo.com/d/quotes.csv?e=.csv&f=sl1d1t1&s=' . $from_Currency . $to_Currency . '=X';
        $handle = @fopen($url, 'r');

        if ($handle) {
            $result = fgets($handle, 4096);
            fclose($handle);
        }

        $currencyData = explode(',', $result);
        return $currencyData[1];
    }

    public function update_currency_values() {
        $currency_list = $this->Home_Model->get_currency_list();
        //print '<pre/>';print_r($currency_list);		

        for ($i = 0; $i < count($currency_list); $i++) {
            $from_Currency = 'USD';
            $to_Currency = $currency_list[$i]->currency_code;
            //$amount = 1;

            $currency_val = $this->currencyImport($from_Currency, $to_Currency);

            $currency_id = $currency_list[$i]->currency_id;
            $updated = $this->Home_Model->update_currency_values($currency_id, $currency_val);
        }

        echo $updated;
    }

    public function api_manager() {
        $data['hotel_api_list'] = $this->Home_Model->get_hotel_apis();
        $data['flight_api_list'] = $this->Home_Model->get_flight_apis();
        $data['car_api_list'] = $this->Home_Model->get_car_apis();
        //echo '<pre/>';print_r($data);exit;	
        $this->load->view('home/api_manager', $data);
    }

    public function manage_api_status() {
        if (isset($_POST['api_id']) && isset($_POST['status'])) {
            $api_id = $_POST['api_id'];
            $status = $_POST['status'];
            $update = $this->Home_Model->manage_api_status($api_id, $status);
            echo $update;
        } else {
            return false;
        }
    }

    public function payment_manager() {
        $data['payment_charge_list'] = $this->Home_Model->get_payment_gateway_charges();
        //echo '<pre/>';print_r($data);exit;	
        $this->load->view('home/payment_gateway_manager', $data);
    }

    public function manage_payment_charge_status() {
        if (isset($_POST['id']) && isset($_POST['status'])) {
            $id = $_POST['id'];
            $status = $_POST['status'];
            $update = $this->Home_Model->manage_payment_charge_status($id, $status);
            echo $update;
        } else {
            return false;
        }
    }

    public function edit_payment_charge($id = '') {
        $this->form_validation->set_rules('charge', 'Payment Charge', 'trim|required|integer|max_length[2]');

        $data['status'] = '';
        $data['errors'] = '';

        $data['id'] = $id;
        $data['payment_info'] = $payment_info = $this->Home_Model->get_payment_charge($id);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('home/edit_payment_charge', $data);
        } else {
            $charge = $this->input->post('charge');
            if ($this->Home_Model->update_payment_charge($id, $charge)) {
                redirect('home/payment_manager', 'refresh');
            } else {
                $data['errors'] = 'Payment charge not updated...';
                $this->load->view('home/edit_payment_charge', $data);
            }
        }
    }

    // Promotion Manager
    public function promotion_manager() {
        $data['promotion_list'] = $this->Home_Model->get_promotion_list();
        //echo '<pre/>';print_r($data);exit;
        $this->load->view('home/promotion_manager', $data);
    }

    public function add_promotion() {
        $this->form_validation->set_rules('service_type', 'Service Type', 'required');
        $this->form_validation->set_rules('promo_name', 'Promotion Name', 'trim|required');
        $this->form_validation->set_rules('promo_code', 'Promotion Code', 'trim|required');
        $this->form_validation->set_rules('discount', 'Discount', 'trim|required|integer|max_length[3]');
        $this->form_validation->set_rules('promo_expire', 'Valid Upto', 'required');

        $data['promotion_list'] = $this->Home_Model->get_promotion_list();

        if ($this->form_validation->run() == FALSE) {
            $data['promo_name'] = $this->input->post('promo_name');
            $data['promo_code'] = $this->input->post('promo_code');
            $data['discount'] = $this->input->post('discount');
            $data['promo_expire'] = $this->input->post('promo_expire');

            $this->load->view('home/promotion_manager', $data);
        } else {
            //echo '<pre/>';print_r($_POST);exit;
            $service_type = $this->input->post('service_type');
            $promo_name = $this->input->post('promo_name');
            $promo_code = $this->input->post('promo_code');
            $discount = $this->input->post('discount');
            $promo_expire = $this->input->post('promo_expire');

            $this->Home_Model->add_promotion($service_type, $promo_name, $promo_code, $discount, $promo_expire);

            redirect('home/promotion_manager', 'refresh');
        }
    }

    public function manage_promotion_status() {
        if (isset($_POST['promo_id']) && isset($_POST['status'])) {
            $promo_id = $_POST['promo_id'];
            $status = $_POST['status'];
            $update = $this->Home_Model->manage_promotion_status($promo_id, $status);
            echo $update;
        } else {
            return false;
        }
    }

    public function edit_promotion($promo_id = '') {
        $this->form_validation->set_rules('service_type', 'Service Type', 'required');
        $this->form_validation->set_rules('promo_name', 'Promotion Name', 'trim|required');
        $this->form_validation->set_rules('promo_code', 'Promotion Code', 'trim|required');
        $this->form_validation->set_rules('discount', 'Discount', 'trim|required|integer|max_length[3]');
        $this->form_validation->set_rules('promo_expire', 'Valid Upto', 'required');

        $data['status'] = '';
        $data['errors'] = '';

        $data['promo_id'] = $promo_id;
        $data['promotion_list'] = $this->Home_Model->get_promotion_by_promo_id($promo_id);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('home/edit_promotion', $data);
        } else {
            $service_type = $this->input->post('service_type');
            $promo_name = $this->input->post('promo_name');
            $promo_code = $this->input->post('promo_code');
            $discount = $this->input->post('discount');
            $promo_expire = $this->input->post('promo_expire');

            if ($this->Home_Model->update_promotion($promo_id, $service_type, $promo_name, $promo_code, $discount, $promo_expire)) {
                redirect('home/promotion_manager', 'refresh');
            } else {
                $data['errors'] = 'Promotion values not updated...';
                $this->load->view('home/edit_promotion', $data);
            }
        }
    }

    public function b2b_deposite_approve($depositno, $agentno) {
        $available = '0';
        $deposite = '0';

        $status = 'Accepted';
        $data['agentno'] = $agentno;
        $data['depositno'] = $depositno;
        $agent_available_balance = $this->B2b_Model->get_agent_available_balance($agentno);
        $available = $agent_available_balance->closing_balance;
        $deposite = $this->Home_Model->get_approved_amount($depositno);

        //$available = $this->Home_Model->get_available_balance($agentno);
        $data['deposit'] = $deposite->deposit_amount;
        $data['transact_id'] = $deposite->transaction_id;
        $data['bank'] = $deposite->bank;
        $data['branch'] = $deposite->branch;
        $data['city'] = $deposite->city;


        $data['available_balance'] = $available;
        $this->load->view('b2b/approve_page', $data);
    }

}

/* End of file home.php */
/* Location: ./admin/controllers/home.php */