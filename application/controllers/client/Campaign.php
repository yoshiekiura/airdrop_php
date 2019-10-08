<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * Home Controller
 * Management all actions before login.
 * 
 * @author yakov
 */
class Campaign extends CI_Controller {
	/**
	 * Show first homepage
	 * 
	 * @author yakov
	 */
	public $userData = NULL;

	public function __construct() {
		  parent::__construct();

		$this->load->library('session');
		$this->userData = $this->session->userdata("user");
		if ($this->userData == NULL)
			redirect("/login");

        $this->load->model('airdrop_submit_model');

		$this->load->helper('campaign');
		$this->load->helper('alert');
		$this->load->helper('form');
        $this->load->database('default');
	}
	
    public function index() {
		$campData = C_DATA;
		$user_id = $this->userData->user_id;

		$query = "SELECT ";
		$campCnt = count($campData);
		foreach($campData as $id => $cell) {
			if ($cell["canRepeat"])
				$query .= "SUM(IF(campaign_id = $id AND status >= 0 AND DATE(created_at) = CURDATE(), 1, 0)) AS count_$id,";
			else
				$query .= "SUM(IF(campaign_id = $id AND status >= 0, 1, 0)) AS count_$id,";
		}
		$query = substr($query, 0, strlen($query) - 1);
		$query .= " FROM airdrop_submits
					WHERE user_id = $user_id";
		$campStatus = $this->db->query($query)->result_array();

        $data['campaign_tabs'] = getCampaignTab();
		$data['campaign_data'] = getCampaignData();
        $data["campStatus"] = $campStatus [0];
        $data['userdata'] = $this->userData;
        // $this->load->view('client/campaign',$data);
        $this->blade->render('client.campaign',$data);
	}
	public function submit_campaign(){
		$user_id = $this->userData->user_id;

		$campId = $this->input->post('campaign_id', TRUE);
		$data['url'] = C_DATA [$campId]["url"];
		$data['note'] = $this->input->post('note', TRUE);
		$data['campaign_id'] = $campId;
		$data['score'] = C_DATA [$campId]["score"];
		
		$data['user_id'] = $user_id;
		$url = $this->input->post('url', TRUE);
		if(isset($url)) $data['url']=$url;

		// echo $data;
		$tabName = C_TABS [C_DATA [$campId]["tab_id"]];
		if (!isset($this->session->userdata("user")->social_accounts[$tabName])
		    		|| $this->session->userdata("user")->social_accounts[$tabName] == "") {
				if(!isset($url)){
					redirect(base_url()."client/campaign", 'refresh');
					return;
				}
		}
		if (!$this->airdrop_submit_model->canSaveSubmit($user_id, $campId)) {
			redirect(base_url()."client/campaign", 'refresh');
			return;
		}
		if(isset($url)){
			if(strlen($url)==0 || strlen($data['note']) == 0){
				set_message('error','Please let us know both of the url and description.');
				redirect(base_url()."client/campaign", 'refresh');
				return;
			}
		}

		// print_r($this->airdro	p_submit_model->test());
		$this->airdrop_submit_model->save_submit_campaign($data);
		set_message('success', 'Successfully Submitted! Please wait while we check this.');
		/*
		auto approve
		*/
		redirect(base_url()."client/campaign", 'refresh');
	}
}
