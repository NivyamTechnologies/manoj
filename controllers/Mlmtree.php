<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Welcome extends MY_Controller 
{

    function __construct()
    {
        parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('url');
    } 	

	
	
}

