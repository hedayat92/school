<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Exam_model extends CI_Model { 
	
	function __construct()
    {
        parent::__construct();
    }

    // The function below insert into exam table //
    function createExamination(){
        $page_data = array(
            'name'      => $this->input->post('name'),
            'comment'   => $this->input->post('comment'),
            'timestamp' => $this->input->post('timestamp'),
			'term' => get_settings('term'),
			'session' => get_settings('session')
		);
		
		if(get_settings('report_template') == 'tanzania'){
			$page_data['terminal'] =  $this->input->post('terminal');
			
			
			$terminal = $this->db->get_where('exam', array('session' => get_settings('session'), 'term' => get_settings('term'), 'terminal' => 1));
			if($terminal->num_rows() > 0){
				$this->session->set_flashdata('error_message', 'Terminal exam can only be saved in the same session and term');
				redirect(base_url() . 'admin/createExamination', 'refresh');
			}
		}
		
			$sql = "select * from exam order by exam_id desc limit 1";
			$return_query = $this->db->query($sql)->row()->exam_id + 1;
			$page_data['exam_id'] = $return_query;

        $this->db->insert('exam', $page_data);
    }


    // The function below update update exam table //
    function updateExamination($param2){
        $page_data = array(
            'name'      => $this->input->post('name'),
            'comment'   => $this->input->post('comment'),
            'timestamp' => $this->input->post('timestamp'),
			'term' => get_settings('term')
		);
		
		if(get_settings('report_template') == 'tanzania'){
			$page_data['terminal'] =  $this->input->post('terminal');
			
			
			$terminal = $this->db->get_where('exam', array('session' => get_settings('session'), 'term' => get_settings('term'), 'terminal' => 1));
			if($terminal->num_rows() > 0){
				$this->session->set_flashdata('error_message', 'Terminal exam can only be saved in the same session and term');
				redirect(base_url() . 'admin/createExamination', 'refresh');
			}
		}
		
        $this->db->where('exam_id', $param2);
        $this->db->update('exam', $page_data);
    }

    // The function below delete from exam table //
    function deleteExamination($param2){
        $this->db->where('exam_id', $param2);
        $this->db->delete('exam');
    }
	


	
	
}

