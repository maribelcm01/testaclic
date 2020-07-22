<div class="container">
	<div class="row justify-content-sm-center mt40">
		<div class="col-6">
            <h2>Reactivos de Encuesta <?php echo $nombre?></h2>
        </div>
        <div class="col-2">
			<a class="btn btn-success" href="<?php echo base_url() ?>reactivo/guardar/<?php echo $idEncuesta?>"><i class="fas fa-plus"></i> Registro </a>
		</div>
	</div>
	<div class="row justify-content-center">
		<div class="col-12">
			<?php if (count($reactivo)): ?>
			<table class="table table-bordered">
			    <thead>
				    <tr>
			    		<!-- <th> Encuesta </th> -->
			          	<th> Reactivo </th>
			          	<th> Comentario </th>
			          	<th> Índice </th>
			          	<td colspan="2">Action</td>
			       	</tr>
			    </thead>
		    	<tbody>
		       		<?php foreach($reactivo as $item): ?>
		          	<tr>
		             	<!-- <td> <?php echo $item->nombre ?> </td> -->
		             	<td> <?php echo $item->reactivo ?> </td>
		             	<td> <?php echo $item->comentario ?> </td>
		             	<td> <?php echo $item->indice; ?> </td>
		             	<td>
							<?php if($item->nombre == "Zavic"): ?>
								<a class="btn btn-secondary" href="<?php echo base_url() ?>reactivo/guardarOpc/<?php echo $idEncuesta?>/<?php echo $item->idReactivo?>">Opciones</a>
							<?php endif; ?>
							<?php if($item->nombre == "IPV"): ?>
								<a class="btn btn-secondary" href="<?php echo base_url() ?>reactivo/guardarOpc/<?php echo $idEncuesta?>/<?php echo $item->idReactivo?>">Opciones</a>
							<?php endif; ?>
							<a class="btn btn-primary" href="<?php echo base_url() ?>reactivo/guardar/<?php echo $idEncuesta?>/<?php echo $item->idReactivo ?>"><i class="fas fa-edit"></i>Editar </a>
							<!-- <a class="btn btn-danger eliminar_alert" href="<?php echo base_url() ?>reactivo/eliminar/<?php echo $item->idReactivo ?>"><i class="fas fa-times-circle"></i>Borrar </a>  -->
							<!--<a class="btn btn-info" href="<?php echo base_url() ?>reactivo/ver/<?php echo $item->idReactivo ?>"> Ver </a>-->
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