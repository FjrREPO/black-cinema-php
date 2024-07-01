<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/js/tw-elements.umd.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.4.1/flowbite.min.css" rel="stylesheet" />
    <style>
        .swiper-container {
            width: 100%;
            height: 100%;
        }

        .swiper-slide {
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 8px rgba(1, 0, 1, 0.1);
            border-radius: 20px;
        }

        .swiper-slide img {
            max-width: 60%;
            max-height: 40%;
            border-radius: 20px;
        }
    </style>
</head>

<body class="h-full w-full flex flex-wrap bg-cover overflow-x-hidden" style="background-image: url('https://res.cloudinary.com/dutlw7bko/image/upload/v1717413141/Cinema/background_homes_wisn4x.jpg')">

    <div class="relative mt-10 w-full h-[50vh] ">
        <div class="absolute inset-0 flex items-center justify-center flex-col gap-5 text-center text-white">
            <h2 class="text-4xl font-bold font-manrope">Heading</h2>
            <h6 class="text-xl font-bold font-manrope">Subheading</h6>
            <form class="mt-6 flex items-center justify-center">
                <label for="default-search" class="sr-only">Search</label>
                <div class="relative">
                    <input type="search" id="default-search" class="block w-full px-10 py-4 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search..." required>
                    <button type="submit" class="absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-2 focus:ring-blue-300 focus:outline-none rounded-lg text-sm px-4 py-2 text-white dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Swiper -->
    <div class="swiper-container mt-0 mb-8 relative">
        <div class="swiper-wrapper">
            <?php
            include "E:\laragon\www\black-cinema-php\config\conn.php";
            $sql = mysqli_query($conn, "SELECT * FROM movie LIMIT 6");
            $hasil = mysqli_fetch_all($sql, MYSQLI_ASSOC);
            foreach ($hasil as $data) {
            ?>
                <div class="swiper-slide">
                    <a href="movie_details?id=<?= $data['id'] ?>" class="flex justify-center items-center">
                        <img src="<?= $data['backdrop_path'] ?>" />
                    </a>
                </div>
            <?php
            }
            ?>
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
        <!-- Add Navigation -->
        <div class="swiper-button-next absolute top-1/2 right-4 transform -translate-y-1/2"></div>
        <div class="swiper-button-prev absolute top-1/2 left-4 transform -translate-y-1/2"></div>
    </div>

    <div class="flex bg-black p-4">
        <?php
        include("conn.php");
        $sql = mysqli_query($conn, "SELECT * FROM movie");
        $hasil = mysqli_fetch_all($sql, MYSQLI_ASSOC);
        foreach ($hasil as $data) {
        ?>
            <div>
                <a class="flex lg:flex-rw md:flex-row max-w-lg rounded-2xl overflow-hidden m-4 hover:scale-105 transition duration-200 ease-in-out" href="movie_details?id=<?= $data['id'] ?>">
                    <img class="w-full md:w-60 object-cover" src="<?= $data['poster_path'] ?>" alt="<?= $data['title'] ?>">
                </a>
                <button class="toggleFavorite" data-movie-id="<?= $data['id'] ?>">
                    <span class="bookmark-icon far fa-bookmark text-yellow-500"></span>
                </button>
            </div>
        <?php
        }
        ?>
    </div>

    <script>
        $(document).ready(function() {
            $('.toggleFavorite').each(function() {
                var movieId = $(this).data('movie-id');
                var isFavorited = localStorage.getItem('favorite_' + movieId);

                if (isFavorited === 'true') {
                    $(this).find('.bookmark-icon').addClass('fas').removeClass('far');
                } else {
                    $(this).find('.bookmark-icon').addClass('far').removeClass('fas');
                }
            });

            $('.toggleFavorite').click(function() {
                var movieId = $(this).data('movie-id');
                var button = $(this);
                var isFavorited = localStorage.getItem('favorite_' + movieId);

                if (isFavorited === 'true') {
                    localStorage.setItem('favorite_' + movieId, 'false');
                    button.find('.bookmark-icon').removeClass('fas').addClass('far');
                    Swal.fire('Removed from favorites', '', 'success');
                } else {
                    localStorage.setItem('favorite_' + movieId, 'true');
                    button.find('.bookmark-icon').removeClass('far').addClass('fas');
                    Swal.fire('Added to favorites', '', 'success');
                }
            });
            var mySwiper = new Swiper('.swiper-container', {
                // Swiper options
                loop: true,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            });
        });
    </script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.4.1/flowbite.min.js"></script>
</body>

</html>