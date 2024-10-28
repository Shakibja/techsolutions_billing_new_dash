<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php include 'includes/head.php' ?>
</head>

<?php
$id = $_GET['id'];
$query = "SELECT * FROM billing WHERE billing_id='$id'";
$queryRun = mysqli_query($con, $query);
$billingResult = mysqli_fetch_assoc($queryRun);



if (isset($_POST['submit'])) {

    $new_payment = $_POST['paid'];
    $p_paid = $billingResult['paid'];
    if ($new_payment > $p_paid) {
        $last_payment = $new_payment - $p_paid;
    } else if ($new_payment < $p_paid) {
        $last_payment = $new_payment - $p_paid;
        $last_payment = $billingResult['last_payment'] + $last_payment;
    } else {
        $last_payment = $new_payment;
    }
    $uQuery = "UPDATE billing 
                                    SET
                                        company_id = '$_POST[company_id]',
                                        seller_id = '$_POST[seller_id]',
                                        billing_subject = '$_POST[subject]',
                                        client_name = '$_POST[clientname]',
                                        client_designation = '$_POST[clientdesg]',
                                        client_company = '$_POST[companyname]',
                                        client_address = '$_POST[companyaddress]',
                                        grand_total = '$_POST[grandtotal]',
                                        paid = '$_POST[paid]',
                                        due = '$_POST[due]',
                                        payment_date = '$_POST[payment_date]',
                                        last_payment='$last_payment',
                                        client_contact='$_POST[client_contact]',
                                        money_reciept='$_POST[money_receipt]'
                                    WHERE billing_id = '$id'";
    $updateQ = mysqli_query($con, $uQuery);
    if ($updateQ) {
        $dServQ = "DELETE FROM service_details WHERE billing_id = '$id' ";
        mysqli_query($con, $dServQ);


        $service = $_POST['service'];
        $service_description = $_POST['service_description'];
        $unit_price = $_POST['unit_price'];
        $unit = $_POST['unit'];
        $price = $_POST['price'];
        foreach ($service as $key => $srv) {
            $service_query = mysqli_query($con, "INSERT INTO service_details (billing_id, service_name, service_description, unit_price, unit, price) 
                                VALUES ('$id','$service[$key]','$service_description[$key]','$unit_price[$key]','$unit[$key]','$price[$key]')");
        }
        echo "<script>
                                alert('Billing Updated Successfully');
                                window.location='bill_view.php';
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
                            <li><a href="#">Billing</a></li>
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
                                <strong class="card-title">Add New Bill</strong>
                            </div>
                            <div class="card-body">
                                <form action="" method="post">

                                    <div class="fromCompany" style="margin: 50px 0;">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="concerncom">Select Company</label>
                                                    <select class="form-control" id="concerncom" name="company_id" required>
                                                        <?php
                                                        $c_query = mysqli_query($con, "SELECT * FROM company ORDER BY id");
                                                        while ($row = mysqli_fetch_array($c_query)) {
                                                        ?>
                                                            <option value="<?php echo $row['id'] ?>" <?php if ($billingResult['company_id'] == $row['id']) {
                                                                                                        echo "selected";
                                                                                                    } ?>><?php echo $row['name'] ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="regardperson">Regard Person</label>
                                                <select class="form-control" id="regardperson" name="seller_id" required>
                                                    <?php
                                                    $c_query = mysqli_query($con, "SELECT * FROM seller ORDER BY id");
                                                    while ($row = mysqli_fetch_array($c_query)) {
                                                    ?>
                                                        <option value="<?php echo $row['id'] ?>" <?php if ($billingResult['seller_id'] == $row['id']) {
                                                                                                    echo "selected";
                                                                                                } ?>><?php echo $row['name'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Money receipt number</label>
                                                <input type="text" name="money_receipt" class="form-control" value="<?php echo $billingResult['money_reciept']; ?>" readonly>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-md-12">
                                            <label>Billing subject</label>
                                            <input type="text" name="subject" class="form-control" value="<?php echo $billingResult['billing_subject']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="toCompany" style="margin-bottom: 50px;">
                                        <label>To Company Info:</label>
                                        <div class="row">
                                            <div class="col-md-3 mt-3">
                                                <input type="text" name="companyname" class="form-control" value="<?php echo $billingResult['client_company']; ?>" required>
                                            </div>
                                            <div class="col-md-3 mt-3">
                                                <input type="text" name="clientname" class="form-control" value="<?php echo $billingResult['client_name']; ?>" required>
                                            </div>
                                            <div class="col-md-3 mt-3">
                                                <input type="text" name="clientdesg" class="form-control" value="<?php echo $billingResult['client_designation']; ?>" required>
                                            </div>

                                            <div class="col-md-3 mt-3">
                                                <input type="text" name="client_contact" class="form-control" value="<?php echo $billingResult['client_contact']; ?>" required>
                                            </div>

                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-12">
                                                <textarea name="companyaddress" rows="3" class="form-control" required><?php echo $billingResult['client_address']; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                    <table class="table" id="serviceTAble">
                                        <h3 style="color: #333; font-size: 20px; margin-bottom: 15px;">Services Table:</h3>
                                        <thead>
                                            <th>Services Name</th>
                                            <th>Services Description</th>
                                            <th>Unit Price</th>
                                            <th>Unit</th>
                                            <th>Price (BDT)</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sqlQ = mysqli_query($con, "SELECT * FROM service_details where billing_id = '$billingResult[billing_id]'");
                                            while ($servs = mysqli_fetch_assoc($sqlQ)) { ?>
                                                <tr class="items">
                                                    <td>
                                                        <select name="service[]" id="" class="form-control" style="width: 150px;" required>
                                                            <option value="<?php echo $servs['service_name'] ?>"><?php echo $servs['service_name'] ?></option>
                                                            <?php
                                                            $q = mysqli_query($con, "SELECT * FROM service_name WHERE name!='$servs[service_name]' ORDER BY id ASC ");
                                                            while ($row = mysqli_fetch_array($q)) { ?>
                                                                <option value="<?php echo $row['name'] ?>"><?php echo $row['name'] ?></option>
                                                            <?php }
                                                            ?>
                                                        </select>
                                                    </td>
                                                    <td><input style="width: 200px;" type="text" id="service_description" name="service_description[]" value="<?php echo $servs['service_description']; ?>" onblur='price_calculate()' class="form-control" required></td>
                                                    <td><input style="width: 100px;" type="text" id="unit_price" name="unit_price[]" value="<?php echo $servs['unit_price']; ?>" onblur='price_calculate()' class="form-control" required></td>
                                                    <td><input style="width: 50px;" type="text" id="unit" name="unit[]" value="<?php echo $servs['unit']; ?>" onblur='price_calculate()' class="form-control" required></td>
                                                    <td><input style="width: 100px;" type="text" id="price" name="price[]" value="<?php echo $servs['price']; ?>" class="form-control" required></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td class="text-right">Sub Total: </td>
                                                <td colspan="2"><input type="text" id="sub_total" name="sub_total" value="<?php echo $billingResult['sub_total']; ?>" class="form-control gTotal" readonly></td>
                                            </tr>

                                            <tr>

                                                <td></td>
                                                <td></td>
                                                <td class="text-right">Previous Due: </td>
                                                <td colspan="2"><input type="text" id="pr_due" name="pr_due" value="<?php echo $billingResult['previous_due']; ?>" class="form-control gTotal" readonly></td>
                                            </tr>

                                            <tr>

                                                <td></td>
                                                <td></td>
                                                <td class="text-right">Total: </td>
                                                <td colspan="2"><input type="text" id="grandtotal" name="grandtotal" class="form-control gTotal" value="<?php echo $billingResult['grand_total']; ?>" required></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td class="text-right">Paid: </td>
                                                <td colspan="2">
                                                    <input type="text" name="paid" id="paid" onblur='price_calculate()' class="form-control gTotal" value="<?php echo $billingResult['paid']; ?>" required>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td class="text-right">Due: </td>
                                                <td colspan="2">
                                                    <input type="text" name="due" id="due" class="form-control due" value="<?php echo $billingResult['due']; ?>" required>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <!-- <span id="addMore" class="btn btn-success btn-sm">Add More</span><button type="submit" id="deleterow" onblur="price_calculate()" class=" ml-1 btn btn-danger btn-sm"><i class="fa fa-trash"></i> </button> -->
                                                </td>
                                                <td></td>
                                                <td class="text-right">Payment Date: </td>
                                                <td colspan="2">
                                                    <input type="date" name="payment_date" class="form-control gTotal" value="<?php echo $billingResult['payment_date']; ?>">
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
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