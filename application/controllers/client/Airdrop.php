<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Airdrop extends CI_Controller {

	public $userData = NULL;

	public function __construct() {

        parent::__construct();
		$this->load->library('session');
		$this->userData = $this->session->userdata("user");
		if ($this->userData == NULL)
            redirect("/login");
        // $query = "SELECT * from
        //     FROM airdrop_user_info
        //     WHERE user_id = $user_id";
		
		$this->load->helper('url');
        $this->load->database('default');
        $this->load->model('ConfigModal');
        $this->load->model('MLM_model');
    }
    
	public function index() {
        $user_id = $this->userData->user_id;

		$query = "SELECT total_score 
				FROM airdrop_user_info
				WHERE user_id = $user_id";
		$totalScore = $this->db->query($query)->result()[0]->total_score;

        $coingate_rates = file_get_contents('https://api.coingate.com/v2/rates/merchant');

        $this->blade->render('client.dashboard', array(
            "userdata" => $this->userData,
			"csr_balance"=>$totalScore,
            'coingate_rates' => $coingate_rates,
        ));
    }
    
    public function status_page(){
        $user_id = $this->userData->user_id;

		$query = "SELECT total_score 
				FROM airdrop_user_info
				WHERE user_id = $user_id";
		$totalScore = $this->db->query($query)->result()[0]->total_score;

		$query = "SELECT COUNT(id) AS total,
						SUM(IF(total_score > $totalScore, 1, 0)) AS rank
				FROM airdrop_user_info";
		$result = $this->db->query($query)->result()[0];
		$totalCount = $this->db->query($query)->result()[0]->total;
		$rank = $result->rank;

		$tempRank = $rank - 5;
		if ($tempRank < 0)	$tempRank = 0;

		$username = $this->userData->username;
		$query = "SELECT airdrop_user_info.user_id,
						username,
						email,
						total_score,
						avatar
				FROM airdrop_user_info
				JOIN tbl_users ON(airdrop_user_info.user_id = tbl_users.user_id)
				WHERE activated = 1 AND role_id = 2
				ORDER BY total_score DESC, username='$username' DESC
				LIMIT $tempRank, 10";
		$result = $this->db->query($query)->result();

		// $this->load->view('client/airdrop', array(
		// 	"user_id" => $user_id,
		// 	"list" => $result,
		// 	"total" => $totalCount,
		// 	"totalScore"=>$totalScore,
		// 	"rank" => $rank,
		// 	"tempRank" => $tempRank
        // ));
        $commissions = $this->MLM_model->getLevelCommissions();

        $this->blade->render('client.status', array(
            "userdata" => $this->userData,
			"user_id" => $user_id,
			"list" => $result,
			"total" => $totalCount,
			"csr_balance"=>$totalScore,
			"rank" => $rank,
            "tempRank" => $tempRank,
            "assigned_csr" => $this->ConfigModal->getValueWithKey("assigned_airdrop_token"),
            "total_csr" => 20000000,
            "commissions" => $commissions,
        ));
    }

    public function logout() {
        $this->session->unset_userdata("user");
        redirect('/');
    }
}
