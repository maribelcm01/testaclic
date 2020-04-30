<div class="container">
	<div class="row mt40">
		<div class="col-md-10">
            <h2>Lista de Candidatos</h2>
        </div>
        <div class="col-md-2">
			<a class="btn btn-success" href="<?php echo base_url() ?>candidato/guardar"> Crear nuevo Candidato </a>
		</div>
		<?php if (count($candidato)): ?>
		<table class="table tableborder">
		    <thead>
			    <tr>
		    		<th> Nombre </th>
		          	<th> Telefono </th>
		          	<th> Correo </th>
		          	<td colspan="2">Action</td>
		       	</tr>
		    </thead>
	    	<tbody>
	       	<?php foreach($candidato as $item): ?>
	          	<tr>
	             	<td> <?php echo $item->nombre ?> </td>
	             	<td> <?php echo $item->telefono ?> </td>
	             	<td> <?php echo $item->email ?> </td>
	             	<td> 
	                	<!--<a class="btn btn-info" href="<?php echo base_url() ?>candidato/ver/<?php echo $item->idCandidato ?>"> Ver </a>-->
	                	<a class="btn btn-primary" href="<?php echo base_url() ?>candidato/guardar/<?php echo $item->idCandidato ?>"> Editar </a>
	                	<a class="btn btn-danger eliminar_alert" href="<?php echo base_url() ?>candidato/eliminar/<?php echo $item->idCandidato ?>"> Eliminar </a> 
	             	</td>
	          	</tr>
	       	<?php endforeach; ?>
	    	</tbody>
	 	</table>
	</div>
</div>	
		<?php else: ?>
	 	<p> No hay informes </p>
		<?php endif; ?>
		<script type="text/javascript">
	   		$(".eliminar_alert").each(function() {
	      		var href = $(this).attr('href');
	      		$(this).attr('href', 'javascript:void(0)');
	      		$(this).click(function() {
	        		if (confirm("¿Seguro desea eliminar este Candidato?")) {
	            		location.href = href;
	        		}
	      		});
	   		});	
		</script>