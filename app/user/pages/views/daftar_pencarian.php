<?php
include("../../config/conn.php");

$query = '';
if (isset($_GET['query'])) {
    $query = mysqli_real_escape_string($conn, $_GET['query']);
    $sql = "SELECT * FROM movie WHERE title LIKE '%$query%' OR category LIKE '%$query%'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $hasil = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        echo "Error: " . mysqli_error($conn);
        exit;
    }
}
?>

<div class="relative pt-[100px]">
<h1 class="text-2xl font-bold mb-4">Search Results for "<?php echo htmlspecialchars($_GET['query']); ?>"</h1>
    <div class="flex bg-black p-4">
        <?php
        if (!empty($hasil)) {
            foreach ($hasil as $data) {
        ?>
                <div class="flex lg:flex-rw md:flex-row max-w-lg rounded-2xl overflow-hidden m-4 hover:scale-105 transition duration-200 ease-in-out">
                    <img class="w-full md:w-60 object-cover" src="<?= htmlspecialchars($data['poster_path']) ?>">
                </div>
        <?php
            }
        } else {
            echo "<p>No results found for '" . htmlspecialchars($_GET['query']) . "'</p>";
        }
        ?>

    </div>
</div>