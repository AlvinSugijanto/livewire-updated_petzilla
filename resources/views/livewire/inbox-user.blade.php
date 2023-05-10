<div>
    <div class="container pb-3">

        <div class="card">
            <div class="row g-0">
                <div class="col-12 col-lg-5 col-xl-3 border-right pr-0" style="min-height: 80vh">
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
                <div class="col-12 col-lg-7 col-xl-9">

                    @if($toStore)
                        
                        <livewire:message key="{{ now() }}" :to_id="$toStore" />

                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</div>