<div class="container">
    <div class="row m-4">
        <div class="col-md-2">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-success" style="margin-top:10px;width:100px" data-toggle="modal" data-target=".modal-grafica">Gráfica</button>
            <!-- Modal -->
            <div class="modal fade modal-grafica" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Gráficas</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <figure class="highcharts-figure">
                                <div id="container"></div>
                            </figure><br>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-success" style="margin-top:10px;width:100px" data-toggle="modal" data-target=".modal-tabla">Tabla</button>
            <!-- Modal -->
            <div class="modal fade modal-tabla" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tabla de Resultados</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Descripción</th>
                                    <th>Enfoque</th>
                                    <th>PD</th>
                                    <th>PT</th>
                                    <th>Escala</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($resultado as $value): ?>
                                <tr>
                                    <td><?= $value['interpretacion'] ?></td>
                                    <td><?= $value['enfoque'] ?></td>
                                    <td><?= $value['PD'] ?></td>
                                    <td><?= $value['PT'] ?></td>
                                    <td><?= $value['Escala'] ?></td>
                                </tr>
                            <?php endforeach; ?>

                            </tbody>
                        </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <a type="button" class="btn btn-primary" style="margin-top:10px;width:100px" href="<?= base_url('aplicacion/index')?>/<?= $idPersona ?>">Regresar</a>
        </div>
        <div class="col-md-10" id="exportContent">
            <h4><?= $nombre?></h4>
            <table bordercolor="black" border="1" cellspacing="0">
                <thead class="thead-dark">
                    <tr>
                        <th>Interpretación</th>
                        <th>Descripcion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($consulta as $key => $value): ?>
                        <tr>
                            <td align="center" valign="top"><?= $value->interpretacion ?></td>
                            <td style="text-align:justify"><?= $value->descripcion ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table> 
        </div>
    </div>
</div>

<script>
    document.title = 'IPV';
    Highcharts.chart('container', {
        chart: {
            type: 'spline'
        },
        title: { text: 'Perfil IPV' },
        subtitle: { text: '' },
        xAxis: { categories: ['DGV', 'R', 'A', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX'] },
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
            name: '',
            color: '#35C5EB',
            data: [
                <?= $resultado[0]['PT'] ?>,
                <?= $resultado[1]['PT'] ?>,
                <?= $resultado[2]['PT'] ?>,
                <?= $resultado[3]['PT'] ?>,
                <?= $resultado[4]['PT'] ?>,
                <?= $resultado[5]['PT'] ?>,
                <?= $resultado[6]['PT'] ?>,
                <?= $resultado[7]['PT'] ?>,
                <?= $resultado[8]['PT'] ?>,
                <?= $resultado[9]['PT'] ?>,
                <?= $resultado[10]['PT'] ?>,
                <?= $resultado[11]['PT'] ?>
            ]
        }],
    });
</script>