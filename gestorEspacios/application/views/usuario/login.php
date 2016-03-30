<html>
<head>
    <meta charset="utf-8">
</head>
<body>
<form action="<?=base_url('usuario/loginPost')?>" method="POST">
<label>Usuario</label> <input type="text" name="user" id="user"/><br>
<label>Contraseña</label><input type="password" name="password" id="password"><br>
<input type="checkbox" value="recordar" name="recordar" id="recordar"> Recordar<br>
<input type="submit" value="Enviar" id="enviar"/>
</form>
<a href="recuperar">¿Has olvidado tus datos?</a>
</body>
</html> 
