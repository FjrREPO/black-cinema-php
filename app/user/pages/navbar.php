<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar User</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="pages\navstyle.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
</head>

<body>
    <nav class="hidden md:block p-5 z-50" style="background-color: rgba(0, 0, 0, 0.3);">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto">
            <a href="home.php" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="https://res.cloudinary.com/dutlw7bko/image/upload/v1716618897/Cinema/Logo/Cuplikan_layar_2024-05-14_083355_jr8lu6_1_wc2vsh.png" class="h-12 rounded-lg" alt="Flowbite Logo" />
                <span class="self-center text-2xl font-bold whitespace-nowrap text-white dark:text-white">Black Cinema</span>
            </a>
            <div class="flex gap-3">
                <div class="nav-icon rounded-lg text-white bg-black absolute z-50 text-sm p-3" id="info-icon">
                    <i class="fas fa-info-circle text-xl hover:scale-125"></i>
                    <div class="absolute right-0 mt-4 top-full w-40 origin-top-right  border border-gray-100 rounded-xl bg-black hidden " id="info-dropdown">
                        <a href="#" class="block mx-1 my-1 rounded-lg px-2 py-2 text-sm text-white hover:bg-gray-700">Tentang Kami</a>
                        <a href="#" class="block mx-1 my-1 rounded-lg px-2 py-2 text-sm text-white hover:bg-gray-700">Faq</a>
                        <a href="#" class="block mx-1 my-1 rounded-lg px-2 py-2 text-sm text-white hover:bg-gray-700">Hubungi kami</a>
                    </div>
                </div>
                <a href="#" class="nav-icon rounded-lg text-white bg-black absolute text-sm p-3 hover:scale-125" id="bookmark-icon">
                    <i class="fas fa-bookmark text-xl hover:scale-125"></i>
                </a>
                <a href="#" class="nav-icon rounded-lg text-white bg-black absolute text-sm p-3 hover:scale-125" id="bell-icon">
                    <i class="fas fa-bell text-xl hover:scale-125"></i>
                </a>
                <a href="movie_cart" class="nav-icon rounded-lg text-white bg-black absolute text-sm p-3 hover:scale-125" id="cart-icon">
                    <i class="fas fa-shopping-cart text-xl hover:scale-125"></i>
                </a>
                <button data-collapse-toggle="navbar-menu" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-muted-foreground dark:text-muted-foreground rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
            </div>
            <div class="items-center justify-between z-50 hidden w-full md:flex md:w-auto" id="navbar-menu">
                <ul class="flex flex-col items-center p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0" id="navbar-menu-list">
                    <li>
                        <?php include("profileuser.php"); ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const infoIcon = document.getElementById('info-icon');
            const infoDropdown = document.getElementById('info-dropdown');

            infoIcon.addEventListener('click', function(event) {
                infoDropdown.classList.toggle('hidden');
                event.stopPropagation();
            });

            window.addEventListener('click', function(event) {
                if (!infoIcon.contains(event.target) && !infoDropdown.contains(event.target)) {
                    infoDropdown.classList.add('hidden');
                }
            });
        });
    </script>
</body>

</html>