<html>
<head>
<!--<script type="text/javascript" src="http://form-serialize.googlecode.com/svn/trunk/serialize-0.2.min.js" ></script>
-->
 <script >
	
var conexion;

function accionAJAX() {
	document.getElementById("aulas").innerHTML=conexion.responseText;
}


	
	function verOR() {
		
		var categoria=document.getElementById('categoria').value;
		var red=document.getElementById('red').value;
		var proyector=document.getElementById('proyector').value;
		conexion = new XMLHttpRequest();
		
		conexion.open('POST', '<?= base_url('reserva/filtrarPost')?>', true);
		conexion.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
		conexion.setRequestHeader("Content-type","application/x-www-form-urlencoded"); 
		conexion.send('categoria='+categoria+"&red="+red+"&proyector="+proyector);
	
		
		conexion.onreadystatechange = function() {
			if (conexion.readyState==4 && conexion.status==200) {
				accionAJAX();
			}
		}
	}
	




		
</script>  
	<meta charset="utf-8">
   
<!--     <style type="text/css">
        fieldset
        {
            width: 150px;
            float:left;
            margin-right: 50px;
        }
        #contenedor
        {
        	
        	float:left;
        }
    </style>
    
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
  	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  	<!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->
 
<!--  	<script>
  	$(function() {
    	$( "#sliderEquipos" ).slider({
     		value:0,
      		min: 0,
      		max: 50,
      		step: 5,
      		slide: function( event, ui ) {
        	$( "#equipos" ).val(ui.value );
      		}
    	});
    	$( "#equipos" ).val($( "#sliderEquipos" ).slider( "value" ) );

    	$( "#sliderCapacidad" ).slider({
     		value: 10,
      		min: 10,
      		max: 200,
      		step: 10,
      		slide: function( event, ui ) {
        	$( "#capacidad" ).val(ui.value );
      		}
    	});
    	$( "#capacidad" ).val($( "#sliderCapacidad" ).slider( "value" ) );
  	});

  	</script>-->
</head>
<body>

	<fieldset>
		<h3>Filtrado</h3>
		Categor&iacute;a 
		<select name="categoria" id="categoria">
			<option value="todas">Todas</option>
			<?php foreach ($categorias as $categoria):?>
				<?php foreach($categoria as $categ=>$nombre): ?>
					<option value="<?= $nombre ?>"><?= $nombre ?></option>
			<?php endforeach; ?>
		<?php endforeach;?>
		</select><br><br>
		
        Red <input type="checkbox" name="red" id="red" /><br>
		Proyector <input type="checkbox" name="proyector" id="proyector" />
         <!-- 
		<p>
  			<label for="equipos">N&uacute;mero de equipos:</label>
  			<input type="text" id="equipos" name="equipos" readonly style="border:0; color:#f6931f; font-weight:bold;">
		</p>
 
		<div id="sliderEquipos"></div>
		
		<p>
  			<label for="capacidad">Capacidad del aula:</label>
  			<input type="text" id="capacidad" name="capacidad" readonly style="border:0; color:#f6931f; font-weight:bold;">
		</p>
 
		<div id="sliderCapacidad"></div><br><br>-->
        
        <input type="submit" value="Enviar" onclick="verOR()" /><br><br>
	</fieldset>

	
	 
	<div  id="contenedor">
		<h3>Aulas disponibles</h3>
		<div id="aulas" name="aulas" ></div>
	</div>

	
</body>
</html>