<div class="container" style="text-align:center; background-color:#b5dffb; margin-top:40px; padding:30px; size:720px;">
    <h1><b>Hola <?= $nombre ?></b></h1><br>
    <h2><b>¡Te damos la bienvenida!</b></h2><br>
    <div class="row justify-content-center" style="text-align:justify;">
        <div class="col-md-8">
            <h5><b>Por favor, ten en cuenta lo siguiente:</b></h5>
            <ul>
                <li><h5><b>La encuesta consta de 10 series. Una vez iniciada la serie debe concluirla, de lo 
                contrario podría afectar su calificación.</b></h5></li>
                <li><h5><b>Lee atentamente las instrucciones para cada serie. El tiempo empieza a correr después
                    de dar click a "Comenzar Serie".
                </b></h5></li>
                <li><h5><b>Evita analizar conscientemente cada pregunta/respuesta, contesta lo primero que te venga a
                    la mente, porque lo rápido y espontáneo suele ser lo más sincero.</b></h5></li>
                <li><h5><b>Asegúrate de tener una conexión estable y disponer de aproximadamente 27 minutos sin que te interrumpan.</b></h5></li>
            </ul>
        </div>
    </div>
    <div>
        <form action="<?=base_url('terman/encuesta')?>/<?=$codigo?>" method="post">
            <button type="submit" name="submit" class="btn btn-dark"><h5><b>Comenzar</b></h5></button>
        </form>
    </div>
</div>
<script> document.title = 'Terman merril'; </script>