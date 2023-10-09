<div>
    <h5 class="gotham">Laporan Transaksi Tahunan</h5>
    <div class="card shadow">
        <div class="card-body">
            <div class="d-flex">
                <div>
                    <h6>Pilih Tahun</h6>
                    <select wire:model.defer="tahun" class="custom-select" style="min-width:150px; width:auto;">
                        <option value="" hidden selected>--Tahun--</option>
                        <option value="2023">2023</option>
                        <option value="2022">2022</option>
                        <option value="2021">2021</option>
                        <option value="2020">2020</option>
                    </select>
                </div>
                <div class="input-group-append align-self-end">
                    <button class="btn btn-primary ml-2" type="button" wire:click="onSubmit()">Submit</button>
                </div>
                <div class="d-flex ml-auto align-self-center">
                    <div class="border rounded px-2 py-2 mr-2" onclick="window.print()"><i class="fa-solid fa-print"></i> Print</div>

                </div>
            </div>
            <div id="tableJudul" style="visibility: hidden;">
                <h5>Tabel Transaksi Tahunan (2023)</h5>
            </div>
            <table class="table mt-4" id="tableBulanan">
                <thead>
                    <tr>
                        <th scope="col">Bulan</th>
                        <th scope="col">Jumlah Transaksi</th>
                        <th scope="col">Nilai Transaksi</th>
                        <th scope="col">Biaya Pengiriman</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($datas as $data)
                    <tr>
                        <td>{{ $data['bulan'] }}</td>
                        <td>{{ $data['jumlah'] }}</td>
                        <td>Rp. {{ number_format($data['grand_total'] - $data['biaya_pengiriman'],0,',','.') }}</td>
                        <td>Rp. {{ number_format($data['biaya_pengiriman'],0,',','.') }}</td>
                    </tr>
                    @endforeach
                    @if($openChart)
                    <div class="card shadow my-4" id="chart" wire:ignore>
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Tabel Penjualan</h6>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                    <div class="dropdown-header">Dropdown Header:</div>
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart-area">
                                <div class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand">
                                        <div class=""></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink">
                                        <div class=""></div>
                                    </div>
                                </div>
                                <canvas id="myAreaChart" style="display: block; height: 320px; width: 427px;" width="469" height="352" class="chartjs-render-monitor"></canvas>
                            </div>
                        </div>
                    </div>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    @push('scripts')

    <script>
        Livewire.on('chartLoaded', data => {
            console.log(data);
            var transaction_data = [];

            for (let i = 0; i < data.length; i++) {
                transaction_data[i] = data[i]['grand_total'];
            }
            console.log(transaction_data);
            openChart(transaction_data);

        })


        function openChart(transaction_data) {
            var ctx = document.getElementById("myAreaChart");
            let chartStatus = Chart.getChart("myAreaChart"); // <canvas> id
            if (chartStatus != undefined) {
                chartStatus.destroy();
            }
            var myLineChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ["January", "February", "March", "April", "Mey", "June", "July", "August", "September", "October", "November", "December"],
                    datasets: [{
                        label: "Nilai Transaksi",
                        lineTension: 0.3,
                        backgroundColor: "rgba(78, 115, 223)",
                        borderColor: "rgba(78, 115, 223, 1)",
                        pointRadius: 3,
                        pointBackgroundColor: "rgba(78, 115, 223, 1)",
                        pointBorderColor: "rgba(78, 115, 223, 1)",
                        pointHoverRadius: 3,
                        pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                        pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                        pointHitRadius: 10,
                        pointBorderWidth: 2,
                        data: transaction_data,
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    layout: {
                        padding: {
                            left: 10,
                            right: 25,
                            top: 25,
                            bottom: 0
                        }
                    },
                    scales: {
                        xAxes: [{
                            time: {
                                unit: 'date'
                            },
                            gridLines: {
                                display: false,
                                drawBorder: false
                            },
                            ticks: {
                                maxTicksLimit: 7
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                maxTicksLimit: 5,
                                padding: 10,
                                // Include a dollar sign in the ticks
                                callback: function(value, index, values) {
                                    return '$' + number_format(value);
                                }
                            },
                            gridLines: {
                                color: "rgb(234, 236, 244)",
                                zeroLineColor: "rgb(234, 236, 244)",
                                drawBorder: false,
                                borderDash: [2],
                                zeroLineBorderDash: [2]
                            }
                        }],
                    },
                    legend: {
                        display: false
                    },
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        titleMarginBottom: 10,
                        titleFontColor: '#6e707e',
                        titleFontSize: 14,
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        intersect: false,
                        mode: 'index',
                        caretPadding: 10,
                        callbacks: {
                            label: function(tooltipItem, chart) {
                                var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                                return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
                            }
                        }
                    }
                }
            });
        }
    </script>
    @endpush
</div>