<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MLM extends CI_Controller {

    public $userData = NULL;
    
	public function __construct() {
        parent::__construct();

		$this->load->library('session');
		$this->userData = $this->session->userdata("admin");
		if ($this->userData == NULL)
            redirect("/");

        $this->load->helper('url');
        $this->load->helper('form');
		$this->load->helper('campaign');
		$this->load->helper('permission');
        $this->load->database('default');
        
		$this->load->model('MLM_model');
		$this->load->model('ConfigModal');
        $this->load->model('airdrop_user_model');
    }
    
	// public function index() {
    //     $data = array();
    //     $data['title'] = "MLM Management";
    //     $data['page'] = 'MLM';
    //     $data['csrf_token_name'] = $this->security->get_csrf_token_name();
    //     $data['csrf_token_value'] = $this->security->get_csrf_hash();
	// 	$this->load->view('admin/MLM/index', $data);
    // }

    public function addCountry(){
        if(!hasPermissionInArray(['sys_admin'], $this->userData))   die;

        $newCountryCode = $this->input->post("new_country_code", TRUE);
        if(!empty($newCountryCode))
            $this->MLM_model->addNewCountry($newCountryCode);
		redirect('admin/airdrop/settings_page');
    }

    public function updateLevelCommissions(){
        if(!hasPermissionInArray(['sys_admin'], $this->userData))   die;

        $levelCommissions = $this->input->post("level_commissions", TRUE);
        $height = $this->MLM_model->getTreeHeightLimit();

        for ($i = 0; $i < $height; $i++) {
            if (empty($levelCommissions[$i])) {
                $levelCommissions[$i] = 0;
            }
        }

        $this->MLM_model->setLevelCommissions($levelCommissions);
		redirect('admin/airdrop/settings_page');
    }

    public function getReportByUserPage($id){
        if(!hasPermissionInArray(['sys_admin', 'validation_team', 'customer_manager'], $this->userData))   die;

        $user = $this->airdrop_user_model->getUsefulData($id);
        if(empty($user))   die;

        $totalPeopleCount = 0;
        $totalCommission = 0;
        $results = [];

        $this->MLM_model->getReportbyUser($id, $user->country_code, $totalPeopleCount, $totalCommission, $results);
        $showData = [];
        foreach($results as $index => $result) {
            array_push($showData, [
                "no" => $index + 1,
                "level" => $result->level + 1,
                "username" => "<a href='".base_url()."admin/MLM/getReportByUserPage/".$result->user_id."' target='_blank'>".$result->username."</a>",
                "email" => $result->email,
                "reward" => 100 . 'CSR',
                "commission" => $result->commission . 'CSR',
            ]);
        }

        $this->load->view('admin/mlm/byuser', array(
            "user" => $user,
            "showData" => $showData,
            "totalCommission" => $totalCommission,
            "totalPeopleCount" => $totalPeopleCount,
        ));
    }

    public function getReportByCountryPage(){
        if(!hasPermissionInArray(['sys_admin', 'validation_team', 'customer_manager'], $this->userData))   die;
        $supportedCountry = $this->MLM_model->getSupportedCountries();
        $this->load->view('admin/mlm/bycountry', array(
            "supported" => json_encode($supportedCountry),
        ));
    }

    public function getStatusByCountry(){
        if(!hasPermissionInArray(['sys_admin', 'validation_team', 'customer_manager'], $this->userData))   die;
        $countryCode = $this->input->get("country_code", TRUE);

        $res = $this->MLM_model->calcCountryStatus($countryCode);

        echo json_encode($res);
    }

    public function getReportByCountry(){
        if(!hasPermissionInArray(['sys_admin', 'validation_team', 'customer_manager'], $this->userData))   die;
        $start = $this->input->get("start");
        $length = $this->input->get("length");
        $search = $this->input->get("search")["value"];
        $filter_country = $this->input->get("filter_country");

        $org_query = "SELECT count(airdrop_user_info.id) as item_count
                    FROM airdrop_user_info
                    JOIN tbl_users ON (airdrop_user_info.user_id = tbl_users.user_id)";
        $result = $this->db->query($org_query)->result();
        $totalCount = $result [0]->item_count;
        
        $filter_query = "SELECT count(airdrop_user_info.id) as item_count
                        FROM airdrop_user_info
                        JOIN tbl_users ON (airdrop_user_info.user_id = tbl_users.user_id)
                        WHERE tbl_users.email LIKE '%$search%'
                        AND airdrop_user_info.country_code = '$filter_country'";
        $result = $this->db->query($filter_query)->result();
        $filterCount = $result [0]->item_count;
        
        $query = "SELECT airdrop_user_info.id,
                        tbl_users.user_id,
                        tbl_users.username,
                        tbl_users.email,
                        airdrop_user_info.mlm_parent,
                        airdrop_user_info.mlm_people_cnt,
                        airdrop_user_info.mlm_commission
                    FROM airdrop_user_info
                    JOIN tbl_users ON (airdrop_user_info.user_id = tbl_users.user_id)
                    WHERE tbl_users.email LIKE '%$search%'
                    AND airdrop_user_info.country_code = '$filter_country'
                    LIMIT $start, $length";

        $results = $this->db->query($query)->result_array();

        $data = array();
        foreach($results as $index => $result) {
            $parent = '---';
            if($result["mlm_parent"] > '0'){
                $parentInfo = $this->airdrop_user_model->getUsefulData($result["mlm_parent"]);
                $parent = "<a href='".base_url()."admin/MLM/getReportByUserPage/".$parentInfo->user_id."' target='_blank'>".$parentInfo->username."</a>";
            }
            array_push($data, array(
                "no" => $start + $index + 1,
                "username" => "<a href='".base_url()."admin/MLM/getReportByUserPage/".$result ["user_id"]."' target='_blank'>".$result ["username"]."</a>",
                "email" => $result ["email"],
                "referrer" => $parent,
                "total_people" => $result["mlm_people_cnt"],
                "total_commission" => $result["mlm_commission"],
                // "actions" => ($result ["total_score"] - $result ["sent_score"] > 0 ) ? "<a href='#' class='btn-pay' data-id='".$result ["user_id"]."'>Pay</a>" : ""
            ));
        }

        echo json_encode(array(
            "recordsTotal" => $totalCount,
            "recordsFiltered" => $filterCount,
            "data" => $data
        ));
    }
}
