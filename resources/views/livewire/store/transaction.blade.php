<div>
    <div class="container-fluid mb-5">
        <h5>Daftar Transaksi</h5>
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-start align-items-start">
                    <button class="btn btn-transaction @if($type == 'ongoing') active @endif" wire:click="updateType('ongoing')">Berlangsung</button>
                    <button class="btn btn-transaction ml-2 @if($type == 'completed') active @endif" wire:click="updateType('completed')">Selesai</button>
                </div>
                @if($type == 'ongoing')
                    <div class="d-flex justify-content-start align-items-start mt-2">
                        <button class="btn btn-transaction @if($status == 'pengajuan_ongkir') active @endif" wire:click="updateStatus('pengajuan_ongkir')">Pengajuan Ongkir</button>
                        <button class="btn btn-transaction ml-2 @if($status == 'menunggu_pembayaran') active @endif" wire:click="updateStatus('menunggu_pembayaran')">Menunggu Pembayaran</button>
                        <button class="btn btn-transaction ml-2 @if($status == 'sedang_diproses') active @endif" wire:click="updateStatus('sedang_diproses')">Sedang Diproses</button>
                        <button class="btn btn-transaction ml-2 @if($status == 'sedang_dikirim') active @endif" wire:click="updateStatus('sedang_dikirim')">Sedang Dikirim</button>
                        <button class="btn btn-transaction ml-2 @if($status == 'sampai_tujuan') active @endif" wire:click="updateStatus('sampai_tujuan')">Sampai Tujuan</button>
                    </div>
                    @if($status == 'pengajuan_ongkir')
                    <livewire:store.transaction.pengajuan-ongkir />
                    @elseif($status == 'menunggu_pembayaran')
                    <livewire:store.transaction.menunggu-pembayaran />
                    @elseif($status == 'sedang_diproses')
                    <livewire:store.transaction.sedang-di-proses />
                    @elseif($status == 'sedang_dikirim')
                    <livewire:store.transaction.sedang-dikirim />
                    @elseif($status == 'sampai_tujuan')
                    <livewire:store.transaction.sampai-tujuan />
                    @endif
                @elseif($type == 'completed')
                <div class="mt-3">
                    <livewire:store.completed-transaction />
                </div>
                @endif
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
                // Toggle the class of the "i" element within the clicked collapsible element
                var icon = this.querySelector(".arrow-icon");
                icon.classList.toggle("fa-arrow-circle-down");
                icon.classList.toggle("fa-arrow-circle-right");
            });
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
                        window.location = "/store/transaction?type=ongoing&status=pengajuan_ongkir";
                    })
                }
            })
        }
        window.addEventListener('success-notification', event=> {
            Swal.fire({
                title: 'Success',
                text: event.detail.message,
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok',

            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "/store/transaction";

                }
            })
        });
    </script>
    @endpush
</div>