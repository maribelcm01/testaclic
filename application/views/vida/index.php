  
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($result): ?>
                    		<?php foreach($result as $encuesta): ?>
                                <tr>
                                    <td><?php echo $encuesta->idEncuesta ?></td>
                                    <td><?php echo $encuesta->nombre ?></td>
                                    <td><a href="<?=base_url("/vida/ver_candidatos")?>/<?php echo  $encuesta->idEncuesta ?>">Ver Candidatos de este aplicativo</a></td>
                                </tr>
							<?php endforeach; ?>
						<?php endif ?>
                        
                    </tbody>
                </table>
            </div>		