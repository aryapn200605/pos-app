<script>
    $(document).ready(function() {
        app.setTitle(<?= json_encode($title); ?>);

        const defaultForms = ['customer_name', 'customer_phone', 'grand_total', 'deposits', 'remaining_payment', 'payment_method', 'deadline'];
        const productForm = ['product_name', 'quantity', 'unit_price', 'total_price'];
        let datas = {};
        // let products = [];

        let products = [{
                id: 1,
                product_name: 'Product A',
                quantity: 10,
                unit_price: 15000,
                total_price: 15000 * 10
            },
            {
                id: 2,
                product_name: 'Product B',
                quantity: 5,
                unit_price: 25000,
                total_price: 25000 * 5
            },
            {
                id: 3,
                product_name: 'Product C',
                quantity: 3,
                unit_price: 10000,
                total_price: 10000 * 3
            },
            {
                id: 4,
                product_name: 'Product D',
                quantity: 7,
                unit_price: 18000,
                total_price: 18000 * 7
            },
            {
                id: 5,
                product_name: 'Product E',
                quantity: 8,
                unit_price: 22000,
                total_price: 22000 * 8
            }
        ];

        $.ajax({
            url: baseURL + '/PaymentMethod/getAllPaymentMethod',
            type: "GET",
            success: (response) => {
                var res = JSON.parse(response)

                if (res.result) {
                    var option = '<option value="" selected disabled>Select Payment Method</option>'

                    res.data.forEach(function(item) {
                        console.log(item);
                        option += '<option id="pym-' + item.id + '" value="' + item.id + '">' + item.name + '</option>';
                    });

                    $('#payment_method').html(option)
                } else {
                    showAlert('warning', 'Payment method failed to load, please contact support.');
                }
            },
            error: (xhr, status, error) => {
                console.error(`Failed to get payment method: ${error}`);
            }
        });

        $('#form-cashier').on('submit', function(event) {
            event.preventDefault();

            const formData = checkForm(defaultForms);
            if (!formData) {
                return;
            }
            Object.assign(datas, formData);

            if (products.length === 0) {
                showAlert('error', `Empty Product`);
                return;
            }

            datas.products = products;
            datas.note = $('#note').val();

            $.ajax({
                url: baseURL + '/cashier/addTransaction',
                type: "POST",
                data: datas,
                success: (response) => {
                    var res = JSON.parse(response)

                    if (res.result) {
                        alertify.alert(res.message, function() {
                            app.goToModule('/Transaction/getDetail?tb_id=' + res.data)
                        })
                    }
                },
                error: (xhr, status, error) => {
                    console.error(`Failed to add transaction: ${error}`);
                }
            });

        });

        // Onclick Button Add/Edit Product
        $('#btn-add').on('click', function() {
            let productData = checkForm(productForm);
            const fromCategory = $('#form_category').val()

            if (!productData) {
                return
            }

            if ($('#total_price').val() < 1) {
                showAlert('error', 'Total value is 0')
                return
            }

            if (fromCategory === 'create') {
                productData.id = Date.now();
                if (productData) {
                    products.push(productData);
                }
            } else if (fromCategory === 'edit') {
                const productId = $('#product_id').val();
                const productIndex = products.findIndex(product => product.id == productId);
                if (productIndex !== -1) {
                    productData.id = productId
                    products[productIndex] = productData;
                }
            }
            reloadTable()
            clearProductForm()
        });

        // Onclick Button Edit Row
        $('#table-product').on('click', '.btn-edit-product', function() {
            const productId = $(this).data('id');
            const productIndex = products.findIndex(product => product.id == productId);

            if (productIndex !== -1) {
                const product = products[productIndex];
                for (let form of productForm) {
                    $(`#${form}`).val(product[form]);
                }
                $('#product_id').val(product.id)
                changeForm(2)
                priceFormater()
            } else {
                console.log('Product not found');
            }
        });

        // Onclick Button Delete Product Row
        $('#table-product').on('click', '.btn-delete-product', function() {
            const productId = $(this).data('id');
            const productIndex = products.findIndex(product => product.id == productId);

            if (productIndex !== -1) {
                products.splice(productIndex, 1);
                reloadTable();
            }
        });

        // Onclick Button Clear Product Form
        $('#btn-clear').on('click', clearProductForm);

        // Onchange Input (quantity, unit_price, total_price) Form 
        $('#quantity, #unit_price, #total_price').on('input', function() {
            const quantity = $('#quantity').val() ? $('#quantity').val() : 0;
            const unitPrice = $('#unit_price').val() ? $('#unit_price').val() : 0;
            const totalPrice = $('#total_price').val() ? $('#total_price').val() : 0;

            if (this.id === 'quantity' || this.id === 'unit_price') {
                $('#total_price').val(parseInt(quantity * unitPrice));
            } else if (this.id === 'total_price') {
                $('#unit_price').val(parseInt(totalPrice / quantity));
            }
            priceFormater()
        })

        // Onchange Input (remaining_payment) Form
        $('#deposits').on('input', countRemainingPayment);

        function checkForm(forms) {
            let formData = {};
            for (let form of forms) {
                const field = $(`#${form}`);
                const value = field.val();
                const placeholder = field.attr('placeholder') || 'field';

                if (!value || value.trim() === '') {
                    showAlert('error', `Empty ${placeholder}`);
                    return false;
                }

                formData[form] = value.trim();
            }
            return formData;
        }

        function reloadTable() {
            const table = $('#table-product tbody');
            let grandTotal = 0
            table.empty();

            products.forEach((item, index) => {
                const row = `
                    <tr class="text-center">
                        <td>${index + 1}</td>
                        <td class="text-left">${item.product_name}</td>
                        <td>${item.quantity}</td>
                        <td>${numberFormater(item.unit_price)}</td>
                        <td>${numberFormater(item.total_price)}</td>
                        <td>
                            <button class="btn btn-sm btn-info btn-edit-product" data-id="${item.id}"><i class="nav-icon fas fa-pen"></i></button>
                            <button class="btn btn-sm btn-danger btn-delete-product" data-id="${item.id}"><i class="nav-icon fas fa-trash"></i></button>
                        </td>
                    </tr>
                `;
                table.append(row);
                grandTotal += parseInt(item.total_price)
            });

            $('#grand_total').val(grandTotal);
            countRemainingPayment()
        }

        function countRemainingPayment() {
            const grandTotal = parseFloat($('#grand_total').val()) || 0;
            const deposits = parseFloat($('#deposits').val()) || 0;
            let remainingPayment = grandTotal - deposits;

            if (remainingPayment < 0) {
                remainingPayment = 0
                $('#deposits').val(grandTotal);
            }
            $('#remaining_payment').val(remainingPayment);
            priceFormater();
        }

        // 1 = Create, 2 = Edit
        function changeForm(type) {
            if (type === 1) {
                $('#warn-edit').addClass('d-none');
                $('#warn-create').removeClass('d-none');
                $('#form_category').val("create")
            } else if (type === 2) {
                $('#warn-create').addClass('d-none');
                $('#warn-edit').removeClass('d-none');
                $('#form_category').val("edit")
            }
        }

        function clearProductForm() {
            for (let form of productForm) {
                $(`#${form}`).val(null);
            }
            priceFormater()
            changeForm(1)
        }

        function numberFormater(val) {
            return 'Rp. ' + val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        }

        function priceFormater() {
            const unitPrice = $('#unit_price').val();
            const totalPrice = $('#total_price').val();
            const grandTotal = $('#grand_total').val();
            const deposits = $('#deposits').val();
            const remainingPayment = $('#remaining_payment').val();

            $('#unit-price-idr').html(numberFormater(unitPrice && !isNaN(unitPrice) ? unitPrice : 0));
            $('#total-price-idr').html(numberFormater(totalPrice && !isNaN(totalPrice) ? totalPrice : 0));
            $('#grand-total-idr').html(numberFormater(grandTotal && !isNaN(grandTotal) ? grandTotal : 0));
            $('#deposits-idr').html(numberFormater(deposits && !isNaN(deposits) ? deposits : 0));
            $('#remaining-payment-idr').html(numberFormater(remainingPayment && !isNaN(remainingPayment) ? remainingPayment : 0));
        }

        reloadTable()
    })
</script>