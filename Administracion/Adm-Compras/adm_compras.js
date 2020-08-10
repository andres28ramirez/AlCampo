//EVENTO DE BUSCADOR POR PAGO
  $("#busqueda_pago").change(function(event){
    $("busqueda_retiro").val("");
    $("busqueda_codigo").val("");

    $.ajax({
        url: 'paginacion.php',
        type: 'get',
        data: {
            'ajax': '',
            'pago': '',
            'busqueda': $(this).val()
        },
    })
    .done(function(busqueda) {
        var grupos=JSON.parse(busqueda);

        //acomodo el numero de registros
        $("#n-registros").fadeOut('500', function() {
            $("#n-registros").text(grupos[grupos.length-4]);
        });
        $("#n-registros").fadeIn(500);

        //acomoda la paginacion dependiendo de la busqueda
        $("#num-paginacion").hide('500', function() {
            $(this).empty();

            //BOTON DE ANTERIOR
            if (grupos[grupos.length-2]==1) {
                $(this).append('<li class="page-item disabled"><a class="page-link text-dark" style="opacity: 0.6" href="#" tabindex="-1">Anterior</a></li>');
            }else{
                var pagina_a = grupos[grupos.length-2]-1;
                $(this).append('<li class="page-item"><a class="page-link text-dark" href="?pagina='+pagina_a+'&pago=&busqueda='+grupos[grupos.length-3]+'" tabindex="-1">Anterior</a></li>');
            }

            //NUMEROS DE LA PAGINACION
            for (var i = 0; i<grupos[grupos.length-1]; i++) {
                if (i+1==grupos[grupos.length-2]) {
                    $(this).append('<li class="page-item"><a class="page-link text-dark font-weight-bold" href="?pagina='+(i+1)+'&pago=&busqueda='+grupos[grupos.length-3]+'">'+(i+1)+'</a></li>');
                }else{
                    $(this).append('<li class="page-item"><a class="page-link text-dark" href="?pagina='+(i+1)+'&pago=&busqueda='+grupos[grupos.length-3]+'">'+(i+1)+'</a></li>');
                }
            }

            //BOTON DE SIGUIENTE
            if (grupos[grupos.length-2]==grupos[grupos.length-1]) {
                $(this).append('<li class="page-item disabled"><a class="page-link text-dark" style="opacity: 0.6" href="#">Siguiente</a></li>');
            }else{
                var pagina_s = grupos[grupos.length-2]+1;
                $(this).append('<li class="page-item"><a class="page-link text-dark" href="?pagina='+pagina_s+'&pago=&busqueda='+grupos[grupos.length-3]+'">Siguiente</a></li>');
            }
        });
        $("#num-paginacion").show(500);

        //agrega los valores en la tabla
        $("#tbody").hide('500', function() {
            $(this).empty();
            for (var i = 0; i<grupos.length-4; i++) {
                $(this).append('<tr id="row'+grupos[i]["C_Factura"]+'"><th scope="row"><button onclick="eliminar('+grupos[i]["C_Factura"]+','+grupos[i]["ver"]+')" type="button" class="eliminar" aria-label="Close"><span aria-hidden="true">&times;</span></button></th><td><span class="text-primary c_factura" onclick="mostrar('+grupos[i]["C_Factura"]+')" data-toggle="modal" data-target="#modaldr">'+grupos[i]["C_Factura"]+'</span></td><td>'+grupos[i]["Fecha"]+'</td><td>'+grupos[i]["Cancelacion"]+'</td><td>'+grupos[i]["Modalidad"]+'</td><td style="color: red"><strong>'+grupos[i]["Monto"]+'<font size="3"> Bs</font></strong></td></tr>');
            }
        });
        $("#tbody").show(500);

    })
    .fail(function() {
        alert("Error, Intente de Nuevo");
    });
    
  });
//FIN EVENTO DE BUSCADOR

//EVENTO DE BUSCADOR POR RETIRO
  $("#busqueda_retiro").change(function(event){
    $("busqueda_codigo").val("");
    $("busqueda_pago").val("");

    $.ajax({
        url: 'paginacion.php',
        type: 'get',
        data: {
            'ajax': '',
            'retiro': '',
            'busqueda': $(this).val()
        },
    })
    .done(function(busqueda) {
        var grupos=JSON.parse(busqueda);

        //acomodo el numero de registros
        $("#n-registros").fadeOut('500', function() {
            $("#n-registros").text(grupos[grupos.length-4]);
        });
        $("#n-registros").fadeIn(500);

        //acomoda la paginacion dependiendo de la busqueda
        $("#num-paginacion").hide('500', function() {
            $(this).empty();

            //BOTON DE ANTERIOR
            if (grupos[grupos.length-2]==1) {
                $(this).append('<li class="page-item disabled"><a class="page-link text-dark" style="opacity: 0.6" href="#" tabindex="-1">Anterior</a></li>');
            }else{
                var pagina_a = grupos[grupos.length-2]-1;
                $(this).append('<li class="page-item"><a class="page-link text-dark" href="?pagina='+pagina_a+'&retiro=&busqueda='+grupos[grupos.length-3]+'" tabindex="-1">Anterior</a></li>');
            }

            //NUMEROS DE LA PAGINACION
            for (var i = 0; i<grupos[grupos.length-1]; i++) {
                if (i+1==grupos[grupos.length-2]) {
                    $(this).append('<li class="page-item"><a class="page-link text-dark font-weight-bold" href="?pagina='+(i+1)+'&retiro=&busqueda='+grupos[grupos.length-3]+'">'+(i+1)+'</a></li>');
                }else{
                    $(this).append('<li class="page-item"><a class="page-link text-dark" href="?pagina='+(i+1)+'&retiro=&busqueda='+grupos[grupos.length-3]+'">'+(i+1)+'</a></li>');
                }
            }

            //BOTON DE SIGUIENTE
            if (grupos[grupos.length-2]==grupos[grupos.length-1]) {
                $(this).append('<li class="page-item disabled"><a class="page-link text-dark" style="opacity: 0.6" href="#">Siguiente</a></li>');
            }else{
                var pagina_s = grupos[grupos.length-2]+1;
                $(this).append('<li class="page-item"><a class="page-link text-dark" href="?pagina='+pagina_s+'&retiro=&busqueda='+grupos[grupos.length-3]+'">Siguiente</a></li>');
            }
        });
        $("#num-paginacion").show(500);

        //agrega los valores en la tabla
        $("#tbody").hide('500', function() {
            $(this).empty();
            for (var i = 0; i<grupos.length-4; i++) {
                $(this).append('<tr id="row'+grupos[i]["C_Factura"]+'"><th scope="row"><button onclick="eliminar('+grupos[i]["C_Factura"]+','+grupos[i]["ver"]+')" type="button" class="eliminar" aria-label="Close"><span aria-hidden="true">&times;</span></button></th><td><span class="text-primary c_factura" onclick="mostrar('+grupos[i]["C_Factura"]+')" data-toggle="modal" data-target="#modaldr">'+grupos[i]["C_Factura"]+'</span></td><td>'+grupos[i]["Fecha"]+'</td><td>'+grupos[i]["Cancelacion"]+'</td><td>'+grupos[i]["Modalidad"]+'</td><td style="color: red"><strong>'+grupos[i]["Monto"]+'<font size="3"> Bs</font></strong></td></tr>');
            }
        });
        $("#tbody").show(500);

    })
    .fail(function() {
        alert("Error, Intente de Nuevo");
    });
    
  });
//FIN EVENTO DE BUSCADOR

//EVENTO DE BUSCADOR POR CODIGO
  $("#busqueda_codigo").change(function(event){
    $("busqueda_retiro").val("");
    $("busqueda_pago").val("");

    $.ajax({
        url: 'paginacion.php',
        type: 'get',
        data: {
            'ajax': '',
            'codigo': '',
            'busqueda': $(this).val()
        },
    })
    .done(function(busqueda) {
        var grupos=JSON.parse(busqueda);

        //acomodo el numero de registros
        $("#n-registros").fadeOut('500', function() {
            $("#n-registros").text(grupos[grupos.length-4]);
        });
        $("#n-registros").fadeIn(500);
        
        //acomoda la paginacion dependiendo de la busqueda
        $("#num-paginacion").hide('500', function() {
            $(this).empty();

            //BOTON DE ANTERIOR
            if (grupos[grupos.length-2]==1) {
                $(this).append('<li class="page-item disabled"><a class="page-link text-dark" style="opacity: 0.6" href="#" tabindex="-1">Anterior</a></li>');
            }else{
                var pagina_a = grupos[grupos.length-2]-1;
                $(this).append('<li class="page-item"><a class="page-link text-dark" href="?pagina='+pagina_a+'&codigo=&busqueda='+grupos[grupos.length-3]+'" tabindex="-1">Anterior</a></li>');
            }

            //NUMEROS DE LA PAGINACION
            for (var i = 0; i<grupos[grupos.length-1]; i++) {
                if (i+1==grupos[grupos.length-2]) {
                    $(this).append('<li class="page-item"><a class="page-link text-dark font-weight-bold" href="?pagina='+(i+1)+'&codigo=&busqueda='+grupos[grupos.length-3]+'">'+(i+1)+'</a></li>');
                }else{
                    $(this).append('<li class="page-item"><a class="page-link text-dark" href="?pagina='+(i+1)+'&codigo=&busqueda='+grupos[grupos.length-3]+'">'+(i+1)+'</a></li>');
                }
            }

            //BOTON DE SIGUIENTE
            if (grupos[grupos.length-2]==grupos[grupos.length-1]) {
                $(this).append('<li class="page-item disabled"><a class="page-link text-dark" style="opacity: 0.6" href="#">Siguiente</a></li>');
            }else{
                var pagina_s = grupos[grupos.length-2]+1;
                $(this).append('<li class="page-item"><a class="page-link text-dark" href="?pagina='+pagina_s+'&codigo=&busqueda='+grupos[grupos.length-3]+'">Siguiente</a></li>');
            }
        });
        $("#num-paginacion").show(500);

        //agrega los valores en la tabla
        $("#tbody").hide('500', function() {
            $(this).empty();
            for (var i = 0; i<grupos.length-4; i++) {
                $(this).append('<tr id="row'+grupos[i]["C_Factura"]+'"><th scope="row"><button onclick="eliminar('+grupos[i]["C_Factura"]+','+grupos[i]["ver"]+')" type="button" class="eliminar" aria-label="Close"><span aria-hidden="true">&times;</span></button></th><td><span class="text-primary c_factura" onclick="mostrar('+grupos[i]["C_Factura"]+')" data-toggle="modal" data-target="#modaldr">'+grupos[i]["C_Factura"]+'</span></td><td>'+grupos[i]["Fecha"]+'</td><td>'+grupos[i]["Cancelacion"]+'</td><td>'+grupos[i]["Modalidad"]+'</td><td style="color: red"><strong>'+grupos[i]["Monto"]+'<font size="3"> Bs</font></strong></td></tr>');
            }
        });
        $("#tbody").show(500);

    })
    .fail(function() {
        alert("Error, Intente de Nuevo");
    });
    
  });
//FIN EVENTO DE BUSCADOR

//EVENTO QUE ACOMODA LA INFORMACION DEL MODAL QUE CONTIENE LA INFORMACION DE LA COMPRA
    function mostrar(id){
        var codigo = id;
        $.ajax({
          data : {
            'codigo' : codigo,
            'mostrar' : ""
          },
          url : 'proceso_acompras.php',
          type: 'post',
          beforeSend: function(){
            $("#respuesta_d").html("<label class='font-weight-light text-center'>Por favor espere...</label>");
          },
          success: function(response){
            $("#respuesta_d").html(response);
          }
        });
    }
//FIN EVENTO QUE ACOMODA EL MODAL

//EVENTO DE ELIMINAR UNA COMPRA
    function eliminar(id,estado){
        var factura = id;
        var estado = estado;
        if(estado==1){
          swal({
            title: "Eliminar Registro de Compra",
            text: "¿Esta seguro de eliminar el registro?, la compra todavia es visible por el usuario.",
            icon: "warning",
            buttons: ["Cancelar","Aceptar"],
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {

                $.ajax({
                  data:{
                    'borrar': "",
                    'codigo': factura
                  },
                  url: 'proceso_acompras.php',
                  type: 'post',
                  success:function(censo){
                    console.log(censo);
                    switch (censo) {
                      case "1":
                            swal({
                                title: 'Registro de Compra eliminado Exitosamente!',
                                icon: 'success',
                                closeOnClickOutside: false,
                                button: 'Aceptar',
                            });
                            $(".swal-title").addClass('font-weight-normal');
                            $(".swal-button--confirm").addClass('bg-success');
                            $(".swal-button--confirm").addClass('m-auto');
                            $("#row"+factura).hide(1000);
                        break;
                    }
                  }
                });
                
            }
          });
          $(".swal-text").addClass('text-center');
        }
        else{
          swal({
            title: "Eliminar Registro de Compra",
            text: "¿Esta seguro de eliminar el registro de Compra?",
            icon: "warning",
            buttons: ["Cancelar","Aceptar"],
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
            
                $.ajax({
                  data:{
                    'borrar': "",
                    'codigo': factura
                  },
                  url: 'proceso_acompras.php',
                  type: 'post',
                  success:function(censo){
                    console.log(censo);
                    switch (censo) {
                      case "1":
                            swal({
                                title: 'Registro de Compra eliminado Exitosamente!',
                                icon: 'success',
                                closeOnClickOutside: false,
                                button: 'Aceptar',
                            });
                            $(".swal-title").addClass('font-weight-normal');
                            $(".swal-button--confirm").addClass('bg-success');
                            $(".swal-button--confirm").addClass('m-auto');
                            $("#row"+factura).hide(1000);
                        break;
                    }
                  }
                });

            }
          });
          $(".swal-text").addClass('text-center');
        }
    }
//FIN EVENTO DE ELIMINAR UNA COMPRA