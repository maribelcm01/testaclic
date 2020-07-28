<div class="container" style="text-align:center; background-color:#b5dffb; margin-top:40px; padding:30px; size:720px;">
    <h2><b>Hola <?php echo $nombre ?></b></h2>
    <h3><b>¡Te damos la bienvenida!</b></h3><br>
    <div class="row justify-content-center" style="text-align:justify;">
        <div class="col-md-8">
            <h5><b>A continuación usted encontrará una serie de situaciones que le van a sugerir 4 respuestas. Lea cada una de ellas
            cuidadosamente y anote en el paréntesis que corresponda un número de la siguiente manera:</b></h5>
            <ul>
                <li><h5><b>El número 4 cuando la respuesta sea más importante.</b></h5></li>
                <li><h5><b>El número 3 cuando le sea importante pero no tanto como la anterior.</b></h5></li>
                <li><h5><b>El numero 2 cuando la prefiera menos que las anteriores.</b></h5></li>
                <li><h5><b>El número 1 cuando tenga menos importancia.</b></h5></li>
            </ul>
            <h5><b>No deben repetirse los números en una misma situación, siempre será 1,2,3 y 4 según sea su punto de vista. </b></h5>
        </div>
    </div><br>
    <div>
        <form action="<?=base_url('zavic/encuesta')?>/<?=$codigo?>" method="post">
                <button type="submit" name="submit" class="btn btn-dark"><h5><b>Comenzar</b></h5></button>
            </form>
    </div>
</div>
<script> document.title = 'Zavic'; </script>