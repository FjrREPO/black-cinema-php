<?php
include '../../config/conn.php';

$queryPayment = mysqli_query($conn, "SELECT * FROM payment WHERE status = 'pending' AND userId = '{$_SESSION['user_id']}' AND expiredPayment > NOW()");
$queryTotalPrice = mysqli_query($conn, "SELECT SUM(totalPrice) FROM payment WHERE status = 'pending' AND userId = '{$_SESSION['user_id']}' AND expiredPayment > NOW()");
$rowTotalPrice = mysqli_fetch_assoc($queryTotalPrice);
?>

<div class="w-screen min-h-screen">
    <div class="w-full bg-cover bg-black/50">
        <div class="flex flex-col w-full justify-center items-center pt-[100px]">
            <h2 class="title font-manrope font-bold text-4xl leading-10 mb-8 text-center text-white">Keranjang
            </h2>
            <?php if (mysqli_num_rows($queryPayment) > 0) { ?>
                <div>
                    <div class="grid md:grid-cols-2 gap-4">
                        <?php
                        while ($rowPayment = mysqli_fetch_assoc($queryPayment)) {
                            $queryMovie = mysqli_query($conn, "SELECT * FROM movie WHERE id = '{$rowPayment['movieId']}'");
                            $rowMovie = mysqli_fetch_assoc($queryMovie);
                        ?>
                            <div class="rounded-2xl border-2 border-gray-200 p-4 lg:p-8 grid grid-cols-12 mb-8 max-lg:max-w-lg max-lg:mx-auto gap-y-4 ">
                                <div class="col-span-12 lg:col-span-3 flex items-center">
                                    <img src="<?= $rowMovie['poster_path'] ?>" alt="speaker image" class="max-lg:w-full lg:w-[200px] rounded-lg">
                                </div>
                                <div class="col-span-12 lg:col-span-9 detail w-full lg:pl-3 flex flex-col justify-between">
                                    <div>
                                        <div class="flex items-center justify-between w-full mb-4">
                                            <h5 class="font-manrope font-bold text-2xl leading-9 text-white"><?= $rowMovie['title'] ?></h5>
                                            <button class="rounded-full group flex items-center justify-center focus-within:outline-red-500">
                                                <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <circle class="fill-red-50 transition-all duration-500 group-hover:fill-red-400" cx="17" cy="17" r="17" fill="" />
                                                    <path class="stroke-red-500 transition-all duration-500 group-hover:stroke-white" d="M14.1673 13.5997V12.5923C14.1673 11.8968 14.7311 11.333 15.4266 11.333H18.5747C19.2702 11.333 19.834 11.8968 19.834 12.5923V13.5997M19.834 13.5997C19.834 13.5997 14.6534 13.5997 11.334 13.5997C6.90804 13.5998 27.0933 13.5998 22.6673 13.5997C21.5608 13.5997 19.834 13.5997 19.834 13.5997ZM12.4673 13.5997H21.534V18.8886C21.534 20.6695 21.534 21.5599 20.9807 22.1131C20.4275 22.6664 19.5371 22.6664 17.7562 22.6664H16.2451C14.4642 22.6664 13.5738 22.6664 13.0206 22.1131C12.4673 21.5599 12.4673 20.6695 12.4673 18.8886V13.5997Z" stroke="#EF4444" stroke-width="1.6" stroke-linecap="round" />
                                                </svg>
                                            </button>
                                        </div>
                                        <p class="font-normal text-base leading-7 text-gray-500 mb-6 line-clamp-2">
                                            <?= $rowMovie['overview'] ?>
                                        </p>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <div class="flex items-center gap-4">
                                            <span class="font-semibold text-lg">Paket <?= $rowPayment['packageName'] ?></span>
                                        </div>
                                        <h6 class="font-manrope font-semibold text-lg leading-9 text-right">Rp <?= number_format($rowPayment['totalPrice'], 2, ',', '.') ?></h6>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="flex flex-row w-full justify-between items-center">
                        <h5 class="font-manrope font-semibold text-2xl leading-9 w-full max-md:text-center max-md:mb-4">Subtotal</h5>
                        <div class="font-manrope font-semibold text-xl text-white flex flex-row gap-2">
                            <span>Rp</span>
                            <span><?= number_format($rowTotalPrice['SUM(totalPrice)'] ?? 0, 2, ',', '.') ?></span>
                        </div>
                    </div>
                    <div class="max-lg:max-w-lg max-lg:mx-auto">
                        <p class="font-normal text-base leading-7 text-gray-500 text-center mb-5 mt-6">Shipping taxes, and discounts
                            calculated
                            at checkout</p>
                        <button class="rounded-full py-4 px-6 bg-indigo-600 text-white font-semibold text-lg w-full text-center transition-all duration-500 hover:bg-indigo-700 ">Checkout</button>
                    </div>
                </div>
            <?php
            } else {
            ?>
                <div class="w-full max-w-7xl px-4 md:px-5 lg-6 mx-auto">
                    <p class="font-manrope font-semibold text-xl leading-9 text-center">Belum ada transaksi</p>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>