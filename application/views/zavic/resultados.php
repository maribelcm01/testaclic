<figure class="highcharts-figure">
    <div id="container1"></div>
</figure><br>
<figure class="highcharts-figure">
   <div id="container2"></div>
</figure><br>
<figure class="highcharts-figure">
   <div id="container3"></div>
</figure>

<script>
    document.title = 'Zavic';
    // Create the chart
    Highcharts.chart('container1', {
        chart: { type: 'column' },
        title: { text: 'Encuesta de Zavic' },
        subtitle: { text: '' },
        accessibility: {
            announceNewData: { enabled: true }
        },
        xAxis: { type: 'category' },
        yAxis: {
            title: { text: '' }
        },
        legend: { enabled: false },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '{point.y}'
                }
            }
        },
        tooltip: {
            headerFormat: ' ',//'<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b><br/>'
        },
        series: [{
            name: "Resultados",
            colorByPoint: true,
            data: [{
                name: "Moral",
                y: <?php echo $Moral?>,
                drilldown: "Moral"
            }, {
                name: "Legalidad",
                y: <?php echo $Legal?>,
                drilldown: "Legalidad"
            }, {
                name: "Indiferencia",
                y: <?php echo $Indif?>,
                drilldown: "Indiferencia"
            }, {
                name: "Corrupto",
                y: <?php echo $Corru?>,
                drilldown: "Corrupto"
            }, {
                name: "Económico",
                y: <?php echo $Econo?>,
                drilldown: "Económico"
            }, {
                name: "Político",
                y: <?php echo $Polit?>,
                drilldown: "Político"
            }, {
                name: "Social",
                y: <?php echo $Socia?>,
                drilldown: "Social"
            }, {
                name: "Religioso",
                y: <?php echo $Relig?>,
                drilldown: "Religioso"
            }]
        }]
    });

    // Build the chart
    Highcharts.chart('container2', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: { text: 'Valores' },
        tooltip: {
            headerFormat: ' ',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.percentage:.0f}%</b>'
        },
        accessibility: {
            point: { valueSuffix: '%' }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.0f}%'
                },
                showInLegend: true
            }
        },
        series: [{
            name: 'Valores',
            colorByPoint: true,
            data: [{
                name: 'Moral',
                y: <?php echo $Moral?>
            }, {
                name: 'Legalidad',
                y: <?php echo $Legal?>
            }, {
                name: 'Indiferencia',
                y: <?php echo $Indif?>
            }, {
                name: 'Corrupto',
                y: <?php echo $Corru?>
            }]
        }]
    });

    // Build the chart
    Highcharts.chart('container3', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: { text: 'Intereses' },
        tooltip: {
            headerFormat: ' ',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.percentage:.0f}%</b>'
        },
        accessibility: {
            point: { valueSuffix: '%' }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.0f}%'
                },
                showInLegend: true
            }
        },
        series: [{
            name: 'Intereses',
            colorByPoint: true,
            data: [{
                name: 'Económico',
                y: <?php echo $Econo?>
            }, {
                name: 'Político',
                y: <?php echo $Polit?>
            }, {
                name: 'Social',
                y: <?php echo $Socia?>
            }, {
                name: 'Religioso',
                y: <?php echo $Relig?>
            }]
        }]
    });
</script>