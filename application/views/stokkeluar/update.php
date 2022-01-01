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

                <input type="hidden" name="produk_id" value="<?= $stokkeluar->produk_id; ?>">

                <div class="form-group">
                  <label for="produk">Nama Produk</label>
                  <input type="text" class="form-control" placeholder="Nama Produk" value="<?= $stokkeluar->produk_nama; ?>" disabled>
                </div>

                <div class="form-group">
                  <label for="harga">Harga (Satuan)</label>
                  <input type="text" class="form-control" placeholder="Harga" value="Rp. <?= rupiah($stokkeluar->harga); ?>" disabled>
                </div>

                <div class="form-group">
                  <label for="jumlah">Jumlah</label>
                  <input type="text" name="jumlah_keluar" class="form-control" placeholder="Jumlah" value="<?= $stokkeluar->jumlah; ?>" disabled>
                </div>

                <div class="form-group">
                  <label for="total_harga">Total Harga</label>
                  <input type="text" class="form-control" placeholder="Total Harga" value="Rp. <?= rupiah($stokkeluar->total_harga); ?>" disabled>
                </div>


                <div class="form-group">
                  <label for="keterangan">Keterangan</label>
                  <textarea class="form-control <?= form_error('keterangan') ? 'is-invalid' : ''; ?>" name="keterangan" rows="4" cols="50" placeholder="Keterangan"><?= set_value('keterangan') ? set_value('keterangan') : $stokkeluar->keterangan; ?></textarea>
                  <span class="error invalid-feedback"><?= form_error('keterangan') ?></span>
                </div>

                <div class="text-center">
                  <a href="<?= base_url('stokkeluar') ?>" class="btn btn-warning">Kembali</a>
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