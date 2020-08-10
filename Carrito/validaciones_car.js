// VALIDACION DEL FORMULARIO //
    $("#register").validate({ //VALIDACIONES DEL FORMULARIO SI TODO SE CUMPLE SE LANZARIA EL EVENTO SUBMIT

      rules:{ //REGLAS DE VALIDACION PARA CADA INPUT
        tipo_pago:{
          required:true
        },
        tarjeta:{
          number:true,
          required:true,
          minlength: 10,
          maxlength: 16
        },
        tipo_tarjeta:{
          required:true
        },
        retiro:{
          required:true
        },
        comentarios:{
          required:true,
          minlength:30
        },
        banco:{
          required:true
        },
        referencia:{
          digits:true,
          required:true
        },
        fecha:{
          required:true
        }
      },

      messages:{  //MENSAJES DE VALIDACION CONFORME A CADA VALIDACION ECHA
        tipo_pago:{
          required:"Ingresa la forma de cancelar los productos.",
        },
        tarjeta:{
          number:"Eg: 0000 0000 0000 0000 / Escribirlo todo pegado.",
          required:"Ingrese un número de tarjeta.",
          minlength:"El número de la tarjeta debe ser mayor a 10 dígitos.",
          maxlength:"El número no debe exceder de 12 dígitos."
        },
        tipo_tarjeta:{
          required:"Seleccione una opción."
        },
        retiro:{
          required:"Seleccione una opción de retiro."
        },
        comentarios:{
          required:"Porfavor Ingrese una dirección de envio.",
          minlength:"La dirección debe contener al menos 30 caracteres."
        },
        banco:{
          required:"Ingrese el Banco emisor."
        },
        referencia:{
          required:"Ingrese la Referencía de la Transferencia.",
          digits:"La Referencía solo puede poseer dígitos."
        },
        fecha:{
          required:"Ingrese la Fecha en que se realizo el Pago."
        }
      },

      submitHandler:function(form){
        var id = $("#id-usuario").val();
        if(id==0){
            //EL USUARIO NO LOGGUEADO OBLIGARLO A LOGGUEAR Y GRABAR EL CARRITO COMPLETO
            swal({
                  title: 'Debes Iniciar Sesión',
                  text: 'Porfavor precione el boton "Aceptar" para redireccionarte al login',
                  icon: 'warning',
                  closeOnClickOutside: false,
                  button: "Aceptar",
                });
            $(".swal-button--confirm").addClass('bg-danger');
            $(".swal-text").addClass('text-center');
            $(".swal-button--confirm").attr('onclick', 'redireccion()');
        }
        else{
            //USUARIO YA LOGGUEADO PUEDE PAGAR TRANQUILAMENTE EL CARRITO
            $.ajax({
              data:{
                'solicitud': "pagar-carrito",
                'id': id,
                'tipo_pago': $("#tipo_pago").val(),
                'retiro': $("#retiro").val(),
                'comprar': $("#comprar").val()
              },
              url: 'procesos_car.php',
              type: 'post',
              success:function(censo){
                console.log(censo);
                switch (censo) {
                  case "1":
                    location.href = "../Compras/compras.php?mensaje=";
                    break;

                  case "2":
                    swal({
                          title: 'Ha ocurrido un error al pagar!',
                          text: 'Porfavor intente el proceso de pago de nuevo',
                          icon: 'error',
                          closeOnClickOutside: false,
                          button: "Aceptar",
                        });
                    $(".swal-button--confirm").addClass('bg-success');
                    $(".swal-button--confirm").addClass('m-auto');
                    break;
                }
              }
            });
        }
      },

      errorPlacement:function(error,element){ //Para reposicionar los elementos de error que son level
        
        if(element.is(":radio")){
          error.appendTo(element.parent());
        }
        else
          error.insertAfter(element);
      }

    });
//FIN DE VALIDACION DE FORMULARIO //

//VALIDACION DE LA HABILITACION DE ZONAS DEL FORMULARIO//
    $("#direction").hide(); //OCULTO EL TEXTAREA DE ARRANQUE
    $("#credito").hide();
    $("#transferencia").hide();

    $("#retiro").change(function(event) { //SECCION PARA VALIDAR LA MUESTRA DEL TEXTAREA
      if($(this).val()=="Delivery"){
        $("#direction").slideDown(500);          
      }  
      else{
        $("#direction").slideUp(1000);
      }
    });

    $("#tipo_pago").change(function(event) {
      if($(this).val()=="Crédito"){
        $("#transferencia").slideUp(1000);
        $("#credito").slideDown(500);
      }
      else if($(this).val()=="Transferencia"){
        $("#credito").slideUp(1000);
        $("#transferencia").slideDown(500);
      }
      else{
        $("#transferencia").slideUp(1000);
        $("#credito").slideUp(1000);          
      }
    });
//FIN VALIDACION DE LA HABILITACION DE ZONAS DEL FORMULARIO//