$(function reservandoHoras() {
	  $('td').click( function() {
	    $(this).toggleClass("reservando");
	    var horas=document.getElementsByClassName("reservando");
	    var horasCogidas="";
	    for(i=0;i<horas.length;i++)
	    {
	        horasCogidas+=(horas[i].id)+"--";
	        document.getElementById("horaCogida").value=horasCogidas;
	    }
	  } );
} );

$(function () {

    datepickerModelado("#fecha");
    
    $("#mes").on("click", function () {
        $("#fecha2").css("visibility", "visible");
        datepickerModelado("#fecha2");
    })
    $("#anyo").on("click", function () {
        $("#fecha2").css("visibility", "visible");
        datepickerModelado("#fecha2");
    })
    $("#dia").on("click",function (){
        $("#fecha2").datepicker( "destroy" );
        $("#fecha2").css("visibility", "hidden");
    })
    $.datepicker.setDefaults($.datepicker.regional['es']); //Traduccion Español

//FUNCION PARA EL COMPORTAMIENTO DE LOS DATEPICKER
    function datepickerModelado(elDatepicker) {
        $(elDatepicker).datepicker({
            minDate: new Date(),
            buttonImage: "http://localhost/ProyectoFinCurso/gestorEspacios/assets/imagenes/reserva/button-calendar.gif",
            buttonImageOnly: true,
            buttonText: "Abre el calendario",
            showOn: "both",
            beforeShowDay: noWeekendsOrHolidays,
            beforeShowDay: vacaciones,
            numberOfMonths: 2,
            showButtonPanel: true
        })
    };
  
});