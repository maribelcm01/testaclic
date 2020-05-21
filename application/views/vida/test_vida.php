<div class="container" style="text-align: center; background-color:#b5dffb; margin-top: 40px; padding: 30px; size: 720px;">
    <h4>Test de <?=$nombre?></h4><br><br>
	<h2>
		<?php echo $reactivo ?>
		<?php if($comentario != null):?> 
			<sup>
				<i data-toggle="mensaje" title="<?=$comentario?>" class="far fa-question-circle"></i>
			</sup>
		<?php endif;?>
	</h2><br>
	<p style="font-size: 20px;">Yo me comporto así:</p><br><br>
	<form action="<?=base_url('vida/encuestapost')?>/<?=$codigo?><?= isset($_GET['back']) ? '?back='.$_GET['back'].'' : '' ?>" method="post" id="form-encuesta">
		<div class="row justify-content-center">
			<div class="col-3">
				<button class="btn <?= ($valor_reactivo != null && $valor_reactivo == 0) ? 'btn-warning' : 'btn-dark' ?>" required type="submit" name="valor" value="0">Casi Nunca</button>
			</div>
			<div class="col-3">
				<button class="btn <?= ($valor_reactivo != null && $valor_reactivo == 1) ? 'btn-warning' : 'btn-dark' ?>" required type="submit" name="valor" value="1">Con Frecuencia</button>
			</div>
			<div class="col-3">
				<button class="btn <?= ($valor_reactivo != null && $valor_reactivo == 2) ? 'btn-warning' : 'btn-dark' ?>" required type="submit" name="valor" value="2">Casi Siempre</button>               
			</div>
		</div>
	</form><br><br><br>
	<div class="row">
		<div class="col">
			<?php if($menor != $pregunta):?> 
				<button name="back" class="btn btn-secondary" onclick="location.href='<?=base_url('vida/encuesta');?>/<?=$codigo?>?back=<?=($pregunta-1)?>'"><i class="fas fa-angle-double-left"></i> Anterior</button>
			<?php endif; ?>
		</div>
		<div class="col">
			<?php if($mayor != $pregunta && $control_siguiente == false):?>
				<button name="next" class="btn btn-secondary" onclick="location.href='<?=base_url('vida/encuesta');?>/<?=$codigo?>?back=<?=($pregunta+1)?>'">Siguiente <i class="fas fa-angle-double-right"></i></button>
			<?php endif; ?>
		</div>
	</div>

	<h4><?=$pregunta?> / <?=$mayor?></h4>
	<?php $style = round((($progreso-1) * 100) / $mayor)?>
	<div class="progress" style="height:30px">
	<div class="progress-bar bg-dark" style="width:<?=$style?>%;"><?=$style?>%</div>  
</div>

<script>
    $(document).ready(function(){
        $('[data-toggle="mensaje"]').tooltip(); 
    });
</script>		

	
