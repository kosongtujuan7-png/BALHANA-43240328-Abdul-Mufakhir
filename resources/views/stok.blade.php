@extends('layouts.app')

@section('title', 'Stok – BALHANA')

@section('content')
@php
    $varianStok = [
        [
            'produk' => 'Kemeja Linen',
            'kategori' => 'Atasan',
            'ukuran' => 'L',
            'warna' => 'Hitam',
            'stok' => 3,
            'masuk' => 0,
            'keluar' => 12,
            'selisih' => -12,
            'status' => 'Menipis',
            'statusClass' => 'badge-orange',
        ],
        [
            'produk' => 'Tunik Aira',
            'kategori' => 'Atasan',
            'ukuran' => 'M',
            'warna' => 'Cream',
            'stok' => 2,
            'masuk' => 0,
            'keluar' => 8,
            'selisih' => -8,
            'status' => 'Menipis',
            'statusClass' => 'badge-orange',
        ],
        [
            'produk' => 'Outer Knit',
            'kategori' => 'Outer',
            'ukuran' => 'All size',
            'warna' => 'Beige',
            'stok' => 1,
            'masuk' => 0,
            'keluar' => 6,
            'selisih' => -6,
            'status' => 'Menipis',
            'statusClass' => 'badge-orange',
        ],
        [
            'produk' => 'Celana Kulot',
            'kategori' => 'Bawahan',
            'ukuran' => 'L',
            'warna' => 'Mocca',
            'stok' => 1,
            'masuk' => 0,
            'keluar' => 10,
            'selisih' => -10,
            'status' => 'Menipis',
            'statusClass' => 'badge-orange',
        ],
    ];

    $peringatanStok = [
        ['produk' => 'Kemeja Linen', 'varian' => 'L • Hitam', 'stok' => 3],
        ['produk' => 'Tunik Aira', 'varian' => 'M • Cream', 'stok' => 2],
        ['produk' => 'Outer Knit', 'varian' => 'All size • Beige', 'stok' => 1],
        ['produk' => 'Celana Kulot', 'varian' => 'L • Mocca', 'stok' => 1],
    ];
@endphp

<style>
    .stock-page {
        --stock-gold: #d4b47b;
        --stock-text: #eeeae1;
        --stock-muted: #aaa69d;
        color: var(--stock-text);
    }

    .stock-page *,
    .stock-page *::before,
    .stock-page *::after {
        box-sizing: border-box;
    }

    /* Raised surfaces use a soft upper-left highlight and deeper lower-right shadow. */
    .stock-page .neu-card,
    .stock-page .metric-card {
        border: 1px solid rgba(239,231,215,.035);
        background:
            linear-gradient(145deg, rgba(255,255,255,.018), transparent 38%),
            linear-gradient(145deg, #30312f, #2b2c2a 76%);
        box-shadow:
            12px 13px 24px rgba(0,0,0,.30),
            4px 5px 10px rgba(0,0,0,.20),
            -7px -7px 18px rgba(255,246,226,.035),
            inset 1px 1px 0 rgba(255,255,255,.025);
    }

    .stock-page .metric-card {
        position: relative;
        min-width: 0;
        overflow: hidden;
        border-radius: 22px;
        transition: transform .18s ease, box-shadow .18s ease;
    }

    .stock-page .metric-card:hover {
        transform: translateY(-2px);
        box-shadow:
            15px 16px 28px rgba(0,0,0,.34),
            5px 6px 12px rgba(0,0,0,.22),
            -8px -8px 19px rgba(255,246,226,.045),
            inset 1px 1px 0 rgba(255,255,255,.03);
    }

    .stock-page .neu-card {
        min-width: 0;
        border-radius: 22px;
    }

    /* Recessed search well. */
    .stock-page .neu-input {
        width: 100%;
        min-width: 0;
        min-height: 40px;
        padding: 9px 13px;
        border: 1px solid rgba(255,255,255,.025);
        border-radius: 11px;
        outline: none;
        background:
            linear-gradient(145deg, rgba(0,0,0,.12), transparent 65%),
            #242523;
        color: var(--stock-text);
        box-shadow:
            inset 5px 5px 10px rgba(0,0,0,.48),
            inset -3px -3px 8px rgba(255,246,226,.035),
            1px 1px 0 rgba(255,255,255,.018);
        font: inherit;
        font-size: 11px;
        transition: border-color .18s ease, box-shadow .18s ease;
    }

    .stock-page .neu-input:focus {
        border-color: rgba(215,183,126,.48);
        box-shadow:
            inset 5px 5px 10px rgba(0,0,0,.48),
            inset -3px -3px 8px rgba(255,246,226,.035),
            0 0 0 2px rgba(215,183,126,.09);
    }

    .stock-page input[type="search"] {
        color-scheme: dark;
    }

    .stock-page .filter-tab {
        flex: 0 0 auto;
        border: 1px solid rgba(255,255,255,.025);
        background: linear-gradient(145deg, #30312f, #292a28);
        box-shadow:
            4px 5px 9px rgba(0,0,0,.27),
            -3px -3px 8px rgba(255,246,226,.035),
            inset 1px 1px 0 rgba(255,255,255,.025);
        transition: box-shadow .16s ease, color .16s ease, transform .16s ease;
    }

    .stock-page .filter-tab:hover {
        color: var(--stock-gold);
        transform: translateY(-1px);
    }

    .stock-page .filter-tab.active {
        color: var(--stock-gold);
        box-shadow:
            inset 4px 4px 8px rgba(0,0,0,.34),
            inset -2px -2px 6px rgba(255,246,226,.025),
            1px 1px 0 rgba(255,255,255,.015);
    }

    .stock-page .btn-ghost {
        min-height: 36px;
        border: 1px solid rgba(255,255,255,.025);
        border-radius: 999px;
        background: linear-gradient(145deg, #333431, #292a28);
        color: var(--stock-text);
        box-shadow:
            5px 6px 11px rgba(0,0,0,.27),
            -3px -3px 8px rgba(255,246,226,.04),
            inset 1px 1px 0 rgba(255,255,255,.025);
        transition: transform .15s ease, box-shadow .15s ease, color .15s ease;
    }

    .stock-page .btn-ghost:hover {
        color: var(--stock-gold);
        transform: translateY(-1px);
    }

    .stock-page .btn-ghost:active {
        transform: translateY(1px);
        box-shadow:
            inset 4px 4px 8px rgba(0,0,0,.36),
            inset -2px -2px 6px rgba(255,246,226,.025);
    }

    .stock-page .balhana-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 8px;
    }

    .stock-page .balhana-table thead tr {
        overflow: hidden;
        border-radius: 10px;
        background: #242523;
        box-shadow:
            inset 4px 4px 8px rgba(0,0,0,.45),
            inset -2px -2px 6px rgba(255,246,226,.025);
    }

    .stock-page .balhana-table th {
        padding: 11px 14px;
        color: #aaa69d;
        font-size: 9px;
        font-weight: 500;
        text-align: left;
        white-space: nowrap;
    }

    .stock-page .balhana-table th:first-child {
        border-radius: 10px 0 0 10px;
    }

    .stock-page .balhana-table th:last-child {
        border-radius: 0 10px 10px 0;
    }

    .stock-page .balhana-table tbody tr {
        background: linear-gradient(145deg, #30312f, #292a28);
        box-shadow:
            4px 5px 9px rgba(0,0,0,.23),
            -2px -2px 6px rgba(255,246,226,.025),
            inset 1px 1px 0 rgba(255,255,255,.018);
    }

    .stock-page .balhana-table td {
        padding: 12px 14px;
        border-top: 1px solid rgba(255,255,255,.018);
        border-bottom: 1px solid rgba(0,0,0,.08);
        color: #aaa69d;
        font-size: 10px;
        vertical-align: middle;
        overflow-wrap: anywhere;
    }

    .stock-page .balhana-table td:first-child {
        border-radius: 11px 0 0 11px;
    }

    .stock-page .balhana-table td:last-child {
        border-radius: 0 11px 11px 0;
    }

    .stock-page .trend-chart-well {
        height: 184px;
        position: relative;
        padding: 10px 8px 5px;
        border: 1px solid rgba(245,239,225,.035);
        border-radius: 15px;
        background: #252523;
        box-shadow:
            inset 5px 5px 10px rgba(0,0,0,.40),
            inset -2px -2px 6px rgba(255,245,220,.025),
            1px 1px 0 rgba(255,255,255,.015);
    }

    .stock-page [data-stock-row][hidden] {
        display: none !important;
    }

    .stock-page .btn-ghost:focus-visible,
    .stock-page .filter-tab:focus-visible,
    .stock-page .section-link:focus-visible {
        outline: 2px solid rgba(215,183,126,.75);
        outline-offset: 3px;
    }

    /* Keep the shared sidebar tactile on this page. */
    body:has(.stock-page) .sidebar {
        background:
            linear-gradient(145deg, rgba(255,255,255,.018), transparent 35%),
            #292a28;
        box-shadow:
            12px 12px 24px rgba(0,0,0,.34),
            -7px -7px 18px rgba(255,246,226,.035),
            inset 1px 1px 0 rgba(255,255,255,.025);
    }

    body:has(.stock-page) .sidebar-item {
        border: 1px solid rgba(255,255,255,.018);
        box-shadow:
            5px 6px 11px rgba(0,0,0,.25),
            -3px -3px 8px rgba(255,246,226,.035),
            inset 1px 1px 0 rgba(255,255,255,.02);
        transition: box-shadow .16s ease, color .16s ease, transform .16s ease;
    }

    body:has(.stock-page) .sidebar-item:hover {
        transform: translateY(-1px);
        box-shadow:
            7px 8px 13px rgba(0,0,0,.28),
            -4px -4px 9px rgba(255,246,226,.04),
            inset 1px 1px 0 rgba(255,255,255,.025);
    }

    body:has(.stock-page) .sidebar-item.active {
        color: #d7b77e;
        box-shadow:
            inset 4px 4px 8px rgba(0,0,0,.36),
            inset -2px -2px 6px rgba(255,246,226,.025),
            1px 1px 0 rgba(255,255,255,.018);
    }

    body:has(.stock-page) .search-bar {
        background: #242523;
        box-shadow:
            inset 5px 5px 10px rgba(0,0,0,.46),
            inset -3px -3px 8px rgba(255,246,226,.035);
    }

    @media (max-width: 1000px) {
        .stock-page .stock-summary-grid,
        .stock-page .stock-trend-grid {
            grid-template-columns: minmax(0,1fr) minmax(0,1fr) !important;
        }
    }

    @media (max-width: 700px) {
        .stock-page .metric-grid {
            grid-template-columns: repeat(2,minmax(0,1fr)) !important;
        }

        .stock-page .stock-summary-grid,
        .stock-page .stock-trend-grid {
            grid-template-columns: minmax(0,1fr) !important;
        }

        .stock-page .neu-card {
            padding: 16px !important;
        }

        .stock-page .stock-filter-row {
            align-items: stretch !important;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .stock-page *,
        .stock-page *::before,
        .stock-page *::after {
            scroll-behavior: auto !important;
            transition-duration: .01ms !important;
        }
    }
</style>

<div class="stock-page">
    <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:16px;flex-wrap:wrap;margin-bottom:18px;">
        <div style="min-width:0;">
            <div class="page-breadcrumb">Ruang bisnis / September 2026</div>
            <h1 class="page-title">Stok</h1>
            <p class="page-subtitle" style="margin-bottom:0;">
                Pantau inventori, varian, dan pergerakan stok untuk keputusan restock yang lebih akurat.
            </p>
        </div>

        <div style="display:inline-flex;align-items:center;gap:9px;flex:0 0 auto;padding:9px 15px;border:1px solid rgba(245,239,225,.045);border-radius:999px;background:#2b2b29;box-shadow:-2px -2px 6px rgba(255,245,220,.035),4px 5px 10px rgba(0,0,0,.25);color:#d3cfc6;font-size:11px;">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#d4b47b" stroke-width="1.8" aria-hidden="true">
                <rect x="3" y="4" width="18" height="17" rx="2"/>
                <path d="M16 2v4M8 2v4M3 10h18"/>
            </svg>
            <span>September 2026</span>
        </div>
    </div>

    {{-- Ringkasan inventori --}}
    <section class="metric-grid" style="display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:12px;margin-bottom:16px;" aria-label="Ringkasan stok">
        <article class="metric-card">
            <span style="position:absolute;width:1px;height:1px;padding:0;margin:-1px;overflow:hidden;clip:rect(0,0,0,0);white-space:nowrap;border:0;">Total produk</span>
            <div class="metric-value">124</div>
            <div class="metric-sub">6 kategori fashion</div>
        </article>

        <article class="metric-card">
            <span style="position:absolute;width:1px;height:1px;padding:0;margin:-1px;overflow:hidden;clip:rect(0,0,0,0);white-space:nowrap;border:0;">Varian aktif</span>
            <div class="metric-value">368</div>
            <div class="metric-sub">Ukuran &amp; warna</div>
        </article>

        <article class="metric-card">
            <span style="position:absolute;width:1px;height:1px;padding:0;margin:-1px;overflow:hidden;clip:rect(0,0,0,0);white-space:nowrap;border:0;">Stok tersedia</span>
            <div class="metric-value" style="font-size:clamp(20px,2.2vw,27px);">1.284 pcs</div>
            <div class="metric-sub">108 produk stok aman</div>
        </article>

        <article class="metric-card">
            <span style="position:absolute;width:1px;height:1px;padding:0;margin:-1px;overflow:hidden;clip:rect(0,0,0,0);white-space:nowrap;border:0;">Perlu perhatian</span>
            <div class="metric-value" style="color:#d4a27f;">16</div>
            <div class="metric-sub">12 menipis • 4 habis</div>
        </article>
    </section>

    {{-- Ringkasan inventori dan peringatan --}}
    <section class="stock-summary-grid" style="display:grid;grid-template-columns:minmax(0,1fr) minmax(0,1fr);gap:16px;margin-bottom:16px;align-items:stretch;">
        <article class="neu-card" style="padding:20px;">
            <div style="margin-bottom:17px;">
                <h2 class="section-title">Ringkasan Inventori</h2>
                <p class="section-subtitle">124 produk • 368 varian • 1.284 pcs total</p>
            </div>

            <div style="display:flex;flex-direction:column;gap:14px;">
                <div style="display:flex;justify-content:space-between;gap:12px;font-size:11px;">
                    <span style="color:#aaa69d;">Stok aman</span>
                    <span style="color:#eeeae1;font-weight:500;">108 produk</span>
                </div>
                <div style="display:flex;justify-content:space-between;gap:12px;font-size:11px;">
                    <span style="color:#aaa69d;">Hampir habis</span>
                    <span style="color:#d4b47b;font-weight:500;">12 produk</span>
                </div>
                <div style="display:flex;justify-content:space-between;gap:12px;font-size:11px;">
                    <span style="color:#aaa69d;">Stok habis</span>
                    <span style="color:#c88e7c;font-weight:500;">4 produk</span>
                </div>

                <div style="height:1px;margin:2px 0;background:rgba(245,239,225,.055);"></div>

                <div style="display:flex;justify-content:space-between;gap:12px;font-size:11px;">
                    <span style="color:#aaa69d;">Stok masuk hari ini</span>
                    <span style="color:#d4b47b;font-weight:500;">18 pcs</span>
                </div>
                <div style="display:flex;justify-content:space-between;gap:12px;font-size:11px;">
                    <span style="color:#aaa69d;">Stok keluar hari ini</span>
                    <span style="color:#eeeae1;font-weight:500;">34 pcs</span>
                </div>
            </div>
        </article>

        <article class="neu-card" style="padding:20px;">
            <div style="margin-bottom:17px;">
                <h2 class="section-title">Peringatan Stok</h2>
                <p class="section-subtitle">12 varian membutuhkan perhatian segera</p>
            </div>

            <div style="display:flex;flex-direction:column;gap:13px;margin-bottom:17px;">
                @foreach($peringatanStok as $peringatan)
                    <div style="display:flex;align-items:center;justify-content:space-between;gap:12px;font-size:10px;">
                        <span style="min-width:0;color:#c7c2b8;">
                            {{ $peringatan['produk'] }} • {{ $peringatan['varian'] }}
                        </span>
                        <span style="flex:0 0 auto;color:#d4b47b;font-weight:500;">{{ $peringatan['stok'] }} pcs</span>
                    </div>
                @endforeach
            </div>

            <a href="{{ route('rekomendasi-restock') }}" class="btn-ghost">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#d4b47b" stroke-width="1.8" aria-hidden="true">
                    <circle cx="12" cy="12" r="10"/>
                    <path d="M12 8v4M12 16h.01"/>
                </svg>
                Lihat rekomendasi restock
            </a>
        </article>
    </section>

    {{-- Tren stok dan pergerakan --}}
    <section class="stock-trend-grid" style="display:grid;grid-template-columns:minmax(0,1fr) minmax(0,1fr);gap:16px;margin-bottom:16px;align-items:stretch;">
        <article class="neu-card" style="padding:20px;">
            <div style="margin-bottom:16px;">
                <h2 class="section-title">Tren Stok Terakhir</h2>
                <p class="section-subtitle">Pergerakan stok 7 hari terakhir</p>
            </div>

            <div class="trend-chart-well">
                <canvas id="stokChart" role="img" aria-label="Grafik pergerakan stok tujuh hari terakhir">
                    Tren stok tujuh hari terakhir.
                </canvas>
            </div>

            <div style="display:flex;justify-content:space-between;gap:8px;margin-top:10px;padding:0 3px;color:#aaa69d;font-size:9px;">
                <span>24 Sep</span>
                <span>26 Sep</span>
                <span>28 Sep</span>
                <span>30 Sep</span>
            </div>
        </article>

        <article class="neu-card" style="padding:20px;">
            <div style="margin-bottom:17px;">
                <h2 class="section-title">Pergerakan Stok</h2>
                <p class="section-subtitle">Masuk, keluar, dan selisih stok terakhir</p>
            </div>

            <div style="display:flex;flex-direction:column;gap:14px;">
                <div style="display:flex;justify-content:space-between;gap:12px;font-size:11px;">
                    <span style="color:#aaa69d;">Stok masuk</span>
                    <span style="color:#d4b47b;font-weight:500;">18 pcs</span>
                </div>
                <div style="display:flex;justify-content:space-between;gap:12px;font-size:11px;">
                    <span style="color:#aaa69d;">Stok keluar</span>
                    <span style="color:#eeeae1;font-weight:500;">34 pcs</span>
                </div>
                <div style="display:flex;justify-content:space-between;gap:12px;font-size:11px;">
                    <span style="color:#aaa69d;">Selisih stok</span>
                    <span style="color:#d4a27f;font-weight:500;">-16 pcs</span>
                </div>

                <div style="height:1px;margin:2px 0;background:rgba(245,239,225,.055);"></div>

                <div style="display:flex;justify-content:space-between;gap:12px;font-size:10px;">
                    <span style="color:#aaa69d;">Stok masuk terakhir</span>
                    <span style="color:#eeeae1;text-align:right;">30 Sep • 09.40 WIB</span>
                </div>
                <div style="display:flex;justify-content:space-between;gap:12px;font-size:10px;">
                    <span style="color:#aaa69d;">Stok keluar terakhir</span>
                    <span style="color:#eeeae1;text-align:right;">30 Sep • 16.15 WIB</span>
                </div>
            </div>
        </article>
    </section>

    {{-- Pencarian dan filter --}}
    <div class="stock-filter-row" style="display:flex;align-items:center;gap:11px;flex-wrap:wrap;margin-bottom:14px;">
        <label style="position:relative;display:block;flex:1 1 280px;min-width:min(100%,220px);">
            <svg style="position:absolute;top:50%;left:14px;transform:translateY(-50%);color:#d4b47b;pointer-events:none;" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                <circle cx="11" cy="11" r="8"/>
                <path d="m21 21-4.35-4.35"/>
            </svg>
            <input
                id="stockSearch"
                type="search"
                class="neu-input"
                placeholder="Cari produk, kode, atau varian..."
                aria-label="Cari produk, kode, atau varian stok"
                autocomplete="off"
                style="padding-left:40px;border-radius:999px;"
            >
        </label>

        <div id="stockFilters" style="display:flex;align-items:center;gap:7px;max-width:100%;overflow-x:auto;padding:3px 2px 7px;" role="group" aria-label="Filter kategori produk">
            <button type="button" class="filter-tab active" data-stock-filter="semua" aria-pressed="true">Semua produk</button>
            <button type="button" class="filter-tab" data-stock-filter="Atasan" aria-pressed="false">Atasan</button>
            <button type="button" class="filter-tab" data-stock-filter="Bawahan" aria-pressed="false">Bawahan</button>
            <button type="button" class="filter-tab" data-stock-filter="Outer" aria-pressed="false">Outer</button>
            <button type="button" class="filter-tab" data-stock-filter="Aksesori" aria-pressed="false">Aksesori</button>
        </div>
    </div>

    {{-- Tabel stok --}}
    <section class="neu-card" style="padding:20px;" aria-labelledby="stockTableTitle">
        <div class="section-header">
            <div>
                <h2 class="section-title" id="stockTableTitle">Tabel Stok Produk &amp; Varian</h2>
                <p class="section-subtitle">
                    <span id="stockRowCount">4</span> dari 124 produk • 368 varian • urutkan: stok terendah
                </p>
            </div>
            <a href="{{ route('produk') }}" class="section-link">Kelola varian →</a>
        </div>

        <div style="max-width:100%;overflow-x:auto;margin-top:7px;">
            <table class="balhana-table" style="min-width:760px;">
                <thead>
                    <tr>
                        <th>Produk / varian</th>
                        <th>Stok</th>
                        <th>Masuk</th>
                        <th>Keluar</th>
                        <th>Selisih</th>
                        <th>Status</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody id="stockTableBody">
                    @foreach($varianStok as $item)
                        @php
                            $searchValue = strtolower($item['produk'].' '.$item['kategori'].' '.$item['ukuran'].' '.$item['warna'].' '.$item['status']);
                        @endphp

                        <tr
                            data-stock-row
                            data-category="{{ $item['kategori'] }}"
                            data-search="{{ $searchValue }}"
                        >
                            <td style="color:#eeeae1;font-weight:500;">
                                {{ $item['produk'] }} • {{ $item['ukuran'] }} • {{ $item['warna'] }}
                            </td>
                            <td style="color:#d4b47b;font-weight:500;">{{ $item['stok'] }} pcs</td>
                            <td>{{ $item['masuk'] }}</td>
                            <td>{{ $item['keluar'] }}</td>
                            <td style="color:#d4a27f;">{{ $item['selisih'] }}</td>
                            <td><span class="{{ $item['statusClass'] }}">{{ $item['status'] }}</span></td>
                            <td>
                                <a
                                    href="{{ route('produk') }}"
                                    class="btn-ghost"
                                    style="min-height:30px;padding:6px 11px;font-size:9px;"
                                    aria-label="Lihat produk {{ $item['produk'] }}"
                                >
                                    Lihat
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div id="stockEmptyState" hidden style="padding:26px 12px;text-align:center;color:#aaa69d;font-size:11px;">
            Tidak ada varian yang cocok dengan pencarian atau kategori ini.
        </div>

        <div style="margin-top:12px;padding-top:11px;border-top:1px solid rgba(245,239,225,.05);color:#aaa69d;font-size:9px;">
            Menampilkan varian prioritas • diperbarui 30 Sep 2026
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('stockSearch');
    const filterGroup = document.getElementById('stockFilters');
    const rows = Array.from(document.querySelectorAll('[data-stock-row]'));
    const rowCount = document.getElementById('stockRowCount');
    const emptyState = document.getElementById('stockEmptyState');
    let activeCategory = 'semua';

    function filterStockRows() {
        const query = (searchInput.value || '').trim().toLocaleLowerCase('id-ID');
        let visibleCount = 0;

        rows.forEach(function (row) {
            const matchesCategory =
                activeCategory === 'semua' || row.dataset.category === activeCategory;
            const matchesSearch =
                !query || (row.dataset.search || '').toLocaleLowerCase('id-ID').includes(query);
            const visible = matchesCategory && matchesSearch;

            row.hidden = !visible;

            if (visible) {
                visibleCount += 1;
            }
        });

        rowCount.textContent = String(visibleCount);
        emptyState.hidden = visibleCount !== 0;
    }

    searchInput.addEventListener('input', filterStockRows);

    filterGroup.addEventListener('click', function (event) {
        const button = event.target.closest('[data-stock-filter]');

        if (!button) {
            return;
        }

        activeCategory = button.dataset.stockFilter || 'semua';

        filterGroup.querySelectorAll('[data-stock-filter]').forEach(function (filterButton) {
            const isActive = filterButton === button;
            filterButton.classList.toggle('active', isActive);
            filterButton.setAttribute('aria-pressed', isActive ? 'true' : 'false');
        });

        filterStockRows();
    });

    const canvas = document.getElementById('stokChart');

    if (canvas && typeof Chart !== 'undefined') {
        const values = [120, 130, 110, 140, 160, 150, 170, 180, 160, 190, 180, 170, 180, 190, 160, 180];

        new Chart(canvas, {
            type: 'line',
            data: {
                labels: Array.from({ length: values.length }, function (_, index) {
                    return String(index + 1);
                }),
                datasets: [{
                    data: values,
                    borderColor: '#d4b47b',
                    borderWidth: 2,
                    fill: true,
                    backgroundColor: function (context) {
                        const chart = context.chart;
                        const area = chart.chartArea;

                        if (!area) {
                            return 'rgba(212, 180, 123, 0.12)';
                        }

                        const gradient = chart.ctx.createLinearGradient(0, area.top, 0, area.bottom);
                        gradient.addColorStop(0, 'rgba(212, 180, 123, 0.22)');
                        gradient.addColorStop(1, 'rgba(212, 180, 123, 0.01)');
                        return gradient;
                    },
                    tension: 0.42,
                    pointRadius: 0,
                    pointHoverRadius: 4,
                    pointHoverBackgroundColor: '#e1c692'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    intersect: false,
                    mode: 'index'
                },
                plugins: {
                    legend: { display: false },
                    tooltip: { enabled: false }
                },
                scales: {
                    x: {
                        display: false,
                        grid: { display: false }
                    },
                    y: {
                        display: false,
                        grid: { display: false }
                    }
                }
            }
        });
    }
});
</script>
@endpush