<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Insertar Encuesta</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
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
            <h2>Agregar Encuesta</h2>
        </div>
    </div>
</div>
     
<?php echo validation_errors(); ?>     
<form action="<?php echo base_url('encuesta/store') ?>" method="POST" name="edit_note">
   <input type="hidden" name="id">
     <div class="row">
        <div class="col-md-12">
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <strong>Nombre</strong>
                <input type="text" class="form-control" col="4" name="nombre"
                 placeholder="Inserta un Nombre"></input>
            </div>
        </div>
        <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
     
 
</div>
     
</body>
</html>