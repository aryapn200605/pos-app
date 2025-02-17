<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Multigrafika | Invoice Print</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <style>
        @page {
            size: auto;
            margin: .5rem 0;
        }
    </style>

</head>

<body>
    <div class="wrapper m-5">
        <img src="<?= base_url(); ?>assets/images/logo-brand.png" width="200" class="mb-2">
        <div class="row mb-2">
            <div class="col-6">
                <strong>Order ID</strong>
            </div>
            <div class="col-6">
                <strong>Order Date</strong>
            </div>
            <div class="col-6">
                <?= $datas['order_id']; ?>
            </div>
            <div class="col-6">
                <?= $datas['created_at']; ?>
            </div>
            <div class="col-6">
                <strong>Customer Name</strong>
            </div>
            <div class="col-6">
                <strong>Customer Phone</strong>
            </div>
            <div class="col-6">
                <?= $datas['customer_name']; ?>
            </div>
            <div class="col-6">
                <?= $datas['customer_phone']; ?>
            </div>
            <div class="col-6">
                <strong>Cashier</strong>
            </div>
            <div class="col-6">
                <strong>Payment Status</strong>
            </div>
            <div class="col-6">
                <?= $datas['cashier']; ?>
            </div>
            <div class="col-6">
                <?= ($datas['total_paid'] >= $datas['grand_price'] ? 'Paid' : 'Not Paid') ?>
            </div>
            <div class="col-12">
                <strong>Note</strong>
            </div>
            <div class="col-12">
                <?= $datas['note']; ?>
            </div>
        </div>

        <table class="table table-striped table-bordered table-sm">
            <tr class="table-danger text-center">
                <th>Product</th>
                <th>Qty</th>
                <th>Unit Price</th>
                <th>Total Price</th>
            </tr>
            <?php foreach ($datas['transaction'] as $row): ?>
                <tr>
                    <td class=""><?= $row['product_name']; ?></td>
                    <td class="text-center"><?= $row['quantity']; ?></td>
                    <td class="text-end"><?= numberFormatter($row['unit_price']); ?></td>
                    <td class="text-end"><?= numberFormatter($row['total_price']); ?></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="3">Grand Total</td>
                <td class="text-end"><?= numberFormatter($datas['grand_price']); ?></td>
            </tr>
        </table>

        <table class="table table-striped table-bordered table-sm">
            <tr class="table-warning text-center">
                <th>Invoice</th>
                <th>Payment Method</th>
                <th>Payment Date</th>
                <th>Payment By</th>
                <th>Paid Amount</th>
            </tr>
            <?php foreach ($datas['invoice'] as $row): ?>
                <tr class="text-center">
                    <td><?= $row['invoice']; ?></td>
                    <td><?= $row['payment_method']; ?></td>
                    <td><?= $row['created_at']; ?></td>
                    <td><?= $row['created_by']; ?></td>
                    <td class="text-end"><?= numberFormatter($row['paid_amount']); ?></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="4">Total Payment</td>
                <td class="text-end"><?= numberFormatter($datas['total_paid']); ?></td>
            </tr>
        </table>

        <table class="table table-striped table-bordered table-sm">
            <tr class="table-warning text-center">
                <th>Grand Total</th>
                <th>Total Payment</th>
                <th>Remaining Payment</th>
            </tr>
            <tr class="text-end">
                <td><?= numberFormatter($datas['grand_price']); ?></td>
                <td><?= numberFormatter($datas['total_paid']); ?></td>
                <td><?= numberFormatter($datas['grand_price'] - $datas['total_paid']); ?></td>
            </tr>
        </table>
        <script>
            window.addEventListener("load", function() {
                window.print();
            });
        </script>
    </div>
</body>

</html>