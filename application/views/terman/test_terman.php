<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Serie <?=$serie?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5><b>Instrucciones: <?=$instruccion?></b></h5>
                <h5><?=$ejemplo?></h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Comenzar Serie <?=$serie?></button>
            </div>
        </div>
    </div>
</div>
<div class="container" style="text-align:center;background-color:#b5dffb;padding:30px;margin-top:25px;">
    <h4 style="padding-top:30px;"><b>Encuesta de <?=$nombre?></b></h4>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h4><b>Test de <?php echo $nombre?></b></h4><br>
            <h5><b><?php echo $reactivo?></b></h5>
        </div>
        <div class="col-md-5">
            <table class="table">
                <tbody>
                    <?php if($serie == 'I' || $serie == 'II' || $serie == 'VII' || $serie == 'IX'):?>
                        <?php foreach($datos as $item):?>
                        <tr>
                            <td>
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-primary">
                                        <input type="radio" name="opcion" value="<?php echo $item->indice?>" required/>
                                        <a><?php echo $item->indice?></a>
                                    </label>
                                </div>
                            </td>
                            <td><b><?php echo $item->respuesta?></b></td>
                        </tr>
                        <?php endforeach;?>
                    <?php endif;?>
                    <?php if($serie == 'III' || $serie == 'VI' || $serie == 'VIII'):?>
                        <?php foreach($datos as $item):?>
                            <div class="btn-group" data-toggle="buttons">
                                <tr>
                                    <td>
                                        <label class="btn btn-primary btn-lg">
                                            <input type="radio" name="opcion" value="<?php echo $item['opc1']?>">
                                            <a><?php echo $item['opc1']?></a> 
                                        </label>
                                    </td>
                                    <td>
                                        <label class="btn btn-primary btn-lg">
                                            <input type="radio" name="opcion" value="<?php echo $item['opc2']?>">
                                            <a><?php echo $item['opc2']?></a> 
                                        </label>
                                    </td>
                                </tr>
                            </div>
                        <?php endforeach;?>
                    <?php endif;?>
                    <?php if($serie == 'IV'):?>
                        <?php foreach($datos as $item):?>
                        <tr>
                            <td>
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-primary">
                                        <a><?php echo $item->indice?></a>
                                        <input type="checkbox" name="opciones" value="<?php echo $item->indice?>" required/>
                                    </label>
                                </div>
                            </td>
                            <td><b><?php echo $item->respuesta?></b></td>
                        </tr>
                        <?php endforeach;?>
                    <?php endif;?>
                </tbody>
            </table>
            <input type="hidden" name="idAplicacion" value="<?php echo $idAplicacion ?>">
            <input type="hidden" name="idReactivo" value="<?php echo $idReactivo ?>">
            <input type="hidden" name="codigo" value="<?php echo $codigo ?>">
            <input type="text" value="<?php echo $pregunta?>" disabled>
            <input type="text" value="<?php echo $limite?>"disabled>
            <button class="btn btn-primary" onclick="insertar()"><i class="fas fa-angle-double-right"></i></button>
        </div>
    </div>
</div>
<script>
    document.title = "Terman merril";
    $( document ).ready(function() {
        if(<?=$indiceR?> == 1){
            $('#modelId').modal('toggle')
        }
    });
    function insertar(){
        var opcion = $('input:radio[name=opcion]:checked').val();
        var idAplicacion = $('input[name=idAplicacion]').val();
        var idReactivo = $('input[name=idReactivo]').val();
        var codigo = $('input[name=codigo]').val();
        if(opcion == undefined){
            alert("No hay ningun valor");
        }else{
            $.ajax({
                url: '/testalia/terman/encuesta_post/'+codigo,
                type: 'POST',
                data: {
                        idReactivo: idReactivo,
                        idAplicacion: idAplicacion,
                        opcion: opcion
                    },
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {
                    window.location = "/testalia/terman/encuesta/"+codigo;
                }
            });
        }
    }
</script>