<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Hrm extends CI_Controller { 

    function __construct() { 
        parent::__construct();
        		$this->load->database();                                //Load Databse Class
                $this->load->library('session');					    //Load library for session
                $this->load->model('payroll_model');
				$this->load->model('vacancy_model');                    // Load vacancy Model Here
                $this->load->model('application_model');                // Load Apllication Model Here
                $this->load->model('leave_model');                      // Load Apllication Model Here
                $this->load->model('award_model');                      // Load Apllication Model Here
    }

     /*HRM dashboard code to redirect to HRM page if successfull login** */
     function dashboard() {
        if ($this->session->userdata('hrm_login') != true) redirect(base_url(), 'refresh');
       	$page_data['page_name'] = 'dashboard';
        $page_data['page_title'] = get_phrase('HRM Dashboard');
        $this->load->view('backend/index', $page_data);
    }
	/******************* / HRM dashboard code to redirect to HRM page if successfull login** */

    function manage_profile($param1 = null, $param2 = null, $param3 = null){
        if ($this->session->userdata('hrm_login') != true) redirect(base_url(), 'refresh');
        if ($param1 == 'update') {
    
    
            $data['name']   =   $this->input->post('name');
            $data['email']  =   $this->input->post('email');
			
			
			//uploading file1 using codeigniter upload library
			$this->load->library('upload');
			$file_name = $this->session->userdata('hrm_id') . '.jpg';
			$config['upload_path'] 				= 'uploads/hrm_image/';
			$config['allowed_types'] 			= 'jpeg|jpg|JPEG';
			$config['max_size'] 				= '3000000';
			$config['overwrite']            	= true;
			$config['file_name']            	= $file_name;
	
			$this->upload->initialize($config);
			if( ! $this->upload->do_upload('userfile')){
				$this->session->set_flashdata('error_message', $this->upload->display_errors());
				redirect(base_url() . 'admin/manage_profile', 'refresh');
			}
			$this->security->xss_clean($data);
			
    
            $this->db->where('hrm_id', $this->session->userdata('hrm_id'));
            $this->db->update('hrm', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/hrm_image/' . $this->session->userdata('hrm_id') . '.jpg');
            $this->session->set_flashdata('flash_message', get_phrase('Info Updated'));
            redirect(base_url() . 'hrm/manage_profile', 'refresh');
           
        }
    
        if ($param1 == 'change_password') {
            $data['new_password']           =   sha1($this->input->post('new_password'));
            $data['confirm_new_password']   =   sha1($this->input->post('confirm_new_password'));
    
            if ($data['new_password'] == $data['confirm_new_password']) {
               
               $this->db->where('hrm_id', $this->session->userdata('hrm_id'));
               $this->db->update('hrm', array('password' => $data['new_password']));
               $this->session->set_flashdata('flash_message', get_phrase('Password Changed'));
            }
    
            else{
                $this->session->set_flashdata('error_message', get_phrase('Type the same password'));
            }
            redirect(base_url() . 'hrm/manage_profile', 'refresh');
        }
    
            $page_data['page_name']     = 'manage_profile';
            $page_data['page_title']    = get_phrase('Manage Profile');
            $page_data['edit_profile']  = $this->db->get_where('hrm', array('hrm_id' => $this->session->userdata('hrm_id')))->result_array();
            $this->load->view('backend/index', $page_data);
        }
		
		function librarian($param1 = null, $param2 = null, $param3 = null){

        if ($param1 == 'insert'){

            $this->crud_model->insert_librarian();

            $this->session->set_flashdata('flash_message', get_phrase('Data successfully saved'));
            redirect(base_url(). 'hrm/librarian', 'refresh');
        }


        if($param1 == 'update'){

            $this->crud_model->update_librarian($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data successfully updated'));
            redirect(base_url(). 'hrm/librarian', 'refresh');

        }

        if($param1 == 'delete'){
            $this->crud_model->delete_librarian($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data successfully deleted'));
            redirect(base_url(). 'hrm/librarian', 'refresh');

        }

        $page_data['page_name']         = 'librarian';
        $page_data['page_title']        = get_phrase('Manage Librarian');
        $page_data['select_librarian']   = $this->db->get('librarian')->result_array();
        $this->load->view('backend/index', $page_data);
    }
	
	
	function teacher ($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'insert'){
            $this->teacher_model->insetTeacherFunction();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'hrm/teacher', 'refresh');
        }

        if($param1 == 'update'){
            $this->teacher_model->updateTeacherFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'hrm/teacher', 'refresh');
        }


        if($param1 == 'delete'){
            $this->teacher_model->deleteTeacherFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'hrm/teacher', 'refresh');
    
        }

        $page_data['page_name']     = 'teacher';
        $page_data['page_title']    = get_phrase('Manage Teacher');
        $page_data['select_teacher']  = $this->db->get('teacher')->result_array();
        $this->load->view('backend/index', $page_data);

    }
	
	function edit_teacher($teacher_id){
			$page_data['teacher_id'] = $teacher_id;
            $page_data['page_name']  = 'edit_teacher';
            $page_data['page_title'] = get_phrase('Teacher Profile');
            $this->load->view('backend/index', $page_data);
     }
	 
	 function printTeacherInformation($teacher_id){
        $page_data['teachers'] 	 =	$this->db->get_where('teacher' , array('teacher_id' => $teacher_id))->result_array();
        $page_data['page_name']  = 'printTeacherInformation';
        $page_data['page_title'] = get_phrase('Teacher Profile');
        $this->load->view('backend/index', $page_data);
    }

    function printAccountantInformation($accountant_id){
        $page_data['accountants']=	$this->db->get_where('accountant' , array('accountant_id' => $accountant_id))->result_array();
        $page_data['page_name']  = 'printAccountantInformation';
        $page_data['page_title'] = get_phrase('Accountant Profile');
        $this->load->view('backend/index', $page_data);
    }

    function printHumanResourcesInformation($hrm_id){
        $page_data['hrms'] 	     =	$this->db->get_where('hrm' , array('hrm_id' => $hrm_id))->result_array();
        $page_data['page_name']  = 'printHumanResourcesInformation';
        $page_data['page_title'] = get_phrase('HRM Profile');
        $this->load->view('backend/index', $page_data);
    }

    function printHostelManagerInformation($hostel_id){
        $page_data['hostels'] 	     =	$this->db->get_where('hostel' , array('hostel_id' => $hostel_id))->result_array();
        $page_data['page_name']  = 'printHostelManagerInformation';
        $page_data['page_title'] = get_phrase('Hostel Manager Profile');
        $this->load->view('backend/index', $page_data);
    }
     
    function printLibrarianInformation($librarian_id){
        $page_data['librarians'] 	 =	$this->db->get_where('librarian' , array('librarian_id' => $librarian_id))->result_array();
        $page_data['page_name']      = 'printLibrarianInformation';
        $page_data['page_title']     = get_phrase('Librarian Profile');
        $this->load->view('backend/index', $page_data);
    }
	
	
	function accountant($param1 = null, $param2 = null, $param3 = null){

        if ($param1 == 'insert'){

            $this->crud_model->insert_accountant();

            $this->session->set_flashdata('flash_message', get_phrase('Data successfully saved'));
            redirect(base_url(). 'hrm/accountant', 'refresh');
        }


        if($param1 == 'update'){

            $this->crud_model->update_accountant($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data successfully updated'));
            redirect(base_url(). 'hrm/accountant', 'refresh');

        }

        if($param1 == 'delete'){
            $this->crud_model->delete_accountant($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data successfully deleted'));
            redirect(base_url(). 'hrm/accountant', 'refresh');

        }

        $page_data['page_name']         = 'accountant';
        $page_data['page_title']        = get_phrase('Manage Accountant');
        $page_data['select_accountant']   = $this->db->get('accountant')->result_array();
        $this->load->view('backend/index', $page_data);
    }




    function hostel($param1 = null, $param2 = null, $param3 = null){

        if ($param1 == 'insert'){

            $this->crud_model->insert_hostel();

            $this->session->set_flashdata('flash_message', get_phrase('Data successfully saved'));
            redirect(base_url(). 'hrm/hostel', 'refresh');
        }


        if($param1 == 'update'){

            $this->crud_model->update_hostel($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data successfully updated'));
            redirect(base_url(). 'hrm/hostel', 'refresh');

        }

        if($param1 == 'delete'){
            $this->crud_model->delete_hostel($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data successfully deleted'));
            redirect(base_url(). 'hrm/hostel', 'refresh');

        }

        $page_data['page_name']         = 'hostel';
        $page_data['page_title']        = get_phrase('Manage Hostel');
        $page_data['select_hostel']     = $this->db->get('hostel')->result_array();
        $this->load->view('backend/index', $page_data);
    }





    function hrm($param1 = null, $param2 = null, $param3 = null){

        if ($param1 == 'insert'){

            $this->crud_model->insert_hrm();

            $this->session->set_flashdata('flash_message', get_phrase('Data successfully saved'));
            redirect(base_url(). 'hrm/hrm', 'refresh');
        }


        if($param1 == 'update'){

            $this->crud_model->update_hrm($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data successfully updated'));
            redirect(base_url(). 'hrm/hrm', 'refresh');

        }

        if($param1 == 'delete'){
            $this->crud_model->delete_hrm($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data successfully deleted'));
            redirect(base_url(). 'hrm/hrm', 'refresh');

        }

        $page_data['page_name']         = 'hrm';
        $page_data['page_title']        = get_phrase('Manage HRM');
        $page_data['select_hrm']        = $this->db->get('hrm')->result_array();
        $this->load->view('backend/index', $page_data);
    }
	
		


        function get_designation($department_id){

			$designation = $this->db->get_where('designation', array('department_id' => $department_id))->result_array();
			foreach($designation as $key => $row)
			echo '<option value="'.$row['designation_id'].'">' . $row['name'] . '</option>';
    	}
    
        /***********  The function manages vacancy   ***********************/
        function vacancy ($param1 = null, $param2 = null, $param3 = null){
    
            if($param1 == 'insert'){
                $this->vacancy_model->insetVacancyFunction();
                $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
                redirect(base_url(). 'hrm/vacancy', 'refresh');
            }
    
            if($param1 == 'update'){
                $this->vacancy_model->updateVacancyFunction($param2);
                $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
                redirect(base_url(). 'hrm/vacancy', 'refresh');
            }
    
    
            if($param1 == 'delete'){
                $this->vacancy_model->deleteVacancyFunction($param2);
                $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
                redirect(base_url(). 'hrm/vacancy', 'refresh');
        
            }
    
            $page_data['page_name']     = 'vacancy';
            $page_data['page_title']    = get_phrase('Manage Vacancy');
            $page_data['select_vacancy']  = $this->db->get('vacancy')->result_array();
            $this->load->view('backend/index', $page_data);
    
        }
    
    
        /***********  The function manages job applicant   ***********************/
        function application ($param1 = 'applied', $param2 = null, $param3 = null){
    
            if($param1 == 'insert'){
                $this->application_model->insertApplicantFunction();
                $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
                redirect(base_url(). 'hrm/application', 'refresh');
            }
    
            if($param1 == 'update'){
                $this->application_model->updateApplicantFunction($param2);
                $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
                redirect(base_url(). 'hrm/application', 'refresh');
            }
    
    
            if($param1 == 'delete'){
                $this->application_model->deleteApplicantFunction($param2);
                $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
                redirect(base_url(). 'hrm/application', 'refresh');
        
            }
    
            if($param1 != 'applied' && $param1 != 'on_review' && $param1 != 'interviewed' && $param1 != 'offered' && $param1 != 'hired' && $param1 != 'declined')
            $param1 ='applied';
    
            
            
            $page_data['status']        = $param1;
            $page_data['page_name']     = 'application';
            $page_data['page_title']    = get_phrase('Job Applicant');
            $this->load->view('backend/index', $page_data);
    
        }
    
    
        /***********  The function manages Leave  ***********************/
        function leave ($param1 = null, $param2 = null, $param3 = null){
    
            if($param1 == 'update'){
                $this->leave_model->updateLeaveFunction($param2);
                $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
                redirect(base_url(). 'hrm/leave', 'refresh');
            }
    
    
            if($param1 == 'delete'){
                $this->leave_model->deleteLeaveFunction($param2);
                $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
                redirect(base_url(). 'hrm/leave', 'refresh');
        
            }
            
            $page_data['page_name']     = 'leave';
            $page_data['page_title']    = get_phrase('Manage Leave');
            $this->load->view('backend/index', $page_data);
    
        }
    
    
        /***********  The function manages Awards  ***********************/
        function award ($param1 = null, $param2 = null, $param3 = null){
    
            if($param1 == 'create'){
                $this->award_model->createAwardFunction();
                $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
                redirect(base_url(). 'hrm/award', 'refresh');
            }
    
            if($param1 == 'update'){
                $this->award_model->updateAwardFunction($param2);
                $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
                redirect(base_url(). 'hrm/award', 'refresh');
            }
    
    
            if($param1 == 'delete'){
                $this->award_model->deleteAwardFunction($param2);
                $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
                redirect(base_url(). 'hrm/award', 'refresh');
        
            }
    
            $page_data['page_name']     = 'award';
            $page_data['page_title']    = get_phrase('Manage Award');
            $this->load->view('backend/index', $page_data);
    
        }
    
        function payroll(){
            
            $page_data['page_name']     = 'payroll_add';
            $page_data['page_title']    = get_phrase('Create Payslip');
            $this->load->view('backend/index', $page_data);
    
        }
    
        function get_employees($department_id = null){
        
			$user_array = ['teacher', 'accountant', 'librarian','hostel','hrm'];
			for ($i=0; $i < sizeof($user_array); $i++){
				$user_list = $this->db->get_where($user_array[$i], array('department_id' => $department_id))->result_array();
				 foreach($user_list as $key => $employees){
					echo '<option value="' . $user_array[$i].'-'.$employees[$user_array[$i].'_id'] . '">' . $employees['name']. '</option>';
				}
			}
    	}
    
        function payroll_selector()
        {
            $department_id  = $this->input->post('department_id');
            $employee_id    = $this->input->post('employee_id');
            $month          = $this->input->post('month');
            $year           = $this->input->post('year');
            
            redirect(base_url() . 'hrm/payroll_view/' . $department_id. '/' . $employee_id . '/' . $month . '/' . $year, 'refresh');
        }
        
        function payroll_view($department_id = null, $employee_id = null, $month = null, $year = null)
        {
            $page_data['department_id'] = $department_id;
            $page_data['employee_id']   = $employee_id;
            $page_data['month']         = $month;
            $page_data['year']          = $year;
            $page_data['page_name']     = 'payroll_add_view';
            $page_data['page_title']    = get_phrase('Create Payslip');
            $this->load->view('backend/index', $page_data);
        }
    
    
        function create_payroll(){
    
            $this->payroll_model->insertPayrollFunction();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'hrm/payroll_list/filter2/'. $this->input->post('month').'/'. $this->input->post('year'), 'refresh');
        }
    
    
        /***********  The function manages Payroll List  ***********************/
        function payroll_list ($param1 = null, $param2 = null, $param3 = null, $param4 = null){
    
            if($param1 == 'mark_paid'){
                
                $data['status'] =  1;
                $this->db->update('payroll', $data, array('payroll_id' => $param2));
    
                $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
                redirect(base_url(). 'hrm/payroll_list/filter2/'. $param3.'/'. $param4, 'refresh');
            }
			
			if($param1 == 'delete'){
                
                $this->db->where('payroll_code', $param2);
				$this->db->delete('payroll');
    
                $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
                redirect(base_url(). 'hrm/payroll_list/filter2/'. $param3.'/'. $param4, 'refresh');
            }
			
    
            if($param1 == 'filter'){
                $page_data['month'] = $this->input->post('month');
                $page_data['year'] = $this->input->post('year');
            }
            else{
                $page_data['month'] = date('n');
                $page_data['year'] = date('Y');
            }
    
            if($param1 == 'filter2'){
                
                $page_data['month'] = $param2;
                $page_data['year'] = $param3;
            }
    
    
            $page_data['page_name']     = 'payroll_list';
            $page_data['page_title']    = get_phrase('List Payroll');
            $this->load->view('backend/index', $page_data);
    
        }

         /* private messaging function starts from here: Here the function attach files, send and reply message accrodingly */
		function message($param1 = 'message_home', $param2 = '', $param3 = '') {
            if ($this->session->userdata('hrm_login') != true)
            redirect(base_url(), 'refresh');
                
            $max_size = 2097152;
            if ($param1 == 'send_new') {
                    
            if (!file_exists('uploads/private_messaging_attached_file/')) 
            {
            $oldmask = umask(0);  // helpful when used in linux server
            mkdir ('uploads/private_messaging_attached_file/', 0777);
            }
            
            if ($_FILES['attached_file_on_messaging']['name'] != "") 
            {
            if($_FILES['attached_file_on_messaging']['size'] > $max_size)
            {
            $this->session->set_flashdata('error_message' , get_phrase('file_size_can_not_be_larger_that_2_Megabyte'));
            redirect(base_url() . 'hrm/message/message_new/', 'refresh');
            }
            
            else
            {
            $file_path = 'uploads/private_messaging_attached_file/'.$_FILES['attached_file_on_messaging']['name'];
            move_uploaded_file($_FILES['attached_file_on_messaging']['tmp_name'], $file_path);
            }
            }
            
            $message_thread_code = $this->crud_model->send_new_private_message();
            $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
            redirect(base_url() . 'hrm/message/message_read/' . $message_thread_code, 'refresh');					
            }
    
        if ($param1 == 'send_reply') {
        
        if (!file_exists('uploads/private_messaging_attached_file/')) 
            {
            $oldmask = umask(0);  // helpful when used in linux server
            mkdir ('uploads/private_messaging_attached_file/', 0777);
            }
            if ($_FILES['attached_file_on_messaging']['name'] != "") 
            {
            if($_FILES['attached_file_on_messaging']['size'] > $max_size)
            {
            $this->session->set_flashdata('error_message' , get_phrase('file_size_can_not_be_larger_that_2_Megabyte'));
            redirect(base_url() . 'hrm/message/message_read/' . $param2, 'refresh');
            }
            else
            {
            $file_path = 'uploads/private_messaging_attached_file/'.$_FILES['attached_file_on_messaging']['name'];
            move_uploaded_file($_FILES['attached_file_on_messaging']['tmp_name'], $file_path);
            }
            }
                
            $this->crud_model->send_reply_message($param2);  //$param2 = message_thread_code
            $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
            redirect(base_url() . 'hrm/message/message_read/' . $param2, 'refresh');
                
            }
    
            if ($param1 == 'message_read') {
                $page_data['current_message_thread_code'] = $param2;  // $param2 = message_thread_code
                $this->crud_model->mark_thread_messages_read($param2);
            }
        
                $page_data['message_inner_page_name'] = $param1;
                $page_data['page_name'] = 'message';
                $page_data['page_title'] = get_phrase('private_messaging');
                $this->load->view('backend/index', $page_data);
            }

            /***********  the function help to participate in group messages provided hrm add the particular hrm ID into the group messages. ********************/
    function group_message($param1 = "group_message_home", $param2 = ""){
        if ($this->session->userdata('hrm_login') != true)
            redirect(base_url(), 'refresh');
        $max_size = 2097152;
  
        if ($param1 == 'group_message_read') {
          $page_data['current_message_thread_code'] = $param2;
        }
        else if($param1 == 'send_reply'){
          if (!file_exists('uploads/group_messaging_attached_file/')) {
            $oldmask = umask(0);  // helpful when used in linux server
            mkdir ('uploads/group_messaging_attached_file/', 0777);
          }
          if ($_FILES['attached_file_on_messaging']['name'] != "") {
            if($_FILES['attached_file_on_messaging']['size'] > $max_size){
              $this->session->set_flashdata('error_message' , get_phrase('file_size_can_not_be_larger_that_2_Megabyte'));
                redirect(site_url('hrm/group_message/group_message_read/' . $param2), 'refresh');
  
            }
            else{
              $file_path = 'uploads/group_messaging_attached_file/'.$_FILES['attached_file_on_messaging']['name'];
              move_uploaded_file($_FILES['attached_file_on_messaging']['tmp_name'], $file_path);
            }
          }
  
          $this->crud_model->send_reply_group_message($param2);  //$param2 = message_thread_code
          $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
            redirect(site_url('hrm/group_message/group_message_read/' . $param2), 'refresh');
        }
        $page_data['message_inner_page_name']   = $param1;
        $page_data['page_name']                 = 'group_message';
        $page_data['page_title']                = get_phrase('group_messaging');
        $this->load->view('backend/index', $page_data);
      }
      /***********  / the function help to participate in group messages provided hrm add the particular hrm ID into the group messages. ********************/
      
      
      // This function call from AJAX
      function generalMessageDelete($general_message_id) {
      $this->db->where('general_message_id', $general_message_id);
              $this->db->delete('general_message');
                      redirect(base_url() . 'hrm/dashboard', 'refresh');
      
      }
      
      // This function call from AJAX
      function deleteMessageFunction($message_id, $message_thread_code) {
      $this->db->where('message_id', $message_id);
              $this->db->delete('message');
                      redirect(base_url() . 'hrm/message/message_read/'.$message_thread_code , 'refresh');
      
      }
      
      // This function call from AJAX
      function deleteMessageFunctionGroup($group_message_id, $group_message_thread_code) {
      $this->db->where('group_message_id', $group_message_id);
              $this->db->delete('group_message');
                      redirect(base_url() . 'hrm/group_message/group_message_read/'.$group_message_thread_code , 'refresh');
      
      }


       /******^^^^^^^^  / This function parents login status to either online or offline ********************/
       function updateMyStatusToOffline($param1 = null, $param2 = null, $param3 = null) {
			if ($param1 == 'updateStatus') {
			$messageThread	=	$this->input->post('messageThread');
			$data['login_status'] = $this->input->post('login_status');
			$this->db->where('hrm_id', $this->session->userdata('login_user_id'));
			$this->db->update('hrm', $data);
	
			$this->session->set_flashdata('flash_message', get_phrase('Successfully Updated'));
			redirect(base_url() . 'hrm/message/message_read/'.$messageThread, 'refresh');
			}		
		}
	/******^^^^^^^^  / This function parents login status to either online or offline ends here ********************/
	
	
	 /**************** function to manage leave application by teacher ***************/
    function myleave($param1 = '', $param2 = ''){
        
        
        if ($param1 == 'create') {
            $leave = $this->crud_model->create_leave();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url() . 'hrm/myleave', 'refresh');
        }

        if ($param1 == 'update') {
            $this->crud_model->update_leave($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url() . 'hrm/myleave', 'refresh');
        }
        
        if ($param1 == 'delete') {
            $this->crud_model->delete_leave($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url() . 'hrm/myleave', 'refresh');
        }
        
        $page_data['page_name']     = 'myleave';
        $page_data['page_title']    = get_phrase('List Leave');
        $this->load->view('backend/index', $page_data);
    }
    /**************** / function to manage leave application by teacher ***************/

		/**************** PAYROLL LIST PAGE ***************/
		function mypayroll_list(){
			$page_data['page_name']     = 'mypayroll_list';
			$page_data['page_title']    = get_phrase('Payment Slip');
			$this->load->view('backend/index', $page_data);
		}
		/**************** / PAYROLL LIST PAGE ***************/

		/********* function for awards ************/
		function myaward($param1 = null, $param2 = null){
		
			
		$page_data['page_name']     = 'myaward';
		$page_data['page_title']    = get_phrase('List Awards');
		$this->load->view('backend/index', $page_data);
		}
		/*********  / function for awards ************/

}