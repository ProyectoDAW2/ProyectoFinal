<table>
	<tr><td>Nombre</td><td>Apellidos</td><td>Nick</td><td>Correo</td></tr>
	
	<?php foreach($usuarios as $usuario):?>
		<tr><td><?= $usuario->nombre ?></td><td><?= $usuario->apellidos ?></td>
		<td><?= $usuario->nick ?></td><td><?= $usuario->correo ?></td></tr>
	<?php endforeach;?>
	
</table>