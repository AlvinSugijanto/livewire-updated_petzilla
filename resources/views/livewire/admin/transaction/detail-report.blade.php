<div>
    <h5 class="mb-0">Detail Transaksi Bermasalah</h5>
    <div class="card shadow-sm mt-2">
        <div class="card-body">
            <div class="d-flex">
                <button class="btn btn-outline-primary @if($type == 'laporan') active @endif" wire:click="updateType('laporan')">Info Laporan</button>
                <button class="btn btn-outline-primary ml-2 @if($type == 'transaksi') active @endif" wire:click="updateType('transaksi')">Info Transaksi</button>
                <button class="btn btn-outline-primary ml-2 @if($type == 'hewan') active @endif" wire:click="updateType('hewan')">Info Hewan</button>
            </div>

            @if($type == 'laporan')
            <livewire:admin.transaction.transaction-component.informasi-laporan :transaction="$transaction"/>
            @elseif($type == 'transaksi')
            <livewire:admin.transaction.transaction-component.informasi-transaksi :transaction="$transaction"/>
            @elseif($type == 'hewan')
            <livewire:admin.transaction.transaction-component.informasi-hewan :transaction="$transaction"/>
            @endif
        </div>
    </div>
    <div id="image-viewer">
        <span class="close"><i class="fa fa-xmark" data-dismiss="modal"></i></span>
        <img class="modal-content" id="full-image">
    </div>

    @push('scripts')
    @endpush
</div>