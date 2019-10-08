<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public $userData = NULL;
    
	public function __construct() {
        parent::__construct();

		$this->load->library('session');
		$this->userData = $this->session->userdata("admin");
		if ($this->userData == NULL)
            redirect("/");

		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('alert');
		$this->load->helper('campaign');
		$this->load->helper('permission');
		$this->load->model('airdrop_user_model');
		$this->load->model('login_model');
        $this->load->database('default');
    }
    
	public function customers() {
        $data = array();
        $data['title'] = "User Management";
        $data['page'] = 'User';

        $this->load->view('admin/user/index', $data);
    }

    public function admins() {
        if($this->userData->role_id != 1)         die;
        $this->load->view('admin/user/admins', [
            'title' => 'Admins Management',
            'page' => 'admin_management',
        ]);
    }
    
    public function getUserList() {
        $start = $this->input->get("start");
        $length = $this->input->get("length");
        $search = $this->input->get("search")["value"];
        $filter_username = $this->input->get("filter_username");

        $filter_kyc_status = $this->input->get("filter_kyc_status", TRUE);

        $query_kyc = empty($filter_kyc_status) ? " " : " AND kyc_status = '$filter_kyc_status' ";

        $org_query = "SELECT count(user_id) as item_count
                    FROM tbl_users";
        $result = $this->db->query($org_query)->result();
        $totalCount = $result [0]->item_count;
        
        $org_query = "SELECT count(tbl_users.user_id) as item_count
                    FROM tbl_users
                    JOIN airdrop_user_info ON (tbl_users.user_id = airdrop_user_info.user_id)
                    WHERE tbl_users.email LIKE '%$search%'
                    AND tbl_users.username LIKE '%$filter_username%'
                        $query_kyc";
        $result = $this->db->query($org_query)->result();
        $filterCount = $result [0]->item_count;
        
        $query = "SELECT tbl_users.user_id, 
                         tbl_users.username,
                         tbl_users.email,
                         tbl_users.activated,
                         tbl_users.role_id,
                         tbl_users.eth_address,
                         airdrop_user_info.kyc_status,
                         airdrop_user_info.qualification

                    FROM tbl_users
                    JOIN airdrop_user_info ON (tbl_users.user_id = airdrop_user_info.user_id)
                    WHERE email LIKE '%$search%'
                    AND tbl_users.username LIKE '%$filter_username%'
                        $query_kyc
                    LIMIT $start, $length";

        $results = $this->db->query($query)->result_array();

        $STATUS = array(
            0 => "Pending",
            1 => "Allowed",
        );
        $KYC_STATUS = array(
            0 => "Not Passed",
            1 => "Pending",
            2 => "Passed",
        );
        $ROLES = array(
            1 => "Administrator",
            2 => "Client",
        );

		$data = array();
		
        foreach($results as $index => $result) {
            array_push($data, array(
                "no" => $start + $index + 1,
                "username" => "<a href='".base_url()."admin/user/user_details/".$result ["user_id"]."'>".$result ["username"]."</a>",
                "email" => $result ["email"],
                "qualification" => $result ["qualification"],
                "eth_address" => "<a href='https://etherscan.io/address/".$result ["eth_address"]."' target='_blank'>".$result ["eth_address"]."</a>",
                "usertype" => $ROLES [$result ["role_id"]],
                "status" => $STATUS [$result ["activated"]],
                "kyc_status" => $KYC_STATUS [$result ["kyc_status"]],
                "actions" => $this->getAction($result ["user_id"], $result ["activated"])
            ));
        }

        echo json_encode(array(
            "recordsTotal" => $totalCount,
            "recordsFiltered" => $filterCount,
            "data" => $data
        ));
    }

    function getAction($id, $status) {
        switch ($status) {
            case 0:
                return "<a href='#' class='btn-changeStatus' data-id='$id'>Activate</a>";
            case 1:
                return "<a href='#' class='btn-changeStatus' data-id='$id'>Deactivate</a>";
        }
	}
        
    public function getAdminList() {
        if(!hasPermissionInArray(['sys_admin'], $this->userData))   die;

        $search = $this->input->get("search")["value"];

        $filter_by_role = $this->input->get("filter_by_role", TRUE);

        $STATUS = array(
            0 => "Banned",
            1 => "Active",
        );

        $query_role = "tbl_users.role_id != 2"; //any admin

        if(isset(ADMIN_ROLE_NAMES[$filter_by_role])){
            $query_role = " tbl_users.role_id = $filter_by_role";   //specific admin
        }
        
        $query = "SELECT tbl_users.user_id, 
                         tbl_users.email,
                         tbl_users.activated,
                         tbl_users.role_id,
                         tbl_users.comment
                    FROM tbl_users
                    WHERE $query_role
                    AND tbl_users.email LIKE '%$search%'";

        $results = $this->db->query($query)->result_array();

        $data = array();

        foreach($results as $index => $result) {
            $id = $result["user_id"];
            $role_id = $result ["role_id"];
            $email = $result ["email"];
            $activation = $result ["activated"];
            $comment = $result ["comment"];
            array_push($data, [
                "no" => $index + 1,
                "email" => $email,
                "role" => getRoleNameByID($role_id),
                "status" => $STATUS [$result ["activated"]],
                "comment" => "<span id='data_comment_$id'>$comment</span>",
                // "actions" => $role == 1 ? "" : "<button class='btn btn-primary btn-edit' data-id='$id' data-email='$email' data-role='$role' data-status='$activation'><i class='fa fa-edit'></i> Edit</button>"
                "actions" => "<button class='btn btn-primary btn-edit' data-id='$id' data-email='$email' data-role='$role_id' data-status='$activation'><i class='fa fa-edit'></i> Edit</button>"
            ]);
        }

        echo json_encode(array(
            "recordsTotal" => count($results),
            "recordsFiltered" => count($results),
            "data" => $data
        ));
    }

    function updateAdmin(){
        if(!hasPermissionInArray(['sys_admin'], $this->userData))   die;

        $data = [];
        $ret=[
            "success" => 0,
            'csrf_token_name' => $this->security->get_csrf_token_name(),
            'csrf_token_value' => $this->security->get_csrf_hash(),
        ];
        $flag_change_password = $this->input->post('flag_change_password', TRUE);
        $password = $this->input->post('new_password', TRUE);
        if($flag_change_password == "on"){
            if( $password != $this->input->post('confirm_password', TRUE) ){
                echo json_encode($ret);
                return;
            }
            $data['password'] = $password;
        }

        $data['role_id'] = $this->input->post('role', TRUE);
        $data['activated'] = $this->input->post('status', TRUE);
        $data['comment'] = $this->input->post('comment', TRUE);

        $userID = $this->input->post('id', TRUE);

        $ret['success'] = $this->login_model->update_user_info_bulk($userID, $data);
        echo json_encode($ret);
    }

    function createAdmin(){
        if(!hasPermissionInArray(['sys_admin'], $this->userData))   die;

        $data = [];
        $ret=[
            "success" => 0,
            'csrf_token_name' => $this->security->get_csrf_token_name(),
            'csrf_token_value' => $this->security->get_csrf_hash(),
        ];
        $data['email'] = $this->input->post('email', TRUE);
        $data['role_id'] = $this->input->post('role', TRUE);
        $data['activated'] = $this->input->post('status', TRUE);
        $data['comment'] = $this->input->post('comment', TRUE);
        $data['password'] = $this->input->post('new_password', TRUE);
        if( $data['password'] != $this->input->post('confirm_password', TRUE)
          || !is_numeric($data['role_id'])
          || !is_numeric($data['activated'])
          || empty($data['password'])
          || empty($data['email'])){
            echo json_encode($ret);
            return;
        }

        $ret['success'] = $this->login_model->create_admin($data);

        echo json_encode($ret);
    }

	function profile(){
		$this->load->view('admin/user/profile');
    }

	function change_password(){
        if(!hasPermissionInArray(['sys_admin'], $this->userData))   die;

		$data['oldpassword'] = $this->input->post('oldpassword', TRUE);
		$data['password'] = $this->input->post('password', TRUE);
		$data['repassword'] = $this->input->post('repassword', TRUE);
		if($data['password'] != $data['repassword']){
			set_message('error', "Retyped password dosen't match.Please insert same password");
			redirect('admin_password');
		}
		$result = $this->airdrop_user_model->check_oldpassword($data['oldpassword'],1);
		if(!$result){
			set_message('error', "Old password dosen't incorrect.Please insert correct old password!");
			redirect('admin_password');
		}

		$this->airdrop_user_model->update_password($data['password'],1);
		set_message('success', "Successfully changed!");
		redirect('admin_password');
	}

    function user_details($id) {

        if(!is_numeric($id)) return;
        
        $result = $this->airdrop_user_model->getUsefulData($id);

        $this->load->view('admin/user/user_details', array(
            "user" => $result,
            "status" => array(
                            0 => "Pending",
                            1 => "Allowed",
                        ),
            "role" =>   array(
                            1 => "Administrator",
                            2 => "Client",
                        ),
        ));
    }

    function changeStatus($id) {
        if(!hasPermissionInArray(['sys_admin', 'customer_manager'], $this->userData))   die;

        $query = "UPDATE tbl_users SET activated = 1 - activated WHERE user_id = $id";
        $res = $this->db->query($query);
        echo json_encode(array(
            "success" => $res,
            'csrf_token_name' => $this->security->get_csrf_token_name(),
            'csrf_token_value' => $this->security->get_csrf_hash(),
        ));
    }

    function changeKYCStatus() {
        if(!hasPermissionInArray(['sys_admin', 'validation_team', 'customer_manager'], $this->userData))   die;

		$user_id = $this->input->post('user_id', TRUE);
        $decision = $this->input->post('decision', TRUE);
        if(is_numeric($user_id) && is_numeric($decision)){
            $query = "UPDATE airdrop_user_info SET kyc_status = $decision WHERE user_id = $user_id";
            $res = $this->db->query($query);
        }
    }

    public function updateUserData(){
        if(!hasPermissionInArray(['sys_admin', 'validation_team', 'customer_manager'], $this->userData))   die;

		$userID = $this->input->post('user_id', TRUE);
		$newWallet = $this->input->post('new_wallet', TRUE);
        $newQualification = $this->input->post('new_qualification', TRUE);
        
        $success = true;
        $errormsg = "";

        while(1){
            if(!is_numeric($newQualification) || $newQualification < 1 || $newQualification > 10){
                $success = false;
                $errormsg = 'Invalid Qualification Value!';
                break;
            }
            $this->airdrop_user_model->update_qualification($userID, $newQualification);
            
            if(!$this->airdrop_user_model->update_eth_address($userID, $newWallet)){
                $success = false;
                $errormsg = 'Duplicate Address!';
                break;
            }
            break;
        }

        echo json_encode(array(
            "success" => $success,
            'errormsg' => $errormsg,
            'csrf_token_name' => $this->security->get_csrf_token_name(),
            'csrf_token_value' => $this->security->get_csrf_hash(),
        ));

	}
}
