<?php
include "../../config/conn.php";
?>

<div class="w-full h-auto px-5">
    <div class="flex flex-col w-full h-auto gap-10">
        <div className="border-b">
            <div className="container flex flex-wrap items-center justify-between gap-6 py-8">
                <p className="text-3xl font-bold">Hello, <?php echo $_SESSION['user_username']; ?>!👋🏼</p>
                <div className="flex items-center gap-3">
                    <UpdateDataOverview payment={payment} transaction={transaction} />
                </div>
            </div>
        </div>
        <div class="w-full h-auto">
            <canvas id="myChart" style="width:100%; max-height:400px;"></canvas>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var data = {
            labels: ["January", "February", "March", "April", "May"],
            datasets: [{
                    label: 'Pemasukkan',
                    backgroundColor: 'rgba(16, 185, 129, 0.8)',
                    borderColor: 'rgba(16, 185, 129, 1)',
                    borderWidth: 1,
                    data: [5000, 6000, 4500, 7000, 5500]
                },
                {
                    label: 'Pengeluaran',
                    backgroundColor: 'rgba(239, 68, 68, 0.8)',
                    borderColor: 'rgba(239, 68, 68, 1)',
                    borderWidth: 1,
                    data: [3000, 3500, 4000, 3800, 4200]
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

        data.datasets[0].backgroundColor = incomeGradient;
        data.datasets[1].backgroundColor = expenseGradient;

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options
        });
    });
</script>