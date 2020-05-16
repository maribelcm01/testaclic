<div class="container" style="text-align: center; background-color:#b5dffb; margin-top: 40px; padding: 30px; size: 720px;">
    <h5>Test de <?=$nombre?></h5><br><br>
	<h2><?php echo $reactivo ?></h2><br>
	<p class="text-body" style="font-size: 20px;">Yo me comporto así:</p><br><br>
	<form action="<?=base_url('vida/encuestapost')?>/<?=$codigo?><?= isset($_GET['back']) ? '?back='.$_GET['back'].'' : '' ?>" method="post" id="form-encuesta">
		<div class="row justify-content-center">
			<div class="col-2">
				<button class="btn <?= ($valor_reactivo != null && $valor_reactivo == 0) ? 'btn-primary' : 'btn-warning' ?>" required type="submit" name="valor" value="0">Casi Nunca</button>
			</div>
			<div class="col-2">
				<button class="btn <?= ($valor_reactivo != null && $valor_reactivo == 1) ? 'btn-primary' : 'btn-warning' ?>" required type="submit" name="valor" value="1">Con Frecuencia</button>
			</div>
			<div class="col-2">
				<button class="btn <?= ($valor_reactivo != null && $valor_reactivo == 2) ? 'btn-primary' : 'btn-warning' ?>" required type="submit" name="valor" value="2">Casi Siempre</button>               
			</div>
		</div>
	</form><br><br><br>
	<div class="row">
		<?php if($menor != $pregunta):?> 
			<div class="col"><input type="button" name="back" value=" < Anterior" class="btn btn-secondary" onclick="location.href='<?=base_url('vida/encuesta');?>/<?=$codigo?>?back=<?=($pregunta-1)?>'"></div>
		<?php endif; ?>
		<?php if($mayor != $pregunta && $control_siguiente == false):?>
			<div class="col"><input type="submit" name="next" value=" Siguiente > " class="btn btn-secondary" onclick="location.href='<?=base_url('vida/encuesta');?>/<?=$codigo?>?back=<?=($pregunta+1)?>'"></div>
		<?php endif; ?>
	</div>

	<h4><?=$pregunta?> / <?=$limite?></h4>
	<?php $style = round(($pregunta * 100) / $limite)?>
	<div class="progress" style="height:30px">
	<div class="progress-bar bg-success" style="width:<?=$style?>%;"><?=$style?>%</div>
         
</div>
		

	
