<nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">


        <li class="nav-item">
            <div class="user-panel mt-1 pb-1 mb-1 d-flex">
                <div class="image">
                    <img src="<?= base_url('/uploads/user/' . session('image')); ?>" class="img-circle elevation-2" alt="User Image" style="width: 35px; height: 35px;">
                </div>
                <div class="info">
                    <a href="<?= base_url('menu/profile'); ?>" class="d-block"><?= session('name'); ?></a>
                </div>
            </div>
        </li>

    </ul>
</nav>