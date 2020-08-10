$("#register").validate({ //VALIDACIONES DEL FORMULARIO SI TODO SE CUMPLE SE LANZARIA EL EVENTO SUBMIT

  rules:{ //REGLAS DE VALIDACION PARA CADA INPUT
    monto1:{
      number:true,
      required: true,
      min: 0
    },
    monto2:{
      number:true,
      required: true,
      min: 0
    }
  },

  messages:{  //MENSAJES DE VALIDACION CONFORME A CADA VALIDACION ECHA
    monto1:{
      number:"Ingrese solamente valores númericos",
      required:"Ingrese un Monto de Busqueda",
      min: "Porfavor Ingrese solo montos superiores a 0 Bs"
    },
    monto2:{
      number:"Ingrese solamente valores númericos",
      required:"Ingrese un Monto de Busqueda",
      min: "Porfavor Ingrese solo montos superiores a 0 Bs"
    }   
  },

  errorPlacement:function(error,element){ //Para reposicionar los elementos de error que son level
    error.insertAfter(element);
  }

});