<?php
include "../../config/conn.php";

$movieId = $_GET['movieId'] ?? null;
$paymentPlanId = $_GET['paymentPlanId'] ?? null;

$queryPaymentPlan = mysqli_query($conn, "SELECT * FROM payment_plan WHERE id='$paymentPlanId'");
$queryMovie = mysqli_query($conn, "SELECT * FROM movie WHERE id='$movieId'");
$queryPaymentCard = mysqli_query($conn, "SELECT * FROM payment_card");
$queryPaymentPromo = mysqli_query($conn, "SELECT * FROM payment_promo");
?>

<div>
    <?php echo $movieId; ?>
    <?php echo $paymentPlanId; ?>
    
</div>