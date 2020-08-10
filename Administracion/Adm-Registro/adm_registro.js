$("#irp").addClass('active');
$(".irp").removeClass('icono_color');
$(".irp").addClass('text-white');

$("#eliminar-imagen").removeClass('d-none');
$("#eliminar-imagen").hide();

//ACOMODAR LOS DATOS DENTRO DEL PREVIEW DEL PRODUCTO
    //AJUSTE DE NOMBRE
    $("#nom").keyup(function(event) {
        $("#p_nombre").text($(this).val());
    });

    //AJUSTE DE TEXTO
    $("#pre").keyup(function(event) {
        $("#p_precio").text($(this).val());
    });

    //EVENTO QUE AJUSTA LA IMAGEN DEL PREVIEW
    $("#archivo").change(function(event) {
        var texto = $(this).val();
        var texto = texto.replace(/.*[\/\\]/, '');
        var TmpPath = URL.createObjectURL(event.target.files[0]);
        
        $("#t_archivo").fadeOut('500', function() {
            //AJUSTO EL NOMBRE DEL ARCHIVO
            $("#t_archivo").text("Archivo: "+texto); 
        });
        $("#t_archivo").fadeIn(500);

        $('#p_imagen').fadeOut('500', function() {
            //CAMBIO LA IMAGEN EN EL PREVIEW
            $('#p_imagen').attr('src', TmpPath);
        });
        $('#p_imagen').fadeIn(500);
        
        $("#eliminar-imagen").fadeIn(1000);
    });

    //EVENTO AL DECIDIR ELIMINAR LA IMAGEN DEL PREVIEW
    $("#eliminar-imagen").click(function(event) {
        $("#eliminar-imagen").fadeOut(500);
        $("#archivo").val('');

        $("#t_archivo").fadeOut('500', function() {
            //ACOMODO EL TEXTO DEL LABEL A UN MENSAJE NUEVO
            $("#t_archivo").text("Seleccione un Archivo."); 
        });
        $("#t_archivo").fadeIn(500);

        $('#p_imagen').fadeOut('500', function() {
            //CAMBIO A LA IMAGEN PREDETERMINADA DEL PREVIEW
            $('#p_imagen').attr('src', "/AlCampo/Imagenes/cargar.png");
        });
        $('#p_imagen').fadeIn(500);
    });
//FIN ACOMODAR LOS DATOS DENTRO DLE PREVIEW DEL PRODUCTO


    