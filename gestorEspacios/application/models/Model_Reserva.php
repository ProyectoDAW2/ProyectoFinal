<?php
class Model_Reserva extends RedBean_SimpleModel{
	public function crear($idUsuario,$idOR,$fecha,$hora)
	{
		
		$usuario=r::load('usuario',$idUsuario);
		$oR=r::load('objetoReservable',$idOR);
		$reservaExiste=false;//Controla si reserva existe o no 
		
		$reserva=R::dispense('reserva');
		$reserva->fecha=$fecha;
		$reserva->hora=$hora;
		$reserva->usuario=$usuario;
		$reserva->or=$oR;
		//Haciendo pruebas me dí cuenta que sería interesante guaradar tambien el nombre de OR Y usuario
		$reserva->usuarionombre=$usuario->nombre;
		$reserva->ornombre=$oR->nombre;
		//Controlo si el or está ya reservado en el mismo día y hora
		$reservasOR=$this->getCrear($idOR);
		foreach($reservasOR as $reservaOR){
			if($reservaOR->fecha==$fecha&&$reservaOR->hora==$hora){
				$reservaExiste=true;
			}	
		}
		if($reservaExiste==false){
			R::store($reserva);
			return true;
		}
		else{
			return false;
			
		}
	}


	public function borrar($id)
	{
		//Borramos por ID (al menos por ahora)
		$reserva=R::load('reserva',$id);
		R::trash($reserva);
	}
	
	public function getTodos($idUsuario){
		
		//return R::findAll('reserva');
	
		$reserva  =  R::find( 'reserva', ' usuario_id LIKE ? ',[$idUsuario]);
		return $reserva;

	}
	
	//Se le llama para saber horas y aulas reservadas
	public function getCrear($oR)
	{
	
		//return R::findAll('reserva');
		$reservasOR  =  R::find( 'reserva', ' or_id LIKE ? ',[$oR]);
		return $reservasOR;
	
	}
	
}
?>