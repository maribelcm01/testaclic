<div class="container">
    <div class="row m-4 justify-content-center">
        <div class="col-md-4">
            <h4> Guardar Registro </h4>
            <form method="post" action="<?= base_url() ?>encuestado/guardar_post/<?= $idEncuestado ?>">
                <div class="form-group">
                    <label> Nombre </label>
                    <input class="form-control" type="text" name="nombre" placeholder="Nombre y apellidos" value="<?= $nombre ?>" required/>
                </div>
                <div class="form-group">
                    <label> Teléfono </label>
                    <input class="form-control" type="tel" name="telefono" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" placeholder="0123456789" value="<?= $telefono; ?>" required/>
                </div>
                <div class="form-group">
                   <label> Correo </label>
                   <input class="form-control" type="email" name="email" placeholder="usuario@dominio.com"value="<?= $email; ?>" required/>
                </div>
                <div class="form-group">
                   <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar</button>
                   <a class="btn btn-danger" href="<?= base_url() ?>encuestado"><i class="fas fa-times-circle"></i> Cancelar </a>
                </div>
            </form>
        </div>
        
    </div>
</div>