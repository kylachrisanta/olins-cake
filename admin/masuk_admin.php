<?php
session_start();
if (isset($_SESSION['status_login_admin']) && $_SESSION['status_login_admin'] === true) {
    header("Location: dasbor_admin.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Portal Admin - Olin's Cake</title>
    <?php include '../includes/header.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

<main class="w-full max-w-[1200px] bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant flex flex-col md:flex-row relative z-10 overflow-hidden my-4 sm:my-8">
    
    <div class="w-full md:w-1/2 px-6 py-6 sm:px-10 sm:py-8 md:px-16 md:py-10 lg:px-24 lg:py-12 flex flex-col justify-center relative">
        
        <div class="mb-8 flex justify-between items-center">
            <a href="../index.php" class="inline-flex items-center gap-2 text-on-surface-variant hover:text-primary transition-colors font-label-bold text-sm">
                <span class="material-symbols-outlined" style="font-size: 18px;">arrow_back</span>
                Kembali ke Web
            </a>
            <span class="md:hidden font-display-md text-xl text-primary tracking-tight">Olin's Cake.</span>
        </div>

        <?php if (isset($_SESSION['error'])): ?>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });
                    Toast.fire({
                        icon: 'error',
                        title: <?= json_encode($_SESSION['error']) ?>
                    });
                });
            </script>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <div class="flex-col w-full max-w-md mx-auto flex opacity-100">
            <div class="mb-6">
                <div class="inline-flex items-center gap-2 bg-error-container text-on-error-container px-4 py-2 rounded-full font-label-bold text-label-bold -rotate-2 mb-4 shadow-sm border border-outline-variant">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1; font-size: 16px;">admin_panel_settings</span>
                    Administrator Portal
                </div>
                <h1 class="font-headline-lg-mobile md:font-headline-lg text-headline-lg-mobile md:text-headline-lg text-on-surface mb-2">Masuk ke Dasbor</h1>
                <p class="font-body-md text-body-md text-on-surface-variant">Sistem manajemen Olin's Cake. Silakan masukkan kredensial Anda.</p>
            </div>
            <form action="proses_masuk_admin.php" method="POST" class="space-y-6">
                <div>
                    <label class="block font-label-bold text-label-bold text-on-surface mb-2" for="login-username">Nama Pengguna</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-on-surface-variant">
                            <span class="material-symbols-outlined">shield_person</span>
                        </span>
                        <input class="w-full pl-12 pr-4 py-3 bg-surface border border-outline-variant rounded-DEFAULT focus:ring-2 focus:ring-tertiary-container focus:border-tertiary-container transition-all text-body-md outline-none" id="login-username" name="nama_pengguna" placeholder="Masukkan username admin" type="text" required autocomplete="off"/>
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
                
                <button class="w-full bg-[#271310] text-white py-4 rounded-full font-label-bold text-label-bold hover:bg-primary transition-transform hover:-translate-y-1 duration-200 border-[1.5px] border-[#271310] shadow-sm mt-8" type="submit">
                    Masuk Sekarang
                </button>
            </form>
            
            <p class="mt-8 text-center font-body-sm text-sm text-on-surface-variant flex items-center justify-center gap-1">
                <span class="material-symbols-outlined text-[16px]">lock</span>
                Portal ini dikhususkan untuk administrator Olin's Cake.
            </p>
        </div>

    </div>

    <div class="hidden md:flex md:w-1/2 bg-surface-container-high relative overflow-hidden items-center justify-center">
        <div class="absolute top-12 left-12 z-20">
            <span class="font-display-md text-display-md text-surface-container-lowest drop-shadow-md">Olin's Cake.</span>
        </div>
        <img class="w-full h-full object-cover absolute inset-0 z-10" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB6n4b2-GmCJWzgP5lRe-gPVjn4enA2EoHqZ_KwL9CUijTLbem9Onm4zC11fviCxPelkqaSH9C_HqiCqCQkTjbAEs-gOtR_rFJIrU0spIZD9OyU7Kve6bVxhz-nx0rVn0Nen7zj3pLyyHxg4HrMK-kPikRe6CZ5gZvSjrbMhooFevGs6EajrdcohvBl0_8zbe8vo_P88aVzt7VA3W0iBpwLUl9LZ-NNbOslIHyrPd4SsKfF4Ou2F_jZ6gM2f2OxUJXhmlVp9IpeE3C_"/>
        <div class="absolute inset-0 bg-gradient-to-t from-[#271310]/80 to-transparent z-10"></div>
    </div>

</main>
</body>
</html>

