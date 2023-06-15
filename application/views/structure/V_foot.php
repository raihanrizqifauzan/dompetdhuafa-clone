</main>
  <!--   Core JS Files   -->
  <script src="<?= base_url() ?>/assets/js/core/popper.min.js"></script>
  <script src="<?= base_url() ?>/assets/js/core/bootstrap.min.js"></script>
  <script src="<?= base_url() ?>/assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="<?= base_url() ?>/assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <!-- <script async defer src="https://buttons.github.io/buttons.js"></script> -->
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="<?= base_url() ?>assets/iziToast/dist/js/iziToast.min.js" type="text/javascript"></script>
  <script>
    function showErrorMessage(message) {
      return iziToast.show({
        title: 'Oops..',
        message: message,
        position: 'topRight',
        backgroundColor: '#e74c3c',
        messageColor: '#FFF',
        titleColor: '#FFF',
      });
    }

    function showSuccessMessage(message) {
      return iziToast.show({
        title: 'Success',
        message: message,
        position: 'topRight',
        backgroundColor: '#2ecc71',
        messageColor: '#FFF',
        titleColor: '#FFF',
      });
    }
    
    function formatRupiah(angka, prefix){
      var number_string = angka.toString(),
      split   		= number_string.split(','),
      sisa     		= split[0].length % 3,
      rupiah     		= split[0].substr(0, sisa),
      ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
  
      // tambahkan titik jika yang di input sudah menjadi angka ribuan
      if(ribuan){
          separator = sisa ? '.' : '';
          rupiah += separator + ribuan.join('.');
      }
  
      rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
      return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
  </script>

  <?php 
    if(!empty($this->session->userdata('flashdata'))) {
      $type = $this->session->userdata('flashdata')['notif_type'];
      $message = $this->session->userdata('flashdata')['notif_message'];
      echo '<button id="alert-flashdata" class="d-none"></button>';
      $this->session->unset_userdata('flashdata');
    } else {
      $type = "";
      $message = "";
    } ?>

    <script>
      $(document).ready(function () {
        var type_flashdata = "<?= $type ?>";
        var msg_flashdata = "<?= $message ?>";
        var new_elem = $("#alert-flashdata").length;
        if (new_elem > 0) {
          if (type_flashdata == "success") {
            showSuccessMessage(msg_flashdata);
          } else {
            showErrorMessage(msg_flashdata);
          }
        }
      })
    </script>

  
</body>

</html>