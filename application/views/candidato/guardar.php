<h1> Guardar informe </h1>
<form method="post" action="<?php echo base_url() ?>candidato/guardar_post/<?php echo $idCandidato ?>">
    <div class="form-group">
       <label> Nombre </label>
       <input type="text" name="nombre" required="required" value="<?php echo $nombre ?>" />
    </div>
    <div class="form-group">
       <label> Teléfono </label>
       <input type="" name="telefono" required="required" value="<?php echo $telefono; ?>">
    </div>
    <div class="form-group">
       <label> Correo </label>
       <input type="email" name="email" required="required" value="<?php echo $email; ?>" />
    </div>
    <div class="form-group">
       <input type="submit" class="btn btn-success" value="Guardar" />
       <a class="btn btn-danger" href="<?php echo base_url() ?>candidato"> Cancelar </a>
    </div>
</form>