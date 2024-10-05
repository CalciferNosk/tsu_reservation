<!-- Login form -->
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card text-center mx-4  mt-5">
        <div class="card-body p-4">

          <img src="<?= base_url('assets/image/tsu-logo.png') ?>" id="login_logo" alt="">
          <br>
          <h1 id="login_title"><?= $title ?></h1>
          <p class="text-muted">Sign in to your account</p>
          <!-- Email input -->
          <form action="#" method="POST" ecrypt="multipart/form-data">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="fa fa-envelope"></i>
                </span>
              </div>
              <input type="email" name="email" id="email" class="form-control" placeholder="TSU Email">
            </div>
            <!-- Password input -->
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="fa fa-lock"></i>
                </span>
              </div>
              <input type="password" name="password" id="password" class="form-control" placeholder="Password">
            </div>
            <!-- Remember me checkbox -->
            <div class="form-check mb-3">
              <label class="form-check-label">
                <!-- <input type="checkbox" class="form-check-input"> Remember me -->
              </label>
            </div>
            <!-- Submit button -->
            <button type="submit" class="tsu-btn">Login</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>