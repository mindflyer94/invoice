<html>
<head>
    <meta charset="utf-8">
    <title>Invoice Generator</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Libraries CSS Files -->
    <link href="<?php echo base_url(); ?>css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
<div class="container">
    <?php echo form_open('Welcome/insert_item', 'enctype="multipart/form-data"  name="form1" method="post" id="formID"'); ?>

    <div class="row my-5">

        <div class="col-lg-8 offset-lg-2">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h4>Add Item</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">Name :<input type="text" class="form-control" name="name" id="name"
                                                   required="required"></div>

                <div class="col-lg-6">Quantity :<input type="text" class="form-control" name="quantity" id="quantity"
                                                       required="required"></div>
            </div>
            <div class="row my-2">
                <div class="col-lg-6">Unit price($) :<input type="text" class="form-control" name="price" id="price"
                                                            required="required"></div>

                <div class="col-lg-6">Tax :<select class="form-select col-lg-4" name="tax"
                                                   id="tax">
                        <?php
                        foreach ($tax as $row) {
                            echo '<option value="' . $row['id'] . '">' . $row['value'] . ' %</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row my-4">
                <div class="col-lg-12 text-center"><input class="btn btn-success" type="submit" name="btnsubmit"
                                                          id="btnsubmit" value="Add"></div>
            </div>
        </div>
        <?php echo form_close(); ?>

        <?php if (isset($result)) {
            ?>
            <?php echo form_open('Welcome/update_invoice', 'enctype="multipart/form-data"  name="form2" method="post" id="secondForm" '); ?>
            <div id="printableArea" class="col-lg-10 offset-lg-1">
                <div class="row my-4">
                    <div class="col-lg-12 text-center"><h2>Invoice</h2></div></div>
                <div class="row my-4">
                    <div class="col-lg-12">
                        <table class="table table-bordered table-striped">

                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Tax</th>
                                <th>Tax Amount</th>
                                <th>total with tax</th>
                                <th>total without tax</th>
                                <th>Discount</th>
                                <th>To pay</th>

                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $i = 1;
                            $grand_total = 0;
                            foreach ($result as $row) {
                                $product_id = $row['id'];
                                $name = $row['name'];
                                $quantity = $row['quantity'];
                                $price = $row['unit_price'];
                                $tax = $row['tax'];
                                $tax_value = $row['value'];
                                $a_discount = $row['discount_price'];


                                $tax_amount = ($quantity * $price * $tax_value) / 100;
                                $t_amt_with_tax = ($quantity * $price) + $tax_amount;
                                $t_amt_no_tax = ($quantity * $price);
                                $p_discount = ($a_discount * 100) / $t_amt_with_tax;
                                if ($a_discount)
                                    $topay =  $t_amt_with_tax-$a_discount;
                            else
                                $topay =$t_amt_with_tax;

                                // $from = $row->discount;
                                ?>
                                <tr><input type="hidden" name="p_id[]" value="<?php echo $product_id; ?>">
                                    <td><?php echo $i; ?>.</td>
                                    <td><?php echo $name; ?></td>
                                    <td><?php echo $quantity; ?></td>
                                    <td><?php echo $price; ?></td>
                                    <td><?php echo $tax_value . '%'; ?></td>
                                    <td><?php echo $tax_amount; ?></td>
                                    <td><?php echo $t_amt_with_tax; ?></td>
                                    <td><?php echo $t_amt_no_tax; ?></td>
                                    <td>
                                        <input type="text" name="percent[]" class="percent"
                                               value="<?php if ($p_discount) echo $p_discount; ?>"><b>(%)</b>
                                        <input type="text" name="amount[]" class="amount"
                                               value="<?php if ($a_discount) echo $a_discount; ?>"><b>($)</b></div>
                                    </td>
                                    <td class="final_amount text-end"><?php echo $topay; ?></td>
                                </tr>
                                <?php
                                $i++;
                                $grand_total += $topay;
                            }
                            ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <th class="text-end">Grand Total</th>
                                <td id="grand" class="text-end"><?php echo $grand_total; ?></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row my-4">
                <div class="col-lg-12 text-center">
                    <input class="btn btn-success" type="submit" name="save" id="save" value="save">
                    <input class="btn btn-primary" type="button" name="print" id="print" value="print"
                           onclick="printDiv('printableArea')">
                </div>
            </div>
        <?php } ?>
        <?php echo form_close(); ?>
    </div>
</div>

<script src="<?php echo base_url(); ?>js/bootstrap.js"></script>
<script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>js/jquery.js"></script>

<script type="text/javascript">
    function printDiv(divName) {

        $('.percent').each(function () {
            $(this).attr("placeholder", ($(this).val()));
        });
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>


<script>

    $(document).on("keyup", '.percent', function () {

        var tax_total = parseFloat($(this).closest("tr").find("td").eq(6).text());
        var disc_amount = 0;
        var topay = tax_total;


        var disc_percentage = $(this).val();
        if (disc_percentage != '') {
            disc_amount = (tax_total * disc_percentage) / 100;
            topay = tax_total - disc_amount;
        }

        $(this).closest("tr").find(".amount").val(disc_amount);
        $(this).closest("tr").find("td").eq(9).text(topay < 0 ? 0 : topay);
        total_amount();
    });

    $(document).on("keyup", '.amount', function () {

        var tax_total = parseFloat($(this).closest("tr").find("td").eq(6).text());
        var disc_percentage = 0;
        var topay = tax_total;
        var disc_amount = $(this).val();

        if (disc_amount != '' && disc_amount != 0) {
            disc_percentage = (disc_amount * 100) / tax_total;
            topay = tax_total - disc_amount;
        }

        $(this).closest("tr").find(".percent").val(disc_percentage);
        $(this).closest("tr").find("td").eq(9).text(topay < 0 ? 0 : topay);
        total_amount();
    });

    function total_amount() {
        var total = 0;
        $(".final_amount").each(function () {
            total += parseFloat($(this).text());
        });
        $("#grand").text(total);
    }
</script>
</body>

</html>
