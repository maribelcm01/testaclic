<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Serie <?=$serie?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5><b>Instrucciones: <?=$instruccion?></b></h5>
                <h5><?=$ejemplo?></h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Comenzar Serie <?=$serie?></button>
            </div>
        </div>
    </div>
</div>
<div class="container" style="text-align:center;background-color:#b5dffb;padding:30px;margin-top:25px;">
    <h4 style="padding-top:30px;"><b>Encuesta de <?=$nombre?></b></h4>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h4><b>Test de <?php echo $nombre?></b></h4><br>
            <h5><b><?php echo $reactivo?></b></h5>
        </div>
        <div class="col-md-5">
            <form action="<?=base_url('ipv/encuesta_post')?>/<?=$codigo?><?= isset($_GET['back']) ? '?back='.$_GET['back'].'' : '' ?>" method="post">
                <table class="table">
                    <tbody>
                        <?php foreach($datos as $item):?>
                        <tr>
                            <td>
                                <button type="submit" class="btn btn-warning" name="opcion" value="<?php echo $item->indice?>"><?php echo $item->indice?></button>
                            </td>
                            <td><b><?php echo $item->respuesta?></b></td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>
<script>
    document.title = "Terman merril";
    $( document ).ready(function() {
    $('#modelId').modal('toggle')
});
</script>