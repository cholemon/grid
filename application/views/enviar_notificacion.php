<!DOCTYPE html>
<html>
<head>
	<title>Enviar Notificaciones</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/bootstrap/bootstrap.min.css">
	<style type="text/css">
		#proceso{
			width: 100%;
			height: auto;
			margin-top: 20px;
			text-align: center;
		}

		#boton{
			width: 100%;
		}

		#loading{
			width: 80px;
			height: 80px;
			display: none;
		}
	</style>
</head>
<body>

	<div id="proceso">
		<button type="button" class="btn btn-success" id="boton">PROCESAR NOTIFICACIONES</button>
		<img src="<?php echo base_url(); ?>images/loading.gif" id="loading">
	</div>
	
	<script src="<?php echo base_url(); ?>js/jquery.min.js"></script>
	<script>
		$(document).ready(function(){
			$("#boton").on("click", function(){
				$.ajax({
                    "url": "<?php echo base_url(); ?>index.php/notificacion/enviar",
                    "type":"GET",
                    success: function (data) {
                        if(data == "1"){
                        	alert("SE ENVIARON TODAS LAS NOTIFICACIONES.");
                        }

                        if(data == "2"){
                        	alert("AUN QUEDAN DISPOSITIVOS POR ENVIAR NOTIFICACION.");
                        }
                    }
                })
			});
		});
	</script>

</body>
</html>