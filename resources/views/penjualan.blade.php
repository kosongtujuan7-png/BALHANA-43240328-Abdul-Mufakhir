@extends('layouts.app')

@section('title', 'Penjualan – BALHANA')

@section('content')
@php
    $produkTerlaris = [
        [
            'nama' => 'Kemeja Linen',
            'detail' => '48 pcs terjual • L • Hitam',
            'status' => 'Terlaris',
            'statusClass' => 'badge-yellow',
            'gambar' => 'https://images.unsplash.com/photo-1602810318383-e386cc2a3ccf?w=500&q=85&fit=crop',
        ],
        [
            'nama' => 'Tunik Aira',
            'detail' => '36 pcs terjual • M • Cream',
            'status' => 'Stabil',
            'statusClass' => 'badge-gray',
            'gambar' => 'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?w=500&q=85&fit=crop',
        ],
        [
            'nama' => 'Outer Knit',
            'detail' => '24 pcs terjual • Beige',
            'status' => 'Naik',
            'statusClass' => 'badge-orange',
            'gambar' => 'https://images.unsplash.com/photo-1594633312681-425c7b97ccd1?w=500&q=85&fit=crop',
        ],
    ];

    $transaksi = [
        [
            'tanggal' => '30 Sep',
            'kanal' => 'WhatsApp',
            'produk' => 'Kemeja Linen • L Hitam',
            'status' => 'Selesai',
            'pelanggan' => 'Nadia Aulia',
            'omzet' => 1440000,
        ],
        [
            'tanggal' => '29 Sep',
            'kanal' => 'Facebook',
            'produk' => 'Tunik Aira • M Cream',
            'status' => 'Siap kirim',
            'pelanggan' => 'Ayu Pratiwi',
            'omzet' => 960000,
        ],
        [
            'tanggal' => '29 Sep',
            'kanal' => 'Grup jual-beli',
            'produk' => 'Outer Knit • Beige',
            'status' => 'Diproses',
            'pelanggan' => 'Rina Maulida',
            'omzet' => 1200000,
        ],
        [
            'tanggal' => '28 Sep',
            'kanal' => 'WhatsApp',
            'produk' => 'Celana Kulot • L Mocca',
            'status' => 'Butuh tindak lanjut',
            'pelanggan' => 'Budi Santoso',
            'omzet' => 720000,
        ],
        [
            'tanggal' => '28 Sep',
            'kanal' => 'Facebook',
            'produk' => 'Kemeja Linen • XL Cream',
            'status' => 'Selesai',
            'pelanggan' => 'Lestari Putri',
            'omzet' => 1320000,
        ],
    ];
@endphp

<style>
    .sales-page {
        --sales-surface: #2d2e2c;
        --sales-surface-raised: #30312f;
        --sales-surface-inset: #252624;
        --sales-text: #eeeae1;
        --sales-muted: #aaa69d;
        --sales-gold: #d4b47b;
        color: var(--sales-text);
        min-width: 0;
    }

    .sales-page,
    .sales-page * {
        box-sizing: border-box;
    }

    .sales-page .page-breadcrumb {
        color: var(--sales-gold);
        font-size: 9px;
        letter-spacing: .045em;
        text-transform: uppercase;
    }

    .sales-page .page-title {
        margin: 7px 0 3px;
        color: var(--sales-text);
        font-size: clamp(28px, 3vw, 34px);
        line-height: 1.15;
        letter-spacing: -.035em;
    }

    .sales-page .page-subtitle {
        color: var(--sales-muted);
        font-size: 12px;
        line-height: 1.5;
    }

    .sales-page .sales-period {
        border: 1px solid rgba(255, 246, 225, .035) !important;
        background: linear-gradient(145deg, #30312f, #2a2b29) !important;
        box-shadow:
            7px 7px 15px rgba(12, 13, 12, .38),
            -5px -5px 13px rgba(255, 246, 225, .055),
            inset 1px 1px 1px rgba(255, 255, 255, .025) !important;
    }

    .sales-page .sales-metrics {
        display: grid !important;
        grid-template-columns: repeat(4, minmax(0, 1fr)) !important;
        gap: 12px !important;
        margin-bottom: 16px !important;
    }

    .sales-page .metric-card,
    .sales-page .neu-card {
        min-width: 0;
        border: 1px solid rgba(255, 246, 225, .025);
        border-radius: 23px;
        background: linear-gradient(145deg, #30312f, #2b2c2a);
        box-shadow:
            10px 10px 22px rgba(12, 13, 12, .46),
            -7px -7px 18px rgba(255, 246, 225, .055),
            inset 1px 1px 1px rgba(255, 255, 255, .018);
    }

    .sales-page .metric-card {
        min-height: 100px;
        padding: 20px !important;
    }

    .sales-page .metric-value {
        color: var(--sales-text);
        font-size: clamp(23px, 2.2vw, 28px);
        line-height: 1.1;
        letter-spacing: -.025em;
    }

    .sales-page .metric-sub {
        color: var(--sales-muted);
        font-size: 9px;
        line-height: 1.45;
    }

    .sales-page .sales-trend-grid {
        display: grid !important;
        grid-template-columns: minmax(0, 1.15fr) minmax(0, .95fr) !important;
        gap: 16px !important;
        margin-bottom: 16px !important;
        align-items: stretch !important;
    }

    .sales-page .neu-card {
        padding: 20px !important;
    }

    .sales-page .section-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 12px;
    }

    .sales-page .section-title {
        margin: 0 0 4px;
        color: var(--sales-text);
        font-size: 14px;
        font-weight: 600;
        line-height: 1.35;
    }

    .sales-page .section-subtitle {
        margin: 0;
        color: var(--sales-muted);
        font-size: 10px;
        line-height: 1.5;
    }

    .sales-page .section-link {
        flex: 0 0 auto;
        color: var(--sales-gold);
        font-size: 10px;
        text-decoration: none;
        transition: color .18s ease;
    }

    .sales-page .section-link:hover {
        color: #ead19d;
    }

    .sales-page .sales-chart-well {
        overflow: hidden;
        border: 1px solid rgba(255, 246, 225, .025) !important;
        border-radius: 15px !important;
        background: linear-gradient(145deg, #252624, #292a28) !important;
        box-shadow:
            inset 5px 5px 11px rgba(12, 13, 12, .48),
            inset -3px -3px 8px rgba(255, 246, 225, .035) !important;
    }

    .sales-page .sales-chart-well canvas {
        width: 100% !important;
        height: 100% !important;
    }

    .sales-page .sales-donut-well {
        border-radius: 50%;
        filter: drop-shadow(5px 6px 9px rgba(12, 13, 12, .3));
    }

    .sales-page .sales-products-grid {
        display: grid !important;
        grid-template-columns: repeat(3, minmax(0, 1fr)) !important;
        gap: 14px !important;
        margin-top: 14px !important;
    }

    .sales-page .sale-product-card {
        min-width: 0;
        overflow: hidden;
        border: 1px solid rgba(255, 246, 225, .025) !important;
        border-radius: 19px !important;
        background: linear-gradient(145deg, #30312f, #2b2c2a) !important;
        box-shadow:
            8px 8px 17px rgba(12, 13, 12, .38),
            -5px -5px 13px rgba(255, 246, 225, .04),
            inset 1px 1px 1px rgba(255, 255, 255, .02) !important;
        transition: transform .18s ease, box-shadow .18s ease;
    }

    .sales-page .sale-product-card:hover {
        transform: translateY(-2px);
        box-shadow:
            10px 12px 20px rgba(12, 13, 12, .4),
            -5px -5px 13px rgba(255, 246, 225, .045),
            inset 1px 1px 1px rgba(255, 255, 255, .02) !important;
    }

    .sales-page .sale-product-image {
        width: min(100% - 28px, 178px);
        height: 178px !important;
        margin: 14px 14px 0;
        overflow: hidden;
        border-radius: 13px;
        background: #242523 !important;
        box-shadow:
            inset 4px 4px 9px rgba(12, 13, 12, .45),
            inset -2px -2px 5px rgba(255, 246, 225, .025);
    }

    .sales-page .sale-product-image img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .sales-page .sale-product-content {
        display: flex;
        flex: 1;
        flex-direction: column;
        min-width: 0;
        padding: 13px 14px 14px !important;
    }

    .sales-page .sale-product-content h3 {
        margin: 0 0 5px !important;
        color: var(--sales-text) !important;
        font-size: 13px !important;
        font-weight: 600 !important;
        line-height: 1.4;
    }

    .sales-page .sale-product-content p {
        margin: 0 0 12px !important;
        color: var(--sales-muted) !important;
        font-size: 10px !important;
        line-height: 1.5;
    }

    .sales-page .badge-yellow,
    .sales-page .badge-gray,
    .sales-page .badge-orange {
        display: inline-flex;
        align-items: center;
        width: fit-content;
        min-height: 21px;
        padding: 0 9px;
        border: 1px solid rgba(255, 246, 225, .025);
        border-radius: 999px;
        background: linear-gradient(145deg, #292a28, #242523);
        box-shadow:
            inset 2px 2px 4px rgba(12, 13, 12, .34),
            inset -1px -1px 3px rgba(255, 246, 225, .025);
        font-size: 9px;
        white-space: nowrap;
    }

    .sales-page .badge-yellow {
        color: var(--sales-gold);
    }

    .sales-page .badge-gray {
        color: #b4b0a7;
    }

    .sales-page .badge-orange {
        color: #d4a27f;
    }

    .sales-page .btn-golden,
    .sales-page .btn-ghost,
    .sales-page .neu-tab-btn {
        border: 1px solid rgba(255, 246, 225, .035);
        transition:
            transform .18s ease,
            box-shadow .18s ease,
            background-color .18s ease,
            border-color .18s ease;
    }

    .sales-page .btn-golden {
        min-height: 40px;
        padding: 0 17px;
        border-radius: 999px;
        background: linear-gradient(145deg, #e6c98f, #d7b77a);
        color: #292720;
        box-shadow:
            6px 6px 12px rgba(12, 13, 12, .38),
            -4px -4px 10px rgba(255, 246, 225, .08),
            inset 1px 1px 1px rgba(255, 255, 255, .35),
            inset -1px -1px 2px rgba(112, 82, 35, .16);
        font-size: 11px;
        font-weight: 600;
    }

    .sales-page .btn-ghost,
    .sales-page .neu-tab-btn {
        min-height: 36px;
        padding: 0 14px;
        border-radius: 999px;
        background: linear-gradient(145deg, #30312f, #292a28);
        color: var(--sales-text);
        box-shadow:
            5px 5px 10px rgba(12, 13, 12, .37),
            -4px -4px 10px rgba(255, 246, 225, .045),
            inset 1px 1px 1px rgba(255, 255, 255, .025);
        font-size: 10px;
        font-weight: 500;
    }

    .sales-page .btn-golden:hover,
    .sales-page .btn-ghost:hover,
    .sales-page .neu-tab-btn:hover {
        transform: translateY(-1px);
        border-color: rgba(212, 180, 123, .2);
    }

    .sales-page .btn-golden:active,
    .sales-page .btn-ghost:active,
    .sales-page .neu-tab-btn:active {
        transform: translateY(1px);
        box-shadow:
            inset 4px 4px 8px rgba(12, 13, 12, .4),
            inset -3px -3px 7px rgba(255, 246, 225, .035);
    }

    .sales-page .btn-golden:focus-visible,
    .sales-page .btn-ghost:focus-visible,
    .sales-page .neu-tab-btn:focus-visible,
    .sales-page .neu-input:focus-visible {
        outline: 2px solid rgba(212, 180, 123, .72);
        outline-offset: 2px;
    }

    .sales-page .neu-tab-container {
        display: flex;
        flex-wrap: wrap;
        gap: 7px;
    }

    .sales-page .neu-tab-btn {
        min-height: 34px;
        padding: 0 12px;
        color: var(--sales-muted);
        white-space: nowrap;
    }

    .sales-page .neu-tab-btn.active,
    .sales-page .neu-tab-btn[aria-pressed="true"] {
        color: var(--sales-gold);
        box-shadow:
            inset 3px 3px 7px rgba(12, 13, 12, .35),
            inset -2px -2px 5px rgba(255, 246, 225, .025);
    }

    .sales-page .neu-input {
        width: 100%;
        min-height: 40px;
        padding: 10px 13px;
        border: 1px solid rgba(255, 246, 225, .025);
        border-radius: 12px;
        background: linear-gradient(145deg, #252624, #292a28);
        color: var(--sales-text);
        box-shadow:
            inset 5px 5px 10px rgba(12, 13, 12, .46),
            inset -3px -3px 8px rgba(255, 246, 225, .025);
        font-size: 11px;
        transition: border-color .18s ease, box-shadow .18s ease;
    }

    .sales-page .neu-input::placeholder {
        color: #8f8b83;
        opacity: 1;
    }

    .sales-page .neu-input:focus {
        border-color: rgba(212, 180, 123, .28);
        box-shadow:
            inset 4px 4px 8px rgba(12, 13, 12, .4),
            inset -2px -2px 6px rgba(255, 246, 225, .025),
            0 0 0 2px rgba(212, 180, 123, .08);
    }

    .sales-page .balhana-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 8px;
        color: var(--sales-muted);
        font-size: 10px;
    }

    .sales-page .balhana-table thead th {
        padding: 11px 13px;
        border: 0;
        background: linear-gradient(145deg, #252624, #292a28);
        color: #a9a59c;
        font-size: 9px;
        font-weight: 500;
        text-align: left;
        white-space: nowrap;
        box-shadow:
            inset 3px 3px 7px rgba(12, 13, 12, .38),
            inset -2px -2px 5px rgba(255, 246, 225, .025);
    }

    .sales-page .balhana-table thead th:first-child {
        border-radius: 12px 0 0 12px;
    }

    .sales-page .balhana-table thead th:last-child {
        border-radius: 0 12px 12px 0;
    }

    .sales-page .balhana-table tbody td {
        padding: 12px 13px;
        border-top: 1px solid rgba(255, 246, 225, .018);
        border-bottom: 1px solid rgba(12, 13, 12, .18);
        background: linear-gradient(145deg, #30312f, #2b2c2a);
        color: var(--sales-muted);
        vertical-align: middle;
        box-shadow:
            4px 5px 11px rgba(12, 13, 12, .23),
            -3px -3px 8px rgba(255, 246, 225, .018);
    }

    .sales-page .balhana-table tbody td:first-child {
        border-radius: 12px 0 0 12px;
    }

    .sales-page .balhana-table tbody td:last-child {
        border-radius: 0 12px 12px 0;
    }

    .sales-page .balhana-table tbody tr[hidden] {
        display: none;
    }

    .sales-page #salesEmptyState {
        border-radius: 14px;
        background: linear-gradient(145deg, #292a28, #252624);
        box-shadow:
            inset 4px 4px 8px rgba(12, 13, 12, .32),
            inset -2px -2px 5px rgba(255, 246, 225, .02);
    }

    .sales-page #salesResultCount {
        border-top-color: rgba(255, 246, 225, .055) !important;
    }

    .sales-page dialog#saleDetailDialog {
        border: 1px solid rgba(255, 246, 225, .06) !important;
        border-radius: 22px !important;
        background: linear-gradient(145deg, #30312f, #292a28) !important;
        color: var(--sales-text) !important;
        box-shadow:
            22px 22px 55px rgba(0, 0, 0, .58),
            -8px -8px 24px rgba(255, 246, 225, .06),
            inset 1px 1px 1px rgba(255, 255, 255, .035) !important;
    }

    .sales-page dialog#saleDetailDialog::backdrop {
        background: rgba(14, 15, 14, .72);
        backdrop-filter: blur(3px);
    }

    .sales-page dialog#saleDetailDialog[open] {
        animation: sale-dialog-in .18s ease-out;
    }

    @keyframes sale-dialog-in {
        from {
            opacity: 0;
            transform: translateY(7px) scale(.99);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    @media (max-width: 1050px) {
        .sales-page .sales-metrics {
            grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
        }

        .sales-page .sales-trend-grid {
            grid-template-columns: minmax(0, 1fr) !important;
        }

        .sales-page .sales-products-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr)) !important;
        }
    }

    @media (max-width: 620px) {
        .sales-page .sales-metrics {
            gap: 10px !important;
        }

        .sales-page .metric-card {
            min-height: 88px;
            padding: 15px !important;
            border-radius: 18px;
        }

        .sales-page .neu-card {
            padding: 16px !important;
            border-radius: 19px;
        }

        .sales-page .sales-products-grid {
            grid-template-columns: minmax(0, 1fr) !important;
        }

        .sales-page .sale-product-card {
            display: grid !important;
            grid-template-columns: 112px minmax(0, 1fr);
            align-items: center;
        }

        .sales-page .sale-product-image {
            width: 96px;
            height: 112px !important;
            margin: 12px 0 12px 12px;
        }

        .sales-page .sale-product-content {
            padding: 12px !important;
        }

        .sales-page .section-header {
            flex-wrap: wrap;
        }

        .sales-page #salesStatusFilters {
            width: 100%;
        }

        .sales-page #salesStatusFilters .neu-tab-btn {
            flex: 1 1 auto;
        }

        .sales-page .sales-period {
            min-height: 38px;
        }

        .sales-page #saleDetailDialog > div {
            padding: 18px !important;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .sales-page *,
        .sales-page *::before,
        .sales-page *::after {
            animation-duration: .01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: .01ms !important;
        }
    }
</style>

<div class="sales-page">
    <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:16px;flex-wrap:wrap;margin-bottom:18px;">
        <div style="min-width:0;">
            <div class="page-breadcrumb">Ruang bisnis / September 2026</div>
            <h1 class="page-title">Penjualan</h1>
            <p class="page-subtitle" style="margin-bottom:0;">
                Pantau omzet, pesanan, dan kanal penjualan untuk mengambil keputusan pembelian dan promosi.
            </p>
        </div>

        <div class="sales-period" style="display:inline-flex;align-items:center;gap:9px;flex:0 0 auto;padding:9px 15px;border:1px solid rgba(245,239,225,.045);border-radius:999px;background:#2b2b29;box-shadow:-2px -2px 6px rgba(255,245,220,.035),4px 5px 10px rgba(0,0,0,.25);color:#d3cfc6;font-size:11px;">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#d4b47b" stroke-width="1.8" aria-hidden="true">
                <rect x="3" y="4" width="18" height="17" rx="2"/>
                <path d="M16 2v4M8 2v4M3 10h18"/>
            </svg>
            <span>September 2026</span>
        </div>
    </div>

    {{-- Ringkasan penjualan --}}
    <section class="sales-metrics" style="display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:12px;margin-bottom:16px;" aria-label="Ringkasan penjualan">
        <article class="metric-card">
            <div class="metric-value" style="font-size:clamp(20px,2.3vw,28px);">Rp18,72 jt</div>
            <div class="metric-sub" style="margin-top:8px;color:#d4b47b;">+12,4% dari Agustus</div>
        </article>

        <article class="metric-card">
            <div class="metric-value">128</div>
            <div class="metric-sub" style="margin-top:8px;">24 pesanan selesai hari ini</div>
        </article>

        <article class="metric-card">
            <div class="metric-value">48</div>
            <div class="metric-sub" style="margin-top:8px;">Pesanan siap kirim</div>
        </article>

        <article class="metric-card">
            <div class="metric-value">6</div>
            <div class="metric-sub" style="margin-top:8px;">Butuh tindak lanjut</div>
        </article>
    </section>

    {{-- Tren penjualan dan status --}}
    <section class="sales-trend-grid" style="display:grid;grid-template-columns:minmax(0,1.15fr) minmax(0,.95fr);gap:16px;margin-bottom:16px;align-items:stretch;">
        <article class="neu-card" style="padding:20px;">
            <div class="section-header">
                <div>
                    <h2 class="section-title">Tren Penjualan</h2>
                    <p class="section-subtitle">Omzet harian • 1–30 September 2026</p>
                </div>
                <a href="{{ route('laporan') }}" class="section-link">Lihat detail →</a>
            </div>

            <div class="sales-chart-well" style="height:180px;position:relative;margin-top:10px;padding:10px;border:1px solid rgba(245,239,225,.035);border-radius:15px;background:#252523;box-shadow:inset 3px 3px 7px rgba(0,0,0,.3),inset -1px -1px 3px rgba(255,245,220,.02);">
                <canvas id="penjualanChart" role="img" aria-label="Grafik omzet harian bulan September 2026">
                    Grafik omzet harian bulan September 2026.
                </canvas>
            </div>

            <div style="display:flex;justify-content:space-between;gap:8px;margin-top:10px;padding:0 3px;color:#aaa69d;font-size:9px;">
                <span>01 Sep</span>
                <span>07 Sep</span>
                <span>14 Sep</span>
                <span>21 Sep</span>
                <span>30 Sep</span>
            </div>
        </article>

        <article class="neu-card" style="padding:20px;">
            <div style="margin-bottom:15px;">
                <h2 class="section-title">Kanal &amp; Status</h2>
                <p class="section-subtitle">Distribusi pesanan dan status terbaru</p>
            </div>

            <div style="display:flex;align-items:center;gap:22px;min-height:160px;">
                <div class="sales-donut-well" style="position:relative;width:132px;height:132px;flex:0 0 132px;">
                    <canvas id="donutChartPenjualan" width="132" height="132" role="img" aria-label="Status pesanan: 64 selesai, 48 siap kirim, 12 diproses, 4 perlu tindak lanjut">
                        Status pesanan: 64 selesai, 48 siap kirim, 12 diproses, 4 perlu tindak lanjut.
                    </canvas>
                    <div style="position:absolute;inset:0;display:flex;flex-direction:column;align-items:center;justify-content:center;pointer-events:none;">
                        <div style="color:#eeeae1;font-size:23px;font-weight:500;line-height:1;">128</div>
                        <div style="margin-top:5px;color:#aaa69d;font-size:9px;">pesanan</div>
                    </div>
                </div>

                <div style="display:flex;flex:1;flex-direction:column;gap:13px;min-width:0;">
                    <div style="display:flex;align-items:center;justify-content:space-between;gap:10px;">
                        <span style="display:flex;align-items:center;gap:8px;color:#d3cfc6;font-size:10px;">
                            <span class="chart-legend-dot" style="background:#d4b47b;"></span>
                            Selesai
                        </span>
                        <span style="color:#eeeae1;font-size:10px;font-weight:500;">64</span>
                    </div>
                    <div style="display:flex;align-items:center;justify-content:space-between;gap:10px;">
                        <span style="display:flex;align-items:center;gap:8px;color:#d3cfc6;font-size:10px;">
                            <span class="chart-legend-dot" style="background:#aaa99e;"></span>
                            Siap kirim
                        </span>
                        <span style="color:#eeeae1;font-size:10px;font-weight:500;">48</span>
                    </div>
                    <div style="display:flex;align-items:center;justify-content:space-between;gap:10px;">
                        <span style="display:flex;align-items:center;gap:8px;color:#d3cfc6;font-size:10px;">
                            <span class="chart-legend-dot" style="background:#77766f;"></span>
                            Diproses
                        </span>
                        <span style="color:#eeeae1;font-size:10px;font-weight:500;">12</span>
                    </div>
                    <div style="display:flex;align-items:center;justify-content:space-between;gap:10px;">
                        <span style="display:flex;align-items:center;gap:8px;color:#d3cfc6;font-size:10px;">
                            <span class="chart-legend-dot" style="background:#55544f;"></span>
                            Tindak lanjut
                        </span>
                        <span style="color:#eeeae1;font-size:10px;font-weight:500;">4</span>
                    </div>
                </div>
            </div>
        </article>
    </section>

    {{-- Produk terlaris --}}
    <section class="neu-card" style="padding:20px;margin-bottom:16px;">
        <div class="section-header">
            <div>
                <h2 class="section-title">Produk Terlaris</h2>
                <p class="section-subtitle">3 produk paling banyak terjual • September 2026</p>
            </div>
            <a href="{{ route('produk') }}" class="section-link">Lihat semua →</a>
        </div>

        <div class="sales-products-grid" style="display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:14px;margin-top:14px;">
            @foreach($produkTerlaris as $produk)
                <article class="sale-product-card" style="display:flex;flex-direction:column;min-width:0;overflow:hidden;border:1px solid rgba(245,239,225,.045);border-radius:17px;background:#292927;box-shadow:-2px -2px 6px rgba(255,245,220,.025),5px 6px 13px rgba(0,0,0,.24);">
                    <div class="sale-product-image" style="height:clamp(140px,17vw,190px);overflow:hidden;background:#242422;">
                        <img
                            src="{{ $produk['gambar'] }}"
                            alt="{{ $produk['nama'] }}"
                            loading="lazy"
                            style="width:100%;height:100%;object-fit:cover;"
                        >
                    </div>

                    <div class="sale-product-content" style="display:flex;flex:1;flex-direction:column;padding:14px;">
                        <h3 style="margin:0 0 5px;color:#eeeae1;font-size:13px;font-weight:600;">{{ $produk['nama'] }}</h3>
                        <p style="margin:0 0 13px;color:#aaa69d;font-size:10px;line-height:1.5;">{{ $produk['detail'] }}</p>
                        <div style="display:flex;align-items:center;justify-content:space-between;gap:10px;margin-top:auto;">
                            <span class="{{ $produk['statusClass'] }}">{{ $produk['status'] }}</span>
                            <a href="{{ route('produk') }}" class="btn-ghost" style="min-height:32px;padding:6px 11px;font-size:9px;">
                                Lihat detail
                            </a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    {{-- Tabel transaksi --}}
    <section class="neu-card" style="padding:20px;" aria-labelledby="salesTableTitle">
        <div class="section-header">
            <div>
                <h2 class="section-title" id="salesTableTitle">Tabel Transaksi</h2>
                <p class="section-subtitle">5 transaksi terbaru • diperbarui 30 Sep 2026</p>
            </div>
            <a href="{{ route('penjualan') }}" class="section-link">Lihat semua →</a>
        </div>

        <div style="display:flex;align-items:center;gap:11px;flex-wrap:wrap;margin:14px 0;">
            <label style="position:relative;display:block;flex:1 1 270px;min-width:min(100%,220px);">
                <svg style="position:absolute;top:50%;left:14px;transform:translateY(-50%);color:#d4b47b;pointer-events:none;" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <circle cx="11" cy="11" r="8"/>
                    <path d="m21 21-4.35-4.35"/>
                </svg>
                <input
                    id="salesSearch"
                    type="search"
                    class="neu-input"
                    placeholder="Cari transaksi, produk, atau pelanggan..."
                    aria-label="Cari transaksi, produk, atau pelanggan"
                    autocomplete="off"
                    style="min-height:40px;padding-left:40px;border-radius:999px;"
                >
            </label>

            <div id="salesStatusFilters" class="neu-tab-container" role="group" aria-label="Filter status transaksi">
                <button type="button" class="neu-tab-btn active" data-sales-status="semua" aria-pressed="true">Semua status</button>
                <button type="button" class="neu-tab-btn" data-sales-status="Selesai" aria-pressed="false">Selesai</button>
                <button type="button" class="neu-tab-btn" data-sales-status="Siap kirim" aria-pressed="false">Siap kirim</button>
                <button type="button" class="neu-tab-btn" data-sales-status="Diproses" aria-pressed="false">Diproses</button>
                <button type="button" class="neu-tab-btn" data-sales-status="Butuh tindak lanjut" aria-pressed="false">Tindak lanjut</button>
            </div>
        </div>

        <div style="max-width:100%;overflow-x:auto;">
            <table class="balhana-table" style="min-width:760px;">
                <thead>
                    <tr>
                        <th>Tanggal / kanal</th>
                        <th>Produk</th>
                        <th>Status</th>
                        <th>Pelanggan</th>
                        <th>Omzet</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="salesTableBody">
                    @foreach($transaksi as $item)
                        @php
                            $searchText = strtolower($item['tanggal'].' '.$item['kanal'].' '.$item['produk'].' '.$item['status'].' '.$item['pelanggan'].' '.$item['omzet']);
                            $badgeClass = match($item['status']) {
                                'Selesai' => 'badge-yellow',
                                'Siap kirim' => 'badge-gray',
                                'Diproses' => 'badge-gray',
                                default => 'badge-orange',
                            };
                        @endphp

                        <tr
                            data-sale-row
                            data-status="{{ $item['status'] }}"
                            data-search="{{ $searchText }}"
                            data-date="{{ $item['tanggal'] }}"
                            data-channel="{{ $item['kanal'] }}"
                            data-product="{{ $item['produk'] }}"
                            data-customer="{{ $item['pelanggan'] }}"
                            data-amount="{{ $item['omzet'] }}"
                        >
                            <td style="color:#aaa69d;font-size:10px;white-space:nowrap;">
                                {{ $item['tanggal'] }} • {{ $item['kanal'] }}
                            </td>
                            <td style="color:#eeeae1;">{{ $item['produk'] }}</td>
                            <td><span class="{{ $badgeClass }}">{{ $item['status'] }}</span></td>
                            <td style="color:#aaa69d;">{{ $item['pelanggan'] }}</td>
                            <td style="color:#eeeae1;white-space:nowrap;">Rp{{ number_format($item['omzet'], 0, ',', '.') }}</td>
                            <td>
                                <button type="button" class="btn-ghost" data-sale-detail style="min-height:30px;padding:6px 10px;font-size:9px;">
                                    Lihat
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div id="salesEmptyState" hidden style="padding:25px 12px;text-align:center;color:#aaa69d;font-size:11px;">
            Tidak ada transaksi yang cocok dengan pencarian atau filter ini.
        </div>

        <div id="salesResultCount" style="margin-top:12px;padding-top:11px;border-top:1px solid rgba(245,239,225,.05);color:#aaa69d;font-size:9px;">
            Menampilkan 5 data • diperbarui 30 Sep 2026
        </div>
    </section>

    <dialog id="saleDetailDialog" style="width:min(420px,calc(100% - 28px));max-width:420px;padding:0;border:1px solid rgba(245,239,225,.08);border-radius:22px;background:#2b2b29;color:#eeeae1;box-shadow:0 24px 70px rgba(0,0,0,.58);">
        <div style="padding:22px;">
            <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:12px;margin-bottom:18px;">
                <div>
                    <h2 style="margin:0 0 4px;font-size:17px;font-weight:600;">Detail Transaksi</h2>
                    <p id="saleDetailNumber" style="margin:0;color:#aaa69d;font-size:10px;"></p>
                </div>
                <button id="closeSaleDetail" class="btn-ghost" type="button" aria-label="Tutup detail" style="min-width:36px;width:36px;min-height:36px;padding:0;">×</button>
            </div>

            <div style="display:flex;flex-direction:column;gap:12px;font-size:11px;">
                <div style="display:flex;justify-content:space-between;gap:12px;"><span style="color:#aaa69d;">Tanggal / kanal</span><span id="saleDetailDate" style="text-align:right;"></span></div>
                <div style="display:flex;justify-content:space-between;gap:12px;"><span style="color:#aaa69d;">Produk</span><span id="saleDetailProduct" style="text-align:right;"></span></div>
                <div style="display:flex;justify-content:space-between;gap:12px;"><span style="color:#aaa69d;">Status</span><span id="saleDetailStatus" style="text-align:right;"></span></div>
                <div style="display:flex;justify-content:space-between;gap:12px;"><span style="color:#aaa69d;">Pelanggan</span><span id="saleDetailCustomer" style="text-align:right;"></span></div>
                <div style="display:flex;justify-content:space-between;gap:12px;padding-top:12px;border-top:1px solid rgba(245,239,225,.055);"><span style="color:#aaa69d;">Omzet</span><strong id="saleDetailAmount" style="color:#d4b47b;text-align:right;"></strong></div>
            </div>
        </div>
    </dialog>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('salesSearch');
    const filterGroup = document.getElementById('salesStatusFilters');
    const rows = Array.from(document.querySelectorAll('[data-sale-row]'));
    const emptyState = document.getElementById('salesEmptyState');
    const resultCount = document.getElementById('salesResultCount');
    const dialog = document.getElementById('saleDetailDialog');
    let activeStatus = 'semua';

    function filterSales() {
        const query = (searchInput.value || '').trim().toLocaleLowerCase('id-ID');
        let visibleCount = 0;

        rows.forEach(function (row) {
            const matchesStatus = activeStatus === 'semua' || row.dataset.status === activeStatus;
            const matchesSearch = !query || (row.dataset.search || '').includes(query);
            const visible = matchesStatus && matchesSearch;

            row.hidden = !visible;

            if (visible) {
                visibleCount += 1;
            }
        });

        emptyState.hidden = visibleCount !== 0;
        resultCount.textContent =
            'Menampilkan ' + visibleCount + ' data • diperbarui 30 Sep 2026';
    }

    searchInput.addEventListener('input', filterSales);

    filterGroup.addEventListener('click', function (event) {
        const button = event.target.closest('[data-sales-status]');

        if (!button) {
            return;
        }

        activeStatus = button.dataset.salesStatus || 'semua';

        filterGroup.querySelectorAll('[data-sales-status]').forEach(function (filterButton) {
            const isActive = filterButton === button;
            filterButton.classList.toggle('active', isActive);
            filterButton.setAttribute('aria-pressed', isActive ? 'true' : 'false');
        });

        filterSales();
    });

    document.addEventListener('click', function (event) {
        const button = event.target.closest('[data-sale-detail]');

        if (!button) {
            return;
        }

        const row = button.closest('[data-sale-row]');
        if (!row) {
            return;
        }

        const number = Array.from(row.parentElement.querySelectorAll('[data-sale-row]')).indexOf(row) + 1;

        document.getElementById('saleDetailNumber').textContent = 'Transaksi #' + String(number).padStart(3, '0');
        document.getElementById('saleDetailDate').textContent = row.dataset.date + ' • ' + row.dataset.channel;
        document.getElementById('saleDetailProduct').textContent = row.dataset.product;
        document.getElementById('saleDetailStatus').textContent = row.dataset.status;
        document.getElementById('saleDetailCustomer').textContent = row.dataset.customer;
        document.getElementById('saleDetailAmount').textContent =
            'Rp' + Number(row.dataset.amount).toLocaleString('id-ID');

        if (typeof dialog.showModal === 'function') {
            dialog.showModal();
        } else {
            dialog.setAttribute('open', '');
        }
    });

    function closeDialog() {
        if (typeof dialog.close === 'function') {
            dialog.close();
        } else {
            dialog.removeAttribute('open');
        }
    }

    document.getElementById('closeSaleDetail').addEventListener('click', closeDialog);

    dialog.addEventListener('click', function (event) {
        if (event.target === dialog) {
            closeDialog();
        }
    });

    const salesCanvas = document.getElementById('penjualanChart');

    if (salesCanvas && typeof Chart !== 'undefined') {
        const values = [20, 25, 22, 28, 30, 28, 35, 32, 28, 34, 30, 38, 34, 32, 36];

        new Chart(salesCanvas, {
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
                        gradient.addColorStop(0, 'rgba(212, 180, 123, 0.24)');
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
                    x: { display: false, grid: { display: false } },
                    y: { display: false, grid: { display: false } }
                }
            }
        });
    }

    const statusCanvas = document.getElementById('donutChartPenjualan');

    if (statusCanvas && typeof Chart !== 'undefined') {
        new Chart(statusCanvas, {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [64, 48, 12, 4],
                    backgroundColor: ['#d4b47b', '#aaa99e', '#77766f', '#55544f'],
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