 <form name="modal_form1" method="post" action="<?php echo base_url(); ?>produk/simpan" enctype="multipart/form-data">
        <div id="modal-form" class="modal hide" tabindex="-1">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="blue bigger">Tambah Produk</h4>
        </div>

        <div class="modal-body">
            <div class="span5">

                <div class="control-group">
                    <label class="control-label">No Produk</label>
                    <div class="controls">
                        <input type="text" class="span5" name="no_produk"
                               value="<?= $nomor_otomatis ?>" readonly>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">Nama Produk</label>
                    <div class="controls">
                        <input type="text" class="span5" name="nama_produk" required>
                    </div>
                </div>

               <div class="control-group">
                    <label class="control-label">Kategori</label>
                    <div class="controls">
                        <select name="nama_kategori_produk" class="span5" required>
                            <option value="">-- Pilih Kategori --</option>
                            <?php foreach ($kategori as $k) : ?>
                                <option value="<?= $k->nama_kategori_produk ?>">
                                    <?= $k->nama_kategori_produk ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>


               <div class="control-group">
                    <label class="control-label">Merk</label>
                    <div class="controls">
                        <select name="nama_merk_produk" class="span5" required>
                            <option value="">-- Pilih Merk --</option>
                            <?php foreach ($merk as $m) : ?>
                                <option value="<?= $m->nama_merk_produk ?>">
                                    <?= $m->nama_merk_produk ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>


              <div class="control-group">
                    <label class="control-label">Ukuran</label>
                    <div class="controls">
                        <select name="nama_ukuran_produk" class="span5" required>
                            <option value="">-- Pilih Ukuran --</option>
                            <?php foreach ($ukuran as $u) : ?>
                                <option value="<?= $u->nama_ukuran_produk ?>">
                                    <?= $u->nama_ukuran_produk ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">Harga Beli</label>
                    <div class="controls">
                        <input type="text" class="span5 rupiah" name="harga_beli" required>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">Harga Jual</label>
                    <div class="controls">
                        <input type="text" class="span5 rupiah" name="harga_jual" required>
                    </div>
                </div>


                <div class="control-group">
                    <label class="control-label">Stok</label>
                    <div class="controls">
                        <input type="number" class="span5" name="stok">
                    </div>
                </div>

            </div>
        </div>

            <div class="modal-footer">
                <button class="btn btn-small" data-dismiss="modal">
                    <i class="icon-remove"></i> Batal
                </button>

                <button class="btn btn-small btn-primary" type="submit" name="btn_simpan" onclick="return cek_inputan();">
                    <i class="icon-ok"></i> Simpan
                </button>
            </div>
        </div>
    </form>