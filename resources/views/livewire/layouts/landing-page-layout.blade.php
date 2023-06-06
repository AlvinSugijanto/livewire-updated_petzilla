<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetZilla</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <section id="header" class="bg-stone-100">
        <div class="md:flex py-6 sm:px-16 px-8">
            <div class="flex items-center justify-between m-auto">
                <img src="{{ asset('logo-name.png') }}" class="h-8">
                <ul class="flex px-6 ml-32 space-x-10 border-r-2 border-amber-900 hidden w-full md:flex md:w-auto items-center">
                    <li class="text-amber-900 font-mono border-b-2 border-transparent hover:border-amber-900 cursor-pointer">Home</li>
                    <li class="text-amber-900 font-mono border-b-2 border-transparent hover:border-amber-900 cursor-pointer">Marketplace</li>
                    <li class="text-amber-900 font-mono border-b-2 border-transparent hover:border-amber-900 cursor-pointer">About Us</li>
                </ul>
                <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600 p-0" aria-controls="navbar-default" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-10 h-10 text-amber-900" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                    </svg>
                </button>
                <div class="flex px-6 hidden w-full md:flex md:w-auto">
                    <button class="rounded-md py-1 px-3 border-2 border-yellow-800 text-yellow-800 hover:bg-yellow-800 hover:text-slate-100">
                        <p class="text-sm font-sans">Register Now</p>
                    </button>
                </div>
            </div>
        </div>
        <div class="grid sm:grid-cols-12 grid-cols-8 place-items-center pt-12 pb-16">

            <div class="sm:col-span-4 sm:col-start-3 col-start-2 col-span-12">
                <h2 class="font-mono font-bold md:text-5xl text-4xl text-amber-900/90">Find a <a class="text-sky-400 underline decoration-sky-200"> new</a> pet for you</h2>
                <p class="mt-3 text-amber-900 md:text-xl text-lg">With us, you can find pets or sell them more easily and quickly</p>
                <div>
                    <a href="/home">
                        <button class="mt-5 rounded-md py-2 px-4 border-2 border-yellow-800 text-white bg-yellow-800 hover:bg-yellow-900 flex items-center">
                            <p class=" font-sans">Visit Marketplace </p>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z" />
                            </svg>
                        </button>
                    </a>
                </div>
            </div>
            <div class="col-span-4">
                <div class="relative z-10">
                    <img src="{{ asset('pet-article.png') }}" class="hidden sm:block sm:w-96">
                    <svg class="absolute -bottom-20 -z-20 w-full" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                        <path fill="#BAE6FF" d="M66.9,-25.2C72.1,-5.8,51.6,18.6,31.2,30.5C10.8,42.4,-9.6,41.8,-23.5,31.9C-37.4,21.9,-44.8,2.5,-39.8,-16.7C-34.8,-35.9,-17.4,-54.8,6.7,-57C30.8,-59.2,61.7,-44.6,66.9,-25.2Z" transform="translate(90 120) scale(1.4)" />
                    </svg>
                </div>

            </div>
        </div>
    </section>

    <section id="home">
        <div class="md:flex py-6 sm:px-8 px-4">

            <div class="flex flex-wrap m-auto my-10 justify-center sm:space-x-4 sm:space-y-0 space-x-2 space-y-2">
                <div class="rounded-md border-2 border-amber-900/60 sm:p-4 p-1 flex flex-col items-center sm:mt-0 mt-2 ml-2 w-72">
                    <svg class="sm:w-12 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path d="M448,256c0-106-86-192-192-192S64,150,64,256s86,192,192,192S448,362,448,256Z" style="fill:none;stroke:#22c55e;stroke-miterlimit:10;stroke-width:32px" />
                        <polyline points="352 176 217.6 336 160 272" style="fill:none;stroke:#22c55e;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                    </svg>
                    <p class="font-mono text-amber-900/90 sm:text-base text-sm font-bold">Find nearest</p>
                    <p class="font-mono text-amber-900/70 sm:text-base text-sm text-center mt-2">Discover your perfect pet, just around the corner</p>
                </div>
                <div class="rounded-md border-2 border-amber-900/60 sm:p-4 p-1 flex flex-col items-center w-72">
                    <svg class="sm:w-12 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path d="M448,256c0-106-86-192-192-192S64,150,64,256s86,192,192,192S448,362,448,256Z" style="fill:none;stroke:#22c55e;stroke-miterlimit:10;stroke-width:32px" />
                        <polyline points="352 176 217.6 336 160 272" style="fill:none;stroke:#22c55e;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                    </svg>
                    <p class="font-mono text-amber-900/90 sm:text-base text-sm font-bold">Certified Pets</p>
                    <p class="font-mono text-amber-900/70 sm:text-base text-sm text-center mt-2">Ensuring excellence through verified pedigrees</p>

                </div>
                <div class="rounded-md border-2 border-amber-900/60 sm:p-4 p-1 flex flex-col items-center  w-72">
                    <svg class="sm:w-12 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path d="M448,256c0-106-86-192-192-192S64,150,64,256s86,192,192,192S448,362,448,256Z" style="fill:none;stroke:#22c55e;stroke-miterlimit:10;stroke-width:32px" />
                        <polyline points="352 176 217.6 336 160 272" style="fill:none;stroke:#22c55e;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                    </svg>
                    <p class="font-mono text-amber-900/90 sm:text-base text-sm font-bold">Easy Payment</p>
                    <p class="font-mono text-amber-900/70 sm:text-base text-sm text-center mt-2">Simplified transactions by using instant payment</p>

                </div>
            </div>
        </div>

    </section>


</body>

</html>