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
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">
                <a href="<?= base_url('stokmasuk/add') ?>" class="btn btn-primary">Tambah Data</a>
                <a href="<?= base_url('laporan') ?>" class="btn btn-success ml-1">Laporan</a>
              </h3>
            </div>
            <!-- /.card-header -->
            <style>
              table th {
                text-align: center;
              }
            </style>
            <div class="card-body">
              <table class="table table-striped table-bordered table-hover tabel" style="width:100%">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Jumlah Total</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i = 1;
                  foreach ($dataProduk as $produk) :
                  ?>
                    <tr>
                      <td style="text-align: center;"><?= $i++; ?></td>
                      <td>
                        <?= $produk->produk_nama; ?>
                      </td>
                      <td style="text-align: center;"><?= getCountByKategori($produk->id); ?> &nbsp; <?= $produk->satuan_nama; ?></td>
                    </tr>
                  <?php endforeach;
                  ?>
                </tbody>
              </table>

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col-12 -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- col-12 -->
        <div class="col-12">
          <div class="card">
            <style>
              table th {
                text-align: center;
              }
            </style>
            <div class="card-body">
              <p>
              <h5 class="fw-bold">Aktivitas</h5>
              </p>
              <table id="example" class="table table-striped table-bordered table-hover" style="width:100%">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>No Transaksi</th>
                    <th>Nama Produk</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Supplier</th>
                    <th>Tanggal</th>
                    <?php if ($this->session->userdata("role") == 1) {
                    ?>
                      <th>User</th>
                    <?php } ?>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i = 1;
                  foreach ($dataStokmasuk as $stokmasuk) :
                  ?>
                    <tr>
                      <td style="text-align: center;"><?= $i++; ?></td>
                      <td style="text-align: center;"><?= $stokmasuk->no_transaksi; ?></td>
                      <td>
                        <a href="<?= base_url('produk/edit/' . $stokmasuk->produk_id); ?>">
                          <?= $stokmasuk->produk_nama; ?>
                        </a>
                      </td>
                      <td style="text-align: center;"><?= $stokmasuk->jumlah; ?> &nbsp; <?= $stokmasuk->satuan_nama; ?></td>
                      <td>Rp. <?= rupiah($stokmasuk->harga); ?></td>
                      <td>
                        <a href="<?= base_url('supplier/edit/' . $stokmasuk->supplier_id); ?>">
                          <?= $stokmasuk->supplier_nama; ?>
                        </a>
                      </td>
                      <td style="text-align: center;"><?= indonesian_date($stokmasuk->updated_at ? $stokmasuk->updated_at : $stokmasuk->create_at); ?></td>
                      <?php if ($this->session->userdata("role") == 1) {
                      ?>
                        <td><?= $stokmasuk->pengguna_nama; ?></td>
                      <?php
                      }
                      ?>
                      <td><?= $stokmasuk->keterangan; ?></td>
                      <td style="text-align: center;">
                        <a href="<?= base_url('stokmasuk/edit/' . $stokmasuk->id); ?>" class="btn btn-success">Edit</a>
                        <button class="btn btn-danger delete-stokmasuk" data-id="<?= $stokmasuk->id; ?>">Hapus</button>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>

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