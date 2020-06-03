<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Encuesta Cleaver</title><!-- Required meta tags -->
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
            <link rel="stylesheet" href="<?=base_url('application/assets/fonts/css/all.css')?>"> <!--load all styles -->
            
            <!-- Optional JavaScript -->
            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
            <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

            <style>
                @import url("//fonts.googleapis.com/css?family=Terminal+Dosis");
                body {font-family: "Terminal Dosis", sans-serif;}
                .mt40{
                    margin-top: 40px;
                }
                .reactivo{background-color:#fefefe;border:1px solid #4cbed8;width:410px;height:50px;padding-top:10px;}
                .mas{background-color:#fefefe;border:1px solid #4cbed8;width:50px;height:50px;text-align:center;cursor:pointer;}
                .menos{background-color:#fefefe;border:1px solid #4cbed8;width:50px;height:50px;text-align:center;cursor:pointer;}
                
                .isHidden {/* display: none; */ /* hide radio buttons */}
                .cmas {background-color:green;}
                .cmenos{background-color:red;}                
            </style>
	</head>
	<body>