<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<link rel="stylesheet" href="/assets/css/dashboard/barang/barang.css">

<div class="container-fluid">
    <div class="row text-center justify-content-center my-4">
        <div class="col-sm text-center">
            <p class="h4 text-muted m-0 p-0">Detail</p>
            <p class="text-center text-white fw-bolder mb-4 brg">Stuffs</p>
        </div>
    </div>

    <div class="card bg-dark shadow mb-3 mx-auto w-100 text-white">
        <div class="row g-0 justify-content-between">
            <div class="col-md p-3">
                <div class="brg-imgd">
                    <img src="/assets/img/<?= $barang['gambar']; ?>" class="card-img-top" alt="...">
                </div>
            </div>
            <div class="col-md-7">
                <div class="card-body">
                    <div class="row mt-1 justify-content-between">
                        <div class="col">
                            <h2 class="card-title fw-bolder"><b><?= $barang['nama_barang']; ?></b></h2>
                        </div>
                        <div class="col-auto">
                            <div class="btn btn-secondary"><b><?= $barang['id_barang']; ?></b></div>
                        </div>
                    </div>
                    <p class="h4 m-1 p-1"><b>Status</b> <?= $barang['kondisi']; ?></p>
                    <p class="h4 m-1 p-1"><b>Room</b> <?= $barang['lokasi']; ?></p>
                    <p class="h4 m-1 p-1"><b>Contributor</b> <?= $barang['sumber_dana']; ?></p>
                    <p class="h4 my-2 fw-bold">Deskripsi</p>
                    <?= $barang['spesifikasi']; ?>.

                    <div class="row mt-4 align-middle">
                        <div class="col-auto">
                            <p class="h4 fw-bold">Stock</p>
                        </div>
                        <div class="col-auto">
                            <div class="btn btn-secondary"><b><?= $barang['jumlah_barang']; ?></b></div>
                        </div>
                    </div>

                    <div class="row mt-5 pt-5 justify-content-around">
                        <div class="col-sm mb-3">
                            <a href="/dashboard/stuffs/edit/<?= $barang['id_barang']; ?>"
                                class="btn btn-warning w-100">Edit</a>
                        </div>
                        <div class="col-sm mb-3">
                            <form action="/dashboard/stuffs/delete/<?= $barang['id_barang']; ?>" method="post"
                                class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="text" hidden name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger w-100"
                                    onclick="return confirm('Are you sure?');">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">

        </div>
        <div class="col-auto">
            <a href="/dashboard/stuffs/" class="btn btn-secondary">Back</a>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>