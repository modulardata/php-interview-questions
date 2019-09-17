<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
error_reporting(1);

class B2c extends CI_Controller {

    //private $rURL;
            private $client, $xml;
    private $rURL, $ragencyID, $ruserID, $rpassword, $rversion, $rcurrency;
    private $arURL, $aruserID, $arpassword;
    private $jsearchURL, $jkey, $jpriceURL, $jbooking;
    private $sess_id;

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('B2c_Model');
        $this->load->model('Home_Model');

        $this->is_admin_logged_in();
        // ROOMSXML API CREDENTIALS
        $this->rURL = "http://roomsxmldemo.com/RXLStagingServices/ASMX/XmlService.asmx";
        $this->ragencyID = "uttpl";
        $this->ruserID = "xmltest";
        $this->rpassword = "xmltest";
        $this->rversion = "1.25";
        $this->rcurrency = "USD";
    }

    private function is_admin_logged_in() {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('login/index');
        }
    }

    function create_user() {
        $this->form_validation->set_rules('user_email', 'Email', 'trim|required|valid_email|is_unique[user_info.user_email]');
        $this->form_validation->set_rules('user_password', 'Password', 'trim|required|matches[passconf]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');
        //$this->form_validation->set_rules('user_logo', 'User Picture', 'trim|required');		
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
        $data['country_list'] = $this->Home_Model->get_country_list();

        if ($this->form_validation->run() == FALSE) {
            $data['user_email'] = $this->input->post('user_email');
            $data['first_name'] = $this->input->post('first_name');
            $data['middle_name'] = $this->input->post('middle_name');
            $data['last_name'] = $this->input->post('last_name');
            $data['mobile_no'] = $this->input->post('mobile_no');
            $data['address'] = $this->input->post('address');
            $data['pin_code'] = $this->input->post('pin_code');
            $data['city'] = $this->input->post('city');
            $data['state'] = $this->input->post('state');

            $this->load->view('b2c/create_user', $data);
        } else {
            //echo '<pre/>';print_r($_POST);exit;			
            $user_email = $this->input->post('user_email');
            $user_password = md5($this->input->post('user_password'));
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

            $email_check = $this->B2c_Model->check_email_availability($user_email);

            if ($email_check != '' || !empty($email_check)) {
                $data['errors'] = 'Email Already Exists. Please use different email id to continue registration...';
                $this->load->view('b2c/create_user', $data);
            } else {
                /* $config['upload_path'] = './public/upload_files/b2c/images/'.$user_email.'/logos/';
                  $config['allowed_types'] = 'gif|jpg|png';
                  $config['overwrite'] = TRUE;
                  $config['max_size'] = '0';
                  $config['max_width']  = '0';
                  $config['max_height']  = '0';
                  $this->load->library('upload', $config);

                  if(!is_dir($config['upload_path'])){
                  mkdir($config['upload_path'], 0755, TRUE);
                  }

                  if(!$this->upload->do_upload('user_logo'))
                  {
                  $error = $this->upload->display_errors();
                  $data['errors'] =$error;

                  $this->load->view('b2c/create_user',$data);

                  }
                  else
                  {
                  $upload_data = $this->upload->data();
                  $image_config["image_library"] = "gd2";
                  $image_config["source_image"] = $upload_data["full_path"];
                  $image_config['create_thumb'] = FALSE;
                  $image_config['maintain_ratio'] = TRUE;
                  $image_config['new_image'] = $upload_data["file_path"] . 'user_logo.png';
                  $image_config['quality'] = "100%";
                  $image_config['width'] = 320;
                  $image_config['height'] = 80;
                  $dim = (intval($upload_data["image_width"]) / intval($upload_data["image_height"])) - ($image_config['width'] / $image_config['height']);
                  $image_config['master_dim'] = ($dim > 0)? "height" : "width";

                  $this->load->library('image_lib');
                  $this->image_lib->initialize($image_config);

                  if(!$this->image_lib->resize())  //Resize image
                  {
                  $error = $this->upload->display_errors();
                  $data['errors'] =$error;

                  $this->load->view('b2c/create_user',$data); //If error, redirect to an error page
                  }
                  else
                  {
                  unlink($upload_data["full_path"]);

                  $image_path = WEB_DIR.'upload_files/b2c/images/'.$user_email.'/logos/user_logo.png';

                  if($this->B2c_Model->add_user($user_email,$user_password,$title,$first_name,$middle_name,$last_name,$mobile_no,$address,$pin_code,$city,$state,$country,$image_path))
                  {
                  redirect('b2c/user_manager','refresh');
                  }
                  else
                  {
                  $data['errors'] = 'User Registration Not Done. Please try after some time...';
                  $this->load->view('b2c/user_manager',$data);

                  }
                  }

                  }
                 */

                $image_path = '';

                if ($this->B2c_Model->add_user($user_email, $user_password, $title, $first_name, $middle_name, $last_name, $mobile_no, $address, $pin_code, $city, $state, $country, $image_path)) {
                    redirect('b2c/user_manager', 'refresh');
                } else {
                    $data['errors'] = 'User Registration Not Done. Please try after some time...';
                    $this->load->view('b2c/user_manager', $data);
                }
            }
        }
    }

    public function user_manager() {
        $data['user_info'] = $this->B2c_Model->get_user_list();
        //echo '<pre/>';print_r($data['user_info']);exit;	
        $this->load->view('b2c/user_manager', $data);
    }

    function manage_user_status() {
        if (isset($_POST['user_id']) && isset($_POST['status'])) {
            $user_id = $_POST['user_id'];
            $status = $_POST['status'];
            $update = $this->B2c_Model->manage_user_status($user_id, $status);
            echo $update;
        } else {
            return false;
        }
    }

    public function view_user_info($user_id = '', $status = '', $errors = '') {
        $data['status'] = $status;
        $data['errors'] = $errors;
        $data['country_list'] = $this->Home_Model->get_country_list();

        $data['user_id'] = $user_id;
        $data['user_info'] = $this->B2c_Model->get_user_info_by_id($user_id);

        $this->load->view('b2c/view_user_info', $data);
    }

    function update_user_info() {
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
        $data['country_list'] = $this->Home_Model->get_country_list();

        $data['user_id'] = $user_id = $this->input->post('user_id');
        $data['user_info'] = $this->B2c_Model->get_user_info_by_id($user_id);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('b2c/view_user_info', $data);
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

            /* $file_name = $_FILES['user_logo']['tmp_name'];

              if(!empty($file_name))
              {
              $config['upload_path'] = './upload_files/b2c/images/'.$user_email.'/logos/';
              $config['allowed_types'] = 'gif|jpg|png';
              $config['overwrite'] = TRUE;
              $config['max_size'] = '0';
              $config['max_width']  = '0';
              $config['max_height']  = '0';
              $this->load->library('upload', $config);

              if(!is_dir($config['upload_path'])){
              mkdir($config['upload_path'], 0755, TRUE);
              }

              if(!$this->upload->do_upload('user_logo'))
              {
              $error = $this->upload->display_errors();
              $data['errors'] =$error;

              $this->load->view('b2c/view_user_info',$data);

              }
              else
              {
              $upload_data = $this->upload->data();
              $image_config["image_library"] = "gd2";
              $image_config["source_image"] = $upload_data["full_path"];
              $image_config['create_thumb'] = FALSE;
              $image_config['maintain_ratio'] = TRUE;
              $image_config['new_image'] = $upload_data["file_path"] . 'user_logo.png';
              $image_config['quality'] = "100%";
              $image_config['width'] = 320;
              $image_config['height'] = 80;
              $dim = (intval($upload_data["image_width"]) / intval($upload_data["image_height"])) - ($image_config['width'] / $image_config['height']);
              $image_config['master_dim'] = ($dim > 0)? "height" : "width";

              $this->load->library('image_lib');
              $this->image_lib->initialize($image_config);

              if(!$this->image_lib->resize())  //Resize image
              {
              $error = $this->upload->display_errors();
              $data['errors'] =$error;

              $this->load->view('b2c/view_user_info',$data); //If error, redirect to an error page
              }
              else
              {
              unlink($upload_data["full_path"]);

              $image_path = WEB_DIR.'upload_files/b2c/images/'.$agent_email.'/logos/user_logo.png';

              if($this->B2c_Model->update_user($user_id,$title,$first_name,$middle_name,$last_name,$mobile_no,$address,$pin_code,$city,$state,$country,$image_path))
              {
              redirect('b2c/view_user_info/'.$user_id.'/1','refresh');
              }
              else
              {
              $data['errors'] = 'User Profile Not Updated. Please try after some time...';
              $this->load->view('b2c/view_user_info',$data);

              }
              }

              }


              }
              else
              {
              if($this->B2c_Model->update_user($user_id,$title,$first_name,$middle_name,$last_name,$mobile_no,$address,$pin_code,$city,$state,$country,$user_logo))
              {
              redirect('b2c/view_user_info/'.$user_id.'/1','refresh');
              }
              else
              {
              $data['errors'] = 'User Profile Not Updated. Please try after some time...';
              $this->load->view('b2c/view_user_info',$data);

              }
              }
             */

            if ($this->B2c_Model->update_user($user_id, $title, $first_name, $middle_name, $last_name, $mobile_no, $address, $pin_code, $city, $state, $country, $user_logo)) {
                redirect('b2c/view_user_info/' . $user_id . '/1', 'refresh');
            } else {
                $data['errors'] = 'User Profile Not Updated. Please try after some time...';
                $this->load->view('b2c/view_user_info', $data);
            }
        }
    }

    function change_user_password($user_id = '') {
        $this->form_validation->set_rules('password', 'New Password', 'trim|required|matches[passconf]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');

        $data['status'] = '';
        $data['errors'] = '';

        $data['user_id'] = $user_id;
        $data['user_info'] = $user_info = $this->B2c_Model->get_user_info_by_id($user_id);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('b2c/change_user_password', $data);
        } else {
            if ($this->input->post('password') == $this->input->post('passconf')) {
                $password = md5($this->input->post('password'));
                if ($this->B2c_Model->update_user_password($user_id, $password)) {
                    $data['status'] = 1;
                } else {
                    $data['errors'] = 'User Password not Updated. Please try after some time...';
                }
            } else {
                $data['errors'] = 'Current Password is wrong. Please enter correct current password...';
            }

            $this->load->view('b2c/change_user_password', $data);
        }
    }

    // B2C Hotel Markup Manager
    public function hotel_markup_manager() {
        $data['api_list'] = $this->Home_Model->get_api_list();
        $data['country_list'] = $this->Home_Model->get_country_list();
        $data['b2c_markup_list'] = $this->B2c_Model->get_hotel_markup_list();
        //echo '<pre/>';print_r($data);exit;
        $this->load->view('b2c/hotel_markup_manager', $data);
    }

    // B2C Flight Markup Manager
    public function flight_markup_manager() {
        $data['api_list'] = $this->Home_Model->get_api_list();
        $data['country_list'] = $this->Home_Model->get_country_list();
        $data['b2c_markup_list'] = $this->B2c_Model->get_flight_markup_list();
        //echo '<pre/>';print_r($data);exit;
        $this->load->view('b2c/flight_markup_manager', $data);
    }

    // B2C Car Markup Manager
    public function car_markup_manager() {
        $data['api_list'] = $this->Home_Model->get_api_list();
        $data['country_list'] = $this->Home_Model->get_country_list();
        $data['b2c_markup_list'] = $this->B2c_Model->get_car_markup_list();
        //echo '<pre/>';print_r($data);exit;
        $this->load->view('b2c/car_markup_manager', $data);
    }

    function update_b2c_markups() {
        if (isset($_POST) && isset($_POST['service_type'])) {
            $service_type = $_POST['service_type'];
            $markup_type = $_POST['markup_type'];
            $api_name = $_POST['api_name'];
            $markup = $_POST['markup'];
            $country = $_POST['country'];

            if ($api_name == 'all') {
                if ($markup_type == 'generic') {
                    $this->B2c_Model->delete_b2c_markup($markup_type, $service_type);
                }

                $api_list = $this->Home_Model->get_api_list();

                for ($i = 0; $i < count($api_list); $i++) {
                    if ($api_list[$i]->service_type == $service_type) {
                        $check = $this->B2c_Model->b2c_markup_checking($country, $api_list[$i]->api_name, $markup_type, $service_type);

                        if ($check == '') {
                            $this->B2c_Model->add_b2c_markup($country, $api_list[$i]->api_name, $markup, $markup_type, $service_type);
                        } else {
                            $this->B2c_Model->delete_id_b2c_markup($country, $api_list[$i]->api_name, $markup_type, $service_type);

                            $this->B2c_Model->add_b2c_markup($country, $api_list[$i]->api_name, $markup, $markup_type, $service_type);
                        }
                    }
                }
            } else {
                $check = $this->B2c_Model->b2c_markup_checking($country, $api_name, $markup_type, $service_type);
                if ($check == '') {
                    $this->B2c_Model->add_b2c_markup($country, $api_name, $markup, $markup_type, $service_type);
                } else {
                    $this->B2c_Model->delete_id_b2c_markup($country, $api_name, $markup_type, $service_type);
                    $this->B2c_Model->add_b2c_markup($country, $api_name, $markup, $markup_type, $service_type);
                }
            }

            echo '1';
        } else {
            echo '1';
        }
    }

    function manage_b2c_markup_status() {
        if (isset($_POST['markup_id']) && isset($_POST['status'])) {
            $markup_id = $_POST['markup_id'];
            $status = $_POST['status'];
            if ($status != '2') {
                $update = $this->B2c_Model->manage_b2c_markup_status($markup_id, $status);
            } else {
                $update = $this->B2c_Model->delete_b2c_markup_status($markup_id);
            }
            echo $update;
        } else {
            return false;
        }
    }

    public function b2c_reports_manager() {

        $data['hotel_booking_summary'] = $this->B2c_Model->get_b2c_hotel_booking_summary();
        $data['int_hotel_booking_summary'] = $this->B2c_Model->get_b2c_int_hotel_booking_summary();


//        echo '<pre/>';
//        print_r($data);
//        exit;
        $this->load->view('b2c/b2c_reports_manager', $data);
    }

    function hotel_voucher($Booking_reference_ID) {
        //$data['hotel_details'] = $this->B2c_Model->get_hotel_booking_info($Booking_reference_ID);
        $data["hotel_details"] = $this->B2c_Model->get_hotel_details($Booking_reference_ID);
        $data["passenger_details"] = $this->B2c_Model->get_hotel_passenger_details($Booking_reference_ID);
        $data['hot_det'] = $this->B2c_Model->get_hoteldescription($data["hotel_details"]->hotel_code);
        //echo '<pre/>';print_r($data);exit;		
        $this->load->view('b2c/ticketd', $data);
    }

    public function voucher_print($sysRefNo, $bookRefNo) {
        $data['hotel_booking_info'] = $this->B2c_Model->get_hotel_booking_information($sysRefNo, $bookRefNo);
        $data['passenger_info'] = $this->B2c_Model->get_hotel_booking_passenger_info($sysRefNo);
        // echo '<pre>';        print_r($data); exit;
        $this->load->view('b2c/voucher', $data);
    }

    function hotel_cancel($Booking_reference_ID, $surname, $email, $case) {


        $url = "http://api.travelguru.com/services-2.0/tg-services/TGBookingServiceEndPoint";
        $xml2 = '<?xml version="1.0" encoding="UTF-8"?>
        <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ns="http://www.opentravel.org/OTA/2003/05">
	<soapenv:Header/>
	<soapenv:Body>
		<ns:OTA_CancelRQ CancelType="' . $case . '" Version="1.0">
			<ns:POS>
				<ns:Source>
						<ns:RequestorID ID="1300001010"  MessagePassword="srg|ind|@">
						<ns:CompanyName Code="srgi_indianet"/>
                                                </ns:RequestorID>
				</ns:Source>
			</ns:POS>
			<ns:UniqueID ID="' . $Booking_reference_ID . '"/>
			<ns:Verification>
				<ns:PersonName>
					<ns:Surname>' . $surname . '</ns:Surname>
				</ns:PersonName>
				<ns:Email>' . $email . '</ns:Email>
			</ns:Verification>
			<ns:TPA_Extensions>
				<ns:CancelDates>	
				</ns:CancelDates>
			</ns:TPA_Extensions>
		</ns:OTA_CancelRQ>
	</soapenv:Body>
</soapenv:Envelope> ';

        // echo $xml2;

        ini_set('max_execution_time', 60);
        $header[] = "Content-Type: text/xml; charset=utf-8";
        $header[] = "Content-length: " . strlen($xml2);
        $header[] = "SOAPAction: http://api.travelguru.com/services-2.0/tg-services/TGServiceEndPoint?wsdl";

// Create CURL Connection
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_USERAGENT, '');
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 180);
        curl_setopt($ch, CURLOPT_FAILONERROR, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml2);

        $curlresp = curl_exec($ch);
        $error2 = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if ($case == 'Initiate') {
            $data['Ref_id'] = $Booking_reference_ID;
            $data['surname'] = $surname;
            $data['email'] = $email;
            $data['curlresp'] = $curlresp;
            $this->load->view('b2c/cancel_confirm', $data);
        }
//        echo '<pre/>';
//        print_r($curlresp);
//        exit;
    }

    function hotel_cancel_confirm() {
        $Ref_id = $_POST['Ref_id'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $url = "http://api.travelguru.com/services-2.0/tg-services/TGBookingServiceEndPoint";
        $xml2 = '<?xml version="1.0" encoding="UTF-8"?>
        <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ns="http://www.opentravel.org/OTA/2003/05">
	<soapenv:Header/>
	<soapenv:Body>
		<ns:OTA_CancelRQ CancelType="Cancel" Version="1.0">
			<ns:POS>
				<ns:Source>
						<ns:RequestorID ID="1300001010"  MessagePassword="srg|ind|@">
						<ns:CompanyName Code="srgi_indianet"/>
                                                </ns:RequestorID>
				</ns:Source>
			</ns:POS>
			<ns:UniqueID ID="' . $Ref_id . '"/>
			<ns:Verification>
				<ns:PersonName>
					<ns:Surname>' . $surname . '</ns:Surname>
				</ns:PersonName>
				<ns:Email>' . $email . '</ns:Email>
			</ns:Verification>
			<ns:TPA_Extensions>
				<ns:CancelDates>	
				</ns:CancelDates>
			</ns:TPA_Extensions>
		</ns:OTA_CancelRQ>
	</soapenv:Body>
</soapenv:Envelope> ';

        // echo $xml2;

        ini_set('max_execution_time', 60);
        $header[] = "Content-Type: text/xml; charset=utf-8";
        $header[] = "Content-length: " . strlen($xml2);
        $header[] = "SOAPAction: http://api.travelguru.com/services-2.0/tg-services/TGServiceEndPoint?wsdl";

// Create CURL Connection
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_USERAGENT, '');
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 180);
        curl_setopt($ch, CURLOPT_FAILONERROR, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml2);

        $curlresp = curl_exec($ch);
        $error2 = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $data['Ref_id'] = $Ref_id;
        $data['surname'] = $surname;
        $data['email'] = $email;
        $data['curlresp'] = $curlresp;
        $this->B2c_Model->update_b2c_hotel_booking_status($Ref_id);
        $this->load->view('b2c/book_canceled', $data);
    }

    function cancel_voucher($RefNo, $Booking_reference_ID) {
        $cancel_create = '
<BookingCancel>
    <Authority>
        <Org>' . $this->ragencyID . '</Org>
        <User>' . $this->ruserID . '</User> 
        <Password>' . $this->rpassword . '</Password> 
        <Currency>' . $this->rcurrency . '</Currency>
        <Version>' . $this->rversion . '</Version>
    </Authority>
    <BookingId>' . $Booking_reference_ID . '</BookingId>
    <CommitLevel>prepare</CommitLevel>
</BookingCancel>
';

        //echo $cancel_create; //exit;
        $cancel_resp = $this->PostRQ($cancel_create);
        //echo '';
        //print_r($cancel_resp); //exit;
        $dom2 = new DOMDocument();
        $dom2->loadXML($cancel_resp);
        $Currency = $dom2->getElementsByTagName('Currency')->item(0)->nodeValue;
        $CommitLevel = $dom2->getElementsByTagName('CommitLevel')->item(0)->nodeValue;

        $Booking = $dom2->getElementsByTagName('Booking');
        foreach ($Booking as $val) {
            $Book_reference = $val->getElementsByTagName('Id')->item(0)->nodeValue;
            $Book_CreationDate = $val->getElementsByTagName('CreationDate')->item(0)->nodeValue;
            $HotelBooking = $val->getElementsByTagName('HotelBooking');
            foreach ($HotelBooking as $val1) {
                $Id.= $val1->getElementsByTagName('Id')->item(0)->nodeValue;
                $HotelId = $val1->getElementsByTagName('HotelId')->item(0)->nodeValue;
                $HotelName = $val1->getElementsByTagName('HotelName')->item(0)->nodeValue;
                $CreationDate = $val1->getElementsByTagName('CreationDate')->item(0)->nodeValue;
                $ArrivalDate = $val1->getElementsByTagName('ArrivalDate')->item(0)->nodeValue;
                $Nights = $val1->getElementsByTagName('Nights')->item(0)->nodeValue;
                $TotalSellingPrice = $val1->getElementsByTagName('TotalSellingPrice')->item(0)->nodeValue;
                $Status = $val1->getElementsByTagName('Status')->item(0)->nodeValue;

                $Room = $val1->getElementsByTagName('Room');
                foreach ($Room as $val2) {
                    $CanxFees = $val2->getElementsByTagName('CanxFees');
                    foreach ($CanxFees as $val3) {
                        $Fee = $val3->getElementsByTagName('Fee')->item(0)->getAttribute('from');
                        $Fee1 = $val3->getElementsByTagName('CanxFees');
                        //  foreach ($Fee1 as $val4) {
                        $Amount+= $val3->getElementsByTagName('Amount')->item(0)->getAttribute('amt');
                        //  }
                    }
                }
            }
        }
        $cancel_array = array(
            'HotelId' => $HotelId,
            'HotelName' => $HotelName,
            'CreationDate' => $CreationDate,
            'ArrivalDate' => $ArrivalDate,
            'Book_reference' => $Book_reference,
            'Book_CreationDate' => $Book_CreationDate,
            'Currency' => $Currency,
            'Nights' => $Nights,
            'Status' => $Status,
            'l_date' => $Fee,
            'Amount' => $Amount
        );
        $this->session->set_userdata('cancel_data', $cancel_array);
        $this->load->view('b2c/rooms_cancel_confirm', $data);



//        echo '<pre>';
//        print_r($Amount);
//        exit;
    }

    function rooms_hotel_cancel_confirm() {
        $Book_reference = $_POST['Book_reference'];
        $cancel_create = '
<BookingCancel>
    <Authority>
        <Org>' . $this->ragencyID . '</Org>
        <User>' . $this->ruserID . '</User> 
        <Password>' . $this->rpassword . '</Password> 
        <Currency>' . $this->rcurrency . '</Currency>
        <Version>' . $this->rversion . '</Version>
    </Authority>
    <BookingId>' . $Book_reference . '</BookingId>
    <CommitLevel>confirm</CommitLevel>
</BookingCancel>
';

        // echo $cancel_create; //exit;
        $cancel_resp = $this->PostRQ($cancel_create);
//        echo '<pre>';
//        print_r($cancel_resp);
//        exit;
        $dom2 = new DOMDocument();
        $dom2->loadXML($cancel_resp);
        $Currency = $dom2->getElementsByTagName('Currency')->item(0)->nodeValue;
        $CommitLevel = $dom2->getElementsByTagName('CommitLevel')->item(0)->nodeValue;

        $Booking = $dom2->getElementsByTagName('Booking');
        foreach ($Booking as $val) {
            $Book_reference = $val->getElementsByTagName('Id')->item(0)->nodeValue;
            $Book_CreationDate = $val->getElementsByTagName('CreationDate')->item(0)->nodeValue;
            $HotelBooking = $val->getElementsByTagName('HotelBooking');
            foreach ($HotelBooking as $val1) {
                $Id.= $val1->getElementsByTagName('Id')->item(0)->nodeValue;
                $HotelId = $val1->getElementsByTagName('HotelId')->item(0)->nodeValue;
                $HotelName = $val1->getElementsByTagName('HotelName')->item(0)->nodeValue;
                $CreationDate = $val1->getElementsByTagName('CreationDate')->item(0)->nodeValue;
                $ArrivalDate = $val1->getElementsByTagName('ArrivalDate')->item(0)->nodeValue;
                $Nights = $val1->getElementsByTagName('Nights')->item(0)->nodeValue;
                $TotalSellingPrice = $val1->getElementsByTagName('TotalSellingPrice')->item(0)->nodeValue;
                $Status = $val1->getElementsByTagName('Status')->item(0)->nodeValue;

                $Room = $val1->getElementsByTagName('Room');
                foreach ($Room as $val2) {
                    $CanxFees = $val2->getElementsByTagName('CanxFees');
                    foreach ($CanxFees as $val3) {
                        $Fee = $val3->getElementsByTagName('Fee')->item(0)->getAttribute('from');
                        $Fee1 = $val3->getElementsByTagName('CanxFees');
                        //  foreach ($Fee1 as $val4) {
                        $Amount+= $val3->getElementsByTagName('Amount')->item(0)->getAttribute('amt');
                        //  }
                    }
                }
            }
        }
        $cancel_confirm_array = array(
            'HotelId' => $HotelId,
            'HotelName' => $HotelName,
            'CreationDate' => $CreationDate,
            'ArrivalDate' => $ArrivalDate,
            'Book_reference' => $Book_reference,
            'Book_CreationDate' => $Book_CreationDate,
            'Currency' => $Currency,
            'Nights' => $Nights,
            'Status' => $Status,
            'l_date' => $Fee,
            'Amount' => $Amount
        );
        $this->session->set_userdata('cancel_confirm_array', $cancel_confirm_array);
        $this->B2c_Model->update_b2c_rooms_hotel_booking_status($Book_reference);
        
        $this->load->view('b2c/rooms_cancel_confirmed');



//        echo '<pre>';
//        print_r($Amount);
//        exit;
    }

    public function PostRQ($cancel_create) {

//echo $xml_data;exit;
        $ch2 = curl_init();
        curl_setopt($ch2, CURLOPT_URL, $this->rURL);
        curl_setopt($ch2, CURLOPT_TIMEOUT, 0);
        curl_setopt($ch2, CURLOPT_HEADER, 0);
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch2, CURLOPT_POST, 1);
        curl_setopt($ch2, CURLOPT_POSTFIELDS, $cancel_create);
        curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch2, CURLOPT_SSLVERSION, 3);
//curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, true);

        $httpHeader2 = array("Content-Type: text/xml; charset=UTF-8", "Content-Encoding: UTF-8");
        curl_setopt($ch2, CURLOPT_HTTPHEADER, $httpHeader2);
        curl_setopt($ch2, CURLOPT_ENCODING, "gzip");

// Execut	e request, store response and HTTP response code
        $curlresp = curl_exec($ch2);
        $error2 = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
        curl_close($ch2);
        return $curlresp;
    }

}

/* End of file b2c.php */
/* Location: ./admin/controllers/b2c.php */