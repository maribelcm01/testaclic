<div class="container">
    <div class="row justify-content-center mt40">
        <div class=" col-4">
            <h4> Guardar Registro </h4>
            <form method="post" action="<?php echo base_url() ?>aplicacion/guardar_post/<?php echo $idAplicacion ?>">
                <div class="form-group">
                    <label>Encuesta</label>
                    <select name="idEncuesta" id="input" class="form-control" required>
                    <option value="">--Seleccione una opción--</option>
                        <?php foreach($encuesta as $item): ?>
                            <option value="<?php echo $item->idEncuesta ?>" <?= ( $item->idEncuesta == $idEncuesta) ? 'selected' : '' ?>> <?php echo $item->nombre ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Encuestado</label>
                    <select name="idEncuestado" id="input" class="form-control" required>
                            <option value="">--Seleccione un nombre--</option>
                        <?php foreach($encuestado as $item): ?>
                            <option value="<?php echo $item->idEncuestado ?>" <?= ( $item->idEncuestado == $idEncuestado) ? 'selected' : '' ?>> <?php echo $item->nombre ?></option>
                        <?php endforeach; ?>
                    </select>
                </div> 
                <div class="form-group">
                   <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar</button>
                   <a class="btn btn-danger" href="<?php echo base_url() ?>aplicacion"><i class="fas fa-times-circle"></i> Cancelar </a>
                </div>
            </form>
        </div>
    </div>
</div>