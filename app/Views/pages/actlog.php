<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<link rel="stylesheet" href="/assets/css/dashboard/actlog.css">

<div class="row">
    <div class="col">
        <div class="card shadow-sm">
            <div class="card-header card-title fw-bold text-center">Log</div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Event</th>
                            <th scope="col">Label</th>
                            <th scope="col">Specification</th>
                            <th scope="col">Location</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Resource</th>
                            <th scope="col">Status</th>
                            <th scope="col">Date Event</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($log as $s) : ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $s['nama_event']; ?></td>
                            <td><?= $s['nama_barang']; ?></td>
                            <td style="max-width: 200px;"><?= $s['spesifikasi']; ?></td>
                            <td><?= $s['lokasi']; ?></td>
                            <td><?= $s['jumlah_barang']; ?></td>
                            <td><?= $s['sumber_dana']; ?></td>
                            <td><?= $s['kondisi']; ?></td>
                            <td><?= $s['waktu_event']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?= $pager->simpleLinks('barang_log', 'bootstrap'); ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>