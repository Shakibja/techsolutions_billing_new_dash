<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php include 'includes/head.php' ?>
</head>

<?php
        if (isset($_GET['del']))
        {
            $id=$_GET['del'];
            $query=mysqli_query($con, "SELECT * FROM inventory WHERE id='$id'");
            while ($row=mysqli_fetch_array($query))
            {
                $image=$row['image'];
                $image="image/inventory/$image";
                if (!empty($image))
                {
                    unlink($image);
                }
                $query="DELETE FROM inventory WHERE id='$id'";
                if (mysqli_query($con,$query))
                {
                    echo "<script>
                            alert('Company deleted successfully');
                            window.location='inventory_view.php';
                          </script>";
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
                        <h1>Inventory</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Dashboard</a></li>
                            <li><a href="#">Inventory</a></li>
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
                                <strong class="card-title">All Inventory</strong>
                                <a href="inventory_add.php" class="btn btn-primary float-right btn-sm">Add Inventory</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th width="2%">No</th>
                                    <th >Item Name</th>
                                    <th>Unit Price</th>
                                    <th>Total Stock</th>
                                    <th>Available Stock</th>
                                    <th>Commission ( % )</th>
                                    <th>Image</th>
                                    <th>Total</th>
                                    <th width="5%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $n=1;
                                $query=mysqli_query($con,"SELECT * FROM inventory ORDER BY item_name ASC ");
                                while ($row=mysqli_fetch_array($query))
                                {
                                    ?>
                                    <tr>
                                        <td><?php echo $n++?></td>
                                        <td><?php echo $row['item_name'] ?></td>
                                        <td><?php echo $row['unit_price'] ?></td>
                                        <td><?php echo $row['stock'] ?></td>
                                        <td><?php echo $row['quantity'] ?></td>
                                        <td><?php echo $row['commission'] ?></td>
                                        <td><img style="width: 100px; height:80px;" src="image/inventory/<?php echo $row['image'] ?>"></td>
                                        <td><?php echo $row['total'] ?></td>
                                        <td>
                                            <a href="inventory_edit.php?edit=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                                            <a onclick="return confirm('Are You Sure To Delete?');" href="?del=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm mt-2">Delete</a>
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