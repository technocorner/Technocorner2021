<?= $this->extend('dashboard/template/dashboard_template'); ?>
<?= $this->section('content'); ?>
<?= $this->include('dashboard/template/nav'); ?>
<?= $this->include('dashboard/template/sidebar'); ?>

<div class="content-wrapper" style="min-height: 700.38px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Edit Profile</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h5>Profile Team</h5>
                    </div>
                    <hr>
                    <div class="card-content">
                        <p>sdasdasd</p>
                    </div>
                </div>

            </div>
            <!-- /.content-wrapper -->
        </div>
    </div>
</div>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->


<style>
    .kv-avatar {
        display: inline-block;
        margin-left: 40%;
    }

    #image-preview {
        height: 200px;
        width: 200px;
    }
</style>

<!--preview foto profil. sumber: https://agung-setiawan.com/preview-image-before-upload/-->
<script>
    function previewImage() {
        document.getElementById("image-preview").style.display = "block";
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("image-source").files[0]);

        oFReader.onload = function(oFREvent) {
            document.getElementById("image-preview").src = oFREvent.target.result;
        };
    };
</script>

<?= $this->endSection(); ?>