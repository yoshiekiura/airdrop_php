<?php
/**
 * Description of client_model
 *
 * @author yakov
 */
class Login_Model extends CI_Model {

    public $_table_name;
    public $_order_by;
    public $_primary_key;
    public $GA;

    public function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('google_authenticator');
        $this->GA = new GoogleAuthenticator();
    }
    public function hash($string){
        return hash('sha512', $string . config_item('encryption_key'));
    }

    public function update_username($data){
        $userData = $this->session->userdata("user");
        $this->db->set('username', $data);
        $this->db->where('user_id', $userData->user_id);
        $this->db->update('tbl_users');
    }

    public function get_username(){
        $userData = $this->session->userdata("user");
        $this->db->select('*')
        ->from('tbl_users')
        ->where('user_id', $userData->user_id);
        $result = $this->db->get()->result();
        return $result[0]->username;
    }
    
    public function get_ref_id($user_id){

        $this->db->select('ref_id')
        ->from('tbl_users')
        ->where('user_id', $user_id);
        $result = $this->db->get()->result();
        return $result[0]->ref_id;
    }
    
    public function register_client($data){
        $builderdata = array(
            'email' => $data['email'],
            'password' => $this->hash($data['password']),
            'eth_address' => $data['ethereum'],
            'username' => $data['username'],
			'ref_id' => $data['ref_id'],
			'wrong_password_date' => '2019-01-01 00:00:00',
			'wrong_password_count' => 0,
        );
        $this->db->set('created', 'NOW()', FALSE);
        if( $this->db->insert('tbl_users', $builderdata) > 0 ){
            $user_id = $this->db->insert_id();

            $isInvited = $this->esInvitado($data['email']);

            if ($isInvited==1){
                $builderdata = array(
                    'user_id' => $user_id,
                    'social_accounts' => '{}',
                    'total_score' => 180,
                    'country_code' => $data['country_code']
                );
            }else{
                $builderdata = array(
                    'user_id' => $user_id,
                    'social_accounts' => '{}',
                    'total_score' => 180,
                    'country_code' => $data['country_code']
                );
            }
            $this->db->insert('airdrop_user_info', $builderdata);
        }
    }

    public function create_admin($data){
        $builderdata = array(
            'username' => $data['email'],
            'email' => $data['email'],
            'password' => $this->hash($data['password']),
            'role_id' => $data['role_id'],
            'activated' => $data['activated'],
            'comment' => $data['comment'],
            'two_factor_permission' => 1, //must enable 2fa
            'google_auth_code' => $this->GA->createSecret(),
        );
        $this->db->set('created', 'NOW()', FALSE);
        return $this->db->insert('tbl_users', $builderdata);
        //no need to insert to airdrop table
    }

    public function get($p_key = NULL, $type = FALSE) {

        if ($p_key != NULL) {
            $convert = $this->_primary_filter;
            $p_key = $convert($p_key);
            $this->db->where($this->_primary_key, $p_key);
            $return_type = 'row';
        } elseif ($type == TRUE) {
            $return_type = 'row';
        } else {
            $return_type = 'result';
        }
        return $this->db->get($this->_table_name)->$return_type();
    }

    public function checkActivation($data){
        $data['sha_password'] = $this->hash($data['password']);

        $this->db->select('*')
        ->from('tbl_users')
        ->where("(tbl_users.role_id  = '2' AND tbl_users.activated  = '0' AND tbl_users.email = '$data[email]' AND tbl_users.password = '$data[sha_password]')");
        $result = $this->db->get()->result();
        if(!empty($result))
            return true;
        return false;
    }


    public function checkWrongPasswordTolerance($email, $role, $passwordWrong){
        $WRONG_TOLARANCE = 3;
        // we already assume password is wrong here
        $query = "SELECT user_id, email, role_id, wrong_password_count, wrong_password_date, wrong_password_date < (NOW() - INTERVAL 1 DAY) as enough_time_passed FROM tbl_users
                    WHERE email = '$email' ";
        if($role == "user")
            $query .= " AND role_id = '2'";
        else
            $query .= " AND role_id != '2'";
        $result = $this->db->query($query)->row();

        if(empty($result)){
            // okay to pass to next checks
            return false;
        }

        //entered last wrong password too long ago
        if($result->enough_time_passed){
            //password is correct
            if(!$passwordWrong){
                //set counter to 0
                $query = "UPDATE tbl_users SET wrong_password_count = 0 WHERE user_id = $result->user_id";
            }
            else{
                //reset timestamp
                //set counter to 1
                $query = "UPDATE tbl_users SET wrong_password_count = 1, wrong_password_date = NOW()
                        WHERE user_id = $result->user_id";
            }
            $result = $this->db->query($query);
            return false;
        }
        //during last day

        // if it's greater than 3 alert
        if($result->wrong_password_count >= $WRONG_TOLARANCE + 1){ // 4th time
            return $result; //return user info
        }

        if(!$passwordWrong){
            //password is correct
            //set counter to 0
            $query = "UPDATE tbl_users SET wrong_password_count = 0 WHERE user_id = $result->user_id";
        }
        else{
            //increase counter
            $result->wrong_password_count++;
            $query = "UPDATE tbl_users SET wrong_password_count = $result->wrong_password_count
                        WHERE user_id = $result->user_id";
        }
        $result = $this->db->query($query);

        return false; //okay
    }

    public function check_login_data($data, $isAdmin = false){
        if($isAdmin) $role = 1;
        else $role = 2;
        $data['sha_password'] = $this->hash($data['password']);

        $this->db->select('*')
        ->from('tbl_users')
        ->where("(tbl_users.activated  = '1' AND tbl_users.email = '$data[email]' AND tbl_users.password = '$data[sha_password]')");
        $result = $this->db->get()->result();
        
        if(!empty($result)) {
            if ($isAdmin && $result [0]->role_id == 2)  return false;
            $this->db->select('*')
            ->from('airdrop_user_info')
            ->where('user_id', $result[0]->user_id);
            $infoResult = $this->db->get()->result() [0];

            $info = $result[0];
            $merged_info = (object) array_merge((array) $infoResult, (array) $info);
            $merged_info->social_accounts = json_decode($infoResult->social_accounts, true);
            return $merged_info;
        }
        else return false;
    }

    public function get_user_details($data){
        $this->db->select('*')
        ->from('tbl_users')
        ->where("(tbl_users.email = '$data')");
        $result = $this->db->get()->result();
        return $result;
    }

    public function get_user_details_by_id($id){
        $this->db->select('*')
        ->from('tbl_users')
        ->where("(tbl_users.id = '$id')");
        $result = $this->db->get()->result();
        return $result;
    }

    function set_password_key($user_id, $new_pass_key) {
        $this->db->set('new_password_key', $new_pass_key);
        $this->db->set('new_password_requested', date('Y-m-d H:i:s'));
        $this->db->where('user_id', $user_id);
        $this->db->update('tbl_users');
        return $this->db->affected_rows() > 0;
    }

    function set_device_confirmed_flag($user_id) {
        $this->db->set('enable_2_auth', 1);
        $this->db->where('user_id', $user_id);
        $this->db->update('tbl_users');
        return $this->db->affected_rows() > 0;
	}

	function disable_device_confirmed_flag($user_id) {
        $this->db->set('enable_2_auth', 0);
        $this->db->where('user_id', $user_id);
        $this->db->update('tbl_users');
        return $this->db->affected_rows() > 0;
	}

	// function enable_2fa_login_flag($user_id) {
    //     $this->db->set('two_factor_permission', 1);
    //     $this->db->where('user_id', $user_id);
    //     $this->db->update('tbl_users');
    //     return $this->db->affected_rows() > 0;
	// }
	
	// function disable_2fa_login_flag($user_id) {
    //     $this->db->set('two_factor_permission', 0);
    //     $this->db->where('user_id', $user_id);
    //     $this->db->update('tbl_users');
    //     return $this->db->affected_rows() > 0;
    // }

    function set_random_2fa_secret($user_id) {
        $secret = $this->GA->createSecret();
        $this->db->set('google_auth_code', $secret);
        $this->db->where('user_id', $user_id);
        $this->db->update('tbl_users');
        return $secret;
    }

    public function check_by($sql_condition, $tbl_name) {
        $this->db->select('*');
        $this->db->from($tbl_name);
        $this->db->where($sql_condition);
        $query_result = $this->db->get();
        $return_data = $query_result->row();
        return $return_data;
    }

    function send_email($email_data) {

        if (config_item('use_postmark') == 'TRUE') {
            $image_data = array('api_key' => config_item('postmark_api_key'));
            $this->load->library('postmark', $image_data);
            $this->postmark->from(config_item('postmark_from_address'), config_item('company_name'));
            $this->postmark->to($email_data['recipient']);
            $this->postmark->subject($email_data['subject']);
            $this->postmark->message_plain($email_data['message']);
            $this->postmark->message_html($email_data['message']);
            
            if (isset($email_data['resourcement_url'])) {
                $this->postmark->resource($email_data['resourceed_file']);
            }
            $this->postmark->send();
        } else if (config_item('use_mailgun') == 'true') {
            $mail = [];
            $mail['to'] = $email_data['recipient'];
            $mail['from'] = config_item('mailgun_from');
            $mail['subject'] = $email_data['subject'];
            $mail['body'] = $email_data['message'];
            
            return $Email = sendmail($mail);
        }else {
            if (config_item('protocol') == 'smtp') {
//                $this->load->library('encrypt');
                $smtp_pass = config_item('smtp_pass');
                $image_data = array(
                    'smtp_host' => config_item('smtp_host'),
                    'smtp_port' => config_item('smtp_port'),
                    'smtp_user' => config_item('smtp_user'),
                    'smtp_pass' => $smtp_pass,
                    'crlf' => "\r\n",
                    'protocol' => config_item('protocol'),
                    'smtp_auth'=>true
                );
            }

            $image_data['mailtype'] = "html";
            $image_data['newline'] = "\r\n";
            $image_data['charset'] = 'utf-8';
            $image_data['wordwrap'] = TRUE;
            $image_data['priority'] = "1";
            
            $this->load->library('email', $image_data);
            $this->email->from(config_item('company_email'), config_item('company_name'));
            
            $this->email->to($email_data['recipient']);

            $this->email->subject($email_data['subject']);
            $this->email->message($email_data['message']);
            if ($email_data['resourceed_file'] != '') {
                $this->email->resource($email_data['resourceed_file']);
            }
            $status = $this->email->send();
        }
    }

    function activate_user($user_id){
        $this->db->where('user_id',$user_id);
        $this->db->set('activated',1);
        $this->db->update('tbl_users');
    }

    function check_eth_equal($eth){
//        $this->db->where('activated', 1);
        $this->db->where('eth_address', $eth);
        $query = $this->db->get('tbl_users');
        return $query->num_rows() >= 1;
    }

    function check_username_equal($username){
//        $this->db->where('activated', 1);
        $this->db->where('username', $username);
        $query = $this->db->get('tbl_users');
        return $query->num_rows() >= 1;
    }

    function check_email_equal($email){ //doesn't exist : 0, not activated : 1, activated : 2
//        $this->db->where('activated', 1);
        $this->db->where('email', $email);
        $query = $this->db->get('tbl_users');
        if( $query->num_rows()){ // exist
            $result = $query->result();
            if( $result[0]->activated == 0 )    return 1;
            return 2;
        }
        return 0;
    }

    function get_registered_user_data($email){
        $this->db->select('*')
        ->from('tbl_users')
        ->where("(tbl_users.email = '$email')");
        $result = $this->db->get()->result();
        return $result;
    }

    function can_reset_password_or_activate($user_id, $new_pass_key) {
        $query = $this->db->select('*')
        ->where('user_id', $user_id)
        ->where('new_password_key', $new_pass_key)
        ->get('tbl_users');
        return $query->num_rows() > 0;
    }

    function get_reset_password($user_id, $new_pass_key,$random_pass=null) {
        //$expire_period = 900;
        if(isset($random_pass) && !empty($random_pass)){
            $this->db->set('password', $this->hash($random_pass));
        }else{
            $this->db->set('password', $this->hash('123456'));
        }
        $this->db->set('new_password_key', NULL);
        $this->db->set('new_password_requested', NULL);
        $this->db->where('user_id', $user_id);
        //$this->db->where('new_password_key', $new_pass_key);
        //$this->db->where('UNIX_TIMESTAMP(new_password_requested) >=', time() - $expire_period);
        $this->db->update('tbl_users');
        return $this->db->affected_rows() > 0;
    }

    function esInvitado($data){
        print_r($data);
        $this->db->select('*');
        $this->db->from('contactos');
        $this->db->where('email',$data);

        $query = $this->db->get();

        if ($query->num_rows()>0){
            return 1;
        }else{
            return 0;
        }
    }

    function update_user_info_bulk($user_id, $data) {
        if(isset($data['password']))
            $data['password'] = $this->hash($data['password']);
        $this->db->where('user_id', $user_id);
        return $this->db->update('tbl_users', $data);
        // return $this->db->affected_rows() > 0;
    }
}
