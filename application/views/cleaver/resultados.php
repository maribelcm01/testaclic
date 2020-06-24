<div class="container">
    <div class="row m-4">
        <div class="col-md-2">
            <div class="">
                <button class="btn btn-success" onclick="Export2Doc('exportContent', '<?php echo $nombre?>');">Guardar como .doc</button><br>
                <button class="btn btn-success" style="margin-top:10px;margin-left:20px;width:100px" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"> Métricas </button>
                <div style="margin-top:10px;margin-left:20px;" id="collapseExample" class="collapse">
                    <ul style= "list-style-type: none">
                        <?php foreach($datos as $key):?>
                            <li style="font-weight:bold"><?php echo $key;?></li>
                        <?php endforeach; ?>
                    </ul> 
                </div>
            </div>
        </div>
        <div class="col-md-10" id="exportContent">
            <h4><?php echo $nombre?></h4>
            <table bordercolor="black" border="1" cellspacing="0">
                <thead class="thead-dark">
                    <tr>
                        <th>Interpretación</th>
                        <th>Resultado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($resultados as $key => $value): ?>
                        <tr>
                            <td align="center" valign="top"><?php echo $value->interpretacion ?></td>
                            <td style="text-align:justify"><?php echo $value->explicacion ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table> 
        </div>
    </div>
</div>
