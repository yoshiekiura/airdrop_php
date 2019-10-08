<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Controller {

	public $userData = NULL;

	public function __construct() {
          parent::__construct();

		$this->load->library('session');
		$this->userData = $this->session->userdata("user");
		if ($this->userData == NULL)
			redirect("/login");
		
		$this->load->helper('url');
        $this->load->helper('campaign');
        
        $this->load->database('default');
    }
    
	public function index() {
        $this->blade->render('client.transaction-airdrop', array("userdata" => $this->userData));
    }

    function getTransactionData() {
        $user_id = $this->session->userdata("user")->user_id;
        $start = $this->input->get("start");
        $length = $this->input->get("length");
        $search = $this->input->get("search")["value"];

        $org_query = "SELECT count(airdrop_transaction.id) as item_count
                    FROM airdrop_transaction
                    WHERE user_id = $user_id";
        $result = $this->db->query($org_query)->result();
        $totalCount = $result [0]->item_count;
        
        $filter_query = "SELECT count(airdrop_transaction.id) as item_count
                        FROM airdrop_transaction
                        WHERE user_id = $user_id";
        $result = $this->db->query($filter_query)->result();
        $filterCount = $result [0]->item_count;
        
        $query = "SELECT airdrop_transaction.id,
                         airdrop_transaction.score,
                         airdrop_transaction.amount,
                         airdrop_transaction.transaction_id,
                         airdrop_transaction.created_at
                    FROM airdrop_transaction
                    WHERE user_id = $user_id
                    ORDER BY airdrop_transaction.created_at
                    LIMIT $start, $length";

        $results = $this->db->query($query)->result_array();

        $data = array();
        foreach($results as $index => $result) {
            array_push($data, array(
                "no" => $start + $index + 1,
                "score" => $result ["score"],
                "amount" => $result ["amount"],
                "transaction_id" => "<a href='https://etherscan.io/tx/".$result ["transaction_id"]."' target='_blank'>".$result ["transaction_id"]."</a>",
                "created_at" => $result ["created_at"]
            ));
        }

        echo json_encode(array(
            "recordsTotal" => $totalCount,
            "recordsFiltered" => $filterCount,
            "data" => $data
        ));
    }
};
