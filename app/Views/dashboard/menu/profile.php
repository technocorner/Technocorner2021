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

          <?= $validation->getError('image_profile'); ?>
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
            <div class="card-body">
              <div class="row">

                <div class="col-4">
                  <!-- Default box -->
                  <div class="align-items-center d-block">
                    <div class="image">
                      <img id="image-preview" src="<?= base_url('/uploads/user/' . $user['image']); ?>" class="img-circle elevation-2" alt="User Image">

                    </div>
                  </div>
                  <!-- /.card -->
                </div>
                <!-- /.col-4 -->
              </div>
              <!-- /.row -->
            </div>
            <!-- ./card-body -->

            <!--??? ini untuk milih foto profile tapi gak mudeng tolong script sama css nya ada di paling bawah-->
            <form action="<?= base_url('/menu/profile'); ?>" method="post" enctype="multipart/form-data">
              <div class="card-footer">
                <div class="kv-avatar">

                  <input id="image-source" onchange="previewImage()" type="file" name="image">
                  <div class="validation" style="color: red;">
                    <?= session()->getFlashdata('errors')['image'] ?>
                  </div>

                </div>

              </div>


          </div>
          <!-- /.col-md-12 -->

          <div class=" col-md-12">
            <div class="card card-default">

              <div class="card-body">

                <div class="col-lg-6 col-12">

                  <label class="label" style="display:flex;margin-top: 0.5rem;">Full Name</label>
                  <div><input type="text" class="form-control" placeholder="Nama Lengkap" value="<?= $user['name']; ?>" name="name" autocomplete="off" style="min-width: 240px"></div>

                  <div class="">
                    <label class="label" style="display:flex;margin-top: 0.5rem;">Email</label>
                    <div><input type="text" class="form-control" placeholder="Email" value="<?= $user['email']; ?>" name="email" readonly="readonly" autocomplete="off" style="min-width: 240px"></div>

                    <div class="">
                      <label class="label" style="display:flex;margin-top: 0.5rem;">Asal Kampus</label>
                      <div><input type="text" class="form-control" placeholder="Asal Kampus" value="<?= $user['asal_kampus']; ?>" name="asal_kampus" autocomplete="off" style="min-width: 240px"></div>


                      <div class="mt-5 text-center"><button class="btn btn-primary" type="submit">Save Profile</button></div>

                    </div>
                    <!-- ./card-body -->
                    </form>

                  </div>
                  <!-- /.card -->
                </div>
                <!-- /.col-md-6 -->


              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.row -->
          </div>
          </form>

          <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
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