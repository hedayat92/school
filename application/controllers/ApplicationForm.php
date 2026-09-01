<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class ApplicationForm extends CI_Controller { 

    function __construct() {
        parent::__construct();
        		$this->load->database();
                $this->load->library('session');
    }


     public function index ($param1='' , $param2=''){
	
			if($param1 == 'validate') {
			 $value = array();
					$a = rand (1,10);
					$b = rand (1,12);
					$c = rand (1,30)%3;
					if($c==0){
						$operator = '+';
						$ans = $a+$b;
					}
					else if($c==1){
						$operator = 'X';
						$ans = $a*$b;
					}
					else if($c==2){
						$operator = '-';
						$ans = $a-$b;
					}
		
			$this->session->set_userdata('security_ans',$ans);
			$value['question']  = $a." ".$operator." ".$b." = ?";
        	$this->load->view('frontend/form', $value);
			
		 }
		 
	}
	
	
	function send(){
	
		$answer = $this->input->post('answer');
			$ans = $this->input->post('ans');
				if($ans == $answer) {
					$data['name'] 		= $this->input->post('name');
					$data['roll'] 		= $this->input->post('roll');
					$data['email'] 		= $this->input->post('email');
					$data['phone'] 		= $this->input->post('phone');
					$data['class_id'] 	= $this->input->post('class_id');
					$data['section_id'] 	= $this->input->post('section_id');
					$data['age'] 			= $this->input->post('age');
					$data['sex'] 			= $this->input->post('sex');
					$data['status'] 		= 'pending';
					$data['address'] 		= $this->input->post('address');
					$data['password'] 		= $this->input->post('password');
					$check_email = $this->db->get_where('form', array('email' => $data['email']))->row()->email; // validate the registration code from admin
					
					$email 			= $data['email'];
					$name 			= $data['name'];
				
					$sql = "select * from form order by form_id desc limit 1";
					$return_query = $this->db->query($sql)->row()->form_id + 1;
					$data['form_id'] = $return_query;
					
					if($check_email != "") {
						$this->session->set_flashdata('error_message', get_phrase('email_address_already_exist'));	// validate the registration code from admin
						redirect(base_url() . 'applicationForm/index/validate', 'refresh');	// redirect if the code is not valid.
					}
					if($check_email == "") {
		
						$this->db->insert('form', $data);
						
						$message = $content."</br>";
						$message .= $category." ".$whom_to_meet." ".$purpose;
						$message .= "Phone : ".$mobile;
						$message .= "Email : ". $email;
						$this->email_model->account_opening_email('student', $data['email']); //************************** send message to student email address.
						
						$this->session->set_flashdata('flash_message' , get_phrase('you_have_successfully_applied'));
						redirect(base_url() . 'applicationForm/index/validate', 'refresh');
					} 
				}else{
				 $this->session->set_flashdata('error_message' , get_phrase('Wrong_answer_submission_!!!'));
				redirect(base_url() . 'applicationForm/index/validate', 'refresh');
			}
	
	
	}
	
	
}