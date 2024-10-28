<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php include 'includes/head.php' ?>
</head>

<?php
//Company add action
if (isset($_POST['submit'])) {
    $name      = mysqli_real_escape_string($con, $_POST['name']);
    $renew      = mysqli_real_escape_string($con, $_POST['renew']);
    $query = "INSERT INTO service_name (name,renew) 
                        VALUES ('$name','$renew')";
    if (mysqli_query($con, $query)) {
        echo "<script>
                            alert('Service added successfully.');
                            window.location='service.php';
                          </script>";
    }
}

//Delete action
if (isset($_GET['del'])) {
    $id = $_GET['del'];
    $query = "DELETE FROM service_name WHERE id='$id'";
    if (mysqli_query($con, $query)) {
        echo "<script>
                        alert('Service deleted successfully');
                        window.location='service.php';
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
                        <h1>Settings</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Dashboard</a></li>
                            <li><a href="#">Settings</a></li>
                            <li class="active">Services</li>
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
                                <strong class="card-title">Add Service Name</strong>
                            </div>
                            <div class="card-body">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="concerncom"> Service Name</label>
                                            <input type="text" name="name" class="form-control" placeholder="Name" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="concerncom">Renew Status</label>
                                            <select class="form-control" id="renew" name="renew" required>
                                                <option value="">Select Renew Status</option>
                                                <option value="Y">Yes</option>
                                                <option value="N">No</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center mt-3">
                                            <button name="submit" type="submit" class="btn btn-success">Submit</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div> <!-- .card -->

                    </div>
                    <!--/.col-->
                </div>
            </div><!-- .animated -->
        </div><!-- .content -->

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">All Services</strong>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th width="2%">No</th>
                                                <th>Name</th>
                                                <th>Renew Status</th>
                                                <th width="5%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $n = 1;
                                            $query = mysqli_query($con, "SELECT * FROM service_name ORDER BY id DESC");
                                            while ($row = mysqli_fetch_array($query)) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $n++ ?></td>
                                                    <td><?php echo $row['name'] ?></td>
                                                    <td><?php
                                                        if ($row['renew'] == "Y") {
                                                            echo "Yes";
                                                        } else {
                                                            echo "No";
                                                        }
                                                        ?>
                                                    </td>

                                                    <td>
                                                        <a onclick="return confirm('Are You Sure To Delete?');" href="?del=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                                    </td>

                                                </tr>
                                            <?php
                                            }
                                            //                                
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
    <!-- script starts  -->
    <?php include 'includes/script.php' ?>
    <!-- script ends  -->
    <!-- using online scripts -->

</body>

</html>