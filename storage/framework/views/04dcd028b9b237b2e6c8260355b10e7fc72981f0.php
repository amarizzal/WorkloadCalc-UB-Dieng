

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h2 class="mb-4 text-center">Laporan Tindakan Perawat</h2>

    <div class="row">
        <div class="col-md-6">
            <label for="start_date">Start Date</label>
            <input type="date" id="start_date" class="form-control">
        </div>
        <div class="col-md-6">
            <label for="end_date">End Date</label>
            <input type="date" id="end_date" class="form-control">
        </div>
    </div>
    <br>
    

    <div class="table-responsive">
        <table id="laporanTable" class="table table-striped table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Nama Perawat</th>
                    <th class="text-center">Nama Ruangan</th>
                    <th class="text-center">Shift Kerja</th>
                    <th class="text-center">Tindakan</th>
                    <th class="text-center">Status Tindakan</th>
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">Jam Mulai</th>
                    <th class="text-center">Jam Berhenti</th>
                    <th class="text-center">Durasi</th>
                    <th class="text-center">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $laporan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="text-center"><?php echo e($index + 1); ?></td>
                        <td class="text-center"><?php echo e($data->user->nama_lengkap ?? 'Tidak Ada Data'); ?></td>
                        <td class="text-center"><?php echo e($data->ruangan->nama_ruangan ?? 'Tidak Ada Data'); ?></td>
                        <td class="text-center"><?php echo e($data->shift->nama_shift ?? 'Tidak Ada Data'); ?></td>
                        <td class="text-center"><?php echo e($data->tindakan->tindakan ?? 'Tidak Ada Data'); ?></td>
                        <td class="text-center"><?php echo e($data->tindakan->status ?? 'Tidak Ada Status'); ?></td>
                        <td class="text-center"><?php echo e($data->tanggal); ?></td>
                        <td class="text-center"><?php echo e(\Carbon\Carbon::parse($data->jam_mulai)->format('H:i:s')); ?></td>
                        <td class="text-center"><?php echo e(\Carbon\Carbon::parse($data->jam_berhenti)->format('H:i:s')); ?></td>
                        <td class="text-center"><?php echo e(floor($data->durasi / 60)); ?> menit <?php echo e($data->durasi % 60); ?> detik</td>
                        <td class="text-center"><?php echo e($data->keterangan ?? 'Tidak Ada Keterangan'); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/user/Documents/PERAWAT/perawat/resources/views/admin/laporan/laporanhasil.blade.php ENDPATH**/ ?>