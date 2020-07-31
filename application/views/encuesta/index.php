<div class="container">
	<div class="row m-4 justify-content-sm-center">
		<div class="col-md-4">
            <h2>Lista de Encuestas</h2>
        </div>
        <div class="col-md-2">
			<a class="btn btn-success" href="<?php echo base_url() ?>encuesta/guardar"><i class="fas fa-plus"></i> Registro </a>
		</div>
	</div>

	<div class="row justify-content-center">
		<div class="col-md-6">
			<?php if (count($encuesta)): ?>
			<table id="example" class="table table-bordered">
			    <thead>
				    <tr>
			    		<th> Nombre </th>
			          	<th>Acción</th>
			       	</tr>
			    </thead>
		    	<tbody>
		       	<?php foreach($encuesta as $item): ?>
		          	<tr>
		             	<td> <?php echo $item->nombre ?> </td>
		             	<td> 
							<a class="btn btn-primary" href="<?php echo base_url() ?>encuesta/guardar/<?php echo $item->idEncuesta ?>"><i class="fas fa-edit"></i>Editar</a>
							<a class="btn btn-dark" href="<?php echo base_url() ?>reactivo/index/<?php echo $item->idEncuesta ?>">Reactivos</a>
							<a class="btn <?= ($item->estado == 1) ? 'btn-success' : 'btn-secondary' ?>" href="<?php echo base_url() ?>/encuesta/cambiarEstado/<?php echo $item->idEncuesta?>"><?= ($item->estado == 1) ? 'Activo' : 'Inactivo' ?></a>
							<!-- <a class="btn btn-danger eliminar_alert" href="<?php echo base_url() ?>encuesta/eliminar/<?php echo $item->idEncuesta ?>"><i class="fas fa-times-circle"></i>Borrar</a>  -->
							<!--<a class="btn btn-info" href="<?php echo base_url() ?>encuesta/ver/<?php echo $item->idEncuesta ?>"> Ver </a>-->
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
	document.title = 'Encuestas';
	$('#example').DataTable({
		"language": {
		"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
		}
	});
</script>