jQuery(document).ready(function() 
{
	$('#botonchat').click(function(){
		if($('#contenedorchatabajo').css('display') === 'none')
		{
		  $('#contenedorchatabajo').css('display','inline');
		}
		else
		  $('#contenedorchatabajo').css('display','none');
		return false;
	});

	$('#button_asesoria').click(function(){
		if($('#tipo_asesoria').val() != 0)
		  window.open("chat_sf/popupchat_sf.php?asesoria="+$('#tipo_asesoria').val(), "", "directories=0, menubar=0, status=0, toolbar=0, location=0, resizable=0, scrollbars=0, fullscreen=0, height=375, width=525");
		$('#contenedorchatabajo').css('display','none');
	});
});