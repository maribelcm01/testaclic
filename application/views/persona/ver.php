<h1> <?= $persona->nombre ?> (Nivel : <?= $persona->telefono; ?>) </h1>
<div> <?= nl2br($persona->email) ?> </div>
<br />
<div> <a class="btn btn-info" href="<?= base_url() ?>candidato"> Volver atrás </a> </div>