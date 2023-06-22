<style>
    .nav-item .nav-link.active {
        border-bottom: 1px solid #0d6efd; 
    }
</style>
<div class="container-fluid py-4 " style="margin-bottom:100px;">
    <nav aria-label="breadcrumb">
        <h6 class="font-weight-bolder text-white mb-0">Daftar Donatur</h6>
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;"><i class="fa fa-home"></i></a></li>
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Donatur</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Daftar Donatur</li>
        </ol>
    </nav>
    
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card">
                <div class=" pb-0 border-bottom">
                    <div class="d-flex p-3 justify-content-between align-items-center">
                        <div>
                            <b class="">Donatur Baru</b>
                        </div>
                        <div>
                            <a href="<?= base_url('donatur') ?>" class="btn btn-sm mb-0 px-3" style="background-color: #F3F6F9;color:#7E8299"><i class="fa fa-arrow-left"></i> Back</a>
                        </div>
                    </div>
                </div>
                <div class="w-100 p-4">
                    <ul class="nav justify-content-start w-100 border-bottom mb-4">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Info Dasar</a>
                        </li>
                    </ul>
                    <div class="form-group row">
                        <div class="col-lg-3">
                            <label for="">Tipe Donatur</label>
                            <select id="tipe_donatur" class="form-control">
                                <option value="individu">Individu</option>
                                <option value="lembaga">Lembaga/Perusahaan</option>
                                <option value="komunitas">Komunitas</option>
                            </select>
                        </div>
                        <div class="col-lg-3">
                            <label for="">Kategori Prospek</label>
                            <select id="kategori_prospek" class="form-control">
                                <option value="prospek">Prospek</option>
                                <option value="non prospek">Non Prospek</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-3">
                            <label for="">Kategori Donatur</label>
                            <select id="kategori_donatur" class="form-control">
                                <option value="">Tidak Berkategori</option>
                                <option value="Default">Default Category</option>
                                <option value="Filantropi">Filantropi</option>
                                <option value="Ozip">Ozip</option>
                                <option value="ROIS OJK">ROIS OJK</option>
                                <option value="SOCIAL">SOCIAL BANKING (Tidak Kirim Email)</option>
                                <option value="KOMUNITAS MUSLIM CITIBANK">KOMUNITAS MUSLIM CITIBANK (Tidak Kirim Email)</option>
                                <option value="MITRA">MITRA PENGELOLA ZAKAT (MPZ)</option>
                                <option value="Donatur">Donatur Double ID</option>
                                <option value="TIDAK KIRIM EMAIL">TIDAK KIRIM EMAIL</option>
                                <option value="testKonsolidasi">testKonsolidasi</option>
                                <option value="Karyawan DD non Pusat">Karyawan DD non Pusat</option>
                                <option value="Karyawan DD Pusat">Karyawan DD Pusat</option>
                                <option value="Pejabat Negara">Pejabat Negara</option>
                                <option value="Influencer">Influencer</option>
                            </select>
                        </div>
                        <div class="col-lg-3">
                            <label for="">Sumber Data Donatur</label>
                            <select id="sumber_data_donatur" class="form-control">
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <div class="col-md-6 col-sm-12">
                            <label for="">Kirim Notifikasi berdasarkan</label> <br>
                            <input type="checkbox" name="notifikasi" value="sms"> SMS <br>
                            <input type="checkbox" name="notifikasi" value="whatsapp"> WHATSAPP <br>
                            <input type="checkbox" name="notifikasi" value="email"> EMAIL <br>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <div class="col-lg-2">
                            <label for="">Sapaan</label>
                            <select class="form-control" id="sapaan">
                                <option value="">- PILIH -</option>
                                <option value="Bapak">Bapak</option>
                                <option value="Ibu">Ibu</option>
                                <option value="Mr.">Mr.</option>
                                <option value="Mrs.">Mrs.</option>
                                <option value="Haji">Haji</option>
                                <option value="Hajjah">Hajjah</option>
                            </select>
                        </div>
                        <div class="col-lg-4">
                            <label for="">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama_lengkap">
                        </div>
                        <div class="col-lg-3">
                            <label for="">No. HP</label>
                            <input type="number" class="form-control" id="no_hp">
                        </div>
                        <div class="col-lg-3">
                            <label for="">No. HP 2</label>
                            <input type="number" class="form-control" id="no_hp2">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-3">
                            <label for="">Email</label>
                            <input type="text" class="form-control" id="email_donatur">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-8">
                            <label for="" class="text-light">Kota</label>
                            <select class="form-control" id="kota">
                                <option value="">- Cari Kota/Kecamatan -</option>
                            </select>
                        </div>
                        <div class="col-lg-4">
                            <label for="">Kode POS</label>
                            <input type="number" class="form-control" id="kode_pos">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label for="">Address</label>
                            <input type="text" class="form-control" placeholder="Address" id="address">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-4">
                            <label for="">NIK / No. KTP / No. Perusahaan</label>
                            <input type="text" class="form-control" placeholder="NIK / No. KTP / No. Perusahaan" id="no_identitas">
                        </div>
                        <div class="col-lg-4">
                            <label for="">NPWP</label>
                            <input type="text" class="form-control" placeholder="NPWP" id="npwp">
                        </div>
                        <div class="col-lg-4">
                            <label for="">NPWZ</label>
                            <input type="text" class="form-control" placeholder="NPWZ" id="npwz">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-4">
                            <label for="">Status Hidup</label>
                            <select class="form-control" id="status_hidup">
                                <option value="hidup">Hidup</option>
                                <option value="meninggal">Meninggal</option>
                            </select>
                        </div>
                        <div class="col-lg-4">
                            <label for="">Status Keaktifan</label>
                            <select class="form-control" id="status_donatur">
                                <option value="aktif">Aktif</option>
                                <option value="nonaktif">Non Aktif</option>
                            </select>
                        </div>
                        <div class="col-lg-4">
                            <label for="">Kode Rekening</label>
                            <input type="text" class="form-control" placeholder="Kode Rekening" id="kode_rekening">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-4">
                            <label for="">Terima Hard Copy</label>
                            <select class="form-control" id="terima_hard_copy">
                                <option value="tidak">Tidak</option>
                                <option value="ya">Ya</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <div class="col-lg-4">
                            <label for="">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tgl_lahir">
                        </div>
                        <div class="col-lg-4">
                            <label for="">Jenis Kelamin</label>
                            <select class="form-control" id="jenis_kelamin">
                                <option value="L">Pria</option>
                                <option value="P">Wanita</option>
                            </select>
                        </div>
                        <div class="col-lg-4">
                            <label for="">Pekerjaan</label>
                            <input type="text" class="form-control" placeholder="Pekerjaan" id="pekerjaan">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-4">
                            <label for="">Pendidikan Terakhir</label>
                            <select class="form-control" id="pendidikan_terakhir">
                                <option value="SD">SD</option>
                                <option value="SMP">SMP</option>
                                <option value="SMA">SMA</option>
                                <option value="S1">S1</option>
                                <option value="S2">S2</option>
                                <option value="S3">S3</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-end pt-4 mt-4">
                        <div><button class="btn btn-primary" id="btnSave">Save</button></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#kota').select2({
        placeholder: 'No Options',
        minimumInputLength: 1,
        ajax: {
            url: '<?= base_url('donatur/get_list_kota') ?>',
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

    $("#btnSave").click(function () {
        var notifikasi = {};

        $('input[name=notifikasi]').each(function () {
            var key = $(this).val();
            notifikasi[key] = $(this).is(':checked');
        });

        var obj = {
            tipe_donatur: $("#tipe_donatur").val(),
            kategori_prospek: $("#kategori_prospek").val(),
            kategori_donatur: $("#kategori_donatur").val(),
            notifikasi: notifikasi,
            sapaan: $("#sapaan").val(),
            nama_lengkap: $("#nama_lengkap").val(),
            no_hp: $("#no_hp").val(),
            no_hp2: $("#no_hp2").val(),
            email_donatur: $("#email_donatur").val(),
            kota: $("#kota").val(),
            kode_pos: $("#kode_pos").val(),
            address: $("#address").val(),
            no_identitas: $("#no_identitas").val(),
            npwp: $("#npwp").val(),
            npwz: $("#npwz").val(),
            status_hidup: $("#status_hidup").val(),
            status_donatur: $("#status_donatur").val(),
            kode_rekening: $("#kode_rekening").val(),
            terima_hard_copy: $("#terima_hard_copy").val(),
            tgl_lahir: $("#tgl_lahir").val(),
            pekerjaan: $("#pekerjaan").val(),
            pendidikan_terakhir: $("#pendidikan_terakhir").val(),
            jenis_kelamin: $("#jenis_kelamin").val(),
        };

        $.ajax({
            type: 'post',
            url: '<?= base_url('donatur/create') ?>',
            data: obj,
            success: function(response) {
                var res = JSON.parse(response);
                if (res.status) {
                    window.location.href = '<?= base_url('donatur') ?>'
                } else {
                    showErrorMessage(res.message);
                }
            }
        });
    })
</script>