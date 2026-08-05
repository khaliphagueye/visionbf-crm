<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mentions Légales - VISIONBF</title>

    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                        title: ['Cinzel', 'serif'],
                    },
                    colors: {
                        'gold': {
                            50: '#fffdf0',
                            100: '#fff9cd',
                            200: '#fff09f',
                            300: '#ffe165',
                            400: '#ffd037',
                            500: '#fbba10',
                            600: '#df9408',
                            700: '#b96c08',
                            800: '#94540d',
                            900: '#7a450e',
                            950: '#462402',
                        },
                        'nero': {
                            50: '#f6f6f6',
                            100: '#e7e7e7',
                            200: '#d1d1d1',
                            300: '#b0b0b0',
                            400: '#888888',
                            500: '#6d6d6d',
                            600: '#5d5d5d',
                            700: '#4f4f4f',
                            800: '#454545',
                            900: '#1a1a1a',
                            950: '#0a0a0a',
                        },
                    }
                }
            }
        }
    </script>

    <style>
        .gold-gradient {
            background: linear-gradient(135deg, #fbba10 0%, #df9408 50%, #fbba10 100%);
        }

        .text-gold-gradient {
            background: linear-gradient(135deg, #fbba10 0%, #fff9cd 50%, #df9408 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>

<body class="bg-nero-950 text-nero-200 antialiased selection:bg-gold-500 selection:text-nero-950 font-sans flex flex-col min-h-screen">

<header class="border-b border-yellow-700 bg-[#111111]">

        <div class="max-w-7xl mx-auto px-6 py-5 flex justify-between items-center">

            <a href="{{ route('welcome') }}"
               class="flex items-center gap-3">

                <img src="{{ asset('images/logo.png') }}"
                     class="h-11">

                <div>

                    <h1 class="font-bold text-xl gold-gradient">
                        Vision BF CRM
                    </h1>

                    <p class="text-xs text-gray-400">
                        Protection des données personnelles
                    </p>

                </div>

            </a>

            <a href="{{ route('welcome') }}"
               class="px-5 py-2 rounded-lg border border-yellow-600 text-yellow-400 hover:bg-yellow-500 hover:text-black transition">

                Retour

            </a>

        </div>

    </header>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const btn = document.getElementById('menu-btn');
            const menu = document.getElementById('mobile-menu');
            const links = document.querySelectorAll('.mobile-link');

            if (btn && menu) {
                btn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    menu.classList.toggle('hidden');
                });
                links.forEach(link => {
                    link.addEventListener('click', () => menu.classList.add('hidden'));
                });
                document.addEventListener('click', (e) => {
                    if (!menu.contains(e.target) && !btn.contains(e.target)) {
                        menu.classList.add('hidden');
                    }
                });
            }
        });
    </script>

    <main class="flex-grow py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-5xl mx-auto space-y-8">

            <div class="bg-nero-900/80 border border-nero-800 rounded-2xl p-6 sm:p-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 backdrop-blur-sm shadow-xl">
                <div>
                    <h1 class="font-title text-2xl sm:text-3xl font-bold text-gold-gradient">
                        {{ __('Mentions Légales') }}
                    </h1>
                    <p class="text-sm text-nero-400 mt-1">
                        Informations réglementaires et conditions d'utilisation du CRM - VISIONBF
                    </p>
                </div>
                <div class="text-xs text-gold-400 font-semibold px-3 py-1.5 rounded-full bg-gold-500/10 border border-gold-500/20">
                    Dernière mise à jour : {{ date('d/m/Y') }}
                </div>
            </div>

            <div class="space-y-6">

                <div class="bg-nero-900/60 border border-nero-800 rounded-2xl p-6 sm:p-8 border-l-4 border-l-gold-500 shadow-lg transition-all hover:border-nero-700">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="p-2.5 bg-gold-500/10 rounded-xl text-gold-400 border border-gold-500/20">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m0 0h5m-5 0V7a2 2 0 012-2h2a2 2 0 012 2v14"></path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-nero-100 font-title">
                            1. Éditeur de la plateforme
                        </h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm text-nero-300">
                        <div class="bg-nero-950/40 p-4 rounded-xl border border-nero-800/80">
                            <p class="font-semibold text-gold-400 mb-1">Société / Raison Sociale :</p>
                            <p class="text-nero-200">VISIONBF Centre d'Appel</p>
                        </div>
                        <div class="bg-nero-950/40 p-4 rounded-xl border border-nero-800/80">
                            <p class="font-semibold text-gold-400 mb-1">Forme juridique :</p>
                            <p class="text-nero-200">Société à Responsabilité Limitée (SARL)</p>
                        </div>
                        <div class="bg-nero-950/40 p-4 rounded-xl border border-nero-800/80">
                            <p class="font-semibold text-gold-400 mb-1">Adresse du siège social :</p>
                            <p class="text-nero-200">[Votre Adresse Complète ICI]</p>
                        </div>
                        <div class="bg-nero-950/40 p-4 rounded-xl border border-nero-800/80">
                            <p class="font-semibold text-gold-400 mb-1">Numéro de téléphone :</p>
                            <p class="text-nero-200">+212 764 82 44 47</p>
                        </div>
                        <div class="bg-nero-950/40 p-4 rounded-xl border border-nero-800/80">
                            <p class="font-semibold text-gold-400 mb-1">Adresse E-mail :</p>
                            <p><a href="mailto:contact@visionbf.com" class="text-gold-400 hover:text-gold-300 underline underline-offset-4">contact@visionbf.com</a></p>
                        </div>
                        <div class="bg-nero-950/40 p-4 rounded-xl border border-nero-800/80">
                            <p class="font-semibold text-gold-400 mb-1">SIRET / Immatriculation :</p>
                            <p class="text-nero-200">XXX XXX XXX 000XX</p>
                        </div>
                    </div>
                </div>

                <div class="bg-nero-900/60 border border-nero-800 rounded-2xl p-6 sm:p-8 border-l-4 border-l-gold-500 shadow-lg transition-all hover:border-nero-700">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="p-2.5 bg-gold-500/10 rounded-xl text-gold-400 border border-gold-500/20">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"></path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-nero-100 font-title">
                            2. Hébergement du serveur
                        </h2>
                    </div>
                    <div class="text-sm text-nero-300 space-y-3">
                        <p><span class="font-semibold text-gold-400">Hébergeur :</span> OVHcloud / DigitalOcean / AWS (À adapter)</p>
                        <p><span class="font-semibold text-gold-400">Adresse de l'hébergeur :</span> 2 rue Kellermann - 59100 Roubaix - France</p>
                        <p><span class="font-semibold text-gold-400">Site Web :</span> <a href="https://www.ovhcloud.com" target="_blank" class="text-gold-400 hover:text-gold-300 underline underline-offset-4">www.ovhcloud.com</a></p>
                    </div>
                </div>

                <div class="bg-nero-900/60 border border-nero-800 rounded-2xl p-6 sm:p-8 border-l-4 border-l-gold-500 shadow-lg transition-all hover:border-nero-700">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="p-2.5 bg-gold-500/10 rounded-xl text-gold-400 border border-gold-500/20">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-nero-100 font-title">
                            3. Data & Protection des données personnelles (RGPD)
                        </h2>
                    </div>
                    <div class="text-sm text-nero-300 space-y-4 leading-relaxed">
                        <p>
                            Dans le cadre des activités de prospection (Lanterneaux, Énergie, etc.), la plateforme CRM <strong class="text-nero-100">VISIONBF</strong> enregistre des données d'appels et de contacts nécessaires au suivi commercial.
                        </p>
                        <p>
                            Conformément au Règlement Général sur la Protection des Données (RGPD), les prospects et utilisateurs disposent d'un droit d'accès, de rectification, de suppression et d'opposition concernant leurs données.
                        </p>
                        <div class="bg-nero-950/60 p-4 rounded-xl border border-nero-800">
                            <p class="font-semibold text-gold-400">Pour exercer vos droits :</p>
                            <p class="mt-1">
                                Contactez le Délégué à la Protection des Données (DPO) à l'adresse suivante :
                                <a href="mailto:contact@visionbf.com" class="text-gold-400 font-semibold hover:text-gold-300 underline underline-offset-4">contact@visionbf.com</a>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-nero-900/60 border border-nero-800 rounded-2xl p-6 sm:p-8 border-l-4 border-l-gold-500 shadow-lg transition-all hover:border-nero-700">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="p-2.5 bg-gold-500/10 rounded-xl text-gold-400 border border-gold-500/20">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457-.39-2.823-1.07-4"></path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-nero-100 font-title">
                            4. Propriété intellectuelle
                        </h2>
                    </div>
                    <div class="text-sm text-nero-300 space-y-2 leading-relaxed">
                        <p>
                            L'ensemble de la structure, des visuels, des fonctionnalités du CRM et de la marque <strong class="text-gold-gradient font-title">VISIONBF</strong> est protégé par les lois relatives à la propriété intellectuelle. Toute reproduction, distribution ou modification non autorisée est strictement interdite.
                        </p>
                    </div>
                </div>

            </div>

            <div class="flex justify-end pt-4">
                <a href="{{ route('welcome') }}" class="inline-flex items-center px-6 py-3 rounded-xl text-sm font-semibold text-nero-950 gold-gradient hover:opacity-90 shadow-lg shadow-gold-500/20 transition-all duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    {{ __('Retour à l\'accueil') }}
                </a>
            </div>

        </div>
    </main>

    <footer class="bg-nero-950 text-nero-500 text-xs py-10 border-t border-nero-900 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row justify-between items-center gap-6">
            <div class="flex items-center gap-3">
                <div class="aspect-square h-10 rounded-full bg-nero-900 border-2 border-gold-700 flex items-center justify-center overflow-hidden shrink-0 opacity-80">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo VISIONBF" class="h-full w-full object-cover">
                </div>
                <span class="font-title font-semibold text-gold-700 text-sm">VISIONBF</span>
            </div>
            <p>&copy; {{ date('Y') }} VISIONBF. Tous droits réservés.</p>
            <div class="flex space-x-8">
                <a href="{{ route('mentions.legales') }}" class="text-xs text-nero-400 hover:text-gold-400 transition-colors">
                    {{ __('Mentions Légales') }}
                </a>
            </div>
        </div>
    </footer>

</body>

</html>