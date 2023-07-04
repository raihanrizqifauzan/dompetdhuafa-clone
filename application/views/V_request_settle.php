<style>
    .nav-item .nav-link.active {
        border-bottom: 1px solid #0d6efd; 
    }

    .table th, .table td {
        border:none!important;
    }

    .card {
        border:none!important;
    }
</style>
<div class="container-fluid py-4 " style="margin-bottom:100px;">
    <nav aria-label="breadcrumb">
        <h6 class="font-weight-bolder text-white mb-0">Request</h6>
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;"><i class="fa fa-home"></i></a></li>
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Request Settle</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Input</li>
        </ol>
    </nav>
    
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card">
                <div class=" pb-0 border-bottom">
                    <div class="d-flex p-3 justify-content-between align-items-center">
                        <div>
                            <b class="">Request Settle</b>
                        </div>
                        <div>
                            <a href="<?= base_url('confirmation') ?>" class="btn btn-sm mb-0 px-3" style="background-color: #F3F6F9;color:#7E8299"><i class="fa fa-arrow-left"></i> Back</a>
                        </div>
                    </div>
                </div>
                <div class="w-100 p-4">
                    <div class="p-4 shadow">
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCollector">Pilih User</button>
                        </div>
                        <hr>
                        <div class="table-responsive w-100">
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
                    </div>
                    <div class="p-4 mt-2 shadow">
                        <div class="d-flex justify-content-center">
                            <div class="table-responsive">
                                <table class="table table-striped" id="tbDonasi">
                                    <thead>
                                        <tr>
                                            <th class="text-center"><input type="checkbox" class="check-all"></th>
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
                        <div class="mt-4 p-4">
                            <div class="mt-4 form-group row">
                                <div class="col-lg-6">
                                    <label for="">Select Bank Tujuan</label>
                                    <select class="form-control" id="bank">
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <label for="">Select Kode Rekening</label>
                                    <select class="form-control" id="select_kode_rekening">
                                        <option value="">- Pilih Bank Terlebih Dahulu -</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mt-4 form-group row">
                                <div class="col-lg-3">
                                    <label for="">Bank Pengirim</label>
                                    <select class="form-control" id="bank_pengirim">
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <label for="">No. Rekening Pengirim</label>
                                    <input type="text" class="form-control" id="no_rekening"/>
                                </div>
                                <div class="col-lg-3">
                                    <label for="">Atas Nama Pengirim</label>
                                    <input type="text" class="form-control" id="atas_nama_pengirim"/>
                                </div>
                                <div class="col-lg-3">
                                    <label for="">Departemen</label>
                                    <select class="form-control" id="departemen">
                                        <option value="">- PILIH -</option>
                                        <option value="Retail-Konter">Retail-Konter</option>
                                        <option value="Retail-Bank">Retail-Bank</option>
                                        <option value="MPZ">MPZ</option>
                                        <option value="Penjemputan">Penjemputan</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mt-4 form-group row">
                                <div class="col-lg-12">
                                    <label for="">Bukti Transfer</label>
                                    <input type="file" class="form-control" id="bukti_tf"/>
                                </div>
                            </div>

                            <div class="mt-4 form-group row">
                                <div class="col-lg-12">
                                    <label for="">Keterangan</label>
                                    <input type="text" class="form-control" id="keterangan_donasi"/>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex px-4 pt-2 justify-content-end">
                            <button class="btn btn-primary" id="saveRequest">Simpan</button>
                        </div>
                    </div>
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
                <div class="table-responsive">
                    <table class="table table-striped w-100" id="tbCollector">
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

<script>
    var id_collector = null, checked_donasi = [];

    var tbDonasi = $('#tbDonasi').DataTable( {
        "processing": true,
        "serverSide": true,
        "serverMethod" : "post",
        ordering: false,
        searching: true,
        bInfo: false,
        paginate: false,
        "ajax": {
            "url" : "<?= base_url('donasi/get_counter_collect') ?>",
            "type": "POST",
            "data": function(data) {
                data.id_donasi = "";
                data.tgl_awal = "";
                data.tgl_akhir = "";
                data.nama_donatur = "";
                data.status_donasi = "";
                data.tipe = "";
                data.nama_channel = "";
                data.nomor_rekonsiliasi = "";
                data.jumlah_donasi = "";
                data.jumlah_donasi_terendah = "";
                data.jumlah_donasi_tertinggi = "";
                data.status_donasi = "draft";
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

    $(".check-all").change(function () {
        if ($(this).is(":checked")) {
            $(".check-donasi").each(function (i, obj) {
                $(obj).prop("checked", true).trigger("change");
            })
        } else {
            $(".check-donasi").each(function (i, obj) {
                $(obj).prop("checked", false).trigger("change");
            })
        }
    })

    $(document).on("change", ".check-donasi", function () {
        var id = $(this).data("id");
        id = parseInt(id);

        if ($(this).is(":checked")) {
            if (!checked_donasi.includes(id)) {
                checked_donasi.push(id)
            }
        } else {
            var index = checked_donasi.indexOf(id);
            if (index !== -1) {
                checked_donasi.splice(index, 1);
            }
        }

        if (checked_donasi.length == 0) {
            $(".check-all").prop("checked", false);
        }
    })

    $("#saveRequest").click(function () {
        var bukti_tf = $('#bukti_tf').prop('files')[0];
        var form_data = new FormData(); 
        form_data.append('id_collector', id_collector);
        form_data.append('bank_tujuan', $("#bank").val());
        form_data.append('kode_rekening', $("#select_kode_rekening").val());
        form_data.append('bank_pengirim', $("#bank_pengirim").val());
        form_data.append('no_rek_pengirim', $("#no_rekening").val());
        form_data.append('atas_nama_pengirim', $("#atas_nama_pengirim").val());
        form_data.append('departemen', $("#departemen").val());
        form_data.append('bukti_tf', bukti_tf);
        form_data.append('keterangan_donasi', $("#keterangan_donasi").val());
        form_data.append('list_donasi', JSON.stringify(checked_donasi));

        $.ajax({
            type: 'POST',
            url: "<?= base_url('request/save_request') ?>",
            data: form_data,
            processData: false,
            contentType: false,
            success: function(response) {
                var res = JSON.parse(response);
                if (res.status) {
                    location.reload();
                } else {
                    showErrorMessage(res.message);
                }
            }
        });
    })

    $('#bank_pengirim').select2({
        placeholder: 'No Options',
        minimumInputLength: 1,
        ajax: {
            url: '<?= base_url('confirmation/get_list_bank') ?>',
            dataType: 'json',
            delay: 250,
            data: function(data) {
                return {
                    search: data.term // search term
                };
            },
            processResults: function(response) {
                return {
                    results: response
                };
            },
            cache: true
        }
    })

    $("#departemen").select2();
    
    $('#bank').select2({
        placeholder: 'No Options',
        minimumInputLength: 1,
        ajax: {
            url: '<?= base_url('confirmation/get_list_bank') ?>',
            dataType: 'json',
            delay: 250,
            data: function(data) {
                return {
                    search: data.term // search term
                };
            },
            processResults: function(response) {
                return {
                    results: response
                };
            },
            cache: true
        }
    }).on("select2:select", function (e) {
        var data = e.params.data;
        console.log(data);
        var id_bank = data.id;
        $('#select_kode_rekening').select2({
            placeholder: 'No Options',
            minimumInputLength: 0,
            ajax: {
                url: '<?= base_url('confirmation/get_kode_rekening?bank=') ?>'+id_bank,
                dataType: 'json',
                delay: 250,
                data: function(data) {
                    return {
                        search: data.term // search term
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }
        })
    })
</script>