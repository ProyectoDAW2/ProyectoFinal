<html>
<head>
	<meta charset="utf-8">
    
    <style type="text/css">
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
    
  	<script>
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

  	</script>
</head>
<body>
<form action="<?=base_url('reserva/filtrarPost')?>" method="post">
	<fieldset>
		<h3>Filtrado</h3>
		Categor&iacute;a 
		<select name="categoria">
			<option value="todas">Todas</option>
			<?php foreach ($categorias as $categoria):?>
				<?php foreach($categoria as $categ=>$nombre): ?>
					<option value="<?= $nombre ?>"><?= $nombre ?></option>
			<?php endforeach; ?>
		<?php endforeach;?>
		</select><br><br>
		
        Red <input type="checkbox" name="red"/><br>
		Proyector <input type="checkbox" name="proyector"/>
        
		<p>
  			<label for="equipos">N&uacute;mero de equipos:</label>
  			<input type="text" id="equipos" name="equipos" readonly style="border:0; color:#f6931f; font-weight:bold;">
		</p>
 
		<div id="sliderEquipos"></div>
		
		<p>
  			<label for="capacidad">Capacidad del aula:</label>
  			<input type="text" id="capacidad" name="capacidad" readonly style="border:0; color:#f6931f; font-weight:bold;">
		</p>
 
		<div id="sliderCapacidad"></div><br><br>
        
        <input type="submit" value="Enviar" onclick="usarAjax()"/><br><br>
	</fieldset>
</form>
	
	<!-- Generar lo de debajo con ajax 
	<div id="contenedor">
		<h3>Aulas disponibles</h3>
		<div id="aulas" name="aulas"></div>
	</div>
	-->
	
</body>
</html>