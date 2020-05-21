<h1> <?php echo $encuestado->nombre ?> (Nivel : <?php echo $encuestado->telefono; ?>) </h1>
<div> <?php echo nl2br($encuestado->email) ?> </div>
<br />
<div> <a class="btn btn-info" href="<?php echo base_url() ?>candidato"> Volver atrás </a> </div>