<!DOCTYPE html>
<html lang="en">

<head>

    <title>Petzilla Seller</title>

    <!-- Custom fonts for this template-->
    <script src="https://kit.fontawesome.com/a4c037e7cb.js" crossorigin="anonymous"></script>
    <!-- <link href="../css/fontawesome/css/all.min.css" rel="stylesheet"> -->

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">



    <!-- Custom styles for this template-->
    <link href="{{ asset('css/zzzz.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/chat.css') }}" rel='stylesheet' type='text/css' />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    @livewireStyles


</head>

<body id="page-top">

    <nav class="navbar navbar-expand navbar-dark static-top shadow" style="background-color:#FFFF">
        <div class="row col-md-12">
            <div class="col-md-4">
                <div class="d-flex align-items-center">
                    <a href="/home"><img src="{{ asset('logo-name.png') }}" alt="" width="170"></a>
                    <h3 class="mb-1 ml-2" style="font-weight:400">Seller</h3>
                </div>

            </div>
            <div class="col-md-8 text-right">
                <a href="/store/inbox"><i class="fa fa-envelope fa-xl" aria-hidden="true" style="color:black"></i></a>
                <a href=""><i class="fa fa-bell fa-xl ml-3" aria-hidden="true" style="color:black"></i></a>

            </div>
        </div>
    </nav>


    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color:#A9907E">

            <div class="card" style="margin:10px; padding:10px">
                <div class="d-flex justify-content-between align-items-center">
                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Store photo" class="rounded-circle border" width="50px">

                    <div class="ml-2">
                        <p style="font-size:14px" class="m-0">Hi,</p>
                        <div style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
                            <h5 style="font-size:14px" class="mb-0">{{ Auth::user()->store->nama_toko }}</h5>
                        </div>
                    </div>
                </div>

            </div>


            <hr class="sidebar-divider">

            <li class="nav-item px-3">
                <a href="/store/profile" class="d-flex align-items-center btn @if($blueButton == 'profil') active @endif">
                    <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                    <h5 class="mb-0 ml-2">Profil Toko</h5>
                </a>
            </li>
            <li class="nav-item px-3 mt-3">
                <a class="d-flex btn nav-child justify-content-between align-items-center @if($blueButton == 'produk') active @endif" data-toggle="collapse" href="#collapseProduk" role="button" aria-expanded="false" aria-controls="collapseExample">
                    <div class="d-flex align-items-center">
                        <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                        <h5 class="mb-0 ml-2">Produk</h5>
                    </div>

                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                    </svg>
                </a>
                <div class="collapse mt-3" id="collapseProduk">
                    <a href="/store/add-product" style="text-decoration: none">
                        <div class="d-flex align-items-center collapse-child p-1">
                            <h5 class="cloud-font mb-0 text-light ml-2" style="font-size:14px">Tambah Produk</h5>
                        </div>
                        <a href="/store/products" style="text-decoration: none">
                            <div class="d-flex align-items-center mt-2 collapse-child p-1">
                                <h5 class="cloud-font mb-0 text-light ml-2" style="font-size:14px">Daftar Produk</h5>
                            </div>
                        </a>
                </div>
            </li>
            <li class="nav-item px-3 mt-3">
                <a href="/store/transaction" class="d-flex btn nav-child align-items-center @if($blueButton == 'transaksi') active @endif">
                    <i class="fa fa-shopping-bag mr-2" aria-hidden="true"></i>
                    <h5 class="mb-0">Transaction</h5>
                </a>
            </li>
            <li class="nav-item px-3 mt-3">
                <a href="/store/review" class="d-flex btn nav-child align-items-center @if($blueButton == 'review') active @endif">
                    <i class="fa fa-shopping-bag mr-2" aria-hidden="true"></i>
                    <h5 class="mb-0">Review Toko</h5>
                </a>
            </li>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->

                <div class="container-fluid mt-3">
                    {{ $slot }}
                </div>
                <!-- /.container-fluid -->

            </div>

        </div>
        <!-- End of Content Wrapper -->

    </div>


    @livewireScripts
    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script>

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