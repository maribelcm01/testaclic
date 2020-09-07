<div class="container">
	<div class="row m-4 justify-content-sm-center">
		<div class="col-md-4">
            <h2>Lista de Personas</h2>
        </div>
        <div class="col-md-2">
			<a class="btn btn-success" href="<?= base_url() ?>persona/guardar"><i class="fas fa-plus"></i> Registro </a>
		</div>
	</div>

	<div class="row justify-content-center">
		<div class="col-md-10">
			<?php if (count($persona)): ?>
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
		       		<?php foreach($persona as $item): ?>
		          	<tr>
		             	<td> <?= $item->nombre ?> </td>
		             	<td> <?= $item->telefono ?> </td>
		             	<td> <?= $item->email ?> </td>
		             	<td> 
							<a class="btn btn-primary" href="<?= base_url() ?>persona/guardar/<?= $item->idPersona ?>"><i class="fas fa-edit"></i>Editar </a>
							<!-- <a class="btn btn-danger eliminar_alert" href="<?= base_url() ?>persona/eliminar/<?= $item->idPersona ?>"><i class="fas fa-times-circle"></i>Borrar </a>  -->
							<!--<a class="btn btn-info" href="<?= base_url() ?>persona/ver/<?= $item->idPersona ?>"> Ver </a>-->
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
	document.title = 'Personas';
	$('#example').DataTable({
		"language": {
		"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
		}
	});
</script>