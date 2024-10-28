<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php include 'includes/head.php' ?>
</head>

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
                            <li><a href="#">Total Client</a></li>
                            <li class="active">All Clients</li>
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
                                <strong class="card-title">All Clients</strong>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                <tr>
                                    <th width="2%">No</th>
                                    <th>Company Name</th>
                                    <th>Client Name</th>
                                    <th>Designation</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $n=1;
                                $query=mysqli_query($con,"SELECT DISTINCT client_company, client_name, client_designation,client_address,client_contact FROM billing WHERE DATE_FORMAT(service_date,'%m-%Y')=DATE_FORMAT(NOW(),'%m-%Y')");
                                while ($row=mysqli_fetch_array($query))
                                {
                                    ?>
                                    <tr>
                                        <td><?php echo $n++?></td>
                                        <td><?php echo $row['client_company'] ?></td>
                                        <td><?php echo $row['client_name'] ?></td>
                                        <td><?php echo $row['client_designation'] ?></td>
                                        <td><?php echo $row['client_contact'] ?></td>
                                        <td><?php echo $row['client_address'] ?></td>


                                    </tr>
                                    <?php
                                }
                                //                                ?>
                                </tbody>
                                <!-- <tfoot>

                                <tr>
                                    <th colspan="5" style="text-align:right">Total:</th>
                                    <th></th>
                                    <th></th>

                                </tr>
                                </tfoot> -->
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