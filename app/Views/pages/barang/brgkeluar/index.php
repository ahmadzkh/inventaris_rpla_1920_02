<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<link rel="stylesheet" href="/assets/css/dashboard/barang/barang.css">

<div class="container-fluid">
    <div class="row text-center justify-content-center my-4">
        <div class="col-sm text-center">
            <p class="text-center text-white fw-bolder mb-4 brg">Stuffs OUT</p>
            <div class="text-center ms-auto me-auto w-25">
                <form action="" method="post">
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-danger text-white" id="basic-addon1"><i
                                class="fas fa-search"></i></span>
                        <input type="search" name="keyword" class="form-control form-control-md"
                            placeholder="CODE Stuffs" autocomplete="off">
                    </div>
                </form>
            </div>
            <div class="text-center">
                <a href="/dashboard/stuffs/output/create" class="btn btn-primary w-25">Add Output</a>
            </div>
        </div>
    </div>

    <?php if (session()->getFlashdata('pesan')) : ?>
    <div class="row mt-3 me-auto ms-auto">
        <div class="col p-0 m-0">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('pesan'); ?>.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <table class="table table-dark text-white">
        <thead>
            <tr>
                <th>CODE Stuffs</th>
                <th>Date</th>
                <th>Output</th>
                <th>Supplier</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($out as $o) : ?>
            <tr>
                <td><?= $o['id_barang']; ?></td>
                <td><?= $o['tgl_keluar']; ?></td>
                <td><?= $o['jml_keluar']; ?></td>
                <td><?= $o['supplier']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php if ($out >= 10) : ?>
    <div class="row justify-content-center mt-5">
        <div class="col-auto">
            <?= $pager->links('barang_keluar', 'bootstrap'); ?>
        </div>
    </div>
    <?php endif; ?>
</div>
<?= $this->endSection(); ?>