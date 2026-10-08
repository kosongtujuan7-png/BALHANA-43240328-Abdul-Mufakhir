@extends('layouts.app')

@section('title', 'Pembelian – BALHANA')

@section('content')
@php
    $pesananAwal = [
        [
            'nomor' => 'PO-2026-001',
            'pemasok' => 'Bahan Linen',
            'status' => 'Dikirim',
            'total' => 3600000,
        ],
        [
            'nomor' => 'PO-2026-002',
            'pemasok' => 'Rayon Premium',
            'status' => 'Menunggu konfirmasi',
            'total' => 2450000,
        ],
        [
            'nomor' => 'PO-2026-003',
            'pemasok' => 'Satin Kulot',
            'status' => 'Dikirim',
            'total' => 1980000,
        ],
        [
            'nomor' => 'PO-2026-004',
            'pemasok' => 'Knit Outer',
            'status' => 'Menunggu konfirmasi',
            'total' => 2100000,
        ],
    ];
@endphp

<style>
    .purchase-page {
        --purchase-bg: #292a28;
        --purchase-raised: #2d2e2c;
        --purchase-inset: #252624;
        --purchase-text: #eeeae1;
        --purchase-muted: #aaa69d;
        --purchase-gold: #d4b47b;
        --purchase-shadow-dark: rgba(12, 13, 12, .48);
        --purchase-shadow-light: rgba(255, 246, 225, .055);
        color: var(--purchase-text);
        min-width: 0;
    }

    .purchase-page,
    .purchase-page * {
        box-sizing: border-box;
    }

    .purchase-page button,
    .purchase-page input,
    .purchase-page select {
        font: inherit;
    }

    .purchase-page > div:first-of-type {
        margin-bottom: 18px !important;
    }

    .purchase-page .page-breadcrumb {
        color: var(--purchase-gold);
        font-size: 9px;
        letter-spacing: .045em;
        text-transform: uppercase;
    }

    .purchase-page .page-title {
        margin-top: 7px;
        margin-bottom: 3px;
        color: var(--purchase-text);
        font-size: clamp(28px, 3vw, 34px);
        line-height: 1.15;
        letter-spacing: -.035em;
    }

    .purchase-page .page-subtitle {
        color: var(--purchase-muted);
        font-size: 12px;
        line-height: 1.5;
    }

    .purchase-page .btn-golden,
    .purchase-page .btn-ghost,
    .purchase-page .neu-tab-btn {
        border: 1px solid rgba(255, 246, 225, .035);
        transition:
            transform .18s ease,
            box-shadow .18s ease,
            background-color .18s ease,
            border-color .18s ease;
    }

    .purchase-page .btn-golden {
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

    .purchase-page .btn-ghost,
    .purchase-page .neu-tab-btn {
        min-height: 36px;
        padding: 0 14px;
        border-radius: 999px;
        background: linear-gradient(145deg, #30312f, #2a2b29);
        color: var(--purchase-text);
        box-shadow:
            5px 5px 10px rgba(12, 13, 12, .37),
            -4px -4px 10px rgba(255, 246, 225, .045),
            inset 1px 1px 1px rgba(255, 255, 255, .025);
        font-size: 10px;
        font-weight: 500;
    }

    .purchase-page .btn-golden:hover,
    .purchase-page .btn-ghost:hover,
    .purchase-page .neu-tab-btn:hover {
        transform: translateY(-1px);
        border-color: rgba(212, 180, 123, .2);
    }

    .purchase-page .btn-golden:active,
    .purchase-page .btn-ghost:active,
    .purchase-page .neu-tab-btn:active {
        transform: translateY(1px);
        box-shadow:
            inset 4px 4px 8px rgba(12, 13, 12, .4),
            inset -3px -3px 7px rgba(255, 246, 225, .035);
    }

    .purchase-page .btn-golden:focus-visible,
    .purchase-page .btn-ghost:focus-visible,
    .purchase-page .neu-tab-btn:focus-visible,
    .purchase-page .neu-input:focus-visible {
        outline: 2px solid rgba(212, 180, 123, .72);
        outline-offset: 2px;
    }

    .purchase-page .purchase-metrics {
        display: grid !important;
        grid-template-columns: repeat(4, minmax(0, 1fr)) !important;
        gap: 12px !important;
        margin-bottom: 16px !important;
    }

    .purchase-page .metric-card,
    .purchase-page .neu-card {
        border: 1px solid rgba(255, 246, 225, .025);
        border-radius: 23px;
        background: linear-gradient(145deg, #30312f, #2c2d2b);
        box-shadow:
            10px 10px 22px var(--purchase-shadow-dark),
            -7px -7px 18px var(--purchase-shadow-light),
            inset 1px 1px 1px rgba(255, 255, 255, .018);
    }

    .purchase-page .metric-card {
        min-height: 122px;
        padding: 19px 20px;
    }

    .purchase-page .metric-label {
        color: var(--purchase-gold);
        font-size: 10px;
    }

    .purchase-page .metric-value {
        margin-top: 9px;
        color: var(--purchase-text);
        font-size: clamp(23px, 2.2vw, 28px);
        line-height: 1.1;
        letter-spacing: -.025em;
    }

    .purchase-page .metric-sub {
        margin-top: 9px;
        color: #b8b1a3;
        font-size: 9px;
        line-height: 1.4;
    }

    .purchase-page .purchase-overview {
        display: grid !important;
        grid-template-columns: minmax(0, 1.15fr) minmax(0, .95fr) !important;
        gap: 16px !important;
        margin-bottom: 16px !important;
        align-items: start !important;
    }

    .purchase-page .neu-card {
        min-width: 0;
        padding: 20px !important;
    }

    .purchase-page .section-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 12px;
    }

    .purchase-page .section-title {
        margin: 0 0 4px;
        color: var(--purchase-text);
        font-size: 14px;
        font-weight: 600;
        line-height: 1.35;
    }

    .purchase-page .section-subtitle {
        margin: 0;
        color: var(--purchase-muted);
        font-size: 10px;
        line-height: 1.5;
    }

    .purchase-page .section-link {
        flex: 0 0 auto;
        color: var(--purchase-gold);
        font-size: 10px;
        text-decoration: none;
        transition: color .18s ease;
    }

    .purchase-page .section-link:hover {
        color: #ead19d;
    }

    .purchase-page .purchase-chart-well {
        height: 180px;
        position: relative;
        padding: 10px;
        overflow: hidden;
        border: 1px solid rgba(255, 246, 225, .025) !important;
        border-radius: 15px !important;
        background: linear-gradient(145deg, #252624, #292a28) !important;
        box-shadow:
            inset 5px 5px 11px rgba(12, 13, 12, .48),
            inset -3px -3px 8px rgba(255, 246, 225, .035) !important;
    }

    .purchase-page .purchase-chart-well canvas {
        width: 100% !important;
        height: 100% !important;
    }

    .purchase-page #restockDraftNotice {
        border: 1px solid rgba(212, 180, 123, .15);
        border-radius: 17px;
        background: linear-gradient(145deg, #30312f, #292a28);
        box-shadow:
            7px 7px 16px var(--purchase-shadow-dark),
            -5px -5px 13px var(--purchase-shadow-light),
            inset 1px 1px 1px rgba(255, 255, 255, .025);
    }

    .purchase-page #restockDraftNotice[hidden] {
        display: none !important;
    }

    .purchase-page .balhana-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 8px;
        color: var(--purchase-muted);
        font-size: 10px;
    }

    .purchase-page .balhana-table thead th {
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

    .purchase-page .balhana-table thead th:first-child {
        border-radius: 12px 0 0 12px;
    }

    .purchase-page .balhana-table thead th:last-child {
        border-radius: 0 12px 12px 0;
    }

    .purchase-page .balhana-table tbody td {
        padding: 12px 13px;
        border-top: 1px solid rgba(255, 246, 225, .018);
        border-bottom: 1px solid rgba(12, 13, 12, .18);
        background: linear-gradient(145deg, #30312f, #2b2c2a);
        color: var(--purchase-muted);
        vertical-align: middle;
        box-shadow:
            4px 5px 11px rgba(12, 13, 12, .23),
            -3px -3px 8px rgba(255, 246, 225, .018);
    }

    .purchase-page .balhana-table tbody td:first-child {
        border-radius: 12px 0 0 12px;
    }

    .purchase-page .balhana-table tbody td:last-child {
        border-radius: 0 12px 12px 0;
    }

    .purchase-page .balhana-table tbody tr[hidden] {
        display: none;
    }

    .purchase-page .badge-yellow,
    .purchase-page .badge-gray {
        display: inline-flex;
        align-items: center;
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

    .purchase-page .badge-yellow {
        color: var(--purchase-gold);
    }

    .purchase-page .badge-gray {
        color: #b4b0a7;
    }

    .purchase-page .neu-tab-container {
        display: flex;
        flex-wrap: wrap;
        gap: 7px;
    }

    .purchase-page .neu-tab-btn {
        min-height: 34px;
        padding: 0 12px;
        color: var(--purchase-muted);
        white-space: nowrap;
    }

    .purchase-page .neu-tab-btn.active,
    .purchase-page .neu-tab-btn[aria-pressed="true"] {
        color: var(--purchase-gold);
        box-shadow:
            inset 3px 3px 7px rgba(12, 13, 12, .35),
            inset -2px -2px 5px rgba(255, 246, 225, .025),
            1px 1px 2px rgba(255, 246, 225, .02);
    }

    .purchase-page .neu-input {
        width: 100%;
        min-height: 40px;
        padding: 10px 13px;
        border: 1px solid rgba(255, 246, 225, .025);
        border-radius: 12px;
        background: linear-gradient(145deg, #252624, #292a28);
        color: var(--purchase-text);
        box-shadow:
            inset 5px 5px 10px rgba(12, 13, 12, .46),
            inset -3px -3px 8px rgba(255, 246, 225, .025);
        font-size: 11px;
        transition: border-color .18s ease, box-shadow .18s ease;
    }

    .purchase-page .neu-input::placeholder {
        color: #8f8b83;
        opacity: 1;
    }

    .purchase-page .neu-input:focus {
        border-color: rgba(212, 180, 123, .28);
        box-shadow:
            inset 4px 4px 8px rgba(12, 13, 12, .4),
            inset -2px -2px 6px rgba(255, 246, 225, .025),
            0 0 0 2px rgba(212, 180, 123, .08);
    }

    .purchase-page select.neu-input {
        color-scheme: dark;
    }

    .purchase-page #purchaseEmptyState {
        border-radius: 14px;
        background: linear-gradient(145deg, #292a28, #252624);
        box-shadow:
            inset 4px 4px 8px rgba(12, 13, 12, .32),
            inset -2px -2px 5px rgba(255, 246, 225, .02);
    }

    .purchase-page #purchaseTableCount {
        border-top-color: rgba(255, 246, 225, .055) !important;
    }

    .purchase-page dialog#purchaseDialog {
        border: 1px solid rgba(255, 246, 225, .06) !important;
        border-radius: 22px !important;
        background: linear-gradient(145deg, #30312f, #292a28) !important;
        color: var(--purchase-text) !important;
        box-shadow:
            22px 22px 55px rgba(0, 0, 0, .58),
            -8px -8px 24px rgba(255, 246, 225, .06),
            inset 1px 1px 1px rgba(255, 255, 255, .035) !important;
    }

    .purchase-page dialog#purchaseDialog::backdrop {
        background: rgba(14, 15, 14, .72);
        backdrop-filter: blur(3px);
    }

    .purchase-page dialog#purchaseDialog[open] {
        animation: purchase-dialog-in .18s ease-out;
    }

    @keyframes purchase-dialog-in {
        from {
            opacity: 0;
            transform: translateY(7px) scale(.99);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .purchase-page #purchaseFormStatus {
        color: var(--purchase-muted) !important;
    }

    @media (max-width: 1050px) {
        .purchase-page .purchase-metrics {
            grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
        }

        .purchase-page .purchase-overview {
            grid-template-columns: minmax(0, 1fr) !important;
        }
    }

    @media (max-width: 620px) {
        .purchase-page .purchase-metrics {
            gap: 10px !important;
        }

        .purchase-page .metric-card {
            min-height: 108px;
            padding: 15px !important;
            border-radius: 18px;
        }

        .purchase-page .neu-card {
            padding: 16px !important;
            border-radius: 19px;
        }

        .purchase-page .section-header {
            flex-wrap: wrap;
        }

        .purchase-page #purchaseStatusFilters {
            width: 100%;
        }

        .purchase-page #purchaseStatusFilters .neu-tab-btn {
            flex: 1 1 auto;
        }

        .purchase-page dialog#purchaseDialog > div {
            padding: 18px !important;
        }

        .purchase-page #purchaseForm [style*="grid-template-columns"] {
            grid-template-columns: minmax(0, 1fr) !important;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .purchase-page *,
        .purchase-page *::before,
        .purchase-page *::after {
            scroll-behavior: auto !important;
            animation-duration: .01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: .01ms !important;
        }
    }
</style>

<div class="purchase-page">
    <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:16px;flex-wrap:wrap;margin-bottom:18px;">
        <div style="min-width:0;">
            <div class="page-breadcrumb">Ruang bisnis / September 2026</div>
            <h1 class="page-title">Pembelian</h1>
            <p class="page-subtitle" style="margin-bottom:0;">
                Kelola pesanan pembelian, pemasok, pengeluaran, dan tindakan pembelian.
            </p>
        </div>

        <button id="openPurchaseDialog" class="btn-golden" type="button">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                <path d="M12 5v14M5 12h14"/>
            </svg>
            Buat Pesanan Pembelian
        </button>
    </div>

    <div id="restockDraftNotice" hidden class="alert-box" style="display:flex;align-items:center;justify-content:space-between;gap:14px;flex-wrap:wrap;margin-bottom:16px;padding:14px 16px;">
        <div>
            <div style="color:#dfbf83;font-size:11px;font-weight:600;">Draft restock tersedia</div>
            <div id="restockDraftText" style="margin-top:3px;color:#aaa69d;font-size:10px;line-height:1.5;"></div>
        </div>
        <button id="useRestockDraft" class="btn-ghost" type="button">Gunakan Draft</button>
    </div>

    {{-- Ringkasan --}}
    <section class="purchase-metrics" style="display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:12px;margin-bottom:16px;" aria-label="Ringkasan pembelian">
        <article class="metric-card">
            <div class="metric-label">Pesanan aktif</div>
            <div class="metric-value">12</div>
            <div class="metric-sub">4 menunggu konfirmasi</div>
        </article>

        <article class="metric-card">
            <div class="metric-label">Pemasok aktif</div>
            <div class="metric-value">8</div>
            <div class="metric-sub">2 pemasok prioritas</div>
        </article>

        <article class="metric-card">
            <div class="metric-label">Pengeluaran bulan ini</div>
            <div class="metric-value" style="font-size:clamp(19px,2vw,25px);">Rp18,72 jt</div>
            <div class="metric-sub">+12,4% dari Agustus</div>
        </article>

        <article class="metric-card">
            <div class="metric-label">Alokasi tersisa</div>
            <div class="metric-value" style="font-size:clamp(19px,2vw,25px);">Rp8 jt</div>
            <div class="metric-sub">32% dari anggaran</div>
        </article>
    </section>

    {{-- Grafik, pemasok, dan pesanan terbaru --}}
    <section class="purchase-overview" style="display:grid;grid-template-columns:minmax(0,1.15fr) minmax(0,.95fr);gap:16px;margin-bottom:16px;align-items:start;">
        <div style="display:flex;flex-direction:column;gap:16px;">
            <article class="neu-card" style="padding:20px;">
                <div style="margin-bottom:15px;">
                    <h2 class="section-title">Ringkasan Pembelian</h2>
                    <p class="section-subtitle">12 pesanan aktif • 8 pemasok aktif • 88 pcs dalam proses</p>
                </div>

                <div class="purchase-chart-well" style="height:180px;position:relative;padding:10px;border:1px solid rgba(245,239,225,.035);border-radius:15px;background:#252523;box-shadow:inset 3px 3px 7px rgba(0,0,0,.3),inset -1px -1px 3px rgba(255,245,220,.02);">
                    <canvas id="pembelianChart" role="img" aria-label="Grafik pembelian bulan September 2026">
                        Grafik pembelian bulan September 2026.
                    </canvas>
                </div>

                <div style="display:flex;justify-content:space-between;gap:8px;margin-top:10px;color:#aaa69d;font-size:9px;">
                    <span>01 Sep</span>
                    <span>07 Sep</span>
                    <span>14 Sep</span>
                    <span>21 Sep</span>
                    <span>30 Sep</span>
                </div>
            </article>

            <article class="neu-card" style="padding:20px;">
                <div style="margin-bottom:16px;">
                    <h2 class="section-title">Pengeluaran Pembelian</h2>
                    <p class="section-subtitle">Belum termasuk ongkir dan biaya administrasi</p>
                </div>

                <div style="display:flex;flex-direction:column;gap:13px;">
                    <div style="display:flex;justify-content:space-between;gap:12px;font-size:11px;">
                        <span style="color:#aaa69d;">Total pengeluaran</span>
                        <span style="color:#eeeae1;font-weight:500;">Rp18,72 jt</span>
                    </div>
                    <div style="display:flex;justify-content:space-between;gap:12px;font-size:11px;">
                        <span style="color:#aaa69d;">Biaya tambahan</span>
                        <span style="color:#d4b47b;font-weight:500;">Rp1,12 jt</span>
                    </div>
                    <div style="display:flex;justify-content:space-between;gap:12px;font-size:11px;">
                        <span style="color:#aaa69d;">Alokasi tersisa</span>
                        <span style="color:#eeeae1;font-weight:500;">Rp8 jt</span>
                    </div>
                </div>
            </article>
        </div>

        <div style="display:flex;flex-direction:column;gap:16px;">
            <article class="neu-card" style="padding:20px;">
                <div class="section-header">
                    <div>
                        <h2 class="section-title">Status Pemasok</h2>
                        <p class="section-subtitle">8 pemasok aktif • 2 pemasok prioritas</p>
                    </div>
                    <a href="#purchaseTransactions" class="section-link">Kelola pemasok →</a>
                </div>

                <div style="display:flex;flex-direction:column;gap:13px;margin-top:5px;">
                    <div style="display:flex;justify-content:space-between;gap:12px;font-size:11px;">
                        <span style="color:#aaa69d;">Pemasok prioritas</span>
                        <span style="color:#d4b47b;font-weight:500;">2 pemasok</span>
                    </div>
                    <div style="display:flex;justify-content:space-between;gap:12px;font-size:11px;">
                        <span style="color:#aaa69d;">Pemasok reguler</span>
                        <span style="color:#eeeae1;font-weight:500;">6 pemasok</span>
                    </div>
                    <div style="display:flex;justify-content:space-between;gap:12px;font-size:11px;">
                        <span style="color:#aaa69d;">Pemasok perlu tindak lanjut</span>
                        <span style="color:#d4a27f;font-weight:500;">1 pemasok</span>
                    </div>
                </div>
            </article>

            <article class="neu-card" style="padding:20px;">
                <div class="section-header">
                    <div>
                        <h2 class="section-title">Pesanan Pembelian</h2>
                        <p class="section-subtitle">4 pesanan terbaru • 88 pcs dalam proses</p>
                    </div>
                    <a href="#purchaseTransactions" class="section-link">Lihat semua →</a>
                </div>

                <div style="max-width:100%;overflow-x:auto;margin-top:8px;">
                    <table class="balhana-table" style="min-width:500px;">
                        <thead>
                            <tr>
                                <th>Pesanan</th>
                                <th>Pemasok</th>
                                <th>Status</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody id="recentOrdersBody">
                            @foreach($pesananAwal as $pesanan)
                                <tr>
                                    <td style="color:#d3cfc6;white-space:nowrap;">{{ $pesanan['nomor'] }}</td>
                                    <td>{{ $pesanan['pemasok'] }}</td>
                                    <td style="color:{{ $pesanan['status'] === 'Dikirim' ? '#d4b47b' : '#aaa69d' }};">
                                        {{ $pesanan['status'] }}
                                    </td>
                                    <td style="color:#eeeae1;white-space:nowrap;">Rp{{ number_format($pesanan['total'], 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </article>
        </div>
    </section>

    {{-- Tabel transaksi pembelian --}}
    <section id="purchaseTransactions" class="neu-card" style="padding:20px;">
        <div class="section-header">
            <div>
                <h2 class="section-title">Tabel Transaksi Pembelian</h2>
                <p class="section-subtitle">12 transaksi • 88 pcs dalam proses</p>
            </div>
        </div>

        <div style="display:flex;align-items:center;gap:11px;flex-wrap:wrap;margin:14px 0;">
            <label style="position:relative;display:block;flex:1 1 260px;min-width:min(100%,220px);">
                <svg style="position:absolute;top:50%;left:14px;transform:translateY(-50%);color:#d4b47b;pointer-events:none;" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <circle cx="11" cy="11" r="8"/>
                    <path d="m21 21-4.35-4.35"/>
                </svg>
                <input id="purchaseSearch" type="search" class="neu-input" placeholder="Cari pesanan pembelian..." aria-label="Cari pesanan pembelian" autocomplete="off" style="min-height:40px;padding-left:40px;border-radius:999px;">
            </label>

            <div id="purchaseStatusFilters" class="neu-tab-container" role="group" aria-label="Filter status pesanan">
                <button type="button" class="neu-tab-btn active" data-purchase-status="semua" aria-pressed="true">Semua status</button>
                <button type="button" class="neu-tab-btn" data-purchase-status="Dikirim" aria-pressed="false">Dikirim</button>
                <button type="button" class="neu-tab-btn" data-purchase-status="Menunggu konfirmasi" aria-pressed="false">Menunggu konfirmasi</button>
            </div>
        </div>

        <div style="max-width:100%;overflow-x:auto;">
            <table class="balhana-table" style="min-width:640px;">
                <thead>
                    <tr>
                        <th>Pesanan</th>
                        <th>Pemasok</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody id="purchaseTableBody">
                    @foreach($pesananAwal as $pesanan)
                        <tr
                            data-purchase-row
                            data-status="{{ $pesanan['status'] }}"
                            data-search="{{ strtolower($pesanan['nomor'].' '.$pesanan['pemasok'].' '.$pesanan['status'].' '.$pesanan['total']) }}"
                        >
                            <td style="color:#eeeae1;font-weight:500;white-space:nowrap;">{{ $pesanan['nomor'] }}</td>
                            <td style="color:#aaa69d;">{{ $pesanan['pemasok'] }}</td>
                            <td>
                                <span class="{{ $pesanan['status'] === 'Dikirim' ? 'badge-yellow' : 'badge-gray' }}">
                                    {{ $pesanan['status'] }}
                                </span>
                            </td>
                            <td style="color:#eeeae1;white-space:nowrap;">Rp{{ number_format($pesanan['total'], 0, ',', '.') }}</td>
                            <td>
                                <button type="button" class="btn-ghost" data-order-detail="{{ $pesanan['nomor'] }}" style="min-height:30px;padding:6px 10px;font-size:9px;">
                                    Lihat detail
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div id="purchaseEmptyState" hidden style="padding:25px 12px;text-align:center;color:#aaa69d;font-size:11px;">
            Tidak ada pesanan yang cocok dengan pencarian atau filter ini.
        </div>

        <div id="purchaseTableCount" style="margin-top:12px;padding-top:11px;border-top:1px solid rgba(245,239,225,.05);color:#aaa69d;font-size:9px;">
            Menampilkan 4 data • diperbarui 30 Sep 2026
        </div>
    </section>

    {{-- Dialog pembuatan pesanan --}}
    <dialog id="purchaseDialog" style="width:min(520px,calc(100% - 28px));max-width:520px;padding:0;border:1px solid rgba(245,239,225,.08);border-radius:22px;background:#2b2b29;color:#eeeae1;box-shadow:0 24px 70px rgba(0,0,0,.58);">
        <div style="padding:22px;">
            <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:12px;margin-bottom:18px;">
                <div>
                    <h2 style="margin:0 0 4px;font-size:17px;font-weight:600;">Buat Pesanan Pembelian</h2>
                    <p style="margin:0;color:#aaa69d;font-size:10px;">Isi detail pemasok dan pesanan.</p>
                </div>
                <button id="closePurchaseDialog" class="btn-ghost" type="button" aria-label="Tutup" style="min-width:36px;width:36px;min-height:36px;padding:0;">×</button>
            </div>

            <form id="purchaseForm">
                <div style="display:flex;flex-direction:column;gap:13px;">
                    <div>
                        <label for="purchaseSupplier" style="display:block;margin-bottom:6px;color:#aaa69d;font-size:10px;">Pemasok</label>
                        <select id="purchaseSupplier" class="neu-input" required>
                            <option value="CV Sinar Fashion">CV Sinar Fashion</option>
                            <option value="Bahan Linen">Bahan Linen</option>
                            <option value="Rayon Premium">Rayon Premium</option>
                            <option value="Satin Kulot">Satin Kulot</option>
                            <option value="Knit Outer">Knit Outer</option>
                        </select>
                    </div>

                    <div>
                        <label for="purchaseProduct" style="display:block;margin-bottom:6px;color:#aaa69d;font-size:10px;">Produk</label>
                        <select id="purchaseProduct" class="neu-input" required>
                            <option value="Kemeja Linen">Kemeja Linen</option>
                            <option value="Tunik Aira">Tunik Aira</option>
                            <option value="Celana Kulot">Celana Kulot</option>
                            <option value="Outer Knit">Outer Knit</option>
                        </select>
                    </div>

                    <div style="display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:12px;">
                        <div>
                            <label for="purchaseQuantity" style="display:block;margin-bottom:6px;color:#aaa69d;font-size:10px;">Jumlah (pcs)</label>
                            <input id="purchaseQuantity" type="number" class="neu-input" min="1" max="10000" value="40" required>
                        </div>
                        <div>
                            <label for="purchaseUnitPrice" style="display:block;margin-bottom:6px;color:#aaa69d;font-size:10px;">Harga beli / pcs</label>
                            <input id="purchaseUnitPrice" type="number" class="neu-input" min="1" step="1000" value="90000" required>
                        </div>
                    </div>

                    <div style="display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:12px;">
                        <div>
                            <label for="purchaseShipping" style="display:block;margin-bottom:6px;color:#aaa69d;font-size:10px;">Estimasi ongkir</label>
                            <input id="purchaseShipping" type="number" class="neu-input" min="0" step="1000" value="100000">
                        </div>
                        <div>
                            <label for="purchaseExtraCost" style="display:block;margin-bottom:6px;color:#aaa69d;font-size:10px;">Biaya lainnya</label>
                            <input id="purchaseExtraCost" type="number" class="neu-input" min="0" step="1000" value="20000">
                        </div>
                    </div>

                    <div style="display:flex;justify-content:space-between;gap:12px;padding-top:12px;border-top:1px solid rgba(245,239,225,.06);font-size:11px;">
                        <span style="color:#aaa69d;">Total perkiraan</span>
                        <strong id="purchaseEstimate" style="color:#d4b47b;">Rp3.720.000</strong>
                    </div>

                    <p id="purchaseFormStatus" role="status" aria-live="polite" style="margin:0;color:#aaa69d;font-size:9px;line-height:1.5;"></p>

                    <div style="display:flex;justify-content:flex-end;flex-wrap:wrap;gap:9px;margin-top:3px;">
                        <button id="cancelPurchase" class="btn-ghost" type="button">Batal</button>
                        <button class="btn-golden" type="submit">Simpan Pesanan</button>
                    </div>
                </div>
            </form>
        </div>
    </dialog>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const ordersStorageKey = 'balhana.pembelian.orders.v1';
    const restockDraftKey = 'balhana.draft-pembelian.v1';

    const dialog = document.getElementById('purchaseDialog');
    const form = document.getElementById('purchaseForm');
    const search = document.getElementById('purchaseSearch');
    const statusFilters = document.getElementById('purchaseStatusFilters');
    const emptyState = document.getElementById('purchaseEmptyState');
    const tbody = document.getElementById('purchaseTableBody');

    let activeStatus = 'semua';
    let orderSequence = 5;

    function formatRupiah(value) {
        return 'Rp' + Math.round(value).toLocaleString('id-ID');
    }

    function estimatePurchase() {
        const quantity = Number(document.getElementById('purchaseQuantity').value) || 0;
        const unitPrice = Number(document.getElementById('purchaseUnitPrice').value) || 0;
        const shipping = Number(document.getElementById('purchaseShipping').value) || 0;
        const extra = Number(document.getElementById('purchaseExtraCost').value) || 0;

        document.getElementById('purchaseEstimate').textContent =
            formatRupiah(quantity * unitPrice + shipping + extra);
    }

    function getLocalOrders() {
        try {
            const value = JSON.parse(localStorage.getItem(ordersStorageKey) || '[]');
            return Array.isArray(value) ? value : [];
        } catch (error) {
            return [];
        }
    }

    function addOrderRow(order) {
        const row = document.createElement('tr');
        row.dataset.purchaseRow = '';
        row.dataset.status = order.status;
        row.dataset.search = [
            order.nomor,
            order.pemasok,
            order.status,
            order.total,
            order.produk
        ].join(' ').toLocaleLowerCase('id-ID');

        const values = [
            { text: order.nomor, style: 'color:#eeeae1;font-weight:500;white-space:nowrap;' },
            { text: order.pemasok, style: 'color:#aaa69d;' },
            { text: order.status, style: '' },
            { text: formatRupiah(order.total), style: 'color:#eeeae1;white-space:nowrap;' }
        ];

        values.forEach(function (value, index) {
            const cell = document.createElement('td');
            cell.style.cssText = value.style;

            if (index === 2) {
                const badge = document.createElement('span');
                badge.className = 'badge-gray';
                badge.textContent = value.text;
                cell.appendChild(badge);
            } else {
                cell.textContent = value.text;
            }

            row.appendChild(cell);
        });

        const actionCell = document.createElement('td');
        const detailButton = document.createElement('button');
        detailButton.type = 'button';
        detailButton.className = 'btn-ghost';
        detailButton.dataset.orderDetail = order.nomor;
        detailButton.style.cssText = 'min-height:30px;padding:6px 10px;font-size:9px;';
        detailButton.textContent = 'Lihat detail';
        actionCell.appendChild(detailButton);
        row.appendChild(actionCell);

        tbody.prepend(row);
    }

    function filterOrders() {
        const query = (search.value || '').trim().toLocaleLowerCase('id-ID');
        const rows = Array.from(document.querySelectorAll('[data-purchase-row]'));
        let visible = 0;

        rows.forEach(function (row) {
            const matchesStatus = activeStatus === 'semua' || row.dataset.status === activeStatus;
            const matchesSearch = !query || (row.dataset.search || '').includes(query);
            const show = matchesStatus && matchesSearch;

            row.hidden = !show;

            if (show) {
                visible += 1;
            }
        });

        emptyState.hidden = visible !== 0;
        document.getElementById('purchaseTableCount').textContent =
            'Menampilkan ' + visible + ' data • diperbarui 30 Sep 2026';
    }

    function openDialog() {
        if (typeof dialog.showModal === 'function') {
            dialog.showModal();
        } else {
            dialog.setAttribute('open', '');
        }
        document.getElementById('purchaseSupplier').focus();
    }

    function closeDialog() {
        if (typeof dialog.close === 'function') {
            dialog.close();
        } else {
            dialog.removeAttribute('open');
        }
    }

    document.getElementById('openPurchaseDialog').addEventListener('click', openDialog);
    document.getElementById('closePurchaseDialog').addEventListener('click', closeDialog);
    document.getElementById('cancelPurchase').addEventListener('click', closeDialog);

    dialog.addEventListener('click', function (event) {
        if (event.target === dialog) {
            closeDialog();
        }
    });

    ['purchaseQuantity', 'purchaseUnitPrice', 'purchaseShipping', 'purchaseExtraCost'].forEach(function (id) {
        document.getElementById(id).addEventListener('input', estimatePurchase);
    });

    search.addEventListener('input', filterOrders);

    statusFilters.addEventListener('click', function (event) {
        const button = event.target.closest('[data-purchase-status]');

        if (!button) {
            return;
        }

        activeStatus = button.dataset.purchaseStatus || 'semua';

        statusFilters.querySelectorAll('[data-purchase-status]').forEach(function (filterButton) {
            const isActive = filterButton === button;
            filterButton.classList.toggle('active', isActive);
            filterButton.setAttribute('aria-pressed', isActive ? 'true' : 'false');
        });

        filterOrders();
    });

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        if (!form.reportValidity()) {
            return;
        }

        const supplier = document.getElementById('purchaseSupplier').value;
        const product = document.getElementById('purchaseProduct').value;
        const quantity = Number(document.getElementById('purchaseQuantity').value);
        const unitPrice = Number(document.getElementById('purchaseUnitPrice').value);
        const shipping = Number(document.getElementById('purchaseShipping').value) || 0;
        const extra = Number(document.getElementById('purchaseExtraCost').value) || 0;
        const total = quantity * unitPrice + shipping + extra;
        const number = 'PO-2026-' + String(orderSequence++).padStart(3, '0');

        const order = {
            nomor: number,
            pemasok: supplier,
            produk: product,
            jumlah: quantity,
            status: 'Menunggu konfirmasi',
            total: total,
            dibuatPada: new Date().toISOString()
        };

        const orders = getLocalOrders();
        orders.push(order);

        try {
            localStorage.setItem(ordersStorageKey, JSON.stringify(orders));
        } catch (error) {
            document.getElementById('purchaseFormStatus').textContent =
                'Pesanan tidak dapat disimpan di browser ini.';
            return;
        }

        addOrderRow(order);
        document.getElementById('purchaseFormStatus').textContent =
            'Pesanan ' + number + ' tersimpan di browser ini; belum dikirim ke database.';
        filterOrders();

        window.setTimeout(closeDialog, 900);
    });

    document.addEventListener('click', function (event) {
        const button = event.target.closest('[data-order-detail]');

        if (!button) {
            return;
        }

        const orderNumber = button.dataset.orderDetail;
        const row = button.closest('tr');
        const cells = row ? row.querySelectorAll('td') : [];

        if (cells.length >= 4) {
            const message = orderNumber + '\n' +
                'Pemasok: ' + cells[1].textContent.trim() + '\n' +
                'Status: ' + cells[2].textContent.trim() + '\n' +
                'Total: ' + cells[3].textContent.trim();

            window.alert(message);
        }
    });

    const restockNotice = document.getElementById('restockDraftNotice');

    try {
        const draft = JSON.parse(localStorage.getItem(restockDraftKey) || 'null');

        if (draft && draft.produk && Number(draft.jumlah) > 0) {
            restockNotice.hidden = false;
            document.getElementById('restockDraftText').textContent =
                draft.produk + ' • ' + Number(draft.jumlah).toLocaleString('id-ID') +
                ' pcs • estimasi produk ' + formatRupiah(Number(draft.jumlah) * Number(draft.hargaBeliPerPcs || 0));

            document.getElementById('useRestockDraft').addEventListener('click', function () {
                document.getElementById('purchaseProduct').value = draft.produk;
                document.getElementById('purchaseQuantity').value = draft.jumlah;
                document.getElementById('purchaseUnitPrice').value = draft.hargaBeliPerPcs || 90000;
                document.getElementById('purchaseSupplier').value = draft.supplier || 'CV Sinar Fashion';
                estimatePurchase();
                openDialog();
            });
        }
    } catch (error) {
        restockNotice.hidden = true;
    }

    const chartCanvas = document.getElementById('pembelianChart');

    if (chartCanvas && typeof Chart !== 'undefined') {
        const values = [10, 12, 11, 14, 16, 15, 18, 17, 14, 16, 15, 19, 16, 14, 17];

        new Chart(chartCanvas, {
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
                    x: { display: false, grid: { display: false } },
                    y: { display: false, grid: { display: false } }
                }
            }
        });
    }

    const savedOrders = getLocalOrders();
    savedOrders.slice().reverse().forEach(addOrderRow);
    filterOrders();
});
</script>
@endpush