//EVENTO PARA CONVERTIR UN USUARIO EN ADMINISTRADOR
  function convertir(id){
    var id=id;
    swal({
        title: "Privilegios de Usuario",
        text: "¿Habilitara los privilegios de administrador al usuario?",
        icon: "warning",
        buttons: ["Cancelar","Aceptar"],
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            
            $.ajax({
              data:{
                'convertir': "",
                'id': id
              },
              url: 'proceso_ausuarios.php',
              type: 'post',
              success:function(censo){
                console.log(censo);
                switch (censo) {
                  case "1":
                        swal({
                            title: 'Modificación Exitosa!',
                            text: 'El Usuario ahora posee el nivel de Operador.',
                            icon: 'success',
                            closeOnClickOutside: false,
                            button: 'Aceptar',
                        });
                        $(".swal-button--confirm").addClass('bg-success');
                        $(".swal-button--confirm").addClass('m-auto');
                        $("#boton-"+id).fadeOut('500', function() {
                            $(this).empty();
                            $(this).append('<button onclick="quitar('+id+')" class="btn btn-danger boton-eliminar w-100">Quitar</button>');
                        });
                        $("#boton-"+id).fadeIn(500);
                    break;

                  case "2":
                        swal({
                            title: 'No Posees los Permisos!',
                            text: 'Esta Operación no puede ser realizada por usted.',
                            icon: 'error',
                            closeOnClickOutside: false,
                            button: 'Aceptar',
                        });
                        $(".swal-button--confirm").addClass('bg-danger');
                        $(".swal-button--confirm").addClass('m-auto');
                    break;
                }
              }
            });
            
        }
    });
  }
//FIN EVENTO PARA CONVERTIR UN USUARIO EN ADMINISTRADOR

//EVENTO PARA QUITAR UN USUARIO EN ADMINISTRADOR
  function quitar(id){
    var id=id;
    swal({
        title: "Privilegios de Usuario",
        text: "Sustraera los privilegios de administrador al usuario?",
        icon: "warning",
        buttons: ["Cancelar","Aceptar"],
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            
            $.ajax({
              data:{
                'quitar': "",
                'id': id
              },
              url: 'proceso_ausuarios.php',
              type: 'post',
              success:function(censo){
                console.log(censo);
                switch (censo) {
                  case "1":
                        swal({
                            title: 'Modificación Exitosa!',
                            text: 'El Usuario ya no posee el nivel de Operador.',
                            icon: 'success',
                            closeOnClickOutside: false,
                            button: 'Aceptar',
                        });
                        $(".swal-button--confirm").addClass('bg-success');
                        $(".swal-button--confirm").addClass('m-auto');
                        $("#boton-"+id).fadeOut('500', function() {
                            $(this).empty();
                            $(this).append('<button onclick="convertir('+id+')" class="btn btn-secondary boton-actualizar w-100">Convertir</button>');
                        });
                        $("#boton-"+id).fadeIn(500);
                    break;

                  case "2":
                        swal({
                            title: 'No Posees los Permisos!',
                            text: 'Esta Operación no puede ser realizada por usted.',
                            icon: 'error',
                            closeOnClickOutside: false,
                            button: 'Aceptar',
                        });
                        $(".swal-button--confirm").addClass('bg-danger');
                        $(".swal-button--confirm").addClass('m-auto');
                    break;
                }
              }
            });
            
        }
    });
  }
//FIN EVENTO PARA QUITAR UN USUARIO EN ADMINISTRADOR

//EVENTO DE ELIMINAR UN USUARIO
  function eliminar(cedula){
    var cedula = cedula;
      
    swal({
        title: "Eliminar Usuario",
        text: "¿Esta seguro de eliminar al usuario seleccionado de la BD?",
        icon: "warning",
        buttons: ["Cancelar","Aceptar"],
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            
            $.ajax({
              data:{
                'borrar': "",
                'cedula': cedula
              },
              url: 'proceso_ausuarios.php',
              type: 'post',
              success:function(censo){
                console.log(censo);
                switch (censo) {
                  case "1":
                        swal({
                            title: 'Borrado Exitoso del Usuario!',
                            text: 'Se ha Borrado con exito los datos del Usuario.',
                            icon: 'success',
                            closeOnClickOutside: false,
                            button: 'Aceptar',
                        });
                          $(".swal-button--confirm").addClass('bg-success');
                          $(".swal-button--confirm").addClass('m-auto');
                          $("#row"+cedula).hide(1000);
                    break;
                }
              }
            });
            
        }
    });
  }
//FIN EVENTO DE ELIMINAR USUARIO

//EVENTO DE BUSCADOR POR NOMBRE
  $("#busqueda_nombre").change(function(event){
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
                if(grupos[i]["Tipo_Usuario"]!=2)
                    //CUANDO SU NIVEL DE USUARIO TIENE PRIVILEGIOS
                    $(this).append('<tr id="row'+grupos[i]["Ci"]+'"><th scope="row"><button type="submit" class="eliminar" aria-label="Close" name="borrar" onclick="eliminar('+grupos[i]["Ci"]+')"><span aria-hidden="true">&times;</span></button></th><td>'+grupos[i]["Nombre"]+'</td><td>'+grupos[i]["Apellido"]+'</td><th>'+grupos[i]["Ci"]+'</th><td>'+grupos[i]["Correo"]+'</td><td id="boton-'+grupos[i]["ID"]+'"><button onclick="quitar('+grupos[i]["ID"]+')" class="btn btn-danger boton-eliminar w-100">Quitar</button></td></tr>');
                else
                    //CUANDO SU NIVEL DE USUARIO NO TIENE PRIVILEGIOS
                    $(this).append('<tr id="row'+grupos[i]["Ci"]+'"><th scope="row"><button type="submit" class="eliminar" aria-label="Close" name="borrar" onclick="eliminar('+grupos[i]["Ci"]+')"><span aria-hidden="true">&times;</span></button></th><td>'+grupos[i]["Nombre"]+'</td><td>'+grupos[i]["Apellido"]+'</td><th>'+grupos[i]["Ci"]+'</th><td>'+grupos[i]["Correo"]+'</td><td id="boton-'+grupos[i]["ID"]+'"><button onclick="convertir('+grupos[i]["ID"]+')" class="btn btn-secondary boton-actualizar w-100">Convertir</button></td></tr>');
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
                if(grupos[i]["Tipo_Usuario"]!=2)
                    //CUANDO SU NIVEL DE USUARIO TIENE PRIVILEGIOS
                    $(this).append('<tr id="row'+grupos[i]["Ci"]+'"><th scope="row"><button type="submit" class="eliminar" aria-label="Close" name="borrar" onclick="eliminar('+grupos[i]["Ci"]+')"><span aria-hidden="true">&times;</span></button></th><td>'+grupos[i]["Nombre"]+'</td><td>'+grupos[i]["Apellido"]+'</td><th>'+grupos[i]["Ci"]+'</th><td>'+grupos[i]["Correo"]+'</td><td id="boton-'+grupos[i]["ID"]+'"><button onclick="quitar('+grupos[i]["ID"]+')" class="btn btn-danger boton-eliminar w-100">Quitar</button></td></tr>');
                else
                    //CUANDO SU NIVEL DE USUARIO NO TIENE PRIVILEGIOS
                    $(this).append('<tr id="row'+grupos[i]["Ci"]+'"><th scope="row"><button type="submit" class="eliminar" aria-label="Close" name="borrar" onclick="eliminar('+grupos[i]["Ci"]+')"><span aria-hidden="true">&times;</span></button></th><td>'+grupos[i]["Nombre"]+'</td><td>'+grupos[i]["Apellido"]+'</td><th>'+grupos[i]["Ci"]+'</th><td>'+grupos[i]["Correo"]+'</td><td id="boton-'+grupos[i]["ID"]+'"><button onclick="convertir('+grupos[i]["ID"]+')" class="btn btn-secondary boton-actualizar w-100">Convertir</button></td></tr>');
            }
        });
        $("#tbody").show(500);

    })
    .fail(function() {
        alert("Error, Intente de Nuevo");
    });
    
  });
//FIN EVENTO DE BUSCADOR