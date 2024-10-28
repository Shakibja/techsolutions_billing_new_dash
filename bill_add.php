

<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php include 'includes/head.php' ?>
</head>

<?php
date_default_timezone_set('Asia/Dhaka'); // Set timezone to Dhaka
$today = date('Y-m-d'); // Get today's date
?>

<?php
// Load Composer's autoloader
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Delete action
if (isset($_POST['submit'])) {
    $company_id = mysqli_real_escape_string($con, $_POST['company_id']);
    $seller_id = mysqli_real_escape_string($con, $_POST['seller_id']);
    $client_name = mysqli_real_escape_string($con, $_POST['clientname']);
    $client_designation = mysqli_real_escape_string($con, $_POST['clientdesg']);
    $client_company_name = mysqli_real_escape_string($con, $_POST['companyname']);
    $client_contact = mysqli_real_escape_string($con, $_POST['client_contact']);
    $client_company_address = mysqli_real_escape_string($con, $_POST['companyaddress']);
    $subject = mysqli_real_escape_string($con, $_POST['subject']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $service = $_POST['service'];
    $service_description = $_POST['service_description'];
    $unit_price = $_POST['unit_price'];
    $unit = $_POST['unit'];
    $price = $_POST['price'];
    $sub_total = $_POST['sub_total'];
    $pr_due = $_POST['pr_due'];
    $grandtotal = $_POST['grandtotal'];
    $paid = 0;
    $due = $_POST['due'];

    $filename = 'last_serial1.txt';
    if (!file_exists($filename)) {
        file_put_contents($filename, '0');
    }
    $lastIncrement = (int)file_get_contents($filename);
    $newIncrement = $lastIncrement + 1;
    $currentDate = date("Ymd"); // Format: YYYYMMDD
    $prefix = "TSPL"; // Your prefix
    $newSerial = $prefix . '_' . $currentDate . '_' . str_pad($newIncrement, 3, '0', STR_PAD_LEFT); // Pad with zeros
    file_put_contents($filename, $newIncrement);

    $money_receipt = $newSerial;
    $payment_date = $_POST['payment_date'];
    $service_date = $_POST['service_date'];
    $billing_id = time();


    $billing_query = "INSERT INTO billing (billing_id, company_id, seller_id,
                                                client_name, client_designation, client_company, client_contact,
                                                client_address, sub_total, previous_due, grand_total, paid, due, payment_date,billing_subject,service_date,money_reciept,last_payment,email)
                                                VALUES ('$billing_id','$company_id','$seller_id',
                                                '$client_name','$client_designation','$client_company_name', $client_contact,
                                                '$client_company_address', '$sub_total','$pr_due','$grandtotal','$paid','$due','$payment_date','$subject','$service_date','$money_receipt','$paid','$email')";
    if (mysqli_query($con, $billing_query)) {
        $serviceNames = [];
        foreach ($service as $key => $srv) {
            $services = $service[$key];
            $serviceNames[] = $services;
            $service_query = mysqli_query($con, "INSERT INTO service_details (billing_id, service_name, service_description, unit_price, unit, price) 
                                VALUES ('$billing_id','$service[$key]','$service_description[$key]','$unit_price[$key]','$unit[$key]','$price[$key]')");
        }


        $invoiceNumber = $money_receipt;
        $companyName = $client_company_name;
        $recipientName = $client_name;
        $description = implode(', ', $serviceNames);
        $invoiceDate = $service_date;
        $totalAmount = $due;
        $dueDate = $payment_date;
        $yourName = 'Manager';
        $yourPosition = 'Billing & Accounts';
        $yourPhone = '+8801310-032419';
        $yourEmail = 'info@techsolutionsplex.com';
        $yourWebsite = 'techsolutionsplex.com';

        $SMS_BODY = "
            Dear $recipientName,
            <br><br>
            Greethings from $companyName<br><br>

            I hope this message finds you well.<br><br>

            Attached is the invoice $invoiceNumber for $description, dated $invoiceDate. The total amount due is $totalAmount and is payable by $dueDate.<br><br>

            Click Here for Bill Copy: http://localhost/billing_techsolutionsbd_local/details.php?id=$billing_id <br><br>

            Please let me know if you have any questions or require further details.<br><br>
            
            Thank you for your prompt attention to this matter.<br><br>

            Best regards,<br><br>

            $yourName<br><br>
            $yourPosition<br><br>
            Mobile Number : $yourPhone<br><br>
            Email : $yourEmail<br><br>
            Website : $yourWebsite
            ";

        // Create a new PHPMailer instance
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = 2; // Enable verbose debug output
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com'; // SMTP server
            $mail->SMTPAuth   = true;
            $mail->Username   = 'karimjannat2021@gmail.com'; // SMTP username
            $mail->Password   = 'kffp neia fwia fmsc'; // SMTP password
            $mail->SMTPSecure = 'tls'; // Enable TLS encryption; ssl also accepted
            $mail->Port       = 587; // TCP port to connect to

            //Recipients
            $mail->setFrom('karimjannat2021@gmail.com', "Invoice TSPL-$billing_id from $companyName");
            $mail->addAddress($email, $client_name); // Add a recipient

            // Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = "Invoice TSPL-$billing_id from $companyName";
            $mail->Body    = $SMS_BODY;
            $mail->AltBody = '';

            $mail->send();
            // echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

        echo "<script>
                        alert('New billing added');
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
                            <li class="active">Add New</li>
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
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="concerncom">Select Company</label>
                                                    <select class="form-control" id="company_id" name="company_id" required>
                                                        <option value="">Select Company</option>
                                                        <?php
                                                        $c_query = mysqli_query($con, "SELECT * FROM company ORDER BY id");
                                                        while ($row = mysqli_fetch_array($c_query)) {
                                                        ?>
                                                            <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="regardperson">Regard Person</label>
                                                <select class="form-control" id="regardperson" name="seller_id" required>
                                                    <?php
                                                    $c_query = mysqli_query($con, "SELECT * FROM seller ORDER BY id");
                                                    while ($row = mysqli_fetch_array($c_query)) {
                                                    ?>
                                                        <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <!-- <div class="col-md-4">
            <label for="regardperson">Money receipt number</label>
            <input type="text" name="money_receipt" class="form-control">

        </div> -->

                                        </div>
                                    </div>

                                    <div id="hiddenDiv" style="display: none;">
                                        <div class="row mb-1">
                                            <div class="col-md-6" id="Service-info">
                                                <label>Service subject</label>
                                                <input type="text" name="subject" id="subject" value="" class="form-control" required>
                                            </div>

                                            <div class="col-md-6">
                                                <label>Email</label>
                                                <input type="text" name="email" id="email" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="toCompany" style="margin-bottom: 50px;">
                                            <label>To Company Info:</label>
                                            <div class="row">

                                                <div class="col-md-3 mt-3">
                                                    <input type="text" name="companyname" id="companyname" class="form-control" placeholder="Client Name" readonly>
                                                </div>
                                                <div class="col-md-3 mt-3">
                                                    <input type="text" name="clientname" id="clientname" class="form-control" placeholder="Contact Person" readonly>
                                                </div>
                                                <div class="col-md-3 mt-3">
                                                    <input type="text" name="clientdesg" id="clientdesg" class="form-control" placeholder=" Designation" readonly>
                                                </div>

                                                <div class="col-md-3 mt-3">
                                                    <input type="text" name="client_contact" id="client_contact" class="form-control" placeholder=" Phone" readonly>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-12">
                                                    <textarea name="companyaddress" id="companyaddress" rows="3" class="form-control" placeholder="Company Address" readonly></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div id="additional-info">

 </div> -->
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

                                            <tbody id="additional-info">

                                            </tbody>
                                            <tfoot>
                                                <tr>

                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-right">Sub Total: </td>
                                                    <td colspan="2"><input type="text" id="sub_total" name="sub_total" value="0" class="form-control gTotal" readonly></td>
                                                </tr>

                                                <tr>

                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-right">Previous Due: </td>
                                                    <td colspan="2"><input type="text" id="pr_due" name="pr_due" value="0" class="form-control gTotal" readonly></td>
                                                </tr>
                                                <tr>

                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-right">Total: </td>
                                                    <td colspan="2"><input type="text" id="grandtotal" name="grandtotal" value="0" class="form-control gTotal" readonly></td>
                                                </tr>
                                                <!-- <tr>
                <td></td>
                <td></td>
                <td></td>
                <td class="text-right">Paid: </td>
                <td colspan="2">
                    <input type="text" name="paid" id="paid" onblur='price_calculate()' class="form-control gTotal" value="0" required>
                </td>
            </tr> -->
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-right">Due: </td>
                                                    <td colspan="2">
                                                        <input type="text" name="due" id="due" class="form-control due" value="0" readonly>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-right">Billing Date: </td>
                                                    <td colspan="2">
                                                        <input type="date" name="service_date" class="form-control gTotal" value="<?php echo $today; ?>" required>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <!-- <span id="addMore" class="btn btn-success btn-sm">Add More</span><button type="submit" id="deleterow" onblur="price_calculate()" class=" ml-1 btn btn-danger btn-sm"><i class="fa fa-trash"></i> </button> -->
                                                    </td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-right">Payment Date: </td>
                                                    <td colspan="2">
                                                        <input type="date" name="payment_date" class="form-control gTotal">
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


    <script>
        $(document).ready(function() {
            $('#company_id').change(function() {
                if ($(this).val()) {
                    $('#hiddenDiv').show();
                } else {
                    $('#hiddenDiv').hide();
                }

                var userId = $(this).val();
                console.log(userId);

                if (userId) {
                    $.ajax({
                        url: 'fetch_user.php',
                        type: 'POST',
                        data: {
                            id: userId
                        },
                        dataType: 'json',
                        success: function(data) {
                            if (data.status === 'success') {
                                $('#companyname').val(data.data.name);
                                $('#clientname').val(data.data.contact_person);
                                $('#clientdesg').val(data.data.designation);
                                $('#client_contact').val(data.data.phone);
                                $('#companyaddress').val(data.data.address);
                                $('#email').val(data.data.email);
                                fetchAdditionalData(data.data.serial_no);
                                fetchPreviousDueData(data.data.id);
                            } else {
                                alert('User not found.');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                            alert('Error retrieving data.');
                        }
                    });
                } else {
                    $('#companyname, #clientname, #clientdesg, #client_contact, #companyaddress, #email').val('');
                }
            });

            function fetchAdditionalData(serialNo) {
                $.ajax({
                    url: 'fetch_additional_data.php',
                    type: 'POST',
                    data: {
                        serial_no: serialNo
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.status === 'success') {
                            $('#additional-info').empty();
                            let allServices = [];
                            let totalPrice = 0;

                            data.data.forEach(function(item) {
                                allServices.push(item.name);
                                totalPrice += Number(item.price);
                            });

                            let serviceNames = `Bill Copy of - ${allServices.join(', ')}`;
                            $('#subject').val(serviceNames);
                            $('#sub_total').val(totalPrice);

                            data.data.forEach(function(item) {
                                $('#additional-info').append(
                                    `<tr class="items" id="row">
                                <td><input style="width: 150px;"  type="text" name="service[]" class="form-control" value="${item.name}" readonly></td>
                                <td><input style="width: 200px;" type="text" name="service_description[]" value="${item.service_description}" class="form-control" required></td>
                                <td><input style="width: 100px;" type="text" name="unit_price[]" value="${item.unit_price}" class="form-control" required></td>
                                <td><input style="width: 50px;" type="text" name="unit[]" value="${item.unit}" class="form-control" required></td>
                                <td><input style="width: 100px;" type="text" name="price[]" value="${item.price}" class="form-control" required></td>
                            </tr>`
                                );
                            });
                        } else {
                            alert('No additional data found.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('Error retrieving additional data.');
                    }
                });
            }

            function fetchPreviousDueData(company_id) {
                $.ajax({
                    url: 'fetch_pr_due_data.php',
                    type: 'POST',
                    data: {
                        company_id: company_id
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.status === 'success') {
                            $('#pr_due').val(data.data.due);
                            calculateGrandTotal();
                        } else {
                            alert('No Previous Due found.');
                            $('#pr_due').val('0');
                            calculateGrandTotal();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('Error retrieving additional data.');
                    }
                });
            }

            function price_calculate() {
                var totcost = 0;
                $('tr.items').each(function(i, el) {
                    var $this = $(this),
                        $unit_price = $this.find('[name="unit_price\\[\\]"]'),
                        $unit = $this.find('[name="unit\\[\\]"]'),
                        c = parseFloat($unit_price.val()),
                        q = parseInt($unit.val(), 10),
                        total = c * q || 0;

                    $this.find('[name="price\\[\\]"]').val(total);
                    totcost += total;
                });

                $("#sub_total").val(totcost);
                calculateGrandTotal(); // Call to update grand total and due
            }

            function calculateGrandTotal() {
                let subTotal = parseFloat($('#sub_total').val()) || 0;
                let prDue = parseFloat($('#pr_due').val()) || 0;
                let grandTotal = subTotal + prDue;
                $('#grandtotal').val(grandTotal); // Update grand total

                // let rcv = parseFloat($("#paid").val()) || 0;
                // let due = grandTotal - rcv;
                $("#due").val(grandTotal); // Update due
            }

            // Attach price_calculate to inputs where necessary
            $(document).on('blur', '[name="unit_price[]"], [name="unit[]"]', price_calculate);
        });
    </script>
</body>

</html>