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
                            <b class="">Konfirmasi</b>
                        </div>
                        <div>
                            <a href="<?= base_url('confirmation') ?>" class="btn btn-sm mb-0 px-3" style="background-color: #F3F6F9;color:#7E8299"><i class="fa fa-arrow-left"></i> Back</a>
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
                            <div><b>Edit Konfirmasi</b></div>
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
                                <!-- <tr>
                                    <th>Sumber</th>
                                    <th>:</th>
                                    <td width="80%" id="sumber"></td>
                                </tr> -->
                                <tr>
                                    <th>Nama Bank Tujuan</th>
                                    <th>:</th>
                                    <td width="80%" id="nama_bank_tujuan"><?= $donasi->bank_tujuan ?></td>
                                </tr>
                                <tr>
                                    <th>Kode Rekening Tujuan</th>
                                    <th>:</th>
                                    <td width="80%" id="kode_rekening_tujuan"><?= $donasi->kode_rekening ?></td>
                                </tr>
                                <tr>
                                    <th>Nama Bank Pengirim</th>
                                    <th>:</th>
                                    <td width="80%" id="nama_bank_pengirim"><?= $donasi->bank_pengirim ?></td>
                                </tr>
                                <tr>
                                    <th>No Rekening Pengirim</th>
                                    <th>:</th>
                                    <td width="80%" id="no_rek_pengirim"><?= $donasi->no_rek_pengirim ?></td>
                                </tr>
                                <tr>
                                    <th>Atas Nama Rekening</th>
                                    <th>:</th>
                                    <td width="80%"><?= $donasi->atas_nama_pengirim ?></td>
                                </tr>
                                <tr>
                                    <th>Jumlah</th>
                                    <th>:</th>
                                    <td width="80%" id="jumlah_donasi">Rp<?= number_format($donasi->total_donasi, 2, ',', '.') ?></td>
                                </tr>
                                <tr>
                                    <th>Keterangan</th>
                                    <th>:</th>
                                    <td width="80%"><?= $donasi->keterangan_donasi ?></td>
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
                                    <input type="text" class="form-control" id="no_rekening" value="<?= $donasi->no_rek_pengirim ?>"/>
                                </div>
                                <div class="col-lg-3">
                                    <label for="">Atas Nama Pengirim</label>
                                    <input type="text" class="form-control" id="atas_nama_pengirim" value="<?= $donasi->atas_nama_pengirim ?>"/>
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
                                    <div class="mt-1" style="width:100px;height:100px">
                                        <a href="<?= base_url('user-uploads/bukti-tf-konfirmasi/').$donasi->bukti_tf ?>" target="_blank"><img src="<?= base_url('user-uploads/bukti-tf-konfirmasi/').$donasi->bukti_tf ?>" width="100%"></a>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 form-group row">
                                <div class="col-lg-12">
                                    <label for="">Keterangan</label>
                                    <input type="text" class="form-control" id="keterangan_donasi" value="<?= $donasi->keterangan_donasi ?>"/>
                                </div>
                            </div>
                            
                            <div class="mt-4 form-group row justify-content-end">
                                <div class="col-lg-12">
                                    <label class="">Total Donasi</label>
                                    <input type="text" class="form-control" id="total_donasi" value="Rp0" readonly>
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
                <div class="form-group row d-none">
                    <div class="col-lg-12">
                        <label for="">Tipe Donasi</label>
                        <select class="form-control" id="tipe_donasi">
                            <option value="uang" selected>Uang</option>
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
    var id_donasi = `<?= $donasi->id ?>`;
    var delete_item = [];
    list_item = list_item == "" ? "" : JSON.parse(list_item);
    var list_item_old = list_item;
    $(document).ready(function () {
        var data = list_item;
        list_item.forEach(e => {
            e.temp_id = null
        });
        loadItemDonasi(data);

        var id_bank_tujuan = "<?= $donasi->id_bank_tujuan ?>";
        var bank_tujuan = "<?= $donasi->bank_tujuan ?>";
        var kode_rekening = "<?= $donasi->kode_rekening ?>";
        var id_bank_pengirim = "<?= $donasi->id_bank_pengirim ?>";
        var bank_pengirim = "<?= $donasi->bank_pengirim ?>";
        var departemen = "<?= $donasi->departemen ?>";
        $("#bank").html(`<option value="${id_bank_tujuan}">${bank_tujuan}</option>`).val(id_bank_tujuan);
        $("#select_kode_rekening").html(`<option value="${kode_rekening}">${kode_rekening}</option>`).val(kode_rekening);
        $("#bank_pengirim").html(`<option value="${id_bank_pengirim}">${bank_pengirim}</option>`).val(id_bank_pengirim);
        $("#departemen").val(departemen).trigger("change")
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

    $("#tbItem").on("click", ".delete-item", function (e) {
        e.stopImmediatePropagation();
        var id = $(this).data("id");

        var idx_delete = null;
        for (let i = 0; i < list_item.length; i++) {
            if (list_item[i].id == id) {
                idx_delete = i;
                break;
            }
        }

        if (idx_delete != null) {
            list_item.splice(idx_delete, 1); 
        }
        $("#total_donasi").val("Rp0")
        loadItemDonasi(list_item);
        delete_item.push(id);
    })

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
        var bukti_tf = $('#bukti_tf').prop('files')[0];
        var form_data = new FormData(); 
        var save_item = list_item;
        form_data.append('id_donasi', "<?= $donasi->id ?>");
        form_data.append('email_donatur', $("#email_donatur").html());
        form_data.append('tgl_donasi', $("#tgl_donasi").val());
        form_data.append('bank_tujuan', $("#bank").val());
        form_data.append('kode_rekening', $("#select_kode_rekening").val());
        form_data.append('bank_pengirim', $("#bank_pengirim").val());
        form_data.append('no_rek_pengirim', $("#no_rekening").val());
        form_data.append('atas_nama_pengirim', $("#atas_nama_pengirim").val());
        form_data.append('departemen', $("#departemen").val());
        form_data.append('bukti_tf', bukti_tf);
        form_data.append('keterangan_donasi', $("#keterangan_donasi").val());
        form_data.append('list_item', JSON.stringify(save_item));
        form_data.append('delete_item', JSON.stringify(delete_item));

        $.ajax({
            type: 'POST',
            url: "<?= base_url('confirmation/update_donasi') ?>",
            data: form_data,
            processData: false,
            contentType: false,
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