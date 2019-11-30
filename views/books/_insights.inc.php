<?php

$stats = View::getData('stats');

?>
<div class="row">

    <div class="col-12 col-md-6 col-lg-4">
        <div class="alert alert-secondary">
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <td>Total Books</td>
                    <td class="text-right"><?= $stats['total_books'] ?></td>
                </tr>
                <tr>
                    <td>Total Book Copies</td>
                    <td class="text-right"><?= $stats['total_book_copies'] ?></td>
                </tr>
                <tr>
                    <td>Number of Categories</td>
                    <td class="text-right"><?= $stats['total_categories'] ?></td>
                </tr>
                </tbody>
            </table>

            <table class="table table-bordered">
                <tbody>
                <tr>
                    <td>Total Departments</td>
                    <td class="text-right"><?= $stats['total_departments'] ?></td>
                </tr>
                <tr>
                    <td>Members count</td>
                    <td class="text-right"><?= $stats['total_members'] ?></td>
                </tr>

                </tbody>
            </table>
        </div>

    </div>

    <div class="col-12 col-md-6 col-lg-8">

        <div class="alert alert-secondary">
            <p class="font-weight-bold">Last 6 months transactions</p>
            <div class="chart-container">
                <canvas id="monthly-transactions" style="width: 100%; height: 228px"></canvas>
            </div>
        </div>
    </div>


</div>
<!--.row-->

<script defer>
    let ctx = document.getElementById("monthly-transactions");

    let chartData = <?= json_encode($stats['monthly_transactions_data']) ?>;
    let chartLabels = <?= json_encode($stats['monthly_transactions_months']) ?>;

    let myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: chartLabels,
            datasets: [{
                label: 'Number of transactions',
                data: chartData,
                borderWidth: 1,
                backgroundColor: [
                    'rgba(54, 162, 235, 0.2)'
                ]
            }]
        },
        options: {
            responsive: false
        }
    });


</script>