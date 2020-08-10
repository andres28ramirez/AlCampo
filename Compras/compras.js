$(".swal-button--confirm").addClass('bg-success');

//ACOMODAR LA OPCION DE COMPRAS EN LA BARRA LATERAL
    $("#iu").addClass('active');
    $(".iu").removeClass('icono_color');
    $(".iu").addClass('text-white');

$(".c_factura").click(function(event) {
    var factura=$(this).attr("id");
    open("factura.php?factura="+factura+"","Factura de la compra","height=100%","width=100%");
});

$(".estado").click(function(event) {
    var ancho = screen.width;
    ancho/=3.5;
    var fac = $(this).attr("id");
    open("tracker.php?factura="+fac+"","Estado de Envio.","height=350,width=500,left="+ancho+",top=200");
    return false;
});

$("#monto2").hide();

$("#forma").change(function(event) {
    $("#filtrar").removeAttr('disabled');
    $("#errorm").text('');
    $("label.error").text('');

    if($(this).val()=="0"){
        $("#monto1").attr('disabled', 'true');
        $("#monto1").val("");
        $("#monto2").attr('disabled', 'true');
    }
    else{
        $("#monto1").removeAttr('disabled');
        $("#monto2").removeAttr('disabled');
    }

    if($(this).val()=="entre"){
        $("#monto1").val("");
        $("#monto2").removeAttr('disabled');
        $("#monto2").slideDown(500);
        $("#monto1").attr('placeholder', 'Monto Menor');          
    }  
    else{
        $("#monto2").attr('disabled', 'true');
        $("#monto2").slideUp(250);
        $("#monto2").val("");
        $("#monto1").attr('placeholder', 'Monto');
    }
});  

//VALIDAR QUE MONTO 2 NO SEA MENOR QUE MONTO 1
$(".mont").change(function(event) {
    var num1 = $("#monto1").val();
    num1 = num1.replace(".",""); num1 = num1.replace(",","."); num1 = parseFloat(num1);
    var num2 = $("#monto2").val();
    num2 = num2.replace(".",""); num2 = num2.replace(",","."); num2 = parseFloat(num2);
    if(num1>num2){
      $("#errorm").text('Ingrese un Monto Mayor que sea superior que el Monto Menor');
      $("#monto2").addClass('error');
      $("#filtrar").attr('disabled', 'true');
    }
    else{
      $("#monto2").removeClass('error');
      $("#filtrar").removeAttr('disabled');
      $("#errorm").text(''); 
    }
});

//ELIMINAR FACTURA
	var total = $("#cantidad-texto").text();
$(".eliminar").click(function(event){
    swal({
      title: "Eliminar Registro de Compra",
      text: "¿Esta seguro de eliminar el registro seleccionado?",
      icon: "warning",
      buttons: ["Cancelar","Aceptar"],
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
		$.ajax({
			data:{
				'solicitud': "eliminado",
				'codigo': $(this).attr("id")
			},
			url: 'proceso_compras.php',
			type: 'post',
			success:function(censo){
				console.log(censo);
				switch (censo) {
					case "1":
			        	swal({
				          title: 'Registro de compra Eliminado Correctamente!',
				          icon: 'success',
				          closeOnClickOutside: false,
				          button: 'Aceptar',
				        });
						$(".swal-button--confirm").addClass('bg-success');
						$(".swal-button--confirm").addClass('m-auto');
						$(".swal-title").addClass('font-weight-normal');
						break;
				}
			}
		});

        var id = $(this).attr('id');
        total--;
        $("#cantidad-texto").text(total);
        $("#row"+id).hide(500);
        if (total==0) {
            $("#tabla-compras").hide(500);
            $(".tabla-info").hide(500);
            $("#compras-vacias").append('<div class="row justify-content-center mt-4 mb-4 py-5"><div class="col-12"><p class="display-6 text-dark my-4"><span class="display-5 text-primary">REGISTRO DE COMPRAS VACIO,</span><br>No se encuentran compras realizadas o almacenadas.</p><h5 class="text-muted">¡Sigue Disfrutando de DiGuti Market Store, ir al <a href="/AlCampo">inicio</a>!</h5></div></div>');

        }
        else if (total==1){
            $("#tabla-compras").animate(
                {
                    margin: 20, 
                }, 1000);
        }
      }
    });
});