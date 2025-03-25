<?php $this->load->view('page_transaction/page_transaction_js'); ?>

<input type="hidden" value="<?= $datas['tb_id'] ?>" id="detail_id">
<input type="hidden" value="<?= $datas['grand_price'] ?>" id="grand_price">
<input type="hidden" value="<?= $datas['total_paid'] ?>" id="total_paid">
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
                            <?php if ($datas['total_paid'] != $datas['grand_price']) : ?>
                            <button class="btn btn-primary btn-sm m-1" data-toggle="modal" data-target="#modal-add-payment">Add Payment</button>
                            <?php endif; ?>
                            <button class="btn btn-primary btn-sm m-1" data-toggle="modal" data-target="#modal-change-status">Change Progress Status</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-add-payment" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Payment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class=" col-12 mb-2">
                        <label>Payment Amount</label>
                        <input type="number" class="form-control form-control-sm" id="add_payment_amount" placeholder="Payment Amount">
                        <i><span class="text-muted" id="payment-amount-idr">Rp. 0</span></i>
                    </div>
                    <div class="col-12 mb-2">
                        <label for="payment_method">Payment Method</label>
                        <select class="form-control form-control-sm" id="payment_method" name="payment_method">
                            <option value="" selected disabled>Select Payment Method</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn-add-payment">Save changes</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal-change-status" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 mb-2">
                        <label for="progress_status">Progress Status</label>
                        <select class="form-control form-control-sm" id="progress_status" name="progress_status">
                            <option value="" selected disabled>Select Progress Status</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn-change-status"">Save changes</button>
            </div>
        </div>
    </div>
</div>