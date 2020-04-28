<!DOCTYPE html>
<html>
<head>
  	<title>Encuentas</title>
  	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
    <style>
        .mt40{
         	margin-top: 40px;
    	}
    </style>
</head>
<body>
  	<ul>
		<?php foreach ($menu as $item): ?>
			 <li><a href="<?= $item['url'] ?>"><?= $item['title'] ?></a></li>
	   <?php endforeach ?>
	 </ul>

    <div class="container">
        <div class="row mt40">
            <div class="col-md-10">
                <h2>Encuestas</h2>
            </div>
            <div class="col-md-2">
                <a href="<?php echo base_url('encuesta/create/') ?>" class="btn btn-danger">Agregar Encuesta</a>
            </div>
          
            <br><br>
     
            <table class="table table-bordered">
                <thead>
                    <tr>
                      <th>Id</th>
                       <th>Title</th>
                       <td colspan="2">Action</td>
                    </tr>
                </thead>
                <tbody>
                    <?php if($encuesta): ?>
                    <?php foreach($encuesta as $encuesta): ?>
                    <tr>
                        <td><?php echo $encuesta->idEncuesta; ?></td>
                        <td><?php echo $encuesta->nombre; ?></td>
                        <!--<td><a href="<?php echo base_url('encuesta/edit/'.$encuesta->idEncuesta) ?>" class="btn btn-primary">Edit</a></td>-->
                        <td>
                        <form action="<?php echo base_url('encuesta/delete/'.$encuesta->idEncuesta) ?>" method="post">
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>