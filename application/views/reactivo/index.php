<div class="container">
	<div class="row m-4 justify-content-sm-center">
		<div class="col-md-6">
            <h2>Reactivos de Encuesta <?= $nombre?></h2>
        </div>
        <div class="col-md-2">
			<a class="btn btn-success" href="<?= base_url() ?>reactivo/guardar/<?= $idEncuesta?>"><i class="fas fa-plus"></i> Registro </a>
		</div>
	</div>
	<div class="row justify-content-center">
		<div class="col-md-12">
			<?php if (count($reactivo)): ?>
			<table id="example" class="table table-bordered">
			    <thead>
				    <tr>
			          	<th> Índice </th>
			          	<th> Reactivo </th>
			          	<th> Comentario </th>
			          	<th>Acción</th>
			       	</tr>
			    </thead>
		    	<tbody>
		       		<?php foreach($reactivo as $item): ?>
		          	<tr>
		             	<td> <?= $item->indice; ?> </td>
		             	<td> <?= $item->reactivo ?> </td>
		             	<td> <?= $item->comentario ?> </td>
		             	<td>
							<?php if($item->nombre == "Zavic" || $item->nombre == "IPV" || $item->nombre == "Terman merril"): ?>
								<a class="btn btn-secondary" href="<?= base_url() ?>reactivo/guardarOpc/<?= $idEncuesta?>/<?= $item->idReactivo?>">Opciones</a>
							<?php endif; ?>
							<a class="btn btn-primary" href="<?= base_url() ?>reactivo/guardar/<?= $idEncuesta?>/<?= $item->idReactivo ?>"><i class="fas fa-edit"></i>Editar </a>
							<!-- <a class="btn btn-danger eliminar_alert" href="<?= base_url() ?>reactivo/eliminar/<?= $item->idReactivo ?>"><i class="fas fa-times-circle"></i>Borrar </a>  -->
							<!--<a class="btn btn-info" href="<?= base_url() ?>reactivo/ver/<?= $item->idReactivo ?>"> Ver </a>-->
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
<script>
	document.title = 'Reactivos';
	$('#example').DataTable({
		"language": {
		"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
		}
	});
</script>