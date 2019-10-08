<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {
    
    public function __construct() {
        parent::__construct();

        $this->load->library('session');
        $this->load->helper('permission');
        
        if($this->uri->segment(3) == 'logout'){
            $this->session->unset_userdata("admin");
            redirect('/');
        }
        
		if ($this->session->userdata("admin") != NULL){
            if( hasPermissionInArray( ['economic_team'], $this->session->userdata("admin")))
                redirect("admin/airdrop/payment");
            if( hasPermissionInArray( ['customer_manager'], $this->session->userdata("admin")))
                redirect("admin/user/customers");
            redirect("admin/airdrop");
        }
            
        $this->load->model('login_model');
        $this->load->helper('google_authenticator');
        $this->load->helper('form');
        $this->load->helper('alert');
        $this->load->helper('language');
        $this->load->helper('messages');
        messages_helper();
        $language = "english";
        $this->lang->load($language, $language);
    }

    public function hash($string){
        return hash('sha512', $string . config_item('encryption_key'));
    }
    
    function check_captcha($google_captcha){
        // return TRUE;
        if(!isset($google_captcha) || empty($google_captcha)){
            return FALSE;
        }
        // add your secret key hear
        $google_recaptcha = trim($google_captcha);
        $google_userIp=  $_SERVER['REMOTE_ADDR'];
        $google_secret= config_item("google_secret_key");
        $captcha_data = array(
            'secret' => "$google_secret",
            'response' => "$google_recaptcha",
            'remoteip' =>"$google_userIp"
        );

        $captcha_verify = curl_init();
        curl_setopt($captcha_verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($captcha_verify, CURLOPT_POST, true);
        curl_setopt($captcha_verify, CURLOPT_POSTFIELDS, http_build_query($captcha_data));
        curl_setopt($captcha_verify, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($captcha_verify, CURLOPT_RETURNTRANSFER, true);
        $captcha_response = curl_exec($captcha_verify);
        $captcha_status= json_decode($captcha_response, true);
        if(empty($captcha_status['success'])){
            return FALSE;
        }else{
            return TRUE;
        }
    }

    public function index(){
        $GA = new GoogleAuthenticator();

        if(isset($_POST) && !empty($_POST)){
            if(isset($_POST['password'])){

                // if(!$this->check_captcha($this->input->post('hiddenRecaptcha'))){
                //     file_put_contents("system/logs.html","ADMIN LOGIN: g-recaptcha-response : DENY<br>",FILE_APPEND);
                //     redirect('adminlogin');
                //     return;
                // }

                $data = [];
                $data['email'] = $this->input->post('email', TRUE);
                $data['password'] = $this->input->post('password', TRUE);
                $merged_info = $this->login_model->check_login_data($data, true);
                
                if($merged_info === false){     //failed
                    $this->session->set_flashdata('error', lang('incorrect_email_or_username'));
                    redirect('adminlogin');
                }
                else{       //success
                    // generate secret if it's empty
                    if(!(strlen(trim($merged_info->google_auth_code)) > 6)){
                        $merged_info->google_auth_code = $this->login_model->set_random_2fa_secret($merged_info->user_id);
                    }

                    $this->session->unset_userdata('merged_info');
                    // set flag for passing email/password login success
                    $this->session->set_userdata(array("merged_info" => $merged_info));

                    // render 2fa views
                    redirect('adminlogin');
                }
            }

            if($this->session->has_userdata("merged_info")){
                $merged_info = $this->session->userdata("merged_info");
                if(isset($_POST['deviceConfirmCode'])){
                
                    $confirmCode = $this->input->post('deviceConfirmCode', true);

                    $checkResult = $GA->verifyCode($merged_info->google_auth_code, $confirmCode, 2);

                    if($checkResult){
                        // set confirm flag to database
                        $merged_info->enable_2_auth = 1;
                        $this->login_model->set_device_confirmed_flag($merged_info->user_id);
                        // login
                        $this->session->set_userdata(array("admin" => $merged_info));
                        // unset merged_info
                        $this->session->unset_userdata('merged_info');

                        if( hasPermissionInArray( ['economic_team'], $merged_info) )
                            redirect("admin/airdrop/payment");
                        if( hasPermissionInArray( ['customer_manager'], $merged_info) )
                            redirect("admin/user/customers");
                        else redirect('admin/airdrop');
                    }
                    // error
                }
                else if(isset($_POST['loginCode'])){
                    // verify code and login
                    $loginCode = $this->input->post('loginCode', true);

                    $checkResult = $GA->verifyCode($merged_info->google_auth_code, $loginCode, 2);

                    if($checkResult){
                        // login
                        $this->session->set_userdata(array("admin" => $merged_info));
                        // unset merged_info
                        $this->session->unset_userdata('merged_info');
                        redirect('admin/airdrop');
                    }
                    // error
                }
            }

            $this->session->set_flashdata('error', lang('2fa_error'));
            redirect('adminlogin');
        }

        //GET

        if($this->session->has_userdata("merged_info")){
            $merged_info = $this->session->userdata("merged_info");
            // if device confirmed before?
            if($merged_info->enable_2_auth != 1){
                // device confirm page with qr code
                $this->load->view('admin/2fa_device_confirm', [
                    'qrCodeUrl' => $GA->getQRCodeGoogleUrl($merged_info->email, $merged_info->google_auth_code, 'https://www.socialremit.com')
                ]);
            }
            else{
                // normal confirm page
                $this->load->view('admin/2fa_login');
            }
        }
        else
            //normal email/password login page
            $this->load->view('admin/login');
    }

    public function logout() {
        $this->session->unset_userdata("admin");
        redirect('/');
    }
}
