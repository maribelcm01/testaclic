<div class="container">
    <div class="row justify-content-center mt40">
        <div class=" col-4">
            <h4> Guardar Registro </h4>
            <form method="post" action="<?php echo base_url() ?>encuestado/guardar_post/<?php echo $idEncuestado ?>">
                <div class="form-group">
                    <label> Nombre </label>
                    <input class="form-control" type="text" name="nombre" required="required" value="<?php echo $nombre ?>" />
                </div>
                <div class="form-group">
                    <label> Teléfono </label>
                    <input class="form-control" type="text" name="telefono" required="required" value="<?php echo $telefono; ?>">
                </div>
                <div class="form-group">
                   <label> Correo </label>
                   <input class="form-control" type="email" name="email" required="required" value="<?php echo $email; ?>" />
                </div>
                <div class="form-group">
                   <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar</button>
                   <a class="btn btn-danger" href="<?php echo base_url() ?>encuestado"><i class="fas fa-times-circle"></i> Cancelar </a>
                </div>
            </form>
        </div>
        
    </div>
</div>