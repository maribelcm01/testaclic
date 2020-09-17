<div class="container">
	<div class="row justify-content-end">
		<div class="col-md-3" type="datetime" name="fecha"><h5>Fecha: <?= date("d/M/Y");?></h5></div>
	</div>
	<div class="row">
		<div class="col-md-4 bg-warning">
			<h4>Ultimas Aplicaciones</h4>
			<?php if (count($aplicacion)): ?>
			<table id="example" class="table table-bordered">
			    <thead>
				    <tr>
			    		<th> Nombre </th>
			          	<th> Encuesta </th>
			          	<th> Fecha </th>
			       	</tr>
			    </thead>
		    	<tbody>
		       		<?php foreach($aplicacion as $item): ?>
		          	<tr>
		             	<td> <?= $item['nombreP'] ?> </td>
		             	<td> <?= $item['nombreE'] ?> </td>
		             	<td> <?= $item['fechaConclusion'] ?> </td>
		             	
		          	</tr>
		       		<?php endforeach; ?>
		    	</tbody>
		 	</table>
		 	<?php else: ?>
		    No hay Registro 
		    <?php endif; ?>
		</div>
		<div class="col-md-4 bg-info">
			<h4>Personas Nuevas</h4>
			<?php if (count($aplicacion)): ?>
			<table id="example" class="table table-bordered">
			    <thead>
				    <tr>
			    		<th> Nombre </th>
			          	<th> Accion </th>
			       	</tr>
			    </thead>
		    	<tbody>
		       		<?php foreach($persona as $item): ?>
		          	<tr>
		             	<td> <?= $item['nombre'] ?> </td>
		             	<td> 
							<a class="btn btn-secondary" href="<?= base_url('persona/ver')?>/<?= $item['idPersona']?>">Info</a>
							<a class="btn btn-secondary" href="<?= base_url('aplicacion/index')?>/<?= $item['idPersona']?>">Aplicaciones</a>
						</td>
		          	</tr>
		       		<?php endforeach; ?>
		    	</tbody>
		 	</table>
		 	<?php else: ?>
		    No hay Registro 
		    <?php endif; ?>
		</div>
	</div>
</div>
<script>document.title = 'Inicio';</script>