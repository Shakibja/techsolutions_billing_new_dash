<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php include 'includes/head.php' ?>
</head>
<?php
$id = $_GET['id'];
$query = "SELECT * FROM expense WHERE id='$id'";
$queryRun = mysqli_query($con, $query);
$expenseResult = mysqli_fetch_assoc($queryRun);

            if (isset($_POST['submit'])) {
                $sector = $_POST['sector'];
                $authorize = $_POST['authorize'];
                $date = $_POST['date'];
                $amount = $_POST['amount'];
                $details = $_POST['details'];

                $sql = mysqli_query($con, "UPDATE expense SET sector='$sector',
                                                                    authorize='$authorize',
                                                                    date='$date',
                                                                    amount='$amount',
                                                                    details='$details'
                                                  WHERE id='$id'");

                if ($sql) {
                    echo "<script>
                        alert('Expense edited successfully.');
                        window.location='view_expense.php';
                      </script>";
                }
            }

            ?>

<body>
    <!-- /#left-panel starts -->
    <?php include 'includes/leftbar.php' ?>
    <!-- /#left-panel end -->

    <!-- Left Panel -->

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
                            <li><a href="#">Dashboard</a></li>
                            <li><a href="#">Expense</a></li>
                            <li class="active">Edit Expense</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Edit Expense</strong>
                            </div>
                            <div class="card-body">
                            <form action="" method="post">
                                <div class="fromCompany" style="margin: 50px 0;">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="concerncom">Select Sector <b style="color: red">*</b> </label>
                                                <select class="form-control" id="concerncom" name="sector" required>
                                                    <?php
                                                    $c_query = mysqli_query($con, "SELECT * FROM sector ORDER BY id");
                                                    while ($row = mysqli_fetch_array($c_query)) {
                                                    ?>
                                                        <option value="<?php echo $row['name'] ?>" <?php if ($row['name'] == $expenseResult['sector']) {
                                                                                                        echo "selected";
                                                                                                    } ?>><?php echo $row['name'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="regardperson">Authorize Person <b style="color: red">*</b></label>
                                            <select class="form-control" id="regardperson" name="authorize" required>
                                                <?php
                                                $c_query = mysqli_query($con, "SELECT * FROM authorize ORDER BY id");
                                                while ($row = mysqli_fetch_array($c_query)) {
                                                ?>
                                                    <option value="<?php echo $row['name'] ?>" <?php if ($row['name'] == $expenseResult['authorize']) {
                                                                                                    echo "selected";
                                                                                                } ?>><?php echo $row['name'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="regardperson">Date <b style="color: red">*</b></label>
                                            <input type="date" name="date" class="form-control" value="<?php echo $expenseResult['date'] ?>" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="regardperson">Amount <b style="color: red">*</b></label>
                                            <input type="number" name="amount" class="form-control" value="<?php echo $expenseResult['amount'] ?>" required>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="regardperson">Details</label>
                                            <input type="text" name="details" class="form-control" value="<?php echo $expenseResult['details'] ?>">

                                        </div>

                                    </div>
                                </div>
                                <button style="text-transform:uppercase;" name="submit" class="btn btn-info float-right mb-3" type="submit">Submit</button>
                            </form>

                            </div>
                        </div> <!-- .card -->

                    </div>
                    <!--/.col-->
                </div>
            </div><!-- .animated -->
        </div><!-- .content -->
    </div><!-- /#right-panel -->
    <!-- Right Panel -->
    <!-- script starts  -->
    <?php include 'includes/script.php' ?>
    <!-- script ends  -->


</body>

</html>