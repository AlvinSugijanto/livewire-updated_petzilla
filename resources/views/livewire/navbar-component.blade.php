<div class="header_mid">
    <div class="container-fluid shadow-sm py-2" style="background-color:white">
        <div class="row align-items-center">
            <div class="col-md-3 text-center d-none d-md-block">
                <a href="/home"><img src="{{ asset('logo-name.png') }}" alt="" width="200"></a>
            </div>
            <div class="col-md-6">
                <div class="categories-dropdown">
                    <div class="container">
                        <div class="card">
                            <div class="card-body">
                                <h6>Popular Categories</h6>
                                <hr>
                                <div class="d-flex align-items-center">
                                    <div class="d-flex justify-content-between border rounded px-5 py-2" style="background-color:#DCDBDB">
                                        <i class="fa-solid fa-cat"></i>
                                        <h6 class="mb-0 ml-3">Kucing</h6>
                                    </div>
                                    <div class="d-flex justify-content-between border rounded px-5 py-2 ml-3" style="background-color:#DCDBDB">
                                        <i class="fa-solid fa-dog"></i>
                                        <h6 class="mb-0 ml-3">Anjing</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="input-group">

                    <input type="text" class="search-input" wire:model="search" wire:keydown.enter="findAnimal()" placeholder="Cari disini...">
                    <a href=""><i class="fa fa-search" aria-hidden="true"></i></a>

                </div>
            </div>
            <div class="col-md-3 d-none d-md-block">
                <div class="d-flex justify-content-center">
                    <div class="position-relative">
                        @if(Auth::check())
                        <a href="/user/inbox">
                            <i class="fa fa-envelope fa-xl" aria-hidden="true" style="color:rgb(0,0,0,.8); font-size:30px; margin-top:13px"></i>
                        </a>
                        @else
                            <a href="/login"><button class="btn-login">Login</button></a>
                        @endif
                    </div>
                    <div class="position-relative">
                        @if(Auth::check())
                        <a href="/user/cart">
                            <i class="fa-solid fa-cart-shopping ml-4 fa-md" style="color:rgb(0,0,0,.8); font-size:30px"></i>
                            <div class="countNotification">5</div>
                        </a>
                        @else
                            <a href="/register"><button class="btn-register">Register</button></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>