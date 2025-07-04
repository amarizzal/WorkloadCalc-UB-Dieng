<!-- home.blade.php -->


<?php $__env->startSection('content'); ?>

   <!-- Menampilkan alert jika ada pesan sukses -->
   <?php if(session('success')): ?>
       <div class="alert alert-success">
           <?php echo e(session('success')); ?>

       </div>
<?php endif; ?>

<?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>




<div class="menu-grid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Menu</h5>
        <a href="#" class="text-primary text-decoration-none">Show All</a>
    </div>
    <div class="row g-3">
        <div class="col-4">
            <a href="<?php echo e(route('perawat.ubahpassword')); ?>" class="w-100">
                <button class="menu-item w-100">
                    <i class="bi bi-key"></i>
                    <span>Ubah Password</span>
                </button>
            </a>
        </div>
        <div class="col-4">
            <a href="<?php echo e(route('perawat.panduan')); ?>" class="w-100">
                <button class="menu-item w-100">
                    <i class="bi bi-book"></i>
                    <span>Panduan</span>
                </button>
            </a>
        </div>
        <div class="col-4">
            <a href="<?php echo e(route('perawat.pengaturan')); ?>" class="w-100">
                <button class="menu-item w-100">
                    <i class="bi bi-gear"></i>
                    <span>Pengaturan</span>
                </button>
            </a>
        </div>
        <div class="col-4">
            <a href="<?php echo e(route('perawat.keamananprivasi')); ?>" class="w-100">
                <button class="menu-item w-100">
                    <i class="bi bi-shield-check"></i>
                    <span>Keamanan dan Privasi</span>
                </button>
            </a>
        </div>
        <div class="col-4">
            <a href="<?php echo e(route('perawat.tentangkami')); ?>" class="w-100">
                <button class="menu-item w-100">
                    <i class="bi bi-person"></i>
                    <span>Tentang Kami</span>
                </button>
            </a>
        </div>
        <div class="col-4">
            <form action="<?php echo e(route('logout')); ?>" method="POST" class="w-100">
                <?php echo csrf_field(); ?> <!-- Token CSRF untuk keamanan -->
                <button type="submit" class="menu-item w-100">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Keluar</span>
                </button>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('perawat.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/user/Documents/PERAWAT/perawat/resources/views/perawat/home.blade.php ENDPATH**/ ?>