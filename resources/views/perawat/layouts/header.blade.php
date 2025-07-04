<!-- layouts/header.blade.php -->

<div class="header">
    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <div class="profile-img me-3"
                style="width: 40px; height: 40px; border-radius: 50%; overflow: hidden; background-color: #6c757d;">
                <!-- Gambar Profil -->
                <img src="{{ asset('storage/user_photos/' . auth()->user()->foto) }}" alt="Foto Profil"
                    style="width: 100%; height: 100%; object-fit: cover;">
            </div>
            <div>
                <h6 class="mb-0">Selamat Datang</h6>
                <small class="text-white-50">{{ auth()->user()->nama_lengkap ?? 'Guest' }}</small>
            </div>
        </div>
        <div class="notification-badge" id="notification-badge" style="cursor: pointer;">
            <i class="bi bi-bell fs-5"></i>
            <span class="notification-count">0</span> <!-- Diubah dengan JS -->
        </div>
    </div>
    <div class="search-bar">
        <input type="text" class="form-control" placeholder="Mencari">
        <i class="bi bi-search"></i>
    </div>
</div>

<!-- Modal for notifications -->
<div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notificationModalLabel">Notifikasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="notification-list">
                <!-- Notifikasi akan ditambahkan di sini dengan JS -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<script>
    // Fungsi untuk mengambil notifikasi
    function fetchNotifications() {
        fetch('/public/perawat/notifikasi') // Ambil notifikasi dari controller
            .then(response => response.json())
            .then(data => {
                console.log(data); // Cek apa yang diterima dari server

                // Pastikan ada data yang diterima
                if (data.notifications && data.notifications.length > 0) {
                    const notificationCount = data.notifications.length;
                    const notificationBadge = document.querySelector('.notification-count');
                    notificationBadge.textContent = notificationCount; // Update jumlah notifikasi di badge

                    const notificationList = document.getElementById('notification-list');
                    notificationList.innerHTML = ''; // Kosongkan daftar notifikasi

                    // Menampilkan notifikasi
                    data.notifications.forEach((notification) => {
                        const notificationItem = document.createElement('div');
                        notificationItem.classList.add('notification-item', 'mb-3', 'p-2', 'border',
                            'rounded');
                        notificationItem.setAttribute('data-id', notification
                        .id); // Gunakan ID notifikasi dari server

                        // Teks notifikasi
                        const notificationText = document.createElement('p');
                        notificationText.textContent = notification.message; // Gunakan pesan notifikasi

                        // Tombol untuk menandai dibaca
                        const clearButton = document.createElement('button');
                        clearButton.textContent = 'Tandai Dibaca';
                        clearButton.classList.add('btn', 'btn-sm', 'btn-secondary', 'ms-2');
                        clearButton.onclick = function() {
                            clearNotification(notification
                            .id); // Gunakan ID notifikasi untuk menandai dibaca
                        };

                        // Tambahkan elemen ke item notifikasi
                        notificationItem.appendChild(notificationText);
                        notificationItem.appendChild(clearButton);

                        // Tambahkan item ke daftar notifikasi
                        notificationList.appendChild(notificationItem);
                    });
                } else {
                    // Jika tidak ada notifikasi
                    const notificationList = document.getElementById('notification-list');
                    notificationList.innerHTML = '<p>Tidak ada notifikasi baru.</p>';
                }
            })
            .catch(error => console.error('Error fetching notifications:', error));
    }

    // Fungsi untuk menandai notifikasi sebagai dibaca dan menyimpannya di localStorage
    function clearNotification(notificationId) {
        // Kirim request ke server untuk menandai notifikasi sebagai dibaca
        fetch(`/public/perawat/notifikasi/${notificationId}/read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Hapus notifikasi dari modal
                    const notificationItem = document.querySelector(`[data-id="${notificationId}"]`);
                    if (notificationItem) {
                        notificationItem.remove();
                    }

                    // Perbarui jumlah notifikasi di badge
                    const notificationCount = document.querySelector('.notification-count');
                    notificationCount.textContent = parseInt(notificationCount.textContent) - 1;
                }
            })
            .catch(error => console.error('Error marking notification as read:', error));
    }



    // Fungsi untuk polling notifikasi secara berkala
    setInterval(fetchNotifications, 5000); // Polling setiap 5 detik

    document.getElementById('notification-badge').addEventListener('click', function() {
        const notificationCount = document.querySelector('.notification-count').textContent;
        if (parseInt(notificationCount) > 0) {
            const myModal = new bootstrap.Modal(document.getElementById('notificationModal'), {
                keyboard: false
            });
            myModal.show();
        }
    });
</script>
