<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<link rel="stylesheet" href="/assets/css/dashboard/barang/barang.css">

<div class="container-fluid">
    <div class="row text-center justify-content-center my-4">
        <div class="col-sm text-center">
            <p class="text-center text-white fw-bolder brg">Form Add</p>
            <p class="h4 text-secondary mb-4">Stuff</p>
        </div>
    </div>

    <?php if (session()->getFlashdata('message')) : ?>
    <div class="row">
        <div class="col">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('message'); ?>.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="row justify-content-between mx-5">
        <div class="col-auto">
            <img src="/assets/img/default.png" alt="stuff_picture" style="width:300px">
            <div class="mt-4 text-center">
                <form action="/dashboard/stuffs/store/" method="post" class="ms-auto me-auto w-75"
                    enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <label for="gambar" class="mb-2 text-purple">Change Picture</label>
                    <input type="file"
                        class="form-control form-control-sm <?= ($validation->hasError('gambar')) ? 'is-invalid' : ''; ?>"
                        id="gambar" name="gambar" hidden>
                    <?php if ($validation->hasError('gambar')) : ?>
                    <div class="invalid-feedback">
                        <?= $validation->getError('gambar'); ?>
                    </div>
                    <?php endif; ?>
            </div>
        </div>
        <div class="col-8">
            <div class="mb-3">
                <label for="nama_barang" class="mb-2">Name of Stuff</label>
                <input type="text" id="nama_barang" name="nama_barang" autocomplete="off" autofocus
                    value="<?= old('nama_barang'); ?>"
                    class="form-control form-control-sm <?= ($validation->hasError('nama_barang')) ? 'is-invalid' : ''; ?>">
                <?php if ($validation->hasError('nama_barang')) : ?>
                <div class="invalid-feedback">
                    <?= $validation->getError('nama_barang'); ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="spesifikasi" class="mb-2">Specification</label>
                <textarea type="text" id="spesifikasi" name="spesifikasi" autocomplete="off" cols="30" rows="5"
                    class="form-control form-control-sm <?= ($validation->hasError('spesifikasi')) ? 'is-invalid' : ''; ?>"><?= old('spesifikasi'); ?></textarea>
                <?php if ($validation->hasError('spesifikasi')) : ?>
                <div class="invalid-feedback">
                    <?= $validation->getError('spesifikasi'); ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="lokasi" class="mb-2">Room</label>
                <select name="lokasi" id="lokasi"
                    class="form-control form-control-sm select custom-select custom-select-sm <?= ($validation->hasError('lokasi')) ? 'is-invalid' : ''; ?>">
                    <option value="" hidden></option>
                    <?php foreach ($lokasi as $lok) : ?>
                    <option value="<?= $lok['id_lokasi']; ?>">
                        <?= $lok['id_lokasi']; ?>
                    </option>
                    <?php endforeach; ?>
                </select>
                <?php if ($validation->hasError('lokasi')) : ?>
                <div class="invalid-feedback">
                    <?= $validation->getError('lokasi'); ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="kondisi" class="mb-2">Status</label>
                <input type="text" id="kondisi" name="kondisi" autocomplete="off" value="<?= old('kondisi'); ?>"
                    class="form-control form-control-sm <?= ($validation->hasError('kondisi')) ? 'is-invalid' : ''; ?>">
                <?php if ($validation->hasError('kondisi')) : ?>
                <div class="invalid-feedback">
                    <?= $validation->getError('kondisi'); ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="jumlah_barang" class="mb-2">Amount</label>
                <input type="text" id="jumlah_barang" name="jumlah_barang" autocomplete="off"
                    value="<?= old('jumlah_barang'); ?>"
                    class="form-control form-control-sm <?= ($validation->hasError('jumlah_barang')) ? 'is-invalid' : ''; ?>">
                <?php if ($validation->hasError('jumlah_barang')) : ?>
                <div class="invalid-feedback">
                    <?= $validation->getError('jumlah_barang'); ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="sumber" class="mb-2">Contributor</label>
                <select name="sumber" id="sumber"
                    class="form-control form-control-sm select custom-select custom-select-sm <?= ($validation->hasError('sumber')) ? 'is-invalid' : ''; ?>">
                    <option value="" hidden></option>
                    <?php foreach ($sumber as $lok) : ?>
                    <option value="<?= $lok['id_sumber']; ?>">
                        <?= $lok['id_sumber']; ?>
                    </option>
                    <?php endforeach; ?>
                </select>
                <?php if ($validation->hasError('sumber')) : ?>
                <div class="invalid-feedback">
                    <?= $validation->getError('sumber'); ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="supplier" class="mb-2">Supplier</label>
                <select name="supplier" id="supplier"
                    class="form-control form-control-sm select custom-select custom-select-sm <?= ($validation->hasError('supplier')) ? 'is-invalid' : ''; ?>">
                    <option value="" hidden></option>
                    <?php foreach ($supplier as $lok) : ?>
                    <option value="<?= $lok['id_supplier']; ?>">
                        <?= $lok['id_supplier']; ?>
                    </option>
                    <?php endforeach; ?>
                </select>
                <?php if ($validation->hasError('supplier')) : ?>
                <div class="invalid-feedback">
                    <?= $validation->getError('supplier'); ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="mt-4 text-center">
                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>