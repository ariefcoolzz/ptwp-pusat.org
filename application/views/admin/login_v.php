<div class="content content-fixed">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-0">
            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#"><?php echo $judul; ?></a></li>
        </ol>
    </nav>
</div>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/dashforge.auth.css">
<div class="content content-fixed content-auth">
      <div class="container">
        <div class="media align-items-stretch justify-content-center ht-100p pos-relative">
          <div class="media-body align-items-center d-none d-lg-flex">
            <div class="mx-wd-600">
              <img src="https://via.placeholder.com/1260x950" class="img-fluid" alt="">
            </div>
            <div class="pos-absolute b-0 l-0 tx-12 tx-center">
              Workspace design vector is created by <a href="https://www.freepik.com/pikisuperstar" target="_blank">pikisuperstar (freepik.com)</a>
            </div>
          </div><!-- media-body -->
          <div class="sign-wrapper mg-lg-l-50 mg-xl-l-60">
            <div class="wd-100p">
              <h3 class="tx-color-01 mg-b-5">Sign In</h3>
              <p class="tx-color-03 tx-16 mg-b-40">Welcome back! Please signin to continue.</p>

              <div class="form-group">
                <label>Email address</label>
                <input type="email" class="form-control" placeholder="yourname@yourmail.com">
              </div>
              <div class="form-group">
                <div class="d-flex justify-content-between mg-b-5">
                  <label class="mg-b-0-f">Password</label>
                  <a href="" class="tx-13">Forgot password?</a>
                </div>
                <input type="password" class="form-control" placeholder="Enter your password">
              </div>
              <button class="btn btn-brand-02 btn-block">Sign In</button>
              <div class="divider-text">or</div>
              <button class="btn btn-outline-facebook btn-block">Sign In With Facebook</button>
              <button class="btn btn-outline-twitter btn-block">Sign In With Twitter</button>
              <div class="tx-13 mg-t-20 tx-center">Don't have an account? <a href="page-signup.html">Create an Account</a></div>
            </div>
          </div><!-- sign-wrapper -->
        </div><!-- media -->
      </div><!-- container -->
    </div><!-- content -->
