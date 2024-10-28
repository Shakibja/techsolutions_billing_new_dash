<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php include 'includes/head.php' ?>
</head>

<?php
//Delete action
if (isset($_GET['del'])) {
    $id = $_GET['del'];
    $delete_query = "DELETE billing, service_details FROM billing LEFT JOIN service_details ON billing.billing_id=service_details.billing_id WHERE billing.billing_id='$id'";
    if (mysqli_query($con, $delete_query)) {
        echo "<script>
                          alert('Bill deleted successfully');
                          window.location='bill_view.php';
                      </script>";
    } else {
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
                            <li><a href="#">Billing</a></li>
                            <li class="active">View All</li>
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
                                <strong class="card-title">All Bills</strong>
                                <a href="bill_add.php" class="btn btn-primary float-right btn-sm">Add new</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="2%">No</th>
                                            <th width="10%">Subject</th>
                                            <!--<th>From</th>-->
                                            <th>Company</th>
                                            <th>Contact Person</th>
                                            <th>Sells</th>
                                            <th>Money receipt number</th>
                                            <th>Total Price</th>
                                            <th>Paid</th>
                                            <th>Due</th>
                                            <th>Service Date</th>
                                            <th width="20%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $n = 1;
                                        $query = mysqli_query($con, "SELECT * FROM billing ORDER BY service_date DESC");
                                        while ($row = mysqli_fetch_array($query)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $n++ ?></td>
                                                <td><?php echo $row['billing_subject'] ?></td>

                                                <!--<td>-->
                                                <?php
                                                //$q=mysqli_query($con,"SELECT name FROM company WHERE id='$row[company_id]'");
                                                //$res=mysqli_fetch_assoc($q);
                                                //echo $res['name'];
                                                ?>
                                                <!--</td>-->
                                                <td><?php echo $row['client_company'] ?></td>
                                                <td><?php echo $row['client_name']; ?></td>
                                                <td>
                                                    <?php
                                                    $q = mysqli_query($con, "SELECT name FROM seller WHERE id='$row[seller_id]'");
                                                    $res = mysqli_fetch_assoc($q);
                                                    echo $res['name'];
                                                    ?>
                                                </td>
                                                <td><?php echo $row['money_reciept']; ?></td>
                                                <td><?php echo $row['grand_total']; ?></td>
                                                <td><?php echo $row['paid']; ?></td>
                                                <td><?php echo $row['due']; ?></td>
                                                <td><?php echo $row['service_date']; ?></td>
                                                <td>
                                                    <a target="_blank" data-toggle="tooltip" data-placement="top" title="View" href="details.php?id=<?php echo $row['billing_id'] ?>" class="btn-sm btn btn-primary mt-2">View</a>
                                                    <a data-toggle="tooltip" data-placement="top" title="Edit" href="billedit.php?id=<?php echo $row['billing_id'] ?>" class="btn-sm btn btn-warning mt-2">Edit</a>
                                                    <a data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are You Sure To Delete?');" href="bill_view.php?del=<?php echo $row['billing_id']; ?>" class="btn btn-danger btn-sm mt-2">Delete</a>
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