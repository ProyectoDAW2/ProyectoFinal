<?php
class Model_ObjetoReservable extends RedBean_SimpleModel{
	public function modify ($id, $nombre, $tipo, $numAula,$capacidad, $categoria,$numEquipos, $red, $proyector)
	{
		$oR=r::load('objetoreservable',$id); //Gracias al id identificamos al or al que modificaremos los datos
		//De momento desconozco el id
		$oR->nombre=$nombre;
		$oR->tipo=$tipo;
		$oR->numAula=$numAula;
		$oR->categoria=$categoria;
		$oR->numEquipos=$numEquipos;
		$oR->red=$red;
		$oR->proyector=$proyector;
		R::store($oR);
	}
	
	public function getTodos()
	{
		return R::findAll('objetoreservable');
	}
	
	public function crear ($nombre, $tipo, $numAula,$capacidad, $categoria,$numEquipos, $red, $proyector)
	{
		$oR=R::dispense('objetoreservable');
		$oR->nombre=$nombre;
		$oR->tipo=$tipo;
		$oR->numAula=$numAula;
		$oR->categoria=$categoria;
		$oR->numEquipos=$numEquipos;
		$oR->red=$red;
		$oR->proyector=$proyector;
		//$oR-> xownObjetoreservableList= array();
		R::store($oR);
	}
	
	public function borrar($id)
	{
		//Borramos por ID (al menos por ahora)
		$oR=R::load('objetoreservable',$id);
		$reserva=R::load('reserva',$oR->id);
		R::trash($oR);
		R::trash($reserva);
	}
	
}
?>