<?php
include 'includes/config.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $q = mysqli_query($con, "SELECT * FROM billing WHERE billing_id='$id'");
    $row = mysqli_fetch_array($q);
}
function number_to_word($num = '')
{
    $num    = (string) ((int) $num);

    if ((int) ($num) && ctype_digit($num)) {
        $words  = array();

        $num    = str_replace(array(',', ' '), '', trim($num));

        $list1  = array(
            '',
            'one',
            'two',
            'three',
            'four',
            'five',
            'six',
            'seven',
            'eight',
            'nine',
            'ten',
            'eleven',
            'twelve',
            'thirteen',
            'fourteen',
            'fifteen',
            'sixteen',
            'seventeen',
            'eighteen',
            'nineteen'
        );

        $list2  = array(
            '',
            'ten',
            'twenty',
            'thirty',
            'forty',
            'fifty',
            'sixty',
            'seventy',
            'eighty',
            'ninety',
            'hundred'
        );

        $list3  = array(
            '',
            'thousand',
            'million',
            'billion',
            'trillion',
            'quadrillion',
            'quintillion',
            'sextillion',
            'septillion',
            'octillion',
            'nonillion',
            'decillion',
            'undecillion',
            'duodecillion',
            'tredecillion',
            'quattuordecillion',
            'quindecillion',
            'sexdecillion',
            'septendecillion',
            'octodecillion',
            'novemdecillion',
            'vigintillion'
        );

        $num_length = strlen($num);
        $levels = (int) (($num_length + 2) / 3);
        $max_length = $levels * 3;
        $num    = substr('00' . $num, -$max_length);
        $num_levels = str_split($num, 3);

        foreach ($num_levels as $num_part) {
            $levels--;
            $hundreds   = (int) ($num_part / 100);
            $hundreds   = ($hundreds ? ' ' . $list1[$hundreds] . ' Hundred' . ($hundreds == 1 ? '' : 's') . ' ' : '');
            $tens       = (int) ($num_part % 100);
            $singles    = '';

            if ($tens < 20) {
                $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '');
            } else {
                $tens = (int) ($tens / 10);
                $tens = ' ' . $list2[$tens] . ' ';
                $singles = (int) ($num_part % 10);
                $singles = ' ' . $list1[$singles] . ' ';
            }
            $words[] = $hundreds . $tens . $singles . (($levels && (int) ($num_part)) ? ' ' . $list3[$levels] . ' ' : '');
        }
        $commas = count($words);
        if ($commas > 1) {
            $commas = $commas - 1;
        }

        $words  = implode(' ', $words);

        //Some Finishing Touch
        //Replacing multiples of spaces with one space
        // $words  = trim( str_replace( ' ,' , ',' , trim_all( ucwords( $words ) ) ) , ', ' );
        // if( $commas )
        // {
        //     $words  = str_replace_last( ',' , ' and' , $words );
        // }

        return $words;
    } else if (! ((int) $num)) {
        return 'Zero';
    }
    return '';
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <title>Invoice</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            padding: 0 70px 0 70px;
        }

        .companylogo img {
            width: 100%;
        }

        .invoctoright {
            margin-top: 25px;
            font-size: 15px;
            font-weight: 500;
        }

        .invceTop {
            /* padding: 42px 0px; */
            color: black;
            overflow: hidden;
            /* margin-top: 23px; */
        }

        .invcetopleft {
            margin-top: -30px;
            float: left;
        }

        .tcolor {
            border: 2px solid;
            border-color: black;
        }

        /*table, th, td {*/
        /*  border: 2px solid;*/
        /*  border-color: red;*/
        /*}*/



        /* .invcetopleft p {
            font-weight: 600;
            font-size: 17px;
        } */

        .invoctoright {
            float: right;
        }

        h2.subjectofinvoice {
            font-size: 21px;
            margin-bottom: 55px;
            margin-top: 38px;
        }

        .invoiceFooter {
            display: flex;
            justify-content: center;
            /* Aligns items to the left and right */
            align-items: center;
            /* Vertically centers the items */
            padding: 30px;
            /* Adds some padding */
        }

        /* .authoritySignature,
        .customerSignature {
            flex: 1;
            text-align: left;
        } */

        .customerSignature {
            text-align: right;
            /* Right aligns text in customer signature */
        }


        p.addrs {
            font-size: 13px;
            color: #999;
        }

        /* .invoiceFooter {
            overflow: hidden;
        } */

        table#invoiceTable {
            color: black;
            margin-top: 10px;
            margin-bottom: 36px;

        }

        .invoctoright .companylogo img {
            width: 200px;
            margin-bottom: 36px;
        }

        .invoiceFooter p {
            margin: 0;
        }

        body {
            width: 84%;
            margin: auto;
            font-size: 18px;
        }

        p,
        span,
        th,
        td {
            color: black;
        }

        .content {
            flex: 1;
            /* Your main content styling */
        }

        .content1 {
            flex: 2;
            margin-top: 100px;
            /* Your main content styling */
        }



        @media print {
            .noprint {
                display: none;
            }

            body {
                width: 100%;
            }

            div#content {
                background: #fff;
                padding: 0 80px;
            }

        }

        #footer {
            padding: 20px;
            text-align: center;
            /* border-top: 1px solid #ccc; */
            position: relative;
            bottom: 0;
            width: 100%;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #868686 !important;
        }

        hr {
            border-top: 1px solid rgba(0, 0, 0, 0.7);
        }
    </style>
</head>

<body>

    <a id="printbtn" class="noprint btn btn-primary" title="print screen" alt="print screen" onclick="window.print();" target="_blank" style="cursor: pointer;color: white; font-weight:bolder; width: 10%;"><i class="fas fa-print noprint"></i> Print</a>
    <!--<a href="invoice.pdf" class="noprint" id="printbtn" href=""><i class="fas fa-file-pdf noprint"></i></a>-->
    <div class="content">
        <div class="header_image text-right">
            <img src="./image/tech.png" alt="">
        </div>

        <div class="invceTop">
            <div class="invoctoright" style="float: right;">

                <table>
                    <tr>
                        <td>Invoice No: </td>
                        <td class="text-right"><?php echo $row['money_reciept']; ?></td>
                    </tr>
                    <tr>
                        <td>Date Of Invoice: </td>
                        <td class="text-right"><?php echo date('Y-m-d') ?></td>
                    </tr>
                </table>
            </div>
            <div class="invcetopleft">
                <p style="width: 700px;">
                    <span style="font-weight: bold;">To</span>
                    <br>
                    <span style="font-weight: bold;text-align:justify;">
                        <?php
                        echo $row['client_company'];
                        ?>
                    </span>

                    <br>
                    <?php
                    echo $row['client_name'];
                    ?>
                    <br>
                    <?php
                    echo $row['client_designation'];
                    ?>
                    <br>
                    <?php
                    echo $row['client_address'];
                    ?>
                    <br>
                    Mobile No : <?php
                                echo "0" . $row['client_contact'];
                                ?>
                </p>
                <br>
                <p style="font-weight: 600;font-size: 17px;">Subject: <?php echo $row['billing_subject'] ?></p>
                <!-- <p style="margin-top: 30px;">Dear Sir/Madam, <br>
                    As per your requirement here I share the financial offer as below – </p> -->
            </div>

        </div>

        <table class="table table-sm table-bordered text-right" id="invoiceTable">
            <thead>
                <tr>
                    <th scope="col" class="text-center">Sl.No</th>
                    <th scope="col" class="text-center">Service name</th>
                    <th scope="col" class="text-center">Service Description</th>
                    <th scope="col" class="text-center">Unit Price</th>
                    <th scope="col" class="text-center">Unit</th>
                    <th scope="col" class="text-center">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $n = 1;
                $query = mysqli_query($con, "SELECT * FROM service_details WHERE billing_id='$id'");
                while ($res = mysqli_fetch_array($query)) {
                ?>
                    <tr>
                        <td class="text-center"><?php echo $n++; ?></td>
                        <td class="text-left"><?php echo $res['service_name'] ?></td>
                        <td class="text-left" style="width: 400px;"><?php echo $res['service_description'] ?></td>
                        <td class="text-right"><?php echo $res['unit_price'] . ".00" ?></td>
                        <td class="text-center"><?php echo $res['unit'] ?></td>
                        <td class="text-right"><?php echo $res['price'] . ".00" ?></td>
                    </tr>
                <?php
                }
                ?>
                <tr>
                    <td colspan="5">Sub Total =</td>
                    <td class="text-right"><b><?php echo $row['sub_total'] . ".00" ?></b></td>
                </tr>
                <tr>
                    <td colspan="5">Previous Due =</td>
                    <td class="text-right"><b><?php echo $row['previous_due'] . ".00" ?></b></td>
                </tr>
                <tr>
                    <td colspan="5">Grand Total =</td>
                    <td class="text-right"><b><?php echo $row['grand_total'] . ".00" ?></b></td>
                </tr>
                <tr>
                    <td colspan="5">Paid =</td>
                    <td class="text-right"><b><?php echo $row['paid'] . ".00" ?><b></td>
                </tr>
                <tr>
                    <td colspan="5">Due =</td>
                    <td class="text-right"><b><?php echo $row['due'] . ".00" ?><b></td>
                </tr>
            </tbody>
        </table>
        <span style="text-transform: capitalize; margin-top: 20px;"><b>In Word (BDT): </b>
            <?php

            echo  number_to_word($row['due']);
            ?> Only
        </span>

        <p style="margin-top: 40px;">You are requested to pay the bill by issuing cheque or Cash in favor of <b>“TechSolutions”</b>. If you need anything further to know or ask, please feel free to call at <b>01310-032419</b> .</p>

        <h4 style="font-weight: bold;">Note :</h4>
        <h5 style="font-weight: bold;">Payment Instraction : </h5>
        <h5> Bank Name : Bank Asia Limited </h5>
        <h5> Account Name. TechSolutions</h5>
        <h5> Account No. 08333000141</h5>
    </div>


    <div class="content1">
        <div class="invoiceFooter">
            <p style="margin-top: 10px;text-align: center;font-weight: 600;">This is a software genarated invoice and no manual signature required </p>
        </div>
    </div>



    <footer id="footer">
        <hr>
        <p class="addrs text-center" style="font-size: 14px;">
            Tapa Complex, 169/Ka, Level-9, Shahid Syed Nazrul Islam Sarani, (Old) Purana Paltan, Dhaka-1000. <br>
            E-mail : info@techsolutionsplex.com, Website : techsolutionsplex.com
        </p>

    </footer>


</body>

</html>