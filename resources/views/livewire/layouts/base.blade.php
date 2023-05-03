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
    <link href="{{ asset('css/plugin.css') }}" rel='stylesheet' type='text/css' />


    <link href="{{ asset('css/custom.css') }}" rel='stylesheet' type='text/css' />
    <link href="{{ asset('css/app.css') }}" rel='stylesheet' type='text/css' />

    <link href="{{ asset('css/chat.css') }}" rel='stylesheet' type='text/css' />

    <script src="https://use.fontawesome.com/e4d06741cf.js"></script>

    @livewireStyles
</head>

<body style="background-color:#F3F3F3">
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
            <div class="container p-2" style="background-color:white">
                <div class="row d-flex align-items-center">
                    <div class="col-md-3">
                        <a href="/home"><img src="{{ asset('logo.png') }}" alt="" width="250"></a>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group rounded">
                            <input type="search" class="form-control rounded" placeholder="Cari di sini..." aria-label="Search" aria-describedby="search-addon" style="height:50px" />
                            <span class="input-group-text border-0" id="search-addon">
                                <a href=""><i class="fa fa-search" aria-hidden="true"></i></a>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-3 text-center">
                        <a href="#"><i class="fa fa-envelope fa-2x" aria-hidden="true" style="color:#4D4D4C"></i></a>
                        <a href=""><i class="fa fa-heart fa-2x ml-3" aria-hidden="true" style="color:#4D4D4C"></i></a>


                    </div>
                </div>
            </div>
        </div>

    </header>
    {{ $slot }}



    {{-- Bootstrap Scripts --}}
    @livewireScripts
    @stack('scripts')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script>

    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>
    <script src="{{ asset('../js/app.js') }}"></script>
    <script>
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