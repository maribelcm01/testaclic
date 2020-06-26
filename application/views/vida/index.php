<div class="container" style="text-align:center; background-color:#b5dffb; margin-top:20px; padding:30px;">
    <h2 style="font-weight:bold;">Hola <?php echo $nombre ?></h2>
    <h3 style="font-weight:bold;">¡Te damos la bienvenida!</h3>
    <div class="row justify-content-center" style="text-align:justify;">
        <div class="col-md-8">
            <h5 style="font-weight:bold;">Por favor, ten en cuenta lo siguiente:<h5>
            <ul>
                <li><h5 style="font-weight:bold;">Por cada reactivo, selecciona siempre la opción que más se aproxime a tu estilo de vida.</h5></li>
                <li><h5 style="font-weight:bold;">Evita analizar conscientemente cada pregunta/respuesta, contesta lo primero que te venga a la mente, porque lo rápido y espontáneo suele ser lo más sincero.</h5></li>
                <li><h5 style="font-weight:bold;">No trates de reflejar tus ideales, contesta con base a tu realidad actual.</h5></li>
                <li><h5 style="font-weight:bold;">Asegúrate de tener una conexión estable y disponer de aproximadamente 25 minutos sin que te interrumpan.</h5></li>
            </ul>
        </div>
    </div>
    <div>
        <form action="<?=base_url('vida/encuesta')?>/<?=$codigo?>" method="post">
            <input type="submit" name="submit" value="Comenzar" class="btn btn-dark" style="font-weight:bold; font-size:21px;">
        </form>
    </div>
</div>