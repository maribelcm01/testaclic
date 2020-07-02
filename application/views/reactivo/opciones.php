<div class="container">
    <div class="row justify-content-center mt40">
        <div class=" col-6">
            <h4> Opciones </h4>
            <form action="<?php echo base_url() ?>reactivo/guardar_postOpc/<?php echo $idEncuesta?>/<?php echo $idReactivo?>" method="post">
                <div class="form-group">
                    <input type="hidden" name="indiceA" value="<?php echo $indiceA?>">
                    <input type="hidden" name="idRespuestaA" value="<?php echo $idRespuestaA?>">
                    <input type="text" name="respuestaA" class="form-control" placeholder="Opción A" value="<?php echo $respuestaA?>" required>
                </div>
                <div class="form-group">
                    <input type="hidden" name="indiceB" value="<?php echo $indiceB?>">
                    <input type="hidden" name="idRespuestaB" value="<?php echo $idRespuestaB?>">
                    <input type="text" name="respuestaB" class="form-control" placeholder="Opción B" value="<?php echo $respuestaB?>" required>
                </div>
                <div class="form-group">
                    <input type="hidden" name="indiceC" value="<?php echo $indiceC?>">
                    <input type="hidden" name="idRespuestaC" value="<?php echo $idRespuestaC?>">
                    <input type="text" name="respuestaC" class="form-control" placeholder="Opción C" value="<?php echo $respuestaC?>" required>
                </div>
                <div class="form-group">
                    <input type="hidden" name="indiceD" value="<?php echo $indiceD?>">
                    <input type="hidden" name="idRespuestaD" value="<?php echo $idRespuestaD?>">
                    <input type="text" name="respuestaD" class="form-control" placeholder="Opción D" value="<?php echo $respuestaD?>" required>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary">Guardar</button>
                    <a class="btn btn-danger" href="<?php echo base_url()?>reactivo/index/<?php echo $idEncuesta?>"><i class="fas fa-times-circle"></i>Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>