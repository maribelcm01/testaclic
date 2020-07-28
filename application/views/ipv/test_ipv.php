<div class="container" style="text-align:center; background-color:#b5dffb; margin-top:40px; padding:30px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h4><b>Test de <?php echo $nombre?></b></h4><br>
            <h5><b><?php echo $reactivo?></b></h5>
        </div>
        <div class="col-md-5">
            <form action="<?=base_url('ipv/encuesta_post')?>/<?=$codigo?><?= isset($_GET['back']) ? '?back='.$_GET['back'].'' : '' ?>" method="post">
                <table class="table">
                    <tbody>
                        <?php foreach($datos as $item):?>
                        <tr>
                            <td>
                                <button type="submit" class="btn <?= ($opc != null && $opc == $item->indice) ? 'btn-warning' : 'btn-secondary' ?>" name="opcion" value="<?php echo $item->indice?>"><?php echo $item->indice?></button>
                            </td>
                            <td><b><?php echo $item->respuesta?></b></td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
                <input type="hidden" name="idReactivo" value="<?php echo $idReactivo?>">
            </form>
        </div>
    </div>
    <div class="row justify-content-center">
		<div class="col-md-1">
			<?php if($menor != $pregunta):?> 
				<button style="height:50px;" name="back" class="btn btn-primary" onclick="location.href='<?=base_url('ipv/encuesta');?>/<?=$codigo?>?back=<?=($pregunta-1)?>'"><i class="fas fa-angle-double-left"></i></button>
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
				<button style="height:50px;" name="next" class="btn btn-primary" onclick="location.href='<?=base_url('ipv/encuesta');?>/<?=$codigo?>?back=<?=($pregunta+1)?>'"><i class="fas fa-angle-double-right"></i></button>
			<?php endif; ?>
		</div>
	</div>
	<h4><b><?=$pregunta?> / <?=$mayor?></b></h4>
</div>

<script> document.title = 'IPV'; </script>