<div class="row justify-content-center mt-4">
    <div class="col-md-4">
        <br>
        <h4>Información:</h4>
        <h5>Nombre: <?= $persona->nombre ?></h5>
        <h5>Correo: <?= $persona->email ?></h5>
        <h5>Teléfono : <?= $persona->telefono; ?></h5>
        <br/>
        <a class="btn btn-info" href="<?= base_url('dashboard') ?>"> Volver atrás </a>
    </div>
</div>
