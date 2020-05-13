<div class="container" style="text-align: center; background-color:#b5dffb; margin-top: 40px; padding: 30px; size: 720px;">
	<h4>Test de <?=$nombre?></h4>
	<br>
	<p style="font-size: 41px;"> <?php echo $reactivo ?> </p>
	<p class="font-italic" style="font-size: 13px;">
		</p>
	<p>&nbsp;</p>

	<form action="vida_test.php" method="post">
		<p class="text-body" style="font-size: 25px;">Yo me comporto así:</p>
		<div class="row">
			<div class="col text-body"><button class="btn btn-warning" type="submit" required="required" name='valor' value='0'>Casi Nunca</button></div>
			<div class="col text-body"><button class="btn btn-warning" type="submit" required="required" name='valor' value='1'>Con Frecuencia</button></div>
			<div class="col text-body"><button class="btn btn-warning" type="submit" required="required" name='valor' value='2'>Casi Siempre</button></div>
		</div>
		<br><br>
		<div class="row">
			<div class="col"><input type="button" name="back" value=" < Anterior" class="btn btn-secondary" onclick="location.href='<?=base_url('vida/cuestionario');?>/<?=$codigo?>/<?=$idReactivo?>'"></div>
			<div class="col"><input type="submit" name="next" value=" Siguiente > " class="btn btn-secondary"></div>
		</div>
		<input class="form-control" type="" name="idAplicacion" value="<?php echo $idAplicacion ?>" style='display: none'>
		<input class="form-control" type="" name="idReactivo" value="<?php echo $idReactivo?>" style='display: none'>
	</form>

	<h4>85 / 240</h4>
	<div class="progress" style="height:30px">
	<div class="progress-bar bg-success" style="width:35%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">35%</div>
</div>
