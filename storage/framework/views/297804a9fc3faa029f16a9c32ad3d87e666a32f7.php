<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Core</div>
            <a class="nav-link" href="index.html">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>
            <div class="sb-sidenav-menu-heading">Interface</div>


            
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                Master
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="<?php echo e(route('admin.master-user')); ?>">Master User</a>
                    <a class="nav-link" href="<?php echo e(route('admin.master-tindakan')); ?>">Master Tindakan</a>
                    <a class="nav-link" href="<?php echo e(route('admin.master-shiftkerja')); ?>">Master Shift Kerja</a>
                    <a class="nav-link" href="<?php echo e(route('admin.master-work-status')); ?>">Master Work Status</a>
                    <a class="nav-link" href="<?php echo e(route('admin.master-ruangan')); ?>">Master Ruangan</a>
                    <a class="nav-link" href="<?php echo e(route('admin.master-keamanan-privasi')); ?>">Master Keamanan Privasi</a>
                    <a class="nav-link" href="<?php echo e(route('admin.master-panduan')); ?>">Master Panduan</a>
                </nav>
            </div>
            
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                Laporan
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapsePages" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="<?php echo e(route('admin.laporan.index')); ?>">Laporan Hasil</a>
                    <a class="nav-link" href="<?php echo e(route('admin.laporan.index2')); ?>">Laporan Tugas Pokok</a>
                    <a class="nav-link" href="<?php echo e(route('admin.laporan.index3')); ?>">Laporan Tugas Penunjang</a>
                    <!-- <a class="nav-link" href="<?php echo e(route('admin.laporan.index4')); ?>">Laporan Tugas Lain Lain</a> -->
                    <a class="nav-link" href="<?php echo e(route('admin.laporan.index5')); ?>">Laporan Tugas Tambahan</a>
                    <a class="nav-link" href="<?php echo e(route('admin.laporan.index6')); ?>">Laporan per Perawat</a>
                    
                </nav>
                
            </div>
            
        </div>
    </div>
  
</nav><?php /**PATH /Users/user/Documents/PERAWAT/perawat/resources/views/admin/layouts/sidebar.blade.php ENDPATH**/ ?>