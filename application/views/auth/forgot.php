<div class="login-box">
  <!-- /.login-logo -->
  <div class="card">
    <div class="login-logo mt-4">
      <img src="<?= base_url() ?>assets/img/inventory.png" alt="logo-inventory" width="50%" height="50%">
      <!-- <a href="assets/index2.html"><b>Admin</b>LTE</a> -->
    </div>
    <div class="card-body login-card-body">
      <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>

      <form action="" method="POST">
        <!-- <div class="card-body"> -->
        <div class="form-group">
          <label for="email">Email</label>
          <input type="text" name="email" class="form-control <?= form_error('email') ? 'is-invalid' : ''; ?>" placeholder="Enter email" value="<?= set_value('email') ?>">
          <span class="error invalid-feedback"><?= form_error('email') ?></span>
        </div>
        <!-- <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="password" class="form-control is-invalid" id="exampleInputPassword1" placeholder="Password" aria-describedby="exampleInputPassword1-error">
            <span id="exampleInputPassword1-error" class="error invalid-feedback">Please provide a password</span>
          </div> -->
        <!-- </div> -->
        <!-- /.card-body -->
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>

      <p class="mt-3 mb-1">
        <a href="<?= base_url('auth') ?>">Login</a>
      </p>
      <!-- <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p> -->
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->