<!-- layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo $__env->yieldContent('title', 'Dashboard Perawat'); ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <!-- Tambahkan di bagian <head> -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    


    <style>
        body {
            background-color: #f8f9fa;
            padding-bottom: 60px; 

            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        .header {
            background-color: #212529;
            color: white;
            padding: 20px;
            position: sticky;
            top: 0;
            z-index: 1000;

        }

        .card {
            height: auto;
            /* Biarkan tinggi menyesuaikan dengan konten */
            max-height: 80vh;
            /* Batasi maksimum tinggi agar tidak melebihi layar */
            overflow-y: auto;
        }

        .row.g-3 {
            height: 62vh;
        }


        .profile-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #6c757d;
        }

        .notification-badge {
            position: relative;
        }

        .notification-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: #dc3545;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            padding-top: 10px;
            /* Tambahkan ruang untuk header sticky */
            padding-bottom: 60px;
            /* Tambahkan ruang untuk bottom navigation */
        }

        button {
            width: 100%;
            /* Full width pada layar kecil */
            max-width: 150px;
            /* Batasi lebar maksimum */
            margin: 5px auto;
            /* Tambahkan margin */
        }


        .search-bar {
            position: relative;
            margin-top: 15px;
        }

        .search-bar .bi-search {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }

        .menu-grid {
            padding: 20px;
        }

        .menu-item {
            background: white;
            height: 150px;
            border-radius: 12px;
            padding: 15px;
            text-align: center;
            margin-bottom: 15px;
            border: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .menu-item i {
            color: #0d6efd;
            font-size: 24px;
            margin-bottom: 8px;
        }

        .menu-item span {
            color: #6c757d;
            font-size: 14px;
            display: block;
        }

        .bottom-nav {
    background: white;
    text-align: center;
    position: fixed; /* Tetap di bawah layar */
    bottom: 0;
    left: 0;
    right: 0;
    padding: 10px 0;
    border-top: 1px solid #dee2e6;
    z-index: 1000; /* Tetap di atas elemen lain jika diperlukan */
    box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
}

    .nav-item {
        text-align: center;
        color: #6c757d;
        text-decoration: none;
    }

    .nav-item.active {
        color: #0d6efd;
    }

    .nav-item i {
        font-size: 20px;
        display: block;
        margin-bottom: 2px;
    }

    .nav-item span {
        font-size: 12px;
    }
    </style>
</head>

<body>
    <?php echo $__env->make('perawat.layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->yieldContent('content'); ?>

    <?php echo $__env->make('perawat.layouts.bottomnav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>

</body>

</html>
<?php /**PATH /Users/user/Documents/PERAWAT/perawat/resources/views/perawat/layouts/app.blade.php ENDPATH**/ ?>