<div class="container" style="background-color:#b5dffb; padding:30px;margin-top:25px;">
    <div class="row" style="position:relative;width:510px;height:270px;margin:auto;margin-top:40px;">
        <div style="margin-top:16px;">
            <div class="reactivo"><?php echo $palabra1?></div>
            <div class="reactivo"><?php echo $palabra2?></div>
            <div class="reactivo"><?php echo $palabra3?></div>
            <div class="reactivo"><?php echo $palabra4?></div>
        </div>
        <div style="">
            <div style="font-weight:bold;text-align:center;"><i class="fas fa-plus"></i></div>
            <div class="mas"><input class="isHidden" type="radio" name="radio1" value="1"/></div>
            <div class="mas"><input class="isHidden" type="radio" name="radio1" value="1"/></div>
            <div class="mas"><input class="isHidden" type="radio" name="radio1" value="1"/></div>
            <div class="mas"><input class="isHidden" type="radio" name="radio1" value="1"/></div>
        </div>
        <div style="">
            <div style="font-weight:bold;text-align:center;"><i class="fas fa-minus"></i></div>
            <div class="menos"><input class="isHidden" type="radio" name="radio2" value="1"/></div>
            <div class="menos"><input class="isHidden" type="radio" name="radio2" value="1"/></div>
            <div class="menos"><input class="isHidden" type="radio" name="radio2" value="1"/></div>
            <div class="menos"><input class="isHidden" type="radio" name="radio2" value="1"/></div>
        </div>
    </div>
    <div style="text-align:center;margin-top:20px">
        <button type="button" class="btn btn-primary" onclick="siguientePregunta()">Siguiente pregunta</button>
    </div>
</div>

<!-- <p id="ejemplo">En este párrafo se mostrará la opción clickada por el usuario</p>
<button onclick="alerta()">Clicka para mostrar mensaje</button> -->

<script>
    $('.mas').click(function() {
        $('.cmas').removeClass('cmas');
        $(this).addClass('cmas').find('input').prop('checked', true)    
    });
    $('.menos').click(function() {
        $('.cmenos').removeClass('cmenos');
        $(this).addClass('cmenos').find('input').prop('checked', true)    
    });
    
    /* function alerta() {
        var mensaje;
        var opcion = confirm("Clicka en Aceptar o Cancelar");
        if (opcion == true) {mensaje = "Has clickado OK";}
        else {mensaje = "Has clickado Cancelar";}
        document.getElementById("ejemplo").innerHTML = mensaje;
    } */
</script>