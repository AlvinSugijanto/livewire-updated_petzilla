<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PetZilla</title>


    {{-- Bootstrap Styles --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">


    <!-- Plugins CSS -->


    <link href="{{ asset('css/custom.css') }}" rel='stylesheet' type='text/css' />
    <link href="{{ asset('css/app.css') }}" rel='stylesheet' type='text/css' />

    <link href="{{ asset('css/chat.css') }}" rel='stylesheet' type='text/css' />
    <!-- <link href="{{ asset('https://bb17-114-142-169-10.ngrok-free.app/css/app.css') }}" rel='stylesheet' type='text/css' /> -->

    <script src="https://kit.fontawesome.com/a4c037e7cb.js" crossorigin="anonymous"></script>

    @livewireStyles
</head>

<body style="background-color:#F8F8F8">
    <header>
        <nav class="navbar navbar-expand-lg p-2" style="height:35px; background-color:#A9907E">
            <div class="container justify-content-end ">
                <div class="row align-items-center">
                    <div class="element-top">
                        <i class="fa fa-shopping-bag" style="color:#ffff" aria-hidden="true"></i>
                        <a href="/store/profile">My Store</a>
                    </div>
                    <div class="vl"></div>

                    <div class="element-top">
                        <i class="fa fa-user" aria-hidden="true" style="color:#ffff"></i>
                        <a href="/user/profile">Account</a>
                    </div>

                </div>
            </div>


        </nav>
        <div class="header_mid">
            <div class="container px-2 py-1 shadow-sm" style="background-color:white">
                <div class="row d-flex align-items-center">
                    <div class="col-md-3 text-center">
                        <a href="/home"><img src="{{ asset('logo-name.png') }}" alt="" width="200"></a>
                    </div>
                    <div class="col-md-7">
                        <div class="d-flex align-items-center">
                            <div class="categories d-flex align-items-center py-3" onclick="toggleCategoriesDropdown()">
                                <i class="fa-solid fa-list"></i>
                                <h5 class="mb-0 inter-font ml-2">Categories</h5>
                                <svg class="ml-2" xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12">
                                    <g class="nc-icon-wrapper" fill="currentColor">
                                        <path d="M10.293,3.293,6,7.586,1.707,3.293A1,1,0,0,0,.293,4.707l5,5a1,1,0,0,0,1.414,0l5-5a1,1,0,1,0-1.414-1.414Z" fill="currentColor"></path>
                                    </g>
                                </svg>
                            </div>
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
                            <div class="input-group ml-5" style="width:400px">
                                <input type="text" class="search-input" placeholder="Cari disini...">
                                <a href=""><i class="fa fa-search" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <a href="/user/inbox"><i class="fa fa-envelope" aria-hidden="true" style="color:#4D4D4C; font-size:32px"></i></a>
                        <a href="/user/wishlist"><i class="fa fa-bookmark ml-4" aria-hidden="true" style="color:#4D4D4C; font-size:30px"></i></a>


                    </div>
                </div>
            </div>
        </div>

    </header>
    <livewire:notifications />

    {{ $slot }}



    {{-- Bootstrap Scripts --}}
    @livewireScripts
    @stack('scripts')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script>

    <script src="{{ asset('../js/app.js') }}"></script>
    <!-- <script src="{{ asset('https://bb17-114-142-169-10.ngrok-free.app/js/app.js') }}"></script> -->


    <script>
        function toggleCategoriesDropdown() {
            var dropdown = document.querySelector('.categories-dropdown');
            var dropdown2 = document.querySelector('.categories');

            dropdown.classList.toggle('active');
            dropdown2.classList.toggle('active');

        }

        function scrollToBottom() {
            var elem = document.getElementById('chats');
            elem.scrollTop = elem.scrollHeight;
        }
        $(document).ready(function() {
            var $otherPreviews = $('.other-preview');

            $otherPreviews.click(function() {
                var src = $(this).attr('src');

                $('.main-preview').attr('src', src);

                $otherPreviews.removeClass('active');

                $(this).addClass('active');
            });
        });
    </script>


</body>

</html>