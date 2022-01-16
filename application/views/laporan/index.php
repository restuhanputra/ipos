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
                  <label for="jenis_laporan">Jenis Laporan</label>
                  <select class="form-control <?= form_error('jenis_laporan') ? 'is-invalid' : ''; ?>" name="jenis_laporan">
                    <option value="">Pilih Jenis Laporan</option>
                    <option value="0">Produk</option>
                    <option value="1">Stok Masuk</option>
                    <option value="2">Stok Keluar</option>
                  </select>
                  <span class="error invalid-feedback"><?= form_error('jenis_laporan') ?></span>
                </div>
                <div class="form-group">
                  <label for="tanggal_awal">Tanggal Awal</label>
                  <div class="input-group date" data-target-input="nearest">
                    <input type="date" class="form-control datetimepicker-input <?= form_error('tanggal_awal') ? 'is-invalid' : ''; ?>" name="tanggal_awal">
                    <span class="error invalid-feedback"><?= form_error('tanggal_awal') ?></span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="tanggal_akhir">Tanggal Akhir</label>
                  <div class="input-group date" data-target-input="nearest">
                    <input type="date" class="form-control datetimepicker-input <?= form_error('tanggal_akhir') ? 'is-invalid' : ''; ?>" name="tanggal_akhir">
                    <span class="error invalid-feedback"><?= form_error('tanggal_akhir') ?></span>
                  </div>
                </div>

                <div class="col-12 text-center">
                  <button type="submit" class="btn btn-primary">Cetak Laporan</button>
                </div>
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