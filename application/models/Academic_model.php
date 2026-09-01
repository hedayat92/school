<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Academic_model extends CI_Model { 
	
	function __construct()
    {
        parent::__construct();
    }
	
   // The function below inserts into academic syllabus table //
   function createAcademicSyllabus(){
		$page_data = array(
			'academic_syllabus_code'    => substr(md5(rand(0, 1000000)), 0, 7),
			'title'                     => $this->input->post('title'),
			'description'               => $this->input->post('description'),
			'class_id'                  => $this->input->post('class_id'),
			'subject_id'                => $this->input->post('subject_id'),
			'uploader_type'             => $this->session->userdata('login_type'),
			'uploader_id'               => $this->session->userdata('login_user_id'),
			'session'                   => $this->db->get_where('settings', array('type' => 'session'))->row()->description,
			'timestamp'                 => strtotime(date("Y-m-d H:i:s"))
		);
		
	
		//uploading file using codeigniter upload library
		$files = $_FILES['file_name'];
		$this->load->library('upload');
		chmod($config['upload_path'] 	= 'uploads/syllabus/', 0755);
		$config['allowed_types'] 		= 'doc|docx|jpeg|jpg|JPEG|pdf';
		$config['max_size'] 			= '3000000';
		//$config['overwrite']            = true;
		
		$this->upload->initialize($config);
		if($this->upload->do_upload('file_name')){
	
		$page_data['file_name'] = $_FILES['file_name']['name'];
		
		
		$this->security->xss_clean($page_data);
		$this->db->insert('academic_syllabus', $page_data);
		}else{
			$this->session->set_flashdata('error_message', $this->upload->display_errors());
			redirect(base_url(). 'admin/academic_syllabus', 'refresh');
		}
	}

 // The function below inserts into academic syllabus table //
 function updateAcademicSyllabus($param2){
    $page_data = array(
        'title'                     => $this->input->post('title'),
        'description'               => $this->input->post('description'),
        'class_id'                  => $this->input->post('class_id'),
        'subject_id'                => $this->input->post('subject_id'),
        'session'                   => $this->db->get_where('settings', array('type' => 'session'))->row()->description
        );

	$this->db->where('academic_syllabus_code', $param2);
	$this->db->insert('academic_syllabus', $page_data);
	}

	// The function below delete from academic syllabus table //
	function deleteAcademicSyllabus($param2){
	
	 $get_file_name = $this->db->get_where('academic_syllabus', array('academic_syllabus_code' => $academic_syllabus_code))->row()->file_name;
		  if (file_exists('uploads/syllabus/'.$get_file_name)) {
            unlink('uploads/syllabus/'.$file_name);
          }
		
		$this->db->where('academic_syllabus_code', $param2);
		$this->db->delete('academic_syllabus');
	}


	
	
}

