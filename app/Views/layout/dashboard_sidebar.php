<h2>Halo <?= session('name'); ?></h2>
<a href="<?= base_url('/auth/logout'); ?>">Logout</a>
<ul>
    <li><a href="<?= base_url('/admin/'); ?>"> Home </a></li>
    <li> Menu
        <ul>
            <li><a href="<?= base_url('/admin/menu/manageUser'); ?>"> Manage User </a></li>
            <li><a href="<?= base_url('/admin/menu/manageTeam'); ?>"> Manage Team </a></li>
            <li><a href="<?= base_url('/admin/menu/managePemberitahuan'); ?>"> Manage Pemberitahuan </a></li>
            <!--  -->
        </ul>
    </li>
</ul>
<br />