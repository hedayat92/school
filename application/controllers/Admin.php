<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require FCPATH . '/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Admin extends CI_Controller { 

    function __construct() {
        parent::__construct();
        		$this->load->database();                                //Load Databse Class
                $this->load->library('session');					    //Load library for session
                $this->load->model('vacancy_model');                    // Load vacancy Model Here
                $this->load->model('application_model');                // Load Apllication Model Here
                $this->load->model('leave_model');                      // Load Apllication Model Here
                $this->load->model('award_model');                      // Load Apllication Model Here
                $this->load->model('academic_model');                   // Load Apllication Model Here
                $this->load->model('student_model');                    // Load Apllication Model Here
                $this->load->model('exam_question_model');              // Load Apllication Model Here
                $this->load->model('student_payment_model');            // Load Apllication Model Here
                $this->load->model('event_model');                      // Load Apllication Model Here
                $this->load->model('language_model');                   // Load Apllication Model Here
                $this->load->model('admin_model');                      // Load Apllication Model Here
                //$this->load->model('Barcode_model');                  // Loading the Barcode Model
                $this->load->library('phpqrcode/qrlib');                // Loading Qr From the Library
                $this->load->model('website_model');	
				//$this->load->library('excel');
				$this->load->library('pdf');
				
				$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
				$this->output->set_header('Pragma: no-cache'); 
				
				timezone();

    }

    /**default functin, redirects to login page if no admin logged in yet***/
    public function index() {
        if ($this->session->userdata('admin_login') != 1) redirect(base_url() . 'login', 'refresh');
        if ($this->session->userdata('admin_login') == 1) redirect(base_url() . 'admin/dashboard', 'refresh');
    }
	  /************* / default functin, redirects to login page if no admin logged in yet***/

    /*Admin dashboard code to redirect to admin page if successfull login** */
    function dashboard() {
	$this->schoolFeaturesForAdmin();
        if ($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');
       	$page_data['page_name'] = 'dashboard';
        $page_data['page_title'] = get_phrase('admin_dashboard');
        $this->load->view('backend/index', $page_data);
    }
	/******************* / Admin dashboard code to redirect to admin page if successfull login** */


    function manage_profile($param1 = null, $param2 = null, $param3 = null){
	$this->schoolFeaturesForAdmin();
    if ($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');
    if ($param1 == 'update') {


        $data['name']   =   html_escape($this->input->post('name'));
        $data['email']  =   html_escape($this->input->post('email'));
		$data['phone']  =   html_escape($this->input->post('phone'));
		
		
			//uploading file1 using codeigniter upload library
			$this->load->library('upload');
			$file_name = $this->session->userdata('admin_id') . '.jpg';
			$config['upload_path'] 				= 'uploads/admin_image/';
			$config['allowed_types'] 			= 'jpeg|jpg|JPEG|png|PNG|JPG';
			$config['max_size'] 				= '3000000';
			$config['overwrite']            	= true;
			$config['file_name']            	= $file_name;
	
			$this->upload->initialize($config);
			if( ! $this->upload->do_upload('userfile')){
				$this->session->set_flashdata('error_message', $this->upload->display_errors());
				redirect(base_url() . 'admin/manage_profile', 'refresh');
			}
			$this->security->xss_clean($data);
		

        $this->db->where('admin_id', $this->session->userdata('admin_id'));
        $this->db->update('admin', $data);
        //move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/admin_image/' . $this->session->userdata('admin_id') . '.jpg');
        $this->session->set_flashdata('flash_message', get_phrase('Info Updated'));
        redirect(base_url() . 'admin/manage_profile', 'refresh');
       
    }

    if ($param1 == 'change_password') {
        $data['new_password']           =   sha1($this->input->post('new_password'));
        $data['confirm_new_password']   =   sha1($this->input->post('confirm_new_password'));

        if ($data['new_password'] == $data['confirm_new_password']) {
           
           $this->db->where('admin_id', $this->session->userdata('admin_id'));
           $this->db->update('admin', array('password' => $data['new_password']));
           $this->session->set_flashdata('flash_message', get_phrase('Password Changed'));
        }

        else{
            $this->session->set_flashdata('error_message', get_phrase('Type the same password'));
        }
        redirect(base_url() . 'admin/manage_profile', 'refresh');
    }

        $page_data['page_name']     = 'manage_profile';
        $page_data['page_title']    = get_phrase('Manage Profile');
        $page_data['edit_profile']  = $this->db->get_where('admin', array('admin_id' => $this->session->userdata('admin_id')))->result_array();
        $this->load->view('backend/index', $page_data);
    }


    function enquiry_category($param1 = null, $param2 = null, $param3 = null){
    if($param1 == 'insert'){
   
        $this->crud_model->enquiry_category();

        $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
        redirect(base_url(). 'admin/enquiry_category', 'refresh');
    }

    if($param1 == 'update'){

       $this->crud_model->update_category($param2);


        $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
        redirect(base_url(). 'admin/enquiry_category', 'refresh');

        }

    if($param1 == 'delete'){

       $this->crud_model->delete_category($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
        redirect(base_url(). 'admin/enquiry_category', 'refresh');

        }

        $page_data['page_name']     = 'enquiry_category';
        $page_data['page_title']    = get_phrase('Manage Category');
        $page_data['enquiry_category']  = $this->db->get('enquiry_category')->result_array();
        $this->load->view('backend/index', $page_data);

    }


    function list_enquiry ($param1 = null, $param2 = null, $param3 = null){


        if($param1 == 'delete')
        {
            $this->crud_model->delete_enquiry($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/list_enquiry', 'refresh');
    
        }

        $page_data['page_name']     = 'list_enquiry';
        $page_data['page_title']    = get_phrase('All Enquiries');
        $page_data['select_enquiry']  = $this->db->get('enquiry')->result_array();
        $this->load->view('backend/index', $page_data);

    }



    function club ($param1 = null, $param2 = null, $param3 = null){
	$this->schoolFeaturesForAdmin();
        if($param1 == 'insert'){
            $this->crud_model->insert_club();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/club', 'refresh');
        }

        if($param1 == 'update'){
            $this->crud_model->update_club($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/club', 'refresh');
        }


        if($param1 == 'delete'){
            $this->crud_model->delete_club($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/club', 'refresh');
    
            }


        $page_data['page_name']     = 'club';
        $page_data['page_title']    = get_phrase('Manage Club');
        $page_data['select_club']  = $this->db->get('club')->result_array();
        $this->load->view('backend/index', $page_data);

    }


    function circular($param1 = null, $param2 = null, $param3 = null){
	$this->schoolFeaturesForAdmin();

        if ($param1 == 'insert'){

            $this->crud_model->insert_circular();
            $this->session->set_flashdata('flash_message', get_phrase('Data successfully saved'));
            redirect(base_url(). 'admin/circular', 'refresh');
        }


        if($param1 == 'update'){

            $this->crud_model->update_circular($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data successfully updated'));
            redirect(base_url(). 'admin/circular', 'refresh');

        }


        if($param1 == 'delete'){
            $this->crud_model->delete_circular($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data successfully deleted'));
            redirect(base_url(). 'admin/circular', 'refresh');


        }

        $page_data['page_name']         = 'circular';
        $page_data['page_title']        = get_phrase('Manage Circular');
        $page_data['select_circular']   = $this->db->get('circular')->result_array();
        $this->load->view('backend/index', $page_data);

    }


    function parent($param1 = null, $param2 = null, $param3 = null){
	$this->schoolFeaturesForAdmin();

        if ($param1 == 'insert'){

            $this->crud_model->insert_parent();
            $this->session->set_flashdata('flash_message', get_phrase('Data successfully saved'));
            redirect(base_url(). 'admin/parent', 'refresh');
        }


        if($param1 == 'update'){

            $this->crud_model->update_parent($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data successfully updated'));
            redirect(base_url(). 'admin/parent', 'refresh');

        }

        if($param1 == 'delete'){
            $this->crud_model->delete_parent($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data successfully deleted'));
            redirect(base_url(). 'admin/parent', 'refresh');

        }
		
		
		if($param1 == 'bulk_upload'){
		

			$file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			
			if(isset($_FILES['excel_file']['name']) && in_array($_FILES['excel_file']['type'], $file_mimes)) {
				$arr_file = explode('.', $_FILES['excel_file']['name']);
				$extension = end($arr_file);
				
				if('csv' == $extension){
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
				}elseif('xls' == $extension){
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
				}else {
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
				}
				$spreadsheet = $reader->load($_FILES['excel_file']['tmp_name']);
				$sheetData = $spreadsheet->getActiveSheet()->toArray();
				
				if (!empty($sheetData)) {
				
					for ($i=1; $i<count($sheetData); $i++) {
					//for ($i=1; $i <= $sheetData; $i++) {
					
					// foreach ($reader as $index => $row) {
						//if ($sheetData === 0) {
						//	continue;
						//}
					
						$data['name'] 			= $sheetData[$i][0];
						$data['sex'] 			= $sheetData[$i][1];
						$data['email'] 			= $sheetData[$i][2];
						$data['password'] 		= sha1($sheetData[$i][3]);
						$data['phone'] 			= $sheetData[$i][4];
						$data['address'] 		= $sheetData[$i][5];
						$data['profession'] 	= $sheetData[$i][6];
						
						if($data['name'] != null && $data['sex'] != null && $data['email'] != null && $data['password'] != null && $data['phone'] != null && $data['address'] != null && $data['profession'] != null){
						
						$sql = "select * from parent order by parent_id desc limit 1";
						$return_query = $this->db->query($sql)->row()->parent_id + 1;
						$data['parent_id'] = $return_query;	
										
						$this->db->insert('parent', $data);
						
						
						}else{
							
							redirect($_SERVER['HTTP_REFERER']);
						
						}
							
					}
					
				$this->session->set_flashdata('flash_message', get_phrase('parent uploaded successfully'));
				redirect($_SERVER['HTTP_REFERER']);
				
				}else{
					$this->session->set_flashdata('error_message', get_phrase('please select excel file'));
					redirect($_SERVER['HTTP_REFERER']);
				}
				
			}else{
				$this->session->set_flashdata('error_message', get_phrase('file not uploaded'));
				redirect($_SERVER['HTTP_REFERER']);
			}
		
			
				
		}
		
		
		

        $page_data['page_name']         = 'parent';
        $page_data['page_title']        = get_phrase('Manage Parent');
        $page_data['select_parent']   = $this->db->get('parent')->result_array();
        $this->load->view('backend/index', $page_data);
    }


    function librarian($param1 = null, $param2 = null, $param3 = null){
	$this->schoolFeaturesForAdmin();

        if ($param1 == 'insert'){

            $this->crud_model->insert_librarian();

            $this->session->set_flashdata('flash_message', get_phrase('Data successfully saved'));
            redirect(base_url(). 'admin/librarian', 'refresh');
        }


        if($param1 == 'update'){

            $this->crud_model->update_librarian($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data successfully updated'));
            redirect(base_url(). 'admin/librarian', 'refresh');

        }

        if($param1 == 'delete'){
            $this->crud_model->delete_librarian($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data successfully deleted'));
            redirect(base_url(). 'admin/librarian', 'refresh');

        }

        $page_data['page_name']         = 'librarian';
        $page_data['page_title']        = get_phrase('Manage Librarian');
        $page_data['select_librarian']   = $this->db->get('librarian')->result_array();
        $this->load->view('backend/index', $page_data);
    }

  

    function accountant($param1 = null, $param2 = null, $param3 = null){
	$this->schoolFeaturesForAdmin();

        if ($param1 == 'insert'){

            $this->crud_model->insert_accountant();

            $this->session->set_flashdata('flash_message', get_phrase('Data successfully saved'));
            redirect(base_url(). 'admin/accountant', 'refresh');
        }


        if($param1 == 'update'){

            $this->crud_model->update_accountant($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data successfully updated'));
            redirect(base_url(). 'admin/accountant', 'refresh');

        }

        if($param1 == 'delete'){
            $this->crud_model->delete_accountant($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data successfully deleted'));
            redirect(base_url(). 'admin/accountant', 'refresh');

        }

        $page_data['page_name']         = 'accountant';
        $page_data['page_title']        = get_phrase('Manage Accountant');
        $page_data['select_accountant']   = $this->db->get('accountant')->result_array();
        $this->load->view('backend/index', $page_data);
    }




    function hostel($param1 = null, $param2 = null, $param3 = null){
	$this->schoolFeaturesForAdmin();

        if ($param1 == 'insert'){

            $this->crud_model->insert_hostel();

            $this->session->set_flashdata('flash_message', get_phrase('Data successfully saved'));
            redirect(base_url(). 'admin/hostel', 'refresh');
        }


        if($param1 == 'update'){

            $this->crud_model->update_hostel($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data successfully updated'));
            redirect(base_url(). 'admin/hostel', 'refresh');

        }

        if($param1 == 'delete'){
            $this->crud_model->delete_hostel($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data successfully deleted'));
            redirect(base_url(). 'admin/hostel', 'refresh');

        }

        $page_data['page_name']         = 'hostel';
        $page_data['page_title']        = get_phrase('Manage Hostel');
        $page_data['select_hostel']     = $this->db->get('hostel')->result_array();
        $this->load->view('backend/index', $page_data);
    }





    function hrm($param1 = null, $param2 = null, $param3 = null){
	$this->schoolFeaturesForAdmin();

        if ($param1 == 'insert'){

            $this->crud_model->insert_hrm();

            $this->session->set_flashdata('flash_message', get_phrase('Data successfully saved'));
            redirect(base_url(). 'admin/hrm', 'refresh');
        }


        if($param1 == 'update'){

            $this->crud_model->update_hrm($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data successfully updated'));
            redirect(base_url(). 'admin/hrm', 'refresh');

        }

        if($param1 == 'delete'){
            $this->crud_model->delete_hrm($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data successfully deleted'));
            redirect(base_url(). 'admin/hrm', 'refresh');

        }

        $page_data['page_name']         = 'hrm';
        $page_data['page_title']        = get_phrase('Manage HRM');
        $page_data['select_hrm']        = $this->db->get('hrm')->result_array();
        $this->load->view('backend/index', $page_data);
    }




    function alumni($param1 = null, $param2 = null, $param3 = null){
	$this->schoolFeaturesForAdmin();

        if ($param1 == 'insert'){

            $this->alumni_model->insert_alumni();

            $this->session->set_flashdata('flash_message', get_phrase('Data successfully saved'));
            redirect(base_url(). 'admin/alumni', 'refresh');
        }


        if($param1 == 'update'){

            $this->alumni_model->update_alumni($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data successfully updated'));
            redirect(base_url(). 'admin/alumni', 'refresh');

        }

        if($param1 == 'delete'){
        $this->alumni_model->delete_alumni($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data successfully deleted'));
        redirect(base_url(). 'admin/alumni', 'refresh');

        }

        $page_data['page_name']         = 'alumni';
        $page_data['page_title']        = get_phrase('Manage Alumni');
        $page_data['select_alumni']        = $this->db->get('alumni')->result_array();
        $this->load->view('backend/index', $page_data);
    }


    function teacher ($param1 = null, $param2 = null, $param3 = null){
	$this->schoolFeaturesForAdmin();

        if($param1 == 'insert'){
            $this->teacher_model->insetTeacherFunction();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/teacher', 'refresh');
        }

        if($param1 == 'update'){
            $this->teacher_model->updateTeacherFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/teacher', 'refresh');
        }


        if($param1 == 'delete'){
            $this->teacher_model->deleteTeacherFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/teacher', 'refresh');
    
        }
		
		
		
		if($param1 == 'bulk_upload'){
		

			$file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			
			if(isset($_FILES['excel_file']['name']) && in_array($_FILES['excel_file']['type'], $file_mimes)) {
				$arr_file = explode('.', $_FILES['excel_file']['name']);
				$extension = end($arr_file);
				
				if('csv' == $extension){
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
				}elseif('xls' == $extension){
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
				}else {
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
				}
				$spreadsheet = $reader->load($_FILES['excel_file']['tmp_name']);
				$sheetData = $spreadsheet->getActiveSheet()->toArray();
				
				if (!empty($sheetData)) {
				
					for ($i=1; $i<count($sheetData); $i++) {
					
						$data['name'] 			= $sheetData[$i][0];
						$data['role'] 			= $sheetData[$i][1];
						$data['sex'] 			= strtolower($sheetData[$i][2]);
						$data['qualification'] 	= $sheetData[$i][3];
						$data['joining_salary'] = $sheetData[$i][4];
						$data['marital_status'] = $sheetData[$i][5];
						$data['phone'] 			= $sheetData[$i][6];
						$data['email'] 			= $sheetData[$i][7];
						$data['password'] 		= sha1($sheetData[$i][8]);
						$data['address'] 		= $sheetData[$i][9];
						
						if($data['name'] != null && $data['role'] != null && $data['sex'] != null && $data['qualification'] != null && $data['joining_salary'] != null && $data['marital_status'] != null && $data['phone'] != null && $data['email'] != null && $data['password'] != null && $data['address']){
						
						$data['department_id'] 	= $this->input->post('department_id');
						$data['designation_id'] = $this->input->post('designation_id');
						
						//last inserted id
						$sql = "select * from teacher order by teacher_id desc limit 1";
						$return_query = $this->db->query($sql)->row()->teacher_id + 1;
						$data['teacher_id'] = $return_query;	
										
						$this->db->insert('teacher', $data);
						
						}else{
						
						redirect($_SERVER['HTTP_REFERER']);
						
						}
							
					}
					
				$this->session->set_flashdata('flash_message', get_phrase('parent uploaded successfully'));
				redirect($_SERVER['HTTP_REFERER']);
				
				}else{
					$this->session->set_flashdata('error_message', get_phrase('please select excel file'));
					redirect($_SERVER['HTTP_REFERER']);
				}
				
			}else{
				$this->session->set_flashdata('error_message', get_phrase('file not uploaded'));
				redirect($_SERVER['HTTP_REFERER']);
			}
		
			
				
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
	
	

    function get_designation($department_id = null){

        $designation = $this->db->get_where('designation', array('department_id' => $department_id))->result_array();
        foreach($designation as $key => $row)
        echo '<option value="'.$row['designation_id'].'">' . $row['name'] . '</option>';
    }

    /***********  The function manages vacancy   ***********************/
    function vacancy ($param1 = null, $param2 = null, $param3 = null){
	$this->schoolFeaturesForAdmin();

        if($param1 == 'insert'){
            $this->vacancy_model->insetVacancyFunction();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/vacancy', 'refresh');
        }

        if($param1 == 'update'){
            $this->vacancy_model->updateVacancyFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/vacancy', 'refresh');
        }


        if($param1 == 'delete'){
            $this->vacancy_model->deleteVacancyFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/vacancy', 'refresh');
    
        }

        $page_data['page_name']     = 'vacancy';
        $page_data['page_title']    = get_phrase('Manage Vacancy');
        $page_data['select_vacancy']  = $this->db->get('vacancy')->result_array();
        $this->load->view('backend/index', $page_data);

    }


    /***********  The function manages job applicant   ***********************/
    function application ($param1 = 'applied', $param2 = null, $param3 = null){
	$this->schoolFeaturesForAdmin();

        if($param1 == 'insert'){
            $this->application_model->insertApplicantFunction();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/application', 'refresh');
        }

        if($param1 == 'update'){
            $this->application_model->updateApplicantFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/application', 'refresh');
        }


        if($param1 == 'delete'){
            $this->application_model->deleteApplicantFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/application', 'refresh');
    
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
	$this->schoolFeaturesForAdmin();

        if($param1 == 'update'){
            $this->leave_model->updateLeaveFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/leave', 'refresh');
        }


        if($param1 == 'delete'){
            $this->leave_model->deleteLeaveFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/leave', 'refresh');
    
        }
        
        $page_data['page_name']     = 'leave';
        $page_data['page_title']    = get_phrase('Manage Leave');
        $this->load->view('backend/index', $page_data);

    }


    /***********  The function manages Awards  ***********************/
    function award ($param1 = null, $param2 = null, $param3 = null){
	$this->schoolFeaturesForAdmin();

        if($param1 == 'create'){
            $this->award_model->createAwardFunction();
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/award', 'refresh');
        }

        if($param1 == 'update'){
            $this->award_model->updateAwardFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/award', 'refresh');
        }


        if($param1 == 'delete'){
            $this->award_model->deleteAwardFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/award', 'refresh');
    
        }

        $page_data['page_name']     = 'award';
        $page_data['page_title']    = get_phrase('Manage Award');
        $this->load->view('backend/index', $page_data);

    }


	
		function get_country_state($country_id){
        $states = $this->db->get_where('states', array('country_id' => $country_id))->result_array();
            foreach($states as $key => $state){
                echo '<option value="'.$state['state_id'].'">'.$state['name'].'</option>';
            }
			
    }
	
	function get_state_city($state_id){
        $cities = $this->db->get_where('cities', array('state_id' => $state_id))->result_array();
            foreach($cities as $key => $city){
                echo '<option value="'.$city['city_id'].'">'.$city['name'].'</option>';
            }
    }

    /***********  The function manages Class Information  ***********************/
      function classes ($param1 = null, $param2 = null, $param3 = null){
	  $this->schoolFeaturesForAdmin();

        if($param1 == 'create'){
            $this->class_model->createClassFunction();
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/classes', 'refresh');
        }

        if($param1 == 'update'){
            $this->class_model->updateClassFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/classes', 'refresh');
        }


        if($param1 == 'delete'){
            $this->class_model->deleteClassFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/classes', 'refresh');
    
        }

        $page_data['page_name']     = 'class';
        $page_data['page_title']    = get_phrase('Manage Class');
        $this->load->view('backend/index', $page_data);

    }
	
	


    /***********  The function manages Section  ***********************/
    function section ($param1 = null, $param2 = null, $param3 = null){
	$this->schoolFeaturesForAdmin();

        if($param1 == 'create'){
        $this->section_model->createSectionFunction();
        $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
        redirect(base_url(). 'admin/section', 'refresh');
        }

        if($param1 == 'update'){
        $this->section_model->updateSectionFunction($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
        redirect(base_url(). 'admin/section', 'refresh');
        }

        if($param1 == 'delete'){
        $this->section_model->deleteSectionFunction($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
        redirect(base_url(). 'admin/section', 'refresh');
        }

        $page_data['page_name']     = 'section';
        $page_data['page_title']    = get_phrase('Manage Section');
        $this->load->view('backend/index', $page_data);
    }

        function sections ($class_id = null){

            if($class_id == '')
            $class_id = $this->db->get('class')->first_row()->class_id;
            
            $page_data['page_name']     = 'section';
            $page_data['class_id']      = $class_id;
            $page_data['page_title']    = get_phrase('Manage Section');
            $this->load->view('backend/index', $page_data);

        }
    

    /***********  The function manages school timetable  ***********************/
    function class_routine ($param1 = null, $param2 = null, $param3 = null){
	$this->schoolFeaturesForAdmin();

        if($param1 == 'create'){
        $this->class_routine_model->createTimetableFunction();
        $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
        redirect(base_url(). 'admin/listStudentTimetable', 'refresh');
        }

        if($param1 == 'update'){
        
        $this->class_routine_model->updateTimetableFunction($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
        redirect(base_url(). 'admin/listStudentTimetable', 'refresh');
        }

        if($param1 == 'delete'){
        
        $this->db->where('class_routine_id', $param2);
        $this->db->delete('class_routine');
        //$this->class_routine_model->deleteTimetableFunction($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
        redirect(base_url(). 'admin/listStudentTimetable', 'refresh');
        }
    }

    function listStudentTimetable(){

        $page_data['page_name']     = 'listStudentTimetable';
        $page_data['page_title']    = get_phrase('School Timetable');
        $this->load->view('backend/index', $page_data);
    }

    function class_routine_add(){

        $page_data['page_name']     = 'class_routine_add';
        $page_data['page_title']    = get_phrase('School Timetable');
        $this->load->view('backend/index', $page_data);
    }

    function get_class_section_subject($class_id){
        $page_data['class_id']  =   $class_id;
        $this->load->view('backend/admin/class_routine_section_subject_selector', $page_data);

    }

    function studentTimetableLoad($class_id){

        $page_data['class_id']  =   $class_id;
        $this->load->view('backend/admin/studentTimetableLoad', $page_data);

    }

    function class_routine_print_view($class_id, $section_id){

        $page_data['class_id']      =   $class_id;
        $page_data['section_id']    =   $section_id;
        $this->load->view('backend/admin/class_routine_print_view', $page_data);
    }


    function section_subject_edit($class_id, $class_routine_id){

    $page_data['class_id']          =   $class_id;
    $page_data['class_routine_id']  =   $class_routine_id;
    $this->load->view('backend/admin/class_routine_section_subject_edit', $page_data);

    }


    /***********  The function manages school dormitory  ***********************/
    function dormitory ($param1 = null, $param2 = null, $param3 = null){
	$this->schoolFeaturesForAdmin();

    if($param1 == 'create'){
        $this->dormitory_model->createDormitoryFunction();
        $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
        redirect(base_url(). 'admin/dormitory', 'refresh');
    }

    if($param1 == 'update'){
        $this->dormitory_model->updateDormitoryFunction($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
        redirect(base_url(). 'admin/dormitory', 'refresh');
    }


    if($param1 == 'delete'){
        $this->dormitory_model->deleteDormitoryFunction($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
        redirect(base_url(). 'admin/dormitory', 'refresh');

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
        redirect(base_url(). 'admin/hostel_room', 'refresh');
    }

    if($param1 == 'update'){
        $this->dormitory_model->updateHostelRoomFunction($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
        redirect(base_url(). 'admin/hostel_room', 'refresh');
    }


    if($param1 == 'delete'){
        $this->dormitory_model->deleteHostelRoomFunction($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
        redirect(base_url(). 'admin/hostel_room', 'refresh');

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
        redirect(base_url(). 'admin/hostel_category', 'refresh');
    }

    if($param1 == 'update'){
        $this->dormitory_model->updateHostelCategoryFunction($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
        redirect(base_url(). 'admin/hostel_category', 'refresh');
    }


    if($param1 == 'delete'){
        $this->dormitory_model->deleteHostelCategoryFunction($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
        redirect(base_url(). 'admin/hostel_category', 'refresh');

    }

    $page_data['page_name']     = 'hostel_category';
    $page_data['page_title']    = get_phrase('Hostel Category');
    $this->load->view('backend/index', $page_data);
    }



    /***********  The function manages academic syllabus ***********************/
    function academic_syllabus ($param1 = null, $param2 = null, $param3 = null){
	$this->schoolFeaturesForAdmin();

        if($param1 == 'create'){
        $this->academic_model->createAcademicSyllabus();
        $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
        redirect(base_url(). 'admin/academic_syllabus', 'refresh');
    }

    if($param1 == 'update'){
        $this->academic_model->updateAcademicSyllabus($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
        redirect(base_url(). 'admin/academic_syllabus', 'refresh');
    }


    if($param1 == 'delete'){
        $this->academic_model->deleteAcademicSyllabus($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
        redirect(base_url(). 'admin/academic_syllabus', 'refresh');

        }

        $page_data['page_name']     = 'academic_syllabus';
        $page_data['page_title']    = get_phrase('Academic Syllabus');
        $this->load->view('backend/index', $page_data);

    }

    function get_class_subject($class_id){
        $subjects = $this->db->get_where('subject', array('class_id' => $class_id))->result_array();
		$cass_name = $this->db->get_where('class', array('class_id' => $class_id))->row()->name;
			echo '<option value="">Select '.$cass_name.' Subjects</option>';
            foreach($subjects as $key => $subject)
            {
                echo '<option value="'.$subject['subject_id'].'">'.$subject['name'].'</option>';
            }
    }

    function get_class_section($class_id){
        $sections = $this->db->get_where('section', array('class_id' => $class_id))->result_array();
            foreach($sections as $key => $section)
            {
                echo '<option value="'.$section['section_id'].'">'.$section['name'].'</option>';
            }
    }


    function download_academic_syllabus($academic_syllabus_code){
        $get_file_name = $this->db->get_where('academic_syllabus', array('academic_syllabus_code' => $academic_syllabus_code))->row()->file_name;
        // Loading download from helper.
        $this->load->helper('download');
        $get_download_content = file_get_contents('uploads/syllabus/' . $get_file_name);
        $name = $file_name;
        force_download($name, $get_download_content);
    }

    function get_academic_syllabus ($class_id = null){

        if($class_id == '')
        $class_id = $this->db->get('class')->first_row()->class_id;
        
        $page_data['page_name']     = 'academic_syllabus';
        $page_data['class_id']      = $class_id;
        $page_data['page_title']    = get_phrase('Academic Syllabus');
        $this->load->view('backend/index', $page_data);

    }

    /***********  The function below add, update and delete student from students' table ***********************/
    function new_student ($param1 = null, $param2 = null, $param3 = null){
	$this->schoolFeaturesForAdmin();

        if($param1 == 'create'){
            $this->student_model->createNewStudent();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/student_information', 'refresh');
        }

        if($param1 == 'update'){
            $this->student_model->updateNewStudent($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/student_information', 'refresh');
        }
		
		
		if($param1 == 'import_student'){
		

			$file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			
			if(isset($_FILES['excel_file']['name']) && in_array($_FILES['excel_file']['type'], $file_mimes)) {
				$arr_file = explode('.', $_FILES['excel_file']['name']);
				$extension = end($arr_file);
				
				if('csv' == $extension){
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
				}elseif('xls' == $extension){
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
				}else {
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
				}
				$spreadsheet = $reader->load($_FILES['excel_file']['tmp_name']);
				$sheetData = $spreadsheet->getActiveSheet()->toArray();
				
				if (!empty($sheetData)) {
				
					for ($i=1; $i<count($sheetData); $i++) {
					
						$data['roll'] 			= $sheetData[$i][0];
						$data['name'] 			= $sheetData[$i][1];
						$data['sex'] 			= $sheetData[$i][2];
						$data['age'] 			= $sheetData[$i][3];
						$data['email'] 			= $sheetData[$i][4];
						$data['password'] 		= sha1($sheetData[$i][5]);
						$data['address'] 		= $sheetData[$i][6];
						
							if($data['roll'] != null && $data['name'] != null &&  $data['sex'] != null &&  $data['age'] != null &&  $data['email'] != null &&  $data['password'] != null &&  $data['address'] != null){
								$data['class_id']  =   $this->input->post('class_id');
								$data['section_id']=   $this->input->post('section_id');
									

									$sql = "select * from student order by student_id desc limit 1";
									$return_query = $this->db->query($sql)->row()->student_id + 1;
									$data['student_id'] = $return_query;	
										
									$this->db->insert('student',$data);
									$student_id = $this->db->insert_id();
			
									
							}else{
								
								redirect($_SERVER['HTTP_REFERER']);
								
							}	
							
						}
					
							
							$this->session->set_flashdata('flash_message', get_phrase('student uploaded successfully'));
							redirect(base_url() . 'admin/student_information/', 'refresh');
					
					}else{
					$this->session->set_flashdata('error_message', get_phrase('please select excel file'));
					redirect($_SERVER['HTTP_REFERER']);
				}
				
			}else{
				$this->session->set_flashdata('error_message', get_phrase('file not uploaded'));
				redirect($_SERVER['HTTP_REFERER']);
			}
				
		}
		
		
		if($param1 == 'multiple_student'){
		
			$names     = $this->input->post('name');
			$rolls     = $this->input->post('roll');
			$emails    = $this->input->post('email');
			$passwords = $this->input->post('password');
			$phones    = $this->input->post('phone');
			$addresses = $this->input->post('address');
			$genders   = $this->input->post('sex');
			$parent_id = $this->input->post('parent_id');
			$house_id  = $this->input->post('house_id');
			$club_id   = $this->input->post('club_id');
			$student_category_id   = $this->input->post('student_category_id');
	
			$student_entries = sizeof($names);
			for($i = 0; $i < $student_entries; $i++){
			$data['name']     	=   $names[$i];
			$data['roll']     	=   $rolls[$i];
			$data['email']    	=   $emails[$i];
			$data['password'] 	=   sha1($passwords[$i]);
			$data['phone']    	=   $phones[$i];
			$data['address']  	=   $addresses[$i];
			$data['sex']      	=   $genders[$i];
			$data['parent_id'] 	=   $parent_id[$i];
			$data['house_id'] 	=   $house_id[$i];
			$data['club_id'] 	=   $club_id[$i];
			$data['student_category_id'] =   $student_category_id[$i];
			
				//validate here, if the row(name, email, password) is empty or not
				if($data['name'] == '' || $data['email'] == '' || $data['password'] == '')
				continue;
					//validate here, if the Check email account
			
				$check_email = $this->db->get_where('student', array('email' => $data['email']))->row()->email;
				if($check_email != null) {
					$this->session->set_flashdata('error_message', get_phrase('email_already_exist'));
					redirect(base_url() . 'admin/new_student/', 'refresh');
				}
				else{
					$data['class_id'] 	= $this->input->post('class_id');
					$data['section_id'] = $this->input->post('section_id');
					$email 				= $this->input->post('email');
					$password 			= $this->input->post('password');
					$data['session']    = get_settings('session');
					
					$sql = "select * from student order by student_id desc limit 1";
					$return_query = $this->db->query($sql)->row()->student_id + 1;
					$data['student_id'] = $return_query;
		
					$this->db->insert('student' , $data);
				}
			}
		   	
			
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/student_information', 'refresh');
        }
		
		

        if($param1 == 'delete'){
            $this->student_model->deleteNewStudent($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/student_information', 'refresh');

        }

        $page_data['page_name']     = 'new_student';
        $page_data['page_title']    = get_phrase('Manage Student');
        $this->load->view('backend/index', $page_data);

    }


    function student_information(){

        $page_data['page_name']     = 'student_information';
        $page_data['page_title']    = get_phrase('List Student');
        $this->load->view('backend/index', $page_data);
    }


    /**************************  search student function with ajax starts here   ***********************************/
    function getStudentClasswise($class_id, $section_id){

        $page_data['class_id'] = $class_id;
		$page_data['section_id'] = $section_id;
        $this->load->view('backend/admin/showStudentClasswise', $page_data);
    }
    /**************************  search student function with ajax ends here   ***********************************/


    function edit_student($student_id){

        $page_data['student_id']      = $student_id;
        $page_data['page_name']     = 'edit_student';
        $page_data['page_title']    = get_phrase('Edit Student');
        $this->load->view('backend/index', $page_data);
    }


    function resetStudentPassword ($student_id) {
        $password['password']               =   sha1($this->input->post('new_password'));
        $confirm_password['confirm_new_password']   =   sha1($this->input->post('confirm_new_password'));
        if ($password['password'] == $confirm_password['confirm_new_password']) {
           $this->db->where('student_id', $student_id);
           $this->db->update('student', $password);
           $this->session->set_flashdata('flash_message', get_phrase('Password Changed'));
        }
        else{
            $this->session->set_flashdata('error_message', get_phrase('Type the same password'));
        }
        redirect(base_url() . 'admin/student_information', 'refresh');
    }

    function manage_attendance($date = null, $month= null, $year = null, $class_id = null, $section_id = null ){
	$this->schoolFeaturesForAdmin();
        $active_sms_gateway = $this->db->get_where('sms_settings', array('type' => 'active_sms_gateway'))->row()->info;
        
        if ($_POST) {
	
            // Loop all the students of $class_id
            $students = $this->db->get_where('student', array('class_id' => $class_id))->result_array();
            foreach ($students as $key => $student) {
            $attendance_status = $this->input->post('status_' . $student['student_id']);
			$attendance_session = $this->db->get_where('settings', array('type' => 'session'))->row()->description;
            $full_date = $year . "-" . $month . "-" . $date;
            $this->db->where('student_id', $student['student_id']);
            $this->db->where('date', $full_date);
    
            $this->db->update('attendance', array('status' => $attendance_status, 'session' => $attendance_session));
    
                   if ($attendance_status == 2) 
            {
                     if ($active_sms_gateway != '' || $active_sms_gateway != 'disabled') {
                        $student_name   = $this->db->get_where('student' , array('student_id' => $student['student_id']))->row()->name;
                        $parent_id      = $this->db->get_where('student' , array('student_id' => $student['student_id']))->row()->parent_id;
                        $message        = 'Your child' . ' ' . $student_name . 'is absent today.';
                        if($parent_id != null && $parent_id != 0){
                            $recieverPhoneNumber = $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->phone;
                            if($recieverPhoneNumber != '' || $recieverPhoneNumber != null){
                                $this->sms_model->send_sms($message, $recieverPhoneNumber);
                            }
                            else{
                                $this->session->set_flashdata('error_message' , get_phrase('Parent Phone Not Found'));
                            }
                        }
                        else{
                            $this->session->set_flashdata('error_message' , get_phrase('SMS Gateway Not Found'));
                        }
                    }
           }
        }
    
            $this->session->set_flashdata('flash_message', get_phrase('Updated Successfully'));
            redirect(base_url() . 'admin/manage_attendance/' . $date . '/' . $month . '/' . $year . '/' . $class_id . '/' . $section_id, 'refresh');
        }

        $page_data['date'] = $date;
        $page_data['month'] = $month;
        $page_data['year'] = $year;
        $page_data['class_id'] = $class_id;
        $page_data['section_id'] = $section_id;
        $page_data['page_name'] = 'manage_attendance';
        $page_data['page_title'] = get_phrase('Manage Attendance');
        $this->load->view('backend/index', $page_data);

    }

    function attendance_selector(){
        $date = $this->input->post('timestamp');
        $date = date_create($date);
        $date = date_format($date, "d/m/Y");
        redirect(base_url(). 'admin/manage_attendance/' .$date. '/' . $this->input->post('class_id'). '/' . $this->input->post('section_id'), 'refresh');
    }


    function attendance_report($class_id = NULL, $section_id = NULL, $month = NULL, $year = NULL) {
        
        $active_sms_gateway = $this->db->get_where('sms_settings', array('type' => 'active_sms_gateway'))->row()->info;
        
        
        if ($_POST) {
        redirect(base_url() . 'admin/attendance_report/' . $class_id . '/' . $section_id . '/' . $month . '/' . $year, 'refresh');
        }
        
        $classes = $this->db->get('class')->result_array();
        foreach ($classes as $key => $class) {
            if (isset($class_id) && $class_id == $class['class_id'])
                $class_name = $class['name'];
            }
                    
        $sections = $this->db->get('section')->result_array();
            foreach ($sections as $key => $section) {
                if (isset($section_id) && $section_id == $section['section_id'])
                    $section_name = $section['name'];
        }
        
        $page_data['month'] = $month;
        $page_data['year'] = $year;
        $page_data['class_id'] = $class_id;
        $page_data['section_id'] = $section_id;
        $page_data['page_name'] = 'attendance_report';
        $page_data['page_title'] = "Attendance Report:" . $class_name . " : Section " . $section_name;
        $this->load->view('backend/index', $page_data);
    }


    /******************** Load attendance with ajax code starts from here **********************/
	function loadAttendanceReport($class_id, $section_id, $month, $year){
        $page_data['class_id'] 		= $class_id;					// get all class_id
		$page_data['section_id'] 	= $section_id;					// get all section_id
		$page_data['month'] 		= $month;						// get all month
		$page_data['year'] 			= $year;						// get all class year
		
        $this->load->view('backend/admin/loadAttendanceReport' , $page_data);
    }
    /******************** Load attendance with ajax code ends from here **********************/
    

    /******************** print attendance report **********************/
	function printAttendanceReport($class_id=NULL, $section_id=NULL, $month=NULL, $year=NULL){
        $page_data['class_id'] 		= $class_id;					// get all class_id
		$page_data['section_id'] 	= $section_id;					// get all section_id
		$page_data['month'] 		= $month;						// get all month
		$page_data['year'] 			= $year;						// get all class year
		
        $page_data['page_name'] = 'printAttendanceReport';
        $page_data['page_title'] = "Attendance Report";
        $this->load->view('backend/index', $page_data);
    }
    /******************** /Ends here **********************/
    


     /***********  The function below add, update and delete exam question table ***********************/
    function examQuestion ($param1 = null, $param2 = null, $param3 = null){
	$this->schoolFeaturesForAdmin();

        if($param1 == 'create'){
            $this->exam_question_model->createexamQuestion();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/examQuestion', 'refresh');
        }

        if($param1 == 'update'){
            $this->exam_question_model->updateexamQuestion($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/examQuestion', 'refresh');
        }

        if($param1 == 'delete'){
            $this->exam_question_model->deleteexamQuestion($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/examQuestion', 'refresh');
        }

        $page_data['page_name']     = 'examQuestion';
        $page_data['page_title']    = get_phrase('Exam Question');
        $this->load->view('backend/index', $page_data);
    }
     /***********  The function below add, update and delete exam question table ends here ***********************/


    /***********  The function below add, update and delete examination table ***********************/
    function createExamination ($param1 = null, $param2 = null, $param3 = null){
	$this->schoolFeaturesForAdmin();

        if($param1 == 'create'){
            $this->exam_model->createExamination();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/createExamination', 'refresh');
        }

        if($param1 == 'update'){
            $this->exam_model->updateExamination($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/createExamination', 'refresh');
        }

        if($param1 == 'delete'){
            $this->exam_model->deleteExamination($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/createExamination', 'refresh');
        }

        $page_data['page_name']     = 'createExamination';
        $page_data['page_title']    = get_phrase('Create Exam');
        $this->load->view('backend/index', $page_data);
    }
    /***********  The function below add, update and delete examination table ends here ***********************/

    /***********  The function below add, update and delete student payment table ***********************/
    function student_payment ($param1 = null, $param2 = null, $param3 = null){
	$this->schoolFeaturesForAdmin();

        if($param1 == 'single_invoice'){
            $this->student_payment_model->createStudentSinglePaymentFunction();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/student_invoice', 'refresh');
        }

        if($param1 == 'mass_invoice'){
            $this->student_payment_model->createStudentMassPaymentFunction();
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/student_invoice', 'refresh');
        }

        if($param1 == 'update_invoice'){
            $this->student_payment_model->updateStudentPaymentFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/student_invoice', 'refresh');
        }

        if($param1 == 'take_payment'){
            $this->student_payment_model->takeNewPaymentFromStudent($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/student_invoice', 'refresh');
        }


        if($param1 == 'delete_invoice'){
            $this->student_payment_model->deleteStudentPaymentFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/student_invoice', 'refresh');
        }

        $page_data['page_name']     = 'student_payment';
        $page_data['page_title']    = get_phrase('Student Payment');
        $this->load->view('backend/index', $page_data);
    }   
    /***********  / Student payment ends here ***********************/
    
    function get_class_student($class_id){
        $students = $this->db->get_where('student', array('class_id' => $class_id))->result_array();
            foreach($students as $key => $student)
            {
                echo '<option value="'.$student['student_id'].'">'.$student['name'].'</option>';
            }
    }
	
	
    function get_single_title_amount_student_holder($class_id){
        $page_data['class_id'] = $class_id;
        $this->load->view('backend/admin/single_title_amount_student_holder', $page_data);    
    }
	
    function get_single_class_title_amount($id){
        $amounts = $this->db->get_where('fee_type', array('id' => $id))->result_array();
			foreach($amounts as $key => $amount)
            {
               echo '<div class="form-group">
                 	<label class="col-md-12" for="example-text">'.get_phrase("Payment Amount").'<b style="color:red">*</b></label>
                		<div class="col-sm-12">
                    		<input type="number" class="form-control" readonly="true" value='.$amount['amount'].' name="amount" / required>
                		</div>
            		</div>';
					
               echo '<div class="form-group">
                 	<label class="col-md-12" for="example-text">'.get_phrase("Amount Paid").'<b style="color:red">*</b></label>
                		<div class="col-sm-12">
                    		<input type="number" class="form-control" min="0" max="'.$amount['amount'].'" value="" name="amount_paid">
                		</div>
            		</div>';
					
					echo '<input type="hidden" class="form-control"  value="'.$amount['title'].'" name="title">';
					
            }
    }
	
	
	
	
    function get_mass_title_amount_student_holder($class_id){
        $page_data['class_id'] = $class_id;
        $this->load->view('backend/admin/mass_title_amount_student_holder', $page_data);    
    }
	
    function get_mass_class_title_amount($id){
        $amounts = $this->db->get_where('fee_type', array('id' => $id))->result_array();
			foreach($amounts as $key => $amount)
            {
               echo '<div class="form-group">
                 	<label class="col-md-12" for="example-text">'.get_phrase("Payment Amount").'<b style="color:red">*</b></label>
                		<div class="col-sm-12">
                    		<input type="number" class="form-control" readonly="true" value='.$amount['amount'].' name="amount" / required>
                		</div>
            		</div>';
					
               echo '<div class="form-group">
                 	<label class="col-md-12" for="example-text">'.get_phrase("Amount Paid").'<b style="color:red">*</b></label>
                		<div class="col-sm-12">
                    		<input type="number" class="form-control" min="0" max="'.$amount['amount'].'" value="" name="amount_paid">
                		</div>
            		</div>';
					
					echo '<input type="hidden" class="form-control"  value="'.$amount['title'].'" name="title">';
            }
    }


    function get_class_mass_student($class_id){

        $students = $this->db->get_where('student', array('class_id' => $class_id))->result_array();
        foreach($students as $key => $student)
        {
            echo '<div class="">
            <label><input type="checkbox" class="check" name="student_id[]" value="' . $student['student_id'] . '">' . '&nbsp;'. $student['name'] .'</label></div>';
        }

        echo '<button type ="button" class="btn btn-success btn-sm mr-2" onClick="select()">'.get_phrase('Select All').'</button>';
        echo '<button type ="button" class="btn btn-primary btn-sm" onClick="unselect()">'.get_phrase('Unselect All').'</button><hr>';
    }

    function student_invoice(){

        $page_data['page_name']     = 'student_invoice';
        $page_data['page_title']    = get_phrase('Manage Invoice');
        $this->load->view('backend/index', $page_data);

    }

    /***********  The function below add, update and delete publisher table ***********************/
    function publisher ($param1 = null, $param2 = null, $param3 = null){
	$this->schoolFeaturesForAdmin();

        if($param1 == 'create'){
            $this->library_model->createPublisherFunction();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/publisher', 'refresh');
        }

        if($param1 == 'update'){
            $this->library_model->updatePublisherFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/publisher', 'refresh');
        }

        if($param1 == 'delete'){
            $this->library_model->deletePublisherFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/publisher', 'refresh');
        }

        $page_data['page_name']     = 'publisher';
        $page_data['page_title']    = get_phrase('Manage Publisher');
        $this->load->view('backend/index', $page_data);
    }
    /***********  The function below add, update and delete publisher table ends here ***********************/


    /***********  The function below add, update and delete publisher table ***********************/
    function author ($param1 = null, $param2 = null, $param3 = null){
	$this->schoolFeaturesForAdmin();

        if($param1 == 'create'){
            $this->library_model->createAuthorFunction();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/author', 'refresh');
        }

        if($param1 == 'update'){
            $this->library_model->updateAuthorFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/author', 'refresh');
        }

        if($param1 == 'delete'){
            $this->library_model->deleteAuthorFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/author', 'refresh');
        }

        $page_data['page_name']     = 'author';
        $page_data['page_title']    = get_phrase('Manage Author');
        $this->load->view('backend/index', $page_data);
    }

    /***********  The function below add, update and delete publisher table ends here ***********************/

    /***********  The function below add, update and delete BookCategory table ***********************/
    function book_category ($param1 = null, $param2 = null, $param3 = null){
	$this->schoolFeaturesForAdmin();

        if($param1 == 'create'){
            $this->library_model->createBookCategoryFunction();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/book_category', 'refresh');
        }

        if($param1 == 'update'){
            $this->library_model->updateBookCategoryFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/book_category', 'refresh');
        }

        if($param1 == 'delete'){
            $this->library_model->deleteBookCategoryFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/book_category', 'refresh');
        }

        $page_data['page_name']     = 'book_category';
        $page_data['page_title']    = get_phrase('Book Category');
        $this->load->view('backend/index', $page_data);
    }
    /***********  The function below add, update and delete BookCategory table ends here ***********************/



    /***********  The function below add, update and delete book table ***********************/
    function book ($param1 = null, $param2 = null, $param3 = null){
	$this->schoolFeaturesForAdmin();

        if($param1 == 'create'){
            $this->library_model->createBookFunction();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/book', 'refresh');
        }

        if($param1 == 'update'){
            $this->library_model->updateBookFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/book', 'refresh');
        }

        if($param1 == 'delete'){
            $this->library_model->deleteBookFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/book', 'refresh');
        }

        $page_data['page_name']     = 'book';
        $page_data['page_title']    = get_phrase('Manage Library');
        $this->load->view('backend/index', $page_data);
    }
    /***********  The function below add, update and delete book table ends here ***********************/

    /***********  The function below manages school event ***********************/
    function noticeboard ($param1 = null, $param2 = null, $param3 = null){
	$this->schoolFeaturesForAdmin();

        if($param1 == 'create'){
            $this->event_model->createNoticeboardFunction();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/noticeboard', 'refresh');
        }

        if($param1 == 'update'){
            $this->event_model->updateNoticeboardFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/noticeboard', 'refresh');
        }

        if($param1 == 'delete'){
            $this->event_model->deleteNoticeboardFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/noticeboard', 'refresh');
        }

        $page_data['page_name']     = 'noticeboard';
        $page_data['page_title']    = get_phrase('School Event');
        $this->load->view('backend/index', $page_data);
    }
    /***********  The function that manages school events ends here ***********************/

     /***********  The function below manages school language ***********************/
     function manage_language ($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'edit_phrase'){
            $page_data['edit_profile']  =   $param2;
        }

        if($param1 == 'add_language'){
            $this->language_model->createNewLanguage();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/manage_language', 'refresh');
        }

        if($param1 == 'add_phrase'){
            $this->language_model->createNewLanguagePhrase();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/manage_language', 'refresh');
        }

        if($param1 == 'delete_language'){
            $this->language_model->deleteLanguage($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/manage_language', 'refresh');
        }

        $page_data['page_name']     = 'manage_language';
        $page_data['page_title']    = get_phrase('Manage Language');
        $this->load->view('backend/index', $page_data);
    }
    /***********  The function that manages school language ends here ***********************/

    function updatePhraseWithAjax(){

        $checker['phrase_id']   =   $this->input->post('phraseId');
        $updater[$this->input->post('currentEditingLanguage')]  =   $this->input->post('updatedValue');

        $this->db->where('phrase_id', $checker['phrase_id'] );
        $this->db->update('language', $updater);

        echo $checker['phrase_id']. ' '. $this->input->post('currentEditingLanguage'). ' '. $this->input->post('updatedValue');

    }

	
    
	    /***********  The function below manages school marks ***********************/
    function marks ($exam_id = null, $class_id = null, $student_id = null){
	$this->schoolFeaturesForAdmin();
		if ($this->session->userdata('admin_login') != 1) redirect(base_url() . 'login', 'refresh');

            if($this->input->post('operation') == 'selection'){

                $page_data['exam_id']       =  $this->input->post('exam_id'); 
                $page_data['class_id']      =  $this->input->post('class_id');
                $page_data['student_id']    =  $this->input->post('student_id');

                if($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 && $page_data['student_id'] > 0){

                    redirect(base_url(). 'admin/marks/'. $page_data['exam_id'] .'/' . $page_data['class_id'] . '/' . $page_data['student_id'], 'refresh');
                }
                else{
                    $this->session->set_flashdata('error_message', get_phrase('Pleasen select something'));
                    redirect(base_url(). 'admin/marks', 'refresh');
                }
            }

            
			if($this->input->post('operation') == 'update_student_subject_score'){
			
				$session      			=   get_settings('session');
				$term       			=   get_settings('term');
				
				$select_subject_first = $this->db->get_where('subject', array('class_id' => $class_id ))->result_array();
					
					if(get_settings('report_template') == 1 || get_settings('report_template') == 'tanzania' || get_settings('report_template') == 2) { 

                	
						foreach ($select_subject_first as $key => $dispay_subject_from_subject_table){
						
							$page_data['class_score1']  =   $this->input->post('class_score1_' . $dispay_subject_from_subject_table['subject_id']);
							//$page_data['class_score2']  =   $this->input->post('class_score2_' . $dispay_subject_from_subject_table['subject_id']);
							//$page_data['class_score3']  =   $this->input->post('class_score3_' . $dispay_subject_from_subject_table['subject_id']);
							$page_data['exam_score']    =   $this->input->post('exam_score_' . $dispay_subject_from_subject_table['subject_id']);
							$page_data['comment']       =   $this->input->post('comment_' . $dispay_subject_from_subject_table['subject_id']);
							$page_data['session']       =   $this->db->get_where('exam', array('exam_id' => $exam_id))->row()->session;
							$page_data['term']       	=   $this->db->get_where('exam', array('exam_id' => $exam_id))->row()->term;
	
							$this->db->where('mark_id', $this->input->post('mark_id_' . $dispay_subject_from_subject_table['subject_id']));
							$this->db->update('mark', $page_data);  
							
						}
					}
					
					
					if(get_settings('report_template') == 'udemy') { 

                	
						foreach ($select_subject_first as $key => $dispay_subject_from_subject_table){
						
							$page_data['class_score1']  =   $this->input->post('class_score1_' . $dispay_subject_from_subject_table['subject_id']);
							$page_data['class_score2']  =   $this->input->post('class_score2_' . $dispay_subject_from_subject_table['subject_id']);
							
							$page_data['exam_score']    =   $this->input->post('exam_score_' . $dispay_subject_from_subject_table['subject_id']);
							$page_data['comment']       =   $this->input->post('comment_' . $dispay_subject_from_subject_table['subject_id']);
							$page_data['session']       =   $session;
							$page_data['term']       	=   $term;
							
							if($term == 1){
								$page_data['sum_first']	=   $page_data['class_score1'] + $page_data['class_score2'] + $page_data['exam_score'];
							}elseif($term == 2){
								$page_data['sum_second']=   $page_data['class_score1'] + $page_data['class_score2'] + $page_data['exam_score'];
							}else{
								$page_data['sum_third']	=   $page_data['class_score1'] + $page_data['class_score2'] + $page_data['exam_score'];
							}
							
							$this->db->where('mark_id', $this->input->post('mark_id_' . $dispay_subject_from_subject_table['subject_id']));
							$this->db->update('mark', $page_data);  
							
						}
					}
					
					
					if(get_settings('report_template') == 'gate') { 

                	
						foreach ($select_subject_first as $key => $dispay_subject_from_subject_table){
						
							$page_data['class_score1']  =   $this->input->post('class_score1_' . $dispay_subject_from_subject_table['subject_id']);
							$page_data['class_score2']  =   $this->input->post('class_score2_' . $dispay_subject_from_subject_table['subject_id']);
							$page_data['class_score3']  =   $this->input->post('class_score3_' . $dispay_subject_from_subject_table['subject_id']);
							$page_data['exam_score']    =   $this->input->post('exam_score_' . $dispay_subject_from_subject_table['subject_id']);
							$page_data['comment']       =   $this->input->post('comment_' . $dispay_subject_from_subject_table['subject_id']);
							$page_data['session']       =   $session;
							$page_data['term']       	=   $term;
							
							
							if($term == 1){
								$page_data['sum_first']	=   $page_data['class_score1'] + $page_data['class_score2'] + $page_data['class_score3'] + $page_data['exam_score'];
							}elseif($term == 2){
								$page_data['sum_second']=   $page_data['class_score1'] + $page_data['class_score2'] + $page_data['class_score3'] + $page_data['exam_score'];
							}else{
							
								$page_data['sum_third']	=   $page_data['class_score1'] + $page_data['class_score2'] + $page_data['class_score3'] + $page_data['exam_score'];
							}
							
	
							$this->db->where('mark_id', $this->input->post('mark_id_' . $dispay_subject_from_subject_table['subject_id']));
							$this->db->update('mark', $page_data);  
							
						}
					}
					
					
					
					if(get_settings('report_template') == 'diamond') { 

                	
						foreach ($select_subject_first as $key => $dispay_subject_from_subject_table){
						
							$page_data['class_score1']  =   $this->input->post('class_score1_' . $dispay_subject_from_subject_table['subject_id']);
							$page_data['class_score2']  =   $this->input->post('class_score2_' . $dispay_subject_from_subject_table['subject_id']);
							$page_data['class_score3']  =   $this->input->post('class_score3_' . $dispay_subject_from_subject_table['subject_id']);
							$page_data['class_score4']  =   $this->input->post('class_score4_' . $dispay_subject_from_subject_table['subject_id']);
							$page_data['class_score5']  =   $this->input->post('class_score5_' . $dispay_subject_from_subject_table['subject_id']);
							$page_data['ca1_comment']  	=   $this->input->post('ca1_comment_' . $dispay_subject_from_subject_table['subject_id']);
							
							$page_data['class_score11']  =   $this->input->post('class_score11_' . $dispay_subject_from_subject_table['subject_id']);
							$page_data['class_score22']  =   $this->input->post('class_score22_' . $dispay_subject_from_subject_table['subject_id']);
							$page_data['class_score33']  =   $this->input->post('class_score33_' . $dispay_subject_from_subject_table['subject_id']);
							$page_data['class_score44']  =   $this->input->post('class_score44_' . $dispay_subject_from_subject_table['subject_id']);
							$page_data['class_score55']  =   $this->input->post('class_score55_' . $dispay_subject_from_subject_table['subject_id']);
							$page_data['ca2_comment']  =   $this->input->post('ca2_comment_' . $dispay_subject_from_subject_table['subject_id']);
							
							$page_data['exam_score']    =   $this->input->post('exam_score_' . $dispay_subject_from_subject_table['subject_id']);
							$page_data['comment']       =   $this->input->post('comment_' . $dispay_subject_from_subject_table['subject_id']);
							$page_data['session']       =   $this->db->get_where('exam', array('exam_id' => $exam_id))->row()->session;
							$page_data['term']       	=   $this->db->get_where('exam', array('exam_id' => $exam_id))->row()->term;
	
							$this->db->where('mark_id', $this->input->post('mark_id_' . $dispay_subject_from_subject_table['subject_id']));
							$this->db->update('mark', $page_data);  
							
						}
					}
					
				
				
                    $this->session->set_flashdata('flash_message', get_phrase('data_dpdated_successfully'));
                    redirect(base_url(). 'admin/marks/'. $this->input->post('exam_id') .'/' . $this->input->post('class_id') . '/' . $this->input->post('student_id'), 'refresh');
            }
			
			
			

        $page_data['exam_id']       =   $exam_id;
        $page_data['class_id']      =   $class_id;
        $page_data['student_id']    =   $student_id;
        $page_data['subject_id']   	=   $subject_id;
        $page_data['page_name']     =   'marks';
        $page_data['page_title']    = 	get_phrase('student_marks');
        $this->load->view('backend/index', $page_data);
    }



    /***********  The function below manages school marks ***********************/
     function student_marksheet_subject ($exam_id = null, $class_id = null, $subject_id = null){
	 $this->schoolFeaturesForAdmin();

        if($this->input->post('operation') == 'selection'){

            $page_data['exam_id']       =  $this->input->post('exam_id'); 
            $page_data['class_id']      =  $this->input->post('class_id');
            $page_data['subject_id']    =  $this->input->post('subject_id');

            if($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 && $page_data['subject_id'] > 0){

                redirect(base_url(). 'admin/student_marksheet_subject/'. $page_data['exam_id'] .'/' . $page_data['class_id'] . '/' . $page_data['subject_id'], 'refresh');
            }
            else{
                $this->session->set_flashdata('error_message', get_phrase('Pleasen select something'));
                redirect(base_url(). 'admin/student_marksheet_subject', 'refresh');
            }
        }

        if($this->input->post('operation') == 'update_student_subject_score'){
		
				$session      			=   get_settings('session');
				$term       			=   get_settings('term');
		
			$select_student_first = $this->db->get_where('student', array('class_id' => $class_id ))->result_array();
			
		
				if(get_settings('report_template') == 1 || get_settings('report_template') == 'tanzania' || get_settings('report_template') == 2) { 

            
					foreach ($select_student_first as $key => $dispay_student_from_student_table){
	
						$page_data['class_score1']  =   $this->input->post('class_score1_' . $dispay_student_from_student_table['student_id']);
						//$page_data['class_score2']  =   $this->input->post('class_score2_' . $dispay_student_from_student_table['student_id']);
						//$page_data['class_score3']  =   $this->input->post('class_score3_' . $dispay_student_from_student_table['student_id']);
						$page_data['exam_score']    =   $this->input->post('exam_score_' . $dispay_student_from_student_table['student_id']);
						$page_data['comment']       =   $this->input->post('comment_' . $dispay_student_from_student_table['student_id']);
						$page_data['session']       =   $this->db->get_where('exam', array('exam_id' => $exam_id))->row()->session;
						$page_data['term']       	=   $this->db->get_where('exam', array('exam_id' => $exam_id))->row()->term;
	
						$this->db->where('mark_id', $this->input->post('mark_id_' . $dispay_student_from_student_table['student_id']));
						$this->db->update('mark', $page_data);  
					}
				}
				
				
				if(get_settings('report_template') == 'udemy') { 

					foreach ($select_student_first as $key => $dispay_student_from_student_table){
	
						$page_data['class_score1']  =   $this->input->post('class_score1_' . $dispay_student_from_student_table['student_id']);
						$page_data['class_score2']  =   $this->input->post('class_score2_' . $dispay_student_from_student_table['student_id']);
						$page_data['exam_score']    =   $this->input->post('exam_score_' . $dispay_student_from_student_table['student_id']);
						$page_data['comment']       =   $this->input->post('comment_' . $dispay_student_from_student_table['student_id']);
						$page_data['session']       =   $session;
						$page_data['term']       	=   $term;


							if($term == 1){
								$page_data['sum_first']	=   $page_data['class_score1'] + $page_data['class_score2'] + $page_data['exam_score'];
							}elseif($term == 2){
								$page_data['sum_second']=   $page_data['class_score1'] + $page_data['class_score2'] + $page_data['exam_score'];
							}else{
								$page_data['sum_third']	=   $page_data['class_score1'] + $page_data['class_score2'] + $page_data['exam_score'];
							}
	
						$this->db->where('mark_id', $this->input->post('mark_id_' . $dispay_student_from_student_table['student_id']));
						$this->db->update('mark', $page_data);  
					}
				}
				
				
				if(get_settings('report_template') == 'gate') { 

					foreach ($select_student_first as $key => $dispay_student_from_student_table){
	
						$page_data['class_score1']  =   $this->input->post('class_score1_' . $dispay_student_from_student_table['student_id']);
						$page_data['class_score2']  =   $this->input->post('class_score2_' . $dispay_student_from_student_table['student_id']);
						$page_data['class_score3']  =   $this->input->post('class_score3_' . $dispay_student_from_student_table['student_id']);
						$page_data['exam_score']    =   $this->input->post('exam_score_' . $dispay_student_from_student_table['student_id']);
						$page_data['comment']       =   $this->input->post('comment_' . $dispay_student_from_student_table['student_id']);
						$page_data['session']       =   $session;
						$page_data['term']       	=   $term;
						
							if($term == 1){
								$page_data['sum_first']	=   $page_data['class_score1'] + $page_data['class_score2'] + $page_data['class_score3'] + $page_data['exam_score'];
							}elseif($term == 2){
								$page_data['sum_second']=   $page_data['class_score1'] + $page_data['class_score2'] + $page_data['class_score3'] + $page_data['exam_score'];
							}else{
							
								$page_data['sum_third']	=   $page_data['class_score1'] + $page_data['class_score2'] + $page_data['class_score3'] + $page_data['exam_score'];
							}
						
	
						$this->db->where('mark_id', $this->input->post('mark_id_' . $dispay_student_from_student_table['student_id']));
						$this->db->update('mark', $page_data);  
					}
				}
				
				
				if(get_settings('report_template') == 'diamond') { 

					foreach ($select_student_first as $key => $dispay_student_from_student_table){
					
	
						$page_data['class_score1']  =   $this->input->post('class_score1_' . $dispay_student_from_student_table['student_id']);
						$page_data['class_score2']  =   $this->input->post('class_score2_' . $dispay_student_from_student_table['student_id']);
						$page_data['class_score3']  =   $this->input->post('class_score3_' . $dispay_student_from_student_table['student_id']);
						$page_data['class_score4']  =   $this->input->post('class_score4_' . $dispay_student_from_student_table['student_id']);
						$page_data['class_score5']  =   $this->input->post('class_score5_' . $dispay_student_from_student_table['student_id']);
						$page_data['ca1_comment']  	=   $this->input->post('ca1_comment_' . $dispay_student_from_student_table['student_id']);
						
						$page_data['class_score11']  =   $this->input->post('class_score11_' . $dispay_student_from_student_table['student_id']);
						$page_data['class_score22']  =   $this->input->post('class_score22_' . $dispay_student_from_student_table['student_id']);
						$page_data['class_score33']  =   $this->input->post('class_score33_' . $dispay_student_from_student_table['student_id']);
						$page_data['class_score44']  =   $this->input->post('class_score44_' . $dispay_student_from_student_table['student_id']);
						$page_data['class_score55']  =   $this->input->post('class_score55_' . $dispay_student_from_student_table['student_id']);
						$page_data['ca2_comment']  	 =   $this->input->post('ca2_comment_' . $dispay_student_from_student_table['student_id']);
						
						
						$page_data['exam_score']    =   $this->input->post('exam_score_' . $dispay_student_from_student_table['student_id']);
						$page_data['comment']       =   $this->input->post('comment_' . $dispay_student_from_student_table['student_id']);
						$page_data['session']       =   $this->db->get_where('exam', array('exam_id' => $exam_id))->row()->session;
						$page_data['term']       	=   $this->db->get_where('exam', array('exam_id' => $exam_id))->row()->term;
	
						$this->db->where('mark_id', $this->input->post('mark_id_' . $dispay_student_from_student_table['student_id']));
						$this->db->update('mark', $page_data);  
					}
				}
				
				

  				$this->session->set_flashdata('flash_message', get_phrase('data_dpdated_successfully'));
				redirect(base_url(). 'admin/student_marksheet_subject/'. $this->input->post('exam_id') .'/' . 
				$this->input->post('class_id') . '/' . $this->input->post('subject_id'), 'refresh');
        }
		
		if($this->input->post('operation') == 'download'){
		$cass_name 		= $this->db->get_where('class', array('class_id' => $this->input->post('class_id')))->row()->name;
		$subject 	= $this->db->get_where('subject', array('subject_id' => $this->input->post('subject_id')));
		
			$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();
		
			// add style to the header
			$styleArray = array(
			  'font' => array(
				'bold' => true,
			  ),
			  'alignment' => array(
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
				'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
			  ),
			  'borders' => array(
				  'bottom' => array(
					  'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
					  'color' => array('rgb' => '333333'),
				  ),
			  ),
			  'fill' => array(
				'type'       => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
				'rotation'   => 90,
				'startcolor' => array('rgb' => '0d0d0d'),
				'endColor'   => array('rgb' => 'f2f2f2'),
			  ),
			);
			
    		$spreadsheet->getActiveSheet()->getStyle('A1:C1')->applyFromArray($styleArray);
    		// auto fit column to content
			foreach(range('A', 'C') as $columnID) {
			  $spreadsheet->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
			}
			
			$fileName = $subject->row()->subject_id.'_'.$cass_name.'_'.$subject->row()->name.'_'.date('d M Y'); 

			$sheet->setCellValue('A1', 'Student Name');
			$sheet->setCellValue('B1', 'CA Score');
			$sheet->setCellValue('C1', 'Exam Score');
			  
        	$rows = 2;
				$query = $this->db->get_where('student', array('class_id' => $this->input->post('class_id')))->result_array();
				foreach ($query as $row){
					$sheet->setCellValue('A' . $rows, $row['student_id'].'-'.$row['name']);
					$sheet->setCellValue('B' . $rows, 0);
					$sheet->setCellValue('C' . $rows, 0);
					
					$rows++;
				} 
				$writer = new Xlsx($spreadsheet);
				header("Pragma: public");
				header("Expires: 0");
				header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
				header("Content-Type: application/force-download");
				header("Content-Type: application/octet-stream");
				header("Content-Type: application/download");				
				header('Content-Type: application/vnd.ms-excel');
				header('Content-Disposition: attachment;filename="'. $fileName .'.xlsx"');  
				header('Cache-Control: max-age=0');
				$writer->save('php://output');
				die();
		
            /*$objPHPExcel = new PHPExcel();
            $objPHPExcel->setActiveSheetIndex(0);
            $objPHPExcel->getActiveSheet()->setCellValue('A1', get_phrase('student'));
            $objPHPExcel->getActiveSheet()->setCellValue('B1', get_phrase('CA_score'));
            $objPHPExcel->getActiveSheet()->setCellValue('C1', get_phrase('exam_score'));

           	$a = 2; $b =2; $c =2;
			
			$term = get_settings('term');
			$session = get_settings('session');
            $query = $this->db->get_where('student', array('class_id' => $this->input->post('class_id')))->result_array();
			
            foreach($query as $row){
				$flag = $this->db->get_where('student', array('student_id' => $row['student_id']));
                $objPHPExcel->getActiveSheet()->setCellValue('A'.$a++, $flag->row()->student_id.'-'.$flag->row()->name);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$b++, 0);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$c++, 0);
				
            }
            $objPHPExcel->getActiveSheet()->setTitle('Student Exam Mark Sheet');
			
            header("Pragma: public");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Content-Type: application/force-download");
            header("Content-Type: application/octet-stream");
            header("Content-Type: application/download");
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="export_students_'.date('d-m-y:h:i:s').'.xlsx"');
            header("Content-Transfer-Encoding: binary ");
            $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
            $objWriter->setOffice2003Compatibility(true);
            $objWriter->save('php://output');
			*/
			
		}
		
		
		if($this->input->post('operation') == 'upload'){
		
					$exam_id       =  $this->input->post('exam_id'); 
					$class_id      =  $this->input->post('class_id');
					$subject_id    =  $this->input->post('subject_id');
					
					
			$select_student_with_class_id  =   $this->crud_model->get_students($class_id);
			$select_sunject_with_class_id  =   $this->crud_model->get_subjects_by_class($class_id);
            foreach ($select_sunject_with_class_id as $key => $class_subject_exam_student):
			foreach ($select_student_with_class_id as $key => $student_selected_with_class):			

                $verify_data = array('exam_id' => $exam_id, 'class_id' => $class_id, 'subject_id' => $class_subject_exam_student['subject_id'], 'student_id' => $student_selected_with_class['student_id']);
                $query = $this->db->get_where('mark', $verify_data);
				
				$sql = "select * from mark order by mark_id desc limit 1";
				$return_query = $this->db->query($sql)->row()->mark_id + 1;
				$verify_data['mark_id'] = $return_query;
				$verify_data['term'] 	= get_settings('term');
				$verify_data['session']	= get_settings('session');

                if($query->num_rows() < 1)
                    $this->db->insert('mark', $verify_data);
            endforeach;endforeach;
			
		
			$path = $_FILES["score_bulk_upload"]["tmp_name"];
			$path2 = $_FILES["score_bulk_upload"]["name"];
			$xplode = explode('-', $path2);
			
			$sub_id = substr($xplode,0,1);//$xplode[0];
			$cl_name = $xplode[1];
			$sub_name = $xplode[2];
			$date_name = $xplode[3];
			
            $object = PHPExcel_IOFactory::load($path);
            foreach($object->getWorksheetIterator() as $worksheet){
               $highestRow = $worksheet->getHighestRow();
               $highestColumn = $worksheet->getHighestColumn();
               for($row=2; $row <= $highestRow; $row++){  
			   		$studentFlag =  explode('-', $worksheet->getCellByColumnAndRow(0, $row)->getValue());  
					$name = $studentFlag[1];
					$student_id = $studentFlag[0];                   
                    
					$student_id_from_excel	    =  $student_id;
					$data['class_score1']    	=  $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					$data['exam_score']    		=  $worksheet->getCellByColumnAndRow(2, $row)->getValue();
					
					if($subject_id != $sub_id){
						$this->session->set_flashdata('error_message', get_phrase('please_ensure_you_select_the_right_subject'.$sub_id));
						redirect(base_url(). 'admin/student_marksheet_subject', 'refresh');
					}
                    
					$select_student_first = $this->db->get_where('student', array('class_id' => $this->input->post('class_id') ))->result_array();
		
					foreach ($select_student_first as $key => $dispay_student_from_student_table){
					
						$data['session']       =   $this->db->get_where('exam', array('exam_id' => $exam_id))->row()->session;
						$data['term']          =   $this->db->get_where('exam', array('exam_id' => $exam_id))->row()->term;
					
						$this->db->where('subject_id', $subject_id);
						$this->db->where('exam_id', $exam_id);
						$this->db->where('student_id', $student_id_from_excel);
						$this->db->where('class_id', $class_id);
						$this->db->where('session', $data['session']);
						$this->db->where('term', $data['term']);
						
						$this->db->update('mark', $data);  
                   }
               }
               
            }

  				$this->session->set_flashdata('flash_message', get_phrase('data_dpdated_successfully'));
				redirect(base_url(). 'admin/student_marksheet_subject/'. $this->input->post('exam_id') .'/' . 
				$this->input->post('class_id') . '/' . $this->input->post('subject_id'), 'refresh');
		
		}
		
		

		$page_data['exam_id']       =   $exam_id;
		$page_data['class_id']      =   $class_id;
		$page_data['student_id']    =   $student_id;
		$page_data['subject_id']   	=    $subject_id;
		$page_data['page_name']     =   'student_marksheet_subject';
		$page_data['page_title']    = 	get_phrase('student_marks');
		$this->load->view('backend/index', $page_data);
    }



    /***********  The function below manages school event ***********************/
    function exam_marks_sms ($param1 = null, $param2 = null, $param3 = null){
	$this->schoolFeaturesForAdmin();

        if($param1 == 'send'){
            $this->crud_model->send_student_score_model();
            $this->session->set_flashdata('flash_message', get_phrase('Data Sent successfully'));
            redirect(base_url(). 'admin/exam_marks_sms', 'refresh');
        }

        $page_data['page_name']     = 'exam_marks_sms';
        $page_data['page_title']    = get_phrase('Send Student Scores');
        $this->load->view('backend/index', $page_data);
    }
    /***********  The function that manages school events ends here ***********************/

    
    /***********  The function below manages new admin ***********************/
    function newAdministrator ($param1 = null, $param2 = null, $param3 = null){
	$this->schoolFeaturesForAdmin();

        if($param1 == 'create'){
            $this->admin_model->createNewAdministrator();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/newAdministrator', 'refresh');
        }

        if($param1 == 'update'){
            $this->admin_model->updateAdministrator($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/newAdministrator', 'refresh');
        }

        if($param1 == 'delete'){
            $this->admin_model->deleteAdministrator($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/newAdministrator', 'refresh');
        }

        $page_data['page_name']     = 'newAdministrator';
        $page_data['page_title']    = get_phrase('New Administrator');
        $this->load->view('backend/index', $page_data);
    }
    /***********  The function that manages administrator ends here ***********************/

    function updateAdminRole($param2){
        $this->admin_model->updateAllDetailsForAdminRole($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
        redirect(base_url(). 'admin/newAdministrator', 'refresh');
    }



    /***********  The function below manages school marks ***********************/
    function tabulation_sheet ($exam_id = null, $class_id = null, $student_id = null, $session = null, $term = null, $section_id = null){
	$this->schoolFeaturesForAdmin();

        if($this->input->post('operation') == 'selection'){

            $page_data['exam_id']       =  $this->input->post('exam_id'); 
            $page_data['class_id']      =  $this->input->post('class_id');
            $page_data['student_id']    =  $this->input->post('student_id');
			$page_data['session']    	=  $this->input->post('session');
			$page_data['term']    		=  $this->input->post('term');
			$page_data['section_id']    =  $this->input->post('section_id');

            if($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 && $page_data['student_id'] > 0 && $page_data['session'] > 0 && $page_data['term'] > 0){

                redirect(base_url(). 'admin/tabulation_sheet/'. $page_data['exam_id'] .'/' . $page_data['class_id'] . '/' . $page_data['student_id'] .'/' . $page_data['session'] . '/' . $page_data['term'].'/' . $page_data['section_id'], 'refresh');
            }
            else{
                $this->session->set_flashdata('error_message', get_phrase('Pleasen select something'));
                redirect(base_url(). 'admin/tabulation_sheet', 'refresh');
            }
        }
        $page_data['exam_id']       =   $exam_id;
        $page_data['class_id']      =   $class_id;
        $page_data['student_id']    =   $student_id;
		$page_data['session']   	=   $session;
		$page_data['term']    		=   $term;
        //$page_data['subject_id']   	=   $subject_id;
		$page_data['section_id']   	=   $section_id;
        $page_data['page_name']     =   'tabulation_sheet';
        $page_data['page_title']    = 	get_phrase('student_marks');
        $this->load->view('backend/index', $page_data);
    }

    
    function print_mass_report_card($class_id, $exam_id, $session, $term, $section_id){

        $page_data['exam_id']       =   $exam_id;
        $page_data['class_id']      =   $class_id;
		$page_data['session']   	=   $session;
		$page_data['term']    		=   $term;
		$page_data['section_id']   	=   $section_id;

        $page_data['page_name']     =   'print_mass_report_card';
        $page_data['page_title']    = get_phrase('Terminal Report');
        $this->load->view('backend/index', $page_data);
    }

    function set_language($lang){
        $this->session->set_userdata('language', $lang);
        redirec(base_url(). 'admin', 'refresh');
        recache();
    }

    function create_barcode($student_id){
        return $this->Barcode_model->create_barcode($student_id);
    }

    function studentMassIdentityCard(){
        $page_data['page_name']     =   'studentMassIdentityCard';
        $page_data['page_title']    = get_phrase('Mass Identity Card');
        $this->load->view('backend/index', $page_data);

    }

    function studentMassIdentityCardPage($class_id){
        $page_data['class_id'] = $class_id;
        $this->load->view('backend/admin/studentMassIdentityCardPage', $page_data);
    }

    function website_setting($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'save_generalSetting'){
            $this->crud_model->save_into_school_website_table_model();
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/websiteSetting', 'refresh');
        }

        if($param1 == 'save_banner'){
            $this->crud_model->save_banner_into_banner_table_model();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/websiteSetting', 'refresh');
        }

        if($param1 == 'update_status'){
            $this->crud_model->update_testimony_status($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/websiteSetting', 'refresh');
        }

        if($param1 == 'delete'){
            $this->crud_model->delete_testimony_status($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/websiteSetting', 'refresh');
        }
        
        $page_data['page_name']     =   'websiteSetting';
        $page_data['page_title']    = get_phrase('Website Settings');
        $this->load->view('backend/index', $page_data);

    }

    function chatRoomMessage(){

        $page_data['user_id'] = $this->input->post('user_id');
        $page_data['message'] = $this->input->post('chatSend');
		$sql = "select * from general_message order by general_message_id desc limit 1";
				$return_query = $this->db->query($sql)->row()->general_message_id + 1;
				$page_data['general_message_id'] = $return_query;
        $this->db->insert('general_message', $page_data);
        echo json_encode($page_data);
    }

    function studentRequestBook($param1 = null, $param2 = null, $param3 = null){
	$this->schoolFeaturesForAdmin();

        if($param1 == 'update'){

            $page_data['status'] = $this->input->post('status');

            $this->db->where('book_request_id', $param2);
            $this->db->update('book_request', $page_data);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/studentRequestBook', 'refresh');
        }

        if($param1 == 'delete'){

            $this->db->where('book_request_id', $param2);
            $this->db->delete('book_request');
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/studentRequestBook', 'refresh');
        }

        $page_data['page_name']     =   'studentRequestBook';
        $page_data['page_title']    = get_phrase('Student Book Request');
        $this->load->view('backend/index', $page_data);
    }

    





	
		function maintenancefee(){
			$this->load->view('backend/student/oldlogin');
		}
	
		function studentpaid(){
			$this->load->view('backend/admin/studentpaid');
		}
		
		
		
	
	
		/********** the functino create an online_exam_questions_print_view ********************/
			function schoolFeaturesForAdmin(){
				$currentDate = date('Y-m-d');
				$futureDate = $this->db->get_where('settings', array('type' => 'schoolsession'))->row()->description;
				if($futureDate == ""){
					$data['description'] = date('Y')+1 .'-'. date('m-d');
					$this->db->where('type', 'schoolsession');
					$this->db->update('settings', $data);
				}
				
				if($futureDate != ""){
					if($currentDate == $futureDate){
						
						redirect(base_url() . 'admin/maintenancefee', 'refresh');
						
					}
				}
			}
		

		/* private messaging function starts from here: Here the function attach files, send and reply message accrodingly */
		function message($param1 = 'message_home', $param2 = '', $param3 = '') {
		$this->schoolFeaturesForAdmin();
			if ($this->session->userdata('admin_login') != 1)
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
			redirect(base_url() . 'admin/message/message_new/', 'refresh');
			}
		
			else
			{
			$file_path = 'uploads/private_messaging_attached_file/'.$_FILES['attached_file_on_messaging']['name'];
			move_uploaded_file($_FILES['attached_file_on_messaging']['tmp_name'], $file_path);
			}
		}
		
		$message_thread_code = $this->crud_model->send_new_private_message();
		$this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
		redirect(base_url() . 'admin/message/message_read/' . $message_thread_code, 'refresh');					
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
        redirect(base_url() . 'admin/message/message_read/' . $param2, 'refresh');
        }
        else
		{
        $file_path = 'uploads/private_messaging_attached_file/'.$_FILES['attached_file_on_messaging']['name'];
        move_uploaded_file($_FILES['attached_file_on_messaging']['tmp_name'], $file_path);
        }
        }
			
        $this->crud_model->send_reply_message($param2);  //$param2 = message_thread_code
        $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
        redirect(base_url() . 'admin/message/message_read/' . $param2, 'refresh');
			
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



    function live_class($param1 = null, $param2 = null, $param3 = null){
	$this->schoolFeaturesForAdmin();
        if($param1 == 'add'){

            $this->live_class_model->saveLiveClassToDatabase();
            $this->session->set_flashdata('flash_message', get_phrase('Zoom live class successfuly created'));
            redirect(base_url() . 'admin/live_class/', 'refresh');

        }

        if($param1 == 'edit'){

            $this->live_class_model->editLiveClassInformation($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Zoom live class successfuly edited'));
            redirect(base_url() . 'admin/live_class/', 'refresh');
        }

        if($param1 == 'delete'){

            $this->live_class_model->deleteLiveClassInformation($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Zoom live class successfuly deleted'));
            redirect(base_url() . 'admin/live_class/', 'refresh');
        }

        $page_data['page_name'] = 'live_class';
		$page_data['page_title'] = get_phrase('live_class');
		$this->load->view('backend/index', $page_data);
    }


    function edit_live_class($param1 = null, $param2 = null, $param3 = null){
	$this->schoolFeaturesForAdmin();

        $page_data['live_class_id'] = $param1;
        $page_data['page_name'] = 'edit_live_class';
		$page_data['page_title'] = get_phrase('edit_live_class');
		$this->load->view('backend/index', $page_data);
    }


    function host_live_class($param1 = null, $param2 = null, $param3 = null){
	$this->schoolFeaturesForAdmin();

        $page_data['live_class_id'] = $param1;
        $this->load->view('backend/host/host_live_class', $page_data);
    }
	
	
	
	function video_class($param1 = null, $param2 = null, $param3 = null){
	$this->schoolFeaturesForAdmin();
	
	if($param1 == 'add'){

            $this->live_class_model->saveVideoClassToDatabase();
            $this->session->set_flashdata('flash_message', get_phrase('video class successfuly created'));
            redirect(base_url() . 'admin/video_class/', 'refresh');

        }

        if($param1 == 'edit'){

            $this->live_class_model->editVideoClassInformation($param2);
            $this->session->set_flashdata('flash_message', get_phrase('video class successfuly edited'));
            redirect(base_url() . 'admin/video_class/', 'refresh');
        }

        if($param1 == 'delete'){

            $this->live_class_model->deleteVideoClassInformation($param2);
            $this->session->set_flashdata('flash_message', get_phrase('video class successfuly deleted'));
            redirect(base_url() . 'admin/video_class/', 'refresh');
        }

	
		$page_data['page_name'] = 'video_class';
		$page_data['page_title'] = get_phrase('video_classroom');
		$this->load->view('backend/index', $page_data);
	
	}
	
	function edit_video_class($param1 = null, $param2 = null, $param3 = null){
	$this->schoolFeaturesForAdmin();

        $page_data['video_class_id'] = $param1;
        $page_data['page_name'] = 'edit_video_class';
		$page_data['page_title'] = get_phrase('edit_video_class');
		$this->load->view('backend/index', $page_data);
    }
	
	
	/******************  Function that manage gallery and multiple images *****************************/
	function gallery($param1 = '', $param2 = '', $param3 = '') {
	$this->schoolFeaturesForAdmin();
    
	
    		
		if ($param1 == 'create') {
		
			$data['name'] 			= $this->input->post('name');
			$data['content']	 	= $this->input->post('content');
			$data['date'] 			= $this->input->post('date');
			
			$sql = "select * from gallery order by gallery_id desc limit 1";
			$return_query = $this->db->query($sql)->row()->gallery_id + 1;
			$data['gallery_id'] = $return_query;
	
			$this->db->insert('gallery', $data);
			$gallery_id = $this->db->insert_id();
			move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/gallery_image/' . $gallery_id . '.jpg');			// image with user ID
			$this->session->set_flashdata('flash_message', get_phrase('data_added_successfully'));
			redirect(base_url() . 'admin/gallery', 'refresh');
    	}
	
	if ($param1 == 'upload_images') {
       
	    $this->crud_model->add_gallery_images($param2);
        $this->session->set_flashdata('flash_message' , get_phrase('images_uploaded'));
        redirect(site_url('admin/upload_gallery_image/'.$param2), 'refresh');
      
	  }
	  
	  if ($param1 == 'delete_image') {
	  		$image = $this->db->get_where('galleryimagearray', array('id' => $id))->row()->imageArray;	// delete fromanothergallery image table array
	  
			if (file_exists('uploads/gallery_image/gallery_images/'.$image)) {
				unlink('uploads/gallery_image/gallery_images/'.$image);						// this will also delete image from the folder
			}
			$this->db->where('id', $param2);
			$this->db->delete('galleryimagearray');
				
			$this->session->set_flashdata('flash_message' , get_phrase('images_deleted'));
			redirect(site_url('admin/upload_gallery_image/'.$param3), 'refresh');
      }

	  
		if ($param1 == 'delete') {
		
		
		 $imageLocation = $this->db->get_where('gallery', array('gallery_id' => $param2))->row()->gallery_id;
			if (file_exists('uploads/gallery_image/'.$imageLocation.'.jpg')) {
            	unlink('uploads/gallery_image/'.$imageLocation.'.jpg');
          	}
			
			$imageLocationArray = $this->db->get_where('galleryimagearray', array('gallery_id' => $param2))->row()->imageArray;
			if (file_exists('uploads/gallery_image/gallery_images/'.$imageLocationArray.'.jpg')) {
            	unlink('uploads/gallery_image/gallery_images/'.$imageLocationArray.'.jpg');
          	}
		  
			$this->db->where('gallery_id', $param2);
			$this->db->delete('gallery');
			
			$this->db->where('gallery_id', $param2);
			$this->db->delete('gallery');
			
			$this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
			redirect(base_url() . 'admin/gallery', 'refresh');
		}
		
			$page_data['gallerys'] = $this->db->get('gallery')->result_array();
			$page_data['page_name'] = 'gallery';
			$page_data['page_title'] = get_phrase('manage_gallery');
			$this->load->view('backend/index', $page_data);
		}



	function upload_gallery_image($gallery_id){	  
        $page_data['page_name'] = 'upload_gallery_image';
        $page_data['page_title'] = get_phrase('Upload Gallery Images');
		$page_data['image'] 	= $this->db->get_where('gallery' , array('gallery_id' => $gallery_id))->result_array();
        $this->load->view('backend/index',$page_data);
    }
	
	function pending_admission($param1 = null, $param2 = null, $param3 = null){	 
	$this->schoolFeaturesForAdmin(); 
	
		if ($param1 == 'delete') {
		
			$this->db->where('form_id', $param2);
			$this->db->delete('form');
			
			$this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
			redirect(base_url() . 'admin/pending_admission', 'refresh');
		}
		
		if ($param1 == 'approve') {
		
			
			$this->crud_model->approve_pending_student($param2);
			
			$this->session->set_flashdata('flash_message', get_phrase('data_deleted'));
			redirect(base_url() . 'admin/pending_admission', 'refresh');
		}
		
        $page_data['page_name'] = 'pending_admission';
        $page_data['page_title'] = get_phrase('pending_admission');
        $this->load->view('backend/index',$page_data);
    }


    function addon_manager($param1 = null, $param2 = null, $param3 = null){

        $page_data['page_name'] = 'addon_manager';
        $page_data['page_title'] = get_phrase('addon_manager');
        $this->load->view('backend/index',$page_data);
        
    }
	
	/***********  The function below manages school event ***********************/
    function news ($param1 = null, $param2 = null, $param3 = null){
	$this->schoolFeaturesForAdmin();

        if($param1 == 'create'){
            $this->event_model->createNewsFunction();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/news', 'refresh');
        }

        if($param1 == 'update'){
            $this->event_model->updateNewsFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/news', 'refresh');
        }

        if($param1 == 'delete'){
            $this->event_model->deleteNewsFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/news', 'refresh');
        }

        $page_data['page_name']     = 'news';
        $page_data['page_title']    = get_phrase('post_news');
        $this->load->view('backend/index', $page_data);
    }
    /***********  The function that manages school events ends here ***********************/

    function jitsi($param1 = null, $param2 = null, $param3 = null){
	$this->schoolFeaturesForAdmin();


        if($param1 == 'add'){
            $this->live_class_model->createNewJitsiClassFunction();
            $this->session->set_flashdata('flash_message', get_phrase('live_class_successfuly_created'));
            redirect(base_url() . 'admin/jitsi/', 'refresh');
        }

        if($param1 == 'edit'){
            $this->live_class_model->updateJitsiClassFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('live_class_successfuly_updated'));
            redirect(base_url() . 'admin/jitsi/', 'refresh');
        }

        if($param1 == 'delete'){
            $this->live_class_model->deleteJitsiClassFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('live_class_successfuly_deleted'));
            redirect(base_url() . 'admin/jitsi/', 'refresh');
        }

        $page_data['page_name'] = 'jitsi';
        $page_data['page_title'] = get_phrase('jitsi_live_class');
        $this->load->view('backend/index',$page_data);
    }

    function edit_jitsi($jitsi_id){
	$this->schoolFeaturesForAdmin();

        $page_data['page_name'] = 'edit_jitsi';
        $page_data['page_title'] = get_phrase('edit_jitsi');
        $page_data['toSelectFromJitsiWithId'] = $this->live_class_model->toSelectFromJitsiWithId($jitsi_id);
        $this->load->view('backend/index',$page_data);
    }


    function stream_jitsi($jitsi_id){
	$this->schoolFeaturesForAdmin();
        
        $page_data['jitsi_id'] = $jitsi_id;
        $this->load->view('backend/host/jitsi', $page_data);

    }
	
	
	
	function ajax_student_search() {
        if($_POST['b'] != ""){       
            $this->db->like('name' , $_POST['b']);
            $query = $this->db->get_where('student')->result_array();
            if(count($query) > 0){
                foreach ($query as $row) {
                    echo '<p style="text-align: left; color:#000; background-color:rgba(255,255,255,.9); padding:10px; margin:0; font-size:14px;"><a style="text-align: left; color:#000; font-weight: bold;" href="'.base_url().'admin/view_student/'. $row['student_id'] .'/">'. '<img src="'.$this->crud_model->get_image_url('student', $row['student_id']).'" class="img-circle" width="20" height="20" />'.' '.$row['name'] .'</a>'."</p>";
                }
            } else{
                echo '<p class="col-md-12" style="text-align: left; background-color:rgba(255,255,255,.9); color: #000; font-weight: bold; ">No results.</p>';
            }
        }
    }
	
	
	function ajax_student_search_nav() {
        if($_POST['b'] != ""){       
            $this->db->like('name' , $_POST['b']);
            $query = $this->db->get_where('student')->result_array();
            if(count($query) > 0){
                foreach ($query as $row) {
                    echo '<p style="padding-left:5%; font-size:14px;"><a style="text-align: left; font-weight: bold;" href="'.base_url().'admin/view_student/'. $row['student_id'] .'/">'. '<img src="'.$this->crud_model->get_image_url('student', $row['student_id']).'" class="img-circle" width="20" height="20" />'.' '.$row['name'] .'</a>'."</p>";
                }
            } else{
                echo '<p class="col-md-12" style="padding-left:5%; font-weight: bold; ">No results.</p>';
            }
        }
    }
	
	
        

	/********** the functino to set language starts here ********************/
	 function skin_colour($theme) {
        $this->session->set_userdata('skin_colour', $theme);
       	redirect(base_url() . 'admin', 'refresh');
        recache();
    }
	
	/********** the functino to set language starts here ********************/
	 function set_direction($direction) {
        $this->session->set_userdata('set_direction', $direction);
       	redirect(base_url() . 'admin', 'refresh');
        recache();
    }
	
	
	
/************************* view student ************************/
	function view_student($student_id = '') {
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');

		$class_id = $this->db->get_where('student', array('student_id' => $student_id))->row()->class_id;
    	$student_name = $this->db->get_where('student', array('student_id' => $student_id))->row()->name;
    	$class_name = $this->db->get_where('class', array('class_id' => $class_id))->row()->name;    
		$page_data['page_name'] = 'view_student';
        $page_data['page_title'] = get_phrase('student_information_page');
       	$page_data['student_id'] = $student_id;
        $page_data['class_id'] = $class_id;
        $this->load->view('backend/index', $page_data);
	}
	
	
	
	function student_remarks($param1 = "" , $stu_rem_id = "") {
		$this->schoolFeaturesForAdmin();
		
		if($param1 == 'save'){ 
			
			$this->data['student_id'] 		= $this->input->post('student_id');
			$this->data['class_comment'] 	= $this->input->post('class_comment');
			$this->data['head_comment'] 	= $this->input->post('head_comment');
			$this->data['session'] 			= $this->input->post('session');
			$this->data['term'] 			= $this->input->post('term');
			$this->data['ma'] 				= $this->input->post('ma');
			$this->data['pd'] 				= $this->input->post('pd');
			$this->data['rt'] 				= $this->input->post('rt');
			$this->data['rm'] 				= $this->input->post('rm');
			$this->data['gha'] 				= $this->input->post('gha');
			$this->data['p'] 				= $this->input->post('p');
			$this->data['n'] 				= $this->input->post('n');
			$this->data['lt'] 				= $this->input->post('lt');
			
			if ($stu_rem_id == "") {
                
				$sql = "select * from stu_rem order by stu_rem_id desc limit 1";
                $return_query = $this->db->query($sql)->row()->stu_rem_id + 1;
				$this->data['stu_rem_id'] = $return_query;
						
				$this->db->insert('stu_rem', $this->data);
			} else {
				$this->db->where('stu_rem_id', $stu_rem_id);
				$this->db->update('stu_rem', $this->data);
			}
			
			$this->session->set_flashdata('flash_message', get_phrase('student_remarks_submitted'));
			redirect(base_url(). $this->session->userdata('login_type').'/tabulation_sheet', 'refresh');
		}
		
		
		
		if($param1 == 'prekg'){ 
		
				$this->data['class_teacher_comment'] 		= $this->input->post('class_teacher_comment');
				$this->data['head_teacher_comment'] 		= $this->input->post('head_teacher_comment');
				$this->data['consistently'] 				= $this->input->post('consistently');
				$this->data['most_of_the_time'] 			= $this->input->post('most_of_the_time');
				$this->data['needs_improvement'] 			= $this->input->post('needs_improvement');
			
			
				$this->db->where('prekg_id', $stu_rem_id);
				$this->db->update('prekg', $this->data);
		
               
			   $this->session->set_flashdata('flash_message', get_phrase('student_remarks_submitted'));
               redirect(base_url(). 'admin/prekg/'. $this->input->post('exam_id') .'/' . $this->input->post('class_id') . 
			   '/' . $this->input->post('student_id'). '/' . $this->input->post('subject_id'), 'refresh');
		}
		
		
	}
	
	
	
	function tanzania_stu_rem($param1 = "" , $id = "") {
		$this->schoolFeaturesForAdmin();
		
		$class_id  	=  $this->input->post('class_id');
		$exam_id 	=  $this->input->post('exam_id');
		
		if($param1 == 'save'){ 
			
			$this->data['student_id'] 		= $this->input->post('student_id');
			$this->data['session'] 			= $this->input->post('session');
			$this->data['term'] 			= $this->input->post('term');
			$this->data['percentage'] 		= $this->input->post('percentage');
			$this->data['average'] 			= $this->input->post('average');
			$this->data['description'] 		= $this->input->post('description');
			$this->data['atten_percentage'] = $this->input->post('atten_percentage');
			$this->data['atten_average'] 	= $this->input->post('atten_average');
			$this->data['atten_description']= $this->input->post('atten_description');

			
			
			if ($id == "") {
                
				$sql = "select * from tanzania_stu_rem order by id desc limit 1";
                $return_query = $this->db->query($sql)->row()->id + 1;
				$this->data['id'] = $return_query;
						
				$this->db->insert('tanzania_stu_rem', $this->data);
			} else {
				$this->db->where('id', $id);
				$this->db->update('tanzania_stu_rem', $this->data);
			}
			
			$this->session->set_flashdata('flash_message', get_phrase('student_remarks_submitted'));
			redirect(base_url(). $this->session->userdata('login_type').'/tabulation_sheet/'.$exam_id.'/'.$class_id.'/'.$this->data['student_id'], 'refresh');
		}
		
		
		
		if($param1 == 'prekg'){ 
		
				$this->data['class_teacher_comment'] 		= $this->input->post('class_teacher_comment');
				$this->data['head_teacher_comment'] 		= $this->input->post('head_teacher_comment');
				$this->data['consistently'] 				= $this->input->post('consistently');
				$this->data['most_of_the_time'] 			= $this->input->post('most_of_the_time');
				$this->data['needs_improvement'] 			= $this->input->post('needs_improvement');
			
			
				$this->db->where('prekg_id', $stu_rem_id);
				$this->db->update('prekg', $this->data);
		
               
			   $this->session->set_flashdata('flash_message', get_phrase('student_remarks_submitted'));
               redirect(base_url(). 'admin/prekg/'. $this->input->post('exam_id') .'/' . $this->input->post('class_id') . 
			   '/' . $this->input->post('student_id'). '/' . $this->input->post('subject_id'), 'refresh');
		}
		
		
	}
	
	
	
	
	function udemy_stu_rem($param1 = "" , $id = "") {
		$this->schoolFeaturesForAdmin();
		
		$class_id  	=  $this->input->post('class_id');
		$exam_id 	=  $this->input->post('exam_id');
		
		if($param1 == 'save'){ 
			
			$this->data['student_id'] 		= $this->input->post('student_id');
			$this->data['session'] 			= $this->input->post('session');
			$this->data['term'] 			= $this->input->post('term');
			$this->data['fmc'] 				= $this->input->post('fmc');
			$this->data['fma'] 				= $this->input->post('fma');
			$this->data['pc'] 				= $this->input->post('pc');
			$this->data['at'] 				= $this->input->post('at');
			$this->data['ho'] 				= $this->input->post('ho');
			$this->data['ne'] 				= $this->input->post('ne');
			$this->data['po'] 				= $this->input->post('po');
			$this->data['pu'] 				= $this->input->post('pu');
			$this->data['re'] 				= $this->input->post('re');
			$this->data['cl'] 				= $this->input->post('cl');
			$this->data['dr'] 				= $this->input->post('dr');
			$this->data['ha'] 				= $this->input->post('ha');
			$this->data['hob'] 				= $this->input->post('hob');
			$this->data['sp'] 				= $this->input->post('sp');
			$this->data['spo'] 				= $this->input->post('spo');
			
			if ($id == "") {
                
				$sql = "select * from udemy_stu_rem order by id desc limit 1";
                $return_query = $this->db->query($sql)->row()->id + 1;
				$this->data['id'] = $return_query;
						
				$this->db->insert('udemy_stu_rem', $this->data);
			} else {
				$this->db->where('id', $id);
				$this->db->update('udemy_stu_rem', $this->data);
			}
			
			$this->session->set_flashdata('flash_message', get_phrase('student_remarks_submitted'));
			redirect(base_url(). $this->session->userdata('login_type').'/tabulation_sheet/'.$exam_id.'/'.$class_id.'/'.$this->data['student_id'], 'refresh');
		}	
		
	}	
	
	
	
	
	function diamond_stu_comment($param1 = "" , $id = "") {
		$this->schoolFeaturesForAdmin();
		
		$class_id  	=  $this->input->post('class_id');
		$exam_id 	=  $this->input->post('exam_id');
		
		if($param1 == 'save'){ 
			
			$this->data['student_id'] 		= $this->input->post('student_id');
			$this->data['session'] 			= $this->input->post('session');
			$this->data['status'] 			= get_settings('mid_ter_rep_card');
			$this->data['term'] 			= $this->input->post('term');
			$this->data['pu'] 				= $this->input->post('pu');
			$this->data['cl'] 				= $this->input->post('cl');
			$this->data['car'] 				= $this->input->post('car');
			$this->data['ne'] 				= $this->input->post('ne');
			$this->data['po'] 				= $this->input->post('po');
			$this->data['ho'] 				= $this->input->post('ho');
			$this->data['se'] 				= $this->input->post('se');
			$this->data['re'] 				= $this->input->post('re');
			$this->data['sen'] 				= $this->input->post('sen');
			$this->data['ob'] 				= $this->input->post('ob');
			$this->data['ini'] 				= $this->input->post('ini');
			$this->data['org'] 				= $this->input->post('org');
			$this->data['han'] 				= $this->input->post('han');
			$this->data['fl'] 				= $this->input->post('fl');
			$this->data['ga'] 				= $this->input->post('ga');
			
			$this->data['sp'] 				= $this->input->post('sp');
			$this->data['gy'] 				= $this->input->post('gy');
			$this->data['dr'] 				= $this->input->post('dr');
			$this->data['mu'] 				= $this->input->post('mu');
			$this->data['ha'] 				= $this->input->post('ha');
			$this->data['cr'] 				= $this->input->post('cr');
			$this->data['tcomment'] 		= $this->input->post('tcomment');
			$this->data['p_comment'] 		= $this->input->post('p_comment');
			
			if ($id == "") {
                
				$sql = "select * from diamond_stu_comment order by id desc limit 1";
                $return_query = $this->db->query($sql)->row()->id + 1;
				$this->data['id'] = $return_query;
						
				$this->db->insert('diamond_stu_comment', $this->data);
			} else {
				$this->db->where('id', $id);
				$this->db->update('diamond_stu_comment', $this->data);
			}
			
			$this->session->set_flashdata('flash_message', get_phrase('student_remarks_submitted'));
			redirect(base_url(). $this->session->userdata('login_type').'/tabulation_sheet/'.$exam_id.'/'.$class_id.'/'.$this->data['student_id'], 'refresh');
		}	
		
	}
	
	
	
	
	
	
	
	function printResultSheet($student_id , $exam_id){
		if ($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');
		$class_id  = $this->db->get_where('student' , array('student_id' => $student_id))->row()->class_id;
		
		$page_data['student_id'] =   $student_id;
		$page_data['class_id']   =   $class_id;
		$page_data['exam_id']    =   $exam_id;
		$page_data['page_name']  = 	 'printResultSheet';
		$page_data['page_title'] = 	get_phrase('print_result_sheet');
		$this->load->view('backend/index', $page_data);
	}
	
	
	function generate_student_pdf($student_id , $exam_id){
	
		$class_id  = $this->db->get_where('student' , array('student_id' => $student_id))->row();
	
        $page_data['student_id'] =   $student_id;
		$page_data['class_id']   =   $class_id->class_id;
		$page_data['exam_id']    =   $exam_id;
        $this->load->view('backend/admin/generate_student_pdf', $page_data);
	
		// Get output html
        $html = $this->output->get_output();
        
        // Load pdf library
        //$this->load->library('pdf');
        
        // Load HTML content
        $this->pdf->loadHtml($html);
        
        // (Optional) Setup the paper size and orientation
        $this->pdf->setPaper('A3', 'landscape');
        
        // Render the HTML as PDF
        $this->pdf->render();
        
        // Output the generated PDF (1 = download and 0 = preview)
        $this->pdf->stream($class_id->name." Report Card.pdf", array("Attachment"=>0));
		
	}
	
	


	
	function fee_type($param1 = "", $param2 = "", $param3 = ""){
		if ($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');
		
		
		if($param1 == "edit"){
		
			$page_data['edit_fee_type'] = base64_decode($param2);
		}
		
		
		if($param1 == 'save'){ 
			
			$this->data['title'] 	= $this->input->post('title');
			$this->data['amount'] 	= $this->input->post('amount');
			$this->data['class_id']	= $this->input->post('class_id');
			$this->data['date'] 	= strtotime($this->input->post('date'));
			$this->data['session']	= get_settings('session');	
			$this->data['term']		= get_settings('term');			
			
			if ($param2 == "") {
                
				$sql = "select * from fee_type order by id desc limit 1";
                $return_query = $this->db->query($sql)->row()->id + 1;
				$this->data['id'] = $return_query;
						
				$this->db->insert('fee_type', $this->data);
			} else {
				$this->db->where('id', $param2);
				$this->db->update('fee_type', $this->data);
			}
			
			$this->session->set_flashdata('flash_message', get_phrase('fee_type_added_successfully'));
			redirect(base_url(). $this->session->userdata('login_type').'/fee_type/', 'refresh');
		}
		
		if($param1 == 'delete'){ 
		
			$this->db->where('id', $param2);
			$this->db->delete('fee_type');
		
			$this->session->set_flashdata('flash_message', get_phrase('fee_type_deleted_successfully'));
			redirect(base_url(). $this->session->userdata('login_type').'/fee_type/', 'refresh');
		
		}
		
		$page_data['page_name']  = 	 'fee_type';
		$page_data['page_title'] = get_phrase('fee_types');
		$this->load->view('backend/index', $page_data);
	}	
	
	
	
	/************ manage enrollment ********************/
	function manage_enrollment() {

    if ($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');

    	$from_class = $this->input->post('from_class');
		$to_section = $this->input->post('section_id');
    	$students = $this->db->get_where('student', array('class_id' => $from_class))->result_array();
    	foreach ($students as $row) {
			$student_id = $this->input->post('enroll_' . $row['student_id']);
			$to_class = $this->input->post('to_class_' . $row['student_id']);
			if (isset($to_class)) {
			
			
				$verify_data['class_id'] 	= $to_class;
				$verify_data['section_id'] 	= $to_section;
				
				$this->db->where('student_id', $student_id);
				$this->db->where('class_id', $from_class);
				$this->db->update('student', $verify_data);		
				
				/*$query = $this->db->get_where('enroll', $verify_data);
				if ($query->num_rows() < 1) {
					$this->db->insert('enroll', $verify_data);
				} 
				else {
					$this->db->where('student_id', $student_id);
					$this->db->where('from_class_id', $from_class);
					$this->db->where('to_class_id', $to_class);
					$this->db->update('enroll', $verify_data);
				}
				*/
			}
    	}

		$this->session->set_flashdata('flash_message', get_phrase('students_promoted_successfully'));
		redirect(base_url() . 'admin/promote_student', 'refresh');
	}
	
	
	
	
	
	
	
	
    function get_class_alumni_mass_student($class_id){

        $students = $this->db->get_where('student', array('class_id' => $class_id))->result_array();
        foreach($students as $key => $student)
        {
            echo '<div class="">
            <label><input type="checkbox" class="check" name="student_id[]" value="' . $student['student_id'] . '">' . '&nbsp;'. $student['name'] .' - '. $this->crud_model->get_type_name_by_id('class', $class_id).'</label></div>';
        }

        echo '<button type ="button" class="btn btn-success btn-sm mr-2" onClick="select()">'.get_phrase('Select All').'</button>';
        echo '<button type ="button" class="btn btn-danger btn-sm" onClick="unselect()">'.get_phrase('Unselect All').'</button><hr>';
    }
	
	
	
	
	
	
	
	
	
	
	/************ Import Student ********************/
	function student_import() {

    	if ($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');
			
    	
		foreach($this->input->post('student_id') as $id){
		$page_data = array(
			'alumni_id' 		=> $id,
            'name' 				=> $this->db->get_where('student', array('student_id' => $id))->row()->name,
            'sex' 				=> $this->db->get_where('student', array('student_id' => $id))->row()->sex,
			'phone' 			=> $this->db->get_where('student', array('student_id' => $id))->row()->phone,
			'email' 			=> $this->db->get_where('student', array('student_id' => $id))->row()->email,
        	'address' 			=> $this->db->get_where('student', array('student_id' => $id))->row()->address,
            'marital_status' 	=> '',
			'session' 			=> $this->db->get_where('student', array('student_id' => $id))->row()->session,
			'g_year' 			=> get_settings('session'),
        	'club_id' 			=> $this->db->get_where('student', array('student_id' => $id))->row()->club_id
			);
			
			
            $check_email = $this->db->get_where('alumni', array('email' => $row['email']))->row()->email;
            if($check_email != NULL) {
				$this->session->set_flashdata('error_message', get_phrase('email_already_exist'));
				redirect(base_url() . 'admin/alumni', 'refresh');
            }
            else {
				
				$this->db->insert('alumni', $page_data);
            	
				$face_file = 'uploads/student_image/'. $id . '.jpg';
				if(file_exists($face_file)){
					$destination_path = 'uploads/alumni_image/';
					rename($face_file, $destination_path . pathinfo($face_file, PATHINFO_BASENAME));

				}
				
				$this->db->where('student_id', $id);
				$this->db->delete('student');
				
				
				
        	}
		}
		$this->session->set_flashdata('flash_message', get_phrase('students_moved_successfully'));
		redirect(base_url() . 'admin/alumni', 'refresh');
	}
	
	




}
