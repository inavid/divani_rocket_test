$(document).ready(function() 
{
    $("#multiplo-error").hide();
    $("#no-number-error").hide();
    $("#no-number-positive").hide();
    $('#confirmacion').modal('hide');
    $('#retiraEfectivo').attr('disabled', true);
});

$("#cantidadRetiro").keyup(function(e) {
    e.preventDefault();
    var regex = /^\d*$/;
    var cantidad = $("#cantidadRetiro").val();
    if(cantidad.length > 0)
    {
        $('#retiraEfectivo').attr('disabled', false);
        if( !regex.test(cantidad) )
        {
            $("#cantidadRetiro").val("");
            $("#no-number-error").fadeIn();
            setTimeout(function()
            {
                $("#no-number-error").fadeOut();
            }, 2000);
        }
        else
        {
            if(cantidad == 0)
            {
                $("#cantidadRetiro").val("");
                $("#no-number-positive").fadeIn();
                setTimeout(function()
                {
                    $("#no-number-positive").fadeOut();
                }, 1500);
            }
        }
    }
    else
    {
        $('#retiraEfectivo').attr('disabled', true);
    }
});

$( "#limpiaCantidad" ).click(function() {
    $("#cantidadRetiro").val("");
});

$('#retiraEfectivo').click(function() {
    if($("#cantidadRetiro").val() % 10 !== 0)
    {
        $("#multiplo-error").fadeIn('slow');
        $("#cantidadRetiro").val("");
        setTimeout(function()
        {
            $("#multiplo-error").fadeOut('slow');
        }, 1500);
    }
    else
    {
        $('#cantidad').html($("#cantidadRetiro").val());
        $('#confirmacion').modal('show');
    }
});

$('#confirmacionRetiro').click(function () {
    var cantidad_a_retirar = $("#cantidadRetiro").val();
        $.ajax({
            type: "POST",
            url: "../disposicionEfectivo",
            data: {
                cantidad:cantidad_a_retirar
            },
            async: true,
            success: function (data) {
                //Se oculta modal anterior
                $('#confirmacion').modal('hide');

                //Comenzamos a pintar los textos en el modal que se mostrara como resultado
                $('#cantidadRetirada').html(cantidad_a_retirar+" Pesos");
                //Solo mostramos los billetes que vamos a entregar
                if(data.billetesCien != 0)
                {
                    $('#cantidadCien').fadeIn();
                    $('#cantidadCien').html(data.billetesCien+" Billetes de Cien.");
                }
                
                if(data.billetesCincuenta != 0)
                {
                    $('#cantidadCincuenta').fadeIn();
                    $('#cantidadCincuenta').html(data.billetesCincuenta+" Billetes de Cincuenta.");
                }

                if(data.billetesVeinte != 0)
                {
                    $('#cantidadVeinte').fadeIn();
                    $('#cantidadVeinte').html(data.billetesVeinte+" Billetes de Veinte.");
                }

                if(data.billetesDiez != 0)
                {
                    $('#cantidadDiez').fadeIn();
                    $('#cantidadDiez').html(data.billetesDiez+" Billetes de Diez.");
                }

                $('#entregaEfectivo').modal('show');
            }
        });
    return false;
});

$('#salir').click(function () {
    window.location.href = "/";
});