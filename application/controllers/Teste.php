<?php 

class Teste extends CI_Controller
{
    public function __construct() {
        parent::__construct();
		$this->load->helper('directory');
    }
	
	public function index(){

		$files = directory_map('application/logs');
		
		$file_content = file_get_contents('application/logs/log-2018-03-13.txt');
	
		echo $file_content;
	
	}

	public function controls()
	{

		$files = directory_map('application/controllers');

		var_dump($files);

	}
}
