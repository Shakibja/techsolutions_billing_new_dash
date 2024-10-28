<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php include 'includes/head.php' ?>
</head>

<?php

if (isset($_GET['del'])) {
    $id = $_GET['del'];

    $del_query = mysqli_query($con, "SELECT * FROM company WHERE id='$id'");
    while ($row = mysqli_fetch_array($del_query)) {
        $serial_no = $row['serial_no'];
        $logo = $row['logo'];

        if (!empty($logo)) {
            // Delete the existing logo file if it exists
            $currentLogoPath = "image/company/$logo";
            if (file_exists($currentLogoPath)) {
                unlink($currentLogoPath);
            }
        }

        $query = "DELETE FROM company WHERE id='$id'";
        $deleteQ = mysqli_query($con, $query);
        if ($deleteQ) {
            $dServQ = "DELETE FROM com_service_details WHERE serial_no = '$serial_no' ";
            if (mysqli_query($con, $dServQ)) {
                echo "<script>
                            alert('Company deleted successfully');
                            window.location='company_view.php';
                          </script>";
            }
        }
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
                        <h1>Sell</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Dashboard</a></li>
                            <li><a href="#">Sell</a></li>
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
                                <strong class="card-title">All Company</strong>
                                <a href="company.php" class="btn btn-primary float-right btn-sm">Add new</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th width="2%">No</th>
                                                <th>Serial No.</th>
                                                <th>Name</th>
                                                <th>Logo</th>
                                                <th>Contact Person</th>
                                                <th>Address</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>Status</th>
                                                <th>Website</th>
                                                <th width="5%">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            $n = 1;
                                            $query = mysqli_query($con, "SELECT * FROM company ORDER BY id DESC");
                                            while ($row = mysqli_fetch_array($query)) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $n++ ?></td>
                                                    <td><?php echo $row['serial_no'] ?></td>
                                                    <td><?php echo $row['name'] ?></td>
                                                    <td><img style="width: 100px;" src="image/company/<?php echo $row['logo'] ?>"></td>
                                                    <td><?php echo $row['contact_person'] ?></td>
                                                    <td><?php echo $row['address'] ?></td>
                                                    <td><?php echo $row['phone'] ?></td>
                                                    <td><?php echo $row['email'] ?></td>
                                                    <td>
                                                        <a href="toggle_status.php?id=<?php echo $row['id']; ?>&status=<?php echo $row['status'] == 1 ? '0' : '1'; ?>" class="btn btn-<?php echo $row['status'] == 1 ? 'success' : 'warning'; ?> btn-sm">
                                                            <?php echo $row['status'] == 1 ? 'Deactivate' : 'Activate'; ?>
                                                        </a>
                                                    </td>
                                                    <td><?php echo $row['website'] ?></td>
                                                    <td>
                                                        <a data-toggle="tooltip" data-placement="top" title="Edit" href="Com_Edit.php?id=<?php echo $row['id'] ?>" class="btn-sm btn btn-warning mb-2">Edit</a>

                                                        <a onclick="return confirm('Are You Sure To Delete?');" href="company_view.php?del=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
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