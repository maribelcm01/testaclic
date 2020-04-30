<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar Registro</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        .mt40{
            margin-top: 40px;
        }
    </style>
</head>
<body>
    
<div class="container">
  
<div class="row">
    <div class="col-lg-12 mt40">
        <div class="pull-left">
            <h2>Edit Note</h2>
        </div>
    </div>
</div>
     
     
<form action="<?php echo base_url('encuesta/store') ?>" method="POST" name="edit_note">
   <input type="hidden" name="id" value="<?php echo $encuesta->idEncuesta ?>">
     <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <strong>Id de la Encuesta</strong>
                <input type="text" name="idEncuesta" class="form-control" value="<?php echo $encuesta->idEncuesta ?>" disabled placeholder="Enter Title">
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <strong>Nombre</strong>
                <input class="form-control" col="4" name="nombre"
                 placeholder="Enter Description" value="<?php echo $encuesta->nombre ?>"></input>
            </div>
        </div>
        <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
     
 
</div>
     
</body>
</html>