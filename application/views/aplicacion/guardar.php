<div class="container">
    <div class="row justify-content-center mt40">
        <div class=" col-4">
            <h4> Guardar Registro </h4>
            <form method="post" action="<?php echo base_url() ?>aplicacion/guardar_post/<?php echo $idAplicacion ?>">
                <div class="form-group">
                    <label>Encuesta</label>
                    <select name="idEncuesta" id="input" class="form-control" required="required">
                        <?php foreach($encuesta as $item): ?>
                            <option value="<?php echo $item->idEncuesta ?>"> <?php echo $item->nombre ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Encuestado</label>
                    <select name="idEncuestado" id="input" class="form-control" required="required">
                        <?php foreach($encuestado as $item): ?>
                            <option value="<?php echo $item->idEncuestado ?>"> <?php echo $item->nombre ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                   <input type="submit" class="btn btn-success" value="Guardar" />
                   <a class="btn btn-danger" href="<?php echo base_url() ?>aplicacion"> Cancelar </a>
                </div>
            </form>
        </div>
    </div>
</div>