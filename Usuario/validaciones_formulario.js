$("#registro").validate({	

	rules:{	
		///////////// DATOS DE REGISTRO ////////////
		nombre:{
			required:true
		},
		apellido: "required",
		email:{
			email:true,
			required:true
		},
		cedula:{
			number:true,
			required:true,
			minlength: 7
		},
		direccion:{
			required: true,
			minlength:10
		},
		municipio:{
			required: true,
		},
		contraseña:{
			required:true,
			minlength:6
		},
		confirmar:{
			equalTo:"#contraseña",
			required:true,
			minlength:6
		},
	},

	messages:{
		//////////// DATOS DE REGISTRO /////////
		nombre:{
			required:"Porfavor ingrese su nombre",
		},
		apellido:"Porfavor ingrese su Apellido",
		email:{
			email:"Porfavor ingrese un correo valido",
			required:"Porfavor ingrese un correo"
		},
		cedula:{
			number:"Porfavor ingrese solamente valores númericos",
			required:"Porfavor ingrese su Cédula de Identidad",
			minlength: "Porfavor ingrese una cédula valida (7 cifras minimo)"
		},
		direccion:{
			required:"Porfavor ingrese su dirección de Vivienda",
			minlength:"Porfavor ingrese minimo 10 caracteres de información"
		},
		municipio:{
			required:"Porfavor ingrese su municipio actual",
		},
		contraseña:{
			required:"Porfavor ingrese su contraseña",
			minlength:"Porfavor ingrese una contraseña valida (6 caracteres minimo)"
		},
		confirmar:{
			required:"Porfavor ingrese su confirmación de contraseña",
			equalTo:"Porfavor ingrese una contraseña que coincide con la principal",
			minlength:"Porfavor ingrese una contraseña valida (6 caracteres minimo)"
		},
	},

	submitHandler:function(form){
		$("#fail-email").fadeOut(500);
		$("#fail-cedula").fadeOut(500);
		$.ajax({
			data:{
				'btnsubmit': "",
				'solicitud': "registro",
				'nombre': $("#nombre").val(),
				'apellido': $("#apellido").val(),
				'cedula': $("#cedula").val(),
				'direccion': $("#direccion").val(),
				'municipio': $("#municipio").val(),
				'email': $("#email").val(),
				'contraseña': $("#contraseña").val()
			},
			url: 'proceso_usuario.php',
			type: 'post',
			success:function(censo){
				console.log(censo);
				switch (censo) {
					case "3":
						swal({
			        	  title: 'Registro Exitoso',
			        	  text: 'Porfavor realice el inicio de sesión nuevamente',
			        	  icon: 'success',
			        	  closeOnClickOutside: false,
			        	  button: "Aceptar",
			        	});
						$(".swal-button--confirm").addClass('bg-success');
						$(".swal-button--confirm").addClass('m-auto');
						$(".swal-button--confirm").attr('onclick', 'redireccion2()');
						break;

					case "2":
						location.href = "#cedula";
						$("#fail-cedula").fadeIn(500);
						break;

					case "1":
						location.href = "#email";
						$("#fail-email").fadeIn(500);
						break;
				}
			}
		});
	},

	errorPlacement:function(error,element){ //Para reposicionar los elementos de error que son level
		error.insertAfter(element);
	}

});

$("#login").validate({	

	rules:{	
		correo:{
			email:true,
			required:true
		},
	},

	messages:{
		correo:{
			email:"Porfavor ingrese un correo valido (e.g: nombre@ejemplo.com)",
			required:"Porfavor ingrese un correo"
		},
	},

	submitHandler:function(form){
		$("#fail-contraseña").fadeOut(500);
		$("#fail-correo").fadeOut(500);
		$.ajax({
			data:{
				'btnsubmit': "",
				'solicitud': "login",
				'id': $("#id-persona").val(),
				'correo': $("#correo").val(),
				'contraseña': $("#password").val()
			},
			url: 'proceso_usuario.php',
			type: 'post',
			success:function(censo){
				console.log(censo);
				switch (censo) {
					case "1":
						swal({
			        	  title: 'Inicio de Sesión con Exito',
			        	  text: 'Porfavor precione el boton "Aceptar" para volver al inicio',
			        	  icon: 'success',
			        	  closeOnClickOutside: false,
			        	  button: "Aceptar",
			        	});
						$(".swal-button--confirm").addClass('bg-success');
						$(".swal-button--confirm").addClass('m-auto');
						$(".swal-button--confirm").attr('onclick', 'redireccion()');
						break;

					case "2":
						$("#fail-contraseña").fadeIn(500);
						break;

					case "3":
						$("#fail-correo").fadeIn(500);
						break;

					case "4":
						swal({
			        	  title: 'Inicio de Sesión con Exito',
			        	  text: 'Precione "Aceptar" para ir al panel administrativo',
			        	  icon: 'success',
			        	  closeOnClickOutside: false,
			        	  button: "Aceptar",
			        	});
						$(".swal-button--confirm").addClass('bg-success');
						$(".swal-button--confirm").addClass('m-auto');
						$(".swal-button--confirm").attr('onclick', 'redireccion3()');
						break;
				}
			}
		});
	},

	errorPlacement:function(error,element){ //Para reposicionar los elementos de error que son level
		error.insertAfter(element);
	}

});

//VALIDACIONES DE CADA FORMULARIO PARA REALIZAR LA ACTUALIZACION
  //FORMULARI DE EMAIL
$("#f_correo").validate({
    rules:{ //REGLAS DE VALIDACION PARA CADA INPUT
      correo1:{
        email:true,
        required: true
      },
      correo2:{
      	equalTo:"#correo1",
        email:true,
        required: true
      }
    },
    //////////////////////////////////////////////////////////////////////
    messages:{  //MENSAJES DE VALIDACION CONFORME A CADA VALIDACION ECHA
      correo1:{
        email:"Porfavor ingrese un correo valido (e.g: nombre@ejemplo.com)",
        required:"Porfavor ingrese un correo"
      },
     correo2:{
        email:"Porfavor ingrese un correo valido (e.g: nombre@ejemplo.com)",
        required:"Porfavor ingrese un correo",
        equalTo:"El Correo no concuerda con el principal"
      }   
    },

    submitHandler:function(form){
		$("#fail-correo").fadeOut(500);
		$(".fail-contraseña").fadeOut(500);
		$.ajax({
			data:{
				'btnsubmit': "",
				'solicitud': "m_correo",
				'contra': $("#contra1").val(),
				'correo1': $("#correo1").val(),
				'codigo': $("#id-persona").val()
			},
			url: 'proceso_usuario.php',
			type: 'post',
			success:function(censo){
				console.log(censo);
				switch (censo) {
					case "3":
						$(".fail-contraseña").fadeIn(500);
						break;

					case "2":
						swal({
			        	  title: 'Configuración de Correo, se realizo Exitosamente!',
			        	  icon: 'success',
			        	  closeOnClickOutside: false,
			        	  button: "Aceptar",
			        	});
						$(".swal-button--confirm").addClass('bg-success');
						$(".swal-button--confirm").addClass('m-auto');
						$(".swal-title").addClass('font-weight-normal');
						var valor = $("#correo1").val();
						$("#texto-correo").text(valor);
						break;

					case "1":
						$("#fail-correo").fadeIn(500);
						break;
				}
			}
		});
	},

    errorPlacement:function(error,element){ //Para reposicionar los elementos de error que son level
      error.insertAfter(element);
    }
});

  //FORMULARIO DE NUEVA CONTRASEÑA
$("#f_pass").validate({
    rules:{ //REGLAS DE VALIDACION PARA CADA INPUT
      pass1:{
        minlength:6,
        required: true
      },
      pass2:{
      	equalTo:"#pass1",
        minlength:6,
        required: true
      }
    },
    //////////////////////////////////////////////////////////////////////
    messages:{  //MENSAJES DE VALIDACION CONFORME A CADA VALIDACION ECHA
      pass1:{
        minlength:"Porfavor ingrese una contraseña valida (6 caracteres minimo)",
        required:"Porfavor ingrese su nueva contraseña"
      },
      pass2:{
        minlength:"Porfavor ingrese una contraseña valida (6 caracteres minimo)",
        required:"Porfavor ingrese la nueva contraseña nuevamente",
        equalTo:"La contraseña suministrada no coincide con la principal"
      }   
    },

    submitHandler:function(form){
		$(".fail-contraseña").fadeOut(500);
		$.ajax({
			data:{
				'btnsubmit': "",
				'solicitud': "m_contraseña",
				'contra': $("#contra2").val(),
				'pass1': $("#pass1").val(),
				'codigo': $("#id-persona").val()
			},
			url: 'proceso_usuario.php',
			type: 'post',
			success:function(censo){
				console.log(censo);
				switch (censo) {
					case "2":
						$(".fail-contraseña").fadeIn(500);
						break;

					case "1":
						swal({
			        	  title: 'Configuración de Contraseña, se realizo Exitosamente!',
			        	  icon: 'success',
			        	  closeOnClickOutside: false,
			        	  button: "Aceptar",
			        	});
						$(".swal-button--confirm").addClass('bg-success');
						$(".swal-button--confirm").addClass('m-auto');
						$(".swal-title").addClass('font-weight-normal');
						break;
				}
			}
		});
	},

    errorPlacement:function(error,element){ //Para reposicionar los elementos de error que son level
      error.insertAfter(element);
    }
});

  //FORMULARIO DE NUEVO NOMBRE
$("#f_nombre").validate({
    rules:{ //REGLAS DE VALIDACION PARA CADA INPUT
      nombre:{
        required: true,
        minlength: 3
      }
    },
    //////////////////////////////////////////////////////////////////////
    messages:{  //MENSAJES DE VALIDACION CONFORME A CADA VALIDACION ECHA
      nombre:{
      		required:"Porfavor ingrese su nuevo nombre",
      		minlength:"Porfavor ingrese un nombre mayor a 3 carácteres"
      },
    },

    submitHandler:function(form){
		$(".fail-contraseña").fadeOut(500);
		$.ajax({
			data:{
				'btnsubmit': "",
				'solicitud': "m_nombre",
				'nombre': $("#nombre").val(),
				'apellido': $("#texto-apellido").text(),
				'codigo': $("#id-persona").val()
			},
			url: 'proceso_usuario.php',
			type: 'post',
			success:function(censo){
				console.log(censo);
				switch (censo) {
					case "1":
						swal({
			        	  title: 'Configuración de Nombre, se realizo Exitosamente!',
			        	  icon: 'success',
			        	  closeOnClickOutside: false,
			        	  button: "Aceptar",
			        	});
						$(".swal-button--confirm").addClass('bg-success');
						$(".swal-button--confirm").addClass('m-auto');
						$(".swal-title").addClass('font-weight-normal');
						var apellido = $("#texto-apellido").text();
						var texto = $("#nombre").val();
						$("#texto2-nombre").text(texto);
						texto = texto+" "+apellido;
						$("#texto-nombre").text(texto);
						break;
				}
			}
		});
	},

    errorPlacement:function(error,element){ //Para reposicionar los elementos de error que son level
      error.insertAfter(element);
    }
});

  //FORMULARIO DE NUEVO APELLIDO
$("#f_apellido").validate({
    rules:{ //REGLAS DE VALIDACION PARA CADA INPUT
      apellido:{
        required: true,
        minlength: 3
      }
    },
    //////////////////////////////////////////////////////////////////////
    messages:{  //MENSAJES DE VALIDACION CONFORME A CADA VALIDACION ECHA
      apellido:{
      		required:"Porfavor ingrese su Apellido",
      		minlength:"Porfavor ingrese un apellido mayor a 3 carácteres"
      },
    },

    submitHandler:function(form){
		$(".fail-contraseña").fadeOut(500);
		$.ajax({
			data:{
				'btnsubmit': "",
				'solicitud': "m_apellido",
				'nombre': $("#texto2-nombre").text(),
				'apellido': $("#apellido").val(),
				'codigo': $("#id-persona").val()
			},
			url: 'proceso_usuario.php',
			type: 'post',
			success:function(censo){
				console.log(censo);
				switch (censo) {
					case "1":
						swal({
			        	  title: 'Configuración de Apellido, se realizo Exitosamente!',
			        	  icon: 'success',
			        	  closeOnClickOutside: false,
			        	  button: "Aceptar",
			        	});
						$(".swal-button--confirm").addClass('bg-success');
						$(".swal-button--confirm").addClass('m-auto');
						$(".swal-title").addClass('font-weight-normal');
						var nombre = $("#texto2-nombre").text();
						var texto = $("#apellido").val();
						$("#texto-apellido").text(texto);
						texto = nombre+" "+texto;
						$("#texto-nombre").text(texto);
						break;
				}
			}
		});
	},

    errorPlacement:function(error,element){ //Para reposicionar los elementos de error que son level
      error.insertAfter(element);
    }
});

  //FORMULARIO DE NUEVA DIRECCION
$("#f_direccion").validate({
    rules:{ //REGLAS DE VALIDACION PARA CADA INPUT
      direccion:{
        required: true,
        minlength: 10
      }
    },
    //////////////////////////////////////////////////////////////////////
    messages:{  //MENSAJES DE VALIDACION CONFORME A CADA VALIDACION ECHA
      direccion:{
			required:"Porfavor ingrese la dirección de Vivienda",
			minlength:"Porfavor ingrese minimo 10 caracteres de información"
		},
    },

    submitHandler:function(form){
		$(".fail-contraseña").fadeOut(500);
		$.ajax({
			data:{
				'btnsubmit': "",
				'solicitud': "m_direccion",
				'direccion': $("#direccion").val(),
				'codigo': $("#id-persona").val()
			},
			url: 'proceso_usuario.php',
			type: 'post',
			success:function(censo){
				console.log(censo);
				switch (censo) {
					case "1":
						swal({
			        	  title: 'Configuración de Dirección, se realizo Exitosamente!',
			        	  icon: 'success',
			        	  closeOnClickOutside: false,
			        	  button: "Aceptar",
			        	});
						$(".swal-button--confirm").addClass('bg-success');
						$(".swal-button--confirm").addClass('m-auto');
						$(".swal-title").addClass('font-weight-normal');
						var texto = $("#direccion").val();
						$("#texto-direccion").text(texto);
						break;
				}
			}
		});
	},

    errorPlacement:function(error,element){ //Para reposicionar los elementos de error que son level
      error.insertAfter(element);
    }
});

//FORMULARIO DE NUEVO MUNICIPIO
$("#f_ciudad").validate({

    submitHandler:function(form){
		$(".fail-contraseña").fadeOut(500);
		$.ajax({
			data:{
				'btnsubmit': "",
				'solicitud': "m_municipio",
				'ciudad': $("#ciudad").val(),
				'codigo': $("#id-persona").val()
			},
			url: 'proceso_usuario.php',
			type: 'post',
			success:function(censo){
				console.log(censo);
				switch (censo) {
					case "1":
						swal({
			        	  title: 'Configuración de Municipio, se realizo Exitosamente!',
			        	  icon: 'success',
			        	  closeOnClickOutside: false,
			        	  button: "Aceptar",
			        	});
						$(".swal-button--confirm").addClass('bg-success');
						$(".swal-button--confirm").addClass('m-auto');
						$(".swal-title").addClass('font-weight-normal');
						var texto = $("#ciudad").val();
						$("#texto-municipio").text(texto);
						break;
				}
			}
		});
	}
	
});