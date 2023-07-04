<style>
    .pagination li{
        margin-left:12px !important;
    }

    .filter-input th {
        padding-left: 3px!important;
        padding-right: 3px!important;
    }
</style>
<div class="container-fluid py-4" style="margin-bottom:100px;">
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
                            <b class="">Daftar Donatur</b>
                        </div>
                        <div>
                            <!-- <button class="btn btn-sm mb-0 px-3" style="background-color: #FFA800;color:#FFF">Cari</button> -->
                            <a href="<?= base_url('donatur/new') ?>" class="btn btn-sm mb-0 px-3" style="background-color: #8950FC;color:#FFF">Tambah Donatur</a>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center w-100 py-4 px-4">
                    <div class="table-responsive">
                        <table class="table" id="example">
                            <thead>
                                <tr>
                                    <th class="text-center">ID DONATUR</th>
                                    <th>NAMA</th>
                                    <th>HP</th>
                                    <th>EMAIL</th>
                                    <th>TIPE DONATUR</th>
                                    <th class="text-center">STATUS</th>
                                    <th class="text-center">ACTION</th>
                                </tr>
                                <tr class="filter-input">
                                    <th class="text-center"><input type="number" class="form-control" id="filter-id"></th>
                                    <th><input type="text" class="form-control" id="filter-nama"></th>
                                    <th><input type="number" class="form-control" id="filter-hp"></th>
                                    <th><input type="text" class="form-control" id="filter-email"></th>
                                    <th>
                                        <select class="form-control" id="filter-tipe">
                                            <option value="">All</option>
                                            <option value="individu">Individu</option>
                                            <option value="lembaga">Lembaga</option>
                                            <option value="komunitas">Komunitas</option>
                                        </select>
                                    </th>
                                    <th class="text-center">
                                        <select class="form-control" id="filter-status">
                                            <option value="">All</option>
                                            <option value="aktif">Active</option>
                                            <option value="nonaktif">Inactive</option>
                                        </select>
                                    </th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- <tr>
                                    <td>1230610015</td>
                                    <td>ENDI</td>
                                    <td>+6281802136200</td>
                                    <td>endi@lastono@gmail.com</td>
                                    <td>INDIVIDU</td>
                                    <td class="text-center"><span class="badge bg-success">ACTIVE</span></td></td>
                                    <td class="text-center">
                                        <div class="mx-1"><i class="fa fa-edit text-primary"></i></div>
                                    </td>
                                </tr> -->
                            </tbody>
                        </table>
                        <!-- <div class="d-flex mb-2">
                            <div>
                                <select class="px-3 py-1" id="" style="border:none;background:#eee!important">
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                </select>
                                <small>Showing 1 rows to 1 of data</small>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var table = $('#example').DataTable( {
        "processing": true,
        "serverSide": true,
        "serverMethod" : "post",
        ordering: false,
        searching: false,
        "ajax": {
            "url" : "<?= base_url('donatur/get_list_donatur') ?>",
            "type": "POST",
            data:function(data) {
                data.id_donatur = $("#filter-id").val();
                data.nama_lengkap = $("#filter-nama").val();
                data.no_hp = $("#filter-hp").val();
                data.email_donatur = $("#filter-email").val();
                data.tipe_donatur = $("#filter-tipe").val();
                data.status_donatur = $("#filter-status").val();
            }
        },
        "bDestroy":true,
        bInfo: false,
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

    $("#filter-id, #filter-nama, #filter-email, #filter-hp").keyup(delay( async function () {
        table.ajax.reload();
    }, 300));

    $("#filter-status, #filter-tipe").change(delay(async function () {
        table.ajax.reload();
    }, 300))
</script>