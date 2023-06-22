<style>
    .nav-item .nav-link.active {
        border-bottom: 1px solid #0d6efd; 
    }

    .table th, .table td {
        border:none!important;
    }

    thead, tbody {
        border:none!important;
    }
</style>
<div class="container-fluid py-4 " style="margin-bottom:100px;">
    <nav aria-label="breadcrumb">
        <h6 class="font-weight-bolder text-white mb-0">Rekap Donasi</h6>
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;"><i class="fa fa-home"></i></a></li>
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Rekapan</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Rekap Donasi</li>
        </ol>
    </nav>
    
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card">
                <div class=" pb-0 border-bottom">
                    <div class="d-flex p-3 justify-content-between align-items-center">
                        <div>
                            <b class="">Rekapan Donasi</b>
                        </div>
                        <div>
                            <a href="javascript:void(0)" class="btn text-light btn-warning mb-0 px-3">Cari</a>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center p-4">
                    <div class="table-responsive" width="100%">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>TIPE DONASI</th>
                                    <th class="text-end">TOTAL TRANSAKSI</th>
                                    <th class="text-end">TOTAL DONASI</th>
                                </tr>
                            </thead>
                            <tbody id="bodyRecap">
                            </tbody>
                            <tfoot id="footRecap">
                                <tr>
                                    <th>Total</th>
                                    <th class="text-end" id="totalTransaksi">0</td>
                                    <th class="text-end" id="totalDonasi">Rp0,00</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        loadData();
    })

    function loadData() {
        $.ajax({
            type: 'GET',
            url: '<?= base_url('donasi/get_recap_tipe_donasi') ?>',
            success: function(response) {
                var res = JSON.parse(response);
                var html_body = "";
                var total = 0, total_transaksi = 0;;
                res.forEach(e => {
                    html_body += `
                    <tr>
                        <td>${e.jenis_donasi}</td>
                        <td class="text-end">${formatRupiah(e.total_trx)}</td>
                        <td class="text-end">Rp${formatRupiah(e.total_donasi)},00</td>
                    </tr>`;
                    total_transaksi += parseInt(e.total_trx);
                    total += parseInt(e.total_donasi);
                });
                $("#bodyRecap").html(html_body);
                $("#totalTransaksi").html(`${formatRupiah(total_transaksi)}`);
                $("#totalDonasi").html(`Rp${formatRupiah(total)},00`);
            }
        });
    }
</script>