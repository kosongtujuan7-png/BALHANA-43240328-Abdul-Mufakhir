@extends('layouts.app')

@section('title', 'Keuangan – BALHANA')

@section('content')
@php
    $transaksiAwal = [
        [
            'tanggal' => '2026-09-30',
            'jenis' => 'Pemasukan',
            'keterangan' => 'Penjualan Kemeja Linen',
            'nominal' => 1280000,
            'akun' => 'Kas utama',
            'status' => 'Selesai',
        ],
        [
            'tanggal' => '2026-09-29',
            'jenis' => 'Pengeluaran',
            'keterangan' => 'Pembelian Tunik Aira',
            'nominal' => 960000,
            'akun' => 'Pembelian',
            'status' => 'Selesai',
        ],
        [
            'tanggal' => '2026-09-28',
            'jenis' => 'Pemasukan',
            'keterangan' => 'Penjualan Outer Knit',
            'nominal' => 840000,
            'akun' => 'Kas utama',
            'status' => 'Selesai',
        ],
        [
            'tanggal' => '2026-09-27',
            'jenis' => 'Pengeluaran',
            'keterangan' => 'Biaya promosi Instagram',
            'nominal' => 450000,
            'akun' => 'Instagram',
            'status' => 'Selesai',
        ],
        [
            'tanggal' => '2026-09-26',
            'jenis' => 'Pemasukan',
            'keterangan' => 'Penjualan Celana Kulot',
            'nominal' => 620000,
            'akun' => 'Kas utama',
            'status' => 'Selesai',
        ],
    ];

    $komposisiBiaya = [
        ['label' => 'Pembelian produk', 'persen' => 40, 'warna' => '#d4b47b'],
        ['label' => 'Biaya operasional', 'persen' => 30, 'warna' => '#aaa99e'],
        ['label' => 'Biaya promosi', 'persen' => 15, 'warna' => '#77766f'],
        ['label' => 'Biaya lain-lain', 'persen' => 15, 'warna' => '#55544f'],
    ];
@endphp

<style>
    .finance-page {
        --finance-text: #eeeae1;
        --finance-muted: #aaa69d;
        --finance-gold: #d4b47b;
        min-width: 0;
        color: var(--finance-text);
    }

    .finance-page,
    .finance-page * {
        box-sizing: border-box;
    }

    .finance-page .page-breadcrumb {
        color: var(--finance-gold);
        font-size: 9px;
        letter-spacing: .045em;
        text-transform: uppercase;
    }

    .finance-page .page-title {
        margin: 7px 0 3px;
        color: var(--finance-text);
        font-size: clamp(28px, 3vw, 34px);
        line-height: 1.15;
        letter-spacing: -.035em;
    }

    .finance-page .page-subtitle {
        color: var(--finance-muted);
        font-size: 12px;
        line-height: 1.5;
    }

    .finance-page .finance-period {
        border: 1px solid rgba(255, 246, 225, .035) !important;
        background: linear-gradient(145deg, #30312f, #2a2b29) !important;
        box-shadow:
            7px 7px 15px rgba(12, 13, 12, .38),
            -5px -5px 13px rgba(255, 246, 225, .055),
            inset 1px 1px 1px rgba(255, 255, 255, .025) !important;
    }

    .finance-page .finance-metrics {
        display: grid !important;
        grid-template-columns: repeat(4, minmax(0, 1fr)) !important;
        gap: 12px !important;
        margin-bottom: 16px !important;
    }

    .finance-page .metric-card,
    .finance-page .neu-card {
        min-width: 0;
        border: 1px solid rgba(255, 246, 225, .025);
        border-radius: 23px;
        background: linear-gradient(145deg, #30312f, #2b2c2a);
        box-shadow:
            10px 10px 22px rgba(12, 13, 12, .46),
            -7px -7px 18px rgba(255, 246, 225, .055),
            inset 1px 1px 1px rgba(255, 255, 255, .018);
    }

    .finance-page .metric-card {
        min-height: 122px;
        padding: 19px 20px !important;
    }

    .finance-page .metric-label {
        color: var(--finance-gold);
        font-size: 10px;
    }

    .finance-page .metric-value {
        margin-top: 9px;
        color: var(--finance-text);
        font-size: clamp(19px, 2vw, 25px);
        line-height: 1.15;
        letter-spacing: -.025em;
    }

    .finance-page .metric-sub {
        margin-top: 8px;
        color: var(--finance-muted);
        font-size: 9px;
        line-height: 1.45;
    }

    .finance-page .finance-overview {
        display: grid !important;
        grid-template-columns: minmax(0, 1.15fr) minmax(0, .95fr) !important;
        gap: 16px !important;
        margin-bottom: 16px !important;
        align-items: stretch !important;
    }

    .finance-page .neu-card {
        padding: 20px !important;
    }

    .finance-page .section-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 12px;
    }

    .finance-page .section-title {
        margin: 0 0 4px;
        color: var(--finance-text);
        font-size: 14px;
        font-weight: 600;
        line-height: 1.35;
    }

    .finance-page .section-subtitle {
        margin: 0;
        color: var(--finance-muted);
        font-size: 10px;
        line-height: 1.5;
    }

    .finance-page .section-link {
        flex: 0 0 auto;
        color: var(--finance-gold);
        font-size: 10px;
        text-decoration: none;
        transition: color .18s ease;
    }

    .finance-page .section-link:hover {
        color: #ead19d;
    }

    .finance-page .finance-chart-well {
        overflow: hidden;
        border: 1px solid rgba(255, 246, 225, .025) !important;
        border-radius: 15px !important;
        background: linear-gradient(145deg, #252624, #292a28) !important;
        box-shadow:
            inset 5px 5px 11px rgba(12, 13, 12, .48),
            inset -3px -3px 8px rgba(255, 246, 225, .035) !important;
    }

    .finance-page .finance-chart-well canvas {
        width: 100% !important;
        height: 100% !important;
    }

    .finance-page .finance-donut-well {
        border: 1px solid rgba(255, 246, 225, .025) !important;
        background: linear-gradient(145deg, #252624, #292a28) !important;
        box-shadow:
            inset 5px 5px 11px rgba(12, 13, 12, .42),
            inset -3px -3px 8px rgba(255, 246, 225, .025) !important;
    }

    .finance-page .chart-legend-dot {
        display: inline-block;
        width: 8px;
        height: 8px;
        flex: 0 0 8px;
        border-radius: 50%;
        box-shadow:
            1px 1px 3px rgba(12, 13, 12, .3),
            -1px -1px 2px rgba(255, 246, 225, .06);
    }

    .finance-page .finance-budget-progress {
        background: linear-gradient(145deg, #252624, #292a28) !important;
        box-shadow:
            inset 3px 3px 6px rgba(12, 13, 12, .45),
            inset -2px -2px 4px rgba(255, 246, 225, .025) !important;
    }

    .finance-page .finance-budget-progress > div {
        background: linear-gradient(90deg, #b99a65, #e0c38b) !important;
        box-shadow:
            0 0 7px rgba(212, 180, 123, .16),
            inset 1px 1px 2px rgba(255, 255, 255, .2);
    }

    .finance-page .btn-golden,
    .finance-page .btn-ghost,
    .finance-page .neu-tab-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        border: 1px solid rgba(255, 246, 225, .035);
        transition:
            transform .18s ease,
            box-shadow .18s ease,
            background-color .18s ease,
            border-color .18s ease;
        text-decoration: none;
    }

    .finance-page .btn-golden {
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

    .finance-page .btn-ghost {
        min-height: 36px;
        padding: 0 14px;
        border-radius: 999px;
        background: linear-gradient(145deg, #30312f, #292a28);
        color: var(--finance-text);
        box-shadow:
            5px 5px 10px rgba(12, 13, 12, .37),
            -4px -4px 10px rgba(255, 246, 225, .045),
            inset 1px 1px 1px rgba(255, 255, 255, .025);
        font-size: 10px;
        font-weight: 500;
    }

    .finance-page .btn-golden:hover,
    .finance-page .btn-ghost:hover {
        transform: translateY(-1px);
        border-color: rgba(212, 180, 123, .2);
    }

    .finance-page .btn-golden:active,
    .finance-page .btn-ghost:active {
        transform: translateY(1px);
        box-shadow:
            inset 4px 4px 8px rgba(12, 13, 12, .4),
            inset -3px -3px 7px rgba(255, 246, 225, .035);
    }

    .finance-page .btn-golden:focus-visible,
    .finance-page .btn-ghost:focus-visible,
    .finance-page .neu-input:focus-visible {
        outline: 2px solid rgba(212, 180, 123, .72);
        outline-offset: 2px;
    }

    .finance-page .section-link button,
    .finance-page button.section-link {
        color: var(--finance-gold) !important;
        font: inherit;
    }

    .finance-page .neu-input {
        width: 100%;
        min-height: 40px;
        padding: 10px 13px;
        border: 1px solid rgba(255, 246, 225, .025);
        border-radius: 12px;
        background: linear-gradient(145deg, #252624, #292a28);
        color: var(--finance-text);
        box-shadow:
            inset 5px 5px 10px rgba(12, 13, 12, .46),
            inset -3px -3px 8px rgba(255, 246, 225, .025);
        font-size: 11px;
        transition: border-color .18s ease, box-shadow .18s ease;
    }

    .finance-page .neu-input::placeholder {
        color: #8f8b83;
        opacity: 1;
    }

    .finance-page .neu-input:focus {
        border-color: rgba(212, 180, 123, .28);
        box-shadow:
            inset 4px 4px 8px rgba(12, 13, 12, .4),
            inset -2px -2px 6px rgba(255, 246, 225, .025),
            0 0 0 2px rgba(212, 180, 123, .08);
    }

    .finance-page select.neu-input {
        color-scheme: dark;
    }

    .finance-page .balhana-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 8px;
        color: var(--finance-muted);
        font-size: 10px;
    }

    .finance-page .balhana-table thead th {
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

    .finance-page .balhana-table thead th:first-child {
        border-radius: 12px 0 0 12px;
    }

    .finance-page .balhana-table thead th:last-child {
        border-radius: 0 12px 12px 0;
    }

    .finance-page .balhana-table tbody td {
        padding: 12px 13px;
        border-top: 1px solid rgba(255, 246, 225, .018);
        border-bottom: 1px solid rgba(12, 13, 12, .18);
        background: linear-gradient(145deg, #30312f, #2b2c2a);
        color: var(--finance-muted);
        vertical-align: middle;
        box-shadow:
            4px 5px 11px rgba(12, 13, 12, .23),
            -3px -3px 8px rgba(255, 246, 225, .018);
    }

    .finance-page .balhana-table tbody td:first-child {
        border-radius: 12px 0 0 12px;
    }

    .finance-page .balhana-table tbody td:last-child {
        border-radius: 0 12px 12px 0;
    }

    .finance-page .balhana-table tbody tr[hidden] {
        display: none;
    }

    .finance-page .badge-yellow {
        display: inline-flex;
        align-items: center;
        width: fit-content;
        min-height: 21px;
        padding: 0 9px;
        border: 1px solid rgba(255, 246, 225, .025);
        border-radius: 999px;
        background: linear-gradient(145deg, #292a28, #242523);
        color: var(--finance-gold);
        box-shadow:
            inset 2px 2px 4px rgba(12, 13, 12, .34),
            inset -1px -1px 3px rgba(255, 246, 225, .025);
        font-size: 9px;
        white-space: nowrap;
    }

    .finance-page #financeEmptyState {
        border-radius: 14px;
        background: linear-gradient(145deg, #292a28, #252624);
        box-shadow:
            inset 4px 4px 8px rgba(12, 13, 12, .32),
            inset -2px -2px 5px rgba(255, 246, 225, .02);
    }

    .finance-page #financeRowCount {
        border-top-color: rgba(255, 246, 225, .055) !important;
    }

    .finance-page dialog {
        border: 1px solid rgba(255, 246, 225, .06) !important;
        border-radius: 22px !important;
        background: linear-gradient(145deg, #30312f, #292a28) !important;
        color: var(--finance-text) !important;
        box-shadow:
            22px 22px 55px rgba(0, 0, 0, .58),
            -8px -8px 24px rgba(255, 246, 225, .06),
            inset 1px 1px 1px rgba(255, 255, 255, .035) !important;
    }

    .finance-page dialog::backdrop {
        background: rgba(14, 15, 14, .72);
        backdrop-filter: blur(3px);
    }

    .finance-page dialog[open] {
        animation: finance-dialog-in .18s ease-out;
    }

    @keyframes finance-dialog-in {
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
        .finance-page .finance-metrics {
            grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
        }

        .finance-page .finance-overview {
            grid-template-columns: minmax(0, 1fr) !important;
        }
    }

    @media (max-width: 620px) {
        .finance-page .finance-metrics {
            gap: 10px !important;
        }

        .finance-page .metric-card {
            min-height: 108px;
            padding: 15px !important;
            border-radius: 18px;
        }

        .finance-page .neu-card {
            padding: 16px !important;
            border-radius: 19px;
        }

        .finance-page .section-header {
            flex-wrap: wrap;
        }

        .finance-page .finance-filters {
            width: 100%;
        }

        .finance-page .finance-filters select {
            flex: 1 1 130px;
            min-width: 0 !important;
        }

        .finance-page dialog > div {
            padding: 18px !important;
        }

        .finance-page .finance-dialog-grid {
            grid-template-columns: minmax(0, 1fr) !important;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .finance-page *,
        .finance-page *::before,
        .finance-page *::after {
            animation-duration: .01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: .01ms !important;
        }
    }
</style>

<div class="finance-page">
    <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:16px;flex-wrap:wrap;margin-bottom:18px;">
        <div style="min-width:0;">
            <div class="page-breadcrumb">Ruang bisnis / September 2026</div>
            <h1 class="page-title">Keuangan</h1>
            <p class="page-subtitle" style="margin-bottom:0;">
                Pantau saldo, arus kas, laba bersih, dan anggaran bisnis Anda dalam satu tampilan.
            </p>
        </div>

        <div class="finance-period" style="display:inline-flex;align-items:center;gap:9px;flex:0 0 auto;padding:9px 15px;border:1px solid rgba(245,239,225,.045);border-radius:999px;background:#2b2b29;box-shadow:-2px -2px 6px rgba(255,245,220,.035),4px 5px 10px rgba(0,0,0,.25);color:#d3cfc6;font-size:11px;">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#d4b47b" stroke-width="1.8" aria-hidden="true">
                <rect x="3" y="4" width="18" height="17" rx="2"/>
                <path d="M16 2v4M8 2v4M3 10h18"/>
            </svg>
            <span>September 2026</span>
        </div>
    </div>

    {{-- Ringkasan keuangan --}}
    <section class="finance-metrics" style="display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:12px;margin-bottom:16px;" aria-label="Ringkasan keuangan">
        <article class="metric-card">
            <div class="metric-label">Saldo akhir periode</div>
            <div id="financeBalance" class="metric-value" style="font-size:clamp(19px,2vw,25px);">Rp12,84 jt</div>
            <div id="financeBalanceChange" class="metric-sub" style="color:#d4b47b;">+Rp1,24 jt dari Agustus</div>
        </article>

        <article class="metric-card">
            <div class="metric-label">Pemasukan bulan ini</div>
            <div id="financeIncome" class="metric-value" style="font-size:clamp(19px,2vw,25px);">Rp18,72 jt</div>
            <div class="metric-sub">48 transaksi penjualan</div>
        </article>

        <article class="metric-card">
            <div class="metric-label">Pengeluaran bulan ini</div>
            <div id="financeExpense" class="metric-value" style="font-size:clamp(19px,2vw,25px);">Rp7,48 jt</div>
            <div class="metric-sub">14 transaksi pembelian</div>
        </article>

        <article class="metric-card">
            <div class="metric-label">Laba bersih bulan ini</div>
            <div id="financeProfit" class="metric-value" style="font-size:clamp(19px,2vw,25px);">Rp11,24 jt</div>
            <div id="financeProfitPercent" class="metric-sub" style="color:#d4b47b;">60% dari pemasukan</div>
        </article>
    </section>

    {{-- Arus kas, biaya, anggaran, dan tindakan --}}
    <section class="finance-overview" style="display:grid;grid-template-columns:minmax(0,1.15fr) minmax(0,.95fr);gap:16px;margin-bottom:16px;align-items:stretch;">
        <div style="display:flex;flex-direction:column;gap:16px;">
            <article class="neu-card" style="padding:20px;">
                <div class="section-header">
                    <div>
                        <h2 class="section-title">Arus Kas</h2>
                        <p class="section-subtitle">Pergerakan dana dalam 30 hari terakhir</p>
                    </div>
                    <a href="{{ route('laporan') }}" class="section-link">Lihat detail →</a>
                </div>

                <div class="finance-chart-well" style="height:180px;position:relative;margin-top:10px;padding:10px;border:1px solid rgba(245,239,225,.035);border-radius:15px;background:#252523;box-shadow:inset 3px 3px 7px rgba(0,0,0,.3),inset -1px -1px 3px rgba(255,245,220,.02);">
                    <canvas id="arusKasChart" role="img" aria-label="Grafik arus kas September 2026">
                        Grafik pemasukan dan pengeluaran bulan September.
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
                <div class="section-header">
                    <div>
                        <h2 class="section-title">Anggaran</h2>
                        <p class="section-subtitle">Batas pengeluaran yang tersisa untuk periode ini</p>
                    </div>
                    <button id="openBudgetDialog" type="button" class="section-link" style="padding:0;border:0;background:none;cursor:pointer;">
                        Atur anggaran →
                    </button>
                </div>

                <div class="finance-budget-progress" style="height:9px;margin:15px 0 17px;overflow:hidden;border-radius:999px;background:#242422;box-shadow:inset 2px 2px 5px rgba(0,0,0,.38),inset -1px -1px 3px rgba(255,245,220,.02);">
                    <div id="budgetProgress" style="width:93.5%;height:100%;border-radius:999px;background:linear-gradient(90deg,#b99a65,#e0c38b);transition:width 180ms ease;"></div>
                </div>

                <div style="display:flex;flex-direction:column;gap:13px;">
                    <div style="display:flex;justify-content:space-between;gap:12px;font-size:10px;">
                        <span style="color:#aaa69d;">Batas anggaran bulan ini</span>
                        <span id="budgetLimitText" style="color:#eeeae1;font-weight:500;">Rp8 jt</span>
                    </div>
                    <div style="display:flex;justify-content:space-between;gap:12px;font-size:10px;">
                        <span style="color:#aaa69d;">Pengeluaran terpakai</span>
                        <span id="budgetSpentText" style="color:#d4a27f;font-weight:500;">Rp7,48 jt</span>
                    </div>
                    <div style="display:flex;justify-content:space-between;gap:12px;font-size:10px;">
                        <span style="color:#aaa69d;">Sisa anggaran</span>
                        <span id="budgetRemainingText" style="color:#eeeae1;font-weight:500;">Rp520 rb</span>
                    </div>
                    <div style="display:flex;justify-content:space-between;gap:12px;font-size:10px;">
                        <span style="color:#aaa69d;">Status anggaran</span>
                        <span id="budgetStatusText" style="color:#d4b47b;font-weight:500;">Aman</span>
                    </div>
                </div>
            </article>
        </div>

        <div style="display:flex;flex-direction:column;gap:16px;">
            <article class="neu-card" style="padding:20px;">
                <div class="section-header">
                    <div>
                        <h2 class="section-title">Komposisi Biaya</h2>
                        <p class="section-subtitle">Distribusi pengeluaran bulan ini</p>
                    </div>
                    <a href="{{ route('laporan') }}" class="section-link">Lihat detail →</a>
                </div>

                <div style="display:flex;align-items:center;justify-content:center;margin:13px 0 17px;">
                    <div class="finance-donut-well" style="position:relative;width:142px;height:142px;padding:8px;border:1px solid rgba(245,239,225,.035);border-radius:50%;background:#252523;box-shadow:inset 3px 3px 7px rgba(0,0,0,.3),inset -1px -1px 3px rgba(255,245,220,.02);">
                        <canvas id="donutChartBiaya" width="126" height="126" role="img" aria-label="Komposisi biaya bisnis">
                            Pembelian produk 40%, biaya operasional 30%, promosi 15%, biaya lain 15%.
                        </canvas>
                    </div>
                </div>

                <div style="display:flex;flex-direction:column;gap:12px;padding-top:13px;border-top:1px solid rgba(245,239,225,.055);">
                    @foreach($komposisiBiaya as $biaya)
                        <div style="display:flex;align-items:center;justify-content:space-between;gap:12px;font-size:10px;">
                            <span style="display:flex;align-items:center;gap:8px;color:#aaa69d;">
                                <span class="chart-legend-dot" style="background:{{ $biaya['warna'] }};"></span>
                                {{ $biaya['label'] }}
                            </span>
                            <span style="color:#d3cfc6;font-weight:500;">{{ $biaya['persen'] }}%</span>
                        </div>
                    @endforeach
                </div>
            </article>

            <article class="neu-card" style="padding:20px;flex:1;">
                <div style="margin-bottom:15px;">
                    <h2 class="section-title">Tindakan Utama</h2>
                    <p class="section-subtitle">Kelola transaksi, anggaran, dan laporan keuangan</p>
                </div>

                <div style="display:flex;flex-direction:column;gap:10px;">
                    <button id="openTransactionDialog" class="btn-golden" type="button" style="width:100%;justify-content:flex-start;">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path d="M12 5v14M5 12h14"/>
                        </svg>
                        Tambah Transaksi
                    </button>

                    <a href="{{ route('laporan') }}" class="btn-ghost" style="width:100%;justify-content:flex-start;">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                            <path d="M14 2v6h6M8 13h8M8 17h8"/>
                        </svg>
                        Lihat Laporan
                    </a>

                    <button id="openBudgetDialogSecondary" class="btn-ghost" type="button" style="width:100%;justify-content:flex-start;">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <rect x="3" y="3" width="18" height="18" rx="2"/>
                            <path d="M3 9h18M9 21V9"/>
                        </svg>
                        Atur Anggaran
                    </button>
                </div>
            </article>
        </div>
    </section>

    {{-- Daftar transaksi --}}
    <section class="neu-card" style="padding:20px;" aria-labelledby="financeTransactionsTitle">
        <div class="section-header">
            <div>
                <h2 class="section-title" id="financeTransactionsTitle">Tabel Transaksi</h2>
                <p class="section-subtitle">5 transaksi terakhir • periode September 2026</p>
            </div>
            <a href="{{ route('laporan') }}" class="section-link">Lihat semua →</a>
        </div>

        <div style="display:flex;align-items:center;gap:11px;flex-wrap:wrap;margin:14px 0;">
            <label style="position:relative;display:block;flex:1 1 260px;min-width:min(100%,220px);">
                <svg style="position:absolute;top:50%;left:14px;transform:translateY(-50%);color:#d4b47b;pointer-events:none;" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <circle cx="11" cy="11" r="8"/>
                    <path d="m21 21-4.35-4.35"/>
                </svg>
                <input
                    id="financeSearch"
                    type="search"
                    class="neu-input"
                    placeholder="Cari transaksi, produk, atau supplier..."
                    aria-label="Cari transaksi, produk, atau akun"
                    autocomplete="off"
                    style="min-height:40px;padding-left:40px;border-radius:999px;"
                >
            </label>

            <div class="finance-filters" style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;">
                <label style="position:absolute;width:1px;height:1px;padding:0;margin:-1px;overflow:hidden;clip:rect(0,0,0,0);white-space:nowrap;border:0;" for="financeTypeFilter">Jenis transaksi</label>
                <select id="financeTypeFilter" class="neu-input" style="width:auto;min-width:140px;border-radius:999px;">
                    <option value="semua">Semua jenis</option>
                    <option value="Pemasukan">Pemasukan</option>
                    <option value="Pengeluaran">Pengeluaran</option>
                </select>

                <label style="position:absolute;width:1px;height:1px;padding:0;margin:-1px;overflow:hidden;clip:rect(0,0,0,0);white-space:nowrap;border:0;" for="financeAccountFilter">Akun</label>
                <select id="financeAccountFilter" class="neu-input" style="width:auto;min-width:140px;border-radius:999px;">
                    <option value="semua">Semua akun</option>
                    <option value="Kas utama">Kas utama</option>
                    <option value="Pembelian">Pembelian</option>
                    <option value="Instagram">Instagram</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>
        </div>

        <div style="max-width:100%;overflow-x:auto;">
            <table class="balhana-table" style="min-width:620px;">
                <thead>
                    <tr>
                        <th>Tanggal / jenis</th>
                        <th>Keterangan</th>
                        <th>Nominal</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="financeTableBody">
                    @foreach($transaksiAwal as $item)
                        @php
                            $searchText = strtolower($item['tanggal'].' '.$item['jenis'].' '.$item['keterangan'].' '.$item['akun'].' '.$item['nominal']);
                        @endphp
                        <tr
                            data-finance-row
                            data-type="{{ $item['jenis'] }}"
                            data-account="{{ $item['akun'] }}"
                            data-search="{{ $searchText }}"
                            data-date="{{ $item['tanggal'] }}"
                            data-description="{{ $item['keterangan'] }}"
                            data-amount="{{ $item['nominal'] }}"
                            data-status="{{ $item['status'] }}"
                        >
                            <td style="color:#d3cfc6;font-size:10px;white-space:nowrap;">
                                {{ \Illuminate\Support\Carbon::parse($item['tanggal'])->translatedFormat('d M') }} • {{ $item['jenis'] }}
                            </td>
                            <td style="color:#aaa69d;">{{ $item['keterangan'] }}</td>
                            <td style="color:{{ $item['jenis'] === 'Pemasukan' ? '#d4b47b' : '#c88e7c' }};font-weight:500;white-space:nowrap;">
                                {{ $item['jenis'] === 'Pemasukan' ? '+' : '−' }}Rp{{ number_format($item['nominal'], 0, ',', '.') }}
                            </td>
                            <td><span class="badge-yellow">{{ $item['status'] }}</span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div id="financeEmptyState" hidden style="padding:25px 12px;text-align:center;color:#aaa69d;font-size:11px;">
            Tidak ada transaksi yang cocok dengan pencarian atau filter ini.
        </div>

        <div id="financeRowCount" style="margin-top:12px;padding-top:11px;border-top:1px solid rgba(245,239,225,.05);color:#aaa69d;font-size:9px;">
            Menampilkan 5 data • diperbarui 30 Sep 2026
        </div>
    </section>

    {{-- Dialog tambah transaksi --}}
    <dialog id="transactionDialog" style="width:min(500px,calc(100% - 28px));max-width:500px;padding:0;border:1px solid rgba(245,239,225,.08);border-radius:22px;background:#2b2b29;color:#eeeae1;box-shadow:0 24px 70px rgba(0,0,0,.58);">
        <div style="padding:22px;">
            <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:12px;margin-bottom:18px;">
                <div>
                    <h2 style="margin:0 0 4px;font-size:17px;font-weight:600;">Tambah Transaksi</h2>
                    <p style="margin:0;color:#aaa69d;font-size:10px;">Catatan tersimpan di browser ini.</p>
                </div>
                <button id="closeTransactionDialog" class="btn-ghost" type="button" aria-label="Tutup" style="min-width:36px;width:36px;min-height:36px;padding:0;">×</button>
            </div>

            <form id="transactionForm">
                <div style="display:flex;flex-direction:column;gap:13px;">
                    <div class="finance-dialog-grid" style="display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:12px;">
                        <div>
                            <label for="transactionDate" style="display:block;margin-bottom:6px;color:#aaa69d;font-size:10px;">Tanggal</label>
                            <input id="transactionDate" type="date" class="neu-input" value="2026-09-30" required>
                        </div>
                        <div>
                            <label for="transactionType" style="display:block;margin-bottom:6px;color:#aaa69d;font-size:10px;">Jenis</label>
                            <select id="transactionType" class="neu-input" required>
                                <option value="Pemasukan">Pemasukan</option>
                                <option value="Pengeluaran">Pengeluaran</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="transactionDescription" style="display:block;margin-bottom:6px;color:#aaa69d;font-size:10px;">Keterangan</label>
                        <input id="transactionDescription" type="text" class="neu-input" maxlength="120" placeholder="Contoh: Penjualan Kemeja Linen" required>
                    </div>

                    <div class="finance-dialog-grid" style="display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:12px;">
                        <div>
                            <label for="transactionAmount" style="display:block;margin-bottom:6px;color:#aaa69d;font-size:10px;">Nominal (Rp)</label>
                            <input id="transactionAmount" type="number" class="neu-input" min="1" step="1000" inputmode="numeric" required>
                        </div>
                        <div>
                            <label for="transactionAccount" style="display:block;margin-bottom:6px;color:#aaa69d;font-size:10px;">Akun</label>
                            <select id="transactionAccount" class="neu-input">
                                <option>Kas utama</option>
                                <option>Pembelian</option>
                                <option>Instagram</option>
                                <option>Lainnya</option>
                            </select>
                        </div>
                    </div>

                    <p id="transactionFormStatus" role="status" aria-live="polite" style="margin:0;color:#aaa69d;font-size:9px;line-height:1.5;"></p>

                    <div style="display:flex;justify-content:flex-end;gap:9px;margin-top:3px;">
                        <button id="cancelTransaction" class="btn-ghost" type="button">Batal</button>
                        <button class="btn-golden" type="submit">Simpan Transaksi</button>
                    </div>
                </div>
            </form>
        </div>
    </dialog>

    {{-- Dialog pengaturan anggaran --}}
    <dialog id="budgetDialog" style="width:min(420px,calc(100% - 28px));max-width:420px;padding:0;border:1px solid rgba(245,239,225,.08);border-radius:22px;background:#2b2b29;color:#eeeae1;box-shadow:0 24px 70px rgba(0,0,0,.58);">
        <div style="padding:22px;">
            <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:12px;margin-bottom:18px;">
                <div>
                    <h2 style="margin:0 0 4px;font-size:17px;font-weight:600;">Atur Anggaran</h2>
                    <p style="margin:0;color:#aaa69d;font-size:10px;">Periode September 2026</p>
                </div>
                <button id="closeBudgetDialog" class="btn-ghost" type="button" aria-label="Tutup" style="min-width:36px;width:36px;min-height:36px;padding:0;">×</button>
            </div>

            <form id="budgetForm">
                <label for="budgetInput" style="display:block;margin-bottom:6px;color:#aaa69d;font-size:10px;">Batas anggaran (Rp)</label>
                <input id="budgetInput" type="number" class="neu-input" min="1" step="100000" value="8000000" required>

                <p id="budgetFormStatus" role="status" aria-live="polite" style="margin:10px 0 0;color:#aaa69d;font-size:9px;line-height:1.5;"></p>

                <div style="display:flex;justify-content:flex-end;gap:9px;margin-top:16px;">
                    <button id="cancelBudget" class="btn-ghost" type="button">Batal</button>
                    <button class="btn-golden" type="submit">Simpan Anggaran</button>
                </div>
            </form>
        </div>
    </dialog>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const transactionsStorageKey = 'balhana.keuangan.transactions.v1';
    const budgetStorageKey = 'balhana.keuangan.budget.v1';

    const searchInput = document.getElementById('financeSearch');
    const typeFilter = document.getElementById('financeTypeFilter');
    const accountFilter = document.getElementById('financeAccountFilter');
    const transactionBody = document.getElementById('financeTableBody');
    const emptyState = document.getElementById('financeEmptyState');

    const transactionDialog = document.getElementById('transactionDialog');
    const budgetDialog = document.getElementById('budgetDialog');
    const transactionForm = document.getElementById('transactionForm');
    const budgetForm = document.getElementById('budgetForm');

    const expenseCategories = {
        product: 2992000,
        operations: 2244000,
        promotion: 1122000,
        other: 1122000
    };

    let budgetLimit = 8000000;
    let localTransactions = [];

    function formatNumber(value) {
        return Math.round(value).toLocaleString('id-ID');
    }

    function formatRupiah(value) {
        return 'Rp' + formatNumber(value);
    }

    function formatCompactRupiah(value) {
        if (value >= 1000000) {
            const amount = value / 1000000;
            return 'Rp' + amount.toLocaleString('id-ID', {
                minimumFractionDigits: amount % 1 === 0 ? 0 : 2,
                maximumFractionDigits: 2
            }) + ' jt';
        }

        if (value >= 1000) {
            return 'Rp' + Math.round(value / 1000).toLocaleString('id-ID') + ' rb';
        }

        return formatRupiah(value);
    }

    function safeRead(key, fallback) {
        try {
            const value = JSON.parse(localStorage.getItem(key) || 'null');
            return value === null ? fallback : value;
        } catch (error) {
            return fallback;
        }
    }

    function updateFinancialSummary() {
        const incomeAdditions = localTransactions
            .filter(function (item) { return item.jenis === 'Pemasukan'; })
            .reduce(function (total, item) { return total + Number(item.nominal || 0); }, 0);
        const expenseAdditions = localTransactions
            .filter(function (item) { return item.jenis === 'Pengeluaran'; })
            .reduce(function (total, item) { return total + Number(item.nominal || 0); }, 0);

        const income = 18720000 + incomeAdditions;
        const expense = 7480000 + expenseAdditions;
        const profit = income - expense;
        const balance = 12840000 + incomeAdditions - expenseAdditions;
        const remaining = budgetLimit - expense;
        const percent = income > 0 ? Math.round((profit / income) * 100) : 0;

        document.getElementById('financeBalance').textContent = formatCompactRupiah(balance);
        document.getElementById('financeIncome').textContent = formatCompactRupiah(income);
        document.getElementById('financeExpense').textContent = formatCompactRupiah(expense);
        document.getElementById('financeProfit').textContent = formatCompactRupiah(profit);
        document.getElementById('financeProfitPercent').textContent = percent + '% dari pemasukan';

        document.getElementById('budgetLimitText').textContent = formatCompactRupiah(budgetLimit);
        document.getElementById('budgetSpentText').textContent = formatCompactRupiah(expense);
        document.getElementById('budgetRemainingText').textContent =
            remaining >= 0
                ? formatCompactRupiah(remaining)
                : 'Melebihi ' + formatCompactRupiah(Math.abs(remaining));

        const usage = budgetLimit > 0 ? Math.min(100, (expense / budgetLimit) * 100) : 0;
        document.getElementById('budgetProgress').style.width = usage + '%';

        const status = document.getElementById('budgetStatusText');
        if (remaining < 0) {
            status.textContent = 'Melebihi batas';
            status.style.color = '#c88e7c';
        } else if (usage >= 90) {
            status.textContent = 'Hampir mencapai batas';
            status.style.color = '#d4b47b';
        } else {
            status.textContent = 'Aman';
            status.style.color = '#d4b47b';
        }
    }

    function createTransactionRow(item) {
        const row = document.createElement('tr');
        const amount = Number(item.nominal) || 0;
        const date = new Date(item.tanggal + 'T12:00:00');
        const dateText = Number.isNaN(date.getTime())
            ? item.tanggal
            : new Intl.DateTimeFormat('id-ID', { day: '2-digit', month: 'short' }).format(date);

        row.dataset.financeRow = '';
        row.dataset.type = item.jenis;
        row.dataset.account = item.akun;
        row.dataset.search = [
            item.tanggal,
            item.jenis,
            item.keterangan,
            item.akun,
            amount
        ].join(' ').toLocaleLowerCase('id-ID');

        const values = [
            {
                text: dateText + ' • ' + item.jenis,
                style: 'color:#d3cfc6;font-size:10px;white-space:nowrap;'
            },
            {
                text: item.keterangan,
                style: 'color:#aaa69d;'
            },
            {
                text: (item.jenis === 'Pemasukan' ? '+' : '−') + formatRupiah(amount),
                style: 'color:' + (item.jenis === 'Pemasukan' ? '#d4b47b' : '#c88e7c') + ';font-weight:500;white-space:nowrap;'
            }
        ];

        values.forEach(function (value) {
            const cell = document.createElement('td');
            cell.textContent = value.text;
            cell.style.cssText = value.style;
            row.appendChild(cell);
        });

        const statusCell = document.createElement('td');
        const badge = document.createElement('span');
        badge.className = 'badge-yellow';
        badge.textContent = item.status || 'Selesai';
        statusCell.appendChild(badge);
        row.appendChild(statusCell);

        return row;
    }

    function filterTransactions() {
        const query = (searchInput.value || '').trim().toLocaleLowerCase('id-ID');
        const selectedType = typeFilter.value;
        const selectedAccount = accountFilter.value;
        const rows = Array.from(document.querySelectorAll('[data-finance-row]'));
        let visible = 0;

        rows.forEach(function (row) {
            const matchesType = selectedType === 'semua' || row.dataset.type === selectedType;
            const matchesAccount = selectedAccount === 'semua' || row.dataset.account === selectedAccount;
            const matchesSearch = !query || (row.dataset.search || '').includes(query);
            const show = matchesType && matchesAccount && matchesSearch;

            row.hidden = !show;
            if (show) visible += 1;
        });

        emptyState.hidden = visible !== 0;
        document.getElementById('financeRowCount').textContent =
            'Menampilkan ' + visible + ' data • diperbarui 30 Sep 2026';
    }

    function openDialog(dialog) {
        if (typeof dialog.showModal === 'function') {
            dialog.showModal();
        } else {
            dialog.setAttribute('open', '');
        }
    }

    function closeDialog(dialog) {
        if (typeof dialog.close === 'function') {
            dialog.close();
        } else {
            dialog.removeAttribute('open');
        }
    }

    document.getElementById('openTransactionDialog').addEventListener('click', function () {
        openDialog(transactionDialog);
    });

    document.getElementById('closeTransactionDialog').addEventListener('click', function () {
        closeDialog(transactionDialog);
    });

    document.getElementById('cancelTransaction').addEventListener('click', function () {
        closeDialog(transactionDialog);
    });

    document.getElementById('openBudgetDialog').addEventListener('click', function () {
        document.getElementById('budgetInput').value = budgetLimit;
        openDialog(budgetDialog);
    });

    document.getElementById('openBudgetDialogSecondary').addEventListener('click', function () {
        document.getElementById('budgetInput').value = budgetLimit;
        openDialog(budgetDialog);
    });

    document.getElementById('closeBudgetDialog').addEventListener('click', function () {
        closeDialog(budgetDialog);
    });

    document.getElementById('cancelBudget').addEventListener('click', function () {
        closeDialog(budgetDialog);
    });

    [transactionDialog, budgetDialog].forEach(function (dialog) {
        dialog.addEventListener('click', function (event) {
            if (event.target === dialog) {
                closeDialog(dialog);
            }
        });
    });

    transactionForm.addEventListener('submit', function (event) {
        event.preventDefault();

        if (!transactionForm.reportValidity()) {
            return;
        }

        const item = {
            tanggal: document.getElementById('transactionDate').value,
            jenis: document.getElementById('transactionType').value,
            keterangan: document.getElementById('transactionDescription').value.trim(),
            nominal: Number(document.getElementById('transactionAmount').value),
            akun: document.getElementById('transactionAccount').value,
            status: 'Selesai'
        };

        localTransactions.push(item);

        try {
            localStorage.setItem(transactionsStorageKey, JSON.stringify(localTransactions));
        } catch (error) {
            localTransactions.pop();
            document.getElementById('transactionFormStatus').textContent =
                'Transaksi tidak dapat disimpan di browser ini.';
            return;
        }

        transactionBody.prepend(createTransactionRow(item));
        updateFinancialSummary();
        filterTransactions();

        document.getElementById('transactionFormStatus').textContent =
            'Transaksi ditambahkan dan tersimpan di browser ini.';
        transactionForm.reset();
        document.getElementById('transactionDate').value = '2026-09-30';
        closeDialog(transactionDialog);
    });

    budgetForm.addEventListener('submit', function (event) {
        event.preventDefault();

        if (!budgetForm.reportValidity()) {
            return;
        }

        const newBudget = Number(document.getElementById('budgetInput').value);

        if (!Number.isFinite(newBudget) || newBudget <= 0) {
            document.getElementById('budgetFormStatus').textContent =
                'Masukkan anggaran yang lebih besar dari nol.';
            return;
        }

        budgetLimit = newBudget;

        try {
            localStorage.setItem(budgetStorageKey, JSON.stringify(budgetLimit));
        } catch (error) {
            document.getElementById('budgetFormStatus').textContent =
                'Anggaran tidak dapat disimpan di browser ini.';
            return;
        }

        updateFinancialSummary();
        document.getElementById('budgetFormStatus').textContent =
            'Anggaran diperbarui dan tersimpan di browser ini.';
        closeDialog(budgetDialog);
    });

    searchInput.addEventListener('input', filterTransactions);
    typeFilter.addEventListener('change', filterTransactions);
    accountFilter.addEventListener('change', filterTransactions);

    localTransactions = safeRead(transactionsStorageKey, []);
    if (!Array.isArray(localTransactions)) {
        localTransactions = [];
    }

    const savedBudget = Number(safeRead(budgetStorageKey, 8000000));
    if (Number.isFinite(savedBudget) && savedBudget > 0) {
        budgetLimit = savedBudget;
    }

    localTransactions.forEach(function (item) {
        transactionBody.prepend(createTransactionRow(item));
    });

    updateFinancialSummary();
    filterTransactions();

    const cashCanvas = document.getElementById('arusKasChart');

    if (cashCanvas && typeof Chart !== 'undefined') {
        new Chart(cashCanvas, {
            type: 'bar',
            data: {
                labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
                datasets: [
                    {
                        type: 'bar',
                        label: 'Pemasukan',
                        data: [20, 25, 22, 35, 45, 30, 40, 50, 40, 55],
                        backgroundColor: 'rgba(212, 180, 123, 0.82)',
                        borderRadius: 5,
                        barPercentage: 0.62,
                        order: 2
                    },
                    {
                        type: 'line',
                        label: 'Arus kas',
                        data: [15, 20, 18, 29, 36, 28, 37, 44, 37, 49],
                        borderColor: '#e1c692',
                        borderWidth: 2,
                        pointRadius: 0,
                        tension: 0.42,
                        fill: false,
                        order: 1
                    }
                ]
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

    const costsCanvas = document.getElementById('donutChartBiaya');

    if (costsCanvas && typeof Chart !== 'undefined') {
        new Chart(costsCanvas, {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [40, 30, 15, 15],
                    backgroundColor: ['#d4b47b', '#aaa99e', '#77766f', '#55544f'],
                    borderColor: '#252523',
                    borderWidth: 3,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: false,
                cutout: '68%',
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