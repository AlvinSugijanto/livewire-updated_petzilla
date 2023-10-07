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
        <a class="navbar-brand mr-2" href="/admin/dashboard"><img src="{{ asset('logo-name.png') }}" alt="" width="170"></a>
        <h3 class="m-0" style="font-weight:400">Admin</h3>
        <div class="ml-auto"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</div>
    </nav>
    <div class="wrapper">
        <ul class="sidebar">
            <a href="/admin/dashboard">
                <li style="margin-top:0px; font-size:18px"><i class="fa-solid fa-gauge"></i> Dashboard</li>
            </a>
            <hr class="">
            <a data-toggle="collapse" href="#collapseProduk" role="button" aria-expanded="false" aria-controls="collapseExample" class="collapseParent">
                <li class="d-flex align-items-center">
                    <i class="fa-solid fa-paw mr-2"></i>
                    <div class="mt-1">Daftar Hewan</div>
                    <i class="fa-solid fa-chevron-right ml-auto"></i>
                    <i class="fa-solid fa-chevron-down ml-auto"></i>
                </li>
            </a>

            <div class="collapse mt-2" id="collapseProduk">
                <a href="/admin/product/?type=aktif" style="text-decoration: none">
                    <div class="collapse-child">&#x2022; Aktif</div>
                </a>
                <a href="/admin/product/?type=dalam_persetujuan" style="text-decoration: none">
                    <div class="collapse-child">&#x2022; Menunggu Konfirmasi</div>
                </a>
            </div>

            <a data-toggle="collapse" href="#collapseTransaksi" role="button" aria-expanded="false" aria-controls="collapseExample" class="collapseParent">
                <li class="d-flex align-items-center">
                    <i class="fa-solid fa-file mr-2"></i>
                    <div class="mt-1">Daftar Transaksi</div>
                    <i class="fa-solid fa-chevron-right ml-auto"></i>
                    <i class="fa-solid fa-chevron-down ml-auto"></i>
                </li>
            </a>

            <div class="collapse mt-2" id="collapseTransaksi">
                <a href="#" style="text-decoration: none">
                    <div class="collapse-child">&#x2022; Berhasil</div>
                </a>
                <a href="/admin/report" style="text-decoration: none">
                    <div class="collapse-child">&#x2022; Bermasalah</div>
                </a>
                <a href="/admin/verifikasi_pembayaran" style="text-decoration: none">
                    <div class="collapse-child">&#x2022; Verifikasi Pembayaran</div>
                </a>
            </div>

            <a data-toggle="collapse" href="#collapseLaporan" role="button" aria-expanded="false" aria-controls="collapseExample" class="collapseParent">
                <li class="d-flex align-items-center">
                    <i class="fa-solid fa-book mr-2"></i>
                    <div class="mt-1">Laporan Transaksi</div>
                    <i class="fa-solid fa-chevron-right ml-auto"></i>
                    <i class="fa-solid fa-chevron-down ml-auto"></i>
                </li>
            </a>

            <div class="collapse mt-2" id="collapseLaporan">
                <a href="/admin/laporan_keseluruhan" style="text-decoration: none">
                    <div class="collapse-child">&#x2022; Keseluruhan</div>
                </a>
                <a href="/admin/by_hewan" style="text-decoration: none">
                    <div class="collapse-child">&#x2022; By Jenis Hewan</div>
                </a>
            </div>

        </ul>
        <div class="content w-100">
            {{ $slot }}
        </div>
    </div>

    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a4c037e7cb.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    @stack('scripts')
    <script>
        function toggleDropDownLogo(x) {
            const logo = document.querySelector('.wrapper-profile-dropdown');

            console.log(x.class);
        }
    </script>

</body>

</html>