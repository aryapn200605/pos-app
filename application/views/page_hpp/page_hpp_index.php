<?php $this->load->view('page_hpp/page_hpp_js'); ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail Pesanan</h3>
            </div>
            <div class="card-body">
                <form id="form-hpp">
                    <!-- Jasa / Non Jasa as toggle buttons -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Jasa / Non Jasa</label>
                        <div class="col-sm-10">
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-outline-primary active">
                                    <input type="radio" name="jasa" id="jasa" value="jasa" autocomplete="off" checked> Jasa
                                </label>
                                <label class="btn btn-outline-primary">
                                    <input type="radio" name="non_jasa" id="non_jasa" value="non_jasa" autocomplete="off"> Non Jasa
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Quantity -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Quantity</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="qty" name="qty" placeholder="Qty">
                        </div>
                    </div>

                    <!-- Pilih Opsi -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Pilih Opsi</label>
                        <div class="col-sm-10">
                            <div class="row">
                                <?php
                                $options = [
                                    ['id' => 'file', 'title' => 'File*'],
                                    ['id' => 'plat_ctp', 'title' => 'Plat CTP*'],
                                    ['id' => 'bahan', 'title' => 'Bahan Cetak*'],
                                    ['id' => 'cetak', 'title' => 'Cetak*'],
                                    ['id' => 'potong', 'title' => 'Potong'],
                                    ['id' => 'poli', 'title' => 'Poli'],
                                    ['id' => 'laminasi', 'title' => 'Laminasi'],
                                    ['id' => 'embos', 'title' => 'Embos'],
                                    ['id' => 'piso_pon', 'title' => 'Piso Pon'],
                                    ['id' => 'pon', 'title' => 'Pon'],
                                    ['id' => 'finishing', 'title' => 'Finishing'],
                                    ['id' => 'packing', 'title' => 'Packing'],
                                ];

                                foreach ($options as $option):
                                ?>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="<?= $option['id']; ?>" id="<?= $option['id']; ?>" value="true">
                                            <label class="form-check-label" for="<?= $option['id']; ?>"><?= $option['title']; ?></label>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                            </div>
                        </div>
                    </div>

                    <!-- Form File Ukuran Cetak -->
                    <div class="form-group row" id="form-file" style="display: none;">
                        <label class="col-sm-2 col-form-label">File Ukuran Cetak</label>
                        <div class="col-sm-10">
                            <!-- Input pertama dengan lebar setengah -->
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="ukuran_panjang" name="ukuran_panjang" placeholder="File Ukuran Cetak 1">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="ukuran_lebar" name="ukuran_lebar" placeholder="File Ukuran Cetak 2">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Plat CTP -->
                    <div class="form-group row" id="form-plat-ctp" style="display: none;">
                        <label class="col-sm-2 col-form-label">Plat CTP</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="plat" name="plat">
                                <option value="">Pilih Plat CTP</option>
                                <?php foreach (platList() as $value => $label): ?>
                                    <option value="<?= $value ?>"><?= $label ?></option>
                                <?php endforeach; ?>
                            </select>

                        </div>
                    </div>

                    <!-- Form Bahan Cetak -->
                    <div class="form-group row" id="form-bahan" style="display: none;">
                        <label class="col-sm-2 col-form-label">Bahan Cetak</label>
                        <div class="col-sm-10">
                            <div class="row">
                                <!-- 3 Select dropdown -->
                                <div class="col-md-3">
                                    <select class="form-control" name="jenis_kertas" id="jenis_kertas">
                                        <option value="">Pilih Jenis Kertas</option>
                                        <?php foreach (bahanList() as $value => $label): ?>
                                            <option value="<?= $value ?>"><?= $label ?></option>
                                        <?php endforeach; ?>
                                    </select>

                                </div>
                                <div class="col-md-3">
                                    <select class="form-control" id="gramasi" name="gramasi">
                                        <option value="">Pilih Gramasi</option>
                                        <?php foreach (gramasiList() as $value => $label): ?>
                                            <option value="<?= $value ?>"><?= $label ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control" id="ukuran_bahan" name="ukuran_bahan">
                                        <option value="">Pilih Ukuran Bahan</option>
                                        <?php foreach (ukuranBahanList() as $value => $label): ?>
                                            <option value="<?= $value ?>"><?= $label ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" class="form-control" id="form_potong" name="form_potong" placeholder="Bahan/potong" value="0">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Mesin Cetak -->
                    <div class="form-group row" id="form-cetak" style="display: none;">
                        <label class="col-sm-2 col-form-label">Mesin Cetak</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="mesin_cetak" name="mesin_cetak">
                                <option value="">Pilih Mesin Cetak</option>
                                <?php foreach (mesinCetakList() as $value => $label): ?>
                                    <option value="<?= $value ?>"><?= $label ?></option>
                                <?php endforeach; ?>
                            </select>

                        </div>
                    </div>

                    <!-- Form Laminasi -->
                    <div class="form-group row" id="form-laminasi" style="display: none;">
                        <label class="col-sm-2 col-form-label">Laminasi</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="laminasi" name="laminasi">
                                <option value="">Pilih Laminasi</option>
                                <?php foreach (laminasiList() as $value => $label): ?>
                                    <option value="<?= $value ?>"><?= $label ?></option>
                                <?php endforeach; ?>
                            </select>

                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group row">
                        <div class="col-sm-10 offset-sm-2">
                            <button type="button" class="btn btn-primary" id="btn-submit">
                                <i class="fas fa-paper-plane"></i> Submit
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                Detail Produk
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width: 55%;">Deskripsi</th>
                            <th style="width: 15%;">Hpp</th>
                            <th style="width: 15%;">Qty</th>
                            <th style="width: 15%;">Total</th>
                        </tr>
                    </thead>
                    <tbody id="table-hpp-body">
                        <!-- Data akan diisi menggunakan JavaScript -->
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">Jumlah Hpp</td>
                            <td><span id="total-hpp"></span></td>
                        </tr>
                        <tr>
                            <td colspan="3">Harga Jual</td>
                            <td>
                                <input type="text" class="form-control" name="harga_jual" id="harga_jual">
                                <span id="persen">%</span>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>