<!DOCTYPE html>
<html>
<head>
	<title>inicio</title>
</head>
<body>
	<h1>Pagina principal de Testalia</h1>
	<?php
	if($dat = $this->session->flashdata('msg')): ?>
		<p><?=$dat ?></p>
	<?php endif; ?>

	<a href="<?=base_url('login/logout')?>">Cerrar Sesión</a>
</body>
</html>