<!DOCTYPE html>
    <html lang="en">
        <head>
            <title>Encuesta de Zavic</title>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
            <link rel="stylesheet" href="<?=base_url('application/assets/fonts/css/all.css')?>"> <!--load all styles -->
            
            <!-- Optional JavaScript -->
            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
            <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.9.1/underscore-min.js"></script> 

            <script src="https://code.highcharts.com/highcharts.js"></script>
            <script src="https://code.highcharts.com/modules/exporting.js"></script>
            <script src="https://code.highcharts.com/modules/export-data.js"></script>

            <style>
                @import url("//fonts.googleapis.com/css?family=Terminal+Dosis");
                body {font-family: "Terminal Dosis", sans-serif;}
                
                .check-ok { color: green; }
                .check-ko { color: red; }
                input:invalid ~ .check-ok { display: none; }
                input:valid ~ .check-ok { display: inline; }

                input:invalid ~ .check-ko { display: inline; }
                input:valid ~ .check-ko { display: none; }

                .highcharts-figure, .highcharts-data-table table {
                    min-width: 310px; 
                    max-width: 800px;
                    margin: 1em auto;
                }

                #container{
                    height: 400px;
                }

                .highcharts-data-table table {
                    border-collapse: collapse;
                    border: 1px solid #EBEBEB;
                    margin: 10px auto;
                    text-align: center;
                    width: 100%;
                    max-width: 500px;
                }
                .highcharts-data-table caption {
                    padding: 1em 0;
                    font-size: 1.2em;
                    color: #555;
                }
                .highcharts-data-table th {
                    font-weight: 600;
                    padding: 0.5em;
                }
                .highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
                    padding: 0.5em;
                }
                .highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
                    background: #f8f8f8;
                }
                .highcharts-data-table tr:hover {
                    background: #f1f7ff;
                }
            </style>
        </head>
        <body>