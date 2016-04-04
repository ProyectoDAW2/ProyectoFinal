<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link rel="stylesheet" href="assets/login/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/login/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/login/css/form-elements.css">
    <link rel="stylesheet" href="assets/login/css/style.css">
</head>
<body>
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong>Formulario de login</strong></h1>
                            <div class="description">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3></h3>
                            		<p>Inserta tu usuario y contraseña para entrar:</p>
                        		</div>
                            </div>
                            <div class="form-bottom">
			                    <form role="form" action="<?=base_url('usuario/loginPost')?>" method="post" class="login-form">
			                    	<div class="form-group">
			                    		<label class="sr-only" for="form-username">Usuario</label>
			                        	<input type="text" name="user" placeholder="Usuario" class="form-username form-control" id="user">
			                        </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="form-password">Contraseña</label>
			                        	<input type="password" name="password" placeholder="Contraseña" class="form-password form-control" id="password">
			                        </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="form-password">Contraseña</label>
                                        <input type="checkbox" value="recordar" name="recordar" id="recordar"> Recordar<br>
                                        <a href="recuperar">¿Has olvidado tus datos?</a>
                                    </div>
                                    
			                        <button type="submit" class="btn">Enviar</button>
			                    </form>
		                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<script src="assets/login/js/jquery-1.11.1.min.js"></script>
<script src="assets/login/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/login/js/jquery.backstretch.min.js"></script>
<script src="assets/login/js/scripts.js"></script>
</body>
</html> 
