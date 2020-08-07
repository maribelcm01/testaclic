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
                <button type="button" onclick="crearCookieSerie();" class="btn btn-primary">Comenzar Serie <?=$serie?></button>
                
            </div>
        </div>
    </div>
</div>
<div class="container" style="text-align:center;background-color:#b5dffb;padding:30px;margin-top:25px;">
    <h4 style="padding-top:30px;"><b>Encuesta de <?=$nombre?></b></h4>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h4><b>Test de <?php echo $nombre?></b></h4><br>
            <h5><b id="finaliza_encuesta"><?= $fecha_fin_sesion?></b></h5>

        </div>
        <div class="col-md-8">
            <h5><b><?php echo $reactivo?></b></h5>
        </div>
        <div class="col-md-6 contenedor-cuestionario">
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
        h = 0;
        m = 0;
        s = 0;
        limite = 0;
        console.log( <?= $showInstructions ?>);
        if(<?=$showInstructions ?> === 1  && <?= $acabo_tiempo ?> != 1){
            $('#modelId').modal('toggle');
            contando = setInterval('reloj()',1000);
        }else {
             contando = setInterval('reloj()',1000);
        }
    });

    function crearCookieSerie () {
        console.log("click");
        var d = new Date();
        var finSesion = d.setTime(d.getTime() + (<?=$duracion_en_segundos ?> * 1000)); // un minuto 
        var expires = "expires=" + d.toUTCString();
        document.cookie = "name=series;"+expires;
        console.log(<?=$duracion_en_segundos ?>);
        
        $.ajax({
            // cargamos url a nuestro contralador y método indicado
            url: "/testalia/terman/crear_temporizador/<?=$codigo ?>",
            type:"post",
            dataType: 'json',
            data:{ 
                'finSesion' : finSesion,
                'duracion_en_segundos' : "<?=$duracion_en_segundos ?>"
            },
            success:function(data){
                
                    console.log(data);
                    $("#modelId").modal("hide");
                    contando = setInterval('reloj()',1000);
                
            }
        })
        
    }

    function reloj() {
        $.ajax({
            // cargamos url a nuestro contralador y método indicado
            url: "/testalia/terman/actualizar_contador/<?=$codigo ?>",
            type:"post",
            success:function(data){
                if(data){
                    console.log(data);
                    if(parseInt(data) <= 0){
                        //setInterval(reloj()');
                        clearInterval(contando);
                        //limpiamos pantalla avisamos y procesamos la info para evaluar si
                        //existe una serie mas o es la ultima
                        $(".contenedor-cuestionario").empty();
                        $(".contenedor-cuestionario").html(
                            "<h2>No te preocupes estamos evaluando esta serie. En un momento continuamos.</h2>"
                        );
                    }
                }
                else{
                    console.log("error")
                }
            }
        })

    }
</script>