<div class="container" style="text-align:center;background-color:#b5dffb;padding:30px;margin-top:25px;">
    <div class="alert alert-danger alert-save" role="alert" style="display:none"></div>
    <h4 style="padding-top:30px;"><b>Encuesta de <?=$nombre?></b></h4>
    <div class="row justify-content-center">
        <div class="col-md-6 table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="col-6"></th>
                        <th class="col-3" style="text-align:center;"><i class="fas fa-plus"></i></th>
                        <th class="col-3" style="text-align:center;"><i class="fas fa-minus"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white">
                        <td><h5><b><?php echo $palabra1?></b></h5></td>
                        <td>
                            <div data-level="1" data-side="left" class = "<?= ($mas1 != null && $mas1 == 1) ? 'cmas' : '' ?> checks mas">
                                <input class="isHidden get-data lf-level-1" data-reactivo="<?php echo $idReactivo1 ?>" type="radio" name="radio1" value="1" <?= ($mas1 != null && $mas1 == 1) ? 'checked' : '' ?>/>
                            </div>
                        </td>
                        <td>
                            <div data-level="1" data-side="right" class = "<?= ($menos1 != null && $menos1 == 1) ? 'cmenos' : '' ?> checks menos">
                                <input class="isHidden rg-level-1" data-reactivo="<?php echo $idReactivo1 ?>" type="radio" name="radio2" value="0" <?= ($menos1 != null && $menos1 == 1) ? 'checked' : '' ?>/>
                            </div>
                        </td>
                    </tr>
                    <tr class="bg-white">
                        <td><h5><b><?php echo $palabra2?></b></h5></td>
                        <td>
                            <div data-level="2" data-side="left" class = "<?= ($mas2 != null && $mas2 == 1) ? 'cmas' : '' ?> checks mas">
                                <input class="isHidden get-data lf-level-2" data-reactivo="<?php echo $idReactivo2 ?>" type="radio" name="radio1" value="1" <?= ($mas2 != null && $mas2 == 1) ? 'checked' : '' ?>/>
                            </div>
                        </td>
                        <td>
                            <div data-level="2" data-side="right" class = "<?= ($menos2 != null && $menos2 == 1) ? 'cmenos' : '' ?> checks menos">
                                <input class="isHidden rg-level-2" data-reactivo="<?php echo $idReactivo2 ?>" type="radio" name="radio2" value="0" <?= ($menos2 != null && $menos2 == 1) ? 'checked' : '' ?>/>
                            </div>
                        </td>
                    </tr>
                    <tr class="bg-white">
                        <td><h5><b><?php echo $palabra3?></b></h5></td>
                        <td>
                            <div data-level="3" data-side="left" class = "<?= ($mas3 != null && $mas3 == 1) ? 'cmas' : '' ?> checks mas">
                                <input class="isHidden get-data lf-level-3" data-reactivo="<?php echo $idReactivo3 ?>" type="radio" name="radio1" value="1" <?= ($mas3 != null && $mas3 == 1) ? 'checked' : '' ?>/>
                            </div>
                        </td>
                        <td>
                            <div data-level="3" data-side="right" class = "<?= ($menos3 != null && $menos3 == 1) ? 'cmenos' : '' ?> checks menos">
                                <input class="isHidden rg-level-3" data-reactivo="<?php echo $idReactivo3 ?>" type="radio" name="radio2" value="0" <?= ($menos3 != null && $menos3 == 1) ? 'checked' : '' ?>/>
                            </div>
                        </td>
                    </tr>
                    <tr class="bg-white">
                        <td><h5><b><?php echo $palabra4?></b></h5></td>
                        <td>
                            <div data-level="4" data-side="left" class = "<?= ($mas4 != null && $mas4 == 1) ? 'cmas' : '' ?> checks mas">
                                <input class="isHidden get-data lf-level-4" data-reactivo="<?php echo $idReactivo4 ?>" type="radio" name="radio1" value="1" <?= ($mas4 != null && $mas4 == 1) ? 'checked' : '' ?>/>
                            </div>
                        </td>
                        <td>
                            <div data-level="4" data-side="right" class = "<?= ($menos4 != null && $menos4 == 1) ? 'cmenos' : '' ?> checks menos">
                                <input class="isHidden rg-level-4" data-reactivo="<?php echo $idReactivo4 ?>" type="radio" name="radio2" value="0" <?= ($menos4 != null && $menos4 == 1) ? 'checked' : '' ?>/>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row justify-content-center">
		<div class="col-md-1" style="text-align:center;">
            <?php if($menor != $pregunta):?>
                <button type="button" class="btn btn-primary" onclick="location.href='<?=base_url('cleaver/encuesta');?>/<?=$codigo?>?back=<?=($pregunta-1)?>'"><i class="fas fa-angle-double-left"></i></button>
            <?php endif;?>
        </div>
        <div class="col-md-8">
			<?php $style = round((($progreso-1) * 100) / $mayor)?>
			<div class="progress" style="height:50px;">
				<div class="progress-bar bg-dark progress-bar-striped" style="width:<?=$style?>%;"><?=$style?>%</div>
			</div>
		</div>
        <div class="col-md-1" style="text-align:center;">
            <button type="button" class="btn btn-primary" onclick="siguientePregunta()"><i class="fas fa-angle-double-right"></i></button>
        </div>
    </div>
    <h4><b><?=$pregunta?> / <?=$mayor?></b></h4>
    <input type="hidden" id="codigo" value="<?php echo $codigo?>">
    <input type="hidden" id="pregunta" value="<?php echo $pregunta?>">
</div>
<script>
    document.title = 'Cleaver';
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
        var urlparams = new URLSearchParams(window.location.search);
        var back = urlparams.get('back');
        var aux = datos+datos_nulos;
        aux = aux.slice(0, -1);
        aux = "{"+aux+"}";
        //console.log(back);
        //debugger;
        var is_back = (back != null) ? 'true' : 'false';
        //console.log(is_back);
        $.ajax({
            // En data puedes utilizar un objeto JSON, un array o un query string
            data:JSON.parse(aux),
            //Cambiar a type: POST si necesario
            type: "POST",
            // URL a la que se enviará la solicitud Ajax
            url: "/testalia/cleaver/guardar_respuesta/"+codigo+"/"+is_back,
            dataType: 'json',
            success : function(data) { 
                $(".alert-save").css("display","none");
                console.log("actualizamos hora y seguimos corriendo script");
                //console.log(typeof(is_back));
                if(is_back == 'true'){
                    back = (back*1)+1;
                    if(back == pregunta){
                        window.location = "/testalia/cleaver/encuesta/"+codigo;
                    }else{
                        window.location = "/testalia/cleaver/encuesta/"+codigo+"?back="+back;
                    }
                }else{
                    window.location = "/testalia/cleaver/encuesta/"+codigo; 
                }
            },
            error : function(error) {
                //alert('400');
                $(".alert-save").text("Algo salió mal al guardar intente de nuevo!");
                $(".alert-save").css("display","block");
                console.log(error)
                console.log("No hay datos para mostrar")
            }
        })
    }
</script>