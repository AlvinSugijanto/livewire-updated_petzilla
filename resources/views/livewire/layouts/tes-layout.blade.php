<!DOCTYPE html>
<html lang="en">

<head>

    <title>Elemen Kopi</title>

    <!-- Custom fonts for this template-->
    <script src="https://kit.fontawesome.com/a4c037e7cb.js" crossorigin="anonymous"></script>
    <!-- <link href="../css/fontawesome/css/all.min.css" rel="stylesheet"> -->

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">



    <!-- Custom styles for this template-->
    <link href="../css/zzzz.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/chat.css') }}" rel='stylesheet' type='text/css' />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    @livewireStyles


</head>

<body id="page-top">

    <nav class="navbar navbar-expand navbar-dark static-top shadow" style="background-color:#FFFF">
        <div class="row col-md-12">
            <div class="col-md-4">
                <a href="/home"><img src="{{ asset('logo-name.png') }}" alt="" width="170"></a>
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
                <div class="row d-flex justify-content-between align-items-center flex-wrap">
                    <div class="col-md-4">
                        <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Store photo" class="rounded-circle border text-right" width="100%">
                    </div>
                    <div class="col-md-8 mt-2">
                        <p style="font-size:14px; margin:0px; padding:0px">Hi,</p>
                        <div class="store-name" style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
                            <h5 style="font-size:14px">Manila PetShoppppppppppppp</h5>
                        </div>
                    </div>
                </div>

            </div>


            <hr class="sidebar-divider">

            <li class="nav-item px-3">
                <a href="/store/profile" class="d-flex nav-child btn align-items-center @if($blueButton == 'profil') active @endif">
                    <i class="fa fa-shopping-bag mr-2" aria-hidden="true"></i>
                    <h5 class="mb-0">Profil Toko</h5>
                </a>
            </li>
            <li class="nav-item px-3 mt-3">
                <a href="/store/products" class="d-flex btn nav-child align-items-center @if($blueButton == 'produk') active @endif">
                    <i class="fa fa-shopping-bag mr-2" aria-hidden="true"></i>
                    <h5 class="mb-0" >Daftar Produk</h5>
                </a>
            </li>
            <li class="nav-item px-3 mt-3">
                <a href="/store/transaction" class="d-flex btn nav-child align-items-center @if($blueButton == 'transaksi') active @endif">
                    <i class="fa fa-shopping-bag mr-2" aria-hidden="true"></i>
                    <h5 class="mb-0">Transaction</h5>
                </a>
            </li>
            <li class="nav-item px-3 mt-3">
                <a href="/mystore" class="d-flex btn nav-child align-items-center">
                    <i class="fa fa-shopping-bag mr-2" aria-hidden="true"></i>
                    <h5 class="mb-0">Review Toko</h5>
                </a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link" href="/ongoing-order">
                <i class="fas fa-fw fa-table"></i>
                <span style="font-size:14px; font-weight:bold; color:#707070">Daftar Produk</span></a>
            </li> -->
            <!-- <li class="nav-item">
                <a class="nav-link" href="/ingredients">
                <i class="fa fa-comments" aria-hidden="true"></i>
                <span style="font-size:14px; font-weight:bold; color:#707070">Review</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-hamburger" style=""></i>
                    <span style="font-size:14px; font-weight:bold; color:#707070">Menu</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="py-2 collapse-inner rounded" style="background-color:#CEC8C8">
                        <a class="collapse-item" href="/menu" style="font-size:13px; font-weight:bold; color:#313131">Menu</a>
                        <a class="collapse-item" href="/advanced-menu" style="font-size:13px; font-weight:bold; color:#313131">Advanced Menu</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Ingredients"
                    aria-expanded="true" aria-controls="collapseUtilities">
                     <i class="fas fa-fw fa-table"></i> -->
            <!-- <i class="fa-solid fa-kitchen-set"></i>
                    <span style="font-size:14px; font-weight:bold; color:#707070">Purchase</span>
                </a>
                <div id="Ingredients" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="py-2 collapse-inner rounded" style="background-color:#CEC8C8">
                        <a class="collapse-item" href="/ingredients_purchase" style="font-size:13px; font-weight:bold; color:#313131">Ingredients Purchase</a>
                        <a class="collapse-item" href="/other_purchase" style="font-size:13px; font-weight:bold; color:#313131">Other Purchase</a>
                    </div>
                </div>
            </li> -->

            <!-- <hr class="sidebar-divider d-none d-md-block">
                        
            <li class="nav-item">
                <a class="nav-link" href="/overall-report">
                <i class="fa-solid fa-fw fa-book-open"></i>
                <span style="font-size:14px; font-weight:bold; color:#707070">Report</span></a>
            </li> -->



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
    </script>



</body>

</html>