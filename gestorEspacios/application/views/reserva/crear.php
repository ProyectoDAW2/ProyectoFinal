<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
</head>
<body>
<h1>Crear Reserva</h1>
<form action="<?=base_url('reserva/crearPost')?>" method="post">
	<input type="text" name="idUsuario" value="<?= $idUsuario ?>" hidden><br>
	<label>idObjeto Reservable</label> <input type="text" name="idOR"><br>
	<label>Fecha</label> <input type="date" name="fecha"><br>
	<label>Hora</label> <input type="text" name="hora"><br>
	<input type="submit">
</form>
</body>
</html>