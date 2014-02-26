

function tracking()
{
    if(confirm("Seguro desea ingresar este tracking"))
        return true;
    else
        document.location.reload(true);
    return false;
}


jQuery(document).ready(function() 
{
    
    
    $("#selectall").click(function() 
    {
        if($(this).prop('checked') == true)
            $('.val_pago').attr('checked', true);
        else
            $('.val_pago').attr('checked', false);
    });
    
    //Validacion de pago
    $("#validate_pagogrid").click(function() 
    {
        var aux= "";
        var answer = confirm("¿Desea Validar los registros?");
        if(answer)
        {   
            $('.val_pago').each(function() 
            {
                if($(this).prop('checked') == true)
                    aux = aux + "@" + $(this).val();
            });
            location.href= "documento_pago_grid.php?doc_codigo=" + aux; 
        }
    });
    
    $("#clean_pagogrid").click(function() 
    {
        $('.val_pago').attr('checked', false);
            
    });

    ///Fucnion encargada de los filtros
    $("#search").click(function() 
    {
        var query = $('#thispage').val();
        query += "?";
        $('.filter').each(function() 
        {
            if($(this).attr("value") != "")
            {
                query += $(this).attr("filter");
                query += "="; 
                query += $(this).attr("value");
                query += "&"; 
            }
            
        });
        $('.filtersel').each(function() 
        {
            if($(this).attr("value") != "")
            {
                query += $(this).attr("filter");
                query += "="; 
                query += $(this).attr("value");
                query += "&"; 
            }
            
        });
        location.href = query; 
    });
    
    $(".deletem").click(function() 
    {
        var answer = confirm("¿Desea Eliminar este Registro?")
        if(answer) 
        { 
            $("#deldiv").html("Eliminando");
        /*$("#deldiv").load($(this).next().attr('value'), function()
            {
                location.reload();
            });
            */
        } 
    });    

    
    $("#limpiar").click(function() 
    {
        location.href = $('#thispage').val();
    });
	
	
    $("#eliminar").click(function() {
        if($(".deletem").hasClass('deleteh'))
            $(".deletem").removeClass('deleteh');
        else
            $(".deletem").addClass('deleteh');
    });
});



