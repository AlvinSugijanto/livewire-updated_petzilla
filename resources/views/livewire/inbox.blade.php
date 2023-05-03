<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4>Chat History</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($users as $user)   
                            <a href="{{ route('chat', ['to_id_user' => $user->id_user]) }}" class="list-group-item list-group-item-action{{ $to_id_user === $user->id_user ? ' active' : '' }}">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5>{{ $user->name }}</h5>

                                </div>
                            </a>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
