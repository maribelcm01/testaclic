<div class="container">
    <div class="row m-4 justify-content-center">
        <div class=" col-md-4">
            <h4> Guardar Registro </h4>
            <form method="post" action="<?= base_url() ?>encuesta/guardar_post/<?= $idEncuesta ?>">
                <div class="form-group">
                   <label> Nombre </label>
                   <input class="form-control" type="text" name="nombre" placeholder="Nombre de la encuesta" value="<?= $nombre ?>" required/>
                </div>
                <div class="form-group">
                   <button type="submit" class="btn btn-success" value="Guardar"><i class="fas fa-save"></i> Guardar</button>
                   <a class="btn btn-danger" href="<?= base_url() ?>encuesta"><i class="fas fa-times-circle"></i> Cancelar </a>
                </div>
            </form>
        </div>
    </div>
</div>