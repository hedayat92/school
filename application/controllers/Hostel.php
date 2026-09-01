<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Hostel extends CI_Controller { 

    function __construct() {
        parent::__construct();
        		$this->load->database();                                //Load Databse Class
                $this->load->library('session');					    //Load library for session
                $this->load->model('dormitory_model');
               
    }

     /*hostel dashboard code to redirect to hostel page if successfull login** */
     function dashboard() {
        if ($this->session->userdata('hostel_login') != 1) redirect(base_url(), 'refresh');
       	$page_data['page_name'] = 'dashboard';
        $page_data['page_title'] = get_phrase('Hostel Manager');
        $this->load->view('backend/index', $page_data);
    }
    /******************* / hostel dashboard code to redirect to hostel page if successfull login** */


    function manage_profile($param1 = null, $param2 = null, $param3 = null){
        if ($this->session->userdata('hostel_login') != 1) redirect(base_url(), 'refresh');
        if ($param1 == 'update') {
    
    
            $data['name']   =   $this->input->post('name');
            $data['email']  =   $this->input->post('email');
			
			//uploading file1 using codeigniter upload library
			$this->load->library('upload');
			$file_name = $this->session->userdata('hostel_id') . '.jpg';
			$config['upload_path'] 				= 'uploads/hostel_image/';
			$config['allowed_types'] 			= 'jpeg|jpg|JPEG';
			$config['max_size'] 				= '3000000';
			$config['overwrite']            	= true;
			$config['file_name']            	= $file_name;
	
			$this->upload->initialize($config);
			if( ! $this->upload->do_upload('userfile')){
				$this->session->set_flashdata('error_message', $this->upload->display_errors());
				redirect(base_url() . 'hostel/manage_profile', 'refresh');
			}
			$this->security->xss_clean($data);
			
    
            $this->db->where('hostel_id', $this->session->userdata('hostel_id'));
            $this->db->update('hostel', $data);
            $this->session->set_flashdata('flash_message', get_phrase('Info Updated'));
            redirect(base_url() . 'hostel/manage_profile', 'refresh');
           
        }
    
        if ($param1 == 'change_password') {
            $data['new_password']           =   sha1($this->input->post('new_password'));
            $data['confirm_new_password']   =   sha1($this->input->post('confirm_new_password'));
    
            if ($data['new_password'] == $data['confirm_new_password']) {
               
               $this->db->where('hostel_id', $this->session->userdata('hostel_id'));
               $this->db->update('hostel', array('password' => $data['new_password']));
               $this->session->set_flashdata('flash_message', get_phrase('Password Changed'));
            }
    
            else{
                $this->session->set_flashdata('error_message', get_phrase('Type the same password'));
            }
            redirect(base_url() . 'hostel/manage_profile', 'refresh');
        }
    
            $page_data['page_name']     = 'manage_profile';
            $page_data['page_title']    = get_phrase('Manage Profile');
            $page_data['edit_profile']  = $this->db->get_where('hostel', array('hostel_id' => $this->session->userdata('hostel_id')))->result_array();
            $this->load->view('backend/index', $page_data);
        }


         /***********  The function manages school dormitory  ***********************/
    function dormitory ($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'create'){
            $this->dormitory_model->createDormitoryFunction();
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'hostel/dormitory', 'refresh');
        }
    
        if($param1 == 'update'){
            $this->dormitory_model->updateDormitoryFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'hostel/dormitory', 'refresh');
        }
    
    
        if($param1 == 'delete'){
            $this->dormitory_model->deleteDormitoryFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'hostel/dormitory', 'refresh');
    
        }
    
        $page_data['page_name']     = 'dormitory';
        $page_data['page_title']    = get_phrase('Manage Dormitory');
        $this->load->view('backend/index', $page_data);
    
        }
    
    
        /***********  The function manages hostel room  ***********************/
        function hostel_room ($param1 = null, $param2 = null, $param3 = null){
    
        if($param1 == 'create'){
            $this->dormitory_model->createHostelRoomFunction();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'hostel/hostel_room', 'refresh');
        }
    
        if($param1 == 'update'){
            $this->dormitory_model->updateHostelRoomFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'hostel/hostel_room', 'refresh');
        }
    
    
        if($param1 == 'delete'){
            $this->dormitory_model->deleteHostelRoomFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'hostel/hostel_room', 'refresh');
    
        }
    
        $page_data['page_name']     = 'hostel_room';
        $page_data['page_title']    = get_phrase('Hostel Room');
        $this->load->view('backend/index', $page_data);
    
        }
    
    
        /***********  The function manages hostel category  ***********************/
        function hostel_category ($param1 = null, $param2 = null, $param3 = null){
    
        if($param1 == 'create'){
            $this->dormitory_model->createHostelCategoryFunction();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'hostel/hostel_category', 'refresh');
        }
    
        if($param1 == 'update'){
            $this->dormitory_model->updateHostelCategoryFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'hostel/hostel_category', 'refresh');
        }
    
    
        if($param1 == 'delete'){
            $this->dormitory_model->deleteHostelCategoryFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'hostel/hostel_category', 'refresh');
    
        }
    
        $page_data['page_name']     = 'hostel_category';
        $page_data['page_title']    = get_phrase('Hostel Category');
        $this->load->view('backend/index', $page_data);
        }
		
		
		/**************** function to manage leave application by teacher ***************/
    function leave($param1 = '', $param2 = ''){
   
        
        if ($param1 == 'create') {
            $leave = $this->crud_model->create_leave();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url() . 'teacher/leave', 'refresh');
        }

        if ($param1 == 'update') {
            $this->crud_model->update_leave($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url() . 'teacher/leave', 'refresh');
        }
        
        if ($param1 == 'delete') {
            $this->crud_model->delete_leave($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url() . 'teacher/leave', 'refresh');
        }
        
        $page_data['page_name']     = 'leave';
        $page_data['page_title']    = get_phrase('List Leave');
        $this->load->view('backend/index', $page_data);
    }
    /**************** / function to manage leave application by teacher ***************/

		/**************** PAYROLL LIST PAGE ***************/
		function payroll_list(){
			$page_data['page_name']     = 'payroll_list';
			$page_data['page_title']    = get_phrase('Payment Slip');
			$this->load->view('backend/index', $page_data);
		}
		/**************** / PAYROLL LIST PAGE ***************/

		/********* function for awards ************/
		function award($param1 = null, $param2 = null){

			
		$page_data['page_name']     = 'award';
		$page_data['page_title']    = get_phrase('List Awards');
		$this->load->view('backend/index', $page_data);
		}
		/*********  / function for awards ************/
	



}