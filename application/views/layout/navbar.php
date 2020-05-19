<div class="container mt40">
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #7c7e80;">
        <a class="navbar-brand" href="<?=base_url('dashboard');?>"><i class="fas fa-home"></i> Testalia</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
            <?php foreach ($menu as $item): ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $item['url'] ?>"><?= $item['title'] ?></a>
                </li>
            <?php endforeach ?>
                <li class="nav-item active">
                    <a class="nav-link" href="<?=base_url('');?>"> <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user"></i> Usuario <?php echo $this->session->nombre?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="<?=base_url('login/logout')?>"><i class="fas fa-arrow-left"></i> Cerrar Sesión</a>    
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>