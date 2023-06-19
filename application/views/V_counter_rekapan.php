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
                        <div>
                            <a href="javascript:void(0)" class="btn text-light btn-warning mb-0 px-3">Cari</a>
                        </div>
                    </div>
                </div>
                <div class="row p-4">
                    <div class="col-lg-12 table-responsive" width="100%">
                        <table class="table table-striped" id="tbRekapan">
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
                            <tbody>
                                <tr>
                                    <td>Test Endi</td>
                                    <td>2023-06-19</td>
                                    <td>2230610917</td>
                                    <td>Rp1.000.000,00</td>
                                    <td>Rp0,00</td>
                                    <td>Rp0,00</td>
                                    <td>Rp1.000.000,00</td>
                                </tr>
                                <tr>
                                    <td>Test Endi</td>
                                    <td>2023-06-19</td>
                                    <td>2230610915</td>
                                    <td>Rp4.000.000,00</td>
                                    <td>Rp0,00</td>
                                    <td>Rp0,00</td>
                                    <td>Rp4.000.000,00</td>
                                </tr>
                                <tr>
                                    <th>Total</th>
                                    <th></td>
                                    <th></td>
                                    <th>Rp5.000.000,00</td>
                                    <th>Rp0,00</td>
                                    <th>Rp0,00</td>
                                    <th>Rp5.000.000,00</td>
                                </tr>
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
    $("#tbRekapan").DataTable();
</script>