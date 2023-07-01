<div>
    <div class="container-fluid pb-3">

        <div class="card">
            <div class="row g-0">
                <div class="col-12 col-lg-5 col-xl-3 border-right pr-0" style="min-height: 85vh">
                @foreach($users as $user)
                    <a href="#" wire:click.prevent="setCurrentMessage('{{ $user->id_user }}')" class="list-group-item list-group-item-action {{ $isActive == $user->id_user ? 'active' : '' }}">
                        <div class="d-flex align-items-start">
                            <img src="https://bootdey.com/img/Content/avatar/avatar5.png" class="rounded-circle mr-1" alt="Vanessa Tucker" width="40" height="40">
                            <div class="flex-grow-1 ml-1">
                                <h6 class="mb-0 ml-2">{{ $user->name }}</h6>
                                <small><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $user->kabupaten }}</small>

                            </div>
                        </div>
                    </a>
                @endforeach
                </div>
                <div class="col-12 col-lg-7 col-xl-9">

                    @if($toUser)
                        
                        <livewire:store.message key="{{ now() }}" :to_id="$toUser" />

                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</div>