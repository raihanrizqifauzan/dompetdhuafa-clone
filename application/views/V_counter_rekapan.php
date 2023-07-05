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
        <h6 class="font-weight-bolder text-white mb-0">Rekapan Konter</h6>
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;"><i class="fa fa-home"></i></a></li>
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Konter</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Rekapan</li>
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
                    </div>
                </div>
                <div class="row p-4">
                    <div class="col-lg-12 table-responsive" width="100%">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>NAMA FR</th>
                                    <th>TANGGAL TRX</th>
                                    <th>ID DONASI</th>
                                    <th>CASH</th>
                                    <th>EDC</th>
                                    <th>MITRA</th>
                                    <th>TOTAL</th>
                                </tr>
                            </thead>
                            <tbody id="bodyRecap">
                            </tbody>
                            <tfoot id="footRecap">
                                <tr>
                                    <th>Total</th>
                                    <th></td>
                                    <th></td>
                                    <th id="totalCash">Rp0,00</td>
                                    <th id="totalEDC">Rp0,00</td>
                                    <th id="totalMitra">Rp0,00</td>
                                    <th id="total">Rp0,00</td>
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
            url: '<?= base_url('donasi/get_recap') ?>',
            success: function(response) {
                var res = JSON.parse(response);
                var html_body = "";
                var total = 0, total_cash = 0, total_edc = 0, total_mitra = 0;
                res.forEach(e => {
                    var subtotal = parseInt(e.donasi_tunai) + parseInt(e.donasi_edc) + parseInt(e.donasi_mitra);
                    html_body += `
                    <tr>
                        <td>${e.nama_user}</td>
                        <td>${e.tgl_donasi}</td>
                        <td>${e.id}</td>
                        <td>Rp${formatRupiah(e.donasi_tunai)},00</td>
                        <td>Rp${formatRupiah(e.donasi_edc)},00</td>
                        <td>Rp${formatRupiah(e.donasi_mitra)},00</td>
                        <td>Rp${formatRupiah(subtotal)},00</td>
                    </tr>`;
                    total_cash += parseInt(e.donasi_tunai);
                    total_edc += parseInt(e.donasi_edc);
                    total_mitra += parseInt(e.donasi_mitra);
                    total += subtotal;
                });
                $("#bodyRecap").html(html_body);
                $("#totalCash").html(`Rp${formatRupiah(total_cash)},00`);
                $("#totalEDC").html(`Rp${formatRupiah(total_edc)},00`);
                $("#totalMitra").html(`Rp${formatRupiah(total_mitra)},00`);
                $("#total").html(`Rp${formatRupiah(total)},00`);
            }
        });
    }
</script>