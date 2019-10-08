<?php
class Login_failure_model extends CI_Model {
    private $table_name;

    public function __construct(){
        parent::__construct();
        $this->table_name = 'tbl_login_failures';
    }

    public function newFailure($userinfo, $ip, $useragent){
		$data = array(
			'user_id' => $userinfo->user_id,
            'ip' => $ip,
            'useragent' => $useragent,
		);

		// https://stackoverflow.com/questions/6354315/inserting-now-into-database-with-codeigniters-active-record
		$this->db->set('attempt_time', 'NOW()', FALSE); // use current attempt
		$this->db->set('until_time', "'$userinfo->wrong_password_date' + INTERVAL 1 DAY", FALSE); // already stored until time
		$result = $this->db->insert($this->table_name, $data);

        // $result = $this->db->insert($this->table_name, array(
        //     'user_id' => $userinfo->user_id,
        //     'attempt_time' => $userinfo->user_id,
        //     'until_time' => 'crypto',
        //     'ip' => 'crypto',
        //     'useragent' => 'crypto',
		// ));

		// $query = "INSERT INTO tbl_login_failures ($userinfo->user_id, attempt_time, until_time, ip, useragent) VALUE ($userinfo->user_id, NOW(), NOW() + INTERVAL 1 DAY, $ip, $useragent)";
		// $result = $this->db->query($query);

        return $result;
    }
}

?>
