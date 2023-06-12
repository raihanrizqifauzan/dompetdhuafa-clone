<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url('assets/login/') ?>fonts/icomoon/style.css">

    <link rel="stylesheet" href="<?= base_url('assets/login/') ?>css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/login/') ?>css/bootstrap.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="<?= base_url('assets/login/') ?>css/style.css">

    <title>Sandra 2.0 | Dompet Dhuafa</title>
  </head>
  <body>
  

  <div class="d-md-flex half">
    <div class="bg" style="background-image: url('<?= base_url('assets/') ?>img/bg-4.jpg');background-position:0 0;background-size:coverwidth:30%!important">
        <div class="d-flex flex-row-fluid flex-column justify-content-between">
            <a class="flex-column-auto mt-5 mx-3 pb-lg-0 pb-10" href="/">
                <img alt="Logo" class="max-h-70px" src="https://admin.sandra-dev.dompetdhuafa.org/media/logos/logo-letter-1.png">
            </a>
            <!-- <div class="flex-column-fluid d-flex flex-column justify-content-center">
                <h3 class="font-size-h1 mb-5 text-white">Sandra 2.0</h3>
                <p class="font-weight-lighter text-white opacity-80">
                    <i>Sistem Administrasi Fundrising</i>
                </p>
            </div>
            <div class="d-none flex-column-auto d-lg-flex justify-content-between mt-10">
                <div class="opacity-70 font-weight-bold	text-white">© 2021</div>
                <div class="d-flex">
                    <a class="text-white" href="/terms">Privacy</a>
                    <a class="text-white ml-10" href="/terms">Legal</a>
                    <a class="text-white ml-10" href="/terms">Contact</a>
                </div>
            </div> -->
        </div>
    </div>
    <div class="contents">

      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-12">
            <div class="form-block shadow-none mx-auto" style="background:none">
              <div class="text-center mb-5">
              <h3>Login Account</h3>
              <small class="text-muted">Enter your username and password</small>
              <!-- <p class="mb-4">Lorem ipsum dolor sit amet elit. Sapiente sit aut eos consectetur adipisicing.</p> -->
              </div>
              <form action="<?= base_url('login/proses') ?>" method="post">
                <div class="form-group first">
                  <input type="text" class="form-control" placeholder="Email" name="email">
                </div>
                <div class="form-group last mb-3">
                  <input type="password" class="form-control" placeholder="Password" name="password">
                </div>

                <div class="text-right">
                    <input type="submit" value="Sign In" class="btn btn-info">
                </div>

              </form>
            </div>
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