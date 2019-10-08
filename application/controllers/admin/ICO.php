<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ICO extends CI_Controller {

    public $userData = NULL;
    
	public function __construct() {
        parent::__construct();

		$this->load->library('session');
		$this->userData = $this->session->userdata("admin");
		if ($this->userData == NULL)
            redirect("/");

        $this->load->helper('url');
		$this->load->helper('campaign');
		$this->load->helper('permission');
        $this->load->database('default');
        
        $this->load->model('ICO_transaction_model');
        $this->load->model('ConfigModal');

        if(!hasPermissionInArray(['sys_admin', 'economic_team', 'customer_manager'], $this->userData))   die;
    }

    public function transaction_page() {

        $ico_token_price = $this->ConfigModal->getValueWithKey("ico_token_price");
        $ico_discount_rate = $this->ConfigModal->getValueWithKey("ico_discount_rate");

        $this->load->view('admin/ico/transaction', ['token_price' => $ico_token_price,
                                                    'discount_rate' => $ico_discount_rate]);
    }

    function getICOTransactionData() {
        $start = $this->input->get("start");
        $length = $this->input->get("length");
        $search = $this->input->get("search")["value"];
        $filter_username = $this->input->get("filter_username");

        $org_query = "SELECT count(ico_transaction.id) as item_count
                    FROM ico_transaction";
                    //JOIN tbl_users ON (ico_transaction.user_id = tbl_users.user_id)";
        $result = $this->db->query($org_query)->result();
        $totalCount = $result [0]->item_count;
        
        $filter_query = "SELECT count(ico_transaction.id) as item_count
                        FROM ico_transaction
                        JOIN tbl_users ON (ico_transaction.user_id = tbl_users.user_id)
                        WHERE tbl_users.email LIKE '%$search%'
                        AND tbl_users.username LIKE '%$filter_username%'";
        $result = $this->db->query($filter_query)->result();
        $filterCount = $result [0]->item_count;
        
        $query = "SELECT ico_transaction.status AS payment_status,
                        ico_transaction.id,
                        ico_transaction.order_id,
                        ico_transaction.price_currency,
                        ico_transaction.price_amount,
                        ico_transaction.pay_currency,
                        ico_transaction.pay_amount,
                        ico_transaction.receive_currency,
                        ico_transaction.receive_amount,
                        ico_transaction.payment_url,
                        ico_transaction.created_at,
                        ico_transaction.payout_amount,
                        ico_transaction.payout_status,
                        ico_transaction.payout_hash,
                        ico_transaction.payout_at,

                        ico_transaction.payment_method,
                        ico_transaction.payment_details,
                        ico_transaction.guarantee_flag,
                        ico_transaction.guarantee_date,
                        ico_transaction.guarantee_price,

                        tbl_users.user_id, 
                        tbl_users.username,
                        tbl_users.email,
                        airdrop_user_info.kyc_status
                    FROM ico_transaction
                        INNER JOIN tbl_users ON (ico_transaction.user_id = tbl_users.user_id)
                        INNER JOIN airdrop_user_info ON (ico_transaction.user_id = airdrop_user_info.user_id)
                    WHERE tbl_users.email LIKE '%$search%'
                    AND tbl_users.username LIKE '%$filter_username%'
                    ORDER BY ico_transaction.created_at
                    LIMIT $start, $length";

        $results = $this->db->query($query)->result_array();

        if(!count($results)){   //empty
            echo json_encode(array(
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => array()
            ));
            return;
        }
        

        $data = array();
        foreach($results as $index => $result) {
            $ID = $result['id'];
            
            $payment_status = $result['payment_status']; //alias
            $payment_method = $result['payment_method'];

            $guarantee_date = $result['guarantee_date'];
            $guarantee_price = $result['guarantee_price'];

            $price_amount = $result['price_amount'];

            $receive_amount = $result['receive_amount'];
            $receive_currency = $result['receive_currency'];

            $payout_hash = $result['payout_hash'];
            $payout_at = $result['payout_at'];
            $payout_status = $result['payout_status'];
            $payout_amount = $result['payout_amount'];
            $kyc_status = $result['kyc_status'];

            $payment_status_array = array(
                'new' => 'info',            // just submitted.  not sure : common
                'expired' => 'dark',        // too much time elapsed     : crypto
                'canceled' => 'primary',      // client cancelled          : crypto
                'confirming' => 'warning',  // confirming on blockchain  : crypto 
                'paid' => 'success',        // all good                  : common
                'rejected' => 'danger',    // admin rejected            : card, bank
            );

            $payout_status_array = array(
                'payfirst' => 'dark',       //waiting for payment
                'processing' => 'info',     //automatically processed soon
                'success' => 'success',     //successfully sent

                'pending' => 'warning'      //fake status just to showing to admin
            );

            //default field values
            $field_payment_details = "---";    //only crypto has this, other will be date
                //- user info
            $field_username = "<a href='".base_url()."admin/user/user_details/".$result ["user_id"]."'>".$result ["username"]."</a>";
            $field_email = $result ["email"];
            $field_kyc_status = "---";
            if($kyc_status == 0)    $field_kyc_status = '<span class="badge badge-pill badge-danger">Not Passed</span>';
            if($kyc_status == 1)    $field_kyc_status = '<span class="badge badge-pill badge-info">Pending</span>';
            if($kyc_status == 2)    $field_kyc_status = '<span class="badge badge-pill badge-success">Passed</span>';
                //- order info
            $field_payout_amount = $result['payout_amount'];
            $field_price_amount = '&euro;'.$result['price_amount'];
            $field_created_at = $result['created_at'];
                //- guarantee info
            $field_guarantee_flag = $result['guarantee_flag'] ? 'Yes' : 'No';
            $field_guarantee_date = "---";
            $field_guarantee_price = "---";
                //- payment
            $field_payment_method = $result['payment_method'] == 'crypto' ? 'Crypto Currency' : ($result['payment_method'] == 'card' ? 'Credit Card' : 'Bank Transfer' );
            $field_payment_currency = empty($result['pay_currency']) ? '---' : $result['pay_currency'];
            $field_payment_amount =empty($result['pay_amount']) ? '---' : $result['pay_amount'];
            $field_payment_details = "---";
            $field_payment_status = "---";
            if(!empty($payment_status))
                $field_payment_status = '<span class="badge badge-pill badge-'.$payment_status_array[$payment_status].'">'.$payment_status.'</span>';

                //- receive
            $field_receive_currency = empty($result['receive_currency']) ? '---' : $result['receive_currency'];
            $field_receive_amount = empty($result['receive_amount']) ? '0' : $result['receive_amount'];
                //- payout
            $field_payout_status = "---";
            $field_payout_hash = "---";
            $field_payout_at = "---";

            $payout_status = $result['payout_status'];
            if($result['payment_status'] == 'paid' && $result['payout_status'] == 'payfirst')     //waiting for admin to click 'Payout' button
                $payout_status = "pending";
            if($payout_status != 'payfirst'){
                $field_payout_status = '<span class="badge badge-pill badge-'.$payout_status_array[$payout_status].'">'.$payout_status.'</span>';
            }

            if($result['payout_status'] == 'success'){
                $field_payout_hash = '<a target="_blank" href="https://etherscan.io/tx/'.$result['payout_hash'].'">Link</a>';
                $field_payout_at = $result['payout_at'];
            }
            else if($result['payout_status'] == 'processing'){
                $field_payout_hash = "<input type='text' class='form-control' id='field_payout_hash_$ID' value='$payout_hash'>";
                $field_payout_at = "<input type='text' class='form-control datepicker' id='field_payout_at_$ID' value='$payout_at'>";
            }

                //- action
            $field_change_status_action = "---";
            $field_change_payout_status_action = "---";
            $field_save_action = "---";
            $field_payout_action = "---";

            if($result['kyc_status'] == 2 && $payout_status == 'pending'){
                $field_payout_action = '<button class="btn btn-primary btn-xs btn-block" onclick="payout('.$ID.')">Payout!</button>';
            }

            // only 'processing' -> 'success'
            if($payout_status == 'processing'){
                //payout change select
                $field_change_payout_status_action = "<select class='form-control' id='field_change_payout_status_$ID'>";
                foreach($payout_status_array as $state => $value){
                    if($state == 'pending')   continue;
                    $selected_attr = ($state == $payout_status ? " selected='selected' " : " ");
                    $field_change_payout_status_action .= "<option value='$state' $selected_attr>".ucfirst($state)."</option>";
                }
                $field_change_payout_status_action .= "</select>";

                //editable hash
            }

            $field_save_action = '<button class="btn btn-primary btn-xs btn-block" onclick="onUpdateTransaction('. "'". $result['payment_method'] . "', ".$result['id'].')"><i class="fa fa-save"></i></button>';

            //Crypto specific
            if($result['payment_method'] == 'crypto'){
                $field_payment_details = '<a class="btn btn-primary btn-xs" target="_blank" href="'.$result['payment_url'].'">Link</a>';

                if($result['guarantee_flag']){
                    $field_guarantee_date = "<input type='text' class='form-control datepicker' id='field_guarantee_date_$ID' value='$guarantee_date'>";
                    $field_guarantee_price = "<input type='number' class='form-control' id='field_guarantee_price_$ID' value='$guarantee_price'>";
                }
                //actions
            }

            //Card specific
            if($result['payment_method'] == 'card'){
                $status_for_card = ['new', 'paid', 'rejected', 'expired'];

                $field_payment_details = $result['created_at'];

                $field_change_status_action = "<select class='form-control' id='field_change_status_$ID'>";
                foreach($status_for_card as $state){
                    $selected_attr = ($state == $payment_status ? " selected='selected' " : " ");
                    $field_change_status_action .= "<option value='$state' $selected_attr>".ucfirst($state)."</option>";
                }
                $field_change_status_action .= "</select>";

                $field_receive_currency = "<input type='text' class='form-control' id='field_receive_currency_$ID' value='$receive_currency'>";
                $field_receive_amount = "<input type='number' class='form-control' id='field_receive_amount_$ID' value='$receive_amount'>";

                $field_price_amount = "<input type='number' class='form-control' id='field_price_amount_$ID' value='$price_amount'
                                        onchange='onChangePrice( $ID )' >";
                $field_payout_amount = "<input type='number' class='form-control' id='field_payout_amount_$ID' value='$payout_amount'>";
            }

            //bank transfer specific
            if($result['payment_method'] == 'bank'){
                $status_for_bank = ['new', 'paid', 'rejected', 'expired'];

                $field_payment_details = $result['created_at'];

                $field_change_status_action = "<select class='form-control' id='field_change_status_$ID'>";
                foreach($status_for_bank as $state){
                    $selected_attr = ($state == $payment_status ? " selected='selected' " : " ");
                    $field_change_status_action .= "<option value='$state' $selected_attr>".ucfirst($state)."</option>";
                }
                $field_change_status_action .= "</select>";

                $field_receive_currency = "<input type='text' class='form-control' id='field_receive_currency_$ID' value='$receive_currency'>";
                $field_receive_amount = "<input type='number' class='form-control' id='field_receive_amount_$ID' value='$receive_amount'>";

                // $field_price_currency = "<input type='text' class='form-control' id='field_price_currency_$ID' value='EUR'>";
                $field_price_amount = "<input type='number' class='form-control' id='field_price_amount_$ID' value='$price_amount'
                                        onchange='onChangePrice( $ID )' >";
                // $temp = "<div class='input-group'>
                //             <span class='input-group-addon'><i class='cc ETH-alt font-size-20'></i></span>
                //             <input type='text' class='form-control' placeholder='ERC20' value='0xbc59d75ef87eb7f924e97ca1446bee5e5e76e4a1' disabled=''>
                //         </div>";
                $field_payout_amount = "<input type='number' class='form-control' id='field_payout_amount_$ID' value='$payout_amount'>";
            }

            array_push($data, array(
                "no" => $start + $index + 1,
                //- user info
                'field_username' => $field_username,
                'field_email' => $field_email,
                'field_kyc_status' => $field_kyc_status,
            
                //- order info
                'field_payout_amount' => $field_payout_amount,
                'field_price_amount' => $field_price_amount,
                'field_created_at' => $field_created_at,
                //- guarantee info
                'field_guarantee_flag' => $field_guarantee_flag,
                'field_guarantee_date' => $field_guarantee_date,
                'field_guarantee_price' => $field_guarantee_price,
                //- payment
                'field_payment_method' => $field_payment_method,
                'field_payment_currency' => $field_payment_currency,
                'field_payment_amount' => $field_payment_amount,
                'field_payment_details' => $field_payment_details,
                'field_payment_status' => $field_payment_status,
                //- receive
                'field_receive_currency' => $field_receive_currency,
                'field_receive_amount' => $field_receive_amount,
                //- payout
                'field_payout_status' => $field_payout_status,
                'field_payout_hash' => $field_payout_hash,
                'field_payout_at' => $field_payout_at,

                //- action
                'field_change_status_action' => $field_change_status_action,
                'field_change_payout_status_action' => $field_change_payout_status_action,
                'field_save_action' => $field_save_action,
                'field_payout_action' => $field_payout_action,
            ));
        }

        echo json_encode(array(
            "recordsTotal" => $totalCount,
            "recordsFiltered" => $filterCount,
            "data" => $data
        ));
    }

    public function payout() {
        $id = $this->input->post('id', TRUE);
        $success = 0;
        if(is_numeric($id) && $this->ICO_transaction_model->payout($id)){
            $success = 1;
            $user_id = $this->ICO_transaction_model->getTransactionOwner($id);
            $this->ICO_transaction_model->recalcUserSale($user_id);
            $this->ICO_transaction_model->recalcTotalSale();
        }
        echo json_encode(array(
            "success" => $success,
            'csrf_token_name' => $this->security->get_csrf_token_name(),
            'csrf_token_value' => $this->security->get_csrf_hash(),
        ));
    }

    public function updateTransaction() {
        $params = $this->input->post(NULL, TRUE);
        $success = 0;
        if($this->ICO_transaction_model->updateTransaction($params)){
            $success = 1;

            $user_id = $this->ICO_transaction_model->getTransactionOwner($params['id']);
            $this->ICO_transaction_model->recalcUserSale($user_id);
            $this->ICO_transaction_model->recalcTotalSale();
        }
        echo json_encode(array(
            "success" => $success,
            'csrf_token_name' => $this->security->get_csrf_token_name(),
            'csrf_token_value' => $this->security->get_csrf_hash(),
        ));
    }
}
