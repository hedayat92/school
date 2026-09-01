<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Live_class_model extends CI_Model { 
	
	function __construct(){
        parent::__construct();
    }



    function saveLiveClassToDatabase(){

        $arrayLive = array(

            'title'             => html_escape($this->input->post('title')),
            'meeting_id'        => $this->input->post('meeting_id'),
            'meeting_password'  => $this->input->post('meeting_password'),
            'class_id'          => html_escape($this->input->post('class_id')),
            'section_id'        => html_escape($this->input->post('section_id')),
            'date'              => strtotime($this->input->post('date')),
            'start_time'        => date("H:i", strtotime($this->input->post('start_time'))),
            'end_time'          => date("H:i", strtotime($this->input->post('end_time'))),
            'remarks'           => html_escape($this->input->post('remarks')),
            'created_by'        => $this->session->userdata('login_type').'-'.$this->session->userdata('login_user_id')

        );
		$sql = "select * from live_class order by live_class_id desc limit 1";
		$return_query = $this->db->query($sql)->row()->live_class_id + 1;
		$arrayLive['live_class_id'] = $return_query;
				
        $this->db->insert('live_class', $arrayLive);
        $sendPhone = $this->input->post('send_notification_sms');
        $senddate  = $this->input->post('date');

        if($sendPhone == '1'){

            $students = $this->db->get_where('student', array('class_id' => $this->input->post('class_id')))->row();
            $student_parent_id = $students->parent_id;
            $parents = $this->db->get_where('parent', array('parent_id' => $student_parent_id))->result_array();
            $student_array = $this->db->get_where('student', array('class_id' => $students->class_id))->result_array();

            $message = $this->input->post('title').' ';
            $message .= get_phrase('on').' '. $senddate;

            foreach ($parents as $key => $parent){
                $recieverPhoneNumber = $parent['phone'];
                $this->sms_model->send_sms($message, $recieverPhoneNumber);
            }

            foreach ($student_array as $key => $student){
                $recieverPhoneNumber = $student['phone'];
                $this->sms_model->send_sms($message, $recieverPhoneNumber);
            }


        }

    }

    function editLiveClassInformation($param2){

        $arrayLive = array(

            'title'             => html_escape($this->input->post('title')),
            'meeting_id'        => $this->input->post('meeting_id'),
            'meeting_password'  => $this->input->post('meeting_password'),
            'class_id'          => html_escape($this->input->post('class_id')),
            'section_id'        => html_escape($this->input->post('section_id')),
            'date'              => strtotime($this->input->post('date')),
            'start_time'        => date("H:i", strtotime($this->input->post('start_time'))),
            'end_time'          => date("H:i", strtotime($this->input->post('end_time'))),
            'remarks'           => html_escape($this->input->post('remarks'))

        );
        
        $this->db->where('live_class_id', $param2);
        $this->db->update('live_class', $arrayLive);
        $sendPhone = $this->input->post('send_notification_sms');
        $senddate  = $this->input->post('date');

        if($sendPhone == '1'){

            $students = $this->db->get_where('student', array('class_id' => $this->input->post('class_id')))->row();
            $student_parent_id = $students->parent_id;
            $parents = $this->db->get_where('parent', array('parent_id' => $student_parent_id))->result_array();
            $student_array = $this->db->get_where('student', array('class_id' => $students->class_id))->result_array();

            $message = $this->input->post('title').' ';
            $message .= get_phrase('on').' '. $senddate;

            foreach ($parents as $key => $parent){
                $recieverPhoneNumber = $parent['phone'];
                $this->sms_model->send_sms($message, $recieverPhoneNumber);
            }

            foreach ($student_array as $key => $student){
                $recieverPhoneNumber = $student['phone'];
                $this->sms_model->send_sms($message, $recieverPhoneNumber);
            }
        }
    }

    function deleteLiveClassInformation($param2){
	
		$deleteVideoFileName = $this->db->get_where('video_class', array('video_class_id' => $param2))->row()->file_name;
          $filePath = base_url().'uploads/video_class/'.$deleteVideoFileName;
          if (file_exists(filePath)) {
            	unlink(filePath);
          }
		  
        $this->db->where('live_class_id', $param2);
        $this->db->delete('live_class');
    }



    function selectLiveClassInformationByUser(){
        $user_type_id = $this->session->userdata('login_type').'-'.$this->session->userdata('login_user_id');
        $sql = "select * from live_class where created_by ='".$user_type_id."' order by live_class_id asc";
        return $this->db->query($sql)->result_array();
    }

    function selectLiveClassByStudentClassId(){

        $student_class = $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row()->class_id;
        $student_section = $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row()->section_id;
        $sql = "select * from live_class where class_id ='".$student_class."' and section_id = '".$student_section."' order by live_class_id asc";
        return $this->db->query($sql)->result_array();
    }
	
	
	
	function saveVideoClassToDatabase(){

        $arrayLive = array(

            'title'             => html_escape($this->input->post('title')),
            'subject_id'        => $this->input->post('subject_id'),
            'class_id'          => html_escape($this->input->post('class_id')),
            'section_id'        => html_escape($this->input->post('section_id')),
            'date'              => strtotime($this->input->post('date')),
            'remarks'           => html_escape($this->input->post('remarks')),
            'user'        		=> $this->session->userdata('login_type').'-'.$this->session->userdata('login_user_id'),
			'lesson_type'           => html_escape($this->input->post('lesson_type'))

        );
		
		$getVIdeoLessonType = $this->input->post('lesson_type');
		if($getVIdeoLessonType == 'video'){
			$arrayLive['file_name'] = $_FILES["file_name"]["name"];
		}
		
		if($getVIdeoLessonType == 'links'){
			$arrayLive['link'] = $this->input->post('link');
			$arrayLive['type'] = $this->input->post('type');
		}

		$sql = "select * from video_class order by video_class_id desc limit 1";
		$return_query = $this->db->query($sql)->row()->video_class_id + 1;
		$arrayLive['video_class_id'] = $return_query;
        $this->db->insert('video_class', $arrayLive);
		
		if($getVIdeoLessonType == 'video'){
		
				//uploading file1 using codeigniter upload library
				//$files = $_FILES['file_name'];
				$this->load->library('upload');
				$config['upload_path'] 				= 'uploads/video_class/';
				$config['allowed_types'] 			= 'mp4|WAV|wav|gif';
				$config['max_size'] 				= '3000000';
				$config['overwrite']            	= true;
		
				$this->upload->initialize($config);
				if( ! $this->upload->do_upload('file_name')){
					$this->session->set_flashdata('error_message', $this->upload->display_errors());
					redirect(base_url() . 'admin/live_class', 'refresh');
				}		
		}
		
        $sendPhone = $this->input->post('send_notification_sms');
        $senddate  = $this->input->post('date');

        if($sendPhone == '1'){

            $students = $this->db->get_where('student', array('class_id' => $this->input->post('class_id')))->row();
            $student_parent_id = $students->parent_id;
            $parents = $this->db->get_where('parent', array('parent_id' => $student_parent_id))->result_array();
            $student_array = $this->db->get_where('student', array('class_id' => $students->class_id))->result_array();

            $message = $this->input->post('title').' ';
            $message .= get_phrase('on').' '. $senddate;

            foreach ($parents as $key => $parent){
                $recieverPhoneNumber = $parent['phone'];
                $this->sms_model->send_sms($message, $recieverPhoneNumber);
            }

            foreach ($student_array as $key => $student){
                $recieverPhoneNumber = $student['phone'];
                $this->sms_model->send_sms($message, $recieverPhoneNumber);
            }


        }

    }
	
	
	function editVideoClassInformation($param2){

        $arrayLive = array(

            'title'             => html_escape($this->input->post('title')),
            'subject_id'        => $this->input->post('subject_id'),
            'class_id'          => html_escape($this->input->post('class_id')),
            'section_id'        => html_escape($this->input->post('section_id')),
            'date'              => strtotime($this->input->post('date')),
            'remarks'           => html_escape($this->input->post('remarks')),
            'user'        		=> $this->session->userdata('login_type').'-'.$this->session->userdata('login_user_id'),
			'lesson_type'           => html_escape($this->input->post('lesson_type'))

        );
		
		$getVIdeoLessonType = $this->input->post('lesson_type');
		
		if($getVIdeoLessonType == 'links'){
			$arrayLive['link'] = $this->input->post('link');
			$arrayLive['type'] = $this->input->post('type');
		}
	
		$this->db->where('video_class_id', $param2);
        $this->db->update('video_class', $arrayLive);
		
        $sendPhone = $this->input->post('send_notification_sms');
        $senddate  = $this->input->post('date');

        if($sendPhone == '1'){

            $students = $this->db->get_where('student', array('class_id' => $this->input->post('class_id')))->row();
            $student_parent_id = $students->parent_id;
            $parents = $this->db->get_where('parent', array('parent_id' => $student_parent_id))->result_array();
            $student_array = $this->db->get_where('student', array('class_id' => $students->class_id))->result_array();

            $message = $this->input->post('title').' ';
            $message .= get_phrase('on').' '. $senddate;

            foreach ($parents as $key => $parent){
                $recieverPhoneNumber = $parent['phone'];
                $this->sms_model->send_sms($message, $recieverPhoneNumber);
            }

            foreach ($student_array as $key => $student){
                $recieverPhoneNumber = $student['phone'];
                $this->sms_model->send_sms($message, $recieverPhoneNumber);
            }


        }

    }
	
	
	function deleteVideoClassInformation($param2){
        $this->db->where('video_class_id', $param2);
        $this->db->delete('video_class');
    }
	
	
	function selectVideoClassInformationByUser(){
        $user_type_id = $this->session->userdata('login_type').'-'.$this->session->userdata('login_user_id');
        $sql = "select * from video_class where user ='".$user_type_id."' order by video_class_id asc";
        return $this->db->query($sql)->result_array();
    }

    function selectVideoClassByStudentClassId(){

        $student_class = $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row()->class_id;
        $student_section = $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row()->section_id;
        $sql = "select * from video_class where class_id ='".$student_class."' and section_id = '".$student_section."' order by video_class_id asc";
        return $this->db->query($sql)->result_array();
    }



    /*>>>>>>>>> Function to save Jitsi to Table >>>>>>>>> */
    function createNewJitsiClassFunction(){

        $arrayLive = array(

            'title'             => html_escape($this->input->post('title')),
            'class_id'          => html_escape($this->input->post('class_id')),
            'section_id'        => html_escape($this->input->post('section_id')),
            'meeting_date'      => strtotime($this->input->post('meeting_date')),
            'description'       => html_escape($this->input->post('description')),
            'start_time'        => html_escape($this->input->post('start_time')),
            'end_time'          => html_escape($this->input->post('end_time')),
            'status'            => html_escape($this->input->post('status')),
            'room'              => md5(date('d-m-Y H:i:s')).substr(md5(rand(1000000, 2000000)), 0, 10),
            'publish_date'      => strtotime(date('Y-m-d')),
            'user_id'           => $this->session->userdata('login_type').'-'.$this->session->userdata('login_user_id')

        );

		$sql = "select * from jitsi order by jitsi_id desc limit 1";
		$return_query = $this->db->query($sql)->row()->jitsi_id + 1;
		$arrayLive['jitsi_id'] = $return_query;
        $this->db->insert('jitsi', $arrayLive);
		
        $sendPhone = $this->input->post('send_notification_sms');
        $senddate  = $this->input->post('meeting_date');

        if($sendPhone == '1'){

            $students = $this->db->get_where('student', array('class_id' => $this->input->post('class_id')))->row();
            $student_parent_id = $students->parent_id;
            $parents = $this->db->get_where('parent', array('parent_id' => $student_parent_id))->result_array();
            $student_array = $this->db->get_where('student', array('class_id' => $students->class_id))->result_array();

            $message = $this->input->post('title').' ';
            $message .= get_phrase('on').' '. $senddate;

            foreach ($parents as $key => $parent){
                $recieverPhoneNumber = $parent['phone'];
                $this->sms_model->send_sms($message, $recieverPhoneNumber);
            }

            foreach ($student_array as $key => $student){
                $recieverPhoneNumber = $student['phone'];
                $this->sms_model->send_sms($message, $recieverPhoneNumber);
            }


        }

    }




    /*>>>>>>>>> Function to upadte Jitsi to Table >>>>>>>>> */
    function updateJitsiClassFunction($param2){

        $arrayLive = array(

            'title'             => html_escape($this->input->post('title')),
            'class_id'          => html_escape($this->input->post('class_id')),
            'section_id'        => html_escape($this->input->post('section_id')),
            'meeting_date'      => strtotime($this->input->post('meeting_date')),
            'description'       => html_escape($this->input->post('description')),
            'start_time'        => html_escape($this->input->post('start_time')),
            'end_time'          => html_escape($this->input->post('end_time')),
            'status'            => html_escape($this->input->post('status')),

        );

		
        $this->db->where('jitsi_id', $param2);
        $this->db->update('jitsi', $arrayLive);
		
        $sendPhone = $this->input->post('send_notification_sms');
        $senddate  = $this->input->post('meeting_date');

        if($sendPhone == '1'){

            $students = $this->db->get_where('student', array('class_id' => $this->input->post('class_id')))->row();
            $student_parent_id = $students->parent_id;
            $parents = $this->db->get_where('parent', array('parent_id' => $student_parent_id))->result_array();
            $student_array = $this->db->get_where('student', array('class_id' => $students->class_id))->result_array();

            $message = $this->input->post('title').' ';
            $message .= get_phrase('on').' '. $senddate;

            foreach ($parents as $key => $parent){
                $recieverPhoneNumber = $parent['phone'];
                $this->sms_model->send_sms($message, $recieverPhoneNumber);
            }

            foreach ($student_array as $key => $student){
                $recieverPhoneNumber = $student['phone'];
                $this->sms_model->send_sms($message, $recieverPhoneNumber);
            }


        }

    }

    /*>>>>>>>>> Function to delete Jitsi from Table >>>>>>>>> */
    function deleteJitsiClassFunction($param2){
        $this->db->where('jitsi_id', $param2);
        $this->db->delete('jitsi');
    }


    /*>>>>>>>>> Function to select from Jitsi Table >>>>>>>>> */

    function selectJitsiStaffInsert(){
        $staff = $this->session->userdata('login_type').'-'.$this->session->userdata('login_user_id');
        $sql = "select * from jitsi where user_id='".$staff."' order by jitsi_id asc";
        return $this->db->query($sql)->result_array();
    }

    function selectJitsiStudentByClassSection(){
        $studentClass = $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row()->class_id;
        $studentSection = $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row()->section_id;

        $sql = "select * from jitsi where class_id='".$studentClass."' and section_id='".$studentSection."' order by jitsi_id asc";
        return $this->db->query($sql)->result_array();
    } 

    function toSelectFromJitsiWithId($jitsi_id){
        $sql = "select * from jitsi where jitsi_id ='".$jitsi_id."'";
        return $this->db->query($sql)->result_array();
    }
	
	









}