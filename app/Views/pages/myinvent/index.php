<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<link rel="stylesheet" href="/assets/css/dashboard/myinvent.css">

<div class="row">
    <div class="col">
        <div class="card shadow-sm">
            <div class="card-header card-title fw-bold text-center">My Invent</div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">USER ID</th>
                            <th scope="col">Date of Borrow</th>
                            <th scope="col">STUFF ID</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Return Date</th>
                            <?php if (session()->level === "U03") : ?>
                            <th scope="col">Handle</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($getInvent as $s) : ?>
                        <tr>
                            <td><?= $s['peminjam']; ?></td>
                            <td><?= $s['tgl_pinjam']; ?></td>
                            <td><?= $s['barang_pinjam']; ?></td>
                            <td><?= $s['jml_pinjam']; ?></td>
                            <td><?= $s['tgl_kembali']; ?></td>
                            <?php if (session()->level === "U03") : ?>
                            <td>
                                <a href="#" class="btn btn-success text-white"><i class="fas fa-trash-restore"></i></a>
                                <a href="#" class="btn btn-purple text-white"><i class="fas fa-info-circle"></i></a>
                            </td>
                            <?php endif; ?>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>