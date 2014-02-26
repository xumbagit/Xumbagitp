/*  jQuery Functions MacroPlus  */

function readframes(tframe, imgtextbox)
{
	try	{
		var doc = tframe.contentDocument? tframe.contentDocument: tframe.contentWindow.document;
		document.getElementById(imgtextbox).value = doc.getElementById('per_imgci_upload').value;	}
	catch(err){ document.getElementById(imgtextbox).value = "";}
}

function _veri1()
{
	if($('#_aqehgjhcony_vall1').val() == 0)
	{
		alert('Error: No ha agregado ningún Dato Activo.');
		return false;
	}
	return true;
}

function _veri2()
{
	if($('#_aqehgjhcony_vall2').val() == 0)
	{
		alert('Error: No ha agregado ningún Dato Activo.');
		return false;
	}
	return true;
}

function _veri3()
{
	if($('#_aqehgjhcony_vall3').val() == 0)
	{
		alert('Error: No ha agregado ningún Dato Activo.');
		return false;
	}
	return true;
}

function deleteDocDet(doc_cod, doc_det, doc_tipo){

	if(doc_tipo === 1)
	{
		$('#insert_doc_det1').attr('disabled', 'disabled');
		$('#tabla_balance_bal1').load("balance_tabla.php?req=yes&doc_codigo="+doc_cod+
		"&mode=delete&dtt_codigo="+doc_det, function(){
		  $('#insert_doc_det1').removeAttr('disabled');
		});
	}else{

		$('#insert_doc_det2').attr('disabled', 'disabled');
		$('#tabla_balance_bal2').load("balance_tabla.php?req=yes&doc_codigo="+doc_cod+
		"&mode=delete&dtt_codigo="+doc_det, function(){
		  $('#insert_doc_det2').removeAttr('disabled');
		});
	}
}

function deleteDocDetCert(doc_cod, doc_det){
  $('#insert_doc_detcert').attr('disabled', 'disabled');
  $('#tabla_cert').load("balance_cert_tabla.php?req=yes&doc_codigo="+doc_cod+
    "&mode=delete&dtt_codigo="+doc_det, function(){
      $('#insert_doc_detcert').removeAttr('disabled');
    });
}

function deletedoc(doc_cod)
{
  $('#contenedor_subasta_micuenta2').load("micuenta-action.php?doc_codigo="+ doc_cod , function(){ });
}

function filterdoc(){
  var cod_est = $('#sta_codigo').val();
  var cod_tip = $('#tip_codigo').val();
  $('#insert_doc_det').attr('disabled', 'disabled');
  $('#contenedor_subasta_micuenta2').load("micuenta-action.php?bmp_codigoest="+ cod_est+"&doc_tipo="+cod_tip , function(){
    $(this).removeAttr('disabled');
  });
  return false;
}


$.datepicker.regional['es'] = {
  closeText: 'Cerrar',
  prevText: '<Ant',
  nextText: 'Sig>',
  currentText: 'Hoy',
  monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
  monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
  dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
  dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
  dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
  weekHeader: 'Sm',
  dateFormat: 'dd/mm/yy',
  firstDay: 1,
  isRTL: false,
  showMonthAfterYear: false,
  yearSuffix: ''
};
$.datepicker.setDefaults($.datepicker.regional['es']);

$.validator.setDefaults({ ignore: ''
});

function checker()
{
    $.ajax({
        type: "POST",
        url:  "pago-service.php",
        data: "",
        datatype: "html",
        async: true,
        statusCode: {
          404: function() {
            alert("Error sistema de pago");
          }
        },
        success: function(data)
        {
          if(data == "True")
          {
              alert("Pago Realizado");
              window.location = "pago_action.php?123Pago=getter";
          }
        }
      });
    setTimeout('checker()', 5000);
}

jQuery(document).ready(function() 
{
  if ( $("#fecha").length )
	$("#fecha").datepicker();
  if ( $("#fecha_bal1").length )
	$("#fecha_bal1").datepicker();
  if ( $("#fecha_bal2").length )
	$("#fecha_bal2").datepicker();
  if ( $("#fecha_bal3").length )
	$("#fecha_bal3").datepicker();

  $("#dtt_anofin").change(function (){
        if($("#dtt_anoini").val() >= $("#dtt_anofin").val())
            $("#dtt_anoini").val($("#dtt_anofin").val());
    });

  $("#dtt_anoini").change(function (){
      if($("#dtt_anofin").val() <= $("#dtt_anoini").val())
          $("#dtt_anofin").val($("#dtt_anoini").val());
  });



  $(".telefono_num").mask("(9999) 999 9999", {
        placeholder:" "
  });
  $(".maskdate").mask('99/99/9999');

// <-- Loads the dropdowns!

	$('#select_state1').change(function(){
		$('#select_mun1').attr('disabled','true');
		$('#select_par1').attr('disabled','true');
		$('#select_mun1').load('lib/function_gen.php?mode=getmun&padre='+$(this).val(), function(){
			$('#select_par1').load('lib/function_gen.php?mode=getpar&padre='+$('#select_mun1').val(), function(){
				$('#select_mun1').removeAttr('disabled');
				$('#select_par1').removeAttr('disabled');
			});
		});
	});

	$('#select_mun1').change(function(){
		$('#select_par1').attr('disabled','true');
		$('#select_par1').load('lib/function_gen.php?mode=getpar&padre='+$(this).val(), function(){
			$('#select_par1').removeAttr('disabled');
		});
	});

	$('#select_state2').change(function(){

		$('#select_mun2').attr('disabled','true');
		$('#select_par2').attr('disabled','true');
		$('#select_mun2').load('lib/function_gen.php?mode=getmun&padre='+$(this).val(), function(){
			$('#select_par2').load('lib/function_gen.php?mode=getpar&padre='+$('#select_mun2').val(), function(){
				$('#select_mun2').removeAttr('disabled');
				$('#select_par2').removeAttr('disabled');
			});
		});
	});

	$('#select_mun2').change(function(){
		$('#select_par2').attr('disabled','true');
		$('#select_par2').load('lib/function_gen.php?mode=getpar&padre='+$(this).val(), function(){
			$('#select_par2').removeAttr('disabled');
		});
	});

	$('#select_state3').change(function(){
		$('#select_mun3').attr('disabled','true');
		$('#select_par3').attr('disabled','true');
		$('#select_mun3').load('lib/function_gen.php?mode=getmun&padre='+$(this).val(), function(){
			$('#select_par3').load('lib/function_gen.php?mode=getpar&padre='+$('#select_mun3').val(), function(){
				$('#select_mun3').removeAttr('disabled');
				$('#select_par3').removeAttr('disabled');
			});
		});
	});

	$('#select_mun3').change(function(){
		$('#select_par3').attr('disabled','true');
		$('#select_par3').load('lib/function_gen.php?mode=getpar&padre='+$(this).val(), function(){
			$('#select_par3').removeAttr('disabled');
		});
	});

  $('#select_titulo1').change(function(){ 
    $('#select_mayor1').attr('disabled','true');
    $('#select_detalle1').attr('disabled','true');
    $('#select_mayor1').load('lib/function_gen.php?mode=getmayor&padre='+$(this).val(), function(){
      $('#select_detalle1').load('lib/function_gen.php?mode=getdetalle&padre='+$('#select_mayor1').val(), function(){
        $('#select_mayor1').removeAttr('disabled');
        $('#select_detalle1').removeAttr('disabled');
        if($('#select_detalle1').val().substring(2) == 99)
          $('#valor_otros1').show();
        else
          $('#valor_otros1').hide();
      });
    });
  });

  $('#select_mayor1').change(function(){
    $('#select_detalle1').attr('disabled','true');
    $('#select_detalle1').load('lib/function_gen.php?mode=getdetalle&padre='+$(this).val(), function(){
      $('#select_detalle1').removeAttr('disabled'); 
      if($('#select_detalle1').val().substring(2) == 99)
        $('#valor_otros1').show();
      else
        $('#valor_otros1').hide();
    });
  });

  $('#select_detalle1').change(function(){
    if($('#select_detalle1').val().substring(2) == 99)
      $('#valor_otros1').show();
    else
      $('#valor_otros1').hide();
  });

  $('#select_titulo2').change(function()
  { 
    $('#select_mayor2').attr('disabled','true');
    $('#select_detalle2').attr('disabled','true');
    $('#select_mayor2').load('lib/function_gen.php?mode=getmayor&padre='+$(this).val(), function(){
      $('#select_detalle2').load('lib/function_gen.php?mode=getdetalle&padre='+$('#select_mayor2').val(), function(){
        $('#select_mayor2').removeAttr('disabled');
        $('#select_detalle2').removeAttr('disabled');
        if($('#select_detalle2').val().substring(2) == 99)
          $('#valor_otros2').show();
        else
          $('#valor_otros2').hide();
      });
    });
  });

  $('#select_mayor2').change(function()
  {
    $('#select_detalle2').attr('disabled','true');
    $('#select_detalle2').load('lib/function_gen.php?mode=getdetalle&padre='+$(this).val(), function(){
      $('#select_detalle2').removeAttr('disabled'); 
      if($('#select_detalle2').val().substring(2) == 99)
        $('#valor_otros2').show();
      else
        $('#valor_otros2').hide();
    });
  });

  $('#select_detalle2').change(function()
  {
    if($('#select_detalle2').val().substring(2) == 99)
      $('#valor_otros2').show();
    else
      $('#valor_otros2').hide();
  });

// Fin Load dropdowns --->

// <--- Validate functions

  //Validar con expresiones regulares
  $.validator.addMethod(
    "regex",
    function(value, element, regexp) {
      var re = new RegExp(regexp);
      return this.optional(element) || re.test(value);
    },
    "Campo incorrecto."
  );


var balanceValidator1 = $("#paso_filldata1").validate({
    rules: {
      nombre_bal1 : {
        required: true,
        regex: "^[a-zA-ZáéíóúüÁÉÍÓÚÜ'.\\s]{1,40}$"
      },
      apellido_bal1: {
        required: true,
        regex: "^[a-zA-ZáéíóúüÁÉÍÓÚÜ'.\\s]{1,40}$"
      },
      nro_indent_bal1: {
        required: true,
        number: true
      },
      calle_bal1: {
        required:true
      },
      edif_bal1: {
        required: true
      },
      telef_bal1: {
        required: true
      },
      per_imgci_bal1: {
        required: true
      },
      profesion_bal1: {
        required: true
      },
      actividad_com_bal1: {
        required: true
      },
      fecha_bal1: {
          required: true
      }
    },
    messages: {
      nombre_bal1 : {
        required: "(*) Campo requerido.",
        regex: "(*) Campo incorrecto."
      },
      apellido_bal1: {
        required: "(*) Campo requerido.",
        regex: "(*) Campo incorrecto."
      },
      nro_indent_bal1: {
        required: "(*) Campo requerido.",
        number: "(*) Campo incorrecto."
      },
      calle_bal1: {
        required: "(*) Campo requerido."
      },
      edif_bal1: {
        required: "(*) Campo requerido."
      },
      telef_bal1: {
        required: "(*) Campo requerido."
      },
      per_imgci_bal1: {
        required: "(*)"
      },
      profesion_bal1: {
        required: "(*) Campo requerido."
      },
      actividad_com_bal1: {
        required: "(*) Requerido."
      },
      fecha_bal1: {
          required: "(*) Requerido."
      }
    },
    errorClass: "errores",
    errorElement: "span"
  });

  var balanceValidator2 = $("#paso_filldata2").validate({
    rules: {
      nombre_bal2_cony1 : {
        required: true,
        regex: "^[a-zA-ZáéíóúüÁÉÍÓÚÜ'.\\s]{1,40}$"
      },
      apellido_bal2_cony1: {
        required: true,
        regex: "^[a-zA-ZáéíóúüÁÉÍÓÚÜ'.\\s]{1,40}$"
      },
      nro_indent_bal2_cony1: {
        required: true,
        number: true
      },
      nombre_bal2_cony2 : {
        required: true,
        regex: "^[a-zA-ZáéíóúüÁÉÍÓÚÜ'.\\s]{1,40}$"
      },
      apellido_bal2_cony2: {
        required: true,
        regex: "^[a-zA-ZáéíóúüÁÉÍÓÚÜ'.\\s]{1,40}$"
      },
      nro_indent_bal2_cony2: {
        required: true,
        number: true
      },
      calle_bal2: {
        required:true
      },
      edif_bal2: {
        required: true
      },
      per_imgci_bal2: {
        required: true
      },
      per_imgci_bal3: {
        required: true
      },
      telefono_bal2_cony1: {
        required: true
      },
      telefono_bal2_cony2: {
        required: true
      },
      profesion_cony1: {
        required: true
      },
      profesion_cony2: {
        required: true
      },
      actividad_com_cony1: {
        required: true
      },
      actividad_com_cony2: {
        required: true
      },
      fecha_bal2: {
          required: true
      }
    },
    messages: {
      nombre_bal2_cony1 : {
        required: "(*) Campo requerido."
      },
      apellido_bal2_cony1: {
        required: "(*) Campo requerido."
      },
      nro_indent_bal2_cony1: {
        required: "(*) Campo requerido.",
        number: "(*) Campo incorrecto."
      },
      nombre_bal2_cony2 : {
        required: "(*) Campo requerido."
      },
      apellido_bal2_cony2: {
        required: "(*) Campo requerido."
      },
      nro_indent_bal2_cony2: {
        required: "(*) Campo requerido.",
        number: "(*) Campo incorrecto."
      },
      calle_bal2: {
        required:"(*) Campo requerido."
      },
      edif_bal2: {
        required: "(*) Campo requerido."
      },
      per_imgci_bal2: {
        required: "(*)"
      },
      per_imgci_bal3: {
        required: "(*)"
      },
      telefono_bal2_cony1: {
        required: "(*) Campo requerido."
      },
      telefono_bal2_cony2: {
        required: "(*) Campo requerido."
      },
      profesion_cony1: {
        required: "(*) Campo requerido."
      },
      profesion_cony2: {
        required: "(*) Campo requerido."
      },
      actividad_com_cony1: {
        required: "(*) Requerido."
      },
      actividad_com_cony2: {
        required: "(*) Requerido."
      },
      fecha_bal2: {
          required: "(*) Requerido."
      }
    },
    errorClass: "errores",
    errorElement: "span"
  });

  var balanceValidator3 = $("#paso_filldata3").validate({
    rules: {
      nombre_bal3 : {
        required: true,
        regex: "^[a-zA-ZáéíóúüÁÉÍÓÚÜ'.\\s]{1,40}$"
      },
      apellido_bal3: {
        required: true,
        regex: "^[a-zA-ZáéíóúüÁÉÍÓÚÜ'.\\s]{1,40}$"
      },
      nro_indent_bal3:
      {
        required: true,
        number: true
      },
      telefono_cert: {
        required: true
      },
      calle_bal3: {
        required: true
      },
      edif_bal3: {
        required: true
      },
      profesion_bal3: {
        required: true
      },
      per_imgci_bal4: {
        required: true
      },
      actividad_com_bal3: {
        required: true
      },
      fecha_bal3: {
          required: true
      }
    },
    messages: {
      nombre_bal3 : {
        required: "(*) Campo requerido."
      },
      apellido_bal3: {
        required: "(*) Campo requerido."
      },
      nro_indent_bal3:{
        required: "(*) Campo requerido.",
        number: "(*) Campo inválido."
      },
      telefono_cert: {
        required: "(*) Campo requerido."
      },
      calle_bal3: {
        required: "(*) Campo requerido."
      },
      edif_bal3: {
        required: "(*) Campo requerido."
      },
      profesion_bal3: {
        required: "(*) Campo requerido."
      },
      per_imgci_bal4: {
        required: "(*)"
      },
      actividad_com_bal3: {
        required: "(*) Requerido."
      },
      fecha_bal3: {
          required: "(*) Requerido."
      }
    },
    errorClass: "errores",
    errorElement: "span"
  });

  var pagoValidator = $("#paso_pago").validate({
    rules: {
      fecha: {
        required: true
      }
    },
    messages: {
      fecha: {
        required: "(*) Campo requerido."
      }
    },
    errorClass: "errores",
    errorElement: "span"
  });

  var reportaValidator = $("#paso_reporta").validate({
    rules: {
      nro_ident_reporta: {
        required: true, 
        number: true
      },
      nombre_reporta: {
        required: true,
        regex: "^[a-zA-ZáéíóúüÁÉÍÓÚÜ'.\\s]{1,40}$"
      },
      apellido_reporta: {
        required: true,
        regex: "^[a-zA-ZáéíóúüÁÉÍÓÚÜ'.\\s]{1,40}$"
      },
      telef_reporta: {
        required: true
      },
	  profesion_reporta: {
		required: true
	  },
	  actividad_com_reporta: {
		required: true
	  },
      calle_reporta: {
        required: true
      },
      edif_reporta: {
        required: true
      }
    },
    messages: {
      nro_ident_reporta: {
        required: "(*) Campo requerido.",
        number: "(*) Campo inválido."
      },
      nombre_reporta: {
        required: "(*) Campo requerido."
      },
      apellido_reporta: {
        required: "(*) Campo requerido."
      },
      telef_reporta: {
        required: "(*) Campo requerido."
      },
      calle_reporta: {
        required: "(*) Campo requerido."
      },
      edif_reporta: {
        required: "(*) Campo requerido."
      },
	  profesion_reporta: {
		required: "(*) Campo requerido."
	  },
	  actividad_com_reporta: {
		required: "(*) Campo requerido."
	  }
    },
    errorClass: "errores",
    errorElement: "span"
  });

// Fin Validate functions  --->

// <--- Change, click and blur functions

  $('#tipo_pago').change(function()
  {
    $('.gen').attr("style","display:none");
    if($(this).val() == 1){
	  $('#num_deposito').rules("add",
	  {
		required: true,
		messages: { required: "(*) Campo Requerido." }
	  });
	  $('#num_transf').rules("remove");
	  
      $('#deposito').removeAttr("style");
      $('#general').removeAttr("style");
      $('.botoninputbalance1').attr("style","display:inline");
    }else if($(this).val() == 2){
	  $('#num_transf').rules("add",
	  {
		required: true,
		messages: { required: "(*) Campo Requerido." }
	  });
	  $('#num_deposito').rules("remove");
	  
      $('#transferencia').removeAttr("style");
      $('#general').removeAttr("style");
      $('.botoninputbalance1').attr("style","display:inline");
    }else if($(this).val() == 3){
      $('#tarjeta').removeAttr("style");
      //$('.botoninputbalance1').attr("style","display:inline");
      
    }
  });
  
  $('#submit_pago').click(function(){
	if($('#tipo_pago').val() == 1){
		if($('#num_deposito').valid() && $('#fecha').valid()) return true;
		else return false;
	}else if($('#tipo_pago').val() == 2){
		if($('#num_transf').valid() && $('#fecha').valid()) return true;
		else return false;
	}
  });

  $('#return').click(function(){
    document.location.href = "balance_action.php?return=1";
  });

  $('#user_insert').click(function(){
    if(confirm("¿Está seguro de los datos ingresados? \nNo podrán ser modificados posteriormente."))
		if($('#nro_indent_bal1').valid()  &&
		 $('#apellido_bal1').valid()      &&
		 $('#nombre_bal1').valid()        &&
		 $('#telef_bal1').valid()         &&
		 $('#profesion_bal1').valid()     &&
		 $('#actividad_com_bal1').valid() &&
		 $('#per_imgci_bal1').valid()     &&
		 $('#fecha_bal1').valid())
		{
		  $(this).attr('disabled', 'disabled');
		  $(this).val('Cargando...');
		  $('#nombre_bal1').attr('disabled', 'disabled');
		  $('#apellido_bal1').attr('disabled', 'disabled');
		  $('#telef_bal1').attr('disabled', 'disabled');
		  $('#profesion_bal1').attr('disabled', 'disabled');
		  $('#actividad_com_bal1').attr('disabled', 'disabled');
		  $('#fecha_bal1').attr('disabled', 'disabled');

		  $.ajax({
			type: "POST",
			url:  "balance_action.php",
			data: "ci_rif="+$('#type_ci').val()+""+$('#nro_indent_bal1').val()+
			"&nombre_per="+$('#nombre_bal1').val()+
			"&apellido_per="+$('#apellido_bal1').val()+
			"&per_imgci_bal1="+$('#per_imgci_bal1').val()+
			"&telef_bal1="+$('#telef_bal1').val()+
			"&profesion_bal1="+$('#profesion_bal1').val()+
			"&fecha_bal1="+$('#fecha_bal1').val()+
			"&actividad_com_bal1="+$('#actividad_com_bal1').val(),
			datatype: "html",
			async: true,
			statusCode: {
			  404: function() {
				alert("page not found");
			  }
			},
			success: function(data)
			{
			  $('#modificar_user1').removeAttr('style');
			  $('#nro_indent_bal1_hidden').attr('value',data);
			  $('#nro_indent_bal1').attr('disabled', 'disabled');
			  $('#type_ci').attr('disabled', 'disabled');
			  $('#imgframe_bal1').attr("src", "balance-upload.php?per_imgci=" + $('#per_imgci_bal1').val());
			  $('#per_imgci_bal1').attr("value", $('#per_imgci_bal1').val());
			  $('#user_insert').attr('style', 'display: none');
			  $('#data_cuenta_bal1').fadeIn("slow");
			}
		  });
		}

    $('#nro_indent_bal1').valid();
    $('#apellido_bal1').valid();
    $('#nombre_bal1').valid();
    $('#per_imgci_bal1').valid();
    $('#telef_bal1').valid();
    $('#profesion_bal1').valid();
    $('#actividad_com_bal1').valid();
    $('#fecha_bal1').valid();
  });

  $('#conyugal_insert').click(function()
  {
	if(confirm("¿Está seguro de los datos ingresados? \nNo podrán ser modificados posteriormente."))
		if($('#nro_indent_bal2_cony1').valid() &&
		   $('#nombre_bal2_cony1').valid()     &&
		   $('#apellido_bal2_cony1').valid()   &&
		   $('#telefono_bal2_cony1').valid()   &&
		   $('#profesion_cony1').valid()       &&
		   $('#actividad_com_cony1').valid()   &&
		   $('#per_imgci_bal2').valid()        &&
		   $('#nro_indent_bal2_cony2').valid() &&
		   $('#nombre_bal2_cony2').valid()     &&
		   $('#apellido_bal2_cony2').valid()   &&
		   $('#telefono_bal2_cony2').valid()   &&
		   $('#profesion_cony2').valid()       &&
		   $('#actividad_com_cony2').valid()   &&
		   $('#per_imgci_bal3').valid()        &&
		   $('#fecha_bal2').valid())
		{
		  $(this).attr('disabled', 'disabled');
		  $(this).val('Cargando...');

		  $('#type_ci2_cony1').attr('disabled', 'disabled');
		  $('#nro_indent_bal2_cony1').attr('disabled', 'disabled');
		  $('#nombre_bal2_cony1').attr('disabled', 'disabled');
		  $('#apellido_bal2_cony1').attr('disabled', 'disabled');
		  $('#telefono_bal2_cony1').attr('disabled', 'disabled');
		  $('#profesion_cony1').attr('disabled', 'disabled');
		  $('#actividad_com_cony1').attr('disabled', 'disabled');
		  $('#type_ci2_cony2').attr('disabled', 'disabled');
		  $('#nro_indent_bal2_cony2').attr('disabled', 'disabled');
		  $('#nombre_bal2_cony2').attr('disabled', 'disabled');
		  $('#apellido_bal2_cony2').attr('disabled', 'disabled');
		  $('#telefono_bal2_cony2').attr('disabled', 'disabled');
		  $('#profesion_cony2').attr('disabled', 'disabled');
		  $('#actividad_com_cony2').attr('disabled', 'disabled');
		  $('#fecha_bal2').attr('disabled', 'disabled');

		  $.ajax({
			type: "POST",
			url:  "balance_action.php",
			data: "ci_cony1="+$('#type_ci2_cony1').val()+""+$('#nro_indent_bal2_cony1').val()+
			"&nombre_cony1="+$('#nombre_bal2_cony1').val()+
			"&apellido_cony1="+$('#apellido_bal2_cony1').val()+
			"&ci_cony2="+$('#type_ci2_cony2').val()+""+$('#nro_indent_bal2_cony2').val()+
			"&nombre_cony2="+$('#nombre_bal2_cony2').val()+
			"&apellido_cony2="+$('#apellido_bal2_cony2').val()+
			"&per_imgci_bal2="+$('#per_imgci_bal2').val()+
			"&per_imgci_bal3="+$('#per_imgci_bal3').val()+
			"&telefono_cony1="+$('#telefono_bal2_cony1').val()+
			"&telefono_cony2="+$('#telefono_bal2_cony2').val()+
			"&profesion_cony1="+$('#profesion_cony1').val()+
			"&actividad_cony1="+$('#actividad_com_cony1').val()+
			"&profesion_cony2="+$('#profesion_cony2').val()+
			"&fecha_bal2="+$('#fecha_bal2').val()+
			"&actividad_cony2="+$('#actividad_com_cony2').val(),
			datatype: "html",
			async: true,
			statusCode: {
			  404: function() {
				alert("page not found");
			  }
			},
			success: function(data)
			{
			  $('#modificar_user_cony1').removeAttr('style');
			  $('#modificar_user_cony2').removeAttr('style');
			  data = data.split("@@");
			  $('#nro_ident_cony1_hidden').attr('value',data[0]);
			  $('#nro_ident_cony2_hidden').attr('value',data[1]);
				$('#imgframe').attr("src", "balance-upload.php?per_imgci=" + $('#per_imgci_bal2').val());
				//$('#per_imgci_bal2').attr("value", $('#per_imgci_bal2').val());
				$('#imgframe2').attr("src", "balance-upload.php?per_imgci=" + $('#per_imgci_bal3').val());
				//$('#per_imgci_bal3').attr("value", $('#per_imgci_bal3').val());
			  $('#conyugal_insert').attr('style', 'display: none');
			  $('#data_cuenta_bal2').fadeIn("slow");
			}
		  });
		}
    $('#nro_indent_bal2_cony1').valid();
    $('#nombre_bal2_cony1').valid();
    $('#apellido_bal2_cony1').valid();
    $('#nro_indent_bal2_cony2').valid();
    $('#nombre_bal2_cony2').valid();
    $('#apellido_bal2_cony2').valid();
    $('#per_imgci_bal2').valid();
    $('#per_imgci_bal3').valid();
    $('#telefono_bal2_cony1').valid();
    $('#telefono_bal2_cony2').valid();
    $('#profesion_cony1').valid();
    $('#actividad_com_cony1').valid();
    $('#profesion_cony2').valid();
    $('#actividad_com_cony2').valid();
    $('#fecha_bal2').valid();
  });

  $('#certificado_insert').click(function()
  {
	if(confirm("¿Está seguro de los datos ingresados? \nNo podrán ser modificados posteriormente."))
		if($('#nro_indent_bal3').valid()    &&
		   $('#apellido_bal3').valid()      &&
		   $('#nombre_bal3').valid()        &&
		   $('#telefono_cert').valid()      &&
		   $('#profesion_bal3').valid()     &&
		   $('#actividad_com_bal3').valid() &&
		   $('#per_imgci_bal4').valid()     &&
		   $('#fecha_bal3').valid())
		{
		  $(this).attr('disabled', 'disabled');
		  $(this).val('Cargando...');

		  $('#type_ci3').attr('disabled', 'disabled');
		  $('#nro_indent_bal3').attr('disabled', 'disabled');
		  $('#apellido_bal3').attr('disabled', 'disabled');
		  $('#nombre_bal3').attr('disabled', 'disabled');
		  $('#telefono_cert').attr('disabled', 'disabled');
		  $('#profesion_bal3').attr('disabled', 'disabled');
		  $('#actividad_com_bal3').attr('disabled', 'disabled');
		  $('#fecha_bal3').attr('disabled', 'disabled');

		  $.ajax({
			type: "POST",
			url:  "balance_action.php",
			data: "ci_cert="+$('#type_ci3').val()+""+$('#nro_indent_bal3').val()+
			"&nombre_cert="+$('#nombre_bal3').val()+
			"&apellido_cert="+$('#apellido_bal3').val()+
			"&prof_cert="+$('#profesion_bal3').val()+
			"&telefono_cert="+$('#telefono_cert').val()+
			"&actividad_com_bal3="+$('#actividad_com_bal3').val()+
			"&per_imgci_bal4="+$('#per_imgci_bal4').val()+
			"&fecha_bal3="+$('#fecha_bal3').val(),
			datatype: "html",
			async: true,
			statusCode: {
			  404: function() {
				alert("page not found");
			  }
			},
			success: function(data)
			{
			  $('#modificar_user4').removeAttr('style');
			  $('#nro_indent_bal3_hidden').attr('value',data);
			  $('#certificado_insert').attr('style', 'display: none');
			  $('#imgframe_bal3').attr("src", "balance-upload.php?per_imgci=" + $('#per_imgci_bal4').val());
			  $('#data_cuenta_bal3').fadeIn("slow");
			}
		  });   
		}
    $('#nro_indent_bal3').valid();
    $('#apellido_bal3').valid();
    $('#nombre_bal3').valid();
    $('#profesion_bal3').valid();
    $('#actividad_com_bal3').valid()
    $('#telefono_cert').valid();
    $('#per_imgci_bal4').valid();
    $('#fecha_bal3').valid();
  });

  $('#reporta_insert').click(function()
  {
	if(confirm("¿Está seguro de los datos ingresados? No podrán ser modificados posteriormente."))
		if($('#nro_ident_reporta').valid() &&
		   $('#nombre_reporta').valid()   &&
		   $('#apellido_reporta').valid()     &&
		   $('#telef_reporta').valid() &&
		   $('#profesion_reporta').valid() &&
		   $('#actividad_com_reporta').valid())
		{
		  $(this).attr('disabled', 'disabled');
		  $(this).val('Cargando...');

		  $('#type_ci_reporta').attr('disabled', 'disabled');
		  $('#nro_ident_reporta').attr('disabled', 'disabled');
		  $('#nombre_reporta').attr('disabled', 'disabled');
		  $('#apellido_reporta').attr('disabled', 'disabled');
		  $('#telef_reporta').attr('disabled', 'disabled');
		  $('#profesion_reporta').attr('disabled', 'disabled');
		  $('#actividad_com_reporta').attr('disabled', 'disabled');

		  $.ajax({
			type: "POST",
			url:  "balance_action.php",
			data: "ci_reporta="+$('#type_ci_reporta').val()+""+$('#nro_ident_reporta').val()+
			"&nombre_reporta="+$('#nombre_reporta').val()+
			"&apellido_reporta="+$('#apellido_reporta').val()+
			"&telef_reporta="+$('#telef_reporta').val()+
			"&profesion_reporta="+$('#profesion_reporta').val()+
			"&actividad_com_reporta="+$('#actividad_com_reporta').val(),
			datatype: "html",
			async: true,
			statusCode: {
			  404: function() {
				alert("page not found");
			  }
			},
			success: function(data)
			{
			  $('#modificar_user5').removeAttr('style');
			  $('#reporta_insert').attr('style', 'display: none');
			  $('#reporta_domicilio').fadeIn("slow");
			}
		  });   
		}
    $('#nro_ident_reporta').valid();
    $('#nombre_reporta').valid();
    $('#apellido_reporta').valid();
    $('#telef_reporta').valid();
	$('#profesion_reporta').valid();
	$('#actividad_com_reporta').valid();
  });


  $('#insert_doc_det1').click(function()
  {
    $('#valor_act_bal1').rules("add",
    {
      required: true,
      number: true,
      messages: {
        required: "(*) Campo requerido.",
        number:   "(*) Campo incorrecto."
      }
    });

    if($('#valor_act_bal1').valid())
    {
      $('#valor_otros_bal1').rules("add",
      {
        required: true,
        messages: {
          required: "(*) Campo requerido."
        }
      });

      if($('#select_detalle1').val().substring(2) == 99)
      {
        if($('#valor_otros_bal1').valid())
        {
          $(this).attr('disabled', 'disabled');
          $('#tabla_balance_bal1').load(encodeURI('balance_tabla.php?req=yes&mode=insert&dtt_monto='+
            $('#valor_act_bal1').val()+'&cta_codigo='+
            $('#select_detalle1').val()+'&ddt_text='+
            $('#valor_otros_bal1').val()), function(){
              $('#insert_doc_det1').removeAttr('disabled');
              $('#valor_act_bal1').attr('value','');
              $('#valor_otros_bal1').attr('value','');
          });
        }
      }else{

        $(this).attr('disabled', 'disabled');
        $('#tabla_balance_bal1').load('balance_tabla.php?req=yes&mode=insert&dtt_monto='+
          $('#valor_act_bal1').val()+'&cta_codigo='+
          $('#select_detalle1').val()+'&ddt_text='+
          $('#valor_otros_bal1').val(), function(){
            $('#insert_doc_det1').removeAttr('disabled');
            $('#valor_act_bal1').attr('value','');
            $('#valor_otros_bal1').attr('value','');
        });
      }
    }
    $('#valor_act_bal1').rules("remove");
    $('#valor_otros_bal1').rules("remove");
    return false;
  });


  $('#insert_doc_det2').click(function()
  {
    $('#valor_act_bal2').rules("add",
    {
      required: true,
      number: true,
      messages: {
        required: "(*) Campo requerido.",
        number: "(*) Campo incorrecto."
      }
    });

    if($('#valor_act_bal2').valid())
    {
      $('#valor_otros_bal2').rules("add",
      {
        required: true,
        messages: {
          required: "(*) Campo requerido."
        }
      });

      if($('#select_detalle2').val().substring(2) == 99)
      {
        if($('#valor_otros_bal2').valid())
        {
          $(this).attr('disabled', 'disabled');
          $('#tabla_balance_bal2').load('balance_tabla.php?req=yes&mode=insert&dtt_monto='+
            $('#valor_act_bal2').val()+'&cta_codigo='+
            $('#select_detalle2').val()+'&ddt_text='+
            $('#valor_otros_bal2').val(), function(){
              $('#insert_doc_det2').removeAttr('disabled');
              $('#valor_act_bal2').attr('value','');
              $('#valor_otros_bal2').attr('value','');
          });
        }
      }else{

        $(this).attr('disabled', 'disabled');
        $('#tabla_balance_bal2').load('balance_tabla.php?req=yes&mode=insert&dtt_monto='+
          $('#valor_act_bal2').val()+'&cta_codigo='+
          $('#select_detalle2').val()+'&ddt_text='+
          $('#valor_otros_bal2').val(), function(){
            $('#insert_doc_det2').removeAttr('disabled');
            $('#valor_act_bal2').attr('value','');
            $('#valor_otros_bal2').attr('value','');
        });
      }
    }
    $('#valor_act_bal2').rules("remove");
    $('#valor_otros_bal2').rules("remove");
    return false;
  });

  $('#insert_doc_detcert').click(function()
  {
    $('#doc_monto_insert').rules("add", {
      required: true,
      number: true,
      messages: {
        required: "(*) Campo requerido.",
        number: "(*) Campo incorrecto."
      }
    });
    
    $('#doc_text_insert').rules("add", {
      required: true,
      regex : "^[a-zA-Z0-9\-]{1,40}$",
      messages: {
        required: "(*) Campo requerido.",
        regex: "(*) Campo incorrecto."
      }
    });

    $('#dtt_soportecert').rules("add", {
      required: true,
      messages: {
        required: "(*) Campo requerido."
      }
    });

    if($('#doc_text_insert').valid()  && 
       $('#doc_monto_insert').valid() && 
       $('#dtt_soportecert').valid())
    {
      var aux = 0;
      if($('#doc_cuentaext_insert').prop('checked'))
        aux = 99;
      var page = (encodeURI('balance_cert_tabla.php?mode=insert&' +
        '&dtt_mesini='   + $('#dtt_anoini').val() + '' + $('#dtt_mesini').val() +
        '&dtt_mesfin='   + $('#dtt_anofin').val() + '' + $('#dtt_mesfin').val() +
        '&dtt_monto='    + $('#doc_monto_insert').val()+
        '&dtt_text='     + $('#doc_text_insert').val() + 
        '&dtt_soporte='  + $('#dtt_soportecert').val() + 
        '&dtt_ext=' +  aux));
      $(this).attr('disabled', 'disabled');
      $('#tabla_cert').stop().load(page, 
      function(){
        $('#imgframecert').attr("src", "balance-upload.php");
        $('#insert_doc_detcert').removeAttr('disabled');
        $('#dtt_soportecert').attr('value','');
        $('#doc_monto_insert').attr('value','');
        $('#doc_cuentaext_insert').attr('value','');
        $('#doc_text_insert').attr('value','');
      });
    }
    $('#doc_monto_insert').rules("remove");
    $('#doc_text_insert').rules("remove");
    $('#dtt_soportecert').rules("remove");
    return false;
  });

  $('#tab1').click(function()
  {
    $('#personal_form').stop().load("personal_balance_form.php?req=yes", function(){ $.getScript("js/main.js"); }).abort();
  });

  $('#tab2').click(function()
  {
    $('#conyugal_form').stop().load("conyugal_balance_form.php?req=yes", function(){ $.getScript("js/main.js"); }).abort();
  });

  $('#tab3').click(function()
  {
    $('#certificado_form').stop().load("certificacion_balance_form.php?req=yes", function(){ $.getScript("js/main.js"); }).abort();
  });

  $('#nro_indent_bal1').blur(function()
  {
	$('#aceptar_user1').attr('style', 'display:none');
	$('#aceptar_user1').val("Realizar Cambios");
	$('#modificar_user1').removeAttr('style');
	
    if($(this).val().trim())
    {
      $(this).attr('disabled', 'disabled');
      $('#type_ci').attr('disabled', 'disabled');
      $('#nombre_bal1').attr('value','Cargando...');
      $('#apellido_bal1').attr('value','Cargando...');
      $('#telef_bal1').attr('value','Cargando...');
      $('#actividad_com_bal1').attr('value','Cargando...');
      $('#nombre_bal1').attr('disabled', 'disabled');
      $('#apellido_bal1').attr('disabled', 'disabled');
      $('#telef_bal1').attr('disabled', 'disabled');
      $('#profesion_bal1').attr('disabled', 'disabled');
      $('#actividad_com_bal1').attr('disabled', 'disabled');
      $('#user_insert').attr('disabled', 'disabled');
      $('#user_insert').val('Cargando...');

      $.ajax({
        type: "POST",
        url:  "balance_action.php",
        data: "ci_rif_ret="+$('#type_ci').val()+""+$('#nro_indent_bal1').val(),
        datatype: "html",
        async: true,
        statusCode: {
          404: function() {
            alert("page not found");
          }
        },
        success: function(data)
        {
          if(data)
          {
            data = data.split('@@');
            $('#nombre_bal1').attr('value',data[0]);
            $('#apellido_bal1').attr('value',data[1]);
            $('#profesion_bal1').val(data[2]).attr('selected',true);
            $('#actividad_com_bal1').attr('value',data[3]);
            $('#telef_bal1').attr('value',data[4]);
            if(data[5] != 'no_foto.jpg')
            {
                    $('#imgframe_bal1').attr("src", "balance-upload.php?per_imgci=" + data[5]);
                    $('#per_imgci_bal1').attr("value", data[5]);
            }
            $('#user_insert').val('Agregar');
            $('#user_insert').removeAttr('disabled');
            $('#user_insert').focus();

          }else{
			$('#modificar_user1').attr('style', 'display:none');
			$('#aceptar_user1').attr('style', 'display:none');
            $('#imgframe_bal1').attr("src", "balance-upload.php");
            $('#per_imgci_bal1').attr('value',"");
            $('#nombre_bal1').attr('value',"");
            $('#apellido_bal1').attr('value',"");
            $('#telef_bal1').attr('value',"");
            $('#profesion_bal1').attr('value',"");
            $('#actividad_com_bal1').attr('value',"");
            $('#nombre_bal1').removeAttr('disabled');
            $('#apellido_bal1').removeAttr('disabled');
            $('#telef_bal1').removeAttr('disabled');
            $('#profesion_bal1').removeAttr('disabled');
            $('#actividad_com_bal1').removeAttr('disabled');
            $('#user_insert').val('Agregar');
            $('#user_insert').removeAttr('disabled');
            $('#nombre_bal1').focus();
          }
          $('#nro_indent_bal1').removeAttr('disabled');
          $('#type_ci').removeAttr('disabled');
        }
      });
    }else{
		$('#modificar_user1').attr('style', 'display:none');
		$('#aceptar_user1').attr('style', 'display:none');
      if($('#nombre_bal1').attr('disabled') == 'disabled')
      {
        $('#imgframe_bal1').attr("src", "balance-upload.php");
        $('#per_imgci_bal1').attr('value',"");
        $('#nombre_bal1').attr('value',"");
        $('#apellido_bal1').attr('value',"");
        $('#telef_bal1').attr('value',"");
        $('#profesion_bal1').attr('value',"");
        $('#actividad_com_bal1').attr('value',"");
        $('#user_insert').val('Agregar');
        $('#nombre_bal1').removeAttr('disabled');
        $('#apellido_bal1').removeAttr('disabled');
        $('#telef_bal1').removeAttr('disabled');
        $('#user_insert').removeAttr('disabled');
        $('#profesion_bal1').removeAttr('disabled');
        $('#actividad_com_bal1').removeAttr('disabled');
      }
    }
  });

  $('#nro_indent_bal2_cony1').blur(function()
  {
	$('#aceptar_user_cony1').attr('style', 'display:none');
	$('#aceptar_user_cony1').val("Realizar Cambios");
	$('#modificar_user_cony1').removeAttr('style');
    if($(this).val().trim())
    {
      $(this).attr('disabled', 'disabled');
      $('#type_ci2_cony1').attr('disabled', 'disabled');
      $('#nombre_bal2_cony1').attr('disabled', 'disabled');
      $('#apellido_bal2_cony1').attr('disabled', 'disabled');
      $('#telefono_bal2_cony1').attr('disabled', 'disabled');
      $('#profesion_cony1').attr('disabled', 'disabled');
      $('#actividad_com_cony1').attr('disabled', 'disabled');
      $('#conyugal_insert').attr('disabled', 'disabled');
      $('#nombre_bal2_cony1').attr('value','Cargando...');
      $('#apellido_bal2_cony1').attr('value','Cargando...');
      $('#telefono_bal2_cony1').attr('value','Cargando...');
      $('#actividad_com_cony1').attr('value','Cargando...');
      $('#conyugal_insert').val('Cargando...');

      $.ajax({
        type: "POST",
        url:  "balance_action.php",
        data: "ci_rif_ret="+$('#type_ci2_cony1').val()+""+$('#nro_indent_bal2_cony1').val(),
        datatype: "html",
        async: true,
        statusCode: {
          404: function() {
            alert("page not found");
          }
        },
        success: function(data)
        {
          if(data)
          {
            data = data.split('@@');
            $('#nombre_bal2_cony1').attr('value',data[0]);
            $('#apellido_bal2_cony1').attr('value',data[1]);
            $('#profesion_cony1').val(data[2]).attr('selected',true);
            $('#actividad_com_cony1').attr('value',data[3]);
            $('#telefono_bal2_cony1').attr('value',data[4]);
            if(data[5] != 'no_foto.jpg')
            {
                    $('#imgframe').attr("src", "balance-upload.php?per_imgci=" + data[5]);
                    $('#per_imgci_bal2').attr("value", data[5]);
            }
            $('#nro_indent_bal2_cony2').focus();
          }else{
			$('#modificar_user_cony1').attr('style', 'display:none');
			$('#aceptar_user_cony1').attr('style', 'display:none');
            $('#imgframe').attr("src", "balance-upload.php?");
            $('#per_imgci_bal2').attr('value','');
            $('#nombre_bal2_cony1').attr('value','');
            $('#apellido_bal2_cony1').attr('value','');
            $('#telefono_bal2_cony1').attr('value','');
            $('#actividad_com_cony1').attr('value','');
            $('#profesion_cony1').attr('value','');
            $('#nombre_bal2_cony1').removeAttr('disabled');
            $('#apellido_bal2_cony1').removeAttr('disabled');
            $('#telefono_bal2_cony1').removeAttr('disabled');
            $('#actividad_com_cony1').removeAttr('disabled');
            $('#profesion_cony1').removeAttr('disabled');
            $('#nombre_bal2_cony1').focus();
          }
          $('#conyugal_insert').val('Agregar');
          $('#conyugal_insert').removeAttr('disabled');
          $('#type_ci2_cony1').removeAttr('disabled');
          $('#nro_indent_bal2_cony1').removeAttr('disabled');       
        }
      });
    }else{
		$('#modificar_user_cony1').attr('style', 'display:none');
		$('#aceptar_user_cony1').attr('style', 'display:none');
      if($('#nombre_bal2_cony1').attr('disabled') == 'disabled')
      {
        $('#imgframe').attr("src", "balance-upload.php?");
        $('#per_imgci_bal2').attr('value','');
        $('#nombre_bal2_cony1').attr('value','');
        $('#apellido_bal2_cony1').attr('value','');
        $('#actividad_com_cony1').attr('value','');
        $('#telefono_bal2_cony1').attr('value','');
        $('#profesion_cony1').attr('value','');
        $('#conyugal_insert').val('Agregar');
        $('#conyugal_insert').removeAttr('disabled');
        $('#nombre_bal2_cony1').removeAttr('disabled');
        $('#apellido_bal2_cony1').removeAttr('disabled');
        $('#telefono_bal2_cony1').removeAttr('disabled');
        $('#actividad_com_cony1').removeAttr('disabled');
        $('#profesion_cony1').removeAttr('disabled');
      }
    }
  });

  $('#nro_indent_bal2_cony2').blur(function()
  {
	$('#aceptar_user_cony2').attr('style', 'display:none');
	$('#aceptar_user_cony2').val("Realizar Cambios");
	$('#modificar_user_cony2').removeAttr('style');
    if($(this).val().trim())
    {
      $(this).attr('disabled', 'disabled');
      $('#type_ci2_cony2').attr('disabled', 'disabled');
      $('#nombre_bal2_cony2').attr('disabled', 'disabled');
      $('#apellido_bal2_cony2').attr('disabled', 'disabled');
      $('#telefono_bal2_cony2').attr('disabled', 'disabled');
      $('#profesion_cony2').attr('disabled', 'disabled');
      $('#actividad_com_cony2').attr('disabled', 'disabled');
      $('#conyugal_insert').attr('disabled', 'disabled');
      $('#nombre_bal2_cony2').attr('value','Cargando...');
      $('#apellido_bal2_cony2').attr('value','Cargando...');
      $('#telefono_bal2_cony2').attr('value','Cargando...');
      $('#actividad_com_cony2').attr('value','Cargando...');
      $('#conyugal_insert').val('Cargando...');

      $.ajax({
        type: "POST",
        url:  "balance_action.php",
        data: "ci_rif_ret="+$('#type_ci2_cony2').val()+""+$('#nro_indent_bal2_cony2').val(),
        datatype: "html",
        async: true,
        statusCode: {
          404: function() {
            alert("page not found");
          }
        },
        success: function(data)
        {
          if(data)
          {
            data = data.split('@@');
            $('#nombre_bal2_cony2').attr('value',data[0]);
            $('#apellido_bal2_cony2').attr('value',data[1]);
            $('#profesion_cony2').val(data[2]).attr('selected',true);
            $('#actividad_com_cony2').attr('value',data[3]);
            $('#telefono_bal2_cony2').attr('value',data[4]);
            if(data[5] != 'no_foto.jpg')
            {
                    $('#imgframe2').attr("src", "balance-upload.php?per_imgci=" + data[5]);
                    $('#per_imgci_bal3').attr("value", data[5]);
            }
            $('#conyugal_insert').val('Agregar');
            $('#conyugal_insert').removeAttr('disabled');
            //$('#nro_indent_bal2_cony2').focus();
          }else{
			$('#modificar_user_cony2').attr('style', 'display:none');
			$('#aceptar_user_cony2').attr('style', 'display:none');
            $('#imgframe2').attr("src", "balance-upload.php?");
            $('#per_imgci_bal3').attr('value','');
            $('#nombre_bal2_cony2').attr('value','');
            $('#apellido_bal2_cony2').attr('value','');
            $('#telefono_bal2_cony2').attr('value','');
            $('#actividad_com_cony2').attr('value','');
            $('#profesion_cony2').attr('value','');
            $('#nombre_bal2_cony2').removeAttr('disabled');
            $('#apellido_bal2_cony2').removeAttr('disabled');
            $('#telefono_bal2_cony2').removeAttr('disabled');
            $('#actividad_com_cony2').removeAttr('disabled');
            $('#profesion_cony2').removeAttr('disabled');
            $('#conyugal_insert').val('Agregar');
            $('#conyugal_insert').removeAttr('disabled');
            $('#nombre_bal2_cony2').focus();
          }
          $('#type_ci2_cony2').removeAttr('disabled');
          $('#nro_indent_bal2_cony2').removeAttr('disabled');       
        }
      });
    }else{
		$('#modificar_user_cony2').attr('style', 'display:none');
		$('#aceptar_user_cony2').attr('style', 'display:none');
      if($('#nombre_bal2_cony2').attr('disabled') == 'disabled')
      {
        $('#imgframe2').attr("src", "balance-upload.php?");
        $('#per_imgci_bal3').attr('value','');
        $('#nombre_bal2_cony2').attr('value','');
        $('#apellido_bal2_cony2').attr('value','');
        $('#actividad_com_cony2').attr('value','');
        $('#telefono_bal2_cony2').attr('value','');
        $('#profesion_cony2').attr('value','');
        $('#conyugal_insert').val('Agregar');
        $('#conyugal_insert').removeAttr('disabled');
        $('#nombre_bal2_cony2').removeAttr('disabled');
        $('#apellido_bal2_cony2').removeAttr('disabled');
        $('#telefono_bal2_cony2').removeAttr('disabled');
        $('#actividad_com_cony2').removeAttr('disabled');
        $('#profesion_cony2').removeAttr('disabled');
      }
    }
  });

  $('#nro_indent_bal3').blur(function()
  {
    $('#aceptar_user4').attr('style', 'display:none');
	$('#aceptar_user4').val("Realizar Cambios");
	$('#modificar_user4').removeAttr('style');
    if($(this).val().trim())
    {
      $(this).attr('disabled', 'disabled');
      $('#type_ci3').attr('disabled', 'disabled');
      $('#nombre_bal3').attr('value','Cargando...');
      $('#apellido_bal3').attr('value','Cargando...');
      $('#telefono_cert').attr('value','Cargando...');
      $('#actividad_com_bal3').attr('value','Cargando...');
      $('#certificado_insert').val('Cargando...');

      $('#nombre_bal3').attr('disabled', 'disabled');
      $('#apellido_bal3').attr('disabled', 'disabled');
      $('#profesion_bal3').attr('disabled', 'disabled');
      $('#telefono_cert').attr('disabled', 'disabled');
      $('#actividad_com_bal3').attr('disabled', 'disabled');
      $('#certificado_insert').attr('disabled', 'disabled');
      

      $.ajax({
        type: "POST",
        url:  "balance_action.php",
        data: "ci_rif_ret="+$('#type_ci3').val()+""+$('#nro_indent_bal3').val(),
        datatype: "html",
        async: true,
        statusCode: {
          404: function() {
            alert("page not found");
          }
        },
        success: function(data)
        {
          if(data)
          {
            data = data.split('@@');
            $('#nombre_bal3').attr('value',data[0]);
            $('#apellido_bal3').attr('value',data[1]);
            $('#profesion_bal3').val(data[2]).attr('selected',true);
            $('#actividad_com_bal3').attr('value',data[3]);
            $('#telefono_cert').attr('value',data[4]);
            if(data[5] != 'no_foto.jpg')
            {
                    $('#imgframe_bal3').attr("src", "balance-upload.php?per_imgci="+data[5]);
                    $('#per_imgci_bal4').attr("value", data[5]);
            }
            $('#nro_indent_bal3').valid();
            $('#apellido_bal3').valid();
            $('#nombre_bal3').valid();
            $('#profesion_bal3').valid();
            $('#actividad_com_bal3').valid()
            $('#telefono_cert').valid();
            $('#per_imgci_bal4').valid();
            //$('#certificado_insert').focus();

          }else{
			$('#modificar_user4').attr('style', 'display:none');
			$('#aceptar_user4').attr('style', 'display:none');
            $('#imgframe_bal3').attr("src", "balance-upload.php");
            $('#per_imgci_bal4').attr("value", '');
            $('#nombre_bal3').attr('value',"");
            $('#apellido_bal3').attr('value',"");
            $('#profesion_bal3').attr('value',"");
            $('#telefono_cert').attr('value',"");
            $('#actividad_com_bal3').attr('value',"");
            $('#nombre_bal3').removeAttr('disabled');
            $('#apellido_bal3').removeAttr('disabled');
            $('#profesion_bal3').removeAttr('disabled');
            $('#actividad_com_bal3').removeAttr('disabled');
            $('#telefono_cert').removeAttr('disabled');
            $('#nombre_bal3').focus();
          }
          $('#certificado_insert').removeAttr('disabled');
          $('#certificado_insert').val('Agregar');
          $('#type_ci3').removeAttr('disabled', 'disabled');
          $('#nro_indent_bal3').removeAttr('disabled', 'disabled');       
        }
      });
    }else{
		$('#modificar_user4').attr('style', 'display:none');
		$('#aceptar_user4').attr('style', 'display:none');
      if($('#nombre_bal3').attr('disabled') == 'disabled')
      {
        $('#imgframe_bal3').attr("src", "balance-upload.php");
        $('#per_imgci_bal4').attr("value", '');
        $('#certificado_insert').val('Agregar');
        $('#nombre_bal3').attr('value',"");
        $('#apellido_bal3').attr('value',"");
        $('#profesion_bal3').attr('value',"");
        $('#telefono_cert').attr('value',"");
        $('#actividad_com_bal3').attr('value',"");
        $('#nombre_bal3').removeAttr('disabled');
        $('#apellido_bal3').removeAttr('disabled');
        $('#profesion_bal3').removeAttr('disabled');
        $('#actividad_com_bal3').removeAttr('disabled');
        $('#telefono_cert').removeAttr('disabled');
        $('#certificado_insert').removeAttr('disabled');
        $('#nro_indent_bal3').valid();
      }
    }
  });

  $('#nro_ident_reporta').blur(function()
  {
    $('#aceptar_user5').attr('style', 'display:none');
	$('#aceptar_user5').val("Realizar Cambios");
	$('#modificar_user5').removeAttr('style');
    if($(this).val().trim())
    {
      $(this).attr('disabled', 'disabled');
      $('#nombre_reporta').attr('value','Cargando...');
      $('#apellido_reporta').attr('value','Cargando...');
      $('#telef_reporta').attr('value','Cargando...');
	  $('#actividad_com_reporta').attr('value','Cargando...');
      $('#nombre_reporta').attr('disabled', 'disabled');
      $('#apellido_reporta').attr('disabled', 'disabled');
      $('#telef_reporta').attr('disabled', 'disabled');
	  $('#profesion_reporta').attr('disabled', 'disabled');
	  $('#actividad_com_reporta').attr('disabled', 'disabled');
      $('#reporta_insert').attr('disabled', 'disabled');
      $('#reporta_insert').val('Cargando...');

      $.ajax({
        type: "POST",
        url:  "balance_action.php",
        data: "ci_rif_ret="+$('#type_ci_reporta').val()+""+$('#nro_ident_reporta').val(),
        datatype: "html",
        async: true,
        statusCode: {
          404: function() {
            alert("page not found");
          }
        },
        success: function(data)
        {
          if(data)
          {
            data = data.split('@@');
            $('#nombre_reporta').attr('value',data[0]);
            $('#apellido_reporta').attr('value',data[1]);
			$('#profesion_reporta').val(data[2]).attr('selected',true);
            $('#actividad_com_reporta').attr('value',data[3]);
            $('#telef_reporta').attr('value',data[4]);
            $('#reporta_insert').val('Agregar');
            $('#reporta_insert').removeAttr('disabled');
            $('#nro_ident_reporta').removeAttr('disabled');
            $('#reporta_insert').focus();
          }else{
		    $('#modificar_user5').attr('style', 'display:none');
		    $('#aceptar_user5').attr('style', 'display:none');
            $('#nombre_reporta').attr('value',"");
            $('#apellido_reporta').attr('value',"");
            $('#telef_reporta').attr('value',"");
			$('#actividad_com_reporta').attr('value',"");
            $('#reporta_insert').val('Agregar');
            $('#nombre_reporta').removeAttr('disabled');
            $('#apellido_reporta').removeAttr('disabled');
            $('#telef_reporta').removeAttr('disabled');
            $('#reporta_insert').removeAttr('disabled');
            $('#nro_ident_reporta').removeAttr('disabled');
			$('#profesion_reporta').removeAttr('disabled');
			$('#actividad_com_reporta').removeAttr('disabled');
            $('#nombre_reporta').focus();
          }    
        }
      });
    }else{
	  $('#modificar_user5').attr('style', 'display:none');
	  $('#aceptar_user5').attr('style', 'display:none');
      if($('#nombre_reporta').attr('disabled') == 'disabled')
      {
        $('#reporta_insert').val('Agregar');
        $('#nombre_reporta').attr('value',"");
        $('#apellido_reporta').attr('value',"");
		$('#actividad_com_reporta').attr('value',"");
		$('#profesion_reporta').val("").attr('selected',true);
        $('#telef_reporta').attr('value',"");
        $('#nombre_reporta').removeAttr('disabled');
        $('#apellido_reporta').removeAttr('disabled');
        $('#telef_reporta').removeAttr('disabled');
        $('#reporta_insert').removeAttr('disabled');
		$('#profesion_reporta').removeAttr('disabled');
		$('#actividad_com_reporta').removeAttr('disabled');
        $('#nro_ident_reporta').valid();
      }
    }
  });
  
  /// EVENTOS NUEVOS USER MODIFY
  
  $('#modificar_user1').click(function()
  {
	$(this).attr('style', 'display:none');
	$('#aceptar_user1').removeAttr('style');
	$('#telef_bal1').removeAttr('disabled');
	$('#profesion_bal1').removeAttr('disabled');
	$('#actividad_com_bal1').removeAttr('disabled');
	$('#imgframe_bal1').attr("src", "balance-upload.php");
    $('#per_imgci_bal1').attr("value", "");
  });
  
  $('#aceptar_user1').click(function()
  {
	if(  $('#telef_bal1').valid()         &&
		 $('#profesion_bal1').valid()     &&
		 $('#actividad_com_bal1').valid() &&
		 $('#per_imgci_bal1').valid())
		 
	{
		$(this).attr('disabled', 'disabled');
		$(this).val('Cargando...');
		
		$.ajax({
			type: "POST",
			url:  "update_user.php",
			data: "ci_rif_ret="+$('#type_ci').val()+""+$('#nro_indent_bal1').val()+
				  "&telef_bal="+$('#telef_bal1').val()+
				  "&profesion_bal="+$('#profesion_bal1').val()+
				  "&actividad_com_bal="+$('#actividad_com_bal1').val()+
				  "&per_imgci_bal="+ $('#per_imgci_bal1').val(),
			datatype: "html",
			async: true,
			statusCode: {
			  404: function() {
				alert("page not found");
			  }
			},
			success: function(data)
			{
				if(data == "success")
				{
					$('#telef_bal1').attr('disabled', 'disabled');
					$('#profesion_bal1').attr('disabled', 'disabled');
					$('#actividad_com_bal1').attr('disabled', 'disabled');
					$('#imgframe_bal1').attr("src", "balance-upload.php?per_imgci="+$('#per_imgci_bal1').val());
				}
				$('#aceptar_user1').attr('style', 'display:none');
				$('#aceptar_user1').removeAttr('disabled');
				$('#aceptar_user1').val("Realizar Cambios");
				$('#modificar_user1').removeAttr('style');
			}
		});
	}
	  
	$('#telef_bal1').valid();
	$('#profesion_bal1').valid();
	$('#actividad_com_bal1').valid();
	 $('#per_imgci_bal1').valid();
  });
  
  
  
  
  
  
  
  
  $('#modificar_user4').click(function()
  {
	$(this).attr('style', 'display:none');
	$('#aceptar_user4').removeAttr('style');
	$('#telefono_cert').removeAttr('disabled');
	$('#profesion_bal3').removeAttr('disabled');
	$('#actividad_com_bal3').removeAttr('disabled');
	$('#imgframe_bal3').attr("src", "balance-upload.php");
    $('#per_imgci_bal4').attr("value", "");
  });
  
  $('#aceptar_user4').click(function()
  {
	if(  $('#telefono_cert').valid()         &&
		 $('#profesion_bal3').valid()     &&
		 $('#actividad_com_bal3').valid() &&
		 $('#per_imgci_bal4').valid())
		 
	{
		$(this).attr('disabled', 'disabled');
		$(this).val('Cargando...');
		
		$.ajax({
			type: "POST",
			url:  "update_user.php",
			data: "ci_rif_ret="+$('#type_ci3').val()+""+$('#nro_indent_bal3').val()+
				  "&telef_bal="+$('#telefono_cert').val()+
				  "&profesion_bal="+$('#profesion_bal3').val()+
				  "&actividad_com_bal="+$('#actividad_com_bal3').val()+
				  "&per_imgci_bal="+ $('#per_imgci_bal4').val(),
			datatype: "html",
			async: true,
			statusCode: {
			  404: function() {
				alert("page not found");
			  }
			},
			success: function(data)
			{
				if(data == "success")
				{
					$('#telefono_cert').attr('disabled', 'disabled');
					$('#profesion_bal3').attr('disabled', 'disabled');
					$('#actividad_com_bal3').attr('disabled', 'disabled');
					$('#imgframe_bal3').attr("src", "balance-upload.php?per_imgci="+$('#per_imgci_bal4').val());
				}
				$('#aceptar_user4').attr('style', 'display:none');
				$('#aceptar_user4').removeAttr('disabled');
				$('#aceptar_user4').val("Realizar Cambios");
				$('#modificar_user4').removeAttr('style');
			}
		});
	}
	  
	$('#telefono_cert').valid();
	$('#profesion_bal3').valid();
	$('#actividad_com_bal3').valid();
	$('#per_imgci_bal4').valid();
  });
  
  
  
  
  
  
  
  
  
  
  $('#modificar_user_cony1').click(function()
  {
	$(this).attr('style', 'display:none');
	$('#aceptar_user_cony1').removeAttr('style');
	$('#telefono_bal2_cony1').removeAttr('disabled');
	$('#profesion_cony1').removeAttr('disabled');
	$('#actividad_com_cony1').removeAttr('disabled');
	$('#imgframe').attr("src", "balance-upload.php");
    $('#per_imgci_bal2').attr("value", "");
  });
  
  $('#aceptar_user_cony1').click(function()
  {
	if(  $('#telefono_bal2_cony1').valid()      &&
		 $('#profesion_cony1').valid()     &&
		 $('#actividad_com_cony1').valid() &&
		 $('#per_imgci_bal2').valid())
		 
	{
		$(this).attr('disabled', 'disabled');
		$(this).val('Cargando...');
		
		$.ajax({
			type: "POST",
			url:  "update_user.php",
			data: "ci_rif_ret="+$('#type_ci2_cony1').val()+""+$('#nro_indent_bal2_cony1').val()+
				  "&telef_bal="+$('#telefono_bal2_cony1').val()+
				  "&profesion_bal="+$('#profesion_cony1').val()+
				  "&actividad_com_bal="+$('#actividad_com_cony1').val()+
				  "&per_imgci_bal="+ $('#per_imgci_bal2').val(),
			datatype: "html",
			async: true,
			statusCode: {
			  404: function() {
				alert("page not found");
			  }
			},
			success: function(data)
			{
				if(data == "success")
				{
					$('#telefono_bal2_cony1').attr('disabled', 'disabled');
					$('#profesion_cony1').attr('disabled', 'disabled');
					$('#actividad_com_cony1').attr('disabled', 'disabled');
					$('#imgframe').attr("src", "balance-upload.php?per_imgci="+$('#per_imgci_bal2').val());
				}
				$('#aceptar_user_cony1').attr('style', 'display:none');
				$('#aceptar_user_cony1').removeAttr('disabled');
				$('#aceptar_user_cony1').val("Realizar Cambios");
				$('#modificar_user_cony1').removeAttr('style');
			}
		});
	}
	  
	$('#telefono_bal2_cony1').valid();
	$('#profesion_cony1').valid();
	$('#actividad_com_cony1').valid();
	$('#per_imgci_bal2').valid();
  });
  
  
  
  
  
  
  
  
  $('#modificar_user_cony2').click(function()
  {
	$(this).attr('style', 'display:none');
	$('#aceptar_user_cony2').removeAttr('style');
	$('#telefono_bal2_cony2').removeAttr('disabled');
	$('#profesion_cony2').removeAttr('disabled');
	$('#actividad_com_cony2').removeAttr('disabled');
	$('#imgframe2').attr("src", "balance-upload.php");
    $('#per_imgci_bal3').attr("value", "");
  });
  
  $('#aceptar_user_cony2').click(function()
  {
	if(  $('#telefono_bal2_cony2').valid()      &&
		 $('#profesion_cony2').valid()     &&
		 $('#actividad_com_cony2').valid() &&
		 $('#per_imgci_bal3').valid())
		 
	{
		$(this).attr('disabled', 'disabled');
		$(this).val('Cargando...');
		
		$.ajax({
			type: "POST",
			url:  "update_user.php",
			data: "ci_rif_ret="+$('#type_ci2_cony2').val()+""+$('#nro_indent_bal2_cony2').val()+
				  "&telef_bal="+$('#telefono_bal2_cony2').val()+
				  "&profesion_bal="+$('#profesion_cony2').val()+
				  "&actividad_com_bal="+$('#actividad_com_cony2').val()+
				  "&per_imgci_bal="+ $('#per_imgci_bal3').val(),
			datatype: "html",
			async: true,
			statusCode: {
			  404: function() {
				alert("page not found");
			  }
			},
			success: function(data)
			{
				if(data == "success")
				{
					$('#telefono_bal2_cony2').attr('disabled', 'disabled');
					$('#profesion_cony2').attr('disabled', 'disabled');
					$('#actividad_com_cony2').attr('disabled', 'disabled');
					$('#imgframe2').attr("src", "balance-upload.php?per_imgci="+$('#per_imgci_bal3').val());
				}
				$('#aceptar_user_cony2').attr('style', 'display:none');
				$('#aceptar_user_cony2').removeAttr('disabled');
				$('#aceptar_user_cony2').val("Realizar Cambios");
				$('#modificar_user_cony2').removeAttr('style');
			}
		});
	}
	  
	$('#telefono_bal2_cony2').valid();
	$('#profesion_cony2').valid();
	$('#actividad_com_cony2').valid();
	$('#per_imgci_bal3').valid();
  });
  
  
  
  
  
  
  
  
  
  
  $('#modificar_user5').click(function()
  {
	$(this).attr('style', 'display:none');
	$('#aceptar_user5').removeAttr('style');
	$('#telef_reporta').removeAttr('disabled');
	$('#profesion_reporta').removeAttr('disabled');
	$('#actividad_com_reporta').removeAttr('disabled');
  });
  
  $('#aceptar_user5').click(function()
  {
	if(  $('#telef_reporta').valid()         &&
		 $('#profesion_reporta').valid()     &&
		 $('#actividad_com_reporta').valid())
		 
	{
		$(this).attr('disabled', 'disabled');
		$(this).val('Cargando...');
		
		$.ajax({
			type: "POST",
			url:  "update_user.php",
			data: "ci_rif_ret="+$('#type_ci_reporta').val()+""+$('#nro_ident_reporta').val()+
				  "&telef_bal="+$('#telef_reporta').val()+
				  "&profesion_bal="+$('#profesion_reporta').val()+
				  "&actividad_com_bal="+$('#actividad_com_reporta').val()+
				  "&per_imgci_bal=nofoto.jpg",
			datatype: "html",
			async: true,
			statusCode: {
			  404: function() {
				alert("page not found");
			  }
			},
			success: function(data)
			{
				if(data == "success")
				{
					$('#telef_reporta').attr('disabled', 'disabled');
					$('#profesion_reporta').attr('disabled', 'disabled');
					$('#actividad_com_reporta').attr('disabled', 'disabled');
				}
				$('#aceptar_user5').attr('style', 'display:none');
				$('#aceptar_user5').removeAttr('disabled');
				$('#aceptar_user5').val("Realizar Cambios");
				$('#modificar_user5').removeAttr('style');
			}
		});
	}
	  
	$('#telef_reporta').valid();
	$('#profesion_reporta').valid();
	$('#actividad_com_reporta').valid();
  });
  
  
  
  
  
  
  
  
  

});