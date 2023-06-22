<div class="container-fluid py-4">
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

<script>
    var table = $('#tbDonasi').DataTable( {
        "processing": true,
        "serverSide": true,
        "serverMethod" : "post",
        ordering: false,
        searching: false,
        "ajax": {
            "url" : "<?= base_url('donasi/get_counter_list') ?>",
            "type": "POST",
        },
        "bDestroy":true,
    });


    $("#tbDonasi").on("click", ".void_donasi", function (e) {
        var id = $(this).data("id");
        console.log(id);
        // $("#id_donasi").val(id);
        // $("#modalReqVoid").modal("show")
    })
    // $("#modalReqVoid").on("shown.bs.modal", function (e) {
    //     var button = e.relatedTarget;
    //     $("#id_donasi").val(button.data("id"));
    // })
    
    $("#btnSubmitVoid").click(function () {
        var keterangan = $("#keterangan_void").val();
        $.ajax({
            type: 'POST',
            url: '<?= base_url('donasi/request_void') ?>',
            data: {id_donasi: $("#id_donasi").val(), keterangan: keterangan},
            success: function(response) {
                var res = JSON.parse(response);
                if (res.status) {
                    window.location.href = "<?= base_url('donasi/detail?id=').$this->input->get('id') ?>";
                } else {
                    showErrorMessage(res.message);
                }
            }
        });
    })
</script>