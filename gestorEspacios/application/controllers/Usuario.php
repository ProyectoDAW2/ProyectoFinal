<?php
session_start();

class Usuario extends CI_Controller
{
	public function index()
	{
		$this->login();	
	}
	
	public function listar()
	{
		$this->load->model('Model_Usuario', 'mu');
		$usuarios= $this->mu->getTodos();
		$datos['usuarios']= $usuarios;
		
		$this->load->view('usuario/listar', $datos);
	}
	
	public function modificar(){
		$this->load->view('usuario/modificar');
	}
	
	public function modificarPost(){
	//recojo los datos que introduciré a modificar()
		$correo=$_REQUEST ['correo'];
		$nick=$_REQUEST ['nick'];
		$password=$_REQUEST ['password'];
	
	//De alguna manera debo recoger el usuario que quiere hacer la modificación
	$id=$_REQUEST['id'];
		
		$this->load->model('Model_Usuario', 'mu');
		$usuario=$this->mu->modify($id, $correo,$nick, $password);
		$this->load->view('usuario/modificarPost');
	}
	
	public function registrar()
	{
		$this->load->view('usuario/formuRegistro');
	}
	
	public function registrarPost()
	{
		
		$nick= $_REQUEST['nick'];
		$password= $_REQUEST['password'];
		$correo= $_REQUEST['correo'];
		$clave= $_REQUEST['clave'];
		$res= $_REQUEST['res'];
		
		$rol= "";
		$longitudCorreo= strlen($correo);
		
		$digitoRol=substr($clave, -1); //cogemos el último caracter de la clave, para saber el rol
		if($digitoRol==1)
		{
			$rol= "profesor";
		}
		else 
		{
			$rol= "alumno";
		}
		
		$this->load->model('Model_Usuario', 'mu');
		$existeClave= $this->mu->comprobarClave($clave);
		
		if($existeClave!="")
		{
			$id= $existeClave;
			$_SESSION['idUsuario']= $id;
			if($res==true && $longitudCorreo<46)
			{
				$this->mu->completarRegistro($nick, $password, $correo, $rol, $clave, $id);
				$this->listar();
			}
		}
		else 
		{
			$this->load->view('errors/noClave');
		}
		
	}
	
	public function perfil()
	{
		$id=isset($_SESSION['idUsuario']) ? $_SESSION['idUsuario']:null;
		$datos['idUsuario']= $id;
		$this->load->view('usuario/perfil', $datos);
	}
	
	public function perfilPost()
	{
		$nick= $_REQUEST['nick'];
		$passActual= $_REQUEST['passwordActual'];
		$password= $_REQUEST['passwordNueva'];
		$correo= $_REQUEST['correo'];
		$res= $_REQUEST['res'];
		
		if($res!=false)
		{
			
			$this->load->model('Model_Usuario','mu');
			$id= $this->mu->encontrarUsuarioPorPassword($passActual);
			
			if($id!=0)
			{
				$this->mu->cambiarPerfil($id, $nick, $password, $correo);
				$this->load->view('usuario/perfilPost');
					
			}
			else
			{
				$this->load->view('errors/noPassword');
			}
		}
		else 
		{
			$this->load->view('errors/noModificarPerfil');
		}
		
	}
	
	public function login()
	{
		$this->load->helper('form');
		$this->load->view('usuario/login');
	}
	
	public function loginPost()
	{
		
		$nick=$_REQUEST['user'];
		$password=$_REQUEST['password'];
		$remember=isset($_POST['remember']) ? TRUE : FALSE;
		
		$this->load->model('Model_Usuario', 'mu');
		$existeUsuario= $this->mu->login($nick,$password);
		
		if($existeUsuario!="")
		{
			$id=$existeUsuario;
			$_SESSION['idUsuario']=$id;
			if($id==true)
			{
				$this->load->view('usuario/loginPost');
				$anyo=time()+31536000;
				
				if($remember==TRUE)
				{
					setcookie('recuerdame', $_POST['user'], $anyo);
				}
			}
		}
		else
		{
			$this->load->view('errors/noUsuario');
		}
	}
	
	public function recuperar()
	{
		$this->load->view('usuario/recuperar');
	}
	
	function recuperarPost()
	{
		$correo=$_REQUEST['correo'];
		
		$this->load->model('Model_Usuario','mu');
		$existeCorreo= $this->mu->comprobarCorreo($correo);
		
		if($existeCorreo!="")
		{
			$id=$existeCorreo;
			$_SESSION['idUsuario']=$id;
			
			//Vamos a crear la cadena aleatoria que será la nueva contraseña					
			$length=5;
			$cadena=substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
			
			$this->mu->cambiarPass($correo,$cadena);
			
			//El mensaje va todo juntito. En el se adjuntarán la cadena aleatoria y el nick.
			$mensaje='Restablece tus datos.
			Hemos recibido una petición para restablecer los datos de tu cuenta.
			Nueva contraseña '.$cadena.'
			Nombre de usuario';
			$cabeceras = 'MIME-Version: 1.0' . "\r\n";
			$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$cabeceras .= 'From: Servidor <recuperacion.reyfernando@gmail.com>' . "\r\n";
			// Se envia el correo al usuario
			mail($correo, "Recuperar contraseña", $mensaje, $cabeceras);
		}
		else
		{
			$this->load->view('errors/noCorreo');
		}
	}
}
?>