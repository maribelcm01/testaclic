<div class="container">
	<div class="row justify-content-sm-center mt40">
		<div class="col-6">
            <h2>Lista de Aplicación de Encuestas</h2>
        </div>
        <div class="col-3">
			<a class="btn btn-success" href="<?php echo base_url() ?>aplicacion/guardar"> Crear nuevo Registro </a>
		</div>
	</div>

	<div class="row justify-content-center">
		<div class="col-11">
		<?php if (count($aplicacion)): ?>
			<table class="table table-bordered">
			    <thead>
				    <tr>
						<th>Encuesta</th>
						<th>Encuestado</th>
						<th>Codigo</th>
						<th>Finalizado</th>
						<th>Creado</th>
						<th>Estado</th>
						<th>Final</th>
			          	<td colspan="2">Action</td>
			       	</tr>
			    </thead>
		    	<tbody>
		       	<?php foreach($aplicacion as $item): ?>
		          	<tr>
						<td> <?php echo $item->nomEncuesta ?> </td>
						<td> <?php echo $item->nomEncuestado ?> </td>
		             	<td> <?php echo $item->codigo ?> </td>
						<td> <?php echo $item->fechaConclusion ?> </td>
						<td> <?php echo $item->fechaCreacion ?> </td>
						<td> <?php echo $item->estado ?> </td>
						<td> <?php echo $item->pregunta ?> </td>
		             	<td> 
		                	<!--<a class="btn btn-info" href="<?php echo base_url() ?>aplicacion/ver/<?php echo $item->idAplicacion ?>"> Ver </a>-->
		                	<a class="btn btn-primary" href="<?php echo base_url() ?>aplicacion/guardar/<?php echo $item->idAplicacion ?>"> Editar </a>
		                	<a class="btn btn-danger eliminar_alert" href="<?php echo base_url() ?>aplicacion/eliminar/<?php echo $item->idAplicacion ?>"> Eliminar </a> 
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
		$(".eliminar_alert").each(function() {
	   		var href = $(this).attr('href');
	   		$(this).attr('href', 'javascript:void(0)');
	   		$(this).click(function() {
		   		if (confirm("¿Seguro desea eliminar este Registro?")) {
		       		location.href = href;
		   		}
			});
		});	
	</script>