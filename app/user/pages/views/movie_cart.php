<?php
include '../../config/conn.php';

$queryPayment = mysqli_query($conn, "SELECT * FROM payment");
?>

<div>
    <h1 class="text-3xl font-bold">Keranjang</h1>
    <div class="flex flex-col">
        <div class="flex flex-col w-full">
            <div class="w-full flex flex-row items-center justify-between py-5">
                <h1 class="text-3xl font-bold">Daftar Pemesanan</h1>
            </div>
            <div class="w-full flex flex-col">
                <?php
                while ($rowPayment = mysqli_fetch_assoc($queryPayment)) {
                ?>
                    
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>