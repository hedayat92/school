<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if ( ! function_exists('manager')){
	function manager($total_rows, $per_page_item) {
    $config['per_page']        = $per_page_item;
    $config['num_links']       = 2;
    $config['total_rows']      = $total_rows;
    $config['full_tag_open']   = '<div class="gdlr-core-pagination  gdlr-core-style-round gdlr-core-left-align gdlr-core-item-pdlr">';
    $config['full_tag_close']  = '</div>';
    //$config['prev_link']       = '<span aria-current="page" class="page-numbers current">Previous</span>';
    //$config['prev_tag_open']   = '<span aria-current="page" class="page-numbers current">';
    //$config['prev_tag_close']  = '</span>';
    //$config['next_link']       = '<a class="next page-numbers"></a>';
    //$config['next_tag_open']   = '<a class="next page-numbers">';
    //$config['next_tag_close']  = '</a>';
    $config['cur_tag_open']    = '<span aria-current="page" class="page-numbers current">';
    $config['cur_tag_close']   = '</span>';
   // $config['num_tag_open']    = '<a class="page-numbers">';
   // $config['num_tag_close']   = '</a>';
    
		$config['first_link'] = false;
		$config['last_link'] = false;
    return $config;
  }
}


if ( ! function_exists('get_settings')){
    function get_settings($type){
        $CI = get_instance();
        $CI->load->database();
        $des = $CI->db->get_where('settings', array('type' => $type))->row()->description;
        return $des;
    }
}


if ( ! function_exists('slugify')){
    function slugify($text) {
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
        $text = trim($text, '-');
        $text = strtolower($text);
        //$text = preg_replace('~[^-\w]+~', '', $text);
        if (empty($text))
        return 'n-a';
        return $text;
    }
}


	//demo or main script running check
	if ( ! function_exists('demo')){
		function demo(){
			$CI=& get_instance();
			return $CI->config->item('demo');
		}
	}
