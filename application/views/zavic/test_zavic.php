<div class="container" style="text-align:center; background-color:#b5dffb; margin-top:40px; padding:30px;">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <h4><b>Test de <?= $nombre ?></b></h4>
            <h6>(Enlista, siendo <b>4 el más importante</b> al <b>1 el menos importante</b>.)</h6><br>
            <h5><b><?= $reactivo?>:</b></h5><br>
            <div>
                <input type="number" name="respuesta" value="<?= $RptaA;?>" pattern="[1-4]{1}" onchange="changeresponse(this);" class="col-sm-1 col-xs-1 input" required>
                <!-- <i class="fa fa-times check-ko"></i><i class="fa fa-check check-ok"></i> -->
                <label class="col-sm-6 col-xs-6"><b><?= $respuestaA?>.</b></label>
            </div><br>
            <div>
                <input type="number" name="respuesta" value="<?= $RptaB;?>" pattern="[1-4]{1}" onchange="changeresponse(this);" class="col-sm-1 col-xs-1 input" required>
                <label class="col-sm-6 col-xs-6"><b><?= $respuestaB?>.</b></label>
            </div><br>
            <div>
                <input type="number" name="respuesta" value="<?= $RptaC;?>" pattern="[1-4]{1}" onchange="changeresponse(this);" class="col-sm-1 col-xs-1 input" required>
                <label class="col-sm-6 col-xs-6"><b><?= $respuestaC?>.</b></label>
            </div><br>
            <div>
                <input type="number" name="respuesta" value="<?= $RptaD;?>" pattern="[1-4]{1}" onchange="changeresponse(this);" class="col-sm-1 col-xs-1 input" required>
                <label class="col-sm-6 col-xs-6"><b><?= $respuestaD?>.</b></label>
            </div><br>
            <div class="row justify-content-center">
                <div class="col-md-1" style="text-align:center;">
                    <?php if($menor != $pregunta):?>
                        <button type="button" class="btn btn-primary" onclick="location.href='<?=base_url('zavic/encuesta');?>/<?=$codigo?>?back=<?=($pregunta-1)?>'"><i class="fas fa-angle-double-left"></i></button>
                    <?php endif;?>
                </div>
                <div class="col-md-8">
                    <?php $style = round((($progreso-1) * 100) / $mayor)?>
                    <div class="progress" style="height:50px;">
                        <div class="progress-bar bg-dark progress-bar-striped" style="width:<?=$style?>%;"><?=$style?>%</div>
                    </div>
                </div>
                <div class="col-md-1" style="text-align:center;">
                    <button class="btn btn-primary" onclick="validar();"><i class="fas fa-angle-double-right"></i></button>
                </div>
            </div>
            <h4><b><?=$pregunta?> / <?=$mayor?></b></h4>
        </div>
    </div>
</div>
<script>
    document.title = 'Zavic';
    function validar(){
        var array_inputs_valores = [];
        var inputs_valores = document.getElementsByName("respuesta");
        inputs_valores.forEach(element => {
            array_inputs_valores.push(parseInt(element.value));
        });
        var opciones = [1,2,3,4];
        var diferente = _.difference(opciones,array_inputs_valores); //underscore ._
        if(diferente.length == 0){
            enviarRespuestas(array_inputs_valores);
        }else{
            alert("Revisa tus respuestas. \n * Recuerda llenar todos los campos. \n * No repetir los números.");
        }
    }
    function changeresponse (val){
        if(val.value < 1 || val.value > 4){
            alert("Respuesta no válida");
            val.value = '';
        }
    }
    function enviarRespuestas(array_inputs_valores){
        var codigo = '<?= $codigo ?>';
        var idReactivo = '<?= $idReactivo ?>';
        var idAplicacion = '<?= $idAplicacion ?>';
        var pregunta = '<?= $pregunta ?>';
        var urlparams = new URLSearchParams(window.location.search);
        var back = urlparams.get('back');
        var is_back = (back != null) ? 'true' : 'false';
        $.ajax({
            url: '<?=base_url()?>/zavic/guardar/'+codigo+"/"+is_back,
            type: 'POST',
            data: {
                    idReactivo: idReactivo,
                    idAplicacion: idAplicacion,
                    valores: array_inputs_valores
                },
            error: function() {
                alert('Something is wrong');
            },
            success: function(data) {
                console.log(pregunta);
                if(is_back == 'true'){
                    back = (back*1)+1;
                    if(back == pregunta){
                        window.location = "<?=base_url()?>/zavic/encuesta/"+codigo;
                    }else{
                        window.location = "<?=base_url()?>/zavic/encuesta/"+codigo+"?back="+back;
                    }
                }else{
                    window.location = "<?=base_url()?>/zavic/encuesta/"+codigo; 
                }
            }
        });
    }
</script>