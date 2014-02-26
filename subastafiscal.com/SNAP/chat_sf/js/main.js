function getAsesores()
{
  $('#tipo_asesoria_div').stop().load('mp_functions.php', function(){});
}

$(document).ready(function()
{
  $('#botonchat').click(function(){
    if($('#contenedorchatabajo').css('display') === 'none')
    {
      getAsesores();
      $('#contenedorchatabajo').css('display','inline');
    }
    else
      $('#contenedorchatabajo').css('display','none');

  });

  $('#button_asesoria').click(function(){
    if($('#tipo_asesoria').val() != 0)
      window.open("popupchat_sf.php?asesoria="+$('#tipo_asesoria').val(), "", "directories=0, menubar=0, status=0, toolbar=0, location=0, resizable=0, scrollbars=0, fullscreen=0, height=365, width=515");
    $('#contenedorchatabajo').css('display','none');
  });
});
