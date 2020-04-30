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
			</header>
			<section>
				<form id="" class="">
					<div class="">
						<table>
							<?php if($reactivo): ?>
                    		<?php foreach($reactivo as $reactivo): ?>
							<thead>
								<tr>
									<th><?=$reactivo->indice?>: <?php echo $reactivo->reactivo ?></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										
										<button class="btn btn-dark" type="submit">Casi Nunca</button>
										<button class="btn btn-warning" type="submit">Con Frecuencia</button>
										<button class="btn btn-dark" type="submit">Casi Siempre</button>
									</td>
								</tr>
							</tbody>
							<?php endforeach; ?>
							<?php endif ?>
						</table>						
					</div>
				</form><!-- /simform -->
			</section>			
		</div>
	</body>
</html>