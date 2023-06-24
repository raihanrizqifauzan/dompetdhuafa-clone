<style>
    .filter-input th {
        padding-left: 3px!important;
        padding-right: 3px!important;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.css" integrity="sha512-gp+RQIipEa1X7Sq1vYXnuOW96C4704yI1n0YB9T/KqdvqaEgL6nAuTSrKufUX3VBONq/TPuKiXGLVgBKicZ0KA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="container-fluid py-4 mb-4">
    <nav aria-label="breadcrumb">
        <h6 class="font-weight-bolder text-white mb-0">Daftar Donasi</h6>
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;"><i class="fa fa-home"></i></a></li>
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Donasi</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Daftar Donasi</li>
        </ol>
    </nav>
    
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card">
                <div class=" pb-0 border-bottom">
                    <div class="d-flex p-3 justify-content-between align-items-center">
                        <div>
                            <b class="">Daftar Donasi</b>
                        </div>
                        <div>
                            <button class="btn btn-sm mb-0 px-3" style="background-color: #FFA800;color:#FFF">Cari</button>
                            <button class="btn btn-sm mb-0 px-3" style="background-color: #8950FC;color:#FFF">Export</button>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center p-4">
                    <div class="table-responsive">
                        <table class="table table-striped" id="tbDonasi">
                            <thead>
                                <tr>
                                    <th>DONATION HID</th>
                                    <th>TANGGAL DONASI</th>
                                    <th>NAMA DONATUR</th>
                                    <th>STATUS DONASI</th>
                                    <th>TIPE</th>
                                    <th>NAMA CHANNEL</th>
                                    <th>NOMOR REKONSILIASI</th>
                                    <th>JUMLAH DONASI</th>
                                    <th>JUMLAH</th>
                                    <th>ACTION</th>
                                </tr>
                                <tr class="filter-input">
                                    <th><input type="text" id="id_donasi_search" class="form-control"></th>
                                    <th><input type="text" id="tgl_donasi" class="form-control"></th>
                                    <th><input type="text" id="nama_donatur" class="form-control"></th>
                                    <th>
                                        <select class="form-control" id="status_donasi">
                                            <option value="">All</option>
                                            <option value="draft">Draft</option>
                                            <option value="collect">Collect</option>
                                            <option value="settle">Settle</option>
                                            <option value="request_void">Request Void</option>
                                        </select>
                                    </th>
                                    <th>
                                        <select class="form-control" id="tipe">
                                            <option value="">All</option>
                                            <option value="counter">Counter</option>
                                            <option value="bank">Bank</option>
                                            <option value="echannel">Echannel</option>
                                        </select>
                                    </th>
                                    <th><input type="text" id="nama_channel" class="form-control"></th>
                                    <th><input type="text" id="nomor_rekonsiliasi" class="form-control"></th>
                                    <th><input type="number" id="jumlah_donasi" class="form-control"></th>
                                    <th><input type="number" id="jumlah" class="form-control"></th>
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

<!-- Modal Req Void -->
<div class="modal fade" id="modalReqVoid" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Request Void</h5>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-lg-12">
                        <label for="">Keterangan</label>
                        <input type="hidden" class="form-control" id="id_donasi">
                        <input type="text" class="form-control" id="keterangan_void">
                        <small>Harap masukkan <b>keterangan</b></small>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="btnSubmitVoid">Confirm</button>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/moment.min.js" integrity="sha512-i2CVnAiguN6SnJ3d2ChOOddMWQyvgQTzm0qSgiKhOqBMGCx4fGU5BtzXEybnKatWPDkXPFyCI0lbG42BnVjr/Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.js" integrity="sha512-W76C8qrNYavcaycIH9EijxRuswoS+LCqA1+hq+ECrmjzAbe/SHhTgrwA1uc84husS/Gz50mxOEHPzrcd3sxBqQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    var tgl_awal = "";
    var tgl_akhir = "";
    var table = $('#tbDonasi').DataTable( {
        "processing": true,
        "serverSide": true,
        "serverMethod" : "post",
        ordering: false,
        searching: false,
        "ajax": {
            "url" : "<?= base_url('donasi/get_counter_list') ?>",
            "type": "POST",
            data: function ( data ) {
                data.id_donasi = $("#id_donasi_search").val();
                data.tgl_awal = tgl_awal;
                data.tgl_akhir = tgl_akhir;
                data.nama_donatur = $("#nama_donatur").val();
                data.status_donasi = $("#status_donasi").val();
                data.tipe = $("#tipe").val();
                data.nama_channel = $("#nama_channel").val();
                data.nomor_rekonsiliasi = $("#nomor_rekonsiliasi").val();
            }
        },
        "bDestroy":true,
    });


    $("#tbDonasi").on("click", ".void_donasi", function (e) {
        var id = $(this).data("id");
        console.log(id);
        $("#id_donasi").val(id);
        $("#modalReqVoid").modal("show")
    })
    $("#modalReqVoid").on("shown.bs.modal", function (e) {
        var button = e.relatedTarget;
        $("#id_donasi").val(button.data("id"));
    })
    
    $("#btnSubmitVoid").click(function () {
        var keterangan = $("#keterangan_void").val();
        $.ajax({
            type: 'POST',
            url: '<?= base_url('donasi/request_void') ?>',
            data: {id_donasi: $("#id_donasi").val(), keterangan: keterangan},
            success: function(response) {
                var res = JSON.parse(response);
                if (res.status) {
                    var id_donasi = btoa($("#id_donasi").val());
                    window.location.href = "<?= base_url('donasi/detail?id=') ?>" + id_donasi;
                } else {
                    showErrorMessage(res.message);
                }
            }
        });
    })

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

    $("#id_donasi_search, #nama_donatur, #nama_channel, #nomor_rekonsiliasi").keyup(delay( async function () {
        table.ajax.reload();
    }, 300));

    $("#status_donasi, #tipe").change(delay(async function () {
        table.ajax.reload();
    }, 300))
</script>