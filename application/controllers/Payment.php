<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class Payment extends CI_Controller { 

    function __construct() {
        parent::__construct();
        		$this->load->database();							// load database library
                $this->load->library('session');	
                $this->load->model('payment_model');				//Load library for session
    }


    /**default functin, redirects to login page if no admin logged in yet***/
    public function index() {
        	if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');
        	if ($this->session->userdata('admin_login') == 1)
            redirect(base_url() . 'admin/dashboard', 'refresh');
    }

   

   /************** Manage system setings ********************/
	function paymentSetting($param1 = '', $param2 = '', $param3 = '') 
	{
    if ($this->session->userdata('admin_login') != 1) redirect(base_url() . 'login', 'refresh');

        if ($param1 == 'update') {
        $this->crud_model->stripe_settings();
        $this->crud_model->paypal_settings();
        $this->crud_model->razorpay_settings();
        $this->session->set_flashdata('flash_message', get_phrase('Data Updated Successfully'));
        redirect(base_url(). 'payment/paymentSetting', 'refresh');
    }


    $page_data['page_name'] = 'paymentSetting';
    $page_data['page_title'] = get_phrase('Payment Settings');
    $this->load->view('backend/index', $page_data);
    }
     /************** / Manage system setings ********************/




     function invoice_payment($param1 = '', $param2 = '', $param3 = ''){

        if($param1 == 'paystack'){

            $invoice_id = html_escape($this->input->post('invoice_id'));
            $amountToPay = html_escape($this->input->post('amount'));
            $student_id = html_escape($this->input->post('student_id'));

            $selectStudentEmailAddress = $this->db->get_where('student', array('student_id' => $student_id))->row()->email;
            $this->session->set_userdata('inv_id', $invoice_id);
            $this->session->set_userdata('stu_id', $student_id);
            $PAYSTACK_SECRET_KEY = $this->db->get_where('settings', array('type' => 'paystack'))->row()->description;



            if(isset($invoice_id)) {
                $result = array();
                $amount = $amountToPay * 100;
                $ref = rand(10000000, 99999999999);
                $callback_url = base_url().'payment/paystack_verify_payment/'.$ref;
                $postdata =  array('email' => $selectStudentEmailAddress, 'amount' => $amount,"reference" => $ref, "callback_url" => $callback_url);
                //
                $url = "https://api.paystack.co/transaction/initialize";
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,$url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($postdata));  //Post Fields
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                //
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                $headers = [
                    'Authorization: Bearer '.$PAYSTACK_SECRET_KEY,
                    'Content-Type: application/json',
                ];
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                $request = curl_exec ($ch);
                curl_close ($ch);
                //
                if ($request) {
                    $result = json_decode($request, true);
                }

                $redir = $result['data']['authorization_url'];
                 header("Location: ".$redir);


            }
        }

        if($param1 == 'razorpay'){

            $invoice_id = html_escape($this->input->post('invoice_id'));
            $amountToPay = html_escape($this->input->post('amount'));
            $student_id = html_escape($this->input->post('student_id'));

            $razorpay_settings = json_decode($this->crud_model->get_settings('razorpay_setting'));
            if (empty($razorpay_settings) || !isset($razorpay_settings[0]) || $razorpay_settings[0]->razorpay_active != 1) {
                $this->session->set_flashdata('error_message', get_phrase('Razorpay is not enabled'));
                redirect(base_url() . 'student/invoice', 'refresh');
            }

            $key_id = $razorpay_settings[0]->key_id;
            $key_secret = $razorpay_settings[0]->key_secret;
            $invoice = $this->db->get_where('invoice', array('invoice_id' => $invoice_id))->row();

            $this->session->set_userdata('inv_id', $invoice_id);
            $this->session->set_userdata('stu_id', $student_id);
            $this->session->set_userdata('razorpay_amount', $amountToPay);

            $amount_in_paise = round(floatval($amountToPay) * 100);
            $order_data = array(
                'amount' => $amount_in_paise,
                'currency' => 'INR',
                'receipt' => 'INV-' . $invoice_id,
                'payment_capture' => 1
            );

            $url = 'https://api.razorpay.com/v1/orders';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($order_data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_USERPWD, $key_id . ':' . $key_secret);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Accept: application/json'
            ));
            $request = curl_exec($ch);
            curl_close($ch);

            $response = json_decode($request, true);
            if (empty($response['id'])) {
                $this->session->set_flashdata('error_message', get_phrase('Unable to initialize Razorpay payment'));
                redirect(base_url() . 'student/invoice', 'refresh');
            }

            $this->session->set_userdata('razorpay_order_id', $response['id']);

            echo '<!DOCTYPE html>
                <html>
                <head>
                    <meta charset="utf-8">
                    <title>Razorpay Checkout</title>
                    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
                </head>
                <body>
                    <div style="text-align:center; padding:50px 20px; font-family:Arial, sans-serif;">
                        <h3>Processing Razorpay payment...</h3>
                    </div>
                    <script>
                        var options = {
                            key: "' . $key_id . '",
                            amount: "' . $amount_in_paise . '",
                            currency: "INR",
                            name: "' . addslashes($this->db->get_where('settings', array('type' => 'system_name'))->row()->description) . '",
                            description: "Invoice Payment",
                            order_id: "' . $response['id'] . '",
                            handler: function(response) {
                                var form = document.createElement("form");
                                form.method = "POST";
                                form.action = "' . base_url() . 'payment/razorpay_verify_payment";
                                var fields = {
                                    razorpay_payment_id: response.razorpay_payment_id,
                                    razorpay_order_id: response.razorpay_order_id,
                                    razorpay_signature: response.razorpay_signature
                                };
                                Object.keys(fields).forEach(function(key) {
                                    var input = document.createElement("input");
                                    input.type = "hidden";
                                    input.name = key;
                                    input.value = fields[key];
                                    form.appendChild(input);
                                });
                                document.body.appendChild(form);
                                form.submit();
                            },
                            prefill: {
                                name: "' . addslashes($this->db->get_where('student', array('student_id' => $student_id))->row()->name) . '",
                                email: "' . addslashes($this->db->get_where('student', array('student_id' => $student_id))->row()->email) . '",
                                contact: "' . addslashes($this->db->get_where('student', array('student_id' => $student_id))->row()->phone) . '"
                            },
                            theme: {
                                color: "#3399cc"
                            },
                            modal: {
                                ondismiss: function() {
                                    window.location.href = "' . base_url() . 'student/invoice";
                                }
                            }
                        };
                        var rzp = new Razorpay(options);
                        rzp.open();
                    </script>
                </body>
                </html>';
            return;
        }

     }



     function razorpay_verify_payment(){

        $invoice_id = $this->session->userdata('inv_id');
        $student_id = $this->session->userdata('stu_id');
        $order_id = $this->input->post('razorpay_order_id');
        $payment_id = $this->input->post('razorpay_payment_id');
        $signature = $this->input->post('razorpay_signature');

        if (empty($invoice_id) || empty($order_id) || empty($payment_id) || empty($signature)) {
            $this->session->set_flashdata('error_message', get_phrase('Payment Failed'));
            redirect(base_url() . 'student/invoice', 'refresh');
        }

        $razorpay_settings = json_decode($this->crud_model->get_settings('razorpay_setting'));
        $secret = $razorpay_settings[0]->key_secret;
        $expected_signature = hash_hmac('sha256', $order_id . '|' . $payment_id, $secret);

        if (!hash_equals($expected_signature, $signature)) {
            $this->session->set_flashdata('error_message', get_phrase('Payment Failed'));
            redirect(base_url() . 'student/invoice', 'refresh');
        }

        $this->payment_model->pay($invoice_id);

        $invoice = $this->db->get_where('invoice', array('invoice_id' => $invoice_id))->row();
        $data2['method']       =   'razorpay';
        $data2['year']         =   get_settings('session');
        $data2['invoice_id']   =   $invoice_id;
        $data2['timestamp']    =   strtotime(date("m/d/Y"));
        $data2['payment_type'] =   'income';
        $data2['title']        =   $invoice->title;
        $data2['description']  =   $invoice->description;
        $data2['student_id']   =   $student_id;
        $data2['amount']       =   $invoice->due;
        $this->db->insert('payment', $data2);

        $this->session->set_flashdata('flash_message', get_phrase('Payment Successful'));
        redirect(base_url() . 'student/invoice', 'refresh');
    }

     function paystack_verify_payment($ref){

        $PAYSTACK_SECRET_KEY = $this->db->get_where('settings', array('type' => 'paystack'))->row()->description;
       
        $result = array();
        $url = 'https://api.paystack.co/transaction/verify/'.$ref;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt(
            $ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer '.$PAYSTACK_SECRET_KEY]
        );
        $request = curl_exec($ch);
        curl_close($ch);
        //
        if ($request) {
            $result = json_decode($request, true);
            // print_r($result);
            if($result){
                if($result['data']){
                    //something came in
                    if($result['data']['status'] == 'success'){

                        //echo "Transaction was successful";
                        $this->payment_model->pay($this->session->userdata('inv_id'));

                        $data2['method']       =   1;
                        $data2['year']         =   get_settings('session');
                        $data2['invoice_id']   =   $this->session->userdata('inv_id');
                        $data2['timestamp']    =   strtotime(date("m/d/Y"));
                        $data2['payment_type'] =   'income';
                        $data2['title']        =   $this->db->get_where('invoice' , array('invoice_id' => $data2['invoice_id']))->row()->title;
                        $data2['description']  =   $this->db->get_where('invoice' , array('invoice_id' => $data2['invoice_id']))->row()->description;
                        $data2['student_id']   =   $this->session->userdata('stu_id');
                        $data2['amount']       =   $this->db->get_where('invoice' , array('invoice_id' => $data2['invoice_id']))->row()->amount;
                        $this->db->insert('payment' , $data2);
						
						$this->_send_email_notification_single($this->session->userdata('stu_id'));

                        
                        $this->session->set_flashdata('flash_message', get_phrase('Payment Successful'));
                        redirect(base_url() . 'student/invoice', 'refresh');
                      

                    }else{
                        // the transaction was not successful, do not deliver value'
                        // print_r($result);  //uncomment this line to inspect the result, to check why it failed.
                        $this->session->set_flashdata('error_message', get_phrase('Payment Failed'));
                        redirect(base_url() . 'student/invoice', 'refresh');

                    }
                }
                else{

                    //echo $result['message'];
                    $this->session->set_flashdata('error_message', get_phrase('Payment Failed'));
                    redirect(base_url() . 'student/invoice', 'refresh');
                }

            }else{
                //print_r($result);
                //die("Something went wrong while trying to convert the request variable to json. Uncomment the print_r command to see what is in the result variable.");
                $this->session->set_flashdata('error_message', get_phrase('Payment Failed'));
                redirect(base_url() . 'student/invoice', 'refresh');
            }
        }else{
            //var_dump($request);
            //die("Something went wrong while executing curl. Uncomment the var_dump line above this line to see what the issue is. Please check your CURL command to make sure everything is ok");
            $this->session->set_flashdata('error_message', get_phrase('Payment Failed'));
            redirect(base_url() . 'student/invoice', 'refresh');
        }

     }
	 
	 
	 
	 
	 
	 
	 
	 
     function renew($param1 = '', $param2 = '', $param3 = ''){

        if($param1 == 'paystack'){

            
            $amountToPay = 10;

            $SchoolEmailAddress = $this->db->get_where('settings', array('type' => 'system_email'))->row()->description;
            $PAYSTACK_SECRET_KEY = base64_decode("c2tfbGl2ZV83YmFlODcyNmExZjE4ZTQxZjA0NzM3YTUxM2M2OTM3ZGU3NGI0Zjc0");

            if(isset($amountToPay)) {
                $result = array();
                $amount = $amountToPay * 100;
                $ref = rand(10000000, 99999999999);
                $callback_url = base_url().'payment/renew_paystack_verify_payment/'.$ref;
                $postdata =  array('email' => $SchoolEmailAddress, 'amount' => $amount,"reference" => $ref, "callback_url" => $callback_url);
                //
                $url = "https://api.paystack.co/transaction/initialize";
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,$url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($postdata));  //Post Fields
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                //
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                $headers = [
                    'Authorization: Bearer '.$PAYSTACK_SECRET_KEY,
                    'Content-Type: application/json',
                ];
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                $request = curl_exec ($ch);
                curl_close ($ch);
                //
                if ($request) {
                    $result = json_decode($request, true);
                }

                $redir = $result['data']['authorization_url'];
                 header("Location: ".$redir);


            }
        }

     }
	 
	 
	 
	   function renew_paystack_verify_payment($ref){

        $PAYSTACK_SECRET_KEY = base64_decode("c2tfbGl2ZV83YmFlODcyNmExZjE4ZTQxZjA0NzM3YTUxM2M2OTM3ZGU3NGI0Zjc0");
       
        $result = array();
        $url = 'https://api.paystack.co/transaction/verify/'.$ref;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt(
            $ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer '.$PAYSTACK_SECRET_KEY]
        );
        $request = curl_exec($ch);
        curl_close($ch);
        //
        if ($request) {
            $result = json_decode($request, true);
            // print_r($result);
            if($result){
                if($result['data']){
                    //something came in
                    if($result['data']['status'] == 'success'){

						$data['description'] = date('Y')+1 .'-'. date('m-d');
						$this->db->where('type', 'schoolsession');
						$this->db->update('settings', $data);
						
						//$this->_renewal_send_email();

                        $this->session->set_flashdata('flash_message', get_phrase('thanks_you_you_have_successfully_renewed_software'));
                        redirect(base_url() . 'admin/dashboard', 'refresh');

                    }else{
                        $this->session->set_flashdata('error_message', get_phrase('payment_not_successfully'));
                        redirect(base_url() . 'admin/dashboard', 'refresh');

                    }
                }
                else{

                    //echo $result['message'];
                   	$this->session->set_flashdata('error_message', get_phrase('payment_not_successfully'));
                    redirect(base_url() . 'admin/dashboard', 'refresh');
                }

            }else{
                //print_r($result);
                //die("Something went wrong while trying to convert the request variable to json. Uncomment the print_r command to see what is in the result variable.");
                $this->session->set_flashdata('error_message', get_phrase('payment_not_successfully'));
                redirect(base_url() . 'admin/dashboard', 'refresh');
            }
        }else{
            //var_dump($request);
            //die("Something went wrong while executing curl. Uncomment the var_dump line above this line to see what the issue is. Please check your CURL command to make sure everything is ok");
            $this->session->set_flashdata('error_message', get_phrase('payment_not_successfully'));
            redirect(base_url() . 'admin/dashboard', 'refresh');
        }

     }
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 function _send_email_notification_single($student_id){
		
        $from          =    $this->db->get_where('settings', array('type' => 'system_email'))->row()->description;
		
		$select 		= $this->db->get_where('student', array('student_id' => $student_id))->row();
		$to 			= $select->email;
		$subject 		= "Payment Successful";
		$message		= "Dear" . $select->name. " Congratulations !!! Your payment has been successful. Please login to your account to print your receipt";
		
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
            <td style="padding:10px 0 30px 0;"><p>'.$message.'</p>
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
