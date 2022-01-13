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
                  <label for="supplier">Nama Supplier</label>
                  <input type="text" name="supplier" class="form-control <?= form_error('supplier') ? 'is-invalid' : ''; ?>" placeholder="Nama Supplier" value="<?= set_value("supplier") ? set_value("supplier") : $supplier->nama; ?>">
                  <span class="error invalid-feedback"><?= form_error('supplier') ?></span>
                </div>
                <div class="form-group">
                  <label for="perusahaan">Perusahaan</label>
                  <input type="text" name="perusahaan" class="form-control <?= form_error('perusahaan') ? 'is-invalid' : ''; ?>" placeholder="Perusahaan" value="<?= set_value("perusahaan") ? set_value("perusahaan") : $supplier->perusahaan; ?>">
                  <span class="error invalid-feedback"><?= form_error('perusahaan') ?></span>
                </div>
                <div class="form-group">
                  <label for="no_telp">No. Telepon</label>
                  <input type="number" name="no_telp" class="form-control <?= form_error('no_telp') ? 'is-invalid' : ''; ?>" placeholder=" No. Telepon" value="<?= set_value("no_telp") ?  set_value("no_telp") : $supplier->no_telp; ?>">
                  <span class="error invalid-feedback"><?= form_error('no_telp') ?></span>
                </div>
                <div class="form-group">
                  <label for="alamat">Alamat</label>
                  <textarea class="form-control <?= form_error('alamat') ? 'is-invalid' : ''; ?>" name="alamat" rows="4" cols="50" placeholder="Alamat"><?= set_value('alamat') ? set_value('alamat') : $supplier->alamat; ?></textarea>
                  <span class="error invalid-feedback"><?= form_error('alamat') ?></span>
                </div>
                <div class="text-center">
                  <a href="<?= base_url('stokmasuk') ?>" class="btn btn-warning">Kembali</a>
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