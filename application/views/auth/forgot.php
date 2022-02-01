<div class="login-box">
  <!-- /.login-logo -->
  <div class="card">
    <div class="login-logo mt-4">
      <img src="<?= base_url() ?>assets/img/inventory.png" alt="logo-inventory" width="50%" height="50%">
    </div>
    <div class="card-body login-card-body">
      <?php if ($this->session->flashdata("error")) {
      ?>
        <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <i class="icon fas fa-exclamation-triangle"></i> <?= $this->session->flashdata("error"); ?>
        </div>
      <?php
        usetFlash();
      }

      if ($this->session->flashdata("success")) {
      ?>
        <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <i class="fas fa-check-circle"></i> <?= $this->session->flashdata("success"); ?>
        </div>
      <?php
        usetFlash();
      }
      ?>
      <p class="login-box-msg">Lupa Password ?</p>

      <form action="" method="POST">
        <div class="form-group">
          <label for="email">Email</label>
          <input type="text" name="email" class="form-control <?= form_error('email') ? 'is-invalid' : ''; ?>" placeholder="Enter email" value="<?= set_value('email') ?>">
          <span class="error invalid-feedback"><?= form_error('email') ?></span>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>

      <p class="mt-3 mb-1">
        <a href="<?= base_url('login') ?>">Login</a>
      </p>
      <!-- <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p> -->
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->