<?= $this->extend('dashboard/template/dashboard_template'); ?>
<?= $this->section('content'); ?>
<?= $this->include('dashboard/template/nav'); ?>
<?= $this->include('dashboard/template/sidebar'); ?>

<!-- <!DOCTYPE html> -->
<!-- 
<head>
    <meta charset="utf=8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?= base_url('/frontend/akun/dashboard/events/regist'); ?>/css/form.css">
    <title>Regist Details - Transporter | Technocorner 2021</title>
    <style>
        .kv-avatar {
            display: inline-block;
            margin-left: 40%;
        }

        #image-preview {
            height: 200px;
            width: 200px;
        }

        .input-image {
            margin-top: 10px;
        }
    </style>
</head>

<title>test</title> -->
<!-- <body> -->
<div class="content-wrapper">
    <div class="container">
        <div class="title">
            <h1 class="ftitle">Technocorner 2021</h1>
            <h2 class="fcomp">Registration Details</h2>
            <h3 class="fcomp"><?= $lomba['title']; ?></h3>
        </div>
        <form class="form-horizontal" action="<?= base_url('/user/profileteam'); ?>" method="POST" enctype="multipart/form-data" id="saveTeam" style="padding-bottom: 10%">
            <div class="form-group">
                <label for="nama-perwakilan" class="col-sm-12 control-label">Nama Tim</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" name="team_id" value="<?= $team['id']; ?>" readonly="readonly" hidden>
                    <input type="text" class="form-control" id="nama-perwakilan" name="team_name" value="<?= $team['team_name']; ?>" readonly="readonly">
                </div>
            </div>
            <div class="form-group">
                <label for="asal-instansi" class="col-sm-12 control-label">Asal Instansi</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="asal-instansi" name="institusi" value="<?= $team['institusi']; ?>" readonly="readonly">
                </div>
            </div>
            <div class='col-sm-12'>
                <label class="nlabel" for="bukti-bayar" <?= ($lomba['nama_lomba'] == 'iot') ? 'style="display: none;"' : '' ?>>Status Pembayaran: Bukti pembayaran <?= $team['image_payment'] ? 'SUDAH' : 'BELUM' ?> diupload dan <?= ($team['is_paid'] == 0) ? 'BELUM' : 'SUDAH'  ?> dikonfirmasi</label>
                <?php if ($team['is_paid'] == 0) : ?>
                    <div class="row col-sm-12" <?= ($lomba['nama_lomba'] == 'iot') ? 'style="display: none;"' : '' ?>>
                        <div>
                            <label class="nlabel" for="bukti-bayar">Upload Bukti Pembayaran <br> (378701041199532 an Agustina Asmoro Putri - <?= ($lomba['nama_lomba'] == 'iot') ? '' : 'Rp 50.000' ?>)</label>
                            
                        </div>
                        <div class="col-25">
                            <input type="file" id="pilih-bukti-upload" class="pilih-bukti-upload" name="bukti" autocomplete="off" accept=".jpg, .png, .jpeg, .pdf">
                            <label class="upbtn" for="pilih-bukti-upload">Choose File</label>
                        </div>
                        <div class="col-75">
                            <span class="bukti-upload">No file chosen</span>
                        </div>
                    </div>
                    <?php if (!empty(session()->getFlashdata('errors')['bukti'])) : ?>
                        <div class="validation" style="color: red;">
                            <?= session()->getFlashdata('errors')['bukti'] ?>
                        </div>
                    <?php endif; ?>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" class="edit-btn pull-right" id="edit" onclick="handleEdit()">Edit</button>

                            <button type="save" class="save-btn pull-right" id="save" hidden>Save</button>
                             <button type="button" class="btn btn-danger cancel-btn pull-right" id="cancel">Cancel Registration</button>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </form>
        <?php if ($team['is_paid'] == 0) : ?>
            <form id="saveAnggota-0" class="member-0" style="padding-bottom: 10%">
                <div class="form-group">
                    <div class="row col-sm-12">
                        <label class="nlabel col-sm-12" for="member-name">Nama Ketua</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" placeholder="..." name="team_id" value="<?= $member_team[0]['team_id']; ?>" readonly="readonly" hidden />
                            <input type="text" class="form-control" placeholder="..." name="member_id" value="<?= $member_team[0]['member_id']; ?>" readonly="readonly" hidden />
                            <input type="text" class="form-control member-name" placeholder="..." name="member_name" value="<?= $member_team[0]['name']; ?>" readonly="readonly">
                        </div>
                    </div>
                    <div class="row col-sm-12">
                        <label class="nlabel col-sm-12" for="member-name">Link Twibbon</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control member-name" placeholder="..." name="member_image" value="<?= $member_team[0]['image']; ?>" readonly="readonly">
                        </div>
                    </div>
                    <div class="row col-sm-12">
                        <label class="nlabel col-sm-12" for="member_ktm">Foto Kartu Tanda Mahasiswa Anggota</label>
                        <div class="col-sm-12">
                            <div class="col-25">
                                <input type="file" id="choose-file-0" class="choose-file-0" id="member_ktm-0" accept=".jpg, .png, .jpeg, .pdf" name="member_ktm" autocomplete="off">
                                <label class="upbtn" for="choose-file-0">Choose File</label>
                            </div>
                            <div class="col-75">
                                <span class="choosen-file-0">No file chosen</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" class="edit-btn pull-right edit">Edit</button>
                            <!-- <button type="button" class="edit-btn pull-right btn-danger delete">delete</button> -->
                            <button type="submit" class="save-btn pull-right save" hidden>Save</button>
                            <span class="loading" hidden>loading . . .</span>
                        </div>
                    </div>
                </div>
            </form>
            <div>
                <button onclick="location.href = '<?= base_url('/user/addMember'); ?>'" id="addMember"> Tambah Anggota </button>
            </div>
        <?php endif; ?>
        <span class="section-bawah-dummy" />
    </div>
</div>

<script>
    $(document).ready(function() {
        // Cancel registration
        $('#cancel').click(function() {
            var userId = <?= session('id'); ?>;
            var teamId = <?= $team['id']; ?>;
            var ktmMember = [];

            <?php foreach ($member_team as $key => $val) : ?>
                ktmMember.push("<?= $val['ktm']; ?>")
            <?php endforeach; ?>

            var imagePayment = "<?= (!empty($team['image_payment'])) ? $team['image_payment'] : 'nuly'; ?>"
            var url = "<?= base_url('/user/deleteTeam') ?>";
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    "imagePayment": imagePayment,
                    "userId": userId,
                    "teamId": teamId,
                    "ktmMember": ktmMember
                },
                success: function(data) {
                    window.location.href = "<?= base_url("/menu/dashboard"); ?>";
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    // alert(xhr.status);
                    alert(thrownError);
                    console.log(url);
                }
            })
        })
        //==============
        
        $('title').text('Profile Team | Technocorner 2021')
        $('head').append($('<link rel="stylesheet" type="text/css" />').attr('href', "<?= base_url('/frontend/akun/dashboard/events/regist'); ?>/css/form.css"));

        $('#saveTeam').on('change', '.pilih-bukti-upload', function() {
            console.log($(this).val())
            $(this).parent().parent().find('.bukti-upload').text($(this).val().replace('C:\\fakepath\\', ''));
        });


        console.log("ready!");
        var member = <?php echo json_encode($member_team) ?>;
        if (member.length >= 3) {
            $('#addMember').remove()
        }

        var i;
        var urlEdit = "<?= base_url('/user/editMemberTeam') ?>";
        for (i = 1; i < <?= count($member_team) ?>; i++) {
            const form = `<form id="saveAnggota-${i}" class="member-${i}" style="padding-bottom: 10%">
                    <div class="form-group">
                        <div class="row col-sm-12">
                            <label class="nlabel col-sm-12" for="member-name">Nama Anggota</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" placeholder="..." name="team_id" value="${member[i]['team_id']}" readonly="readonly" hidden/>
                                <input type="text" class="form-control" placeholder="..." name="member_id" value="${member[i]['member_id']}" readonly="readonly" hidden/>
                                <input type="text" class="form-control member" placeholder="..." name="member_name" value="${member[i]['name']}" readonly="readonly" >
                            </div>
                        </div>
                        <div class="row col-sm-12">
                        <label class="nlabel col-sm-12" for="member-name">Link Twibbon</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control member-name" placeholder="..." name="member_image" value="${member[i]['image']}" readonly="readonly">
                        </div>
                    </div>
                        <div class="row col-sm-12">
                            <label class="nlabel col-sm-12" for="member_ktm">Foto Kartu Tanda Mahasiswa Anggota</label>
                            <div class="col-sm-12">
                                <div class="col-25">
                                    <input type="file" id="choose-file-${i}" class="choose-file-${i}" id="member_ktm-0" 
                                    accept=".jpg, .png, .jpeg, .pdf"
                                    name="member_ktm" autocomplete="off">
                                    <label class="upbtn" for="choose-file-${i}">Choose File</label>
                                </div>
                                <div class="col-75">
                                    <p class="choosen-file">No file chosen</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="button" class="edit-btn pull-right edit">Edit</button>
                                <button type="button" class="edit-btn pull-right btn-danger delete">delete</button>
                                <button type="submit" class="save-btn pull-right save" hidden>Save</button>
                                <span class="loading" hidden>loading . . .</span>
                            </div>
                        </div>
                    </div>
                </form>`;
            $(`.member-${i-1}`).last().after(form);

            $('#saveAnggota-' + i).on('change', '.choose-file-' + i, function() {
                $(this).parent().parent().find('.choosen-file').text($(this).val().replace('C:\\fakepath\\', ''));
            });

            $('#saveAnggota-' + i).on('click', `.edit`, function() {
                $(this).parent().parent().parent().find(`.member`).attr("readonly", false);
                $(this).parent().parent().parent().find(`.member-name`).attr("readonly", false);
                $(this).parent().find(`.member`).attr("hidden", true);
                $(this).parent().find(`.edit`).attr("hidden", true);
                $(this).parent().find(`.save`).attr("hidden", false);
            });

            $('#saveAnggota-' + i).on('click', `.delete`, function() {
                var self = this
                var team_data = $(this).parent().parent().parent().parent().serialize();
                var urlEdit = "<?= base_url('/user/deleteMemberTeam') ?>";
                if (confirm('Are you sure?') == true) {
                    console.log('delete')
                    $(this).find(`.loading`).attr("hidden", false);
                    $.ajax({
                        url: urlEdit,
                        type: "POST",
                        data: team_data,
                        success: function(data) {
                            alert('succes');
                            $(self).parent().parent().parent().parent().remove();

                            if ($('#addMember').html() == undefined) {
                                const button = `
                                        <div>
                                            <button onclick="location.href = '<?= base_url('/user/addMember'); ?>'" 
                                                    id="addMember"> 
                                                Tambah Anggota 
                                            </button>
                                        </div>`

                                $(`.section-bawah-dummy`).last().before(button);
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            $(self).find(`.loading`).attr("hidden", true);
                            // alert(xhr.status);
                            alert(thrownError);
                        }
                    });
                }
            });

            $(`#saveAnggota-${i}`).submit(function(e) {
                e.preventDefault();
                //     // var index = $(this).find('#index').val()
                $(this).find(`.member`).attr("readonly", false);
                $(this).find(`.loading`).attr("hidden", false);
                var self = this
                // var team_data = $(this).serialize();
                // console.log()
                var formData = new FormData(this);
                var urlEdit = "<?= base_url('/user/editMemberTeam') ?>";
                $.ajax({
                    url: urlEdit,
                    type: "POST",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        alert('succes')
                        $(self).find('.choosen-file').text('No file chosen')
                        $(self).find(`.member`).attr("readonly", true);
                        $(self).find(`.member-name`).attr("readonly", true);
                        $(self).find(`.loading`).attr("hidden", true);
                        $(self).find(`.edit`).attr("hidden", false);
                        $(self).find(`.save`).attr("hidden", true);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $(self).find(`.loading`).attr("hidden", true);
                        // alert(xhr.status);
                        alert(thrownError);
                    }
                });
            });

        }

        $('#saveAnggota-0').on('click', '.edit', function() {
            $(this).closest('#saveAnggota-0').find(`.member-name`).attr("readonly", false);
            $(this).closest('#saveAnggota-0').find(`.save`).attr("hidden", false);
            $(this).closest('#saveAnggota-0').find(`.edit`).attr("hidden", true);
        });

        $("#saveAnggota-0").submit(function(e) {
            e.preventDefault();
            // var index = $(this).find('#index').val()
            $(this).find(`.member-name`).attr("readonly", true);
            $(this).find(`.loading`).attr("hidden", false);
            var self = this
            // var team_data = $(this).serialize();
            // console.log()
            var formData = new FormData(this);
            var urlEdit = "<?= base_url('/user/editMemberTeam') ?>";
            $.ajax({
                url: urlEdit,
                type: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    alert('succes')
                    $(self).find('.choosen-file').text('No file chosen')
                    $(self).find(`.loading`).attr("hidden", true);
                    $(self).find(`.member`).attr("readonly", true);
                    $(self).find(`.edit`).attr("hidden", false);
                    $(self).find(`.save`).attr("hidden", true);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $(self).find(`.loading`).attr("hidden", true);
                    // alert(xhr.status);
                    alert(thrownError);
                }
            });
        });

        $('#saveAnggota-0').on('change', '.choose-file-0', function() {
            $(this).parent().parent().find('.choosen-file-0').text($(this).val().replace('C:\\fakepath\\', ''));
        });

    });

    function previewImage() {
        document.getElementById("image-preview").style.display = "block";
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("image-source").files[0]);

        oFReader.onload = function(oFREvent) {
            document.getElementById("image-preview").src = oFREvent.target.result;
            $('fileup')
        };
    };
</script>
<script src="<?= base_url('/frontend/akun/dashboard/events/Regist/js'); ?>/details-regist-robotik.js"></script>

<!-- </body> -->

<?= $this->endSection(); ?>