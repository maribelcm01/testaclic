<!DOCTYPE html>
<html>
<head>
	<title>inicio</title>
</head>
<body>
	<h1>Pagina principal de Testalia</h1>
	<ul>
		<?php foreach ($menu as $item): ?>
			<li><a href="<?= $item['url'] ?>"><?= $item['title'] ?></a></li>
	    <?php endforeach ?>
	</ul>
</body>
</html>