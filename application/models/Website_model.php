<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Website_model extends CI_Model { 
	
	function __construct()
    {
        parent::__construct();
    }


    function get_all_banners_from_banner_table() {
        $query = $this->db->get('banner_table');
        return $query->result_array();
    }

    function get_all_testimonies_from_testimony_table() {
        $query = $this->db->get('testimony_table');
        return $query->result_array();
    }

    function sell_all_information_in_subscriber_table() {
        $query = $this->db->get('subscriber_table');
        return $query->result_array();
    }

    function select_all_teachers_from_teache_table() {
        $query = $this->db->get('teacher');
        return $query->result_array();
    }
	
	function select_all_events_limit() {
        $sql = "select * from noticeboard order by noticeboard_id desc limit 3";
		return $this->db->query($sql)->result_array();
    }
	
	function select_all_events() {
        $query = $this->db->get('noticeboard');
        return $query->result_array();
    }

    function work_on_user_email_subscription(){
        $safe = 'yes';
        $char = '';
        foreach($_POST as $row){
            if (preg_match('/[\'^":()?}{#~><>|=+¬]/', $row,$match))
            {
                $safe = 'no';
                $char = $match[0];
            }
        }

        $this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required');
		if ($this->form_validation->run() == FALSE){
			echo validation_errors();
		}
		else{
            if($safe == 'yes'){
    			$subscribe_num = $this->session->userdata('subscriber');
    			$email         = $this->input->post('email');
    			$subscriber    = $this->db->get('subscriber_table')->result_array();
    			$exist        = 'no';
    			foreach ($subscriber as $row) {
    				if ($row['email'] == $email) {
    					$exist = 'yes';
    				}
    			}
    			if ($exist == 'yes') {
    				$this->session->set_flashdata('error_message', get_phrase('You have subsribed already'));
        			redirect(base_url() . 'website/index', 'refresh');
    			} else if ($subscribe_num >= 3) {
    				$this->session->set_flashdata('error_message', get_phrase('Your session already exist'));
        			redirect(base_url() . 'website/index', 'refresh');
    			} else if ($exist == 'no') {
    				$subscribe_num = $subscribe_num + 1;
    				$this->session->set_userdata('subscriber', $subscribe_num);
					$sql = "select * from subscriber_table order by subscriber_id desc limit 1";
					$return_query = $this->db->query($sql)->row()->subscriber_id + 1;
					$page_data['subscriber_id'] = $return_query;
    				$page_data['email'] = $email;
    				$this->db->insert('subscriber_table', $page_data);
    				$this->session->set_flashdata('flash_message', get_phrase('You have successfully subsribed'));
        			redirect(base_url() . 'website/index', 'refresh');
    			}
            } else {
					$this->session->set_flashdata('error_message', get_phrase('Disallowed Charecter : " '.$char.' " in the POST'));
        			redirect(base_url() . 'website/index', 'refresh');
            }
		}
    }

    function insert_into_contact_table(){
        $page_data['visitor_name']      = $this->input->post('visitor_name');
        $page_data['visitor_email']     = $this->input->post('visitor_email');
        $page_data['visitor_content']   = $this->input->post('visitor_content');

        $this->db->insert('contact_table', $page_data);
    }
	
	
	function save_banner(){
	
			//$page_data = array(
            //'txta' => $this->input->post('txta'),
            //'txtb' => $this->input->post('txtb'),
			//'txtc' => $this->input->post('txtc')
			//);
		
		$sql = "select * from banner_table order by banner_id desc limit 1";
		$return_query = $this->db->query($sql)->row()->banner_id + 1;
		$page_data['banner_id'] = $return_query;

        $this->db->insert('banner_table', $page_data);
        $banner_id = $this->db->insert_id();
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/banner/' . $banner_id . '.jpg');			// image with user ID
	
	
	}
	
	
	function save_admission($param2){
			$page_data = array(
            'title' => $this->input->post('title'),
            'desc' => $this->input->post('desc')
			);
		
		$this->db->where('id', $param2);
        $this->db->update('admission', $page_data);
         move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/admission/1.jpg');
		 move_uploaded_file($_FILES['userfile2']['tmp_name'], 'uploads/admission/2.jpg');
	
	
	}
	
	
	function save_about($param2){
			$page_data = array(
            'title' => $this->input->post('title'),
			'tour' => $this->input->post('tour'),
			'youtube' => $this->input->post('youtube')
			);
		
		$this->db->where('id', $param2);
        $this->db->update('about', $page_data);
         move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/about/1.jpg');
	
	
	}
	
	
	function save_more_about($param2){
			$page_data = array(
            'benefit' => $this->input->post('benefit'),
			'benefit_video' => $this->input->post('benefit_video'),
			'self' => $this->input->post('self'),
			'self_video' => $this->input->post('self_video'),
			'self' => $this->input->post('self'),
			'spirit' => $this->input->post('spirit'),
			'spirit_video' => $this->input->post('spirit_video'),
			'alumni' => $this->input->post('alumni'),
			'alumni_video' => $this->input->post('alumni_video'),
			'facebook' => $this->input->post('facebook'),
			'twitter' => $this->input->post('twitter'),
			'instagram' => $this->input->post('instagram'),
			'pinterest' => $this->input->post('pinterest'),
			'googleplus' => $this->input->post('googleplus'),
			'linkedin' => $this->input->post('linkedin'),
			'skype' => $this->input->post('skype'),
			'apply' => $this->input->post('apply'),
			'map_code' => $this->input->post('map_code')
			
			
			);
		
		$this->db->where('id', $param2);
        $this->db->update('more_about', $page_data);
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/about/benefit.jpg');
		move_uploaded_file($_FILES['userfile2']['tmp_name'], 'uploads/about/self.jpg');
		move_uploaded_file($_FILES['userfile3']['tmp_name'], 'uploads/about/alumni.jpg');
		move_uploaded_file($_FILES['userfile4']['tmp_name'], 'uploads/about/spirit.jpg');
		move_uploaded_file($_FILES['userfile5']['tmp_name'], 'uploads/logo2.png');
	
	
	}
	
	function delete_save_banner ($param2){
		
		 $imageLocation = $this->db->get_where('banner_table', array('banner_id' => $param2))->row()->banner_id;
		if (file_exists('uploads/banner/'.$imageLocation.'.jpg')) {
            unlink('uploads/banner/'.$imageLocation.'.jpg');
          }
		$this->db->where('banner_id', $param2);
		$this->db->delete('banner_table');
	}
	
	function delete_executive ($param2){
		
		 $imageLocation = $this->db->get_where('executive', array('executive_id' => $param2))->row()->executive_id;
		if (file_exists('uploads/executive_image/'.$imageLocation.'.jpg')) {
            unlink('uploads/executive_image/'.$imageLocation.'.jpg');
          }
		$this->db->where('executive_id', $param2);
		$this->db->delete('executive');
	}
	
	
	
	
	
	
	function save_executive(){
	
			$page_data = array(
            'name' => $this->input->post('name'),
            'post' => $this->input->post('post')
			);
		
		$sql = "select * from executive order by executive_id desc limit 1";
		$return_query = $this->db->query($sql)->row()->executive_id + 1;
		$page_data['executive_id'] = $return_query;

        $this->db->insert('executive', $page_data);
        $executive_id = $this->db->insert_id();
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/executive_image/' . $executive_id . '.jpg');			// image with user ID
	
	
	}
	
	
	
	

}