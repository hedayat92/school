<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Crud_model extends CI_Model { 
	
	function __construct()
    {
        parent::__construct();
    }


	 function get_type_name_by_id($type, $type_id = '', $field = 'name') {
        $this->db->where($type . '_id', $type_id);
        $query = $this->db->get($type);
        $result = $query->result_array();
        foreach ($result as $row)
        return $row[$field];
    }

    /**** Function to select all messages in ascending order ****/
    function get_general_messages(){
        $query = $this->db->query("SELECT * FROM general_message ORDER BY general_message_id asc");
        return $query->result_array();
    }

  
     function get_image_url($type = '', $id = '') {
        if (file_exists('uploads/' . $type . '_image/' . $id . '.jpg'))
            $image_url = base_url() . 'uploads/' . $type . '_image/' . $id . '.jpg';
        else
            $image_url = base_url() . 'uploads/user.jpg';
        return $image_url;
    }

    function get_subject_name_by_id ($subject_id){
        $query = $this->db->get_where('subject', array('subject_id' => $subject_id))->row();
            return $query->name;
    }

    function get_class_name ($class_id){
        $query = $this->db->get_where('class', array('class_id' => $class_id));
        $result = $query->result_array();
        foreach ($result as $key => $row)
                return $row['name'];

    }

    function get_teachers() {
        $query = $this->db->get('teacher');
        return $query->result_array();
    }


    function get_teacher_name($teacher_id) {
        $query = $this->db->get_where('teacher', array('teacher_id' => $teacher_id));
        $res = $query->result_array();
        foreach ($res as $row)
            return $row['name'];
    }
	
	
	 function get_student_info_by_id($student_id) {
        $query = $this->db->get_where('student', array('student_id' => $student_id))->row_array();
        return $query;
    }

    function get_admin_name($admin_id) {
        $query = $this->db->get_where('admin', array('admin_id' => $admin_id));
        $resi = $query->result_array();
        foreach ($resi as $row)
            return $row['name'];
    }

    function get_teacher_info($teacher_id) {
        $query = $this->db->get_where('teacher', array('teacher_id' => $teacher_id));
        return $query->result_array();
    }


    function get_invoice_info() {
        $query = $this->db->get('invoice');
        return $query->result_array();
    }

    /***********  Subjects  *******************/
    function get_subjects() {
        $query = $this->db->get('subject');
        return $query->result_array();
    }

    function get_subject_info($subject_id) {
        $query = $this->db->get_where('subject', array('subject_id' => $subject_id));
        return $query->result_array();
    }

    function get_subjects_by_class($class_id) {
        $query = $this->db->get_where('subject', array('class_id' => $class_id));
        return $query->result_array();
    }


    function get_class_name_numeric($class_id) {
        $query = $this->db->get_where('class', array('class_id' => $class_id));
        $res = $query->result_array();
        foreach ($res as $row)
            return $row['name_numeric'];
    }

    function get_classes() {
        $query = $this->db->get('class');
        return $query->result_array();
    }

    function get_class_info($class_id) {
        $query = $this->db->get_where('class', array('class_id' => $class_id));
        return $query->result_array();
    }

    /***********  Exams  *******************/
    function get_exams() {
        $query = $this->db->get('exam');
        return $query->result_array();
    }

    function get_exam_info($exam_id) {
        $query = $this->db->get_where('exam', array('exam_id' => $exam_id));
        return $query->result_array();
    }

    /***********  Grades  *******************/
    function get_grades() {
        $query = $this->db->get('grade');
        return $query->result_array();
    }

    function get_grade_info($grade_id) {
        $query = $this->db->get_where('grade', array('grade_id' => $grade_id));
        return $query->result_array();
    }
	
	function get_obtained_marks($exam_id, $class_id, $subject_id, $student_id, $term, $session) {
        $marks = $this->db->get_where('mark', array(
                    'subject_id' => $subject_id,
                    'exam_id' => $exam_id,
                    'class_id' => $class_id,
                    'student_id' => $student_id, 'term' => $term, 'session' => $session))->result_array();

        foreach ($marks as $row) {
            echo $row['exam_score'];
        }
    }
	
	

    function get_highest_marks($exam_id, $class_id, $subject_id, $term, $session) {
        $this->db->where('exam_id', $exam_id);
        $this->db->where('class_id', $class_id);
        $this->db->where('subject_id', $subject_id);
		$this->db->where('term', $term);
		$this->db->where('session', $session);
		
		
        $this->db->select_max('exam_score');
        $highest_marks = $this->db->get('mark')->result_array();
        foreach ($highest_marks as $row) {
            echo $row['exam_score'];
        }
    }
	
	
    function get_highest_marks_first($exam_id, $class_id, $subject_id, $term) {
        $this->db->where('exam_id', $exam_id);
        $this->db->where('class_id', $class_id);
        $this->db->where('subject_id', $subject_id);
		$this->db->where('term', $term);
        $this->db->select_max('sum_first');
        $highest_marks = $this->db->get('mark')->result_array();
        foreach ($highest_marks as $row) {
            $highest =  $row['sum_first'];
			if($highest == 0)
			echo "";
			else
			echo $highest;
        }
    }
	
	
    function get_lowest_marks_first($exam_id, $class_id, $subject_id, $term) {
        $this->db->where('exam_id', $exam_id);
        $this->db->where('class_id', $class_id);
        $this->db->where('subject_id', $subject_id);
		$this->db->where('term', $term);
        $this->db->select_min('sum_first');
        $highest_marks = $this->db->get('mark')->result_array();
        foreach ($highest_marks as $row) {
            $lowest =  $row['sum_first'];
			if($lowest == 0)
			echo "";
			else
			echo $lowest;
        }
    }
	
	
	function get_highest_marks_second($exam_id, $class_id, $subject_id, $term) {
        $this->db->where('exam_id', $exam_id);
        $this->db->where('class_id', $class_id);
        $this->db->where('subject_id', $subject_id);
		$this->db->where('term', $term);
        $this->db->select_max('sum_second');
        $highest_marks = $this->db->get('mark')->result_array();
        foreach ($highest_marks as $row) {
            $highest =  $row['sum_second'];
			if($highest == 0)
			echo "";
			else
			echo $highest;
        }
    }
	
	
    function get_lowest_marks_second($exam_id, $class_id, $subject_id, $term) {
        $this->db->where('exam_id', $exam_id);
        $this->db->where('class_id', $class_id);
        $this->db->where('subject_id', $subject_id);
		$this->db->where('term', $term);
        $this->db->select_min('sum_second');
        $highest_marks = $this->db->get('mark')->result_array();
        foreach ($highest_marks as $row) {
            $lowest =  $row['sum_second'];
			if($lowest == 0)
			echo "";
			else
			echo $lowest ;
        }
    }
	
	
	
	function get_highest_marks_third($exam_id, $class_id, $subject_id, $term) {
        $this->db->where('exam_id', $exam_id);
        $this->db->where('class_id', $class_id);
        $this->db->where('subject_id', $subject_id);
		$this->db->where('term', $term);
        $this->db->select_max('sum_third');
        $highest_marks = $this->db->get('mark')->result_array();
        foreach ($highest_marks as $row) {
            $highest =  $row['sum_third'];
			if($highest == 0)
			echo "";
			else
			echo $highest;
        }
    }
	
	
    function get_lowest_marks_third($exam_id, $class_id, $subject_id, $term) {
        $this->db->where('exam_id', $exam_id);
        $this->db->where('class_id', $class_id);
        $this->db->where('subject_id', $subject_id);
		$this->db->where('term', $term);
        $this->db->select_min('sum_third');
        $highest_marks = $this->db->get('mark')->result_array();
        foreach ($highest_marks as $row) {
            $lowest =  $row['sum_third'];
			if($lowest == 0)
			echo "";
			else
			echo $lowest;
        }
    }


    function get_grade($exam_score) {
        $query = $this->db->get('grade');
        $grades = $query->result_array();
        foreach ($grades as $row) {
            if ($mark_obtained >= $row['mark_from'] && $exam_score <= $row['mark_upto'])
                return $row;
        }
    }

    function get_students($class_id){
        $query = $this->db->get_where('student', array('class_id' => $class_id));
        return $query->result_array();
    }
	
	
    function get_section_students($class_id, $section_id){
        $query = $this->db->get_where('student', array('class_id' => $class_id, 'section_id' => $section_id));
        return $query->result_array();
    }

    /**** Function to select all students from student's table ****/
    function list_all_student_and_order_with_student_id(){

        $data = array();
        $sql = "select * from student order by student_id desc limit 0, 5";
        $all_student_selected = $this->db->query($sql)->result_array();

        foreach($all_student_selected as $key => $selected_students_from_student_table){
            $student_id = $selected_students_from_student_table['student_id'];
            $face_file = 'uploads/student_image/'. $student_id . '.jpg';
            if(!file_exists($face_file)){
                $face_file = 'uploads/student_image/default_image.jpg/';
            }
            $selected_students_from_student_table['face_file'] = base_url() . $face_file;
            array_push($data, $selected_students_from_student_table);
        }
        return $data;
    }

    /**** Function to select all teachers from teacher's table ****/
    function list_all_teacher_and_order_with_teacher_id(){

        $data = array();
        $sql = "select * from teacher order by teacher_id desc limit 0, 5";
        $all_teacher_selected = $this->db->query($sql)->result_array();

        foreach($all_teacher_selected as $key => $selected_teachers_from_teacher_table){
            $teacher_id = $selected_teachers_from_teacher_table['teacher_id'];
            $face_file = 'uploads/teacher_image/'. $teacher_id . '.jpg';
            if(!file_exists($face_file)){
                $face_file = 'uploads/teacher_image/default_image.jpg/';
            }

            $selected_teachers_from_teacher_table['face_file'] = base_url() . $face_file;
            array_push($data, $selected_teachers_from_teacher_table);
        }

        return $data;
    }


    function enquiry_category(){

        $page_data['category']  =   $this->input->post('category');
        $page_data['purpose']   =   $this->input->post('purpose');
        $page_data['whom']      =   $this->input->post('whom');
		$this->security->xss_clean($page_data);
        $this->db->insert('enquiry_category', $page_data);
    }

    function update_category($param2){
        $page_data['category']  =   $this->input->post('category');
        $page_data['purpose']   =   $this->input->post('purpose');
        $page_data['whom']      =   $this->input->post('whom');
		
		$this->security->xss_clean($page_data);
		
        $this->db->where('enquiry_category_id', $param2);
        $this->db->update('enquiry_category', $page_data);

    }

    function delete_category($param2){
        $this->db->where('enquiry_category_id', $param2);
        $this->db->delete('enquiry_category');

    }

    function delete_enquiry($param2){
        $this->db->where('enquiry_id', $param2);
        $this->db->delete('enquiry');
    }

    function insert_club(){

        $page_data['club_name']     =   $this->input->post('club_name');
        $page_data['desc']          =   $this->input->post('desc');
        $page_data['date']          =   $this->input->post('date');

		$this->security->xss_clean($page_data);
        $this->db->insert('club', $page_data);
    }

    function update_club($param2){

        $page_data['club_name']     =   $this->input->post('club_name');
        $page_data['desc']          =   $this->input->post('desc');
        $page_data['date']          =   $this->input->post('date');
		
		$this->security->xss_clean($page_data);
        $this->db->where('club_id', $param2);
        $this->db->update('club', $page_data);
    }


    function delete_club($param2){
        $this->db->where('club_id', $param2);
        $this->db->delete('club');
    }


    function insert_circular(){

        $page_data['title']         =   $this->input->post('title');
        $page_data['reference']     =   $this->input->post('reference');
        $page_data['content']       =   $this->input->post('content');
        $page_data['date']          =   $this->input->post('date');
		
		$this->security->xss_clean($page_data);
        $this->db->insert('circular', $page_data);

    }

    function update_circular($param2){
        $page_data['title']         =   $this->input->post('title');
        $page_data['reference']     =   $this->input->post('reference');
        $page_data['content']       =   $this->input->post('content');
        $page_data['date']          =   $this->input->post('date');
		
		$this->security->xss_clean($page_data);
        $this->db->where('circular_id', $param2);
        $this->db->update('circular', $page_data);
    }


    function delete_circular($param2){
        $this->db->where('circular_id', $param2);
        $this->db->delete('circular');
    }


    function insert_parent(){

        $page_data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
			'password' => sha1($this->input->post('password')),
			'phone' => $this->input->post('phone'),
        	'address' => $this->input->post('address'),
        	'profession' => $this->input->post('profession')
			);
		
		$this->security->xss_clean($page_data);
        $this->db->insert('parent', $page_data);
    }


    function update_parent($param2){
        $page_data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
			'phone' => $this->input->post('phone'),
        	'address' => $this->input->post('address'),
        	'profession' => $this->input->post('profession')
			);
		
		$this->security->xss_clean($page_data);
        $this->db->where('parent_id', $param2);
        $this->db->update('parent', $page_data);
    }

    function delete_parent($param2){
        $this->db->where('parent_id', $param2);
        $this->db->delete('parent');
    }

    function insert_librarian(){
	
		
        $page_data = array(		// array data that postulate the input fileds
            'name' 				=> $this->input->post('name'),
            'librarian_number' 	=> $this->input->post('librarian_number'),
            'birthday' 			=> $this->input->post('birthday'),
            'sex' 				=> $this->input->post('sex'),
            'religion' 			=> $this->input->post('religion'),
            'blood_group' 		=> $this->input->post('blood_group'),
            'address' 			=> $this->input->post('address'),
            'phone' 			=> $this->input->post('phone'),
            'facebook' 			=> $this->input->post('facebook'),
            'twitter' 			=> $this->input->post('twitter'),
            'googleplus' 		=> $this->input->post('googleplus'),
            'linkedin' 			=> $this->input->post('linkedin'),
            'qualification' 	=> $this->input->post('qualification'),
            'marital_status'	=> $this->input->post('marital_status'),
            'password' 			=> sha1($this->input->post('password')),
			'department_id'     => $this->input->post('department_id'),
            'designation_id'    => $this->input->post('designation_id'),
            'date_of_joining'   => $this->input->post('date_of_joining'),
            'joining_salary'    => $this->input->post('joining_salary'),
			'status'            => $this->input->post('status'),
			'date_of_leaving'   => $this->input->post('date_of_leaving'),
			'account_holder_name' => $this->input->post('account_holder_name'),
			'account_number'      => $this->input->post('account_number'),
			'bank_name'       	=> $this->input->post('bank_name'),
			'branch'       		=> $this->input->post('branch')
            );
			
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		
        $page_data['session'] =   get_settings('session');
        $page_data['file_name'] = $_FILES["file_name"]["name"];
		$page_data['email'] = $this->input->post('email');
		
		$sql = "select * from librarian order by librarian_id desc limit 1";
		$return_query = $this->db->query($sql)->row()->librarian_id + 1;
		$page_data['librarian_id'] = $return_query;
		
		$check_email = $this->db->get_where('librarian', array('email' => $page_data['email']))->row()->email;	// checking if email exists in database
		if($check_email != null) {
			$this->session->set_flashdata('error_message', get_phrase('email_already_exist'));
			redirect(base_url() . 'admin/librarian', 'refresh');
		}
		else{
			
			//uploading file1 using codeigniter upload library	
			$this->load->library('upload');		
			$config['upload_path'] 				= 'uploads/librarian_image/';
			$config['allowed_types'] 			= 'doc|docx|jpeg|jpg|JPEG|pdf';
			$config['max_size'] 				= '3000000';
			$config['overwrite']            	= true;
	
			$this->upload->initialize($config);
			if( ! $this->upload->do_upload('file_name')){
				$this->session->set_flashdata('error_message', $this->upload->display_errors());
				redirect(base_url() . 'admin/librarian', 'refresh');
			}
			
		
		/*
		//uploading file1 using codeigniter upload library
		$this->load->library('upload');
		$librarian = $return_query . '.jpg';
		$config1['upload_path'] 			= 'uploads/librarian_image/';
		$config1['allowed_types'] 			= 'jpeg|jpg|JPEG|png|PNG|JPG';
		$config1['max_size'] 				= '3000000';
		$config1['max_width'] 				= '1024';
		$config1['max_height'] 				= '768';
		$config1['file_name']            	= $librarian;
		$config1['overwrite']            	= true;

		$this->upload->initialize($config1);
		if( ! $this->upload->do_upload('userfile')){
			$this->session->set_flashdata('error_message', $this->upload->display_errors());
			redirect(base_url() . 'admin/librarian', 'refresh');
		}
		*/
		
			$this->security->xss_clean($page_data);
		
        	$this->db->insert('librarian', $page_data);
        	$librarian_id = $this->db->insert_id();
       		move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/librarian_image/' . $librarian_id . '.jpg');			// image with user ID
			//$this->email_model->account_opening_email('librarian', $email, $password); //Send email to student for registration acknoledgement
			}
    	}

    function update_librarian($param2){
        $page_data = array(			// array starts from here
            'name'				=> $this->input->post('name'),
            'birthday'			=> $this->input->post('birthday'),
            'sex' 				=> $this->input->post('sex'),
            'religion' 			=> $this->input->post('religion'),
            'blood_group' 		=> $this->input->post('blood_group'),
            'address' 			=> $this->input->post('address'),
            'phone' 			=> $this->input->post('phone'),
            'email' 			=> $this->input->post('email'),
            'facebook' 			=> $this->input->post('facebook'),
            'twitter' 			=> $this->input->post('twitter'),
            'googleplus' 		=> $this->input->post('googleplus'),
            'linkedin' 			=> $this->input->post('linkedin'),
            'qualification' 	=> $this->input->post('qualification'),
            'marital_status' 	=> $this->input->post('marital_status'),
			'department_id'     => $this->input->post('department_id'),
            'designation_id'    => $this->input->post('designation_id'),
            'date_of_joining'   => $this->input->post('date_of_joining'),
            'joining_salary'    => $this->input->post('joining_salary'),
			'status'            => $this->input->post('status'),
			'date_of_leaving'   => $this->input->post('date_of_leaving'),
			'account_holder_name' => $this->input->post('account_holder_name'),
			'account_number'      => $this->input->post('account_number'),
			'bank_name'       	=> $this->input->post('bank_name'),
			'branch'       		=> $this->input->post('branch')
            );

                $this->db->where('librarian_id', $param2);
                $this->db->update('librarian', $page_data);
                move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/librarian_image/' . $param2 . '.jpg');            
    }

	
	function delete_librarian($param2){

		$ImagePath = $this->db->get_where('librarian', array('librarian_id' => $param2))->row()->librarian_id;
		$FilePath = $this->db->get_where('librarian', array('librarian_id' => $param2))->row()->file_name;
          if (file_exists('uploads/librarian_image/'.$ImagePath.'.jpg')) {
            	unlink('uploads/librarian_image/'.$ImagePath.'.jpg');
          }
		  if (file_exists('uploads/librarian_image/'.$FilePath)) {
            	unlink('uploads/librarian_image/'.$FilePath);
          }
        $this->db->where('librarian_id', $param2);
        $this->db->delete('librarian');
    }




    function insert_accountant(){
        $page_data = array(		// array data that postulate the input fileds
            'name' 				=> $this->input->post('name'),
            'accountant_number' 	=> $this->input->post('accountant_number'),
            'birthday' 			=> $this->input->post('birthday'),
            'sex' 				=> $this->input->post('sex'),
            'religion' 			=> $this->input->post('religion'),
            'blood_group' 		=> $this->input->post('blood_group'),
            'address' 			=> $this->input->post('address'),
            'phone' 			=> $this->input->post('phone'),
            'facebook' 			=> $this->input->post('facebook'),
            'twitter' 			=> $this->input->post('twitter'),
            'googleplus' 		=> $this->input->post('googleplus'),
            'linkedin' 			=> $this->input->post('linkedin'),
            'qualification' 	=> $this->input->post('qualification'),
            'marital_status'	=> $this->input->post('marital_status'),
            'password' 			=> sha1($this->input->post('password')),
			'department_id'     => $this->input->post('department_id'),
            'designation_id'    => $this->input->post('designation_id'),
            'date_of_joining'   => $this->input->post('date_of_joining'),
            'joining_salary'    => $this->input->post('joining_salary'),
			'status'            => $this->input->post('status'),
			'date_of_leaving'   => $this->input->post('date_of_leaving'),
			'account_holder_name' => $this->input->post('account_holder_name'),
			'account_number'      => $this->input->post('account_number'),
			'bank_name'       	=> $this->input->post('bank_name'),
			'branch'       		=> $this->input->post('branch')
            );
			
		
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		
        $page_data['session'] =   get_settings('session');    
        $page_data['file_name'] = $_FILES["file_name"]["name"];
		
		$sql = "select * from accountant order by accountant_id desc limit 1";
		$return_query = $this->db->query($sql)->row()->accountant_id + 1;
		$page_data['accountant_id'] = $return_query;
		
		$page_data['email'] = $this->input->post('email');
		$check_email = $this->db->get_where('accountant', array('email' => $page_data['email']))->row()->email;	// checking if email exists in database
		if($check_email != null) 
		{
		$this->session->set_flashdata('error_message', get_phrase('email_already_exist'));
        redirect(base_url() . 'admin/accountant/', 'refresh');
		}
		else{

			//uploading file1 using codeigniter upload library
			//$files = $_FILES['file_name'];
			$this->load->library('upload');
			$config['upload_path'] 				= 'uploads/accountant_image/';
			$config['allowed_types'] 			= 'doc|docx|jpeg|jpg|JPEG|pdf';
			$config['max_size'] 				= '3000000';
			$config['overwrite']            	= true;
	
			$this->upload->initialize($config);
			if( ! $this->upload->do_upload('file_name')){
				$this->session->set_flashdata('error_message', $this->upload->display_errors());
				redirect(base_url() . 'admin/accountant', 'refresh');
			}
		
		
			$this->security->xss_clean($page_data);
		
        	$this->db->insert('accountant', $page_data);
        	$accountant_id = $this->db->insert_id();
		
        	move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/accountant_image/' . $accountant_id . '.jpg');			// image with user ID
			//$this->email_model->account_opening_email('accountant', $email, $password); //Send email to student for registration acknoledgement
            }
    }




    function update_accountant($param2){
        $page_data = array(			// array starts from here
            'name'				=> $this->input->post('name'),
            'birthday'			=> $this->input->post('birthday'),
            'sex' 				=> $this->input->post('sex'),
            'religion' 			=> $this->input->post('religion'),
            'blood_group' 		=> $this->input->post('blood_group'),
            'address' 			=> $this->input->post('address'),
            'phone' 			=> $this->input->post('phone'),
            'email' 			=> $this->input->post('email'),
            'facebook' 			=> $this->input->post('facebook'),
            'twitter' 			=> $this->input->post('twitter'),
            'googleplus' 		=> $this->input->post('googleplus'),
            'linkedin' 			=> $this->input->post('linkedin'),
            'qualification' 	=> $this->input->post('qualification'),
            'marital_status' 	=> $this->input->post('marital_status'),
			'department_id'     => $this->input->post('department_id'),
            'designation_id'    => $this->input->post('designation_id'),
            'date_of_joining'   => $this->input->post('date_of_joining'),
            'joining_salary'    => $this->input->post('joining_salary'),
			'status'            => $this->input->post('status'),
			'date_of_leaving'   => $this->input->post('date_of_leaving'),
			'account_holder_name' => $this->input->post('account_holder_name'),
			'account_number'      => $this->input->post('account_number'),
			'bank_name'       	=> $this->input->post('bank_name'),
			'branch'       		=> $this->input->post('branch')
            );

                $this->db->where('accountant_id', $param2);
                $this->db->update('accountant', $page_data);
                move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/accountant_image/' . $param2 . '.jpg');            
    }

		function delete_accountant($param2){
	
			$ImagePath = $this->db->get_where('accountant', array('accountant_id' => $param2))->row()->accountant_id;
			$FilePath = $this->db->get_where('accountant', array('accountant_id' => $param2))->row()->file_name;
			  if (file_exists('uploads/accountant_image/'.$ImagePath.'.jpg')) {
					unlink('uploads/accountant_image/'.$ImagePath.'.jpg');
			  }
			  if (file_exists('uploads/accountant_image/'.$FilePath)) {
					unlink('uploads/accountant_image/'.$FilePath);
			  }
			$this->db->where('accountant_id', $param2);
			$this->db->delete('accountant');
		}




    function insert_hostel(){
        $page_data = array(		// array data that postulate the input fileds
            'name' 				=> $this->input->post('name'),
            'hostel_number' 	=> $this->input->post('hostel_number'),
            'birthday' 			=> $this->input->post('birthday'),
            'sex' 				=> $this->input->post('sex'),
            'religion' 			=> $this->input->post('religion'),
            'blood_group' 		=> $this->input->post('blood_group'),
            'address' 			=> $this->input->post('address'),
            'phone' 			=> $this->input->post('phone'),
            'facebook' 			=> $this->input->post('facebook'),
            'twitter' 			=> $this->input->post('twitter'),
            'googleplus' 		=> $this->input->post('googleplus'),
            'linkedin' 			=> $this->input->post('linkedin'),
            'qualification' 	=> $this->input->post('qualification'),
            'marital_status'	=> $this->input->post('marital_status'),
            'password' 			=> sha1($this->input->post('password')),
			'department_id'     => $this->input->post('department_id'),
            'designation_id'    => $this->input->post('designation_id'),
            'date_of_joining'   => $this->input->post('date_of_joining'),
            'joining_salary'    => $this->input->post('joining_salary'),
			'status'            => $this->input->post('status'),
			'date_of_leaving'   => $this->input->post('date_of_leaving'),
			'account_holder_name' => $this->input->post('account_holder_name'),
			'account_number'      => $this->input->post('account_number'),
			'bank_name'       	=> $this->input->post('bank_name'),
			'branch'       		=> $this->input->post('branch')
            );
		
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		
        $page_data['session'] =   get_settings('session');    
        $page_data['file_name'] = $_FILES["file_name"]["name"];
		
		$sql = "select * from hostel order by hostel_id desc limit 1";
		$return_query = $this->db->query($sql)->row()->hostel_id + 1;
		$page_data['hostel_id'] = $return_query;
		
		$page_data['email'] = $this->input->post('email');
		$check_email = $this->db->get_where('hostel', array('email' => $page_data['email']))->row()->email;	// checking if email exists in database
		if($check_email != null) 
		{
		$this->session->set_flashdata('error_message', get_phrase('email_already_exist'));
        redirect(base_url() . 'admin/hostel/', 'refresh');
		}
		else{
			//uploading file1 using codeigniter upload library
			//$files = $_FILES['file_name'];
			$this->load->library('upload');
			$config['upload_path'] 				= 'uploads/hostel_image/';
			$config['allowed_types'] 			= 'doc|docx|jpeg|jpg|JPEG|pdf';
			$config['max_size'] 				= '3000000';
			$config['overwrite']            	= true;
	
			$this->upload->initialize($config);
			if( ! $this->upload->do_upload('file_name')){
				$this->session->set_flashdata('error_message', $this->upload->display_errors());
				redirect(base_url() . 'admin/hostel', 'refresh');
			}
		
		
			$this->security->xss_clean($page_data);
		
			$this->db->insert('hostel', $page_data);
			$hostel_id = $this->db->insert_id();
		
        	move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/hostel_image/' . $hostel_id . '.jpg');			// image with user ID
			//$this->email_model->account_opening_email('hostel', $email, $password); //Send email to student for registration acknoledgement
            }
    }

    
    function update_hostel($param2){
        $page_data = array(			// array starts from here
            'name'				=> $this->input->post('name'),
            'birthday'			=> $this->input->post('birthday'),
            'sex' 				=> $this->input->post('sex'),
            'religion' 			=> $this->input->post('religion'),
            'blood_group' 		=> $this->input->post('blood_group'),
            'address' 			=> $this->input->post('address'),
            'phone' 			=> $this->input->post('phone'),
            'email' 			=> $this->input->post('email'),
            'facebook' 			=> $this->input->post('facebook'),
            'twitter' 			=> $this->input->post('twitter'),
            'googleplus' 		=> $this->input->post('googleplus'),
            'linkedin' 			=> $this->input->post('linkedin'),
            'qualification' 	=> $this->input->post('qualification'),
            'marital_status' 	=> $this->input->post('marital_status'),
			'department_id'     => $this->input->post('department_id'),
            'designation_id'    => $this->input->post('designation_id'),
            'date_of_joining'   => $this->input->post('date_of_joining'),
            'joining_salary'    => $this->input->post('joining_salary'),
			'status'            => $this->input->post('status'),
			'date_of_leaving'   => $this->input->post('date_of_leaving'),
			'account_holder_name' => $this->input->post('account_holder_name'),
			'account_number'      => $this->input->post('account_number'),
			'bank_name'       	=> $this->input->post('bank_name'),
			'branch'       		=> $this->input->post('branch')
            );

                $this->db->where('hostel_id', $param2);
                $this->db->update('hostel', $page_data);
                move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/hostel_image/' . $param2 . '.jpg');            
    }
	
	
	
			function delete_hostel($param2){
	
			$ImagePath = $this->db->get_where('hostel', array('hostel_id' => $param2))->row()->hostel_id;
			$FilePath = $this->db->get_where('hostel', array('hostel_id' => $param2))->row()->file_name;
			  if (file_exists('uploads/hostel_image/'.$ImagePath.'.jpg')) {
					unlink('uploads/hostel_image/'.$ImagePath.'.jpg');
			  }
			  if (file_exists('uploads/hostel_image/'.$FilePath)) {
					unlink('uploads/hostel_image/'.$FilePath);
			  }
			$this->db->where('hostel_id', $param2);
			$this->db->delete('hostel');
		}


    function insert_hrm(){
        $page_data = array(		// array data that postulate the input fileds
            'name' 				=> $this->input->post('name'),
            'hrm_number' 	    => $this->input->post('hrm_number'),
            'birthday' 			=> $this->input->post('birthday'),
            'sex' 				=> $this->input->post('sex'),
            'religion' 			=> $this->input->post('religion'),
            'blood_group' 		=> $this->input->post('blood_group'),
            'address' 			=> $this->input->post('address'),
            'phone' 			=> $this->input->post('phone'),
            'facebook' 			=> $this->input->post('facebook'),
            'twitter' 			=> $this->input->post('twitter'),
            'googleplus' 		=> $this->input->post('googleplus'),
            'linkedin' 			=> $this->input->post('linkedin'),
            'qualification' 	=> $this->input->post('qualification'),
            'marital_status'	=> $this->input->post('marital_status'),
            'password' 			=> sha1($this->input->post('password')),
			'department_id'     => $this->input->post('department_id'),
            'designation_id'    => $this->input->post('designation_id'),
            'date_of_joining'   => $this->input->post('date_of_joining'),
            'joining_salary'    => $this->input->post('joining_salary'),
			'status'            => $this->input->post('status'),
			'date_of_leaving'   => $this->input->post('date_of_leaving'),
			'account_holder_name' => $this->input->post('account_holder_name'),
			'account_number'      => $this->input->post('account_number'),
			'bank_name'       	=> $this->input->post('bank_name'),
			'branch'       		=> $this->input->post('branch')
            );
			
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		
        $page_data['session'] =   get_settings('session');   
        $page_data['file_name'] = $_FILES["file_name"]["name"];
		
		$sql = "select * from hrm order by hrm_id desc limit 1";
		$return_query = $this->db->query($sql)->row()->hrm_id + 1;
		$page_data['hrm_id'] = $return_query;
		
		$page_data['email'] = $this->input->post('email');
		$check_email = $this->db->get_where('hrm', array('email' => $page_data['email']))->row()->email;	// checking if email exists in database
		if($check_email != null) 
		{
		$this->session->set_flashdata('error_message', get_phrase('email_already_exist'));
        redirect(base_url() . 'admin/hrm/', 'refresh');
		}
		else{
			//uploading file1 using codeigniter upload library
			//$files = $_FILES['file_name'];
			$this->load->library('upload');
			$config['upload_path'] 				= 'uploads/hrm_image/';
			$config['allowed_types'] 			= 'doc|docx|jpeg|jpg|JPEG|pdf';
			$config['max_size'] 				= '3000000';
			$config['overwrite']            	= true;
	
			$this->upload->initialize($config);
			if( ! $this->upload->do_upload('file_name')){
				$this->session->set_flashdata('error_message', $this->upload->display_errors());
				redirect(base_url() . 'admin/hrm', 'refresh');
			}
			$this->security->xss_clean($page_data);
			
			
			$this->db->insert('hrm', $page_data);
			$hrm_id = $this->db->insert_id();
		
        	move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/hrm_image/' . $hrm_id . '.jpg');			// image with user ID
			//$this->email_model->account_opening_email('hrm', $email, $password); //Send email to student for registration acknoledgement
            }
    }


    function update_hrm($param2){
        $page_data = array(			// array starts from here
            'name'				=> $this->input->post('name'),
            'birthday'			=> $this->input->post('birthday'),
            'sex' 				=> $this->input->post('sex'),
            'religion' 			=> $this->input->post('religion'),
            'blood_group' 		=> $this->input->post('blood_group'),
            'address' 			=> $this->input->post('address'),
            'phone' 			=> $this->input->post('phone'),
            'email' 			=> $this->input->post('email'),
            'facebook' 			=> $this->input->post('facebook'),
            'twitter' 			=> $this->input->post('twitter'),
            'googleplus' 		=> $this->input->post('googleplus'),
            'linkedin' 			=> $this->input->post('linkedin'),
            'qualification' 	=> $this->input->post('qualification'),
            'marital_status' 	=> $this->input->post('marital_status'),
			'department_id'     => $this->input->post('department_id'),
            'designation_id'    => $this->input->post('designation_id'),
            'date_of_joining'   => $this->input->post('date_of_joining'),
            'joining_salary'    => $this->input->post('joining_salary'),
			'status'            => $this->input->post('status'),
			'date_of_leaving'   => $this->input->post('date_of_leaving'),
			'account_holder_name' => $this->input->post('account_holder_name'),
			'account_number'      => $this->input->post('account_number'),
			'bank_name'       	=> $this->input->post('bank_name'),
			'branch'       		=> $this->input->post('branch')
            );

                $this->db->where('hrm_id', $param2);
                $this->db->update('hrm', $page_data);
                move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/hrm_image/' . $param2 . '.jpg');            
    }
	
	
	function delete_hrm($param2){
	
			$ImagePath = $this->db->get_where('hrm', array('hrm_id' => $param2))->row()->hrm_id;
			$FilePath = $this->db->get_where('hrm', array('hrm_id' => $param2))->row()->file_name;
			  if (file_exists('uploads/hrm_image/'.$ImagePath.'.jpg')) {
					unlink('uploads/hrm_image/'.$ImagePath.'.jpg');
			  }
			  if (file_exists('uploads/hrm_image/'.$FilePath)) {
					unlink('uploads/hrm_image/'.$FilePath);
			  }
			$this->db->where('hrm_id', $param2);
			$this->db->delete('hrm');
		}


		function updateLogoFunction(){
		
			$fixedfilename = true;    // set this flag if you are going upload to a fixed file name
		
			$filename = $_FILES['userfile']['name'];
		
			// check is file is empty
	
		if (empty($filename)) return 1;
	
		
			//Check if file name is valid characters
		
			$validity = (bool) ((preg_match("`^[-0-9A-Z_\.]+$`i",$filename)) ? true : false);
		
			if (!$validity) {
		
			return 2;
	
		}


		// Check file extensions
	
		$validextensions = $ext_type = array('gif','GIF','jpg','JPG','jpe','jpeg','JPEG','PNG','png');
	
		$path_parts = pathinfo($filename);
	
		$fextension = $path_parts['extension'];
	
		if (!in_array($fextension,$validextensions,true)) return 3;
	
	
		// upload if valid file
	
		if ($fixedfilename) {
	
		move_uploaded_file($_FILES['userfile']['tmp_name'],'uploads/logo.png');
	
		} else {
	
		move_uploaded_file($_FILES['userfile']['tmp_name'],'uploads/'.$filename);
	
		}
	
		return 0;
	
		   // move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/logo.png');
		}


    function update_settings(){
	
	
		$data = array();

        $inputs = $this->input->post();

        foreach ($inputs as $var => $value) {

        $page_data['description'] = $value;

        $this->db->where('type', $var);

        $this->db->update('settings', $page_data);
		
		}
    }

    function save_into_school_website_table_model(){
	
		$data = array();

        $inputs = $this->input->post();

        foreach ($inputs as $var => $value) {

			$page_data['description'] = $value;
	
			$this->db->where('type', $var);
	
			$this->db->update('website_settings', $page_data);
		
		}
    }

    function save_banner_into_banner_table_model(){
        $page_data['banner_image'] = $_FILES["banner_image"]["name"];
        $page_data['banner_text'] = $this->input->post('banner_text');
		
			//uploading file1 using codeigniter upload library
			$this->load->library('upload');
			$config['upload_path'] 				= 'uploads/banner_image/';
			$config['allowed_types'] 			= 'jpeg|jpg|JPEG';
			$config['max_size'] 				= '3000000';
			$config['overwrite']            	= true;
	
			$this->upload->initialize($config);
			if( ! $this->upload->do_upload('banner_image')){
				$this->session->set_flashdata('error_message', $this->upload->display_errors());
				redirect(base_url() . 'website/website_setting', 'refresh');
			}
			$this->security->xss_clean($page_data);
		
        	$this->db->insert('banner_table', $page_data);

    }

    function update_testimony_status($param2){

        $page_data['status'] = $this->input->post('status');

        $this->db->where('testimony_id', $param2);
        $this->db->update('testimony_table', $page_data);

    }

    function delete_testimony_status($param2){

        $this->db->where('testimony_id', $param2);
        $this->db->delete('testimony_table');
    }


    function update_theme(){

        $data['description']    =   $this->input->post('skin_colour');
        $this->db->where('type', 'skin_colour');
        $this->db->update('settings', $data);
    }

    function get_settings($type){
        $row = $this->db->get_where('settings', array('type' => $type))->row();
        if ($row && isset($row->description)) {
            return $row->description;
        }
        return '';
    }


    function stripe_settings (){
        $stripe_info = array();

        $stripe['stripe_active']    = html_escape($this->input->post('stripe_active'));
        $stripe['testmode']         = html_escape($this->input->post('testmode'));
        $stripe['secret_key']       = html_escape($this->input->post('secret_key'));
        $stripe['public_key']       = html_escape($this->input->post('public_key'));
        $stripe['secret_live_key']  = html_escape($this->input->post('secret_live_key'));
        $stripe['public_live_key']  = html_escape($this->input->post('public_live_key'));

        array_push($stripe_info, $stripe);

        $data['description'] = json_encode($stripe_info);
        $this->db->where('type', 'stripe_setting');
        $this->db->update('settings', $data);

    }

    function paypal_settings(){
        $paypal_info = array();

        $stripe['paypal_active']    = html_escape($this->input->post('paypal_active'));
        $stripe['paypal_mode']         = html_escape($this->input->post('paypal_mode'));
        $stripe['sandbox_client_id']       = html_escape($this->input->post('sandbox_client_id'));
        $stripe['production_client_id']       = html_escape($this->input->post('production_client_id'));
        
        array_push($paypal_info, $stripe);

        $data['description'] = json_encode($paypal_info);
        $this->db->where('type', 'paypal_setting');
        $this->db->update('settings', $data);


    }

    function razorpay_settings(){
        $razorpay_info = array();

        $razorpay['razorpay_active']    = html_escape($this->input->post('razorpay_active'));
        $razorpay['key_id']             = html_escape($this->input->post('key_id'));
        $razorpay['key_secret']         = html_escape($this->input->post('key_secret'));

        array_push($razorpay_info, $razorpay);

        $data['description'] = json_encode($razorpay_info);
        $existing = $this->db->get_where('settings', array('type' => 'razorpay_setting'))->row();

        if ($existing) {
            $this->db->where('type', 'razorpay_setting');
            $this->db->update('settings', $data);
        } else {
            $data['type'] = 'razorpay_setting';
            $this->db->insert('settings', $data);
        }
    }


   function send_student_score_model(){

        $exam_id = $this->input->post('exam_id');
        $class_id = $this->input->post('class_id');
        $receiver = $this->input->post('receiver');
		$select_subjects = $this->db->get_where('subject', array('class_id' => $class_id))->result_array();
        $select_all_student_from_student_table = $this->db->get_where('student', array('class_id' => $class_id))->result_array();
        foreach ($select_all_student_from_student_table as $key => $all_selected_student_from_student_table){

            if($receiver == 'student')
                $recieverPhoneNumber = $all_selected_student_from_student_table['phone'];
            if($receiver == 'parent' && $all_selected_student_from_student_table['parent_id'] != NULL)
            $recieverPhoneNumber = $this->db->get_where('parent', array('parent_id' => $all_selected_student_from_student_table['parent_id']))->row()->phone;

            $this->db->where('exam_id', $exam_id);
            $this->db->where('student_id', $all_selected_student_from_student_table['student_id']);
            
            foreach($select_subjects as $key => $subject){
               
			$obtained_mark_query = $this->db->get_where('mark', array('class_id' => $class_id, 'subject_id' => $subject['subject_id'], 
			'student_id' => $all_selected_student_from_student_table['student_id'], 'exam_id' => $exam_id));
				
                $message = "Dear parent, your son" . $all_selected_student_from_student_table['name'] . ", round January test marks details are" . 
				$subject['name'].':'.$obtained_mark_query->row()->exam_score.', Total:'.$obtained_mark_query->row()->class_position_first."Login to your portal to view full result.".'- '.get_settings('system_name');

                // Sending   
                //$this->sms_model->send_sms($message, $recieverPhoneNumber);
				//test soft now  ok
				
				
				
									$postData = array(
										'channel' => array(
											'channel' => 120994,
											'password' => 'ZGJkOTBmZTg3ZDAxNGE0MjJlMmZmNzkxYTg4YTViODA3NDhkY2U5OTVmNDFjOTRkN2U1NjBkNWQxYmM3MjNhMA=='),
										'messages' => array(
											array(
												'text' => $message,
												'msisdn' => $recieverPhoneNumber,
												'source' => 'UwataCentre'
											)
										)
									);

									// Setup cURL
									$ch = curl_init('https://secure-gw.fasthub.co.tz/fasthub/messaging/json/api');

									curl_setopt_array($ch, array(
										CURLOPT_POST => TRUE,
										CURLOPT_RETURNTRANSFER => TRUE,
										CURLOPT_HTTPHEADER => array(
											'Content-Type: application/json'
										),
										CURLOPT_POSTFIELDS => json_encode($postData)
									));
									 //Ignore SSL certificate verification
											curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
											curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
									// Send the request
									$responseData = curl_exec($ch);

									if (curl_error($ch)) {
										echo 'not working!:' . curl_error($ch);
									}else{
										echo 'Response from FastHub: '.$responseData;
										 redirect(base_url(). 'admin/exam_marks_sms', 'refresh');

									}
									
				
				
				
				
				
				
            }
     

        }

    }
	
	
	

	
	
	////////private message//////
    function send_new_private_message() {
       
        $message = $this->input->post('message');
        $timestamp = strtotime(date("Y-m-d H:i:s"));
        $sender_type = $this->session->userdata('login_type');
       if ($this->input->post('receiver') != "")
       if($sender_type == 'admin') {
       foreach ($this->input->post('receiver') as $row){
                $data['receiver']  = $row;
        
        $reciever = $row;
        
        $sender = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');

        //check if the thread between those 2 users exists, if not create new thread
        $num1 = $this->db->get_where('message_thread', array('sender' => $sender, 'reciever' => $reciever))->num_rows();
        $num2 = $this->db->get_where('message_thread', array('sender' => $reciever, 'reciever' => $sender))->num_rows();
		
		//check if file is attached or not
        if ($_FILES['attached_file_on_messaging']['name'] != "") {
          $data_message['attached_file_name'] = $_FILES['attached_file_on_messaging']['name'];
        }

        if ($num1 == 0 && $num2 == 0) {
            $message_thread_code = substr(md5(rand(100000000, 20000000000)), 0, 15);
            $data_message_thread['message_thread_code'] = $message_thread_code;
            $data_message_thread['sender'] = $sender;
            $data_message_thread['reciever'] = $reciever;
            $this->db->insert('message_thread', $data_message_thread);
        }
        if ($num1 > 0)
            $message_thread_code = $this->db->get_where('message_thread', array('sender' => $sender, 'reciever' => $reciever))->row()->message_thread_code;
        if ($num2 > 0)
            $message_thread_code = $this->db->get_where('message_thread', array('sender' => $reciever, 'reciever' => $sender))->row()->message_thread_code;


        $data_message['message_thread_code'] = $message_thread_code;
        $data_message['message'] = $message;
        $data_message['sender'] = $sender;
        $data_message['timestamp'] = $timestamp;
		
		$this->security->xss_clean($data_message);
        $this->db->insert('message', $data_message);
       }
       
        } else{
            $data['receiver']  = $this->input->post('receiver');
        
        $reciever = $this->input->post('receiver');
        
        $sender = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');

        //check if the thread between those 2 users exists, if not create new thread
        $num1 = $this->db->get_where('message_thread', array('sender' => $sender, 'reciever' => $reciever))->num_rows();
        $num2 = $this->db->get_where('message_thread', array('sender' => $reciever, 'reciever' => $sender))->num_rows();

        if ($num1 == 0 && $num2 == 0) {
            $message_thread_code = substr(md5(rand(100000000, 20000000000)), 0, 15);
            $data_message_thread['message_thread_code'] = $message_thread_code;
            $data_message_thread['sender'] = $sender;
            $data_message_thread['reciever'] = $reciever;
            $this->db->insert('message_thread', $data_message_thread);
        }
        if ($num1 > 0)
            $message_thread_code = $this->db->get_where('message_thread', array('sender' => $sender, 'reciever' => $reciever))->row()->message_thread_code;
        if ($num2 > 0)
            $message_thread_code = $this->db->get_where('message_thread', array('sender' => $reciever, 'reciever' => $sender))->row()->message_thread_code;


        $data_message['message_thread_code'] = $message_thread_code;
        $data_message['message'] = $message;
        $data_message['sender'] = $sender;
        $data_message['timestamp'] = $timestamp;
        $this->db->insert('message', $data_message);
       }
        // notify email to email reciever
       $this->email_model->notify_email('new_message_notification', $this->db->insert_id());

        return $message_thread_code;
    }

    function send_reply_message($message_thread_code) {
        $message = $this->input->post('message');
        $timestamp = strtotime(date("Y-m-d H:i:s"));
        $sender = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');

		if ($_FILES['attached_file_on_messaging']['name'] != "") {
          $data_message['attached_file_name'] = $_FILES['attached_file_on_messaging']['name'];
        }

        $data_message['message_thread_code'] = $message_thread_code;
        $data_message['message'] = $message;
        $data_message['sender'] = $sender;
        $data_message['timestamp'] = $timestamp;
		
		$this->security->xss_clean($data_message);
        $this->db->insert('message', $data_message);
		$message_id = $this->db->insert_id();

		// notify email to email reciever
		$this->email_model->notify_email('new_message_notification', $this->db->insert_id());
		echo json_encode($data_message);
    }

 function mark_thread_messages_read($message_thread_code) {
// mark read only the oponnent messages of this thread, not currently logged in user's sent messages
        $current_user = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
        $this->db->where('sender !=', $current_user);
        $this->db->where('message_thread_code', $message_thread_code);
        $this->db->update('message', array('read_status' => 1));
    }

    function count_unread_message_of_thread($message_thread_code) {
        $unread_message_counter = 0;
        $current_user = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
        $messages = $this->db->get_where('message', array('message_thread_code' => $message_thread_code))->result_array();
        foreach ($messages as $row) {
            if ($row['sender'] != $current_user && $row['read_status'] == '0')
                $unread_message_counter++;
        }
        return $unread_message_counter;
    }

    function count_unread_message_of_curuser() {
        $current_user = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
        $sql = "select count(a.message_id) counts from message a "
                . " inner join message_thread b on a.message_thread_code=b.message_thread_code "
                . " where b.reciever='" . $current_user . "' and a.read_status=0";
        $row = $this->db->query($sql)->row_array();
        return $row["counts"];
    }

    function unread_message_of_curuser() {
        $data = array();
        $current_user = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
        $sql = "select a.*  from message a "
                . " inner join message_thread b on a.message_thread_code=b.message_thread_code "
                . " where b.reciever='" . $current_user . "' and a.read_status=0";
        $rows = $this->db->query($sql)->result_array();
        foreach ($rows as $row) {
            $sender = explode('-', $row['sender']);
            $sender_type = $sender[0];
            $sender_id = $sender[1];

            $sql = "select name from " . $sender_type . " where " . $sender_type . "_id=" . $sender_id;
            $result = $this->db->query($sql)->row_array();
            $row["sender_name"] = $result["name"];

            $key = $row['sender'];
            $face_file = 'uploads/' . $sender_type . '_image/' . $sender_id . '.jpg';
            if (!file_exists($face_file)) {
                $face_file = 'uploads/default_avatar.jpg';
            }
            $row["face_file"] = base_url() . $face_file;

//            $cur_time = date('Y-m-d H:i:s', time());
//            $send_time =date('Y-m-d H:i:s', $row["timestamp"]);
//            echo $cur_time;
//            $diff = date_diff($cur_time, $send_time);
            $ago = '';
            $sec = time() - $row["timestamp"];
            $year = (int) ($sec / 31556926);
            $month = (int) ($sec / 2592000);
            $day = (int) ($sec / 86400);
            $hou = (int) ($sec / 3600);
            $min = (int) ($sec / 60);
            if ($year > 0) {
                $ago = $year . ' year(s)';
            } else if ($month > 0) {
                $ago = $month . ' month(s)';
            } else if ($day > 0) {
                $ago = $day . ' day(s)';
            } else if ($hou > 0) {
                $ago = $hou . ' hour(s)';
            } else if ($min > 0) {
                $ago = $min . ' minute(s)';
            } else {
                $ago = $sec . ' second(s)';
            }

            $row["ago"] = $ago;

            array_push($data, $row);
        }
        return $data;
    }
	
	
	
	 function create_backup ($type){

        $this->load->dbutil();
		$options = array(
                'format'      => 'txt',             // gzip, zip, txt
                'add_drop'    => TRUE,              // Whether to add DROP TABLE statements to backup file
                'add_insert'  => TRUE,              // Whether to add INSERT data to backup file
                'newline'     => "\n"               // Newline character used in backup file
              );
		if($type == 'all'){
			$tables = array('');
			$file_name	=	'database_backup';
		}

		else {
			$tables = array('tables'	=>	array($type));
			$file_name	=	'backup_'.$type;
		}
		$backup =& $this->dbutil->backup(array_merge($options , $tables)); 
		$this->load->helper('download');
        force_download($file_name.'.sql', $backup);
    }


    function delete_database ($type){

        if($type == 'all'){

            $this->db->truncate('admin');
            $this->db->truncate('doctor');
            $this->db->truncate('nurse');
            $this->db->truncate('donor');
		}
		else{	
		$this->db->truncate($type);
		}

    }
	
	
	
	 function create_leave(){
        $data['leave_code']     = substr(md5(rand(100000000, 20000000000)), 0, 7);
        $data['teacher_id']        = $this->session->userdata('login_type').'-'.$this->session->userdata('login_user_id');
        $data['start_date']     = strtotime($this->input->post('start_date'));
        $data['end_date']       = strtotime($this->input->post('end_date'));
        $data['reason']         = $this->input->post('reason');
        $data['session'] = get_settings('session');
		
		$this->security->xss_clean($data);
        $this->db->insert('leave',$data);
    }
    
    function update_leave($leave_id = ''){
        $data['start_date']     = strtotime($this->input->post('start_date'));
        $data['end_date']       = strtotime($this->input->post('end_date'));
        $data['reason']         = $this->input->post('reason');
        
		$this->security->xss_clean($data);
        $this->db->update('leave', $data, array('leave_id' => $leave_id));
    }
    
    function delete_leave($leave_id = '')
    {
        $this->db->where('leave_id', $leave_id);
        $this->db->delete('leave');
    }


    // Upload Multiple Image codes here//	
	function add_gallery_images($gallery_id) {
        $files = $_FILES;
        $number_of_images = count($_FILES['gallery_images']['name']);
        for ($i=0; $i < $number_of_images; $i++) {
          if ($files['gallery_images']['name'][$i] != '') {
            move_uploaded_file($files['gallery_images']['tmp_name'][$i], 'uploads/gallery_image/gallery_images/'. $files['gallery_images']['name'][$i]);
            $data['gallery_id']  = $gallery_id;
            $data['imageArray']  = $files['gallery_images']['name'][$i];
            //$data['school_id'] = $this->session->userdata('school_id');
			$sql = "select * from galleryimagearray order by id desc limit 1";
			$return_query = $this->db->query($sql)->row()->id + 1;
			$data['id'] = $return_query;
			
			$this->security->xss_clean($data);
            $this->db->insert('galleryimagearray', $data);
          }
        }
    }
	

	// Upload Multiple Image codes here//	
	function productMultipleImages($product_id) {
        $files = $_FILES;
        $number_of_images = count($_FILES['product_images']['name']);
        for ($i=0; $i < $number_of_images; $i++) {
          if ($files['product_images']['name'][$i] != '') {
            move_uploaded_file($files['product_images']['tmp_name'][$i], 'uploads/products/product_images/'. $files['product_images']['name'][$i]);
            $data['product_id']  = $product_id;
            $data['imageArray']  = $files['product_images']['name'][$i];
            //$data['school_id'] = $this->session->userdata('school_id');
			
			$this->security->xss_clean($data);
            $this->db->insert('productimages', $data);
          }
        }
    }
	
	
	
	function approve_pending_student($param2) {
	
		$pending_student = $this->db->get_where('form', array('form_id' => $param2))->result_array();
			 foreach ($pending_student as $row) {
				 
				$data3['name'] 			= $row['name'];
				$data3['roll'] 			= $row['roll'];
				$data3['email'] 		= $row['email'];
				$data3['phone'] 		= $row['phone'];
				$data3['class_id'] 		= $row['class_id'];
				$data3['section_id'] 	= $row['section_id'];
				$data3['age'] 			= $row['age'];
				$data3['sex'] 			= $row['sex'];	
				$data3['address'] 		= $row['address'];
				$data3['password'] 		= sha1($row['password']);
				
				$sql = "select * from student order by student_id desc limit 1";
				$return_query = $this->db->query($sql)->row()->student_id + 1;
				$data3['student_id'] = $return_query;
            
				$this->db->insert('student' , $data3);
				$this->email_model->account_opening_email('student', $data3['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
				
				
				$data['status'] = 'Now normal student';
				$this->db->where('form_id', $param2);
				$this->db->update('form', $data);
			}
	
	}
	
	
	
    public function getWeekendDaysSession()
    {
        $date_from = strtotime(date("Y-01-01"));
        $date_to = strtotime(date("Y-12-31"));
        $oneDay = 60 * 60 * 24;
        $allDays = array(
            '0' => 'Sunday',
            '1' => 'Monday',
            '2' => 'Tuesday',
            '3' => 'Wednesday',
            '4' => 'Thursday',
            '5' => 'Friday',
            '6' => 'Saturday',
        );

        $weekendDay = '6,0';
        $weekendArrays = explode(',', $weekendDay);
        $weekendDateArrays = array();
        for ($i = $date_from; $i <= $date_to; $i = $i + $oneDay) {
            if ($weekendDay != "") {
                foreach ($weekendArrays as $weekendValue) {
                    if ($weekendValue >= 0 && $weekendValue <= 6) {
                        if (date('l', $i) == $allDays[$weekendValue]) {
                            $weekendDateArrays[] = date('Y-m-d', $i);
                        }
                    }
                }
            }
        }
        return $weekendDateArrays;
    }  


	
	
}

