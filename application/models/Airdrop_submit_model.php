<?php
/**
 * Description of client_model
 *
 * @author yakov
 */
class Airdrop_Submit_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function save_submit_campaign($data){
        $sql = "INSERT INTO airdrop_submits (user_id, `url`, note, campaign_id, score, message, status,created_at)
                VALUES (?,?,?,?,?,'','pending', NOW())";
                //VALUES (".$data['user_id'].",'".$data['url']."','".$data['note']."',".$data['campaign_id'].",".$data['score'].",' '".",'pending'".", NOW())";
        $this->db->query($sql, array($data['user_id'], $data['url'], $data['note'], $data['campaign_id'], $data['score']));
    }

    public function canSaveSubmit($user_id, $campId) {
		//Check Maximize submit count.
		$query = "SELECT ";
		if (C_DATA [$campId]["canRepeat"])
			$query .= "SUM(IF(campaign_id = $campId AND status >= 0 AND DATE(created_at) = CURDATE(), 1, 0)) AS `count`";
		else
			$query .= "SUM(IF(campaign_id = $campId AND status >= 0, 1, 0)) AS `count`";

		$query .= " FROM airdrop_submits
					WHERE user_id = $user_id";
		$campStatus = $this->db->query($query)->result_array();

		return $campStatus [0]["count"] < C_DATA [$campId]["count"];
    }
}
