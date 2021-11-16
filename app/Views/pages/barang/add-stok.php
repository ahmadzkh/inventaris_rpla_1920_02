<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<link rel="stylesheet" href="/assets/css/dashboard/barang/barang.css">

<div class="row no-gutters">
    <div class="col">
        <div class="card shadow-sm">
            <div class="card-header card-title fw-bold text-center">Detail Stuff</div>
            <div class="card-body">
                <div class="row justify-content-around">
                    <div class="col-5" style="max-width:300px">
                        <img src="/assets/img/<?= $barang->gambar; ?>" alt="" width="300">
                    </div>
                    <div class="col-5">
                        <p class="card-title h3 fw-bold"><?= $barang->nama_barang; ?></p>
                        <p class="card-subtitle h5 text-black-50 mb-3"><?= $barang->id_barang; ?></p>
                        <p class="card-text">
                            <?= $barang->spesifikasi; ?>
                        </p>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Room</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Stock</th>
                                    <th scope="col">Donors</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?= $barang->lokasi; ?></td>
                                    <td><?= $barang->kondisi; ?></td>
                                    <td><?= $barang->jumlah_barang; ?></td>
                                    <td><?= $barang->sumber_dana; ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <form action="post" class="my-3">
                            <?= csrf_field(); ?>
                            <div class="row mb-3">
                                <div class="col">
                                    <div class="title fw-bold text-center">Add Stock</div>
                                </div>
                            </div>
                            <div class="row justify-content-around align-items-center mb-3">
                                <div class="col-3">
                                    <label for="jumlah">New Stock</label>
                                </div>
                                <div class="col">
                                    <input type="number" name="jumlah" id="jumlah" class="form-control form-control-sm"
                                        min="1">
                                </div>
                            </div>
                            <div class="row justify-content-around align-items-center mb-4">
                                <div class="col-3">
                                    <label for="sumber">Contributor</label>
                                </div>
                                <div class="col">
                                    <select name="sumber" id="sumber"
                                        class="form-control form-control-sm <?= ($validation->hasError('sumber')) ? 'is-invalid' : ''; ?>">
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
                            </div>
                            <button type="submit" class="btn btn-outline-success w-100">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>