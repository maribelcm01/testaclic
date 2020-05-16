<div class="container" style="text-align: center; background-color:#b5dffb; margin-top: 40px; padding: 30px; size: 720px;">
    <h5>Test de <?=$nombre?></h5><br><br>
	<h2><?php echo $reactivo ?></h2><br>
	<p class="text-body" style="font-size: 20px;">Yo me comporto así:</p><br><br>
	<form action="<?=base_url('vida/encuesta')?>/<?=$codigo?>" method="post">
		<div class="row justify-content-center">
			<div class="col-2">
				<button class="btn btn-warning" required="required" type="submit" name="valor" value="0">Casi Nunca</button>
			</div>
			<div class="col-2">
				<button class="btn btn-warning" required="required" type="submit" name="valor" value="1">Con Frecuencia</button>
			</div>
			<div class="col-2">
				<button class="btn btn-warning" required="required" type="submit" name="valor" value="2">Casi Siempre</button>               
			</div>
		</div>
	</form><br><br><br>
	<h4><?=$pregunta?> / <?=$limite?></h4>
	<?php $style = round(($pregunta * 100) / $limite)?>
	<div class="progress" style="height:30px">
	<div class="progress-bar bg-success" style="width:<?=$style?>%;"><?=$style?>%</div>
         
</div>
		<!--<div class="row">
			<div class="col"><input type="button" name="back" value=" < Anterior" class="btn btn-secondary" onclick="location.href='<?=base_url('vida/cuestionario');?>/<?=$codigo?>/<?=$idReactivo?>'"></div>
			<div class="col"><input type="submit" name="next" value=" Siguiente > " class="btn btn-secondary"></div>
		</div>-->

	
