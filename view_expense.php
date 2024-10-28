<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php include 'includes/head.php' ?>
</head>

<?php
        //Delete action
        if (isset($_GET['del']))
        {
            $id=$_GET['del'];
            $delete_query= "DELETE FROM expense WHERE id='$id'";
            if (mysqli_query($con,$delete_query))
            {
                echo "<script>
                          alert('Expense deleted successfully');
                          window.location='view_expense.php';
                      </script>";
            }
            else
            {
                die($con);
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
                            <li class="active">View Expense</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">All Expense</strong>
                                <a href="add_expense.php" class="btn btn-primary float-right btn-sm">Add new</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th width="2%">No</th>
                                                <th>Sector</th>
                                                <th>Authorize Person</th>
                                                <th>Date</th>
                                                <th>Details</th>
                                                <th>Amount</th>
                                                <th width="15%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $n = 1;
                                            $query = mysqli_query($con, "SELECT * FROM expense ORDER BY id DESC");
                                            while ($row = mysqli_fetch_array($query)) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $n++ ?></td>
                                                    <td><?php echo $row['sector'] ?></td>

                                                    <!--</td>-->
                                                    <td><?php echo $row['authorize'] ?></td>
                                                    <td><?php echo $row['date']; ?></td>
                                                    <td><?php echo $row['details']; ?></td>
                                                    <td><?php echo $row['amount']; ?></td>

                                                    <td>
                                                        <a data-toggle="tooltip" data-placement="top" title="Edit" href="expense_edit.php?id=<?php echo $row['id'] ?>" class="btn-sm btn btn-warning">Edit</a>
                                                        <a data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are You Sure To Delete?');" href="?del=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div><!-- .animated -->
        </div><!-- .content -->


    </div><!-- /#right-panel -->

    <!-- Right Panel -->


    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>


    <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="vendors/jszip/dist/jszip.min.js"></script>
    <script src="vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="vendors/pdfmake/build/vfs_fonts.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <script src="assets/js/init-scripts/data-table/datatables-init.js"></script>


</body>

</html>