<?= $this->extend('dashboard/template/dashboard_template'); ?>
<?= $this->section('content'); ?>
<?= $this->include('dashboard/template/nav'); ?>
<?= $this->include('dashboard/template/sidebar'); ?>

<div class="content-wrapper" style="min-height: 1643.38px;">

  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Halo, <?= session('name') ?></h1>
        </div>
      </div>
    </div>
  </div>


  <div class="content">
    <div class="container-fluid">
      <div class="row">

        <div class="col-md-12">
          <?= session()->getFlashdata('message') ?>
          <div class="alert alert-warning alert-dismissible">
            <!--<h5>-->
            <!--  <i class="icon fas fa-exclamation-triangle"></i>-->
            <!--  Daftarkan dirimu pada Webinar Nasional Technocorner 2021 yang mengangkat tema <b>"<i>Innovative Technology to Prepare The Post-Pandemic Society</i>"</b>-->
            <!--</h5>-->
            <h5>
              <i class="icon fas fa-exclamation-triangle"></i>
              Segera Daftarkan dirimu di Webinar Nasional!</b>
            </h5>
          </div>
        </div>

        <div class="col-md-12">
          <div class="card card-default">

            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-bullhorn"></i>
                Announcements
              </h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>

            <?php foreach ($pemberitahuan as $p) : ?>
              <div class="card-body">
                <div class="callout callout-info">
                  <h5><?= $p['judul']; ?></h5>
                  <a><?= $p['isi']; ?></a>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>

        <div class="col-md-12">
          <div class="card card-default">

            <div class="card-header">
              <h5 class="card-title">Registered Events</h5>
            </div>

            <div class="card-body">
              <?php if ($lomba) : ?>

                <div class="card card-lomba">
                  <img class="card-img-top events-img" src="<?= base_url('/frontend/images/logo/' . $lomba['image']); ?>" alt="Card image cap">
                  <div class="card-body">
                    <?= $lomba['title']; ?>
                  </div>
                  <div class="card-footer">
                    <a class="btn btn-block bg-gradient-primary" href="<?= base_url('user/profileteam'); ?>">Details</a>
                  </div>
                </div>

              <?php endif ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>