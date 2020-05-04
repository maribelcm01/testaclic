<h1> <?php echo $candidato->nombre ?> (Nivel : <?php echo $candidato->telefono; ?>) </h1>
<div> <?php echo nl2br($candidato->email) ?> </div>
<br />
<div> <a class="btn btn-info" href="<?php echo base_url() ?>candidato"> Volver atrás </a> </div>