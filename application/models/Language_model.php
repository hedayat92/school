<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Language_model extends CI_Model { 
	
	function __construct()
    {
        parent::__construct();
    }


    function createNewLanguage(){
        
        $language   =   $this->input->post('language');
        $this->load->dbforge();

        $fields =   array(
            $language => array('type' => 'LONGTEXT')
        );

        $this->dbforge->add_column('language', $fields);
		
		$page_data['name'] = ucwords($language);
		$page_data['db_field'] = $language;
		$page_data['status'] = 'ok';
		
		$sql = "select * from language_list order by language_list_id desc limit 1";
		$return_query = $this->db->query($sql)->row()->language_list_id + 1;
		$page_data['language_list_id'] = $return_query;
		$this->db->insert('language_list', $page_data);

    }


    function createNewLanguagePhrase(){

        $page_data['phrase']    = html_escape($this->input->post('phrase'));
        $this->db->insert('language', $page_data);


        
    }

    function deleteLanguage($param2){

        $language   =   $param2;
        $this->load->dbforge();
        $this->dbforge->drop_column('language', $language);
		
		$this->db->where('db_field', $language);
        $this->db->delete('language_list');
        
    }


}


