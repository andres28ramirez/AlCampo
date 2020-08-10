  //SECCION DE ACOMODAR DETALLES DEL ASPECTO DE TABLA DE CARRITO Y BOTONES EXTERNOS//
  var valor = $("#precio2").text();
  var total = $("#cantidad-texto").text();

  $("#precio1").text(valor);

  $("#boton-pagar").click(function(event) {
    var id = $("#id-usuario").val();
    if(id==0){
      //EL USUARIO NO LOGGUEADO OBLIGARLO A LOGGUEAR Y GRABAR EL CARRITO COMPLETO
      swal({
            title: 'Debes Iniciar Sesión para Realizar el Pago',
            icon: 'warning',
            closeOnClickOutside: false,
            button: "Aceptar",
          });
      $(".swal-button--confirm").addClass('bg-danger');
      $(".swal-title").addClass('font-weight-normal');
      $(".swal-button--confirm").attr('onclick', 'redireccion()');
    }
    else
      $("#pagar").modal("show");
  });

  $("#0").click(function(event){
    swal({
      title: "Vaciar Carrito",
      text: "¿Esta seguro de eliminar todos los productos del carrito?",
      icon: "warning",
      buttons: ["Cancelar","Aceptar"],
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          data:{
            'solicitud': "eliminar-carrito",
            'id': $("#id-usuario").val()
          },
          url: 'procesos_car.php',
          type: 'post',
          success:function(censo){
            console.log(censo);
            switch (censo) {
              case "1":
                    swal({
                      title: 'Carrito Vaciado correctamente!',
                      icon: 'success',
                      closeOnClickOutside: false,
                      button: 'Aceptar',
                    });
                    $(".swal-button--confirm").addClass('bg-success');
                    $(".swal-button--confirm").addClass('m-auto');
                    $(".swal-title").addClass('font-weight-normal');
                    $("#cantidad-carrito").text("0");
                    var id = $(this).attr('id');
                    $("#cantidad-texto").text("0");
                    $("#carrito-vacio").append('<div class="row justify-content-center mt-4 mb-4"><div class="col-12 my-3 py-4"><p class="display-6 text-dark my-4"><span class="display-5 text-primary">CARRITO VACIO,</span><br>No se encuentran Productos Registrados.</p><h5 class="text-muted">¡Prueba anexar Productos al Carrito con solo un <a href="../Productos/productos.php?producto=">click</a>!</h5></div></div>');
                    $("#tabla-carrito").hide(500);
                    $(".tabla-info").hide(500);
                break;
            }
          }
        });
      }
    });
  });

  $(".eliminar").click(function(event){
    swal({
      title: "Eliminar Producto",
      text: "¿Esta seguro de eliminar el producto seleccionado del carrito?",
      icon: "warning",
      buttons: ["Cancelar","Aceptar"],
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          data:{
            'solicitud': "eliminar-producto",
            'id': $("#id-usuario").val(),
            'codigo': $(this).attr("id")
          },
          url: 'procesos_car.php',
          type: 'post',
          success:function(censo){
            console.log(censo);
            switch (censo) {
              case "1":
                    swal({
                      title: 'Producto eliminado correctamente!',
                      icon: 'success',
                      closeOnClickOutside: false,
                      button: 'Aceptar',
                    });
                    $(".swal-button--confirm").addClass('bg-success');
                    $(".swal-button--confirm").addClass('m-auto');
                    $(".swal-title").addClass('font-weight-normal');
                    var texto = $("#cantidad-carrito").text();
                    texto = parseInt(texto);
                    texto--;
                    $("#cantidad-carrito").text(texto);
                break;
            }
          }
        });

        var id = $(this).attr('id');
        total--;
        $("#cantidad-texto").text(total);
        $("#row"+id).hide(500);
        if (total==0) {
            $("#tabla-carrito").hide(500);
            $(".tabla-info").hide(500);
            $("#carrito-vacio").append('<div class="row justify-content-center mt-4 mb-4"><div class="col-12 my-3 py-4"><p class="display-6 text-dark my-4"><span class="display-5 text-primary">CARRITO VACIO,</span><br>No se encuentran Productos Registrados.</p><h5 class="text-muted">¡Prueba anexar Productos al Carrito con solo un <a href="../Productos/productos.php?producto=">click</a>!</h5></div></div>');
        }
        else if (total==1){
            $("#tabla-carrito").animate(
                {
                    margin: 20, 
                }, 1000);
        }

        //ACOMODAR EL PRECIO TOTAL ARRIBA Y ABAJO
        var pro_total = $("#total"+id).text(); pro_total = parseInt(pro_total);
        var monto_total = $("#precio1").text(); monto_total = parseInt(monto_total);
        monto_total -= pro_total;
        $("#precio1").text(monto_total+" Bs");
        $("#precio2").text(monto_total+" Bs");
      }
    });
  });
  //FIN DE SECCION DE TABLA CARRITO Y BOTONES EXTERNOS

  //ANIMACIONES Y MODIFICACIONES PARA EL CAMBIO DE LA CANTIDAD DE PRODUCTOS DEL CARRITO
  $(".balto").click(function(event) {
    var id = $(this).attr('id');//COJO ID UNICO POR BOTON!
    var suma=0; //valor para ajustar la cantidad
    if($(this).val()=="+")  //TODO CONFORME AL VALUE DEL BOTON
      suma = 1;
    else
      suma = -1;
    $(".unidades").each(function(index, el) {
      var cod = $(this).attr('name');
        if(id==cod){  //CUANDO ENCUENTRE QUE EL ID ES EL MISMO PARA LOS BOTONES Y LA ETIQUETA DE LA CANTIDAD
          var cantidad = $(this).text(); cantidad = parseInt(cantidad);
          if(cantidad==1){
            if(suma!=-1){
              cantidad += suma;
              $.ajax({
                data:{
                  'solicitud': "actualizar-carrito",
                  'cantidad': cantidad,
                  'id': $("#id-usuario").val(),
                  'codigo': id
                },
                url: 'procesos_car.php',
                type: 'post',
                success:function(censo){
                  console.log(censo);
                  switch (censo) {
                    case "1":
                      //ACOMODAR LOS MONTOS EN CADA PRODUCTO
                      $("#pro"+id).text(cantidad);
                      var pro_unidad = $("#uni"+id).text(); pro_unidad = parseInt(pro_unidad);
                      pro_total = pro_unidad*cantidad;
                      $("#total"+id).empty();
                      $("#total"+id).append("<strong>"+pro_total+"<font size='3'> Bs</font></strong>");
                      
                      //ACOMODAR EL PRECIO TOTAL ARRIBA Y ABAJO
                      var monto_total = $("#precio1").text(); monto_total = parseInt(monto_total);
                      if(suma==-1)
                        monto_total -= pro_unidad;
                      else
                        monto_total += pro_unidad;
                      $("#precio1").text(monto_total+" Bs");
                      $("#precio2").text(monto_total+" Bs");
                      break;
                  }
                }
              });
            }
          }
          else{
            cantidad += suma;
            $.ajax({
              data:{
                'solicitud': "actualizar-carrito",
                'cantidad': cantidad,
                'id': $("#id-usuario").val(),
                'codigo': id
              },
              url: 'procesos_car.php',
              type: 'post',
              success:function(censo){
                console.log(censo);
                switch (censo) {
                  case "1":
                      //ACOMODAR LOS MONTOS EN CADA PRODUCTO
                      $("#pro"+id).text(cantidad);
                      var pro_unidad = $("#uni"+id).text(); pro_unidad = parseInt(pro_unidad);
                      pro_total = pro_unidad*cantidad;
                      $("#total"+id).empty();
                      $("#total"+id).append("<strong>"+pro_total+"<font size='3'> Bs</font></strong>");

                      //ACOMODAR EL PRECIO TOTAL ARRIBA Y ABAJO
                      var monto_total = $("#precio1").text(); monto_total = parseInt(monto_total);
                      if(suma==-1)
                        monto_total -= pro_unidad;
                      else
                        monto_total += pro_unidad;
                      $("#precio1").text(monto_total+" Bs");
                      $("#precio2").text(monto_total+" Bs");
                      break;
                    break;
                }
              }
            });
          }
        }
    });
  });
      
