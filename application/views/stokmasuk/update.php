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
                  <label for="no_transaksi">No Transakasi</label>
                  <input type="text" name="no_transaksi" class="form-control" placeholder="No Transakasi" value="<?= $stokmasuk->no_transaksi; ?>" readonly>
                </div>

                <div class="form-group">
                  <label for="produk">Nama Produk</label>
                  <input type="text" name="produk" class="form-control" placeholder="Nama Produk" value="<?= $stokmasuk->produk_nama; ?>" disabled>
                </div>

                <div class="form-group">
                  <label for="jumlah">Jumlah</label>
                  <input type="number" name="jumlah" class="form-control <?= form_error('jumlah') ? 'is-invalid' : ''; ?>" placeholder="Jumlah" value="<?= set_value('satuan') ? set_value('satuan') : $stokmasuk->jumlah; ?>">
                  <span class="error invalid-feedback"><?= form_error('jumlah') ?></span>
                </div>


                <div class="form-group">
                  <label for="supplier">Nama Supplier</label>
                  <input type="text" name="supplier" class="form-control <?= form_error('supplier') ? 'is-invalid' : ''; ?>" placeholder="Nama Supplier" value="<?= set_value('satuan') ? set_value('supplier') : $stokmasuk->supplier_nama; ?>" readonly>
                  <span class="error invalid-feedback"><?= form_error('supplier') ?></span>
                </div>

                <div class="form-group">
                  <label for="keterangan">Keterangan</label>
                  <textarea class="form-control <?= form_error('keterangan') ? 'is-invalid' : ''; ?>" name="keterangan" rows="4" cols="50" placeholder="Keterangan"><?= set_value('keterangan') ? set_value('keterangan') : $stokmasuk->keterangan; ?></textarea>
                  <span class="error invalid-feedback"><?= form_error('keterangan') ?></span>
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