@extends('layouts.app')

@section('title', 'Riset Pasar – BALHANA')

@section('content')
@php
    $riwayatAwal = [
        [
            'tanggal' => '2026-09-30',
            'sumber' => 'Facebook',
            'produk' => 'Kemeja Linen',
            'varian' => 'L • Hitam • Linen',
            'peminat' => 12,
            'catatan' => 'Dicari untuk kerja',
        ],
        [
            'tanggal' => '2026-09-29',
            'sumber' => 'WhatsApp',
            'produk' => 'Tunik Aira',
            'varian' => 'M • Cream • Rayon',
            'peminat' => 8,
            'catatan' => 'Request warna netral',
        ],
        [
            'tanggal' => '2026-09-29',
            'sumber' => 'Grup jual-beli',
            'produk' => 'Outer Knit',
            'varian' => 'All size • Beige • Rajut',
            'peminat' => 6,
            'catatan' => 'Tanya jadwal restock',
        ],
        [
            'tanggal' => '2026-09-28',
            'sumber' => 'Facebook',
            'produk' => 'Celana Kulot',
            'varian' => 'L • Mocca • Satin',
            'peminat' => 10,
            'catatan' => 'Suka model lebar',
        ],
        [
            'tanggal' => '2026-09-28',
            'sumber' => 'WhatsApp',
            'produk' => 'Kemeja Linen',
            'varian' => 'XL • Cream • Linen',
            'peminat' => 5,
            'catatan' => 'Minta ukuran besar',
        ],
    ];
@endphp

<div style="display:flex;align-items:flex-start;justify-content:space-between;gap:16px;flex-wrap:wrap;margin-bottom:18px;">
    <div style="min-width:0;">
        <div class="page-breadcrumb">Ruang bisnis / September 2026</div>
        <h1 class="page-title">Riset Pasar</h1>
        <p class="page-subtitle" style="margin-bottom:0;">
            Catat minat pelanggan dari percakapan, bukan transaksi penjualan.
        </p>
    </div>

    <button id="jumpToInterestForm" class="btn-golden" type="button">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
            <path d="M12 5v14M5 12h14"/>
        </svg>
        Catat Minat
    </button>
</div>

{{-- Ringkasan minat --}}
<section style="display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:12px;margin-bottom:18px;" aria-label="Ringkasan minat pelanggan">
    <article class="metric-card">
        <div class="metric-label">Minat bulan ini</div>
        <div class="metric-value" id="totalInterestValue">428</div>
        <div class="metric-sub">+24,8% dari Agustus</div>
        <svg class="metric-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
            <path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.7l-1.1-1.1a5.5 5.5 0 0 0-7.8 7.8l1.1 1.1 7.8 7.7 7.8-7.7 1-1.1a5.5 5.5 0 0 0 0-7.8z"/>
        </svg>
    </article>

    <article class="metric-card">
        <div class="metric-label">Facebook</div>
        <div class="metric-value" id="facebookInterestValue">205</div>
        <div class="metric-sub" id="facebookInterestPercent">48% dari total minat</div>
        <svg class="metric-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
        </svg>
    </article>

    <article class="metric-card">
        <div class="metric-label">WhatsApp</div>
        <div class="metric-value" id="whatsappInterestValue">150</div>
        <div class="metric-sub" id="whatsappInterestPercent">35% dari total minat</div>
        <svg class="metric-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
            <path d="M21 11.5a8.4 8.4 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.4 8.4 0 0 1-3.8-.9L3 21l1.9-5.7a8.4 8.4 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.4 8.4 0 0 1 3.8-.9h.5a8.5 8.5 0 0 1 8 8z"/>
        </svg>
    </article>

    <article class="metric-card">
        <div class="metric-label">Grup jual-beli</div>
        <div class="metric-value" id="groupInterestValue">73</div>
        <div class="metric-sub" id="groupInterestPercent">17% dari total minat</div>
        <svg class="metric-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
            <circle cx="9" cy="7" r="4"/>
            <path d="M23 21v-2a4 4 0 0 0-3-3.9M16 3.1a4 4 0 0 1 0 7.8"/>
        </svg>
    </article>
</section>

{{-- Form dan ringkasan sumber --}}
<section style="display:grid;grid-template-columns:minmax(0,1.15fr) minmax(300px,.85fr);gap:16px;align-items:start;margin-bottom:16px;">
    <article class="neu-card" id="interestFormPanel" style="padding:20px;">
        <div style="margin-bottom:18px;">
            <h2 class="section-title">Input Manual Minat</h2>
            <p class="section-subtitle">Satu catatan untuk satu percakapan pelanggan</p>
        </div>

        <form id="interestForm">
            <div style="display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:14px;">
                <div>
                    <label for="interestDate" style="display:block;margin-bottom:6px;color:#aaa69d;font-size:10px;">Tanggal pengamatan</label>
                    <input id="interestDate" name="tanggal" type="date" class="neu-input" value="2026-09-30" required>
                </div>

                <div>
                    <label for="interestSource" style="display:block;margin-bottom:6px;color:#aaa69d;font-size:10px;">Sumber minat</label>
                    <select id="interestSource" name="sumber" class="neu-input" required>
                        <option value="Facebook">Facebook</option>
                        <option value="WhatsApp">WhatsApp</option>
                        <option value="Grup jual-beli">Grup jual-beli</option>
                    </select>
                </div>
            </div>

            <div style="margin-top:14px;">
                <label for="interestAccount" style="display:block;margin-bottom:6px;color:#aaa69d;font-size:10px;">Nama akun / grup</label>
                <input id="interestAccount" name="akun" type="text" class="neu-input" value="Grup Fashion Muslim Bandung" maxlength="100" required>
            </div>

            <div style="display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:14px;margin-top:14px;">
                <div>
                    <label for="interestProduct" style="display:block;margin-bottom:6px;color:#aaa69d;font-size:10px;">Produk diminati</label>
                    <select id="interestProduct" name="produk" class="neu-input" required>
                        <option value="Kemeja Linen">Kemeja Linen • BLH-001</option>
                        <option value="Tunik Aira">Tunik Aira • BLH-002</option>
                        <option value="Celana Kulot">Celana Kulot • BLH-003</option>
                        <option value="Outer Knit">Outer Knit • BLH-004</option>
                    </select>
                </div>

                <div>
                    <label for="interestCount" style="display:block;margin-bottom:6px;color:#aaa69d;font-size:10px;">Jumlah peminat</label>
                    <div style="position:relative;">
                        <input id="interestCount" name="peminat" type="number" class="neu-input" value="12" min="1" max="10000" inputmode="numeric" required style="padding-right:60px;">
                        <span style="position:absolute;top:50%;right:13px;transform:translateY(-50%);color:#aaa69d;font-size:10px;pointer-events:none;">orang</span>
                    </div>
                </div>

                <div>
                    <label for="interestSize" style="display:block;margin-bottom:6px;color:#aaa69d;font-size:10px;">Ukuran</label>
                    <select id="interestSize" name="ukuran" class="neu-input">
                        <option>L</option>
                        <option>M</option>
                        <option>XL</option>
                        <option>S</option>
                        <option>All size</option>
                    </select>
                </div>

                <div>
                    <label for="interestColor" style="display:block;margin-bottom:6px;color:#aaa69d;font-size:10px;">Warna</label>
                    <select id="interestColor" name="warna" class="neu-input">
                        <option>Hitam</option>
                        <option>Cream</option>
                        <option>Olive</option>
                        <option>Mocca</option>
                        <option>Beige</option>
                        <option>Charcoal</option>
                    </select>
                </div>
            </div>

            <div style="margin-top:14px;">
                <label for="interestMaterial" style="display:block;margin-bottom:6px;color:#aaa69d;font-size:10px;">Bahan yang dicari</label>
                <select id="interestMaterial" name="bahan" class="neu-input">
                    <option>Linen premium</option>
                    <option>Katun rayon</option>
                    <option>Satin twill</option>
                    <option>Rajut halus</option>
                </select>
            </div>

            <div style="margin-top:14px;">
                <label for="interestNote" style="display:block;margin-bottom:6px;color:#aaa69d;font-size:10px;">Catatan percakapan</label>
                <textarea id="interestNote" name="catatan" class="neu-input" rows="3" maxlength="500" style="min-height:88px;resize:vertical;line-height:1.55;">Banyak yang mencari kemeja adem untuk kerja. Harga Rp149.000 masih sesuai.</textarea>
            </div>

            <div style="display:flex;align-items:center;flex-wrap:wrap;gap:9px;margin-top:16px;">
                <button class="btn-golden" type="submit">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path d="M20 6 9 17l-5-5"/>
                    </svg>
                    Simpan Minat
                </button>

                <button id="resetInterestForm" class="btn-ghost" type="reset">Reset</button>
            </div>

            <p id="interestSaveStatus" role="status" aria-live="polite" style="margin:11px 0 0;color:#aaa69d;font-size:9px;line-height:1.5;">
                Catatan baru disimpan di browser ini, tidak mengubah stok atau omzet.
            </p>
        </form>
    </article>

    <div style="display:flex;flex-direction:column;gap:14px;">
        <article class="neu-card" style="padding:20px;">
            <div style="margin-bottom:15px;">
                <h2 class="section-title">Sebaran Sumber Minat</h2>
                <p class="section-subtitle">September 2026</p>
            </div>

            <div style="display:flex;align-items:center;gap:20px;min-height:150px;margin-bottom:13px;">
                <div style="position:relative;width:126px;height:126px;flex:0 0 126px;">
                    <canvas id="donutChartRiset" width="126" height="126" role="img" aria-label="Grafik sebaran sumber minat">
                        Sebaran minat: Facebook 48%, WhatsApp 35%, grup jual-beli 17%.
                    </canvas>
                    <div style="position:absolute;inset:0;display:flex;flex-direction:column;align-items:center;justify-content:center;pointer-events:none;">
                        <div id="donutTotalValue" style="color:#eeeae1;font-size:23px;font-weight:500;line-height:1;">428</div>
                        <div style="margin-top:5px;color:#aaa69d;font-size:9px;">Total minat</div>
                    </div>
                </div>

                <div style="display:flex;flex-direction:column;gap:12px;min-width:0;">
                    <div style="display:flex;align-items:center;gap:8px;color:#d3cfc6;font-size:10px;">
                        <span class="chart-legend-dot" style="background:#d4b47b;"></span>
                        <span>Facebook <span id="facebookLegendPercent" style="color:#aaa69d;">48%</span></span>
                    </div>
                    <div style="display:flex;align-items:center;gap:8px;color:#d3cfc6;font-size:10px;">
                        <span class="chart-legend-dot" style="background:#aaa99e;"></span>
                        <span>WhatsApp <span id="whatsappLegendPercent" style="color:#aaa69d;">35%</span></span>
                    </div>
                    <div style="display:flex;align-items:center;gap:8px;color:#d3cfc6;font-size:10px;">
                        <span class="chart-legend-dot" style="background:#72736d;"></span>
                        <span>Grup jual-beli <span id="groupLegendPercent" style="color:#aaa69d;">17%</span></span>
                    </div>
                </div>
            </div>

            <p style="margin:0;color:#aaa69d;font-size:10px;line-height:1.6;">
                Riset dicatat manual dari Facebook, WhatsApp, dan grup jual-beli. Tidak ada pengambilan data otomatis.
            </p>
        </article>

        <aside class="alert-box" style="padding:16px;">
            <div style="display:flex;align-items:center;gap:8px;margin-bottom:7px;color:#dfbf83;font-size:11px;font-weight:600;">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path d="M12 3 2.8 19a1.3 1.3 0 0 0 1.1 2h16.2a1.3 1.3 0 0 0 1.1-2L12 3z"/>
                    <path d="M12 9v5M12 17h.01"/>
                </svg>
                Hindari minat ganda
            </div>
            <p style="margin:0;color:#aaa69d;font-size:10px;line-height:1.55;">
                Periksa akun dan tanggal sebelum menyimpan. Satu pelanggan di dua kanal tetap dihitung satu minat untuk produk yang sama.
            </p>
        </aside>

        <article class="neu-card" style="padding:20px;">
            <h2 class="section-title" style="margin-bottom:12px;">Temuan Minggu Ini</h2>
            <div style="margin-bottom:8px;color:#d4b47b;font-size:12px;font-weight:600;">Kemeja Linen • L Hitam</div>
            <p style="margin:0 0 15px;color:#aaa69d;font-size:10px;line-height:1.6;">
                Permintaan naik 32% dalam 7 hari. Ukuran L menyumbang 48% minat Kemeja Linen.
            </p>
            <a href="{{ route('analisis-minat') }}" class="btn-ghost" style="width:100%;">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path d="M3 3v18h18"/>
                    <path d="m7 14 4-4 4 3 6-7"/>
                </svg>
                Buka Analisis Minat
            </a>
        </article>
    </div>
</section>

{{-- Riwayat riset pasar --}}
<section class="neu-card" style="padding:20px;" aria-labelledby="interestHistoryTitle">
    <div class="section-header">
        <div>
            <h2 class="section-title" id="interestHistoryTitle">Riwayat Riset Pasar</h2>
            <p class="section-subtitle"><span id="historyCount">5</span> catatan terakhir • 428 minat pada September</p>
        </div>
    </div>

    <div style="display:flex;align-items:center;gap:11px;flex-wrap:wrap;margin:14px 0;">
        <label style="position:relative;display:block;flex:1 1 260px;min-width:min(100%,220px);">
            <svg style="position:absolute;top:50%;left:14px;transform:translateY(-50%);color:#d4b47b;pointer-events:none;" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                <circle cx="11" cy="11" r="8"/>
                <path d="m21 21-4.35-4.35"/>
            </svg>
            <input id="historySearch" type="search" class="neu-input" placeholder="Cari produk, akun, atau catatan..." aria-label="Cari riwayat riset pasar" autocomplete="off" style="min-height:40px;padding-left:40px;border-radius:999px;">
        </label>

        <div id="sourceFilters" style="display:flex;align-items:center;gap:7px;max-width:100%;overflow-x:auto;padding:3px 2px 7px;" role="group" aria-label="Filter sumber minat">
            <button type="button" class="filter-tab active" data-source-filter="semua" aria-pressed="true">Semua sumber</button>
            <button type="button" class="filter-tab" data-source-filter="Facebook" aria-pressed="false">Facebook</button>
            <button type="button" class="filter-tab" data-source-filter="WhatsApp" aria-pressed="false">WhatsApp</button>
            <button type="button" class="filter-tab" data-source-filter="Grup jual-beli" aria-pressed="false">Grup jual-beli</button>
        </div>
    </div>

    <div style="max-width:100%;overflow-x:auto;">
        <table class="balhana-table" style="min-width:680px;">
            <thead>
                <tr>
                    <th>Tanggal / sumber</th>
                    <th>Produk</th>
                    <th>Varian / bahan</th>
                    <th>Peminat</th>
                    <th>Catatan</th>
                </tr>
            </thead>
            <tbody id="interestHistoryBody">
                @foreach($riwayatAwal as $item)
                    <tr
                        data-history-row
                        data-source="{{ $item['sumber'] }}"
                        data-search="{{ strtolower($item['tanggal'].' '.$item['sumber'].' '.$item['produk'].' '.$item['varian'].' '.$item['catatan']) }}"
                    >
                        <td style="color:#aaa69d;font-size:10px;white-space:nowrap;">
                            {{ \Illuminate\Support\Carbon::parse($item['tanggal'])->translatedFormat('d M') }} • {{ $item['sumber'] }}
                        </td>
                        <td style="color:#eeeae1;font-weight:500;">{{ $item['produk'] }}</td>
                        <td style="color:#aaa69d;font-size:10px;">{{ $item['varian'] }}</td>
                        <td style="color:#eeeae1;font-weight:500;white-space:nowrap;">{{ $item['peminat'] }} orang</td>
                        <td style="color:#d4b47b;font-size:10px;">{{ $item['catatan'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div id="historyEmptyState" hidden style="padding:28px 14px;text-align:center;color:#aaa69d;font-size:11px;">
        Tidak ada catatan yang cocok dengan pencarian atau filter ini.
    </div>

    <div style="margin-top:11px;padding-top:11px;border-top:1px solid rgba(245,239,225,.05);color:#aaa69d;font-size:9px;">
        Catatan awal merupakan ringkasan September 2026.
    </div>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const storageKey = 'balhana.riset-pasar.records.v1';
    const form = document.getElementById('interestForm');
    const historyBody = document.getElementById('interestHistoryBody');
    const historySearch = document.getElementById('historySearch');
    const sourceFilters = document.getElementById('sourceFilters');
    const emptyState = document.getElementById('historyEmptyState');
    const historyCount = document.getElementById('historyCount');
    const saveStatus = document.getElementById('interestSaveStatus');
    const jumpButton = document.getElementById('jumpToInterestForm');

    const sourceTotals = {
        'Facebook': 205,
        'WhatsApp': 150,
        'Grup jual-beli': 73
    };

    let activeSource = 'semua';
    let donutChart = null;

    function safeReadRecords() {
        try {
            const saved = JSON.parse(localStorage.getItem(storageKey) || '[]');
            return Array.isArray(saved) ? saved : [];
        } catch (error) {
            return [];
        }
    }

    function formatDate(dateValue) {
        const date = new Date(dateValue + 'T12:00:00');

        if (Number.isNaN(date.getTime())) {
            return dateValue;
        }

        return new Intl.DateTimeFormat('id-ID', {
            day: '2-digit',
            month: 'short'
        }).format(date);
    }

    function updateVisibleRows() {
        const query = (historySearch?.value || '').trim().toLocaleLowerCase('id-ID');
        const rows = Array.from(document.querySelectorAll('[data-history-row]'));
        let visible = 0;

        rows.forEach(function (row) {
            const matchesSource =
                activeSource === 'semua' || row.dataset.source === activeSource;
            const matchesText =
                !query || (row.dataset.search || '').toLocaleLowerCase('id-ID').includes(query);
            const show = matchesSource && matchesText;

            row.hidden = !show;

            if (show) {
                visible += 1;
            }
        });

        if (historyCount) {
            historyCount.textContent = String(visible);
        }

        if (emptyState) {
            emptyState.hidden = visible !== 0;
        }
    }

    function createHistoryRow(record) {
        const row = document.createElement('tr');
        row.dataset.historyRow = '';
        row.dataset.source = record.sumber;

        const searchable = [
            record.tanggal,
            record.sumber,
            record.produk,
            record.varian,
            record.catatan
        ].join(' ').toLocaleLowerCase('id-ID');

        row.dataset.search = searchable;

        const values = [
            { text: formatDate(record.tanggal) + ' • ' + record.sumber, style: 'color:#aaa69d;font-size:10px;white-space:nowrap;' },
            { text: record.produk, style: 'color:#eeeae1;font-weight:500;' },
            { text: record.varian, style: 'color:#aaa69d;font-size:10px;' },
            { text: String(record.peminat) + ' orang', style: 'color:#eeeae1;font-weight:500;white-space:nowrap;' },
            { text: record.catatan, style: 'color:#d4b47b;font-size:10px;' }
        ];

        values.forEach(function (value) {
            const cell = document.createElement('td');
            cell.textContent = value.text;
            cell.style.cssText = value.style;
            row.appendChild(cell);
        });

        return row;
    }

    function updateSummary(savedRecords) {
        const additions = {
            'Facebook': 0,
            'WhatsApp': 0,
            'Grup jual-beli': 0
        };

        savedRecords.forEach(function (record) {
            const count = Number(record.peminat) || 0;
            if (Object.prototype.hasOwnProperty.call(additions, record.sumber)) {
                additions[record.sumber] += count;
            }
        });

        const totals = {
            'Facebook': sourceTotals['Facebook'] + additions['Facebook'],
            'WhatsApp': sourceTotals['WhatsApp'] + additions['WhatsApp'],
            'Grup jual-beli': sourceTotals['Grup jual-beli'] + additions['Grup jual-beli']
        };

        const total = totals['Facebook'] + totals['WhatsApp'] + totals['Grup jual-beli'];
        const percentage = function (value) {
            return total ? Math.round((value / total) * 100) : 0;
        };

        document.getElementById('totalInterestValue').textContent = total.toLocaleString('id-ID');
        document.getElementById('donutTotalValue').textContent = total.toLocaleString('id-ID');

        document.getElementById('facebookInterestValue').textContent = totals['Facebook'].toLocaleString('id-ID');
        document.getElementById('whatsappInterestValue').textContent = totals['WhatsApp'].toLocaleString('id-ID');
        document.getElementById('groupInterestValue').textContent = totals['Grup jual-beli'].toLocaleString('id-ID');

        document.getElementById('facebookInterestPercent').textContent = percentage(totals['Facebook']) + '% dari total minat';
        document.getElementById('whatsappInterestPercent').textContent = percentage(totals['WhatsApp']) + '% dari total minat';
        document.getElementById('groupInterestPercent').textContent = percentage(totals['Grup jual-beli']) + '% dari total minat';

        document.getElementById('facebookLegendPercent').textContent = percentage(totals['Facebook']) + '%';
        document.getElementById('whatsappLegendPercent').textContent = percentage(totals['WhatsApp']) + '%';
        document.getElementById('groupLegendPercent').textContent = percentage(totals['Grup jual-beli']) + '%';

        if (donutChart) {
            donutChart.data.datasets[0].data = [
                totals['Facebook'],
                totals['WhatsApp'],
                totals['Grup jual-beli']
            ];
            donutChart.update();
        }
    }

    function renderSavedRecords() {
        const savedRecords = safeReadRecords();

        savedRecords.slice().reverse().forEach(function (record) {
            historyBody.prepend(createHistoryRow(record));
        });

        updateSummary(savedRecords);
        updateVisibleRows();
    }

    if (jumpButton) {
        jumpButton.addEventListener('click', function () {
            document.getElementById('interestFormPanel')?.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
            document.getElementById('interestAccount')?.focus({ preventScroll: true });
        });
    }

    if (historySearch) {
        historySearch.addEventListener('input', updateVisibleRows);
    }

    if (sourceFilters) {
        sourceFilters.addEventListener('click', function (event) {
            const button = event.target.closest('[data-source-filter]');

            if (!button) {
                return;
            }

            activeSource = button.dataset.sourceFilter || 'semua';

            sourceFilters.querySelectorAll('[data-source-filter]').forEach(function (filterButton) {
                const isActive = filterButton === button;
                filterButton.classList.toggle('active', isActive);
                filterButton.setAttribute('aria-pressed', isActive ? 'true' : 'false');
            });

            updateVisibleRows();
        });
    }

    if (form) {
        form.addEventListener('submit', function (event) {
            event.preventDefault();

            if (!form.reportValidity()) {
                return;
            }

            const formData = new FormData(form);
            const count = Number(formData.get('peminat'));

            if (!Number.isInteger(count) || count < 1) {
                document.getElementById('interestCount')?.focus();
                return;
            }

            const record = {
                tanggal: String(formData.get('tanggal') || ''),
                sumber: String(formData.get('sumber') || ''),
                produk: String(formData.get('produk') || ''),
                varian: [
                    String(formData.get('ukuran') || ''),
                    String(formData.get('warna') || ''),
                    String(formData.get('bahan') || '')
                ].filter(Boolean).join(' • '),
                peminat: count,
                catatan: String(formData.get('catatan') || '').trim() || 'Tidak ada catatan'
            };

            const savedRecords = safeReadRecords();
            savedRecords.push(record);

            try {
                localStorage.setItem(storageKey, JSON.stringify(savedRecords));
            } catch (error) {
                if (saveStatus) {
                    saveStatus.textContent = 'Catatan tidak dapat disimpan di browser ini.';
                    saveStatus.style.color = '#d4a27f';
                }
                return;
            }

            historyBody.prepend(createHistoryRow(record));
            updateSummary(savedRecords);
            updateVisibleRows();

            if (saveStatus) {
                saveStatus.textContent = 'Minat berhasil ditambahkan dan tersimpan di browser ini.';
                saveStatus.style.color = '#cdb98e';
            }

            const selectedDate = formData.get('tanggal');
            form.reset();
            document.getElementById('interestDate').value = selectedDate;
        });
    }

    const chartCanvas = document.getElementById('donutChartRiset');

    if (chartCanvas && typeof Chart !== 'undefined') {
        donutChart = new Chart(chartCanvas, {
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

    renderSavedRecords();
});
</script>
@endpush