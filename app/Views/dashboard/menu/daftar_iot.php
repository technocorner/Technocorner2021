<?= $this->extend('dashboard/template/dashboard_template'); ?>
<?= $this->section('content'); ?>
<?= $this->include('dashboard/template/nav'); ?>
<?= $this->include('dashboard/template/sidebar'); ?>

<div class="content-wrapper" style="min-height: 1643.38px;">


    <div class="content">

        <div class="container">
            <div class="title">
                <h1 class="ftitle">Technocorner 2021</h1>
                <h3 class="fcomp"><?= $lomba['title']; ?></h3>
            </div>
            <form action="<?= base_url('/menu/daftarIot'); ?>" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="">
                        <h5>Data Team</h5>
                    </div>
                    <!-- lomba iot -->
                    <div>
                        <label class="nlabel" for="name">Nama Tim</label>
                    </div>
                    <div>
                        <input type="text" placeholder="..." name="team_name" autocomplete="off" value="<?= old('team_name'); ?>">
                    </div>
                    <?php if (!empty(session()->getFlashdata('errors')['team_name'])) : ?>
                        <div class="validation" style="color: red;">
                            <?= session()->getFlashdata('errors')['team_name'] ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="row">
                    <div>
                        <label class="nlabel" for="name">Asal Instansi</label>
                    </div>
                    <div>
                        <input type="text" placeholder="..." name="institusi" autocomplete="off" value="<?= old('institusi'); ?>">
                    </div>
                    <?php if (!empty(session()->getFlashdata('errors')['institusi'])) : ?>
                        <div class="validation" style="color: red;">
                            <?= session()->getFlashdata('errors')['institusi'] ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="row">
                    <div>
                        <label class="nlabel" for="kontak">Id line - Whatsapp (ex : technocorner - 08123XXXXX)</label>
                    </div>
                    <div>
                        <input type="text" placeholder="..." name="kontak" autocomplete="off" value="<?= old('kontak'); ?>">
                    </div>
                    <?php if (!empty(session()->getFlashdata('errors')['kontak'])) : ?>
                        <div class="validation" style="color: red;">
                            <?= session()->getFlashdata('errors')['kontak'] ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="mt-4">
                    <h5>Data Anggota Team</h5>
                </div>
                <?php if (!empty(session()->getFlashdata('errors')['name.*'])) : ?>
                    <div class="validation" style="color: red;">
                        <?= session()->getFlashdata('errors')['name.*'] ?>
                    </div>
                <?php endif; ?>
                <?php if (!empty(session()->getFlashdata('errors')['ktm.*'])) : ?>
                    <div class="validation" style="color: red;">
                        <?= session()->getFlashdata('errors')['ktm.*'] ?>
                    </div>
                <?php endif; ?>
                <?php if (!empty(session()->getFlashdata('errors')['twibbon.*'])) : ?>
                    <div class="validation" style="color: red;">
                        <?= session()->getFlashdata('errors')['twibbon.*'] ?>
                    </div>
                <?php endif; ?>
                <div class="form-ketua">
                    <div class="row">
                        <div>
                            <label class="nlabel" for="name">Nama Ketua Tim</label>
                        </div>
                        <div>
                            <input type="text" placeholder="..." name="name[]" autocomplete="off">
                        </div>
                    </div>
                    <div class="row">
                        <div>
                            <label class="nlabel" for="name">Foto Kartu Tanda Mahasiswa Ketua</label>
                        </div>
                        <div class="col-25">
                            <input type="file" id="upload1-eec" name="ktm[]" autocomplete="off" class="upload-btn"  accept=".jpg, .png, .jpeg">
                            <label class="upbtn" for="upload1-eec">Choose File</label>
                        </div>
                        <div class="col-75">
                            <span class="filechsn" id="fileup1-eec">No file chosen</span>
                        </div>
                    </div>
                    <div class="row">
                        <div>
                            <label class="nlabel" for="name">URL Twibbon</label>
                        </div>
                        <div>
                            <input type="text" placeholder="..." name="twibbon[]" autocomplete="off">
                        </div>
                    </div>
                </div>




                <div class="form-anggota mt-5">
                    <div class="row">
                        <div>
                            <label class="nlabel" for="name">Nama Anggota 1</label>
                        </div>
                        <div>
                            <input type="text" placeholder="..." name="name[]" autocomplete="off">
                        </div>
                    </div>
                    <div class="row">
                        <div>
                            <label class="nlabel" for="name">Foto Kartu Tanda Mahasiswa Anggota</label>
                        </div>
                        <div class="col-25">
                            <input type="file" id="upload2-eec" name="ktm[]" autocomplete="off" class="upload-btn"  accept=".jpg, .png, .jpeg">
                            <label class="upbtn" for="upload2-eec">Choose File</label>
                        </div>
                        <div class="col-75">
                            <span class="filechsn" id="fileup2-eec">No file chosen</span>
                        </div>
                    </div>
                    <div class="row">
                        <div>
                            <label class="nlabel" for="name">URL Twibbon</label>
                        </div>
                        <div>
                            <input type="text" placeholder="..." name="twibbon[]" autocomplete="off">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <button class="btn btn-warning btn-add">Add</button>
                    <button class="btn btn-danger btn-remove">Remove</button>
                </div>
                <div class="row">
                    <input class="submitbtn" type="submit" value="Submit">
                </div>
            </form>
        </div>

        <script>
            $(document).ready(function() {

                let i = 3;
                $('.btn-add').click(function(e) {
                    e.preventDefault();

                    const form = ` <div class="form-anggota mt-5">
                <div class="row">
                    <div>
                        <label class="nlabel" for="name">Nama Anggota ${i-1}</label>
                    </div>
                    <div>
                        <input type="text" placeholder="..." name="name[]">
                    </div>
                </div>
                <div class="row">
                    <div>
                        <label class="nlabel" for="name">Foto Kartu Tanda Mahasiswa Anggota</label>
                    </div>
                    <div class="col-25">
                        <input type="file" id="upload${i}-eec" name="ktm[]" class="upload-btn"  accept=".jpg, .png, .jpeg">
                        <label class="upbtn" for="upload${i}-eec">Choose File</label>
                    </div>
                    <div class="col-75">
                        <span class="filechsn" id="fileup${i}-eec">No file chosen</span>
                    </div>
                </div>
                <div class="row">
                        <div>
                            <label class="nlabel" for="name">URL Twibbon</label>
                        </div>
                        <div>
                            <input type="text" placeholder="..." name="twibbon[]" autocomplete="off">
                        </div>
                    </div>
            </div>`;
                    if ($('.form-anggota').length) {
                        // $('.form-anggota').last().after(form);
                        $('.form-anggota').last().append(form);
                    } else {
                        $('.form-ketua').last().after(form);
                    }

                    i++;

                    if (i >= 4) {
                        $('.btn-add').attr('hidden', true)
                    }
                });

                $('.btn-remove').click(function(e) {
                    e.preventDefault();
                    $('.form-anggota').last().remove();

                    i--;
                    if (i == 1) {
                        i = 1;
                    }
                    if (i < 4) {
                        $('.btn-add').attr('hidden', false)
                    }
                })

                $(document).on("change", ".upload-btn", function() {
                    $(this).closest('div').next().find('.filechsn').text(this.files[0].name);
                });
            })
        </script>


        <?= $this->endSection(); ?>


        <!DOCTYPE html>


        </body>