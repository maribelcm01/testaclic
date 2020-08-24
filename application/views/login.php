<?= validation_errors() ?>
<div class="container">
	<div class="row m-4 justify-content-lg-center align-items-lg-center">
		<div class="col-lg-4 alogn-self-center">
			<h1>Login</h1>
			<form action="<?= base_url('login/validate')?>" method="POST" id="frm_login">
				<div class="form-group" id="usuario">
					<label for="exampleInputEmail1"><i class="fas fa-user"></i> Usuario</label>
					<input type="text" class="form-control" name="usuario" placeholder="Ingrese su Usuario">
					<div class="invalid-feedback">
						
					</div>
				</div>
				<div class="form-group" id="contrasena">
					<label id="exampleInputPassword1"><i class="fas fa-key"></i> Contraseña</label>
					<input type="password" class="form-control" name="contrasena" id="exampleInputPassword" placeholder="Ingrese su Contraseña">
					<div class="invalid-feedback">
						
					</div>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Ingresar <i class="fas fa-arrow-right"></i></button>
				</div>
				<div class="form-group" id="alert"></div>
			</form>	
		</div>
	</div>
</div>
<script> document.title = 'Login'; </script>