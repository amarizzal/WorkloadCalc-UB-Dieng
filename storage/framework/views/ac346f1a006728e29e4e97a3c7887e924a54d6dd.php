

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h2 class="mb-4">Laporan Hasil Tindakan Tugas Pokok</h2>

    <!-- Form Filter Tanggal -->
    <form method="GET" action="<?php echo e(route('admin.laporan.index2')); ?>" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <label for="tanggal_awal">Tanggal Awal:</label>
                <input type="date" name="tanggal_awal" value="<?php echo e(request('tanggal_awal')); ?>" required class="form-control">
            </div>
            <div class="col-md-4">
                <label for="tanggal_akhir">Tanggal Akhir:</label>
                <input type="date" name="tanggal_akhir" value="<?php echo e(request('tanggal_akhir')); ?>" required class="form-control">
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>

    <div class="table-responsive">
        <table id="laporanTable" class="table table-striped table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Total</th>
                    <th>Tindakan</th>
                    <?php $__currentLoopData = $perawat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $perawatItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <th><?php echo e($perawatItem->nama_lengkap ?? 'Tidak Ada Data'); ?></th>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $tindakanPokok; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tindakan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($totalTindakan[$tindakan->id] ?? 0); ?></td>
                        <td><?php echo e($tindakan->tindakan ?? 'Tidak Ada Data'); ?></td>
                        <?php $__currentLoopData = $perawat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $perawatItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <td><?php echo e($perawatTindakan[$perawatItem->id][$tindakan->id] ?? 0); ?></td>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        <h4>Rata-rata Waktu Per Tindakan</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tindakan</th>
                    <th>Total Tindakan</th>
                    <th>Rata-rata Waktu (Jam)</th>
                    <th>Standar Workload (SWL)</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $rataRataWaktu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tindakanId => $rataWaktu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($rataWaktu > 0): ?> <!-- Menampilkan hanya tindakan yang memiliki waktu -->
                        <tr>
                            <td><?php echo e($laporan->where('tindakan_id', $tindakanId)->first()->tindakan->tindakan ?? 'Tidak Ada Data'); ?></td>
                            <td><?php echo e($totalTindakan[$tindakanId] ?? 0); ?></td>
                            <td><?php echo e(number_format($rataWaktu / 60, 2)); ?> jam</td>
                            <td><?php echo e(number_format($swl[$tindakanId], 2)); ?></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/user/Documents/PERAWAT/perawat/resources/views/admin/laporan/laporanhasil2.blade.php ENDPATH**/ ?>