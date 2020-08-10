$("#update").validate({ //VALIDACIONES DEL FORMULARIO DE ACTUALIZAR PRODUCTO

  rules:{ //REGLAS DE VALIDACION PARA CADA INPUT
    a_nombre:{
      minlength: 3,
      required: true
    },
    a_precio:{
      number:true,
      required: true,
      min: 0
    }
  },

  messages:{  //MENSAJES DE VALIDACION CONFORME A CADA VALIDACION ECHA
    a_nombre:{
      required: "Porfavor Ingrese un Nombre de Producto...",
      minlength: "El Nombre debe tener al menos 3 Caracteres."
    },
    a_precio:{
      number:"Solo puede poseer digitos...",
      required: "Porfavor Ingrese un Precio al Producto...",
      min: "El Precio no puede tener un valor menor a 0.00"
    }
  },

  submitHandler:function(form){
    var formData = new FormData(document.getElementById("update"));
    var files = $('#a_imagen')[0].files[0];
        formData.append('file',files);
    $("#fail-imagen").fadeOut(500);
    $("#eliminar-imagen").fadeOut(500);
    $.ajax({
      data: formData,
      url: 'actualizacion_pro.php',
      type: 'POST',
      contentType: false,
      processData: false,
      success:function(censo){
        console.log(censo);
        switch (censo) {
          case "4":
            swal({
              title: 'Error de Actualizacion',
              text: 'Solo se permiten subir imagenes al servidor.',
              icon: 'error',
              closeOnClickOutside: false,
              button: 'Aceptar',
            });
            $(".swal-button--confirm").addClass('bg-success');
            $(".swal-button--confirm").addClass('m-auto');
            break;

          case "3":
            swal({
              title: 'Error de Actualizacion',
              text: 'La imagen es muy grande para el servidor',
              icon: 'error',
              closeOnClickOutside: false,
              button: 'Aceptar',
            });
            $(".swal-button--confirm").addClass('bg-success');
            $(".swal-button--confirm").addClass('m-auto');
            break;

          case "2":
            swal({
              title: 'Error de Actualizacion',
              text: 'Se ha encontrado una imagen con el mismo nombre en el servidor.',
              icon: 'error',
              closeOnClickOutside: false,
              button: 'Aceptar',
            });
            $(".swal-button--confirm").addClass('bg-success');
            $(".swal-button--confirm").addClass('m-auto');
            break;

          case "1":
            swal({
              title: 'Actualizacion Exitosa',
              text: 'Se ha actualizado el producto correctamente.',
              icon: 'success',
              closeOnClickOutside: false,
              button: 'Aceptar',
            });
            $(".swal-button--confirm").addClass('bg-success');
            $(".swal-button--confirm").addClass('m-auto');

            //ACOMODADO DE LA INFORMACION DE LA TABLA SOBRE EL PRODUCTO ACTUALIZADO
            var id = $("#cod_actualizar").val();
            var nombre = $("#a_n").val();
            var categoria = $("#a_cat").val();
            var precio = $("#a_p").val();
            $(".n_p"+id).text(nombre) //nombre del producto
            $(".c_p"+id).text(categoria) //categoria del producto
            $(".p_p"+id).text(precio) //precio del producto
            break;
        }
      }
    });
  },

  errorPlacement:function(error,element){ //Para reposicionar los elementos de error que son level
    error.insertAfter(element);
  }

});