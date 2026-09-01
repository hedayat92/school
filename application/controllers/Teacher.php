<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Teacher extends CI_Controller { 

    function __construct() {
        parent::__construct();
        		$this->load->database();                                //Load Databse Class
                $this->load->library('session');					    //Load library for session
               // $this->load->model('vacancy_model');
			   
			   timezone();
			   

    }

     /*teacher dashboard code to redirect to teacher page if successfull login** */
     function dashboard() {
        if ($this->session->userdata('teacher_login') != 1) redirect(base_url(), 'refresh');
       	$page_data['page_name'] = 'dashboard';
        $page_data['page_title'] = get_phrase('Teacher Dashboard');
        $this->load->view('backend/index', $page_data);
    }
	/******************* / teacher dashboard code to redirect to teacher page if successfull login** */

    function manage_profile($param1 = null, $param2 = null, $param3 = null){
        if ($this->session->userdata('teacher_login') != 1) redirect(base_url(), 'refresh');
        if ($param1 == 'update') {
    
    
            $data['name']   =   $this->input->post('name');
            $data['email']  =   $this->input->post('email');
			
			//uploading file1 using codeigniter upload library
			$this->load->library('upload');
			$file_name = $this->session->userdata('teacher_id') . '.jpg';
			$config['upload_path'] 				= 'uploads/teacher_image/';
			$config['allowed_types'] 			= 'jpeg|jpg|JPEG';
			$config['max_size'] 				= '3000000';
			$config['overwrite']            	= true;
			$config['file_name']            	= $file_name;
	
			$this->upload->initialize($config);
			if( ! $this->upload->do_upload('userfile')){
				$this->session->set_flashdata('error_message', $this->upload->display_errors());
				redirect(base_url() . 'teacher/manage_profile', 'refresh');
			}
			$this->security->xss_clean($data);
    
            $this->db->where('teacher_id', $this->session->userdata('teacher_id'));
            $this->db->update('teacher', $data);
			move_uploaded_file($_FILES['sign']['tmp_name'], 'uploads/teacher_image/' . 'teacher_' .$this->session->userdata('teacher_id') . '.jpg');
            $this->session->set_flashdata('flash_message', get_phrase('Info Updated'));
            redirect(base_url() . 'teacher/manage_profile', 'refresh');
           
        }
    
        if ($param1 == 'change_password') {
            $data['new_password']           =   sha1($this->input->post('new_password'));
            $data['confirm_new_password']   =   sha1($this->input->post('confirm_new_password'));
    
            if ($data['new_password'] == $data['confirm_new_password']) {
               
               $this->db->where('teacher_id', $this->session->userdata('teacher_id'));
               $this->db->update('teacher', array('password' => $data['new_password']));
               $this->session->set_flashdata('flash_message', get_phrase('Password Changed'));
            }
    
            else{
                $this->session->set_flashdata('error_message', get_phrase('Type the same password'));
            }
            redirect(base_url() . 'teacher/manage_profile', 'refresh');
        }
    
            $page_data['page_name']     = 'manage_profile';
            $page_data['page_title']    = get_phrase('Manage Profile');
            $page_data['edit_profile']  = $this->db->get_where('teacher', array('teacher_id' => $this->session->userdata('teacher_id')))->result_array();
            $this->load->view('backend/index', $page_data);
        }



        function manage_attendance($date = null, $month= null, $year = null, $class_id = null, $section_id = null ){
            $active_sms_gateway = $this->db->get_where('sms_settings', array('type' => 'active_sms_gateway'))->row()->info;
            
            if ($_POST) {
        
                // Loop all the students of $class_id
                $students = $this->db->get_where('student', array('class_id' => $class_id))->result_array();
                foreach ($students as $key => $student) {
                $attendance_status = $this->input->post('status_' . $student['student_id']);
                $full_date = $year . "-" . $month . "-" . $date;
                $this->db->where('student_id', $student['student_id']);
                $this->db->where('date', $full_date);
        
                $this->db->update('attendance', array('status' => $attendance_status));
        
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
                redirect(base_url() . 'teacher/manage_attendance/' . $date . '/' . $month . '/' . $year . '/' . $class_id . '/' . $section_id, 'refresh');
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
            redirect(base_url(). 'teacher/manage_attendance/' .$date. '/' . $this->input->post('class_id'). '/' . $this->input->post('section_id'), 'refresh');
        }
    
    
        function attendance_report($class_id = NULL, $section_id = NULL, $month = NULL, $year = NULL) {
            
            $active_sms_gateway = $this->db->get_where('sms_settings', array('type' => 'active_sms_gateway'))->row()->info;
            
            
            if ($_POST) {
            redirect(base_url() . 'teacher/attendance_report/' . $class_id . '/' . $section_id . '/' . $month . '/' . $year, 'refresh');
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
        function loadAttendanceReport($class_id, $section_id, $month, $year)
        {
            $page_data['class_id'] 		= $class_id;					// get all class_id
            $page_data['section_id'] 	= $section_id;					// get all section_id
            $page_data['month'] 		= $month;						// get all month
            $page_data['year'] 			= $year;						// get all class year
            
            $this->load->view('backend/teacher/loadAttendanceReport' , $page_data);
        }
        /******************** Load attendance with ajax code ends from here **********************/
        
    
        /******************** print attendance report **********************/
        function printAttendanceReport($class_id=NULL, $section_id=NULL, $month=NULL, $year=NULL)
        {
            $page_data['class_id'] 		= $class_id;					// get all class_id
            $page_data['section_id'] 	= $section_id;					// get all section_id
            $page_data['month'] 		= $month;						// get all month
            $page_data['year'] 			= $year;						// get all class year
            
            $page_data['page_name'] = 'printAttendanceReport';
            $page_data['page_title'] = "Attendance Report";
            $this->load->view('backend/index', $page_data);
        }
        /******************** /Ends here **********************/
		
		
		
		
    /***********  The function below manages school marks ***********************/
    function marks ($exam_id = null, $class_id = null, $student_id = null){

            if($this->input->post('operation') == 'selection'){

                $page_data['exam_id']       =  $this->input->post('exam_id'); 
                $page_data['class_id']      =  $this->input->post('class_id');
                $page_data['student_id']    =  $this->input->post('student_id');

                if($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 && $page_data['student_id'] > 0){

                    redirect(base_url(). 'teacher/marks/'. $page_data['exam_id'] .'/' . $page_data['class_id'] . '/' . $page_data['student_id'], 'refresh');
                }
                else{
                    $this->session->set_flashdata('error_message', get_phrase('Pleasen select something'));
                    redirect(base_url(). 'teacher/marks', 'refresh');
                }
            }

            
			if($this->input->post('operation') == 'update_student_subject_score'){
				$select_subject_first = $this->db->get_where('subject', array('class_id' => $class_id ))->result_array();
					
					if(get_settings('report_template') == 1 || get_settings('report_template') == 'tanzania') { 

                	
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
							//$page_data['class_score3']  =   $this->input->post('class_score3_' . $dispay_subject_from_subject_table['subject_id']);
							$page_data['exam_score']    =   $this->input->post('exam_score_' . $dispay_subject_from_subject_table['subject_id']);
							$page_data['comment']       =   $this->input->post('comment_' . $dispay_subject_from_subject_table['subject_id']);
							$page_data['session']       =   $this->db->get_where('exam', array('exam_id' => $exam_id))->row()->session;
							$page_data['term']       	=   $this->db->get_where('exam', array('exam_id' => $exam_id))->row()->term;
	
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
							$page_data['session']       =   $this->db->get_where('exam', array('exam_id' => $exam_id))->row()->session;
							$page_data['term']       	=   $this->db->get_where('exam', array('exam_id' => $exam_id))->row()->term;
	
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
							$page_data['class_score11']  =   $this->input->post('class_score11_' . $dispay_subject_from_subject_table['subject_id']);
							$page_data['class_score22']  =   $this->input->post('class_score22_' . $dispay_subject_from_subject_table['subject_id']);
							$page_data['class_score33']  =   $this->input->post('class_score33_' . $dispay_subject_from_subject_table['subject_id']);
							$page_data['class_score44']  =   $this->input->post('class_score44_' . $dispay_subject_from_subject_table['subject_id']);
							$page_data['class_score55']  =   $this->input->post('class_score55_' . $dispay_subject_from_subject_table['subject_id']);
							
							$page_data['exam_score']    =   $this->input->post('exam_score_' . $dispay_subject_from_subject_table['subject_id']);
							$page_data['comment']       =   $this->input->post('comment_' . $dispay_subject_from_subject_table['subject_id']);
							$page_data['session']       =   $this->db->get_where('exam', array('exam_id' => $exam_id))->row()->session;
							$page_data['term']       	=   $this->db->get_where('exam', array('exam_id' => $exam_id))->row()->term;
	
							$this->db->where('mark_id', $this->input->post('mark_id_' . $dispay_subject_from_subject_table['subject_id']));
							$this->db->update('mark', $page_data);  
							
						}
					}
					
				
				
                    $this->session->set_flashdata('flash_message', get_phrase('data_dpdated_successfully'));
                    redirect(base_url(). 'teacher/marks/'. $this->input->post('exam_id') .'/' . $this->input->post('class_id') . '/' . $this->input->post('student_id'), 'refresh');
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

        if($this->input->post('operation') == 'selection'){

            $page_data['exam_id']       =  $this->input->post('exam_id'); 
            $page_data['class_id']      =  $this->input->post('class_id');
            $page_data['subject_id']    =  $this->input->post('subject_id');

            if($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 && $page_data['subject_id'] > 0){

                redirect(base_url(). 'teacher/student_marksheet_subject/'. $page_data['exam_id'] .'/' . $page_data['class_id'] . '/' . $page_data['subject_id'], 'refresh');
            }
            else{
                $this->session->set_flashdata('error_message', get_phrase('Pleasen select something'));
                redirect(base_url(). 'teacher/student_marksheet_subject', 'refresh');
            }
        }

        if($this->input->post('operation') == 'update_student_subject_score'){
		
			$select_student_first = $this->db->get_where('student', array('class_id' => $class_id ))->result_array();
		
				if(get_settings('report_template') == 1 || get_settings('report_template') == 'tanzania') { 

            
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
						$page_data['session']       =   $this->db->get_where('exam', array('exam_id' => $exam_id))->row()->session;
						$page_data['term']       	=   $this->db->get_where('exam', array('exam_id' => $exam_id))->row()->term;
	
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
						$page_data['session']       =   $this->db->get_where('exam', array('exam_id' => $exam_id))->row()->session;
						$page_data['term']       	=   $this->db->get_where('exam', array('exam_id' => $exam_id))->row()->term;
	
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
						$page_data['class_score11']  =   $this->input->post('class_score11_' . $dispay_student_from_student_table['student_id']);
						$page_data['class_score22']  =   $this->input->post('class_score22_' . $dispay_student_from_student_table['student_id']);
						$page_data['class_score33']  =   $this->input->post('class_score33_' . $dispay_student_from_student_table['student_id']);
						$page_data['class_score44']  =   $this->input->post('class_score44_' . $dispay_student_from_student_table['student_id']);
						$page_data['class_score55']  =   $this->input->post('class_score55_' . $dispay_student_from_student_table['student_id']);
						
						$page_data['exam_score']    =   $this->input->post('exam_score_' . $dispay_student_from_student_table['student_id']);
						$page_data['comment']       =   $this->input->post('comment_' . $dispay_student_from_student_table['student_id']);
						$page_data['session']       =   $this->db->get_where('exam', array('exam_id' => $exam_id))->row()->session;
						$page_data['term']       	=   $this->db->get_where('exam', array('exam_id' => $exam_id))->row()->term;
	
						$this->db->where('mark_id', $this->input->post('mark_id_' . $dispay_student_from_student_table['student_id']));
						$this->db->update('mark', $page_data);  
					}
				}
				
				
				

  				$this->session->set_flashdata('flash_message', get_phrase('data_dpdated_successfully'));
				redirect(base_url(). 'teacher/student_marksheet_subject/'. $this->input->post('exam_id') .'/' . 
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



    function live_class($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'add'){

            $this->live_class_model->saveLiveClassToDatabase();
            $this->session->set_flashdata('flash_message', get_phrase('Zoom live class successfuly created'));
            redirect(base_url() . 'teacher/live_class/', 'refresh');

        }

        if($param1 == 'edit'){

            $this->live_class_model->editLiveClassInformation($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Zoom live class successfuly edited'));
            redirect(base_url() . 'teacher/live_class/', 'refresh');
        }

        if($param1 == 'delete'){

            $this->live_class_model->deleteLiveClassInformation($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Zoom live class successfuly deleted'));
            redirect(base_url() . 'teacher/live_class/', 'refresh');
        }

        $page_data['page_name'] = 'live_class';
		$page_data['page_title'] = get_phrase('live_class');
		$this->load->view('backend/index', $page_data);
    }


    function edit_live_class($param1 = null, $param2 = null, $param3 = null){

        $page_data['live_class_id'] = $param1;
        $page_data['page_name'] = 'edit_live_class';
		$page_data['page_title'] = get_phrase('edit_live_class');
		$this->load->view('backend/index', $page_data);
    }


    function host_live_class($param1 = null, $param2 = null, $param3 = null){

        $page_data['live_class_id'] = $param1;
        $this->load->view('backend/host/host_live_class', $page_data);
    }
	
	
	
	function video_class($param1 = null, $param2 = null, $param3 = null){
	
	if($param1 == 'add'){

            $this->live_class_model->saveVideoClassToDatabase();
            $this->session->set_flashdata('flash_message', get_phrase('video class successfuly created'));
            redirect(base_url() . 'teacher/video_class/', 'refresh');

        }

        if($param1 == 'edit'){

            $this->live_class_model->editVideoClassInformation($param2);
            $this->session->set_flashdata('flash_message', get_phrase('video class successfuly edited'));
            redirect(base_url() . 'teacher/video_class/', 'refresh');
        }

        if($param1 == 'delete'){

            $this->live_class_model->deleteVideoClassInformation($param2);
            $this->session->set_flashdata('flash_message', get_phrase('video class successfuly deleted'));
            redirect(base_url() . 'teacher/video_class/', 'refresh');
        }

	
		$page_data['page_name'] = 'video_class';
		$page_data['page_title'] = get_phrase('video_classroom');
		$this->load->view('backend/index', $page_data);
	
	}
	
	function edit_video_class($param1 = null, $param2 = null, $param3 = null){

        $page_data['video_class_id'] = $param1;
        $page_data['page_name'] = 'edit_video_class';
		$page_data['page_title'] = get_phrase('edit_video_class');
		$this->load->view('backend/index', $page_data);
    }
	
	
	
	 /**************** function to manage leave application by teacher ***************/
    function leave($param1 = '', $param2 = ''){
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');
        
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
		if ($this->session->userdata('teacher_login') != 1)
		redirect(base_url(), 'refresh');
			
		$page_data['page_name']     = 'award';
		$page_data['page_title']    = get_phrase('List Awards');
		$this->load->view('backend/index', $page_data);
		}
        /*********  / function for awards ************/
        



        function jitsi($param1 = null, $param2 = null, $param3 = null){


            if($param1 == 'add'){
                $this->live_class_model->createNewJitsiClassFunction();
                $this->session->set_flashdata('flash_message', get_phrase('live_class_successfuly_created'));
                redirect(base_url() . 'teacher/jitsi/', 'refresh');
            }
    
            if($param1 == 'edit'){
                $this->live_class_model->updateJitsiClassFunction($param2);
                $this->session->set_flashdata('flash_message', get_phrase('live_class_successfuly_updated'));
                redirect(base_url() . 'teacher/jitsi/', 'refresh');
            }
    
            if($param1 == 'delete'){
                $this->live_class_model->deleteJitsiClassFunction($param2);
                $this->session->set_flashdata('flash_message', get_phrase('live_class_successfuly_deleted'));
                redirect(base_url() . 'teacher/jitsi/', 'refresh');
            }
    
            $page_data['page_name'] = 'jitsi';
            $page_data['page_title'] = get_phrase('jitsi_live_class');
            $this->load->view('backend/index',$page_data);
        }
    
        function edit_jitsi($jitsi_id){
    
            $page_data['page_name'] = 'edit_jitsi';
            $page_data['page_title'] = get_phrase('edit_jitsi');
            $page_data['toSelectFromJitsiWithId'] = $this->live_class_model->toSelectFromJitsiWithId($jitsi_id);
            $this->load->view('backend/index',$page_data);
        }
    
    
        function stream_jitsi($jitsi_id){
            
            $page_data['jitsi_id'] = $jitsi_id;
            $this->load->view('backend/host/jitsi', $page_data);
    
        }
		
		
		
	function student_remarks($param1 = "" , $stu_rem_id = "") {
		
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
			redirect(base_url(). $this->session->userdata('login_type').'/marks', 'refresh');
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
			redirect($_SERVER['HTTP_REFERER']);
		}	
		
	}	
	
	
	
	
	



}