<script>
    $(document).ready(function() {
        app.setTitle(<?= json_encode($title); ?>);

        const table = new DataTable('#transaction-table', {
            ajax: {
                url: baseURL + '/Transaction/getTransaction',
                type: 'GET',
                data: function(d) {
                    return $.extend({}, d, {
                        order_id: $('#order_id').val() || '',
                        customer_name: $('#customer_name').val() || '',
                        phone_number: $('#phone_number').val() || '',
                        payment_method: $('#payment_method').val() || '',
                        deadline: $('#deadline').val() || '',
                        transaction_date: $('#transaction_date').val() || '',
                        progress_status: $('#progress_status').val() || '',
                        payment_status: $('#payment_status').val() || '',
                        select_cashier: $('#select_cashier').val() || '',
                        item: $('#item').val() || '',
                    });
                },
                dataSrc: function(json) {
                    console.log(json.data)
                    return Object.values(json.data)
                }
            },
            searching: false,
            serverSide: true,
            processing: true,
            columns: [{
                    data: 'customer_name',
                    title: 'Customer Name',
                    className: 'text-center',
                },
                {
                    data: 'customer_phone',
                    title: 'Phone Number',
                    className: 'text-center',
                },
                {
                    data: 'order_id',
                    title: 'Order ID',
                    className: 'text-center',
                },
                {
                    data: 'deadline',
                    title: 'Deadline',
                    className: 'text-center',
                },
                {
                    data: 'created_at',
                    title: 'Date',
                    className: 'text-center',
                },
                {
                    data: 'cashier',
                    title: 'Cashier',
                    className: 'text-center',
                },
                {
                    data: null,
                    title: 'Payment Status',
                    className: 'text-center',
                    render: function(data, type, row) {
                        let status = false;
                        if (parseInt(row.total_paid) >= parseInt(row.grand_price)) {
                            status = true;
                        }
                        return `<span class="badge badge-${status ? 'success' : 'danger'}">${status ? 'Paid' : 'Unpaid'}</span>`;
                    }
                },
                {
                    data: null,
                    title: 'Progress Status',
                    className: 'text-center',
                    render: function(data, type, row) {
                        return `<span class="badge badge-${badgeProgressStatus(row.status)}">${row.status}</span>`;
                    }
                },
                {
                    data: null,
                    title: 'Action',
                    className: 'text-center',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `<button class="btn btn-primary btn-sm btn-detail" data-id="${row.tb_id}">Detail</button>`;
                    }
                }
            ],
        });

        $('#btn-search').on('click', function() {
            table.ajax.reload()
        })

        $('#btn-clear').on('click', function() {
            app.goToModule('/Transaction')
        })

        $('#transaction-table').on('click', '.btn-detail', function() {
            const id = $(this).data('id');
            app.goToModule(`/Transaction/getDetail?tb_id=${id}`);
        });

        $('#btn-pdf').on('click', function() {
            const id = $('#detail_id').val();
            window.open(baseURL + '/Transaction/showPdf?tb_id=' + id, '_blank');
        });

        $('#btn-print').on('click', function() {
            const id = $('#detail_id').val();
            window.open(baseURL + '/Transaction/print?tb_id=' + id, '_blank');
        });

        $('#add_payment_amount').on('input', function() {
            const amount = $(this).val();
            const total_paid = $('#total_paid').val();
            const grand_price = $('#grand_price').val();

            const result = parseInt(grand_price) - parseInt(total_paid);

            if (parseInt(amount) > parseInt(grand_price) - parseInt(total_paid)) {
                $(this).val(result);
                $('#payment-amount-idr').html(numberFormater(result));
            } else {
                $('#payment-amount-idr').html(numberFormater(amount));
            }

        });

        $('#btn-add-payment').on('click', function() {
            const payment_method = $('#payment_method').val();
            const amount = $('#add_payment_amount').val();
            const id = $('#detail_id').val();

            if (payment_method == '' || amount == '') {
                showAlert('warning', 'Please fill all field');
                return;
            }

            alertify.confirm(
                'Add Payment Confirm', `Are you sure add this payment?`,
                function() {
                    $('#modal-add-payment').modal('hide');

                    $.ajax({
                        url: baseURL + "/Transaction/addPayment",
                        type: "POST",
                        data: {
                            tb_id: id,
                            payment_method: payment_method,
                            amount: amount
                        },
                        success: (response) => {
                            const res = JSON.parse(response)

                            if (res.success) {
                                app.goToModule('/Transaction/getDetail?tb_id=' + id)
                            } else {
                                showAlert('error', res.message)
                            }
                        }
                    })
                },
                function() {});

        });

        $('#btn-change-status').on('click', function() {
            const id = $('#detail_id').val();
            const status = $('#progress_status').val();

            if (status == '') {
                showAlert('warning', 'Please fill all field');
                return;
            }

            alertify.confirm(
                'Add Payment Confirm', `Are you sure change this progress?`,
                function() {
                    $('#modal-change-status').modal('hide');

                    $.ajax({
                        url: baseURL + "/ProgressStatus/changeStatus",
                        type: "POST",
                        data: {
                            tb_id: id,
                            status: status
                        },
                        success: (response) => {
                            const res = JSON.parse(response)

                            if (res.success) {
                                app.goToModule('/Transaction/getDetail?tb_id=' + id)
                            } else {
                                showAlert('error', res.message)
                            }
                        }
                    })
                },
                function() {});

        });

        $('#btn-delete').on('click', function() {
            const id = $('#detail_id').val();
            alertify.confirm(
                'Deletion Confirm', 'Are you sure delete this transaction',
                function() {
                    $.ajax({
                        url: baseURL + "/Transaction/deleteTransaction",
                        type: "GET",
                        data: {
                            id: id
                        },
                        success: (response) => {
                            const res = JSON.parse(response)

                            if (res.success) {
                                app.goToModule('/Transaction')
                            } else {
                                showAlert('error', res.message)
                            }
                        }
                    })
                },
                function() {});
        });

        function fetchData(url, elementId, defaultText, prefix) {
            $.ajax({
                url: baseURL + url,
                type: "GET",
                success: (response) => {
                    var res = JSON.parse(response);

                    if (res.result) {
                        var option = `<option value="" selected disabled>${defaultText}</option>`;

                        res.data.forEach((item) => {
                            option += `<option id="${prefix}-${item.id}" value="${item.id}">${item.name}</option>`;
                        });

                        $(elementId).html(option);
                    } else {
                        showAlert('warning', `${defaultText} failed to load, please contact support.`);
                    }
                },
                error: (xhr, status, error) => {
                    console.error(`Failed to get ${defaultText}: ${error}`);
                }
            });
        }

        fetchData('/PaymentMethod/getAllPaymentMethod', '#payment_method', 'Select Payment Method', 'pym');
        fetchData('/ProgressStatus/getAllProgressStatus', '#progress_status', 'Select Progress Status', 'prg');
        fetchData('/Users/getAllCashier', '#select_cashier', 'Select Cashier', 'csh');


        function badgeProgressStatus(status) {
            console.log(status)
            switch (status) {
                case 'Done':
                    return 'success';
                case 'Cancel':
                    return 'danger';
                default:
                    return 'warning';
            }
        }

        function numberFormater(val) {
            return 'Rp. ' + val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        }

    })
</script>