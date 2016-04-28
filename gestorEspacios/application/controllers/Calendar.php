<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calendar extends CI_Controller 
{

	public function index()
	{
		$this->load->view('calendar/prueba');
	}

	public function original(){
		$this->load->view('calendar/calendar');
	}
}

/* End of file calendar.php */
/* Location: ./application/controllers/calendar.php */