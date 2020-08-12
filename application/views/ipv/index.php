<div class="container" style="text-align:center; background-color:#b5dffb; margin-top:40px; padding:30px; size:720px;">
    <h2><b>Hola <?= $nombre ?></b></h2>
    <h3><b>¡Te damos la bienvenida!</b></h3><br>
    <div class="row justify-content-center" style="text-align:justify;">
        <div class="col-md-8">
            <h5><b>Se le pide que escoja una alternativa –y una sola– para cada pregunta, la que de manera espontánea le parezca preferible.</b></h5>
            <h5><b>En algunas cuestiones estará usted personalmente implicado; por ejemplo:<b></h5>
            <ul>
                <li><h5><b>Si usted pudiera elegir el tipo de vivienda de manera completamente libre. ¿Qué preferiría? <br>
                A.	Una casa en el campo con un gran jardín <br>
                B.	Un lujoso apartamento en una gran ciudad <br>
                C.	Una casa situada en una calle tranquila de una pequeña ciudad</b></h5></li>
            </ul>
            <h5><b>Otras de refieren a personas ajenas, como:</B></h5>
            <ul>
                <li><h5><b>J… está comprando en un gran almacén cuando advierte que alguien esconde discretamente un disco bajo su suéter. ¿Qué hará J…? <br>
                A.	Avisar del hecho al primer vendedor que encuentre <br>
                B.	No hacer nada porque piensa que no es cosa suya <br>
                C.	Indicar al infractor con el gesto o de palabra que ha visto lo que ha hecho</b></h5></li>
            </ul>
            <h5><b>En este caso, usted contestara lo que, según su propia opinión, es más probable que haga J… </b></h5>
            <h5><b>En realidad, no hay respuestas buenas ni malas; cada uno piensa y actúa como cree conveniente en función de su carácter, de sus intereses, etc.</b></h5>
        </div>
    </div><br>
    <div>
        <form action="<?=base_url('ipv/encuesta')?>/<?=$codigo?>" method="post">
                <button type="submit" name="submit" class="btn btn-dark"><h5><b>Comenzar</b></h5></button>
            </form>
    </div>
</div>
<script> document.title = 'IPV'; </script>