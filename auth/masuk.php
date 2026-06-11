<?php 
session_start(); 
if (isset($_SESSION['id_pelanggan'])) {
    header("Location: ../produk.php");
    exit;
}

$saved_username = isset($_COOKIE['remember_username']) ? $_COOKIE['remember_username'] : '';
$is_register = isset($_GET['view']) && $_GET['view'] == 'register';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Masuk / Daftar - Olin's Cake</title>
    <?php include '../includes/header.php'; ?>
    <style type="text/tailwindcss">
        @layer utilities {
            .bg-doodle-pattern {
                background-image: radial-gradient(circle at 20px 20px, #e3beb8 2px, transparent 2px), radial-gradient(circle at 60px 60px, #e3beb8 2px, transparent 2px);
                background-size: 80px 80px;
                opacity: 0.4;
            }
        }
    </style>
</head>
<body class="bg-surface-warm min-h-screen flex items-center justify-center relative font-body-md text-on-surface antialiased p-4 sm:p-8 md:p-margin-desktop overflow-x-hidden">

<div class="fixed inset-0 z-0 pointer-events-none overflow-hidden">
    <div class="absolute inset-0 bg-doodle-pattern opacity-40"></div>
    <div class="absolute -top-[20%] -left-[10%] w-[50%] h-[50%] bg-tertiary-fixed rounded-full mix-blend-multiply filter blur-[100px] opacity-30"></div>
    <div class="absolute -bottom-[20%] -right-[10%] w-[50%] h-[50%] bg-brownie-bg rounded-full mix-blend-multiply filter blur-[100px] opacity-30"></div>
</div>

<main class="w-full max-w-[1200px] bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant flex flex-col md:flex-row relative z-10 overflow-hidden my-4 sm:my-8 transition-all duration-300">
    
    <div class="w-full md:w-1/2 px-6 py-6 sm:px-10 sm:py-8 md:px-16 md:py-10 lg:px-24 lg:py-12 flex flex-col justify-center relative">
        
        <div class="mb-8 flex justify-between items-center">
            <a href="../index.php" class="inline-flex items-center gap-2 text-on-surface-variant hover:text-primary transition-colors font-label-bold text-sm">
                <span class="material-symbols-outlined" style="font-size: 18px;">arrow_back</span>
                Kembali
            </a>
            <span class="md:hidden font-display-md text-xl text-primary tracking-tight">Olin's Cake.</span>
        </div>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="mb-6 px-4 py-3 bg-error-container text-on-error-container rounded-lg flex items-center gap-3 font-label-bold">
                <span class="material-symbols-outlined">error</span>
                <?= $_SESSION['error'] ?>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="mb-6 px-4 py-3 bg-[#e8f5e9] text-[#2e7d32] rounded-lg flex items-center gap-3 font-label-bold">
                <span class="material-symbols-outlined">check_circle</span>
                <?= $_SESSION['success'] ?>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <div class="flex-col w-full max-w-md mx-auto transition-opacity duration-300 <?= $is_register ? 'hidden opacity-0' : 'flex opacity-100' ?>" id="view-login">
            <div class="mb-6">
                <div class="inline-flex items-center gap-2 bg-tertiary-fixed text-on-tertiary-fixed px-4 py-2 rounded-full font-label-bold text-label-bold -rotate-2 mb-4 shadow-sm border border-outline-variant">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1; font-size: 16px;">cake</span>
                    Welcome to Olin's Cake
                </div>
                <h1 class="font-headline-lg-mobile md:font-headline-lg text-headline-lg-mobile md:text-headline-lg text-on-surface mb-2">Masuk ke Akun</h1>
                <p class="font-body-md text-body-md text-on-surface-variant">Senang melihat Anda kembali. Silakan masuk untuk memesan kue favorit Anda.</p>
            </div>
            <form action="proses_masuk.php" method="POST" class="space-y-6">
                <div>
                    <label class="block font-label-bold text-label-bold text-on-surface mb-2" for="login-username">Username atau Email</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-on-surface-variant">
                            <span class="material-symbols-outlined">person</span>
                        </span>
                        <input class="w-full pl-12 pr-4 py-3 bg-surface border border-outline-variant rounded-DEFAULT focus:ring-2 focus:ring-tertiary-container focus:border-tertiary-container transition-all text-body-md outline-none" id="login-username" name="nama_pengguna" placeholder="Masukkan username Anda" type="text" required value="<?= htmlspecialchars($saved_username) ?>"/>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label class="block font-label-bold text-label-bold text-on-surface" for="login-password">Password</label>
                    </div>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-on-surface-variant">
                            <span class="material-symbols-outlined">lock</span>
                        </span>
                        <input class="w-full pl-12 pr-4 py-3 bg-surface border border-outline-variant rounded-DEFAULT focus:ring-2 focus:ring-tertiary-container focus:border-tertiary-container transition-all text-body-md outline-none" id="login-password" name="password" placeholder="••••••••" type="password" required/>
                    </div>
                </div>
                <div class="flex items-center mt-4">
                    <input type="checkbox" id="remember_me" name="remember_me" class="w-4 h-4 text-tertiary bg-surface border-outline-variant rounded focus:ring-tertiary" <?= $saved_username ? 'checked' : '' ?>>
                    <label for="remember_me" class="ml-2 font-body-md text-on-surface-variant">Ingat Nama Pengguna Saya</label>
                </div>
                <button class="w-full bg-primary text-on-primary py-4 rounded-full font-label-bold text-label-bold hover:bg-inverse-surface transition-transform hover:-translate-y-1 duration-200 border-[1.5px] border-primary shadow-sm mt-4" type="submit">
                    Masuk
                </button>
            </form>
            <p class="mt-6 text-center font-body-md text-body-md text-on-surface-variant">
                Belum punya akun? 
                <button class="font-label-bold text-label-bold text-primary border-b-2 border-tertiary-container pb-0.5 hover:text-tertiary transition-colors ml-1" onclick="toggleView('register')">Daftar sekarang</button>
            </p>
        </div>

        <div class="flex-col w-full max-w-md mx-auto transition-opacity duration-300 <?= $is_register ? 'flex opacity-100' : 'hidden opacity-0' ?>" id="view-register">
            <div class="mb-6">
                <div class="inline-flex items-center gap-2 bg-nastar-bg text-on-tertiary-fixed px-4 py-2 rounded-full font-label-bold text-label-bold rotate-2 mb-4 shadow-sm border border-outline-variant">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1; font-size: 16px;">celebration</span>
                    Join the Family
                </div>
                <h1 class="font-headline-lg-mobile md:font-headline-lg text-headline-lg-mobile md:text-headline-lg text-on-surface mb-2">Daftar Akun Baru</h1>
                <p class="font-body-md text-body-md text-on-surface-variant">Lengkapi data di bawah ini untuk mulai memesan karya artisan kami.</p>
            </div>
            <form action="proses_daftar.php" method="POST" class="space-y-4">
                <div>
                    <label class="block font-label-bold text-label-bold text-on-surface mb-1.5" for="reg-name">Nama Lengkap</label>
                    <input class="w-full px-4 py-3 bg-surface border border-outline-variant rounded-DEFAULT focus:ring-2 focus:ring-tertiary-container focus:border-tertiary-container transition-all text-body-md outline-none" id="reg-name" name="nama_lengkap" placeholder="Nama Anda" type="text" required/>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-label-bold text-label-bold text-on-surface mb-1.5" for="reg-username">Username</label>
                        <input class="w-full px-4 py-3 bg-surface border border-outline-variant rounded-DEFAULT focus:ring-2 focus:ring-tertiary-container focus:border-tertiary-container transition-all text-body-md outline-none" id="reg-username" name="nama_pengguna" placeholder="@username" type="text" required/>
                    </div>
                    <div>
                        <label class="block font-label-bold text-label-bold text-on-surface mb-1.5" for="reg-wa">No. WhatsApp</label>
                        <input class="w-full px-4 py-3 bg-surface border border-outline-variant rounded-DEFAULT focus:ring-2 focus:ring-tertiary-container focus:border-tertiary-container transition-all text-body-md outline-none" id="reg-wa" name="nomor_whatsapp" placeholder="08..." type="tel" required/>
                    </div>
                </div>
                <div>
                    <label class="block font-label-bold text-label-bold text-on-surface mb-1.5" for="reg-password">Password</label>
                    <input class="w-full px-4 py-3 bg-surface border border-outline-variant rounded-DEFAULT focus:ring-2 focus:ring-tertiary-container focus:border-tertiary-container transition-all text-body-md outline-none" id="reg-password" name="password" placeholder="••••••••" type="password" minlength="8" required/>
                </div>
                <div>
                    <label class="block font-label-bold text-label-bold text-on-surface mb-1.5" for="konfirmasi_password">Konfirmasi Password</label>
                    <input class="w-full px-4 py-3 bg-surface border border-outline-variant rounded-DEFAULT focus:ring-2 focus:ring-tertiary-container focus:border-tertiary-container transition-all text-body-md outline-none" id="konfirmasi_password" name="konfirmasi_password" placeholder="••••••••" type="password" minlength="8" required/>
                </div>
                <button class="w-full bg-tertiary text-on-tertiary py-4 rounded-full font-label-bold text-label-bold hover:bg-on-tertiary-container transition-transform hover:-translate-y-1 duration-200 border-[1.5px] border-tertiary shadow-sm mt-6" type="submit">
                    Daftar
                </button>
            </form>
            <p class="mt-4 text-center font-body-md text-body-md text-on-surface-variant">
                Sudah punya akun? 
                <button class="font-label-bold text-label-bold text-primary border-b-2 border-tertiary-container pb-0.5 hover:text-tertiary transition-colors ml-1" onclick="toggleView('login')">Masuk di sini</button>
            </p>
        </div>

    </div>

    <div class="hidden md:flex md:w-1/2 bg-surface-container-high relative overflow-hidden items-center justify-center">
        <div class="absolute top-12 left-12 z-20">
            <span class="font-display-md text-display-md text-surface-container-lowest drop-shadow-md">Olin's Cake.</span>
        </div>
        <img class="w-full h-full object-cover absolute inset-0 z-10" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB6n4b2-GmCJWzgP5lRe-gPVjn4enA2EoHqZ_KwL9CUijTLbem9Onm4zC11fviCxPelkqaSH9C_HqiCqCQkTjbAEs-gOtR_rFJIrU0spIZD9OyU7Kve6bVxhz-nx0rVn0Nen7zj3pLyyHxg4HrMK-kPikRe6CZ5gZvSjrbMhooFevGs6EajrdcohvBl0_8zbe8vo_P88aVzt7VA3W0iBpwLUl9LZ-NNbOslIHyrPd4SsKfF4Ou2F_jZ6gM2f2OxUJXhmlVp9IpeE3C_"/>
        <div class="absolute inset-0 bg-gradient-to-t from-primary-container/40 to-transparent z-10"></div>
    </div>

</main>

<script>
    function toggleView(target) {
        const loginView = document.getElementById('view-login');
        const registerView = document.getElementById('view-register');
        
        if (target === 'register') {
            loginView.style.opacity = '0';
            setTimeout(() => {
                loginView.classList.add('hidden');
                loginView.classList.remove('flex');
                
                registerView.classList.remove('hidden');
                registerView.classList.add('flex');
                
                void registerView.offsetWidth;
                registerView.style.opacity = '1';
            }, 300);

        } else {
            registerView.style.opacity = '0';
            setTimeout(() => {
                registerView.classList.add('hidden');
                registerView.classList.remove('flex');
                
                loginView.classList.remove('hidden');
                loginView.classList.add('flex');
                
                void loginView.offsetWidth;
                loginView.style.opacity = '1';
            }, 300);
        }
    }
</script>
</body>
</html>
