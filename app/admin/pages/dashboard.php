<?php
if (isset($_POST['logout'])) {
    session_destroy();
    $_SERVER['PHP_SELF'];
    exit;
}
?>

<div class="w-full h-auto px-5">
    <div class="flex flex-col w-full h-auto">
        <div class="border-b-[3px]">
            <div class="container flex flex-wrap items-center justify-between gap-6 py-8">
                <span class="text-3xl font-bold">Hello, <?php echo $_SESSION['user_username']; ?>!👋🏼</span>
                <form method="post">
                    <button type="submit" name="logout" class="bg-red-700 text-sm py-3 px-5 rounded-md text-white hover:bg-red-900 duration-200">Logout</button>
                </form>
            </div>
        </div>
        <div class="w-full h-auto">
            <div class="w-full flex flex-row items-center justify-between py-10">
                <h1 class="text-3xl font-bold">Grafik Pemasukan tahun ini</h1>
            </div>
            <canvas id="myChart" style="width:100%; max-height:400px;"></canvas>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var monthlyData = {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                    label: 'Pemasukkan',
                    backgroundColor: 'rgba(16, 185, 129, 0.8)',
                    borderColor: 'rgba(16, 185, 129, 1)',
                    borderWidth: 1,
                    data: [5000, 6000, 4500, 7000, 5500, 0, 0, 0, 0, 0, 0, 0]
                },
                {
                    label: 'Pengeluaran',
                    backgroundColor: 'rgba(239, 68, 68, 0.8)',
                    borderColor: 'rgba(239, 68, 68, 1)',
                    borderWidth: 1,
                    data: [3000, 3500, 4000, 3800, 4200, 0, 0, 0, 0, 0, 0, 0]
                }
            ]
        };

        var options = {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                xAxes: [{
                    gridLines: {
                        display: true,
                        color: 'rgba(0, 0, 0, 0.1)',
                        drawTicks: false,
                    },
                    ticks: {
                        autoSkip: false,
                        maxRotation: 45,
                        minRotation: 45
                    }
                }],
                yAxes: [{
                    gridLines: {
                        display: true,
                        color: 'rgba(0, 0, 0, 0.1)',
                        drawTicks: false,
                    },
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            tooltips: {
                mode: 'index',
                intersect: false
            }
        };

        var ctx = document.getElementById('myChart').getContext('2d');

        var incomeGradient = ctx.createLinearGradient(0, 0, 0, 300);
        incomeGradient.addColorStop(0, 'rgba(16, 185, 129, 1)');
        incomeGradient.addColorStop(1, 'rgba(16, 185, 129, 0)');

        var expenseGradient = ctx.createLinearGradient(0, 0, 0, 300);
        expenseGradient.addColorStop(0, 'rgba(239, 68, 68, 1)');
        expenseGradient.addColorStop(1, 'rgba(239, 68, 68, 0)');

        monthlyData.datasets[0].backgroundColor = incomeGradient;
        monthlyData.datasets[1].backgroundColor = expenseGradient;


        var myChart = new Chart(ctx, {
            type: 'bar',
            data: monthlyData,
            options: options
        });
    });
</script>