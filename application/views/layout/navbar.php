<div class="container">
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #7c7e80;">
        <a class="navbar-brand" href="<?=base_url('dashboard');?>"><i class="fas fa-home"></i> Testaclic</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="true" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse show" id="navbarsExampleDefault" style="">
            <ul class="navbar-nav mr-auto">
            <?php foreach ($menu as $item): ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $item['url'] ?>"><?= $item['title'] ?></a>
                </li>
            <?php endforeach ?>
            </ul>
            <div class="my-2 my-lg-0">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user"></i> Usuario <?= $this->session->nombre?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="<?=base_url('login/logout')?>"><i class="fas fa-arrow-left"></i> Cerrar Sesión</a>    
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>