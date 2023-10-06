<div>
    <h5 class="gotham">Laporan Keseluruhan Transaksi</h5>
    <div class="card shadow">
        <div class="card-body">
            <h6>Tanggal</h6>
            <div class="d-flex">
                <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; display:inline-block; background-color:#ECE9E9">
                    <i class="fa fa-calendar"></i>&nbsp;
                    <span></span> <i class="fa fa-caret-down"></i>
                </div>
                <button class="btn btn-primary ml-2" id="submitButton">Submit</button>
                <div class="d-flex ml-auto align-self-center">
                    <div class="shadow rounded px-2 py-1 mr-2">Generate PDF</div>
                    <div class="shadow rounded px-2 py-1">Generate Excel</div>
                </div>
            </div>

            <table class="table mt-4">
                <thead>
                    <tr>
                        <th scope="col">Jenis Hewan</th>
                        <th scope="col" class="text-center">Jumlah Transaksi</th>
                        <th scope="col" class="text-center">Nilai Transaksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jenis_hewan as $hewan)
                    <tr>
                        <td>{{ $hewan->jenis_hewan }}</td>
                        <td class="text-center">{{ $hewan->jumlah }}</td>
                        <td class="text-center">Rp. {{ number_format($hewan->subtotal,0,',','.') }}</td>
                    </tr>
                    @endforeach

                    <tr class="total gotham" style="font-size:15px; background-color: #e8e8e8; border-bottom:1px solid black">
                        <td class="font-weight-bold">Total Transaksi</td>
                        <td class="font-weight-bold text-center">{{ $total_transaksi }}</td>
                        <td></td>
                    </tr>
                    <tr class="total gotham" style="font-size:15px; background-color: #e8e8e8;">
                        <td class="font-weight-bold">Total Uang</td>
                        <td></td>
                        <td class="font-weight-bold text-center">Rp. {{ number_format($grand_total - $total_biaya_pengiriman,0,',','.') }}</td>
                    </tr>

                    <tr class="total gotham" style="font-size:15px; background-color: #e8e8e8;">
                        <td class="font-weight-bold">Grand Total</td>
                        <td></td>
                        <td class="font-weight-bold text-center">Rp. {{ number_format($grand_total,0,',','.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @push('scripts')
    <script>
        $(document).ready(function() {
            var start;
            var end;

            $(function() {
                start = moment().subtract(29, 'days');
                end = moment();

                function cb(start, end) {
                    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                }

                $('#reportrange').daterangepicker({
                    startDate: start,
                    endDate: end,
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    }
                }, cb);

                cb(start, end);

                // Listen for datepicker apply event and update start and end variables
                $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
                    start = picker.startDate;
                    end = picker.endDate;
                });

            });

            $("#submitButton").on("click", function() {

                const startDate = start.format('MM/DD/YYYY');
                const endDate = end.format('MM/DD/YYYY');

                const date = {
                    startDate: startDate,
                    endDate: endDate
                }
                
                Livewire.emit('submitButton', date);

            });
        });


        function submitDate() {
            const startDate = start.format('MM/DD/YYYY');
            const endDate = end.format('MM/DD/YYYY');
            console.log(startDate);
            const date = {
                startDate: startDate,
                endDate: endDate
            }
            // console.log(date);
            // Livewire.emit('submitButton', date);
        }
    </script>
    @endpush
</div>