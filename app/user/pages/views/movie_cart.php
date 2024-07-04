<?php
include '../../config/conn.php';

$queryPayment = mysqli_query($conn, "SELECT * FROM payment WHERE status = 'pending' AND userId = '{$_SESSION['user_id']}' AND expiredPayment > NOW()");
$queryTotalPrice = mysqli_query($conn, "SELECT SUM(totalPrice) FROM payment WHERE status = 'pending' AND userId = '{$_SESSION['user_id']}' AND expiredPayment > NOW()");
$rowTotalPrice = mysqli_fetch_assoc($queryTotalPrice);

$queryCard = mysqli_query($conn, "SELECT * FROM payment_card");
$rowCard = mysqli_fetch_assoc($queryCard);

$queryPromo = mysqli_query($conn, "SELECT * FROM payment_promo");
$rowPromo = mysqli_fetch_assoc($queryPromo);
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
                                    <img src="<?= $rowMovie['poster_path'] ?>" alt="poster" class="max-lg:w-full lg:w-[200px] rounded-lg">
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
                        <?php } ?>
                    </div>
                    <div class='flex flex-col items-center justify-center'>
                        <?php
                        $index = 0;
                        mysqli_data_seek($queryCard, 0);
                        while ($rowCard = mysqli_fetch_assoc($queryCard)) {
                            $isChecked = $index;
                        ?>
                            <div class='flex flex-col w-[70vw] lg:w-[40vw] pb-2 items-center'>
                                <div class='flex flex-row w-full h-20 justify-between rounded-tr-lg rounded-tl-lg <?= $isChecked ? 'bg-gray-200 dark:bg-gray-800' : 'bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer' ?>' onClick='handleClick(<?= $index ?>)'>
                                    <img src="<?= $rowCard['imageCard'] ?>" alt="pay" class='w-[100px] pl-3 object-contain' />
                                    <?php if ($isChecked) { ?>
                                        <input type="radio" class="card-select mr-3" name="cardSelection" value="<?= $rowCard['nameCard'] ?>" <?= $isChecked ? '' : 'checked' ?> required />
                                    <?php } else { ?>
                                        <input type="radio" class="card-select mr-3" name="cardSelection" value="<?= $rowCard['nameCard'] ?>" <?= $isChecked ? 'checked' : '' ?> required />
                                    <?php } ?>
                                </div>
                                <div class='flex flex-row justify-between items-center w-full py-2 bg-gray-200 dark:bg-gray-700 text-sm rounded-br-lg rounded-bl-lg border-t-2 border-gray-400 dark:border-gray-600'>
                                    <span class='text-black dark:text-white pl-4 font-medium'>Bayar dengan <?= $rowCard['nameCard'] ?></span>
                                    <a href="carakerja?method=<?= $rowCard['nameCard'] ?>" class='text-blue-500 dark:text-blue-400 font-bold mr-3 border-2 border-blue-500 dark:border-blue-400 p-1 rounded-lg cursor-pointer animate-bounce mt-2'><span>Cara Kerja?</span></a>
                                </div>
                            </div>
                        <?php
                            $index++;
                        }
                        ?>
                        <input type="text" name="promoCode" placeholder="Masukkan kode promo" required class="px-4 py-2 border border-gray-600 mt-3 rounded-md bg-gray-800 w-[70vw] lg:w-[40vw]">
                    </div>

                    <div class="max-lg:max-w-lg max-lg:mx-auto">
                        <p class="font-normal text-base leading-7 text-gray-500 text-center mb-5 mt-6">Shipping taxes, and discounts calculated at checkout</p>
                        <button class="rounded-full py-4 px-6 bg-indigo-600 text-white font-semibold text-lg w-full text-center transition-all duration-500 hover:bg-indigo-700 ">Checkout</button>
                    </div>
                </div>
            <?php } else { ?>
                <div class="w-full max-w-7xl px-4 md:px-5 lg-6 mx-auto">
                    <p class="font-manrope font-semibold text-xl leading-9 text-center">Belum ada transaksi</p>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<script>
    function handleClick(index) {
        var radios = document.getElementsByName('cardSelection');

        for (var i = 0; i < radios.length; i++) {
            radios[i].checked = (i === index);
        }
    }
</script>