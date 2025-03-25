<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>A simple, clean, and responsive HTML invoice template</title>

    <style>
        hr {
            margin: 0;
        }

        span {
            font-size: 12px;
            color: #6c757d;
        }

        @page {
            size: auto;
            margin: .5rem 0;
        }

        .invoice-box,
        .invoice-box-second,
        .invoice-box-third {
            max-width: 800px;
            margin: auto;
            font-size: 14px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }


        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        .invoice-box.rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2) {
            text-align: left;
        }

        .flex-container {
            display: flex;
            justify-content: space-between;
        }

        .invoice-box-second table {
            width: 100%;
            /* table-layout: fixed; */
        }

        .invoice-box-second table td:nth-child(1),
        .invoice-box-second table td:nth-child(4) {
            width: 17%;
        }

        .invoice-box-second table td:nth-child(2),
        .invoice-box-second table td:nth-child(5) {
            width: 1%;
        }

        .invoice-box-second table td:nth-child(3),
        .invoice-box-second table td:nth-child(6) {
            width: 32%;
        }

        .invoice-box-second td {
            vertical-align: top;
            word-break: break-word;
        }

        .invoice-box-second td:first-child {
            white-space: nowrap;
        }

        /* Table Product */
        .invoice-box-third table {
            width: 100%;
        }

        .invoice-product-header td {
            text-align: center !important;
        }

        .invoice-product td:nth-child(1) {
            width: 50%;
            text-align: left;
        }

        .invoice-product td:nth-child(2) {
            width: 10%;
            text-align: center;
        }

        .invoice-product td:nth-child(3),
        .invoice-product td:nth-child(4) {
            width: 20%;
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="<?= base_url(); ?>assets/images/logo-brand.png"
                                    style="width: 100%; max-width: 300px" />
                            </td>

                            <td>
                                Jl. Mayjend Ishak Djuarsa No.79, Gunungbatu, Kec. Bogor Bar.<br />
                                Phone. 0813-1303-4683<br />
                                Kota Bogor, Jawa Barat 16610
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <div class="flex-container">
                        <span><b>Bukti Pemesanan (ASLI)</b></span>
                        <span></span>
                    </div>
                    <hr>
                </td>
            </tr>
        </table>
    </div>
    <div class="invoice-box-second">
        <table>
            <tr>
                <td><b>Nama</b></td>
                <td class="separator">:</td>
                <td><?= $datas['customer_name'] ?></td>

                <td><b>Tgl Pesanan</b></td>
                <td class="separator">:</td>
                <td><?= $datas['created_at'] ?></td>
            </tr>
            <tr>
                <td><b>Nomor HP</b></td>
                <td class="separator">:</td>
                <td><?= $datas['customer_phone'] ?></td>

                <td><b>Tgl Selesai</b></td>
                <td class="separator">:</td>
                <td><?= $datas['deadline'] ?></td>
            </tr>
            <tr>
                <td><b>Kasir</b></td>
                <td class="separator">:</td>
                <td><?= $datas['cashier'] ?></td>

                <td><b>Status Pembayaran</b></td>
                <td class="separator">:</td>
                <td><?= $datas['grand_price'] == $datas['total_paid'] ? "Lunas" : "Belum Lunas" ?></td>
            </tr>
            <tr>
                <td><b>Order ID</b></td>
                <td class="separator">:</td>
                <td><?= $datas['order_id'] ?></td>
                <td><b>Status Pesanan</b></td>
                <td class="separator">:</td>
                <td><?= $datas['status'] ?></td>
            </tr>
            <tr>
                <td><b>Note</b></td>
                <td class="separator">:</td>
                <td colspan="4"><?= $datas['note'] ?></td>
            </tr>
        </table>
    </div>
    <div class="invoice-box-third">
        <table class="invoice-table">
            <tr>
                <td colspan="5">
                    <hr>
                </td>
            </tr>
            <tr class="invoice-product-header invoice-product">
                <td colspan="2">Nama Barang</td>
                <td>Qty</td>
                <td>Harga</td>
                <td>SubTotal</td>
            </tr>
            <tr>
                <td colspan="5">
                    <hr>
                </td>
            </tr>
            <?php foreach ($datas['transaction'] as $row) : ?>

                <tr class="invoice-product">
                    <td colspan="2"><?= $row['product_name'] ?></td>
                    <td><?= $row['quantity'] ?></td>
                    <td><?= numberFormatter($row['unit_price']) ?></td>
                    <td><?= numberFormatter($row['total_price']) ?></td>
                </tr>

            <?php endforeach; ?>
            <tr>
                <td colspan="5">
                    <hr>
                </td>
            </tr>
            <tr>
                <td colspan="4">Total Pesanan</td>
                <td style="text-align: right;"><?= numberFormatter($datas['grand_price']) ?></td>
            </tr>
            <tr>
                <td colspan="5">
                    <hr>
                </td>
            </tr>
            <?php
            $count = count($datas['invoice']);
            $firstRow = true;

            foreach ($datas['invoice'] as $row) :
            ?>

                <tr>
                    <?php if ($firstRow) : ?>
                        <td rowspan="<?= $count ?>" style="vertical-align: top; width: 25%;">Riwayat Pembayaran</td>
                        <?php $firstRow = false; ?>
                    <?php endif; ?>
                    <td colspan="3"><?= $row['invoice'] . " | " . $row['created_at'] . " | " . $row['payment_method'] ?></td>
                    <td style="text-align: right;"><?= numberFormatter($row['paid_amount']) ?></td>
                </tr>

            <?php endforeach; ?>
            <tr>
                <td colspan="5">
                    <hr>
                </td>
            </tr>
            <tr>
                <td colspan="4">Sisa tagihan</td>
                <td style="text-align: right;"><?= numberFormatter($datas['total_paid'] - $datas['grand_price']) ?></td>
            </tr>
            <tr>
                <td colspan="5">
                    <hr>
                </td>
            </tr>
            <tr>
                <td colspan="5"><span>Dicetak pada: <?= date('Y-m-d H:i:s') ?></span></td>
            </tr>
        </table>
    </div>

    <script>
        window.addEventListener("load", function() {
            window.print();
        });
    </script>
</body>

</html>