<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="<?= base_url() ?>" class="brand-link">
    <img src="<?= base_url() ?>assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light"><?= webInfo()->nama_web; ?></span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <?php $photo = './uploads/users/' . userInfo()->photo; ?>
        <img src="<?= base_url($photo); ?>" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block"><?= ucfirst(userInfo()->nama); ?></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <!-- Dashboard -->
        <li class="nav-item">
          <a href="<?= base_url('dashboard') ?>" class="nav-link <?= $this->uri->segment(1) === 'dashboard' ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-home"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <!-- /.Dashboard -->
        <!-- Produk -->
        <li class="nav-item <?= $this->uri->segment(1) === 'produk' || $this->uri->segment(1) === 'kategori' || $this->uri->segment(1) === 'satuan' ? 'menu-open' : 'menu-close'; ?>"">
          <a href=" #" class="nav-link">
          <i class="nav-icon fab fa-product-hunt"></i>
          <p>
            Produk
            <i class="right fas fa-angle-left"></i>
          </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= base_url('produk') ?>" class="nav-link <?= $this->uri->segment(1) === 'produk' ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Produk</p>
              </a>
            </li>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= base_url('kategori') ?>" class="nav-link <?= $this->uri->segment(1) === 'kategori' ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Kategori</p>
              </a>
            </li>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= base_url('satuan') ?>" class="nav-link <?= $this->uri->segment(1) === 'satuan' ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Satuan</p>
              </a>
            </li>
          </ul>
        </li>
        <!-- /.Produk -->
        <!-- Stok -->
        <li class="nav-item <?= $this->uri->segment(1) === 'stokmasuk' || $this->uri->segment(1) === 'stokkeluar'  ? 'menu-open' : 'menu-close'; ?>"">
          <a href=" #" class="nav-link">
          <i class="nav-icon fas fa-archive"></i>
          <p>
            Stok
            <i class="right fas fa-angle-left"></i>
          </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= base_url('stokmasuk') ?>" class="nav-link <?= $this->uri->segment(1) === 'stokmasuk' ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Stok Masuk</p>
              </a>
            </li>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= base_url('stokkeluar') ?>" class="nav-link <?= $this->uri->segment(1) === 'stokkeluar' ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Stok Keluar</p>
              </a>
            </li>
          </ul>
        </li>
        <!-- /.Stok -->
        <li class="nav-item">
          <a href="<?= base_url('laporan') ?>" class="nav-link <?= $this->uri->segment(1) === 'laporan' ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-file-alt"></i>
            <p>
              Laporan
            </p>
          </a>
        </li>
        <!-- Profile -->
        <li class="nav-item">
          <a href="<?= base_url('profile') ?>" class="nav-link <?= $this->uri->segment(1) === 'profile' ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-user"></i>
            <p>
              Profile
            </p>
          </a>
        </li>
        <!-- /.Profile -->
        <!-- Pengguna -->
        <?php if ($this->session->userdata("role") == 1) {
        ?>
          <li class="nav-item">
            <a href="<?= base_url('pengguna') ?>" class="nav-link <?= $this->uri->segment(1) === 'pengguna' ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Pengguna
              </p>
            </a>
          </li>

        <?php
        }
        ?>
        <!-- /.Pengguna -->
        <!-- Konfigurasi -->
        <li class="nav-item">
          <a href="<?= base_url('konfigurasi') ?>" class="nav-link <?= $this->uri->segment(1) === 'konfigurasi' ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-cog"></i>
            <p>
              Konfigurasi
            </p>
          </a>
        </li>
        <!-- /.Konfigurasi -->
        <!-- Logout -->
        <li class="nav-item">
          <a href="<?= base_url('logout') ?>" class="nav-link">
            <i class="nav-icon fas fa-power-off"></i>
            <p>
              Logout
            </p>
          </a>
        </li>
        <!-- /.Logout -->
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>