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
            <livewire:admin.transaction.transaction-component.informasi-laporan :transaction="$transaction" />
            @elseif($type == 'transaksi')
            <livewire:admin.transaction.transaction-component.informasi-transaksi :transaction="$transaction" />
            @elseif($type == 'hewan')
            <livewire:admin.transaction.transaction-component.informasi-hewan :transaction="$transaction" />
            @endif
        </div>
    </div>
    <div id="image-viewer">
        <span class="close" onclick="closeImageViewer()"><i class="fa fa-xmark" data-dismiss="modal"></i></span>
        <img class="modal-content" id="full-image">
    </div>

    @push('scripts')
    <script>
        function openImage(element) {
            var src = element.src;
            $("#full-image").attr("src", src);
            $('#image-viewer').show();
        }
        
        function openSuratKeteranganSehat() {
            var surat = $('#suratKeteranganSehat').text();
            var imagePath = "{{ asset('/animal_photos/') }}" + '/' + surat;

            $("#full-image").attr("src", imagePath);
            $('#image-viewer').show();
        }

        function openSertifikatPedigree() {
            var surat = $('#sertifikatPedigree').text();
            var imagePath = "{{ asset('/animal_photos/') }}" + '/' + surat;

            $("#full-image").attr("src", imagePath);
            $('#image-viewer').show();
        }
        function closeImageViewer(){
            $('#image-viewer').hide();
        }

    </script>
    @endpush
</div>