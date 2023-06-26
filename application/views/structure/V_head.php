<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url() ?>assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="<?= base_url() ?>assets/img/favicon.png">
  <title>
      Sandra 2.0 | Dompet Dhuafa
  </title><link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
  <!-- Nucleo Icons -->
  <link href="<?= base_url() ?>/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="<?= base_url() ?>/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="<?= base_url() ?>/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="<?= base_url() ?>/assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="<?= base_url() ?>assets/js/argon-dashboard.min.js?v=2.0.4"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
  <link rel="stylesheet" href="<?= base_url() ?>assets/iziToast/dist/css/iziToast.min.css">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.css" integrity="sha512-gp+RQIipEa1X7Sq1vYXnuOW96C4704yI1n0YB9T/KqdvqaEgL6nAuTSrKufUX3VBONq/TPuKiXGLVgBKicZ0KA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/moment.min.js" integrity="sha512-i2CVnAiguN6SnJ3d2ChOOddMWQyvgQTzm0qSgiKhOqBMGCx4fGU5BtzXEybnKatWPDkXPFyCI0lbG42BnVjr/Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.js" integrity="sha512-W76C8qrNYavcaycIH9EijxRuswoS+LCqA1+hq+ECrmjzAbe/SHhTgrwA1uc84husS/Gz50mxOEHPzrcd3sxBqQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"crossorigin="anonymous"></script> -->

  <style>
    @media screen and (min-width: 992px) {
        .main-content {
            padding: 0 100px;
        }

        .footer {
            padding: 10px 100px !important;
        }
    }

    #background-body {
        /* background: #EEF0F8; */
        /* background-repeat: no-repeat!important; */
        background-size: cover!important;
        /* background-position: -400px 0px!important; */
        background-position: top right;
        background: url('<?= base_url() ?>assets/img/bg-10.jpg');
    }

    .card {
        border-radius: 8px;
    }

    body {
        font-family: Poppins, Helvetica, "sans-serif" !important;
    }

    .item-menu.active, .item-menu:hover{
        background-color: #1a84c6;
    }

    .breadcrumb-item+.breadcrumb-item::before {
        /* color:#FFF!important; */
        content: var(--bs-breadcrumb-divider, ">")
    }

    .breadcrumb-item a {
        text-decoration:none;
    }

    .select2-container--default .select2-selection--single {
        min-height: 38px;
        padding-top: 5px;
        border: 1px solid rgba(170, 170, 170, 0.3);
        border-radius: 5px !important;
    }

    .select2-container--default .select2-selection--multiple {
        border: 1px solid rgba(170, 170, 170, 0.3);
        border-radius: 5px !important;
        min-height: 38px;
        padding-top: 5px;
    }

    .select2-selection__arrow {
        margin-top: 5px;
    }

    .select2-container--default .select2-selection--multiple:active {
        border: 1px solid #197ED1;
    }


    /* .container-fluid {
        margin-top:20px!important;
    } */
  </style>
</head>