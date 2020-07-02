<div class="container" style="text-align:center; background-color:#b5dffb; margin-top:40px; padding:30px; size:720px;">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h4 style="font-weight:bold;">Test de <?php echo $nombre ?></h4><br>
            <h5 style="font-weight:bold;"><?php echo $reactivo?></h5><br>
            <div>
                <input type="text" name="respuesta" onchange="changeresponse(this);" class="col-sm-1 col-xs-1" required>
                <i class="fa fa-times check-ko"></i><i class="fa fa-check check-ok"></i>
                <label class="control-label col-sm-6 col-xs-6"><b><?php echo $respuestaA?></b></label>
            </div>
            <div>
                <input type="text" name="respuesta" onchange="changeresponse(this);" class="col-sm-1 col-xs-1" required>
                <i class="fa fa-times check-ko"></i><i class="fa fa-check check-ok"></i>
                <label class="control-label col-sm-6 col-xs-6"><b><?php echo $respuestaB?></b></label>
            </div>
            <div>
                <input type="text" name="respuesta" onchange="changeresponse(this);" class="col-sm-1 col-xs-1" required>
                <i class="fa fa-times check-ko"></i><i class="fa fa-check check-ok"></i>
                <label class="control-label col-sm-6 col-xs-6"><b><?php echo $respuestaC?></b></label>
            </div>
            <div>
                <input type="text" name="respuesta" onchange="changeresponse(this);" class="col-sm-1 col-xs-1" required>
                <i class="fa fa-times check-ko"></i><i class="fa fa-check check-ok"></i>
                <label class="control-label col-sm-6 col-xs-6"><b><?php echo $respuestaD?></b></label>
            </div><br><br>
            <div>
                <button class="btn btn-primary" onclick="validar();"><i class="fas fa-angle-double-right"></i></button>
            </div>
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
        var opciones = [1,2,3,4];;
        var diferente = _.difference(opciones,array_inputs_valores); //underscore ._
        if(diferente.length == 0){
            
        }else{
            alert("Revisa tus respuestas  " + diferente);
        }
    }

    function changeresponse (val){
        regexInput = /[1-4]{1}/;
        if(regexInput.test(val.value)){
            
        }else{
            val.value = '';
        }
    }
</script>