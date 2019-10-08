<?php
/**
 * Description of ICO Transaction
 *
 * @author yakov
 */
class ICO_Transaction_Model extends CI_Model {
    private $table_name;

    public function __construct(){
        parent::__construct();
        $this->table_name = 'ico_transaction';
    }

    public function getTotalSales(){
        $row = $this->db->query("SELECT value FROM tbl_config WHERE config_key = 'ico_total_sales'")->row();
        if($row)    return $row->value;
        return 0;
    }

    public function getTotalTokenSales(){
        $row = $this->db->query("SELECT value FROM tbl_config WHERE config_key = 'ico_total_token_sales'")->row();
        if($row)    return $row->value;
        return 0;
    }

    public function new_crypto_transaction($userid, $guarantee_flag, $payout_amount, $order){

        $result = $this->db->insert($this->table_name, array(
            'user_id' => $userid,
            'payment_method' => 'crypto',
            'payment_details' => json_encode($order),
            'guarantee_flag' => $guarantee_flag, 
            'order_id' => $order->order_id,
            'coingate_id' => $order->id,
            'status' => $order->status,
            'price_currency' => strtoupper($order->price_currency),
            'price_amount' => $order->price_amount,
            'receive_currency' => strtoupper($order->receive_currency),
            'payment_url' => $order->payment_url,
            'payout_amount' => $payout_amount
        ));

        return $result;
    }

    public function new_bank_transaction($userid, $order_id, $guarantee_flag, $details_json){
        $details = json_decode($details_json, TRUE);
        if(empty($details['currency']) || empty($details['amount']))
            return false;

        $result = $this->db->insert($this->table_name, array(
            'user_id' => $userid,
            'payment_method' => 'bank',
            'order_id' => $order_id,
            'guarantee_flag' => $guarantee_flag,
            'payment_details' => $details_json,
            'status' => 'new', //???
            'pay_currency' => strtoupper($details['currency']),
            'pay_amount' => $details['amount'],
        ));

        return $result;
    }

    public function new_card_transaction($userid, $order_id, $guarantee_flag, $price_amount, $payout_amount, $details_obj){
        if(empty($details_obj->currency) || empty($details_obj->amount))
            return false;
        $details_json = json_encode($details_obj);

        $details_obj->amount /= 100.0;

        $result = $this->db->insert($this->table_name, array(
            'user_id' => $userid,
            'payment_method' => 'card',
            'order_id' => $order_id,
            'guarantee_flag' => $guarantee_flag,
            'payment_details' => $details_json,
            'status' => 'new',
            'pay_currency' => strtoupper($details_obj->currency),
            'pay_amount' => $details_obj->amount,

            'price_currency' => 'EUR',
            'price_amount' => $price_amount,
            'receive_currency' => strtoupper($details_obj->currency),
            'receive_amount' => $details_obj->amount,  //maybe later???
            'payout_amount' => $payout_amount
        ));

        return $result;
    }
    
    public function get_transactions($userid){
        $result = $this->db->where(array('user_id' => $userid))
                    // ->limit($length, $start)
                    ->get($this->table_name); //swap start, length
        return $result->result_array();
    }

    public function webhook_event($webhook){

        //fetch previous state
        $query = $this->db->select('user_id, status, price_amount')
                        ->where(array('order_id' => $webhook['order_id']))
                        ->get($this->table_name);
        $prev_state = $query->row();
        if(!isset($prev_state))   return;

        //update to new state
        $query ="UPDATE " . $this->table_name .
                " SET status = '".$webhook['status'].
                "', receive_currency = '".$webhook['receive_currency'].
                "', receive_amount = '".$webhook['receive_amount'].
                "', pay_currency = '".$webhook['pay_currency'].
                "', pay_amount = '".$webhook['pay_amount'].
                "' WHERE order_id = '".$webhook['order_id']."'";
        $result = $this->db->query($query);
        if(!$result)   return;
            
        if($webhook['status'] == 'paid' && $prev_state->status != 'paid'){
            //do something with new payments
        }
        echo "good";
    }

    /**
     * call from admin
     */

    public function getTransactionOwner($tx_id){
        $query = "  SELECT user_id
                    FROM $this->table_name
                    WHERE id = $tx_id
                    LIMIT 1";
        $txrow = $this->db->query($query)->row();
        return $txrow->user_id;
    }

    public function payout($id){
        $query = "  UPDATE $this->table_name
                    SET `payout_status` = 'processing'
                    WHERE id = $id";
        $this->db->query($query);

        return true;
    }

    public function recalcUserSale($userid){
        $query =   "SELECT sum(payout_amount) as total
                    FROM ico_transaction
                    WHERE payout_status != 'payfirst'
                    AND user_id=$userid";
        $userRow = $this->db->query($query)->row();

        $query = "  UPDATE airdrop_user_info
                    SET `total_ico_token` = $userRow->total
                    WHERE user_id = $userid";
        $this->db->query($query);
    }

    public function recalcTotalSale(){
        // token
        $query =   "SELECT sum(payout_amount) as total
                    FROM ico_transaction
                    WHERE payout_status != 'payfirst'"; 
        $row = $this->db->query($query)->row();

        $query = "  UPDATE tbl_config
                    SET `value` = $row->total
                    WHERE `config_key` = 'ico_total_token_sales'";
        $this->db->query($query);

        // euro
        $query =   "SELECT sum(price_amount) as total
                    FROM ico_transaction
                    WHERE payout_status != 'payfirst'"; 
        $row = $this->db->query($query)->row();

        $query = "  UPDATE tbl_config
                    SET `value` = $row->total
                    WHERE `config_key` = 'ico_total_sales'";
        $this->db->query($query);
    }

    // public function updateTotalSale($userid){
    //     $query =   "SELECT sum(payout_amount) as total;
    //                 FROM ico_transaction
    //                 WHERE payout_status != 'payfirst'
    //                 LIMIT 1"; 
    //     $userRow = $this->db->query($query)->row();

    //     $query = "  UPDATE airdrop_user_info
    //                 SET `total_ico_token` = $userRow->total
    //                 WHERE user_id = $userid";
    //     $this->db->query($query);
    // }

    public function updateTransaction($data){
        return $this->db->update($this->table_name, $data, array('id' => $data['id']));
    }

    public function setAccredited($isaccredited,$user_id){
        
        $query = "  UPDATE airdrop_user_info
                    SET `is_accredited` = $isaccredited
                    WHERE `user_id` = $user_id";
        $this->db->query($query);
        
        return 0;
    }

    public function isAccreditedInvestor($user_id){
        $query = "  SELECT is_accredited
                    FROM airdrop_user_info
                    WHERE user_id = $user_id";
        // return $this->db->query($query)->row()->is_accredited;
        return false;
    }
}

?>