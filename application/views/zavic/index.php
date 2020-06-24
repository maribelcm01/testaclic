<div class="container" style="text-align:center; background-color:#b5dffb; margin-top:40px; padding:30px; size:720px;">
    <h1 style="font-weight:bold;">Hola <?php echo $nombre ?></h1>
    <h2 style="font-weight:bold;">¡Te damos la bienvenida!</h2>
    <div class="row justify-content-center" style="text-align:justify;">
        <div class="col-10">
            <p style="font-size:21px;font-weight:bold;">A continuación usted encontrará una serie de situaciones que le van a sugerir 4 respuestas. Lea cada una de ellas
            cuidadosamente y anote en el paréntesis que corresponda un número de la siguiente manera:<p>
            <ul style="font-size:21px;font-weight:bold;">
                <li>El número 4 cuando la respuesta sea más importante.</li>
                <li>El número 3 cuando le sea importante pero no tanto como la anterior.</li>
                <li>El numero 2 cuando la prefiera menos que las anteriores.</li>
                <li>El número 1 cuando tenga menos importancia.</li>
            </ul>
            <p style="font-size:21px;font-weight:bold;">No deben repetirse los números en una misma situación, siempre será 1,2,3 y 4 según sea su punto de vista. </p>
        </div>
            <form action="<?=base_url('zavic/encuesta')?>/<?=$codigo?>" method="post">
                <input type="submit" name="submit" value="Comenzar" class="btn btn-dark" style="font-weight:bold; font-size:21px; width:300px; margin:50px;">
            </form>
    </div>
</div>

<p>&nbsp;</p>