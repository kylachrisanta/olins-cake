<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$base_url = '/olinscake/';
?>
<!DOCTYPE html>
<html class="scroll-smooth" lang="id" style="">
<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<title>Olin's Cake - Artisanal Home Bakery</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com" rel="preconnect">
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect">
<link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,700;800&amp;family=Plus+Jakarta+Sans:wght@400;500;700&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-error": "#ffffff",
                        "secondary-fixed-dim": "#c8c6c4",
                        "error": "#ba1a1a",
                        "on-error-container": "#93000a",
                        "tertiary-container": "#cda721",
                        "primary": "#000000",
                        "background": "#fff8f6",
                        "outline-variant": "#d3c3c0",
                        "surface-container-low": "#faf2f0",
                        "nastar-bg": "#FFE087",
                        "tertiary": "#735c00",
                        "on-background": "#1e1b1a",
                        "on-tertiary-fixed": "#231a00",
                        "surface-container-high": "#eee6e5",
                        "surface-tint": "#745753",
                        "secondary-container": "#e1dfdd",
                        "on-surface": "#1e1b1a",
                        "primary-fixed": "#ffdad5",
                        "inverse-on-surface": "#f7efee",
                        "primary-fixed-dim": "#e3beb8",
                        "secondary": "#5e5e5c",
                        "surface-variant": "#e8e1df",
                        "surface": "#fff8f6",
                        "on-primary": "#ffffff",
                        "surface-warm": "#FFF8F6",
                        "secondary-fixed": "#e4e2df",
                        "on-tertiary-fixed-variant": "#574500",
                        "outline": "#827472",
                        "tertiary-fixed": "#ffe087",
                        "surface-container-highest": "#e8e1df",
                        "on-tertiary": "#ffffff",
                        "on-secondary": "#ffffff",
                        "on-tertiary-container": "#4f3e00",
                        "primary-container": "#2b1613",
                        "on-primary-fixed-variant": "#5b403c",
                        "sprinkle-orange": "#FFB74D",
                        "on-secondary-fixed": "#1b1c1a",
                        "surface-container": "#f4eceb",
                        "on-primary-fixed": "#2b1613",
                        "surface-bright": "#fff8f6",
                        "surface-dim": "#e0d8d7",
                        "error-container": "#ffdad6",
                        "tertiary-fixed-dim": "#ebc23d",
                        "on-surface-variant": "#504442",
                        "inverse-primary": "#e3beb8",
                        "on-primary-container": "#9c7c77",
                        "on-secondary-container": "#636361",
                        "on-secondary-fixed-variant": "#474745",
                        "surface-container-lowest": "#ffffff",
                        "brownie-bg": "#FFDAD6",
                        "inverse-surface": "#33302f"
                    },
                    "borderRadius": {
                        "DEFAULT": "1rem",
                        "lg": "2rem",
                        "xl": "3rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "margin-mobile": "20px",
                        "card-padding": "32px",
                        "margin-desktop": "80px",
                        "gutter": "24px",
                        "section-padding": "64px",
                        "unit": "8px"
                    },
                    "fontFamily": {
                        "display-md": ["Bricolage Grotesque"],
                        "body-md": ["Plus Jakarta Sans"],
                        "body-lg": ["Plus Jakarta Sans"],
                        "headline-lg": ["Bricolage Grotesque"],
                        "label-bold": ["Plus Jakarta Sans"],
                        "display-lg": ["Bricolage Grotesque"],
                        "headline-lg-mobile": ["Bricolage Grotesque"]
                    },
                    "fontSize": {
                        "display-md": ["48px", {"lineHeight": "56px", "letterSpacing": "-0.01em", "fontWeight": "800"}],
                        "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                        "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}],
                        "headline-lg": ["32px", {"lineHeight": "40px", "fontWeight": "700"}],
                        "label-bold": ["14px", {"lineHeight": "20px", "fontWeight": "700"}],
                        "display-lg": ["72px", {"lineHeight": "80px", "letterSpacing": "-0.02em", "fontWeight": "800"}],
                        "headline-lg-mobile": ["28px", {"lineHeight": "36px", "fontWeight": "700"}]
                    }
                }
            }
        }
    </script>
<style>
        .tactile-shadow {
            box-shadow: 0 4px 24px -4px rgba(62, 39, 35, 0.05), 0 12px 16px -8px rgba(62, 39, 35, 0.02);
        }
        .pattern-dots {
            background-image: radial-gradient(#d3c3c0 1px, transparent 1px);
            background-size: 16px 16px;
        }
        .path-line {
            stroke-dasharray: 20 20;
            animation: dash 30s linear infinite;
        }
        @keyframes dash {
            to {
                stroke-dashoffset: -1000;
            }
        }
    </style>
</head>
<body class="bg-surface text-on-surface font-body-md text-body-md antialiased overflow-x-hidden selection:bg-tertiary-fixed selection:text-on-tertiary-fixed">
<?php include 'includes/navbar.php'; ?>
<main class="w-full">
<section class="w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-desktop py-section-padding relative overflow-hidden">
<div class="absolute top-0 right-0 w-1/2 h-full pattern-dots opacity-30 -z-10 rounded-l-[4rem]"></div>
<div class="absolute -top-32 -left-32 w-96 h-96 bg-tertiary-fixed rounded-full mix-blend-multiply filter blur-3xl opacity-20 -z-10"></div>
<div class="grid lg:grid-cols-12 gap-gutter items-center">
<div class="lg:col-span-5 flex flex-col items-start space-y-6 z-10">
<div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border-[1.5px] border-primary bg-surface-container-lowest shadow-sm -rotate-2 transform hover:rotate-0 transition-transform">
<span class="material-symbols-outlined text-[#FFB74D] text-lg" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="font-label-bold text-label-bold text-primary">100% Bahan Premium</span>
</div>
<h1 class="font-display-lg text-headline-lg-mobile md:text-display-lg text-primary tracking-tight">
                        Dibuat dengan <br> <span class="text-tertiary">cinta</span>, dikreasikan <br> untuk Anda.
                    </h1>
<p class="font-body-lg text-body-lg text-on-surface-variant max-w-md">
                        Rasakan kehangatan kue artisan rumahan. Dari brownies cokelat yang kaya rasa hingga nastar klasik, setiap gigitan menyimpan cerita keterampilan tangan kami.
                    </p>
<div class="flex flex-wrap items-center gap-4 pt-4">
<a class="inline-flex items-center justify-center rounded-full border-[1.5px] border-primary bg-primary text-on-primary px-8 py-4 font-label-bold text-label-bold hover:bg-inverse-surface transition-colors" href="<?= $base_url ?>produk.php">
                            Lihat Menu
                        </a>
<a class="inline-flex items-center justify-center rounded-full border-[1.5px] border-primary bg-transparent text-primary px-8 py-4 font-label-bold text-label-bold hover:bg-surface-variant transition-colors" href="#cara-pesan">
                            Cara Pemesanan
                        </a>
</div>
<div class="flex items-center gap-8 mt-8 pt-8 border-t border-outline-variant w-full max-w-md">
<div>
<p class="font-display-md text-headline-lg text-primary">5k+</p>
<p class="font-body-md text-body-md text-on-surface-variant text-sm">Pesanan Selesai</p>
</div>
<div class="h-10 w-[1px] bg-outline-variant"></div>
<div>
<p class="font-display-md text-headline-lg text-primary">4.9</p>
<div class="flex text-[#FFB74D] text-sm">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1; font-size: 16px;">star</span>
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1; font-size: 16px;">star</span>
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1; font-size: 16px;">star</span>
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1; font-size: 16px;">star</span>
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1; font-size: 16px;">star_half</span>
</div>
</div>
</div>
</div>
<div class="lg:col-span-7 relative h-[500px] sm:h-[600px] mt-12 lg:mt-0">
<div class="absolute top-0 right-0 w-4/5 h-4/5 rounded-xl border border-outline-variant overflow-hidden tactile-shadow z-10 transform rotate-1 hover:rotate-0 transition-transform duration-500">
<img alt="Olin's Cake Signature Setup" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDEcM5XvM8wiB6Q_gjhARzhmZjlLtE2VsoFvzNOsQn81yfBdzE1aEEyZ-RDqhXrBzkSABFxuW42FeHi0Afxfmz36RL-88TaZWm7efgPP3U6BAqRaDEzAxqt2Qx8RyRmQQbd8CM3OtGRDfic4Syrm7_IaFV2JIjAgOzx4TP17Ma2n4THzcCXVxUCxxt8rP2CaUq3N9mSYoJgyWzcOpqUCcr5H08ao9vq70e0CF9e4LEwmz_l5pWos2Du06D1zTDdKc8qVJQ3jfN8Eye0">
<div class="absolute bottom-6 left-6 bg-surface/80 backdrop-blur-md border border-outline-variant px-4 py-2 rounded-lg tactile-shadow">
<p class="font-label-bold text-label-bold text-primary">Best Seller ðŸ”¥</p>
</div>
</div>
<div class="absolute bottom-0 left-0 w-2/5 h-2/5 rounded-lg border-[4px] border-surface overflow-hidden tactile-shadow z-20 transform -rotate-3 hover:-rotate-1 transition-transform duration-500">
<img alt="Freshly baked goods close up" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA2e2QpVDlQcPAgIoe_W_c-bcnKQLVtDs7pN9Pk1cAlncGg5LUoRZSZ89eUq1F7gcu2FQH71qerES6kn6w9n0-DERbkmZMrnvCNvXRzzeZNL-Ulyk3YAWlcw8NkEWQIqigagB1Vm3Noc4xNm9eFdC8mWEJG7bei2CRiP_JYnvnRoE7FGebdTS9LArIpMUGkvYiyJ9kgmShtDFv9jBc034h1-ZdPgdzQ-vbxtdIfX8_duaWfa0NNFIQUXXVLBvumgOAFS4RI0r1yrp_B">
</div>
<div class="absolute top-10 left-10 w-20 h-20 bg-nastar-bg rounded-full -z-0 blur-xl opacity-60"></div>
</div>
</div>
</section>
<section class="w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-desktop py-section-padding bg-surface-container-low rounded-xl mx-4 md:mx-auto" id="tentang-kami">
<div class="grid md:grid-cols-2 gap-16 items-center mb-16 px-4 md:px-8">
<div class="relative order-2 md:order-1">
<div class="aspect-square rounded-[3rem] overflow-hidden border-2 border-outline-variant tactile-shadow relative z-10">
<img alt="Olin's Cake Kitchen" class="w-full h-full object-cover" src="assets/images/kyliee-sweet.jpeg">
</div>
<div class="absolute -bottom-8 -right-8 w-48 h-48 bg-primary-fixed rounded-full -z-0"></div>
<div class="absolute -top-6 -left-6 w-24 h-24 border-[1.5px] border-primary rounded-full z-20 flex items-center justify-center bg-surface rotate-12">
<span class="font-display-md text-lg text-primary text-center leading-tight">Since<br>2020</span>
</div>
</div>
<div class="order-1 md:order-2">
<h2 class="font-display-md text-headline-lg-mobile md:text-display-md text-primary mb-6">Tentang Kami</h2>
<p class="font-body-lg text-body-lg text-on-surface-variant mb-6">
    Olin's Cake adalah usaha kue artisan rumahan yang lahir dari passion dan cinta. Dengan sistem pre-order eksklusif, kami memastikan setiap produk mendapatkan sentuhan personal dan perhatian penuh untuk hari spesial Anda.
</p>
<p class="font-body-md text-body-md text-on-surface-variant">
    Kami memegang teguh komitmen terhadap kebersihan, kesegaran bahan baku, dan kualitas tanpa kompromi. Tanpa pengawet dan dibuat dengan resep keluarga, setiap gigitan adalah bukti dedikasi kami untuk kepuasan Anda.
</p>
</div>
</div>

<div class="grid md:grid-cols-3 gap-gutter px-4 md:px-8">
<div class="bg-surface-container-lowest p-card-padding rounded-lg border border-outline-variant tactile-shadow hover:-translate-y-2 transition-transform duration-300 group">
<div class="w-14 h-14 rounded-full bg-nastar-bg flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
<span class="material-symbols-outlined text-primary text-2xl" style="font-variation-settings: 'FILL' 1;">cake</span>
</div>
<h3 class="font-headline-lg text-headline-lg-mobile text-primary mb-2">Dibuat Fresh Sesuai Pesanan</h3>
<p class="font-body-md text-body-md text-on-surface-variant">Setiap pesanan baru akan diproses dan dipanggang khusus untuk menjaga kesegaran optimal saat dinikmati.</p>
</div>
<div class="bg-surface-container-lowest p-card-padding rounded-lg border border-outline-variant tactile-shadow hover:-translate-y-2 transition-transform duration-300 group mt-0 md:mt-8">
<div class="w-14 h-14 rounded-full bg-tertiary-fixed flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
<span class="material-symbols-outlined text-primary text-2xl" style="font-variation-settings: 'FILL' 1;">eco</span>
</div>
<h3 class="font-headline-lg text-headline-lg-mobile text-primary mb-2">Bahan Berkualitas</h3>
<p class="font-body-md text-body-md text-on-surface-variant">Hanya menggunakan bahan baku premium dan resep autentik pilihan, menghasilkan rasa luar biasa di setiap gigitan.</p>
</div>
<div class="bg-surface-container-lowest p-card-padding rounded-lg border border-outline-variant tactile-shadow hover:-translate-y-2 transition-transform duration-300 group mt-0 md:mt-16">
<div class="w-14 h-14 rounded-full bg-brownie-bg flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
<span class="material-symbols-outlined text-primary text-2xl" style="font-variation-settings: 'FILL' 1;">local_shipping</span>
</div>
<h3 class="font-headline-lg text-headline-lg-mobile text-primary mb-2">Pengiriman Aman</h3>
<p class="font-body-md text-body-md text-on-surface-variant">Dikemas rapi dengan standar keamanan tinggi memastikan kue cantikmu tiba dalam kondisi sempurna.</p>
</div>
</div>
</section>
<section class="w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-desktop py-section-padding" id="produk">
<div class="flex justify-between items-end mb-12">
<div>
<h2 class="font-display-md text-headline-lg-mobile md:text-display-md text-primary mb-4">Produk Favorit</h2>
<p class="font-body-lg text-body-lg text-on-surface-variant">Pilihan terbaik yang paling sering dipesan oleh pelanggan kami.</p>
</div>
<a class="hidden md:inline-flex items-center gap-2 font-label-bold text-label-bold text-primary hover:text-tertiary transition-colors border-b border-primary pb-1" href="<?= $base_url ?>produk.php">
                    Lihat Semua <span class="material-symbols-outlined text-sm">arrow_forward</span>
</a>
</div>
<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-gutter">
<div class="group bg-surface-container-lowest rounded-xl border border-outline-variant overflow-hidden tactile-shadow hover:-translate-y-1 transition-transform duration-300 flex flex-col">
<div class="h-64 bg-brownie-bg/50 relative overflow-hidden flex items-center justify-center p-4">
<img class="w-full h-full object-cover rounded-lg transform group-hover:scale-105 transition-transform duration-700" data-alt="A beautifully styled, high-end photograph of a stack of rich, dark chocolate fudgy brownies on a rustic ceramic plate. The setting is a bright, airy, modern artisanal bakery with soft natural daylight. The background features blurred, minimalist warm white walls and subtle wooden textures. The mood is sophisticated, inviting, and premium, perfectly matching a contemporary tactile brand aesthetic with cream and earthy brown tones." src="https://lh3.googleusercontent.com/aida-public/AB6AXuD70eTihwqO7ZF3CU_mOUaFnCuoMS3RhciCac0FY3FPxUwJT-hM1p4HIgDpPkTGoXUZ7Snk4PY2I3rkzf6oTBSZzGw3EEbX2sBVIxKn3Jh_yfry-5M43NpCajxbYfWO0N1usYBI1jKoUpi9K_n36yb1mbOria2JObcQP6g--kwJkgUKLeDPmj3kBJbls0W49gqZlruNFn-_bLQBcrsVnbRr2FjhwgZK1BmSsWr33onBrODj8A4RMc2gcChEMbTWSEuqS5pMPrYwg3Wq">
<div class="absolute top-4 left-4 bg-surface px-3 py-1 rounded-full border border-outline-variant shadow-sm rotate-2">
<span class="font-label-bold text-[12px] font-bold text-primary">Signature</span>
</div>
</div>
<div class="p-6 flex flex-col flex-grow">
<div class="flex justify-between items-start mb-2">
<h3 class="font-headline-lg text-headline-lg-mobile text-primary">Fudgy Brownies</h3>
<p class="font-label-bold text-label-bold text-tertiary-container">Rp 85.000</p>
</div>
<p class="font-body-md text-body-md text-on-surface-variant mb-6 flex-grow">Cokelat premium yang lumer di mulut dengan tekstur padat dan crust yang renyah di atasnya.</p>
<!-- preview buttons removed -->
</div>
</div>
<div class="group bg-surface-container-lowest rounded-xl border border-outline-variant overflow-hidden tactile-shadow hover:-translate-y-1 transition-transform duration-300 flex flex-col">
<div class="h-64 bg-nastar-bg/30 relative overflow-hidden flex items-center justify-center p-4">
<img alt="Nastar Klasik" class="w-full h-full object-cover rounded-lg transform group-hover:scale-105 transition-transform duration-700" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAKS3IhKcp9NRxeovWHzVjSp_-pF12CRD6xfiTrYoN8X377RGGLQAPnLYwQYA91hPWYDxqPUCgfJOBq_J3ZcJA5qokGLMgJYN-Bi0n375qJTIH-uTioguLWlSxp0FV-uPbU17Xo6pCJYN1JRfJgY5mp0RBRcyAeERPHNAnexDjtz065WxKxHvkAWapUf_ktxXPwj5N8kqseV6ENgRiGDePC3BWdlIjxWsqK_n4qBop27iN_TgSICL3-HHf7IU9gL8z5r2HDbvhOR-B1">
<div class="absolute top-4 left-4 bg-surface px-3 py-1 rounded-full border border-outline-variant shadow-sm -rotate-2">
<span class="font-label-bold text-[12px] font-bold text-primary">Seasonal</span>
</div>
</div>
<div class="p-6 flex flex-col flex-grow">
<div class="flex justify-between items-start mb-2">
<h3 class="font-headline-lg text-headline-lg-mobile text-primary">Nastar Klasik</h3>
<p class="font-label-bold text-label-bold text-tertiary-container">Rp 120.000</p>
</div>
<p class="font-body-md text-body-md text-on-surface-variant mb-6 flex-grow">Kue kering lembut dengan isian selai nanas asli buatan sendiri. Manis dan asam yang seimbang.</p>
<!-- preview buttons removed -->
</div>
</div>
<div class="group bg-surface-container-lowest rounded-xl border border-outline-variant overflow-hidden tactile-shadow hover:-translate-y-1 transition-transform duration-300 flex flex-col">
<div class="h-64 bg-surface-variant relative overflow-hidden flex items-center justify-center p-4">
<img alt="Kaastengels Premium" class="w-full h-full object-cover rounded-lg transform group-hover:scale-105 transition-transform duration-700" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA2e2QpVDlQcPAgIoe_W_c-bcnKQLVtDs7pN9Pk1cAlncGg5LUoRZSZ89eUq1F7gcu2FQH71qerES6kn6w9n0-DERbkmZMrnvCNvXRzzeZNL-Ulyk3YAWlcw8NkEWQIqigagB1Vm3Noc4xNm9eFdC8mWEJG7bei2CRiP_JYnvnRoE7FGebdTS9LArIpMUGkvYiyJ9kgmShtDFv9jBc034h1-ZdPgdzQ-vbxtdIfX8_duaWfa0NNFIQUXXVLBvumgOAFS4RI0r1yrp_B">
</div>
<div class="p-6 flex flex-col flex-grow">
<div class="flex justify-between items-start mb-2">
<h3 class="font-headline-lg text-headline-lg-mobile text-primary">Kaastengels Edam</h3>
<p class="font-label-bold text-label-bold text-tertiary-container">Rp 135.000</p>
</div>
<p class="font-body-md text-body-md text-on-surface-variant mb-6 flex-grow">Gurihnya keju Edam premium yang berlimpah, renyah di luar dan lumer di dalam.</p>
<!-- preview buttons removed -->
</div>
</div>
</div>
<div class="mt-8 text-center md:hidden">
<a href="<?= $base_url ?>produk.php" class="rounded-full border border-primary px-6 py-3 font-label-bold text-label-bold text-primary hover:bg-surface-variant transition-colors inline-block">
                    Lihat Semua Produk
                </a>
</div>
</section>
<section class="w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-desktop py-section-padding relative flex flex-col items-center" id="cara-pesan">
<div class="text-center mb-16 max-w-2xl z-10">
<h2 class="font-display-md text-headline-lg-mobile md:text-headline-lg text-primary mb-4">Cara Mudah Memesan</h2>
<p class="font-body-lg text-body-lg text-on-surface-variant">Ikuti perjalanan seru kue impianmu dari oven kami ke meja makanmu. Cukup beberapa langkah mudah!</p>
</div>
<div class="relative w-full max-w-5xl mx-auto flex flex-col items-center z-10">
<svg class="absolute top-0 bottom-0 hidden md:block w-full h-full -z-10 pointer-events-none" preserveAspectRatio="none" viewBox="0 0 1000 1200">
<path class="path-line" d="M 500,0 C 700,50 750,120 680,200 C 600,300 250,250 320,400 C 400,550 700,480 640,620 C 550,750 300,700 360,820 C 400,950 600,900 550,1020 C 500,1100 500,1150 500,1200" fill="none" stroke="#e3beb8" stroke-linecap="round" stroke-width="8"></path>
</svg>
<div class="absolute top-0 bottom-0 left-8 w-1 bg-primary-fixed md:hidden -z-10 rounded-full"></div>

<div class="relative w-full flex justify-end md:justify-center mb-32 group">
<div class="absolute hidden md:block -right-12 top-12 opacity-80 rotate-12">
<span class="material-symbols-outlined text-tertiary-fixed text-6xl">cookie</span>
</div>
<div class="w-[85%] md:w-96 md:translate-x-[180px] bg-surface-container-lowest rounded-xl p-8 tactile-shadow border border-outline-variant hover:-translate-y-2 transition-transform duration-300">
<div class="w-16 h-16 rounded-full bg-primary-fixed flex items-center justify-center text-primary mb-4 absolute -top-8 -left-8 md:-left-8 border-4 border-surface-container-lowest">
<span class="font-headline-lg text-[24px]">1</span>
</div>
<div class="flex items-center gap-4 mb-2">
<span class="material-symbols-outlined text-primary text-3xl" style="font-variation-settings: 'FILL' 1;">cake</span>
<h3 class="font-headline-lg text-[24px] text-primary">Pilih Kue</h3>
</div>
<p class="font-body-md text-on-surface-variant">Jelajahi galeri kue kami yang lezat dan pilih yang paling menggugah seleramu.</p>
</div>
</div>

<div class="relative w-full flex justify-end md:justify-center mb-32 group">
<div class="absolute hidden md:block left-0 top-10 opacity-70 -rotate-12">
<span class="material-symbols-outlined text-outline-variant text-5xl">local_mall</span>
</div>
<div class="w-[85%] md:w-96 md:-translate-x-[180px] bg-surface-container-lowest rounded-xl p-8 tactile-shadow border border-outline-variant hover:-translate-y-2 transition-transform duration-300">
<div class="w-16 h-16 rounded-full bg-tertiary-fixed flex items-center justify-center text-on-tertiary-fixed mb-4 absolute -top-8 -left-8 md:-right-8 md:left-auto border-4 border-surface-container-lowest">
<span class="font-headline-lg text-[24px]">2</span>
</div>
<div class="flex items-center gap-4 mb-2">
<span class="material-symbols-outlined text-primary text-3xl" style="font-variation-settings: 'FILL' 1;">shopping_cart</span>
<h3 class="font-headline-lg text-[24px] text-primary">Keranjang</h3>
</div>
<p class="font-body-md text-on-surface-variant">Tambahkan kue pilihanmu, atur jumlah, dan pastikan pesanan sudah sesuai keinginan.</p>
</div>
</div>

<div class="relative w-full flex justify-end md:justify-center mb-32 group">
<div class="absolute hidden md:block right-10 top-20 opacity-60 rotate-45">
<span class="material-symbols-outlined text-secondary text-5xl">schedule</span>
</div>
<div class="w-[85%] md:w-96 md:translate-x-[140px] bg-surface-container-lowest rounded-xl p-8 tactile-shadow border border-outline-variant hover:-translate-y-2 transition-transform duration-300">
<div class="w-16 h-16 rounded-full bg-secondary-fixed flex items-center justify-center text-on-secondary-fixed mb-4 absolute -top-8 -left-8 md:-left-8 border-4 border-surface-container-lowest">
<span class="font-headline-lg text-[24px]">3</span>
</div>
<div class="flex items-center gap-4 mb-2">
<span class="material-symbols-outlined text-primary text-3xl" style="font-variation-settings: 'FILL' 1;">pin_drop</span>
<h3 class="font-headline-lg text-[24px] text-primary">Detail Kirim</h3>
</div>
<p class="font-body-md text-on-surface-variant">Masukkan alamat tujuan dan pilih tanggal serta waktu pengiriman yang pas.</p>
</div>
</div>

<div class="relative w-full flex justify-end md:justify-center mb-32 group">
<div class="absolute hidden md:block left-10 -top-10 opacity-70 -rotate-6">
<span class="material-symbols-outlined text-primary-fixed-dim text-6xl">payments</span>
</div>
<div class="w-[85%] md:w-96 md:-translate-x-[140px] bg-surface-container-lowest rounded-xl p-8 tactile-shadow border border-outline-variant hover:-translate-y-2 transition-transform duration-300">
<div class="w-16 h-16 rounded-full bg-primary-fixed flex items-center justify-center text-primary mb-4 absolute -top-8 -left-8 md:-right-8 md:left-auto border-4 border-surface-container-lowest">
<span class="font-headline-lg text-[24px]">4</span>
</div>
<div class="flex items-center gap-4 mb-2">
<span class="material-symbols-outlined text-primary text-3xl" style="font-variation-settings: 'FILL' 1;">credit_card</span>
<h3 class="font-headline-lg text-[24px] text-primary">Pembayaran</h3>
</div>
<p class="font-body-md text-on-surface-variant">Selesaikan pembayaran melalui berbagai metode yang aman dan terpercaya.</p>
</div>
</div>

<div class="relative w-full flex justify-end md:justify-center mb-32 group">
<div class="absolute hidden md:block right-20 -top-10 opacity-80 rotate-12">
<span class="material-symbols-outlined text-tertiary-fixed text-5xl">bakery_dining</span>
</div>
<div class="w-[85%] md:w-96 md:translate-x-[80px] bg-surface-container-lowest rounded-xl p-8 tactile-shadow border border-outline-variant hover:-translate-y-2 transition-transform duration-300">
<div class="w-16 h-16 rounded-full bg-tertiary-fixed flex items-center justify-center text-on-tertiary-fixed mb-4 absolute -top-8 -left-8 md:-left-8 border-4 border-surface-container-lowest">
<span class="font-headline-lg text-[24px]">5</span>
</div>
<div class="flex items-center gap-4 mb-2">
<span class="material-symbols-outlined text-primary text-3xl" style="font-variation-settings: 'FILL' 1;">oven_gen</span>
<h3 class="font-headline-lg text-[24px] text-primary">Kue Dipanggang</h3>
</div>
<p class="font-body-md text-on-surface-variant">Chef kami akan membuat kuemu dengan bahan premium dan penuh cinta.</p>
</div>
</div>

<div class="relative w-full flex justify-end md:justify-center mb-16 group">
<div class="w-[85%] md:w-96 bg-surface-container-lowest rounded-xl p-8 tactile-shadow border border-outline-variant hover:-translate-y-2 transition-transform duration-300 relative">
<div class="w-16 h-16 rounded-full bg-secondary-fixed flex items-center justify-center text-on-secondary-fixed mb-4 absolute -top-8 -left-8 md:-top-8 md:left-1/2 md:-translate-x-1/2 border-4 border-surface-container-lowest">
<span class="font-headline-lg text-[24px]">6</span>
</div>
<div class="flex items-center gap-4 mb-2 md:mt-4">
<span class="material-symbols-outlined text-primary text-3xl" style="font-variation-settings: 'FILL' 1;">local_shipping</span>
<h3 class="font-headline-lg text-[24px] text-primary">Pengiriman</h3>
</div>
<p class="font-body-md text-on-surface-variant">Kue cantikmu siap diantar dengan aman sampai ke depan pintumu.</p>
</div>
</div>
<div class="mt-8 text-center z-10">
<a class="inline-flex items-center justify-center rounded-full border-[1.5px] border-primary bg-primary text-on-primary px-8 py-4 font-label-bold text-label-bold hover:bg-inverse-surface transition-colors gap-2" href="<?= $base_url ?>produk.php">
                    Mulai Pesan Sekarang
                    <span class="material-symbols-outlined text-sm">arrow_forward</span>
</a>
</div>
</div>
</section>
<!-- Kisah di Balik Dapur Kami removed (merged into Tentang Kami) -->

<section id="testimoni" class="w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-desktop mb-32"><div class="flex flex-col items-center gap-12">
    <div class="text-center">
        <h2 class="font-display-md text-headline-lg-mobile md:text-display-md text-primary mb-4">Apa Kata Mereka?</h2>
        <p class="font-body-lg text-body-lg text-on-surface-variant">Cerita manis dari para penikmat setia Olin's Cake.</p>
    </div>

    <div class="relative w-full max-w-3xl overflow-hidden px-10 py-6" id="testimonial-slider">
        <div class="flex transition-transform duration-500 ease-in-out" id="testimonial-track">
            <!-- Slide 1 -->
            <div class="w-full flex-shrink-0 px-4">
                <div class="bg-surface-container-lowest rounded-3xl p-8 md:p-12 text-center border border-outline-variant tactile-shadow relative mt-6">
                    <div class="absolute -top-8 left-1/2 -translate-x-1/2 w-16 h-16 rounded-full overflow-hidden border-4 border-surface shadow-sm bg-surface-container-highest flex items-center justify-center">
                        <span class="material-symbols-outlined text-4xl text-outline">person</span>
                    </div>
                    <div class="flex justify-center text-[#FFB74D] mb-4 mt-6">
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                    </div>
                    <p class="font-body-lg text-lg text-on-surface-variant mb-6 italic">"Packagingnya sangat mewah, cocok untuk hantaran. Saya pesan untuk kado ulang tahun teman dan mereka sangat menyukainya!"</p>
                    <p class="font-headline-lg text-xl text-primary mb-1">Santi K.</p>
                    <p class="font-body-md text-sm text-outline">Pelanggan Baru</p>
                </div>
            </div>
            
            <!-- Slide 2 -->
            <div class="w-full flex-shrink-0 px-4">
                <div class="bg-surface-container-lowest rounded-3xl p-8 md:p-12 text-center border border-outline-variant tactile-shadow relative mt-6">
                    <div class="absolute -top-8 left-1/2 -translate-x-1/2 w-16 h-16 rounded-full overflow-hidden border-4 border-surface shadow-sm bg-surface-container-highest flex items-center justify-center">
                        <span class="material-symbols-outlined text-4xl text-outline">person</span>
                    </div>
                    <div class="flex justify-center text-[#FFB74D] mb-4 mt-6">
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                    </div>
                    <p class="font-body-lg text-lg text-on-surface-variant mb-6 italic">"Nastar premium yang lumer di mulut, favorit keluarga! Selai nanasnya terasa asli dan tidak terlalu manis, pas banget di lidah."</p>
                    <p class="font-headline-lg text-xl text-primary mb-1">Budi S.</p>
                    <p class="font-body-md text-sm text-outline">Pecinta Kue Kering</p>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="w-full flex-shrink-0 px-4">
                <div class="bg-surface-container-lowest rounded-3xl p-8 md:p-12 text-center border border-outline-variant tactile-shadow relative mt-6">
                    <div class="absolute -top-8 left-1/2 -translate-x-1/2 w-16 h-16 rounded-full overflow-hidden border-4 border-surface shadow-sm bg-surface-container-highest flex items-center justify-center">
                        <span class="material-symbols-outlined text-4xl text-outline">person</span>
                    </div>
                    <div class="flex justify-center text-[#FFB74D] mb-4 mt-6">
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star_half</span>
                    </div>
                    <p class="font-body-lg text-lg text-on-surface-variant mb-6 italic">"Browniesnya beneran seenak itu! Teksturnya pas, cokelatnya kerasa premium banget dan gak bikin eneg. Packagingnya juga cantik."</p>
                    <p class="font-headline-lg text-xl text-primary mb-1">Amanda T.</p>
                    <p class="font-body-md text-sm text-outline">Pelanggan Setia</p>
                </div>
            </div>
        </div>
        
        <!-- Controls -->
        <button id="prev-slide" class="absolute top-1/2 left-2 -translate-y-1/2 bg-surface text-primary w-10 h-10 rounded-full border border-outline-variant shadow-sm flex items-center justify-center hover:bg-surface-variant transition-colors z-10">
            <span class="material-symbols-outlined">chevron_left</span>
        </button>
        <button id="next-slide" class="absolute top-1/2 right-2 -translate-y-1/2 bg-surface text-primary w-10 h-10 rounded-full border border-outline-variant shadow-sm flex items-center justify-center hover:bg-surface-variant transition-colors z-10">
            <span class="material-symbols-outlined">chevron_right</span>
        </button>
    </div>

    <div class="flex gap-2 mt-2" id="testimonial-dots">
        <button class="w-3 h-3 rounded-full bg-primary dot-indicator" data-index="0"></button>
        <button class="w-3 h-3 rounded-full bg-outline-variant dot-indicator" data-index="1"></button>
        <button class="w-3 h-3 rounded-full bg-outline-variant dot-indicator" data-index="2"></button>
    </div>
</div></section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const track = document.getElementById('testimonial-track');
    const slides = track.children;
    const nextButton = document.getElementById('next-slide');
    const prevButton = document.getElementById('prev-slide');
    const dots = document.querySelectorAll('.dot-indicator');
    
    let currentIndex = 0;
    const totalSlides = slides.length;

    function updateSlider() {
        track.style.transform = `translateX(-${currentIndex * 100}%)`;
        dots.forEach((dot, index) => {
            if (index === currentIndex) {
                dot.classList.remove('bg-outline-variant');
                dot.classList.add('bg-primary');
            } else {
                dot.classList.remove('bg-primary');
                dot.classList.add('bg-outline-variant');
            }
        });
    }

    nextButton.addEventListener('click', () => {
        currentIndex = (currentIndex + 1) % totalSlides;
        updateSlider();
    });

    prevButton.addEventListener('click', () => {
        currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
        updateSlider();
    });

    dots.forEach(dot => {
        dot.addEventListener('click', (e) => {
            currentIndex = parseInt(e.target.dataset.index);
            updateSlider();
        });
    });
    
    setInterval(() => {
        currentIndex = (currentIndex + 1) % totalSlides;
        updateSlider();
    }, 5000);
});
</script>

<section class="w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-desktop py-section-padding" id="hubungi-kami">
<div class="bg-surface-container-low rounded-[3rem] p-card-padding md:p-16 border border-outline-variant tactile-shadow">
<div class="grid lg:grid-cols-2 gap-16">
<div>
<h2 class="font-display-md text-headline-lg-mobile md:text-headline-lg text-primary mb-4">Mari Berbincang</h2>
<p class="font-body-lg text-body-lg text-on-surface-variant mb-8">Ada pertanyaan khusus atau ingin memesan dalam jumlah besar untuk acara Anda? Jangan ragu untuk menghubungi kami.</p>
<div class="space-y-6">
<div class="flex items-start gap-4">
<div class="w-12 h-12 rounded-full bg-surface-container-lowest flex items-center justify-center border border-outline-variant flex-shrink-0">
<span class="material-symbols-outlined text-primary">location_on</span>
</div>
<div>
<h4 class="font-label-bold text-label-bold text-primary mb-1">Lokasi Dapur</h4>
<p class="font-body-md text-body-md text-on-surface-variant">Jl. Kenangan Indah No. 42,<br/>Kebayoran Baru, Jakarta Selatan</p>
</div>
</div>
<div class="flex items-start gap-4">
<div class="w-12 h-12 rounded-full bg-surface-container-lowest flex items-center justify-center border border-outline-variant flex-shrink-0">
<span class="material-symbols-outlined text-primary">schedule</span>
</div>
<div>
<h4 class="font-label-bold text-label-bold text-primary mb-1">Jam Operasional</h4>
<p class="font-body-md text-body-md text-on-surface-variant">Senin - Sabtu: 08.00 - 17.00 WIB<br/>Minggu: Libur (Pre-order only)</p>
</div>
</div>
</div>
<div class="mt-10 pt-10 border-t border-outline-variant">
<h4 class="font-label-bold text-label-bold text-primary mb-4">Chat Langsung</h4>
<a href="https://wa.me/6289529236657" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 rounded-full border-[1.5px] border-[#25D366] bg-[#25D366] text-white px-6 py-3 font-label-bold text-label-bold hover:opacity-90 transition-opacity">
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-5 h-5 fill-current"><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg>
WhatsApp Admin
</a>
</div>
</div>
<div class="bg-surface-container-lowest p-8 rounded-2xl border border-outline-variant">
<h3 class="font-headline-lg text-xl text-primary mb-6">Kirim Pesan</h3>
<form class="space-y-4">
<div>
<label class="block font-label-bold text-sm text-on-surface-variant mb-1">Nama Lengkap</label>
<input class="w-full bg-surface rounded-lg border border-outline-variant px-4 py-3 focus:outline-none focus:ring-2 focus:ring-tertiary-container font-body-md text-primary placeholder:text-outline" placeholder="Masukkan nama anda" type="text"/>
</div>
<div>
<label class="block font-label-bold text-sm text-on-surface-variant mb-1">Email atau No. WhatsApp</label>
<input class="w-full bg-surface rounded-lg border border-outline-variant px-4 py-3 focus:outline-none focus:ring-2 focus:ring-tertiary-container font-body-md text-primary placeholder:text-outline" placeholder="Kontak yang bisa dihubungi" type="text"/>
</div>
<div>
<label class="block font-label-bold text-sm text-on-surface-variant mb-1">Pesan</label>
<textarea class="w-full bg-surface rounded-lg border border-outline-variant px-4 py-3 focus:outline-none focus:ring-2 focus:ring-tertiary-container font-body-md text-primary placeholder:text-outline resize-none" placeholder="Tuliskan pertanyaan atau kebutuhan Anda..." rows="4"></textarea>
</div>
<button class="w-full rounded-full border-[1.5px] border-primary bg-primary text-on-primary px-6 py-3.5 font-label-bold text-label-bold hover:bg-inverse-surface transition-colors mt-2" type="submit">
                                Kirim Pesan
                            </button>
</form>
</div>
</div>
</div>
</section>

<?php include 'includes/footer.php'; ?></main>
</body></html>

