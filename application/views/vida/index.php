<div class="container" style="text-align:center; background-color:#b5dffb; margin-top:20px; padding:30px;">
    <h2><b>Hola <?php echo $nombre ?></b></h2><br>
    <h3><b>¡Te damos la bienvenida!</b></h3><br>
    <div class="row justify-content-center" style="text-align:justify;">
        <div class="col-md-8">
            <h5><b>Por favor, ten en cuenta lo siguiente:</b><h5>
            <ul>
                <li><h5><b>Por cada reactivo, selecciona siempre la opción que más se aproxime a tu estilo de vida.</b></h5></li>
                <li><h5><b>Evita analizar conscientemente cada pregunta/respuesta, contesta lo primero que te venga a la mente, porque lo rápido y espontáneo suele ser lo más sincero.</b></h5></li>
                <li><h5><b>No trates de reflejar tus ideales, contesta con base a tu realidad actual.</b></h5></li>
                <li><h5><b>Asegúrate de tener una conexión estable y disponer de aproximadamente 25 minutos sin que te interrumpan.</b></h5></li>
            </ul>
        </div>
    </div><br>
    <div>
        <form action="<?=base_url('vida/encuesta')?>/<?=$codigo?>" method="post">
            <button type="submit" name="submit" class="btn btn-dark"><h5><b>Comenzar</b></h5></button>
        </form>
    </div>
</div>