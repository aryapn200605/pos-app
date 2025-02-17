<script>
    $(document).ready(function() {

        // Handle Add and Edit actions
        $('#btn-add-pym').on('click', function() {
            var name = $('#payment_method').val();
            var info = $('#pym-info').val();

            if (!name) {
                showAlert('error', 'Field cannot be Empty');
                return;
            }

            if (info == 'create') {
                $.ajax({
                    url: baseURL + '/PaymentMethod/addPaymentMethod',
                    method: 'POST',
                    data: {
                        name: name,
                    },
                    success: function(response) {
                        if (response.result) {
                            showAlert('success', response.message);
                        } else {
                            showAlert('error', response.message);
                        }
                    },
                });
            } else if (info == 'edit') {
                $.ajax({
                    url: baseURL + '/PaymentMethod/editPaymentMethod',
                    method: 'POST',
                    data: {
                        name: name,
                        id: $('#pym_id').val(),
                    },
                    success: function(response) {
                        if (response.result) {
                            showAlert('success', response.message);
                        } else {
                            showAlert('error', response.message);
                        }
                    },
                });
            }
            loadTablePaymentMethod();
        });

        // Handle Edit button click
        $('#tbl-payment-method').on('click', '.btn-edit-pym', function() {
            var info = $('#pym-info');
            var id = $('#pym-id');

            // Toggle between Edit and Add states
            if ($('#btn-pym #btn-clear-pym').length > 0) {
                $('#btn-add-pym')
                    .html('Add')
                    .removeClass('btn-warning')
                    .addClass('btn-success');
                $('#btn-pym #btn-clear-pym').remove();
                info.val('create');
            } else {
                $('#btn-add-pym')
                    .html('Edit')
                    .removeClass('btn-success')
                    .addClass('btn-warning');

                var newButton = $('<button>', {
                    type: 'button',
                    class: 'btn btn-danger',
                    text: 'Cancel',
                    id: 'btn-clear-pym',
                });

                $('#payment_method').val()

                $('#btn-pym').append(newButton);
                info.val('edit');
            }
        });

        // Handle Cancel (Clear) button click
        $('#btn-pym').on('click', '#btn-clear-pym', function() {
            $('#btn-add-pym')
                .html('Add')
                .removeClass('btn-warning')
                .addClass('btn-success');
            $('#btn-clear-pym').remove();
        });

        // Load payment method data into the table
        function loadTablePaymentMethod() {
            $.ajax({
                url: baseURL + '/PaymentMethod/getAllPaymentMethod',
                method: 'GET',
                success: function(response) {
                    var res = JSON.parse(response);
                    const table = $('#tbl-payment-method tbody');
                    table.empty();

                    let body = '';

                    if (!res.result) {
                        return;
                    }

                    if (res.data.length > 0) {
                        res.data.forEach((item, i) => {
                            body += '<tr>';
                            body += `<td class="text-left">${item.name}</td>`;
                            body += `<td>
                                        <button class="btn btn-sm btn-info mr-1 btn-edit-pym" id="${item.id}">
                                            <i class="nav-icon fas fa-pen"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger btn-delete-pym" data-id="${item.id}">
                                            <i class="nav-icon fas fa-trash"></i>
                                        </button>
                                      </td>`;
                            body += '</tr>';
                        });
                    } else {
                        body += '<tr><td colspan="100%">No data available</td></tr>';
                    }
                    table.append(body);
                },
            });
        }

        // Initial load of payment methods
        loadTablePaymentMethod();
    });
</script>
