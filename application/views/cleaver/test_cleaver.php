<div class="container" style="text-align:center;background-color:#b5dffb;padding:30px;margin-top:25px;">
    <div class="alert alert-danger alert-save" role="alert" style="display:none"></div>
    <h4 style="font-weight:bold;">Encuesta de <?=$nombre?></h4><br><br>
    <div class="row" style="position:relative;width:510px;height:270px;margin:auto;margin-top:0px;">
        <div style="margin-top:24px;">
            <div class="reactivo"><?php echo $palabra1?></div>
            <div class="reactivo"><?php echo $palabra2?></div>
            <div class="reactivo"><?php echo $palabra3?></div>
            <div class="reactivo"><?php echo $palabra4?></div>
        </div>
        <div style="">
            <div style="font-weight:bold;text-align:center;"><i class="fas fa-plus"></i></div>
            <div data-level="1" data-side="left" class = "<?= ($mas1 != null && $mas1 == 1) ? 'cmas' : '' ?> checks mas"><input class="isHidden get-data lf-level-1" data-reactivo="<?php echo $idReactivo1 ?>" type="radio" name="radio1" value="1" <?= ($mas1 != null && $mas1 == 1) ? 'checked' : '' ?>/></div>
            <div data-level="2" data-side="left" class = "<?= ($mas2 != null && $mas2 == 1) ? 'cmas' : '' ?> checks mas"><input class="isHidden get-data lf-level-2" data-reactivo="<?php echo $idReactivo2 ?>" type="radio" name="radio1" value="1" <?= ($mas2 != null && $mas2 == 1) ? 'checked' : '' ?>/></div>
            <div data-level="3" data-side="left" class = "<?= ($mas3 != null && $mas3 == 1) ? 'cmas' : '' ?> checks mas"><input class="isHidden get-data lf-level-3" data-reactivo="<?php echo $idReactivo3 ?>" type="radio" name="radio1" value="1" <?= ($mas3 != null && $mas3 == 1) ? 'checked' : '' ?>/></div>
            <div data-level="4" data-side="left" class = "<?= ($mas4 != null && $mas4 == 1) ? 'cmas' : '' ?> checks mas"><input class="isHidden get-data lf-level-4" data-reactivo="<?php echo $idReactivo4 ?>" type="radio" name="radio1" value="1" <?= ($mas4 != null && $mas4 == 1) ? 'checked' : '' ?>/></div>
        </div>
        <div style="">
            <div style="font-weight:bold;text-align:center;"><i class="fas fa-minus"></i></div>
            <div data-level="1" data-side="right" class = "<?= ($menos1 != null && $menos1 == 1) ? 'cmenos' : '' ?> checks menos"><input class="isHidden rg-level-1" data-reactivo="<?php echo $idReactivo1 ?>" type="radio" name="radio2" value="0" <?= ($menos1 != null && $menos1 == 1) ? 'checked' : '' ?>/></div>
            <div data-level="2" data-side="right" class = "<?= ($menos2 != null && $menos2 == 1) ? 'cmenos' : '' ?> checks menos"><input class="isHidden rg-level-2" data-reactivo="<?php echo $idReactivo2 ?>" type="radio" name="radio2" value="0" <?= ($menos2 != null && $menos2 == 1) ? 'checked' : '' ?>/></div>
            <div data-level="3" data-side="right" class = "<?= ($menos3 != null && $menos3 == 1) ? 'cmenos' : '' ?> checks menos"><input class="isHidden rg-level-3" data-reactivo="<?php echo $idReactivo3 ?>" type="radio" name="radio2" value="0" <?= ($menos3 != null && $menos3 == 1) ? 'checked' : '' ?>/></div>
            <div data-level="4" data-side="right" class = "<?= ($menos4 != null && $menos4 == 1) ? 'cmenos' : '' ?> checks menos"><input class="isHidden rg-level-4" data-reactivo="<?php echo $idReactivo4 ?>" type="radio" name="radio2" value="0" <?= ($menos4 != null && $menos4 == 1) ? 'checked' : '' ?>/></div>
        </div>
    </div>
    <div class="row justify-content-center">
		<!-- <div class="col-2" style="text-align:center;">
            <?php if($menor != $pregunta):?>
                <button type="button" class="btn btn-primary" onclick="location.href='<?=base_url('cleaver/encuesta');?>/<?=$codigo?>?back=<?=($pregunta-1)?>'">Pregunta Anterior</button>
            <?php endif;?>
        </div> -->
        <div class="col-2" style="text-align:center;/* margin-left:50px; */">
            <button type="button" class="btn btn-primary" onclick="siguientePregunta()">Siguiente pregunta</button>
        </div>
    </div>
    <input type="hidden" id="codigo" value="<?php echo $codigo?>">
    <input type="text" id="pregunta" value="<?php echo $pregunta?>">
</div>
<script>
    $('.mas').click(function() {
        $('.cmas').removeClass('cmas');
        $(this).addClass('cmas').find('input').prop('checked', true)    
    });
    $('.menos').click(function() {
        $('.cmenos').removeClass('cmenos');
        $(this).addClass('cmenos').find('input').prop('checked', true)    
    });
    //escuchamos cambios los radios
    $(".checks").click(function(event){
        var level = $(this).data("level");
        var side  = $(this).data("side");
        var check_izquierda   = $(".lf-level-"+level).is(':checked'); 
        var check_derecha = $(".rg-level-"+level).is(':checked');
        if(check_derecha == true && check_izquierda == true){
            if(side == "right"){
                $(".lf-level-"+level).prop('checked', false);
                $('.cmas').removeClass('cmas');
            }else{
                $(".rg-level-"+level).prop('checked', false);
                $('.cmenos').removeClass('cmenos');
            }
        }
    })

    function siguientePregunta(){
        var datos = '';
        var datos_nulos = '';
        var respuestas = 0;
        var idReactivo = [];
        var idResponse = [];
        $('.get-data').each(
            function() {
                idReactivo.push($(this).data("reactivo"));
            }
        );
        $('.isHidden:checked').each(
            function() {
                respuestas ++;
                idResponse.push($(this).data("reactivo"));
                //console.log("El checkbox con valor " + $(this).val() + " check reactivo "+$(this).data("reactivo"));
                datos += '\"reactivo_'+respuestas+'\":\"'+$(this).data('reactivo')+'\",\"respuesta_'+respuestas+'\":\"' +$(this).val()+'\",' ;
            }
        );
        var diferente = _.difference(idReactivo, idResponse);
        for (let i = 0; i < diferente.length; i++) {
            datos_nulos += '\"nulo_'+i+'\":\"'+diferente[i]+'\",\"val_'+i+'\":\"00\",' ;            
        }
        if(respuestas == 2){
            enviarRespuesta(datos,datos_nulos);
        }else if(respuestas == 1){
            alert("Te hace falta seleccionar una palabra en una de las columnas")
        }else{
            alert("Necesitas seleccionar una palabra en cada columna")
        }
    }
    //ajax para enviar la respuesta
    function enviarRespuesta (datos,datos_nulos){
        var codigo = document.getElementById("codigo").value;
        var pregunta = document.getElementById("pregunta").value;
        var back = getParameterByName('back');
        var aux = datos+datos_nulos;
        aux = aux.slice(0, -1);
        aux = "{"+aux+"}";
        console.log(aux);
        $.ajax({
            // En data puedes utilizar un objeto JSON, un array o un query string
            //{'reactivo_1':'247','respuesta_1':'1','reactivo_2':'248','respuesta_2':'0'}
            //{"reactivo1":"11","res1":1,"reactivo2":"22","res2":2}
            data:JSON.parse(aux),
            //Cambiar a type: POST si necesario
            type: "POST",
            // URL a la que se enviará la solicitud Ajax
            url: "/testalia/cleaver/guardar_respuesta/"+codigo,
            dataType: 'json',
            success : function(xhr,response) { 
                $(".alert-save").css("display","none");
                console.log("actualizamos hora y seguimos corriendo script");
                console.log(response);
                console.log(xhr);
                //if(back == null){
                    window.location = "/testalia/cleaver/encuesta/"+codigo;
                /* }else{
                    back = (back*1)+1;
                    window.location = "/testalia/cleaver/encuesta/"+codigo+"?back="+back;
                } */
            },
            error : function(xhr, status, error) {
                //alert('400');
                $(".alert-save").text("Algo salió mal al guardar intente de nuevo!");
                $(".alert-save").css("display","block");
                console.log(error)
                console.log("No hay datos para mostrar")
            }
        })
    }
    function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}
</script>