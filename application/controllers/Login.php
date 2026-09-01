<?php if (!defined('BASEPATH'))exit('No direct script access allowed');


class Login extends CI_Controller {

    function __construct() {
        parent::__construct();

		$this->load->database();
		$this->load->library('session');
		
		/* cache control */
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 2010 05:00:00 GMT");
		
		//$this->config->cache_query();
		
    }

    //***************** The function below redirects to logged in user area
    public function index() {

        if ($this->session->userdata('admin_login')== 1) redirect (base_url(). 'admin/dashboard');
        if ($this->session->userdata('hrm_login')== 1) redirect (base_url(). 'hrm/dashboard'); 
        if ($this->session->userdata('hostel_login')== 1) redirect (base_url(). 'hostel/dashboard');
        if ($this->session->userdata('accountant_login')== 1) redirect (base_url(). 'accountant/dashboard');
        if ($this->session->userdata('librarian_login')== 1) redirect (base_url(). 'librarian/dashboard'); 
        if ($this->session->userdata('teacher_login')== 1) redirect (base_url(). 'teacher/dashboard');   
        if ($this->session->userdata('parent_login')== 1) redirect (base_url(). 'parents/dashboard'); 
        if ($this->session->userdata('student_login')== 1) redirect (base_url(). 'student/dashboard'); 
       
        $this->load->view('backend/account/login');
   
		
    }
	
	function reset_password(){
	 $this->load->view('backend/account/reset_password');
	}  
  
  	/*********** Reset password functionand send password to email of the user with the new password *************/
	function resetPassword(){
        $email = $this->input->post('email');
        
		$reset_account_type     = '';
        
		//resetting user password here
        $new_password           =   substr( md5( rand(100000000,20000000000) ) , 0,7);

       // ********************************** Checking credential for admin
        $query = $this->db->get_where('admin' , array('email' => $email));
        
		if ($query->num_rows() > 0){
            $reset_account_type     =   'admin';
            
			$this->db->where('email' , $email);
            
			$this->db->update('admin' , array('password' => sha1($new_password)));
            
			// ******************************** send new password to user email ********************************
            $this->email_model->password_reset_email($new_password , $reset_account_type , $email);
            
			$this->session->set_flashdata('flash_message', get_phrase('please_check_your_email_for_new_password'));
            
			redirect(site_url('login'), 'refresh');
        }
		
       // ********************************** Checking credential for student
        $query = $this->db->get_where('student' , array('email' => $email));
        
		if ($query->num_rows() > 0){
            $reset_account_type     =   'student';
            
			$this->db->where('email' , $email);
           
		    $this->db->update('student' , array('password' => sha1($new_password)));
            
			// ******************************** send new password to user email ********************************
            $this->email_model->password_reset_email($new_password , $reset_account_type , $email);
            
			$this->session->set_flashdata('flash_message', get_phrase('please_check_your_email_for_new_password'));
            
			redirect(site_url('login'), 'refresh');
        }
		
      // ********************************** Checking credential for teacher
        $query = $this->db->get_where('teacher' , array('email' => $email));
        
		if ($query->num_rows() > 0){
            $reset_account_type     =   'teacher';
            
			$this->db->where('email' , $email);
            
			$this->db->update('teacher' , array('password' => sha1($new_password)));
           
		    // ******************************** send new password to user email ********************************
            $this->email_model->password_reset_email($new_password , $reset_account_type , $email);
            
			$this->session->set_flashdata('flash_message', get_phrase('please_check_your_email_for_new_password'));
            
			redirect(site_url('login'), 'refresh');
        }
		
      // ********************************** Checking credential for parent
        $query = $this->db->get_where('parent' , array('email' => $email));
        
		if ($query->num_rows() > 0){
            $reset_account_type     =   'parent';
            
			$this->db->where('email' , $email);
            
			$this->db->update('parent' , array('password' => sha1($new_password)));
            
			// ******************************** send new password to user email ********************************
            $this->email_model->password_reset_email($new_password , $reset_account_type , $email);
            
			$this->session->set_flashdata('flash_message', get_phrase('please_check_your_email_for_new_password'));
            
			redirect(site_url('login'), 'refresh');
        }
		
		// ********************************** Checking credential for hostel
        $query = $this->db->get_where('hostel' , array('email' => $email));
        
		if ($query->num_rows() > 0){
            $reset_account_type     =   'hostel';
            
			$this->db->where('email' , $email);
            
			$this->db->update('hostel' , array('password' => sha1($new_password)));
            
			// ******************************** send new password to user email ********************************
            $this->email_model->password_reset_email($new_password , $reset_account_type , $email);
           
		    $this->session->set_flashdata('flash_message', get_phrase('please_check_your_email_for_new_password'));
            
			redirect(site_url('login'), 'refresh');
        }
		
        // ********************************** Checking credential for librarian
        $query = $this->db->get_where('librarian' , array('email' => $email));
        
		if ($query->num_rows() > 0){
            $reset_account_type     =   'librarian';
           
		    $this->db->where('email' , $email);
            
			$this->db->update('librarian' , array('password' => sha1($new_password)));
            
			// ******************************** send new password to user email ********************************
            $this->email_model->password_reset_email($new_password , $reset_account_type , $email);
            
			$this->session->set_flashdata('flash_message', get_phrase('please_check_your_email_for_new_password'));
            
			redirect(site_url('login'), 'refresh');
        }
		
		// ********************************** Checking credential for hrm
        $query = $this->db->get_where('hrm' , array('email' => $email));
        
		if ($query->num_rows() > 0){
            $reset_account_type     =   'hrm';
            
			$this->db->where('email' , $email);
            
			$this->db->update('hrm' , array('password' => sha1($new_password)));
            
			// ******************************** send new password to user email ********************************
            $this->email_model->password_reset_email($new_password , $reset_account_type , $email);
            
			$this->session->set_flashdata('flash_message', get_phrase('please_check_your_email_for_new_password'));
            
			redirect(site_url('login'), 'refresh');
        }
		
        // ********************************** Checking credential for accountant
        $query = $this->db->get_where('accountant' , array('email' => $email));
        
		if ($query->num_rows() > 0){
            $reset_account_type     =   'accountant';
            
			$this->db->where('email' , $email);
            
			$this->db->update('accountant' , array('password' => sha1($new_password)));
           
		    // ******************************** send new password to user email ********************************
            $this->email_model->password_reset_email($new_password , $reset_account_type , $email);
            
			$this->session->set_flashdata('flash_message', get_phrase('please_check_your_email_for_new_password'));
            
			redirect(site_url('login'), 'refresh');
        }
        
			$this->session->set_flashdata('error_message', get_phrase('sorry_email_cannot_be_found'));
        
			redirect(site_url('login/reset_password'), 'refresh');
    }
	
  
  
		  
  //********************************** the function below validating user login request 
    function validate_login() {
	
      $this->login_model->loginFunctionForAllUsers();
   
     }


    function logout(){
      $login_user = $this->session->userdata('login_type');
      if($login_user == 'admin'){
          $this->login_model->logout_model_for_admin();
      }
      if($login_user == 'hrm'){
        $this->login_model->logout_model_for_hrm();
      }
      if($login_user == 'hostel'){
        $this->login_model->logout_model_for_hostel();
      }
      if($login_user == 'accountant'){
        $this->login_model->logout_model_for_accountant();
      }
      if($login_user == 'librarian'){
        $this->login_model->logout_model_for_librarian();
      }
      if($login_user == 'parent'){
        $this->login_model->logout_model_for_parent();
      }
      if($login_user == 'student'){
        $this->login_model->logout_model_for_student();
      }
      if($login_user == 'teacher'){
        $this->login_model->logout_model_for_teacher();
      }
      $this->session->sess_destroy();
      redirect('login', 'refresh');

     }
	 
	 
	 
	




    
}
