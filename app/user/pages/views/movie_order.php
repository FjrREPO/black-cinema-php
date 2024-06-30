<?php
include "../../config/conn.php";

$movieId = $_GET['id'] ?? null;

$query = mysqli_query($conn, "SELECT * FROM payment_plan");
?>

<div>
    <?php
    while ($row = mysqli_fetch_assoc($query)) {
    ?>
        <tr class="border-b dark:border-black/20">
            <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                <?= $row['packageName']; ?></th>
            <td class="px-4 py-3"><span><?= $row['capacity']; ?></span></td>
            <td class="px-4 py-3"><span><?= $row['screenResolution']; ?></span></td>
            <td class="px-4 py-3"><span><?= $row['price']; ?></span></td>
            <td class="px-4 py-3">
                <a href="movie_checkout?movieId=<?= $movieId; ?>&paymentPlanId=<?= $row['id']; ?>" class="bg-gray-600 hover:bg-gray-700 text-white rounded-md px-4 py-2 transition duration-200 focus:outline-none focus:ring-4 focus:ring-gray-300"></a>
            </td>
        </tr>
    <?php } ?>
</div>

<?php
mysqli_close($conn);
?>