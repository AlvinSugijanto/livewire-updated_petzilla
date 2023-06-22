<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetZilla Admin</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

    <link href="{{ asset('css/admin.css') }}" rel='stylesheet' type='text/css' />

    @livewireStyles

</head>

<body>
    <nav class="navbar navbar-expand static-top shadow px-4" style="background-color:#FFFF">
        <a class="navbar-brand mr-2" href="#"><img src="{{ asset('logo-name.png') }}" alt="" width="170"></a>
        <h3 class="m-0" style="font-weight:400">Admin</h3>
        <div class="ml-auto"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</div>
    </nav>
    <div class="wrapper">
        <ul class="sidebar">
            <a href="/admin/dashboard">
                <li style="margin-bottom:0px; font-size:18px"><i class="fa-solid fa-gauge"></i> Dashboard</li>
            </a>
            <hr class="">
            <a href="/admin/product">
                <li><i class="fa fa-shopping-bag mr-1" aria-hidden="true"></i> Produk</li>
            </a>
            <a href="/admin/transaction">
                <li><i class="fa-solid fa-file-lines mr-1"></i> Transaksi</li>
            </a>
            <a href="/admin/report">
                <li><i class="fa-solid fa-flag mr-1"></i> Laporan User</li>
            </a>
        </ul>
        <div class="content w-100">
            {{ $slot }}
        </div>
    </div>

    @livewireScripts
    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://kit.fontawesome.com/a4c037e7cb.js" crossorigin="anonymous"></script>

</body>

</html>