jQuery(document).ready(function() 
{
    $('#historial').change(function(){
        if($(this).val() != "0")
        {
            $('#loghistorial').load(encodeURI("getHistorial.php?fecha="+$(this).val()+
                "&nroiden_user="+$('#nroiden_user').val()+
                "&nroiden_adm="+$('#nroiden_adm').val()), function(data){ console.log(data); });
        }
    });
});
