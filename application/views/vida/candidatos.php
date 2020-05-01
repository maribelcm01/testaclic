
            <div class="alert alert-primary" role="alert">
                <h3>Nombre Encuesta: <?php echo $encuesta->nombre ?> </h3>  
                <h3>Id: <?php echo $encuesta->idEncuesta ?> </h3>  
                <div>
                    
                    <a type="button" href="<?=base_url("/vida/agregar_candidato")?>/<?php echo  $encuesta->idEncuesta ?>" class="btn btn-large btn-block btn-primary">
                    <span class="fa fa-save" aria-hidden="true"></span>Agregar Candidato</a>
                    <a type="button" href="<?=base_url("/vida")?>" class="btn btn-large btn-block btn-success">
                    <span class="fa fa-back" aria-hidden="true"></span>Ver aplicaciones</a>
                    
                </div>
            </div>
                 
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>F Inicio - F Fin</th>
                            <th>Código</th>
                            <th>Acciones/Progreso</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($result): ?>
                    		<?php foreach($result as $candidato): ?>
                                <tr>
                                    <td><?php echo $candidato->idCandidato ?></td>
                                    <td><?php echo $candidato->nombre ?> - <?php echo $candidato->email ?></td>
                                    <?php
                                    $Nueva_Fecha = date("d-m-Y", strtotime($candidato->fechaCreacion));				
                                    $FormatFechaInicio = strftime("%d-%B-%Y", strtotime($Nueva_Fecha));
                                    if($candidato->fechaConclusion != NULL){
                                        $Nueva_Fecha = date("d-m-Y", strtotime($candidato->fechaConclusion));				
                                        $FormatFechaFin = strftime("%d-%B-%Y", strtotime($Nueva_Fecha));
                                    }else{
                                       $FormatFechaFin = "Sin terminar";
                                    }
                                    ?>
                                    <td><?php echo $FormatFechaInicio ?> / <?php echo $FormatFechaFin ?></td>
                                    <td><?php echo $candidato->codigo ?></td>
                                    <?php if($candidato->estado === "P"): ?>
                                        <td>
                                            <a href="<?=base_url("/vida/continuar_encuesta/")?><?php echo  $candidato->idEncuesta ?>/<?php echo  $candidato->idCandidato ?>/1">Continuar Aplicativo</a>
                                            <div class="progress">
                                                <div class="progress-bar " role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
                                            </div>
                                        </td>
                                    <?php else: ?>
                                        <td>
                                            <span class="badge badge-success">Encuesta finalizada</span>
                                            <div class="progress">
                                                <div class="progress-bar bg-success " role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                                            </div>
                                        </td>
                                    <?php endif ?>
                                </tr>
							<?php endforeach; ?>
						<?php endif ?>
                        
                    </tbody>
                </table>
            </div>		
		