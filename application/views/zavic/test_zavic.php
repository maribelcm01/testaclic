<div class="container" style="text-align:center; background-color:#b5dffb; margin-top:40px; padding:30px;">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h4 style="font-weight:bold;">Test de <?php echo $nombre ?></h4><br>
            <h5 style="font-weight:bold;"><?php echo $reactivo?></h5><br>
            <div>
                <input type="text" name="respuesta" value="<?php echo $RptaA;?>" onchange="changeresponse(this);" class="col-sm-1 col-xs-1" required>
                <i class="fa fa-times check-ko"></i><i class="fa fa-check check-ok"></i>
                <label class="control-label col-sm-6 col-xs-6"><b><?php echo $respuestaA?></b></label>
            </div>
            <div>
                <input type="text" name="respuesta" value="<?php echo $RptaB;?>" onchange="changeresponse(this);" class="col-sm-1 col-xs-1" required>
                <i class="fa fa-times check-ko"></i><i class="fa fa-check check-ok"></i>
                <label class="control-label col-sm-6 col-xs-6"><b><?php echo $respuestaB?></b></label>
            </div>
            <div>
                <input type="text" name="respuesta" value="<?php echo $RptaC;?>" onchange="changeresponse(this);" class="col-sm-1 col-xs-1" required>
                <i class="fa fa-times check-ko"></i><i class="fa fa-check check-ok"></i>
                <label class="control-label col-sm-6 col-xs-6"><b><?php echo $respuestaC?></b></label>
            </div>
            <div>
                <input type="text" name="respuesta" value="<?php echo $RptaD;?>" onchange="changeresponse(this);" class="col-sm-1 col-xs-1" required>
                <i class="fa fa-times check-ko"></i><i class="fa fa-check check-ok"></i>
                <label class="control-label col-sm-6 col-xs-6"><b><?php echo $respuestaD?></b></label>
            </div><br><br>
            <div class="row justify-content-center">
                <div class="col-2" style="text-align:center;">
                    <?php if($menor != $pregunta):?>
                        <button type="button" class="btn btn-primary" onclick="location.href='<?=base_url('zavic/encuesta');?>/<?=$codigo?>?back=<?=($pregunta-1)?>'"><i class="fas fa-angle-double-left"></i></button>
                    <?php endif;?>
                </div>
                <div class="col-2" style="text-align:center;">
                    <button class="btn btn-primary" onclick="validar();"><i class="fas fa-angle-double-right"></i></button>
                </div>
            </div>
            <input type="hidden" id="idAplicacion" value="<?php echo $idAplicacion?>">
            <input type="hidden" id="idReactivo" value="<?php echo $idReactivo?>">
            <input type="hidden" id="codigo" value=<?php echo $codigo?>>
            <input type="hidden" id="pregunta" value="<?php echo $pregunta?>"
        </div>
    </div>
</div>
<script>
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
            alert("Revisa tus respuestas. \nRecuerda llenar todos los campos. \nNo repetir los números.");
        }
    }
    function changeresponse (val){
        regexInput = /[1-4]{1}/;
        if(regexInput.test(val.value)){
            
        }else{
            val.value = '';
        }
    }
    function enviarRespuestas(array_inputs_valores){
        var codigo = $("input[id='codigo']").val();
        var idReactivo = $("input[id='idReactivo']").val();
        var idAplicacion = $("input[id='idAplicacion']").val();
        var pregunta = $("input[id='pregunta']").val();
        var urlparams = new URLSearchParams(window.location.search);
        var back = urlparams.get('back');
        var is_back = (back != null) ? 'true' : 'false';
        $.ajax({
            url: '/testalia/zavic/guardar/'+codigo+"/"+is_back,
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
                        window.location = "/testalia/zavic/encuesta/"+codigo;
                    }else{
                        window.location = "/testalia/zavic/encuesta/"+codigo+"?back="+back;
                    }
                }else{
                    window.location = "/testalia/zavic/encuesta/"+codigo; 
                }
            }
        });
    }
</script>