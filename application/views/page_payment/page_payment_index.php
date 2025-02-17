<?php $this->load->view('page_payment/page_payment_js');?>
<div class="input-group">
    <input type="hidden" name="" id="pym-info" value="create">
    <input type="hidden" name="" id="pym-id">
    <input type="text" name="payment_method" placeholder="Payment Name" class="form-control" id="payment_method">
    <span class="input-group-append" id="btn-pym">
        <button type="button" class="btn btn-success" id="btn-add-pym">Add</button>
    </span>
</div>
<table id="tbl-payment-method" class="table table-striped table-sm text-center">
    <thead>
        <tr>
            <th style="width: 70%;">Name</th>
            <th style="width: 30%;">Action</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>