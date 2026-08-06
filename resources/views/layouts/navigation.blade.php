<nav x-data="{ open: false }" class="bg-slate-950 border-b border-amber-500/20 shadow-lg text-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}"
                        class="block p-1 bg-slate-900 rounded-full border-2 border-amber-500 shadow-md hover:border-amber-400 hover:shadow-amber-500/20 transition">
                        <img src="{{ asset('images/logo2.png') }}" alt="VISIONBF Logo"
                            class="block h-10 w-10 rounded-full object-cover" />
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                        class="text-slate-300 hover:text-amber-400 focus:text-amber-400 active:text-amber-500 font-medium transition">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <x-nav-link :href="route('leads.index')" :active="request()->routeIs('leads.*')"
                        class="text-slate-300 hover:text-amber-400 focus:text-amber-400 active:text-amber-500 font-medium transition">
                        {{ __('Fiches Prospection') }}
                    </x-nav-link>

                    @if(auth()->user()->role === 'admin')
                        <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')"
                            class="text-slate-300 hover:text-amber-400 font-medium transition">
                            {{ __('Gestion Utilisateurs') }}
                        </x-nav-link>
                        <x-nav-link :href="route('teams.index')" :active="request()->routeIs('teams.*')"
                            class="text-slate-300 hover:text-amber-400 font-medium transition">
                            {{ __('Gestion Équipes') }}
                        </x-nav-link>
                        <x-nav-link :href="route('newsletters.index')"
                            :active="request()->routeIs('newsletters.*')"
                            class="text-slate-300 hover:text-amber-400 font-medium transition">
                            {{ __('Newsletter') }}
                        </x-nav-link>
                    @endif
                    

                    @auth
                        <x-nav-link :href="route('tickets.index')" :active="request()->routeIs('tickets.*')"
                            class="text-slate-300 hover:text-amber-400 font-medium transition">
                            {{ __('Support & Tickets') }}
                        </x-nav-link>
                    @endauth
                </div>
            </div>

            <div class="flex items-center gap-2">
                @auth
                    <div class="relative flex items-center">
                        <button id="notificationDropdown" type="button"
                            class="relative p-2 text-slate-300 hover:text-amber-400 focus:outline-none transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>

                            <span id="notif-badge"
                                class="hidden absolute top-0 right-0 inline-flex items-center justify-center px-1.5 py-0.5 text-xs font-bold leading-none text-white bg-red-600 rounded-full">
                                0
                            </span>
                        </button>

                        <div id="notificationMenu"
                            class="hidden absolute right-0 top-12 w-80 bg-slate-900 rounded-md shadow-2xl overflow-hidden z-50 border border-amber-500/30 text-slate-100">
                            <div
                                class="p-3 bg-slate-950 font-semibold text-sm border-b border-amber-500/20 flex justify-between items-center text-amber-400">
                                <span>Notifications</span>
                            </div>
                            <div id="notif-container" class="max-h-64 overflow-y-auto">
                                <p class="p-3 text-xs text-slate-400 text-center">Chargement...</p>
                            </div>
                        </div>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const btn = document.getElementById('notificationDropdown');
                            const menu = document.getElementById('notificationMenu');
                            const badge = document.getElementById('notif-badge');
                            const container = document.getElementById('notif-container');

                            function fetchNotifications() {
                                fetch('/notifications/unread')
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.count > 0) {
                                            badge.textContent = data.count;
                                            badge.classList.remove('hidden');
                                        } else {
                                            badge.classList.add('hidden');
                                        }

                                        if (data.notifications && data.notifications.length > 0) {
                                            container.innerHTML = data.notifications.map(notif => `
                                                    <a href="${notif.url}" 
                                                       onclick="markNotifAsRead(event, '${notif.id}', '${notif.url}')"
                                                       class="block p-3 border-b border-slate-800 text-xs hover:bg-slate-800/60 transition">
                                                        <p class="font-bold text-amber-300">${notif.message}</p>
                                                        ${notif.raison_sociale ? `<p class="text-slate-300">Société : ${notif.raison_sociale}</p>` : ''}
                                                        <span class="text-slate-400 text-[10px]">${notif.time}</span>
                                                    </a>
                                                `).join('');
                                        } else {
                                            container.innerHTML = '<p class="p-3 text-xs text-slate-400 text-center">Aucune nouvelle notification</p>';
                                        }
                                    })
                                    .catch(err => console.error(err));
                            }

                            window.markNotifAsRead = function (event, notifId, targetUrl) {
                                event.preventDefault();

                                let currentCount = parseInt(badge.textContent || 0);
                                if (currentCount > 1) {
                                    badge.textContent = currentCount - 1;
                                } else {
                                    badge.classList.add('hidden');
                                    badge.textContent = 0;
                                }

                                fetch(`/notifications/${notifId}/read`, {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        'Content-Type': 'application/json'
                                    }
                                }).finally(() => {
                                    window.location.href = targetUrl;
                                });
                            };

                            btn.addEventListener('click', function (e) {
                                e.stopPropagation();
                                menu.classList.toggle('hidden');
                                if (!menu.classList.contains('hidden')) {
                                    fetchNotifications();
                                }
                            });

                            document.addEventListener('click', function (e) {
                                if (!menu.contains(e.target) && !btn.contains(e.target)) {
                                    menu.classList.add('hidden');
                                }
                            });

                            fetchNotifications();
                            setInterval(fetchNotifications, 10000);
                        });
                    </script>
                @endauth

                <div class="hidden sm:flex sm:items-center sm:ms-4">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-amber-500/30 text-sm leading-4 font-medium rounded-md text-slate-200 bg-slate-900 hover:bg-slate-800 hover:text-amber-400 transition shadow-sm">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4 text-amber-500" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="bg-slate-900 border border-amber-500/20 rounded-md shadow-xl py-1">
                                <x-dropdown-link :href="route('profile.edit')"
                                    class="text-slate-200 hover:bg-amber-500/10 hover:text-amber-400 transition">
                                    {{ __('Mon Profil') }}
                                </x-dropdown-link>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                        class="text-red-400 hover:bg-red-500/10 hover:text-red-300 transition"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Déconnexion') }}
                                    </x-dropdown-link>
                                </form>
                            </div>
                        </x-slot>
                    </x-dropdown>
                </div>

                <div class="-me-2 flex items-center sm:hidden">
                    <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-amber-400 hover:text-amber-300 hover:bg-slate-900 focus:outline-none transition">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-slate-950 border-b border-amber-500/20">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                class="text-slate-300 hover:text-amber-400 hover:bg-slate-900">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('leads.index')" :active="request()->routeIs('leads.*')"
                class="text-slate-300 hover:text-amber-400 hover:bg-slate-900">
                {{ __('Fiches Prospection') }}
            </x-responsive-nav-link>

            @if(auth()->user()->role === 'admin')
                <x-responsive-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')"
                    class="text-slate-300 hover:text-amber-400 hover:bg-slate-900">
                    {{ __('Gestion Utilisateurs') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('teams.index')" :active="request()->routeIs('teams.*')"
                    class="text-slate-300 hover:text-amber-400 hover:bg-slate-900">
                    {{ __('Gestion Équipes') }}
                </x-responsive-nav-link>
            @endif

            @auth
                <x-responsive-nav-link :href="route('tickets.index')" :active="request()->routeIs('tickets.*')"
                    class="text-slate-300 hover:text-amber-400 hover:bg-slate-900">
                    {{ __('Support & Tickets') }}
                </x-responsive-nav-link>
            @endauth
        </div>

        <div class="pt-4 pb-3 border-t border-slate-800 bg-slate-900/60 px-4">
            <div class="mb-3">
                <div class="font-medium text-base text-amber-400">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-slate-400">{{ Auth::user()->email }}</div>
            </div>

            <div class="space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="text-slate-300 hover:text-amber-400">
                    {{ __('Mon Profil') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" class="text-red-400 hover:text-red-300"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Déconnexion') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>