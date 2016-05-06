<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calendar extends CI_Controller 
{
//EL INDEX LO HE CAMBIADO PARA QUE LO PODAÍS LLAMAR TAMBIÉN DESDE AQUÍ Y FUNCIONE
	public function index()
	{
		$this->load->model('Model_Reserva', 'mr');
		$fechas= $this->mr->getFechasReservas();
		$datos['fechas']= $fechas;
		$this->load->view('calendar/prueba', $datos);
	}

}

/* End of file calendar.php */
/* Location: ./application/controllers/calendar.php */