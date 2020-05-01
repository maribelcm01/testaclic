<h1>Encuesta <?php echo $candidato->nombre ?></h1>
<h2><?php echo $reactivo->reactivo ?></h2>
<form action="<?=base_url("/vida/guardarRespuestaApp/")?><?php echo $reactivo->indice ?>/<?php echo $reactivo->idReactivo ?>/<?php echo $candidato->idCandidato ?>/<?php echo $reactivo->idEncuesta ?>/<?php echo $candidato->idAplicacion ?>" method="post" accept-charset="utf-8">
    <div class="custom-control custom-radio">
      <input type="radio" required class="custom-control-input" id="customRadio" name="reactivo" value="0">
      <label class="custom-control-label" for="customRadio">Casi Nunca</label>
    </div>
    <div class="custom-control custom-radio">
      <input type="radio" required class="custom-control-input" id="customRadio1" name="reactivo" value="1">
      <label class="custom-control-label" for="customRadio1">Con Frecuencia</label>
    </div>
    <div class="custom-control custom-radio">
      <input type="radio" required class="custom-control-input" id="customRadio2" name="reactivo" value="2">
      <label class="custom-control-label" for="customRadio2">Casi Siempre</label>
    </div>
    <button class="btn btn-secondary" type="submit">Enviar</button>
</form>