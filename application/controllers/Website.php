<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Website extends CI_Controller { 

    function __construct() {
        parent::__construct();
        		$this->load->database();
                $this->load->library('session');
				$this->load->model('website_model');	
    }


    public function index (){

        $this->load->view('frontend/index');
    }
	
	
	function website_setting($param1 = null, $param2 = null, $param3 = null){
	
	if($param1 == 'banner'){
   
        $this->website_model->save_banner();

        $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
        redirect(base_url() . 'website/website_setting', 'refresh');
    }
	
	if($param1 == 'delete'){
   
        $this->website_model->delete_save_banner($param2);

        $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
        redirect(base_url() . 'website/website_setting', 'refresh');
    }
	if($param1 == 'delete_exe'){
   
        $this->website_model->delete_executive($param2);

        $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
        redirect(base_url() . 'website/website_setting', 'refresh');
    }
	
	if($param1 == 'admission'){
   
        $this->website_model->save_admission($param2);

        $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
        redirect(base_url() . 'website/website_setting', 'refresh');
    }
	
	if($param1 == 'about'){
   
        $this->website_model->save_about($param2);

        $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
        redirect(base_url() . 'website/website_setting', 'refresh');
    }
	
	if($param1 == 'executive'){
   
        $this->website_model->save_executive();

        $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
        redirect(base_url() . 'website/website_setting', 'refresh');
    }
	
	
	if($param1 == 'more_about'){
   
        $this->website_model->save_more_about($param2);

        $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
        redirect(base_url() . 'website/website_setting', 'refresh');
    }
       	$page_data['page_name'] = 'website_setting';
        $page_data['page_title'] = get_phrase('website_settings');
        $this->load->view('backend/index', $page_data);
	
	}
	
	 function subscriber(){
        $this->website_model->work_on_user_email_subscription();
    }

    function send_message(){
       $this->website_model->insert_into_contact_table();
       $this->session->set_userdata('flash_message', get_phrase('Data sent successfully'));
       redirect(base_url(). 'website/contact', 'refresh');

    }
	
	
    function get_class_section($class_id){
        $sections = $this->db->get_where('section', array('class_id' => $class_id))->result_array();
            foreach($sections as $key => $section)
            {
                echo '<option value="'.$section['section_id'].'">'.$section['name'].'</option>';
            }
    }


    function set_language($lang){
        $this->session->set_userdata('language', $lang);
        redirec(base_url(). 'website', 'refresh');
        recache();
    }


}