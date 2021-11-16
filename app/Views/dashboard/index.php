<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<link rel="stylesheet" href="/assets/css/dashboard/index.css">

<div class="row mb-1">
    <div class="col-xl-3 col-md-6 mb-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs text-primary title mb-1">
                            All Stock
                        </div>
                        <div class="h5 mb-0 fw-bold">
                            <?= $countStok[0]['stok_total']; ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-box iconic"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs text-primary title mb-1">
                            Resources
                        </div>
                        <div class="h5 mb-0 fw-bold">
                            <?= $countSource; ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list iconic"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs text-primary title mb-1">
                            Supplier
                        </div>
                        <div class="h5 mb-0 fw-bold">
                            <?= $countSupplier; ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-warehouse iconic"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs text-success title mb-1">
                            My Invent
                        </div>
                        <div class="h5 mb-0 fw-bold">
                            <?= ($countInvent[0]['my_invent']) ? $countInvent[0]['my_invent'] : '0'; ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-inbox iconic"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <h3 class="border-bottom mb-3">Stuff</h3>
    </div>
</div>

<div class="row no-gutters justify-content-around">
    <?php foreach ($getBarang as $barang) : ?>
    <div class="col-auto mb-3">
        <div class="card shadow" style="width: 20rem;">
            <img src="/assets/img/<?= $barang->gambar; ?>" class="card-img-top" alt="img">
            <div class="card-body">
                <h5 class="card-title"><?= $barang->nama_barang; ?></h5>
                <p class="card-subtitle mb-2"><?= $barang->id_barang; ?></p>
                <p class="card-text"><?= $barang->spesifikasi; ?>.</p>
                <a href="/stuf-detail/<?= $barang->id_barang; ?>" class="btn btn-purple w-100">Go Detail</a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?= $this->endSection(); ?>