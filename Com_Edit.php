<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php include 'includes/head.php' ?>
</head>
<?php
$id = $_GET['id'];

$date = new DateTime();
$currentMonth = $date->format('m');
$currentYear = $date->format('Y');


$query = "SELECT * FROM company WHERE id='$id'";
$queryRun = mysqli_query($con, $query);
$companyResult = mysqli_fetch_assoc($queryRun);

$serial_no = $companyResult['serial_no'];
$currentLogo = $companyResult['logo'];

if (isset($_POST['submit'])) {

    if (!empty($_FILES['logo']['name'])) {
        // Delete the existing logo file if it exists
        $currentLogoPath = "image/company/$currentLogo";
        if (file_exists($currentLogoPath)) {
            unlink($currentLogoPath);
        }


        $logo = $_FILES['logo']['name'];
        $logo = time() . $logo;
        $logo_tmp = $_FILES['logo']['tmp_name'];
        move_uploaded_file($logo_tmp, "image/company/$logo");
    } else {
        $logo = $currentLogo;
    }





    $uQuery = "UPDATE company 
                                    SET
                                        name = '$_POST[name]',
                                        address = '$_POST[address]',
                                        phone = '$_POST[phone]',
                                        email = '$_POST[email]',
                                        website = '$_POST[website]',
                                        logo = '$logo',
                                        contact_person = '$_POST[contact_person]',
                                        designation = '$_POST[designation]',
                                        source = '$_POST[source]'
                                    WHERE id = '$id'";
    $updateQ = mysqli_query($con, $uQuery);
    if ($updateQ) {
        $dServQ = "DELETE FROM com_service_details WHERE serial_no = '$serial_no' ";
        mysqli_query($con, $dServQ);


        $service = $_POST['service'];
        $service_description = $_POST['service_description'];
        $last_renew_date = $_POST['last_renew_date'];
        $expire_date = $_POST['expire_date'];
        $unit_price = $_POST['unit_price'];
        $unit = $_POST['unit'];
        $price = $_POST['price'];
        $cost = $_POST['cost'];
        $profit = $_POST['profit'];
        $note = $_POST['note'];
        foreach ($service as $key => $srv) {
            $com_service_details = mysqli_query($con, "INSERT INTO com_service_details (serial_no, service_name, service_description, last_renew_date, expire_date, note,unit_price,unit,price,month,year,cost,profit) 
                                            VALUES ('$serial_no','$service[$key]','$service_description[$key]','$last_renew_date[$key]','$expire_date[$key]','$note[$key]','$unit_price[$key]','$unit[$key]','$price[$key]','$currentMonth','$currentYear','$cost[$key]','$profit[$key]')");
        }
        echo "<script>
                                    alert('New Company and service Update');
                                    window.location='company_view.php';
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
                            <li class="active">Edit</li>
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
                                <strong class="card-title">Edit Company</strong>
                            </div>
                            <div class="card-body">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-4 my-2">
                                            <input type="text" name="serial_no" class="form-control" placeholder="Serial No" value="<?php echo $companyResult['serial_no']; ?>" readonly>
                                        </div>
                                        <div class="col-md-4 my-2">
                                            <input type="text" name="name" class="form-control" placeholder="Company Name" value="<?php echo $companyResult['name']; ?>" required>
                                        </div>
                                        <div class="col-md-4 my-2">
                                            <input type="text" name="contact_person" class="form-control" placeholder="Contact Person" value="<?php echo $companyResult['contact_person']; ?>" required>
                                        </div>

                                        <div class="col-md-4 my-2">
                                            <input type="text" name="designation" class="form-control" placeholder="Designation" value="<?php echo $companyResult['designation']; ?>" required>
                                        </div>

                                        <div class="col-md-4  my-2">
                                            <input type="text" name="phone" class="form-control" placeholder="Phone Number" value="<?php echo $companyResult['phone']; ?>">
                                        </div>
                                        <div class="col-md-4 my-2">
                                            <input type="text" name="email" class="form-control" placeholder="Email Address" value="<?php echo $companyResult['email']; ?>">
                                        </div>
                                        <div class="col-md-4 my-2">
                                            <textarea name="address" class="form-control" placeholder="Address" rows="1"><?php echo $companyResult['address']; ?></textarea>
                                        </div>
                                        <div class="col-md-4 my-2">
                                            <input type="text" name="website" class="form-control" placeholder="Web Address" value="<?php echo $companyResult['website']; ?>">
                                        </div>
                                        <div class="col-md-4 my-2">
                                            <input type="text" name="source" class="form-control" placeholder="Source" value="<?php echo $companyResult['source']; ?>">
                                        </div>
                                        <div class="col-md-4 my-2">
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="logo" name="logo" aria-describedby="logo">
                                                    <label class="custom-file-label" for="logo">Company Logo</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <table class="table" id="companyTAble">
                                        <h3 style="color: #333; font-size: 20px; margin-bottom: 15px;">Services Table:</h3>
                                        <thead>
                                            <th>Services Name</th>
                                            <th>Services Description</th>
                                            <th>Last Renew Date</th>
                                            <th>Expire Date</th>
                                            <th>Unit Price</th>
                                            <th>Unit</th>
                                            <th>Total Price (BDT)</th>
                                            <th>Cost</th>
                                            <th>Pofit</th>
                                            <th>Note</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sqlQ = mysqli_query($con, "SELECT a.id, a.serial_no, a.service_name, a.service_description,a.last_renew_date,a.expire_date, a.note,a.unit_price, a.unit,a.price,a.cost,a.profit,b.name, b.renew FROM com_service_details a,service_name b,company c  WHERE a.service_name = b.id and a.serial_no = c.serial_no and c.id = '$id';");
                                            while ($servs = mysqli_fetch_assoc($sqlQ)) {
                                            ?>
                                                <tr class="items" id="row">
                                                    <td>
                                                        <!-- <input type="text" id="service" name="service[]" class="form-control" value="<?php echo $servs['name']; ?>" readonly> -->

                                                        <select name="service[]" id="" class="form-control service-select" required>
                                                            <option value="<?php echo $servs['service_name'] ?>"><?php echo $servs['name'] ?></option>
                                                            <?php
                                                            $q = mysqli_query($con, "SELECT * FROM service_name WHERE id!='$servs[service_name]' ORDER BY id ASC ");
                                                            while ($row = mysqli_fetch_array($q)) { ?>
                                                                <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                                                            <?php }
                                                            ?>
                                                        </select>
                                                    </td>
                                                    <td><input type="text" id="service_description" name="service_description[]" class="form-control" value="<?php echo $servs['service_description']; ?>" required></td>
                                                    <?php
                                                    if (!empty($servs['last_renew_date'])) {
                                                    ?>
                                                        <td><input type="date" id="last_renew_date" name="last_renew_date[]" class="form-control last-renew-date" value="<?php echo $servs['last_renew_date']; ?>"></td>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <td></td>
                                                    <?php
                                                    }
                                                    ?>

                                                    <?php
                                                    if (!empty($servs['expire_date'])) {
                                                    ?>
                                                        <td><input type="date" id="expire_date" name="expire_date[]" class="form-control expire-date" value="<?php echo $servs['expire_date']; ?>"></td>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <td></td>
                                                    <?php
                                                    }
                                                    ?>


                                                    <td><input type="text" id="unit_price" name="unit_price[]" value="<?php echo $servs['unit_price']; ?>" class="form-control" required></td>
                                                    <td><input type="text" id="unit" name="unit[]" value="<?php echo $servs['unit']; ?>" class="form-control" oninput="calc();" required></td>
                                                    <td><input type="text" id="price" name="price[]" value="<?php echo $servs['price']; ?>" class="form-control" oninput="calc();" required> </td>
                                                    <td><input type="text" name="cost[]" class="form-control" oninput="calc();" value="<?php echo $servs['cost']; ?>" required></td>
                                                    <td><input type="text" name="profit[]" class="form-control" oninput="calc();" value="<?php echo $servs['profit']; ?>" required></td>
                                                    <td><input type="text" id="note" name="note[]" class="form-control" value="<?php echo $servs['note']; ?>" required></td>
                                                </tr>

                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td><span id="addMore" class="btn btn-success btn-sm">Add More</span><button type="submit" id="deleterow" onblur="price_calculate()" class=" ml-1 btn btn-danger btn-sm"><i class="fa fa-trash"></i> </button></td>
                                                <td></td>
                                                <td class="text-right"></td>
                                                <td colspan="7">
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>


                                    <div class="row">
                                        <div class="col-md-4 offset-md-4 mt-2">
                                            <button name="submit" type="submit" class="btn btn-success btn-block">Update</button>
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
    </div><!-- /#right-panel -->
    <!-- Right Panel -->
    <!-- script starts  -->
    <?php include 'includes/script.php' ?>
    <!-- script ends  -->

    <script>
        $(document).ready(function() {
            $(document).on('change', '.service-select', function() {
                var userId = $(this).val();
                console.log(userId);
                var $row = $(this).closest('tr');

                if (userId) {
                    $.ajax({
                        url: 'fetch_company.php',
                        type: 'POST',
                        data: {
                            id: userId
                        },
                        dataType: 'json',
                        success: function(data) {
                            // console.log(data);
                            if (data.status === 'success') {
                                if (data.data.renew === 'N') {
                                    $row.find('.last-renew-date').hide().val('');
                                    $row.find('.expire-date').hide().val('');
                                } else {
                                    $row.find('.last-renew-date').show();
                                    $row.find('.expire-date').show();
                                }
                            } else {
                                alert(data.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                            alert('Error retrieving data.');
                        }
                    });
                } else {
                    $row.find('.last-renew-date').hide();
                    $row.find('.expire-date').hide();
                    alert('Please select a valid service.');
                }
            });

        });
    </script>
    <!-- using online scripts -->
    <script>
        function calc() {
            var totcost = 0;
            $('tr.items').each(function(i, el) {
                var $this = $(this),
                    $unit_price = $this.find('[name="unit_price\\[\\]"]'),
                    $unit = $this.find('[name="unit\\[\\]"]'),
                    $cost = $this.find('[name="cost\\[\\]"]'),

                    a = parseFloat($cost.val()),
                    c = parseFloat($unit_price.val()),
                    q = parseInt($unit.val(), 10),
                    total = c * q || 0;
                profit = total - a || 0;
                $this.find('[name="price\\[\\]"]').val(total);
                $this.find('[name="profit\\[\\]"]').val(profit);
                totcost = totcost + total;
            });

        }
    </script>



</body>

</html>