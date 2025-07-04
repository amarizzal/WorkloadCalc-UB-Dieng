

<?php $__env->startSection('content'); ?>
<Style>
    @media (max-width: 576px) {
        .card {
            margin-bottom: 20px;
        }

        form .form-control,
        form .btn {
            font-size: 14px;
        }

        h5.card-title {
            font-size: 18px;
        }
    }

    .card-header {
        cursor: pointer;
    }
</Style>

<!-- Menampilkan alert jika ada success atau error -->
<?php if(session('success')): ?>
    <div class="alert alert-success">
        <?php echo e(session('success')); ?>

    </div>
<?php elseif(session('error')): ?>
    <div class="alert alert-danger">
        <?php echo e(session('error')); ?>

    </div>
<?php endif; ?>

<div class="container mt-4">
    <!-- Form Filter Rentang Tanggal -->
    <div class="row mb-4">
        <div class="col-md-6">
            <form action="<?php echo e(route('perawat.hasil')); ?>" method="GET">
                <div class="row">
                    <div class="col-md-5">
                        <label for="start_date">Tanggal Mulai</label>
                        <input type="date" name="start_date" class="form-control" value="<?php echo e($startDate); ?>">
                    </div>
                    <div class="col-md-5">
                        <label for="end_date">Tanggal Akhir</label>
                        <input type="date" name="end_date" class="form-control" value="<?php echo e($endDate); ?>">
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Menampilkan laporan sesuai rentang tanggal dengan urutan terbaru -->
    <?php if($laporan->isEmpty()): ?>
        <div class="alert alert-warning text-center">
            Tidak ada laporan tindakan untuk periode <?php echo e(\Carbon\Carbon::parse($startDate)->format('d-m-Y')); ?> - <?php echo e(\Carbon\Carbon::parse($endDate)->format('d-m-Y')); ?>.
        </div>
    <?php else: ?>
        <div class="row">
            <?php
                $previousDate = null;
            ?>
            <?php $__currentLoopData = $laporan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $laporanItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $currentDate = \Carbon\Carbon::parse($laporanItem->jam_berhenti)->format('Y-m-d');
                ?>

                <?php if($currentDate != $previousDate): ?>
                    <div class="col-12">
                        <h4 class="text-center mb-4">---------- <?php echo e(\Carbon\Carbon::parse($laporanItem->jam_berhenti)->format('d-m-Y')); ?> ----------</h4>
                    </div>
                <?php endif; ?>

                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-header" id="heading<?php echo e($laporanItem->id); ?>" data-bs-toggle="collapse"
                            data-bs-target="#collapse<?php echo e($laporanItem->id); ?>" aria-expanded="false"
                            aria-controls="collapse<?php echo e($laporanItem->id); ?>">
                            <h5 class="card-title d-flex justify-content-between">
                                <span><?php echo e($laporanItem->tindakan ? $laporanItem->tindakan->tindakan : 'N/A'); ?></span>
                                <span><?php echo e(\Carbon\Carbon::parse($laporanItem->jam_berhenti)->format('H:i')); ?></span>
                            </h5>
                        </div>

                        <div id="collapse<?php echo e($laporanItem->id); ?>" class="collapse"
                            aria-labelledby="heading<?php echo e($laporanItem->id); ?>" data-bs-parent=".row">
                            <div class="card-body">
                                <p><strong>Tanggal:</strong> <?php echo e(\Carbon\Carbon::parse($laporanItem->jam_berhenti)->format('d-m-Y')); ?></p>

                                <?php
                                    $durasiMenit = floor($laporanItem->durasi / 60);
                                    $durasiDetik = $laporanItem->durasi % 60;
                                ?>
                                <p><strong>Durasi:</strong> <?php echo e($durasiMenit); ?> menit <?php echo e($durasiDetik); ?> detik</p>

                                <p><strong>Shift:</strong> <?php echo e($laporanItem->shift ? $laporanItem->shift->nama_shift : 'N/A'); ?></p>
                                <p><strong>Status:</strong> <?php echo e($laporanItem->durasi ? 'Selesai' : 'Belum Selesai'); ?></p>
                                <p><strong>Jam Berhenti:</strong> <?php echo e(\Carbon\Carbon::parse($laporanItem->jam_berhenti)->format('H:i')); ?></p>

                                <?php if($laporanItem->keterangan): ?>
                                    <div class="mt-3">
                                        <p><strong>Keterangan:</strong> <?php echo e($laporanItem->keterangan); ?></p>
                                    </div>
                                <?php else: ?>
                                    <div class="mt-3">
                                        <form action="<?php echo e(route('perawat.keterangan.store', $laporanItem->id)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <div class="form-group">
                                                <textarea class="form-control" name="keterangan" placeholder="Masukkan keterangan..." rows="3" required></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary mt-2">Simpan Keterangan</button>
                                        </form>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                    $previousDate = $currentDate;
                ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('perawat.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/user/Documents/PERAWAT/perawat/resources/views/perawat/hasil.blade.php ENDPATH**/ ?>