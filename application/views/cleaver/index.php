<div class="container" style="text-align:center; background-color:#b5dffb; margin-top:40px; padding:30px; size:720px;">
    <h1 style="font-weight:bold;">Hola <?php echo $nombre ?></h1>
    <h2 style="font-weight:bold;">¡Te damos la bienvenida!</h2>
    <div class="row justify-content-center" style="text-align:justify;">
        <div class="col-10">
            <p style="font-size:21px;font-weight:bold;">Por favor, ten en cuenta lo siguiente:<p>
            <ul style="font-size:21px;font-weight:bold;">
                <!-- <li>Las palabras descriptivas siguientes se encuentran agrupadas en series de cuatro,
                    seleccione y coloque una marca bajo la columna  <i class="fas fa-plus"></i> en la palabra
                    que en cada serie mejor lo describa solamente 1 palabra de las 4; después coloque una marca
                    bajo la columna <i class="fas fa-minus"></i> junto a la palabra que en cada serie considere
                    que menos lo describa.</li>
                <li>Asegúrese de marcar solamente una palabra bajo la columna <i class="fas fa-plus"></i> y
                    solamente una palabra bajo la columna <i class="fas fa-minus "></i> en cada serie.</li> -->
                <li>La prueba consta de veinticuatro preguntas. Para cada pregunta, se le mostrarán una serie de cuatro
                opciones, y su tarea consiste en elegir qué opción se aplica más a usted y cuál se aplica menos.</li>
                <li>Evita analizar conscientemente cada pregunta/respuesta, contesta lo primero que te venga a
                    la mente, porque lo rápido y espontáneo suele ser lo más sincero.</li>
                <li>No trates de reflejar tus ideales, contesta con base a tu realidad actual.</li>
                <li>Asegúrate de tener una conexión estable y disponer de aproximadamente 15 minutos sin que te interrumpan.</li>
            </ul>
        </div>
            <form action="<?=base_url('cleaver/encuesta')?>/<?=$codigo?>" method="post">
                <input type="submit" name="submit" value="Comenzar" class="btn btn-dark" style="font-weight:bold; font-size:21px; width:300px; margin:50px;">
            </form>
    </div>
</div>

<p>&nbsp;</p>