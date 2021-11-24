<div class="login-box">
  <div class="card">
    <div class="login-logo mt-4">
      <img src="<?= base_url() ?>assets/img/inventory.png" alt="logo-inventory" width="50%" height="50%">
      <!-- <a href="assets/index2.html"><b>Admin</b>LTE</a> -->
    </div>
    <!-- /.login-logo -->
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

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

      <!-- <div class="social-auth-links text-center mb-3">
          <p>- OR -</p>
          <a href="#" class="btn btn-block btn-primary">
            <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
          </a>
          <a href="#" class="btn btn-block btn-danger">
            <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
          </a>
        </div> -->
      <!-- /.social-auth-links -->

      <p class="mt-2 mb-1">
        <a href="<?= base_url('forgot') ?>">I forgot my password</a>
      </p>
      <!-- <p class="mb-0">
          <a href="register.html" class="text-center">Register a new membership</a>
        </p> -->
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->