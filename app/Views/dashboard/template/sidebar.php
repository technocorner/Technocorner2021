<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="<?= base_url('/menu/dashboard') ?>" class="brand-link">
        <img src="<?= base_url('/'); ?>/assets/images/LOGO.png" alt="Technocorner Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text">Technocorner 2021</span>
    </a>


    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <?php $uri = service('uri');
                $url = $uri->getSegment(1) . $uri->getSegment(2) . $uri->getSegment(3); ?>
                <?php foreach ($menu as $m) : ?>
                    <li class="nav-item menu-open">
                        <a href="<?= base_url($m['url']); ?>" class="nav-link <?= (str_replace('/', '', $m['url']) == $url) ? 'active' : '' ?>">
                            <i class="<?= $m['icon']; ?>"></i>
                            <p><?= $m['title']; ?></p>
                        </a>
                    </li>
                <?php endforeach; ?>
                <?php if (session('role_id') == 2) : ?>
                    <li class="nav-item">

                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-trophy"></i>
                            <p>
                                Events Registration
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="<?= base_url('/menu/competition/linefollower'); ?>" class="nav-link <?= ($url == "menucompetitionlinefollower") ? "active" : ""; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Line Follower</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?= base_url('/menu/competition/transporter'); ?>" class="nav-link <?= ($url == "menucompetitiontransporter") ? "active" : ""; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Transporter</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?= base_url('/menu/competition/eec'); ?>" class="nav-link <?= ($url == "menucompetitioneec") ? "active" : ""; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>EEC</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?= base_url('/menu/competition/iot'); ?>" class="nav-link <?= ($url == "menucompetitioniot") ? "active" : ""; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>IoT Dev</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?= base_url('/menu/event/workshop'); ?>" class="nav-link <?= ($url == "menueventworkshop") ? "active" : ""; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Workshop</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?= base_url('/menu/event/webinar'); ?>" class="nav-link <?= ($url == "menueventwebinar") ? "active" : ""; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Webinar Nasional</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a href="<?= base_url('/auth/logout'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>
                    </a>

                </li>
            </ul>
        </nav>
    </div>
</aside>