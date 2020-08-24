<div class="container">
    <div class="row m-4 justify-content-center">
        <div class="col-md-4">
            <h4> Guardar Registro </h4>
            <form method="post" action="<?= base_url() ?>aplicacion/guardar_post/<?= $idAplicacion ?>">
                <div class="form-group">
                    <label>Encuesta</label>
                    <select name="idEncuesta" id="input" class="form-control" required>
                    <option value="">--Seleccione una opción--</option>
                        <?php foreach($encuesta as $item): ?>
                            <option value="<?= $item->idEncuesta ?>" <?= ( $item->idEncuesta == $idEncuesta) ? 'selected' : '' ?>> <?= $item->nombre ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Encuestado</label>
                    <select name="idEncuestado" id="input" class="form-control" required>
                            <option value="">--Seleccione un nombre--</option>
                        <?php foreach($encuestado as $item): ?>
                            <option value="<?= $item->idEncuestado ?>" <?= ( $item->idEncuestado == $idEncuestado) ? 'selected' : '' ?>> <?= $item->nombre ?></option>
                        <?php endforeach; ?>
                    </select>
                </div> 
                <div class="form-group">
                   <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar</button>
                   <a class="btn btn-danger" href="<?= base_url() ?>aplicacion"><i class="fas fa-times-circle"></i> Cancelar </a>
                </div>
            </form>
        </div>
    </div>
</div>