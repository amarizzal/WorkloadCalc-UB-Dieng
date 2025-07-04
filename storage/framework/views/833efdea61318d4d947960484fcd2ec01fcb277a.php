

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <div class="card">
        <div class="card-body" style="max-height: 500px; overflow-y: auto;">
            <h5 class="card-title">Profil Saya</h5>
            <div class="text-center mb-4">
                <div class="profile-img mx-auto mb-3" style="width: 100px; height: 100px; border-radius: 50%; overflow: hidden; border: 4px solid red;">
                    <img src="<?php echo e(asset('storage/user_photos/' . auth()->user()->foto)); ?>" 
                    alt="Foto Profil" 
                    style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                
                <h4><?php echo e(auth()->user()->nama_lengkap ?? 'Nama Tidak Tersedia'); ?></h4>
                <p class="text-muted">Perawat</p>
            </div>
            
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-person me-2"></i> Edit Profil
                </a>
                <a href="/ubahpassword" class="list-group-item list-group-item-action">
                    <i class="bi bi-key me-2"></i> Ubah Password
                </a>
                <form action="<?php echo e(route('logout')); ?>" method="POST" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="list-group-item list-group-item-action">
                        <i class="bi bi-box-arrow-right me-2"></i> Keluar
                    </button>
                </form>
                
            </div>
            
            <!-- Additional User Information -->
            <hr>
            <p><strong>Email:</strong> <?php echo e(auth()->user()->email ?? 'Not Available'); ?></p>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('perawat.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/user/Documents/PERAWAT/perawat/resources/views/perawat/profil.blade.php ENDPATH**/ ?>