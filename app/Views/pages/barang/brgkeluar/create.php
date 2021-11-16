<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<link rel="stylesheet" href="/assets/css/dashboard/barang/barang.css">

<div class="container-fluid">
    <div class="row text-center justify-content-center my-4">
        <div class="col-sm text-center">
            <p class="text-center text-white fw-bolder brg">Form Add</p>
            <p class="h4 text-secondary mb-4">Output</p>
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

    <form action="/dashboard/stuffs/output/store/" method="post" class="ms-auto me-auto w-50">
        <?= csrf_field(); ?>
        <div class="mb-3">
            <label for="id_barang" class="mb-2">CODE Stuffs</label>
            <select name="id_barang" id="id_barang"
                class="form-control form-control-sm select custom-select custom-select-sm <?= ($validation->hasError('id_barang')) ? 'is-invalid' : ''; ?>">
                <option value="" hidden></option>
                <?php foreach ($id_barang as $lok) : ?>
                <option value="<?= $lok['id']; ?>">
                    <?= $lok['id']; ?>
                </option>
                <?php endforeach; ?>
            </select>
            <?php if ($validation->hasError('id_barang')) : ?>
            <div class="invalid-feedback">
                <?= $validation->getError('id_barang'); ?>
            </div>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="date" class="mb-2">Date</label>
            <input type="date" id="date" name="date" value="<?= date("Y-m-d"); ?>" class="form-control form-control-sm"
                readonly>
        </div>
        <div class="mb-3">
            <label for="jml_keluar" class="mb-2">Output</label>
            <input type="text" id="jml_keluar" name="jml_keluar" autocomplete="off" value="<?= old('jml_keluar'); ?>"
                class="form-control form-control-sm <?= ($validation->hasError('jml_keluar')) ? 'is-invalid' : ''; ?>">
            <?php if ($validation->hasError('jml_keluar')) : ?>
            <div class="invalid-feedback">
                <?= $validation->getError('jml_keluar'); ?>
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
<?= $this->endSection(); ?>