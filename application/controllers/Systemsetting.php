<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class Systemsetting extends CI_Controller { 

    function __construct() {
        parent::__construct();
        		$this->load->database();							// load database library
        		$this->load->library('session');					//Load library for session
    }


/**default functin, redirects to login page if no admin logged in yet***/
    public function index() {
        	if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');
        	if ($this->session->userdata('admin_login') == 1)
            redirect(base_url() . 'admin/dashboard', 'refresh');
    }

   

   /************** Manage system setings  ********************/
	function system_settings($param1 = '', $param2 = '', $param3 = '') 
	{
    if ($this->session->userdata('admin_login') != 1)
    redirect(base_url() . 'login', 'refresh');


        if ($param1 == 'do_update') {
           
        $this->crud_model->update_settings();
		
		move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/signature.png');
        $this->session->set_flashdata('flash_message', get_phrase('Data Updated'));
        redirect(base_url(). 'systemsetting/system_settings', 'refresh');
    }

    if ($param1 == 'upload_logo') {
	
      
	  $goodstatus = $this->crud_model->updateLogoFunction();

		switch ($goodstatus) {

        case 0:

        $this->session->set_flashdata('flash_message', 'Logo Update Successful');

        break;

        case 1:

        $this->session->set_flashdata('error_message', 'Logo Upload Error - No file selected!');

        break;

        case 2:

        $this->session->set_flashdata('error_message', 'Logo Upload Error - Bad File Name!');

        break;

        case 3:

        $this->session->set_flashdata('error_message', 'Logo Upload Error - File Type Not Allowed!');

        }

        // ========== End Validity Messaging Code ===============

            redirect('systemsetting/system_settings','refresh');
    }


    if ($param1 == 'themeSettings') 
	{
        $this->crud_model->update_theme();
        $this->session->set_flashdata('flash_message', get_phrase('Theme Selected'));
        redirect(base_url() . 'systemsetting/system_settings', 'refresh');
    }
	
	
	if ($param1 == 'login_info') {
    
		$data['description'] = $this->input->post('login_message');
       $this->db->where('type', 'login_message');
       $this->db->update('settings', $data);	
		
		move_uploaded_file($_FILES['userfile']['tmp_name'], 'assets/images/account-bgc.jpg');
		
		
    	$this->session->set_flashdata('flash_message', get_phrase('login_message_image_uploaded'));
   	 	redirect(base_url() . 'systemsetting/system_settings', 'refresh');
    }
	

    $page_data['page_name'] = 'system_settings';
    $page_data['page_title'] = get_phrase('system_settings');
    $page_data['settings'] = $this->db->get('settings')->result_array();
    $this->load->view('backend/index', $page_data);
    }
	
	
	
	function backup_database ($option="", $type=""){

        if($option == 'create_backup'){
            $this->crud_model->create_backup($type);
            $this->session->set_flashdata('flash_message', get_phrase('Database Backup Successfully'));
            redirect(base_url() . 'setting/backup_database', 'refresh');
        }

        if($option == 'create_backup'){
            $this->crud_model->delete_database($type);
            $this->session->set_flashdata('flash_message', get_phrase('Database Backup Successfully'));
            redirect(base_url() . 'setting/backup_database', 'refresh');
        }


    $page_data['page_name'] =   'backup_database';
    $page_data['page_title'] =   get_phrase('backup_database');
    $this->load->view('backend/index', $page_data);
    }
	


	
	
}
