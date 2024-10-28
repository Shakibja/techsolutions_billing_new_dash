<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php include 'includes/head.php' ?>
</head>
<!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/fonts/dropify.eot" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/fonts/dropify.svg" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/fonts/dropify.ttf" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/fonts/dropify.woff" rel="stylesheet">
<?php
if (isset($_POST['submit'])) {
    $item_name = $_POST['item_name'];
    $unit_price = $_POST['unit_price'];
    $quantity = $_POST['quantity'];
    $commission = $_POST['commission'];
    $total = $_POST['total'];

    $image = $_FILES['image']['name'];
    $image = time() . $image;
    $image_temp = $_FILES['image']['tmp_name'];
    move_uploaded_file($image_temp, "image/inventory/$image");

    $sql = "INSERT INTO inventory (item_name,image,unit_price,quantity,commission,total,stock) VALUES('$item_name','$image','$unit_price','$quantity','$commission','$total','$quantity')";
    if (mysqli_query($con, $sql)) {
        echo "<script>
                            alert('Inventory item added successfully.');
                            window.location='inventory_add.php';
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
                                <strong class="card-title">Add Inventory</strong>
                            </div>
                            <div class="card-body">
                                <form action="" method="post" enctype="multipart/form-data">

                                    <div class="fromCompany" style="margin: 50px 0;">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="regardperson">Item Name <b style="color: red">*</b></label>
                                                <input type="text" name="item_name" class="form-control" required>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="custom-file">
                                                    <label> Product Image:</label>
                                                    <input type="file" name="image" class="dropify" data-allowed-file-extensions="jpg png jpeg" data-show-errors="true" data-show-loader="true">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <table class="table" id="serviceTAble">
                                            <thead>
                                                <th>Unit Price</th>
                                                <th>Stock</th>
                                                <th>Commission ( % )</th>
                                                <th>Total</th>
                                            </thead>
                                            <tbody>
                                                <tr class="items" id="row">
                                                    <td><input type="text" id="unit_price" name="unit_price" onblur='price_calculate_inventory()' class="form-control" required></td>
                                                    <td><input type="text" id="quantity" name="quantity" class="form-control" onblur="price_calculate_inventory()" required> </td>
                                                    <td><input type="text" id="commission" name="commission" onblur='price_calculate_inventory()' class="form-control" value="0" required></td>
                                                    <td><input type="text" id="total" name="total" class="form-control" required> </td>
                                                </tr>
                                            </tbody>
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
        // Basic
        $('.dropify').dropify();
        // Translated
        $('.dropify-fr').dropify({
            messages: {
                default: 'Drag and drop a file here or click',
                replace: 'Drag and drop a file or click to replace',
                remove: 'Remove',
                error: 'Sorry, the file is too large'
            }
        });
        // Used events
        var drEvent = $('#input-file-events').dropify();

        drEvent.on('dropify.beforeClear', function(event, element) {
            return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
        });
        drEvent.on('dropify.afterClear', function(event, element) {
            alert('File deleted');
        });
        drEvent.on('dropify.errors', function(event, element) {
            console.log('Has Errors');
        });
        drEvent.on('dropify.error.fileSize', function(event, element) {
            alert('Filesize error message!');
        });
        drEvent.on('dropify.error.minWidth', function(event, element) {
            alert('Min width error message!');
        });
        drEvent.on('dropify.error.maxWidth', function(event, element) {
            alert('Max width error message!');
        });
        drEvent.on('dropify.error.minHeight', function(event, element) {
            alert('Min height error message!');
        });
        drEvent.on('dropify.error.maxHeight', function(event, element) {
            alert('Max height error message!');
        });
        drEvent.on('dropify.error.imageFormat', function(event, element) {
            alert('Image format error message!');
        });

        var drDestroy = $('#input-file-to-destroy').dropify();
        drDestroy = drDestroy.data('dropify')
        $('#toggleDropify').on('click', function(e) {
            e.preventDefault();
            if (drDestroy.isDropified()) {
                drDestroy.destroy();
            } else {
                drDestroy.init();
            }
        })
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>

    <script>
    price_calculate_inventory = function() {
        var totcost = 0;
        $('tr.items').each(function(i, el) {
            var $this = $(this),
                $unit_price = $this.find('[name="unit_price"]'),
                $quantity = $this.find('[name="quantity"]'),
                $commission = $this.find('[name="commission"]'),
                u = parseFloat($unit_price.val()),
                q = parseInt($quantity.val(), 10),
                c = parseFloat($commission.val()),
                total = u * q || 0,
                total = ((c * total) / 100) + total;
            $this.find('[name="total"]').val(total);
        });

        $("#grandtotal").val(totcost);
        var rcv = parseFloat($("#paid").val());
        var due = (totcost - rcv);
        $("#due").val(due);
    }

</script>


</body>

</html>