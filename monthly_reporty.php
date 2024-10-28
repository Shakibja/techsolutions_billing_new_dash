<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php include 'includes/head.php' ?>
</head>

<?php

if (isset($_POST['submit'])) {

    $MONTH = $_POST['MONTH'];
    $YEAR = $_POST['YEAR'];


    $sql = "SELECT 1 AS Tp, a.name, a.address, a.source, s.name AS service_name, a.website, b.last_renew_date, b.expire_date, b.note, b.price, b.cost, b.profit 
FROM company a 
JOIN com_service_details b ON a.serial_no = b.serial_no 
JOIN service_name s ON b.service_name = s.id
WHERE 
    b.month = '$MONTH' 
    AND b.year = '$YEAR'
GROUP BY a.name, a.address, a.source, s.name, a.website, b.last_renew_date, b.expire_date, b.note 

UNION ALL 

SELECT 2 AS Tp, NULL AS name, NULL AS address, NULL AS source, NULL AS service_name, NULL AS website, NULL AS last_renew_date, NULL AS expire_date, NULL AS note, 
       SUM(b.price) AS total_price, SUM(b.cost) AS total_cost, SUM(b.profit) AS total_profit 
FROM com_service_details b WHERE 
    b.month = '$MONTH' 
    AND b.year = '$YEAR'";


    $parseresult = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($parseresult)) {
        $output[] = $row;
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
                        <h1>Report</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Dashboard</a></li>
                            <li><a href="#">Report</a></li>
                            <li class="active">Monthly Report</li>
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
                                <strong class="card-title">Monthly Report</strong>
                            </div>
                            <div class="card-body">
                                <form action="" method="post">
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-4 mt-2">
                                            <label for="">Month:</label>
                                            <select name="MONTH" id="MONTH" class="form-control">
                                                <option value="">-Select Batch</option>
                                                <option value="1">January</option>
                                                <option value="2">February</option>
                                                <option value="3">March</option>
                                                <option value="4">April</option>
                                                <option value="5">May</option>
                                                <option value="6">June</option>
                                                <option value="7">July</option>
                                                <option value="8">August</option>
                                                <option value="9">September</option>
                                                <option value="10">October</option>
                                                <option value="11">November</option>
                                                <option value="12">December</option>
                                            </select>
                                        </div>


                                        <div class="col-12 col-sm-12 col-md-4 mt-2">
                                            <label for="">Year:</label>
                                            <select name="YEAR" id="YEAR" class="form-control">
                                                <option value="">-Select Batch</option>
                                                <option value="2023">2023</option>
                                                <option value="2024">2024</option>

                                            </select>
                                        </div>


                                        <div class="col-12 col-sm-12 col-md-4" style="text-align:center;">
                                            <div style="margin-top: 30px;">
                                                <input type="submit" name="submit" value="Load" class="btn btn-success">
                                            </div>

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


        <?php
        if (isset($_POST['submit'])) {
        ?>
            <div class="content mt-3">
                <div class="animated fadeIn">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="card">

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th width="2%">No</th>
                                                    <th>Name</th>
                                                    <th>Address</th>
                                                    <th>Source</th>
                                                    <th>Service Name</th>
                                                    <th>Domain</th>
                                                    <th>Last Renew Date</th>
                                                    <th>Expire Date</th>
                                                    <th>Note</th>
                                                    <th>Total Price</th>
                                                    <th>Cost</th>
                                                    <th>Profit</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php
                                                $n = 1;
                                                $shownContacts = []; // Array to track shown contact persons
                                                $contactCount = []; // Array to count occurrences of each contact person

                                                // First, count occurrences of each contact person
                                                foreach ($output as $entry) {
                                                    $contactPerson = $entry['name'];
                                                    if (!isset($contactCount[$contactPerson])) {
                                                        $contactCount[$contactPerson] = 0;
                                                    }
                                                    $contactCount[$contactPerson]++;
                                                }

                                                // Now generate the rows
                                                foreach ($output as $i => $entry) {
                                                    if ($entry['Tp'] == '1') {
                                                        $contactPerson = $entry['name'];
                                                        $isFirstInstance = !in_array($contactPerson, $shownContacts);

                                                        // If the contact person is not shown yet
                                                        if ($isFirstInstance) {
                                                            // Mark this contact person as shown
                                                            $shownContacts[] = $contactPerson;
                                                            $rowspan = $contactCount[$contactPerson]; // Get the count for rowspan
                                                ?>
                                                            <tr>
                                                                <td rowspan="<?php echo $rowspan; ?>"><?php echo $n++; ?></td>
                                                                <td rowspan="<?php echo $rowspan; ?>"><?php echo htmlspecialchars($contactPerson); ?></td>
                                                                <td><?php echo htmlspecialchars($entry['address']); ?></td>
                                                                <td><?php echo htmlspecialchars($entry['source']); ?></td>
                                                                <td><?php echo htmlspecialchars($entry['service_name']); ?></td>
                                                                <td rowspan="<?php echo $rowspan; ?>"><?php echo htmlspecialchars($entry['website']); ?></td>
                                                                <td><?php echo htmlspecialchars($entry['last_renew_date']); ?></td>
                                                                <td><?php echo htmlspecialchars($entry['expire_date']); ?></td>
                                                                <td><?php echo htmlspecialchars($entry['note']); ?></td>
                                                                <td><?php echo htmlspecialchars($entry['price']); ?></td>
                                                                <td><?php echo htmlspecialchars($entry['cost']); ?></td>
                                                                <td><?php echo htmlspecialchars($entry['profit']); ?></td>
                                                            </tr>
                                                        <?php
                                                        } else {
                                                            // If this is a duplicate contact person, leave it blank for contact_person and adjust rowspan
                                                        ?>
                                                            <tr>

                                                                <td><?php echo htmlspecialchars($entry['address']); ?></td>
                                                                <td><?php echo htmlspecialchars($entry['source']); ?></td>
                                                                <td><?php echo htmlspecialchars($entry['service_name']); ?></td>
                                                                <td><?php echo htmlspecialchars($entry['last_renew_date']); ?></td>
                                                                <td><?php echo htmlspecialchars($entry['expire_date']); ?></td>
                                                                <td><?php echo htmlspecialchars($entry['note']); ?></td>
                                                                <td><?php echo htmlspecialchars($entry['price']); ?></td>
                                                                <td><?php echo htmlspecialchars($entry['cost']); ?></td>
                                                                <td><?php echo htmlspecialchars($entry['profit']); ?></td>
                                                            </tr>
                                                        <?php
                                                        }
                                                    } else {
                                                        if ($entry['Tp'] == '2') {

                                                        ?>
                                                            <tr>
                                                                <td></td>
                                                                <td><?php $entry['name'] ?></td>
                                                                <td><?php echo htmlspecialchars($entry['address']); ?></td>
                                                                <td><?php echo htmlspecialchars($entry['source']); ?></td>
                                                                <td><?php echo htmlspecialchars($entry['service_name']); ?></td>
                                                                <td><?php echo htmlspecialchars($entry['website']); ?></td>
                                                                <td><?php echo htmlspecialchars($entry['last_renew_date']); ?></td>
                                                                <td><?php echo htmlspecialchars($entry['expire_date']); ?></td>
                                                                <td>Total : </td>
                                                                <td><?php echo htmlspecialchars($entry['price']); ?></td>
                                                                <td><?php echo htmlspecialchars($entry['cost']); ?></td>
                                                                <td><?php echo htmlspecialchars($entry['profit']); ?></td>
                                                            </tr>
                                                <?php
                                                        }
                                                    }
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
        <?php
        }
        ?>

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