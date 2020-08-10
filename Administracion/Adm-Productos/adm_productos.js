//EVENTO PARA COLOCAR LOS DATOS DEL PRODUCTO A ACTUALIZAR EN EL MODAL
  function actualizar(id){
    var codigo=id;
    var c_nombre=".n_p" + codigo;
    var c_precio=".p_p" + codigo;
    var nombre=$(c_nombre).attr("id");
    var precio=$(c_precio).attr("id");
    var categoria = $(".c_p"+codigo).text();
    $("#a_cat").val(categoria); 
    document.getElementById("a_n").value=nombre;
    document.getElementById("a_p").value=precio;
    document.getElementById("cod_actualizar").value=codigo;
  }
//FIN EVENTO DE COLOCAR LOS DATOS EN EL MODAL DE ACTUALIZAR

//EVENTO DE ELIMINAR UN PRODUCTO
  function eliminar(id){
    var id = id;
      
      swal({
        title: "Eliminar Producto",
        text: "¿Esta seguro de eliminar el producto seleccionado de la BD?",
        icon: "warning",
        buttons: ["Cancelar","Aceptar"],
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {

            $.ajax({
              data:{
                'eliminar': "eliminar-producto",
                'codigo': id
              },
              url: 'actualizacion_pro.php',
              type: 'get',
              success:function(censo){
                console.log(censo);
                switch (censo) {
                  case "1":
                        swal({
                            title: 'Borrado Exitoso del Producto!',
                            text: 'Se ha eliminado el producto de la Base de Datos.',
                            icon: 'success',
                            closeOnClickOutside: false,
                            button: 'Aceptar',
                        });
                          $("#row"+id).hide(1000);
                          $(".swal-button--confirm").addClass('bg-success');
                          $(".swal-button--confirm").addClass('m-auto');
                    break;
                }
              }
            });
            
        }
    });
  }

  /*$(".eliminar").click(function(event) {
      var id = $(this).attr('id');
      
      swal({
        title: "Eliminar Producto",
        text: "¿Esta seguro de eliminar el producto seleccionado de la BD?",
        icon: "warning",
        buttons: ["Cancelar","Aceptar"],
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {

            $.ajax({
              data:{
                'eliminar': "eliminar-producto",
                'codigo': id
              },
              url: 'actualizacion_pro.php',
              type: 'get',
              success:function(censo){
                console.log(censo);
                switch (censo) {
                  case "1":
                        swal({
                            title: 'Borrado Exitoso del Producto!',
                            text: 'Se ha eliminado el producto de la Base de Datos.',
                            icon: 'success',
                            closeOnClickOutside: false,
                            button: 'Aceptar',
                        });
                          $("#row"+id).hide(1000);
                          $(".swal-button--confirm").addClass('bg-success');
                          $(".swal-button--confirm").addClass('m-auto');
                    break;
                }
              }
            });
            
        }
    });
  });*/
//FIN EVENTO DE ELIMINAR PRODUCTO

//EVENTO DE BUSCADOR POR NOMBRE
  $("#busqueda_nombre").change(function(event){
    $("busqueda_categoria").val("");
    $("busqueda_codigo").val("");

    $.ajax({
        url: 'paginacion.php',
        type: 'get',
        data: {
            'ajax': '',
            'nombre': '',
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
                $(this).append('<li class="page-item"><a class="page-link text-dark" href="?pagina='+pagina_a+'&nombre=&busqueda='+grupos[grupos.length-3]+'" tabindex="-1">Anterior</a></li>');
            }

            //NUMEROS DE LA PAGINACION
            for (var i = 0; i<grupos[grupos.length-1]; i++) {
                if (i+1==grupos[grupos.length-2]) {
                    $(this).append('<li class="page-item"><a class="page-link text-dark font-weight-bold" href="?pagina='+(i+1)+'&nombre=&busqueda='+grupos[grupos.length-3]+'">'+(i+1)+'</a></li>');
                }else{
                    $(this).append('<li class="page-item"><a class="page-link text-dark" href="?pagina='+(i+1)+'&nombre=&busqueda='+grupos[grupos.length-3]+'">'+(i+1)+'</a></li>');
                }
            }

            //BOTON DE SIGUIENTE
            if (grupos[grupos.length-2]==grupos[grupos.length-1]) {
                $(this).append('<li class="page-item disabled"><a class="page-link text-dark" style="opacity: 0.6" href="#">Siguiente</a></li>');
            }else{
                var pagina_s = grupos[grupos.length-2]+1;
                $(this).append('<li class="page-item"><a class="page-link text-dark" href="?pagina='+pagina_s+'&nombre=&busqueda='+grupos[grupos.length-3]+'">Siguiente</a></li>');
            }
        });
        $("#num-paginacion").show(500);

        //agrega los valores en la tabla
        $("#tbody").hide('500', function() {
            $(this).empty();
            for (var i = 0; i<grupos.length-4; i++) {
                $(this).append('<tr id="row'+grupos[i]["Codigo"]+'"><td><button onclick="eliminar('+grupos[i]["Codigo"]+')" id="'+grupos[i]["Codigo"]+'" type="button" class="eliminar my-auto mr-3" aria-label="Close"><span aria-hidden="true">&times;</span></button></td><th>'+grupos[i]["Codigo"]+'</th><td class="n_p'+grupos[i]["Codigo"]+'" id="'+grupos[i]["Nombre"]+'">'+grupos[i]["Nombre"]+'</td><td class="c_p'+grupos[i]["Codigo"]+'">'+grupos[i]["Categoria"]+'</td><td class="p_p'+grupos[i]["Codigo"]+'" id="'+grupos[i]["Precio"]+'">'+grupos[i]["Precio"]+'</td><td><button class="btn btn-secondary id_p borde ml-lg-1 mt-xl-0 mt-1 boton-actualizar" data-toggle="modal" data-target="#actualizar" onclick="actualizar('+grupos[i]["Codigo"]+')" id="'+grupos[i]["Codigo"]+'">Actualizar</button></td></tr>');
            }
        });
        $("#tbody").show(500);

    })
    .fail(function() {
        alert("Error, Intente de Nuevo");
    });
    
  });
//FIN EVENTO DE BUSCADOR

//EVENTO DE BUSCADOR POR CATEGORIA
  $("#busqueda_categoria").change(function(event){
    $("busqueda_nombre").val("");
    $("busqueda_codigo").val("");

    $.ajax({
        url: 'paginacion.php',
        type: 'get',
        data: {
            'ajax': '',
            'categoria': '',
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
                $(this).append('<li class="page-item"><a class="page-link text-dark" href="?pagina='+pagina_a+'&categoria=&busqueda='+grupos[grupos.length-3]+'" tabindex="-1">Anterior</a></li>');
            }

            //NUMEROS DE LA PAGINACION
            for (var i = 0; i<grupos[grupos.length-1]; i++) {
                if (i+1==grupos[grupos.length-2]) {
                    $(this).append('<li class="page-item"><a class="page-link text-dark font-weight-bold" href="?pagina='+(i+1)+'&categoria=&busqueda='+grupos[grupos.length-3]+'">'+(i+1)+'</a></li>');
                }else{
                    $(this).append('<li class="page-item"><a class="page-link text-dark" href="?pagina='+(i+1)+'&categoria=&busqueda='+grupos[grupos.length-3]+'">'+(i+1)+'</a></li>');
                }
            }

            //BOTON DE SIGUIENTE
            if (grupos[grupos.length-2]==grupos[grupos.length-1]) {
                $(this).append('<li class="page-item disabled"><a class="page-link text-dark" style="opacity: 0.6" href="#">Siguiente</a></li>');
            }else{
                var pagina_s = grupos[grupos.length-2]+1;
                $(this).append('<li class="page-item"><a class="page-link text-dark" href="?pagina='+pagina_s+'&categoria=&busqueda='+grupos[grupos.length-3]+'">Siguiente</a></li>');
            }
        });
        $("#num-paginacion").show(500);

        //agrega los valores en la tabla
        $("#tbody").hide('500', function() {
            $(this).empty();
            for (var i = 0; i<grupos.length-4; i++) {
                $(this).append('<tr id="row'+grupos[i]["Codigo"]+'"><td><button onclick="eliminar('+grupos[i]["Codigo"]+')" id="'+grupos[i]["Codigo"]+'" type="button" class="eliminar my-auto mr-3" aria-label="Close"><span aria-hidden="true">&times;</span></button></td><th>'+grupos[i]["Codigo"]+'</th><td class="n_p'+grupos[i]["Codigo"]+'" id="'+grupos[i]["Nombre"]+'">'+grupos[i]["Nombre"]+'</td><td class="c_p'+grupos[i]["Codigo"]+'">'+grupos[i]["Categoria"]+'</td><td class="p_p'+grupos[i]["Codigo"]+'" id="'+grupos[i]["Precio"]+'">'+grupos[i]["Precio"]+'</td><td><button class="btn btn-secondary id_p borde ml-lg-1 mt-xl-0 mt-1 boton-actualizar" data-toggle="modal" data-target="#actualizar" onclick="actualizar('+grupos[i]["Codigo"]+')" id="'+grupos[i]["Codigo"]+'">Actualizar</button></td></tr>');
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
    $("busqueda_categoria").val("");
    $("busqueda_nombre").val("");

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
                $(this).append('<tr id="row'+grupos[i]["Codigo"]+'"><td><button onclick="eliminar('+grupos[i]["Codigo"]+')" id="'+grupos[i]["Codigo"]+'" type="button" class="eliminar my-auto mr-3" aria-label="Close"><span aria-hidden="true">&times;</span></button></td><th>'+grupos[i]["Codigo"]+'</th><td class="n_p'+grupos[i]["Codigo"]+'" id="'+grupos[i]["Nombre"]+'">'+grupos[i]["Nombre"]+'</td><td class="c_p'+grupos[i]["Codigo"]+'">'+grupos[i]["Categoria"]+'</td><td class="p_p'+grupos[i]["Codigo"]+'" id="'+grupos[i]["Precio"]+'">'+grupos[i]["Precio"]+'</td><td><button class="btn btn-secondary id_p borde ml-lg-1 mt-xl-0 mt-1 boton-actualizar" data-toggle="modal" data-target="#actualizar" onclick="actualizar('+grupos[i]["Codigo"]+')" id="'+grupos[i]["Codigo"]+'">Actualizar</button></td></tr>');
            }
        });
        $("#tbody").show(500);

    })
    .fail(function() {
        alert("Error, Intente de Nuevo");
    });
    
  });
//FIN EVENTO DE BUSCADOR