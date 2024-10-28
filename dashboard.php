<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php include 'includes/head.php' ?>

</head>

<body>
    <!-- /#left-panel starts -->
    <?php include 'includes/leftbar.php' ?>
    <!-- /#left-panel end -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">
        <!-- Header starts-->
        <?php include 'includes/header.php' ?>
        <!-- Header ends-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <!-- card starts  -->
            <?php
            include 'includes/billing_dash.php';
            ?>
            <!-- card ends  -->



        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->
    <!-- script starts  -->
    <?php include 'includes/script.php' ?>
    <!-- script ends  -->

    <script>
                var config = {
                    type: 'pie',
                    data: {
                        datasets: [{
                            data: <?php echo json_encode($json_data); ?>,
                            backgroundColor: <?php echo json_encode($json_color); ?>,
                            label: 'Dataset 1'
                        }],
                        labels: <?php echo json_encode($json_lebel); ?>,
                    },
                    options: {
                        responsive: true,
                        legend: {
                            position: 'left',
                        }
                    },
                };
                var ctx = document.getElementById('myChart').getContext('2d');
                window.myPie = new Chart(ctx, config);
            </script>

</body>

</html>