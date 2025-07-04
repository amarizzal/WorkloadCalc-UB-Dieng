

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h2 class="mb-4">Laporan Hasil Tindakan Tugas Pokok (Lain-Lain)</h2>

    <div class="table-responsive">
        <table id="laporanTable" class="table table-striped table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Perawat</th>
                    <?php $__currentLoopData = $tindakanLainLain; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tindakan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <th><?php echo e($tindakan->tindakan ?? 'Tidak Ada Data'); ?></th>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $perawatTindakan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userId => $tindakanJumlah): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($laporan->where('user_id', $userId)->first()->user->nama_lengkap ?? 'Tidak Ada Data'); ?></td>
                        <?php $__currentLoopData = $tindakanLainLain; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tindakan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <td><?php echo e($tindakanJumlah[$tindakan->id] ?? 0); ?></td>
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
                    <th>Rata-rata Waktu (Jam)</th>
                    <th>Standar Workload (SWL)</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $rataRataWaktu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tindakanId => $rataWaktu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($rataWaktu > 0): ?>  <!-- Menampilkan hanya tindakan yang memiliki waktu -->
                        <tr>
                            <td><?php echo e($laporan->where('tindakan_id', $tindakanId)->first()->tindakan->tindakan ?? 'Tidak Ada Data'); ?></td>
                            <td><?php echo e(number_format($rataWaktu, 2)); ?> jam</td>
                            <td><?php echo e(number_format($swl[$tindakanId], 2)); ?></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/user/Documents/PERAWAT/perawat/resources/views/admin/laporan/laporanhasil4.blade.php ENDPATH**/ ?>