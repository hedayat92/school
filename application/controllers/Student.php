<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	require_once(APPPATH."libraries/paytm/config_paytm.php");
	require_once(APPPATH."libraries/paytm/encdec_paytm.php");

class Student extends CI_Controller { 

    function __construct() {
        parent::__construct();
        		$this->load->database();                                //Load Databse Class
                $this->load->library('session');					    //Load library for session
                $this->load->model('student_model');
				
				
				/*********** Set your default time zone here **********/
				timezone();
  
    }

     /*student dashboard code to redirect to student page if successfull login** */
     function dashboard() {
        if ($this->session->userdata('student_login') != 1) redirect(base_url(), 'refresh');
       	$page_data['page_name'] = 'dashboard';
        $page_data['page_title'] = get_phrase('student Dashboard');
        $this->load->view('backend/index', $page_data);
    }
	/******************* / student dashboard code to redirect to student page if successfull login** */

    function manage_profile($param1 = null, $param2 = null, $param3 = null){
        if ($this->session->userdata('student_login') != 1) redirect(base_url(), 'refresh');
        if ($param1 == 'update') {
    
    
            $data['name']   =   $this->input->post('name');
            $data['email']  =   $this->input->post('email');
			
			
			//uploading file1 using codeigniter upload library
			$this->load->library('upload');
			$file_name = $this->session->userdata('student_id') . '.jpg';
			$config['upload_path'] 				= 'uploads/student_image/';
			$config['allowed_types'] 			= 'jpeg|jpg|JPEG';
			$config['max_size'] 				= '3000000';
			$config['overwrite']            	= true;
			$config['file_name']            	= $file_name;
	
			$this->upload->initialize($config);
			if( ! $this->upload->do_upload('userfile')){
				$this->session->set_flashdata('error_message', $this->upload->display_errors());
				redirect(base_url() . 'student/manage_profile', 'refresh');
			}
			$this->security->xss_clean($data);
    
            $this->db->where('student_id', $this->session->userdata('student_id'));
            $this->db->update('student', $data);
            $this->session->set_flashdata('flash_message', get_phrase('Info Updated'));
            redirect(base_url() . 'student/manage_profile', 'refresh');
           
        }
    
        if ($param1 == 'change_password') {
            $data['new_password']           =   sha1($this->input->post('new_password'));
            $data['confirm_new_password']   =   sha1($this->input->post('confirm_new_password'));
    
            if ($data['new_password'] == $data['confirm_new_password']) {
               
               $this->db->where('student_id', $this->session->userdata('student_id'));
               $this->db->update('student', array('password' => $data['new_password']));
               $this->session->set_flashdata('flash_message', get_phrase('Password Changed'));
            }
    
            else{
                $this->session->set_flashdata('error_message', get_phrase('Type the same password'));
            }
            redirect(base_url() . 'student/manage_profile', 'refresh');
        }
    
            $page_data['page_name']     = 'manage_profile';
            $page_data['page_title']    = get_phrase('Manage Profile');
            $page_data['edit_profile']  = $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->result_array();
            $this->load->view('backend/index', $page_data);
        }


        function subject (){

            $student_profile = $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row();
            $select_student_class_id = $student_profile->class_id;

            $page_data['page_name']     = 'subject';
            $page_data['page_title']    = get_phrase('Class Subjects');
            $page_data['select_subject']  = $this->db->get_where('subject', array('class_id' => $select_student_class_id))->result_array();
            $this->load->view('backend/index', $page_data);
        }

        function teacher (){


            $student_profile = $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row();
            $select_student_class_id = $student_profile->class_id;

            $return_teacher_id = $this->db->get_where('subject', array('class_id' => $select_student_class_id))->row()->teacher_id;


            $page_data['page_name']     = 'teacher';
            $page_data['page_title']    = get_phrase('Class Teachers');
            $page_data['select_teacher']  = $this->db->get_where('teacher', array('teacher_id' => $return_teacher_id))->result_array();
            $this->load->view('backend/index', $page_data);
        }

        function class_mate (){

            $student_profile = $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row();
            $page_data['select_student_class_id']  = $student_profile->class_id;
            $page_data['page_name']     = 'class_mate';
            $page_data['page_title']    = get_phrase('Class Mate');
            $this->load->view('backend/index', $page_data);
        }

        function class_routine(){

            $student_profile = $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row();
            $page_data['class_id']  = $student_profile->class_id;

            $page_data['page_name']     = 'class_routine';
            $page_data['page_title']    = get_phrase('Class Timetable');
            $this->load->view('backend/index', $page_data);


        }

        function invoice($param1 = null, $param2 = null, $param3 = null){
		

            if($param1 == 'paypal'){
			
                $invoice_id = $this->input->post('invoice_id');
                $payment_email = $this->db->get_where('settings', array('type' => 'paypal_email'))->row();
                $select_invoice = $this->db->get_where('invoice', array('invoice_id' => $invoice_id))->row();
                $this->session->set_userdata('inv_id', $invoice_id);

                // SENDING USER TO PAYPAL TERMINAL.
                $this->paypal->add_field('rm', 2);
                $this->paypal->add_field('no_note', 0);
                $this->paypal->add_field('item_name', $select_invoice->title);
                $this->paypal->add_field('amount', $select_invoice->due);
                $this->paypal->add_field('custom', $select_invoice->invoice_id);
                $this->paypal->add_field('business', $payment_email->description);
                $this->paypal->add_field('notify_url', base_url('student/paypal_ipn'));
                $this->paypal->add_field('cancel_return', base_url('student/paypal_cancel'));
                $this->paypal->add_field('return', site_url('student/paypal_success'));

                $this->paypal->submit_paypal_post();
                //submitting info to the paypal teminal
            }
			


            $page_data['invoices']     = $this->db->get_where('invoice', array('student_id' => $this->session->userdata('student_id'), 'due >' => 0))->result_array();
            $page_data['page_name']     = 'invoice';
            $page_data['page_title']    = get_phrase('All Invoices');
            $this->load->view('backend/index', $page_data);
        }
		
		
		
		
    	public function payThroughPaytm(){
	
				header("Pragma: no-cache");
				header("Cache-Control: no-cache");
				header("Expires: 0");
		
				$invoice_id = $this->input->post('invoice_id');
				$student_id = $this->session->userdata('student_id');
				
				$InvoiceAmountPayment = $this->input->post('amount');
				$GetStudentEmailFromStudentTable = $this->db->get_where('student', array('student_id' => $student_id))->row(); 
				
				/******* Set the following into session ***************/
				$this->session->set_userdata('id', $invoice_id);
				$this->session->set_userdata('stu_id', $student_id);
				$this->session->set_userdata('session_amount', $InvoiceAmountPayment);
	
				$checkSum = "";
				$paramList = array();
				
				/*
				$ORDER_ID = $_POST["ORDER_ID"];
				$CUST_ID = $_POST["CUST_ID"];
				$INDUSTRY_TYPE_ID = $_POST["INDUSTRY_TYPE_ID"];
				$CHANNEL_ID = 'WEB';
				$TXN_AMOUNT = $_POST["TXN_AMOUNT"];
				*/
				
				// Create an array having all required parameters for creating checksum.
				$paramList["MID"] 				= PAYTM_MERCHANT_MID;
				$paramList["ORDER_ID"] 			= $invoice_id;
				$paramList["CUST_ID"] 			= $GetStudentEmailFromStudentTable->student_id;
				$paramList["INDUSTRY_TYPE_ID"] 	= $invoice_id;
				$paramList["CHANNEL_ID"] 		= 'WEB';
				$paramList["TXN_AMOUNT"] 		= $InvoiceAmountPayment;
				$paramList["WEBSITE"] 			= PAYTM_MERCHANT_WEBSITE;
				$paramList["CALLBACK_URL"] 		= base_url().'student/paytm_verify';//"http://localhost/PaytmKit/pgResponse.php";
				
				
				$paramList["MSISDN"] 			= $GetStudentEmailFromStudentTable->phone; //Mobile number of customer
				$paramList["EMAIL"] 			= $GetStudentEmailFromStudentTable->email; //Email ID of customer
				$paramList["VERIFIED_BY"] 		= "EMAIL"; //
				$paramList["IS_USER_VERIFIED"] 	= "YES"; //
				
			
				//Here checksum string will return by getChecksumFromArray() function.
				$checkSum = getChecksumFromArray($paramList,PAYTM_MERCHANT_KEY);
				
					echo 
						"<html>
							<head>
								<title>Merchant Check Out Page</title>
							</head>
								<body>
									<center><h1>Please do not refresh this page...</h1></center>
									<form method='post' action='".PAYTM_TXN_URL."' name='f1'>
										<table border='1'>
											<tbody>";
									
												 foreach($paramList as $name => $value) {
												 echo '<input type="hidden" name="' . $name .'" value="' . $value .'">';
												 }
									
												echo "<input type='hidden' name='CHECKSUMHASH' value='". $checkSum . "'>
											</tbody>
										</table>
										<script type='text/javascript'>
											document.f1.submit();
										</script>
									</form>
								</body>
						</html>";
	
	}	
		
	/**************** Function to pay with verify paytm ******************/
	function paytm_verify(){
	
        header("Pragma: no-cache");
        header("Cache-Control: no-cache");
        header("Expires: 0");
	
	
		$paytmChecksum = "";
		
		$paramList = array();
		
		$isValidChecksum = "FALSE";
		
		$paramList = $_POST;
		
		$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg
	
	
		$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.
		
		/******* Calling the set session ***************/
		$session_id  =   $this->session->userdata('id');
		$sess_amount =   $this->session->userdata('session_amount');
		$loginType	 =	 $this->session->userdata('login_type');
		$student_id  =   $this->session->userdata('stu_id');

			if($isValidChecksum == "TRUE") {
				echo "<b>Checksum matched and following are the transaction details:</b>" . "<br/>";
			if ($_POST["STATUS"] == "TXN_SUCCESS") {
				//echo "<b>Transaction status is success</b>" . "<br/>";
				//Process your transaction here as success transaction.
				//Verify amount & order id received from Payment gateway with your application's order id and amount.
				
				
						$this->payment_model->pay($session_id);
						
						$paytm['method']       =   '3';
						$paytm['timestamp']    =   strtotime(date("m/d/Y"));
						$paytm['payment_type'] =   'income';
						$paytm['month'] 	   =   date('M');
						$paytm['year'] 	   	   =   get_settings('session');
						$paytm['invoice_id']   =   $session_id;
						$paytm['title']        =   $this->db->get_where('invoice' , array('invoice_id' => $session_id))->row()->title;
						$paytm['description']  =   $this->db->get_where('invoice' , array('invoice_id' => $session_id))->row()->description;
						$paytm['student_id']   =   $this->db->get_where('invoice' , array('invoice_id' => $session_id))->row()->student_id;
						$paytm['amount']       =   $sess_amount;
						
						$this->db->insert('payment' , $paytm);
						
						
						$this->session->set_flashdata('flash_message', get_phrase('payment_successful'));
						redirect(site_url('student/invoice/'), 'refresh');
						
			}
			else {
			
				//echo "<b>Transaction status is failure</b>" . "<br/>";
				$this->session->set_flashdata('error_message', get_phrase('payment_failed'));
				redirect(site_url('student/invoice/'), 'refresh');
				
			}
		
			if (isset($_POST) && count($_POST)>0 )
			{ 
				foreach($_POST as $paramName => $paramValue) {
						echo "<br/>" . $paramName . " = " . $paramValue;
				}
			}
		
		}
		else {
				//echo "<b>Checksum mismatched.</b>";
				//Process transaction as suspicious.
					$this->session->set_flashdata('error_message', get_phrase('payment_suspicious'));
					redirect(site_url('student/invoice/'), 'refresh');
		}
	
	}


        function paypal_ipn(){
            $invoice_id = $this->session->userdata('inv_id');
            if($this->paypal->validate_ipn() == true){
                    $ipn_response = '';
                    foreach ($_POST as $key => $value){
                        $value = urlencode(stripslashes($value));
                        $ipn_response .= "\n$key=$value";
                    }

                $this->payment_model->pay($invoice_id);

                $data2['method']       =   '1';
                $data2['year']         =   get_settings('session');
                $data2['invoice_id']   =   $invoice_id;
                $data2['timestamp']    =   strtotime(date("m/d/Y"));
                $data2['payment_type'] =   'income';
                $data2['title']        =   $this->db->get_where('invoice' , array('invoice_id' => $invoice_id))->row()->title;
                $data2['description']  =   $this->db->get_where('invoice' , array('invoice_id' => $invoice_id))->row()->description;
                $data2['student_id']   =   $this->db->get_where('invoice' , array('invoice_id' => $invoice_id))->row()->student_id;
                $data2['amount']       =   $this->db->get_where('invoice' , array('invoice_id' => $invoice_id))->row()->amount;
                $this->db->insert('payment' , $data2);

            }
        }

        function paypal_cancel(){
            $this->session->set_flashdata('error_message', get_phrase('Payment Cancelled'));
            redirect(base_url() . 'student/invoice', 'refresh');
        }
        
        function paypal_success(){
            $this->session->set_flashdata('flash_message', get_phrase('Payment Successful'));
            redirect(base_url() . 'student/invoice', 'refresh');
        }

        function payment_history(){

            $student_profile = $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row();
            $student_profile = $student_profile->student_id;

            $page_data['invoices']      = $this->db->get_where('invoice', array('student_id' => $student_profile, 'due' => 0))->result_array();
            $page_data['page_name']     = 'payment_history';
            $page_data['page_title']    = get_phrase('Student History');
            $this->load->view('backend/index', $page_data);

        }
		
		
	/***************** Here, in the school system, there are two types of computer based test: This is the second exam codes where this can be used for multple questions, true or false question and fillig the gap types of questions.  *******************/
	
	function online_exam($param1 = '', $param2 = '') {
        if ($this->session->userdata('student_login') != 1)
            redirect(site_url('login'), 'refresh');
        if ($param1 == '') {
            $page_data['data'] = 'active';
            $page_data['exams'] = $this->crud_model->available_exams($this->session->userdata('login_user_id'));
        }

        $page_data['page_name'] = 'online_exam';
        $page_data['page_title'] = get_phrase('online_exams');
        $this->load->view('backend/index', $page_data);
    }

    function online_exam_result($param1 = '', $param2 = '') {
        if ($this->session->userdata('student_login') != 1)
            redirect(site_url('login'), 'refresh');
        if ($param1 == '') {
            $page_data['data2'] = 'active';
            $page_data['exams'] = $this->crud_model->available_exams($this->session->userdata('login_user_id'));
        }

        $page_data['page_name'] = 'online_exam_result';
        $page_data['page_title'] = get_phrase('online_exam_results');
        $this->load->view('backend/index', $page_data);
    }

    function take_online_exam($online_exam_code) {
        if ($this->session->userdata('student_login') != 1)
            redirect(site_url('login'), 'refresh');
        $online_exam_id = $this->db->get_where('online_exam', array('code' => $online_exam_code))->row()->online_exam_id;
        $student_id = $this->session->userdata('login_user_id');
        // check if the student has already taken the exam
        $check = array('student_id' => $student_id, 'online_exam_id' => $online_exam_id);
        $taken = $this->db->where($check)->get('online_exam_result')->num_rows();

        $this->crud_model->change_online_exam_status_to_attended_for_student($online_exam_id);

        $status = $this->crud_model->check_availability_for_student($online_exam_id);

        if ($status == 'submitted') {
            $page_data['page_name']  = 'page_not_found';
        }
        else{
            $page_data['page_name']  = 'online_exam_take';
        }
        $page_data['page_title'] = get_phrase('online_exam');
        $page_data['online_exam_id'] = $online_exam_id;
        $page_data['exam_info'] = $this->db->get_where('online_exam', array('online_exam_id' => $online_exam_id));
        $this->load->view('backend/index', $page_data);
    }

//************* the function below helps to submit the exam successfully by the students. ****************************************/
    function submit_online_exam($online_exam_id = ""){

        $answer_script = array();
        $question_bank = $this->db->get_where('question_bank', array('online_exam_id' => $online_exam_id))->result_array();

        foreach ($question_bank as $question) {

          $correct_answers  = $this->crud_model->get_correct_answer($question['question_bank_id']);
          $container_2 = array();
          if (isset($_POST[$question['question_bank_id']])) {

              foreach ($this->input->post($question['question_bank_id']) as $row) {
                  $submitted_answer = "";
                  if ($question['type'] == 'true_false') {
                      $submitted_answer = $row;
                  }
                  elseif($question['type'] == 'fill_in_the_blanks'){
                    $suitable_words = array();
                    $suitable_words_array = explode(',', $row);
                    foreach ($suitable_words_array as $key) {
                      array_push($suitable_words, strtolower($key));
                    }
                    $submitted_answer = json_encode(array_map('trim',$suitable_words));
                  }
                  else{
                      array_push($container_2, strtolower($row));
                      $submitted_answer = json_encode($container_2);
                  }
                  $container = array(
                      "question_bank_id" => $question['question_bank_id'],
                      "submitted_answer" => $submitted_answer,
                      "correct_answers"  => $correct_answers
                  );
              }
          }
          else {
              $container = array(
                  "question_bank_id" => $question['question_bank_id'],
                  "submitted_answer" => "",
                  "correct_answers"  => $correct_answers
              );
          }

          array_push($answer_script, $container);
        }
        $this->crud_model->submit_online_exam($online_exam_id, json_encode($answer_script));
        redirect(site_url('student/online_exam'), 'refresh');
    }
	/***************** /  Here, in the school system, there are two types of computer based test: This is the second exam codes where this can be used for multple questions, true or false question and fillig the gap types of questions.  *******************/


        function studentRequestBook($param1 = null, $param2 = null, $param3 = null){

            if($param1 == 'create'){
                $this->student_model->create_student_request_book();
                $this->session->set_flashdata('flash_message', get_phrase('Data sent successful'));
                redirect(base_url() . 'student/studentRequestBook', 'refresh');
            }


            $page_data['page_name']     = 'studentRequestBook';
            $page_data['page_title']    = get_phrase('Request Book');
            $this->load->view('backend/index', $page_data);

        }
		
		
		 /*********** the function loads student mark ********************/
		function student_marksheet($exam_id = null, $class_id = null, $student_id = null, $session = null, $term = null) {
			if ($this->session->userdata('student_login') != 1) redirect('login', 'refresh');
        
		
			if($this->input->post('operation') == 'selection'){
	
				$page_data['exam_id']       =  $this->input->post('exam_id');
				$page_data['class_id']      =  $this->input->post('class_id');
				$page_data['student_id']    =  $this->session->userdata('login_user_id');
				$page_data['session']    	=  $this->input->post('session');
				$page_data['term']    		=  $this->input->post('term');
	
				if($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 && $page_data['student_id'] > 0 && $page_data['session'] > 0 && $page_data['term'] > 0){
	
					redirect(base_url(). 'student/student_marksheet/'. $page_data['exam_id'] .'/' . $page_data['class_id'] . '/' . $page_data['student_id'] .'/' . $page_data['session'] . '/' . $page_data['term'], 'refresh');
				}
				else{
					$this->session->set_flashdata('error_message', get_phrase('Pleasen select something'));
					redirect(base_url(). 'student/student_marksheet', 'refresh');
				}
			}
			
			
			$page_data['exam_id']    =   $exam_id;
			$page_data['class_id']   =   $class_id;
			$page_data['student_id'] =   $student_id;
			$page_data['session'] 	 =   $session;
			$page_data['term'] 	 	 =   $term;
			$page_data['page_name']  =   'student_marksheet';
			$page_data['page_title'] =   get_phrase('marksheet_for');
			$this->load->view('backend/index', $page_data);
		}
	  /*********** the function loads student mark ends here ********************/
	
		function printResultSheet($class_id, $exam_id, $session, $term, $student_id){
		 	if ($this->session->userdata('student_login') != 1)redirect(base_url(), 'refresh');
		 
		 		
			$page_data['exam_id']       =   $exam_id;
			$page_data['class_id']      =   $class_id;
			$page_data['session']   	=   $session;
			$page_data['term']    		=   $term;
			$page_data['student_id']    =   $student_id;
		
			$page_data['page_name']  = 'printResultSheet';
			$page_data['page_title'] = get_phrase('print_result_sheet');
			$this->load->view('backend/index', $page_data);
		}
		
		
		
		// client success_payment_return
   	 	function vouguepay_success($invoice_id){
				
			$data['status'] = '2';
			$data['amount_paid'] = $this->db->get_where('invoice', array('invoice_id' => $invoice_id))->row()->due;
            $this->db->where('invoice_id', $invoice_id);
            $this->db->set('amount_paid', 'amount_paid + ' . $data['amount_paid'], FALSE);
			$this->db->set('status', $data['status'], FALSE);
            $this->db->set('due', 'due - ' . $data['amount_paid'], FALSE);
            $this->db->update('invoice');
			
			
			
			 $data2['method']       =   'card';
             $data2['invoice_id']   =   $invoice_id;
             $data2['timestamp']    =   strtotime(date("m/d/Y"));
             $data2['payment_type'] =   'income';
             $data2['title']        =   $this->db->get_where('invoice' , array('invoice_id' => $invoice_id))->row()->title;
             $data2['description']  =   $this->db->get_where('invoice' , array('invoice_id' => $invoice_id))->row()->description;
             $data2['student_id']   =   $this->db->get_where('invoice' , array('invoice_id' => $invoice_id))->row()->student_id;
             $data2['amount']       =   $data['amount_paid'];
			 $data2['year']       	=   $this->db->get_where('settings' , array('type' => 'session'))->row()->description;
             $this->db->insert('payment' , $data2);
			
			$this->session->set_flashdata('flash_message', get_phrase('payment_successful'));
            redirect(base_url() . 'student/invoice/', 'refresh');
		
        	$student_profile         = $this->db->get_where('student', array('student_id'   => $this->session->userdata('student_id')))->row();
        	$student_id              = $student_profile->student_id;
        	$page_data['invoices']   = $this->db->get_where('invoice', array('student_id' => $student_id ))->result_array();
        	$page_data['page_name']  = 'invoice';
        	$page_data['page_title'] = get_phrase('manage_invoice/payment');
        	$this->load->view('backend/index', $page_data);
    	}
		
		
		function submit (){
		
			$page_data['student_id'] = $this->session->userdata('student_id');
			$page_data['assignment_id'] = $this->input->post('assignment_id');
			
			//uploading file using codeigniter upload library
			$files = $_FILES['file_name'];
			$this->load->library('upload');
			$config['upload_path'] = 'uploads/assignment/';
			$config['allowed_types'] = '*';
			$_FILES['file_name']['name'] = $files['name'];
			$_FILES['file_name']['type'] = $files['type'];
			$_FILES['file_name']['tmp_name'] = $files['tmp_name'];
			$_FILES['file_name']['size'] = $files['size'];
			$this->upload->initialize($config);
			$this->upload->do_upload('file_name');
		
			$page_data['file_name'] = $_FILES['file_name']['name'];
			$this->db->insert('done', $page_data);
			
			$this->session->set_flashdata('flash_message', get_phrase('assignment_submitted_successfully'));
            redirect(base_url() . 'assignment/assignment/', 'refresh');
			
		
        }
        


        function live_class($param1 = null, $param2 = null, $param3 = null){

            
            $page_data['page_name'] = 'live_class';
            $page_data['page_title'] = get_phrase('live_class');
            $this->load->view('backend/index', $page_data);
        }
    
    
        function host_live_class($param1 = null, $param2 = null, $param3 = null){
    
            $page_data['live_class_id'] = $param1;
            $this->load->view('backend/host/host_live_class', $page_data);
        }
		
		
		
		function video_class($param1 = null, $param2 = null, $param3 = null){
	
			$page_data['page_name'] = 'video_class';
			$page_data['page_title'] = get_phrase('video_classroom');
			$this->load->view('backend/index', $page_data);
		
        }


        function jitsi($param1 = null, $param2 = null, $param3 = null){
	
			$page_data['page_name'] = 'jitsi';
			$page_data['page_title'] = get_phrase('jitsi_live_class');
			$this->load->view('backend/index', $page_data);
		
        }


        function stream_jitsi($jitsi_id){
            
            $page_data['jitsi_id'] = $jitsi_id;
            $this->load->view('backend/host/jitsi', $page_data);
    
        }
		
		
		
    function generate_pdf($class_id, $exam_id){
	
		$this->load->helper(array('dompdf', 'file'));
		
        $page_data['class_id'] = $class_id;
		$page_data['exam_id'] = $exam_id;
       	$html   =   $this->load->view('backend/student/print_student_pdf' , $page_data , true);
        // generate pdf by dompdf
        $data                              = pdf_create($html, '', false);
        write_file('uploads/student_image/'.$this->session->userdata('student_id').'report.pdf', $data);
		$this->session->set_flashdata('flash_message', get_phrase('pdf_generated_successfull'));
		redirect(base_url() . 'admin/student_marksheet/'. $this->session->userdata('student_id').'/'.$exam_id, 'refresh');
       
    }
	
	
	
	
	
	
	
	

	
	



}