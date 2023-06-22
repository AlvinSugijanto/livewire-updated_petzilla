<div>
    <div class="mt-5">
        @foreach($rating as $rate)

        <div class="d-flex mt-2">
            <div class="image-avatar">
                <i class="fa fa-user"></i>
            </div>
            <div class="d-flex flex-column ml-2">
                <div class="user_name">{{ $rate->transaction->user->name }}</div>
                <div>
                    @for($i=0; $i<$rate->rating; $i++)
                        <i class="fa fa-star text-warning" aria-hidden="true"></i>
                    @endfor
                </div>
                <span style="color:#6D7588; font-size:12px">{{ date('d F Y, H:i \W\I\B', strtotime($rate->created_at)) }}</span>
                <div class="mt-2">"{{ $rate->review }}"</div>
                <div class="d-flex mt-2">
                    <img src="{{ asset('/animal_photos/'.$rate->transaction->animal->thumbnail) }}" style="height:80px; width:70px; object-fit:cover">
                    <div class="pl-2 pr-5 py-2" style="background-color: #F4F4F4;">
                        <div class="font-weight-bold">{{ $rate->transaction->animal->judul_post }}</div>
                        <div class="font-italic" style="color:rgb(117, 117, 117); font-size:14px">Warna : {{ $rate->transaction->animal->warna }}</div>
                        <div class="font-italic" style="color:rgb(117, 117, 117); font-size:14px">Umur : {{ $rate->transaction->animal->umur }}</div>

                    </div>
                </div>
            </div>
        </div>
        <hr>
        @endforeach
    </div>
    {{ $rating->links() }}
</div>