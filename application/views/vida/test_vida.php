<div class="container" style="text-align: center; background-color:#b5dffb; margin-top: 40px; padding: 30px; size: 720px;">
    <h4 style="font-weight:bold;">Test de <?=$nombre?></h4><br><br>
	<h2 style="font-weight:bold;">
		<?php echo $reactivo ?>
			<?php if($comentario != null):?> 
				<sup>
					<i data-toggle="mensaje" title="<?=$comentario?>" class="far fa-question-circle"></i>
				</sup>
			<?php endif;?>
	</h2><br>
	<p style="font-size: 20px;font-weight:bold;">Yo me comporto así:</p><br><br>
	<form action="<?=base_url('vida/encuestapost')?>/<?=$codigo?><?= isset($_GET['back']) ? '?back='.$_GET['back'].'' : '' ?>" method="post" id="form-encuesta">
		<div class="row justify-content-center">
			<div class="col-3">
				<button style="font-weight:bold; height:50px; width:120px;" class="btn <?= ($valor_reactivo != null && $valor_reactivo == 0) ? 'btn-warning' : 'btn-dark' ?>" required type="submit" name="valor" value="0">Casi Nunca</button>
			</div>
			<div class="col-3">
				<button style="font-weight:bold; height:50px; width:120px;" class="btn <?= ($valor_reactivo != null && $valor_reactivo == 1) ? 'btn-warning' : 'btn-dark' ?>" required type="submit" name="valor" value="1">Con Frecuencia</button>
			</div>
			<div class="col-3">
				<button style="font-weight:bold; height:50px; width:120px;" class="btn <?= ($valor_reactivo != null && $valor_reactivo == 2) ? 'btn-warning' : 'btn-dark' ?>" required type="submit" name="valor" value="2">Casi Siempre</button>               
			</div>
		</div>
	</form><br><br><br>
	<div class="row justify-content-center">
		<div class="col-2">
			<?php if($menor != $pregunta):?> 
				<button style="font-weight:bold; height:50px;" name="back" class="btn btn-primary" onclick="location.href='<?=base_url('vida/encuesta');?>/<?=$codigo?>?back=<?=($pregunta-1)?>'"><i class="fas fa-angle-double-left"></i> </button>
			<?php endif; ?>
		</div>
		<div class="col-6">
			<?php $style = round((($progreso-1) * 100) / $mayor)?>
			<div class="progress" style="height:50px;">
				<div class="progress-bar bg-dark progress-bar-striped" style="width:<?=$style?>%;"><?=$style?>%</div>
			</div>
		</div>
		<div class="col-2">
			<?php if($mayor != $pregunta && $control_siguiente == false):?>
				<button style="font-weight:bold; height:50px;" name="next" class="btn btn-primary" onclick="location.href='<?=base_url('vida/encuesta');?>/<?=$codigo?>?back=<?=($pregunta+1)?>'"> <i class="fas fa-angle-double-right"></i></button>
			<?php endif; ?>
		</div>
	</div>
	<h4 style="font-weight:bold;"><?=$pregunta?> / <?=$mayor?></h4>
	
</div>

<script>
    $(document).ready(function(){
        $('[data-toggle="mensaje"]').tooltip(); 
    });
</script>		

	
