<script src="vendors/jquery/dist/jquery.min.js"></script>
<script src="vendors/popper.js/dist/umd/popper.min.js"></script>
<script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="assets/js/main.js"></script>


<script src="vendors/chart.js/dist/Chart.bundle.min.js"></script>
<script src="assets/js/dashboard.js"></script>
<script src="assets/js/widgets.js"></script>
<script src="vendors/jqvmap/dist/jquery.vmap.min.js"></script>
<script src="vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
<script src="vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
    $('#addMore').on('click', function(e) {
        var $lastRow = $('#serviceTAble tbody>tr:last');

        if ($lastRow.index() < 100) { // set maximum rows here

            var appndRow = $lastRow.clone(true).insertAfter($lastRow).find('input[type="text"]').val("");
        }
        return false;
    });
    $('#deleterow').on('click', function(e) {
        if ($("#serviceTAble tr.items:not(:first-child)").length > 0)
            $("tr.items:last()").remove();
        return false;
        // $('#row').remove();

    });

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

    price_calculate = function() {
        var totcost = 0;
        $('tr.items').each(function(i, el) {
            var $this = $(this),
                $unit_price = $this.find('[name="unit_price\\[\\]"]'),
                $unit = $this.find('[name="unit\\[\\]"]'),
                c = parseFloat($unit_price.val()),
                q = parseInt($unit.val(), 10),
                
                total = c * q || 0;
            $this.find('[name="price\\[\\]"]').val(total);
            totcost = totcost + total;
        });
        $("#sub_total").val(totcost);
        var due_pr = parseFloat($("#pr_due").val());
        var pr_due = (totcost + due_pr);
        $("#grandtotal").val(pr_due);
        var rcv = parseFloat($("#paid").val());
        var due = (totcost + due_pr - rcv);
        $("#due").val(due);
    }

    // function calc() {
    //     var totcost = 0;
    //     $('tr.items').each(function(i, el) {
    //         var $this = $(this),
    //             $unit_price = $this.find('[name="unit_price\\[\\]"]'),
    //             $unit = $this.find('[name="unit\\[\\]"]'),
    //             c = parseFloat($unit_price.val()),
    //             q = parseInt($unit.val(), 10),
    //             total = c * q || 0;
    //         $this.find('[name="price\\[\\]"]').val(total);
    //         totcost = totcost + total;
    //     });

    //     $("#grandtotal").val(totcost);
    //     $("#totalCostDisplay").text(totcost.toFixed(2));
    //     var rcv = parseFloat($("#paid").val());
    //     var due = (totcost - rcv);
    //     $("#due").val(due);

    // }


    $('#myModal').on('shown.bs.modal', function() {
        $('#myInput').trigger('focus')
    })
</script>


<!-- company_table -->
<script>
    $('#addMore').on('click', function(e) {
        var $lastRow = $('#companyTAble tbody>tr:last');

        if ($lastRow.index() < 100) { // set maximum rows here

            var appndRow = $lastRow.clone(true).insertAfter($lastRow).find('input[type="text"]').val("");
        }
        return false;
    });
    $('#deleterow').on('click', function(e) {
        if ($("#companyTAble tr.items:not(:first-child)").length > 0)
            $("tr.items:last()").remove();
        return false;
        // $('#row').remove();

    });
</script>

<script>
    (function($) {
        "use strict";

        jQuery('#vmap').vectorMap({
            map: 'world_en',
            backgroundColor: null,
            color: '#ffffff',
            hoverOpacity: 0.7,
            selectedColor: '#1de9b6',
            enableZoom: true,
            showTooltip: true,
            values: sample_data,
            scaleColors: ['#1de9b6', '#03a9f5'],
            normalizeFunction: 'polynomial'
        });
    })(jQuery);
</script>