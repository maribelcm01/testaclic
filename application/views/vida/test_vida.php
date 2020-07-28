<div class="container" style="text-align:center;background-color:#b5dffb;margin-top:30px;padding:30px;">
    <h4><b>Encuesta de <?=$nombre?></b></h4><br><br>
	<h2>
		<b><?php echo $reactivo ?></b>
		<?php if($comentario != null):?> 
			<sup>
				<i data-toggle="mensaje" title="<?=$comentario?>" class="far fa-question-circle" data-placement="right"></i>
			</sup>
		<?php endif;?>
	</h2>
	<h5><b>Yo me comporto así:</b></h5><br>
	<form action="<?=base_url('vida/encuestapost')?>/<?=$codigo?><?= isset($_GET['back']) ? '?back='.$_GET['back'].'' : '' ?>" method="post" id="form-encuesta">
		<div class="row justify-content-center">
			<div class="col-md-3">
				<button style="height:50px; width:120px;" class="btn <?= ($valor_reactivo != null && $valor_reactivo == 0) ? 'btn-warning' : 'btn-dark' ?>" required type="submit" name="valor" value="0"><b>Casi Nunca</b></button>
			</div>
			<div class="col-md-3">
				<button style="height:50px; width:120px;" class="btn <?= ($valor_reactivo != null && $valor_reactivo == 1) ? 'btn-warning' : 'btn-dark' ?>" required type="submit" name="valor" value="1"><b>Con Frecuencia</b></button>
			</div>
			<div class="col-md-3">
				<button style="height:50px; width:120px;" class="btn <?= ($valor_reactivo != null && $valor_reactivo == 2) ? 'btn-warning' : 'btn-dark' ?>" required type="submit" name="valor" value="2"><b>Casi Siempre</b></button>               
			</div>
		</div>
		<input type="hidden" name="idReactivo" value="<?php echo $idReactivo?>">
	</form><br><br>
	<div class="row justify-content-center">
		<div class="col-md-1">
			<?php if($menor != $pregunta):?> 
				<button style="height:50px;" name="back" class="btn btn-primary" onclick="location.href='<?=base_url('vida/encuesta');?>/<?=$codigo?>?back=<?=($pregunta-1)?>'"><i class="fas fa-angle-double-left"></i></button>
			<?php endif; ?>
		</div>
		<div class="col-md-8">
			<?php $style = round((($progreso-1) * 100) / $mayor)?>
			<div class="progress" style="height:50px;">
				<div class="progress-bar bg-dark progress-bar-striped" style="width:<?=$style?>%;"><?=$style?>%</div>
			</div>
		</div>
		<div class="col-md-1">
			<?php if($mayor != $pregunta && $control_siguiente == false):?>
				<button style="height:50px;" name="next" class="btn btn-primary" onclick="location.href='<?=base_url('vida/encuesta');?>/<?=$codigo?>?back=<?=($pregunta+1)?>'"><i class="fas fa-angle-double-right"></i></button>
			<?php endif; ?>
		</div>
	</div>
	<h4><b><?=$pregunta?> / <?=$mayor?></b></h4>
</div>

<script>
	document.title = 'Vida';
    $(document).ready(function(){
        $('[data-toggle="mensaje"]').tooltip(); 
    });
</script>		

	
