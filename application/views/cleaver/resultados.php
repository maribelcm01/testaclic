<div class="container">
    <div class="row m-4">
        <div class="col-md-2">
            <button type="button" class="btn btn-success" style="margin-top:10px;width:100px" onclick="Export2Doc('exportContent', '<?= $nombre?>');">Guardar como .doc</button><br>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-success" style="margin-top:10px;width:100px" data-toggle="modal" data-target=".modal-graficas">Gráficas</button>
            <!-- Modal -->
            <div class="modal fade modal-graficas" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Gráficas Cleaver</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <figure class="highcharts-figure">
                                <div id="container1"></div>
                            </figure><br>
                            <figure class="highcharts-figure">
                                <div id="container2"></div>
                            </figure><br>
                            <figure class="highcharts-figure">
                                <div id="container3"></div>
                            </figure>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-success" style="margin-top:10px;width:100px" data-toggle="modal" data-target=".modal-patron">Patrones</button>
            <!-- Modal -->
            <div class="modal fade modal-patron" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Patrones Cleaver</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <figure class="figure">
                                <img src="<?=base_url("application/assets/img/patrones.jpeg")?>" class="figure-img img-fluid rounded" alt="">
                            </figure>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-success" style="margin-top:10px;width:100px" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                Métricas
            </button>
            <div style="margin-top:10px" id="collapseExample" class="collapse">
                <ul style= "list-style-type: none">
                    <?php foreach($datos as $key):?>
                        <li><b><?= $key;?></b></li>
                    <?php endforeach; ?>
                </ul> 
            </div>
            <a type="button" class="btn btn-primary" style="margin-top:10px;width:100px" href="<?= base_url('aplicacion/index')?>/<?= $idPersona ?>">Regresar</a>
        </div>
        <div class="col-md-10" id="exportContent">
            <h4><?= $nombre?></h4>
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
                            <td align="center" valign="top"><?= $value->interpretacion ?></td>
                            <td style="text-align:justify"><?= $value->explicacion ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table> 
        </div>
    </div>
</div>

<script>
    document.title = 'Cleaver';
    Highcharts.chart('container1', {
        title: { text: 'Normal' },
        subtitle: { text: '' },
        xAxis: { categories: ['Empuje (D)', 'Persuación (I)', 'Constancia (S)', 'Apego (C)'] },
        yAxis: {
            title: { text: '' },
            accessibility: { rangeDescription: 'Range: 0 to 100' }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        plotOptions: {
            line: {
                dataLabels: { enabled: true },
                enableMouseTracking: true
            }
        },
        series: [{
            name: 'Total',
            color: '#35C5EB',
            data: [
                <?= $DTotal?>,
                <?= $ITotal?>,
                <?= $STotal?>,
                <?= $CTotal?>
            ]
        }],
    });

    Highcharts.chart('container2', {
        title: { text: 'Motivación' },
        subtitle: { text: '' },
        xAxis: { categories: ['Empuje (D)', 'Persuación (I)', 'Constancia (S)', 'Apego (C)'] },
        yAxis: {
            title: { text: '' },
            accessibility: { rangeDescription: 'Range: 0 to 100' }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        plotOptions: {
            line: {
                dataLabels: { enabled: true },
                enableMouseTracking: true
            }
        },
        series: [{
            name: 'Más',
            color: '#EB8235',
            data: [
                <?= $DMas?>,
                <?= $IMas?>,
                <?= $SMas?>,
                <?= $CMas?>
            ]
        }],
    });

    Highcharts.chart('container3', {
        title: { text: 'Presión' },
        subtitle: { text: '' },
        xAxis: { categories: ['Empuje (D)', 'Persuación (I)', 'Constancia (S)', 'Apego (C)'] },
        yAxis: {
            title: { text: '' },
            accessibility: { rangeDescription: 'Range: 0 to 100' }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        plotOptions: {
            line: {
                dataLabels: { enabled: true },
                enableMouseTracking: true
            }
        },
        series: [{
            name: 'Menos',
            color: '#EB35D2',
            data: [
                <?= $DMenos?>,
                <?= $IMenos?>,
                <?= $SMenos?>,
                <?= $CMenos?>
            ]
        }],
    });

</script>
