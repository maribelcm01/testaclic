<div class="container" style="background-color:#b5dffb; padding:30px;margin-top:25px;">
    <div class="row" style="position:relative;width:510px;height:270px;margin:auto;margin-top:40px;">
        <div style="margin-top:24px;">
            <div class="reactivo"><?php echo $palabra1?></div>
            <div class="reactivo"><?php echo $palabra2?></div>
            <div class="reactivo"><?php echo $palabra3?></div>
            <div class="reactivo"><?php echo $palabra4?></div>
        </div>
        <div style="">
            <div style="font-weight:bold;text-align:center;"><i class="fas fa-plus"></i></div>
            <div data-level="1" data-side="left" class="checks mas"><input class="isHidden lf-level-1" data-reactivo="<?php echo $idReactivo1 ?>" type="radio" name="radio1" value="1"/></div>
            <div data-level="2" data-side="left" class="checks mas"><input class="isHidden lf-level-2" data-reactivo="<?php echo $idReactivo2 ?>" type="radio" name="radio1" value="1"/></div>
            <div data-level="3" data-side="left" class="checks mas"><input class="isHidden lf-level-3" data-reactivo="<?php echo $idReactivo3 ?>" type="radio" name="radio1" value="1"/></div>
            <div data-level="4" data-side="left" class="checks mas"><input class="isHidden lf-level-4" data-reactivo="<?php echo $idReactivo4 ?>" type="radio" name="radio1" value="1"/></div>
        </div>
        <div style="">
            <div style="font-weight:bold;text-align:center;"><i class="fas fa-minus"></i></div>
            <div data-level="1" data-side="right" class="checks menos"><input class="isHidden rg-level-1" data-reactivo="<?php echo $idReactivo1 ?>" type="radio" name="radio2" value="0"/></div>
            <div data-level="2" data-side="right" class="checks menos"><input class="isHidden rg-level-2" data-reactivo="<?php echo $idReactivo2 ?>" type="radio" name="radio2" value="0"/></div>
            <div data-level="3" data-side="right" class="checks menos"><input class="isHidden rg-level-3" data-reactivo="<?php echo $idReactivo3 ?>" type="radio" name="radio2" value="0"/></div>
            <div data-level="4" data-side="right" class="checks menos"><input class="isHidden rg-level-4" data-reactivo="<?php echo $idReactivo4 ?>" type="radio" name="radio2" value="0"/></div>
        </div>
    </div>
    <div style="text-align:center;margin-top:10px">
        <button type="button" class="btn btn-primary" onclick="siguientePregunta()">Siguiente pregunta</button>
    </div>
    <input type="hidden" id="codigo" value="<?php echo $codigo?>">
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
        var respuestas = 0;
        $('.isHidden:checked').each(
            function() {
                respuestas ++;
                console.log("El checkbox con valor " + $(this).val() + " check reactivo "+$(this).data("reactivo"));
                datos += '\"reactivo_'+respuestas+'\":\"'+$(this).data('reactivo')+'\",\"respuesta_'+respuestas+'\":\"' +$(this).val()+'\",' ;
            }
        );

        if(respuestas == 2){
            enviarRespuesta(datos);
        }else if(respuestas == 1){
            alert("te hace falta dar una respuesta aqui")
        }else{
            alert("Necesitas responder esta encuestas")
        }
    }
    //ajax para enviar la respuesta
    function enviarRespuesta (datos){
        var codigo = document.getElementById("codigo").value;
        var a = parseInt(getParameterByName('a'));
        var b = parseInt(getParameterByName('b'));
        var aux = datos.slice(0, -1);
        aux = "{"+aux+"}";
        //console.log(aux);
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
                console.log("actualizamos hora y seguimos corriendo script");
                console.log(response);
                console.log(xhr);
                //redirect window.redirect
                a += 4;
                b += 4;
                window.location = "/testalia/cleaver/encuesta/"+codigo+"?a="+a+"&b="+b;
            },
            error : function(xhr, status, error) {
                //alert('400');
                console.log(error)
                console.log("No hay datos para mostrar")
            }
        })
    }

    function getParameterByName(name, url) {
        if (!url) url = window.location.href;
        name = name.replace(/[\[\]]/g, "\\$&");
        var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, " "));
    }
    
</script>