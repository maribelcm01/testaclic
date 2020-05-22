<div class="container">
    <div class="row justify-content-center mt40">
        <div class=" col-4">
            <h4> Guardar Registro </h4>
            <form method="post" action="<?php echo base_url() ?>reactivo/guardar_post/<?php echo $idEncuesta?>/<?php echo $idReactivo ?>">
                <div class="form-group">
                    <label>Encuesta</label>
                    <input class="form-control" type="text" disabled value="<?php echo $nombre?>"/>
                </div>
                <div class="form-group">
                    <label> Reactivo </label>
                    <input class="form-control" type="text" name="reactivo" required="required" value="<?php echo $reactivo?>"/>
                </div>
                <div class="form-group">
                    <label> Comentario </label>
                    <input class="form-control" type="text" name="comentario" value="<?php echo $comentario; ?>">
                </div>
                <div class="form-group">
                   <label> Índice </label>
                   <input class="form-control" type="text" name="indice" required="required" value="<?php echo $indice; ?>"/>
                </div>
                <div class="form-group">
                   <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar</button>
                   <a class="btn btn-danger" href="<?php echo base_url() ?>reactivo/index/<?php echo $idEncuesta?>"><i class="fas fa-times-circle"></i> Cancelar </a>
                </div>
            </form>
        </div>
    </div>
</div>