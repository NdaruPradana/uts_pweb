<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Mahasiswa | Home</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
 
        .hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 100px 0;
            text-align: center;
        }
        
        .hero h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
            font-weight: 700;
        }
        
        .hero p {
            font-size: 1.25rem;
            opacity: 0.95;
            margin-bottom: 2rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .hero-buttons {
            display: flex;
            justify-content: center;
            gap: 1rem;
            flex-wrap: wrap;
        }
        
        .btn-outline-light {
            background: transparent;
            border: 2px solid white;
            color: white;
        }
        
        .btn-outline-light:hover {
            background: white;
            color: #667eea;
            transform: translateY(-2px);
        }
        
        .features {
            padding: 80px 0;
            background: var(--light);
        }
        
        .section-title {
            text-align: center;
            font-size: 2rem;
            margin-bottom: 3rem;
            color: var(--dark);
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .feature-card {
            background: white;
            padding: 2rem;
            border-radius: var(--radius);
            text-align: center;
            box-shadow: var(--shadow-sm);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow);
        }
        
        .feature-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        
        .feature-card h3 {
            margin-bottom: 1rem;
            color: var(--primary);
        }
        
        .feature-card p {
            color: var(--gray);
            line-height: 1.6;
        }
        
        .cta-section {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: 60px 0;
            text-align: center;
        }
        
        .cta-section h2 {
            font-size: 2rem;
            margin-bottom: 1rem;
        }
        
        .cta-section p {
            margin-bottom: 2rem;
            opacity: 0.9;
        }
        
        .cta-section .btn-primary {
            background: white;
            color: var(--primary);
        }
        
        .cta-section .btn-primary:hover {
            background: var(--light);
            transform: translateY(-2px);
        }
        
        .footer {
            background: var(--dark);
            color: white;
            text-align: center;
            padding: 30px 0;
        }
        
        .footer p {
            margin: 0;
            opacity: 0.8;
        }
        
        @media (max-width: 768px) {
            .hero {
                padding: 60px 0;
            }
            
            .hero h1 {
                font-size: 2rem;
            }
            
            .hero p {
                font-size: 1rem;
                padding: 0 20px;
            }
            
            .hero-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .hero-buttons .btn {
                width: 200px;
            }
            
            .section-title {
                font-size: 1.5rem;
            }
            
            .features-grid {
                grid-template-columns: 1fr;
                padding: 0 20px;
            }
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="navbar-container">
            <a href="index.php" class="navbar-brand">📚 Sistem Manajemen Mahasiswa</a>
            <div class="navbar-menu">
                <a href="index.php">Beranda</a>
                <a href="auth/login.php">Login</a>
                <a href="auth/register.php">Daftar</a>
            </div>
        </div>
    </nav>


    <section class="hero">
        <div class="container">
            <h1>Kelola Data Mahasiswa<br>dengan Mudah dan Cepat</h1>
            <p>Sistem manajemen mahasiswa berbasis web dengan fitur lengkap dan tampilan yang modern & responsif.</p>
            <div class="hero-buttons">
                <a href="auth/login.php" class="btn btn-primary">🔐 Login Sekarang</a>
                <a href="auth/register.php" class="btn btn-outline-light">📝 Daftar Akun</a>
            </div>
        </div>
    </section>


    <section class="features">
        <div class="container">
            <h2 class="section-title">✨ Fitur Unggulan</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">🔐</div>
                    <h3>Autentikasi Aman</h3>
                    <p>Sistem login dan register dengan password hashing (bcrypt) untuk keamanan akun pengguna.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📋</div>
                    <h3>CRUD Lengkap</h3>
                    <p>Kelola data mahasiswa dengan fitur Create, Read, Update, dan Delete yang mudah digunakan.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🔍</div>
                    <h3>Pencarian Data</h3>
                    <p>Cari data mahasiswa dengan cepat berdasarkan NIM atau Nama Mahasiswa.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📊</div>
                    <h3>Dashboard Statistik</h3>
                    <p>Lihat ringkasan data dan statistik langsung dari halaman dashboard utama.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📱</div>
                    <h3>Responsif Modern</h3>
                    <p>Tampilan yang responsif dan dapat diakses dari berbagai perangkat (desktop, tablet, mobile).</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🛡️</div>
                    <h3>Keamanan Terjamin</h3>
                    <p>Menggunakan prepared statements untuk mencegah SQL Injection dan XSS attacks.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="cta-section">
        <div class="container">
            <h2>Siap Mengelola Data Mahasiswa?</h2>
            <p>Daftar sekarang dan rasakan kemudahan mengelola data mahasiswa.</p>
            <a href="auth/register.php" class="btn btn-primary">📝 Daftar Sekarang</a>
        </div>
    </section>


    <footer class="footer">
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> Sistem Manajemen Mahasiswa. Dibangun untuk Tugas Besar Pemrograman Web.</p>
            <p style="margin-top: 10px; font-size: 0.875rem;">Menggunakan PHP Native & MySQL | UTS Pemrograman Web</p>
        </div>
    </footer>
</body>
</html>