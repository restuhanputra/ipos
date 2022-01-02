<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"><?= $title; ?></h1>
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
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-primary">
            <div class="inner">
              <h3><?= $dataCountProdukMasuk; ?></h3>

              <p class="font-weight-bold text-uppercase">Data Produk</p>
            </div>
            <div class="icon">
              <i class="fas fa-archive"></i>
              <!-- <i class="ion ion-bag"></i> -->
            </div>
            <a href="<?= base_url('produk'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3><?= $dataCountStokmasuk; ?></h3>

              <p class="font-weight-bold text-uppercase">Data Stok Masuk</p>
            </div>
            <div class="icon">
              <i class="fas fa-download"></i>
              <!-- <i class="ion ion-bag"></i> -->
            </div>
            <a href="<?= base_url('stokmasuk'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3><?= $dataCountStokkeluar; ?></h3>

              <p class="font-weight-bold text-uppercase">Data Stok Keluar</p>
            </div>
            <div class="icon">
              <i class="fas fa-upload"></i>
              <!-- <i class="ion ion-stats-bars"></i> -->
            </div>
            <a href="<?= base_url('stokkeluar'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>65</h3>

              <p class="font-weight-bold text-uppercase">Laporan</p>
            </div>
            <div class="icon">
              <i class="fas fa-file-invoice-dollar"></i>
              <!-- <i class="ion ion-pie-graph"></i> -->
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3><?= $dataCountPengguna; ?></h3>

              <p class="font-weight-bold text-uppercase">Pengguna</p>
            </div>
            <div class="icon">
              <i class="fas fa-user"></i>
            </div>
            <a href="<?= base_url('pengguna'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->