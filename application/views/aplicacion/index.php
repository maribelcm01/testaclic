<div class="container">
	<div class="row m-4 justify-content-sm-center">
		<div class="col-md-6">
            <h2>Lista de Aplicación de Encuestas</h2>
        </div>
        <div class="col-md-2">
			<a class="btn btn-success" href="<?= base_url() ?>aplicacion/guardar"><i class="fas fa-plus"></i> Registro </a>
		</div>
	</div>

	<div class="row justify-content-center">
		<div class="col-md-11">
			<?php if (count($aplicacion)): ?>
			<table id="example" class="table table-bordered">
			    <thead>
				    <tr>
						<th>Encuesta</th>
						<th>Encuestado</th>
						<th>Codigo</th>
						<th>Creado</th>
						<th>Estado</th>
						<th>Finalizado</th>
			          	<th>Acción</th>
			       	</tr>
			    </thead>
		    	<tbody>
		       		<?php foreach($aplicacion as $item): ?>
		          	<tr>
						<td> <?= $item->nomEncuesta ?> </td>
						<td> <?= $item->nomEncuestado ?> </td>
		             	<td> <?= $item->codigo ?> </td>
						<td> <?= $item->fechaCreacion ?> </td>
						<td> <?= $item->estado ?> </td>
						<td> <?= $item->fechaConclusion ?> </td>
		             	<td> 
							<a class="btn btn-primary" href="<?= base_url() ?>aplicacion/guardar/<?= $item->idAplicacion ?>"><i class="fas fa-edit"></i>Editar</a>
							<?php if($item->nomEncuesta == "Cleaver" && $item->estado == "Finalizado"):?>
								<a class="btn btn-success" href="<?= base_url() ?>cleaver/resultados/<?= $item->codigo ?>">Resultados</a>
				   			<?php endif;?>
							<?php if($item->nomEncuesta == "Zavic" && $item->estado == "Finalizado"):?>
								<a class="btn btn-success" href="<?= base_url() ?>zavic/resultados/<?= $item->codigo ?>">Resultados</a>
				   			<?php endif;?>
							<?php if($item->nomEncuesta == "IPV" && $item->estado == "Finalizado"):?>
								<a class="btn btn-success" href="<?= base_url() ?>ipv/resultados/<?= $item->codigo ?>">Resultados</a>
				   			<?php endif;?>
							<?php if($item->nomEncuesta == "Terman merril" && $item->estado == "Finalizado"):?>
								<a class="btn btn-success" href="<?= base_url() ?>terman/resultados/<?= $item->codigo ?>">Resultados</a>
				   			<?php endif;?>
							<!-- <a class="btn btn-danger eliminar_alert" href="<?= base_url() ?>aplicacion/eliminar/<?= $item->idAplicacion ?>"><i class="fas fa-times-circle"></i>Borrar</a>  -->
							<!--<a class="btn btn-info" href="<?= base_url() ?>aplicacion/ver/<?= $item->idAplicacion ?>"> Ver </a>-->
		             	</td>
		          	</tr>
		       		<?php endforeach; ?>
		    	</tbody>
		 	</table>
		 	<?php else: ?>
		 	<p> No hay Registros </p>
			<?php endif; ?>
		</div>
	</div>
</div>
<script type="text/javascript">
	document.title = 'Aplicaciones';
	$('#example').DataTable({
		"language": {
		"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
		}
	});
</script>