<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mobile Menu</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .header {
            background-color: #212529;
            color: white;
            padding: 20px;
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
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
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
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 10px 0;
            border-top: 1px solid #dee2e6;
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
    <!-- Header -->
    <div class="header">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <div class="profile-img me-3"></div>
                <div>
                    <h6 class="mb-0">Selamat Datang</h6>
                    <small class="text-white-50">Dani Martinez</small>
                </div>
            </div>
            <div class="notification-badge">
                <i class="bi bi-bell fs-5"></i>
                <span class="notification-count">1</span>
            </div>
        </div>
        <div class="search-bar">
            <input type="text" class="form-control" placeholder="Mencari">
            <i class="bi bi-search"></i>
        </div>
    </div>

    <!-- Menu Grid -->
    <div class="menu-grid">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Menu</h5>
            <a href="#" class="text-primary text-decoration-none">Show All</a>
        </div>
        <div class="row g-3">
            <div class="col-4">
                <button class="menu-item w-100">
                    <i class="bi bi-key"></i>
                    <span>Ubah Password</span>
                </button>
            </div>
            <div class="col-4">
                <button class="menu-item w-100">
                    <i class="bi bi-book"></i>
                    <span>Panduan</span>
                </button>
            </div>
            <div class="col-4">
                <button class="menu-item w-100">
                    <i class="bi bi-gear"></i>
                    <span>Pengaturan</span>
                </button>
            </div>
            <div class="col-4">
                <button class="menu-item w-100">
                    <i class="bi bi-shield-check"></i>
                    <span>Kemanan dan Privasi</span>
                </button>
            </div>
            <div class="col-4">
                <button class="menu-item w-100">
                    <i class="bi bi-person"></i>
                    <span>Tentang Kami</span>
                </button>
            </div>
            <div class="col-4">
                <button class="menu-item w-100">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Keluar</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Bottom Navigation -->
    <div class="bottom-nav">
        <div class="row g-0">
            <div class="col">
                <a href="#" class="nav-item active">
                    <i class="bi bi-house"></i>
                    <span>Home</span>
                </a>
            </div>
            <div class="col">
                <a href="#" class="nav-item">
                    <i class="bi bi-clock"></i>
                    <span>Timer</span>
                </a>
            </div>
            <div class="col">
                <a href="#" class="nav-item">
                    <i class="bi bi-file-text"></i>
                    <span>Hasil</span>
                </a>
            </div>
            <div class="col">
                <a href="#" class="nav-item">
                    <i class="bi bi-person-circle"></i>
                    <span>Profil</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>