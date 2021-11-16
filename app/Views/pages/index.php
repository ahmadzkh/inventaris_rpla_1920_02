<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<link rel="stylesheet" href="/assets/css/dashboard/index.css">
<div class="container-fluid">
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
    <div class="card bg-secondary new p-2">
        <div class="card-body stuff">
            <p class="h2 fw-bold text-white">New Stuff</p>
            <p class="card-subtitle text-danger">Code Stuff</p>
        </div>
    </div>
    <div class="row row-one">
        <div class="col-xl col-md-6 mb-3">
            <div class="card bg-danger text-white shadow-sm">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs title mb-1">
                                Stuffs
                            </div>
                            <div class="h5 mb-0 fw-bold">
                                <?= $countStock; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-boxes iconic"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl col-md-6 mb-3">
            <div class="card bg-danger text-white shadow-sm">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs title mb-1">
                                Output
                            </div>
                            <div class="h5 mb-0 fw-bold">
                                <?= $countOutput[0]['output']; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-truck-loading iconic"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl col-md-6 mb-3">
            <div class="card bg-danger text-white shadow-sm">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs title mb-1">
                                All Stock
                            </div>
                            <div class="h5 mb-0 fw-bold">
                                <?= $countStock; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-boxes iconic"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col">
            <h3 class="mb-3 text-white"><span class="text-danger">#</span> Tables</h3>
        </div>
    </div>

    <div class="row justify-content-around">
        <div class="col-auto">
            <div class="card shadow bg-dark text-white" style="width: 24rem;">
                <div class="img-height">
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm">
                            <a href="/dashboard/stuffs"
                                class="h2 card-title fw-bold text-decoration-none text-white">Stuffs</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-auto">
            <div class="card shadow bg-dark text-white" style="width: 24rem;">
                <div class="img-height">
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm">
                            <a href="/dashboard/stuffs/output"
                                class="h2 card-title fw-bold text-decoration-none text-white">Output</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-auto">
            <div class="card shadow bg-dark text-white" style="width: 24rem;">
                <div class="img-height">
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm">
                            <a href="/dashboard/stuffs/stock"
                                class="h2 card-title fw-bold text-decoration-none text-white">Stock</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col">
            <h3 class="mb-3 text-white"><span class="text-danger">#</span> Lastest Stuffs IN</h3>
        </div>
    </div>

    <?php foreach ($in as $trans) : ?>
    <div class="row mb-3">
        <div class="col-sm">
            <div class="card bg-secondary">
                <div class="card-body">
                    <div class="row">
                        <div class="col-auto">
                            <div class="circle bg-danger"></div>
                        </div>
                        <div class="col-sm">
                            <h5 class="fw-bold card-title"><?= $trans['id_barang'] ?></h5>
                            <p class="card-subtitle">Date : <?= $trans['tgl_masuk'] ?> | Amount :
                                <?= $trans['jml_masuk']; ?> | Supplier : <?= $trans['supplier']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>

    <div class="row mt-5">
        <div class="col">
            <h3 class="mb-3 text-white"><span class="text-danger">#</span> Lastest Stuffs OUT</h3>
        </div>
    </div>

    <?php foreach ($out as $trans) : ?>
    <div class="row mb-3">
        <div class="col-sm">
            <div class="card bg-secondary">
                <div class="card-body">
                    <div class="row">
                        <div class="col-auto">
                            <div class="circle bg-danger"></div>
                        </div>
                        <div class="col-sm">
                            <h5 class="fw-bold card-title"><?= $trans['id_barang'] ?></h5>
                            <p class="card-subtitle">Date : <?= $trans['tgl_keluar'] ?> | Amount :
                                <?= $trans['jml_keluar']; ?> | Supplier : <?= $trans['supplier']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?= $this->endSection(); ?>