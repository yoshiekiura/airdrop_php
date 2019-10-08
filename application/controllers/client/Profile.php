<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public $userData = NULL;

	public function __construct() {
        parent::__construct();

		$this->load->library('session');
		$this->userData = $this->session->userdata("user");
		if ($this->userData == NULL)
            redirect("/login");
        
		$this->load->model('login_model');
        $this->load->model('airdrop_user_model');
        
        $this->load->helper('form');
        $this->load->helper('alert');
		$this->load->helper('language');
		$this->load->helper('campaign');
        $this->load->helper('kyc');
        $this->load->helper('randomizer');

        $this->load->library('upload');
        $this->load->database('default');
    }

    public function index(){
        $kyc_info_all_submitted = 1;
        foreach(KYC_ITEMS as $item){
            if(empty($this->userData->$item)){
                $kyc_info_all_submitted = 0;
            }
        }

        $this->blade->render('client.profile', array("userdata" => $this->userData, "kyc_info_all_submitted" => $kyc_info_all_submitted));
	}
	
	public function update_profile(){
        
        $userData = $this->session->userdata('user');
        $user_id = $userData->user_id;
        
        if($userData->kyc_status == 2){
            set_message('error', "You can't change your personal details after KYC verification!");
            redirect('/profile');
            return;
        }

		if (!empty($_FILES['avatarimg']['name'])) {
			$_data = $this->input->post('cropped_photo');
			list($type, $_data) = explode(';', $_data);
			list(, $_data)      = explode(',', $_data);

			$_data = base64_decode($_data);
			$imageName = $user_id.'.png';
			$data['avatar'] = $imageName."?ver=".date("YmdHis");
			
			file_put_contents(FCPATH.'asset/uploads/'.$imageName, $_data);
		}else{
            set_message('error', "Please upload valid image file!");
            redirect('/profile');
            return;
        }
		
		// if (!empty($_FILES['avatar']['name'])) {
		// 	$file_ext = explode('.', $_FILES['avatar']['name']);
		// 	$len = count($file_ext);
		// 	if(in_array(strtolower($file_ext[$len-1]), array('jpg','jpeg','png','gif')) == false){
		// 		set_message('error', "Your avatar must be an image!");
		// 		redirect('profile');
		// 	}
		// 	$image_data['upload_path'] = FCPATH.'/asset/uploads';
		// 	$image_data['allowed_types'] = 'jpg|jpeg|png|gif';
		// 	$image_data['max_size'] = '2048';
		// 	$image_data['file_name'] = date("YmdHis");
			
		// 	$this->load->library('upload', $image_data	);
		// 	$this->upload->initialize($image_data);
		// 	$this->upload->do_upload('avatar');

		// 	$data['avatar'] = $image_data['file_name'].'.'.$file_ext[$len-1];
		// }

		$this->airdrop_user_model->update_data($data);
		set_message('success', "Successfully changed!");
		redirect('/profile');
    }
    
    public function update_social_media(){
		//$this->login_model->update_username($this->input->post('username'));
		$social = json_encode($this->input->post('social_accounts', TRUE));
		if( !isset($social) || empty($social) || $social == 'null'){
            $data['social_accounts'] = '{}';
            set_message('error', "Please enter correct values!");
        }
		else{
			$data['social_accounts'] = $social;
    		$this->airdrop_user_model->update_data($data);
            set_message('success', "Successfully changed!");
        }
		redirect('/profile');
    }
    
    public function update_kyc_info(){
        // $kyc_info = json_encode($this->input->post('kyc_info'));
        if($this->userData->kyc_status == 2){
            set_message('error', "You can't change your personal details after KYC verification!");
            redirect('/profile');
            return;
        }
        
        foreach(KYC_ITEMS as $item){
            if(empty($this->input->post($item, TRUE))){
                set_message('error', "Some information is missing!");
                redirect('/profile');
                return;
            }
        }

        $this->airdrop_user_model->update_data($this->input->post(NULL, TRUE));

		// if( !isset($kyc_info) || empty($kyc_info) || $kyc_info == 'null'){
        //     $data['kyc_info_accounts'] = '{}';
        //     set_message('error', "Please enter correct values!");
        // }
		// else{
		// 	$data['kyc_info_accounts'] = $kyc_info;
    	// 	$this->airdrop_user_model->update_data($data);
        //     set_message('success', "Successfully changed!");
        // }
        set_message('success', "Successfully changed!");
		redirect('/profile');
    }
    
    public function kyc_verification(){
        if($this->userData->kyc_status == 2){
            set_message('error', "You can't change your personal details after KYC verification!");
            redirect('/profile');
            return;
        }

        foreach(PROOF_TYPES as $proof => $details){
            if(!isset($_FILES[$proof])){
                set_message('error', "Proof of $proof is missing!");
                redirect('/profile');
                return;
            }
            if($_FILES[$proof]['error'] != 0){
                set_message('error', "Error occured during uploading. Please try again later with smaller images.");
                redirect('/profile');
                return;
            }
            if($_FILES[$proof]['size'] == 0){
                set_message('error', "The image of $proof proof is too small.  Please upload bigger image.");
                redirect('/profile');
                return;
            }
            if($proof == 'selfie')  break;
            if(empty($this->input->post($proof.'_proof_type', TRUE)) || empty($details[$this->input->post($proof.'_proof_type', TRUE)])){
                set_message('error', "Please choose proper $proof document type.");
                redirect('/profile');
                return;
            }
        }

        // store files

        $config['upload_path']     = FCPATH.'asset/uploads/individual/';
        $config['allowed_types']   = 'jpg|jpeg|png|pdf';
        $config['max_size']        = 10240; //10 MB
        $config['file_ext_tolower']= TRUE;

        $toStoreDB = array();

        foreach(PROOF_TYPES as $proof => $details){
            $file_name = $this->userData->user_id.'--'.$proof;
            if($proof != 'selfie') $file_name .= '--'.$this->input->post($proof.'_proof_type', TRUE);
            $file_name.='--'.generate_rand_string(10);
            $config['file_name'] = $file_name;
            $this->upload->initialize($config);
            if(! $this->upload->do_upload($proof)){
                $error = array('error' => $this->upload->display_errors());
                set_message('error', "Uploading Error.");
                redirect('/profile');
                return;
            }
            
            $data = $this->upload->data(); //upload status

            $toStoreDB[$proof.'_proof'] = $data['file_name'];
            if($proof != 'selfie')  $toStoreDB[$proof.'_proof_type'] = $details[$this->input->post($proof.'_proof_type', TRUE)];
        }

        //set kyc status to Pending
        $toStoreDB['kyc_status'] = 1;

        $this->airdrop_user_model->update_data($toStoreDB);
        set_message('success', "Successfully Submitted! Please wait while admin reviews your documents.");
		redirect('/profile');
    }
}
