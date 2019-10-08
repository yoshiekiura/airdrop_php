<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

	public $userData = NULL;

	public function __construct() {
          parent::__construct();

		$this->load->library('session');
		$this->userData = $this->session->userdata("user");
		if ($this->userData == NULL)
            redirect("/login");
        
		$this->load->model('login_model');
        $this->load->model('airdrop_user_model');
        
        $this->load->helper('form');
        $this->load->helper('alert');
		$this->load->helper('language');
        $this->load->helper('campaign');
        $this->load->helper('google_authenticator');
        
        $this->load->database('default');
    }

    public function index(){
        $this->blade->render('client.settings', array("userdata" => $this->userData));
	}

	public function deviceConfirm(){
		$GA = new GoogleAuthenticator();
		$verifyCode = $this->input->post('verifyCode', true);
		$checkResult = $GA->verifyCode($this->userData->google_auth_code, $verifyCode, 2);
		if($checkResult){
			$this->userData->enable_2_auth = 1; //device confirmed
			$this->login_model->set_device_confirmed_flag($this->userData->user_id);
			// $this->userData->two_factor_permission = 1; //2fa login enabled
			// $this->login_model->enable_2fa_login_flag($this->userData->user_id);
			$this->session->unset_userdata('user');
			$this->session->set_userdata(array("user" => $this->userData));
			set_message('success', "Enabled 2 Factor Authentication successfully !");
			redirect('/settings');
		}
		set_message('error', "Invalid Verification Code!");
		redirect('/settings');
	}

	public function disable2FA(){
		$GA = new GoogleAuthenticator();
		$verifyCode = $this->input->post('verifyCode', true);
		$checkResult = $GA->verifyCode($this->userData->google_auth_code, $verifyCode, 2);
		if($checkResult){
			// $this->userData->two_factor_permission = 0; //2fa login disabled
			// $this->login_model->disable_2fa_login_flag($this->userData->user_id);
			$this->userData->enable_2_auth = 0; //disable
			$this->login_model->disable_device_confirmed_flag($this->userData->user_id);
			$this->session->unset_userdata('user');
			$this->session->set_userdata(array("user" => $this->userData));
			set_message('success', "Disabled 2 Factor Authentication!");
			redirect('/settings');
		}
		set_message('error', "Invalid Verification Code!");
		redirect('/settings');
	}

	public function setOrGet2FACode(){
		$GA = new GoogleAuthenticator();
		
		$this->userData->google_auth_code = trim($this->userData->google_auth_code);

		if(!(strlen($this->userData->google_auth_code) > 6)){
			$this->userData->google_auth_code = $this->login_model->set_random_2fa_secret($this->userData->user_id);
			$this->session->unset_userdata('user');
			$this->session->set_userdata(array("user" => $this->userData));
		}

		echo json_encode([
				'qrCodeUrl' => $GA->getQRCodeGoogleUrl($this->userData->email, $this->userData->google_auth_code, 'https://www.socialremit.com'),
				'secret' => $this->userData->google_auth_code,
			]);
	}

	public function change_password(){
		$data['oldpassword'] = $this->input->post('oldpassword', TRUE);
		$data['password'] = $this->input->post('password', TRUE);
		$data['repassword'] = $this->input->post('repassword', TRUE);
		if($data['password'] != $data['repassword']){
			set_message('error', "Retyped password dosen't match. Please enter same password");
			redirect('/settings');
		}
		$result = $this->airdrop_user_model->check_oldpassword($data['oldpassword']);
		if(!$result){
			set_message('error', "Current password is not correct.");
			redirect('/settings');
		}
		$this->airdrop_user_model->update_password($data['password']);
		set_message('success', "Successfully changed!");
		redirect('/settings');
    }
}
