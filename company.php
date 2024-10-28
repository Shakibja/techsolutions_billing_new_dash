<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php include 'includes/head.php' ?>
</head>

<?php
$date = new DateTime();
$currentMonth = $date->format('m');

$currentYear = $date->format('Y');


if (isset($_POST['submit'])) {
    $filename = 'last_serial.txt';
    if (!file_exists($filename)) {
        file_put_contents($filename, '0');
    }
    $lastIncrement = (int)file_get_contents($filename);
    $newIncrement = $lastIncrement + 1;
    $currentDate = date("Ymd"); // Format: YYYYMMDD
    $prefix = "TSPL"; // Your prefix
    $newSerial = $prefix . '_' . $currentDate . '_' . str_pad($newIncrement, 3, '0', STR_PAD_LEFT); // Pad with zeros
    file_put_contents($filename, $newIncrement);


    $serial_no       = $newSerial;
    $name       = mysqli_real_escape_string($con, $_POST['name']);
    $contact_person       = mysqli_real_escape_string($con, $_POST['contact_person']);
    $address    = mysqli_real_escape_string($con, $_POST['address']);
    $phone      = mysqli_real_escape_string($con, $_POST['phone']);
    $email      = mysqli_real_escape_string($con, $_POST['email']);
    $website    = mysqli_real_escape_string($con, $_POST['website']);
    $designation    = mysqli_real_escape_string($con, $_POST['designation']);
    $source    = mysqli_real_escape_string($con, $_POST['source']);
    $service = $_POST['service'];
    $last_renew_date = $_POST['last_renew_date'];
    $service_description = $_POST['service_description'];
    $expire_date = $_POST['expire_date'];
    $note = $_POST['note'];
    $unit_price = $_POST['unit_price'];
    $unit = $_POST['unit'];
    $price = $_POST['price'];
    $cost = $_POST['cost'];
    $profit = $_POST['profit'];
    $logo = $_FILES['logo']['name'];
    $logo = time() . $logo;
    $logo_tmp = $_FILES['logo']['tmp_name'];
    move_uploaded_file($logo_tmp, "image/company/$logo");
    $query = "INSERT INTO company (serial_no,name,address,phone,email,website,logo,contact_person,designation,source) 
                        VALUES ('$serial_no','$name','$address','$phone','$email','$website','$logo','$contact_person','$designation','$source' )";
    if (mysqli_query($con, $query)) {
        foreach ($service as $key => $srv) {
            $com_service_details = mysqli_query($con, "INSERT INTO com_service_details (serial_no, service_name, service_description,last_renew_date, expire_date, note,unit_price,unit,price,month,year,cost,profit) 
                                VALUES ('$serial_no','$service[$key]','$service_description[$key]','$last_renew_date[$key]','$expire_date[$key]','$note[$key]','$unit_price[$key]','$unit[$key]','$price[$key]','$currentMonth','$currentYear','$cost[$key]','$profit[$key]')");
        }
        echo "<script>
                        alert('New Company and service added');
                        window.location='company.php';
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
                                <strong class="card-title">Add New Company</strong>
                            </div>
                            <div class="card-body">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <!-- <div class="col-md-4 my-2">
                                        <input type="text" name="serial_no" class="form-control" placeholder="Serial No">
                                    </div> -->
                                        <div class="col-md-4 my-2">
                                            <input type="text" name="name" class="form-control" placeholder="Company Name" required>
                                        </div>
                                        <div class="col-md-4 my-2">
                                            <input type="text" name="contact_person" class="form-control" placeholder="Contact Person" required>
                                        </div>
                                        <div class="col-md-4 my-2">
                                            <input type="text" name="designation" class="form-control" placeholder="Designation" required>
                                        </div>
                                        <div class="col-md-4  my-2">
                                            <input type="text" name="phone" class="form-control" placeholder="Phone Number" required>
                                        </div>
                                        <div class="col-md-4 my-2">
                                            <input type="text" name="email" class="form-control" placeholder="Email Address" required>
                                        </div>
                                        <div class="col-md-4 my-2">
                                            <textarea name="address" class="form-control" placeholder="Address" rows="1" required></textarea>
                                        </div>
                                        <div class="col-md-4 my-2">
                                            <input type="text" name="website" class="form-control" placeholder="Web Address">
                                        </div>
                                        <div class="col-md-4 my-2">
                                            <input type="text" name="source" class="form-control" placeholder="Source">
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

                                    <table class="table" id="companyTable">
                                        <h3 style="color: #333; font-size: 20px; margin-bottom: 15px;">Services Table:</h3>
                                        <thead>
                                            <tr>
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
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="items" id="row">
                                                <td>
                                                    <select name="service[]" class="form-control service-select" required>
                                                        <option value="">Select Service Name</option>
                                                        <?php
                                                        $q = mysqli_query($con, "SELECT * FROM service_name ORDER BY id ASC");
                                                        while ($row = mysqli_fetch_array($q)) { ?>
                                                            <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                                <td><textarea name="service_description[]" class="form-control" rows="1"></textarea></td>
                                                <td><input type="date" name="last_renew_date[]" class="form-control last-renew-date"></td>
                                                <td><input type="date" name="expire_date[]" class="form-control expire-date"></td>
                                                <td><input type="text" name="unit_price[]" class="form-control" required></td>
                                                <td><input type="text" name="unit[]" class="form-control" oninput="calc();" required></td>
                                                <td><input type="text" name="price[]" class="form-control" oninput="calc();" required></td>
                                                <td><input type="text" name="cost[]" class="form-control" oninput="calc();" required></td>
                                                <td><input type="text" name="profit[]" class="form-control" oninput="calc();" required></td>
                                                <td><textarea name="note[]" class="form-control" rows="1"></textarea></td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td>
                                                    <div style="display: flex;">
                                                    <span id="addMore" class="btn btn-success btn-sm">Add More</span>
                                                    <button type="submit" id="deleterow" class="ml-1 btn btn-danger btn-sm"><i class="fa fa-trash"></i> </button>
                                                    </div>
                                                    
                                                
                                                </td>
                                                <td></td>
                                                <td class="text-right"></td>
                                                <td colspan="7"></td>
                                            </tr>
                                        </tfoot>
                                    </table>

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
    </div><!-- /#right-panel -->
    <!-- Right Panel -->
    <!-- script starts  -->
    <?php include 'includes/script.php' ?>
    <!-- script ends  -->
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
            });

        }
    </script>

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
                            console.log(data);
                            if (data.status === 'success') {
                                if (data.data.renew === 'N') {
                                    $row.find('.last-renew-date').hide();
                                    $row.find('.expire-date').hide();
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

            $('#addMore').click(function() {
                // Clone the row and append to the tbody
                var newRow = $('#row').clone();
                newRow.find('input').val(''); // Clear the input values
                newRow.find('.last-renew-date, .expire-date').show(); // Show date fields
                newRow.removeAttr('id'); // Remove id to avoid duplication issues
                $('#companyTable tbody').append(newRow);
            });

            $('#deleterow').on('click', function(e) {
                if ($("#companyTable tr.items:not(:first-child)").length > 0) {
                    $("tr.items:last()").remove();
                } else {
                    alert('No more rows to delete.');
                }
                return false;
            });
        });
    </script>

</body>

</html>