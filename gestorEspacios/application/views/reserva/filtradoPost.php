<h3>Aulas disponibles</h3>
<div id="aulas" name="aulas">
	<?php foreach($aulas as $aula):?>
		<?= $aula->categoria ?><br><br>
	<?php endforeach;?>
</div>

<a href="<?=base_url('reserva/filtrar')?>">Buscar m&aacute;s aulas</a>