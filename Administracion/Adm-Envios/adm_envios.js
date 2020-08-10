//EVENTO DE BUSCADOR POR PAGO
  $("#busqueda_estatus").change(function(event){
    $("busqueda_retiro").val("");
    $("busqueda_codigo").val("");

    $.ajax({
        url: 'paginacion.php',
        type: 'get',
        data: {
            'ajax': '',
            'estatus': '',
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
                $(this).append('<li class="page-item"><a class="page-link text-dark" href="?pagina='+pagina_a+'&estatus=&busqueda='+grupos[grupos.length-3]+'" tabindex="-1">Anterior</a></li>');
            }

            //NUMEROS DE LA PAGINACION
            for (var i = 0; i<grupos[grupos.length-1]; i++) {
                if (i+1==grupos[grupos.length-2]) {
                    $(this).append('<li class="page-item"><a class="page-link text-dark font-weight-bold" href="?pagina='+(i+1)+'&estatus=&busqueda='+grupos[grupos.length-3]+'">'+(i+1)+'</a></li>');
                }else{
                    $(this).append('<li class="page-item"><a class="page-link text-dark" href="?pagina='+(i+1)+'&estatus=&busqueda='+grupos[grupos.length-3]+'">'+(i+1)+'</a></li>');
                }
            }

            //BOTON DE SIGUIENTE
            if (grupos[grupos.length-2]==grupos[grupos.length-1]) {
                $(this).append('<li class="page-item disabled"><a class="page-link text-dark" style="opacity: 0.6" href="#">Siguiente</a></li>');
            }else{
                var pagina_s = grupos[grupos.length-2]+1;
                $(this).append('<li class="page-item"><a class="page-link text-dark" href="?pagina='+pagina_s+'&estatus=&busqueda='+grupos[grupos.length-3]+'">Siguiente</a></li>');
            }
        });
        $("#num-paginacion").show(500);

        //agrega los valores en la tabla
        $("#tbody").hide('500', function() {
            $(this).empty();
            for (var i = 0; i<grupos.length-4; i++) {
                $(this).append('<tr id="row'+grupos[i]["C_Factura"]+'"><td><span class="text-primary c_factura" onclick="mostrar('+grupos[i]["C_Factura"]+')" data-toggle="modal" data-target="#modaldr">'+grupos[i]["C_Factura"]+'</span></td><td id="estado'+grupos[i]["C_Factura"]+'">'+grupos[i]["estado"]+'</td><td id="movimiento'+grupos[i]["C_Factura"]+'">'+grupos[i]["movimiento"]+'</td><td class="font-weight-bold">'+grupos[i]["tipo"]+'</td><td>'+grupos[i]["fecha"]+'</td><td><button class="btn btn-secondary boton ml-lg-1 mt-xl-0 mt-1" onclick="editar('+grupos[i]["C_Factura"]+')" data-toggle="modal" data-target="#modale">Modificar</button></td></tr>');
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
    $("busqueda_estatus").val("");

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
                $(this).append('<tr id="row'+grupos[i]["C_Factura"]+'"><td><span class="text-primary c_factura" onclick="mostrar('+grupos[i]["C_Factura"]+')" data-toggle="modal" data-target="#modaldr">'+grupos[i]["C_Factura"]+'</span></td><td id="estado'+grupos[i]["C_Factura"]+'">'+grupos[i]["estado"]+'</td><td id="movimiento'+grupos[i]["C_Factura"]+'">'+grupos[i]["movimiento"]+'</td><td class="font-weight-bold">'+grupos[i]["tipo"]+'</td><td>'+grupos[i]["fecha"]+'</td><td><button class="btn btn-secondary boton ml-lg-1 mt-xl-0 mt-1" onclick="editar('+grupos[i]["C_Factura"]+')" data-toggle="modal" data-target="#modale">Modificar</button></td></tr>');
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
    $("busqueda_estatus").val("");

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
                $(this).append('<tr id="row'+grupos[i]["C_Factura"]+'"><td><span class="text-primary c_factura" onclick="mostrar('+grupos[i]["C_Factura"]+')" data-toggle="modal" data-target="#modaldr">'+grupos[i]["C_Factura"]+'</span></td><td id="estado'+grupos[i]["C_Factura"]+'">'+grupos[i]["estado"]+'</td><td id="movimiento'+grupos[i]["C_Factura"]+'">'+grupos[i]["movimiento"]+'</td><td class="font-weight-bold">'+grupos[i]["tipo"]+'</td><td>'+grupos[i]["fecha"]+'</td><td><button class="btn btn-secondary boton ml-lg-1 mt-xl-0 mt-1" onclick="editar('+grupos[i]["C_Factura"]+')" data-toggle="modal" data-target="#modale">Modificar</button></td></tr>');
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
          url : 'proceso_envios.php',
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

//EVENTO QUE MUESTRA EL MODAL DE MODIFICAR
    function editar(id){
        var codigo = id;
        $.ajax({
          data : {
            'codigo' : codigo,
            'mostrar-editar' : ""
          },
          url : 'proceso_envios.php',
          type: 'post',
          beforeSend: function(){
            $("#respuesta_e").html("<label class='font-weight-light text-center'>Por favor espere...</label>");
          },
          success: function(response){
            $("#respuesta_e").html(response);
          }
        });
    }
//FIN EVENTO QUE MUESTRA EL MODAL DE MODIFICAR