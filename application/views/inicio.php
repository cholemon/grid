<!DOCTYPE html>
<html>
<head>
	<title><?php echo $titulo ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/bootstrap/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/jquery_ui.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/estilos.css">
</head>
<body>

<div class="back">
  <div class="div-center">
    <div class="content">
      <h3>DESARROLLADOR:</h3>
      <h4>- Levi A. Hurtado -</h4>
      <hr />
      <div class="text-center" id="div_loading">
      	<img src="<?php echo base_url(); ?>images/loading.gif" id="loading" class="img-thumbnail">
      </div>
      <form name="form1" id="data">
        <div class="form-group">
          <label>Nombre:</label>
          <input type="text" class="form-control" id="nombre">
        </div>
        <div class="form-group">
          <label>Rut:</label>
          <input type="text" class="form-control" name="rut" id="rut" placeholder="ej: 17355911-9">
        </div>
        <div class="form-group">
          <label>Edad:</label>
          <input type="text" class="form-control" id="edad" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
        </div>
        <div class="form-group" id="div_fecha">
          <label>Fecha de Cumpleaños:</label>
          <input type="text" class="form-control" id="fecha">
        </div>
        <div class="form-group">
    		<button type="button" id="procesar" class="btn btn-primary boton">Procesar</button>
        </div>
        <div class="form-group">
        	<button type="button" id="truncate" class="btn btn-danger boton">Eliminar data</button>
        </div>	
        <hr />
        <h4 id="total"></h4>

      </form>
    </div>
  </div>
</div>

<script src="<?php echo base_url(); ?>js/jquery.js"></script>
<script src="<?php echo base_url(); ?>js/jquery_ui.js"></script>
<script src="<?php echo base_url(); ?>js/funciones.js"></script>
<script>
	$(document).ready(function(){

		var total     = 0;

		var bandEdad  = false;
		var rutValido = false;

		(function(){
			$.get("<?php echo base_url(); ?>api/cantidad/",function(response) {
				total = response;
			    setCupos("total", total);
			});
		})();

		$('#edad').blur(function (){
		    let edad = $("#edad").val();
		    if(edad >= 30){
		    	bandEdad = true;
		    	$("#div_fecha").css("display","block");
			}else{
				bandEdad = false;
				$("#div_fecha").css("display","none");
			}
		});

		$('#rut').blur(function (){
		    if(Rut($("#rut").val())){
		    	$("#procesar").css("display","block");
		    }else{
		    	$("#procesar").css("display","none");
		    }
		});


		$("#procesar").on("click touchstart", function(e){
			e.preventDefault();
			
			let nombre = $("#nombre").val();
			let edad   = $("#edad").val();
			let fecha  = (bandEdad) ? $("#fecha").val() : "";
			let rut    = $("#rut").val();

			if(nombre == "" || edad == "" || rut == ""){
				alert("Todos los datos son requeridos.!");
			}else{
				if(bandEdad){
					if(fecha == ""){
						alert("Todos los datos son requeridos.!");
					}else{
						$("#div_loading").css("display","block");
						$.ajax({
							"url":  "<?php echo base_url(); ?>api/registro/",
							"type": "POST",
							"data": {'nombre':nombre, 'edad':edad, 'fecha':fecha, 'rut':rut},
				              'success':function(data){
				              	bandEdad = false;
				              	var resp = JSON.parse(data);

				              	if(resp.error){
				              		alert("Error en el proceso, intenta nuevamente.!");
				              	}else{
				              		total = resp.total;
				              		setCupos("total", total);
				              	}

				              	$('#data')[0].reset();
				              	$("#procesar").css("display","none");
				              	$("#div_fecha").css("display","none");
				              	$("#div_loading").css("display","none");
				              }
			            });
					}
				}else{
					$("#div_loading").css("display","block");
					$.ajax({
						"url":  "<?php echo base_url(); ?>api/registro/",
						"type": "POST",
						"data": {'nombre':nombre, 'edad':edad, 'fecha':fecha, 'rut':rut},
			              'success':function(data){
			              	bandEdad = false;
			              	var resp = JSON.parse(data);

			              	if(resp.error){
			              		alert("Error en el proceso, intenta nuevamente.!");
			              	}else{
			              		total = resp.total;
			              		setCupos("total", total);
			              	}

			              	$('#data')[0].reset();
			              	$("#procesar").css("display","none");
			              	$("#div_fecha").css("display","none");
			              	$("#div_loading").css("display","none");
			              }
		            });
				}
				
			}
		});


		$("#truncate").on("click touchstart", function(e){
			e.preventDefault();
			$.get("<?php echo base_url(); ?>api/truncate/",function(response) {
				if(response == 1){
					total = 0;
			    	setCupos("total", total);
			    	$('#data')[0].reset();
	              	$("#procesar").css("display","none");
	              	$("#div_fecha").css("display","none");
				}				
			});
		});

	});
</script>
</body>
</html>