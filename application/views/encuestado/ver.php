<h1> <?= $encuestado->nombre ?> (Nivel : <?= $encuestado->telefono; ?>) </h1>
<div> <?= nl2br($encuestado->email) ?> </div>
<br />
<div> <a class="btn btn-info" href="<?= base_url() ?>candidato"> Volver atrás </a> </div>