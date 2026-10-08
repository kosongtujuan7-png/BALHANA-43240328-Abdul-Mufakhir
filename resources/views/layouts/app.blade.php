<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#242422">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'BALHANA')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="layout-container">
        <aside class="sidebar" aria-label="Navigasi BALHANA">
            <div class="sidebar-logo">BALHANA</div>

            <div style="margin: 0 26px 12px; color: #aaa69d; font-size: 8px; letter-spacing: 0.08em; line-height: 1.5; text-transform: uppercase;">
                Catat. Pahami. Bertumbuh.
            </div>

            <nav class="sidebar-nav" aria-label="Menu utama">
                <a href="{{ route('beranda') }}"
                   class="sidebar-item {{ request()->routeIs('beranda') ? 'active' : '' }}"
                   @if(request()->routeIs('beranda')) aria-current="page" @endif>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path d="m3 10 9-7 9 7v10a1 1 0 0 1-1 1h-5v-6H9v6H4a1 1 0 0 1-1-1z"/>
                    </svg>
                    <span>Beranda</span>
                </a>

                <a href="{{ route('produk') }}"
                   class="sidebar-item {{ request()->routeIs('produk') ? 'active' : '' }}"
                   @if(request()->routeIs('produk')) aria-current="page" @endif>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path d="M20 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                        <path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/>
                    </svg>
                    <span>Produk</span>
                </a>

                <a href="{{ route('riset-pasar') }}"
                   class="sidebar-item {{ request()->routeIs('riset-pasar') ? 'active' : '' }}"
                   @if(request()->routeIs('riset-pasar')) aria-current="page" @endif>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <circle cx="11" cy="11" r="8"/>
                        <path d="m21 21-4.35-4.35"/>
                    </svg>
                    <span>Riset Pasar</span>
                </a>

                <a href="{{ route('analisis-minat') }}"
                   class="sidebar-item {{ request()->routeIs('analisis-minat') ? 'active' : '' }}"
                   @if(request()->routeIs('analisis-minat')) aria-current="page" @endif>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path d="M22 12h-4l-3 9L9 3l-3 9H2"/>
                    </svg>
                    <span>Analisis Minat</span>
                </a>

                <a href="{{ route('rekomendasi-restock') }}"
                   class="sidebar-item {{ request()->routeIs('rekomendasi-restock') ? 'active' : '' }}"
                   @if(request()->routeIs('rekomendasi-restock')) aria-current="page" @endif>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path d="m12 3 1.9 5.8L20 11l-6.1 2.2L12 19l-1.9-5.8L4 11l6.1-2.2L12 3z"/>
                        <path d="m19 14 1.1 3.1L23 18l-2.9 1-1.1 3-1-3-3-1 3-.9 1-3.1z"/>
                    </svg>
                    <span>Rekomendasi Restock</span>
                </a>

                <a href="{{ route('stok') }}"
                   class="sidebar-item {{ request()->routeIs('stok') ? 'active' : '' }}"
                   @if(request()->routeIs('stok')) aria-current="page" @endif>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path d="M20 12V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6"/>
                        <path d="m16 18 2 2 4-4"/>
                    </svg>
                    <span>Stok</span>
                </a>

                <a href="{{ route('pembelian') }}"
                   class="sidebar-item {{ request()->routeIs('pembelian') ? 'active' : '' }}"
                   @if(request()->routeIs('pembelian')) aria-current="page" @endif>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
                        <path d="M3 6h18"/>
                        <path d="M16 10a4 4 0 0 1-8 0"/>
                    </svg>
                    <span>Pembelian</span>
                </a>

                <a href="{{ route('penjualan') }}"
                   class="sidebar-item {{ request()->routeIs('penjualan') ? 'active' : '' }}"
                   @if(request()->routeIs('penjualan')) aria-current="page" @endif>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path d="M3 3h2l2.4 11.5a2 2 0 0 0 2 1.5h8.8a2 2 0 0 0 2-1.5L22 8H6"/>
                        <circle cx="10" cy="20" r="1"/>
                        <circle cx="18" cy="20" r="1"/>
                    </svg>
                    <span>Penjualan</span>
                </a>

                <a href="{{ route('keuangan') }}"
                   class="sidebar-item {{ request()->routeIs('keuangan') ? 'active' : '' }}"
                   @if(request()->routeIs('keuangan')) aria-current="page" @endif>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <rect x="3" y="5" width="18" height="14" rx="2"/>
                        <path d="M3 10h18"/>
                        <path d="M7 15h3"/>
                    </svg>
                    <span>Keuangan</span>
                </a>

                <a href="{{ route('laporan') }}"
                   class="sidebar-item {{ request()->routeIs('laporan') ? 'active' : '' }}"
                   @if(request()->routeIs('laporan')) aria-current="page" @endif>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                        <path d="M14 2v6h6"/>
                        <path d="M8 13h8M8 17h8"/>
                    </svg>
                    <span>Laporan</span>
                </a>

                <a href="{{ route('pengaturan') }}"
                   class="sidebar-item {{ request()->routeIs('pengaturan') ? 'active' : '' }}"
                   @if(request()->routeIs('pengaturan')) aria-current="page" @endif>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <circle cx="12" cy="12" r="3"/>
                        <path d="m19.4 15 .1.1a2 2 0 0 1-2.8 2.8l-.2-.1a2 2 0 0 0-3.3 1.4v.2a2 2 0 0 1-4 0v-.2A2 2 0 0 0 5.8 18l-.1.1a2 2 0 0 1-2.8-2.8l.1-.2a2 2 0 0 0-1.4-3.3h-.2a2 2 0 0 1 0-4h.2A2 2 0 0 0 3 4.5l-.1-.1a2 2 0 0 1 2.8-2.8l.2.1a2 2 0 0 0 3.3-1.4v-.2a2 2 0 0 1 4 0v.2a2 2 0 0 0 3.3 1.4l.2-.1a2 2 0 0 1 2.8 2.8l-.1.2a2 2 0 0 0 1.4 3.3h.2a2 2 0 0 1 0 4h-.2a2 2 0 0 0-1.4 3.3z"/>
                    </svg>
                    <span>Pengaturan</span>
                </a>
            </nav>

            <div style="margin-top: auto; padding: 8px 16px 20px;">
                <div class="neu-card-sm" style="padding: 14px;">
                    <div style="margin-bottom: 7px; color: #d4b47b; font-size: 9px; font-weight: 600;">
                        Ruang bisnis pribadi
                    </div>
                    <div style="margin-bottom: 5px; color: #eeeae1; font-size: 11px; font-weight: 600;">
                        BALHANA Fashion
                    </div>
                    <div style="color: #aaa69d; font-size: 10px; line-height: 1.45;">
                        Kelola usaha Anda, bukan etalase marketplace.
                    </div>
                </div>

                <div style="display: flex; align-items: center; gap: 8px; margin-top: 16px; padding: 0 4px; color: #aaa69d; font-size: 10px;">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path d="M21 12.8A9 9 0 1 1 11.2 3 7 7 0 0 0 21 12.8z"/>
                    </svg>
                    <span>Dark luxury <span aria-hidden="true">•</span> IDR</span>
                </div>
            </div>
        </aside>

        <main class="main-content">
            <header class="topbar">
                <label class="search-bar">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <circle cx="11" cy="11" r="8"/>
                        <path d="m21 21-4.35-4.35"/>
                    </svg>

                    <input
                        type="search"
                        name="global_search"
                        placeholder="Cari produk, transaksi, atau laporan..."
                        aria-label="Cari produk, transaksi, atau laporan"
                        autocomplete="off"
                    >

                    <span class="search-shortcut" aria-hidden="true">Ctrl K</span>
                </label>

                <div class="topbar-actions">
                    <button class="notification-btn" type="button" aria-label="Notifikasi">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"/>
                            <path d="M13.7 21a2 2 0 0 1-3.4 0"/>
                        </svg>
                        <span class="notification-dot" aria-hidden="true"></span>
                    </button>

                    <div class="user-profile" aria-label="Pengguna: Nadia Aulia, Pemilik bisnis">
                        <div class="avatar" aria-hidden="true">NA</div>
                        <div>
                            <span>Nadia Aulia</span>
                            <span>Pemilik bisnis</span>
                        </div>
                    </div>
                </div>
            </header>

            <div class="page-content">
                @yield('content')
            </div>
        </main>
    </div>

    @stack('scripts')
</body>
</html>