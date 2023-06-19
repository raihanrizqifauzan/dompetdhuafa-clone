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
        <h6 class="font-weight-bolder text-white mb-0">Collect</h6>
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;"><i class="fa fa-home"></i></a></li>
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Konter</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Collect</li>
        </ol>
    </nav>
    
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card">
                <div class=" pb-0 border-bottom">
                    <div class="d-flex p-3 justify-content-between align-items-center">
                        <div>
                            <b class="">Transaksi Donasi</b>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between pt-4 px-4">
                    <div><b>Collector</b></div>
                    <div><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCollector">Pilih User</button></div>
                </div>
                <hr>
                
                <div class="row p-4">
                    <div class="table-responsive col-lg-12 w-100">
                        <table class="table" style="border:none!important" width="100%">
                            <tr>
                                <th>Nama</th>
                                <th>:</th>
                                <td width="80%" id="nama_collector"></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <th>:</th>
                                <td width="80%" id="email_collector"></td>
                            </tr>
                            <tr>
                                <th>Telp</th>
                                <th>:</th>
                                <td width="80%" id="telp_collector"></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="d-flex justify-content-center">
                    <div class="table-responsive">
                        <table class="table table-striped" id="tbDonasi">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>DONATION HID</th>
                                    <th>NAMA DONATUR</th>
                                    <th>DONATION ITEM</th>
                                    <th>TIPE PEMBAYARAN</th>
                                    <th>JUMLAH</th>
                                    <th>TGL TRANSFER</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    
                </div>

                <div class="d-flex justify-content-end mt-4 px-4">
                    <button class="btn btn-danger" id="request_collect">Request Collect</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Collector -->
<div class="modal fade" id="modalCollector" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Collector</h5>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="table-responsive col-lg-12">
                        <table class="table table-striped" id="tbCollector">
                            <thead>
                                <tr>
                                    <th>NAME</th>
                                    <th>EMAIL</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($list_collector as $key => $collector) { ?>
                                    <tr>
                                        <td><?= $collector->nama_collector ?></td>
                                        <td><?= $collector->email_collector ?></td>
                                        <td>
                                            <button class="btn select-collector" data-id="<?= $collector->id ?>"><i class="fa fa-check"></i></button>
                                        </td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var id_collector = null;
    var table = $('#tbDonasi').DataTable( {
        "processing": true,
        "serverSide": true,
        "serverMethod" : "post",
        ordering: false,
        searching: false,
        "ajax": {
            "url" : "<?= base_url('donasi/get_counter_collect') ?>",
            "type": "POST",
            "data": {
                status: "draft"
            }
        },
        "bDestroy":true,
    });

    $(document).on("click", ".select-collector", function (e) {
        id_collector = $(this).data("id");
        $.ajax({
            type: 'GET',
            url: '<?= base_url('donasi/get_collector_by_id') ?>?id_collector=' + id_collector,
            success: function(response) {
                var res = JSON.parse(response);
                if (res.status) {
                    var data = res.data;
                    $("#modalCollector").modal("hide");
                    $("#nama_collector").html(data.nama_collector);
                    $("#email_collector").html(data.email_collector);
                    $("#telp_collector").html(data.telp_collector);
                } else {
                    id_collector = null;
                    showErrorMessage(res.message);
                }
            }
        });
    })

    $("#request_collect").click(function () {
        if ($("#nama_collector").html() == "") {
            showErrorMessage("Pilih collector terlebih dahulu");
            return false;
        }

        $.ajax({
            type: 'POST',
            url: '<?= base_url('donasi/request_collect') ?>',
            data: {id_collector: id_collector},
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
    })
</script>