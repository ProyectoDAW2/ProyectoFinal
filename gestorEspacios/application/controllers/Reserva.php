<?php
session_start();

class Reserva extends CI_Controller
{
	public function index()
	{
		$this->crear();
	}
	public function crear(){
		$datos['idUsuario']= isset($_SESSION['idUsuario']) ? $_SESSION['idUsuario']:null;
		$this->load->view('Reserva/crear', $datos);
	}
	
	//CREO UN LISTAR PARA HACER UNA PRUEBA CON FIND, ES NECESARIO SABER EL ID PARA PASÁRSELO A LISTARPOST
	public function listar(){
		$this->load->view('reserva/listar');
	}
	
	//Vamos a hacer una lista de reserva por aula para luego recogerlo en el horario.
	public function listarReserva(){
		$this->load->view('reserva/listarReserva');
	}
	
	public function borrar(){
		$this->load->view('reserva/borrar');
	}
	
	public function filtrar()
	{
		$this->load->model('Model_ObjetoReservable', 'mo');
		$categorias= $this->mo->getCategoria();
		$datos['categorias']= $categorias;
		$this->load->view('reserva/filtrado', $datos);
	}
	
	public function crearPost(){
		$idUsuario=$_REQUEST ['idUsuario'];
		$idOR=$_REQUEST ['idOR'];
		$fecha=$_REQUEST ['fecha'];
		//La segunda fecha la cojo para poder construir el segundo "calendario". 
		//Este calendario tendrá todos los días dados en un rango de fechas y las horas que tiene.
		$fecha2=$_REQUEST ['fecha2'];
		$horaCogida=$_REQUEST ['horaCogidas'];
		$hora=explode("--",$horaCogida);
	//Cuando se coge más de una hora de reserva, se hacen tantas reservas como horas se cojan
	for($i=0;$i<(count($hora)-1);$i++)
	{
		$this->load->model('Model_Reserva','mr');
		$reserva=$this->mr->crear($idUsuario,$idOR,$fecha,$hora[$i]);
		if($reserva==false){
			$this->load->view('reserva/crearPostIncorrecto');
		}
		else{
			$this->load->view('reserva/crearPostCorrecto');
		}
	}
	}
	
	public function borrarPost(){
	
		$id=$_REQUEST['id'];
	
		$this->load->model('Model_Reserva', 'mr');
		$this->mr->borrar($id);
		$this->load->view('reserva/borrarPost');
	}

	public function listarPost()
	{
		$idUsuario=$_REQUEST ['idUsuario'];
		$this->load->model('Model_Reserva', 'mr');
		$reservas= $this->mr->getTodos($idUsuario);
		$datos['reservas']= $reservas;
	
		$this->load->view('reserva/listarPost', $datos);
	}
		
	public function listarReservaPost()
	{
		$idAula=$_REQUEST ['idAula'];
		$this->load->model('Model_Reserva', 'mr');
		$reservas= $this->mr->getTodasReservas($idAula);
		$datos['reservas']= $reservas;
	
		$this->load->view('reserva/listarReservaPost', $datos);
	}
	
	public function filtrarPost()
	{
		$categoria= '= '+$_REQUEST['categoria'];
		//$red= isset($_REQUEST['red']) ? $_REQUEST['red']:'NO';
		$red= $_REQUEST['red'];
		$proyector= $_REQUEST['proyector'];
		//$proyector= isset($_REQUEST['proyector']) ? $_REQUEST['proyector']:'NO';
		$numEquipos= $_REQUEST['equipos'];
		$capacidad= $_REQUEST['capacidad'];
		
		if($categoria!='todas')
		{
			$categoria= 'IS NOT NULL';
		}
		
		if($red!='NO')
		{
			$red='SI';
		}
		
		if($proyector!='NO')
		{
			$proyector= 'SI';
		}
		
		
		$this->load->model('Model_ObjetoReservable', 'mo');
		$resultado= $this->mo->getAulasDisponibles($categoria, $red, $proyector, $numEquipos, $capacidad);
	
		$datos['aulas']= $resultado;
		$this->load->view('reserva/filtradoPost', $datos); 
		
	}
	
}
	