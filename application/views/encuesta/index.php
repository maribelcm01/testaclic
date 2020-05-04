<div class="container">
	<div class="row justify-content-sm-center mt40">
		<div class="col-4">
            <h2>Lista de Encuestas</h2>
        </div>
        <div class="col-4">
			<a class="btn btn-success" href="<?php echo base_url() ?>encuesta/guardar"> Crear nuevo Registro </a>
		</div>
	</div>

	<div class="row justify-content-center">
		<div class="col-6">
		<?php if (count($encuesta)): ?>
			<table class="table table-bordered">
			    <thead>
				    <tr>
			    		<th> Nombre </th>
			          	<td colspan="2">Action</td>
			       	</tr>
			    </thead>
		    	<tbody>
		       	<?php foreach($encuesta as $item): ?>
		          	<tr>
		             	<td> <?php echo $item->nombre ?> </td>
		             	<td> 
		                	<!--<a class="btn btn-info" href="<?php echo base_url() ?>candidato/ver/<?php echo $item->idCandidato ?>"> Ver </a>-->
		                	<a class="btn btn-primary" href="<?php echo base_url() ?>encuesta/guardar/<?php echo $item->idEncuesta ?>"> Editar </a>
		                	<a class="btn btn-danger eliminar_alert" href="<?php echo base_url() ?>encuesta/eliminar/<?php echo $item->idEncuesta ?>"> Eliminar </a> 
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