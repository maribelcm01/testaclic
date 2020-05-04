<h1>Agregar Candidato</h1>


<?php echo form_open('vida/registrar_candidato_aplicacion'); ?>
    
    <div class="form-group">
       <input type="hidden" name="encuesta" class="form-control" id="name" value="<?php echo $encuesta ?>">
    </div>
    <?php if($encuesta): ?>
    <select name="candidato" id="input" class="form-control" required="required">
        
            <?php foreach($candidatos as $candidato): ?>
                <option value="<?php echo $candidato->idCandidato ?>"> <?php echo $candidato->nombre ?> - <?php echo $candidato->idCandidato ?></option>
            <?php endforeach; ?>
    
    </select>
    <div class="form-group pull-right mt-4">
       <button type="submit" id="register" class="btn btn-primary">
       <span class="fa fa-save" aria-hidden="true"></span>
        Registrar</button>
    </div>
    <?php else: ?>
        <h2>No hay candidatos disponibles para este aplicativo 
        <a type="button" href="<?=base_url('encuestado/guardar')?>" class="btn btn-sm btn-primary">Agregar nuevo candidato</a>
        </h2>
    <?php endif; ?>
    
    
  </div>
  <?php echo form_close(); ?>

