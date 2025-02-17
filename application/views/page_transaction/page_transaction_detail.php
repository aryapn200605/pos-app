<?php $this->load->view('page_transaction/page_transaction_js'); ?>

<input type="hidden" value="<?= $datas['tb_id'] ?>" id="detail_id">
<div class="row">
    <div class="col-7">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped table-sm text-center">
                    <thead>
                        <tr>
                            <th class="text-left">Product Name</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($datas['transaction'] as $row): ?>
                            <tr>
                                <td class="text-left"><?= $row['product_name']; ?></td>
                                <td><?= $row['quantity']; ?></td>
                                <td class="text-right"><?= numberFormatter($row['unit_price']); ?></td>
                                <td class="text-right"><?= numberFormatter($row['total_price']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table class="table table-striped table-sm text-center">
                    <thead>
                        <tr>
                            <th>Invoice</th>
                            <th>Paid Amount</th>
                            <th>Payment Method</th>
                            <th>Payment Date</th>
                            <th>Payment By</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($datas['invoice'] as $row): ?>
                            <tr>
                                <td><?= $row['invoice']; ?></td>
                                <td class="text-right"><?= numberFormatter($row['paid_amount']); ?></td>
                                <td><?= $row['payment_method']; ?></td>
                                <td><?= $row['created_at']; ?></td>
                                <td><?= $row['created_by']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-5">
        <div class="card">
            <div class="card-body">

                <h3>Customer Detail</h3>
                <div class="row">
                    <div class="mb-2 col-6">
                        <label>Customer Name</label>
                        <input type="text" class="form-control form-control-sm" placeholder="Customer Name" value="<?= $datas['customer_name']; ?>" readonly>
                    </div>
                    <div class="mb-2 col-6">
                        <label>Cuastomer Phone</label>
                        <input type="text" class="form-control form-control-sm" placeholder="Customer Phone" value="<?= $datas['customer_phone']; ?>" readonly>
                    </div>
                    <div class="mb-2 col-6">
                        <label>Deadline</label>
                        <input type="text" class="form-control form-control-sm" placeholder="Deadline" value="<?= $datas['deadline']; ?>" readonly>
                    </div>
                    <div class="mb-2 col-6">
                        <label>Note</label>
                        <input type="text" class="form-control form-control-sm" placeholder="Note" value="<?= $datas['note']; ?>" readonly>
                    </div>
                    <div class="mb-2 col-6">
                        <label>Order Date</label>
                        <input type="text" class="form-control form-control-sm" placeholder="Order Date" value="<?= $datas['created_at']; ?>" readonly>
                    </div>
                    <div class="mb-2 col-6">
                        <label>Cashier</label>
                        <input type="text" class="form-control form-control-sm" placeholder="Cashier" value="<?= $datas['cashier']; ?>" readonly>
                    </div>
                    <div class="mb-2 col-6">
                        <label>Payment Status</label><br>
                        <span class="badge badge-<?= ($datas['total_paid'] >= $datas['grand_price'] ? 'success' : 'warning') ?>"><?= ($datas['total_paid'] >= $datas['grand_price'] ? 'Paid' : 'Not Paid') ?></span>
                    </div>
                    <div class="mb-2 col-6">
                        <label>Order Status</label><br>
                        <span class="badge badge-<?php badgeProgressStatus($datas['status']) ?>"><?= $datas['status']; ?></span>
                    </div>
                    <div class="mb-2 col-12">
                        <label class="mb-2">Action</label><br>
                        <div class="d-flex align-content-start flex-wrap">
                            <button class="btn btn-primary btn-sm m-1" id="btn-pdf">Download PDF</button>
                            <button class="btn btn-success btn-sm m-1" id="btn-print">Print</button>
                            <button class="btn btn-danger btn-sm m-1" id="btn-delete">Delete</button>
                            <button class="btn btn-primary btn-sm m-1">Add Payment</button>
                            <button class="btn btn-primary btn-sm m-1">Change Progress Status</button>
                            <button class="btn btn-primary btn-sm m-1">Download PDF</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>