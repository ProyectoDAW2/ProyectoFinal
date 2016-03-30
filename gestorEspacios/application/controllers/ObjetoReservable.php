<?php
class ObjetoReservable extends CI_Controller{
	
	public function index(){
		$this->load->view('objetoReservable/crear');
	}

	public function modificar(){
		$this->load->view('objetoReservable/modificar');
	}
	public function crear(){
		$this->load->view('objetoReservable/crear');
	}
	public function borrar(){
		$this->load->view('objetoReservable/borrar');
	}
	
	public function modificarPost(){
		$nombre=$_REQUEST ['nombre'];
		$tipo=$_REQUEST ['tipo'];
		$num_aula=$_REQUEST ['num_aula'];
		$categoria=$_REQUEST ['categoria'];
		$capacidad=$_REQUEST ['capacidad'];
		$num_equipos=$_REQUEST ['num_equipos'];
		$red=$_REQUEST ['red'];
		$proyector=$_REQUEST ['proyector'];
		
		//De alguna manera debo recoger el usuario que quiere hacer la modificación
		$id=$_REQUEST['id'];
		
		$this->load->model('Model_ObjetoReservable','mo');
		$objetoReservable=$this->mo->modify($id, $nombre, $tipo, $num_aula,$capacidad, $categoria,$num_equipos, $red, $proyector);
		$this->load->view('objetoReservable/modificarPost');
	
	}
	public function crearPost(){
		
		$nombre=$_REQUEST ['nombre'];
		$tipo=$_REQUEST ['tipo'];
		$num_aula=$_REQUEST ['num_aula'];
		$categoria=$_REQUEST ['categoria'];
		$capacidad=$_REQUEST ['capacidad'];
		$num_equipos=$_REQUEST ['num_equipos'];
		$red=$_REQUEST ['red'];
		$proyector=$_REQUEST ['proyector'];
		
		$this->load->model('Model_ObjetoReservable','mo');
		$objetoReservable=$this->mo->crear($nombre,$tipo,$num_aula,$capacidad,$categoria,$num_equipos,$red,$proyector);
		$this->load->view('objetoReservable/crearPost');
	}
	public function borrarPost(){

		$id=$_REQUEST['id'];
		
		$this->load->model('Model_ObjetoReservable','mo');
		$objetoReservable=$this->mo->borrar($id);
		$this->load->view('objetoReservable/borrarPost');
	}
	
	public function listar()
	{
		$this->load->model('Model_ObjetoReservable', 'mo');
		$objetos= $this->mo->getTodos();
		$datos['objetos']= $objetos;
	
		$this->load->view('objetoReservable/listar', $datos);
	}
	
}