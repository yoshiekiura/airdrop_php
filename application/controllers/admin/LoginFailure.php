<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class LoginFailure extends CI_Controller {
    
    public function __construct() {
        parent::__construct();

        $this->load->library('session');
        $this->load->helper('permission');

		$this->userData = $this->session->userdata("admin");
		if ($this->userData == NULL)
            redirect("/");

        $this->load->model('Login_failure_model');
        $this->load->helper('form');
        $this->load->helper('alert');
        $this->load->helper('language');
        $this->load->helper('messages');
        messages_helper();
        $language = "english";
        $this->lang->load($language, $language);
	}

	function index (){
		return $this->load->view('admin/login_failure/login_failure');
	}

	function getFailureData() {
        // if(!hasPermissionInArray(['sys_admin', 'economic_team', 'customer_manager'], $this->userData))   die;
		$draw = $this->input->get("draw");
        $start = $this->input->get("start");
        $length = $this->input->get("length");
		$searchValue = $this->input->get("search")["value"];
		$columnIndex = $this->input->get('order')[0]['column']; // Column index
		$columnName = $this->input->get('columns')[$columnIndex]['data']; // Column name
		if(empty($columnName)) $columnName = 'attempt_time';
		$columnSortOrder = $this->input->get('order')[0]['dir']; // asc or desc
		if(empty($columnSortOrder)) $columnSortOrder = 'desc';
		if($columnName == 'no'){
			$columnName = 'id';
			// $columnSortOrder = 'desc';
		}

		## Search 
		$searchQuery = " ";
		if($searchValue != ''){
			$searchQuery = " and (email like '%".$searchValue."%'
								or ip like '%".$searchValue."%' ) ";
		}

		## Total number of records without filtering
        $org_query = "SELECT COUNT(user_id) as totalCount FROM tbl_login_failures";
        $result = $this->db->query($org_query)->result();
		$totalCount = $result [0]->totalCount;

		## Total number of records with filtering
        $filter_query = "SELECT COUNT(tbl_login_failures.user_id) AS filterCount FROM tbl_login_failures
						JOIN tbl_users ON (tbl_login_failures.user_id = tbl_users.user_id)
						WHERE 1 $searchQuery ";
        $result = $this->db->query($filter_query)->result();
		$filterCount = $result [0]->filterCount;

		## Fetch record 
		$fetch_query = "SELECT *, tbl_users.email FROM tbl_login_failures 
						JOIN tbl_users
						ON (tbl_login_failures.user_id = tbl_users.user_id)
						WHERE 1 $searchQuery
						ORDER BY $columnName $columnSortOrder
						LIMIT $start, $length";
		$results = $this->db->query($fetch_query)->result_array();

        $data = array();
        foreach($results as $index => $result) {
            array_push($data, array(
                "no" => $start + $index + 1,
                "email" => "<a href='".base_url()."admin/user/user_details/".$result["user_id"]."'>".$result ["email"]."</a>",
                "attempt_time" => $result["attempt_time"],
				"until_time" => $result["until_time"],
				"ip" => empty($result["ip"]) ? 'Not Available' : $result["ip"],
				"useragent" => empty($result["useragent"]) ? 'Not Available' : $result["useragent"],
            ));
        }

        echo json_encode(array(
            "recordsTotal" => $totalCount,
            "recordsFiltered" => $filterCount,
            "data" => $data
        ));
    }
}
