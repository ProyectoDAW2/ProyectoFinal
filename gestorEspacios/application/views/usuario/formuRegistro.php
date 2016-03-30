<html>
<head>
    <meta charset="utf-8">
    <style type="text/css">
    	fieldset
    	{
    		width: 50px;
    	}
    </style>
    <script type="text/javascript">
        function registrar()
        {
            var nickname= document.getElementById("nick").value;
            var pass= document.getElementById("password").value;
            var pass2= document.getElementById("password2").value;
            var email= document.getElementById("correo").value;
            
            var nickCorrecto=false;
            var passCorrecta= false;
            var emailCorrecto= false;
            
            if(/^\w{3,30}$/.test(nickname))
            {
                nickCorrecto=true;
            }
            
            if(/^(?=.*\d)(?=.*[a-zA-Z])(\W*).{6,10}$/.test(pass))
            {
                if(pass==pass2)
                {
                    passCorrecta=true;
                }

            }
            
            if(/^\w+([\-_]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(email))
            {
                emailCorrecto=true;
            }  

            if(nickCorrecto && passCorrecta && emailCorrecto)
            {
				document.getElementById("res").value= true;
            }   
            
        }
    </script>
</head>
<body>
    <h1>Formulario de registro</h1>
    <form action="<?=base_url('usuario/registrarPost')?>" method="post">
        <fieldset>
            Nick <input type="text" id="nick" name="nick"/><br><br>
            Contrase&ntilde;a <input type="password" id="password" name="password"/><br><br>
            Repite la contrase&ntilde;a <input type="password" id="password2" name="password2"/><br><br>
            Correo <input type="email" id="correo" name="correo"/><br><br>
            Clave <input type="text" id="clave" name="clave"/><br><br>
            <input type="text" id="res" name="res" hidden/>
            
            <input type="submit" value="Confirmar" onclick="registrar()"/>
        </fieldset>
    </form>
</body>
</html>