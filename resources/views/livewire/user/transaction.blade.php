<div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <livewire:user.layout.user-profile-layout :type="'transaction'" />
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
    <div id="image-viewer">
        <span class="download" onclick="downloadImage()"><i class="fa fa-download"></i></span>
        <span class="close"><i class="fa fa-xmark" onclick="closeImageViewer()"></i></span>

        <img class="modal-content" id="full-image">
    </div>

    @push('scripts')
    <script>
        function openImageViewer() {
            var imagePath = $('#buktiPengiriman').text();

            $("#full-image").attr("src", imagePath);
            $('#image-viewer').show();
        }

        function closeImageViewer() {
            $('#image-viewer').hide();
        }

        function downloadImage() {
            var src = document.getElementById("full-image").src;
            fetch(src)
                .then(response => response.blob())
                .then(blob => {
                    const url = URL.createObjectURL(blob);
                    const link = document.createElement('a');
                    link.href = url;
                    link.download = 'image';
                    link.click();
                    URL.revokeObjectURL(url);
                });
        }


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
            console.log('test');
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