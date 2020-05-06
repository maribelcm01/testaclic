<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>
<body>
	<div class="container">
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<a class="navbar-brand" href="<?=base_url('testalia') ?>"> Testalia</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav">
					<li class="nav-item active">
					    <a class="nav-link" href="<?=base_url('login') ?>">Iniciar Sesión <span class="sr-only">(current)</span></a>
					</li>
				</ul>
			</div>
		</nav>
	</div>

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

	<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    
</body>
</html>