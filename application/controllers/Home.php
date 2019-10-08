<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {
        parent::__construct();

		$this->load->helper('url');
		$this->load->helper('cookie');
        $this->load->database('default');
        $this->load->model('ICO_transaction_model');
        $this->load->model('ConfigModal');
	}
	
	public function bladeTest(){
		//$this->blade->view(APPPATH.'views\\temp.blade.php');
		$this->blade->render('temp');
	}
    
	public function index() {
        // $total_sales = $this->ICO_transaction_model->getTotalSales();
        // $total_token_sales = $this->ICO_transaction_model->getTotalTokenSales();
        
        $total_sales = $this->ConfigModal->getValueWithKey('assigned_airdrop_token');
        $total_token_sales = 20000000;

        // add manual sales
        //$total_sales += (1424425 + 109613) * 0.4;
        //$total_token_sales += (1424425 + 109613);

		$this->load->view('home/indexa', array(
            'hardcap' => $this->ConfigModal->getValueWithKey('cap_hard'),
            // 'softcap' => $this->ConfigModal->getValueWithKey('cap_soft'),
            'softcap' => $total_token_sales,
            "total_sales" => $total_sales,
            "total_token_sales" => $total_token_sales,
        ));
	}

    public function main() {
        // $total_sales = $this->ICO_transaction_model->getTotalSales();
        // $total_token_sales = $this->ICO_transaction_model->getTotalTokenSales();
        // $total_sales = $this->ConfigModal->getValueWithKey('ico_total_sales');  -VGR
        $total_sales = $this->ConfigModal->getValueWithKey('assigned_airdrop_token');
        $total_token_sales = $this->ConfigModal->getValueWithKey('ico_total_token_sales');

        // add manual sales
        //$total_sales += (1424425 + 109613) * 0.4;
        $total_token_sales += (1424425 + 109613);

        $this->load->view('home/index', array(
            'hardcap' => $this->ConfigModal->getValueWithKey('cap_hard'),
            // 'softcap' => $this->ConfigModal->getValueWithKey('cap_soft'),
            'softcap' => $total_token_sales,
            "total_sales" => $total_sales,
        ));
    }

	public function ref($ref_id = 0) {
		if(isset($_COOKIE["ref_id"])){
			unset($_COOKIE['ref_id']);
    		setcookie("ref_id", $ref_id, time() + 3600 * 24, '/');
		}

		else if ($ref_id != 0 && !isset($_COOKIE["ref_id"])) {
			setcookie("ref_id", $ref_id, time() + 3600 * 24, '/');
		}
		
		redirect(base_url(), 'refresh');
    }
    
    public function listen_webhook(){
        if($this->input->post('token') == 'SocialRemit_ICO_Webhook'){
            $this->ICO_transaction_model->webhook_event($this->input->post());
        }
    }

    public function cron_job(){
        if($this->input->post('token') == 'SocialRemit_ICO_CronJob'){
            
        }
    }
}
