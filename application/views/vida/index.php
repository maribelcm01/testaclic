<div class="container" style="text-align:center; background-color:#b5dffb; margin-top:20px; padding:30px; size:720px;">
    <h1 style="font-weight:bold;">Hola <?php echo $nombre ?></h1><br>
    <h2 style="font-weight:bold;">¡Te damos la bienvenida!</h2><br>
    <div class="row justify-content-center" style="text-align:justify;">
        <div class="col-10">
            <p style="font-size:25px;font-weight:bold;">Por favor, ten en cuenta lo siguiente:<p>
            <ul style="font-size:25px;font-weight:bold;">
                <li>Por cada reactivo, selecciona siempre la opción que más se aproxime a tu estilo de vida.</li>
                <li>Evita analizar conscientemente cada pregunta/respuesta, contesta lo primero que te venga a la mente, porque lo rápido y espontáneo suele ser lo más sincero.</li>
                <li>No trates de reflejar tus ideales, contesta con base a tu realidad actual.</li>
                <li>Asegúrate de tener una conexión estable y disponer de aproximadamente 25 minutos sin que te interrumpan.</li>
            </ul>
        </div>
            <form action="<?=base_url('vida/encuesta')?>/<?=$codigo?>" method="post">
                <input type="submit" name="submit" value="Comenzar" class="btn btn-dark" style="font-weight:bold; font-size:21px; width:300px; margin:50px;">
            </form>
    </div>
</div>

<p>&nbsp;</p>







</div>