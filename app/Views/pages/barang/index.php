<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<link rel="stylesheet" href="/assets/css/dashboard/barang/barang.css">

<div class="container-fluid">
    <div class="row text-center justify-content-center my-4">
        <div class="col-sm text-center">
            <p class="text-center text-white fw-bolder mb-4 brg">Stuffs</p>
            <div class="text-center ms-auto me-auto w-25">
                <form action="" method="post">
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-danger text-white" id="basic-addon1"><i
                                class="fas fa-search"></i></span>
                        <input type="search" name="keyword" class="form-control form-control-md"
                            placeholder="Name Stuffs" autocomplete="off">
                    </div>
                </form>
            </div>
            <div class="text-center">
                <a href="/dashboard/stuffs/create" class="btn btn-primary w-25">Add Stuffs</a>
            </div>
        </div>
    </div>

    <?php if (session()->getFlashdata('message')) : ?>
    <div class="row mt-3 me-auto ms-auto">
        <div class="col p-0 m-0">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('message'); ?>.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="row justify-content-center my-5">
        <?php foreach ($barang as $brg) : ?>
        <div class="col-auto">
            <div class="card shadow bg-dark text-white" style="width: 21rem;">
                <img src="/assets/img/<?= $brg['gambar']; ?>" class="card-img-top p-2 brg-img" alt="...">
                <div class="card-body">
                    <div class="row justify-content-between mb-3">
                        <div class="col-sm">
                            <h5 class="card-title"><?= $brg['nama_barang']; ?></h5>
                            <h5 class="small mb-3"><?= $brg['id_barang']; ?></h5>
                            <p class="card-text"><?= $brg['spesifikasi'] ?>.</p>
                        </div>
                        <div class="col-auto">
                            <a href="/dashboard/stuffs/edit/<?= $brg['id_barang']; ?>"
                                class="btn btn-outline-warning"><i class="fas fa-edit"></i></a>
                            <form action="/dashboard/stuffs/delete/<?= $brg['id_barang']; ?>" method="post"
                                class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="text" hidden name="_method" value="DELETE">
                                <button type="submit" class="btn btn-outline-danger"
                                    onclick="return confirm('Are you sure?');"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </div>
                    <a href="/dashboard/stuffs/detail/<?= $brg['id_barang']; ?>" class="btn btn-purple w-100">Go
                        Detail</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <?php if ($barang > 3) : ?>
    <div class="row justify-content-center mt-5">
        <div class="col-auto">
            <?= $pager->links('barang', 'bootstrap'); ?>
        </div>
    </div>
    <?php endif; ?>
</div>
<?= $this->endSection(); ?>