<?php
include "../../config/conn.php";

$movieId = isset($_GET['movieId']) ? $_GET['movieId'] : null;
$paymentPlanId = isset($_GET['paymentPlanId']) ? $_GET['paymentPlanId'] : null;

$queryPaymentPlan = mysqli_query($conn, "SELECT * FROM payment_plan WHERE id='$paymentPlanId'");
$queryMovie = mysqli_query($conn, "SELECT * FROM movie WHERE id='$movieId'");
$queryPaymentCard = mysqli_query($conn, "SELECT * FROM payment_card");
$queryPaymentPromo = mysqli_query($conn, "SELECT * FROM payment_promo");

$rowMovie = mysqli_fetch_assoc($queryMovie);
$rowPaymentPlan = mysqli_fetch_assoc($queryPaymentPlan);
$feeAdmin = 5000;
$price = $rowPaymentPlan['price'];
if (!empty($promoCode)) {
    $queryPaymentPromo = mysqli_query($conn, "SELECT * FROM payment_promo WHERE promoCode LIKE '%$promoCode%'");
    if ($queryPaymentPromo && mysqli_num_rows($queryPaymentPromo) > 0) {
        $rowPaymentPromo = mysqli_fetch_assoc($queryPaymentPromo);
        $promoDiscount = $rowPaymentPromo['discount'];
        $totalPrice = $price + $feeAdmin - $promoDiscount;
    } else {
        $totalPrice = $price + $feeAdmin;
    }
} else {
    $totalPrice = $price + $feeAdmin;
}
?>

<div class="w-full h-full min-h-[86vh]" style="background: url('<?= isset($rowMovie['backdrop_path']) ? $rowMovie['backdrop_path'] : ''; ?>'); background-size: cover; background-repeat: no-repeat">
    <div class="bg-black/50 pt-[90px] min-h-[100vh] flex justify-center items-center py-5">
        <div class="flex flex-col backdrop-blur-lg border w-full max-w-[90vw] md:max-w-[80vw] lg:max-w-[60vw] rounded-lg w-fit p-5 justify-center items-center">
            <label class="text-xl pb-5 font-bold">Checkout</label>
            <div class="block sm:flex sm:flex-row gap-5 ">
                <div class="flex w-full sm:w-fit justify-center">
                    <img src="<?= $rowMovie['poster_path']; ?>" alt="<?= $rowMovie['title']; ?>" class="flex w-[250px] rounded-lg">
                </div>
                <div class="flex flex-col gap-2">
                    <label class='text-lg'>Detail :</label>
                    <div class='flex flex-col'>
                        <div class='flex flex-col gap-1'>
                            <span>Judul : <?= $rowMovie['title']; ?></span>
                            <span>Kapasitas : <?= $rowPaymentPlan['capacity']; ?> orang</span>
                            <span>Ukuran Layar : <?= $rowPaymentPlan['screenResolution']; ?> inch</span>
                            <span class='pb-5'>Durasi : <?= $rowMovie['movieDuration']; ?> menit</span>
                        </div>
                        <div class='bg-gray-800 p-5 rounded-lg'>
                            <table>
                                <tbody>
                                    <tr class='mb-5'>
                                        <td class='pr-20'>Harga paket</td>
                                        <td>Rp <?= number_format($rowPaymentPlan['price'], 0, ',', '.'); ?></td>
                                    </tr>
                                    <?php
                                    ?>
                                    <tr class='mb-5'>
                                        <td>Fee admin</td>
                                        <td>Rp 5000</td>
                                    </tr>
                                    <tr class='mb-5'>
                                        <td>Promo</td>
                                        <td class='text-red-400'>Rp <?= number_format($promoPrice ?? 0, 0, ',', '.'); ?></td>
                                    </tr>
                                    <tr class='mb-5'>
                                        <td>Total</td>
                                        <td>Rp <?= number_format($totalPrice, 0, ',', '.'); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <form method="POST" action="pages/controller/payments/add_payment.php" class="w-full h-auto flex flex-col">
                <div class='flex flex-col'>
                    <?php
                    while ($row = mysqli_fetch_assoc($queryPaymentCard)) {
                    ?>
                        <div class="flex flex-col pb-2 items-center w-full">
                            <div class="flex flex-row w-full h-20 w-[70vw] lg:w-[40vw] justify-between rounded-tr-lg rounded-tl-lg bg-gray-800 hover:bg-gray-700 rounded-br-lg rounded-bl-lg cursor-pointer">
                                <img src="<?= $row['imageCard']; ?>" alt="card" class="w-[100px] pl-3 object-contain">
                                <input type="radio" class="flex mr-3" name="methodPayment" value="<?= $row['nameCard']; ?>" required>
                            </div>
                            <div class="flex flex-row justify-between items-center w-full py-2 bg-gray-700 text-sm rounded-br-lg rounded-bl-lg border-t-2 border-gray-600">
                                <span class="text-white pl-4 font-medium">Bayar dengan <?= $row['nameCard']; ?></span>
                                <a href="carakerja?cardName=<?= $row['nameCard']; ?>" class="text-blue-400 font-bold mr-3 border-2 border-blue-400 p-1 rounded-lg cursor-pointer animate-bounce mt-2">Cara Kerja?</a>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <div className="flex flex-col gap-5 h-auto w-full justify-center items-center">
                    <input type="hidden" name="movieId" value="<?= $movieId; ?>">
                    <input type="hidden" name="price" value="<?= $rowPaymentPlan['price']; ?>">
                    <input type="hidden" name="packageName" value="<?= $rowPaymentPlan['packageName']; ?>">
                    <div class="relative flex w-full py-2">
                        <input type="datetime-local" name="startTime" class="px-5 py-2 bg-black border border-gray-600 rounded-lg">
                    </div>
                    <div class="relative flex w-full py-2">
                        <input type="text" name="promoCode" placeholder="kode promo (opsional)" class="px-5 py-2 bg-black border border-gray-600 rounded-lg">
                    </div>
                    <div class="relative flex w-full py-2">
                        <button type="submit" id="addMovieBtn" class="bg-gray-600 hover:bg-gray-700 text-white rounded-md px-4 py-2 transition duration-200 focus:outline-none focus:ring-4 focus:ring-gray-300">Masukkan Keranjang</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const addPaymentForm = document.getElementById('addPaymentForm');

        addPaymentForm.addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(addPaymentForm);

            fetch('pages/controller/payments/add_payment.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Payment added successfully!'
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to add payment. Please try again.'
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to add payment. Please try again.'
                    });
                });
        });
    });
</script>