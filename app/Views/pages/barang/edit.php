<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<link rel="stylesheet" href="/assets/css/dashboard/barang/barang.css">

<div class="container-fluid">
    <div class="row text-center justify-content-center my-4">
        <div class="col-sm text-center">
            <p class="text-center text-white fw-bolder brg">Form Edit</p>
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

    <div class="row mx-5">
        <div class="col-auto">
            <img src="/assets/img/<?= $barang->gambar; ?>" alt="stuff_picture" style="width:300px">
            <div class="mt-4 text-center">
                <form action="/dashboard/stuffs/update/<?= $id; ?>" method="post" class="ms-auto me-auto w-75"
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
        <div class="col-8 ms-5">
            <input type=" text" value="<?= $id; ?>" name="id_barang" hidden>
            <input type="text" value="<?= $barang->gambar; ?>" name="oldGambarName" hidden>
            <div class="mb-3">
                <label for="nama_barang" class="mb-2">Name of Stuff</label>
                <input type="text" id="nama_barang" name="nama_barang" autocomplete="off" autofocus
                    value="<?= (old('nama_barang')) ? old('nama_barang') : $barang->nama_barang; ?>"
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
                    class="form-control form-control-sm <?= ($validation->hasError('spesifikasi')) ? 'is-invalid' : ''; ?>"><?= (old('spesifikasi')) ? old('spesifikasi') : $barang->spesifikasi; ?></textarea>
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
                    <?php foreach ($lokasi as $lok) : ?>
                    <?php if ($lok['id_lokasi'] === $barang->lokasi) : ?>
                    <option value="<?= (old('lokasi')) ? old('lokasi') : $barang->lokasi; ?>" selected>
                        <?= $barang->lokasi; ?>
                    </option>
                    <?php endif; ?>
                    <?php if ($lok['id_lokasi'] !== $barang->lokasi) : ?>
                    <option value="<?= $lok['id_lokasi']; ?>">
                        <?= $lok['id_lokasi']; ?>
                    </option>
                    <?php endif; ?>
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
                <input type="text" id="kondisi" name="kondisi" autocomplete="off"
                    value="<?= (old('kondisi')) ? old('kondisi') : $barang->kondisi; ?>"
                    class="form-control form-control-sm <?= ($validation->hasError('kondisi')) ? 'is-invalid' : ''; ?>">
                <?php if ($validation->hasError('kondisi')) : ?>
                <div class="invalid-feedback">
                    <?= $validation->getError('kondisi'); ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="jumlah_barang" class="mb-2">Quantity</label>
                <input type="text" id="jumlah_barang" name="jumlah_barang" autocomplete="off"
                    value="<?= (old('jumlah_barang')) ? old('jumlah_barang') : $barang->jumlah_barang; ?>"
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
                    <?php if ($lok['id_sumber'] === $barang->sumber_dana) : ?>
                    <option value="<?= (old('sumber_dana')) ? old('sumber_dana') : $barang->sumber_dana; ?>" selected>
                        <?= $barang->sumber_dana; ?>
                    </option>
                    <?php endif; ?>
                    <?php if ($lok['id_sumber'] !== $barang->sumber_dana) : ?>
                    <option value="<?= $lok['id_sumber']; ?>">
                        <?= $lok['id_sumber']; ?>
                    </option>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </select>
                <?php if ($validation->hasError('sumber')) : ?>
                <div class="invalid-feedback">
                    <?= $validation->getError('sumber'); ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="mt-4 text-center">
                <button type="submit" class="btn btn-warning w-100">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>