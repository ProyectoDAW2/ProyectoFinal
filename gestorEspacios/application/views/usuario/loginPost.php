<html>
<head>
	<meta charset="utf-8">
</head>
<body>
<a href="<?=base_url('usuario/perfil')?>">Perfil</a>
<a href="<?=base_url('reserva/crear')?>">Reserva</a>

<?=
	$user=$_REQUEST['user'];
	echo "Hola ".$_SESSION['idUsuario'].".";
?>
</body>
</html>
