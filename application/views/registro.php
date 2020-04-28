<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<title>Registro</title>
</head>
<body>
	<h1>Registro</h1>
	<ul>
		<?php foreach ($menu as $item): ?>
			<li><a href="<?= $item['url'] ?>"><?= $item['title'] ?></a></li>
	    <?php endforeach ?>
	</ul>
	<?php echo validation_errors(); ?>
	<form action="<?= base_url('registro/create') ?>" method="POST">
		<div>
			
		</div>
		<div class="form-group">
		    <label>Nombre</label>
		    <input type="text" name="nombre" class="form-control" id="nombre">
	  	</div>
	  	<div class="form-group">
		    <label>Correo</label>
		    <input type="email" name="correo" class="form-control" id="correo">
	  	</div>
	  	<div class="form-group">
		    <label>Contraseña</label>
		    <input type="password" name="contrasena" class="form-control" id="contrasena">
		</div>
		<div class="form-group">
		    <label>Contraseña</label>
		    <input type="password" name="contrasena_confirm" class="form-control" id="contrasena_confirm">
		</div>
	  	<button type="submit" class="btn btn-primary">Enviar Datos</button>
	</form>

	 <?= isset($msg) ? $msg : '' ?>

</body>
</html>