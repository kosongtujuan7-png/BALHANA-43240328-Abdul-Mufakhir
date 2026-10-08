@extends('layouts.app')

@section('title', 'Analisis Minat – BALHANA')

@section('content')
@php
    $ringkasan = [
        ['label' => 'Total minat', 'nilai' => '428', 'catatan' => '+24,8% bulan ini', 'ikon' => 'heart'],
        ['label' => 'Produk diminati', 'nilai' => '38', 'catatan' => 'Dari 124 produk', 'ikon' => 'product'],
        ['label' => 'Ukuran favorit', 'nilai' => 'L', 'catatan' => '46% dari total minat', 'ikon' => 'size'],
        ['label' => 'Warna favorit', 'nilai' => 'Hitam', 'catatan' => '38% dari total minat', 'ikon' => 'color'],
    ];

    $trenMingguan = [
        ['periode' => '01–07 Sep', 'jumlah' => 82, 'lebar' => 58],
        ['periode' => '08–14 Sep', 'jumlah' => 94, 'lebar' => 66],
        ['periode' => '15–21 Sep', 'jumlah' => 110, 'lebar' => 77],
        ['periode' => '22–30 Sep', 'jumlah' => 142, 'lebar' => 100],
    ];

    $sumberMinat = [
        ['nama' => 'Facebook', 'jumlah' => 205, 'persen' => 48, 'warna' => '#d4b47b'],
        ['nama' => 'WhatsApp', 'jumlah' => 150, 'persen' => 35, 'warna' => '#aaa99e'],
        ['nama' => 'Grup jual-beli', 'jumlah' => 73, 'persen' => 17, 'warna' => '#72736d'],
    ];

    $produkDiminati = [
        ['nama' => 'Kemeja Linen', 'kategori' => 'Atasan', 'minat' => 128, 'terjual' => 48, 'konversi' => '37,5%', 'tren' => '32%'],
        ['nama' => 'Tunik Aira', 'kategori' => 'Atasan', 'minat' => 96, 'terjual' => 36, 'konversi' => '37,5%', 'tren' => '18%'],
        ['nama' => 'Celana Kulot', 'kategori' => 'Bawahan', 'minat' => 84, 'terjual' => 32, 'konversi' => '38,1%', 'tren' => '12%'],
        ['nama' => 'Outer Knit', 'kategori' => 'Outer', 'minat' => 72, 'terjual' => 24, 'konversi' => '33,3%', 'tren' => '28%'],
        ['nama' => 'Produk lainnya', 'kategori' => 'Lainnya', 'minat' => 48, 'terjual' => 16, 'konversi' => '33,3%', 'tren' => '8%'],
    ];

    $favorit = [
        'Ukuran Favorit' => [
            ['nama' => 'L', 'jumlah' => 197, 'persen' => 46],
            ['nama' => 'M', 'jumlah' => 128, 'persen' => 30],
            ['nama' => 'XL', 'jumlah' => 73, 'persen' => 17],
            ['nama' => 'All size', 'jumlah' => 30, 'persen' => 7],
        ],
        'Warna Favorit' => [
            ['nama' => 'Hitam', 'jumlah' => 163, 'persen' => 38],
            ['nama' => 'Cream', 'jumlah' => 120, 'persen' => 28],
            ['nama' => 'Mocca', 'jumlah' => 86, 'persen' => 20],
            ['nama' => 'Olive & lainnya', 'jumlah' => 59, 'persen' => 14],
        ],
        'Bahan Favorit' => [
            ['nama' => 'Linen', 'jumlah' => 150, 'persen' => 35],
            ['nama' => 'Katun rayon', 'jumlah' => 128, 'persen' => 30],
            ['nama' => 'Satin twill', 'jumlah' => 86, 'persen' => 20],
            ['nama' => 'Rajut', 'jumlah' => 64, 'persen' => 15],
        ],
    ];
@endphp

<style>
    .analysis-page {
        --analysis-gold: #d4b47b;
        --analysis-text: #eeeae1;
        --analysis-muted: #aaa69d;
        color: var(--analysis-text);
    }

    .analysis-page *,
    .analysis-page *::before,
    .analysis-page *::after {
        box-sizing: border-box;
    }

    /* Raised cards with a soft top-left highlight and deep lower-right shadow. */
    .analysis-page .neu-card,
    .analysis-page .metric-card {
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

    .analysis-page .metric-card {
        position: relative;
        min-width: 0;
        overflow: hidden;
        border-radius: 22px;
        transition: transform .18s ease, box-shadow .18s ease;
    }

    .analysis-page .metric-card:hover {
        transform: translateY(-2px);
        box-shadow:
            15px 16px 28px rgba(0,0,0,.34),
            5px 6px 12px rgba(0,0,0,.22),
            -8px -8px 19px rgba(255,246,226,.045),
            inset 1px 1px 0 rgba(255,255,255,.03);
    }

    .analysis-page .neu-card {
        min-width: 0;
        border-radius: 22px;
    }

    /* Search and select controls are inset into the dark surface. */
    .analysis-page .neu-input {
        width: 100%;
        min-width: 0;
        min-height: 40px;
        padding: 9px 13px;
        border: 1px solid rgba(255,255,255,.025);
        border-radius: 12px;
        outline: none;
        background:
            linear-gradient(145deg, rgba(0,0,0,.12), transparent 65%),
            #242523;
        color: var(--analysis-text);
        box-shadow:
            inset 5px 5px 10px rgba(0,0,0,.48),
            inset -3px -3px 8px rgba(255,246,226,.035),
            1px 1px 0 rgba(255,255,255,.018);
        font: inherit;
        font-size: 11px;
        transition: border-color .18s ease, box-shadow .18s ease;
    }

    .analysis-page .neu-input:focus {
        border-color: rgba(215,183,126,.48);
        box-shadow:
            inset 5px 5px 10px rgba(0,0,0,.48),
            inset -3px -3px 8px rgba(255,246,226,.035),
            0 0 0 2px rgba(215,183,126,.09);
    }

    .analysis-page input[type="search"],
    .analysis-page select {
        color-scheme: dark;
    }

    .analysis-page .alert-box {
        border: 1px solid rgba(239,231,215,.035);
        border-radius: 15px;
        background: linear-gradient(145deg, #30312f, #292a28);
        box-shadow:
            inset 4px 4px 9px rgba(0,0,0,.30),
            inset -3px -3px 8px rgba(255,246,226,.035),
            2px 3px 8px rgba(0,0,0,.17);
    }

    .analysis-page .chart-legend-dot {
        width: 8px;
        height: 8px;
        flex: 0 0 8px;
        border-radius: 50%;
        box-shadow:
            1px 1px 3px rgba(0,0,0,.35),
            -1px -1px 2px rgba(255,255,255,.10);
    }

    .analysis-page .balhana-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 8px;
    }

    .analysis-page .balhana-table thead tr {
        overflow: hidden;
        border-radius: 10px;
        background: #242523;
        box-shadow:
            inset 4px 4px 8px rgba(0,0,0,.45),
            inset -2px -2px 6px rgba(255,246,226,.025);
    }

    .analysis-page .balhana-table th {
        padding: 11px 14px;
        color: #aaa69d;
        font-size: 9px;
        font-weight: 500;
        text-align: left;
        white-space: nowrap;
    }

    .analysis-page .balhana-table th:first-child {
        border-radius: 10px 0 0 10px;
    }

    .analysis-page .balhana-table th:last-child {
        border-radius: 0 10px 10px 0;
    }

    .analysis-page .balhana-table tbody tr {
        background: linear-gradient(145deg, #30312f, #292a28);
        box-shadow:
            4px 5px 9px rgba(0,0,0,.23),
            -2px -2px 6px rgba(255,246,226,.025),
            inset 1px 1px 0 rgba(255,255,255,.018);
    }

    .analysis-page .balhana-table td {
        padding: 12px 14px;
        border-top: 1px solid rgba(255,255,255,.018);
        border-bottom: 1px solid rgba(0,0,0,.08);
        font-size: 10px;
        vertical-align: middle;
        overflow-wrap: anywhere;
    }

    .analysis-page .balhana-table td:first-child {
        border-radius: 11px 0 0 11px;
    }

    .analysis-page .balhana-table td:last-child {
        border-radius: 0 11px 11px 0;
    }

    .analysis-page .btn-golden {
        min-height: 38px;
        border: 1px solid rgba(255,239,203,.3);
        background: linear-gradient(145deg, #e7c98f, #d5b276);
        color: #29251d;
        box-shadow:
            5px 6px 12px rgba(0,0,0,.28),
            -3px -3px 8px rgba(255,246,226,.09),
            inset 1px 1px 0 rgba(255,255,255,.30),
            inset -1px -1px 0 rgba(116,82,34,.12);
        transition: transform .15s ease, box-shadow .15s ease, filter .15s ease;
    }

    .analysis-page .btn-golden:hover {
        filter: brightness(1.025);
        transform: translateY(-1px);
        box-shadow:
            7px 8px 14px rgba(0,0,0,.30),
            -3px -3px 9px rgba(255,246,226,.10),
            inset 1px 1px 0 rgba(255,255,255,.34);
    }

    .analysis-page .btn-golden:active {
        transform: translateY(1px);
        box-shadow:
            inset 4px 4px 8px rgba(111,78,32,.25),
            inset -2px -2px 5px rgba(255,255,255,.17);
    }

    .analysis-page .btn-ghost {
        min-height: 36px;
        border: 1px solid rgba(255,255,255,.025);
        border-radius: 999px;
        background: linear-gradient(145deg, #333431, #292a28);
        color: var(--analysis-text);
        box-shadow:
            5px 6px 11px rgba(0,0,0,.27),
            -3px -3px 8px rgba(255,246,226,.04),
            inset 1px 1px 0 rgba(255,255,255,.025);
        transition: transform .15s ease, box-shadow .15s ease, color .15s ease;
    }

    .analysis-page .btn-ghost:hover {
        color: var(--analysis-gold);
        transform: translateY(-1px);
    }

    .analysis-page .btn-ghost:active {
        transform: translateY(1px);
        box-shadow:
            inset 4px 4px 8px rgba(0,0,0,.36),
            inset -2px -2px 6px rgba(255,246,226,.025);
    }

    .analysis-page .btn-golden:focus-visible,
    .analysis-page .btn-ghost:focus-visible {
        outline: 2px solid rgba(215,183,126,.75);
        outline-offset: 3px;
    }

    .analysis-page [data-analysis-product][hidden] {
        display: none !important;
    }

    /* Recessed horizontal tracks with a raised gold progress surface. */
    .analysis-page .progress-track {
        height: 8px;
        overflow: hidden;
        border-radius: 999px;
        background: #242422;
        box-shadow:
            inset 2px 2px 5px rgba(0,0,0,.38),
            inset -1px -1px 3px rgba(255,245,220,.02);
    }

    .analysis-page .progress-fill {
        height: 100%;
        border-radius: 999px;
        background: linear-gradient(90deg,#b99a65,#e0c38b);
        box-shadow: 0 0 8px rgba(212,180,123,.15);
    }

    /* Match the tactile sidebar used across BALHANA pages. */
    body:has(.analysis-page) .sidebar {
        background:
            linear-gradient(145deg, rgba(255,255,255,.018), transparent 35%),
            #292a28;
        box-shadow:
            12px 12px 24px rgba(0,0,0,.34),
            -7px -7px 18px rgba(255,246,226,.035),
            inset 1px 1px 0 rgba(255,255,255,.025);
    }

    body:has(.analysis-page) .sidebar-item {
        border: 1px solid rgba(255,255,255,.018);
        box-shadow:
            5px 6px 11px rgba(0,0,0,.25),
            -3px -3px 8px rgba(255,246,226,.035),
            inset 1px 1px 0 rgba(255,255,255,.02);
        transition: box-shadow .16s ease, color .16s ease, transform .16s ease;
    }

    body:has(.analysis-page) .sidebar-item:hover {
        transform: translateY(-1px);
        box-shadow:
            7px 8px 13px rgba(0,0,0,.28),
            -4px -4px 9px rgba(255,246,226,.04),
            inset 1px 1px 0 rgba(255,255,255,.025);
    }

    body:has(.analysis-page) .sidebar-item.active {
        color: #d7b77e;
        box-shadow:
            inset 4px 4px 8px rgba(0,0,0,.36),
            inset -2px -2px 6px rgba(255,246,226,.025),
            1px 1px 0 rgba(255,255,255,.018);
    }

    body:has(.analysis-page) .search-bar {
        background: #242523;
        box-shadow:
            inset 5px 5px 10px rgba(0,0,0,.46),
            inset -3px -3px 8px rgba(255,246,226,.035);
    }

    @media (max-width: 1000px) {
        .analysis-page .analysis-top-grid {
            grid-template-columns: minmax(0,1fr) !important;
        }

        .analysis-page .favorite-grid {
            grid-template-columns: repeat(2,minmax(0,1fr)) !important;
        }
    }

    @media (max-width: 700px) {
        .analysis-page .metric-grid {
            grid-template-columns: repeat(2,minmax(0,1fr)) !important;
        }

        .analysis-page .favorite-grid {
            grid-template-columns: minmax(0,1fr) !important;
        }

        .analysis-page .neu-card {
            padding: 16px !important;
        }

        .analysis-page .search-filter-row {
            align-items: stretch !important;
        }

        .analysis-page .analysis-filters {
            width: 100%;
        }

        .analysis-page .analysis-filters select {
            flex: 1 1 120px;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .analysis-page *,
        .analysis-page *::before,
        .analysis-page *::after {
            scroll-behavior: auto !important;
            transition-duration: .01ms !important;
        }
    }
</style>

<div class="analysis-page">
    <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:16px;flex-wrap:wrap;margin-bottom:18px;">
        <div style="min-width:0;">
            <div class="page-breadcrumb">Ruang bisnis / September 2026</div>
            <h1 class="page-title">Analisis Minat</h1>
            <p class="page-subtitle" style="margin-bottom:0;">
                Kenali produk dan varian yang dicari sebelum mengambil keputusan.
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

    {{-- Ringkasan analisis --}}
    <section class="metric-grid" style="display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:12px;margin-bottom:16px;" aria-label="Ringkasan analisis minat">
        @foreach($ringkasan as $item)
            <article class="metric-card">
                <div class="metric-label">{{ $item['label'] }}</div>
                <div class="metric-value" style="font-size:{{ $item['ikon'] === 'color' ? 'clamp(19px,2vw,25px)' : 'clamp(22px,2.3vw,29px)' }};">
                    {{ $item['nilai'] }}
                </div>
                <div class="metric-sub" style="color:{{ $item['ikon'] === 'heart' || $item['ikon'] === 'size' || $item['ikon'] === 'color' ? '#d4b47b' : '#aaa69d' }};">
                    {{ $item['catatan'] }}
                </div>
                <div class="metric-icon">
                    @if($item['ikon'] === 'heart')
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.7l-1.1-1.1a5.5 5.5 0 0 0-7.8 7.8l1.1 1.1 7.8 7.7 7.8-7.7 1-1.1a5.5 5.5 0 0 0 0-7.8z"/>
                        </svg>
                    @elseif($item['ikon'] === 'product')
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path d="M20 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                            <path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/>
                        </svg>
                    @elseif($item['ikon'] === 'size')
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path d="m4 16 12-12 4 4L8 20z"/>
                            <path d="m13 7 4 4M10 10l2 2M7 13l2 2"/>
                        </svg>
                    @else
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path d="M12 2a10 10 0 1 0 0 20h1.2a2.8 2.8 0 0 0 1.9-4.8 1.7 1.7 0 0 1 1.2-2.9h1.2a4.5 4.5 0 0 0 4.5-4.5C22 5.5 17.5 2 12 2z"/>
                            <circle cx="7.5" cy="11.5" r=".8"/>
                            <circle cx="9" cy="7.5" r=".8"/>
                            <circle cx="14" cy="6.5" r=".8"/>
                            <circle cx="17" cy="10" r=".8"/>
                        </svg>
                    @endif
                </div>
            </article>
        @endforeach
    </section>

    {{-- Pencarian dan filter --}}
    <div class="search-filter-row" style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;margin-bottom:16px;">
        <label style="position:relative;display:block;flex:1 1 280px;min-width:min(100%,220px);">
            <svg style="position:absolute;top:50%;left:14px;transform:translateY(-50%);color:#d4b47b;pointer-events:none;" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                <circle cx="11" cy="11" r="8"/>
                <path d="m21 21-4.35-4.35"/>
            </svg>
            <input
                id="interestAnalysisSearch"
                type="search"
                class="neu-input"
                placeholder="Cari analisis produk..."
                aria-label="Cari analisis produk"
                autocomplete="off"
                style="padding-left:40px;border-radius:999px;"
            >
        </label>

        <div class="analysis-filters" style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;">
            <label style="position:absolute;width:1px;height:1px;padding:0;margin:-1px;overflow:hidden;clip:rect(0,0,0,0);white-space:nowrap;border:0;" for="analysisMonth">Periode</label>
            <select id="analysisMonth" class="neu-input" style="width:auto;min-width:130px;border-radius:999px;">
                <option value="2026-09">September</option>
            </select>

            <label style="position:absolute;width:1px;height:1px;padding:0;margin:-1px;overflow:hidden;clip:rect(0,0,0,0);white-space:nowrap;border:0;" for="analysisSource">Sumber minat</label>
            <select id="analysisSource" class="neu-input" style="width:auto;min-width:135px;border-radius:999px;">
                <option value="semua">Semua sumber</option>
                <option value="Facebook">Facebook</option>
                <option value="WhatsApp">WhatsApp</option>
                <option value="Grup jual-beli">Grup jual-beli</option>
            </select>

            <label style="position:absolute;width:1px;height:1px;padding:0;margin:-1px;overflow:hidden;clip:rect(0,0,0,0);white-space:nowrap;border:0;" for="analysisCategory">Kategori produk</label>
            <select id="analysisCategory" class="neu-input" style="width:auto;min-width:145px;border-radius:999px;">
                <option value="semua">Semua kategori</option>
                <option value="Atasan">Atasan</option>
                <option value="Bawahan">Bawahan</option>
                <option value="Outer">Outer</option>
                <option value="Lainnya">Lainnya</option>
            </select>
        </div>
    </div>

    {{-- Tren mingguan dan sumber minat --}}
    <section class="analysis-top-grid" style="display:grid;grid-template-columns:minmax(0,1.15fr) minmax(0,.95fr);gap:16px;margin-bottom:16px;align-items:start;">
        <article class="neu-card" style="padding:20px;">
            <div style="margin-bottom:18px;">
                <h2 class="section-title">Tren Minat Mingguan</h2>
                <p class="section-subtitle">September • seluruh sumber • jumlah peminat</p>
            </div>

            <div style="display:flex;flex-direction:column;gap:16px;margin-bottom:19px;">
                @foreach($trenMingguan as $minggu)
                    <div>
                        <div style="display:flex;justify-content:space-between;align-items:center;gap:12px;margin-bottom:7px;font-size:10px;">
                            <span style="color:#aaa69d;">{{ $minggu['periode'] }}</span>
                            <span style="color:#eeeae1;font-weight:500;white-space:nowrap;">{{ $minggu['jumlah'] }} peminat</span>
                        </div>
                        <div class="progress-track">
                            <div class="progress-fill" style="width:{{ $minggu['lebar'] }}%;"></div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="alert-box" style="padding:14px;">
                <div style="display:flex;align-items:center;gap:8px;margin-bottom:5px;color:#dfbf83;font-size:11px;font-weight:600;">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path d="M3 3v18h18"/>
                        <path d="m7 14 4-4 4 3 6-7"/>
                    </svg>
                    Minat tumbuh 32% pekan terakhir
                </div>
                <p style="margin:0;color:#aaa69d;font-size:10px;line-height:1.55;">
                    Kemeja Linen dan Outer Knit paling banyak ditanyakan. Minat merupakan sinyal, bukan jaminan pembelian.
                </p>
            </div>
        </article>

        <article class="neu-card" style="padding:20px;">
            <div style="margin-bottom:16px;">
                <h2 class="section-title">Sumber Minat</h2>
                <p class="section-subtitle">Komposisi berdasarkan input riset pasar</p>
            </div>

            <div style="display:flex;align-items:center;gap:22px;min-height:164px;margin-bottom:15px;">
                <div style="position:relative;width:126px;height:126px;flex:0 0 126px;">
                    <canvas id="donutChartMinat" width="126" height="126" role="img" aria-label="Sumber minat pelanggan">
                        Facebook 48%, WhatsApp 35%, grup jual-beli 17%.
                    </canvas>
                    <div style="position:absolute;inset:0;display:flex;flex-direction:column;align-items:center;justify-content:center;pointer-events:none;">
                        <div style="color:#eeeae1;font-size:23px;font-weight:500;line-height:1;">428</div>
                        <div style="margin-top:5px;color:#aaa69d;font-size:9px;">Total minat</div>
                    </div>
                </div>

                <div style="display:flex;flex-direction:column;gap:12px;min-width:0;">
                    @foreach($sumberMinat as $sumber)
                        <div style="display:flex;align-items:center;gap:8px;color:#d3cfc6;font-size:10px;">
                            <span class="chart-legend-dot" style="background:{{ $sumber['warna'] }};"></span>
                            <span>{{ $sumber['nama'] }} <span style="color:#aaa69d;">{{ $sumber['persen'] }}%</span></span>
                        </div>
                    @endforeach
                </div>
            </div>

            <p style="margin:0;padding-top:13px;border-top:1px solid rgba(245,239,225,.055);color:#aaa69d;font-size:10px;line-height:1.6;">
                Facebook paling efektif untuk menemukan calon pelanggan baru. WhatsApp didominasi pertanyaan dari pelanggan lama.
            </p>
        </article>
    </section>

    {{-- Produk paling diminati --}}
    <section class="neu-card" style="padding:20px;margin-bottom:16px;">
        <div class="section-header">
            <div>
                <h2 class="section-title">Produk Paling Diminati</h2>
                <p class="section-subtitle">Perbandingan minat, penjualan, dan tren produk</p>
            </div>
            <a href="{{ route('riset-pasar') }}" class="section-link">Lihat riset →</a>
        </div>

        <div style="max-width:100%;overflow-x:auto;">
            <table class="balhana-table" style="min-width:640px;">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Minat</th>
                        <th>Terjual</th>
                        <th>Konversi indikatif</th>
                        <th>Tren</th>
                    </tr>
                </thead>
                <tbody id="analysisProductRows">
                    @foreach($produkDiminati as $produk)
                        <tr
                            data-analysis-product
                            data-category="{{ $produk['kategori'] }}"
                            data-search="{{ strtolower($produk['nama'].' '.$produk['kategori']) }}"
                        >
                            <td style="color:#eeeae1;font-weight:500;">{{ $produk['nama'] }}</td>
                            <td>{{ $produk['minat'] }} orang</td>
                            <td>{{ $produk['terjual'] }} pcs</td>
                            <td>{{ $produk['konversi'] }}</td>
                            <td style="color:#d4b47b;">↑ {{ $produk['tren'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div id="analysisEmptyState" hidden style="padding:24px 12px;text-align:center;color:#aaa69d;font-size:11px;">
            Tidak ada produk yang cocok dengan pencarian atau kategori ini.
        </div>

        <div style="display:flex;justify-content:space-between;align-items:flex-start;gap:12px;flex-wrap:wrap;margin-top:11px;padding-top:11px;border-top:1px solid rgba(245,239,225,.05);color:#aaa69d;font-size:9px;line-height:1.5;">
            <span><span id="analysisProductCount">5</span> produk • diperbarui 30 Sep 2026</span>
            <span>Konversi indikatif = unit terjual ÷ jumlah minat. Tidak menautkan identitas pelanggan.</span>
        </div>
    </section>

    {{-- Ukuran, warna, dan bahan favorit --}}
    <section class="favorite-grid" style="display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:16px;margin-bottom:16px;">
        @foreach($favorit as $judul => $daftar)
            <article class="neu-card" style="padding:20px;">
                <h2 class="section-title" style="margin-bottom:17px;">{{ $judul }}</h2>

                <div style="display:flex;flex-direction:column;gap:15px;">
                    @foreach($daftar as $item)
                        <div>
                            <div style="display:flex;justify-content:space-between;align-items:center;gap:10px;margin-bottom:7px;font-size:10px;">
                                <span style="color:#aaa69d;">{{ $item['nama'] }}</span>
                                <span style="color:#d3cfc6;white-space:nowrap;">{{ $item['jumlah'] }} • {{ $item['persen'] }}%</span>
                            </div>
                            <div class="progress-track">
                                <div class="progress-fill" style="width:{{ $item['persen'] }}%;"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </article>
        @endforeach
    </section>

    {{-- Rekomendasi berdasarkan minat --}}
    <article class="neu-card" style="padding:20px;">
        <h2 class="section-title" style="margin-bottom:15px;">Dari Minat ke Keputusan</h2>

        <div style="display:flex;align-items:center;gap:15px;flex-wrap:wrap;">
            <div style="width:68px;height:76px;flex:0 0 68px;overflow:hidden;border:1px solid rgba(245,239,225,.05);border-radius:15px;background:#242422;box-shadow:inset 2px 2px 5px rgba(0,0,0,.3);">
                <img
                    src="https://images.unsplash.com/photo-1602810318383-e386cc2a3ccf?w=180&q=85&fit=crop"
                    alt="Kemeja Linen"
                    loading="lazy"
                    style="width:100%;height:100%;object-fit:cover;"
                >
            </div>

            <div style="flex:1 1 280px;min-width:0;">
                <h3 style="margin:0 0 5px;color:#d4b47b;font-size:12px;font-weight:600;line-height:1.45;">
                    Prioritaskan Kemeja Linen • L • Hitam
                </h3>
                <p style="margin:0;color:#aaa69d;font-size:10px;line-height:1.6;">
                    Minat tertinggi, penjualan stabil, dan hanya 3 pcs untuk varian ini. Pertimbangkan tambahan 20 pcs dari rekomendasi total 40 pcs Kemeja Linen.
                </p>
            </div>

            <a href="{{ route('rekomendasi-restock') }}" class="btn-golden" style="flex:0 0 auto;">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path d="M3 3v18h18"/>
                    <path d="m7 14 4-4 4 3 6-7"/>
                </svg>
                Lihat Restock
            </a>
        </div>
    </article>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const search = document.getElementById('interestAnalysisSearch');
    const source = document.getElementById('analysisSource');
    const category = document.getElementById('analysisCategory');
    const rows = Array.from(document.querySelectorAll('[data-analysis-product]'));
    const emptyState = document.getElementById('analysisEmptyState');
    const count = document.getElementById('analysisProductCount');

    function filterProducts() {
        const query = (search?.value || '').trim().toLocaleLowerCase('id-ID');
        const selectedCategory = category?.value || 'semua';
        let visibleCount = 0;

        rows.forEach(function (row) {
            const matchesSearch =
                !query || (row.dataset.search || '').toLocaleLowerCase('id-ID').includes(query);
            const matchesCategory =
                selectedCategory === 'semua' || row.dataset.category === selectedCategory;

            // Sumber dan periode ditampilkan sebagai konteks filter analisis.
            // Data tabel ini merupakan ringkasan produk bulanan, bukan baris per kanal.
            const visible = matchesSearch && matchesCategory;

            row.hidden = !visible;

            if (visible) {
                visibleCount += 1;
            }
        });

        if (count) {
            count.textContent = String(visibleCount);
        }

        if (emptyState) {
            emptyState.hidden = visibleCount !== 0;
        }
    }

    search?.addEventListener('input', filterProducts);
    category?.addEventListener('change', filterProducts);

    // Filter sumber dan bulan tersedia untuk pemilihan analisis.
    // Karena tabel berisi rekap bulanan gabungan, keduanya tidak menyaring baris produk.
    source?.addEventListener('change', function () {
        source.dataset.selectedSource = source.value;
    });

    const canvas = document.getElementById('donutChartMinat');

    if (canvas && typeof Chart !== 'undefined') {
        new Chart(canvas, {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [48, 35, 17],
                    backgroundColor: ['#d4b47b', '#aaa99e', '#72736d'],
                    borderColor: '#2b2b29',
                    borderWidth: 3,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: false,
                cutout: '72%',
                plugins: {
                    legend: { display: false },
                    tooltip: { enabled: false }
                }
            }
        });
    }
});
</script>
@endpush