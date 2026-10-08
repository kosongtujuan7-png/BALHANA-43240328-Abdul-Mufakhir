@extends('layouts.app')

@section('title', 'Beranda – BALHANA')

@section('content')
@php
    $produkTerlaris = [
        [
            'nama' => 'Kemeja Linen',
            'terjual' => '48 pcs terjual',
            'omzet' => 'Rp7.152.000',
            'gambar' => 'https://images.unsplash.com/photo-1602810318383-e386cc2a3ccf?w=500&q=85&fit=crop',
        ],
        [
            'nama' => 'Tunik Aira',
            'terjual' => '36 pcs terjual',
            'omzet' => 'Rp4.644.000',
            'gambar' => 'https://images.unsplash.com/photo-1567401893414-76b7b1e5a7a5?w=500&q=85&fit=crop',
        ],
        [
            'nama' => 'Celana Kulot',
            'terjual' => '32 pcs terjual',
            'omzet' => 'Rp3.808.000',
            'gambar' => 'https://images.unsplash.com/photo-1624378439575-d8705ad7ae80?w=500&q=85&fit=crop',
        ],
    ];

    $transaksiTerbaru = [
        [
            'kode' => 'PJ-084',
            'tanggal' => '30 Sep',
            'pelanggan' => 'Siti Rahma',
            'produk' => 'Linen • L Hitam',
            'total' => 'Rp149.000',
            'status' => 'Lunas',
            'statusClass' => 'badge-green',
        ],
        [
            'kode' => 'PJ-083',
            'tanggal' => '30 Sep',
            'pelanggan' => 'Dina Putri',
            'produk' => 'Aira • M Cream',
            'total' => 'Rp129.000',
            'status' => 'Lunas',
            'statusClass' => 'badge-green',
        ],
        [
            'kode' => 'PJ-082',
            'tanggal' => '29 Sep',
            'pelanggan' => 'Rani Sari',
            'produk' => 'Kulot • L Mocca',
            'total' => 'Rp238.000',
            'status' => 'Menunggu',
            'statusClass' => 'badge-orange',
        ],
    ];
@endphp

<style>
    /*
     * Selector :has() membatasi sentuhan pada shell saat halaman Beranda aktif.
     * Sidebar tetap memakai markup dan layout yang sudah ada.
     */
    body:has(.home-page) .sidebar {
        background:
            linear-gradient(145deg, rgba(255,250,235,.025), transparent 34%),
            #282826;
        box-shadow:
            inset 3px 3px 8px rgba(0,0,0,.24),
            inset -2px -2px 6px rgba(255,245,220,.025),
            -5px -5px 14px rgba(255,245,220,.035),
            9px 12px 28px rgba(0,0,0,.36);
    }

    body:has(.home-page) .sidebar-item {
        border-color: rgba(245,239,225,.025);
        background:
            linear-gradient(145deg, rgba(255,250,235,.025), transparent 70%),
            #292a28;
        box-shadow:
            inset 2px 2px 5px rgba(0,0,0,.25),
            inset -1px -1px 4px rgba(255,245,220,.035),
            -2px -2px 5px rgba(255,245,220,.022),
            4px 5px 9px rgba(0,0,0,.22);
    }

    body:has(.home-page) .sidebar-item:hover {
        transform: translateY(-1px);
        background:
            linear-gradient(145deg, rgba(255,250,235,.035), transparent 72%),
            #2b2b29;
        box-shadow:
            inset 1px 1px 4px rgba(0,0,0,.22),
            inset -1px -1px 4px rgba(255,245,220,.04),
            -2px -2px 6px rgba(255,245,220,.028),
            5px 6px 11px rgba(0,0,0,.25);
    }

    body:has(.home-page) .sidebar-item:active,
    body:has(.home-page) .sidebar-item.active {
        transform: translateY(0);
        border-color: rgba(212,180,123,.13);
        background:
            linear-gradient(145deg, rgba(212,180,123,.055), transparent 70%),
            #252522;
        box-shadow:
            inset 4px 4px 8px rgba(0,0,0,.42),
            inset -2px -2px 5px rgba(255,245,220,.035),
            1px 1px 3px rgba(255,245,220,.02);
    }

    body:has(.home-page) .sidebar-business {
        background:
            linear-gradient(145deg, rgba(255,250,235,.025), transparent 60%),
            #2b2b29;
        box-shadow:
            inset 3px 3px 7px rgba(0,0,0,.30),
            inset -2px -2px 5px rgba(255,245,220,.035),
            3px 4px 9px rgba(0,0,0,.18);
    }

    body:has(.home-page) .search-bar {
        background:
            linear-gradient(145deg, rgba(255,255,255,.018), transparent 70%),
            #252624;
        box-shadow:
            inset 4px 4px 9px rgba(0,0,0,.40),
            inset -2px -2px 5px rgba(255,245,220,.035),
            1px 1px 2px rgba(255,255,255,.015);
    }

    body:has(.home-page) .notification-btn,
    body:has(.home-page) .avatar {
        box-shadow:
            inset 2px 2px 5px rgba(0,0,0,.28),
            inset -1px -1px 4px rgba(255,245,220,.04),
            -2px -2px 5px rgba(255,245,220,.025),
            4px 5px 10px rgba(0,0,0,.28);
    }

    .home-page {
        --home-surface: #2e2f2d;
        --home-deep: #252624;
        --home-gold: #d7b77e;
        --home-text: #eeeae1;
        --home-muted: #aaa69d;
        color: var(--home-text);
    }

    .home-page *,
    .home-page *::before,
    .home-page *::after {
        box-sizing: border-box;
    }

    .home-page .home-stack {
        display: flex;
        flex-direction: column;
        gap: 18px;
    }

    .home-page .home-grid {
        display: grid;
        gap: 16px;
        align-items: stretch;
        min-width: 0;
    }

    .home-page .hero-grid {
        grid-template-columns: minmax(0,1.1fr) minmax(0,1fr);
    }

    .home-page .two-column-grid {
        grid-template-columns: repeat(2,minmax(0,1fr));
    }

    .home-page .wide-left-grid {
        grid-template-columns: minmax(0,1.18fr) minmax(0,.82fr);
    }

    .home-page .home-panel {
        position: relative;
        min-width: 0;
        border: 1px solid rgba(241,230,207,.045);
        border-radius: 23px;
        background:
            linear-gradient(145deg, rgba(255,255,255,.018), transparent 46%),
            var(--home-surface);
        box-shadow:
            inset 3px 3px 7px rgba(0,0,0,.27),
            inset -2px -2px 6px rgba(255,245,220,.032),
            -4px -4px 11px rgba(255,245,220,.025),
            9px 10px 20px rgba(0,0,0,.29);
    }

    .home-page .home-panel-pad { padding: 20px; }

    .home-page .hero-panel {
        position: relative;
        display: flex;
        min-height: 271px;
        align-items: center;
        overflow: hidden;
        isolation: isolate;
        padding: 27px 28px;
        border: 1px solid rgba(241,230,207,.055);
        border-radius: 24px;
        background: linear-gradient(110deg,#252522 0%,#292824 58%,#302b22 100%);
        box-shadow:
            inset 2px 2px 6px rgba(255,255,255,.025),
            inset -3px -3px 8px rgba(0,0,0,.28),
            12px 14px 24px rgba(0,0,0,.34),
            -5px -5px 16px rgba(255,245,220,.028);
    }

    .home-page .hero-image {
        position: absolute;
        z-index: -1;
        inset: 0 0 0 auto;
        width: 56%;
        overflow: hidden;
        box-shadow:
            inset 12px 0 18px rgba(0,0,0,.2),
            inset -5px -5px 12px rgba(0,0,0,.2);
    }

    .home-page .hero-image img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        opacity: .46;
    }

    .home-page .hero-image::after {
        position: absolute;
        inset: 0;
        background:
            linear-gradient(90deg,#252522 0%,rgba(37,37,34,.82) 22%,rgba(37,37,34,.18) 100%),
            linear-gradient(0deg,rgba(24,24,22,.27),transparent 48%);
        content: "";
    }

    .home-page .hero-copy { width: min(100%,390px); }

    .home-page .hero-brand {
        margin-bottom: 12px;
        color: var(--home-gold);
        font-family: Georgia,"Times New Roman",serif;
        font-size: 13px;
        letter-spacing: .08em;
    }

    .home-page .hero-title {
        max-width: 390px;
        margin: 0 0 12px;
        color: var(--home-text);
        font-size: clamp(25px,2.7vw,34px);
        font-weight: 400;
        letter-spacing: -.035em;
        line-height: 1.17;
    }

    .home-page .hero-description {
        max-width: 335px;
        margin: 0 0 17px;
        color: #c0bbb1;
        font-size: 11.5px;
        line-height: 1.6;
    }

    .home-page .hero-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 9px;
    }

    .home-page .hero-actions .btn-golden,
    .home-page .hero-actions .btn-ghost,
    .home-page .restock-button {
        min-height: 39px;
        border-radius: 999px;
        transition: transform .16s ease, box-shadow .16s ease, filter .16s ease;
    }

    .home-page .hero-actions .btn-golden,
    .home-page .restock-button {
        box-shadow:
            inset 1px 1px 2px rgba(255,255,255,.43),
            inset -2px -2px 5px rgba(131,91,34,.20),
            5px 6px 12px rgba(0,0,0,.30);
    }

    .home-page .hero-actions .btn-ghost {
        box-shadow:
            inset 2px 2px 5px rgba(0,0,0,.26),
            inset -1px -1px 4px rgba(255,245,220,.045),
            4px 5px 10px rgba(0,0,0,.25);
    }

    .home-page .hero-actions .btn-golden:hover,
    .home-page .hero-actions .btn-ghost:hover,
    .home-page .restock-button:hover {
        filter: brightness(1.035);
        transform: translateY(-1px);
    }

    .home-page .hero-actions .btn-golden:active,
    .home-page .hero-actions .btn-ghost:active,
    .home-page .restock-button:active {
        transform: translateY(1px) scale(.985);
        box-shadow:
            inset 4px 4px 8px rgba(0,0,0,.30),
            inset -2px -2px 5px rgba(255,255,255,.05);
    }

    .home-page .metric-grid {
        display: grid;
        grid-template-columns: repeat(2,minmax(0,1fr));
        gap: 14px;
        min-width: 0;
    }

    .home-page .metric-card {
        position: relative;
        display: flex;
        min-width: 0;
        min-height: 109px;
        flex-direction: column;
        justify-content: center;
        padding: 18px 22px;
        overflow: hidden;
        border: 1px solid rgba(241,230,207,.04);
        border-radius: 22px;
        background:
            linear-gradient(145deg,rgba(255,255,255,.018),transparent 48%),
            var(--home-surface);
        box-shadow:
            inset 2px 2px 5px rgba(0,0,0,.22),
            inset -2px -2px 5px rgba(255,245,220,.03),
            -3px -3px 9px rgba(255,245,220,.025),
            7px 8px 17px rgba(0,0,0,.27);
    }

    .home-page .metric-label {
        margin-bottom: 9px;
        color: var(--home-muted);
        font-size: 10px;
        line-height: 1.35;
    }

    .home-page .metric-value {
        margin: 0 0 8px;
        color: var(--home-text);
        font-size: clamp(20px,2vw,24px);
        font-weight: 500;
        letter-spacing: -.025em;
        line-height: 1.15;
        overflow-wrap: anywhere;
    }

    .home-page .metric-sub {
        color: var(--home-gold);
        font-size: 9px;
        line-height: 1.4;
    }

    .home-page .metric-icon {
        position: absolute;
        top: 17px;
        right: 17px;
        width: 16px;
        height: 16px;
        color: var(--home-gold);
        opacity: .9;
    }

    .home-page .section-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 12px;
        min-width: 0;
    }

    .home-page .section-title {
        margin: 0 0 4px;
        color: var(--home-text);
        font-size: 14px;
        font-weight: 600;
        line-height: 1.35;
    }

    .home-page .section-subtitle {
        margin: 0;
        color: var(--home-muted);
        font-size: 10px;
        line-height: 1.5;
    }

    .home-page .section-link {
        flex: 0 0 auto;
        padding-top: 2px;
        color: var(--home-gold);
        font-size: 10px;
        text-decoration: none;
        white-space: nowrap;
    }

    .home-page .section-link:hover { color: #ead09b; }
    .home-page .sales-summary { flex: 0 0 auto; text-align: right; }

    .home-page .sales-summary-value {
        color: var(--home-text);
        font-size: 18px;
        font-weight: 500;
        line-height: 1.2;
    }

    .home-page .sales-summary-note {
        margin-top: 3px;
        color: var(--home-gold);
        font-size: 9px;
    }

    .home-page .chart-well {
        position: relative;
        height: 183px;
        margin-top: 12px;
        padding: 10px 12px 4px;
        overflow: hidden;
        border: 1px solid rgba(255,255,255,.025);
        border-radius: 13px;
        background:
            linear-gradient(145deg,rgba(255,255,255,.018),transparent 48%),
            var(--home-deep);
        box-shadow:
            inset 7px 7px 13px rgba(0,0,0,.47),
            inset -3px -3px 7px rgba(255,245,220,.035),
            1px 1px 2px rgba(255,255,255,.012);
    }

    .home-page .chart-well canvas {
        display: block;
        width: 100% !important;
        height: 100% !important;
    }

    .home-page .chart-dates {
        display: flex;
        justify-content: space-between;
        gap: 8px;
        margin-top: 10px;
        color: var(--home-muted);
        font-size: 9px;
    }

    .home-page .interest-breakdown {
        display: flex;
        min-height: 157px;
        align-items: center;
        gap: 23px;
        padding: 7px 0 13px;
    }

    .home-page .donut-wrap {
        position: relative;
        width: 126px;
        height: 126px;
        flex: 0 0 126px;
        padding: 2px;
        border-radius: 50%;
        background: #2b2c2a;
        box-shadow:
            inset 4px 4px 8px rgba(0,0,0,.35),
            inset -2px -2px 6px rgba(255,245,220,.035),
            4px 5px 9px rgba(0,0,0,.17);
    }

    .home-page .donut-wrap canvas {
        display: block;
        width: 122px !important;
        height: 122px !important;
    }

    .home-page .donut-center {
        position: absolute;
        inset: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        pointer-events: none;
    }

    .home-page .donut-total {
        color: var(--home-text);
        font-size: 23px;
        font-weight: 500;
        line-height: 1.1;
    }

    .home-page .donut-caption {
        margin-top: 4px;
        color: var(--home-muted);
        font-size: 9px;
    }

    .home-page .chart-legend {
        display: flex;
        flex-direction: column;
        gap: 11px;
        min-width: 0;
    }

    .home-page .chart-legend-row {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #d3cfc6;
        font-size: 10px;
        line-height: 1.4;
    }

    .home-page .chart-legend-dot {
        width: 8px;
        height: 8px;
        flex: 0 0 8px;
        border-radius: 50%;
        box-shadow: inset 1px 1px 2px rgba(255,255,255,.22), 1px 2px 3px rgba(0,0,0,.35);
    }

    .home-page .chart-legend-percent { color: var(--home-muted); }

    .home-page .interest-highlights {
        display: flex;
        flex-direction: column;
        gap: 11px;
        padding-top: 13px;
        border-top: 1px solid rgba(245,239,225,.06);
    }

    .home-page .highlight-row {
        display: flex;
        justify-content: space-between;
        gap: 12px;
        font-size: 10px;
        line-height: 1.4;
    }

    .home-page .highlight-label { color: var(--home-muted); }
    .home-page .highlight-value { color: var(--home-text); text-align: right; }
    .home-page .highlight-value.gold { color: var(--home-gold); }

    .home-page .product-grid {
        display: grid;
        grid-template-columns: repeat(3,minmax(0,1fr));
        gap: 12px;
        margin-top: 14px;
    }

    .home-page .product-tile {
        min-width: 0;
        padding: 9px;
        overflow: hidden;
        border: 1px solid rgba(245,239,225,.045);
        border-radius: 16px;
        background:
            linear-gradient(145deg,rgba(255,255,255,.015),transparent 55%),
            #2b2c2a;
        box-shadow:
            inset 3px 3px 7px rgba(0,0,0,.30),
            inset -2px -2px 5px rgba(255,245,220,.035),
            -2px -2px 6px rgba(255,245,220,.02),
            5px 7px 13px rgba(0,0,0,.25);
    }

    .home-page .product-photo {
        height: 108px;
        overflow: hidden;
        border: 1px solid rgba(255,255,255,.025);
        border-radius: 12px;
        background: #242422;
        box-shadow:
            inset 5px 5px 10px rgba(0,0,0,.4),
            inset -2px -2px 5px rgba(255,245,220,.04),
            1px 1px 2px rgba(255,255,255,.015);
    }

    .home-page .product-photo img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .home-page .product-info { padding: 10px 3px 2px; }

    .home-page .product-name {
        margin: 0 0 4px;
        color: var(--home-text);
        font-size: 10px;
        font-weight: 600;
        line-height: 1.4;
    }

    .home-page .product-sold {
        color: var(--home-muted);
        font-size: 9px;
        line-height: 1.4;
    }

    .home-page .product-revenue {
        margin-top: 6px;
        color: var(--home-gold);
        font-size: 9px;
        line-height: 1.4;
    }

    .home-page .stock-lines {
        display: flex;
        flex-direction: column;
        gap: 14px;
        margin: 18px 0;
    }

    .home-page .stock-line {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        font-size: 10px;
        line-height: 1.4;
    }

    .home-page .stock-label { color: var(--home-muted); }
    .home-page .stock-value { color: var(--home-text); font-weight: 500; }
    .home-page .stock-value.gold { color: var(--home-gold); }

    .home-page .alert-box {
        padding: 14px 15px;
        border: 1px solid rgba(245,239,225,.035);
        border-radius: 13px;
        background:
            linear-gradient(145deg,rgba(255,255,255,.018),transparent 55%),
            #292a28;
        box-shadow:
            inset 5px 5px 10px rgba(0,0,0,.39),
            inset -2px -2px 6px rgba(255,245,220,.04),
            1px 1px 2px rgba(255,255,255,.012);
    }

    .home-page .alert-title {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 6px;
        color: #dfbf83;
        font-size: 11px;
        font-weight: 600;
    }

    .home-page .alert-copy {
        margin: 0;
        color: var(--home-muted);
        font-size: 9px;
        line-height: 1.55;
    }

    .home-page .transaction-table-wrap {
        width: 100%;
        margin-top: 10px;
        overflow-x: auto;
        scrollbar-width: thin;
    }

    .home-page .balhana-table {
        width: 100%;
        min-width: 490px;
        border-collapse: separate;
        border-spacing: 0 8px;
        font-size: 9px;
    }

    .home-page .balhana-table thead th {
        padding: 10px 11px;
        background: #252624;
        color: #aaa69d;
        font-size: 8px;
        font-weight: 400;
        text-align: left;
        white-space: nowrap;
        box-shadow:
            inset 4px 4px 8px rgba(0,0,0,.42),
            inset -2px -2px 5px rgba(255,245,220,.035);
    }

    .home-page .balhana-table thead th:first-child { border-radius: 10px 0 0 10px; }
    .home-page .balhana-table thead th:last-child { border-radius: 0 10px 10px 0; }

    .home-page .balhana-table tbody td {
        padding: 10px 11px;
        background: linear-gradient(145deg,#30312f,#2c2d2b);
        color: var(--home-muted);
        line-height: 1.45;
        vertical-align: middle;
        box-shadow:
            inset 2px 2px 5px rgba(0,0,0,.23),
            inset -1px -1px 4px rgba(255,245,220,.028),
            0 4px 8px rgba(0,0,0,.15);
    }

    .home-page .balhana-table tbody td:first-child { border-radius: 11px 0 0 11px; }
    .home-page .balhana-table tbody td:last-child { border-radius: 0 11px 11px 0; }

    .home-page .restock-product {
        display: flex;
        align-items: center;
        gap: 13px;
        min-width: 0;
        margin: 17px 0;
    }

    .home-page .restock-photo {
        width: 62px;
        height: 72px;
        flex: 0 0 62px;
        padding: 3px;
        overflow: hidden;
        border: 1px solid rgba(245,239,225,.05);
        border-radius: 14px;
        background: #242422;
        box-shadow:
            inset 4px 4px 8px rgba(0,0,0,.39),
            inset -2px -2px 5px rgba(255,245,220,.035),
            3px 4px 8px rgba(0,0,0,.18);
    }

    .home-page .restock-photo img {
        width: 100%;
        height: 100%;
        border-radius: 10px;
        object-fit: cover;
    }

    .home-page .restock-name {
        margin: 0 0 4px;
        color: var(--home-text);
        font-size: 11px;
        font-weight: 600;
        line-height: 1.4;
    }

    .home-page .restock-detail {
        margin: 0 0 7px;
        color: var(--home-muted);
        font-size: 9px;
        line-height: 1.45;
    }

    .home-page .restock-summary {
        display: flex;
        flex-direction: column;
        gap: 11px;
        margin-bottom: 15px;
        padding-top: 13px;
        border-top: 1px solid rgba(245,239,225,.06);
    }

    .home-page .restock-summary-row {
        display: flex;
        justify-content: space-between;
        gap: 12px;
        color: var(--home-muted);
        font-size: 10px;
        line-height: 1.4;
    }

    .home-page .restock-summary-row strong {
        color: var(--home-text);
        font-weight: 500;
        text-align: right;
    }

    .home-page .restock-button {
        display: inline-flex;
        width: fit-content;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 0 16px;
        color: #29251e;
        font-size: 10px;
        font-weight: 600;
        text-decoration: none;
    }

    .home-page .saved-status {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 1px 0 0;
        color: var(--home-muted);
        font-size: 9px;
        line-height: 1.4;
    }

    @media (max-width: 1100px) {
        .home-page .hero-grid,
        .home-page .two-column-grid,
        .home-page .wide-left-grid {
            grid-template-columns: minmax(0,1fr);
        }

        .home-page .hero-panel { min-height: 250px; }
        .home-page .product-photo { height: 150px; }
    }

    @media (max-width: 700px) {
        .home-page .home-stack { gap: 14px; }
        .home-page .home-grid { gap: 14px; }
        .home-page .home-panel-pad { padding: 16px; }
        .home-page .hero-panel { min-height: 250px; padding: 22px; }
        .home-page .hero-image { width: 72%; }
        .home-page .hero-title { max-width: 300px; }
        .home-page .metric-grid { gap: 10px; }
        .home-page .metric-card { min-height: 104px; padding: 15px; }
        .home-page .metric-icon { top: 14px; right: 14px; }
        .home-page .product-grid { gap: 9px; }
        .home-page .product-photo { height: 112px; }
        .home-page .product-info { padding: 9px 3px 2px; }
        .home-page .interest-breakdown { gap: 14px; }
        .home-page .donut-wrap {
            width: 112px;
            height: 112px;
            flex-basis: 112px;
        }
        .home-page .donut-wrap canvas {
            width: 108px !important;
            height: 108px !important;
        }
    }

    @media (max-width: 480px) {
        .home-page .product-grid { grid-template-columns: minmax(0,1fr); }
        .home-page .product-tile {
            display: grid;
            grid-template-columns: 105px minmax(0,1fr);
            align-items: center;
        }
        .home-page .product-photo { height: 100%; min-height: 105px; }
        .home-page .product-info { padding: 12px; }
        .home-page .section-header { gap: 8px; }
        .home-page .section-link { font-size: 9px; }
        .home-page .interest-breakdown { gap: 12px; }
        .home-page .donut-wrap {
            width: 98px;
            height: 98px;
            flex-basis: 98px;
        }
        .home-page .donut-wrap canvas {
            width: 94px !important;
            height: 94px !important;
        }
        .home-page .chart-legend-row { font-size: 9px; }
    }
</style>

<div class="home-page">
    <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:16px;flex-wrap:wrap;margin-bottom:18px;">
        <div style="min-width:0;">
            <div class="page-breadcrumb">Ruang bisnis / September 2026</div>
            <h1 class="page-title">Beranda</h1>
            <p class="page-subtitle" style="margin-bottom:0;">
                Selamat sore, Nadia. Mari lihat pertumbuhan bisnis Anda.
            </p>
        </div>

        <div style="display:inline-flex;align-items:center;gap:9px;flex:0 0 auto;padding:9px 15px;border:1px solid rgba(245,239,225,.055);border-radius:999px;background:#2b2b29;box-shadow:inset 3px 3px 7px rgba(0,0,0,.30),inset -2px -2px 5px rgba(255,245,220,.04),4px 5px 10px rgba(0,0,0,.24);color:#d3cfc6;font-size:11px;">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#d4b47b" stroke-width="1.8" aria-hidden="true">
                <rect x="3" y="4" width="18" height="17" rx="2"/>
                <path d="M16 2v4M8 2v4M3 10h18"/>
            </svg>
            <span>September 2026</span>
        </div>
    </div>

    <div class="home-stack">
        <section class="home-grid hero-grid" aria-label="Ringkasan bisnis">
            <div class="hero-panel">
                <div class="hero-image">
                    <img src="https://images.unsplash.com/photo-1558769132-cb1aea458c5e?w=900&q=85&fit=crop" alt="">
                </div>

                <div class="hero-copy">
                    <div class="hero-brand">BALHANA</div>
                    <h2 class="hero-title">Kelola Bisnis Reseller Fashion</h2>
                    <p class="hero-description">Dari data minat hingga keputusan restock. Semua dalam satu kendali.</p>
                    <div class="hero-actions">
                        <a href="{{ route('analisis-minat') }}" class="btn-golden">Lihat Analisis</a>
                        <a href="{{ route('produk') }}" class="btn-ghost">Kelola Produk</a>
                    </div>
                </div>
            </div>

            <div class="metric-grid">
                <article class="metric-card">
                    <div class="metric-label">Omzet bulan ini</div>
                    <div class="metric-value">Rp18,72 jt</div>
                    <div class="metric-sub">+18,4% dari Agustus</div>
                    <svg class="metric-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <rect x="3" y="4" width="18" height="18" rx="2"/>
                        <path d="M16 2v4M8 2v4M3 10h18"/>
                    </svg>
                </article>

                <article class="metric-card">
                    <div class="metric-label">Penjualan</div>
                    <div class="metric-value">156 pcs</div>
                    <div class="metric-sub">84 transaksi nyata</div>
                    <svg class="metric-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <rect x="5" y="3" width="14" height="18" rx="2"/>
                        <path d="M9 7h6M9 17h6M12 11v2"/>
                    </svg>
                </article>

                <article class="metric-card">
                    <div class="metric-label">Laba bersih</div>
                    <div class="metric-value">Rp4,68 jt</div>
                    <div class="metric-sub">Margin bersih 25%</div>
                    <svg class="metric-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path d="m3 17 6-6 4 4 8-9"/>
                        <path d="M15 6h6v6"/>
                    </svg>
                </article>

                <article class="metric-card">
                    <div class="metric-label">Total minat</div>
                    <div class="metric-value">428</div>
                    <div class="metric-sub">+24,8% bulan ini</div>
                    <svg class="metric-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.7l-1.1-1.1a5.5 5.5 0 0 0-7.8 7.8l1.1 1.1 7.8 7.7 7.8-7.7 1-1.1a5.5 5.5 0 0 0 0-7.8z"/>
                    </svg>
                </article>
            </div>
        </section>

        <section class="home-grid two-column-grid" aria-label="Performa bisnis">
            <article class="home-panel home-panel-pad">
                <div class="section-header">
                    <div>
                        <h2 class="section-title">Grafik Penjualan</h2>
                        <p class="section-subtitle">Omzet harian • September 2026</p>
                    </div>
                    <div class="sales-summary">
                        <div class="sales-summary-value">Rp18,72 jt</div>
                        <div class="sales-summary-note">Periode ini</div>
                    </div>
                </div>

                <div class="chart-well">
                    <canvas id="salesChart" role="img" aria-label="Grafik penjualan harian bulan September 2026"></canvas>
                </div>

                <div class="chart-dates">
                    <span>01 Sep</span><span>07 Sep</span><span>14 Sep</span><span>21 Sep</span><span>30 Sep</span>
                </div>
            </article>

            <article class="home-panel home-panel-pad">
                <div class="section-header">
                    <div>
                        <h2 class="section-title">Sumber Minat Pelanggan</h2>
                        <p class="section-subtitle">Input manual dari kanal sosial</p>
                    </div>
                </div>

                <div class="interest-breakdown">
                    <div class="donut-wrap">
                        <canvas id="donutChart" width="122" height="122" role="img" aria-label="Sumber minat pelanggan"></canvas>
                        <div class="donut-center">
                            <div class="donut-total">428</div>
                            <div class="donut-caption">Total minat</div>
                        </div>
                    </div>

                    <div class="chart-legend">
                        <div class="chart-legend-row"><span class="chart-legend-dot" style="background:#d4b47b;"></span><span>Facebook <span class="chart-legend-percent">48%</span></span></div>
                        <div class="chart-legend-row"><span class="chart-legend-dot" style="background:#aaa99e;"></span><span>WhatsApp <span class="chart-legend-percent">35%</span></span></div>
                        <div class="chart-legend-row"><span class="chart-legend-dot" style="background:#72736d;"></span><span>Grup jual-beli <span class="chart-legend-percent">17%</span></span></div>
                    </div>
                </div>

                <div class="interest-highlights">
                    <div class="highlight-row"><span class="highlight-label">Produk paling diminati</span><span class="highlight-value gold">Kemeja Linen</span></div>
                    <div class="highlight-row"><span class="highlight-label">Varian favorit</span><span class="highlight-value">L • Hitam</span></div>
                </div>
            </article>
        </section>

        <section class="home-grid wide-left-grid" aria-label="Produk dan persediaan">
            <article class="home-panel home-panel-pad">
                <div class="section-header">
                    <div>
                        <h2 class="section-title">Produk Terlaris</h2>
                        <p class="section-subtitle">Berdasarkan penjualan yang tercatat</p>
                    </div>
                    <a href="{{ route('produk') }}" class="section-link">Lihat produk →</a>
                </div>

                <div class="product-grid">
                    @foreach($produkTerlaris as $produk)
                        <article class="product-tile">
                            <div class="product-photo">
                                <img src="{{ $produk['gambar'] }}" alt="{{ $produk['nama'] }}" loading="lazy">
                            </div>
                            <div class="product-info">
                                <h3 class="product-name">{{ $produk['nama'] }}</h3>
                                <div class="product-sold">{{ $produk['terjual'] }}</div>
                                <div class="product-revenue">{{ $produk['omzet'] }}</div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </article>

            <article class="home-panel home-panel-pad">
                <div class="section-header">
                    <div>
                        <h2 class="section-title">Kesehatan Stok</h2>
                        <p class="section-subtitle">1.284 pcs tersedia • 124 produk</p>
                    </div>
                    <a href="{{ route('stok') }}" class="section-link">Lihat stok →</a>
                </div>

                <div class="stock-lines">
                    <div class="stock-line"><span class="stock-label">Stok aman</span><span class="stock-value">108 produk</span></div>
                    <div class="stock-line"><span class="stock-label">Hampir habis</span><span class="stock-value gold">12 produk</span></div>
                    <div class="stock-line"><span class="stock-label">Stok habis</span><span class="stock-value">4 produk</span></div>
                </div>

                <div class="alert-box">
                    <div class="alert-title">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path d="M12 3 2.8 19a1.3 1.3 0 0 0 1.1 2h16.2a1.3 1.3 0 0 0 1.1-2L12 3z"/>
                            <path d="M12 9v5M12 17h.01"/>
                        </svg>
                        <span>Kemeja Linen perlu restock</span>
                    </div>
                    <p class="alert-copy">Tersisa 8 pcs. Minat bulan ini mencapai 128; dahulukan ukuran L warna Hitam.</p>
                </div>
            </article>
        </section>

        <section class="home-grid wide-left-grid" aria-label="Aktivitas terbaru">
            <article class="home-panel home-panel-pad">
                <div class="section-header">
                    <div>
                        <h2 class="section-title">Transaksi Terbaru</h2>
                        <p class="section-subtitle">3 transaksi terakhir • diperbarui 30 Sep 2026</p>
                    </div>
                    <a href="{{ route('penjualan') }}" class="section-link">Lihat semua →</a>
                </div>

                <div class="transaction-table-wrap">
                    <table class="balhana-table">
                        <thead>
                            <tr><th>Transaksi</th><th>Pelanggan</th><th>Produk</th><th>Total</th><th>Pembayaran</th></tr>
                        </thead>
                        <tbody>
                            @foreach($transaksiTerbaru as $transaksi)
                                <tr>
                                    <td>
                                        <span style="color:#eeeae1;">{{ $transaksi['kode'] }}</span>
                                        <span style="display:block;margin-top:2px;color:#aaa69d;font-size:8px;">{{ $transaksi['tanggal'] }}</span>
                                    </td>
                                    <td>{{ $transaksi['pelanggan'] }}</td>
                                    <td>{{ $transaksi['produk'] }}</td>
                                    <td style="color:#eeeae1;font-weight:500;white-space:nowrap;">{{ $transaksi['total'] }}</td>
                                    <td><span class="{{ $transaksi['statusClass'] }}">{{ $transaksi['status'] }}</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </article>

            <article class="home-panel home-panel-pad">
                <div class="section-header">
                    <div>
                        <h2 class="section-title">Rekomendasi Restock</h2>
                        <p class="section-subtitle">Prioritas berdasarkan minat dan stok</p>
                    </div>
                    <a href="{{ route('rekomendasi-restock') }}" class="section-link">Lihat semua →</a>
                </div>

                <div class="restock-product">
                    <div class="restock-photo">
                        <img src="https://images.unsplash.com/photo-1602810318383-e386cc2a3ccf?w=180&q=85&fit=crop" alt="Kemeja Linen" loading="lazy">
                    </div>
                    <div style="min-width:0;">
                        <h3 class="restock-name">Kemeja Linen</h3>
                        <p class="restock-detail">128 minat • 48 terjual • stok 8</p>
                        <span class="badge-yellow">Prioritas tinggi</span>
                    </div>
                </div>

                <div class="restock-summary">
                    <div class="restock-summary-row"><span>Saran pembelian</span><strong>40 pcs</strong></div>
                    <div class="restock-summary-row"><span>Estimasi modal produk</span><strong>Rp3.600.000</strong></div>
                </div>

                <a href="{{ route('pembelian') }}" class="btn-golden restock-button">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path d="M4 7h16l-1 14H5L4 7z"/>
                        <path d="M9 7V5a3 3 0 0 1 6 0v2"/>
                    </svg>
                    Buat Draft Pembelian
                </a>
            </article>
        </section>

        <footer class="saved-status">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#91a28a" stroke-width="1.8" aria-hidden="true">
                <circle cx="12" cy="12" r="9"/>
                <path d="m8 12 2.5 2.5L16 9"/>
            </svg>
            <span>Data tersimpan • 30 September 2026, 16.45 WIB</span>
        </footer>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    if (typeof Chart === 'undefined') return;

    const salesCanvas = document.getElementById('salesChart');

    if (salesCanvas) {
        const salesLabels = Array.from({ length: 30 }, (_, index) => String(index + 1));
        const salesValues = [
            210,180,320,280,350,310,420,390,460,380,
            420,510,480,550,490,420,580,620,550,640,
            710,680,750,690,800,760,820,780,850,900
        ];

        new Chart(salesCanvas, {
            type: 'line',
            data: {
                labels: salesLabels,
                datasets: [{
                    data: salesValues,
                    borderColor: '#d4b47b',
                    borderWidth: 2,
                    fill: true,
                    backgroundColor: function (context) {
                        const chart = context.chart;
                        const area = chart.chartArea;
                        if (!area) return 'rgba(212,180,123,.12)';

                        const gradient = chart.ctx.createLinearGradient(0, area.top, 0, area.bottom);
                        gradient.addColorStop(0, 'rgba(212,180,123,.24)');
                        gradient.addColorStop(1, 'rgba(212,180,123,.015)');
                        return gradient;
                    },
                    tension: .42,
                    pointRadius: 0,
                    pointHoverRadius: 4,
                    pointHoverBackgroundColor: '#e1c692'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: { intersect: false, mode: 'index' },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#2b2b29',
                        borderColor: 'rgba(212,180,123,.3)',
                        borderWidth: 1,
                        titleColor: '#aaa69d',
                        bodyColor: '#eeeae1',
                        padding: 10,
                        displayColors: false,
                        callbacks: {
                            label: function (context) {
                                return 'Rp' + (Number(context.raw || 0) * 1000).toLocaleString('id-ID');
                            }
                        }
                    }
                },
                scales: {
                    x: { display: false, grid: { display: false } },
                    y: { display: false, grid: { display: false } }
                }
            }
        });
    }

    const donutCanvas = document.getElementById('donutChart');

    if (donutCanvas) {
        new Chart(donutCanvas, {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [48,35,17],
                    backgroundColor: ['#d4b47b','#aaa99e','#72736d'],
                    borderColor: '#2b2b29',
                    borderWidth: 3,
                    hoverOffset: 3
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