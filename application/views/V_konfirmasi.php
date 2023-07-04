<style>
    .filter-input th {
        padding-left: 3px!important;
        padding-right: 3px!important;
    }
</style>

<div class="container-fluid py-4 mb-4">
    <nav aria-label="breadcrumb">
        <h6 class="font-weight-bolder text-white mb-0">List</h6>
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;"><i class="fa fa-home"></i></a></li>
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Konfirmasi Donasi</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">List</li>
        </ol>
    </nav>
    
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card">
                <div class=" pb-0 border-bottom">
                    <div class="d-flex p-3 justify-content-between align-items-center">
                        <div>
                            <b class="">Daftar Konfirmasi</b>
                        </div>
                        <div>
                            <a href="<?= base_url('confirmation/new') ?>" class="btn btn-sm mb-0 px-3 btn-primary">Konfirmasi Baru</a>
                            <!-- <button class="btn btn-sm mb-0 px-3" style="background-color: #8950FC;color:#FFF">Export</button> -->
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center p-4">
                    <div class="table-responsive">
                        <table class="table table-striped" id="tbDonasi">
                            <thead>
                                <tr>
                                    <th>DIBUAT OLEH</th>
                                    <th>KONFIRMASI HID</th>
                                    <th>TANGGAL KONFIRMASI</th>
                                    <th>NAMA DONATUR</th>
                                    <th>TIPE</th>
                                    <th>BANK</th>
                                    <th>NO. REKENING</th>
                                    <th>ACTION</th>
                                </tr>
                                <tr class="filter-input">
                                    <th><input type="text" id="nama_user" class="form-control"></th>
                                    <th><input type="text" id="id_donasi" class="form-control"></th>
                                    <th><input type="text" id="tgl_donasi" class="form-control"></th>
                                    <th><input type="text" id="nama_lengkap" class="form-control"></th>
                                    <th>
                                        <input type="text" id="tipe" class="form-control">
                                    </th>
                                    <th>
                                        <input type="text" id="bank" class="form-control">
                                    </th>
                                    <th><input type="text" id="no_rekening" class="form-control"></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var tgl_awal = "";
    var tgl_akhir = "";
    var jumlah_terendah = "";
    var jumlah_tertinggi = "";

    var table = $('#tbDonasi').DataTable( {
        "processing": true,
        "serverSide": true,
        "serverMethod" : "post",
        ordering: false,
        searching: false,
        "ajax": {
            "url" : "<?= base_url('confirmation/get_donasi_list') ?>",
            "type": "POST",
            data: function ( data ) {
                data.nama_user = $("#nama_user").val();
                data.id_donasi = $("#id_donasi").val();
                data.tgl_awal = tgl_awal;
                data.tgl_akhir = tgl_akhir;
                data.nama_donatur = $("#nama_lengkap").val();
                data.tipe = $("#tipe_donasi").val();
                data.sumber_donasi = $("#sumber_donasi").val();
                data.bank = $("#bank").val();
                data.no_rekening = $("#no_rekening").val();
            }
        },
        "bDestroy":true,
    });

    $('#tgl_donasi').daterangepicker({
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear'
        }
    });
    
    $('#tgl_donasi').on('apply.daterangepicker', function(ev, picker) {
        tgl_awal = picker.startDate.format('YYYY-MM-DD');
        tgl_akhir = picker.endDate.format('YYYY-MM-DD');
        table.ajax.reload();
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
    });
    
    $('#tgl_donasi').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
        tgl_awal = "";
        tgl_akhir = "";
        table.ajax.reload();
    });


	function delay(callback, ms) {
		var timer = 0;
		return function() {
			var context = this, args = arguments;
			clearTimeout(timer);
			timer = setTimeout(function () {
				callback.apply(context, args);
			}, ms || 0);
		};
	}

    $("#nama_user, #id_donasi, #nama_lengkap, #bank, #no_rekening").keyup(delay( async function () {
        table.ajax.reload();
    }, 300));

    $("#status_donasi, #tipe").change(delay(async function () {
        table.ajax.reload();
    }, 300))

    $("#tbDonasi").on("click", ".btn-delete", function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        var result = confirm("Hapus Data Donasi ini ?");
        if (result) {
            $.ajax({
                type: 'POST',
                url: "<?= base_url('confirmation/delete_donasi') ?>",
                data: {id_donasi: id},
                success: function(response) {
                    var res = JSON.parse(response);
                    if (res.status) {
                        showSuccessMessage(res.message);
                        table.ajax.reload();
                    } else {
                        showErrorMessage(res.message);
                    }
                }
            });
        }
    })
</script>