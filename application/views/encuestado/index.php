<div class="container">
	<div class="row m-4 justify-content-sm-center">
		<div class="col-md-4">
            <h2>Lista de Encuestados</h2>
        </div>
        <div class="col-md-2">
			<a class="btn btn-success" href="<?php echo base_url() ?>encuestado/guardar"><i class="fas fa-plus"></i> Registro </a>
		</div>
	</div>

	<div class="row justify-content-center">
		<div class="col-md-10">
			<?php if (count($encuestado)): ?>
			<table id="example" class="table table-bordered">
			    <thead>
				    <tr>
			    		<th> Nombre </th>
			          	<th> Telefono </th>
			          	<th> Correo </th>
			          	<th> Acción </th>
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
	$('#example').DataTable({
		"language": {
		"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
		}
	});
</script>