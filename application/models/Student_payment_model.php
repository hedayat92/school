<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Student_payment_model extends CI_Model { 
	
	function __construct(){
        parent::__construct();
    }



        function createStudentSinglePaymentFunction (){

            $page_data['invoice_number']    =   html_escape($this->input->post('invoice_number')) + rand(10000, 1000000);
            $page_data['student_id']        =   html_escape($this->input->post('student_id'));
            $page_data['title']             =   html_escape($this->input->post('title'));
            $page_data['description']       =   html_escape($this->input->post('description'));
            $page_data['amount']            =   html_escape($this->input->post('amount'));
            $page_data['discount']          =   html_escape($this->input->post('discount'));
            $page_data['amount_paid']       =   html_escape($this->input->post('amount_paid'));
            $page_data['due']               =   $page_data['amount']  - $page_data['amount_paid'];
            $page_data['creation_timestamp']=   strtotime($this->input->post('creation_timestamp'));
            $page_data['payment_method']    =   html_escape($this->input->post('payment_method'));
            $page_data['status']            =   html_escape($this->input->post('status'));
			$page_data['month'] 			= date('M');
            $page_data['year']              =  $this->db->get_where('settings', array('type' => 'session'))->row()->description;

            $this->db->insert('invoice', $page_data);
            $invoice_id = $this->db->insert_id();

            $page_data2['invoice_id']   =   $invoice_id;
            $page_data2['student_id']   =   html_escape($this->input->post('student_id'));
            $page_data2['title']        =   html_escape($this->input->post('title'));
            $page_data2['description']  =   html_escape($this->input->post('description'));
            $page_data2['payment_type'] =  'income';
            $page_data2['amount']       =   html_escape($this->input->post('amount_paid'));
            $page_data2['discount']     =   html_escape($this->input->post('discount'));
            $page_data2['timestamp']    =   strtotime($this->input->post('creation_timestamp'));
            $page_data2['year']         =   $this->db->get_where('settings', array('type' => 'session'))->row()->description;
			$page_data2['month'] 		= 	date('M');
            $page_data2['method']       =   html_escape($this->input->post('payment_method'));
			$student_id					=	html_escape($this->input->post('student_id'));

            $this->db->insert('payment', $page_data2);
            $payment_id = $this->db->insert_id();
			
			$this->_send_email_notification_single($student_id);
			
			
			
        }
		
			
		

        function createStudentMassPaymentFunction(){

            foreach($this->input->post('student_id') as $id){
            $page_data['invoice_number']    =   html_escape($this->input->post('invoice_number')) + rand(10000, 1000000);
            $page_data['student_id']        =   $id;
            $page_data['title']             =   html_escape($this->input->post('title'));
            $page_data['description']       =   html_escape($this->input->post('description'));
            $page_data['amount']            =   html_escape($this->input->post('amount'));
            $page_data['discount']          =   html_escape($this->input->post('discount'));
            $page_data['amount_paid']       =   html_escape($this->input->post('amount_paid'));
            $page_data['due']               =   $page_data['amount']  - $page_data['amount_paid'];
            $page_data['creation_timestamp']=   strtotime($this->input->post('creation_timestamp'));
            $page_data['payment_method']    =   html_escape($this->input->post('payment_method'));
            $page_data['status']            =   html_escape($this->input->post('status'));
            $page_data['year']              =  $this->db->get_where('settings', array('type' => 'session'))->row()->description;
			$page_data['month'] 			=  date('M');

            $this->db->insert('invoice', $page_data);
            $invoice_id = $this->db->insert_id();

            $page_data2['invoice_id']   =   $invoice_id;
            $page_data2['student_id']   =   $id;
            $page_data2['title']        =   html_escape($this->input->post('title'));
            $page_data2['description']  =   html_escape($this->input->post('description'));
            $page_data2['payment_type'] =  'income';
            $page_data2['amount']       =   html_escape($this->input->post('amount_paid'));
            $page_data2['discount']     =   html_escape($this->input->post('discount'));
            $page_data2['timestamp']    =   strtotime($this->input->post('creation_timestamp'));
            $page_data2['year']         =   $this->db->get_where('settings', array('type' => 'session'))->row()->description;
			$page_data2['month'] 		= 	date('M');
            $page_data2['method']       =   html_escape($this->input->post('payment_method'));
			$student_id					=	html_escape($this->input->post('student_id'));

            $this->db->insert('payment', $page_data2);
            $payment_id = $this->db->insert_id();
			
			$this->_send_email_notification_single($id);

			}
			
        }


        function takeNewPaymentFromStudent($param2){
            $page_data['invoice_id']        =   html_escape($this->input->post('invoice_id'));
            $page_data['student_id']        =   html_escape($this->input->post('student_id'));
            $page_data['title']             =   html_escape($this->input->post('title'));
            $page_data['description']       =   html_escape($this->input->post('description'));
            $page_data['amount']            =   html_escape($this->input->post('amount'));
            $page_data['payment_type']      =   'income';
            $page_data['method']            =   html_escape($this->input->post('method'));
            $page_data['timestamp']         =   strtotime($this->input->post('timestamp'));
            $page_data['amount']            =   html_escape($this->input->post('amount'));
            $page_data['year']              =  	$this->db->get_where('settings', array('type' => 'session'))->row()->description;
			$page_data['month'] 			= 	date('M');
            
            $this->db->insert('payment', $page_data);
            $payment_id = $this->db->insert_id();

            $page_data2['amount_paid'] = html_escape($this->input->post('amount'));
            $this->db->where('invoice_id', $param2);
            $this->db->set('amount_paid', 'amount_paid + ' . $page_data2['amount_paid'], FALSE);
            $this->db->set('due', 'due - ' . $page_data2['amount_paid'], FALSE);
            $this->db->update('invoice');

        }


        function updateStudentPaymentFunction($param2){

            $page_data['student_id']        =  html_escape($this->input->post('student_id'));
            $page_data['title']             =   html_escape($this->input->post('title'));
            $page_data['description']       =   html_escape($this->input->post('description'));
            $page_data['amount']            =   html_escape($this->input->post('amount'));
            $page_data['amount_paid']       =   html_escape($this->input->post('amount_paid'));
            $page_data['due']               =   $page_data['amount']  - $page_data['amount_paid'];
            $page_data['creation_timestamp']    =   html_escape($this->input->post('date'));
            $page_data['status']                =   html_escape($this->input->post('status'));

            $this->db->where('invoice_id', $param2);
            $this->db->update('invoice', $page_data);


        }

        function deleteStudentPaymentFunction($param2){
            $this->db->where('invoice_id', $param2);
            $this->db->delete('invoice');

        }
		
		
		
		
		
		
	function _send_email_notification_single($student_id){
		
        $from          =    $this->db->get_where('settings', array('type' => 'system_email'))->row()->description;
		
		$select 		= $this->db->get_where('student', array('student_id' => $student_id))->row();
		$to 			= $select->email;
		$subject 		= "Unpaid Invoice Created";
		$message		= "Dear" . $select->name. " new unpaid invoice has been created for you. Please login to your account to view the invoice";
		
		$headers  		= "MIME-Version: 1.0" . "\r\n"; 
		$headers 		.= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
		$headers 		.= "You got new message";
		$headers 		.= 'From: '.get_settings('system_name').'<'.get_settings('system_email').'>' . "\r\n";



		$message    =  '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body style="margin:0px; background: #f8f8f8; ">
<div width="100%" style="background: #f8f8f8; padding: 0px 0px; font-family:arial; line-height:28px; height:100%;  width: 100%; color: #514d6a;">
  <div style="max-width: 700px; padding:50px 0;  margin: 0px auto; font-size: 14px">
    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; margin-bottom: 20px">
      <tbody>
        <tr>
          <td style="vertical-align: top; padding-bottom:30px;" align="center"><a href="'.base_url().'" target="_blank">
		  <img src="'.base_url('uploads/logo.png').'" width="40px" height="40px" alt="'.get_settings('system_name').'" alt="'.get_settings('system_name').'" style="border:none"><br/>
          '.get_settings('system_name').'</a> </td>
        </tr>
      </tbody>
    </table>
    <div style="padding: 40px; background: #fff;">
      <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
        <tbody>
          <tr>
            <td style="border-bottom:1px solid #f6f6f6;"><h1 style="font-size:14px; font-family:arial; margin:0px; font-weight:bold;">Dear Sir/Ma/Student,</h1>
              <p style="margin-top:0px; color:#bbbbbb;">Use the below code to login to your account</p></td>
          </tr>
          <tr>
            <td style="padding:10px 0 30px 0;"><p>Your OTP: '.$message.'</p>
              <center>
                <a href="'.base_url().'login'.'" style="display: inline-block; padding: 11px 30px; margin: 20px 0px 30px; font-size: 15px; color: #fff; background: #00c0c8; border-radius: 60px; text-decoration:none;">Login Here</a>
              </center>
              <b>- Thanks { '.get_settings('system_name').' }</b> 
			  </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div style="text-align: center; font-size: 12px; color: #b2b2b5; margin-top: 20px">
      <p> Powered by '.get_settings('system_name').' | '.date('Y').'<br>
        <a href="javascript: void(0);" style="color: #b2b2b5; text-decoration: underline;">Unsubscribe</a> </p>
    </div>
  </div>
</div>
</body>
</html>
';
		
        mail($to,$subject,$message,$headers);

		
		}

    



}