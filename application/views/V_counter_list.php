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
        <h6 class="font-weight-bolder text-white mb-0">Daftar Konter</h6>
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;"><i class="fa fa-home"></i></a></li>
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Konter</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Daftar Konter</li>
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
                            <a href="<?= base_url('donasi/counter/list') ?>" class="btn text-light btn-warning mb-0 px-3">Cari</a>
                            <a href="<?= base_url('donasi/counter/list') ?>" class="btn btn-primary mb-0 px-3">Export Donasi</a>
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
</script>