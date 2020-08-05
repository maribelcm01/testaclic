<div class="container">
    <div class="row m-4 justify-content-center">
        <div class=" col-md-6">
            <form action="<?php echo base_url() ?>reactivo/guardar_postOpc/<?php echo $idEncuesta?>/<?php echo $idReactivo?>" method="post">
                <div class="form-group">
                    <input type="text" name="indice" class="form-control" placeholder="Opción" value="<?php echo $indice?>" required>
                    <input type="text" name="respuesta" class="form-control" placeholder="Nueva Opción" value="<?php echo $respuesta?>" required>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary">Guardar</button>
                    <!-- <a class="btn btn-danger" href="<?php echo base_url()?>reactivo/index/<?php echo $idEncuesta?>"><i class="fas fa-times-circle"></i>Cancelar</a>
                 --></div>
            </form>
        </div>
    </div>
    <div class="row m-4 justify-content-center">
        <div class="col-md-6">
            <?php if (count($respuestas)): ?>
                <table id="example" class="table">
                    <thead>
                        <tr>
                            <th>Opción</th>
                            <th>Respuesta</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($respuestas as $item): ?>
                            <tr>
                                <td><?php echo $item->indice ?></td>
                                <td><?php echo $item->respuesta ?></td>
                                <td>
                                    <a class="btn btn-primary" href="<?php echo base_url() ?>reactivo/guardarOpc/<?php echo $idEncuesta?>/<?php echo $idReactivo?>/<?php echo $item->indice?>">
                                        <i class="fas fa-edit"></i>Editar
                                    </a>
							    </td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            <?php else: ?>
                No hay opciones en esta pregunta.
            <?php endif; ?>
        </div>
    </div>
</div>
<script>
    document.title = 'Opciones';
    $('#example').DataTable({
		"language": {
		"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
		}
	});
</script>