<div class="container" style="text-align:center; background-color:#b5dffb; margin-top:40px; padding:30px; size:720px;">
    <h1><b>Hola <?php echo $nombre ?></b></h1><br>
    <h2><b>¡Te damos la bienvenida!</b></h2><br>
    <div class="row justify-content-center" style="text-align:justify;">
        <div class="col-md-8">
            <h5><b>Por favor, ten en cuenta lo siguiente:</b></h5>
            <ul>
                <li><h5><b>La prueba consta de veinticuatro preguntas. Para cada pregunta, se le mostrarán una serie de cuatro
                opciones, y su tarea consiste en elegir qué opción se aplica más a usted y cuál se aplica menos.</b></h5></li>
                <li><h5><b>Evita analizar conscientemente cada pregunta/respuesta, contesta lo primero que te venga a
                    la mente, porque lo rápido y espontáneo suele ser lo más sincero.</b></h5></li>
                <li><h5><b>No trates de reflejar tus ideales, contesta con base a tu realidad actual.</b></h5></li>
                <li><h5><b>Asegúrate de tener una conexión estable y disponer de aproximadamente 15 minutos sin que te interrumpan.</b></h5></li>
            </ul>
        </div>
    </div><br>
    <div>
        <form action="<?=base_url('cleaver/encuesta')?>/<?=$codigo?>" method="post">
            <button type="submit" name="submit" class="btn btn-dark"><h5><b>Comenzar</b></h5></button>
        </form>
    </div>
</div>
<script> document.title = 'Cleaver'; </script>