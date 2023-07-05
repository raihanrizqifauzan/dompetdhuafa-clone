<style>
    .nav-item .nav-link.active {
        border-bottom: 1px solid #0d6efd; 
    }

    .table th, .table td {
        border:none!important;
    }
</style>
<div class="container-fluid py-4 " style="margin-bottom:100px;">
    <nav aria-label="breadcrumb">
        <h6 class="font-weight-bolder text-white mb-0">Checker</h6>
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;"><i class="fa fa-home"></i></a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Checker</li>
        </ol>
    </nav>
    
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card">
                <div class=" pb-0 border-bottom">
                    <div class="d-flex p-3 justify-content-between align-items-center">
                        <div>
                            <b class="">Daftar Permintaan</b>
                        </div>
                    </div>
                </div>
                
                <div class="row p-4">
                    <div class="col-lg-3">
                        <input type="text" id="nama_collector" class="form-control" placeholder="Search">
                        <small class="text-muted">Cari berdasarkan nama collector</small>
                    </div>
                    <div class="col-lg-3">
                        <select class="form-control" id="status_collect">
                            <option value="request">Request</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                        </select>
                        <small class="text-muted">Cari berdasarkan status</small>
                    </div>
                </div>

                <div class="d-flex">
                    <div class="table-responsive w-100 p-4">
                        <table class="table table-striped" id="tbRequest">
                            <thead>
                                <tr>
                                    <th>REQUESTER</th>
                                    <th>TOTAL KONTER</th>
                                    <th>TOTAL TRANSAKSI</th>
                                    <th>JUMLAH</th>
                                    <th>AKSI</th>
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

<!-- Modal Collector -->
<div class="modal fade" id="modalTransaksi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Daftar Transaksi</h5>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="table-responsive col-lg-12">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>NAMA KONTER</th>
                                    <th>BANYAK TRANSAKSI</th>
                                    <th>JUMLAH</th>
                                </tr>
                            </thead>
                            <tbody id="bodyTransaksi">
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-12">
                        <input type="hidden" id="id_request">
                        <label for="">Select Konfirmasi</label>
                        <select class="form-control" id="status_collect_input">
                            <option value="">- PILIH KONFIRMASI -</option>
                            <option value="approved">APPROVED</option>
                            <option value="rejected">REJECT</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="btnSubmit">Confirm</button>
            </div>
        </div>
    </div>
</div>

<script>
    var nama_collector = "", status_collect = "request";

    var table = $('#tbRequest').DataTable( {
        "processing": true,
        "serverSide": true,
        "serverMethod" : "post",
        ordering: false,
        searching: false,
        bInfo: false,
        "ajax": {
            "url" : "<?= base_url('checker/get_request_collect') ?>",
            "type": "POST",
            "data": function(data) {
                data.nama_collector = nama_collector;
                data.status_collect = status_collect;
            }
        },
        "bDestroy": true,
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

    $("#nama_collector").keyup(delay( async function () {
        nama_collector = $(this).val();
        table.ajax.reload();
    }, 300));

    $("#status_collect").change(delay(async function () {
        status_collect = $(this).val();
        table.ajax.reload();
    }, 300));
    
    $("#tbRequest").on("click", ".btn-edit", function () {
        var id_request = $(this).data("id");
        $.ajax({
            type: 'GET',
            url: '<?= base_url('checker/get_detail_request?id_request=') ?>' + id_request,
            success: function(response) {
                var res = JSON.parse(response);
                if (res.status) {
                    var list_transaksi = res.data;
                    var html = "";
                    list_transaksi.forEach(e => {
                        html += `
                        <tr>
                            <td>${e.nama_channel}</td>
                            <td class="text-end">${formatRupiah(e.jumlah_transaksi)}</td>
                            <td class="text-end">Rp${formatRupiah(e.total_transaksi)},00</td>
                        </tr>`;
                    });
                    $("#bodyTransaksi").html(html);
                    $("#id_request").val(id_request);
                    $("#modalTransaksi").modal("show");
                } else {
                    showErrorMessage(res.message);
                }
            }
        });
    })

    $("#modalTransaksi").on("hidden.bs.modal", function () {
        $("#id_request").val("");
        $("#bodyTransaksi").html("");
        $("#status_collect_input").val("").trigger("change");
    })

    $("#btnSubmit").click(function () {
        var obj = {
            id_request: $("#id_request").val(),
            status_collect: $("#status_collect_input").val(),
        };

        $.ajax({
            type: 'POST',
            url: `<?= base_url('checker/konfirmasi_checker') ?>`,
            data: obj,
            success: function(response) {
                var res = JSON.parse(response);
                if (res.status) {
                    showSuccessMessage(res.message);
                    $("#modalTransaksi").modal("hide");
                    table.ajax.reload();
                } else {
                    showErrorMessage(res.message);
                }
            }
        });
    })
</script>