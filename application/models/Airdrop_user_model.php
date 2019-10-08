<?php
/**
 * Description of client_model
 *
 * @author yakov
 */
class Airdrop_User_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
		$this->load->helper('kyc');
	}
	
	public function get_table_data($user_id){
		$this->db->select('*')
        ->from('airdrop_user_info')
        ->where("(airdrop_user_info.user_id  = $user_id)");
        $result = $this->db->get()->result();
		return $result;
	}

	public function update_data($data){
        $userData = $this->session->userdata("user");
        if(isset($data['social_accounts'])){    //social media
            $this->db->set('social_accounts', $data['social_accounts']);
            $userData->social_accounts = json_decode($data ["social_accounts"], true);
        }
		else if(isset($data['avatar'])){        //avatar
			$this->db->set('avatar', $data['avatar']);
			$userData->avatar = $data ["avatar"];
        }
        else if(isset($data['first_name'])){    //personal details
            foreach(KYC_ITEMS as $item){
                $this->db->set($item, $data[$item]);
                $userData->$item = $data[$item];
            }
        }
        else if(isset($data['identity_proof'])){
            foreach($data as $key => $value){
                $this->db->set($key, $value);
                $userData->$key = $value; //suppose to remove this for security
            }
		}
        $this->db->where('user_id', $userData->user_id);
		$result = $this->db->update('airdrop_user_info');

        //update session
        $this->session->set_userdata(array("user" => $userData));
        return $result;
	}

	public function hash($string) {
        return hash('sha512', $string . config_item('encryption_key'));
	}

	public function check_oldpassword($data,$flag=0){
		
		$sha_password = $this->hash($data);
		$userData = $this->session->userdata("user");
		$param = $userData->user_id;
		if($flag) $param = 1;
		$this->db->select('*')
        ->from('tbl_users')
		->where("(tbl_users.user_id  = '$param')");
		$result = $this->db->get()->result();
		return $result[0]->password == $sha_password;
    }
    
	public function update_password($data,$flag = 0){
		$sha_password = $this->hash($data);
		$userData = $this->session->userdata("user");
		$param = $userData->user_id;
		if($flag) $param = 1;
		$this->db->set('password', $sha_password);
        $this->db->where('user_id',$param);
        $this->db->update('tbl_users');
    }

    //get useful data
    public function getUsefulData($id){
        if(!is_numeric($id))    return null;

        $query= "SELECT tbl_users.username, 
                        tbl_users.email, 
                        tbl_users.role_id, 
                        tbl_users.activated, 
                        tbl_users.created, 
                        tbl_users.eth_address, 
                        tbl_users.ref_id, 

                        airdrop_user_info.*
                    FROM tbl_users
                    JOIN airdrop_user_info ON (tbl_users.user_id = airdrop_user_info.user_id)
                    WHERE tbl_users.user_id = $id";
        $result = $this->db->query($query);
        if($result == false) return null;
        $result = $result->result()[0];
        $result->social_accounts = json_decode($result->social_accounts, true);

        return $result;
    }
    
    // from admin
    public function count_dup_eth_address($address){
		$this->db->select('*')->from('tbl_users')
		->where("eth_address", $address);
        $result = $this->db->get();
        if($result == false)    return 0;
        return count( $result->result_array() );
	}
    
    public function update_eth_address($userID, $address){
		$this->db->set('eth_address', $address);
        $this->db->where('user_id',$userID);
        return $this->db->update('tbl_users');
    }

    public function update_qualification($userID, $qualification){
		$this->db->set('qualification', $qualification);
        $this->db->where('user_id',$userID);
        return $this->db->update('airdrop_user_info');
    }
}
