<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>VISIONBF - Excellence Center</title>

    <link rel="icon" href="{{ asset('images/logo.png') }}">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- GSAP -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.13.0/gsap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.13.0/ScrollTrigger.min.js"></script>

    <!-- AOS -->

    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

    <!-- Font Awesome -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">

    <script>
        tailwind.config = {

            theme: {

                extend: {

                    fontFamily: {

                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                        title: ['Cinzel', 'serif'],

                    },

                    colors: {

                        gold: {
                            50: '#fffdf5',
                            100: '#fff6cf',
                            200: '#ffe98f',
                            300: '#ffd659',
                            400: '#ffc425',
                            500: '#fbba10',
                            600: '#df9408',
                            700: '#b96c08',
                            800: '#915208',
                            900: '#6d3c08',
                            950: '#2c1700'
                        },

                        nero: {

                            50: '#f6f6f6',
                            100: '#e5e5e5',
                            200: '#d4d4d4',
                            300: '#b3b3b3',
                            400: '#808080',
                            500: '#5f5f5f',
                            600: '#444',
                            700: '#2d2d2d',
                            800: '#1b1b1b',
                            900: '#111111',
                            950: '#050505'
                        }

                    }

                }

            }

        }
    </script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {

            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #050505;
            color: white;
            overflow-x: hidden;

        }

        /* ===========================
AURORA
=========================== */

        body::before {

            content: '';

            position: fixed;

            inset: -25%;

            background:

                radial-gradient(circle at 20% 20%, rgba(251, 186, 16, .20), transparent 28%),

                radial-gradient(circle at 75% 25%, rgba(255, 255, 255, .05), transparent 30%),

                radial-gradient(circle at 50% 90%, rgba(251, 186, 16, .10), transparent 35%);

            filter: blur(55px);

            animation: aurora 18s ease-in-out infinite alternate;

            z-index: -10;

        }

        @keyframes aurora {

            0% {

                transform: translate(-5%, -5%) scale(1);

            }

            50% {

                transform: translate(6%, 4%) scale(1.2);

            }

            100% {

                transform: translate(-2%, 6%) scale(1);

            }

        }

        /* ======================
GRID
====================== */

        .grid-bg {

            position: fixed;

            inset: 0;

            background-image:

                linear-gradient(rgba(255, 255, 255, .03) 1px, transparent 1px),

                linear-gradient(90deg, rgba(255, 255, 255, .03) 1px, transparent 1px);

            background-size: 70px 70px;

            mask-image: radial-gradient(circle, black 30%, transparent 90%);

            opacity: .35;

            z-index: -8;

        }

        /* ======================
Particles
====================== */

        #particles {

            position: fixed;

            inset: 0;

            overflow: hidden;

            z-index: -5;

        }

        .particle {

            position: absolute;

            border-radius: 50%;

            background: #fbba10;

            opacity: .35;

            animation: float linear infinite;

        }

        @keyframes float {

            0% {

                transform: translateY(120vh);

                opacity: 0;

            }

            15% {

                opacity: .4;

            }

            100% {

                transform: translateY(-20vh);

                opacity: 0;

            }

        }

        /* ====================
Glass
==================== */

        .glass {

            background: rgba(255, 255, 255, .04);

            backdrop-filter: blur(18px);

            border: 1px solid rgba(255, 255, 255, .08);

            box-shadow:

                0 0 40px rgba(0, 0, 0, .4),

                0 0 25px rgba(251, 186, 16, .08);

        }

        /* ====================
Cards
==================== */

        .card-premium {

            transition: .45s;

        }

        .card-premium:hover {

            transform:

                translateY(-12px) scale(1.03);

            box-shadow:

                0 25px 70px rgba(251, 186, 16, .18);

        }

        /* =======================
Buttons
======================= */

        .btn-gold {

            position: relative;

            overflow: hidden;

            background: linear-gradient(135deg, #fbba10, #df9408);

            color: black;

            font-weight: 700;

            transition: .4s;

        }

        .btn-gold::before {

            content: '';

            position: absolute;

            left: -120%;

            top: 0;

            height: 100%;

            width: 60%;

            background:

                linear-gradient(90deg,

                    transparent,

                    rgba(255, 255, 255, .8),

                    transparent);

            transform: skewX(-20deg);

        }

        .btn-gold:hover::before {

            left: 170%;

            transition: 1s;

        }

        .btn-gold:hover {

            transform: translateY(-4px);

        }

        /* ======================
Glow
====================== */

        .logo-glow {

            animation: glow 4s infinite;

        }

        @keyframes glow {

            0% {

                box-shadow: 0 0 0px #fbba10;

            }

            50% {

                box-shadow:

                    0 0 25px #fbba10,

                    0 0 60px rgba(251, 186, 16, .5);

            }

            100% {

                box-shadow: 0 0 0px #fbba10;

            }

        }

        /* ==========================
Mouse Cursor
========================== */

        .cursor {

            position: fixed;

            width: 22px;

            height: 22px;

            border: 2px solid #fbba10;

            border-radius: 50%;

            pointer-events: none;

            transform: translate(-50%, -50%);

            transition: .08s;

            z-index: 99999;

        }

        .cursor-dot {

            position: fixed;

            width: 6px;

            height: 6px;

            background: #fbba10;

            border-radius: 50%;

            pointer-events: none;

            transform: translate(-50%, -50%);

            z-index: 99999;

        }

        /* Scrollbar */

        ::-webkit-scrollbar {

            width: 10px;

        }

        ::-webkit-scrollbar-thumb {

            background: #fbba10;

            border-radius: 30px;

        }

        ::-webkit-scrollbar-track {

            background: #111;

        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .logo-circle {
            width: 60px;
            height: 60px;
            border: 3px solid #D4AF37;
            /* Doré */
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(212, 175, 55, 0.35);
        }

        .logo-circle img {
            width: 75%;
            height: 75%;
            object-fit: contain;
        }

        .logo span {
            font-size: 24px;
            font-weight: 700;
            color: #fff;
            /* adapte selon ton thème */
        }
    </style>

</head>

<body class="bg-nero-950">

    <div class="grid-bg"></div>

    <div id="particles"></div>

    <div class="cursor"></div>

    <div class="cursor-dot"></div>
    <!-- =========================
HEADER PREMIUM
========================= -->
    <!--======================================================
HEADER + HERO
=======================================================-->

    <header class="fixed top-0 left-0 w-full z-50">

        <div class="container mx-auto px-6">

            <nav class="nav-premium">

                <!-- Logo -->

                <a href="#" class="logo">
                    <div class="logo-circle">
                        <img src="{{ asset('images/logo.png') }}" alt="VISIONBF">
                    </div>

                </a>

                <!-- Menu -->

                <ul class="nav-menu">

                    <li>
                        <a href="#hero" class="active">
                            Accueil
                        </a>
                    </li>

                    <li>
                        <a href="#services">
                            Nos services
                        </a>
                    </li>

                    <li>
                        <a href="#about">
                            Qui sommes-nous ?
                        </a>
                    </li>

                    

                </ul>

                <!-- CTA -->

                <a href="#contact" class="btn-nav">

                    Contactez-nous

                </a>

                <!-- Menu Mobile -->

                <button class="mobile-toggle">

                    <i class="fa-solid fa-bars"></i>

                </button>

            </nav>

        </div>

    </header>

    <!--======================================================
HERO
=======================================================-->

    <section id="hero" class="hero-section">

        <!-- Aurora -->

        <div class="aurora aurora-one"></div>

        <div class="aurora aurora-two"></div>

        <div class="aurora aurora-three"></div>

        <!-- Particles -->

        <div id="particles"></div>

        <div class="container mx-auto px-6">

            <div class="hero-grid">

                <!--=========================
            LEFT
            ==========================-->

                <div class="hero-left">

                    <!-- Badge -->

                    <div class="hero-badge">

                        <i class="fa-solid fa-headset"></i>

                        Centre de relation client & Développement commercial

                    </div>

                    <!-- Titre -->

                    <h1 class="hero-title">

                        Des solutions performantes

                        <span>

                            pour renforcer votre relation client

                        </span>

                        et accompagner votre croissance.

                    </h1>

                    <!-- Texte -->

                    <!-- Boutons -->

                    <div class="hero-buttons">

                        <a href="#services" class="btn-gold">

                            Découvrir nos services

                            <i class="fa-solid fa-arrow-right"></i>

                        </a>

                        <a href="#contact" class="btn-outline">

                            Nous contacter

                        </a>

                    </div>

                    <!-- Points forts -->

                    <div class="hero-features">

                        <div class="feature">

                            <i class="fa-solid fa-circle-check"></i>

                            <span>

                                Équipe qualifiée

                            </span>

                        </div>

                        <div class="feature">

                            <i class="fa-solid fa-circle-check"></i>

                            <span>

                                Solutions sur mesure

                            </span>

                        </div>

                        <div class="feature">

                            <i class="fa-solid fa-circle-check"></i>

                            <span>

                                Accompagnement personnalisé

                            </span>

                        </div>

                    </div>

                </div>

                <!--=========================
            RIGHT
            ==========================-->

                <div class="hero-right">

                    <div class="hero-visual">

                        <!-- Carte principale -->

                        <div class="main-card glass">

                            <div class="main-card-icon">

                                <i class="fa-solid fa-headset"></i>

                            </div>

                            <h3>

                                Relation Client

                            </h3>

                            <p>

                                Une équipe dédiée pour accompagner
                                vos clients et renforcer leur satisfaction.

                            </p>

                        </div>

                        <!-- Carte flottante -->

                        <div class="floating-card floating-one glass">

                            <div class="floating-icon">

                                <i class="fa-solid fa-phone-volume"></i>

                            </div>

                            <div>

                                <h4>

                                    Téléprospection

                                </h4>

                                <span>

                                    Prospection ciblée

                                </span>

                            </div>

                        </div>

                        <!-- Carte flottante -->



                        <!-- Carte flottante -->

                        <div class="floating-card floating-three glass">

                            <div class="floating-icon">

                                <i class="fa-solid fa-users"></i>

                            </div>

                            <div>

                                <h4>

                                    Service Client

                                </h4>

                                <span>

                                    Assistance & accompagnement

                                </span>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- Scroll -->

        <a href="#services" class="scroll-indicator">

            <span></span>

        </a>

    </section>
    <style>
        /*=========================================================
VISIONBF - GLOBAL CSS
Partie 1C-1
Base + Variables + Aurora + Background
=========================================================*/

        /*=========================
GOOGLE FONT
=========================*/

        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

        /*=========================
RESET
=========================*/

        *,
        *::before,
        *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {

            scroll-behavior: smooth;

        }

        body {

            font-family: 'Inter', sans-serif;

            background: #050816;

            color: #ffffff;

            overflow-x: hidden;

            line-height: 1.6;

            position: relative;

        }

        /*=========================
SELECTION
=========================*/

        ::selection {

            background: #f4b400;

            color: #111;

        }

        /*=========================
SCROLLBAR
=========================*/

        ::-webkit-scrollbar {

            width: 10px;

        }

        ::-webkit-scrollbar-track {

            background: #08111d;

        }

        ::-webkit-scrollbar-thumb {

            background: linear-gradient(#f4b400,
                    #d89500);

            border-radius: 50px;

        }

        ::-webkit-scrollbar-thumb:hover {

            background: #ffcb2f;

        }

        /*=========================
VARIABLES
=========================*/

        :root {

            /* Couleurs */

            --primary: #f4b400;

            --primary-dark: #cf9200;

            --secondary: #2563eb;

            --dark: #050816;

            --dark-2: #0a1020;

            --dark-3: #121a2c;

            --text: #ffffff;

            --text-light: #d1d5db;

            --text-muted: #94a3b8;

            --success: #10b981;

            --danger: #ef4444;

            /* Glass */

            --glass-bg: rgba(255, 255, 255, .05);

            --glass-border: rgba(255, 255, 255, .08);

            --glass-shadow: 0 25px 60px rgba(0, 0, 0, .25);

            /* Radius */

            --radius: 24px;

            --radius-lg: 36px;

            /* Transition */

            --transition: .35s ease;

        }

        /*=========================
CONTAINER
=========================*/

        .container {

            width: 100%;

            max-width: 1320px;

            margin: auto;

            padding-inline: 20px;

        }

        /*=========================
IMAGES
=========================*/

        img {

            max-width: 100%;

            display: block;

        }

        /*=========================
LINKS
=========================*/

        a {

            color: inherit;

            text-decoration: none;

        }

        ul {

            list-style: none;

        }

        /*=========================
SECTION
=========================*/

        section {

            position: relative;

        }

        /*==================================================
BACKGROUND GLOBAL
==================================================*/

        body::before {

            content: "";

            position: fixed;

            inset: 0;

            background:

                radial-gradient(circle at top left,
                    rgba(37, 99, 235, .08),
                    transparent 40%),

                radial-gradient(circle at bottom right,
                    rgba(244, 180, 0, .08),
                    transparent 45%),

                linear-gradient(180deg,
                    #050816,
                    #07101f,
                    #050816);

            z-index: -5;

        }

        /*==================================================
GRID BACKGROUND
==================================================*/

        body::after {

            content: "";

            position: fixed;

            inset: 0;

            background-image:

                linear-gradient(rgba(255, 255, 255, .03) 1px,
                    transparent 1px),

                linear-gradient(90deg,
                    rgba(255, 255, 255, .03) 1px,
                    transparent 1px);

            background-size: 70px 70px;

            mask-image:
                radial-gradient(circle,
                    black 45%,
                    transparent 100%);

            z-index: -4;

            opacity: .45;

        }

        /*==================================================
AURORA
==================================================*/

        .aurora {

            position: absolute;

            border-radius: 50%;

            filter: blur(120px);

            opacity: .55;

            pointer-events: none;

            animation: auroraMove 18s ease-in-out infinite alternate;

        }

        .aurora-one {

            width: 550px;

            height: 550px;

            left: -180px;

            top: -100px;

            background: #2563eb;

        }

        .aurora-two {

            width: 450px;

            height: 450px;

            right: -120px;

            top: 220px;

            background: #f4b400;

            animation-delay: 4s;

        }

        .aurora-three {

            width: 420px;

            height: 420px;

            left: 40%;

            bottom: -160px;

            background: #1d4ed8;

            animation-delay: 8s;

        }

        @keyframes auroraMove {

            0% {

                transform:
                    translate(0, 0) scale(1);

            }

            50% {

                transform:
                    translate(80px, -40px) scale(1.15);

            }

            100% {

                transform:
                    translate(-50px, 70px) scale(.9);

            }

        }

        /*==================================================
GLASS
==================================================*/

        .glass {

            background: var(--glass-bg);

            border: 1px solid var(--glass-border);

            backdrop-filter: blur(20px);

            -webkit-backdrop-filter: blur(20px);

            box-shadow: var(--glass-shadow);

        }

        /*==================================================
TEXT GRADIENT
==================================================*/

        .text-gold-gradient {

            background:

                linear-gradient(90deg,
                    #fff6cf,
                    #f4b400,
                    #ffd95a);

            -webkit-background-clip: text;

            -webkit-text-fill-color: transparent;

        }

        /*==================================================
GLOW
==================================================*/

        .glow {

            position: absolute;

            border-radius: 50%;

            filter: blur(80px);

            opacity: .35;

            pointer-events: none;

        }

        /*==================================================
PARTICLES
==================================================*/

        #particles {

            position: absolute;

            inset: 0;

            overflow: hidden;

            z-index: 0;

        }

        /*==================================================
HERO
==================================================*/

        .hero-section {

            min-height: 100vh;

            display: flex;

            align-items: center;

            overflow: hidden;

            position: relative;

            padding-top: 120px;

            padding-bottom: 80px;

        }

        /*==================================================
GRID HERO
==================================================*/

        .hero-grid {

            display: grid;

            grid-template-columns: 1.1fr .9fr;

            gap: 80px;

            align-items: center;

            position: relative;

            z-index: 2;

        }

        /*==================================================
RESPONSIVE BASE
==================================================*/

        @media(max-width:1100px) {

            .hero-grid {

                grid-template-columns: 1fr;

                gap: 60px;

            }

        }

        @media(max-width:768px) {

            .hero-section {

                padding-top: 140px;

            }

        }

        /*=========================================================
HEADER PREMIUM
Partie 1C-2
=========================================================*/

        /*=========================
HEADER
=========================*/

        header {

            position: fixed;

            top: 20px;

            left: 0;

            width: 100%;

            z-index: 1000;

            transition: .4s ease;

        }

        header.scrolled {

            top: 10px;

        }

        /*=========================
NAVBAR
=========================*/

        .nav-premium {

            display: flex;

            align-items: center;

            justify-content: space-between;

            height: 82px;

            padding: 0 28px;

            border-radius: 22px;

            background: rgba(10, 16, 32, .55);

            border: 1px solid rgba(255, 255, 255, .08);

            backdrop-filter: blur(22px);

            -webkit-backdrop-filter: blur(22px);

            box-shadow:

                0 20px 45px rgba(0, 0, 0, .25);

            transition: .35s ease;

        }

        header.scrolled .nav-premium {

            background: rgba(10, 16, 32, .82);

            box-shadow:

                0 18px 55px rgba(0, 0, 0, .40);

        }

        /*=========================
LOGO
=========================*/

        .logo {

            display: flex;

            align-items: center;

            gap: 14px;

            font-size: 22px;

            font-weight: 800;

            letter-spacing: .5px;

        }

        .logo img {

            width: 48px;

            height: 48px;

            object-fit: contain;

            transition: .35s;

        }

        .logo span {

            color: #fff;

        }

        .logo:hover img {

            transform:

                rotate(-8deg) scale(1.08);

        }

        /*=========================
MENU
=========================*/

        .nav-menu {

            display: flex;

            align-items: center;

            gap: 38px;

        }

        .nav-menu a {

            position: relative;

            font-size: 15px;

            font-weight: 600;

            color: #d6d9df;

            transition: .35s;

        }

        .nav-menu a:hover {

            color: #fff;

        }

        /*=========================
LIGNE ACTIVE
=========================*/

        .nav-menu a::after {

            content: "";

            position: absolute;

            left: 50%;

            bottom: -10px;

            transform: translateX(-50%);

            width: 0;

            height: 3px;

            border-radius: 50px;

            background: linear-gradient(90deg,
                    #f4b400,
                    #ffd75a);

            transition: .35s;

        }

        .nav-menu a:hover::after,
        .nav-menu a.active::after {

            width: 100%;

        }

        .nav-menu a.active {

            color: #fff;

        }

        /*=========================
CTA
=========================*/

        .btn-nav {

            position: relative;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            padding: 15px 28px;

            border-radius: 16px;

            background: linear-gradient(135deg,
                    #f4b400,
                    #d89500);

            color: #111;

            font-weight: 700;

            overflow: hidden;

            transition: .35s;

            box-shadow:

                0 15px 35px rgba(244, 180, 0, .28);

        }

        .btn-nav:hover {

            transform:

                translateY(-4px);

            box-shadow:

                0 22px 50px rgba(244, 180, 0, .35);

        }

        .btn-nav::before {

            content: "";

            position: absolute;

            top: 0;

            left: -130%;

            width: 55%;

            height: 100%;

            transform: skewX(-25deg);

            background: linear-gradient(90deg,

                    transparent,

                    rgba(255, 255, 255, .45),

                    transparent);

        }

        .btn-nav:hover::before {

            animation: navShine .9s forwards;

        }

        @keyframes navShine {

            100% {

                left: 170%;

            }

        }

        /*=========================
MOBILE TOGGLE
=========================*/

        .mobile-toggle {

            display: none;

            width: 52px;

            height: 52px;

            border: none;

            border-radius: 14px;

            background: rgba(255, 255, 255, .06);

            color: #fff;

            cursor: pointer;

            font-size: 20px;

            transition: .35s;

        }

        .mobile-toggle:hover {

            background: rgba(244, 180, 0, .15);

            color: #f4b400;

        }

        /*=========================
RESPONSIVE
=========================*/

        @media(max-width:992px) {

            .nav-menu {

                display: none;

            }

            .btn-nav {

                display: none;

            }

            .mobile-toggle {

                display: flex;

                align-items: center;

                justify-content: center;

            }

            .nav-premium {

                height: 76px;

                padding: 0 20px;

            }

        }

        @media(max-width:576px) {

            header {

                top: 12px;

            }

            .nav-premium {

                border-radius: 18px;

            }

            .logo img {

                width: 42px;

                height: 42px;

            }

            .logo {

                font-size: 18px;

            }

        }
    </style>
    <script>

        /*=========================================
        HEADER AU SCROLL
        =========================================*/

        const header = document.querySelector("header");

        window.addEventListener("scroll", () => {

            if (window.scrollY > 40) {

                header.classList.add("scrolled");

            } else {

                header.classList.remove("scrolled");

            }

        });


        /*=========================================
        LIEN ACTIF AU SCROLL
        =========================================*/

        const sections = document.querySelectorAll("section[id]");
        const navLinks = document.querySelectorAll(".nav-menu a");

        window.addEventListener("scroll", () => {

            let current = "";

            sections.forEach(section => {

                const top = section.offsetTop - 120;

                if (pageYOffset >= top) {

                    current = section.getAttribute("id");

                }

            });

            navLinks.forEach(link => {

                link.classList.remove("active");

                if (link.getAttribute("href") === "#" + current) {

                    link.classList.add("active");

                }

            });

        });

    </script>
    <style>
        /*=========================================================
HERO - COLONNE GAUCHE
Partie 1C-3
=========================================================*/

        /*==============================================
LEFT
==============================================*/

        .hero-left {

            position: relative;

            z-index: 5;

        }

        /*==============================================
BADGE
==============================================*/

        .hero-badge {

            display: inline-flex;

            align-items: center;

            gap: 12px;

            padding: 12px 22px;

            margin-bottom: 28px;

            border-radius: 999px;

            background: rgba(244, 180, 0, .08);

            border: 1px solid rgba(244, 180, 0, .18);

            backdrop-filter: blur(12px);

            color: #f4b400;

            font-size: 14px;

            font-weight: 600;

            letter-spacing: .3px;

            transition: all .35s ease;

        }

        .hero-badge:hover {

            transform: translateY(-3px);

            box-shadow: 0 12px 35px rgba(244, 180, 0, .18);

        }

        .hero-badge i {

            width: 36px;

            height: 36px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 50%;

            background: rgba(244, 180, 0, .15);

            animation: badgePulse 2.5s infinite;

        }

        @keyframes badgePulse {

            0%,
            100% {

                transform: scale(1);

            }

            50% {

                transform: scale(1.08);

            }

        }

        /*==============================================
TITLE
==============================================*/

        .hero-title {

            font-size: 68px;

            line-height: 1.08;

            font-weight: 900;

            letter-spacing: -2px;

            margin-bottom: 28px;

        }

        .hero-title span {

            display: block;

            margin: 12px 0;

            background: linear-gradient(90deg,
                    #ffffff,
                    #f4b400,
                    #ffe082);

            -webkit-background-clip: text;

            -webkit-text-fill-color: transparent;

        }

        /*==============================================
DESCRIPTION
==============================================*/

        .hero-description {

            max-width: 640px;

            color: #b9c3d2;

            font-size: 18px;

            line-height: 1.9;

            margin-bottom: 42px;

        }

        /*==============================================
BUTTONS
==============================================*/

        .hero-buttons {

            display: flex;

            align-items: center;

            gap: 18px;

            margin-bottom: 50px;

        }

        .btn-gold {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 12px;

            padding: 18px 34px;

            border-radius: 18px;

            background: linear-gradient(135deg,
                    #f4b400,
                    #d99800);

            color: #111;

            font-weight: 700;

            transition: .35s;

            box-shadow:
                0 15px 35px rgba(244, 180, 0, .25);

        }

        .btn-gold:hover {

            transform:
                translateY(-5px);

            box-shadow:
                0 22px 50px rgba(244, 180, 0, .35);

        }

        .btn-outline {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            padding: 18px 34px;

            border-radius: 18px;

            border: 1px solid rgba(255, 255, 255, .12);

            background: rgba(255, 255, 255, .04);

            color: #fff;

            backdrop-filter: blur(12px);

            transition: .35s;

        }

        .btn-outline:hover {

            border-color: #f4b400;

            color: #f4b400;

            transform: translateY(-5px);

        }

        /*==============================================
FEATURES
==============================================*/

        .hero-features {

            display: flex;

            flex-wrap: wrap;

            gap: 20px;

        }

        .feature {

            display: flex;

            align-items: center;

            gap: 12px;

            padding: 14px 22px;

            border-radius: 18px;

            background: rgba(255, 255, 255, .04);

            border: 1px solid rgba(255, 255, 255, .06);

            transition: .35s;

        }

        .feature:hover {

            transform: translateY(-5px);

            border-color: rgba(244, 180, 0, .25);

            box-shadow: 0 15px 35px rgba(244, 180, 0, .10);

        }

        .feature i {

            color: #10b981;

            font-size: 18px;

        }

        .feature span {

            color: #e2e8f0;

            font-weight: 600;

        }

        /*==============================================
RESPONSIVE
==============================================*/

        @media(max-width:1200px) {

            .hero-title {

                font-size: 56px;

            }

        }

        @media(max-width:992px) {

            .hero-left {

                text-align: center;

            }

            .hero-description {

                margin-inline: auto;

            }

            .hero-buttons {

                justify-content: center;

            }

            .hero-features {

                justify-content: center;

            }

        }

        @media(max-width:768px) {

            .hero-title {

                font-size: 42px;

                letter-spacing: -1px;

            }

            .hero-description {

                font-size: 16px;

            }

            .hero-buttons {

                flex-direction: column;

            }

            .btn-gold,
            .btn-outline {

                width: 100%;

            }

            .hero-features {

                flex-direction: column;

            }

            .feature {

                width: 100%;

                justify-content: center;

            }

        }

        @media(max-width:480px) {

            .hero-title {

                font-size: 34px;

            }

            .hero-badge {

                font-size: 13px;

                padding: 10px 18px;

            }

        }

        /*=========================================================
HERO - COLONNE DROITE
Partie 1C-4
=========================================================*/

        .hero-right {

            position: relative;

            display: flex;

            justify-content: center;

            align-items: center;

            min-height: 720px;

        }

        /*=========================================
ZONE VISUELLE
=========================================*/

        .hero-visual {

            position: relative;

            width: 100%;

            max-width: 560px;

            height: 650px;

        }

        /*=========================================
HALOS
=========================================*/

        .hero-visual::before {

            content: "";

            position: absolute;

            width: 520px;

            height: 520px;

            left: 50%;

            top: 50%;

            transform: translate(-50%, -50%);

            border-radius: 50%;

            background:

                radial-gradient(circle,
                    rgba(37, 99, 235, .18),
                    transparent 70%);

            filter: blur(50px);

            animation: heroGlow 8s ease-in-out infinite;

        }

        .hero-visual::after {

            content: "";

            position: absolute;

            width: 380px;

            height: 380px;

            left: 50%;

            top: 50%;

            transform: translate(-50%, -50%);

            border-radius: 50%;

            background:

                radial-gradient(circle,
                    rgba(244, 180, 0, .15),
                    transparent 70%);

            filter: blur(40px);

            animation: heroGlow2 10s ease-in-out infinite;

        }

        @keyframes heroGlow {

            0%,
            100% {

                transform:
                    translate(-50%, -50%) scale(1);

            }

            50% {

                transform:
                    translate(-50%, -50%) scale(1.15);

            }

        }

        @keyframes heroGlow2 {

            0%,
            100% {

                opacity: .45;

            }

            50% {

                opacity: .9;

            }

        }

        /*=========================================
ANNEAUX
=========================================*/

        .hero-ring {

            position: absolute;

            border-radius: 50%;

            border: 1px solid rgba(255, 255, 255, .08);

            left: 50%;

            top: 50%;

            transform: translate(-50%, -50%);

        }

        .hero-ring.one {

            width: 420px;

            height: 420px;

            animation: rotateRing 25s linear infinite;

        }

        .hero-ring.two {

            width: 300px;

            height: 300px;

            animation: rotateRingReverse 18s linear infinite;

        }

        .hero-ring.three {

            width: 520px;

            height: 520px;

            animation: rotateRing 35s linear infinite;

        }

        @keyframes rotateRing {

            from {

                transform:
                    translate(-50%, -50%) rotate(0);

            }

            to {

                transform:
                    translate(-50%, -50%) rotate(360deg);

            }

        }

        @keyframes rotateRingReverse {

            from {

                transform:
                    translate(-50%, -50%) rotate(360deg);

            }

            to {

                transform:
                    translate(-50%, -50%) rotate(0);

            }

        }

        /*=========================================
CARTE PRINCIPALE
=========================================*/

        .main-card {

            position: absolute;

            left: 50%;

            top: 50%;

            transform: translate(-50%, -50%);

            width: 360px;

            padding: 40px;

            border-radius: 32px;

            text-align: center;

            background:

                rgba(255, 255, 255, .05);

            backdrop-filter: blur(22px);

            border: 1px solid rgba(255, 255, 255, .08);

            box-shadow:

                0 35px 80px rgba(0, 0, 0, .35);

            transition: .45s;

        }

        .main-card:hover {

            transform:

                translate(-50%, -52%) rotateX(6deg) rotateY(-6deg);

        }

        .main-card-icon {

            width: 100px;

            height: 100px;

            margin: auto;

            border-radius: 30px;

            display: flex;

            justify-content: center;

            align-items: center;

            background:

                linear-gradient(135deg,
                    #f4b400,
                    #d99500);

            color: #111;

            font-size: 42px;

            margin-bottom: 28px;

            animation: floatIcon 3.5s ease-in-out infinite;

        }

        .main-card h3 {

            font-size: 32px;

            font-weight: 800;

            margin-bottom: 18px;

        }

        .main-card p {

            color: #c8d0da;

            line-height: 1.9;

        }

        /*=========================================
FLOATING CARDS
=========================================*/

        .floating-card {

            position: absolute;

            width: 240px;

            padding: 20px;

            border-radius: 22px;

            display: flex;

            align-items: center;

            gap: 16px;

            background:

                rgba(255, 255, 255, .05);

            border: 1px solid rgba(255, 255, 255, .08);

            backdrop-filter: blur(20px);

            transition: .4s;

        }

        .floating-card:hover {

            transform: scale(1.06);

        }

        .floating-icon {

            width: 60px;

            height: 60px;

            border-radius: 18px;

            display: flex;

            justify-content: center;

            align-items: center;

            background:

                linear-gradient(135deg,
                    #2563eb,
                    #4f8df8);

            color: white;

            font-size: 24px;

        }

        .floating-card h4 {

            font-size: 18px;

            font-weight: 700;

        }

        .floating-card span {

            font-size: 14px;

            color: #b8c4d4;

        }

        /*=========================================
POSITION
=========================================*/



        @keyframes floatOne {

            50% {

                transform: translateY(-18px);

            }

        }

        @keyframes floatTwo {

            50% {

                transform: translateY(16px);

            }

        }

        @keyframes floatThree {

            50% {

                transform: translateY(-12px);

            }

        }

        @keyframes floatIcon {

            50% {

                transform: translateY(-8px);

            }

        }

        /*=========================================
RESPONSIVE
=========================================*/

        @media(max-width:992px) {

            .hero-right {

                margin-top: 70px;

                min-height: 620px;

            }

            .hero-visual {

                transform: scale(.9);

            }

        }

        @media(max-width:768px) {

            .hero-visual {

                transform: scale(.72);

                height: 520px;

            }

        }

        @media(max-width:480px) {

            .hero-visual {

                transform: scale(.60);

                height: 420px;

            }

        }
    </style>

    <!--======================================================
NOS SERVICES
=======================================================-->

    <section id="services" class="services-section">

        <!-- Aurora -->

        <div class="services-aurora services-aurora-1"></div>
        <div class="services-aurora services-aurora-2"></div>

        <div class="container">

            <!--=========================
        HEADER
        ==========================-->

            <div class="services-header">

                <span class="section-badge">

                    <i class="fa-solid fa-briefcase"></i>

                    Nos Services

                </span>

                <h2 class="section-title">

                    Des solutions adaptées

                    <span class="text-gold-gradient">

                        à vos besoins

                    </span>

                </h2>

                <p class="section-description">

                    VISIONBF accompagne les entreprises avec des services performants,
                    conçus pour améliorer les échanges avec leurs clients,
                    développer leur activité et optimiser leurs opérations.

                </p>

            </div>

            <!--=========================
        SERVICES GRID
        ==========================-->

            <div class="services-grid">

                <!-- Téléprospection -->

                <article class="service-card service-blue glass">
                    <div class="border-light"></div>
                    <div class="light-circle"></div>

                    <div class="service-icon">

                        <i class="fa-solid fa-phone-volume"></i>

                    </div>

                    <h3>Téléprospection</h3>

                    <p>

                        Développez votre portefeuille clients grâce à des campagnes de prospection ciblées et efficaces.

                    </p>

                    <ul>

                        <li><i class="fa-solid fa-check"></i> Prospection ciblée</li>
                        <li><i class="fa-solid fa-check"></i> Qualification des contacts</li>
                        <li><i class="fa-solid fa-check"></i> Suivi personnalisé</li>

                    </ul>

                    <a href="#contact">

                        En savoir plus

                        <i class="fa-solid fa-arrow-right"></i>

                    </a>

                </article>

                <!-- Développement Commercial -->

                <article class="service-card service-gold glass">

                    <div class="service-icon">

                        <i class="fa-solid fa-chart-line"></i>

                    </div>

                    <h3>Développement Commercial</h3>

                    <p>

                        Accélérez votre croissance grâce à une stratégie commerciale adaptée à vos objectifs.

                    </p>

                    <ul>

                        <li><i class="fa-solid fa-check"></i> Acquisition de clients</li>
                        <li><i class="fa-solid fa-check"></i> Détection d'opportunités</li>
                        <li><i class="fa-solid fa-check"></i> Accompagnement commercial</li>

                    </ul>

                    <a href="#contact">

                        En savoir plus

                        <i class="fa-solid fa-arrow-right"></i>

                    </a>

                </article>

                <!-- Service Client -->

                <article class="service-card service-green glass">

                    <div class="service-icon">

                        <i class="fa-solid fa-headset"></i>

                    </div>

                    <h3>Service Client</h3>

                    <p>

                        Offrez à vos clients une assistance réactive, professionnelle et personnalisée.

                    </p>

                    <ul>

                        <li><i class="fa-solid fa-check"></i> Assistance téléphonique</li>
                        <li><i class="fa-solid fa-check"></i> Gestion des demandes</li>
                        <li><i class="fa-solid fa-check"></i> Suivi de qualité</li>

                    </ul>

                    <a href="#contact">

                        En savoir plus

                        <i class="fa-solid fa-arrow-right"></i>

                    </a>

                </article>

                <!-- Prise de Rendez-vous -->

                <article class="service-card service-purple glass">

                    <div class="service-icon">

                        <i class="fa-solid fa-calendar-check"></i>

                    </div>

                    <h3>Prise de Rendez-vous</h3>

                    <p>

                        Optimisez votre agenda grâce à une organisation rigoureuse de vos rendez-vous.

                    </p>

                    <ul>

                        <li><i class="fa-solid fa-check"></i> Planification</li>
                        <li><i class="fa-solid fa-check"></i> Confirmation</li>
                        <li><i class="fa-solid fa-check"></i> Relance</li>

                    </ul>

                    <a href="#contact">

                        En savoir plus

                        <i class="fa-solid fa-arrow-right"></i>

                    </a>

                </article>

                <!-- Enquêtes -->

                <article class="service-card service-cyan glass">

                    <div class="service-icon">

                        <i class="fa-solid fa-chart-pie"></i>

                    </div>

                    <h3>Enquêtes & Sondages</h3>

                    <p>

                        Mesurez la satisfaction de vos clients et recueillez des informations utiles à votre
                        développement.

                    </p>

                    <ul>

                        <li><i class="fa-solid fa-check"></i> Études de satisfaction</li>
                        <li><i class="fa-solid fa-check"></i> Analyse des retours</li>
                        <li><i class="fa-solid fa-check"></i> Rapports détaillés</li>

                    </ul>

                    <a href="#contact">

                        En savoir plus

                        <i class="fa-solid fa-arrow-right"></i>

                    </a>

                </article>

                <!-- Externalisation -->

                <article class="service-card service-orange glass">

                    <div class="service-icon">

                        <i class="fa-solid fa-gears"></i>

                    </div>

                    <h3>Externalisation</h3>

                    <p>

                        Confiez certaines activités à nos équipes afin de gagner du temps et de vous concentrer sur
                        votre métier.

                    </p>

                    <ul>

                        <li><i class="fa-solid fa-check"></i> Gestion opérationnelle</li>
                        <li><i class="fa-solid fa-check"></i> Processus optimisés</li>
                        <li><i class="fa-solid fa-check"></i> Accompagnement continu</li>

                    </ul>

                    <a href="#contact">

                        En savoir plus

                        <i class="fa-solid fa-arrow-right"></i>

                    </a>

                </article>

            </div>

            <!--=========================
        BLOC AVANTAGES
        ==========================-->

            <div class="services-bottom glass">

                <h3>

                    Pourquoi choisir VISIONBF ?

                </h3>

                <div class="advantages-grid">

                    <div><i class="fa-solid fa-circle-check"></i> Équipe qualifiée</div>

                    <div><i class="fa-solid fa-circle-check"></i> Solutions personnalisées</div>

                    <div><i class="fa-solid fa-circle-check"></i> Réactivité</div>

                    <div><i class="fa-solid fa-circle-check"></i> Accompagnement sur mesure</div>

                    <div><i class="fa-solid fa-circle-check"></i> Qualité de service</div>

                    <div><i class="fa-solid fa-circle-check"></i> Engagement durable</div>

                </div>

            </div>

        </div>

    </section>

    <style>
        /*=========================================================
SERVICES
Partie 2B-1
=========================================================*/

        .services-section {

            position: relative;

            padding: 140px 0;

            overflow: hidden;

        }

        /*======================================
AURORA
======================================*/

        .services-aurora {

            position: absolute;

            border-radius: 50%;

            filter: blur(140px);

            pointer-events: none;

            opacity: .25;

        }

        .services-aurora-1 {

            width: 450px;

            height: 450px;

            left: -180px;

            top: 120px;

            background: #2563eb;

        }

        .services-aurora-2 {

            width: 420px;

            height: 420px;

            right: -150px;

            bottom: 50px;

            background: #f4b400;

        }

        /*======================================
HEADER
======================================*/

        .services-header {

            max-width: 850px;

            margin: auto;

            text-align: center;

            margin-bottom: 90px;

        }

        .section-badge {

            display: inline-flex;

            align-items: center;

            gap: 12px;

            padding: 12px 24px;

            border-radius: 999px;

            background: rgba(255, 255, 255, .04);

            border: 1px solid rgba(255, 255, 255, .08);

            color: #f4b400;

            font-weight: 600;

            margin-bottom: 28px;

        }

        .section-title {

            font-size: 60px;

            font-weight: 900;

            line-height: 1.1;

            margin-bottom: 24px;

        }

        .section-description {

            color: #b8c3d2;

            font-size: 19px;

            line-height: 1.9;

        }

        /*======================================
GRID
======================================*/

        .services-grid {

            display: grid;

            grid-template-columns: repeat(3, 1fr);

            gap: 30px;

        }

        /*======================================
CARD
======================================*/

        .service-card {

            position: relative;

            overflow: hidden;

            padding: 40px;

            border-radius: 30px;

            background: rgba(255, 255, 255, .04);

            border: 1px solid rgba(255, 255, 255, .08);

            backdrop-filter: blur(20px);

            transition: .45s;

            cursor: pointer;

            min-height: 470px;

        }

        .service-card:hover {

            transform: translateY(-12px);

            box-shadow:

                0 30px 70px rgba(0, 0, 0, .30);

        }

        .service-card h3 {

            font-size: 28px;

            font-weight: 800;

            margin: 28px 0 18px;

        }

        .service-card p {

            color: #b9c5d3;

            line-height: 1.8;

            margin-bottom: 24px;

        }

        /*======================================
LIST
======================================*/

        .service-card ul {

            display: flex;

            flex-direction: column;

            gap: 14px;

        }

        .service-card li {

            display: flex;

            align-items: center;

            gap: 12px;

            color: #dce4ef;

        }

        .service-card li i {

            color: #10b981;

        }

        /*======================================
LINK
======================================*/

        .service-card a {

            display: inline-flex;

            align-items: center;

            gap: 12px;

            margin-top: 35px;

            font-weight: 700;

            color: #fff;

            transition: .35s;

        }

        .service-card:hover a {

            color: #f4b400;

        }

        .service-card a i {

            transition: .35s;

        }

        .service-card:hover a i {

            transform: translateX(8px);

        }

        /*======================================
BOTTOM
======================================*/

        .services-bottom {

            margin-top: 90px;

            padding: 60px;

            border-radius: 35px;

            text-align: center;

        }

        .services-bottom h3 {

            font-size: 38px;

            margin-bottom: 45px;

            font-weight: 900;

        }

        .advantages-grid {

            display: grid;

            grid-template-columns: repeat(3, 1fr);

            gap: 25px;

        }

        .advantages-grid div {

            display: flex;

            align-items: center;

            justify-content: center;

            gap: 12px;

            padding: 22px;

            border-radius: 18px;

            background: rgba(255, 255, 255, .03);

            border: 1px solid rgba(255, 255, 255, .05);

            transition: .35s;

        }

        .advantages-grid div:hover {

            transform: translateY(-5px);

        }

        .advantages-grid i {

            color: #10b981;

        }

        /*======================================
RESPONSIVE
======================================*/

        @media(max-width:1200px) {

            .services-grid {

                grid-template-columns: repeat(2, 1fr);

            }

        }

        @media(max-width:768px) {

            .section-title {

                font-size: 42px;

            }

            .services-grid {

                grid-template-columns: 1fr;

            }

            .advantages-grid {

                grid-template-columns: 1fr;

            }

            .services-bottom {

                padding: 35px;

            }

        }

        /*=========================================================
SERVICES
Partie 2B-2
Icônes + Couleurs + Halos
=========================================================*/

        /*=========================================
ICONE
=========================================*/

        .service-icon {

            position: relative;

            width: 90px;

            height: 90px;

            border-radius: 28px;

            display: flex;

            justify-content: center;

            align-items: center;

            font-size: 34px;

            color: #ffffff;

            overflow: hidden;

            transition: all .45s ease;

            z-index: 2;

        }

        /* Halo interne */

        .service-icon::before {

            content: "";

            position: absolute;

            inset: 0;

            border-radius: inherit;

            opacity: .25;

            transform: scale(.8);

            transition: .45s;

        }

        .service-card:hover .service-icon::before {

            transform: scale(1.3);

            opacity: .45;

        }

        /*=========================================
COULEURS PAR SERVICE
=========================================*/

        /* Bleu */

        .service-blue .service-icon {

            background: linear-gradient(135deg,
                    #2563eb,
                    #3b82f6);

            box-shadow:
                0 15px 40px rgba(37, 99, 235, .35);

        }

        .service-blue .service-icon::before {

            background: #2563eb;

        }

        /* Doré */

        .service-gold .service-icon {

            background: linear-gradient(135deg,
                    #f4b400,
                    #d89600);

            color: #111827;

            box-shadow:
                0 15px 40px rgba(244, 180, 0, .35);

        }

        .service-gold .service-icon::before {

            background: #f4b400;

        }

        /* Vert */

        .service-green .service-icon {

            background: linear-gradient(135deg,
                    #10b981,
                    #34d399);

            box-shadow:
                0 15px 40px rgba(16, 185, 129, .35);

        }

        .service-green .service-icon::before {

            background: #10b981;

        }

        /* Violet */

        .service-purple .service-icon {

            background: linear-gradient(135deg,
                    #7c3aed,
                    #8b5cf6);

            box-shadow:
                0 15px 40px rgba(124, 58, 237, .35);

        }

        .service-purple .service-icon::before {

            background: #7c3aed;

        }

        /* Cyan */

        .service-cyan .service-icon {

            background: linear-gradient(135deg,
                    #06b6d4,
                    #22d3ee);

            box-shadow:
                0 15px 40px rgba(6, 182, 212, .35);

        }

        .service-cyan .service-icon::before {

            background: #06b6d4;

        }

        /* Orange */

        .service-orange .service-icon {

            background: linear-gradient(135deg,
                    #f97316,
                    #fb923c);

            box-shadow:
                0 15px 40px rgba(249, 115, 22, .35);

        }

        .service-orange .service-icon::before {

            background: #f97316;

        }

        /*=========================================
HALO AUTOUR DES CARTES
=========================================*/

        .service-card::before {

            content: "";

            position: absolute;

            width: 280px;

            height: 280px;

            border-radius: 50%;

            top: -150px;

            right: -150px;

            opacity: 0;

            filter: blur(25px);

            transition: .6s ease;

        }

        /* Halo par couleur */

        .service-blue::before {

            background: #2563eb;

        }

        .service-gold::before {

            background: #f4b400;

        }

        .service-green::before {

            background: #10b981;

        }

        .service-purple::before {

            background: #7c3aed;

        }

        .service-cyan::before {

            background: #06b6d4;

        }

        .service-orange::before {

            background: #f97316;

        }

        .service-card:hover::before {

            opacity: .18;

        }

        /*=========================================
LIGNE LUMINEUSE
=========================================*/

        .service-card::after {

            content: "";

            position: absolute;

            left: -120%;

            top: 0;

            width: 60%;

            height: 100%;

            transform: skewX(-25deg);

            background:

                linear-gradient(90deg,

                    transparent,

                    rgba(255, 255, 255, .22),

                    transparent);

        }

        .service-card:hover::after {

            animation: serviceShine .9s forwards;

        }

        @keyframes serviceShine {

            100% {

                left: 180%;

            }

        }

        /*=========================================
ROTATION DES ICONES
=========================================*/

        .service-card:hover .service-icon {

            transform:

                rotate(10deg) scale(1.08);

        }

        /*=========================================
FLOATING
=========================================*/

        .service-icon {

            animation: serviceFloat 4s ease-in-out infinite;

        }

        .service-card:nth-child(2) .service-icon {

            animation-delay: .3s;

        }

        .service-card:nth-child(3) .service-icon {

            animation-delay: .6s;

        }

        .service-card:nth-child(4) .service-icon {

            animation-delay: .9s;

        }

        .service-card:nth-child(5) .service-icon {

            animation-delay: 1.2s;

        }

        .service-card:nth-child(6) .service-icon {

            animation-delay: 1.5s;

        }

        @keyframes serviceFloat {

            0%,
            100% {

                transform: translateY(0);

            }

            50% {

                transform: translateY(-8px);

            }

        }

        /*=========================================================
SERVICES
Partie 2B-3
Hover 3D + Bordures animées + Micro-interactions
=========================================================*/

        /*=========================================
BASE 3D
=========================================*/

        .services-grid {

            perspective: 1800px;

        }

        .service-card {

            transform-style: preserve-3d;

            transition:
                transform .55s cubic-bezier(.22, 1, .36, 1),
                box-shadow .45s ease,
                border-color .45s ease,
                background .45s ease;

        }

        /*=========================================
HOVER PREMIUM
=========================================*/

        .service-card:hover {

            transform:

                perspective(1800px) rotateX(8deg) rotateY(-8deg) translateY(-18px) scale(1.02);

        }

        /*=========================================
BORDURE ANIMÉE
=========================================*/

        .service-card {

            isolation: isolate;

        }

        .service-card::before {

            z-index: -2;

        }

        .service-card::after {

            z-index: -1;

        }

        .service-card .border-light {

            position: absolute;

            inset: 0;

            border-radius: 30px;

            padding: 1px;

            background:

                linear-gradient(135deg,

                    transparent,

                    rgba(255, 255, 255, .35),

                    transparent,

                    rgba(255, 255, 255, .10),

                    transparent);

            -webkit-mask:

                linear-gradient(#fff 0 0) content-box,

                linear-gradient(#fff 0 0);

            -webkit-mask-composite: xor;

            mask-composite: exclude;

            opacity: 0;

            transition: .45s;

            pointer-events: none;

        }

        .service-card:hover .border-light {

            opacity: 1;

        }

        /*=========================================
OMBRE DYNAMIQUE
=========================================*/

        .service-card:hover {

            box-shadow:

                0 18px 40px rgba(0, 0, 0, .20),

                0 35px 90px rgba(0, 0, 0, .40);

        }

        /*=========================================
LUMIÈRE RADIALE
=========================================*/

        .service-card .light-circle {

            position: absolute;

            width: 220px;

            height: 220px;

            border-radius: 50%;

            right: -100px;

            top: -100px;

            filter: blur(45px);

            opacity: 0;

            transition: .55s;

            pointer-events: none;

        }

        .service-blue .light-circle {

            background: #2563eb;

        }

        .service-gold .light-circle {

            background: #f4b400;

        }

        .service-green .light-circle {

            background: #10b981;

        }

        .service-purple .light-circle {

            background: #7c3aed;

        }

        .service-cyan .light-circle {

            background: #06b6d4;

        }

        .service-orange .light-circle {

            background: #f97316;

        }

        .service-card:hover .light-circle {

            opacity: .18;

        }

        /*=========================================
TITRE
=========================================*/

        .service-card h3 {

            transition: .35s;

        }

        .service-card:hover h3 {

            transform: translateX(8px);

        }

        /*=========================================
PARAGRAPHE
=========================================*/

        .service-card p {

            transition: .35s;

        }

        .service-card:hover p {

            color: #ffffff;

        }

        /*=========================================
LISTE
=========================================*/

        .service-card li {

            transition: .35s;

        }

        .service-card:hover li {

            transform: translateX(8px);

        }

        .service-card li:nth-child(2) {

            transition-delay: .04s;

        }

        .service-card li:nth-child(3) {

            transition-delay: .08s;

        }

        /*=========================================
ICÔNE
=========================================*/

        .service-card:hover .service-icon {

            box-shadow:

                0 18px 45px rgba(255, 255, 255, .10);

        }

        /*=========================================
BOUTON
=========================================*/

        .service-card a {

            position: relative;

            overflow: hidden;

        }

        .service-card a::before {

            content: "";

            position: absolute;

            left: -120%;

            top: 0;

            width: 55%;

            height: 100%;

            background:

                linear-gradient(90deg,

                    transparent,

                    rgba(255, 255, 255, .45),

                    transparent);

            transform: skewX(-25deg);

        }

        .service-card:hover a::before {

            animation: btnShine .8s forwards;

        }

        @keyframes btnShine {

            100% {

                left: 180%;

            }

        }

        /*=========================================
FOND
=========================================*/

        .service-card:hover {

            background:

                linear-gradient(180deg,

                    rgba(255, 255, 255, .08),

                    rgba(255, 255, 255, .04));

        }

        /*=========================================
EFFET SUR L'ICÔNE
=========================================*/

        .service-card:hover .service-icon i {

            animation: iconBounce .7s ease;

        }

        @keyframes iconBounce {

            0% {

                transform: scale(.8);

            }

            50% {

                transform: scale(1.2);

            }

            100% {

                transform: scale(1);

            }

        }

        /*=========================================
RESPONSIVE
=========================================*/

        @media(max-width:992px) {

            .service-card:hover {

                transform:

                    translateY(-10px) scale(1.02);

            }

        }

        /*=========================================================
POURQUOI CHOISIR VISIONBF
Partie 2B-4
=========================================================*/

        .services-bottom {

            position: relative;

            overflow: hidden;

            margin-top: 120px;

            padding: 70px;

            border-radius: 36px;

            background: rgba(255, 255, 255, .04);

            border: 1px solid rgba(255, 255, 255, .08);

            backdrop-filter: blur(22px);

            box-shadow:
                0 30px 80px rgba(0, 0, 0, .25);

        }

        /*=========================================
AURORA
=========================================*/

        .services-bottom::before {

            content: "";

            position: absolute;

            width: 420px;

            height: 420px;

            top: -220px;

            right: -180px;

            border-radius: 50%;

            background: #2563eb;

            filter: blur(110px);

            opacity: .18;

        }

        .services-bottom::after {

            content: "";

            position: absolute;

            width: 350px;

            height: 350px;

            left: -150px;

            bottom: -180px;

            border-radius: 50%;

            background: #f4b400;

            filter: blur(100px);

            opacity: .15;

        }

        /*=========================================
TITLE
=========================================*/

        .services-bottom h3 {

            position: relative;

            z-index: 2;

            text-align: center;

            font-size: 44px;

            font-weight: 900;

            margin-bottom: 55px;

            color: #fff;

        }

        /*=========================================
GRID
=========================================*/

        .advantages-grid {

            position: relative;

            z-index: 2;

            display: grid;

            grid-template-columns: repeat(3, 1fr);

            gap: 26px;

        }

        /*=========================================
ITEM
=========================================*/

        .advantages-grid div {

            position: relative;

            display: flex;

            align-items: center;

            gap: 18px;

            padding: 24px;

            border-radius: 20px;

            background: rgba(255, 255, 255, .05);

            border: 1px solid rgba(255, 255, 255, .08);

            transition: .45s;

            overflow: hidden;

        }

        /*=========================================
LUMIERE
=========================================*/

        .advantages-grid div::before {

            content: "";

            position: absolute;

            left: -120%;

            top: 0;

            width: 60%;

            height: 100%;

            transform: skewX(-25deg);

            background:

                linear-gradient(90deg,

                    transparent,

                    rgba(255, 255, 255, .28),

                    transparent);

        }

        .advantages-grid div:hover::before {

            animation: advShine .9s forwards;

        }

        @keyframes advShine {

            100% {

                left: 180%;

            }

        }

        /*=========================================
HOVER
=========================================*/

        .advantages-grid div:hover {

            transform:

                translateY(-8px) scale(1.03);

            border-color: rgba(244, 180, 0, .25);

            box-shadow:

                0 18px 45px rgba(0, 0, 0, .25);

        }

        /*=========================================
ICON
=========================================*/

        .advantages-grid i {

            width: 52px;

            height: 52px;

            border-radius: 16px;

            display: flex;

            justify-content: center;

            align-items: center;

            background:

                linear-gradient(135deg,
                    #10b981,
                    #34d399);

            color: white;

            font-size: 20px;

            flex-shrink: 0;

            transition: .35s;

        }

        .advantages-grid div:hover i {

            transform:

                rotate(12deg) scale(1.12);

        }

        /*=========================================
TEXT
=========================================*/

        .advantages-grid div {

            font-size: 17px;

            font-weight: 600;

            color: #eef2ff;

        }

        /*=========================================
RESPONSIVE
=========================================*/

        @media(max-width:1100px) {

            .advantages-grid {

                grid-template-columns: repeat(2, 1fr);

            }

        }

        @media(max-width:768px) {

            .services-bottom {

                padding: 40px 28px;

            }

            .services-bottom h3 {

                font-size: 34px;

            }

            .advantages-grid {

                grid-template-columns: 1fr;

            }

        }
    </style>
    <!--=========================================
STATISTIQUES
==========================================-->

    <div class="stats-section">

        <div class="stats-grid">

            <div class="stat-card glass">

                <div class="stat-icon">
                    <i class="fa-solid fa-users"></i>
                </div>

                <h3 class="counter" data-target="500">0</h3>

                <p>Clients accompagnés</p>

            </div>

            <div class="stat-card glass">

                <div class="stat-icon">

                    <i class="fa-solid fa-chart-line"></i>

                </div>

                <h3 class="counter" data-target="98">0</h3>

                <p>Taux de satisfaction (%)</p>

            </div>

            <div class="stat-card glass">

                <div class="stat-icon">

                    <i class="fa-solid fa-headset"></i>

                </div>

                <h3 class="counter" data-target="24">0</h3>

                <p>Disponibilité (heures/jour)</p>

            </div>

            <div class="stat-card glass">

                <div class="stat-icon">

                    <i class="fa-solid fa-handshake"></i>

                </div>

                <h3 class="counter" data-target="15">0</h3>

                <p>Années d'expérience</p>

            </div>

        </div>

    </div>
    <style>
        /*=========================================================
STATISTIQUES PREMIUM
=========================================================*/

        .stats-section {

            margin-top: 90px;

        }

        .stats-grid {

            display: grid;

            grid-template-columns: repeat(4, 1fr);

            gap: 30px;

        }

        .stat-card {

            position: relative;

            overflow: hidden;

            text-align: center;

            padding: 45px 30px;

            border-radius: 28px;

            transition: .45s;

            border: 1px solid rgba(255, 255, 255, .08);

        }

        .stat-card:hover {

            transform:

                translateY(-10px) scale(1.03);

            box-shadow:

                0 25px 60px rgba(0, 0, 0, .25);

        }

        .stat-card::before {

            content: "";

            position: absolute;

            width: 220px;

            height: 220px;

            right: -100px;

            top: -100px;

            border-radius: 50%;

            background:

                radial-gradient(circle,

                    rgba(244, 180, 0, .25),

                    transparent 70%);

            opacity: 0;

            transition: .5s;

        }

        .stat-card:hover::before {

            opacity: 1;

        }

        .stat-icon {

            width: 82px;

            height: 82px;

            margin: auto;

            margin-bottom: 25px;

            border-radius: 24px;

            display: flex;

            justify-content: center;

            align-items: center;

            background:

                linear-gradient(135deg,

                    #2563eb,

                    #4f8df8);

            color: white;

            font-size: 30px;

            box-shadow:

                0 18px 45px rgba(37, 99, 235, .30);

        }

        .stat-card:nth-child(2) .stat-icon {

            background: linear-gradient(135deg, #f4b400, #d99600);

        }

        .stat-card:nth-child(3) .stat-icon {

            background: linear-gradient(135deg, #10b981, #34d399);

        }

        .stat-card:nth-child(4) .stat-icon {

            background: linear-gradient(135deg, #7c3aed, #8b5cf6);

        }

        .stat-card h3 {

            font-size: 56px;

            font-weight: 900;

            margin-bottom: 10px;

            color: #fff;

        }

        .stat-card p {

            color: #b9c5d3;

            font-size: 17px;

        }

        @media(max-width:1100px) {

            .stats-grid {

                grid-template-columns: repeat(2, 1fr);

            }

        }

        @media(max-width:768px) {

            .stats-grid {

                grid-template-columns: 1fr;

            }

            .stat-card h3 {

                font-size: 44px;

            }

        }
    </style>
    <script>

        const counters = document.querySelectorAll(".counter");

        const observer = new IntersectionObserver(entries => {

            entries.forEach(entry => {

                if (!entry.isIntersecting) return;

                const counter = entry.target;

                const target = parseInt(counter.dataset.target);

                let value = 0;

                const speed = Math.max(10, Math.floor(target / 80));

                const update = () => {

                    if (value < target) {

                        value += speed;

                        if (value > target) value = target;

                        counter.textContent = value + "+";

                        requestAnimationFrame(update);

                    }

                };

                update();

                observer.unobserve(counter);

            });

        }, { threshold: .5 });

        counters.forEach(counter => observer.observe(counter));

    </script>
    <!--======================================================
QUI SOMMES-NOUS ?
=======================================================-->















    <!--======================================================
QUI SOMMES-NOUS ?
=======================================================-->

    <section id="about" class="about-section">

        <!-- Aurora -->
        <div class="about-aurora about-aurora-1"></div>
        <div class="about-aurora about-aurora-2"></div>

        <div class="container">

            <!-- HEADER -->
            <div class="about-header">

                <span class="section-badge">
                    <i class="fa-solid fa-building"></i>
                    Qui sommes-nous ?
                </span>

                <h2 class="section-title">
                    Une équipe engagée pour
                    <span class="text-gold-gradient">
                        développer votre activité
                    </span>
                </h2>

                <p class="section-description">
                    Vision BF accompagne les entreprises dans leur développement
                    commercial grâce à des solutions performantes de
                    téléprospection, de relation client et d'externalisation
                    des services.
                </p>

            </div>

            <!-- GRID -->
            <div class="about-grid">

                <!--======================================================
            COLONNE GAUCHE
            =======================================================-->

                <div class="about-left">

                    <div class="about-card">

                        <span class="about-mini-title">

                            À propos de nous

                        </span>

                        <h3>

                            Nous aidons les entreprises
                            à développer durablement
                            leur portefeuille clients.

                        </h3>

                        <p>

                            Notre mission est d'accompagner chaque entreprise
                            avec des solutions adaptées, des équipes qualifiées
                            et une approche orientée résultats.

                        </p>

                        <p>

                            Grâce à notre expertise, nous mettons en place
                            des stratégies commerciales efficaces afin
                            d'améliorer la prospection, la fidélisation
                            et la satisfaction client.

                        </p>

                        <!-- Points forts -->

                        <div class="about-features">

                            <div class="feature-item">

                                <i class="fa-solid fa-circle-check"></i>

                                <span>Équipe expérimentée</span>

                            </div>

                            <div class="feature-item">

                                <i class="fa-solid fa-circle-check"></i>

                                <span>Solutions sur mesure</span>

                            </div>

                            <div class="feature-item">

                                <i class="fa-solid fa-circle-check"></i>

                                <span>Accompagnement personnalisé</span>

                            </div>

                            <div class="feature-item">

                                <i class="fa-solid fa-circle-check"></i>

                                <span>Résultats mesurables</span>

                            </div>

                        </div>

                    </div>

                </div>

                <!--======================================================
            COLONNE DROITE
            =======================================================-->

                <div class="about-right">

                    <!-- Carte principale -->

                    <div class="about-company-card">

                        <div class="company-icon">

                            <i class="fa-solid fa-building"></i>

                        </div>

                        <h3>

                            Vision BF

                        </h3>

                        <p>

                            Votre partenaire de confiance pour
                            développer votre activité commerciale
                            et renforcer votre relation client.

                        </p>

                        <!-- Statistiques -->

                        <div class="company-stats">

                            <div class="stat-box">

                                <span class="number">+150</span>

                                <small>Clients</small>

                            </div>

                            <div class="stat-box">

                                <span class="number">98%</span>

                                <small>Satisfaction</small>

                            </div>

                            <div class="stat-box">

                                <span class="number">24/7</span>

                                <small>Support</small>

                            </div>

                        </div>

                    </div>

                    <!-- Cartes flottantes -->

                    <div class="floating-card floating-one">

                        <i class="fa-solid fa-headset"></i>

                        <span>Relation Client</span>

                    </div>



                    <div class="floating-card floating-three">

                        <i class="fa-solid fa-users"></i>

                        <span>Équipe Qualifiée</span>

                    </div>

                </div>

            </div>

            <!--======================================================
        MISSION • VISION • VALEURS
        =======================================================-->

            <div class="about-values">

                <!-- Mission -->

                <article class="value-card">

                    <div class="value-icon">

                        <i class="fa-solid fa-bullseye"></i>

                    </div>

                    <h3>Notre mission</h3>

                    <p>

                        Accompagner les entreprises dans leur croissance
                        en proposant des solutions commerciales efficaces,
                        adaptées à leurs objectifs.

                    </p>

                </article>

                <!-- Vision -->

                <article class="value-card">

                    <div class="value-icon">

                        <i class="fa-solid fa-eye"></i>

                    </div>

                    <h3>Notre vision</h3>

                    <p>

                        Devenir un partenaire de référence en offrant
                        des services innovants, performants
                        et centrés sur la satisfaction client.

                    </p>

                </article>

                <!-- Valeurs -->

                <article class="value-card">

                    <div class="value-icon">

                        <i class="fa-solid fa-handshake"></i>

                    </div>

                    <h3>Nos valeurs</h3>

                    <p>

                        Engagement, professionnalisme,
                        transparence, proximité et recherche
                        permanente de l'excellence.

                    </p>

                </article>

            </div>

        </div>

    </section>

    <style>
        /*=========================================================
QUI SOMMES-NOUS
3B-1
Structure + Header + Aurora + Layout
=========================================================*/

        .about-section {

            position: relative;

            padding: 160px 0;

            overflow: hidden;

            isolation: isolate;

        }

        /*=========================================================
AURORA
=========================================================*/

        .about-aurora {

            position: absolute;

            border-radius: 50%;

            filter: blur(140px);

            opacity: .18;

            pointer-events: none;

            z-index: -1;

        }

        .about-aurora-1 {

            width: 520px;

            height: 520px;

            top: -120px;

            left: -180px;

            background: #2563eb;

        }

        .about-aurora-2 {

            width: 460px;

            height: 460px;

            right: -180px;

            bottom: -80px;

            background: #f4b400;

        }

        /*=========================================================
HEADER
=========================================================*/

        .about-header {

            max-width: 850px;

            margin: 0 auto 90px;

            text-align: center;

        }

        .about-header .section-title {

            margin: 24px 0;

            font-size: clamp(38px, 5vw, 64px);

            font-weight: 900;

            line-height: 1.1;

        }

        .about-header .section-description {

            max-width: 760px;

            margin: auto;

            color: #b7c5d6;

            font-size: 18px;

            line-height: 1.9;

        }

        /*=========================================================
LAYOUT
=========================================================*/

        .about-grid {

            display: grid;

            grid-template-columns: 1.1fr .9fr;

            gap: 70px;

            align-items: center;

            margin-bottom: 110px;

        }

        /*=========================================================
COLONNES
=========================================================*/

        .about-left {

            position: relative;

            z-index: 2;

        }

        .about-right {

            position: relative;

            min-height: 650px;

        }

        /*=========================================================
CARTE PRINCIPALE
=========================================================*/

        .about-card {

            position: relative;

            padding: 55px;

            border-radius: 32px;

            background: rgba(255, 255, 255, .05);

            border: 1px solid rgba(255, 255, 255, .08);

            backdrop-filter: blur(24px);

            overflow: hidden;

        }

        .about-card::before {

            content: "";

            position: absolute;

            width: 340px;

            height: 340px;

            right: -170px;

            top: -170px;

            border-radius: 50%;

            background:

                radial-gradient(circle,

                    rgba(37, 99, 235, .18),

                    transparent 70%);

        }

        /*=========================================================
TEXTES
=========================================================*/

        .about-mini-title {

            display: inline-flex;

            padding: 8px 18px;

            border-radius: 999px;

            background: rgba(244, 180, 0, .12);

            color: #f4b400;

            font-size: 13px;

            font-weight: 700;

            letter-spacing: .08em;

            text-transform: uppercase;

        }

        .about-card h3 {

            margin: 24px 0;

            font-size: 38px;

            line-height: 1.25;

            font-weight: 800;

        }

        .about-card p {

            margin-bottom: 22px;

            color: #bcc8d6;

            line-height: 1.9;

            font-size: 17px;

        }

        /*=========================================================
POINTS FORTS
=========================================================*/

        .about-features {

            margin-top: 40px;

            display: grid;

            grid-template-columns: repeat(2, 1fr);

            gap: 18px;

        }

        .feature-item {

            display: flex;

            align-items: center;

            gap: 14px;

            padding: 18px;

            border-radius: 18px;

            background: rgba(255, 255, 255, .04);

            border: 1px solid rgba(255, 255, 255, .07);

            transition: border-color .35s ease,
                background .35s ease;

        }

        .feature-item i {

            color: #10b981;

            font-size: 18px;

        }

        .feature-item span {

            color: #eef4ff;

            font-weight: 600;

        }

        /*=========================================================
HOVER
=========================================================*/

        .feature-item:hover {

            border-color: rgba(37, 99, 235, .30);

            background: rgba(37, 99, 235, .06);

        }

        /*=========================================================
RESPONSIVE
=========================================================*/

        @media(max-width:1200px) {

            .about-grid {

                gap: 50px;

            }

        }

        @media(max-width:992px) {

            .about-grid {

                grid-template-columns: 1fr;

            }

            .about-right {

                min-height: 520px;

                margin-top: 60px;

            }

            .about-card {

                padding: 42px;

            }

        }

        @media(max-width:768px) {

            .about-section {

                padding: 120px 0;

            }

            .about-card {

                padding: 30px;

            }

            .about-card h3 {

                font-size: 30px;

            }

            .about-features {

                grid-template-columns: 1fr;

            }

        }

        @media(max-width:480px) {

            .about-header .section-title {

                font-size: 34px;

            }

            .about-card {

                padding: 24px;

            }

        }

        /*=========================================================
QUI SOMMES-NOUS
3B-2
Carte principale + Cartes flottantes
=========================================================*/

        /*=========================================================
CARTE ENTREPRISE
=========================================================*/

        .about-company-card {

            position: relative;

            z-index: 5;

            padding: 50px;

            border-radius: 34px;

            background: rgba(255, 255, 255, .06);

            border: 1px solid rgba(255, 255, 255, .08);

            backdrop-filter: blur(24px);

            overflow: hidden;

            box-shadow:
                0 35px 80px rgba(0, 0, 0, .25);

            transition:
                box-shadow .4s ease;

        }

        .about-company-card::before {

            content: "";

            position: absolute;

            width: 320px;

            height: 320px;

            top: -160px;

            right: -160px;

            border-radius: 50%;

            background:
                radial-gradient(circle,
                    rgba(37, 99, 235, .20),
                    transparent 70%);

        }

        .about-company-card::after {

            content: "";

            position: absolute;

            width: 260px;

            height: 260px;

            bottom: -130px;

            left: -130px;

            border-radius: 50%;

            background:
                radial-gradient(circle,
                    rgba(244, 180, 0, .18),
                    transparent 70%);

        }

        /*=========================================================
ICÔNE
=========================================================*/

        .company-icon {

            width: 95px;

            height: 95px;

            border-radius: 26px;

            display: flex;

            justify-content: center;

            align-items: center;

            margin-bottom: 30px;

            font-size: 34px;

            color: #fff;

            background:
                linear-gradient(135deg,
                    #2563eb,
                    #4f8df8);

            box-shadow:
                0 25px 60px rgba(37, 99, 235, .35);

        }

        .about-company-card h3 {

            font-size: 34px;

            font-weight: 800;

            margin-bottom: 20px;

        }

        .about-company-card p {

            color: #b9c5d3;

            line-height: 1.9;

            font-size: 17px;

            margin-bottom: 35px;

        }

        /*=========================================================
STATISTIQUES
=========================================================*/

        .company-stats {

            display: grid;

            grid-template-columns: repeat(3, 1fr);

            gap: 18px;

        }

        .stat-box {

            padding: 22px;

            border-radius: 20px;

            text-align: center;

            background: rgba(255, 255, 255, .05);

            border: 1px solid rgba(255, 255, 255, .08);

        }

        .stat-box .number {

            display: block;

            font-size: 32px;

            font-weight: 900;

            color: #f4b400;

            margin-bottom: 8px;

        }

        .stat-box small {

            color: #c8d3df;

            font-size: 14px;

            letter-spacing: .05em;

        }

        /*=========================================================
CARTES FLOTTANTES
=========================================================*/

        .floating-card {

            position: absolute;

            display: flex;

            align-items: center;

            gap: 15px;

            padding: 18px 22px;

            border-radius: 20px;

            background: rgba(18, 22, 33, .90);

            border: 1px solid rgba(255, 255, 255, .08);

            backdrop-filter: blur(18px);

            box-shadow:
                0 18px 45px rgba(0, 0, 0, .28);

            z-index: 10;

        }

        .floating-card i {

            width: 52px;

            height: 52px;

            border-radius: 16px;

            display: flex;

            align-items: center;

            justify-content: center;

            color: #fff;

            font-size: 20px;

        }

        .floating-card span {

            color: #eef4ff;

            font-weight: 700;

            font-size: 15px;

            line-height: 1.4;

        }

        /*=========================================================
POSITIONS
=========================================================*/

        .about-right {

            position: relative;

            width: 100%;

            min-height: 720px;

        }

        .floating-one {

            top: 30px;

            right: -55px;

            animation: floatThree 5.5s ease-in-out infinite;

        }

        .floating-two {

            left: -70px;

            top: 300px;

            animation: floatTwo 7s ease-in-out infinite;

        }

        .floating-three {

            bottom: 40px;

            right: -40px;

            animation: floatOne 6s ease-in-out infinite;

        }

        .about-company-card {

            position: relative;

            z-index: 5;

        }

        .floating-card {

            z-index: 10;

        }

        /*=========================================================
COULEURS
=========================================================*/

        .floating-one i {

            background: linear-gradient(135deg, #2563eb, #60a5fa);

        }

        .floating-two i {

            background: linear-gradient(135deg, #10b981, #34d399);

        }

        .floating-three i {

            background: linear-gradient(135deg, #f4b400, #ffd54a);

            color: #111827;

        }

        /*=========================================================
RESPONSIVE
=========================================================*/

        @media(max-width:992px) {

            .floating-card {

                position: relative;

                top: auto;

                left: auto;

                right: auto;

                bottom: auto;

                margin-top: 20px;

            }

            .company-stats {

                display: grid;

                grid-template-columns:

                    repeat(auto-fit, minmax(120px, 1fr));

                gap: 18px;

            }

        }

        @media(max-width:768px) {

            .about-company-card {

                padding: 34px;

            }

            .company-icon {

                width: 80px;

                height: 80px;

                font-size: 28px;

            }

            .about-company-card h3 {

                font-size: 28px;

            }

        }

        /*=========================================================
QUI SOMMES-NOUS
3B-3
Mission • Vision • Valeurs
=========================================================*/

        .about-values {

            display: grid;

            grid-template-columns: repeat(3, 1fr);

            gap: 30px;

        }

        /*=========================================================
CARTE
=========================================================*/

        .value-card {

            position: relative;

            padding: 40px 35px;

            border-radius: 30px;

            background: rgba(255, 255, 255, .05);

            border: 1px solid rgba(255, 255, 255, .08);

            backdrop-filter: blur(22px);

            overflow: hidden;

            transition:
                box-shadow .4s ease,
                border-color .4s ease;

            transform-style: preserve-3d;

        }

        /*=========================================================
HALO
=========================================================*/

        .value-card::before {

            content: "";

            position: absolute;

            width: 260px;

            height: 260px;

            top: -130px;

            right: -130px;

            border-radius: 50%;

            opacity: .45;

            transition: .45s;

        }

        /*=========================================================
COULEURS
=========================================================*/

        .value-card:nth-child(1)::before {

            background:
                radial-gradient(circle,
                    rgba(37, 99, 235, .35),
                    transparent 70%);

        }

        .value-card:nth-child(2)::before {

            background:
                radial-gradient(circle,
                    rgba(16, 185, 129, .35),
                    transparent 70%);

        }

        .value-card:nth-child(3)::before {

            background:
                radial-gradient(circle,
                    rgba(244, 180, 0, .35),
                    transparent 70%);

        }

        /*=========================================================
ICÔNES
=========================================================*/

        .value-icon {

            width: 82px;

            height: 82px;

            border-radius: 22px;

            display: flex;

            align-items: center;

            justify-content: center;

            margin-bottom: 28px;

            font-size: 28px;

            color: #fff;

            transition:
                transform .35s ease;

        }

        .value-card:nth-child(1) .value-icon {

            background:
                linear-gradient(135deg, #2563eb, #60a5fa);

            box-shadow:
                0 18px 45px rgba(37, 99, 235, .35);

        }

        .value-card:nth-child(2) .value-icon {

            background:
                linear-gradient(135deg, #10b981, #34d399);

            box-shadow:
                0 18px 45px rgba(16, 185, 129, .35);

        }

        .value-card:nth-child(3) .value-icon {

            background:
                linear-gradient(135deg, #f4b400, #ffd54a);

            color: #111827;

            box-shadow:
                0 18px 45px rgba(244, 180, 0, .35);

        }

        /*=========================================================
TEXTES
=========================================================*/

        .value-card h3 {

            font-size: 28px;

            font-weight: 800;

            margin-bottom: 18px;

            color: #fff;

        }

        .value-card p {

            color: #bcc7d5;

            line-height: 1.9;

            font-size: 16px;

        }

        /*=========================================================
LIGNE HAUTE
=========================================================*/

        .value-card::after {

            content: "";

            position: absolute;

            left: 0;

            top: 0;

            width: 100%;

            height: 4px;

            transform: scaleX(0);

            transform-origin: left;

            transition: .4s;

        }

        .value-card:nth-child(1)::after {

            background: #2563eb;

        }

        .value-card:nth-child(2)::after {

            background: #10b981;

        }

        .value-card:nth-child(3)::after {

            background: #f4b400;

        }

        /*=========================================================
HOVER
=========================================================*/

        .value-card:hover {

            border-color: rgba(255, 255, 255, .16);

            box-shadow:
                0 28px 70px rgba(0, 0, 0, .28);

        }

        .value-card:hover::after {

            transform: scaleX(1);

        }

        .value-card:hover::before {

            transform: scale(1.15);

        }

        .value-card:hover .value-icon {

            transform:
                rotate(8deg) scale(1.08);

        }

        /*=========================================================
RESPONSIVE
=========================================================*/

        @media(max-width:1200px) {

            .about-values {

                grid-template-columns: repeat(2, 1fr);

            }

        }

        @media(max-width:768px) {

            .about-values {

                grid-template-columns: 1fr;

                gap: 24px;

            }

            .value-card {

                padding: 30px;

            }

            .value-card h3 {

                font-size: 24px;

            }

            .value-icon {

                width: 72px;

                height: 72px;

                font-size: 24px;

            }

        }

        /*=========================================================
QUI SOMMES-NOUS
3B-4
Finitions Ultra Premium
=========================================================*/

        /*=========================================================
SHINE EFFECT
=========================================================*/

        .about-card::after,
        .about-company-card::after,
        .value-card .shine {

            content: "";

            position: absolute;

            top: 0;

            left: -130%;

            width: 55%;

            height: 100%;

            transform: skewX(-25deg);

            background:

                linear-gradient(90deg,

                    transparent,

                    rgba(255, 255, 255, .16),

                    transparent);

            pointer-events: none;

        }

        /*=========================================================
HOVER SHINE
=========================================================*/

        .about-card:hover::after {

            animation: aboutShine .9s linear;

        }

        .about-company-card:hover::after {

            animation: aboutShine .9s linear;

        }

        .value-card:hover .shine {

            animation: aboutShine .9s linear;

        }

        @keyframes aboutShine {

            0% {

                left: -130%;

            }

            100% {

                left: 180%;

            }

        }

        /*=========================================================
BORDURES PREMIUM
=========================================================*/

        .about-card,
        .about-company-card,
        .value-card {

            border: 1px solid rgba(255, 255, 255, .08);

            transition:

                border-color .35s ease,

                box-shadow .35s ease,

                background .35s ease;

        }

        .about-card:hover,
        .about-company-card:hover,
        .value-card:hover {

            border-color: rgba(37, 99, 235, .22);

            background: rgba(255, 255, 255, .06);

        }

        /*=========================================================
OMBRE PREMIUM
=========================================================*/

        .about-card {

            box-shadow:

                0 25px 70px rgba(0, 0, 0, .22);

        }

        .about-company-card {

            box-shadow:

                0 30px 80px rgba(0, 0, 0, .28);

        }

        .value-card {

            box-shadow:

                0 18px 50px rgba(0, 0, 0, .18);

        }

        /*=========================================================
STAT BOX
=========================================================*/

        .stat-box {

            transition:

                background .35s,

                border-color .35s,

                box-shadow .35s;

        }

        .stat-box:hover {

            background: rgba(37, 99, 235, .08);

            border-color: rgba(37, 99, 235, .25);

            box-shadow:

                0 18px 45px rgba(37, 99, 235, .15);

        }

        /*=========================================================
FEATURES
=========================================================*/

        .feature-item {

            position: relative;

            overflow: hidden;

        }

        .feature-item::before {

            content: "";

            position: absolute;

            inset: 0;

            background:

                linear-gradient(135deg,

                    rgba(37, 99, 235, .06),

                    transparent);

            opacity: 0;

            transition: .35s;

        }

        .feature-item:hover::before {

            opacity: 1;

        }

        /*=========================================================
FLOATING CARDS
=========================================================*/

        .floating-card {

            transition:

                box-shadow .35s,

                border-color .35s,

                background .35s;

        }

        .floating-card:hover {

            border-color: rgba(244, 180, 0, .25);

            background: rgba(255, 255, 255, .08);

            box-shadow:

                0 20px 50px rgba(0, 0, 0, .30);

        }

        /*=========================================================
TEXT SELECTION
=========================================================*/

        .about-section ::selection {

            background: #2563eb;

            color: #fff;

        }

        /*=========================================================
ACCESSIBILITÉ
=========================================================*/

        .about-card:focus-within,
        .about-company-card:focus-within,
        .value-card:focus-within {

            outline: 2px solid rgba(37, 99, 235, .45);

            outline-offset: 3px;

        }

        /*=========================================================
PERFORMANCES
=========================================================*/

        .about-card,
        .about-company-card,
        .value-card,
        .floating-card,
        .feature-item {

            will-change: transform;

            backface-visibility: hidden;

            transform: translateZ(0);

        }

        /*=========================================================
RESPONSIVE
=========================================================*/

        @media(max-width:992px) {

            .about-company-card {

                margin-bottom: 25px;

            }

        }

        @media(max-width:768px) {

            .about-card,
            .about-company-card,
            .value-card {

                border-radius: 24px;

            }

            .floating-card {

                border-radius: 18px;

            }

        }

        @media(max-width:480px) {

            .about-card,
            .about-company-card {

                padding: 22px;

            }

            .value-card {

                padding: 24px;

            }

        }
    </style>























    <!--======================================================
CONTACT
=======================================================-->



    <section id="contact" class="contact-section">

        <!-- Aurora -->

        <div class="contact-aurora contact-aurora-1"></div>
        <div class="contact-aurora contact-aurora-2"></div>

        <div class="container">

            <!-- Header -->

            <div class="contact-header">

                <span class="section-badge">

                    <i class="fa-solid fa-envelope"></i>

                    Contact

                </span>

                <h2 class="section-title">

                    Parlons de

                    <span class="text-gold-gradient">

                        votre projet

                    </span>

                </h2>

                <p class="section-description">

                    Notre équipe est à votre écoute pour répondre à vos questions,
                    étudier vos besoins et vous accompagner dans vos projets.

                </p>

            </div>

            <!-- Grid -->
            @if(session('success'))
                <div class="mb-6 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-sm flex items-center gap-3">
                     <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif
            <div class="contact-grid">

                <!-- Informations -->

                <div class="contact-info">

                    <div class="contact-card glass">
                        <div class="contact-line"></div>

                        <div class="contact-icon">

                            <i class="fa-solid fa-phone"></i>

                        </div>

                        <div>

                            <h3>Téléphone</h3>

                            <p>+212 764 82 44 47</p>

                        </div>

                    </div>

                    <div class="contact-card glass">
                        <div class="contact-line"></div>
                        <div class="contact-icon">

                            <i class="fa-solid fa-envelope"></i>

                        </div>

                        <div>

                            <h3>Email</h3>

                            <p>contact@visionbf.com</p>

                        </div>

                    </div>

                    <div class="contact-card glass">
                        <div class="contact-line"></div>
                        <div class="contact-icon">

                            <i class="fa-solid fa-location-dot"></i>

                        </div>

                        <div>

                            <h3>Adresse</h3>

                            <p>Boulevard d'Anfa, 20250, Casablanca, Maroc</p>

                        </div>

                    </div>

                    <div class="contact-card glass">

                        <div class="contact-line"></div>

                        <div class="contact-icon">

                            <i class="fa-solid fa-clock"></i>

                        </div>

                        <div>

                            <h3>Horaires</h3>

                            <p>Lun - Ven : 08h00 - 18h00</p>

                        </div>

                    </div>

                </div>

                <style>
                    .alert-success {
                        background-color: rgba(16, 185, 129, 0.1);
                        border: 1px solid rgba(16, 185, 129, 0.3);
                        color: #34d399;
                        padding: 12px 16px;
                        border-radius: 10px;
                        margin-bottom: 20px;
                        display: flex;
                        align-items: center;
                        gap: 10px;
                        font-size: 0.9rem;
                    }
                </style>
                <!-- Formulaire -->

                <div class="contact-form glass">

                    <form action="{{ route('contact.send') }}" method="POST">

                        @csrf

                        <div class="form-grid">

                            <div class="input-group">

                                <label>Nom complet</label>

                                <input type="text" name="name" placeholder="Votre nom">
                                @error('name') <span style="color: red;">{{ $message }}</span> @enderror

                            </div>

                            <div class="input-group">

                                <label>Email</label>

                                <input type="email" name="email" placeholder="Votre email">
                                @error('email') <span style="color: red;">{{ $message }}</span> @enderror

                            </div>

                        </div>

                        <div class="input-group">

                            <label>Téléphone</label>

                            <input type="text" name="phone" placeholder="Votre téléphone">
                            @error('phone') <span style="color: red;">{{ $message }}</span> @enderror

                        </div>

                        <div class="input-group">

                            <label>Sujet</label>

                            <input type="text" name="subject" placeholder="Sujet de votre demande">
                            @error('subject') <span style="color: red;">{{ $message }}</span> @enderror

                        </div>

                        <div class="input-group">

                            <label>Message</label>

                            <textarea name="message" rows="6" placeholder="Décrivez votre projet..."></textarea>
                            @error('message') <span style="color: red;">{{ $message }}</span> @enderror

                        </div>

                        <button class="btn-primary">

                            Envoyer le message

                            <i class="fa-solid fa-paper-plane"></i>

                        </button>

                    </form>

                </div>

            </div>

            <!-- Google Maps -->

            <div class="contact-map glass">

                <iframe src="https://www.google.com/maps?q=Boulevard+d%27Anfa,+20250,+Casablanca,+Maroc&output=embed"
                    width="100%" height="450" style="border:0;" loading="lazy" allowfullscreen>
                </iframe>
            </div>

        </div>

    </section>

    <style>
        /*=========================================================
CONTACT
Partie 4B-1
Structure + Aurora + Header + Layout
=========================================================*/

        .contact-section {

            position: relative;

            padding: 160px 0;

            overflow: hidden;

        }

        /*=========================================
AURORA
=========================================*/

        .contact-aurora {

            position: absolute;

            border-radius: 50%;

            filter: blur(140px);

            pointer-events: none;

            opacity: .18;

        }

        .contact-aurora-1 {

            width: 520px;

            height: 520px;

            top: -120px;

            left: -180px;

            background: #2563eb;

            animation: contactAuroraOne 14s ease-in-out infinite alternate;

        }

        .contact-aurora-2 {

            width: 480px;

            height: 480px;

            right: -180px;

            bottom: -80px;

            background: #f4b400;

            animation: contactAuroraTwo 16s ease-in-out infinite alternate;

        }

        @keyframes contactAuroraOne {

            0% {

                transform:
                    translate(0, 0) scale(1);

            }

            100% {

                transform:
                    translate(90px, -60px) scale(1.15);

            }

        }

        @keyframes contactAuroraTwo {

            0% {

                transform:
                    translate(0, 0) scale(1);

            }

            100% {

                transform:
                    translate(-80px, 70px) scale(1.12);

            }

        }

        /*=========================================
HEADER
=========================================*/

        .contact-header {

            max-width: 850px;

            margin: auto;

            text-align: center;

            margin-bottom: 90px;

            position: relative;

            z-index: 5;

        }

        .contact-header .section-title {

            font-size: 62px;

            font-weight: 900;

            margin: 25px 0;

            line-height: 1.1;

        }

        .contact-header .section-description {

            color: #bcc7d5;

            line-height: 1.9;

            font-size: 18px;

        }

        /*=========================================
GRID
=========================================*/

        .contact-grid {

            display: grid;

            grid-template-columns: 420px 1fr;

            gap: 45px;

            align-items: start;

        }

        /*=========================================
COLONNE INFORMATIONS
=========================================*/

        .contact-info {

            display: flex;

            flex-direction: column;

            gap: 25px;

        }

        /*=========================================
FORMULAIRE
=========================================*/

        .contact-form {

            position: relative;

        }

        /*=========================================
MAP
=========================================*/

        .contact-map {

            margin-top: 70px;

        }

        /*=========================================
RESPONSIVE
=========================================*/

        @media(max-width:1200px) {

            .contact-grid {

                grid-template-columns: 360px 1fr;

            }

        }

        @media(max-width:992px) {

            .contact-grid {

                grid-template-columns: 1fr;

            }

            .contact-info {

                order: 2;

            }

            .contact-form {

                order: 1;

            }

        }

        @media(max-width:768px) {

            .contact-section {

                padding: 110px 0;

            }

            .contact-header .section-title {

                font-size: 44px;

            }

            .contact-header .section-description {

                font-size: 17px;

            }

        }

        @media(max-width:480px) {

            .contact-header .section-title {

                font-size: 34px;

            }

        }

        /*=========================================================
CONTACT
Partie 4B-2
Cartes de contact Premium
=========================================================*/

        .contact-card {

            position: relative;

            display: flex;

            align-items: center;

            gap: 24px;

            padding: 28px;

            border-radius: 28px;

            background: rgba(255, 255, 255, .05);

            border: 1px solid rgba(255, 255, 255, .08);

            backdrop-filter: blur(22px);

            overflow: hidden;

            transition:
                transform .45s ease,
                box-shadow .45s ease,
                border-color .45s ease;

            cursor: pointer;

        }

        /*=========================================
HALO LUMINEUX
=========================================*/

        .contact-card::before {

            content: "";

            position: absolute;

            width: 240px;

            height: 240px;

            top: -120px;

            right: -120px;

            border-radius: 50%;

            background:

                radial-gradient(circle,
                    rgba(37, 99, 235, .25),
                    transparent 70%);

            opacity: 0;

            transition: .5s;

        }

        .contact-card:hover::before {

            opacity: 1;

        }

        /*=========================================
REFLET PREMIUM
=========================================*/

        .contact-card::after {

            content: "";

            position: absolute;

            top: 0;

            left: -120%;

            width: 60%;

            height: 100%;

            transform: skewX(-25deg);

            background:

                linear-gradient(90deg,

                    transparent,

                    rgba(255, 255, 255, .22),

                    transparent);

        }

        .contact-card:hover::after {

            animation: contactShine .9s forwards;

        }

        @keyframes contactShine {

            100% {

                left: 180%;

            }

        }

        /*=========================================
HOVER
=========================================*/

        .contact-card:hover {

            transform:

                perspective(1200px) rotateX(5deg) rotateY(-5deg) translateY(-8px);

            border-color: rgba(37, 99, 235, .35);

            box-shadow:

                0 22px 60px rgba(0, 0, 0, .28);

        }

        /*=========================================
ICÔNES
=========================================*/

        .contact-icon {

            width: 82px;

            height: 82px;

            min-width: 82px;

            border-radius: 24px;

            display: flex;

            justify-content: center;

            align-items: center;

            color: white;

            font-size: 28px;

            transition: .45s;

        }

        /* Téléphone */

        .contact-card:nth-child(1) .contact-icon {

            background:

                linear-gradient(135deg,

                    #2563eb,

                    #4f8df8);

            box-shadow:

                0 18px 45px rgba(37, 99, 235, .35);

        }

        /* Email */

        .contact-card:nth-child(2) .contact-icon {

            background:

                linear-gradient(135deg,

                    #10b981,

                    #34d399);

            box-shadow:

                0 18px 45px rgba(16, 185, 129, .35);

        }

        /* Adresse */

        .contact-card:nth-child(3) .contact-icon {

            background:

                linear-gradient(135deg,

                    #f4b400,

                    #ffd34d);

            color: #111827;

            box-shadow:

                0 18px 45px rgba(244, 180, 0, .35);

        }

        /* Horaires */

        .contact-card:nth-child(4) .contact-icon {

            background:

                linear-gradient(135deg,

                    #7c3aed,

                    #9d6bff);

            box-shadow:

                0 18px 45px rgba(124, 58, 237, .35);

        }

        /*=========================================
ANIMATION ICÔNES
=========================================*/

        .contact-card:hover .contact-icon {

            transform:

                rotate(12deg) scale(1.12);

        }

        /*=========================================
TEXTES
=========================================*/

        .contact-card h3 {

            font-size: 22px;

            font-weight: 800;

            color: #ffffff;

            margin-bottom: 8px;

            transition: .35s;

        }

        .contact-card p {

            color: #b9c5d3;

            line-height: 1.7;

            transition: .35s;

        }

        .contact-card:hover h3 {

            color: #ffffff;

        }

        .contact-card:hover p {

            color: #eef4ff;

        }

        /*=========================================
LIGNE COLORÉE À GAUCHE
=========================================*/

        .contact-card .contact-line {

            position: absolute;

            left: 0;

            top: 20px;

            bottom: 20px;

            width: 4px;

            border-radius: 20px;

            background: #2563eb;

            opacity: 0;

            transition: .35s;

        }

        .contact-card:nth-child(2) .contact-line {

            background: #10b981;

        }

        .contact-card:nth-child(3) .contact-line {

            background: #f4b400;

        }

        .contact-card:nth-child(4) .contact-line {

            background: #7c3aed;

        }

        .contact-card:hover .contact-line {

            opacity: 1;

        }

        /*=========================================
RESPONSIVE
=========================================*/

        @media(max-width:768px) {

            .contact-card {

                padding: 22px;

                gap: 18px;

            }

            .contact-icon {

                width: 70px;

                height: 70px;

                min-width: 70px;

                font-size: 24px;

            }

            .contact-card h3 {

                font-size: 20px;

            }

        }

        @media(max-width:480px) {

            .contact-card {

                flex-direction: column;

                text-align: center;

            }

            .contact-icon {

                margin-bottom: 10px;

            }

        }

        /*=========================================================
CONTACT
Partie 4B-3
Formulaire Ultra Premium
=========================================================*/

        /*=========================================
CONTENEUR
=========================================*/

        .contact-form {

            position: relative;

            padding: 45px;

            border-radius: 34px;

            background: rgba(255, 255, 255, .05);

            border: 1px solid rgba(255, 255, 255, .08);

            backdrop-filter: blur(22px);

            overflow: hidden;

            box-shadow:
                0 30px 80px rgba(0, 0, 0, .25);

        }

        /*=========================================
HALO
=========================================*/

        .contact-form::before {

            content: "";

            position: absolute;

            width: 320px;

            height: 320px;

            top: -160px;

            right: -120px;

            border-radius: 50%;

            background:
                radial-gradient(circle,
                    rgba(37, 99, 235, .22),
                    transparent 70%);

            filter: blur(25px);

        }

        .contact-form::after {

            content: "";

            position: absolute;

            width: 250px;

            height: 250px;

            bottom: -120px;

            left: -100px;

            border-radius: 50%;

            background:
                radial-gradient(circle,
                    rgba(244, 180, 0, .18),
                    transparent 70%);

        }

        /*=========================================
GRID
=========================================*/

        .form-grid {

            display: grid;

            grid-template-columns: repeat(2, 1fr);

            gap: 24px;

        }

        /*=========================================
GROUPES
=========================================*/

        .input-group {

            position: relative;

            margin-bottom: 24px;

            z-index: 2;

        }

        .input-group label {

            display: block;

            margin-bottom: 10px;

            color: #eef4ff;

            font-weight: 700;

            font-size: 15px;

            letter-spacing: .4px;

        }

        /*=========================================
INPUTS
=========================================*/

        .input-group input,
        .input-group textarea {

            width: 100%;

            padding: 18px 22px;

            border-radius: 18px;

            border: 1px solid rgba(255, 255, 255, .08);

            background: rgba(255, 255, 255, .05);

            backdrop-filter: blur(18px);

            color: #fff;

            font-size: 16px;

            transition: .35s;

            outline: none;

        }

        .input-group textarea {

            resize: vertical;

            min-height: 180px;

        }

        /*=========================================
PLACEHOLDER
=========================================*/

        .input-group input::placeholder,
        .input-group textarea::placeholder {

            color: #8fa1b8;

        }

        /*=========================================
FOCUS
=========================================*/

        .input-group input:focus,
        .input-group textarea:focus {

            border-color: #2563eb;

            background: rgba(37, 99, 235, .06);

            box-shadow:
                0 0 0 4px rgba(37, 99, 235, .12),
                0 15px 40px rgba(37, 99, 235, .18);

            transform: translateY(-2px);

        }

        /*=========================================
BOUTON
=========================================*/

        .contact-form .btn-primary {

            position: relative;

            overflow: hidden;

            width: 100%;

            margin-top: 10px;

            padding: 20px 28px;

            border: none;

            border-radius: 18px;

            font-size: 17px;

            font-weight: 700;

            cursor: pointer;

            color: #fff;

            background:
                linear-gradient(135deg,
                    #2563eb,
                    #4f8df8);

            transition: .35s;

            box-shadow:
                0 20px 50px rgba(37, 99, 235, .30);

        }

        /*=========================================
REFLET
=========================================*/

        .contact-form .btn-primary::before {

            content: "";

            position: absolute;

            left: -120%;

            top: 0;

            width: 60%;

            height: 100%;

            transform: skewX(-25deg);

            background:
                linear-gradient(90deg,
                    transparent,
                    rgba(255, 255, 255, .35),
                    transparent);

        }

        .contact-form .btn-primary:hover::before {

            animation: contactButtonShine .9s forwards;

        }

        @keyframes contactButtonShine {

            100% {

                left: 180%;

            }

        }

        /*=========================================
HOVER
=========================================*/

        .contact-form .btn-primary:hover {

            transform:
                translateY(-4px) scale(1.02);

            box-shadow:
                0 28px 60px rgba(37, 99, 235, .38);

        }

        .contact-form .btn-primary:active {

            transform: scale(.98);

        }

        /*=========================================
ICONE
=========================================*/

        .contact-form .btn-primary i {

            margin-left: 12px;

            transition: .35s;

        }

        .contact-form .btn-primary:hover i {

            transform:
                translateX(6px) rotate(-12deg);

        }

        /*=========================================
RESPONSIVE
=========================================*/

        @media(max-width:768px) {

            .form-grid {

                grid-template-columns: 1fr;

            }

            .contact-form {

                padding: 32px;

            }

        }

        @media(max-width:480px) {

            .contact-form {

                padding: 24px;

            }

            .input-group input,
            .input-group textarea {

                padding: 16px 18px;

            }

            .contact-form .btn-primary {

                padding: 18px;

            }

        }

        /*=========================================================
CONTACT
Partie 4B-4
Google Maps + Finitions Premium
=========================================================*/

        /*=========================================
MAP CONTAINER
=========================================*/

        .contact-map {

            position: relative;

            margin-top: 80px;

            padding: 12px;

            border-radius: 32px;

            overflow: hidden;

            background: rgba(255, 255, 255, .05);

            border: 1px solid rgba(255, 255, 255, .08);

            backdrop-filter: blur(22px);

            box-shadow:
                0 35px 90px rgba(0, 0, 0, .25);

            transition: .45s;

        }

        .contact-map:hover {

            transform: translateY(-8px);

            box-shadow:
                0 45px 110px rgba(0, 0, 0, .32);

        }

        /*=========================================
HALO
=========================================*/

        .contact-map::before {

            content: "";

            position: absolute;

            width: 300px;

            height: 300px;

            top: -160px;

            right: -120px;

            border-radius: 50%;

            background:

                radial-gradient(circle,
                    rgba(37, 99, 235, .22),
                    transparent 70%);

            filter: blur(30px);

        }

        .contact-map::after {

            content: "";

            position: absolute;

            width: 260px;

            height: 260px;

            left: -120px;

            bottom: -120px;

            border-radius: 50%;

            background:

                radial-gradient(circle,
                    rgba(244, 180, 0, .18),
                    transparent 70%);

        }

        /*=========================================
IFRAME
=========================================*/

        .contact-map iframe {

            display: block;

            width: 100%;

            height: 480px;

            border: none;

            border-radius: 24px;

            filter:
                grayscale(.15) contrast(1.05) brightness(.95);

            transition: .5s;

        }

        .contact-map:hover iframe {

            filter:
                grayscale(0) contrast(1.08) brightness(1);

        }

        /*=========================================
LIGNE LUMINEUSE
=========================================*/

        .contact-map .map-border {

            position: absolute;

            inset: 0;

            border-radius: 32px;

            pointer-events: none;

            padding: 2px;

            background:

                linear-gradient(135deg,
                    rgba(37, 99, 235, .45),
                    transparent,
                    rgba(244, 180, 0, .45));

            -webkit-mask:
                linear-gradient(#fff 0 0) content-box,
                linear-gradient(#fff 0 0);

            -webkit-mask-composite: xor;

            mask-composite: exclude;

            opacity: .65;

        }

        /*=========================================
SHINE
=========================================*/

        .contact-map .map-shine {

            position: absolute;

            top: 0;

            left: -120%;

            width: 45%;

            height: 100%;

            transform: skewX(-25deg);

            background:

                linear-gradient(90deg,

                    transparent,

                    rgba(255, 255, 255, .18),

                    transparent);

        }

        .contact-map:hover .map-shine {

            animation: mapShine 1s forwards;

        }

        @keyframes mapShine {

            100% {

                left: 180%;

            }

        }

        /*=========================================
FLOAT
=========================================*/

        .contact-map {

            animation: mapFloat 8s ease-in-out infinite;

        }

        @keyframes mapFloat {

            0%,
            100% {

                transform: translateY(0);

            }

            50% {

                transform: translateY(-4px);

            }

        }

        /*=========================================
RESPONSIVE
=========================================*/

        @media(max-width:992px) {

            .contact-map iframe {

                height: 400px;

            }

        }

        @media(max-width:768px) {

            .contact-map {

                margin-top: 60px;

                padding: 8px;

                border-radius: 24px;

            }

            .contact-map iframe {

                height: 320px;

                border-radius: 18px;

            }

        }

        @media(max-width:480px) {

            .contact-map iframe {

                height: 260px;

            }

        }
    </style>







    <footer id="footer" class="relative overflow-hidden pt-32 pb-10">

        <!-- Aurora -->

        <div class="footer-aurora footer-aurora-1"></div>
        <div class="footer-aurora footer-aurora-2"></div>

        <div class="max-w-7xl mx-auto px-6 relative z-20">

            <!-- Newsletter -->

            <div class="glass rounded-[40px] p-10 lg:p-14 mb-20">

                <div class="grid lg:grid-cols-2 gap-10 items-center">

                    <div>

                        <span class="text-gold-400 uppercase tracking-[4px] text-xs">

                            Newsletter

                        </span>

                        <h2 class="text-5xl font-black mt-4">

                            Restez informé de nos

                            <span class="text-gold-gradient">

                                actualités

                            </span>

                        </h2>

                        <p class="text-gray-400 mt-6 leading-8">

                            Recevez nos conseils, nouveautés et offres
                            directement dans votre boîte mail.

                        </p>

                    </div>

                    <form class="newsletter-form">

                        <input type="email" placeholder="Votre adresse email">

                        <button>

                            <i class="fa-solid fa-paper-plane mr-2"></i>

                            S'abonner

                        </button>

                    </form>

                </div>

            </div>

            <!-- Colonnes -->

            <div class="grid lg:grid-cols-4 md:grid-cols-2 gap-16">

                <!-- Société -->

                <div>

                    <h3 class="footer-logo">

                        VISIONBF

                    </h3>

                    <p class="footer-description">

                        Centre de relation client spécialisé
                        en téléprospection,
                        développement commercial,
                        support client
                        et externalisation des processus.

                    </p>

                    <div class="socials mt-8">
                        <a href="https://www.facebook.com/profile.php?id=61573995680591" target="_blank"
                            rel="noopener noreferrer">
                            <i class="fab fa-facebook-f"></i>
                        </a>

                        <a href="https://www.linkedin.com/" target="_blank" rel="noopener noreferrer">
                            <i class="fab fa-linkedin-in"></i>
                        </a>

                        <a href="https://www.instagram.com/vision.bf/" target="_blank" rel="noopener noreferrer">
                            <i class="fab fa-instagram"></i>
                        </a>

                        <a href="https://www.tiktok.com/@visionbf221" target="_blank" rel="noopener noreferrer">
                            <i class="fab fa-tiktok"></i>
                        </a>
                    </div>

                </div>

                <!-- Liens -->

                <div>

                    <h4 class="footer-title">

                        Navigation

                    </h4>

                    <ul>

                        <li><a href="#hero">Accueil</a></li>

                        <li><a href="#services">Services</a></li>

                        <li><a href="#about">Qui sommes-nous ? </a></li>


                        <li><a href="#contact">Contact</a></li>

                    </ul>

                </div>

                <!-- Services -->

                <div>

                    <h4 class="footer-title">

                        Nos Services

                    </h4>

                    <ul>

                        <li>Téléprospection</li>

                        <li>Support Client</li>

                        <li>Développement Commercial</li>


                        <li>Formation</li>

                    </ul>

                </div>

                <!-- Contact -->

                <div>

                    <h4 class="footer-title">

                        Coordonnées

                    </h4>

                    <ul>

                        <li>

                            <i class="fa-solid fa-phone mr-3"></i>

                            +212 764 82 44 47

                        </li>

                        <li>

                            <i class="fa-solid fa-envelope mr-3"></i>

                            contact@visionbf.com

                        </li>

                        <li>

                            <i class="fa-solid fa-location-dot mr-3"></i>

                            Boulevard d'Anfa, 20250, Casablanca, Maroc

                        </li>

                    </ul>

                </div>

            </div>

            <!-- Ligne -->

            <div class="footer-bottom mt-20 pt-8">

                <div class="flex flex-col lg:flex-row justify-between items-center gap-6">

                    <p>

                        © {{ date('Y') }}

                        <strong>VISIONBF</strong>

                        Tous droits réservés.

                    </p>

                    <div class="flex gap-8">

                        <a href="#">Mentions légales</a>

                        <a href="#">Confidentialité</a>

                        <a href="#">Cookies</a>

                    </div>

                </div>

            </div>

        </div>

    </footer>
    <style>
        /*=====================================================
FOOTER PREMIUM
=====================================================*/

        #footer {

            background:
                linear-gradient(180deg,
                    transparent,
                    #070b16 15%,
                    #050810 100%);

            position: relative;

        }

        /*==============================================
AURORA
==============================================*/

        .footer-aurora {

            position: absolute;

            border-radius: 50%;

            filter: blur(140px);

            opacity: .45;

            animation: auroraMove 18s ease-in-out infinite alternate;

            pointer-events: none;

        }

        .footer-aurora-1 {

            width: 550px;

            height: 550px;

            left: -200px;

            top: -150px;

            background: #fbba10;

        }

        .footer-aurora-2 {

            width: 520px;

            height: 520px;

            right: -180px;

            bottom: -180px;

            background: #2563eb;

            animation-delay: 5s;

        }

        @keyframes auroraMove {

            0% {

                transform:
                    translate(0, 0) scale(1);

            }

            50% {

                transform:
                    translate(80px, -40px) scale(1.15);

            }

            100% {

                transform:
                    translate(-40px, 60px) scale(.95);

            }

        }

        /*==============================================
NEWSLETTER
==============================================*/

        .newsletter-form {

            display: flex;

            gap: 18px;

            align-items: center;

        }

        .newsletter-form input {

            flex: 1;

            padding: 22px;

            border-radius: 18px;

            background: rgba(255, 255, 255, .05);

            border: 1px solid rgba(255, 255, 255, .08);

            color: #fff;

            outline: none;

            transition: .35s;

        }

        .newsletter-form input:focus {

            border-color: #fbba10;

            box-shadow:

                0 0 0 4px rgba(251, 186, 16, .10),

                0 15px 45px rgba(251, 186, 16, .12);

        }

        .newsletter-form button {

            padding: 22px 35px;

            border-radius: 18px;

            background:

                linear-gradient(135deg,
                    #fbba10,
                    #df9408);

            font-weight: 700;

            color: #111;

            transition: .35s;

            position: relative;

            overflow: hidden;

        }

        .newsletter-form button:hover {

            transform:
                translateY(-4px);

            box-shadow:

                0 20px 50px rgba(251, 186, 16, .30);

        }

        .newsletter-form button::before {

            content: "";

            position: absolute;

            left: -120%;

            top: 0;

            width: 60%;

            height: 100%;

            background:

                linear-gradient(90deg,
                    transparent,
                    rgba(255, 255, 255, .45),
                    transparent);

            transform: skewX(-25deg);

        }

        .newsletter-form button:hover::before {

            animation: shineFooter .9s forwards;

        }

        @keyframes shineFooter {

            100% {

                left: 170%;

            }

        }

        /*==============================================
LOGO
==============================================*/

        .footer-logo {

            font-size: 42px;

            font-weight: 900;

            background:

                linear-gradient(90deg,
                    #fbba10,
                    #fff0ad);

            -webkit-background-clip: text;

            -webkit-text-fill-color: transparent;

            margin-bottom: 20px;

        }

        .footer-description {

            line-height: 2;

            color: #9ca3af;

        }

        /*==============================================
TITRES
==============================================*/

        .footer-title {

            font-size: 20px;

            font-weight: 800;

            margin-bottom: 22px;

            position: relative;

        }

        .footer-title::after {

            content: "";

            position: absolute;

            left: 0;

            bottom: -10px;

            width: 45px;

            height: 3px;

            border-radius: 20px;

            background: #fbba10;

        }

        /*==============================================
LISTES
==============================================*/

        #footer ul {

            display: flex;

            flex-direction: column;

            gap: 15px;

        }

        #footer ul li {

            color: #b7bcc7;

            transition: .35s;

        }

        #footer ul li:hover {

            transform: translateX(8px);

            color: white;

        }

        #footer a {

            transition: .35s;

        }

        #footer a:hover {

            color: #fbba10;

        }

        /*==============================================
SOCIAL
==============================================*/

        .socials {

            display: flex;

            gap: 16px;

        }

        .socials a {

            width: 55px;

            height: 55px;

            display: flex;

            justify-content: center;

            align-items: center;

            border-radius: 18px;

            background: rgba(255, 255, 255, .05);

            font-size: 20px;

            transition: .35s;

        }

        .socials a:hover {

            background: #fbba10;

            color: #111;

            transform:
                translateY(-6px) rotate(10deg);

            box-shadow:

                0 15px 40px rgba(251, 186, 16, .30);

        }

        /*==============================================
BOTTOM
==============================================*/

        .footer-bottom {

            border-top:

                1px solid rgba(255, 255, 255, .08);

            color: #9ca3af;

        }

        /*==============================================
GLASS
==============================================*/

        #footer .glass {

            transition: .45s;

        }

        #footer .glass:hover {

            transform:
                translateY(-8px);

            box-shadow:

                0 25px 70px rgba(251, 186, 16, .12);

        }

        /*==============================================
RESPONSIVE
==============================================*/

        @media(max-width:992px) {

            .newsletter-form {

                flex-direction: column;

            }

            .newsletter-form button {

                width: 100%;

            }

        }
    </style>
    <script>

        /*========================================
        Footer Animation
        ========================================*/

        gsap.from("#footer .glass", {

            scrollTrigger: {

                trigger: "#footer",

                start: "top 80%"

            },

            opacity: 0,

            y: 80,

            duration: 1,

            ease: "power4.out"

        });

        /*========================================
        Colonnes
        ========================================*/

        gsap.from("#footer .footer-title", {

            scrollTrigger: "#footer",

            opacity: 0,

            y: 40,

            stagger: .12,

            duration: .8

        });

        /*========================================
        Social Icons
        ========================================*/

        gsap.to(".socials a", {

            y: -6,

            repeat: -1,

            yoyo: true,

            duration: 1.6,

            stagger: .15,

            ease: "sine.inOut"

        });

        /*========================================
        Aurora Rotation
        ========================================*/

        gsap.to(".footer-aurora-1", {

            rotation: 360,

            duration: 80,

            repeat: -1,

            ease: "none"

        });

        gsap.to(".footer-aurora-2", {

            rotation: -360,

            duration: 100,

            repeat: -1,

            ease: "none"

        });

    </script>