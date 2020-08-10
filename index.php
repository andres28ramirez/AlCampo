<?php 
	include("header.php");
?>

	<style type="text/css">
		#contenido1{
			background-image: url('/AlCampo/Imagenes/dentro.jpg');
			background-repeat: no-repeat;
			background-size: cover; 
			background-attachment: fixed;
			height: 90vh;
			margin-top: 90px;
		}

		#img-confeti{
			position: absolute;
	    	width: 100%;
		}

		@media (min-width: 768px) {

		    /* show 3 items */
		    .carouselPrograms .carousel-inner .active,
		    .carouselPrograms .carousel-inner .active + .carousel-item,
		    .carouselPrograms .carousel-inner .active + .carousel-item + .carousel-item {
		        display: block;
		    }

		    .carouselPrograms .carousel-inner .carousel-item.active:not(.carousel-item-right):not(.carousel-item-left),
		    .carouselPrograms .carousel-inner .carousel-item.active:not(.carousel-item-right):not(.carousel-item-left) + .carousel-item,
		    .carouselPrograms .carousel-inner .carousel-item.active:not(.carousel-item-right):not(.carousel-item-left) + .carousel-item + .carousel-item {
		        transition: none;
		    }

		    .carouselPrograms .carousel-inner .carousel-item-next,
		    .carouselPrograms .carousel-inner .carousel-item-prev {
		        position: relative;
		        transform: translate3d(0, 0, 0);
		    }

		    .carouselPrograms .carousel-inner .active.carousel-item + .carousel-item + .carousel-item + .carousel-item {
		        position: absolute;
		        top: 0;
		        right: -33.333%;
		        z-index: -1;
		        display: block;
		        visibility: visible;
		    }

		    /* left or forward direction */
		    .carouselPrograms .active.carousel-item-left + .carousel-item-next.carousel-item-left,
		    .carouselPrograms .carousel-item-next.carousel-item-left + .carousel-item,
		    .carouselPrograms .carousel-item-next.carousel-item-left + .carousel-item + .carousel-item,
		    .carouselPrograms .carousel-item-next.carousel-item-left + .carousel-item + .carousel-item + .carousel-item {
		        position: relative;
		        transform: translate3d(-100%, 0, 0);
		        visibility: visible;
		    }

		    /* farthest right hidden item must be abso position for animations */
		    .carouselPrograms .carousel-inner .carousel-item-prev.carousel-item-right {
		        position: absolute;
		        top: 0;
		        left: 0%;
		        z-index: -1;
		        display: block;
		        visibility: visible;
		    }

		    /* right or prev direction */
		    .carouselPrograms .active.carousel-item-right + .carousel-item-prev.carousel-item-right,
		    .carouselPrograms .carousel-item-prev.carousel-item-right + .carousel-item,
		    .carouselPrograms .carousel-item-prev.carousel-item-right + .carousel-item + .carousel-item,
		    .carouselPrograms .carousel-item-prev.carousel-item-right + .carousel-item + .carousel-item + .carousel-item {
		        position: relative;
		        transform: translate3d(100%, 0, 0);
		        visibility: visible;
		        display: block;
		        visibility: visible;
		    }
		}

		.foto{
			cursor: pointer;
		}

		.borde{
			border: 4px solid #BF120F;
		}

		.sombreado{
			  background-color: rgba(0, 0, 0, 0.3);
			  position: absolute;
			  left: 0;
			  right: 0;
		      margin: 0 auto;
		      transition-delay: .1s;
		      transition: .5s ease;
		      border-radius: 3px;
		      letter-spacing: 2px;
		      width: 100%;
			  height: 100%;
		}
	</style>

<!-- CONTENEDOR DE LA INFORMACION INTERNA  -->
	<div class="container-fluid justify-content-center col-12 py-2" style="height: 100%; background-color: rgba(255,255,255,0.9)" id="main_c">
	    <div id="contenido1" class="row justify-content-center">
	    	<div id="img-confeti" class="col-12" style="height: 90vh">
	    		<img src="Imagenes/confeti2.png" class="" height="100%" width="100%" style="margin-top: 60px">
	    	</div>
	    	<div class="my-auto col-6 mr-auto" style="height: 90vh">
	    		<img src="Imagenes/mujer.png" class="" height="100%" width="100%" style="margin-top: 60px">	
	    	</div>
	    	<div class="col-6 m-auto">
	    		<div class="col-10 m-auto text-center" style="/*box-shadow: 0px 5px 100px -2px rgba(0,0,0,0.2); border: 1px solid rgba(255,255,255,0.2)*/">
	    			<!-- <h1 class="text-white text-center m-auto display-1 font-weight-bold" style="">ALGO</h1> -->
	    			<img src="Imagenes/foto-banner.jpg" class="img-fluid m-auto text-center" style="box-shadow: 0px 5px 100px -2px rgba(0,0,0,0.5);">
	    		</div>
	    	</div>
	    </div>

	    <div id="contenido2" class="row" style="padding-top: 60px; background-color: rgba(255,255,255,1);">
	    	<div class="col-11 m-auto pt-3" style="background-color: rgba(255,255,255,1); border-top: 2px solid rgba(0,0,0,0.2)">
	    		<h3 class="text-center m-auto text-muted" style="font-family: tahoma;">PRODUCTOS DESTACADOS</h3>
	    	</div>
		    <div class="container-fluid mt-4 col-12 m-auto" style="background-color: rgba(255,255,255,1);">
			    <div id="carouselExample" class="carouselPrograms carousel slide" data-ride="carousel" data-interval="false">
			        <div class="carousel-inner row w-100 mx-auto" role="listbox">
			            <div class="carousel-item col-md-4  active">
			               <div class="panel panel-default">
			                  <div class="panel-thumbnail text-center">
			                    <a href="#" title="image 1" class="thumb">
			                      <img class="img-fluid mx-auto d-block" src="Alimentos_img/tomate.jpg" alt="slide 1" style="height: 280px">
			                    </a>
			                    <p class="text-center text-white font-weight-bold bg-danger p-2 mx-5 mb-1">PROMOCIONES EN VERDURAS</p>
			                    <span class="text-center text-muted">VER TODO</span>
			                  </div>
			                </div>
			            </div>
			            <div class="carousel-item col-md-4 ">
			               <div class="panel panel-default">
			                  <div class="panel-thumbnail text-center">
			                    <a href="#" title="image 3" class="thumb">
			                     <img class="img-fluid mx-auto d-block" src="Alimentos_img/chuleta.jpg" alt="slide 2" style="height: 280px">
			                    </a>
			                    <p class="text-center text-white font-weight-bold bg-danger p-2 mx-5 mb-1">PROMOCIONES EN CARNES</p>
			                    <span class="text-center text-muted">VER TODO</span>
			                  </div>
			                </div>
			            </div>
			            <div class="carousel-item col-md-4 ">
			               <div class="panel panel-default">
			                  <div class="panel-thumbnail text-center">
			                    <a href="#" title="image 4" class="thumb">
			                     <img class="img-fluid mx-auto d-block" src="Alimentos_img/uvas.jpg" alt="slide 3" style="height: 280px">
			                    </a>
			                    <p class="text-center text-white font-weight-bold bg-danger p-2 mx-5 mb-1">PROMOCIONES EN FRUTAS</p>
			                    <span class="text-center text-muted">VER TODO</span>
			                  </div>
			                </div>
			            </div>
			            <div class="carousel-item col-md-4 ">
			                <div class="panel panel-default">
			                  <div class="panel-thumbnail text-center">
			                    <a href="#" title="image 5" class="thumb">
			                     <img class="img-fluid mx-auto d-block" src="Alimentos_img/soleraverde.jpg" alt="slide 4" style="height: 280px">
			                    </a>
			                    <p class="text-center text-white font-weight-bold bg-danger p-2 mx-5 mb-1">PROMOCIONES EN BEBIDAS</p>
			                    <span class="text-center text-muted">VER TODO</span>
			                  </div>
			                </div>
			            </div>
			            <div class="carousel-item col-md-4 ">
			              <div class="panel panel-default">
			                  <div class="panel-thumbnail text-center">
			                    <a href="#" title="image 6" class="thumb">
			                      <img class="img-fluid mx-auto d-block" src="Alimentos_img/molida.jpg" alt="slide 5" style="height: 280px">
			                    </a>
			                    <p class="text-center text-white font-weight-bold bg-danger p-2 mx-5 mb-1">PROMOCIONES EN CARNE ROJA</p>
			                    <span class="text-center text-muted">VER TODO</span>
			                  </div>
			                </div>
			            </div>
			            <div class="carousel-item col-md-4 ">
			               <div class="panel panel-default">
			                  <div class="panel-thumbnail text-center">
			                    <a href="#" title="image 7" class="thumb">
			                      <img class="img-fluid mx-auto d-block" src="Alimentos_img/oldpar.jpg" alt="slide 6" style="height: 280px">
			                    </a>
			                    <p class="text-center text-white font-weight-bold bg-danger p-2 mx-5 mb-1">PROMOCIONES EN WHISKEY</p>
			                    <span class="text-center text-muted">VER TODO</span>
			                  </div>
			                </div>
			            </div>
			            <div class="carousel-item col-md-4 ">
			               <div class="panel panel-default">
			                  <div class="panel-thumbnail text-center">
			                    <a href="#" title="image 8" class="thumb">
			                      <img class="img-fluid mx-auto d-block" src="Alimentos_img/panhamburguesa.jpg" alt="slide 7" style="height: 280px">
			                    </a>
			                    <p class="text-center text-white font-weight-bold bg-danger p-2 mx-5 mb-1">PROMOCIONES EN PANADERIA</p>
			                    <span class="text-center text-muted">VER TODO</span>
			                  </div>
			                </div>
			            </div>
			             <div class="carousel-item col-md-4  ">
			                <div class="panel panel-default">
			                  <div class="panel-thumbnail text-center">
			                    <a href="#" title="image 2" class="thumb">
			                     <img class="img-fluid mx-auto d-block" src="Alimentos_img/mozzarella.jpg" alt="slide 8" style="height: 280px">
			                    </a>
			                    <p class="text-center text-white font-weight-bold bg-danger p-2 mx-5 mb-1">PROMOCIONES EN QUESOS</p>
			                    <span class="text-center text-muted">VER TODO</span>
			                  </div>
			                </div>
			            </div>
			        </div>
			        <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
			            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
			            <span class="sr-only">Previous</span>
			        </a>
			        <a class="carousel-control-next text-faded" href="#carouselExample" role="button" data-slide="next">
			            <span class="carousel-control-next-icon" aria-hidden="true"></span>
			            <span class="sr-only">Next</span>
			        </a>
			    </div>
			</div>

		    <div class="text-center text-white col-12" style="; background-image: url('/AlCampo/Imagenes/pasto2.png'); background-size: contain; height: 12vh">
		    </div>
	    </div>

	    <div id="contenido3" class="row text-center text-white justify-content-center py-2" style="background-color: #BF120F; border-bottom: 1px solid rgba(0,0,0,0.5); border-top: 1px solid rgba(0,0,0,0.5)"> 
	      <h4 class="mt-3 col-lg-12">Visita Nuestras Redes Sociales</h4>
	          <div class="col-lg-2 col-md-4 col-6 py-3 mb-3">
	            <!--<img src="Imagenes/facebook.png" style="width: 100px; height: 100px;">--> 
	            <i class="icon icon-social-facebook" style="font-size: 80px;"></i><br>
	            <a href="#" class="text-white font-italic">AlCampo SuperMarket</a>
	          </div>
	          <div class="col-lg-2 col-md-4 col-6 py-3 mb-3">
	            <!--<img src="Imagenes/instagram.png" style="width: 100px; height: 100px;">--> 
	            <i class="icon icon-social-instagram" style="font-size: 80px"></i><br>
	            <a href="#" class="text-white font-italic">@AlCampoMarket</a>
	          </div>
	          <div class="col-lg-2 col-md-4 col-6 py-3 mb-3">
	            <!--<img src="Imagenes/twitter.png" style="width: 100px; height: 100px;">--> 
	            <i class="icon icon-social-twitter" style="font-size: 80px"></i><br>
	            <a href="#" class="text-white font-italic">@AlCampo_Porlamar</a>
	          </div>
	          <div class="col-lg-2 col-md-4 col-6 py-3 mb-3">
	            <!--<img src="Imagenes/youtube.png" style="width: 100px; height: 100px;">--> 
	            <i class="icon icon-social-youtube" style="font-size: 80px"></i><br>
	            <a href="#" class="text-white font-italic">Canal: Recetas AlCampo</a>
	          </div>
	          <div class="col-lg-2 col-md-4 col-6 py-3 mb-3">
	            <!--<img src="Imagenes/Pinterest.png" style="width: 100px; height: 100px;">--> 
	            <i class="icon icon-social-pinterest" style="font-size: 80px"></i><br>
	            <a href="#" class="text-white font-italic">pinterest.com/AlCampo</a>
	          </div>
	    </div>

	    <div id="contenido4" class="row px-2 py-5 justify-content-center" style="background-color: rgba(255,255,255,0.9);">
	    	<div class="col-11 m-auto row">
		    	<div class="col-6">
		    		<img src="Imagenes/ASDA 1.jpg" class="img img-fluid foto">
		    	</div>
		    	<div class="col-6 row justify-content-center">
		    		<div class="col-12 row justify-content-center p-0">
		    			<div class="col-6">
		    				<img src="Imagenes/ASDA 2.jpg" class="img img-fluid foto">
		    			</div>
		    			<div class="col-6">
		    				<img src="Imagenes/ASDA 3.jpg" class="img img-fluid foto">
		    			</div>
		    		</div>
		    		<div class="col-12">
		    			<img src="Imagenes/ASDA 4.jpg" class="img img-fluid foto">
		    		</div>
		    	</div>
	    	</div>
	    </div>

	    <div id="contenido5" class="row px-2 pb-4 justify-content-center" style="background-color: rgba(255,255,255,0.9);">
	    	<div class="col-11 mb-3" style="border-top: 2px solid rgba(0,0,0,0.2)"></div>
	    	<h3 class="text-danger mb-3 font-weight-light">Aprovecha estas Promociones para el mes de la Copa América</h3>
	    	<div class="col-11 row justify-content-center">
	    		<div class="col-4 copa" id="copa_1">
	    			<div class="col-12 p-0 row m-0 container-fluid">
	    				<img src="Imagenes/carulla 2.jpg" class="img-fluid border" style="box-shadow: 0px 5px 10px -2px rgba(0,0,0,0.2);">
	    				<button class="btn sombreado d-none" id="sombreadocopa_1" style="box-shadow: 0px 5px 10px -2px rgba(0,0,0,0.2);">
	    					<span class="text-white p-3" style="background-color: #BF120F; border: 1px solid rgba(249,249,249,0.3); font-family: courgette" onclick="busqueda(1)">COMPRAR</span>
	    				</button>
	    			</div>
	    		</div>
	    		<div class="col-4 copa" id="copa_2">
	    			<div class="col-12 p-0 row m-0 container-fluid">
	    				<img src="Imagenes/carulla 3.jpg" class="img-fluid border" style="box-shadow: 0px 5px 10px -2px rgba(0,0,0,0.2);">
	    				<button class="btn sombreado d-none" id="sombreadocopa_2" style="box-shadow: 0px 5px 10px -2px rgba(0,0,0,0.2);">
	    					<span class="text-white p-3" style="background-color: #BF120F; border: 1px solid rgba(249,249,249,0.3); font-family: courgette" onclick="busqueda(1)">COMPRAR</span>
	    				</button>
	    			</div>
	    		</div>
	    		<div class="col-4 copa" id="copa_3">
	    			<div class="col-12 p-0 row m-0 container-fluid">
	    				<img src="Imagenes/carulla 5.jpg" class="img-fluid border" style="box-shadow: 0px 5px 10px -2px rgba(0,0,0,0.2);">
	    				<button class="btn sombreado d-none" id="sombreadocopa_3" style="box-shadow: 0px 5px 10px -2px rgba(0,0,0,0.2);">
	    					<span class="text-white p-3" style="background-color: #BF120F; border: 1px solid rgba(249,249,249,0.3); font-family: courgette" onclick="busqueda(1)">COMPRAR</span>
	    				</button>
	    			</div>
	    		</div>
	    	</div>
	    	<div class="col-11 row justify-content-center py-4">
	    		<div class="col-4 copa" id="copa_4">
	    			<div class="col-12 p-0 row m-0 container-fluid">
	    				<img src="Imagenes/carulla 6.jpg" class="img-fluid border" style="box-shadow: 0px 5px 10px -2px rgba(0,0,0,0.2);">
	    				<button class="btn sombreado d-none" id="sombreadocopa_4" style="box-shadow: 0px 5px 10px -2px rgba(0,0,0,0.2);">
	    					<span class="text-white p-3" style="background-color: #BF120F; border: 1px solid rgba(249,249,249,0.3); font-family: courgette" onclick="busqueda(1)">COMPRAR</span>
	    				</button>
	    			</div>
	    		</div>
	    		<div class="col-4 copa" id="copa_5">
	    			<div class="col-12 p-0 row m-0 container-fluid">
	    				<img src="Imagenes/carulla 13.jpg" class="img-fluid border" style="box-shadow: 0px 5px 10px -2px rgba(0,0,0,0.2);">
	    				<button class="btn sombreado d-none" id="sombreadocopa_5" style="box-shadow: 0px 5px 10px -2px rgba(0,0,0,0.2);">
	    					<span class="text-white p-3" style="background-color: #BF120F; border: 1px solid rgba(249,249,249,0.3); font-family: courgette" onclick="busqueda(1)">COMPRAR</span>
	    				</button>
	    			</div>
	    		</div>
	    		<div class="col-4 copa" id="copa_6">
	    			<div class="col-12 p-0 row m-0 container-fluid">
	    				<img src="Imagenes/carulla 16.jpg" class="img-fluid border" style="box-shadow: 0px 5px 10px -2px rgba(0,0,0,0.2);">
	    				<button class="btn sombreado d-none" id="sombreadocopa_6" style="box-shadow: 0px 5px 10px -2px rgba(0,0,0,0.2);">
	    					<span class="text-white p-3" style="background-color: #BF120F; border: 1px solid rgba(249,249,249,0.3); font-family: courgette" onclick="busqueda(1)">COMPRAR</span>
	    				</button>
	    			</div>
	    		</div>
	    	</div>
	    	<div class="col-11 row justify-content-center">
	    		<div class="col-4 copa" id="copa_7">
	    			<div class="col-12 p-0 row m-0 container-fluid">
	    				<img src="Imagenes/carulla 14.jpg" class="img-fluid border" style="box-shadow: 0px 5px 10px -2px rgba(0,0,0,0.2);">
	    				<button class="btn sombreado d-none" id="sombreadocopa_7" style="box-shadow: 0px 5px 10px -2px rgba(0,0,0,0.2);">
	    					<span class="text-white p-3" style="background-color: #BF120F; border: 1px solid rgba(249,249,249,0.3); font-family: courgette" onclick="busqueda(1)">COMPRAR</span>
	    				</button>
	    			</div>
	    		</div>
	    		<div class="col-4 copa" id="copa_8">
	    			<div class="col-12 p-0 row m-0 container-fluid">
	    				<img src="Imagenes/carulla 15.jpg" class="img-fluid border" style="box-shadow: 0px 5px 10px -2px rgba(0,0,0,0.2);">
	    				<button class="btn sombreado d-none" id="sombreadocopa_8" style="box-shadow: 0px 5px 10px -2px rgba(0,0,0,0.2);">
	    					<span class="text-white p-3" style="background-color: #BF120F; border: 1px solid rgba(249,249,249,0.3); font-family: courgette" onclick="busqueda(1)">COMPRAR</span>
	    				</button>
	    			</div>
	    		</div>
	    		<div class="col-4 copa" id="copa_9">
	    			<div class="col-12 p-0 row m-0 container-fluid">
	    				<img src="Imagenes/carulla 17.jpg" class="img-fluid border" style="box-shadow: 0px 5px 10px -2px rgba(0,0,0,0.2);">
	    				<button class="btn sombreado d-none" id="sombreadocopa_9" style="box-shadow: 0px 5px 10px -2px rgba(0,0,0,0.2);">
	    					<span class="text-white p-3" style="background-color: #BF120F; border: 1px solid rgba(249,249,249,0.3); font-family: courgette" onclick="busqueda(1)">COMPRAR</span>
	    				</button>
	    			</div>
	    		</div>
	    		<!-- <div class="col-4 copa" id="copa_9">
	    			<div class="sombreado d-none" id="sombreadocopa_9"></div>
	    			<img src="Imagenes/carulla 17.jpg" class="img-fluid border" style="box-shadow: 0px 5px 10px -2px rgba(0,0,0,0.2);">
	    		</div> -->
	    	</div>
	    </div>

	    <div id="contenido6" class="row justify-content-center text-center" style="background-color: rgba(255,255,255,1);">
	      <h3 class="col-12 p-2 text-white" style="background-color: #BF120F; border-bottom: 1px solid rgba(0,0,0,0.5); border-top: 1px solid rgba(0,0,0,0.5)">Nosotros</h3>
	      <div class="col-md-5 col-12 m-auto text-justify">
	        <h4 align="left" class="font-weight-bold">Una marca orgullosa de ser Venezolana</h4>
	        <p>AlCampo SuperMarket es la cadena de retail y delivery más grande de Venezuela con capital 100% nacional. Somos reconocidos como una compañía lider en la comercialización de productos de consumo masivo de óptima calidad, a traves de toda la Isla de Margarita</p>
	        <p>Además de comercializar un amplio portafolio de productos marcas privadas y extranjeras, AlCampo SuperMarket cuenta con marcas propias disponibles en las categorías de supermercado, como Bodegon, Carnes Blancas y Rojas, Charcuteria, Panaderia, Frutas y Verduras.</p>
	      </div>
	      <div class="col-md-6 col-12 px-0">
	        <img src="Imagenes/abasto4.jpg" class="img-fluid" style="">
	      </div>
	    </div>

	    <div id="contenido7" class="row justify-content-center" style="background-color: rgba(255,255,255,1);">
	      <div class="col-lg-6 col-12 text-center px-0" id="imagen-contacto">
	        <img src="Imagenes/sm 2.jpg" class="img-fluid mx-0">
	      </div>
	      <div class="col-lg-6 col-12 m-auto" style="height: 400">
	      	<div class="text-center">
	      		<img src="Imagenes/alcampo A.png" class="img-fluid" height="15%" width="15%">
	      	</div>
	      	<h2 class="text-center text-muted">Información de Contacto</h2>
	        <p align="center">
	                Porlamar / Av.Bolivar / Centro Comercial CCM <br>
	                Local #80-12 Zona Exterior.
	        </p>
            <div class="col-md-6 col-8 float-left">
                <h5 class="mt-0 mb-2 text-center">Horario de Atención</h5>
                <p>
                  Mañana: 8:00<font size="2">am</font> a 12:00<font size="2">pm</font>
                </p>
                <p>
                  Tarde: 2:00<font size="2">pm</font> a 7:30<font size="2">pm</font>
                </p>
                <div class="text-center">
              	<i class="icon icon-clock text-center text-muted" style="font-size: 50px"></i>
              </div>
            </div>
            <div class="col-md-6 col-8 float-left">
              <h5 class="mt-0 mb-2 text-center">Números Teléfonicos</h5>
              <p>Teléfono fijo: +58 295 262-4012</p>
              <p>Número celular: +58 412-7942183</p>
              <div class="text-center">
              	<i class="icon icon-phone text-center text-muted" style="font-size: 50px"></i>
              </div>
            </div>
	      </div>
	    </div>
<!-- CONTENEDOR DE LA INFORMACION INTERNA -->

<?php  
	include ("footer.php");
?>

<script type="text/javascript">
	$('#carouselExample').on('slide.bs.carousel', function (e) {
	    var $e = $(e.relatedTarget);
	    var idx = $e.index();
	    var itemsPerSlide = 3;
	    var totalItems = $('.carousel-item').length;
	    
	    if (idx >= totalItems-(itemsPerSlide-1)) {
	        var it = itemsPerSlide - (totalItems - idx);
	        for (var i=0; i<it; i++) {
	            // append slides to end
	            if (e.direction=="left") {
	                $('.carousel-item').eq(i).appendTo('.carousel-inner');
	            }
	            else {
	                $('.carousel-item').eq(0).appendTo('.carousel-inner');
	            }
	        }
	    }
	});

    $('a.thumb').click(function(event){
      event.preventDefault();
      var content = $('.modal-body');
      content.empty();
        var title = $(this).attr("title");
        $('.modal-title').html(title);        
        content.html($(this).html());
        $(".modal-profile").modal({show:true});
    });

    $(".foto").hover(function() {
    	$(this).addClass('borde');
    }, function() {
    	$(this).removeClass('borde');
    });

    $(".copa").hover(function() {
    	var id = $(this).attr('id');
    	$("#sombreado"+id).removeClass('d-none');
    }, function() {
    	var id = $(this).attr('id');
    	$("#sombreado"+id).addClass('d-none');
    });

    function busqueda(valor){
    	alert(valor);
    }
</script>

<?php if(isset($_GET["mensaje"])): ?>
<script type="text/javascript">
	swal({
	  title: 'Sesión Finalizada',
	  text: 'Puedes seguir disfrutando de nuestros servicios',
	  icon: 'success',
	  closeOnClickOutside: false,
	  button: "Aceptar",
	});
	$(".swal-button--confirm").addClass('bg-success');
</script>
<?php endif; ?>