<?php

$stats = View::get_data('stats');

?>
<div class="card mb-4">
    <div class="card-header">
        <?php HtmlHelper::render_card_header("Insights"); ?>
    </div>

    <div class="card-body pb-4 pt-3">

        <div class="row">

            <div class="col-4">
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

            <div class="col-4">

                <div class="alert alert-secondary">
                    <p class="font-weight-bold">Current Month</p>
                    <div class="chart-container" style="position: relative;">
                        <canvas id="books-canvas"></canvas>
                    </div>
                </div>
            </div>


        </div><!--.row-->

    </div>
</div><!--.card-->

<script defer>
    var ctx = document.getElementById('books-canvas');

    let pie_data = {
        datasets: [{
            data: [<?= $stats['total_books'] ?>, <?= $stats['total_book_copies'] ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.5)',
                'rgba(54, 162, 235, 0.5)',
            ]
        }],
        labels: [
            'Total Books',
            'Borrowed Books',
        ]
    };

    var myChart = new Chart(ctx, {
        type: 'pie',
        data: pie_data,

    });
</script>