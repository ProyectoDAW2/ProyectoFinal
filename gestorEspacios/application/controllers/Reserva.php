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
	
	public function crearPost(){
		$idUsuario=$_REQUEST ['idUsuario'];

		$idOR=$_REQUEST ['idOR'];
		$fecha=$_REQUEST ['fecha'];
		$hora=$_REQUEST ['hora'];
		$this->load->model('Model_Reserva','mr');
		$reserva=$this->mr->crear($idUsuario,$idOR,$fecha,$hora);
		
		if($reserva==false){
		$this->load->view('reserva/crearPostIncorrecto');
		}
		else{
		$this->load->view('reserva/crearPostCorrecto');
		}
	}
	
	public function borrar(){
		$this->load->view('reserva/borrar');
	}
	
	public function borrarPost(){
	
		$id=$_REQUEST['id'];
	
		$this->load->model('Model_Reserva', 'mr');
		$this->mr->borrar($id);
		$this->load->view('reserva/borrarPost');
	}
	
	
	//CREO UN LISTAR PARA HACER UNA PRUEBA CON FIND, ES NECESARIO SABER EL DI PARA PASÁRSELO A LISTARPOST
	public function listar(){
		$this->load->view('reserva/listar');
	}
	
	public function listarPost()
	{
		$idUsuario=$_REQUEST ['idUsuario'];
		$this->load->model('Model_Reserva', 'mr');
		$reservas= $this->mr->getTodos($idUsuario);
		$datos['reservas']= $reservas;
	
		$this->load->view('reserva/listarPost', $datos);
	}
	
	public function filtrar()
	{
		$this->load->model('Model_ObjetoReservable', 'mo');
		$categorias= $this->mo->getCategoria();
		$datos['categorias']= $categorias;
		$this->load->view('reserva/filtrado', $datos);
		
	}
	
	public function filtrarPost()
	{
		$categoria= $_REQUEST['categoria'];
		$red= isset($_REQUEST['red']) ? $_REQUEST['red']:'NO';
		$proyector= isset($_REQUEST['proyector']) ? $_REQUEST['proyector']:'NO';
		/*$numEquipos= $_REQUEST['equipos'];
		$capacidad= $_REQUEST['capacidad'];*/
		
		
		
		if($red!='NO')
		{
			$red='SI';
		}
		
		if($proyector!='NO')
		{
			$proyector= 'SI';
		}
		
		print($red);
		
		$this->load->model('Model_ObjetoReservable', 'mo');
		$resultado= $this->mo->getAulasDisponibles($categoria, $red, $proyector);
		//$resultado= $this->mo->getAulasDisponibles($categoria, $red, $proyector, $numEquipos, $capacidad);
	
		$datos['aulas']= $resultado;
		$this->load->view('reserva/filtradoPost', $datos); 
		
	}
	
}
	