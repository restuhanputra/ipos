<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"><?= $title ?></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active"><?= $title ?></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">

        <!-- col-12 -->
        <div class="col-6">
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
              <form action="" method="POST" enctype="multipart/form-data">

                <div class="form-group">
                  <label for="nip">NIP</label>
                  <input type="number" name="nip" class="form-control" placeholder="NIP" value="<?= $profile->nip; ?>" disabled>
                </div>

                <div class="form-group">
                  <label for="nama">Nama</label>
                  <input type="text" name="nama" class="form-control <?= form_error('nama') ? 'is-invalid' : ''; ?>" placeholder="Nama" value="<?= set_value('nama') ? set_value('nama') : $profile->nama; ?>">
                  <span class="error invalid-feedback"><?= form_error('nama') ?></span>
                </div>

                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" class="form-control <?= form_error('email') ? 'is-invalid' : ''; ?>" placeholder="Email" value="<?= set_value('email') ? set_value('email') : $profile->email; ?>">
                  <span class="error invalid-feedback"><?= form_error('email') ?></span>
                </div>

                <div class="form-group">
                  <label for="role">Role</label>
                  <select class="form-control <?= form_error('role') ? 'is-invalid' : ''; ?>" name="role" disabled>
                    <?php
                    if (isset($profile->role)) {
                      if ($profile->role == 0) {
                    ?>
                        <option value="<?= $profile->role ?>" selected>MEMBER</option>
                        <option value="1">ADMIN</option>
                      <?php
                      } elseif ($profile->role == 1) {
                      ?>
                        <option value="<?= $profile->role ?>" selected>ADMIN</option>
                        <option value="0">MEMBER</option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                  <span class="error invalid-feedback"><?= form_error('role') ?></span>
                </div>

                <div class="form-group">
                  <label for="foto">Upload Foto</label>
                  <br>
                  <?php
                  if (isset($profile->photo)) {
                    $foto = './uploads/users/' . $profile->photo;
                  }
                  ?>
                  <?php
                  if (isset($foto)) {
                  ?>
                    <div class="row ml-1">
                      <p>Foto Lama :</p>
                      <img src=" <?= base_url($foto); ?>" class="img-circle img-thumbnail" alt="User Image" style="height:100px; width:100px;">
                    </div>
                  <?php
                  } else {
                    NULL;
                  }
                  ?>
                  <div class="input-group mt-2">
                    <div class="custom-file">
                      <input type="file" name="foto">
                    </div>
                  </div>
                </div>

                <hr>

                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" name="password" class="form-control <?= form_error('password') ? 'is-invalid' : ''; ?>" placeholder="Password" value="<?= set_value('password') ?>">
                  <span class="error invalid-feedback"><?= form_error('password') ?></span>
                </div>

                <div class="form-group">
                  <label for="password_konfirm">Konfirmasi Password</label>
                  <input type="password" name="password_konfirm" class="form-control <?= form_error('password_konfirm') ? 'is-invalid' : ''; ?>" placeholder="Konfirmasi Password" value="<?= set_value('password_konfirm') ?>">
                  <span class="error invalid-feedback"><?= form_error('password_konfirm') ?></span>
                </div>


                <div class="text-center">
                  <!-- <a href="<? //= base_url('pengguna') 
                                ?>" class="btn btn-warning">Kembali</a> -->
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
              </form>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col-12 -->

      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php if ($this->session->flashdata("success")) : ?>
  <div class="flashdata" data-flashdata="<?= $this->session->flashdata("success"); ?>" data-type="success"></div>
<?php
  usetFlash();
endif; ?>
<?php if ($this->session->flashdata("error")) : ?>
  <div class="flashdata" data-flashdata="<?= $this->session->flashdata("error"); ?>" data-type="error"></div>
<?php
  usetFlash();
endif; ?>