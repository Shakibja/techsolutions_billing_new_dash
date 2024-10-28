<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<div class="col-sm-6 col-lg-4">
    <div class="card text-white bg-flat-color-1">
        <div class="card-body pb-0">
            <div class="dropdown float-right">
                <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton1" data-toggle="dropdown">
                    <i class="fa fa-cog"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <div class="dropdown-menu-content">
                        <a class="dropdown-item" href="total_client.php">View Details</a>
                    </div>
                </div>
            </div>
            <?php
            $query = mysqli_query($con, "SELECT COUNT(DISTINCT client_company) as client FROM billing");
            $result = mysqli_fetch_assoc($query);
            $total_result = $result['client'];
            ?>
            <h4 class="mb-0">
                <span class="count"><?php echo $total_result; ?></span>
            </h4>
            <p class="text-light">Total Client</p>

            <div class="chart-wrapper px-0" style="height:70px;" height="70">
                <i class="fas fa-users"></i>
            </div>

        </div>

    </div>
</div>
<!--/.col-->

<div class="col-sm-6 col-lg-4">
    <div class="card text-white bg-flat-color-2">
        <div class="card-body pb-0">
            <div class="dropdown float-right">
                <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton2" data-toggle="dropdown">
                    <i class="fa fa-cog"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                    <div class="dropdown-menu-content">
                        <a class="dropdown-item" href="monthly_client.php">View Details</a>
                    </div>
                </div>
            </div>
            <?php
            // echo "SELECT COUNT(DISTINCT client_company) as client FROM billing WHERE DATE_FORMAT(service_date,'%m-%Y')=DATE_FORMAT(NOW(),'%m-%Y')";
            $q = mysqli_query($con, "SELECT COUNT(DISTINCT client_company) as client FROM billing WHERE DATE_FORMAT(service_date,'%m-%Y')=DATE_FORMAT(NOW(),'%m-%Y')");
            $result = mysqli_fetch_assoc($q);
            $total_result = $result['client'];
            ?>
            <h4 class="mb-0">
                <span class="count">
                    <?php if ($total_result > 0) {
                        echo $total_result;
                    } else {
                        echo '0';
                    } ?>
                </span>
            </h4>
            <p class="text-light">Current month client</p>

            <div class="chart-wrapper px-0" style="height:70px;" height="70">
                <i class="fas fa-fw fa-list"></i>
            </div>

        </div>
    </div>
</div>
<!--/.col-->

<div class="col-sm-6 col-lg-4">
    <div class="card text-white bg-flat-color-3">
        <div class="card-body pb-0">
            <div class="dropdown float-right">
                <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton3" data-toggle="dropdown">
                    <i class="fa fa-cog"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                    <div class="dropdown-menu-content">
                        <a class="dropdown-item" href="total_service.php">View Details</a>
                    </div>
                </div>
            </div>
            <?php
            $q = mysqli_query($con, "SELECT SUM(grand_total) as grand_total FROM billing");
            $res = mysqli_fetch_assoc($q);
            $grand_total = $res['grand_total'];
            ?>
            <h4 class="mb-0">
                <span class="count"><?php echo $grand_total; ?> </span> <span>BDT</span>
            </h4>
            <p class="text-light">Total Sale</p>

        </div>

        <div class="chart-wrapper pl-4" style="height:70px;" height="70">
            <i class="fas fa-fw fa-shopping-cart"></i>
        </div>
    </div>
</div>
<!--/.col-->

<div class="col-sm-6 col-lg-4">
    <div class="card text-white bg-flat-color-4">
        <div class="card-body pb-0">
            <div class="dropdown float-right">
                <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton4" data-toggle="dropdown">
                    <i class="fa fa-cog"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton4">
                    <div class="dropdown-menu-content">
                        <a class="dropdown-item" href="monthly_service.php">View Details</a>
                    </div>
                </div>
            </div>
            <?php
            $q = mysqli_query($con, "SELECT SUM(grand_total) as grand_total FROM billing WHERE DATE_FORMAT(service_date,'%m-%Y')=DATE_FORMAT(NOW(),'%m-%Y')");
            $res = mysqli_fetch_assoc($q);
            $grand_total = $res['grand_total'];
            ?>
            <h4 class="mb-0">
                <span class="count"><?php if ($grand_total > 0) {
                                        echo $grand_total;
                                    } else {
                                        echo '0';
                                    } ?>
                </span> <span>BDT</span>
            </h4>
            <p class="text-light">Current Month Sale</p>

            <div class="chart-wrapper px-3" style="height:70px;" height="70">
                <i class="fas fa-fw fa-life-ring"></i>
            </div>

        </div>
    </div>
</div>
<!--/.col-->

<div class="col-lg-4 col-md-6">
    <div class="card text-white " style="background: #11c1ca;">
        <div class="card-body pb-0">
            <div class="dropdown float-right">
                <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton4" data-toggle="dropdown">
                    <i class="fa fa-cog"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton4">
                    <div class="dropdown-menu-content">
                        <a class="dropdown-item" href="total_due.php">View Details</a>
                    </div>
                </div>
            </div>
            <?php
            $q = mysqli_query($con, "SELECT SUM(due) as total_due FROM billing");
            $res = mysqli_fetch_assoc($q);
            $total_due = $res['total_due'];
            ?>
            <h4 class="mb-0">
                <span class="count"><?php echo $total_due; ?>
                </span> <span>BDT</span>
            </h4>
            <p class="text-light">Total Due</p>

            <div class="chart-wrapper px-3" style="height:70px;" height="70">
                <i class="fas fa-fw fa-shopping-cart"></i>
            </div>

        </div>
    </div>
</div>
<!--/.col-->


<div class="col-lg-4 col-md-6">
    <div class="card text-white " style="background: #883c96;">
        <div class="card-body pb-0">
            <div class="dropdown float-right">
                <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton4" data-toggle="dropdown">
                    <i class="fa fa-cog"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton4">
                    <div class="dropdown-menu-content">
                        <a class="dropdown-item" href="monthly_due.php">View Details</a>
                    </div>
                </div>
            </div>
            <?php
            $q = mysqli_query($con, "SELECT SUM(due) as total_due FROM billing WHERE DATE_FORMAT(service_date,'%m-%Y')=DATE_FORMAT(NOW(),'%m-%Y')");
            $res = mysqli_fetch_assoc($q);
            $total_due = $res['total_due'];
            ?>
            <h4 class="mb-0">
                <span class="count"><?php if ($total_due > 0) {
                                        echo $total_due;
                                    } else {
                                        echo '0';
                                    } ?>
                </span> <span>BDT</span>
            </h4>
            <p class="text-light">Current Month Due</p>

            <div class="chart-wrapper px-3" style="height:70px;" height="70">
                <i class="fas fa-fw fa-life-ring"></i>
            </div>

        </div>
    </div>
</div>
<!--/.col-->


<div class="col-lg-4 col-md-6">
    <div class="card text-white " style="background: #542626;">
        <div class="card-body pb-0">
            <div class="dropdown float-right">
                <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton4" data-toggle="dropdown">
                    <i class="fa fa-cog"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton4">
                    <div class="dropdown-menu-content">
                        <a class="dropdown-item" href="total_collection.php">View Details</a>
                    </div>
                </div>
            </div>
            <?php
            $q = mysqli_query($con, "SELECT SUM(paid) as total_due FROM billing");
            $res = mysqli_fetch_assoc($q);
            $total_due = $res['total_due'];
            ?>
            <h4 class="mb-0">
                <span class="count"><?php echo $total_due; ?>
                </span> <span>BDT</span>
            </h4>
            <p class="text-light">Total Collection</p>

            <div class="chart-wrapper px-3" style="height:70px;" height="70">
                <i class="fas fa-fw fa-pager"></i>
            </div>

        </div>
    </div>
</div>
<!--/.col-->


<div class="col-lg-4 col-md-6">
    <div class="card text-white " style="background: #9ea018;">
        <div class="card-body pb-0">
            <div class="dropdown float-right">
                <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton4" data-toggle="dropdown">
                    <i class="fa fa-cog"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton4">
                    <div class="dropdown-menu-content">
                        <a class="dropdown-item" href="monthly_collection.php">View Details</a>
                    </div>
                </div>
            </div>
            <?php
            $q = mysqli_query($con, "SELECT SUM(last_payment) as total_due FROM billing WHERE (DATE_FORMAT(payment_date,'%m-%Y')=DATE_FORMAT(NOW(),'%m-%Y') AND DATE_FORMAT(service_date,'%m-%Y')=DATE_FORMAT(NOW(),'%m-%Y'))");
            $res = mysqli_fetch_assoc($q);
            $total_due = $res['total_due'];
            ?>
            <h4 class="mb-0">
                <span class="count"><?php if ($total_due > 0) {
                                        echo $total_due;
                                    } else {
                                        echo '0';
                                    } ?>
                </span> <span>BDT</span>
            </h4>
            <p class="text-light" style="font-size: 14px;">Collection from Current Month Sale</p>

            <div class="chart-wrapper px-3" style="height:70px;" height="70">
                <i class="fas fa-fw fa-life-ring"></i>
            </div>

        </div>
    </div>

</div>
<!--/.col-->


<div class="col-lg-4 col-md-6">
    <div class="card text-white " style="background: #9ea018;">
        <div class="card-body pb-0">
            <div class="dropdown float-right">
                <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton4" data-toggle="dropdown">
                    <i class="fa fa-cog"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton4">
                    <div class="dropdown-menu-content">
                        <a class="dropdown-item" href="monthly_collection_due.php">View Details</a>
                    </div>
                </div>
            </div>
            <?php
            $q = mysqli_query($con, "SELECT SUM(last_payment) as total_due FROM billing WHERE (DATE_FORMAT(payment_date,'%m-%Y')=DATE_FORMAT(NOW(),'%m-%Y') AND DATE_FORMAT(service_date,'%m-%Y')=DATE_FORMAT(NOW(),'%m-%Y'))");
            $res = mysqli_fetch_assoc($q);
            $total_due = $res['total_due'];
            ?>
            <h4 class="mb-0">
                <span class="count"><?php if ($total_due > 0) {
                                        echo $total_due;
                                    } else {
                                        echo '0';
                                    } ?>
                </span> <span>BDT</span>
            </h4>
            <p class="text-light" style="font-size: 14px;">Current Month Total collection</p>

            <div class="chart-wrapper px-3" style="height:70px;" height="70">
                <i class="fas fa-fw fa-life-ring"></i>
            </div>

        </div>
    </div>
</div>
<!--/.col-->

<div class="col-md-11">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="card-title mb-0">Service</h4>
                </div>
                <!--/.col-->


            </div>
            <!--/.row-->
            <div class="chart-wrapper mt-4">
                <label>Service: </label>
                <?php
                $query = mysqli_query($con, "SELECT service_name, COUNT(service_name) AS number FROM service_details GROUP BY service_name");
                while ($row = mysqli_fetch_array($query)) {
                    // var_dump($row);
                    extract($row);
                    $rand_color = '#' . substr(md5(rand()), 0, 6);
                    $json_data[] = $number;

                    $json_lebel[] = $service_name . '[' . $number . ']';
                    $json_color[] = $rand_color;
                }

                ?>

                <canvas id="myChart"></canvas>
            </div>

        </div>

    </div>
</div>