<div class="container">
    <div class="row m-4 justify-content-center">
        <div class=" col-md-4">
            <h4> Guardar Registro </h4>
            <form method="post" action="<?= base_url() ?>reactivo/guardar_post/<?= $idEncuesta?>/<?= $idReactivo ?>">
                <div class="form-group">
                    <label>Encuesta</label>
                    <input class="form-control" type="text" disabled value="<?= $nombre?>"/>
                </div>
                <div class="form-group">
                    <label>Reactivo</label>
                    <input class="form-control" type="text" name="reactivo" value="<?= $reactivo?>" required/>
                </div>
                <div class="form-group">
                    <label>Comentario</label>
                    <input class="form-control" type="text" name="comentario" value="<?= $comentario; ?>">
                </div>
                <div class="form-group">
                   <label>Índice</label>
                   <input class="form-control" type="text" name="indice" value="<?= $indice; ?>" required/>
                </div>
                <div class="form-group">
                   <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar</button>
                   <a class="btn btn-danger" href="<?= base_url() ?>reactivo/index/<?= $idEncuesta?>"><i class="fas fa-times-circle"></i> Cancelar </a>
                </div>
            </form>
        </div>
    </div>
</div>