<?php
// index.php → TRASA Coworking Space - Simplified Version + Auto Tour 5 Detik
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TRASA Coworking Space | Ruang Kerja Premium & Inspiratif</title>

    <!-- SEO Meta Tags -->
    <meta name="description"
        content="TRASA Coworking Space Tegal - Ruang kerja modern dengan fasilitas lengkap untuk freelancer, startup, dan profesional.">
    <meta name="keywords" content="coworking space tegal, ruang kerja modern, workspace premium">
    <meta name="author" content="TRASA Coworking Space">

    <!-- Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Swiper.js -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- CSS Custom -->
    <link rel="stylesheet" href="../css/index.css">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/logo-coworking.png">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-modern fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <div class="brand-container">
                    <img src="../assets/logo coworking.png" alt="TRASA Logo" class="brand-logo">
                    <div class="brand-text">
                        <span class="brand-name">TRASA</span>
                        <span class="brand-tagline">COWORKING SPACE</span>
                    </div>
                </div>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="event.php">Event</a></li>
                    <li class="nav-item"><a class="nav-link" href="location.php">Location</a></li>
                </ul>

                <div class="navbar-actions">
                    <a href="https://wa.me/6285134605295" target="_blank" class="btn btn-modern-primary">
                        <i class="fab fa-whatsapp me-2"></i>
                        Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-modern">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6" data-aos="fade-up">
                    <div class="hero-badge">
                        <i class="fas fa-bolt"></i>
                        <span>KREATIF • INOVATIF • KOLABORASI</span>
                    </div>

                    <h1 class="hero-title">
                        <span class="title-main">TRASA COWORKING SPACE</span>
                    </h1>


                    <p style="text-align: justify;" class="hero-description">
                        Kami menghadirkan ekosistem kerja masa depan yang mengintegrasikan teknologi, kenyamanan, dan
                        kolaborasi dalam satu ruang inspiratif.
                    </p>


                    <div class="hero-cta">
                        <a class="btn btn-hero-primary">
                            <i class="fas fa-rocket me-2"></i>
                            kontak
                        </a>
                        <a href="javascript:void(0)" id="btnKontakHero" class="btn btn-hero-outline">
                            <i class="fas fa-play-circle me-2"></i>
                            Virtual Tour
                        </a>
                    </div>
                </div>

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="hero-visual">
                        <div class="visual-main">
                            <img src="../assets/Gedung Coworking.jpeg" alt="TRASA Modern Space" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Digital Features (Gambar 2) -->
    <section class="digital-features" id="features">
        <!-- isi sama persis seperti kode asli kamu -->
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <span class="section-badge">
                    <i class="fas fa-microchip"></i>
                    COWORKING
                </span>
                <h2 class="section-title">
                    Fasilitas Lengkap untuk <span class="text-gradient">Produktivitas Maksimal</span>
                </h2>
                <p class="section-subtitle">
                    Ruang kerja yang dirancang khusus untuk kebutuhan era digital
                </p>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-card-modern">
                        <div class="feature-icon-modern">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <h4>Network</h4>
                        <p>Ayo kerja lebih fokus di Ruang Kerja Kreatif kami—tempat nyaman dengan WiFi cepat, suasana
                            inspiratif, dan fasilitas lengkap untuk mendukung produktivitas Anda.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-card-modern">
                        <div class="feature-icon-modern">
                            <i class="fas fa-video"></i>
                        </div>
                        <h4>Meeting Rooms</h4>
                        <p>Ayo nikmati pengalaman rapat yang lebih nyaman di Meeting Room kami—ruang sejuk ber-AC, mampu
                            menampung banyak peserta, dan dilengkapi smart TV untuk presentasi yang lebih jelas.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-card-modern">
                        <div class="feature-icon-modern">
                            <i class="fas fa-cloud"></i>
                        </div>
                        <h4>Area Parkir</h4>
                        <p>Ruang parkir yang luas dan aman, memudahkan Anda menempuh aktivitas tanpa repot mencari
                            tempat parkir. Cocok untuk mobil dan motor, tersedia akses mudah langsung ke area utama.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="feature-card-modern">
                        <div class="feature-icon-modern">
                            <i class="fas fa-robot"></i>
                        </div>
                        <h4>RUANG KERJA KREATIF</h4>
                        <p>Ayo produktif di Ruang Kerja Kreatif kami! Tempat nyaman dan inspiratif dengan fasilitas
                            lengkap yang dirancang untuk membantu Anda berkarya, berkolaborasi, dan mewujudkan ide-ide
                            terbaik.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Interactive Gallery (Gambar 3) -->
    <section class="interactive-gallery" id="tour">
        <!-- isi sama persis -->
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <span class="section-badge">
                    <i class="fas fa-vr-cardboard"></i>
                    Interactive Tour
                </span>
                <h2 class="section-title">
                    Experience Our <span class="text-gradient">Digital Environment</span>
                </h2>
            </div>
            <div class="gallery-container">
                <div class="swiper interactiveSwiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="gallery-item">
                                <img src="../assets/Ruang Kerja.jpeg" alt="Digital Workspace">
                                <div class="gallery-overlay">
                                    <h3>Ruang Kerja Kreatif</h3>
                                    <p>Ruangan bekerja yang nyaman</p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="gallery-item">
                                <img src="../assets/Tempat Meating.jpeg" alt="Smart Meeting">
                                <div class="gallery-overlay">
                                    <h3>Meeting Room</h3>
                                    <p>Ruang untung rapat atau ada komunitas</p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="gallery-item">
                                <img src="../assets/Ruang Tamu.jpeg" alt="Creative Lounge">
                                <div class="gallery-overlay">
                                    <h3>Lobby</h3>
                                    <p>Tempat untuk kunjungan tamu</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </section>



    <!-- Tech Testimonials (Gambar 5) -->
    <section class="tech-testimonials" id="testimonials">
        <!-- isi sama persis -->
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <span class="section-badge">
                    <i class="fas fa-comment-dots"></i>
                    Ulasan Pengunjung
                </span>
                <h2 class="section-title">
                    Ulasan Dari <span class="text-gradient">Para Pengunjung</span>
                </h2>
            </div>
            <div class="testimonials-grid">
                <div class="testimonial-card-tech" data-aos="fade-up" data-aos-delay="100">
                    <div class="testimonial-header">
                        <div class="testimonial-info">
                            <h4>Septiani Dwi Saniyah</h4>
                            <p>Local Guide • 38 Ulasan</p>
                        </div>
                        <div class="testimonial-rating">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="testimonial-text">
                        " Tempat belajar dan kerjaa. Ngapunten kak klo siang panas bangett AC nya klo bsa d nyalain smua
                        hehehe "
                    </p>
                </div>
                <div class="testimonial-card-tech" data-aos="fade-up" data-aos-delay="200">
                    <div class="testimonial-header">
                        <div class="testimonial-info">
                            <h4>Imam Nazarudin</h4>
                            <p>Local Guide • 32 Ulasan</p>
                        </div>
                        <div class="testimonial-rating">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="testimonial-text">
                        " Tempat yang sangat nyaman, kondusif & akses wifi yg memadai Rekomendasi buat yg butuh tempat
                        kerja, belajar, maupun mengerjakan tugas-tugas "
                    </p>
                </div>
                <div class="testimonial-card-tech" data-aos="fade-up" data-aos-delay="300">
                    <div class="testimonial-header">
                        <div class="testimonial-info">
                            <h4>nadia utami</h4>
                            <p>Local Guide • 117 Ulasan</p>
                        </div>
                        <div class="testimonial-rating">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="testimonial-text">
                        " Tempat nyaman, fasilitas oke punya, penjaga juga baik, full time pula, cuma kadang jam tutup
                        suka berubah tergantung penjaga mungkin dan kursi terbatas (karena covid mungkin juga) "
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Modern -->
    <section class="cta-modern" id="booking">
        <div class="container">
            <div class="cta-content" data-aos="fade-up">
                <h2>Booking <span class="">Ruang Meeting</span> </h2>
                <p>Ruang meeting kami siap menemani diskusi produktif Anda. Nyaman, privat, dan dilengkapi fasilitas
                    lengkap. Booking sekarang juga!</p>

            </div>
        </div>
    </section>

    <!-- Footer (tetap persis sama) -->
    <footer class="footer-modern">
        <div class="container">
            <!-- semua isi footer kamu tetap 100% sama -->
            <div class="footer-main">
                <div class="row gy-5">
                    <div class="col-lg-4 col-md-6">
                        <div class="footer-brand">
                            <div class="footer-logo-container">
                                <img src="../assets/trasa-removebg-preview.png" alt="TRASA Logo" class="footer-logo">
                            </div>
                            <div>
                                <p class="footer-description">
                                    Pioneering digital workspace solutions for the next generation of creators,
                                    innovators, and entrepreneurs.
                                </p>
                                <div class="footer-social">
                                    <a href="https://wa.me/6285134605295" target="_blank" class="social-icon whatsapp">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                    <a href="https://www.instagram.com/coworkingtegal" target="_blank"
                                        class="social-icon instagram">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <h4 class="footer-title">Quick Links</h4>
                        <ul class="footer-links">
                            <li><a href="index.php">Home</a></li>
                            <li><a href="about.php">About Us</a></li>
                            <li><a href="event.php">Event</a></li>
                            <li><a href="location.php">Location</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-2 col-md-6">
                        <h4 class="footer-title">Event Categories</h4>
                        <ul class="footer-links">
                            <li><a>Workshop</a></li>
                            <li><a>Networking</a></li>
                            <li><a>Seminar</a></li>
                            <li><a>Community</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <h4 class="footer-title">Event Information</h4>
                        <div class="footer-contact">
                            <div class="contact-item">
                                <i class="fas fa-calendar-check"></i>
                                <div>
                                    <span>Event Registration</span>
                                    <small>Via WhatsApp atau langsung ke tempat</small>
                                </div>
                            </div>
                            <div class="contact-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <div>
                                    <span>Jl. Jenderal Ahmad Yani No.43</span>
                                    <small>Slawi, Tegal, Jawa Tengah 52411</small>
                                </div>
                            </div>
                            <div class="contact-item">
                                <i class="fas fa-phone-alt"></i>
                                <div>
                                    <span>+62851 3460 5295</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="row align-items-center">
                    <div class="col-12 text-center">
                        <p class="copyright">
                            © 2025 <span class="highlight">TRASA Coworking Space</span>. All rights reserved.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top -->
    <button id="backToTop" class="back-to-top">
        <i class="fas fa-chevron-up"></i>
    </button>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        // AOS Animation
        AOS.init({
            duration: 800,
            once: true
        });

        // Navbar Scroll Effect
        window.addEventListener('scroll', function () {
            const navbar = document.querySelector('.navbar-modern');
            const backToTop = document.getElementById('backToTop');
            if (window.scrollY > 100) {
                navbar.classList.add('scrolled');
                backToTop.classList.add('visible');
            } else {
                navbar.classList.remove('scrolled');
                backToTop.classList.remove('visible');
            }
        });

        // Interactive Swiper
        new Swiper('.interactiveSwiper', {
            loop: true,
            slidesPerView: 1,
            spaceBetween: 20,
            speed: 600,
            autoplay: { delay: 5000 },
            pagination: { el: '.swiper-pagination', clickable: true },
            breakpoints: {
                768: { slidesPerView: 2 },
                1200: { slidesPerView: 3 }
            }
        });

        // Back to Top
        document.getElementById('backToTop').addEventListener('click', function () {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        // === FUNGSI SCROLL DENGAN OFFSET BIAR TIDAK KEPOTONG NAVBAR ===
        function scrollKeSection(selector, delay = 0) {
            setTimeout(() => {
                const element = document.querySelector(selector);
                if (element) {
                    const navbarHeight = document.querySelector('.navbar-modern').offsetHeight;
                    const yOffset = -navbarHeight - -30; // -20 biar ada jarak sedikit lagi ke atas
                    const y = element.getBoundingClientRect().top + window.pageYOffset + yOffset;

                    window.scrollTo({
                        top: y,
                        behavior: 'smooth'
                    });
                }
            }, delay);
        }

        // === AUTO TOUR YANG SUDAH DIPERBAIKI (tidak terpotong lagi) ===
        function mulaiTour() {
            // 1. Fasilitas
            scrollKeSection('#features', 0);

            // 2. Interactive Tour (5 detik)
            scrollKeSection('#tour', 5000);

            // 3. Community / Joko Prabowo (10 detik)
            scrollKeSection('#community', 10000);

            // 4. Ulasan Pengunjung (15 detik)
            scrollKeSection('#testimonials', 15000);

            // 5. Buka WhatsApp (20 detik)
            setTimeout(() => {
                window.location.href = 'about.php';
            }, 20000);
        }

        // Trigger tour dari semua tombol kontak
        document.getElementById('btnHubungiNavbar')?.addEventListener('click', mulaiTour);
        document.getElementById('btnKontakHero')?.addEventListener('click', mulaiTour);
        document.getElementById('btnKontakCTA')?.addEventListener('click', mulaiTour);

        // Smooth scroll manual (jika user klik link biasa)
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (href.startsWith('#') && href.length > 1) {
                    e.preventDefault();
                    scrollKeSection(href, 0);
                }
            });
        });
    </script>
</body>

</html>