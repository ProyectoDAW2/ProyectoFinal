<!DOCTYPE html>
<html>
<head>
	<title>Crear un nuevo evento</title>
    <meta charset="utf-8">
	<head>
	  	<script src="<?php echo base_url() ?>bower_components/jquery/jquery.min.js"></script>
	  	<script src="<?php echo base_url() ?>bower_components/moment/moment.js"></script>
        <script src="./bower_components/eonasdan-bootstrap-datetimepicker/bootstrap/bootstrap.min.js"></script>
	  	<script src="<?php echo base_url() ?>bower_components/eonasdan-bootstrap-datetimepicker/src/js/bootstrap-datetimepicker.js"></script>
	  	<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	  	<link rel="stylesheet" href="<?php echo base_url() ?>bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />
	   <script src="<?php echo base_url() ?>bower_components/eonasdan-bootstrap-datetimepicker/src/js/locales/bootstrap-datetimepicker.es.js"></script>
    </head>
    <style type="text/css">
    <!-- Estilos que he puesto para que el formulario de añadir evento quede bonito y no se descuadre -->
    	.anchura{
    		width: 40%;
    		float: left;
    		margin-left: 35px;
    		margin-right: 50px;
    	}
    	
    	.horario{
    		display: inline;
    		width: 30%;
    		margin-top: 50px;
    		margin-left: 350px;
    	}
    	
    	.posicionBoton{
    		margin-top: 200px;
    		margin-right: 150px;
    	}

    </style>
</head>
<body>
<div class="container">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>calendar">Calendario</a></li>
        <li><a href="<?php echo base_url() ?>insertarCalendar">A&ntilde;adir evento</a></li>
    </ol>
    <div class="row">
    <h1 class="text-center heading">A&ntilde;adir un nuevo evento</h1><hr>
    	<form action="<?php echo base_url()?>insertarCalendar/save" method="post">
    	<!-- Fecha de inicio -->
    		<div class='anchura input-group date' id='fechaini'>
                <input type='text' name="fechaini" class="form-control" readonly />
                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
            </div>
        <!-- Fecha de fin, aunque ahora mismo no se guarda en la BD porque como solo tenemos un campo, que 
        es fecha, pues he decidido guardar solo la fecha de inicio con la hora. Pero cuando creemos
        el campo fecha de fin en la BD se guarda y ya está -->
            <div class='input-group date anchura' id='fechafin'>
                <input type='text' name="fechafin" class="form-control" readonly />
                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
            </div>
        <!-- Select con las horas -->
            <select class="horario form-control" name="horas" id="horas">
            	<option value="8:20">8:20</option>
            	<option value="9:15">9:15</option>
            	<option value="10:10">10:10</option>
            	<option value="11:00">Recreo</option>
            	<option value="11:35">11:35</option>
            	<option value="12:30">12:30</option>
            	<option value="13:25">13:25</option>
            </select>
           <!-- Todo se guarda es save() de insertarCalendar --> 
            <input type="submit" class="posicionBoton pull-right btn btn-success" value="Guardar evento">
    	</form>
    	
    </div>
    <script type="text/javascript">
        $(function () {
            $('#fechaini').datetimepicker({
                pickTime: false,
                language: 'es',
                minDate: new Date()
            });
            $('#fechafin').datetimepicker({
                pickTime: false,
                language: 'es',
                minDate: new Date()
            });
            
        });
    </script>
</div>
</body>
</html>