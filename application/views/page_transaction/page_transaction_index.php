<?php $this->load->view('page_transaction/page_transaction_js'); ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body row">
                <div class="mb-2 col-2">
                    <label>Order ID</label>
                    <input type="text" class="form-control form-control-sm" id="order_id" placeholder="Order">
                </div>
                <div class="mb-2 col-2">
                    <label>Customer Name</label>
                    <input type="text" class="form-control form-control-sm" id="customer_name" placeholder="Customer Name">
                </div>
                <div class="mb-2 col-2">
                    <label>Phone Number</label>
                    <input type="text" class="form-control form-control-sm" id="phone_number" placeholder="Phone Number">
                </div>
                <div class="mb-2 col-2">
                    <label>Items</label>
                    <input type="text" class="form-control form-control-sm" id="item" placeholder="Items">
                </div>
                <div class="mb-2 col-2">
                    <label>Payment Method</label>
                    <select class="form-control form-control-sm" id="payment_method" name="payment_method">
                        <option value="" selected disabled>Select Payment Method</option>
                    </select>
                </div>
                <div class="mb-2 col-2">
                    <label>Payment Status</label>
                    <select class="form-control form-control-sm" id="payment_status" name="payment_status">
                        <option value="" selected disabled>Select Payment Status</option>
                        <option value="1">Paid</option>
                        <option value="2">Not Paid</option>
                    </select>
                </div>
                <div class="mb-2 col-2">
                    <label class=" for="progress_status">Progress Status</label>
                    <select class="form-control form-control-sm" id="progress_status" name="progress_status">
                        <option value="" selected disabled>Select Progress Status</option>
                    </select>
                </div>
                <div class="mb-2 col-2">
                    <label>Deadline</label>
                    <input type="date" class="form-control form-control-sm" id="deadline" placeholder="Deadline">
                </div>
                <div class="mb-2 col-2">
                    <label>Transaction Date</label>
                    <input type="date" class="form-control form-control-sm" id="transaction_date" placeholder="Transaction Date">
                </div>
                <div class="mb-2 col-2">
                    <label>Cashier</label>
                    <select class="form-control form-control-sm" id="select_cashier" name="cashier">
                        <option value="" selected disabled>Select Cashier</option>
                    </select>
                </div>
                <div class="mb-2 col-2 d-flex justify-content-between">
                    <button class="btn btn-primary w-50 mr-2" id="btn-search">Search <i class="fa fa-search"></i></button>
                    <button class="btn btn-secondary w-50" id="btn-clear">Clear <i class="fa fa-times"></i></button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table id="transaction-table" class="table table-striped table-sm table-hover text-center">
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-detail">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Transaction</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>