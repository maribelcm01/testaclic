<div class="container">
    <div class="row justify-content-center mt40">
        <div class=" col-4">
            <h4> Guardar Registro </h4>
            <form method="post" action="<?php echo base_url() ?>encuesta/guardar_post/<?php echo $idEncuesta ?>">
                <div class="form-group">
                   <label> Nombre </label>
                   <input class="form-control" type="text" name="nombre" placeholder="Nombre de la encuesta" value="<?php echo $nombre ?>" required/>
                </div>
                <div class="form-group">
                   <button type="submit" class="btn btn-success" value="Guardar"><i class="fas fa-save"></i> Guardar</button>
                   <a class="btn btn-danger" href="<?php echo base_url() ?>encuesta"><i class="fas fa-times-circle"></i> Cancelar </a>
                </div>
            </form>
        </div>
    </div>
</div>