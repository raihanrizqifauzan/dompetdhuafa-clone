<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="<?= base_url('assets/login/') ?>fonts/icomoon/style.css">

    <link rel="stylesheet" href="<?= base_url('assets/login/') ?>css/owl.carousel.min.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/login/') ?>css/bootstrap.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="<?= base_url('assets/login/') ?>css/style.css">

    <title>Sandra 2.0 | Dompet Dhuafa</title>
  </head>
  <body>
    <div class="d-flex flex-column flex-root half">
      <div class="login login-1 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white" id="kt_login">
        <div class="login-aside d-flex flex-row-auto bgi-size-cover bgi-no-repeat p-10 p-lg-10" style="background-image: url('<?= base_url('assets/') ?>img/bg-4.jpg')">
          <div class="d-flex flex-row-fluid flex-column justify-content-between">
            <a class="flex-column-auto mt-5 pb-lg-0 pb-10" href="">
              <img alt="Logo" class="max-h-70px" src="https://admin.sandra-dev.dompetdhuafa.org/media/logos/logo-letter-1.png">
            </a>
            <div class="flex-column-fluid d-flex flex-column justify-content-center">
              <h3 class="font-size-h1 mb-5 text-white">Sandra 2.0</h3>
              <p class="font-weight-lighter text-white opacity-80"><i>Sistem Administrasi Fundrising</i></p>
            </div>
            <div class="d-none flex-column-auto d-lg-flex justify-content-between mt-10">
              <div class="opacity-70 font-weight-bold	text-white">© 2021</div>
              <div class="d-flex">
                <a class="text-white" href="#">Privacy</a>
                <a class="text-white ml-10" href="#">Legal</a>
                <a class="text-white ml-10" href="#">Contact</a>
              </div>
            </div>
          </div>
        </div>

        <div class="d-flex flex-column flex-row-fluid position-relative p-7 overflow-hidden">
          <div class="d-flex flex-column-fluid flex-center mt-30 mt-lg-0">
            <div class="login-form login-signin" id="kt_login_signin_form">
              <div class="text-center mb-10 mb-lg-20">
                <h3 class="font-size-h1">Login Account</h3>
                <p class="text-muted font-weight-bold">Enter your username and password</p>
              </div>
              <form action="<?= base_url('login/proses') ?>" method="post" class="form fv-plugins-bootstrap fv-plugins-framework">
                <div class="form-group fv-plugins-icon-container">
                  <input placeholder="Email" type="email" class="form-control form-control-solid h-auto py-5 px-6" name="email">
                </div>
                <div class="form-group fv-plugins-icon-container">
                  <input placeholder="Password" type="password" class="form-control form-control-solid h-auto py-5 px-6" name="password">
                </div>
                <div class="form-group d-flex flex-wrap justify-content-between align-items-center">
                  <div class="my-3 mr-2"></div>
                  <button id="kt_login_signin_submit" type="submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3">
                    <span>Sign In</span>
                  </button>
                </div>
              </form>
            </div>
          </div>

          <div class="d-flex d-lg-none flex-column-auto flex-column flex-sm-row justify-content-between align-items-center mt-5 p-5">
            <div class="text-dark-50 font-weight-bold order-2 order-sm-1 my-2">© 2021 Dompet Dhuafa</div>
            <div class="d-flex order-1 order-sm-2 my-2">
              <a class="text-dark-75 text-hover-primary" href="/terms">Privacy</a>
              <a class="text-dark-75 text-hover-primary ml-4" href="/terms">Legal</a>
              <a class="text-dark-75 text-hover-primary ml-4" href="/terms">Contact</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <?php 
    if(!empty($this->session->flashdata('notif_icon'))) {
        $icon = $this->session->flashdata('notif_icon');
        $message = $this->session->flashdata('notif_message');
        echo '<button id="alert-flashdata" class="d-none"></button>';
    } else {
        $icon = "";
        $message = "";
    } ?>
    
    <script src="<?= base_url('assets/login/') ?>js/jquery-3.3.1.min.js"></script>
    <script src="<?= base_url('assets/login/') ?>js/popper.min.js"></script>
    <script src="<?= base_url('assets/login/') ?>js/bootstrap.min.js"></script>
    <script src="<?= base_url('assets/login/') ?>js/main.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        var icon_flashdata = "<?= $icon ?>";
        var msg_flashdata = "<?= $message ?>";
        var error = $("#alert-flashdata").length;
        if (error > 0) {
            Swal.fire({
                icon: icon_flashdata,
                text: msg_flashdata,
            })
        }
    </script>
  </body>
</html>