<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetZilla</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/a4c037e7cb.js" crossorigin="anonymous"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        clifford: '#da373d',
                    },
                    dropShadow: {
                        'card': '17px 16px 0px rgb(133, 50, 14)',
                        'card2': '7px 7px 0px rgba(0,0,0,0.75)'
                    }
                }
            }
        }
    </script>

</head>

<body class="overflow-x-hidden">
    <section id="header" class="bg-stone-100">
        <div class="px-8 py-6">
            <div class="flex items-center justify-between">
                <div class="lg:mx-auto flex items-center">
                    <img src="{{ asset('pawprint.png') }}" class="h-10 mb-1 -rotate-12">
                    <img src="{{ asset('logo-name.png') }}" class="h-8">
                </div>

                <ul class="space-x-10 hidden md:flex lg:mx-auto">
                    <li class="text-amber-900 font-mono border-b-2 border-transparent hover:border-amber-900 cursor-pointer text-xl">Home</li>
                    <li class="text-amber-900 font-mono border-b-2 border-transparent hover:border-amber-900 cursor-pointer text-xl">Marketplace</li>
                    <li class="text-amber-900 font-mono border-b-2 border-transparent hover:border-amber-900 cursor-pointer text-xl">About Us</li>
                </ul>
                <button class="p-0 z-50 md:hidden" aria-controls="navbar-default" aria-expanded="false">
                    <svg id="navbar-hamburger" class="w-10 h-10 text-amber-900" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    <div id="closeButton" class="hidden fixed right-10 top-10">
                        <i class="fa-solid fa-x text-white fa-lg"></i>
                    </div>
                </button>
                <div class="hidden md:flex lg:mx-auto">
                    <button class="rounded-md py-1 px-3 bg-white border-2 border-yellow-800 text-yellow-800 hover:bg-yellow-800 hover:text-slate-100 drop-shadow-xl">
                        <p class="text-lg font-mono">Register Now</p>
                    </button>
                </div>
            </div>
            <div id="navbar-menu" class="hidden">
                <div class="flex h-full w-full z-40 fixed top-0 right-0 overflow-y-hidden transition-all">
                    <div class="bg-yellow-900/10 w-3/6"></div>
                    <div class="flex flex-col w-3/6 p-6 bg-yellow-900 border-r z-40 gap-10 pt-36 overflow-hidden">
                        <li class="text-white font-mono border-b-2 border-transparent hover:border-amber-900 cursor-pointer text-xl">Home</li>
                        <li class="text-white font-mono border-b-2 border-transparent hover:border-amber-900 cursor-pointer text-xl">Marketplace</li>
                        <li class="text-white font-mono border-b-2 border-transparent hover:border-amber-900 cursor-pointer text-xl">About Us</li>
                    </div>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-12 place-items-center pt-12 pb-16">

            <div class="sm:col-start-2 col-start-2 sm:col-span-6 col-span-8 justify-items-center">
                <h2 class="font-mono font-bold md:text-5xl text-4xl text-amber-900/90">Cari Hewan Peliharaan Kesayanganmu</h2>
                <p class="mt-3 text-amber-900 md:text-xl text-lg">Bersama kami, kamu dapat mencari hewan peliharaan di sekitarmu dengan mudah</p>
                <div>
                    <a href="/home">
                        <button class="mt-5 rounded-md py-2 px-4 border-2 border-yellow-800 text-white bg-yellow-800 hover:bg-yellow-900 flex items-center">
                            <p class=" font-sans">Kunjungi Marketplace </p>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z" />
                            </svg>
                        </button>
                    </a>
                </div>
            </div>
            <div class="col-span-4 justify-items-center hidden sm:block relative">
                <div class="border rounded-md border-slate-600 bg-sky-300 pt-5 drop-shadow-card">
                    <img src="{{ asset('cat-logo.png') }}" class="w-48 mx-auto">
                    <div class="flex items-center justify-around border rounded-md border-slate-600 bg-white p-3">
                        <p class="font-semibold">Kocheng Orent</p>
                        <p class="font-bold ml-12 text-yellow-900 text-lg">$125</p>

                    </div>
                </div>
                <div class="absolute top-12 left-44">
                    <img src="swirl-arrow-left-icon.png" alt="" class="-rotate-180 opacity-80">
                </div>
                <div class="absolute top-1 right-32">
                    <img src="onsale.png" alt="" class="opacity-80">
                </div>
            </div>
        </div>
    </section>

    <section id="home">
        <div class="grid md:grid-cols-3 sm:grid-cols-2 my-12 mx-8 place-items-center gap-6">

            <div class="drop-shadow-card2">
                <div class="rounded-md border-2 border-slate-900/60 p-6 bg-white max-w-80">
                    <div class="flex items-center">
                        <img src="{{ asset('location-logo.png') }}" alt="" class="w-16 h-16">
                        <p class="font-mono text-amber-900/90 lg:text-xl text-md font-bold ml-4">Cari Hewan Peliharaan</p>
                    </div>
                    <p class="font-mono text-amber-900/70 sm:text-base text-sm mt-2">Temukan hewan peliharaan yang sempurna, tepat di sekitarmu !</p>

                </div>
            </div>
            <div class="drop-shadow-card2 max-w-80">
                <div class="rounded-md border-2 border-slate-900/60 p-6 bg-white">
                    <div class="flex items-center">
                        <img src="{{ asset('verify.png') }}" alt="" class="w-16 h-16">
                        <p class="font-mono text-amber-900/90 lg:text-xl text-md font-bold ml-4">Dapatkan Hewan Peliharaan Sehat</p>
                    </div>
                    <p class="font-mono text-amber-900/70 sm:text-base text-sm mt-2">Setiap Penjual Menjamin Kesehatan Hewan </p>
                </div>
            </div>
            <div class="drop-shadow-card2 max-w-80">
                <div class="rounded-md border-2 border-slate-900/60 p-6 bg-white">
                    <div class="flex items-center">
                        <img src="{{ asset('credit-card.png') }}" alt="" class="w-16 h-16">
                        <p class="font-mono text-amber-900/90 lg:text-xl text-md font-bold ml-4 text-justify">Proses pembayaran secara instan</p>
                    </div>
                    <p class="font-mono text-amber-900/70 sm:text-base text-sm mt-2">Selesaikan transaksi mu hanya dengan beberapa tahap</p>
                </div>
            </div>
        </div>

    </section>
    <section id="pets" class="border-t-2 border-slate-600 ">
        <h2 class="font-mono text-4xl text-center mt-12">Customer's Favourite</h2>
        <div class="grid grid-cols-2 mt-12 px-16 gap-12">
            <div class="flex flex-wrap justify-center items-center gap-12 bg-orange-50 border border-slate-400 py-12 mx-auto lg:col-span-1 col-span-2">
                <div>
                    <img src="{{ asset('gambar_hewan/beagle.png') }}" alt="" class="w-28">
                    <p class="text-center font-mono text-amber-900">Beagle</p>
                </div>
                <div>
                    <img src="{{ asset('gambar_hewan/husky.png') }}" alt="" class="w-28">
                    <p class="text-center font-mono text-amber-900">Husky</p>
                </div>
                <div>
                    <img src="{{ asset('gambar_hewan/golden-retriever.png') }}" alt="" class="w-28">
                    <p class="text-center font-mono text-amber-900">Retriever</p>
                </div>
                <div>
                    <img src="{{ asset('gambar_hewan/british-shorthair.png') }}" alt="" class="w-28">
                    <p class="text-center font-mono text-amber-900">BSH</p>
                </div>
                <div>
                    <img src="{{ asset('gambar_hewan/maine-coon.png') }}" alt="" class="w-28">
                    <p class="text-center font-mono text-amber-900">Maine Coon</p>
                </div>
                <div>
                    <img src="{{ asset('gambar_hewan/oren.png') }}" alt="" class="w-28">
                    <p class="text-center font-mono text-amber-900">Oren</p>
                </div>
            </div>
            <div class="mx-auto lg:col-span-1 col-span-2 place-self-center">
                <p class="font-mono text-xl text-justify sm:block hidden">Temukan kisah mengharukan tentang hewan peliharaan favorit pelanggan kami, di mana cinta, kebersamaan, dan momen tak terlupakan melimpah. Teman-teman berbulu ini telah merajut diri mereka ke dalam kehidupan dan hati pemiliknya, membawa kebahagiaan, kenyamanan, dan kesetiaan yang tak tergoyahkan.</p>
                <p class="font-mono text-xl text-justify mt-12"><span class="text-amber-900 font-bold text-2xl underline underline-offset-4">Bergabunglah</span> dengan kami saat kami merayakan ikatan luar biasa antara manusia dan teman-teman berharga mereka, dan siaplah untuk terinspirasi oleh cinta yang tak mengenal batas dalam koleksi hewan peliharaan tercinta ini.</p>
            </div>
        </div>
        <!-- This is an example component -->


    </section>

    <section id="footer">
        <div class="flex gap-4 justify-center items-center bg-slate-600 mt-8 text-center py-4">
            <div>
                <p class="text-slate-100 font-bold font-serif">Created by</p>
                <p class="text-slate-100 font-bold font-sans">Alvin Sugijanto</p>
            </div>
            <div class="flex items-center gap-1">
                <img src="/github.png" alt="" width="30" class="border border-transparent rounded-full hover:bg-sky-200 cursor-pointer">
                <img src="/linkedin.png" alt="" width="30" class="border border-transparent rounded-full hover:bg-sky-200 cursor-pointer">

            </div>
        </div>
    </section>

    <script src="https://unpkg.com/taos@1.0.3/dist/taos.js"></script>
    <script>
        const navbarHamburger = document.getElementById('navbar-hamburger');
        const navbarMenu = document.getElementById('navbar-menu');
        const navbarClose = document.getElementById('closeButton');

        navbarHamburger.addEventListener('click', function() {
            navbarMenu.classList.toggle('hidden');
            navbarHamburger.classList.toggle('hidden');
            navbarClose.classList.toggle('hidden');

        });
        navbarClose.addEventListener('click', function() {
            navbarMenu.classList.toggle('hidden');
            navbarHamburger.classList.toggle('hidden');
            navbarClose.classList.toggle('hidden');
        });
    </script>
</body>

</html>