<?php
include "../../config/conn.php";

$movieId = $_GET['id'] ?? null;

// Fetch the movie details
$query = mysqli_query($conn, "SELECT * FROM movie WHERE id='$movieId'");
$row = mysqli_fetch_assoc($query);

if (!$row) {
    exit('Movie not found.');
}

$genres = json_decode($row['genres'], true);
$category = json_decode($row['category'], true);
$trailer = json_decode($row['trailer'], true);

// Fetch top movies based on category
$topMoviesQuery = mysqli_query($conn, "SELECT * FROM movie WHERE category LIKE '%top movies%'");

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $row['title']; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/js/tw-elements.umd.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.4.1/flowbite.min.css" rel="stylesheet" />
</head>

<body class="w-screen min-h-screen bg-cover bg-no-repeat" style="background-image: url('<?= isset($row['backdrop_path']) ? $row['backdrop_path'] : ''; ?>');">
    <div class="flex min-h-[87vh] w-full justify-center bg-cover bg-black/50">
        <div class="w-1/3">
            <img src="<?= $row['poster_path']; ?>" class="h-[80vh] mx-auto mt-8 mb-8 rounded-lg">
        </div>
        <div class="relative w-1/3 flex justify-center mt-8">
            <div class="max-w-5xl text-white p-8 rounded-lg">
                <h1 class="text-5xl font-bold mb-4"><?= $row['title']; ?></h1>
                <p class="text-lg text-gray-300"><?= $row['overview']; ?></p>
                <div class="flex flex-col mt-4">
                    <p class="text-lg text-gray-250"><span class="font-semibold">Genre:</span> <?= implode(', ', $genres); ?></p>
                    <p class="text-lg text-gray-250"><span class="font-semibold">Category:</span> <?= implode(', ', $category); ?></p>
                    <p class="text-lg text-gray-250"><span class="font-semibold">Release Date:</span> <?= $row['release_date']; ?></p>
                    <p class="text-lg text-gray-250"><span class="font-semibold">Duration:</span> <?= $row['movieDuration']; ?></p>
                    <p class="text-lg text-gray-250"><span class="font-semibold">Voting Average:</span> <?= $row['vote_average']; ?></p>
                </div>
                <div class="flex flex-row mt-4 mx-auto justify-center lg:gap-6">
                    <a href="movie_order?id=<?= $row['id']; ?>" class="mt-4 block px-8 py-5 rounded-3xl bg-amber-500 hover:bg-amber-400 text-white">Order Tickets</a>
                    <a href="<?= $row['trailer']; ?>" class="mt-4 block px-8 py-5 rounded-3xl bg-red-600 hover:bg-red-500 text-white">Watch Trailer</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Movies Section -->
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-3xl font-bold text-white mb-4">Rekomendasi Untukmu</h2>
        <div class="flex bg-black p-4">
            <?php while ($topMovie = mysqli_fetch_assoc($topMoviesQuery)) : ?>
                <a class="flex lg:flex-row md:flex-row max-w-lg rounded-2xl overflow-hidden m-4 hover:scale-105 transition duration-200 ease-in-out" href="movie_details?id=<?= $topMovie['id'] ?>">
                    <img class="w-full md:w-60 object-cover" src="<?= $topMovie['poster_path'] ?>" alt="<?= $topMovie['title'] ?>">
                </a>
            <?php endwhile; ?>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.4.1/flowbite.min.js"></script>
</body>

</html>