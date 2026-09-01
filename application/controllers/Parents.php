<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	require_once(APPPATH."libraries/paytm/config_paytm.php");
	require_once(APPPATH."libraries/paytm/encdec_paytm.php");

class Parents extends CI_Controller { 

    function __construct() {
        parent::__construct();
        		$this->load->database();                                //Load Databse Class
                $this->load->library('session');					    //Load library for session
  
    }

     /*parent dashboard code to redirect to parent page if successfull login** */
     function dashboard() {
        if ($this->session->userdata('parent_login') != 1) redirect(base_url(), 'refresh');
       	$page_data['page_name'] = 'dashboard';
        $page_data['page_title'] = get_phrase('parent Dashboard');
        $this->load->view('backend/index', $page_data);
    }
	/******************* / parent dashboard code to redirect to parent page if successfull login** */

    function manage_profile($param1 = null, $param2 = null, $param3 = null){
        if ($this->session->userdata('parent_login') != 1) redirect(base_url(), 'refresh');
        if ($param1 == 'update') {
    
    
            $data['name']   =   $this->input->post('name');
            $data['email']  =   $this->input->post('email');
    
            $this->db->where('parent_id', $this->session->userdata('parent_id'));
            $this->db->update('parent', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/parent_image/' . $this->session->userdata('parent_id') . '.jpg');
            $this->session->set_flashdata('flash_message', get_phrase('Info Updated'));
            redirect(base_url() . 'parents/manage_profile', 'refresh');
        }
    
        if ($param1 == 'change_password') {
            $data['new_password']           =   sha1($this->input->post('new_password'));
            $data['confirm_new_password']   =   sha1($this->input->post('confirm_new_password'));
    
            if ($data['new_password'] == $data['confirm_new_password']) {
               
               $this->db->where('parent_id', $this->session->userdata('parent_id'));
               $this->db->update('parent', array('password' => $data['new_password']));
               $this->session->set_flashdata('flash_message', get_phrase('Password Changed'));
            }
    
            else{
                $this->session->set_flashdata('error_message', get_phrase('Type the same password'));
            }
            redirect(base_url() . 'parents/manage_profile', 'refresh');
        }
    
            $page_data['page_name']     = 'manage_profile';
            $page_data['page_title']    = get_phrase('Manage Profile');
            $page_data['edit_profile']  = $this->db->get_where('parent', array('parent_id' => $this->session->userdata('parent_id')))->result_array();
            $this->load->view('backend/index', $page_data);
        }


        function subject (){

            $parent_profile = $this->db->get_where('student', array('parent_id' => $this->session->userdata('parent_id')))->row();
            $select_student_class_id = $parent_profile->class_id;

            $page_data['page_name']     = 'subject';
            $page_data['page_title']    = get_phrase('Class Subjects');
            $page_data['select_subject']  = $this->db->get_where('subject', array('class_id' => $select_student_class_id))->result_array();
            $this->load->view('backend/index', $page_data);
        }

        function teacher (){


            $page_data['page_name']     = 'teacher';
            $page_data['page_title']    = get_phrase('Class Teachers');
            $this->load->view('backend/index', $page_data);
        }

        function class_mate (){

            $page_data['page_name']     = 'class_mate';
            $page_data['page_title']    = get_phrase('Class Mate');
            $this->load->view('backend/index', $page_data);
        }

        function class_routine(){


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
                $this->paypal->add_field('notify_url', base_url('parents/paypal_ipn'));
                $this->paypal->add_field('cancel_return', base_url('parents/paypal_cancel'));
                $this->paypal->add_field('return', site_url('parents/paypal_success'));

                $this->paypal->submit_paypal_post();
                //submitting info to the paypal teminal
            }
			
			
            if($param1 == 'paytm'){
			
            	$parent_profile = $this->db->get_where('student', array('parent_id' => $this->session->userdata('parent_id')))->row();
            	$student_profile = $parent_profile->student_id;

				$invoice_id = $this->input->post('invoice_id');
				$student_id = $student_profile;
				
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
				
			
				$paramList["CALLBACK_URL"] 		= base_url().'parents/paytm_verify';		//"http://localhost/PaytmKit/pgResponse.php";
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
			
			
			

         
            $page_data['page_name']     = 'invoice';
            $page_data['page_title']    = get_phrase('All Invoices');
            $this->load->view('backend/index', $page_data);
        }
		
		
	/**************** Function to pay with verify paytm ******************/
	function paytm_verify(){
	
		/******* Calling the set session ***************/
		$session_id  =   $this->session->userdata('id');
		$sess_amount =   $this->session->userdata('session_amount');
		$loginType	 =	 $this->session->userdata('login_type');
		$student_id  =   $this->session->userdata('stu_id');
	
		$paytmChecksum = "";
		
		$paramList = array();
		
		$isValidChecksum = "FALSE";
		
		$paramList = $_POST;
		
		$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg
	
	
		$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.

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
						redirect(site_url('parents/invoice/'.$student_id), 'refresh');
			}
			else {
				//echo "<b>Transaction status is failure</b>" . "<br/>";
				$this->session->set_flashdata('error_message', get_phrase('payment_failed'));
				redirect(site_url('parents/invoice/'.$student_id), 'refresh');

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
				redirect(site_url('parents/invoice/'.$student_id), 'refresh');
				
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


            $page_data['page_name']     = 'payment_history';
            $page_data['page_title']    = get_phrase('parent History');
            $this->load->view('backend/index', $page_data);
        }

        function submit_testimony($param1 = null, $param2 = null, $param3 = null){

            if($param1 == 'save'){

                $page_data['parent_id'] =    $this->db->get_where('parent', array('parent_id' => $this->session->userdata('parent_id')))->row()->parent_id;
                $page_data['content']   =    html_escape($this->input->post('content'));
                $page_data['status']   =    'Pending';
                $this->db->insert('testimony_table', $page_data);
                $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
                redirect(base_url() . 'parents/submit_testimony', 'refresh');
            }


            $page_data['page_name']     = 'submit_testimony';
            $page_data['page_title']    = get_phrase('Submit Testimony');
            $this->load->view('backend/index', $page_data);

        }
		
	
	/********** this function load student *******************/
    function search_student($exam_id = null, $class_id = null, $student_id = null, $session = null, $term = null){
	
	
			if($this->input->post('operation') == 'selection'){
	
				$page_data['exam_id']       =  $this->input->post('exam_id');
				$page_data['class_id']      =  $this->input->post('class_id');
				$page_data['student_id']    =  $this->input->post('student_id');
				$page_data['session']    	=  $this->input->post('session');
				$page_data['term']    		=  $this->input->post('term');
	
				if($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 && $page_data['student_id'] > 0 && $page_data['session'] > 0 && $page_data['term'] > 0){
	
					redirect(base_url(). 'parents/search_student/'. $page_data['exam_id'] .'/' . $page_data['class_id'] . '/' . $page_data['student_id'] .'/' . $page_data['session'] . '/' . $page_data['term'], 'refresh');
				}
				else{
					$this->session->set_flashdata('error_message', get_phrase('Pleasen select something'));
					redirect(base_url(). 'parents/search_student', 'refresh');
				}
			}
		
	
		$page_data['exam_id']    	=   $exam_id;
		$page_data['class_id']   	=   $class_id;
		$page_data['student_id'] 	=   $student_id;
		$page_data['session'] 	 	=   $session;
		$page_data['term'] 	 	 	=   $term;
			
		$page_data['page_name'] 	= 'search_student';
		$page_data['page_title'] 	= get_phrase('search_students');
		$this->load->view('backend/index', $page_data);
	}
	/********** this function load student *******************/
	
		function printResultSheet($class_id, $exam_id, $session, $term, $student_id){
		 	if ($this->session->userdata('parent_login') != 1)redirect(base_url(), 'refresh');
		 
		 		
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
            redirect(base_url() . 'parents/invoice/', 'refresh');
    	}
		
		



}