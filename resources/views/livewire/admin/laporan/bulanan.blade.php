<div>
    <h5 class="gotham">Laporan Transaksi Bulanan</h5>
    <div class="card shadow">
        <div class="card-body">
            <h6>Pilih Tahun</h6>
            <div class="d-flex" >
                <select name="" id="" class="custom-select" style="min-width:150px; width:auto;">
                    <option value="" hidden selected>--Tahun--</option>
                    <option value="">2023</option>
                    <option value="">2022</option>
                    <option value="">2021</option>
                    <option value="">2020</option>
                </select>
                <div class="input-group-append">
                    <button class="btn btn-primary ml-2" type="button">Submit</button>
                </div>
                <div class="d-flex ml-auto align-self-center">
                    <div class="shadow rounded px-2 py-1 mr-2">Generate PDF</div>
                    <div class="shadow rounded px-2 py-1">Generate Excel</div>
                </div>
            </div>
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