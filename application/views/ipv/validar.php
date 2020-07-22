<div class="container" style="text-align:center; margin-top: 40px;">
    <h2>Encuesta IPV</h2>
    <h4>Ingresa el código de evaluación que recibiste:</h4>
    <p><?php echo $mensaje?></p>
    <div class="row justify-content-center">
        <form action="<?=base_url('ipv/validar')?>" method="post">
            <div class="form-group">
                <input type="text" class="form-control" required="required" name="codigo" style="text-align:center; font-size:25px; font-weight:bold;" placeholder="Código">
            </div>
            <button type="submit" class="btn btn-dark" style="font-size:18px; width:200px">Validar</button>
        </form>
    </div>
</div>