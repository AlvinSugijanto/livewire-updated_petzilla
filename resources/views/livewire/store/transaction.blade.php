<div>
    <div class="container">
        <h5>Daftar Transaksi</h5>
        <div class="card">
            <div class="card-body pl-4">
                <div class="row">
                    <button class="btn btn-transaction active">Ongoing</button>
                    <button class="btn btn-transaction ml-2">Completed</button>
                </div>
                <hr>
                <div class="collapse1">
                    <div class="d-flex align-items-center justify-content-between" data-toggle="collapse" href="#collapse1" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <h5 class="transaction">PENGAJUAN HARGA ONGKIR (0)</h5>
                        <i class="fa fa-arrow-circle-right mb-3 mr-2" aria-hidden="true"></i>
                    </div>
                    <div class="collapse" id="collapse1">
                        <div class="card card-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                        </div>
                    </div>
                    <hr class="mt-0">
                </div>
                <div class="collapse2">
                    <div class="d-flex align-items-center justify-content-between" data-toggle="collapse" href="#collapse2" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <h5 class="transaction">MENUNGGU PEMBAYARAN (0)</h5>
                        <i class="fa fa-arrow-circle-right mb-3 mr-2" aria-hidden="true"></i>
                    </div>
                    <div class="collapse" id="collapse2">
                        <div class="card card-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                        </div>
                    </div>
                    <hr class="mt-0">
                </div>
                <div class="collapse3">
                    <div class="d-flex align-items-center justify-content-between" data-toggle="collapse" href="#collapse3" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <h5 class="transaction">SEDANG DIPROSES (0)</h5>
                        <i class="fa fa-arrow-circle-right mb-3 mr-2" aria-hidden="true"></i>
                    </div>
                    <div class="collapse" id="collapse3">
                        <div class="card card-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                        </div>
                    </div>
                    <hr class="mt-0">
                </div>
                <div class="collapse4">
                    <div class="d-flex align-items-center justify-content-between" data-toggle="collapse" href="#collapse4" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <h5 class="transaction">SEDANG DIKIRIM (0)</h5>
                        <i class="fa fa-arrow-circle-right mb-3 mr-2" aria-hidden="true"></i>
                    </div>
                    <div class="collapse" id="collapse4">
                        <div class="card card-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                        </div>
                    </div>
                    <hr class="mt-0">
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
        var coll = document.getElementsByClassName("collapse");

        // Loop through all the elements with the class "collapse"
        for (var i = 0; i < coll.length; i++) {
            // Add an event listener to the "data-toggle" element
            coll[i].previousElementSibling.addEventListener("click", function() {
                // Toggle the class of the "i" element
                this.querySelector("i").classList.toggle("fa-arrow-circle-right");
                this.querySelector("i").classList.toggle("fa-arrow-circle-down");
            });
        }
    </script>
    @endpush
</div>