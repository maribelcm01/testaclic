<!DOCTYPE html>
<html>
	<head>
		<title>Cuestionario Vida</title>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<script src="js/modernizr.custom.js"></script>
	</head>
	<body>
		<div class="container">
			<header class="codrops-header">
				<h1>Testalia</h1>	
				<h3>Cuestionario Vida</h3>
				<p>Bienvenido: </p>
				<p>Selecciona la opción que más te identifique</p><br><br>
			</header>
			<section>
				<form action="<?=base_url("vida/insertarAplicacionDetalle");?>" method="post" id="" class="">
					<div class="container col-sm-6 center-block">
							
                    			<div class="form-group content">
                    				<h3><?php echo $reactivo ?></h3>
                    			</div>
                    			<input class="form-control" type="" name="idAplicacion" value="<?php echo $idAplicacion ?>" style='display: none'>
                    			<input class="form-control" type="" name="idReactivo" value="<?php echo $idReactivo?>" style='display: none'>
                    			<button class="btn btn-dark" type="submit" name='valor' value='0'>Casi Nunca</button>
								<button class="btn btn-warning" type="submit" name='valor' value='1'>Con Frecuencia</button>
								<button class="btn btn-dark" type="submit" name='valor' value='2'>Casi Siempre</button>
							
							
					</div>
				</form>
			</section>			
		</div>
	</body>
</html>