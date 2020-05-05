<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<title>Login</title>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<div class="container">
			<div class="collapse navbar-collapse" id="navbarSupportedContent"> 
				<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
				   	<ul class="navbar-nav">
				    	<li class="nav-item">
				    		<a class="navbar-brand" href="<?=base_url('testalia') ?>"> Testalia </a>
				    	</li>
				    	<li class="nav-item">
				    		<a class="nav-link active" href="<?=base_url('login') ?>">Iniciar Sesión</a>
				    	</li>
				    </ul>
	  			</div>
	  		</div>
		</div>
	</nav>

	<?= validation_errors() ?>
	<div class="container">
		<div class="row justify-content-lg-center align-items-lg-center">
			<div class="col-lg-6 alogn-self-center">
				<h1>Login</h1>
				<form action="<?= base_url('login/validate')?>" method="POST" id="frm_login">
				  	<div class="form-group" id="usuario">
					    <label for="exampleInputEmail1">Usuario</label>
					    <input type="text" class="form-control" name="usuario" placeholder="Ingrese su Usuario">
					    <div class="invalid-feedback">
					    	
					    </div>
				  	</div>
				  	<div class="form-group" id="contrasena">
					    <label id="exampleInputPassword1">Contraseña</label>
					    <input type="password" class="form-control" name="contrasena" id="exampleInputPassword" placeholder="Ingrese su Contraseña">
					    <div class="invalid-feedback">
					    	
					    </div>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary">Ingresar</button>
					</div>
					<div class="form-group" id="alert">
						
					</div>
				</form>	
			</div>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="<?= base_url('application/assets/js/auth/login.js')?>"></script>
</body>
</html>