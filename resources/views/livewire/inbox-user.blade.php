<div>
    <div class="container-fluid pb-4">

        <div class="row px-4">

            <div class="col-md-3 border bg-white py-2" style="min-height: 80vh">
                <h5 class="text-center"><i class="fa fa-envelope-o" aria-hidden="true"></i> Messages</h5>
                <hr class="mt-0">
                @foreach($stores as $store)
                <a href="#" wire:click.prevent="setCurrentMessage('{{ $store->id_store }}')" class="list-group-item list-group-item-action {{ $isActive == $store->id_store ? 'active' : '' }}">
                    <div class="d-flex align-items-start">
                        <img src="https://bootdey.com/img/Content/avatar/avatar5.png" class="rounded-circle mr-1" alt="Vanessa Tucker" width="40" height="40">
                        <div class="flex-grow-1 ml-3">
                            <h6 class="mb-0">{{ $store->nama_toko }}</h6>
                            <small><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $store->kabupaten }}</small>

                        </div>
                    </div>
                </a>
                @endforeach
            </div>

            <div class="col-md-9 border pt-2" style="background-color:#FFFCF8">

                @if($toStore)
                <livewire:user.message key="{{ now() }}" :to_id="$toStore" />
                @else
                <div class="no-chat">
                    <i class="fa fa-commenting-o fa-3x" aria-hidden="true"></i>
                    <h5 class="text-center mt-2">Belum ada obrolan. Silahkan memulai obrolan</h5>
                </div>

                @endif
            </div>
        </div>

    </div>
</div>