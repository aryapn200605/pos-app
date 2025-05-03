<script>
    $(document).ready(function() {
        app.setTitle(<?= json_encode($title); ?>);

        var order = {};

        function toggleForm(checkboxId, formId) {
            $(checkboxId).on('change', function() {
                if ($(this).is(':checked')) {
                    $(formId).show();
                } else {
                    $(formId).hide();
                }
            });
        }

        toggleForm('#file', '#form-file');
        toggleForm('#plat_ctp', '#form-plat-ctp');
        toggleForm('#bahan', '#form-bahan');
        toggleForm('#cetak', '#form-cetak');
        toggleForm('#laminasi', '#form-laminasi');

        function calculatePotong() {
            var ukuranPanjang = parseFloat($('#ukuran_panjang').val());
            var ukuranLebar = parseFloat($('#ukuran_lebar').val());
            var ukuranBahan = $('#ukuran_bahan').val();

            if (ukuranBahan) {
                var ukuranArray = ukuranBahan.split(',');
                var panjangBahan = parseFloat(ukuranArray[0]);
                var lebarBahan = parseFloat(ukuranArray[1]);
            }

            if (!isNaN(ukuranPanjang) && !isNaN(ukuranLebar) && !isNaN(panjangBahan) && !isNaN(lebarBahan) && ukuranPanjang > 0 && ukuranLebar > 0 && panjangBahan > 0 && lebarBahan > 0) {
                var totalPotong = (panjangBahan * lebarBahan) / (ukuranPanjang * ukuranLebar);
                var totalPotong = Math.floor(totalPotong);
                console.log(totalPotong);
                $('#form_potong').val(totalPotong);
            }
        }

        $('#ukuran_panjang, #ukuran_lebar, #ukuran_bahan').on('change', function() {
            calculatePotong();
        });

        $('#btn-submit').on('click', function() {
            var formData = new FormData($('#form-hpp')[0]);

            order = Object.fromEntries(formData.entries());

            console.log(order);

            if (!order.file || !order.plat_ctp || !order.bahan || !order.cetak) {
                showAlert('error', 'Pilih Opsi Required (*)!');
                return;
            }
            if (!order.qty) {
                showAlert('error', 'Isi Quantity!');
                return;
            }

            if (!order.ukuran_panjang) {
                showAlert('error', 'Isi Ukuran Panjang!');
                return;
            }

            if (!order.ukuran_lebar) {
                showAlert('error', 'Isi Ukuran Lebar!');
                return;
            }

            if (!order.plat) {
                showAlert('error', 'Pilih Jumlah Plat!');
                return;
            }

            if (!order.jenis_kertas || !order.gramasi || !order.ukuran_bahan || !order.form_potong) {
                showAlert('error', 'Isi dan Pilih Bahan Cetak!');
                return;
            }

            createTable();
        });

        window.tableList = [];
        window.totalHpp = 0;

        function createTable() {
            const $tbody = $('#table-hpp-body').empty();
            const qty = +order.qty;
            const panjang = +order.ukuran_panjang;
            const lebar = +order.ukuran_lebar;
            const plat = +order.plat;
            const jenisKertas = order.jenis_kertas;
            const gramasi = +order.gramasi;
            const formPotong = order.form_potong;

            const [ukuranBahanX, ukuranBahanY] = order.ukuran_bahan.split(',').map(Number);
            const [mesinNama, mesinMax, mesinHargaAwal, mesinHargaLbr] = order.mesin_cetak.split('{}').map(val => isNaN(val) ? val : +val);
            const hargaMesin = qty <= mesinMax ? mesinHargaAwal : mesinHargaAwal + (qty - mesinMax) * mesinHargaLbr;

            tableList = [{
                    desc: `File ${panjang} x ${lebar}cm ${qty}lbr`,
                    hpp: 0,
                    qty: 1
                },
                {
                    desc: `Plat CTP ${plat}`,
                    hpp: 0,
                    qty: plat
                },
                {
                    desc: `Bahan Cetak ${jenisKertas} ${ukuranBahanX} x ${ukuranBahanY}cm ${gramasi}GSM ${formPotong}Cut`,
                    hpp: 0,
                    qty: 1
                },
                {
                    desc: `Cetak ${mesinNama} ${qty}lbr`,
                    hpp: hargaMesin,
                    qty: 1
                },
            ];

            const optionalItems = [{
                    key: 'potong',
                    desc: 'Potong',
                    qty
                },
                {
                    key: 'poli',
                    desc: 'Poli',
                    qty
                },
                {
                    key: 'piso_pon',
                    desc: 'Piso Pon',
                    qty: 1
                },
                {
                    key: 'finishing',
                    desc: 'Finishing',
                    qty
                },
                {
                    key: 'packing',
                    desc: 'Packing',
                    qty: 1
                },
                {
                    key: 'embos',
                    desc: 'Embos',
                    qty: 1
                },
            ];

            optionalItems.forEach(({
                key,
                desc,
                qty
            }) => {
                if (order[key]) tableList.push({
                    desc,
                    hpp: 0,
                    qty
                });
            });

            if (order.laminasi) {
                const [jenis, maxQty, hargaAwal, hargaLbr] = order.laminasi.split('{}').map(val => isNaN(val) ? val : +val);
                const hargaLaminasi = qty <= maxQty ? hargaAwal : hargaAwal + (qty - maxQty) * hargaLbr;
                tableList.push({
                    desc: `Laminasi ${jenis} ${ukuranBahanX} x ${ukuranBahanY}cm ${qty}lbr`,
                    hpp: hargaLaminasi,
                    qty: 1
                });
            }

            if (order.pon) {
                const hppPon = qty < 1000 ? 70000 : 70000 + (qty - 1000) * 35;
                tableList.push({
                    desc: `Pon ${qty}lbr`,
                    hpp: hppPon,
                    qty: 1
                });
            }

            tableList.forEach((item, i) => {
                const total = item.hpp * item.qty;
                const $row = $(`
            <tr>
                <td><span>${item.desc}</span></td>
                <td><input type="text" class="form-control form-control-sm text-end" value="${item.hpp}" id="hpp-${i}"></td>
                <td><input type="text" class="form-control form-control-sm text-end" value="${item.qty}" id="qty-${i}"></td>
                <td><span class="text-end d-block" id="total-${i}">${total}</span></td>
            </tr>
        `);
                $row.find(`#hpp-${i}, #qty-${i}`).on('change', () => updateTotal(i));
                $tbody.append($row);
            });

            updateAllTotals();
        }

        function updateTotal(index) {
            const hpp = +$(`#hpp-${index}`).val() || 0;
            const qty = +$(`#qty-${index}`).val() || 0;
            const total = hpp * qty;

            tableList[index].hpp = hpp;
            tableList[index].qty = qty;
            $(`#total-${index}`).text(total);

            updateAllTotals();
        }

        function updateAllTotals() {
            totalHpp = tableList.reduce((sum, item) => sum + item.hpp * item.qty, 0);

            $('#total-hpp').text(totalHpp.toLocaleString());
        }

        $('#harga_jual').on('change', function() {
            hargaJual = $(this).val() || 0;
            const profit = hargaJual - totalHpp;
            const profitPersen = (profit / totalHpp) * 100;
            $('#persen').val(profitPersen.toFixed(2) + '%');
        });
    })
</script>