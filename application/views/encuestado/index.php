<div class="container">
	<div class="row mt40">
		<div class="col-md-10">
            <h2>Lista de Encuestados</h2>
        </div>
        <div class="col-md-2">
			<a class="btn btn-success" href="<?php echo base_url() ?>encuestado/guardar"> Crear nuevo Registro </a>
		</div>
		<?php if (count($encuestado)): ?>
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
	       	<?php foreach($encuestado as $item): ?>
	          	<tr>
	             	<td> <?php echo $item->nombre ?> </td>
	             	<td> <?php echo $item->telefono ?> </td>
	             	<td> <?php echo $item->email ?> </td>
	             	<td> 
	                	<!--<a class="btn btn-info" href="<?php echo base_url() ?>encuestado/ver/<?php echo $item->idEncuestado ?>"> Ver </a>-->
	                	<a class="btn btn-primary" href="<?php echo base_url() ?>encuestado/guardar/<?php echo $item->idEncuestado ?>"> Editar </a>
	                	<a class="btn btn-danger eliminar_alert" href="<?php echo base_url() ?>encuestado/eliminar/<?php echo $item->idEncuestado ?>"> Eliminar </a> 
	             	</td>
	          	</tr>
	       	<?php endforeach; ?>
	    	</tbody>
	 	</table>
	</div>
</div>	
		<?php else: ?>
	 	<p> No hay Registro </p>
		<?php endif; ?>
		<script type="text/javascript">
	   		$(".eliminar_alert").each(function() {
	      		var href = $(this).attr('href');
	      		$(this).attr('href', 'javascript:void(0)');
	      		$(this).click(function() {
	        		if (confirm("¿Seguro desea eliminar este Encuestado?")) {
	            		location.href = href;
	        		}
	      		});
	   		});	
		</script>