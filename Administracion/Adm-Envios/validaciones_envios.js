$("#u_envio").validate({ //VALIDACIONES DEL FORMULARIO DE ENVIOS

  rules:{ //REGLAS DE VALIDACION PARA CADA INPUT
    descripcion:{
      minlength: 5,
      required: true
    }
  },

  messages:{  //MENSAJES DE VALIDACION CONFORME A CADA VALIDACION ECHA
    descripcion:{
      required: "Porfavor Ingrese una Descripción.",
      minlength: "La Descripción debe tener al menos 5 Caracteres."
    }
  },

  submitHandler:function(form){
    var codigo = $("#codigo-factura").text();

    $.ajax({
      data : {
        'codigo' : codigo,
        'estatus' : $("#estatus").val(),
        'descripcion' : $("#descripcion").val(),
        'modificar' : ""
      },
      url: 'proceso_envios.php',
      type: 'post',
      success:function(censo){
        console.log(censo);
        switch (censo) {
          case "1":
            swal({
              title: 'Cambio de Estatus Exitoso',
              text: 'Se ha cambiado el Estatus del Pedido.',
              icon: 'success',
              closeOnClickOutside: false,
              button: 'Aceptar',
            });
            $(".swal-button--confirm").addClass('bg-success');
            $(".swal-button--confirm").addClass('m-auto');
            $(".swal-text").addClass('text-center');

            //EDITAR LOS DATOS EN LA TABLA DE ENVIOS CORRESPONDIENTE
            if ($("#estatus").val()!="Entregado") {
                $("#estado"+codigo).fadeOut('500', function() {
                    var texto =  $("#estatus").val();
                    $(this).text(texto);
                });
                $("#estado"+codigo).fadeIn(500);

                $("#movimiento"+codigo).fadeOut('500', function() {
                    var texto =  $("#descripcion").val();
                    $(this).text(texto);
                });
                $("#movimiento"+codigo).fadeIn(500);
            }
            else{
                //BORRO LA FILA YA QUE ESTA EN ENTREGADO
                $("#row"+codigo).hide(1000);
            }
            break;
        }
      }
    });
  },

  errorPlacement:function(error,element){ //Para reposicionar los elementos de error que son level
    error.insertAfter(element);
  }

});