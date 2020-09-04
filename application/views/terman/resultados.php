<div class="container">
    <div class="row justify-content-center m-4">
        <div class="col-md-6">
            <button type="button" class="btn btn-success" onclick="<?= base_url('terman/save_download') ?>" >Guardar como .doc</button>
            <h4><?= $nombre?></h4>
            <table class="table">
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
                                <label class="circulo <?= ($value['cl'] >= 1) ? 'uno' : '' ?>"></label>
                            </td>
                            <td>
                                <label class="circulo <?= ($value['cl'] >= 2) ? 'dos' : '' ?>"></label>
                            </td>
                            <td>
                                <label class="circulo <?= ($value['cl'] >= 3) ? 'tres' : '' ?>"></label>
                            </td>
                            <td>
                                <label class="circulo <?= ($value['cl'] >= 4) ? 'cuatro' : '' ?>"></label>
                            </td>
                            <td>
                                <label class="circulo <?= ($value['cl'] >= 5) ? 'cinco' : '' ?>"></label>
                            </td>
                            <td>
                                <label class="circulo <?= ($value['cl'] >= 6) ? 'seis' : '' ?>"></label>
                            </td>
                            <td>
                                <label class="circulo <?= ($value['cl'] >= 7) ? 'siete' : '' ?>"></label>
                            </td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table> 
        </div>
        <div class="col-md-3 m-4">
            <h5><b>Resultado cuantitativo</b></h5>
            <h6>Puntaje Total: <b><?= $total[1]['valor']?></b></h6>
            <h6>C.I. MULTIFUNCIONAL: <b><?= $total[0]['valor']?></b><h6>
            <h6>Nivel de Inteligencia: <b><?= $total[0]['calificacion']?></b><h6>
            <h6>Capacidad de Adaptación: <b><?= $total[0]['calificacion']?></b><h6>
            <h6>Capacidad de Aprendizaje: <b><?= $total[1]['calificacion']?></b><h6>
        </div>
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