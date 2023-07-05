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

    .stepper {
        .line {
            width: 2px;
            background-color: lightgrey !important;
        }
        .lead {
            font-size: 1.1rem;
        }
    }

    .md-stepper-horizontal {
        display:table;
        width:100%;
        margin:0 auto;
        background-color:#FFFFFF;
        box-shadow: 0 3px 8px -6px rgba(0,0,0,.50);
    }
    .md-stepper-horizontal .md-step {
        display:table-cell;
        position:relative;
        padding:24px;
    }
    .md-stepper-horizontal .md-step:hover,
    .md-stepper-horizontal .md-step:active {
        background-color:rgba(0,0,0,0.04);
    }
    .md-stepper-horizontal .md-step:active {
        border-radius: 15% / 75%;
    }
    .md-stepper-horizontal .md-step:first-child:active {
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }
    .md-stepper-horizontal .md-step:last-child:active {
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }
    .md-stepper-horizontal .md-step:hover .md-step-circle {
        background-color:#757575;
    }
    .md-stepper-horizontal .md-step:first-child .md-step-bar-left,
    .md-stepper-horizontal .md-step:last-child .md-step-bar-right {
        display:none;
    }
    .md-stepper-horizontal .md-step .md-step-circle {
        width:30px;
        height:30px;
        margin:0 auto;
        background-color:#999999;
        border-radius: 50%;
        text-align: center;
        line-height:30px;
        font-size: 16px;
        font-weight: 600;
        color:#FFFFFF;
    }
    .md-stepper-horizontal.green .md-step.active .md-step-circle {
        background-color:#00AE4D;
    }
    .md-stepper-horizontal.orange .md-step.active .md-step-circle {
        background-color:#F96302;
    }
    .md-stepper-horizontal .md-step.active .md-step-circle {
        background-color: rgb(33,150,243);
    }
    .md-stepper-horizontal .md-step.done .md-step-circle:before {
        font-family:'FontAwesome';
        font-weight:100;
        content: "\f00c";
    }
    .md-stepper-horizontal .md-step.done .md-step-circle *,
    .md-stepper-horizontal .md-step.editable .md-step-circle * {
        display:none;
    }
    .md-stepper-horizontal .md-step.editable .md-step-circle {
        -moz-transform: scaleX(-1);
        -o-transform: scaleX(-1);
        -webkit-transform: scaleX(-1);
        transform: scaleX(-1);
    }
    .md-stepper-horizontal .md-step.editable .md-step-circle:before {
        font-family:'FontAwesome';
        font-weight:100;
        content: "\f040";
    }
    .md-stepper-horizontal .md-step .md-step-title {
        margin-top:16px;
        font-size:16px;
        font-weight:600;
    }
    .md-stepper-horizontal .md-step .md-step-title,
    .md-stepper-horizontal .md-step .md-step-optional {
        text-align: center;
        color:rgba(0,0,0,.26);
    }
    .md-stepper-horizontal .md-step.active .md-step-title {
        font-weight: 600;
        color:rgba(0,0,0,.87);
    }
    .md-stepper-horizontal .md-step.active.done .md-step-title,
    .md-stepper-horizontal .md-step.active.editable .md-step-title {
        font-weight:600;
    }
    .md-stepper-horizontal .md-step .md-step-optional {
        font-size:12px;
    }
    .md-stepper-horizontal .md-step.active .md-step-optional {
        color:rgba(0,0,0,.54);
    }
    .md-stepper-horizontal .md-step .md-step-bar-left,
    .md-stepper-horizontal .md-step .md-step-bar-right {
        position:absolute;
        top:36px;
        height:1px;
        border-top:1px solid #DDDDDD;
    }
    .md-stepper-horizontal .md-step .md-step-bar-right {
        right:0;
        left:50%;
        margin-left:20px;
    }
    .md-stepper-horizontal .md-step .md-step-bar-left {
        left:0;
        right:50%;
        margin-right:20px;
    }
</style>
<div class="container-fluid py-4 " style="margin-bottom:100px;">
    <nav aria-label="breadcrumb">
        <h6 class="font-weight-bolder text-white mb-0">Input</h6>
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;"><i class="fa fa-home"></i></a></li>
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Konter</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Input</li>
        </ol>
    </nav>

    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="md-stepper-horizontal green">
                <div class="md-step active">
                    <div class="md-step-circle"><span>1</span></div>
                    <div class="md-step-title">DRAFT</div>
                    <div class="md-step-bar-left"></div>
                    <div class="md-step-bar-right"></div>
                </div>
                <div class="md-step">
                    <div class="md-step-circle"><span>2</span></div>
                    <div class="md-step-title">PENDING</div>
                    <div class="md-step-bar-left"></div>
                    <div class="md-step-bar-right"></div>
                </div>
                
                <div class="md-step">
                    <div class="md-step-circle"><span>3</span></div>
                    <div class="md-step-title">SETTLE</div>
                    <div class="md-step-bar-left"></div>
                    <div class="md-step-bar-right"></div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card">
                <div class=" pb-0 border-bottom">
                    <div class="d-flex p-3 justify-content-between align-items-center">
                        <div>
                            <b class="">Form Donasi</b>
                        </div>
                        <div>
                            <a href="<?= base_url('donasi/counter/list') ?>" class="btn btn-sm mb-0 px-3" style="background-color: #F3F6F9;color:#7E8299"><i class="fa fa-arrow-left"></i> Back</a>
                        </div>
                    </div>
                </div>
                <div class="w-100 p-4">
                    <div class="p-4 shadow">
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalDonatur">Pilih Donatur</button>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <div><b>Donasi Baru</b></div>
                            <div>
                                <small>Tanggal Donasi</small>
                                <input type="date" value="<?= date("Y-m-d") ?>" id="tgl_donasi" class="form-control" style="border:none;border-bottom:1px solid #ced4da">
                            </div>
                        </div>
                        <hr>
                        <div class="table-responsive w-100">
                            <input type="hidden" id="id_donatur">
                            <table class="table" style="border:none!important" width="100%">
                                <tr>
                                    <th>Donatur</th>
                                    <th>:</th>
                                    <td width="80%" id="nama_donatur"></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <th>:</th>
                                    <td width="80%" id="email_donatur"></td>
                                </tr>
                                <tr>
                                    <th>Telp</th>
                                    <th>:</th>
                                    <td width="80%" id="no_hp"></td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <th>:</th>
                                    <td width="80%" id="address"></td>
                                </tr>
                                <tr>
                                    <th>Tipe</th>
                                    <th>:</th>
                                    <td width="80%" id="tipe_donatur"></td>
                                </tr>
                                <tr>
                                    <th>Kode Rekening</th>
                                    <th>:</th>
                                    <td width="80%" id="kode_rekening"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="p-4 mt-2 shadow">
                        <div class="d-flex justify-content-between align-items-center border-bottom py-4 mt-4">
                            <div><b>Donasi Edit</b></div>
                        </div>
                        <div class="d-flex px-3 py-4 align-items-start justify-content-between">
                            <div>
                                Donasi Item
                            </div>
                            <div>
                                <button class="btn btn-primary" id="addItem">Tambah Item</button>
                            </div>
                        </div>
                        <div class="table-responsive p-4 shadow">
                            <table class="table w-100 table-hover">
                                <thead>
                                    <tr class="text-center">
                                        <th style="50%">
                                            <div>
                                                (<i class="th-icon fa fa-plus"></i>) TIPE
                                            </div>
                                        </th>
                                        <th>JUMLAH</th>
                                        <th>ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody id="tbItem">
                                    
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4 p-4 shadow">
                            <div class="d-flex justify-content-between align-items-center border-bottom py-4 mt-4">
                                <div><b>Departemen</b></div>
                            </div>
                            <div class="mt-4 form-group row">
                                <div class="col-lg-12">
                                    <label for="">Pilih Departemen</label>
                                    <select class="form-control" id="departemen">
                                        <option value="">- PILIH -</option>
                                        <option value="Retail-Konter">Retail-Konter</option>
                                        <option value="Retail-Bank">Retail-Bank</option>
                                        <option value="MPZ">MPZ</option>
                                        <option value="Penjemputan">Penjemputan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 p-4 shadow">
                            <div class="d-flex justify-content-between align-items-center border-bottom py-4 mt-4">
                                <div><b>Pembayaran</b></div>
                            </div>
                            <div class="mt-4 form-group row">
                                <div class="col-lg-12">
                                    <label for="">Jenis Pembayaran</label>
                                    <select class="form-control" id="jenis_pembayaran">
                                        <option value="">- PILIH -</option>
                                        <option value="tunai">TUNAI</option>
                                        <option value="edc">EDC</option>
                                        <option value="barang">BARANG</option>
                                        <option value="mitra konter">MITRA KONTER</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mt-4 form-group row justify-content-end">
                                <div class="col-lg-6">
                                    <div class="d-flex justify-content-start w-100 align-items-center">
                                        <label class="">Total Donasi</label>
                                        <input type="text" class="form-control text-end" id="total_donasi" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex px-4 pt-2 justify-content-end">
                            <button class="btn btn-primary" id="saveDonasi">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Donatur -->
<div class="modal fade" id="modalDonatur" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Select Donatur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <a href="<?= base_url('donasi/new') ?>" class="btn btn-primary">Tambah Donatur</a>
                    <table class="table" id="tbDonatur">
                        <thead>
                            <tr>
                                <th>ID DONATUR</th>
                                <th>NAME</th>
                                <th>HP</th>
                                <th>EMAIL</th>
                                <th>KODE REKENING</th>
                                <th>KODE CC</th>
                                <th>BRANCH</th>
                                <th>KATEGORI PROSPEK</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Item -->
<div class="modal fade" id="modalItem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Item Baru</h5>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <input type="hidden" class="form-control" id="id_item">
                    <div class="col-lg-4">
                        <label for="">Jenis Donasi</label>
                        <select class="form-control" id="jenis_donasi">
                            <option value="">- PILIH -</option>
                            <?php
                            foreach ($list_jenis_donasi as $key => $jenis) {
                                echo '<option value="'.$jenis->id.'">'.$jenis->jenis_donasi.'</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-lg-8">
                        <label for="">Program Donasi</label>
                        <select class="form-control" id="program_donasi">
                            <option value="">- PILIH -</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-12">
                        <label for="">Project</label>
                        <select class="form-control" id="project_donasi">
                            <option value="">- PILIH -</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-12">
                        <label for="">Tipe Donasi</label>
                        <select class="form-control" id="tipe_donasi">
                            <option value="uang">Uang</option>
                            <option value="barang">Barang</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-12">
                        <label for="">Atas Nama</label>
                        <input type="text" class="form-control" id="atas_nama" placeholder="Atas Nama">
                    </div>
                </div>
                <div class="form-group row" id="row_barang" style="display:none">
                    <div class="col-lg-6">
                        <label for="">Kategori Barang</label>
                        <select class="form-control" id="kategori_barang">
                            <option value="asset">ASSET</option>
                            <option value="barang berharga">BARANG BERHARGA</option>
                            <option value="barang lainnya">BARANG LAINNYA</option>
                            <option value="natura">NATURA</option>
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <label for="">Nama Barang</label>
                        <input type="text" class="form-control" id="nama_barang" placeholder="Mobil, Motor...">
                    </div>
                    <div class="col-lg-6">
                        <label for="">Jumlah Barang</label>
                        <input type="number" class="form-control" id="jumlah_barang" placeholder="9999">
                    </div>
                    <div class="col-lg-6">
                        <label for="">Masukkan Harga per Barang</label>
                        <input type="text" class="form-control" id="harga_satuan" placeholder="Harga Barang Satuan">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-12">
                        <label for="">Masukkan Jumlah</label>
                        <input type="text" class="form-control" id="nominal" placeholder="Masukkan Jumlah">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-12">
                        <label for="">Masukkan Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" placeholder="Masukkan Keterangan Doansi">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="saveItem">Oke</button>
            </div>
        </div>
    </div>
</div>

<script>
    var list_item = `<?= $list_item_donasi ?>`;
    var action_item = "add";
    $(document).ready(function () {
        var data = JSON.parse(list_item);
        loadItemDonasi(data)
    })

    var table = $('#tbDonatur').DataTable( {
        "processing": true,
        "serverSide": true,
        "serverMethod" : "post",
        ordering: false,
        // searching: false,
        "ajax": {
            "url" : "<?= base_url('donasi/get_list_donatur') ?>",
            "type": "POST",
        },
        "bDestroy":true,
    });

    $("#jumlah_barang, #harga_satuan").on("keyup, change", function () {
        var qty = $("#jumlah_barang").val() == "" ? 0 : $("#jumlah_barang").val();
        var price = $("#harga_satuan").val() == "" ? 0 : $("#harga_satuan").val();
        $("#nominal").val(parseInt(qty) * parseInt(price));
    })

    $(document).on("click", ".select-donatur", function (e) {
        var id_donatur = $(this).data("id");
        $.ajax({
            type: 'GET',
            url: '<?= base_url('donatur/get_donatur_by_id') ?>?id_donatur=' + id_donatur,
            success: function(response) {
                var res = JSON.parse(response);
                if (res.status) {
                    var data = res.data;
                    $("#modalDonatur").modal("hide");
                    $("#id_donatur").html(data.id_donatur);
                    $("#nama_donatur").html(data.nama_lengkap);
                    $("#email_donatur").html(data.email_donatur);
                    $("#no_hp").html(data.no_hp);
                    $("#address").html(data.address);
                    $("#tipe_donatur").html(data.tipe_donatur);
                    $("#kode_rekening").html(data.kode_rekening);
                } else {
                    showErrorMessage(res.message);
                }
            }
        });
    })

    $("#addItem").click(function () {
        if ($("#email_donatur").html() == "") {
            showErrorMessage("Harap Pilih Donatur");
        } else {
            action_item = "add";
            $("#modalItem").modal("show")
        }
    })

    $("#jenis_donasi").change(function () {
        var id = $(this).val();
        $.ajax({
            type: 'GET',
            url: '<?= base_url('donasi/get_program_donasi') ?>?id=' + id,
            success: function(response) {
                var res = JSON.parse(response);
                var html = `<option value="">- PILIH -</option>`;
                res.forEach(e => {
                    html += `<option value="${e.id}">${e.program_donasi}</option>`;
                });
                $("#program_donasi").html(html).val("").trigger("change");
            }
        });
    })
    
    $("#program_donasi").change(function () {
        var id = $(this).val();
        $.ajax({
            type: 'GET',
            url: '<?= base_url('donasi/get_project_donasi') ?>?id=' + id,
            success: function(response) {
                var res = JSON.parse(response);
                var html = `<option value="">- PILIH -</option>`;
                res.forEach(e => {
                    html += `<option value="${e.id}">${e.nama_project}</option>`;
                });
                $("#project_donasi").html(html);
            }
        });
    })

    $("#tipe_donasi").change(function () {
        var tipe = $(this).val();
        if (tipe == "uang") {
            $("#row_barang").hide();
            $("#nominal").val("").prop("disabled", false);
        } else if (tipe == "barang") {
            $("#row_barang").show();
            $("#nominal").val("").prop("disabled", true);
        }
    })

    function loadItemDonasi(data) {
        var html = "";
        console.log(data);
        var total_donasi = 0;
        data.forEach(e => {
            var nama_project = "";
            if (e.id_project_donasi != "" && e.id_project_donasi != null) {
                nama_project = `<div>Nama Project : ${e.nama_project}</div>`
            }
            var nama_program = "";
            if (e.id_program_donasi != "" && e.id_program_donasi != null) {
                nama_program = `<div>Nama Program : ${e.program_donasi}</div>`
            }
            var detail_donasi = "";
            var jumlah = 0;
            if (e.tipe_donasi == "uang") {
                jumlah = e.nominal;
            } else {
                jumlah = parseInt(e.jumlah_barang) * parseInt(e.harga_satuan);
                detail_donasi += `<div>Nama Barang : ${e.nama_barang}</div>`;
                detail_donasi += `<div>Jumlah Barang : ${e.jumlah_barang}</div>`;
            }
            total_donasi += parseInt(jumlah);

            html += `
            <tr>
                <td data-bs-toggle="collapse" data-bs-target="#collapse${e.id}">
                    <span>(<i class="fa fa-plus td-icon"></i>)</span> ${e.jenis_donasi}
                    <div class="collapse mt-4 w-100" id="collapse${e.id}">
                        <div>Atas Nama : ${e.atas_nama}</div>
                        ${nama_project}
                        ${nama_program}
                        ${detail_donasi}
                    </div>
                </td>
                <td class="text-end">
                    Rp${formatRupiah(jumlah)},00
                </td>
                <td>
                    <div class="d-flex justify-content-center">
                        <div class="mx-1">
                            <i class="fa fa-edit text-info edit-item" data-id="${e.id}"></i>
                        </div>
                        <div class="mx-1">
                            <i class="fa fa-trash text-danger delete-item" data-id="${e.id}"></i>
                        </div>
                    </div>
                </td>
            </tr>`;
            $("#total_donasi").val("Rp"+formatRupiah(total_donasi)+",00");
        });

        $("#tbItem").html(html);
    }

    $("#saveItem").click(function () {
        var obj = {
            id_item: $("#id_item").val(),
            jenis_donasi: $("#jenis_donasi").val(),
            program_donasi: $("#program_donasi").val(),
            project_donasi: $("#project_donasi").val(),
            tipe_donasi: $("#tipe_donasi").val(),
            atas_nama: $("#atas_nama").val(),
            kategori_barang: $("#kategori_barang").val(),
            nama_barang: $("#nama_barang").val(),
            jumlah_barang: $("#jumlah_barang").val(),
            harga_satuan: $("#harga_satuan").val(),
            nominal: $("#nominal").val(),
            keterangan: $("#keterangan").val(),
        };

        if (action_item == "add") {
            var _url = '<?= base_url('donasi/save_temp_item') ?>';
        } else {
            var _url = '<?= base_url('donasi/update_temp_item') ?>';
        }

        $.ajax({
            type: 'POST',
            url: _url,
            data: obj,
            success: function(response) {
                var res = JSON.parse(response);
                if (res.status) {
                    $("#modalItem").modal("hide");
                    loadItemDonasi(res.data);
                } else {
                    showErrorMessage(res.message);
                }
            }
        });
    })

    $("#tbItem").on("click", ".delete-item", function () {
        var id = $(this).data("id");
        var obj = $(this);
        $.ajax({
            type: 'POST',
            url: '<?= base_url('donasi/delete_item') ?>',
            data: {id: id},
            success: function(response) {
                var res = JSON.parse(response);
                console.log(res);
                if (res.status) {
                    $(obj).closest("tr").remove();
                } else {
                    showErrorMessage(res.message);
                }
            }
        });
    })
    
    $("#tbItem").on("click", ".edit-item", function () {
        var id = $(this).data("id");
        var obj = $(this);
        $.ajax({
            type: 'POST',
            url: '<?= base_url('donasi/get_item_detail') ?>',
            data: {id: id},
            success: function(response) {
                var res = JSON.parse(response);
                if (res.status) {
                    var data = res.data;
                    $("#jenis_donasi").val(data.id_jenis_donasi).trigger("change");
                    setTimeout(function() {  
                        $("#program_donasi").val(data.id_program_donasi).trigger("change"); 
                        setTimeout(function() {  $("#project_donasi").val(data.id_project_donasi).trigger("change"); }, 1000);
                    }, 1000);
                    action_item = "update";
                    $("#id_item").val(data.id);
                    $("#atas_nama").val(data.atas_nama);
                    $("#tipe_donasi").val(data.tipe_donasi).trigger("change");
                    $("#kategori_barang").val(data.kategori_barang);
                    $("#nama_barang").val(data.nama_barang);
                    $("#jumlah_barang").val(data.jumlah_barang);
                    $("#harga_satuan").val(data.harga_satuan);
                    if (data.tipe_donasi == "uang") {
                        $("#nominal").val(data.nominal);
                    } else {
                        $("#nominal").val(parseInt(data.jumlah_barang) * parseInt(data.harga_satuan));
                    }
                    $("#keterangan").val(data.keterangan);

                    $("#modalItem").modal("show");
                } else {
                    showErrorMessage(res.message);
                }
            }
        });
    })

    $("#jumlah_barang, #harga_satuan").keyup(function () {
        var jumlah_barang = $("#jumlah_barang").val() == "" ? 0 : parseInt($("#jumlah_barang").val());
        var harga_satuan = $("#harga_satuan").val() == "" ? 0 : parseInt($("#harga_satuan").val())
        var nominal = jumlah_barang * harga_satuan;
        $("#nominal").val(nominal); 
    })

    $("#tbItem").on("click", `td`, function () {
        if ($(this).find(".fa-edit").length > 0) {
            return false;
        }

        if ($(this).attr(`[data-bs-toggle="collapse"]`) == undefined) {
            var check = $(this).closest("tr").find(`.collapse`).hasClass("show");
            if (check) {
                $(this).closest("tr").find(`.collapse`).removeClass("show");
            } else {
                $(this).closest("tr").find(`.collapse`).addClass("show");
            }
        }

        var check_icon = $(this).closest("tr").find(".td-icon").hasClass("fa-plus");
        console.log(check_icon);
        if (check_icon) {
            $(this).closest("tr").find(".td-icon").removeClass("fa-plus").addClass("fa-minus");
        } else {
            $(this).closest("tr").find(".td-icon").removeClass("fa-minus").addClass("fa-plus");
        }

        if ($(".td-icon.fa-minus").length > 0) {
            $(".th-icon").removeClass("fa-plus").addClass("fa-minus");
        } else {
            $(".th-icon").removeClass("fa-minus").addClass("fa-plus");
        }
    });

    $("#saveDonasi").click(function () {
        var obj = {
            email_donatur: $("#email_donatur").html(),
            tgl_donasi: $("#tgl_donasi").val(),
            departemen: $("#departemen").val(),
            jenis_pembayaran: $("#jenis_pembayaran").val(),
        };

        $.ajax({
            type: 'POST',
            url: "<?= base_url('donasi/save_donasi') ?>",
            data: obj,
            success: function(response) {
                var res = JSON.parse(response);
                if (res.status) {
                    window.location.href = res.data.redirect_url;
                } else {
                    showErrorMessage(res.message);
                }
            }
        });
    })
</script>