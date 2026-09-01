<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Librarian extends CI_Controller { 

    function __construct() {
        parent::__construct();
        		$this->load->database();                                //Load Databse Class
                $this->load->library('session');					    //Load library for session
                $this->load->model('library_model');

    }

     /*librarian dashboard code to redirect to librarian page if successfull login** */
     function dashboard() {
        if ($this->session->userdata('librarian_login') != 1) redirect(base_url(), 'refresh');
       	$page_data['page_name'] = 'dashboard';
        $page_data['page_title'] = get_phrase('librarian Dashboard');
        $this->load->view('backend/index', $page_data);
    }
	/******************* / librarian dashboard code to redirect to librarian page if successfull login** */

    function manage_profile($param1 = null, $param2 = null, $param3 = null){
        if ($this->session->userdata('librarian_login') != 1) redirect(base_url(), 'refresh');
        if ($param1 == 'update') {
    
    
            $data['name']   =   $this->input->post('name');
            $data['email']  =   $this->input->post('email');
			
			
			//uploading file1 using codeigniter upload library
			$this->load->library('upload');
			$file_name = $this->session->userdata('librarian_id') . '.jpg';
			$config['upload_path'] 				= 'uploads/librarian_image/';
			$config['allowed_types'] 			= 'jpeg|jpg|JPEG';
			$config['max_size'] 				= '3000000';
			$config['overwrite']            	= true;
			$config['file_name']            	= $file_name;
	
			$this->upload->initialize($config);
			if( ! $this->upload->do_upload('userfile')){
				$this->session->set_flashdata('error_message', $this->upload->display_errors());
				redirect(base_url() . 'librarian/manage_profile', 'refresh');
			}
			$this->security->xss_clean($data);
			
    
            $this->db->where('librarian_id', $this->session->userdata('librarian_id'));
            $this->db->update('librarian', $data);
            $this->session->set_flashdata('flash_message', get_phrase('Info Updated'));
            redirect(base_url() . 'librarian/manage_profile', 'refresh');
           
        }
    
        if ($param1 == 'change_password') {
            $data['new_password']           =   sha1($this->input->post('new_password'));
            $data['confirm_new_password']   =   sha1($this->input->post('confirm_new_password'));
    
            if ($data['new_password'] == $data['confirm_new_password']) {
               
               $this->db->where('librarian_id', $this->session->userdata('librarian_id'));
               $this->db->update('librarian', array('password' => $data['new_password']));
               $this->session->set_flashdata('flash_message', get_phrase('Password Changed'));
            }
    
            else{
                $this->session->set_flashdata('error_message', get_phrase('Type the same password'));
            }
            redirect(base_url() . 'librarian/manage_profile', 'refresh');
        }
    
            $page_data['page_name']     = 'manage_profile';
            $page_data['page_title']    = get_phrase('Manage Profile');
            $page_data['edit_profile']  = $this->db->get_where('librarian', array('librarian_id' => $this->session->userdata('librarian_id')))->result_array();
            $this->load->view('backend/index', $page_data);
        }



        /***********  The function below add, update and delete publisher table ***********************/
    function publisher ($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'create'){
            $this->library_model->createPublisherFunction();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'librarian/publisher', 'refresh');
        }

        if($param1 == 'update'){
            $this->library_model->updatePublisherFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'librarian/publisher', 'refresh');
        }

        if($param1 == 'delete'){
            $this->library_model->deletePublisherFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'librarian/publisher', 'refresh');
        }

        $page_data['page_name']     = 'publisher';
        $page_data['page_title']    = get_phrase('Manage Publisher');
        $this->load->view('backend/index', $page_data);
    }
    /***********  The function below add, update and delete publisher table ends here ***********************/


    /***********  The function below add, update and delete publisher table ***********************/
    function author ($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'create'){
            $this->library_model->createAuthorFunction();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'librarian/author', 'refresh');
        }

        if($param1 == 'update'){
            $this->library_model->updateAuthorFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'librarian/author', 'refresh');
        }

        if($param1 == 'delete'){
            $this->library_model->deleteAuthorFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'librarian/author', 'refresh');
        }

        $page_data['page_name']     = 'author';
        $page_data['page_title']    = get_phrase('Manage Author');
        $this->load->view('backend/index', $page_data);
    }

    /***********  The function below add, update and delete publisher table ends here ***********************/

    /***********  The function below add, update and delete BookCategory table ***********************/
    function book_category ($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'create'){
            $this->library_model->createBookCategoryFunction();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'librarian/book_category', 'refresh');
        }

        if($param1 == 'update'){
            $this->library_model->updateBookCategoryFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'librarian/book_category', 'refresh');
        }

        if($param1 == 'delete'){
            $this->library_model->deleteBookCategoryFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'librarian/book_category', 'refresh');
        }

        $page_data['page_name']     = 'book_category';
        $page_data['page_title']    = get_phrase('Book Category');
        $this->load->view('backend/index', $page_data);
    }
    /***********  The function below add, update and delete BookCategory table ends here ***********************/



    /***********  The function below add, update and delete book table ***********************/
    function book ($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'create'){
            $this->library_model->createBookFunction();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'librarian/book', 'refresh');
        }

        if($param1 == 'update'){
            $this->library_model->updateBookFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'librarian/book', 'refresh');
        }

        if($param1 == 'delete'){
            $this->library_model->deleteBookFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'librarian/book', 'refresh');
        }

        $page_data['page_name']     = 'book';
        $page_data['page_title']    = get_phrase('Manage Library');
        $this->load->view('backend/index', $page_data);
    }
    /***********  The function below add, update and delete book table ends here ***********************/
	
	
	
	
	/**************** function to manage leave application by teacher ***************/
    function leave($param1 = '', $param2 = ''){
        
        if ($param1 == 'create') {
            $leave = $this->crud_model->create_leave();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url() . 'librarian/leave', 'refresh');
        }

        if ($param1 == 'update') {
            $this->crud_model->update_leave($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url() . 'librarian/leave', 'refresh');
        }
        
        if ($param1 == 'delete') {
            $this->crud_model->delete_leave($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url() . 'librarian/leave', 'refresh');
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