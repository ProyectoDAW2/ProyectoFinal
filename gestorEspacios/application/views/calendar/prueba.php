<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<title>Calendario de eventos con bootstrap y php</title>
	<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>bower_components/bootstrap-calendar/css/calendar.css">
	<script type="text/javascript" src="<?php echo base_url() ?>bower_components/jquery/jquery.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>bower_components/bootstrap-calendar/js/language/es-ES.js"></script>
</head>
<body>
<div class="container">
		<ol class="breadcrumb">
	        <li><a href="<?php echo base_url() ?>calendar">Calendario</a></li>
	        <li><a href="<?php echo base_url() ?>insertarCalendar">A&ntilde;adir evento</a></li>
	    </ol>
		<div class="row">
			<div class="page-header">
				<div class="pull-right form-inline">
					<div class="btn-group">
						<button class="btn btn-primary" data-calendar-nav="prev"><< Anterior</button>
						<button class="btn" data-calendar-nav="today">Hoy</button>
						<button class="btn btn-primary" data-calendar-nav="next">Siguiente >></button>
					</div>
					<div class="btn-group">
						<button class="btn btn-warning" data-calendar-view="year">A&ntilde;o</button>
						<button class="btn btn-warning active" data-calendar-view="month">Mes</button>
						<button class="btn btn-warning" data-calendar-view="week">Semana</button>
						<button class="btn btn-warning" data-calendar-view="day">D&iacute;a</button>
					</div>
				</div>
			</div>		
		</div><hr>
		<div class="row">
			<div id="calendar"></div>
		</div>
		
		<!-- AQUÍ HAGO UNA PRUEBA PARA VER SI ME RECOGE LA FECHA DE LA BD, COMO ASÍ PARECE -->
		<ul>
		<?php foreach ($fechas as $fec): ?>
		<?php foreach ($fec as $f): ?>
			<li>
			<?= $f?>
			</li>
			<?php endforeach;?>
			<?php endforeach;?>
		</ul>

	</div>
    
    <script src="<?php echo base_url() ?>bower_components/underscore/underscore-min.js"></script>
    <script src="<?php echo base_url() ?>bower_components/bootstrap-calendar/js/calendar.js"></script>
    <script type="text/javascript">
	(function($){
		var date = new Date();
		var yyyy = date.getFullYear().toString();
		var mm = (date.getMonth()+1).toString().length == 1 ? "0"+(date.getMonth()+1).toString() : (date.getMonth()+1).toString();
		var dd  = (date.getDate()).toString().length == 1 ? "0"+(date.getDate()).toString() : (date.getDate()).toString();

		//establecemos los valores del calendario
		var options = {
			events_source: '<?php echo base_url() ?>insertarCalendar', //controlador
			view: 'month',
			language: 'es-ES',
			tmpl_path: '<?php echo base_url() ?>bower_components/bootstrap-calendar/tmpls/',
			tmpl_cache: false,
			day: yyyy+"-"+mm+"-"+dd,
			time_start: '10:00',
			time_end: '20:00',
			time_split: '30',
			width: '100%',
			onAfterEventsLoad: function(events) 
			{
				
				if(!events) 
				{
					return;
				}
				var list = $('#eventlist');
				list.html('');

				$.each(events, function(key, val) 
				{
					$(document.createElement('li'))
						.html('<a href="' + val.url + '">' + val.title + '</a>')
						.appendTo(list);

					/*La intención es coger el $fechas (que es la variable $datos que le pasamos a la vista
					con las fechas reservadas) para recorrerlo y ya poner colorines y demás. El fallo es
					que es variable ($fechas) no la coge y no sé por que razón*/
				});

				
				
			},
			onAfterViewLoad: function(view) 
			{
				$('.page-header h3').text(this.getTitle());
				$('.btn-group button').removeClass('active');
				$('button[data-calendar-view="' + view + '"]').addClass('active');

				
			},
			classes: {
				months: {
					general: 'label'
				}
			}
		};

		var calendar = $('#calendar').calendar(options);

	

		$('.btn-group button[data-calendar-view]').each(function() 
		{
			var $this = $(this);
			$this.click(function() 
			{
				calendar.view($this.data('calendar-view'));
			});
		});

		$('#first_day').change(function()
		{
			var value = $(this).val();
			value = value.length ? parseInt(value) : null;
			calendar.setOptions({first_day: value});
			calendar.view();
		});

		$('#events-in-modal').change(function()
		{
			var val = $(this).is(':checked') ? $(this).val() : null;
			calendar.setOptions(
				{
					modal: val,
					modal_type:'iframe'
				}
			);
		});

		$('.pull-right').each(function() 
				{
/*PULL-RIGHT ES EL NOMBRE DE LA CLASE DEL DIV QUE RECOGE LOS DATOS DE LA FECHA DEL CALENDARIO
LO QUE PRETENDO ES COMPARAR CADA UNA DE LAS FECHAS DEL CALENDARIO CON LA BASE DE DATOS
$f ES LO QUE AL COMPARARLO ME CAMBIA POR LA RESTA DE LA FECHA. PODEIS HACER UN console.log(< ? = $f?>); Y COMPROBARLO

			*/

			<?php foreach ($fechas as $fec): ?>
			<?php foreach ($fec as $f): 
			   $anyo=date('Y',strtotime($f));
			   $mes=date('m',strtotime($f));
			   $dia=date('d',strtotime($f));?>
			   
			   var fechaEntera=<?= $anyo ?>+"-"+0+<?= $mes ?>+"-"+<?= $dia ?>;
			   console.log(fechaEntera);
			   console.log("ESTE ES EL THIS" +$(this).attr("data-cal-date"));
			   
			 


			if($(this).attr("data-cal-date")==fechaEntera)
			{
				console.log("hola");
				$(this).css("color", "red");
			}
				<?php endforeach;?>
				<?php endforeach;?>
					
					});

	
		

		
	




		
	}(jQuery));
    </script>
</body>
</html>