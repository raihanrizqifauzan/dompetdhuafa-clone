
<div class="container-fluid pt-4 mb-5 pb-5">
    <nav aria-label="breadcrumb">
        <h6 class="font-weight-bolder text-white mb-0">Rekap Donasi</h6>
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;"><i class="fa fa-home"></i></a></li>
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Rekapan</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Rekap Donasi</li>
        </ol>
    </nav>
    
    <div class="row mt-4 justify-content-end">
      <div class="col-lg-3">
        <select class="form-control" id="">
          <option value="">Bulan Ini</option>
          <option value="">Tahun Ini</option>
          <option value="">Tahun Kemarin</option>
          <option value="">Lima Tahun Lalu</option>
        </select>
      </div>
    </div>
    <div class="row mt-2">
      <div class="col-lg-3 mb-lg-0 mb-4">
        <div class="card bg-primary text-light h-100" style="border:none">
          <div class="pb-0">
            <div class="d-flex p-3 justify-content-between align-items-center">
              <div class="w-100">
                <i class="fa fa-dashboard fa-2x"></i>
              </div>
              <div>Capaian Target 2023</div>
            </div>
          </div>
          <div class="card-body">
            <h2 class="text-center text-light">159.26%</h2>
            <div class="mt-4 pt-4">
              <div><b>Target 2023</b></div>
              <div><b>Rp400 Miliar</b></div>
              <div><b>Growth</b></div>
              <div><b>91.25%</b></div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3 mb-lg-0 mb-4">
        <div class="card h-100" style="border:none">
          <div class="pb-0">
            <div class="d-flex p-3 justify-content-between align-items-center">
              <div class="w-100">
                <i class="fa fa-money fa-2x text-info"></i>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="mt-3">
              <b class="text-muted">Total Penerimaan Donasi : </b>
              <h4>Rp. 5.520.000,00</h4>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3 mb-lg-0 mb-4">
        <div class="card h-100" style="border:none">
          <div class="pb-0">
            <div class="d-flex p-3 justify-content-between align-items-center">
              <div class="w-100">
                <i class="fa fa-users fa-2x text-primary"></i>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="mt-3">
              <b class="text-muted">Total Donatur : </b>
              <h4>5</h4>
            </div>
            <div class="mt-3">
              <b class="text-muted">Rata-rata Donasi : </b>
              <h4>Rp. 1.054.000,00</h4>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3 mb-lg-0 mb-4">
        <div class="card h-100" style="border:none">
          <div class="pb-0">
            <div class="d-flex p-3 justify-content-between align-items-center">
              <div class="w-100 text-center mt-2">
                Retensi Donatur <i class="fa fa-star text-primary"></i>
              </div>
            </div>
          </div>
          <div class="card-body">
            <h2 class="text-center">0%</h2>
            <div class="mt-4 pt-4 text-center">
              <div><b>0 Donatur</b></div>
              <div><b>1 Tahun Terakhir</b></div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row mt-4">
      <div class="col-lg-12 mb-lg-0 mb-4">
        <div class="card h-100" style="border:none">
          <div class=" pb-0">
            <div class="d-flex p-3 justify-content-between align-items-center">
              <div>
                <b class="">Donasi</b>
              </div>
            </div>
          </div>

          <div class="row py-4 px-2">
            <div class="col-lg-4">
              <div class="card bg-danger text-light h-100 pt-4 pb-2 px-4" style="border:none">
                <div>
                  <i class="fa fa-2x fa-calendar-day"></i> 0%
                </div>
                <div class="mt-2">
                  Rp. 0,00
                </div>
                <div class="mt-2">
                  Donasi Hari Ini
                </div>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="card bg-primary text-light h-100 pt-4 pb-2 px-4" style="border:none">
                <div>
                  <i class="fa fa-2x fa-calendar-week"></i> 0%
                </div>
                <div class="mt-2">
                  Rp. 0,00
                </div>
                <div class="mt-2">
                  Donasi Minggu Ini
                </div>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="card bg-warning text-light h-100 pt-4 pb-2 px-4" style="border:none">
                <div>
                  <i class="fa fa-2x fa-calendar"></i> 0%
                </div>
                <div class="mt-2">
                  Rp. 0,00
                </div>
                <div class="mt-2">
                  Donasi Bulan Ini
                </div>
              </div>
            </div>
          </div>

          <div class="row mt-2">
            <canvas id="chart-line"></canvas>
          </div>
        </div>
      </div>
    </div>

    <div class="row mt-4">
      <div class="col-lg-4 mb-lg-0 mb-4">
        <div class="card h-100" style="border:none">
          <div class="p-4">
            <div class="text-center">
              <b>Tipe Donasi</b>
              <canvas id="tipe-donasi"></canvas>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4 mb-lg-0 mb-4">
        <div class="card h-100" style="border:none">
          <div class="p-4">
            <div class="text-center">
              <b>Tipe Channel</b>
              <canvas id="tipe-channel"></canvas>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4 mb-lg-0 mb-4">
        <div class="card h-100" style="border:none">
          <div class="p-4">
            <div class="text-center">
              <b>Top 10 Program Donasi</b>
            </div>
            <div class="row" style="font-size:10px;">
              <div class="col-lg-12 table-responsive">
                <table class="table mt-2">
                  <tr>
                    <th>No</th>
                    <th>Program</th>
                    <th class="text-end">Total</th>
                  </tr>
                  <tr>
                    <td>1.</td>
                    <td>AL QURAN</td>
                    <td class="text-end">Rp. 5.000.000,00</td>
                  </tr>
                  <tr>
                    <td>2.</td>
                    <td>ZAKAT</td>
                    <td class="text-end">Rp. 300.000,00</td>
                  </tr>
                  <tr>
                    <td>3.</td>
                    <td>KAFARAT</td>
                    <td class="text-end">Rp. 200.000,00</td>
                  </tr>
                  <tr>
                    <td>4.</td>
                    <td>Investasi Cryptocurrency</td>
                    <td class="text-end">Rp. 20.000,00</td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row mt-4">
      <div class="col-lg-4 mb-lg-0 mb-4">
        <div class="card h-100" style="border:none">
          <div class="p-4">
            <div class="text-center">
              <b>Top 10 Bank Donasi</b>
            </div>
            <div class="row" style="font-size:10px;">
              <div class="col-lg-12 table-responsive">
                <table class="table mt-2">
                  <tr>
                    <th>No</th>
                    <th>Bank</th>
                    <th class="text-end">Total</th>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4 mb-lg-0 mb-4">
        <div class="card h-100" style="border:none">
          <div class="p-4">
            <div class="text-center">
              <b>Top 10 Cabang Donasi</b>
            </div>
            <div class="row" style="font-size:10px;">
              <div class="col-lg-12 table-responsive">
                <table class="table mt-2">
                  <tr>
                    <th>No</th>
                    <th>Cabang</th>
                    <th class="text-end">Total</th>
                  </tr>
                  <tr>
                    <td>1</td>
                    <td>BRANCH TEST 001	</td>
                    <td>Rp. 5.520.000,00</td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4 mb-lg-0 mb-4">
        <div class="card h-100" style="border:none">
          <div class="p-4">
            <div class="text-center">
              <b>Top 10 Counter Donasi</b>
            </div>
            <div class="row" style="font-size:10px;">
              <div class="col-lg-12 table-responsive">
                <table class="table mt-2">
                  <tr>
                    <th>No</th>
                    <th>Counter</th>
                    <th class="text-end">Total</th>
                  </tr>
                  <tr>
                    <td>1</td>
                    <td>BRANCH TEST 001	</td>
                    <td>Rp. 5.520.000,00</td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row mt-4">
      <div class="col-lg-4 mb-lg-0 mb-4">
        <div class="card h-100" style="border:none">
          <div class="p-4">
            <div class="text-center">
              <b>Top 10 Donasi Echannel</b>
            </div>
            <div class="row" style="font-size:10px;">
              <div class="col-lg-12 table-responsive">
                <table class="table mt-2">
                  <tr>
                    <th>No</th>
                    <th>ECHANNEL</th>
                    <th class="text-end">Total</th>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4 mb-lg-0 mb-4">
        <div class="card h-100" style="border:none">
          <div class="p-4">
            <div class="text-center">
              <b>Top 10 Donasi Individu</b>
            </div>
            <div class="row" style="font-size:10px;">
              <div class="col-lg-12 table-responsive">
                <table class="table mt-2">
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th class="text-end">Total</th>
                  </tr>
                  <tr>
                    <td>1</td>
                    <td>buattesting1234</td>
                    <td>Rp. 2.000.000,00</td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4 mb-lg-0 mb-4">
        <div class="card h-100" style="border:none">
          <div class="p-4">
            <div class="text-center">
              <b>Top 10 Donasi Institusi</b>
            </div>
            <div class="row" style="font-size:10px;">
              <div class="col-lg-12 table-responsive">
                <table class="table mt-2">
                  <tr>
                    <th>No</th>
                    <th>Institusi</th>
                    <th class="text-end">Total</th>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row mt-4">
      <div class="col-lg-6 mb-lg-0 mb-4">
        <div class="card h-100" style="border:none">
          <div class="p-4">
            <div class="text-center">
              <b>Gender Donor</b>
            </div>
            <canvas id="gender-donor"></canvas>
          </div>
        </div>
      </div>

      <div class="col-lg-6 mb-lg-0 mb-4">
        <div class="card h-100" style="border:none">
          <div class="p-4">
            <div class="text-center">
              <b>Top Donatur Premium Tahun Ini</b>
            </div>
            <div class="row" style="font-size:10px;">
              <div class="col-lg-12 table-responsive">
                <table class="table mt-2">
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th class="text-end">Total</th>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row mt-4">
      <div class="col-lg-12 mb-lg-0 mb-4">
        <div class="card h-100" style="border:none">
          <div class="p-4">
            <div class="">
              <b>Nominasi Donasi Favorite</b>
            </div>
            <canvas id="nominasi"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<script src="<?= base_url() ?>/assets/js/plugins/chartjs.min.js"></script>
  <script>
    var ctx1 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
    gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
    new Chart(ctx1, {
      type: "line",
      data: {
        labels: ["Apr", "May", "Jun"],
        datasets: [{
          // label: "Mobile apps",
          tension: 0.4,
          borderWidth: 0,
          pointRadius: 0,
          borderColor: "#5e72e4",
          backgroundColor: gradientStroke1,
          borderWidth: 3,
          fill: true,
          data: [150, 40, 300],
          maxBarThickness: 6

        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#fbfbfb',
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#ccc',
              padding: 20,
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
    });

    var tipe = document.getElementById("tipe-donasi").getContext("2d");
    new Chart(tipe, {
      type: 'doughnut',
      data: {
        labels: [
          'Wakaf',
          'Zakat',
          'Other'
        ],
        datasets: [{
          label: 'Tipe Donasi',
          data: [300, 50, 100],
          backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)'
          ],
        }]
      },
    })

    var tipe_channel = document.getElementById("tipe-channel").getContext("2d");
    new Chart(tipe_channel, {
      type: 'doughnut',
      data: {
        labels: [
          'COUNTER',
        ],
        datasets: [{
          data: [5520000],
          backgroundColor: [
            'rgb(255, 99, 132)',
          ],
        }]
      },
    })

    var gender_donor = document.getElementById("gender-donor").getContext("2d");
    new Chart(gender_donor, {
      type: 'doughnut',
      data: {
        labels: [
          'Pria',
          'Wanita'
        ],
        datasets: [{
          data: [50, 50],
          backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
          ],
        }]
      },
    })

    var nominasi = document.getElementById("nominasi").getContext("2d");
    new Chart(nominasi, {
      type: 'bar',
      data: {
        labels: [
          '1 - 10Rb',
          '10Rb - 100Rb',
          '100Rb - 500Rb',
          '500Rb - 1Jt',
          '1Jt - 2Jt',
          '2Jt - 5Jt',
          '5Jt - 10Jt',
        ],
        datasets: [{
          label: '',
          data: [0, 1, 2, 1, 2, 0, 0],
          backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(54, 162, 135)',
            'rgb(54, 162, 335)',
            'rgb(44, 162, 435)',
            'rgb(514, 162, 435)',
            'rgb(24, 162, 435)',
          ],
        }]
      },
    })

  </script>