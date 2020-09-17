<div class="container">
    <div class="row justify-content-center m-4">
        <div class="col-md-4">
            <a type="button" class="btn btn-primary" style="margin-top:10px;width:100px" href="<?= base_url('aplicacion/index')?>/<?= $idPersona ?>">Regresar</a>
            <button type="button" class="btn btn-success" style="margin-top:10px;" onclick="Export2Doc('exportContent', '<?= $nombre?>');">Guardar como .doc</button><br>
        </div>
    </div>
    <div class="row justify-content-center m-4" id="exportContent">
            <div class="col-md-6">
                <h4><?= $nombre?></h4>
                <table class="table table-bordered" bordercolor="black" border="1" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Factores de Inteligencia</th>
                            <th>DEF</th>
                            <th>INF</th>
                            <th>TMB</th>
                            <th>TME</th>
                            <th>TMA</th>
                            <th>SUP</th>
                            <th>SOB</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($resultados as $key => $value): ?>
                            <tr>
                                <td><a href="#<?= $value['factor'] ?>"><b><?= $value['serie'] ?>.- <?= $value['factor'] ?></b></a></td>
                                <td>
                                    <!-- <img src="<?= base_url('application/assets/img/rojo.png')?>"> -->
                                    <label class="circulo <?= ($value['cl'] >= 1) ? 'uno' : '' ?>"><span><?= ($value['cl'] >= 1) ? 'X' : '' ?></span></label>
                                </td>
                                <td>
                                    <label class="circulo <?= ($value['cl'] >= 2) ? 'dos' : '' ?>"><span><?= ($value['cl'] >= 2) ? 'X' : '' ?></span></label>
                                </td>
                                <td>
                                    <label class="circulo <?= ($value['cl'] >= 3) ? 'tres' : '' ?>"><span><?= ($value['cl'] >= 3) ? 'X' : '' ?></span></label>
                                </td>
                                <td>
                                    <label class="circulo <?= ($value['cl'] >= 4) ? 'cuatro' : '' ?>"><span><?= ($value['cl'] >= 4) ? 'X' : '' ?></span></label>
                                </td>
                                <td>
                                    <label class="circulo <?= ($value['cl'] >= 5) ? 'cinco' : '' ?>"><span><?= ($value['cl'] >= 5) ? 'X' : '' ?></span></label>
                                </td>
                                <td>
                                    <label class="circulo <?= ($value['cl'] >= 6) ? 'seis' : '' ?>"><span><?= ($value['cl'] >= 6) ? 'X' : '' ?></span></label>
                                </td>
                                <td>
                                    <label class="circulo <?= ($value['cl'] >= 7) ? 'siete' : '' ?>"><span><?= ($value['cl'] >= 7) ? 'X' : '' ?></span></label>
                                </td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        <div class="col-md-3 m-4">
            <table class="table table-bordered" bordercolor="black" border="1" cellspacing="0">
                <thead>
                    <tr>
                        <th scope="2"><label><b>Resultado cuantitativo</b></label></th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td><label>Puntaje Total: <b><?= $total[1]['valor']?></b></label></td></tr>
                    <tr><td><label>C.I. MULTIFUNCIONAL: <b><?= $total[0]['valor']?></b><label></td></tr>
                    <tr><td><label>Nivel de Inteligencia: <b><?= $total[0]['calificacion']?></b><label></td></tr>
                    <tr><td><label>Capacidad de Adaptación: <b><?= $total[0]['calificacion']?></b><label></td></tr>
                    <tr><td><label>Capacidad de Aprendizaje: <b><?= $total[1]['calificacion']?></b><label></td></tr>
                </tbody>
            </table>
            
            
            
            
            
            
        </div>
    </div>
    <div class="row justify-content-center m-4">
        <div class="col-md-10">  
            <table class="table">
                <?php foreach($resultados as $key => $value): ?>
                    <thead class="thead-dark">
                        <tr>
                            <th><a name="<?= $value['factor'] ?>" id="<?= $value['factor'] ?>"><?= $value['serie'] ?>. <?= $value['factor'] ?></a></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $value['interpretacion'] ?></td>
                        </tr>
                    </tbody>
                <?php endforeach;?>
            </table>
        </div>
    </div>
</div>

<script>document.title = "Terman merril";</script>