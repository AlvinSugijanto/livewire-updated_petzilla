<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PetZilla</title>


    {{-- Bootstrap Styles --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" />


    <!-- Plugins CSS -->


    <link href="{{ asset('css/custom.css') }}" rel='stylesheet' type='text/css' />
    <link href="{{ asset('css/app.css') }}" rel='stylesheet' type='text/css' />

    <link href="{{ asset('css/chat.css') }}" rel='stylesheet' type='text/css' />
    <!-- <link href="{{ asset('https://bb17-114-142-169-10.ngrok-free.app/css/app.css') }}" rel='stylesheet' type='text/css' /> -->

    <script src="https://kit.fontawesome.com/a4c037e7cb.js" crossorigin="anonymous"></script>

    @livewireStyles
</head>

<body style="background-color:#F8F8F8">
    <header class="sticky-top">
        <nav class="navbar navbar-expand-lg p-2" style="height:35px; background-color:#A9907E">
            <div class="container justify-content-end ">
                <div class="row align-items-center">
                    <div class="element-top">
                        <i class="fa fa-shopping-bag" style="color:#ffff" aria-hidden="true"></i>
                        <a href="/store/profile">Toko Saya</a>
                    </div>
                    <div class="vl"></div>

                    <div class="element-top" onmouseover="hoveredProfile()" onmouseout="unHoveredProfile()">
                        <i class="fa fa-user" aria-hidden="true" style="color:#ffff"></i>
                        <a> {{ strtok(Auth::user()->name, " ") }}</a>
                        <div class="wrapper-profile-dropdown">
                            <div class="profile-dropdown bg-white pt-2 pb-4 px-4 border rounded">
                                <a href="/user/transaction">
                                    <div class="profile-child d-flex align-items-center mt-2 text-muted inter-font" style="font-size: 16px;">
                                        <i class="fa fa-shopping-bag" style="color:rgb(0,0,0,.8)" aria-hidden="true"></i>
                                        <div class="ml-2">Transaksi</div>
                                        <i class="fa fa-angle-right ml-auto" aria-hidden="true"></i>

                                    </div>
                                </a>
                                <a href="/user/profile">
                                    <div class="profile-child d-flex align-items-center mt-2 text-muted inter-font" style="font-size: 16px;">
                                        <i class="fa fa-user" style="color:rgb(0,0,0,.8)" aria-hidden="true"></i>
                                        <div class="ml-2">Profil</div>
                                        <i class="fa fa-angle-right ml-auto" aria-hidden="true"></i>

                                    </div>
                                </a>
                                <a href="/user/inbox">
                                    <div class="profile-child d-flex align-items-center mt-2 text-muted inter-font" style="font-size: 16px;">
                                        <i class="fa fa-envelope" style="color:rgb(0,0,0,.8)" aria-hidden="true"></i>
                                        <div class="ml-2">Inbox</div>
                                        <i class="fa fa-angle-right ml-auto" aria-hidden="true"></i>
                                    </div>
                                </a>
                                <a href="/user/wishlist">
                                    <div class="profile-child d-flex align-items-center mt-2 text-muted inter-font" style="font-size: 16px;">
                                        <i class="fa fa-bookmark" style="color:rgb(0,0,0,.8)" aria-hidden="true"></i>
                                        <div class="ml-2">Wishlist</div>
                                        <i class="fa fa-angle-right ml-auto" aria-hidden="true"></i>

                                    </div>
                                </a>
                                <hr class="m-1">
                                <a href="/logout">
                                    <div class="profile-child d-flex align-items-center mt-2 text-muted inter-font" style="font-size: 16px;">
                                        <i class="fa fa-right-from-bracket" style="color:rgb(0,0,0,.8)" aria-hidden="true"></i>
                                        <div class="ml-2">Logout</div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


        </nav>
        <livewire:navbar-component />
    </header>

    <div class="mt-5">
        {{ $slot }}

    </div>



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
        function hoveredProfile() {
            var profile = document.querySelector('.wrapper-profile-dropdown');

            profile.classList.toggle('active');
        }

        function unHoveredProfile() {
            var profile = document.querySelector('.wrapper-profile-dropdown');

            profile.classList.toggle('active');
        }

        function toggleCategoriesDropdown() {
            var dropdown = document.querySelector('.categories-dropdown');

            dropdown.classList.toggle('active');

        }

        function toggleProfileDropdown() {
            var profile = document.querySelector('.profile-dropdown');

            profile.classList.toggle('active');

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
        window.addEventListener('error-modal', event => {

            const {
                detail
            } = event;
            const message = detail && detail.message ? detail.message : 'Oops.. Ada Kesalahan. Silahkan Mencoba Kembali';

            Swal.fire({
                title: 'Error',
                text: message,
                icon: 'error',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok',
            })
        });
    </script>


</body>

</html>