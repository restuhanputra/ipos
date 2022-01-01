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

                <input type="hidden" name="stok_masuk_id" id="stok_masuk_id">

                <div class="form-group">
                  <label for="produk_id">Produk</label>
                  <select id="selectPlugin" class="form-control <?= form_error('produk_id') ? 'is-invalid' : ''; ?>" name="produk_id" id="produk_id" onchange="return autofill_stokkeluar(this.value)">
                    <option value="">Pilih Produk</option>
                    <?php foreach ($dataProduk as $produk) { ?>
                      <option value="<?= $produk->id; ?>"><?= $produk->produk_nama; ?></option>
                    <?php } ?>
                  </select>
                  <span class="error invalid-feedback"><?= form_error('produk_id') ?></span>
                </div>

                <div class="form-group">
                  <label for="harga">Harga</label>
                  <input type="text" name="harga" id="harga" class="form-control" placeholder="Harga" disabled>
                  <input type="hidden" id="harga_hidden">
                </div>

                <div class="form-group">
                  <label for="jumlah_masuk">Jumlah Stok</label>
                  <input type="number" name="jumlah_masuk" id="jumlah_masuk" class="form-control" placeholder="Jumlah Stok" disabled>
                </div>

                <div class="form-group">
                  <label for="jumlah_keluar">Jumlah</label>
                  <input type="number" name="jumlah_keluar" id="jumlah_keluar" class="form-control <?= form_error('jumlah_keluar') ? 'is-invalid' : ''; ?>" placeholder="Jumlah" value="<?= set_value('jumlah_keluar') ?>" onkeyup="validateNumber()" onkeydown="javascript: return event.keyCode === 8 || event.keyCode === 46 && !event.key == ' ' ? true : !isNaN(Number(event.key))">
                  <span class="error invalid-feedback"><?= form_error('jumlah_keluar') ?></span>
                </div>

                <div class="form-group">
                  <label for="jumlah_harga">Jumlah Harga</label>
                  <input type="number" name="jumlahHarga" id="jumlahHarga" class="form-control" placeholder="Jumlah Harga" disabled>
                </div>

                <div class="form-group">
                  <label for="keterangan">Keterangan</label>
                  <textarea class="form-control <?= form_error('keterangan') ? 'is-invalid' : ''; ?>" name="keterangan" rows="4" cols="50" placeholder="Keterangan"><?= set_value('keterangan') ?></textarea>
                  <span class="error invalid-feedback"><?= form_error('keterangan') ?></span>
                </div>

                <div class="text-center">
                  <a href="<?= base_url('stokkeluar') ?>" class="btn btn-warning">Kembali</a>
                  <button type="submit" id="submit_stokkeluar" class="btn btn-primary">Simpan</button>
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