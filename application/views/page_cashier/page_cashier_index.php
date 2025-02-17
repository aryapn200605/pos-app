<?php $this->load->view('page_cashier/page_cashier_js'); ?>
<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>

<div class="section">
    <div class="row">
        <div class="col-9">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <input type="hidden" id="form_category" value="create">
                        <input type="hidden" id="product_id">
                        <div class="col-4">
                            <label>Product</label>
                            <input type="text" class="form-control form-control-sm" id="product_name" placeholder="Product">
                        </div>
                        <div class="col-2">
                            <label>Quantity</label>
                            <input type="number" class="form-control form-control-sm" id="quantity" placeholder="Quantity">
                        </div>
                        <div class="col-2">
                            <label>Unit Price</label>
                            <input type="number" class="form-control form-control-sm mb-2" id="unit_price" placeholder="Unit Price">
                            <i><span class="text-muted" id="unit-price-idr">Rp. 0</span></i>
                        </div>
                        <div class="col-3">
                            <label>Total Price</label>
                            <input type="number" class="form-control form-control-sm mb-2" id="total_price" placeholder="Total Price">
                            <i><span class="text-muted" id="total-price-idr">Rp. 0</span></i>
                        </div>

                        <div class="col-1 text-center">
                            <button type="button" class="btn btn-sm btn-primary mb-1" id="btn-add">
                                <i class="nav-icon fas fa-plus"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-danger mb-1" id="btn-clear">
                                <i class="nav-icon fas fa-trash"></i>
                            </button>
                            <h6 class="text-success" id="warn-create">Create</h6>
                            <h6 class="text-warning d-none" id="warn-edit">Edit</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <!-- Divider -->
                        <div class="col-4">
                            <label>Grand Total</label><br>
                            <input type="hidden" class="form-control form-control-sm" id="grand_total" placeholder="Grand Total" disabled>
                            <i><b><span class="text-muted" id="grand-total-idr">Rp. 0</span></b></i>
                        </div>
                        <div class="col-4">
                            <label>Remaining Payment</label><br>
                            <input type="hidden" class="form-control form-control-sm" id="remaining_payment" placeholder="Remaining Payment" disabled>
                            <i><b><span class="text-muted" id="remaining-payment-idr">Rp. 0</span></b></i>
                        </div>
                        <div class="col-4">
                            <label>Deposits - <i><span class="text-muted" id="deposits-idr">Rp. 0</span></i></label>
                            <input type="number" class="form-control form-control-sm" id="deposits" placeholder="Deposits" min="0" value="0">

                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <table class="table table-sm table-striped" id="table-product">
                        <thead>
                            <tr class="text-center">
                                <th style="width: 5%;">No</th>
                                <th style="width: 34%;">Product</th>
                                <th style="width: 15%;">Quantity</th>
                                <th style="width: 18%;">Unit Price</th>
                                <th style="width: 18%;">Total Price</th>
                                <th style="width: 10%;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <form id="form-cashier">
                        <div class="mb-2">
                            <label>Customer Name</label>
                            <input type="text" class="form-control form-control-sm" id="customer_name" placeholder="Customer Name">
                        </div>
                        <div class="mb-2">
                            <label>Phone Number</label>
                            <input type="text" class="form-control form-control-sm" id="customer_phone" placeholder="Phone Number">
                        </div>
                        <!-- Divider -->
                        <div class="mb-2">
                            <label for="payment_method">Payment Method</label>
                            <select class="form-control form-control-sm" id="payment_method" name="payment_method">
                                <option value="" selected disabled>Select Payment Method</option>
                            </select>
                        </div>

                        <div class="mb-2">
                            <label>Deadline</label>
                            <input type="date" class="form-control form-control-sm" id="deadline" placeholder="Deadline">
                        </div>
                        <div class="mb-2">
                            <label>Note</label>
                            <textarea class="form-control" id="note" placeholder="Note..."></textarea>
                        </div>
                        <div class="mb-2 text-right">
                            <button class="btn btn-primary w-100">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>