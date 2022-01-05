<?= $this->extend('dashboard/template/dashboard_template'); ?>
<?= $this->section('content'); ?>
<?= $this->include('dashboard/template/nav'); ?>
<?= $this->include('dashboard/template/sidebar'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 700.38px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0"><i><?= $lomba['title']; ?></i></h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12">
                    <div class="card card-default">
                        <div class="card-footer">
                            <!--<?php if (empty($have_team)) : ?>-->
                            <!--    <?php if ($lomba['id'] == 3 || $lomba['id'] == 1) : ?>-->
                            <!--        <a class="btn btn-block bg-gradient-secondary btn-lg disable">Pendaftaran telah ditutup</a>-->
                            <!--    <?php elseif (($lomba['id'] == 1 && $total['jumlah'] >= 150) || ($lomba['id'] == 2 && $total['jumlah'] >= 65) ) : ?>-->
                            <!--        <a class="btn btn-block bg-gradient-secondary btn-lg disable">Jumlah pendaftar telah memenuhi batas</a>-->
                            <!--    <?php else : ?>-->
                            <!--    <a class="btn btn-block bg-gradient-primary btn-lg" href="<?= base_url('/' . $lomba['daftar_url']); ?>">Daftar</a>-->
                            <!--    <? endif ?>-->
                            <!--<?php else : ?>-->
                            <!--    <a class="btn btn-block bg-gradient-secondary btn-lg disable" >Anda telah mendaftar</a>-->
                            <!--<?php endif; ?>-->
                            <?php if ($lomba['id'] == 4) : ?>
                               <a class="btn btn-block bg-gradient-secondary btn-lg disable" href="<?= base_url('/' . $lomba['daftar_url']); ?>">Pendaftaran telah ditutup</a>
                            <?php else :?>
                                <a class="btn btn-block bg-gradient-secondary btn-lg disable">Pendaftaran telah ditutup</a>
                            <?php endif; ?>
                        </div>
                        <!-- /.card-footer-->
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card card-default">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8 col-12 order-md-1
                                order-2">
                                    <!-- Default box -->
                                    <div class="card justify-content-center align-items-center">
                                        <div class="card-body justify-content-center align-items-center">
                                            <p>
                                                <?= $lomba['deskripsi']; ?>
                                            </p>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                                </div>

                                <div class="col-md-4 col-12 order-md-2 order-1">
                                    <!-- Default box -->
                                    <div class="justify-content-center align-items-center d-flex">
                                        <div class="image">
                                            <img src="<?= base_url('/frontend/images/logo/' . $lomba['image']); ?>" class="events-img" alt="User Image">
                                        </div>
                                    </div>
                                    <!-- /.card -->
                                </div>
                                <!-- /.col-4 -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- ./card-body -->
                    </div>
                    <!-- /.col-md-12 -->
                </div>
                <!-- /.card-body -->


                <!-- row -->

            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-default kategori">
                        <div class="card-header">
                            <h3 class="card-title">Kategori</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <h4><?= $kategori['kategori_header']; ?></h4>
                            <h5><?= $kategori['kategori_detail']; ?></h5>
                        </div>
                        <!-- ./card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col-md-6 -->

                <div class="col-md-6">
                    <div class="card card-default kontak">
                        <div class="card-header">
                            <h3 class="card-title">Kontak</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <?php foreach ($kontak as $k) : ?>
                                <div class="kontak-item">
                                    <h4><?= $k['nama_kontak']; ?></h4>
                                    <h5>Line : <?= $k['kontak_line']; ?></h5>
                                    <h5>Whatsapp : <?= $k['kontak_wa']; ?></h5>
                                </div>

                            <?php endforeach ?>
                        </div>
                        <!-- ./card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col-md-6 -->

                <div class="col-md-6">
                    <div class="card card-default agenda">
                        <div class="card-header">
                            <h3 class="card-title">Agenda</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body agenda-content">
                            <?php foreach ($agenda as $a) : ?>
                                <div class="agenda-item">
                                    <h5><?= $a['nama_agenda']; ?></h5>
                                    <h3><?= $a['jadwal_agenda']; ?></h3>
                                </div>
                            <?php endforeach; ?>

                        </div>
                        <!-- ./card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col-md-6 -->

                <div class="col-md-6">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Petunjuk Lomba</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <a href="<?= $lomba['petunjuk_lomba']; ?>" target="_blank">
                                <h3 class="card-title">Petunjuk Lomba </h3>
                            </a>
                        </div>
                        <? if($petunjuk['arena'] != ''){ ?>
                        <div class="card-body" style="display: grid;">
                            <a href="<?= $petunjuk['arena']; ?>" target="_blank">
                                <h3 class="card-title"><?= $petunjuk['teks1']; ?></h3>
                            </a>
                        </div>
                        <? } ?>
                        <? if($petunjuk['twibbon'] != ''){ ?>
                        <div class="card-body" style="display: grid;">
                            <a href="<?= $petunjuk['twibbon']; ?>" target="_blank">
                                <h3 class="card-title"><?= $petunjuk['teks2']; ?></h3>
                            </a>
                        </div>
                        <? } ?>
                        <? if($petunjuk['teknis'] != ''){ ?>
                        <div class="card-body" style="display: grid;">
                            <a href="<?= $petunjuk['teknis']; ?>" target="_blank">
                                <h3 class="card-title"><?= $petunjuk['teks3']; ?></h3>
                            </a>
                        </div>
                        <? } ?>
                        <? if($petunjuk['kisi'] != ''){ ?>
                        <div class="card-body" style="display: grid;">
                            <a href="<?= $petunjuk['kisi']; ?>" target="_blank">
                                <h3 class="card-title"><?= $petunjuk['teks4']; ?></h3>
                            </a>
                        </div>
                        <? } ?>
    
                        <!-- ./card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col-md-6 -->
                
                 <div class="col-md-6">
                    <div class="card card-default rekening">
                        <div class="card-header">
                            <h3 class="card-title">Harga Pendaftaran</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="display: block;>
                            <h4 style = "font-size: 20px"><?= $rekening['harga_pendaftaran']; ?></h4>
                            <h5 style = "font-size: 15px"><?= $rekening['no_rekening']; ?></h5>
                        </div>
                        <!-- ./card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col-md-6 -->
                
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
<?= $this->endSection(); ?>