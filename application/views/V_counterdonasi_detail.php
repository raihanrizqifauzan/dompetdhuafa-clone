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
                <?php 
                $status_draft = ['draft', 'collect', 'settle'];
                $status_collect = ['collect', 'settle'];
                ?>
                <div class="md-step <?= (in_array($donasi->status_donasi, $status_draft)) ? "done" : "" ?> active">
                    <div class="md-step-circle"><span>1</span></div>
                    <div class="md-step-title">DRAFT</div>
                    <div class="md-step-bar-left"></div>
                    <div class="md-step-bar-right"></div>
                </div>
                <div class="md-step  <?= (in_array($donasi->status_donasi, $status_collect)) ? "done" : "" ?> active">
                    <div class="md-step-circle"><span>2</span></div>
                    <div class="md-step-title">COLLECT</div>
                    <div class="md-step-bar-left"></div>
                    <div class="md-step-bar-right"></div>
                </div>
                
                <div class="md-step <?= $donasi->status_donasi == 'settle' ? 'done active' : '' ?>">
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
                            <button class="btn btn-warning mx-1">Print Kuitansi</button>
                            <button class="btn btn-secondary mx-1">Print Wakaf</button>
                            <button class="btn btn-default mx-1">Kirim Notifikasi</button>
                            <button class="btn btn-primary mx-1" data-bs-toggle="modal" data-bs-target="#modalDonatur">Ganti Donatur</button>
                            <?php 
                                if ($donasi->status_donasi == "draft") { 
                                    echo '<button class="btn btn-danger mx-1" data-bs-toggle="modal" data-bs-target="#modalReqVoid">Void</button>';
                                }
                            ?>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <b>Edit Donasi </b><span>#<?= $donasi->id ?></span> 
                                <?php 
                                if ($donasi->status_donasi == "request_void") { ?>
                                    <span class="badge bg-warning"><?= $donasi->status_donasi ?></span></div>
                                <?php } else {
                                    ?>
                                    <span class="badge bg-default"><?= $donasi->status_donasi ?></span></div>
                                    <?php
                                }
                                ?>
                            <div>
                                <small>Tanggal Donasi</small>
                                <input type="date" value="<?= $donasi->tgl_donasi ?>" id="tgl_donasi" class="form-control" style="border:none;border-bottom:1px solid #ced4da">
                            </div>
                        </div>
                        <hr>
                        <div class="table-responsive w-100">
                            <input type="hidden" id="id_donatur">
                            <table class="table" style="border:none!important" width="100%">
                                <tr>
                                    <th>Donatur</th>
                                    <th>:</th>
                                    <td width="80%" id="nama_donatur"><?= $donasi->nama_lengkap ?></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <th>:</th>
                                    <td width="80%" id="email_donatur"><?= $donasi->email_donatur ?></td>
                                </tr>
                                <tr>
                                    <th>Telp</th>
                                    <th>:</th>
                                    <td width="80%" id="no_hp"><?= $donasi->no_hp ?></td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <th>:</th>
                                    <td width="80%" id="address"><?= $donasi->address ?></td>
                                </tr>
                                <tr>
                                    <th>Tipe</th>
                                    <th>:</th>
                                    <td width="80%" id="tipe_donatur"><?= $donasi->tipe_donatur ?></td>
                                </tr>
                                <tr>
                                    <th>Kode Rekening</th>
                                    <th>:</th>
                                    <td width="80%" id="kode_rekening"><?= $donasi->kode_rekening ?></td>
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
                                <button class="btn btn-info text-light" id="addItem">Tambah Item</button>
                            </div>
                        </div>
                        <div class="table-responsive pt-4 px-4 shadow">
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
                            <div class="mt-2 form-group row justify-content-end">
                                <div class="col-lg-6 text-end">
                                    <button id="saveDonationItem" class="btn btn-info text-light">Save Donation Item</button>
                                </div>
                            </div>
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
                                        <option value="Retail-Konter" <?= $donasi->departemen == "Retail-Konter" ? "selected" : "" ?>>Retail-Konter</option>
                                        <option value="Retail-Bank" <?= $donasi->departemen == "Retail-Bank" ? "selected" : "" ?>>Retail-Bank</option>
                                        <option value="MPZ" <?= $donasi->departemen == "MPZ" ? "selected" : "" ?>>MPZ</option>
                                        <option value="Penjemputan" <?= $donasi->departemen == "Penjemputan" ? "selected" : "" ?>>Penjemputan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row justify-content-end">
                                <div class="col-lg-6 text-end">
                                    <button id="saveDepartment" class="btn btn-info text-light">Save Department</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4 p-4 shadow justify-content-end mx-1">
                        <div class="col-lg-6">
                            <div class="d-flex justify-content-between mb-2">
                                <div>Pembayaran Tunai :</div>
                                <div>Rp. 20.000,00</div>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <div>Pembayaran Bank :</div>
                                <div>Rp. 0,00</div>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <div>Pembayaran Mitra :</div>
                                <div>Rp. 0,00</div>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <div>Pembayaran Barang :</div>
                                <div>Rp. 0,00</div>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <div>Total Donasi :</div>
                                <div>Rp. 20.000,00</div>
                            </div>
                        </div>
                    </div>
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
                            <b class="">Status Notifikasi</b>
                        </div>
                    </div>
                </div>
                <div class="w-100 p-4">
                    <div class="stepper p-4 d-flex flex-column ml-2">
                        <?php 
                        foreach ($log_notifikasi as $key => $log) { ?>
                            <div class="d-flex mb-1">
                                <div class="d-flex flex-column pr-4 align-items-center">
                                    <div class="rounded-circle p-2 bg-warning text-white mb-1">
                                        <div style="width:10px;height:10px;border-radius:50%;background:#FFF">&nbsp;</div>
                                    </div>
                                    <div class="line h-100"></div>
                                </div>
                                <div class="mx-2">
                                    <h5 class="text-dark"><?= date('d M Y H:i', strtotime($log->datetime_notifikasi)) ?></h5>
                                    <p class="lead text-muted pb-3"><i><?= $log->keterangan ?></i></p>
                                </div>
                            </div>
                            <?php 
                        }
                        ?>
                    </div>
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
                            <b class="">Log Donasi</b>
                        </div>
                    </div>
                </div>
                <div class="w-100 p-4">
                    <div class="stepper p-4 d-flex flex-column ml-2">
                        <?php 
                        $no = 1;
                        foreach ($log_donasi as $key => $log) { ?>
                            <div class="d-flex mb-1">
                                <div class="d-flex flex-column pr-4 align-items-center">
                                    <div class="rounded-circle p-2 bg-warning text-white mb-1">
                                        <div style="width:10px;height:10px;border-radius:50%;background:#FFF">&nbsp;</div>
                                    </div>
                                    <div class="line h-100"></div>
                                </div>
                                <div class="mx-2">
                                    <h5 class="text-dark"><?= date('d M Y H:i', strtotime($log->datetime_action)) ?></h5>
                                    <p class="lead text-muted pb-3"><i><?= $log->email_user ?> <?= $log->keterangan ?></i></p>
                                </div>
                            </div>
                            <?php 
                        }
                        ?>
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
    var list_item = `<?= $list_item_donasi ?>`;
    var id_donasi = `<?= $donasi->id ?>`;
    list_item = list_item == "" ? "" : JSON.parse(list_item);
    var list_item_old = list_item;
    $(document).ready(function () {
        var data = list_item;
        list_item.forEach(e => {
            e.temp_id = null
        });
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

    $(document).on("click", ".select-donatur", function (e) {
        var id_donatur = $(this).data("id");
        $.ajax({
            type: 'POST',
            url: '<?= base_url('donasi/update_email_donatur') ?>',
            data: {id_donasi: id_donasi, id_donatur: id_donatur},
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
                    showSuccessMessage(res.message);
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

            var id_target = e.id;
            if (e.id == null) {
                id_target = e.temp_id;
            }

            html += `
            <tr>
                <td data-bs-toggle="collapse" data-bs-target="#collapse${id_target}">
                    <span>(<i class="fa fa-plus td-icon"></i>)</span> ${e.jenis_donasi}
                    <div class="collapse mt-4 w-100" id="collapse${id_target}">
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
                            <i class="fa fa-edit text-info edit-item" data-id="${id_target}"></i>
                        </div>
                    </div>
                </td>
            </tr>`;
            $("#total_donasi").val("Rp"+formatRupiah(total_donasi)+",00");
        });

        $("#tbItem").html(html);
    }
    
    $("#saveDepartment").click(function (e) {
        var departemen = $("#departemen").val();
        $.ajax({
            type: 'POST',
            url: '<?= base_url('donasi/update_departemen') ?>',
            data: {id_donasi: id_donasi, departemen: departemen},
            success: function(response) {
                var res = JSON.parse(response);
                if (res.status) {
                    showSuccessMessage(res.message);
                } else {
                    showErrorMessage(res.message);
                    $("#departemen").val("<?= $donasi->departemen ?>").trigger("change");
                }
            }
        });
    })

    $("#saveDonationItem").click(function () {
        $.ajax({
            type: 'POST',
            url: '<?= base_url('donasi/update_item_donasi') ?>',
            data: {id_donasi: id_donasi, list_item: list_item},
            success: function(response) {
                var res = JSON.parse(response);
                if (res.status) {
                    showSuccessMessage(res.message);
                } else {
                    showErrorMessage(res.message);
                    list_item = list_item_old;
                    loadItemDonasi(list_item);
                }
            }
        });
    })

    function getRandomString(length) {
        let result = '';
        const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        const charactersLength = characters.length;
        let counter = 0;
        while (counter < length) {
          result += characters.charAt(Math.floor(Math.random() * charactersLength));
          counter += 1;
        }
        return result;
    }


    $("#saveItem").click(function () {
        if (action_item == "add") {
            var i = getRandomString(10);
            var obj = {
                id: i,
                temp_id: i,
                id_donasi: "<?= $donasi->id ?>",
                id_jenis_donasi: $("#jenis_donasi").val(),
                jenis_donasi: $("#jenis_donasi option:selected").text(),
                id_program_donasi: $("#program_donasi").val(),
                program_donasi: $("#program_donasi option:selected").text(),
                id_project_donasi: $("#project_donasi").val(),
                nama_project: $("#project_donasi option:selected").text(),
                tipe_donasi: $("#tipe_donasi").val(),
                atas_nama: $("#atas_nama").val(),
                kategori_barang: $("#kategori_barang").val(),
                nama_barang: $("#nama_barang").val(),
                jumlah_barang: $("#jumlah_barang").val(),
                harga_satuan: $("#harga_satuan").val(),
                nominal: $("#nominal").val(),
                keterangan: $("#keterangan").val(),
            };
            list_item.push(obj);
        } else {
            var obj = {
                id: $("#id_item").val(),
                temp_id: $("#id_item").val(),
                id_donasi: "<?= $donasi->id ?>",
                id_jenis_donasi: $("#jenis_donasi").val(),
                jenis_donasi: $("#jenis_donasi option:selected").text(),
                id_program_donasi: $("#program_donasi").val(),
                program_donasi: $("#program_donasi option:selected").text(),
                id_project_donasi: $("#project_donasi").val(),
                nama_project: $("#project_donasi option:selected").text(),
                tipe_donasi: $("#tipe_donasi").val(),
                atas_nama: $("#atas_nama").val(),
                kategori_barang: $("#kategori_barang").val(),
                nama_barang: $("#nama_barang").val(),
                jumlah_barang: $("#jumlah_barang").val(),
                harga_satuan: $("#harga_satuan").val(),
                nominal: $("#nominal").val(),
                keterangan: $("#keterangan").val(),
            };
            console.log("list_item", list_item);
            console.log("obj", obj);

            var idx = null;
            for (let i = 0; i < list_item.length; i++) {
                if (list_item[i].id == obj.id) {
                    idx = i;
                    break;
                }
            }

            if (idx == null) {
                showErrorMessage("Terjadi Kesalahan");
                return false;
            }
            
            list_item[idx] = obj;
        }

        loadItemDonasi(list_item);
        $("#modalItem").modal("hide")
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

    $("#tbItem").on("click", ".edit-item", function () {
        var id = $(this).data("id");
        var obj = $(this);

        if (isNaN(id)) {
            list_item.forEach(e => {
                if (e.temp_id == id) {
                    data = e;
                }
            });
        } else {
            var data = list_item.filter(o => o.id.includes(id));
            data = data[0];
        }

        if (data.length == 0) {
            showErrorMessage("Terjadi Kesalahan");
            return false;
        }

        $("#jenis_donasi").val(data.id_jenis_donasi).trigger("change");
        setTimeout(function() {  
            $("#program_donasi").val(data.id_program_donasi).trigger("change"); 
            setTimeout(function() {  $("#project_donasi").val(data.id_project_donasi).trigger("change"); }, 1000);
        }, 1000);
        action_item = "update";
        var id = data.id == null ? data.id : data.temp_id;
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
    })

    $("#btnSubmitVoid").click(function () {
        var keterangan = $("#keterangan_void").val();
        $.ajax({
            type: 'POST',
            url: '<?= base_url('donasi/request_void') ?>',
            data: {id_donasi: id_donasi, keterangan: keterangan},
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