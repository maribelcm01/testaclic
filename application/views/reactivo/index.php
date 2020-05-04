<div class="container">
	<div class="row justify-content-sm-center mt40">
		<div class="col-4">
            <h2>Lista de Reactivos</h2>
        </div>
        <div class="col-4">
			<a class="btn btn-success" href="<?php echo base_url() ?>reactivo/guardar"> Crear nuevo Registro </a>
		</div>
	</div>

	<div class="row justify-content-center">
		<div class="col-10">
			<?php if (count($reactivo)): ?>
			<table class="table table-bordered">
			    <thead>
				    <tr>
			    		<th> Encuesta </th>
			          	<th> Reactivo </th>
			          	<th> Comentario </th>
			          	<th> Índice </th>
			          	<td colspan="2">Action</td>
			       	</tr>
			    </thead>
		    	<tbody>
		       		<?php foreach($reactivo as $item): ?>
		          	<tr>
		             	<td> <?php echo $item->nombre ?> </td>
		             	<td> <?php echo $item->reactivo ?> </td>
		             	<td> <?php echo $item->comentario ?> </td>
		             	<td> <?php echo $item->indice; ?> </td>
		             	<td> 
		                	<!--<a class="btn btn-info" href="<?php echo base_url() ?>reactivo/ver/<?php echo $item->idReactivo ?>"> Ver </a>-->
		                	<a class="btn btn-primary" href="<?php echo base_url() ?>reactivo/guardar/<?php echo $item->idReactivo ?>"> Editar </a>
		                	<a class="btn btn-danger eliminar_alert" href="<?php echo base_url() ?>reactivo/eliminar/<?php echo $item->idReactivo ?>"> Eliminar </a> 
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