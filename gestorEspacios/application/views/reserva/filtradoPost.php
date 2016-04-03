
<?= var_dump($aulas) ?>
 <h3>Aulas disponibles</h3>


	<?php foreach($aulas as $aula):?>

	 
		<?= $aula->ID ?><br><br>
	
	<?php endforeach;?>


<a href="<?=base_url('reserva/filtrar')?>">Buscar m&aacute;s aulas</a> 
