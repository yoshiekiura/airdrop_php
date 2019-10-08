<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Referral extends CI_Controller {

	public $userData = NULL;

	public function __construct() {
        parent::__construct();

		$this->load->library('session');
		$this->userData = $this->session->userdata("user");
		if ($this->userData == NULL)
			redirect("/login");
		
		$this->load->helper('url');
        $this->load->helper('campaign');
		$this->load->model('MLM_model');
        
        $this->load->database('default');
    }

    public function index(){
        if($this->userData->mlm_flag){
            $totalPeopleCount = 0;
            $totalCommission = 0;
            $results = [];

            $this->MLM_model->getReportbyUser($this->userData->user_id, $this->userData->country_code, $totalPeopleCount, $totalCommission, $results);
            $showData = [];
            foreach($results as $index => $result) {
                array_push($showData, [
                    "no" => $index + 1,
                    "level" => $result->level + 1,
                    "username" => $result->username,
                    "reward" => 100 . ' CSR',
                    "commission" => $result->commission . ' CSR',
                ]);
            }

            $this->blade->render('client.mlm-referral',[
                "userdata" => $this->userData,
                "showData" => $showData,
                "totalCommission" => $totalCommission,
                "totalPeopleCount" => $totalPeopleCount,
            ]);
        }
        else
            $this->blade->render('client.referral',array("userdata" => $this->userData));
    }
   
    public function getReferralData() {
        $user_id = $this->session->userdata("user")->user_id;
        
        $start = $this->input->get("start");
        $length = $this->input->get("length");
        $search = $this->input->get("search")["value"];

        $org_query = "SELECT count(tbl_users.user_id) as item_count
                    FROM tbl_users
                    WHERE ref_id = $user_id";
        $result = $this->db->query($org_query)->result();
        $totalCount = $result [0]->item_count;
        
        $filter_query = "SELECT count(tbl_users.user_id) as item_count
                        FROM tbl_users
                        WHERE ref_id = $user_id";
        $result = $this->db->query($filter_query)->result();
        $filterCount = $result [0]->item_count;
        
        $query = "SELECT tbl_users.user_id,
                         tbl_users.username,
                         tbl_users.created
                    FROM tbl_users
                    WHERE ref_id = $user_id
                    ORDER BY tbl_users.created
                    LIMIT $start, $length";

        $results = $this->db->query($query)->result_array();
        $data = array();
        foreach($results as $index => $result) {
            array_push($data, array(
                "no" => $start + $index + 1,
                "username" => $result ["username"],
                "created" => $result ["created"]
            ));
        }

        echo json_encode(array(
            "recordsTotal" => $totalCount,
            "recordsFiltered" => $filterCount,
            "data" => $data
        ));
    }
}