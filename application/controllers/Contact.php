<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Contact extends CI_Controller { 

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
        	$this->load->view('frontend/contact', $value);
			
		 }
		 
	}
	
	
	function send(){
	
	
			$answer = $this->input->post('answer');
			$ans = $this->input->post('ans');
				if($ans == $answer) {
					$data['category'] 		= $this->input->post('category');
					$data['mobile'] 		= $this->input->post('mobile');
					$data['purpose'] 		= $this->input->post('purpose');
					$data['name'] 			= $this->input->post('name');
					$data['whom_to_meet'] 	= $this->input->post('whom_to_meet');
					$data['email'] 			= $this->input->post('email');
					$data['content'] 		= $this->input->post('content');
					$category 	= $data['category'];
					$mobile	 	= $data['mobile'];
					$purpose 	= $data['purpose'];
					$name 		= $data['name'];
					$whom_to_meet 	= $data['whom_to_meet'];
					$email 			= $data['email'];
					$content 		= $data['content'];
				
					$sql = "select * from enquiry order by enquiry_id desc limit 1";
					$return_query = $this->db->query($sql)->row()->enquiry_id + 1;
					$data['enquiry_id'] = $return_query;
					
					$this->db->insert('enquiry', $data);
					
					$message = $content."</br>";
					$message .= $category." ".$whom_to_meet." ".$purpose;
					$message .= "Phone : ".$mobile;
					$message .= "Email : ". $email;
					$this->email_model->contact_message_email($message, $email);
					$this->session->set_flashdata('flash_message' , get_phrase('you_have_successfully_submitted_enquiry'));
					redirect(base_url() . 'contact/index/validate', 'refresh');
				} else{
				 $this->session->set_flashdata('error_message' , get_phrase('Wrong_answer_submission_!!!'));
				redirect(base_url() . 'contact/index/validate', 'refresh');
			}
	
	}
	
}