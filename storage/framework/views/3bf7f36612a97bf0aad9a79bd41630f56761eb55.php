

<?php $__env->startSection('content'); ?>
<?php if(session('success')): ?>
    <div class="alert alert-success">
        <?php echo e(session('success')); ?>

    </div>
<?php elseif(session('error')): ?>
    <div class="alert alert-danger">
        <?php echo e(session('error')); ?>

    </div>
<?php endif; ?>
<br>
    <h1 class="mb-4">Manajemen Tindakan dan Waktu</h1>

    <div class="row">
        <!-- Bagian Atas: Form untuk menambah Tindakan dan Waktu -->
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5>Tambah Tindakan dan Waktu</h5>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('admin.master.tindakan.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <!-- Kolom Kiri: Jenis Tindakan -->
                            <div class="col-md-6 mb-3">
                                <label for="tindakan" class="form-label">Tindakan</label>
                                <input type="text" class="form-control" id="tindakan" name="tindakan" required>
                            </div>
                            <!-- Kolom Kanan: Waktu (Menit) -->
                            <div class="col-md-6 mb-3">
                                <label for="waktu" class="form-label">Waktu (Menit)</label>
                                <input type="number" class="form-control" id="waktu" name="waktu" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="Tugas Pokok">Tugas Pokok</option>
                                    <option value="Tugas Penunjang">Tugas Penunjang</option>
                                </select>
                            </div>
                            
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Bagian Bawah: Tabel Tindakan dan Waktu -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Daftar Tindakan dan Waktu</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Tindakan</th>
                                    <th>Waktu (Menit)</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $tindakanWaktu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e($item->tindakan); ?></td>
                                        <td><?php echo e($item->waktu); ?></td>
                                        <td><?php echo e($item->status); ?></td> <!-- Tambahan kolom status -->
                                        <td>
                                            <!-- Tombol Edit dan Hapus -->
                                            <a href="<?php echo e(route('admin.master.tindakan.edit', $item->id)); ?>" class="btn btn-warning btn-sm">Edit</a>
                                            <!-- Form hapus dengan method DELETE -->
                                            <form action="<?php echo e(route('admin.master.tindakan.delete', $item->id)); ?>" method="POST" style="display:inline;">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/user/Documents/PERAWAT/perawat/resources/views/admin/master/mastertindakan.blade.php ENDPATH**/ ?>