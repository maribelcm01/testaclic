<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="<?=base_url('dashboard');?>">Testalia</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                <?php foreach ($menu as $item): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $item['url'] ?>"><?= $item['title'] ?></a>
                    </li>
                <?php endforeach ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="<?=base_url('');?>"> <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Usuario: <?php echo $this->session->nombre?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=base_url('login/logout')?>">Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>