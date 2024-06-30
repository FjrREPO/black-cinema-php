<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Button</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        @keyframes slide-down {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-slide-down {
            animation: slide-down 0.3s ease-out;
        }

        .dark {
            --bg-color: #1a202c;
            /* Warna latar belakang tema gelap */
            --text-color: #ffffff;
            /* Warna teks untuk tema gelap */
        }

        .dark #dropdownMenu {
            background-color: var(--bg-color);
            border-color: var(--border-color);
            color: var(--text-color);
        }

        .dark #dropdownMenuButton {
            border-color: var(--border-color);
            color: var(--text-color);
        }

        .dark #signInButton {
            border-color: var(--border-color);
            color: var(--text-color);
        }
    </style>
</head>

<body class="dark:bg-gray-900">
    <div class="flex gap-4 ml-auto mx-auto items-center w-full">
        <div id="user-menu" class="relative">
            <button id="dropdownMenuButton" class="flex items-center gap-1 rounded-full px-2 border border-gray-300 hover:bg-gray-200 dark:border-gray-600 dark:hover:bg-gray-700">
                <i class="fas fa-bars w-5 h-5"></i>
                <img id="userImage" src="https://i.pinimg.com/originals/ab/29/56/ab295662776ca57b428156f0071ac8ca.png" alt="User Image" class="rounded-full" width="24" height="24">
            </button>
            <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-48 border border-gray-300 shadow-lg rounded-lg p-1 bg-white dark:bg-gray-800 dark:border-gray-600 animate-slide-down">
                <button id="profileButton" class="text-sm w-full p-2 rounded-lg text-left hover:bg-gray-200 dark:hover:bg-gray-700" type="button">
                    <a href="pages/profile.php">Profile</a>
                </button>
                <button id="signOutButton" class="text-sm w-full p-2 rounded-lg text-left hover:bg-gray-200 dark:hover:bg-gray-700" type="button">
                    Sign Out
                </button>
            </div>
        </div>
        <button id="signInButton" class="w-fit h-[37px] border border-gray-300 rounded-full px-2 dark:border-gray-600">
            <i class="fas fa-user-circle w-[25px] h-[25px] duration-300"></i>
        </button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sessionUser = {
                user: {
                    image: 'https://i.pinimg.com/originals/ab/29/56/ab295662776ca57b428156f0071ac8ca.png',
                    name: 'User Name'
                }
            }; // Ganti ini dengan data sesi pengguna Anda

            const dropdownMenuButton = document.getElementById('dropdownMenuButton');
            const dropdownMenu = document.getElementById('dropdownMenu');
            const profileButton = document.getElementById('profileButton');
            const signOutButton = document.getElementById('signOutButton');
            const signInButton = document.getElementById('signInButton');
            const userImage = document.getElementById('userImage');

            if (sessionUser && sessionUser.user) {
                userImage.src = sessionUser.user.image;
                userImage.alt = sessionUser.user.name;
                dropdownMenuButton.style.display = 'flex';
                signInButton.style.display = 'none';
            } else {
                dropdownMenuButton.style.display = 'none';
                signInButton.style.display = 'block';
            }

            dropdownMenuButton.addEventListener('click', () => {
                dropdownMenu.classList.toggle('hidden');
            });

            profileButton.addEventListener('click', () => {
                window.location.href = '/app/user/pages/profile.php';
            });

            signOutButton.addEventListener('click', () => {
                // Implementasi logika keluar di sini
                alert('Sign Out');
            });

            signInButton.addEventListener('click', () => {
                window.location.href = '/signin';
            });

            window.addEventListener('click', (event) => {
                if (!dropdownMenuButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    dropdownMenu.classList.add('hidden');
                }
            });
        });
    </script>
</body>

</html>