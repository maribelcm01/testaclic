<div class="container" style="text-align:center; margin-top: 40px;">
    <p class="text-primary" style="font-size: 30px;">Encuesta vida</p>
    <p>Ingresa el código de evaluación que recibiste:</p>
    <?php echo $mensaje?>
    <div class="row justify-content-center">
        <form action="<?=base_url('vida/validar')?>" method="post">
            <div class="form-group">
                <input type="text" class="form-control" required="required" name="codigo" style="text-align:center;" placeholder="Código">
            </div>
            <button type="submit" class="btn btn-dark" style="font-size: 15px; width: 200px">Validar <i class="fas fa-check"></i></button>
        </form>
    </div>
</div>