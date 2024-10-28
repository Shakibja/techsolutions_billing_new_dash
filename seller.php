<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php include 'includes/head.php' ?>
</head>
<?php
//Company add action
if (isset($_POST['submit'])) {
    $name      = mysqli_real_escape_string($con, $_POST['name']);
    $designation    = mysqli_real_escape_string($con, $_POST['designation']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $sign = $_FILES['signature']['name'];
    $sign = time() . $sign;
    $logo_tmp = $_FILES['signature']['tmp_name'];
    move_uploaded_file($logo_tmp, "image/seller/$sign");
    $query = "INSERT INTO seller (name,phone,email,designation,signature) 
                        VALUES ('$name','$phone','$email','$designation','$sign')";
    if (mysqli_query($con, $query)) {
        echo "<script>
                            alert('Seller added successfully.');
                            window.location='seller.php';
                          </script>";
    }
}

//Delete action
if (isset($_GET['del'])) {
    $id = $_GET['del'];
    $del_query = mysqli_query($con, "SELECT * FROM seller WHERE id='$id'");
    while ($row = mysqli_fetch_array($del_query)) {
        $logo = $row['signature'];
        $image = "image/seller/$logo";
        if (!unlink($image)) {

            echo "<script>alert('Error deleting file')</script>";
        } else {
            $query = "DELETE FROM seller WHERE id='$id'";
            if (mysqli_query($con, $query)) {
                echo "<script>
                                alert('Seller deleted successfully');
                                window.location='seller.php';
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
                            <li class="active">Seller Profile</li>
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
                                <strong class="card-title">Add New Seller</strong>
                            </div>
                            <div class="card-body">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-4 my-2">
                                            <input type="text" name="name" class="form-control" placeholder="Name" required>
                                        </div>
                                        <div class="col-md-4  my-2">
                                            <input type="text" name="designation" class="form-control" placeholder="Designation" required>
                                        </div>
                                        <div class="col-md-4 my-2">
                                            <input type="text" name="phone" class="form-control" placeholder="Phone Number" required>
                                        </div>
                                        <div class="col-md-6 my-2">
                                            <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                                        </div>
                                        <div class="col-md-6 my-2">
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="regardsignature" name="signature" aria-describedby="regardsignature" required>
                                                    <label class="custom-file-label" for="logo">Signature Image</label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 offset-md-4 mt-2">
                                            <button name="submit" type="submit" class="btn btn-success btn-block">Submit</button>
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
                                <strong class="card-title">All Seller | Profile</strong>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th width="2%">No</th>
                                                <th>Name</th>
                                                <th>Designation</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>Signature</th>
                                                <th width="5%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $n = 1;
                                            $query = mysqli_query($con, "SELECT * FROM seller ORDER BY id DESC");
                                            while ($row = mysqli_fetch_array($query)) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $n++ ?></td>
                                                    <td><?php echo $row['name'] ?></td>
                                                    <td><?php echo $row['designation'] ?></td>
                                                    <td><?php echo $row['phone'] ?></td>
                                                    <td><?php echo $row['email'] ?></td>
                                                    <td><img style="width: 100px;" src="image/seller/<?php echo $row['signature'] ?>"></td>
                                                    <td>
                                                        <a onclick="return confirm('Are You Sure To Delete?');" href="seller.php?del=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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