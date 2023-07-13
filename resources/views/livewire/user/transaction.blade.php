<div>

    <div class="container">
        <div class="main-body">
            <div class="row gutters-sm">
                <div class="col-md-3">
                    <div class="card">
                        <ul class="list-group list-group-flush">

                            <a href="/user/profile">
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                    <h6 class="mb-0">Profil Saya</h5>
                                        <i class="fa fa-angle-down" aria-hidden="true"></i>
                                </li>
                            </a>

                            <a href="/user/transaction">
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap active">
                                    <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                    <h6 class="mb-0">Daftar Transaksi</h5>
                                        <i class="fa fa-angle-down" aria-hidden="true"></i>
                                </li>
                            </a>

                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <i class="fa fa-comments" aria-hidden="true"></i>
                                <h6 class="mb-0">Chat</h6>
                                <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </li>

                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <h6 class="mb-0">Review</h6>
                                <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="col-md-9 pb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-start align-items-start">
                                <button class="btn btn-transaction @if($type == 'ongoing') active @endif" wire:click="updateType('ongoing')">Berlangsung</button>
                                <button class="btn btn-transaction ml-2 @if($type == 'completed') active @endif" wire:click="updateType('completed')">Berhasil</button>
                            </div>

                            @if($type == 'ongoing')
                                <div class="d-flex flex-wrap justify-content-start align-items-start">
                                    <button class="btn btn-transaction mt-2 mr-2 @if($status == 'pengajuan_ongkir') active @endif" wire:click="updateStatus('pengajuan_ongkir')">Pengajuan Ongkir</button>
                                    <button class="btn btn-transaction mt-2 mr-2 @if($status == 'menunggu_pembayaran') active @endif" wire:click="updateStatus('menunggu_pembayaran')">Menunggu Pembayaran</button>
                                    <button class="btn btn-transaction mt-2 mr-2 @if($status == 'review_pembayaran') active @endif" wire:click="updateStatus('review_pembayaran')">Review Pembayaran</button>
                                    <button class="btn btn-transaction mt-2 mr-2 @if($status == 'sedang_diproses') active @endif" wire:click="updateStatus('sedang_diproses')">Sedang Diproses</button>
                                    <button class="btn btn-transaction mt-2 mr-2 @if($status == 'sedang_dikirim') active @endif" wire:click="updateStatus('sedang_dikirim')">Sedang Dikirim</button>
                                    <button class="btn btn-transaction mt-2 mr-2 @if($status == 'sampai_tujuan') active @endif" wire:click="updateStatus('sampai_tujuan')">Sampai Tujuan</button>

                                </div>
                                @if($status == 'pengajuan_ongkir')
                                    <livewire:user.transaction.pengajuan-ongkir />
                                @elseif($status == 'menunggu_pembayaran')
                                    <livewire:user.transaction.menunggu-pembayaran />
                                @elseif($status == 'review_pembayaran')
                                    <livewire:user.transaction.review-pembayaran />
                                @elseif($status == 'sedang_diproses')
                                    <livewire:user.transaction.sedang-di-proses />
                                @elseif($status == 'sedang_dikirim')
                                    <livewire:user.transaction.sedang-dikirim />
                                @elseif($status == 'sampai_tujuan')
                                    <livewire:user.transaction.sampai-tujuan />
                                @endif
                            @elseif($type == 'completed')

                            <div class="mt-3">
                                <livewire:user.completed-transaction />
                            </div>



                            @endif
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>



    <div wire:loading.delay class="loader-wrapper">
        <div class="text-center">
            <div class="la-ball-spin la-2x">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>

    </div>
    @push('scripts')
    <script>


        function toggleCardClass(element) {
            var cards = document.querySelectorAll('.payment-card .card');

            cards.forEach(function(card) {
                card.classList.remove('active');
            });

            element.classList.add('active');
        }
        
        window.addEventListener('submitted-pembayaran', event => {
            Swal.fire({
                title: 'Success',
                text: 'Form Pembayaran Berhasil Dikirim ! Silahkan menunggu admin meninjau pembayaran',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok',
            }).then((result) => {
                window.location = "/user/transaction?type=ongoing&status=menunggu_pembayaran";
            })
        });

        function modalConfirmation(element) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Anda tidak dapat mengubah aksi ini",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hewan saya sudah datang'
            }).then((result) => {
                if (result.isConfirmed) {

                    Livewire.emit('modalConfirmed', element);

                    Swal.fire(
                        'Succeed!',
                        'Transaksi berhasil diupdate',
                        'success'
                    ).then((result) => {
                        window.location = "/user/transaction?type=ongoing&status=sedang_dikirim";
                    })
                }
            })
        }
        function cancelTransactionConfirmation(element) {
            Swal.fire({
                title: 'Apakah anda yakin ingin membatalkan transaksi ini?',
                text: "Anda tidak dapat mengubah aksi ini",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, saya yakin'
            }).then((result) => {
                if (result.isConfirmed) {

                    Livewire.emit('cancelTransactionConfirmed', element);

                    Swal.fire(
                        'Succeed!',
                        'Transaksi berhasil dibatalkan',
                        'success'
                    ).then((result) => {
                        window.location = "/user/transaction?type=ongoing&status=pengajuan_ongkir";
                    })
                }
            })
        }
        window.addEventListener('submitted-rating', event => {
            Swal.fire({
                title: 'Success',
                text: 'Terima kasih telah melakukan rating dan review !',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok',
            }).then((result) => {
                window.location = "/user/transaction?type=ongoing&status=sampai_tujuan";
            })
        });

        window.addEventListener('submitted-report', event => {
            Swal.fire({
                title: 'Success',
                text: 'Hewan kamu sudah masuk terdaftar dalam laporan. Silahkan menunggu untuk dihubungi oleh tim kami !',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok',
            }).then((result) => {
                window.location = "/user/transaction?type=ongoing&status=sampai_tujuan";
            })
        });



    </script>
    @endpush
</div>