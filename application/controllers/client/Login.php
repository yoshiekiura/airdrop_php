<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
          parent::__construct();
        
        $this->load->library('session');
        if ($this->session->userdata("user") != NULL){
            // if( $this->input->get('redirect', TRUE) == 'ico-purchase')
            if( strstr($_SERVER['QUERY_STRING'], "ico-purchase") != NULL)
                redirect('ico-purchase');
            else
                redirect('dashboard');
        }

        $this->load->model('login_model');
        $this->load->model('MLM_model');
        $this->load->model('airdrop_user_model');
        $this->load->model('Login_failure_model');
		
        $this->load->helper('google_authenticator');
        $this->load->helper('form');
        $this->load->helper('alert');
        $this->load->helper('language');
        $this->load->helper('messages');
        $this->load->helper('cookie');
        $this->load->database('default');
        messages_helper();
        $language = "english";
        $this->lang->load($language, $language);
	}
	
	public function sendAlertToAdmins($userInfo, $ip, $useragent){
		$params['recipient'] = ["estevez@socialremit.com", "vicente.garcia@pymesit.com.mx", "estebancampmany@outlook.com"];

        $params['subject'] = '[CRITICAL SECURITY ALERT]';
        $params['message'] = 'Some one is trying different passwords!<br><br>
                             Email: '.$userInfo->email.'<br>';
        if($userInfo->role_id == 2)
            $params['message'] .= 'Type: Normal User<br>';
        else
			$params['message'] .= 'Type: Admin<br>';
		
		$params['message'] .= "IP: $ip<br>";
		$params['message'] .= "Browser: $useragent<br>";

        $params['resourceed_file'] = '';
        $this->login_model->send_email($params);

        //send to self
        $params['recipient'] = $userInfo->email;

        $params['subject'] = '[CRITICAL SECURITY ALERT]';
        $params['message'] = 'Someone is trying with different passwords to login your account.<br>
                              We blocked access for 24 hours.<br>
                              Please contact support if this is not your behaviour.';
        $this->login_model->send_email($params);
	}

    public function login(){
        if(isset($_POST) && !empty($_POST)){
            // if(!$this->check_captcha($this->input->post('g-recaptcha-response'))){
            //     file_put_contents("system/logs.html","LOGIN: g-recaptcha-response : DENY<br>",FILE_APPEND);
            //     $type = 'error';
            //     $message = lang('bot');
            //     set_message($type, $message);
            //     redirect('login');
            //     return;
            // }

            $data = [];
            $data['email'] = $this->input->post('email', TRUE);
            $data['password'] = $this->input->post('password', TRUE);

            $mergedUserData = $this->login_model->check_login_data($data);

            if($existingUserData = $this->login_model->checkWrongPasswordTolerance($data['email'], 'user', $mergedUserData === false)){ //return info of this user
				// user's public ip
				$ip = $this->input->ip_address();
				if($ip == '0.0.0.0')	$ip = 'Not Available';
				$user_agent = $this->input->user_agent();
				if(!$user_agent)	$user_agent = 'Not Available';
				// alert this failed attempt
				$this->sendAlertToAdmins($existingUserData, $ip, $user_agent);
				// log this failed attempt
				$this->Login_failure_model->newFailure($existingUserData, $ip, $user_agent);

                $this->session->set_flashdata('error', lang('too_many_login_attempts'));
                redirect('login');
            }
            
            if($mergedUserData === false || $mergedUserData->role_id != 2){     //not found or admin account
                $res = $this->login_model->checkActivation($data);
                if($res){
                    $this->session->set_flashdata('error', lang('activation_sent'));
                }
                else{
                    $this->session->set_flashdata('error', lang('incorrect_email_or_username'));
                }
                redirect('login');
            }
            else{       //success
                //check mlm appliable
				$mergedUserData->mlm_flag = $this->MLM_model->isMLMCountry($mergedUserData->country_code);
				if($mergedUserData->enable_2_auth){
					$this->session->set_userdata(array("mergedUserData" => $mergedUserData));
					$this->load->view('client/login_2fa');
				}
				else{
					//set session data for user
					$this->session->set_userdata(array("user" => $mergedUserData));

					if( strstr($_SERVER['HTTP_REFERER'], "ico-purchase") != NULL)
						redirect('ico-purchase');
					else
						redirect('dashboard');
				}
            }
            return;
        }
        $this->load->view('client/login');
	}
	
	public function login_2fa(){
        if(isset($_POST) && !empty($_POST)){
			if($this->session->has_userdata("mergedUserData")){
                $mergedUserData = $this->session->userdata("mergedUserData");
                if(isset($_POST['loginCode'])){
                
					$confirmCode = $this->input->post('loginCode', true);
					$GA = new GoogleAuthenticator();
                    $checkResult = $GA->verifyCode($mergedUserData->google_auth_code, $confirmCode, 2);

                    if($checkResult){
                        // set confirm flag to database
                        // login
                        $this->session->set_userdata(array("user" => $mergedUserData));
                        // unset mergedUserData
						$this->session->unset_userdata('mergedUserData');

						redirect('dashboard');
                    }
                    // error
                }
            }
            $this->session->set_flashdata('error', lang('2fa_error'));
			redirect('login');
		}
		$this->session->unset_userdata("mergedUserData");
		$this->session->unset_userdata("user");
		redirect('login');
    }


    public function send_email($type, $email, &$data) {
        switch ($type) {
            case 'forgot_password':
                return $this->send_email_forgot_password($email, $data);
                break;  

            case 'reset_password':
                return $this->send_email_reset_password($email, $data);
                break;
            
            case 'activate':
                return $this->send_activation_email($email, $data);
                break;
            
        }
    }

    function send_activation_email($email, $data) {

        $email_template = $this->login_model->check_by(array('email_group' => 'activate_account'), 'tbl_email_templates');

        $activate_url = str_replace("{ACTIVATE_URL}", site_url('/login/activate/' . $data['user_id'] . '/' . $data['new_pass_key']), $email_template->template_body);
        //$activate_url = str_replace("{ACTIVATE_URL}", 'https://www.socialremit.com/login/activate/' . $data['user_id'] . '/' . $data['new_pass_key'], $email_template->template_body);
        $activate_period = str_replace("{ACTIVATION_PERIOD}", $data['activation_period'], $activate_url);
        $username = str_replace("{USERNAME}", $data['username'], $activate_period);
        $user_email = str_replace("{EMAIL}", $data['email'], $username);
        $user_password = str_replace("{PASSWORD}", $data['password'], $user_email);
        $message = str_replace("{SITE_NAME}", config_item('company_name'), $user_password);

        $params['recipient'] = $email;
        $params['subject'] = '[ ' . config_item('company_name') . ' ]' . ' ' . $email_template->subject;
        $params['message'] = $message;
        $params['resourceed_file'] = '';

        $this->login_model->send_email($params);
    }

    function send_email_reset_password($email, $data) {
        $email_template = $this->login_model->check_by(array('email_group' => 'reset_password'), 'tbl_email_templates');

        $message = $email_template->template_body;
        $subject = $email_template->subject;

        $username = str_replace("{USERNAME}", $data['username'], $message);
        $user_email = str_replace("{EMAIL}", $data['email'], $username);
        $user_password = str_replace("{NEW_PASSWORD}", $data['new_password'], $user_email);
        $message = str_replace("{SITE_NAME}", config_item('company_name'), $user_password);

        $params['recipient'] = $email;

        $params['subject'] = '[ ' . config_item('company_name') . ' ]' . $subject;
        $params['message'] = $message;

        $params['resourceed_file'] = '';

        $this->login_model->send_email($params);

    }

    function send_email_forgot_password($email, $data) {

        $email_template = $this->login_model->check_by(array('email_group' => 'forgot_password'), 'tbl_email_templates');

        $message = $email_template->template_body;
        $subject = $email_template->subject;
        $site_url = str_replace("{SITE_URL}", base_url() . 'login', $message);
        $key_url = str_replace("{PASS_KEY_URL}", base_url() . 'login/reset_password/' . $data['user_id'] . '/' . $data['new_pass_key'], $site_url);
        $message = str_replace("{SITE_NAME}", config_item('company_name'), $key_url);

        $params['recipient'] = $email;

        $params['subject'] = '[ ' . config_item('company_name') . ' ] ' . $subject;
        $params['message'] = $message;

        $params['resourceed_file'] = '';
        $this->login_model->send_email($params);

    }

    public function activate($user_id, $new_pass_key){
        $check_reset_pass = $this->login_model->can_reset_password_or_activate($user_id, $new_pass_key, 'login');
        
        if ($check_reset_pass == true) {
            $this->login_model->activate_user($user_id);
            $type = 'success';
            $message = lang('activation_completed');

            //get referrer
            $ref_id = $this->login_model->get_ref_id($user_id);

            $userdata = $this->airdrop_user_model->getUsefulData($user_id);

            $mlmAppliable = $this->MLM_model->isMLMCountry($userdata->country_code);

            if($mlmAppliable === false){        // not MLM
                if($ref_id != 0){
                    //100 for 3 referral in the last month
                    $query = "SELECT COUNT(*) as cnt FROM tbl_users
                            WHERE  user_id != $user_id AND activated = 1 AND ref_id = $ref_id
                            AND created >= ('2018-11-14 00:00:00' - INTERVAL 30 DAY)";
                    $count = $this->db->query($query)->row()->cnt;
                    $amount = 10;
                    if($count < 3){
                        $amount = 100;
                    }
                    //$query = "UPDATE airdrop_user_info SET total_score = total_score + $amount WHERE user_id = $ref_id";
                    $this->db->query($query);
                }
            } else {        // MLM
                $usersToRefresh = [$user_id];
                for( $i = 1; $i <= 3; $i++ ){
                    $parent_id = $this->login_model->get_ref_id($usersToRefresh[$i - 1]);
                    if($parent_id == 0)     break; //no more
                    $parent_data = $this->airdrop_user_model->getUsefulData($parent_id);
                    if( $parent_data->country_code == $userdata->country_code){     //within same country
                        $usersToRefresh[$i] = $parent_id;
                    } else { //referred by other freigner
                        break;
                    }
                }

                // refresh users
                foreach($usersToRefresh as $index => $parent_id){
                    $totalPeopleCount = 0;
                    $totalCommission = 0;
                    $results = [];

                    $this->MLM_model->getReportbyUser($parent_id, $userdata->country_code, $totalPeopleCount, $totalCommission, $results);
                    $this->MLM_model->updateUserMLMStatus($parent_id, $totalPeopleCount, $totalCommission);
                }
            }
        } else {
            $type = 'error';
            $message = lang('message_expire');
        }

        set_message($type, $message);
        redirect('login');

    }

    public function reset_password($user_id, $new_pass_key) {
        $data['title'] = lang('welcome_to') . ' ' . config_item('company_name');

        $check_reset_pass = $this->login_model->can_reset_password_or_activate($user_id, $new_pass_key, 'login');
        $random_pass = rand(100000,9999999);
        if ($check_reset_pass == true) {
            $this->login_model->get_reset_password($user_id, $new_pass_key,$random_pass);

            $login_details = $this->db->where('user_id', $user_id)->get('tbl_users')->row();
            $data = array(
                'username' => $login_details->username,
                'email' => $login_details->email,
                'new_password' => $random_pass,
            );
            // Send email with new password
            $this->send_email('reset_password', $data['email'], $data);
            $type = 'success';
            $message = lang('message_new_password_sent');
        } else {
            $type = 'error';
            $message = lang('message_expire');
        }
        set_message($type, $message);
        redirect('login');

        $data['subview'] = $this->load->view('login/forgot_password', $data, TRUE);
        $this->load->view('login', $data);
    }

    public function forgot_password(){
        if(isset($_POST) && !empty($_POST)){
            $login_details = $this->login_model->get_user_details($this->input->post('email'));
            if(!empty($login_details)){
                $data = array(
                    'user_id' => $login_details[0]->user_id,
                    'email' => $login_details[0]->email,
                    'new_pass_key' => md5(rand() . microtime()),
                );
                $this->login_model->set_password_key($data['user_id'],$data['new_pass_key']);

                $this->send_email('forgot_password', $data['email'], $data);

                $type = 'success';
                $message = lang('message_new_password_confirm');
                set_message($type, $message);
                redirect('login');
            }
            else{
                $type = 'error';
                $message = lang('email_error');
                set_message($type, $message);
                redirect('forgot_password');
            }
        }
        $this->load->view('client/forgot_password');
    }

    function check_captcha($google_captcha){
        // return TRUE;
        if(!isset($google_captcha) || empty($google_captcha)){
            return FALSE;
        }
/*      $endpoint = "https://www.google.com/recaptcha/api/siteverify?secret=".config_item("google_secret_key") ."&response=". $google_captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR'];
        $google_response = file_get_contents($endpoint);
        $data = json_decode($google_response);
        if (isset($data->success) && $data->success=="true") {
            return TRUE;
        } else {
            return FALSE;
        }
*/
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

    function check_famous_domain_email($email){
        if(!isset($email) || empty($email)){
            file_put_contents("system/logs.html","famous_domain : empty<br>",FILE_APPEND);
            return FALSE;
        }

        return TRUE;        //disable domain checking

        file_put_contents("system/logs.html", "email to check : ".$email."<br>",FILE_APPEND);
        $famousdomains = array(
            /* Default domains included */
            "aol.com", "att.net", "comcast.net", "facebook.com", "gmail.com", "gmx.com", "googlemail.com",
            "google.com", "hotmail.com", "hotmail.co.uk", "mac.com", "me.com", "mail.com", "msn.com",
            "live.com", "sbcglobal.net", "verizon.net", "yahoo.com", "yahoo.co.uk",

            /* Other global domains */
            "email.com", "fastmail.fm", "games.com" /* AOL */, "gmx.net", "hush.com", "hushmail.com", "icloud.com",
            "iname.com", "inbox.com", "lavabit.com", "love.com" /* AOL */, "outlook.com", "pobox.com", "protonmail.com",
            "rocketmail.com" /* Yahoo */, "safe-mail.net", "wow.com" /* AOL */, "ygm.com" /* AOL */,
            "ymail.com" /* Yahoo */, "zoho.com", "yandex.com",

            /* United States ISP domains */
            "bellsouth.net", "charter.net", "cox.net", "earthlink.net", "juno.com",

            /* British ISP domains */
            "btinternet.com", "virginmedia.com", "blueyonder.co.uk", "freeserve.co.uk", "live.co.uk",
            "ntlworld.com", "o2.co.uk", "orange.net", "sky.com", "talktalk.co.uk", "tiscali.co.uk",
            "virgin.net", "wanadoo.co.uk", "bt.com",

            /* Domains used in Asia */
            "sina.com", "sina.cn", "qq.com", "naver.com", "hanmail.net", "daum.net", "nate.com", "yahoo.co.jp", "yahoo.co.kr", "yahoo.co.id", "yahoo.co.in", "yahoo.com.sg", "yahoo.com.ph", "aliyun.com", "foxmail.com",

            /* French ISP domains */
            "hotmail.fr", "live.fr", "laposte.net", "yahoo.fr", "wanadoo.fr", "orange.fr", "gmx.fr", "sfr.fr", "neuf.fr", "free.fr",

            /* German ISP domains */
            "gmx.de", "hotmail.de", "live.de", "online.de", "t-online.de" /* T-Mobile */, "web.de", "yahoo.de",

            /* Italian ISP domains */
            "libero.it", "virgilio.it", "hotmail.it", "aol.it", "tiscali.it", "alice.it", "live.it", "yahoo.it", "email.it", "tin.it", "poste.it", "teletu.it",

            /* Russian ISP domains */
            "mail.ru", "rambler.ru", "yandex.ru", "ya.ru", "list.ru",

            /* Belgian ISP domains */
            "hotmail.be", "live.be", "skynet.be", "voo.be", "tvcablenet.be", "telenet.be",

            /* Argentinian ISP domains */
            "hotmail.com.ar", "live.com.ar", "yahoo.com.ar", "fibertel.com.ar", "speedy.com.ar", "arnet.com.ar",

            /* Domains used in Mexico */
            "yahoo.com.mx", "live.com.mx", "hotmail.es", "hotmail.com.mx", "prodigy.net.mx",

            /* Domains used in Brazil */
            "yahoo.com.br", "hotmail.com.br", "outlook.com.br", "uol.com.br", "bol.com.br", "terra.com.br", "ig.com.br", "itelefonica.com.br", "r7.com", "zipmail.com.br", "globo.com", "globomail.com", "oi.com.br"
        );

        $domain = substr($email, strrpos($email, '@') + 1);
        file_put_contents("system/logs.html","famous_domain domain: ".$domain."<br>",FILE_APPEND);
/*        if (in_array($domain, $famousdomains)) {
            return TRUE;
        }*/
        
        foreach ($famousdomains as $dom){
            if($dom == $domain){
                file_put_contents("system/logs.html"," dom == domain ".$dom." == ". $domain ."<br>",FILE_APPEND);
                return TRUE;
            }
        }
        return FALSE;
    }

    function varDumpToString ($var){
        ob_start();
        var_dump($var);
        $result = ob_get_clean();
        return $result."<br><br>";
    }
    public function register(){

        if(isset($_POST) && !empty($_POST)){
            $output = $this->varDumpToString($_POST);
            file_put_contents("system/logs.html","<br><br> ===================== <br>".$output,FILE_APPEND);

            if(!$this->check_famous_domain_email($this->input->post('email', TRUE))){
                file_put_contents("system/logs.html","<br>check_famous_domain_email : DENY<br>",FILE_APPEND);
                $type = 'error';
                $message = lang('business_email');
                set_message($type, $message);
                redirect('register');
                return;
            }
            file_put_contents("system/logs.html","check_famous_domain_email : ACCEPT<br>",FILE_APPEND);

            if(strlen($this->input->post('country_code', TRUE)) != 2){
                $type = 'error';
                $message = lang('missing_country');
                set_message($type, $message);
                redirect('register');
                return;
            }

            if(!$this->check_captcha($this->input->post('g-recaptcha-response'))){
                file_put_contents("system/logs.html","g-recaptcha-response : DENY<br>",FILE_APPEND);
                $type = 'error';
                $message = lang('bot');
                set_message($type, $message);
                redirect('register');
                return;
            }
            file_put_contents("system/logs.html","g-recaptcha-response : ACCEPT<br>",FILE_APPEND);
            $data = [];
            $data['email'] = $this->input->post('email', TRUE);
            $data['ethereum'] = $this->input->post('ethereum', TRUE);
            $data['password'] = $this->input->post('password', TRUE);
            $data['repassword'] = $this->input->post('repassword', TRUE);
            $data['username'] = $this->input->post('username', TRUE);
            $data['country_code'] = $this->input->post('country_code', TRUE);
/*
            $result = strstr($data['email'], "@4059.com");
            $result1 = strstr($data['email'], "@163.com");
            if($result || $result1){
                file_put_contents("system/logs.html","@4059.com @163.com : DENY<br>",FILE_APPEND);
                $type = 'success';
                $message = lang('message_registration_completed_1');
                set_message($type, $message);
                redirect('register');
                return;
            }
            file_put_contents("system/logs.html","@4059.com @163.com : ACCEPT<br>",FILE_APPEND);
*/
            $result = $this->login_model->check_email_equal($data['email']);
            if($result == 2){   //already activiated
                file_put_contents("system/logs.html","already activiated, nothing to do<br>",FILE_APPEND);
                set_message('error', lang('existing_email'));
                redirect('register');
                return;
            }

            if($result == 1){   //not activiated yet
                file_put_contents("system/logs.html","registered but not activated so send email<br>",FILE_APPEND);

                set_message('error', lang('not_activated'));
                $rlt = $this->login_model->get_registered_user_data($data['email']);
                $data = array(
                    'user_id' => $rlt[0]->user_id,
                    'email' => $rlt[0]->email,
                    'username' => $rlt[0]->username,
                    'new_pass_key' => $rlt[0]->new_password_key,
                );
                file_put_contents("system/logs.html",$this->varDumpToString($data),FILE_APPEND);
                $this->send_email('activate', $data['email'], $data);
                redirect('login');
                return;
            }

            file_put_contents("system/logs.html","not registered<br>",FILE_APPEND);
            
            $result = $this->login_model->check_username_equal($data['username']);
            if($result){
                file_put_contents("system/logs.html","existing username<br>",FILE_APPEND);
                $type = 'error';
                $message = lang('existing_username');
                set_message($type, $message);
                redirect('register'); 
                return;
            }
            
            file_put_contents("system/logs.html","unique username<br>",FILE_APPEND);
            
            if($data['password'] != $data['repassword']){
                file_put_contents("system/logs.html","passwords are different<br>",FILE_APPEND);
                set_message('error', "Retyped password dosen't match.");
                redirect('register');
                return;
            }
            file_put_contents("system/logs.html","passwords are same<br>",FILE_APPEND);

            $result = $this->login_model->check_eth_equal($data['ethereum']);
            if($result){
                file_put_contents("system/logs.html","existing ethereum address<br>",FILE_APPEND);
                $type = 'error';
                $message = lang('existing_eth');
                set_message($type, $message);
                redirect('register'); 
                return;
            }
            file_put_contents("system/logs.html","unique ethereum address<br>",FILE_APPEND);

            file_put_contents("system/logs.html","*** everything is okay ***<br>",FILE_APPEND);
            $data['ref_id'] = 0;
            if(isset($_COOKIE["ref_id"])) $data['ref_id'] = $_COOKIE["ref_id"];

            $this->login_model->register_client($data);

            $login_details = $this->login_model->get_user_details($this->input->post('email', TRUE));
            $data = array(
                'user_id' => $login_details[0]->user_id,
                'email' => $login_details[0]->email,
                'username' => $login_details[0]->username,
                'new_pass_key' => md5(rand() . microtime()),
            );

            file_put_contents("system/logs.html",$this->varDumpToString($data),FILE_APPEND);

            $this->login_model->set_password_key($data['user_id'],$data['new_pass_key']);
            
            $this->send_email('activate', $data['email'], $data);

            $type = 'success';
            $message = lang('message_registration_completed_1');
            set_message($type, $message);

            //Process Referral
            
            if (isset($_COOKIE["ref_id"])) {
                $amount = 100;
                $ref_id = $_COOKIE["ref_id"];
                $query = "INSERT INTO airdrop_submits (user_id, note, campaign_id, score, `status`, created_at)
                        VALUES ($ref_id, 'Referral Success', 0, $amount, 1, NOW())";
                $this->db->query($query);
                $query = "UPDATE airdrop_user_info SET total_score = total_score + $amount WHERE user_id = $ref_id";
                $this->db->query($query);
                setcookie("ref_id", $ref_id, time()+3600*24*30, '/');
            }
            
            ///////////////////

            redirect('login');
            return;
        }
        $this->load->view('client/register');
    }
}
