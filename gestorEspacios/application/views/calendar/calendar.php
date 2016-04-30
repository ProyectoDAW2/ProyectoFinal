<!DOCTYPE html>
<html lang="en">
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
	        <li><a href="<?php echo base_url() ?>events">AÃ±adir evento</a></li>
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
						<button class="btn btn-warning" data-calendar-view="year">AÃ±o</button>
						<button class="btn btn-warning active" data-calendar-view="month">Mes</button>
						<button class="btn btn-warning" data-calendar-view="week">Semana</button>
						<button class="btn btn-warning" data-calendar-view="day">DÃ­a</button>
					</div>
				</div>
			</div>	
			<label class="checkbox">
				<input type="checkbox" value="#events-modal" id="events-in-modal"> Abrir eventos en una ventana modal
			</label>	
		</div><hr>
		<div class="row">
			<div id="calendar"></div>
		</div>
<ul>
		<!-- AQUÍ HAGO UNA PRUEBA PARA VER SI ME RECOGE LA FECHA DE LA BD, COMO ASÍ PARECE -->

		<?php foreach ($fechas as $fec): ?>
		<?php foreach ($fec as $f): ?>
			<li>
			<?= $f?>
			</li>
			<?php endforeach;?>
			<?php endforeach;?>
		</ul>
		<!--ventana modal para el calendario-->
		<div class="modal fade" id="events-modal">
		    <div class="modal-dialog">
			    <div class="modal-content">
			        <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				        <h4 class="modal-title">Modal title</h4>
			        </div>
				    <div class="modal-body" style="height: 400px">
				        <p>One fine body&hellip;</p>
				    </div>
			        <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        <button type="button" class="btn btn-primary">Save changes</button>
			        </div>
			    </div><!-- /.modal-content -->
		    </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
	</div>
    
    <script src="<?php echo base_url() ?>bower_components/underscore/underscore-min.js"></script>
    <script src="<?php echo base_url() ?>bower_components/bootstrap-calendar/js/calendar.js"></script>
    <script type="text/javascript">
	(function($){
		//creamos la fecha actual
		var date = new Date();
		var yyyy = date.getFullYear().toString();
		var mm = (date.getMonth()+1).toString().length == 1 ? "0"+(date.getMonth()+1).toString() : (date.getMonth()+1).toString();
		var dd  = (date.getDate()).toString().length == 1 ? "0"+(date.getDate()).toString() : (date.getDate()).toString();

		//establecemos los valores del calendario
		var options = {
			events_source: '<?php echo base_url() ?>events/getAll',
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

		$('.btn-group button[data-calendar-nav]').each(function() 
		{
			var $this = $(this);
			$this.click(function() 
			{
				calendar.navigate($this.data('calendar-nav'));
			});
		});

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
			LA VARIABLE X ES SIMPLEMENTE UNA PRUEBA PARA QUE PROBEIS CON 
			if(x==< ? = $f?>) y veais como cambia el estilo de los números < ? =$f lo pongo separado para poder hacer este comentario
			*/			
			
			<?php foreach ($fechas as $fec): ?>
			<?php foreach ($fec as $f): ?>
			var x=1988;
			
				if($(this).attr("data-cal-date")==<?= $f?>)
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
