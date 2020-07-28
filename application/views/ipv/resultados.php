<div class="container">
    <div class="row">
        <div class="col-md-4">
            <table class="table">
                <thead>
                    <tr>
                        <th>Descripción</th>
                        <th>Escala</th>
                        <th>PD</th>
                        <th>PT</th>
                        <th>Escala</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Disposición  General a la Venta</td>
                        <td>DGV</td>
                        <td><?=$DGV?></td>
                        <td><?=$DGVC?></td>
                        <td> <?php if($DGVC >= 1 && $DGVC <= 4):?>
                                Bajo
                            <?php elseif($DGVC >= 5 && $DGVC <= 6):?>
                                Promedio
                            <?php else:?>
                                Alto
                            <?php endif;?>
                        </td>
                    </tr>
                    <tr>
                        <td>Receptividad</td>
                        <td>R</td>
                        <td><?=$R?></td>
                        <td><?=$RC?></td>
                        <td> <?php if($RC >= 1 && $RC <= 4):?>
                                Bajo
                            <?php elseif($RC >= 5 && $RC <= 6):?>
                                Promedio
                            <?php else:?>
                                Alto
                            <?php endif;?>
                        </td>
                    </tr>
                    <tr>
                        <td>Agresividad</td>
                        <td>A</td>
                        <td><?=$A?></td>
                        <td><?=$AC?></td>
                        <td> <?php if($AC >= 1 && $AC <= 4):?>
                                Bajo
                            <?php elseif($AC >= 5 && $AC <= 6):?>
                                Promedio
                            <?php else:?>
                                Alto
                            <?php endif;?>
                        </td>
                    </tr>
                    <tr>
                        <td>Comprensión</td>
                        <td>I</td>
                        <td><?=$I?></td>
                        <td><?=$IC?></td>
                        <td> <?php if($IC >= 1 && $IC <= 4):?>
                                Bajo
                            <?php elseif($IC >= 5 && $IC <= 6):?>
                                Promedio
                            <?php else:?>
                                Alto
                            <?php endif;?>
                        </td>
                    </tr>
                    <tr>
                        <td>Adaptabilidad</td>
                        <td>II</td>
                        <td><?=$II?></td>
                        <td><?=$IIC?></td>
                        <td> <?php if($IIC >= 1 && $IIC <= 4):?>
                                Bajo
                            <?php elseif($IIC >= 5 && $IIC <= 6):?>
                                Promedio
                            <?php else:?>
                                Alto
                            <?php endif;?>
                        </td>
                    </tr>
                    <tr>
                        <td>Autocontrol</td>    
                        <td>III</td>
                        <td><?=$III?></td>
                        <td><?=$IIIC?></td>
                        <td> <?php if($IIIC >= 1 && $IIIC <= 4):?>
                                Bajo
                            <?php elseif($IIIC >= 5 && $IIIC <= 6):?>
                                Promedio
                            <?php else:?>
                                Alto
                            <?php endif;?>
                        </td>
                    </tr>
                    <tr>
                        <td>Tolerancia</td>
                        <td>IV</td>
                        <td><?=$IV?></td>
                        <td><?=$IVC?></td>
                        <td> <?php if($IVC >= 1 && $IVC <= 4):?>
                                Bajo
                            <?php elseif($IVC >= 5 && $IVC <= 6):?>
                                Promedio
                            <?php else:?>
                                Alto
                            <?php endif;?>
                        </td>
                    </tr>
                    <tr>
                        <td>Combatividad</td>
                        <td>V</td>
                        <td><?=$V?></td>
                        <td><?=$VC?></td>
                        <td> <?php if($VC >= 1 && $VC <= 4):?>
                                Bajo
                            <?php elseif($VC >= 5 && $VC <= 6):?>
                                Promedio
                            <?php else:?>
                                Alto
                            <?php endif;?>
                        </td>
                    </tr>
                    <tr>
                        <td>Dominio</td>
                        <td>VI</td>
                        <td><?=$VI?></td>
                        <td><?=$VIC?></td>
                        <td> <?php if($VIC >= 1 && $VIC <= 4):?>
                                Bajo
                            <?php elseif($VIC >= 5 && $VIC <= 6):?>
                                Promedio
                            <?php else:?>
                                Alto
                            <?php endif;?>
                        </td>
                    </tr>
                    <tr>
                        <td>Seguridad</td>
                        <td>VII</td>
                        <td><?=$VII?></td>
                        <td><?=$VIIC?></td>
                        <td> <?php if($VIIC >= 1 && $VIIC <= 4):?>
                                Bajo
                            <?php elseif($VIIC >= 5 && $VIIC <= 6):?>
                                Promedio
                            <?php else:?>
                                Alto
                            <?php endif;?>
                        </td>
                    </tr>
                    <tr>
                        <td>Actividad</td>
                        <td>VIII</td>
                        <td><?=$VIII?></td>
                        <td><?=$VIIIC?></td>
                        <td> <?php if($VIIIC >= 1 && $VIIIC <= 4):?>
                                Bajo
                            <?php elseif($VIIIC >= 5 && $VIIIC <= 6):?>
                                Promedio
                            <?php else:?>
                                Alto
                            <?php endif;?>
                        </td>
                    </tr>
                    <tr>
                        <td>Sociabilidad</td>
                        <td>IX</td>
                        <td><?=$IX?></td>
                        <td><?=$IXC?></td>
                        <td> <?php if($IXC >= 1 && $IXC <= 4):?>
                                Bajo
                            <?php elseif($IXC >= 5 && $IXC <= 6):?>
                                Promedio
                            <?php else:?>
                                Alto
                            <?php endif;?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-8">
            <figure class="highcharts-figure">
                <div id="container"></div>
            </figure>
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
                <?=$DGVC?>,
                <?=$RC?>,
                <?=$AC?>,
                <?=$IC?>,
                <?=$IIC?>,
                <?=$IIIC?>,
                <?=$IVC?>,
                <?=$VC?>,
                <?=$VIC?>,
                <?=$VIIC?>,
                <?=$VIIIC?>,
                <?=$IXC?>
            ]
        }],
    });
</script>