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
              <form action="" method="POST">
                <div class="form-group">
                  <label for="nama_web">Nama Website</label>
                  <input type="text" name="nama_web" class="form-control <?= form_error('nama_web') ? 'is-invalid' : ''; ?>" placeholder="Nama Website" value="<?= set_value('nama_web') ? set_value('nama_web') : $konfigurasi->nama_web; ?>">
                  <span class="error invalid-feedback"><?= form_error('nama_web') ?></span>
                </div>
                <div class="form-group">
                  <label for="no_telp">No. Telp</label>
                  <input type="number" name="no_telp" class="form-control <?= form_error('no_telp') ? 'is-invalid' : ''; ?>" placeholder="No. Telp" value="<?= set_value('no_telp') ? set_value('no_telp') : $konfigurasi->no_telp; ?>">
                  <span class="error invalid-feedback"><?= form_error('no_telp') ?></span>
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" class="form-control <?= form_error('email') ? 'is-invalid' : ''; ?>" placeholder="Email" value="<?= set_value('email') ? set_value('email') : $konfigurasi->email; ?>">
                  <span class="error invalid-feedback"><?= form_error('email') ?></span>
                </div>
                <div class="form-group">
                  <label for="alamat">Alamat</label>
                  <textarea name="alamat" cols="30" rows="5" class="form-control <?= form_error('alamat') ? 'is-invalid' : ''; ?>"><?= set_value('alamat') ? set_value('alamat') : $konfigurasi->alamat; ?></textarea>
                  <span class="error invalid-feedback"><?= form_error('alamat') ?></span>
                </div>

                <div class="text-center">
                  <!-- <a href="<? //= base_url('nama_web') 
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