<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Event_model extends CI_Model { 
	
	function __construct()
    {
        parent::__construct();
    }

    function createNoticeboardFunction(){

        $page_data['title'] =   html_escape($this->input->post('title'));
		$page_data['slug'] =   slugify($this->input->post('title'));
        $page_data['location'] =   html_escape($this->input->post('location'));
        $page_data['timestamp'] =   strtotime($this->input->post('timestamp'));
        $page_data['description'] =   html_escape($this->input->post('description'));
        $page_data['session'] =   get_settings('session');
		
		
		$sql = "select * from noticeboard order by noticeboard_id desc limit 1";
		$return_query = $this->db->query($sql)->row()->noticeboard_id + 1;
		$page_data['noticeboard_id'] = $return_query;

        $this->db->insert('noticeboard', $page_data);
		$noticeboard_id = $this->db->insert_id();
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/events/' . $noticeboard_id . '.jpg');			// image with ID
        $sendphone  =   html_escape($this->input->post('sendsms'));

        if($sendphone == 1){
            $parents = $this->db->get('parent')->result_array();
            $teachers = $this->db->get('teacher')->result_array();
            $students = $this->db->get('student')->result_array();
            $senddate= html_escape($this->input->post('timestamp'));

            $message = $page_data['title']. ' ';
            $message .= translate('on'). ' ' . $senddate;

            foreach($parents as $key => $parent){
                $recieverPhoneNumber = $parent['phone'];
                $this->sms_model->send_sms($message, $recieverPhoneNumber);
            }
            foreach($teachers as $key => $teacher){
                $recieverPhoneNumber = $teacher['phone'];
                $this->sms_model->send_sms($message, $recieverPhoneNumber);
            }
            foreach($students as $key => $student){
                $recieverPhoneNumber = $student['phone'];
                $this->sms_model->send_sms($message, $recieverPhoneNumber);
            }


        }
    }

    function updateNoticeboardFunction($param2){

        $page_data['title'] =   html_escape($this->input->post('title'));
		$page_data['slug'] =   slugify($this->input->post('title'));
        $page_data['location'] =   html_escape($this->input->post('location'));
        $page_data['timestamp'] =   strtotime($this->input->post('timestamp'));
        $page_data['description'] =   html_escape($this->input->post('description'));

        $this->db->where('noticeboard_id', $param2);
        $this->db->update('noticeboard', $page_data);
		move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/events/' . $param2 . '.jpg');			// image with ID
		
		
		$sendphone  =   html_escape($this->input->post('sendsms'));

        if($sendphone == 1){
            $parents = $this->db->get('parent')->result_array();
            $teachers = $this->db->get('teacher')->result_array();
            $students = $this->db->get('student')->result_array();
            $senddate= html_escape($this->input->post('timestamp'));

            $message = $page_data['title']. ' ';
            $message .= translate('on'). ' ' . $senddate;

            foreach($parents as $key => $parent){
                $recieverPhoneNumber = $parent['phone'];
                $this->sms_model->send_sms($message, $recieverPhoneNumber);
            }
            foreach($teachers as $key => $teacher){
                $recieverPhoneNumber = $teacher['phone'];
                $this->sms_model->send_sms($message, $recieverPhoneNumber);
            }
            foreach($students as $key => $student){
                $recieverPhoneNumber = $student['phone'];
                $this->sms_model->send_sms($message, $recieverPhoneNumber);
            }
        }
    }

    function deleteNoticeboardFunction($param2){
	
		 $imageLocation = $this->db->get_where('noticeboard', array('noticeboard_id' => $param2))->row()->noticeboard_id;
		if (file_exists('uploads/events/'.$imageLocation.'.jpg')) {
            unlink('uploads/events/'.$imageLocation.'.jpg');
          }
        $this->db->where('noticeboard_id', $param2);
        $this->db->delete('noticeboard');

    }
	
	function createNewsFunction(){

        $page_data['title'] =  html_escape($this->input->post('title'));
		$page_data['slug'] =   slugify($this->input->post('title'));
        $page_data['timestamp'] =   strtotime($this->input->post('timestamp'));
        $page_data['description'] =   html_escape($this->input->post('description'));
        $page_data['session'] =   get_settings('session');
		
		
		$sql = "select * from news order by news_id desc limit 1";
		$return_query = $this->db->query($sql)->row()->news_id + 1;
		$page_data['news_id'] = $return_query;

        $this->db->insert('news', $page_data);
		$news_id = $this->db->insert_id();
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/news/' . $news_id . '.jpg');			// image with ID
       
    }
	
	
	function updateNewsFunction($param2){

        $page_data['title'] =   html_escape($this->input->post('title'));
		$page_data['slug'] =   slugify($this->input->post('title'));
        $page_data['timestamp'] =   strtotime($this->input->post('timestamp'));
        $page_data['description'] =   html_escape($this->input->post('description'));
		
		$this->db->where('news_id', $param2);
        $this->db->update('news', $page_data);
		move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/news/' . $param2 . '.jpg');			// image with ID

       
    }
	
	function deleteNewsFunction($param2){
	
		 $imageLocation = $this->db->get_where('news', array('news_id' => $param2))->row()->news_id;
		if (file_exists('uploads/news/'.$imageLocation.'.jpg')) {
            unlink('uploads/news/'.$imageLocation.'.jpg');
          }
        $this->db->where('news_id', $param2);
        $this->db->delete('news');

    }
	


	
	
}

