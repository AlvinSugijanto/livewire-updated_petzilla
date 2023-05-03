<link rel="stylesheet" href="path/to/layout.css" defer>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4>Chat with {{ $name }}</h4>
                </div>
                <div class="card-body chat-box">
                    <div class="message-list">
                        @foreach($messages as $message)
                            <div class="row">
                                <div class="col-md-2">
                                    <h5>{{ $message->from_id_user }}</h5>
                                </div>
                                <div class="col-md-2">
                                    <span class="time">{{ $message->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            <p>{{ $message->message }}</p>

                        @endforeach
                    </div>
                    <form wire:submit.prevent="sendMessage">
                        <div class="input-group">
                            <textarea class="form-control" wire:model="message" placeholder="Type your message here..."></textarea>
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

