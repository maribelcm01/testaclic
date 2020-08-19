<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1"  data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Serie <?= $serie?></h5>
            </div>
            <div class="modal-body">
                <h5><b>Instrucciones: <?= $instruccion?></b></h5>
                <h5><?=$ejemplo?></h5>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="crearCookieSerie();" class="btn btn-primary">Comenzar Serie</button>
            </div>
        </div>
    </div>
</div>
<div class="container" style="text-align:center;background-color:#b5dffb;padding:30px;margin-top:25px;">
    <h3><b>Encuesta de <?= $nombre?></b></h3>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h5><b id="finaliza_encuesta">La Serie <?= $serie?> finaliza en <label id="reloj_usuario"></label></b></h5>
        </div><br><br>
        <div class="col-md-8">
            <h4><b><?= $reactivo?></b></h4>
        </div>
        <div class="col-md-6 contenedor-cuestionario">
            <table class="table">
                <tbody>
                    <?php if($serie == 'I' || $serie == 'II' || $serie == 'VII' || $serie == 'IX'):?>
                        <?php foreach($datos as $item):?>
                            <tr>
                                <td>
                                    <div class="btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn-primary btn-lg">
                                            <input type="radio" name="opcion" value="<?= $item->indice?>" <?= ($respuesta != null && $respuesta == $item->indice) ? 'checked' : ''?>/>
                                            <a><?= $item->indice?></a>
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <h5><b><?= $item->respuesta?></b></h5>
                                </td>
                            </tr>
                        <?php endforeach;?>
                    <?php endif;?>
                    <?php if($serie == 'III' || $serie == 'VI' || $serie == 'VIII'):?>
                        <br>
                        <?php foreach($datos as $item):?>
                            <tr>
                                <td>
                                    <div class="btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn-primary btn-lg">
                                            <input type="radio" name="opcion" value="<?= $item['opc1']?>" <?= ($respuesta != null && $respuesta == $item['opc1']) ? 'checked' : ''?>>
                                            <a><?= $item['opc1']?></a> 
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn-primary btn-lg">
                                            <input type="radio" name="opcion" value="<?= $item['opc2']?>" <?= ($respuesta != null && $respuesta == $item['opc2']) ? 'checked' : ''?>>
                                            <a><?= $item['opc2']?></a> 
                                        </label>
                                    </div>
                                    <br>
                                </td>
                            </tr>
                        <?php endforeach;?>
                    <?php endif;?>
                    <?php if($serie == 'IV'):?>
                        <?php foreach($datos as $item):?>
                            <tr>
                                <td>
                                    <div class="btn-group" data-toggle="buttons">
                                        <label class="btn btn-primary">
                                            <a><?= $item->indice?></a>
                                            <input type="checkbox" name="opciones" value="<?= $item->indice?>" <?= (($respuesta != null && $respuesta[0] == $item->indice) || ($respuesta != null && $respuesta[4] == $item->indice)) ? 'checked' : ''?>/>
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <h5><b><?= $item->respuesta?></b></h5>
                                </td>
                            </tr>
                        <?php endforeach;?>
                    <?php endif;?>
                    <?php if($serie == 'V'):?>
                        <br>
                        <div class="row justify-content-center">
                            <div class="col-md-3">
                                <input type="number" min="0" class="form-control" name="respuesta" value="<?= $respuesta ?>">
                            </div>
                        </div>
                        <br>
                    <?php endif;?>
                    <?php if($serie == 'X'):?>
                        <br>
                        <div class="row justify-content-center">
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="campo1" value="<?= ($respuesta != null) ? $respuesta[0] : ''?>">
                            </div>
                            <i class="fas fa-minus"></i>
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="campo2" value="<?= ($respuesta != null) ? $respuesta[1] : ''?>">
                            </div>
                        </div>
                        <br>
                    <?php endif;?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-1" style="text-align:center;">
            <?php if($menor != $pregunta):?>
                <button type="button" class="btn btn-primary" onclick="location.href='<?= base_url('terman/encuesta');?>/<?=$codigo?>?back=<?=($pregunta-1)?>'"><i class="fas fa-angle-double-left"></i></button>
            <?php endif;?>
        </div>
        <div class="col-md-6">
            <?php $style = round((($progreso-1) * 100) / $limite)?>
            <div class="progress" style="height:50px;">
                <div class="progress-bar bg-dark progress-bar-striped" style="width:<?=$style?>%;"><?=$style?>%</div>
            </div>
        </div>
        <div class="col-md-1">
            <button class="btn btn-primary" onclick="insertar()"><i class="fas fa-angle-double-right"></i></button>                
        </div>
    </div>
    <h4><b><?= $pregunta?> / <?= $limite?></b></h4>
</div>
<script>
    document.title = "Terman merril";
    $( document ).ready(function() {
        console.log('showInstructions = '+<?= $showInstructions ?>+'\nacabo_tiempo = '+<?= $acabo_tiempo ?>);
        if(<?=$showInstructions ?> === 1  && <?= $acabo_tiempo ?> != 1){
            $('#modelId').modal({backdrop: 'static', keyboard: false});
            $("#modelId").modal('toggle');
            //contando = setInterval('reloj()',1000);
        }else { 
            contando = setInterval('reloj()',1000);
        }
    });

    function crearCookieSerie () {
        console.log("click");
        var d = new Date();
        var finSesion = d.setTime(d.getTime() + (<?= $duracion_en_segundos ?> * 1000)); // un minuto 
        var expires = "expires=" + d.toUTCString();
        document.cookie = "name=series;"+expires;
        console.log(<?= $duracion_en_segundos ?>);
        $.ajax({
            // cargamos url a nuestro contralador y método indicado
            url: "<?=base_url()?>/terman/crear_temporizador/<?= $codigo ?>",
            type: 'POST',
            dataType: 'json',
            data:{ 
                'finSesion' : finSesion
            },
            success:function(data){
                $("#modelId").modal("hide");
                contando = setInterval('reloj()',1000);  
            }
        })
    }

    function reloj() {
        $.ajax({
            // cargamos url a nuestro contralador y método indicado
            url: "<?=base_url()?>/terman/actualizar_contador/<?= $codigo ?>",
            type: 'POST',
            success:function(data){
                if(data){
                    var cronometro = JSON.parse(data);
                    $("#reloj_usuario").text(cronometro.i+':'+cronometro.s);
                    console.log(cronometro.i+':'+cronometro.s);
                    if(parseInt(cronometro.i) <= 0 && parseInt(cronometro.s) <= 0){
                        clearInterval(contando);
                        //limpiamos pantalla avisamos y procesamos la info para evaluar si
                        //existe una serie mas o es la ultima
                        $(".contenedor-cuestionario").empty();
                        $(".contenedor-cuestionario").html(
                            "<h2>No te preocupes estamos evaluando esta serie. En un momento continuamos.</h2>"
                        );
                        $.ajax({
                            //Codigo
                            //consultar num pregunta esta & num pregunta max
                            //actualizar siguiente serie o evaluar si es la ultima serie mandaral gracias 
                            url: '<?=base_url()?>/terman/fin_encuesta_por_cronometro/<?=$codigo ?>',
                            type: 'POST',
                            error: function() {
                                alert('Something is wrong');
                            },
                            success: function(data) {
                                console.log(data);
                                window.location = "<?=base_url()?>/terman/encuesta/<?=$codigo ?>";
                            }
                        });
                    }
                }
                else{
                    console.log("error")
                }
            }
        })
    };

    function insertar(){
        var serie = '<?= $serie ?>';
        var pregunta = '<?= $pregunta ?>';
        var idAplicacion = <?= $idAplicacion ?>;
        var idReactivo = <?= $idReactivo ?>;
        var codigo = '<?= $codigo ?>';
        var urlparams = new URLSearchParams(window.location.search);
        var back = urlparams.get('back');
        var is_back = (back != null) ? 'true' : 'false';
        var opcion;
        if(serie == 'I'||serie == 'II'||serie=='III'||serie == 'VI'||serie == 'VII'||serie == 'VIII'||serie == 'IX'){
            opcion = $('input[name=opcion]:checked').val();
        }
        if(serie == 'IV'){
            if($("input[name=opciones]:checked")) {  
                var arr = $('input[name=opciones]:checked').map(function(){
                    return this.value;
                }).get();
            }
            opcion = arr[0]+' - '+arr[1];
        }
        if(serie == 'V'){
            if ($('input[name=respuesta]').val().length > 0) {
                opcion = $('input[name=respuesta]').val();
            }
            //console.log(opcion);
        }if(serie == 'X'){
            if ($('input[name=campo1]').val().length > 0 && $('input[name=campo2]').val().length > 0) {
                c1 = $('input[name=campo1]').val();
                c2 = $('input[name=campo2]').val();
                opcion = c1+' - '+c2;
            }
            //console.log(opcion);
        }
        if(opcion == undefined){
            alert("No hay ninguna respuesta para insertar");
        }else{
            $.ajax({
                url: '<?=base_url()?>/terman/encuesta_post/'+codigo+"/"+is_back,
                type: 'POST',
                data: {
                        idReactivo: idReactivo,
                        idAplicacion: idAplicacion,
                        opcion: opcion
                    },
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {
                    if(is_back == 'true'){
                    back = (back*1)+1;
                    if(back == pregunta){
                        window.location = "<?=base_url()?>/terman/encuesta/"+codigo;
                    }else{
                        window.location = "<?=base_url()?>/terman/encuesta/"+codigo+"?back="+back;
                    }
                    }else{
                        window.location = "<?=base_url()?>/terman/encuesta/"+codigo; 
                    }
                }
            });
        }
    }
</script>