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
                  <label for="produk_nama">Nama Produk</label>
                  <input type="text" name="produk_nama" class="form-control <?= form_error('produk_nama') ? 'is-invalid' : ''; ?>" placeholder="Nama Produk" value="<?= set_value('produk_nama') ? set_value('produk_nama') : $produk->produk_nama; ?>">
                  <span class="error invalid-feedback"><?= form_error('produk_nama') ?></span>
                </div>

                <div class="form-group">
                  <label for="kategori">Kategori</label>
                  <select class="form-control <?= form_error('kategori') ? 'is-invalid' : ''; ?>" name="kategori">
                    <?php
                    if (isset($produk->kategori_id)) {
                      foreach ($dataKategori as $kategori) {
                    ?>
                        <option value="<?= $kategori->id; ?>" <?= $produk->kategori_id == $kategori->id ? 'selected' : '' ?>><?= $kategori->kategori_nama; ?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                  <span class="error invalid-feedback"><?= form_error('kategori') ?></span>
                </div>
                <div class="form-group">
                  <label for="satuan">Satuan</label>
                  <select class="form-control <?= form_error('satuan') ? 'is-invalid' : ''; ?>" name="satuan">
                    <?php
                    if (isset($produk->satuan_id)) {
                      foreach ($dataSatuan as $satuan) { ?>
                        <option value="<?= $satuan->id; ?>" <?= $produk->satuan_id == $satuan->id ? 'selected' : '' ?>><?= $satuan->satuan_nama; ?></option>
                    <?php
                      }
                    } ?>
                  </select>
                  <span class="error invalid-feedback"><?= form_error('satuan') ?></span>
                </div>
                <div class="form-group">
                  <label for="harga">Harga</label>
                  <input type="number" name="harga" class="form-control <?= form_error('harga') ? 'is-invalid' : ''; ?>" placeholder="Harga" value="<?= set_value('harga') ? set_value('harga') : $produk->harga; ?>">
                  <span class="error invalid-feedback"><?= form_error('harga') ?></span>
                </div>
                <div class="text-center">
                  <a href="<?= base_url('produk') ?>" class="btn btn-warning">Kembali</a>
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