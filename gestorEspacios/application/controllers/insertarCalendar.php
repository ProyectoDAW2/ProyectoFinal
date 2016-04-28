<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class insertarCalendar extends CI_Controller {

	public function index()
	{
		$this->load->view("calendar/prueba_add");
	}

	public function save()
	{
		//recojo los datos y guardo la fecha en formato aaaa/mm/dd 
		//porque la bd tiene que guardarlo así
		$fechainicio= $_REQUEST['fechaini'];
		$trozosFecha= explode('/', $fechainicio);
		$fechaBuena= $trozosFecha[2]."/".$trozosFecha[1]."/".$trozosFecha[0];
		//$fechafinal= $_REQUEST['fechafin'];
		$horaSeleccionada= $_REQUEST['horas'];
		
		$this->load->model('Model_Reserva', 'mr');
		//metodo que he creado para insertar en la bd (Model_Reserva)
		$this->mr->crearConCalendar($fechaBuena, $horaSeleccionada);

	}

	public function getAll()
	{
		/*if($this->input->is_ajax_request())
		{
			$this->load->model('events_model');
			$events = $this->events_model->getAll();
			echo json_encode(
				array(
					"success" => 1,
					"result" => $events
				)
			);
		}*/
		//He creado un método en Model_Reserva para recoger las fechas
		$this->load->model('Model_Reserva', 'mr');
		$fechas= $this->mr->getFechasReservas();
		$datos['fechas']= $fechas;
		$this->load->view('calendar/prueba', $datos);
		
	}

	public function render($id = 0)
	{
		if($id != 0)
		{
			echo $id;
		}
	}
}


?>