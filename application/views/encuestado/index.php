<div class="container">
	<div class="row justify-content-sm-center mt40">
		<div class="col-4">
            <h2>Lista de Encuestados</h2>
        </div>
        <div class="col-2">
			<a class="btn btn-success" href="<?php echo base_url() ?>encuestado/guardar"><i class="fas fa-plus"></i> Registro </a>
		</div>
	</div>

	<div class="row justify-content-center">
		<div class="col-10">
			<?php if (count($encuestado)): ?>
			<table class="table table-bordered">
			    <thead>
				    <tr>
			    		<th> Nombre </th>
			          	<th> Telefono </th>
			          	<th> Correo </th>
			          	<td colspan="2">Action</td>
			       	</tr>
			    </thead>
		    	<tbody>
		       		<?php foreach($encuestado as $item): ?>
		          	<tr>
		             	<td> <?php echo $item->nombre ?> </td>
		             	<td> <?php echo $item->telefono ?> </td>
		             	<td> <?php echo $item->email ?> </td>
		             	<td> 
							<a class="btn btn-primary" href="<?php echo base_url() ?>encuestado/guardar/<?php echo $item->idEncuestado ?>"><i class="fas fa-edit"></i>Editar </a>
							<!-- <a class="btn btn-danger eliminar_alert" href="<?php echo base_url() ?>encuestado/eliminar/<?php echo $item->idEncuestado ?>"><i class="fas fa-times-circle"></i>Borrar </a>  -->
							<!--<a class="btn btn-info" href="<?php echo base_url() ?>encuestado/ver/<?php echo $item->idEncuestado ?>"> Ver </a>-->
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
	document.title = 'Encuestados';
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