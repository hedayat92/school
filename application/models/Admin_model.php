<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Admin_model extends CI_Model { 
	
	function __construct(){
        parent::__construct();
    }


    function createNewAdministrator(){

        $page_data['name']  = html_escape($this->input->post('name'));
        $page_data['email']  = html_escape($this->input->post('email'));
        $page_data['phone']  = html_escape($this->input->post('phone'));
        $page_data['password']  = sha1($this->input->post('password'));
        $page_data['level']     = html_escape($this->input->post('level'));
		
        $sql = "select * from admin order by admin_id desc limit 1";
		$return_query = $this->db->query($sql)->row()->admin_id + 1;
		$page_data['admin_id'] = $return_query;
		
		$check_email = $this->db->get_where('admin', array('email' => $page_data['email']))->row()->email;
		if($check_email != null) {
		$this->session->set_flashdata('error_message', get_phrase('email_already_exist'));
        redirect(base_url() . 'admin/newAdministrator/', 'refresh');
		}
		else{
        $this->db->insert('admin', $page_data);
        $admin_id = $this->db->insert_id();
        move_uploaded_file($_FILES['admin_image']['tmp_name'], 'uploads/admin_image/' . $admin_id . '.jpg');
		
		$sql2 = "select * from admin_role order by admin_role_id desc limit 1";
		$return_query = $this->db->query($sql2)->row()->admin_role_id + 1;
		
		$page_data2['admin_role_id'] = $return_query;
        $page_data2['admin_id'] =  $admin_id;
        $this->db->insert('admin_role', $page_data2);
		
		
		}
				
    }

    function deleteAdministrator($param2){
        
        $this->db->where('admin_id', $param2);
        $this->db->delete('admin');
		
		$this->db->where('admin_id', $param2);
        $this->db->delete('admin_role');
    }

    function select_all_the_administrator_from_admin_table(){
        $all_selected_administrator = $this->db->get('admin');
        return $all_selected_administrator->result_array();

    }

    function updateAllDetailsForAdminRole($param2){
        $page_data['dashboard']  		= html_escape($this->input->post('dashboard'));
        $page_data['manage_academics']  = html_escape($this->input->post('manage_academics'));
        $page_data['manage_employee']   = html_escape($this->input->post('manage_employee'));
        $page_data['manage_student']    = html_escape($this->input->post('manage_student'));
        $page_data['manage_attendance'] = html_escape($this->input->post('manage_attendance'));
        $page_data['download_page']     = html_escape($this->input->post('download_page'));
        $page_data['manage_parent']     = html_escape($this->input->post('manage_parent'));
        $page_data['manage_alumni']     = html_escape($this->input->post('manage_alumni'));
		
		$page_data['classes']  			= html_escape($this->input->post('classes'));
        $page_data['subject']  			= html_escape($this->input->post('subject'));
        $page_data['exam']   			= html_escape($this->input->post('exam'));
        $page_data['report_card']    	= html_escape($this->input->post('report_card'));
        $page_data['fee']     			= html_escape($this->input->post('fee'));
        $page_data['cbt']     			= html_escape($this->input->post('cbt'));
        $page_data['hrm']     			= html_escape($this->input->post('hrm'));
        $page_data['expense']     		= html_escape($this->input->post('expense'));
		$page_data['library']  			= html_escape($this->input->post('library'));
        $page_data['hostel']  			= html_escape($this->input->post('hostel'));
        $page_data['comm']   			= html_escape($this->input->post('comm'));
        $page_data['transport']    		= html_escape($this->input->post('transport'));
        $page_data['settings']     		= html_escape($this->input->post('settings'));
        $page_data['g_report']     		= html_escape($this->input->post('g_report'));
		

        $this->db->where('admin_id', $param2);
        $this->db->update('admin_role', $page_data);


    }

    
}