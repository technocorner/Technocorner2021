<?= $this->extend('dashboard/template/dashboard_template'); ?>
<?= $this->section('content'); ?>
<?= $this->include('dashboard/template/nav'); ?>
<?= $this->include('dashboard/template/sidebar'); ?>
    <div class="content-wrapper">
        <div class="container">
            <div class="title">
                <h1 class="ftitle">Technocorner 2021</h1>
                <h2 class="fcomp">Add Member</h2>
                <h3 class="fcomp"><?= $team['team_name'] ?> Team</h3>
            </div>
            <form class="form-horizontal" action="<?= base_url('/user/addMember'); ?>" 
                  method="POST" 
                  enctype="multipart/form-data" 
                  id="saveTeam"
                  style="padding-bottom: 10%">
                <div class="form-group">
                    <div class="row col-sm-12">
                        <label class="nlabel col-sm-12" for="member-name">Nama Anggota</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" placeholder="..." name="team_id" value="<?= $team['id']; ?>" readonly="readonly" hidden />
                            <input type="text" class="form-control member-name" placeholder="..." name="member_name" >
                        </div>
                    </div>
                    <div class="row col-sm-12">
                        <label class="nlabel col-sm-12" for="member_ktm">Foto Kartu Tanda Mahasiswa Anggota</label>
                        <div class="col-sm-12">
                            <div class="col-25">
                                <input type="file" id="choose-file" class="choose-file" id="member_ktm" 
                                accept=".jpg, .png, .jpeg, .pdf"
                                name="member_ktm" autocomplete="off">
                                <label class="upbtn" for="choose-file">Choose File</label>
                            </div>
                            <div class="col-75">
                                <span class="choosen-file">No file chosen</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="save-btn pull-right save col-sm-12">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        $( document ).ready(function() {
            $('title').text('Add Member Team | Technocorner 2021')
            $('head').append( $('<link rel="stylesheet" type="text/css" />').attr('href', "<?= base_url('/frontend/akun/dashboard/events/regist'); ?>/css/form.css") );

            
            $('#saveTeam').on('change', '.choose-file', function() {
                console.log($(this).val())
                $(this).parent().parent().find('.choosen-file').text($(this).val().replace('C:\\fakepath\\',''));              
            });

        });
    </script>
    <script src="<?= base_url('/frontend/akun/dashboard/events/Regist/js'); ?>/details-regist-robotik.js"></script>

<!-- </body> -->

<?= $this->endSection(); ?>