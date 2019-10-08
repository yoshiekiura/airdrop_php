<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Airdrop extends CI_Controller {

    public $userData = NULL;
    
	public function __construct() {
        parent::__construct();

		$this->load->library('session');
        $this->load->helper('permission');
		$this->userData = $this->session->userdata("admin");
		if ($this->userData == NULL)
            redirect("/");

        $this->load->helper('url');
        $this->load->helper('form');
		$this->load->helper('campaign');
        $this->load->database('default');
        
		$this->load->model('airdrop_submit_model');
		$this->load->model('ConfigModal');
        $this->load->model('MLM_model');
    }
    
	public function index() {
        if(!hasPermissionInArray(['sys_admin', 'validation_team', 'customer_manager'], $this->userData))   die;
        $data = array();
        $data['title'] = "Airdrop Management";
        $data['page'] = 'Airdrop';
        $data['csrf_token_name'] = $this->security->get_csrf_token_name();
        $data['csrf_token_value'] = $this->security->get_csrf_hash();

		$this->load->view('admin/airdrop/index', $data);
    }

    public function getData() {
        if(!hasPermissionInArray(['sys_admin', 'validation_team', 'customer_manager'], $this->userData))   die;
        //        $order = $this->input->get('order') [0];
        $start = $this->input->get("start");
        $length = $this->input->get("length");
        $filter_campain_id = $this->input->get("search")["value"];
        $filter_username = $this->input->get("filter_username");
        $filter_email = $this->input->get("filter_email");

        if(empty($filter_campain_id)){

        }

        $org_query = "SELECT count(airdrop_submits.id) as item_count
                    FROM airdrop_submits
                    JOIN tbl_users ON (airdrop_submits.user_id = tbl_users.user_id) 
                    JOIN airdrop_user_info ON (airdrop_submits.user_id = airdrop_user_info.user_id)
			WHERE airdrop_submits.status = 0
			OR (
                airdrop_submits.status = -1 and (airdrop_submits.note <> '' or trim(airdrop_submits.note) <> ''
                or ((airdrop_user_info.total_score + airdrop_user_info.sent_score) < 400)
            ))";
        $result = $this->db->query($org_query)->result();
        $totalCount = $result [0]->item_count;
        
        $org_query = "SELECT count(airdrop_submits.id) as item_count
                    FROM airdrop_submits
                    JOIN tbl_users ON (airdrop_submits.user_id = tbl_users.user_id)
                    JOIN airdrop_user_info ON (airdrop_submits.user_id = airdrop_user_info.user_id)
                    WHERE tbl_users.username LIKE '%$filter_username%'
                    AND   tbl_users.email LIKE '%$filter_email%'
                    AND   airdrop_submits.campaign_id LIKE '$filter_campain_id%'
		    AND airdrop_submits.status = 0
		    AND airdrop_submits.checked = 0
		    OR (
                airdrop_submits.status = -1 and (airdrop_submits.note <> '' or trim(airdrop_submits.note) <> ''
                or ((airdrop_user_info.total_score + airdrop_user_info.sent_score) < 400)
            )
			AND tbl_users.username LIKE '%$filter_username%'
                    	AND tbl_users.email LIKE '%$filter_email%'
			AND airdrop_submits.checked = 0
                    	AND airdrop_submits.campaign_id LIKE '$filter_campain_id%')";
        $result = $this->db->query($org_query)->result();
        $filterCount = $result [0]->item_count;
        
        $query = "SELECT airdrop_submits.id,
                        tbl_users.user_id, 
                        tbl_users.username,
                        tbl_users.email,
                        airdrop_submits.url,
                        airdrop_submits.note,
                        airdrop_submits.campaign_id,
                        airdrop_submits.score,
			            airdrop_submits.checked,
                        airdrop_submits.status,
                        airdrop_submits.created_at
                    FROM airdrop_submits
                    JOIN tbl_users ON (airdrop_submits.user_id = tbl_users.user_id)
                    JOIN airdrop_user_info ON (airdrop_submits.user_id = airdrop_user_info.user_id)
                    WHERE tbl_users.username LIKE '%$filter_username%'
                    AND   tbl_users.email LIKE '%$filter_email%'
                    AND   airdrop_submits.campaign_id LIKE '$filter_campain_id%'
		    AND airdrop_submits.status = 0
		    AND airdrop_submits.checked = 0
			OR (
                airdrop_submits.status = -1 and (airdrop_submits.note <> '' or trim(airdrop_submits.note) <> ''
                or ((airdrop_user_info.total_score + airdrop_user_info.sent_score) < 400)
            )
			AND tbl_users.username LIKE '%$filter_username%'
                    	AND tbl_users.email LIKE '%$filter_email%'
			AND airdrop_submits.checked = 0
                    	AND airdrop_submits.campaign_id LIKE '$filter_campain_id%')
                    ORDER BY airdrop_submits.created_at ASC, airdrop_submits.id DESC
		    LIMIT $start, $length";

        $results = $this->db->query($query)->result_array();

        $STATUS = array(
            -1 => "Rejected",
            0 => "Pending",
            1 => "Approved",
            2 => "Revalidated",

        );

	$REVIEWED = array(
	    	0 => "",
		1 => "Reviewed"
	);

        $data = array();
        foreach($results as $index => $result) {
            array_push($data, array(
                "no" => $start + $index + 1,
                "username" => "<a href='".base_url()."admin/user/user_details/".$result ["user_id"]."'>".$result ["username"]."</a>",
                "note" => $result ["note"],
                "email" => $result ["email"],
		"actions" => $this->getAction($result ["id"], $result ["status"]),
                "url" => "<a href='".$result ["url"]."' title='".$result ["url"]."'>".(strlen($result ["url"]) > 20 ? substr($result ["url"], 0, 20)."..." : $result ["url"])."</a>",
                "description" => getCampaignTextWithId($result ["campaign_id"]),
                "score" => $result ["score"],
		"reviewed" => $REVIEWED [$result ["checked"]],
                "status" => $STATUS [$result ["status"]],
                "created_at" => $result ["created_at"]
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
            case -1:
                return "<a href='#' class='btn-approve' data-id='$id'>Approve</a>";
            case 0:
                return "<a href='#' class='btn-approve' data-id='$id'>Approve</a> / 
                        <a href='#' class='btn-reject' data-id='$id'>Reject</a>";
            case 1:
                return "<a href='#' class='btn-reject' data-id='$id'>Reject</a>";
        }
    }

    function setReviewed($id){
        if(!hasPermissionInArray(['sys_admin', 'validation_team', 'customer_manager'], $this->userData))   die;
        $rv = $this->input->post("rv", TRUE);

        $query = "Update airdrop_submits
            set checked = $rv
            where id = $id";
        $this->db->query($query);

        $query = "SELECT user_id FROM airdrop_submits WHERE id = $id";
            $result = $this->db->query($query)->result();
            $user_id = $result [0]->user_id;
        $admin_name = $this->session->userdata("admin")->username;
        $fecha = $this->load->helper('date');
        if ($rv=="1"){
            $query = "INSERT INTO tbl_chng_log (nb_admin, usr_id, sbm_it, hf_chng, status) VALUES ('".$admin_name."','".$user_id."','".$id."',sysdate(),'3')";
        }else{
            $query = "INSERT INTO tbl_chng_log (nb_admin, usr_id, sbm_it, hf_chng, status) VALUES ('".$admin_name."','".$user_id."','".$id."',sysdate(),'-3')";

        }
        $this->db->query($query);
        
        echo json_encode(array(
            'csrf_token_name' => $this->security->get_csrf_token_name(),
            'csrf_token_value' => $this->security->get_csrf_hash(),
        ));
	
    }

    function getSubmitInfo($id) {
        if(!hasPermissionInArray(['sys_admin', 'validation_team', 'customer_manager'], $this->userData))   die;
        $query = "SELECT `url`,
			note, 
                        score,
                        `message`,
			checked
                    FROM airdrop_submits
                    WHERE id = $id";
        $result = $this->db->query($query)->result();
        echo json_encode($result [0]);
    }

    function changeSubmitStatus($id) {
        if(!hasPermissionInArray(['sys_admin', 'validation_team', 'customer_manager'], $this->userData))   die;
	
        $status = $this->input->post("status", TRUE);
        $score = $this->input->post("score", TRUE);
        $message = $this->input->post("message", TRUE);


        if ($status == 1) {

            $query = "SELECT i.user_id, campaign_id, `status`, 
                    total_score + sent_score score
                        FROM airdrop_user_info i,  airdrop_submits s
                        WHERE i.user_id = s.user_id
                            AND s.id = $id";
            $result = $this->db->query($query)->result();
            $user_id = $result [0]->user_id;
            $campId = $result [0]->campaign_id;
			$orgStatus = $result [0]->status;
            $tokens_amount = $result [0]->score;

			if ($status == 1 
				&& $orgStatus == -1 
                && $tokens_amount >= 400 
				&& !$this->airdrop_submit_model->canSaveSubmit($user_id, $campId)) {
                echo json_encode(array(
                    "result" => 0,
                    'csrf_token_name' => $this->security->get_csrf_token_name(),
                    'csrf_token_value' => $this->security->get_csrf_hash(),
                ));
                return;
            }            
        }
        if ($status == 1
                && $orgStatus == -1
                && $tokens_amount < 400){

            $query = "UPDATE airdrop_submits 
                    SET `status`= 2,
                        `score`= $score,
                        `message`= '$message' 
                    WHERE id = $id";
        }else{

            $query = "UPDATE airdrop_submits 
                    SET `status`= $status,
                        `score`= $score,
                        `message`= '$message' 
                    WHERE id = $id";
        }        
        $this->db->query($query);

        $query = "SELECT user_id FROM airdrop_submits WHERE id = $id";
        $result = $this->db->query($query)->result();
        $user_id = $result [0]->user_id;

        $addScore = $status * $score;

        if($addScore > 0){     //reject doesn't decrease!

            $addScore = 0;  //Se han deshabilitado las campañas

            $query = "UPDATE airdrop_user_info 
                        SET total_score = total_score + ($addScore)
                        WHERE user_id = $user_id";
            $this->db->query($query);

            // increase total amount
            $this->ConfigModal->setValueWithKey(
                'assigned_airdrop_token',
                $this->ConfigModal->getValueWithKey('assigned_airdrop_token') + $addScore
            );
        }

	// VGR
	$admin_name = $this->session->userdata("admin")->username;
	$fecha = $this->load->helper('date');
	$query = "INSERT INTO tbl_chng_log (nb_admin, usr_id, sbm_it, hf_chng, status) VALUES ('".$admin_name."','".$user_id."','".$id."',sysdate(),'".$status."')";
	$this->db->query($query);
	// VGR


        echo json_encode(array(
            "result" => 1,
            'csrf_token_name' => $this->security->get_csrf_token_name(),
            'csrf_token_value' => $this->security->get_csrf_hash(),
        ));

    }

    function payment() {
        if(!hasPermissionInArray(['sys_admin', 'economic_team', 'customer_manager'], $this->userData))   die;

        $data = array();
        $data['title'] = "Airdrop Payment Management";
        $data['page'] = 'Airdrop';

        $this->load->view('admin/airdrop/payment', $data);
    }

    function getPaymentData() {
        if(!hasPermissionInArray(['sys_admin', 'economic_team', 'customer_manager'], $this->userData))   die;

        $start = $this->input->get("start");
        $length = $this->input->get("length");
        $search = $this->input->get("search")["value"];
        $filter_username = $this->input->get("filter_username");

        $org_query = "SELECT count(airdrop_user_info.id) as item_count
                    FROM airdrop_user_info
                    JOIN tbl_users ON (airdrop_user_info.user_id = tbl_users.user_id)";
        $result = $this->db->query($org_query)->result();
        $totalCount = $result [0]->item_count;
        
        $filter_query = "SELECT count(airdrop_user_info.id) as item_count
                        FROM airdrop_user_info
                        JOIN tbl_users ON (airdrop_user_info.user_id = tbl_users.user_id)
                        WHERE tbl_users.email LIKE '%$search%'
                        AND tbl_users.username LIKE '%$filter_username%'";
        $result = $this->db->query($filter_query)->result();
        $filterCount = $result [0]->item_count;
        
        $query = "SELECT airdrop_user_info.id,
                        tbl_users.user_id,
                        tbl_users.username,
                        tbl_users.email,
                        airdrop_user_info.total_score,
                        airdrop_user_info.sent_score,
                        airdrop_user_info.later_score
                    FROM airdrop_user_info
                    JOIN tbl_users ON (airdrop_user_info.user_id = tbl_users.user_id)
                    WHERE tbl_users.email LIKE '%$search%'
                    AND tbl_users.username LIKE '%$filter_username%'
                    LIMIT $start, $length";

        $results = $this->db->query($query)->result_array();

        $data = array();
        foreach($results as $index => $result) {
            array_push($data, array(
                "no" => $start + $index + 1,
                "username" => "<a href='".base_url()."admin/user/user_details/".$result ["user_id"]."'>".$result ["username"]."</a>",
                "email" => $result ["email"],
                "total_score" => $result["total_score"] + $result["sent_score"],
                "august_score" => $result["sent_score"],
                "later_score" => $result["later_score"],
                "remaining_score" => $result["total_score"] - $result["later_score"],
                // "actions" => ($result ["total_score"] - $result ["sent_score"] > 0 ) ? "<a href='#' class='btn-pay' data-id='".$result ["user_id"]."'>Pay</a>" : ""
            ));
        }

        echo json_encode(array(
            "recordsTotal" => $totalCount,
            "recordsFiltered" => $filterCount,
            "data" => $data
        ));
    }

    function transaction() {
        if(!hasPermissionInArray(['sys_admin', 'economic_team', 'customer_manager'], $this->userData))   die;
        
        $data = array();
        $data['title'] = "Airdrop Transaction Management";
        $data['page'] = 'Airdrop';

        $this->load->view('admin/airdrop/transaction', $data);
    }

    function getTransactionData() {
        if(!hasPermissionInArray(['sys_admin', 'economic_team', 'customer_manager'], $this->userData))   die;

        $start = $this->input->get("start");
        $length = $this->input->get("length");
        $search = $this->input->get("search")["value"];
        $filter_august_flag = $this->input->get("filter_august_flag");
        $filter_username = $this->input->get("filter_username");


        $org_query = "SELECT count(airdrop_transaction.id) as item_count
                    FROM airdrop_transaction
                    JOIN tbl_users ON (airdrop_transaction.user_id = tbl_users.user_id)";
        $result = $this->db->query($org_query)->result();
        $totalCount = $result [0]->item_count;
        
        $filter_query = "SELECT count(airdrop_transaction.id) as item_count
                        FROM airdrop_transaction
                        JOIN tbl_users ON (airdrop_transaction.user_id = tbl_users.user_id)
                        WHERE tbl_users.email LIKE '%$search%'
                        AND airdrop_transaction.august_flag LIKE '$filter_august_flag%'
                        AND tbl_users.username LIKE '%$filter_username%'";
        $result = $this->db->query($filter_query)->result();
        $filterCount = $result [0]->item_count;
        
        $query = "SELECT airdrop_transaction.id,
                        tbl_users.user_id, 
                        tbl_users.username,
                        tbl_users.email,
                        airdrop_transaction.score,
                        airdrop_transaction.amount,
                        airdrop_transaction.transaction_id,
                        airdrop_transaction.created_at,
                        airdrop_transaction.august_flag
                    FROM airdrop_transaction
                    JOIN tbl_users ON (airdrop_transaction.user_id = tbl_users.user_id)
                    WHERE tbl_users.email LIKE '%$search%'
                    AND tbl_users.username LIKE '%$filter_username%'
                    AND airdrop_transaction.august_flag LIKE '$filter_august_flag%'
                    ORDER BY airdrop_transaction.created_at
                    LIMIT $start, $length";

        $results = $this->db->query($query)->result_array();

        $data = array();
        foreach($results as $index => $result) {
            array_push($data, array(
                "no" => $start + $index + 1,
                "username" => "<a href='".base_url()."admin/user/user_details/".$result ["user_id"]."'>".$result ["username"]."</a>",
                "email" => $result ["email"],
                "score" => $result ["score"],
                "amount" => $result ["amount"],
                "transaction_id" => "<a href='https://etherscan.io/tx/".$result ["transaction_id"]."' target='_blank'>".$result ["transaction_id"]."</a>",
                "august_flag" => $result ["august_flag"] == 1 ? 'Yes' : 'No',
                "created_at" => $result ["created_at"],
            ));
        }

        echo json_encode(array(
            "recordsTotal" => $totalCount,
            "recordsFiltered" => $filterCount,
            "data" => $data
        ));
    }

    public function settings(){
        if(!hasPermissionInArray(['sys_admin'], $this->userData))   die;

        $price = $this->input->post("price", TRUE);
        $discount = $this->input->post("discount", TRUE);

        if(is_numeric($price) && is_numeric($discount) && $price >= 0  && $discount >= 0 && $discount < 100)  
        {
            $this->ConfigModal->setValueWithKey('ico_token_price', $price);
            $this->ConfigModal->setValueWithKey('ico_discount_rate', $discount);
        }

		redirect('admin/airdrop/settings_page');
    }

    public function settings_page(){
        if(!hasPermissionInArray(['sys_admin'], $this->userData))   die;

            $supportedCountry = $this->MLM_model->getSupportedCountries();
            $treeHeight = $this->MLM_model->getTreeHeightLimit();
            $levelCommissions = $this->MLM_model->getLevelCommissions();

            $this->load->view('admin/airdrop/settings', array(
                'price' => $this->ConfigModal->getValueWithKey('ico_token_price'),
                'discount' => $this->ConfigModal->getValueWithKey('ico_discount_rate'),
                'supported' => json_encode($supportedCountry),
                'treeHeight' => $treeHeight,
                'levelCommissions' => $levelCommissions,
            ));
    }

    // moved to Login controller

    // public function logout() {
    //     $this->session->unset_userdata("admin");
    //     redirect('/');
    // }
}
