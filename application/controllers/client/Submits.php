<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Submits extends CI_Controller {

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
		$this->blade->render('client.submission', array("userdata" => $this->userData));
    }

    public function getData() {		
        $user_id = $this->session->userdata("user")->user_id;
        $start = $this->input->get("start");
		$length = $this->input->get("length");

        $org_query = "SELECT count(airdrop_submits.id) as item_count
                    FROM airdrop_submits
                    WHERE user_id = $user_id";
        $result = $this->db->query($org_query)->result();
        $totalCount = $result [0]->item_count;
        
        $org_query = "SELECT count(airdrop_submits.id) as item_count
                    FROM airdrop_submits
                    WHERE user_id = $user_id";
        $result = $this->db->query($org_query)->result();
        $filterCount = $result [0]->item_count;
        
        $query = "SELECT airdrop_submits.id,
							airdrop_submits.url,
                        airdrop_submits.note,
                        airdrop_submits.campaign_id,
                        airdrop_submits.score,
                        airdrop_submits.status,
						airdrop_submits.message,
                        airdrop_submits.created_at
                    FROM airdrop_submits
                    WHERE user_id = $user_id
                    ORDER BY airdrop_submits.id DESC
                    LIMIT $start, $length";

        $results = $this->db->query($query)->result_array();

        $STATUS = array(
            -1 => "Rejected",
            0 => "Pending",
            1 => "Approved",
        );

        $data = array();
        foreach($results as $index => $result) {
            array_push($data, array(
                "no" => $start + $index + 1,
                "url" => "<a href='".$result ["url"]."' title='".$result ["url"]."'>".(strlen($result ["url"]) > 20 ? substr($result ["url"], 0, 20)."..." : $result ["url"])."</a>",
                "description" => getCampaignTextWithId($result ["campaign_id"]),
                //"note" => strlen($result ["note"]) > 20 ? substr($result ["note"], 0, 20)."..." : $result ["note"],
                "note" => $result ["note"],
				"score" => $result ["score"] ." CSR",
				"message" => $result["message"],
                "status" => $STATUS [$result ["status"]],
                "created_at" => $result ["created_at"],
            ));
        }

        echo json_encode(array(
            "recordsTotal" => $totalCount,
            "recordsFiltered" => $filterCount,
            "data" => $data
        ));
    }
};
