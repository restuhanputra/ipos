<div class="login-box">
  <div class="card">
    <div class="login-logo mt-4">
      <img src="<?= base_url() ?>assets/img/inventory.png" alt="logo-inventory" width="50%" height="50%">
      <!-- <a href="assets/index2.html"><b>Admin</b>LTE</a> -->
    </div>
    <!-- /.login-logo -->
    <div class="card-body login-card-body">
      <?php if ($this->session->flashdata("error")) {
      ?>
        <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <i class="icon fas fa-exclamation-triangle"></i><?= $this->session->flashdata("error"); ?>
        </div>
      <?php
      }
      ?>

      <form action="" method="POST">
        <div class="form-group">
          <label for="email">Email</label>
          <input type="text" name="email" class="form-control <?= form_error('email') ? 'is-invalid' : ''; ?>" placeholder="Enter email" value="<?= set_value('email') ?>">
          <span class="error invalid-feedback"><?= form_error('email') ?></span>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" class="form-control form-control <?= form_error('password') ? 'is-invalid' : ''; ?>" placeholder="Enter password">
          <span class="error invalid-feedback"><?= form_error('password') ?></span>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      <p class="mt-2 mb-1">
        <a href="<?= base_url('forgot') ?>">Lupa Password</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
<?php if ($this->session->flashdata("error")) : ?>
  <div class="flashdata" data-flashdata="<?= $this->session->flashdata("error"); ?>" data-type="error"></div>
<?php
  usetFlash();
endif; ?>