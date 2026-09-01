<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Email_model extends CI_Model { 
	
	function __construct()
    {
        parent::__construct(); 
    }
	
	
	function password_reset_email($new_password = '' , $account_type = '' , $email = ''){
	
		$query			=	$this->db->get_where($account_type , array('email' => $email));
		if($query->num_rows() > 0){
			
			$email_msg	=	"Your account type is : ".$account_type."<br />";
			$email_msg	.=	"Your password is : ".$new_password."<br />";
			
			$email_sub	=	"Password reset request";
			$email_to	=	$email;
			$this->send_email($email_msg , $email_sub , $email_to);
			return true;
		}
		else
		{	
			return false;
		}
	}
	
	
	function account_opening_email($account_type = '' , $email = ''){
	
		$query			=	$this->db->get_where($account_type , array('email' => $email));
		if($query->num_rows() > 0)
		{
			
			$email_msg	=	"Your account type is : ".$account_type."<br />";
			$email_msg	.=	"Your email is : ".$email."<br />";
			
			$email_to	=	$email;
			$this->do_email($email_msg , $email_sub , $email_to);
			return true;
		}
		else
		{	
			return false;
		}
	}
	
	
	
	/***custom email sender****/
	function do_email($msg=NULL, $sub=NULL, $to=NULL, $from=NULL){
		
		$config = array();
        $config['useragent']	= "CodeIgniter";
        $config['mailpath']		= "/usr/bin/sendmail"; // or "/usr/sbin/sendmail"
        $config['protocol']		= "smtp";
        $config['smtp_host']	= "localhost";
        $config['smtp_port']	= "25";
        $config['mailtype']		= 'html';
        $config['charset']		= 'utf-8';
        $config['newline']		= "\r\n";
        $config['wordwrap']		= TRUE;

        $this->load->library('email');

        $this->email->initialize($config);

		$system_name	=	$this->db->get_where('settings' , array('type' => 'system_name'))->row()->description;
		if($from == NULL)
			$from		=	$this->db->get_where('settings' , array('type' => 'system_email'))->row()->description;
		
		$this->email->from($from, $system_name);
		$this->email->from($from, $system_name);
		$this->email->to($to);
		$this->email->subject($sub);
		
		$msg	=	$msg;
		$this->email->message($msg);
		
		$this->email->send();
		
		//echo $this->email->print_debugger();
	}
	
	

    public function send_email($message = NULL, $sub = NULL, $receiverEmail = NULL, $from = NULL, $attachmentFiles = NULL){

        $schoolWebsite =    base_url();
        $from          =    $this->db->get_where('settings', array('type' => 'system_email'))->row()->description;
		
		$to 			= $receiverEmail;
		$subject 		= $sub;
		
		$headers  		= "MIME-Version: 1.0" . "\r\n"; 
		$headers 		.= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
		$headers 		.= "New Message ";
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

