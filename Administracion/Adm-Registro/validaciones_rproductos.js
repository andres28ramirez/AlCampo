//VALIDACIONES DEL FORMULARIO DE INSERTAR PRODUCTO
  $("#insert").validate({ 

    rules:{ 
      nom:{
        minlength: 3,
        required: true 
      },
      pre:{
        number:true,
        required: true,
        min: 0
      }
    },

    messages:{ 
      nom:{
        required: "Porfavor Ingrese un Nombre de Producto...",
        minlength: "El Nombre debe tener al menos 3 Caracteres."
      },
      pre:{
        number:"Solo puede poseer digitos...",
        required: "Porfavor Ingrese un Precio al Producto...",
        min: "El Precio no puede tener un valor menor a 0.00"
      }
    },

    submitHandler:function(form){
      var formData = new FormData(document.getElementById("insert"));
      var files = $('#archivo')[0].files[0];
          formData.append('file',files);
      $.ajax({
        data: formData,
        url: 'proceso_registro.php',
        type: 'POST',
        contentType: false,
        processData: false,
        success:function(censo){
          console.log(censo);
          switch (censo) {
            case "4":
              swal({
                title: 'Error de Inserción de Imagen!.',
                text: 'El formato de Archivo no es el Correcto.',
                icon: 'error',
                closeOnClickOutside: false,
                button: 'Aceptar',
              });
              $(".swal-button--confirm").addClass('bg-success');
              $(".swal-button--confirm").addClass('m-auto');
              break;

            case "3":
              swal({
                title: 'Error de Inserción de Imagen!.',
                text: 'La imagen es muy grande para la base de datos',
                icon: 'error',
                closeOnClickOutside: false,
                button: 'Aceptar',
              });
              $(".swal-button--confirm").addClass('bg-success');
              $(".swal-button--confirm").addClass('m-auto');
              break;

            case "2":
              swal({
                title: 'Error de Inserción de Imagen!.',
                text: 'Ya existe un archivo con el mismo nombre de imagen.',
                icon: 'error',
                closeOnClickOutside: false,
                button: 'Aceptar',
              });
              $(".swal-button--confirm").addClass('bg-success');
              $(".swal-button--confirm").addClass('m-auto');
              break;

            case "1":
              swal({
                title: 'Registro Exitoso!',
                text: 'El artículo se ha aregado correctamente a la Base de Datos.',
                icon: 'success',
                closeOnClickOutside: false,
                button: 'Aceptar',
              });
              $(".swal-button--confirm").addClass('bg-success');
              $(".swal-button--confirm").addClass('m-auto');
              break;
          }
        }
      });
    },

    errorPlacement:function(error,element){ //Para reposicionar los elementos de error que son level
      error.insertAfter(element);
    }

  });