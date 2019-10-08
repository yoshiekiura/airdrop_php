<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

use CoinGate\CoinGate;
use Stripe\Stripe;

require_once APPPATH."vendor/stripe/stripe-php/init.php";

/**
 * ICO Controller
 * Management all actions of ICO.
 * 
 * @author captainhook
 */
class ICO extends CI_Controller {
    /**
     * Show first homepage
     * 
     * @author captainhook
     */
    public $userData = NULL;

    public function __construct() {
        parent::__construct();
        
        $this->load->library('session');
        $this->userData = $this->session->userdata("user");
        if ($this->userData == NULL)
            redirect("/login");

        $this->load->model('login_model');
        $this->load->model('ConfigModal');
        $this->load->model('ICO_transaction_model');

        $this->load->helper('purchase');
        $this->load->helper('currency');
        $this->load->helper('alert');
        $this->load->helper('randomizer');
        $this->load->helper('form');
        $this->load->database('default');

        //to load config from db
        $this->load->helper('messages');
        messages_helper();

        \Stripe\Stripe::setApiKey($this->ConfigModal->getValueWithKey("stripe_private_key"));

        //only for localhost
        // \Stripe\Stripe::setCABundlePath('D:\net setup\NetKey\ca.crt');
    }

    /**
     * Trying to check referrer http header
     */
    function check_referrer(){
        $headers = apache_request_headers();
        $referer = isset($headers['referer']) ? parse_url($headers['referer'], PHP_HOST) : "";
        if($referer == "trusted.com") {
            return true;
        }
        return false;
    }

    public function sendTransferNotification($array){
        $message = print_r($array, true);
        $params['recipient'] = 'estevez@socialremit.com';
        $params['subject'] = 'Bank Transfer Notification';
        $params['message'] = $message;
        $params['resourceed_file'] = '';

        $this->login_model->send_email($params);
    }

    public function purchase(){
        $token_amount = $this->input->post('receive-amount', TRUE);
        $pay_amount = $this->input->post('pay-amount', TRUE);
        $currency = $this->input->post('currency', TRUE);
        if(!is_numeric($token_amount) || !is_numeric($pay_amount)){
            set_message('error', "Sorry, Entered amount is not valid.  Please enter different value.");
            redirect('/ico-purchase');
        }
        if($token_amount < 10){
            set_message('error', "Sorry, Entered amount is too little.  You should purchase at least 50 tokens.");
            redirect('/ico-purchase');
        }

        $ico_token_price = $this->ConfigModal->getValueWithKey("ico_token_price");
        $ico_discount_rate = $this->ConfigModal->getValueWithKey("ico_discount_rate");

        $payout_amount = round($token_amount / $ico_discount_rate, 6);
        $price_amount = round($token_amount * $ico_token_price, 2);

        $userid = $this->userData->user_id;
        $order_id = generate_rand_string(3).'-'.generate_rand_string(3).'-'.generate_rand_string(3);

        $payment_method = $this->input->post('payment-method', TRUE);
        $guarantee_flag = ($this->input->post('guarantee-flag', TRUE) == "1" ? 1 : 0);

        if($payment_method == 'crypto'){
            $post_params = array(
                'order_id'          => $order_id,
                'price_amount'      => $price_amount,
                'price_currency'    => 'EUR',
                'receive_currency'  => 'ETH',

                'callback_url'      => base_url().'/webhook-endpoint',
                'cancel_url'        => base_url().'/ico-purchase',
                'success_url'       => base_url().'/ico-transaction',

                'title'             => 'Thanks for supporting SocialRemit!',
                'description'       => 'Order ID : '.$order_id,
                'token'             => 'SocialRemit_ICO_Webhook'
            );

            \CoinGate\CoinGate::config(array(
                'environment'               => $this->ConfigModal->getValueWithKey("coingate_environment"),
                'auth_token'                => $this->ConfigModal->getValueWithKey("coingate_auth_token"),
                'curlopt_ssl_verifypeer'    => $this->ConfigModal->getValueWithKey("coingate_curlopt_ssl_verifypeer")
            
                // 'environment'               => 'live', // sandbox OR live
                // 'auth_token'                => 'QDXcDziGzAcDmqQxkRJhSdMmmgerAiLXRKbhvkT_',
                // 'curlopt_ssl_verifypeer'    => FALSE // default is false
            ));

            $order = \CoinGate\Merchant\Order::create($post_params);

            if ($order && $this->ICO_transaction_model->new_crypto_transaction($userid, $guarantee_flag, $payout_amount, $order)) {
                header('Location: '.$order->payment_url);
                return;
            } else {
                set_message('error', "Sorry, Something went wrong.  Please try again later.  You have not been charged.");
                redirect('/ico-purchase');
            }
        }

        else if($payment_method == 'card'){
            $guarantee_flag = 0;    //doesn't apply
            $token = $this->input->post('stripe-token', TRUE);
            if(empty($token)){
                set_message('error', "Sorry, Something went wrong.  Please try again later. You have not been charged.");
                redirect('/ico-purchase');
            }
            //Ok to go
            try {
                // Use Stripe's library to make requests...

                $charge_obj = \Stripe\Charge::create([
                    'amount' => round($pay_amount * 100),
                    'currency' => $currency,
                    'description' => 'SocialRemit ICO - Purchase SREUR tokens',
                    'source' => $token,
                    'metadata' => ['order_id' => $order_id],
                ]);
                //great
                if ($this->ICO_transaction_model->new_card_transaction($userid, $order_id, $guarantee_flag, $token_amount, $payout_amount, $charge_obj)) {
                    set_message('success', "Thank you!  You'll receive tokens soon.");
                    redirect('/ico-transaction');
                }
                set_message('error', "Sorry, Something went wrong.  Please try again later.");
                redirect('/ico-purchase');
            } catch(\Stripe\Error\Card $e) {
                // Since it's a decline, \Stripe\Error\Card will be caught
                $body = $e->getJsonBody();
                $err  = $body['error'];
                
                // print('Status is:' . $e->getHttpStatus() . "\n");
                // print('Type is:' . $err['type'] . "\n");
                // print('Code is:' . $err['code'] . "\n");
                // // param is '' in this case
                // print('Param is:' . $err['param'] . "\n");
                // print('Message is:' . $err['message'] . "\n");
                set_message('error', $err['message']. " You have not been charged.");
            } catch (\Stripe\Error\RateLimit $e) {
                // Too many requests made to the API too quickly
                set_message('error', "Too many requests made to the API too quickly.  Please try again later.  You have not been charged.");
            } catch (\Stripe\Error\InvalidRequest $e) {
                // Invalid parameters were supplied to Stripe's API
                set_message('error', "Invalid parameters were supplied to Stripe.  Please try again later.  You have not been charged.");
            } catch (\Stripe\Error\Authentication $e) {
                // Authentication with Stripe's API failed
                // (maybe you changed API keys recently)
                set_message('error', "Authentication with Stripe's API failed.  Please try again later.  You have not been charged.");
            } catch (\Stripe\Error\ApiConnection $e) {
                // Network communication with Stripe failed
                set_message('error', " Network communication with Stripe failed.  Please try again later.  You have not been charged.");
            } catch (\Stripe\Error\Base $e) {
                // Display a very generic error to the user, and maybe send
                // yourself an email
                set_message('error', "Sorry, Something went wrong with Stripe.  Please try again later.  You have not been charged.");
            } catch (Exception $e) {
                // Something else happened, completely unrelated to Stripe
                set_message('error', "Sorry, Something went wrong.  Please try again later.  You have not been charged.");
            }
        }
        else if($payment_method == 'bank'){
            $guarantee_flag = 0;    //doesn't apply

            $details_json = $this->input->post('bank-details', TRUE);
            $details_array = json_decode($details_json, TRUE); //assoc array
            if(empty($details_array)){  //can't convert to json
                set_message('error', "Sorry, Please enter valid bank transfer details.");
                redirect('/ico-purchase');
            }

            $email_content = [];

            foreach(BANK_TRANSFER_ITEMS as $key => $value){
                if(empty($details_array[$key]))
                    $details_array[$key] = ($key == 'full_name'? $this->userData->first_name . ' ' . $this->userData->second_name : $this->userData->$key);
                $email_content[$value] = $details_array[$key];
            }

            $this->sendTransferNotification($email_content);

            if ($this->ICO_transaction_model->new_bank_transaction($userid, $order_id, $guarantee_flag, $details_json)) {
                //great
                set_message('success', "Thank you!  We'll review it and send tokens soon.");
                redirect('/ico-transaction');
            } else {
                set_message('error', "Sorry, Something went wrong.  Please try again later.");
                redirect('/ico-purchase');
            }
        }
        //fall back
        redirect('/ico-purchase');
    }
    
    public function purchase_page() {

        $user_id = $this->session->userdata("user")->user_id;

        $coingate_rates = file_get_contents('https://api.coingate.com/v2/rates/merchant');
        $ico_token_price = $this->ConfigModal->getValueWithKey("ico_token_price");
        $ico_discount_rate = $this->ConfigModal->getValueWithKey("ico_discount_rate");
        $ico_guarantee_rate = $this->ConfigModal->getValueWithKey("ico_guarantee_rate");
        $stripe_public_key = $this->ConfigModal->getValueWithKey("stripe_public_key");
        $is_accredited_investor = $this->ICO_transaction_model->isAccreditedInvestor($user_id);

        $this->blade->render('client.ico-purchase', array(
                            "userdata" => $this->userData,
                            'coingate_rates' => $coingate_rates === false ? '{}' : $coingate_rates,
                            'token_price'=>$ico_token_price,
                            'discount_rate'=>$ico_discount_rate,
                            'guarantee_rate'=>$ico_guarantee_rate,
                            'stripe_public_key'=>$stripe_public_key,
                            'is_accredited_investor'=>$is_accredited_investor,
                        ));
    }

    public function setAccreditedInvestor(){

        $user_id = $this->session->userdata("user")->user_id;
        $accredited_flag = $this->input->post('accredited-flag');
        $this->ICO_transaction_model->setAccredited($accredited_flag,$user_id);
        set_message('success', "Successfully changed!");
        redirect('/ico-purchase');
    }
    
    public function transaction_page() {
        $this->blade->render('client.ico-transaction', array( "userdata" => $this->userData ));
    }

    function getICOTransactionData() {
        $user_id = $this->session->userdata("user")->user_id;
        $start = $this->input->get("start");
        $length = $this->input->get("length");

        $results = $this->ICO_transaction_model->get_transactions($user_id);
        if(!count($results)){
            echo json_encode(array(
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => array()
            ));
            return;
        }

        $data = array();
        for($index = $start; $length > 0 && $index < count($results); $index++, $length--) 
        // foreach($results as $index => $result) 
        {
            $result = $results[$index];
            $payment_method = $result['payment_method'];
            $payment_status = $result['status'];

            $badge_payment_status = 'dark';     
            $badge_payout_status = 'warning';   

            /**** Common */
            $payout_status = $result['payout_status'];
            if($payment_status == 'paid' && $payout_status == 'payfirst')     $payout_status = "pending";
            if($payout_status == 'processing') $badge_payout_status = 'info';
            if($payout_status == 'success')    $badge_payout_status = 'success';

            $payment_details = "---";    //only crypto has this, other will be date

            //Crypto specific
            if($result['payment_method'] == 'crypto'){
                if($payment_status == 'new')        $payment_status = 'unpaid';
                if($payment_status == 'confirming') $badge_payment_status = 'warning';
                if($payment_status == 'paid')       $badge_payment_status = 'success';

                $payment_details = '<a class="badge badge-info" target="_blank" href="'.$result['payment_url'].'">Link</a>';

                $payment_method = 'Crypto Currency';
            }
            //Card specific
            if($result['payment_method'] == 'card'){
                // new, paid, rejected, expired
                if($payment_status == 'new'){
                    $payment_status = 'pending';
                    $badge_payment_status = 'info';
                }
                else if($payment_status == 'rejected') $badge_payment_status = 'primary';
                else if($payment_status == 'paid')       $badge_payment_status = 'success';

                $payment_details = $result['created_at'];
                $payment_method = 'Credit Card';
            }
            if($result['payment_method'] == 'bank'){
                // new, rejected, paid, expired
                if($payment_status == 'new'){
                    $payment_status = 'pending';
                    $badge_payment_status = 'info';
                }
                else if($payment_status == 'rejected')  $badge_payment_status = 'primary';
                else if($payment_status == 'paid')      $badge_payment_status = 'success';

                $payment_details = $result['created_at'];
                $payment_method = 'Bank Transfer';
            }
            
            array_push($data, array(
                "no" => $index + 1,

                //order
                "token" => "SREUR",
                "payout_amount" => $result['payout_amount'],
                "price_amount" => '&euro; '.$result['price_amount'],

                //guarantee
                "guarantee_date" => $result['guarantee_flag'] ? date('Y-m-d', strtotime("+2 years", strtotime($result['created_at']))) : '---',
                "guarantee_price" => '---',//$result['guarantee_flag'] ? '&euro; '.($result['price_amount'] * $this->ConfigModal->getValueWithKey('ico_guarantee_rate')) : '---',

                //payment
                "payment_method" => $payment_method,
                "pay_currency" => !empty($result['pay_currency']) ? $result['pay_currency'] : '---',
                "pay_amount" => $result['pay_amount'],
                "payment_details" => $payment_details,
                "status" => '<span class="badge badge-pill badge-'.$badge_payment_status.'">'.$payment_status.'</span>',

                //receive
                "payout_hash" => $result['payout_hash'] ? '<a target="_blank" href="https://etherscan.io/tx/'.$result['payout_hash'].'">'.$result['payout_hash'].'</a>' : '---',
                "payout_status" => $payout_status != 'payfirst' ? '<span class="badge badge-pill badge-'.$badge_payout_status.'">'.$payout_status.'</span>' : '---',
                "payout_at" => $result['payout_at'] ? $result['payout_at'] : '---',
            ));
        }

        echo json_encode(array(
            "recordsTotal" => count($results),
            "recordsFiltered" => count($results),
            "data" => $data
        ));
    }
}
