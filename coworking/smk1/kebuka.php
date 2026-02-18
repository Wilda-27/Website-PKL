<?php
// Set timezone ke WIB
date_default_timezone_set('Asia/Jakarta');

$koneksi = new mysqli("localhost", "root", "", "admin");
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

/* ==========================
   TAMBAHKAN KOLOM last_reset (jika belum ada)
========================== */
$cek_kolom = $koneksi->query("SHOW COLUMNS FROM r_utama LIKE 'last_reset'");
if ($cek_kolom->num_rows == 0) {
    $koneksi->query("ALTER TABLE r_utama ADD COLUMN last_reset DATETIME NULL");
}

/* ==========================
   MEETING ROOM – SETUP
========================== */
$koneksi->query("
    CREATE TABLE IF NOT EXISTS meeting_room (
        id INT AUTO_INCREMENT PRIMARY KEY,
        status ENUM('tersedia','tidak tersedia') DEFAULT 'tersedia'
    )
");
$cek_meeting = $koneksi->query("SELECT * FROM meeting_room LIMIT 1");
if ($cek_meeting->num_rows == 0) {
    $koneksi->query("INSERT INTO meeting_room (status) VALUES ('tersedia')");
}
$meeting_data = $koneksi->query("SELECT * FROM meeting_room LIMIT 1")->fetch_assoc();
$meeting_status = $meeting_data['status'] ?? 'tersedia';

/* ==========================
   AMBIL DATA SEKARANG (R_UTAMA)
========================== */
$data = $koneksi->query("SELECT * FROM r_utama LIMIT 1")->fetch_assoc();

$kursi_sekarang = $data['total_kursi'] ?? 0;
$meja_sekarang = $data['total_meja'] ?? 0;
$kapasitas_kursi = $data['stok_awal_kursi'] ?? 0;
$kapasitas_meja = $data['stok_awal_meja'] ?? 0;


/* ==========================
   SET KAPASITAS RUANGAN
========================== */
if (isset($_POST['simpan_utama'])) {
    $kursi = intval($_POST['total_kursi']);
    $meja = intval($_POST['total_meja']);

    $cek = $koneksi->query("SELECT id_utama FROM r_utama LIMIT 1");

    if ($cek->num_rows > 0) {
        $row = $cek->fetch_assoc();
        $stmt = $koneksi->prepare("
            UPDATE r_utama 
            SET total_kursi=?, total_meja=?, 
                stok_awal_kursi=?, stok_awal_meja=? 
            WHERE id_utama=?");
        $stmt->bind_param("iiiii", $kursi, $meja, $kursi, $meja, $row['id_utama']);
        $stmt->execute();
    } else {
        $stmt = $koneksi->prepare("
            INSERT INTO r_utama(total_kursi,total_meja,stok_awal_kursi,stok_awal_meja) 
            VALUES(?,?,?,?)");
        $stmt->bind_param("iiii", $kursi, $meja, $kursi, $meja);
        $stmt->execute();
    }
}


/* ==========================
   KURANGI STOK (ADA ORANG DATANG)
========================== */
if (isset($_POST['kurangi'])) {
    $kurang_kursi = intval($_POST['kurang_kursi']);
    $kurang_meja = intval($_POST['kurang_meja']);

    $koneksi->query("
        UPDATE r_utama 
        SET total_kursi = GREATEST(total_kursi - $kurang_kursi,0),
            total_meja  = GREATEST(total_meja - $kurang_meja,0)
    ");
}


/* ==========================
   RESTOK MANUAL (TUTUP HARI) – tetap dipertahankan
========================== */
if (isset($_POST['reset_harian'])) {
    $koneksi->query("
        UPDATE r_utama 
        SET total_kursi = stok_awal_kursi,
            total_meja  = stok_awal_meja,
            last_reset = NOW()
    ");
}


/* ==========================
   UPDATE STATUS MEETING ROOM
========================== */
if (isset($_POST['update_meeting'])) {
    $status = $_POST['meeting_status'] ?? 'tersedia';
    if ($status == 'tersedia' || $status == 'tidak tersedia') {
        $koneksi->query("UPDATE meeting_room SET status = '$status' LIMIT 1");
    }
    // refresh data meeting
    $meeting_data = $koneksi->query("SELECT * FROM meeting_room LIMIT 1")->fetch_assoc();
    $meeting_status = $meeting_data['status'] ?? 'tersedia';
}


/* ==========================
   RESTOK OTOMATIS BERDASARKAN JADWAL
========================== */
if ($data) { // hanya jika data sudah ada
    $now = time();
    $current_hour = (int)date('H');
    $current_day = (int)date('N'); // 1=Senin, 7=Minggu
    $last_reset = isset($data['last_reset']) ? strtotime($data['last_reset']) : 0;
    $today_start = strtotime(date('Y-m-d 00:00:00'));

    $jadwal_terpenuhi = false;
    // Senin-Kamis jam >= 16:00
    if ($current_day >= 1 && $current_day <= 4 && $current_hour >= 16) {
        $jadwal_terpenuhi = true;
    }
    // Jumat-Sabtu jam >= 15:00
    if (($current_day == 5 || $current_day == 6) && $current_hour >= 15) {
        $jadwal_terpenuhi = true;
    }

    if ($jadwal_terpenuhi && $last_reset < $today_start) {
        // Lakukan reset otomatis
        $koneksi->query("
            UPDATE r_utama 
            SET total_kursi = stok_awal_kursi,
                total_meja  = stok_awal_meja,
                last_reset = NOW()
            WHERE id_utama = " . intval($data['id_utama'])
        );
        // Refresh data
        $data = $koneksi->query("SELECT * FROM r_utama LIMIT 1")->fetch_assoc();
    }
}

/* REFRESH DATA R_UTAMA */
$data = $koneksi->query("SELECT * FROM r_utama LIMIT 1")->fetch_assoc();
$kursi_sekarang = $data['total_kursi'] ?? 0;
$meja_sekarang = $data['total_meja'] ?? 0;
$kapasitas_kursi = $data['stok_awal_kursi'] ?? 0;
$kapasitas_meja = $data['stok_awal_meja'] ?? 0;
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Admin TRASA • 2026</title>
    <!-- Bootstrap 5 + Icons + Google Font Inter -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(145deg, #f5f9ff 0%, #eaf0f9 100%);
            min-height: 100vh;
            padding: 2rem 0;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 28px;
            box-shadow: 0 20px 40px -12px rgba(0, 32, 64, 0.12);
            transition: all 0.2s ease;
        }

        .glass-card:hover {
            background: rgba(255, 255, 255, 0.85);
            box-shadow: 0 24px 48px -12px rgba(0, 80, 120, 0.2);
            transform: translateY(-4px);
        }

        .btn-pill {
            border-radius: 40px !important;
            padding: 0.6rem 1.5rem;
            font-weight: 500;
        }

        .status-badge {
            padding: 0.5rem 1.2rem;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .meeting-toggle .btn-check:checked+.btn-outline-success {
            background: #198754;
            color: white;
            border-color: #198754;
        }

        .meeting-toggle .btn-check:checked+.btn-outline-danger {
            background: #dc3545;
            color: white;
            border-color: #dc3545;
        }

        .meeting-toggle .btn {
            border-radius: 40px;
            padding: 0.6rem 1.8rem;
            font-weight: 600;
        }

        .card-title i {
            color: #0d6efd;
            margin-right: 8px;
        }
    </style>
</head>

<body>

    <div class="container py-4">

        <!-- HEADER FRESH 2026 -->
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2 class="fw-bold" style="color: #0b2b40;"><i class="bi bi-building"></i> TRASA · Admin Panel</h2>
                <p class="text-secondary-emphasis">Manajemen ruangan dan meeting • 2026</p>
            </div>
            <div class="bg-white px-4 py-2 rounded-5 shadow-sm">
                <i class="bi bi-calendar-check me-2"></i><?= date('l, d F Y') ?>
            </div>
        </div>

        <!-- STATUS RINGKASAN (KURSI & MEJA) + TOMBOL SET KAPASITAS DI CARD KURSI -->
        <div class="row g-4 mb-5">
            <div class="col-md-6">
                <div class="glass-card p-4 d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-4 me-3">
                            <i class="bi bi-person-workspace fs-1 text-primary"></i>
                        </div>
                        <div>
                            <span class="text-secondary-emphasis text-uppercase small fw-semibold">Ketersediaan Kursi</span>
                            <h3 class="display-6 fw-bold mb-0"><?= $kursi_sekarang ?> <span
                                    class="fs-6 fw-normal text-secondary">/ <?= $kapasitas_kursi ?></span></h3>
                        </div>
                    </div>
                    <!-- TOMBOL SET KAPASITAS (POP UP) -->
                    <button type="button" class="btn btn-outline-primary btn-pill" data-bs-toggle="modal" data-bs-target="#modalSetKapasitas">
                        <i class="bi bi-gear-wide me-1"></i> Set Kapasitas
                    </button>
                </div>
            </div>
            <div class="col-md-6">
                <div class="glass-card p-4 d-flex align-items-center">
                    <div class="bg-warning bg-opacity-10 p-3 rounded-4 me-3">
                        <i class="bi bi-table fs-1 text-warning"></i>
                    </div>
                    <div>
                        <span class="text-secondary-emphasis text-uppercase small fw-semibold">Ketersediaan Meja</span>
                        <h3 class="display-6 fw-bold mb-0"><?= $meja_sekarang ?> <span
                                class="fs-6 fw-normal text-secondary">/ <?= $kapasitas_meja ?></span></h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2 KARTU FUNGSI ASLI (Pengunjung Datang & Tutup Hari) - Set Kapasitas SUDAH DIPINDAH KE MODAL -->
        <div class="row g-4 mb-5">
            <!-- Pengunjung Datang -->
            <div class="col-md-6">
                <div class="glass-card p-4 h-100">
                    <div class="card-title d-flex align-items-center mb-4">
                        <i class="bi bi-people-fill fs-3 me-2" style="color: #dc3545;"></i>
                        <h5 class="fw-semibold mb-0">Pengunjung Datang</h5>
                    </div>
                    <form method="POST">
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-transparent border-end-0"><i
                                    class="bi bi-person-down"></i></span>
                            <input type="number" name="kurang_kursi" class="form-control border-start-0 rounded-end-3"
                                placeholder="Kursi Dipakai">
                        </div>
                        <div class="input-group mb-4">
                            <span class="input-group-text bg-transparent border-end-0"><i
                                    class="bi bi-layout-text-sidebar-reverse"></i></span>
                            <input type="number" name="kurang_meja" class="form-control border-start-0 rounded-end-3"
                                placeholder="Meja Dipakai">
                        </div>
                        <button name="kurangi" class="btn btn-danger w-100 btn-pill">
                            <i class="bi bi-dash-circle me-2"></i>Kurangi Stok
                        </button>
                    </form>
                </div>
            </div>
            <!-- Tutup Hari (Restok) -->
            <div class="col-md-6">
                <div class="glass-card p-4 h-100 d-flex flex-column">
                    <div class="card-title d-flex align-items-center mb-4">
                        <i class="bi bi-moon-stars fs-3 me-2" style="color: #198754;"></i>
                        <h5 class="fw-semibold mb-0">Tutup Hari</h5>
                    </div>
                    <div class="flex-grow-1 d-flex align-items-center">
                        <form method="POST" class="w-100">
                            <button name="reset_harian" class="btn btn-success w-100 btn-pill py-3">
                                <i class="bi bi-arrow-repeat me-2"></i>Restok Otomatis (Manual)
                            </button>
                            <p class="text-muted small mt-3 mb-0 text-center">
                                <i class="bi bi-clock-history"></i> Restok otomatis terjadwal: <br>
                                Senin–Kamis 16:00 WIB | Jumat–Sabtu 15:00 WIB
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- ========== FITUR BARU: MEETING ROOM (2026 FRESH) ========== -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="glass-card p-4 p-xl-5"
                    style="background: linear-gradient(105deg, rgba(255,255,255,0.8) 0%, rgba(255,255,255,0.95) 100%);">
                    <div class="row align-items-center">
                        <div class="col-lg-6 mb-4 mb-lg-0">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <span class="bg-dark bg-opacity-10 p-3 rounded-4">
                                    <i class="bi bi-door-open fs-1" style="color: #0b2b40;"></i>
                                </span>
                                <div>
                                    <h4 class="fw-bold mb-1">Meeting Room Status</h4>
                                    <p class="text-secondary mb-0">Kelola ketersediaan ruang rapat utama</p>
                                </div>
                            </div>
                            <div class="mt-4">
                                <span class="text-secondary-emphasis small fw-semibold">Status saat ini</span>
                                <div class="d-flex align-items-center mt-2">
                                    <?php if ($meeting_status == 'tersedia'): ?>
                                        <span
                                            class="status-badge bg-success bg-opacity-10 text-success border border-success border-opacity-25">
                                            <i class="bi bi-check-circle-fill"></i> Tersedia
                                        </span>
                                    <?php else: ?>
                                        <span
                                            class="status-badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25">
                                            <i class="bi bi-x-circle-fill"></i> Tidak Tersedia
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="bg-light bg-opacity-50 p-4 rounded-5">
                                <form method="POST" class="meeting-toggle">
                                    <label class="fw-semibold mb-3 d-block text-secondary"><i
                                            class="bi bi-sliders2 me-2"></i>Ubah status ruangan</label>
                                    <div class="d-flex flex-wrap gap-3">
                                        <!-- Tersedia option -->
                                        <input type="radio" class="btn-check" name="meeting_status"
                                            id="meeting_available" value="tersedia" <?= $meeting_status == 'tersedia' ? 'checked' : '' ?>>
                                        <label class="btn btn-outline-success rounded-pill px-4 py-2"
                                            for="meeting_available">
                                            <i class="bi bi-check-circle me-1"></i> Tersedia
                                        </label>
                                        <!-- Tidak Tersedia option -->
                                        <input type="radio" class="btn-check" name="meeting_status"
                                            id="meeting_unavailable" value="tidak tersedia" <?= $meeting_status == 'tidak tersedia' ? 'checked' : '' ?>>
                                        <label class="btn btn-outline-danger rounded-pill px-4 py-2"
                                            for="meeting_unavailable">
                                            <i class="bi bi-x-circle me-1"></i> Tidak Tersedia
                                        </label>
                                        <!-- Tombol Simpan -->
                                        <button type="submit" name="update_meeting"
                                            class="btn btn-dark rounded-pill px-5 py-2 ms-auto">
                                            <i class="bi bi-check2-circle me-1"></i> Simpan
                                        </button>
                                    </div>
                                    <p class="text-muted small mt-3 mb-0">
                                        <i class="bi bi-info-circle"></i> Tampilan akan langsung diperbarui setelah
                                        menyimpan.
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- FOOTER SIMPLE -->
        <div class="text-center text-muted small mt-5">
            <i class="bi bi-dot"></i> Admin TRASA – fresh 2026 edition <i class="bi bi-dot"></i>
        </div>
    </div>

    <!-- ========== MODAL POP UP SET KAPASITAS ========== -->
    <div class="modal fade" id="modalSetKapasitas" tabindex="-1" aria-labelledby="modalSetKapasitasLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-5 border-0 shadow-lg">
                <div class="modal-header border-0 pt-4 px-4">
                    <h5 class="modal-title fw-bold" id="modalSetKapasitasLabel">
                        <i class="bi bi-gear-wide me-2" style="color: #0d6efd;"></i>Set Kapasitas Ruangan
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4 pb-4">
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label fw-medium text-secondary">Jumlah Kursi</label>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-end-0"><i class="bi bi-person-workspace"></i></span>
                                <input type="number" name="total_kursi" class="form-control border-start-0 rounded-end-3" placeholder="Contoh: 20" required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-medium text-secondary">Jumlah Meja</label>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-end-0"><i class="bi bi-table"></i></span>
                                <input type="number" name="total_meja" class="form-control border-start-0 rounded-end-3" placeholder="Contoh: 10" required>
                            </div>
                        </div>
                        <div class="d-grid">
                            <button type="submit" name="simpan_utama" class="btn btn-primary btn-pill py-2">
                                <i class="bi bi-save me-2"></i>Simpan Kapasitas
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script agar scroll tetap di posisi setelah refresh -->
    <script>
        (function () {
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', function () {
                    localStorage.setItem('scrollPosition', window.scrollY);
                });
            });

            window.addEventListener('load', function () {
                const scrollPos = localStorage.getItem('scrollPosition');
                if (scrollPos !== null) {
                    window.scrollTo(0, parseInt(scrollPos));
                    localStorage.removeItem('scrollPosition');
                }
            });
        })();
    </script>
</body>

</html>