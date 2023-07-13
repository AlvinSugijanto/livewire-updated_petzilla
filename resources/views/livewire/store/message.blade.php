<div>

	<div class="py-2 px-4 border-bottom d-none d-lg-block">

		<div class="row">
		<img src="https://bootdey.com/img/Content/avatar/avatar5.png" class="rounded-circle mr-1" alt="Vanessa Tucker" width="40" height="40">
			<div class="col-md-4">
				<h5 class="transaction mb-0" style="font-weight:bolder">{{ $enemy_name }}</h5>
				<span class="text-success">online</span>
			</div>
		</div>

	</div>
	<div class="position-relative">
		<div class="chat-messages p-4" id="chats">

			@foreach($messages as $message)
			
			
			@if($message['sender_type'] == 'store')
			<div class="chat-message-right pb-4">
				<div>
					<img src="https://bootdey.com/img/Content/avatar/avatar4.png" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
					<div class="text-muted small text-nowrap mt-2">{{ date('j F', strtotime($message['created_at'])) }}</div>
					<div class="text-muted small text-nowrap">{{ date('g:i a', strtotime($message['created_at'])) }}</div>
				</div>
				<div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3 text">
					<div class="font-weight-bold mb-1">{{ $your_name }}</div>
					{{$message['message']}}
				</div>
			</div>
			@else
			<div class="chat-message-left pb-4">
				<div>
					<img src="https://bootdey.com/img/Content/avatar/avatar5.png" class="rounded-circle mr-1" width="40" height="40">
					<div class="text-muted small text-nowrap mt-2">{{ date('j F', strtotime($message['created_at'])) }}</div>
					<div class="text-muted small text-nowrap">{{ date('g:i a', strtotime($message['created_at'])) }}</div>
				</div>
				<div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
					<div class="font-weight-bold mb-1">{{ $enemy_name }}</div>
					{{$message['message']}}
				</div>
			</div>
			@endif


			@endforeach
		</div>
		<div class="flex-grow-0 py-3 px-4 border-top">
			<form wire:submit.prevent="sendMessage">
				<div class="input-group">
					<input type="text" class="form-control" wire:model.defer="message" placeholder="Type your message">
					<button class="btn btn-primary">Send</button>
				</div>
			</form>

		</div>

	</div>

	@push('scripts')
	<script>
		document.addEventListener('livewire:load', function() {
			var elem = document.getElementById('chats');
			elem.scrollTop = elem.scrollHeight;
		})
		window.addEventListener('scroll-bottom', function() {
			var elem = document.getElementById('chats');
			elem.scrollTop = elem.scrollHeight;
		})
	</script>
	@endpush
</div>