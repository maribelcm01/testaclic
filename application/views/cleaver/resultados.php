<div class="container">
    <button class="btn btn-success" style="margin-top:10px;margin-left:100px;" onclick="Export2Doc('exportContent', '<?php echo $nombre?>');">Guardar como .doc</button>
</div>
<div class="container" id="exportContent">
    <div class="row justify-content-center">
        <div class="col-10">
            <h4 style="margin-top:0px;"><?php echo $nombre?></h4>
            <table class="table table-striped table-bordered" style="margin-top:0;">
                <thead class="thead-dark">
                    <tr>
                        <th>Interpretación</th>
                        <th>Resultado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($resultados as $key => $value): ?>
                        <tr>
                            <td><?php echo $value->interpretacion ?></td>
                            <td style="text-align:justify"><?php echo $value->explicacion ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
        </div>
    </div>
</div>

