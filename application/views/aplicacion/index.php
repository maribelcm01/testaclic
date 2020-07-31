<div class="container">
	<div class="row m-4 justify-content-sm-center">
		<div class="col-md-6">
            <h2>Lista de Aplicación de Encuestas</h2>
        </div>
        <div class="col-md-2">
			<a class="btn btn-success" href="<?php echo base_url() ?>aplicacion/guardar"><i class="fas fa-plus"></i> Registro </a>
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
						<td> <?php echo $item->nomEncuesta ?> </td>
						<td> <?php echo $item->nomEncuestado ?> </td>
		             	<td> <?php echo $item->codigo ?> </td>
						<td> <?php echo $item->fechaCreacion ?> </td>
						<td> <?php echo $item->estado ?> </td>
						<td> <?php echo $item->fechaConclusion ?> </td>
		             	<td> 
							<a class="btn btn-primary" href="<?php echo base_url() ?>aplicacion/guardar/<?php echo $item->idAplicacion ?>"><i class="fas fa-edit"></i>Editar</a>
							<?php if($item->nomEncuesta == "Cleaver" && $item->estado == "Finalizado"):?>
								<a class="btn btn-success" href="<?php echo base_url() ?>cleaver/resultados/<?php echo $item->codigo ?>">Resultados</a>
				   			<?php endif;?>
							<?php if($item->nomEncuesta == "Zavic" && $item->estado == "Finalizado"):?>
								<a class="btn btn-success" href="<?php echo base_url() ?>zavic/resultados/<?php echo $item->codigo ?>">Resultados</a>
				   			<?php endif;?>
							<?php if($item->nomEncuesta == "IPV" && $item->estado == "Finalizado"):?>
								<a class="btn btn-success" href="<?php echo base_url() ?>ipv/resultados/<?php echo $item->codigo ?>">Resultados</a>
				   			<?php endif;?>
							<!-- <a class="btn btn-danger eliminar_alert" href="<?php echo base_url() ?>aplicacion/eliminar/<?php echo $item->idAplicacion ?>"><i class="fas fa-times-circle"></i>Borrar</a>  -->
							<!--<a class="btn btn-info" href="<?php echo base_url() ?>aplicacion/ver/<?php echo $item->idAplicacion ?>"> Ver </a>-->
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