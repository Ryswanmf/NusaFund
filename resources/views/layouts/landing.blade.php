<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', isset($meta) ? $meta['title'] : 'NusaFund - Kebaikan untuk Semua')</title>
    
    <!-- SEO & Social Sharing Meta Tags -->
    <meta name="description" content="{{ isset($meta) ? $meta['description'] : 'Platform penggalangan dana paling transparan dan terpercaya di Indonesia.' }}">
    <meta name="keywords" content="{{ isset($campaign->meta_keywords) ? $campaign->meta_keywords : 'donasi, zakat, infaq, sedekah, kemanusiaan' }}">
    
    <meta property="og:title" content="{{ isset($meta) ? $meta['title'] : 'NusaFund - Kebaikan untuk Semua' }}">
    <meta property="og:description" content="{{ isset($meta) ? $meta['description'] : 'Bantu sesama melalui berbagai program kemanusiaan di NusaFund.' }}">
    <meta property="og:image" content="{{ isset($meta) ? $meta['image'] : asset('images/nusafac.png') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta name="twitter:card" content="summary_large_image">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/nusafac.png') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-white font-sans text-zinc-900 antialiased">
    <!-- Navbar -->
    <nav class="text-white sticky top-0 z-50 transition-all duration-700 ease-in-out border-b" 
         x-data="{ mobileMenuOpen: false, scrolled: false }"
         @scroll.window="scrolled = (window.pageYOffset > 20 ? true : false)"
         :class="scrolled ? 'bg-maroon-900 border-white/5 shadow-[0_10px_30px_-15px_rgba(0,0,0,0.3)]' : 'bg-maroon-800 border-white/10'">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center transition-all duration-700 ease-in-out lg:gap-12"
                 :class="scrolled ? 'h-14' : 'h-20'">
                
                <!-- Sisi Kiri: Logo & Search -->
                <div class="flex items-center gap-8 flex-1">
                    <a href="/" class="flex-shrink-0 flex items-center gap-2 group transition-all duration-700 ease-in-out hover:scale-105 active:scale-95 origin-left"
                       :class="scrolled ? 'scale-90' : 'scale-100'">
                        @if($settings && $settings->site_logo)
                            <img src="{{ asset('storage/' . $settings->site_logo) }}" alt="Logo" class="h-10 w-auto">
                        @else
                            <span class="text-2xl font-bold tracking-tight text-white group-hover:text-amber-400 transition-all duration-700">Nusa<span class="text-amber-400 font-extrabold group-hover:text-white transition-all duration-700">Fund</span></span>
                        @endif
                    </a>
                    
                    <!-- Search Bar (Hidden on mobile) -->
                    <div class="hidden md:block flex-1 max-w-md" x-data="{ searchFocused: false }">
                        <form action="{{ route('donasi.index') }}" method="GET" class="relative group">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none transition-colors duration-300"
                                  :class="searchFocused ? 'text-amber-400' : 'text-maroon-300'">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </span>
                            <input type="text" 
                                   name="search"
                                   @focus="searchFocused = true"
                                   @blur="searchFocused = false"
                                   value="{{ request('search') }}"
                                   class="block w-full bg-maroon-900/50 border border-maroon-700/50 rounded-full py-2.5 pl-10 pr-3 text-sm placeholder-maroon-300 text-white focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition-all duration-300"
                                   :class="searchFocused ? 'bg-maroon-900 shadow-[0_0_20px_rgba(251,191,36,0.15)] scale-[1.02]' : ''"
                                   placeholder="Cari campaign kebaikan...">
                        </form>
                    </div>
                </div>

                <!-- Sisi Kanan: Menu Navigasi (Desktop) -->
                <div class="hidden lg:flex items-center space-x-8 text-sm font-semibold tracking-wide">
                    <a href="/" class="relative py-2 text-maroon-100 hover:text-amber-400 transition-colors duration-300 group {{ Request::is('/') ? 'text-amber-400' : '' }}">
                        Beranda
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-amber-400 transform origin-left transition-transform duration-300 {{ Request::is('/') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
                    </a>
                    <a href="{{ route('donasi.index') }}" class="relative py-2 text-maroon-100 hover:text-amber-400 transition-colors duration-300 group {{ Request::is('donasi*') ? 'text-amber-400' : '' }}">
                        Donasi
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-amber-400 transform origin-left transition-transform duration-300 {{ Request::is('donasi*') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
                    </a>
                    <a href="{{ route('event.index') }}" class="relative py-2 text-maroon-100 hover:text-amber-400 transition-colors duration-300 group {{ Request::is('event*') ? 'text-amber-400' : '' }}">
                        Event
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-amber-400 transform origin-left transition-transform duration-300 {{ Request::is('event*') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
                    </a>
                    <a href="{{ route('zakat.index') }}" class="relative py-2 text-maroon-100 hover:text-amber-400 transition-colors duration-300 group {{ Request::is('zakat*') ? 'text-amber-400' : '' }}">
                        Zakat
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-amber-400 transform origin-left transition-transform duration-300 {{ Request::is('zakat*') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
                    </a>
                    <a href="{{ route('fundraising.index') }}" class="relative py-2 text-maroon-100 hover:text-amber-400 transition-colors duration-300 group {{ Request::is('galang-dana*') ? 'text-amber-400' : '' }}">
                        Galang Dana
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-amber-400 transform origin-left transition-transform duration-300 {{ Request::is('galang-dana*') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
                    </a>
                    <a href="{{ route('about') }}" class="relative py-2 text-maroon-100 hover:text-amber-400 transition-colors duration-300 group {{ Request::is('tentang-kami') ? 'text-amber-400' : '' }}">
                        Tentang Kami
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-amber-400 transform origin-left transition-transform duration-300 {{ Request::is('tentang-kami') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
                    </a>
                    
                    @auth
                        <!-- User Dropdown -->
                        <div class="relative" x-data="{ open: false }" @click.away="open = false">
                            <button @click="open = !open" class="flex items-center transition-all duration-300 active:scale-95 group">
                                <div class="w-10 h-10 rounded-full bg-amber-500 border-4 border-maroon-700/50 group-hover:border-amber-400 flex items-center justify-center text-maroon-950 font-black text-xs transition-all duration-300 shadow-lg overflow-hidden">
                                    @if(Auth::user()->avatar)
                                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}" class="w-full h-full object-cover">
                                    @else
                                        {{ substr(Auth::user()->name, 0, 2) }}
                                    @endif
                                </div>
                            </button>

                            <!-- Dropdown Menu -->
                            <div x-show="open" 
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                 x-transition:leave-end="opacity-0 scale-95 translate-y-2"
                                 class="absolute right-0 mt-3 w-64 bg-white rounded-[2rem] shadow-2xl border border-zinc-100 py-4 z-50 overflow-hidden" 
                                 x-cloak>
                                
                                <div class="px-6 py-4 border-b border-zinc-50 mb-2">
                                    <p class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">Akun Donatur</p>
                                    <p class="text-sm font-black text-zinc-900 truncate">{{ Auth::user()->name }}</p>
                                </div>

                                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-6 py-3 text-sm font-bold text-zinc-600 hover:bg-maroon-50 hover:text-maroon-700 transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                                    Dashboard Saya
                                </a>
                                <a href="{{ route('dashboard.fundraising') }}" class="flex items-center gap-3 px-6 py-3 text-sm font-bold text-zinc-600 hover:bg-maroon-50 hover:text-maroon-700 transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                    Galang Dana Saya
                                </a>
                                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-6 py-3 text-sm font-bold text-zinc-600 hover:bg-maroon-50 hover:text-maroon-700 transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                    Sertifikat Digital
                                </a>
                                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-6 py-3 text-sm font-bold text-zinc-600 hover:bg-maroon-50 hover:text-maroon-700 transition border-b border-zinc-50">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    Pengaturan Profil
                                </a>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center gap-3 px-6 py-4 text-sm font-black text-red-600 hover:bg-red-50 transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                        Keluar Akun
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="flex items-center gap-5">
                            <a href="{{ route('login') }}" class="text-white hover:text-amber-400 transition px-3 py-2 text-sm font-bold">
                                Masuk
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-amber-500 hover:bg-amber-400 text-maroon-950 px-5 py-2 rounded-full font-bold transition shadow-lg shadow-amber-900/20 active:scale-95 text-sm">
                                    Daftar
                                </a>
                            @endif
                        </div>
                    @endauth
                </div>

                <!-- Mobile menu button -->
                <div class="lg:hidden flex items-center">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-white p-2 hover:bg-maroon-700 rounded-lg transition">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             class="lg:hidden bg-maroon-900 border-t border-maroon-700 overflow-hidden shadow-2xl">
            <div class="px-4 pt-2 pb-6 space-y-3">
                <a href="/" class="block px-4 py-3 rounded-xl hover:bg-maroon-800 hover:text-amber-400 transition font-medium {{ Request::is('/') ? 'text-amber-400 bg-maroon-800' : '' }}">Beranda</a>
                <a href="{{ route('donasi.index') }}" class="block px-4 py-3 rounded-xl hover:bg-maroon-800 hover:text-amber-400 transition font-medium {{ Request::is('donasi*') ? 'text-amber-400 bg-maroon-800' : '' }}">Donasi</a>
                <a href="{{ route('event.index') }}" class="block px-4 py-3 rounded-xl hover:bg-maroon-800 hover:text-amber-400 transition font-medium {{ Request::is('event*') ? 'text-amber-400 bg-maroon-800' : '' }}">Event</a>
                <a href="{{ route('zakat.index') }}" class="block px-4 py-3 rounded-xl hover:bg-maroon-800 hover:text-amber-400 transition font-medium {{ Request::is('zakat*') ? 'text-amber-400 bg-maroon-800' : '' }}">Zakat</a>
                <a href="{{ route('fundraising.index') }}" class="block px-4 py-3 rounded-xl hover:bg-maroon-800 hover:text-amber-400 transition font-medium {{ Request::is('galang-dana*') ? 'text-amber-400 bg-maroon-800' : '' }}">Galang Dana</a>
                <a href="{{ route('about') }}" class="block px-4 py-3 rounded-xl hover:bg-maroon-800 hover:text-amber-400 transition font-medium {{ Request::is('tentang-kami') ? 'text-amber-400 bg-maroon-800' : '' }}">Tentang Kami</a>
                <div class="pt-4 space-y-3">
                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-center border border-white/20 text-white py-3 rounded-xl font-bold text-sm">
                                Keluar Akun
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="block w-full text-center border border-amber-500/50 text-amber-500 py-3 rounded-xl font-bold text-sm">Masuk</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="block w-full text-center bg-amber-500 text-maroon-950 py-3 rounded-xl font-bold shadow-lg text-sm">Daftar Sekarang</a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <!-- ChatBot Widget -->
    <div x-data="{ 
            open: false, 
            message: '', 
            messages: [{ text: 'Halo! Saya NusaBot. Ada yang bisa saya bantu hari ini?', type: 'bot' }],
            isLoading: false,
            quickReplies: [
                { label: '🎁 Cari Donasi', query: 'donasi' },
                { label: '💰 Info Zakat', query: 'zakat' },
                { label: '📍 Alamat Kantor', query: 'lokasi' },
                { label: '📞 Hubungi Admin', query: 'kontak admin' }
            ],
            async sendMessage(text = null) {
                const userText = text || this.message;
                if (userText.trim() === '') return;
                
                this.messages.push({ text: userText, type: 'user' });
                this.message = '';
                this.isLoading = true;

                this.$nextTick(() => this.scrollToBottom());

                try {
                    const response = await fetch('{{ route('chatbot.message') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ message: userText })
                    });
                    const data = await response.json();
                    this.messages.push({ text: data.reply, type: 'bot' });
                } catch (e) {
                    this.messages.push({ text: 'Maaf, sedang ada gangguan koneksi.', type: 'bot' });
                } finally {
                    this.isLoading = false;
                    this.$nextTick(() => this.scrollToBottom());
                }
            },
            scrollToBottom() {
                const container = this.$refs.chatContainer;
                container.scrollTo({ top: container.scrollHeight, behavior: 'smooth' });
            }
         }" 
         class="fixed bottom-24 md:bottom-8 right-6 md:right-8 z-[60]">
        
        <!-- Toggle Button with Notification Pulse -->
        <button @click="open = !open" 
                class="w-16 h-16 bg-maroon-800 text-white rounded-[2rem] shadow-[0_20px_50px_rgba(128,0,0,0.3)] flex items-center justify-center hover:scale-110 active:scale-95 transition-all duration-300 border-4 border-white relative group">
            <div x-show="!open" class="absolute -top-1 -right-1 w-4 h-4 bg-amber-500 rounded-full border-2 border-white animate-bounce"></div>
            <svg x-show="!open" class="w-8 h-8 group-hover:rotate-12 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
            <svg x-show="open" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>

        <!-- Chat Window -->
        <div x-show="open" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95 translate-y-10"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-cloak
             class="absolute bottom-20 right-0 w-[calc(100vw-2rem)] md:w-[420px] max-w-[420px] max-h-[calc(100vh-120px)] bg-white rounded-[2.5rem] shadow-[0_40px_120px_rgba(0,0,0,0.25)] border border-zinc-100 overflow-hidden flex flex-col">
            
            <!-- Header -->
            <div class="bg-maroon-800 p-5 md:p-6 text-white relative flex-shrink-0">
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full translate-x-16 -translate-y-16"></div>
                <div class="flex items-center gap-4 relative z-10">
                    <div class="w-10 h-10 md:w-12 md:h-12 rounded-2xl bg-white/10 flex items-center justify-center border border-white/20 shadow-inner">
                        <svg class="w-6 h-6 md:w-7 md:h-7 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <div>
                        <p class="font-black text-sm md:text-base tracking-tight">NusaBot Assistant</p>
                        <div class="flex items-center gap-1.5">
                            <div class="w-2 h-2 rounded-full bg-green-400 animate-pulse shadow-[0_0_8px_rgba(74,222,128,0.8)]"></div>
                            <p class="text-[9px] md:text-[10px] font-bold text-maroon-200 uppercase tracking-widest">Online</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Messages Area -->
            <div x-ref="chatContainer" class="flex-1 overflow-y-auto p-6 space-y-6 bg-zinc-50/30 scrollbar-hide min-h-[250px]">
                <template x-for="(msg, index) in messages" :key="index">
                    <div :class="msg.type === 'bot' ? 'justify-start' : 'justify-end'" class="flex group">
                        <div :class="msg.type === 'bot' ? 'bg-white text-zinc-700 rounded-bl-none shadow-sm border border-zinc-100' : 'bg-maroon-800 text-white rounded-br-none shadow-maroon-900/20 shadow-xl'" 
                             class="max-w-[85%] p-4 rounded-[1.8rem] text-[13px] font-medium whitespace-pre-line leading-relaxed transition-all">
                            <span x-text="msg.text"></span>
                        </div>
                    </div>
                </template>
                
                <!-- Typing Indicator -->
                <div x-show="isLoading" class="flex justify-start">
                    <div class="bg-white p-4 rounded-[1.5rem] rounded-bl-none shadow-sm border border-zinc-100 flex gap-1.5">
                        <div class="w-1.5 h-1.5 bg-maroon-300 rounded-full animate-bounce"></div>
                        <div class="w-1.5 h-1.5 bg-maroon-300 rounded-full animate-bounce [animation-delay:0.2s]"></div>
                        <div class="w-1.5 h-1.5 bg-maroon-300 rounded-full animate-bounce [animation-delay:0.4s]"></div>
                    </div>
                </div>

                <!-- Quick Replies -->
                <div x-show="messages.length === 1 && !isLoading" class="pt-2">
                    <p class="text-[10px] font-black text-zinc-400 uppercase tracking-widest mb-3 px-1">Pertanyaan Populer:</p>
                    <div class="flex flex-wrap gap-2">
                        <template x-for="reply in quickReplies">
                            <button @click="sendMessage(reply.query)" 
                                    class="bg-white border border-zinc-200 px-4 py-2 rounded-xl text-xs font-bold text-zinc-600 hover:border-maroon-500 hover:text-maroon-700 transition-all shadow-sm active:scale-95">
                                <span x-text="reply.label"></span>
                            </button>
                        </template>
                    </div>
                </div>
            </div>

            <!-- Input Area -->
            <div class="p-5 bg-white border-t border-zinc-100">
                <form @submit.prevent="sendMessage()" class="relative flex items-center gap-3">
                    <div class="relative flex-1">
                        <input type="text" 
                               x-model="message"
                               placeholder="Tulis pesan..." 
                               class="w-full bg-zinc-100 border-none rounded-2xl py-4 pl-6 pr-4 text-sm focus:ring-2 focus:ring-maroon-500 font-medium transition-all">
                    </div>
                    <button type="submit" 
                            :disabled="isLoading || message.trim() === ''"
                            :class="message.trim() === '' ? 'bg-zinc-200 text-zinc-400' : 'bg-maroon-800 text-white shadow-lg shadow-maroon-900/20'"
                            class="w-12 h-12 rounded-2xl flex items-center justify-center transition-all active:scale-90">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 12h14M12 5l7 7-7 7"></path></svg>
                    </button>
                </form>
                <div class="flex items-center justify-center gap-2 mt-4">
                    <span class="w-1 h-1 rounded-full bg-zinc-300"></span>
                    <p class="text-[9px] text-zinc-400 font-black uppercase tracking-widest">NusaBot Virtual Assistant</p>
                    <span class="w-1 h-1 rounded-full bg-zinc-300"></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-zinc-950 text-zinc-400 pt-24 pb-12 border-t border-zinc-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-16 mb-20">
                <!-- Brand & About -->
                <div class="space-y-8">
                    <a href="/" class="inline-block">
                        @if($settings && $settings->site_logo)
                            <img src="{{ asset('storage/' . $settings->site_logo) }}" alt="Logo" class="h-10 w-auto">
                        @else
                            <span class="text-3xl font-bold tracking-tight text-white">Nusa<span class="text-amber-400 font-extrabold">Fund</span></span>
                        @endif
                    </a>
                    <p class="text-sm leading-relaxed opacity-80">
                        Platform penggalangan dana paling transparan dan terpercaya di Indonesia. Membantu menghubungkan kebaikan Anda kepada mereka yang paling membutuhkan.
                    </p>
                    <div class="flex items-center gap-5">
                        @if($settings && $settings->facebook)
                        <a href="{{ $settings->facebook }}" target="_blank" class="w-12 h-12 rounded-2xl bg-zinc-900 flex items-center justify-center hover:bg-maroon-600 hover:text-white transition-all duration-300 transform hover:-translate-y-1">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        @endif
                        @if($settings && $settings->instagram)
                        <a href="{{ $settings->instagram }}" target="_blank" class="w-12 h-12 rounded-2xl bg-zinc-900 flex items-center justify-center hover:bg-maroon-600 hover:text-white transition-all duration-300 transform hover:-translate-y-1">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        @endif
                        @if($settings && $settings->youtube)
                        <a href="{{ $settings->youtube }}" target="_blank" class="w-12 h-12 rounded-2xl bg-zinc-900 flex items-center justify-center hover:bg-maroon-600 hover:text-white transition-all duration-300 transform hover:-translate-y-1">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 4-8 4z"/></svg>
                        </a>
                        @endif
                    </div>
                </div>

                <!-- Kolom 2: Program -->
                <div class="space-y-8 lg:pl-10">
                    <h4 class="text-white font-black text-lg uppercase tracking-widest">Program</h4>
                    <ul class="space-y-4 text-sm font-medium">
                        <li><a href="{{ route('donasi.index') }}" class="hover:text-amber-400 transition-colors">Donasi Pilihan</a></li>
                        <li><a href="{{ route('zakat.index') }}" class="hover:text-amber-400 transition-colors">Bayar Zakat</a></li>
                        <li><a href="{{ route('fundraising.index') }}" class="hover:text-amber-400 transition-colors">Galang Dana</a></li>
                        <li><a href="{{ route('home') }}" class="hover:text-amber-400 transition-colors">Campaign Utama</a></li>
                    </ul>
                </div>

                <!-- Kolom 3: Dukungan -->
                <div class="space-y-8">
                    <h4 class="text-white font-black text-lg uppercase tracking-widest">Dukungan</h4>
                    <ul class="space-y-4 text-sm font-medium">
                        <li><a href="{{ route('support.index') }}" class="hover:text-amber-400 transition-colors">Pusat Bantuan</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-amber-400 transition-colors">Tentang Kami</a></li>
                        <li><a href="{{ route('terms.index') }}" class="hover:text-amber-400 transition-colors">Syarat & Ketentuan</a></li>
                        <li><a href="{{ route('privacy.index') }}" class="hover:text-amber-400 transition-colors">Kebijakan Privasi</a></li>
                        <li><a href="{{ route('faq.index') }}" class="hover:text-amber-400 transition-colors">FAQ</a></li>
                    </ul>
                </div>

                <!-- Kolom 4: Hubungi -->
                <div class="space-y-8">
                    <h4 class="text-white font-black text-lg uppercase tracking-widest">Hubungi</h4>
                    <ul class="space-y-5 text-sm font-medium leading-relaxed">
                        <li class="flex items-start gap-4">
                            <span class="p-2 bg-zinc-900 rounded-lg text-maroon-500"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg></span>
                            <span>{{ $settings->address ?? 'Alamat belum diatur.' }}</span>
                        </li>
                        <li class="flex items-center gap-4">
                            <span class="p-2 bg-zinc-900 rounded-lg text-maroon-500"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg></span>
                            <span>{{ $settings->email ?? 'Email belum diatur.' }}</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-zinc-900 pt-12 flex flex-col md:flex-row justify-between items-center gap-8 text-[10px] font-black uppercase tracking-[0.2em] text-zinc-600">
                <p>&copy; {{ $settings->copyright ?? date('Y') . ' NusaFund.' }}</p>
                <div class="flex items-center gap-6">
                    <span class="text-zinc-500">Transparansi Keuangan 100%</span>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
